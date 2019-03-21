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
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/example.css"/>
		<script type="text/javascript" src="<?php echo C('JQUERY_FILE_190');?>" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/fastclick.js" charset="utf-8"></script>
		<!--<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.cookie.js?210" charset="utf-8"></script>-->
		<script type="text/javascript" src="<?php echo ($static_path); ?>layer/layer.m.js" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/common.js" charset="utf-8"></script>
		<script type="text/javascript">
			var okUrl = "<?php echo U('House/village_my_repairlists',array('village_id'=>$now_village['village_id']));?>";
		</script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/exif.js" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/imgUpload.js" charset="utf-8"></script>
		<!--<script type="text/javascript" src="<?php echo ($static_path); ?>js/iscroll.js?444" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/village_my.js" charset="utf-8"></script>-->
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/village_uploadImg.js" charset="utf-8"></script>
	<style type="text/css">
<!--
.wdwe:link{color:#FFFFFF; text-decoration:none;}
.wdwe:visited{color:#FFFFFF; text-decoration:none;}
.wdwe:active{color:#FFFFFF; text-decoration:none;}
.wdwe:hover{color:#FFFFFF; text-decoration:none;}
-->
</style>
	</head>
	<body>
		<header class="pageSliderHide"><div id="backBtn"></div>在线报修</header>
		<div id="container">
			<div id="scroller" class="village_repair">
				<form id="repair_form" onSubmit="return false;">
					<section>
						<textarea id="j_cmnt_input" class="newarea" name="content" placeholder="文字"></textarea>
						<div class="pic_tip" id="uploadNum">还可上传<span class="leftNum orange">8</span>张图片，已上传<span class="loadedNum orange">0</span>张(非必填)</div>
						<div class="upload_box"> 
							<ul class="upload_list clearfix" id="upload_list"> 
								<li class="upload_action">
									<img src="/tpl/Wap/default/static/classify/upimg.png"/>
									<input type="file" accept="image/jpg,image/jpeg,image/png,image/gif" id="fileImage" name=""/>
								</li> 
							</ul> 
						</div>
					</section>
				</form>
				
				<div style="width:88%; margin: 30px auto 0;"><a href="javascript:;" class="weui_btn weui_btn_primary wdwe" id="submit_btn">报修</a></div>
				<div id="pullUp" style="bottom:-60px;">
					<img src="<?php echo ($config["site_logo"]); ?>" style="width:130px;height:40px;margin-top:10px"/>
				</div>	
			</div>
		</div>
		<?php echo ($shareScript); ?>
		
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/zepto.min.js" charset="utf-8"></script>
	</body>
</html>