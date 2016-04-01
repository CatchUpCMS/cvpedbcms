<?php namespace Modules\Users\Entities;

use CVEPDB\Repositories\Roles\Role as RoleModel;

/**
 * Class Role
 * @package Modules\Users\Entities
 */
class Role extends RoleModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'display_name',
        'description',
        'unchangeable',
    ];
}