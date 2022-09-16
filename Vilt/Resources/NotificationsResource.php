<?php

namespace Modules\Notifications\Vilt\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Base\Services\Resource\Resource;
use Modules\Base\Services\Rows\Date;
use Modules\Base\Services\Rows\HasOne;
use Modules\Base\Services\Rows\Option;
use Modules\Base\Services\Rows\Select;
use Modules\Base\Services\Rows\Text;
use Modules\Notifications\Entities\NotifiactionsTemplates;
use Modules\Notifications\Entities\UserNotification;
use Modules\Notifications\Services\SendNotification;
use Modules\Notifications\Vilt\Resources\NotificationsResource\Traits\Components;
use Modules\Notifications\Vilt\Resources\NotificationsResource\Traits\Methods;

class NotificationsResource extends Resource
{
    use Methods, Components;

    public ?string $model = UserNotification::class;
    public string $icon = "bx bxs-bell";
    public string $group = "Notifications";
    public ?bool $import = false;

    public function rows(): array
    {
        $this->canEdit = false;

        return [
            Text::make('id')->label(__('ID'))->create(false)->edit(false),
            Select::make('template_id')->label(__('Template'))->validation("required|array")->options(NotifiactionsTemplates::where('action', 'manual')->get()->toArray())->trackByName('key'),
            Select::make('privacy')->label(__('Privacy'))->validation("required|array")->options([
                Option::make(__('Public'))->id('public'),
                Option::make(__('Private'))->id('private'),
            ]),
            Select::make('model_type')
                ->label(__('Type'))
                ->validation("required|array")
                ->options([
                    Option::make(__('User'))->id(User::class)
                ]),
            HasOne::make('model_id')
                ->label(__('User'))
                ->validation("nullable|array")
                ->reactive()
                ->reactiveRow('model_type')
                ->reactiveWhere(Option::make(__('User'))->id(User::class))
                ->model(User::class)
                ->relation('model'),
            Date::make('created_at')
                ->label(__('Date'))
                ->create(false)
                ->edit(false)
                ->type('datetime')
                ->options([])
        ];
    }
}
