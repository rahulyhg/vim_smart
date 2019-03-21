<?php
/*
 * 付款管理
 *
 */
class CompanypayapiAction extends CommonAction{
	public function api(){
		if(empty($this->config['company_pay_open'])){
			echo json_encode(array('err_code'=>1003,'err_msg'=>'网站未开启软件付款功能'));
			exit();
		}
		if($_POST['webKey'] != $this->config['company_pay_encrypt']){
			echo json_encode(array('err_code'=>1001,'err_msg'=>'通信密钥错误，请重新填写'));
			exit();
		}
		if($_POST['action'] == 'saveOrder'){
			if($_POST['status'] == 'ok'){
				$condition_companypay = array(
					'pigcms_id'	 => $_POST['pigcms_id'],
				);
				$data_companypay = array(
					'trade_no' 	 => $_POST['trade_no'],
					'payment_no' => $_POST['payment_no'],
					'status'	 => '1',
					'pay_time'	 => strtotime($_POST['payment_time'])
				);
				if(D('Companypay')->where($condition_companypay)->data($data_companypay)->save()){
					echo json_encode(array('err_code'=>0,'err_msg'=>'订单保存成功'));
				}else{
					echo json_encode(array('err_code'=>1002,'err_msg'=>'订单保存失败，请重试'));
				}
				exit();
			}else if($_POST['status'] == 'del'){
				$condition_companypay = array(
					'pigcms_id'	 => $_POST['pigcms_id'],
				);
				$data_companypay = array(
					'status'	 => '2'
				);
				if(D('Companypay')->where($condition_companypay)->data($data_companypay)->save()){
					echo json_encode(array('err_code'=>0,'err_msg'=>'订单保存成功'));
				}else{
					echo json_encode(array('err_code'=>1002,'err_msg'=>'订单保存失败，请重试'));
				}
				exit();
			}
		}else{
			if(C('config.company_pay_house_oneDayPay')){ 
				$village = D('House_village');
				$village_info = $village->field('village_id,village_name,property_phone,last_bill_time')->select();
				$village_pay = D('House_village_pay_order');
				$companypay  = D('Companypay');
				$add_time = time();
				foreach($village_info as $v){
					$sql_sum_money = "SELECT SUM(money) AS money FROM ".C('DB_PREFIX')."house_village_pay_order WHERE paid=1 AND is_pay_bill=0 AND pay_time>=".$v['last_bill_time']." AND village_id =".$v['village_id'];
					$money = $village_pay->query($sql_sum_money);
					$res= $village_pay->where("paid=1 AND is_pay_bill=0 AND pay_time>".$v['last_bill_time'])->setField('is_pay_bill',1);
					if(!empty($money[0]['money'])){
						$Values.="('house','".$v['village_id']."','".$v['property_phone']."','".($money[0]['money']*100)."','小区".$v['village_name']."订单对账|时间(".date('Y-m-d',$v['last_bill_time'])."~".date('Y-m-d').")|转账 ".$money[0]['money']." 元',0,".$add_time." ),";
					}
					$ids[]=$v['village_id'];
				}
				$sql_add_companypay = "INSERT INTO ".C('DB_PREFIX')."companypay (`pay_type`,`pay_id`,`phone`,`money`,`desc`,`status`,`add_time`) VALUES ".substr($Values,0,-1);
				if(!$companypay->query($sql_add_companypay)){
					if(!empty($ids)){
						$where['village_id']=array('in',implode(',',$ids));
						$village->where($where)->setField('last_bill_time',$add_time);
					}	
				}
				
			}
			
			$condition_companypay['status'] = '0';
			if($_POST['webLastId']){
				$condition_companypay['pigcms_id'] = array('gt',$_POST['webLastId']);
			}
			
			$payList = D('Companypay')->where($condition_companypay)->order('`pigcms_id` ASC')->limit(10)->select();
			$returnList = array();
			foreach($payList as $value){
				$returnList[] = array(
					'pigcms_id'	=>	$value['pigcms_id'],
					'pay_type'	=>	$value['pay_type'],
					'alias_type'=>	$this->getType($value['pay_type']),
					'pay_id'	=>	$value['pay_id'],
					'openid'	=>	$value['openid'],
					'nickname'	=>	$value['nickname'],
					'money'		=>	$value['money'],
					'desc'		=>	$value['desc'],
					'add_time'	=>	date('Y-m-d H:i:s',$value['add_time']),
					'status'	=>	$value['status'],
				);
			}
			echo json_encode(array('err_code'=>0,'result'=>$returnList,'count'=>count($returnList)));
			exit();
		}
	}
	public function getType($pay_type){
		switch($pay_type){
			case 'merchant':
				return '商家';
			case 'user':
				return '用户';
			case 'house':
				return '社区';
		}
	}
}