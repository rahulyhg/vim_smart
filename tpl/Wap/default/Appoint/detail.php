<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<if condition="$is_wexin_browser">
		<title>{pigcms{$now_group.appoint_name}</title>
	<else/>
		<title>【{pigcms{$now_group.merchant_name}】{pigcms{$now_group.appoint_name}</title>
	</if>
	<meta name="description" content="{pigcms{$now_group.appoint_content}">
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
	<link rel="shortcut icon" href="{pigcms{$config.site_url}/favicon.ico">
    <link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
	<link href="{pigcms{$static_path}css/group_detail_wap.css" rel="stylesheet"/>
	<link href="{pigcms{$static_path}css/idangerous.swiper.css" rel="stylesheet"/>
	<style>
		.swiper-slide{
			display: -webkit-box;
			display: -ms-flexbox;
			overflow: hidden;
			-webkit-box-align: center;
			-webkit-box-pack: center;
			-ms-box-align: center;
			-ms-flex-pack: justify;
		}
		.swiper-slide img{
			width:auto;
			height:auto;
			max-width:100%;
			max-height:90%;
		}
		.swiper-pagination{
			left: 0;
			top: 10px;
			text-align: center;
			bottom:auto;
			right:auto;
			width:100%;
		}
		.swiper-close{
			right:10px;
			top:5px;
			text-align:right;
			position:absolute;
			z-index:21;
			color:white;
			font-size:.7rem;
		}
		span.tag{
			background: #fdb338;
			color: #fff;
			line-height: 1.5;
			display: inline-block;
			padding: 0 .06rem;
			font-size: .24rem;
			border-radius: .06rem;
		}
		
		
		#enter_im_div {
		  bottom: 60px;
		  left:10px;
		  z-index: 11;
		  position: fixed;
		  width: 94px;
		  height:31px;
		}
		#enter_im {
		  width: 94px;
		  position: relative;
		  display: block;
		}
		a {
		  color: #323232;
		  outline-style: none;
		  text-decoration: none;
		}
		#to_user_list {
		  height: 16px;
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
		#deal {
  padding-bottom: 49px;
}
		.m-simpleFooter {
  position: fixed;
  z-index: 2;
  left: 0;
  right: 0;
  border: 1px solid #D4D4D4;
  background: rgba(240,240,240,.8);
  padding: 8px 10px;
  bottom: 0;
  border-width: 1px 0;
  line-height: 32px;
  height: 32px;
}
.m-simpleFooter-text{
	  text-align: center;
}
.w-button {
  text-align: center;
  white-space: nowrap;
  font-size: 14px;
  display: inline-block;
  vertical-align: middle;
  color: #fff;
  background: #3399FE;
  border-width: 0;
  border-style: solid;
  border-color: #1B7DE0;
  padding: 0 15px;
  text-align: center;
  height: 30px;
  line-height: 30px;
  border-radius: 3px;
  cursor: pointer;
  text-decoration: none!important;
  outline: none;
}
.w-button-main {
  background: #db3652;
  border-color: #b6243d;
}
.m-detail-buy .w-button {
  width: 112px;
}
	</style>
	<style>.msg-bg{background:rgba(0,0,0,.4);position:absolute;top:0;left:0;width:100%;z-index:998}.msg-doc{position:fixed;left:.16rem;right:.16rem;bottom:15%;border-radius:.06rem;background:#fff;overflow:hidden;z-index:999}.msg-hd{background:#f0efed;color:#333;text-align:center;padding:.28rem 0;overflow:hidden;font-size:.4rem;border-bottom:1px solid #ddd8ce}.msg-bd{font-size:.34rem;padding:.28rem;border-bottom:1px solid #ddd8ce}.msg-toast{background:rgba(0,0,0,.8);font-size:.4rem;color:#fff;border:0;text-align:center;padding:.4rem;-webkit-animation-name:pop-hide;-webkit-animation-duration:5s;border-radius:.12rem;bottom:60%;opacity:0;pointer-events:none}.msg-confirm,.msg-alert{-webkit-animation-name:pop;-webkit-animation-duration:.3s}.msg-option{-webkit-animation-name:slideup;-webkit-animation-duration:.3s}@-webkit-keyframes pop-hide{0%{-webkit-transform:scale(0.8);opacity:0}2%{-webkit-transform:scale(1.1);opacity:1}6%{-webkit-transform:scale(1)}90%{-webkit-transform:scale(1);opacity:1}100%{-webkit-transform:scale(0.9);opacity:0}}@-webkit-keyframes pop{0%{-webkit-transform:scale(0.8);opacity:0}40%{-webkit-transform:scale(1.1);opacity:1}100%{-webkit-transform:scale(1)}}@-webkit-keyframes slideup{0%{-webkit-transform:translateY(100%)}40%{-webkit-transform:translateY(-10%)}100%{-webkit-transform:translateY(0)}}.msg-ft{display:-webkit-box;display:-ms-flexbox;font-size:.34rem}.msg-ft .msg-btn{display:block;-webkit-box-flex:1;-ms-flex:1;margin-right:-1px;border-right:1px solid #ddd8ce;height:.88rem;line-height:.88rem;text-align:center;color:#2bb2a3}.msg-btn:last-child{border-right:0}.msg-option{background:0;bottom:55px;}.msg-option div:first-child,.msg-option .msg-option-btns:first-child .btn:first-child{border-radius:.06rem .06rem 0 0;border-top:0}.msg-option .btn{width:100%;background:#fff;border:0;color:#FF658E;border-radius:0}.msg-option .msg-bd{background:#fff;border-bottom:0}.msg-option .btn{height:.8rem;line-height:.8rem;border-top:1px solid #ccc}.msg-option-btns .btn:last-child{border-radius:0 0 .06rem .06rem;border-bottom:1px solid #ccc}.msg-option .msg-btn-cancel{padding:0;margin-top:.14rem;color:#FF658E;border-radius:.06rem}.msg-dialog .msg-hd{background-color:#fff}.msg-dialog .msg-bd{background-color:#f0efed}.msg-slide{background:0;bottom:0;left:0;right:0;border-radius:0;-webkit-animation-name:slideup;-webkit-animation-duration:.3s}</style>
</head>
<body id="index">
		<if condition="$now_group['end_time'] lt $_SERVER['REQUEST_TIME']">
			<div id="tips" class="tips" style="display:block;">真遗憾！这单预约已经结束</div>
		</if>
		<div id="deal" class="deal">
			<div class="list">
			    <div class="album view_album" data-pics="<volist name="now_group['all_pic']" id="vo">{pigcms{$vo.m_image}<if condition="count($now_group['all_pic']) gt $i">,</if></volist>">
			        <img src="{pigcms{$now_group.all_pic.0.m_image}" alt="{pigcms{$now_group.merchant_name}"/>
			        <div class="desc">点击图片查看相册</div>
			    </div>
			    <dl class="list list-in">
					<if condition="$vo['appoint_type'] eq 1">
						<dd class="dd-padding buy-price" id="buy_box">
							<div class="price">
								 <strong class="J_pricetag strong-color">可上门</strong>
								<space></space>
							</div>
						</dd>
					</if>
			        <dd class="dd-padding buy-desc">
			            <h1>{pigcms{$now_group.appoint_name}</h1>
			            <p class="explain">{pigcms{$now_group.appoint_content}</p>
			        </dd>
					<if condition="$now_group['payment_status'] eq 1">
						<ul class="campaign-tip dd-padding">
							<li class="campaign">
								<span class="tag">定金 {pigcms{$now_group.payment_money } 元</span>
							</li>
						</ul>
					</if>
					<if condition="$now_group['end_time'] gt $_SERVER['REQUEST_TIME']">
			        <dd class="dd-padding agreement">
			            <ul class="agree">
			                <li><i class="text-icon">◓</i>访问数{pigcms{$now_group['appoint_hits']}</li><li><i class="text-icon">◓</i>已预约{pigcms{$now_group['appoint_sum']}</li>
			            </ul>
			        </dd>
					</if>
			    </dl>
			</div>
			<dl class="list">
			    <dd>
			        <dl>
			            <dt>商家信息</dt>
			            <dd class="dd-padding">
							<div class="merchant">
							    <div class="biz-detail">
							        <a class="react" href="{pigcms{:U('Appoint/shop',array('store_id'=>$now_group['store_list'][0]['store_id']))}">
							            <h5 class="title single-line"> {pigcms{$now_group.store_list.0.name}</h5>
							            <div class="address single-line">{pigcms{$now_group.store_list.0.area_name}{pigcms{$now_group.store_list.0.adress}</div>
							        </a>
							    </div>
							    <div class="biz-call">
							        <a class="react phone" href="javascript:void(0);" data-phone="{pigcms{$now_group.store_list.0.phone}"><i class="text-icon">✆</i></a>
							    </div>
							</div>
			            </dd>
			        </dl>
			    </dd>
			    <if condition="count($now_group['store_list']) gt 1">
			        <dd class="db">
			            <a class="react" href="{pigcms{:U('Appoint/branch',array('appoint_id'=>$now_group['appoint_id']))}">
			                <div class="more">查看全部{pigcms{$now_group['store_list']|count=###}家分店</div>
			            </a>
			        </dd>
		        </if>
			</dl>
			<if condition="$appoint_product_list">
				<dl class="list">
					<dt>可选套餐</dt>
					<dd style="padding:5px 10px 15px 10px;">
						<div class="bigclass1 menubar" style="box-sizing:border-box;width:100%;display:inline-table;">
							<volist name="appoint_product_list" id="val">
								<div class="class1" style="float:left;width:50%;padding:0 5px;margin-top:10px;box-sizing:border-box;">
									<div class="class2" data-roleid="{pigcms{$val.id}" style="padding:4px 10px;font-size:13px;line-height:38px;height:38px;color:#333;border-radius:2px;border-color:#d7d7d7;border:1px solid #ccc;">
										<span>{pigcms{$val.name}</span>
										<span>￥{pigcms{$val.price}</span>
									</div>
								</div>
							</volist>
						</div>
					</dd>
				</dl>
			</if>
			<dl id="deal-details" class="list">
			    <dt>本单详情</dt>
                <dd class="dd-padding group_content">
                    {pigcms{$now_group.appoint_pic_content}
                </dd>
			</dl>
			<div id="recommand">
				<if condition="$merchant_group_list">
				    <dl class="list">
						<dd>
							<dl class="list">
							     <dt>商家其他可预约项</dt>
							     <volist name="merchant_group_list" id="vo">
							     	<dd>
								    	<a href="{pigcms{$vo.url}" class="react">
											<div class="dealcard">
										        <div class="dealcard-img imgbox">
										        	<img src="{pigcms{$vo.list_pic}" style="width:100%;height:100%;"/>
										        </div>
											    <div class="dealcard-block-right">
											        <div class="dealcard-brand single-line">{pigcms{$vo.appoint_name}</div>
											        <div class="title text-block">{pigcms{$vo.appoint_content}</div>
											        <div class="price">
											            <span class="strong-color">定金:￥</span>
														<strong>{pigcms{$vo.payment_money}</strong>&nbsp;
														<span class="tag"><if condition="$vo['appoint_type'] eq 1">上门<else/>到店</if></span>
														<if condition="$vo['appoint_sum']"><span class="line-right">已预约{pigcms{$vo.appoint_sum}</span></if>
											        </div>
											    </div>
											</div>
								        </a>
								     </dd>
							     </volist>
							</dl>
				        </dd>
				    </dl>
			    </if>
			</div>
		</div>
		<div id="enter_im_div" style="-webkit-transition: opacity 200ms ease; transition: opacity 200ms ease; opacity: 1; display: block;cursor:move;z-index: 10000;">
			<a id="enter_im" data-url="{pigcms{$kf_url}">
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
		<div class="m-simpleFooter m-detail-buy">
			<div class="m-simpleFooter-text">
				<a id="quickBuy" class="w-button w-button-main" href="<if condition="isset($store_id) && !empty($store_id)">{pigcms{:U('Appoint/order',array('appoint_id'=>$now_group['appoint_id'],'store_id'=>$store_id))}<else/>{pigcms{:U('Appoint/order',array('appoint_id'=>$now_group['appoint_id']))}</if>">立即预约</a>
			</div>
		</div>
    	<script src="{pigcms{:C('JQUERY_FILE')}"></script>
		<script src="{pigcms{$static_path}js/common_wap.js"></script>	
		<script src="{pigcms{$static_path}js/idangerous.swiper.min.js"></script>
		<script src="{pigcms{$static_path}js/appointlist.js"></script>
		<php>$no_footer = true;</php>
		<include file="Public:footer"/>
		
<script type="text/javascript">
$(function(){
	var menuId = '0';
	$('.menubar .class2').click(function(){
		menuId = $(this).data('roleid');
		$('.menubar .class2').css('border','1px solid #ccc');
		$(this).css('border','1px solid red');
	});
	$('#quickBuy').click(function(){
		if(menuId != '0'){
			window.location.href = $('#quickBuy').attr('href')+'&menuId='+menuId;
			return false;
		}
	});
});
$(document).ready(function(){
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
</script>
<script type="text/javascript">
window.shareData = {  
            "moduleName":"Group",
            "moduleID":"0",
            "imgUrl": "{pigcms{$now_group.all_pic.0.m_image}", 
            "sendFriendLink": "{pigcms{$config.site_url}{pigcms{:U('Appoint/detail', array('appoint_id' => $now_group['appoint_id']))}",
            "tTitle": "【{pigcms{$now_group.merchant_name}】{pigcms{$now_group.appoint_name}",
            "tContent": ""
};
</script>
{pigcms{$shareScript}
</body>
</html>