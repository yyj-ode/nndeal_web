@extends('Backend.admin.layouts.layui')

@section('seo')
    @include('Backend.admin.layouts.mainSeo')
@stop

@section('content')
    <div style="margin: 15px;">
        <blockquote class="layui-elem-quote">
            <a class="layui-btn layui-btn-small" href="{{url('admin/authentication/index')}}"><cite>用户认证</cite></a>
            <a class="layui-btn layui-btn-small" href="javascript:history.back();"><cite>返回</cite></a>
        </blockquote>
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>审核</legend>
        </fieldset>
        {{ Form::open(array('url' => 'admin/admin/update', 'method' => 'POST','class'=>'layui-form',)) }}
        <input type="hidden" name="id" value="{{$result->id}}" id="id">
        <div class="layui-form-item">
            <label class="layui-form-label">用户</label>
            <div class="layui-input-block">
                <input type="text" name="name" readonly="readonly" lay-verify="required" autocomplete="off"  class="layui-input" value="{{$result->users->mobile}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">身份</label>
            <div class="layui-input-block">
                <input type="text" name="name" readonly="readonly" lay-verify="required" autocomplete="off"  class="layui-input" value="{{$result->roles}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">身份证</label>
            <div class="layui-input-block">
                <input type="text" name="name" readonly="readonly" lay-verify="required" autocomplete="off"  class="layui-input" value="{{$result->card}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">有效期</label>
            <div class="layui-input-block">
                <input type="text" name="name" readonly="readonly" lay-verify="required" autocomplete="off"  class="layui-input" value="{{$result->time}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">类型</label>
            <div class="layui-input-block">
                <input type="text" name="name" readonly="readonly" lay-verify="required" autocomplete="off"  class="layui-input" value="{{$result->type}}">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">上传封面图</label>
            <span target="layui-upload-iframe" method="post" key="set-mine" enctype="multipart/form-data" action="">
                <input type="file" name="file" class="layui-upload-file">
            </span>
            <span id="image_upload_src">
                 @if($result->image)
                    <img src="{{$result->image}}" style="width:60px;height:60px;padding:2px;"><input type="hidden" name="image" value="{{$result->image}}"><button type="button" class="btn btn-close"><i class="fa fa-close"></i></button>
                @endif
            </span>
        </div>



        <div class="layui-form-item">
            <label class="layui-form-label">状态</label>
            <div class="layui-input-block">
                <input type="radio" name="status" value="0" @if($result->status == 0) checked="checked" @endif title="待审核" >
                <input type="radio" name="status"  @if($result->status == 1) checked="checked" @endif value="1" title="审核通过" >
                <input type="radio" name="status"  @if($result->status == 2) checked="checked" @endif value="2" title="审核未通过" >
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">描述</label>
            <div class="layui-input-block">
                <textauthentication class="layui-textauthentication layui-hide" lay-verify="text" name="description"  id="LAY_demo_editor">{{$result['description']}}</textauthentication>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit="" lay-filter="submit">立即提交</button>
            </div>
        </div>
        <input type="hidden" name="parent_id" id="parent_id" value="{{$parent_id}}" >
        {{ Form::close() }}
    </div>
@stop

@section('js')
    <script type="text/javascript">
        layui.use(['form', 'layedit', 'laydate','upload'], function() {
            var form = layui.form(),
                layer = layui.layer,
                layedit = layui.layedit,
                laydate = layui.laydate;

            layedit.set({
                uploadImage: {
                    url: "{{url('admin/uploads/articleimg')}}", //接口url
                    type: 'post' //默认post
                }
            })

            //创建一个编辑器
            var editIndex = layedit.build('LAY_demo_editor');
            //自定义验证规则
            form.verify({
                title: function(value) {
                    if(value.length < 1) {
                        return '标题至少得1个字符啊';
                    }
                },
                content: function(value) {
                    layedit.sync(editIndex);
                }
            });

            //upload
            layui.upload({
                elem:'.layui-upload-file',
                url: "{{url('admin/uploads/image')}}",
                ext: 'jpg|png|gif|jpeg',
                before: function (input) {
                    console.log(input);
                    console.log('文件上传中');
                },
                success: function (json) {
                    $('#image_upload').val(json.data.fileId);
                    $('#image_upload_src').html('<img src="' + json.data.url + '" style="width:60px;height:60px;padding:2px;"><input type="hidden" name="image" value="' + json.data.url + '"><button type="button" class="btn btn-close"><i class="fa fa-close"></i></button>');
                    console.log(json); //上传成功返回值，必须为json格式
                }
            });

            //监听提交
            form.on('submit(submit)', function(data) {
                var text = layedit.getText(editIndex);
                data['field']['description'] = text;
                loadShow();
                $.ajax({
                    url: "{{url('admin/authentication/save')}}",
                    type: 'post',
                    data: data.field,
                    headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                    success:function(result){
                        console.log(result.show);
                        if(result.status == true){
                            layer.open({
                                type: 1,
                                title: false, //不显示标题栏
                                closeBtn: false,
                                authentication: '300px;',
                                shade: 0.8,
                                id: 'LAY_layuipro', //设定一个id，防止重复弹出
                                btn: ['关闭窗口', '再次编辑'],
                                moveType: 1, //拖拽模式，0或者1
                                content: '<div style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">修改成功！<br><br>我们此后的征途是星辰大海 ^_^<br></div>',
                                success: function(layero){
                                    var btn = layero.find('.layui-layer-btn');
                                    btn.css('text-align', 'center');
                                    btn.find('.layui-layer-btn0').attr({
                                        href: '{{url('admin/authentication/index')}}',
                                        target: '_self'
                                    });
                                    btn.find('.layui-layer-btn1').attr({
                                        href: "{{url('admin/authentication/update/?id='.$result->id)}}",
                                        target: '_self'
                                    });
                                    layer.close(layero);
                                }
                            });
                        }else{
                            layer.open({
                                type: 1,
                                title: false, //不显示标题栏
                                closeBtn: false,
                                authentication: '300px;',
                                shade: 0.8,
                                id: 'LAY_layuipro', //设定一个id，防止重复弹出
                                btn: ['关闭窗口', '再次编辑'],
                                moveType: 1, //拖拽模式，0或者1
                                content: '<div style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">修改失败<br></div>',
                                success: function(layero){
                                    var btn = layero.find('.layui-layer-btn');
                                    btn.css('text-align', 'center');
                                    btn.find('.layui-layer-btn0').attr({
                                        href: '{{url('admin/authentication/index')}}',
                                        target: '_self'
                                    });
                                    btn.find('.layui-layer-btn1').attr({
                                        href: "{{url('admin/authentication/update/?id='.$result->id)}}",
                                        target: '_self'
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