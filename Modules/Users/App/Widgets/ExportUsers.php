<?php namespace cms\Modules\Users\App\Widgets;

use cms\Infrastructure\Abstractions\Widgets\WidgetsAbstract;
use cms\Modules\Users\Domain\Users\Users\Repositories\UsersRepositoryEloquent;

/**
 * Class ExportUsers
 * @package cms\Modules\Users\App\Widgets
 */
class ExportUsers extends WidgetsAbstract
{

	/**
	 * @var string Widget title
	 */
	protected $title = 'Export users';

	/**
	 * @var string Widget description
	 */
	protected $description = 'Export a users list to excel file';

	/**
	 * @var string
	 */
	protected $module = 'users::';

	/**
	 * @var UsersRepositoryEloquent|null
	 */
	private $r_user = null;

	/**
	 * ExportUsers constructor.
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
				return $this->output('users.widgets.exportusers');
		}
	}

}
