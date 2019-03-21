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

	<body width="100%" <?php if($bg_color): ?>style="background:<?php echo ($bg_color); ?>;"<?php endif; ?>>		<div class="mainbox">			<div id="nav" class="mainnav_title">				<ul>					<a href="<?php echo U('Activity/index');?>">活动列表</a>|					<a href="<?php echo U('Activity/activity_list',array('id'=>$now_activity['activity_id']));?>" class="on"><?php echo ($now_activity["name"]); ?></a>				</ul>			</div>			<form name="myform" id="myform" action="" method="post">				<div class="table-list">					<table width="100%" cellspacing="0">						<colgroup>							<col/>							<col/>							<col/>							<col/>							<col/>							<col/>							<col/>							<col width="180" align="center"/>						</colgroup>						<thead>							<tr>								<th>编号</th>								<th>类别</th>								<th>名称</th>								<th>总商品数量</th>								<th>已参与数量</th>								<th>所需金钱</th>								<th>所需积分</th>								<th>首页排序</th>								<th>状态</th>								<th class="textcenter">操作</th>							</tr>						</thead>						<tbody>							<?php if(is_array($activity_list)): if(is_array($activity_list)): $i = 0; $__LIST__ = $activity_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>										<td><?php echo ($vo["pigcms_id"]); ?></td>										<td><?php echo ($vo["type_txt"]); ?></td>										<td title="<?php echo ($vo["title"]); ?>"><?php echo ($vo["name"]); ?></td>										<td><?php if($vo['type'] != 1): echo ($vo["all_count"]); else: ?>1<?php endif; ?></td>										<td><?php echo ($vo["part_count"]); ?></td>										<td><?php echo ($vo["money"]); ?></td>										<td><?php echo ($vo["mer_score"]); ?></td>										<td><?php echo ($vo["index_sort"]); ?></td>										<td><?php if($vo['is_finish'] == 1): ?><font color="green">已完成</font><?php elseif($vo['status'] == 0): ?><font color="red">待审核</font><?php elseif($vo['status'] == 2): ?><font color="red">已结束</font><?php else: ?><font color="green">进行中</font><?php endif; ?></td>										<td class="textcenter"><a href="<?php echo U('Merchant/merchant_login',array('mer_id'=>$vo['mer_id'],'activity_id'=>$vo['pigcms_id']));?>">编辑</a> <!--| <a href="javascript:void(0);" class="delete_row" parameter="id=<?php echo ($vo["pigcms_id"]); ?>" url="<?php echo U('Activity/activity_del');?>">删除</a--></td>									</tr><?php endforeach; endif; else: echo "" ;endif; ?>							<?php else: ?>								<tr><td class="textcenter red" colspan="8">列表为空！</td></tr><?php endif; ?>						</tbody>					</table>				</div>			</form>		</div>	</body>
</html>