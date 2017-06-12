<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="_token" content="{{ csrf_token() }}"/>
    @include('Backend.admin.layouts.layuiStyle')
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    @yield('seo')
</head>
<body class="gray-bg" >
<div id="loading" style="display: block;">
    <div id="loading-center">
        <div id="loading-center-absolute">
            <div class="object" id="object_four"></div>
            <div class="object" id="object_three"></div>
            <div class="object" id="object_two"></div>
            <div class="object" id="object_one"></div>
        </div>
    </div>
</div>

<div class="admin-main">
    @yield('content')
</div>

<script src="{{asset('plugins/layui/layui.js')}}"></script>
<script src="{{asset('plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="{{asset('dist/js/common.js')}}"></script>
<script type="text/javascript">
    layui.config({
        base: '/plugins/layui/lay/modules/'
    });
    layui.use(['form', 'layedit', 'laydate'], function(){
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "onclick": null,
            "showDuration": "400",
            "hideDuration": "1000",
            "timeOut": "7000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        $(document).ready(function() {loadFadeOut();});
    });
</script>
@yield('js')
@include('Backend.admin.layouts.mainFooter')
@include('Backend.admin.partials.errors')
@include('Backend.admin.partials.success')
</body>
</html>
