<?php

namespace Modules\Notifications\Settings;

use Spatie\LaravelSettings\Settings;

class NotificationsSettings extends Settings
{
    public string $notifications_name = '';

    public static function group(): string
    {
        return 'notifications';
    }
}
