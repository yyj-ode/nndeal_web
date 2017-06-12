<?php

namespace App\Http\Controllers\Backend\AdminAuth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\BackendController;

use Illuminate\Support\Facades\Input;
use Captcha;
use Carbon\Carbon;

class CaptchaController extends BackendController
{
    public function index(){
        return Captcha::src(Input::get('config'));
    }
}
