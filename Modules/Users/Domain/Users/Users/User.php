<?php namespace cms\Modules\Users\Domain\Users\Users;

use Illuminate\Notifications\Notifiable;
use cms\Modules\Users\App\Notifications\Users\Users\ResetPassword;
use cms\Domain\Users\Users\User as UserModel;

/**
 * Class User
 * @package cms\Modules\Users\Domain\Users\Users
 */
class User extends UserModel
{

	use Notifiable;

	/**
	 * Send the password reset notification.
	 *
	 * @param  string $token
	 *
	 * @return void
	 */
	public function sendPasswordResetNotification($token)
	{
		$this->notify(new ResetPassword($token));
	}
}
