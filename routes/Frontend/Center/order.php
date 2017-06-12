<?php
$router->group(['namespace' => 'Frontend\Center'], function () {
    /**
     * User Login
     */
    Route::get('center/order','OrdersController@order');
});
