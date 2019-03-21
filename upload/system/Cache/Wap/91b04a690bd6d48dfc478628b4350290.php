<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>meal/css/common.css" media="all">
<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>meal/css/color.css" media="all">
<script type="text/javascript" src="<?php echo ($static_path); ?>meal/js/jquery_min.js"></script>
<title><?php echo ($store['name']); ?></title>	
	<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
	<meta name="Keywords" content="">
	<meta name="Description" content="">
	<!-- Mobile Devices Support @begin -->
		<meta content="telephone=no, address=no" name="format-detection">
		<meta name="apple-mobile-web-app-capable" content="yes"> <!-- apple devices fullscreen -->
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<!-- Mobile Devices Support @end -->
</head>
<style  type="text/css">
#dingcai_adress_info{
border-top: 1px solid #ddd8ce;
border-bottom: 1px solid #ddd8ce;
position: relative;
}
#dingcai_adress_info:after{
position: absolute;
right: 8px;
top: 50%;
display: block;
content: '';
width: 13px;
height: 13px;
border-left: 3px solid #999;
border-bottom: 3px solid #999;
-webkit-transform: translateY(-50%) scaleY(0.7) rotateZ(-135deg);
-moz-transform: translateY(-50%) scaleY(0.7) rotateZ(-135deg);
-ms-transform: translateY(-50%) scaleY(0.7) rotateZ(-135deg);
}


#enter_im_div {
  bottom: 121px;
  z-index: 11;
  display: none;
  position: fixed;
  width: 100%;
  max-width: 640px;
  height: 1px;
}
#enter_im {
  width: 94px;
  margin-left: 110px;
  position: relative;
  left: -100px;
  display: block;
}
a {
  color: #323232;
  outline-style: none;
  text-decoration: none;
}
#to_user_list {
  height: 30px;
  padding: 7px 6px 8px 8px;
  background-color: #00bc06;
  border-radius: 25px;
  /* box-shadow: 0 0 2px 0 rgba(0,0,0,.4); */
}
#to_user_list_icon_div {
  width: 20px;
  height: 16px;
  background-color: #fff;
  border-radius: 10px;
}

