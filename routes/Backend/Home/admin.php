<?php

$router->group(['namespace' => 'Backend\Home', 'prefix' => 'admin','middleware'=>['admin','web']], function () {
    Route::get('admin/index', ['as' => 'admin.admin.index', 'uses' => 'AdminController@index']);
    Route::post('admin/indexdata', ['as' => 'admin.admin.indexdata', 'uses' => 'AdminController@indexData']);
    Route::post('admin/store', ['as' => 'admin.admin.store', 'uses' => 'AdminController@store']);
    Route::get('admin/edit', ['as' => 'admin.admin.edit', 'uses' => 'AdminController@edit']);
    Route::post('admin/pass', ['as' => 'admin.admin.pass', 'uses' => 'AdminController@pass']);
    Route::any('admin/update', ['as' => 'admin.admin.update', 'uses' => 'AdminController@update']);
    Route::any('admin/updateSave', ['as' => 'admin.admin.updateSave', 'uses' => 'AdminController@updateSave']);
    Route::any('admin/del', ['as' => 'admin.admin.del', 'uses' => 'AdminController@del']);
    Route::resource('admin', 'AdminController');
});