<?php namespace Modules\Users\Criterias;

use Prettus\Repository\Contracts\RepositoryInterface;
use Core\Criterias\Criteria as AbsCriteria;

/**
 * Class EmailLikeCriteria
 * @package Modules\Users\Criterias
 */
class EmailLikeCriteria extends AbsCriteria
{
    /**
     * @var string emails list
     */
    private $emails = null;

    /**
     * @param string $emails
     */
    public function __construct($emails = '')
    {
        $this->emails = $emails;
    }

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        return $model->where('email', 'LIKE', '%' . $this->emails . '%');
    }
}
