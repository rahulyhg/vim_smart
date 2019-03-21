<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
    <title>智慧停车场系统</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" >  
    <meta content="Preview page of Metronic Admin Theme #4 for bootstrap inputs, input groups, custom checkboxes and radio controls and more" name="description" />
    <meta content="" name="author" />
    <link href="{pigcms{$static_path}test/style.css" rel="stylesheet" type="text/css" />
	<link href="{pigcms{$static_path}test/weui.css" rel="stylesheet" type="text/css" />
	<link href="{pigcms{$static_path}test/weui2.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.bx {width:100%; -webkit-box-shadow: 0px 0px 6px #e9e9e9; background-color:#FFFFFF;}
.bx2 {width:90%; margin:0px auto; padding:10px 0 10px 0;}
.bx3 {width:5%; float:left; padding-top:3px;}
.bx4 {width:90%; float:left; margin-left:2%; color:#a1a1a8;}
.cw {width:90%; padding-top:25px; margin:0px auto;}
.ty {width:100%; margin-top:15px; -webkit-box-shadow: 0px 0px 6px #e9e9e9; background-color:#FFFFFF;}
.ty2 {width:95%; margin-left:5%; padding-top:20px;}
.ty4 {width:100%; margin-top:25px; -webkit-box-shadow: 0px 0px 6px #e9e9e9; background-color:#FFFFFF;}
.ty3 {width:100%; padding-top:20px; margin:0px auto; overflow:hidden;}
.tk {width:40%; margin-left:5%; margin-right:5%; float:left; margin-bottom:15px;}
.tkw {width:86%; margin-left:7%; margin-right:7%; margin-bottom:15px;}
.tk2 {width:100%; margin:0px auto;}
.tk3 {width:100%; height:30px; line-height:30px; overflow:hidden; text-align:center; color:#a1a1a8;}
.geq {width:100%; margin-top:25px; -webkit-box-shadow: 0px 0px 6px #e9e9e9; background-color:#FFFFFF;}
.geq2 {width:90%; padding-top:20px; margin:0px auto; padding-bottom:25px;}
.geq3 {width:90%; padding-top:15px; margin:0px auto; padding-bottom:15px; line-height:1.8; color:#878787; font-size:14px;}
.weui_cell:before {
    border-top:none;
}
.weui_cell {
    padding:0px;
	width:100%;
    position: relative;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
}
.weui_cell:before {
    left: 0px;
}
.btb {width:100%; font-size:18px; text-align:center; line-height:40px; height:40px; overflow:hidden; background-color:#18b4ed; color:#FFFFFF;}
.btb:active {width:100%; font-size:18px; text-align:center; line-height:40px; height:40px; overflow:hidden; background-color:#0ba4dc; color:#FFFFFF;}
.cw2 {width:100%;}
.cw3 {width:100%; margin-top:15px;}
.cw4 {width:90%; padding-top:15px; margin:0px auto;}
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
</style></head>
<script>
    document.addEventListener('touchstart',function(){},false);
</script>
<body>
<div class="bx">
	<div class="bx2">
		<div class="bx3"><img src="{pigcms{$static_path}images/bx1.jpg" style="width:100%; height:auto;" /></div>
		<div class="bx4">请选择您要报修的类别</div>
		<div style="clear:both;"></div>
	</div>
</div>
<div class="cw">
	<div class="cw2">
		<div class="weui_cell weui_cell_select">
                <div class="weui_cell_bd weui_cell_primary">
                    <select class="weui_select" name="select1" style="border:1px #d4d4d4 solid; background-color:#FFFFFF; border-radius:0;">
                        <option selected="" value="1">有偿报修</option>
                        <option value="2">无偿报修</option>
                        <option value="3">查看进度</option>
                    </select>
                </div>
            </div>
	</div>
	<div class="cw3">
		<div class="weui_cell weui_cell_select">
                <div class="weui_cell_bd weui_cell_primary">
                    <select class="weui_select" name="select1" style="border:1px #d4d4d4 solid; background-color:#FFFFFF; border-radius:0; color:#8f8f8f;">
                        <option selected="" value="1">灯具</option>
                        <option value="2">开关插座</option>
                        <option value="3">线路</option>
						<option value="4">锁具</option>
						<option value="5">给排水及洁具</option>
						<option value="6">设备电气维修</option>
						<option value="7">其他</option>
                    </select>
                </div>
            </div>
	</div>
	<div class="cw3"><div class="btb">点击查询</div></div>
</div>
<div class="geq">
	<div class="ty2">
		<div style="float:left;"><img src="{pigcms{$static_path}images/fw2.jpg" style="width:5px; height:auto;" /></div>
		<div style="float:left; padding-left:8px; color:#000000; font-size:18px; font-weight:bold; line-height:20px;">锁具</div>
		<div style="clear:both"></div>
	</div>
	<div class="geq2">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td width="50%" height="40" align="center" bgcolor="#f1f1f1" style="border:1px #d3d4d6 solid; color:#333333;">服务项目</td>
			<td width="50%" height="40" align="center" bgcolor="#f1f1f1" style="border:1px #d3d4d6 solid; border-left:none; color:#333333;">价格</td>
		  </tr>
		  <tr>
			<td height="40" align="center" bgcolor="#f8f9fb" style="border:1px #d3d4d6 solid; border-top:none; color:#676767; font-size:14px;">维修、加装暗锁</td>
			<td height="40" align="center" bgcolor="#f8f9fb" style="border:1px #d3d4d6 solid; border-left:none; border-top:none; color:#676767; font-size:14px;">¥ 80</td>
		  </tr>
		  <tr>
			<td height="40" align="center" bgcolor="#f8f9fb" style="border:1px #d3d4d6 solid; border-top:none; color:#676767; font-size:14px;">维修、更换球形锁</td>
			<td height="40" align="center" bgcolor="#f8f9fb" style="border:1px #d3d4d6 solid; border-left:none; border-top:none; color:#676767; font-size:14px;">¥ 30</td>
		  </tr>
		  <tr>
			<td height="40" align="center" bgcolor="#f8f9fb" style="border:1px #d3d4d6 solid; border-top:none; color:#676767; font-size:14px;">维修、更换抽屉锁<br /></td>
			<td height="40" align="center" bgcolor="#f8f9fb" style="border:1px #d3d4d6 solid; border-left:none; border-top:none; color:#676767; font-size:14px;">¥ 30</td>
		  </tr>
		  <tr>
			<td height="40" align="center" bgcolor="#f8f9fb" style="border:1px #d3d4d6 solid; border-top:none; color:#676767; font-size:14px;">维修、更换串联式柜抽屉锁<br /></td>
			<td height="40" align="center" bgcolor="#f8f9fb" style="border:1px #d3d4d6 solid; border-left:none; border-top:none; color:#676767; font-size:14px;">¥ 30</td>
		  </tr>
		  <tr>
			<td height="40" align="center" bgcolor="#f8f9fb" style="border:1px #d3d4d6 solid; border-top:none; color:#676767; font-size:14px;">维修、更换玻璃门地簧<br /></td>
			<td height="40" align="center" bgcolor="#f8f9fb" style="border:1px #d3d4d6 solid; border-left:none; border-top:none; color:#676767; font-size:14px;">¥ 150</td>
		  </tr>
		  <tr>
			<td height="40" align="center" bgcolor="#f8f9fb" style="border:1px #d3d4d6 solid; border-top:none; color:#676767; font-size:14px;">维修、更换玻璃门门锁<br /></td>
			<td height="40" align="center" bgcolor="#f8f9fb" style="border:1px #d3d4d6 solid; border-left:none; border-top:none; color:#676767; font-size:14px;">¥ 30</td>
		  </tr>
	  </table>
	</div>
</div>
<div class="ty4">
	<div class="ty2">
		<div style="float:left;"><img src="{pigcms{$static_path}images/fw2.jpg" style="width:5px; height:auto;" /></div>
		<div style="float:left; padding-left:8px; color:#000000; font-size:18px; font-weight:bold; line-height:20px;">报修说明</div>
		<div style="clear:both"></div>
	</div>
	<div class="geq3">
	  <p>1、以上维修收费只含辅材，材料费另计；<br />
	    2、以上维修收费不包括开辟检修空间及还原的费用；<br />
		3、如需提供材料，将在材料单价上加收10%采购费；<br />
		4、材料费以市场价格而定； <br />
	    5、未列入以上有偿服务清单的项目其价格双方协商约定。
	  </p>
    </div>
</div>
<div style="width:100%; height:60px; text-align:center; line-height:60px; color:#8a8a8a; font-size:14px;">汇得行控股（中国）有限公司</div>
</body>