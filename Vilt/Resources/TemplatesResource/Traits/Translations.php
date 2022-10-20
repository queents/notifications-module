<?php


namespace Modules\Notifications\Vilt\Resources\TemplatesResource\Traits;

trait Translations
{
    public function loadTranslations(): array
    {
        return [
            "index" => __(" Notifications Templates"),
            "create" => __('Create ' . " Template"),
            "bulk" => __('Delete Selected ' . " Template"),
            "edit_title" => __('Edit ' . " Template"),
            "create_title" => __('Create New ' . " Template"),
            "view_title" => __('View ' . " Template"),
            "delete_title" => __('Delete ' . " Template"),
            "bulk_title" => __('Run Bulk Action To ' . " Template"),
        ];
    }
}

