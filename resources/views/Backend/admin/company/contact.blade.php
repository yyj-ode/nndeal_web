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
                <a href="{{url('admin/company/description/'.$result->id)}}"><li class="">企业详情</li></a>
                <a href="{{url('admin/company/contact/'.$result->id)}}"><li class="layui-this">联系方式</li></a>
                <a href="{{url('admin/company/'.$result->id.'/edit')}}"><li class="">商品管理</li></a>
                <a href="{{url('admin/company/'.$result->id.'/edit')}}"><li class="">订单管理</li></a>
            </ul>
        </div>
        <div class="layui-tab-item layui-show" style="height: 100px;">
            {{ Form::open(array('url' => 'admin/question/update', 'method' => 'POST','class'=>'layui-form','style'=>'height: 100px;')) }}
            <div class="layui-form-item">
                <label class="layui-form-label">来源</label>
                <div class="layui-input-block">
                    <input type="text" name="source" lay-verify="source" autocomplete="off" placeholder="请输入标题" class="layui-input" value="{{$result->source}}">
                </div>
            </div>

            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">联系人</label>
                    <div class="layui-input-block">
                        <input type="text" name="name" value="{{$result->name}}" lay-verify="" placeholder="请输入" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">公司座机</label>
                    <div class="layui-input-block">
                        <input type="text" name="phone" value="{{$result->phone}}" lay-verify="" placeholder="请输入" autocomplete="off" class="layui-input">
                    </div>
                </div>

                <div class="layui-inline">
                    <label class="layui-form-label">联系手机</label>
                    <div class="layui-input-block">
                        <input type="text" name="mobile" value="{{$result->mobile}}" lay-verify="" placeholder="请输入" autocomplete="off" class="layui-input">
                    </div>
                </div>
            </div>

            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">QQ 号</label>
                    <div class="layui-input-block">
                        <input type="text" name="qq" value="{{$result->qq}}" lay-verify="" placeholder="请输入" autocomplete="off" class="layui-input">
                    </div>
                </div>

                <div class="layui-inline">
                    <label class="layui-form-label">企业网站</label>
                    <div class="layui-input-block">
                        <input type="text" name="web" value="{{$result->web}}" lay-verify="" placeholder="请输入" autocomplete="off" class="layui-input">
                    </div>
                </div>

                <div class="layui-inline">
                    <label class="layui-form-label">传真号</label>
                    <div class="layui-input-block">
                        <input type="text" name="fax" value="{{$result->fax}}" lay-verify="" placeholder="请输入" autocomplete="off" class="layui-input">
                    </div>
                </div>
            </div>

            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">Email</label>
                    <div class="layui-input-block">
                        <input type="text" name="email" value="{{$result->email}}" lay-verify="" placeholder="请输入" autocomplete="off" class="layui-input">
                    </div>
                </div>

                <div class="layui-inline">
                    <label class="layui-form-label">邮编</label>
                    <div class="layui-input-block">
                        <input type="text" name="zipcode" value="{{$result->zipcode}}" lay-verify="" placeholder="请输入" autocomplete="off" class="layui-input">
                    </div>
                </div>
            </div>

            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">企业法人</label>
                    <div class="layui-input-block">
                        <input type="text" name="corporation" value="{{$result->corporation}}" lay-verify="" placeholder="请输入" autocomplete="off" class="layui-input">
                    </div>
                </div>

                <div class="layui-inline">
                    <label class="layui-form-label">注册资金</label>
                    <div class="layui-input-block">
                        <input type="text" name="capital" value="{{$result->capital}}" lay-verify="" placeholder="请输入" autocomplete="off" class="layui-input">
                    </div>
                </div>
            </div>


            <div class="layui-form-item">
                <label class="layui-form-label">有效期</label>
                <div class="layui-input-block">
                    <input type="text" name="validity" value="{{$result->validity}}" lay-verify="" placeholder="请输入" autocomplete="off" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">税务登记证</label>
                <div class="layui-input-block">
                    <input type="text" name="certificate" value="{{$result->certificate}}" lay-verify="" placeholder="请输入" autocomplete="off" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">组织机构代码证</label>
                <div class="layui-input-block">
                    <input type="text" name="institutional" value="{{$result->institutional}}" lay-verify="" placeholder="请输入" autocomplete="off" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">资质</label>
                <div class="layui-input-block">
                    <input type="text" name="aptitude_id" value="{{$result->aptitude_id}}" lay-verify="" placeholder="请输入" autocomplete="off" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">营业执照</label>
                <div class="layui-input-block">
                    <input type="text" name="licence_id" value="{{$result->licence_id}}" lay-verify="" placeholder="请输入" autocomplete="off" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">产品和服务</label>
                <div class="layui-input-block">
                    <input type="text" name="services" value="{{$result->services}}" lay-verify="" placeholder="请输入" autocomplete="off" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">公司类型</label>
                <div class="layui-input-block">
                    <input type="text" name="company_type" value="{{$result->company_type}}" lay-verify="" placeholder="请输入" autocomplete="off" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">公司营业执照号</label>
                <div class="layui-input-block">
                    <input type="text" name="company_code" value="{{$result->company_code}}" lay-verify="" placeholder="请输入" autocomplete="off" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">成立日期</label>
                    <div class="layui-input-block">
                        <input type="text" name="operation_startdate" id="created_at" value="{{$result->operation_startdate}}" placeholder="yyyy-mm-dd" autocomplete="off" class="layui-input" onclick="layui.laydate({elem: this})">
                    </div>
                </div>

                <div class="layui-inline">
                    <label class="layui-form-label">营业期限</label>
                    <div class="layui-input-block">
                        <input type="text" name="operation_enddate" id="updated_at" value="{{$result->operation_enddate}}" placeholder="yyyy-mm-dd" autocomplete="off" class="layui-input" onclick="layui.laydate({elem: this})">
                    </div>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">登记机关</label>
                <div class="layui-input-block">
                    <input type="text" name="authority" value="{{$result->authority}}" lay-verify="" placeholder="请输入" autocomplete="off" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">公司状态</label>
                <div class="layui-input-block">
                    <input type="text" name="company_status" value="{{$result->company_status}}" lay-verify="" placeholder="请输入" autocomplete="off" class="layui-input">
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

            //监听提交
            form.on('submit(submit)', function(data) {
                loadShow();
                $.ajax({
                    url: "{{url('admin/company/doContact')}}",
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