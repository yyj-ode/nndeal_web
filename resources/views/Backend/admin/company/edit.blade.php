@extends('Backend.admin.layouts.layui')

@section('seo')
    @include('Backend.admin.layouts.mainSeo')
@stop

@section('content')
    <div style="margin: 15px;">
        <blockquote class="layui-elem-quote">
            <a class="layui-btn layui-btn-small" href="{{url('admin/company')}}"><cite>全部企业</cite></a>
        </blockquote>
        <div class="layui-tab layui-tab-brief">
            <ul class="layui-tab-title">
                <a href="{{url('admin/company/'.$result->id.'/edit')}}"><li class="layui-this">基本信息</li></a>
                <a href="{{url('admin/company/description/'.$result->id)}}"><li class="">企业详情</li></a>
                <a href="{{url('admin/company/contact/'.$result->id)}}"><li class="">联系方式</li></a>
                <a href="{{url('admin/company/'.$result->id.'/edit')}}"><li class="">商品管理</li></a>
                <a href="{{url('admin/company/'.$result->id.'/edit')}}"><li class="">订单管理</li></a>
            </ul>
        </div>
        <div class="layui-tab-item layui-show" style="height: 100px;">
            {{ Form::open(array('url' => 'admin/question/update', 'method' => 'POST','class'=>'layui-form','style'=>'height: 100px;')) }}
            <div class="layui-form-item">
                <label class="layui-form-label">标题</label>
                <div class="layui-input-block">
                    <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="请输入标题" class="layui-input" value="{{$result->title}}">
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
                    <input type="text" name="keywords" value="@if(isset($result->keywords)){{$result->keywords}}@else{{$result->title}}@endif" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">摘要</label>
                <div class="layui-input-block">
                    <textarea placeholder="请输入内容" class="layui-textarea" name="summary">{{$result->summary}}</textarea>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">办公地址</label>
                <div class="layui-input-block">
                    <input type="text" name="office" lay-verify="office" autocomplete="off" placeholder="请输入标题" class="layui-input" value="{{$result->office}}">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">注册地址</label>
                <div class="layui-input-block">
                    <input type="text" name="address" lay-verify="address" autocomplete="off" placeholder="请输入标题" class="layui-input" value="{{$result->address}}">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">地区</label>
                <div class="layui-input-inline">
                    <select name="province" class="select" lay-filter="province">
                        <option value="">请选择</option>
                        @foreach($area as $key=>$value)
                            <option value="{{$value->id}}">{{$value->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="layui-input-inline" style="display: none;" id="city_input">
                    <select name="city"  class="select" lay-filter="city" id="city">
                        <option value="">请选择</option>
                    </select>
                </div>
                <div class="layui-input-inline" style="display: none;" id="county_input">
                    <select name="county" class="select" lay-filter="county" id="county">
                        <option value="">请选择</option>
                    </select>
                </div>
                @if(isset($result->county->name))
                    <div class="layui-input-inline" id="five_input" style="display: block;">
                        <a href="javascript:;" class="layui-btn site-demo-layim" data-type="message">
                            {!! $result->county->name !!}
                        </a>
                    </div>
                @endif
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">修改地区</label>
                <div class="layui-input-block">
                    <input type="radio" name="check_area" value="1" title="是" >
                    <input type="radio" name="check_area" value="0" title="否" checked="">
                </div>
            </div>

            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">权重</label>
                    <div class="layui-input-inline">
                        <input type="number" name="weight" lay-verify="number" autocomplete="off" class="layui-input" value="{{$result->weight}}" >
                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">添加时间</label>
                    <div class="layui-input-block">
                        <input type="text" name="created_at" id="created_at" value="{{$result->created_at}}" placeholder="yyyy-mm-dd" autocomplete="off" class="layui-input" onclick="layui.laydate({elem: this})">
                    </div>
                </div>

                <div class="layui-inline">
                    <label class="layui-form-label">更新时间</label>
                    <div class="layui-input-block">
                        <input type="text" name="updated_at" id="updated_at" value="{{$result->updated_at}}" placeholder="yyyy-mm-dd" autocomplete="off" class="layui-input" onclick="layui.laydate({elem: this})">
                    </div>
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
                    <input type="radio" name="display" value="1" title="显示" @if($result->display=='1') checked="" @endif>
                    <input type="radio" name="display" value="0" title="不显示" @if(empty($result->display)) checked="" @endif>
                </div>
            </div>

            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit="" lay-filter="submit">立即提交</button>
                </div>
            </div>
            <input type="hidden" name="id" value="{{$result->id}}">
            <input type="hidden" name="category_id" id="category_id" value="{{$result->category_id}}" >
            {!! csrf_field() !!}
            {{ Form::close() }}
        </div>
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
                    if(value.length < 5) {
                        return '标题至少得5个字符啊';
                    }
                },
                pass: [/(.+){6,12}$/, '密码必须6到12位'],
                content: function(value) {
                    layedit.sync(editIndex);
                }
            });

            form.on('select(one)', function (data) {
                var category_id = data.value;
                $("#category_id").val(category_id);
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
                $("#category_id").val(category_id);
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
                $("#category_id").val(category_id);
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
                $("#category_id").val(category_id);
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

            form.on('select(province)', function (data) {
                var category_id = data.value;
                if(category_id != ''){
                    var html = '';
                    $.ajax({
                        url: "{{url('admin/area/category')}}",
                        type: 'post',
                        data: {id:category_id},
                        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                        success:function(result){
                            $('#city_input').show();
                            $("#city").html('');
                            $("#city").append('<option value="">请选择</option>');
                            $.each( result, function(index, content){
                                html+= "<option value='" + content.id +"'>" + content.name +"</option>";
                            });
                            $("#city").append(html);
                            form.render('select');
                            toastr.info('请选择下一级!');
                        }
                    });
                }
            });
            form.on('select(city)', function (data) {
                var category_id = data.value;
                if(category_id != ''){
                    var html = '';
                    $.ajax({
                        url: "{{url('admin/area/category')}}",
                        type: 'post',
                        data: {id:category_id},
                        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                        success:function(result){
                            $('#county_input').show();
                            $("#county").html('');
                            $("#county").append('<option value="">请选择</option>');
                            $.each( result, function(index, content){
                                html+= "<option value='" + content.id +"'>" + content.name +"</option>";
                            });
                            $("#county").append(html);
                            form.render('select');
                            toastr.info('请选择下一级!');
                        }
                    });
                }
            });

            //监听提交
            form.on('submit(submit)', function(data) {
                loadShow();
                $.ajax({
                    url: "{{url('admin/company/update')}}",
                    type: 'post',
                    data:  {
                        title:data.field.title,
                        check_category:data.field.check_category,
                        keywords:data.field.keywords,
                        summary:data.field.summary,
                        province:data.field.province,
                        city:data.field.city,
                        county:data.field.county,
                        check_area:data.field.check_area,
                        weight:data.field.weight,
                        status:data.field.status,
                        display:data.field.display,
                        category_id:data.field.category_id,
                        id:data.field.id,
                    },
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
                                        href: '{{url('admin/company/index')}}',
                                        target: '_self'
                                    });
                                    layer.close(index); //如果设定了yes回调，需进行手工关闭
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