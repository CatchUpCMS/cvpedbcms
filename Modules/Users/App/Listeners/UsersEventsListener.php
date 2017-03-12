<?php namespace cms\App\Listeners;

use cms\Domain\Environments\Environments\Events\EnvironmentCreatedEvent;
use cms\Domain\Users\Users\Events\UserCreatedEvent;
use cms\Domain\Users\Users\Events\UserUpdatedEvent;
use cms\Domain\Users\Users\Events\UserDeletedEvent;
use cms\Domain\Users\Users\Events\NewUserRegisteredEvent;

/**
 * Class UserEventsListener
 * @package cms\App\Listeners
 */
class UsersEventsListener
{

	/**
	 * Register the listeners for the subscriber.
	 *
	 * @param  \Illuminate\Events\Dispatcher $events
	 */
	public function subscribe($events)
	{
		$events->listen(
			'cms\Domain\Users\Users\Events\UserCreatedEvent',
			'cms\App\Listeners\UsersEventsListener@handleUserCreatedEvent'
		);
		$events->listen(
			'cms\Domain\Users\Users\Events\UserUpdatedEvent',
			'cms\App\Listeners\UsersEventsListener@handleUserUpdatedEvent'
		);
		$events->listen(
			'cms\Domain\Users\Users\Events\UserDeletedEvent',
			'cms\App\Listeners\UsersEventsListener@handleUserDeletedEvent'
		);
		$events->listen(
			'cms\Domain\Users\Users\Events\NewUserRegisteredEvent',
			'cms\App\Listeners\UsersEventsListener@newUserRegisteredEvent'
		);
	}

	/**
	 * Handle created event.
	 *
	 * @param UserCreatedEvent $event
	 */
	public function handleUserCreatedEvent(UserCreatedEvent $event)
	{
		session()->flash('message-success', trans('users.message_created_success'));
	}

	/**
	 * Handle updated event.
	 *
	 * @param UserUpdatedEvent $event
	 */
	public function handleUserUpdatedEvent(UserUpdatedEvent $event)
	{
		session()->flash('message-success', trans('users.message_updated_success'));
	}

	/**
	 * Handle deleted event.
	 *
	 * @param UserDeletedEvent $event
	 */
	public function handleUserDeletedEvent(UserDeletedEvent $event)
	{
		session()->flash('message-success', trans('users.message_deleted_success'));
	}

	/**
	 * Handle newUserRegisteredEvent events.
	 *
	 * @param EnvironmentCreatedEvent $event
	 */
	public function newUserRegisteredEvent(NewUserRegisteredEvent $event)
	{
		session()->flash('message-success', trans('auth.message_success_register'));
	}

}