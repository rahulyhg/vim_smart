<?php
class Store_orderModel extends Model
{
	
	public function get_order_by_id($uid, $order_id)
	{
		$condition = array();
		$condition['order_id'] = $order_id;
		$condition['uid'] = $uid;
		return $this->field(true)->where($condition)->find();
	}
	
	
	
	public function get_pay_order($uid, $order_id, $is_web=false)
	{
		$now_order = $this->get_order_by_id($uid, $order_id);
		if(empty($now_order)){
			return array('error'=>1,'msg'=>'当前订单不存在！');
		}
		if(!empty($now_order['paid'])){
			return array('error'=>1,'msg'=>'您已经支付过此订单！','url'=>str_replace('/source/','/',U('My/store_order_list',array('order_id'=>$now_order['order_id']))));
		}
		$order_info = array(
					'order_id'			=>	$now_order['order_id'],
					'mer_id'			=>	$now_order['mer_id'],
					'order_type'		=>	'store',
					'order_name'		=>	$now_order['name'],
					'order_num'			=>	0,
					'order_price'		=>	floatval($now_order['price']),
					'order_total_money'	=>	floatval($now_order['price']),
			);
		return array('error' => 0,'order_info' => $order_info);
	}
	
	//手机端支付前订单处理
	public function wap_befor_pay($order_info, $now_coupon, $merchant_balance, $now_user)
	{
		//去除微信优惠的金额
		$pay_money = $order_info['order_total_money'];
		
		//判断优惠券
		if (!empty($now_coupon['price'])) {
			$data_store_order['card_id'] = $now_coupon['record_id'];
			if ($now_coupon['price'] >= $pay_money) {
				$order_result = $this->wap_pay_save_order($order_info, $data_store_order);
				if ($order_result['error_code']) {
					return $order_result;
				}
				return $this->wap_after_pay_before($order_info);
			}
			$pay_money -= $now_coupon['price'];
		}
		
		//判断商家余额
		if (!empty($merchant_balance)) {
			if($merchant_balance >= $pay_money){
				$data_store_order['merchant_balance'] = $pay_money;
				$order_result = $this->wap_pay_save_order($order_info, $data_store_order);
				if ($order_result['error_code']) {
					return $order_result;
				}
				return $this->wap_after_pay_before($order_info);
			} else {
				$data_store_order['merchant_balance'] = $merchant_balance;
			}
			$pay_money -= $merchant_balance;
		}
		
		//判断帐户余额
		if (!empty($now_user['now_money'])) {
			if ($now_user['now_money'] >= $pay_money) {
				$data_store_order['balance_pay'] = $pay_money;
				$order_result = $this->wap_pay_save_order($order_info, $data_store_order);
				if ($order_result['error_code']) {
					return $order_result;
				}
				return $this->wap_after_pay_before($order_info);
			} else {
				$data_store_order['balance_pay'] = $now_user['now_money'];
			}
			$pay_money -= $now_user['now_money'];
		}
		//在线支付
		$order_result = $this->wap_pay_save_order($order_info, $data_store_order);
		if ($order_result['error_code']) {
			return $order_result;
		}
		return array('error_code' => false, 'pay_money' => $pay_money);
	}
	
	//手机端支付前保存各种支付信息
	public function wap_pay_save_order($order_info, $data_store_order)
	{
		$data_store_order['card_id'] 			= !empty($data_store_order['card_id']) ? $data_store_order['card_id'] : 0;
		$data_store_order['merchant_balance'] 	= !empty($data_store_order['merchant_balance']) ? $data_store_order['merchant_balance'] : 0;
		$data_store_order['balance_pay']	 	= !empty($data_store_order['balance_pay']) ? $data_store_order['balance_pay'] : 0;
		$data_store_order['dateline'] = $_SERVER['REQUEST_TIME'];
		$condition_store_order['order_id'] = $order_info['order_id'];
		$result = $this->where($condition_store_order)->data($data_store_order)->save();
		if ($result) {
			return array('error_code' => false, 'msg' => '保存订单成功！');
		} else {
			return array('error_code' => true, 'msg' => '保存订单失败！请重试或联系管理员。1');
		}
	}
	//如果无需调用在线支付，使用此方法即可。
	public function wap_after_pay_before($order_info)
	{
		$order_param = array(
				'order_id' => $order_info['order_id'],
				'pay_type' => '',
				'third_id' => '',
				'is_mobile' => 1,
			);
			$result_after_pay = $this->after_pay($order_param);
			if ($result_after_pay['error']) {
				return array('error_code' => true,'msg'=>$result_after_pay['msg']);
			}
			return array('error_code'=>false,'msg'=>'支付成功！','url'=>str_replace('/source/','/',U('My/store_order_list')));
	}
	
