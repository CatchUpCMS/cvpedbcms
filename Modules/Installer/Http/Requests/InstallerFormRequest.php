<?php namespace cms\Modules\Installer\Http\Requests;

use cms\Modules\Installer\Infrastructure\Abstractions\Requests\FormRequestAbstract;

/**
 * Class InstallerFormRequest
 * @package cms\Modules\Installer\Http\Requests
 */
class InstallerFormRequest extends FormRequestAbstract
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
			'APP_SITE_NAME'         => 'required|max:254',
			'APP_SITE_DESCRIPTION'  => 'required|max:254',
			'APP_URL'               => 'required|max:254|url',
			'first_name'            => 'required|max:50',
			'last_name'             => 'required|max:50',
			'email'                 => 'required|email|max:254',
			'password'              => 'required|min:6|confirmed|max:60',
			'password_confirmation' => 'required|min:6|max:60',
			'DB_HOST'               => 'required|max:254',
			'DB_DATABASE'           => 'required|max:254',
			'DB_USERNAME'           => 'required|max:254',
			'DB_PASSWORD'           => 'required|max:254',
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
			'APP_SITE_NAME.required' => trans('installer::installer.error:field_required'),
			'APP_SITE_NAME.max'      => trans('installer::installer.error:field_max'),

			'APP_SITE_DESCRIPTION.required' => trans('installer::installer.error:field_required'),
			'APP_SITE_DESCRIPTION.max'      => trans('installer::installer.error:field_max'),

			'APP_URL.required' => trans('installer::installer.error:field_required'),
			'APP_URL.max'      => trans('installer::installer.error:field_max'),
			'APP_URL.url'      => trans('installer::installer.error:field_url'),

			'first_name.required' => trans('installer::installer.error:field_required'),
			'first_name.max'      => trans('installer::installer.error:field_max'),

			'last_name.required' => trans('installer::installer.error:field_required'),
			'last_name.max'      => trans('installer::installer.error:field_max'),

			'email.required' => trans('installer::installer.error:field_required'),
			'email.max'      => trans('installer::installer.error:field_max'),
			'email.email'    => trans('installer::installer.error:field_email'),

			'password.required'  => trans('installer::installer.error:field_required'),
			'password.max'       => trans('installer::installer.error:field_max'),
			'password.min'       => trans('installer::installer.error:field_min'),
			'password.confirmed' => trans('installer::installer.error:password_confirmed'),

			'password_confirmation.required' => trans('installer::installer.error:field_required'),
			'password_confirmation.max'      => trans('installer::installer.error:field_max'),
			'password_confirmation.min'      => trans('installer::installer.error:field_min'),

			'DB_HOST.required' => trans('installer::installer.error:field_required'),
			'DB_HOST.max'      => trans('installer::installer.error:field_max'),

			'DB_DATABASE.required' => trans('installer::installer.error:field_required'),
			'DB_DATABASE.max'      => trans('installer::installer.error:field_max'),

			'DB_USERNAME.required' => trans('installer::installer.error:field_required'),
			'DB_USERNAME.max'      => trans('installer::installer.error:field_max'),

			'DB_PASSWORD.required' => trans('installer::installer.error:field_required'),
			'DB_PASSWORD.max'      => trans('installer::installer.error:field_max'),
		];
	}

}
