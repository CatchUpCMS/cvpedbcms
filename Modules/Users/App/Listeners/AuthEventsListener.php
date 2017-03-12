<?php

namespace cms\App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;

/**
 * Class AuthEventsListener
 * @package cms\App\Listeners
 */
class AuthEventsListener
{

	/**
	 * Register the listeners for the subscriber.
	 *
	 * @param  \Illuminate\Events\Dispatcher $events
	 */
	public function subscribe($events)
	{
		$events->listen(
			'Illuminate\Auth\Events\Login',
			'cms\App\Listeners\AuthEventsListener@handleLoginEvent'
		);
		$events->listen(
			'Illuminate\Auth\Events\Logout',
			'cms\App\Listeners\AuthEventsListener@handleLogoutEvent'
		);
	}

	/**
	 * Handle Login events.
	 *
	 * @param \Illuminate\Auth\Events\Login $event
	 */
	public function handleLoginEvent(Login $event)
	{
		session()->flash('message-success', trans('auth.login_message_success'));
	}

	/**
	 * Handle Logout events.
	 *
	 * @param \Illuminate\Auth\Events\Logout $event
	 */
	public function handleLogoutEvent(Logout $event)
	{
		session()->flash('message-success', trans('auth.logout_message_success'));
	}

}
