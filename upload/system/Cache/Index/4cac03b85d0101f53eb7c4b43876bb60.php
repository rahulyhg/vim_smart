<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<title>生活缴费 - <?php echo ($config["site_name"]); ?></title>
		<meta name="keywords" content="<?php echo ($config["seo_keywords"]); ?>" />
		<meta name="description" content="<?php echo ($config["seo_description"]); ?>" />
		<link href="<?php echo ($static_path); ?>css/css.css" type="text/css"  rel="stylesheet" />
		<link href="<?php echo ($static_path); ?>css/header.css"  rel="stylesheet"  type="text/css" />
		<link href="<?php echo ($static_path); ?>css/activity.css"  rel="stylesheet"  type="text/css" />
		<link href="<?php echo ($static_path); ?>css/lifeservice.css"  rel="stylesheet"  type="text/css" />
		<script src="<?php echo ($static_path); ?>js/jquery-1.7.2.js"></script>
		<script src="<?php echo ($static_public); ?>js/jquery.lazyload.js"></script>
		<script src="<?php echo ($static_public); ?>js/artdialog/jquery.artDialog.js"></script>
		<script src="<?php echo ($static_public); ?>js/artdialog/iframeTools.js"></script>
		<script src="<?php echo ($static_path); ?>js/common.js"></script>
		<script>var service_action="<?php echo U('Lifeservice/post');?>";<?php if($user_session): ?>var is_login=true;<?php else: ?>var is_login=false;<?php endif; ?>var login_url="<?php echo U('Index/Login/frame_login',array('scriptName'=>'loginAfter'));?>";var recharge_url="<?php echo U('User/Credit/index');?>";</script>
		<script src="<?php echo ($static_path); ?>js/lifeservice.js"></script>
		<!--[if IE 6]>
		<script  src="<?php echo ($static_path); ?>js/DD_belatedPNG_0.0.8a.js" mce_src="<?php echo ($static_path); ?>js/DD_belatedPNG_0.0.8a.js"></script>
		<script type="text/javascript">
		   /* EXAMPLE */
		   DD_belatedPNG.fix('.enter,.enter a,.enter a:hover');

		   /* string argument can be any CSS selector */
		   /* .png_bg example is unnecessary */
		   /* change it to what suits you! */
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
			<?php if($now_select_city): ?><div class="span" style="font-size:16px;color:red;padding-right:3px;cursor:default;"><?php echo ($now_select_city["area_name"]); ?></div>
				<div class="span" style="padding-right:10px;">[<a href="<?php echo UU('Index/Changecity/index');?>">切换城市</a>]</div>
				<div class="span" style="padding-right:10px;">|</div><?php endif; ?>
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
	<?php $one_adver = D("Adver")->get_one_adver("index_top"); if(is_array($one_adver)): ?><div class="content">
			<div class="banner" style="background:<?php echo ($one_adver["bg_color"]); ?>">
				<div class="hot"><a href="<?php echo ($one_adver["url"]); ?>" title="<?php echo ($one_adver["name"]); ?>"><img src="<?php echo ($one_adver["pic"]); ?>" /></a></div>
			</div>
		</div><?php endif; ?>
    <div class="nav cf">
		<div class="logo">
			<a href="<?php echo ($config["site_url"]); ?>" title="<?php echo ($config["site_name"]); ?>">
				<img  src="<?php echo ($config["site_logo"]); ?>" />
			</a>
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
						<div class="menu_left_top"><img src="<?php echo ($static_path); ?>images/o2o1_27.png" /></div>
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
		</div>
		<div class="banner activity_banner">
			<div class="banner_img">
				<img src="<?php echo ($static_path); ?>images/lifeservice_banner.png" style="height:260px;"/>
			</div>
        </div>
        <div class="body">
			<div class="recharge-box">
				<div class="tab">
					<?php $liveServiceTypeArr = explode(',',$config['live_service_type']); ?>
					<?php if(in_array('phone',$liveServiceTypeArr)): ?><a class="phone" data-type="phone">充话费</a><?php endif; ?>
					<?php if(in_array('flow',$liveServiceTypeArr)): ?><a class="flow" data-type="flow">充流量</a><?php endif; ?>
					<?php if(in_array('water',$liveServiceTypeArr)): ?><a class="water" data-type="water">缴水费</a><?php endif; ?>
					<?php if(in_array('electric',$liveServiceTypeArr)): ?><a class="electric" data-type="electric">缴电费</a><?php endif; ?>
					<?php if(in_array('gas',$liveServiceTypeArr)): ?><a class="gas" data-type="gas">缴煤气费</a><?php endif; ?>
				</div>
				<div class="pnl pnl-phone">
					<div class="tb-wt">
						<span class="tb-wt-form-fields"></span>
						<div class="tb-wt-row tb-wt-number">
							<label class="tb-wt-control" for="phone_txt">充值号码：</label>
							<div class="tb-wt-content"><input autocomplete="off" id="phone_txt" type="tel" class="txt"/></div>
							<span class="trigger history-trigger" title="查看充值历史"></span>
							<label for="phone_txt" class="tb-wt-placeholder">输入手机号码</label>
						</div>
						<div class="tb-wt-location"></div>
						<div class="tb-wt-row tb-wt-denom">
							<label class="tb-wt-control" for="JCZ4">充值面值：</label>
							<div class="tb-wt-content">
								<ul>
									<li class="tb-wt-active"><span><strong>100</strong>元</span></li>
									<li class=""><span><strong>50</strong>元</span></li>
									<li class=""><span><strong>30</strong>元</span></li>
									<li class="tb-wt-drop"><span><strong>10</strong>元<s></s></span></li>
								</ul>
							</div>
						</div>
						<div class="tb-wt-row tb-wt-price">
							<label class="tb-wt-control">销售价格：</label>
							<div class="tb-wt-txt"><span>¥</span><strong>98-99.5</strong></div>
						</div>
						<div class="tb-wt-row tb-wt-action">
							<button type="button" id="recharge_phone_btn">立即充值</button>
							<span class="tb-wt-ad"><a href="#" target="_blank" data-spm-anchor-id="0.0.0.0">话费充50抢10元</a></span>
						</div>
					</div>
				</div>
				<div class="pnl pnl-flow">
					<div class="tb-wt">
						<span class="tb-wt-form-fields"></span>
						<div class="tb-wt-row tb-wt-number">
							<label class="tb-wt-control" for="flow_txt">手机号码：</label>
							<div class="tb-wt-content"><input autocomplete="off" id="flow_txt" type="tel" class="txt"/></div>
							<span class="trigger history-trigger" title="查看充值历史"></span>
							<label for="flow_txt" class="tb-wt-placeholder">输入手机号码</label>
						</div>
						<div class="tb-wt-location"></div>
						<div class="tb-wt-row tb-wt-denom">
							<label class="tb-wt-control" for="JCZ4">充值类型：</label>
							<div class="tb-wt-content">
								<ul>
									<li class="tb-wt-active"><span><strong>全国</strong></span></li>
									<li><span><strong>省内</strong></span></li>
								</ul>
							</div>
						</div>
						<div class="tb-wt-row tb-wt-denom">
							<label class="tb-wt-control" for="JCZ4">充值流量：</label>
							<div class="tb-wt-content">
								<ul>
									<li class="tb-wt-active"><span><strong>60</strong>M</span></li>
									<li><span><strong>150</strong>M</span></li>
									<li><span><strong>300</strong>M</span></li>
								</ul>
							</div>
						</div>
						<div class="tb-wt-row tb-wt-price">
							<label class="tb-wt-control">销售价格：</label>
							<div class="tb-wt-txt"><span>¥</span><strong>98-99.5</strong></div>
						</div>
						<div class="tb-wt-row tb-wt-action">
							<button type="button" id="recharge_flow_btn">立即充值</button>
						</div>
					</div>
				</div>
				<div class="pnl pnl-water">
					<div class="tb-wt">
						<span class="tb-wt-form-fields"></span>
						<div class="tb-wt-row tb-wt-number">
							<label class="tb-wt-control" for="water_txt">户号：</label>
							<div class="tb-wt-content"><input autocomplete="off" id="water_txt" type="text" class="txt"/></div>
							<span class="trigger history-trigger" title="查看充值历史"></span>
							<label for="water_txt" class="tb-wt-placeholder" style="visibility:visible;">输入您的户号</label>
						</div>
						<div class="tb-wt-location"></div>
						<div class="tb-wt-row tb-wt-action">
							<button type="button" id="recharge_water_btn">查询</button>
						</div>
					</div>
					<div class="tb-tip">
						<dl>
							<dt>问：怎么找到缴费户号？</dt>
							<dd>答：通过催缴单、拨打事业单位服务热线或银行缴费回执中找到户号。</dd>
							<dt>问：缴费多长时间到帐？</dt>
							<dd>答：一般会在10分钟之内到帐，月初会有一小时内的延迟。如果充值失帐，金额会回到您的帐户上。</dd>
							<dt>问：怎么知道缴费成功？</dt>
							<dd>答：1、您可以在会员中心->生活订单中查看缴费状态<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2、您在本页面再查询一次，提醒未欠费表示已成功。<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3、若您的帐号绑定过微信号，您的微信能收到我们公众号推送的缴费提醒消息</dd>
						</dl>
					</div>
				</div>
				<div class="pnl pnl-electric">
					<div class="tb-wt">
						<span class="tb-wt-form-fields"></span>
						<div class="tb-wt-row tb-wt-number">
							<label class="tb-wt-control" for="electric_txt">户号：</label>
							<div class="tb-wt-content"><input autocomplete="off" id="electric_txt" type="text" class="txt"/></div>
							<label for="electric_txt" class="tb-wt-placeholder" style="visibility:visible;">输入您的户号</label>
						</div>
						<div class="tb-wt-location"></div>
						<div class="tb-wt-row tb-wt-action">
							<button type="button" id="recharge_electric_btn">查询</button>
						</div>
					</div>
					<div class="tb-tip">
						<dl>
							<dt>问：怎么找到缴费户号？</dt>
							<dd>答：通过催缴单、拨打事业单位服务热线或银行缴费回执中找到户号。</dd>
							<dt>问：缴费多长时间到帐？</dt>
							<dd>答：一般会在10分钟之内到帐，月初会有一小时内的延迟。如果充值失帐，金额会回到您的帐户上。</dd>
							<dt>问：怎么知道缴费成功？</dt>
							<dd>答：1、您可以在会员中心->生活订单中查看缴费状态<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2、您在本页面再查询一次，提醒未欠费表示已成功。<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3、若您的帐号绑定过微信号，您的微信能收到我们公众号推送的缴费提醒消息</dd>
						</dl>
					</div>
				</div>
				<div class="pnl pnl-gas">
					<div class="tb-wt">
						<span class="tb-wt-form-fields"></span>
						<div class="tb-wt-row tb-wt-number">
							<label class="tb-wt-control" for="gas_txt">户号：</label>
							<div class="tb-wt-content"><input autocomplete="off" id="gas_txt" type="text" class="txt"/></div>
							<span class="trigger history-trigger" title="查看充值历史"></span>
							<label for="gas_txt" class="tb-wt-placeholder" style="visibility:visible;">输入您的户号</label>
						</div>
						<div class="tb-wt-location"></div>
						<div class="tb-wt-row tb-wt-action">
							<button type="button" id="recharge_gas_btn">查询</button>
						</div>
					</div>
					<div class="tb-tip">
						<dl>
							<dt>问：怎么找到缴费户号？</dt>
							<dd>答：通过催缴单、拨打事业单位服务热线或银行缴费回执中找到户号。</dd>
							<dt>问：缴费多长时间到帐？</dt>
							<dd>答：一般会在10分钟之内到帐，月初会有一小时内的延迟。如果充值失帐，金额会回到您的帐户上。</dd>
							<dt>问：怎么知道缴费成功？</dt>
							<dd>答：1、您可以在会员中心->生活订单中查看缴费状态<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2、您在本页面再查询一次，提醒未欠费表示已成功。<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3、若您的帐号绑定过微信号，您的微信能收到我们公众号推送的缴费提醒消息</dd>
						</dl>
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