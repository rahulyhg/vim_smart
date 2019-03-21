<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<title>选择城市 - {pigcms{$config.site_name}</title>
		<meta name="keywords" content="{pigcms{$config.seo_keywords}" />
		<meta name="description" content="{pigcms{$config.seo_description}" />
		<link href="{pigcms{$static_path}css/css.css" type="text/css"  rel="stylesheet" />
		<link href="{pigcms{$static_path}css/header.css"  rel="stylesheet"  type="text/css" />
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/changecity.css?210"/>
		<script type="text/javascript" src="{pigcms{:C('JQUERY_FILE_190')}" charset="utf-8"></script>
		<script type="text/javascript" src="{pigcms{$static_public}js/jquery.cookie.js?210" charset="utf-8"></script>
		<script src="{pigcms{$static_path}js/common.js"></script>
		<script type="text/javascript">var indexUrl="{pigcms{:U('Home/index')}";var cityTopDomain=".{pigcms{$config.many_city_top_domain}";</script>
		<script type="text/javascript" src="{pigcms{$static_path}js/changecity.js?210" charset="utf-8"></script>
		<!--[if IE 6]>
		<script  src="{pigcms{$static_path}js/DD_belatedPNG_0.0.8a.js" mce_src="{pigcms{$static_path}js/DD_belatedPNG_0.0.8a.js"></script>
		<script type="text/javascript">
		   /* EXAMPLE */
		   DD_belatedPNG.fix('.enter,.enter a,.enter a:hover');

		   /* string argument can be any CSS selector */
		   /* .png_bg example is unnecessary */
		   /* change it to what suits you! */
		</script>
		<script type="text/javascript">DD_belatedPNG.fix('*');</script>
		<style type="text/css"> 
			body{behavior:url("{pigcms{$static_path}css/csshover.htc");}
			.category_list li:hover .bmbox {filter:alpha(opacity=50);}
			.gd_box{display:none;}
		</style>
		<![endif]-->
		<script>
		$(document).on('click','.city_location',function(){
		var city_url = $(this).data('city_url');
		var city_name = $(this).html();
		var cityHistory = $.cookie('cityHistory');
		if(cityHistory){
			console.log(cityHistory);
			cityArr = cityHistory.split('~^%@$$@%^~');
			var newCityArr = [];
			for(var i in cityArr){
				var nowCityArr = cityArr[i].split('~~');
				console.log(nowCityArr);
				if(nowCityArr[0] != city_url) newCityArr.push(cityArr[i]);
			}
			newCityArr.unshift(city_url+'~~'+city_name);
			var newCityHistory = newCityArr.join('~^%@$$@%^~');
		}else{
			var newCityHistory = city_url+'~~'+city_name;
		}
		$.cookie('cityHistory',newCityHistory,{expires:730,path:'/'});
		$.cookie('now_city_area_url',city_url,{expires:730,path:'/'});
		$.cookie('now_city',city_url,{expires:730,path:'/',domain:cityTopDomain});
		window.location.href="/index.php";
	});
		</script>
	</head>
	<body>
		<include file="Public:header_top"/>
	
<div class="body">
			<div class="hd">
				<div class="hd_left">
					<form action="">
						<a href="/" class="site_enter">点击进入{pigcms{$now_city.area_name}站&gt;&gt;</a>
						<div style="display:none"> 
						<span class="fm_label">按省份选择：</span>
						<select name="" id="site_sel_pro" class="fm_sel">
							<option value="0">请选择</option>
							<option value="1">﻿北京</option><option value="21">上海</option><option value="42">天津</option><option value="104">安徽</option><option value="423">广东</option><option value="1763">江西</option><option value="3133">浙江</option>						</select>
						<select name="" id="site_sel_city" class="fm_sel">
							<option value="">请选择</option>
						</select>
						<input type="submit" value="确定" class="fm_submit">
						</div>
					</form>
				</div>
			</div>
			<div class="had_city">推荐城市：
			<volist name="hot_city" id="vo">
			   <a class="city_location" data-city_url="{pigcms{$vo.area_url}">{pigcms{$vo.area_name}</a>
			</volist>
			</div>
			<div class="abc_filter" id="city_set_0">
				<p>按城市拼音首字母选择：
				
				<volist name="all_city" id="vo">
				<a href="#city_set_{pigcms{$key}">{pigcms{$key}</a>
				</volist>
				
				</p>
				<i class="arrow"></i>
			</div>
			<ul class="city_set">
			<volist name="all_city" id="vo">
				<li id="city_set_{pigcms{$key}">
				<span class="abc_star">{pigcms{$key}</span>
				<volist name="vo" id="voo">
				<a class="city_location" data-city_url="{pigcms{$voo.area_url}">{pigcms{$voo.area_name}</a>
				</volist>
				</li>
			</volist>		
	</ul>
        </div>
		<include file="Public:footer"/>
	</body>
</html>
