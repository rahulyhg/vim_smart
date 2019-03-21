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

	<body width="100%" <?php if($bg_color): ?>style="background:<?php echo ($bg_color); ?>;"<?php endif; ?>>		<div class="mainbox">			<div id="nav" class="mainnav_title">				<ul>					<a href="<?php echo U('User/levellist');?>" class="on">等级管理</a>					<a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('User/addlevel');?>','添加一个等级',650,500,true,false,false,addbtn,'add',true);" style="margin-left:20px;">添加等级</a>				</ul>			</div>			<!--<table class="search_table" width="100%">				<tr>					<td>						<form action="<?php echo U('User/index');?>" method="get">							<input type="hidden" name="c" value="User"/>							<input type="hidden" name="a" value="index"/>							筛选: <input type="text" name="keyword" class="input-text" value="<?php echo ($_GET['keyword']); ?>"/>							<select name="searchtype">								<option value="uid" <?php if($_GET['searchtype'] == 'uid'): ?>selected="selected"<?php endif; ?>>用户ID</option>								<option value="nickname" <?php if($_GET['searchtype'] == 'nickname'): ?>selected="selected"<?php endif; ?>>昵称</option>								<option value="phone" <?php if($_GET['searchtype'] == 'phone'): ?>selected="selected"<?php endif; ?>>手机号</option>							</select>							<input type="submit" value="查询" class="button"/>						</form>					</td>				</tr>			</table>-->			<form name="myform" id="myform" action="" method="post">				<div class="table-list">					<table width="100%" cellspacing="0">						<colgroup>							<col/>							<col/>							<col/>							<col/>							<col/>							<col width="180" align="center"/>						</colgroup>						<thead>							<tr>								<th width="50px">ID</th>								<th width="100px">等级名称</th>								<th width="50px">等级级别</th>								<th width="100px">等级图标</th>								<th width="200px">等级福利</th>								<th>操作</th>							</tr>						</thead>						<tbody>							<?php if(is_array($userlevel)): if(is_array($userlevel)): $i = 0; $__LIST__ = $userlevel;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>										<td><?php echo ($vo["id"]); ?></td>										<td><?php echo ($vo["lname"]); ?></td>										<td><?php echo ($vo["level"]); ?></td>										<td><img src="<?php echo ($config['site_url']); echo ($vo["icon"]); ?>" style="width:90px; height: 80px;"></td>										<td><?php if($vo['type'] == 1): ?>商品按原价<?php echo ($vo["boon"]); ?>%计算<?php elseif($vo['type'] == 2): ?>商品价格立减<?php echo ($vo["boon"]); ?>元<?php else: ?>无<?php endif; ?></td>										<td><a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('User/addlevel',array('lid'=>$vo['id']));?>','编辑等级信息',650,500,true,false,false,editbtn,'edit',true);">编 辑</a></td>									</tr><?php endforeach; endif; else: echo "" ;endif; ?>								<tr><td class="textcenter pagebar" colspan="6"><?php echo ($pagebar); ?></td></tr>							<?php else: ?>								<tr><td class="textcenter red" colspan="6">列表为空！</td></tr><?php endif; ?>						</tbody>					</table>				</div>			</form>		</div>	</body>
</html>