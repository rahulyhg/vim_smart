<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.min.js"></script>
		<title>详情</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/group_edit.css"/>
		<style>
			.repair_pic img{max-width:100%;}
		</style>
	</head>
	<body>
		<table>
			
			<tr>
				<th width="15%">业主姓名</th>
				<td width="35%"><?php echo ($repair["name"]); ?></td>
				<th width="15%">业主编号</th>
				<td width="35%"><?php echo ($repair["usernum"]); ?></td>
			</tr>
			<tr>
				<th width="15%">上报时间</th>
				<td width="35%"><?php echo (date('Y-m-d H:i:s',$repair["time"])); ?></td>
				<th width="15%">上报地址</th>
				<td width="35%"><?php echo ($repair["address"]); ?></td>
			</tr>
			<tr>
				<th width="15%">联系方式</th>
				<td width="85%" colspan="3"><?php echo ($repair["phone"]); ?></td>
			</tr>
			<tr>
				<th width="15%">上报内容</th>
				<td width="85%" colspan="3"><?php echo ($repair["content"]); ?></td>
			</tr>
			<?php if(repair.pic): ?><tr>
					<th width="15%">上报图例</th>
					<td width="85%" colspan="3" class="repair_pic">
						<?php if(is_array($repair["pic"])): $i = 0; $__LIST__ = $repair["pic"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?><img src="<?php echo ($p); ?>"/><br/><?php endforeach; endif; else: echo "" ;endif; ?>
					</td>
				</tr><?php endif; ?>
		</table>
	</body>
</html>