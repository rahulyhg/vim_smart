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

		<!--引用图表插件-->
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/echarts.js"></script>

	</head>

	<body width="100%" <?php if($bg_color): ?>style="background:<?php echo ($bg_color); ?>;"<?php endif; ?>>
<div class="mainbox">
    <div id="nav" class="mainnav_title">
        <ul>
            <a href="<?php echo U('Access/operatLog');?>" class="on">开门记录列表</a>          
        </ul>
    </div>
	<div class="table-list">

		<table class="search_table" width="100%">
			<tr>
				<td>
					<form action="<?php echo U('Access/operatLog');?>" method="get">
						<input type="hidden" name="c" value="Access"/>
						<input type="hidden" name="a" value="operatLog"/>
						<select name="searchtype">
							<option selected="selected" value="0">请选择</option>
							<option value="name" <?php if($_GET['searchtype'] == 'name'): ?>selected="selected"<?php endif; ?>>用户名称</option>
							<option value="phone" <?php if($_GET['searchtype'] == 'phone'): ?>selected="selected"<?php endif; ?>>手机号</option>
						</select>
						<input type="text" name="keyword" class="input-text" value="<?php echo ($_GET['keyword']); ?>"  placeholder="请输入查询内容">
						开始时间：<input type="text" class="input" name="startDate"  placeholder="请输入起始时间" style="width:120px;" id="d4311" validate="required:true"  value="<?php echo ($_GET['startDate']); ?>" onfocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt:'yyyy-MM-dd HH:mm',maxDate:'#F{$dp.$D(\'d4312\')}'})"/>
						结束时间：<input type="text" class="input" name="endDate"  placeholder="请输入终止时间" style="width:120px;" id="d4312" validate="required:true"   value="<?php echo ($_GET['endDate']); ?>" onfocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt:'yyyy-MM-dd HH:mm',minDate:'#F{$dp.$D(\'d4311\')}'})"/>
						<input type="submit" value="查询" class="button"/>
					</form>
				</td>
			</tr>
		</table>
		<table width="100%" cellspacing="0">            
			<thead>
			<tr>
				<th>ID</th>
				<th>用户</th>
				<th>联系方式</th>
				<th>证件类型</th>
				<th>证件号</th>
				<th>设备名称</th>
				<th>所属区域</th>
				<th>所属社区</th>
				<th>所属公司</th>
				<th>时间</th>
				<th class="textcenter">操作</th>
			</tr>
			</thead>
			<tbody>
			<?php if($log_list['access_list']): if(is_array($log_list['access_list'])): $i = 0; $__LIST__ = $log_list['access_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
					<td><?php echo ($vo["log_id"]); ?></td>
					<td><?php echo ($vo["name"]); ?></td>
					<td><?php echo ($vo["phone"]); ?></td>
					<td><?php if($vo["card_type"] == 1): ?>现场审核<?php endif; if($vo["card_type"] == 2): ?>门禁卡<?php endif; if($vo["card_type"] == 3): ?>身份证<?php endif; if($vo["card_type"] == 4): ?>工作牌<?php endif; ?></td>
					<td><?php echo ($vo["usernum"]); ?></td>
					<td><?php echo ($vo["ac_name"]); ?></td>
					<td><?php echo ($vo["ag_name"]); ?></td>
					<td><?php echo ($vo["village_name"]); ?></td>
					<td><?php echo ($vo["company_name"]); ?></td>
					<td><?php echo (date('Y-m-d H:i:s',$vo["opdate"])); ?></td>
					<td class="textcenter"><a href="javascript:void(0);"  onclick="window.top.artiframe('<?php echo U('Access/operatLog_edit',array('log_id'=>$vo['log_id']));?>','查看详情',480,<?php if($vo['log_id']): ?>240<?php else: ?>340<?php endif; ?>,true,false,false,editbtn,'edit',true);">详情</a> | <a href="javascript:void(0);" class="delete_row" parameter="log_id=<?php echo ($vo["log_id"]); ?>" url="<?php echo U('Access/operatLog_del');?>">删除</a></td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
			<tr><td class="textcenter pagebar" colspan="10"><?php echo ($log_list['pagebar']); ?></td></tr>
			<?php else: ?>
			<tr><td class="textcenter red" colspan="10">列表为空！</td></tr><?php endif; ?>
			</tbody>
		</table>
	</div>
</div>
	</body>
</html>