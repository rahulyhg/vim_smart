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

	<body width="100%" <?php if($bg_color): ?>style="background:<?php echo ($bg_color); ?>;"<?php endif; ?>>		<div class="mainbox">			<div id="nav" class="mainnav_title">				<ul>					<a href="<?php echo U('Group/order');?>" class="on">订单列表</a>				</ul>			</div>			<table class="search_table" width="100%">				<tr>					<td>						<form action="<?php echo U('Group/order');?>" method="get">							<input type="hidden" name="c" value="Group"/>							<input type="hidden" name="a" value="order"/>							筛选: <input type="text" name="keyword" class="input-text" value="<?php echo ($_GET['keyword']); ?>"/>							<select name="searchtype">								<option value="order_id" <?php if($_GET['searchtype'] == 'order_id'): ?>selected="selected"<?php endif; ?>>订单编号</option>								<option value="s_name" <?php if($_GET['searchtype'] == 's_name'): ?>selected="selected"<?php endif; ?>><?php echo ($config["group_alias_name"]); ?>名称</option>								<option value="name" <?php if($_GET['searchtype'] == 'name'): ?>selected="selected"<?php endif; ?>>客户名称</option>								<option value="phone" <?php if($_GET['searchtype'] == 'phone'): ?>selected="selected"<?php endif; ?>>客户电话</option>							</select>							<input type="submit" value="查询" class="button"/>						</form>					</td>				</tr>			</table>						<form name="myform" id="myform" action="" method="post">				<div class="table-list">					<style>					.table-list td{line-height:22px;padding-top:5px;padding-bottom:5px;}					</style>					<table width="100%" cellspacing="0">						<colgroup>							<col/>							<col/>							<col/>							<col/>							<col/>							<col/>							<col width="100" align="center"/>						</colgroup>						<thead>							<tr>								<th>订单编号</th>								<th>商家信息</th>								<th><?php echo ($config["group_alias_name"]); ?>信息</th>								<th>订单信息</th>								<th>订单用户</th>								<th>查看用户信息</th>								<th>订单状态</th>								<th>时间</th>								<th class="textcenter">操作</th>							</tr>						</thead>						<tbody>							<?php if(is_array($order_list)): if(is_array($order_list)): $i = 0; $__LIST__ = $order_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>										<td><?php echo ($vo["order_id"]); ?></td>										<td>商家ID：<?php echo ($vo["mer_id"]); ?>　商家电话：<?php echo ($vo["m_phone"]); ?><br/>商家名称：<?php echo ($vo["m_name"]); ?></td>										<td><?php echo ($config["group_alias_name"]); ?>ID：<?php echo ($vo["group_id"]); ?>　<?php echo ($config["group_alias_name"]); ?>价：￥<?php echo ($vo["g_price"]); ?><br/><?php echo ($config["group_alias_name"]); ?>名称：<?php echo ($vo["s_name"]); ?></td>										<td>数量：<?php echo ($vo["num"]); ?><br/>总价：￥<?php echo (floatval($vo["total_money"])); ?></td>										<td>用户名：<?php echo ($vo["nickname"]); ?><br/>订单手机号：<?php echo ($vo["group_phone"]); ?></td>										<td>											<a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('User/edit',array('uid'=>$vo['uid']));?>','编辑用户信息',680,560,true,false,false,editbtn,'edit',true);">查看用户信息</a>										</td>										<td>											<?php if($vo['status'] == 3): ?><font color="blue">已取消</font>											<?php elseif($vo['paid'] == 1): ?>												<?php if($vo['pay_type'] == 'offline' AND empty($vo['third_id'])): ?><font color="red">线下支付&nbsp;未付款</font>												<?php elseif($vo['status'] == 0): ?>													<font color="green">已付款</font>&nbsp;													<?php if($vo['tuan_type'] != 2){ ?>														<font color="red">未消费</font>													<?php }else{ ?>														<font color="red">未发货</font>													<?php } ?>												<?php elseif($vo['status'] == 1): ?>													<?php if($vo['tuan_type'] != 2){ ?>														<font color="green">已消费</font>													<?php }else{ ?>														<font color="green">已发货</font>													<?php } ?>&nbsp;													<font color="red">待评价</font>												<?php else: ?>													<font color="green">已完成</font><?php endif; ?>											<?php else: ?>												<font color="red">未付款</font><?php endif; ?>										</td>										<td>											下单时间：<?php echo (date('Y-m-d H:i:s',$vo['add_time'])); ?><br/>											<?php if($vo['paid']): ?>付款时间：<?php echo (date('Y-m-d H:i:s',$vo['pay_time'])); endif; ?>										</td>										<td class="textcenter"><a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('Group/order_edit',array('order_id'=>$vo['order_id']));?>','查看订单详情',600,460,true,false,false,false,'order_edit',true);">查看详情</a></td>									</tr><?php endforeach; endif; else: echo "" ;endif; ?>								<tr><td class="textcenter pagebar" colspan="11"><?php echo ($pagebar); ?></td></tr>							<?php else: ?>								<tr><td class="textcenter red" colspan="11">列表为空！</td></tr><?php endif; ?>						</tbody>					</table>				</div>			</form>		</div>	</body>
</html>