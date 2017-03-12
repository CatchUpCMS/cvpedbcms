<?php namespace cms\Modules\Users\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use cms\Infrastructure\Abstractions\Controllers\FrontendController;
use cms\Modules\Users\Domain\Users\Users\Repositories\UsersRepositoryEloquent;
use cms\Domain\Users\Users\User;

/**
 * Class LoginController
 * @package cms\Modules\Users\Http\Controllers\Frontend
 */
class LoginController extends FrontendController
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
	protected $redirectTo = '/backend/dashboard';

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
		return $this->r_users->getUserLoginFrontEnd();
	}

	/**
	 * Once user authenticated on site.
	 *
	 * @param Request $request
	 * @param User    $user
	 *
	 * @return string
	 */
	public function authenticated(Request $request, User $user)
	{
		return $this
			->r_users
			->redirectAfterAuthentication(
				$request,
				$user,
				$this->redirectPath()
			);
	}

	/**
	 * Redirect the user to a provider authentication page.
	 *
	 * @param $provider
	 *
	 * @return mixed
	 */
	public function redirectToProvider($provider)
	{
		return $this->r_users
			->redirectToProviderForAuthentification(
				$provider
			);
	}

	/**
	 * Obtain the user information from a provider.
	 *
	 * @param $provider
	 *
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function handleProviderCallback($provider)
	{
		return $this->r_users
			->handleProviderCallbackForAuthentificationWithRedirect(
				$provider,
				$this->redirectPath()
			);
	}
}
