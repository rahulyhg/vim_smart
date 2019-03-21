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

	<body width="100%" <?php if($bg_color): ?>style="background:<?php echo ($bg_color); ?>;"<?php endif; ?>>		<div class="mainbox">			<div id="nav" class="mainnav_title">				<ul>					<?php if(empty($_GET['mer_id'])): ?><a href="<?php echo U('Group/product');?>" class="on">商品列表</a>					<?php else: ?>						<a href="<?php echo U('Group/product');?>">商品列表</a> |						<a href="<?php echo U('Group/product',array('mer_id'=>$_GET['mer_id']));?>" class="on">指定商家的商品列表</a><?php endif; ?>				</ul>			</div>			<table class="search_table" width="100%">				<tr>					<td>						<form action="<?php echo U('Group/product');?>" method="get">							<input type="hidden" name="c" value="Group"/>							<input type="hidden" name="a" value="product"/>							<input type="hidden" name="mer_id" value="<?php echo ($_GET["mer_id"]); ?>"/>							筛选: <input type="text" name="keyword" class="input-text" value="<?php echo ($_GET['keyword']); ?>"/>							<select name="searchtype">								<option value="group_id" <?php if($_GET['searchtype'] == 'group_id'): ?>selected="selected"<?php endif; ?>>商品编号</option>								<option value="s_name" <?php if($_GET['searchtype'] == 's_name'): ?>selected="selected"<?php endif; ?>>商品名称</option>								<option value="name" <?php if($_GET['searchtype'] == 'name'): ?>selected="selected"<?php endif; ?>>商品标题</option>							</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;							团购状态: <select name="searchstatus">								<option value="0" <?php if($_GET['searchstatus'] == 0): ?>selected="selected"<?php endif; ?>>全部</option>								<option value="1" <?php if($_GET['searchstatus'] == '1'): ?>selected="selected"<?php endif; ?>>进行状态</option>								<option value="2" <?php if($_GET['searchstatus'] == '2'): ?>selected="selected"<?php endif; ?>>关闭状态（或已结束）</option>							</select>							<input type="submit" value="查询" class="button"/>						</form>					</td>				</tr>			</table>			<form name="myform" id="myform" action="" method="post">				<div class="table-list">					<style>					.table-list td{line-height:22px;padding-top:5px;padding-bottom:5px;}					</style>					<table width="100%" cellspacing="0">						<colgroup>							<col/>							<col/>							<col/>							<col/>							<col/>							<col/>							<col/>							<col/>							<col/>							<col width="220" align="center"/>						</colgroup>						<thead>							<tr>								<th>编号</th>								<th>名称（悬浮查看商品标题）</th>								<th>价格</th>								<th>销售概览</th>								<th>时间</th>								<th>数字</th>								<th>查看二维码</th>								<th>运行状态</th>								<th><?php echo ($config["group_alias_name"]); ?>状态</th>								<th class="textcenter">操作</th>							</tr>						</thead>						<tbody>							<?php if(is_array($group_list)): if(is_array($group_list)): $i = 0; $__LIST__ = $group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>										<td><?php echo ($vo["group_id"]); ?></td>										<td><a href="<?php echo ($config["site_url"]); ?>/index.php?g=Group&c=Detail&group_id=<?php echo ($vo["group_id"]); ?>" target="_blank" title="<?php echo ($vo["name"]); ?>"><?php echo ($vo["s_name"]); ?></a></td>										<td><?php echo ($config["group_alias_name"]); ?>价：￥<?php echo ($vo["price"]); ?>元<br/>原价：￥<?php echo ($vo["old_price"]); ?>元</td>										<td>售出：<?php echo ($vo["sale_count"]); ?> 份<br/><!--库存： <?php if($vo['count_num']): echo ($vo["count_num"]); else: ?>无限制<?php endif; ?><br/>虚拟：<?php echo ($vo["virtual_num"]); ?> 人--></td>										<td>开始时间：<?php echo (date('Y-m-d H:i:s',$vo["begin_time"])); ?><br/>结束时间：<?php echo (date('Y-m-d H:i:s',$vo["end_time"])); ?><br/><?php echo ($config["group_alias_name"]); ?>券有效期：<?php echo (date('Y-m-d H:i:s',$vo["deadline_time"])); ?></td>										<td>查看数：<?php echo ($vo["hits"]); ?><br/>出售数：<?php echo ($vo["sale_count"]); ?><br/>评论数：<?php echo ($vo["reply_count"]); ?></td>										<td><a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo ($config["site_url"]); ?>/index.php?g=Index&c=Recognition&a=see_qrcode&type=group&id=<?php echo ($vo["group_id"]); ?>','查看二维码',430,433,true,false,false,null,'merchant_qrcode',true);" class="see_qrcode">查看二维码</a></td>										<td>											<?php if($vo['begin_time'] > $_SERVER['REQUEST_TIME']): ?>未开团											<?php elseif($vo['end_time'] < $_SERVER['REQUEST_TIME']): ?>												已结束											<?php else: ?>												进行中<?php endif; ?>										</td>										<td><?php switch($vo['status']): case "0": ?><font color="red">关闭</font><?php break; case "1": ?><font color="green">正常</font><?php break; case "2": ?><font color="red">审核中</font><?php break; endswitch;?></td>										<td class="textcenter"><a href="<?php echo U('Group/order_list',array('group_id'=>$vo['group_id']));?>">订单列表</a> | <a href="<?php echo U('Group/reply_list',array('group_id'=>$vo['group_id']));?>">评论列表</a> | <a href="<?php echo U('Merchant/merchant_login',array('mer_id'=>$vo['mer_id'],'group_id'=>$vo['group_id']));?>">编辑</a></td>									</tr><?php endforeach; endif; else: echo "" ;endif; ?>								<tr><td class="textcenter pagebar" colspan="11"><?php echo ($pagebar); ?></td></tr>							<?php else: ?>								<tr><td class="textcenter red" colspan="11">列表为空！</td></tr><?php endif; ?>						</tbody>					</table>				</div>			</form>		</div>	</body>
</html>