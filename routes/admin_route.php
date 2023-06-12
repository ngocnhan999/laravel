<?php

Route::group(['namespace' => 'Auth'], function () {

    Route::get('login', 'LoginController@showLoginForm')->name('access.login');
    Route::post('login', 'LoginController@login')->name('access.login');

    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('access.password.request');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('access.password.email');

    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('access.password.reset');
    Route::post('password/reset', 'ResetPasswordController@reset')->name('access.password.reset.post');
});


Route::group([
    'middleware' => 'admin'
], function () {

    Route::get('logout', [
        'as'         => 'access.logout',
        'uses'       => 'Auth\LoginController@logout',
        'permission' => false,
    ]);

    Route::get('/', [
        'as'         => 'dashboard.index',
        'uses'       => 'DashboardController@index',
        'permission' => false,
    ]);


    Route::resource('roles', 'RoleController');
    Route::resource('users', 'UserController');

    Route::group(['prefix' => 'settings'], function () {
        Route::get('general/', [
            'as'         => 'settings.options',
            'uses'       => 'SettingController@getOptions',
            'permission' => false,
        ]);


        Route::group([
            'prefix'     => 'email',
            'permission' => 'settings.email'
        ], function () {

            Route::get('', [
                'as'   => 'settings.email',
                'uses' => 'SettingController@getEmailConfig',
            ]);

            Route::post('edit', [
                'as'   => 'settings.email.edit',
                'uses' => 'SettingController@postEditEmailConfig',
            ]);

            Route::post('test/send', [
                'as'   => 'setting.email.send.test',
                'uses' => 'SettingController@postSendTestEmail',
            ]);
        });
    });

    Route::resource('audit-logs', 'AuditHistoryController', ['names' => 'audit-log'])->only(['index', 'destroy']);
});
