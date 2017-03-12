<?php namespace cms\App\Widgets\Users;

use cms\Infrastructure\Abstractions\Widgets\WidgetsAbstract;
use cms\App\Facades\Environments;
use cms\Domain\Settings\Settings\Repositories\SettingsRepository;
use cms\Domain\Users\Users\Repositories\UsersRepositoryEloquent;

/**
 * Class UsersFields
 * @package cms\App\Widgets\Users
 */
class UsersFields extends WidgetsAbstract
{

	/**
	 * @var string Widget title
	 */
	protected $title = 'Users field';

	/**
	 * @var string Widget description
	 */
	protected $description = 'Display roles input field';

	/**
	 * @var string View namespace ('dashboard::'|null)
	 */
	protected $view_prefix = '';

	/**
	 * @var string
	 */
	protected $module = '';

	/**
	 * @var SettingsRepository|null
	 */
	private $r_settings = null;

	/**
	 * @var UsersRepositoryEloquent|null
	 */
	private $r_user = null;

	public function __construct(
		SettingsRepository $r_settings,
		UsersRepositoryEloquent $r_user
	)
	{
		$this->r_settings = $r_settings;
		$this->r_user = $r_user;
	}

	public function register($name = 'users[]', $attributes = [])
	{
		$user_can_see_environment = cmsuser_can_see_env();

		if (!$user_can_see_environment)
		{
			$this->r_user->filterEnvironments([Environments::currentId()]);
		}
		$users = $this->r_user->all(['users.first_name', 'users.last_name', 'users.id']);

		$users_list = [];
		foreach ($users as $user)
		{
			$users_list[$user->id] = $user->full_name;
		}

		if (array_key_exists('all', $attributes) && $attributes['all'])
		{
			$users_list = [0 => trans('global.all')] + $users_list;
		}

		return $this->output(
			'app.widgets.usersfields',
			[
				'users'       => $users_list,
				'name'        => $name,
				'value'       => array_key_exists('value', $attributes) ? $attributes['value'] : '',
				'old_value'   => preg_replace("/[^A-Za-z0-9 ]/", '', $name),
				'placeholder' => array_key_exists('placeholder', $attributes) ? trans($attributes['placeholder']) : '',
				'class'       => array_key_exists('class', $attributes) ? $attributes['class'] : ''
			]
		);
	}
}
