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

	<body width="100%" <?php if($bg_color): ?>style="background:<?php echo ($bg_color); ?>;"<?php endif; ?>>		<div class="mainbox">			<div id="nav" class="mainnav_title">				<ul>					<a href="<?php echo U('Adver/index');?>">广告分类列表</a>|					<a href="<?php echo U('Adver/adver_list',array('cat_id'=>$now_category['cat_id']));?>" class="on"><?php echo ($now_category["cat_name"]); ?> - 广告列表</a>|					<a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('Adver/adver_add',array('cat_id'=>$now_category['cat_id']));?>','添加广告',510,256,true,false,false,addbtn,'add',true);">添加广告</a>				</ul>			</div>			<form name="myform" id="myform" action="" method="post">				<div class="table-list">					<table width="100%" cellspacing="0">						<colgroup>							<col/>							<col/>							<col/>							<col/>							<col width="180" align="center"/>							<col width="180" align="center"/>						</colgroup>						<thead>							<tr>								<th>编号</th>								<th>名称</th>								<th>链接地址</th>								<th>图片(以下为强制小图，点击图片查看大图)</th>								<th class="textcenter">最后操作时间</th>								<th class="textcenter">操作</th>							</tr>						</thead>						<tbody>							<?php if(is_array($adver_list)): if(is_array($adver_list)): $i = 0; $__LIST__ = $adver_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>										<td><?php echo ($vo["id"]); ?></td>										<td><?php echo ($vo["name"]); ?></td>										<td><a href="<?php echo ($vo["url"]); ?>" target="_blank">访问链接</a></td>										<td>											<img src="<?php echo ($config["site_url"]); ?>/upload/adver/<?php echo ($vo["pic"]); ?>" style="width:300px;height:80px;" class="view_msg"/>										</td>										<td class="textcenter"><?php echo (date('Y-m-d H:i:s',$vo["last_time"])); ?></td>										<td class="textcenter"><a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('Adver/adver_edit',array('id'=>$vo['id'],'frame_show'=>true));?>','查看广告信息',480,330,true,false,false,false,'add',true);">查看</a> | <a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('Adver/adver_edit',array('id'=>$vo['id']));?>','编辑广告信息',510,330,true,false,false,editbtn,'add',true);">编辑</a> | <a href="javascript:void(0);" class="delete_row" parameter="id=<?php echo ($vo["id"]); ?>" url="<?php echo U('Adver/adver_del');?>">删除</a></td>									</tr><?php endforeach; endif; else: echo "" ;endif; ?>							<?php else: ?>								<tr><td class="textcenter red" colspan="8">列表为空！</td></tr><?php endif; ?>						</tbody>					</table>				</div>			</form>		</div>	</body>
</html>