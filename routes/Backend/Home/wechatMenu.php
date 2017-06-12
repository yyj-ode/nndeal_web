<?php

$router->group(['namespace' => 'Backend\Home', 'prefix' => 'admin','middleware'=>['admin','web']], function () {
    Route::get('wechatMenu/index', ['as' => 'admin.wechatMenu.index', 'uses' => 'WechatMenuController@index']);
    Route::post('wechatMenu/indexdata', ['as' => 'admin.wechatMenu.indexdata', 'uses' => 'WechatMenuController@indexData']);
    Route::get('wechatMenu/create', ['as' => 'admin.wechatMenu.create', 'uses' => 'WechatMenuController@create']);
    Route::post('wechatMenu/store', ['as' => 'admin.wechatMenu.store', 'uses' => 'WechatMenuController@store']);
    Route::any('wechatMenu/update', ['as' => 'admin.wechatMenu.update', 'uses' => 'WechatMenuController@update']);
    Route::any('wechatMenu/update_save', ['as' => 'admin.wechatMenu.update_save', 'uses' => 'WechatMenuController@update_save']);
    Route::any('wechatMenu/del', ['as' => 'admin.wechatMenu.del', 'uses' => 'WechatMenuController@del']);
    Route::get('wechatMenu/permissions', ['as' => 'admin.wechatMenu.permissions', 'uses' => 'WechatMenuController@permissions']);
    Route::post('wechatMenu/permissionsSave', ['as' => 'admin.wechatMenu.permissionsSave', 'uses' => 'WechatMenuController@permissionsSave']);
    Route::get('wechatMenu/son', ['as' => 'admin.wechatMenu.son', 'uses' => 'WechatMenuController@son']);
    Route::post('wechatMenu/indexDataSon', ['as' => 'admin.wechatMenu.indexDataSon', 'uses' => 'WechatMenuController@indexDataSon']);
    Route::get('wechatMenu/soncreate', ['as' => 'admin.wechatMenu.soncreate', 'uses' => 'WechatMenuController@soncreate']);
    Route::post('wechatMenu/storeson', ['as' => 'admin.wechatMenu.storeson', 'uses' => 'WechatMenuController@storeson']);
    Route::any('wechatMenu/updateson', ['as' => 'admin.wechatMenu.updateson', 'uses' => 'WechatMenuController@updateson']);
    Route::any('wechatMenu/update_save_son', ['as' => 'admin.wechatMenu.update_save_son', 'uses' => 'WechatMenuController@update_save_son']);
    Route::resource('admin', 'AdminController');
});