<?php if(!defined('PigCms_VERSION')){ exit('deny access!');} ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8" />
	<title>{pigcms{$now_village.village_name}</title>
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no, width=device-width"/>
	<meta name="apple-mobile-web-app-capable" content="yes"/>
	<meta name='apple-touch-fullscreen' content='yes'/>
	<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
	<meta name="format-detection" content="telephone=no"/>
	<meta name="format-detection" content="address=no"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="{$Think.config.STATICS_URL}plublic/css/common.css"/>
	<link rel="stylesheet" type="text/css" href="{$Think.config.STATICS_URL}plublic/css/village.css"/>
	<link rel="stylesheet" type="text/css" href="{$Think.config.STATICS_URL}plublic/css/weui.css"/>
	<link rel="stylesheet" type="text/css" href="{$Think.config.STATICS_URL}plublic/css/animate.css"/><!--7.18晚-->
	<!--<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/example.css"/>-->
	<link rel="stylesheet" type="text/css" href="{$Think.config.STATICS_URL}plublic/css/kui.css"/>
	<style type="text/css">
		<!--
		.kkw {float:left; height:33px; line-height:33px; margin-left:10px; font-size:12px;}
		.shtx_kek {
    float: left;
    line-height: 33px;
    border: 0;
    font-size: 14px;
    margin-left: 8px;
    width: 60%;
    color: #b6b6b6;
	white-space:nowrap; 
	text-overflow:ellipsis; 
	-o-text-overflow:ellipsis; 
	overflow: hidden;
}
		-->
	</style>
</head>
<script>
	$(function(){
		$('.boxer').boxer({
			mobile: true
		});
	});
</script>

<body>
<header class="pageSliderHide"><div id="backBtn"></div>智能门禁</header>
<form id="access_form" onSubmit="return false;">
	<div class="shtx_dkx">
		<div class="shtx_xm">
			<div class="shtx_pic"><img src="{pigcms{$static_path}images/q1.jpg" style="width:12px; height:15px; margin-top:10px;"/></div>
			<div class="kkw">姓名&nbsp;&nbsp;</div>
			<div class="shtx_kk"><!--刘德华-->{pigcms{$user_info.name}</div>
			<div class="both"></div>
		</div>
		<div class="shtx_xm">
			<div class="shtx_pic"><img src="{pigcms{$static_path}images/q2.jpg" style="width:12px; height:18px; margin-top:8px;"/></div>
			<div class="kkw">联系方式&nbsp;&nbsp;</div>
			<div class="shtx_kk"><!--18086681360-->{pigcms{$user_info.phone}</div>
			<div class="both"></div>
		</div>
		<div class="shtx_xm">
			<div class="shtx_pic"><img src="{pigcms{$static_path}images/q3.jpg" style="width:12px; height:16px; margin-top:8px;"/></div>
			<div class="kkw">公司名称&nbsp;&nbsp;</div>
			<div class="shtx_kek">{pigcms{$user_info.company_name}
			</div>
			<div class="both"></div>
		</div>
	</div>
	<div class="shtx_dk2">
		<div class="shtx_xm">
			<div class="shtx_pic"><img src="{pigcms{$static_path}images/q3.jpg" style="width:12px; height:16px; margin-top:8px;"/></div>
			<div class="kkw">社区名称&nbsp;&nbsp;</div>
			<div class="shtx_kek">{pigcms{$user_info.village_name}
			</div>
			<div class="both"></div>
		</div>
		<div class="shtx_xm">
			<div class="shtx_pic"><img src="{pigcms{$static_path}images/fww.png" style="width:12px; height:10px; margin-top:12px;"/></div>
			<div class="kkw">证件类型&nbsp;&nbsp;</div>
			<div class="shtx_kk"><if condition="$user_info.card_type eq 1">现场审核</if><if condition="$user_info.card_type eq 2">门禁卡</if><if condition="$user_info.card_type eq 3">身份证</if><if condition="$user_info.card_type eq 4">工作牌</if></div>
			<div class="both"></div>
		</div>
		<if condition="$user_info.card_type neq 1 and $user_info.card_type neq 4">
		<div class="shtx_xm">
			<div class="shtx_pic"><img src="{pigcms{$static_path}images/q6.jpg" style="width:12px; height:14px; margin-top:9px;"/></div>
			<div class="kkw">证件号&nbsp;&nbsp;</div>
			<div class="shtx_kk"><!--9527-->{pigcms{$user_info.usernum}</div>
			<div class="both"></div>
		</div>
		</if>
	</div>
	<div style="width:92%; margin:10px auto; margin-bottom:0px; background-color:#FFFFFF;border-radius: 10px;" id="desc_show"><textarea id="description" name="ac_desc"  placeholder="请输入不通过原因" style="width:97%;height:50px; border:none; font-size:14px; line-height:25px; padding-left:5px;">{pigcms{$user_info.ac_desc}</textarea></div>
	<div class="zkd">
		<div style="float:left;width:48%;"><a href="javascript:;" class="weui_btn weui_btn_warn btn_check" data_status="2" data_idVal="{pigcms{$user_info.pigcms_id}" data_uid="{pigcms{$user_info.uid}">通过</a></div>
		<div style="float:right;width:48%;"><a href="javascript:;" class="weui_btn weui_btn_warn btn_check" data_status="3" data_idVal="{pigcms{$user_info.pigcms_id}" data_uid="{pigcms{$user_info.uid}">不通过</a></div>
		<div style="clear:both"></div>
	</div>
</form>
</body>
</html>