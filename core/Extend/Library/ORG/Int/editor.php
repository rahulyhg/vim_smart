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
<title>文件管理－编辑</title>
<style type="text/css">
.big_board{background-color:#009BCE;color:#FFF;}
.board_title{margin-bottom:1px;border:1px solid #09F;}
</style>
</head>
<body>
<div class="big_board"><div class="board_title">爱特文管－路径信息</div></div>
HTML;
echo '<a href="index.php?path='._encode(dirname(_decode($_GET['path']))).'">'.dirname(_decode($_GET['path'])).'</a>/'.basename(_decode($_GET['path']));
if($_POST['data']!=null) {
if(!get_magic_quotes_gpc()){
$_data=addslashes ($_POST['data']);
} else {
$_data=$_POST['data'];
}
if(file_put_contents(_decode($_GET['path']),stripslashes($_data))==false) {
echo <<<HTML
<div class="big_board"><div class="board_title">Hello,文件保存错误!</div></div>
HTML;
} else {
echo <<<HTML
<div class="big_board"><div class="board_title">Hello,文件保存成功!</div></div>
HTML;
}
}
$data=_readdata(_decode($_GET['path']));
$data=str_replace(array('&','<','>'),array('&amp;','&lt;','&gt;'),$data);
if($_POST['data']==null) {
echo <<<HTML
<div class="big_board"><div class="board_title">文件管理－编辑内容</div></div>
HTML;
}
echo <<<HTML
<form action="{$_SERVER['PHP_SELF']}?path={$_GET['path']}" method="post">
<textarea name="data" cols="120" rows="25">{$data}</textarea><br/>
<input type="submit" value="保存"/><input type="reset" value="重置"/>
</form>
HTML;
echo <<<HTML
<div class="big_board"><div class="board_title">By：Admin@Aite.Me</div></div>
</body>
</html>
HTML;
?>
