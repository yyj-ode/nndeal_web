<?php

$router->group(['namespace' => 'Backend\Home', 'prefix' => 'admin','middleware'=>['admin','web']], function () {
    Route::get('friendshipsort/index', ['as' => 'admin.friendshipsort.index', 'uses' => 'FriendshipSortController@index']);
    Route::get('friendshipsort/create', ['as' => 'admin.friendshipsort.create', 'uses' => 'FriendshipSortController@create']);
    Route::post('friendshipsort/indexdata', ['as' => 'admin.friendshipsort.indexdata', 'uses' => 'FriendshipSortController@indexData']);
    Route::post('friendshipsort/category', ['as' => 'admin.friendshipsort.category', 'uses' => 'FriendshipSortController@category']);
    Route::post('friendshipsort/check', ['as' => 'admin.friendshipsort.check', 'uses' => 'FriendshipSortController@check']);
    Route::post('friendshipsort/update', ['as' => 'admin.friendshipsort.update', 'uses' => 'FriendshipSortController@update']);
    Route::post('friendshipsort/store', ['as' => 'admin.friendshipsort.store', 'uses' => 'FriendshipSortController@store']);
    Route::resource('friendshipsort', 'FriendshipSortController');
});