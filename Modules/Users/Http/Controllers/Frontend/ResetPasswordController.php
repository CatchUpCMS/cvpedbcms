<?php namespace cms\Modules\Users\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;
use cms\Infrastructure\Abstractions\Controllers\FrontendController;
use cms\Modules\Users\Domain\Users\Users\Repositories\UsersRepositoryEloquent;

/**
 * Class ResetPasswordController
 * @package cms\Modules\Users\Http\Controllers\Frontend
 */
class ResetPasswordController extends FrontendController
{

	/*
	|--------------------------------------------------------------------------
	| Password Reset Controller
	|--------------------------------------------------------------------------
	|
	| This controller is responsible for handling password reset requests
	| and uses a simple trait to include this behavior. You're free to
	| explore this trait and override any methods you wish to tweak.
	|
	*/

	use ResetsPasswords;

	/**
	 * Where to redirect users after reset password.
	 *
	 * @var string
	 */
	protected $redirectTo = '/';

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
		$this->middleware('guest');
		$this->r_users = $r_users;
	}

	/**
	 * Display the password reset view for the given token.
	 *
	 * If no token is present, display the link request form.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string|null  $token
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function showResetForm(Request $request, $token = null)
	{
		return $this->r_users->emailToResetPassword($token);
//		return view('auth.passwords.reset')->with(
//			['token' => $token, 'email' => $request->email]
//		);
	}
}
