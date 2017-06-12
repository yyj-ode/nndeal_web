<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('user');
    }
}
