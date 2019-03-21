<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>审核提醒</title>
    <!-- head 中 -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/weui/1.1.2/style/weui.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/jquery-weui/1.2.0/css/jquery-weui.min.css">

    <!-- body 最后 -->
    <script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/jquery-weui.min.js"></script>

    <!-- 如果使用了某些拓展插件还需要额外的JS -->
    <script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/swiper.min.js"></script>
    <script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/city-picker.min.js"></script>
</head>
<body>
    <div class="weui-form-preview">
        <div class="weui-form-preview__hd">
            <label class="weui-form-preview__label">审核提醒</label>
            <em class="weui-form-preview__value">&nbsp;&nbsp;&nbsp;&nbsp;</em>
        </div>
        <div class="weui-form-preview__bd">
            <div class="weui-form-preview__item">
                <label class="weui-form-preview__label">申请人昵称</label>
                <span class="weui-form-preview__value">{pigcms{$nickname}</span>
            </div>
            <div class="weui-form-preview__item">
                <label class="weui-form-preview__label">流程主题</label>
                <span class="weui-form-preview__value">绑定租户审核</span>
            </div>
            <div class="weui-form-preview__item">
                <label class="weui-form-preview__label">申请时间</label>
                <span class="weui-form-preview__value">{pigcms{$now_time}</span>
            </div>
        </div>
        <div class="weui-form-preview__ft">
            <a class="weui-form-preview__btn weui-form-preview__btn_primary" href="javascript:" onclick="adopt(this)">通过</a>
        </div>
    </div>


<script>
    function adopt(el) {
        var id = "{pigcms{$id}";
        $.ajax({
            url:"{pigcms{:U('send_content_adopt')}",
            type:'get',
            data:'id='+id,
            success:function(re) {
                if (re == 1) {
                    alert('审核通过');
                    $(el).parent().html("<button type=\"submit\" class=\"weui-form-preview__btn weui-form-preview__btn_default\" href=\"javascript:\">已通过</button>");
                } else {
                    alert('操作失败');
                    // console.log(re);
                }
            }
        })
    }
</script>
</body>
</html>