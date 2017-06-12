<?php

$router->group(['namespace' => 'Backend\Home', 'prefix' => 'admin','middleware'=>['admin','web']], function () {
    Route::any('authentication/index', ['as' => 'admin.authentication.index', 'uses' => 'AuthenticationController@index']);
    Route::get('authentication/create', ['as' => 'admin.authentication.create', 'uses' => 'AuthenticationController@create']);
    Route::get('authentication/del', ['as' => 'admin.authentication.del', 'uses' => 'AuthenticationController@del']);
    Route::post('authentication/category', ['as' => 'admin.authentication.category', 'uses' => 'AuthenticationController@category']);
    Route::post('authentication/check', ['as' => 'admin.authentication.check', 'uses' => 'AuthenticationController@check']);
    Route::any('authentication/update', ['as' => 'admin.authentication.update', 'uses' => 'AuthenticationController@update']);
    Route::post('authentication/save', ['as' => 'admin.authentication.save', 'uses' => 'AuthenticationController@save']);
    Route::post('authentication/store', ['as' => 'admin.authentication.store', 'uses' => 'AuthenticationController@store']);
    Route::resource('authentication', 'AuthenticationController');
});