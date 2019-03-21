<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<title>【<?php echo ($now_group["merchant_name"]); ?>预约】<?php echo ($now_group["appoint_name"]); ?>预约 - <?php echo ($config["site_name"]); ?></title>
		<meta name="keywords" content="<?php echo ($now_group["merchant_name"]); ?>,<?php echo ($now_group["appoint_name"]); ?>,<?php echo ($config["site_name"]); ?>" />
		<meta name="description" content="<?php echo ($now_group["appoint_content"]); ?>" />
		<link href="<?php echo ($static_path); ?>css/css.css" type="text/css"  rel="stylesheet" />
		<link href="<?php echo ($static_path); ?>css/header.css"  rel="stylesheet"  type="text/css" />
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/shopping.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/table.css"/>
		 	<script type="text/javascript">
			var  meal_alias_name = "<?php echo ($config["meal_alias_name"]); ?>";
			</script>
		<script src="<?php echo ($static_path); ?>js/jquery-1.7.2.js"></script>
		<script src="<?php echo ($static_public); ?>js/jquery.lazyload.js"></script>
		<script src="<?php echo ($static_path); ?>js/common.js"></script>
		<script>var site_url = "<?php echo ($config["site_url"]); ?>";var store_long="<?php echo ($now_group["store_list"]["0"]["long"]); ?>";var store_lat="<?php echo ($now_group["store_list"]["0"]["lat"]); ?>";var get_reply_url="<?php echo U('Index/Reply/ajax_get_list',array('order_type'=>0,'parent_id'=>$now_group['group_id'],'store_count'=>count($now_group['store_list'])));?>";var collect_url="<?php echo U('Index/Collect/collect');?>";var login_url="<?php echo U('Index/Login/frame_login');?>";save_history("<?php echo ($now_group["appoint_name"]); ?>","<?php echo ($now_group["all_pic"]["0"]["m_image"]); ?>","<?php echo ($now_group["url"]); ?>","","预约");</script>
		
		<script src="<?php echo ($static_public); ?>js/artdialog/jquery.artDialog.js"></script>
		<script src="<?php echo ($static_public); ?>js/artdialog/iframeTools.js"></script>

		<script src="<?php echo ($static_path); ?>js/group_detail.js"></script>
	<style type="text/css">
	#mpackageslist li{
    border: 2px solid #ddd;
    color: #666;
    display: inline-block;
    line-height: 27px;
    margin: 0 5px 5px 0;
    max-width: 230px;
    overflow: hidden;
    padding-left: 8px;
    padding-right: 8px;
    position: relative;
    text-decoration: none;
    text-overflow: ellipsis;
    white-space: nowrap;
   }
	#mpackageslist li a{ color: #666;}
	#mpackageslist li a:hover{ color: #fe5842;}
	#mpackageslist .current{  border: 2px solid #fe5842}
	#mpackageslist .current a{ color: #fe5842;}
	#mpackageslist ul{left: 15px;margin-left: 0px;position: relative; width: 85%;}
