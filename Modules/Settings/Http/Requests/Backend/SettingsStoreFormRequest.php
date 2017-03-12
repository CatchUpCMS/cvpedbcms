<?php namespace cms\Modules\Settings\Http\Requests\Backend;

use cms\Infrastructure\Abstractions\Requests\FormRequestAbstract;

/**
 * Class SettingsStoreFormRequest
 * @package cms\Modules\Settings\Http\Requests\Backend
 */
class SettingsStoreFormRequest extends FormRequestAbstract
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
			'cms_site_name'        => 'required',
			'cms_site_description' => 'required',
			'cms_site_logo'        => '',
			'cms_site_favico'      => '',
			'mail_from_address'    => 'required|email',
			'mail_from_name'       => 'required',
//            'mail_driver' => 'required',
//            'mail_host' => 'required',
//            'mail_port' => 'required',
//            'mail_encryption' => 'required',
//            'mail_username' => 'required',
//            'mail_password' => 'required',
		];
	}
}
