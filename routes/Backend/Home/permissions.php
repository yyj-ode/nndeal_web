<?php

$router->group(['namespace' => 'Backend\Home', 'prefix' => 'admin','middleware'=>['admin','web']], function () {
    Route::get('permissions/index', ['as' => 'admin.permissions.index', 'uses' => 'PermissionsController@index']);
    Route::post('permissions/indexdata', ['as' => 'admin.permissions.indexdata', 'uses' => 'PermissionsController@indexData']);
    Route::get('permissions/create', ['as' => 'admin.permissions.create', 'uses' => 'PermissionsController@create']);
    Route::post('permissions/store', ['as' => 'admin.permissions.store', 'uses' => 'PermissionsController@store']);
    Route::any('permissions/update', ['as' => 'admin.permissions.update', 'uses' => 'PermissionsController@update']);
    Route::any('permissions/update_save', ['as' => 'admin.permissions.update_save', 'uses' => 'PermissionsController@update_save']);
    Route::any('permissions/del', ['as' => 'admin.permissions.del', 'uses' => 'PermissionsController@del']);
    Route::get('permissions/permissions', ['as' => 'admin.permissions.permissions', 'uses' => 'PermissionsController@permissions']);
    Route::post('permissions/permissionsSave', ['as' => 'admin.permissions.permissionsSave', 'uses' => 'PermissionsController@permissionsSave']);
    Route::resource('admin', 'AdminController');
});