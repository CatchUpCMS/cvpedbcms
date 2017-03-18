<?php

Route::group(
    [
        'middleware' => [
            'web',
            'super-administrator'
        ],
        'prefix' => 'backend',
        'as' => 'backend.',
        'namespace' => 'cms\Modules\Environments\Http\Controllers\Backend'
    ],
    function () {
        Route::resource('environments', 'EnvironmentsController');
    }
);
