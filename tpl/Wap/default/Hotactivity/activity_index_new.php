<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
    <title>热门活动</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" >  
    <meta content="Preview page of Metronic Admin Theme #4 for bootstrap inputs, input groups, custom checkboxes and radio controls and more" name="description" />
    <meta content="" name="author" />
	<link href="{pigcms{$static_path}test/weui.css" rel="stylesheet" type="text/css" />
	<link href="{pigcms{$static_path}test/weui2.css" rel="stylesheet" type="text/css" />

<style type="text/css">
.big {width:95%; margin:0px auto; padding-top:10px; padding-bottom:40px;}
.dg {width:100%; border-radius:8px; margin-bottom:15px; box-shadow: 1px 1px 3px #e7e6e6;}
</style></head>
<script>
    document.addEventListener('touchstart',function(){},false);
</script>
<body style="background-color: #F7F7F7;">
	<div class="big">
		<!--公共部分的热门活动 start-->
		<foreach name="activity_list_commone" item="vo">
			<div class="dg"><a href="{pigcms{$vo.url}"><img src="{pigcms{$config.site_url}/upload/adver/{pigcms{$vo.pic}" style="width:100%; max-width:100%; max-height:100%; border-radius:8px;" /></a></div>
		</foreach>
		<!--公共部分的热门活动 end-->
		<!--本小区的热门活动 start-->
		<foreach name="activity_list_link" item="vo">
			<div class="dg"><a href="{pigcms{$vo.url}"><img src="{pigcms{$config.site_url}/upload/adver/{pigcms{$vo.pic}" style="width:100%; max-width:100%; max-height:100%; border-radius:8px;" /></a></div>
		</foreach>
		<!--本小区的热门活动 end-->
	</div>
</body>