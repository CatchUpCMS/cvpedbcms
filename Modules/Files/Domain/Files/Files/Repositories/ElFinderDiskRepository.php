<?php namespace cms\Modules\Files\Domain\Files\Files\Repositories;

use cms\App\Facades\Environments;
use cms\Domain\Users\Permissions\Repositories\PermissionsRepositoryEloquent;
use cms\Modules\Installer\Domain\Installer\Roles\Repositories\RolesRepositoryEloquent;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Barryvdh\Elfinder\Connector;
use Barryvdh\Elfinder\Session\LaravelSession;
use CVEPDB\Settings\Facades\Settings;
use cms\Infrastructure\Abstractions\Requests\FormRequestAbstract;
use cms\Domain\Files\Files\Repositories\ElFinderDiskRepository as CMSElFinderDiskRepository;

/**
 * Class ElFinderDiskRepository
 * @package cms\Modules\Files\Domain\Files\Files\Repositories
 */
class ElFinderDiskRepository extends CMSElFinderDiskRepository
{

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function indexBackEnd()
	{
		return cmsview(
			'files.backend.files.index',
			[
				'locale' => Session::get('lang')
			],
			'files::'
		);
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function indexSettingsBackEnd()
	{

		$elfinder_disks = Settings::get('elfinder.disks');
		$filesystems_disks = Settings::get('filesystems.disks');

		$disks = collect($elfinder_disks)
			->map(function ($disk, $disk_name) use ($filesystems_disks)
			{

				$disk['driver'] = $filesystems_disks[$disk_name]['driver'];
				$disk['root'] = $filesystems_disks[$disk_name]['root'];

				if (array_key_exists('visibility', $filesystems_disks[$disk_name]))
				{
					$disk['visibility'] = $filesystems_disks[$disk_name]['visibility'];
				}

				return $disk;
			});

//		dd($disks);

		return cmsview(
			'files.backend.settings.index',
			[
				'disks' => $disks
			],
			'files::'
		);
	}

	/**
	 * @param FormRequestAbstract $request
	 *
	 * @return mixed
	 */
	public function storeSettingsBackEnd(FormRequestAbstract $request)
	{
		$is_directory_public = false;

		if ($request->has('is_public') && $request->get('is_public'))
		{
			$is_directory_public = true;
		}

		$this->storeDiskSettingsBackEnd(
			$request->get('name'),
			$request->get('driver'),
			$is_directory_public
		);

		return redirect('backend/files/settings');
	}

	protected function storeDiskSettingsBackEnd(
		$directory_name,
		$directory_driver,
		$is_directory_public = false
	)
	{
		$directory_url = null;
		$directory_root = null;
		$directory_path = null;
		$directory_name = str_replace('-', '_', slugify($directory_name));

		switch ($directory_driver)
		{
			case 'local':
			default:
			{
				if ($is_directory_public)
				{
					$directory_root = 'uploads/' . Environments::currentEnvironment() . '/' . $directory_name;
					$directory_url = url($directory_root);
					$directory_path = public_path($directory_root);
				}
				else
				{
					$directory_root = 'app/' . Environments::currentEnvironment() . '/' . $directory_name;
					$directory_url = url($directory_root);
					$directory_path = public_path($directory_root);
				}
				break;
			}
		}

		File::makeDirectory($directory_path, 0777, true);

		$disk = [
			'driver' => $directory_driver,
			'root'   => $directory_path,
		];

		if ($is_directory_public)
		{
			$disk['visibility'] = 'public';
		}

		$this->addFileSystemDisk(
			$directory_name,
			$disk,
			Environments::currentEnvironment()
		);

		$this->mountElFinderDisk(
			$directory_name,
			[
				'alias'  => $directory_path,
				'URL'    => $directory_url,
				'access' => [
					'readonly'    => true,
					'roles'       => [
						RolesRepositoryEloquent::ADMIN
					],
					'permissions' => [
						PermissionsRepositoryEloquent::CAN_READ_BACKUPS_DIRECTORY
					]
				]
			],
			Environments::currentEnvironment()
		);
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function showTinyMCE4()
	{
		return cmsview(
			'files.ajax.elfinder.tinymce4',
			[
				'locale' => Session::get('lang')
			],
			'files::'
		);
	}

	/**
	 * @param $input_id
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function showPopup($input_id)
	{
		return cmsview(
			'files.ajax.elfinder.standalonepopup',
			[
				'input_id' => $input_id,
				'locale'   => Session::get('lang')
			],
			'files::'
		);
	}

	/**
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function showConnector()
	{
		// xAbe todo : decommente dans le controller le _before();

		$debug = false;

		$session = null;
		$roots = $this->getElFinderRoots();

		if (empty($roots))
		{
			$roots = array_merge(
				$this->getMountableElFinderDirectoriesList(),
				$this->getMountableElFinderDisksList()
			);
		}

//		if (app()->bound('session.store'))
//		{
//			$sessionStore = app('session.store');
//			$session = new LaravelSession($sessionStore);
//		}

		$rootOptions = Settings::get('elfinder.root_options', []);
		foreach ($roots as $key => $root)
		{
			if (is_array($rootOptions))
			{
				$roots[$key] = array_merge($rootOptions, $root);
			}
		}

		$opts = Settings::get('elfinder.options', []);
		$opts = array_merge(
			$opts,
			[
				'roots'   => $roots,
				'session' => $session,
				'debug'   => $debug
			]
		);

		$elFinder = new \elFinder($opts);

		// run elFinder
		$connector = new Connector($elFinder, $debug);
		$connector->run();

		return $connector->getResponse();
	}

}
