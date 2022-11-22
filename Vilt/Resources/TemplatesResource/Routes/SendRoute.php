<?php


namespace Modules\Notifications\Vilt\Resources\TemplatesResource\Routes;
use Modules\Notifications\Vilt\Resources\TemplatesResource;

use Modules\Base\Services\Components\Routes;

class SendRoute extends Routes
{
    public function setup(): void
    {
         $this->name('send');
         $this->type('post');
         $this->method('send');
         $this->controller(TemplatesResource::class);
         $this->path('send');
    }
}

