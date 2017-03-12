<?php namespace cms\Modules\Users\Http\Controllers\Frontend;

use Illuminate\Foundation\Auth\ResetsPasswords;
use cms\Modules\Users\Domain\Users\Users\Repositories\UsersRepositoryEloquent;

/**
 * Class PasswordController
 * @package cms\Modules\Users\Http\Controllers\Frontend
 */
class PasswordController
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
	 * @var UsersRepositoryEloquent|null
	 */
	private $r_users = null;

	/**
	 * Create a new password controller instance.
	 *
	 * @param UsersRepositoryEloquent $r_users
	 */
	public function __construct(UsersRepositoryEloquent $r_users)
	{
		$this->middleware('guest');
		$this->r_users = $r_users;
		$this->subject = trans('passwords.mail_reset_password_title');
		$this->redirectTo = route('home');
	}

	/**
	 * Display the form to request a password reset link.
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getEmail()
	{
		return $this->r_users->formToResetPassword();
	}

	/**
	 * Display the password reset view for the given token.
	 *
	 * @param null $token
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 * @throws \cms\Modules\Users\Domain\Users\Users\Repositories\NotFoundHttpException
	 */
	public function getReset($token = null)
	{
		return $this->r_users->emailToResetPassword($token);
	}

	/**
	 * Get the response for after a successful password reset.
	 *
	 * @param  string  $response
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	protected function getResetSuccessResponse($response)
	{
		return $this->r_users->successToResetPassword(
			$response,
			$this->redirectPath()
		);
	}

	/**
	 * Reset the given user's password.
	 *
	 * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
	 * @param  string  $password
	 * @return void
	 */
	protected function resetPassword($user, $password)
	{
		$this->r_users->resetUserPassword($user, $password, $this->getGuard());
	}
}
