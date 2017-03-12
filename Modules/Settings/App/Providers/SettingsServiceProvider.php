<?php namespace cms\Modules\Settings\App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class SettingsServiceProvider
 * @package cms\Modules\Settings\App\Providers
 */
class SettingsServiceProvider extends ServiceProvider
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
			__DIR__ . '/../../Config/config.php' => config_path('settings.php'),
		]);
		$this->mergeConfigFrom(
			__DIR__ . '/../../Config/config.php', 'settings'
		);
	}

	/**
	 * Register views.
	 *
	 * @return void
	 */
	public function registerViews()
	{
		$viewPath = base_path('resources/views/modules/settings');

		$sourcePath = __DIR__ . '/../../Resources/views';

		$this->publishes([
			$sourcePath => $viewPath
		]);

		$this->loadViewsFrom(array_merge(array_map(function ($path)
		{
			return $path . '/modules/settings';
		}, \Config::get('view.paths')), [$sourcePath]), 'settings');
	}

	/**
	 * Register translations.
	 *
	 * @return void
	 */
	public function registerTranslations()
	{
		$langPath = base_path('resources/lang/modules/settings');

		if (is_dir($langPath))
		{
			$this->loadTranslationsFrom($langPath, 'settings');
		}
		else
		{
			$this->loadTranslationsFrom(__DIR__ . '/../../Resources/lang', 'settings');
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
