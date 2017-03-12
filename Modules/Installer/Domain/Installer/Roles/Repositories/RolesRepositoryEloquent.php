<?php namespace cms\Modules\Installer\Domain\Installer\Roles\Repositories;

use cms\Modules\Installer\Domain\Installer\Roles\Repositories\RolesRepository;
use cms\Domain\Users\Roles\Repositories\RolesRepositoryEloquent as CMSRolesRepositoryEloquent;

/**
 * Class RolesRepositoryEloquent
 * @package cms\Modules\Installer\Domain\Installer\Roles\Repositories
 */
class RolesRepositoryEloquent extends CMSRolesRepositoryEloquent implements RolesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return parent::model();
    }

    /**
     * @param $role_name
     *
     * @return mixed
     */
    public function getRoleIdByName($role_name)
    {
        return $this->findWhere(['name' => $role_name])
            ->first()
            ->id;
    }

}
