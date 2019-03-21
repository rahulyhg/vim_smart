<?php
require 'user.php';
require 'function.php';
if((file_exists($path=_decode($_GET['path']))==false)) {
header('Content-Type:text/html;charset=UTF-8');
echo <<<HTML
Error：404
HTML;
exit;
}
?>
<?php
header('Content-Type:text/html;charset=UTF-8');
echo <<<HTML
<html>
<head>
<title>文件管理－本地上传</title>
<style type="text/css">
.true{color:#999999;}
.false{color:#ff0000;}
.big_board{background-color:#009BCE;color:#FFF;}
.board_title{margin-bottom:1px;border:1px solid #09F;}
</style>
</head>
<body>
<div class="big_board"><div class="board_title">爱特文管－路径信息</div></div>
HTML;
echo '<a href="index.php?path='.$_GET['path'].'">'._decode($_GET['path']).'</a>';
if(isset($_FILES['data'])==true) {
echo <<<HTML
<div class="big_board"><div class="board_title">本地上传－上传结果</div></div>
<span class="true">■</span>上传成功 <span class="false">■</span>上传出错
HTML;
$i=0;
while($i<count($_FILES['data']['name'])) {
if($_FILES['data']['name'][$i]!=null) {
echo '<div class="big_board"><div class="board_title"></div></div>';
if(copy($_FILES['data']['tmp_name'][$i],_decode($_GET['path']).'/'.$_FILES['data']['name'][$i])==false) {
echo <<<HTML
失败:<span class="false">{$_FILES['data']['name'][$i]}</span>
HTML;
} else {
echo <<<HTML
成功:<span class="true">{$_FILES['data']['name'][$i]}</span><br/>
大小:{$_FILES['data']['size'][$i]}B<br/>
类型:{$_FILES['data']['type'][$i]}<br/>
HTML;
}
}
$i++;
}
}
function _upfile($size) {
if(preg_match('/^([0-9]*)$/',$size)==false) {
$size=1;
}
if($size<1) {
$size=1;
}
$i=1;
while($i<=$size) {
echo '<input type="file" name="data[]"/><br/>';
$i++;
}
}
echo <<<HTML
<div class="big_board"><div class="board_title">本地上传－批量上传</div></div>
<form action="{$_SERVER['PHP_SELF']}?path={$_GET['path']}" method="post" enctype="multipart/form-data">
HTML;
_upfile($_GET['size']);
echo <<<HTML
<input type="submit" value="上传"/>
</form>
<div class="big_board"><div class="board_title">本地上传－上传数量</div></div>
<form action="{$_SERVER['PHP_SELF']}" method="get">
同时上传<input type="hidden" name="path" value="{$_GET['path']}"/><input type="text" name="size" size="3" value="{$_GET['size']}"/>个
<input type="submit" value="提交"/>
</form>
HTML;
echo <<<HTML
<div class="big_board"><div class="board_title">By：Admin@Aite.Me</div></div>
HTML;
?>