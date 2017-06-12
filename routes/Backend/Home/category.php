<?php

$router->group(['namespace' => 'Backend\Home', 'prefix' => 'admin','middleware'=>['admin','web']], function () {
    Route::get('category/index', ['as' => 'admin.category.index', 'uses' => 'CategoryController@index']);
    Route::get('category/create', ['as' => 'admin.category.create', 'uses' => 'CategoryController@create']);
    Route::post('category/indexdata', ['as' => 'admin.category.indexdata', 'uses' => 'CategoryController@indexData']);
    Route::post('category/category', ['as' => 'admin.category.category', 'uses' => 'CategoryController@category']);
    Route::post('category/check', ['as' => 'admin.category.check', 'uses' => 'CategoryController@check']);
    Route::post('category/update', ['as' => 'admin.category.update', 'uses' => 'CategoryController@update']);
    Route::post('category/store', ['as' => 'admin.category.store', 'uses' => 'CategoryController@store']);
    Route::resource('category', 'CategoryController');
});