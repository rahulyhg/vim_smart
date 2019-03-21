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
					<a href="<?php echo U('House/village');?>" >小区列表</a>
					<a href="<?php echo U('House/pay_order',array('village_id'=>$_GET['village_id']));?>" class="on">缴费列表</a>
				</ul>
			</div>
			<table class="search_table" width="100%">
				<tr>
					<td><input type="button" value="确认对账" class="button"></td>
				</tr>
			</table>
			<table class="search_table" width="100%">
				<tr>
					<td>
						<form action="<?php echo U('House/pay_order');?>" method="get">
							<input type="hidden" name="c" value="House"/>
							<input type="hidden" name="a" value="pay_order"/>
							筛选: <input type="text" name="keyword" class="input-text" value="<?php echo ($_GET['keyword']); ?>"/>
							<select name="searchtype">
								<option value="phone" <?php if($_GET['searchtype'] == 'phone'): ?>selected="selected"<?php endif; ?>>联系电话</option>
								<option value="order_name" <?php if($_GET['searchtype'] == 'order_name'): ?>selected="selected"<?php endif; ?>>支付种类</option>								
							</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							支付状态: <select name="searchstatus">
								<option value="1" <?php if($_GET['searchstatus'] == '1'): ?>selected="selected"<?php endif; ?>>已对账</option>
								<option value="0" <?php if($_GET['searchstatus'] == 0): ?>selected="selected"<?php endif; ?>>未对账</option>
							</select>
							<input type="hidden" name="village_id" value="<?php echo ($_GET['village_id']); ?>">
							<input type="submit" value="查询" class="button"/>
						</form>
					</td>
				</tr>
			</table>
			<form name="myform" id="myform" action="<?php echo U('House/companypay');?>" method="post" onsubmit="return sumbit_sure()">
				<input type="hidden" id="com_pay_money"name="money" value="">
				<input type="hidden" name="village_id" value="<?php echo ($village_id); ?>">
				<div class="table-list">
					<table width="100%" cellspacing="0">
						<colgroup>
							<col/>
							<col/>
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
                                	<th width="5%"><input id="all_select" type="checkbox"></th>
                                    <th width="5%">缴费项</th>
                                    <th width="5%">已缴金额</th>
                                    <th width="10%">支付时间</th>
                                    <th width="10%">业主名</th>
                                    <th width="10%">联系方式</th>
                                    <th width="10%">住址</th>
                                    <th width="5%">编号</th>
                                    <th width="10%">对账状态</th>
                                </tr>
						</thead>
						<tbody>
							<?php if(is_array($order_list)): if(is_array($order_list['order_list'])): $i = 0; $__LIST__ = $order_list['order_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="<?php if($i%2 == 0): ?>odd<?php else: ?>even<?php endif; ?>">
                                        	<td><?php if($vo['is_pay_bill'] == 0): ?><input type="checkbox" name="orderid[]" value="<?php echo ($vo["order_id"]); ?>" class="select" data-price="<?php echo ($vo["money"]); ?>"/><?php endif; ?></td>
                                            <td><?php echo ($vo["order_name"]); ?></td>
                                            <td><?php echo ($vo["money"]); ?></td>
                                            <td><?php echo (date('Y-m-d H:i:s',$vo["time"])); ?></td>
                                            <td><?php echo ($vo["username"]); ?></td>
                                            <td><?php echo ($vo["phone"]); ?></td>
                                            <td><?php echo ($vo["address"]); ?></td>
                                            <td><?php echo ($vo["usernum"]); ?></td>
                                            <td><?php if($vo['is_pay_bill'] == 0): ?><strong style="color: red">未对账</strong><?php else: ?><strong style="color: green"><strong type="color:green">已对账</strong><?php endif; ?></td>
                                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                    <tr class="even">
										<td colspan="16">
											本页总金额：<strong style="color: green"><?php echo ($total); ?></strong>　本页已出账金额：<strong style="color: red"><?php echo ($finshtotal); ?></strong><br/> 
											总金额：<strong style="color: green"><?php echo ($order_list["totalMoney"]["totalMoney"]); ?></strong>　总已出账金额：<strong style="color: red"><?php echo ($order_list["readyMoney"]["readyMoney"]); ?></strong><br/>
										</td>
									</tr>
                                    <tr class="odd">
										<td colspan="16" id="show_count"></td>
									</tr>
									<tr><td class="textcenter pagebar" colspan="9"><?php echo ($order_list["pagebar"]); ?></td></tr>	
							<?php else: ?>
								<tr><td class="textcenter red" colspan="9">列表为空！</td></tr><?php endif; ?>
						</tbody>
					</table>
				</div>
			</form>
		</div>
<script type="text/javascript">
$(document).ready(function(){
	$('.select').attr('checked', false);

	$('#all_select').click(function(){
		if ($(this).attr('checked')){
			$('.select').attr('checked', true);
		} else {
			$('.select').attr('checked', false);
		}
		total_price();
	});
	$('.select').click(function(){total_price();});
	$('.button').click(function(){
		var strids = '';
		var pre = ''
		var village_id = $('#village_id').val();
		$('.select').each(function(){
			if ($(this).attr('checked')) {
				strids += pre + $(this).val();
				pre = ',';
			}
		});
		if (strids.length > 0) {
			$.post("<?php echo U('House/change');?>", {strids:strids,village_id:village_id}, function(data){
				if (data.error_code == 0) {
					location.reload();
				}
			}, 'json');
		}
	});
});
function sumbit_sure(){
	var gnl=confirm("确定要提交?");
	if (gnl==true){
		return true;
	}else{
		return false;
	}
}
function total_price()
{
	var total = 0;
	$('.select').each(function(){
		if ($(this).attr('checked')) {
			total += parseFloat($(this).attr('data-price'));
		}
	});
	total = Math.round(total * 100)/100;
	var percent = $('#percent').val();
	if (total > 0) {
		$('#show_count').html('账单总计金额：<strong style=\'color:red\'>￥' + total + '</strong><?php if($config['company_pay_open']): ?><input type="submit" class="button" value="确认对帐并在线提现"><?php endif; ?>');
		$('#com_pay_money').val(total * 100);
	} else {
		$('#show_count').html('');
	}
}
</script>
	</body>
</html>