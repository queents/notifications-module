<?php

namespace Modules\Notifications\Vilt\Resources\NotificationsResource\Traits;

use Modules\Base\Services\Components\Base\Action;
use Modules\Base\Services\Components\Base\Component;
use Modules\Base\Services\Components\Base\Table;
use Modules\Menu\Vilt\Resources\MenuResource\Actions\GenerateMenuAction;
use Modules\Menu\Vilt\Resources\MenuResource\Routes\GenerateRoute;
use Modules\Notifications\Vilt\Resources\NotificationsResource\Actions\LogAction;
use Modules\Notifications\Vilt\Resources\NotificationsResource\Actions\TemplatesAction;
use Modules\Notifications\Vilt\Resources\TemplatesResource\Routes\SendRoute;

trait Components
{
    public function components(): array {
        return [
            Component::make(LogAction::class)->action(),
            Component::make(TemplatesAction::class)->action(),
        ];
    }
}
