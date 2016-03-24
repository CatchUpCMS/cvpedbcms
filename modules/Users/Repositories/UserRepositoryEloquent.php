<?php namespace Modules\Users\Repositories;

use Modules\Users\Entities\User;
use CVEPDB\Repositories\Users\UserRepositoryEloquent as UserRepositoryEloquentParent;

/**
 * Class UserRepositoryEloquent
 * @package namespace App\Repositories;
 */
class UserRepositoryEloquent extends UserRepositoryEloquentParent
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    public function allWithTrashed()
    {
        return User::withTrashed()->get();
    }

    public function onlyTrashed()
    {
        return User::onlyTrashed()->get();
    }

    public function allCount()
    {
        return User::all()->count();
    }
}
