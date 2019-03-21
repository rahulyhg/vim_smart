<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title><?php echo ($config["group_alias_name"]); ?>收藏列表</title>
	<meta name="description" content="<?php echo ($config["seo_description"]); ?>">
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">

    <link href="<?php echo ($static_path); ?>css/eve.7c92a906.css" rel="stylesheet"/>
	<link href="<?php echo ($static_path); ?>css/index_wap.css" rel="stylesheet"/>
	<style>
		.dealcard {
			-webkit-transition: -webkit-transform .2s;
		}
		.editing .dealcard {
			-webkit-transform: translateX(1.05rem);
		}
		.del-btn {
			display: block;
			width: .45rem;
			height: .45rem;
			text-align: center;
			line-height: .45rem;
			position: absolute;
			left: -.85rem;
			top: 50%;
			background-color: #EC5330;
			color: #fff;
			-webkit-transform: translateY(-50%);
			border-radius: 50%;
			font-size: .4rem;
		}
		.no-collection {
			color: #D4D4D4;
			text-align: center;
			margin-top: 1rem;
			margin-bottom: 2.5rem;
		}
		.icon-line {
			font-size: 2.5rem;
			margin-bottom: .5rem;
		}
		.btn-wrapper .tab {
			width: 100%;
		}
		.btn-wrapper .tab li {
			width: 50%;
			box-sizing: border-box;
		}
		.btn-wrapper{
			margin:0px;
		}
		ul.tab{
			border: none;
			border-bottom:1px solid #ccc;
			height:.8rem;
		}
		.tab li.active {
			color: #fff;
		}
		.tab a.react{
			height:.8rem;
			line-height:.8rem;
		}
	</style>
</head>
<body id="index">
		<div class="btn-wrapper">
			<ul class="tab">
				<li class="active"><a class="react" href="<?php echo U('My/group_collect');?>"><?php echo ($config["group_alias_name"]); ?></a>
				</li><li><a class="react" href="<?php echo U('My/group_store_collect');?>">店铺</a>
				</li>
			</ul>
		</div>
        <div id="container">
			<div class="deal-container">
				<div class="deals-list" id="deals">
					<?php if($group_list): ?><dl class="list list-in">
		       				<?php if(is_array($group_list)): $i = 0; $__LIST__ = $group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dd>
			        				<a href="<?php echo ($vo["url"]); ?>" class="react">
										<div class="dealcard">
										        <div class="dealcard-img imgbox">
										        	<img src="<?php echo ($vo["list_pic"]); ?>" style="width:100%;height:100%;">
										        </div>
										    <div class="dealcard-block-right">
										        <?php if($vo['tuan_type'] != 2): ?><div class="dealcard-brand single-line"><?php echo ($vo["merchant_name"]); ?></div>
													<div class="title text-block">[<?php echo ($vo["prefix_title"]); ?>]<?php echo ($vo["group_name"]); ?></div>
												<?php else: ?>
													<div class="dealcard-brand single-line"><?php echo ($vo["s_name"]); ?></div>
													<div class="title text-block">[<?php echo ($vo["prefix_title"]); ?>]<?php echo ($vo["group_name"]); ?></div><?php endif; ?>
										        <div class="price">
										            <strong><?php echo ($vo["price"]); ?></strong>
										            <span class="strong-color">元</span>
										            <?php if($vo['wx_cheap']): ?><span class="tag">微信再减<?php echo ($vo["wx_cheap"]); ?>元</span>
										            <?php else: ?>
										            	<del><?php echo ($vo["old_price"]); ?>元</del><?php endif; ?>
										            <?php if($vo['sale_count']+$vo['virtual_num']): ?><span class="line-right">已售<?php echo ($vo['sale_count']+$vo['virtual_num']); ?></span><?php endif; ?>
										        </div>
										    </div>
										</div>
			       					</a>
			       				</dd><?php endforeach; endif; else: echo "" ;endif; ?>
						</dl>
						<dl class="list">
							<dd>
								<div class="pager"><?php echo ($pagebar); ?></div>
							</dd>
						</dl>
					<?php else: ?>	
						<div class="no-deals">您还没有收藏呢</div><?php endif; ?>
				</div>
				<div class="shade hide"></div>
				<div class="loading hide">
			        <div class="loading-spin" style="top: 91px;"></div>
			    </div>
			</div>
		</div>
		<script src="<?php echo C('JQUERY_FILE');?>"></script>
		<script src="<?php echo ($static_path); ?>js/common_wap.js"></script>
    			<link href="<?php echo ($static_path); ?>css/footer.css" rel="stylesheet"/>
		<?php if(empty($no_gotop)): ?><div style="height:10px"></div>
			<div class="top-btn"><a class="react"><i class="text-icon">⇧</i></a></div><?php endif; ?>
		<?php if(empty($no_footer)): ?><footer class="footermenu">
				<ul>
					<li>
						<a <?php if(MODULE_NAME == 'Home'): ?>class="active"<?php endif; ?> href="<?php echo U('Home/index');?>">
							<em class="home"></em>
							<p>首页</p>
						</a>
					</li>
					<li>
						<a <?php if(MODULE_NAME == 'Group'): ?>class="active"<?php endif; ?> href="<?php echo U('Group/index');?>">
							<em class="group"></em>
							<p><?php echo ($config["group_alias_name"]); ?></p>
						</a>
					</li>
					<li>
						<a <?php if(in_array(MODULE_NAME,array('Meal_list','Meal')) AND $store_type == 2): ?>class="active"<?php endif; ?> href="<?php echo U('Meal_list/index', array('store_type' => 2));?>">
							<em class="meal"></em>
							<p><?php echo ($config["meal_alias_name"]); ?></p>
						</a>
					</li>
					<li>
						<a <?php if(in_array(MODULE_NAME,array('My','Login'))): ?>class="active"<?php endif; ?> href="<?php echo U('My/index');?>">
							<em class="my"></em>
							<p>我的</p>
						</a>
					</li>
				</ul>
			</footer><?php endif; ?>
		<div style="display:none;"><?php echo ($config["wap_site_footer"]); ?></div>
        
<?php echo ($hideScript); ?>
</body>
</html>