var countdown=60;
function sendsms(obj){
	var phone=$("input[name='phone']").val();	//手机号码
	if(phone=="" || phone=="null"){
		motify.log('手机号码不能为空！');
		return false;
	}else if(!(/^1[3|4|5|7|8]\d{9}$/.test(phone))){
		motify.log("手机号码格式有误，请重填");
		return false;
	}else{
		if(countdown==60){
			$.ajax({
				url:url_data,	//发送短信验证
				data:{'phone':phone},
				type:'POST',
				dataType:'json',
				success:function(data){
					if(data.code_error==0){
						//motify.log(data.code_msg);
					}else{
						motify.log(data.code_msg);
					}					
				}
			});
		}
		if(countdown==0){
			obj.removeAttribute("disabled");
			obj.style.background="#ff777d";
			obj.innerText="获取验证码";
			countdown=60;
		}else{
			obj.setAttribute("disabled",true);
			obj.style.background="#cccccc";
			obj.innerText="重新发送(" + countdown + ")";
			countdown--;
			setTimeout(function(){
				sendsms(obj);
			},1000)
		}
	}
}
function focusPhone(){	//输入手机号码时
	var sendCode=document.getElementById("send-code");
	sendCode.removeAttribute("disabled");
	sendCode.style.background="#ff777d";
	sendCode.innerText="获取验证码";
	countdown=0;
}
function blurPhone(){	//失去焦点时
	countdown=60;
}

function btnLoading(){	//加载方法
	var loadingToast=$('#loadingToast');
	if(loadingToast.css('display')!='none'){
		return;
	}
	loadingToast.show();
	setTimeout(function(){
		loadingToast.hide();
	}, 5000);
}
$(function(){	
	$('#backBtn').click(function(){
		window.history.go(-1);
	});
	
	$('.btn_access').click(function(){
		//alert(123);
		var truename=$('input[name="truename"]').val();	//真实姓名
		var phone=$('input[name="phone"]').val();	//手机号码
		var company=$('input[name="company"]').val();	//公司名
		var card=$('input[name="id_card"]').val();	//身份证号码
		var vcode=$("input[name='vcode']").val();	//手机验证码
		if(truename=="" || truename=="null"){
			motify.log('请输入真实姓名');
			return false;
		}else if(!(/^([^0-9]*)$/.test(truename))){
			motify.log('姓名格式有误，请重填');
			return false;
		}else if(phone=="" || phone=="null"){
			motify.log('请输入手机号码');
			return false;
		}else if(!(/^1[3|4|5|7|8]\d{9}$/.test(phone))){ 
			motify.log("手机号码格式有误，请重填");  
			return false; 
		}else if(vcode=="" || vcode=="null"){ 
			motify.log("请填写短信验证码");  
			return false;  
		}else if(company=="" || company=="null"){
			motify.log('请输入公司名');
			return false;
		}else if(!(/[\u4E00-\u9FA5]/.test(company))){
			motify.log('公司名称格式有误，请重填');
			return false;
		}else if(card=="" || card=="null"){
			motify.log('请输入身份证号码');
			return false;
		}else if(!checkCard1(card)){
			return false;
		}else{
			btnLoading();
			$.post(window.location.href,$('#access_form').serialize(),function(result){				
				if(result.err_code==0 || !result.err_code){		//提交成功
					$('#loadingToast').css('display','none');	//隐藏加载
					layer.open({content:result.code_msg,shadeClose:false,btn:['确定'],yes:function(){											
						//if(url_redirect){
							//window.location.href=url_redirect;	//开门操作
						//}else{
							//WeixinJSBridge.call("closeWindow");	//关闭
						//}
						WeixinJSBridge.call("closeWindow");	//关闭
					}});
				}else{
					alert(result.code_msg);
					window.location.reload();
				}
			});
		}
	})

})