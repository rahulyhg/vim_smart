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
<script type="text/javascript" src="<?php echo ($static_path); ?>takeout/js/scroller.js"></script>
<body onselectstart="return true;" ondragstart="return false;">
<div class="container">
	<form name="cart_confirm_form" action="<?php echo U('Takeout/OrderPay',array('store_id'=> $store_id, 'mer_id' => $mer_id));?>" method="post">
	<section class="menu_wrap pay_wrap">
		<ul class="box">
			<li>
				<a href="<?php echo U('My/adress',array('buy_type' => 'waimai', 'store_id'=>$store_id, 'mer_id' => $mer_id, 'current_id'=>$now_group['user_adress']['adress_id']));?>">
					<strong>
						<span id="showAddres"><?php if($now_group['user_adress']['adress_id']): echo ($now_group['user_adress']['province_txt']); ?> <?php echo ($now_group['user_adress']['city_txt']); ?> <?php echo ($now_group['user_adress']['area_txt']); ?> <?php echo ($now_group['user_adress']['adress']); ?> <?php echo ($now_group['user_adress']['detail']); else: ?>请点击添加送货地址<?php endif; ?></span><br>
						<span id="showName"><?php echo ($now_group['user_adress']['name']); ?></span>
						<span id="showTel"><?php echo ($now_group['user_adress']['phone']); ?></span>
						</strong>
					<div><i class="ico_arrow"></i></div>
				</a>
			</li>
		</ul>
		<ul class="box pay_box">
			<li>
				<a href="javascript:void(0);" id="timeBtn">
					<strong>送达时间</strong>
					<span id="arriveTime">尽快送出</span>
					<div><i class="ico_arrow"></i></div>
				</a>
			</li>
			<li>
				<a href="javascript:void(0);" id="remarkBtn">
					<strong>订单备注</strong>
					<span id="remarkTxt">点击添加订单备注</span>
					<div><i class="ico_arrow"></i></div>
				</a>
			</li>
		</ul>

	<ul class="menu_list order_list" id="orderList">
	 <?php if(!empty($meals)): if(is_array($meals)): $i = 0; $__LIST__ = $meals;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ditem): $mod = ($i % 2 );++$i;?><li>
			<div>
			<?php if(!empty($ditem['image'])): ?><img src="<?php echo ($ditem['image']); ?>" alt=""><?php endif; ?>
			</div>
			<div>
				<h3><?php echo ($ditem['name']); ?></h3>
				<div>
					<div class="fr" max="-1">
					<a href="javascript:void(0);" class="btn add active"></a>
					</div>
					<input autocomplete="off" class="number" type="hidden" name="dish[<?php echo ($ditem['meal_id']); ?>][num]" value="<?php echo ($ditem['num']); ?>">
					<input autocomplete="off"  type="hidden" name="dish[<?php echo ($ditem['meal_id']); ?>][price]" value="<?php echo ($ditem['price']); ?>">
					<input autocomplete="off"  type="hidden" name="dish[<?php echo ($ditem['meal_id']); ?>][name]" value="<?php echo ($ditem['name']); ?>">
					<span class="count"><?php echo ($ditem['num']); ?></span>
					<strong>￥<span class="unit_price"><?php echo ($ditem['price']); ?></span></strong>
				</div>
				<?php if($kconoff == 1): ?><p style="line-height: 8px;">库存：<?php echo ($ditem['instock']); ?></p><?php endif; ?>
			</div>
	  </li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
	</ul>
	</section>
	<footer class="order_fixed">
		<div class="fixed">
			<p>
				<span class="fr">总计：<strong>￥<span id="totalPrice"></span></strong> / <span id="cartNum"></span>份</span>
				配送费：￥<?php echo ($store['delivery_fee']); ?>			
			</p>
            <a href="<?php echo U('Takeout/menu', array('mer_id' => $mer_id, 'store_id' => $store_id));?>" class="add"><label><span>添加</span></label></a>
			<span class="comm_btn disabled" style="display: none;">还差￥<span id="sendCondition"><?php if($store['basic_price'] > 0 AND $store['delivery_fee_valid'] == 0): echo ($store['basic_price']); else: ?>0<?php endif; ?></span>满最低起送价</span>
			<a href="javascript:;" class="comm_btn" id="submit_order">订单确认</a>
		</div>
	</footer>
	
	<div style="display:none;">
	  <input class="hidden" id="totalmoney" name="totalmoney" value="0">
	  <input class="hidden" id="totalnum" name="totalnum" value="0">
	  <input class="hidden" id="ouserName" name="ouserName" value="<?php echo ($now_group['user_adress']['name']); ?>">
	  <input class="hidden" id="ouserTel" name="ouserTel" value="<?php echo ($now_group['user_adress']['phone']); ?>">
	  <input class="hidden" id="ouserAddres" name="ouserAddres" value="<?php echo ($now_group['user_adress']['province_txt']); ?> <?php echo ($now_group['user_adress']['city_txt']); ?> <?php echo ($now_group['user_adress']['area_txt']); ?> <?php echo ($now_group['user_adress']['adress']); ?>  <?php echo ($now_group['user_adress']['detail']); ?>">
	  <input class="hidden" id="address_id" name="address_id" value="<?php echo ($now_group['user_adress']['adress_id']); ?>">
	  <input class="hidden" id="oarrivalTime" name="oarrivalTime" value="">
	  <input class="hidden" id="omark" name="omark" value="">
	</div>
	</form>
	<div class="addres_box" id="addresBox">
		  <ul>
			<li><input class="txt" placeholder="预定人" id="userName"></li>
			<li class="get_code">
				<span><input class="txt" placeholder="手机" maxlength="11" id="userTel"></span>
			</li>
			<li class="get_code">
				<span>性别：<label><input type="radio" name="yousex" id="yousex1" value="1" checked="checked" class="sexinput"> 男 </label>
				&nbsp;&nbsp;&nbsp;
				<label><input type="radio" name="yousex" id="yousex0" value="0" class="sexinput"> 女 </label></span>
			</li>
			<li><textarea class="txt" placeholder="送餐地址" id="userAddres"></textarea></li>
			<li class="btns_wrap">
				<span><a href="javascript:void(0);" class="comm_btn higher disabled" id="cancleAddres">取消</a></span>
				<span><a href="javascript:void(0);" class="comm_btn higher" id="saveAddres">确认</a></span>
			</li>
		</ul>
	</div>
	<div id="timeBox" class="timeBox">
		<div>
			<a href="javascript:void(0);">尽快送出</a>
			<?php if(is_array($time_list)): $i = 0; $__LIST__ = $time_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$time): $mod = ($i % 2 );++$i;?><a href="javascript:void(0);"><?php echo ($time); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
	</div>

	<div class="addres_box" id="remarkBox">
		<ul>
			<li><textarea class="txt max" placeholder="请填写备注" id="userMark"></textarea></li>
			<li class="btns_wrap">
			<span><a href="javascript:void(0);" class="comm_btn higher disabled" id="cancleRemark">取消</a></span>
			<span><a href="javascript:void(0);" class="comm_btn higher" id="saveRemark">确认</a></span>
			</li>
		</ul>
	</div>
