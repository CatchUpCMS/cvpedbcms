<?php

Route::group(
    [
        'middleware' => [
            'web',
            'installer'
        ],
        'prefix' => 'installer',
        'as' => 'installer.',
        'namespace' => 'cms\Modules\Installer\Http\Controllers'
    ],
    function () {
        Route::get('/', ['as' => 'index', 'uses' => 'InstallerController@index']);
        Route::post('store', ['as' => 'store', 'uses' => 'InstallerController@store']);
        Route::get('migration', ['as' => 'migrate', 'uses' => 'InstallerController@runMigration']);
        Route::get('initialisation', ['as' => 'initialize', 'uses' => 'InstallerController@initialiseProduction']);
    }
);
