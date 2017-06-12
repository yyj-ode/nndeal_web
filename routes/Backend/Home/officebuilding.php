<?php

$router->group(['namespace' => 'Backend\Home', 'prefix' => 'admin','middleware'=>['admin','web']], function () {
    Route::get('officebuilding/index', ['as' => 'admin.officebuilding.index', 'uses' => 'OfficeBuildingController@index']);
    Route::get('officebuilding/create', ['as' => 'admin.officebuilding.create', 'uses' => 'OfficeBuildingController@create']);
    Route::post('officebuilding/indexdata', ['as' => 'admin.officebuilding.indexdata', 'uses' => 'OfficeBuildingController@indexData']);
    Route::post('officebuilding/officebuilding', ['as' => 'admin.officebuilding.officebuilding', 'uses' => 'OfficeBuildingController@officebuilding']);
    Route::post('officebuilding/check', ['as' => 'admin.officebuilding.check', 'uses' => 'OfficeBuildingController@check']);
    Route::post('officebuilding/doupdate', ['as' => 'admin.officebuilding.doupdate', 'uses' => 'OfficeBuildingController@doupdate']);
    Route::get('officebuilding/update', ['as' => 'admin.officebuilding.update', 'uses' => 'OfficeBuildingController@update']);
    Route::get('officebuilding/detail', ['as' => 'admin.officebuilding.detail', 'uses' => 'OfficeBuildingController@detail']);
    Route::post('officebuilding/store', ['as' => 'admin.officebuilding.store', 'uses' => 'OfficeBuildingController@store']);
    Route::any('officebuilding/del', ['as' => 'admin.officebuilding.del', 'uses' => 'OfficeBuildingController@del']);
    Route::resource('officebuilding', 'OfficeBuildingController');
});

