<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>消息审核</title>
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
            <span class="weui-form-preview__value">{pigcms{$info.publish_admin}</span>
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
                <if condition="$info['send_time'] gt 0">
                    {pigcms{$info.send_time|date="Y-m-d H:i",###}（{pigcms{$info.send_type_name}）
                    <else />
                    {pigcms{$info.send_type_name}
                </if>
            </span>
        </div>
<!--        发布对象-->
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">发布社区</label>
            <span class="weui-form-preview__value">{pigcms{$info.village_name}</span>
        </div>
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">发布公司</label>
            <span class="weui-form-preview__value">{pigcms{$info.company_name}</span>
        </div>
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">总人数</label>
            <span class="weui-form-preview__value">{pigcms{$info.count_users}人</span>
        </div>
    </div>
</div>
<!--内容-->
<div class="weui-panel weui-panel_access">
    <div class="weui-media-box weui-media-box_text">
        <h4 class="weui-media-box__title">{pigcms{$info.title}</h4>
        <p class="weui-media-box__desc"> <php>echo strip_tags($info['content']);</php></p>
    </div>
    <div class="weui-panel__ft">
        <a href="javascript:void(0);" data-target="#msg_detail" class="open-popup weui-cell weui-cell_access weui-cell_link">
            <div class="weui-cell__bd">查看全部</div>
        </a>
    </div>
</div>
<form action="{pigcms{:U('audit_group_msg_act')}" method="post" id="frm1">
<div class="weui-cells weui-cells_form" style="display: none" id="remark">
    <div class="weui-cell">
        <div class="weui-cell__bd">
            <textarea class="weui-textarea" name="remark" placeholder="退回修改意见" rows="3"></textarea>
            <div class="weui-textarea-counter">
<!--                <span>0</span>/200-->
            </div>
        </div>
    </div>
</div>
<!--操作栏-->
<div class="weui-footer weui-footer_fixed-bottom">
    <div class="weui-form-preview__ft">
        <input type="hidden" name="msg_id" value="{pigcms{$info.id}">
        <button type="submit" id="audit_1" name="status" value="1" class="weui-form-preview__btn weui-form-preview__btn_primary" href="javascript:">
            确认并发布
        </button>
        <button type="submit" id="audit_2" name="status" value="2" class="weui-form-preview__btn weui-form-preview__btn_default" href="javascript:">
            退回修改
        </button>
    </div>
</div>
</form>
<!--查看详细-->

<div id="msg_detail" class="weui-popup__container">
    <div class="weui-popup__overlay"></div>
    <div class="weui-popup__modal">
        <div class="container">
            {pigcms{$info.content}
        </div>
        <div class="weui-form-preview__ft">
            <button type="submit" class="weui-form-preview__btn weui-form-preview__btn_primary close-popup" href="javascript:">
                关闭
            </button>
        </div>
    </div>

</div>
<!-- body 最后 -->
<script src="//cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script src="//cdn.bootcss.com/jquery-weui/1.0.1/js/jquery-weui.min.js"></script>
<script>
    $('#audit_2').click(function(){
        if($(this).attr("submit")!=1){
            $(this).attr("submit",1);
            $(this).text("确认退回");
            $('#remark').slideDown();
            return false;
        };
        var remark = $('textarea[name="remark"]');
        if(!remark.val()){
            $.alert("退回修改意见未填写");
            return false;
        }

    });
    //审核通过
    var re = false;
    $('#audit_1').click(function(){
        if(re === false){
            $.confirm("发布后不可撤回，确认提交？",function(){
                re=true;
                $('#audit_1').click()
            })
        }
        return re;
    })

</script>
</body>
</html>