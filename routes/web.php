<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('/', function () {
        return redirect(route(cms_route_frontend()));
    });
});

/**
 * Ajax routes.
 */
Route::group(['prefix' => 'ajax', 'as' => 'ajax.', 'namespace' => 'Ajax'], function () {

    /**
     * ADDRESSES ROUTES
     */

    Route::group(['prefix' => 'addresses', 'as' => 'addresses.'], function () {
        Route::resource('states', '\CVEPDB\Addresses\Http\Controllers\States\AjaxStatesController');
        Route::resource('substates', '\CVEPDB\Addresses\Http\Controllers\SubStates\AjaxSubStatesController');
    });

});
