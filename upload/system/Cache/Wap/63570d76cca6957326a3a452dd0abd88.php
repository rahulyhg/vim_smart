<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>平台快报</title>
		<meta name="description" content="<?php echo ($config["seo_description"]); ?>">
		<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name='apple-touch-fullscreen' content='yes'>
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta name="format-detection" content="telephone=no">
		<meta name="format-detection" content="address=no">

		<link href="<?php echo ($static_path); ?>css/mp_news.css" rel="stylesheet"/>
	</head>
		<body id="activity-detail" class=" ">
		<div class="rich_media container">
			<div class="header" style="display:none;"></div>
			<div class="rich_media_inner content">
				<h2 class="rich_media_title" id="activity-name"><?php echo ($news["title"]); ?></h2>
				<div class="rich_media_meta_list">
					<em id="post-date" class="rich_media_meta text"><?php echo (date('Y-m-d H:i:s',$news['add_time'])); ?></em> 
				</div>
				<div id="page-content" class="content">
					<?php echo ($news["content"]); ?>
				</div>
			</div>
		</div>
		<div style="display:none;"><?php echo ($config["wap_site_footer"]); ?></div>
		<script src="<?php echo C('JQUERY_FILE');?>"></script>
		<script>
			$('.rich_media_inner').css('min-height',$(window).height()+'px');
		</script>
		<script type="text/javascript">
		window.shareData = {  
		            "moduleName":"Systemnews",
		            "moduleID":"0",
		            "imgUrl": '<?php if($config['wechat_share_img']): echo ($config["wechat_share_img"]); else: echo ($config["site_logo"]); endif; ?>', 
		            "sendFriendLink": "<?php echo ($config["site_url"]); echo U('Systemnews/news', array('id' => $news['id']));?>",
		            "tTitle": "<?php echo ($news['title']); ?>",
		            "tContent": "点击查看快报详细内容"
		};
		</script>
		<?php echo ($shareScript); ?>
	</body>
</html>