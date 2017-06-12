<?php

$router->group(['namespace' => 'Backend\Home', 'prefix' => 'admin','middleware'=>['admin','web']], function () {
    Route::get('format/index', ['as' => 'admin.format.index', 'uses' => 'FormatController@index']);
    Route::post('format/indexdata', ['as' => 'admin.format.indexdata', 'uses' => 'FormatController@indexdata']);
    Route::get('format/create', ['as' => 'admin.format.create', 'uses' => 'FormatController@create']);
    Route::post('format/store', ['as' => 'admin.format.store', 'uses' => 'FormatController@store']);
    Route::post('format/indexdata', ['as' => 'admin.format.indexdata', 'uses' => 'FormatController@indexData']);
    Route::get('format/update', ['as' => 'admin.format.update', 'uses' => 'FormatController@update']);
    Route::post('format/update_save', ['as' => 'admin.format.update_save', 'uses' => 'FormatController@update_save']);
    Route::resource('admin', 'AdminController');
});