<?php
/**
 * crontab运行脚本文件
 */
include_once 'cms/Lib/ORG/Yeelink.class.php';

//--Memcache begin
$connect = new Memcached;  //声明一个新的memcached链接
$connect->setOption(Memcached::OPT_COMPRESSION, false); //关闭压缩功能
$connect->setOption(Memcached::OPT_BINARY_PROTOCOL, true); //使用binary二进制协议
$connect->addServer('f120e580f9b74ec5.m.cnhzaliqshpub001.ocs.aliyuncs.com', 11211); //添加OCS实例地址及端口号
//--Memcache end

//检查开关最后更新时间,并执行关门操作
$drive = $connect->get("drive");
$yeelink=new Yeelink($apikey='b11cb20c2903230a0463fdc6ce337e2d',$drive["driveid"]);
if($yeelink->getStatus($drive["sensorid"])==1){
	if(time()-$d1>10){
		$yeelink->yeelink($sensorid=$drive["sensorid"],0);	//触发开关关
		sleep(2);
	}
}

?>