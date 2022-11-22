<?php

namespace Modules\Notifications\Vilt\Resources;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Base\Services\Resource\Resource;
use Modules\Base\Services\Rows\Date;
use Modules\Base\Services\Rows\DateTime;
use Modules\Base\Services\Rows\Select;
use Modules\Base\Services\Rows\Text;
use Modules\Notifications\Entities\NotificationsLogs;
use Modules\Notifications\Vilt\Resources\NotificationsLogsResource\Traits\Methods;
use Modules\Notifications\Vilt\Resources\NotificationsLogsResource\Traits\Translations;
use Modules\Notifications\Vilt\Resources\NotificationsLogsResource\Traits\Components;

class NotificationsLogsResource extends Resource
{

    use Components, Translations, Methods;

    public ?string $model = NotificationsLogs::class;
    public string $icon = "bx bx-history";
    public string $group = "Notifications";
    public ?bool $import = false;
    public ?bool $menu = false;

    public function rows(): array
    {
        $this->canCreate = false;
        $this->canEdit = false;
        return [
            Text::make('id')->label(__('Id '))->create(false)->edit(false),
            Text::make('model_type')->list(false)->view(false)->label(__('Model Type ')),
            Select::make('model_id')->options([])->label(__('User')),
            Text::make('title')->label(__('Title ')),
            Text::make('description')->list(false)->label(__('Description ')),
            Text::make('type')->list(false)->label(__('Type ')),
            Text::make('provider')->label(__('Provider')),
            DateTime::make('created_at')->label(__('Date')),
        ];
    }
}
