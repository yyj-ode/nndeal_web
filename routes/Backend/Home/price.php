<?php

$router->group(['namespace' => 'Backend\Home', 'prefix' => 'admin','middleware'=>['admin','web']], function () {
    Route::get('price/index', ['as' => 'admin.price.index', 'uses' => 'PriceController@index']);
    Route::get('price/create', ['as' => 'admin.price.create', 'uses' => 'PriceController@create']);
    Route::post('price/indexdata', ['as' => 'admin.price.indexdata', 'uses' => 'PriceController@indexData']);
    Route::post('price/price', ['as' => 'admin.price.price', 'uses' => 'PriceController@price']);
    Route::post('price/check', ['as' => 'admin.price.check', 'uses' => 'PriceController@check']);
    Route::get('price/update', ['as' => 'admin.price.update', 'uses' => 'PriceController@update']);
    Route::post('price/store', ['as' => 'admin.price.store', 'uses' => 'PriceController@store']);
    Route::any('price/del', ['as' => 'admin.price.del', 'uses' => 'PriceController@del']);
    Route::resource('price', 'PriceController');
});