<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
    <title>预约公共会议室</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" >  
    <meta content="Preview page of Metronic Admin Theme #4 for bootstrap inputs, input groups, custom checkboxes and radio controls and more" name="description" />
    <meta content="" name="author" />
    <link href="{pigcms{$static_path}test/style.css" rel="stylesheet" type="text/css" />
	<link href="{pigcms{$static_path}test/weui.css" rel="stylesheet" type="text/css" />
	<link href="{pigcms{$static_path}test/weui2.css" rel="stylesheet" type="text/css" />
	<script src="{pigcms{$static_path}test/zepto.min.js"></script>
	<script src="{pigcms{$static_path}test/picker.js"></script>
	<script src="{pigcms{$static_path}test/swipe.js"></script>

	<script>
  $(function(){

$("#time").datetimePicker({title:"选择日期时间",min:'2015-12-10',max:'2050-10-01'});

$("#time2").datetimePicker({title:"选择日期时间",min:'2015-12-10',max:'2050-10-01'});

	  
	  });  
	  
	   $(function(){
$('#slide1').swipeSlide({
autoSwipe:true,//自动切换默认是
speed:3000,//速度默认4000
continuousScroll:true,//默认否
transitionType:'cubic-bezier(0.22, 0.69, 0.72, 0.88)',//过渡动画linear/ease/ease-in/ease-out/ease-in-out/cubic-bezier
lazyLoad:true,//懒加载默认否
firstCallback : function(i,sum,me){
            me.find('.dot').children().first().addClass('cur');
        },
        callback : function(i,sum,me){
            me.find('.dot').children().eq(i).addClass('cur').siblings().removeClass('cur');
        }
});

$('#slide2').swipeSlide({
autoSwipe:true,//自动切换默认是
speed:3000,//速度默认4000
continuousScroll:true,//默认否
transitionType:'cubic-bezier(0.22, 0.69, 0.72, 0.88)',//过渡动画linear/ease/ease-in/ease-out/ease-in-out/cubic-bezier
lazyLoad:true,//懒加载默认否
firstCallback : function(i,sum,me){
            me.find('.dot').children().first().addClass('cur');
        },
        callback : function(i,sum,me){
            me.find('.dot').children().eq(i).addClass('cur').siblings().removeClass('cur');
        }
});
$('#slide3').swipeSlide({
autoSwipe:true,//自动切换默认是
speed:3000,//速度默认4000
continuousScroll:true,//默认否
transitionType:'ease-in'
});

	  
	  });    
    
         
      </script>

<style type="text/css">

