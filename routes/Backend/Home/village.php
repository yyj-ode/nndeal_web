<?php

$router->group(['namespace' => 'Backend\Home', 'prefix' => 'admin','middleware'=>['admin','web']], function () {
    Route::get('village/index', ['as' => 'admin.village.index', 'uses' => 'VillageController@index']);
    Route::get('village/create', ['as' => 'admin.village.create', 'uses' => 'VillageController@create']);
    Route::post('village/indexdata', ['as' => 'admin.village.indexdata', 'uses' => 'VillageController@indexData']);
    Route::post('village/village', ['as' => 'admin.village.village', 'uses' => 'VillageController@village']);
    Route::post('village/check', ['as' => 'admin.village.check', 'uses' => 'VillageController@check']);
    Route::post('village/doupdate', ['as' => 'admin.village.doupdate', 'uses' => 'VillageController@doupdate']);
    Route::get('village/update', ['as' => 'admin.village.update', 'uses' => 'VillageController@update']);
    Route::get('village/detail', ['as' => 'admin.village.detail', 'uses' => 'VillageController@detail']);
    Route::post('village/store', ['as' => 'admin.village.store', 'uses' => 'VillageController@store']);
    Route::any('village/del', ['as' => 'admin.village.del', 'uses' => 'VillageController@del']);
    Route::resource('village', 'VillageController');
});

