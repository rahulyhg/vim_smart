<!DOCTYPE html>
<html>
<head>
    <title>收银台 | 收款二维码</title>
    <script type="text/javascript" src="<?php echo PIGCMS_TPL_STATIC_PATH;?>index/pay/scripts/jquery.js"></script>
	<script src="<?php echo PIGCMS_TPL_STATIC_PATH;?>index/pay/scripts/jquery.qrcode.min.js" type="text/javascript"></script>
	<link href="<?php echo PIGCMS_TPL_STATIC_PATH;?>css/cashier.css" rel="stylesheet">
	<link href="<?php echo PIGCMS_TPL_STATIC_PATH;?>index/pay/styles/style.css" rel="stylesheet" type="text/css">
	<style type="text/css">
		#qr-code-forever canvas{vertical-align: middle;}
		#qr-code-forever {line-height:200px;width:200px;height:200px;padding-top:4px;}
		.cashier-desk .realtime-pay {
    float:none;
    padding: 20px 0 0 30px;
    position: relative;
}
	</style>
</head>
<body>
    <div id="wrapper">
        <div id="page-wrapper" class="gray-bg form-horizontal">       
			<div class="wrapper wrapper-content animated fadeInRight">
				<div class="row">
					<div class="col-lg-12">
						<div class="ibox float-e-margins">							
							<div class="ibox-content"> 
								<div class="app__content js-app-main page-cashier carousel slide">
									<div class="carousel-inner">
										<div class="page-cashier-box"> 
											<div class="cashier-desk clearfix"> 
											<!-- 实时收款二维码 --> 
												<div class="realtime-pay js-pay-code-region clearfix">
													<div style="text-align:center;" id="carousel3">												
														<div class="pay-code f-pay-code"> 
															<p class="gray tips" id="receivablesforever" style="font-size:56px;">支付金额:¥ &nbsp;-&nbsp; 元</p> 
															<div class="qr-code-zone gray" id="qr-code-forever">
																二维码区域 
															</div> 
															
															<div style="font-size:40px; text-align:center; padding-bottom:35px;"><span style="color:#FF0000;">温馨提示：</span><span style="color:#666666;">现已开通微信支付 扫描二维码可直接付款</span></div>									
														</div>
													</div>
												</div> 
											</div> 														  
										</div>
									</div>
								</div> 
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>

	<script src="<?php echo PIGCMS_TPL_STATIC_PATH;?>cashier/commonfunc.js"></script>
    <script type="text/javascript">
	var qwidth=qheight=600;
	if(is_mobile()){
	  var bodyClient=document.getElementById("carousel3").scrollWidth;	//获取DIV宽度
	  $('.form-horizontal').addClass('mbform');
	  $('.row .col-lg-12').css('padding','1px');
	  $('.float-e-margins .ibox-content').css('padding','15px 5px 20px 5px');
	  $('.cashier-desk .realtime-pay').css('float','none').css('padding','0 0 0 5px');
	  $('.js-pay-code-region .pay-code').css('float','none').css('margin-left','0px').css('padding','0px');
	  $('.js-fixed-code-region').css('width','auto').css('border-left','none');
	  $('.qr-code-zone').css('width',bodyClient+'px').css('height',(bodyClient-150)+'px').css('padding-top','9px');//空白处宽高
	  $('.js-fixed-code-region').css('margin','0px').css('float','none');
	  //qwidth=qheight=430; 
	  qwidth=qheight=bodyClient-200;
	}else{
	  $('.form-horizontal').removeClass('mbform');
	}

	var topost=true;
	$(document).ready(function(){		
		var time=setInterval(function(){	//定时轮询判断是否有收款二维码生成或变化
		$.ajax({
			url:"?m=User&c=cashier&a=ewmChange",
			type:"post", 		 
			dataType:"json",  
			data:{},  				
			async:true,
			success:function(ret){
				//alert (ret.ewminfo);
				if(ret.error==0){
					$("#qr-code-forever").html('').css('background-color','#FFF').qrcode({  
						width: qwidth, //宽度 
						height: qheight, //高度 
						text:"<?php echo 'http://'.$_SERVER['HTTP_HOST'].$this->SiteUrl;?>/merchants.php?m=Index&c=pay&a=foreverpay&ordid="+ret.ewminfo //任意内容 
					});
					//alert(ret.ewminfo);
					$('#receivablesforever').html('支付金额：¥ '+ret.dataprice+' 元');
				}else{
					alert(ret.msg);
				}
			},
			//error:function(){
				//alert('loading error!');
			//}
		  });			
		},1000);
	
	})
    </script>
</body>
</html>