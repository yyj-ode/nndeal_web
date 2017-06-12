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
            <legend>添加子菜单</legend>
        </fieldset>
        {{ Form::open(array('url' => 'admin/wechatMenu/store', 'method' => 'POST','class'=>'layui-form',)) }}
        {!! csrf_field() !!}

        <div class="layui-form-item">
            <label class="layui-form-label">子菜单</label>
            <div class="layui-input-block">
                <input type="text" name="name" lay-verify="required" autocomplete="off" placeholder="请输入子菜单名称" class="layui-input" value="{{$result->name}}">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">URL</label>
            <div class="layui-input-block">
                <input type="text" name="url" lay-verify="required" autocomplete="off" placeholder="请输URL" class="layui-input" value="{{$result->url}}">
            </div>
        </div>


        <div class="layui-form-item" id="city_china">
            <label class="layui-form-label">类型</label>
            <div class="layui-input-inline">
                <select name="type" class="one select" lay-filter="one">
                    <option @if($result->type == 'click')selected="" @endif  value="click">click</option>
                    <option @if($result->type == 'view')selected="" @endif  value="view">view</option>
                    <option @if($result->type == 'scancode_push')selected="" @endif value="scancode_push">scancode_push</option>
                    <option @if($result->type == 'scancode_waitmsg')selected="" @endif value="scancode_waitmsg">scancode_waitmsg</option>
                    <option @if($result->type == 'pic_sysphoto')selected="" @endif value="pic_sysphoto">pic_sysphoto</option>
                    <option @if($result->type == 'pic_photo_or_album')selected="" @endif value="pic_photo_or_album">pic_photo_or_album</option>
                    <option @if($result->type == 'pic_weixin')selected="" @endif value="pic_weixin">pic_weixin</option>
                    <option @if($result->type == 'location_select')selected="" @endif value="location_select">location_select</option>
                    <option @if($result->type == 'media_id')selected="" @endif value="media_id">media_id</option>
                    <option @if($result->type == 'view_limited')selected="" @endif value="view_limited">view_limited</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">显示</label>
            <div class="layui-input-block">
                <input type="radio"  @if($result->show == 1)checked="" @endif name="show" value="1" title="显示">
                <input type="radio" @if($result->show == 0)checked="" @endif name="show" value="0" title="不显示">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">排序</label>
            <div class="layui-input-block">
                <input type="text" name="sort" lay-verify="required" autocomplete="off" placeholder="" class="layui-input" value="{{$result->sort}}">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit="" lay-filter="submit">立即提交</button>
            </div>
        </div>
        <input type="hidden" name="parent_id" id="parent_id" value="{{$parent_id}}" >
        <input type="hidden" name="id" id="id" value="{{$result->id}}" >
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
                text: function(value) {
                    var text = layedit.getText(editIndex);
                    if(!text) {
                        return '描述不能为空';
                    }
                },
                pass: [/(.+){6,12}$/, '密码必须6到12位'],
                /* var text = layedit.getText(editIndex);*/
                email:[/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/ ,'邮箱格式不正确'],
                content: function(value) {
                    layedit.sync(editIndex);
                }
            });
            //监听提交
            form.on('submit(submit)', function(data) {
                var text = layedit.getText(editIndex);
                data['field']['description'] = text;
                loadShow();
                $.ajax({
                    url: "{{url('admin/wechatMenu/update_save_son')}}",
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
                                content: '<div style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">修改成功！<br><br>我们此后的征途是星辰大海 ^_^<br></div>',
                                success: function(layero){
                                    var btn = layero.find('.layui-layer-btn');
                                    btn.css('text-align', 'center');
                                    btn.find('.layui-layer-btn0').attr({
                                        href: '{{url("admin/wechatMenu/son?parent_id=$parent_id")}}',
                                        target: '_self'
                                    });
                                    btn.find('.layui-layer-btn1').attr({
                                        href: '{{url("admin/wechatMenu/update_save_son?parent_id=$parent_id")}}',
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
                                content: '<div style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">修改失败<br></div>',
                                success: function(layero){
                                    var btn = layero.find('.layui-layer-btn');
                                    btn.css('text-align', 'center');
                                    btn.find('.layui-layer-btn0').attr({
                                        href: '{{url("admin/wechatMenu/son?parent_id=$parent_id")}}',
                                        target: '_self'
                                    });
                                    btn.find('.layui-layer-btn1').attr({
                                        href: '{{url("admin/wechatMenu/update_save_son?parent_id=$parent_id")}}',
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