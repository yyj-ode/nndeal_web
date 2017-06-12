<?php

$router->group(['namespace' => 'Backend\Home', 'prefix' => 'admin','middleware'=>['admin','web']], function () {
    Route::get('home/index', ['as' => 'admin.home.index', 'uses' => 'HomeController@index']);
    Route::resource('home', 'HomeController');
});