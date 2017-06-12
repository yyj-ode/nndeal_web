@extends('Backend.admin.layouts.layui')

@section('seo')
    @include('Backend.admin.layouts.mainSeo')
@stop

@section('content')
    <div style="margin: 15px;">
        <blockquote class="layui-elem-quote">
            <a class="layui-btn layui-btn-small" href="{{url('admin/category')}}"><cite>全部分类</cite></a>
            <a class="layui-btn layui-btn-small" href="javascript:history.back();"><cite>返回</cite></a>
        </blockquote>
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>编辑问题</legend>
        </fieldset>

        {{ Form::open(array('url' => 'admin/category/update', 'method' => 'POST','class'=>'layui-form',)) }}
        {!! csrf_field() !!}
        <div class="layui-form-item">
            <label class="layui-form-label">问题标题</label>
            <div class="layui-input-block">
                <input type="text" name="category_name" lay-verify="title" autocomplete="off" placeholder="请输入标题" class="layui-input" value="{{$result->category_name}}">
            </div>
        </div>

        <div class="layui-form-item" id="city_china">
            <label class="layui-form-label">分类</label>
            <div class="layui-input-inline">
                <select name="one" class="one select" lay-filter="one">
                    <option value="">请选择</option>
                    @foreach($category as $key=>$value)
                        <option value="{{$value->id}}">{{$value->category_name}}</option>
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

            @if(isset($result->category->category_name))
            <div class="layui-input-inline" id="five_input" style="display: block;">
                <a href="javascript:;" class="layui-btn site-demo-layim" data-type="message">
                    {!! $result->category->category_name !!}
                </a>
            </div>
            @endif

        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">修改分类</label>
            <div class="layui-input-block">
                <input type="radio" name="check_category" value="1" title="是" >
                <input type="radio" name="check_category" value="0" title="否" checked="">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">关键字</label>
            <div class="layui-input-block">
                <input type="text" name="keywords" value="{{$result->keywords}}" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">病情描述</label>
            <div class="layui-input-block">
                <textarea class="layui-textarea layui-hide" name="description" lay-verify="required" id="LAY_demo_editor">{{$result->description}}</textarea>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">状态</label>
            <div class="layui-input-block">
                <input type="radio" name="status" value="5" title="未审核" @if($result->status=='5') checked="" @endif>
                <input type="radio" name="status" value="1" title="审核" @if($result->status=='1') checked="" @endif>
                <input type="radio" name="status" value="6" title="推荐" @if($result->status=='6') checked="" @endif>
                <input type="radio" name="status" value="3" title="删除" @if($result->status=='3') checked="" @endif>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">显示</label>
            <div class="layui-input-block">
                <input type="radio" name="show" value="1" title="显示" @if($result->show=='1') checked="" @endif>
                <input type="radio" name="show" value="0" title="不显示" @if(empty($result->show)) checked="" @endif>
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit="" lay-filter="submit">立即提交</button>
            </div>
        </div>
        <input type="hidden" name="id" value="{{$result->id}}">
        <input type="hidden" name="parent_id" id="parent_id" value="{{$result->parent_id}}" >
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
                pass: [/(.+){6,12}$/, '密码必须6到12位'],
                content: function(value) {
                    layedit.sync(editIndex);
                }
            });

            form.on('select(one)', function (data) {
                var category_id = data.value;
                $("#parent_id").val(category_id);
                if(category_id != ''){
                    var html = '';
                    $.ajax({
                        url: "{{url('admin/category/category')}}",
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
                            form.render('select');
                            toastr.info('请选择下一级!');
                        }
                    });
                }
            });

            form.on('select(tow)', function (data) {
                var category_id = data.value;
                $("#parent_id").val(category_id);
                if(category_id != ''){
                    $.ajax({
                        url: "{{url('admin/category/check')}}",
                        type: 'post',
                        data: {id:category_id},
                        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                        success:function(result){
                            console.log(result.status);
                            if(result.status =='1'){
                                $('#three_input').show();
                                var html = '';
                                $.ajax({
                                    url: "{{url('admin/category/category')}}",
                                    type: 'post',
                                    data: {id:category_id},
                                    headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                                    success:function(result){
                                        $("#three").html('');
                                        $("#three").append('<option value="">请选择</option>');
                                        $.each( result, function(index, content){
                                            html+= "<option value='" + content.id +"'>" + content.name +"</option>";
                                        });
                                        $("#three").append(html);
                                        form.render('select');
                                        toastr.info('请选择下一级!');
                                        return true;
                                    }
                                });
                            }
                        }
                    });
                };
            });

            form.on('select(three)', function (data) {
                console.log(data.value);
                var category_id = data.value;
                $("#parent_id").val(category_id);
                if(category_id != ''){
                    $.ajax({
                        url: "{{url('admin/category/check')}}",
                        type: 'post',
                        data: {id:category_id},
                        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                        success:function(result){
                            console.log(result.status);
                            if(result.status =='1'){
                                $('#four_input').show();
                                var html = '';
                                $.ajax({
                                    url: "{{url('admin/category/category')}}",
                                    type: 'post',
                                    data: {id:category_id},
                                    headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                                    success:function(result){
                                        $("#four").html('');
                                        $("#four").append('<option value="">请选择</option>');
                                        $.each( result, function(index, content){
                                            html+= "<option value='" + content.id +"'>" + content.name +"</option>";
                                        });
                                        $("#four").append(html);
                                        form.render('select');
                                        toastr.info('请选择下一级!');
                                        return true;
                                    }
                                });
                            }
                        }
                    });
                };
            });

            form.on('select(four)', function (data) {
                var category_id = data.value;
                $("#parent_id").val(category_id);
                if(category_id != ''){
                    $.ajax({
                        url: "{{url('admin/category/check')}}",
                        type: 'post',
                        data: {id:category_id},
                        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                        success:function(result){
                            console.log(result.status);
                            if(result.status == '1'){
                                $('#five_input').show();
                                var html = '';
                                $.ajax({
                                    url: "{{url('admin/category/category')}}",
                                    type: 'post',
                                    data: {id:category_id},
                                    headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                                    success:function(result){
                                        $("#five").html('');
                                        $("#five").append('<option value="">请选择</option>');
                                        $.each( result, function(index, content){
                                            html+= "<option value='" + content.id +"'>" + content.name +"</option>";
                                        });
                                        $("#five").append(html);
                                        form.render('select');
                                        toastr.info('请选择下一级!');
                                        return true;
                                    }
                                });
                            }
                        }
                    });
                }
            });

            //监听提交
            form.on('submit(submit)', function(data) {
                loadShow();
                $.ajax({
                    url: "{{url('admin/category/update')}}",
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
                                        href: '{{url('admin/category')}}',
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