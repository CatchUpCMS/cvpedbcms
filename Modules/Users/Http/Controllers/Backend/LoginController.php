<?php namespace cms\Modules\Users\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use cms\Infrastructure\Abstractions\Controllers\BackendController;
use cms\Modules\Users\Domain\Users\Users\Repositories\UsersRepositoryEloquent;
use cms\Domain\Users\Users\User;

/**
 * Class LoginController
 * @package cms\Modules\Users\Http\Controllers\Backend
 */
class LoginController extends BackendController
{

	/*
	|--------------------------------------------------------------------------
	| Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles authenticating users for the application and
	| redirecting them to your home screen. The controller uses a trait
	| to conveniently provide its functionality to your applications.
	|
	*/

	use AuthenticatesUsers;

	/**
	 * Where to redirect users after login.
	 *
	 * @var string
	 */
	protected $redirectTo = 'backend';

	/**
	 * @var UsersRepositoryEloquent|null
	 */
	protected $r_users = null;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(UsersRepositoryEloquent $r_users)
	{
		$this->middleware('guest', ['except' => 'logout']);
		$this->r_users = $r_users;
	}

	/**
	 * Show the application's login form.
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function showLoginForm()
	{
		return $this->r_users->getUserLoginBackEnd();
	}

	/**
	 * Once user authenticated on site.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param User                     $user
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function authenticated(Request $request, User $user)
	{
		return $this->r_users
			->redirectAfterAuthentication(
				$request,
				$user,
				$this->redirectPath()
			);
	}
}
