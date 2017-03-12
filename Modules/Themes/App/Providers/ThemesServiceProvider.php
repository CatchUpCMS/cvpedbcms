<?php namespace cms\Modules\Themes\App\Providers;

use CVEPDB\Themes\App\Providers\ThemesServiceProvider as CVEPDBThemesServiceProvider;
use Illuminate\View\FileViewFinder;
use CVEPDB\Themes\App\Facades\ThemeFacade;

//use CVEPDB\Settings\Facades\Settings;

/**
 * Class ThemesServiceProvider
 * @package cms\Modules\Themes\App\Providers
 */
class ThemesServiceProvider extends CVEPDBThemesServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->overrideViewPath();
        $this->setActiveTheme();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        parent::register();
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__ . '/../../Config/config.php' => config_path('themes.php'),
        ]);
        $this->mergeConfigFrom(
            __DIR__ . '/../../Config/config.php', 'themes'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = base_path('resources/views/modules/themes');

        $sourcePath = __DIR__ . '/../../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ]);

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/themes';
        }, \Config::get('view.paths')), [$sourcePath]), 'themes');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = base_path('resources/lang/modules/themes');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'themes');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../../Resources/lang', 'themes');
        }
    }

    /**
     * Override view path.
     */
    protected function overrideViewPath()
    {
        $this->app->bind('view.finder', function ($app) {

            $paths = [];
            $themes = [];

            foreach (ThemeFacade::all() as $theme) {
                $themes[] = $theme->name;
            }

            foreach ($themes as $theme) {
                $themePath = $app['config']['themes.path'] . '/' . $theme . '/views';

                if (is_dir($themePath)) {
                    $paths[] = $themePath;
                }
            }

            return new FileViewFinder($app['files'], $paths);
        });
    }

    /**
     * Set the active theme based on the settings
     */
    private function setActiveTheme()
    {
        if (cmsinstalled()) {
            $theme = '';
            if ($this->inAdministration() || $this->inInstaller()) {
                $theme = 'adminlte';
            } else {
                $theme = 'lumen';
            }
            ThemeFacade::setCurrent($theme);
        } else {
            ThemeFacade::setCurrent(config('themes.themes.backend'));
        }
    }

    /**
     * Check if we are in the administration section
     * @return bool
     */
    private function inAdministration()
    {
        return $this->app->make('request')->is(config('cms.uri.backend'))
        || $this->app->make('request')->is(config('cms.uri.backend') . '/*');
    }

    /**
     * Check if we are in the installer section
     * @return bool
     */
    private function inInstaller()
    {
        return $this->app->make('request')->is(config('cms.uri.installer'))
        || $this->app->make('request')->is(config('cms.uri.installer') . '/*');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return parent::provides();
    }
}
