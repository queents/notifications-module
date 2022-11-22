<?php


namespace Modules\Notifications\Vilt\Resources\NotificationsResource\Traits;

trait Translations
{
    public function loadTranslations(): array
    {
        return [
            "index" => __(" Notifications"),
            "create" => __('Create ' . " Notification"),
            "bulk" => __('Delete Selected ' . " Notification"),
            "edit_title" => __('Edit ' . " Notification"),
            "create_title" => __('Create New ' . " Notification"),
            "view_title" => __('View ' . " Notification"),
            "delete_title" => __('Delete ' . " Notification"),
            "bulk_title" => __('Run Bulk Action To ' . " Notification"),
        ];
    }
}

