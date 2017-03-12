<?php namespace cms\Modules\Installer\Domain\Installer\Users\Repositories;

use Illuminate\Container\Container as Application;
use cms\Modules\Installer\Domain\Installer\Users\Repositories\UsersRepository;
use cms\Domain\Users\Users\Repositories\UsersRepositoryEloquent as CMSUserRepositoryEloquent;
use cms\Domain\Environments\Environments\Repositories\EnvironmentsRepositoryEloquent;
use cms\Domain\Users\Permissions\Repositories\PermissionsRepositoryEloquent;
use cms\Domain\Users\ApiKeys\Repositories\ApiKeysRepositoryEloquent;
use cms\Domain\Users\SocialTokens\Repositories\SocialTokenRepositoryEloquent;
use cms\Modules\Installer\Domain\Installer\Roles\Repositories\RolesRepositoryEloquent;

/**
 * Class UsersRepositoryEloquent
 * @package cms\Modules\Installer\Domain\Installer\Users\Repositories
 */
class UsersRepositoryEloquent extends CMSUserRepositoryEloquent implements UsersRepository
{

	/**
	 * UsersRepositoryEloquent constructor.
	 *
	 * @param Application                    $app
	 * @param EnvironmentsRepositoryEloquent $r_environments
	 * @param RolesRepositoryEloquent        $r_roles
	 * @param PermissionsRepositoryEloquent  $r_permissions
	 * @param SocialTokenRepositoryEloquent  $r_social_tokens
	 */
	public function __construct(
		Application $app,
		EnvironmentsRepositoryEloquent $r_environments,
		RolesRepositoryEloquent $r_roles,
		PermissionsRepositoryEloquent $r_permissions,
		SocialTokenRepositoryEloquent $r_social_tokens
	)
	{
		parent::__construct(
			$app,
			$r_environments,
			$r_roles,
			$r_permissions,
			$r_social_tokens
		);
	}

	/**
	 * Specify Model class name
	 *
	 * @return string
	 */
	public function model()
	{
		return parent::model();
	}

}
