<?php namespace cms\Modules\Users\App\Providers;

use Illuminate\Support\ServiceProvider;
use cms\Modules\Users\App\Factories\SocialiteManagerFactory;

/**
 * Class SocialiteServiceProvider
 * @package cms\Modules\Users\App\Providers
 */
class SocialiteServiceProvider extends ServiceProvider
{

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		if (cmsinstalled())
		{
			$this->app->singleton('Laravel\Socialite\Contracts\Factory', function ($app)
			{
				return new SocialiteManagerFactory($app);
			});
		}
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return cmsinstalled()
			? ['Laravel\Socialite\Contracts\Factory']
			: [];
	}

}
