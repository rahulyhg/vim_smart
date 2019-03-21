<?php if (!defined('THINK_PATH')) exit();?><!--头部-->
<!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title><?php echo ($config["site_name"]); ?> - 商家中心</title>
	<meta name="format-detection" content="telephone=no, address=no">
	<meta name="apple-mobile-web-app-capable" content="yes" /> <!-- apple devices fullscreen -->
	<meta name="apple-touch-fullscreen" content="yes"/>
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<?php echo ($shareScript); ?>
	<link type="text/css" rel="stylesheet" href="<?php echo ($static_path); ?>css/jquery.mmenu.all.css" />
	<link href="<?php echo ($static_path); ?>css/style.css?ver=<?php echo time(); ?>" rel="stylesheet" >
	<link href="<?php echo ($static_path); ?>css/iconfont.css" rel="stylesheet">
	<script type="text/javascript" src="<?php echo C('JQUERY_FILE_190');?>" charset="utf-8"></script>	<script type="text/javascript" src="<?php echo ($static_path); ?>js/common.js?211" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.mmenu.min.all.js"></script>
	<script type="text/javascript" src="<?php echo ($static_path); ?>js/checkSubmit.js?ver=<?php echo time(); ?>"></script>	
	<script type="text/javascript">
		function onBridgeReady(){
		  //隐藏右上角菜单，需要显示请把hideOptionMenu换成showOptionMenu
		  WeixinJSBridge.call('hideOptionMenu');
		  //隐藏下方工具栏，需要显示顶部导航栏，请把hideToolbar换成showToolbar
		  WeixinJSBridge.call('hideToolbar');
		}
		if (typeof WeixinJSBridge == "undefined"){
			if( document.addEventListener ){
				document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
			}else if (document.attachEvent){
				document.attachEvent('WeixinJSBridgeReady', onBridgeReady); 
				document.attachEvent('onWeixinJSBridgeReady', onBridgeReady);
			}
		}else{
			onBridgeReady();
		}
	wx.ready(function(){
		wx.hideOptionMenu();
	});
</script>
	<script type="text/javascript">	
	if(navigator.appName == 'Microsoft Internet Explorer'){
		if(navigator.userAgent.indexOf("MSIE 5.0")>0 || navigator.userAgent.indexOf("MSIE 6.0")>0 || navigator.userAgent.indexOf("MSIE 7.0")>0) {
			alert('您使用的 IE 浏览器版本过低, 推荐使用 Chrome 浏览器或 IE8 及以上版本浏览器.');
		}
	}
	</script>
	<script>
	function _removeHTMLTag(str) {
		if(typeof str == 'string'){
			str = str.replace(/<script[^>]*?>[\s\S]*?<\/script>/g,'');
			str = str.replace(/<style[^>]*?>[\s\S]*?<\/style>/g,'');
			str = str.replace(/<\/?[^>]*>/g,'');
			str = str.replace(/\s+/g,'');
			str = str.replace(/&nbsp;/ig,'');
		}
		return str;
	}
	$(function() {
		//$(".pigcms-main").css('height', $(window).height()-50);
		$('div#slide_menu').mmenu();
		$(".pigcms-slide-footer").css('top', $(window).height()-180);
		$("#mm-0").css('height', $(window).height()-150);
		$('#pigcms-header-left').click(function(){
			setTimeout(function(){
				$("#shop-detail-container").css('width', $("#user-info").width()-95);
			},10);
		})
	});
	</script>
	<style>
		.has-msg:after{
			content: '0'!important;
		}
		.has-order:after{
			content: '0'!important;
		}
	</style>
</head>

<!--头部结束-->
    <link href="<?php echo ($static_path); ?>css/eve.7c92a906.css" rel="stylesheet"/>
    <link href="<?php echo ($static_path); ?>css/wap_pay_check.css" rel="stylesheet"/>
