
@extends('Backend.admin.layouts.layui')

@section('seo')
    @include('Backend.admin.layouts.mainSeo')
@stop

@section('content')

    <blockquote class="layui-elem-quote">
        <a class="layui-btn layui-btn-small" href="{{url('admin/admin')}}"><cite>全部用户</cite></a>

       {{-- <a href="{{url('admin/admin/create')}}" class="layui-btn layui-btn-small" id="add">
            <i class="layui-icon">&#xe608;</i> 添加用户
        </a>--}}
    </blockquote>

    <fieldset class="layui-elem-field">
        <legend>数据列表</legend>
        <div class="no-footer layui-field-box">
            <table id="contents" class="site-table table-hover" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th data-sortable="true">ID</th>
                    <th data-sortable="false">账号</th>
                    <th data-sortable="false">姓名</th>
                    <th data-sortable="false">电话</th>
                    <th class="sorting">时间</th>
                    <th data-sortable="false">操作</th>
                </tr>
                </thead>
            </table>
        </div>
    </fieldset>

    <form class="layui-form" action="" style="display: none" id="layui-form-data">
        <div class="layui-form-item">
            <label class="layui-form-label">输入框</label>
            <div class="layui-input-block">
                <input type="text" name="title" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">密码框</label>
            <div class="layui-input-inline">
                <input type="password" name="password" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">辅助文字</div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">选择框</label>
            <div class="layui-input-block">
                <select name="city" lay-verify="required">
                    <option value=""></option>
                    <option value="0">北京</option>
                    <option value="1">上海</option>
                    <option value="2">广州</option>
                    <option value="3">深圳</option>
                    <option value="4">杭州</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">复选框</label>
            <div class="layui-input-block">
                <input type="checkbox" name="like[write]" title="写作">
                <input type="checkbox" name="like[read]" title="阅读" checked>
                <input type="checkbox" name="like[dai]" title="发呆">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">开关</label>
            <div class="layui-input-block">
                <input type="checkbox" name="switch" lay-skin="switch">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">单选框</label>
            <div class="layui-input-block">
                <input type="radio" name="sex" value="男" title="男">
                <input type="radio" name="sex" value="女" title="女" checked>
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">文本域</label>
            <div class="layui-input-block">
                <textarea name="desc" placeholder="请输入内容" class="layui-textarea"></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
@stop

