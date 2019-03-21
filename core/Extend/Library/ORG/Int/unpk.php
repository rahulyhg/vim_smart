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
chdir(_decode($_GET['path']));
header('Content-Type:text/html;charset=UTF-8');
echo <<<HTML
<html>
<head>
<title>文件管理－解压数据</title>
<style type="text/css">
.big_board{background-color:#009BCE;color:#FFF;}
.board_title{margin-bottom:1px;border:1px solid #09F;}
</style>
</head>
<body>
<div class="big_board"><div class="board_title">爱特文管－路径信息</div></div>
HTML;
echo '<a href="index.php?path='._encode(dirname(_decode($_GET['path']))).'">'.dirname(_decode($_GET['path'])).'</a>/'.basename(_decode($_GET['path']));
echo <<<HTML
<div class="big_board"><div class="board_title">爱特文管－解压结果</div></div>
HTML;
if(is_file(_decode($_GET['path']))==false) {
echo 'Hello,文件类型不对呀!';
} elseif(is_dir($_POST['dirpath'])==false) {
echo 'Hello,目标目录不存在哦!';
} elseif($_POST['ftype']==null) {
echo 'Hello,压缩包类型好像没选耶!';
} elseif($_POST['ftype']=='gz') {
if(function_exists('gzopen')==false) {
echo 'Hello,函数Gzopen无法启用!';
} elseif(($gz=gzopen(_decode($_GET['path']),"r"))==false) {
echo 'Hello,压缩包 '.basename(_decode($_GET['path'])).' 打开失败!';
} elseif(($data=gzread($gz,1024))==false) {
echo 'Hello,压缩包 '.basename(_decode($_GET['path'])).' 读取失败!';
} else {
$fp=preg_replace("/(.*?)(\.gz)$/i","\\1",$_POST['dirpath'].'/'.basename(_decode($_GET['path'])));
$fp=fopen($fp,"a+");
fwrite($fp,$data);
while(!feof($gz)) {
fwrite($fp,gzread($gz,1024));
}
fclose($fp);
gzclose($gz);
echo 'Hello,压缩包 '.basename(_decode($_GET['path'])).' 解压成功!';
}
}elseif($_POST['ftype']=='bz2') {
if(function_exists('bzopen')==false) {
echo 'Hello,函数Bzopen无法启用!';
} elseif(($bz2=bzopen(_decode($_GET['path']),"r"))==false) {
echo 'Hello,压缩包 '.basename(_decode($_GET['path'])).' 打开失败!';
} elseif(($data=bzread($bz2,1024))==false) {
echo 'Hello,压缩包 '.basename(_decode($_GET['path'])).' 读取失败!';
} else {
$fp=preg_replace("/(.*?)(\.bz2)$/i","\\1",$_POST['dirpath'].'/'.basename(_decode($_GET['path'])));
$fp=fopen($fp,"a+");
fwrite($fp,$data);
while(!feof($bz2)) {
fwrite($fp,gzread($bz2,1024));
}
fclose($fp);
bzclose($bz2);
echo 'Hello,压缩包 '.basename(_decode($_GET['path'])).' 解压成功!';
}
}elseif($_POST['ftype']=='zip') {
require 'pclzip.lib.php';
$pk=new pclzip(_decode($_GET['path']));
if(($count=$pk->extract(PCLZIP_OPT_PATH,$_POST['dirpath']))==false) {
echo 'Hello,压缩包 '.basename(_decode($_GET['path'])).' 解压失败!';
} else {
echo 'Hello,压缩包 '.basename(_decode($_GET['path'])).' 解压成功!';
echo '<div class="big_board"><div class="board_title"></div></div>-&gt;&gt;Hello,共解出档案 '.count($count).' 个哦!';
}
} elseif($_POST['ftype']=='tar') {
require 'tar.php';
$tar=new Archive_Tar(_decode($_GET['path']));
if(($count=$tar->extract($_POST['dirpath']))==false) {
echo 'Hello,压缩包 '.basename(_decode($_GET['path'])).' 解压失败!';
} else {
echo 'Hello,压缩包 '.basename(_decode($_GET['path'])).' 解压成功!';
}
} elseif($_POST['ftype']=='rar') {
if(function_exists('rar_open')) {
if(($rar=rar_open(_decode($_GET['path'])))==false) {
echo 'Hello,函数Rar_open无法启用!';
} else {
$entries = rar_list($rar);
foreach ($entries as $entry) {
echo '文件名称: '.$entry->getName().".<br />";
echo '压档大小: '.number_format(($entry->getPackedSize())/1024/1024,3)." MB<br />";
echo '原始大小: '.number_format(($entry->getUnpackedSize())/1024/1024,3)." MB<br />";
$entry->extract($_POST['dirpath']);
}
rar_close($rar);
}
} else {
if(function_exists('shell_exec')==false) {
echo 'Hello,主机禁用了核心函数哦!';
} elseif(shell_exec('rar x '._decode($_GET['path']).' '.$_POST['dirpath'])==false) {
echo 'Hello,相关系统命令执行失败!';
} else {
echo 'Hello,相关系统命令执行成功!';
}
}
} elseif($_POST['ftype']=='other') {
if(function_exists('shell_exec')==false) {
echo 'Hello,主机禁用了核心函数哦!';
} elseif(shell_exec('7z x '._decode($_GET['path']).' -r -o'.$_POST['dirpath'])==false) {
echo 'Hello,相关系统命令执行失败!';
} else {
echo 'Hello,相关系统命令执行成功!';
}
} else {
echo 'Hello,不支持本类型文件解压!';
}
echo <<<HTML
<div class="big_board"><div class="board_title">By：Admin@Aite.Me</div></div>
</body>
</html>
HTML;
?>
