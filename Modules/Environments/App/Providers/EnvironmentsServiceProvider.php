<?php namespace cms\Modules\Environments\App\Providers;

use Illuminate\Foundation\AliasLoader;
use CVEPDB\Settings\Cache;
use CVEPDB\Settings\SettingsServiceProvider;
use cms\Modules\Environments\App\Services\Environment;
use cms\Modules\Environments\Domain\Environments\Settings\Repositories\SettingsRepository;

/**
 * Class EnvironmentsServiceProvider
 * @package cms\Modules\Environments\App\Providers
 */
class EnvironmentsServiceProvider extends SettingsServiceProvider
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
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['environment'] = $this->app->share(function ($app)
		{
			return new Environment($app['db'], []);
		});

		AliasLoader::getInstance([
			'Environments' => \cms\Modules\Environments\App\Facades\Environments::class
		])
			->register();

		$this->mergeConfigFrom(
			base_path('vendor/cvepdb/laravel-settings/src/config/settings.php'),
			'settings'
		);

		$this->app['settings'] = $this->app->share(function ($app)
		{
			$config = $app->config->get('settings', [
				'cache_file' => storage_path('settings.json'),
				'db_table'   => 'settings'
			]);

			return new SettingsRepository(
				$app['db'],
				new Cache($config['cache_file']),
				$config
			);
		});

		AliasLoader::getInstance([
			'Settings' => \CVEPDB\Settings\Facades\Settings::class
		])
			->register();
	}

	/**
	 * Register config.
	 *
	 * @return void
	 */
	protected function registerConfig()
	{
		$this->publishes([
			__DIR__ . '/../../Config/config.php' => config_path('environments.php'),
		]);
		$this->mergeConfigFrom(
			__DIR__ . '/../../Config/config.php', 'environments'
		);
	}

	/**
	 * Register views.
	 *
	 * @return void
	 */
	public function registerViews()
	{
		$viewPath = base_path('resources/views/modules/environments');

		$sourcePath = __DIR__ . '/../../Resources/views';

		$this->publishes([
			$sourcePath => $viewPath
		]);

		$this->loadViewsFrom(array_merge(array_map(function ($path)
		{
			return $path . '/modules/environments';
		}, \Config::get('view.paths')), [$sourcePath]), 'environments');
	}

	/**
	 * Register translations.
	 *
	 * @return void
	 */
	public function registerTranslations()
	{
		$langPath = base_path('resources/lang/modules/environments');

		if (is_dir($langPath))
		{
			$this->loadTranslationsFrom($langPath, 'environments');
		}
		else
		{
			$this->loadTranslationsFrom(__DIR__ . '/../../Resources/lang', 'environments');
		}
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return ['environment', 'settings'];
	}

}
