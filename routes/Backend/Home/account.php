<?php

$router->group(['namespace' => 'Backend\Home', 'prefix' => 'admin','middleware'=>['admin','web']], function () {
    Route::get('account/index', ['as' => 'admin.account.index', 'uses' => 'AccountController@index']);
    Route::post('account/indexdata', ['as' => 'admin.account.indexdata', 'uses' => 'AccountController@indexData']);
    Route::post('account/store', ['as' => 'admin.account.store', 'uses' => 'AccountController@store']);
    Route::get('account/edit', ['as' => 'admin.account.edit', 'uses' => 'AccountController@edit']);
    Route::post('account/pass', ['as' => 'admin.account.pass', 'uses' => 'AccountController@pass']);
    Route::any('account/update', ['as' => 'admin.account.update', 'uses' => 'AccountController@update']);
    Route::any('account/updateSave', ['as' => 'admin.account.updateSave', 'uses' => 'AccountController@updateSave']);
    Route::any('account/del', ['as' => 'admin.account.del', 'uses' => 'AccountController@del']);
    Route::resource('admin', 'AdminController');
});