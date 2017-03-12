<?php namespace cms\Modules\Settings\Http\Requests\Ajax;

use cms\Infrastructure\Abstractions\Requests\FormRequestAbstract;

/**
 * Class SettingsGetFormRequest
 * @package cms\Modules\Settings\Http\Requests\Ajax
 */
class SettingsGetFormRequest extends FormRequestAbstract
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
			'setting_key' => 'required|alpha_dash',
		];
	}
}
