<?php

return [

    'default' => 'adminlte',

    'path' => base_path('resources/themes'),

    'config' => 'theme.json',

    'cache' => [
        'enabled' => false,
        'key' => 'pingpong.themes',
        'lifetime' => 86400,
    ],

    'bower' => [
        'binary_path' => '/vendor/bin',
        'is_active' => false
    ],

];
