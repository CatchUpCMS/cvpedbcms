<?php namespace cms\Modules\Users\Http\Controllers\Backend;

use Illuminate\Support\Facades\Request;
use cms\Infrastructure\Abstractions\Controllers\BackendController;
use cms\Modules\Users\Domain\Users\Users\Repositories\UsersRepositoryEloquent;
use cms\Modules\Users\Http\Requests\Backend\UserFormRequest;
use cms\Modules\Users\Http\Requests\Backend\UsersFilteredFormRequest;
use cms\Modules\Users\Http\Requests\Backend\UserMultiDestroyFormRequest;
use cms\Modules\Users\App\Exports\UserListExport;

/**
 * Class UsersController
 * @package cms\Modules\Users\Http\Controllers\Backend
 */
class UsersController extends BackendController
{

	/**
	 * @var UsersRepositoryEloquent|null
	 */
	protected $r_users = null;

	/**
	 * UsersController constructor.
	 *
	 * @param UsersRepositoryEloquent $r_users
	 */
	public function __construct(UsersRepositoryEloquent $r_users)
	{
		$this->r_users = $r_users;
	}

	/**
	 * @param UsersFilteredFormRequest $request
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index(UsersFilteredFormRequest $request)
	{
		return $this->r_users->indexUsersListBackEnd($request, Request::ajax());
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function create()
	{
		return $this->r_users->createNewUserBackEnd();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param UserFormRequest $request
	 *
	 * @return mixed
	 */
	public function store(UserFormRequest $request)
	{
		return $this->r_users->storeNewUserBackEnd($request);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param $id
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function show($id)
	{
		return $this->r_users->showUserBackEnd($id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param $id
	 *
	 * @return mixed
	 */
	public function edit($id)
	{
		return $this->r_users->editUserBackEnd($id);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param                 $id
	 * @param UserFormRequest $request
	 *
	 * @return \cms\Modules\Users\Domain\Users\Users\Repositories\Response
	 */
	public function update($id, UserFormRequest $request)
	{
		return $this->r_users->updateUserBackEnd($id, $request);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param $id
	 *
	 * @return \cms\Modules\Users\Domain\Users\Users\Repositories\Response
	 */
	public function destroy($id)
	{
		return $this->r_users->destroyUserBackEnd($id);
	}

	/**
	 * Remove multiple users.
	 *
	 * @param UserMultiDestroyFormRequest $request
	 *
	 * @return \Redirect
	 */
	public function destroy_multiple(UserMultiDestroyFormRequest $request)
	{
		return $this->r_users->destroyMultipleUserBackEnd($request);
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	public function impersonate($id)
	{
		return $this->r_users->impersonateUserSessionBackEnd($id);
	}

	/**
	 * @return mixed
	 */
	public function endimpersonate()
	{
		return $this->r_users->endImpersonateUserSessionBackEnd();
	}

	/**
	 * @param UserListExport $excel
	 *
	 * @return mixed
	 */
	public function export(UserListExport $excel)
	{
		return $this->r_users->exportUsersListBackEnd($excel);
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	public function resetpassword($id)
	{
		return $this->r_users->resetPasswordUserBackEnd($id);
	}

}
