<?php namespace cms\Modules\Users\Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use cms\Domain\Users\Users\User;
use cms\Domain\Users\Roles\Role;
use cms\Domain\Users\ApiKeys\ApiKey;
use cms\Domain\Environments\Environments\Environment;
use cms\Domain\Environments\Environments\Repositories\EnvironmentsRepositoryEloquent;

/**
 * Class UserTableSeeder
 * @package cms\Modules\Users\Database\Seeders
 */
class UserTableSeeder extends Seeder
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
         * Users
         */

        $env = Environment::where(
            [
                'reference' => EnvironmentsRepositoryEloquent::DEFAULT_ENVIRONMENT_REFERENCE
            ]
        )
            ->firstOrFail();

        foreach (range(1, 1000) as $index) {
            $user = User::create([
                'last_name' => $faker->lastName,
                'first_name' => $faker->firstName,
                'email' => $faker->email,
                'password' => bcrypt('secret'),
                'role' => User::ROLE_USER
            ]);

            $user->environments()->detach();
            $user->environments()->attach($env->id);
        }
        Model::reguard();
    }

}
