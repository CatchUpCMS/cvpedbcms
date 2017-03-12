<?php namespace Modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TestingSeeder
 * @package Modules\Users\Database\Seeders
 */
class TestingSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call('Modules\Users\Database\Seeders\AdminForUserTableSeeder');
        $this->call('Modules\Users\Database\Seeders\UserTableSeeder');
        Model::reguard();
    }

}