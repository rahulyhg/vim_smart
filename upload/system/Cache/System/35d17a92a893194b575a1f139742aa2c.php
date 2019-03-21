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
					<a href="<?php echo U('Systemnews/index');?>">平台快报</a>
					<a href="<?php echo U('Systemnews/news',array('category_id'=>$_GET['category_id']));?>" class="on">快报分类-<?php echo ($category_name); ?></a>|
					<a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('Systemnews/add_news',array('category_id'=>$_GET['category_id']));?>','添加平台快报',800,500,true,false,false,addbtn,'add',true);">添加平台快报</a>
				</ul>
			</div>
			
			<table class="search_table" width="100%">
				<tr>
					<td>
						<form action="<?php echo U('Systemnews/news');?>" method="get">
							<input type="hidden" name="c" value="Systemnews"/>
							<input type="hidden" name="a" value="news"/>
							筛选: <input type="text" name="keyword" class="input-text" value="<?php echo ($_GET['keyword']); ?>"/>
							<select name="searchtype">
								<option value="title" <?php if($_GET['searchtype'] == 'title'): ?>selected="selected"<?php endif; ?>>快报标题</option>
								<option value="id" <?php if($_GET['searchtype'] == 'id'): ?>selected="selected"<?php endif; ?>>快报ID</option>
							</select>
							<input type="submit" value="查询" class="button"/>
						</form>
					</td>
				</tr>
			</table>
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
							<col/>
							<col width="180" align="center"/>
						</colgroup>
						<thead>
							<tr>
								<th>编号</th>
								<th>标题</th>
								<th>添加时间</th>
								<th>最后修改时间</th>
								<th>排序</th>
								<th>状态</th>
								<th class="textcenter">操作</th>
							</tr>
						</thead>
						<tbody>
							<?php if(is_array($news_list)): if(is_array($news_list)): $i = 0; $__LIST__ = $news_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
										<td><?php echo ($vo["id"]); ?></td>
										<td><?php echo ($vo["title"]); ?></td>
										<td><?php echo (date('Y-m-d H:i:s',$vo["add_time"])); ?></td>
										<td><?php echo (date('Y-m-d H:i:s',$vo["last_time"])); ?></td>
										<td><?php echo ($vo["sort"]); ?></td>
										<td><?php if($vo['status'] == 1): ?><font color="green">启用</font><?php else: ?><font color="red">禁用</font><?php endif; ?></td>
										<td class="textcenter"><a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('Systemnews/edit_news',array('id'=>$vo['id'],'frame_show'=>true));?>','查看内容',1000,640,true,false,false,false,'add',true);">查看</a> | <a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('Systemnews/edit_news',array('id'=>$vo['id']));?>','编辑快报',800,500,true,false,false,editbtn,'edit',true);">编辑</a> | <a href="javascript:void(0);" class="delete_row" parameter="id=<?php echo ($vo["id"]); ?>" url="<?php echo U('Systemnews/del',array('id'=>$vo['id']));?>">删除</a></td>
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