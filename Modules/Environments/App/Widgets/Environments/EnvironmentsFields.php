<?php namespace cms\Modules\Environments\App\Widgets\Environments;

use cms\Infrastructure\Abstractions\Widgets\WidgetsAbstract;
use cms\Domain\Environments\Environments\Repositories\EnvironmentsRepositoryEloquent;

/**
 * Class EnvironmentsFields
 * @package cms\Modules\Environments\App\Widgets\Environments
 */
class EnvironmentsFields extends WidgetsAbstract
{

	/**
	 * @var EnvironmentsRepositoryEloquent|null
	 */
	private $r_environments = null;

	/**
	 * @var string
	 */
	protected $module = 'environments::';

	/**
	 * EnvironmentsFields constructor.
	 *
	 * @param EnvironmentsRepositoryEloquent $r_environments
	 */
	public function __construct(
		EnvironmentsRepositoryEloquent $r_environments
	)
	{
		$this->r_environments = $r_environments;
	}

	/**
	 * @param string $name
	 * @param array  $attributes
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
	 */
	public function register($name = 'environments[]', $attributes = [])
	{
		$envs = $this
			->r_environments
			->lists('domain', 'id')
			->toArray();

		foreach ($envs as $id => $env)
		{
			$envs[$id] = trans($env);
		}

		if (array_key_exists('all', $attributes) && $attributes['all'])
		{
			$envs = [0 => trans('global.all')] + $envs;
		}

		$value = array_key_exists('value', $attributes)
			? $attributes['value']
			: '';

		if (array_key_exists('default', $attributes) && $attributes['default'])
		{
			$value = empty($value)
				? [\Environments::currentId()]
				: $value;
		}

		return $this->output(
			'environments.widgets.environmentsfields',
			[
				'environments' => $envs,
				'default_env'  => \Environments::currentId(),
				'name'         => $name,
				'value'        => $value,
				'old_value'    => preg_replace("/[^A-Za-z0-9 ]/", '', $name),
				'placeholder'  => array_key_exists('placeholder', $attributes)
					? trans($attributes['placeholder'])
					: '',
				'class'        => array_key_exists('class', $attributes)
					? $attributes['class']
					: ''
			]
		);
	}
}
