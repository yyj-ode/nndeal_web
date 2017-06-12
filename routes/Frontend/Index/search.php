<?php

$router->group(['namespace' => 'Frontend\Index', 'prefix' => 'search'], function () {
    Route::get('index', ['as' => 'search.index', 'uses' => 'SearchController@index']);
});
