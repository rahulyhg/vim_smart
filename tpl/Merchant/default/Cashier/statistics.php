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
	  #dataselect .input-group-btn,#ym-select .input-group-btn{width: 12%;}
	  #dataselect .input-sm ,#ym-select .input-sm{ border-radius: 7px; height:40px;}
	  #dataselect .btn-primary ,#ym-select .btn-primary{ margin-left: 20px; border-radius:4px;margin-bottom: 0px;}
	  #dataselect .input-group-addon,#ym-select .input-group-addon{border-radius: 7px;}
	  .ibox-content{ min-height:550px;}
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
					<div class="wrapper wrapper-content animated fadeIn">
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
									<div class="ibox-content">
										<div id="canvasdesc">
											<span class="pull-right text-right">
											<small>每日支付状况<strong></strong></small>
												<br>												
											</span>
											<h2 class="m-b-xs">总净收入 ￥<strong class="price1">0</strong></h2>
											<h3 class="m-b-xs">
											   <span>总流水收入 ￥<strong class="price2">0</strong></span>
											   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>总退款 ￥<strong class="price3">0</strong></span>
											</h3>
											<!---<small></small>--->
										</div>
										<div id="canvascontext" >
											<canvas height="100" id="lineChart"></canvas>
										</div>										
									</div>
								</div>
							</div>
						</div>
					   <div class="row">
							<div class="col-lg-12">
								<div class="ibox float-e-margins">
									<div class="ibox-title">
										<div id="ym-select" class="form-group">
											<label class="font-noraml">选择年月</label>
											<div id="ymdatepicker" class="input-daterange input-group">
												<input type="text" value="<?php echo $aYearagom;?>" name="start" class="input-sm form-control" id="ymstart">
												&nbsp;<span> T O </span>&nbsp;
												<input type="text" value="<?php echo $todaym;?>" name="end" class="input-sm form-control" id="ymend">
												<span class="input-group-btn">
													<button class="btn btn-primary"> 查 询 </button>
												</span>
											</div>
										</div>
									</div>
									<div class="ibox-content">
										<div id="ymcanvasdesc">
											<span class="pull-right text-right">
											<small>每月支付状况<strong></strong></small>
												<br>												
											</span>
											<h2 class="m-b-xs">总净收入 ￥<strong class="price1">0</strong></h2>
											<h3 class="m-b-xs">
											   <span>总流水收入 ￥<strong class="price2">0</strong></span>
											   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>总退款 ￥<strong class="price3">0</strong></span>
											</h3>
											<!---<small></small>--->
										</div>
										<div id="ym-canvascontext" >
											<canvas height="100" id="ymlineChart"></canvas>
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
        $(document).ready(function() {
			$('#datepicker input').datepicker({
                keyboardNavigation: false,
                forceParse: false,
				format: "yyyy-mm-dd",
                autoclose: true
            });
			$('#ymdatepicker input').datepicker({
                keyboardNavigation: false,
                forceParse: false,
				format: "yyyy-mm",
                autoclose: true
            });
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
		if(typ=='date'){
		  $('#canvascontext').html('<canvas height="100" id="lineChart"></canvas>');
		  var start = $.trim($('#datestart').val());
		  var end = $.trim($('#dateend').val());
		  var pdatas={
		        'typ': typ,
			    'dstart':start,
			    'dend':end
			   }
			$.post('{pigcms{:U("Cashier/statistics")}', pdatas, function(ret) {
				/*data = $.parseJSON(data);*/
				$('#'+idstr2+' .price1').text(ret.expand.ic);
				$('#'+idstr2+' .price2').text(ret.expand.tt);
				$('#'+idstr2+' .price3').text(ret.expand.rf);
				var lineChartData = {
					labels: ret.xdata,
					datasets: [{
                        label: "流水收入",
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
							label: '退款金额',
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
				if(typeof(ret.ydata.idx3)!='undefined'){
					var tmpobj={
							label: '实际收入',
							fillColor: "rgba(26,179,148,0.5)",
							strokeColor: "rgba(26,179,148,0.7)",
							pointColor: "rgba(26,179,148,1)",
							pointStrokeColor: "#fff",
							pointHighlightFill: "#fff",
							pointHighlightStroke: "rgba(26,179,148,1)",
							data: ret.ydata.idx3
						}
					lineChartData.datasets.push(tmpobj);
					
				}				
				var ctx = document.getElementById(idstr).getContext("2d");
				var myNewChart = new Chart(ctx).Line(lineChartData, lineOptions);
			},'JSON');
		}else{
		  $('#ym-canvascontext').html('<canvas height="100" id="ymlineChart"></canvas>');
		  var start = $.trim($('#ymstart').val());
		  var end = $.trim($('#ymend').val());
		  var pdatas={
		        'typ': typ,
			    'dstart':start,
			    'dend':end
			   }
			$.post('{pigcms{:U("Cashier/statistics")}', pdatas, function(ret) {
				/*data = $.parseJSON(data);*/
				$('#'+idstr2+' .price1').text(ret.expand.ic);
				$('#'+idstr2+' .price2').text(ret.expand.tt);
				$('#'+idstr2+' .price3').text(ret.expand.rf);
				var lineChartData = {
					labels: ret.xdata,
					datasets: [{
                        label: "流水收入",
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
							label: '退款金额',
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
				if(typeof(ret.ydata.idx3)!='undefined'){
					var tmpobj={
							label: '实际收入',
							fillColor: "rgba(26,179,148,0.5)",
							strokeColor: "rgba(26,179,148,0.7)",
							pointColor: "rgba(26,179,148,1)",
							pointStrokeColor: "#fff",
							pointHighlightFill: "#fff",
							pointHighlightStroke: "rgba(26,179,148,1)",
							data: ret.ydata.idx3
						}
					lineChartData.datasets.push(tmpobj);
					
				}
				
				var ctx = document.getElementById(idstr).getContext("2d");
				var myNewChart = new Chart(ctx).Line(lineChartData, lineOptions);
			},'JSON');
		
		}
	 }
	 GetChartData('date','lineChart','canvasdesc');
		$('#dataselect .btn-primary').click(function(){
			GetChartData('date','lineChart','canvasdesc');
		});

	 GetChartData('month','ymlineChart','ymcanvasdesc');
		$('#ym-select .btn-primary').click(function(){
			GetChartData('month','ymlineChart','ymcanvasdesc');
		});

	});

	function CreateShop(obj){	//点击跳转到对应的页面
		//alert(obj.value);
		window.location.href=obj.value;
	}
</script>
<include file="Public:footer"/>