<style>
    .btn-wrapper {
        margin: .28rem .2rem;
    }
    .hotel-price {
        color: #ff8c00;
        font-size: 12px;
        display: block;
    }
    .dealcard .line-right {
        display: none;
    }
    .agreement li {
        display: inline-block;
        width: 50%;
        box-sizing: border-box;
        color: #666;
    }

    .agreement li:nth-child(2n) {
        padding-left: .14rem;
    }

    .agreement li:nth-child(1n) {
        padding-right: .14rem;
    }

    .agreement ul.agree li {
        height: .32rem;
        line-height: .32rem;
    }

    .agreement ul.btn-line li {
        vertical-align: middle;
        margin-top: .06rem;
        margin-bottom: 0;
    }

    .agreement .text-icon {
        margin-right: .14rem;
        vertical-align: top;
        height: 100%;
    }

    .agreement .agree .text-icon {
        font-size: .4rem;
        margin-right: .2rem;
    }


    #deal-details .detail-title {
        background-color: #F8F9FA;
        padding: .2rem;
        font-size: .3rem;
        color: #000;
        border-bottom: 1px solid #ccc;
    }

    #deal-details .detail-title p {
        text-align: center;
    }

    #deal-details .detail-group {
        font-size: .3rem;
        display: -webkit-box;
        display: -ms-flexbox;
    }

    .detail-group .left {
        -webkit-box-flex: 1;
        -ms-flex: 1;
        display: block;
        padding: .28rem 0;
        padding-right: .2rem;
    }

    .detail-group .right {
        display: -webkit-box;
        display: -ms-flexbox;
        -webkit-box-align: center;
        -ms-box-align: center;
        width: 1.2rem;
        padding: .28rem .2rem;
        border-left: 1px solid #ccc;
    }

    .detail-group .middle {
        display: -webkit-box;
        display: -ms-flexbox;
        -webkit-box-align: center;
        -ms-box-align: center;
        width: 1.7rem;
        padding: .28rem .2rem;
        border-left: 1px solid #ccc;
    }

    ul.ul {
        list-style-type: initial;
        padding-left: .4rem;
        margin: .2rem 0;
    }

    ul.ul li {
        font-size: .3rem;
        margin: .1rem 0;
        line-height: 1.5;
    }
    .coupons small{
        float: right;
        font-size: .28rem;
    }
    strong {
        color: #FDB338;
    }
    .coupons-code {
        color: #666;
        text-indent: .2rem;
    }
    .voice-info {
        font-size: .3rem;
        color: #eb8706;
    }
#pigcms-header-left {font-size: 30px;}
</style>
<body>
	<!--头部结束-->
	<header class="pigcms-header mm-slideout">
		<a href="/index.php?g=WapMerchant&c=Index&a=gorder" id="pigcms-header-left" class="iconfont icon-left">
		</a>			
		<p id="pigcms-header-title">订单详情</p>
		<!--<a id="pigcms-header-right">操作日志</a>-->
	</header>

