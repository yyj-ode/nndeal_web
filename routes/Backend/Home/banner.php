<?php

$router->group(['namespace' => 'Backend\Home', 'prefix' => 'admin','middleware'=>['admin','web']], function () {
    Route::get('banner/index', ['as' => 'admin.banner.index', 'uses' => 'BannerController@index']);
    Route::post('banner/indexdata', ['as' => 'admin.banner.indexdata', 'uses' => 'BannerController@indexData']);
    Route::post('banner/category', ['as' => 'admin.banner.category', 'uses' => 'BannerController@category']);
    Route::post('banner/check', ['as' => 'admin.banner.check', 'uses' => 'BannerController@check']);
    Route::post('banner/update', ['as' => 'admin.banner.update', 'uses' => 'BannerController@update']);

    Route::get('banner/description/{id}', ['as' => 'admin.banner.description', 'uses' => 'BannerController@description']);
    Route::post('banner/doDescription', ['as' => 'admin.banner.doDescription', 'uses' => 'BannerController@doDescription']);

    Route::get('banner/contact/{id}', ['as' => 'admin.banner.contact', 'uses' => 'BannerController@contact']);
    Route::post('banner/doContact', ['as' => 'admin.banner.doContact', 'uses' => 'BannerController@doContact']);


    Route::resource('banner', 'BannerController');
});