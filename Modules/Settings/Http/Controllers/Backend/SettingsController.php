<?php namespace cms\Modules\Settings\Http\Controllers\Backend;

use cms\Infrastructure\Abstractions\Controllers\BackendController;
use cms\Modules\Settings\Http\Requests\Backend\SettingsStoreFormRequest;
use cms\Modules\Settings\Domain\Settings\Settings\Repositories\SettingsRepository;

/**
 * Class SettingsController
 * @package cms\Http\Controllers\Backend
 */
class SettingsController extends BackendController
{

    /**
     * @var SettingsRepository|null
     */
    protected $r_settings = null;

    /**
     * SettingsController constructor.
     *
     * @param SettingsRepository $r_settings
     */
    public function __construct(SettingsRepository $r_settings)
    {
        $this->r_settings = $r_settings;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return $this->r_settings->index();
    }

    /**
     * @param SettingsStoreFormRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(SettingsStoreFormRequest $request)
    {
        return $this->r_settings->store($request);
    }

}
