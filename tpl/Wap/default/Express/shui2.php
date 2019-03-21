<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
    <title>上报数据</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" >  
    <meta content="Preview page of Metronic Admin Theme #4 for bootstrap inputs, input groups, custom checkboxes and radio controls and more" name="description" />
    <meta content="" name="author" />
	<link href="{pigcms{$static_path}css/shui/weui3.css" rel="stylesheet" type="text/css" />
	<link href="{pigcms{$static_path}css/shui/example.css" rel="stylesheet" type="text/css" />
	<style type="text/css">
		.weui-icon-success {
			color: #188cf2;
		}
		.weui-btn_primary {
		  background-color: #188cf2;
		}
		.weui-btn_primary:not(.weui-btn_disabled):visited {
		  color: #FFFFFF;
		}
		.weui-btn_primary:not(.weui-btn_disabled):active {
		  color: rgba(255, 255, 255, 0.6);
		  background-color: #117cda;
		}
	</style>
</head>
<script>
    document.addEventListener('touchstart',function(){},false);
</script>
<body>
<div class="page msg_success js_show">
    <div class="weui-msg">
        <div class="weui-msg__icon-area"><i class="weui-icon-success weui-icon_msg"></i></div>
        <div class="weui-msg__text-area">
            <h2 class="weui-msg__title">上报成功</h2>
            <p class="weui-msg__desc">请工作人员不要重复上报</p>
        </div>
        <div class="weui-msg__opr-area">
            <p class="weui-btn-area">
                <a href="javascript:window.close();" class="weui-btn weui-btn_primary" id='close_window'>点击关闭</a>
                <!--<a href="javascript:history.back();" class="weui-btn weui-btn_default">辅助操作</a>!-->
            </p>
        </div>
        <div class="weui-msg__extra-area">
            <div class="weui-footer">
                
                <p class="weui-footer__text">汇得行（中国）集团有限公司</p>
            </div>
        </div>
    </div>
</div>
<script>
var btn = document.getElementById('close_window');
btn.onclick = function(){
   WeixinJSBridge.invoke('closeWindow',{},function(res){});
}
</script>
</body>