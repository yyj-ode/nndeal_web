@extends('Backend.admin.layouts.layui')

@section('seo')
    @include('Backend.admin.layouts.mainSeo')
@stop

@section('content')
    <div style="margin: 15px;">
        <blockquote class="layui-elem-quote">
            <a class="layui-btn layui-btn-small" href="{{url('admin/roles/index')}}"><cite>全部角色</cite></a>
            <a class="layui-btn layui-btn-small" href="javascript:history.back();"><cite>返回</cite></a>
        </blockquote>
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>修改</legend>
        </fieldset>
        {{ Form::open(array('url' => 'admin/admin/update', 'method' => 'POST','class'=>'layui-form',)) }}
        {!! csrf_field() !!}
        <input type="hidden" name="id" value="{{$result->id}}" id="id">
        {{--
        <div class="layui-form-item">
            <label class="layui-form-label">权限</label>
            <div class="layui-input-block">
                <input type="checkbox" name="add"  @if($result->add == 1)checked="" @endif value="1" title="增加">
                <input type="checkbox" name="save"  @if($result->save == 1)checked="" @endif  value="1" title="修改">
                <input type="checkbox" name="del"   @if($result->del == 1)checked="" @endif  value="1" title="删除">
            </div>
        </div>--}}
        <div class="layui-form-item">
            <label class="layui-form-label">标签</label>
            <div class="layui-input-block">
                <input type="text" name="label" lay-verify="required" autocomplete="off" placeholder="请输用户名称" class="layui-input" value="{{$result->label}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">Name</label>
            <div class="layui-input-block">
                <input type="text" name="name" lay-verify="required" autocomplete="off" placeholder="请输用户名称" class="layui-input" value="{{$result->name}}">
            </div>
        </div>
        <div class="layui-form-item" id="city_china">
            <label class="layui-form-label">分类</label>
            <div class="layui-input-inline">
                <select name="cat_id" class="one select" lay-filter="one">
                    @foreach($data_menu as $k=>$v)
                        <option value="{{$v['id']}}" @if($v['id'] == $result->parent_id)selected="selected"@endif>{{$v['html']}}{{$v['name']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
       {{-- <div class="layui-form-item" id="city_china">
            <label class="layui-form-label">分类</label>
            <div class="layui-input-inline">
                <select name="cat_id" class="one select" lay-filter="one">
                    @foreach($data_menu as $k=>$v)
                        <option value="{{$v['id']}}">{{$v['html']}}{{$v['name']}}</option>
                    @endforeach
                </select>
            </div>
        </div>--}}
        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">前缀</label>
                <div class="layui-input-inline">
                    <input type="text" name="prefix" value="{{$result->prefix}}" lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-inline">
                <label class="layui-form-label">控制器</label>
                <div class="layui-input-inline">
                    <input type="text" name="controllers" value="{{$result->controllers}}" lay-verify="required"  autocomplete="off" class="layui-input">
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">方法</label>
            <div class="layui-input-block">
                <input type="text" name="action" value="{{$result->action}}" lay-verify="required" autocomplete="off" placeholder="请输用户名称" class="layui-input" >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">显示</label>
            <div class="layui-input-block">
                <input type="radio"  @if($result->show == 1)checked="" @endif   name="show" value="1" title="显示">
                <input type="radio"  @if($result->show == 0)checked="" @endif name="show" value="0" title="不显示">
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">描述</label>
            <div class="layui-input-block">
                <textarea class="layui-textarea layui-hide" name="description" lay-verify="required" id="LAY_demo_editor">{{$result->description}}</textarea>
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
                        return '标题至少得1个字符啊';
                    }
                },
                password: function(value) {
                    var pass1=$('#xpass1').val();
                    var pass2=$('#xpass2').val();

                    if( pass1.length<6 || pass1.length>12){
                        return '新密码必须6到12位';
                    }
                    if( pass2.length<6 || pass2.length>12){
                        return '新密码必须6到12位';
                    }

                    if( !(pass1 == pass2)){
                        return '两次输入新密码不一致';
                    }
                },
                pass: [/(.+){6,12}$/, '密码必须6到12位'],
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
                    url: "{{url('admin/permissions/update_save')}}",
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
                                content: '<div style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">修改成功！<br><br>我们此后的征途是星辰大海 ^_^<br></div>',
                                success: function(layero){
                                    var btn = layero.find('.layui-layer-btn');
                                    btn.css('text-align', 'center');
                                    btn.find('.layui-layer-btn0').attr({
                                        href: '{{url('admin/permissions/index')}}',
                                        target: '_self'
                                    });
                                    btn.find('.layui-layer-btn1').attr({
                                        href: "{{url('admin/permissions/update/?id='.$result->id)}}",
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
                                area: '300px;',
                                shade: 0.8,
                                id: 'LAY_layuipro', //设定一个id，防止重复弹出
                                btn: ['关闭窗口', '再次编辑'],
                                moveType: 1, //拖拽模式，0或者1
                                content: '<div style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">修改失败<br></div>',
                                success: function(layero){
                                    var btn = layero.find('.layui-layer-btn');
                                    btn.css('text-align', 'center');
                                    btn.find('.layui-layer-btn0').attr({
                                        href: '{{url('admin/permissions/index')}}',
                                        target: '_self'
                                    });
                                    btn.find('.layui-layer-btn1').attr({
                                        href: "{{url('admin/permissions/update/?id='.$result->id)}}",
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