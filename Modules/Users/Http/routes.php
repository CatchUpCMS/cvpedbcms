<?php

Route::group(['middleware' => ['web'], 'namespace' => 'cms\Modules\Users\Http\Controllers\Frontend'], function () {
    // Authentication routes
    Route::get('login', 'LoginController@showLoginForm');
    Route::post('login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout');

    Route::group(['prefix' => 'password'], function () {
        // Password reset link request routes
        Route::get('reset', 'ForgotPasswordController@showLinkRequestForm');
        Route::post('email', 'ForgotPasswordController@sendResetLinkEmail');
        // Password reset routes
        Route::get('reset/{token}', 'ResetPasswordController@showResetForm');
        Route::post('reset', 'ResetPasswordController@reset');
    });
    // Social Login
    Route::get('login/{provider?}', ['as' => 'login.provider', 'uses' => 'LoginController@redirectToProvider']);
    // Login callbacks
    Route::get('login/callback/{provider?}', ['uses' => 'LoginController@handleProviderCallback']);
});

Route::group(['middleware' => ['web'], 'prefix' => 'backend', 'as' => 'backend.', 'namespace' => 'cms\Modules\Users\Http\Controllers\Backend'], function () {
    // Authentication routes
    Route::get('login', ['as' => 'login', 'uses' => 'LoginController@showLoginForm']);
    Route::post('login', ['as' => 'postlogin', 'uses' => 'LoginController@login']);
    Route::get('logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);
});

Route::group(['middleware' => ['web', 'user'], 'namespace' => 'cms\Modules\Users\Http\Controllers\Frontend'], function () {
    //Route::resource('users', 'UsersController');
    Route::get('users', ['as' => 'users.index', 'uses' => 'UsersController@index']);
    Route::get('users/my-profile', ['as' => 'users.my-profile', 'uses' => 'UsersController@myProfile']);
    Route::get('users/edit-my-profile', ['as' => 'users.edit-my-profile', 'uses' => 'UsersController@editMyProfile']);
    Route::put('users/update-my-profile', ['as' => 'users.update-my-profile', 'uses' => 'UsersController@updateMyProfile']);
    Route::get('users/edit-my-password', ['as' => 'users.edit-my-password', 'uses' => 'UsersController@editMyPassword']);
    Route::put('users/update-my-password', ['as' => 'users.update-my-password', 'uses' => 'UsersController@updateMyPassword']);
});

Route::group(['middleware' => ['web', 'admin'], 'prefix' => 'backend', 'as' => 'backend.', 'namespace' => 'cms\Modules\Users\Http\Controllers\Backend'], function () {
    Route::resource('users/settings', 'SettingsController');
    Route::get('users/impersonate/{id}', ['as' => 'backend.users.impersonate', 'uses' => 'UsersController@impersonate']);
    Route::get('users/endimpersonate', ['as' => 'backend.users.endimpersonate', 'uses' => 'UsersController@endimpersonate']);
    Route::get('users/reset-password/{id}', ['as' => 'backend.users.resetpassword', 'uses' => 'UsersController@resetpassword']);
    Route::get('users/export', ['as' => 'backend.users.export', 'uses' => 'UsersController@export']);
    Route::delete('users/destroy_multiple', ['as' => 'backend.users.destroy_multiple', 'uses' => 'UsersController@destroy_multiple']);
    Route::delete('users/reactive/{id}', ['as' => 'backend.users.reactive', 'uses' => 'UsersController@reactive']);
    Route::resource('users', 'UsersController');
    Route::resource('roles', 'RolesController');
});

//Route::group(['middleware' => ['api'], 'prefix' => 'api', 'as' => 'api.', 'namespace' => 'cms\Modules\Users\Http\Controllers\Api'], function ()
//{
//	Route::group(['prefix' => 'v1', 'as' => 'v1.'], function ()
//	{
//		Route::get('users/profile', ['as' => 'users.profile', 'uses' => 'UsersController@userProfile']);
//		Route::resource('users', 'UsersController');
//	});
//});
