<?php

$router->group(['namespace' => 'Backend\Home', 'prefix' => 'admin','middleware'=>['admin','web']], function () {
    Route::get('friendship/index', ['as' => 'admin.friendship.index', 'uses' => 'FriendshipController@index']);
    Route::post('friendship/indexdata', ['as' => 'admin.friendship.indexdata', 'uses' => 'FriendshipController@indexData']);
    Route::post('friendship/category', ['as' => 'admin.friendship.category', 'uses' => 'FriendshipController@category']);
    Route::post('friendship/check', ['as' => 'admin.friendship.check', 'uses' => 'FriendshipController@check']);
    Route::post('friendship/update', ['as' => 'admin.friendship.update', 'uses' => 'FriendshipController@update']);

    Route::get('friendship/description/{id}', ['as' => 'admin.friendship.description', 'uses' => 'FriendshipController@description']);
    Route::post('friendship/doDescription', ['as' => 'admin.friendship.doDescription', 'uses' => 'FriendshipController@doDescription']);

    Route::get('friendship/contact/{id}', ['as' => 'admin.friendship.contact', 'uses' => 'FriendshipController@contact']);
    Route::post('friendship/doContact', ['as' => 'admin.friendship.doContact', 'uses' => 'FriendshipController@doContact']);


    Route::resource('friendship', 'FriendshipController');
});