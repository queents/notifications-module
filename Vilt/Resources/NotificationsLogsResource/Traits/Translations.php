<?php


namespace Modules\Notifications\Vilt\Resources\NotificationsLogsResource\Traits;

trait Translations
{
    public function loadTranslations(): array
    {
        return [
            "index" => __(" Notifications Log"),
            "create" => __('Create ' . " Notification Log"),
            "bulk" => __('Delete Selected ' . " Notification Log"),
            "edit_title" => __('Edit ' . " Notification Log"),
            "create_title" => __('Create New ' . " Notification Log"),
            "view_title" => __('View ' . " Notification Log"),
            "delete_title" => __('Delete ' . " Notification Log"),
            "bulk_title" => __('Run Bulk Action To ' . " Notification Log"),
        ];
    }
}

