<?php namespace cms\Modules\Users\App\Services;

use cms\App\Services\Mails\MailSendService;

/**
 * Class MailPasswordResetService
 * @package cms\Modules\Users\App\Services
 */
class MailPasswordResetService extends MailSendService
{

	/**
	 * @param $email
	 * @param $view
	 * @param $data
	 */
	public function send($email, $view, $data)
	{
		$this->emailTo(
			$email,
			$view,
			trans('passwords.mail_reset_password_title'),
			$data
		);
	}
	
}
