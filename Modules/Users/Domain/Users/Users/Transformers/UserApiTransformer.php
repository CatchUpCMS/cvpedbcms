<?php namespace cms\Modules\Users\Domain\Users\Users\Transformers;

use League\Fractal\TransformerAbstract;
use cms\Domain\Users\Users\User;

/**
 * Class UserApiTransformer
 * @package cms\Modules\Users\Domain\Users\Users\Transformers
 */
class UserApiTransformer extends TransformerAbstract
{

	/**
	 * @param User $user
	 *
	 * @return array
	 */
	public function transform(User $user)
	{
		return [
			'id'         => (int)$user->id,
			'first_name' => $user->first_name,
			'last_name'  => $user->last_name,
			'email'      => $user->email
		];
	}
}
