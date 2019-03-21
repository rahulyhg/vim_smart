<?php
//import('@.ORG.pay.Weixinnewpay.WxPayPubHelper');	//引入微信类文件
//include_once '../cms/Lib/ORG/pay/Weixinnewpay/WxPayPubHelper.class.php';
include_once '../cms/Lib/ORG/pay/Weixinnewpay/WxPayPubHelper.php';
$jsApi = new JsApi_pub();
//通过code获得openid
if(!isset($_GET['code'])){
	//触发微信返回code码
	$url = $jsApi->createOauthUrlForCode('http://'.$_SERVER['HTTP_HOST'].'/source/give_wxjsapi.php');
	Header("Location: $url");
}else{
	//获取code码，以获取openid
	$code = $_GET['code'];
	$jsApi->setCode($code);
	$openid = $jsApi->getOpenId();
	$state = $_GET['state'];
	if(!$openid){
		session_start();
		$openid=$_SESSION['openid'];
	}
}
$config=unserialize($state);
$unifiedOrder = new UnifiedOrder_pub();
$unifiedOrder->setParameter("openid",$openid);//商品描述
$unifiedOrder->setParameter("body","线下扫码支付");//商品描述
$timeStamp = time();
$unifiedOrder->setParameter("out_trade_no",$config['code']);//商户订单号
//$unifiedOrder->setParameter("total_fee","1");//总金额
$unifiedOrder->setParameter("total_fee",$config['money']*100);//总金额
$unifiedOrder->setParameter("notify_url",'http://'.$_SERVER['HTTP_HOST'].'/wap.php?g=Wap&c=Pay&a=giveCheck');//通知地址
$unifiedOrder->setParameter("trade_type","JSAPI");//交易类型
$prepay_id = $unifiedOrder->getPrepayId();
$jsApi->setPrepayId($prepay_id);
$jsApiParameters = $jsApi->getParameters();
?>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<title>微信转账支付</title>
	<style type="text/css">
		body{background: #f5f5f5;margin: 0px;}
		.wxzf{width: 100%;height: 50px;margin-top: 30px; }
		.zhifu{width:95%;height:50px;border-radius:15px;background-color:#04BE02;border:0px #04BE02 solid;cursor:pointer;color:white;font-size:16px;}
	</style>
	<script type="text/javascript">
		//调用微信JS api 支付
		function jsApiCall(){
			WeixinJSBridge.invoke(
				'getBrandWCPayRequest',
				<?php echo $jsApiParameters; ?>,
				function(res){
					WeixinJSBridge.log(res.err_msg);
					//alert(res.err_code+res.err_desc+res.err_msg);
					switch(res.err_msg){
						case 'get_brand_wcpay_request:cancel':
							//alert('用户取消支付！');
							break;
						case 'get_brand_wcpay_request:fail':
							//alert('支付失败！（'+res.err_desc+'）');
							break;
						case 'get_brand_wcpay_request:ok':
							//alert('支付成功！');
							var out_trade_no='<?php echo $config['code'];?>';
							var money='<?php echo $config['money']+$config['other_money'];?>';
							var other_money='<?php echo $config['other_money'];?>';
							var ds_id='<?php echo $config['ds_id'];?>';
							var cou_money='<?php echo $config['cou_money'];?>';
							var mer_id='<?php echo $config['mer_id'];?>';	//商户ID
							var typePay='<?php echo $config['typePay'];?>';	//支付类型
							window.location='http://'+'<?php echo $_SERVER['HTTP_HOST']?>'+'/wap.php?g=Wap&c=Pay&a=giveCheck&out_trade_no='+out_trade_no+'&money='+money+'&other_money='+other_money+'&ds_id='+ds_id+'&cou_money='+cou_money+'&mer_id='+mer_id+'&typePay='+typePay;
							break;
						default:
							alert(JSON.stringify(res));
							break;
					}
				}
			);
		}

		if (typeof WeixinJSBridge == "undefined"){
			if( document.addEventListener ){
				document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
			}else if (document.attachEvent){
				document.attachEvent('WeixinJSBridgeReady', jsApiCall);
				document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
			}
		}else{
			jsApiCall();
		}
		function callback(){
			WeixinJSBridge.call('closeWindow');
		}
	</script>
</head>
<body>
<div id="innerHtml">
	<!--<div style="padding-bottom:14px;">
	   <span style="font-size:15px;color:#7b7b7b;font-family:Helvetica;"></span>
	</div>
	<div align="center" class="wxzf">
		<button class="zhifu" type="button" onclick="callback()" >关闭当前页面</button>
	</div>-->
</div>
</body>
</html>





