<?php namespace cms\Modules\Users\Http\Requests\Backend;

use cms\Modules\Installer\Infrastructure\Abstractions\Requests\FormRequestAbstract;

/**
 * Class UserMultiDestroyFormRequest
 * @package cms\Modules\Users\Http\Requests\Backend
 */
class UserMultiDestroyFormRequest extends FormRequestAbstract
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
			'users_multi_destroy'   => 'required|array',
			'users_multi_destroy.*' => 'exists:users,id',
		];
	}

}
