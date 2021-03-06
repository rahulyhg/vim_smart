<!-- BEGIN PAGE LEVEL PLUGINS -->
<layout name="layout"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"  />
<link href="/Car/Admin/Public/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />
<script src="/Car/Admin/Public/assets/global/plugins/echarts.js"></script>
<!-- END PAGE LEVEL PLUGINS -->

<div class="page-content-wrapper">
	<!-- BEGIN CONTENT BODY -->
	<div class="page-content">
		<!-- BEGIN PAGE HEAD-->
		<div class="page-head">
			<!-- BEGIN PAGE TITLE -->
			<div class="page-title">
				<h1>智慧O2O平台
					<small>statistics, charts, recent events and reports</small>
				</h1>
			</div>
			<!-- END PAGE TITLE -->
			<!-- BEGIN PAGE TOOLBAR -->
			<!--<div class="page-toolbar">-->
			<!--<div id="dashboard-report-range" data-display-range="0" class="pull-right tooltips btn btn-fit-height green" data-placement="left" data-original-title="Change dashboard date range">-->
			<!--<i class="icon-calendar"></i>&nbsp;-->
			<!--<span class="thin uppercase hidden-xs"></span>&nbsp;-->
			<!--<i class="fa fa-angle-down"></i>-->
			<!--</div>-->
			<!--&lt;!&ndash; BEGIN THEME PANEL &ndash;&gt;-->
			<!--<div class="btn-group btn-theme-panel">-->
			<!--<a href="javascript:;" class="btn dropdown-toggle" data-toggle="dropdown">-->
			<!--<i class="icon-settings"></i>-->
			<!--</a>-->
			<!--<div class="dropdown-menu theme-panel pull-right dropdown-custom hold-on-click">-->
			<!--<div class="row">-->
			<!--<div class="col-md-4 col-sm-4 col-xs-12">-->
			<!--<h3>HEADER</h3>-->
			<!--<ul class="theme-colors">-->
			<!--<li class="theme-color theme-color-default active" data-theme="default">-->
			<!--<span class="theme-color-view"></span>-->
			<!--<span class="theme-color-name">Dark Header</span>-->
			<!--</li>-->
			<!--<li class="theme-color theme-color-light " data-theme="light">-->
			<!--<span class="theme-color-view"></span>-->
			<!--<span class="theme-color-name">Light Header</span>-->
			<!--</li>-->
			<!--</ul>-->
			<!--</div>-->
			<!--<div class="col-md-8 col-sm-8 col-xs-12 seperator">-->
			<!--<h3>LAYOUT</h3>-->
			<!--<ul class="theme-settings">-->
			<!--<li> Theme Style-->
			<!--<select class="layout-style-option form-control input-small input-sm">-->
			<!--<option value="square">Square corners</option>-->
			<!--<option value="rounded" selected="selected">Rounded corners</option>-->
			<!--</select>-->
			<!--</li>-->
			<!--<li> Layout-->
			<!--<select class="layout-option form-control input-small input-sm">-->
			<!--<option value="fluid" selected="selected">Fluid</option>-->
			<!--<option value="boxed">Boxed</option>-->
			<!--</select>-->
			<!--</li>-->
			<!--<li> Header-->
			<!--<select class="page-header-option form-control input-small input-sm">-->
			<!--<option value="fixed" selected="selected">Fixed</option>-->
			<!--<option value="default">Default</option>-->
			<!--</select>-->
			<!--</li>-->
			<!--<li> Top Dropdowns-->
			<!--<select class="page-header-top-dropdown-style-option form-control input-small input-sm">-->
			<!--<option value="light">Light</option>-->
			<!--<option value="dark" selected="selected">Dark</option>-->
			<!--</select>-->
			<!--</li>-->
			<!--<li> Sidebar Mode-->
			<!--<select class="sidebar-option form-control input-small input-sm">-->
			<!--<option value="fixed">Fixed</option>-->
			<!--<option value="default" selected="selected">Default</option>-->
			<!--</select>-->
			<!--</li>-->
			<!--<li> Sidebar Menu-->
			<!--<select class="sidebar-menu-option form-control input-small input-sm">-->
			<!--<option value="accordion" selected="selected">Accordion</option>-->
			<!--<option value="hover">Hover</option>-->
			<!--</select>-->
			<!--</li>-->
			<!--<li> Sidebar Position-->
			<!--<select class="sidebar-pos-option form-control input-small input-sm">-->
			<!--<option value="left" selected="selected">Left</option>-->
			<!--<option value="right">Right</option>-->
			<!--</select>-->
			<!--</li>-->
			<!--<li> Footer-->
			<!--<select class="page-footer-option form-control input-small input-sm">-->
			<!--<option value="fixed">Fixed</option>-->
			<!--<option value="default" selected="selected">Default</option>-->
			<!--</select>-->
			<!--</li>-->
			<!--</ul>-->
			<!--</div>-->
			<!--</div>-->
			<!--</div>-->
			<!--</div>-->
			<!--&lt;!&ndash; END THEME PANEL &ndash;&gt;-->
			<!--</div>-->
			<!-- END PAGE TOOLBAR -->
		</div>
		<!-- END PAGE HEAD-->
		<!-- BEGIN PAGE BREADCRUMB -->
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<a href="{pigcms{:U('Index/index_new')}">Home</a>
				<i class="fa fa-circle"></i>
			</li>
			<li>
				<span class="active">Dashboard</span>
			</li>
		</ul>
		<!-- END PAGE BREADCRUMB -->
		<!-- BEGIN PAGE BASE CONTENT -->
		<!-- BEGIN DASHBOARD STATS 1-->
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<a class="dashboard-stat dashboard-stat-v2 blue" href="#">
					<div class="visual">
						<i class="fa fa-comments"></i>
					</div>
					<div class="details">
						<div class="number">
							<span data-counter="counterup" data-value="{pigcms{$index_box_array.openDoor_num}">0</span>次
						</div>
						<div class="desc"> 门禁开门次数</div>
					</div>
				</a>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<a class="dashboard-stat dashboard-stat-v2 red" href="#">
					<div class="visual">
						<i class="fa fa-bar-chart-o"></i>
					</div>
					<div class="details">
						<div class="number">
							<span data-counter="counterup" data-value="{pigcms{$index_box_array.openDoor_peopel}">0</span>人
						</div>
						<div class="desc"> 门禁使用人数 </div>
					</div>
				</a>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<a class="dashboard-stat dashboard-stat-v2 green" href="#">
					<div class="visual">
						<i class="fa fa-shopping-cart"></i>
					</div>
					<div class="details">
						<div class="number">
							¥<span data-counter="counterup" data-value="{pigcms{$index_box_array.today_money}">0</span>
						</div>
						<div class="desc"> 企业交易金额 </div>
					</div>
				</a>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<a class="dashboard-stat dashboard-stat-v2 green" href="#">
					<div class="visual">
						<i class="fa fa-shopping-cart"></i>
					</div>
					<div class="details">
						<div class="number">
							<span data-counter="counterup" data-value="{pigcms{$index_box_array.today_total_mun}">0</span>笔
						</div>
						<div class="desc"> 交易订单数 </div>
					</div>
				</a>
			</div>
		</div>

		<div class="clearfix"></div>
		<!-- END DASHBOARD STATS 1-->
		<div class="row">
			<div class="col-lg-6 col-xs-12 col-sm-12" id="day">
				<!-- BEGIN PORTLET-->
				<div class="portlet light bordered">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-bar-chart font-dark hide"></i>
							<span class="caption-subject font-dark bold uppercase">当天企业交易金额</span>
							<span class="caption-helper">日期递增</span>
						</div>
						<div class="actions">
							<div class="btn-group btn-group-devided" data-toggle="buttons">
								<label class="btn red btn-outline btn-circle btn-sm active">
									<input type="radio" name="options" class="toggle" id="option1">十天之内</label>
							</div>
						</div>
					</div>
					<div class="portlet-body">
						<div id="site_statistics_loading">
							<img src="../assets/global/img/loading.gif" alt="loading" /> </div>
						<div id="site_statistics_content" class="display-none">
							<div id="site_statistics" class="chart" style="background-color: #ffffff">
								<script src="/Car/Admin/Public/assets/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
								<script src="/Car/Admin/Public/assets/global/plugins/amcharts/amcharts/plugins/responsive/responsive.js" type="text/javascript"></script>
								<script src="/Car/Admin/Public/assets/global/plugins/amcharts/amcharts/plugins/responsive/responsive.min.js" type="text/javascript"></script>
								<script src="/Car/Admin/Public/assets/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
								<script src="/Car/Admin/Public/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
								<script>
									var url = "__URL__/dayTox_true";
									$(function(){
										$.post(url,function(rs){
											//url是后台controller的方法的路径
											//data 是传到后台的json格式的参数，可选
											//rs是返回的数据

										},"json");
									});
									var chartsDate ={pigcms{$moeny_json};
									var chart = AmCharts.makeChart( "site_statistics", {
										"type": "serial",
										"theme":"light",
										"dataProvider": chartsDate,
										"categoryField": "date",
										"categoryAxis": {
											"autoGridCount": false,
											"gridCount": chartsDate.length,
											"gridPosition": "start",
											"gridAlpha": 0,
											"categoryAxisColor":"#123456"
										},
										"gridAboveGraphs": true,
										"startDuration": 1,

										"valueAxes": [{
											"id":"income",
											"axisAlpha": 0,
											"position": "left",
											"title": "金额(元)"
										},{
											"id":"income_true",
											"axisAlpha": 0,
											"position": "right",
											"inside": true,
											"title": "金额(元)"

										},{
											"id":"youhui",
											"axisAlpha": 0,
											"position": "right",
										},{
											"id":"count",
											"axisAlpha": 0,
											"position": "right",
											"title": "交易数(笔)"
										}
										],
										"graphs": [/*{

										 "balloonText": "当天实际收款：[[value]] 元",
										 "fillAlphas": 1,
										 'fillColors':'#3598DC',
										 "lineColor":"#3598DC",
										 "legendPeriodValueText": "金额: [[value.sum]] 元",
										 "legendValueText": "[[value]] 元",
										 "title": "distance",
										 "type": "column",
										 "valueField": "income",
										 "valueAxis": "income"
										 },{

										 "balloonText": "当天交易笔数：[[value]] 笔",
										 "fillAlphas": 1,
										 'fillColors':'#E7505A',
										 "lineColor":"#E7505A",
										 "legendPeriodValueText": "当天交易笔数：[[value]] 笔",
										 "legendValueText": "[[value]] 笔",
										 "title": "distance",
										 "type": "column",
										 "valueField": "count",
										 "valueAxis": "count"
										 },*/ {

											"bullet": "round",
											"bulletSize":6,
											"bulletBorderAlpha": 1,
											"bulletBorderThickness": 1,
											"useLineColorForBulletBorder": true,
											"dashLengthField": "8",
											"bulletColor":"#00ffff",
											"lineColor":"#FBC5C5",
											"balloonText": "当日应收款：[[value]] 元",
											"legendValueText": "[[value]]元",
											"title": "duration",
											"fillAlphas": 0.7,
											"valueField": "count",
											"valueAxis": "income"
										},/*{
										 "bullet": "square",
										 "bulletSize":8,
										 "bulletBorderAlpha": 1,
										 "bulletColor":"#FFe384",
										 "lineColor":"#FFe384",
										 "bulletBorderThickness": 1,
										 "dashLength":3,
										 "dashLengthField": "income",
										 "legendValueText": "[[value]]元",
										 "balloonText": "优惠金额：[[value]] 元",
										 "title": "duration",
										 "fillAlphas": 0,
										 "valueField": "youhui",
										 "valueAxis": "income"
										 }*/],
										"responsive": {
											"enabled": true,
											"addDefaultRules": false,
											"rules": [
												{
													"maxWidth": 400,
													"overrides": {
														"legend": {
															"enabled": false
														}
													}
												}
											]
										},

										"chartCursor": {
											"categoryBalloonDateFormat": "DD",
											"cursorAlpha": 0.1,
											"cursorColor":"#000000",
											"fullWidth":true,
											"valueBalloonsEnabled": false,
											"zoomable": false
										},
										"responsive":{
											"enabled":true
										},
										"export": {
											"enabled": true
										},
										"autoGridCount": false,
										"axisColor": "#555555",
										"gridAlpha": 0.1,
										"gridColor": "#FFFFFF",

									} );

								</script>
							</div>
						</div>
					</div>
				</div>
				<!-- END PORTLET-->
			</div>
			<div class="col-lg-6 col-xs-12 col-sm-12">
				<!-- BEGIN PORTLET-->
				<div class="portlet light bordered">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-share font-red-sunglo hide"></i>
							<span class="caption-subject font-dark bold uppercase">当天企业交易笔数</span>
							<span class="caption-helper">日期递增...</span>
						</div>
						<div class="actions">
							<div class="btn-group">
								<a href="" class="btn dark btn-outline btn-circle btn-sm active" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> 十天数据
									<span class="fa fa-angle-down"> </span>
								</a>
							</div>
						</div>
					</div>
					<div class="portlet-body">
						<div id="site_activities_loading">
							<img src="/Car/Admin/Public/assets/global/img/loading.gif" alt="loading" /> </div>
						<div id="site_activities_content" class="display-none">
						</div>

						<div id="site_activities" class="chart">

							<script>
								var chartData ={pigcms{$num_json};
								var chart = AmCharts.makeChart("site_activities", {
									"type": "serial",
									"theme":"light",
									"dataProvider": chartData,
									"categoryField": "date",
									"categoryAxis": {
										"autoGridCount": false,
										"gridCount": chartData.length,
										"gridPosition": "start",
										"gridAlpha": 0,
										"categoryAxisColor":"#123456",
										"labelRotation": 90
									},
									"gridAboveGraphs": true,
									"startDuration": 1,
									"valueAxes": [{
										"id":"income",
										"axisAlpha": 0,
										"position": "left",
										"title": "交易数(笔)"
									},{
										"id":"income_true",
										"axisAlpha": 0,
										"position": "right",
										"title": "金额(元)"

									},{
										"id":"youhui",
										"axisAlpha": 0,
										"position": "right",
									}],
									"balloon": {
										"borderThickness": 1,
										"shadowAlpha": 0
									},

									"graphs": [ {
										"fillAlphas": 0.2,
										"bullet": "round",
										"bulletBorderAlpha": 1,
										"bulletColor": "#36C6D3",
										"lineColor":"#36C6D3",
										"bulletSize": 5,
										"hideBulletsCount": 50,
										"lineThickness": 2,
										"title": "red line",
										"useLineColorForBulletBorder": true,
										"valueField": "count",
										"balloonText": "<span style='font-size:18px;'>[[value]]笔</span>",
										"valueAxis": "income"
									}/*,{
									 "fillAlphas": 0.2,
									 "bullet": "round",
									 "lineThickness": 2,
									 "bulletColor": "#ED6B75",
									 "lineColor":"#ED6B75",
									 "valueField": "true_income",
									 "balloonText": "<span style='font-size:18px;'>[[value]]</span>",
									 "valueAxis": "income"
									 },/*{
									 "bullet": "square",
									 "bulletColor": "#659BE0",
									 "lineColor":"#659BE0",
									 "lineThickness": 2,
									 "valueField": "youhui",
									 "balloonText": "<span style='font-size:18px;'>[[value]]</span>",
									 "valueAxis": "income"
									 }*/
									],
									"chartCursor": {
										"valueLineEnabled": true,
										"valueLineBalloonEnabled": true,
										"cursorAlpha": 0,
										"zoomable": false,
										"valueZoomable": true,
										"valueLineAlpha": 0.5
									},

								} );
							</script>


						</div>
						<div style="margin: 20px 0 10px 30px;display: none">
							<div class="row">
								<div class="col-md-3 col-sm-3 col-xs-6 text-stat">
									<span class="label label-sm label-success"> 实际收入: </span>
									<h3>¥{$count_data.all_true_income}</h3>
								</div>
								<div class="col-md-3 col-sm-3 col-xs-6 text-stat">
									<span class="label label-sm label-info"> 优惠金额: </span>
									<h3>¥{$count_data.all_cp_hilt}</h3>
								</div>
								<div class="col-md-3 col-sm-3 col-xs-6 text-stat">
									<span class="label label-sm label-danger"> 应收入金额: </span>
									<h3>¥{$count_data.all_income}</h3>
								</div>

							</div>
						</div>
					</div>
				</div>
				<!-- END PORTLET-->
			</div>
		</div>

		<!-- END PAGE BASE CONTENT -->
	</div>
	<!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->
<!-- BEGIN QUICK SIDEBAR -->
<a href="javascript:;" class="page-quick-sidebar-toggler">
	<i class="icon-login"></i>
</a>
<div class="page-quick-sidebar-wrapper" data-close-on-body-click="false">
	<div class="page-quick-sidebar">
		<ul class="nav nav-tabs">
			<li class="active">
				<a href="javascript:;" data-target="#quick_sidebar_tab_1" data-toggle="tab"> Users
					<span class="badge badge-danger">2</span>
				</a>
			</li>
			<li>
				<a href="javascript:;" data-target="#quick_sidebar_tab_2" data-toggle="tab"> Alerts
					<span class="badge badge-success">7</span>
				</a>
			</li>
			<li class="dropdown">
				<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> More
					<i class="fa fa-angle-down"></i>
				</a>
				<ul class="dropdown-menu pull-right">
					<li>
						<a href="javascript:;" data-target="#quick_sidebar_tab_3" data-toggle="tab">
							<i class="icon-bell"></i> Alerts </a>
					</li>
					<li>
						<a href="javascript:;" data-target="#quick_sidebar_tab_3" data-toggle="tab">
							<i class="icon-info"></i> Notifications </a>
					</li>
					<li>
						<a href="javascript:;" data-target="#quick_sidebar_tab_3" data-toggle="tab">
							<i class="icon-speech"></i> Activities </a>
					</li>
					<li class="divider"></li>
					<li>
						<a href="javascript:;" data-target="#quick_sidebar_tab_3" data-toggle="tab">
							<i class="icon-settings"></i> Settings </a>
					</li>
				</ul>
			</li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active page-quick-sidebar-chat" id="quick_sidebar_tab_1">
				<div class="page-quick-sidebar-chat-users" data-rail-color="#ddd" data-wrapper-class="page-quick-sidebar-list">
					<h3 class="list-heading">Staff</h3>
					<ul class="media-list list-items">
						<li class="media">
							<div class="media-status">
								<span class="badge badge-success">8</span>
							</div>
							<img class="media-object" src="/Car/Admin/Public/assets/layouts/layout/img/avatar3.jpg" alt="...">
							<div class="media-body">
								<h4 class="media-heading">Bob Nilson</h4>
								<div class="media-heading-sub"> Project Manager </div>
							</div>
						</li>
						<li class="media">
							<img class="media-object" src="/Car/Admin/Public/assets/layouts/layout/img/avatar1.jpg" alt="...">
							<div class="media-body">
								<h4 class="media-heading">Nick Larson</h4>
								<div class="media-heading-sub"> Art Director </div>
							</div>
						</li>
						<li class="media">
							<div class="media-status">
								<span class="badge badge-danger">3</span>
							</div>
							<img class="media-object" src="/Car/Admin/Public/assets/layouts/layout/img/avatar4.jpg" alt="...">
							<div class="media-body">
								<h4 class="media-heading">Deon Hubert</h4>
								<div class="media-heading-sub"> CTO </div>
							</div>
						</li>
						<li class="media">
							<img class="media-object" src="/Car/Admin/Public/assets/layouts/layout/img/avatar2.jpg" alt="...">
							<div class="media-body">
								<h4 class="media-heading">Ella Wong</h4>
								<div class="media-heading-sub"> CEO </div>
							</div>
						</li>
					</ul>
					<h3 class="list-heading">Customers</h3>
					<ul class="media-list list-items">
						<li class="media">
							<div class="media-status">
								<span class="badge badge-warning">2</span>
							</div>
							<img class="media-object" src="/Car/Admin/Public/assets/layouts/layout/img/avatar6.jpg" alt="...">
							<div class="media-body">
								<h4 class="media-heading">Lara Kunis</h4>
								<div class="media-heading-sub"> CEO, Loop Inc </div>
								<div class="media-heading-small"> Last seen 03:10 AM </div>
							</div>
						</li>
						<li class="media">
							<div class="media-status">
								<span class="label label-sm label-success">new</span>
							</div>
							<img class="media-object" src="/Car/Admin/Public/assets/layouts/layout/img/avatar7.jpg" alt="...">
							<div class="media-body">
								<h4 class="media-heading">Ernie Kyllonen</h4>
								<div class="media-heading-sub"> Project Manager,
									<br> SmartBizz PTL </div>
							</div>
						</li>
						<li class="media">
							<img class="media-object" src="/Car/Admin/Public/assets/layouts/layout/img/avatar8.jpg" alt="...">
							<div class="media-body">
								<h4 class="media-heading">Lisa Stone</h4>
								<div class="media-heading-sub"> CTO, Keort Inc </div>
								<div class="media-heading-small"> Last seen 13:10 PM </div>
							</div>
						</li>
						<li class="media">
							<div class="media-status">
								<span class="badge badge-success">7</span>
							</div>
							<img class="media-object" src="/Car/Admin/Public/assets/layouts/layout/img/avatar9.jpg" alt="...">
							<div class="media-body">
								<h4 class="media-heading">Deon Portalatin</h4>
								<div class="media-heading-sub"> CFO, H&D LTD </div>
							</div>
						</li>
						<li class="media">
							<img class="media-object" src="/Car/Admin/Public/assets/layouts/layout/img/avatar10.jpg" alt="...">
							<div class="media-body">
								<h4 class="media-heading">Irina Savikova</h4>
								<div class="media-heading-sub"> CEO, Tizda Motors Inc </div>
							</div>
						</li>
						<li class="media">
							<div class="media-status">
								<span class="badge badge-danger">4</span>
							</div>
							<img class="media-object" src="/Car/Admin/Public/assets/layouts/layout/img/avatar11.jpg" alt="...">
							<div class="media-body">
								<h4 class="media-heading">Maria Gomez</h4>
								<div class="media-heading-sub"> Manager, Infomatic Inc </div>
								<div class="media-heading-small"> Last seen 03:10 AM </div>
							</div>
						</li>
					</ul>
				</div>
				<div class="page-quick-sidebar-item">
					<div class="page-quick-sidebar-chat-user">
						<div class="page-quick-sidebar-nav">
							<a href="javascript:;" class="page-quick-sidebar-back-to-list">
								<i class="icon-arrow-left"></i>Back</a>
						</div>
						<div class="page-quick-sidebar-chat-user-messages">
							<div class="post out">
								<img class="avatar" alt="" src="/Car/Admin/Public/assets/layouts/layout/img/avatar3.jpg" />
								<div class="message">
									<span class="arrow"></span>
									<a href="javascript:;" class="name">Bob Nilson</a>
									<span class="datetime">20:15</span>
									<span class="body"> When could you send me the report ? </span>
								</div>
							</div>
							<div class="post in">
								<img class="avatar" alt="" src="/Car/Admin/Public/assets/layouts/layout/img/avatar2.jpg" />
								<div class="message">
									<span class="arrow"></span>
									<a href="javascript:;" class="name">Ella Wong</a>
									<span class="datetime">20:15</span>
									<span class="body"> Its almost done. I will be sending it shortly </span>
								</div>
							</div>
							<div class="post out">
								<img class="avatar" alt="" src="/Car/Admin/Public/assets/layouts/layout/img/avatar3.jpg" />
								<div class="message">
									<span class="arrow"></span>
									<a href="javascript:;" class="name">Bob Nilson</a>
									<span class="datetime">20:15</span>
									<span class="body"> Alright. Thanks! :) </span>
								</div>
							</div>
							<div class="post in">
								<img class="avatar" alt="" src="/Car/Admin/Public/assets/layouts/layout/img/avatar2.jpg" />
								<div class="message">
									<span class="arrow"></span>
									<a href="javascript:;" class="name">Ella Wong</a>
									<span class="datetime">20:16</span>
									<span class="body"> You are most welcome. Sorry for the delay. </span>
								</div>
							</div>
							<div class="post out">
								<img class="avatar" alt="" src="/Car/Admin/Public/assets/layouts/layout/img/avatar3.jpg" />
								<div class="message">
									<span class="arrow"></span>
									<a href="javascript:;" class="name">Bob Nilson</a>
									<span class="datetime">20:17</span>
									<span class="body"> No probs. Just take your time :) </span>
								</div>
							</div>
							<div class="post in">
								<img class="avatar" alt="" src="/Car/Admin/Public/assets/layouts/layout/img/avatar2.jpg" />
								<div class="message">
									<span class="arrow"></span>
									<a href="javascript:;" class="name">Ella Wong</a>
									<span class="datetime">20:40</span>
									<span class="body"> Alright. I just emailed it to you. </span>
								</div>
							</div>
							<div class="post out">
								<img class="avatar" alt="" src="/Car/Admin/Public/assets/layouts/layout/img/avatar3.jpg" />
								<div class="message">
									<span class="arrow"></span>
									<a href="javascript:;" class="name">Bob Nilson</a>
									<span class="datetime">20:17</span>
									<span class="body"> Great! Thanks. Will check it right away. </span>
								</div>
							</div>
							<div class="post in">
								<img class="avatar" alt="" src="/Car/Admin/Public/assets/layouts/layout/img/avatar2.jpg" />
								<div class="message">
									<span class="arrow"></span>
									<a href="javascript:;" class="name">Ella Wong</a>
									<span class="datetime">20:40</span>
									<span class="body"> Please let me know if you have any comment. </span>
								</div>
							</div>
							<div class="post out">
								<img class="avatar" alt="" src="/Car/Admin/Public/assets/layouts/layout/img/avatar3.jpg" />
								<div class="message">
									<span class="arrow"></span>
									<a href="javascript:;" class="name">Bob Nilson</a>
									<span class="datetime">20:17</span>
									<span class="body"> Sure. I will check and buzz you if anything needs to be corrected. </span>
								</div>
							</div>
						</div>
						<div class="page-quick-sidebar-chat-user-form">
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Type a message here...">
								<div class="input-group-btn">
									<button type="button" class="btn green">
										<i class="icon-paper-clip"></i>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane page-quick-sidebar-alerts" id="quick_sidebar_tab_2">
				<div class="page-quick-sidebar-alerts-list">
					<h3 class="list-heading">General</h3>
					<ul class="feeds list-items">
						<li>
							<div class="col1">
								<div class="cont">
									<div class="cont-col1">
										<div class="label label-sm label-info">
											<i class="fa fa-check"></i>
										</div>
									</div>
									<div class="cont-col2">
										<div class="desc"> You have 4 pending tasks.
                                            <span class="label label-sm label-warning "> Take action
                                                            <i class="fa fa-share"></i>
                                                        </span>
										</div>
									</div>
								</div>
							</div>
							<div class="col2">
								<div class="date"> Just now </div>
							</div>
						</li>
						<li>
							<a href="javascript:;">
								<div class="col1">
									<div class="cont">
										<div class="cont-col1">
											<div class="label label-sm label-success">
												<i class="fa fa-bar-chart-o"></i>
											</div>
										</div>
										<div class="cont-col2">
											<div class="desc"> Finance Report for year 2013 has been released. </div>
										</div>
									</div>
								</div>
								<div class="col2">
									<div class="date"> 20 mins </div>
								</div>
							</a>
						</li>
						<li>
							<div class="col1">
								<div class="cont">
									<div class="cont-col1">
										<div class="label label-sm label-danger">
											<i class="fa fa-user"></i>
										</div>
									</div>
									<div class="cont-col2">
										<div class="desc"> You have 5 pending membership that requires a quick review. </div>
									</div>
								</div>
							</div>
							<div class="col2">
								<div class="date"> 24 mins </div>
							</div>
						</li>
						<li>
							<div class="col1">
								<div class="cont">
									<div class="cont-col1">
										<div class="label label-sm label-info">
											<i class="fa fa-shopping-cart"></i>
										</div>
									</div>
									<div class="cont-col2">
										<div class="desc"> New order received with
											<span class="label label-sm label-success"> Reference Number: DR23923 </span>
										</div>
									</div>
								</div>
							</div>
							<div class="col2">
								<div class="date"> 30 mins </div>
							</div>
						</li>
						<li>
							<div class="col1">
								<div class="cont">
									<div class="cont-col1">
										<div class="label label-sm label-success">
											<i class="fa fa-user"></i>
										</div>
									</div>
									<div class="cont-col2">
										<div class="desc"> You have 5 pending membership that requires a quick review. </div>
									</div>
								</div>
							</div>
							<div class="col2">
								<div class="date"> 24 mins </div>
							</div>
						</li>
						<li>
							<div class="col1">
								<div class="cont">
									<div class="cont-col1">
										<div class="label label-sm label-info">
											<i class="fa fa-bell-o"></i>
										</div>
									</div>
									<div class="cont-col2">
										<div class="desc"> Web server hardware needs to be upgraded.
											<span class="label label-sm label-warning"> Overdue </span>
										</div>
									</div>
								</div>
							</div>
							<div class="col2">
								<div class="date"> 2 hours </div>
							</div>
						</li>
						<li>
							<a href="javascript:;">
								<div class="col1">
									<div class="cont">
										<div class="cont-col1">
											<div class="label label-sm label-default">
												<i class="fa fa-briefcase"></i>
											</div>
										</div>
										<div class="cont-col2">
											<div class="desc"> IPO Report for year 2013 has been released. </div>
										</div>
									</div>
								</div>
								<div class="col2">
									<div class="date"> 20 mins </div>
								</div>
							</a>
						</li>
					</ul>
					<h3 class="list-heading">System</h3>
					<ul class="feeds list-items">
						<li>
							<div class="col1">
								<div class="cont">
									<div class="cont-col1">
										<div class="label label-sm label-info">
											<i class="fa fa-check"></i>
										</div>
									</div>
									<div class="cont-col2">
										<div class="desc"> You have 4 pending tasks.
                                            <span class="label label-sm label-warning "> Take action
                                                            <i class="fa fa-share"></i>
                                                        </span>
										</div>
									</div>
								</div>
							</div>
							<div class="col2">
								<div class="date"> Just now </div>
							</div>
						</li>
						<li>
							<a href="javascript:;">
								<div class="col1">
									<div class="cont">
										<div class="cont-col1">
											<div class="label label-sm label-danger">
												<i class="fa fa-bar-chart-o"></i>
											</div>
										</div>
										<div class="cont-col2">
											<div class="desc"> Finance Report for year 2013 has been released. </div>
										</div>
									</div>
								</div>
								<div class="col2">
									<div class="date"> 20 mins </div>
								</div>
							</a>
						</li>
						<li>
							<div class="col1">
								<div class="cont">
									<div class="cont-col1">
										<div class="label label-sm label-default">
											<i class="fa fa-user"></i>
										</div>
									</div>
									<div class="cont-col2">
										<div class="desc"> You have 5 pending membership that requires a quick review. </div>
									</div>
								</div>
							</div>
							<div class="col2">
								<div class="date"> 24 mins </div>
							</div>
						</li>
						<li>
							<div class="col1">
								<div class="cont">
									<div class="cont-col1">
										<div class="label label-sm label-info">
											<i class="fa fa-shopping-cart"></i>
										</div>
									</div>
									<div class="cont-col2">
										<div class="desc"> New order received with
											<span class="label label-sm label-success"> Reference Number: DR23923 </span>
										</div>
									</div>
								</div>
							</div>
							<div class="col2">
								<div class="date"> 30 mins </div>
							</div>
						</li>
						<li>
							<div class="col1">
								<div class="cont">
									<div class="cont-col1">
										<div class="label label-sm label-success">
											<i class="fa fa-user"></i>
										</div>
									</div>
									<div class="cont-col2">
										<div class="desc"> You have 5 pending membership that requires a quick review. </div>
									</div>
								</div>
							</div>
							<div class="col2">
								<div class="date"> 24 mins </div>
							</div>
						</li>
						<li>
							<div class="col1">
								<div class="cont">
									<div class="cont-col1">
										<div class="label label-sm label-warning">
											<i class="fa fa-bell-o"></i>
										</div>
									</div>
									<div class="cont-col2">
										<div class="desc"> Web server hardware needs to be upgraded.
											<span class="label label-sm label-default "> Overdue </span>
										</div>
									</div>
								</div>
							</div>
							<div class="col2">
								<div class="date"> 2 hours </div>
							</div>
						</li>
						<li>
							<a href="javascript:;">
								<div class="col1">
									<div class="cont">
										<div class="cont-col1">
											<div class="label label-sm label-info">
												<i class="fa fa-briefcase"></i>
											</div>
										</div>
										<div class="cont-col2">
											<div class="desc"> IPO Report for year 2013 has been released. </div>
										</div>
									</div>
								</div>
								<div class="col2">
									<div class="date"> 20 mins </div>
								</div>
							</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="tab-pane page-quick-sidebar-settings" id="quick_sidebar_tab_3">
				<div class="page-quick-sidebar-settings-list">
					<h3 class="list-heading">General Settings</h3>
					<ul class="list-items borderless">
						<li> Enable Notifications
							<input type="checkbox" class="make-switch" checked data-size="small" data-on-color="success" data-on-text="ON" data-off-color="default" data-off-text="OFF"> </li>
						<li> Allow Tracking
							<input type="checkbox" class="make-switch" data-size="small" data-on-color="info" data-on-text="ON" data-off-color="default" data-off-text="OFF"> </li>
						<li> Log Errors
							<input type="checkbox" class="make-switch" checked data-size="small" data-on-color="danger" data-on-text="ON" data-off-color="default" data-off-text="OFF"> </li>
						<li> Auto Sumbit Issues
							<input type="checkbox" class="make-switch" data-size="small" data-on-color="warning" data-on-text="ON" data-off-color="default" data-off-text="OFF"> </li>
						<li> Enable SMS Alerts
							<input type="checkbox" class="make-switch" checked data-size="small" data-on-color="success" data-on-text="ON" data-off-color="default" data-off-text="OFF"> </li>
					</ul>
					<h3 class="list-heading">System Settings</h3>
					<ul class="list-items borderless">
						<li> Security Level
							<select class="form-control input-inline input-sm input-small">
								<option value="1">Normal</option>
								<option value="2" selected>Medium</option>
								<option value="e">High</option>
							</select>
						</li>
						<li> Failed Email Attempts
							<input class="form-control input-inline input-sm input-small" value="5" /> </li>
						<li> Secondary SMTP Port
							<input class="form-control input-inline input-sm input-small" value="3560" /> </li>
						<li> Notify On System Error
							<input type="checkbox" class="make-switch" checked data-size="small" data-on-color="danger" data-on-text="ON" data-off-color="default" data-off-text="OFF"> </li>
						<li> Notify On SMTP Error
							<input type="checkbox" class="make-switch" checked data-size="small" data-on-color="warning" data-on-text="ON" data-off-color="default" data-off-text="OFF"> </li>
					</ul>
					<div class="inner-content">
						<button class="btn btn-success">
							<i class="icon-settings"></i> Save Changes</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="page-footer-inner"> 2017 &copy; 汇得行智慧助手系统
		<a target="_blank" href="http://www.vhi99.com">邻钱科技</a> &nbsp;|&nbsp;
		<a href="http://www.metronic.com" target="_blank">Metronic</a>
	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div>
