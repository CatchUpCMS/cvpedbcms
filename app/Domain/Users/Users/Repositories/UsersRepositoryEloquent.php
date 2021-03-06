<?php namespace cms\Domain\Users\Users\Repositories;

use Illuminate\Container\Container as Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use cms\Infrastructure\Abstractions\Repositories\RepositoryEloquentAbstract;
use cms\Domain\Users\Users\Repositories\UsersRepository;
use cms\Domain\Environments\Environments\Repositories\EnvironmentsRepositoryEloquent;
use cms\Domain\Users\SocialTokens\Repositories\SocialTokenRepositoryEloquent;
use cms\Domain\Users\Users\Criterias\OnlyTrashedCriteria;
use cms\Domain\Users\Users\Criterias\WithTrashedCriteria;
use cms\Domain\Users\Users\Criterias\EmailLikeCriteria;
use cms\Domain\Users\Users\Criterias\UserNameLikeCriteria;
use cms\Domain\Users\Users\Criterias\RolesCriteria;
use cms\Domain\Users\Users\Criterias\EnvironmentsCriteria;
use cms\Domain\Users\Users\Events\UserCreatedEvent;
use cms\Domain\Users\Users\Events\UserUpdatedEvent;
use cms\Domain\Users\Users\Events\UserDeletedEvent;
use cms\Domain\Users\Users\Events\NewUserCreatedEvent;
use cms\Domain\Users\Users\Events\NewAdminCreatedEvent;
use cms\Domain\Users\Users\Events\NewSuperAdminCreatedEvent;
use cms\Domain\Users\Users\User;

class UsersRepositoryEloquent extends RepositoryEloquentAbstract implements UsersRepository
{

	/**
	 * @var EnvironmentsRepositoryEloquent|null
	 */
	protected $r_environments = null;

	/**
	 * @var SocialTokenRepositoryEloquent|null
	 */
	protected $r_social_tokens = null;

	/**
	 * @var array Civilities available to fill civility field in users table.
	 */
	protected $civilities = [
		User::CIVILITY_MADAM  => 'global.' . User::CIVILITY_MADAM,
		User::CIVILITY_MISS   => 'global.' . User::CIVILITY_MISS,
		User::CIVILITY_MISTER => 'global.' . User::CIVILITY_MISTER,
	];

	/**
	 * @var array Roles available to fill role field in users table.
	 */
	protected $roles = [
		User::ROLE_SUPERADMIN => 'global.' . User::ROLE_SUPERADMIN,
		User::ROLE_ADMIN      => 'global.' . User::ROLE_ADMIN,
		User::ROLE_MODERATOR  => 'global.' . User::ROLE_MODERATOR,
		User::ROLE_USER       => 'global.' . User::ROLE_USER,
	];

	/**
	 * UsersRepositoryEloquent constructor.
	 *
	 * @param Application                    $app
	 * @param EnvironmentsRepositoryEloquent $r_environments
	 * @param SocialTokenRepositoryEloquent  $r_social_tokens
	 */
	public function __construct(
		Application $app,
		EnvironmentsRepositoryEloquent $r_environments,
		SocialTokenRepositoryEloquent $r_social_tokens
	)
	{
		parent::__construct($app);

		$this->r_environments = $r_environments;
		$this->r_social_tokens = $r_social_tokens;
	}

	/**
	 * Specify Model class name
	 *
	 * @return string
	 */
	public function model()
	{
		return User::class;
	}

	/**
	 * Create user and fire event "UserCreatedEvent".
	 *
	 * @param array $attributes
	 *
	 * @event cms\Domain\Users\Users\Events\UserUpdatedEvent
	 * @return \cms\Domain\Users\Users\User
	 */
	public function create(array $attributes)
	{
		$user = parent::create($attributes);

		event(new UserCreatedEvent($user));

		return $user;
	}

	/**
	 * Update user and fire event "UserUpdatedEvent".
	 *
	 * @param array   $attributes
	 * @param integer $user_id
	 *
	 * @event cms\Domain\Users\Users\Events\UserUpdatedEvent
	 * @return \cms\Domain\Users\Users\User
	 */
	public function update(array $attributes, $user_id)
	{
		$user = parent::update($attributes, $user_id);

		event(new UserUpdatedEvent($user));

		return $user;
	}

	/**
	 * Delete user and fire event "UserDeletedEvent".
	 *
	 * @param array   $attributes
	 * @param integer $user_id
	 *
	 * @event cms\Domain\Users\Users\Events\UserDeletedEvent
	 * @return int
	 */
	public function delete($id)
	{
		if ($id == Auth::user()->id)
		{
			throw new \Exception(
				trans('users.findanddelete.you_can_not_delete_your_account')
			);
		}

		$user = $this->find($id);

		event(new UserDeletedEvent($user));

		return parent::delete($id);
	}

	/**
	 * Filter users by name.
	 *
	 * @param string $name The user last name or user first name
	 *
	 * @throws \Prettus\Repository\Exceptions\RepositoryException
	 * @return $this
	 */
	public function filterUserName($name)
	{
		if (!is_null($name) && !empty($name))
		{
			$this->pushCriteria(new UserNameLikeCriteria($name));
		}

		return $this;
	}

	/**
	 * Filter users by emails.
	 *
	 * @param string $email The user email
	 *
	 * @throws \Prettus\Repository\Exceptions\RepositoryException
	 * @return $this
	 */
	public function filterEmail($email)
	{
		if (!is_null($email) && !empty($email))
		{
			$this->pushCriteria(new EmailLikeCriteria($email));
		}

		return $this;
	}

