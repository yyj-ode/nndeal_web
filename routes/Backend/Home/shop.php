<?php

$router->group(['namespace' => 'Backend\Home', 'prefix' => 'admin','middleware'=>['admin','web']], function () {
    Route::get('shop/index', ['as' => 'admin.shop.index', 'uses' => 'ShopController@index']);
    Route::get('shop/create', ['as' => 'admin.shop.create', 'uses' => 'ShopController@create']);
    Route::post('shop/indexdata', ['as' => 'admin.shop.indexdata', 'uses' => 'ShopController@indexData']);
    Route::post('shop/shop', ['as' => 'admin.shop.shop', 'uses' => 'ShopController@shop']);
    Route::post('shop/check', ['as' => 'admin.shop.check', 'uses' => 'ShopController@check']);
    Route::get('shop/update', ['as' => 'admin.shop.update', 'uses' => 'ShopController@update']);
    Route::post('shop/store', ['as' => 'admin.shop.store', 'uses' => 'ShopController@store']);
    Route::any('shop/del', ['as' => 'admin.shop.del', 'uses' => 'ShopController@del']);
    Route::resource('shop', 'ShopController');
});