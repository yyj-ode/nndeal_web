
@extends('Backend.admin.layouts.layui')

@section('seo')
    @include('Backend.admin.layouts.mainSeo')
@stop

@section('content')

    <blockquote class="layui-elem-quote">
        {{--<a class="layui-btn layui-btn-small" href="{{url('admin/inspect')}}"><cite>全部分类</cite></a>

        <a href="{{url('admin/inspect/create')}}" class="layui-btn layui-btn-small" id="add">
            <i class="layui-icon">&#xe608;</i> 添加分类
        </a>--}}
    </blockquote>

    <fieldset class="layui-elem-field">
        <legend>数据列表</legend>
        <div class="no-footer layui-field-box">
            <table id="contents" class="site-table table-hover" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th data-sortable="true">ID</th>
                    <th data-sortable="false">姓名</th>
                    <th data-sortable="false">类型</th>
                    <th data-sortable="false">品牌名称</th>
                    <th class="sorting">价格</th>
                    <th class="sorting">电话</th>
                    <th class="sorting">邮箱</th>
                    <th class="sorting">来源</th>
                    <th class="sorting">时间</th>
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
                        url: "{{url('admin/inspect/indexdata')}}",
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
                        {"data": "name"},
                        {"data": "category_id"},
                        {"data": "first_name"},
                        {"data": "unit_price"},
                        {"data": "mobile"},
                        {"data": "email"},
                        {"data": "type"},
                        {"data": "created_at"},

                    ],
                    columnDefs: [

                        {
                            targets: 0,
                            data: null,
                            title: "ID",
                            render: function (data, type, row, meta) {
                                return "<a href='/question/c" + row.id + "s6p1.html' target='_blank'>" + row.id + "</a>"
                            }
                        },
                        {
                            targets: 1,
                            data: null,
                            title: "姓名",
                            render: function (data, type, row, meta) {
                                return "<a href='/question/c" + row.id + "s6p1.html' target='_blank'>" + row.name + "</a>"
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
    </script>
@stop