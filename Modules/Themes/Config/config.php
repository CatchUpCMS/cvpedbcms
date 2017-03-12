<?php

return [
    'name' => 'Themes',
    'admin' => [
        'sidebar' => [
            'settings' => [
                'icon' => 'fa fa-paint-brush',
                'route' => 'backend.themes.index',
            ]
        ]
    ],
    'themes' => [
        'frontend' => 'lumen',
        'backend' => 'adminlte'
    ],
];
