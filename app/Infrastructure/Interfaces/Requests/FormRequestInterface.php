<?php namespace cms\Infrastructure\Interfaces\Requests;

/**
 * Interface FormRequestInterface
 * @package cms\Infrastructure\Interfaces\Requests
 */
interface FormRequestInterface
{

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize();

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules();
}