.zk {width:100%; position:relative; overflow:hidden;}
.zk2 {width:20%; position:relative; left:70%; top:-39px;}
.ty2 {width:95%; margin-left:5%; padding-top:20px;}
.ty4 {width:100%; margin-top:25px; -webkit-box-shadow: 0px 0px 6px #e9e9e9; background-color:#FFFFFF;}
.tyx {width:100%; -webkit-box-shadow: 0px 0px 6px #e9e9e9; background-color:#FFFFFF; margin-top:-80px;}
.ty3 {width:100%; padding-top:20px; margin:0px auto;}
.tk {width:40%; margin-left:5%; margin-right:5%; float:left; margin-bottom:15px;}
.tk2 {width:100%; margin:0px auto;}
.tk3 {width:100%; height:30px; line-height:30px; overflow:hidden; text-align:center; color:#a1a1a8;}
.fre {width:90%; padding-top:12px; margin:0px auto; line-height:2; color:#84848a; padding-bottom:20px;}
.weui_cells:before {
    content: " ";
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 1px;
    border-top:none;
    color: #D9D9D9;
    -webkit-transform-origin: 0 0;
    transform-origin: 0 0;
    -webkit-transform: scaleY(0.5);
    transform: scaleY(0.5);
}
.weui_cells {
    margin-top: 5px;
    background-color: #FFFFFF;
    line-height: 1.41176471;
    font-size: 16px;
    overflow: hidden;
    position: relative;
	color:#999999;
}
.weui_cell:before {
    border-top:none;
}
.weui_cell {
    padding: 10px 5%;
	width:90%;
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
.btb {width:100%; font-size:18px; text-align:center; line-height:50px; height:50px; overflow:hidden; background-color:#18b4ed; color:#FFFFFF;}
.btb:active {width:100%; font-size:18px; text-align:center; line-height:50px; height:50px; overflow:hidden; background-color:#0ba4dc; color:#FFFFFF;}
.zxr {width:80px; font-size:14px; text-align:center; line-height:30px; height:30px; overflow:hidden; background-color:#18b4ed; color:#FFFFFF; border-radius:4px; float:right; margin-top:2px;}
.zxr:active {background-color:#0ba4dc;}
</style></head>
<script>
    document.addEventListener('touchstart',function(){},false);
</script>
<body>
<div class="zk">
	
	<div class="slide" id="slide1">
    <ul>
        <li>
            <a href="#">
                <img src="{pigcms{$static_path}images/room1.jpg" style="width:100%;"/>
            </a>
        </li>
        <li>
            <a href="#">
                <img src="{pigcms{$static_path}images/room3.jpg" style="width:100%;"/>
            </a>
        </li>
    </ul>
    <div class="dot">
        <span></span>
        <span></span>
    </div>
</div>

</div>
<div class="zk2"><img src="{pigcms{$static_path}images/room2.png" style="width:100%;" /></div>
<div class="tyx">
	<div class="ty2">
		<div style="float:left;"><img src="{pigcms{$static_path}images/fw2.jpg" style="width:5px; height:auto;" /></div>
		<div style="float:left; padding-left:8px; color:#000000; font-size:18px; font-weight:bold; line-height:20px;">公共会议室</div>
		<div style="clear:both"></div>
	</div>
	<div class="fre">
		价格：500元/小时，24F公共会议室最多可容纳 60人，会议设备利用高清视频及高质音频设备，实时传递会议召开内容，提高公司运行效率。
		<a href="tel:027-85882377"><div class="zxr">咨询热线</div></a>
		<div style="clear:both"></div>
	</div>
</div>

<div class="ty4">
	<div class="ty2">
		<div style="float:left;"><img src="{pigcms{$static_path}images/fw2.jpg" style="width:5px; height:auto;" /></div>
		<div style="float:left; padding-left:8px; color:#000000; font-size:18px; font-weight:bold; line-height:20px;">预约会议室</div>
		<div style="clear:both"></div>
	</div>
	<div class="weui_cells weui_cells_form">
        <div class="weui_cells weui_cells_form">
        <div class="weui_cell">
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="text" required="" placeholder="请填写您的姓名">
            </div>
        </div>
        
    </div>
	
		 <div class="weui_cells weui_cells_form">
		<div class="weui_cell">
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="tel" required="" pattern="[0-9]{11}" maxlength="11" placeholder="请填写您的电话号码">
            </div>
        </div>
		</div>
	
		<div class="weui_cells weui_cells_form">
		<div class="weui_cell">
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="text" value="" id='time' placeholder="请选择您要预约的起始时间"/>
            </div>
        </div>
		</div>
		
		<div class="weui_cells weui_cells_form">
		<div class="weui_cell">
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="text" value="" id='time2' placeholder="请选择您要预约的截止时间"/>
            </div>
        </div>
		</div>
		
    
	<div class="weui_cells weui_cells_form">
            <div class="weui_cell">
                <div class="weui_cell_bd weui_cell_primary">
                    <textarea id="textarea" class="weui_textarea" placeholder="备注" rows="4"></textarea>
                </div>
            </div>
  </div>
	<a href="#"><div class="btb">提交预约</div></a>
</div></div>
<div style="width:100%; height:60px; text-align:center; line-height:60px; color:#8a8a8a; font-size:14px;">汇得行控股（中国）有限公司武汉广发银行大厦</div>
</body>