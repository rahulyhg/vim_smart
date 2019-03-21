<?php
class OwnpayAction extends BaseAction{
	public function index(){
		$ownpay = D('Merchant_ownpay')->field(true)->where(array('mer_id' => $this->merchant_session['mer_id']))->find();
		if(empty($ownpay)){
			D('Merchant_ownpay')->data(array('mer_id' => $this->merchant_session['mer_id']))->add();
		}else{
			foreach($ownpay as $key=>$value){
				if($key != 'mer_id'){
					$ownpay[$key] = unserialize($value);
				}
			}
			$this->assign('ownpay',$ownpay);
		}
		//平台有没有开启商家绑定支付、该商家有没有配置支付
		//微信支付包含 平台有没有开启商家公众号绑定、该商家有没有配置绑定。
		$weixin_bind = D('Weixin_bind')->field(true)->where(array('mer_id' => $this->merchant_session['mer_id']))->find();
		if($weixin_bind){
			$this->assign('hasBind',true);
		}
		$this->display();
	}
	public function save(){
		$data_ownpay = array();
		foreach($_POST as $key=>$value){
			$data_ownpay[$key] = serialize($value);
			if(!empty($value['open'])){
				foreach($value as $vv){
					if(empty($vv)){
						$this->error('您开启了'.$this->getPayName($key).'，请完善'.$this->getPayName($key).'需要的信息');
					}
				}
			}
		}
		$where_ownpay = array('mer_id' => $this->merchant_session['mer_id']);
		if(D('Merchant_ownpay')->where($where_ownpay)->data($data_ownpay)->save()){
			$this->success('保存成功');
		}else{
			$this->error('保存失败，请重试');
		}
	}
	protected function getPayName($label){
		$payName = array(
			'weixin' => '微信支付',
			'tenpay' => '财付通支付',
			'yeepay' => '银行卡支付(易宝支付)',
			'allinpay' => '银行卡支付(通联支付)',
			'chinabank' => '银行卡支付(网银在线)',
		);
		return $payName[$label];
	}
}


?>