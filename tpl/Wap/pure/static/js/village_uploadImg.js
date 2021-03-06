
$(function(){
	$('#backBtn').click(function(){
		window.history.go(-1);
	});
	if($(".footerMenu").length){
		$('#scroller').css({'min-height':($(window).height()-100+1)+'px'});
	}else{
		$('#scroller').css({'min-height':($(window).height()-50+1)+'px'});
	}	
	
	if($("#upload_list").length){
        var imgUpload = new ImgUpload({
            fileInput: "#fileImage",
            container: "#upload_list",
            countNum: "#uploadNum",
			url:"http://" + location.hostname + "/wap.php?c=House&a=ajaxImgUpload"
		});
		$('#submit_btn').click(function(){
			$('#j_cmnt_input').val($.trim($('#j_cmnt_input').val()));
			if($('#j_cmnt_input').val() == ''){
				motify.log('请填写内容');
				return false;
			}
			layer.open({type: 2,content: '提交中，请稍等',shadeClose:false});
			$.post(window.location.href,$('#repair_form').serialize(),function(result){
				layer.closeAll();
				if(result.err_code == 1){
					layer.open({content:'提交成功!',shadeClose:false,btn:['确定'],yes:function(){
						window.location.href = okUrl;
					}});
				}else{
					motify.log(result.err_msg);
				}
			});
		});
	}
});