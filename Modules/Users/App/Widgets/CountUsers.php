<?php namespace cms\Modules\Users\App\Widgets;

use cms\Infrastructure\Abstractions\Widgets\WidgetsAbstract;
use cms\Modules\Users\Domain\Users\Users\Repositories\UsersRepositoryEloquent;

/**
 * Class CountUsers
 * @package cms\Modules\Users\App\Widgets
 */
class CountUsers extends WidgetsAbstract
{

	/**
	 * @var string Widget title
	 */
	protected $title = 'Count users';

	/**
	 * @var string Widget description
	 */
	protected $description = 'Display a users counter in the dashboard';

	/**
	 * @var string
	 */
	protected $module = 'users::';

	/**
	 * @var UsersRepositoryEloquent|null
	 */
	private $r_user = null;

	/**
	 * CountUsers constructor.
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
					'users.widgets.countusers',
					[
						'nb_users' => $this->r_user->count()
					]
				);
		}
	}

}
