<?php

$router->group(['namespace' => 'Backend\Home', 'prefix' => 'admin','middleware'=>['admin','web']], function () {
    Route::get('company/index', ['as' => 'admin.company.index', 'uses' => 'CompanyController@index']);
    Route::post('company/indexdata', ['as' => 'admin.company.indexdata', 'uses' => 'CompanyController@indexData']);
    Route::post('company/category', ['as' => 'admin.company.category', 'uses' => 'CompanyController@category']);
    Route::post('company/check', ['as' => 'admin.company.check', 'uses' => 'CompanyController@check']);
    Route::post('company/update', ['as' => 'admin.company.update', 'uses' => 'CompanyController@update']);

    Route::get('company/description/{id}', ['as' => 'admin.company.description', 'uses' => 'CompanyController@description']);
    Route::post('company/doDescription', ['as' => 'admin.company.doDescription', 'uses' => 'CompanyController@doDescription']);

    Route::get('company/contact/{id}', ['as' => 'admin.company.contact', 'uses' => 'CompanyController@contact']);
    Route::post('company/doContact', ['as' => 'admin.company.doContact', 'uses' => 'CompanyController@doContact']);


    Route::resource('company', 'CompanyController');
});