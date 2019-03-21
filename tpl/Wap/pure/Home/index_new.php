<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8" />
	<title>{pigcms{$Think.config.WEB_TITLE}</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" >
	<meta content="Preview page of Metronic Admin Theme #4 for bootstrap inputs, input groups, custom checkboxes and radio controls and more" name="description" />
	<meta content="" name="author" />
	<link href="{pigcms{$static_path}kid/style.css" rel="stylesheet" type="text/css" />
	<link href="{pigcms{$static_path}kid/weui.css" rel="stylesheet" type="text/css" />
	<link href="{pigcms{$static_path}kid/weui.min.css" rel="stylesheet" type="text/css" />
	<link href="{pigcms{$static_path}kid/weui2.css" rel="stylesheet" type="text/css" />
	<script src="{pigcms{$static_path}kid/zepto.min.js"></script>
	<script src="{pigcms{$static_path}kid/swipe.js"></script>
	<script type="text/javascript" src="{pigcms{$static_path}js/index_new.js?211" charset="utf-8"></script>
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
		/*$(document).ready(function(){
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

		});*/



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
		.fe2 {width:33.8%; float:left;}
		.fe3 {width:63%; float:right;}
		.qk {width:100%;}
		.hh {width:100%; background-color:#FFFFFF; box-shadow:1px 1px 5px #dfdfdf;}
		.hh2 {width:100%; height:45px; overflow:hidden; line-height:45px; text-align:center; color:#000000; font-size:18px;}
		.hh3 {width:50%; float:left; box-sizing:border-box;}
		.hh3:nth-child(1) {border:1px #ececec solid; border-left:none;}
		.hh3:nth-child(2) {border:1px #ececec solid; border-left:none;}
		.hh3:nth-child(n+3) {border:1px #ececec solid; border-left:none; border-top:none;}
		.lat {width:100%; position:fixed; bottom:0; border-top:1px #dfdfdf solid; background-color:#FFFFFF; z-index:2;}
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
		#pullUp {
			height: 0px;
			line-height: 0px;
			text-align: center;
			width: 35%;
			z-index:1;
			bottom:-10px;
			position:relative;
		}
	</style>
</head>
<script>
	document.addEventListener('touchstart',function(){},false);
</script>
<body>
<if condition="in_array('ds',$main_construction)">
	<!-- 顶部搜索栏 ds  start -->
	<div class="ss">
		<div class="s1"><img src="{pigcms{$static_path}images/xfl.png" style="width:100%; height:auto; margin-top:7px;" /></div>
		<a href="{pigcms{:U('Search/index')}">
			<div class="s2">
				<div class="xf"><img src="{pigcms{$static_path}images/xfdj.jpg" style="width:100%; height:auto; margin-top:9px;" /></div>
				<div class="xf2"><input name="" type="text" placeholder="请输入您想找的内容" style="border:none; width:100%; font-size:16px; line-height:2; color:#8e8e8e;"/></div>
				<div class="both"></div>
			</div>
		</a>
		<div class="s3" id="qrcodeBtn"><img src="{pigcms{$static_path}images/xsm.png" style="width:100%; height:auto; margin-top:5px;" /></div>
		<div class="both"></div>
	</div>
	<!-- 顶部搜索栏  end -->
</if>
<if condition="in_array('dp',$main_construction)">
	<!-- 顶部轮播栏  start -->
	<div class="ssx">
		<div class="slide" id="slide1">
			<ul>
				<empty name="children_construction['dp']">
					<li>
						<a href="#">
							<img src="{pigcms{$static_path}images/hdh.jpg" style="width:100%; height:auto;" />
						</a>
					</li>
				</empty>
				<foreach name="children_construction['dp']" item="vo">
					<li>
						<a href="{pigcms{$vo.url}">
							<img src="{pigcms{$config.site_url}/upload/adver/{pigcms{$vo.pic}" style="width:100%; height:auto;" />
						</a>
					</li>
				</foreach>

			</ul>
			<div class="dot">
				<span></span>
				<span></span>
			</div>

		</div>
	</div>
	<!-- 顶部轮播栏  end -->
</if>
<if condition="in_array('si',$main_construction)">
	<!-- 上部图标导航  start -->
	<div class="db">
		<div class="tm">
			<div class="jk">
				<div class="im"><img src="{pigcms{$static_path}images/tb1.jpg" style="width:100%; height:auto;" /></div>
				<div class="im2">{pigcms{$village_name}</div>
				<div class="im3">

					<div class="weui_cellss">
						<div class="weui_cell weui_cell_selects">
							<div class="weui_cell_bd weui_cell_primary">
								<!-- <span id="showIOSActionSheet">[切换]</span> -->
								<select class="weui_select" name="select1" id="village_change">
									<option value="0" selected="true" disabled="true">[切换]</option>
									<foreach name="village_array" item="vo">
										<option value="{pigcms{$vo.village_id}">{pigcms{$vo.village_name}</option>
									</foreach>
								</select>
							</div>
						</div>
					</div>

				</div>
				<div>
					<div class="weui-mask" id="iosMask" style="display: none"></div>
					<div class="weui-actionsheet" id="iosActionsheet">
						<div class="weui-actionsheet__menu">
							<foreach name="village_array" item="vo">
								<div  class="weui-actionsheet__cell" id="{pigcms{$vo.village_id}" onclick="siteUrl(this)">{pigcms{$vo.village_name}</div>

							</foreach>
						</div>
						<div class="weui-actionsheet__action">
							<div class="weui-actionsheet__cell" id="iosActionsheetCancel">取消</div>
						</div>
					</div>
				</div>
				<div class="both"></div>
			</div>
		</div>
		<div class="dht">
			<empty name="children_construction['si']">
				<for start="0" end="8">
					<a href="#"><div class="dht2">
							<div class="dht3"><img src="{pigcms{$static_path}images/hdh.jpg" style="width:100%; height:auto;" /></div>
							<div class="dht4">请添加内容</div>
						</div></a>
				</for>
			</empty>
			<foreach name="children_construction['si']" item="vo">
				<a href="{pigcms{$vo.url}&village_id={pigcms{$village_id}"><div class="dht2">
						<div class="dht3"><img src="{pigcms{$config.site_url}/upload/adver/{pigcms{$vo.pic}" style="width:100%; height:auto;" /></div>
						<div class="dht4">{pigcms{$vo.name}</div>
					</div></a>
			</foreach>
			<div class="both"></div>
		</div>
	</div>
	<!-- 上部图标导航  end -->
</if>
<if condition="in_array('zg',$main_construction)">
	<!-- 中部广告栏  start -->
	<empty name="children_construction['zg']">
		<div class="banner"><img src="{pigcms{$static_path}images/hdh.jpg" style="width:100%; height:auto;" /></div>
	</empty>
	<foreach name="children_construction['zg']" item="vo">
		<div class="banner"><img src="{pigcms{$config.site_url}/upload/adver/{pigcms{$vo.pic}" style="width:100%; height:auto;" /></div>
	</foreach>
	<!-- 中部广告栏  end -->
</if>
<div class="db2">
	<div class="tm2">
		<div class="jk">
			<div class="im"><img src="{pigcms{$static_path}images/kw.jpg" style="width:100%; height:auto;" /></div>
			<div class="im4">{pigcms{$zn_array.title}</div>
			<div class="both"></div>
		</div>
	</div>
</div>
<if condition="in_array('xm',$main_construction) and $village_info['village_type'] neq 1 and $village_id neq 14">
	<!-- 下部图片服务栏  start -->

	<div class="fe1">
		<div class="fe2">
			<if condition="$children_construction['xm'][0] eq null">
				<div class="qk"><a href="#"><img src="{pigcms{$static_path}images/hdh.jpg" style="width:100%; height:auto;" /></a></div>
			<else/>
				<div class="qk"><a href="{pigcms{$children_construction.xm.0.url}&village_id={pigcms{$village_id}"><img src="{pigcms{$config.site_url}/upload/adver/{pigcms{$children_construction.xm.0.pic}" style="width:100%; height:auto;" /></a></div>
			</if>
			<if condition="$children_construction['xm'][3] eq null">
				<div class="qk"><a href="#"><img src="{pigcms{$static_path}images/hdh.jpg" style="width:100%; height:auto;" /></a></div>
				<else/>
				<div class="qk"><a href="{pigcms{$children_construction.xm.3.url}&village_id={pigcms{$village_id}"><img src="{pigcms{$config.site_url}/upload/adver/{pigcms{$children_construction.xm.3.pic}" style="width:100%; height:auto;" /></a></div>
			</if>
		</div>
		<div class="fe3">
			<if condition="$children_construction['xm'][2] eq null">
				<div class="qk"><a href="#"><img src="{pigcms{$static_path}images/hdh.jpg" style="width:100%; height:auto;" /></a></div>
				<else/>
				<div class="qk"><a href="{pigcms{$children_construction.xm.2.url}&village_id={pigcms{$village_id}"><img src="{pigcms{$config.site_url}/upload/adver/{pigcms{$children_construction.xm.2.pic}" style="width:100%; height:auto;" /></a></div>
			</if>
			<if condition="$children_construction['xm'][1] eq null">
				<div class="qk"><a href="#"><img src="{pigcms{$static_path}images/hdh.jpg" style="width:100%; height:auto;" /></a></div>
				<else/>
				<div class="qk"><a href="{pigcms{$children_construction.xm.1.url}&village_id={pigcms{$village_id}"><img src="{pigcms{$config.site_url}/upload/adver/{pigcms{$children_construction.xm.1.pic}" style="width:100%; height:auto;" /></a></div>
			</if>

			<div class="qk">
				<if condition="$children_construction['xm'][4] eq null">
					<div class="qk"><a href="#"><img src="{pigcms{$static_path}images/hdh.jpg" style="width:100%; height:auto;" /></a></div>
					<else/>
					<div style="width:51%; float:left;"><a href="{pigcms{$children_construction.xm.4.url}&village_id={pigcms{$village_id}"><img src="{pigcms{$config.site_url}/upload/adver/{pigcms{$children_construction.xm.4.pic}" style="width:100%; height:auto;" /></a></div>
				</if>
				<if condition="$children_construction['xm'][5] eq null">
					<div class="qk"><a href="#"><img src="{pigcms{$static_path}images/hdh.jpg" style="width:100%; height:auto;" /></a></div>
					<else/>
					<div style="width:49%; float:left;"><a href="{pigcms{$children_construction.xm.5.url}&village_id={pigcms{$village_id}"><img src="{pigcms{$config.site_url}/upload/adver/{pigcms{$children_construction.xm.5.pic}" style="width:100%; height:auto;" /></a></div>
				</if>

				<div class="both"></div>
			</div>
		</div>
		<div class="both"></div>
	</div>
	<!-- 下部图片服务栏  end -->
</if>
<div style="position:relative;">
<if condition="in_array('dq',$main_construction) and $village_info['village_type'] neq 1  and $village_id neq 14" >
	<div style="width:100%; height:20px; overflow:hidden; background-color:#eff8ff;"></div>
	<!-- 底部企业服务栏  start -->
	<div class="hh">
		<div class="hh2">企业服务</div>
		<div class="qk">
			<empty name="children_construction['dq']">
				<for start="0" end="8">
					<if condition="$key%2!=0">
						<div class="hh3"><a href="#"><img src="{pigcms{$static_path}images/hdh.jpg" style="width:100%; height:auto;" /></a></div>
					<else/>
						<div class="hh3"><a href="#"><img src="{pigcms{$static_path}images/hdh.jpg" style="width:100%; height:auto;" /></a></div>
					</if>
				</for>
			</empty>
				<foreach name="children_construction['dq']" item="vo" key="key">
					<!--<if condition="$key%2!=0">
						<div class="hh3"><a href="{pigcms{$vo.url}"><img src="{pigcms{$config.site_url}/upload/adver/{pigcms{$vo.pic}" style="width:100%; height:auto;" /></a></div>
						<else/>
						<div class="hh3"><a href="{pigcms{$vo.url}"><img src="{pigcms{$config.site_url}/upload/adver/{pigcms{$vo.pic}" style="width:100%; height:auto;" /></a></div>
					</if>-->
					<div class="hh3"><a href="{pigcms{$vo.url}"><img src="{pigcms{$config.site_url}/upload/adver/{pigcms{$vo.pic}" style="width:100%; height:auto;" /></a></div>
				</foreach>


			<div class="both"></div>
		</div>
	</div>
	<!-- 底部企业服务栏  end -->

</if>
</div>
	<div id="pullUp">
		<img src="{pigcms{$static_path}images/newlogo.png" style="width:auto;height:44px;"/>
	</div>
	<div style="height: 0px;line-height: 0px;text-align: center;width: 65%;z-index:1;position:relative; left:35%; top:42px; color:#bfbfbf; font-size:12px;">
		技术支持：武汉邻钱网络科技有限公司
	</div>
<if condition="in_array('dd',$main_construction)">
	<div style="width:100%; height:56px; overflow:hidden;"></div>
	<!-- 底部导航栏  start -->
	<div class="lat">
		<div class="lat2">
			<if condition="$children_construction['dd'][0] eq null">
				<div class="lat3"><img src="{pigcms{$static_path}images/hdh.jpg" style="width:100%; height:auto;" /></div>
				<div class="lat4_blue">请配置</div>
			<else/>
				<a href="{pigcms{$children_construction.dd.0.url}"><div class="lat3"><img src="{pigcms{$config.site_url}/upload/adver/{pigcms{$children_construction.dd.0.pic}" style="width:100%; height:auto;" /></div>
				<div class="lat4_blue">{pigcms{$children_construction.dd.0.name}</div></a>
			</if>
		</div>
		<div class="lat2">
			<if condition="$children_construction['dd'][1] eq null">
				<div class="lat3"><img src="{pigcms{$static_path}images/hdh.jpg" style="width:100%; height:auto;" /></div>
				<div class="lat4">请配置</div>
			<else/>
				<a href="{pigcms{$children_construction.dd.1.url}"><div class="lat3"><img src="{pigcms{$config.site_url}/upload/adver/{pigcms{$children_construction.dd.1.pic}" style="width:100%; height:auto;" /></div>
					<div class="lat4">{pigcms{$children_construction.dd.1.name}</div></a>
			</if>	
		</div>
		<div class="lat2">
			<div class="lat5"><img src="{pigcms{$static_path}images/mkf.jpg" style="width:41px; height:auto; margin-top:3px;" /></div>
		</div>
		<div class="lat2">
			<if condition="$children_construction['dd'][2] eq null">
				<div class="lat3"><img src="{pigcms{$static_path}images/hdh.jpg" style="width:100%; height:auto;" /></div>
				<div class="lat4">请配置</div>
			<else/>
				<a href="{pigcms{$children_construction.dd.2.url}"><div class="lat3"><img src="{pigcms{$config.site_url}/upload/adver/{pigcms{$children_construction.dd.2.pic}" style="width:100%; height:auto;" /></div>
				<div class="lat4">{pigcms{$children_construction.dd.2.name}</div></a>
			</if>	
		</div>
		<div class="lat2">
			<if condition="$children_construction['dd'][3] eq null">
				<div class="lat3"><img src="{pigcms{$static_path}images/hdh.jpg" style="width:100%; height:auto;" /></div>
				<div class="lat4">请配置</div>
			<else/>
				<a href="{pigcms{$children_construction.dd.3.url}"><div class="lat3"><img src="{pigcms{$config.site_url}/upload/adver/{pigcms{$children_construction.dd.3.pic}" style="width:100%; height:auto;" /></div>
					<div class="lat4">{pigcms{$children_construction.dd.3.name}</div></a>
			</if>	
		</div>
		<div class="both"></div>
	</div>
	<!-- 底部导航栏  end -->
</if>
<!-- 页面jq,js开始 -->
<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
<script>

	$("#village_change").change(function(){
		//$("#village_change option:first").remove();
		var village_id = $("#village_change").val();
		$("#village_change").hide();
		$("#s_show").show();
		window.location.href = '{pigcms{$Think.config.web_domain}/wap.php?&g=Wap&c=Home&a=index_new&village_id='+village_id;
	});

	// ios
	$(function(){
		var $iosActionsheet = $('#iosActionsheet');
		var $iosMask = $('#iosMask');

		function hideActionSheet() {
			$iosActionsheet.removeClass('weui-actionsheet_toggle');
			$iosMask.fadeOut(200);
		}

		$iosMask.on('click', hideActionSheet);
		$('#iosActionsheetCancel').on('click', hideActionSheet);
		$("#showIOSActionSheet").on("click", function(){
			$iosActionsheet.addClass('weui-actionsheet_toggle');
			$iosMask.fadeIn(200);
		});
	});


	/*跳转相应项目*/
	function siteUrl(ev) {
		var village_id = $(ev).attr('id');
		window.location.href = '{pigcms{$Think.config.web_domain}/wap.php?&g=Wap&c=Home&a=index_new&village_id='+village_id;
	}


	/*吊起二维码扫描功能*/
	$('#qrcodeBtn').click(function(){
		wx.scanQRCode({
			needResult: 0, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
			scanType: ["qrCode","barCode"], // 可以指定扫二维码还是一维码，默认二者都有
			success: function (res) {
				var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果

			}
		});
	});


</script>
<!-- 页面jq,js结束 -->
<script type="text/javascript">
	window.shareData = {
		"moduleName":"Home",
		"moduleID":"0",
		"imgUrl": "<if condition="$config['wechat_share_img']">{pigcms{$config.wechat_share_img}<else/>{pigcms{$config.site_logo}</if>",
		"sendFriendLink": "{pigcms{$config.site_url}{pigcms{:U('Home/index')}",
		"tTitle": "{pigcms{$config.site_name}",
		"tContent": "{pigcms{$config.seo_description}"
	};

</script>
{pigcms{$shareScript}
<script type="text/javascript">
	var village_state = '{pigcms{$v_state}';
	var v_id = "{pigcms{$Think.get.village_id}";
	wx.ready(function(){
		/*gps定位*/
		if(v_id == '' && village_state=='1'){

            var $iosActionsheet = $('#iosActionsheet');
            var $iosMask = $('#iosMask');

            function hideActionSheet() {
                $iosActionsheet.removeClass('weui-actionsheet_toggle');
                $iosMask.fadeOut(200);
            }

            $iosMask.on('click', hideActionSheet);
            $('#iosActionsheetCancel').on('click', hideActionSheet);
            $iosActionsheet.addClass('weui-actionsheet_toggle');
            $iosMask.fadeIn(200);
			// wx.getLocation({
			// 	type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
			// 	success: function (res) {
			// 		var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
			// 		var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
			// 		var speed = res.speed; // 速度，以米/每秒计
			// 		var accuracy = res.accuracy; // 位置精度
			// 		//传递经纬度到后台进行处理
			// 		$.ajax({
			// 			url:"{pigcms{:U('Home/check_gps_near_village')}",
			// 			type:'post',
			// 			data:{'long':longitude,'lat':latitude},
			// 			success:function(msg){
			// 				//直接跳转到最近的项目中
			// 				window.location.href = '{pigcms{$Think.config.web_domain}/wap.php?&g=Wap&c=Home&a=index_new&village_id='+msg;
            //
			// 			}
            //
			// 		});
			// 	}
			// });
		}

	});
</script>


</body>