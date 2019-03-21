<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/> 
    <title>支付测试</title>
    <script type="text/javascript">
	//调用微信JS api 支付
	function jsApiCall()
	{
		WeixinJSBridge.invoke(
			'getBrandWCPayRequest',{pigcms{$result},
			function(res){
				WeixinJSBridge.log(res.err_msg);
				//alert(res);
			    if(res.err_msg == "get_brand_wcpay_request:ok"){  
				    alert("支付成功!");
			    }else if(res.err_msg == "get_brand_wcpay_request:cancel"){  
				    alert("用户取消支付!");
			    }else{  
				    alert("支付失败!");  
			    }  
			}
		);
	}

	function callpay()
	{
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
	}
	</script>
	
</head>
<body>
    <br/>
    <font color="#9ACD32"><b>该笔订单支付金额为<span style="color:#f00;font-size:50px">1分</span>钱</b></font><br/><br/>
	<font color="#9ACD32"><b><span style="color:#f00;font-size:50px;margin-left:40%;">1分</span>钱也是爱</b></font><br/><br/>
	<div align="center">
		<button style="width:210px; height:50px; border-radius: 15px;background-color:#FE6714; border:0px #FE6714 solid; cursor: pointer;  color:white;  font-size:16px;" type="button" onclick="callpay()" >微信支付</button>
	</div>
</body>
</html>