.rel {
  position: relative;
}
.left {
  float: left;
}
.to_user_list_icon_em_a {
  left: 4px;
}
#to_user_list_icon_em_num {
  background-color: #f00;
}
#to_user_list_icon_em_num {
  width: 14px;
  height: 14px;
  border-radius: 7px;
  text-align: center;
  font-size: 12px;
  line-height: 14px;
  color: #fff;
  top: -14px;
  left: 68px;
}
.hide {
  display: none;
}
.abs {
  position: absolute;
}
.to_user_list_icon_em_a, .to_user_list_icon_em_b, .to_user_list_icon_em_c {
  width: 2px;
  height: 2px;
  border-radius: 1px;
  top: 7px;
  background-color: #00ba0a;
}
.to_user_list_icon_em_a {
  left: 4px;
}
.to_user_list_icon_em_b {
  left: 9px;
}
.to_user_list_icon_em_c {
  right: 4px;
}
.to_user_list_icon_em_d {
  width: 0;
  height: 0;
  border-style: solid;
  border-width: 4px;
  top: 14px;
  left: 6px;
  border-color: #fff transparent transparent transparent;
}
#to_user_list_txt {
  color: #fff;
  font-size: 13px;
  line-height: 16px;
  padding: 1px 3px 0 5px;
}
</style>
<body onselectstart="return true;" ondragstart="return false;">
<div data-role="container" class="container orderDetails processing pay_over">
	<header data-role="header">	
		<div class="title">我的订单
	        <div class="editbtndiv" id="processing">
	        <?php if($order['meal_type'] < 2): if($order['cancel'] == 1): ?><span onclick="javascript:drop_confirm('你确定要退款吗？', '<?php echo U('My/meal_order_refund', array('mer_id' => $order['mer_id'], 'store_id' => $order['store_id'], 'orderid' => $order['order_id']));?>');" class="cancel">退款</span><?php endif; ?>
				<?php if($order['cancel'] == 2): ?><span onclick="javascript:drop_confirm('你确定要删除订单吗？', '<?php echo U('Food/orderdel', array('mer_id' => $order['mer_id'], 'store_id' => $order['store_id'], 'orderid' => $order['order_id']));?>');" class="cancel">删除</span><?php endif; ?>				
				<!--<?php if($order['total'] > 0 AND $order['jiaxcai']): ?><span onclick="location.href='<?php echo U('Food/menu', array('mer_id' => $mer_id, 'store_id' => $store_id, 'orid' => $order['order_id']));?>'" class="edit">编辑</span>
				<?php else: ?>
					<if condition="$order['jiaxcai']">
						<span onclick="location.href='<?php echo U('Food/sureorder',array('mer_id' =>$mer_id,'store_id'=>$store_id,'orid'=>$order['order_id'],is_reserve=>1));?>'" class="edit">编辑</span><?php endif; endif; ?>-->				
				<?php if($order['jiaxcai']): if($order['total'] > 0): ?><span onclick="location.href='<?php echo U('Food/menu', array('mer_id' => $mer_id, 'store_id' => $store_id, 'orid' => $order['order_id']));?>'" class="edit">编辑</span><?php endif; endif; ?>
			</if>
			</div>
		</div>
		<ul class="orderlist">
			<li>
				<?php if($order['meal_type'] == 2): ?><a href="<?php echo U('Food/pad', array('mer_id' => $mer_id, 'store_id' => $store_id));?>">
				<?php else: ?>
				<a href="<?php echo U('Food/shop', array('mer_id' => $mer_id, 'store_id' => $store_id));?>"><?php endif; ?>
					<div class="info">
					   	<span class="sawtooth <?php echo ($order['css']); ?>"><?php echo ($order['show_status']); ?></span>
						<label>
							<span class="name"><?php echo ($store['name']); ?></span>
							<span class="time"><?php echo ($order['otimestr']); ?></span>
						</label>
					</div>
					<div><span class="right_adron"></span></div>
				</a>
			</li>
		</ul>
		<ul class="pay" style="padding-right: 20px;">
			<li>流水号<label><?php echo ($order['order_id']); ?></label></li>
			<li>订单号<label><?php echo ($order['orderid']); ?></label></li>
			<li>桌台情况<label><?php echo ($order['tablename']); ?></label></li>
			<li>人数<label><?php echo ($order['num']); ?>人</label></li>
			<li>姓名<label><?php echo ($order['name']); ?> <?php if($order['sex'] == 2): ?>女士<?php else: ?>先生<?php endif; ?></label></li>
			<li>联系电话<label><?php echo ($order['phone']); ?></label></li>
			<?php if($order['arrive_time']): ?><li>预约时间<label><?php echo (date("Y-m-d H:i",$order['arrive_time'] )); ?></label></li><?php endif; ?>
			<li>积分抵扣费用<label>￥<?php echo ($order['score_deducte']); ?></label></li>
			<?php if($order['paid'] == 1): ?><li>消费二维码<label><a id="see_storestaff_qrcode" style="color:#FF658E;">查看二维码</a></label></li><?php endif; ?>
		</ul>	
		<!--div class="paybtn">
			<?php if($order['topay']): ?><a href="<?php echo U('Pay/check', array('order_id' => $order['order_id'], 'type'=>'food'));?>" class="btn orange bigfont left">去付款</a><?php endif; ?>
			<?php if($order['jiaxcai']): ?><a href="<?php echo U('Food/menu', array('mer_id' => $mer_id, 'store_id' => $store_id, 'orid' => $order['order_id']));?>" class="btn orange bigfont right">去加菜</a><?php endif; ?>
			<?php if($order['cancel'] == 1): ?><a href="javascript:drop_confirm('你确定要取消订单吗？', '<?php echo U('My/meal_order_refund', array('mer_id' => $order['mer_id'], 'store_id' => $order['store_id'], 'orderid' => $order['order_id']));?>');" class="btn orange bigfont right">取消订单</a><?php endif; ?>
			<?php if($order['cancel'] == 2): ?><a href="javascript:drop_confirm('你确定要取消订单吗？', '<?php echo U('Food/orderdel', array('mer_id' => $order['mer_id'], 'store_id' => $order['store_id'], 'orderid' => $order['order_id']));?>');" class="btn orange bigfont right">删除订单</a><?php endif; ?>
		</div-->
	</header>
	<section data-role="body" class="section_scroll_content">
		<div class="menulist ">
			<div>我的订单</div>
			<label></label>		
			<span>
				<span></span>
				<?php if(!empty($meallist) AND is_array($meallist)): ?><div class="list">
					<ul>
					<?php if(is_array($meallist)): $i = 0; $__LIST__ = $meallist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$dishs): $mod = ($i % 2 );++$i;?><li>
							<span class="col1"><?php echo ($dishs['name']); if(isset($dishs['isadd']) AND $dishs['isadd']): ?><sup><i style="color:green;margin-left:5px;"><strong>加购</strong></i></sup><?php endif; ?></span>
							<span class="col2">×<?php echo ($dishs['num']); ?></span>
							<span class="col3">￥<?php echo ($dishs['price']); ?></span>
							<?php if(isset($dishs['omark']) && !empty($dishs['omark'])): ?><div style="line-height: 18px;float: left;"><span style="color:#ef7f2c">备注：</span><span><?php echo (htmlspecialchars_decode($dishs['omark'],ENT_QUOTES)); ?></span></div><?php endif; ?>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
					<?php if(isset($order['note']) && !empty($order['note'])): ?><li>
						<span style="color:#ef7f2c">购物车备注：</span><span style="line-height: 18px;float:none;"><?php echo (htmlspecialchars_decode($order['note'],ENT_QUOTES)); ?></span></span>
					</li><?php endif; ?>
					</ul>
				<?php else: ?>
				  <div class="tips" style="display:block;">亲，您还没有购物喔！</div>
				  	<div class="list">
					<ul>
					</ul><?php endif; ?>
					<div>
						<span class="col1">合计</span>
						<span class="col2">&nbsp;&nbsp;<?php echo ($order['total']); ?></span>
						<span class="col3">￥<?php if($order['total_price'] > 0): echo ($order['total_price']-$order['score_deducte']); else: echo ($order['price']-$order['score_deducte']); endif; ?></span>
						<?php if($order['minus_price'] > 0): ?><span class="col1">优惠</span>
						<span class="col2">-￥<?php echo ($order['minus_price']); ?></span>
						<span class="col3">=￥<?php echo ($order['total_price'] - $order['minus_price']); ?></span><?php endif; ?>
						<?php if(!empty($order['leveloff'])): ?><span class="col1">会员等级</span>
						<span class="col2"><?php echo ($order['leveloff']['lname']); ?></span>
						<span class="col3" style="text-align: center;"><?php echo ($order['leveloff']['offstr']); ?></span><?php endif; ?>
						<?php if($order['paid'] == 2): ?><span class="col1">备注</span>
						<span class="col2">已支付 <?php echo ($order['pay_money']); ?></span>
						<span class="col3">未支付 <?php echo ($order['price']-$order['pay_money']-$order['score_deducte']); ?></span><?php endif; ?>
						<span class="col1">支付方式</span>
						<span class="col2"><?php echo ($order['paytypestr']); ?></span>
						<span class="col3 no_fontcolor"><?php echo ($order['paidstr']); ?></span>
						<?php if($order['status'] > 0 && $order['status'] < 3 && !empty($order['last_staff'])): ?><span class="col2"><?php if($order['tuan_type'] != 2): ?>消费<?php else: ?>发货<?php endif; ?>时间</span>
						 <span class="col1" style="color: #ef7f2c;"><?php echo (date('Y-m-d H:i:s',$order['use_time'])); ?></span>
						 
						 <span class="col2">操作店员</span>
						 <span class="col1"  style="color: #ef7f2c;"><?php echo ($order['last_staff']); ?></span><?php endif; ?>
				   		<?php if($order['status'] == 3): ?><span class="col2">订单操作</span>
						<span class="col3">已取消并退款</span><?php endif; ?>
					</div>
				</div>
				<label class="line"><span></span></label>
			</span>	 
		</div>
	</section>
	<?php if($order['topay']): ?><footer data-role="footer">
			<div class="btndiv_fixed">
				<?php if($order['meal_type'] == 2): ?><a href="<?php echo U('Pay/check', array('order_id' => $order['order_id'], 'type'=>'foodPad'));?>" class="btn orange bigfont">去付款</a>
				<?php else: ?>
				<a href="<?php echo U('Pay/check', array('order_id' => $order['order_id'], 'type'=>'food'));?>" class="btn orange bigfont">去付款</a><?php endif; ?>
			</div>	
		</footer>
	<?php elseif($order['status'] == 1): ?>
		<footer data-role="footer">
			<div class="btndiv_fixed">
				<a href="<?php echo U('My/meal_feedback',array('order_id' => $order['order_id']));?>" class="btn orange bigfont">去评价</a>
			</div>	
		</footer><?php endif; ?>
