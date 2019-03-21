<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<title><?php echo ($config["group_alias_name"]); ?>订单详情 | <?php echo ($config["site_name"]); ?></title>
<meta name="keywords" content="<?php echo ($config["seo_keywords"]); ?>" />
<meta name="description" content="<?php echo ($config["seo_description"]); ?>" />
<link href="<?php echo ($static_path); ?>css/css.css" type="text/css"  rel="stylesheet" />
<link href="<?php echo ($static_path); ?>css/header.css"  rel="stylesheet"  type="text/css" />
<script src="<?php echo ($static_path); ?>js/jquery-1.7.2.js"></script>
<script src="<?php echo ($static_public); ?>js/jquery.lazyload.js"></script>
	<script type="text/javascript">
	   var  meal_alias_name = "<?php echo ($config["meal_alias_name"]); ?>";
	</script>
<script src="<?php echo ($static_path); ?>js/common.js"></script>
<script src="<?php echo ($static_path); ?>js/category.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/meal_order_detail.css" />
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
<script src="<?php echo ($static_public); ?>js/artdialog/jquery.artDialog.js"></script>
<script src="<?php echo ($static_public); ?>js/artdialog/iframeTools.js"></script>
</head>
<body id="order-detail">
	<div id="doc" class="bg-for-new-index">
		<header id="site-mast" class="site-mast">
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
		</header>
		<div id="bdw" class="bdw">
			<div id="bd" class="cf">
				<div id="content">
					<div class="mainbox mine">
						<h2>订单详情<span class="op-area"><a href="<?php echo U('Index/index');?>">返回订单列表</a></span></h2>
						<dl class="info-section primary-info J-primary-info">
							<dt>
								<span class="info-section--title">当前订单状态：</span>
								<em class="info-section--text"><?php if(empty($now_order['paid'])): ?>未付款<?php elseif($now_order['third_id'] == '0' AND $now_order['pay_type'] == 'offline'): ?>未消费 (<font color="red">线下未付款</font>)<?php elseif(empty($now_order['status'])): if($now_order['tuan_type'] != 2): ?>未消费<?php else: ?>未发货<?php endif; elseif($now_order['status'] == '1'): if($now_order['tuan_type'] != 2): ?>已使用<?php else: ?>已发货<?php endif; elseif($now_order['status'] == '2'): ?>已完成<?php endif; ?></em>
								<div style="float:right;"><a class="see_tmp_qrcode" href="<?php echo U('Index/Recognition/see_tmp_qrcode',array('qrcode_id'=>2000000000+$now_order['order_id']));?>">查看微信二维码</a></div>
							</dt>
							<dd class="last">
								<?php if($now_order['status'] == '3'): ?><div class="operation">
									    <a class="btn btn-mini">已取消并退款</a>
									</div>
								<?php elseif(empty($now_order['paid']) || $now_order['status'] == '1'): ?>
								<?php if(empty($now_order['paid'])): ?><p>请及时付款，不然就被抢光啦！</p><?php endif; ?>
									<div class="operation">
										<?php if(empty($now_order['paid'])): ?><a class="btn btn-mini" href="<?php echo U('Index/Pay/check',array('type'=>'group','order_id'=>$now_order['order_id']));?>">付款</a>&nbsp;&nbsp;&nbsp;
											<a class="inline-link J-order-cancel" href="<?php echo U('Index/group_order_del',array('order_id'=>$now_order['order_id']));?>">删除</a>
										<?php elseif($now_order['status'] == '1'): ?>
											<a class="btn btn-mini" href="<?php echo U('Rates/index');?>">评价</a><?php endif; ?>
									</div><?php endif; ?>
							</dd>
						</dl>
						<dl class="bunch-section J-coupon">
							<?php if($now_order['paid'] && $now_order['tuan_type'] != 2 && $now_order['status'] != 3): ?><dt class="bunch-section__label"><?php echo ($config["group_alias_name"]); ?>券</dt>
								<dd class="bunch-section__content">
									<div class="coupon-field">
										<p class="coupon-field__tip">小提示：记下或拍下<?php echo ($config["group_alias_name"]); ?>券密码向商家出示即可消费</p>
										<ul>
											<li class="invalid"><?php echo ($config["group_alias_name"]); ?>券密码：<b style="color:black;"><?php echo ($now_order["group_pass_txt"]); ?></b><span><?php if($now_order['third_id'] == '0' AND $now_order['pay_type'] == 'offline'): ?>未消费 (<font color="red">线下未付款</font>)<?php elseif(empty($now_order['status'])): ?>未消费<?php elseif($now_order['status'] == '1'): ?>已使用<?php elseif($now_order['status'] == '2'): ?>已完成<?php endif; ?></span></li>
										</ul>
									</div>
								</dd><?php endif; ?>
							<dt class="bunch-section__label">订单信息</dt>
							<dd class="bunch-section__content">
								<ul class="flow-list">
									<li>订单编号：<?php echo ($now_order["order_id"]); ?></li>
									<li>下单时间：<?php echo (date('Y-m-d H:i',$now_order["add_time"])); ?></li>
									<?php if($now_order['third_id'] == '0' AND $now_order['pay_type'] == 'offline'): ?><li></li>
										<li></li>
										<li></li>
										<li style="margin-top:30px;width:auto;"><b>线下需向商家付金额：</b>总金额 ￥<?php echo ($now_order['total_money']); ?> - <?php if($now_order['wx_cheap'] != '0.00'): ?>微信优惠 ￥<?php echo ($now_order['wx_cheap']); ?> -<?php endif; ?> 商家会员卡余额支付 ￥<?php echo floatval($now_order['merchant_balance']);?> - 平台余额支付 ￥<?php echo floatval($now_order['balance_pay']);?> = <font color="red">￥<?php echo ($now_order['total_money']-$now_order['wx_cheap']-$now_order['merchant_balance']-$now_order['balance_pay']); ?>元</font></li>
									<?php elseif(($now_order['pay_type'] == 'offline' AND $now_order['paid'] AND !empty($now_order['third_id'])) OR ($now_order['pay_type'] != 'offline' AND $now_order['paid'])): ?>
										<li>付款方式：<?php echo ($now_order["pay_type_txt"]); ?></li>
										<li>付款时间：<?php echo (date('Y-m-d H:i',$now_order["pay_time"])); ?></li>
										<?php if(!empty($now_order['use_time'])): ?><li>消费时间：<?php echo (date('Y-m-d H:i',$now_order["use_time"])); ?></li><?php endif; ?>
										<li style="margin:30px 0;width:auto;"><b>支付详情：</b>在线支付金额 ￥<?php echo ($now_order['payment_money']); ?>  商家会员卡余额支付 ￥<?php echo floatval($now_order['merchant_balance']);?>  平台余额支付 ￥<?php echo floatval($now_order['balance_pay']);?> 
										</li><?php endif; ?>
								</ul>
							</dd>
							<?php if($now_order['tuan_type'] == 2): ?><dt class="bunch-section__label">快递信息</dt>
								<dd class="bunch-section__content">
									<div class="coupon-field">
										<ul>
											<li class="invalid">收货地址：<?php echo ($now_order["contact_name"]); ?>，<?php echo ($now_order["adress"]); ?>，<?php echo ($now_order["zipcode"]); ?>，<?php echo ($now_order["phone"]); ?></li>
											<li class="invalid"><?php if($now_order['express_id']): ?>快递单号：<?php echo ($now_order["express_id"]); else: ?>未发货<?php endif; ?></li>
										</ul>
									</div>
								</dd><?php endif; ?>
							<dt class="bunch-section__label"><?php echo ($config["group_alias_name"]); ?>信息</dt>
							<dd class="bunch-section__content">
								<table cellspacing="0" cellpadding="0" border="0" class="info-table">
									<tbody>
										<tr>
											<th class="left" width="100"><?php echo ($config["group_alias_name"]); ?>项目</th>
											<th width="50">单价</th>
											<th width="10"></th>
											<th width="30">数量</th>
											<th width="10"></th>
											<th width="54">支付金额</th>
										</tr>
										<tr>
											<td class="left">
												<a class="deal-title" href="<?php echo ($now_order["url"]); ?>" target="_blank"><?php echo ($now_order["s_name"]); ?></a>
											</td>
											<td><span class="money">¥</span><?php echo ($now_order["price"]); ?></td>
											<td>x</td>
											<td><?php echo ($now_order["num"]); ?></td>
											<td>=</td>
											<td class="total"><span class="money">¥</span><?php echo ($now_order["total_money"]); ?></td>
										</tr>
									</tbody>
								</table>
							</dd>
						</dl>
					</div>
				</div>
			</div> <!-- bd end -->
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
			<div class="footer_txt"><?php echo nl2br(strip_tags($config['site_show_footer'],'<a>'));?></div>
		</div>
	</div>
</footer>
<div style="display:none;"><?php echo ($config["site_footer"]); ?></div>
	<script src="<?php echo ($static_public); ?>js/artdialog/jquery.artDialog.js"></script>
	<script src="<?php echo ($static_public); ?>js/artdialog/iframeTools.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.see_tmp_qrcode').click(function(){
				var qrcode_href = $(this).attr('href');
				art.dialog.open(qrcode_href+"&"+Math.random(),{
					init: function(){
						var iframe = this.iframe.contentWindow;
						window.top.art.dialog.data('login_iframe_handle',iframe);
					},
					id: 'login_handle',
					title:'请使用微信扫描二维码',
					padding: 0,
					width: 430,
					height: 433,
					lock: true,
					resize: false,
					background:'black',
					button: null,
					fixed: false,
					close: null,
					left: '50%',
					top: '38.2%',
					opacity:'0.4'
				});
				return false;
			});
			$('.J-order-cancel').click(function(){
				if(!confirm('确定删除订单？删除后本订单将从订单列表消失，且不能恢复。')){
					return false;
				}
			});
		});
	</script>
</body>
</html>