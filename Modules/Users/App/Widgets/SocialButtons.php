<?php namespace cms\Modules\Users\App\Widgets;

use CVEPDB\Settings\Facades\Settings;
use cms\Infrastructure\Abstractions\Widgets\WidgetsAbstract;
use cms\Modules\Users\Domain\Users\Users\Repositories\UsersRepositoryEloquent;

/**
 * Class SocialButtons
 * @package cms\Modules\Users\App\Widgets
 */
class SocialButtons extends WidgetsAbstract
{

	/**
	 * @var string Widget title
	 */
	protected $title = 'Social Buttons';

	/**
	 * @var string Widget description
	 */
	protected $description = 'Display a users social buttons';

	/**
	 * @var string
	 */
	protected $module = 'users::';

	/**
	 * @var UsersRepositoryEloquent|null
	 */
	private $r_user = null;

	/**
	 * SocialButtons constructor.
	 *
	 * @param UsersRepositoryEloquent $r_user
	 */
	public function __construct(UsersRepositoryEloquent $r_user)
	{
		$this->r_user = $r_user;
	}

	/**
	 * @param null $action
	 *
	 * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
	 */
	public function register($action = null)
	{
		switch ($action)
		{
			case 'info':
			{
				return $this->widgetInformation();
			}
			default:
				return $this->output(
					'users.widgets.socialbuttons',
					[
						'social_login' => Settings::get('users.social.login')
					]
				);
		}
	}

}
