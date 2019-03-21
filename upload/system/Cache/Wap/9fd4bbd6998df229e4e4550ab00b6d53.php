<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<title>智能门禁</title>
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width"/>
<meta name="apple-mobile-web-app-capable" content="yes"/>
<meta name='apple-touch-fullscreen' content='yes'/>
<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
<meta name="format-detection" content="telephone=no"/>
<meta name="format-detection" content="address=no"/>
<link href="<?php echo ($static_path); ?>css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo ($static_path); ?>css/weui.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/common.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/village.css"/>
<script type="text/javascript" src="<?php echo C('JQUERY_FILE_190');?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>js/fastclick.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>js/common.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>js/exif.js" charset="utf-8"></script>
<script type="text/javascript">
$(function(){
	$('#backBtn').click(function(){
		//window.history.go(-1);
		WeixinJSBridge.call("closeWindow");
	});
	
	$('.weui_btn').click(function(){	//关闭当前页
		WeixinJSBridge.call("closeWindow");
	});

})
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><style type="text/css">
<!--
.weui_btn:hover {color:#FFFFFF;}
-->
</style></head>
<body>
<header class="pageSliderHide"><div id="backBtn"></div>智能门禁</header>
<div class="jb"></div>
<div class="jb2">
	<div class="jb3">注意：</div>
	<div class="jb4">您当前属于临时访客，有效期为一天。超过有效期需重新提交资料审核</div>
	<div class="jb5">【汇得行智慧助手】</div>
</div>
<div class="jb6">
	<div class="jb7"><a href="javascript:;" class="weui_btn weui_btn_warn">返 回</a></div>
</div>
</body>
</html>