<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>NNDeal 后台登录</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <!-- load css -->
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/layui/css/layui.css')}}" media="all">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/login.css')}}" media="all">
</head>
<body>
<div class="layui-canvs"></div>
<div class="layui-layout layui-layout-login">
    @include('Backend.admin.partials.errors')
    {{ Form::open(array('url' => 'admin/login', 'method' => 'POST')) }}
    {!! csrf_field() !!}
    <h1>
        <strong>管理系统后台</strong>
        <em>Management System</em>
    </h1>
    <div class="layui-user-icon larry-login">
        {{ Form::email('email', old('email'), ['class'=>'login_txtbx', 'placeholder'=>'账号']) }}
    </div>
    <div class="layui-pwd-icon larry-login">
        {{ Form::password('password', ['class'=>'login_txtbx', 'placeholder'=>'密码']) }}
    </div>
    <div class="layui-val-icon larry-login">
        <div class="layui-code-box">
            {{ Form::text('captcha', '', array('class' => 'login_txtbx', 'placeholder'=>'验证码')) }}
            <img src="{{ url('captcha/default') }}"  class="verifyImg" onclick="javascript:this.src=this.src+Math.random();">
        </div>
    </div>
    <div class="layui-submit larry-login">
        {{ Form::submit('立即登陆', ['class'=>'submit_btn']) }}
    </div>
    <div class="layui-login-text">
        <p>© 2016-2017 NNDeal 版权所有</p>
        <p>京ICP备14047684号-8 <a href="http://www.nndeal.com" title="">NNDeal</a></p>
    </div>
    {{ Form::close() }}
</div>
<script type="text/javascript" src="{{asset('plugins/jQuery/jQuery-2.2.0.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/layui/layui.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/jsplug/jparticle.jquery.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/login.js')}}"></script>
<script type="text/javascript">
    $(function(){
        $(".layui-canvs").jParticle({
            background: "#141414",
            color: "#E6E6E6"
        });
    });
</script>
</body>
</html>
