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

	<body width="100%" <?php if($bg_color): ?>style="background:<?php echo ($bg_color); ?>;"<?php endif; ?>>		<div class="mainbox">			<div id="nav" class="mainnav_title">				<ul>					<a href="<?php echo U('User/importlist');?>" class="on">导入用户列表</a>				</ul>			</div>			<!--<table class="search_table" width="100%">				<tr>					<td>						<form action="<?php echo U('User/index');?>" method="get">							<input type="hidden" name="c" value="User"/>							<input type="hidden" name="a" value="index"/>							筛选: <input type="text" name="keyword" class="input-text" value="<?php echo ($_GET['keyword']); ?>"/>							<select name="searchtype">								<option value="uid" <?php if($_GET['searchtype'] == 'uid'): ?>selected="selected"<?php endif; ?>>用户ID</option>								<option value="nickname" <?php if($_GET['searchtype'] == 'nickname'): ?>selected="selected"<?php endif; ?>>昵称</option>								<option value="phone" <?php if($_GET['searchtype'] == 'phone'): ?>selected="selected"<?php endif; ?>>手机号</option>							</select>							<input type="submit" value="查询" class="button"/>						</form>					</td>				</tr>			</table>-->			<form name="myform" id="myform" action="" method="post">				<div class="table-list">					<table width="100%" cellspacing="0">						<colgroup>							<col/>							<col/>							<col/>							<col/>							<col/>							<col/>							<col/>							<col width="180" align="center"/>						</colgroup>						<thead>							<tr>								<th>ID</th>								<th>姓名</th>								<th>手机号</th>								<th>通讯地址</th>								<th>商户ID</th>								<th>会员卡号</th>								<th>等级</th>								<th>QQ</th>								<th>Email</th>								<th>余额</th>								<th>积分</th>								<th>账号</th>								<th>操作</th>							</tr>						</thead>						<tbody>							<?php if(is_array($userimport)): if(is_array($userimport)): $i = 0; $__LIST__ = $userimport;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>										<td><?php echo ($vo["id"]); ?></td>										<td><?php echo ($vo["ppname"]); ?></td>										<td><?php echo ($vo["telphone"]); ?></td>										<td><?php echo str_replace('|',' ',$vo['address']); ?></td>										<td><?php echo ($vo["mer_id"]); ?></td>										<td><?php echo ($vo["memberid"]); ?></td>										<td><?php echo ($vo["level"]); ?></td>										<td><?php echo ($vo["qq"]); ?></td>										<td><?php echo ($vo["email"]); ?></td>										<td><?php echo ($vo["money"]); ?> 元</td>										<td><?php echo ($vo["integral"]); ?></td>										<td><?php echo ($vo["useraccount"]); ?></td>										<td class="textcenter"><a href="javascript:void(0);" class="delete_row" parameter="id=<?php echo ($vo["id"]); ?>" url="<?php echo U('User/delimportuser');?>">删除</a></td>									</tr><?php endforeach; endif; else: echo "" ;endif; ?>								<tr><td class="textcenter pagebar" colspan="13"><?php echo ($pagebar); ?></td></tr>							<?php else: ?>								<tr><td class="textcenter red" colspan="13">列表为空！</td></tr><?php endif; ?>						</tbody>					</table>				</div>			</form>		</div>	</body>
</html>