<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<title><?php echo ($now_activity["name"]); ?> - 优惠券 - <?php echo ($config["site_name"]); ?></title>
		<meta name="keywords" content="<?php echo ($config["seo_keywords"]); ?>" />
		<meta name="description" content="<?php echo ($config["seo_description"]); ?>" />
		<link href="<?php echo ($static_path); ?>css/css.css" type="text/css"  rel="stylesheet" />
		<link href="<?php echo ($static_path); ?>css/header.css"  rel="stylesheet"  type="text/css" />
		<link href="<?php echo ($static_path); ?>css/1yuan.css"  rel="stylesheet"  type="text/css" />
		<script src="<?php echo ($static_path); ?>js/jquery-1.7.2.js"></script>
		<script src="<?php echo ($static_public); ?>js/jquery.lazyload.js"></script>
		<script src="<?php echo ($static_public); ?>js/artdialog/jquery.artDialog.js"></script>
		<script src="<?php echo ($static_public); ?>js/artdialog/iframeTools.js"></script>
		<script src="<?php echo ($static_path); ?>js/common.js"></script>
		<script>var submitFormAction = "<?php echo U('Activity/submit',array('id'=>$now_activity['pigcms_id']));?>";<?php if($user_session): ?>var is_login=true;<?php else: ?>var is_login=false;<?php endif; ?>var login_url="<?php echo U('Index/Login/frame_login');?>";var recharge_url="<?php echo U('User/Credit/index');?>";var get_number_list="<?php echo U('Index/Activity/coupon_number');?>";</script>
		<script src="<?php echo ($static_path); ?>js/coupon.js"></script>
		<!--[if IE 6]>
		<script  src="<?php echo ($static_path); ?>js/DD_belatedPNG_0.0.8a.js" mce_src="<?php echo ($static_path); ?>js/DD_belatedPNG_0.0.8a.js"></script>
		<script type="text/javascript">
		   DD_belatedPNG.fix('.enter,.enter a,.enter a:hover');
		</script>
		<script type="text/javascript">DD_belatedPNG.fix('*');</script>
		<style type="text/css"> 
			body{behavior:url("<?php echo ($static_path); ?>css/csshover.htc");}
			.category_list li:hover .bmbox {filter:alpha(opacity=50);}
			.gd_box{display:none;}
		</style>
		<![endif]-->
	</head>
	<body>
		<div class="header_top">
    <div class="hot cf">
        <div class="loginbar cf">
			<?php if(empty($user_session)): ?><div class="login"><a href="<?php echo UU('Index/Login/index');?>" style="color:red;"> 登陆 </a></div>
				<div class="regist"><a href="<?php echo UU('Index/Login/reg');?>">注册 </a></div>
			<?php else: ?>
				<p class="user-info__name growth-info growth-info--nav">
					<span>
						<a rel="nofollow" href="<?php echo UU('User/Index/index');?>" class="username"><?php echo ($user_session["nickname"]); ?></a>
					</span>
					<a class="user-info__logout" href="<?php echo UU('Index/Login/logout');?>">退出</a>
				</p><?php endif; ?>
			<div class="span">|</div>
			<div class="weixin cf">
				<div class="weixin_txt"><a href="<?php echo ($config["config_site_url"]); ?>/topic/weixin.html" target="_blank"> 微信版</a></div>
				<div class="weixin_icon"><p><span>|</span><a href="<?php echo ($config["config_site_url"]); ?>/topic/weixin.html" target="_blank">访问微信版</a></p><img src="<?php echo ($config["wechat_qrcode"]); ?>"/></div>
			</div>
        </div>
        <div class="list">

			<ul class="cf">
				<li>
					<div class="li_txt"><a href="<?php echo UU('User/Index/index');?>">我的订单</a></div>
					<div class="span">|</div>
				</li>
				<li class="li_txt_info cf">
					<div class="li_txt_info_txt"><a href="<?php echo UU('User/Index/index');?>">我的信息</a></div>
					<div class="li_txt_info_ul">
						<ul class="cf">
							<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo UU('User/Index/index');?>">我的订单</a></li>
							<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo UU('User/Rates/index');?>">我的评价</a></li>
							<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo UU('User/Collect/index');?>">我的收藏</a></li>
							<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo UU('User/Point/index');?>">我的积分</a></li>
							<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo UU('User/Credit/index');?>">帐户余额</a></li>
							<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo UU('User/Adress/index');?>">收货地址</a></li>
						</ul>
					</div>
					<div class="span">|</div>
				</li>
				<li class="li_liulan">
					<div class="li_liulan_txt"><a href="#">最近浏览</a></div>	 
					<div class="history" id="J-my-history-menu"></div> 
					<div class="span">|</div>
				</li>
				<li class="li_shop">
					<div class="li_shop_txt"><a href="#">我是商家</a></div>
					<ul class="li_txt_info_ul cf">
						<li><a class="dropdown-menu__item first" rel="nofollow" href="<?php echo ($config["config_site_url"]); ?>/merchant.php">商家中心</a></li>
						<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo ($config["config_site_url"]); ?>/merchant.php">我想合作</a></li>
					</ul>
				</li>
			</ul>
        </div>
    </div>
