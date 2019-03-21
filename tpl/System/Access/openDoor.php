<include file="Public:header"/>
<script>
	$(function(){
		$("#order").change(function(){
			$.ajax({
				type:"get",
				url:"{pigcms{:U('Access/openDoor')}",
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
            <a href="{pigcms{:U('Access/openDoor')}" class="on">开门记录统计</a>
        </ul>
    </div>

	<div>
		今日到访人数：{pigcms{$log_list['access_one'][0][daynum]}
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
							data: [{pigcms{$edxmt}]
						},
						yAxis: {
							type: 'value'
						},
						series: [
							{
								name:'总人数',
								type:'line',
								stack: '总量',
								data:[{pigcms{$edymt}]
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
							data: [{pigcms{$mdxmt}]
						},
						yAxis: {
							type: 'value'
						},
						series: [
							{
								name:'总人数',
								type:'line',
								stack: '总量',
								data:[{pigcms{$mdymt}]
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
				<td style="width: 120px">{pigcms{$log_list['access_one'][0][daynum]}</td>
			</tr>
			<tr>
				<td style="width: 120px">七天内使用总数</td>
				<td style="width: 120px">{pigcms{$log_list['access_seven'][0][daynum]}</td>
			</tr>
			<tr>
				<td style="width: 120px">三十天内使用总数</td>
				<td style="width: 120px">{pigcms{$log_list['access_mom'][0][daynum]}</td>
			</tr>

			</tbody>
		</table>

		<table class="search_table" width="100%">
			<tr>
				<td>
					<form action="{pigcms{:U('Access/openDoor')}" method="get">
						<input type="hidden" name="c" value="Access"/>
						<input type="hidden" name="a" value="openDoor"/>
						<select name="searchtype" id="order">
							<option selected="selected" value="0">请选择</option>
							<option value="name" id="orname" <if condition="$_GET['searchtype'] eq 'name'">selected="selected"</if>>按用户名称排序</option>
							<option value="company" id="orcompany" <if condition="$_GET['searchtype'] eq 'company'">selected="selected"</if>>按公司名称排序</option>
							<option value="company" id="orcompany" <if condition="$_GET['searchtype'] eq 'company_all'">selected="selected"</if>>使用情况一览</option>
						</select>
						<select name="searchtime">
							<option selected="selected" value="0">请选择</option>
							<option value="yday"  <if condition="$_GET['ssearchtime'] eq 'yday'">selected="selected"</if>>今天之内</option>
							<option value="zday"  <if condition="$_GET['searchtime'] eq 'zday'">selected="selected"</if>>这个周之内</option>
							<option value="mday"  <if condition="$_GET['searchtime'] eq 'mday'">selected="selected"</if>>最近三十天</option>
						</select>
						<!--<input type="text" name="keyword" class="input-text" value="{pigcms{$_GET['keyword']}"  placeholder="请输入查询内容">-->
						<input type="submit" value="查询" class="button"/>
						<span id="showState" style="display:none">请选择时间</span>
					</form>
				</td>
			</tr>
		</table>
		<if condition="$state eq 1">
			<table width="100%" cellspacing="0">
				<thead>
				<tr>
					<th>公司名称</th>
					<th>公司管理员名</th>
					<th>所选时间内开门次数</th>


				</tr>
				</thead>
				<tbody>
				<if condition="$log_list['access_list']">
					<volist name="log_list['access_list']" id="vo">
						<tr>
							<td>{pigcms{$vo.truename}</td>
							<td>{pigcms{$vo.account}</td>
							<td>{pigcms{$vo.allnum}</td>
							<!--<td class="textcenter"><a href="javascript:void(0);"  onclick="window.top.artiframe('{pigcms{:U('Access/operatLog_edit',array('log_id'=>$vo['log_id']))}','查看详情',480,<if condition="$vo['log_id']">240<else/>340</if>,true,false,false,editbtn,'edit',true);">详情</a> | <a href="javascript:void(0);" class="delete_row" parameter="log_id={pigcms{$vo.log_id}" url="{pigcms{:U('Access/operatLog_del')}">删除</a></td>-->
						</tr>
					</volist>
					<tr><td class="textcenter pagebar" colspan="10">{pigcms{$log_list['pagebar']}</td></tr>
					<else/>
					<tr><td class="textcenter red" colspan="10">没有查询到有人使用</td></tr>
				</if>
				</tbody>
			</table>

		<elseif condition="$state eq 2"/>
			<table width="100%" cellspacing="0">
				<thead>
				<tr>
					<th>公司编号</th>
					<th>公司名称</th>
					<th>注册人数</th>


				</tr>
				</thead>
				<tbody>
				<if condition="$log_list['access_list']">
					<volist name="log_list['access_list']" id="vo">
						<tr>
							<td>{pigcms{$vo.company_id}</td>
							<td>{pigcms{$vo.company_name}</td>
							<td>{pigcms{$vo.allnum}</td>
							<!--<td class="textcenter"><a href="javascript:void(0);"  onclick="window.top.artiframe('{pigcms{:U('Access/operatLog_edit',array('log_id'=>$vo['log_id']))}','查看详情',480,<if condition="$vo['log_id']">240<else/>340</if>,true,false,false,editbtn,'edit',true);">详情</a> | <a href="javascript:void(0);" class="delete_row" parameter="log_id={pigcms{$vo.log_id}" url="{pigcms{:U('Access/operatLog_del')}">删除</a></td>-->
						</tr>
					</volist>
					<tr><td class="textcenter pagebar" colspan="10">{pigcms{$log_list['pagebar']}</td></tr>
					<else/>
					<tr><td class="textcenter red" colspan="10">没有查询到有人使用</td></tr>
				</if>
				</tbody>
			</table>

			<else/>
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
			<if condition="$log_list['access_list']">
			<volist name="log_list['access_list']" id="vo">
				<tr>
					<td>{pigcms{$vo.name}</td>
					<td>{pigcms{$vo.phone}</td>
					<td><if condition="$vo.card_type eq 1">现场审核</if><if condition="$vo.card_type eq 2">门禁卡</if><if condition="$vo.card_type eq 3">身份证</if><if condition="$vo.card_type eq 4">工作牌</if></td>
					<td>{pigcms{$vo.usernum}</td>
					<td>{pigcms{$vo.allnum}</td>
					<td>{pigcms{$vo.company_name}</td>
					<!--<td class="textcenter"><a href="javascript:void(0);"  onclick="window.top.artiframe('{pigcms{:U('Access/operatLog_edit',array('log_id'=>$vo['log_id']))}','查看详情',480,<if condition="$vo['log_id']">240<else/>340</if>,true,false,false,editbtn,'edit',true);">详情</a> | <a href="javascript:void(0);" class="delete_row" parameter="log_id={pigcms{$vo.log_id}" url="{pigcms{:U('Access/operatLog_del')}">删除</a></td>-->
				</tr>
			</volist>
			<tr><td class="textcenter pagebar" colspan="10">{pigcms{$log_list['pagebar']}</td></tr>
			<else/>
			<tr><td class="textcenter red" colspan="10">没有查询到有人使用</td></tr>
			</if>
			</tbody>
		</table>
		</if>
	</div>
</div>

	<include file="Public:footer"/>