<?php 

function xml2array($xml){   
	//禁止引用外部xml实体
	libxml_disable_entity_loader(true);
	$result= json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);        
	return $result;
}

function makeSign($data){
	//微信支付秘钥
	$key = 'FK3939483FK3JFK3JFK3JFKL3JLKFJ3L';
	// 去空
	$data=array_filter($data);
	//签名步骤一：按字典序排序参数
	ksort($data);
	$string_a=http_build_query($data);
	$string_a=urldecode($string_a);
	//签名步骤二：在string后加入KEY
	//$config=$this->config;
	$string_sign_temp=$string_a."&key=".$key;
	//签名步骤三：MD5加密
	$sign = md5($string_sign_temp);
	// 签名步骤四：所有字符转为大写
	$result=strtoupper($sign);
	return $result;
}

/**
 * 微信支付回调验证
 * 此方法写在 支付统一下单设定的 支付回调链接(notify_url参数)对应的方法里边
 * 比如你的支付回调链接是:http://yourhost/notify.php   这个方法就是放在该链接对应的方法里边执行
 * 此方法在回调方法里边,接收微信支付服务器返回的数据,并判断支付结果
 */
function notify(){
	
	$xml = $GLOBALS['HTTP_RAW_POST_DATA'];		//获取微信支付服务器返回的数据
			
	// 这句file_put_contents是用来查看服务器返回的XML数据 测试完可以删除了
	file_put_contents('./log.txt',$xml,FILE_APPEND);


	//将服务器返回的XML数据转化为数组
	$data = xml2array($xml);
	// 保存微信服务器返回的签名sign
	$data_sign = $data['sign'];
	// sign不参与签名算法
	unset($data['sign']);
	$sign = makeSign($data);

	// 判断签名是否正确  判断支付状态
	if ( ($sign===$data_sign) && ($data['return_code']=='SUCCESS') && ($data['result_code']=='SUCCESS') ) {
		$result = $data;
		
		//获取服务器返回的数据
		$order_sn = $data['out_trade_no'];			//订单单号
		$openid = $data['openid'];					//付款人openID
		$total_fee = $data['total_fee'];			//付款金额
		$transaction_id = $data['transaction_id']; 	//微信支付流水号
		
		file_put_contents('./log1.txt',$xml,FILE_APPEND);
		
		//在此更新数据库
		
		
	}else{
		$result = false;
	}
	// 返回状态给微信服务器
	if ($result) {
		$str='<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>';
	}else{
		$str='<xml><return_code><![CDATA[FAIL]]></return_code><return_msg><![CDATA[签名失败]]></return_msg></xml>';
	}
	echo $str;
	return $result;
}


notify();	//支付回调

/* function refund(){
	require_once "wxpay.class.php";
	$config = array(
		'appid'			=> 'wx123456789876',
		'mch_id'	 	=> '123456789',
		'pay_apikey' 	=> '123456789876123456789876123456789876',
		'api_cert'		=> getcwd().'/cert/apiclient_cert.pem',	
		'api_key'		=> getcwd().'/cert/apiclient_key.pem'
	);

	$wxpay = new WxPay($config);
	
	$transaction_id = '4005372001201708309134677410';
	$out_refund_no = date('YmdHis').mt_rand(1000,9999);
	$total_fee = 0.01;
	$refund_fee = 0.01;
	
	$result = $wxpay->refund($transaction_id,$out_refund_no,$total_fee,$refund_fee);
	
	print_r($result);
}
refund(); */
?>
