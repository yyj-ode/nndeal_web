<?php

$router->group(['namespace' => 'Backend\Home', 'prefix' => 'admin','middleware'=>['admin','web']], function () {
    Route::get('collection/index', ['as' => 'admin.collection.index', 'uses' => 'CollectionController@index']);
    Route::get('collection/create', ['as' => 'admin.collection.create', 'uses' => 'CollectionController@create']);
    Route::post('collection/indexdata', ['as' => 'admin.collection.indexdata', 'uses' => 'CollectionController@indexData']);
    Route::post('collection/collection', ['as' => 'admin.collection.collection', 'uses' => 'CollectionController@collection']);
    Route::post('collection/check', ['as' => 'admin.collection.check', 'uses' => 'CollectionController@check']);
    Route::get('collection/update', ['as' => 'admin.collection.update', 'uses' => 'CollectionController@update']);
    Route::post('collection/store', ['as' => 'admin.collection.store', 'uses' => 'CollectionController@store']);
    Route::any('collection/del', ['as' => 'admin.collection.del', 'uses' => 'CollectionController@del']);
    Route::resource('collection', 'CollectionController');
});