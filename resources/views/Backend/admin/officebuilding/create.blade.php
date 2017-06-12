@extends('Backend.admin.layouts.layui')

@section('seo')
    @include('Backend.admin.layouts.mainSeo')
@stop

@section('content')
    <div style="margin: 15px;">
        <blockquote class="layui-elem-quote">
{{--            <a class="layui-btn layui-btn-small" href="{{url('admin/category')}}"><cite>全部分类</cite></a>--}}
            <a class="layui-btn layui-btn-small" href="javascript:history.back();"><cite>返回</cite></a>
        </blockquote>
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>添加办公楼信息</legend>
        </fieldset>
        {{ Form::open(array('url' => 'admin/category/update', 'method' => 'POST','class'=>'layui-form',)) }}
        {!! csrf_field() !!}

        {{--<fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">--}}
            {{--<legend>卡片风格的Tab</legend>--}}
        {{--</fieldset>--}}

        <div class="layui-tab layui-tab-card">
            <ul class="layui-tab-title">
                <li class="layui-this">添加信息</li>
            </ul>
            <div class="layui-tab-content">
                <div class="layui-tab-item layui-show" style="height: 750px;">
                    <div class="layui-form-item" style="width: 300px;">
                        <label class="layui-form-label">经度</label>
                        <div class="layui-input-block">
                            <input type="text" name="longitude" autocomplete="off" placeholder="请输入经度" class="layui-input" value="">
                        </div>
                    </div>

                    <div class="layui-form-item" style="width: 300px;">
                        <label class="layui-form-label">纬度</label>
                        <div class="layui-input-block">
                            <input type="text" name="latitude" autocomplete="off" placeholder="请输入纬度" class="layui-input" value="">
                        </div>
                    </div>

                    <div class="layui-form-item" style="width: 300px;">
                        <label class="layui-form-label">写字楼名称</label>
                        <div class="layui-input-block">
                            <input type="text" name="office_name" autocomplete="off" placeholder="请输入名称" class="layui-input" value="">
                        </div>
                    </div>

                    <div class="layui-form-item" style="width: 300px;">
                        <label class="layui-form-label">写字楼地址</label>
                        <div class="layui-input-block">
                            <input type="text" name="office_address" autocomplete="off" placeholder="请输入地址" class="layui-input" value="">
                        </div>
                    </div>

                    <div class="layui-form-item" style="width: 300px;">
                        <label class="layui-form-label">企业类型(已入住企业)</label>
                        <div class="layui-input-block">
                            <input type="text" name="company_categories" autocomplete="off" placeholder="请输入类型" class="layui-input" value="">
                        </div>
                    </div>

                    <div class="layui-form-item" style="width: 300px;">
                        <label class="layui-form-label">租金价格(元/平/天)</label>
                        <div class="layui-input-block">
                            <input type="text" name="rent_rate" autocomplete="off" placeholder="请输入价格" class="layui-input" value="">
                        </div>
                    </div>

                </div>

            </div>
        </div>


        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit="" lay-filter="submit">立即提交</button>
            </div>
        </div>
        {{--<input type="hidden" name="parent_id" id="parent_id" value="{{$parent_id}}" >--}}
        {{ Form::close() }}
    </div>
@stop

@section('js')
    <script type="text/javascript">
        layui.use(['form', 'layedit', 'laydate'], function() {
            var form = layui.form(),
                layer = layui.layer,
                layedit = layui.layedit,
                laydate = layui.laydate;

            //创建一个编辑器
            var editIndex = layedit.build('LAY_demo_editor');
            //自定义验证规则
            form.verify({
                content: function(value) {
                    layedit.sync(editIndex);
                }
            });


            form.on('select(one)', function (data) {
//                alert(123);
                var category_id = data.value;
                $("#category_id").val(category_id);
                console.log(category_id);
                if(category_id != ''){
                    var html = '';
                    $.ajax({
                        url: "{{url('admin/officebuilding/check')}}",
                        type: 'post',
                        data: {id:category_id},
                        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                        success:function(result){
                            $('#tow_input').show();
                            $("#tow").html('');
                            $("#tow").append('<option value="">请选择</option>');
                            $.each( result, function(index, content){
                                html+= "<option value='" + content.id +"'>" + content.name +"</option>";
                            });
                            $("#tow").append(html);
                            $('#three_input').hide();
                            $("#three").html('<option value="">请选择</option>');
                            form.render('select');
                        }
                    });
                }
            });

            form.on('select(tow)', function (data) {
                var category_id = data.value;
                $("#category_id").val(category_id);
                console.log(category_id);
                if(category_id != ''){
                    $.ajax({
                        url: "{{url('admin/officebuilding/check')}}",
                        type: 'post',
                        data: {id:category_id},
                        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                        success:function(result){
                            $('#three_input').show();
                            var html = '';
                            $("#three").html('');
                            $("#three").append('<option value="">请选择</option>');
                            $.each( result, function(index, content){
                                html+= "<option value='" + content.id +"'>" + content.name +"</option>";
                            });
                            $("#three").append(html);
                            form.render('select');
                            return true;
                        }
                    });
                };
            });


            //监听提交
            form.on('submit(submit)', function(data) {
//                alert(1);
//                loadShow();
                $.ajax({
                    url: "{{url('admin/officebuilding/store')}}",
                    type: 'post',
                    data: data.field,
                    headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                    success:function(result){
                        console.log(result.status);
                        if(result.status == true){
                            layer.open({
                                type: 1,
                                title: false, //不显示标题栏
                                closeBtn: false,
                                area: '300px;',
                                shade: 0.8,
                                id: 'LAY_layuipro', //设定一个id，防止重复弹出
                                btn: ['关闭窗口', '再次编辑'],
                                moveType: 1, //拖拽模式，0或者1
                                content: '<div style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">感谢提交！<br><br>我们此后的征途是星辰大海 ^_^<br></div>',
                                success: function(layero){
                                    var btn = layero.find('.layui-layer-btn');
                                    btn.css('text-align', 'center');
                                    btn.find('.layui-layer-btn0').attr({
                                        href: '{{url('admin/officebuilding')}}',
                                        target: '_self'
                                    });
                                    btn.find('.layui-layer-btn1').attr({
                                        href: '{{url('admin/officebuilding/create')}}',
                                    });
                                    layer.close(layero);
                                }
                            });
                        }
                    }
                });

                return false;
            });

        });

    </script>
@stop