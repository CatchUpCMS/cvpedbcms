<?php namespace Core\Http\Outputters\Admin;

use Request;
use Response;
use Core\Http\Outputters\AdminOutputter;
use Core\Domain\Settings\Repositories\SettingsRepository;
use CVEPDB\Abstracts\Http\Requests\FormRequest as AbsFormRequest;

/**
 * Class SettingsOutputter
 * @package Core\Http\Outputters
 */
class SettingsOutputter extends AdminOutputter
{

	/**
	 * @var string Outputter header title
	 */
	protected $title = 'global.settings';

	private $form_key_to_settings = [];

	/**
	 * @var string Outputter header description
	 */
	protected $description = '';

	/**
	 * SettingsOutputter constructor.
	 *
	 * @param SettingsRepository $r_settings
	 */
	public function __construct(SettingsRepository $r_settings)
	{
		parent::__construct($r_settings);
		$this->addBreadcrumb(trans('global.settings'), 'admin/settings');
		$this->form_key_to_settings = config('settings.form_key_to_settings');
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index()
	{
		return $this->output(
			'core.admin.settings.index',
			[
				'settings' => $this->r_settings
			]
		);
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function store(AbsFormRequest $request)
	{
		$posts = $request->all();
		unset($posts['_token']);

		foreach ($posts as $key => $value)
		{
			$setting_key = $this->getSettingKey($key);
			$this->r_settings->set($setting_key, $value);
		}

		return $this->redirectTo('admin/settings');
	}

	/**
	 * @param AbsFormRequest $request
	 *
	 * @return mixed
	 */
	public function get(AbsFormRequest $request)
	{
		$data = [];

		if (Request::ajax())
		{
			$setting_key = $request->get('setting_key');
			$data[$setting_key] = $this->r_settings->get($setting_key);
		}

		return Response::json($data);
	}

	/**
	 * @param AbsFormRequest $request
	 *
	 * @return mixed
	 */
	public function set(AbsFormRequest $request)
	{
		$data = [];
		
		if (Request::ajax())
		{
			$setting_key = $request->get('setting_key');
			$setting_value = $request->get('setting_value');
			$this->r_settings->set($setting_key, $setting_value);
			$data[$setting_key] = $setting_value;
		}

		return Response::json($data);
	}

	/**
	 * @param $form_key
	 *
	 * @return mixed
	 */
	private function getSettingKey($form_key)
	{
		return $this->form_key_to_settings[$form_key];
	}
}
