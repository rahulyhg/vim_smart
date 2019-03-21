<?php
require 'user.php';
require 'geshi.php';
require 'function.php';
if(file_exists($path=_decode($_GET['path']))==false) {
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
<title>文件管理－高亮代码</title>
<style type="text/css">
.big_board{background-color:#009BCE;color:#FFF;}
.board_title{margin-bottom:1px;border:1px solid #09F;}
</style>
</head>
<body>
<div class="big_board"><div class="board_title">爱特文管－路径信息</div></div>
HTML;
echo '<a href="index.php?path='._encode(dirname(_decode($_GET['path']))).'">'.dirname(_decode($_GET['path'])).'</a>/'.basename(_decode($_GET['path']));
echo '<div class="big_board"><div class="board_title">爱特文管－代码类型</div></div>';
echo <<<HTML
<form action="{$_SERVER['PHP_SELF']}" method="get">
<input type="text" name="codetype"/>
<input type="hidden" name="path" value="{$_GET['path']}"/>
<input type="submit" value="高亮"/>
</form>
HTML;
echo '<div class="big_board"><div class="board_title">爱特文管－高亮代码</div></div>';
if(filesize(_decode($_GET['path']))!=0) {
$xread=file_get_contents(_decode($_GET['path']));
if($_GET['codetype']!=null) {
$codetype=$_GET['codetype'];
} else {
$codetype="php";
}
$source=$xread;
$geshi=new geshi($source,$codetype,'geshi/');
echo nl2br($geshi->parse_code());
} else {
echo 'Hello,文件内容为空!';
}
echo '<div class="big_board"><div class="board_title">By：Admin@Aite.Me</div></div>';
echo '</body></html>';
?>