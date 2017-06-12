<?php

$router->group(['namespace' => 'Frontend\Shop', 'prefix' => 'shop'], function () {
    Route::get('index', ['as' => 'shop.index', 'uses' => 'ShopController@index']);
    Route::get('create', ['as' => 'shop.create', 'uses' => 'ShopController@create']);
    Route::post('store', ['as' => 'shop.store', 'uses' => 'ShopController@store']);
});
