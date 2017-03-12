<?php namespace cms\Modules\Files\App\Widgets;

use cms\Infrastructure\Abstractions\Widgets\WidgetsAbstract;
use cms\Domain\Settings\Settings\Repositories\SettingsRepository;

/**
 * Class FilesFields
 * @package cms\Modules\Files\App\Widgets
 */
class FilesFields extends WidgetsAbstract
{

	/**
	 * @var string Widget title
	 */
	protected $title = 'Files field';

	/**
	 * @var string Widget description
	 */
	protected $description = 'Display files input field';

	/**
	 * @var string View namespace ('dashboard::'|null)
	 */
	protected $view_prefix = 'files::';

	/**
	 * @var string
	 */
	protected $module = 'files::';

	/**
	 * @var SettingsRepository|null
	 */
	private $r_settings = null;

	/**
	 * FilesFields constructor.
	 *
	 * @param SettingsRepository $r_settings
	 */
	public function __construct(SettingsRepository $r_settings)
	{
		$this->r_settings = $r_settings;
	}

	/**
	 * @param string $name
	 * @param array  $attributes
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function register($name = 'file', $attributes = [])
	{
		return $this->output(
			'files.widgets.filesfields',
			[
				'name'        => $name,
				'value'       => array_key_exists('value', $attributes) ? $attributes['value'] : '',
				'old_value'   => preg_replace("/[^A-Za-z0-9 ]/", '', $name),
				'placeholder' => array_key_exists('placeholder', $attributes) ? trans($attributes['placeholder']) : '',
				'class'       => array_key_exists('class', $attributes) ? $attributes['class'] : ''
			]
		);
	}

}
