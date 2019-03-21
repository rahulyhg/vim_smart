<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
    <title>在线抄表</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" >  
    <meta content="Preview page of Metronic Admin Theme #4 for bootstrap inputs, input groups, custom checkboxes and radio controls and more" name="description" />
    <meta content="" name="author" />
    <link href="{pigcms{$static_path}css/shui/style.css" rel="stylesheet" type="text/css" />
	<link href="{pigcms{$static_path}css/shui/weui.css" rel="stylesheet" type="text/css" />
	<link href="{pigcms{$static_path}css/shui/weui2.css" rel="stylesheet" type="text/css" />
	<style type="text/css">
			input::-webkit-input-placeholder, textarea::-webkit-input-placeholder { 
			color: #757575; font-size:20px; font-weight: bold;
			} 
			input:-moz-placeholder, textarea:-moz-placeholder { 
			color: #757575; font-size:20px; font-weight: bold;
			} 
			input::-moz-placeholder, textarea::-moz-placeholder { 
			color: #757575; font-size:20px; font-weight: bold;
			} 
			input:-ms-input-placeholder, textarea:-ms-input-placeholder { 
			color: #757575; font-size:20px; font-weight: bold;
			} 
			
			input,
			textarea {
				border: 0; /* 方法1 */
				-webkit-appearance: none; /* 方法2 */
			}
			
			.weui_cell_select .weui_cell_bd:after {
			content: " ";
			display: inline-block;
			-webkit-transform: rotate(45deg);
			transform: rotate(45deg);
			height: 6px;
			width: 6px;
			border-width: 2px 2px 0 0;
			border-color: #8e8e8e;
			border-style: solid;
			position: relative;
			top: -2px;
			position: absolute;
			top: 50%;
			right: 15px;
			margin-top: -3px;
			z-index: 1111;
		}
	</style>
</head>
<script>
    document.addEventListener('touchstart',function(){},false);
	function te(crYL){
		var wqYL = document.getElementById("wqYL").innerText;
		var yl = parseInt(crYL) - parseInt(wqYL);
		document.getElementById("yongliang").innerText = parseInt(yl);
		
	}
</script>
<body>
<div class="tb">当前公司：汇得行（中国）集团有限公司</div>
<div class="xkk">
	<div class="cw">
		<div class="left">
			<div class="left2">抄送月份：</div>
			<div class="right2">
				<div class="cw2">
					<div class="weui_cell weui_cell_select">
							<div class="weui_cell_bd weui_cell_primary">
								<select class="weui_select" name="select1" style="border:1px #d4d4d4 solid; background-color:#FFFFFF; border-radius:0; height:40px;">
									<option value="1">1月</option>
									<option value="2">2月</option>
									<option value="3">3月</option>
									<option value="4">4月</option>
									<option value="5">5月</option>
									<option value="6">6月</option>
									<option value="7">7月</option>
									<option selected="" value="8">8月</option>
									<option value="9">9月</option>
									<option value="10">10月</option>
									<option value="11">11月</option>
									<option value="12">12月</option>
								</select>
							</div>
						</div>
				</div>
			</div>
			<div style="clear:both;"></div>
		</div>
		<div class="right">
			<div class="kid">设备类型：<span style="color:#757575">水表</span></div>
		</div>
		<div style="clear:both;"></div>
	</div>
</div>

<div class="xkk">
	<div class="cw">
		<div style="width:100%;">
			<div class="gh"><img src="{pigcms{$static_path}images/fw2.jpg" style="width:5px; height:auto;"/></div>
			<div class="gh2">往期用量（上月）：</div>
			<div style="clear:both;"></div>
		</div>
		<div style="width:100%; padding-top:15px;">
			<div class="wz"><span style="padding-left:5%;" id="wqYL">22697</span></div>
			<div class="wz2">吨</div>
			<div style="clear:both;"></div>
		</div>
		<div style="width:100%; padding-top:15px;">
			<div class="gh"><img src="{pigcms{$static_path}images/fw2.jpg" style="width:5px; height:auto;"/></div>
			<div class="gh2">当前用量：</div>
			<div style="clear:both;"></div>
		</div>
		<div style="width:100%; padding-top:15px;">
			<div class="wz3"><input name="textfield" type="number" onchange="te(this.value)" pattern="[0-9]*" placeholder="点此输入用量" style="border:1px #d4d4d4 solid; height:50px; border-radius:0px; background-color:#f1f1f1; line-height:50px; padding-left:5%; font-size:40px; font-family:Arial; color:#000000; width:95%;"/></div>
			<div class="wz2">吨</div>
			<div style="clear:both;"></div>
		</div>
		<a href="http://www.hdhsmart.com/wap.php?g=Wap&c=Express&a=shui2"><div class="ba">上报数据</div></a>
		
	</div>
</div>
<div class="zh">本月共使用 <span style="font-size:40px; font-family:Arial; color:#000000;" id="yongliang">0</span> 吨</div>
<div style="width:100%; height:60px; text-align:center; line-height:60px; color:#8a8a8a; font-size:14px;">汇得行（中国）集团有限公司</div>
</body>