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
    <link href="{pigcms{$static_path}kid/style.css" rel="stylesheet" type="text/css" />
	<link href="{pigcms{$static_path}kid/weui.css" rel="stylesheet" type="text/css" />
	<link href="{pigcms{$static_path}kid/weui2.css" rel="stylesheet" type="text/css" />
	<script src="{pigcms{$static_path}kid/zepto.min.js"></script>
	<script src="{pigcms{$static_path}kid/swipe.js"></script>
	<script>
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
   
   //变色
   $(document).ready(function(){
   		$('.lat .lat2').click(function(){
			 var el  =  $(this).find('.lat4 , .lat4_blue');
			 $('.lat .lat4_blue').addClass('lat4');
			 $('.lat .lat4_blue').removeClass('lat4_blue');
			 
			 $(el).addClass('lat4_blue');
			 $(el).removeClass('lat4');
			 
			
			$(el).parents('.lat').find('img').each(function(){
					var src = $(this).attr('src');
					src = src.replace('_blue.jpg','.jpg');
					$(this).attr('src',src);
			});
			var img = $(el).parents('.lat2').find('.lat3').find('img').attr('src');
			img = img.replace('.jpg','_blue.jpg');
			$(el).parents('.lat2').find('.lat3').find('img').attr('src',img);
			 
   		});
   
   });
   
   
   
      </script>

