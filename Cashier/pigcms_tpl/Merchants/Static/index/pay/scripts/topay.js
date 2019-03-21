

function ByWxPay(){
   //var myf=document.getElementById('mydataform');
    //myf.action=formPostUrl;
	//$('#paytype').val('weixin');
	//document.myform.submit();
	$.ajax({
		url:formPostUrl,
		data:$('#mydataform').serialize(),
		type:'post',
		dataType:'json',

		success:function(data){		
			//swal("失败",data.msg,"error");
			if(data.error==0){
				//alert(data.redirctUrl);
				alert(data.weixin_param.toString());
				WeixinJSBridge.invoke("getBrandWCPayRequest",data.weixin_param,function(res){
					WeixinJSBridge.log(res.err_msg);
					if(res.err_msg=="get_brand_wcpay_request:ok"){
						//setTimeout(window.location.href=data.redirctUrl,2000);
						//alert('支付成功');
						window.location.href=data.redirctUrl;
					}else{
						if(res.err_msg=="get_brand_wcpay_request:cancel"){
							var err_msg="您取消了支付";
						}else if(res.err_msg=="get_brand_wcpay_request:fail"){
							var err_msg="支付失败<br/>错误信息："+res.err_desc;
						}else{
							var err_msg=res.err_msg +"<br/>"+res.err_desc;
						}
						alert(err_msg);
					}
				});
			}else{
				alert(data.msg);
			}
		},
		error:function(){
			//alert('loading error');
		}
	})
}