<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
		<script type="text/javascript" src="{pigcms{$static_path}js/jquery.min.js"></script>
		<title>详情</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/group_edit.css"/>
		<style>
			.repair_pic img{max-width:100%;}
		</style>
	</head>
	<body>
		<table>
			
			<tr>
				<th width="15%">业主姓名</th>
				<td width="35%">{pigcms{$repair.name}</td>
				<th width="15%">业主编号</th>
				<td width="35%">{pigcms{$repair.usernum}</td>
			</tr>
			<tr>
				<th width="15%">上报时间</th>
				<td width="35%">{pigcms{$repair.time|date='Y-m-d H:i:s',###}</td>
				<th width="15%">上报地址</th>
				<td width="35%">{pigcms{$repair.address}</td>
			</tr>
			<tr>
				<th width="15%">联系方式</th>
				<td width="85%" colspan="3">{pigcms{$repair.phone}</td>
			</tr>
			<tr>
				<th width="15%">上报内容</th>
				<td width="85%" colspan="3">{pigcms{$repair.content}</td>
			</tr>
			<if condition="repair.pic">
				<tr>
					<th width="15%">上报图例</th>
					<td width="85%" colspan="3" class="repair_pic">
						<volist name="repair.pic" id="p">
							<img src="{pigcms{$p}"/><br/>
						</volist>
					</td>
				</tr>
			</if>
		</table>
	</body>
</html>