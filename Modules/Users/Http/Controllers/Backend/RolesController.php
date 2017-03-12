<?php namespace cms\Modules\Users\Http\Controllers\Backend;

use cms\Infrastructure\Abstractions\Controllers\BackendController;
use cms\Modules\Users\Domain\Users\Roles\Repositories\RolesRepositoryEloquent;
use cms\Modules\Users\Http\Requests\Backend\RoleFormRequest;

/**
 * Class RolesController
 * @package cms\Modules\Users\Http\Controllers\Backend
 */
class RolesController extends BackendController
{

	/**
	 * @var RolesRepositoryEloquent|null
	 */
	protected $r_roles = null;

	/**
	 * @param RolesRepositoryEloquent $r_roles
	 */
	public function __construct(RolesRepositoryEloquent $r_roles)
	{
		$this->r_roles = $r_roles;
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index()
	{
		return $this->r_roles->indexRolesListBackEnd();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function create()
	{
		return $this->r_roles->createRoleBackEnd();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param RoleFormRequest $request
	 *
	 * @return \Modules\Users\Outputters\Response
	 */
	public function store(RoleFormRequest $request)
	{
		return $this->r_roles->storeRoleBackEnd($request);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param $id
	 *
	 * @return \Modules\Users\Outputters\Response
	 */
	public function show($id)
	{
		return $this->r_roles->showRoleBackEnd($id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param $id
	 *
	 * @return \Modules\Users\Outputters\Response
	 */
	public function edit($id)
	{
		return $this->r_roles->editRoleBackEnd($id);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param                 $id
	 * @param RoleFormRequest $request
	 *
	 * @return mixed|\Redirect
	 */
	public function update($id, RoleFormRequest $request)
	{
		return $this->r_roles->updateRoleBackEnd($id, $request);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param $id
	 *
	 * @return \Modules\Users\Outputters\Response
	 */
	public function destroy($id)
	{
		return $this->r_roles->destroyRoleBackEnd($id);
	}

}
