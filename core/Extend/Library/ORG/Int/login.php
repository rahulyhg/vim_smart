<?php
error_reporting(0);
session_start();
if(file_exists('userinfo.php')==false) {
Header('Location:install.php');
exit;
} else {
require 'userinfo.php';
}
header('Content-Type:text/html;charset=UTF-8');
echo <<<HTML
<html>
<head>
<title>文件管理－用户模块</title>
<style type="text/css">
.big_board{background-color:#009BCE;color:#FFF;}
.board_title{margin-bottom:1px;border:1px solid #09F;}
</style>
</head>
<body>
<div class="big_board"><div class="board_title">爱特文管－用户模块</div></div>
HTML;
if($_REQUEST['user']==null) {
echo <<<HTML
<form action="{$_SERVER['PHP_SELF']}" method="get">
系管昵称：<br/>
<input type="text" name="user"/><br/>
系管密码：<br/>
<input type="password" name="pass"/><br/>
<input type="hidden" name="curl" value="{$_SERVER['HTTP_REFERER']}"/>
<input type="submit" value="登录爱特助手"/>
</form>
HTML;
} else {
if(($user==$_REQUEST['user'])&&($pass==$_REQUEST['pass'])) {
if($_SESSION['status']==true) {
echo 'Hello,您很喜欢重复登录吗?';
} else {
$_SESSION['status']=true;
echo 'Hello,您已经成功登录啦!<br/>';
echo "-&gt;&gt;<a href=\"index.php\">爱特助手首页</a>";
}
} else {
echo 'Hello,请不要非法闯入喔!';
}
}
echo <<<HTML
<div class="big_board"><div class="board_title">By：Admin@Aite.Me</div></div>
</body>
</html>
HTML;
?>