<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>

		<meta http-equiv="Content-Type" content="text/html; charset=<?php echo C('DEFAULT_CHARSET');?>" />

		<title>网站后台管理</title>

		<script type="text/javascript">

			if(self==top){window.top.location.href="<?php echo U('Index/index');?>";}

			var kind_editor=null,static_public="<?php echo ($static_public); ?>",static_path="<?php echo ($static_path); ?>",system_index="<?php echo U('Index/index');?>",choose_province="<?php echo U('Area/ajax_province');?>",choose_city="<?php echo U('Area/ajax_city');?>",choose_area="<?php echo U('Area/ajax_area');?>",choose_circle="<?php echo U('Area/ajax_circle');?>",choose_map="<?php echo U('Map/frame_map');?>",get_firstword="<?php echo U('Words/get_firstword');?>",frame_show=<?php if($_GET['frame_show']): ?>true<?php else: ?>false<?php endif; ?>;

 var  meal_alias_name = "<?php echo ($config["meal_alias_name"]); ?>";

		</script>

		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/style.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/employeeStyle.css" />

		<script type="text/javascript" src="<?php echo C('JQUERY_FILE');?>"></script> 

		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.form.js"></script>

		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.cookie.js"></script>

	    <script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.validate.js"></script><!--控制图片放大-->

		<script type="text/javascript" src="<?php echo ($static_public); ?>js/date/WdatePicker.js"></script>

		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.colorpicker.js"></script>

		<script type="text/javascript" src="<?php echo ($static_path); ?>js/common.js"></script>

	</head>

	<body width="100%" <?php if($bg_color): ?>style="background:<?php echo ($bg_color); ?>;"<?php endif; ?>>		<div class="mainbox">			<div id="nav" class="mainnav_title">				<ul>					<a href="<?php echo U('Meal/order');?>" class="on">订单列表</a>				</ul>			</div>			<table class="search_table" width="100%">				<tr>					<td>						<form action="<?php echo U('Meal/order');?>" method="get">							<input type="hidden" name="c" value="Meal"/>							<input type="hidden" name="a" value="order"/>							筛选: <input type="text" name="keyword" class="input-text" value="<?php echo ($_GET['keyword']); ?>"/>							<select name="searchtype">								<option value="order_id" <?php if($_GET['searchtype'] == 'order_id'): ?>selected="selected"<?php endif; ?>>订单编号</option>								<option value="s_name" <?php if($_GET['searchtype'] == 's_name'): ?>selected="selected"<?php endif; ?>>店铺名称</option>								<option value="name" <?php if($_GET['searchtype'] == 'name'): ?>selected="selected"<?php endif; ?>>客户名称</option>								<option value="phone" <?php if($_GET['searchtype'] == 'phone'): ?>selected="selected"<?php endif; ?>>客户电话</option>							</select>							<input type="submit" value="查询" class="button"/>						</form>					</td>				</tr>			</table>			<form name="myform" id="myform" action="" method="post">				<div class="table-list">					<table width="100%" cellspacing="0">						<colgroup>							<col/>							<col/>							<col/>							<col/>							<col/>							<col width="180" align="center"/>						</colgroup>						<thead>							<tr>								<th>编号</th>								<th>商家名称</th>								<th>店铺名称</th>								<th><?php echo ($config["meal_alias_name"]); ?>人</th>								<th>电话</th>								<th>下单时间</th>								<th>总价</th>								<th>优惠</th>								<th>状态</th>								<th>支付状态</th>								<th>支付方式</th>								<th class="textcenter">操作</th>							</tr>						</thead>						<tbody>							<?php if(is_array($order_list)): if(is_array($order_list)): $i = 0; $__LIST__ = $order_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>										<td><?php echo ($vo["order_id"]); ?></td>										<td><?php echo ($vo["merchant_name"]); ?></td>										<td><?php echo ($vo["store_name"]); ?></td>										<td><?php echo ($vo["name"]); ?></td>										<td><?php echo ($vo["phone"]); ?></td>										<td><?php echo (date("Y-m-d H:i:s",$vo["dateline"])); ?></td>										<td>￥<?php if($vo['total_price'] > 0): echo ($vo['total_price']); else: echo ($vo["price"]); endif; ?></td>										<td>￥<?php echo ($vo["minus_price"]); ?></td>										<td>										<?php if($vo['status'] == 0): ?><span style="color:red">未使用</span>										<?php elseif($vo['status'] == 1): ?><span style="color:green">已使用<strong>未评价</strong></span>										<?php elseif($vo['status'] == 2): ?><span style="color:green">已使用已评价</span>										<?php elseif($vo['status'] == 3): ?><span style="color:red"><del>订单被取消</del></span>										<?php elseif($vo['status'] == 4): ?><span style="color:red"><del>订单被取消</del></span><?php endif; ?>										</td>										<td>										<?php if($vo['paid'] == 0): ?><span style="color:red">未支付</span>										<?php elseif($vo['pay_type'] == 'offline' AND empty($vo['third_id'])): ?>										<span style="color:red">线下未支付</span>										<?php elseif($vo['paid'] == 2): ?>										<span style="color:green">已付￥<?php echo ($vo['pay_money']); ?></span>，<span style="color:red">未付￥<?php echo ($vo['price'] - $vo['pay_money']); ?></span>										<?php else: ?>										<span style="color:green">全额支付</span><?php endif; ?>										</td>																				<td>										<?php if($vo['pay_type'] == 'alipay'): ?><span style="color:green">支付宝</span>										<?php elseif($vo['pay_type'] == 'weixin'): ?>										<span style="color:green">微信支付</span>										<?php elseif($vo['pay_type'] == 'tenpay'): ?>										<span style="color:green">财付通[wap手机]</span>										<?php elseif($vo['pay_type'] == 'tenpaycomputer'): ?>										<span style="color:green">财付通[即时到帐]</span>										<?php elseif($vo['pay_type'] == 'yeepay'): ?>										<span style="color:green">易宝支付</span>										<?php elseif($vo['pay_type'] == 'allinpay'): ?>										<span style="color:green">通联支付</span>										<?php elseif($vo['pay_type'] == 'daofu'): ?>										<span style="color:green">货到付款</span>										<?php elseif($vo['pay_type'] == 'dianfu'): ?>										<span style="color:green">到店付款</span>										<?php elseif($vo['pay_type'] == 'chinabank'): ?>										<span style="color:green">网银在线</span>										<?php elseif($vo['pay_type'] == 'offline'): ?>										<span style="color:green">线下支付</span>										<?php elseif(empty($vo['pay_type']) AND $vo['paid'] == 1 AND $vo['balance_pay'] > 0): ?>										<span style="color:green">平台余额支付</span>										<?php else: ?>										<span style="color:green">暂未选择</span><?php endif; ?>										</td>										<td class="textcenter">											<a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('Meal/order_detail',array('order_id'=>$vo['order_id'],'frame_show'=>true));?>','查看<?php echo ($config["meal_alias_name"]); ?>详情',480,380,true,false,false,false,'detail',true);">查看</a>									  	</td>									</tr><?php endforeach; endif; else: echo "" ;endif; ?>								<tr><td class="textcenter pagebar" colspan="12"><?php echo ($pagebar); ?></td></tr>							<?php else: ?>								<tr><td class="textcenter red" colspan="12">列表为空！</td></tr><?php endif; ?>						</tbody>					</table>				</div>			</form>		</div>	</body>
</html>