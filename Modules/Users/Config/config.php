<?php

return [
    'name' => 'Users',
    'admin' => [
        'sidebar' => [
            'shortcuts' => [
                'route' => 'backend.users.create',
                'icon' => 'fa fa-user-plus',
            ],
            'menu' => [
                'route' => 'backend.users.index',
                'icon' => 'fa fa-users',
            ],
            'settings' => [
                'route' => 'backend.users.settings.index',
                'icon' => 'fa fa-users',
            ]
        ],
        'dashboard' => [
            'widgets' => [
                'count_users',
                'export_users',
            ]
        ]
    ],
    'is_registration_allowed' => true,
    'is_role_management_allowed' => true,
    'social' => [
        'login' => []
    ],
    'front' => [
        'users' => [
            'dashboard' => [
                'widgets' => [
                    'profile_users',
                    'social_buttons'
                ]
            ]
        ]
    ],
];
