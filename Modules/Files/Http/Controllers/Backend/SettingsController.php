<?php namespace cms\Modules\Files\Http\Controllers\Backend;

use cms\Infrastructure\Abstractions\Controllers\ControllerAbstract;
use cms\Modules\Files\Domain\Files\Files\Repositories\ElFinderDiskRepository;
use cms\Modules\Files\Http\Requests\Backend\Settings\UpdateFilesSettingsFormRequest;

/**
 * Class SettingsController
 * @package cms\Modules\Files\Http\Controllers\Backend
 */
class SettingsController extends ControllerAbstract
{

	/**
	 * @var ElFinderDiskRepository|null
	 */
	private $r_disks = null;

	/**
	 * FilesController constructor.
	 *
	 * @param ElFinderDiskRepository $r_disks
	 */
	public function __construct(
		ElFinderDiskRepository $r_disks
	)
	{
		$this->r_disks = $r_disks;
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index()
	{
		return $this->r_disks->indexSettingsBackEnd();
	}

	/**
	 * @param UpdateFilesSettingsFormRequest $request
	 *
	 * @return array
	 */
	public function store(UpdateFilesSettingsFormRequest $request)
	{
		return $this->r_disks->storeSettingsBackEnd($request);
	}

}
