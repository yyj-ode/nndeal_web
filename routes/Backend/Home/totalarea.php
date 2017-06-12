<?php

$router->group(['namespace' => 'Backend\Home', 'prefix' => 'admin','middleware'=>['admin','web']], function () {
    Route::get('totalarea/index', ['as' => 'admin.totalarea.index', 'uses' => 'TotalareaController@index']);
    Route::get('totalarea/create', ['as' => 'admin.totalarea.create', 'uses' => 'TotalareaController@create']);
    Route::post('totalarea/indexdata', ['as' => 'admin.totalarea.indexdata', 'uses' => 'TotalareaController@indexData']);
    Route::post('totalarea/totalarea', ['as' => 'admin.totalarea.totalarea', 'uses' => 'TotalareaController@totalarea']);
    Route::post('totalarea/check', ['as' => 'admin.totalarea.check', 'uses' => 'TotalareaController@check']);
    Route::get('totalarea/update', ['as' => 'admin.totalarea.update', 'uses' => 'TotalareaController@update']);
    Route::post('totalarea/store', ['as' => 'admin.totalarea.store', 'uses' => 'TotalareaController@store']);
    Route::any('totalarea/del', ['as' => 'admin.totalarea.del', 'uses' => 'TotalareaController@del']);
    Route::resource('totalarea', 'TotalareaController');
});