<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8"/>

	<title>店员中心</title>

    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">

	<meta name="apple-mobile-web-app-capable" content="yes">

	<meta name='apple-touch-fullscreen' content='yes'>

	<meta name="apple-mobile-web-app-status-bar-style" content="black">

	<meta name="format-detection" content="telephone=no">

	<meta name="format-detection" content="address=no">

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

</style>

</head>

<body id="index" data-com="pagecommon">

        <div id="tips" class="tips"></div>

        <div class="wrapper-list" style="padding-bottom: 10px;">

			<h4 style="margin-top:.3rem;"><?php echo ($now_order["s_name"]); ?> </h4><a class="btn" style="float:right;margin-right: 12px;margin-right: 15px;top:-.7rem;;position: relative;" href="<?php echo U('Storestaff/group_list');?>">返 回</a>

			

			<dl class="list coupons">

				<dd style="overflow:visible;">

					<dl>

						<dt style="overflow:visible;">订单详情</dt>

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

								<?php if($now_order['third_id'] == '0' AND $now_order['pay_type'] == 'offline' AND $now_order['status'] == '0'): ?><font color="red">线下未付款</font>

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

					    <?php if($now_order['third_id'] == '0' AND $now_order['pay_type'] == 'offline'): ?><dd class="dd-padding coupons-code">总金额： ￥<?php echo ($now_order['total_money']); ?> </dd>

							 <dd class="dd-padding coupons-code">平台余额支付 ：<?php echo ($now_order["balance_pay"]); ?>  </dd>

							 <dd class="dd-padding coupons-code">商家会员卡余额支付：<?php echo ($now_order["merchant_balance"]); ?> </dd>

							 <?php if($now_order['wx_cheap'] != '0.00'): ?><dd class="dd-padding coupons-code">	微信优惠 :￥<?php echo ($now_order['wx_cheap']); ?> </dd><?php endif; ?>

							 <dd class="dd-padding coupons-code">线下需向商家付金额：<font color="red">￥<?php echo ($now_order['total_money']-$now_order['wx_cheap']-$now_order['merchant_balance']-$now_order['balance_pay']); ?>元</font>

						<?php else: ?>

							 <dd class="dd-padding coupons-code">平台余额支付：<?php echo ($now_order["balance_pay"]); ?> </dd>

							 <dd class="dd-padding coupons-code">商家会员卡余额支付：<?php echo ($now_order["merchant_balance"]); ?> </dd>

							 <dd class="dd-padding coupons-code">在线支付金额：<?php echo ($now_order["payment_money"]); ?> </dd><?php endif; ?>

										

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

							<?php if($now_order['paid'] == 1): ?>

							<dd class="dd-padding coupons-code">

							<p style="margin-left: -9px;margin-bottom: 10px;font-size: 15px;color: #333;">快递信息：</p>

							<select id="express_type"><?php if(is_array($express_list)): $i = 0; $__LIST__ = $express_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?></select>&nbsp; <input type="text" class="input" id="express_id" value="<?php echo ($now_order["express_id"]); ?>" style="width:45%;height: 25px;"/> <button id="express_id_btn" class="btn">填写</button>

							</dd>

							<?php endif; ?>

						</dl>

					</dd>

				</dl><?php endif; ?>

				<?php if($now_order['paid'] == '1'): ?><dl class="list coupons">

						<dd>

							<dl>

								<dt>额外信息</dt>

								<dd class="dd-padding coupons-code">

								 标记： <span><input type="text" class="input" id="merchant_remark" value="<?php echo ($now_order["merchant_remark"]); ?>" style="width:45%;height: 25px;"/>&nbsp;&nbsp;<button id="merchant_remark_btn" class="btn">修改</button></span>

								</dd>

							</dl>

						</dd>

					</dl><?php endif; endif; ?>

		</div>

    	<script src="<?php echo C('JQUERY_FILE');?>"></script>

	    		<link href="<?php echo ($static_path); ?>css/footer.css" rel="stylesheet"/>		<style>			.footermenu ul{background-color:#404a54;}			.footermenu ul li a{color:#fff;}			.footermenu ul li a.active{background-color:#2A3138;}		</style>	    <footer class="footermenu">		    <ul>		        <li>		            <a <?php if(ACTION_NAME == 'group_list' OR ACTION_NAME == 'group_edit'): ?>class="active"<?php endif; ?> href="<?php echo U('Storestaff/group_list');?>">		            <img src="<?php echo ($static_path); ?>images/Lngjm86JQq.png"/>		            <p><?php echo ($config["group_alias_name"]); ?></p>		            </a>		        </li>		        <li>		            <a <?php if(ACTION_NAME == 'meal_list' OR ACTION_NAME == 'meal_edit'): ?>class="active"<?php endif; ?> href="<?php echo U('Storestaff/meal_list');?>">		            <img src="<?php echo ($static_path); ?>images/s22KaR0Wtc.png"/>		            <p><?php echo ($config["meal_alias_name"]); ?></p>		            </a>		        </li>				<li>		            <a <?php if(ACTION_NAME == 'appoint_list' OR ACTION_NAME == 'appoint_edit'): ?>class="active"<?php endif; ?> href="<?php echo U('Storestaff/appoint_list');?>">		            <img src="<?php echo ($static_path); ?>images/3YQLfzfuGx.png"/>		            <p>预约</p>		            </a>		        </li>				<li>		            <a id="qrcode_btn">						<img src="<?php echo ($static_path); ?>images/qrcode.png"/>						<p>扫一扫</p>		            </a>		        </li>		        <!--<li>		            <a href="javascript:;" onclick="LogOutSys()" <?php if(ACTION_NAME == 'logout'): ?>class="active"<?php endif; ?> >		            <img src="<?php echo ($static_path); ?>images/J0uZbXQWvJ.png"/>		            <p>退出</p>		            </a>		        </li>-->				<li>		            <a href="Cashier/merchants.php?m=Index&c=login&a=index&type=employee">		            <img src="<?php echo ($static_path); ?>images/J0uZbXQWvJ.png"/>		            <p>收银台</p>		            </a>		        </li>		    </ul>		<script type="text/javascript">		var logoutURl="<?php echo U('Storestaff/logout');?>"		function LogOutSys(){			if(confirm('您确认要退出系统吗？')){			    window.location.href=logoutURl;			}		}		</script>		</footer>		<div style="display:none;"><?php echo ($config["wap_site_footer"]); ?></div>        

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

					$.post("<?php echo U('Storestaff/group_remark',array('order_id'=>$now_order['order_id']));?>",{merchant_remark:$('#merchant_remark').val()},function(result){

						if(result.status == 0){						

							$('#merchant_remark_btn').prop('disabled',false);

							alert(result.info);

						}else{

							window.location.href = window.location.href;

						}

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

</body>

</html>