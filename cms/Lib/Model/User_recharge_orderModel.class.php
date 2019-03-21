<?php

class User_recharge_orderModel extends Model{

	public function get_pay_order($uid,$order_id,$is_web=false){

		$now_order = $this->get_order_by_id($uid,$order_id);

		// dump($this);exit;

		if(empty($now_order)){

			return array('error'=>1,'msg'=>'当前订单不存在！');

		}

		

		if($is_web){

			$order_info = array(

				'order_id'			=>	$now_order['order_id'],

				'order_type'		=>	($_GET['type'] == 'waimai-recharge' || $_POST['order_type'] == 'waimai-recharge') ? 'waimai-recharge' : 'recharge',

				'order_total_money'	=>	floatval($now_order['money']),

				'order_content'    =>  array(

						0=>array(

								'name'  		=> '在线充值',

								'num'   		=> 1,

								'price' 		=> floatval($now_order['money']),

								'money' 	=> floatval($now_order['money']),

						)

				)

			);

		}else{

			$order_info = array(

					'order_id'			=>	$now_order['order_id'],

					'order_type'		=>	($_GET['type'] == 'waimai-recharge' || $_POST['order_type'] == 'waimai-recharge') ? 'waimai-recharge' : 'recharge',

					'order_name'		=>	'在线充值',

					'order_num'			=>	1,

					'order_price'		=>	floatval($now_order['money']),

					'order_total_money'	=>	floatval($now_order['money']),

			);

		}

		return array('error'=>0,'order_info'=>$order_info);

	}

	public function get_order_by_id($uid,$order_id){

		$condition_user_recharge_order['uid'] = $uid;

		$condition_user_recharge_order['order_id'] = $order_id;

		return $this->field(true)->where($condition_user_recharge_order)->find();

	}

	//电脑站支付前订单处理

	public function web_befor_pay($order_info,$now_user){



		$data_user_recharge_order['last_time'] = $_SERVER['REQUEST_TIME'];

		$data_user_recharge_order['submit_order_time'] = $_SERVER['REQUEST_TIME'];

		$condition_user_recharge_order['order_id'] = $order_info['order_id'];

		if(!$this->where($condition_user_recharge_order)->data($data_user_recharge_order)->save()){

			return array('error_code'=>true,'msg'=>'保存订单失败！请重试或联系管理员。');

		}

		return array('error_code'=>false,'pay_money'=>$order_info['order_total_money']);



	}

	//手机端支付前订单处理

	public function wap_befor_pay($order_info,$now_coupon,$merchant_balance,$now_user){



		//去除微信优惠的金额

		$pay_money = $order_info['order_total_money'];

		

		//判断优惠券

		if(!empty($now_coupon['price'])){

			$data_weidian_order['card_id'] = $now_coupon['record_id'];

			if($now_coupon['price'] >= $pay_money){

				$order_result = $this->wap_pay_save_order($order_info,$data_weidian_order);

				if($order_result['error_code']){

					return $order_result;

				}

				return $this->wap_after_pay_before($order_info);

			}

			$pay_money -= $now_coupon['price'];

		}

		

		//判断商家余额

		if(!empty($merchant_balance)){

			if($merchant_balance >= $pay_money){

				$data_weidian_order['merchant_balance'] = $pay_money;

				$order_result = $this->wap_pay_save_order($order_info,$data_weidian_order);

				if($order_result['error_code']){

					return $order_result;

				}

				return $this->wap_after_pay_before($order_info);

			}else{

				$data_weidian_order['merchant_balance'] = $merchant_balance;

			}

			$pay_money -= $merchant_balance;

		}

		

		//判断帐户余额

		if(!empty($now_user['now_money'])){

			if($now_user['now_money'] >= $pay_money){

				$data_weidian_order['balance_pay'] = $pay_money;

				$order_result = $this->wap_pay_save_order($order_info,$data_weidian_order);

				if($order_result['error_code']){

					return $order_result;

				}

				return $this->wap_after_pay_before($order_info);

			}else{

				$data_weidian_order['balance_pay'] = $now_user['now_money'];

			}

			$pay_money -= $now_user['now_money'];

		}

		//在线支付

		$order_result = $this->wap_pay_save_order($order_info,$data_weidian_order);

		if($order_result['error_code']){

			return $order_result;

		}

		return array('error_code'=>false,'pay_money'=>$pay_money);

	}

	//手机端支付前保存各种支付信息

	public function wap_pay_save_order($order_info,$data_weidian_order){

		$data_weidian_order['card_id'] 			= !empty($data_weidian_order['card_id']) ? $data_weidian_order['card_id'] : 0;

		$data_weidian_order['merchant_balance'] 	= !empty($data_weidian_order['merchant_balance']) ? $data_weidian_order['merchant_balance'] : 0;

		$data_weidian_order['balance_pay']	 	= !empty($data_weidian_order['balance_pay']) ? $data_weidian_order['balance_pay'] : 0;

		$data_weidian_order['last_time'] = $_SERVER['REQUEST_TIME'];

		$condition_weidian_order['order_id'] = $order_info['order_id'];

		if($this->where($condition_weidian_order)->data($data_weidian_order)->save()){

			return array('error_code'=>false,'msg'=>'保存订单成功！');

		}else{

			return array('error_code'=>true,'msg'=>'保存订单失败！请重试或联系管理员。');

		}

	}

