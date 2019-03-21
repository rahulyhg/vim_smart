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
					<a href="<?php echo U('Systemnews/index');?>" class="on">平台快报</a>|
					<a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('Systemnews/add_category');?>','添加平台快报分类',800,460,true,false,false,addbtn,'add',true);">添加平台快报分类</a>
				</ul>
			</div>
			
			
			<!--<p>网站首页会显示最前面10条快报。置顶的快报会优先显示，并将悬浮在页面顶部。</p>-->
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
								<th>分类名称</th>
								<th>内容列表</th>
								<th>排序</th>
								<th>状态</th>
								<th class="textcenter">操作</th>
							</tr>
						</thead>
						<tbody>
							<?php if(is_array($category)): if(is_array($category)): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
										<td><?php echo ($vo["id"]); ?></td>
										<td><?php echo ($vo["name"]); ?></td>
										<td><a href="<?php echo U('Systemnews/news',array('category_id'=>$vo['id']));?>">查看内容</a></td>
										<td><?php echo ($vo["sort"]); ?></td>
										<td><?php if($vo['status'] == 1): ?><font color="green">启用</font><?php else: ?><font color="red">禁止</font><?php endif; ?></td>
										<td class="textcenter"><a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('Systemnews/edit_category',array('id'=>$vo['id']));?>','编辑快报',800,460,true,false,false,editbtn,'edit',true);">编辑</a> | <a href="javascript:void(0);" class="delete_row" parameter="category_id=<?php echo ($vo["id"]); ?>" url="<?php echo U('Systemnews/del',array('category_id'=>$vo['id']));?>">删除</a></td>
									</tr><?php endforeach; endif; else: echo "" ;endif; ?>
								<tr><td class="textcenter pagebar" colspan="9"><?php echo ($pagebar); ?></td></tr>
							<?php else: ?>
								<tr><td class="textcenter red" colspan="9">列表为空！</td></tr><?php endif; ?>
						</tbody>
					</table>
				</div>
			</form>
		</div>
	</body>
</html>