<?php namespace cms\Modules\Files\Http\Controllers\Ajax;

use cms\Infrastructure\Abstractions\Controllers\AjaxController;
use cms\Modules\Files\Domain\Files\Files\Repositories\ElFinderDiskRepository;

/**
 * Class FilesController
 * @package cms\Modules\Files\Http\Controllers\Ajax
 */
class FilesController extends AjaxController
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
	public function showTinyMCE4()
	{
		$this->_before();

		return $this->r_disks->showTinyMCE4();
	}

	/**
	 * @param $input_id
	 *
	 * @return mixed
	 */
	public function showPopup($input_id)
	{
		$this->_before();

		return $this->r_disks->showPopup($input_id);
	}

	/**
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function showConnector()
	{
		//$this->_before();

		return $this->r_disks->showConnector();
	}

}
