@extends('Frontend.Home.CN.Wap.Layout.common')

@section('seo')
    @include('Frontend.Home.CN.Wap.Layout.seo')
@stop

@section('reminder')
    <!--登录-->
    <div class="mask none">
        <div class="login">
            <form action="" class="registerForm">
                <h4>用户登录</h4>
                <div class="phoneNumber">
                    <!--<span></span>-->
                    <img src="{{asset('assets/frontend/home/web/images/phone.png')}}" alt="">
                    <input type="text" placeholder="请输入手机号码" id="mobile_data">
                </div>
                <div class="verifica">
                    <div class="verificationCode">
                        <!--<span></span>-->
                        <img src="{{asset('assets/frontend/home/web/images/yanzheng.png')}}" alt="">
                        <input type="text" placeholder="请输入验证码" id="sms_code">
                    </div>
                    <div class="send"><a href="###">发送验证码</a></div>
                </div>
                <div class="rightNow" id="userLogin"><a href="###">立即登录</a></div>
                <p>登录代表您已同意&nbsp;&nbsp;<a href="agreement.html" target="_blank">NNDeal用户服务协议</a></p>
                <div class="login_text"><h6>其他方式登录</h6><a href="###" target="_blank"><img src="{{asset('assets/frontend/home/web/images/weixin.png')}}" alt=""></a></div>
            </form>
            <div class="btn_one"></div>
        </div>
    </div>

    <div class="read none">
        <div class="shop_read">
            <p>店址订阅</p>
            <div class="shop_mess">
                <h6>实时获得最精确的店址推荐</h6>
                <div class="shop_choice">
                    <input type="text" placeholder="请选择你的经营类型">
                    <span></span>
                    <div class="kuang none">
                        <ul>
                            <li>酒楼餐饮</li>
                            <li>服饰鞋包</li>
                            <li>休闲娱乐</li>
                            <li>美容美发</li>
                            <li>生活服务</li>
                            <li>百货超市</li>
                            <li>家居建材</li>
                            <li>电器通讯</li>
                            <li>汽修美容</li>
                            <li>医药保健</li>
                            <li>教育培训</li>
                            <li>旅游宾馆</li>
                            <li>其他业态</li>
                        </ul>
                    </div>
                </div>
                <div class="shop_choice">
                    <input type="text" placeholder="请选择商铺类型">
                    <span></span>
                    <div class="kuang none">
                        <ul>
                            <li>商业街商铺</li>
                            <li>社区住宅底商</li>
                            <li>写字楼配套</li>
                            <li>百货／购物中心</li>
                            <li>临街门面</li>
                            <li>档口摊位</li>
                            <li>其他</li>
                        </ul>
                    </div>
                </div>
                <div class="shop_choice _choice">
                    <!--<div class="_choice">请选择目标开店区域</div>-->
                    <input type="text" placeholder="请选择目标开店区域">
                    <div class="dingwei"></div>
                    <span></span>
                    <div class="kuang none list">
                        <ul class="all">
                            <li>全部
                                <ul class="aa none">
                                    <li class="bac">返回上一级</li>
                                    <li>全部</li>
                                </ul>
                            </li>
                            <li>东城区
                                <ul class="aa none">
                                    <li class="bac">返回上一级</li>
                                    <li>东直门</li>
                                    <li>和平里</li>
                                    <li>雍和宫</li>
                                    <li>安定门</li>
                                    <li>交道口</li>
                                    <li>地坛</li>
                                    <li>金宝街</li>
                                    <li>东四十条</li>
                                    <li>东四</li>
                                    <li>朝阳门</li>
                                    <li>建国门</li>
                                    <li>东单</li>
                                    <li>王府井</li>
                                    <li>灯市口</li>
                                    <li>东外大街</li>
                                    <li>雅宝路</li>
                                    <li>东中街</li>
                                    <li>其他</li>
                                </ul>
                            </li>
                            <li>西城区
                                <ul class="aa none">
                                    <li class="bac">返回上一级</li>
                                    <li>西直门</li>
                                    <li>新街口</li>
                                    <li>积水潭</li>
                                    <li>小西天</li>
                                    <li>德胜门</li>
                                    <li>钓鱼台</li>
                                    <li>后海</li>
                                    <li>什刹海</li>
                                    <li>西四</li>
                                    <li>西单</li>
                                    <li>复兴门</li>
                                    <li>金融街</li>
                                    <li>阜成门</li>
                                    <li>北营房</li>
                                    <li>车公庄</li>
                                    <li>南锣鼓巷</li>
                                    <li>白云路</li>
                                    <li>月坛</li>
                                    <li>三里河</li>
                                    <li>木樨地</li>
                                    <li>西便门</li>
                                    <li>其他</li>
                                </ul>
                            </li>
                            <li>崇文区
                                <ul class="aa none">
                                    <li class="bac">返回上一级</li>
                                    <li>幸福大街</li>
                                    <li>崇文门</li>
                                    <li>东花市</li>
                                    <li>广渠门</li>
                                    <li>光明楼</li>
                                    <li>天坛</li>
                                    <li>沙子口</li>
                                    <li>其他</li>
                                </ul>
                            </li>
                            <li>宣武区
                                <ul class="aa none">
                                    <li class="bac">返回上一级</li>
                                    <li>广安门</li>
                                    <li>西客站</li>
                                    <li>马连道</li>
                                    <li>天宁寺</li>
                                    <li>白纸坊</li>
                                    <li>西菜园</li>
                                    <li>右安门</li>
                                    <li>枣林前街</li>
                                    <li>牛街</li>
                                    <li>长椿街</li>
                                    <li>天伦北里</li>
                                    <li>双槐里</li>
                                    <li>陶然亭</li>
                                    <li>虎坊桥</li>
                                    <li>其他</li>
                                </ul>
                            </li>
                            <li>朝阳区
                                <ul class="aa none">
                                    <li class="bac">返回上一级</li>
                                    <li>望京</li>
                                    <li>京广</li>
                                    <li>酒仙桥</li>
                                    <li>化工大学</li>
                                    <li>北沙滩</li>
                                    <li>中日医院</li>
                                    <li>亚运村</li>
                                    <li>麦子店</li>
                                    <li>八王坟</li>
                                    <li>光熙门</li>
                                    <li>延静里</li>
                                    <li>静安庄</li>
                                    <li>安贞</li>
                                    <li>大悦城</li>
                                    <li>慈云寺</li>
                                    <li>芍药居</li>
                                    <li>太阳宫</li>
                                    <li>西坝河</li>
                                    <li>官庄</li>
                                    <li>国展</li>
                                    <li>左家庄</li>
                                    <li>三元桥</li>
                                    <li>燕莎</li>
                                    <li>朝阳公园</li>
                                    <li>团结湖</li>
                                    <li>三里屯</li>
                                    <li>建外大街</li>
                                    <li>东大桥</li>
                                    <li>CBD</li>
                                    <li>呼家楼</li>
                                    <li></li>
                                    <li>国贸</li>
                                    <li>双井</li>
                                    <li>劲松</li>
                                    <li>潘家园</li>
                                    <li>华威桥</li>
                                    <li>大望路</li>
                                    <li>百子湾</li>
                                    <li>四惠</li>
                                    <li>红庙</li>
                                    <li>八里庄</li>
                                    <li>石佛营</li>
                                    <li>十里堡</li>
                                    <li>高碑店</li>
                                    <li>姚家园</li>
                                    <li>定福庄</li>
                                    <li>双桥</li>
                                    <li>管庄</li>
                                    <li>豆各庄</li>
                                    <li>堡头</li>
                                    <li>十八里店</li>
                                    <li>十里河</li>
                                    <li>永安里</li>
                                    <li>其他</li>
                                </ul>
                            </li>
                            <li>丰台区
                                <ul class="aa none">
                                    <li class="bac">返回上一级</li>
                                    <li>六里桥</li>
                                    <li>太平桥</li>
                                    <li>开阳里</li>
                                    <li>丽泽桥</li>
                                    <li>菜户营</li>
                                    <li>玉泉营</li>
                                    <li>草桥</li>
                                    <li>万柳桥</li>
                                    <li>马家堡</li>
                                    <li>角门</li>
                                    <li>洋桥</li>
                                    <li>西罗园</li>
                                    <li>木樨园</li>
                                    <li>赵公口</li>
                                    <li>刘家窑</li>
                                    <li>蒲黄榆</li>
                                    <li>万庄</li>
                                    <li>左安门</li>
                                    <li>成寿寺</li>
                                    <li>宋家庄</li>
                                    <li>大红门</li>
                                    <li>南苑</li>
                                    <li>西局</li>
                                    <li>东高地</li>
                                    <li>丰益桥</li>
                                    <li>花乡</li>
                                    <li>世界公园</li>
                                    <li>科技园区</li>
                                    <li>北大地</li>
                                    <li>夏家胡同</li>
                                    <li>岳各庄</li>
                                    <li>青塔</li>
                                    <li>五里店</li>
                                    <li>卢沟桥</li>
                                    <li>云岗</li>
                                    <li>其他</li>
                                </ul>
                            </li>
                            <li>石景山区
                                <ul class="aa none">
                                    <li class="bac">返回上一级</li>
                                    <li>晋元庄</li>
                                    <li>玉泉路</li>
                                    <li>老山</li>
                                    <li>鲁谷</li>
                                    <li>八角</li>
                                    <li>古城</li>
                                    <li>杨庄</li>
                                    <li>苹果园</li>
                                    <li>金顶街</li>
                                    <li>模式口</li>
                                    <li>其他</li>
                                </ul>
                            </li>
                            <li>海淀区
                                <ul class="aa none">
                                    <li class="bac">返回上一级</li>
                                    <li>清河</li>
                                    <li>小营</li>
                                    <li>西三旗</li>
                                    <li>西二旗</li>
                                    <li>上帝</li>
                                    <li>西北望</li>
                                    <li>马连洼</li>
                                    <li>西苑</li>
                                    <li>北京大学</li>
                                    <li>苏州街</li>
                                    <li>中关村</li>
                                    <li>北大清华</li>
                                    <li>五道口</li>
                                    <li>学院路</li>
                                    <li>二里庄</li>
                                    <li>牡丹园</li>
                                    <li>北太平庄</li>
                                    <li>马甸</li>
                                    <li>大钟寺</li>
                                    <li>知春路</li>
                                    <li>双榆村</li>
                                    <li>人们大学</li>
                                    <li>万柳</li>
                                    <li>世纪城</li>
                                    <li>魏公村</li>
                                    <li>皂君庙</li>
                                    <li>交通大学</li>
                                    <li>圆明园</li>
                                    <li>海淀黄庄</li>
                                    <li>紫竹桥</li>
                                    <li>万寿寺</li>
                                    <li>车道沟</li>
                                    <li>北洼路</li>
                                    <li>蓟门桥</li>
                                    <li>航天桥</li>
                                    <li>三义庙</li>
                                    <li>甘家口</li>
                                    <li>军博</li>
                                    <li>公主坟</li>
                                    <li>万寿路</li>
                                    <li>五棵松</li>
                                    <li>永定路</li>
                                    <li>定慧寺</li>
                                    <li>百万庄</li>
                                    <li>四季青</li>
                                    <li>香山</li>
                                    <li>农大</li>
                                    <li>小南庄</li>
                                    <li>其他</li>
                                </ul>
                            </li>
                            <li>门头沟区
                                <ul class="aa none">
                                    <li class="bac">返回上一级</li>
                                    <li>大峪</li>
                                    <li>东辛房</li>
                                    <li>其他</li>
                                </ul>
                            </li>
                            <li>房山区
                                <ul class="aa none">
                                    <li class="bac">返回上一级</li>
                                    <li>长阳</li>
                                    <li>良乡</li>
                                    <li>行宫园</li>
                                    <li>窦店</li>
                                    <li>燕山</li>
                                    <li>其他</li>
                                </ul>
                            </li>
                            <li>通州区
                                <ul class="aa none">
                                    <li class="bac">返回上一级</li>
                                    <li>北关</li>
                                    <li>新华大街</li>
                                    <li>西上园</li>
                                    <li>果园</li>
                                    <li>九棵树</li>
                                    <li>梨园</li>
                                    <li>梨园城铁</li>
                                    <li>临河里</li>
                                    <li>土桥</li>
                                    <li>玉桥</li>
                                    <li>乔庄</li>
                                    <li>武夷花园</li>
                                    <li>潞城</li>
                                    <li>马驹桥</li>
                                    <li>物资学院</li>
                                    <li>新华联</li>
                                    <li>张家湾</li>
                                    <li>西门</li>
                                    <li>次渠</li>
                                    <li>其他</li>
                                </ul>
                            </li>
                            <li>顺义区
                                <ul class="aa none">
                                    <li class="bac">返回上一级</li>
                                    <li>后沙峪</li>
                                    <li>胜利</li>
                                    <li>樱花园</li>
                                    <li>石园</li>
                                    <li>建新北门</li>
                                    <li>石门苑</li>
                                    <li>机场</li>
                                    <li>天竺</li>
                                    <li>新国展</li>
                                    <li>马坡</li>
                                    <li>其他</li>
                                </ul>
                            </li>
                            <li>昌平区
                                <ul class="aa none">
                                    <li class="bac">返回上一级</li>
                                    <li>龙泽</li>
                                    <li>回龙观</li>
                                    <li>霍营</li>
                                    <li>立水桥</li>
                                    <li>天通苑</li>
                                    <li>北七家</li>
                                    <li>沙河镇</li>
                                    <li></li>
                                    <li>昌平县城</li>
                                    <li>小汤山</li>
                                    <li>其他</li>
                                </ul>
                            </li>
                            <li>大兴区
                                <ul class="aa none">
                                    <li class="bac">返回上一级</li>
                                    <li>黄村</li>
                                    <li>西红门</li>
                                    <li>旧宫</li>
                                    <li>亦庄</li>
                                    <li>兴华大街</li>
                                    <li>兴华园</li>
                                    <li>上清园</li>
                                    <li>郁花园</li>
                                    <li>海子角</li>
                                    <li>高米店</li>
                                    <li>其他</li>
                                </ul>
                            </li>
                            <li>怀柔区
                                <ul class="aa none">
                                    <li class="bac">返回上一级</li>
                                    <li>怀柔城区</li>
                                    <li>雁栖</li>
                                    <li>其他</li>
                                </ul>
                            </li>
                            <li>平谷区
                                <ul class="aa none">
                                    <li class="bac">返回上一级</li>
                                    <li>平谷城区</li>
                                    <li>滨河路</li>
                                    <li>其他</li>
                                </ul>
                            </li>
                            <li>密云县
                                <ul class="aa none">
                                    <li class="bac">返回上一级</li>
                                    <li>密云城区</li>
                                    <li>其他</li>
                                </ul>
                            </li>
                            <li>延庆县
                                <ul class="aa none">
                                    <li class="bac">返回上一级</li>
                                    <li>延庆</li>
                                    <li>康庄</li>
                                    <li>八达岭</li>
                                    <li>大榆树</li>
                                    <li>永宁</li>
                                </ul>
                            </li>
                            <li>燕郊
                                <ul class="aa none">
                                    <li class="bac">返回上一级</li>
                                    <li>燕顺路</li>
                                    <li>迎宾路</li>
                                    <li>上上城</li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="shop_choice">
                    <input type="text" placeholder="请选择你的经营面积">
                    <span></span>
                    <div class="kuang none">
                        <ul>
                            <li>0~50㎡</li>
                            <li>50~100㎡</li>
                            <li>100~150㎡</li>
                            <li>150~200㎡</li>
                            <li>200~300㎡</li>
                            <li>300~500㎡</li>
                            <li>500㎡以上</li>
                        </ul>
                    </div>
                </div>
                <div class="shop_choice">
                    <input type="text" placeholder=" 请选择你的开店预算">
                    <span></span>
                    <div class="kuang none">
                        <ul>
                            <li>30万以下</li>
                            <li>30~50万元</li>
                            <li>50~100万元</li>
                            <li>100~150万元</li>
                            <li>150~200万元</li>
                            <li>200~500万元</li>
                            <li>500万元以上</li>
                        </ul>
                    </div>
                </div>
                <div class="readNow">立即订阅</div>
            </div>
            <div class="btn_two"></div>
        </div>
    </div>
