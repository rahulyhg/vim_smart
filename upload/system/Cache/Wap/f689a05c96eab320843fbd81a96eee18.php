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
		<script type="text/javascript" src="<?php echo C('JQUERY_FILE_190');?>" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/iscroll.js?444" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/fastclick.js" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.cookie.js?210" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>layer/layer.m.js" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/common.js?210" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/village_my.js?210" charset="utf-8"></script>
		<style>
			section{margin-top:20px;padding:0 20px;}
			.header{margin-bottom:5px;font-size:16px;}
			.upload_list{background-color:white;}
			.upload_list img{width:100%;height:100%;}
		</style>
		<script type="text/javascript">
			$(function(){
				$('.upload_list img').height($('.upload_list li:first').width()).width($('.upload_list li:first').width());
			});
		</script>
	</head>
	<body>
		<header class="pageSliderHide"><div id="backBtn"></div>水电煤上报详情</header>
		<div id="container">
			<div id="scroller">
				<section>
					<p class="header">内容：</p>
					<p><?php echo ($repair_detail["content"]); ?></p>
				</section>
				<?php if($repair_detail['pic']): ?><section>
						<p class="header">图片：</p>
						<p>
							<ul class="upload_list clearfix">
								<?php if(is_array($repair_detail['picArr'])): $i = 0; $__LIST__ = $repair_detail['picArr'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="upload_item">
										<img src="<?php echo ($config["site_url"]); ?>/upload/house/<?php echo ($vo); ?>"/>
									</li><?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
						</p>
					</section><?php endif; ?>
				<section>
					<p class="header">状态：<?php if($vo['is_read']): ?>已处理<?php else: ?><font color="red">待处理</font><?php endif; ?></p>
				</section>
				<div id="pullUp" style="bottom:-60px;">
					<img src="<?php echo ($config["site_logo"]); ?>" style="width:130px;height:40px;margin-top:10px"/>
				</div>
			</div>
		</div>
		<?php echo ($shareScript); ?>
	</body>
</html>