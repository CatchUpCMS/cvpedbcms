<?php namespace cms\Modules\Users\App\Services;

use cms\App\Services\Mails\MailSendService;

/**
 * Class MailToNewUserCreatedService
 * @package cms\Modules\Users\App\Services
 */
class MailToNewUserCreatedService extends MailSendService
{

	/**
	 * @param $user
	 */
	public function send($user)
	{
		$this->emailTo(
			$user->email,
			'users::users.emails.admin.newuser',
			'Admin created your account',
			[
				'user' => $user
			]
		);
	}

}
