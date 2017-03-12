<?php

use Illuminate\Support\Facades\Auth;
use cms\App\Facades\Environments;
use cms\Domain\Environments\Environments\Repositories\EnvironmentsRepositoryEloquent;

if (!function_exists('slugify')) {
    /**
     * @param $text
     *
     * @return bool|mixed|string
     */
    function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

        // trim
        $text = trim($text, '-');

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}

if (!function_exists('css_file_rev')) {
    /**
     * @param $file
     *
     * @return mixed
     */
    function css_file_rev($file)
    {
        $current_theme = \Theme::getCurrent();
        $list = json_decode(\File::get(base_path() . '/public/themes/' . $current_theme . '/rev/css.manifest.json'));

        return $list->{$file};
    }
}

if (!function_exists('cmsview')) {
    /**
     * @param       $view
     * @param array $data
     * @param null $view_prefix
     * @param null $current_module
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function cmsview(
        $view,
        $data = [],
        $current_module = null,
        $view_prefix = null
    )
    {
        if (is_null($view_prefix)) {
            $view_prefix = \Theme::getCurrent() . '::';
        }

        $current_prefix = $view_prefix;

        try {
            \Theme::view($view);
        } catch (\InvalidArgumentException $e) {
            // xABE Todo : Here if we use an empty string, the view is loaded
            // xABE Todo : from /resources/views - Add a settings to allow this.
            $current_prefix = $current_module;
        }

        return view($current_prefix . $view, $data);
    }
}

if (!function_exists('cmsview_prefix')) {
    /**
     * @param      $view
     * @param null $view_prefix
     * @param null $current_module
     *
     * @return null|string
     */
    function cmsview_prefix($view, $view_prefix = null, $current_module = null)
    {
        if (is_null($view_prefix)) {
            $view_prefix = \Theme::getCurrent() . '::';
        }

        $current_prefix = $view_prefix;

        try {
            \Theme::view($view);
        } catch (\InvalidArgumentException $e) {
            $current_prefix = $current_module;
        }

        return $current_prefix;
    }
}

if (!function_exists('cmsinstalled')) {
    /**
     * Allow to know if CMS is installed.
     *
     * @return bool True if CMS installed
     */
    function cmsinstalled()
    {
        return env('APP_INSTALLED', false);
    }
}

if (!function_exists('cms_is_superadmin')) {
    /**
     * @return boolean
     */
    function cms_is_superadmin()
    {
        return \Gate::allows(
            \cms\Domain\Users\Users\User::ROLE_SUPERADMIN
        );
    }
}

if (!function_exists('cms_is_admin')) {
    /**
     * @return boolean
     */
    function cms_is_admin()
    {
        return \Gate::allows(
            \cms\Domain\Users\Users\User::ROLE_ADMIN
        );
    }
}

if (!function_exists('cms_is_moderator')) {
    /**
     * @return boolean
     */
    function cms_is_moderator()
    {
        return \Gate::allows(
            \cms\Domain\Users\Users\User::ROLE_MODERATOR
        );
    }
}

if (!function_exists('cms_is_user')) {
    /**
     * @return boolean
     */
    function cms_is_user()
    {
        return \Gate::allows(
            \cms\Domain\Users\Users\User::ROLE_USER
        );
    }
}

if (!function_exists('cms_route_frontend')) {
    /**
     * @return string
     */
    function cms_route_frontend()
    {
        if (false === env('CMS_INSTALLED', false)) {
            return \Config::get('cms.frontend.home_route');
        }

        return \Settings::get('cms.frontend.home_route');
    }
}

if (!function_exists('cms_route_backend')) {
    /**
     * @return string
     */
    function cms_route_backend()
    {
        if (false === env('CMS_INSTALLED', false)) {
            return \Config::get('cms.backend.home_route');
        }

        return \Settings::get('cms.backend.home_route');
    }
}
