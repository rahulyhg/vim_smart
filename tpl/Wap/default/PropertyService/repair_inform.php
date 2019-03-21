<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>在线报修详情</title>
    <link rel="stylesheet" href="//cdn.bootcss.com/weui/1.1.1/style/weui.min.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/jquery-weui/1.0.1/css/jquery-weui.min.css">
    <style>
        .container{  padding:15px;  background-color: #FFF;}
        .container img{ width:100% !important; margin: 0 auto;display: block}
    </style>

</head>
<body>
<div class="weui-form-preview">
    <!--    发起人-->
    <div class="weui-form-preview__bd">
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">发起人</label>
            <span class="weui-form-preview__value">{pigcms{$info.nickname}</span>
        </div>

        <!--        群发类型-->
        <!--        <div class="weui-form-preview__item">-->
        <!--            <label class="weui-form-preview__label">群发类型</label>-->
        <!--            <span class="weui-form-preview__value">{pigcms{$info.msg_type_name}/{pigcms{$info.send_type_name}</span>-->
        <!--        </div>-->
        <!--        发布时间-->
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">发布时间</label>
            <span class="weui-form-preview__value">
                {pigcms{$info.time|date="Y-m-d H:i",###}
            </span>
        </div>
        <!--        发布对象-->
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">发布社区</label>
            <span class="weui-form-preview__value">{pigcms{$info.village_name}</span>
        </div>
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">是否处理</label>
            <span class="weui-form-preview__value">
               <if condition="$info['is_read'] eq 1">
                   已处理
                <else />
                   未处理
               </if>
            </span>
        </div>
    </div>
</div>
<!--内容-->
<div class="weui-panel weui-panel_access">
    <div class="weui-media-box weui-media-box_text">
        <h4 class="weui-media-box__title">{pigcms{$info.content}</h4>
        <p class="weui-msg__desc"> <php>echo $info['details'];</php></p>
    </div>
    <div class="weui-media-box weui-media-box_text">
        <strong class="weui-media-box__title">附件</strong>
        <foreach name="info['pic']" item="p">
            <div>
                <img src="{pigcms{$p}" alt="" style="width:98%;margin:0 auto">
            </div>
        </foreach>
    </div>
    <div style="height:5rem"></div>

</div>
<form action="" method="post">
    <!--操作栏-->
    <div class="weui-footer weui-footer_fixed-bottom">
        <div class="weui-form-preview__ft">
            <a
                class="weui-form-preview__btn weui-form-preview__btn_default"
                href="{pigcms{:U('repair_list')}"
                style="background-color:#fff">
                返回列表
            </a>

            <if condition="!$info['is_read']">
                <button
                    id="audit"
                    type="button"
                    class="weui-form-preview__btn weui-form-preview__btn_primary"
                    href="{pigcms{:U('audit_repair',array('repair_id'=>I('get.repair_id')))}"
                    style="background-color:#fff">
                    标记为已处理
                </button>
            </if>

        </div>
    </div>
</form>
<!-- body 最后 -->
<script src="//cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script src="//cdn.bootcss.com/jquery-weui/1.0.1/js/jquery-weui.min.js"></script>
<script>
    $('#audit').click(function(){
        window.location.href = $(this).attr("href");
    });
</script>
</body>
</html>