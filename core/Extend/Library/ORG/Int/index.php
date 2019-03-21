<?php
require 'user.php';
require 'function.php';
header("Content-Type:text/html;charset=UTF-8");
?>
<?php
echo <<<HTML
<html>
<head>
<title>文件管理</title>
<style type="text/css">
.big_board{background-color:#009BCE;color:#FFF;}
.board_title{margin-bottom:1px;border:1px solid #09F;}
</style>
</head>
<body>
<div class="big_board"><div class="board_title">爱特文件管理&nbsp;&nbsp;&nbsp;&nbsp;<a href="exit.php">EXIT</a></div></div>
HTML;
?>
<?php
if($_GET['path']==null) {
$f=_opendir('..');
} else {
$f=_opendir(_decode($_GET['path']));
}
if($_GET['path']!=null) {
echo _decode($_GET['path']).'<br/>';
} else {
echo "Hello,欢迎使用爱特文管!";
}
if($f==false) {
echo "Hello,打开目录出错啦!";
} else {
echo <<<HTML
<div class="big_board"><div class="board_title">当前目录</div></div>
<form action="system.php" method="post">
<select name="type">
<option value="upload">本地上传</option>
<option value="urlupload">远程上传</option>
<option value="mkfile">新建文件</opton>
<option value="mkdir">新建目录</option>
<option value="rename">命名目录</option>
</select>
HTML;
echo '<input type="hidden" name="path" value="'._encode($f['.']).'"/>';
echo <<<HTML
<input type="submit" value="[Go]"/>
</form>
HTML;
if($f['..']!=null) {
echo '<div class="big_board"><div class="board_title"></div></div>';
echo "-&gt;<a href=\"{$_SERVER['PHP_SELF']}?path="._encode($f['..'])."\">上级目录</a>&nbsp;";
echo function_exists('shell_exec') ? '&nbsp;<a href="shell_exec.php?path='._encode($f['.']).'">系统命令</a><br/>' : '&nbsp;系统命令<br/>';
}
if((count($f['dir'])+count($f['file'])+count($f['other']))>=1) {
echo '<form action="system.php?path='._encode($f['.']).'" method="post">';
if(count($f['dir'])>=1) {
echo <<<HTML
<div class="big_board"><div class="board_title">目录列表</div></div>
HTML;
foreach($f['dir'] as $dir) {
echo "<input type=\"checkbox\" name=\"selected[]\" value=\""._encode($dir)."\"/><a href=\"dirinfo.php?path="._encode($dir)."\">[dir]</a><a href=\"{$_SERVER['PHP_SELF']}?path="._encode($dir)."\">".path2name($dir)."</a><br/>";
}
}
if(count($f['file'])>=1) {
echo <<<HTML
<div class="big_board"><div class="board_title">文件列表</div></div>
HTML;
foreach($f['file'] as $file) {
echo "<input type=\"checkbox\" name=\"selected[]\" value=\""._encode($file)."\"/><a href=\"fileinfo.php?path="._encode($file)."\">[file]</a>".path2name($file).'<br/><a href="download.php?path='._encode($file).'">下载</a>.<a href="editor.php?path='._encode($file).'">编辑</a>.<a href="view.php?path='._encode($file).'">查看</a>.<a href="rename.php?path='._encode($file).'">命名</a><br/>大小:'._filesize($file).' 权限:'.substr(sprintf('%o',fileperms(_decode($file))),-4).'<br/>';
}
}
echo <<<HTML
<select name="type">
<option value="delete">删除文件(多选)</option>
<option value="pkzip">压缩文件(多选)</option>
<option value="move">移动文件(多选)</option>
<option value="chmod">权限变更(多选)</option>
</select>
<input type="submit" value="[Go]"/>
</form>
HTML;
} else {
echo "Hello,貌似目录是空目录耶!";
echo <<<HTML
<br/>
<select>
<option>无法操作(提示)</option>
</select>
<input type="submit" value="[Go]"/>
HTML;
}
}
?>
<?php
echo <<<HTML
<div class="big_board"><div class="board_title">By：Admin@Aite.Me</div></div>
</body>
</html>
HTML;
?>