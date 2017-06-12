<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="nav-close"><i class="fa fa-times-circle"></i>
    </div>
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                        <span><img alt="image" class="img-circle" src="http://www.zi-han.net/theme/hplus/img/profile_small.jpg"/></span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                            <span class="block m-t-xs"><strong class="font-bold">Beaut-zihan</strong></span>
                            <span class="text-muted text-xs block">超级管理员<b class="caret"></b></span>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a class="J_menuItem" href="form_avatar.html">修改头像</a></li>
                        <li><a class="J_menuItem" href="profile.html">个人资料</a></li>
                        <li><a class="J_menuItem" href="contacts.html">联系我们</a></li>
                        <li><a class="J_menuItem" href="mailbox.html">信箱</a></li>
                        <li class="divider"></li>
                        <li><a href="{{url('admin/logout')}}">安全退出</a></li>
                    </ul>
                </div>
                <div class="logo-element">MH</div>
            </li>
            @foreach($comData['top'] as $value)
                <li>
                    <a href="#">
                        <i class="fa {{ $value['icon'] }}"></i> <span class="nav-label">{{$value['display_name']}} </span><span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        @foreach($comData[$value['id']] as $item)
                            <li><a class="J_menuItem" href="{{URL::route($item['name'])}}">{{$item['display_name']}}</a></li>
                        @endforeach
                    </ul>
                </li>
            @endforeach

            <li>
                <a href="#">
                    <i class="fa fa-home"></i>
                    <span class="nav-label">问答管理</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a class="J_menuItem" href="{{url('admin/question/index')}}" data-index="0">全部问题</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="index_v2.html">已解决问题</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="index_v3.html">待解决问题</a>
                    </li>
                    <li>
                        <a href="index_v5.html" target="_blank">推荐问题</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="index_v4.html">已删除</a>
                    </li>
                </ul>

            </li>
            {{--<li>--}}
                {{--<a class="J_menuItem" href="layouts.html"><i class="fa fa-columns"></i> <span class="nav-label">布局</span></a>--}}
            {{--</li>--}}
            <li>
                <a href="#">
                    <i class="fa fa fa-bar-chart-o"></i>
                    <span class="nav-label">问答分类管理</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a class="J_menuItem" href="graph_echarts.html">全部分类</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="graph_flot.html">Flot</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="graph_morris.html">Morris.js</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="graph_rickshaw.html">Rickshaw</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="graph_peity.html">Peity</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="graph_sparkline.html">Sparkline</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="graph_metrics.html">图表组合</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="mailbox.html"><i class="fa fa-envelope"></i> <span class="nav-label">用户管理 </span><span
                            class="label label-warning pull-right">16</span></a>
                <ul class="nav nav-second-level">
                    <li><a class="J_menuItem" href="mailbox.html">全部用户</a>
                    </li>
                    <li><a class="J_menuItem" href="mail_detail.html">医生用户</a>
                    </li>
                    <li><a class="J_menuItem" href="mail_compose.html">普通用户</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">疾病管理</span><span
                            class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a class="J_menuItem" href="form_basic.html">基本表单</a>
                    </li>
                    <li><a class="J_menuItem" href="form_validate.html">表单验证</a>
                    </li>
                    <li><a class="J_menuItem" href="form_advanced.html">高级插件</a>
                    </li>
                    <li><a class="J_menuItem" href="form_wizard.html">表单向导</a>
                    </li>
                    <li>
                        <a href="#">文件上传 <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li><a class="J_menuItem" href="form_webuploader.html">百度WebUploader</a>
                            </li>
                            <li><a class="J_menuItem" href="form_file_upload.html">DropzoneJS</a>
                            </li>
                            <li><a class="J_menuItem" href="form_avatar.html">头像裁剪上传</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">编辑器 <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li><a class="J_menuItem" href="form_editors.html">富文本编辑器</a>
                            </li>
                            <li><a class="J_menuItem" href="form_simditor.html">simditor</a>
                            </li>
                            <li><a class="J_menuItem" href="form_markdown.html">MarkDown编辑器</a>
                            </li>
                            <li><a class="J_menuItem" href="code_editor.html">代码编辑器</a>
                            </li>
                        </ul>
                    </li>
                    <li><a class="J_menuItem" href="suggest.html">搜索自动补全</a>
                    </li>
                    <li><a class="J_menuItem" href="layerdate.html">日期选择器layerDate</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-desktop"></i> <span class="nav-label">页面</span><span
                            class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a class="J_menuItem" href="contacts.html">联系人</a>
                    </li>
                    <li><a class="J_menuItem" href="profile.html">个人资料</a>
                    </li>
                    <li>
                        <a href="#">项目管理 <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li><a class="J_menuItem" href="projects.html">项目</a>
                            </li>
                            <li><a class="J_menuItem" href="project_detail.html">项目详情</a>
                            </li>
                        </ul>
                    </li>
                    <li><a class="J_menuItem" href="teams_board.html">团队管理</a>
                    </li>
                    <li><a class="J_menuItem" href="social_feed.html">信息流</a>
                    </li>
                    <li><a class="J_menuItem" href="clients.html">客户管理</a>
                    </li>
                    <li><a class="J_menuItem" href="file_manager.html">文件管理器</a>
                    </li>
                    <li><a class="J_menuItem" href="calendar.html">日历</a>
                    </li>
                    <li>
                        <a href="#">博客 <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li><a class="J_menuItem" href="blog.html">文章列表</a>
                            </li>
                            <li><a class="J_menuItem" href="article.html">文章详情</a>
                            </li>
                        </ul>
                    </li>
                    <li><a class="J_menuItem" href="faq.html">FAQ</a>
                    </li>
                    <li>
                        <a href="#">时间轴 <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li><a class="J_menuItem" href="timeline.html">时间轴</a>
                            </li>
                            <li><a class="J_menuItem" href="timeline_v2.html">时间轴v2</a>
                            </li>
                        </ul>
                    </li>
                    <li><a class="J_menuItem" href="pin_board.html">标签墙</a>
                    </li>
                    <li>
                        <a href="#">单据 <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li><a class="J_menuItem" href="invoice.html">单据</a>
                            </li>
                            <li><a class="J_menuItem" href="invoice_print.html">单据打印</a>
                            </li>
                        </ul>
                    </li>
                    <li><a class="J_menuItem" href="search_results.html">搜索结果</a>
                    </li>
                    <li><a class="J_menuItem" href="forum_main.html">论坛</a>
                    </li>
                    <li>
                        <a href="#">即时通讯 <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li><a class="J_menuItem" href="chat_view.html">聊天窗口</a>
                            </li>
                            <li><a class="J_menuItem" href="webim.html">layIM</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">登录注册相关 <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li><a href="login.html" target="_blank">登录页面</a>
                            </li>
                            <li><a href="login_v2.html" target="_blank">登录页面v2</a>
                            </li>
                            <li><a href="register.html" target="_blank">注册页面</a>
                            </li>
                            <li><a href="lockscreen.html" target="_blank">登录超时</a>
                            </li>
                        </ul>
                    </li>
                    <li><a class="J_menuItem" href="404.html">404页面</a>
                    </li>
                    <li><a class="J_menuItem" href="500.html">500页面</a>
                    </li>
                    <li><a class="J_menuItem" href="empty_page.html">空白页</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-flask"></i> <span class="nav-label">UI元素</span><span
                            class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a class="J_menuItem" href="typography.html">排版</a>
                    </li>
                    <li>
                        <a href="#">字体图标 <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a class="J_menuItem" href="fontawesome.html">Font Awesome</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="glyphicons.html">Glyphicon</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="iconfont.html">阿里巴巴矢量图标库</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">拖动排序 <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li><a class="J_menuItem" href="draggable_panels.html">拖动面板</a>
                            </li>
                            <li><a class="J_menuItem" href="agile_board.html">任务清单</a>
                            </li>
                        </ul>
                    </li>
                    <li><a class="J_menuItem" href="buttons.html">按钮</a>
                    </li>
                    <li><a class="J_menuItem" href="tabs_panels.html">选项卡 &amp; 面板</a>
                    </li>
                    <li><a class="J_menuItem" href="notifications.html">通知 &amp; 提示</a>
                    </li>
                    <li><a class="J_menuItem" href="badges_labels.html">徽章，标签，进度条</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="grid_options.html">栅格</a>
                    </li>
                    <li><a class="J_menuItem" href="plyr.html">视频、音频</a>
                    </li>
                    <li>
                        <a href="#">弹框插件 <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li><a class="J_menuItem" href="layer.html">Web弹层组件layer</a>
                            </li>
                            <li><a class="J_menuItem" href="modal_window.html">模态窗口</a>
                            </li>
                            <li><a class="J_menuItem" href="sweetalert.html">SweetAlert</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">树形视图 <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li><a class="J_menuItem" href="jstree.html">jsTree</a>
                            </li>
                            <li><a class="J_menuItem" href="tree_view.html">Bootstrap Tree View</a>
                            </li>
                            <li><a class="J_menuItem" href="nestable_list.html">nestable</a>
                            </li>
                        </ul>
                    </li>
                    <li><a class="J_menuItem" href="toastr_notifications.html">Toastr通知</a>
                    </li>
                    <li><a class="J_menuItem" href="diff.html">文本对比</a>
                    </li>
                    <li><a class="J_menuItem" href="spinners.html">加载动画</a>
                    </li>
                    <li><a class="J_menuItem" href="widgets.html">小部件</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-table"></i> <span class="nav-label">表格</span><span
                            class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a class="J_menuItem" href="table_basic.html">基本表格</a>
                    </li>
                    <li><a class="J_menuItem" href="table_data_tables.html">DataTables</a>
                    </li>
                    <li><a class="J_menuItem" href="table_jqgrid.html">jqGrid</a>
                    </li>
                    <li><a class="J_menuItem" href="table_foo_table.html">Foo Tables</a>
                    </li>
                    <li><a class="J_menuItem" href="table_bootstrap.html">Bootstrap Table
                            <span class="label label-danger pull-right">推荐</span></a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-picture-o"></i> <span class="nav-label">相册</span><span
                            class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a class="J_menuItem" href="basic_gallery.html">基本图库</a>
                    </li>
                    <li><a class="J_menuItem" href="carousel.html">图片切换</a>
                    </li>
                    <li><a class="J_menuItem" href="blueimp.html">Blueimp相册</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="J_menuItem" href="css_animation.html"><i class="fa fa-magic"></i> <span class="nav-label">CSS动画</span></a>
            </li>
            <li>
                <a href="#"><i class="fa fa-cutlery"></i> <span class="nav-label">工具 </span><span
                            class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a class="J_menuItem" href="form_builder.html">表单构建器</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>