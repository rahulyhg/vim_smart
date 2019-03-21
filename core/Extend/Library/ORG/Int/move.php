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
<title>文件管理－批量移动</title>
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
if(count($_SESSION['path'])>=1) {
if(is_dir($_REQUEST['dir'])==false) {
echo <<<HTML
<div class="big_board"><div class="board_title">爱特文管－系统提示</div></div>
Hello,检测目标目录错误!
HTML;
} else {
echo <<<HTML
<div class="big_board"><div class="board_title">批量移动－移动结果</div></div>
<span class="true">■</span>已经移动 <span class="false">■</span>移动异常
HTML;
$i=0;
while($i<count($_SESSION['path'])) {
if(preg_match('/[\/]$/',$_REQUEST['dir'])==false) {
$todir=$_REQUEST['dir'].'/'.path2name(_decode($_SESSION['path'][$i]));
} else {
$todir=$_REQUEST['dir'].path2name(_decode($_SESSION['path'][$i]));
}
echo <<<HTML
<div class="big_board"><div class="board_title"></div></div>
HTML;
if(is_dir(_decode($_SESSION['path'][$i]))==true) {
echo '[dir]';
if(rename(_decode($_SESSION['path'][$i]),$todir)) {
echo '<span class="true">'._decode($_SESSION['path'][$i]).'</span>';
} else {
echo '<span class="false">'._decode($_SESSION['path'][$i]).'</span>';
}
}
if(is_file(_decode($_SESSION['path'][$i]))==true) {
echo '[file]';
if(rename(_decode($_SESSION['path'][$i]),$todir)) {
echo '<span class="true">'._decode($_SESSION['path'][$i]).'</span>';
} else {
echo '<span class="false">'._decode($_SESSION['path'][$i]).'</span>';
}
}
$i++;
}
}
} else {
echo <<<HTML
<div class="big_board"><div class="board_title">爱特文管－系统提示</div></div>
Hello,待操作文件好像为空!
HTML;
}
echo <<<HTML
<div class="big_board"><div class="board_title">By：Admin@Aite.Me</div></div>
</body>
</html>
HTML;
unset($_SESSION['path']);
?>