<?php
error_reporting(0);
session_start();
if(file_exists('config.php')==true) {
require 'config.php';
if(LOGIN==false) {
$_SESSION['status']=true;
}
}
if(file_exists('userinfo.php')==false) {
Header('Location:install.php');
exit;
} elseif($_SESSION['status']==null) {
Header('Location:login.php');
exit;
} elseif($_SESSION['status']!=true) {
Header('Location:login.php');
exit;
}
?>