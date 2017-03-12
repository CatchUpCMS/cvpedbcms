<?php namespace cms\Modules\Users\App\Providers;

//use CVEPDB\Settings\Facades\Settings;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

/**
 * Class UsersServiceProvider
 * @package cms\Modules\Users\App\Providers
 */
class UsersServiceProvider extends ServiceProvider
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
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();

        if (cmsinstalled()) {

            Route::group(['middleware' => ['web', 'user'], 'namespace' => 'cms\Modules\Users\Http\Controllers\Frontend'], function () {
                Route::get('/', ['as' => 'home', 'uses' => 'UsersController@index']);
            });

            /*
            if (true || Settings::get('users.users_module_as_home_page'))
                  {

                  }
            */

            Route::group(['middleware' => ['web'], 'namespace' => 'cms\Modules\Users\Http\Controllers\Frontend'], function () {
                // Registration routes...
                Route::get('register', 'RegisterController@showRegistrationForm');
                Route::post('register', 'RegisterController@register');
                // Register from social networks
                Route::get('register/{provider?}', ['uses' => 'RegisterController@getRegisterFromProvider']);
                Route::post('register/{provider?}', ['uses' => 'RegisterController@postRegisterFromProvider']);
            });


            /*
      if (Settings::get('users.is_registration_allowed'))
            {

            }
      */
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__ . '/../../Config/config.php' => config_path('users.php'),
        ]);
        $this->mergeConfigFrom(
            __DIR__ . '/../../Config/config.php', 'users'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = base_path('resources/views/modules/users');

        $sourcePath = __DIR__ . '/../../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ]);

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/users';
        }, \Config::get('view.paths')), [$sourcePath]), 'users');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = base_path('resources/lang/modules/users');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'users');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../../Resources/lang', 'users');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

}