<!-- END FOOTER -->
<!-- BEGIN QUICK NAV -->
<!--<nav class="quick-nav">-->
<!--<a class="quick-nav-trigger" href="#0">-->
<!--<span aria-hidden="true"></span>-->
<!--</a>-->
<!--<ul>-->
<!--<li>-->
<!--<a href="https://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" target="_blank" class="active">-->
<!--<span>Purchase Metronic</span>-->
<!--<i class="icon-basket"></i>-->
<!--</a>-->
<!--</li>-->
<!--<li>-->
<!--<a href="https://themeforest.net/item/metronic-responsive-admin-dashboard-template/reviews/4021469?ref=keenthemes" target="_blank">-->
<!--<span>Customer Reviews</span>-->
<!--<i class="icon-users"></i>-->
<!--</a>-->
<!--</li>-->
<!--<li>-->
<!--<a href="http://keenthemes.com/showcast/" target="_blank">-->
<!--<span>Showcase</span>-->
<!--<i class="icon-user"></i>-->
<!--</a>-->
<!--</li>-->
<!--<li>-->
<!--<a href="http://keenthemes.com/metronic-theme/changelog/" target="_blank">-->
<!--<span>Changelog</span>-->
<!--<i class="icon-graph"></i>-->
<!--</a>-->
<!--</li>-->
<!--</ul>-->
<!--<span aria-hidden="true" class="quick-nav-bg"></span>-->
<!--</nav>-->
<div class="quick-nav-overlay"></div>
<!-- END QUICK NAV -->
<!--[if lt IE 9]>
<script src="/Car/Admin/Public/assets/global/plugins/respond.min.js"></script>
<script src="/Car/Admin/Public/assets/global/plugins/excanvas.min.js"></script>
<script src="/Car/Admin/Public/assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->

<script src="/Car/Admin/Public/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="/Car/Admin/Public/assets/global/plugins/moment.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/amcharts/amcharts/themes/patterns.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/amcharts/amcharts/themes/chalk.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/amcharts/ammap/ammap.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/amcharts/ammap/maps/js/worldLow.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/amcharts/amstockcharts/amstock.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/horizontal-timeline/horizontal-timeline.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="/Car/Admin/Public/assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="/Car/Admin/Public/assets/pages/scripts/dashboard.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="/Car/Admin/Public/assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->
</body>

</html>