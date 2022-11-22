<?php

namespace Modules\Notifications\Vilt\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Base\Services\Resource\Resource;
use Modules\Base\Services\Rows\Date;
use Modules\Base\Services\Rows\HasOne;
use Modules\Base\Services\Rows\Option;
use Modules\Base\Services\Rows\Relation;
use Modules\Base\Services\Rows\Select;
use Modules\Base\Services\Rows\Text;
use Modules\Notifications\Entities\NotifiactionsTemplates;
use Modules\Notifications\Entities\UserNotification;
use Modules\Notifications\Services\SendNotification;
use Modules\Notifications\Vilt\Resources\NotificationsResource\Traits\Components;
use Modules\Notifications\Vilt\Resources\NotificationsResource\Traits\Methods;
use Modules\Notifications\Vilt\Resources\NotificationsResource\Traits\Translations;

class NotificationsResource extends Resource
{
    use Methods, Components, Translations;

    public ?string $model = UserNotification::class;
    public string $icon = "bx bxs-bell";
    public string $group = "Notifications";
    public ?bool $import = false;

    public function rows(): array
    {
        $this->canEdit = false;

        $types = [];
        foreach (config('notifications.models') as $key=>$type){
            $types[] = Option::make(__($key))->id($type)->api('model_id', $type, __($key));
        }

        return [
            Text::make('id')->label(__('ID'))->create(false)->edit(false),
            Select::make('template_id')->label(__('Template'))->validation("required|array")->options(NotifiactionsTemplates::where('action', 'manual')->get()->toArray())->trackByName('key'),

            Select::make('model_type')
                ->label(__('Type'))
                ->validation("required|array")
                ->options($types),

            Select::make('privacy')
                ->reactive()
                ->reactiveRow('model_type')
                ->label(__('Privacy'))->validation("required|array")->options([
                Option::make(__('Public'))->id('public'),
                Option::make(__('Private'))->id('private'),
            ]),

            HasOne::make('model_id')
                ->reactive()
                ->reactiveRow('privacy')
                ->reactiveBy('id')
                ->reactiveWhere('private')
                ->validation("nullable|array")
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
