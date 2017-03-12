<?php

Route::group(
	[
		'middleware' => [
			'web',
			'admin'
		],
		'prefix'     => 'backend',
		'as'         => 'backend.',
		'namespace'  => 'cms\Modules\Themes\Http\Controllers\Backend'
	],
	function ()
	{
		Route::resource('themes', 'SettingsController');
	}
);
