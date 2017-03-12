<?php namespace cms\Modules\Users\Http\Requests\Backend;

use cms\Modules\Installer\Infrastructure\Abstractions\Requests\FormRequestAbstract;

/**
 * Class UpdateUsersSettingsFormRequest
 * @package cms\Modules\Users\Http\Requests\Backend
 */
class UpdateUsersSettingsFormRequest extends FormRequestAbstract
{

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'widgets'      => 'array',
			'social_login' => 'array'
			//. '|in:' . \Modules\Dashboard\Repositories\SettingsRepository::DASHBOARD_WIDGET_STATUS_ACTIVE
		];
	}
	
}
