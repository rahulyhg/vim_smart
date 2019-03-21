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
	<link rel="stylesheet" href="<?php echo ($static_path); ?>css/bootstrap.min.css" type="text/css"></link>
	<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/common.css?210"/>
	<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/village.css?211"/>		
	<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/weui.css"/>		
	<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/example.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/style.css"/>
	<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo ($static_path); ?>js/fastclick.js" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo ($static_path); ?>js/common.js" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo ($static_path); ?>js/bootstrap.min.js"></script>
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
.fee {position: relative;
    display: block;
    margin-left: auto;
    margin-right: auto;
    padding-left: 14px;
    padding-right: 14px;
    box-sizing: border-box;
    font-size: 18px;
    text-align: center;
    text-decoration: none;
    background-color: #FFFFFF;
    line-height: 2.33333333;
    border-radius: 5px;
    -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    overflow: hidden;
	border: 1px solid #fb4746;
	}
</style>
</head>
<script type="text/javascript">
var nowTime=10;
function countDown(){ 	//10秒倒计时
    if(nowTime==0){
		window.location.reload();
    }else{ 
        motify.log('门已打开，'+nowTime+'秒后自动关闭！');
        nowTime--; 
    } 
	setTimeout(function(){ 
		countDown();
	},1000) 
}
$(function(){
	$('#backBtn').click(function(){
		window.history.go(-1);
	});
	
	$('.weui_btn').click(function(){	//关闭当前页
		WeixinJSBridge.call("closeWindow");
	});
	
	$('.weui_switch').one('click',function(){		
		//alert($(this).attr('data_acval'));
		var ac_id=$(this).attr('data_acval');
		var nodeid=$(this).attr('data_nodeid');
		var sensorid=$(this).attr('data_sensorid');
		//$('#controlNum').val(ac_id);
		$.ajax({
			'url':"<?php echo U('House/village_access_show',array('village_id'=>$now_village['village_id']));?>",
			'data':{'ac_id':ac_id,'nodeid':nodeid,'sensorid':sensorid},
			'type':'POST',
			'dataType':'JSON',
			'success':function(msg){
				if(msg.err_code==0){
					//alert(msg.code_msg);
					countDown();
				}else if(msg.err_code==2){	//门已开										
					alert(msg.code_msg);
					window.location.reload();
					//$('.weui_dialog_alert').css('display','block');
					//$('.weui_dialog_bd').html(msg.code_msg);
				}else{
					alert(msg.code_msg);
					window.location.reload();
				}			
			},
			/*'error':function(){
				alert('loading error!');
			}*/
		})
	});
})
</script>

<body>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" onClick="window.location.href =window.location.href;">
      <div class="modal-body">
 			<img src="<?php echo ($static_path); ?>images/kill.png" width="100%" height="100%" />
	  </div>
</div>
<header class="pageSliderHide"><div id="backBtn"></div><!--广发银行大厦--><?php echo ($now_village["village_name"]); ?></header>
<!--<div class="shtx_dk">
	<div class="shtx_xm"><span style="height:30px; line-height:30px; font-size:16px;">大堂</span></div>
	<div class="shtx_xm">
		<div class="gre">轧机2号门</div>
	    <div class="gre2"><input class="weui_switch" type="checkbox"/></div>
		<div class="both"></div>
	</div>
	<div class="shtx_xm">
		<div class="gre">轧机5号门</div>
	    <div class="gre2"><input class="weui_switch" type="checkbox"/></div>
		<div class="both"></div>
	</div>
</div>
<div class="shtx_dk2">
	<div class="shtx_xm STYLE1"><span style="height:30px; line-height:30px;">停车场</span></div>
	<div class="shtx_xm">
		<div class="gre">负一层出口</div>
	    <div class="gre2"><input class="weui_switch" type="checkbox"/></div>
		<div class="both"></div>
	</div>
	<div class="shtx_xm">
		<div class="gre">二楼后门3号</div>
	    <div class="gre2"><input class="weui_switch" type="checkbox"/></div>
		<div class="both"></div>
	</div>
</div>-->
<!--<div class="als">
	<div class="als2">广发银行大厦</div>
</div>-->
<?php if(is_array($control_result)): $k = 0; $__LIST__ = $control_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><div class="zt"><?php echo ($vo["parent"]); ?></div>
<div class="shtx_dkt">
<input type="hidden" name="controlNum" value="" id="controlNum">
<div class="shtx_dk">
	<?php if(is_array($vo["child"])): $i = 0; $__LIST__ = $vo["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$child): $mod = ($i % 2 );++$i;?><div class="shtx_xmt">
			<div class="gre"><?php echo ($child["ac_name"]); ?></div>
			<div class="gre2x">
				<div class="bd spacing"><a href="javascript:;" id="showDialog2"><input class="weui_switch" type="checkbox" data_acval="<?php echo ($child["ac_id"]); ?>" data_nodeid="<?php echo ($child["nodeid"]); ?>" data_sensorid="<?php echo ($child["sensorid"]); ?>"/></a></div>
				<!--<div class="weui_dialog_alert" id="dialog2" style="display: none;">
					<div class="weui_mask"></div>
					<div class="weui_dialog">
						<span class="weui_dialog_bd"> </span>
						<div class="weui_dialog_ft">
							<a href="javascript:;" class="weui_btn_dialog primary">确定</a>
						</div>
					</div>
				</div>-->
			</div>
			<div class="both"></div>
		</div><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
</div><?php endforeach; endif; else: echo "" ;endif; ?> 

<div class="kdw"><?php if($role != 2): ?><a href="javascript:;" class="fee" data-toggle="modal" data-target="#myModal">帮TA开门</a><?php endif; ?></div>
<div class="kdw2"><a href="javascript:;" class="weui_btn weui_btn_warn eww">返 回</a></div>
<!--<div class="zdb">客服电话：<a href="tel:027-87779655" style="color:#fb4746;">027-87779655</a></div>-->
<script src="<?php echo ($static_path); ?>js/zepto.min.js"></script>
<script>
	$('#showDialog2').click(function (e) {
		var $dialog = $('#dialog2');
		$dialog.show();
		$dialog.find('.weui_btn_dialog').one('click', function () {
			$dialog.hide();
		});
	})
</script>
<?php echo ($shareScript); ?>
</body>
</html>