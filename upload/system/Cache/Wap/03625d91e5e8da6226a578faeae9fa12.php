<?php if (!defined('THINK_PATH')) exit(); if(!defined('PigCms_VERSION')){ exit('deny access!');} ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8" />
	<title><?php echo ($now_village["village_name"]); ?></title>
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width"/>
	<meta name="apple-mobile-web-app-capable" content="yes"/>
	<meta name='apple-touch-fullscreen' content='yes'/>
	<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
	<meta name="format-detection" content="telephone=no"/>
	<meta name="format-detection" content="address=no"/>
	<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/common.css?210"/>
	<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/village.css?211"/>		
	<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/weui.css"/>		
	<!--<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/example.css"/>-->
	<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/style.css"/>
	<script type="text/javascript" src="<?php echo C('JQUERY_FILE_190');?>" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo ($static_path); ?>js/fastclick.js" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.cookie.js" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo ($static_path); ?>layer/layer.m.js" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo ($static_path); ?>js/common.js" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo ($static_path); ?>js/village_control.js" charset="utf-8"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"><style type="text/css">
<!--
	.weui_btn:hover {color:#FFFFFF;}
-->
</style></head>
<script type="text/javascript">
var url_data="<?php echo U('House/SmsCodeverify',array('village_id'=>$now_village['village_id']));?>";
//var ac_id="<?php echo ($ac_id); ?>";
//if(ac_id){	//判断是否是扫设备码
	//var url_redirect="<?php echo U('House/access_control_open',array('village_id'=>$now_village['village_id'],'ac_id'=>$ac_id));?>";
//}
</script>
<body>
<header class="pageSliderHide"><div id="backBtn"></div>智能门禁</header>
<div class="sfrz_zkd"><img src="<?php echo ($static_path); ?>images/wr.jpg" style="width:100%;" /></div>
<form id="access_form" onSubmit="return false;">
<div class="shtx_dk">
	<div class="shtx_xm">
		<div class="shtx_pic"><img src="<?php echo ($static_path); ?>images/q1.jpg" style="width:12px; height:15px; margin-top:10px;"/></div>
		<!--<div class="shtx_kk"><input name="truename" type="text" value="请输入真实姓名" style="color:#ababab; border:none; width:90%; font-size:14px;" onClick="this.value=''"/>-->
		<div class="shtx_kk"><input name="truename" type="text" value="<?php echo ($user_info["name"]); ?>" style="color:#ababab; border:none; width:90%; font-size:14px;" placeholder="请输入真实姓名"/></div>
		<div style="float:right; color:#FF0000; padding-top:13px; font-size:14px; padding-right:15px;">*</div>
		<div class="both"></div>
	</div>
	<div class="shtx_xm">
		<div class="shtx_pic"><img src="<?php echo ($static_path); ?>images/q2.jpg" style="width:12px; height:18px; margin-top:8px;"/></div>
		<div class="shtx_kk"><input type="number" name="phone" value="<?php echo ($user_info["phone"]); ?>" style="color:#ababab;border:none;width:90%;font-size:14px;" placeholder="请输入手机号码" onFocus="focusPhone()" onBlur="blurPhone()"/></div>
		<div style="float:right; color:#FF0000; padding-top:13px; font-size:14px; padding-right:15px;">*</div>
		<div class="both"></div>
	</div>
	<div class="shtx_xm">
		<div class="shtx_pic"><img src="<?php echo ($static_path); ?>images/re.jpg" style="width:14px; height:18px; margin-top:8px;"/></div>
		<div class="shtx_kk" style="width:80%;">
			<input class="input-weak" name="vcode" type="text" placeholder="填写验证码" style="width:80px;height:25px; border:1px #CCCCCC solid;"/>
			<button type="button" onClick="sendsms(this)" class="btn-weak" style="height:25px; background-color:#ff777d; color:#FFFFFF; border:none;" id="send-code">获取验证码</button>
		</div>
		<div style="float:right; color:#FF0000; padding-top:13px; font-size:14px; padding-right:15px;">*</div>
		<div class="both"></div>
	</div>
</div>
<div class="shtx_dk2">
	<div class="shtx_xm">
		<div class="shtx_pic"><img src="<?php echo ($static_path); ?>images/q3.jpg" style="width:12px; height:16px; margin-top:8px;"/></div>
		<div class="shtx_kk"><input name="company" type="text" value="<?php echo ($user_info["company"]); ?>" style="color:#ababab; border:none; width:90%; font-size:14px;" placeholder="请输入来访公司名"/>
		</div>
		<div style="float:right; color:#FF0000; padding-top:13px; font-size:14px; padding-right:15px;">*</div>
		<div class="both"></div>
	</div>
	<div class="shtx_xm">
		<div class="shtx_pic"><img src="<?php echo ($static_path); ?>images/q6.jpg" style="width:12px; height:14px; margin-top:9px;"/></div>
		<div class="shtx_kk"><input type="text" name="id_card" value="<?php echo ($user_info["id_card"]); ?>" style="color:#ababab; border:none; width:90%; font-size:14px;" placeholder="请输入身份证号码"/></div>
		<div style="float:right; color:#FF0000; padding-top:13px; font-size:14px; padding-right:15px;">*</div>
		<div class="both"></div>
	</div>
</div>
<div class="zkd"><a href="javascript:;" class="weui_btn weui_btn_warn btn_access">提交</a></div>
</form>
<div id="loadingToast" class="weui_loading_toast" style="display:none;">
	<div class="weui_mask_transparent"></div>
	<div class="weui_toast" style="width:9.6em;min-height:9.6em;left:48%">
		<div class="weui_loading">
			<div class="weui_loading_leaf weui_loading_leaf_0"></div>
			<div class="weui_loading_leaf weui_loading_leaf_1"></div>
			<div class="weui_loading_leaf weui_loading_leaf_2"></div>
			<div class="weui_loading_leaf weui_loading_leaf_3"></div>
			<div class="weui_loading_leaf weui_loading_leaf_4"></div>
			<div class="weui_loading_leaf weui_loading_leaf_5"></div>
			<div class="weui_loading_leaf weui_loading_leaf_6"></div>
			<div class="weui_loading_leaf weui_loading_leaf_7"></div>
			<div class="weui_loading_leaf weui_loading_leaf_8"></div>
			<div class="weui_loading_leaf weui_loading_leaf_9"></div>
			<div class="weui_loading_leaf weui_loading_leaf_10"></div>
			<div class="weui_loading_leaf weui_loading_leaf_11"></div>
		</div>
		<p class="weui_toast_content">数据加载中</p>
	</div>
</div>
</body>
<script type="text/javascript" src="<?php echo ($static_public); ?>js/date/valid.js"></script>
</html>