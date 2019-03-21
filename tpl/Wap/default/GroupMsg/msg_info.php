<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>群发消息</title>
    <link rel="stylesheet" href="//cdn.bootcss.com/weui/1.1.1/style/weui.min.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/jquery-weui/1.0.1/css/jquery-weui.min.css">
    <style>
        .container{  padding:15px;  background-color: #FFF;}
        .container img{ width:100% !important; margin: 0 auto;display: block}
    </style>

</head>
<body>
<div id="app">
    <div class="weui-form-preview">
        <!--    发起人-->
        <div class="weui-form-preview__bd">
            <div class="weui-form-preview__item">
                <label class="weui-form-preview__label">发起人</label>
                <span class="weui-form-preview__value">{{msg_info.publish_admin_name}}</span>
            </div>
            <div class="weui-form-preview__item">
                <label class="weui-form-preview__label">发布时间</label>
                <span class="weui-form-preview__value">
                {{}}
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

    <if condition="$info['remark']">
        <div class="weui-cells__title">退回修改意见    <if condition="$info['status'] eq 2"> （请在PC端后台进行修改）</if></div>
        <div class="weui-cells weui-cells_form" id="remark">
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <textarea class="weui-textarea" name="remark" readonly="readonly";placeholder="退回修改意见" rows="3">{pigcms{$info.remark}</textarea>
                    <div class="weui-textarea-counter">
                        <!--                <span>0</span>/200-->
                    </div>
                </div>
            </div>
        </div>
    </if>

    <!--底部-->
    <div class="weui-footer weui-footer_fixed-bottom">
        <div class="weui-form-preview__ft">
            <input type="hidden" name="msg_id" value="{pigcms{$info.id}">
            <button type="button" id="audit_1" name="status" value="1" class="weui-form-preview__btn weui-form-preview__btn_primary" href="javascript:">{pigcms{$info.status_name}
            </button>
        </div>
    </div>

    <!--查看详细-->

    <div id="msg_detail" class="weui-popup__container">
        <div class="weui-popup__overlay"></div>
        <div class="weui-popup__modal">
            <div class="container">
                {pigcms{$info.content}
            </div>
            <!--<div class="weui-form-preview__ft">
                <button type="button" class="weui-form-preview__btn weui-form-preview__btn_primary close-popup" href="javascript::">
                    关闭
                </button>
            </div>-->
        </div>

    </div>
</div>

<!-- body 最后 -->
<script src="//cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script src="//cdn.bootcss.com/jquery-weui/1.0.1/js/jquery-weui.min.js"></script>
<script src="./static/js/vue.min.js"></script>
<script src="./static/js/vue-route.js"></script>
<script src="./static/js/vue-resource.min.js"></script>
<script src="./static/js/vuex.js"></script>
<script>
    new Vue({
        el:'#app',
        data:{
            msg_info:app_json.msg_info,
        },
        mounted:function () {
            console.log(app_json)
        }
    });
</script>

</body>
</html>