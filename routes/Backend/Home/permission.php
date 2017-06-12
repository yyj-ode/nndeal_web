<?php
/**
 * 权限管理路由
 */
$router->group(['namespace' => 'Backend\Home', 'prefix' => 'admin', 'middleware' => ['web', 'auth', 'authAdmin']], function () {

    Route::get('permission/{cid}/create', ['as' => 'admin.permission.create', 'uses' => 'PermissionController@create']);
    Route::get('permission/{cid}/edit', ['as' => 'admin.permission.edit', 'uses' => 'PermissionController@edit']);
    Route::get('permission/{cid?}', ['as' => 'admin.permission.index', 'uses' => 'PermissionController@index']);

    Route::get('permission/index', ['as' => 'admin.permission.index', 'uses' => 'PermissionController@index']); //查询
    Route::post('permission/index', ['as' => 'admin.permission.index', 'uses' => 'PermissionController@index']); //查询

    Route::put('permission/update', ['as' => 'admin.permission.edit', 'uses' => 'PermissionController@update']); //修改
    Route::post('permission/store', ['as' => 'admin.permission.create', 'uses' => 'PermissionController@store']); //添加

    Route::resource('permission', 'PermissionController');
});