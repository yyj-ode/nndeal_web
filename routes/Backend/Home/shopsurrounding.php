<?php

$router->group(['namespace' => 'Backend\Home', 'prefix' => 'admin','middleware'=>['admin','web']], function () {
    Route::get('shopsurrounding/index', ['as' => 'admin.shopsurrounding.index', 'uses' => 'ShopSurroundingController@index']);
    Route::get('shopsurrounding/create', ['as' => 'admin.shopsurrounding.create', 'uses' => 'ShopSurroundingController@create']);
    Route::post('shopsurrounding/indexdata', ['as' => 'admin.shopsurrounding.indexdata', 'uses' => 'ShopSurroundingController@indexData']);
    Route::post('shopsurrounding/shopsurrounding', ['as' => 'admin.shopsurrounding.shopsurrounding', 'uses' => 'ShopSurroundingController@shopsurrounding']);
    Route::post('shopsurrounding/check', ['as' => 'admin.shopsurrounding.check', 'uses' => 'ShopSurroundingController@check']);
    Route::post('shopsurrounding/doupdate', ['as' => 'admin.shopsurrounding.doupdate', 'uses' => 'ShopSurroundingController@doupdate']);
    Route::get('shopsurrounding/update', ['as' => 'admin.shopsurrounding.update', 'uses' => 'ShopSurroundingController@update']);
    Route::get('shopsurrounding/detail', ['as' => 'admin.shopsurrounding.detail', 'uses' => 'ShopSurroundingController@detail']);
    Route::post('shopsurrounding/store', ['as' => 'admin.shopsurrounding.store', 'uses' => 'ShopSurroundingController@store']);
    Route::any('shopsurrounding/del', ['as' => 'admin.shopsurrounding.del', 'uses' => 'ShopSurroundingController@del']);
    Route::resource('shopsurrounding', 'ShopSurroundingController');
});

