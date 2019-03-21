<?php if (!defined('THINK_PATH')) exit(); if(!defined('PigCms_VERSION')){ exit('deny access!');} ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8" />
	<title>微信获取定位信息</title>
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width"/>
	<meta name="apple-mobile-web-app-capable" content="yes"/>
	<meta name='apple-touch-fullscreen' content='yes'/>
	<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
	<meta name="format-detection" content="telephone=no"/>
	<meta name="format-detection" content="address=no"/>
	<script type="text/javascript" src="<?php echo C('JQUERY_FILE_190');?>" charset="utf-8"></script>
	<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script> <!--引入微信js-->
</head>
<script type="text/javascript">
wx.config({
	debug: false,
	appId: "<?php echo $signa_arr['appid'] ?>",
	timestamp: "<?php echo time() ?>",
	nonceStr: "<?php echo $signa_arr['str'] ?>",
	signature: "<?php echo $signa_arr['signature'] ?>",
	jsApiList: [
		'checkJsApi',
		//'openLocation',
        'getLocation'
	]
});
wx.ready(function(){
	//alert(123);
	wx.checkJsApi({
		jsApiList:[
			'getLocation'
		],
		success:function(res){
			//alert(res.checkResult.getLocation);
			if(res.checkResult.getLocation==false){
				alert('你的微信版本太低，不支持微信JS接口，请升级到最新的微信版本！');
				return;
			}
		}
	});
	//alert(456);
	setInterval(function(){
		wx.getLocation({
			success:function(res){
				//alert(789);
				var latitude=res.latitude; // 纬度，浮点数，范围为90 ~ -90
				var longitude=res.longitude; // 经度，浮点数，范围为180 ~ -180。
				var speed=res.speed; // 速度，以米/每秒计
				var accuracy=res.accuracy; // 位置精度
				$.ajax({
					'url':"<?php echo U('House/userLocation');?>",
					'data':{'lat':latitude,'long':longitude},
					'type':'POST',
					'dataType':'JSON',
					'success':function(msg){
						if(msg.code_error==0){
							//alert(msg.code_msg);
						}else{
							alert(msg.code_msg);
							window.location.reload();
						}			
					},
					//'error':function(){
						//alert('loading error!');
					//}
				})
			},
			fail:function(res){		//地理位置获取失败
				var description="";
				for(var i in res){    
					var property=res[i];    
					description+=i+"="+property+"\n";  
				}   
				alert(description);  
			},
			cancel:function(){
				alert('用户拒绝授权获取地理位置');
			}		
		});
	},5000);	//每隔5秒请求一次
})
</script>
<body>
<?php print_r($signa_arr); ?>
</body>
</html>