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

	<body width="100%" <?php if($bg_color): ?>style="background:<?php echo ($bg_color); ?>;"<?php endif; ?>>		<div class="mainbox">			<div id="nav" class="mainnav_title">				<ul>					<a href="<?php echo U('Area/index');?>" <?php if($_GET['type'] == 1): ?>class="on"<?php endif; ?>>根列表</a>|					<a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('Area/addadmin',array('area_id'=>$_GET['area_id']));?>','添加<?php echo ($title); ?>管理账号',450,320,true,false,false,addbtn,'add',true);">添加<?php echo ($title); ?>管理账号</a>				</ul>			</div>			<form name="myform" id="myform" action="" method="post">				<div class="table-list">					<table width="100%" cellspacing="0">						<colgroup>							<col/>							<col/>							<col/>							<col/>							<col/>							<col/>							<col/>							<col/>							<col/>						</colgroup>						<thead>							<tr>								<th>账号</th>								<th>真实姓名</th>								<th>电话</th>								<th>邮箱</th>								<th>QQ</th>								<th>最后登录时间</th>								<th>登录次数</th>								<th>状态</th>									<th>操作</th>							</tr>						</thead>						<tbody>							<?php if(is_array($admin)): if(is_array($admin)): $i = 0; $__LIST__ = $admin;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>										<td><?php echo ($vo["account"]); ?></td>										<td><?php echo ($vo["realname"]); ?></td>										<td><?php echo ($vo["phone"]); ?></td>										<td><?php echo ($vo["email"]); ?></td>										<td><?php echo ($vo["qq"]); ?></td>										<td><?php echo (date("Y-m-d H:i:s",$vo["last_time"])); ?></td>										<td><?php echo ($vo["login_count"]); ?></td>										<td><?php if($vo['status'] == 1): ?><span style="color:green">正常</span><?php else: ?><span style="color:red">关闭</span><?php endif; ?></td>										<td>											<a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('Area/addadmin',array('id'=>$vo['id'], 'area_id'=>$vo['area_id']));?>','编辑<?php echo ($title); ?>管理账号',450,320,true,false,false,editbtn,'add',true);">编辑</a> 										</td>									</tr><?php endforeach; endif; else: echo "" ;endif; ?>							<?php else: ?>								<tr><td class="textcenter red" colspan="8">列表为空！</td></tr><?php endif; ?>						</tbody>					</table>				</div>			</form>		</div>	</body>
</html>