<?php namespace cms\Modules\Users\Domain\Users\Users\Transformers;

use League\Fractal\TransformerAbstract;
use cms\Domain\Users\Users\User;

/**
 * Class IndexUsersListTransformer
 * @package cms\Domain\Users\Users\Transformers
 */
class IndexUsersListTransformer extends TransformerAbstract
{

	/**
	 * @param User $user
	 *
	 * @return array
	 */
	public function transform(User $user)
	{
		$primary_address = $user->flaggedAddress('primary');

		$data = [
			'id'               => (int)$user->id,
			'full_name'        => $user->full_name,
			'email'            => $user->email,
			'deleted_at'       => $user->deleted_at,
		];

		return $data;
	}
}
