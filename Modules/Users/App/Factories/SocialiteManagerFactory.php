<?php namespace cms\Modules\Users\App\Factories;

use InvalidArgumentException;
use Illuminate\Support\Manager;
use Laravel\Socialite\Contracts\Factory;
use Laravel\Socialite\One\TwitterProvider;
use Laravel\Socialite\One\BitbucketProvider;
use League\OAuth1\Client\Server\Twitter as TwitterServer;
use League\OAuth1\Client\Server\Bitbucket as BitbucketServer;
use CVEPDB\Settings\Facades\Settings;

/**
 * Class SocialiteManagerFactory
 * @package cms\Modules\Users\App\Factories
 */
class SocialiteManagerFactory extends Manager implements Factory
{

	/**
	 * Get a driver instance.
	 *
	 * @param  string $driver
	 *
	 * @return mixed
	 */
	public function with($driver)
	{
		return $this->driver($driver);
	}

	/**
	 * Create an instance of the specified driver.
	 *
	 * @return \Laravel\Socialite\Two\AbstractProvider
	 */
	protected function createGithubDriver()
	{
		$config = $this->getConfig('github');

		return $this->buildProvider(
			'Laravel\Socialite\Two\GithubProvider',
			$config
		);
	}

	/**
	 * Create an instance of the specified driver.
	 *
	 * @return \Laravel\Socialite\Two\AbstractProvider
	 */
	protected function createFacebookDriver()
	{
		$config = $this->getConfig('facebook');

		return $this->buildProvider(
			'Laravel\Socialite\Two\FacebookProvider',
			$config
		);
	}

	/**
	 * Create an instance of the specified driver.
	 *
	 * @return \Laravel\Socialite\Two\AbstractProvider
	 */
	protected function createGoogleDriver()
	{
		$config = $this->getConfig('google');

		return $this->buildProvider(
			'Laravel\Socialite\Two\GoogleProvider',
			$config
		);
	}

	/**
	 * Create an instance of the specified driver.
	 *
	 * @return \Laravel\Socialite\Two\AbstractProvider
	 */
	protected function createLinkedinDriver()
	{
		$config = $this->getConfig('linkedin');

		return $this->buildProvider(
			'Laravel\Socialite\Two\LinkedInProvider',
			$config
		);
	}

	/**
	 * Build an OAuth 2 provider instance.
	 *
	 * @param  string $provider
	 * @param  array  $config
	 *
	 * @return \Laravel\Socialite\Two\AbstractProvider
	 */
	public function buildProvider($provider, $config)
	{
		return new $provider(
			$this->app['request'],
			$config['client_id'],
			$config['client_secret'],
			$config['redirect']
		);
	}

	/**
	 * Create an instance of the specified driver.
	 *
	 * @return \Laravel\Socialite\One\AbstractProvider
	 */
	protected function createTwitterDriver()
	{
		$config = $this->getConfig('twitter');

		return new TwitterProvider(
			$this->app['request'],
			new TwitterServer($this->formatConfig($config))
		);
	}

	/**
	 * Create an instance of the specified driver.
	 *
	 * @return \Laravel\Socialite\One\AbstractProvider
	 */
	protected function createBitbucketDriver()
	{
		$config = $this->getConfig('bitbucket');

		return new BitbucketProvider(
			$this->app['request'],
			new BitbucketServer($this->formatConfig($config))
		);
	}

	/**
	 * Format the server configuration.
	 *
	 * @param  array $config
	 *
	 * @return array
	 */
	public function formatConfig(array $config)
	{
		return array_merge([
			'identifier'   => $config['client_id'],
			'secret'       => $config['client_secret'],
			'callback_uri' => $config['redirect'],
		], $config);
	}

	/**
	 * Get the default driver name.
	 *
	 * @throws \InvalidArgumentException
	 *
	 * @return string
	 */
	public function getDefaultDriver()
	{
		throw new InvalidArgumentException('No Socialite driver was specified.');
	}

	/**
	 * Get provider config from settings.
	 *
	 * @param string $provider
	 *
	 * @return array
	 */
	private function getConfig($provider)
	{
		return [
			'client_id'     => Settings::get('services.' . $provider . '.client_id'),
			'client_secret' => Settings::get('services.' . $provider . '.client_secret'),
			'redirect'      => Settings::get('services.' . $provider . '.redirect'),
		];
	}
}
