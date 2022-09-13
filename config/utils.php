<?php

return [
    'ip_api' => [
        'id' => env('IP_API_ID'),
        'secret' => env('IP_API_SECRET')
    ],

    'qcloud' => [
        'id' => env('QCLOUD_APP_ID'),
        'key' => env('QCLOUD_APP_KEY'),
    ],

    'site-info' => [
        'icp-no' => env('ICP_NO'),
        'crop-name' => env('CROP_NAME')
    ],

    'default' => [
        'password' => [
            'root' => env('DEFAULT_ROOT_PASSWORD'),
            'user' => env('DEFAULT_USER_PASSWORD'),
        ]
    ]
];
