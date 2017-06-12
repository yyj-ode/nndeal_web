<?php
/**
 * 角色管理路由
 */
$router->group(['namespace' => 'Backend\Home','prefix' => 'admin', 'middleware' => ['web', 'auth', 'authAdmin']], function () {

    Route::get('role/index', ['as' => 'admin.role.index', 'uses' => 'RoleController@index']);
    Route::post('role/index', ['as' => 'admin.role.index', 'uses' => 'RoleController@index']);
    Route::resource('role', 'RoleController');
    Route::put('role/update', ['as' => 'admin.role.edit', 'uses' => 'RoleController@update']); //修改
    Route::post('role/store', ['as' => 'admin.role.create', 'uses' => 'RoleController@store']); //添加

});