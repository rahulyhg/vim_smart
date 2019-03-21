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
	<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/style.css"/>
	<script type="text/javascript" src="<?php echo C('JQUERY_FILE_190');?>" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo ($static_path); ?>js/fastclick.js" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo ($static_path); ?>js/common.js" charset="utf-8"></script>
	<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script> <!--引入微信js-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
<!--
a, a:visited, a:hover {color:#FFFFFF;}
-->
</style></head>
<script type="text/javascript">
$(function(){
	$('#backBtn').click(function(){
		window.history.go(-1);
	});
	
	$('.myKey').click(function(){
		$.ajax({
			'url':"<?php echo U('House/village_access_finish',array('village_id'=>$now_village['village_id']));?>",
			'data':{'ac_status':'4'},
			'type':'POST',
			'dataType':'JSON',
			'success':function(msg){
				if(msg.err_code==0){
					window.location.href=msg.code_url;
				}else{
					window.location.reload();
				}			
			},
			'error':function(){
				alert($('.kt2').text());
			}
		})
	})
	
	$('#qrcodeBtn').click(function(){
		if(motify.checkWeixin()){
			motify.log('正在调用二维码功能');
			wx.scanQRCode({
				desc:'scanQRCode desc',
				needResult:0,
				scanType:["qrCode"],
				success:function (res){
					// alert(res);
				},
				error:function(res){
					motify.log('微信返回错误！请稍后重试。',5);
				},
				fail:function(res){
					motify.log('无法调用二维码功能');
				}
			});
		}else{
			motify.log('您不是微信访问，无法使用二维码功能');
		}
	});
})
</script>
<body>
<header class="pageSliderHide"><div id="backBtn"></div>智能门禁</header>
<div class="sfrz_zkd"><img src="<?php echo ($static_path); ?>images/qtt.jpg" style="width:100%;" /></div>
<div class="att">
	<div class="kt"><img src="<?php echo ($static_path); ?>images/gg.jpg" style="width:120%;" /></div>
	<div class="kt2"><span style="color:#fb4746;">恭喜您，审核成功！</span><br/>点击下方的钥匙进入门禁管理</div>
	<div class="both"></div>
</div>
<div class="att2"></div>
<div class="zkd2">
	<div class="fr"><a href="javascript:;" class="weui_btn weui_btn_warn myKey">我的钥匙</a></div>
	<div class="fr2"><a href="javascript:;" class="weui_btn weui_btn_warn" id="qrcodeBtn">扫一扫</a></div>
	<div class="both"></div>
</div>
<div class="zdb">客服电话：<a href="tel:027-87779655" style="color:#fb4746;">027-87779655</a></div>
</body>
<?php echo ($shareScript); ?>
</html>