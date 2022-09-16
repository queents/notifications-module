<?php

namespace Modules\Notifications\Services\Concerns;

trait HasTemplateModel
{
    /**
     * @var object|null
     */
    public ?object $templateModel = null;

    /**
     * @param ?object $templateModel
     * @return static
     */
    public function templateModel(?object $templateModel): static {
        $this->templateModel = $templateModel;
        return $this;
    }
}
