<?php
include_once 'cms/Lib/ORG/Yeelink.class.php';
include_once 'cms/Lib/ORG/WarnMessage.class.php';
include_once 'cms/Lib/ORG/PdoDb.class.php';

//file_put_contents('/home/run.log', "begin".date('Y-m-d H:i:s')."\r\n", FILE_APPEND);

//--Memcache begin
$connect = new Memcached;  //声明一个新的memcached链接
$connect->setOption(Memcached::OPT_COMPRESSION, false); //关闭压缩功能
$connect->setOption(Memcached::OPT_BINARY_PROTOCOL, true); //使用binary二进制协议
$connect->addServer('f120e580f9b74ec5.m.cnhzaliqshpub001.ocs.aliyuncs.com', 11211); //添加OCS实例地址及端口号
//--Memcache end
$arr_key=unserialize($connect->get("arr_key"));
//print_r($arr_key);exit;

if(is_array($arr_key)){
	foreach($arr_key as $key=>$val){
		$yeelink=new Yeelink($apikey=$val['apikey'],$deviceid=$val['nodeid'],'http://api.yeelink.net/v1.1/device/');
		if($yeelink->getStatus($sensorid=$val['sensorid'])==1){	//判断是否是开启状态
			//if(time()-$val['datetime']>1){
				$yeelink->yeelink($sensorid=$val['sensorid'],$status=0);	//触发开关关
				//sleep(2);
			//}
		}
	}
}


//整合了监控计划，先读表
//准备pdo配置
$config_array_smart_payrecord = array(
	'db_host'=>'rds66568gp739413snzpo.mysql.rds.aliyuncs.com',
	'db_name'=>'vhi_smart',
	'db_username'=>'vhi_smart',
	'db_password'=>'Vhi_smart123',
	'db_charset'=>'utf8',
	'db_table'=>'smart_payrecord'
);
//实例化PDO
$pdo_smart_payrecord = new PdoDb($config_array_smart_payrecord);
//查询轮询的主要配置
$sql1 = 'select value from smart_config WHERE name="wait_time" limit 1';
$sql2 = 'select value from smart_config WHERE name="warning_start" limit 1';
$sql3 = 'select value from smart_config WHERE name="warning_end" limit 1';
$wait_time = $pdo_smart_payrecord->query($sql1);
$warning_start = $pdo_smart_payrecord->query($sql2);
$warning_end = $pdo_smart_payrecord->query($sql3);

//查询判断条件：如果在库里面有一条一样的异常情况未处理的话，就将停止。
$sql4 = 'select count(*) as num from pigcms_system_warning_control WHERE system_id=5 and is_deal=0';
$is_end_work = $pdo_smart_payrecord->query($sql4);
if($is_end_work[0]['num']==0){
	//只有当前面没有任何未处理信息才进行轮询
	//工作日时间最近n小时内无人使用停车系统
	if( date('w',time())==0 ||  date('w',time())==6) {
		//周末内容
		echo '非工作日';

	}else if(strtotime($warning_start[0]['value'])<time()&&time()<strtotime($warning_end[0]['value'])){
		$show_time = time()-$wait_time[0]['value']*3600;
		//工作日内容
		$payrecord_count=$pdo_smart_payrecord->count("pay_status='1' and pay_time>".$show_time);
		if($payrecord_count==0){
			//异常
			//$this->warning_data_add('index',CONTROLLER_NAME,'3001','设置时间内没有一笔订单','交易异常，检查是否程序有错误');
			$message = new WarnMessage('index','Warning','1031','设置时间内没有一笔订单','交易异常，检查是否程序有错误');
			$arr = $message->get_data_pdo();
			echo '交易异常';
		}else{
			echo '正在监听，运转正常';
		}

	}else{
		echo '设置时间已过，结束日程安排！';

	}
}
?>