@stop

@section('header')
    <!--**************************************头部**************************************-->
    <div class="head">
        <ul>
            <li>
                <a href="###" id="logo"></a>
            </li>
            <li>
                <a href="###" class="_addr"><span class="addr"></span><i>北京</i></a>
            </li>
            <li>
                <a href="###" class="_user"><span class="user"></span><i>登录</i></a>
            </li>
            <li>
                <a href="###" class="_read"><span class="read_"></span><i>店址订阅</i></a>
            </li>
        </ul>
        <!--********遮罩层*********-->

        <!--我的展开-->
        <div class="my none">
            <a href="###"><span class="collect">我的收藏</span></a>
            <a href="###"><span class="order">我的订单</span></a>
            <a href="###"><span class="back" id="userLogout">退出</span></a>
        </div>
    </div>
@stop

@section('banner')
    <!--**************************************banner**************************************-->
    <div class="banner">
        <div class="banner_con">
            <div class="text">
                <h4>全网铺源</h4>
                <p>大数据捕获全网真实有效店址</p>
            </div>
            <div class="search">
                <form action="">
                    <div class="search_key">
                        <input type="text" placeholder="输入关键字">
                        <a href="###"><span></span></a>
                    </div>
                    <div class="line">
                        <div class="lineOne"></div>
                        <div class="find">输入条件找铺</div>
                        <div class="lineTwo"></div>
                    </div>
                    <div class="select">
                        <div class="domain"><i>开店区域</i><a href="###"><span></span></a>
                            <div class="first none">
                                <div class="erji none"></div>
                                <ul class="all">
                                    <li>全部
                                        <ul>
                                            <li>全部</li>
                                        </ul>
                                    </li>
                                    <li>东城区
                                        <ul>
                                            <li>东直门</li>
                                            <li>和平里</li>
                                            <li>雍和宫</li>
                                            <li>安定门</li>
                                            <li>交道口</li>
                                            <li>地坛</li>
                                            <li>金宝街</li>
                                            <li>东四十条</li>
                                            <li>东四</li>
                                            <li>朝阳门</li>
                                            <li>建国门</li>
                                            <li>东单</li>
                                            <li>王府井</li>
                                            <li>灯市口</li>
                                            <li>东外大街</li>
                                            <li>雅宝路</li>
                                            <li>东中街</li>
                                            <li>其他</li>
                                        </ul>
                                    </li>
                                    <li>西城区
                                        <ul>
                                            <li>西直门</li>
                                            <li>新街口</li>
                                            <li>积水潭</li>
                                            <li>小西天</li>
                                            <li>德胜门</li>
                                            <li>钓鱼台</li>
                                            <li>后海</li>
                                            <li>什刹海</li>
                                            <li>西四</li>
                                            <li>西单</li>
                                            <li>复兴门</li>
                                            <li>金融街</li>
                                            <li>阜成门</li>
                                            <li>北营房</li>
                                            <li>车公庄</li>
                                            <li>南锣鼓巷</li>
                                            <li>白云路</li>
                                            <li>月坛</li>
                                            <li>三里河</li>
                                            <li>木樨地</li>
                                            <li>西便门</li>
                                            <li>其他</li>
                                        </ul>
                                    </li>
                                    <li>崇文区
                                        <ul>
                                            <li>幸福大街</li>
                                            <li>崇文门</li>
                                            <li>东花市</li>
                                            <li>广渠门</li>
                                            <li>光明楼</li>
                                            <li>天坛</li>
                                            <li>沙子口</li>
                                            <li>其他</li>
                                        </ul>
                                    </li>
                                    <li>宣武区
                                        <ul>
                                            <li>广安门</li>
                                            <li>西客站</li>
                                            <li>马连道</li>
                                            <li>天宁寺</li>
                                            <li>白纸坊</li>
                                            <li>西菜园</li>
                                            <li>右安门</li>
                                            <li>枣林前街</li>
                                            <li>牛街</li>
                                            <li>长椿街</li>
                                            <li>天伦北里</li>
                                            <li>双槐里</li>
                                            <li>陶然亭</li>
                                            <li>虎坊桥</li>
                                            <li>其他</li>
                                        </ul>
                                    </li>
                                    <li>朝阳区
                                        <ul>
                                            <li>望京</li>
                                            <li>京广</li>
                                            <li>酒仙桥</li>
                                            <li>化工大学</li>
                                            <li>北沙滩</li>
                                            <li>中日医院</li>
                                            <li>亚运村</li>
                                            <li>麦子店</li>
                                            <li>八王坟</li>
                                            <li>光熙门</li>
                                            <li>延静里</li>
                                            <li>静安庄</li>
                                            <li>安贞</li>
                                            <li>大悦城</li>
                                            <li>慈云寺</li>
                                            <li>芍药居</li>
                                            <li>太阳宫</li>
                                            <li>西坝河</li>
                                            <li>官庄</li>
                                            <li>国展</li>
                                            <li>左家庄</li>
                                            <li>三元桥</li>
                                            <li>燕莎</li>
                                            <li>朝阳公园</li>
                                            <li>团结湖</li>
                                            <li>三里屯</li>
                                            <li>建外大街</li>
                                            <li>东大桥</li>
                                            <li>CBD</li>
                                            <li>呼家楼</li>
                                            <li></li>
                                            <li>国贸</li>
                                            <li>双井</li>
                                            <li>劲松</li>
                                            <li>潘家园</li>
                                            <li>华威桥</li>
                                            <li>大望路</li>
                                            <li>百子湾</li>
                                            <li>四惠</li>
                                            <li>红庙</li>
                                            <li>八里庄</li>
                                            <li>石佛营</li>
                                            <li>十里堡</li>
                                            <li>高碑店</li>
                                            <li>姚家园</li>
                                            <li>定福庄</li>
                                            <li>双桥</li>
                                            <li>管庄</li>
                                            <li>豆各庄</li>
                                            <li>堡头</li>
                                            <li>十八里店</li>
                                            <li>十里河</li>
                                            <li>永安里</li>
                                            <li>其他</li>
                                        </ul>
                                    </li>
                                    <li>丰台区
                                        <ul>
                                            <li>六里桥</li>
                                            <li>太平桥</li>
                                            <li>开阳里</li>
                                            <li>丽泽桥</li>
                                            <li>菜户营</li>
                                            <li>玉泉营</li>
                                            <li>草桥</li>
                                            <li>万柳桥</li>
                                            <li>马家堡</li>
                                            <li>角门</li>
                                            <li>洋桥</li>
                                            <li>西罗园</li>
                                            <li>木樨园</li>
                                            <li>赵公口</li>
                                            <li>刘家窑</li>
                                            <li>蒲黄榆</li>
                                            <li>万庄</li>
                                            <li>左安门</li>
                                            <li>成寿寺</li>
                                            <li>宋家庄</li>
                                            <li>大红门</li>
                                            <li>南苑</li>
                                            <li>西局</li>
                                            <li>东高地</li>
                                            <li>丰益桥</li>
                                            <li>花乡</li>
                                            <li>世界公园</li>
                                            <li>科技园区</li>
                                            <li>北大地</li>
                                            <li>夏家胡同</li>
                                            <li>岳各庄</li>
                                            <li>青塔</li>
                                            <li>五里店</li>
                                            <li>卢沟桥</li>
                                            <li>云岗</li>
                                            <li>其他</li>
                                        </ul>
                                    </li>
                                    <li>石景山区
                                        <ul>
                                            <li>晋元庄</li>
                                            <li>玉泉路</li>
                                            <li>老山</li>
                                            <li>鲁谷</li>
                                            <li>八角</li>
                                            <li>古城</li>
                                            <li>杨庄</li>
                                            <li>苹果园</li>
                                            <li>金顶街</li>
                                            <li>模式口</li>
                                            <li>其他</li>
                                        </ul>
                                    </li>
                                    <li>海淀区
                                        <ul>
                                            <li>清河</li>
                                            <li>小营</li>
                                            <li>西三旗</li>
                                            <li>西二旗</li>
                                            <li>上帝</li>
                                            <li>西北望</li>
                                            <li>马连洼</li>
                                            <li>西苑</li>
                                            <li>北京大学</li>
                                            <li>苏州街</li>
                                            <li>中关村</li>
                                            <li>北大清华</li>
                                            <li>五道口</li>
                                            <li>学院路</li>
                                            <li>二里庄</li>
                                            <li>牡丹园</li>
                                            <li>北太平庄</li>
                                            <li>马甸</li>
                                            <li>大钟寺</li>
                                            <li>知春路</li>
                                            <li>双榆村</li>
                                            <li>人们大学</li>
                                            <li>万柳</li>
                                            <li>世纪城</li>
                                            <li>魏公村</li>
                                            <li>皂君庙</li>
                                            <li>交通大学</li>
                                            <li>圆明园</li>
                                            <li>海淀黄庄</li>
                                            <li>紫竹桥</li>
                                            <li>万寿寺</li>
                                            <li>车道沟</li>
                                            <li>北洼路</li>
                                            <li>蓟门桥</li>
                                            <li>航天桥</li>
                                            <li>三义庙</li>
                                            <li>甘家口</li>
                                            <li>军博</li>
                                            <li>公主坟</li>
                                            <li>万寿路</li>
                                            <li>五棵松</li>
                                            <li>永定路</li>
                                            <li>定慧寺</li>
                                            <li>百万庄</li>
                                            <li>四季青</li>
                                            <li>香山</li>
                                            <li>农大</li>
                                            <li>小南庄</li>
                                            <li>其他</li>
                                        </ul>
                                    </li>
                                    <li>门头沟区
                                        <ul>
                                            <li>大峪</li>
                                            <li>东辛房</li>
                                            <li>其他</li>
                                        </ul>
                                    </li>
                                    <li>房山区
                                        <ul>
                                            <li>长阳</li>
                                            <li>良乡</li>
                                            <li>行宫园</li>
                                            <li>窦店</li>
                                            <li>燕山</li>
                                            <li>其他</li>
                                        </ul>
                                    </li>
                                    <li>通州区
                                        <ul>
                                            <li>北关</li>
                                            <li>新华大街</li>
                                            <li>西上园</li>
                                            <li>果园</li>
                                            <li>九棵树</li>
                                            <li>梨园</li>
                                            <li>梨园城铁</li>
                                            <li>临河里</li>
                                            <li>土桥</li>
                                            <li>玉桥</li>
                                            <li>乔庄</li>
                                            <li>武夷花园</li>
                                            <li>潞城</li>
                                            <li>马驹桥</li>
                                            <li>物资学院</li>
                                            <li>新华联</li>
                                            <li>张家湾</li>
                                            <li>西门</li>
                                            <li>次渠</li>
                                            <li>其他</li>
                                        </ul>
                                    </li>
                                    <li>顺义区
                                        <ul>
                                            <li>后沙峪</li>
                                            <li>胜利</li>
                                            <li>樱花园</li>
                                            <li>石园</li>
                                            <li>建新北门</li>
                                            <li>石门苑</li>
                                            <li>机场</li>
                                            <li>天竺</li>
                                            <li>新国展</li>
                                            <li>马坡</li>
                                            <li>其他</li>
                                        </ul>
                                    </li>
                                    <li>昌平区
                                        <ul>
                                            <li>龙泽</li>
                                            <li>回龙观</li>
                                            <li>霍营</li>
                                            <li>立水桥</li>
                                            <li>天通苑</li>
                                            <li>北七家</li>
                                            <li>沙河镇</li>
                                            <li></li>
                                            <li>昌平县城</li>
                                            <li>小汤山</li>
                                            <li>其他</li>
                                        </ul>
                                    </li>
                                    <li>大兴区
                                        <ul>
                                            <li>黄村</li>
                                            <li>西红门</li>
                                            <li>旧宫</li>
                                            <li>亦庄</li>
                                            <li>兴华大街</li>
                                            <li>兴华园</li>
                                            <li>上清园</li>
                                            <li>郁花园</li>
                                            <li>海子角</li>
                                            <li>高米店</li>
                                            <li>其他</li>
                                        </ul>
                                    </li>
                                    <li>怀柔区
                                        <ul>
                                            <li>怀柔城区</li>
                                            <li>雁栖</li>
                                            <li>其他</li>
                                        </ul>
                                    </li>
                                    <li>平谷区
                                        <ul>
                                            <li>平谷城区</li>
                                            <li>滨河路</li>
                                            <li>其他</li>
                                        </ul>
                                    </li>
                                    <li>密云县
                                        <ul>
                                            <li>密云城区</li>
                                            <li>其他</li>
                                        </ul>
                                    </li>
                                    <li>延庆县
                                        <ul>
                                            <li>延庆</li>
                                            <li>康庄</li>
                                            <li>八达岭</li>
                                            <li>大榆树</li>
                                            <li>永宁</li>
                                        </ul>
                                    </li>
                                    <li>燕郊
                                        <ul>
                                            <li>燕顺路</li>
                                            <li>迎宾路</li>
                                            <li>上上城</li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="type"><i>商铺类型</i><a href="###"><span></span></a>
                            <div class="second none">
                                <ul>
                                    <li>商业街商铺</li>
                                    <li>社区住宅底商</li>
                                    <li>写字楼配套</li>
                                    <li>百货／购物中心</li>
                                    <li>临街门面</li>
                                    <li>档口摊位</li>
                                    <li>其他</li>
                                </ul>
                            </div>
                        </div>
                        <div class="area"><i>经营面积</i><a href="###"><span></span></a>
                            <div class="third none">
                                <ul>
                                    <li>0~50㎡</li>
                                    <li>50~100㎡</li>
                                    <li>100~150㎡</li>
                                    <li>150~200㎡</li>
                                    <li>200~300㎡</li>
                                    <li>300~500㎡</li>
                                    <li>500㎡以上</li>
                                </ul>
                            </div>
                        </div>
                        <div class="budget"><i>开店预算</i><a href="###"><span></span></a>
                            <div class="forth none">
                                <ul>
                                    <li>30万以下</li>
                                    <li>30~50万元</li>
                                    <li>50~100万元</li>
                                    <li>100~150万元</li>
                                    <li>150~200万元</li>
                                    <li>200~500万元</li>
                                    <li>500万元以上</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="choice"><a href="###">开始选铺</a></div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('content')
    <!--**************************************内容**************************************-->
    <div class="content">
        <div class="show">店址推荐
            <div class="alert">已为您从&nbsp;<span>33567256</span>&nbsp;个店址中筛选出&nbsp;<i>36896</i>&nbsp;个有执照的有效地址</div>
        </div>

        <div class="pic_show">
            <!--***********组一***********-->
            <div class="pic_list mar_right">
                <a href="###">
                    <dl>
                        <dt>
                            <img src="{{asset('assets/frontend/home/web/images/shop.png')}}" alt="">
                        <div class="tip"><span>客流：68980</span></div>
                        <h5>生活社区型</h5>
                        </dt>
                        <dd>
                            <div class="shop_mess">
                                <span class="shop_area">100㎡</span>
                                <span class="shop_style">商业街铺</span>
                            </div>
                            <div class="shop_money">
                                <span class="shop_mon_money">80000</span>元/月
                                <span class="shop_forother">转让费：<i>5</i>万元</span>
                            </div>
                            <div class="shop_addr"><span></span>海淀区紫竹桥国际财经中心B座底商</div>
                            <div class="shop_around">
                                <span class="shop_around_one near">学校3</span>
                                <span class="shop_around_two near">医院2</span>
                                <span class="shop_around_three near">写字楼2</span>
                            </div>
                            <div class="shop_news">更新于<i>1</i>小时前</div>
                        </dd>
                    </dl>
                </a>
            </div>
            <div class="pic_list mar_right">
                <a href="###">
                    <dl>
                        <dt>
                            <img src="{{asset('assets/frontend/home/web/images/shop.png')}}" alt="">
                        <div class="tip"><span>客流：68980</span></div>
                        <h5>生活社区型</h5>
                        </dt>
                        <dd>
                            <div class="shop_mess">
                                <span class="shop_area">100㎡</span>
                                <span class="shop_style">商业街铺</span>
                            </div>
                            <div class="shop_money">
                                <span class="shop_mon_money">80000</span>元/月
                                <span class="shop_forother">转让费：<i>5</i>万元</span>
                            </div>
                            <div class="shop_addr"><span></span>海淀区紫竹桥国际财经中心B座底商</div>
                            <div class="shop_around">
                                <span class="shop_around_one near">学校3</span>
                                <span class="shop_around_two near">医院2</span>
                                <span class="shop_around_three near">写字楼2</span>
                            </div>
                            <div class="shop_news">更新于<i>1</i>小时前</div>
                        </dd>
                    </dl>
                </a>
            </div>
            <div class="pic_list">
                <a href="###">
                    <dl>
                        <dt>
                            <img src="{{asset('assets/frontend/home/web/images/shop.png')}}" alt="">
                        <div class="tip"><span>客流：68980</span></div>
                        <h5>生活社区型</h5>
                        </dt>
                        <dd>
                            <div class="shop_mess">
                                <span class="shop_area">100㎡</span>
                                <span class="shop_style">商业街铺</span>
                            </div>
                            <div class="shop_money">
                                <span class="shop_mon_money">80000</span>元/月
                                <span class="shop_forother">转让费：<i>5</i>万元</span>
                            </div>
                            <div class="shop_addr"><span></span>海淀区紫竹桥国际财经中心B座底商</div>
                            <div class="shop_around">
                                <span class="shop_around_one near">学校3</span>
                                <span class="shop_around_two near">医院2</span>
                                <span class="shop_around_three near">写字楼2</span>
                            </div>
                            <div class="shop_news">更新于<i>1</i>小时前</div>
                        </dd>
                    </dl>
                </a>
            </div>
            <!--***********组二***********-->
            <div class="pic_list mar_right">
                <a href="###">
                    <dl>
                        <dt>
                            <img src="{{asset('assets/frontend/home/web/images/shop.png')}}" alt="">
                        <div class="tip"><span>客流：68980</span></div>
                        <h5>生活社区型</h5>
                        </dt>
                        <dd>
                            <div class="shop_mess">
                                <span class="shop_area">100㎡</span>
                                <span class="shop_style">商业街铺</span>
                            </div>
                            <div class="shop_money">
                                <span class="shop_mon_money">80000</span>元/月
                                <span class="shop_forother">转让费：<i>5</i>万元</span>
                            </div>
                            <div class="shop_addr"><span></span>海淀区紫竹桥国际财经中心B座底商</div>
                            <div class="shop_around">
                                <span class="shop_around_one near">学校3</span>
                                <span class="shop_around_two near">医院2</span>
                                <span class="shop_around_three near">写字楼2</span>
                            </div>
                            <div class="shop_news">更新于<i>1</i>小时前</div>
                        </dd>
                    </dl>
                </a>
            </div>
            <div class="pic_list mar_right">
                <a href="###">
                    <dl>
                        <dt>
                            <img src="{{asset('assets/frontend/home/web/images/shop.png')}}" alt="">
                        <div class="tip"><span>客流：68980</span></div>
                        <h5>生活社区型</h5>
                        </dt>
                        <dd>
                            <div class="shop_mess">
                                <span class="shop_area">100㎡</span>
                                <span class="shop_style">商业街铺</span>
                            </div>
                            <div class="shop_money">
                                <span class="shop_mon_money">80000</span>元/月
                                <span class="shop_forother">转让费：<i>5</i>万元</span>
                            </div>
                            <div class="shop_addr"><span></span>海淀区紫竹桥国际财经中心B座底商</div>
                            <div class="shop_around">
                                <span class="shop_around_one near">学校3</span>
                                <span class="shop_around_two near">医院2</span>
                                <span class="shop_around_three near">写字楼2</span>
                            </div>
                            <div class="shop_news">更新于<i>1</i>小时前</div>
                        </dd>
                    </dl>
                </a>
            </div>
            <div class="pic_list">
                <a href="###">
                    <dl>
                        <dt>
                            <img src="{{asset('assets/frontend/home/web/images/shop.png')}}" alt="">
                        <div class="tip"><span>客流：68980</span></div>
                        <h5>生活社区型</h5>
                        </dt>
                        <dd>
                            <div class="shop_mess">
                                <span class="shop_area">100㎡</span>
                                <span class="shop_style">商业街铺</span>
                            </div>
                            <div class="shop_money">
                                <span class="shop_mon_money">80000</span>元/月
                                <span class="shop_forother">转让费：<i>5</i>万元</span>
                            </div>
                            <div class="shop_addr"><span></span>海淀区紫竹桥国际财经中心B座底商</div>
                            <div class="shop_around">
                                <span class="shop_around_one near">学校3</span>
                                <span class="shop_around_two near">医院2</span>
                                <span class="shop_around_three near">写字楼2</span>
                            </div>
                            <div class="shop_news">更新于<i>1</i>小时前</div>
                        </dd>
                    </dl>
                </a>
            </div>
            <!--***********组三***********-->
            <div class="pic_list mar_right">
                <a href="###">
                    <dl>
                        <dt>
                            <img src="{{asset('assets/frontend/home/web/images/shop.png')}}" alt="">
                        <div class="tip"><span>客流：68980</span></div>
                        <h5>生活社区型</h5>
                        </dt>
                        <dd>
                            <div class="shop_mess">
                                <span class="shop_area">100㎡</span>
                                <span class="shop_style">商业街铺</span>
                            </div>
                            <div class="shop_money">
                                <span class="shop_mon_money">80000</span>元/月
                                <span class="shop_forother">转让费：<i>5</i>万元</span>
                            </div>
                            <div class="shop_addr"><span></span>海淀区紫竹桥国际财经中心B座底商</div>
                            <div class="shop_around">
                                <span class="shop_around_one near">学校3</span>
                                <span class="shop_around_two near">医院2</span>
                                <span class="shop_around_three near">写字楼2</span>
                            </div>
                            <div class="shop_news">更新于<i>1</i>小时前</div>
                        </dd>
                    </dl>
                </a>
            </div>
            <div class="pic_list mar_right">
                <a href="###">
                    <dl>
                        <dt>
                            <img src="{{asset('assets/frontend/home/web/images/shop.png')}}" alt="">
                        <div class="tip"><span>客流：68980</span></div>
                        <h5>生活社区型</h5>
                        </dt>
                        <dd>
                            <div class="shop_mess">
                                <span class="shop_area">100㎡</span>
                                <span class="shop_style">商业街铺</span>
                            </div>
                            <div class="shop_money">
                                <span class="shop_mon_money">80000</span>元/月
                                <span class="shop_forother">转让费：<i>5</i>万元</span>
                            </div>
                            <div class="shop_addr"><span></span>海淀区紫竹桥国际财经中心B座底商</div>
                            <div class="shop_around">
                                <span class="shop_around_one near">学校3</span>
                                <span class="shop_around_two near">医院2</span>
                                <span class="shop_around_three near">写字楼2</span>
                            </div>
                            <div class="shop_news">更新于<i>1</i>小时前</div>
                        </dd>
                    </dl>
                </a>
            </div>
            <div class="pic_list">
                <a href="###">
                    <dl>
                        <dt>
                            <img src="{{asset('assets/frontend/home/web/images/shop.png')}}" alt="">
                        <div class="tip"><span>客流：68980</span></div>
                        <h5>生活社区型</h5>
                        </dt>
                        <dd>
                            <div class="shop_mess">
                                <span class="shop_area">100㎡</span>
                                <span class="shop_style">商业街铺</span>
                            </div>
                            <div class="shop_money">
                                <span class="shop_mon_money">80000</span>元/月
                                <span class="shop_forother">转让费：<i>5</i>万元</span>
                            </div>
                            <div class="shop_addr"><span></span>海淀区紫竹桥国际财经中心B座底商</div>
                            <div class="shop_around">
                                <span class="shop_around_one near">学校3</span>
                                <span class="shop_around_two near">医院2</span>
                                <span class="shop_around_three near">写字楼2</span>
                            </div>
                            <div class="shop_news">更新于<i>1</i>小时前</div>
                        </dd>
                    </dl>
                </a>
            </div>
            <div class="more"><a href="###">点击查看更多</a></div>
        </div>
    </div>
    <div class="return none">
        <a href="###"><div class="top"></div></a>
        <div class="server_phone none">客服电话<br>010-58220156</div>
        <a href="###"><div class="phone"></div></a>
    </div>
