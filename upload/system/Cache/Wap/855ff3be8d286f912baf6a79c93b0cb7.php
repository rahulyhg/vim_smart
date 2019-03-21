<?php if (!defined('THINK_PATH')) exit(); if(!defined('PigCms_VERSION')){ exit('deny access!');} ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8" />
	<title>智能门禁</title>
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width"/>
	<meta name="apple-mobile-web-app-capable" content="yes"/>
	<meta name='apple-touch-fullscreen' content='yes'/>
	<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
	<meta name="format-detection" content="telephone=no"/>
	<meta name="format-detection" content="address=no"/>
	<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/common.css?210"/>
	<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/village.css?211"/>		
	<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/weui.css"/>		
	<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/style.css"/>
	<script type="text/javascript" src="<?php echo C('JQUERY_FILE_190');?>" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo ($static_path); ?>js/fastclick.js" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo ($static_path); ?>layer/layer.m.js" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo ($static_path); ?>js/common.js" charset="utf-8"></script>
	<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script> <!--引入微信js-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
.zt {width:93%; margin:7px auto; color:#6e6e73; font-size:14px; padding-top:20px;}
.shtx_dkt {
    width: 100%;
    background-color: #FFFFFF;
	border-top:1px #e8e8e8 solid;
	border-bottom:1px #e8e8e8 solid;
}
.shtx_dk {
    width: 100%;
    padding: 5px 0 5px 0;
    margin: 0px auto;
}
.shtx_xmt:first-child {border-top:none;}
.shtx_xmt {width:96%; margin:0px auto; border-top:0.6px #dbdadd solid; padding-top:5px; padding-bottom:5px;}
.kdw {width:90%; margin:50px auto; margin-bottom:0px; padding-bottom:20px;}
.kdw2 {width:90%; margin:0px auto; padding-bottom:30px;}
.eww:hover {color:#ffffff;}
.eww2:hover {color:#454545;}
a, a:visited, a:hover {color:#fb4746;}
.gre2x {
    float: right;
    width: 35%;
    height: 40px;
    text-align: right;
    margin-right:-3%;
}
.als {width:70%; margin:0px auto; padding-top:5%; padding-bottom:2%;}
.als2 {width:100%; border:1px #A4BC41 solid; background-color:#ffffff; height:40px; line-height:40px; text-align:center; color:#A4BC41; font-size:15px;}
</style>
</head>
<script type="text/javascript"> 
$(window).load(function(){
	//alert("<?php echo ($msg); ?>");	//提示信息
	//alert("<?php echo ($url); ?>");
	//WeixinJSBridge.call("closeWindow");	//关闭
	//window.close();
	var msg_data="<?php echo ($msg); ?>";
	if(msg_data){
		layer.open({content:"<?php echo ($msg); ?>",shadeClose:false,btn:['确定'],yes:function(){
			var url_data="<?php echo ($url); ?>";			
			if(url_data){
				window.location.href="<?php echo U($url,array('village_id'=>$now_village['village_id'],'ac_id'=>$ac_id));?>";
			}else{
				WeixinJSBridge.call("closeWindow");	//关闭
			}		
		}});
	}else{
		wx.closeWindow();
	}	
});
</script>
<!--<body>
</body>-->
</html>