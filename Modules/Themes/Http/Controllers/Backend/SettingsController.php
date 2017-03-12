<?php namespace cms\Modules\Themes\Http\Controllers\Backend;

use cms\Infrastructure\Abstractions\Controllers\BackendController;
use cms\Modules\Themes\Domain\Themes\Themes\Repositories\ThemesRepository;
use cms\Modules\Themes\Http\Requests\Backend\UpdateThemesFormRequest;

/**
 * Class SettingsController
 * @package cms\Modules\Themes\Http\Controllers\Backend
 */
class SettingsController extends BackendController
{

	/**
	 * @var ThemesRepository|null
	 */
	private $r_themes = null;

	/**
	 * SettingsController constructor.
	 *
	 * @param ThemesRepository $outputter
	 */
	public function __construct(ThemesRepository $r_themes)
	{
		$this->r_themes = $r_themes;
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index()
	{
		return $this->r_themes->indexSettingsBackEnd();
	}

	/**
	 * @param                         $id
	 * @param UpdateThemesFormRequest $request
	 *
	 * @return \cms\Modules\Themes\Domain\Themes\Themes\Repositories\Response
	 */
	public function update($id, UpdateThemesFormRequest $request)
	{
		return $this->r_themes->updateSettingsBackEnd($id, $request);
	}

}