</div>
<?php if($order['meal_type'] != 2): if($kf_url): ?><div id="enter_im_div" style="-webkit-transition: opacity 200ms ease; transition: opacity 200ms ease; opacity: 1; display: block;cursor:move;z-index: 10000;">
	<a id="enter_im" data-url="<?php echo ($kf_url); ?>">
	<div id="to_user_list">
	<div id="to_user_list_icon_div" class="rel left">
	<em class="to_user_list_icon_em_a abs">&nbsp;</em>
	<em class="to_user_list_icon_em_b abs">&nbsp;</em>
	<em class="to_user_list_icon_em_c abs">&nbsp;</em>
	<em class="to_user_list_icon_em_d abs">&nbsp;</em>
	<em id="to_user_list_icon_em_num" class="hide abs">0</em>
	</div>
	<p id="to_user_list_txt" class="left" style="font-size:12px">联系客服</p>
	</div>
	</a>
</div>

<script type="text/javascript">
	$(function(){
		var mousex = 0, mousey = 0;
		var divLeft = 0, divTop = 0, left = 0, top = 0;
		document.getElementById("enter_im_div").addEventListener('touchstart', function(e){
			e.preventDefault();
			var offset = $(this).offset();
			divLeft = parseInt(offset.left,10);
			divTop = parseInt(offset.top,10);
			mousey = e.touches[0].pageY;
			mousex = e.touches[0].pageX;
			return false;
		});
		document.getElementById("enter_im_div").addEventListener('touchmove', function(event){
			event.preventDefault();
			left = event.touches[0].pageX-(mousex-divLeft);
			top = event.touches[0].pageY-(mousey-divTop)-$(window).scrollTop();
			if(top < 1){
				top = 1;
			}
			if(top > $(window).height()-(50+$(this).height())){
				top = $(window).height()-(50+$(this).height());
			}
			if(left + $(this).width() > $(window).width()-5){
				left = $(window).width()-$(this).width()-5;
			}
			if(left < 1){
				left = 1;
			}
			$(this).css({'top':top + 'px', 'left':left + 'px', 'position':'fixed'});
			return false;
		});
		document.getElementById("enter_im_div").addEventListener('touchend', function(event){
			if ((divLeft == left && divTop == top) || (top == 0 && left == 0)) {
				var url = $('#enter_im').attr('data-url');
				if (url == '' || url == null) {
					alert('商家暂时还没有设置客服');
				} else {
					location.href=$('#enter_im').attr('data-url');
				}
			}
			return false;
		});

		$('#enter_im_div').click(function(){
			var url = $('#enter_im').attr('data-url');
			if (url == '' || url == null) {
				alert('商家暂时还没有设置客服');
			} else {
				location.href=$('#enter_im').attr('data-url');
			}
		});
	});
