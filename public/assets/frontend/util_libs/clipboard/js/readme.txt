http://www.helloweba.com/view-blog-327.html

首先加载本地clipboard.js文件。
<script src="clipboard.min.js"></script>
然后就是在body中加上要复制或剪切的文本域内容以及按钮。
<input id="foo" value="http://www.helloweba.com/demo/clipboard/">
<button class="btn" data-clipboard-target="#foo" aria-label="复制成功！">复制</button>

Javascript
将以下一句代码加入到</body>前的<script>里，保存打开浏览，点击按钮即可复制。
new Clipboard('.btn');
当然我们可以再进一步处理，比如当复制完成后，提示复制成功信息更友好些，只要执行以下代码即可：
var clipboard = new Clipboard('.btn');

clipboard.on('success', function(e) {
    var msg = e.trigger.getAttribute('aria-label');
    alert(msg);

    e.clearSelection();
});