</div>
<script type="text/javascript">
var config  = {isForeign: false};
var addressBox = {
	init: function(){
		this.differTime = 60;
		this.box = $('#addresBox');
		this.errorMsg = {
			userName: '预定人不能为空',
			userTel: '手机不能为空',
			userAddres: '送餐地址不能为空'
		};

		var _this = this;

		$('#addresBtn').click(function(){
			_this.show.call(this, _this);
		});
		$('#saveAddres').click(function(){
			_this.save.call(this, _this);
		});
		$('#cancleAddres').click(function(){
			_this.close();
		});
	},
	show: function(obj){ /**obj是_this**$(this)是$('#addresBtn')***/
		var addressTxt = $.trim($(this).find('strong').text());
		if(addressTxt == '' || addressTxt == '请点击添加送餐地址'){
			
		}else{
			var sex=$.trim($('#ouserSex').val());
			sex=parseInt(sex);
			if(sex==0){
			  $('#yousex0').click();
			}else{
			  $('#yousex1').click();
			}
			$('#userName').val($('#showName').text());
			$('#userTel').val($('#showTel').text());
			$('#userAddres').val($('#showAddres').text());
		}

		obj.box.dialog({title: '送餐地址', closeCb: function(){
			obj.reset();
		}});
	},
	save: function(obj){
		var error = '',
			tel = $('#userTel').val();
		$('#userName, #userTel, #userAddres').each(function(){
			if(this.value == ''){
				error += obj.errorMsg[this.id] + '\n';
			}
		});

		function fillData(){
			$('#showAddres').text($('#userAddres').val());
			$('#showName').text($('#userName').val());
			$('#showTel').text(tel);

			obj.close();
		}

		// 判断是否为空
		if(error){
			alert(error);
			return false;
		}
		if(!/^.{5,20}$/gi.test(tel) || !/^(\+\s?)?(\d*\s?)?(?:\(\s?(\d+[-\s])?\d+\s?\)\s?)?\s?(\d+[-\s]?)+\d+$/gi.test(tel)){
				alert('请输入正确的手机号码');
				return false
			}
			fillData();
	},
	reset: function(){
		$('#codeWrap').hide();
		$('#userTel').attr('disabled', false);
		$('#userCode').val('');
	},
	close:function(){
		this.box.dialog('close');
		this.reset();
	}
}
$(function(){
	addressBox.init();

	var _timeBox = $('#timeBox'),
		_addresBox = $('#addresBox'),
		_remarkBox = $('#remarkBox'),
		_remarkInput = _remarkBox.find('textarea');

	// 选择送餐时间
	$('#timeBtn').bind('click', function(){
		_timeBox.dialog({title: '选择送达时间'});
	});

	_timeBox.find('a').bind('click', function(){
		$('#arriveTime').text($(this).text());
		_timeBox.dialog('close');
	});
    //性别选择
	$('#addresBox .sexinput').bind('click', function(){
		var vsex=$(this).val();
		$('#ouserSex').val(vsex);
	});
	// 添加备注
	$('#remarkBtn').bind('click', function(){
		var remark = $('#remarkTxt').text();
		if(remark == '点击添加订单备注') remark = '';
		$('#userMark').val(remark);
		_remarkBox.dialog({title: '添加备注'});
	});

	$('#cancleRemark').bind('click', function(){
		_remarkBox.dialog('close');
	});

	$('#saveRemark').bind('click', function(){
		$('#remarkTxt').text(_remarkInput.val());
		_remarkInput.val('');
		_remarkBox.dialog('close');
	});

	$("#submit_order").click(function(){
		if(!$(this).hasClass('disabled')){
			$(this).addClass('disabled');
			var money=$.trim($('#totalPrice').text());
			var tnum=$.trim($('#cartNum').text());
			money=parseFloat(money);
			tnum=parseInt(tnum);
			if(!(money>0)||!(tnum>0)){
				alert("您还没有点菜，请至少点一道菜啊");
				return false;
			}
			var wo_user_name = $.trim($("#showName").html());
			var wo_receiver_mobile = $.trim($("#showTel").html());
			var wo_receiver_address = $.trim($("#showAddres").html());
			if(wo_receiver_address == '请点击添加送餐地址') {
				wo_receiver_address = '';
			}
			if(wo_user_name == '' || wo_receiver_mobile == '' || wo_receiver_address == ''){
				alert("请完善送餐地址信息");
				$(this).removeClass('disabled');
				return false;
			}
			$('#totalmoney').val(money);
			$('#totalnum').val(tnum);
			$('#ouserName').val(wo_user_name);
			$('#ouserTel').val(wo_receiver_mobile);
			$('#ouserAddres').val(wo_receiver_address);
			var wo_delivery_time = $.trim($("#arriveTime").html());
			if(wo_delivery_time == '尽快送出'){
				wo_delivery_time = '';
			}
			$('#oarrivalTime').val(wo_delivery_time);
			var wo_memo = $.trim($("#remarkTxt").html());
			if(wo_memo == '点击添加订单备注') {
				wo_memo = '';
			}
			$('#omark').val(wo_memo);
			

			document.cart_confirm_form.submit();
		}
		return false;
	});
});
</script>
<script type="text/javascript">
var Pricing="<?php echo ($store['basic_price']); ?>";

$(function(){
	var amountCb = $.amountCb();
	$('#orderList li').each(function(){
		var count = parseInt($(this).find('.count').text()),
			_add = $(this).find('.add'),
			i = 0;

		for(; i < count; i++){
			amountCb.call(_add, '+');
		}

		_add.amount(count, amountCb);
	});

});
</script>
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
</body>
<?php echo ($hideScript); ?>
</html>