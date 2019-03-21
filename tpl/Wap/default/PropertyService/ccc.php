<html>
<body>
<meta charset="UTF-8">
<meta name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<!-- head 中 -->
<link rel="stylesheet" href="https://cdn.bootcss.com/weui/1.1.2/style/weui.min.css

">
<link rel="stylesheet" href="https://cdn.bootcss.com/jquery-weui/1.2.0/css/jquery-weui.min.css

">

<!-- body 最后 -->
<script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.min.js

"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/jquery-weui.min.js

"></script>

<!-- 如果使用了某些拓展插件还需要额外的JS -->
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/swiper.min.js

"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/city-picker.min.js

"></script>
<div class="weui-tab">
    <div class="weui-tab__bd">
        <div id="tab1" class="weui-tab__bd-item weui-tab__bd-item--active">
            <h1>页面一</h1>
        </div>
        <div id="tab2" class="weui-tab__bd-item">
            <h1>页面二</h1>
        </div>
        <div id="tab3" class="weui-tab__bd-item">
            <h1>页面三</h1>
        </div>
        <div id="tab4" class="weui-tab__bd-item">
            <h1>页面四</h1>
        </div>
    </div>

    <div class="weui-tabbar">
        <a href="#tab1" class="weui-tabbar__item weui-bar__item--on">
            <span class="weui-badge" style="position: absolute;top: -.4em;right: 1em;">8</span>
            <div class="weui-tabbar__icon">
                <img src="./images/icon_nav_button.png" alt="">
            </div>
            <p class="weui-tabbar__label">微信</p>
        </a>
        <a href="#tab2" class="weui-tabbar__item">
            <div class="weui-tabbar__icon">
                <img src="./images/icon_nav_msg.png" alt="">
            </div>
            <p class="weui-tabbar__label">通讯录</p>
        </a>
        <a href="#tab3" class="weui-tabbar__item">
            <div class="weui-tabbar__icon">
                <img src="./images/icon_nav_article.png" alt="">
            </div>
            <p class="weui-tabbar__label">发现</p>
        </a>
        <a href="#tab4" class="weui-tabbar__item">
            <div class="weui-tabbar__icon">
                <img src="./images/icon_nav_cell.png" alt="">
            </div>
            <p class="weui-tabbar__label">我</p>
        </a>
    </div>
</div>


</body>
</html>