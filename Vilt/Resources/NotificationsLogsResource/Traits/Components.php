<?php

namespace Modules\Notifications\Vilt\Resources\NotificationsLogsResource\Traits;

use Modules\Base\Services\Components\Base\Action;
use Modules\Base\Services\Components\Base\Component;
use Modules\Notifications\Vilt\Resources\NotificationsLogsResource\Actions\NotificationAction;

trait Components
{
    public function components(): array {
        return [
            Component::make(NotificationAction::class)->action(),
        ];
    }
}
