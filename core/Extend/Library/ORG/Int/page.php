<?php
 class page{
 private $data = null;
 private $char = null;
 private $type = null;
 private $pageSize = null;
 private $countStrlen = null; 
 private $countPage = null;
 const dataType = 'path';
 const dataChar = 'UTF-8';
 const pageSize = '1000';
 function setChar($char = self::dataChar) {
 $this->char = $char;
 return $this->char;
 }
 function setType($type = self::dataType) {
 $this->type = $type;
 return $this->type;
 }
 function setSize($size = self::pageSize) {
 $this->pageSize = $size;
 return $this->pageSize;
 }
 function readData($data) {
 if($this->type == 'path') {
 $this->data = file_get_contents($data);
 } else {
 $this->data = $data;
 }
 }
 function countStrlen() {
 $this->countStrlen = iconv_strlen($this->data,$this->char);
 return $this->countStrlen;
 }
 function countPage() {
 $this->countPage = ceil($this->countStrlen / $this->pageSize);
 return $this->countPage;
 }
 function printPage($page,$radio) {
 if($page == null  || $page==0  ||  $page==1) {
 $page = 1;
 } elseif(preg_match('/^([0-9]*)$/',$page) == false) {
 $page = 1;
 }
 $i = $page * $this->pageSize - $this->pageSize;
 $print = iconv_substr($this->data,$i,$this->pageSize,$this->char);
if($radio==0) {
 $print = str_replace(array('&','<','>'),array('&amp;','&lt;','&gt;'),$print);
 }
 return $print;
 }
 }
?>