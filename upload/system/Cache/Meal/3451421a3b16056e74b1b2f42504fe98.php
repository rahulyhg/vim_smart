<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<title><?php echo ($store["name"]); ?>网上<?php echo ($config["meal_alias_name"]); ?>_<?php echo ($store["name"]); ?>电话|<?php echo ($store["name"]); ?>外卖|<?php echo ($store["name"]); ?>菜单 - <?php echo ($config["site_name"]); ?></title>
<meta name="keywords" content="<?php echo ($store["name"]); ?>网上<?php echo ($config["meal_alias_name"]); ?>,<?php echo ($store["name"]); ?>电话,<?php echo ($store["name"]); ?>外卖,<?php echo ($store["name"]); ?>菜单,<?php echo ($config["seo_keywords"]); ?>" />
<meta name="description" content="<?php echo ($config["seo_description"]); ?>" />
<link href="<?php echo ($static_path); ?>css/css.css" type="text/css" rel="stylesheet">
<link href="<?php echo ($static_path); ?>css/shop.css" type="text/css" rel="stylesheet">
<link href="<?php echo ($static_path); ?>css/kuaisonWM.css" type="text/css" rel="stylesheet">
<link href="<?php echo ($static_path); ?>css/header.css" type="text/css" rel="stylesheet">
<link href="<?php echo ($static_path); ?>css/shop_header.css" type="text/css" rel="stylesheet">
<link href="<?php echo ($static_path); ?>css/ydyfx.css" type="text/css" rel="stylesheet">
<link href="<?php echo ($static_path); ?>css/a.css" type="text/css" rel="stylesheet">
<link href="<?php echo ($static_path); ?>css/meal_detail.css" type="text/css" rel="stylesheet">
<script src="<?php echo ($static_path); ?>js/jquery-1.7.2.js"></script>
<script src="<?php echo ($static_public); ?>js/jquery.lazyload.js"></script>
<script src="<?php echo ($static_public); ?>js/layer/layer.js"></script>
<script type="text/javascript">var  meal_alias_name = "<?php echo ($config["meal_alias_name"]); ?>";</script>
<script src="<?php echo ($static_path); ?>js/common.js"></script>
<script src="<?php echo ($static_path); ?>js/requestAnimationFrame.js"></script>
<script src="<?php echo ($static_path); ?>js/fly.js"></script>
<script type="text/javascript">var store_id = '<?php echo ($store['store_id']); ?>', get_reply_url="<?php echo U('Index/Reply/ajax_get_list',array('order_type'=>1,'parent_id'=>$store['store_id'],'store_count'=>1));?>",default_avatar="<?php echo ($static_path); ?>images/meal_default_avatar.png";</script>
<script src="<?php echo ($static_path); ?>js/buy.js"></script>
<style type="text/css">

