<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>订单列表</title>
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
	        font-size: .6rem;
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
	    
	    
	    
	    .table {
		    width: 100%;
			border-bottom: 2px solid #d8d8d8;
		}
		.table li {
			width: 50%;
			float: left;
			text-align: center;
			height: 50px;
			line-height: 50px;
			font-size: 14px;
		}
		.table li a {
			color: #888888;
			display: block;
		}

		.table .specia a {
			color: #32acdd;
			border-bottom: 2px solid #32acdd;
		}
		dl.list {
			border-bottom: 1px solid #ddd8ce;
			margin-top: -1px;
			background-color: #fff;
		}
	</style>
</head>
<body>
        <div id="tips" class="tips"></div>
        <dl class="list">
		    <dd class="table">
				<ul >
					<li class="<?php if(intval($type) == 1): ?>specia<?php endif; ?>">
					<a href="<?php echo U('My/order_list', array('type' => 1));?>" ><?php echo ($config["group_alias_name"]); ?>订单</a>
					</li>
					<li class="<?php if(intval($type) == 2): ?>specia<?php endif; ?>">
					<a href="<?php echo U('My/order_list', array('type' => 2));?>"><?php echo ($config["meal_alias_name"]); ?>订单</a>
					</li>
				</ul>
			</dd>
		</dl>
		<?php if($order_list): if($type == 1): ?><div style="margin-top:.2rem;">
				    <dl class="list" id="orders">
				    	<dd>
				    		<dl>
				    			<?php if(is_array($order_list)): $i = 0; $__LIST__ = $order_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dd class="dealcard dd-padding" onclick="window.location.href = '<?php echo ($vo["order_url"]); ?>';">
							            <div class="dealcard-img imgbox">
							            	<img src="<?php echo ($vo["list_pic"]); ?>" style="width:100%;height:100%;"/>
							            </div>
					                    <div class="dealcard-block-right">
					                        <div class="dealcard-brand single-line"><?php echo ($vo["s_name"]); ?></div>
					                        <small>总价：<?php echo ($vo["total_money"]); ?> 元&nbsp;&nbsp;数量：<?php echo ($vo["num"]); ?></small>
					                        <weak>
					                        	<?php if(empty($vo['paid'])): ?><a class="btn btn-weak color-strong" href="<?php echo U('Pay/check',array('type'=>'group','order_id'=>$vo['order_id']));?>">付款</a>　
					                        		<a class="btn btn-weak color-gray" href="javascript:drop_confirm('你确定要取消订单吗？', '<?php echo U('My/group_order_del',array('order_id'=>$vo['order_id']));?>');">删除订单</a>
					                        	<?php elseif($vo['pay_type'] == 'offline' AND empty($vo['third_id'])): ?>
			                        				<a class="btn btn-weak color-gray">线下未付款</a>　
			                        				<!--a class="btn btn-weak color-gray" href="javascript:drop_confirm('你确定要取消订单吗？', '<?php echo U('My/group_order_refund',array('order_id'=>$vo['order_id']));?>');">取消订单</a-->
					                        	<?php elseif(empty($vo['status'])): ?>
					                        		<a class="btn btn-weak color-gray">未消费</a>　
					                        		<a class="btn btn-weak color-gray" href="javascript:drop_confirm('你确定要取消订单吗？', '<?php echo U('My/group_order_refund',array('order_id'=>$vo['order_id']));?>');">取消订单</a>
					                        	<?php elseif($vo['status'] == '1'): ?>
					                        		<a class="btn btn-weak" href="<?php echo U('My/group_feedback',array('order_id'=>$vo['order_id']));?>">去评价</a>
												<?php elseif($vo['status'] == '2'): ?>
					                        		<a class="btn btn-weak" href="<?php echo U('My/group_feedback',array('order_id'=>$vo['order_id']));?>">已完成</a><?php endif; ?>
					                        </weak>
					                    </div>
					                </dd><?php endforeach; endif; else: echo "" ;endif; ?>
						    </dl>
				    	</dd>
				    </dl>
				</div>
			<?php else: ?>
			    <div style="margin-top:.2rem;">
				    <dl class="list" id="orders">
				    	<dd>
				    		<dl>
				    			<?php if(is_array($order_list)): $i = 0; $__LIST__ = $order_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order): $mod = ($i % 2 );++$i; if($order['meal_type']): ?><dd class="dealcard dd-padding" onclick="window.location.href = '<?php echo U('Takeout/order_detail', array('mer_id' => $order['mer_id'], 'store_id' => $order['store_id'], 'order_id' => $order['order_id']));?>';">
							        <?php else: ?>
							        <dd class="dealcard dd-padding" onclick="window.location.href = '<?php echo U('Food/order_detail', array('mer_id' => $order['mer_id'], 'store_id' => $order['store_id'], 'order_id' => $order['order_id']));?>';"><?php endif; ?>
							            <div class="dealcard-img imgbox">
							            	<img src="<?php echo ($order["image"]); ?>" style="width:100%;height:100%;"/>
							            </div>
					                    <div class="dealcard-block-right">
					                        <div class="dealcard-brand single-line"><?php echo ($order['name']); ?></div>
					                        <small>订单号：<?php echo ($order['order_id']); ?></small>
					                        <br/>
					                        <small>总&nbsp;&nbsp;&nbsp;&nbsp;价：<?php echo ($order['price']); ?> 元&nbsp;&nbsp;数量：<?php echo ($order['total']); ?></small>　<small style="color: green"><?php if($order['meal_type']): ?>外卖<?php else: echo ($config["meal_alias_name"]); endif; ?></small>
					                        <weak>
					                        	<?php if(empty($order['paid'])): if($order['meal_type'] == 1): ?><a class="btn btn-weak color-strong" href="<?php echo U('Pay/check',array('order_id' => $order['order_id'], 'type'=>'takeout'));?>">付款</a>　
					                        		<a class="btn btn-weak color-gray" href="javascript:drop_confirm('你确定要取消订单吗？', '<?php echo U('Takeout/orderdel',array('mer_id' => $order['mer_id'], 'store_id' => $order['store_id'], 'orderid' => $order['order_id']));?>');">删除订单</a>
					                        		<?php else: ?>
					                        		<a class="btn btn-weak color-strong" href="<?php echo U('Pay/check',array('order_id' => $order['order_id'], 'type'=>'food'));?>">付款</a>　
					                        		<a class="btn btn-weak color-gray" href="javascript:drop_confirm('你确定要取消订单吗？', '<?php echo U('Food/orderdel',array('mer_id' => $order['mer_id'], 'store_id' => $order['store_id'], 'orderid' => $order['order_id']));?>');">删除订单</a><?php endif; ?>
					                        		
					                        	<?php elseif($order['pay_type'] == 'offline' AND empty($order['third_id'])): ?>
					                        		<a class="btn btn-weak color-gray">线下未付</a>
					                        	<?php elseif($order['status'] == '1'): ?>
					                        		<a class="btn btn-weak" href="<?php echo U('My/meal_feedback',array('order_id'=>$order['order_id']));?>">去评价</a>
					                        	<?php elseif($order['paid'] == 2): ?>
					                        		<a class="btn btn-weak color-strong" href="<?php echo U('Pay/check',array('order_id' => $order['order_id'], 'type'=>'food'));?>">付款</a>　
					                        		<a class="btn btn-weak color-gray" href="javascript:drop_confirm('你确定要取消订单吗？', '<?php echo U('My/meal_order_refund',array('mer_id' => $order['mer_id'], 'store_id' => $order['store_id'], 'orderid' => $order['order_id']));?>');">取消订单</a>
					                        	<?php elseif($order['paid'] == 1 AND $order['status'] == 0): ?>
					                        		<a class="btn btn-weak color-gray">未消费</a>　
					                        		<a class="btn btn-weak color-gray" href="javascript:drop_confirm('你确定要取消订单吗？', '<?php echo U('My/meal_order_refund',array('mer_id' => $order['mer_id'], 'store_id' => $order['store_id'], 'orderid' => $order['order_id']));?>');">取消订单</a>
					                        	<?php elseif($order['paid'] == 1 AND $order['status'] > 0): ?>
					                        		<a class="btn btn-weak color-gray">已消费</a><?php endif; ?>
					                        </weak>
					                    </div>
					                </dd><?php endforeach; endif; else: echo "" ;endif; ?>
						    </dl>
				    	</dd>
				    </dl>
				</div><?php endif; ?>
		<?php else: endif; ?>
<script type="text/javascript">
function drop_confirm(msg, url)
{
	if (confirm(msg)) {
		window.location.href = url;
	}
}
</script>

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
</body>
</html>