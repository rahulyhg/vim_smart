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
<title>文件管理－重命名</title>
<style type="text/css">
.big_board{background-color:#009BCE;color:#FFF;}
.board_title{margin-bottom:1px;border:1px solid #09F;}
</style>
</head>
<body>
<div class="big_board"><div class="board_title">爱特文管－路径信息</div></div>
HTML;
if(is_dir(_decode($_GET['path']))) {
echo '<a href="index.php?path='.$_GET['path'].'">'._decode($_GET['path']).'</a>';
} else {
echo '<a href="index.php?path='._encode(dirname(_decode($_GET['path']))).'">'.dirname(_decode($_GET['path'])).'</a>/'.basename(_decode($_GET['path']));
}
if($_POST['name']!=null) {
echo <<<HTML
<div class="big_board"><div class="board_title">爱特文管－命名结果</div></div>
HTML;
if(preg_match('/^([a-zA-Z0-9_\-\.\x{4e00}-\x{9fa5}]+)$/u',$_POST['name'])==false) {
echo 'Hello,名称格式错误!';
} else {
if(is_dir(_decode($_GET['path']))) {
chdir(dirname(_decode($_GET['path']).'/'.$_POST['name']).'/../');
$to=getcwd().'/'.$_POST['name'];
} else {
$to=dirname(_decode($_GET['path']));
$to=$to.'/'.$_POST['name'];
}
if(rename(_decode($_GET['path']),$to)==false) {
echo 'Hello,重命名失败了啦!';
} else {
echo 'Hello,重命名成功了喔!';
if(is_dir($to)) {
echo '<a href="index.php?path='._encode(dirname($to).'/'.$_POST['name']).'">返回</a>?';
}
}
}
}
echo <<<HTML
<div class="big_board"><div class="board_title">爱特文管－新的名称</div></div>
HTML;
echo <<<HTML
<form action="{$_SERVER['PHP_SELF']}?path={$_GET['path']}" method="post">
<input type="text" name="name"/>
<input type="submit" value="命名"/>
</form>
HTML;
echo <<<HTML
<div class="big_board"><div class="board_title">By：Admin@Aite.Me</div></div>
</body>
</html>
HTML;
?>