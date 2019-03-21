<include file="Public:header"/>
<!--<link rel="stylesheet" href="{pigcms{$static_path}css/pcpay.css">-->
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-tablet"></i>
				<a href="{pigcms{:U('Classify/index')}">微网站</a>
			</li>
			<li class="active">充值记录列表</li>
		</ul>
	</div>
<link rel="stylesheet" href="{pigcms{$static_path}css/pcpay.css">	
	<div class="white">
	<div class="head">
		<div class="head_wz">
			<div class="head_wzbt"><span id="dingdan" ddcode="<?php echo $config_arr['code'];?>">请您及时付款，以便订单尽快处理！订单号：<?php echo $config_arr['code'];?></span></div>
			<div class="head_wzbt2">请您在提交订单后24小时内完成支付，否则订单会自动取消</div>
		</div>
	</div>
	<div class="wxzf">微信支付</div>
	<div class="wzxf_zw">
		<div class="wzxf_zw2">
			<div class="bt">应付金额</div>
			<div class="bt2"><span id="money" ddmoney="<?php echo $config_arr['money'];?>"> <?php echo $config_arr['money'];?> </span></div>
			<div class="bt3">元</div>
			<div class="both"></div>
		</div>
		<div class="wzxf_phone">
			<div class="rwm">
				<div class="rwmx" id="qrcode"></div>
				<div class="rwmx2"><img src="./static/images/button.jpg" width="300" height="92" /></div>
			</div>
			<div class="rwm2"><div class="phone"></div></div>
			<div class="both"></div>
		</div>
	</div>
</div>

	
	<!-- 内容头部 -->
	
</div>
<script src="./static/js/qrcode.js"></script>
<script>
	if(<?php echo $code_url != NULL; ?>){
		var url = "<?php echo $code_url;?>";
		//alert(url);
		//参数1表示图像大小，取值范围1-10；参数2表示质量，取值范围'L','M','Q','H'
		var qr = qrcode(10, 'M');
		qr.addData(url);
		qr.make();
		var element=document.getElementById("qrcode");
		element.innerHTML = qr.createImgTag();
		var imgs=element.getElementsByTagName('img');
		for(var i=0; i<imgs.length; i++){
			imgs[i].style.width ='302px';
			imgs[i].style.height='302px';
		}
	}
</script>
<script type="text/javascript">
var d=$("#dingdan").attr("ddcode");
var money=$("#money").attr("ddmoney");
	setInterval(function(){
		//window.location.href="{pigcms{:U('Recharge/weixinAdd')}";
		$.ajax({
		url:"{pigcms{:U('Recharge/weixinAdd')}",
		type: "post", 		 
		dataType: "json",  
		data: {'out_trade_no':d,'money':money},  				
		async : true,
		success: function(res){
			if(res.code==4){	//支付或充值成功时
			   //$("#resmsgdiv").text(res.msg);
			   alert(res.msg);
			   window.location.href="{pigcms{:U('Recharge/index')}";						
			}else{
				$("#resmsgdiv").text(res.msg);
			}
		},
		error:function(){
			alert('loading error!');
		}
	  });			
	},5000);
</script>

<include file="Public:footer"/>
