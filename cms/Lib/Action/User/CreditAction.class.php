<?php
/*
 * 余额
 *
 * @  Writers    Jaty
 * @  BuildTime  2014/12/29 14:06
 * 
 */
class CreditAction extends BaseAction {
    public function index(){
		//导航条
    	$web_index_slider = D('Slider')->get_slider_by_key('web_slider');
    	$this->assign('web_index_slider',$web_index_slider);
    	
		//热门搜索词
    	$search_hot_list = D('Search_hot')->get_list(12);
    	$this->assign('search_hot_list',$search_hot_list);

		//所有分类 包含2级分类
		$all_category_list = D('Group_category')->get_category();
		$this->assign('all_category_list',$all_category_list);
		$this->assign('now_money',$this->now_user['now_money']);
		$this->assign('openid',$this->now_user['openid']);
		//余额记录列表
		$this->assign(D('User_money_list')->get_list($this->now_user['uid']));
		
		$this->display();
    }
	public function recharge(){
		$data_user_recharge_order['uid'] = $this->now_user['uid'];
		$money = floatval($_GET['money']);
		if(empty($money) || $money > 10000){
			$this->error('请输入有效的金额！最高不能超过1万元。');
		}
		$data_user_recharge_order['money'] = $money;
		// $data_user_recharge_order['order_name'] = '帐户余额在线充值';
		$data_user_recharge_order['add_time'] = $_SERVER['REQUEST_TIME'];
		if($order_id = D('User_recharge_order')->data($data_user_recharge_order)->add()){
			redirect(U('Index/Pay/check',array('order_id'=>$order_id,'type'=>'recharge')));
		}else{
			$this->error('订单处理失败！请重试。');
		}
	}
	
	public function withdraw(){
		if($this->config['company_pay_open']=='0') {
			$this->error_tips('平台没有开启体现功能！');
		}
		$user_info=$this->now_user;
		if(IS_POST){
			if(empty($user_info['openid'])||$user_info['now_money']==0){
				$this->ajaxReturn(array('error_code'=>true,'msg'=>'您没有绑定微信或者没有余额！'));
				exit();
			}else{
				$this->ajaxReturn(array('error_code'=>false));
				exit();
			}
		}else {
			$money = floatval((int)($_GET['money']*100)/100);
			$data_companypay['pay_type'] = 'user';
			$data_companypay['pay_id'] = $user_info['uid'];
			$data_companypay['openid'] = $user_info['openid'];
			$data_companypay['nickname'] = $_GET['n'];
			$data_companypay['phone'] = $user_info['phone'];
			$data_companypay['money'] = $money*100;
			$data_companypay['desc'] = "用户提现对账订单|用户ID ".$user_info['uid']." |转账 ".$money." 元" ;
			$data_companypay['status'] = 0;
			$data_companypay['add_time'] = time();
			
			$user_result = D('User')->user_money($user_info['uid'],$money,'提款 '.$money.' 扣除余额');
			if($user_result['error_code']){
				$this->error('订单处理失败！请重试！');
				exit();
			}else{
				D('Companypay')->add($data_companypay);
				$this->success("订单申请成功，请等待审核！");
				exit();
			}
		}
	}
}