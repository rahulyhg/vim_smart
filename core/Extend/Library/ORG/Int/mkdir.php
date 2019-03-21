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
<title>文件管理－新建目录</title>
<style type="text/css">
.big_board{background-color:#009BCE;color:#FFF;}
.board_title{margin-bottom:1px;border:1px solid #09F;}
</style>
</head>
<body>
<div class="big_board"><div class="board_title">爱特文管－路径信息</div></div>
HTML;
echo '<a href="index.php?path='.$_GET['path'].'">'._decode($_GET['path']).'</a>';
if($_POST['dirname']!=null) {
echo <<<HTML
<div class="big_board"><div class="board_title">爱特文管－系统提示</div></div>
HTML;
if(preg_match('/^([a-zA-Z0-9_\-\.\x{4e00}-\x{9fa5}]+)$/u',$_POST['dirname'])==false) {
echo 'Hello,目录格式错误!';
} else {
if(mkdir(_decode($_GET['path']).'/'.$_POST['dirname'],0777)==false) {
echo '目录 '.$_POST['dirname'].' 建立失败!';
} else {
echo '目录 '.$_POST['dirname'].' 建立成功!';
}
}
}
echo <<<HTML
<div class="big_board"><div class="board_title">爱特文管－目录名称</div></div>
HTML;
echo '<form action="'.$_SERVER['PHP_SELF'].'?path='.$_GET['path'].'" method="post">';
echo '<input type="text" name="dirname"/>';
echo '<input type="submit" value="新建"/>';
echo '</form>';
echo <<<HTML
<div class="big_board"><div class="board_title">By：Admin@Aite.Me</div></div>
</body>
</html>
HTML;
?>