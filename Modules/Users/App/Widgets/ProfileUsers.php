<?php namespace cms\Modules\Users\App\Widgets;

use Illuminate\Support\Facades\Auth;
use cms\Infrastructure\Abstractions\Widgets\WidgetsAbstract;
use cms\Modules\Users\Domain\Users\Users\Repositories\UsersRepositoryEloquent;

/**
 * Class ProfileUsers
 * @package cms\Modules\Users\App\Widgets
 */
class ProfileUsers extends WidgetsAbstract
{

	/**
	 * @var string Widget title
	 */
	protected $title = 'Profile users';

	/**
	 * @var string Widget description
	 */
	protected $description = 'Display a users profile in the dashboard';

	/**
	 * @var string
	 */
	protected $module = 'users::';

	/**
	 * @var UsersRepositoryEloquent|null
	 */
	private $r_user = null;

	/**
	 * ProfileUsers constructor.
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
			{
				$user = $this->r_user->find(Auth::user()->id);

				return $this->output('users.widgets.profileusers', ['user' => $user]);
			}
		}
	}

}
