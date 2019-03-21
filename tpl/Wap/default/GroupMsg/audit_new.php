<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>消息审核</title>
    <link rel="stylesheet" href="//cdn.bootcss.com/weui/1.1.1/style/weui.min.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/jquery-weui/1.0.1/css/jquery-weui.min.css">
    <style>
        .container{  padding:15px;  background-color: #FFF;}
        .container img{ width:100% !important; margin: 0 auto;display: block}
        .cw {width:100%; height:50px; overflow:hidden; line-height:50px; text-align:center; background-color:#efeff4; color:##0bb20c;}
        .cw:active {width:100%; height:50px; overflow:hidden; line-height:50px; text-align:center; background-color:#eeeeee; color:##0bb20c;}
        button.weui-form-preview__btn {
            background-color: transparent;
            border: 0;
            outline: 0;
            line-height: inherit;
            font-size: inherit;
            margin: 0px auto;
        }
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
                <label class="weui-form-preview__label">提交时间</label>
                <span class="weui-form-preview__value">
               <span >{{msg_info.up_date_str}}</span>
            </span>
            </div>
            <!--        群发类型-->
            <!--        <div class="weui-form-preview__item">-->
            <!--            <label class="weui-form-preview__label">群发类型</label>-->
            <!--            <span class="weui-form-preview__value">{pigcms{$info.msg_type_name}/{pigcms{$info.send_type_name}</span>-->
            <!--        </div>-->
            <!--        发布时间-->
            <div class="weui-form-preview__item">
                <label class="weui-form-preview__label">发送类型</label>
                <span class="weui-form-preview__value">
               <span v-if="msg_info.send_type=='moment'">{{msg_info.send_type_name}}</span>
                <span v-else>{{msg_info.send_type_name}}({{msg_info.send_date_str}})</span>
            </span>
            </div>
            <div class="weui-form-preview__item" v-show="msg_info.status!=0">
                <label class="weui-form-preview__label">发布时间</label>
                <span class="weui-form-preview__value">
               <span v-if="msg_info.status==1">{{msg_info.send_date_str}}</span>
                <span v-else>{{msg_info.status_name2}}</span>
            </span>
            </div>
            <!--        发布对象-->
            <div class="weui-form-preview__item">
                <label class="weui-form-preview__label">发布社区</label>
                <span class="weui-form-preview__value">{{msg_info.village_name}}</span>
            </div>
            <div class="weui-form-preview__item">
                <label class="weui-form-preview__label">发布公司</label>
                <span class="weui-form-preview__value">{{msg_info.company_name}}</span>
            </div>
            <div class="weui-form-preview__item">
                <label class="weui-form-preview__label">总人数</label>
                <span class="weui-form-preview__value">{{msg_info.ruser_num}}人</span>
            </div>
        </div>
    </div>
    <!--内容-->
    <div class="weui-panel weui-panel_access">
        <div class="weui-media-box weui-media-box_text">
            <h4 class="weui-media-box__title">{{msg_info.title}}</h4>
            <p class="weui-media-box__desc"><span v-html="msg_info.digest"></span></p>
        </div>
        <div class="weui-panel__ft">
            <a href="javascript:void(0);" data-target="#msg_detail" class="open-popup weui-cell weui-cell_access weui-cell_link">
                <div class="weui-cell__bd">查看全部</div>
            </a>
        </div>
    </div>
    <form action="{pigcms{:U('audit_act')}" method="post" id="frm1">
        <div class="weui-cells weui-cells_form" style="display: none" id="remark">
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <textarea class="weui-textarea" name="remark" placeholder="退回修改意见" rows="3"></textarea>
                    <div class="weui-textarea-counter">

                    </div>
                </div>
            </div>
        </div>
        <!--操作栏-->
        <div class="weui-footer weui-footer_fixed-bottom">
            <div class="weui-form-preview__ft">
                <input type="hidden" name="msg_id" v-bind:value="msg_info.msg_id">
                <button type="submit" id="audit_1" name="status" value="1" class="weui-form-preview__btn weui-form-preview__btn_primary" href="javascript:">
                    {{msg_info.status_name3}}
                </button>
                <button v-if="msg_info.status==1" @click="get_progress(msg_info.status)" type="button" id="audit_1" name="status" value="1" class="weui-form-preview__btn weui-form-preview__btn_default" href="javascript:">
                    查看进度
                </button>
                <button v-if="msg_info.status==0" type="submit" id="audit_2" name="status" value="2" class="weui-form-preview__btn weui-form-preview__btn_default" href="javascript:">
                    退回修改
                </button>
            </div>
        </div>
    </form>
    <!--查看详细-->
    <div id="msg_detail" class="weui-popup__container">
        <!--<div class="weui-popup__overlay"></div>-->
        <div class="weui-popup__modal">
            <!--<div class="container" style="height: 450px;">-->
            <div style="height: 90%;-webkit-overflow-scrolling: touch;overflow-y: scroll;" id="form">

            </div>
            <!--                <iframe src="{pigcms{:U('view_msg',array('msg_id'=>I('get.msg_id')))}" style="height: 100%;width: 100%;border-width: 0;"></iframe>
-->
            <!--<span v-html="msg_info.content"></span>-->
            <!--</div>-->
            <!--<div class="weui-form-preview__ft">
                <button type="submit" class="weui-form-preview__btn weui-form-preview__btn_primary close-popup" href="javascript:">
                    关闭
                </button>
            </div>-->
            <div class="cw" style="background-color: #FFFFFF">
                <button type="submit" class="weui-form-preview__btn weui-form-preview__btn_primary close-popup bg-font-blue-chambray" href="javascript:">
                    关闭
                </button>
            </div>
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
        },

        methods:{
            get_progress(status){
                if(status==1) {
                    var rop_href = "{pigcms{:U('send_ROP',$_GET)}";
                    window.location.href = rop_href;
                    return false;
                }
            }
        }
    });
    $.ajax({
        url:'{pigcms{:U('view_msg',array('msg_id'=>I('get.msg_id')))}',
        type:"GET",
        dataType:"html",
        success:function(result){
        console.log(result);
        $('#form').append(result);
        //获得内容可以用append插入对应的div中，也可以用html（value）直接添加
    }
    });
    //$("#form").empty.load('www.baidu.com');
    //审核通过
    var re = false;
    $('#audit_1').click(function(){
        if(app_json.msg_info.status_name3 != '确认发布'){
            alert("该消息"+app_json.msg_info.status_name3)
            return false;

        }
        if(re === false){
            $.confirm("发布后不可撤回，确认提交？",function(){
                re=true;
                $('#audit_1').click()
            })
        }
        return re;
    })

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

</script>
</body>
</html>