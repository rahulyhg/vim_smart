<!DOCTYPE html>
<html class="" lang="zh-CN">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
  <meta charset="utf-8" /> 
  <meta name="keywords" content="" /> 
  <meta name="HandheldFriendly" content="True" /> 
  <meta name="MobileOptimized" content="320" /> 
  <meta name="format-detection" content="telephone=no" /> 
  <meta http-equiv="cleartype" content="on" /> 
  <title><?php echo $ordertmp['title']?></title> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" /> 
  <link rel="stylesheet" href="<?php echo PIGCMS_TPL_STATIC_PATH;?>index/pay/styles/foreverpay.css"/>
  <script src="<?php echo PIGCMS_TPL_STATIC_PATH;?>index/pay/scripts/jquery.js"/> </script>
    <script type="text/javascript">
  function init(){
  	var price = document.getElementById("js-payer-price");
  	if(price.autofocus != true){
  		price.focus();
  	}	
  }
  </script>
  <style>
  .btn.btn-block {
    text-align: center;
    width: 100%;
    padding: 11px 10px;
    font-size: 16px;
    border-radius: 4px;
	line-height:20px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
  .fixed-cash .cashier-info-container .cashier-avatar{padding-top:0px;}
  .circular{border-radius:6px; border:1px #FFFFFF solid;}
  .cashier-info-container .cashier-avatar img{width: 65px;height: 65px;}
  .block-wrapper-form .block-form-item #js-payer-tname{border:0px;}
  .cashier-info-container .cashier-avatar{height:65px;}
  #js-payer-tname{padding:inherit;padding-top:10px;color:#7b7b7b;font-size:16px; height:50px;}
  .fixed-cash:not(.timeout) .cashier-info-container{background-color: #efeff4;border-bottom:0px;}
  .block_nav{margin-top:-20px;}
  .nav_payer_form{height: 90px;background: #fff;border:1px solid #ddd;}
  .nav_payer{margin-left:8px;}
  .fixed-cash:not(.timeout) .action-container{margin: 90px 0 0 0;}
  .block_nav{padding:9px;}
  #nav_p_form{line-height: 80px;
      border:1px solid #ddd;
      -webkit-transform-origin: 0 0;
      transform-origin: 0 0;
      -webkit-transform: scale(0.5);
      transform: scale(0.5);
      height: 200px;
      width: 199%;}
  .cashier-info-container .block-wrapper-form.payer-form{  padding: 0px;margin-bottom: 0px; }
  #nav_pay_fo{line-height: 100px;
      border:1px solid #ddd;
	  background-color:#FFFFFF;
      -webkit-transform-origin: 0 0;
      transform-origin: 0 0;
      -webkit-transform: scale(0.5);
      transform: scale(0.5);
      height: 100px;
      width: 199%;}
  #js-payer-name{height:100px;margin-top:1px;padding:0px 10px 0px 132px;width:80%;border:0px;line-height:100px;}
  </style>
</head> 
<body style="background: #efeff4;" onLoad="init()">
	<div class="container" >
		<div class="content fixed-cash "> 
			<form method="post" action="" name="myform" id="mydataform">
				<div class="cashier-info-container center">
					<div class="avatar cashier-avatar"> 
						<?php if($merchant['img_info']){ ?>
							<a href="javascript:;"><img class="circular" src="<?php echo $merchant['img_info'];?>"/></a> 
						<?php }else{ ?>
						<a href="javascript:;"><img class="circular" src="./pigcms_tpl/Merchants/Static/images/profile_small.jpg"/></a> 
						<?php }?>
					</div> 
					<!--<p class="avatar-price anonym"> <span class="rmb">￥ </span><span id="themoney">0</span> 元</p>-->
					<div class="vlock_nav" style="height: 200px;">
						<div class="block-wrapper-form payer-form">
							<div class="block-form-item">
								<label class="item-input" id="js-payer-tname"  name="tname" />向<?php echo $merchant['wxname'];?>转账</label>
							</div>
						</div>
						<div class="block_nav" style="height: 200px;">
							<div class="block-wrapper-form payer-form nav_payer_form" id="nav_p_form">
								<div class="block-form-item" style="height: 80px;margin-top:36px;">
									<div style="padding-bottom:4px;padding: 35px 30px;">
										<span class="item-label" style="color:#464646;font-size:27px;padding-left:30px;">金额</span>
									</div>
									<div style="padding-bottom:4px;padding: 0 30px;margin-top:-28px;padding-left:38px;">
										<div color="#9ACD32" style="width: 2%;float: left;margin-top:-9px;"><span style="color:#000;font-size:30px">￥</span></div>
										<div style="overflow:hidden;margin-left:24px;height:70px;">
											<input type="number" class="item-input js-input-price" id="js-payer-price" name="goods_price" style="height:70px; line-height:70px;border:0;font-size:68px;padding:0 0 0 10px;" pattern="[0-9]*">
										</div>
									</div>
								</div>
							</div>
							<div class="block-wrapper-form payer-form" id="nav_pay_fo" style="margin-top:-90px;">
								<div class="block-form-item" style="background: #fff;">
									<label class="item-label" style="font-size:32px;height:100px;line-height:100px; padding-left:2%;">收款理由：在线收款</label>
									<!--<input type="text" class="item-input" id="js-payer-name"  name="goods_name" value="<?php if(!empty($orderInfo)) echo $orderInfo['goods_name'];?>" placeholder="输入收款理由"  required="required" style="font-size:32px">-->
									 <input type="hidden" class="item-input" id="js-payer-name"  name="goods_name" value="在线收款" required="required" style="font-size:32px">
								</div>
							</div>
						</div>
					</div>
				</div>
				<input type="hidden" value="<?php echo $mid;?>"  name="mid">
				<input type="hidden" value="weixin" id="paytype" name="paytype">
			</form>
			<div class="action-container" id="js-cashier-action">
				<div style="style=;margin-top:-70px;">
					<button class="btn-pay btn btn-block btn-large btn-umpay  btn-green" onClick="ByWxPay();" id="sub"> 微信支付 </button>
				</div>
				<div style="margin-bottom: 10px;">
				<!--<button type="button" data-pay-type="baiduwap" class="btn-pay btn btn-block btn-large btn-baiduwap  btn-white"> 储蓄卡付款 </button>-->
				</div>
			</div> 	
			<!--<div class="center action-tip js-cashier-tip">
			支付完成后，如需退款请及时联系卖家
			</div>-->
			<div style="position:absolute; bottom:0; left:50%; margin-left:-50px;">
				<div style="float:left; margin-top:0.5px;"><img src="./pigcms_tpl/Merchants/Static/images/jjy.png" style="width:11px; height:18px;"></div>
				<div style="float:left; color:#c1c1c1; padding-left:4px; height:20px; line-height:20px; width:85px; font-size:12px; font-weight:bold;">汇得行智慧助手</div>
				<div style="clear:both"></div>
			</div>
		</div> 
	</div> 
	<div class="footer"> 
	</div>
	<script type="text/javascript">
	<?php if(defined('ABS_UPLOAD_PATH')){?>
	var formPostUrl="<?php echo ABS_UPLOAD_PATH;?>/pay/wxpay/index.php?m=Index&c=pay&a=foreverpaying&ordid=auto";
	<?php }else{?>
	var formPostUrl="./pay/wxpay/index.php?m=Index&c=pay&a=foreverpaying&ordid=auto";
	<?php } ?>
	function priceShow(vv){
		vv=parseFloat(vv);
		if(vv>0){
		  $('#themoney').text(vv);
		}else{
		   $('#themoney').text('0');
		}
	}
    </script>
	<script src="<?php echo PIGCMS_TPL_STATIC_PATH;?>index/pay/scripts/topay.js?var=<?php echo time();?>"/> </script>
</body>
</html>