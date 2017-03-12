<?php

Route::group(
    [
        'middleware' => [
            'web',
            'admin'
        ],
        'prefix' => 'backend',
        'as' => 'backend.',
        'namespace' => 'cms\Modules\Files\Http\Controllers\Backend'
    ],
    function () {
        Route::group(['prefix' => 'files', 'as' => 'files.'], function () {
            Route::resource('settings', 'SettingsController');
        });

        Route::resource('files', 'FilesController');
    }
);

Route::group(
    [
        'middleware' => [
            'web',
        ],
        'prefix' => 'files/ajax',
        'as' => 'files.ajax.',
        'namespace' => 'cms\Modules\Files\Http\Controllers\Ajax'
    ],
    function () {
        Route::any('connector', ['as' => 'elfinder.connector', 'uses' => 'FilesController@showConnector']);
        Route::get('tinymce4', ['as' => 'elfinder.tinymce4', 'uses' => 'FilesController@showTinyMCE4']);
        Route::get('popup/{input_id}', ['as' => 'elfinder.popup', 'uses' => 'FilesController@showPopup']);
    }
);

//Route::get('glide/{path}', function ($path)
//{
//	$server = \League\Glide\ServerFactory::create([
//		'source' => app('filesystem')->disk('thumbnails')->getDriver(),
//		'cache'  => storage_path('glide'),
//	]);
//
//	return $server->getImageResponse($path, Input::query());
//})->where('path', '.+');
