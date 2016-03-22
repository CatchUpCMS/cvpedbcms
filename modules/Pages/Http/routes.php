<?php

Route::group(['middleware' => 'web', 'namespace' => 'Modules\Pages\Http\Controllers'], function()
{
	Route::get('/', 'PagesController@index');

	Route::get('{page}/{subs}', 'PagesController@index')
		->where([
			'page' => '^((?![admin|themes|assets|modules|uploads]).)*$', // config('pages.route_pattern') // todo check PagesServiceProvider
			'subs' => '.*'
		]);
});

//App::after(function($request, $response) {
//	/**
//	 * This route is registered as last route
//	 */
//	Route::group(['middleware' => 'web', 'namespace' => 'Modules\Pages\Http\Controllers'], function() {
//		Route::any('(.*)', 'PagesController@index');
//	});
//});

Route::group(['middleware' => ['web', 'CMSInstalled', 'auth', 'role:admin'], 'prefix' => 'admin', 'namespace' => 'Modules\Pages\Http\Controllers'], function()
{
	Route::resource('pages', 'PagesAdminController');
});
