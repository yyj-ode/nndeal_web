<?php

$router->group(['namespace' => 'Backend\Home', 'prefix' => 'admin','middleware'=>['admin','web']], function () {
    Route::get('bannersort/index', ['as' => 'admin.bannersort.index', 'uses' => 'BannerSortController@index']);
    Route::get('bannersort/create', ['as' => 'admin.bannersort.create', 'uses' => 'BannerSortController@create']);
    Route::post('bannersort/indexdata', ['as' => 'admin.bannersort.indexdata', 'uses' => 'BannerSortController@indexData']);
    Route::post('bannersort/category', ['as' => 'admin.bannersort.category', 'uses' => 'BannerSortController@category']);
    Route::post('bannersort/check', ['as' => 'admin.bannersort.check', 'uses' => 'BannerSortController@check']);
    Route::post('bannersort/update', ['as' => 'admin.bannersort.update', 'uses' => 'BannerSortController@update']);
    Route::post('bannersort/store', ['as' => 'admin.bannersort.store', 'uses' => 'BannerSortController@store']);
    Route::resource('bannersort', 'BannerSortController');
});