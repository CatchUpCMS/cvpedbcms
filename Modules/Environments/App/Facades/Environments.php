<?php namespace cms\Modules\Environments\App\Facades;

use cms\Infrastructure\Abstractions\FacadeAbstract;

/**
 * Class Environments
 * @package cms\Modules\Environments\App\Facades
 */
class Environments extends FacadeAbstract
{

	protected static function getFacadeAccessor()
	{
		return 'environment';
	}
}
