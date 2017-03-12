<?php

Route::group(
    [
        'middleware' => [
            'web',
            'admin'
        ],
        'prefix' => 'backend',
        'namespace' => 'cms\Modules\Environments\Http\Controllers\Backend'
    ],
    function () {
        Route::resource('environments', 'EnvironmentsController');
    }
);
