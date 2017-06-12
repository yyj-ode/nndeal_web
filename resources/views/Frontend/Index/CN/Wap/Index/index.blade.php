@extends('Frontend.Index.CN.Wap.Layout.common')

@section('seo')
    @include('Frontend.Index.CN.Wap.Layout.seo')
@stop

@section('content')
    <style>
        body,html{height:100%;font-family: PingFangSC-Regular, sans-serif;}.relat{position:relative}.absol{position:absolute;left:50%}
        img{width:100%;display:block}.marginT{margin-top:-1px}.wrap{padding-bottom:.7rem}
        .wagesBtn{width:6.16rem;height:1.14rem;margin:.3rem auto .9rem;font-size:.4rem;text-shadow:0 1px 1px #fbe5b1;text-align:center;background-image:url(https://img.jianlc.cn/app/wagesPlan/btn_normal.png);  background-repeat:no-repeat;background-size:100% 100%}
        .wagesBtn:active{background-image:url(https://img.jianlc.cn/app/wagesPlan/btn_press.png)}
        .wagesBtn a{color:#3f2b06}.a-line{width:100%;height:.14rem;border-bottom:1px solid #eee9dc}
        #wagesBtn{margin: 0;padding: 0px;}
        .wrap{padding-bottom: 0px;}

        .content{display:none;z-index:10;}

        .layui-form-select .layui-input {
            padding-right: 30px;
            cursor: pointer;
            display: block;
        }

        .wechat-head {
            clear: both;
            width:100%;height:100px;font-size:15px;color: #fff;
            text-align:center;background-image:url('{{asset("assets/frontend/index/web/images/wechat/wechat-head.png")}}');
            background-repeat:no-repeat;background-size:100% 100%
        }

        .head-banner{
            display: block;
            background-position: center 0;
            background-image:url('{{asset("assets/frontend/index/wap/images/KV.png")}}');
            background-repeat:no-repeat;background-size:100% 100%
        }

       .wrap .site-desc {
           padding-top: 148px;
           color: #fff;
           height: 20px;
           line-height: 20px;
           width: 100%;
       }

        .product-datas {
            clear: both;
            border-bottom: 1px solid #fff;
            margin-bottom: 0px;
            background-color: #fff;
            height: 600px;
        }

        .environment {
            display: block;
            padding-bottom: 0px;
            text-align: center;
        }

        .product-datas h2 {
            text-align: center;
            color: #000;
            font-size: 22px;
            padding-top: 60px;
            margin-bottom:60px;
            font-family: PingFangSC-Regular, sans-serif;
        }

        .product-datas ul {
            zoom: 1;
            margin: 0 auto;
            display: block;
            margin-bottom: 16px;
        }

        .product-datas .environment.app ul li {
            width: 45%;
        }
        .product-datas .environment.app ul li {
            margin: 1px;
        }
        .product-datas .environment ul li {
            display: inline-block!important;
            float: none!important;
            text-align: center;
            border-radius: 2px;
            cursor: pointer;
            height: 120px;
            font-size: 12px;
            position: relative;
        }
        .product-datas .product-datas ul li {
            list-style: none;
            display: block;
            float: left;
            width: 10%;
            text-align: center;
        }

        .product-datas .environment h2 b {
            color: #3ea882;
            font-weight: 400;
            font-size: 48px;
            padding: 0 4px;
            font-family: PingFangSC-Regular, sans-serif;
        }

        .product-datas .environment ul b span{
            font-family: PingFangSC-Regular, sans-serif;
            font-size: 13px;
            display: block;
            -webkit-margin-before: 1em;
            -webkit-margin-after: 1em;
            -webkit-margin-start: 0px;
            -webkit-margin-end: 0px;
        }

        .product-datas .environment ul li i{
            display: block;
            height: 66px;
            width: 66px;
            margin: 1px auto;
            text-indent: -9999px;
        }

        .product-datas .environment b .advantage-one{background-size:100% 100%;background: url({{URL::asset('assets/frontend/index/wap/images/advantage/1.png')}});}
        .product-datas .environment b .advantage-tow{background-size:100% 100%;background: url({{URL::asset('assets/frontend/index/wap/images/advantage/2.png')}});}
        .product-datas .environment b .advantage-three{background-size:100% 100%;background: url({{URL::asset('assets/frontend/index/wap/images/advantage/3.png')}});}
        .product-datas .environment b .advantage-four{background-size:100% 100%;background: url({{URL::asset('assets/frontend/index/wap/images/advantage/4.png')}});}
        .product-datas .environment b .advantage-five{background-size:100% 100%;background: url({{URL::asset('assets/frontend/index/wap/images/advantage/5.png')}});}
        .product-datas .environment b .advantage-six{background-size:100% 100%;background: url({{URL::asset('assets/frontend/index/wap/images/advantage/6.png')}});}


        /** question **/

        .question-datas {
            clear: both;
            border-bottom: 2px solid #fff;
            margin-bottom: 0px;
            background-color: #f3f5f8;
            height: 1000px;
        }

        .question-datas .environment {
            display: block;
            padding-bottom: 0px;
            text-align: center;
        }

        .question-datas h2 {
            text-align: center;
            color: #000;
            font-size: 22px;
            padding-top: 60px;
            margin-bottom:40px;
            font-family: PingFangSC-Regular, sans-serif;
        }

        .question-datas h3 {
            text-align: center;
            color: #666;
            font-size: 18px;
            line-height: 26px;
            padding-top: 0px;
            margin-bottom:0px;
            font-family: PingFangSC-Regular, sans-serif;
        }

        .question-datas .main-part{
            padding-top: 45px;
            text-align: center;
            width: 100%;
            clear: both;
            margin: 0 auto;
            animation: b .4s ease-in-out 0s;
            -webkit-animation: b .4s ease-in-out 0s;
            animation-fill-mode: forwards;
            -webkit-animation-fill-mode: forwards;
        }

        .question-datas .main-part .main-left{
            text-align: center;
        }

        .question-datas .main-part .main-left ul li{
            clear: both;
            margin: 0 auto;
            height: 103px;
        }

        .question-datas .main-part .main-right{
            text-align: center;
        }

        .question-datas .main-part .main-left .tick{
            margin-top: 60px;
            text-align: left;
            float: left;
            width: 29px;
            margin-top: 4px;
        }

        .question-datas .main-part .main-left .lists{
            float: left;
            text-align: left;
            width: 80%;
        }

        .question-datas .main-part .main-left .lists .title{
            font-family: PingFangSC-Regular, sans-serif;
            font-size: 22px;
            color: #000;
            margin-top: 4px;
        }

        .question-datas .main-part .main-left .lists .content{
            display: block;
            font-family: PingFangSC-Regular, sans-serif;
            font-size: 16px;
            color: #666;
        }

        /** service **/

        .server-datas{clear: both;position: relative; height: 670px; text-align: center; overflow: hidden; background-color: #393D49;  }
        .server-datas .server-banner-bg,.server-datas .server-banner-main{position: absolute; left: 0; top: 0; width: 100%; height: 100%;}
        .server-datas .server-banner-bg{background-position: center 0;background-image: url({{URL::asset('assets/frontend/index/wap/images/server-banner.png')}});background-size: 100% 100%; background-color: #000;}
        .server-datas .server-desc h1{left: 0; width: 100%; color: #fff; font-style: normal;font-size: 28px;font-family: PingFangSC-Regular, sans-serif;padding-top: 60px;clear:both;}
        .server-datas .server-desc h2{line-height: 26px;left: 0; width: 100%; color: #fff; font-style: normal;font-size: 18px;font-family: PingFangSC-Regular, sans-serif;padding-top: 30px;clear:both;}
        .server-datas .server-flow {padding-top: 30px;margin: 0 20px;}
        .server-datas .server-flow .server-iamge{}

        /** team **/
        .team-datas {clear: both;position: relative; height: 480px; text-align: center; overflow: hidden; background-color: #fff;}
        .team-datas .team-main{position: absolute;left: 0; top: 0; width: 100%; height: 100%;}
        .team-datas .team-desc h1{left: 0; width: 100%; color: #000; font-style: normal;font-size: 22px;font-family: PingFangSC-Regular, sans-serif;padding-top: 50px;clear:both;}
        .team-datas .team-desc h2{margin-bottom: 30px;left: 0;line-height: 22px; width: 100%; color: #666; font-style: normal;font-size: 18px;font-family: PingFangSC-Regular, sans-serif;padding-top: 10px;clear:both;}

        /**** brand ****/
        .brand-datas {clear: both;position: relative; height: 990px; text-align: center; overflow: hidden; background-color: #fff;}
        .brand-datas .brand-main{position: absolute;left: 0; top: 0; width: 100%; height: 100%;}
        .brand-datas .brand-desc h1{left: 0; width: 100%; color: #000; font-style: normal;font-size: 28px;font-family: PingFangSC-Regular, sans-serif;padding-top: 32px;clear:both;margin-bottom: 40px;}
        .brand-datas .brand-desc h2{left: 0; width: 100%; color: #000; font-style: normal;font-size: 32px;font-family: PingFangSC-Regular, sans-serif;padding-top: 30px;clear:both;}

        .brand-datas .brand-flow {width: 920px;margin: 0 auto;margin-top: 50px;}

        .brand-datas .picScroll-left{overflow:hidden; position:relative;}
        .brand-datas .picScroll-left .hd{overflow:hidden;  height:60px; width: 173px;margin: 0 auto; background:#fff; padding:0px;}
        .brand-datas .picScroll-left .hd .prev{ display:block;  width:60px; height:60px; float:right;overflow:hidden;cursor:pointer; background:url("../images/prev.png") 0 0 no-repeat;}
        .brand-datas .picScroll-left .hd .next{ display:block;  width:60px; height:60px; float:right;overflow:hidden;cursor:pointer; background:url("../images/next.png") 0 0 no-repeat;}
        .brand-datas .picScroll-left .hd .prevStop{ background-position:-60px 0; }
        .brand-datas .picScroll-left .hd .nextStop{ background-position:-60px -50px; }
        .brand-datas .picScroll-left .hd ul{ float:right; overflow:hidden; zoom:1; margin: 25px auto; zoom:1;width:52px; height:60px;}
        .brand-datas .picScroll-left .hd ul li{ float:left;  width:8px; height:8px; overflow:hidden; margin-right:5px; text-indent:-999px; cursor:pointer; background:url("../images/pitch-no.png"); }
        .brand-datas .picScroll-left .bd{padding: 3px;width: 100%;;margin: 0 auto;}
        .brand-datas .picScroll-left .bd ul{ overflow:hidden; zoom:1; }
        .brand-datas .picScroll-left .bd ul li{ margin:0 8px; float:left; _display:inline; overflow:hidden; text-align:center;}
        .brand-datas .picScroll-left .bd ul li .pic{ text-align:center; }
        .brand-datas .picScroll-left .bd ul li .pic img{ width:220px; display:block;  padding:2px; border:1px solid #ccc;}
        .brand-datas .picScroll-left .bd ul li .pic a:hover img{ border-color:#999;  }
        .brand-datas .picScroll-left .bd ul li .title{ line-height:24px;}

        .brand-datas .brand-end h1{left: 0; width: 100%; color: #000; font-style: normal;font-size: 19px;font-family: PingFangSC-Regular, sans-serif;padding-top: 60px;clear:both;padding-bottom: 10px;}
        .brand-datas .brand-end h2{line-height: 24px;left: 0; width: 100%; color: #666; font-style: normal;font-size: 16px;font-family: PingFangSC-Regular, sans-serif;padding-top: 1px;clear:both;}
        .brand-datas .brand-end h3{left: 0; width: 100%; color: #999; font-style: normal;font-size: 16px;font-family: PingFangSC-Regular, sans-serif;padding-top: 30px;clear:both;}

        .brand-datas .brand-form{
            margin-top: 60px;
            height: 400px;
        }

        .brand-datas .brand-form .layui-input{
            height: 40px;
            line-height: 40px;
            background-color: #f3f5f8;
            font-family:  PingFangSC-Regular, sans-serif;
        }

        .brand-datas .brand-form .layui-inline{
            width: 560px;
        }

        .brand-datas .brand-form .layui-input-inline{
            width: 560px;
        }

        .brand-datas .brand-form  .brand-submit{
            height: 45px;
            font-family:  PingFangSC-Regular, sans-serif;
            font-size: 16px;
            background-color: #083680;
        }

        .brand-datas .brand-form  .brand-code{
            height: 60px;
            font-family:  PingFangSC-Regular, sans-serif;
            font-size: 24px;
            background-color: #083680;
        }

        /* banner-box */
        .banner-box{min-width:1210px;height:360px;position:relative;overflow:hidden;}
        .banner-box .bd{ width:100% !important;}
        .banner-box .bd li .m-width {width:1210px;margin:0 auto;overflow:hidden;}
        .banner-box .bd li{width:100% !important;height:360px;}
        .banner-box .bd li a{display:block;background-size:auto;}

        .banner-btn{width:1210px;position:absolute;top:120px;left:50%;margin-left:-605px;}
        .banner-btn a{display:block;width:49px;height:104px;position:absolute;top:0;filter:alpha(opacity=40);-moz-opacity:0.4;-khtml-opacity:0.4;opacity:0.4;}

        .banner-box .hd {position:absolute;top:210px;left:537px;}
        .banner-box .hd ul li{width:12px;height:12px;border-radius :50%;text-indent:-9999px;margin-right:20px;background:#ccc;float:left;cursor:pointer;}
        .banner-box .hd ul li.on{background:#DA324D;}

        .layui-form-item{
            margin-bottom: 25px;
        }

        .wrap .layui-main{margin-top: 60px; line-height: 22px;width: 100%}


        /***menu***/

        div.screen{
            width:100%;
            height:100%;
            overflow:hidden;
            position:absolute;
            top:0px;
            left:0px;
            clear: both;
        }

        .list{margin-top:36px; text-align:left;}
        .item{
            height:115px;.menu-splitR li:nth-of-type(3)
        margin-top:30px 0;
            padding-left:115px;
            clear:both;
        }
        .item .img, .item span{background:#214273; border-radius:3px;}
        .item .img{float:left; width:71px; height:71px; margin-left:-93px;}
        .item span{height:11px; width:180px; margin-bottom:19px; float:left;}
        .item span:nth-of-type(3){width:75px; margin-botom:0;}

        div.burger {
            height: 30px;
            width: 40px;
            position: absolute;
            top: 5px;
            left: 16px;
            cursor: pointer;
        }
        div.x,
        div.y,
        div.z {
            position: absolute; margin: auto;
            top: 0px; bottom: 0px;
            background: #fff;
            border-radius:2px;
            -webkit-transition: all 200ms ease-out;
            -moz-transition: all 200ms ease-out;
            -ms-transition: all 200ms ease-out;
            -o-transition: all 200ms ease-out;
            transition: all 200ms ease-out;
        }
        div.x, div.y, div.z { height: 3px; width: 26px; }
        div.y{top: 18px;}
        div.z{top: 37px;}
        div.collapse{
            top: 20px;
            -webkit-transition: all 70ms ease-out;
            -moz-transition: all 70ms ease-out;
            -ms-transition: all 70ms ease-out;
            -o-transition: all 70ms ease-out;
            transition: all 70ms ease-out;
        }


        div.rotate30{
            -ms-transform: rotate(30deg);
            -webkit-transform: rotate(30deg);
            transform: rotate(30deg);
            -webkit-transition: all 50ms ease-out;
            -moz-transition: all 50ms ease-out;
            -ms-transition: all 50ms ease-out;
            -o-transition: all 50ms ease-out;
            transition: all 50ms ease-out;
        }
        div.rotate150{
            -ms-transform: rotate(150deg);
            -webkit-transform: rotate(150deg);
            transform: rotate(150deg);
            -webkit-transition: all 50ms ease-out;
            -moz-transition: all 50ms ease-out;
            -ms-transition: all 50ms ease-out;
            -o-transition: all 50ms ease-out;
            transition: all 50ms ease-out;
        }

        div.rotate45{
            -ms-transform: rotate(45deg);
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
            -webkit-transition: all 100ms ease-out;
            -moz-transition: all 100ms ease-out;
            -ms-transition: all 100ms ease-out;
            -o-transition: all 100ms ease-out;
            transition: all 100ms ease-out;
        }
        div.rotate135{
            -ms-transform: rotate(135deg);
            -webkit-transform: rotate(135deg);
            transform: rotate(135deg);
            -webkit-transition: all 100ms ease-out;
            -moz-transition: all 100ms ease-out;
            -ms-transition: all 100ms ease-out;
            -o-transition: all 100ms ease-out;
            transition: all 100ms ease-out;
        }

        div.navbar{
            height:60px;background:#385e97;
            background-image:url({{asset('assets/frontend/index/wap/images/logo.png')}});
            background-size: 109px 18px;
            background-position: center;
            background-repeat: no-repeat
        }

        div.menu-bg{
            width: 100%;
            height: 100%;
            position:absolute;
            background:#000;
            opacity:0;
            -webkit-transition: all 300ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
            -moz-transition: all 300ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
            -ms-transition: all 300ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
            -o-transition: all 300ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
            transition: all 300ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
        }
        div.menu-bg.animate{
            opacity:0.9;
            -webkit-transition: all 400ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
            -moz-transition: all 400ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
            -ms-transition: all 400ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
            -o-transition: all 400ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
            transition: all 400ms cubic-bezier(0.000, 0.995, 0.990, 1.000);

        }
        div.menu {
            height: 568px;
            width: 160px;
        }
        .menu-splitL, .menu-splitR{
            overflow:hidden;
            position: absolute;
            top: 90px;
            left: 0px;
            width:160px;
        }
        .menu-splitR{left:160px;}

        div.menu ul li {
            list-style: none;
            width:320px;
            margin-top:30px;
            text-align:center;
            font-size:19px;
            -webkit-transition: all 150ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
            -moz-transition: all 150ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
            -ms-transition: all 150ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
            -o-transition: all 150ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
            transition: all 150ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
        }
        div.menu ul li a {
            color:#fff;
            text-transform:uppercase;
            text-decoration:none;
            letter-spacing:3px;
        }

        section > div {
            transition: transform 1s;
            transform: translateX(0px);
        }

        div.menu li.animate{
            font-size:19px;
            opacity:1;
            -webkit-transition: all 200ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
            -moz-transition: all 200ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
            -ms-transition: all 200ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
            -o-transition: all 200ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
            transition: all 200ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
        }

        .menu-splitL li:nth-of-type(1){	margin-left:44px;transition-delay: 0.12s;}
        .menu-splitL li.animate:nth-of-type(1){	margin-left:0;	transition-delay: 0.0s;	}

        .menu-splitL li:nth-of-type(2){	margin-left:57px;	transition-delay: 0.09s;}
        .menu-splitL li.animate:nth-of-type(2){	margin-left:0;	transition-delay: 0.05s;}

        .menu-splitL li:nth-of-type(3){	margin-left:57px;	transition-delay: 0.046s;}
        .menu-splitL li.animate:nth-of-type(3){	margin-left:0;	transition-delay: 0.1s;}

        .menu-splitL li:nth-of-type(4){	margin-left:61px;transition-delay: 0.03s;}
        .menu-splitL li.animate:nth-of-type(4){	margin-left:0;	transition-delay: 0.15s;}

        .menu-splitL li:nth-of-type(5){	margin-left:59px;	transition-delay: 0.0s;	}
        .menu-splitL li.animate:nth-of-type(5){	margin-left:0;	transition-delay: 0.2s;	}

        .menu-splitL li:nth-of-type(6){	margin-left:59px;	transition-delay: 0.0s;	}
        .menu-splitL li.animate:nth-of-type(6){	margin-left:0;	transition-delay: 0.2s;	}


        .menu-splitR li:nth-of-type(1){	margin-left:-201px;transition-delay: 0.12s;}
        .menu-splitR li.animate:nth-of-type(1){	margin-left:-160px;	transition-delay: 0.0s;	}

        .menu-splitR li:nth-of-type(2){	margin-left:-214px;	transition-delay: 0.069s;}
        .menu-splitR li.animate:nth-of-type(2){	margin-left:-160px;	transition-delay: 0.05s;}

        .menu-splitR li:nth-of-type(3){	margin-left:-214px;	transition-delay: 0.06s;}
        .menu-splitR li.animate:nth-of-type(3){	margin-left:-160px;	transition-delay: 0.1s;}

        .menu-splitR li:nth-of-type(4){	margin-left:-217px;transition-delay: 0.03s;}
        .menu-splitR li.animate:nth-of-type(4){	margin-left:-160px;	transition-delay: 0.15s;}

        .menu-splitR li:nth-of-type(5){	margin-left:-217px;	transition-delay: 0.0s;	}
        .menu-splitR li.animate:nth-of-type(5){	margin-left:-160px;	transition-delay: 0.2s;	}

        .menu-splitR li:nth-of-type(6){	margin-left:-217px;	transition-delay: 0.0s;	}
        .menu-splitR li.animate:nth-of-type(6){	margin-left:-160px;	transition-delay: 0.2s;	}


        /* slideBox -------------------------------------- */
        .slideBox{ position:relative; overflow:hidden; margin:10px auto;  max-width:720px;/* 设置焦点图最大宽度 */ }
        .slideBox .hd{ position:absolute; height:28px; line-height:28px; bottom:0; right:0; z-index:1; }
        .slideBox .hd li{ display:inline-block; width:5px; height:5px; -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; background:#333; text-indent:-9999px; overflow:hidden; margin:0 6px;   }
        .slideBox .hd li.on{ background:#fff;  }
        .slideBox .bd{ position:relative; z-index:0; }
        .slideBox .bd li{ position:relative; text-align:center;  }
        .slideBox .bd li img{ background:url(images/loading.gif) center center no-repeat;  vertical-align:top; width:100%;/* 图片宽度100%，达到自适应效果 */}
        .slideBox .bd li a{ -webkit-tap-highlight-color:rgba(0,0,0,0);  }  /* 去掉链接触摸高亮 */
        .slideBox .bd li .tit{ display:block; width:100%;  position:absolute; bottom:0; text-indent:10px; height:28px; line-height:28px; background:url(images/focusBg.png) repeat-x; color:#fff;  text-align:left;  }

        .picScroll{ margin:10px auto; text-align:center;  }
        .picScroll .bd ul{ width:100%;  float:left; padding-top:10px;  }
        .picScroll .bd li{ width:33%; float:left; font-size:14px; text-align:center;  }
        .picScroll .bd li a{-webkit-tap-highlight-color:rgba(0, 0, 0, 0); /* 取消链接高亮 */ }
        .picScroll .bd li img{ width:90px; height:68px;}
        .picScroll .hd{ height:40px; line-height:40px;background:#f6f6f6;overflow:hidden; text-align:left;  padding:0 10px;  }
        .picScroll .hd ul{ float:right; padding-top:16px; }
        .picScroll .hd li{
            float:left; width:8px; height:8px; background:#D0D0D0; margin:0 5px; overflow:hidden;
            -webkit-border-radius:8px; -moz-border-radius:8px; border-radius:8px;
        }
        .picScroll .hd .on{ background:#80BD6D;  }
        .picScroll .prev,.picScroll .next{ display:block; float:right;  width:18px; height:18px; background:url(images/pisScrollIcons.gif) -6px -7px no-repeat; overflow:hidden; margin:11px 5px 0 5px;  }
        .picScroll .next{ background-position:-34px -7px; }
        .picScroll .prevStop{ background-position:-6px -40px; }
        .picScroll .nextStop{ background-position:-34px -40px; }


        .layui-form-select .layui-input{
            padding-right: 30px;
            cursor: pointer;
            display: block;
        }
    </style>
    <div class="wrap">

        <div class="screen">
            <div class="navbar">
                <div style="float: right;font-size: 20px;margin-top: 16px;margin-right: 14px;">
                       <a href="{{url('index/en')}}" style="color: #fff">En</a>
                </div>
            </div>
            <div class="menu-bg"></div>
            <div class="menu">
                <ul class="menu-splitL">
                    <li><a href="#head-banner">首页</a></li>
                    <li><a href="#scrolltoProduct">我们的优势</a></li>
                    <li><a href="#scrolltoQuestion">解决的问题</a></li>
                    <li><a href="#scrolltoServer">服务流程</a></li>
                    <li><a href="#scrolltoTeams">核心团队</a></li>
                    <li><a href="#scrolltoBrand">服务咨询</a></li>
                </ul>
                <ul class="menu-splitR">
                    <li><a href="#head-banner">首页</a></li>
                    <li><a href="#scrolltoProduct">我们的优势</a></li>
                    <li><a href="#scrolltoQuestion">解决的问题</a></li>
                    <li><a href="#scrolltoServer">服务流程</a></li>
                    <li><a href="#scrolltoTeams">核心团队</a></li>
                    <li><a href="#scrolltoBrand">服务咨询</a></li>
                </ul>
            </div>
            <div class="burger">
                <div class="x"></div>
                <div class="y"></div>
                <div class="z"></div>
            </div>
        </div>

        <div style="clear: both; width:100%;height:320px;margin-top: 60px;" class="head-banner" id="head-banner">
            <div class="site-desc">
                <div style="margin: 0 auto;width: 90%;font-size: 22px;text-align: center">基于人工智能的品牌选址专家</div>
            </div>
        </div>

        <div class="product-datas clearfix">
            <div class="environment app clearfix" id="scrolltoProduct">
                <h2>NNDeal智能选址六大优势</h2>
                <ul>
                    <li><b><i class="advantage-one"></i><span>基于大数据选址</span></b></li>
                    <li><b><i class="advantage-tow"></i><span>准确的人群画像</span></b></li>
                </ul>
                <ul>
                    <li><b><i class="advantage-three"></i><span>快速获取目标房源</span></b></li>
                    <li><b><i class="advantage-four"></i><span>真实运营能力的预测</span></b></li>
                </ul>
                <ul>
                    <li><b><i class="advantage-five"></i><span>精准的品牌发展预测</span></b></li>
                    <li><b><i class="advantage-six"></i><span>最大限度提升开店成功率</span></b></li>
                </ul>
            </div>
        </div>

        <div class="question-datas clearfix">
            <div class="environment clearfix" id="scrolltoQuestion">
                <h2>NNDeal为您解决三大难题</h2>
                <h3>还在苦恼选择有效地址吗？</h3>
                <h3>还在烈日下艰难估算着有效客流吗？</h3>
                <h3>还在为盲目签约而吃亏吗？</h3>
                <div class="main-part">
                    <div class="main-right">
                        <img src="{{URL::asset('assets/frontend/index/web/images/question/question-three.png')}}" style="height: 300px;">
                    </div>
                    <div class="main-left">
                        <ul>
                            <li style="margin-top: 16px;margin-left: 16px;">
                                <div class="tick" style="margin-right: 10px;"><img src="{{URL::asset('assets/frontend/index/wap/images/question/tick.png')}}"></div>
                                <div class="lists">
                                    <div class="title">品牌定位模糊</div>
                                    <div class="content">资深顾问帮您理清品牌、市场、形象、价格、人群、渠道等各个问题，从而为开店选址指明方向。</div>
                                </div>
                            </li>
                            <li style="margin-top: 16px;margin-left: 16px;">
                                <div class="tick" style="margin-right: 10px;"><img src="{{URL::asset('assets/frontend/index/wap/images/question/tick.png')}}"></div>
                                <div class="lists">
                                    <div class="title">选址耗时耗力</div>
                                    <div class="content">基于城市大数据的人工智能为品牌高效匹配各项商业数据，快速定位城市机会点。</div>
                                </div>
                            </li>
                            <li  style="margin-top: 16px;margin-left: 16px;">
                                <div class="tick" style="margin-right: 10px;"><img src="{{URL::asset('assets/frontend/index/wap/images/question/tick.png')}}"></div>
                                <div class="lists">
                                    <div class="title">陷阱多爬坑难</div>
                                    <div class="content">凭借全球知名连锁企业的开店经验配合本土化信息确保店址评估、合作谈判、签约成交的顺利进行。</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="server-datas">
            <div class="server-banner-main server-banner-bg" id="scrolltoServer">
                <div class="server-desc">
                    <h1>服务流程</h1>
                    <h2>星巴克等知名连锁品牌都在<br>
                        使用的选址服务体系</h2>
                </div>
                <div class="server-flow">
                    <img src="{{URL::asset('assets/frontend/index/wap/images/server-flow.png')}}" alt="logo" class="server-iamge">
                </div>
            </div>
        </div>

        <div class="team-datas">
            <div class="team-main" id="scrolltoTeams">
                <div class="team-desc">
                    <h1>核心团队</h1>
                    <h2>商业地产选址专家，品牌规划专家，<br/>
                        大数据分析专家等各行业精英强强联手</h2>
                </div>

                <div id="slideBox" class="slideBox">
                    <div class="bd">
                        <ul>
                            <li>
                                <a class="pic" href="#"><img src="{{URL::asset('assets/frontend/index/wap/images/chengfeng.png')}}" /></a>
                                <a class="tit" href="#" style="display: none;"></a>
                            </li>
                            <li>
                                <a class="pic" href="#"><img src="{{URL::asset('assets/frontend/index/wap/images/lichaoyang.png')}}"/></a>
                                <a class="tit" href="#" style="display: none;"></a>
                            </li>
                            <li>
                                <a class="pic" href="#"><img src="{{URL::asset('assets/frontend/index/wap/images/lisiqi.png')}}"/></a>
                                <a class="tit" href="#" style="display: none;"></a>
                            </li>
                        </ul>
                    </div>
                    <div class="hd">
                        <ul style="margin-right: 15px;"></ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="brand-datas" id="scrolltoBrand">
            <div class="brand-main">
                <div class="brand-desc">
                    <h1>下一个品牌也许就是你</h1>
                </div>

                <div id="picScroll" class="picScroll">
                    <div class="bd">
                        <ul>
                            <li><a href="#"><img _src="{{URL::asset('assets/frontend/index/web/images/brand/1.png')}}" src="{{URL::asset('assets/frontend/index/web/images/brand/1.png')}}" /></a></li>
                            <li><a href="#"><img _src="{{URL::asset('assets/frontend/index/web/images/brand/2.png')}}" src="{{URL::asset('assets/frontend/index/web/images/brand/3.png')}}" /></a></li>
                            <li><a href="#"><img _src="{{URL::asset('assets/frontend/index/web/images/brand/3.png')}}" src="{{URL::asset('assets/frontend/index/web/images/brand/4.png')}}" /></a></li>
                        </ul>
                        <ul>
                            <li><a href="#"><img _src="{{URL::asset('assets/frontend/index/web/images/brand/4.png')}}" src="{{URL::asset('assets/frontend/index/web/images/brand/4.png')}}" /></a></li>
                            <li><a href="#"><img _src="{{URL::asset('assets/frontend/index/web/images/brand/5.png')}}" src="{{URL::asset('assets/frontend/index/web/images/brand/5.png')}}" /></a></li>
                            <li><a href="#"><img _src="{{URL::asset('assets/frontend/index/web/images/brand/6.png')}}" src="{{URL::asset('assets/frontend/index/web/images/brand/6.png')}}" /></a></li>
                        </ul>
                    </div>

                    <div class="hd">
                        <ul></ul>
                    </div>
                </div>

                <div class="brand-end">
                    <h1>想成为下一个大型知名连锁品牌吗？</h1>
                    <h2>填写联系信息，获取免费咨询服务<br>
                        一起共筑大型连锁品牌之梦</h2>
                </div>

                <div class="brand-form">
                    <div class="layui-form">

                        <div class="layui-form-item">
                            <div class="layui-inline" style="display: block;width: 85%;margin: 0 auto;margin-top: 10px;">
                                <select name="category" class="layui-input" id="data-category">
                                    <option value="">选择经营类别</option>

                                    @if(isset($category) && !empty($category))
                                        @foreach($category as $key=>$value)
                                            <option value="{{$value->id}}">{{$value->title}}</option>
                                        @endforeach
                                    @endif

                                </select>
                            </div>
                        </div>

                        <div class="layui-form-item">
                            <div class="layui-inline" style="display: block;width: 85%;margin: 0 auto;margin-top: 10px;border-radius: 5px;">
                                <input type="text" name="name" autocomplete="off" placeholder="请输入姓名" class="layui-input" id="data-name">
                            </div>
                        </div>


                        <div class="layui-form-item">
                            <div class="layui-inline" style="display: block;width: 85%;margin: 0 auto;margin-top: 10px;border-radius: 5px;">
                                <input type="text" name="brand" autocomplete="off" placeholder="请输入品牌名称" class="layui-input" id="data-brand">
                            </div>
                        </div>

                        <div class="layui-form-item">
                            <div class="layui-inline" style="display: block;width: 85%;margin: 0 auto;margin-top: 10px;border-radius: 5px;">
                                <input type="text" name="unit_price" autocomplete="off" placeholder="请输入客单价（元）" class="layui-input" id="data-unit-price">
                            </div>
                        </div>

                        <div class="layui-form-item">
                            <div class="layui-inline" style="display: block;width: 85%;margin: 0 auto;margin-top: 10px;border-radius: 5px;">
                                <input type="text" name="mobile" autocomplete="off" placeholder="请输入手机号码" class="layui-input" id="mobileData">
                            </div>
                        </div>

                        <div class="layui-form-item">
                            <div class="layui-inline" style="width: 85%;display: block;margin: 0 auto;margin-top: 10px;">
                        <span style="width: 60%;float: left;">
                            <input type="text" name="name" autocomplete="off" placeholder="请输入验证码" class="layui-input" id="verification-code">
                        </span>
                                <span class="layui-btn" id="brandCode" style="font-size: 16px;height:40px;line-height: 40px; float: left;width: 40%;background-color: #083680;color:#fff;">获取验证码</span>
                            </div>
                        </div>

                        <div class="layui-form-item" style="margin-top: 50px;clear: both;">
                            <div class="layui-input-block" style="margin-left: 0;">
                                <button class="layui-btn brand-submit" lay-submit=""  id="brand-submit">获取免费电话咨询服务</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="layui-footer footer footer-index" style="background-color: #f2f2f2">
            <div class="layui-main">

                <div style="margin: 0 auto;width: 90%;padding-top: 40px;padding-bottom:20px;color: #999;font-size: 13px;" >
                    <div>*NNDeal专业选址顾问曾任职于星巴克，PUMA等知名连锁企业，为其提供多年选址服务，图中所有品牌仅为其辅助说明，具体成功案例请参照相关说明页面。</div>
                </div>

                <HR style="FILTER: progid:DXImageTransform.Microsoft.Shadow(color:#987cb9,direction:145,strength:15);width: 90%;color:#987cb9;size: 1; margin: 0 auto;margin-top:10px;margin-bottom: 10px;">

                <div style="width: 90%;margin: 0 auto;color:#999;padding-bottom:20px;font-size: 13px;">
                    <div style="height: 20px;margin-top: 0px;">
                        <span style="float: left;">电话：010-58220156</span>
                        <span style="float: right;">周一至周日 8：00-22：00</span>
                    </div>
                    <div style="width: 80%;height: 20px;margin-top: 0px;float: left;">
                        <span style="float: left;">邮箱：bd@nndeal.com</span>
                    </div>
                </div>

                <HR style="FILTER: progid:DXImageTransform.Microsoft.Shadow(color:#987cb9,direction:145,strength:15);width: 90%;color:#987cb9;size: 1; margin: 0 auto;margin-top: 10px;">

                <div style="width: 90%;margin: 0 auto;margin-top: 20px;padding-bottom: 20px;color: #999;font-size: 13px;">
                    <div style="height: 20px;"><span style="float: left;margin-left: 5px;margin-right: 5px;">&copy; 2017 NNDeal.com 北京基石动力科技有限公司</span></div>
                </div>
            </div>
        </div>

        <script src="{{asset('assets/frontend/index/web/js/jquery-1.9.1.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/frontend/index/web/layui.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/frontend/index/wap/js/jquery.event.drag-1.5.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/frontend/index/wap/js/jquery.touchSlider.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/frontend/index/wap/js/jquery.SuperSlide.2.1.1.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/frontend/index/wap/js/TouchSlide.1.1.js')}}" type="text/javascript"></script>

        <script>

            layui.config({
                base: '/assets/frontend/index/web/lay/modules/'
                ,version: '1490981130731'
            }).use('global','jquery');

            $(document).ready(function(){
                $("#showButton").on('click',function () {

                    layui.use('layer', function(){
                        //示范一个公告层
                        layer.open({
                            type: 1,
                            title: false,
                            closeBtn: true,
                            shadeClose:true,
                            offset: [
                                ($(window).height() - 560)/2,
                            ],
                            shade: 0.5,
                            id: 'LAY_layuipro',
                            resize: false,
                            btnAlign: 'c',
                            moveType: 1, //拖拽模式，0或者1
                            content: $('.content'),
                            success: function(layero){
                                var btn = layero.find('.layui-layer-btn');
                            },
                            yes: function(layero){

                            }
                        });
                    });
                });

                $('#brand-submit').on('click',function () {
                    $.ajax({
                        type: 'POST',
                        url: '{{url("index/store")}}',
                        data: {type:1,'category':$("#data-category").val(),'verification':$("#verification-code").val(),'mobile':$('#mobileData').val(),'unit_price':$("#data-unit-price").val(),'brand':$("#data-brand").val(),'name':$("#data-name").val()},
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

                $("#brandCode").on('click',function () {
                    var mobileData = $("#mobileData").val();
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

            })


            $(document).ready(function(){

                $(".main_visual").hover(function(){
                    $("#btn_prev,#btn_next").fadeIn()
                },function(){
                    $("#btn_prev,#btn_next").fadeOut()
                });

                $dragBln = false;

                $(".main_image").touchSlider({
                    flexible : true,
                    speed : 200,
                    btn_prev : $("#btn_prev"),
                    btn_next : $("#btn_next"),
                    paging : $(".flicking_con a"),
                    counter : function (e){
                        $(".flicking_con a").removeClass("on").eq(e.current-1).addClass("on");
                    }
                });

                $(".main_image").bind("mousedown", function() {
                    $dragBln = false;
                });

                $(".main_image").bind("dragstart", function() {
                    $dragBln = true;
                });

                $(".main_image a").click(function(){
                    if($dragBln) {
                        return false;
                    }
                });

                timer = setInterval(function(){
                    $("#btn_next").click();
                }, 5000);

                $(".main_visual").hover(function(){
                    clearInterval(timer);
                },function(){
                    timer = setInterval(function(){
                        $("#btn_next").click();
                    },5000);
                });

                $(".main_image").bind("touchstart",function(){
                    clearInterval(timer);
                }).bind("touchend", function(){
                    timer = setInterval(function(){
                        $("#btn_next").click();
                    }, 5000);
                });

            });

            jQuery(".picScroll-left").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"left",autoPlay:true,vis:3});

            if ('ontouchstart' in window) {
                var click = 'touchstart';
            } else {
                var click = 'click';
            }
            $('div.burger').on(click, function () {
                if (!$(this).hasClass('open')) {
                    openMenu();
                } else {
                    closeMenu();
                }
            });
            $('div.menu ul li a').on(click, function (e) {
                e.preventDefault();
                closeMenu();
                location.hash=$(this).attr('href');
            });
            function openMenu() {
                $('div.menu-bg').addClass('animate');
                $('div.burger').addClass('open');
                $('div.x, div.z').addClass('collapse');
                $('.menu li').addClass('animate');
                setTimeout(function () {
                    $('div.y').hide();
                    $('div.x').addClass('rotate30');
                    $('div.z').addClass('rotate150');
                }, 70);
                setTimeout(function () {
                    $('div.x').addClass('rotate45');
                    $('div.z').addClass('rotate135');
                }, 120);
            }
            function closeMenu() {
                $('.menu li').removeClass('animate');
                setTimeout(function () {
                    $('div.burger').removeClass('open');
                    $('div.x').removeClass('rotate45').addClass('rotate30');
                    $('div.z').removeClass('rotate135').addClass('rotate150');
                    $('div.menu-bg').removeClass('animate');
                    setTimeout(function () {
                        $('div.x').removeClass('rotate30');
                        $('div.z').removeClass('rotate150');
                    }, 50);
                    setTimeout(function () {
                        $('div.y').show();
                        $('div.x, div.z').removeClass('collapse');
                    }, 70);
                }, 100);
            }

            TouchSlide({
                slideCell:"#slideBox",
                titCell:".hd ul", //开启自动分页 autoPage:true ，此时设置 titCell 为导航元素包裹层
                mainCell:".bd ul",
                effect:"leftLoop",
                autoPage:true,//自动分页
                autoPlay:true //自动播放
            });


            TouchSlide({
                slideCell:"#picScroll",
                titCell:".hd ul", //开启自动分页 autoPage:true ，此时设置 titCell 为导航元素包裹层
                autoPage:true, //自动分页
                pnLoop:"false", // 前后按钮不循环
                switchLoad:"_src" //切换加载，真实图片路径为"_src"
            });

            var windwidth = $(window).width();
            $('.picScroll .bd li').css('padding-left',((windwidth/3) -90)/2);
        </script>

        <script src="{{asset('assets/js/tongji.js')}}" type="text/javascript"></script>
    </div>

@stop