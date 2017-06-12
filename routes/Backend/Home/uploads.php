<?php
/**
 * Created by PhpStorm.
 * User: yangcuiwang
 * Date: 2016/12/8
 * Time: 下午10:32
 */

Route::group(['namespace' => 'Backend\Home', 'middleware' => ['web', 'admin'], 'prefix' => 'admin'], function () {
    Route::post('uploads/screenshot', ['as' => 'admin.uploads.screenshot', 'uses' => 'UploadsController@screenshot']);
    Route::post('uploads/image', ['as' => 'admin.uploads.image', 'uses' => 'UploadsController@image']);
    Route::post('uploads/articleimg', ['as' => 'admin.uploads.articleimg', 'uses' => 'UploadsController@articleimg']);
});