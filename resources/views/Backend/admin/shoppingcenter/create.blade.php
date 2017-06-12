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
            <legend>添加购物中心信息</legend>
        </fieldset>
        {{ Form::open(array('url' => 'admin/category/update', 'method' => 'POST','class'=>'layui-form',)) }}
        {!! csrf_field() !!}

        {{--<fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">--}}
            {{--<legend>卡片风格的Tab</legend>--}}
        {{--</fieldset>--}}

        <div class="layui-tab layui-tab-card">
            <ul class="layui-tab-title">
                <li class="layui-this">添加信息</li>
            </ul>
            <div class="layui-tab-content">
                <div class="layui-tab-item layui-show" style="height: 750px;">
                    <div class="layui-form-item" style="width: 300px;">
                        <label class="layui-form-label">项目名称</label>
                        <div class="layui-input-block">
                            <input type="text" name="project_name" autocomplete="off" placeholder="请输入名称" class="layui-input" value="">
                        </div>
                    </div>

                    <div class="layui-form-item" style="width: 300px;">
                        <label class="layui-form-label">开业时间</label>
                        <div class="layui-input-block">
                            <input type="text" name="opening_date" autocomplete="off" placeholder="请输入时间" class="layui-input" value="">
                        </div>
                    </div>

                    <div class="layui-form-item" style="width: 300px;">
                        <label class="layui-form-label">招商状态</label>
                        <div class="layui-input-block">
                            <input type="text" name="condition" autocomplete="off" placeholder="请输入状态" class="layui-input" value="">
                        </div>
                    </div>

                    <div class="layui-form-item" style="width: 300px;">
                        <label class="layui-form-label">商业面积（平方米）</label>
                        <div class="layui-input-block">
                            <input type="text" name="commercial_area" autocomplete="off" placeholder="请输入面积" class="layui-input" value="">
                        </div>
                    </div>

                    <div class="layui-form-item" style="width: 300px;">
                        <label class="layui-form-label">商业楼层</label>
                        <div class="layui-input-block">
                            <input type="text" name="commercial_floors" autocomplete="off" placeholder="请输入楼层" class="layui-input" value="">
                        </div>
                    </div>

                    <div class="layui-form-item" style="width: 300px;">
                        <label class="layui-form-label">项目地址</label>
                        <div class="layui-input-block">
                            <input type="text" name="project_adress" autocomplete="off" placeholder="请输入地址" class="layui-input" value="">
                        </div>
                    </div>

                    {{--<div class="layui-form-item" style="width: 300px;">--}}
                        {{--<label class="layui-form-label">项目图片</label>--}}
                        {{--<div class="layui-input-block">--}}
                            {{--<input type="text" name="project_photo" autocomplete="off" placeholder="请上传图片" class="layui-input" value="">--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    <div class="layui-form-item">
                        <label class="layui-form-label">项目图片</label>
                        <span target="layui-upload-iframe" method="post" key="set-mine" enctype="multipart/form-data" action="">
                            <input type="file" name="file" class="layui-upload-file">
                        </span>
                        <span id="image_upload_src1"></span>
                    </div>

                    <div class="layui-form-item" style="width: 300px;">
                        <label class="layui-form-label">项目地图</label>
                        <div class="layui-input-block">
                            <input type="text" name="project_mapping" autocomplete="off" placeholder="请输入地图" class="layui-input" value="">
                        </div>
                    </div>

                    <div class="layui-form-item" style="width: 300px;">
                        <label class="layui-form-label">已签约品牌</label>
                        <div class="layui-input-block">
                            <input type="text" name="contact_brand" autocomplete="off" placeholder="请输入品牌" class="layui-input" value="">
                        </div>
                    </div>

                    <div class="layui-form-item" style="width: 300px;">
                        <label class="layui-form-label">招商要求</label>
                        <div class="layui-input-block">
                            <input type="text" name="demand" autocomplete="off" placeholder="请输入需求" class="layui-input" value="">
                        </div>
                    </div>

                    {{--<div class="layui-form-item" style="width: 300px;">--}}
                        {{--<label class="layui-form-label">室内地图</label>--}}
                        {{--<div class="layui-input-block">--}}
                            {{--<input type="text" name="inner_map" autocomplete="off" placeholder="请上传图片" class="layui-input" value="">--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    <div class="layui-form-item">
                        <label class="layui-form-label">室内地图</label>
                        <span target="layui-upload-iframe" method="post" key="set-mine" enctype="multipart/form-data" action="">
                            <input type="file" name="file" class="layui-upload-file" id="xx">
                        </span>
                        <span id="image_upload_src2"></span>
                    </div>

                </div>

            </div>
        </div>


        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit="" lay-filter="submit">立即提交</button>
            </div>
        </div>
        {{--<input type="hidden" name="parent_id" id="parent_id" value="{{$parent_id}}" >--}}
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
                    $('#image_upload_src1').html('<img src="' + json.data.url + '" style="width:60px;height:60px;padding:2px;"><input type="hidden" name="image1" value="' + json.data.url + '"><button id="del1" type="button" class="btn btn-close"><i class="fa fa-close"></i></button>');
                    console.log(json); //上传成功返回值，必须为json格式
                    $('#del1').click(function(){
                            $('#image_upload_src1').empty();
                        }
                    );
                }
            });

            //upload
            layui.upload({
                elem:'#xx',
                url: "{{url('admin/uploads/image')}}",
                ext: 'jpg|png|gif|jpeg',
                before: function (input) {
                    console.log(input);
                    console.log('文件上传中');
                },
                success: function (json) {
                    $('#image_upload').val(json.data.fileId);
                    $('#image_upload_src2').html('<img src="' + json.data.url + '" style="width:60px;height:60px;padding:2px;"><input type="hidden" name="image2" value="' + json.data.url + '"><button id="del2" type="button" class="btn btn-close"><i class="fa fa-close"></i></button>');
                    console.log(json); //上传成功返回值，必须为json格式
                    $('#del2').click(function(){
                            $('#image_upload_src2').empty();
                        }
                    );
                }
            });


            //监听提交
            form.on('submit(submit)', function(data) {
//                alert(1);
//                loadShow();
                $.ajax({
                    url: "{{url('admin/shoppingcenter/store')}}",
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
                                        href: '{{url('admin/shoppingcenter')}}',
                                        target: '_self'
                                    });
                                    btn.find('.layui-layer-btn1').attr({
                                        href: '{{url('admin/shoppingcenter/create')}}',
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