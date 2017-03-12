<?php namespace cms\Modules\Files\Http\Requests\Backend\Settings;

use cms\Infrastructure\Abstractions\Requests\FormRequestAbstract;

/**
 * Class UpdateFilesSettingsFormRequest
 * @package cms\Modules\Files\Http\Requests
 */
class UpdateFilesSettingsFormRequest extends FormRequestAbstract
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
			'name'      => '',
			'is_public' => 'integer',
		];
	}

}