</div>
<header class="header cf">
	<!--
	<?php $one_adver = D("Adver")->get_one_adver("index_top"); if(is_array($one_adver)): ?><div class="content">
			<div class="banner" style="background:<?php echo ($one_adver["bg_color"]); ?>">
				<div class="hot"><a href="<?php echo ($one_adver["url"]); ?>" title="<?php echo ($one_adver["name"]); ?>"><img src="<?php echo ($one_adver["pic"]); ?>" /></a></div>
			</div>
		</div><?php endif; ?>
	-->
    <div class="nav cf">
		<div class="logo">
<span><a href="<?php echo ($config["site_url"]); ?>" title="<?php echo ($config["site_name"]); ?>"><img  src="<?php echo ($config["site_logo"]); ?>" /></a></span>
<div class="dcs"><h1><?php echo ($now_city_name); ?></h1><a href="/index.php?g=Index&c=Changecity&a=index">切换城市</a></div>
			<div></div>

		</div>
		<div class="search">
			<form action="<?php echo U('Group/Search/index');?>" method="post" group_action="<?php echo U('Group/Search/index');?>" meal_action="<?php echo U('Meal/Search/index');?>">
				<div class="form_sec">
					<div class="form_sec_txt group"><?php echo ($config["group_alias_name"]); ?></div>
					<div class="form_sec_txt1 meal"><?php echo ($config["meal_alias_name"]); ?></div>
				</div>
				<input name="w" class="input" type="text" placeholder="请输入商品名称、地址等"/>
				<button value="" class="btnclick"><img src="<?php echo ($static_path); ?>images/o2o1_20.png"  /></button>
			</form>
			<div class="search_txt">
				<?php if(is_array($search_hot_list)): $i = 0; $__LIST__ = $search_hot_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo ($vo["url"]); ?>"><span><?php echo ($vo["name"]); ?></span></a><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</div>
		<div class="menu">
			<div class="ment_left">
			  <div class="ment_left_img"><img src="<?php echo ($static_path); ?>images/o2o1_13.png" /></div>
			  <div class="ment_left_txt">随时退</div>
			</div>
			<div class="ment_left">
			  <div class="ment_left_img"><img src="<?php echo ($static_path); ?>images/o2o1_15.png" /></div>
			  <div class="ment_left_txt">不满意免单</div>
			</div>
			<div class="ment_left">
			  <div class="ment_left_img"><img src="<?php echo ($static_path); ?>images/o2o1_17.png" /></div>
			  <div class="ment_left_txt">过期退</div>
			</div>
		</div>
    </div>
