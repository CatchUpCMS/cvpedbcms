<?php namespace cms\Modules\Environments\Http\Controllers\Backend;

use cms\Infrastructure\Abstractions\Controllers\BackendController;
use cms\Domain\Users\Users\User;
use cms\Modules\Environments\Domain\Environments\Environments\Repositories\EnvironmentsRepository;
use cms\Modules\Environments\Http\Requests\Backend\EnvironmentFormRequest;

class EnvironmentsController extends BackendController
{
    /**
     * @var EnvironmentsRepository|null
     */
    protected $r_environments = null;

    /**
     * EnvironmentsController constructor.
     *
     * @param EnvironmentsRepository $r_environments
     */
    public function __construct(EnvironmentsRepository $r_environments)
    {
        $this->middleware(
            'role:' . User::ROLE_SUPERADMIN
        );

        $this->r_environments = $r_environments;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return $this->r_environments->indexBackEnd();
    }

    /**
     * @param EnvironmentFormRequest $request
     *
     * @return mixed|\Redirect
     */
    public function store(EnvironmentFormRequest $request)
    {
        return $this->r_environments->storeBackEnd($request);
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        return $this->r_environments->editBackEnd($id);
    }

    /**
     * @param EnvironmentFormRequest $request
     * @param                        $id
     *
     * @return mixed|\Redirect
     */
    public function update(EnvironmentFormRequest $request, $id)
    {
        return $this->r_environments->updateBackEnd($request, $id);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function destroy($id)
    {
        return $this->r_environments->destroyBackEnd($id);
    }
}
