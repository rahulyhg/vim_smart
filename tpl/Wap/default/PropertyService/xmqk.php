<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>项目情况</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name='apple-touch-fullscreen' content='yes'>
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="address=no">
    <link href="{pigcms{$static_path}test/style.css" rel="stylesheet" type="text/css" />
    <link href="{pigcms{$static_path}test/weui.css" rel="stylesheet" type="text/css" />
	<link href="{pigcms{$static_path}kid/weui.min.css" rel="stylesheet" type="text/css" />
    <link href="{pigcms{$static_path}test/weui2.css" rel="stylesheet" type="text/css" />


    <style type="text/css">
	body {font-family:"微软雅黑";}
    .zk {width:95%; margin:0px auto;}
	.zk2 {width:100%; margin-top:10px; border-radius:8px; background-color:#FFFFFF;}
	.sm {width:100%; height:30px; overflow:hidden; padding-top:12px;}
	.kk {width:5px; height:20px; float:left;}
	.kk2 {height:20px; line-height:20px; float:left; font-size:18px; margin-left:8px; color:#515455;}
	.kk3 {float:right; height:20px; line-height:20px; color:#b4b4b5; margin-right:14px;}
	.kk4 {float:right; margin-right:6px;}
	.xm {width:100%; padding-bottom:25px;}
	.d1 {width:29%; height:90px; border-radius:8px; float:left; background-color:#FFFFFF; box-shadow: 0px 5px 21px #ecf7ff; margin-left:2%; margin-right:2%; margin-top:14px;}
	.cw {width:80%; height:40px; line-height:40px; margin:0px auto; color:#4fadff; font-size:26px;}
	.cw2 {width:80%; height:16px; line-height:16px; margin:0px auto; color:#515455; font-size:14px;}
	.db {width:100%; border-radius:8px; background-color:#FFFFFF;}
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
	.both {clear:both;}
    </style>
</head>
<body style="background-color:#72c7fe;">
<div class="zk" style="padding-top:30px;">
	<div class="db">
		<div class="tm">
			<div class="jk">
				<div class="im"><img src="{pigcms{$static_path}images/tb1.jpg" style="width:100%; height:auto;" /></div>
				<div class="im2">{pigcms{$village_name}</div>
				<div class="im3">

					<div class="weui_cellss">
						<div class="weui_cell weui_cell_selects">
							<div class="weui_cell_bd weui_cell_primary">
								<span id="showIOSActionSheet">[切换]</span>
								<!--<select class="weui_select" name="select1" id="village_change">
									<option value="0" selected="true" disabled="true">[切换]</option>
									<foreach name="village_array" item="vo">
										<option value="{pigcms{$vo.village_id}">{pigcms{$vo.village_name}</option>
									</foreach>
								</select>-->
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
</div>
<div class="zk" style="padding-top:20px;">
	<div class="zk2">
		<div class="sm">
			<div class="kk" style="background-color:#f8cf6a;"></div>
			<div class="kk2">入住情况</div>
			<div class="kk3">2018-01-23</div>
			<div class="kk4"><img src="{pigcms{$static_path}images/137/tb.jpg" style="width:18px;" /></div>
			<div style="clear:both"></div>
		</div>
		<div class="xm">
			<div class="d1">
				<div class="cw">244</div>
				<div class="cw2">入驻数</div>
			</div>
			<div class="d1">
				<div class="cw">13</div>
				<div class="cw2">闲置数</div>
			</div>
			<div class="d1">
				<div class="cw">95%</div>
				<div class="cw2">入住率</div>
			</div>
			<div style="clear:both"></div>
		</div>
	</div>
	
	<div class="zk2">
		<div class="sm">
			<div class="kk" style="background-color:#fb4746;"></div>
			<div class="kk2">收支预览</div>
			<div class="kk3">2018-01-23</div>
			<div class="kk4"><img src="{pigcms{$static_path}images/137/tb.jpg" style="width:18px;"></div>
			<div style="clear:both"></div>
		</div>
		<div class="xm">
			<div class="d1">
				<div class="cw">156745</div>
				<div class="cw2">应收金额</div>
			</div>
			<div class="d1">
				<div class="cw">133543</div>
				<div class="cw2">实收金额</div>
			</div>
			<div class="d1">
				<div class="cw">5367</div>
				<div class="cw2">支出金额</div>
			</div>
			<div style="clear:both"></div>
		</div>
	</div>
</div>
</body>
</html>