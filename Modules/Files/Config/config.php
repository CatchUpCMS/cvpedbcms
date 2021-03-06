<?php

return [
    'name' => 'Files',
    'admin' => [
        'sidebar' => [
            'shortcuts' => [
                'route' => null,
                'icon' => null,
            ],
            'menu' => [
                'route' => 'backend.files.index',
                'icon' => 'fa fa-folder',
            ],
            'settings' => [
                'route' => 'backend.files.settings.index',
                'icon' => 'fa fa-folder',
            ]
        ]
    ],
    'amazon' => [
        'region' => [
            'us-east-1' => 'US East (N. Virginia)',
            'us-west-1' => 'US West (N. California)',
            'us-west-2' => 'US West (Oregon)',
            'eu-west-1' => 'EU (Ireland)',
            'eu-central-1' => 'EU (Frankfurt)',
            'ap-northeast-1' => 'Asia Pacific (Tokyo)',
            'ap-northeast-2' => 'Asia Pacific (Seoul)',
            'ap-southeast-1' => 'Asia Pacific (Singapore)',
            'ap-southeast-2' => 'Asia Pacific (Sydney)',
            'sa-east-1' => 'South America (São Paulo)'
        ]
    ],
    'front' => [
        'users' => [
            'dashboard' => [
                'widgets' => [
                ]
            ]
        ]
    ],
];
