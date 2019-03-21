<?php

/*

 * 生活服务

 *

 */

class LifeserviceAction extends BaseAction{

     
	protected $api_path = 'http://xxx-service.meihua.com/api/';//屏掉

    public function post(){

		header("Content-type: application/json");

		if(empty($this->user_session)){

			exit(json_encode(array('err_code'=>99,'err_msg'=>'需要登录')));

		}

		if(IS_POST && IS_AJAX){

			$liveServiceTypeArr = explode(',',$this->config['live_service_type']);

			switch($_POST['type']){

				//得到水电煤欠费信息

				case 'water':

				case 'electric':

				case 'gas':

					exit(in_array($_POST['type'],$liveServiceTypeArr) ? $this->get_debt($_POST['account'],$_POST['type']) : json_encode(array('err_code'=>1001,'err_msg'=>'不支持该类型欠费的信息查询')));

				//得到水费缴费信息

				case 'water_recharge':

				case 'electric_recharge':

				case 'gas_recharge':

					exit(in_array(str_replace('_recharge','',$_POST['type']),$liveServiceTypeArr) ? $this->recharge($_POST['id'],$_POST['balance']) : json_encode(array('err_code'=>1002,'err_msg'=>'不支持该类型欠费的信息查询')));

			}

		}else{

			exit(json_encode(array('err_code'=>1000,'err_msg'=>'非法访问')));

		}

    }

	//返回欠费信息

	protected function get_debt($account,$type){

		$api_data = array();

		$api_data['app_id'] = $this->config['live_service_appid'];

		$api_data['type'] = $type;

		$api_data['city_id'] = $this->config['now_city'];

		$api_data['account'] = $account;

		$api_data['key'] = $this->get_encrypt_key($api_data,$this->config['live_service_appkey']);

		$return = $this->curl_post($this->api_path.'app_debt.php',$api_data);

		$returnArr = json_decode($return,true);

		if(!isset($returnArr['err_code'])){

			return json_encode(array('err_code'=>1003,'err_msg'=>'请求查询失败，请重试'));

		}

		if($returnArr['err_code'] == 0){

			$data_service_order['third_id'] = $returnArr['orderId'];

			$data_service_order['status'] = 0;

			$data_service_order['uid'] = $this->user_session['uid'];

			$data_service_order['balance'] = $returnArr['balance'];

			$data_service_order['type'] = ($type == 'water' ? '1' : ($type == 'electric' ? '2' : '3'));

			$data_service_order['add_time'] = $_SERVER['REQUEST_TIME'];

			$data_service_order['info'] = serialize(array('account'=>$returnArr['account'],'accountName'=>$returnArr['accountName'],'cityName'=>$returnArr['cityName'],'contractNo'=>$returnArr['contractNo'],'payType'=>$returnArr['payType'],'payUnitName'=>$returnArr['payUnitName'],'provinceName'=>$returnArr['provinceName']));

			if($returnArr['orderId'] = D('Service_order')->data($data_service_order)->add()){

				return json_encode($returnArr);

			}else{

				return json_encode(array('err_code'=>1004,'err_msg'=>'网站内部异常，请重试'));

			}

		}

		return $return;

	}

	//返回缴费信息

	protected function recharge($id,$balance){

		if(empty($id)) return json_encode(array('err_code'=>1005,'err_msg'=>'网站内部异常，请重试'));

		if(empty($balance)) return json_encode(array('err_code'=>1006,'err_msg'=>'请求时没有携带缴费金额参数'));

		$now_user = D('User')->get_user($this->user_session['uid']);

		if($balance > $now_user['now_money']) return json_encode(array('err_code'=>98,'err_msg'=>'您的帐户余额为 <span>'. $now_user['now_money'].'</span> 元，请先充值帐户余额'));

		$now_order = D('Service_order')->field(true)->where(array('order_id'=>$id))->find();

		if(empty($now_order)) return json_encode(array('err_code'=>1009,'err_msg'=>'该订单不存在'));

		if($now_order['status'] == 1) return json_encode(array('err_code'=>1010,'err_msg'=>'该订单已经付款'));

		

		$api_data = array();

		$api_data['app_id'] = $this->config['live_service_appid'];

		$api_data['order_id'] = $now_order['third_id'];

		$api_data['key'] = $this->get_encrypt_key($api_data,$this->config['live_service_appkey']);

		$return = $this->curl_post($this->api_path.'app_recharge.php',$api_data);

		$returnArr = json_decode($return,true);

		if(!isset($returnArr['err_code'])){

			return json_encode(array('err_code'=>1003,'err_msg'=>'请求查询失败，请重试'));

		}

		if($returnArr['err_code'] == 0){

			D('Service_order')->where(array('order_id'=>$id))->data(array('status'=>$returnArr['status'],'pay_time'=>$returnArr['pay_time'],'pay_money'=>$returnArr['ordercash']))->save();

			$money_pay_result = D('User')->user_money($now_user['uid'],$returnArr['ordercash'],'充值 '.$this->get_type_txt($now_order['type']));

			

			$now_user = D('User')->field('`openid`,`phone`,`nickname`')->where(array('uid'=>$now_user['uid']))->find();

			//模板消息通知、短信通知		

			if ($now_user['openid']) {

				$href = $this->config['site_url'].'/wap.php';

				$model = new templateNews($this->config['wechat_appid'],$this->config['wechat_appsecret']);

				$model->sendTempMsg('TM01008', array('href' => $href, 'wecha_id' => $now_user['openid'], 'first' => $this->get_type_txt($now_order['type']).'缴费成功提醒', 'keynote1' =>$returnArr['unitName'], 'keynote2' =>'户号 '. $returnArr['account'], 'remark' => '缴费时间：'.date('Y年n月j日 H:i',$returnArr['pay_time']).'\n'.'缴费金额：￥'.$returnArr['ordercash']));

			}

			

			return json_encode(array('err_code'=>0,'err_msg'=>'充值成功'));

		}

		return $return;

	}

	protected function get_type_txt($type){

		switch($type){

			case '1':

				$type_txt = '水费';

				break;

			case '2':

				$type_txt = '电费';

				break;

			case '3':

				$type_txt = '煤气费';

				break;

			default:

				$type_txt = '生活服务';

		}

		return $type_txt;

	}

	//CURL POST

	protected function curl_post($url,$data){

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		curl_setopt($ch, CURLOPT_POST, 1);

		curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));

		return curl_exec($ch);

	}

}