<?php

$router->group(['namespace' => 'Backend\Home', 'prefix' => 'admin','middleware'=>['admin','web']], function () {
    Route::get('inspect/index', ['as' => 'admin.inspect.index', 'uses' => 'InspectController@index']);
    Route::post('inspect/indexdata', ['as' => 'admin.inspect.indexdata', 'uses' => 'InspectController@indexData']);
    Route::resource('inspect', 'InspectController');
});