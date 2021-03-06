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
            <legend>添加小区信息</legend>
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

                    <div class="layui-form-item" style="width: 300px;">
                        <label class="layui-form-label">小区名称</label>
                        <div class="layui-input-block">
                            <input type="text" name="community_name" autocomplete="off" placeholder="请输入名称" class="layui-input" value="{{$result['community_name']}}">
                        </div>
                    </div>

                    <div class="layui-form-item" style="width: 300px;">
                        <label class="layui-form-label">小区地址</label>
                        <div class="layui-input-block">
                            <input type="text" name="community_adress" autocomplete="off" placeholder="请输入地址" class="layui-input" value="{{$result['community_adress']}}">
                        </div>
                    </div>

                    <div class="layui-form-item" style="width: 300px;">
                        <label class="layui-form-label">建筑年代</label>
                        <div class="layui-input-block">
                            <input type="text" name="building_age" autocomplete="off" placeholder="请输入年代" class="layui-input" value="{{$result['building_age']}}">
                        </div>
                    </div>

                    <div class="layui-form-item" style="width: 400px;">
                        <label class="layui-form-label">建筑类型</label>
                        <div class="layui-input-inline">
                            <select name="building_category">
                                <option value="">请选择</option>
                                <option <?php if($result['building_category'] == '板楼') {
                                    echo "selected = 'selected'";
                                }?> value="板楼">板楼</option>
                                <option <?php if($result['building_category'] == '塔楼') {
                                    echo "selected = 'selected'";
                                }?> value="塔楼">塔楼</option>
                                <option <?php if($result['building_category'] == '板塔结合') {
                                    echo "selected = 'selected'";
                                }?> value="板塔结合">板塔结合</option>
                                <option <?php if($result['building_category'] == '平房') {
                                    echo "selected = 'selected'";
                                }?> value="平房">平房</option>
                            </select>
                        </div>
                    </div>

                    <div class="layui-form-item" style="width: 300px;">
                        <label class="layui-form-label">物业费</label>
                        <div class="layui-input-block">
                            <input type="text" name="property_management_fee" autocomplete="off" placeholder="请输入费用" class="layui-input" value="{{$result['property_management_fee']}}">
                        </div>
                    </div>

                    <div class="layui-form-item" style="width: 300px;">
                        <label class="layui-form-label">物业公司</label>
                        <div class="layui-input-block">
                            <input type="text" name="property_management_company" autocomplete="off" placeholder="请输入公司名" class="layui-input" value="{{$result['property_management_company']}}">
                        </div>
                    </div>

                    <div class="layui-form-item" style="width: 300px;">
                        <label class="layui-form-label">开发商</label>
                        <div class="layui-input-block">
                            <input type="text" name="developer" autocomplete="off" placeholder="请输入开发商名称" class="layui-input" value="{{$result['developer']}}">
                        </div>
                    </div>

                    <div class="layui-form-item" style="width: 300px;">
                        <label class="layui-form-label">楼栋总数(栋)</label>
                        <div class="layui-input-block">
                            <input type="text" name="total_building_number" autocomplete="off" placeholder="请输入楼栋总数" class="layui-input" value="{{$result['total_building_number']}}">
                        </div>
                    </div>

                    <div class="layui-form-item" style="width: 300px;">
                        <label class="layui-form-label">房屋总数(户)</label>
                        <div class="layui-input-block">
                            <input type="text" name="total_apartment_number" autocomplete="off" placeholder="请输入房屋总数" class="layui-input" value="{{$result['total_apartment_number']}}">
                        </div>
                    </div>

                    <div class="layui-form-item" style="width: 300px;">
                        <label class="layui-form-label">小区售房价(元/㎡)</label>
                        <div class="layui-input-block">
                            <input type="text" name="price" autocomplete="off" placeholder="请输入房价" class="layui-input" value="{{$result['price']}}">
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
        <input type="hidden" name="_id" value="{{$_id}}" >
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

            //监听提交
            form.on('submit(submit)', function(data) {
//                alert(1);
//                loadShow();
                $.ajax({
                    url: "{{url('admin/village/doupdate')}}",
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
                                        href: '{{url('admin/village')}}',
                                        target: '_self'
                                    });
                                    btn.find('.layui-layer-btn1').attr({
                                        href: '{{url('admin/village/create')}}',
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