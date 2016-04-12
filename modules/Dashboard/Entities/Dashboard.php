<?php namespace Modules\Dashboard\Entities;

use Core\Entities\Model;

class Dashboard extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'dashboard';

    protected $fillable = [
        'name',
        'module',
        'status',
    ];

}
