<?php
class RechargeAction extends BaseAction{
	public function _initialize() {
		parent::_initialize();
		
	}
	
	/* 商户后台充值
	* @time 2016-04-13
	* @author	小邓  <969101097@qq.com>*/
	public function index(){
		if(IS_POST){
			//print_r($_POST);
			//echo '<br/>';
			$account=isset($_POST['account']) ? $_POST['account'] : NULL;	//支付类型
			$pay_money=isset($_POST['money']) ? $_POST['money'] : NULL;	//支付金额
			$pay_method=D('Config')->get_pay_method();
			//print_r($pay_method[$account]);
			$pay_config=$pay_method[$account]['config'];	//支付类对应的配置参数
			$pay_class_name=ucwords($account);
			import('@.ORG.pay.'.$pay_class_name);	//引入支付类（微信或支付宝）
			//$pay_class=new $pay_class_name('',$pay_money,$account,$pay_config);
			$pay_class=new $pay_class_name('','1',$account,$pay_config);
			$out_trade_no='C'.time().substr(str_shuffle('1234567890'),0,8);	//订单号
			if($account=='weixin'){		//判断是否是微信支付
				$recharge_arr=$pay_class->recharge_pay($out_trade_no);
				//echo $recharge_arr['qrcode'];exit;
				$this->assign('code_url',$recharge_arr['qrcode']);
				$config_arr=array();
				$config_arr['code']=$out_trade_no;
				$config_arr['money']=$pay_money;
				$this->assign('config_arr',$config_arr);	//订单信息
				$this->display('wxqrcode');
			}else{
				echo $pay_class->recharge_pay($out_trade_no);
			}
		}else{
			$now_merchant=D('Merchant')->field('money')->where(array('mer_id'=>$this->merchant_session['mer_id']))->find();
			$this->assign('money',$now_merchant['money']);	//订单信息
			$this->display();	
		}		
	}
	
	/* 商户后台充值处理(微信扫码支付)
	* @time 2016-04-13
	* @author	小邓  <969101097@qq.com>*/
	public function weixinAdd(){
		import('@.ORG.pay.Weixinnewpay.WxPay');	//引入微信核心文件
		$orderQuery=new OrderQuery_pub();
		//print_r($orderQuery->getResult());
		if (!isset($_POST["out_trade_no"])){
			$out_trade_no = " ";
		}else{
			$out_trade_no = $_POST["out_trade_no"];
			//使用订单查询接口
			$orderQuery = new OrderQuery_pub();
			//设置必填参数
			//appid已填,商户无需重复填写
			//mch_id已填,商户无需重复填写
			//noncestr已填,商户无需重复填写
			//sign已填,商户无需重复填写
			$orderQuery->setParameter("out_trade_no","$out_trade_no");//商户订单号 
			//获取订单查询结果
			$orderQueryResult = $orderQuery->getResult();
			//商户根据实际情况设置相应的处理流程,此处仅作举例
			$result=array();
			if ($orderQueryResult["return_code"] == "FAIL") {
			 //echo "通信出错：".$orderQueryResult['return_msg']."<br>";
				$result['code']=-1;
				$result['msg']="通信出错：".$orderQueryResult['return_msg'];
				echo json_encode($result);
				exit;
			}else if($orderQueryResult["result_code"] == "FAIL"){
				//echo "错误代码：".$orderQueryResult['err_code']."<br>";
				//echo "错误代码描述：".$orderQueryResult['err_code_des']."<br>";
				$result['code']=-2;
				$result['msg']="错误代码描述：".$orderQueryResult['err_code_des'];
				echo json_encode($result);
				exit;		
			}else{
				if($orderQueryResult['trade_state']=='NOTPAY'){	//订单未支付
					$result['code']=-3;
					$result['msg']=$orderQueryResult['trade_state_desc'];
					echo json_encode($result);
					exit;						
				}else{
					//$total_fee_t = $orderQueryResult['total_fee']/100;	
					$total_fee_t=$_POST['money'];
					$out_trade_no=$orderQueryResult['out_trade_no']; 	
					$mer_id = $this->merchant_session['mer_id'];	//商户ID
					$merchant_alter= D('Merchant')->where(array('mer_id'=>$mer_id))->setInc('money',$total_fee_t);	//增加用户金额
					//$merchant_alter= D('Merchant')->where(array('mer_id'=>$mer_id))->find();					
					if($merchant_alter){
						$result['code']=4;	//充值成功
						$result['msg']="充值成功！";
						echo json_encode($result);
						exit;		
					}else{
						$result['code']=-4;	//充值失败
						$result['msg']="充值失败！".$total_fee_t;
						echo json_encode($result);
						exit;						
					}												
				}
			}			
		}
	}
	
	/* 商户后台充值处理(支付宝扫码支付)
	* @time 2016-04-13
	* @author	小邓  <969101097@qq.com>*/
	public function alipayReturn(){
		//echo '支付宝扫码同步处理';exit;
		import("@.ORG.pay.Alipay.alipay_notify");
		$pay_method=D('Config')->get_pay_method();
		$pay_config=$pay_method['alipay']['config'];	//支付类对应的配置参数
		$alipay_config['partner']		= $pay_config['pay_alipay_pid'];
		$alipay_config['seller_email']	= $pay_config['pay_alipay_name'];
		$alipay_config['key']			= $pay_config['pay_alipay_key'];
		$alipay_config['sign_type']    = 'MD5';
		$alipay_config['input_charset']= 'utf-8';
		$alipay_config['transport']    = 'http';
		$alipayNotify = new AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verifyNotify();					
		$out_trade_no = $_GET['out_trade_no'];	//商户订单号		
		//$trade_no = $_GET['trade_no'];	//支付宝交易号		
		$trade_status = $_GET['trade_status'];	//交易状态		
		$total_fee_t = $_GET['total_fee'];	//金额		
		if($_GET['trade_status'] == 'TRADE_SUCCESS'){	//判断是否交易成功			
			$mer_id = $this->merchant_session['mer_id'];	//商户ID
			$merchant_alter= D('Merchant')->where(array('mer_id'=>$mer_id))->setInc('money',$total_fee_t);	//增加用户金额				
			if($merchant_alter){
				$this->success('充值成功！',U('Recharge/index'));	//充值成功
			}else{
				$this->error('充值失败！');	//充值失败
			}												
		}else {
			$this->error('交易失败！');	//充值失败
		}
		
	}
	
}

?>