<?php namespace Modules\Users\Criterias;

use Prettus\Repository\Contracts\RepositoryInterface;
use Core\Criterias\Criteria as AbsCriteria;

/**
 * Class RolesCriteria
 * @package Modules\Users\Criterias
 */
class RolesCriteria extends AbsCriteria
{
    /**
     * @var array roles list of roles IDs
     */
    private $roles = [];

    /**
     * @param array $roles
     */
    public function __construct($roles = [])
    {
        $this->roles = array_filter($roles);
    }

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        if (count($this->roles)) {
            return $model->leftJoin('role_user', 'users.id', '=', 'role_user.user_id')
                ->leftJoin('roles', 'roles.id', '=', 'role_user.role_id')
                ->whereIn('roles.id', $this->roles)
                ->groupBy('users.id');
        }
        return $model;
    }
}