	/**
	 * Filter users by roles.
	 *
	 * @param array $roles the list of roles IDs
	 *
	 * @throws \Prettus\Repository\Exceptions\RepositoryException
	 * @return $this
	 */
	public function filterRoles($roles = [])
	{
		if (count($roles))
		{
			$roles = array_filter($roles);
			$this->pushCriteria(new RolesCriteria($roles));
		}

		return $this;
	}

	/**
	 * Display all users with trashed users.
	 *
	 * @throws \Prettus\Repository\Exceptions\RepositoryException
	 * @return $this
	 */
	public function filterShowWithTrashed()
	{
		$this->pushCriteria(new WithTrashedCriteria());

		return $this;
	}

	/**
	 * Display only trashed user.
	 *
	 * @throws \Prettus\Repository\Exceptions\RepositoryException
	 * @return $this
	 */
	public function filterShowOnlyTrashed()
	{
		$this->pushCriteria(new OnlyTrashedCriteria());

		return $this;
	}

	/**
	 * Filter users by environments.
	 *
	 * @param array $envs the list of environment IDs
	 *
	 * @throws \Prettus\Repository\Exceptions\RepositoryException
	 * @return $this
	 */
	public function filterEnvironments($envs = [])
	{
		if (count($envs))
		{
			$envs = array_filter($envs);
			$this->pushCriteria(new EnvironmentsCriteria($envs));
		}

		return $this;
	}

	/**
	 * @return \Illuminate\Support\Collection
	 */
	public function getRolesList()
	{
		return collect($this->roles)
			->map(
				function ($translation_key)
				{
					return trans($translation_key);
				}
			);
	}

	/**
	 * @return \Illuminate\Support\Collection
	 */
	public function getCivilitiesList()
	{
		return collect($this->civilities)
			->map(
				function ($translation_key)
				{
					return trans($translation_key);
				}
			);
	}

	/**
	 * Generate a random password, based on 'cms.password_length' length.
	 *
	 * @return string
	 */
	public function generateUserPassword()
	{
		return Str::random(
			\Settings::get('cms.password_length')
		);
	}

	/**
	 * Create a new user with role User::ROLE_USER.
	 *
	 * @param        $civility
	 * @param        $first_name
	 * @param        $last_name
	 * @param        $email
	 * @param null   $birth_date
	 * @param string $role
	 *
	 * @return User
	 */
	public function createNewUser(
		$civility,
		$first_name,
		$last_name,
		$email,
		$birth_date = null,
		$role = User::ROLE_USER
	)
	{
		$user = $this->create([
			'civility'   => $civility,
			'first_name' => $first_name,
			'last_name'  => $last_name,
			'email'      => $email,
			'birth_date' => $birth_date,
			'role'       => $role,
		]);

		event(new NewUserCreatedEvent($user));

		return $user;
	}

	/**
	 * Create a new user with role User::ROLE_ADMIN.
	 *
	 * @param      $civility
	 * @param      $first_name
	 * @param      $last_name
	 * @param      $email
	 * @param null $birth_date
	 *
	 * @return User
	 */
	public function createNewAdmin(
		$civility,
		$first_name,
		$last_name,
		$email,
		$birth_date = null
	)
	{
		$user = $this->createNewUser(
			$civility,
			$first_name,
			$last_name,
			$email,
			$birth_date,
			User::ROLE_ADMIN
		);

		event(new NewAdminCreatedEvent($user));

		return $user;
	}

	/**
	 * Create a new user with role User::ROLE_SUPERADMIN.
	 *
	 * @param      $civility
	 * @param      $first_name
	 * @param      $last_name
	 * @param      $email
	 * @param null $birth_date
	 *
	 * @return User
	 */
	public function createNewSuperAdmin(
		$civility,
		$first_name,
		$last_name,
		$email,
		$birth_date = null
	)
	{
		$user = $this->createNewUser(
			$civility,
			$first_name,
			$last_name,
			$email,
			$birth_date,
			User::ROLE_SUPERADMIN
		);

		event(new NewSuperAdminCreatedEvent($user));

		return $user;
	}

	/**
	 * @param \cms\Domain\Users\Users\User $user
	 * @param array                        $environments_reference
	 *
	 * @return mixed
	 */
	public function setUserEnvironments(User $user, array $environments_reference = [])
	{
		if (count($environments_reference) > 0)
		{
			$environments_rows = $this
				->r_environments
				->findWhereIn('reference', $environments_reference);

			$user->environments()->detach();

			$environments_rows
				->each(function ($env) use (&$user)
				{
					$user->environments()->attach($env->id);
				});
		}

		return $user;
	}

	/**
	 * Change user password and fire event "UserUpdatedEvent".
	 *
	 * @param integer $user_id The user ID
	 * @param string  $old_password
	 * @param string  $new_password
	 * @param bool    $force
	 *
	 * @event cms\Domain\Users\Users\Events\UserUpdatedEvent
	 * @return bool
	 */
	public function setUserPassword($user_id, $old_password, $new_password, $force = false)
	{
		$user = $this->find($user_id);

		if (Hash::check($old_password, $user->password) || $force)
		{
			$data = [
				'password' => Hash::make($new_password)
			];

			$user->fill($data)->save();

			event(new UserUpdatedEvent($user));

			return true;
		}

		return false;
	}
}
