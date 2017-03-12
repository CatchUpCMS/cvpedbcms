<?php namespace cms\Modules\Users\Http\Controllers\Backend;

use cms\Infrastructure\Abstractions\Controllers\BackendController;
use cms\Modules\Users\Domain\Users\Users\Repositories\UsersRepositoryEloquent;
use cms\Modules\Users\Http\Requests\Backend\UpdateUsersSettingsFormRequest;

/**
 * Class SettingsController
 * @package cms\Modules\Users\Http\Controllers\Backend
 */
class SettingsController extends BackendController
{

	/**
	 * @var UsersRepositoryEloquent|null
	 */
	protected $r_users = null;

	/**
	 * @param UsersRepositoryEloquent $r_users
	 */
	public function __construct(UsersRepositoryEloquent $r_users)
	{
		$this->r_users = $r_users;
	}

	/**
	 * @return mixed
	 */
	public function index()
	{
		return $this->r_users->indexBackEndSettings();
	}

	/**
	 * @param UpdateUsersSettingsFormRequest $request
	 *
	 * @return mixed
	 */
	public function store(UpdateUsersSettingsFormRequest $request)
	{
		return $this->r_users->storeBackEndSettings($request);
	}

}
