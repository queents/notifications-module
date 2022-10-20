<?php


namespace Modules\Notifications\Vilt\Resources\NotificationsResource\Actions;

use Modules\Base\Services\Components\Actions;

class LogAction extends Actions
{
    public function setup(): void
    {
        $this->name("log");
        $this->label(__('Log'));
        $this->type("success");
        $this->icon("");
        $this->modal(null);
        $this->action('notifications_logs.index', 'get');
        $this->url(null);
        $this->can(true);
    }
}

