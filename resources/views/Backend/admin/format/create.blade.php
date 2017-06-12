@extends('Backend.admin.layouts.layui')

@section('seo')
    @include('Backend.admin.layouts.mainSeo')
@stop

@section('content')

    <div style="margin: 15px;">
        <blockquote class="layui-elem-quote">
            <a class="layui-btn layui-btn-small" href="javascript:history.back();"><cite>返回</cite></a>
        </blockquote>
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>添加基本信息</legend>
        </fieldset>
        {{ Form::open(array('url' => 'admin/Format/store', 'method' => 'POST','class'=>'layui-form',)) }}
        {!! csrf_field() !!}
        <div class="layui-form-item">
            <label class="layui-form-label">名称</label>
            <div class="layui-input-block">
                <input type="text" name="name" lay-verify="required" autocomplete="off" placeholder="" class="layui-input" value="">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">状态</label>
            <div class="layui-input-block">
                <input type="radio" name="status" value="1" title="显示" checked="">
                <input type="radio" name="status" value="0" title="不显示">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">排序</label>
            <div class="layui-input-block">
                <input type="text" name="sort" value="0" lay-verify="required" autocomplete="off" placeholder="" class="layui-input" value="">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit="" lay-filter="submit">立即提交</button>
            </div>
        </div>
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
                title: function(value) {
                    if(value.length < 1) {
                        return '用户名至少得1个字符啊';
                    }
                },
                content: function(value) {
                    layedit.sync(editIndex);
                }
            });

            form.on('select(one)', function (data) {
                var category_id = data.value;
                $("#category_id").val(category_id);
                console.log(category_id);
                if(category_id != ''){
                    var html = '';
                    $.ajax({
                        url: "{{url('admin/format/check')}}",
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
                        url: "{{url('admin/format/check')}}",
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
                var text = layedit.getText(editIndex);
                data['field']['description'] = text;
                loadShow();
                $.ajax({
                    url: "{{url('admin/format/store')}}",
                    type: 'post',
                    data: data.field,
                    headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                    success:function(result){
                            if(result.status == true){
                                layer.open({
                                    type: 1,
                                    title: false, //不显示标题栏
                                    closeBtn: false,
                                    area: '300px;',
                                    shade: 0.8,
                                    id: 'LAY_layuipro', //设定一个id，防止重复弹出
                                    btn: ['关闭窗口', '再次增加'],
                                    moveType: 1, //拖拽模式，0或者1
                                    content: '<div style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">'+result.message+'<br><br>我们此后的征途是星辰大海 ^_^<br></div>',
                                    success: function(layero){
                                        var btn = layero.find('.layui-layer-btn');
                                        btn.css('text-align', 'center');
                                        btn.find('.layui-layer-btn0').attr({
                                            href: '{{url('admin/format/index')}}',
                                            target: '_self'
                                        });
                                        btn.find('.layui-layer-btn1').attr({
                                            href: '{{url('admin/format/create')}}',
                                        });
                                        layer.close(layero);
                                    }
                                });
                            }else{
                                layer.open({
                                    type: 1,
                                    title: false, //不显示标题栏
                                    closeBtn: false,
                                    area: '300px;',
                                    shade: 0.8,
                                    id: 'LAY_layuipro', //设定一个id，防止重复弹出
                                    btn: ['关闭窗口', '再次增加'],
                                    moveType: 1, //拖拽模式，0或者1
                                    content: '<div style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">'+result.message+'<br></div>',
                                    success: function(layero){
                                        var btn = layero.find('.layui-layer-btn');
                                        btn.css('text-align', 'center');
                                        btn.find('.layui-layer-btn0').attr({
                                            href: '{{url('admin/format/index')}}',
                                            target: '_self'
                                        });
                                        btn.find('.layui-layer-btn1').attr({
                                            href: '{{url('admin/format/create')}}',
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