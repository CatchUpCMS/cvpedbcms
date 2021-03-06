<?php namespace cms\Modules\Users\App\Notifications\Users\Users;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Class ResetPassword
 * @package cms\Modules\Users\App\Notifications\Users\Users
 */
class ResetPassword extends Notification
{

	/**
	 * The password reset token.
	 *
	 * @var string
	 */
	public $token;

	/**
	 * Create a notification instance.
	 *
	 * @param  string $token
	 *
	 * @return void
	 */
	public function __construct($token)
	{
		$this->token = $token;
	}

	/**
	 * Get the notification's channels.
	 *
	 * @param  mixed $notifiable
	 *
	 * @return array|string
	 */
	public function via($notifiable)
	{
		return ['mail'];
	}

	/**
	 * Build the mail representation of the notification.
	 *
	 * @param  mixed $notifiable
	 *
	 * @return \Illuminate\Notifications\Messages\MailMessage
	 */
	public function toMail($notifiable)
	{
		return (new MailMessage)
			->subject(trans('auth.password_reset_title'))
			->view(
				'users::users.emails.password',
				[
					'token' => $this->token,
				]
			);
	}
}
