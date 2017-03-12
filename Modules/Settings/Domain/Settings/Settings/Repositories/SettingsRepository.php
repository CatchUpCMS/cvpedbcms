<?php namespace cms\Modules\Settings\Domain\Settings\Settings\Repositories;

use cms\Infrastructure\Abstractions\Requests\FormRequestAbstract;
use cms\Domain\Settings\Settings\Repositories\SettingsRepository as CMSSettingsRepository;

/**
 * Class SettingsRepository
 * @package cms\Modules\Settings\Domain\Settings\Settings\Repositories
 */
class SettingsRepository extends CMSSettingsRepository
{

	/**
	 * @return mixed
	 */
	public function index()
	{
		return cmsview(
			'settings.backend.settings.index',
			[
				'settings' => $this
			],
			'settings::'
		);
	}

	/**
	 * @param FormRequestAbstract $request
	 *
	 * @return mixed
	 */
	public function store(FormRequestAbstract $request)
	{
		$posts = $request->all();
		unset($posts['_token']);

		$settings_keys = config('settings.form_key_to_settings');

		foreach ($posts as $key => $value)
		{
			$this->set($settings_keys[$key], $value);
		}

		return redirect(route('backend.settings.index'));
	}

}
