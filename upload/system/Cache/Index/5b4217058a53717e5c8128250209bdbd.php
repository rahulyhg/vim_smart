<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" " http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns=" http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<title><?php echo ($config["seo_title"]); ?></title>
	<meta name="keywords" content="<?php echo ($config["seo_keywords"]); ?>" />
	<meta name="description" content="<?php echo ($config["seo_description"]); ?>" />
	<link href="<?php echo ($static_path); ?>css/shop_shop_header.css"  rel="stylesheet"  type="text/css" />
	<script src="<?php echo ($static_path); ?>js/jquery-1.7.2.js"></script>
	<script src="<?php echo ($static_path); ?>js/jquery.nav.js"></script>
	<script src="<?php echo ($static_path); ?>js/navfix.js"></script>	
	<link rel="stylesheet" href="<?php echo ($static_path); ?>css/shop_shop.css">
	<link href="<?php echo ($static_path); ?>css/shop.css" type="text/css" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="<?php echo ($static_path); ?>css/footer.css">
	<link rel="stylesheet" href="<?php echo ($static_path); ?>css/shop_activity.css">
		<script type="text/javascript">
	   var  meal_alias_name = "<?php echo ($config["meal_alias_name"]); ?>";
	</script>
	<script src="<?php echo ($static_path); ?>js/common.js" type="text/javascript"></script>
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
		body{ behavior:url("csshover.htc"); }
		</style>
	<![endif]-->
</head>
<body>
	<div class="header_top">
    <div class="hot cf">
        <div class="loginbar cf">
			<?php if(empty($user_session)): ?><div class="login"><a href="<?php echo UU('Index/Login/index');?>"> 登陆 </a></div>
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
				<div class="weixin_txt"><a href="<?php echo ($config["site_url"]); ?>/topic/weixin.html" target="_blank"> 微信版</a></div>
				<div class="weixin_icon"><p><span>|</span><a href="<?php echo ($config["site_url"]); ?>/topic/weixin.html" target="_blank">访问微信版</a></p><img src="<?php echo ($config["wechat_qrcode"]); ?>"/></div>
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
	<div style="border-bottom:2px solid #d9d9d9;">
		<div class="nav cf">
			<div class="logo">
				<a href="<?php echo ($config["site_url"]); ?>" title="<?php echo ($config["site_name"]); ?>">
					<img  src="<?php echo ($config["site_logo"]); ?>" />
				</a>
			</div>
			<div class="search">
				<form action="<?php echo U('Group/Search/index');?>" method="post" group_action="<?php echo U('Group/Search/index');?>" meal_action="<?php echo U('Meal/Search/index');?>">
					<div class="form_sec">
					<div class="form_sec_txt meal"><?php echo ($config["meal_alias_name"]); ?></div>
					<div class="form_sec_txt1 group"><?php echo ($config["group_alias_name"]); ?></div>
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
    </div>
</header>


<div class="w-1200">
	<div class="grid_subHead clearfix">
		<div class="col_main">
			<div class="col_sub">
				<div class="shop_logo"> <!-- -->
					<img src="<?php echo ($merchantarr['imgs'][0]); ?>"/>
				</div>
			</div>
			      <div class="main_wrap">
        <div class="mian_wrap_shop">
          <div class="shop_name"><?php echo ($merchantarr['name']); ?></div>
          <div class="shop_icon_shop">
		  <?php if($merchantarr['issign'] == 1): ?><span><img src="<?php echo ($static_path); ?>images/shop-shop_03.png"></span><?php endif; ?>
		  <?php if($merchantarr['isverify'] == 1): ?><span><img src="<?php echo ($static_path); ?>images/shop-shop_05.png"></span><?php endif; ?>
		  </div>
        </div>
        <div class="main_wrap_left">
			<p class="shop_address">地址：<?php echo ($merchantmstore['areastr']); ?> - <?php echo ($merchantmstore['adress']); ?></p>
			<div class="shop_icon">
				<ul>
					<li title="商家联系电话">
						<div class="shop_icon_img"><img src="<?php echo ($static_path); ?>images/shop-shop_14.png"></div>
						<div class="shop_icon_img"><?php echo ($merchantmstore['phone']); ?></div>
					</li>
					<?php if(!empty($merchantmstore['weixin'])): ?><li title="商家微信号">
							<div class="shop_icon_img"><img src="<?php echo ($static_path); ?>images/shop-shop_17.png"></div>
							<div class="shop_icon_img"><?php echo ($merchantmstore['weixin']); ?></div>
						</li><?php endif; ?>
					<?php if(!empty($merchantmstore['qq'])): ?><li title="商家联系QQ">
							<div class="shop_icon_img"><img src="<?php echo ($static_path); ?>images/shop-shop_19.png"></div>
							<div class="shop_icon_img"><a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo ($merchantmstore['qq']); ?>&site=qq&menu=yes" target="_blank"><?php echo ($merchantmstore['qq']); ?></a></div>
						</li><?php endif; ?>
					<div style="clear:both"></div>
				</ul>
			</div>
        </div>
        <div style="clear:both"></div>
      </div>
		</div>
		<div class="mobile_href po_ab">
			<div class="mobile_href_img">
				<img src="<?php echo U('Index/Recognition/see_qrcode',array('type'=>'merchant','id'=>$merid));?>" width="90" height="90" alt=""/>
				<p style="line-height:20px;font-size:12px;">微信扫一扫访问</p>
			</div>
		</div>
		<div style="clear:both"></div>
	</div>
	<div style="clear:both"></div>
