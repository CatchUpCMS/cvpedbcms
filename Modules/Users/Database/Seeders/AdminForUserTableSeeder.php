<?php namespace cms\Modules\Users\Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use cms\Domain\Users\Users\User;
use cms\Domain\Users\Roles\Role;
use cms\Domain\Users\ApiKeys\ApiKey;
use cms\Domain\Environments\Environments\Environment;
use cms\Domain\Users\Roles\Repositories\RolesRepositoryEloquent;

/**
 * Class AdminForUserTableSeeder
 * @package cms\Modules\Users\Database\Seeders
 */
class AdminForUserTableSeeder extends Seeder
{

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$faker = Faker::create();

		/*
		 * Admin
		 */

		$user = User::create([
			'last_name'  => 'Antoine',
			'first_name' => 'Benevaut',
			'email'      => 'antoine@cvepdb.fr',
			'password'   => bcrypt('secret'),
			'role'       => User::ROLE_ADMIN
		]);

		$user->environments()->detach();

		$envs = Environment::all();
		foreach ($envs as $env)
		{
			$user->environments()->attach($env->id);
		}

		Model::reguard();
	}
}
