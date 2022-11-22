<?php

namespace Modules\Notifications\Pages;

use Modules\Base\Services\Rows\Toggle;
use Modules\Notifications\Settings\NotificationsSettings;
use Modules\Base\Services\Rows\Text;
use Modules\Settings\Services\Setting;


class NotificationsSettingsPage extends Setting
{
    public ?string $setting = NotificationsSettings::class;
    public ?bool $api = true;
    public ?string $path = "notifications";
    public ?string $group = "Notifications";
    public ?string $icon = "bx bxs-cog";

    public  function rows(): array
    {
        return [
            Toggle::make('notifications_allow')->label(__('Notifications Allow')),
            Text::make('fcm_apiKey')->label(__('FCM apiKey')),
            Text::make('fcm_authDomain')->label(__('FCM authDomain')),
            Text::make('fcm_projectId')->label(__('FCM projectId')),
            Text::make('fcm_storageBucket')->label(__('FCM storageBucket')),
            Text::make('fcm_messagingSenderId')->label(__('FCM messagingSenderId')),
            Text::make('fcm_appId')->label(__('FCM appId')),
            Text::make('fcm_measurementId')->label(__('FCM measurementId')),
        ];
    }
}
