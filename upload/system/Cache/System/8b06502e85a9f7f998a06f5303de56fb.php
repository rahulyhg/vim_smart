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

		<!--引用图表插件-->
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/echarts.js"></script>

	</head>

	<body width="100%" <?php if($bg_color): ?>style="background:<?php echo ($bg_color); ?>;"<?php endif; ?>>
<script>
	$(function(){
		$("#order").change(function(){
			$.ajax({
				type:"get",
				url:"<?php echo U('Access/openDoor');?>",
				data:{searchtype:$("#order").val()},
				success:function(res){
					$("#showState").show();
				}

			});
		});
		$("#seven").click(function(){
			$("#basicinfo").show();
			$("#saninfo").hide();
		});
		$("#san").click(function(){
			$("#basicinfo").hide();
			$("#saninfo").show();
		});

	});

</script>
<div class="mainbox">
    <div id="nav" class="mainnav_title">
        <ul>
            <a href="<?php echo U('Access/openDoor');?>" class="on">开门记录统计</a>
        </ul>
    </div>

	<div>
		今日到访人数：<?php echo ($log_list['access_one'][0][daynum]); ?>
	</div>
	<ul id="myTab">
		<li class="active">
			<span style="color:#ffffff;display:block;float:left;width:90px;height:24px;margin:10px;background-color:#5cb85c;text-align:center;line-height: 24px;cursor: pointer;" id="seven">
				七天统计
			</span>
		</li>
		<li>
			<span style="color:#ffffff;display:block;float:left;width:90px;height:24px;margin:10px;background-color:#5cb85c;text-align:center;line-height: 24px;cursor: pointer;" id="san">
				月度统计
			</span>
		</li>

	</ul>

	<div id="basicinfo" class="tab-pane" style="display:block;">
		<div>
			<div>
				<br/>
				<h3 style="margin: 35px">统计图</h3>
			</div>
			<div id="main" style="width:800px;height:400px;">
				<script type="text/javascript">
					// 基于准备好的dom，初始化echarts实例
					var myChart = echarts.init(document.getElementById('main'));

					// 指定图表的配置项和数据
					var option = {
						title: {
							text: '七天总使用数'
						},
						tooltip: {
							trigger: 'axis'
						},
						legend: {
							data:['使用门禁次数']
						},
						grid: {
							left: '3%',
							right: '4%',
							bottom: '3%',
							containLabel: true
						},
						toolbox: {
							feature: {
								saveAsImage: {}
							}
						},
						xAxis: {
							type: 'category',
							boundaryGap: false,
							data: [<?php echo ($edxmt); ?>]
						},
						yAxis: {
							type: 'value'
						},
						series: [
							{
								name:'总人数',
								type:'line',
								stack: '总量',
								data:[<?php echo ($edymt); ?>]
							}
						]
					};
					// 使用刚指定的配置项和数据显示图表。
					myChart.setOption(option);
				</script>
			</div>
		</div>
	</div>
	<div id="saninfo" class="tab-pane" style="display:none;">
		<div>
			<div>
				<br/>
				<h3 style="margin: 35px">统计图</h3>
			</div>
			<div id="san_main" style="width:1500px;height:400px;">
				<script type="text/javascript">
					// 基于准备好的dom，初始化echarts实例
					var san_myChart = echarts.init(document.getElementById('san_main'));

					// 指定图表的配置项和数据
					var san_option = {
						title: {
							text: '三十天总使用数'
						},
						tooltip: {
							trigger: 'axis'
						},
						legend: {
							data:['使用门禁次数']
						},
						grid: {
							left: '3%',
							right: '4%',
							bottom: '3%',
							containLabel: true
						},
						toolbox: {
							feature: {
								saveAsImage: {}
							}
						},
						xAxis: {
							type: 'category',
							boundaryGap: false,
							data: [<?php echo ($mdxmt); ?>]
						},
						yAxis: {
							type: 'value'
						},
						series: [
							{
								name:'总人数',
								type:'line',
								stack: '总量',
								data:[<?php echo ($mdymt); ?>]
							}
						]
					};
					// 使用刚指定的配置项和数据显示图表。
					san_myChart.setOption(san_option);
				</script>
			</div>
		</div>
	</div>
		<div class="row">
			<div class="col-xs-12">
				<div class="grid-view">

				</div>
			</div>
			<!--div class="col-xs-2" style="margin-top: 15px;">
                <a class="btn btn-success" href="#">导出成excel</a>
            </div-->
		</div>

	<div class="table-list">
		<table>
			<thead>
			<tr>
				<th>时间</th>
				<th>到访人数</th>
			</tr>
			</thead>
			<tbody>

			<tr>
				<td style="width: 120px">今天使用总数</td>
				<td style="width: 120px"><?php echo ($log_list['access_one'][0][daynum]); ?></td>
			</tr>
			<tr>
				<td style="width: 120px">七天内使用总数</td>
				<td style="width: 120px"><?php echo ($log_list['access_seven'][0][daynum]); ?></td>
			</tr>
			<tr>
				<td style="width: 120px">三十天内使用总数</td>
				<td style="width: 120px"><?php echo ($log_list['access_mom'][0][daynum]); ?></td>
			</tr>

			</tbody>
		</table>

		<table class="search_table" width="100%">
			<tr>
				<td>
					<form action="<?php echo U('Access/openDoor');?>" method="get">
						<input type="hidden" name="c" value="Access"/>
						<input type="hidden" name="a" value="openDoor"/>
						<select name="searchtype" id="order">
							<option selected="selected" value="0">请选择</option>
							<option value="name" id="orname" <?php if($_GET['searchtype'] == 'name'): ?>selected="selected"<?php endif; ?>>按用户名称排序</option>
							<option value="company" id="orcompany" <?php if($_GET['searchtype'] == 'company'): ?>selected="selected"<?php endif; ?>>按公司名称排序</option>
						</select>
						<select name="searchtime">
							<option selected="selected" value="0">请选择</option>
							<option value="yday"  <?php if($_GET['ssearchtime'] == 'yday'): ?>selected="selected"<?php endif; ?>>今天之内</option>
							<option value="zday"  <?php if($_GET['searchtime'] == 'zday'): ?>selected="selected"<?php endif; ?>>这个周之内</option>
							<option value="mday"  <?php if($_GET['searchtime'] == 'mday'): ?>selected="selected"<?php endif; ?>>最近三十天</option>
						</select>
						<!--<input type="text" name="keyword" class="input-text" value="<?php echo ($_GET['keyword']); ?>"  placeholder="请输入查询内容">-->
						<input type="submit" value="查询" class="button"/>
						<span id="showState" style="display:none">请选择时间</span>
					</form>
				</td>
			</tr>
		</table>
		<table width="100%" cellspacing="0">            
			<thead>
			<tr>
				<th>用户</th>
				<th>联系方式</th>
				<th>证件类型</th>
				<th>证件号</th>
				<th>所选时间内开门次数</th>
				<th>所属公司</th>

			</tr>
			</thead>
			<tbody>
			<?php if($log_list['access_list']): if(is_array($log_list['access_list'])): $i = 0; $__LIST__ = $log_list['access_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
					<td><?php echo ($vo["name"]); ?></td>
					<td><?php echo ($vo["phone"]); ?></td>
					<td><?php if($vo["card_type"] == 1): ?>现场审核<?php endif; if($vo["card_type"] == 2): ?>门禁卡<?php endif; if($vo["card_type"] == 3): ?>身份证<?php endif; if($vo["card_type"] == 4): ?>工作牌<?php endif; ?></td>
					<td><?php echo ($vo["usernum"]); ?></td>
					<td><?php echo ($vo["allnum"]); ?></td>
					<td><?php echo ($vo["company_name"]); ?></td>
					<!--<td class="textcenter"><a href="javascript:void(0);"  onclick="window.top.artiframe('<?php echo U('Access/operatLog_edit',array('log_id'=>$vo['log_id']));?>','查看详情',480,<?php if($vo['log_id']): ?>240<?php else: ?>340<?php endif; ?>,true,false,false,editbtn,'edit',true);">详情</a> | <a href="javascript:void(0);" class="delete_row" parameter="log_id=<?php echo ($vo["log_id"]); ?>" url="<?php echo U('Access/operatLog_del');?>">删除</a></td>-->
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
			<tr><td class="textcenter pagebar" colspan="10"><?php echo ($log_list['pagebar']); ?></td></tr>
			<?php else: ?>
			<tr><td class="textcenter red" colspan="10">没有查询到有人使用</td></tr><?php endif; ?>
			</tbody>
		</table>
	</div>
</div>

		</body>
</html>