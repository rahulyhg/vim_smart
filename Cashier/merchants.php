<?php
/*$domain1 = "www.dede168.com";
$domain2 = "127.0.0.1";
$LOCALDOMAIN = $_SERVER["HTTP_HOST"];
if(strstr($LOCALDOMAIN,$domain1)== false and strstr($LOCALDOMAIN,$domain2)== false){
exit("dede168源码网温馨提示：你的授权域名不正确！");
}*/
	define('ABS_PATH', dirname(__FILE__).DIRECTORY_SEPARATOR);
	define('PIGCMS_CORE_PATH','./pigcms/');
	define('PIGCMS_TPL_PATH','./pigcms_tpl/');
	define('PIGCMS_STATIC_PATH','./pigcms_static/');
	define('APP_NAME','Merchants');
	define('DEBUG',true);
	define('GZIP',true);
	include ABS_PATH.'config'.DIRECTORY_SEPARATOR.'config.inc.php';
	include ABS_PATH.PIGCMS_CORE_PATH.'base.php';
	bpBase::creatApp();
?>