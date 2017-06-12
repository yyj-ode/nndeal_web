@extends('Backend.admin.layouts.layui')

@section('seo')
    @include('Backend.admin.layouts.mainSeo')
@stop

@section('content')

    <blockquote class="layui-elem-quote">
        <a class="layui-btn layui-btn-small" href="{{url('admin/company')}}"><cite>全部问题</cite></a>

        <a href="{{url('admin/permission/create')}}" class="layui-btn layui-btn-small" id="add">
            <i class="layui-icon">&#xe608;</i> 添加信息
        </a>
        <a href="#" class="layui-btn layui-btn-small">
            <i class="layui-icon">&#xe608;</i> 导入信息
        </a>
        <a href="#" class="layui-btn layui-btn-small">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i> 导出信息
        </a>
        <a href="javascript:;" class="layui-btn layui-btn-small" id="search">
            <i class="layui-icon">&#xe615;</i> 搜索
        </a>
    </blockquote>

    <fieldset class="layui-elem-field">
        <legend>数据列表</legend>
        <div class="no-footer layui-field-box">
            <table id="contents" class="site-table table-hover" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th data-sortable="true">ID</th>
                    <th data-sortable="false">标题</th>
                    <th class="sorting">分类</th>
                    <th class="sorting">用户</th>
                    <th class="sorting">用户</th>
                    <th data-sortable="false">浏览量</th>
                    <th data-sortable="false">点赞量</th>
                    <th class="sorting">添加时间</th>
                    <th class="sorting">更新时间</th>
                    <th data-sortable="false">操作</th>
                </tr>
                </thead>
            </table>
        </div>
    </fieldset>
@stop

@section('js')
    <script src="{{asset('plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/media/js/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        layui.use(['icheck', 'laypage'], function () {
            var $ = layui.jquery,
                    laypage = layui.laypage,
                    layer = parent.layer === undefined ? layui.layer : parent.layer;
            $('input').iCheck({
                checkboxClass: 'icheckbox_flat-green'
            });

            //page
            laypage({
                cont: 'page',
                pages: 25, //总页数
                groups: 5 ,//连续显示分页数
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

                $.extend(true, $.fn.DataTable.defaults, {
                    "dom": "l<'#toolbar'>frtip"
                });

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
                        url: "{{url('admin/company/indexdata')}}",
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                        data: {
                            status: 6,
                        }
                    },
                    columns: [
                        {"data": "id"},
                        {"data": "title"},
                        {"data": "category_id"},
                        {"data": "province"},
                        {"data": "city"},
                        {"data": "county"},
                        {"data": "count", render: $.fn.DataTable.render.number(',', '.', 0, '$')},
                        {"data": "created_at"},
                        {"data": "updated_at"},
                        {"data": "action"}
                    ],
                    columnDefs: [
                        {
                            targets: 0,
                            data: null,
                            title: "ID",
                            render: function (data, type, row, meta) {
                                return "<a href='/company/s" + row.id + ".html' target='_blank'>" + row.id + "</a>"
                            }
                        },
                        {
                            targets: 1,
                            data: null,
                            title: "标题",
                            render: function (data, type, row, meta) {
                                return "<a href='/company/s" + row.id + ".html' target='_blank'>" + row.title + "</a>"
                            }
                        },
                        {
                            targets: 2,
                            data: null,
                            title: "分类",
                            render: function (data, type, row, meta) {
                                return "<a href='/company/c" + row.category_id + "s6p1.html' target='_blank'>" + row.category_name + "</a>"
                            }
                        },
                        {
                            'targets': -1, "render": function (data, type, row) {
                            var html = '<a style="margin:3px;" href="/admin/company/' + row['id'] + '/edit" class="X-Small btn-xs text-success "><i class="linyer icon-edit"></i></a>';
                            html += '<a style="margin:3px;" href="#" attr="' + row['id'] + '" class="delBtn X-Small btn-xs text-danger"><i class="linyer icon-qiyong"></i></a>';
                            html += '<a style="margin:3px;" href="/admin/company/' + row['id'] + '/edit"><i class="linyer icon-xgpwd2"></i></a>';
                            html += '<a style="margin:3px;" href="/admin/company/' + row['id'] + '/edit"><i class="linyer icon-delect"></i></a>';
                            return html;
                        }
                        }
                    ],
                    initComplete:function(){
                        $("#toolbar").append('<a href="javascript:;" class="layui-btn layui-btn-small" id="search" style="margin-left: 10px;"><i class="layui-icon">&#xe608;&nbsp;</i>搜索</a>');
                    }
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
    </script>
@stop