<?php if (!defined('THINK_PATH')) exit(); if(!defined('PigCms_VERSION')){ exit('deny access!');} ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8" />
	<title><?php echo ($now_village["village_name"]); ?></title>
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width"/>
	<meta name="apple-mobile-web-app-capable" content="yes"/>
	<meta name='apple-touch-fullscreen' content='yes'/>
	<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
	<meta name="format-detection" content="telephone=no"/>
	<meta name="format-detection" content="address=no"/>
	<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/common.css?210"/>
	<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/village.css?211"/>		
	<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/weui.css"/>		
	<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/example.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/style.css"/>
	<script type="text/javascript" src="<?php echo C('JQUERY_FILE_190');?>" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo ($static_path); ?>js/fastclick.js" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.cookie.js" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo ($static_path); ?>layer/layer.m.js" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo ($static_path); ?>js/common.js" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo ($static_path); ?>js/exif.js" charset="utf-8"></script>
	<!--<script type="text/javascript" src="<?php echo ($static_path); ?>js/imgUploadControl.js" charset="utf-8"></script>-->
	<script type="text/javascript" src="<?php echo ($static_path); ?>js/zepto.min.js" charset="utf-8"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"><style type="text/css">
</style></head>
<script type="text/javascript">
$(function(){	
	$('#backBtn').click(function(){
		window.history.go(-1);
	});
	
	$('.weui_btn_warn').click(function(){
		//alert($(this).attr('data_status'));
		var ac_status=$(this).attr('data_status');
		var id_val=$(this).attr('data_idVal');
		$.ajax({
			'url':"<?php echo U('House/village_access_checkInfo',array('village_id'=>$now_village['village_id']));?>",
			'data':{'ac_status':ac_status,'id_val':id_val},
			'type':'POST',
			'dataType':'JSON',
			'success':function(msg){
				alert('msg.code_msg');
			},
			'error':function(){
				alert('loading error');
			}
		})
	})
})
</script>
<body>
<header class="pageSliderHide"><div id="backBtn"></div>智能门禁</header>
<form id="access_form" onSubmit="return false;">
<div class="shtx_dkx">
	<div class="shtx_xm">
		<div class="shtx_pic"><img src="<?php echo ($static_path); ?>images/q1.jpg" style="width:12px; height:15px; margin-top:10px;"/></div>
		<div class="shtx_kk">刘德华</div>
		<div class="both"></div>
	</div>
	<div class="shtx_xm">
		<div class="shtx_pic"><img src="<?php echo ($static_path); ?>images/q2.jpg" style="width:12px; height:18px; margin-top:8px;"/></div>
		<div class="shtx_kk">18086681360</div>
		<div class="both"></div>
	</div>
</div>
<div class="shtx_dk2">
	<div class="shtx_xm">
		<div class="shtx_pic"><img src="<?php echo ($static_path); ?>images/q3.jpg" style="width:12px; height:16px; margin-top:8px;"/></div>
		<div class="shtx_kk">武汉微嗨科技有限公司
		</div>
		<div class="both"></div>
	</div>
	<div class="shtx_xm">
		<div class="shtx_pic"><img src="<?php echo ($static_path); ?>images/q4.jpg" style="width:12px; height:18px; margin-top:8px;"/></div>
		<div class="shtx_kk">技术部</div>
		<div class="both"></div>
	</div>
	<div class="shtx_xm">
		<div class="shtx_pic"><img src="<?php echo ($static_path); ?>images/q5.jpg" style="width:12px; height:15px; margin-top:9px;"/></div>
		<div class="shtx_kk">广发银行大厦2008</div>
		<div class="both"></div>
	</div>
	<div class="shtx_xm">
		<div class="shtx_pic"><img src="<?php echo ($static_path); ?>images/q6.jpg" style="width:12px; height:14px; margin-top:9px;"/></div>
		<div class="shtx_kk">9527</div>
		<div class="both"></div>
	</div>
</div>
<div class="weui_cells weui_cells_form">
	<div class="weui_cell">
		<div class="weui_cell_bd weui_cell_primary">
			<div class="weui_uploader">
				<div class="weui_uploader_hd weui_cell">
					<div class="weui_cell_bd weui_cell_primary">工牌（正面）</div>
				</div>
				<div class="upload_box"> 
					<ul class="upload_list clearfix" id="upload_list"> 
						<?php if($user_info['workcard_img']): $workcard_img=explode('|',$user_info['workcard_img']) ?>
						<?php if(is_array($workcard_img)): $k = 0; $__LIST__ = $workcard_img;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$img): $mod = ($k % 2 );++$k;?><li class="upload_item" id="imgShow<?php echo ($k); ?>" style="height:78px;background:url(./upload/house/<?php echo ($img); ?>) 50% 50% / cover;">
								<a href="javascript:void(0);" class="upload_delete" title="删除"></a>
								<img src="/upload/house/<?php echo ($img); ?>" class="upload_image loading_img" />
								<input type="hidden" name="inputimg[]" value="/upload/house/<?php echo ($img); ?>"><br>
							</li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
						<li class="upload_action">
							<img src="/tpl/Wap/default/static/classify/upimg.png"/>
							<input type="file" accept="image/jpg,image/jpeg,image/png,image/gif" id="fileImage" name=""/>
						</li> 
					</ul> 
				</div>
			</div>
		</div>
	</div>
</div>
<div class="zkd">
	<div style="float:left;width:48%;"><a href="javascript:;" class="weui_btn weui_btn_warn" data_status="2" data_idVal="<?php echo ($user_info["pigcms_id"]); ?>">通过审核</a></div>
	<div style="float:right;width:48%;"><a href="javascript:;" class="weui_btn weui_btn_warn" data_status="3" data_idVal="<?php echo ($user_info["pigcms_id"]); ?>">未通过审核</a></div>
	<div style="clear:both"></div>
</div>
</form>
</body>
</html>