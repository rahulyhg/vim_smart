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

	<body width="100%" <?php if($bg_color): ?>style="background:<?php echo ($bg_color); ?>;"<?php endif; ?>>
		<div class="mainbox">
			<div id="nav" class="mainnav_title">
				<ul>
					<a href="<?php echo U('Appoint/product_list');?>" class="on">预约列表</a>
				</ul>
			</div>
			<table class="search_table" width="100%">
				<tr>
					<td>
						<form action="<?php echo U('Appoint/product_list');?>" method="get">
							<input type="hidden" name="c" value="Appoint"/>
							<input type="hidden" name="a" value="product_list"/>
							筛选: <input type="text" name="keyword" class="input-text" value="<?php echo ($_GET['keyword']); ?>"/>
							<select name="searchtype">
								<option value="appoint_id" <?php if($_GET['searchtype'] == 'appoint_id'): ?>selected="selected"<?php endif; ?>>服务编号</option>
								<option value="appoint_name" <?php if($_GET['searchtype'] == 'appoint_name'): ?>selected="selected"<?php endif; ?>>服务名称</option>
							</select>
							<input type="submit" value="查询" class="button"/>
						</form>
					</td>
				</tr>
			</table>
			<form name="myform" id="myform" action="" method="post">
				<div class="table-list">
					<table width="100%" cellspacing="0">
						<colgroup>
							<col/>
							<col/>
							<col/>
							<col/>
							<col/>
							<col width="180" align="center"/>
						</colgroup>
						<thead>
							<tr>
								<th>编号</th>
								<th>服务名称</th>
								<th>价格</th>
								<th>预约数</th>
								<th>时间</th>
								<th>数字</th>
								<th>审核状态</th>
								<th>运行状态</th>
								<th>预约状态</th>
								<th class="textcenter">操作</th>
							</tr>
						</thead>
						<tbody>
							<?php if(is_array($appoint_list)): if(is_array($appoint_list)): $i = 0; $__LIST__ = $appoint_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
										<td><?php echo ($vo["appoint_id"]); ?></td>
										<td><?php echo ($vo["appoint_name"]); ?></td>
										<td>
											定金：￥ <?php echo ($vo["payment_money"]); ?><br/>
											全价：￥ <?php echo ($vo["appoint_price"]); ?>
										</td>
										<td>已预约：<?php echo ($vo["appoint_sum"]); ?></td>
										<td>
											开始时间：<?php echo (date("Y-m-d H:i:s",$vo["start_time"])); ?><br/>
											结束时间：<?php echo (date("Y-m-d H:i:s",$vo["end_time"])); ?><br/>
											添加时间：<?php echo (date("Y-m-d H:i:s",$vo["create_time"])); ?>
										</td>
										<td>
											点击数：<?php echo ($vo["hits"]); ?><br/>
											预约数：<?php echo ($vo["appoint_sum"]); ?>
										</td>
										<td>
											<?php if($vo['check_status'] == 0): ?><span style="color:red">待审核</span>
											<?php elseif($vo['check_status'] == 1): ?><span style="color:green">通过</span><?php endif; ?>
										</td>
										<td>
											<?php if($vo['start_time'] > $_SERVER['REQUEST_TIME']): ?>未开始
											<?php elseif($vo['end_time'] < $_SERVER['REQUEST_TIME']): ?>
												已结束
											<?php else: ?>
												进行中<?php endif; ?>
										</td>
										<td>
											<?php if($vo['appoint_status'] == 0): ?><span style="color:green">开启</span>
											<?php elseif($vo['appoint_status'] == 1): ?><span style="color:red">关闭</span><?php endif; ?>
										</td>
										<td class="textcenter">
											<a href="<?php echo U('Appoint/order_list', array('appoint_id'=>$vo['appoint_id']));?>" class="on">查看订单</a> |
									  		<a href="<?php echo U('Merchant/merchant_login',array('mer_id'=>$vo['mer_id'], 'appoint_id'=>$vo['appoint_id']));?>">编辑</a>
									  	</td>
									</tr><?php endforeach; endif; else: echo "" ;endif; ?>
								<tr><td class="textcenter pagebar" colspan="11"><?php echo ($pagebar); ?></td></tr>
							<?php else: ?>
								<tr><td class="textcenter red" colspan="11">列表为空！</td></tr><?php endif; ?>
						</tbody>
					</table>
				</div>
			</form>
		</div>
	</body>
</html>