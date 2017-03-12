<?php namespace cms\Modules\Files\App\Widgets;

use cms\Infrastructure\Abstractions\Widgets\WidgetsAbstract;
use cms\Domain\Settings\Settings\Repositories\SettingsRepository;

/**
 * Class SetupFiles
 * @package cms\Modules\Files\App\Widgets
 */
class SetupFiles extends WidgetsAbstract
{

	/**
	 * @var string Widget title
	 */
	protected $title = 'Setup files';

	/**
	 * @var string Widget description
	 */
	protected $description = 'Choose files managers';

	/**
	 * @var string
	 */
	protected $module = 'files::';

	/**
	 * @var SettingsRepository|null
	 */
	private $r_settings = null;

	public function __construct(SettingsRepository $r_settings)
	{
		$this->r_settings = $r_settings;
	}

	/**
	 * @param null $action
	 *
	 * @return mixed
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
				return $this->output(
					'files.widgets.setupfilesmanager',
					[
						'widgets' => [
						]
					]
				);
			}
		}
	}

}
