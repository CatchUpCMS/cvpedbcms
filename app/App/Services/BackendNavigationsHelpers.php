<?php

if (!function_exists('backend_menu_header')) {
    /**
     * Helper to display the header menu in Backend theme.
     *
     * @return string
     */
    function backend_menu_header()
    {
        $modules_list = \Module::getOrdered();

        \Menu::create(
            'header_navigation',
            function ($menu) use ($modules_list) {

                $menu->route(
                    cms_route_backend(),
                    trans('menus.dashboard'),
                    [],
                    [
                        'icon' => 'fa fa-dashboard',
                    ]
                );

                $menu->route(
                    cms_route_frontend(),
                    trans('menus.view_website'),
                    [],
                    [
                        'icon' => 'fa fa-globe',
                        'target' => '_blank',
                    ]
                );

                if (cms_is_admin()) {
                    $menu->dropdown(
                        trans('global.shortcuts'),
                        function ($submenu) use ($modules_list) {
                            $i = 0;

                            foreach ($modules_list as $module) {
                                $is_allowed_to_display = true;

                                $config_base_tag = strtolower($module->name) . '.admin.sidebar.shortcuts.';
                                $route = \Settings::get($config_base_tag . 'route');
                                $roles = \Settings::get($config_base_tag . 'roles');

                                if (!empty($roles)) {
                                    $is_allowed_to_display = false;

                                    foreach ($roles as $role) {
                                        if (\Gate::allows($role)) {
                                            $is_allowed_to_display = true;
                                            break;
                                        }
                                    }
                                }

                                if (!is_null($route) && $is_allowed_to_display) {
                                    if ($i) {
                                        $submenu->divider();
                                    }

                                    $submenu->route(
                                        $route,
                                        $module->name,
                                        [],
                                        [
                                            'icon' => \Settings::get($config_base_tag . 'icon')
                                        ]
                                    );

                                    $i++;
                                }
                            }

                        },
                        [],
                        [
                            'icon' => 'fa fa-fast-forward'
                        ]
                    );
                }
            });

        return \Menu::render(
            'header_navigation',
            settings('cms.backend.menus.header.presenters.web')
        );
    }
}

if (!function_exists('backend_menu_front_mobile')) {
    /**
     * Helper to display the header menu in backend theme for mobile.
     *
     * @return string
     */
    function backend_menu_mobile()
    {
        \Menu::create(
            'header_navigation_mobile',
            function ($menu) {

                $menu->route(
                    cms_route_backend(),
                    trans('menus.dashboard'),
                    [],
                    [
                        'icon' => 'fa fa-dashboard',
                    ]
                );

            }
        );

        return \Menu::render(
            'header_navigation_mobile',
            settings('cms.backend.menus.header.presenters.mobile')
        );
    }
}

if (!function_exists('backend_menu_sidebar')) {
    /**
     * Helper to display the sidebar menu in backend theme.
     *
     * @return string
     */
    function backend_menu_sidebar()
    {
        $modules_list = \Module::getOrdered();

        \Menu::create(
            'sidebar_navigation',
            function ($menu) use ($modules_list) {
                $menu->route(
                    cms_route_backend(),
                    trans('menus.dashboard'),
                    [],
                    [
                        'icon' => 'fa fa-dashboard',
                    ]
                );

                $menu->header(trans('menus.main_navigation'));

                foreach ($modules_list as $module) {
                    $is_allowed_to_display = true;

                    $config_base_tag = strtolower($module->name) . '.admin.sidebar.menu.';
                    $route = \Settings::get($config_base_tag . 'route');
                    $roles = \Settings::get($config_base_tag . 'roles');

                    if (!empty($roles)) {
                        $is_allowed_to_display = false;

                        foreach ($roles as $role) {
                            if (\Gate::allows($role)) {
                                $is_allowed_to_display = true;
                                break;
                            }
                        }
                    }

                    if (!is_null($route) && $is_allowed_to_display) {
                        $menu->route(
                            $route,
                            $module->name,
                            [],
                            [
                                'icon' => \Settings::get($config_base_tag . 'icon')
                            ]
                        );
                    }
                }

                if (cms_is_admin()) {
                    $menu->header(trans('global.settings'));

                    if (cms_is_superadmin()) {
                        $menu->route(
                            'backend.environments.index',
                            trans('global.environment_s'),
                            [],
                            [
                                'icon' => 'fa fa-cubes'
                            ]
                        );
                    }

                    $menu->dropdown(
                        trans('global.settings'),
                        function ($submenu) use ($modules_list) {

                            foreach ($modules_list as $module) {
                                $is_allowed_to_display = true;

                                $config_base_tag = strtolower($module->name) . '.admin.sidebar.settings.';
                                $route = \Settings::get($config_base_tag . 'route');
                                $roles = \Settings::get($config_base_tag . 'roles');

                                if (!empty($roles)) {
                                    $is_allowed_to_display = false;

                                    foreach ($roles as $role) {
                                        if (\Gate::allows($role)) {
                                            $is_allowed_to_display = true;
                                            break;
                                        }
                                    }
                                }

                                if (!is_null($route) && $is_allowed_to_display) {
                                    $submenu->route(
                                        $route,
                                        $module->name,
                                        [],
                                        [
                                            'icon' => \Settings::get($config_base_tag . 'icon')
                                        ]
                                    );
                                }
                            }
                        },
                        [],
                        [
                            'icon' => 'fa fa-gears'
                        ]
                    );
                }
            });

        return \Menu::render(
            'sidebar_navigation',
            settings('cms.backend.menus.sidebar.presenters')
        );
    }
}
