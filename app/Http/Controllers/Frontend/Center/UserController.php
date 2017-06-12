<?php

namespace App\Http\Controllers\Frontend\Center;

use App\Jobs\AddUser;
use App\Models\User;
use App\Models\Mobilecode;
use App\Models\UserDetails;
use Illuminate\Http\Request;
use App\Http\Controllers\FrontendController;
use Response;
use Validator;
use DateTime;
use Auth;
use Hash;
use Carbon\Carbon;
use App\Jobs\AddUsers;

class UserController extends FrontendController
{

    public function index()
    {
        $user_id = $this->guard()->user()->id;

        $result = UserStore::with('images')->where('id', $user_id)->first();

        return view('Frontend.Center.Web.User.index', compact('result'));
    }

    /**
     * 个人信息
     */
    public function persons(Request $request)
    {
        return view('Frontend.Center.Web.User.persons');
    }

    public function postPersons(Request $request)
    {

    }

    /**
     * 修改密码
     */
    public function reset(Request $request)
    {
        return view('Frontend.Center.Web.User.reset');
    }

    public function postReset(Request $request)
    {
        $message = ['status' => false, 'message' => ""];

        $oldpassword = $request->input('oldpassword');
        $password = $request->input('password');
        $data = $request->all();
        $rules = [
            'oldpassword'           => 'required|between:4,20',
            'password'              => 'required|between:4,20|confirmed',
            'password_confirmation' => 'required|between:4,20',
        ];
        $messages = [
            'oldpassword.required' => '原密码不能为空',
            'oldpassword.between'  => '密码必须是4~20位之间',

            'password.required' => '密码不能为空',
            'password.between'  => '密码必须是4~20位之间',

            'repassword.required' => '密码不能为空',
            'repassword.between'  => '密码必须是4~20位之间',
            'password.confirmed'  => '新密码和确认密码不匹配'
        ];
        $validator = Validator::make($data, $rules, $messages);
        $user = Auth::user();

        $validator->after(function ($validator) use ($oldpassword, $user) {
            if (!Hash::check($oldpassword, $user->password)) {
                $validator->errors()->add('oldpassword', '原密码错误');
            }
        });

        if ($validator->fails()) {
            $message['message'] = $validator->errors()->first();
            return Response::json($message);
        }
        $user->password = bcrypt($password);
        $user->save();
//        Auth::logout(); //更改完这次密码后，退出这个用户
        $message = ['status' => true, 'message' => "修改成功!"];
        return Response::json($message);
//        return redirect('admin/home/index');
    }

    /**
     * 绑定手机
     */
    public function mobile(Request $request)
    {
        return view('Frontend.Center.Web.User.mobile');
    }

