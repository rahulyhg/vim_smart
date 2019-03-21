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
  <style>
  .container{margin-top: -5px;}
  .fixed-cash .cashier-info-container .cashier-avatar {padding-top: 15px;}
  .circular{border-radius:6px;}
  .cashier-info-container .cashier-avatar img{width: 65px;height: 65px; border:1px #FFFFFF solid;}
  .block-wrapper-form .block-form-item #js-payer-tname{border:0px;}
  .fixed-cash:not(.timeout) .cashier-info-container {border-bottom: inherit;background-color: inherit;}
   #js-payer-tname{padding:inherit;color:#7b7b7b;font-size:16px;}
  .nav_block{padding:9px;}
  .nav3{line-height: 80px;
   border:1px solid #ddd;
   -webkit-transform-origin: 0 0;
   transform-origin: 0 0;
   -webkit-transform: scale(0.5);
   transform: scale(0.5);
   height: 200px;
   width: 200%;
   background: #fff;}
  .cashier-info-container .block-wrapper-form.payer-form{  padding: 0px;margin-bottom: 0px; }
  #nav_pay_fo{line-height: 80px;
   border:1px solid #ddd;
   -webkit-transform-origin: 0 0;
   transform-origin: 0 0;
   -webkit-transform: scale(0.5);
   transform: scale(0.5);
   height:100px;
   width:200%;}
  #js-payer-name{height:100px;margin-top:1px;padding:10px 10px 10px 122px;width:80%;border:0px;line-height:100px;}
  .nav_block{margin-top:-19px;}
  #js-cashier-action{margin-top:10px;}
  </style>
 </head> 
 <body style="background: #efeff4;">
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
					<div class="nav_price" style="height: 200px;">
						<div class="block-wrapper-form payer-form">
							<div class="block-form-item">
								<label type="text" class="item-input" id="js-payer-tname" name="tname"/>向<?php echo $merchant['wxname'];?>付款</label>
							</div>
						</div>
						<div class="nav_block" >
							<div class="nav2">
								<div class="nav3" id="nav4">
									<div style="padding-bottom:4px;padding: 25px 30px;text-align: left;">
										<span style="color:#464646;font-size:27px;">金额</span>
									</div>
									<div style="padding-bottom:4px;padding: 0 30px;margin-top:-28px;">
									<!-- <span style="color:#999;letter-spacing:15px">金额</span> -->
										<div color="#9ACD32" style="width: 2%;float: left;margin-top:-25px;"><span class="rmb" style="color:#000;font-size:35px">￥</span></div>
										<div style="margin-left:40px;height:70px;text-align: left;margin-top: -30px;">
											<label  name="money" class="avatar-price anonym"  id="money" style="height:70px;border:0;font-size:68px;"><?php echo $ordertmp['price']?></label>
										</div>
									</div>
								</div>
							</div>
							<div class="block-wrapper-form payer-form" id="nav_pay_fo" style="margin-top:-90px;">
								<div class="block-form-item" style="background: #fff;">
									<label class="item-label" style="font-size:32px;height:100px;line-height:100px;">收款理由1：</label>
									<label  class="reason" id="js-payer-name"  style="font-size:33px;margin-left:-300px;"><?php echo $ordertmp['title']?></label>
								</div>
							</div>
						</div>
					</div>
				</div>
				<input type="hidden" value="<?php echo $ordertmp['mid']?>"  name="mid">
				<input type="hidden" value="<?php echo $ordertmp['price']?>"  name="goods_price">
				<input type="hidden" value="<?php echo $ordertmp['title']?>"  name="goods_name">
				<input type="hidden" value="weixin" id="paytype" name="paytype">
			</form>
			<div class="action-container" id="js-cashier-action">
				<div style="margin-bottom: 10px;"> 
					<button class="btn-pay btn btn-block btn-large btn-umpay  btn-green" onClick="ByWxPay();"> 微信支付 </button>
				</div>
				<div id="loadingToast" class="weui_loading_toast" style="display:none;">
					<div class="weui_mask_transparent"></div>
						<div class="weui_toast">
							<div class="weui_loading">
							<div class="weui_loading_leaf weui_loading_leaf_0"></div>
							<div class="weui_loading_leaf weui_loading_leaf_1"></div>
							<div class="weui_loading_leaf weui_loading_leaf_2"></div>
							<div class="weui_loading_leaf weui_loading_leaf_3"></div>
							<div class="weui_loading_leaf weui_loading_leaf_4"></div>
							<div class="weui_loading_leaf weui_loading_leaf_5"></div>
							<div class="weui_loading_leaf weui_loading_leaf_6"></div>
							<div class="weui_loading_leaf weui_loading_leaf_7"></div>
							<div class="weui_loading_leaf weui_loading_leaf_8"></div>
							<div class="weui_loading_leaf weui_loading_leaf_9"></div>
							<div class="weui_loading_leaf weui_loading_leaf_10"></div>
							<div class="weui_loading_leaf weui_loading_leaf_11"></div>
						</div>
						<p class="weui_toast_content">数据加载中</p>
					</div>
				</div>
				<div style="margin-bottom: 10px;"> 
				<!--<button type="button" data-pay-type="baiduwap" class="btn-pay btn btn-block btn-large btn-baiduwap  btn-white"> 储蓄卡付款 </button>-->
				</div>
			</div> 	
			<!--<div class="center action-tip js-cashier-tip">
			 支付完成后，如需退款请及时联系卖家
			</div>-->
		</div> 
	</div> 
	<div class="footer"> 
	</div>
	<div style="position:fixed; bottom:0; left:50%; margin-left:-50px;">
				<div style="float:left; margin-top:0.5px;"><img src="./pigcms_tpl/Merchants/Static/images/jjy.png" style="width:11px; height:18px;"></div>
				<div style="float:left; color:#c1c1c1; padding-left:4px; height:20px; line-height:20px; width:85px; font-size:12px; font-weight:bold;">汇得行智慧助手</div>
				<div style="clear:both"></div>
			</div>
	<script src="<?php echo PIGCMS_TPL_STATIC_PATH;?>index/pay/scripts/zepto.min.js"/> </script>
	<script type="text/javascript">
	<?php if(defined('ABS_UPLOAD_PATH')){?>
	var formPostUrl="<?php echo ABS_UPLOAD_PATH;?>/pay/wxpay/index.php?m=Index&c=pay&a=foreverpaying&ordid=<?php echo  $orderid;?>";
	<?php }else{?>
	var formPostUrl="./pay/wxpay/index.php?m=Index&c=pay&a=foreverpaying&ordid=<?php echo  $orderid;?>";
	<?php } ?>
	</script>
	<script src="<?php echo PIGCMS_TPL_STATIC_PATH;?>index/pay/scripts/topay.js?var=<?php echo time();?>"/> </script>
	<script type="text/javascript">
			$("#showToast").click(function(e){
				var $toast = $('#toast');
				if ($toast.css('display') != 'none') {
					return;
				}

				$toast.show();
				setTimeout(function () {
					$toast.hide();
				}, 2000);
			})
			$("#showLoadingToast").click(function(e){
				var $loadingToast = $('#loadingToast');
				if ($loadingToast.css('display') != 'none') {
					return;
				}

				$loadingToast.show();
				setTimeout(function () {
					$loadingToast.hide();
				}, 2000);
			})

		</script>
</body>
</html>