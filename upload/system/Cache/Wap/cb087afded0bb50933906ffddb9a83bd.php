<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">

<script type="text/javascript" src="<?php echo ($static_path); ?>takeout/js/jquery1.8.3.js"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>takeout/js/dialog.js"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>takeout/js/main.js"></script>

<title><?php if($store['name']): echo ($store['name']); else: ?>网页<?php endif; ?></title>
<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
<meta name="Keywords" content="">
<meta name="Description" content="">
<meta content="telephone=no, address=no" name="format-detection">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>takeout/css/main.css" media="all">
<style>
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
</head>
<body onselectstart="return true;" ondragstart="return false;">
<div class="container">
	<section>
		<ul class="my_order">
			<li>
				<a href="<?php echo U('Takeout/menu', array('mer_id'=>$order['mer_id'],'store_id'=>$order['store_id']));?>">
					<div>
						<div class="ico_status <?php echo ($order['css']); ?>"><i></i><?php echo ($order['show_status']); ?></div>
					</div>
					<div>
						<h3 class="highlight"><?php echo ($store['name']); ?></h3>
						<p><?php echo ($order['total']); ?>份/￥<?php echo ($order['price']); ?></p>
						<div><?php echo ($order['date']); ?></div>
					</div>
					<div class="w14"><i class="ico_arrow"></i></div>
				</a>
			</li>
		</ul>
		<table class="my_menu_list">
			<thead>
				<tr>
					<th>美食列表</th>
					<th><?php echo ($order['total']); ?>份</th>
					<th><strong class="highlight">￥<?php echo ($order['price']); ?></strong></th>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($order['info'])): $i = 0; $__LIST__ = $order['info'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info): $mod = ($i % 2 );++$i;?><tr>
					<td><?php echo ($info['name']); ?></td>
					<td>X<?php echo ($info['num']); ?></td>
					<td>￥<?php echo ($info['price']); ?></td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
			</tbody>
		</table>

		<ul class="box">
			<li>预定人：<?php echo ($order['name']); ?></li>
			<li>手机：<?php echo ($order['phone']); ?></li>
			<li>送餐地址：<?php echo ($order['address']); ?></li>
			<li>送餐时间：<?php echo ($order['arrive_time']); ?></li>
			<li>送餐费用：￥<?php echo ($order['delivery_fee']); ?></li>
			<li>积分抵扣费用：￥<?php echo ($order['score_deducte']); ?></li>
			<li>支付方式：<?php echo ($order['paytypestr']); ?></li>
			<li>支付状态：<?php if($order['status'] == 3): ?><span style="color:red">已退款</span><?php elseif($order['paid']): if($order['pay_type'] == 'offline' AND empty($order['third_id'])): ?><span style="color:red">线下未支付</span><?php else: ?><span style="color:green">已付款</span><?php endif; else: ?><span style="color:red">未支付</span><?php endif; ?></li>
			<?php if($order['paid'] && $order['status'] == 0): ?><li>消费二维码：<span id="see_storestaff_qrcode" style="color:#FF658E;">查看二维码</span></li><?php endif; ?>
		</ul>
		<ul class="box">
			<li>备注</li>
			<li><?php if($order['note']): echo ($order['note']); else: ?>无<?php endif; ?></li>
		</ul>
	</section>
	<?php if($order['status'] < 3): ?><footer class="order_fixed">
		<div class="fixed">
			<?php if($order['paid'] != 1 AND $order['status'] == 0): ?><div style="float: left">
					<a href="<?php echo U('Pay/check',array('order_id' => $order['order_id'], 'type'=>'takeout'));?>" class="comm_btn" style="background-color: #5fb038;">支付订单</a>
				</div><?php endif; ?>
			<div style="float: right">
				<?php if($order['paid'] == 0 AND $order['is_confirm'] == 0 AND $order['status'] < 3): ?><a class="comm_btn" href="javascript:drop_confirm('你确定要取消订单吗？', '<?php echo U('Takeout/orderdel', array('mer_id' => $order['mer_id'], 'store_id' => $order['store_id'], 'orderid' => $order['order_id']));?>');">取消订单</a> 
				<?php elseif($order['paid'] == 1 AND $order['status'] == 0 AND $order['is_confirm'] == 0): ?>
				<a class="comm_btn" href="javascript:drop_confirm('你确定要取消订单吗？', '<?php echo U('My/meal_order_refund', array('mer_id' => $order['mer_id'], 'store_id' => $order['store_id'], 'orderid' => $order['order_id']));?>');">取消订单</a><?php endif; ?>
			</div>
			<?php if($order['status'] == 1): ?><div style="float: right">
					<a href="<?php echo U('My/meal_feedback',array('order_id' => $order['order_id']));?>" class="comm_btn">去评价</a>
				</div><?php endif; ?>
		</div>
	</footer><?php endif; ?>
</div>
<script src="<?php echo ($static_public); ?>js/jquery.qrcode.min.js"></script>
<script src="<?php echo ($static_path); ?>layer/layer.m.js"></script>
<?php if($kf_url): ?><div id="enter_im_div" style="-webkit-transition: opacity 200ms ease; transition: opacity 200ms ease; opacity: 1; display: block;cursor:move;z-index: 10000;">
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
</script>
<div style="display:none;"><?php echo ($config["wap_site_footer"]); ?></div>
<script type="text/javascript">
	function drop_confirm(msg, url)
	{
		if (confirm(msg)) {
			window.location.href = url;
		}
	}
</script>
<?php echo ($hideScript); ?>
</body>
</html>