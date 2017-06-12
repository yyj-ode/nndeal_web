@extends('Backend.admin.layouts.layui')

@section('seo')
    @include('Backend.admin.layouts.mainSeo')
@stop

@section('content')
    <div style="margin: 15px;">
        <blockquote class="layui-elem-quote">
            <a class="layui-btn layui-btn-small" href="{{url('admin/area/index')}}"><cite>全部地区</cite></a>
            <a class="layui-btn layui-btn-small" href="javascript:history.back();"><cite>返回</cite></a>
        </blockquote>
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>添加地区</legend>
        </fieldset>
        {{ Form::open(array('url' => 'admin/area/store', 'method' => 'POST','class'=>'layui-form',)) }}
        {!! csrf_field() !!}

        <div class="layui-form-item">
            <label class="layui-form-label">父级</label>
            <div class="layui-input-block">
                <input type="text"  lay-verify="required" readonly="readonly" autocomplete="off"  class="layui-input" value="{{$parent_name->name}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">地区</label>
            <div class="layui-input-block">
<<<<<<< HEAD
                <input type="text" name="name" lay-verify="required" autocomplete="off"  class="layui-input" value="">
=======
                <input type="text" name="name" lay-verify="required" autocomplete="off" placeholder="请输地区名称" class="layui-input" value="">
>>>>>>> kim
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">排序</label>
            <div class="layui-input-block">
                <input type="text" name="view_order" lay-verify="required" autocomplete="off" placeholder="请输排序" class="layui-input" value="">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">简写</label>
            <div class="layui-input-block">
                <input type="text" name="shorthand" lay-verify="required" autocomplete="off" placeholder="请输简写" class="layui-input" value="">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">状态</label>
            <div class="layui-input-block">
                <input type="radio" name="show" checked="checked" value="1" title="显示" >
                <input type="radio" name="show" value="0" title="不显示" >
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">描述</label>
            <div class="layui-input-block">
                <textarea class="layui-textarea layui-hide" lay-verify="text" name="description"  id="LAY_demo_editor"></textarea>
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
                    url: "{{url('admin/area/save')}}",
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
                                    btn: ['返回', '再次增加'],
                                    moveType: 1, //拖拽模式，0或者1
                                    content: '<div style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">增加成功！<br><br>我们此后的征途是星辰大海 ^_^<br></div>',
                                    success: function(layero){
                                        var btn = layero.find('.layui-layer-btn');
                                        btn.css('text-align', 'center');
                                        btn.find('.layui-layer-btn0').attr({
<<<<<<< HEAD
                                            href: 'javascript:history.back();',
=======
                                            href: '{{url('admin/area/index?parent_id='.$parent_id)}}',
>>>>>>> kim
                                            target: '_self'
                                        });
                                        btn.find('.layui-layer-btn1').attr({
                                            href: "{{url('admin/area/create?parent_id='.$parent_id)}}",
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
                                    btn: ['返回', '再次增加'],
                                    moveType: 1, //拖拽模式，0或者1
                                    content: '<div style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">增加失败<br></div>',
                                    success: function(layero){
                                        var btn = layero.find('.layui-layer-btn');
                                        btn.css('text-align', 'center');
                                        btn.find('.layui-layer-btn0').attr({
<<<<<<< HEAD
                                            href: 'javascript:history.back();',
=======
                                            href: '{{url('admin/area/index?parent_id='.$parent_id)}}',
>>>>>>> kim
                                            target: '_self'
                                        });
                                        btn.find('.layui-layer-btn1').attr({
                                            href: '{{url('admin/area/create?parent_id='.$parent_id)}}',
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