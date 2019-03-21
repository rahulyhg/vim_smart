<?php
function _encode($data) {
if($data!=null) {
$data=rawurlencode($data);
} else {
return false;
}
return $data;
}
function _decode($data) {
if($data!=null) {
$data=rawurldecode($data);
return $data;
} else {
return false;
}
}
function _opendir($path) {
if(preg_match('/[\/]$/',$path)==false) {
$path=$path.'/';
}
if(($handle=opendir($path))==false) {
return false;
}
while($f=readdir($handle)) {
$f=$path.$f;
if($f==($path.'.')) {
$data['.']=realpath($f);
} elseif($f==($path.'..')) {
$data['..']=realpath($f);
} elseif(is_dir($f)) {
$data['dir'][]=realpath($f);
} elseif(is_file($f)) {
$data['file'][]=realpath($f);
} else {
$data['other'][]=realpath($f);
}
}
return $data;
}
function path2name($path) {
return basename($path);
}
function _filesize($path) {
$size=filesize($path);
if($size<=1024) {
return $size.'B';
} elseif($size<=(1024*1024)) {
$size=$size/1024;
return number_format($size,3).'KB';
} elseif($size<=(1024*1024*1024)) {
$size=$size/1024/1024;
return number_format($size,3).'MB';
} else {
$size=$size/1024/1024/1024;
return number_format($size,3).'GB';
}
}
function _filemime($path) {
if(function_exists('finfo_open')==true) {
$finfo=finfo_open(FILEINFO_MIME);
$mime=finfo_file($finfo,$path);
finfo_close($finfo);
return $mime;
} elseif(function_exists('mime_content_type')==true) {
return mime_content_type($path);
} else {
return 'false';
}
}
function removeDir($dirName) {
if(!is_dir($dirName)) {
return false;
}
$handle=opendir($dirName);
while(($file=readdir($handle))!==false) {
if($file!="."&&$file!="..") {
$dir=$dirName."/".$file;
is_dir($dir) ? removeDir($dir) : unlink($dir);
}
}
closedir($handle);
return rmdir($dirName) ;
}
function removeFile($path) {
if(file_exists($path)==true) {
unlink($path);
}
if(file_exists($path)==false) {
return true;
} else {
return false;
}
}
function _view($path,$size) {
if(filesize($path)==0) {
return false;
}
if(($data=file_get_contents($path))==false) {
return false;
}
if(function_exists('iconv_substr')==true) {
$total_page=iconv_strlen($data,'utf-8')/$size;
if($total_page<=1) {
$total_page=1;
}
$i=1;
while($i<($total_page+1))  {
$idata[]=iconv_substr($data,$i*$size-$size,$size,'utf-8');
$i++;
}
return $idata;
} else {
return $data;
}
}
function _ReadData($path) {
if(($data=file_get_contents($path))==false) {
return $data=null;
} else {
return $data;
}
}
function urlupload($path,$furl) {
if(function_exists('curl_init')) {
$ch=curl_init();
if(($fp=fopen($path,'w'))==false) {
return false;
}
curl_setopt($ch,CURLOPT_URL,$furl);
curl_setopt($ch,CURLOPT_FILE,$fp);
curl_setopt($ch,CURLOPT_FOLLOWLOCATION,true);
curl_exec($ch);
curl_close($ch);
fclose($fp);
return true;
} else {
$fp=fopen($path,'w');
if(!$fp) return false;
$fp2=fopen($furl,'r');
if(!$fp2) return false;
while(!feof($fp2)) {
fwrite($fp,fread($fp2,8192));
}
fclose($fp2);
fclose($fp);
return true;
}
}
function is_url($str) {
return true;
}
?>
