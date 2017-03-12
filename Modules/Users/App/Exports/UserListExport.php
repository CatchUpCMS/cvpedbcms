<?php namespace cms\Modules\Users\App\Exports;

use cms\Infrastructure\Abstractions\ExcelFileAbstract;

/**
 * Class UserListExport
 * @package cms\Modules\Users\App\Exports
 */
class UserListExport extends ExcelFileAbstract
{

	/**
	 * @return string
	 */
	public function getFilename()
	{
		return sprintf(
			trans('users::backend.export.users_list_title'),
			date('Y-m-d_H-i-s')
		);
	}

}