<div style="padding: 0.2rem;margin-top:1rem;margin-bottom:1rem">		
			<dl class="list coupons">
				<dd style="overflow:visible;">
					<dl>
						<dd class="dd-padding coupons-code">
							订单编号： <span><?php echo ($now_order["order_id"]); ?></span>
						</dd>
						<dd class="dd-padding coupons-code">
							<?php echo ($config["group_alias_name"]); ?>商品： <span><a href="<?php echo U('Group/detail',array('group_id'=>$now_order['group_id']));?>" target="_blank"><?php echo ($now_order["s_name"]); ?></a></span>
						</dd>
						<dd class="dd-padding coupons-code">
							订单类型： <span><?php if($now_order['tuan_type'] == '0'): echo ($config["group_alias_name"]); ?>券<?php elseif($now_order['tuan_type'] == '1'): ?>代金券<?php else: ?>实物<?php endif; ?></span>
						</dd>
						<dd class="dd-padding coupons-code">
							订单状态： <span>
							<?php if($now_order['status'] == 3): ?><font color="red">已取消</font>
							<?php elseif($now_order['paid'] == '1'): ?>
								<?php if($now_order['third_id'] == '0' AND $now_order['pay_type'] == 'offline'): ?><font color="red">线下未付款</font>
								<?php elseif($now_order['status'] == '0'): ?>
									<font color="green">已付款</font>&nbsp;
									<if condition="$now_order['tuan_type'] neq '2'">
									<?php if($now_order['tuan_type'] != 2){ ?>
										<font color="red">未消费</font>
									<?php }else{ ?>
										<font color="red">未发货</font>
									<?php } ?>
								<?php elseif($now_order['status'] == '1'): ?>
									<?php if($now_order['tuan_type'] != 2){ ?>
										<font color="green">已消费</font>
									<?php }else{ ?>
										<font color="green">已发货</font>
									<?php } ?>&nbsp;
									<font color="red">待评价</font>
								<?php else: ?>
									<font color="green">已完成</font><?php endif; ?>
							<?php else: ?>
								<font color="red">未付款</font><?php endif; ?></span>
						</dd>
						<dd class="dd-padding coupons-code">
							数量： <span><?php echo ($now_order["num"]); ?></span>
						</dd>
						<dd class="dd-padding coupons-code">
							单价： <span><?php echo ($now_order["price"]); ?>元</span>
						</dd>
						<dd class="dd-padding coupons-code">
							下单时间： <span><?php echo (date('Y-m-d H:i',$now_order["add_time"])); ?></span>
						</dd>
						<dd class="dd-padding coupons-code">
							付款时间： <span><?php echo (date('Y-m-d H:i:s',$now_order["pay_time"])); ?></span>
						</dd>
						<?php if($now_order['status'] > 0 && $now_order['status'] < 3): ?><dd class="dd-padding coupons-code">
								<?php if($now_order['tuan_type'] != 2): ?>消费<?php else: ?>发货<?php endif; ?>时间： <span><?php echo (date('Y-m-d H:i:s',$now_order["use_time"])); ?></span>
							</dd>
						 <dd class="dd-padding coupons-code">操作店员：<?php echo ($now_order["last_staff"]); ?>
						</dd><?php endif; ?>
						<dd class="dd-padding coupons-code">
						支付方式：<span><?php echo ($now_order["paytypestr"]); ?></span>
					    </dd>
						<dd class="dd-padding coupons-code">
							买家留言： <span><?php echo ($now_order["delivery_comment"]); ?></span>
						</dd>
					</dl>
				</dd>
			</dl>
			<?php if($now_order['paid'] == '1'): ?><dl class="list coupons">
					<dd>
						<dl>
							<dt>用户信息</dt>
							<dd class="dd-padding coupons-code">
								用户ID： <span><?php echo ($now_order["uid"]); ?></span>
							</dd>
							<dd class="dd-padding coupons-code">
								用户名： <span><?php echo ($now_order["nickname"]); ?></span>
							</dd>
							<dd class="dd-padding coupons-code">
								订单手机号： <span><a href="tel:<?php echo ($now_order["phone"]); ?>" style="color:blue;"><?php echo ($now_order["phone"]); ?></a></span>
							</dd>
							<dd class="dd-padding coupons-code">
								用户手机号： <span><a href="tel:<?php echo ($now_order["user_phone"]); ?>" style="color:blue;"><?php echo ($now_order["user_phone"]); ?></a></span>
							</dd>
						</dl>
					</dd>
				</dl>
				<?php if($now_order['tuan_type'] == 2): ?><dl class="list">
					<dd>
						<dl>
							<dt>配送信息</dt>
							<dd class="dd-padding coupons-code">
								收货人：<span><?php echo ($now_order["contact_name"]); ?></span>
							</dd>
							<dd class="dd-padding coupons-code">
								联系电话：<span><?php echo ($now_order["phone"]); ?></span>
							</dd>
							<dd class="dd-padding coupons-code">
								配送要求：<span><?php switch($now_order['delivery_type']): case "1": ?>工作日、双休日与假日均可送货<?php break;?>
								<?php case "2": ?>只工作日送货<?php break;?>
								<?php case "3": ?>只双休日、假日送货<?php break;?>
								<?php case "4": ?>白天没人，其它时间送货<?php break; endswitch;?></span>
							</dd>
							<dd class="dd-padding coupons-code">
								邮编：<span><?php echo ($now_order["zipcode"]); ?></span>
							</dd>
							<dd class="dd-padding coupons-code">
								收货地址：<span><?php echo ($now_order["adress"]); ?></span>
							</dd>
					<?php if(empty($now_order['store_id'])){ ?>
							<dd class="dd-padding coupons-code">
							<p style="margin-left: -9px;margin-bottom: 10px;font-size: 15px;color: #333;">将订单归属于店铺：</p>
								<select id="order_store_id" style="border: 1px solid #ccc;width:60%;margin-left: 10px;padding-left: 5px;">
									<?php if(is_array($group_store_list)): $i = 0; $__LIST__ = $group_store_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["store_id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
								</select>
								&nbsp;&nbsp;&nbsp;
								<button id="store_id_btn" class="btn">修改</button>
								
						</dd>
					<?php } ?>
						</dl>
					</dd>
				</dl><?php endif; ?>
				<?php if($now_order['paid'] == '1'): ?><dl class="list coupons">
						<dd>
							<dl>
								<dt>额外信息</dt>
								<dd class="dd-padding coupons-code">
								 标记： <span><input type="text" class="input" id="merchant_remark" value="<?php echo ($now_order["merchant_remark"]); ?>" style="width:45%;height: 25px;border: 1px solid #eee;padding: 0px 0px 5px 10px;"/>&nbsp;&nbsp;<button id="merchant_remark_btn" class="btn">修改</button></span>
								</dd>
							</dl>
						</dd>
					</dl><?php endif; endif; ?>
		</div>
	</body>

		<script type="text/javascript">
			$(function(){
				<?php if($now_order['paid'] == 1 && $now_order['status'] == 0): ?>var fahuo=1;<?php else: ?>var fahuo=0;<?php endif; ?>
				$('#express_id_btn').click(function(){
					if(fahuo == 1){
						if(confirm("您确定要提交快递信息吗？提交后订单状态会修改为已发货。")){
							express_post();
						}
					}else{
						express_post();
					}
				});
				$('#merchant_remark_btn').click(function(){
					$(this).prop('disabled',true);
					$.post("<?php echo U('Index/group_remark',array('order_id'=>$now_order['order_id']));?>",{merchant_remark:$('#merchant_remark').val()},function(result){
						if(result.status == 0){						
							$('#merchant_remark_btn').prop('disabled',false);
							alert(result.info);
						}else{
							window.location.href = window.location.href;
						}
					});
				});
				$('#store_id_btn').click(function(){
					$(this).html('提交中...').prop('disabled',true);
					$.post("<?php echo U('Index/order_store_id',array('order_id'=>$now_order['order_id']));?>",{store_id:$('#order_store_id').val()},function(result){
						$('#store_id_btn').html('修改').prop('disabled',false);
						alert(result.info);
					});
				});

				function express_post(){
					$('#express_id_btn').prop('disabled',true);
					$.post("<?php echo U('Storestaff/group_express',array('order_id'=>$now_order['order_id']));?>",{express_type:$('#express_type').val(),express_id:$('#express_id').val()},function(result){
						if(result.status == 1){
							fahuo=0;
							window.location.href = window.location.href;
						}else{
							$('#express_id_btn').prop('disabled',false);
							alert(result.info);
						}
					});
				}
			});
		</script>
	<script type="text/javascript">
document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
	//隐藏右上角菜单，需要显示请把hideOptionMenu换成showOptionMenu
	WeixinJSBridge.call('hideOptionMenu');
	//隐藏下方工具栏，需要显示顶部导航栏，请把hideToolbar换成showToolbar
	WeixinJSBridge.call('hideToolbar');
});
</script>


</html>