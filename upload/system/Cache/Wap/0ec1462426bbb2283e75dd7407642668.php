<?php if (!defined('THINK_PATH')) exit(); if(!defined('PigCms_VERSION')){ exit('deny access!');} ?><!DOCTYPE html><html lang="zh-CN">	<head>		<meta charset="utf-8" />		<title>社区首页</title>		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width"/>		<meta name="apple-mobile-web-app-capable" content="yes"/>		<meta name='apple-touch-fullscreen' content='yes'/>		<meta name="apple-mobile-web-app-status-bar-style" content="black"/>		<meta name="format-detection" content="telephone=no"/>		<meta name="format-detection" content="address=no"/>		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/common.css?210"/>		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/village.css?211"/>		<script type="text/javascript" src="<?php echo C('JQUERY_FILE_190');?>" charset="utf-8"></script>		<script type="text/javascript" src="<?php echo ($static_path); ?>js/iscroll.js?444" charset="utf-8"></script>		<script type="text/javascript" src="<?php echo ($static_path); ?>js/fastclick.js" charset="utf-8"></script>		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.cookie.js?210" charset="utf-8"></script>		<script type="text/javascript" src="<?php echo ($static_path); ?>layer/layer.m.js" charset="utf-8"></script>		<script type="text/javascript" src="<?php echo ($static_path); ?>js/common.js?210" charset="utf-8"></script>		<script type="text/javascript">			var backUrl = "<?php echo U('House/village_list');?>";		</script>		<script type="text/javascript" src="<?php echo ($static_path); ?>js/village.js?210" charset="utf-8"></script>	</head>	<body>		<header class="pageSliderHide"><div id="backBtn"></div><?php echo ($now_village["village_name"]); ?></header>		<div id="container">			<div id="scroller">				<div id="pullDown">					<span class="pullDownIcon"></span><span class="pullDownLabel">下拉刷新页面</span>				</div>				<?php if($pay_list): ?><section class="slider" style="height:auto;">
		<div class="headBox">社区服务</div>
		<div class="swiper-container swiper-container2" style="height:auto;padding-bottom:10px;">
			<div class="swiper-wrapper">
				<div class="swiper-slide">
					<ul class="icon-list">
						<?php if(is_array($pay_list)): $i = 0; $__LIST__ = $pay_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="icon">
								<a href="<?php echo ($vo["url"]); ?>">
									<span class="icon-circle">
										<?php if($vo['type'] != 'appoint'): ?><img src="<?php echo ($static_path); ?>images/house/<?php echo ($vo["type"]); ?>.png"/>
										<?php else: ?>
											<img src="<?php echo ($vo["pic"]); ?>"/><?php endif; ?>
									</span>
									<span class="icon-desc"><?php echo ($vo["name"]); ?></span>
								</a>
							</li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
			</div>
			<div class="swiper-pagination swiper-pagination2"></div>
		</div>
	</section><?php endif; if($news_list): ?><section class="villageBox newsBox">
		<div class="headBox">社区新闻<div class="right link-url" data-url="<?php echo U('House/village_newslist',array('village_id'=>$now_village['village_id']));?>">更多</div></div>
		<dl>
			<?php if(is_array($news_list)): $i = 0; $__LIST__ = $news_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dd class="link-url" data-url="<?php echo U('House/village_news',array('village_id'=>$now_village['village_id'],'news_id'=>$vo['news_id']));?>">
					<div><?php echo ($vo["title"]); ?></div>
					<span class="right"><?php echo (date('m-d H:i',$vo["add_time"])); ?></span>
				</dd><?php endforeach; endif; else: echo "" ;endif; ?>
		</dl>
	</section><?php endif; if($group_list): ?><section class="group">
		<div class="headBox">推荐<?php echo ($config["group_alias_name"]); ?><div class="right link-url" data-url="<?php echo U('House/village_grouplist',array('village_id'=>$now_village['village_id']));?>">更多</div></div>
		<dl class="likeBox dealcard">
			<?php if(is_array($group_list)): $i = 0; $__LIST__ = $group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dd class="link-url" data-url="<?php echo ($vo["url"]); ?>">
					<div class="dealcard-img imgbox">
						<!--img src="<?php echo ($config["site_url"]); ?>/index.php?c=Image&a=thumb&width=276&height=168&url=<?php echo urlencode($vo['list_pic']);?>" alt="<?php echo ($vo["name"]); ?>"/-->
						<img src="/index.php?c=Image&a=thumb&width=276&height=168&url=<?php echo urlencode($vo['list_pic']);?>" alt="<?php echo ($vo["name"]); ?>"/>
					</div>
					<div class="dealcard-block-right">
						<div class="brand"><?php if($vo['tuan_type'] != 2): echo ($vo["merchant_name"]); else: echo ($vo["s_name"]); endif; if($vo['range']): ?><span class="location-right"><?php echo ($vo["range"]); ?></span><?php endif; ?></div>
						<div class="title">[<?php echo ($vo["prefix_title"]); ?>]<?php echo ($vo["group_name"]); ?></div>
						<div class="price">
							<strong><?php echo ($vo['price']); ?></strong><span class="strong-color">元</span><?php if($vo['wx_cheap']): ?><span class="tag">微信再减<?php echo ($vo["wx_cheap"]); ?>元</span><?php endif; if($vo['sale_count']+$vo['virtual_num']): ?><span class="line-right">已售<?php echo ($vo['sale_count']+$vo['virtual_num']); ?></span><?php endif; ?>
						</div>
					</div>
				</dd><?php endforeach; endif; else: echo "" ;endif; ?>
		</dl>
	</section><?php endif; if($meal_list): ?><section class="meal">
		<div class="headBox">推荐<?php echo ($config["meal_alias_name"]); ?><div class="right link-url" data-url="<?php echo U('House/village_meallist',array('village_id'=>$now_village['village_id']));?>">更多</div></div>
		<dl class="likeBox dealcard">
			<?php if(is_array($meal_list)): $i = 0; $__LIST__ = $meal_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dd class="link-url" data-url="<?php echo ($vo["wap_url"]); ?>">
					<div class="dealcard-img imgbox">
						<!--img src="<?php echo ($config["site_url"]); ?>/index.php?c=Image&a=thumb&width=276&height=168&url=<?php echo urlencode($vo['list_pic']);?>" alt="<?php echo ($vo["name"]); ?>"/-->
						<img src="/index.php?c=Image&a=thumb&width=276&height=168&url=<?php echo urlencode($vo['list_pic']);?>" alt="<?php echo ($vo["name"]); ?>"/>
					</div> 
					<div class="dealcard-block-right">
						<div class="brand"><?php echo ($vo["name"]); ?> <?php if($vo['range']): ?><span class="location-right"><?php echo ($vo["range"]); ?></span><?php endif; ?></div>
						<div class="title" style="font-size:14px;margin:4px 0;"><?php echo ($vo["adress"]); if($vo['mean_money']): ?>|人均<?php echo ($vo["mean_money"]); ?>元<?php endif; ?></div>
						<div class="price">
							<?php if($vo['store_type'] == 0 || $vo['store_type'] == 1): ?><span class="imgLabel daodian"></span><?php endif; if($vo['store_type'] == 0 || $vo['store_type'] == 2): ?><span class="imgLabel waisong"></span><?php endif; ?>
							<?php if($vo['sale_count']): ?><span class="line-right">已售<?php echo ($vo["sale_count"]); ?></span><?php endif; ?>
						</div>
					</div>
				</dd><?php endforeach; endif; else: echo "" ;endif; ?>
			
		</dl>
	</section><?php endif; if($appoint_list): ?><section class="appoint">
		<div class="headBox">推荐预约<div class="right link-url" data-url="<?php echo U('House/village_appointlist',array('village_id'=>$now_village['village_id']));?>">更多</div></div>
		<dl class="likeBox dealcard">
			<?php if(is_array($appoint_list)): $i = 0; $__LIST__ = $appoint_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dd class="link-url" data-url="<?php echo ($vo["url"]); ?>">
					<div class="dealcard-img imgbox">
						<!--img src="<?php echo ($config["site_url"]); ?>/index.php?c=Image&a=thumb&width=276&height=168&url=<?php echo urlencode($vo['list_pic']);?>" alt="<?php echo ($vo["name"]); ?>"/-->
						<img src="/index.php?c=Image&a=thumb&width=276&height=168&url=<?php echo urlencode($vo['list_pic']);?>" alt="<?php echo ($vo["appoint_name"]); ?>"/>   
					</div>
					<div class="dealcard-block-right">
						<div class="brand"><?php echo ($vo["appoint_name"]); ?> <?php if($vo['range']): ?><span class="location-right"><?php echo ($vo["range"]); ?></span><?php endif; ?></div>
						<div class="title" style="font-size:14px;margin:4px 0;"><?php if($vo['payment_money']): ?>定金:￥<?php echo ($vo["payment_money"]); else: ?>无需定金<?php endif; ?>|<?php echo ($vo["appoint_content"]); ?></div>
						<div class="price">
							<?php if($vo['appoint_type'] == 1): ?><span class="imgLabel shangmen"></span><?php else: ?><span class="imgLabel daodian"></span><?php endif; ?>
							<?php if($vo['appoint_sum']): ?><span class="line-right">已预约<?php echo ($vo["appoint_sum"]); ?></span><?php endif; ?>
						</div>
					</div>       
				</dd><?php endforeach; endif; else: echo "" ;endif; ?>
		</dl>
	</section><?php endif; ?>				<div id="pullUp" style="bottom:-60px;">					<img src="http://www.hdhsmart.com/tpl/Wap/static/images/hsz.png" style="width:130px;height:55px;margin-top:10px"/>				</div>			</div>		</div>		<?php if(empty($no_footer)): ?><footer class="footerMenu wap">
		<ul>
			<li>
				<a href="<?php echo U('Home/index');?>"><em class="home"></em><p>平台首页</p></a>
			</li>
			<li>
				<a href="<?php echo U('House/village_list');?>"><em class="group"></em><p>社区列表</p></a>
			</li>
			<li>
				<a <?php if(in_array(ACTION_NAME,array('village'))): ?>class="hover"<?php else: ?>href="<?php echo U('House/village',array('village_id'=>$now_village['village_id']));?>"<?php endif; ?>><em class="store"></em><p>社区首页</p></a>
			</li>
			<li>
				<a id="phone" href="<?php echo U('House/village_list',array('village_id'=>$now_village['village_id'],'comm'=>'1'));?>"><em class="group" id="group1"></em><p>号码管理</p></a>
			</li>
			<li>
				<a <?php if(strpos(ACTION_NAME,'village_my') !== false): ?>class="active"<?php else: endif; ?> href="<?php echo U('House/village_my',array('village_id'=>$now_village['village_id']));?>"><em class="my"></em><p>个人中心</p></a>
			</li>
		</ul>
	</footer><?php endif; ?>
<div style="display:none;"><?php echo ($config["wap_site_footer"]); ?></div>		<?php echo ($shareScript); ?>	</body></html>