<?php namespace Modules\Users\Outputters;

use Config;
use App\Http\Admin\Outputters\AdminOutputter;

class AuthAdminOutputter extends AdminOutputter
{
    /**
     * @var string Outputter header title
     */
    protected $title = 'users::login.backend_meta_title';

    /**
     * @var string Outputter header description
     */
    protected $description = 'users::login.backend_meta_description';

    public function __construct()
    {
        parent::__construct();
        $this->set_current_module('users');
    }
}