</script><?php endif; ?>
<div style="display:none;"><?php echo ($config["wap_site_footer"]); ?></div><?php endif; ?>
<script src="<?php echo ($static_public); ?>js/jquery.qrcode.min.js"></script>
<script src="<?php echo ($static_path); ?>layer/layer.m.js"></script>
<script type="text/javascript">
	$(function(){
		$('#see_storestaff_qrcode').click(function(){
			var qrcode_width = $(window).width()*0.6 > 256 ? 256 : $(window).width()*0.6;
			layer.open({
				title:['消费二维码','background-color:#8DCE16;color:#fff;'],
				content:'生成的二维码仅限提供给商家店铺员工扫描验证消费使用！<br/><br/><div id="qrcode"></div>',
				success:function(){
					$('#qrcode').qrcode({
						width:qrcode_width,
						height:qrcode_width,
						text:"<?php echo ($config["site_url"]); ?>/wap.php?c=Storestaff&a=meal_qrcode&id=<?php echo ($order["order_id"]); ?>"
					});
				}
			});
			$('.layermbox0 .layermchild').css({width:qrcode_width+30+'px','max-width':qrcode_width+30+'px'});
		});
	});
	function drop_confirm(msg, url) {
		if (confirm(msg)) {
			window.location.href = url;
		}
	}
</script>
<?php echo ($hideScript); ?>
</body>
</html>