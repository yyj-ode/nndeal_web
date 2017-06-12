http://code.ciaoca.com/jquery/transit/

jQuery Transit 使用 CSS3 的新特性来实现过渡效果，比默认的.animate方法要顺畅得多。
因为使用 CSS3 进行过渡效果，所以对不支持 CSS3 的浏览器效果有所下降。
语法和.animate方法相同，因此很好上手。
版本：
jQuery v1.4+
jQuery Transit v0.9.12
为 jQuery 的 .css 方法支持以下属性：
x (px)
y (px)
translate (x, y)
rotate (deg)
rotateX (deg)
rotateY (deg)
rotate3d (x, y, z, deg)
scale (x, [y])
perspective (px)
skewX (deg)
skewY (deg)
PS：对于使用连接符的属性需改为驼峰式写法，或者使用引号包括。如：padding-top属性需写为：paddingTop或者"padding-top"
查看 Demo
官网下载
jQuery Transit 0.9.12

使用方法
载入 JavaScript 文件
<script src='jquery.transit.js'></script>
转换属性
除 jQuery 原本支持的属性外，还新支持一些属性（使用.css方法不会进行动画效果，只是直接改变值）
$("#box").css({ x: '30px'});                        // 向右移动
$("#box").css({ y: '60px'});                        // 向下移动
$("#box").css({ translate: [60, 30]});              // 向右下移动
$("#box").css({ rotate: '30deg'});                  // 顺时针旋转
$("#box").css({ scale: 2});                         // 放大2倍 (200%)
$("#box").css({ scale: [2, 1.5]});                  // 宽度和高度不同的放大
$("#box").css({ skewX: '30deg'});                   // 水平斜切
$("#box").css({ skewY: '30deg'});                   // 垂直斜切
$("#box").css({ perspective: 100, rotateX: 30});    // Webkit 3d 旋转
$("#box").css({ rotateY: 30});
$("#box").css({ rotate3d: [1, 1, 0, 45]});
支持相对值
$("#box").css({ rotate: '+=30' });        // 增加30度
$("#box").css({ rotate: '-=30' });        // 减少30度
可以省略单位
$("#box").css({ x: '30px' });
$("#box").css({ x: 30 });
多个值时，可以是数组或者用逗号分隔
$("#box").css({ translate: [60,30] });
$("#box").css({ translate: ['60px','30px'] });
$("#box").css({ translate: '60px,30px' });
支持获取属性值（若属性有多个值，则返回数组）
$("#box").css('rotate');     //=> "30deg"
$("#box").css('translate');  //=> ['60px', '30px']
动画效果 - $.fn.transition
$('...').transition(options, [duration], [easing], [complete])
你可以使用$.fn.transition()来进行 css3 动画效果。他和$.fn.animate()的效果一样，只是他使用了 css3 过渡。
$("#box").transition({ opacity: 0.1, scale: 0.3 });
$("#box").transition({ opacity: 0.1, scale: 0.3 }, 500);                             // 动画时长
$("#box").transition({ opacity: 0.1, scale: 0.3 }, 'swing');                         // 缓动效果
$("#box").transition({ opacity: 0.1, scale: 0.3 }, 500, 'linear');                   // 动画时长 + 缓动效果
$("#box").transition({ opacity: 0.1, scale: 0.3 }, function(){});                    // 回调函数
$("#box").transition({ opacity: 0.1, scale: 0.3 }, 500, 'linear', function(){});     // 任意
也可以在参数中配置所有选项
$("#box").transition({
  opacity: 0.1, scale: 0.3,
  duration: 500,
  easing: 'linear',
  complete: function(){}
});