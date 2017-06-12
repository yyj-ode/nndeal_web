<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="_token" content="{{ csrf_token() }}"/>
    @include('Backend.admin.layouts.mainStyle')
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
<div class="wrapper wrapper-content animated fadeInRight">
    {{--<section class="content-header">--}}
        {{--<h5>--}}
            {{--{!! Breadcrumbs::render(Route::currentRouteName()) !!}--}}
        {{--</h5>--}}
    {{--</section>--}}
    <section class="content">
        @yield('content')
    </section>
</div>

<script src="{{asset('plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('dist/js/app.min.js')}}"></script>

<script src="{{asset('plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables/media/js/dataTables.bootstrap4.min.js')}}"></script>

{{--<script src="{{asset('plugins/datatables/extensions/Buttons/js/buttons.print.min.js')}}"></script>--}}
{{--<script src="{{asset('plugins/datatables/extensions/Buttons/js/dataTables.buttons.min.js')}}"></script>--}}
{{--<script src="{{asset('plugins/datatables/extensions/Buttons/js/buttons.bootstrap4.min.js')}}"></script>--}}

{{--<script src="{{asset('plugins/datatables/extensions/AutoFill/js/autoFill.bootstrap4.min.js')}}"></script>--}}
{{--<script src="{{asset('plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js')}}"></script>--}}
{{--<script src="{{asset('plugins/datatables/extensions/Editor/js/dataTables.editor.min.js')}}"></script>--}}
{{--<script src="{{asset('plugins/datatables/extensions/Editor/js/editor.bootstrap4.min.js')}}"></script>--}}
{{--<script src="{{asset('plugins/datatables/extensions/FixedColumns/js/dataTables.fixedColumns.min.js')}}"></script>--}}
{{--<script src="{{asset('plugins/datatables/extensions/FixedHeader/js/dataTables.fixedHeader.min.js')}}"></script>--}}
{{--<script src="{{asset('plugins/datatables/extensions/KeyTable/js/dataTables.keyTable.min.js')}}"></script>--}}
{{--<script src="{{asset('plugins/datatables/extensions/Responsive/js/responsive.bootstrap4.min.js')}}"></script>--}}
{{--<script src="{{asset('plugins/datatables/extensions/RowReorder/js/dataTables.rowReorder.min.js')}}"></script>--}}
{{--<script src="{{asset('plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js')}}"></script>--}}
{{--<script src="{{asset('plugins/datatables/extensions/Select/js/dataTables.select.min.js')}}"></script>--}}


<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="{{asset('dist/js/common.js')}}"></script>
<script type="text/javascript">
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
</script>

@yield('js')

@include('Backend.admin.layouts.mainFooter')
<script type="text/javascript">$(document).ready(function() {loadFadeOut();});</script>
</body>
</html>