	//如果无需调用在线支付，使用此方法即可。

	public function wap_after_pay_before($order_info){

		$order_param = array(

			'order_id' => $order_info['order_id'],

			'pay_type' => '',

			'third_id' => '',

		);

		$result_after_pay = $this->after_pay($order_param);

		if($result_after_pay['error']){

			return array('error_code'=>true,'msg'=>$result_after_pay['msg']);

		}else{

			return array('error_code'=>false,'msg'=>'支付成功','url'=>$result_after_pay['url']);

		}

	}

//	public function after_pay($order_param){
//		if($order_param['pay_type']!='offline'){
//			/*if($order_param['return']){
//				$where['orderid'] = $order_param['order_id'];
//			}else{
//				$where['orderid'] = $order_param['orderid'];
//			}*/
//			$where['orderid'] = $order_param['order_id'];
//		}else{
//			$where['order_id'] = $order_param['order_id'];
//		}
//		$now_order = $this->field(true)->where($where)->find();
//		if(empty($now_order)){
//			return array('error'=>1,'msg'=>'当前订单不存在');
//		}else if($now_order['paid'] == 1){
//			if($order_param['order_type'] == 'waimai-recharge'){
//				if($order_param['is_mobile_pay']){
//					return array('error'=>1,'msg'=>'该订单已付款！','url'=>U('Waimai/User/index'));
//				}else{
//					return array('error'=>1,'msg'=>'该订单已付款！','url'=>U('Waimai/Asset/balance'));
//				}
//			}else{
//				return array('error'=>1,'msg'=>'该订单已付款！','url'=>$this->get_pay_after_url($now_order['label'],$now_order['is_mobile_pay']));
//			}
//		}else{
//			//得到当前用户信息，不将session作为调用值，因为可能会失效或错误。
//			$now_user = D('User')->get_user($now_order['uid']);
//			if(empty($now_user)){
//				return array('error'=>1,'msg'=>'没有查找到此订单归属的用户，请联系管理员！');
//			}
//			$data_user_recharge_order = array();
//			$data_user_recharge_order['pay_time'] = $_SERVER['REQUEST_TIME'];
//			$data_user_recharge_order['payment_money'] = floatval($order_param['pay_money']);
//			$data_user_recharge_order['pay_type'] = $order_param['pay_type'];
//			$data_user_recharge_order['third_id'] = $order_param['third_id'];
//			$data_user_recharge_order['paid'] = 1;
//			//print_r($data_user_recharge_order);exit;
//			if($this->where($where)->save($data_user_recharge_order)){
//				D('User')->add_money($now_order['uid'],$order_param['pay_money'],'在线充值');
//				if($order_param['order_type'] == 'waimai-recharge'){
//					return array('error'=>0,'msg'=>'充值成功！','url'=>U('Waimai/User/index'));
//				} else {
//					return array('error'=>0,'msg'=>'充值成功！','url'=>$this->get_pay_after_url($now_order['label'],$now_order['is_mobile_pay']));
//				}
//			}else{
//				return array('error'=>1,'msg'=>'修改订单状态失败，请联系系统管理员！');
//			}
//		}
//	}
	/*充值完成之后更新
    * 侯腾
    * 更改
    */
	public function after_pay($order_param){
		if($order_param['pay_type']!='offline'){
			/*if($order_param['return']){
				$where['orderid'] = $order_param['order_id'];
			}else{
				$where['orderid'] = $order_param['orderid'];
			}*/
			$where['orderid'] = $order_param['order_id'];
		}else{
			$where['order_id'] = $order_param['order_id'];
		}
		$now_order = $this->field(true)->where($where)->find();
//		dump($now_order);exit;
		if(empty($now_order)){
			return array('error'=>1,'msg'=>'当前订单不存在');
		}else if($now_order['paid'] == 1){
			if($order_param['order_type'] == 'waimai-recharge'){
				if($order_param['is_mobile_pay']){
					return array('error'=>1,'msg'=>'该订单已付款！','url'=>U('Waimai/User/index'));
				}else{
					return array('error'=>1,'msg'=>'该订单已付款！','url'=>U('Waimai/Asset/balance'));
				}
			}else{
				return array('error'=>1,'msg'=>'该订单已付款！','url'=>$this->get_pay_after_url($now_order['label'],$now_order['is_mobile_pay']));
			}
		}else{
			//得到当前用户信息，不将session作为调用值，因为可能会失效或错误。
			$now_user = D('User')->get_user($now_order['uid']);
			if(empty($now_user)){
				return array('error'=>1,'msg'=>'没有查找到此订单归属的用户，请联系管理员！');
			}
			$data_user_recharge_order = array();
			$data_user_recharge_order['pay_time'] = $_SERVER['REQUEST_TIME'];
			$data_user_recharge_order['payment_money'] = floatval($order_param['pay_money']);
			$data_user_recharge_order['pay_type'] = $order_param['pay_type'];
			$data_user_recharge_order['third_id'] = $order_param['third_id'];
			$data_user_recharge_order['paid'] = 1;
			if($this->where($where)->save($data_user_recharge_order)){
				//D('User')->add_money($now_order['uid'],$order_param['pay_money'],'在线充值');//2016.11.17换成以下添加明细
				$merchant_name=M('merchant')->where(array('mer_id'=>$now_order['mer_id']))->getField('name');
				//dump($merchant_name);exit;

				//通过订单号查询数据信息
				$result = D('user_recharge_order')->where($where)->find();
				$list['uid'] = $result['uid'];
				$list['money'] = $result['money'];
				$list['mer_id'] = $result['mer_id'];
				$arr=M('user_merchant_money')->where(array('mer_id'=>$list['mer_id'],'uid'=>$list['uid']))->find();
				$data['uid']=$now_order['uid'];
				$data['type']=1;
				$data['money']=$now_order['money'];
				$data['app_money']=0;
				$data['merchant_money']=$now_order['money'];
				$data['time']=$_SERVER['REQUEST_TIME'];
				$data['desc']='个人充值';
				$data['name']=$merchant_name;
				$data['mid']=$now_order['mer_id'];
				$data['auth_code']=0;
				$data['order_id']='cz'.time().mt_rand(100, 1000);
				$data['refund']=1;
				$data['now_money']=$arr['money']+$now_order['money'];
				M('user_money_list')->add($data);
				if(!$arr){
					//如果表中没有数据，则添加
					$order = M('user_merchant_money')->data($list)->add();
					$arr['money']=$list['money'];
				}else{
					//如果表中已存在则将money更新
					$arr['money']+=$list['money'];
					//更新money字段
					$smart = M('user_merchant_money')->where(array('mer_id'=>$list['mer_id'],'uid'=>$list['uid']))->setField('money',$arr['money']);
				}
				if($order_param['order_type'] == 'waimai-recharge'){
					return array('error'=>0,'msg'=>'充值成功！','url'=>U('Waimai/User/index'));
				} else {
					return array('error'=>0,'msg'=>'充值成功！','url'=>$this->get_pay_after_url($now_order['label'],$now_order['is_mobile_pay']));
				}
			}else{
				return array('error'=>1,'msg'=>'修改订单状态失败，请联系系统管理员！');
			}
		}
	}

	
	public function get_pay_after_url($label,$is_mobile = false){

		if($label){

			$labelArr = explode('_',$label);

			if($labelArr[0] == 'wap'){

				switch($labelArr[1]){

					case 'village':

						//直接验证订单

						$order_id = $labelArr[2];

						$now_order = D('House_village_pay_order')->field(true)->where(array('order_id'=>$order_id))->find();

						if($now_order['paid']){

							return U('House/pay_order',array('order_id'=>$order_id));

						}

						$use_result = D('User')->user_money($now_order['uid'],$now_order['money'],$now_order['order_name'].' 扣除余额');

						if(empty($use_result['error_code'])){

							$data_order['order_id'] = $order_id;

							$data_order['pay_time'] = $_SERVER['REQUEST_TIME'];

							$data_order['paid'] = 1;

							D('House_village_pay_order')->data($data_order)->save();	

							if($now_order['order_type'] != 'custom'){

								switch($now_order['order_type']){

									case 'property':

										$bind_field = 'property_price';

										break;

									case 'water':

										$bind_field = 'water_price';

										break;

									case 'electric':

										$bind_field = 'electric_price';

										break;

									case 'gas':

										$bind_field = 'gas_price';

										break;

									case 'park':

										$bind_field = 'park_price';

										break;

									default:

										$bind_field = '';

								}

								if(!empty($bind_field)){

									$now_user_info = D('House_village_user_bind')->get_one($now_order['village_id'],$now_order['bind_id'],'pigcms');

									$data_bind['pigcms_id'] = $now_user_info['pigcms_id'];

									$data_bind[$bind_field] = $now_user_info[$bind_field] - $now_order['money'] > 0 ? $now_user_info[$bind_field] - $now_order['money'] : 0;

									D('House_village_user_bind')->data($data_bind)->save();

								}

							}

						}

						return U('House/pay_order',array('order_id'=>$order_id));

				}

			}

		}else{

			if($is_mobile){

				return U('My/index');

			}else{

				return U('User/Credit/index');

			}

		}

	}

	//支付时，金额不够，记录到帐号

	public function wap_after_pay_error($now_order,$order_param,$error_tips){

		//记录充值的金额，因为 Pay/return_url 处没有返回order的具体信息，故在此调用。

		$user_result = D('User')->add_money($now_order['uid'],$order_param['pay_money'],'在线充值');

		if($user_result['error_code']){

			return array('error'=>1,'msg'=>$user_result['msg']);

		}else{

			return array('error'=>1,'msg'=>$error_tips.'已将您充值的金额添加到您的余额内。');

		}

	}

}

?>