<?php namespace cms\Modules\Users\Domain\Users\Users\Presenters;

use cms\Modules\Users\Domain\Users\Users\Transformers\UserListExcelTransformer;
use cms\Infrastructure\Abstractions\Presenters\FractalPresenterAbstract;

/**
 * Class UserListExcelPresenter
 * @package cms\Modules\Users\Domain\Users\Users\Presenters
 */
class UserListExcelPresenter extends FractalPresenterAbstract
{
	/**
	 * Transformer
	 *
	 * @return \League\Fractal\TransformerAbstract
	 */
	public function getTransformer()
	{
		return new UserListExcelTransformer();
	}
}
