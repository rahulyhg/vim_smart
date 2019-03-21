<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>绑定操作</title>
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
<style>
    body{text-align:center}

    .weui-form-preview{
        margin:0px auto !important;
    }
    /*#hht{width:160px; height:160px; margin:0px auto;}*/
</style>
<body>
<!--<div class="weui-form-preview">
    <a href="javascript:;" class="weui-btn weui-btn_default" id="hht"> <img src="{pigcms{$data.avatar}" style="width:100%; height:100%; border-radius: 50%;" /> &nbsp;{pigcms{$data.nickname}</a>
    <a href="javascript:;" class="weui-btn weui-btn_plain-default">{pigcms{$data.tenantname}</a>
    <if condition="$data['status'] eq 1">
        <a href="javascript:;" class="weui-btn weui-btn_disabled weui-btn_primary">已绑定</a>
        <else /><a href="javascript:;" class="weui-btn weui-btn_primary" onclick="bind(this)">确认绑定</a>
    </if>

</div>-->
<div class="weui-msg">
    <div class="weui-msg__icon-area"><img src="{pigcms{$data.avatar}" style="width:20%; height:20%; border-radius: 50%;margin: 0 auto;" /></div>
    <div class="weui-msg__text-area">
        <h2 class="weui-msg__title">{pigcms{$data.nickname}</h2>
        <if condition="$data['status'] eq 1">
            <p class="weui-msg__desc">您已经绑定了：<span style="color: blue">{pigcms{$data.tenantname}</span></p>
        <else/>
            <p class="weui-msg__desc">您绑定：<span style="color: blue">{pigcms{$data.tenantname}</span>失败，请联系客服。</p>
        </if>
        <p class="weui-msg__desc"><u>近期我们将上线微信缴费功能，敬请期待。</u></p>
    </div>
    <div class="weui-msg__opr-area">
        <p class="weui-btn-area">
<!--            <if condition="$data['status'] neq 1">-->
<!--            <a href="javascript:;" class="weui-btn weui-btn_primary" onclick="bind(this)">确认绑定</a>-->
<!--            </if>-->
            <a href="javascript:;" class="weui-btn weui-btn_default" id="close_window">关闭</a>
        </p>
    </div>
    <div class="weui-msg__extra-area">
        <div class="weui-footer">
            <p class="weui-footer__links">
                <a href="javascript:void(0);" class="weui-footer__link">武汉邻钱网络科技有限公司</a>
            </p>
            <p class="weui-footer__text">Copyright © 2015-2018 www.hdhsmart.com</p>
        </div>
    </div>
</div>


<div style="width:93%; margin:0px auto; height:30px; line-height:20px; color:#888; font-size:14px; font-weight:bold;">推广活动</div>
<!--<div style="width:93%; margin:0px auto;"><img src="{pigcms{$static_path}images/qwe.jpg" width="100%"/></div>-->
<div style="width:93%; margin:0px auto;"><a href="{pigcms{$adver_info['url']}"><img src="/upload/adver/{pigcms{$adver_info['pic']}" width="100%"/></a></div>
<script>
    // function bind(el) {
    //     var pigcms_id = "{pigcms{$data.pigcms_id}";
    //     var uid = "{pigcms{$data.uid}";
    //     $.ajax({
    //         url:"{pigcms{:U('pay_add_tenant_bind')}",
    //         type:'post',
    //         data:"pigcms_id="+pigcms_id+"&uid="+uid,
    //         success:function(re) {
    //             if (re == 1) {
    //                 $.toast("操作成功");
    //                 window.location.reload();
    //             } else {
    //                 $.toast("取消操作", "cancel");
    //             }
    //         }
    //     })
    // }

    var btn = document.getElementById('close_window');
    btn.onclick = function(){
        WeixinJSBridge.invoke('closeWindow',{},function(res){});
    }
</script>
</body>
</html>