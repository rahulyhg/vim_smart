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
<title>文件管理－删除文件</title>
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
if(count($_SESSION['path'])<=0) {
echo <<<HTML
<div class="big_board"><div class="board_title">爱特文管－系统警告</div></div>
Hello,待处理文件为空!
HTML;
} else {
echo <<<HTML
<div class="big_board"><div class="board_title">删除文件－删除结果</div></div>
<span class="true">■</span>删除成功 <span class="false">■</span>删除异常
HTML;
$i=0;
while($i<count($_SESSION['path'])) {
echo <<<HTML
<div class="big_board"><div class="board_title"></div></div>
HTML;
if(is_dir(_decode($_SESSION['path'][$i]))==true) {
removeDir(_decode($_SESSION['path'][$i]));
if(file_exists(_decode($_SESSION['path'][$i]))==false) {
echo '[dir]<span class="true">'._decode($_SESSION['path'][$i]).'</span>';
} else {
echo '[dir]<span class="false">'._decode($_SESSION['path'][$i]).'</span>';
}
}
if(is_file(_decode($_SESSION['path'][$i]))==true) {
if(removeFile(_decode($_SESSION['path'][$i]))==true) {
echo '[file]<span class="true">'._decode($_SESSION['path'][$i]).'</span>';
} else {
echo '[file]<span class="false">'._decode($_SESSION['path'][$i]).'</span>';
}
}
$i++;
}
}
echo <<<HTML
<div class="big_board"><div class="board_title">By：Admin@Aite.Me</div></div>
</body>
</html>
HTML;
unset($_SESSION['path']);
?>