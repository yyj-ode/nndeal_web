<?php

$router->group(['namespace' => 'Backend\Home', 'prefix' => 'admin','middleware'=>['admin','web']], function () {
    Route::get('shopline/index', ['as' => 'admin.shopline.index', 'uses' => 'ShopLineController@index']);
    Route::post('shopline/indexdata', ['as' => 'admin.shopline.index', 'uses' => 'ShopLineController@indexdata']);
    Route::any('shopline/check', ['as' => 'admin.shopline.check', 'uses' => 'ShopLineController@check']);
    Route::post('shopline/store', ['as' => 'admin.shopline.store', 'uses' => 'ShopLineController@store']);
    Route::post('shopline/update_save', ['as' => 'admin.shopline.update_save', 'uses' => 'ShopLineController@update_save']);
    Route::get('shopline/stream', ['as' => 'admin.shopline.stream', 'uses' => 'ShopLineController@stream']);
    Route::post('shopline/stream_save', ['as' => 'admin.shopline.stream_save', 'uses' => 'ShopLineController@stream_save']);
    Route::any('shopline/del', ['as' => 'admin.shopline.del', 'uses' => 'ShopLineController@del']);
    Route::get('shopline/create', ['as' => 'admin.shopline.create', 'uses' => 'ShopLineController@create']);
    Route::any('shopline/update', ['as' => 'admin.shopline.update', 'uses' => 'ShopLineController@update']);
    Route::resource('admin', 'AdminController');
});