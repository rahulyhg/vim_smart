<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>{pigcms{$tpl.wxname}</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<meta charset="utf-8">
<link href="{pigcms{$static_path}css/yl/news.css" rel="stylesheet" type="text/css" />

</head>
<script>
window.onload = function ()
{
var oWin = document.getElementById("win");
var oLay = document.getElementById("overlay");	
var oClose = document.getElementById("close");

oLay.onclick = function ()
{
oLay.style.display = "none";
oWin.style.display = "none"	
}
};
</script>
<body id="listhome1">
<div id="ui-header">
<div class="fixed" style="text-align:center">

<a class="ui-btn-left_pre" href="javascript:history.go(-1)"></a>
{pigcms{$thisClassInfo.name}
<a class="ui-btn-right" href="javascript:window.location.reload()"></a>
</div>
</div>
<div id="overlay"></div>

<div class="Listpage">
<div class="top46"></div>
    <div id="todayList">
<ul  class="todayList">
   <volist name="info" id="vo">   
<li>
<if condition="$vo['url']">
<a href="{pigcms{$vo.url}">
<else />
<a href="{pigcms{:U('Index/content',array('id'=>$vo['id'],'token'=>$vo['token']))}">
</if>
<div class="img"><img src="{pigcms{$vo.pic}"></div>
<h2>{pigcms{$vo.title}</h2>
<p class="onlyheight">{pigcms{$vo.text}</p>
<div class="commentNum"></div>
</a>
</li>
 </volist>

</ul>
</div>

</div>
<script>
function dourl(url){
location.href= url;
}
</script>
<div style="display:none"> </div>
<div style="display:none">{pigcms{$tpl.tongji|htmlspecialchars_decode}</div>

  <div class="copyright">
<if condition="$iscopyright eq 1">
{pigcms{$homeInfo.copyright}
<else/>
{pigcms{$siteCopyright}
</if>
</div> 
<include file="Index:styleInclude"/><include file="$cateMenuFileName"/>
<!-- share -->
<include file="Index:share" />
</body>
</html>
