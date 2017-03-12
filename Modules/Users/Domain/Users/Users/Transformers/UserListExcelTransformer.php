<?php namespace cms\Modules\Users\Domain\Users\Users\Transformers;

use League\Fractal\TransformerAbstract;
use cms\Domain\Users\Users\User;

/**
 * Class UserListExcelTransformer
 * @package cms\Modules\Users\Domain\Users\Users\Transformers
 */
class UserListExcelTransformer extends TransformerAbstract
{

	/**
	 * Transform the User entity
	 *
	 * @param User $model
	 *
	 * @return array
	 */
	public function transform(User $model)
	{
		$primary_address = $model->flaggedAddress('primary');

		$birth_date = $model->birth_date_carbon;

		if (!is_null($birth_date))
		{
			$birth_date = $birth_date->format(trans('global.date_format'));
		}

		// NOTE :: key order is important !
		$data = [
			'id'         => (int)$model->id,
			'civility'   => trans('global.' . $model->civility),
			'last_name'  => $model->last_name,
			'first_name' => $model->first_name,
			'email'      => $model->email,
			'birth_date' => $birth_date,
		];

		/*
		 * Roles list
		 */

		$roles = [];
		foreach ($model->roles as $role)
		{
			$roles[] = trans($role->display_name);
		}
		sort($roles);
		$data['roles'] = implode(',' . PHP_EOL, $roles);

		/*
		 * Environments list
		 */

		$environments = [];

		if (cmsuser_can_see_env())
		{
			foreach ($model->environments as $environment)
			{
				$environments[] = trans($environment->name);
			}
			sort($environments);
			$data['environments'] = implode(',' . PHP_EOL, $environments);
		}

		/*
		 * Primary address
		 */

		if (!is_null($primary_address))
		{
			switch ($primary_address->locator_type)
			{
				case 'CVEPDB\Addresses\Domain\Addresses\Countries\Country':
				{
					$data['addresses'] =
						$primary_address->street
						. (!is_null($primary_address->street_extra) ? ' ' . $primary_address->street_extra : '')
						. ' ' . $primary_address->city
						. ' ' . $primary_address->zip
						. ' ' . (!is_null($primary_address->locator)
							? $primary_address->locator->name
							: '');
					break;
				}
				case 'CVEPDB\Addresses\Domain\Addresses\States\State':
				{
					$data['addresses'] =
						$primary_address->street
						. ' ' . $primary_address->street_extra
						. ' ' . $primary_address->city
						. ' ' . $primary_address->zip
						. ' ' . (!is_null($primary_address->locator)
							? $primary_address->locator->name
							: '')
						. ' ' . (!is_null($primary_address->locator)
							? $primary_address->locator->country->name
							: '');
					break;
				}
				case 'CVEPDB\Addresses\Domain\Addresses\SubStates\SubState':
				{
					$data['addresses'] =
						$primary_address->street
						. ' ' . $primary_address->street_extra
						. ' ' . $primary_address->city
						. ' ' . $primary_address->zip
						. ' ' . (!is_null($primary_address->locator)
							? $primary_address->locator->state->name
							: '')
						. ' ' . (!is_null($primary_address->locator)
							? $primary_address->locator->name
							: '')
						. ' ' . (!is_null($primary_address->locator)
							? $primary_address->locator->state->country->name
							: '');
					break;
				}
			}
		}

		return $data;
	}
}
