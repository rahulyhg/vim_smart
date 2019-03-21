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
	<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script> <!--引入微信js-->
	<script type="text/javascript" src="<?php echo ($static_path); ?>js/bootstrap.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
.zt {width:56%; margin:7px auto; color:#6e6e73; font-size:14px; padding-top:20px; padding-bottom:6px; float:left; margin-left:4%;}
.zttt {width:30%; margin:7px auto; color:#6e6e73; font-size:14px; padding-top:20px; padding-bottom:6px; float:right; margin-right:4%; text-align:right;}
.shtx_dkt {
    width: 100%;
    background-color: #FFFFFF;
	border-top:1px #e8e8e8 solid;
	border-bottom:1px #e8e8e8 solid;
}
.shtx_dk {
    width: 100%;
    padding: 5px 0 0 0;
    margin: 0px auto;
}

.shtx_xmt {width:96%; margin:0px auto; border-bottom:0.6px #dbdadd solid; padding-top:5px; padding-bottom:5px;}
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
	font-size:14px;
	margin-right:-3%;
}
.gre {
    float: left;
    height: 35px;
    width: 60%;
    line-height: 35px;
    color: #000000;
    font-size: 14px;
	 color:#999999;
}
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
function weuiSwitch(){
	$('.weui_switch').one('click',function(){		
		var ac_id=$(this).attr('data_acval');
		var nodeid=$(this).attr('data_nodeid');
		var sensorid=$(this).attr('data_sensorid');
		var village_id=$(this).attr('data_village');
		$.ajax({
			'url':"<?php echo U('House/control_show');?>",
			'data':{'ac_id':ac_id,'nodeid':nodeid,'sensorid':sensorid,'village_id':village_id},
			'type':'POST',
			'dataType':'JSON',
			'success':function(msg){
				if(msg.err_code==0){
					//alert(msg.code_msg);
					countDown();
				}else if(msg.err_code==2){	//门已开或范围之外										
					alert(msg.code_msg);
					window.location.reload();
				}else if(msg.err_code==3){	//审核完成前
					window.location.href=msg.code_msg;
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
}
$(function(){
	$('#backBtn').click(function(){
		window.history.go(-1);
	});
	
	$('.weui_btn').click(function(){	//关闭当前页
		WeixinJSBridge.call("closeWindow");
	});

})

wx.config({
	debug: false,
	appId: "<?php echo $signa_arr['appid'] ?>",
	timestamp: "<?php echo time() ?>",
	nonceStr: "<?php echo $signa_arr['str'] ?>",
	signature: "<?php echo $signa_arr['signature'] ?>",
	jsApiList: [
		'checkJsApi',
        'getLocation'
	]
});
wx.ready(function(){
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
	wx.getLocation({
		success:function(res){
			var latitude=res.latitude; // 纬度，浮点数，范围为90 ~ -90
			var longitude=res.longitude; // 经度，浮点数，范围为180 ~ -180。
			var speed=res.speed; // 速度，以米/每秒计
			var accuracy=res.accuracy; // 位置精度
			$.ajax({
				'url':"<?php echo U('House/userLocation');?>",
				'data':{'lat':latitude,'long':longitude,'control':'is_control'},
				'type':'POST',
				'dataType':'JSON',
				'success':function(msg){
					if(msg.code_error==0){
						//alert(msg.code_msg);走了下面然后页面排序出问题
						$.ajax({
							'url':"<?php echo U('House/control_show_ajax');?>",
							'data':{},
							'type':'POST',
							'dataType':'JSON',
							'success':function(msg){
								//alert(msg.code_msg);
								$('.control_result').text('');
								if(msg.code_msg){
									var list_content="";
									for(var i in msg.code_msg){
										//alert(msg.code_msg[i].range);
										list_content+='<div class="zt">'+msg.code_msg[i].beforparent+'</div>';
										list_content+='<div class="zttt">'+msg.code_msg[i].range+'</div><div style="clear:both"></div>';
										list_content+='<div class="shtx_dkt">';
										for(var j in msg.code_msg[i].beforchild){
											list_content+='<input type="hidden" name="controlNum" value="" id="controlNum">';
											list_content+='<div class="shtx_dk">';
											//alert(msg.code_msg[i].beforchild[j].afterchild.length);
											var after_child=msg.code_msg[i].beforchild[j].afterchild;
											for(var k=0;k<after_child.length;k++){
												list_content+='<div class="shtx_xmt">';
												list_content+='<div class="gre"><span style="color:#aaaaaa; font-size:14px;">['+msg.code_msg[i].beforchild[j].afterparent+']</span> <span style="font-size:16px; color:#000000;">'+after_child[k].ac_name+'</span></div>';
												list_content+='<div class="gre2x">';
												list_content+='<div class="bd spacing"><a href="javascript:;" id="showDialog2"><input class="weui_switch" type="checkbox" data_acval="'+after_child[k].ac_id+'" data_nodeid="'+after_child[k].nodeid+'" data_sensorid="'+after_child[k].sensorid+'" data_village="'+after_child[k].village_id+'"/></a></div>';
												list_content+='</div><div class="both"></div></div>';
											}
											list_content+='</div>';
										}
										list_content+='</div>';
									}    									
								}
								$('.control_result').append(list_content);	
								weuiSwitch();
							}
						})
					}else{
						//alert(msg.code_msg);
						//window.location.reload();
					}			
				},
				//'error':function(){
					//alert('loading error!');
				//}
			})
		},
		fail:function(res){		//地理位置获取失败
			//alert('地理位置获取失败');
		},
		cancel:function(){
			//alert('用户拒绝授权获取地理位置');
		}		
	});	
})
</script>

<body>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" onClick="window.location.href =window.location.href;">
    <div class="modal-body">
 		<img src="<?php echo ($static_path); ?>images/kill.png" width="100%" height="100%" />
	</div>
</div>
<header class="pageSliderHide"><div id="backBtn"></div>智能门禁</header>
<div class="control_result">
<?php if(is_array($control_result)): $k = 0; $__LIST__ = $control_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><div class="zt"><?php echo ($vo["beforparent"]); ?></div>
<div class="zttt"><?php echo ($vo["range"]); ?></div><div style="clear:both"></div>
	<div class="shtx_dkt">
	<?php if(is_array($vo["beforchild"])): $i = 0; $__LIST__ = $vo["beforchild"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><input type="hidden" name="controlNum" value="" id="controlNum">
	<div class="shtx_dk">
		<?php if(is_array($val["afterchild"])): $i = 0; $__LIST__ = $val["afterchild"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$child): $mod = ($i % 2 );++$i;?><div class="shtx_xmt">
				<div class="gre"><span style="color:#aaaaaa; font-size:14px;">[<?php echo ($val["afterparent"]); ?>]</span> <span style="font-size:16px; color:#000000;"><?php echo ($child["ac_name"]); ?></span></div>
				<div class="gre2x">
					<div class="bd spacing"><a href="javascript:;" id="showDialog2"><input class="weui_switch" type="checkbox" data_acval="<?php echo ($child["ac_id"]); ?>" data_nodeid="<?php echo ($child["nodeid"]); ?>" data_sensorid="<?php echo ($child["sensorid"]); ?>" data_village="<?php echo ($child["village_id"]); ?>"/></a></div>
				</div>
				<div class="both"></div>
			</div><?php endforeach; endif; else: echo "" ;endif; ?>
	</div><?php endforeach; endif; else: echo "" ;endif; ?>
</div><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
<div class="kdw"><a href="javascript:;" class="fee" data-toggle="modal" data-target="#myModal">帮TA开门</a></div>
<div class="kdw2"><a href="javascript:;" class="weui_btn weui_btn_warn eww">返 回</a></div>
<script src="<?php echo ($static_path); ?>js/zepto.min.js"></script>
</body>
<?php echo ($shareScript); ?>
</html>