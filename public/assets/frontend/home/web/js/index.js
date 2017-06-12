/**
 * Created by lichunjing on 2017/5/5.
 */
// 点击用户弹出登录页面
$(".head").on("click","._user",function(){
    $(".mask").removeClass("none");
})
//打开页面3秒后弹窗消失
setTimeout(function () {
    $(".content .show .alert").addClass("none");
},3000);
//点击店址订阅
$(".head").on("click","._read",function(){
    $(".read").removeClass("none");
});
//鼠标移入 显示客服电话
$(".phone").mouseenter(function(e){
    $(this).addClass("phone_mouseover");
    $(".server_phone").removeClass("none");
});
$(".phone").mouseleave(function(e){
    $(this).removeClass("phone_mouseover");
    $(".server_phone").addClass("none");
});
//判断滚动高度 显示返回顶部
$(window).scroll(function(){
    var num = $(window).scrollTop();
    if(num>800){
        $(".return").fadeIn();
    }else{
        $(".return").fadeOut();
    }
});
//点击回到顶部
$(".return").on("click",".top",function (){
    window.scrollTo(0,0);
});
//取消登录
$(".login").on("click",".btn_one",function(){
    $(".mask").addClass("none");
});
//取消订阅
$(".shop_read").on("click",".btn_two",function(){
    $(".read").addClass("none");
});



//点击出现筛选框
$(document).on("click",".domain span",function(){
    $(".first").removeClass("none");
});
//鼠标划过出现二级联动
$(".all li").mouseenter(function(e){
    // if($(this).html()!=="全部"){
        $(".erji").removeClass("none");
        $(".erji").html($(this).find("ul").html());
    // }
});
//点击选中显示
$(document).on("click",".erji li",function(){
    $(".domain i").text(($(this).text()));
});
//鼠标移出
$(".first").mouseleave(function(e){
    $(this).addClass("none");
});


//点击出现筛选框2
$(document).on("click",".type span",function(){
    $(".second").removeClass("none");
});
//点击选中显示
$(document).on("click",".second ul li",function(){
    $(".type i").text(($(this).text()));
});
//鼠标移出
$(".second").mouseleave(function(e){
    $(this).addClass("none");
});

//点击出现筛选框3
$(document).on("click",".area span",function(){
    $(".third").removeClass("none");
});
//点击选中显示
$(document).on("click",".third ul li",function(){
    $(".area i").text(($(this).text()));
});
//鼠标移出
$(".third").mouseleave(function(e){
    $(this).addClass("none");
});

//点击出现筛选框4
$(document).on("click",".budget span",function(){
    $(".forth").removeClass("none");
});
//点击选中显示
$(document).on("click",".forth ul li",function(){
    $(".budget i").text(($(this).text()));
});
//鼠标移出
$(".forth").mouseleave(function(e){
    $(this).addClass("none");
});

//订阅选框~~~~~~~~~~

var click1 = 0;
var click2 = 0;
//一级
$(document).on("click",".shop_choice span",function(){
    //console.log($(this).parent())
    $(this).parent().find(".kuang").removeClass("none");
    alert(1)
});
//点击选中显示
$(document).on("click",".kuang>ul>li",function(){
	alert(2)
    click1 ++;
    //console.log($(this).parent().parent().parent().find("input").val(($(this).text())));
    // if(click1 == 1){
        $(this).parent().parent().parent().find("input").val(($(this).text()));
    // }else{
    //     console.log(888)
    // }
});
//二级
$(document).on("click",".list>.all>li",function(){
    //var oLi = $("<li>返回上一级</li>");
    //console.log($(this).children()[0]);
    //$(this).children().prepend(oLi);
    $(this).children().removeClass("none");
    alert(3)
});
//

$(document).on("click",".kuang>ul>li>.aa>li",function(){
    // click2 ++;
    // if(click2 == 1){
        if($(this).text()=="返回上一级"){
            console.log($(this).parent(".aa"))
            alert(4);
            $(this).parent(".aa").addClass("none");
            //$("._choice>ul>li").removeClass("none");
        }else{
            $(".dingwei").text($(this).text());
        }
    // }else{
    //     console.log(444)
    // }

});
//鼠标移出
$(".kuang").mouseleave(function(e){
    //$(this).addClass("none");
});
