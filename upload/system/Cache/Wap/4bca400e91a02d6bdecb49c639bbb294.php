<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>推广列表</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
    <link href="<?php echo ($static_path); ?>css/eve.7c92a906.css" rel="stylesheet"/>
    <style>
	    dl.list dd.dealcard {
	        overflow: visible;
	        -webkit-transition: -webkit-transform .2s;
	        position: relative;
	    }
	    .dealcard.orders-del {
	        -webkit-transform: translateX(1.05rem);
	    }
	    .dealcard-block-right {
	        height: 1.68rem;
	        position: relative;
	    }
	    .dealcard .dealcard-brand {
	        margin-bottom: .18rem;
	    }
	    .dealcard small {
	        font-size: .24rem;
	        color: #9E9E9E;
	    }
	    .dealcard weak {
	        font-size: .24rem;
	        color: #999;
	        position: absolute;
	        bottom: 0;
	        left: 0;
	        display: block;
	        width: 100%;
	    }
	    .dealcard weak b {
	        color: #FDB338;
	    }
	    .dealcard weak a.btn{
	        margin: -.15rem 0;
	    }
	    .dealcard weak b.dark {
	        color: #fa7251;
	    }
	    .hotel-price {
	        color: #ff8c00;
	        font-size: .24rem;
	        display: block;
	    }
	    .del-btn {
	        display: block;
	        width: .45rem;
	        height: .45rem;
	        text-align: center;
	        line-height: .45rem;
	        position: absolute;
	        left: -.85rem;
	        top: 50%;
	        background-color: #EC5330;
	        color: #fff;
	        -webkit-transform: translateY(-50%);
	        border-radius: 50%;
	        font-size: .4rem;
	    }
	    .no-order {
	        color: #D4D4D4;
	        text-align: center;
	        margin-top: 1rem;
	        margin-bottom: 2.5rem;
	    }
	    .icon-line {
	        font-size: 2rem;
	        margin-bottom: .2rem;
	    }
	    .orderindex li {
	        display: inline-block;
	        width: 25%;
	        text-align:center;
	        position: relative;
	    }
	    .orderindex li .react {
	        padding: .28rem 0;
	    }
	    .orderindex .text-icon {
	        display: block;
	        font-size: .4rem;
	        margin-bottom: .18rem;
	    }
	    .orderindex .amount-icon {
	        position: absolute;
	        left: 50%;
	        top: .16rem;
	        color: white;
	        background: #EC5330;
	        border-radius: 50%;
	        padding: .08rem .06rem;
	        min-width: .28rem;
	        font-size: .24rem;
	        margin-left: .1rem;
	        display: none;
	    }
	    .order-icon {
	        display: inline-block;
	        width: .5rem;
	        height: .5rem;
	        text-align: center;
	        line-height: .5rem;
	        border-radius: .06rem;
	        color: white;
	        margin-right: .25rem;
	        margin-top: -.06rem;
	        margin-bottom: -.06rem;
	        background-color: #F5716E;
	        vertical-align: initial;
	        font-size: .3rem;
	    }
	    .order-all {
	        background-color: #2bb2a3;
	    }
	    .order-zuo,.order-jiudian {
	        background-color: #F5716E;
	    }
	    .order-fav {
	        background-color: #0092DE;
	    }
	    .order-card {
	        background-color: #EB2C00;
	    }
	    .order-lottery {
	        background-color: #F5B345;
	    }
	    .color-gray{
	    	color:gray;
	    	border-color:gray;
	    }
	    .color-gray:active{
	    	background-color:gray;
	    }
	    .orderindex li .react.hover{
	    	color:#FF658E;
	    }
	</style>
