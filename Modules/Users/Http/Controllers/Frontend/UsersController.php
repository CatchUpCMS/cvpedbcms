<?php namespace cms\Modules\Users\Http\Controllers\Frontend;

use cms\Infrastructure\Abstractions\Controllers\FrontendController;
use cms\Modules\Users\Domain\Users\Users\Repositories\UsersRepositoryEloquent;
use cms\Modules\Users\Http\Requests\Frontend\UserFormRequest;
use cms\Modules\Users\Http\Requests\Frontend\UserPasswordFormRequest;

/**
 * Class UsersController
 * @package cms\Modules\Users\Http\Controllers\Frontend
 */
class UsersController extends FrontendController
{

    /**
     * @var UsersRepositoryEloquent|null
     */
    protected $r_users = null;

    /**
     * AuthController constructor.
     *
     * @param UsersRepositoryEloquent $r_users
     */
    public function __construct(
        UsersRepositoryEloquent $r_users
    )
    {
        $this->r_users = $r_users;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return $this->r_users->redirectUserToHisProfile();
    }

    /**
     *
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * @param UserFormRequest $request
     */
    public function store(UserFormRequest $request)
    {
        return abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     */
    public function show($id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     */
    public function edit($id)
    {
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param                 $id
     * @param UserFormRequest $request
     */
    public function update($id, UserFormRequest $request)
    {
        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     */
    public function destroy($id)
    {
        return abort(404);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function myProfile()
    {
        return $this->r_users->showUserProfileFrontEnd();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function editMyProfile()
    {
        return $this->r_users->editUserProfileFrontEnd();
    }

    /**
     * @param UserFormRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function updateMyProfile(UserFormRequest $request)
    {
        return $this->r_users->updateUserProfileFrontEnd($request);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function editMyPassword()
    {
        return $this->r_users->editUserPasswordFrontEnd();
    }

    /**
     * @param UserPasswordFormRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function updateMyPassword(UserPasswordFormRequest $request)
    {
        return $this->r_users->updateUserPasswordFrontEnd($request);
    }

}
