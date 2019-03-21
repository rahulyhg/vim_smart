<?php

bpBase::loadAppClass('base', '', 0);

class payreturn_controller extends base_controller//这里一定要继承base_controller不能死common_controller，否则微信访问不到此页面
{
	public function __construct()
	{
		parent::__construct();
		$session_storage = getSessionStorageType();
		bpBase::loadSysClass($session_storage);
	}

	public function checkSign($data,$key)
	{
		$tmpData = $data;
		unset($tmpData['sign']);
		$sign = $this->getSign($tmpData,$key);//本地签名
		if ($data['sign'] == $sign) {
			return TRUE;
		}
		return FALSE;
	}
	public function getSign($Obj,$key)
	{
		foreach ($Obj as $k => $v)
		{
			$Parameters[$k] = $v;
		}
		//签名步骤一：按字典序排序参数
		ksort($Parameters);
		$String = $this->formatBizQueryParaMap($Parameters, false);
		//echo '【string1】'.$String.'</br>';
		//签名步骤二：在string后加入KEY
		$String = $String."&key=".$key;
		//echo "【string2】".$String."</br>";
		//签名步骤三：MD5加密
		$String = md5($String);
		//echo "【string3】 ".$String."</br>";
		//签名步骤四：所有字符转为大写
		$result_ = strtoupper($String);
		//echo "【result】 ".$result_."</br>";
		return $result_;
	}
	public function formatBizQueryParaMap($paraMap, $urlencode)
	{
		$buff = "";
		ksort($paraMap);
		foreach ($paraMap as $k => $v)
		{
			if($urlencode)
			{
				$v = urlencode($v);
			}
			//$buff .= strtolower($k) . "=" . $v . "&";
			$buff .= $k . "=" . $v . "&";
		}
		$reqPar;
		if (strlen($buff) > 0)
		{
			$reqPar = substr($buff, 0, strlen($buff)-1);
		}
		return $reqPar;
	}
	public function arrayToXml($arr)
	{
		$xml = "<xml>";
		foreach ($arr as $key=>$val)
		{

			if (is_numeric($val))
			{
				$xml.="<".$key.">".$val."</".$key.">";

			}
			else
				$xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
		}
		$xml.="</xml>";
		return $xml;
	}
	public function log_result($file,$word)
	{
		$word=utf8_encode(strftime("%Y-%m-%d-%H:%M:%S",time())."\n".$word."\n");
		$fp = fopen($file,"a");
		flock($fp, LOCK_EX) ;
		fwrite($fp,$word);
		flock($fp, LOCK_UN);
		fclose($fp);
	}
	public function xmlToArray($xml)
	{
		libxml_disable_entity_loader(true);
		//将XML转为array
		$array_data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
		return $array_data;
	}
	public function return_url()
	{
		$key='kfi4fkfigk4igkfi2lgigkfigk3igkfi'; //密钥
		$xml = file_get_contents('php://input');  //存储微信的回调
		$xml =$this->xmlToArray($xml);
		$returnXml=array();
		//验证签名，并回应微信。
		//对后台通知交互时，如果微信收到商户的应答不是成功或超时，微信认为通知失败，
		//微信会通过一定的策略（如30分钟共8次）定期重新发起通知，
		//尽可能提高通知的成功率，但微信不保证通知最终能成功。
		if($this->checkSign($xml,$key) == FALSE){
			$returnXml["return_code"]="FAIL";//返回状态码
			$returnXml["return_msg"]="fail";//返回状态码
			echo $this->arrayToXml($returnXml);
			die;//如果签名错误直接不处理
		}else{
			$returnXml["return_code"]="SUCCESS";//返回状态码
			$returnXml["return_msg"]="ok";//返回状态码
			echo $this->arrayToXml($returnXml);
		}
		if($this->checkSign($xml,$key) == TRUE){
			if ($xml["return_code"] == "FAIL") {
			}
			elseif($xml["result_code"] == "FAIL"){
			}
			else{
				if($xml['is_subscribe']=='Y'){
					$xml['is_subscribe']=1;
				}
				if($xml['is_subscribe']=='N'){
					$xml['is_subscribe']=0;
				}
                //file_put_contents('/home/run.log','2'."\r\n", FILE_APPEND);
               // M('cashier')->update(array('goods_id'=>2),array('id'=>49460));
				$orderDb = M('cashier_order');
				$orderDb->update(array('ispay'=>1,'paytime'=>time()),array('order_id'=>$xml['out_trade_no']));	//支付成功后改变其订单状态
				$orderInfo = $orderDb->get_one(array('order_id'=>$xml['out_trade_no']), '*');
				$fansDb=M('cashier_fans');
				$fansInfo=$fansDb->get_one(array('mid'=>$orderInfo['mid'],'openid'=>$orderInfo['openid']),'*');
				$fansDb->update(array('is_subscribe'=>$xml['is_subscribe'],'totalfee'=>$fansInfo['totalfee']+$xml['total_fee']),array('mid'=>$orderInfo['mid'],'openid'=>$orderInfo['openid']));
				M('meal_order')->update(array('paid'=>1,'pay_time'=>time()),array('orderid'=>$xml['out_trade_no']));	//支付成功后改变其快店订单状态
			}
		}
	}
}

?>