<?php

$router->group(['namespace' => 'Backend\Home', 'prefix' => 'admin','middleware'=>['admin','web']], function () {
    Route::get('catalog/index', ['as' => 'admin.catalog.index', 'uses' => 'CatalogController@index']);
    Route::post('catalog/indexdata', ['as' => 'admin.catalog.indexdata', 'uses' => 'CatalogController@indexData']);
    Route::get('catalog/create', ['as' => 'admin.catalog.create', 'uses' => 'CatalogController@create']);
    Route::post('catalog/store', ['as' => 'admin.catalog.store', 'uses' => 'CatalogController@store']);
    Route::any('catalog/update', ['as' => 'admin.catalog.update', 'uses' => 'CatalogController@update']);
    Route::any('catalog/update_save', ['as' => 'admin.catalog.update_save', 'uses' => 'CatalogController@update_save']);
    Route::any('catalog/del', ['as' => 'admin.catalog.del', 'uses' => 'CatalogController@del']);

    Route::get('admin/edit', ['as' => 'admin.admin.edit', 'uses' => 'AdminController@edit']);
    Route::post('admin/pass', ['as' => 'admin.admin.pass', 'uses' => 'AdminController@pass']);
    Route::resource('admin', 'AdminController');
});