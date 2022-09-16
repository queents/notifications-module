<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class NotificationsSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('notifications.notifications_name', '');
    }
}
