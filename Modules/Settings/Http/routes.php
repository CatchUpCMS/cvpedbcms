<?php

Route::group(
    [
        'middleware' => [
            'web',
            'admin'
        ],
        'prefix' => 'backend',
        'as' => 'backend.',
        'namespace' => 'cms\Modules\Settings\Http\Controllers\Backend'
    ],
    function () {
        Route::resource('settings', 'SettingsController');
    }
);

Route::group(
    [
        'middleware' => [
            'web',
            'ajax'
        ],
        'prefix' => 'ajax',
        'as' => 'ajax.',
        'namespace' => 'cms\Modules\Settings\Http\Controllers\Ajax'
    ],
    function () {
        Route::post('settings/set', ['as' => 'setsettings', 'uses' => 'SettingsController@set']);
        Route::get('settings/get', ['as' => 'getsettings', 'uses' => 'SettingsController@get']);
    }
);
