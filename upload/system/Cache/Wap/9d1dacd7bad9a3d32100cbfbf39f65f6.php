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
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<style type="text/css">
	.kdw2 {width:90%; margin:0px auto; padding-bottom:30px;}
	.eww:hover {color:#ffffff;}
	a, a:visited, a:hover {color:#fb4746;}
	</style>
</head>
<script type="text/javascript">
$(function(){
	$('#backBtn').click(function(){
		window.history.go(-1);
	});
	
	$('.close_eww').click(function(){	//关闭当前页
		WeixinJSBridge.call("closeWindow");
	});
})
</script>
<body>
<header class="pageSliderHide"><div id="backBtn"></div>智能门禁</header>
<div class="sfrz_zkd"><img src="<?php echo ($static_path); ?>images/qx.jpg" style="width:100%;" /></div>
<div class="shtx_dk">
	<div class="shtx_xm">
		<div class="shtxt_pic">姓名:</div>
	    <div class="shtxt_kk"><!--王朕--><?php echo ($user_info["name"]); ?></div>
		<div class="both"></div>
	</div>
	<div class="shtx_xm">
		<div class="shtxt_pic">公司:</div>
	    <div class="shtxt_kkt"><!--武汉微嗨科技有限公司--><?php echo ($user_info["company_name"]); ?></div>
		<div class="both"></div>
	</div>
	<div class="shtx_xm">
		<div class="shtxt_pic">手机:</div>
		<div class="shtxt_kk"><!--18086681360--><?php echo ($user_info["phone"]); ?></div>
		<div class="both"></div>
	</div>
	<!--<div class="shtx_xm">
		<div class="shtxt_pic">部门:</div>
	    <div class="shtxt_kk"><?php echo ($user_info["department"]); ?></div>
		<div class="both"></div>
	</div>-->
	<div class="shtx_xm">
		<div class="shtxt_picttt">证件类型:</div>
		<div class="shtxt_kk"><?php if($user_info["card_type"] == 1): ?>现场审核<?php endif; if($user_info["card_type"] == 2): ?>门禁卡<?php endif; if($user_info["card_type"] == 3): ?>身份证<?php endif; if($user_info["card_type"] == 4): ?>工作牌<?php endif; ?></div>
		<div class="both"></div>
	</div>
	<?php if($user_info["card_type"] != 1 and $user_info["card_type"] != 4): ?><div class="shtx_xm">
		<div class="shtxt_pictt">证件号:</div>
	    <div class="shtxt_kk"><!--100293--><?php echo ($user_info["usernum"]); ?></div>
		<div class="both"></div>
	</div><?php endif; ?>
</div>

<?php if($user_info["ac_status"] == 1): ?><div class="juk">我们会在一个工作日内帮你审核信息，如有疑问请拨打下方客服电话。</div>
<div class="zdb">客服电话：<a href="tel:027-87779655" style="color:#fb4746;">027-87779655</a></div>
<?php else: ?>
<div class="wr">
	<div class="wr2"><i class="weui_icon_warn"></i></div>
	<div class="wr3">很抱歉！您提交的信息没有通过审核，具体原因如下：</div>
	<div class="both"></div>
</div>
<div class="wr4"><!--您的手机号码有误！--><?php echo ($user_info["ac_desc"]); ?></div>
<div class="wr5"><a href="<?php echo U('House/village_access_control',array('village_id'=>$now_village['village_id'],'operat_type'=>'alter'));?>" class="weui_btn weui_btn_warn">返回修改</a></div><?php endif; ?>
<div class="kdw2"><a href="javascript:;" class="weui_btn weui_btn_warn close_eww">返 回</a></div>
</body>
</html>