<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
    <title>智能门禁</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <meta content="Preview page of Metronic Admin Theme #4 for bootstrap inputs, input groups, custom checkboxes and radio controls and more" name="description" />
    <meta content="" name="author" />
	<link href="{pigcms{$static_path}css/137/weui.css" rel="stylesheet" id="style_components" type="text/css" />
	<link href="{pigcms{$static_path}css/137/weui2.css" rel="stylesheet" id="style_components" type="text/css" />
<style type="text/css">

body{

-moz-user-select:none;/*火狐*/

-webkit-user-select:none;/*webkit浏览器*/

-ms-user-select:none;/*IE10*/

-khtml-user-select:none;/*早期浏览器*/

user-select:none;

-webkit-tap-highlight-color:rgba(0,0,0,0);

}

</style></head>
<script>
    document.addEventListener('touchstart',function(){},false);
	
</script>
<body style="background-color:#f2f2f2;">
<div class="weui_msg hide" id="msg1" style="display: block; opacity: 1;">
        <div class="weui_icon_area"><i class="weui_icon_success weui_icon_msg"></i></div>
        <div class="weui_text_area">
            <h2 class="weui_msg_title">开门成功</h2>
            <p class="weui_msg_desc">小窍门：还可以从智慧助手公众号菜单<span style="color:#666666; font-weight:bold;">常用服务-微信开门</span>中提前开门噢~让你享受当领导的感觉！ </p>
        </div>
        <div class="weui_btn_area">
       		<div class="weui_btn weui_btn_primary" id="close_window">返回</div>
   		</div>
</div>
<div style="width:100%; height:5px; margin:10px auto; background-color:#dedede;"></div>
<div style="width:93%; margin:0px auto; height:30px; line-height:20px; color:#888; font-size:14px; font-weight:bold;">推广活动</div>
<!--<div style="width:93%; margin:0px auto;"><img src="{pigcms{$static_path}images/qwe.jpg" width="100%"/></div>-->
<div style="width:93%; margin:0px auto;"><a href="{pigcms{$adver_info['url']}"><img src="/upload/adver/{pigcms{$adver_info['pic']}" width="100%"/></a></div>
<div style="width:100%; text-align:center; padding-top:12px; color:#a9a9a9; font-size:12px;">Power by:汇得行控股（中国）有限公司</div>
<script>
var btn = document.getElementById('close_window');
	btn.onclick = function(){
		WeixinJSBridge.invoke('closeWindow',{},function(res){});
	}

</script>
</body>
</html>
