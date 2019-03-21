<?php
require 'user.php';
require 'function.php';
require 'pclzip.lib.php';
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
<title>文件管理－压缩数据</title>
<style type="text/css">
.big_board{background-color:#009BCE;color:#FFF;}
.board_title{margin-bottom:1px;border:1px solid #09F;}
</style>
</head>
<body>
<div class="big_board"><div class="board_title">爱特文管－路径信息</div></div>
HTML;
echo '<a href="index.php?path='.$_GET['path'].'">'._decode($_GET['path']).'</a>';
if(count($_SESSION['path'])<=0) {
echo <<<HTML
<div class="big_board"><div class="board_title">爱特文管－系统警告</div></div>
Hello,待处理文件为空!
HTML;
} elseif(preg_match('/^([a-zA-Z0-9_\-\.\x{4e00}-\x{9fa5}]+)([zip])$/iu',$_REQUEST['pkname'])==false) {
echo '<div class="big_board"><div class="board_title">爱特文管－系统警告</div></div>Hello,存档名称不规范喔!';
} else {
$i=0;
while($i<count($_SESSION['path'])) {
$_SESSION['path']['decode'][]=_decode($_SESSION['path'][$i]);
$i++;
}
$pk=new pclzip(_decode($_GET['path']).'/'.$_REQUEST['pkname']);
echo <<<HTML
<div class="big_board"><div class="board_title">压缩数据－压缩结果</div></div>
HTML;
if($pk->create($_SESSION['path']['decode'],PCLZIP_OPT_REMOVE_PATH,_decode($_GET['path']))==true) {
echo 'Hello,压缩包 '.$_REQUEST['pkname'].' 生成成功!';
} else {
echo 'Hello,压缩包 '.$_REQUEST['pkname'].' 生成失败!';
}
}
echo <<<HTML
<div class="big_board"><div class="board_title">By：Admin@Aite.Me</div></div>
HTML;
unset($_SESSION['path']);
?>