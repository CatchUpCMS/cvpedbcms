<?php namespace cms\Modules\Users\Http\Requests\Backend;

use cms\Modules\Installer\Infrastructure\Abstractions\Requests\FormRequestAbstract;

/**
 * Class RoleFormRequest
 * @package cms\Modules\Users\Http\Requests\Backend
 */
class RoleFormRequest extends FormRequestAbstract
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
		$id = $this->method() === 'PUT'  // only if updating
			? $this->segment(3)
			: 0;

		return [
			'name'         => 'required|unique:roles,name' . ((($this->method() === 'PUT') && ($id > 0)) ? ',' . $id : ''),
			'display_name' => 'required',
			'description'  => 'required',
			'environments' => 'array'
		];
	}

}
