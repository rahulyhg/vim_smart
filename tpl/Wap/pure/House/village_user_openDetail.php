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
    <script src="{pigcms{$static_public}boxer/js/jquery.fs.boxer.js"></script>
    <link rel="stylesheet" href="{pigcms{$static_public}boxer/css/jquery.fs.boxer.css">
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
.jju {float:left; border-radius:10px; width:80px; height:25px; text-align:center; line-height:25px; background-color:#fb4746; color:#FFFFFF; margin-top:3px;}
.jju:hover {float:left; border-radius:10px; width:80px; height:25px; text-align:center; line-height:25px; background-color:#e12322; color:#FFFFFF; margin-top:3px;}

.jju_blue {float:left; border-radius:10px; width:80px; height:25px; text-align:center; line-height:25px; background-color:#0697dc; color:#FFFFFF; margin-top:3px;}
.jju_blue:hover {float:left; border-radius:10px; width:80px; height:25px; text-align:center; line-height:25px; background-color:#0083c1; color:#FFFFFF; margin-top:3px;}


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

        $('.boxer').boxer({
            mobile: true
        });
        $('.weui_btn_warn_blue').click(function(){
            window.history.go(-1);
        })

    })
</script>
<body>
<header class="pageSliderHide"><div id="backBtn"></div>访客信息</header>
<form id="access_form" onSubmit="return false;" >
<!--  <input  name=log_id" type="hidden" value="{pigcms{$log_info['log_id']}"/>-->
    <div class="shtx_dkx">
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="{pigcms{$static_path}images/q1.jpg" style="width:12px; height:15px; margin-top:10px;"/></div>
			<div class="kkw">姓名&nbsp;&nbsp;</div>
            <div class="shtx_kk"><!--刘德华-->{pigcms{$log_info.name}</div>
            <div class="both"></div>
        </div>
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="{pigcms{$static_path}images/q7.jpg" style="width:12px; height:12px; margin-top:11px;"/></div>
            <div class="kkw">开门时间&nbsp;&nbsp;</div>
            <div class="shtx_kk"><!--9527-->{pigcms{$log_info.opdate|date='Y-m-d H:i:s',###}</div>
            <div class="both"></div>
        </div>
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="{pigcms{$static_path}images/q2.jpg" style="width:10px; height:13px; margin-top:10px; margin-left:1px; margin-right:1px;"/></div>
            <div class="kkw">联系方式&nbsp;&nbsp;</div>
            <div class="shtx_kkt">{pigcms{$log_info.phone}&nbsp;&nbsp;&nbsp;&nbsp;</div>
			<a href="tel:{pigcms{$log_info.phone}" style="color:#fb4746;"><div class="jju_blue"><span style="float:left; margin-right:5px; margin-top:2px; margin-left:6px;"><img src="{pigcms{$static_path}images/ip7.png" style="width:12px; height:12px;"/></span><span style="float:left;">点击拨号</span></div></a>
            <div class="both"></div>
        </div>

    </div>
    <div class="shtx_dk2">
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="{pigcms{$static_path}images/q3.jpg" style="width:10px; height:14px; margin-top:9px; margin-left:1px; margin-right:2px;"/></div>
			<div class="kkw">设备名称&nbsp;&nbsp;</div>
            <div class="shtx_kk"><!--武汉邻钱科技有限公司-->{pigcms{$log_info.ac_name}
            </div>
            <div class="both"></div>
        </div>
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="{pigcms{$static_path}images/q4.jpg" style="width:10px; height:14px; margin-top:9px; margin-left:1px; margin-right:2px;"/></div>
			<div class="kkw">公司名称&nbsp;&nbsp;</div>
            <div class="shtx_kkb"><!--技术部-->{pigcms{$log_info.company_name}</div>
            <div class="both"></div>
        </div>
    </div>

    <div class="shtx_dk2">
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="{pigcms{$static_path}images/fww.png" style="width:11px; height:9px; margin-top:12px; margin-right:1px;"/></div>
            <div class="kkw">证件类型&nbsp;&nbsp;</div>
            <div class="shtx_kk"><if condition="$log_info.card_type eq 1">现场审核</if><if condition="$log_info.card_type eq 2">门禁卡</if><if condition="$log_info.card_type eq 3">身份证</if><if condition="$log_info.card_type eq 4">工作牌</if></div>
            <div class="both"></div>
        </div>

        <if condition="$log_info.card_type neq 1 and $log_info.card_type neq 4">
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="{pigcms{$static_path}images/q6.jpg" style="width:12px; height:11px; margin-top:11px;"/></div>
            <div class="kkw">证件号&nbsp;&nbsp;</div>
            <div class="shtx_kk"><!--9527-->{pigcms{$log_info.usernum}</div>
            <div class="both"></div>
        </div></if>

        <if condition="$log_info.card_type neq 1">
        <div class="weui_cellj">
			<div class="weui_cell_bd weui_cell_primary">
				<div class="weui_uploader">
					<div class="weui_uploader_hd weui_cell">
						<div class="shtx_pic"><img src="{pigcms{$static_path}images/lrr.jpg" style="width:12px; height:14px; margin-top:9px;"/></div>
						<div class="shtx_tyr">证件照（正面）</div>

						<div class="both"></div>
					</div>
					<!--<div class="weui_uploader_bd">
                        <ul class="weui_uploader_files">
                            <li class="weui_uploader_file" style="background:url(http://www.hdhsmart.com/tpl/Wap/pure/static/images/1.jpg)"></li>
                        </ul>
                        <div class="weui_uploader_input_wrp" id="upload_list">
                            <input class="weui_uploader_input" type="file" accept="image/jpg,image/jpeg,image/png,image/gif" multiple id="fileImage" name=""/>
                        </div>
                    </div>-->
					<div style="padding-bottom:5px;">
					<div class="upload_box">
                        <ul class="upload_list clearfix" id="upload_list">
                            <if condition="$log_info['workcard_img']">
                                <php>$workcard_img=explode('|',$log_info['workcard_img'])</php>
                                <volist name="workcard_img" id="img" key="k">
                                    <a href="/upload/house/{pigcms{$img}" class="boxer">
                                        <li class="upload_item" id="imgShow{pigcms{$k}" style="height:78px;background:url(./upload/house/{pigcms{$img}) 50% 50% / cover;">
                                            <img src="/upload/house/{pigcms{$img}" class="upload_image loading_img" />
                                        </li>
                                    </a>
                                </volist>
                            </if>
                        </ul>
					</div>
					</div>
				</div>
			</div>
		</div></if>
    </div>
    <div class="kdw2"><a href="javascript:;" class="weui_btn weui_btn_warn_blue eww">返 回</a></div>
</form>

</body>
</html>