    public function postMobile(Request $request)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $area = AreaStore::getByParentId();
        $user_id = $this->guard()->user()->id;
        $result = UserStore::with('images')->where('id', $user_id)->first();
        return view('Frontend.Center.Web.User.edit', compact('result', 'area'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $message = ['status' => false, 'message' => ""];
        $user_id = $this->guard()->user()->id;
        if (!empty($user_id)) {
            $user = User::where('id', $user_id)->first();
            if ($user) {
                $user->email = $request->get('email');

                if ($user->save()) {
                    $details = UserDetails::where('id', $user_id)->first();
                    $message = ['status' => true, 'message' => "保存成功!"];
                    if ($details) {
                        $details->really_name = $request->get('really_name');
                        $details->sex = intval($request->get('sex'));
                        $details->post_code = intval($request->get('post_code'));
                        $details->province = intval($request->get('province'));
                        $details->nickname = $request->get('nickname');
                        $details->city = intval($request->get('city'));
                        $details->county = intval($request->get('county'));
                        $details->address = strval($request->get('address'));
                        if ($details->save()) {
                            $message = ['status' => true, 'message' => "保存成功!"];
                        }
                    } else {
                        $details = new UserDetails();
                        $details->really_name = $request->get('really_name');
                        $details->sex = intval($request->get('sex'));
                        $details->nickname = $request->get('nickname');
                        $details->post_code = intval($request->get('post_code'));
                        $details->province = intval($request->get('province'));
                        $details->city = intval($request->get('city'));
                        $details->county = intval($request->get('county'));
                        $details->address = strval($request->get('address'));
                        if ($details->save()) {
                            $message = ['status' => true, 'message' => "保存成功!"];
                        }
                    }

                    dispatch(new AddUser($user->id));
                }
            }
        }
        return response()->json($message);
    }

    public function photo()
    {
        $user_id = $this->guard()->user()->id;
        $result = UserStore::with('images')->where('id', $user_id)->first();
        $image = ImagesStore::where('status', 8)->get();

        return view('Frontend.Center.Web.User.photo', compact('result', 'image'));
    }

    public function postPhoto(Request $request)
    {
        $message = ['status' => false, 'message' => "保存失败!"];
        $user_id = $this->guard()->user()->id;
        if (!empty($user_id)) {
            $details = UserDetails::where('id', $user_id)->first();
            $message = ['status' => true, 'message' => "保存成功!"];
            if ($details) {
                $details->images_id = intval($request->get('image_id'));
                if ($details->save()) {
                    $message = ['status' => true, 'message' => "保存成功!"];
                }
            } else {
                $details = new UserDetails();
                $details->images_id = intval($request->get('image_id'));
                if ($details->save()) {
                    $message = ['status' => true, 'message' => "保存成功!"];
                }
            }

            dispatch(new AddUser($user_id));
        }
        return response()->json($message);
    }


    public function password()
    {
        $user_id = $this->guard()->user()->id;
        $result = UserStore::where('id', $user_id)->first();
        return view('Frontend.Center.Web.User.password', compact('result'));
    }

    public function postPassword(Request $request)
    {
        $code = $request->get('code');
        $user_id = $this->guard()->user()->id;
        $user = UserStore::where('id', $user_id)->first();
        $oneHoursAgo = new DateTime('-1 hours');
        $sms = SmsStore::where('created_at', '>', $oneHoursAgo)
            ->where('mobile', strval($user->mobile))
            ->where('type', intval(SmsStore::PASSWORD_TYPE))
            ->orderBy('created_at', 'desc')
            ->first();

        if ($sms->code == $code) {
            $data = ['status' => true, 'message' => "验证成功", 'url' => url('center/user/passwordChange')];
            $request->session()->put('passwordCheck', true);
        } else {
            $data = ['status' => false, 'message' => '验证码或者手机校验码错误'];
        }

//
        return response()->json($data);
    }

    public function mobileCode(Request $request)
    {
        if ($request->get('captcha') && $request->has('captcha')) {
            $rules = ['captcha' => 'required|captcha'];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $data = ['status' => false, 'message' => '验证码错误！'];
            } else {
                $user_id = $this->guard()->user()->id;
                $user = UserStore::where('id', $user_id)->first();
                $oneHoursAgo = new DateTime('-1 hours');
                $sms = SmsStore::where('created_at', '>', $oneHoursAgo)
                    ->where('mobile', strval($user->mobile))
                    ->where('type', intval(SmsStore::PASSWORD_TYPE))
                    ->orderBy('created_at', 'desc')
                    ->first();

                if ($sms) {
                    $data = ['status' => true, 'message' => '一个小时前的验证码还未失效！放心使用！'];
                } else {
                    $code = makeCaptchaCode();
                    SmsStore::add($user->mobile, $code, SmsStore::PASSWORD_TYPE);
                    $json_data = json_encode(['code' => makeCaptchaCode(), 'product' => '列琼网']);
                    //SMS_33325049 验证码${code}，您正在尝试修改${product}登录密码，请妥善保管账户信息。
//                    $result = sendSms($user->mobile, 'SMS_33325049', $json_data);
//                    $resultData = json_decode($result, true);
//                    if ($resultData['status'] == 200) {
                    $data = ['status' => true, 'message' => '验证码已发送到手机！'];
//                    } else {
//                        $data = ['status' => false, 'message' => '验证码发失败！请联系网站客服！'];
//                    }
//                    $smsModel = SmsStore::where('mobile', strval($user->mobile))->where('type', SmsStore::PASSWORD_TYPE)->orderBy('created_at', 'desc')->first();
//                    $smsModel->content = $resultData['data'];
//                    $smsModel->save();
                }
            }
        } else {
            $data = ['status' => false, 'message' => '验证码不能为空！'];
        }
        return response()->json($data);
    }

    public function passwordChange(Request $request)
    {
        if ($request->session()->has('passwordCheck') && $request->session()->get('passwordCheck') != true) {
            return redirect(url('center/user/password'));
        }
        return view('Frontend.Center.Web.User.passwordChange');
    }

    public function postPasswordChange(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:5|confirmed|alpha_dash',
            'captcha'  => 'required|captcha|integer',
        ], [
            'password.required'   => '密码不能为空',
            'password.alpha_dash' => '密码由字母、数字、中划线或下划线字符构成!',
            'password.min'        => '密码最短不能小于5个字符',
            'password.confirmed'  => '密码和确认密码不一致',
            'captcha.required'    => '验证码不能为空',
            'captcha.captcha'     => '验证码不正确',
        ]);

        if ($validator->fails()) {
            $data = ['status' => false, 'message' => $validator->errors()->first()];
        } else {
            $user_id = $this->guard()->user()->id;
            $user = User::where('id', $user_id)->first();
            $user->password = bcrypt($request->get('password'));
            if ($user->save()) {
                dispatch(new addUser($user_id));
                $request->session()->forget('passwordCheck');
                $data = ['status' => true, 'message' => '密码修改成功', 'url' => url('center/user/passwordSuccessChange')];
            } else {
                $data = ['status' => true, 'message' => '密码修改失败'];
            }
        }

        return response()->json($data);
    }

    public function passwordSuccessChange()
    {
        return view('Frontend.Center.Web.User.passwordSuccessChange');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
