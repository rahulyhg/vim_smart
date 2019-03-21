<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>我的帐户</title>
	<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
	<link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
	<link href="{pigcms{$static_path}css/eve.kid.css" rel="stylesheet"/>
	<style>
		#pg-account .text-icon {
			font-size: .44rem;
			color: #666;
			width: .44rem;
			text-align: center;
			margin-right: .1rem;
		}
		.avater {
			border-radius: 50%;
		}
		.rr:link{color:#ffffff; text-decoration:none;}
		.rr:visited{color:#ffffff; text-decoration:none;}
		.rr:active{color:#ffffff; text-decoration:none;}
		.rr:hover{color:#ffffff; text-decoration:underline;}
	</style>
</head>
<body>
<div class="info_bj_blue">
	<div class="info_tx"><img class="avater" src="<if condition="$now_user['avatar']">{pigcms{$now_user.avatar}<else/>{pigcms{$static_path}images/pic-default.png</if>" alt="{pigcms{$now_user.nickname}头像" style="max-width:100%; height: auto; display:inline;"/></div>
	<div class="info_tx2">{pigcms{$now_user.nickname}</div>
	<div class="info_tx3">余额:{pigcms{$now_user.app_money}元　积分:{pigcms{$now_user.score_count}分　</div>
</div>
<if condition="$_GET['OkMsg']">
	<div id="tips" class="tips tips-ok" style="display:block;">{pigcms{$_GET.OkMsg}</div>
	<else/>
	<div id="tips" class="tips"></div>
</if>

<div id="pg-account">
	<if condition="is_array($store_arr)">
		<div style="margin:0px auto;">
			<volist name="store_arr" id="vo">
				<div style="width:90%; margin:0px auto; height:56px; overflow:hidden; border-bottom:1px #e5e5e5 solid;">
					<div style="width:60%; float:left; height:56px; line-height:56px;">{pigcms{$vo['name']}</div>
					<div style="width:20%; float:left; height:56px; line-height:56px; margin-left:5%;">{pigcms{$vo['R_money']}元</div>
<!--					<a href="{pigcms{:U('My/recharge',array('mer_id'=>$vo['mer_id']))}"><div style="width:14%; height:29px; border-radius:4px; text-align:center; line-height:29px; float:right; margin-top:13px; background-color:#fb4746; color:#ffffff;">充值</div></a>-->
				</div>
			</volist>
		</div>
		<else/>
		没有商户开启充值
	</if>
</div>
<script src="{pigcms{:C('JQUERY_FILE')}"></script>
<script src="{pigcms{$static_path}js/common_wap.js"></script>
<include file="Public:footer"/>
{pigcms{$hideScript}
</body>
</html>