</div>
	<menu class="shop_menu">
  <div class="box_menu" id="mealallprolist">
    <ul>
      <li <?php if($isindex): ?>class="crun"<?php endif; ?>><a href="<?php echo ($config["site_url"]); ?>/merindex/<?php echo ($merid); ?>.html">首页</a></li>
	  <?php if(is_array($navmanag)): $i = 0; $__LIST__ = $navmanag;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nv): $mod = ($i % 2 );++$i;?><li <?php if($nv['currenturl']): ?>class="crun"<?php endif; ?>><a href="<?php echo ($config["site_url"]); ?>/<?php echo ($nv['url']); ?>/<?php echo ($merid); ?>.html"><?php echo ($nv['zhname']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
      <div style="clear:both"></div>
    </ul>
  </div>
</menu>
<!---<menu class="shop_menu">
  <div class="box_menu">
    <ul>
      <li class="crun"><a href="shop_shop.html">首页</a></li>
      <li><a href="shop_introduction.html">商家介绍</a></li>
      <li><a href="shop_dynamics.html">商家动态 </a></li>
      <li><a href="shop_photo.html">商家相册</a></li>
      <li><a href="shop_video.html">全景视频 </a></li>
      <li><a href="shop_goods.html">商品大全</a></li>
      <li><a href="shop_activity.html"><?php echo ($config["group_alias_name"]); ?>活动 </a></li>
      <li><a href="shop_server.html">客户服务</a></li>
      <li><a href="shop_jion.html">招商加盟</a></li>
      <li><a href="shop_comment.html">网友点评</a></li>
      <div style="clear:both"></div>
    </ul>
  </div>
</menu>--->
	<div class="article cf">
		<section class="server">
			<div class="section_title cf">
				<div class="section_txt"><?php echo ($config["group_alias_name"]); ?>活动</div>
				<div class="section_border"></div>
			</div>
			<article class="category" id="f1">
				<div class="category_list">
				   <?php if(!empty($purchase)): ?><ul class="cf">
							<?php if(is_array($purchase)): $kk = 0; $__LIST__ = $purchase;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pv): $mod = ($kk % 2 );++$kk;?><li <?php if($kk%4 == 0): ?>class="last--even" <?php else: ?> class="border1"<?php endif; ?>>
								   <a href="<?php echo ($pv['url']); ?>" target="_blank">
										<div class="category_list_img"> 
											<img src="<?php echo ($pv['list_pic']); ?>" class="proimg"/>
											<div class="bmbox">
												<div class="bmbox_title">该商家有 <span><?php echo ($pv['fans_count']); ?></span> 个粉丝</div>
												<div class="bmbox_list">
													<div class="bmbox_list_img"><img src="<?php echo U('Index/Recognition/see_qrcode',array('type'=>'group','id'=>$pv['group_id']));?>" class="ewm"></div>
													<div class="bmbox_list_li">
														<ul>
															<li class="open_windows" data-url="<?php echo ($config["site_url"]); ?>/merindex/<?php echo ($merid); ?>.html">商家</li>
															<li class="open_windows" data-url="<?php echo ($config["site_url"]); ?>/meractivity/<?php echo ($merid); ?>.html"><?php echo ($config["group_alias_name"]); ?></li>
															<li class="open_windows" data-url="<?php echo ($config["site_url"]); ?>/mergoods/<?php echo ($merid); ?>.html"><?php echo ($config["meal_alias_name"]); ?></li>
															<li class="open_windows" data-url="<?php echo ($config["site_url"]); ?>/mermap/<?php echo ($merid); ?>.html">地图</li>
														</ul>
													</div>
												</div>
											</div>
										</div>
									</a>
									<div class="datal cf">
										<a href="<?php echo ($pv['url']); ?>" target="_blank">
											<div class="category_list_title">【<?php echo ($pv['prefix_title']); ?>】<?php echo ($pv['s_name']); ?></div>
											<div class="category_list_description"><?php echo ($pv['group_name']); ?></div>
										</a>
										<div class="deal-tile__detail cf">
											<span id="price">¥<strong><?php echo ($pv['price']); ?></strong> </span>
											<span>门店价¥<?php echo ($pv['old_price']); ?></span>
											<?php if($pv['wx_cheap']): ?><div class="cheap">微信购买立减￥<?php echo ($pv['wx_cheap']); ?></div><?php endif; ?>
										</div>
										<div class="extra-inner">
											<div class="sales">
												<div class="actity_txt"> 已售 <span><?php echo ($pv['sale_count']+$pv['virtual_num']); ?></span></div>
											</div>
										</div>
									</div>
								</li><?php endforeach; endif; else: echo "" ;endif; ?>
					    </ul>
					<?php else: ?>
					 <div style="margin-top:10px;font-size:16px">暂无<?php echo ($config["group_alias_name"]); ?>商品</div><?php endif; ?>
				</div>
			</article>
		</section>
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