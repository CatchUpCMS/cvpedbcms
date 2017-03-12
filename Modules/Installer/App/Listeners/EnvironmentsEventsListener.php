<?php namespace cms\App\Listeners;

use Illuminate\Support\Facades\File;
use cms\Domain\Environments\Environments\Events\EnvironmentCreatedEvent;
use cms\Domain\Environments\Environments\Events\EnvironmentDeletedEvent;
use cms\Domain\Files\Files\Repositories\ElFinderDiskRepository;
use cms\Domain\Environments\Environments\Repositories\EnvironmentsRepositoryEloquent;
use cms\Domain\Users\Roles\Repositories\RolesRepositoryEloquent;
use cms\Domain\Users\Permissions\Repositories\PermissionsRepositoryEloquent;

/**
 * Class EnvironmentsEventsListener
 * @package cms\App\Listeners
 */
class EnvironmentsEventsListener
{

	/**
	 * @var ElFinderDiskRepository|null
	 */
	private $r_disk = null;

	/**
	 * EnvironmentEventListener constructor.
	 *
	 * @param ElFinderDiskRepository $r_disk
	 */
	public function __construct(ElFinderDiskRepository $r_disk)
	{
		$this->r_disk = $r_disk;
	}

	/**
	 * Register the listeners for the subscriber.
	 *
	 * @param  \Illuminate\Events\Dispatcher $events
	 */
	public function subscribe($events)
	{
		$events->listen(
			'cms\Domain\Environments\Environments\Events\EnvironmentCreatedEvent',
			'cms\App\Listeners\EnvironmentsEventsListener@environmentCreatedEvent'
		);
		$events->listen(
			'cms\Domain\Environments\Environments\Events\EnvironmentDeletedEvent',
			'cms\App\Listeners\EnvironmentsEventsListener@environmentDeletedEvent'
		);
	}

	/**
	 * Handle EnvironmentCreatedEvent events.
	 *
	 * Set directories access for default and new environment.
	 *
	 * @param EnvironmentCreatedEvent $event
	 */
	public function environmentDeletedEvent(EnvironmentDeletedEvent $event)
	{
		/**
		 * Set all environment disks in readonly on the default environment
		 */

		$env_disks = $this->r_disk->getElFinderDisks($event->environment->reference);
		$default_disks = $this->r_disk->getElFinderDisks(EnvironmentsRepositoryEloquent::DEFAULT_ENVIRONMENT_REFERENCE);

		foreach ($env_disks as $disk_key => $options)
		{
			$options['access']['readonly'] = true;

			if (array_key_exists($disk_key, $default_disks))
			{
				$this->r_disk->unmountElFinderDisk(
					$disk_key,
					EnvironmentsRepositoryEloquent::DEFAULT_ENVIRONMENT_REFERENCE
				);
				$this->r_disk->mountElFinderDisk(
					$disk_key,
					$options,
					EnvironmentsRepositoryEloquent::DEFAULT_ENVIRONMENT_REFERENCE
				);
			}

		}
	}

	/**
	 * Handle EnvironmentCreatedEvent events.
	 *
	 * Set directories access for default and new environment.
	 *
	 * @param EnvironmentCreatedEvent $event
	 */
	public function environmentCreatedEvent(EnvironmentCreatedEvent $event)
	{
		$this->environmentCreateDisk($event, 'uploads');
		$this->environmentCreateDisk($event, 'medias');
	}

	/**
	 * @param EnvironmentCreatedEvent $event
	 */
	protected function environmentCreateDisk(EnvironmentCreatedEvent $event, $disk_name)
	{
		$disk_key = $event->environment->reference . '_' . $disk_name;

		$env_directory = storage_path(
			$disk_name . '/' . $event->environment->reference
		);

		if (!File::exists(storage_path($disk_name)))
		{
			File::makeDirectory(storage_path($disk_name), 0777);
		}

		if (!File::exists(
			storage_path($disk_name . '/' . $event->environment->reference)
		)
		)
		{
			File::makeDirectory(
				storage_path($disk_name . '/' . $event->environment->reference),
				0777
			);
		}

		if (!File::exists($env_directory))
		{
			File::makeDirectory($env_directory, 0777);
		}

		/*
		 * Attach new environment directory to the new env
		 */

		$this->r_disk->setDefaultFileSystemDisk(
			$disk_key,
			$event->environment->reference
		);

		$this->r_disk->addFileSystemDisk(
			$disk_key,
			[
				'driver' => 'local',
				'root'   => $env_directory,
			],
			$event->environment->reference
		);

		$this->r_disk->mountElFinderDisk(
			$disk_key,
			[
				'alias' => $event->environment->name . ' ' . $disk_name,
				'URL'   => null,
			],
			$event->environment->reference
		);

		/**
		 * Attach new environment directory to the default env
		 */

		if ($event->environment->reference !== EnvironmentsRepositoryEloquent::DEFAULT_ENVIRONMENT_REFERENCE)
		{
			$this->r_disk->addFileSystemDisk(
				$disk_key,
				[
					'driver' => 'local',
					'root'   => $env_directory,
				],
				EnvironmentsRepositoryEloquent::DEFAULT_ENVIRONMENT_REFERENCE
			);

			$this->r_disk->mountElFinderDisk(
				$disk_key,
				[
					'alias'  => $event->environment->name . ' ' . $disk_name,
					'URL'    => null,
					'access' => [
						'roles'       => [
							RolesRepositoryEloquent::ADMIN
						],
						'permissions' => [
							PermissionsRepositoryEloquent::SEE_ENVIRONMENT
						]
					]
				]
			);
		}
	}
}