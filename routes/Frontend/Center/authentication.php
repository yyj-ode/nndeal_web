<?php
$router->group(['namespace' => 'Frontend\Center'], function () {
    /**
     * User Login
     */
    Route::get('center/authentication','AuthenticationController@index');
    Route::any('center/authentication_sort','AuthenticationController@authentication_sort');
    Route::get('center/add','AuthenticationController@add');
    Route::post('center/add_action','AuthenticationController@add_action');
});
