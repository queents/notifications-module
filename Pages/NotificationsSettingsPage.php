<?php

namespace Modules\Notifications\Pages;

use Modules\Notifications\Settings\NotificationsSettings;
use Modules\Base\Services\Rows\Text;
use Modules\Settings\Services\Setting;


class NotificationsSettingsPage extends Setting
{
    public ?string $setting = NotificationsSettings::class;
    public ?bool $api = true;
    public ?string $path = "notifications";
    public ?string $group = "Settings";
    public ?string $icon = "bx bxs-circle";

    public  function rows(): array
    {
        return [
            Text::make('notifications_name')->label(__('Notifications Name')),
        ];
    }
}
