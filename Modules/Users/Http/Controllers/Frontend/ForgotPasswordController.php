<?php namespace cms\Modules\Users\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use cms\Infrastructure\Abstractions\Controllers\FrontendController;
use cms\Modules\Users\Domain\Users\Users\Repositories\UsersRepositoryEloquent;

/**
 * Class ForgotPasswordController
 * @package cms\Modules\Users\Http\Controllers\Frontend
 */
class ForgotPasswordController extends FrontendController
{

	/*
	|--------------------------------------------------------------------------
	| Password Reset Controller
	|--------------------------------------------------------------------------
	|
	| This controller is responsible for handling password reset emails and
	| includes a trait which assists in sending these notifications from
	| your application to your users. Feel free to explore this trait.
	|
	*/

	use SendsPasswordResetEmails;

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
		$this->subject = trans('passwords.mail_reset_password_title');
		$this->redirectTo = route('home');
	}

	/**
	 * Display the form to request a password reset link.
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function showLinkRequestForm()
	{
		return $this->r_users->formToResetPassword();
	}

	/**
	 * Send a reset link to the given user.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function sendResetLinkEmail(Request $request)
	{
		$this->validate($request, ['email' => 'required|email']);

		// We will send the password reset link to this user. Once we have attempted
		// to send the link, we will examine the response then see the message we
		// need to show to the user. Finally, we'll send out a proper response.
		$response = $this->broker()->sendResetLink(
			$request->only('email')
		);

		if ($response === Password::RESET_LINK_SENT) {
			return back()->with('status', trans($response));
		}

		// If an error was returned by the password broker, we will get this message
		// translated so we can notify a user of the problem. We'll redirect back
		// to where the users came from so they can attempt this process again.
		return back()->withErrors(
			['email' => trans($response)]
		);
	}

	/**
	 * Get the broker to be used during password reset.
	 *
	 * @return \Illuminate\Contracts\Auth\PasswordBroker
	 */
	public function broker()
	{
		return Password::broker();
	}
}