</header>
		<div class="body"> 
			<article>
				<div class="menu cf">
					<div class="menu_left hide">
						<div class="menu_left_top">全部分类</div>
						<div class="list">
							<ul>
								<?php if(is_array($all_category_list)): $k = 0; $__LIST__ = $all_category_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><li>
										<div class="li_top cf">
											<?php if($vo['cat_pic']): ?><div class="icon"><img src="<?php echo ($vo["cat_pic"]); ?>" /></div><?php endif; ?>
											<div class="li_txt"><a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["cat_name"]); ?></a></div>
										</div>
										<?php if($vo['cat_count'] > 1): ?><div class="li_bottom">
												<?php if(is_array($vo['category_list'])): $j = 0; $__LIST__ = array_slice($vo['category_list'],0,3,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($j % 2 );++$j;?><span><a href="<?php echo ($voo["url"]); ?>" target="_blank"><?php echo ($voo["cat_name"]); ?></a></span><?php endforeach; endif; else: echo "" ;endif; ?>
											</div>
											<div class="list_txt">
												<p><a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["cat_name"]); ?></a></p>
												<?php if(is_array($vo['category_list'])): $j = 0; $__LIST__ = $vo['category_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($j % 2 );++$j;?><a class="<?php if($voo['is_hot']): ?>bribe<?php endif; ?>" href="<?php echo ($voo["url"]); ?>" target="_blank"><?php echo ($voo["cat_name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
											</div><?php endif; ?>
									</li><?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
						</div>
					</div>
					<div class="menu_right cf">
						<div class="menu_right_top">
							<ul>
								<?php $web_index_slider = D("Slider")->get_slider_by_key("web_slider","10");if(is_array($web_index_slider)): $i = 0;if(count($web_index_slider)==0) : echo "列表为空" ;else: foreach($web_index_slider as $key=>$vo): ++$i;?><li class="ctur">
										<a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["name"]); ?></a>
									</li><?php endforeach; endif; else: echo "列表为空" ;endif; ?>
							</ul>
						</div>
					</div>
				</div>
			</article>
			<div class="oneyuan cf">
				<div class="navBreadCrumb cf">
					<ul class="cf">
						<li>
							<div class="navBreadCrumb_txt"><a href="<?php echo ($config["site_url"]); ?>">网站首页&nbsp;&nbsp;&gt;</a></div>
						</li>
						<li>
							<div class="navBreadCrumb_txt"><a href="<?php echo ($config["site_url"]); ?>/activity/">活动列表&nbsp;&nbsp;&gt;</a></div>
						</li>
						<li>
							<div class="navBreadCrumb_txt"><a href="<?php echo ($config["site_url"]); ?>/activity/2/all">优惠券&nbsp;&nbsp;&gt;</a></div>
						</li>
						<li style="color:#fe5842">
							<div class="navBreadCrumb_txt">奖品详情</div>
						</li>
					</ul>
				</div>
				<div class="product_table cf">
					<div class="product_img cf"> 
						<div id="slider" class="cf">
							<div class="show-box cf">
								<ul class="cf">
									<li class="show" style="display:list-item;"><img src="<?php echo ($now_activity["all_pic"]["0"]["m_image"]); ?>"/></li>
								</ul>
							</div>
							<div class="minImgs">
								<div class="min-box">
									<ul class="min-box-list cf">
										<?php if(is_array($now_activity['all_pic'])): $i = 0; $__LIST__ = $now_activity['all_pic'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="<?php if($i == 1): ?>cur<?php endif; ?>">
												<div><img src="<?php echo ($vo["s_image"]); ?>" data-mpic="<?php echo ($vo["m_image"]); ?>"/></div>
											</li><?php endforeach; endif; else: echo "" ;endif; ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="product_list couponDiv">
						<div class="product_list_top">
							<div class="product_name"><?php echo ($now_activity["name"]); ?></div>
							<div class="cf">
								<div class="product_number cf">
									<div class="product_number_top">总数量<span><?php echo ($now_activity["all_count"]); ?></span></div>
									<div class="product_number_progress">
										<div class="product_number_progress_img" style="width:<?php echo ($now_activity['part_count']/$now_activity['all_count']*100); ?>%;"></div>
									</div>
									<div class="product_number_bottom cf">
										<div class="product_number_bottom_txt_left">
											<div class="product_number_bottom_txt_num"><?php echo ($now_activity["part_count"]); ?></div>
											<div class="product_number_bottom_txt">已发放</div>
										</div>
										<div class="product_number_bottom_txt_right">
											<div class="product_number_bottom_txt_num"><?php echo ($now_activity['all_count']-$now_activity['part_count']); ?></div>
											<div class="product_number_bottom_txt">剩余</div>
										</div>
									</div>
								</div>
							</div>
							<div class="product_info_top cf">
								<?php if($now_activity['money']): ?><div class="product_info_list_left">兑换价格：</div>
									<div class="product_info_list_num"><span>¥</span><?php echo ($now_activity["money"]); ?></div>
								<?php else: ?>
									<div class="product_info_list_left">兑换积分：</div>
									<div class="product_info_list_num"><?php echo ($now_activity["mer_score"]); ?><span>分</span><?php if($now_activity['all_count']-$now_activity['part_count'] > 0): ?><span class="score_tips">您可以选择使用  <strong><?php echo ($now_activity['mer_score']/$config['activity_score_scale']); ?></strong> 平台积分参与活动</span><?php endif; ?></div><?php endif; ?>
							</div>
							<?php if($now_activity['all_count']-$now_activity['part_count'] > 0): ?><div class="product_list_bottom cf">
									<form action="" method="get" id="buy_form">
										<div class="cf">
											<div class="input">
												<div class="product_info_list_left">积分类别：</div>
												<ul style="border:none;">
													<li style="border-right:none;"><label for="mer_score"><input type="radio" id="mer_score" name="score_type" value="1" checked="checked"/> 商家积分&nbsp;&nbsp;&nbsp;&nbsp;</label></li>
													<li style="border-right:none;"><label for="sys_score">&nbsp;&nbsp;&nbsp;<input type="radio" id="sys_score" name="score_type" value="2"/> 平台积分&nbsp;&nbsp;&nbsp;</li>
												</ul>
											</div>
										</div>
										<div class="cf">
											<div class="input">
												<div class="product_info_list_left">兑换数量：</div>
												<ul>
													<li><button id="J-cart-minus" class="minus" type="button">-</button></li>
													<li>
														<input name="q" class="inp" type="text" value="1" id="J-quantity" data-max="<?php echo ($now_activity['all_count']-$now_activity['part_count']); ?>"/>
													</li>
													<li style="border:0px;"><button id="J-cart-add" class="minus" type="button">+</button></li>
												</ul>
											</div>
										</div>
										<p id="error_num_tips" style="margin:10px 0 0 20px;color:#db3652;"></p>
										<div class="but cf">
											<button class="info_but"> 立即兑换 </button>
										</div>
									</form>
								</div>
							<?php else: ?>
								<div class="product_info_top cf">
									<div class="product_info_no_tips">已经全部发放完毕</div>
								</div><?php endif; ?>
						</div>
					</div>
				</div>
				<div class="navBreadCrumb_right">
					<div class="navBreadCrumb_right_title cf">
						<div class="navBreadCrumb_right_title_left">看了还看</div>
						<!--div class="navBreadCrumb_right_title_right"><a href="#"><span></span>换一批</a></div-->
					</div>
					<div class="navBreadCrumb_right_list">
						<ul>
							<?php if(is_array($tui_activityList)): $i = 0; $__LIST__ = $tui_activityList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
									<a href="<?php echo ($vo["url"]); ?>">
										<img src="<?php echo ($vo["list_pic"]); ?>" style="width:158px;"/>
									</a>
									<p><a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["name"]); ?></a></p>
									<p>已有 <span><?php echo ($vo["part_count"]); ?></span> 参与</p>
								</li><?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
					</div>
				</div>
			</div>
			<div class="table">
				<div class="tab1" id="tab1">
					<div class="menu">
						<ul class="cf">
							<li class="set_tab off" data-id="1">奖品详情</li>
							<?php if($now_activity['part_count']): ?><li class="set_tab" data-id="2">所有参与记录</li><?php endif; ?>
							<?php if($user_part_list): ?><li class="set_tab showOwnBtn" data-id="3">您的参与</li><?php endif; ?>
						</ul>
					</div>
					<div class="menudiv">
						<div id="con_one_1" style="display:block;">
							<?php echo ($now_activity["info"]); ?>
						</div>
						<div id="con_one_2" style="display: none;">
							<ul class="jion cf">
								<li>
								  <div class="jion_left big"><span></span></div>
								  <div class="jion_right" style="height:80px;"></div>
								  <div class="clear"></div>
								</li>
								<?php if(is_array($part_list)): $i = 0; $__LIST__ = $part_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="cf">
										<div class="jion_left day"><?php echo ($key); ?><span></span></div>
										<div class="jion_right"></div>
									</li>
									<?php if(is_array($vo)): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($i % 2 );++$i;?><li class="cf">
											<div class="jion_left time"><?php echo date('H:i:s',$voo['time']);?>.<?php echo ($voo["msec"]); ?><span></span></div>
											<div class="jion_right">
												<div class="jion_right_div" data-id="<?php echo ($voo['pigcms_id']); ?>">
													<div class="cf">
														<div class="jion_right_icon"><img src="<?php echo ($voo["avatar"]); ?>" width="20" height="20"/></div>
														<div class="jion_right_txt">
															<div class="jion_right_txt_name"><?php echo ($voo["nickname"]); ?></div>
															<div class="jion_right_txt_ip">(<?php echo ($voo["ip_txt"]); ?> IP：<?php echo ($voo["ip"]); ?>) 参与了</div>
															<span><?php echo ($voo["part_count"]); ?>人次</span>
														</div>
														<!--div class="suoyou">所有夺宝号码<span></span></div-->
													</div>
													<dl class="cf number_list_<?php echo ($voo['pigcms_id']); ?>"></dl>
													<div class="jion_close"></div>
												</div>
											</div>
										</li><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
								<li>
									<div class="jion_left bottom" style="border:0;"><span></span></div>
								</li>
							</ul>
						</div>
						<div id="con_one_3" style="display: none;">
							<ul class="jion cf">
								<li>
								  <div class="jion_left big"><span></span></div>
								  <div class="jion_right" style="height:80px;"></div>
								  <div class="clear"></div>
								</li>
								<?php if(is_array($user_part_list)): $i = 0; $__LIST__ = $user_part_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="cf">
										<div class="jion_left day"><?php echo ($key); ?><span></span></div>
										<div class="jion_right"></div>
									</li>
									<?php if(is_array($vo)): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($i % 2 );++$i;?><li class="cf">
											<div class="jion_left time"><?php echo date('H:i:s',$voo['time']);?>.<?php echo ($voo["msec"]); ?><span></span></div>
											<div class="jion_right">
												<div class="jion_right_div" data-id="<?php echo ($voo['pigcms_id']); ?>">
													<div class="cf">
														<div class="jion_right_icon"><img src="<?php echo ($voo["avatar"]); ?>" width="20" height="20"/></div>
														<div class="jion_right_txt">
															<div class="jion_right_txt_name"><?php echo ($voo["nickname"]); ?></div>
															<div class="jion_right_txt_ip">(<?php echo ($voo["ip_txt"]); ?> IP：<?php echo ($voo["ip"]); ?>) 参与了</div>
															<span><?php echo ($voo["part_count"]); ?>人次</span>
														</div>
														<div class="suoyou">所有优惠券<span></span></div>
													</div>
													<dl class="cf number_list_<?php echo ($voo['pigcms_id']); ?>"></dl>
													<div class="jion_close"></div>
												</div>
											</div>
										</li><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
								<li>
									<div class="jion_left bottom" style="border:0;"><span></span></div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<footer>
	<div class="footer1">
		<div class="footer_txt cf">
			<div class="footer_list cf">
				<ul class="cf">
					<?php $footer_link_list = D("Footer_link")->get_list();if(is_array($footer_link_list)): $i = 0;if(count($footer_link_list)==0) : echo "列表为空" ;else: foreach($footer_link_list as $key=>$vo): ++$i;?><li><a href="<?php echo ($vo["url"]); ?>" target="_blank"><?php echo ($vo["name"]); ?></a><?php if($i != count($footer_link_list)): ?><span>|</span><?php endif; ?></li><?php endforeach; endif; else: echo "列表为空" ;endif; ?>
				</ul>
			</div>
			<div class="footer_txt"><?php echo nl2br($config['site_show_footer'],'<a>');?></div>
		</div>
	</div>
