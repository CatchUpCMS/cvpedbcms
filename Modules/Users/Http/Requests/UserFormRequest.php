<?php namespace cms\Modules\Users\Http\Requests;

use cms\Modules\Installer\Infrastructure\Abstractions\Requests\FormRequestAbstract;

/**
 * Class UserFormRequest
 * @package Modules\Users\Http\Requests
 */
class UserFormRequest extends FormRequestAbstract
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
			'first_name' => 'required',
			'last_name'  => 'required',
			'email'      => 'required|email'
		];
	}

}
