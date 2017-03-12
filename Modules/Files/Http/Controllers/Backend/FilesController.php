<?php namespace cms\Modules\Files\Http\Controllers\Backend;

use cms\Infrastructure\Abstractions\Controllers\ControllerAbstract;
use cms\Modules\Files\Domain\Files\Files\Repositories\ElFinderDiskRepository;

/**
 * Class FilesController
 * @package cms\Modules\Files\Http\Controllers\Backend
 */
class FilesController extends ControllerAbstract
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
		return $this->r_disks->indexBackEnd();
	}

}
