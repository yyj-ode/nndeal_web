<?php

$router->group(['namespace' => 'Backend\Home', 'prefix' => 'admin','middleware'=>['admin','web']], function () {
    Route::get('user/index', ['as' => 'admin.user.index', 'uses' => 'UserController@index']);
    Route::post('user/indexdata', ['as' => 'admin.user.indexdata', 'uses' => 'UserController@indexData']);
    Route::post('user/category', ['as' => 'admin.user.category', 'uses' => 'UserController@category']);
    Route::post('user/check', ['as' => 'admin.user.check', 'uses' => 'UserController@check']);
    Route::post('user/update', ['as' => 'admin.user.update', 'uses' => 'UserController@update']);
    Route::post('user/edit', ['as' => 'admin.user.edit', 'uses' => 'UserController@edit']);

    Route::resource('user', 'UserController');
});