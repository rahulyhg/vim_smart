<?php if (!defined('THINK_PATH')) exit(); if(!defined('PigCms_VERSION')){ exit('deny access!');} ?>
<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta charset="utf-8" />
		<title>附近店铺</title>
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width"/>
		<meta name="apple-mobile-web-app-capable" content="yes"/>
		<meta name='apple-touch-fullscreen' content='yes'/>
		<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
		<meta name="format-detection" content="telephone=no"/>
		<meta name="format-detection" content="address=no"/>
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/common.css?210"/>
		<script type="text/javascript" src="<?php echo C('JQUERY_FILE_190');?>"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/iscroll.js?444"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/fastclick.js" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/common.js?210" charset="utf-8"></script>
		<script type="text/javascript"><?php if($long_lat): ?>var user_long = "<?php echo ($long_lat["long"]); ?>",user_lat = "<?php echo ($long_lat["lat"]); ?>";<?php else: ?>var user_long = '0',user_lat  = '0';<?php endif; ?>var static_path = "<?php echo ($static_path); ?>";</script>
		<!--script type="text/javascript" src="http://api.map.baidu.com/api?type=quick&ak=4c1bb2055e24296bbaef36574877b4e2&v=1.0"></script-->
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/merchant_around.js?210" charset="utf-8"></script>
		<style>
			#listBtn{background:url(<?php echo ($static_path); ?>img/listBtn.png) no-repeat;background-size:100%;width:35px;height:35px;right:8px;bottom:15px;position:absolute;z-index:10;}
			#listBg{position:fixed;top:0;left:0;bottom:0;padding:0;z-index:998;width:100%;background-color:rgba(0,0,0,0.5);display:none;}
			#listList{position:fixed;top:10%;left:10%;bottom:10%;right:10%;z-index:999;background-color:white;border-radius:5px;overflow:hidden;display:none;}
			#listList dl{background-color:#F3F3F3;}
			#listList dd{border-bottom:1px solid #D6D6D6;padding:6px 12px;}
			#listList dd:last-child{border-bottom:none;}
		</style>
	</head>
	<body>
		<div id="container">
			<div id="scroller">
				<div id="around-map"></div>
			</div>
		</div>
		<div id="listBtn"></div>
		<div id="listBg"></div>
		<div id="listList">
			<div>
				<dl></dl>
			</div>
		</div>
	</body>
</html>