<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title><?php echo ($now_village["village_name"]); ?></title>
	<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
	<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/village.css?211"/>
	<link href="<?php echo ($static_path); ?>css/eve.7c92a906.css" rel="stylesheet"/>
	<script type="text/javascript" src="<?php echo C('JQUERY_FILE_190');?>" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo ($static_path); ?>js/village_my.js?210" charset="utf-8"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"><style type="text/css">
<!--
.gr {width:100%; height:100%; overflow:hidden; margin:0px auto; border-bottom:1px #e1e1e1 solid;}
.fre {width:100%; margin:20px auto;}
.fre2 {width:33%; float:left;}
.zdb {position:absolute; width:90%; text-align:center; line-height:40px; height:40px; bottom:0; margin-left:5%; font-size:14px;}
.cw {width:100%; height:40px; overflow:hidden; border-bottom:1px #e1e1e1 solid; background-color:#FFFFFF; margin-bottom:20px;}
-->
</style></head>
<body>
<header class="pageSliderHide"><div id="backBtn"></div>绑定社区</header>
<?php if($village_info): ?><div class="gr"><img src="<?php echo ($static_path); ?>images/tr4.jpg" width="100%"/></div>
<div class="cw">
	<div style="float:left; margin-left:3%; margin-top:11px; width:5%;"><img src="<?php echo ($static_path); ?>images/gtr.png" width="80%"/></div>
	<div style="float:left; font-size:14px; color:#999999; line-height:40px; margin-left:1%;">您有2条待处理事项</div>
	<div style="clear:both"></div>
</div>

	<!--<div class="fre2">
		<div style="width:100%; text-align:center;"><img src="<?php echo ($static_path); ?>images/fe1.png" width="35%"/></div>
		<div style="font-size:14px; text-align:center; width:100%; line-height:50px; color:#6b6b6b">我的待办</div>
	</div>-->
	
	<?php if(is_array($village_arr)): $i = 0; $__LIST__ = $village_arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo ($vo["url"]); ?>" style="color:#6b6b6b;">
		 	<div class="fre2">
		 		<div style="width:100%; text-align:center;"><img src="<?php echo ($vo["src"]); ?>" width="35%"/></div>
			 	<div style="font-size:14px; text-align:center; width:100%; line-height:50px; color:#6b6b6b"><?php echo ($vo["name"]); ?></div>
	 		</div>
		</a><?php endforeach; endif; else: echo "" ;endif; ?><!--2016.7.29陈琦 循环输出图形列表，根据微信用户所附带角色的权限显示相对应的图形-->
	<!--<a href="<?php echo U('House/village_control_check',array('village_id'=>$now_village['village_id']));?>" style="color:#6b6b6b;"><div class="fre2">
		<div style="width:100%; text-align:center;"><img src="<?php echo ($static_path); ?>images/fe2.png" width="35%"/></div>
		<div style="font-size:14px; text-align:center; width:100%; line-height:50px; color:#6b6b6b">门禁资料审核</div>
	</div></a>
	<a href="<?php echo U('House/village_user_openLog',array('village_id'=>$now_village['village_id']));?>" style="color:#6b6b6b;"><div class="fre2">
		<div style="width:100%; text-align:center;"><img src="<?php echo ($static_path); ?>images/fe3.png" width="35%"/></div>
		<div style="font-size:14px; text-align:center; width:100%; line-height:50px; color:#6b6b6b">访客出入记录</div>
	</div></a>
	
	<a href="<?php echo U('House/village_repair',array('village_id'=>$now_village['village_id']));?>"style="color:#6b6b6b;"><div class="fre2">
		<div style="width:100%; text-align:center;"><img src="<?php echo ($static_path); ?>images/fe4.png" width="35%"/></div>
		<div style="font-size:14px; text-align:center; width:100%; line-height:50px; color:#6b6b6b">在线报修管理</div>
	</div></a>
	
		<a href="<?php echo U('House/village_newsReply',array('village_id'=>$now_village['village_id']));?>"style="color:#6b6b6b;"><div class="fre2">
		<div style="width:100%; text-align:center;"><img src="<?php echo ($static_path); ?>images/fe5.png" width="35%"/></div>
		<div style="font-size:14px; text-align:center; width:100%; line-height:50px; color:#6b6b6b">新闻评论管理</div>
	</div></a>
	
		<a href="<?php echo U('House/village_suggest',array('village_id'=>$now_village['village_id']));?>"style="color:#6b6b6b;"><div class="fre2">
		<div style="width:100%; text-align:center;"><img src="<?php echo ($static_path); ?>images/fe6.png" width="35%"/></div>
		<div style="font-size:14px; text-align:center; width:100%; line-height:50px; color:#6b6b6b">投诉建议管理</div>
	</div></a>-->
	<div style="clear:both"></div>
</div>
<div class="zdb">客服电话：<a href="tel:027-87779655" style="color:#fb4746;">027-87779655</a></div>

<?php else: ?>
<div id="tips" class="tips"></div>
<form method="post" action="<?php echo U('House/village_my_bind',array('village_id'=>$now_village['village_id']));?>" id="form">
	<dl class="list">
		<dd>
			<dl>			
				<dd class="dd-padding"><input class="input-weak" placeholder="请输入社区账号" type="text" name="account" autocomplete="off"></dd>
				<dd class="dd-padding"><input class="input-weak" placeholder="请输入社区密码" type="password" name="pwd" autocomplete="off"></dd>
			</dl>
		</dd>
	</dl>
	<div class="btn-wrapper">
		<button type="submit" class="btn btn-block btn-larger">确认绑定</button>
	</div>
</form><?php endif; ?>

<script src="<?php echo C('JQUERY_FILE');?>"></script>
<script src="<?php echo ($static_path); ?>js/common_wap.js"></script>
<script>
	$(function(){
		$('#form').submit(function(){
			var account = $('input[name="account"]').val();	//账户
			var pwd = $('input[name="pwd"]').val();	//密码
			if(account=="" || account=="null"){
				$('#tips').html('请输入社区账户！').addClass('tips-err').show();
				return false;
			}else if(pwd=="" || pwd=="null"){
				$('#tips').html('请输入社区密码！').addClass('tips-err').show();
				return false;
			}else{
				return true;
			}
		});
	});
</script>
</body>
</html>