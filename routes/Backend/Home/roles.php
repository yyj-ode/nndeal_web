<?php

$router->group(['namespace' => 'Backend\Home', 'prefix' => 'admin','middleware'=>['admin','web']], function () {
    Route::get('roles/index', ['as' => 'admin.roles.index', 'uses' => 'RolesController@index']);
    Route::post('roles/indexdata', ['as' => 'admin.roles.indexdata', 'uses' => 'RolesController@indexData']);
    Route::get('roles/create', ['as' => 'admin.roles.create', 'uses' => 'RolesController@create']);
    Route::post('roles/store', ['as' => 'admin.roles.store', 'uses' => 'RolesController@store']);
    Route::any('roles/update', ['as' => 'admin.roles.update', 'uses' => 'RolesController@update']);
    Route::any('roles/update_save', ['as' => 'admin.roles.update_save', 'uses' => 'RolesController@update_save']);
    Route::any('roles/del', ['as' => 'admin.roles.del', 'uses' => 'RolesController@del']);
    Route::get('roles/permissions', ['as' => 'admin.roles.permissions', 'uses' => 'RolesController@permissions']);
    Route::post('roles/permissionsSave', ['as' => 'admin.roles.permissionsSave', 'uses' => 'RolesController@permissionsSave']);
    Route::resource('admin', 'AdminController');
});