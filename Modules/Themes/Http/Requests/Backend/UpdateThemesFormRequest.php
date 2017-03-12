<?php namespace cms\Modules\Themes\Http\Requests\Backend;

use cms\Infrastructure\Abstractions\Requests\FormRequestAbstract;

/**
 * Class UpdateThemesFormRequest
 * @package cms\Modules\Themes\Http\Requests\Backend
 */
class UpdateThemesFormRequest extends FormRequestAbstract
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
			'type' => 'required|alpha'
		];
	}

}
