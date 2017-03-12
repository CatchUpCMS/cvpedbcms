<?php namespace cms\App\Widgets\Roles;

use cms\App\Facades\Environments;
use cms\Infrastructure\Abstractions\Widgets\WidgetsAbstract;
use cms\Domain\Settings\Settings\Repositories\SettingsRepository;
use cms\Domain\Users\Roles\Repositories\RolesRepositoryEloquent;

/**
 * Class RolesFields
 * @package cms\App\Widgets\Roles
 */
class RolesFields extends WidgetsAbstract
{

	/**
	 * @var string Widget title
	 */
	protected $title = 'Roles field';

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
	 * @var RolesRepositoryEloquent|null
	 */
	private $r_roles = null;

	public function __construct(SettingsRepository $r_settings, RolesRepositoryEloquent $r_roles)
	{
		$this->r_settings = $r_settings;
		$this->r_roles = $r_roles;
	}
	
	public function register($name = 'roles[]', $attributes = [])
	{
		$user_can_see_environment = cmsuser_can_see_env();

		if (!$user_can_see_environment)
		{
			$this->r_roles->filterEnvironments([Environments::currentId()]);
		}

		$roles = $this->r_roles->all(['roles.display_name', 'roles.id']);

		$roles_list = [];
		foreach ($roles as $role)
		{
			$roles_list[$role->id] = trans($role->display_name);
		}

		if (array_key_exists('all', $attributes) && $attributes['all'])
		{
			$roles_list = [0 => trans('global.all')] + $roles_list;
		}

		$value = array_key_exists('value', $attributes) ? $attributes['value'] : '';

		if (array_key_exists('default', $attributes) && $attributes['default'])
		{
			$value = empty($value) ? [1] : $value;
		}

		return $this->output(
			'app.widgets.rolesfields',
			[
				'roles'       => $roles_list,
				'name'        => $name,
				'value'       => $value,
				'old_value'   => preg_replace("/[^A-Za-z0-9 ]/", '', $name),
				'placeholder' => array_key_exists('placeholder', $attributes) ? trans($attributes['placeholder']) : '',
				'class'       => array_key_exists('class', $attributes) ? $attributes['class'] : ''
			]
		);
	}
}
