<?php

$router->group(['namespace' => 'Backend\Home', 'prefix' => 'admin','middleware'=>['admin','web']], function () {
    Route::get('shoppingcenter/index', ['as' => 'admin.shoppingcenter.index', 'uses' => 'ShoppingCenterController@index']);
    Route::get('shoppingcenter/create', ['as' => 'admin.shoppingcenter.create', 'uses' => 'ShoppingCenterController@create']);
    Route::post('shoppingcenter/indexdata', ['as' => 'admin.shoppingcenter.indexdata', 'uses' => 'ShoppingCenterController@indexData']);
    Route::post('shoppingcenter/shoppingcenter', ['as' => 'admin.shoppingcenter.shoppingcenter', 'uses' => 'ShoppingCenterController@shoppingcenter']);
    Route::post('shoppingcenter/check', ['as' => 'admin.shoppingcenter.check', 'uses' => 'ShoppingCenterController@check']);
    Route::post('shoppingcenter/doupdate', ['as' => 'admin.shoppingcenter.doupdate', 'uses' => 'ShoppingCenterController@doupdate']);
    Route::get('shoppingcenter/update', ['as' => 'admin.shoppingcenter.update', 'uses' => 'ShoppingCenterController@update']);
    Route::get('shoppingcenter/detail', ['as' => 'admin.shoppingcenter.detail', 'uses' => 'ShoppingCenterController@detail']);
    Route::post('shoppingcenter/store', ['as' => 'admin.shoppingcenter.store', 'uses' => 'ShoppingCenterController@store']);
    Route::any('shoppingcenter/del', ['as' => 'admin.shoppingcenter.del', 'uses' => 'ShoppingCenterController@del']);
    Route::resource('shoppingcenter', 'ShoppingCenterController');
});