@stop

@section('javascript')
    <script src="{{asset('assets/frontend/home/web/js/jquery.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/frontend/home/web/js/index.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/frontend/index/web/layui.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        layui.config({
            base: '/assets/frontend/index/web/lay/modules/'
            ,version: '1490981130731'
        }).use('global','jquery');

        window.global = {
            preview: function(){
                var preview = document.getElementById('LAY_preview');
                return preview ? preview.innerHTML : '';
            }()
        };

        $(document).ready(function(){
            $("#brandCode").on('click',function () {
                var mobileData = $("#mobileData").val();
                console.log(mobileData);
                $.ajax({
                    type: 'POST',
                    url: '{{url("index/captcha")}}',
                    data: { mobile : mobileData},
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data){
                        if(data.status == 1){
                            layui.use('layer', function(){
                                var layer = layui.layer;
                                layer.msg(data.message);
                            });
                        }else{
                            layui.use('layer', function(){
                                var layer = layui.layer;
                                layer.msg(data.message);
                            });
                        }
                    },
                    error: function(xhr, type){
                        alert('Ajax error!')
                    }
                });

            });

            $('#userLogin').on('click',function () {
                $.ajax({
                    type: 'POST',
                    url: '{{url("user/ajax")}}',
                    data: {type:1,'sms_code':$("#sms_code").val(),'mobile':$('#mobile_data').val()},
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data){
                        if(data.status == 200){
                            layui.use('layer', function(){
                                var layer = layui.layer;
                                layer.msg(data.message);
                            });

                            $(".mask").addClass("none");
                            $(".my").removeClass("none");

                        }else{
                            layui.use('layer', function(){
                                var layer = layui.layer;
                                layer.msg(data.message);
                            });
                        }
                    },
                    error: function(xhr, type){
                        alert('Ajax error!')
                    }
                });
            });

            $('#userLogout').on('click',function () {
                $.ajax({
                    type: 'GET',
                    url: '{{url("user/ajaxLogout")}}',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data){
                        if(data.status == 200){
                            $(".my").addClass("none");
                            layui.use('layer', function(){
                                var layer = layui.layer;
                                layer.msg("登录成功退出！");
                            });
                        }
                    },
                    error: function(xhr, type){
                        alert('Ajax error!')
                    }
                });
            });

            $.ajax({
                type: 'GET',
                url: '{{url("user/check")}}',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data){
                    if(data.status == 200){
                        $(".my").removeClass("none");
                    }
                },
                error: function(xhr, type){
                    alert('Ajax error!')
                }
            });
        })
    </script>
@stop