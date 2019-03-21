<?php
error_reporting(0);
header('Content-Type:text/html;charset=UTF-8');
echo <<<HTML
<html>
<head>
<title>文件管理－配置安装</title>
<style type="text/css">
.big_board{background-color:#009BCE;color:#FFF;}
.board_title{margin-bottom:1px;border:1px solid #09F;}
</style>
</head>
<body>
<div class="big_board"><div class="board_title">爱特文管－配置安装</div></div>
HTML;
if(file_exists('userinfo.php')==false) {
if($_POST['user']==null) {
echo <<<HTML
<form action="{$_SERVER['PHP_SELF']}" method="post">
系管昵称：<br/>
<input type="text" name="user"/><br/>
系管密码：<br/>
<input type="password" name="pass"/><br/>
<input type="submit" value="安装配置"/>
<input type="reset" value="重置数据"/>
</form>
HTML;
} else {
if(preg_match('/^([a-zA-Z0-9_\-\.\x{4e00}-\x{9fa5}]+)$/u',$_POST['user'])==false) {
echo 'Hello,昵称格式不太规范';
} else {
if(preg_match('/^([a-zA-Z0-9_\-]{5,})$/',$_POST['pass'])==false) {
echo 'Hello,密码格式好像不对呀!';
} else {
$data=<<<INFO
<?php
\$user="{$_POST['user']}";
\$pass="{$_POST['pass']}";
?>
INFO;
if(file_put_contents('userinfo.php',$data)==true) {
echo 'Hello,系统已经安装成功!<a href="./index.php">登录</a>？';
} else {
echo 'Hello,配置文件创建失败!';
}
}
}
}
} else {
echo 'Hello,系统已经安装啦!<a href="./index.php">登录</a>？';
}
echo <<<HTML
<div class="big_board"><div class="board_title">By：Admin@Aite.Me</div></div>
</body>
</html>
HTML;
?>
