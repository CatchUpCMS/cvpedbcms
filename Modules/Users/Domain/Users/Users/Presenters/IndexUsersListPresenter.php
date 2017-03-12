<?php namespace cms\Modules\Users\Domain\Users\Users\Presenters;

use cms\Modules\Users\Domain\Users\Users\Transformers\IndexUsersListTransformer;
use cms\Infrastructure\Abstractions\Presenters\FractalPresenterAbstract;

/**
 * Class IndexUsersListPresenter
 * @package cms\Modules\Users\Domain\Users\Users\Presenters
 */
class IndexUsersListPresenter extends FractalPresenterAbstract
{
	/**
	 * Transformer
	 *
	 * @return \League\Fractal\TransformerAbstract
	 */
	public function getTransformer()
	{
		return new IndexUsersListTransformer();
	}
}
