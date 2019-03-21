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
Header('Content-Type:application/octet-stream');
header('accept-length:'.filesize($path));
Header('Content-Disposition:attachment;filename='.path2name($path));
readfile($path);
?>