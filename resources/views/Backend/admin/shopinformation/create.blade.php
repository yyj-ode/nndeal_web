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
            <legend>添加店铺信息 (基本条件、工程条件、租赁信息)</legend>
        </fieldset>
        {{ Form::open(array('url' => 'admin/category/update', 'method' => 'POST','class'=>'layui-form',)) }}
        {!! csrf_field() !!}

        {{--<fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">--}}
            {{--<legend>卡片风格的Tab</legend>--}}
        {{--</fieldset>--}}

        <div class="layui-tab layui-tab-card">
            <ul class="layui-tab-title">
                <li class="layui-this">基本条件</li>
                <li>工程条件</li>
                <li>租赁信息</li>
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

                    <div class="layui-form-item">
                        <label class="layui-form-label">所在区域</label>
                        <div class="layui-input-inline">
                            <select name="province" class="one select" lay-filter="one" lay-verify="required">
                                <option value="">请选择</option>
                                @foreach($area as $key=>$value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="layui-input-inline" style="display: none;" id="tow_input">
                            <select name="city"  class="tow select" lay-filter="tow" id="tow">
                                <option value="">请选择</option>
                            </select>
                        </div>
                        <div class="layui-input-inline" style="display: none;" id="three_input">
                            <select name="county" class="three select" lay-filter="three" id="three">
                                <option value="">请选择</option>
                            </select>
                        </div>
                    </div>

                    <div class="layui-form-item" style="width: 300px;">
                        <label class="layui-form-label">店铺地址</label>
                        <div class="layui-input-block">
                            <input type="text" name="adress" autocomplete="off" placeholder="请输入地址" class="layui-input" value="">
                        </div>
                    </div>

                    <div class="layui-form-item" style="width: 400px;">
                        <label class="layui-form-label">房屋区域</label>
                        <div class="layui-input-inline">
                            <select name="building_category">
                                <option value="">请选择</option>
                                <option value="百货中心">百货中心</option>
                                <option value="购物中心">购物中心</option>
                            </select>
                        </div>
                    </div>

                    <div class="layui-form-item" style="width: 300px;">
                        <label class="layui-form-label">所在楼层</label>
                        <div class="layui-input-block">
                            <input type="text" name="floor_level" autocomplete="off" placeholder="请输入楼层" class="layui-input" value="">
                        </div>
                    </div>

                    <div class="layui-form-item" style="width: 300px;">
                        <label class="layui-form-label">建筑面积(㎡)</label>
                        <div class="layui-input-block">
                            <input type="text" name="area" autocomplete="off" placeholder="请输入面积" class="layui-input" value="">
                        </div>
                    </div>

                    <div class="layui-form-item" style="width: 300px;">
                        <label class="layui-form-label">层高(米)</label>
                        <div class="layui-input-block">
                            <input type="text" name="floor_height" autocomplete="off" placeholder="请输入层高" class="layui-input" value="">
                        </div>
                    </div>

                    <div class="layui-form-item" style="width: 300px;">
                        <label class="layui-form-label">门头宽度(米)</label>
                        <div class="layui-input-block">
                            <input type="text" name="door_width" autocomplete="off" placeholder="请输入门宽" class="layui-input" value="">
                        </div>
                    </div>

                    <div class="layui-form-item" style="width: 300px;">
                        <label class="layui-form-label">进深(米)</label>
                        <div class="layui-input-block">
                            <input type="text" name="depth" autocomplete="off" placeholder="请输入进深" class="layui-input" value="">
                        </div>
                    </div>

                    <div class="layui-form-item" style="width: 400px;">
                        <label class="layui-form-label">房屋现状</label>
                        <div class="layui-input-inline">
                            <select name="current_status">
                                <option value="">请选择</option>
                                <option value="租赁中">租赁中</option>
                            </select>
                        </div>
                    </div>

                    <div class="layui-form-item" style="width: 400px;">
                        <label class="layui-form-label">证照</label>
                        <div class="layui-input-inline">
                            <select name="license">
                                <option value="">请选择</option>
                                <option value="有照可过户">有照可过户</option>
                                <option value="无照可过户">无照可过户</option>
                            </select>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button class="layui-btn" lay-submit="" lay-filter="submit">立即提交</button>
                        </div>
                    </div>

                </div>

                <div class="layui-tab-item" style="height: 400px;">

                    <div class="layui-form-item" style="width: 400px;">
                        <label class="layui-form-label">上下水</label>
                        <div class="layui-input-inline">
                            <select name="water_supply_and_drainage">
                                <option value="">请选择</option>
                                <option value="有">有</option>
                                <option value="无">无</option>
                            </select>
                        </div>
                    </div>

                    <div class="layui-form-item" style="width: 400px;">
                        <label class="layui-form-label">动力电</label>
                        <div class="layui-input-inline">
                            <select name="electricity">
                                <option value="">请选择</option>
                                <option value="有">有</option>
                                <option value="无">无</option>
                            </select>
                        </div>
                    </div>

                    <div class="layui-form-item" style="width: 400px;">
                        <label class="layui-form-label">煤气管道</label>
                        <div class="layui-input-inline">
                            <select name="gas_tube">
                                <option value="">请选择</option>
                                <option value="有">有</option>
                                <option value="无">无</option>
                            </select>
                        </div>
                    </div>

                    <div class="layui-form-item" style="width: 400px;">
                        <label class="layui-form-label">烟管道</label>
                        <div class="layui-input-inline">
                            <select name="smoke_tube">
                                <option value="">请选择</option>
                                <option value="有">有</option>
                                <option value="无">无</option>
                            </select>
                        </div>
                    </div>

                    <div class="layui-form-item" style="width: 400px;">
                        <label class="layui-form-label">排污管道</label>
                        <div class="layui-input-inline">
                            <select name="sewage">
                                <option value="">请选择</option>
                                <option value="有">有</option>
                                <option value="无">无</option>
                            </select>
                        </div>
                    </div>

                    <div class="layui-form-item" style="width: 400px;">
                        <label class="layui-form-label">可明火</label>
                        <div class="layui-input-inline">
                            <select name="flame">
                                <option value="">请选择</option>
                                <option value="有">有</option>
                                <option value="无">无</option>
                            </select>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button class="layui-btn" lay-submit="" lay-filter="submit">立即提交</button>
                        </div>
                    </div>
                </div>

                <div class="layui-tab-item">

                    <div class="layui-form-item" style="width: 300px;">
                        <label class="layui-form-label">租赁年限(月)</label>
                        <div class="layui-input-block">
                            <input type="text" name="leasing_duration" autocomplete="off" placeholder="请输入年限" class="layui-input" value="">
                        </div>

                    </div>

                    <div class="layui-form-item" style="width: 300px;">
                        <label class="layui-form-label">付款方式</label>
                        <div class="layui-input-block">
                            <input type="text" name="payment_type" autocomplete="off" placeholder="请输入付款方式" class="layui-input" value="">
                        </div>
                    </div>

                    <div class="layui-form-item" style="width: 300px;">
                        <label class="layui-form-label">转让费</label>
                        <div class="layui-input-block">
                            <input type="text" name="leasing_payment" autocomplete="off" placeholder="请输入转让费" class="layui-input" value="">
                        </div>
                    </div>

                    <div class="layui-form-item" style="width: 300px;">
                        <label class="layui-form-label">租金单价(万元/月)</label>
                        <div class="layui-input-block">
                            <input type="text" name="rent" autocomplete="off" placeholder="请输入月租" class="layui-input" value="">
                        </div>
                    </div>

                    <div class="layui-form-item" style="width: 300px;">
                        <label class="layui-form-label">租金递增幅度</label>
                        <div class="layui-input-block">
                            <input type="text" name="progressive_rate" autocomplete="off" placeholder="请输入递增幅度" class="layui-input" value="">
                        </div>
                    </div>

                    {{--<div class="layui-form-item" style="width: 300px;">--}}
                        {{--<label class="layui-form-label">照片</label>--}}
                        {{--<div class="layui-input-block">--}}
                            {{--<input type="text" name="photo" autocomplete="off" placeholder="请上传照片" class="layui-input" value="">--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    <div class="layui-form-item">
                        <label class="layui-form-label">照片</label>
                            <span target="layui-upload-iframe" method="post" key="set-mine" enctype="multipart/form-data" action="">
                                <input type="file" name="file" class="layui-upload-file">
                            </span>
                        <span id="image_upload_src"></span>
                    </div>

                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button class="layui-btn" lay-submit="" lay-filter="submit">立即提交</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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

            //创建一个编辑器
            var editIndex = layedit.build('LAY_demo_editor');
            //自定义验证规则
            form.verify({
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
                    $('#image_upload_src').html('<img src="' + json.data.url + '" style="width:60px;height:60px;padding:2px;"><input type="hidden" name="image" value="' + json.data.url + '"><button id="del" type="button" class="btn btn-close"><i class="fa fa-close"></i></button>');
                    console.log(json); //上传成功返回值，必须为json格式
                    $('#del').click(function(){
                            $('#image_upload_src').empty();
                        }
                    );
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
                        url: "{{url('admin/shopinformation/check')}}",
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
                        url: "{{url('admin/shopinformation/check')}}",
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
                    url: "{{url('admin/shopinformation/store')}}",
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
                                        href: '{{url('admin/shopinformation')}}',
                                        target: '_self'
                                    });
                                    btn.find('.layui-layer-btn1').attr({
                                        href: '{{url('admin/shopinformation/create')}}',
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