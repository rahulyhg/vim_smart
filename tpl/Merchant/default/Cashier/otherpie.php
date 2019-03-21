<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-gear gear-icon"></i>
				<a href="{pigcms{:U('Cashier/index')}">商家收银</a>
			</li>
			<li class="active">数据统计</li>
		</ul>
	</div>
	<!-- 内容头部 -->   
    <link href="{pigcms{$static_path}css/animate_new.css" rel="stylesheet">
	<link href="{pigcms{$static_path}css/cashier.css" rel="stylesheet">	<!----开放式头部，请在自己的页面加上--</head>-->
	<link href="{pigcms{$static_path}plugins/css/sweetalert/sweetalert.css" rel="stylesheet">   
	<link href="{pigcms{$static_path}css/app.css" rel="stylesheet">
	<style type="text/css">
	.line-legend,.doughnut-legend,.bar-legend {
		list-style: outside none none;
		position: absolute;
		right: 25px;
		top: 60px;
	}
	.line-legend {
		top: 195px;
	}
	.line-legend li,.doughnut-legend li ,.bar-legend li{
		border-radius: 5px;
		cursor: default;
		display: block;
		font-size: 14px;
		margin-bottom: 4px;
		padding: 2px 8px 2px 28px;
		position: relative;
		transition: background-color 200ms ease-in-out 0s;
	}
	.line-legend li span,.doughnut-legend li span ,.bar-legend li span{
		border-radius: 5px;
		display: block;
		height: 100%;
		left: 0;
		position: absolute;
		top: 0;
		width: 20px;
	}
	#cibox-content{ min-height:550px;}
	#dataselect .input-group-btn,#ym-select .input-group-btn{width: 12%;}
	#dataselect .input-sm ,#ym-select .input-sm{ border-radius: 7px; height:40px;}
	#dataselect .btn-primary ,#ym-select .btn-primary{ margin-left: 20px; border-radius:4px;margin-bottom: 0px;}
	#dataselect .input-group-addon,#ym-select .input-group-addon{border-radius: 7px;}
	.input-group .form-control{width: 45%;float:none;}
	</style>

	<div class="page-content">
		<div class="page-content-area">
			<style>
				.ace-file-input a {display:none;}
			</style>
			<div class="row">
				<div class="col-xs-12">
					<button class="btn btn-success" onclick="CreateShop(this)" value='{pigcms{:U("Cashier/statistics")}'>商家收支</button>
					<button class="btn btn-success" onclick="CreateShop(this)" value='{pigcms{:U("Cashier/otherpie")}'>概况统计</button>
					<button class="btn btn-success" onclick="CreateShop(this)" value='{pigcms{:U("Cashier/fans")}'>粉丝支付排行</button>
					<div class="wrapper wrapper-content animated fadeInRight">
						<div class="row">
							<div class="col-lg-6">
								<div class="ibox float-e-margins">
									<div class="ibox-title">
										<h5>刷卡支付扫码次数（正扫）
											<small>商家刷卡支付统计</small>
										</h5>
										<div ibox-tools></div>
									</div>
									<div class="ibox-content">
										<div>
											<canvas id="PieChart_m" height="150"></canvas>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="ibox float-e-margins">
									<div class="ibox-title">
										<h5>支付来源总体统计</h5>
										<div ibox-tools></div>
									</div>
									<div class="ibox-content">
										<div>
											<canvas id="doughnutChart" height="150"></canvas>
										</div>
									</div>
								</div>
							</div>             
						</div>
						<div class="row">
							<div class="col-lg-12">
								<div class="ibox float-e-margins">
									<div class="ibox-title">
										<div id="dataselect" class="form-group">
											<label class="font-noraml">选择日期</label>
											<div id="datepicker" class="input-daterange input-group">
												<input type="text" value="<?php echo $aweekago;?>" name="start" class="input-sm form-control" id="datestart">
												&nbsp;<span> T O </span>&nbsp;
												<input type="text" value="<?php echo $today;?>" name="end" class="input-sm form-control" id="dateend">
												<span class="input-group-btn">
													<button class="btn btn-primary"> 查 询 </button>
												</span>
											</div>
										</div>
									</div>
									<div class="ibox-content" id="cibox-content">
										<div id="canvasdesc">
											<span class="pull-right text-right">
											<small>每日扫码次数情况<strong></strong></small>
												<br>                                           
											</span>
											<h2 class="m-b-xs">每天扫码次数情况</h2>
											<h3 class="m-b-xs">
											<span>刷卡扫码次数<strong class="price1">0</strong></span> 
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>收银台扫码次数<strong class="price2">0</strong></span>
											</h3>
											<!---<small></small>--->
										</div>
										<div id="canvascontext" >
											<canvas height="100" id="linecountChart"></canvas>
										</div>
									</div>
								</div>
							</div>
						</div> 
					</div> 
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(function () {
	$('#datepicker input').datepicker({
		keyboardNavigation: false,
		forceParse: false,
		format: "yyyy-mm-dd",
		autoclose: true
    });

	var helpers = Chart.helpers;
    /*var doughnutData_m = [
        {
            value: <?php echo $mt_count;?>,
            color: "#a3e1d4",
            highlight: "#1ab394",
            label: "刷卡支付次数（正扫）"
        },
        {
            value: <?php echo $wt_count;?>,
            color: "#CDE443",
            highlight: "#1ab394",
            label: "扫码支付次数（反扫）"
        },
    ];*/

    var doughnutOptions = {
        segmentShowStroke: true,
        segmentStrokeColor: "#fff",
        segmentStrokeWidth: 2,
        //percentageInnerCutout: 45, // This is 0 for Pie charts
		percentageInnerCutout: 0, // This is 0 for Pie charts
        animationSteps: 100,
        animationEasing: "easeOutBounce",
        animateRotate: true,
        animateScale: false,
        responsive: true,
		//tooltipTemplate : "<%if (label){%><%=label%>: <%}%><%= value %>kb", animation: false
    };

    var ctx = document.getElementById("PieChart_m").getContext("2d");
    var myNewChart = new Chart(ctx).Doughnut(doughnutData_m, doughnutOptions);		
	$("#PieChart_m").parent().parent('.ibox-content').append(myNewChart.generateLegend());
    /*var doughnutData = [
        {
            value: <?php echo $entirearr['local'];?>,
            color: "#a3e1d4",
            highlight: "#1ab394",
            label: "本平台(线下)支付总额"
        },
        {
            value: <?php echo $entirearr['other'];?>,
            color: "#dedede",
            highlight: "#1ab394",
            label: "其他平台(线上)支付总额"
        },
    ];*/

    var doughnutOptions = {
        segmentShowStroke: true,
        segmentStrokeColor: "#fff",
        segmentStrokeWidth: 2,
        percentageInnerCutout: 45, // This is 0 for Pie charts
        animationSteps: 100,
        animationEasing: "easeOutBounce",
        animateRotate: true,
        animateScale: false,
        responsive: true,
		tooltipTemplate : "<%if (label){%><%=label%>: ￥<%}%><%= value %> 元", animation: false
    };

    var ctx = document.getElementById("doughnutChart").getContext("2d");
    var myNewChart = new Chart(ctx).Doughnut(doughnutData, doughnutOptions);
	$("#doughnutChart").parent().parent('.ibox-content').append(myNewChart.generateLegend());
	//var myNewChart = new Chart(ctx).Pie(doughnutData,doughnutOptions);
	var lineOptions = {
		//scaleStartValue:0,
		//scaleSteps : 10,//y轴刻度的个数
		//scaleStepWidth : 100,   //y轴每个刻度的宽度
		//scaleOverride :true ,   //是否用硬编码重写y轴网格线
		scaleShowGridLines: true,
		scaleGridLineColor: "rgba(0,0,0,.05)",
		scaleGridLineWidth: 1,
		bezierCurve: true,
		bezierCurveTension: 0.4,
		pointDot: true,
		pointDotRadius: 4,
		pointDotStrokeWidth: 1,
		pointHitDetectionRadius: 20,
		datasetStroke: true,
		datasetStrokeWidth: 2,
		datasetFill: true,
		responsive: true,
	};

	function GetChartData(typ,idstr,idstr2){
		$('#canvascontext').html('<canvas height="100" id="linecountChart"></canvas>');
		var start = $.trim($('#datestart').val());
		var end = $.trim($('#dateend').val());
		var pdatas={
			'typ': typ,
			'dstart':start,
			'dend':end
		}
		$.post('/merchants.php?m=User&c=statistics&a=getchart', pdatas, function(ret) {
			/*data = $.parseJSON(data);*/
			$('#'+idstr2+' .price1').text(ret.expand.microC);
			$('#'+idstr2+' .price2').text(ret.expand.nomicroC);
			var lineChartData = {
				labels: ret.xdata,
				datasets: [{
					label: "刷卡次数",
					fillColor: "rgba(220,220,220,0.5)",
					strokeColor: "rgba(220,220,220,1)",
					pointColor: "rgba(220,220,220,1)",
					pointStrokeColor: "#fff",
					pointHighlightFill: "#fff",
					pointHighlightStroke: "rgba(220,220,220,1)",
					data: ret.ydata.idx1
				}]
			}

			if(typeof(ret.ydata.idx2)!='undefined'){
				var tmpobj={
					label: '收银台扫码次数',
					fillColor: "rgba(26,179,148,0.5)",
					strokeColor: "rgba(26,179,148,0.7)",
					pointColor: "rgba(26,179,148,1)",
					pointStrokeColor: "#fff",
					pointHighlightFill: "#fff",
					pointHighlightStroke: "rgba(26,179,148,1)",
					data: ret.ydata.idx2
				}
				lineChartData.datasets.push(tmpobj);				
			}
			 var ctx = document.getElementById(idstr).getContext("2d");
			 var myNewChart = new Chart(ctx).Line(lineChartData, lineOptions);
			 $("#"+idstr).parent().parent('.ibox-content').append(myNewChart.generateLegend());
		},'JSON');
	}
	GetChartData('smcount','linecountChart','canvasdesc');
	$('#dataselect .btn-primary').click(function(){
		GetChartData('smcount','linecountChart','canvasdesc');
	});
});

function CreateShop(obj){	//点击跳转到对应的页面
	//alert(obj.value);
	window.location.href=obj.value;
}
</script>
<include file="Public:footer"/>
