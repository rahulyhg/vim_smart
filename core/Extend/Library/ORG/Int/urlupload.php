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
<title>文件管理－远程上传</title>
<style type="text/css">
.big_board{background-color:#009BCE;color:#FFF;}
.board_title{margin-bottom:1px;border:1px solid #09F;}
</style>
</head>
<body>
<div class="big_board"><div class="board_title">爱特文管－路径信息</div></div>
HTML;
echo '<a href="index.php?path='.$_GET['path'].'">'._decode($_GET['path']).'</a>';
if(($_POST['furl']!=null)&&(($_POST['name'])!=null)) {
echo <<<HTML
<div class="big_board"><div class="board_title">远程上传－上传情况</div></div>
HTML;
if(is_url($_POST['furl'])==false) {
echo 'Hello,地址不规范耶!';
} else {
if(preg_match('/^([a-zA-Z0-9_\-\.\x{4e00}-\x{9fa5}]+)$/u',$_POST['name'])==false) {
echo 'Hello,名称不规范耶!';
} else {
if(urlupload(_decode($_GET['path']).'/'.$_POST['name'],$_POST['furl'])==false) {
echo 'Hello,空间不支持耶!';
} else {
if(file_exists(_decode($_GET['path']).'/'.$_POST['name'])==false) {
echo 'Hello,文件无权写入耶!';
} else {
echo '文件 '.$_POST['name'].' 上传成功!';
}
}
}
}
}
echo <<<HTML
<form action="{$_SERVER['PHP_SELF']}?path={$_GET['path']}" method="post">
<div class="big_board"><div class="board_title">爱特文管－文件地址</div></div>
<input type="text" name="furl"/>
<div class="big_board"><div class="board_title">爱特文管－存档名称</div></div>
<input type="text" name="name"/><br/>
<input type="submit" value="上传"/>
</form>
HTML;
echo <<<HTML
<div class="big_board"><div class="board_title">By：Admin@Aite.Me</div></div>
</body>
</html>
HTML;
?>