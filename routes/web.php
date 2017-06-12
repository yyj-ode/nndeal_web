<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Backend\AdminAuth\LoginController@showLoginForm');

/**
 * Backend
 */
require __DIR__ . '/Backend/AdminAuth/auth.php';
require __DIR__ . '/Backend/AdminAuth/admin.php';

require __DIR__ . '/Backend/Home/uploads.php';
require __DIR__ . '/Backend/Home/permission.php';
require __DIR__ . '/Backend/Home/role.php';
require __DIR__ . '/Backend/Home/home.php';
require __DIR__ . '/Backend/Home/company.php';
require __DIR__ . '/Backend/Home/category.php';
require __DIR__ . '/Backend/Home/area.php';
require __DIR__ . '/Backend/Home/friendshipsort.php';
require __DIR__ . '/Backend/Home/friendship.php';
require __DIR__ . '/Backend/Home/bannersort.php';
require __DIR__ . '/Backend/Home/banner.php';
require __DIR__ . '/Backend/Home/user.php';
require __DIR__ . '/Backend/Home/inspect.php';
require __DIR__ . '/Backend/Home/admin.php';
require __DIR__ . '/Backend/Home/roles.php';
require __DIR__ . '/Backend/Home/permissions.php';
require __DIR__ . '/Backend/Home/catalog.php';
require __DIR__ . '/Backend/Home/account.php';
require __DIR__ . '/Backend/Home/order.php';
require __DIR__ . '/Backend/Home/wechatMenu.php';
require __DIR__ . '/Backend/Home/collection.php';
require __DIR__ . '/Backend/Home/authentication.php';//用户认证
require __DIR__ . '/Backend/Home/totalarea.php';// 面积
require __DIR__ . '/Backend/Home/goods.php';// 商品（服务）
require __DIR__ . '/Backend/Home/shop.php';// 商铺

require __DIR__ . '/Backend/Home/format.php';// 经营业态
require __DIR__ . '/Backend/Home/shoponline.php';// 街铺线下
require __DIR__ . '/Backend/Home/shopline.php';// 街铺线下
require __DIR__ . '/Backend/Home/shopinformation.php';// 商铺
require __DIR__ . '/Backend/Home/shopsurrounding.php';// 商铺
require __DIR__ . '/Backend/Home/village.php';// 小区
require __DIR__ . '/Backend/Home/officebuilding.php';// 办公楼
require __DIR__ . '/Backend/Home/shoppingcenter.php';// 购物中心
require __DIR__ . '/Backend/Home/price.php';// 价格管理

/**
 * Frontend
 */
require __DIR__ . '/Frontend/UserAuth/user.php';
require __DIR__ . '/Frontend/Index/index.php';
require __DIR__ . '/Frontend/Index/search.php';
require __DIR__ . '/Frontend/Shop/shop.php';
require __DIR__ . '/Frontend/Wechat/wechat.php';
require __DIR__ . '/Frontend/Wechat/account.php';
require __DIR__ . '/Frontend/Center/order.php';
require __DIR__ . '/Frontend/Center/authentication.php';


require __DIR__ . '/Frontend/Home/home.php';
