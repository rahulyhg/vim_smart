<?php if(!defined('PigCms_VERSION')){ exit('deny access!');} ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title>消息审核</title>
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no, width=device-width"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name='apple-touch-fullscreen' content='yes'/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="format-detection" content="address=no"/>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/common.css?210"/>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/village.css?211"/>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/weui.css"/>
    <!--<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/example.css"/>-->
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/style.css"/>
    <script type="text/javascript" src="{pigcms{:C('JQUERY_FILE_190')}" charset="utf-8"></script>
    <script type="text/javascript" src="{pigcms{$static_path}js/fastclick.js" charset="utf-8"></script>
    <script type="text/javascript" src="{pigcms{$static_public}js/jquery.cookie.js" charset="utf-8"></script>
    <script type="text/javascript" src="{pigcms{$static_path}js/common.js" charset="utf-8"></script>
    <link rel="stylesheet" href="{pigcms{$static_public}boxer/css/jquery.fs.boxer.css">
    <!--<script src="{pigcms{$static_public}boxer/js/jquery-1.8.3.min.js"></script>-->
    <script src="{pigcms{$static_public}boxer/js/jquery.fs.boxer.js"></script>
    <style type="text/css">
        <!--
        .kkw {float:left; height:33px; line-height:33px; margin-left:10px; font-size:12px;}
        -->
    </style>
</head>
<script type="text/javascript">
    $(function(){
        $('#backBtn').click(function(){
            window.history.go(-1);
        })
    })
</script>
<script>
    $(function(){
        $('.boxer').boxer({
            mobile: true
        });
    });
</script>

<body>
<header class="pageSliderHide"><div id="backBtn"></div>消息审核</header>
<form id="access_form" action="{pigcms{:U('audit_group_msg_act')}" method="post">
    <div class="shtx_dkx">
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="{pigcms{$static_path}images/q1.jpg" style="width:12px; height:15px; margin-top:10px;"/></div>
            <div class="kkw">群发人&nbsp;&nbsp;</div>
            <div class="shtx_kk"><!--刘德华-->{pigcms{$info.publish_admin}</div>
            <div class="both"></div>
        </div>
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="{pigcms{$static_path}images/q6.jpg" style="width:12px; height:18px; margin-top:8px;"/></div>
            <div class="kkw">群发类型&nbsp;&nbsp;</div>
            <div class="shtx_kk"><!--18086681360-->{pigcms{$info.msg_type_name} / {pigcms{$info.send_type_name}</div>
            <div class="both"></div>
        </div>
    </div>
    <div class="shtx_dk2">
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="{pigcms{$static_path}images/q2.jpg" style="width:12px; height:16px; margin-top:8px;"/></div>
            <div class="kkw">发布时间&nbsp;&nbsp;</div>
            <div class="shtx_kk"><!--武汉微嗨科技有限公司-->
                <if condition="$info['send_time']">
                    {pigcms{$info.send_time|date="Y-m-d H:i",###}
                    <else />
                    未发送
                </if>
            </div>
            <div class="both"></div>
        </div>

        <div class="shtx_xm">
            <div class="shtx_pic"><img src="{pigcms{$static_path}images/q7.jpg" style="width:12px; height:18px; margin-top:8px;"/></div>
            <div class="kkw">发布对象&nbsp;&nbsp;</div>
            <div class="shtx_kk"><!--技术部-->{pigcms{$info.village_name} {pigcms{$info.company_name} （ 共{pigcms{$info.count_users} 人）</div>
            <div class="both"></div>
        </div>
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="{pigcms{$static_path}images/q5.jpg" style="width:12px; height:15px; margin-top:9px;"/></div>
            <div class="kkw">发布内容&nbsp;&nbsp;</div>
            <div class="both"></div>
        </div>

    </div>
    <!--    <div class="weui_cells weui_cells_form">-->
    <!--        <div class="weui_cell">-->
    <!--            <div class="weui_cell_bd weui_cell_primary">-->
    <!--                <div class="weui_uploader">-->
    <!--                    <div class="weui_uploader_hd weui_cell">-->
    <!--                        <div class="weui_cell_bd weui_cell_primary">相关图片</div>-->
    <!--                    </div>-->
    <!--                    <div class="upload_box">-->
    <!--                        <ul class="upload_list clearfix" id="upload_list">-->
    <!--                            <if condition="$info['pic']">-->
    <!--                                <volist name="info['pic']" id="img" key="k">-->
    <!--                                    <a href="{pigcms{$img}" class="boxer"><li class="upload_item" id="imgShow{pigcms{$k}" style="height:78px;background:url({pigcms{$img}) 50% 50% / cover;">-->
    <!--                                            <img src="{pigcms{$img}" class="upload_image loading_img" />-->
    <!--                                        </li></a>-->
    <!--                                </volist>-->
    <!--                            </if>-->
    <!--                        </ul>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <style>
        #desc_show{padding:10px;height:200px;overflow: hidden;position: relative}
        #desc_show img{
            width:80% !important;
        }
    </style>

    <div style="width:92%; margin:10px auto; margin-bottom:0px; background-color:#FFFFFF;border-radius: 10px;" id="desc_show">
        {pigcms{$info.content}
        <div style="padding:5px;position: absolute;bottom: 0;right: 0;z-index:9999;background-color: #fff0e2" id="show_all">展开查看</div>
    </div>
    <script>
        var show_all = false;
        $('#show_all').click(function(){
            if(!show_all){
                $('#desc_show').css("overflow","inherit").css("height","inherit");
                $(this).text("收起");
            }else{
                $(this).text("展开查看");
                $('#desc_show').css("overflow","hidden").css("height","200px");
            }
            show_all = !show_all;

        });
    </script>
    <div>{pigcms{$info.status_name}</div>
    <if condition="$info['status'] eq 2">
        <div>退回修改意见：</div>
        <div style="width:92%; margin:10px auto; margin-bottom:0px; background-color:#FFFFFF;border-radius: 10px;">
            <textarea readonly="readonly"  style="width:97%;height:50px; border:none; font-size:14px; line-height:25px; padding-left:5px;">{pigcms{$info.remark}</textarea>
        </div>
    </if>

    <script>
        $('#audit_2').click(function(){
            if($(this).attr("submit")=="true"){
                $(this).parents('form').submit();
            }else{
                $('#remark').show();
                $(this).text("确认退回");
                $(this).attr("submit","true");
                return false;
            }

        });
    </script>
    <div class="zkd"></div>


</form>
</body>
</html>