@section('js')
    <script src="{{asset('plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/media/js/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        layui.use(['icheck', 'laypage','layedit'], function () {
            var $ = layui.jquery,
                laypage = layui.laypage,
                layedit = layui.layedit,
                layer = parent.layer === undefined ? layui.layer : parent.layer;

            $('input').iCheck({
                checkboxClass: 'icheckbox_flat-green'
            });

            layedit.set({
                uploadImage: {
                    url: "{{url('admin/uploads/articleimg')}}", //接口url
                    type: 'post' //默认post
                }
            });

            //page
            laypage({
                cont: 'page',
                pages: 25 //总页数
                ,
                groups: 5 //连续显示分页数
                ,
                jump: function (obj, first) {
                    //得到了当前页，用于向服务端请求对应数据
                    var curr = obj.curr;
                    if (!first) {
                        //layer.msg('第 '+ obj.curr +' 页');
                    }
                }
            });

            $('#search').on('click', function () {
                parent.layer.alert('你点击了搜索按钮')
            });





            $('#add').on('click', function () {
                $.get('temp/edit-form.html', null, function (form) {
                    layer.open({
                        type: 1,
                        title: '添加表单',
                        content: form,
                        btn: ['保存', '取消'],
                        area: ['600px', '400px'],
                        maxmin: true,
                        yes: function (index) {
                            console.log(index);
                        },
                        full: function (elem) {
                            var win = window.top === window.self ? window : parent.window;
                            $(win).on('resize', function () {
                                var $this = $(this);
                                elem.width($this.width()).height($this.height()).css({
                                    top: 0,
                                    left: 0
                                });
                                elem.children('div.layui-layer-content').height($this.height() - 95);
                            });
                        }
                    });
                });
            });

            $('.site-table tbody tr').on('click', function (event) {
                var $this = $(this);
                var $input = $this.children('td').eq(0).find('input');
                $input.on('ifChecked', function (e) {
                    $this.css('background-color', '#EEEEEE');
                });
                $input.on('ifUnchecked', function (e) {
                    $this.removeAttr('style');
                });
                $input.iCheck('toggle');
            }).find('input').each(function () {
                var $this = $(this);
                $this.on('ifChecked', function (e) {
                    $this.parents('tr').css('background-color', '#EEEEEE');
                });
                $this.on('ifUnchecked', function (e) {
                    $this.parents('tr').removeAttr('style');
                });
            });
            $('#selected-all').on('ifChanged', function (event) {
                var $input = $('.site-table tbody tr td').find('input');
                $input.iCheck(event.currentTarget.checked ? 'check' : 'uncheck');
            });


        });


        layui.use(['jquery', 'form', 'layedit', 'laydate'], function () {
            $(function () {
                var contents = $("#contents").DataTable({
                    language: {
                        "sProcessing": "处理中...",
                        "sLengthMenu": "显示 _MENU_ 项结果",
                        "sZeroRecords": "没有匹配结果",
                        "sInfo": "显示第 _START_ 至 _END_ 项结果，共 _TOTAL_ 项",
                        "sInfoEmpty": "显示第 0 至 0 项结果，共 0 项",
                        "sInfoFiltered": "(由 _MAX_ 项结果过滤)",
                        "sInfoPostFix": "",
                        "sSearch": "搜索:",
                        "sUrl": "",
                        "sEmptyTable": "表中数据为空",
                        "sLoadingRecords": "载入中...",
                        "sInfoThousands": ",",
                        "oPaginate": {
                            "sFirst": "首页",
                            "sPrevious": "上页",
                            "sNext": "下页",
                            "sLast": "末页"
                        },
                        "oAria": {
                            "sSortAscending": ": 以升序排列此列",
                            "sSortDescending": ": 以降序排列此列"
                        }
                    },
                    stateSave: true,
                    processing: true,
                    serverSide: true,
                    autoFill: true,
                    order: [[0, "desc"]],
                    ajax: {
                        url: "{{url('admin/user/indexdata')}}",
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                        data: {
                            parent_id: '{{$parent_id}}',
                        }
                    },
                    columns: [
                        {"data": "id"},
                        {"data": "account"},
                        {"data": "name"},
                        {"data": "tel"},
                        {"data": "created_at"},
                        {"data": "common"}
                    ],
                    columnDefs: [
                        {
                            'targets': -1, "render": function (data, type, row) {
                          /*  var html = '<a style="margin:3px;" href="/admin/user/update?id=' + row.id + '" class="X-Small btn-xs text-danger" title="修改"><i class="linyer icon-edit"></i></a>';*/
                        var html = '<a style="margin:3px;" href="/admin/user/edit?id=' + row.id + '" title="重置密码"><i class="linyer icon-xgpwd2"></i></a>';
                            html += '<a onclick="del('+row.id+')" style="margin:3px;"><i class="linyer icon-delect"></i></a>';
                            /* html += '<a   style="margin:3px;" href="/admin/admin/del?id=' + row.id + '"><i class="linyer icon-delect"></i></a>';*/
                            return html;
                        }
                        }
                    ],
                });

                contents.on('preXhr.dt', function () {
                    loadShow();
                });

                contents.on('draw.dt', function () {
                    loadFadeOut();
                });

                contents.on('order.dt search.dt', function () {
                    contents.column(0, {search: 'id', order: 'id'}).nodes().each(function (cell, i) {
//                        cell.innerHTML = i + 1;
                    });
                }).draw();

                $("table").delegate('.delBtn', 'click', function () {
                    var id = $(this).attr('attr');

                    alert(id);
                });
            });
        });
        function del(id) {
            layer.open({
                type: 1
                ,title: false //不显示标题栏
                ,closeBtn: false
                ,area: '300px;'
                ,shade: 0.8
                ,id: 'LAY_layuipro' //设定一个id，防止重复弹出
                ,resize: false
                ,btn: ['确认', '取消']
                ,btnAlign: 'c'
                ,moveType: 1 //拖拽模式，0或者1
                ,content: '<div style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">确认删除吗?</div>'
                ,success: function(layero){
                    var btn = layero.find('.layui-layer-btn');
                    btn.find('.layui-layer-btn0').attr({
                        href: '{{url('admin/user/del/?id=')}}'+id,
                    });
                }
            });

        }

        function update(){
            layer.open({
                type: 1
                ,title: false //不显示标题栏
                ,closeBtn: false
                ,area: '600px;'
                ,shade: 0.8
                ,id: 'LAY_layuipro' //设定一个id，防止重复弹出
                ,resize: false
                ,btn: ['火速围观', '残忍拒绝']
                ,btnAlign: 'c'
                ,moveType: 1 //拖拽模式，0或者1
                ,content: $("#layui-form-data")
                ,success: function(layero){
                    var btn = layero.find('.layui-layer-btn');
                    btn.find('.layui-layer-btn0').attr({
                        href: 'http://www.layui.com/'
                        ,target: '_blank'
                    });
                }
            });
        }
    </script>
@stop