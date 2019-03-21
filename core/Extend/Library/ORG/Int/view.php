<?php
require 'user.php';
require 'page.php';
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
<title>文件管理－查看</title>
<style type="text/css">
.big_board{background-color:#009BCE;color:#FFF;}
.board_title{margin-bottom:1px;border:1px solid #09F;}
</style>
</head>
<body>
<div class="big_board"><div class="board_title">爱特文管－路径信息</div></div>
HTML;
echo '<a href="index.php?path='._encode(dirname(_decode($_GET['path']))).'">'.dirname(_decode($_GET['path'])).'</a>/'.basename(_decode($_GET['path']));
if($_GET['read']==null) {
echo '<div class="big_board"><div class="board_title">爱特文管－分页查看</div></div>';
$page=new page();
$page->setsize(777);
$_GET['char']!=null ? $page->setchar($_GET['char']) : $page->setchar();
$page->settype();
$page->readdata(_decode($_GET['path']),0);
echo nl2br($page->printpage($_GET['page']));
if($page->countStrlen()!=0) {
echo '<div class="big_board"><div class="board_title">爱特文管－页面导航</div></div>';
$p_a=$page->countpage()>1 && $_GET['page']>1 ? ' <a href="view.php?path='.$_GET['path'].'&amp;page=1&amp;char='.$_GET['char'].'">首页</a>' : null;
$p_z=$page->countpage()>1 && $_GET['page']<$page->countpage() ? ' <a href="view.php?path='.$_GET['path'].'&amp;page='.$page->countpage().'&amp;char='.$_GET['char'].'">尾页</a>' : null;
echo '共 '.$page->countStrlen().' 字'.$p_a.$p_z;
echo '<div class="big_board"><div class="board_title"></div></div>';
if(($page->countpage()>1)&&($_GET['page']>1)) {
$prev=$_GET['page']-1;
echo '<a href="view.php?path='.$_GET['path'].'&amp;page='.$prev.'&amp;char='.$_GET['char'].'">上一页</a>';
}
echo $_GET['page']>1 && $_GET['page']<$page->countpage() ? '|' : ' ';
if($page->countpage()>1 && $_GET['page']<$page->countpage()) {
if($_GET['page']==0 || $_GET['page']==null || $_GET['page']==1) {
$next=2;
} else {
$next=$_GET['page']+1;
}
echo '<a href="view.php?path='.$_GET['path'].'&amp;page='.$next.'&amp;char='.$_GET['char'].'">下一页</a>';
}
$p=preg_match('/^([0-9]+)$/',$_GET['page']) ? $_GET['page'] : '1';
echo '第&nbsp;&nbsp;'.$p.'/'.$page->countpage().'&nbsp;&nbsp;页';
} else {
echo 'Hello,没有内容可以查看额!';
}
echo '<div class="big_board"><div class="board_title">爱特文管－快捷跳转</div></div>';
echo <<<HTML
<a href="{$_SERVER['PHP_SELF']}?path={$_GET['path']}&read=read">全文查看</a>.<a href="viewcode.php?path={$_GET['path']}">高亮</a>.<a href="editor.php?path={$_GET['path']}">编辑模式</a><br/>
<form action="{$_SERVER['PHP_SELF']}" method="get">
<input type="text" name="page"/>
<input type="hidden" name="path" value="{$_GET['path']}"/>
<input type="hidden" name="char" value="{$_GET['char']}"/>
<input type="submit" value="跳转"/>
</form>
<div class="big_board"><div class="board_title">爱特文管－编码设置</div></div>
<form action="{$_SERVER['PHP_SELF']}" method="get">
<input type="hidden" name="page" value="{$_GET['page']}"/>
<input type="hidden" name="path" value="{$_GET['path']}"/>
<input type="text" name="char" value="{$_GET['char']}"/>
<input type="submit" value="设置"/>
</form>
HTML;
} else {
echo <<<HTML
<div class="big_board"><div class="board_title">爱特文管－全文查看</div></div>
HTML;
$iread=file_get_contents(_decode($_GET['path']));
$iread=str_replace(array('&','<','>'),array('&amp;','&lt;','&gt;'),$iread);
echo nl2br($iread);
echo <<<HTML
<div class="big_board"><div class="board_title">爱特文管－快捷按钮</div></div>
<a href="{$_SERVER['PHP_SELF']}?path={$_GET['path']}&page=1">分页查看</a>.<a href="viewcode.php?path={$_GET['path']}">高亮</a>.<a href="editor.php?path={$_GET['path']}">编辑模式</a>
HTML;
}
echo <<<HTML
<div class="big_board"><div class="board_title">By：Admin@Aite.Me</div></div>
HTML;
?>