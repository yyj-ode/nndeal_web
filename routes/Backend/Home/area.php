<?php

$router->group(['namespace' => 'Backend\Home', 'prefix' => 'admin','middleware'=>['admin','web']], function () {
    Route::any('area/index', ['as' => 'admin.area.index', 'uses' => 'AreaController@index']);
    Route::get('area/create', ['as' => 'admin.area.create', 'uses' => 'AreaController@create']);
    Route::post('area/indexData', ['as' => 'admin.area.indexData', 'uses' => 'AreaController@indexData']);
    Route::get('area/del', ['as' => 'admin.area.del', 'uses' => 'AreaController@del']);
    Route::post('area/category', ['as' => 'admin.area.category', 'uses' => 'AreaController@category']);
    Route::post('area/check', ['as' => 'admin.area.check', 'uses' => 'AreaController@check']);
    Route::any('area/update', ['as' => 'admin.area.update', 'uses' => 'AreaController@update']);
    Route::post('area/save', ['as' => 'admin.area.save', 'uses' => 'AreaController@save']);
    Route::post('area/store', ['as' => 'admin.area.store', 'uses' => 'AreaController@store']);

    Route::any('area/city_index', ['as' => 'admin.area.city_index', 'uses' => 'AreaController@city_index']);
    Route::get('area/county_index', ['as' => 'admin.area.county_index', 'uses' => 'AreaController@county_index']);
    Route::resource('area', 'AreaController');
});