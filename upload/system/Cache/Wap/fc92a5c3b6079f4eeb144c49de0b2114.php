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
			.village_my nav.order_list section p{padding-left:0px;}
		</style>
	</head>
	<body>
		<header class="pageSliderHide"><div id="backBtn"></div>水电煤上报列表</header>
		<div id="container">
			<div id="scroller" class="village_my">
				<?php if($repair_list): ?><nav class="order_list">
						<?php if(is_array($repair_list)): $i = 0; $__LIST__ = $repair_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><section class="link-url" data-url="<?php echo U('House/village_my_utilities_detail',array('village_id'=>$vo['village_id'],'id'=>$vo['pigcms_id']));?>">
								<p><?php echo (msubstr($vo["content"],0,20)); ?></p>
								<p class="money"><?php if($vo['is_read']): ?>已处理<?php else: ?><font color="red">待处理</font><?php endif; ?><em><?php echo (date('Y-m-d H:i',$vo["time"])); ?></em></p>
							</section><?php endforeach; endif; else: echo "" ;endif; ?>
					</nav>
				<?php else: ?>
					<div class="noMoreDiv" style="margin-top:20px;background:#ebebeb;">您还没有使用水电煤上报功能</div><?php endif; ?>
				<div id="pullUp" style="bottom:-60px;">
					<img src="<?php echo ($config["site_logo"]); ?>" style="width:130px;height:40px;margin-top:10px"/>
				</div>
			</div>
		</div>
		<?php echo ($shareScript); ?>
	</body>
</html>