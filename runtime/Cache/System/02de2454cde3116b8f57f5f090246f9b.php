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
        <!--<link href="/Car/Admin/Public/assets/global/css/jquery.autocompleter.css" rel="stylesheet" type="text/css" />-->

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

	<body width="100%" <?php if($bg_color): ?>style="background:<?php echo ($bg_color); ?>;"<?php endif; ?>>		<div class="mainbox">			<div id="nav" class="mainnav_title">				<ul>					<a href="<?php echo U('House/village');?>" class="on">项目列表</a>					<a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('House/village_add');?>','添加小区',520,350,true,false,false,addbtn,'add',true);">添加项目</a>					<a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('House/village_import');?>','添加小区',450,150,true,false,false,importbtn,'add',true);">导入项目</a>					<a href="<?php echo U('Config/index',array('galias'=>'house','header'=>'House/header'));?>">项目配置</a>				</ul>			</div>			<!--table class="search_table" width="100%">				<tr>					<td>						<form action="<?php echo U('House/village');?>" method="get">							<input type="hidden" name="c" value="User"/>							<input type="hidden" name="a" value="village"/>							筛选: <input type="text" name="keyword" class="input-text" value="<?php echo ($_GET['keyword']); ?>"/>							<select name="searchtype">								<option value="uid" <?php if($_GET['searchtype'] == 'uid'): ?>selected="selected"<?php endif; ?>>用户ID</option>								<option value="nickname" <?php if($_GET['searchtype'] == 'nickname'): ?>selected="selected"<?php endif; ?>>昵称</option>								<option value="phone" <?php if($_GET['searchtype'] == 'phone'): ?>selected="selected"<?php endif; ?>>手机号</option>							</select>							<input type="submit" value="查询" class="button"/>						</form>					</td>				</tr>			</table-->			<form name="myform" id="myform" action="" method="post">				<div class="table-list">					<table width="100%" cellspacing="0">						<colgroup>							<col/>							<col/>							<col/>							<col/>							<col/>							<col/>							<col/>							<col/>							<col width="180" align="center"/>						</colgroup>						<thead>							<tr>								<th>ID</th>								<th>项目名称</th>								<th>物业名称</th>								<th>物业电话</th>								<th>最后登录时间</th>								<th>访问</th>								<th>账单</th>								<th class="textcenter">状态</th>								<th class="textcenter">操作</th>							</tr>						</thead>						<tbody>							<?php if(is_array($village_list)): if(is_array($village_list)): $i = 0; $__LIST__ = $village_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>										<td><?php echo ($vo["village_id"]); ?></td>										<td><?php echo ($vo["village_name"]); ?></td>										<td><?php echo ($vo["property_name"]); ?></td>										<td><?php echo ($vo["property_phone"]); ?></td>										<td><?php if($vo['last_time']): echo (date('Y-m-d H:i:s',$vo["last_time"])); else: ?>从未登录<?php endif; ?></td>										<td><a href="<?php echo U('House/village_login',array('village_id'=>$vo['village_id']));?>" target="_blank">访问</a></td>										<td><a href="<?php echo U('House/pay_order',array('village_id'=>$vo['village_id']));?>">查看账单</a></td>										<td class="textcenter"><?php if($vo['status'] == 1): ?><font color="green">正常</font><?php elseif($vo['status'] == 0): ?><font color="red" title="等待小区管理员登录社区后台完善信息">待完善信息</font><?php else: ?><font color="red">禁止</font><?php endif; ?></td>										<td class="textcenter"><a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('House/village_edit',array('village_id'=>$vo['village_id']));?>','编辑小区信息',520,370,true,false,false,editbtn,'edit',true);">编辑</a></td>									</tr><?php endforeach; endif; else: echo "" ;endif; ?>								<tr><td class="textcenter pagebar" colspan="9"><?php echo ($pagebar); ?></td></tr>							<?php else: ?>								<tr><td class="textcenter red" colspan="9">列表为空！</td></tr><?php endif; ?>						</tbody>					</table>				</div>			</form>		</div>	</body>
</html>