</style>
</head>
<body>
<header>
	<header class="header" style="padding-bottom:10px;"> 
		<div class="content">
			<div class="header_top">
				<div class="hot">
			        <div class="loginbar cf">
						<?php if($now_select_city): ?><div class="span" style="font-size:16px;color:red;padding-right:3px;cursor:default;"><?php echo ($now_select_city["area_name"]); ?></div>
							<div class="span" style="padding-right:10px;">[<a href="<?php echo UU('Index/Changecity/index');?>">切换城市</a>]</div>
							<div class="span" style="padding-right:10px;">|</div><?php endif; ?>
						<?php if(empty($user_session)): ?><div class="login"><a href="<?php echo U('Index/Login/index');?>"> 登录 </a></div>
							<div class="regist"><a href="<?php echo U('Index/Login/reg');?>">注册 </a></div>
						<?php else: ?>
							<p class="user-info__name growth-info growth-info--nav">
								<span>
									<a rel="nofollow" href="<?php echo U('User/Index/index');?>" class="username"><?php echo ($user_session["nickname"]); ?></a>
								</span>
								<a class="user-info__logout" href="<?php echo U('Index/Login/logout');?>">退出</a>
							</p><?php endif; ?>
						<div class="span">|</div>
						<div class="weixin cf">
							<div class="weixin_txt"><a href="<?php echo ($config["site_url"]); ?>/topic/weixin.html"> 微信版</a></div>
							<div class="weixin_icon"><p><span>|</span><a href="<?php echo ($config["site_url"]); ?>/topic/weixin.html">访问微信版</a></p><img src="<?php echo ($config["wechat_qrcode"]); ?>"/></div>
						</div>
			        </div>
			        <div class="list">
						<ul class="cf">
							<li>
								<div class="li_txt"><a href="<?php echo U('User/Index/index');?>">我的订单</a></div>
								<div class="span">|</div>
							</li>
							<li class="li_txt_info cf">
								<div class="li_txt_info_txt"><a href="<?php echo U('User/Index/index');?>">我的信息</a></div>
								<div class="li_txt_info_ul">
									<ul class="cf">
										<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo U('User/Index/index');?>">我的订单</a></li>
										<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo U('User/Rates/index');?>">我的评价</a></li>
										<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo U('User/Collect/index');?>">我的收藏</a></li>
										<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo U('User/Point/index');?>">我的积分</a></li>
										<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo U('User/Credit/index');?>">帐户余额</a></li>
										<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo U('User/Adress/index');?>">收货地址</a></li>
									</ul>
								</div>
								<div class="span">|</div>
							</li>
							<li class="li_liulan">
								<div class="li_liulan_txt"><a>最近浏览</a></div>	 
								<div class="history" id="J-my-history-menu"></div> 
								<div class="span">|</div>
							</li>
							<li class="li_shop">
								<div class="li_shop_txt"><a>我是商家</a></div>
								<ul class="li_txt_info_ul cf">
									<li><a class="dropdown-menu__item first" rel="nofollow" href="<?php echo ($config["site_url"]); ?>/merchant.php">商家中心</a></li>
									<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo ($config["site_url"]); ?>/merchant.php">我想合作</a></li>
								</ul>
							</li>
						</ul>
			        </div>
				</div>
			</div>
			<div style="clear:both"></div>
		</div>
		<div class="nav">
			<div class="logo">
			<a href="<?php echo ($config["site_url"]); ?>" title="<?php echo ($config["site_name"]); ?>">
				<img src="<?php echo ($config["site_logo"]); ?>" />
			</a>
			</div>
			<div class="search">
				<form action="<?php echo U('Meal/Search/index');?>" method="post" group_action="<?php echo U('Group/Search/index');?>" meal_action="<?php echo U('Meal/Search/index');?>">
					<div class="form_sec">
						<div class="form_sec_txt meal"><?php echo ($config["meal_alias_name"]); ?></div>
						<div class="form_sec_txt1 group"><?php echo ($config["group_alias_name"]); ?></div>
					</div>
					<input name="w" class="input" type="text" placeholder="请输入商品名称、地址等"/>
					<button value="" class="btnclick"><img src="<?php echo ($static_path); ?>images/o2o1_20.png"  /></button>
				</form>
			</div>
			<div class="menu">
				<div class="ment_left">
					<div class="ment_left_img"><img src="<?php echo ($static_path); ?>images/dianpu_03.png"/></div>
					<a href="<?php echo ($config["site_url"]); ?>"><div class="ment_left_txt">主页</div></a>
				</div>
				<div class="hr">|</div>
				<div class="ment_left" style="margin-left:15px;">
					<div class="ment_left_img"><img src="<?php echo ($static_path); ?>images/dianpu_05.png"></div>
					<a href="<?php echo U('User/Index/meal_list');?>"><div class="ment_left_txt">我的订单</div></a>
				</div>
			</div>
			<div style="clear:both"></div>
		</div>
		<div style="clear:both"></div>
 	</header>
  	<div class="shopping-cart clearfix" data-status="1" data-poiname="<?php echo ($store["name"]); ?>" data-poiid="<?php echo ($store["store_id"]); ?>">
		<form method="post" action="/meal/order/<?php echo ($store['store_id']); ?>.html" id="shoppingCartForm">
			<div class="order-list">
				<div class="title cf">
					<span class="fl dishes">商品<a href="javascript:;" class="clear-cart">[清空]</a></span>
					<span class="fl">份数</span>
					<span class="fl ti-price">价格</span>
				</div>
				<ul class="clearfix">
				</ul>
				<div class="other-charge hidden">
					<div class="clearfix packing-cost hidden">
						<span class="fl">包装盒</span>
						<span class="fr boxtotalprice">￥0</span>
					</div>
					<div class="clearfix delivery-cost">
						<span class="fl">配送费</span>
						<span class="fr shippingfee">￥0</span>
					</div>
				</div>
				<div class="privilege hidden"></div>
				<div class="total">共<span class="totalnumber">0</span>份，总计<span class="bill">￥0</span></div>
			</div>
			   
			<div class="footer clearfix">
				<div class="logo fl" id="i-shopping-cart"></div>
				<div class="brief-order fl">
					<span class="count"></span>
					<span class="tprice"></span>
				</div>
				<div class="fr">
					<a class="ready-pay borderradius-2" href="javascript:;">还是空的<!--还差<span data-left="20" class="margintominprice">20</span>元起送--></a>
					<input class="go-pay borderradius-2" type="submit" value="去下单">
					<input type="hidden" value="" class="order-data" name="shop_cart" id="shop_cart">
				</div>
			</div>
		</form>
	</div>
	<div class="w-1200 cf">
		<div class="grid_subHead clearfix">
			<div class="col_main">
				<div class="col_sub">
					<div class="shop_logo"><img src="<?php echo ($store['images'][0]); ?>"></div>
				</div>
				<div class="main_wrap cf">
					<div class="mian_wrap_shop">
						<div class="shop_name"><?php echo ($store['name']); ?></div>
						<div class="top_shop_qrcode">微信访问<img src="<?php echo ($config["site_url"]); ?>/index.php?g=Index&c=Recognition&a=see_qrcode&type=meal&id=<?php echo ($store['store_id']); ?>" /></div>
					</div>
					<div class="main_wrap_left">
						<div class="appraise_title cf">
							<div class="appraise_icon"><div><span style="width:<?php echo ($store['score_mean']/5*100); ?>%"></span></div></div>
							<em><?php echo ($store['score_mean']); ?> 分</em>
						</div>
	 					<p class="shop_state">营业时间：<?php echo ($store['office_time']); if($store['state']): ?><span class="inner state_1" id="state_node">营业中</span><?php else: ?><span class="inner state_3" id="state_node">已打烊，还可以预订</span><?php endif; ?></p>
						<p class="shop_address">地址：<?php echo ($store['adress']); ?></p>
					</div>
					<div class="main_wrap_right">
						<ul class="songcan_data clearfix">
							<li class="songda">
								<strong><em><?php echo ($store['send_time']); ?>分钟</em></strong>
								<span>送达时间</span>
							</li>
							<li class="renjun">
								<strong><em><?php echo floatval($store['basic_price']);?>元</em></strong>
								<span>起送价</span>
							</li>
							<li class="peison">
								<strong><em class="psfee_"><?php echo floatval($store['delivery_fee']);?>元</em></strong>
								<span>配送费</span>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!--div class="announcement po_re" id="announcement">
			<div class="announcement_left cf">
				<div class="clearfix" id="at_inner"> <span class="tit"><img src="<?php echo ($static_path); ?>images/dianpu_31.png"></span>
					<div class="inner" style="display:block;width:719px;"><?php if($store['store_notice'] != '' AND $store['store_notice'] != ' '): echo ($store['store_notice']); else: ?>本店暂无公告<?php endif; ?></div>
					<div class="inner" style="display:none;">支持开发票，开票金额100元起。请在下单时填好发票抬头</div>
					<div class="inner" style="display:none;">本店招聘聘外卖员</div>
				</div>
			</div>
			<div class="ft">
				<?php if($store['zeng']): ?><div class="display11"><span class="i_zeng"></span> <?php echo ($store['zeng']); ?></div>
				<div style="clear:both"></div><?php endif; ?>
				<?php if($store['full_money'] != 0.00 AND $store['minus_money'] != 0.00): ?><div class="display11"><span class="i_jian"></span> 支持立减优惠，每单满<?php echo ($store['full_money']); ?>元减<?php echo ($store['minus_money']); ?>元</div>
				<div style="clear:both"></div><?php endif; ?>
				<?php if($store['song']): ?><div class="display11"><span class="i_first"></span> <?php echo ($store['song']); ?></div><?php endif; ?>
			</div>
			<div style="clear:both"></div>
		</div-->
	</div>
