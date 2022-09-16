<?php

use App\Models\User;

return [
    'name' => 'Notifications',

    'types' => [
        [
            "name" => "Alert",
            "id" => "alert",
            "color" => "#fff",
            "icon" => "bx bxs-user"
        ],
        [
            "name" => "Info",
            "id" => "info",
            "color" => "#fff",
            "icon" => "bx bxs-user"
        ],
        [
            "name" => "Danger",
            "id" => "danger",
            "color" => "#fff",
            "icon" => "bx bxs-user"
        ],
        [
            "name" => "Success",
            "id" => "success",
            "color" => "#fff",
            "icon" => "bx bxs-user"
        ],
        [
            "name" => "Warring",
            "id" => "warring",
            "color" => "#fff",
            "icon" => "bx bxs-user"
        ],
    ],

    'provider' => "pusher",

    'models' => [
        User::class
    ],

    'providers' => [
        [
            "name" => __('Database'),
            "id" => "database"
        ],
        [
            "name" => __('Email'),
            "id" => "email"
        ],
        [
            "name" => __('Slack'),
            "id" => "slack",
        ],
        [
            "name" => __('Discord'),
            "id" => "discord"
        ],
        [
            "name" => __('FCM Web'),
            "id" => "fcm-web"
        ],
        [
            "name" => __('FCM Mobile'),
            "id" => "fcm-api"
        ],
        [
            "name" => __('Pusher Web'),
            "id" => "pusher-web"
        ],
        [
            "name" => __('Pusher Mobile'),
            "id" => "pusher-api"
        ],
        [
            "name" => __('SMS MessageBird'),
            "id" => "sms-messagebird"
        ]
    ],
];