</style>
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
												<?php if(is_array($vo['category_list'])): $j = 0; $__LIST__ = array_slice($vo['category_list'],0,3,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($j % 2 );++$j;?><span><a href="<?php echo ($voo["url"]); ?>"><?php echo ($voo["cat_name"]); ?></a></span><?php endforeach; endif; else: echo "" ;endif; ?>
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
			<article class="product cf">
				<div class="navBreadCrumb cf">
					<ul class="cf">
						<li><a href="<?php echo ($config["site_url"]); ?>">网站首页</a></li>
						<li><span>»</span></li>
						<li><a href="<?php echo ($f_category["url"]); ?>"><?php echo ($f_category["cat_name"]); ?></a></li>
						<li><span>»</span></li>
						<li><a class="link--black__green" href="<?php echo ($s_category["url"]); ?>"><?php echo ($s_category["cat_name"]); ?></a></li>
						<?php if($now_group['store_list'][0]['area']): ?><li><span>»</span></li>
							<li><a href="<?php echo ($now_group["store_list"]["0"]["area"]["url"]); ?>"><?php echo ($now_group["store_list"]["0"]["area"]["area_name"]); ?></a></li>
							<li><span>»</span></li>
							<li><a href="<?php echo ($now_group["store_list"]["0"]["circle"]["url"]); ?>"><?php echo ($now_group["store_list"]["0"]["circle"]["area_name"]); ?></a></li><?php endif; ?>
						<li><span>»</span></li>
						<li><?php echo ($now_group["merchant_name"]); ?></li>
					</ul>
				</div>
				<div class="product_top_line">
					<div class="product_name"><span>【<?php echo ($now_group["merchant_name"]); ?>】</span><?php echo ($now_group["appoint_name"]); ?></div>
					<div class="product_dec"><?php echo ($now_group["appoint_content"]); ?></div>
				</div>
				<div class="product_table cf">
					<div class="product_img cf"> 
						<div id="slider">
							<div class="show-box">
								<ul>
									<li><img src="<?php echo ($now_group["all_pic"]["0"]["m_image"]); ?>"/></li>
								</ul>
							</div>
							<div class="minImgs">
								<div class="min-box">
									<ul class="min-box-list" style="margin:0px auto;">
										<?php if(is_array($now_group['all_pic'])): $i = 0; $__LIST__ = $now_group['all_pic'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="<?php if($i == 1): ?>cur<?php endif; ?>">
												<div><img src="<?php echo ($vo["m_image"]); ?>"/></div>
											</li><?php endforeach; endif; else: echo "" ;endif; ?>
									</ul>
								</div>							  
							</div>
						</div>
					</div>
					<div class="product_list cf">
						<div class="product_list_top cf">
							<div class="product_info">
								<div class="product_info_list">
									<ul>
										<li class="cf">
											<div class="product_info_list_left">定金：</div>
											<div class="priduct_price"><?php if($now_group['payment_status'] == 1): ?>¥<strong><?php echo ($now_group["payment_money"]); ?></strong><?php else: ?>无需定金<?php endif; ?></div>
										</li>
										<li class="cf">
											<div class="product_info_list_left">已预约：</div>
											<div class="priduct_sale"><?php echo ($now_group['appoint_sum']); ?></div>
										</li>
										<li class="cf">
											<div class="product_info_list_left">商家：</div>
											<div class="priduct_shop"><a href="<?php echo ($config["site_url"]); ?>/merindex/<?php echo ($now_group["mer_id"]); ?>.html" target="_blank"><?php echo ($now_group["merchant_name"]); ?></a>&nbsp;&nbsp;&nbsp;<span>|</span>&nbsp;&nbsp;&nbsp;<a class="see_anchor" data-anchor="business-info" href="javascript:void(0);">查看地址/电话</a></div>
										</li>
										<li class="cf">
											<div class="product_info_list_left">有效期：</div>
											<div class="priduct_data">截止到<?php echo (date('Y.m.d',$now_group["end_time"])); ?> </div>
										</li>
										<li>
											<div class="product_info_list_left">可选服务：</div>
											<div class="bigclass">
												<div class="priduct_data">
												<?php if($appoint_product_list): ?>
												<?php foreach($appoint_product_list as $val): ?>
													<div class="class2">
														<span style="margin-right:10px;"><?php echo $val['name']; ?></span>
														<span>￥<?php echo $val['price']; ?></span>
													</div>
												<?php endforeach; ?>
												<?php else : ?>
													<div class="class2">
														<span style="margin-right:10px;">该预约没有可选服务</span>
													</div>
												<?php endif; ?>
												</div>
											</div>
										</li>
									</ul>
								</div>
							</div>
							<div class="product_info_right">
								<div class="product_info_right_img"><img src="<?php echo U('Index/Recognition/see_qrcode',array('type'=>'appoint','id'=>$now_group['appoint_id']));?>"/></div>
								<p>微信扫一扫轻松预约</p>
							</div>
						</div>
						<div class="product_list_bottom">
							<form action="<?php echo ($now_group["buy_url"]); ?>" method="get">
								<div class="but cf">
									<button class="info_but" type="submit">立即预约</button>
									<a class="info_shop_but" href="<?php echo ($config["site_url"]); ?>/merindex/<?php echo ($now_group["mer_id"]); ?>.html" target="_blank">商家店铺</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</article>
		</div>
		<div class="detail_content cf">
			<div class="content_left">
				<div class="content_navbar" id="J-content-navbar">
					<ul class="cf">
						<li class="current"><a href="#business-info">商家位置</a></li>
						<li><a href="#anchor-detail">预约详情</a></li>
						<li><a href="#anchor-bizinfo">商家介绍</a></li>
					</ul>
					<div id="J-nav-buy" class="buy-group J-hub">
						<a rel="nofollow" class="J-buy btn-hot buy" href="<?php echo ($now_group["buy_url"]); ?>">立即预约</a>
					</div>
				</div>
				<section class="address cf" id="business-info">
					<div class="section_title cf">
						<div class="section_txt">商家位置</div>
						<div class="section_border"></div>
					</div>
					<div class="map">
						<div class="map_map">
							<div class="map_map_img">
								<div id="map-canvas" map_point="<?php echo ($now_group["store_list"]["0"]["long"]); ?>,<?php echo ($now_group["store_list"]["0"]["lat"]); ?>" store_name="<?php echo ($now_group["store_list"]["0"]["name"]); ?>" store_adress="<?php echo ($now_group["store_list"]["0"]["area_name"]); echo ($now_group["store_list"]["0"]["adress"]); ?>" store_phone="<?php echo ($now_group["store_list"]["0"]["phone"]); ?>" frame_url="<?php echo U('Map/frame_map');?>"></div>
								<div class="map_icon J-view-full"><img src="<?php echo ($static_path); ?>images/xiangqing_31.png"/></div>
							</div>
						</div>
						<div class="map_txt">
							<?php if(is_array($now_group['store_list'])): $i = 0; $__LIST__ = $now_group['store_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="biz-info <?php if($i == 1): ?>biz-info--open biz-info--first<?php endif; ?> <?php if(count($now_group['store_list']) == 1): ?>biz-info--only<?php endif; ?>">
									<div class="biz-info__title">
										<div class="shop_name"><?php echo ($vo["name"]); ?></div>
										<i class="F-glob F-glob-caret-down-thin down-arrow"></i>
									</div>
									<div class="biz-info__content">
										<div class="shop_add"><span>地址：</span><?php echo ($vo["area_name"]); echo ($vo["adress"]); ?></div>
										<div class="shop_map"><a class="view-map" href="javascript:void(0)" map_point="<?php echo ($vo["long"]); ?>,<?php echo ($vo["lat"]); ?>"  store_name="<?php echo ($vo["name"]); ?>" store_adress="<?php echo ($vo["area_name"]); echo ($vo["adress"]); ?>" store_phone="<?php echo ($vo["phone"]); ?>" frame_url="<?php echo U('group/Map/frame_map');?>">查看地图</a>&nbsp;&nbsp;&nbsp;<a class="search-path" href="javascript:void(0)" shop_name="<?php echo ($vo["adress"]); ?>">公交/驾车去这里</a></div>
										<div class="shop_ip"><span>电话：</span><?php echo ($vo["phone"]); ?></div>
									</div>
								</div><?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
					</div>
				</section>
				
				<section class="package cf" id="anchor-detail">
					<div class="section_title cf">
						<div class="section_txt">预约详情</div>
						<div class="section_border"></div>
					</div>
					<style>
						.BMap_cpyCtrl{display:none;}
						.group_content{padding-top:20px;font-size:14px;  color: #666;}
						.group_content table { width:100%!important; margin-top:0px; border:none; color:#222;  border-collapse: collapse;border-spacing: 0; }
						.group_content table .name { width:auto; text-align:left; border-left:none; }
						.group_content table .price { width:15%; text-align:center; }
						.group_content table .amount { width:15%; text-align:center; }
						.group_content table .subtotal { width:15%; text-align:right; border-right:none; font-family: arial, sans-serif; }
						.group_content table caption, .group_content table th, .group_content table td { padding:8px 10px; background:#FFF; border:1px solid #E8E8E8; border-top:none; word-break:break-all; word-wrap:break-word; }
						.group_content table caption { background:#F0F0F0; }
						.group_content table caption .title, .group_content table .subline .title { font-weight:bold; }
						.group_content table th { color:#333; background:#F0F0F0; font-weight:bold; border-left-style:none; border-right-style:none;}
						.group_content table td { color:#666; /*border-left-style:none; border-right-style:none;*/ border-bottom-style:dotted; }
						.group_content table .subline { background:#fff; text-align:center; border-left:none; border-right:none; }
						.group_content table .subline-left { width:22%; text-align:left;border-right: 1px #e8e8e8 dotted; }
						.group_content p{  margin: 10px 0;font: 14px/24px helvetica neue,helvetica,arial,simsun,"微软雅黑",Hiragino Sans GB,sans-serif;color: #666;}
						.deal-menu-summary { padding:0 10px 10px; text-align:right; border-bottom:1px #e8e8e8 solid; }
						.deal-menu-summary .worth { display:inline-block; min-width:10px; _width:10px; padding-right:20px; text-align:left; word-break:normal; word-wrap:normal; font-weight:bold; }
						.deal-menu-summary .price { color:#ea4f01; padding-right:0; }
						.group_content ul.list{margin:10px 0 15px;padding-left:18px;}
						.group_content ul.list li {list-style-position: outside;list-style-type: disc;margin-bottom: 5px;}
					</style>
					<div class="group_content"><?php echo ($now_group["appoint_pic_content"]); ?></div>
				</section>
				<section class="introduce cf" id="anchor-bizinfo">
					<div class="section_title cf">
						<div class="section_txt"><a name="anchor-bizinfo">商家介绍</a></div>
						<div class="section_border"></div>
					</div>
					<div class="introduce_title"><?php echo ($now_group["merchant_name"]); ?></div>
					<div class="introduce_txt"><?php echo ($now_group["txt_info"]); ?></div>
					<div class="introduce_img">
						<?php if(is_array($now_group['merchant_pic'])): $i = 0; $__LIST__ = $now_group['merchant_pic'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><img src="<?php echo ($vo); ?>" alt="<?php echo ($now_group["merchant_name"]); ?>" class="standard-image"/><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
				</section>
				<section class="shop_bottom">
					<ul>
						<li>
							<div class="shop_bottom_list">已预约</div>
							<div class="shop_bottom_txt"><?php echo ($now_group['appoint_sum']); ?></div>
						</li>
						<li>
							<div class="shop_bottom_list">定金</div>
							<div class="shop_bottom_txt"><?php if($now_group['payment_status'] == 1): ?>¥<?php echo ($now_group["payment_money"]); else: ?>无需定金<?php endif; ?></div>
						</li>
						</if>
						<li style="float:right">
							<a class="shop_bottom_but" href="<?php echo ($now_group["buy_url"]); ?>">预约</a>
						</li>
					</ul>
				</section>
			</div>
			<?php if($category_hot_group_list): ?><div class="content_right">
					<div class="activity">
						<div class="activity_title">看了本预约的人还看了</div>
						<div class="content_right_list">
							<ul>
								<?php if(is_array($category_hot_group_list)): $i = 0; $__LIST__ = $category_hot_group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
										<a href="<?php echo ($vo["url"]); ?>" target="_blank">
											<div class="category_list_img">
												<img src="<?php echo ($vo["list_pic"]); ?>" title="【<?php echo ($vo["merchant_name"]); ?>】<?php echo ($vo["appoint_name"]); ?>"/>
												
											</div>
											<div class="datal cf">
												<div class="category_list_title">【<?php echo ($vo["merchant_name"]); ?>】<?php echo ($vo["appoint_name"]); ?></div>
												<?php if($now_group['payment_status'] == 1): ?><div class="deal-tile__detail cf"><span id="price"><span style="color:black;margin:0;">定金：</span>¥<strong><?php echo ($vo["payment_money"]); ?></strong></span></div><?php endif; ?>
												<div class="extra-inner cf">
													<div class="sales">已预约<strong class="num"><?php echo ($vo['appoint_sum']); ?></strong></div>
												</div>
											</div>
										</a>
									</li><?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
						</div>
					</div>
				</div><?php endif; ?>
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