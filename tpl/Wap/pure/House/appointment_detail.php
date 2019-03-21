<?php if(!defined('PigCms_VERSION')){ exit('deny access!');} ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title>在线预约</title>
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
<header class="pageSliderHide"><div id="backBtn"></div>在线预约</header>
<form id="access_form" onSubmit="return false;">
    <div class="shtx_dkx">
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="{pigcms{$static_path}images/q1.jpg" style="width:12px; height:15px; margin-top:10px;"/></div>
            <div class="kkw">预约用户名&nbsp;&nbsp;</div>
            <div class="shtx_kk"><!--刘德华-->{pigcms{$info.name}</div>
            <div class="both"></div>
        </div>
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="{pigcms{$static_path}images/q6.jpg" style="width:12px; height:18px; margin-top:8px;"/></div>
            <div class="kkw">预约手机&nbsp;&nbsp;</div>
            <div class="shtx_kk"><!--18086681360-->{pigcms{$info.contact}</div>
            <div class="both"></div>
        </div>
    </div>
    <div class="shtx_dk2">
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="{pigcms{$static_path}images/q2.jpg" style="width:12px; height:16px; margin-top:8px;"/></div>
            <div class="kkw">预约类型&nbsp;&nbsp;</div>
            <div class="shtx_kk"><!--武汉邻钱科技有限公司-->{pigcms{$info.meal_name}
            </div>
            <div class="both"></div>
        </div>
        <if condition="$info['appointment_start_time']">
            <div class="shtx_xm">
                <div class="shtx_pic"><img src="{pigcms{$static_path}images/q7.jpg" style="width:12px; height:18px; margin-top:8px;"/></div>
                <div class="kkw">起始时间&nbsp;&nbsp;</div>
                <div class="shtx_kk"><!--技术部-->{pigcms{$info.appointment_start_time|date='Y-m-d H:i',###}</div>
                <div class="both"></div>
            </div>
            <div class="shtx_xm">
                <div class="shtx_pic"><img src="{pigcms{$static_path}images/q5.jpg" style="width:12px; height:15px; margin-top:9px;"/></div>
                <div class="kkw">结束时间&nbsp;&nbsp;</div>
                <div class="shtx_kk"><!--广发银行大厦2008-->{pigcms{$info.appointment_end_time|date='Y-m-d H:i',###}</div>
                <div class="both"></div>
            </div>
        </if>
    </div>
    <div class="weui_cells weui_cells_form">
        <div class="weui_cell">
            <div class="weui_cell_bd weui_cell_primary">
                <div class="weui_uploader">
                    <div class="weui_uploader_hd weui_cell">
                        <div class="weui_cell_bd weui_cell_primary">相关图片</div>
                    </div>
                    <div class="upload_box">
                        <ul class="upload_list clearfix" id="upload_list">
                            <if condition="$info['pic']">
                                <volist name="info['pic']" id="img" key="k">
                                    <a href="{pigcms{$img}" class="boxer"><li class="upload_item" id="imgShow{pigcms{$k}" style="height:78px;background:url({pigcms{$img}) 50% 50% / cover;">
                                            <img src="{pigcms{$img}" class="upload_image loading_img" />
                                        </li></a>
                                </volist>
                            </if>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="width:92%; margin:10px auto; margin-bottom:0px; background-color:#FFFFFF;border-radius: 10px;" id="desc_show"><textarea id="description" name="content" readonly="readonly"  placeholder="报修内容" style="width:97%;height:50px; border:none; font-size:14px; line-height:25px; padding-left:5px;">
            {pigcms{$info.content}
        </textarea>
    </div>
    <div class="zkd"></div>
</form>
</body>
</html>