<?php


namespace Modules\Notifications\Vilt\Resources\TemplatesResource\Actions;

use Modules\Base\Services\Components\Actions;

class NotificationAction extends Actions
{
    public function setup(): void
    {
        $this->name("notification");
        $this->label(__('Back'));
        $this->type("success");
        $this->icon("");
        $this->modal(null);
        $this->action("user_notifications.index", "get");
        $this->url(null);
        $this->can(true);
    }
}

