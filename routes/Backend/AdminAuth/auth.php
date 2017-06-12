<?php
/**
 * 权限验证
 */
$this->group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware'=>['captcha']], function () {
    Route::auth();
});