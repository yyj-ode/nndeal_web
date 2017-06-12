<?php

$router->group(['namespace' => 'Backend\Home', 'prefix' => 'admin','middleware'=>['admin','web']], function () {
    Route::get('shoponline/index', ['as' => 'admin.shoponline.index', 'uses' => 'ShopOnlineController@index']);
    Route::get('shoponline/create', ['as' => 'admin.shoponline.create', 'uses' => 'ShopOnlineController@create']);
    Route::post('shoponline/store', ['as' => 'admin.shoponline.store', 'uses' => 'ShopOnlineController@store']);
    Route::post('shoponline/indexdata', ['as' => 'admin.shoponline.indexdata', 'uses' => 'ShopOnlineController@indexdata']);
    Route::any('shoponline/update', ['as' => 'admin.shoponline.update', 'uses' => 'ShopOnlineController@update']);
    Route::any('shoponline/update_save', ['as' => 'admin.shoponline.update_save', 'uses' => 'ShopOnlineController@update_save']);
    Route::any('shoponline/del', ['as' => 'admin.shoponline.del', 'uses' => 'ShopOnlineController@del']);
    Route::resource('admin', 'AdminController');
});