	//支付之后
	public function after_pay($order_param)
	{
		$now_order = $this->field(true)->where(array('order_id' => $order_param['order_id']))->find();
		if (empty($now_order)) {
			return array('error' => 1, 'msg' => '当前订单不存在！');
		} elseif($now_order['paid'] == 1) {
			return array('error' => 1, 'msg' => '该订单已付款！', 'url' => U('My/store_order_list',array('order_id'=>$now_order['order_id'])));
		} else {
			//得到当前用户信息，不将session作为调用值，因为可能会失效或错误。
			$now_user = D('User')->get_user($now_order['uid']);
			if (empty($now_user)) {
				return array('error' => 1, 'msg' => '没有查找到此订单归属的用户，请联系管理员！');
			}
			
			//判断优惠券是否正确
			if($now_order['card_id']){
				$now_coupon = D('Member_card_coupon')->get_coupon_by_recordid($now_order['card_id'],$now_order['uid']);
				if(empty($now_coupon)){
					return $this->wap_after_pay_error($now_order, $order_param, '您选择的优惠券不存在！');
				}
			}
			
			//判断会员卡余额
			$merchant_balance = floatval($now_order['merchant_balance']);
			if($merchant_balance){
				$user_merchant_balance = D('Member_card')->get_balance($now_order['uid'],$now_order['mer_id']);
				if($user_merchant_balance < $merchant_balance){
					return $this->wap_after_pay_error($now_order, $order_param, '您的会员卡余额不够此次支付！');
				}
			}
			//判断帐户余额
			$balance_pay = floatval($now_order['balance_pay']);
			if($balance_pay){
				if($now_user['now_money'] < $balance_pay){
					return $this->wap_after_pay_error($now_order, $order_param, '您的帐户余额不够此次支付！');
				}
			}
			
			//如果使用了优惠券
			if($now_order['card_id']){
				$use_result = D('Member_card_coupon')->user_card($now_order['card_id'], $now_order['mer_id'], $now_order['uid']);
				if($use_result['error_code']){
					return array('error'=>1,'msg'=>$use_result['msg']);
				}
			}
			
			//如果使用会员卡余额
			if ($merchant_balance) {
				$use_result = D('Member_card')->use_card($now_order['uid'],$now_order['mer_id'],$merchant_balance,'购买 '.$now_order['order_name'].' 扣除会员卡余额');
				if($use_result['error_code']){
					return array('error'=>1,'msg'=>$use_result['msg']);
				}
			}
			//如果用户使用了余额支付，则扣除相应的金额。
			if(!empty($balance_pay)){
				$use_result = D('User')->user_money($now_order['uid'],$balance_pay,'购买 '.$now_order['order_name'].' 扣除余额');
				if($use_result['error_code']){
					return array('error'=>1,'msg'=>$use_result['msg']);
				}
			}

			$condition_store_order['order_id'] = $order_param['order_id'];
			
			$data_store_order['pay_time'] = $_SERVER['REQUEST_TIME'];
			$data_store_order['payment_money'] = floatval($order_param['pay_money']);
			$data_store_order['pay_type'] = $order_param['pay_type'];
			$data_store_order['third_id'] = $order_param['third_id'];
			//$data_group_order['is_mobile_pay'] = $order_param['is_mobile'];
			$data_store_order['is_own'] = $order_param['is_own'];
			$data_store_order['paid'] = 1;
			if($this->where($condition_store_order)->data($data_store_order)->save()){
				/* 粉丝行为分析 */
// 				D('Merchant_request')->add_request($now_order['mer_id'],array('group_buy_count'=>$now_order['num'],'group_buy_money'=>$now_order['total_money']));
				
// 				$model = new templateNews(C('config.wechat_appid'), C('config.wechat_appsecret'));
//                 //推送到客户端
//                 $login_log = D("appapi_app_login_log")->field(true)->where(array('uid'=>$now_order['uid']))->order("create_time DESC")->find();
//                 if ($login_log) {
//                     $audience = array('tag'=>array($login_log['device_id']));
//                     //拼接extra pigcms_tag:order打开订单页  store打开店铺页  index打开首页  normal普通通知
//                     $extra = array(
//                         'pigcms_tag' => 'order',
//                         'store_id' => 0,
//                         'order_id' => $now_order['order_id']
//                     );
//                     $db = array(C('DB_PREFIX').'merchant_store'=>'ms', C('DB_PREFIX').'waimai_order'=>'wo');
//                     $store = D()->table($db)->field("`ms`.`name`")->where('`wo`.`order_id`='.$now_order['order_id'].' AND `ms`.`store_id`=`wo`.`store_id`')->find();
//                     $client = $login_log['client'];
//                     $title = C('config.group_alias_name').'提醒';
//                     if($now_order['tuan_type'] < 2){
//                         $msg = C('config.group_alias_name').'成功，您的消费码：'.$data_group_order['group_pass'];
//                     } else {
//                         $msg = C('config.group_alias_name').'成功，感谢您的使用';
//                     }
// //                     file_put_contents('./runtime/test.php',var_export($title.$msg,true));
//                     import('@.ORG.Jpush');
//                     $jpush = new Jpush(C('config.weixin_push_jpush_appkey'), C('config.weixin_push_jpush_secret'));
//                     $notification = $jpush->createBody($client, $title, $msg, $extra);

//                     $jpush->send("all", $audience, $notification);
//                 }
                
// 				if ($now_user['openid'] && $order_param['is_mobile']) {
// 					$href = C('config.site_url').'/wap.php?c=My&a=store_order_list';
// 					if($now_order['tuan_type'] < 2){
// 						$model->sendTempMsg('OPENTM201752540', array('href' => $href, 'wecha_id' => $now_user['openid'], 'first' => $this->config['group_alias_name'].'提醒', 'keyword1' => $now_order['order_name'], 'keyword2' => $now_order['order_id'], 'keyword3' => $now_order['total_money'], 'keyword4' => date('Y-m-d H:i:s'), 'remark' => $this->config['group_alias_name'].'成功，您的消费码：'.$data_group_order['group_pass']));
// 					} else {
// 						$model->sendTempMsg('OPENTM201752540', array('href' => $href, 'wecha_id' => $now_user['openid'], 'first' => $this->config['group_alias_name'].'提醒', 'keyword1' => $now_order['order_name'], 'keyword2' => $now_order['order_id'], 'keyword3' => $now_order['total_money'], 'keyword4' => date('Y-m-d H:i:s'), 'remark' => $this->config['group_alias_name'].'成功，感谢您的使用'));
// 					}
// 				}


// 				$sms_data = array('mer_id' => $now_order['mer_id'], 'store_id' => 0, 'type' => 'group');
// 				if (C('config.sms_success_order') == 1 || C('config.sms_success_order') == 3) {
// 					$sms_data['uid'] = $now_order['uid'];
// 					$sms_data['mobile'] = $now_order['phone'];
// 					$sms_data['sendto'] = 'user';
// 					if ($data_group_order['group_pass']) {
// 						$sms_data['content'] = '您购买 '.$now_order['order_name'].'的订单(订单号：' . $now_order['order_id'] . ')已经完成支付,您的消费码：' . $data_group_order['group_pass'];
// 					} else {
// 						$sms_data['content'] = '您购买 '.$now_order['order_name'].'的订单(订单号：' . $now_order['order_id'] . ')已经完成支付!';
// 					}
					
// 					Sms::sendSms($sms_data);
// 				}
// 				if (C('config.sms_success_order') == 2 || C('config.sms_success_order') == 3) {
// 					$merchant = D('Merchant')->where(array('mer_id' => $now_order['mer_id']))->find();
// 					$sms_data['uid'] = 0;
// 					$sms_data['mobile'] = $merchant['phone'];
// 					$sms_data['sendto'] = 'merchant';
// 					$sms_data['content'] = '顾客购买的' . $now_order['order_name'] . '的订单(订单号：' . $now_order['order_id'] . '),在' . date('Y-m-d H:i:s') . '时已经完成了支付！';
// 					Sms::sendSms($sms_data);
// 				}
				
				if($order_param['is_mobile']){
					return array('error'=>0,'url'=>str_replace('/source/','/',U('My/store_order_list',array('order_id'=>$now_order['order_id']))));
				}else{
					return array('error'=>0,'url'=>U('User/Index/store_order_list',array('order_id'=>$now_order['order_id'])));
				}
			}else{
				return array('error'=>1,'msg'=>'修改订单状态失败，请联系系统管理员！');
			}
		}
	}
	//支付时，金额不够，记录到帐号
	public function wap_after_pay_error($now_order,$order_param,$error_tips)
	{
		//记录充值的金额，因为 Pay/return_url 处没有返回order的具体信息，故在此调用。
		$user_result = D('User')->add_money($now_order['uid'],$order_param['pay_money'],'在线充值');
		if($user_result['error_code']){
			return array('error'=>1,'msg'=>$user_result['msg']);
		}else{
			if($order_param['is_mobile']){
				$return_url = str_replace('/source/','/',U('My/store_order_list',array('order_id'=>$now_order['order_id'])));
			}else{
				$return_url = U('User/Index/store_order_list',array('order_id'=>$now_order['order_id']));
			}
			return array('error'=>1,'msg'=>$error_tips.'已将您充值的金额添加到您的余额内。','url'=>$return_url);
		}
	}
}
?>