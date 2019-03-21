<?php if(!defined('PigCms_VERSION')){ exit('deny access!');} ?>

<!DOCTYPE html>

<html lang="zh-CN">

	<head>

		<meta charset="utf-8" />

		<title>{pigcms{$now_village.village_name}</title>

		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width"/>

		<meta name="apple-mobile-web-app-capable" content="yes"/>

		<meta name='apple-touch-fullscreen' content='yes'/>

		<meta name="apple-mobile-web-app-status-bar-style" content="black"/>

		<meta name="format-detection" content="telephone=no"/>

		<meta name="format-detection" content="address=no"/>

		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/common.css?210"/>

		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/village.css?211"/>
		
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/weui.css"/>
		
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/example.css"/>

		<script type="text/javascript" src="{pigcms{:C('JQUERY_FILE_190')}" charset="utf-8"></script>

		<script type="text/javascript" src="{pigcms{$static_path}js/iscroll.js?444" charset="utf-8"></script>

		<script type="text/javascript" src="{pigcms{$static_path}js/fastclick.js" charset="utf-8"></script>

		<script type="text/javascript" src="{pigcms{$static_public}js/jquery.cookie.js?210" charset="utf-8"></script>

		<script type="text/javascript" src="{pigcms{$static_path}layer/layer.m.js" charset="utf-8"></script>

		<script type="text/javascript" src="{pigcms{$static_path}js/common.js?210" charset="utf-8"></script>

		<script type="text/javascript">

			var pay_type = "{pigcms{$pay_type}",pay_money = {pigcms{$pay_money};

		</script>

		<script type="text/javascript" src="{pigcms{$static_path}js/village_pay.js?210" charset="utf-8"></script>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<style type="text/css">
<!--
.wdwe:link{color:#FFFFFF; text-decoration:none;}
.wdwe:visited{color:#FFFFFF; text-decoration:none;}
.wdwe:active{color:#FFFFFF; text-decoration:none;}
.wdwe:hover{color:#FFFFFF; text-decoration:none;}

.area_input {
    width: 84%;
    margin: 30px auto 0;
    height: 50px;
    line-height: 50px;
    background-color: white;
    border-radius: 5px;
    color: #888888;
    overflow: hidden;
    padding-left: 15px;
    position: relative;
    border: 1px #e2e2e2 solid;
}
.area_tips {
    width: 84%;
    margin: 15px auto 0;
    height: 50px;
    line-height: 50px;
    background-color: #ffffff;
    border-radius: 5px;
    padding-left: 15px;
    color: #888888;
    overflow: hidden;
    font-size: 1rem;
    border: 1px #e2e2e2 solid;
}
-->
</style></head>

	<body>

		<header class="pageSliderHide"><div id="backBtn"></div>{pigcms{$pay_name}</header>

		<div id="container">

			<div id="scroller">

				<div id="pullDown" style="background-color:#fb4746;color:white;">

					<span class="pullDownLabel" style="padding-left:0px;"><i class="yesLightIconx" style="margin-right:10px;vertical-align:middle;"></i>{pigcms{$now_village.village_name} 在线快捷缴费</span>

				</div>

				<section class="query-container">

					<div class="query_div {pigcms{$pay_type}_ico"></div>

					<div class="area_tips">{pigcms{$now_user_info.address}</div>

					<if condition="$pay_type eq 'custom'">

						<div class="area_input" style="margin-top:15px;">

							<input type="text" class="recharge_txt" id="recharge_txt" placeholder="请填写缴费的事项"/>

							<span class="nametip">缴费事项</span>

						</div>

						<div class="area_input" style="margin-top:15px;">

							<input type="tel" class="recharge_txt" id="recharge_money" placeholder="缴纳的费用(元)"/>

							<span class="nametip">缴费金额</span>

						</div>

					<else/>

						<div class="area_input" style="margin-top:15px;">

							<input type="tel" class="recharge_txt" id="recharge_money" placeholder="您需缴纳的费用" value="￥{pigcms{$pay_money}" readonly="readonly"/>

							<span class="nametip"></span>

						</div>

					</if>

					<div style="width:88%; margin: 30px auto 0;"><a href="javascript:;" class="weui_btn weui_btn_primary_blue wdwe" id="recharge_btn">缴费</a></div>

				</section>

				<if condition="$order_list">

					<section class="villageBox newsBox query-list" style="width:90%;margin:30px auto 10px;">

						<div class="headBox">帐单列表<!--div class="right link-url" data-url="/wap.php?g=Wap&amp;c=House&amp;a=village_newslist&amp;village_id=1"></div--></div>

						<dl>

							<volist name="order_list" id="vo">

								<dd>

									<div>{pigcms{$vo.desc}</div>

									<span class="right">{pigcms{$vo.ydate}年{pigcms{$vo.mdate}月</span>

								</dd>
  
							</volist>

						</dl>

					</section>

				</if>

				<div id="pullUp" style="bottom:-60px;">

					<img src="{pigcms{$config.site_logo}" style="width:130px;height:40px;margin-top:10px"/>

				</div>

			</div>

		</div>

		{pigcms{$shareScript}

		<script type="text/javascript" src="{pigcms{$static_path}js/zepto.min.js" charset="utf-8"></script>

	</body>

</html>