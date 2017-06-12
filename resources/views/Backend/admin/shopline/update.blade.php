@extends('Backend.admin.layouts.layui')

@section('seo')
    @include('Backend.admin.layouts.mainSeo')
@stop

@section('content')
    <div style="margin: 15px;">
        <blockquote class="layui-elem-quote">
            <a class="layui-btn layui-btn-small" href="javascript:history.back();"><cite>返回</cite></a>
        </blockquote>
        <div class="layui-tab layui-tab-brief">
            <ul class="layui-tab-title">
                <a href="{{url('admin/shopline/update?_id='.$result->_id)}}"><li class="layui-this">店铺基本信息</li></a >
                <a href="{{url('admin/shopline/stream?_id='.$result->_id)}}"><li class="">客户人流信息</li></a >
            </ul>
        </div>
        {{ Form::open(array('url' => 'admin/Shopline/store', 'method' => 'POST','class'=>'layui-form',)) }}
        {!! csrf_field() !!}
        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">房主姓名</label>
                <div class="layui-input-inline">
                    <input type="text" name="owner_name" value="{{$result->owner_name}}" lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-inline">
                <label class="layui-form-label">房主电话</label>
                <div class="layui-input-inline">
                    <input type="text" name="owner_tel" lay-verify="tel" value="{{$result->owner_tel}}" autocomplete="off" class="layui-input">
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">所在区域</label>
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
        <div class="layui-form-item">
            <label class="layui-form-label">商铺位置</label>
            <div class="layui-input-block">
                <input type="text" name="location" v- lay-verify="required" autocomplete="off" placeholder="" class="layui-input" value="{{$result->location}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">商铺类型</label>
            <div class="layui-input-inline">
                <select name="business_type" lay-verify="required" lay-search="">
                    @foreach($business_type as $k=>$v)
                        <option value="{{$v['id']}}" @if($v['id'] == $result->business_type) selected="" @endif >{{$v['name']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">建筑面积（m2）</label>
                <div class="layui-input-inline">
                    <input type="text" name="total_area" value="{{$result->total_area}}" lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-inline">
                <label class="layui-form-label">使用面积（m2)</label>
                <div class="layui-input-inline">
                    <input type="text" name="useage_area" value="{{$result->useage_area}}" lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">所在楼层</label>
                <div class="layui-input-inline">
                    <input type="text" name="floor_level" value="{{$result->floor_level}}" lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-inline">
                <label class="layui-form-label">门头宽度（米）</label>
                <div class="layui-input-inline">
                    <input type="text" name="width" value="{{$result->width}}" lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>

        </div>
        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">层高（米）</label>
                <div class="layui-input-inline">
                    <input type="text" name="floor_height" value="{{$result->floor_height}}" lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-inline">
                <label class="layui-form-label">进深（米）</label>
                <div class="layui-input-inline">
                    <input type="text" name="depth" value="{{$result->depth}}" lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>
        </div>
        {{--<div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">租赁状态</label>
                <div class="layui-input-block">
                    <input type="radio" name="status" @if($result->status == '已出租') checked="" @endif value="已出租" title="已出租">
                    <input type="radio" name="status" value="未出租" @if($result->status == '未出租') checked="" @endif title="未出租">
                </div>
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">租赁类型</label>
                <div class="layui-input-block">
                    <input type="radio" name="leasing_type" value="融资租赁" title="融资租赁" @if($result->leasing_type == '融资租赁') checked="" @endif>
                    <input type="radio" name="leasing_type" value="经营租赁" title="经营租赁" @if($result->leasing_type == '经营租赁') checked="" @endif>
                    <input type="radio" name="leasing_type" value="正式租赁" title="正式租赁" @if($result->leasing_type == '正式租赁') checked="" @endif>
                </div>
            </div>
        </div>--}}
        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">租赁状态</label>
                <div class="layui-input-inline">
                    <input type="text" name="status" value="{{$result->status}}" lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-inline">
                <label class="layui-form-label">租赁类型</label>
                <div class="layui-input-inline">
                    <input type="text" name="leasing_type" value="{{$result->leasing_type}}" lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">月租金（元／月）</label>
                <div class="layui-input-inline">
                    <input type="text" name="rent" value="{{$result->rent}}" lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-inline">
                <label class="layui-form-label">租金递增</label>
                <div class="layui-input-inline">
                    <input type="text" name="progressive_rate" value="{{$result->progressive_rate}}" lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">支付方式</label>
                <div class="layui-input-inline">
                    <input type="text" name="payment_type" value="{{$result->payment_type}}" lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-inline">
                <label class="layui-form-label">押金（月房租）</label>
                <div class="layui-input-inline">
                    <input type="text" name="deposit" value="{{$result->deposit}}" lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">当前租约（年）</label>
                <div class="layui-input-inline">
                    <input type="text" name="current_duration" value="{{$result->current_duration}}" lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-inline">
                <label class="layui-form-label">剩余租约（月）</label>
                <div class="layui-input-inline">
                    <input type="text" name="remian_duration" value="{{$result->remian_duration}}" lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">最长可租约（个月）</label>
                <div class="layui-input-inline">
                    <input type="text" name="max_duration" value="{{$result->max_duration}}" lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-inline">
                <label class="layui-form-label">续约情况</label>
                <div class="layui-input-inline">
                    <input type="text" name="contact_status" value="{{$result->contact_status}}" lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            {{--<div class="layui-inline">
                <label class="layui-form-label">房屋图片</label>
                <div class="layui-input-inline">
                    <input type="text" name="photo" value="{{$result->photo}}" lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>--}}
            <div class="layui-inline">
                <label class="layui-form-label">经度</label>
                <div class="layui-input-inline">
                    <input type="text" name="longitude" value="{{$result->longitude}}" lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-inline">
                <label class="layui-form-label">纬度</label>
                <div class="layui-input-inline">
                    <input type="text" name="latitude" value="{{$result->latitude}}" lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">房屋图片</label>
            <span target="layui-upload-iframe" method="post" key="set-mine" enctype="multipart/form-data" action="">
                <input type="file" name="file" class="layui-upload-file">
            </span>
            <span id="image_upload_src">
                @if($result->photo)
                <img src="{{$result->photo}}" style="width:60px;height:60px;padding:2px;"><input type="hidden" name="image" value="{{$result->photo}}"><button type="button" id="del" class="btn btn-close"><i class="fa fa-close"></i></button>
                @endif
            </span>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit="" lay-filter="submit">立即提交</button>
            </div>
        </div>
        <input type="hidden" value="{{$result->_id}}" name="_id">
        {{ Form::close() }}
    </div>
@stop

@section('js')
    <script type="text/javascript">
        $('#del').click(function(){
            $('#image_upload_src').empty();
            }
        );
        layui.use(['form', 'layedit', 'laydate','upload'], function() {
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
                }
            });

            form.on('select(one)', function (data) {
                var category_id = data.value;
                $("#category_id").val(category_id);
                console.log(category_id);
                if(category_id != ''){
                    var html = '';
                    $.ajax({
                        url: "{{url('admin/shopline/check')}}",
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
                        url: "{{url('admin/shopline/check')}}",
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
                    url: "{{url('admin/shopline/update_save')}}",
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
                                content: '<div style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">'+result.message+'<br><br>我们此后的征途是星辰大海 ^_^<br></div>',
                                success: function(layero){
                                    var btn = layero.find('.layui-layer-btn');
                                    btn.css('text-align', 'center');
                                    btn.find('.layui-layer-btn0').attr({
                                        href: '{{url('admin/shopline/index')}}',
                                        target: '_self'
                                    });
                                    btn.find('.layui-layer-btn1').attr({
                                        href: "{{url('admin/shopline/update/?_id='.$result->_id)}}",
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
                                content: '<div style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">'+result.message+'<br></div>',
                                success: function(layero){
                                    var btn = layero.find('.layui-layer-btn');
                                    btn.css('text-align', 'center');
                                    btn.find('.layui-layer-btn0').attr({
                                        href: '{{url('admin/shopline/index')}}',
                                        target: '_self'
                                    });
                                    btn.find('.layui-layer-btn1').attr({
                                        href: "{{url('admin/shopline/update/?_id='.$result->_id)}}",
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