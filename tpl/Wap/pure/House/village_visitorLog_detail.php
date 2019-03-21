<?php if(!defined('PigCms_VERSION')){ exit('deny access!');} ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title>{pigcms{$now_village.village_name}</title>
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name='apple-touch-fullscreen' content='yes'/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="format-detection" content="address=no"/>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/common.css?210"/>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/village.css?211"/>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/weui.css"/>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/example.css"/>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/style.css"/>
    <script type="text/javascript" src="{pigcms{:C('JQUERY_FILE_190')}" charset="utf-8"></script>
    <script type="text/javascript" src="{pigcms{$static_path}js/fastclick.js" charset="utf-8"></script>
    <script type="text/javascript" src="{pigcms{$static_public}js/jquery.cookie.js" charset="utf-8"></script>
    <script type="text/javascript" src="{pigcms{$static_path}layer/layer.m.js" charset="utf-8"></script>
    <script type="text/javascript" src="{pigcms{$static_path}js/common.js" charset="utf-8"></script>
    <script type="text/javascript" src="{pigcms{$static_path}js/exif.js" charset="utf-8"></script>
    <!--<script type="text/javascript" src="{pigcms{$static_path}js/imgUploadControl.js" charset="utf-8"></script>-->
    <script type="text/javascript" src="{pigcms{$static_path}js/zepto.min.js" charset="utf-8"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"><style type="text/css">
        <!--
        .kkw {float:left; height:33px; line-height:33px; margin-left:10px; font-size:12px;}
        .shtx_kkt {float:left; line-height:33px; border:0; height:33px; font-size:14px; margin-left:8px; color:#b6b6b6;}
        .shtx_tyr {
            float: left;
            line-height: 26px;
            border: 0;
            height: 33px;
            font-size: 14px;
            margin-left: 8px;
            width: 65%;
        }
        .kdw2 {width:90%; margin:0px auto; padding-bottom:30px;}
        .shtx_kkb {
            float: left;
            line-height: 33px;
            border: 0;
            font-size: 14px;
            margin-left: 8px;
            width: 65%;
            color: #b6b6b6;
            white-space:nowrap;
            text-overflow:ellipsis;
            -o-text-overflow:ellipsis;
            overflow: hidden;
        }
        .weui_cell {
            padding-bottom:0px;
            position: relative;
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -webkit-align-items: center;
            -ms-flex-align: center;
            align-items: center;
        }
        .jju {float:left; border-radius:10px; width:80px; height:25px; text-align:center; line-height:25px; background-color:#0697dc; color:#FFFFFF; margin-top:3px;}
        .jju:hover {float:left; border-radius:10px; width:80px; height:25px; text-align:center; line-height:25px; background-color:#e12322; color:#FFFFFF; margin-top:3px;}
		
		a, a:visited, a:hover {
			color: #FFFFFF;
			text-decoration: none;
			outline: 0;
		}
        -->
    </style></head>
<script type="text/javascript">
    $(function(){
        $('#backBtn').click(function(){
            window.history.go(-1);
        });

        $('.weui_btn_warn_blue').click(function(){
            window.history.go(-1);
        })

    })
</script>
<body>
<header class="pageSliderHide"><div id="backBtn"></div>访客登记</header>
<form id="access_form" onSubmit="return false;" >
    <!--  <input  name=log_id" type="hidden" value="{pigcms{$visitor_info['log_id']}"/>-->
    <div class="shtx_dkx">
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="{pigcms{$static_path}images/q1.jpg" style="width:12px; height:12px; margin-top:11px;"/></div>
            <div class="kkw">真实姓名&nbsp;&nbsp;</div>
            <div class="shtx_kk"><!--9527-->{pigcms{$visitor_info.name}</div>
            <div class="both"></div>
        </div>
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="{pigcms{$static_path}images/q2.jpg" style="width:10px; height:13px; margin-top:10px; margin-left:1px; margin-right:1px;"/></div>
            <div class="kkw">联系方式&nbsp;&nbsp;</div>
            <div class="shtx_kkt">{pigcms{$visitor_info.phone}&nbsp;&nbsp;&nbsp;&nbsp;</div>
            <a href="tel:{pigcms{$visitor_info.phone}" style="color:#fb4746;"><div class="jju"><span style="float:left; margin-right:5px; margin-top:2px; margin-left:6px;"><img src="{pigcms{$static_path}images/ip7.png" style="width:12px; height:12px;"/></span><span style="float:left;">点击拨号</span></div></a>
            <div class="both"></div>
        </div>

    </div>
    <div class="shtx_dk2">
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="{pigcms{$static_path}images/q6.jpg" style="width:10px; height:14px; margin-top:9px; margin-left:1px; margin-right:2px;"/></div>
            <div class="kkw">身份证号&nbsp;&nbsp;</div>
            <div class="shtx_kk"><!--武汉邻钱科技有限公司-->{pigcms{$visitor_info.id_card}
            </div>
            <div class="both"></div>
        </div>
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="{pigcms{$static_path}images/q4.jpg" style="width:10px; height:14px; margin-top:9px; margin-left:1px; margin-right:2px;"/></div>
            <div class="kkw">到访公司&nbsp;&nbsp;</div>
            <div class="shtx_kkb"><!--技术部-->{pigcms{$visitor_info.company}</div>
            <div class="both"></div>
        </div>
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="{pigcms{$static_path}images/q7.jpg" style="width:10px; height:14px; margin-top:9px; margin-left:1px; margin-right:2px;"/></div>
            <div class="kkw">登记时间&nbsp;&nbsp;</div>
            <div class="shtx_kkb"><!--技术部-->{pigcms{$visitor_info.add_time|date='Y-m-d H:i:s',###}</div>
            <div class="both"></div>
        </div>
    </div>


    <div class="kdw2"><a href="javascript:;" class="weui_btn weui_btn_warn_blue eww">返 回</a></div>
</form>

</body>
</html>