<style type="text/css">
	.ss {width:90%; margin:0px auto; padding-top:12px;}
	.ssx {width:100%; margin:0px auto; padding-top:12px;}
	.both {clear:both;}
	.s1 {width:5%; float:left;}
	.s2 {width:81%; float:left; margin-left:4%; background-color:#FFFFFF; line-height:2; border-radius:2px;}
	.s3 {width:6%; float:right;}
	.xf {width:5%; float:left; margin-left:4%;}
	.xf2 {width:83%; float:left; margin-left:4%;}
	.db {width:100%; background-color:#FFFFFF; box-shadow:1px 1px 5px #dfdfdf;}
	.tm {width:100%; height:40px; overflow:hidden; border-bottom:0.8px #dfdfdf solid;}
	.db2 {width:100%; background-color:#FFFFFF; box-shadow:1px 1px 5px #dfdfdf; margin-top:25px;}
	.tm2 {width:100%; height:40px; overflow:hidden;}
	.jk {width:90%; margin:0px auto;}
	.im {width:4%; float:left; padding-top:13px;}
	.im2 {width:75%; float:left; line-height:40px; color:#a1a1a8; margin-left:3%;}
	.im3 {width:15%; float:right; line-height:40px; color:#a1a1a8; font-size:14px; text-align:right;}
	.im4 {width:90%; float:left; line-height:40px; color:#a1a1a8; margin-left:3%;}
	.dht {width:100%; margin:0px auto; padding-bottom:10px;}
	.dht2 {width:25%; float:left; padding-top:20px;}
	.dht3 {width:50%; margin:0px auto;}
	.dht4 {width:100%; text-align:center; line-height:35px; color:#97979f; font-size:14px;}
	.txff:link{color:#a1a1a8; text-decoration:none;}
	.txff:visited{color:#a1a1a8; text-decoration:none;}
	.txff:active{color:#a1a1a8; text-decoration:none;}
	.txff:hover{color:#a1a1a8; text-decoration:none;}
	.banner {width:100%; margin-top:25px;}
	.fe1 {width:100%; margin-top:25px; height:auto; background:url({pigcms{$static_path}images/fe1.jpg) repeat-x; background-size:100% 100%;}
	.fe2 {width:34%; float:left;}
	.fe3 {width:63.5%; float:right;}
	.qk {width:100%;}
	.hh {width:100%; background-color:#FFFFFF; box-shadow:1px 1px 5px #dfdfdf;}
	.hh2 {width:100%; height:45px; overflow:hidden; line-height:45px; text-align:center; color:#000000; font-size:18px;}
	.hh3 {width:50.1%; float:left;}
	.hh4 {width:49.9%; float:left;}
	.lat {width:100%; position:fixed; bottom:0; border-top:1px #dfdfdf solid; background-color:#FFFFFF;}
	.lat2 {width:20%; float:left; padding-top:5px; padding-bottom:1px;}
	.lat3 {width:27px; margin:0px auto;}
	.lat4 {width:100%; height:25px; line-height:25px; overflow:hidden; text-align:center; color:#9c9c9c; font-size:12px;}
	.lat4_blue {width:100%; height:25px; line-height:25px; overflow:hidden; text-align:center; color:#0697dc; font-size:12px;}
	.lat5 {width:55%; margin:0px auto;}
	.slide .dot {
			position: absolute;
			left:48%;
			bottom: 35px;
			z-index: 5;
			font-size: 0;
		}
	.slide .dot .cur {
    background-color: #0697dc;
    border: 1px solid #0697dc;
}
	.weui_cellss {
    margin-top: 0px;
    background-color: #FFFFFF;
    line-height:40px;
    font-size: 14px;
    overflow: hidden;
    position: relative;
}
	.weui_cell_selects .weui_select {
    padding-right: 0px;
}
	.weui_select {
    -webkit-appearance: none;
    border: 0;
    outline: 0;
    background-color: transparent;
    width: 100%;
    font-size: inherit;
    height: 40px;
    line-height: 40px;
    position: relative;
    z-index: 1;
    padding-left: 15px;
}
select{
            color: #a1a1a8;
        }
</style>
</head>
<script>
    document.addEventListener('touchstart',function(){},false);
</script>
<body>
<div class="ss">
	<div class="s1"><img src="{pigcms{$static_path}images/xfl.png" style="width:100%; height:auto; margin-top:7px;" /></div>
	<div class="s2">
		<div class="xf"><img src="{pigcms{$static_path}images/xfdj.jpg" style="width:100%; height:auto; margin-top:9px;" /></div>
		<div class="xf2"><input name="" type="text" placeholder="请输入您想找的内容" style="border:none; width:100%; font-size:16px; line-height:2; color:#8e8e8e;"/></div>
		<div class="both"></div>
	</div>
	<div class="s3"><img src="{pigcms{$static_path}images/xsm.png" style="width:100%; height:auto; margin-top:5px;" /></div>
	<div class="both"></div> 
</div>
<div class="ssx">
<div class="slide" id="slide1">
    <ul>
        <li>
            <a href="#">
                <img src="{pigcms{$static_path}images/bannerx.png" style="width:100%; height:auto;" />
            </a>
        </li>
        <li>
            <a href="#">
                <img src="{pigcms{$static_path}images/bannerx2.png" style="width:100%; height:auto;" />
            </a>
        </li>
    </ul>
	<div class="dot">
        <span></span>
        <span></span>
    </div>

</div>
</div>
<div class="db">
	<div class="tm">
		<div class="jk">
			<div class="im"><img src="{pigcms{$static_path}images/tb1.jpg" style="width:100%; height:auto;" /></div>
			<div class="im2">广发银行大厦</div>
			<div class="im3">
			
			<div class="weui_cellss">
				<div class="weui_cell weui_cell_selects">
                <div class="weui_cell_bd weui_cell_primary">
                    <select class="weui_select" name="select1">
						<option value="" selected="true" disabled="true">[切换]</option>
                        <option value="1">广发银行大厦</option>
                        <option value="2">浦发银行大厦</option>
                    </select>
                </div>
            </div>
       	   </div> 
			
			</div>
			<div class="both"></div>
		</div>
	</div>
	<div class="dht">
		<a href="#"><div class="dht2">
			<div class="dht3"><img src="{pigcms{$static_path}images/tb2.jpg" style="width:100%; height:auto;" /></div>
			<div class="dht4">智能门禁</div>
		</div></a>
		<a href="#"><div class="dht2">
			<div class="dht3"><img src="{pigcms{$static_path}images/tb3.jpg" style="width:100%; height:auto;" /></div>
			<div class="dht4">停车缴费</div>
		</div></a>
		<a href="#"><div class="dht2">
			<div class="dht3"><img src="{pigcms{$static_path}images/tb4.jpg" style="width:100%; height:auto;" /></div>
			<div class="dht4">员工食堂</div>
		</div></a>
		<a href="#"><div class="dht2">
			<div class="dht3"><img src="{pigcms{$static_path}images/tb5.jpg" style="width:100%; height:auto;" /></div>
			<div class="dht4">收发快递</div>
		</div></a>
		<a href="#"><div class="dht2">
			<div class="dht3"><img src="{pigcms{$static_path}images/tb6.jpg" style="width:100%; height:auto;" /></div>
			<div class="dht4">外卖</div>
		</div></a>
		<a href="#"><div class="dht2">
			<div class="dht3"><img src="{pigcms{$static_path}images/tb7.jpg" style="width:100%; height:auto;" /></div>
			<div class="dht4">下午茶</div>
		</div></a>
		<a href="#"><div class="dht2">
			<div class="dht3"><img src="{pigcms{$static_path}images/tb8.jpg" style="width:100%; height:auto;" /></div>
			<div class="dht4">美发造型</div>
		</div></a>
		<a href="#"><div class="dht2">
			<div class="dht3"><img src="{pigcms{$static_path}images/tb9.jpg" style="width:100%; height:auto;" /></div>
			<div class="dht4">热门活动</div>
		</div></a>
		<div class="both"></div>
	</div>
</div>
<div class="banner"><img src="{pigcms{$static_path}images/banner.jpg" style="width:100%; height:auto;" /></div>
<div class="db2">
	<div class="tm2">
		<div class="jk">
			<div class="im"><img src="{pigcms{$static_path}images/kw.jpg" style="width:100%; height:auto;" /></div>
			<div class="im4">广发大厦智慧停车场缴费系统上线啦！</div>
			<div class="both"></div>
		</div>
	</div>
</div>
<div class="fe1">
	<div class="fe2">
		<div class="qk"><a href="http://demo.hdhsmart.cn/wap.php?g=Wap&c=Express&a=test"><img src="{pigcms{$static_path}images/fe2.jpg" style="width:100%; height:auto;" /></a></div>
		<div class="qk"><img src="{pigcms{$static_path}images/fe3.jpg" style="width:100%; height:auto;" /></div>
	</div>
	<div class="fe3">
		<div class="qk"><a href="http://demo.hdhsmart.cn/wap.php?g=Wap&c=Express&a=test3"><img src="{pigcms{$static_path}images/fe4.jpg" style="width:100%; height:auto;" /></a></div>
		<div class="qk"><img src="{pigcms{$static_path}images/fe5.jpg" style="width:100%; height:auto;" /></div>
		<div class="qk">
			<div style="width:51%; float:left;"><img src="{pigcms{$static_path}images/fe6.jpg" style="width:100%; height:auto;" /></div>
			<div style="width:49%; float:left;"><a href="http://demo.hdhsmart.cn/wap.php?g=Wap&c=Express&a=test2"><img src="{pigcms{$static_path}images/fe7.jpg" style="width:100%; height:auto;" /></a></div>
			<div class="both"></div>
		</div>
	</div>
	<div class="both"></div>
</div>
<div style="width:100%; height:20px; overflow:hidden; background-color:#eff8ff;"></div>
<div class="hh">
	<div class="hh2">企业服务</div>
	<div class="qk">
		<div class="hh3"><a href="http://www.hdhsmart.com/wap.php?g=Wap&c=Food&a=menu&mer_id=41&store_id=28"><img src="{pigcms{$static_path}images/c1.jpg" style="width:100%; height:auto;" /></a></div>
		<div class="hh4"><a href="http://www.hdhsmart.com/wap.php?g=Wap&c=Food&a=menu&mer_id=41&store_id=30"><img src="{pigcms{$static_path}images/c2.jpg" style="width:100%; height:auto;" /></a></div>
		<div class="hh3"><a href="http://www.hdhsmart.com/wap.php?g=Wap&c=Food&a=menu&mer_id=41&store_id=29"><img src="{pigcms{$static_path}images/c3.jpg" style="width:100%; height:auto;" /></a></div>
		<div class="hh4"><img src="{pigcms{$static_path}images/c4.jpg" style="width:100%; height:auto;" /></div>
		<div class="hh3"><img src="{pigcms{$static_path}images/c5.jpg" style="width:100%; height:auto;" /></div>
		<div class="hh4"><img src="{pigcms{$static_path}images/c6.jpg" style="width:100%; height:auto;" /></div>
		<div class="hh3"><img src="{pigcms{$static_path}images/c7.jpg" style="width:100%; height:auto;" /></div>
		<div class="hh4"><a href="http://www.hdhsmart.com/wap.php?g=Wap&c=Food&a=menu&mer_id=41&store_id=31"><img src="{pigcms{$static_path}images/c8.jpg" style="width:100%; height:auto;" /></a></div>
		<div class="both"></div>
	</div>
</div>
<div style="width:100%; height:56px; overflow:hidden;"></div>
<div class="lat">
	<div class="lat2">
		<div class="lat3"><img src="{pigcms{$static_path}images/ff1_blue.jpg" style="width:100%; height:auto;" /></div>
		<div class="lat4_blue">首页</div>
	</div>
	<div class="lat2">
		<div class="lat3"><img src="{pigcms{$static_path}images/ff2.jpg" style="width:100%; height:auto;" /></div>
		<div class="lat4">商户</div>
	</div>
	<div class="lat2">
		<div class="lat5"><img src="{pigcms{$static_path}images/mkf.jpg" style="width:41px; height:auto; margin-top:3px;" /></div>
	</div>
	<div class="lat2">
		<div class="lat3"><img src="{pigcms{$static_path}images/ff3.jpg" style="width:100%; height:auto;" /></div>
		<div class="lat4">活动</div>
	</div>
	<div class="lat2">
		<div class="lat3"><img src="{pigcms{$static_path}images/ff4.jpg" style="width:100%; height:auto;" /></div>
		<div class="lat4">我的</div>
	</div>
	<div class="both"></div>
</div>
</body>