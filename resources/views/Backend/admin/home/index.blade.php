<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>NNDeal 后台管理</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <!-- load css -->
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/layui/css/layui.css')}}" media="all">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/global.css')}}" media="all">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/font-awesome/css/font-awesome.min.css')}}" media="all">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/adminstyle.css')}}" media="all">
</head>
<body>
<div class="layui-layout layui-layout-admin" id="layui_layout">
    <!-- 左侧侧边导航开始 -->
    <div class="layui-side layui-side-bg layui-larry-side" id="larry-side">
        <div class="layui-side-scroll" id="larry-nav-side" lay-filter="side">
            <div class="user-photo">
                <a class="img" title="我的头像" ><img src="{{asset('admin/imgs/common/user.jpg')}}" class="userimg1"></a>
                <p>你好！admin, 欢迎登录&nbsp;|&nbsp;<a href="{{url('admin/logout')}}" style="color:#fff;">退出</a></p>
            </div>
            <!-- 左侧菜单 -->
            <ul class="layui-nav layui-nav-tree">
                <!-- <li class="layui-nav-item layui-nav-title"><a>管理菜单</a></li> -->
                <li class="layui-nav-item layui-this">
                    <a href="javascript:;" data-url="{{asset('admin/log-viewer')}}">
                        <i class="layui-icon" data-icon='icon-home1' style="font-size: 15px;font-weight: bold;">&#xe62a;</i>
                        <span>后台首页</span>
                    </a>
                </li>
                <!-- 个人信息 -->
                <!--
                <li class="layui-nav-item">
                    <a href="javascript:;">
                        <i class="layui-icon" style="font-size: 15px;font-weight: bold;">&#xe609;</i>
                        <span>企业管理</span>
                        <em class="layui-nav-more"></em>
                    </a>
                    <dl class="layui-nav-child">
                        <dd>
                            <a href="javascript:;" data-url="{{url('admin/company')}}">
                                <i class="layui-icon" data-icon='icon-geren1' style="font-size: 15px;font-weight: bold;">&#xe617;</i>
                                <span>所有企业</span>
                            </a>
                        </dd>
                        <dd>
                            <a href="javascript:;" data-url="changepwd.html">
                                <i class="layui-icon" data-icon='icon-iconfuzhi01' style="font-size: 15px;font-weight: bold;">&#xe64f;</i>
                                <span>修改密码</span>
                            </a>
                        </dd>
                        <dd>
                            <a href="javascript:;" data-url="myloginfo.html">
                                <i class="layui-icon" data-icon='icon-piliangicon' style="font-size: 15px;font-weight: bold;">&#xe61c;</i>
                                <span>日志信息</span>
                            </a>
                        </dd>
                    </dl>
                </li>
                -->
                <!-- 分类管理 -->
                @foreach($menu as $k=>$v)
                <li class="layui-nav-item">
                    <a href="javascript:;">
                        <i class="layui-icon"  style="font-size: 15px;font-weight: bold;">&#xe60a;</i>
                        <span>{{$v['catalog']['name']}}</span>
                        <em class="layui-nav-more"></em>
                    </a>
                    @if($v['catalog']['parent_id'])
                        @foreach($v['catalog']['parent_id'] as $kk=>$vv)
                    <dl class="layui-nav-child">
                        <dd>
                            <a href="javascript:;" data-url='{{url("/".$vv['prefix']."/".$vv['controllers']."/".$vv['action'])}}'>
                                <i class="layui-icon" data-icon='icon-lanmuguanli' style="font-size: 15px;font-weight: bold;">&#xe60a;</i>
                                <span>{{$vv['catalog']['name']}}</span>
                            </a>
                        </dd>
                    </dl>
                        @endforeach
                    @endif
                </li>
                @endforeach





               {{-- <li class="layui-nav-item">
                    <a href="javascript:;">
                        <i class="layui-icon"  style="font-size: 15px;font-weight: bold;">&#xe60a;</i>
                        <span>分类管理</span>
                        <em class="layui-nav-more"></em>
                    </a>
                    <dl class="layui-nav-child">
                        <dd>
                            <a href="javascript:;" data-url="{{url('admin/catalog/index')}}">
                                <i class="layui-icon" data-icon='icon-lanmuguanli' style="font-size: 15px;font-weight: bold;">&#xe60a;</i>
                                <span>目录管理</span>
                            </a>
                        </dd>
                        <dd>
                            <a href="javascript:;" data-url="{{url('admin/category/index')}}">
                                <i class="layui-icon" data-icon='icon-lanmuguanli' style="font-size: 15px;font-weight: bold;">&#xe60a;</i>
                                <span>分类管理</span>
                            </a>
                        </dd>

                        <dd>
                            <a href="javascript:;" data-url="{{url('admin/inspect/index')}}">
                                <i class="layui-icon" data-icon='icon-lanmuguanli' style="font-size: 15px;font-weight: bold;">&#xe60a;</i>
                                <span>项目管理</span>
                            </a>
                        </dd>

                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a href="javascript:;">
                        <i class="layui-icon"  style="font-size: 15px;font-weight: bold;">&#xe60a;</i>
                        <span>用户管理</span>
                        <em class="layui-nav-more"></em>
                    </a>
                    <dl class="layui-nav-child">
                        <dd>
                            <a href="javascript:;" data-url="{{url('admin/admin/index')}}">
                                <i class="layui-icon" data-icon='icon-lanmuguanli' style="font-size: 15px;font-weight: bold;">&#xe60a;</i>
                                <span>后台账号</span>
                            </a>
                        </dd>
                    </dl>
                    <dl class="layui-nav-child">
                        <dd>
                            <a href="javascript:;" data-url="{{url('admin/account/index')}}">
                                <i class="layui-icon" data-icon='icon-lanmuguanli' style="font-size: 15px;font-weight: bold;">&#xe60a;</i>
                                <span>用户信息</span>
                            </a>
                        </dd>
                    </dl>
                    <dl class="layui-nav-child">
                        <dd>
                            <a href="javascript:;" data-url="{{url('admin/order/index')}}">
                                <i class="layui-icon" data-icon='icon-lanmuguanli' style="font-size: 15px;font-weight: bold;">&#xe60a;</i>
                                <span>订单管理</span>
                            </a>
                        </dd>
                    </dl>
                    <dl class="layui-nav-child">
                        <dd>
                            <a href="javascript:;" data-url="{{url('admin/roles/index')}}">
                                <i class="layui-icon" data-icon='icon-lanmuguanli' style="font-size: 15px;font-weight: bold;">&#xe60a;</i>
                                <span>身份管理</span>
                            </a>
                        </dd>
                    </dl>
                    <dl class="layui-nav-child">
                        <dd>
                            <a href="javascript:;" data-url="{{url('admin/permissions/index')}}">
                                <i class="layui-icon" data-icon='icon-lanmuguanli' style="font-size: 15px;font-weight: bold;">&#xe60a;</i>
                                <span>权限管理</span>
                            </a>
                        </dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a href="javascript:;">
                        <i class="layui-icon"  style="font-size: 15px;font-weight: bold;">&#xe60a;</i>
                        <span>微信管理</span>
                        <em class="layui-nav-more"></em>
                    </a>
                    <dl class="layui-nav-child">
                        <dd>
                            <a href="javascript:;" data-url="{{url('admin/wechatMenu/index')}}">
                                <i class="layui-icon" data-icon='icon-lanmuguanli' style="font-size: 15px;font-weight: bold;">&#xe60a;</i>
                                <span>微信菜单</span>
                            </a>
                        </dd>
                    </dl>
                </li>--}}
                {{--<li class="layui-nav-item">
                    <a href="javascript:;">
                        <i class="layui-icon"  style="font-size: 15px;font-weight: bold;">&#xe60a;</i>
                        <span>权限管理</span>
                        <em class="layui-nav-more"></em>
                    </a>
                    <dl class="layui-nav-child">
                        <dd>
                            <a href="javascript:;" data-url="{{url('admin/admin/index')}}">
                                <i class="layui-icon" data-icon='icon-lanmuguanli' style="font-size: 15px;font-weight: bold;">&#xe60a;</i>
                                <span>用户信息</span>
                            </a>
                        </dd>
                    </dl>
                </li>--}}


                <!-- 分类管理 -->
                <!--
                <li class="layui-nav-item">
                    <a href="javascript:;">
                        <i class="layui-icon"  style="font-size: 15px;font-weight: bold;">&#xe64c;</i>
                        <span>友情链接</span>
                        <em class="layui-nav-more"></em>
                    </a>
                    <dl class="layui-nav-child">
                        <dd>
                            <a href="javascript:;" data-url="{{url('admin/friendship')}}">
                                <i class="layui-icon" data-icon='icon-lanmuguanli' style="font-size: 15px;font-weight: bold;">&#xe64c;</i>
                                <span>友情链接</span>
                            </a>
                        </dd>
                        <dd>
                            <a href="javascript:;" data-url="{{url('admin/friendshipsort')}}">
                                <i class="layui-icon" data-icon='icon-lanmuguanli' style="font-size: 15px;font-weight: bold;">&#xe60a;</i>
                                <span>友情分类</span>
                            </a>
                        </dd>
                    </dl>
                </li>
                -->

                <!-- 分类管理 -->
                <!--
                <li class="layui-nav-item">
                    <a href="javascript:;">
                        <i class="layui-icon"  style="font-size: 15px;font-weight: bold;">&#xe64c;</i>
                        <span>Banner</span>
                        <em class="layui-nav-more"></em>
                    </a>
                    <dl class="layui-nav-child">
                        <dd>
                            <a href="javascript:;" data-url="{{url('admin/banner')}}">
                                <i class="layui-icon" data-icon='icon-lanmuguanli' style="font-size: 15px;font-weight: bold;">&#xe64c;</i>
                                <span>友情链接</span>
                            </a>
                        </dd>
                        <dd>
                            <a href="javascript:;" data-url="{{url('admin/bannersort')}}">
                                <i class="layui-icon" data-icon='icon-lanmuguanli' style="font-size: 15px;font-weight: bold;">&#xe60a;</i>
                                <span>友情分类</span>
                            </a>
                        </dd>
                    </dl>
                </li>
                -->

                <!-- 会员管理 -->
                <!--
                <li class="layui-nav-item">
                    <a href="javascript:;">
                        <i class="layui-icon" style="font-size: 15px;font-weight: bold;">&#xe612;</i>
                        <span>会员管理</span>
                        <em class="layui-nav-more"></em>
                    </a>
                    <dl class="layui-nav-child">
                        <dd>
                            <a href="javascript:;" data-url="{{url('admin/user')}}">
                                <i class="layui-icon"  data-icon='icon-zhuti' style="font-size: 15px;font-weight: bold;">&#xe613;</i>
                                <span>注册会员</span>
                            </a>
                        </dd>
                        <dd>
                            <a href="javascript:;">
                                <i class="layui-icon"  data-icon='icon-zhuti' style="font-size: 15px;font-weight: bold;">&#xe611;</i>
                                <span>会员留言</span>
                            </a>
                        </dd>
                    </dl>
                </li>
                -->

                <!-- 用户管理 -->
                <!--
                <li class="layui-nav-item">
                    <a href="javascript:;">
                        <i class="layui-icon"  style="font-size: 10px;font-weight: bold;">&#xe613;</i>
                        <span>后台用户</span>
                        <em class="layui-nav-more"></em>
                    </a>
                    <dl class="layui-nav-child">
                        <dd>
                            <a href="javascript:;" data-url="userlist.html">
                                <i class="layui-icon" data-icon='icon-yonghu1' style="font-size: 15px;font-weight: bold;">&#xe612;</i>
                                <span>用户列表</span>
                            </a>
                        </dd>
                        <dd>
                            <a href="javascript:;">
                                <i class="layui-icon" data-icon='icon-jiaoseguanli4' style="font-size: 15px;font-weight: bold;">&#xe650;</i>
                                <span>角色列表</span>
                            </a>
                        </dd>
                        <dd>
                            <a href="javascript:;">
                                <i class="layui-icon" data-icon='icon-quanxian2' style="font-size: 15px;font-weight: bold;">&#xe60a;</i>
                                <span>菜单管理</span>
                            </a>
                        </dd>
                    </dl>
                </li>
                -->
                <!-- 内容管理 -->
                <!--
                <li class="layui-nav-item">
                    <a href="javascript:;">
                        <i class="layui-icon" style="font-size: 15px;font-weight: bold;">&#xe61e;</i>
                        <span>内容管理</span>
                        <em class="layui-nav-more"></em>
                    </a>
                    <dl class="layui-nav-child">
                        <dd>
                            <a href="javascript:;">
                                <i class="layui-icon" data-icon='icon-lanmuguanli' style="font-size: 15px;font-weight: bold;">&#xe60a;</i>
                                <span>网站栏目管理</span>
                            </a>
                        </dd>
                        <dd>
                            <a href="javascript:;">
                                <i class="layui-icon" data-icon='icon-wenzhang2' style="font-size: 15px;font-weight: bold;">&#xe63c;</i>
                                <span>所有档案列表</span>
                            </a>
                        </dd>
                        <dd>
                            <a href="javascript:;">
                                <i class="layui-icon" data-icon='icon-icon1' style="font-size: 15px;font-weight: bold;">&#xe60e;</i>
                                <span>待审核的档案</span>
                            </a>
                        </dd>
                        <dd>
                            <a href="javascript:;">
                                <i class="layui-icon" data-icon='icon-word' style="font-size: 15px;font-weight: bold;">&#xe61f;</i>
                                <span>我发布的文档</span>
                            </a>
                        </dd>
                        <dd>
                            <a href="javascript:;">
                                <i class="layui-icon" data-icon='icon-pinglun1' style="font-size: 15px;font-weight: bold;">&#xe639;</i>
                                <span>评论管理</span>
                            </a>
                        </dd>

                        <dd>
                            <a href="javascript:;">
                                <i class="layui-icon" data-icon='icon-tags1' style="font-size: 15px;font-weight: bold;">&#xe60b;</i>
                                <span>TAGS管理</span>
                            </a>
                        </dd>
                        <dd>
                            <a href="javascript:;">
                                <i class="layui-icon" data-icon='icon-huishouzhan1' style="font-size: 15px;font-weight: bold;">&#xe640;</i>
                                <span>内容回收站</span>
                            </a>
                        </dd>
                    </dl>
                </li>
                -->

                <!--
                <li class="layui-nav-item">
                    <a href="javascript:;">
                        <i class="layui-icon" style="font-size: 15px;font-weight: bold;">&#xe614;</i>
                        <span>网站维护</span>
                        <em class="layui-nav-more"></em>
                    </a>
                    <dl class="layui-nav-child">
                        <dd>
                            <a href="javascript:;">
                                <i class="layui-icon"  data-icon='icon-zhuti'></i>
                                <span>网站主题</span>
                            </a>
                        </dd>
                        <dd>
                            <a href="javascript:;">
                                <i class="layui-icon" data-icon='icon-database'></i>
                                <span>数据库管理</span>
                            </a>
                        </dd>
                        <dd>
                            <a href="javascript:;">
                                <i class="layui-icon" data-icon='icon-shengchengbaogao'></i>
                                <span>生成页面</span>
                            </a>
                        </dd>
                        <dd>
                            <a href="javascript:;">
                                <i class="layui-icon" data-icon='icon-qingchuhuancun'></i>
                                <span>更新缓存</span>
                            </a>
                        </dd>

                    </dl>
                </li>
                -->

                <!-- 系统设置 -->
                <!--
                <li class="layui-nav-item">
                    <a href="javascript:;">
                        <i class="layui-icon" style="font-size: 15px;font-weight: bold;">&#xe631;</i>
                        <span>系统设置</span>
                        <em class="layui-nav-more"></em>
                    </a>
                    <dl class="layui-nav-child">
                        <dd>
                            <a href="javascript:;">
                                <i class="layui-icon" data-icon='icon-zhandianpeizhi'></i>
                                <span>基本参数设置</span>
                            </a>
                        </dd>
                        <dd>
                            <a href="javascript:;">
                                <i class="layui-icon" data-icon='icon-zhandianguanli1'></i>
                                <span>多站点管理</span>
                            </a>
                        </dd>
                        <dd>
                            <a href="javascript:;">
                                <i class="layui-icon" data-icon='icon-anquanshezhi'></i>
                                <span>安全设置</span>
                            </a>
                        </dd>
                        <dd>
                            <a href="javascript:;">
                                <i class="layui-icon" data-icon='icon-sms'></i>
                                <span>短信接口设置</span>
                            </a>
                        </dd>
                        <dd>
                            <a href="javascript:;">
                                <i class="layui-icon" data-icon='icon-iconfuzhi01'></i>
                                <span>系统日志管理</span>
                            </a>
                        </dd>
                        <dd>
                            <a href="javascript:;">
                                <i class='layui-icon' data-icon='icon-SQLServershujuku'></i>
                                <span>SQL命令行工具</span>
                            </a>
                        </dd>
                        <dd>
                            <a href="javascript:;">
                                <i class='layui-icon' data-icon='icon-xinxicaiji'></i>
                                <span>防采集管理</span>
                            </a>
                        </dd>
                    </dl>
                </li>
                -->

                <!-- 友链设置 -->
                <li class="layui-nav-item">
                    <a href="javascript:;" data-url="http://www.nndeal.com/">
                        <i class="layui-icon"  data-icon='icon-youqinglianjie' style="font-size: 15px;font-weight: bold;">&#xe64c;</i>
                        <span>友情链接</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- 左侧侧边导航结束 -->
    <!-- 右侧主体内容 -->
    <div class="layui-body" id="admin-body" style="bottom: 0;border-left: solid 2px #1AA094;">
        <div class="layui-tab layui-tab-card larry-tab-box" id="larry-tab" lay-filter="demo" lay-allowclose="true">
            <ul class="layui-tab-title">
                <li class="layui-this" id="admin-home"><i class="iconfont icon-diannao1"></i><em>后台首页</em></li>
            </ul>
            <div id="refresh_iframe" class="layui-btn refresh_iframe">刷新</div>
            <div class="layui-tab-content" style="min-height: 150px; ">
                <div class="layui-tab-item layui-show">
                    <iframe src="{{url('admin/log-viewer')}}"></iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- 底部区域 -->
    <div class="layui-footer layui-larry-foot" id="admin-footer">
        <div class="layui-mian">
            <div class="admin-side-toggle">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </div>
            <p class="p-admin">
                <span>2016 &copy;</span><a href="http://www.nndeal.com">NNDeal</a>. 版权所有 MIT License
            </p>
        </div>
    </div>

    <!-- 加载js文件-->
    <script type="text/javascript" src="{{asset('plugins/layui/layui.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/larry.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/index.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/navbar.js')}}"></script>
</div>
</body>
</html>
