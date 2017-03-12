<?php

return [
    'version' => '0.1.0',
    'site' => [
        'name' => env('APP_SITE_NAME'),
        'description' => env('APP_SITE_DESCRIPTION'),
    ],
    'uri' => [
        'backend' => env('APP_URI_BACKEND', 'backend'),
        'installer' => env('APP_URI_INSTALLER', 'installer'),
    ],
    'languages' => [
        'fr',
        'en'
    ],
    'frontend' => [
        'home_route' => 'users.my-profile',
    ],
    'backend' => [
        'home_route' => 'backend.environments.index',
        'menus' => [
            'header' => [
                // Presenter to display admin CMS header menu
                'presenters' => [
                    'web' => '\cms\App\Presenters\AdminLteMenuAppHeaderPresenter',
                    'mobile' => '\cms\App\Presenters\AdminLteMenuFrontHeaderPresenter'
                ]
            ],
            'sidebar' => [
                // Presenter to display admin CMS sidebar
                'presenters' => '\cms\App\Presenters\AdminLteMenuAppSidebarPresenter',
            ],
        ],
    ],
    'mail' => [
        'mailwatch' => '',
    ],
    /*
     * When generation a random password, we use this length
     */
    'password_length' => 8,
    'licenses' => [
        'cvepdb' => [
            'name' => '#CVEPDB',
            'url' => 'http://cvepdb.fr',
        ],
        'phpcli' => '#CVEPDB CMS  Copyright (C) 2016  Antoine Benevaut

This program comes with ABSOLUTELY NO WARRANTY;
This is free software, and you are welcome to redistribute it
under certain conditions; visit https://gitlab.com/cvepdb/cms/wikis/license for details.',
        'web' => '#CVEPDB CMS is a content manager system build for final user, so you don\'t need to be developper to use it.

Copyright (C) 2016  Antoine Benevaut

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.',
    ],
];
