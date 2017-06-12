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
            <legend>添加周边店铺</legend>
        </fieldset>
        {{ Form::open(array('url' => 'admin/category/update', 'method' => 'POST','class'=>'layui-form',)) }}
        {!! csrf_field() !!}

        {{--<fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">--}}
            {{--<legend>卡片风格的Tab</legend>--}}
        {{--</fieldset>--}}

        <div class="layui-tab layui-tab-card">
            <ul class="layui-tab-title">
                <li class="layui-this">周边店铺信息</li>
            </ul>
            <div class="layui-tab-content">
                <div class="layui-tab-item layui-show" style="height: 400px;">
                    <div class="layui-form-item">
                        <label class="layui-form-label">商圈</label>
                        <div class="layui-input-inline">
                            <select name="province" class="one select" lay-filter="one" lay-verify="required">
                                <option value="">请选择</option>
                                @foreach($area as $key=>$value)
                                    <option value="{{$value->id}}" @if($value->id == $result->province) selected="" @endif>{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="layui-input-inline"  @if( !($result->city))style="display: none;" @endif id="tow_input">
                            <select name="city"  class="tow select" lay-filter="tow" id="tow">
                                <option value="">请选择</option>
                                @foreach($city as $key=>$value)
                                    <option value="{{$value->id}}" @if($value->id == $result->city) selected="" @endif>{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="layui-input-inline" @if( !($result->county))style="display: none;" @endif id="three_input">
                            <select name="county" class="three select" lay-filter="three" id="three">
                                <option value="">请选择</option>
                                @foreach($county as $key=>$value)
                                    <option value="{{$value->id}}" @if($value->id == $result->county) selected="" @endif>{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="layui-form-item" style="width: 300px;">
                        <label class="layui-form-label">地址</label>
                        <div class="layui-input-block">
                            <input type="text" name="address" autocomplete="off" placeholder="请输入地址" class="layui-input" value="{{$result['address']}}">
                        </div>
                    </div>

                    {{--<div class="layui-form-item" style="width: 300px;">--}}
                        {{--<label class="layui-form-label">经营品类</label>--}}
                        {{--<div class="layui-input-block">--}}
                            {{--<input type="text" name="categories" autocomplete="off" placeholder="请输入品类" class="layui-input" value="{{$result['categories']}}">--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    <div class="layui-form-item">
                        <label class="layui-form-label">经营品类</label>
                        <div class="layui-input-inline">
                            <select name="categories" class="" lay-filter="" lay-verify="required">
                                <option value="">请选择</option>
                                @foreach($format as $key=>$value)
                                    <option value="{{$value->id}}" @if($value->id == $result->categories) selected="" @endif>{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="layui-form-item" style="width: 300px;">
                        <label class="layui-form-label">客单价(元)</label>
                        <div class="layui-input-block">
                            <input type="text" name="price" autocomplete="off" placeholder="请输入单价" class="layui-input" value="{{$result['price']}}">
                        </div>
                    </div>

                    <div class="layui-form-item" style="width: 300px;">
                        <label class="layui-form-label">经度</label>
                        <div class="layui-input-block">
                            <input type="text" name="longitude" autocomplete="off" placeholder="请输入经度" class="layui-input" value="{{$result['longitude']}}">
                        </div>
                    </div>

                    <div class="layui-form-item" style="width: 300px;">
                        <label class="layui-form-label">纬度</label>
                        <div class="layui-input-block">
                            <input type="text" name="latitude" autocomplete="off" placeholder="请输入纬度" class="layui-input" value="{{$result['latitude']}}">
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
        <input type="hidden" name="_id" value="{{$result['_id']}}" >
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
                var category_id = data.value;
                $("#category_id").val(category_id);
                console.log(category_id);
                if(category_id != ''){
                    var html = '';
                    $.ajax({
                        url: "{{url('admin/shopsurrounding/check')}}",
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
                        url: "{{url('admin/shopsurrounding/check')}}",
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
                    url: "{{url('admin/shopsurrounding/doupdate')}}",
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
                                        href: '{{url('admin/shopsurrounding')}}',
                                        target: '_self'
                                    });
                                    btn.find('.layui-layer-btn1').attr({
                                        href: '{{url("admin/shopsurrounding/update?_id=$result[_id]")}}',
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

        layui.use('element', function(){
            var $ = layui.jquery
                ,element = layui.element(); //Tab的切换功能，切换事件监听等，需要依赖element模块

            //触发事件
            var active = {
                tabAdd: function(){
                    //新增一个Tab项
                    element.tabAdd('demo', {
                        title: '新选项'+ (Math.random()*1000|0) //用于演示
                        ,content: '内容'+ (Math.random()*1000|0)
                        ,id: new Date().getTime() //实际使用一般是规定好的id，这里以时间戳模拟下
                    })
                }
                ,tabDelete: function(othis){
                    //删除指定Tab项
                    element.tabDelete('demo', '44'); //删除：“商品管理”


                    othis.addClass('layui-btn-disabled');
                }
                ,tabChange: function(){
                    //切换到指定Tab项
                    element.tabChange('demo', '22'); //切换到：用户管理
                }
            };

            $('.site-demo-active').on('click', function(){
                var othis = $(this), type = othis.data('type');
                active[type] ? active[type].call(this, othis) : '';
            });

            //Hash地址的定位
            var layid = location.hash.replace(/^#test=/, '');
            element.tabChange('test', layid);

            element.on('tab(test)', function(elem){
                location.hash = 'test='+ $(this).attr('lay-id');
            });

        });
    </script>
@stop