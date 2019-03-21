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

		<script type="text/javascript" src="<?php echo C('JQUERY_FILE_190');?>" charset="utf-8"></script>

		<script type="text/javascript" src="<?php echo ($static_path); ?>js/iscroll.js?444" charset="utf-8"></script>

		<script type="text/javascript" src="<?php echo ($static_path); ?>js/fastclick.js" charset="utf-8"></script>

		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.cookie.js?210" charset="utf-8"></script>

		<script type="text/javascript" src="<?php echo ($static_path); ?>layer/layer.m.js" charset="utf-8"></script>

		<script type="text/javascript" src="<?php echo ($static_path); ?>js/common.js?210" charset="utf-8"></script>

		<script type="text/javascript">

			var pay_type = "<?php echo ($pay_type); ?>",pay_money = <?php echo ($pay_money); ?>;

		</script>

		<script type="text/javascript" src="<?php echo ($static_path); ?>js/village_pay.js?210" charset="utf-8"></script>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<style type="text/css">
<!--
.wdwe:link{color:#FFFFFF; text-decoration:none;}
.wdwe:visited{color:#FFFFFF; text-decoration:none;}
.wdwe:active{color:#FFFFFF; text-decoration:none;}
.wdwe:hover{color:#FFFFFF; text-decoration:none;}
-->
</style></head>

	<body>

		<header class="pageSliderHide"><div id="backBtn"></div><?php echo ($pay_name); ?></header>

		<div id="container">

			<div id="scroller">

				<div id="pullDown" style="background-color:#fb4746;color:white;">

					<span class="pullDownLabel" style="padding-left:0px;"><i class="yesLightIconx" style="margin-right:10px;vertical-align:middle;"></i><?php echo ($now_village["village_name"]); ?> 在线快捷缴费</span>

				</div>

				<section class="query-container">

					<div class="query_div <?php echo ($pay_type); ?>_ico"></div>

					<div class="area_tips"><?php echo ($now_user_info["address"]); ?></div>

					<?php if($pay_type == 'custom'): ?><div class="area_input" style="margin-top:15px;">

							<input type="text" class="recharge_txt" id="recharge_txt" placeholder="请填写缴费的事项"/>

							<span class="nametip">缴费事项</span>

						</div>

						<div class="area_input" style="margin-top:15px;">

							<input type="tel" class="recharge_txt" id="recharge_money" placeholder="缴纳的费用(元)"/>

							<span class="nametip">缴费金额</span>

						</div>

					<?php else: ?>

						<div class="area_input" style="margin-top:15px;">

							<input type="tel" class="recharge_txt" id="recharge_money" placeholder="您需缴纳的费用" value="￥<?php echo ($pay_money); ?>" readonly="readonly"/>

							<span class="nametip"></span>

						</div><?php endif; ?>

					<div style="width:88%; margin: 30px auto 0;"><a href="javascript:;" class="weui_btn weui_btn_primary wdwe" id="recharge_btn">缴费</a></div>

				</section>

				<?php if($order_list): ?><section class="villageBox newsBox query-list" style="width:90%;margin:30px auto 10px;">

						<div class="headBox">帐单列表<!--div class="right link-url" data-url="/wap.php?g=Wap&amp;c=House&amp;a=village_newslist&amp;village_id=1"></div--></div>

						<dl>

							<?php if(is_array($order_list)): $i = 0; $__LIST__ = $order_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dd>

									<div><?php echo ($vo["desc"]); ?></div>

									<span class="right"><?php echo ($vo["ydate"]); ?>年<?php echo ($vo["mdate"]); ?>月</span>

								</dd><?php endforeach; endif; else: echo "" ;endif; ?>

						</dl>

					</section><?php endif; ?>

				<div id="pullUp" style="bottom:-60px;">

					<img src="<?php echo ($config["site_logo"]); ?>" style="width:130px;height:40px;margin-top:10px"/>

				</div>

			</div>

		</div>

		<?php echo ($shareScript); ?>

		<script type="text/javascript" src="<?php echo ($static_path); ?>js/zepto.min.js" charset="utf-8"></script>

	</body>

</html>