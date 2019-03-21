<?php
require 'user.php';
require 'function.php';
if(is_dir($path=_decode($_GET['path']))==false) {
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
<title>文件管理－系统命令</title>
<style type="text/css">
.like{background-color:#999999;border:1px;border-style:solid;border-color:#00F0F0;}
.big_board{background-color:#009BCE;color:#FFF;}
.board_title{margin-bottom:1px;border:1px solid #09F;}
</style>
</head>
<body>
HTML;
chdir(_decode($_GET['path']));
echo <<<HTML
<div class="big_board"><div class="board_title">爱特文管－路径信息</div></div>
HTML;
echo '<a href="index.php?path='.$_GET['path'].'">'._decode($_GET['path']).'</a>';
echo <<<HTML
<div class="big_board"><div class="board_title">系统命令－命令中心</div></div>
<form actiom="{$_SERVER['REQUEST_URI']}" method="post">
<textarea name="shell_exec" cols="120" rows="15"></textarea>
<br/>
<input type="submit" value="SHELL_EXEC"/>
</form>
HTML;
if($_POST['shell_exec']!=null) {
$shell_exec=explode("\r",$_POST['shell_exec']);
echo <<<HTML
<div class="big_board"><div class="board_title">系统命令－命令结果</div></div>
HTML;
echo '<div class="like">';
foreach($shell_exec as $exec) {
echo '#&nbsp;'.$exec.'<br/>';
if(preg_match('/^\s*cd\s+/i',$exec)==false):
echo nl2br(htmlspecialchars(shell_exec($exec)));
else:
$cd=preg_replace('/^\s*cd\s*(.*?)/i','\\1',$exec);
chdir($cd);
echo shell_exec('pwd').'<br/>';
endif;
}
echo '</div>';
}
echo <<<HTML
<div class="big_board"><div class="board_title">By：Admin@Aite.Me</div></div>
</body>
</html>
HTML;
?>