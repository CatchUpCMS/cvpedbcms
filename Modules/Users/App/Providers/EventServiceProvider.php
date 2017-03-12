<?php namespace cms\Modules\Users\App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

/**
 * Class EventServiceProvider
 * @package cms\Modules\Users\App\Providers
 */
class EventServiceProvider extends ServiceProvider
{

	/**
	 * The event listener mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [


		// xABE todo : mail to new added user

	];

	/**
	 * Register any other events for your application.
	 *
	 * @param  \Illuminate\Contracts\Events\Dispatcher $events
	 *
	 * @return void
	 */
	public function boot()
	{
		parent::boot();
	}

}
