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

	<body width="100%" <?php if($bg_color): ?>style="background:<?php echo ($bg_color); ?>;"<?php endif; ?>>		<div class="mainbox">			<div id="nav" class="mainnav_title">				<ul>					<a href="<?php echo U('Area/index');?>" <?php if($_GET['type'] == 1): ?>class="on"<?php endif; ?>>根列表</a>|					<?php if($_GET['type'] > 1): ?><a href="<?php echo U('Area/index',array('pid'=>$_GET['pid'],'type'=>$_GET['type']));?>" class="on"><?php echo ($now_type_str); ?>列表</a><?php endif; ?>					<a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('Area/add',array('pid'=>$_GET['pid'],'type'=>$_GET['type']));?>','添加<?php echo ($now_type_str); ?>',450,320,true,false,false,addbtn,'add',true);">添加<?php echo ($now_type_str); ?></a>				</ul>			</div>			<form name="myform" id="myform" action="" method="post">				<div class="table-list">					<table width="100%" cellspacing="0">						<colgroup>							<col/>							<col/>							<col/>							<?php if($_GET['type'] == 2 || $_GET['type'] == 4): ?><col/><?php endif; ?>							<col/>							<?php if($_GET['type'] > 1): ?><col/>								<?php if($_GET['type'] < 4): ?><col/><?php endif; endif; ?>							<?php if($_GET['type'] < 4): ?><col/><?php endif; ?>							<col width="240" align="center"/>						</colgroup>						<thead>							<tr>								<th>排序</th>								<th>编号</th>								<th>名称</th>								<?php if($_GET['type'] == 2 || $_GET['type'] == 4): ?><th>首字母</th><?php endif; ?>								<th>状态</th>								<?php if($_GET['type'] > 1): ?><th>网址标识</th>									<?php if($_GET['type'] < 4): ?><th>IP标识</th><?php endif; endif; ?>								<?php if($_GET['type'] < 4): ?><th>进入下级分类</th><?php endif; ?>								<th>操作</th>							</tr>						</thead>						<tbody>							<?php if(is_array($area_list)): if(is_array($area_list)): $i = 0; $__LIST__ = $area_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>										<td><?php echo ($vo["area_sort"]); ?></td>										<td><?php echo ($vo["area_id"]); ?></td>										<td><?php if($vo['is_hot']): ?><font color="red"><?php echo ($vo["area_name"]); ?></font><?php else: echo ($vo["area_name"]); endif; ?></td>										<?php if($_GET['type'] == 2 || $_GET['type'] == 4): ?><td><?php echo ($vo["first_pinyin"]); ?></td><?php endif; ?>										<td><?php if($vo['is_open']): ?><font color="green">显示</font><?php else: ?><font color="red">隐藏</font><?php endif; ?></td>										<?php if($_GET['type'] > 1): ?><td><?php echo ($vo["area_url"]); ?></td>											<?php if($_GET['type'] < 4): ?><td><?php echo ($vo["area_ip_desc"]); ?></td><?php endif; endif; ?>										<?php if($_GET['type'] < 4): ?><td><a href="<?php echo U('Area/index',array('type'=>$_GET['type']+1,'pid'=>$vo['area_id']));?>">进入下级</a></td><?php endif; ?>										<td>											<a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('Area/edit',array('area_id'=>$vo['area_id']));?>','编辑<?php echo ($now_type_str); ?>',450,320,true,false,false,editbtn,'add',true);">编辑</a> | 											<a href="javascript:void(0);" class="delete_row" parameter="area_id=<?php echo ($vo["area_id"]); ?>" url="<?php echo U('Area/del');?>">删除</a>											<?php if($_GET['type'] == 2): ?>| <a href="<?php echo U('Area/admin', array('area_id' => $vo['area_id']));?>">城市管理员</a>											<?php elseif($_GET['type'] == 3): ?>											 | <a href="<?php echo U('Area/admin', array('area_id' => $vo['area_id']));?>">区域管理员</a><?php endif; ?>										</td>									</tr><?php endforeach; endif; else: echo "" ;endif; ?>							<?php else: ?>								<tr><td class="textcenter red" colspan="8">列表为空！</td></tr><?php endif; ?>						</tbody>					</table>				</div>			</form>		</div>	</body>
</html>