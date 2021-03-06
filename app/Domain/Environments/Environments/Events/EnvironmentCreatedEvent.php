<?php namespace cms\Domain\Environments\Environments\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use cms\Infrastructure\Abstractions\Events\EventAbstract;
use cms\Domain\Environments\Environments\Environment;

/**
 * Class EnvironmentCreatedEvent
 * @package cms\Domain\Environments\Environments\Events
 */
class EnvironmentCreatedEvent extends EventAbstract
{

	use SerializesModels;

	/**
	 * The current environment.
	 *
	 * @var Environment|null
	 */
	public $environment = null;

	/**
	 * EnvironmentCreatedEvent constructor.
	 *
	 * @param Environment $environment
	 */
	public function __construct(Environment $environment)
	{
		$this->environment = $environment;
	}

	/**
	 * Get the channels the event should be broadcast on.
	 *
	 * @return array
	 */
	public function broadcastOn()
	{
		return [];
	}
}
