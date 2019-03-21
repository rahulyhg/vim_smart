<?php
require 'user.php';
require 'function.php';
if($_POST['type']=='upload') {
header('Location:upload.php?path='.$_POST['path']);
}
if($_POST['type']=='urlupload') {
header('Location:urlupload.php?path='.$_POST['path']);
}
if($_POST['type']=='mkdir') {
header('Location:mkdir.php?path='.$_POST['path']);
}
if($_POST['type']=='mkfile') {
header('Location:mkfile.php?path='.$_POST['path']);
}
if($_POST['type']=='rename') {
header('Location:rename.php?path='.$_POST['path']);
}
if($_POST['type']=='delete') {
$_SESSION['path']=$_POST['selected'];
header('Content-Type:text/html;charset=UTF-8');
echo <<<HTML
<html>
<head>
<title>文件管理－删除提示</title>
<style type="text/css">
.big_board{background-color:#009BCE;color:#FFF;}
.board_title{margin-bottom:1px;border:1px solid #09F;}
</style>
</head>
<body>
<div class="big_board"><div class="board_title">爱特文管－路径信息</div></div>
HTML;
echo '<a href="index.php?path='.$_GET['path'].'">'._decode($_GET['path']).'</a>';
echo <<<HTML
<div class="big_board"><div class="board_title">(警)数据删除将不能复原</div></div>
HTML;
if(count($_SESSION['path'])>0) {
echo '[<a href="delete.php?path='.$_GET['path'].'">确认删除</a>]';
} else {
echo 'Hello,待操作文件为空!';
}
$i=0;
while($i<count($_SESSION['path'])) {
echo <<<HTML
<div class="big_board"><div class="board_title"></div></div>
HTML;
echo _decode($_SESSION['path'][$i]);
$i++;
}
echo <<<HTML
<div class="big_board"><div class="board_title">By：Admin@Aite.Me</div></div>
</body>
</html>
HTML;
}
if($_POST['type']=='pkzip') {
$_SESSION['path']=$_POST['selected'];
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
echo <<<HTML
<div class="big_board"><div class="board_title">压缩数据－存档名称</div></div>
HTML;
if(count($_SESSION['path'])>0) {
echo <<<HTML
<form action="pkzip.php?path={$_GET['path']}" method="post">
<input type="text" name="pkname" value=".zip"/>
<input type="submit" value="压缩"/>
</form>
HTML;
} else {
echo 'Hello,待操作文件为空!';
}
$i=0;
while($i<count($_SESSION['path'])) {
echo <<<HTML
<div class="big_board"><div class="board_title"></div></div>
HTML;
echo _decode($_SESSION['path'][$i]);
$i++;
}
echo <<<HTML
<div class="big_board"><div class="board_title">By：Admin@Aite.Me</div></div>
</body>
</html>
HTML;
}
if($_POST['type']=='move') {
$_SESSION['path']=$_POST['selected'];
header('Content-Type:text/html;charset=UTF-8');
echo <<<HTML
<html>
<head>
<title>文件管理－批量移动</title>
<style type="text/css">
.big_board{background-color:#009BCE;color:#FFF;}
.board_title{margin-bottom:1px;border:1px solid #09F;}
</style>
</head>
<body>
<div class="big_board"><div class="board_title">爱特文管－路径信息</div></div>
HTML;
echo '<a href="index.php?path='.$_GET['path'].'">'._decode($_GET['path']).'</a>';
echo <<<HTML
<div class="big_board"><div class="board_title">移动操作－目标目录</div></div>
HTML;
if(count($_SESSION['path'])>0) {
echo <<<HTML
<form action="move.php?path={$_GET['path']}" method="post">
<input type="text" name="dir"/>
<input type="submit" value="移动"/>
</form>
HTML;
} else {
echo 'Hello,待操作文件为空!';
}
$i=0;
while($i<count($_SESSION['path'])) {
echo <<<HTML
<div class="big_board"><div class="board_title"></div></div>
HTML;
echo _decode($_SESSION['path'][$i]);
$i++;
}
echo <<<HTML
<div class="big_board"><div class="board_title">By：Admin@Aite.Me</div></div>
</body>
</html>
HTML;
}
if($_POST['type']=='chmod') {
$_SESSION['path']=$_POST['selected'];
header('Content-Type:text/html;charset=UTF-8');
echo <<<HTML
<html>
<head>
<title>文件管理－变更权限</title>
<style type="text/css">
.big_board{background-color:#009BCE;color:#FFF;}
.board_title{margin-bottom:1px;border:1px solid#09F;}
</style>
</head>
<body>
<div class="big_board"><div class="board_title">爱特文管－路径信息</div></div>
HTML;
echo '<a href="index.php?path='.$_GET['path'].'">'._decode($_GET['path']).'</a>';
echo <<<HTML
<div class="big_board"><div class="board_title">系统权限－新的权限</div></div>
HTML;
if(count($_SESSION['path'])>0) {
echo <<<HTML
<form action="chmod.php?path={$_GET['path']}" method="post">
<input type="text" name="perms" value="0777"/>
<input type="submit" value="变更"/>
</form>
HTML;
} else {
echo 'Hello,待操作文件为空!';
}
$i=0;
while($i<count($_SESSION['path'])) {
echo <<<HTML
<div class="big_board"><div class="board_title"></div></div>
HTML;
echo _decode($_SESSION['path'][$i]);
$i++;
}
echo <<<HTML
<div class="big_board"><div class="board_title">By：Admin@Aite.Me</div></div>
</body>
</html>
HTML;
}
?>