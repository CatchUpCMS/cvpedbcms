<?php namespace cms\Modules\Environments\Http\Requests\Backend;

use cms\Infrastructure\Abstractions\Requests\FormRequestAbstract;

/**
 * Class EnvironmentFormRequest
 * @package cms\Modules\Environments\Http\Requests\Backend
 */
class EnvironmentFormRequest extends FormRequestAbstract
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
			'name'      => 'required',
			'reference' => 'alpha_dash|required|unique:environments,reference'
				. ((($this->method() === 'PUT') && ($id > 0)) ? ',' . $id : ''),
			'domain'    => 'required|unique:environments,domain'
				. ((($this->method() === 'PUT') && ($id > 0)) ? ',' . $id : ''),
		];
	}

	/**
	 * Get the error messages for the defined validation rules.
	 *
	 * @return array
	 */
	public function messages()
	{
		return [
			'reference.unique' => 'validations.environments.reference:unique',
			'domain.unique' => 'validations.environments.domain:unique',
		];
	}

}
