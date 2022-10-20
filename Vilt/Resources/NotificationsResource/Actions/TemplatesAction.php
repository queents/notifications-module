<?php


namespace Modules\Notifications\Vilt\Resources\NotificationsResource\Actions;

use Modules\Base\Services\Components\Actions;

class TemplatesAction extends Actions
{
    public function setup(): void
    {
        $this->name("templates");
        $this->label(__('Templates'));
        $this->type("success");
        $this->icon("");
        $this->modal(null);
        $this->action("notifiactions_templates.index", "get");
        $this->url(null);
        $this->can(true);
    }
}

