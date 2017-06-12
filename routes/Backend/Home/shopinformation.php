<?php

$router->group(['namespace' => 'Backend\Home', 'prefix' => 'admin','middleware'=>['admin','web']], function () {
    Route::get('shopinformation/index', ['as' => 'admin.shopinformation.index', 'uses' => 'ShopInformationController@index']);
    Route::get('shopinformation/create', ['as' => 'admin.shopinformation.create', 'uses' => 'ShopInformationController@create']);
    Route::post('shopinformation/indexdata', ['as' => 'admin.shopinformation.indexdata', 'uses' => 'ShopInformationController@indexData']);
    Route::post('shopinformation/shopinformation', ['as' => 'admin.shopinformation.shopinformation', 'uses' => 'ShopInformationController@shopinformation']);
    Route::post('shopinformation/check', ['as' => 'admin.shopinformation.check', 'uses' => 'ShopInformationController@check']);
    Route::post('shopinformation/doupdate', ['as' => 'admin.shopinformation.doupdate', 'uses' => 'ShopInformationController@doupdate']);
    Route::get('shopinformation/update', ['as' => 'admin.shopinformation.update', 'uses' => 'ShopInformationController@update']);
    Route::get('shopinformation/detail', ['as' => 'admin.shopinformation.detail', 'uses' => 'ShopInformationController@detail']);
    Route::post('shopinformation/store', ['as' => 'admin.shopinformation.store', 'uses' => 'ShopInformationController@store']);
    Route::any('shopinformation/del', ['as' => 'admin.shopinformation.del', 'uses' => 'ShopInformationController@del']);
    Route::resource('shopinformation', 'ShopInformationController');
});

