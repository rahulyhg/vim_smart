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
<title>文件管理－文件信息</title>
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
<div class="big_board"><div class="board_title">爱特文管－文件信息</div></div>
HTML;
if(is_file(_decode($_GET['path']))==false) {
echo 'Hello,文件信息查询出错!';
} else {
echo '文件名称：<br/>'.basename(_decode($_GET['path']));
echo '<div class="big_board"><div class="board_title"></div></div>';
echo '文件大小：<br/>'._filesize(_decode($_GET['path']));
echo '<div class="big_board"><div class="board_title"></div></div>';
echo '文件类型：<br/>'._filemime(_decode($_GET['path']));
echo '<div class="big_board"><div class="board_title"></div></div>';
echo '文件权限：<br/>'.substr(sprintf('%o',fileperms(_decode($_GET['path']))),-4);
echo '<div class="big_board"><div class="board_title"></div></div>';
echo '最后访问：<br/>'.gmdate("Y-m-d H:i:s",fileatime(_decode($_GET['path']))+8*3600);
echo '<div class="big_board"><div class="board_title"></div></div>';
echo '最后修改：<br/>'.gmdate("Y-m-d H:i:s",filemtime(_decode($_GET['path']))+8*3600);
echo '<div class="big_board"><div class="board_title"></div></div>';
echo '文件校验(MD5)：<br/>'.md5_file(_decode($_GET['path']));
echo '<div class="big_board"><div class="board_title"></div></div>';
echo '文件校验(SHA1)：<br/>'.sha1_file(_decode($_GET['path']));

echo '<div class="big_board"><div class="board_title"></div></div>';
echo <<<HTML
<form action="unpk.php?path={$_GET['path']}" method="post">
超级文件解压(FULL)：<br/>
目标目录：<input type="text" name="dirpath"/><br />
<input type="radio" name="ftype" value="gz" checked/>GZ<input type="radio" name="ftype" value="bz2" checked/>BZ2<input type="radio" name="ftype" value="zip" checked/>ZIP<input type="radio" name="ftype" value="tar"/>TAR<input type="radio" name="ftype" value="rar"/>RAR<input type="radio" name="ftype" value="other"/>OTHER<br/>
<input type="submit" value="UNPACK"/>
</form>
HTML;
}
echo <<<HTML
<div class="big_board"><div class="board_title">By：Admin@Aite.Me</div></div>
</body>
</html>
HTML;
?>
