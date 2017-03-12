<?php namespace cms\Modules\Users\Http\Requests\Backend;

use Illuminate\Support\Facades\Auth;
use cms\Modules\Installer\Infrastructure\Abstractions\Requests\FormRequestAbstract;
use cms\Domain\Users\Permissions\Repositories\PermissionsRepositoryEloquent;
use cms\Modules\Users\Domain\Users\Roles\Repositories\RolesRepositoryEloquent;

/**
 * Class UserFormRequest
 * @package cms\Modules\Users\Http\Requests\Backend
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
		$id = $this->method() === 'PUT'  // only if updating
			? $this->segment(3)
			: 0;

		$rules = [
			'roles'                        => 'array',
			'roles.*'                      => 'exists:environments,id',
			'civility'                     => 'required|in:madam,miss,mister',
			'first_name'                   => 'required|max:50',
			'last_name'                    => 'required|max:50',
			'email'                        => 'required|email|max:255|unique:users,email' . ((($this->method() === 'PUT') && ($id > 0)) ? ',' . $id : ''),
			'birth_date'                   => '',
			'primary_address_country_id'   => 'exists:countries,id',
			'primary_address_state_id'     => 'exists:states,id',
			'primary_address_substate_id'  => 'exists:substates,id',
			'primary_address_street'       => '',
			'primary_address_street_extra' => '',
			'primary_address_city'         => '',
			'primary_address_zip'          => '',
		];

		if (
			Auth::user()->hasRole(RolesRepositoryEloquent::ADMIN)
			|| Auth::user()->hasPermission(PermissionsRepositoryEloquent::SEE_ENVIRONMENT)
		)
		{
			$rules['environments'] = 'array';
			$rules['environments.*'] = 'exists:environments,id';
		}
		else
		{
			$rules['environments'] = 'exists:environments,id';
		}

		return $rules;
	}

}
