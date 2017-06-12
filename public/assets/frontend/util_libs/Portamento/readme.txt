http://code.ciaoca.com/jquery/portamento/
滑动定位
使用方法参数说明相关信息
使用方法
载入 JavaScript 文件
<script src="jquery.js"></script>
<script src="jquery.portamento.js"></script>
CSS 样式
/* 默认时的样式 */
#sidebar{}

/* 加载 Portamento 成功后的样式 */
#portamento_container{position:relative;z-index:99;}
#portamento_container #sidebar{}

/* 滑动时的样式 */
#portamento_container #sidebar.fixed{position:fixed;}
DOM 结构
<body>
  <div>正常布局或内容</div>
  <div id="sidebar">要滑动定位的元素</div>
</body>
调用 Portamento
$('#sidebar').portamento({
  gap: 0,
  disableWorkaround: true
});
参数说明
名称	默认值	说明
wrapper	$('body')	父容器
gap	10	与窗口顶部的边距 (px)
disableWorkaround	false	不支持旧的浏览器。

相关信息
作者网站：http://simianstudios.com/portamento/
相关文档：中文文档
授权协议：GPL