</head>
<body id="index">
		<div id="tips" class="tips" style="display:block;">您只要将您挑选的商品分享给朋友，购买后您即可获得丰厚的佣金。</div>
        <dl class="list" style="margin-top:0px;">
		    <dd>
				<ul class="orderindex">
					<li><a href="<?php echo U('My/spread_list');?>" class="react <?php if(empty($_GET['status'])): ?>hover<?php endif; ?>">
						<i class="text-icon">⌺</i>
						<span>未结算</span>
					</a>
					</li><li><a href="<?php echo U('My/spread_list',array('status'=>-1));?>" class="react <?php if($_GET['status'] == '-1'): ?>hover<?php endif; ?>">
						<i class="text-icon">⌸</i>
						<span>全部</span>
					</a>
					</li><li><a href="<?php echo U('My/spread_list',array('status'=>1));?>" class="react <?php if($_GET['status'] == '1'): ?>hover<?php endif; ?>">
						<i class="text-icon">⌻</i>
						<span>已结算</span>
					</a>
					</li><li><a href="<?php echo U('My/spread_list',array('status'=>2));?>" class="react <?php if($_GET['status'] == '2'): ?>hover<?php endif; ?>">
						<i class="text-icon">⌹</i>
						<span>已退款</span>
					</a>
					</li>
				</ul>
			</dd>
		</dl>
	    <div style="margin-top:.2rem;">
		    <dl class="list" id="orders">
		    	<dd>
		    		<dl>
		    			<?php if(is_array($spread_list)): $i = 0; $__LIST__ = $spread_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dd class="dealcard dd-padding">
			                    <div class="dealcard-block-right" style="margin-left:0px;">
			                        <div class="dealcard-brand"><?php echo ($vo["desc"]["txt"]); ?> 《<a href="<?php echo ($vo["desc"]["url"]); ?>" target="_blank" style="color:#F76120;"><?php echo ($vo["desc"]["info"]); ?></a>》</div>
			                        <small>金额：<font style="color:#2bb8aa;"><?php echo ($vo["money"]); ?></font> 元&nbsp;&nbsp;时间：<?php echo (date('Y-m-d H:i:s',$vo["add_time"])); ?></small>
			                        <weak style="color:black;">
										<?php if($vo['status'] == 0): if($vo['order_info']['status'] == 0): ?>待消费
											<?php else: ?>
												<a class="btn btn-weak spread_check_btn" href="<?php echo U('My/spread_check',array('id'=>$vo['pigcms_id']));?>">验证</a><?php endif; ?>
										<?php elseif($vo['status'] == 1): ?>
											已结算
										<?php else: ?>
											订单已退款<?php endif; ?>
			                        </weak>
			                    </div>
			                </dd><?php endforeach; endif; else: echo "" ;endif; ?>
				    </dl>
		    	</dd>
		    </dl>
		</div>
    	<script src="<?php echo C('JQUERY_FILE');?>"></script>
		<script src="<?php echo ($static_path); ?>js/common_wap.js"></script>
				<link href="<?php echo ($static_path); ?>css/footer.css" rel="stylesheet"/>
		<?php if(empty($no_gotop)): ?><div style="height:10px"></div>
			<div class="top-btn"><a class="react"><i class="text-icon">⇧</i></a></div><?php endif; ?>
		<?php if(empty($no_footer)): ?><footer class="footermenu">
				<ul>
					<li>
						<a <?php if(MODULE_NAME == 'Home'): ?>class="active"<?php endif; ?> href="<?php echo U('Home/index');?>">
							<em class="home"></em>
							<p>首页</p>
						</a>
					</li>
					<li>
						<a <?php if(MODULE_NAME == 'Group'): ?>class="active"<?php endif; ?> href="<?php echo U('Group/index');?>">
							<em class="group"></em>
							<p><?php echo ($config["group_alias_name"]); ?></p>
						</a>
					</li>
					<li>
						<a <?php if(in_array(MODULE_NAME,array('Meal_list','Meal')) AND $store_type == 2): ?>class="active"<?php endif; ?> href="<?php echo U('Meal_list/index', array('store_type' => 2));?>">
							<em class="meal"></em>
							<p><?php echo ($config["meal_alias_name"]); ?></p>
						</a>
					</li>
					<li>
						<a <?php if(in_array(MODULE_NAME,array('My','Login'))): ?>class="active"<?php endif; ?> href="<?php echo U('My/index');?>">
							<em class="my"></em>
							<p>我的</p>
						</a>
					</li>
				</ul>
			</footer><?php endif; ?>
		<div style="display:none;"><?php echo ($config["wap_site_footer"]); ?></div>
        
<?php echo ($hideScript); ?>
<script>
		$(function(){
			if($('.spread_check_btn').size() > 0){
				checkSpread();
			}
		});
		function checkSpread(){
			var parentDom = $('.spread_check_btn').eq(0).parent();
			var postHref = $('.spread_check_btn').eq(0).attr('href');
			parentDom.html('<font color="red">自动验证中..</font>');
			$.post(postHref,function(result){
				parentDom.html(result.info);
				if($('.spread_check_btn').size() > 0){
					checkSpread();
				}else{
					alert('推广订单验证完成，已结算部分金额已自动进入平台余额。点击确定后即将刷新页面！');
					window.location.reload();
				}
			});
		}
	</script>
</body>
</html>