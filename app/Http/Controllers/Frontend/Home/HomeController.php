<?php
/**
 * Created by PhpStorm.
 * User: yangcuiwang
 * Date: 2017/5/9
 * Time: 上午10:05
 */

namespace App\Http\Controllers\Frontend\Home;

use App\Http\Controllers\FrontendController;
use Request;

class HomeController extends FrontendController
{
    public function index(Request $request)
    {
        if ($this->is_mobile() == true) {
            return view('Frontend.Home.CN.Wap.Home.index');
        } else {
            return view('Frontend.Home.CN.Web.Home.index');
        }
    }
}