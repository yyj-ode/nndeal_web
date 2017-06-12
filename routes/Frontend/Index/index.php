<?php

$router->group(['namespace' => 'Frontend\Index', 'prefix' => 'index'], function () {
    Route::get('en', ['as' => 'index.ne', 'uses' => 'IndexController@en']);
    Route::get('demo', ['as' => 'index.demo', 'uses' => 'IndexController@demo', 'middleware' => 'throttle:100']);
    Route::get('index', ['as' => 'index.index', 'uses' => 'IndexController@index']);
    Route::post('store', ['as' => 'index.store', 'uses' => 'IndexController@store']);
    Route::post('captcha', ['as' => 'index.captcha', 'uses' => 'IndexController@captcha']);

    Route::get('wechat', ['as' => 'index.wechat', 'uses' => 'IndexController@wechat']);
    Route::post('dowechat', ['as' => 'index.dowechat', 'uses' => 'IndexController@dowechat']);

    Route::post('checklogin', ['as' => 'user.checklogin', 'uses' => 'IndexController@checkLogin']);
});
