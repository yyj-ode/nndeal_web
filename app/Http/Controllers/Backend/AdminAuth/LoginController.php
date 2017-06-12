<?php
namespace App\Http\Controllers\Backend\AdminAuth;

use App\Http\Controllers\BackendController;
use App\Models\Admin;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use Session;
use Auth;

class LoginController extends BackendController
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    public $redirectTo = '/admin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin.guest', ['except' => 'logout']);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('Backend.admin.auth.login');
    }

    public function login(Request $request){

        if($request->get('captcha') && $request->has('captcha')){
            $rules = ['captcha' => 'required|captcha'];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect('admin/login')->withErrors('验证码错误！');
            }
        }else{
            return redirect('admin/login')->withErrors('验证码不能为空！');
        }

        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }
        if ($this->attemptLogin($request)) {
            $admin = Admin::getByEmail($request->email);
            $result = ['id'=>$admin->id,'name'=>$admin->name,'email'=>$admin->email];
            Session::put('ADMIN_DATA', $result);
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function logout(Request $request)
    {
        if ($this->guard()->check()) {
            $this->guard()->logout();
            $request->session()->flush();
            $request->session()->regenerate();
        }
        return Redirect::to('admin/login');
    }

}
