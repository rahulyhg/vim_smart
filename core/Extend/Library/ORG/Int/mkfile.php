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
<title>文件管理－新建文件</title>
<style type="text/css">
.big_board{background-color:#009BCE;color:#FFF;}
.board_title{margin-bottom:1px;border:1px solid #09F;}
</style>
</head>
<body>
<div class="big_board"><div class="board_title">爱特文管－路径信息</div></div>
HTML;
echo '<a href="index.php?path='.$_GET['path'].'">'._decode($_GET['path']).'</a>';
if($_POST['filename']!=null) {
echo <<<HTML
<div class="big_board"><div class="board_title">爱特文管－系统提示</div></div>
HTML;
if(preg_match('/^([a-zA-Z0-9_\-\.\x{4e00}-\x{9fa5}]+)$/u',$_POST['filename'])==false) {
echo 'Hello,文件名格式错误!';
} else {
if(fopen(_decode($_GET['path']).'/'.$_POST['filename'],'x+')==false) {
echo '文件 '.$_POST['filename'].' 建立失败!';
} else {
echo '文件 '.$_POST['filename'].' 建立成功!';
}
}
}
echo <<<HTML
<div class="big_board"><div class="board_title">爱特文管－文件名称</div></div>
HTML;
echo '<form action="'.$_SERVER['PHP_SELF'].'?path='.$_GET['path'].'" method="post">';
echo '<input type="text" name="filename"/>';
echo '<input type="submit" value="新建"/>';
echo '</form>';
echo <<<HTML
<div class="big_board"><div class="board_title">By：Admin@Aite.Me</div></div>
</body>
</html>
HTML;
?>