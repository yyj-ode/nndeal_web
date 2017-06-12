<?php

namespace App\Http\Controllers\Frontend\Index;

use App\Models\Area;
use App\Models\Banner;
use App\Models\BannerSort;
use App\Models\Category;
use App\Models\DiseaseCategory;
use App\Models\Sms;
use App\Models\Inspect;
use App\Store\AreaStore;
use Illuminate\Http\Request;
use App\Http\Controllers\FrontendController;
use Response;
use Carbon\Carbon;
use Cookie;
use Uuid;
use DateTime;
use Validator;
use App\Library\CreateQueueAndSendMessage;

class IndexController extends FrontendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category = Category::getAll('CN', '0');
        if ($this->is_mobile()) {
            return view('Frontend.Index.CN.Wap.Index.index', compact('category'));
        } else {
            return view('Frontend.Index.CN.Web.Index.index', compact('category'));
        }
    }

    public function en(Request $request)
    {
        $category = Category::getAll('EN', 0);
        if ($this->is_mobile()) {
            return view('Frontend.Index.EN.Wap.Index.index', compact('category'));
        } else {
            return view('Frontend.Index.EN.Web.Index.index', compact('category'));
        }
    }

    public function captcha(Request $request)
    {
        $mobile = $request->get('mobile');
        if ($this->isMobile($mobile)) {
            $code = makeCaptchaCode();
            $json_data = json_encode(['name' => $code]);
            $template = 'SMS_62295039';
            $sms = new Sms();
            $checkData = $sms::checkMinute($mobile);
            if ($checkData == false) {
                $data = sendSms($mobile, $template, $json_data);
                $result = json_decode($data, true);
                if ($result['status'] == 200) {
                    $sms = new Sms();
                    $sms->mobile = $mobile;
                    $sms->code = $code;
                    $sms->status = 1;
                    $sms->save();
                    $result = ['status' => 1, 'message' => "验证码发送成功！", $data];
                } else {
                    $result = ['status' => 0, 'message' => "验证码发送失败！", $data];
                }
            } else {
                $result = ['status' => 1, 'message' => "刚发的验证码还未失效，还能使用！"];
            }
        } else {
            $result = ['status' => 0, 'message' => '手机号码有误，请重新输入！'];
        }
        return response()->json($result);
    }

    public function wechat(Request $request)
    {
        $category = Category::getAll('CN', '1');
        return view('Frontend.Index.CN.Web.Index.wechat', compact('category'));
    }

    public function dowechat(Request $request)
    {
        $input = $request->all();
        $inspect = new Inspect();
        $type = $request->get('type');
        $rules = [
            'category' => 'required',
            'brand' => 'required',
            'unit_price' => 'required',
            'mobile' => 'required',
            'verification' => 'required',
        ];
        $message = [
            'verification.required' => '验证码不能为空！',
            'mobile.required' => '手机号必须填写！',
            'unit_price.required' => '单价必须填写！',
            'brand.required' => '品牌名称必须填写！',
            'category.required' => '经营类别必须填写！',
        ];
        $validator = Validator::make($input, $rules, $message);
        if ($validator->fails()) {
            $message = $validator->getMessageBag()->first();
            $result = ['status' => 0, 'message' => $message];
            return response()->json($result);
        }
        $verification = $request->get('verification');
        $sms = new Sms();
        $checkSms = $sms::check($request->get('mobile'), $verification);
        if ($checkSms == false) {
            $result = ['status' => 0, 'message' => '验证码错误！请重新获取。'];
            return response()->json($result);
        }
        $inspect->mobile = $request->get('mobile');
        $inspect->unit_price = $request->get('unit_price');
        $inspect->brand = $request->get('brand');
        $inspect->category_id = $request->get('category');
        $inspect->name = $request->get('name');
        $inspect->service = $request->get('service');
        $inspect->type = $type;
        if ($inspect->save()) {
            $result = ['status' => 1, 'message' => '恭喜您已成功提交，我们会在收到资料后尽快与您取得联系，请耐心等待。'];
        } else {
            $result = ['status' => 0, 'message' => '保存失败！请重新提交。'];
        }
        return response()->json($result);
    }

    public function isMobile($mobile)
    {
        if (!is_numeric($mobile)) {
            return false;
        }
        return preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $mobile) ? true : false;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $input = $request::all();
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ];
        $message = [
            'name.required' => '用户名必须填写！',
            'email.required' => '邮箱必须填写！',
            'email.unique' => '邮箱已经被注册！',
            'password.confirmed' => '两次密码不一致！',
            'password.min' => '密码至少6位数！',
        ];
        $validator = Validator::make($input, $rules, $message);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $input['password'] = bcrypt(md5($input['password']));  //6.bcrypt是自带的加密方式,不能修改。
            if ($this->user->add($input)) {
                return redirect('login')->with('message', '注册成功');
            } else {
                return back()->with('message', '注册失败')->withInput();
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $inspect = new Inspect();
        $type = $request->get('type');
        if (intval($type) === 1) {
            $rules = [
                'verification' => 'required',
                'mobile' => 'required',
                'unit_price' => 'required',
                'brand' => 'required',
                'category' => 'required',
                'name' => 'required',
            ];
            $message = [
                'verification.required' => '验证码不能为空！',
                'mobile.required' => '手机号必须填写！',
                'unit_price.required' => '单价必须填写！',
                'brand.required' => '品牌名称必须填写！',
                'category.required' => '经营类别必须填写！',
                'name.required' => '姓名必须填写！',
            ];
            $validator = Validator::make($input, $rules, $message);
            if ($validator->fails()) {
                $message = $validator->getMessageBag()->first();
                $result = ['status' => 0, 'message' => $message];
                return response()->json($result);
            }
            $verification = $request->get('verification');
            $sms = new Sms();
            $checkSms = $sms::check($request->get('mobile'), $verification);
            if ($checkSms == false) {
                $result = ['status' => 0, 'message' => '验证码错误！请重新获取。'];
                return response()->json($result);
            }
            $inspect->mobile = $request->get('mobile');
            $inspect->unit_price = $request->get('unit_price');
            $inspect->brand = $request->get('brand');
            $inspect->category_id = $request->get('category');
            $inspect->name = $request->get('name');
            $inspect->type = $type;
            $inspect->save();
        } else {
            $rules = [
                'category' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required',
                'unit_price' => 'required',
                'brand' => 'required',
            ];
            $message = [
                'first_name.required' => 'First Name Required！',
                'last_name.required' => 'Last Name Required！',
                'email.required' => 'Your Email Required！',
                'category.required' => 'Business Category Required！',
                'brand.required' => 'Brand Name Required！',
                'unit_price.min' => 'Per Customer Transaction Required！',
            ];
            $validator = Validator::make($input, $rules, $message);
            if ($validator->fails()) {
                $message = $validator->getMessageBag()->first();
                $result = ['status' => 0, 'message' => $message];
                return response()->json($result);
            }
            $inspect->first_name = $request->get('first_name');
            $inspect->email = $request->get('email');
            $inspect->brand = $request->get('brand');
            $inspect->category_id = $request->get('category');
            $inspect->name = $request->get('name');
            $inspect->type = $type;
            $inspect->save();
        }
        if ($type == 1) {
            $result = ['status' => 1, 'message' => '恭喜您已成功提交，我们会在收到资料后尽快与您取得联系，请耐心等待。'];
        } else {
            $result = ['status' => 1, 'message' => 'Congratulation！You are successfully submitted！We will contact you as soon as we received the information. '];
        }
        return response()->json($result);
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function checkLogin()
    {
        $data = ['status' => false];
        if ($this->guard()->check()) {
            $data = [
                'status' => true,
                'token' => csrf_token(),
                'user_id' => $this->guard()->user()->id,
                'user_name' => $this->guard()->user()->name
            ];
        }
        return Response::json($data);
    }

}