<?php
require 'user.php';
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
<title>文件管理－目录信息</title>
<style type="text/css">
.big_board{background-color:#009BCE;color:#FFF;}
.board_title{margin-bottom:1px;border:1px solid #09F;}
</style>
</head>
<body>
<div class="big_board"><div class="board_title">爱特文管－路径信息</div></div>
HTML;
chdir(_decode($_GET['path'])."/../");
$path=getcwd();
echo '<a href="index.php?path='.$path.'">'._decode($_GET['path']).'</a>';
echo <<<HTML
<div class="big_board"><div class="board_title">爱特文管－目录信息</div></div>
HTML;
if(is_dir(_decode($_GET['path']))==false) {
echo 'Hello,文件信息查询出错!';
} else {
echo '目录名称：<br/><a href="rename.php?path='._decode($_GET['path']).'">'.basename(_decode($_GET['path'])).'</a>';
echo '<div class="big_board"><div class="board_title"></div></div>';
echo '目录权限：<br/>'.substr(sprintf('%o',fileperms(_decode($_GET['path']))),-4);
echo '<div class="big_board"><div class="board_title"></div></div>';
echo '最后访问：<br/>'.gmdate("Y-m-d H:i:s",fileatime(_decode($_GET['path']))+8*3600);
echo '<div class="big_board"><div class="board_title"></div></div>';
echo '最后修改：<br/>'.gmdate("Y-m-d H:i:s",filemtime(_decode($_GET['path']))+8*3600);
}
echo <<<HTML
<div class="big_board"><div class="board_title">By：Admin@Aite.Me</div></div>
</body>
</html>
HTML;
?>