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
	<script src="{pigcms{$static_path}test/zepto.min.js"></script>
	<script>
  $(function(){
$('.weui-number-plus').click(function(){
        upDownOperation( $(this) );
    });
    $('.weui-number-sub').click(function(){
        upDownOperation( $(this) );
    });
 
 //评分js
 var arr = ["1分","2分","3分","4分","5分"];
	var num = -1;
	$(".weui-rater a").mouseover(function(){
		var thisL = $(this).index();
		for(var i = 0;i < thisL;i++){
			$(".weui-rater a").eq(i).addClass('checked');
		}
		for(var i = thisL; i < 5;i++){
			$(".weui-rater a").eq(i).removeClass('checked');
		}
		$(this).addClass('checked');
	})
	$(".weui-rater a").mouseout(function(){
		var thisL = $(this).index();
		for(var i = thisL; i < 5;i++){
			$(".weui-rater a").eq(i).removeClass('checked');
		}
	})
	$(".weui-rater").mouseout(function(){
		
		for(var i = 0; i < num;i++){
			$(".weui-rater a").eq(i).addClass('checked');
		}
	})
  $(".weui-rater a").click(function(){
		var thisL = $(this).index();
		$("#fen").html(arr[thisL]);
		$(this).addClass('checked');
		num = thisL+1;
		console.log(num);
	})
	
 });      
      </script>

<style type="text/css">
.bx {width:100%; -webkit-box-shadow: 0px 0px 6px #e9e9e9; background-color:#FFFFFF;}
.bx2 {width:90%; margin:0px auto; padding:20px 0 20px 0;}
.ty {width:100%; margin-top:15px; -webkit-box-shadow: 0px 0px 6px #e9e9e9; background-color:#FFFFFF;}
.ty2 {width:95%; margin-left:5%; padding-top:20px;}
.ty4 {width:100%; margin-top:25px; -webkit-box-shadow: 0px 0px 6px #e9e9e9; background-color:#FFFFFF;}
.geq3 {width:90%; padding-top:15px; margin:0px auto; padding-bottom:15px; line-height:1.8; color:#878787; font-size:14px;}
.fo {width:80px; height:80px; overflow:hidden; border-radius:4px; float:left;}
.fo2 {width:70%; float:left; margin-left:5%;}
.k1 {width:100%; height:20px; line-height:20px; color:#333333; font-size:18px;}
.k2 {width:100%; height:40px; overflow:hidden;}
.kf {width:55%; float:left;}
.page-hd {
    padding:5px 0px 0px 0px;
}
.weui-rater-box {
    position: relative;
    margin-right: 2px;
    font-size: 15px;
    width: 15px;
    height: 15px;
    color: rgb(255, 204, 102);
}
.weui-rater a {line-height:15px;}
.weui-rater a {display:inline;}
.weui_cells_title {
    margin-top: 0px;
    margin-bottom: 0px;
    padding-left:0px;
    padding-right:0px;
    color: #ff6000;
    font-size: 14px;
}
.weui-rater a.checked {
    color: #ffaa0c!important;
    cursor: not-allowed;
}
</style></head>
<script>
    document.addEventListener('touchstart',function(){},false);
</script>
<body>
<div class="bx">
	<div class="bx2">
		<div style="width:100%;">
			<div class="fo"><img src="{pigcms{$static_path}images/tour/12.jpg" style="width:80px; height:80px;" /></div>
			<div class="fo2">
				<div class="k1">武汉大头仔餐饮管理有限公司</div>
				<div class="k2">
					<div class="kf">
						<div class="page-hd" style="float:left;">
							 <div class="weui-rater">
							  <a data-num = "0" class="weui-rater-box checked"> <span class="weui-rater-inner">★</span> </a>
							  <a data-num = "1" class="weui-rater-box"> <span class="weui-rater-inner">★</span> </a>
							  <a data-num = "2" class="weui-rater-box"> <span class="weui-rater-inner">★</span> </a>
							  <a data-num = "3" class="weui-rater-box"> <span class="weui-rater-inner">★</span> </a>
							  <a data-num = "4" class="weui-rater-box"> <span class="weui-rater-inner">★</span> </a>
							   </div>
							
							<div id='fen' class="weui_cells_title" style="float:right; line-height:16px; margin-left:5px;"></div>
						</div>

					</div>
					<div></div>
					<div style="clear:both"></div>
				</div>
				<div></div>
			</div>
			<div style="clear:both"></div>
		</div>
		<div></div>
		<div></div>
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