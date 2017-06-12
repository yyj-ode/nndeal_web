<?php

$router->group(['namespace' => 'Backend\Home', 'prefix' => 'admin','middleware'=>['admin','web']], function () {
    Route::get('goods/index', ['as' => 'admin.goods.index', 'uses' => 'GoodsController@index']);
    Route::get('goods/create', ['as' => 'admin.goods.create', 'uses' => 'GoodsController@create']);
    Route::post('goods/indexdata', ['as' => 'admin.goods.indexdata', 'uses' => 'GoodsController@indexData']);
    Route::post('goods/goods', ['as' => 'admin.goods.goods', 'uses' => 'GoodsController@goods']);
    Route::post('goods/check', ['as' => 'admin.goods.check', 'uses' => 'GoodsController@check']);
    Route::get('goods/update', ['as' => 'admin.goods.update', 'uses' => 'GoodsController@update']);
    Route::post('goods/store', ['as' => 'admin.goods.store', 'uses' => 'GoodsController@store']);
    Route::any('goods/del', ['as' => 'admin.goods.del', 'uses' => 'GoodsController@del']);
    Route::resource('goods', 'GoodsController');
});