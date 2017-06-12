<?php

$router->group(['namespace' => 'Backend\Home', 'prefix' => 'admin','middleware'=>['admin','web']], function () {
    Route::get('order/index', ['as' => 'admin.order.index', 'uses' => 'OrderController@index']);
    Route::post('order/indexdata', ['as' => 'admin.order.indexdata', 'uses' => 'OrderController@indexData']);
    Route::get('order/create', ['as' => 'admin.order.create', 'uses' => 'OrderController@create']);
    Route::post('order/store', ['as' => 'admin.order.store', 'uses' => 'OrderController@store']);
    Route::any('order/update', ['as' => 'admin.order.update', 'uses' => 'OrderController@update']);
    Route::any('order/update_save', ['as' => 'admin.order.update_save', 'uses' => 'OrderController@update_save']);
    Route::any('order/del', ['as' => 'admin.order.del', 'uses' => 'OrderController@del']);

    Route::get('admin/edit', ['as' => 'admin.admin.edit', 'uses' => 'AdminController@edit']);
    Route::post('admin/pass', ['as' => 'admin.admin.pass', 'uses' => 'AdminController@pass']);
    Route::resource('admin', 'AdminController');
});