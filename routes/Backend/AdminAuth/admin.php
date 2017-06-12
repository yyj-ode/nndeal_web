<?php
$router->group(['namespace' => 'Backend\AdminAuth', 'prefix' => 'admin'], function () {
    /**
     * Admin Login
     */
    Route::get('login', ['as' => 'admin.login', 'uses' => 'LoginController@showLoginForm']);
    Route::post('login', ['as' => 'admin.login', 'uses' => 'LoginController@login']);
    Route::get('logout', ['as' => 'admin.logout', 'uses' => 'LoginController@logout']);

    /**
     * Admin Register
     */
    Route::get('register', ['as' => 'admin.register', 'uses' => 'RegisterController@showRegistrationForm']);
    Route::post('register', ['as' => 'admin.register', 'uses' => 'RegisterController@register']);

    /**
     * Admin Passwords
     */
    Route::post('password/email', ['as' => 'admin.password.email', 'uses' => 'ForgotPasswordController@sendResetLinkEmail']);
    Route::post('password/reset', ['as' => 'admin.password.reset', 'uses' => 'ResetPasswordController@reset']);
    Route::get('password/reset', ['as' => 'admin.password.reset', 'uses' => 'ForgotPasswordController@showLinkRequestForm']);
    Route::get('password/reset/{token}', ['as' => 'admin.password.reset', 'uses' => 'ResetPasswordController@showResetForm']);

    /**
     *
     */
    Route::get('captcha', ['as' => 'backend.adminauth.captcha', 'uses' => 'CaptchaController@index']);
});