</footer>
<div style="display:none;"><?php echo ($config["site_footer"]); ?></div>
<!--悬浮框-->
<?php if(MODULE_NAME != 'Login'): ?><div class="rightsead">
		<ul>
			<li>
				<a href="javascript:void(0)" class="wechat">
					<img src="<?php echo ($static_path); ?>images/l02.png" width="47" height="49" class="shows"/>
					<img src="<?php echo ($static_path); ?>images/a.png" width="57" height="49" class="hides"/>
					<img src="<?php echo ($config["wechat_qrcode"]); ?>" width="145" class="qrcode"/>
				</a>
			</li>
			<?php if($config['site_qq']): ?><li>
					<a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo ($config["site_qq"]); ?>&site=qq&menu=yes" target="_blank" class="qq">
						<div class="hides qq_div">
							<div class="hides p1"><img src="<?php echo ($static_path); ?>images/ll04.png"/></div>
							<div class="hides p2"><span style="color:#FFF;font-size:13px"><?php echo ($config["site_qq"]); ?></span></div>
						</div>
						<img src="<?php echo ($static_path); ?>images/l04.png" width="47" height="49" class="shows"/>
					</a>
				</li><?php endif; ?>
			<?php if($config['site_phone']): ?><li>
					<a href="javascript:void(0)" class="tel">
						<div class="hides tel_div">
							<div class="hides p1"><img src="<?php echo ($static_path); ?>images/ll05.png"/></div>
							<div class="hides p3"><span style="color:#FFF;font-size:12px"><?php echo ($config["site_phone"]); ?></span></div>
						</div>
						<img src="<?php echo ($static_path); ?>images/l05.png" width="47" height="49" class="shows"/>
					</a>
				</li><?php endif; ?>
			<li>
				<a class="top_btn">
					<div class="hides btn_div">
						<img src="<?php echo ($static_path); ?>images/ll06.png" width="161" height="49"/>
					</div>
					<img src="<?php echo ($static_path); ?>images/l06.png" width="47" height="49" class="shows"/>
				</a>
			</li>
		</ul>
	</div><?php endif; ?>
<!--leftsead end-->
	</body>
</html>