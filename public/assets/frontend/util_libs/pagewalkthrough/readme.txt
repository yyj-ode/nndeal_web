http://www.helloweba.com/view-blog-286.html

HTML
首先记得加载所需的css文件和jQuery库文件，以及pagewalkthrough插件。
<!-- CSS -->
<link type="text/css" rel="stylesheet" href="css/jquery.pagewalkthrough.css" />

<!-- jQuery -->
<script type="text/javascript" src="jquery.min.js"></script>
<!-- Page walkthrough plugin -->
<script type="text/javascript" src="jquery.pagewalkthrough.min.js"></script>
接着，我们在页面的最下部加入引导内容，就是每一步需要展示的内容，默认先隐藏内容，等会用jQuery调用。
<div id="walkthrough-content">
    <div id="walkthrough-1">
        <h3>欢迎来到Helloweba示例DEMO演示页</h3>

        <p>页面功能介绍引导页的效果是通过一款叫做pagewalkthrough.js的jQuery插件实现的。</p>
        <p>点击下一步了解更多...</p>
    </div>

    <div id="walkthrough-2">
        这里是Helloweba网站LOGO，点击这里可以直通网站首页。
    </div>

    <div id="walkthrough-3">
        点击这里可以直接看插件的使用教程。
    </div>

    <div id="walkthrough-4">
        点击这里去下载源码，免费的哦。。
    </div>

    <div id="walkthrough-5">
        这是页脚和版权信息。
    </div>
</div>
引导内容支持html内容，你可以在里面加入链接、图片等信息。还有就是引导页所需的箭头图片已经打包好，直接用css调用，关于字体，你可以调用外部字体，如手写字体可能效果更好。
jQuery
你完全可以在页面底部加入如下代码来调用pagewalkthrough，关键选项steps是一个数组，定义每一步引导调用的内容，参数wrapper定义了当前引导对应的元素位置，参数popup定义弹出提示引导层，参数content定义关联的内容元素，参数type定义弹出方式，包括tooltip和modal以及nohighlight三种方式，参数position定义了弹出层位置，包括top,left, right or bottom。
$(function() {
    $('body').pagewalkthrough({
        name: 'introduction',
        steps: [{
           popup: {
               content: '#walkthrough-1',
               type: 'modal'
           }
        }, {
            wrapper: '#logo',
            popup: {
                content: '#walkthrough-2',
                type: 'tooltip',
                position: 'bottom'
            }
        }, {
            wrapper: 'h2.top_title a',
            popup: {
                content: '#walkthrough-3',
                type: 'tooltip',
                position: 'bottom'
            }
        }, {
            wrapper: 'a[href="http://www.helloweba.com/down-286.html"]',
            popup: {
                content: '#walkthrough-4',
                type: 'tooltip',
                position: 'right'
            }
        }, {
            wrapper: '#footer p',
            popup: {
                content: '#walkthrough-5',
                type: 'tooltip',
                position: 'top'
            }
        }]
    });

    // Show the tour
    $('body').pagewalkthrough('show');
});