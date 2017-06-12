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
                <a href="{{url('admin/shopline/update?_id='.$result->_id)}}"><li >店铺基本信息</li></a >
                <a href="{{url('admin/shopline/stream?_id='.$result->_id)}}"><li class="layui-this">客户人流信息</li></a >
            </ul>
        </div>
        {{ Form::open(array('url' => 'admin/Shopline/store', 'method' => 'POST','class'=>'layui-form',)) }}
        {!! csrf_field() !!}
        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">客单价（元）</label>
                <div class="layui-input-inline">
                    <input type="text" name="pct" value="{{$result->pct}}" lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-inline">
                <label class="layui-form-label">堂食量（人）</label>
                <div class="layui-input-inline">
                    <input type="text" name="eat_here" lay-verify="required" value="{{$result->eat_here}}" autocomplete="off" class="layui-input">
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">外卖量（份）</label>
                <div class="layui-input-inline">
                    <input type="text" name="takeout" value="{{$result->takeout}}" lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-inline">
                <label class="layui-form-label">营业额（元）</label>
                <div class="layui-input-inline">
                    <input type="text" name="revenue" lay-verify="required" value="{{$result->revenue}}" autocomplete="off" class="layui-input">
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">消费人群</label>
                <div class="layui-input-inline">
                    <input type="text" name="customer_type" value="{{$result->customer_type}}" lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-inline">
                <label class="layui-form-label">最旺时段</label>
                <div class="layui-input-inline">
                    <input type="text" name="busy_time" lay-verify="required" value="{{$result->busy_time}}" autocomplete="off" class="layui-input">
                </div>
            </div>
        </div>
        <div class="layui-form-item" pane="">
            <label class="layui-form-label">可经营业态</label>
            <div class="layui-input-block">
                @foreach($format as $k=>$v)
                <input type="checkbox" name="{{$k}}" value="1" lay-skin="primary" title="{{$v}}" @if($result->$k == 1) checked="" @endif >
                @endforeach
            </div>
        </div>
        <div class="layui-form-item" pane="">
            <label class="layui-form-label">可经营业态</label>
            <div class="layui-input-block">
                @foreach($engineering as $k=>$v)
                    <input type="checkbox" name="{{$k}}" lay-skin="primary" value="1" title="{{$v}}" @if($result->$k == 1) checked="" @endif>
                @endforeach
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">本店优势</label>
            <div class="layui-input-block">
                <input type="text" name="advantage" lay-verify="required" autocomplete="off" placeholder="" class="layui-input" value="{{$result->advantage}}">
            </div>
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

            //监听提交
            form.on('submit(submit)', function(data) {
                var text = layedit.getText(editIndex);
                data['field']['description'] = text;
                loadShow();
                $.ajax({
                    url: "{{url('admin/shopline/stream_save')}}",
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
                                        href: "{{url('admin/shopline/stream_save/?_id='.$result->_id)}}",
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
                                        href: "{{url('admin/shopline/stream_save/?_id='.$result->_id)}}",
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