</header>
<div class="body"> 
	<article class="shop_list cf">
		<div class="tabright">
			<div class="notice_title">店铺公告</div>
			<div class="notice_con"><?php if($store['store_notice'] != '' AND $store['store_notice'] != ' '): echo ($store['store_notice']); else: ?>本店暂无公告<?php endif; ?></div>
			<div class="notice_discount">
				<?php if($store['zeng']): ?><div class="display11 zeng"><?php echo ($store['zeng']); ?></div><?php endif; ?>
				<?php if($store['full_money'] != 0.00 AND $store['minus_money'] != 0.00): ?><div class="display11 jian">每单满<?php echo ($store['full_money']); ?>元减<?php echo ($store['minus_money']); ?>元</div><?php endif; ?>
				<?php if($store['song']): ?><div class="display11 song"><?php echo ($store['song']); ?></div><?php endif; ?>
			</div>
		</div>
		<div class="tab1" id="tab1">
			<div class="menu" style="color: #4c4c4c;">
				<ul class="cf">
					<li class="off tab">商品列表</li>
					<li class="tab">网友点评<?php if($store['reply_count']): ?><span>(<?php echo ($store['reply_count']); ?>)</span><?php endif; ?></li>
					<li class="merchantWeb"><a href="<?php echo ($config["site_url"]); ?>/merindex/<?php echo ($store["mer_id"]); ?>.html" target="_blank">商家网站</a></li>
				</ul>
				<div class="btmline"></div>
			</div>
			<div class="menudiv">
				<div id="con_one_1">
					<section>
						<div class="content">
							<div class="bgk">
								<div id="prolist">
									<div class="can_cat cf">
										<div class="bd">
											<ul class="clearfix">
												<?php if(is_array($sorts)): $i = 0; $__LIST__ = $sorts;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sort): $mod = ($i % 2 );++$i; if($sort['meals']['pic'] OR $sort['meals']['txt']): ?><li>
													<a href="#sort_<?php echo ($sort['sort_id']); ?>" data-scrolld="plist_<?php echo ($sort['sort_id']); ?>"><?php echo ($sort['sort_name']); ?></a>
												</li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
											</ul>
										</div>
									</div>
									<?php if(is_array($sorts)): $y = 0; $__LIST__ = $sorts;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($y % 2 );++$y; if($vo['meals']['list']): ?><div class="module_s module_s_open">
											<div class="hd">
												<div class="tit"><?php echo ($vo["sort_name"]); ?></div>
												<a href="javascript:;" class="s module_s_open_btn" name="sort_<?php echo ($vo['sort_id']); ?>">收起</a>
											</div>
											<div class="bd">
												<ul class="img clearfix">
													<?php if(is_array($vo['meals']['list'])): $j = 0; $__LIST__ = $vo['meals']['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$meal): $mod = ($j % 2 );++$j;?><li class="item_<?php echo ($meal['meal_id']); ?> buygoods <?php if($j%3 == 0 || $j == count($vo['meals']['list'])): ?>last-br<?php endif; ?> <?php if($j > 3): ?>no-bt<?php endif; ?>" id="<?php echo ($meal['meal_id']); ?>" data-title="<?php echo ($meal['des']); ?>">
															<a href="javascript:;" class="link" name="meal_<?php echo ($meal['meal_id']); ?>">
																<img class="lazy_img" src="http://hf.pigcms.com/static/images/blank.gif" data-original="<?php if($meal['image']): echo ($meal['image']); else: ?>../static/images/nopic.jpg<?php endif; ?>" />
																<div class="product_info">
																	<span class="tit"><?php echo ($meal['name']); ?></span>
																	<span class="price">¥<?php echo floatval($meal['price']);?>/<?php echo ($meal['unit']); ?></span>
																	<span class="add_btn"></span>
																</div>
																<span class="buycar" data-id="<?php echo ($meal['meal_id']); ?>" data-name="<?php echo ($meal['name']); ?>" data-price="<?php echo floatval($meal['price']);?>" data-mincount="1">来一<?php echo ($meal['unit']); ?></span>
																<span class="buycar2" style="display: none;">已点</span>
															</a>
														</li><?php endforeach; endif; else: echo "" ;endif; ?>
												</ul>
											</div>
										</div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
								</div>
							</div>
						</div>
					</section>
				</div>
				<div id="con_one_2" style="display:none;">
					<div class="content_left">
						<div class="appraise_list cf">
							<div class="appraise_li">
								<div class="zzsc">
									<div class="tab">
										<div class="tab_title rate-filter__item">
											<a href="javascript:;" class="on" data-tab="all">全部</a>
											<a href="javascript:;" data-tab="high">好评</a>
											<a href="javascript:;" data-tab="mid">中评</a>
											<a href="javascript:;" data-tab="low">差评</a>
											<a href="javascript:;" data-tab="withpic">有图</a>
										</div>
										<div class="tab_form">
											<div class="form_sec">
												<select name="时间排序" class="select J-filter-ordertype">
													<option value="default">默认排序</option>
													<option value="time">时间排序</option>
													<option value="score">好评排序</option>
												</select>
											</div>
										</div>
									</div>
									<div class="content ratelist-content">
										<div class="appraise_li-list">
											<dl class="J-rate-list"></dl>
										</div>
										<div class="page J-rate-paginator cf"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</article>
</div>
<footer>
	<div class="footer1">
		<div class="footer_txt cf">
			<div class="footer_list cf">
				<ul class="cf">
					<?php $footer_link_list = D("Footer_link")->get_list();if(is_array($footer_link_list)): $i = 0;if(count($footer_link_list)==0) : echo "列表为空" ;else: foreach($footer_link_list as $key=>$vo): ++$i;?><li><a href="<?php echo ($vo["url"]); ?>" target="_blank"><?php echo ($vo["name"]); ?></a><?php if($i != count($footer_link_list)): ?><span>|</span><?php endif; ?></li><?php endforeach; endif; else: echo "列表为空" ;endif; ?>
				</ul>
			</div>
			<div class="footer_txt"><?php echo nl2br(strip_tags($config['site_show_footer'],'<a>'));?></div>
		</div>
	</div>
</footer>
<div style="display:none;"><?php echo ($config["site_footer"]); ?></div>
<!--悬浮框-->
<div class="rightsead">
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
</div>
<!--leftsead end-->
</body>
</html>