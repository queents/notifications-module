<?php

namespace Modules\Notifications\Vilt\Resources\TemplatesResource\Traits;

use Modules\Base\Services\Components\Base\Action;
use Modules\Base\Services\Components\Base\Component;
use Modules\Base\Services\Components\Base\Table;
use Modules\Menu\Vilt\Resources\MenuResource\Actions\GenerateMenuAction;
use Modules\Menu\Vilt\Resources\MenuResource\Routes\GenerateRoute;
use Modules\Notifications\Vilt\Resources\TemplatesResource\Actions\NotificationAction;
use Modules\Notifications\Vilt\Resources\TemplatesResource\Routes\SendRoute;

trait Components
{
    public function components(): array {
        return [
            Component::make(SendRoute::class)->route(),
            Component::make(NotificationAction::class)->action(),
        ];
    }

    public function table(): Table {
        return Table::make('table')->actions([
            Action::make('send')->label(__('Send'))->icon('bx bx-send')->type('primary')->action('notifiactions_templates.send')->confirmed(),
        ]);
    }
}
