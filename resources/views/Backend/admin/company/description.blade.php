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
                <a href="{{url('admin/company/'.$result->id.'/edit')}}"><li class="">基本信息</li></a>
                <a href="{{url('admin/company/description/'.$result->id)}}"><li class="layui-this">企业详情</li></a>
                <a href="{{url('admin/company/contact/'.$result->id)}}"><li class="">联系方式</li></a>
                <a href="{{url('admin/company/'.$result->id.'/edit')}}"><li class="">商品管理</li></a>
                <a href="{{url('admin/company/'.$result->id.'/edit')}}"><li class="">订单管理</li></a>
            </ul>
        </div>
        <div class="layui-tab-item layui-show" style="height: 100px;">
            {{ Form::open(array('url' => 'admin/question/update', 'method' => 'POST','class'=>'layui-form','style'=>'height: 100px;')) }}
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">描述</label>
                <div class="layui-input-block">
                    <textarea class="layui-textarea layui-hide" name="description" lay-verify="required" id="description_editor">{{$result->description}}</textarea>
                </div>
            </div>

            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">生意</label>
                <div class="layui-input-block">
                    <textarea class="layui-textarea layui-hide" name="business" lay-verify="required" id="business_editor">{{$result->business}}</textarea>
                </div>
            </div>

            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit="" lay-filter="submit">立即提交</button>
                </div>
            </div>
            <input type="hidden" name="id" value="{{$result->id}}">
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
            var description_editor = layedit.build('description_editor');
            var business_editor = layedit.build('business_editor');
            //自定义验证规则
            form.verify({
                title: function(value) {
                    if(value.length < 5) {
                        return '标题至少得5个字符啊';
                    }
                },
                pass: [/(.+){6,12}$/, '密码必须6到12位'],
                content: function(value) {
                    layedit.sync(description_editor);
                    layedit.sync(business_editor);
                }
            });

            //监听提交
            form.on('submit(submit)', function(data) {
                loadShow();
                $.ajax({
                    url: "{{url('admin/company/doDescription')}}",
                    type: 'post',
                    data: {
                        id:data.field.id,
                        business:layedit.getContent(business_editor),
                        description:layedit.getContent(description_editor),
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