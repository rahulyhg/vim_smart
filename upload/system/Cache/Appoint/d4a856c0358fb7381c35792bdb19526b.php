<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<title><?php echo ($now_group["appoint_name"]); ?> | <?php echo ($config["site_name"]); ?></title>
	<meta name="keywords" content="<?php echo ($now_group["merchant_name"]); ?>,<?php echo ($now_group["appoint_name"]); ?>,<?php echo ($config["site_name"]); ?>" />
	<meta name="description" content="<?php echo ($now_group["appoint_content"]); ?>" />
	<link href="<?php echo ($static_path); ?>css/css.css" type="text/css"  rel="stylesheet" />
	<link href="<?php echo ($static_path); ?>css/header.css"  rel="stylesheet"  type="text/css" />
	<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/buy-process.css" />
	<script src="<?php echo ($static_path); ?>js/jquery-1.7.2.js"></script>
	<script src="<?php echo ($static_public); ?>js/jquery.lazyload.js"></script>
	<script src="<?php echo ($static_path); ?>js/common.js"></script>	
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
			body{behavior:url("<?php echo ($static_path); ?>css/csshover.htc"); 
			}
			.category_list li:hover .bmbox {
	filter:alpha(opacity=50);
		 
				}
	  .gd_box{	display: none;}
	</style>
	<![endif]-->
	<style>
		#deal-buy-delivery{
			padding-top:30px;
		}
		.form-field label{
			font-size:14px;
			position: absolute;
			left: 0;
		}
		.comm-service span {
			font-size: 22px;
			color: #fc4111;
		}
		.comm-service span em {
			font-style:normal;
			font-size: 15px;
		}
		.con-service {
			display: inline-block;
			vertical-align: middle;
			max-width:68%;
		}
		.con-service-inner {
			margin-left:20px;
		}
		.con-service-inner h3 {
		  font-size: 16px;
		  color: #17bfa9;
		  margin-bottom: 5px;
		  background-color:white;
		  padding:0;
		  border-bottom:0px;
		  margin:0;
		}
		.con-service-inner span{
			  color: #999;
			    font-size: 14px;
		}
		.service-type-select{
			margin-left:20px;
			display: inline-block;
			color:red;
			font-size:14px;
			cursor:pointer;
		}
		.dropdown--small {
		  font-size: 12px;
		  height: 21px;
		  padding: 2px 0;
		  border: 1px solid #d4d4d4;
		  border-color: #b4b4b4 #d4d4d4 #d4d4d4 #b4b4b4;
		  color: #666;
		    margin: 3px 10px 0 0;
			width: 300px;
			height: 30px;
		}
		.service-list li {
  background: #fff;
  width: auto;
  height: inherit;
  position: relative;
  border: 1px solid #ddd;
  padding: 10px;
  margin: 10px 13px;
}
.service-list li.active {
  border: 1px solid #32c8a2;
}
.pay-type {
  display: block;
  width: 100%;
  height: 100%;
}
.service-price {
  font-size: 22px;
  color: #fc4111;
}
.yxc-package span {
  right: 11px;
}
.service-price em {
  font-size: 15px;
  font-style:normal;
}
.service-intro {
  color: #999;
  display: inline-block;
  vertical-align: middle;
  width: 66%;
  margin-left: 7px;
  line-height: 18px;
  font-size: 14px;
}
.service-intro h3 {
  font-size: 16px;
  color: #17bfa9;
  margin-bottom: 5px;
}
.service-list .bt-interior {
  right: 11px;
    top: 45%;
  display:block;
  position:absolute;
}
.yxc-time-con dl {
  text-align: center;
  width: 25%;
  float: left;
}
.yxc-time-con dl dt {
  display: block;
  height: 45px;
  padding-top: 5px;
  border-right: 1px solid #32c8a2;
  border-bottom: 2px solid #32c8a2;
  font-size: 15px;
  background: #32c8a2;
  line-height:22px;
   cursor:pointer;
}
.yxc-time-tab li.active, .yxc-time-con dl .active {
  background: #fff;
  color: #333;
}
.yxc-time-con dl.last{
	line-height:45px;
}
.yxc-time-con dl dt span {
  display: block;
  font-size: 12px;
}
.yxc-time-con dl.last dt span{
	line-height:45px;
}
#service-date{
	width: 538px;
	padding-bottom:20px;
	  overflow: hidden;
	 min-height:200px;
}
.yxc-time-con dl dd {
  height: 42px;
  font-size: 12px;
  line-height:20px;
  border-right: 1px solid #d2d1d6;
  border-bottom: 1px solid #d2d1d6;
  padding-top: 3px;
  color: #29b2a6;
  cursor:pointer;
}
.yxc-time-con dl .disable {
  color: #999;
}
.yxc-paymentMoney {
	margin:10px 0;
  padding: 10px 0;
  font-size:16px;
  height: 26px;
  line-height: 26px;
  padding-left:10px;
}
.yxc-paymentMoney img,.yxc-paymentMoney span{
  vertical-align: middle;
}
.ipt-attr {
  width: 248px;
  height: 24px;
  padding: 5px;
  border: 1px solid #aaa;
  line-height: 24px;
  vertical-align: top;
}
.yxc-time-con.number-3 dl {
  width: 33%;
}
.yxc-time-con.number-3 dl.last{
  width: 34%;
}
.yxc-time-con.number-2 dl {
  width: 50%;
}
.form_error{
	border: 1px solid red;
}
.form-field label em{
	font-style:normal;
	color:red;
}
	</style>
	<script type="text/javascript" src="<?php echo ($static_public); ?>js/artdialog/jquery.artDialog.js"></script>
	<script type="text/javascript" src="<?php echo ($static_public); ?>js/artdialog/iframeTools.js"></script>
	<script type="text/javascript" src="<?php echo ($static_public); ?>js/date/WdatePicker.js"></script>
	<script type="text/javascript" src="<?php echo ($static_path); ?>js/appoint.js"></script>
	<script>var group_price=0;var finalprice=0;var map_url="<?php echo U('Group/Map/frame_select');?>";<?php if($user_session): ?>var is_login=true;<?php else: ?>var is_login=false;var login_url="<?php echo U('Index/Login/frame_login');?>";<?php endif; if($user_session['phone']): ?>var has_phone=true;<?php else: ?>var has_phone=false;var phone_url="<?php echo U('Index/Login/frame_phone');?>";<?php endif; ?></script>
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
	<div class="body pg-buy-process"> 
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
		<article>
			<div class="sysmsgw common-tip" id="sysmsg-error" style="display:none;"></div>
			<div id="bdw" class="bdw" style="min-height:700px;">
				<div id="bd" class="cf">
					<div id="content">
						<div>
							<div class="buy-process-bar-container">
								<ol class="buy-process-desc steps-desc">
									<li class="step step--current">
										1. 提交订单
									</li>
									<?php if($now_group['payment_status'] == 1): ?><li class="step">
											2. 选择支付方式
										</li>
										<li class="step">
											3. 预约成功
										</li>
									<?php else: ?>
										<li class="step">
											2. 预约成功
										</li><?php endif; ?>
								</ol>
								<div class="progress">
									<div class="progress-bar" style="width:33.33%"></div>
								</div>
							</div>
						</div>
						<form action="<?php echo ($config["site_url"]); ?>/appoint/order/<?php echo ($now_group["appoint_id"]); ?>.html" method="post" id="deal-buy-form" class="common-form J-wwwtracker-form">
							<div class="mainbox cf">
								<div id="deal-buy-delivery" class="blk-item delivery J-deal-buy-delivery">
									<?php if(count($appoint_product) > 0): ?><div class="form-field form-field--error">
											<label for="address-detail"><em>*</em> 选择服务：</label>
											<div class="comm-service">
												<input type="hidden" name="service_type" id="service_type" value="<?php echo ($appoint_product[0]['id']); ?>"/>
												<span><em>¥</em><span><?php echo ($appoint_product[0]['price']); ?></span></span>
												<div class="con-service">
													<div class="con-service-inner">
														<h3><?php echo ($appoint_product[0]['name']); ?></h3>
														<span><?php echo ($appoint_product[0]['content']); ?></span>
													</div>
												</div>
												<a class="service-type-select">[重新选择]</a>
											</div>
										</div><?php endif; ?>
									<div id="service-type-box" style="display:none;">
										<ul class="delivery-type service-list">
											<?php if(is_array($appoint_product)): $i = 0; $__LIST__ = $appoint_product;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li <?php if($i == 1): ?>class="active"<?php endif; ?> data-id="<?php echo ($vo['id']); ?>">
													<label class="pay-type" for="pay-type-<?php echo ($vo['id']); ?>">
														<span class="service-price"><em>¥</em><span data-role="payAmount"><?php echo ($vo['price']); ?></span></span>
														<div class="service-intro">
														  <h3 data-role="title"><?php echo ($vo['name']); ?></h3>
														  <span data-role="content"><?php echo ($vo['content']); ?></span>
														</div>
														<span class="bt-interior">
															<input name="pay-type" id="pay-type-<?php echo ($vo['id']); ?>" type="radio" <?php if($i == 1): ?>checked="checked"<?php endif; ?>/>
														</span>
													</label>
												</li><?php endforeach; endif; else: echo "" ;endif; ?>
										</ul>
									</div>
									<hr/>
									<div class="form-field">
										<label for="address-detail"><em>*</em> 选择店铺：</label>
										<select name="store_id" id="store_id" class="address-province dropdown--small" style="color:black;">
											<?php dump($now_group['store_list']); ?>
											<?php if(is_array($now_group['store_list'])): $i = 0; $__LIST__ = $now_group['store_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["store_id"]); ?>"><?php echo ($vo["name"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;[<?php echo ($vo["area_name"]); ?> <?php echo ($vo["adress"]); ?>]</option><?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
									</div>
									<hr/>
									<div class="form-field">
										<input type="hidden" name="service_date" id="service_date" value=""/>
										<input type="hidden" name="service_time" id="service_time" value=""/>
										<label for="address-detail"><em>*</em> 预约时间：</label>
										<input id="serviceJobTime" class="f-text" readonly="readonly" style="width:200px;color:#666;cursor:pointer;font-size:12px;" value="请点击选择预约时间"/>
									</div>
									<hr/>
									<div id="service-date" style="display:none;">
										<div class="yxc-pay-main yxc-payment-bg pad-bot-comm">
											<div class="yxc-time-con number-<?php echo count($timeOrder);?>">
												<?php if(is_array($timeOrder)): $i = 0; $__LIST__ = $timeOrder;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$timeOrderInfo): $mod = ($i % 2 );++$i;?><dl <?php if($i == count($timeOrder)): ?>class="last"<?php endif; ?>>
														<dt <?php if($i == 1): ?>class="active"<?php endif; ?> data-role="date" data-text="<?php if($key == date('Y-m-d')): ?>今天<?php elseif($key == date('Y-m-d',strtotime('+1 day'))): ?>明天<?php elseif($key == date('Y-m-d',strtotime('+2 day'))): ?>后天<?php else: echo ($key); endif; ?>" data-date="<?php echo ($key); ?>">
																<?php if($key == date('Y-m-d')): ?>今天
																<?php elseif($key == date('Y-m-d',strtotime('+1 day'))): ?>明天
																<?php elseif($key == date('Y-m-d',strtotime('+2 day'))): ?>后天
																<?php else: endif; ?>
															<span><?php echo ($key); ?></span>
														</dt>
													</dl><?php endforeach; endif; else: echo "" ;endif; ?>
											</div>
											<div class="yxc-time-con" data-role="timeline">
												<?php if(is_array($timeOrder)): $i = 0; $__LIST__ = $timeOrder;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$timeOrderInfo): $mod = ($i % 2 );++$i;?><div class="date-<?php echo ($key); ?> timeline" <?php if($i != 1): ?>style='display:none'<?php endif; ?> >
													   <?php if(is_array($timeOrderInfo)): $i = 0; $__LIST__ = $timeOrderInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dl>
															<dd data-role="item" data-peroid="<?php echo ($vo['time']); ?>" <?php if($vo['order'] == 'no' || $vo['order'] == 'all' ): ?>class="disable"<?php endif; ?>><?php echo ($vo['time']); ?><br>
															<?php if($vo['order'] == 'no' ): ?>不可预约<?php elseif($vo['order'] == 'all' ): ?>已约满<?php else: ?>可预约<?php endif; ?></dd>
														</dl><?php endforeach; endif; else: echo "" ;endif; ?>
													</div><?php endforeach; endif; else: echo "" ;endif; ?>
											</div>
										</div>
									</div>
									<?php if($now_group['payment_status'] == 1): if($now_group['payment_status'] == 1): ?><div class="yxc-paymentMoney"><img src="<?php echo ($static_path); ?>images/icon_deposit.png" style="width:15px;margin-right:5px;"/><span>&nbsp;预约定金</span><img src="<?php echo ($static_path); ?>images/icon_rmb.png" style="width:8px;margin-left:15px;"/>&nbsp;<span style="font-size:20px;color:#ff8a00;margin-bottom:0;"><?php echo ($now_group["payment_money"]); ?></span></div>
											<hr/><?php endif; endif; ?>
								</div>
								<?php if($formData || $now_group['appoint_type']): ?><div class="yxc-attr-list">
										<?php if($now_group['appoint_type']): ?><div class="form-field" data-name="服务位置">
												<label for="address-detail">&nbsp;服务位置：</label>
												<input type="hidden" name="custom_field[0][name]" value="服务位置"/>
												<input type="hidden" name="custom_field[0][type]" value="2"/>
												<input type="hidden" name="custom_field[0][long]" data-type="long"/>
												<input type="hidden" name="custom_field[0][lat]" data-type="lat"/>
												<input type="hidden" name="custom_field[0][address]" data-type="address"/>
												<p class="cover">
													<input data-role="position" class="ipt-attr" type="text" name="custom_field[0][value]" placeholder="请选择服务位置" readonly="readonly" data-required="required"/>
												</p>
											</div><?php endif; ?>
										<?php if(is_array($formData)): $i = 0; $__LIST__ = $formData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="form-field" data-name="<?php echo ($vo["name"]); ?>">
												<label for="address-detail"><?php if($vo['iswrite']): ?><em>*</em><?php endif; ?>&nbsp;<?php echo ($vo["name"]); ?>：</label>
												<?php switch($vo['type']): case "0": ?><input type="hidden" name="custom_field[<?php echo ($i); ?>][name]" value="<?php echo ($vo["name"]); ?>"/>
														<input type="hidden" name="custom_field[<?php echo ($i); ?>][type]" value="<?php echo ($vo["type"]); ?>"/>
														<p class="cover"><input class="ipt-attr" type="text" name="custom_field[<?php echo ($i); ?>][value]" data-role="text" <?php if($vo['iswrite']): ?>data-required="required"<?php endif; ?>/></p><?php break;?>
													<?php case "1": ?><input type="hidden" name="custom_field[<?php echo ($i); ?>][name]" value="<?php echo ($vo["name"]); ?>"/>
														<input type="hidden" name="custom_field[<?php echo ($i); ?>][type]" value="<?php echo ($vo["type"]); ?>"/>
														<p class="cover"><textarea class="ipt-attr" name="custom_field[<?php echo ($i); ?>][value]" data-role="textarea" <?php if($vo['iswrite']): ?>data-required="required"<?php endif; ?>></textarea></p><?php break;?>
													<?php case "2": ?><input type="hidden" name="custom_field[<?php echo ($i); ?>][name]" value="<?php echo ($vo["name"]); ?>"/>
														<input type="hidden" name="custom_field[<?php echo ($i); ?>][type]" value="<?php echo ($vo["type"]); ?>"/>
														<input type="hidden" name="custom_field[<?php echo ($i); ?>][long]" data-type="long"/>
														<input type="hidden" name="custom_field[<?php echo ($i); ?>][lat]" data-type="lat"/>
														<input type="hidden" name="custom_field[<?php echo ($i); ?>][address]" data-type="address"/>
														<p class="cover">
															<input data-role="position" class="ipt-attr" type="text" name="custom_field[<?php echo ($i); ?>][value]" readonly="readonly" style="cursor:pointer;color:#666;" value="请点击选择地图" <?php if($vo['iswrite']): ?>data-required="required"<?php endif; ?>/>
														</p>
														<p class="cover" style="margin-top:10px;"><input data-role="position-desc" class="ipt-attr" type="text" name="custom_field[<?php echo ($i); ?>][value-desc]" data-role="text" style="color:#999;" value="请标注地图后填写详细地址"/></p><?php break;?>
													<?php case "3": ?><input type="hidden" name="custom_field[<?php echo ($i); ?>][name]" value="<?php echo ($vo["name"]); ?>"/>
														<input type="hidden" name="custom_field[<?php echo ($i); ?>][type]" value="<?php echo ($vo["type"]); ?>"/>
														<p class="cover select">
															<select name="custom_field[<?php echo ($i); ?>][value]" class="dropdown--small" data-role="select" <?php if($vo['iswrite']): ?>data-required="required"<?php endif; ?>>
																<?php if(is_array($vo['use_field'])): $i = 0; $__LIST__ = $vo['use_field'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($voo); ?>"><?php echo ($voo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
															</select>
														</p><?php break;?>
													<?php case "4": ?><input type="hidden" name="custom_field[<?php echo ($i); ?>][name]" value="<?php echo ($vo["name"]); ?>"/>
														<input type="hidden" name="custom_field[<?php echo ($i); ?>][type]" value="<?php echo ($vo["type"]); ?>"/>
														<p class="cover"><input class="ipt-attr" type="tel" name="custom_field[<?php echo ($i); ?>][value]" data-role="number" <?php if($vo['iswrite']): ?>data-required="required"<?php endif; ?>/></p><?php break;?>
													<?php case "5": ?><input type="hidden" name="custom_field[<?php echo ($i); ?>][name]" value="<?php echo ($vo["name"]); ?>"/>
														<input type="hidden" name="custom_field[<?php echo ($i); ?>][type]" value="<?php echo ($vo["type"]); ?>"/>
														<p class="cover"><input class="ipt-attr" type="text" name="custom_field[<?php echo ($i); ?>][value]" data-role="email" <?php if($vo['iswrite']): ?>data-required="required"<?php endif; ?>/></p><?php break;?>
													<?php case "6": ?><input type="hidden" name="custom_field[<?php echo ($i); ?>][name]" value="<?php echo ($vo["name"]); ?>"/>
														<input type="hidden" name="custom_field[<?php echo ($i); ?>][type]" value="<?php echo ($vo["type"]); ?>"/>
														<p class="cover"><input class="ipt-attr" type="text" name="custom_field[<?php echo ($i); ?>][value]" data-role="date" onfocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt:'yyyy年MM月dd日'})" style="cursor:pointer;color:#666;" value="请点击选择日期" <?php if($vo['iswrite']): ?>data-required="required"<?php endif; ?> /></p><?php break;?>
													<?php case "7": ?><input type="hidden" name="custom_field[<?php echo ($i); ?>][name]" value="<?php echo ($vo["name"]); ?>"/>
														<input type="hidden" name="custom_field[<?php echo ($i); ?>][type]" value="<?php echo ($vo["type"]); ?>"/>
														<p class="cover"><input class="ipt-attr" type="text" name="custom_field[<?php echo ($i); ?>][value]" data-role="time" onfocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt:'HH时mm分'})" style="cursor:pointer;color:#666;" value="请点击选择时间" <?php if($vo['iswrite']): ?>data-required="required"<?php endif; ?>/></p><?php break;?>
													<?php case "8": ?><input type="hidden" name="custom_field[<?php echo ($i); ?>][name]" value="<?php echo ($vo["name"]); ?>"/>
														<input type="hidden" name="custom_field[<?php echo ($i); ?>][type]" value="<?php echo ($vo["type"]); ?>"/>
														<p class="cover"><input class="ipt-attr" type="tel" name="custom_field[<?php echo ($i); ?>][value]" data-role="phone" <?php if($vo['iswrite']): ?>data-required="required"<?php endif; ?>/></p><?php break;?>
													<?php case "9": ?><input type="hidden" name="custom_field[<?php echo ($i); ?>][name]" value="<?php echo ($vo["name"]); ?>"/>
														<input type="hidden" name="custom_field[<?php echo ($i); ?>][type]" value="<?php echo ($vo["type"]); ?>"/>
														<p class="cover"><input class="ipt-attr" type="text" name="custom_field[<?php echo ($i); ?>][value]" data-role="datetime" onfocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt:'yyyy年MM月dd日 HH时mm分ss秒'})" style="cursor:pointer;color:#666;" value="请点击选择时间" <?php if($vo['iswrite']): ?>data-required="required"<?php endif; ?>/></p><?php break; endswitch;?>
											</div><?php endforeach; endif; else: echo "" ;endif; ?>
									</div><?php endif; ?>
								<!--if condition="$user_session['phone']">
									<div class="blk-mobile">
										<p>您绑定的手机号码：<span class="mobile" style="color:#EE3968;"><?php echo ($pigcms_phone); ?></span></p>
									</div>  
								</if-->
								<div class="form-submit shopping-cart">
									<input type="submit" class="clear-cart btn btn-large btn-buy" id="confirmOrder" value="提交订单" />
								</div>
							</div>
						</form>
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