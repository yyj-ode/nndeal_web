@extends('Backend.admin.layouts.layui')

@section('seo')
    @include('Backend.admin.layouts.mainSeo')
@stop

@section('content')
    <div style="margin: 15px;">
        <blockquote class="layui-elem-quote">
            <a class="layui-btn layui-btn-small" href="{{url('admin/admin')}}"><cite>全部用户</cite></a>
            <a class="layui-btn layui-btn-small" href="javascript:history.back();"><cite>返回</cite></a>
        </blockquote>
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>添加用户</legend>
        </fieldset>
        {{ Form::open(array('url' => 'admin/admin/update', 'method' => 'POST','class'=>'layui-form',)) }}
        {!! csrf_field() !!}

        <div class="layui-form-item">
            <label class="layui-form-label">用户</label>
            <div class="layui-input-block">
                <input type="text" name="name" lay-verify="title" autocomplete="off" placeholder="请输用户名称" class="layui-input" value="">
            </div>
        </div>

       {{-- <div class="layui-form-item">
            <label class="layui-form-label">身份</label>
            <div class="layui-input-inline">
                <select name="power_id" lay-verify="required" lay-search="">
                    <option value="">请选择</option>
                    @foreach($power as $k=>$v)
                    <option value="{{$v->id}}">{{$v->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>--}}
        <div class="layui-form-item">
            <label class="layui-form-label">角色</label>
            <div class="layui-input-block">
                @foreach($role as $key=>$value)
                    <input type="checkbox" name="roles"  @if($key == 0) checked="" @endif value="{{$value->id}}" title="{{$value->display_name}}">
                @endforeach
                {{-- <input type="checkbox" name="like[read]" title="阅读" checked="">
                 <input type="checkbox" name="like[game]" title="游戏">--}}
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">邮箱</label>
            <div class="layui-input-block">
                <input type="text" name="email" lay-verify="email" autocomplete="off" placeholder="请输邮箱" class="layui-input" value="">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">密码</label>
            <div class="layui-input-block">
                <input type="password" name="password" value="" lay-verify="pass" placeholder="请输入密码" autocomplete="off" class="layui-input">
            </div>
        </div>


        {{--<div class="layui-form-item" id="city_china">
            <label class="layui-form-label">分类</label>
            <div class="layui-input-inline">
                <select name="one" class="one select" lay-filter="one">
                    <option value="">请选择</option>
                    <option value="0">第一级栏目</option>
                    @foreach($admin as $key=>$value)
                        <option value="{{$value->id}}">{{$value->title}}</option>
                    @endforeach

                </select>
            </div>
            <div class="layui-input-inline" style="display: none;" id="tow_input">
                <select name="tow"  class="tow select" lay-filter="tow" id="tow">
                    <option value="">请选择</option>
                </select>
            </div>
            <div class="layui-input-inline" style="display: none;" id="three_input">
                <select name="three" class="three select" lay-filter="three" id="three">
                    <option value="">请选择</option>
                </select>
            </div>
            <div class="layui-input-inline" id="four_input" style="display: none;">
                <select name="four" class="four select" lay-filter="four" id="four">
                    <option value="">请选择</option>
                </select>
            </div>
            <div class="layui-input-inline" id="five_input" style="display: none;">
                <select name="five" class="five select" lay-filter="five" id="five">
                    <option value="">请选择</option>
                </select>
            </div>

        </div>--}}

       {{-- <div class="layui-form-item">
            <label class="layui-form-label">修改分类</label>
            <div class="layui-input-block">
                <input type="radio" name="check_admin" value="1" title="是" >
                <input type="radio" name="check_admin" value="0" title="否" checked="">
            </div>
        </div>--}}

       {{-- <div class="layui-form-item">
            <label class="layui-form-label">关键字</label>
            <div class="layui-input-block">
                <input type="text" name="keywords" value="" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
        </div>--}}

        {{--<div class="layui-form-item layui-form-text">
            <label class="layui-form-label">描述</label>
            <div class="layui-input-block">
                <textarea class="layui-textarea layui-hide" name="description" lay-verify="required" id="LAY_demo_editor"></textarea>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">状态</label>
            <div class="layui-input-block">
                <input type="radio" name="status" value="5" title="未审核" >
                <input type="radio" name="status" value="1" title="审核" >
                <input type="radio" name="status" value="6" title="推荐" >
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">类型</label>
            <div class="layui-input-block">
                <input type="radio" name="type" value="EN" title="英文" >
                <input type="radio" name="type" value="CN" title="中文" >
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">显示</label>
            <div class="layui-input-block">
                <input type="radio" name="show" value="1" title="显示">
                <input type="radio" name="show" value="0" title="不显示">
            </div>
        </div>--}}

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
                pass: [/(.+){6,12}$/, '密码必须6到12位'],
                email:[/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/ ,'邮箱格式不正确'],
                content: function(value) {
                    layedit.sync(editIndex);
                }
            });

            //监听提交
            form.on('submit(submit)', function(data) {
                var chk_value =[];
                $('input[name="roles"]:checked').each(function(){
                    chk_value.push($(this).val());
                });
                data['field']['roles'] = chk_value;
                loadShow();
                $.ajax({
                    url: "{{url('admin/admin/store')}}",
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
                                            href: '{{url('admin/admin')}}',
                                            target: '_self'
                                        });
                                        btn.find('.layui-layer-btn1').attr({
                                            href: '{{url('admin/admin/create')}}',
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
                                    content: '<div style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">增加失败，邮箱已注册<br></div>',
                                    success: function(layero){
                                        var btn = layero.find('.layui-layer-btn');
                                        btn.css('text-align', 'center');
                                        btn.find('.layui-layer-btn0').attr({
                                            href: '{{url('admin/admin')}}',
                                            target: '_self'
                                        });
                                        btn.find('.layui-layer-btn1').attr({
                                            href: '{{url('admin/admin/create')}}',
                                        });
                                        layer.close(layero);
                                    }
                                });
                            }
                    }
                });

                return false;
            });

//            toastr.info('Are you the 6 fingered man?');
            // Display a warning toast, with no title
//            toastr.warning('My name is Inigo Montoya. You killed my father, prepare to die!');

            // Display a success toast, with a title
//            toastr.success('Have fun storming the castle!', 'Miracle Max Says');

            // Display an error toast, with a title
//            toastr.error('I do not think that word means what you think it means.', 'Inconceivable!');

            // Immediately remove current toasts without using animation
//        toastr.remove()

            // Remove current toasts using animation
//        toastr.clear()

            // Override global options
//            toastr.success('We do have the Kapua suite available.', 'Turtle Bay Resort', {timeOut: 5000});
        });
    </script>
@stop