<?php
bpBase::loadAppClass('common', 'User', 0);
class cashier_controller extends common_controller{
	public $wx_user;
	public $tablepre;
	public $rr;
	public $ali_user;
	public $thirduserid;
	public function __construct(){
		parent::__construct();
		$this->authorityControl(array('getajaxOrder', 'getEwm', 'add_order', 'qrcode', 'weixinPay', 'sm_order', 'getSgin', 'pay'));
		session_start();
		$session_mid=$_SESSION['merchant']['mid'];
		//$this->wx_user = M('cashier_payconfig')->getwxuserConf($mid=$this->mid);
		$this->wx_user = $this->getwxuserConf($mid=$this->mid,$type="wx");
		//$this->ali_user = $this->getaliuserConf($mid=$this->mid,$type="ali");
		$db_config = loadConfig('db');
		$this->tablepre = $db_config['default']['tablepre'];
		unset($db_config);
		$info=M('cashier_merchants')->get_one(array('mid'=>$this->mid),'thirduserid');
		$this->thirduserid=$info['thirduserid'];//第三方唯一凭证（商户id）
	}

		public function index(){
			//dump($_SESSION['merchant']['mid']);
			//dump($_SESSION);exit;
		//dump($this->thirduserid);exit;
		$SiteUrl = $this->SiteUrl;
		$sqlStr = 'SELECT DISTINCT ordr.id,ordr.*,cf.nickname FROM ' . $this->tablepre . 'cashier_order as ordr LEFT JOIN ' . $this->tablepre . 'cashier_fans AS cf ON ordr.openid=cf.openid where ordr.mid=' . $this->mid . ' AND cf.mid=' . $this->mid . ' AND ordr.ispay="1" ORDER BY ordr.paytime DESC,ordr.id DESC LIMIT 0,20';
		$sqlObj = new model();
		$neworder = $sqlObj->selectBySql($sqlStr);
		include $this->showTpl();
	}

	public function odetail(){
		$orid = intval(trim($_GET['orid']));
		$orid = (0 < $orid ? $orid : 0);
		//$orderInfo = M('cashier_order')->getOneOrder(array('id' => $orid, 'mid' => $this->mid));//2016.12.8改动，原来支付详情中支付人为空，因为此处获得的truename为空，可以从fans表获取nickname
		$sqlStr = 'SELECT DISTINCT ordr.id,ordr.*,cf.nickname FROM ' . $this->tablepre . 'cashier_order as ordr LEFT JOIN ' . $this->tablepre . 'cashier_fans AS cf ON ordr.openid=cf.openid where ordr.mid=' . $this->mid . ' AND cf.mid=' . $this->mid . ' AND ordr.id='.$orid;
		$sqlObj = new model();
		$result = $sqlObj->selectBySql($sqlStr);
		$orderInfo=$result[0];
		//dump($orderInfo);exit;
		if (!empty($orderInfo['refundtext'])) {
			$orderInfo['refundtext'] = unserialize($orderInfo['refundtext']);
		}

		ob_start();
		ob_implicit_flush(0);
		include $this->showTpl();
		$content = ob_get_clean();
		echo $content;
	}

	public function getajaxOrder(){
		$cf = trim($_GET['cf']);
		switch ($cf) {
		case 'index':
			$sqlStr = 'SELECT DISTINCT ordr.id,ordr.*,cf.nickname FROM ' . $this->tablepre . 'cashier_order as ordr LEFT JOIN ' . $this->tablepre . 'cashier_fans AS cf ON ordr.openid=cf.openid where ordr.mid=' . $this->mid . '  AND cf.mid=' . $this->mid . '  AND cf.mid=' . $this->mid . '  AND ordr.ispay="1" ORDER BY ordr.paytime DESC,ordr.id DESC LIMIT 0,20';
			$sqlObj = new model();
			$neworder = $sqlObj->selectBySql($sqlStr);
			if (!empty($neworder)) {
				$tmpdata = array();

				foreach ($neworder as $okk => $ovv) {
					$tmpdata[$okk]['id'] = $ovv['id'];
					$tmpdata[$okk]['mid'] = $ovv['mid'];

					if (!empty($ovv['nickname'])) {
						$tmpdata[$okk]['truename'] = $ovv['nickname'];
					}else if (!empty($ovv['truename'])) {
						$tmpdata[$okk]['truename'] = htmlspecialchars_decode($ovv['truename'], ENT_QUOTES);
					}else if (!empty($ovv['openid'])) {
						$tmpdata[$okk]['truename'] = $ovv['openid'];
					}else {
						$tmpdata[$okk]['truename'] = '未知客户';
					}

					$paytime = (0 < $ovv['paytime'] ? $ovv['paytime'] : $ovv['add_time']);
					$tmpdata[$okk]['paytimestr'] = date('Y-m-d H:i:s', $paytime);
					$tmpdata[$okk]['goods_name'] = htmlspecialchars_decode($ovv['goods_name'], ENT_QUOTES);
					$tmpdata[$okk]['goods_price'] = $ovv['goods_price'];

					if ($ovv['refund'] == 1) {
						$tmpdata[$okk]['refundstr'] = '退款中...';
					}else if ($ovv['refund'] == 2) {
						$tmpdata[$okk]['refundstr'] = '已退款';
					}else if ($ovv['refund'] == 3) {
						$tmpdata[$okk]['refundstr'] = '退款失败';
					}else {
						$tmpdata[$okk]['refundstr'] = '已支付';
					}

					$tmpdata[$okk]['refund'] = $ovv['refund'];
					$tmpdata[$okk]['comefrom'] = $ovv['comefrom'];
				}

				$this->dexit(array('error' => 0, 'datas' => $tmpdata));
			}else {
				$this->dexit(array('error' => 1));
			}

			break;

		default:
			break;
		}

		$this->dexit(array('error' => 1));
	}

	public function payRecord(){
		bpBase::loadOrg('common_page');
		$orderDb = M('cashier_order');
		$where = array('ispay' => 1, 'mid' => $this->mid);
		$_count = $orderDb->count($where);
		$p = new Page($_count, 20);
		$pagebar = $p->show(2);
		$sqlStr = 'SELECT DISTINCT ordr.id,ordr.*,cf.nickname FROM ' . $this->tablepre . 'cashier_order as ordr LEFT JOIN ' . $this->tablepre . 'cashier_fans AS cf ON ordr.openid=cf.openid where ordr.mid=' . $this->mid . '  AND cf.mid=' . $this->mid . ' AND ordr.ispay="1" ORDER BY ordr.paytime DESC,ordr.id DESC LIMIT ' . $p->firstRow . ',' . $p->listRows;
		$sqlObj = new model();
		$neworder = $sqlObj->selectBySql($sqlStr);
		include $this->showTpl();
	}

	public function ewmRecord(){
		bpBase::loadOrg('common_page');
		$orderDb = M('cashier_order');
		$where = array('mid' => $this->mid);
		$_count = $orderDb->count($where);
		$p = new Page($_count, 15);
		$pagebar = $p->show(2);
		$neworder = $orderDb->getOrders($p->firstRow . ',' . $p->listRows, 'id DESC', $where);
		bpBase::loadAppClass('wxSaoMaPay', 'User', 0);
		$wxSaoMaPay = new wxSaoMaPay();

		foreach ($neworder as $kk => $vv) {
			if ($vv['ispay'] == 1) {
				$neworder[$kk]['ewmurl'] = $this->SiteUrl . '/merchants.php?m=Index&c=pay&a=autopay&mid=' . $vv['mid'] . '&oid=' . $vv['id'];
			}else {
				$product_id = $vv['mid'] . '_' . $vv['id'];
				$neworder[$kk]['ewmurl'] = $wxSaoMaPay->GetPrePayUrl($product_id);
			}
		}

		include $this->showTpl();
	}

	public function delOrderByid(){
		$ordid = intval($_POST['ordid']);
		$mid = intval($_POST['mid']);
		$return = $this->_del(M('cashier_order'), $ordid, 'mid=' . $this->mid);
		$this->dexit($return);
	}

	public function wxRefund(){
		$ordid = intval($_POST['ordid']);
		$mid = intval($_POST['mid']);
		$orderDb = M('cashier_order');
		$ordertmp = $orderDb->get_one(array('id' => $ordid), '*');
		if(substr($ordertmp['order_id'],0,6)=='barpay'){
			bpBase::loadOrg('Alipay1/f2fpay/model/builder/AlipayTradeRefundContentBuilder');
			//$appAuthToken = "201611BBc9392e440a7a4f3f9d88b9b0ea56bA29";//根据真实值填写
			$appAuthToken=$this->wx_user['token'];
			$barPayRequestBuilder = new AlipayTradeRefundContentBuilder();
			$barPayRequestBuilder->setOutTradeNo($ordertmp['order_id']);
			$barPayRequestBuilder->setRefundAmount($ordertmp['goods_price']);
			$barPayRequestBuilder->setAppAuthToken($appAuthToken);//退款需要
			bpBase::loadOrg('Alipay1/f2fpay/service/AlipayTradeService');
			//查询当前的支付宝配置
			$appid = M('config')->get_one(array('name'=>'alipay_appid'),'value');
			$private_key = M('config')->get_one(array('name'=>'alipay_private_key'),'value');
			$public_key = M('config')->get_one(array('name'=>'alipay_public_key'),'value');
			$config = array(
				'alipay_appid'=>$appid['value'],
				'alipay_private_key'=>$private_key['value'],
				'alipay_public_key'=>$public_key['value']
			);
			$barPay = new AlipayTradeService($config);
			$barPayResult = $barPay->refund($barPayRequestBuilder);
			switch ($barPayResult->getTradeStatus()) {
				case "SUCCESS":
					$result=$barPayResult->getResponse();
					$updatedata = array('refund' => 2, 'refundtext' => serialize($result));
					$orderDb->update($updatedata, array('id' => $ordertmp['id']));
					$this->dexit(array('error' => 0, 'msg' => '退款成功！'));
					//$this->dexit(array('error' => 0, 'msg' => serialize($result)));
					break;
				case "FAILED":
					//$this->dexit(array('error' => 1, 'msg' => '错误码：' . $barPayResult->getResponse() . '<br/>错误描述：' . $barPayResult->getResponse()));
					echo "支付宝支付失败!!!" . "<br>--------------------------<br>";
					if (!empty($barPayResult->getResponse())) {
						print_r($barPayResult->getResponse());
					}
					break;
				case "UNKNOWN":
					//echo "系统异常，订单状态未知!!!" . "<br>--------------------------<br>";
					$this->dexit(array('error' => 1, 'msg' => '错误码：' . $barPayResult->getResponse() . '<br/>错误描述：' . $barPayResult->getResponse()));
//					if (!empty($barPayResult->getResponse())) {
//						print_r($barPayResult->getResponse());
//					}
					break;
				default:
					echo "不支持的交易状态，交易返回异常!!!";
					break;
			}
			return;
		}elseif ($ordertmp['pay_type']=='appPay'){
			$thirduserid=M('cashier_merchants')->get_one(array('mid'=>$this->mid),'thirduserid');//获取当前收银台mid对应O2O商户ID
			$auth_code=$ordertmp['auth_code'];//获取当前订单的支付二维码
			$uid=substr($auth_code,14,4);//当前使用余额付的用户uid
			$openid=M('user')->get_one(array('uid'=>$uid),'openid');
			$app_money=$ordertmp['app_money'];//来自平台余额
			$merchant_money=$ordertmp['merchant_money'];//来自对应商户余额
			if($app_money!=0){
				$app_before_money=M('user')->get_one(array('uid'=>$uid),'now_money');//平台原来余额
				$now_money=(float)$app_before_money['now_money']+(float)$app_money;//退款后余额
				M('user')->update(array('now_money'=>$now_money),array('uid'=>$uid));
				M('cashier_order')->update(array('refund'=>2),array('id'=>$ordertmp['id']));
			}
			if($merchant_money!=0){
				$merchant_before_money=M('user_merchant_money')->get_one(array('uid'=>$uid,'mer_id'=>$thirduserid['thirduserid']),'money');//对应商户原来余额
				$this_money=(float)$merchant_before_money['money']+(float)$merchant_money;//退款后余额
				M('user_merchant_money')->update(array('money'=>$this_money),array('uid'=>$uid,'mer_id'=>$thirduserid['thirduserid']));
				M('cashier_order')->update(array('refund'=>2),array('id'=>$ordertmp['id']));
			}
			//退款到账通知
			$time = time();
			$href = 'http://'.$_SERVER['HTTP_HOST'].'/wap.php?c=Pay&a=pay_accomplish&money='.$ordertmp['goods_price'].'&name='.$ordertmp['goods_name'].'&outid='.$ordertmp['order_id'].'&time='.$time;
			$template=array(
				'touser'=>$openid['openid'],
				'template_id'=>"6i_aCP9aDxsBgKLrnYNqwnFzMOigv1PvAJedMDWzVUE",
				'url'=>$href,
				'data'=>array(
					'first'=>array(
						'value'=>urlencode("退款到账通知"),
						'color'=>"#029700",
					),
					'keyword1'=>array(
						'value'=>urlencode($ordertmp['goods_name']),
						'color'=>"#000000",
					),
					'keyword2'=>array(
						'value'=>urlencode($ordertmp['order_id']),
						'color'=>"#000000",
					),
					'keyword3'=>array(
						'value'=>urlencode($ordertmp['goods_price'].'元'),
						'color'=>"#000000",
					),
					'keyword4'=>array(
						'value'=>urlencode($ordertmp['pay_type']),
						'color'=>"#000000",
					),
					'keyword5'=>array(
						'value'=>urlencode(date('Y-m-d H:i:s',$time)),
						'color'=>"#000000",
					),
				)
			);
			$this->send_template_message(urldecode(json_encode($template)));
			$score['uid']=$uid;
			$score['type']=2;//积分减少
			$score['score']=floor($ordertmp['goods_price']);
			$score['time']=$_SERVER['REQUEST_TIME'];
			$score['ip']=9;
			$score['desc']='退款'.$ordertmp['goods_price'].'元';
			M('user_money_list')->update(array('type'=>3,'refund'=>2),array('auth_code'=>$auth_code));
			M('user_score_list')->insert($score,true);
			$this->dexit(array('error' => 0, 'msg' => 'OK'));
		}else{
			bpBase::loadAppClass('wxSaoMaPay', 'User', 0);
			$wxSaoMaPay = new wxSaoMaPay();
			$ret = $wxSaoMaPay->wxRefund($ordid, $this->wx_user, $mid);
			$this->dexit($ret);
		}

	}

	public function send_template_message($data){
		bpBase::loadOrg('wxCardPack');
		$wxCardPack = new wxCardPack($this->wx_user, $this->mid);
		$access_token = $wxCardPack->getToken();
		$url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$access_token;
		$res=$this->https_request($url,$data);
		return $res;
	}

	protected function https_request($url, $data = null,$noprocess=false) {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
		curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; WOW64; rv:39.0) Gecko/20100101 Firefox/39.0");
		$header = array("Accept-Charset: utf-8");
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		//curl_setopt($curl, CURLOPT_SSLVERSION, 3);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header); /* * *$header 必须是一个数组** */
		curl_setopt($curl, CURLOPT_HEADER, FALSE);
		curl_setopt($curl, CURLINFO_HEADER_OUT, true);
		if (!empty($data)) {
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		}
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($curl);
		if($noprocess) return $output;
		$errorno = curl_errno($curl);
		if ($errorno) {
			return array('curl' => false, 'errorno' => $errorno);
		} else {
			$res = json_decode($output, 1);
			if ($res['errcode']) {
				return array('errcode' => $res['errcode'], 'errmsg' => $res['errmsg']);
			} else {
				return $res;
			}
		}
		curl_close($curl);
	}

	public function getEwm(){
		$datas = $this->clear_html($_POST);
		$paytype = (isset($datas['paytype']) ? $datas['paytype'] : '');

		switch ($paytype) {
		case 'wxpay':
			$orderinfo = $this->add_order($datas);

			if ($orderinfo) {
				bpBase::loadAppClass('wxSaoMaPay', 'User', 0);
				$wxSaoMaPay = new wxSaoMaPay();
				$product_id = $orderinfo['mid'] . '_' . $orderinfo['orderid'];
				$ewmurl2 = $wxSaoMaPay->GetPrePayUrl($product_id);
				$erweimainfo = array('price' => $orderinfo['goods_price'], 'title' => $orderinfo['goods_name'], 'mid' => $orderinfo['mid']);
				$this->dexit(array('error' => 0, 'qrcode' => $ewmurl2, 'ewminfo' => base64_encode(json_encode($erweimainfo))));
			}else {
				$this->dexit(array('error' => 0, 'msg' => '二维码生成失败'));
			}

			break;

		case 'alipay':
			break;

		default:
			break;
		}
	}

	public function add_order($datas){
		$data['mid'] = $this->mid;
		isset($this->wx_user['p_mid']) && $data['pmid'] = $this->wx_user['p_mid'];
		$data['goods_id'] = 1;
		$data['pay_way'] = 'weixin';
		$data['pay_type'] = 'wxsaoma2pay';
		$data['order_id'] = time() . mt_rand(11111111, 99999999) . date('YmdHis');
		$data['goods_type'] = 'unlimit';
		$data['goods_name'] = $datas['tname'];
		$data['goods_describe'] = '收银台生成二维码扫码支付';
		$data['goods_price'] = $datas['tprice'];
		$data['add_time'] = time();
		$orderid = M('cashier_order')->insert($data, true);
		if($orderid){
			$data['orderid'] = $orderid;
			return $data;
		}

		return false;
	}

	public function web_sm1pay($datas){
		bpBase::loadOrg('WxSaoMaPay/WxPayPubHelper');
		$jsApi = new JsApi_pub($this->wx_user['appid'], $this->wx_user['mchid'], $this->wx_user['key'], $this->wx_user['appsecret']);
		$unifiedOrder = new UnifiedOrder_pub($this->wx_user['appid'], $this->wx_user['mchid'], $this->wx_user['key'], $this->wx_user['appsecret']);
		$unifiedOrder->setParameter('body', $datas['tname']);
		$unifiedOrder->setParameter('out_trade_no', 'wxpay_' . time());
		$unifiedOrder->setParameter('total_fee', floatval($datas['tprice'] * 100));
		$unifiedOrder->setParameter('notify_url', SITEURL . '/pay/wxpay/wxasyn_notice.php');
		$unifiedOrder->setParameter('trade_type', 'NATIVE');
		$unifiedOrder->setParameter('attach', 'weixin');
		$prepay_result = $unifiedOrder->getPrepayId();
		if($prepay_result['return_code'] == 'FAIL'){
			$this->dexit(array('error' => 1, 'msg' => "没有获取微信支付的预支付ID，请重新发起支付！\n 微信支付错误返回：" . $prepay_result['return_msg']));
		}

		if($prepay_result['err_code']){
			$this->dexit(array('error' => 1, 'msg' => "没有获取微信支付的预支付ID，请重新发起支付！\n 微信支付错误返回：" . $prepay_result['err_code_des']));
		}

		$jsApi->setPrepayId($prepay_result['prepay_id']);
		$this->dexit(array('error' => 0, 'qrcode' => $prepay_result['code_url']));
	}

	public function qrcode(){
		bpBase::loadOrg('phpqrcode');
		$type = trim($_GET['typ']);
		$isdwd = (isset($_GET['dwd']) ? intval(trim($_GET['dwd'])) : 0);
		$url = urldecode($this->SiteUrl . '/merchants.php?m=Index&c=pay&a=autopay&mid=' . $this->mid);

		if (0 < $isdwd) {
			new QRimage(400, 400);
			$fname = 'Your-autopay-code-image-' . $this->mid . '.png';
			header('Pragma: public');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Content-Type:application/force-download');
			header('Content-type: image/png');
			header('Content-Type:application/download');
			header('Content-Disposition: attachment; filename=' . $fname);
			header('Content-Transfer-Encoding: binary');
			QRcode::png($url, false, 'H', 10, 4);
		}else {
			Header('Content-type: image/jpeg');
			QRcode::png($url);
		}
	}

	public function payment(){
		bpBase::loadOrg('wxCardPack');
		$wxCardPack = new wxCardPack($this->wx_user, $this->mid);
		$access_token = $wxCardPack->getToken();
		$signdata = $wxCardPack->getSgin($access_token);
		$type = (isset($_GET['type']) ? intval($_GET['type']) : 1);
		$type = ($type == 2 ? $type : 1);
		$SiteUrl = $this->SiteUrl;
		$sqlStr = 'SELECT DISTINCT ordr.id,ordr.*,cf.nickname FROM ' . $this->tablepre . 'cashier_order as ordr LEFT JOIN ' . $this->tablepre . 'cashier_fans AS cf ON ordr.openid=cf.openid where ordr.mid=' . $this->mid . ' AND cf.mid=' . $this->mid . ' AND ordr.ispay="1" ORDER BY ordr.paytime DESC,ordr.id DESC LIMIT 0,5';
		$sqlObj = new model();
		$neworder = $sqlObj->selectBySql($sqlStr);
		$lastResult= $neworder[0];
		include $this->showTpl();
	}

	public function wxSmRefund(){
		$orderid = $this->clear_html($_POST['auth_code']);
		bpBase::loadAppClass('wxSaoMaPay', 'User', 0);
		$wxSaoMaPay = new wxSaoMaPay();
		$ret = $wxSaoMaPay->wxRefund($orderid, $this->wx_user, $this->mid, 'micropay');
		$this->dexit($ret);
	}

	public function sm_order($datas){
		$data['mid'] = $this->mid;
		isset($this->wx_user['p_mid']) && $data['pmid'] = $this->wx_user['p_mid'];
		$data['goods_id'] = 1;
		$data['pay_way'] = 'weixin';
		$data['pay_type'] = 'micropay';
		$data['order_id'] = time() . mt_rand(11111111, 99999999) . date('YmdHis');
		$data['goods_type'] = 'ordinary';
		$data['goods_name'] = htmlspecialchars($datas['goods_name'], ENT_QUOTES);
		$data['goods_describe'] = '前端刷卡支付';
		$data['goods_price'] = trim($datas['goods_price']);
		$data['add_time'] = time();
		$insertid = M('cashier_order')->insert($data, true);
		if(0 < $insertid){
			$str_arr=array();
			$str_arr['name']='收银台刷卡支付';	//在线支付类型名称
			$str_arr['price']=$data['goods_price'];
			$str_arr['num']='1';
			$str_info=serialize(array($str_arr));
			$merchant_info=M('cashier_merchants')->get_one(array('mid'=>$data['mid']),'thirduserid');			
			$meal_data=array(
				'uid'=>$GLOBALS['_SESSION']['user']['uid'],
				'mer_id'=>$merchant_info['thirduserid'],	//商户ID
				'store_id'=>M('merchant_store')->get_one(array('mer_id'=>$merchant_info['thirduserid']),'store_id','last_time desc')['store_id'],//店铺ID
				'orderid'=>$data['order_id'],	//订单号
				'status'=>'1',
				'paid'=>'0',	//未付款
				'pay_type'=>'micropay',
				'name'=>$GLOBALS['_SESSION']['user']['nickname'],
				'phone'=>$GLOBALS['_SESSION']['user']['phone'],
				'address'=>$GLOBALS['_SESSION']['user']['province'].' '.$GLOBALS['_SESSION']['user']['city'],
				'num'=>'1',
				'total'=>'1',
				'dateline'=>time(),
				'price'=>$data['goods_price'],
				'submit_order_time'=>time(),	//订单生成时间
				'pay_money'=>$data['goods_price'],
				'payment_money'=>$data['goods_price'], //在线支付金额
				'total_price'=>$data['goods_price'],
				'info'=>$str_info
			);
			M('meal_order')->insert($meal_data,true);	//生成快店订单记录
			$data['id'] = $insertid;
			return array_merge($datas, $data);
		}

		$this->dexit(array('error' => 1, 'msg' => '订单生成失败'));
	}

	public function pay(){
		if (IS_POST) {
			$data = $this->clear_html($_POST);
			empty($data['goods_price']) && $this->dexit(array('error' => 1, 'msg' => '支付金额必须填写！'));
			empty($data['auth_code']) && $this->dexit(array('error' => 1, 'msg' => '支付auth_code为空'));
			$this->weixinPay($data);
			$this->dexit(array('error' => 0, 'msg' => '支付成功！'));
		}
	}

	/*
 * 调用支付宝接口
 * 陈琦
 * 2016.10.8
 */
	public function aliPay($data){
		if(IS_POST){
			$data = $this->ali_order($data);
			//$outTradeNo = "barpay" . date('Ymdhis') . mt_rand(100, 1000);
			//$subject = "支付宝条码付";
			//$totalAmount = trim($data['goods_price']);    // (必填) 订单总金额，单位为元，不能超过1亿元
			//$authCode = $data['auth_code']; //28开头18位数字(必填) 付款条码，用户支付宝钱包手机app点击“付款”产生的付款条码
			$timeExpress = "5m";// 支付超时，线下扫码交易定义为5分钟
			//$appAuthToken = "201611BBc9392e440a7a4f3f9d88b9b0ea56bA29";//根据真实值填写
			$appAuthToken = $this->wx_user['token'];//根据真实值填写
			$sellId=$this->wx_user['pid'];
// 创建请求builder，设置请求参数
			bpBase::loadOrg('Alipay1/f2fpay/model/builder/AlipayTradePayContentBuilder');
			$barPayRequestBuilder = new AlipayTradePayContentBuilder();
			$barPayRequestBuilder->setOutTradeNo($data['order_id']);
			$barPayRequestBuilder->setTotalAmount($data['goods_price']);
			$barPayRequestBuilder->setAuthCode($data['auth_code']);
			$barPayRequestBuilder->setTimeExpress($timeExpress);
			$barPayRequestBuilder->setSubject($data['goods_name']);
			//$barPayRequestBuilder->setSellerId('2088521153863295');
			$barPayRequestBuilder->setSellerId($sellId);
			$barPayRequestBuilder->setAppAuthToken($appAuthToken);
			// 调用barPay方法获取当面付应答
			// 通过查询，得到动态的服务商配置信息
			$appid = M('config')->get_one(array('name'=>'alipay_appid'),'value');
			$private_key = M('config')->get_one(array('name'=>'alipay_private_key'),'value');
			$public_key = M('config')->get_one(array('name'=>'alipay_public_key'),'value');
			$config = array(
				'alipay_appid'=>$appid['value'],
				'alipay_private_key'=>$private_key['value'],
				'alipay_public_key'=>$public_key['value']
			);
			bpBase::loadOrg('Alipay1/f2fpay/service/AlipayTradeService');
			$barPay = new AlipayTradeService($config);
			$barPayResult = $barPay->barPay($barPayRequestBuilder);
//			$myfile = fopen("ss.log", "a+") or die("Unable to open file!");
//			fwrite($myfile, $outTradeNo);
			switch ($barPayResult->getTradeStatus()) {
				case "SUCCESS":
					//print_r($barPayResult->getResponse());
					$orderDb = M('cashier_order');
					$result=$barPayResult->getResponse();
					$account=$result->buyer_logon_id;//支付宝账号
					$user_id=$result->buyer_user_id;//支付宝用户唯一标识
					$transaction_id=$result->trade_no;//第三方交易单号
					$order_id = $result->out_trade_no;
					$wherearr = array('order_id' => $order_id, 'pay_way' => 'ali');
					$data = $orderDb->get_one($wherearr, '*');
					if (!(0 < $data['ispay'])){
						$updatedata = array('openid' => $user_id, 'transaction_id' => $transaction_id, 'state' => 1, 'truename' => $account,'ispay' => 1, 'p_openid' => $user_id, 'paytime' => time());
						$orderDb->update($updatedata, array('id' => $data['id']));//改变收银订单状态
					}
					$date=strtotime(date('Y-m-d'));//当天凌晨时间
					$now=time();//当前时间
					//$sqlStr='SELECT DISTINCT ordr.* FROM '.$this->tablepre.'cashier_order as ordr where ordr.mid=' . $this->mid . '  AND ordr.ispay="1" ORDER BY ordr.paytime DESC,ordr.id DESC LIMIT 0,5';
					$sqlStr = 'select distinct case when o.openid = f.openid and o.mid=f.mid then f.headimgurl else null end as headimgurl,o.*,f.nickname from '.$this->tablepre.'cashier_order as o left join '.$this->tablepre.'cashier_fans as f on o.openid=f.openid and o.mid=f.mid where o.mid='.$this->mid.' and o.ispay="1" order by o.paytime desc limit 5';
					$sqlObj = new model();
					$neworder = $sqlObj->selectBySql($sqlStr);
					$order_arr = array();
					foreach ($neworder as $key => $val) {
						$order_arr[] = $val;
						$order_arr[$key]['paytime'] = date('Y-m-d H:i:s', $val['paytime']);
						$order_arr[$key]['add_time'] = date('Y-m-d H:i:s', $val['add_time']);
					}
					$lastOne = $order_arr[0];
					$sqlStr2="SELECT SUM(goods_price)FROM " . $this->tablepre . "cashier_order as ordr where ordr.mid=" . $this->mid . " AND ordr.ispay=1 AND ordr.refund!=2";
					$allarr = $sqlObj->selectBySql($sqlStr2);//总计金额
					$allpay=$allarr[0]['SUM(goods_price)'];
					$sqlStr3='SELECT SUM(goods_price)FROM ' . $this->tablepre . 'cashier_order as ordr where ordr.mid=' . $this->mid . ' AND ordr.ispay=1 AND ordr.refund!=2 AND ordr.add_time>='.$date.' AND ordr.paytime <='.$now;
					$dayarr = $sqlObj->selectBySql($sqlStr3);//当天
					$daypay=$dayarr[0]['SUM(goods_price)'];

					//随机免单
					$this->merchant_favourable($data,$barPay,'alipay');

					$this->dexit(array('error' => 0, 'msg' => 'OK','orderList'=>$order_arr,'lastOne'=>$lastOne,'allpay'=>$allpay,'daypay'=>$daypay));
					break;
				case "FAILED":
					$result=$barPayResult->getResponse();
					$this->dexit(array('error' => 1, 'mid'=>$this->mid,'msg' => '错误描述：' . $result->msg));
//					echo "支付宝支付失败!!!" . "<br>--------------------------<br>";
//					if (!empty($barPayResult->getResponse())) {
//						print_r($barPayResult->getResponse());
//					}
					break;
				case "UNKNOWN":
					echo "系统异常，订单状态未知!!!" . "<br>--------------------------<br>";
					if (!empty($barPayResult->getResponse())) {
						print_r($barPayResult->getResponse());
					}
					break;
				default:
					echo "不支持的交易状态，交易返回异常!!!";
					break;
			}
			return;
		}
	}
	/*
     * 支付宝条码付生成订单
     * 2016.10.10
     * 陈琦
     */
	public function ali_order($datas){//通过刷卡支付，在表中建立订单
		$data['mid'] = $this->mid;
		$data['goods_id'] = 1;
		$data['pay_way'] = 'ali';
		$data['pay_type'] = 'barpay';
		$data['order_id'] = "barpay" . date('Ymdhis') . mt_rand(100, 1000);
		$data['goods_type'] = 'ordinary';
		$data['goods_name'] = '支付宝条码付';
		$data['goods_describe'] = '支付宝刷卡支付';
		$data['goods_price'] = trim($datas['goods_price']);
		$data['add_time'] = time();
		$insertid = M('cashier_order')->insert($data, true);
		return array_merge($datas, $data);
		$this->dexit(array('error' => 1, 'msg' => '订单生成失败'));
	}

/*
 * 新版刷卡支付页面
 * 2016.10.23
 * 陈琦
 */
	public function money(){
		//$SiteUrl = $this->SiteUrl;
		$date=strtotime(date('Y-m-d'));//当天凌晨时间
		$month_begin=strtotime(date('Y-m'));
		/*$appid = M('config')->get_one(array('name'=>'alipay_appid'),'value');
		$private_key = M('config')->get_one(array('name'=>'alipay_private_key'),'value');
		$public_key = M('config')->get_one(array('name'=>'alipay_public_key'),'value');
		$config = array(
			'alipay_appid'=>$appid['value'],
			'alipay_private_key'=>$private_key['value'],
			'alipay_public_key'=>$public_key['value']
		);
		dump($config);exit;*/
		$now=time();//当前时间
		$sqlStr = 'select distinct case when o.openid = f.openid and o.mid=f.mid then f.headimgurl else null end as headimgurl,o.*,f.nickname from '.$this->tablepre.'cashier_order as o left join '.$this->tablepre.'cashier_fans as f on o.openid=f.openid and o.mid=f.mid where o.mid='.$this->mid.' and o.ispay="1" order by o.paytime desc limit 5';
		$sqlObj = new model();
		$neworder = $sqlObj->selectBySql($sqlStr);
		$lastResult= $neworder[0];
		$sqlStr2="SELECT SUM(goods_price)FROM " . $this->tablepre . "cashier_order as ordr where ordr.mid=" . $this->mid . " AND ordr.ispay=1 AND ordr.refund!=2 and ordr.add_time>=".$month_begin." and ordr.paytime <=".$now;
		$allarr = $sqlObj->selectBySql($sqlStr2);//总计金额
		//dump($allpay[0]['SUM(goods_price)']);exit;
		$allpay=$allarr[0]['SUM(goods_price)'];
		$sqlStr3='SELECT SUM(goods_price)FROM ' . $this->tablepre . 'cashier_order as ordr where ordr.mid=' . $this->mid . ' AND ordr.ispay=1 AND ordr.refund!=2 AND ordr.add_time>='.$date.' AND ordr.paytime <='.$now;
		$dayarr = $sqlObj->selectBySql($sqlStr3);//当天
		$daypay=$dayarr[0]['SUM(goods_price)'];
		include $this->showTpl();
	}

	/*
	 * 新版刷卡支付后台逻辑
	 * 2015.10.23
	 * 陈琦
	 */
	public function skPay(){
		if(IS_POST){
			//$this->dexit(array('error' => 0, 'msg' => 'OK'));
			$data = $this->clear_html($_POST);
			empty($data['goods_price']) && $this->dexit(array('error' => 1, 'msg' => '支付金额必须填写！'));
			empty($data['auth_code']) && $this->dexit(array('error' => 1, 'msg' => '支付auth_code为空'));
			if(substr($data['auth_code'],0,2)==13){//微信条码
				$data = $this->sm_order($data);
				bpBase::loadAppClass('wxSaoMaPay', 'User', 0);
				$wxSaoMaPay = new wxSaoMaPay();
				$response = $wxSaoMaPay->micropay($data);
				if(!empty($response)){
					if($response['return_code']=='SUCCESS'){
						if($response['result_code']=='SUCCESS'){
							$order_id = trim($response['out_trade_no']);
							$appid = trim($response['appid']);
							$total_fee = trim($response['total_fee']);
							$openid = trim($response['openid']);
							$transaction_id = trim($response['transaction_id']);
							$trade_type = trim($response['trade_type']);
							$is_subscribe = (strtoupper(trim($response['is_subscribe'])) == 'Y' ? 1 : 0);
							$orderDb = M('cashier_order');
							$wherearr = array('order_id' => $order_id, 'pay_way' => 'weixin');
							if (!empty($data) && isset($data['id'])) {
								$wherearr['id'] = $data['id'];
							}
							$data = $orderDb->get_one($wherearr, '*');


							if (!(0 < $data['ispay'])) {
                                $wxuserinfo = array();
                                bpBase::loadOrg('wxCardPack');
                                $wxCardPack = new wxCardPack($this->wx_user, $this->mid);
                                $access_token = $wxCardPack->getToken();
                                $wxuserinfo = $wxCardPack->GetwxUserInfoByOpenid($access_token, $openid);
                                $info=M('user')->get_one(array('openid'=>$openid),'*');
                                if(!$info){
                                    //没有查到相关信息，查一下nickname
                                    $after_name=preg_replace('/[\x{10000}-\x{10FFFF}]/u', '', $wxuserinfo['nickname']);//去除非3字节的特殊符号
                                    $is_old = M('user')->get_one(array('nickname'=>$after_name),'*');
                                    if($is_old){
                                        //是老用户
                                        $updateArray = array(
                                            'openid'=>$wxuserinfo['openid'],
                                            'unionid'=>$wxuserinfo['unionid'],
                                            'update_time'=>time()
                                        );
                                        M('user')->update($updateArray,array('uid'=>$is_old['uid']));
                                    }
                                }
                                M('user')->update(array('score_count'=>floatval($info['score_count'])+floatval($total_fee/100)),array('openid'=>$openid));
                                $time=time();
								if (isset($wxuserinfo['nickname'])){//只有关注了才可通过此接口获取基本信息
                                    if($info && ($time-$info['update_time']>30*24*60*60)){
                                        $update=M('user')->update(array('nickname'=>$wxuserinfo['nickname'],'avatar'=>$wxuserinfo['headimgurl'],'update_time'=>$time),array('openid'=>$openid));
								}
									$fansData['nickname'] = $wxuserinfo['nickname'];
									$fansData['sex'] = $wxuserinfo['sex'];
									$fansData['province'] = $wxuserinfo['province'];
									$fansData['city'] = $wxuserinfo['city'];
									$fansData['country'] = $wxuserinfo['country'];
									$fansData['headimgurl'] = $wxuserinfo['headimgurl'];
									$fansData['groupid'] = $wxuserinfo['groupid'];
									$fansData['is_subscribe'] = 1;
									$fansData['appid'] = $appid;
								}
								$updatedata = array('openid' => $openid, 'transaction_id' => $transaction_id, 'state' => 1, 'ispay' => 1, 'p_openid' => $openid, 'paytime' => time());
								//M('meal_order')->update(array('paid'=>1,'pay_time'=>time()),array('orderid'=>$order_id));	//支付成功后改变其快店订单状态
								$fansDb = M('cashier_fans');
								$tmpfans = $fansDb->get_one(array('openid' => $openid, 'mid' => $this->mid), '*');
								if($tmpfans){//fans表存在该openid
									$updatedata['truename']=$fansData['nickname'];
									$fansData['totalfee'] = $total_fee + $tmpfans['totalfee'];
									$fansDb->update($fansData, array('id' => $tmpfans['id']));
								}else{
									isset($wxuserinfo['nickname']) && $updatedata['truename'] = $wxuserinfo['nickname'];
                                    $after_name=preg_replace('/[\x{10000}-\x{10FFFF}]/u', '', $wxuserinfo['nickname']);//去除非3字节的特殊符号
                                    $is_old_fans = $fansDb->get_one(array('nickname' =>$after_name, 'mid' => $this->mid), '*');
                                    if($is_old_fans){
                                        //老粉丝
                                        $fansDb->update(array('openid'=>$wxuserinfo['openid']), array('id' => $is_old_fans['id']));
                                    }else{
                                        $fansData['mid'] = $this->mid;
                                        $fansData['openid'] = $openid;
                                        $fansData['totalfee'] = $total_fee;
                                        $fansData['add_time']=$time;
                                        $fansDb->insert($fansData, true);
                                    }
								}
								$orderDb->update($updatedata, array('id' => $data['id']));
								$date=strtotime(date('Y-m-d'));//当天凌晨时间
                                $month_begin=strtotime(date('Y-m'));
								$now=time();//当前时间
								//$sqlStr = 'SELECT DISTINCT ordr.id,ordr.*,cf.nickname,cf.headimgurl FROM ' . $this->tablepre . 'cashier_order as ordr LEFT JOIN ' . $this->tablepre . 'cashier_fans AS cf ON ordr.openid=cf.openid where ordr.mid=' . $this->mid . ' AND cf.mid=' . $this->mid . ' AND ordr.ispay="1" ORDER BY ordr.paytime DESC,ordr.id DESC LIMIT 0,5';
								$sqlStr = 'select distinct case when o.openid = f.openid and o.mid=f.mid then f.headimgurl else null end as headimgurl,o.*,f.nickname from '.$this->tablepre.'cashier_order as o left join '.$this->tablepre.'cashier_fans as f on o.openid=f.openid and o.mid=f.mid where o.mid='.$this->mid.' and o.ispay="1" order by o.paytime desc limit 5';
								$sqlObj = new model();
								$neworder = $sqlObj->selectBySql($sqlStr);
								$order_arr = array();
								foreach ($neworder as $key => $val) {
									$order_arr[] = $val;
									$order_arr[$key]['paytime'] = date('Y-m-d H:i:s', $val['paytime']);
									$order_arr[$key]['add_time'] = date('Y-m-d H:i:s', $val['add_time']);
								}
								$lastOne = $order_arr[0];
								$sqlStr2="SELECT SUM(goods_price)FROM " . $this->tablepre . "cashier_order as ordr where ordr.mid=" . $this->mid . " AND ordr.ispay=1 AND ordr.refund!=2 AND ordr.add_time>=".$month_begin." AND ordr.paytime <=".$now;
								$allarr = $sqlObj->selectBySql($sqlStr2);//总计金额
								$allpay=$allarr[0]['SUM(goods_price)'];
								$sqlStr3='SELECT SUM(goods_price)FROM ' . $this->tablepre . 'cashier_order as ordr where ordr.mid=' . $this->mid . ' AND ordr.ispay=1 AND ordr.refund!=2 AND ordr.add_time>='.$date.' AND ordr.paytime <='.$now;
								$dayarr = $sqlObj->selectBySql($sqlStr3);//当天
								$daypay=$dayarr[0]['SUM(goods_price)'];

                                //随机免单
                                $this->merchant_favourable($data,$wxSaoMaPay);

								$this->dexit(array('error' => 0, 'msg' => 'OK','orderList'=>$order_arr,'lastOne'=>$lastOne,'allpay'=>$allpay,'daypay'=>$daypay));
							}
						}
						$this->dexit(array('error' => 1,'data'=>$data, 'mid'=>$this->mid,'res'=>$response,'arr'=>$response['err_code'],'msg' => '错误码：' . $response['err_code'] . '<br/>错误描述：' . $response['err_code_des']));
					}
					$this->dexit(array('error' => 1, 'msg' => '错误描述：' . $response['return_msg']));
				}
			}
			if (substr($data['auth_code'],0,2)==28){//支付宝条码
				//$this->dexit(array('error' => 1, 'msg' => '暂未开通支付宝支付！'));
				$this->aliPay($data);
			}
			if (substr($data['auth_code'],0,1)==6){
				$this->pay_dataForm($data);
			}
		}
	}
	/*
	 * 微信支付需要输入密码时调用
	 * 2016.10.23
	 * 陈琦
	 */
	public function search(){
		$datas = $this->clear_html($_POST);
		bpBase::loadAppClass('wxSaoMaPay', 'User', 0);
		$wxSaoMaPay = new wxSaoMaPay();
		$result = $wxSaoMaPay->search($datas);
		if($result['trade_state']=='SUCCESS'){
			//$this->dexit(array('error' => 1, 'mid'=>$this->mid,'msg' => '述'));
			$order_id = trim($result['out_trade_no']);
			$appid = trim($result['appid']);
			$total_fee = trim($result['total_fee']);
			$openid = trim($result['openid']);
			$transaction_id = trim($result['transaction_id']);
			//$trade_type = trim($result['trade_type']);
			//$is_subscribe = (strtoupper(trim($result['is_subscribe'])) == 'Y' ? 1 : 0);
			$orderDb = M('cashier_order');
			$wherearr = array('order_id' => $order_id, 'pay_way' => 'weixin');
			if (!empty($data) && isset($data['id'])) {
				$wherearr['id'] = $data['id'];
			}
			$data = $orderDb->get_one($wherearr, '*');
			//$this->dexit(array('error' => 1,'mid'=>$this->mid, 'msg' => '密码正确2输完'.$result['out_trade_no']));
			if (!(0 < $data['ispay'])) {
                $wxuserinfo = array();
                bpBase::loadOrg('wxCardPack');
                $wxCardPack = new wxCardPack($this->wx_user, $this->mid);
                $access_token = $wxCardPack->getToken();
                $wxuserinfo = $wxCardPack->GetwxUserInfoByOpenid($access_token, $openid);
                $info=M('user')->get_one(array('openid'=>$openid),'*');
                if(!$info){
                    //没有查到相关信息，查一下nickname
                    $after_name=preg_replace('/[\x{10000}-\x{10FFFF}]/u', '', $wxuserinfo['nickname']);//去除非3字节的特殊符号
                    $is_old = M('user')->get_one(array('nickname'=>$after_name),'*');
                    if($is_old){
                        //是老用户
                        $updateArray = array(
                            'openid'=>$wxuserinfo['openid'],
                            'unionid'=>$wxuserinfo['unionid'],
                            'update_time'=>time()
                        );
                        M('user')->update($updateArray,array('uid'=>$is_old['uid']));
                    }
                }
                $time=time();
				if (isset($wxuserinfo['nickname'])){//只有关注了才可通过此接口获取基本信息
                    if($info && ($time-$info['update_time']>30*24*60*60)){
                        $update=M('user')->update(array('nickname'=>$wxuserinfo['nickname'],'avatar'=>$wxuserinfo['headimgurl'],'update_time'=>$time),array('openid'=>$openid));
                    }
					$fansData['nickname'] = $wxuserinfo['nickname'];
					$fansData['sex'] = $wxuserinfo['sex'];
					$fansData['province'] = $wxuserinfo['province'];
					$fansData['city'] = $wxuserinfo['city'];
					$fansData['country'] = $wxuserinfo['country'];
					$fansData['headimgurl'] = $wxuserinfo['headimgurl'];
					$fansData['groupid'] = $wxuserinfo['groupid'];
					$fansData['is_subscribe'] = 1;
					$fansData['appid'] = $appid;
				}
				//$this->dexit(array('error' => 1,'mid'=>$this->mid, 'msg' => '密码正确2输完'.$result['out_trade_no']));
				$updatedata = array('openid' => $openid, 'transaction_id' => $transaction_id, 'state' => 1, 'ispay' => 1, 'p_openid' => $openid, 'paytime' => time());
				//M('meal_order')->update(array('paid'=>1,'pay_time'=>time()),array('orderid'=>$order_id));	//支付成功后改变其快店订单状态
				$fansDb = M('cashier_fans');
				$tmpfans = $fansDb->get_one(array('openid' => $openid, 'mid' => $this->mid), '*');
				if($tmpfans){//fans表存在该openid
					$updatedata['truename']=$fansData['nickname'];
					$fansData['totalfee'] = $total_fee + $tmpfans['totalfee'];
					$fansDb->update($fansData, array('id' => $tmpfans['id']));
				}else{
					isset($wxuserinfo['nickname']) && $updatedata['truename'] = $wxuserinfo['nickname'];
                    $after_name=preg_replace('/[\x{10000}-\x{10FFFF}]/u', '', $wxuserinfo['nickname']);//去除非3字节的特殊符号
                    $is_old_fans = $fansDb->get_one(array('nickname' =>$after_name, 'mid' => $this->mid), '*');
                    if($is_old_fans){
                        //老粉丝
                        $fansDb->update(array('openid'=>$wxuserinfo['openid']), array('id' => $is_old_fans['id']));
                    }else{
                        $fansData['mid'] = $this->mid;
                        $fansData['openid'] = $openid;
                        $fansData['totalfee'] = $total_fee;
                        $fansData['add_time']=$time;
                        $fansDb->insert($fansData, true);
                    }
				}
				$orderDb->update($updatedata, array('id' => $data['id']));
				$date=strtotime(date('Y-m-d'));//当天凌晨时间
                $month_begin=strtotime(date('Y-m'));
				$now=time();//当前时间
				//$sqlStr = 'SELECT DISTINCT ordr.id,ordr.*,cf.nickname,cf.headimgurl FROM ' . $this->tablepre . 'cashier_order as ordr LEFT JOIN ' . $this->tablepre . 'cashier_fans AS cf ON ordr.openid=cf.openid where ordr.mid=' . $this->mid . ' AND cf.mid=' . $this->mid . ' AND ordr.ispay="1" ORDER BY ordr.paytime DESC,ordr.id DESC LIMIT 0,5';
				$sqlStr = 'select distinct case when o.openid = f.openid and o.mid=f.mid then f.headimgurl else null end as headimgurl,o.*,f.nickname from '.$this->tablepre.'cashier_order as o left join '.$this->tablepre.'cashier_fans as f on o.openid=f.openid and o.mid=f.mid where o.mid='.$this->mid.' and o.ispay="1" order by o.paytime desc limit 5';
				$sqlObj = new model();
				$neworder = $sqlObj->selectBySql($sqlStr);
				$order_arr = array();
				foreach ($neworder as $key => $val) {
					$order_arr[] = $val;
					$order_arr[$key]['paytime'] = date('Y-m-d H:i:s', $val['paytime']);
					$order_arr[$key]['add_time'] = date('Y-m-d H:i:s', $val['add_time']);
				}
				$lastOne = $order_arr[0];
				$sqlStr2="SELECT SUM(goods_price)FROM " . $this->tablepre . "cashier_order as ordr where ordr.mid=" . $this->mid . " AND ordr.ispay=1 AND ordr.refund!=2 AND ordr.add_time>=".$month_begin." AND ordr.paytime <=".$now;
				$allarr = $sqlObj->selectBySql($sqlStr2);//总计金额
				$allpay=$allarr[0]['SUM(goods_price)'];
				$sqlStr3='SELECT SUM(goods_price)FROM ' . $this->tablepre . 'cashier_order as ordr where ordr.mid=' . $this->mid . ' AND ordr.ispay=1 AND ordr.refund!=2 AND ordr.add_time>='.$date.' AND ordr.paytime <='.$now;
				$dayarr = $sqlObj->selectBySql($sqlStr3);//当天
				$daypay=$dayarr[0]['SUM(goods_price)'];
				//随机免单
                $this->merchant_favourable($data,$wxSaoMaPay);

				$this->dexit(array('error' => 0,'mid'=>$this->mid, 'msg' => '用户输入密码支付成功！','orderList'=>$order_arr,'lastOne'=>$lastOne,'allpay'=>$allpay,'daypay'=>$daypay));
			}
			//$this->dexit(array('error' => 1,'mid'=>$this->mid, 'msg' => '密码正确44输完'.$result['out_trade_no']));
		}else if ($result['dd']=='超时'){
			$this->dexit(array('error' => 1,'mid'=>$this->mid, 'msg' => '请提醒用户输入密码'));
		}else{
			$this->dexit(array('error' => 1,'mid'=>$this->mid, 'msg' => '密码输入错误'));
		}
		//$this->dexit(array('error' => 1, 'msg' => $datas));
	}

	public function weixinPay($data){
		if(IS_POST){
			/*if ($this->wx_user['isOpen'] == 0) {
				$this->dexit(array('error' => 1, 'msg' => '商家未开启微信支付'));
			}*/
			$time=time();
			$data = $this->sm_order($data);
			bpBase::loadAppClass('wxSaoMaPay', 'User', 0);
			$wxSaoMaPay = new wxSaoMaPay();
			$response = $wxSaoMaPay->micropay($data);
			if (!empty($response)) {
				if ($response['return_code'] == 'SUCCESS') {
					if ($response['result_code'] == 'SUCCESS') {
//						$myfile = fopen("ggg.log", "a+") or die("Unable to open file!");
//						fwrite($myfile, $response);
						$order_id = trim($response['out_trade_no']);
						$appid = trim($response['appid']);
						$sub_appid = (isset($response['sub_appid']) ? $response['sub_appid'] : '');
						$sub_mch_id = (isset($response['sub_mch_id']) ? $response['sub_mch_id'] : '');
						$total_fee = trim($response['total_fee']);
						$openid = trim($response['openid']);
						//$sub_openid = (isset($response['sub_openid']) ? $response['sub_openid'] : '');
						$sub_openid=$openid;//没有sub_appid
						$transaction_id = trim($response['transaction_id']);
						$trade_type = trim($response['trade_type']);
						$is_subscribe = (strtoupper(trim($response['is_subscribe'])) == 'Y' ? 1 : 0);
						$orderDb = M('cashier_order');
						$wherearr = array('order_id' => $order_id, 'pay_way' => 'weixin');
						if (!empty($data) && isset($data['id'])) {
							$wherearr['id'] = $data['id'];
						}

						$tmpopenid = (!empty($sub_mch_id) ? $sub_openid : $openid);
						$p_openid = (!empty($sub_mch_id) ? $openid : '');
						$tmpappid = (!empty($sub_mch_id) ? $sub_appid : $appid);
						$data = $orderDb->get_one($wherearr, '*');
						$wxuserinfo = array();
						bpBase::loadOrg('wxCardPack');
						if (!empty($sub_mch_id) && isset($this->wx_user['submchinfo']) && ($this->mid == $this->wx_user['submchinfo']['mid'])) {
							$wxCardPack = new wxCardPack($this->wx_user['submchinfo'], $this->mid);
						}else {
							$wxCardPack = new wxCardPack($this->wx_user, $this->mid);
						}

						$access_token = $wxCardPack->getToken();
						$wxuserinfo = $wxCardPack->GetwxUserInfoByOpenid($access_token, $tmpopenid);

						if (!(0 < $data['ispay'])) {
							$updatedata = array('openid' => $tmpopenid, 'transaction_id' => $transaction_id, 'state' => 1, 'ispay' => 1, 'p_openid' => $p_openid, 'paytime' => time());
							M('meal_order')->update(array('paid'=>1,'pay_time'=>time()),array('orderid'=>$order_id));	//支付成功后改变其快店订单状态
							isset($wxuserinfo['nickname']) && $updatedata['truename'] = $wxuserinfo['nickname'];
							$orderDb->update($updatedata, array('id' => $data['id']));
							$fansDb = M('cashier_fans');


							$sqlStr = 'SELECT DISTINCT ordr.id,ordr.*,cf.nickname FROM ' . $this->tablepre . 'cashier_order as ordr LEFT JOIN ' . $this->tablepre . 'cashier_fans AS cf ON ordr.openid=cf.openid where ordr.mid=' . $this->mid . ' AND cf.mid=' . $this->mid . ' AND ordr.ispay="1" ORDER BY ordr.paytime DESC,ordr.id DESC LIMIT 0,5';
							$sqlObj=new model();
							$neworder=$sqlObj->selectBySql($sqlStr);
							$order_arr=array();
							foreach($neworder as $key=>$val){
								$order_arr[]=$val;
								$order_arr[$key]['paytime']=date('Y-m-d H:i:s',$val['paytime']);
								$order_arr[$key]['add_time']=date('Y-m-d H:i:s',$val['add_time']);
							}
							$lastOne=$order_arr[0];
							$this->dexit(array('error' => 0, 'msg' => 'OK','orderList'=>$order_arr,'lastOne'=>$lastOne));


							if (!empty($tmpopenid)) {
								$tmpfans = $fansDb->get_one(array('openid' => $tmpopenid, 'mid' => $this->mid), '*');
								$fansData = array('appid' => $tmpappid, 'totalfee' => $total_fee, 'is_subscribe' => 0);

								if (isset($wxuserinfo['nickname'])) {
									$fansData['nickname'] = $wxuserinfo['nickname'];
									$fansData['sex'] = $wxuserinfo['sex'];
									$fansData['province'] = $wxuserinfo['province'];
									$fansData['city'] = $wxuserinfo['city'];
									$fansData['country'] = $wxuserinfo['country'];
									$fansData['headimgurl'] = $wxuserinfo['headimgurl'];
									$fansData['groupid'] = $wxuserinfo['groupid'];
									$fansData['is_subscribe'] = 1;
									$fansData['add_time']=$time;
								}

								if (!empty($tmpfans) && is_array($tmpfans)) {
									$fansData['totalfee'] = $fansData['totalfee'] + $tmpfans['totalfee'];
									$fansDb->update($fansData, array('id' => $tmpfans['id']));
								}else {
									$fansData['mid'] = $this->mid;
									$fansData['openid'] = $tmpopenid;
                                    $fansData['add_time']=$time;
									$fansDb->insert($fansData, true);
								}

								unset($fansData);
							}

							if (!empty($p_openid) && isset($this->wx_user['p_mid']) && isset($this->wx_user['submchinfo'])) {
								$pwxCardPack = new wxCardPack($this->wx_user, $this->wx_user['p_mid']);
								$paccess_token = $pwxCardPack->getToken();
								$pwxuserinfo = $pwxCardPack->GetwxUserInfoByOpenid($paccess_token, $p_openid);
								$ptmpfans = $fansDb->get_one(array('openid' => $p_openid, 'mid' => $this->wx_user['p_mid']), '*');
								$fansData = array('appid' => $this->wx_user['appid'], 'totalfee' => $total_fee, 'is_subscribe' => 0);

								if (isset($pwxuserinfo['nickname'])) {
									$fansData['nickname'] = $pwxuserinfo['nickname'];
									$fansData['sex'] = $pwxuserinfo['sex'];
									$fansData['province'] = $pwxuserinfo['province'];
									$fansData['city'] = $pwxuserinfo['city'];
									$fansData['country'] = $pwxuserinfo['country'];
									$fansData['headimgurl'] = $pwxuserinfo['headimgurl'];
									$fansData['groupid'] = $pwxuserinfo['groupid'];
									$fansData['is_subscribe'] = 1;
                                    $fansData['add_time']=$time;
								}

								if (!empty($ptmpfans) && is_array($ptmpfans)) {
									$fansData['totalfee'] = $fansData['totalfee'] + $ptmpfans['totalfee'];
									$fansDb->update($fansData, array('id' => $ptmpfans['id']));
								}else {
									$fansData['mid'] = $this->wx_user['p_mid'];
									$fansData['openid'] = $p_openid;
                                    $fansData['add_time']=$time;
									$fansDb->insert($fansData, true);
								}
							}
						}

					}

					$this->dexit(array('error' => 1, 'msg' => '错误码：' . $response['err_code'] . '<br/>错误描述：' . $response['err_code_des']));
				}

				$this->dexit(array('error' => 1, 'msg' => '错误描述：' . $response['return_msg']));
			}
		}
	}

	/*
	 * 随机免单
	 * 2018.4.13
	 */
	public function merchant_favourable($data,$object,$type=0) {
		if ($data) {
//            $store_id = M('meal_order')->get_one(array('orderid'=>$data['order_id'],'store_id'))['store_id'];//店铺id
            $merchant_mid = M('cashier_merchants')->get_one(array('mid'=>$data['mid']))['thirduserid'];
            $store_id = M('merchant_store')->get_one(array('mer_id'=>$merchant_mid),'store_id','last_time desc')['store_id'];//店铺id
			$favourable = M('config')->get_one(array('info'=>'merchant_favourable','gid'=>$data['mid'],'tab_id'=>$store_id,'status'=>1));//查看面单配置信息
            if ($favourable) {
				$value = unserialize($favourable['value']);
                $merchant_max = $value['merchant_max'];//最大免单金额
                $merchant_starttime = $value['merchant_starttime'];
                $merchant_endtime = $value['merchant_endtime'];
                $starttime = strtotime(date('Y-m-d '.$merchant_starttime,time()));//免单开始时间
                $endtime = strtotime(date('Y-m-d '.$merchant_endtime,time()));//免单结束时间
				//在优惠时间内才进行随机免单
				if (time()>$starttime && time()<$endtime) {
					$goods_price = $data['goods_price'];//付款金额
					//付款金额小于最大面单金额才进行随机免单
					if ($goods_price < $merchant_max) {
                        $merchant_chance = intval(trim($value['merchant_chance'],'%'));//免单概率
						//保险起见概率大于15%不进行免单
						if ($merchant_chance <= 15) {
							$i = mt_rand(1,100);//随机数
							if ($i>=1 && $i<=$merchant_chance) {
                                if (!$type) {
                                    $object->wxRefundTwo($data['id'], $this->wx_user, $data['mid']);
                                } elseif ($type == 'appPay') {
                                    $this->appPay_refund($data['id']);
                                } elseif ($type == 'alipay'){
                                    $this->alipay_refund($data['id'],$object);
                                }
							}
						}
					}
				}

			}
		}

	}

	//支付宝alipay退款
	public function alipay_refund($ordid,$barPay) {
        $orderDb = M('cashier_order');
        $ordertmp = $orderDb->get_one(array('id' => $ordid), '*');
        bpBase::loadOrg('Alipay1/f2fpay/model/builder/AlipayTradeRefundContentBuilder');
        //$appAuthToken = "201611BBc9392e440a7a4f3f9d88b9b0ea56bA29";//根据真实值填写
        $appAuthToken=$this->wx_user['token'];
        $barPayRequestBuilder = new AlipayTradeRefundContentBuilder();
        $barPayRequestBuilder->setOutTradeNo($ordertmp['order_id']);
        $barPayRequestBuilder->setRefundAmount($ordertmp['goods_price']);
        $barPayRequestBuilder->setAppAuthToken($appAuthToken);//退款需要
        //查询当前的支付宝配置
        $appid = M('config')->get_one(array('name'=>'alipay_appid'),'value');
        $private_key = M('config')->get_one(array('name'=>'alipay_private_key'),'value');
        $public_key = M('config')->get_one(array('name'=>'alipay_public_key'),'value');
        $config = array(
            'alipay_appid'=>$appid['value'],
            'alipay_private_key'=>$private_key['value'],
            'alipay_public_key'=>$public_key['value']
        );
        $barPayResultTwo = $barPay->refund($barPayRequestBuilder);
        if ($barPayResultTwo->getTradeStatus() == 'SUCCESS') {
            $result=$barPayResultTwo->getResponse();
            $updatedata = array('refund' => 2, 'refundtext' => serialize($result));
            $orderDb->update($updatedata, array('id' => $ordertmp['id']));
		}

	}

	//公众号平台退款
//	public function appPay_refund($ordid = 124178) {
//        $ordertmp =  M('cashier_order')->get_one(array('id' => $ordid), '*');
//        $thirduserid=M('cashier_merchants')->get_one(array('mid'=>$this->mid),'thirduserid');//获取当前收银台mid对应O2O商户ID
//        $auth_code=$ordertmp['auth_code'];//获取当前订单的支付二维码
//        $uid=substr($auth_code,14,4);//当前使用余额付的用户uid
//        $openid=M('user')->get_one(array('uid'=>$uid),'openid');
//        $app_money=$ordertmp['app_money'];//来自平台余额
//        $merchant_money=$ordertmp['merchant_money'];//来自对应商户余额
//        if($app_money!=0){
//            $app_before_money=M('user')->get_one(array('uid'=>$uid),'now_money');//平台原来余额
//            $now_money=(float)$app_before_money['now_money']+(float)$app_money;//退款后余额
//            M('user')->update(array('now_money'=>$now_money),array('uid'=>$uid));
//            M('cashier_order')->update(array('refund'=>2),array('id'=>$ordertmp['id']));
//        }
//        if($merchant_money!=0){
//            $merchant_before_money=M('user_merchant_money')->get_one(array('uid'=>$uid,'mer_id'=>$thirduserid['thirduserid']),'money');//对应商户原来余额
//            $this_money=(float)$merchant_before_money['money']+(float)$merchant_money;//退款后余额
//            M('user_merchant_money')->update(array('money'=>$this_money),array('uid'=>$uid,'mer_id'=>$thirduserid['thirduserid']));
//            M('cashier_order')->update(array('refund'=>2),array('id'=>$ordertmp['id']));
//        }
//        //退款到账通知
//        $time = time();
//        $href = 'http://'.$_SERVER['HTTP_HOST'].'/wap.php?c=Pay&a=pay_accomplish&money='.$ordertmp['goods_price'].'&name='.$ordertmp['goods_name'].'&outid='.$ordertmp['order_id'].'&time='.$time;
//        $template=array(
//            'touser'=>$openid['openid'],
//            'template_id'=>"6i_aCP9aDxsBgKLrnYNqwnFzMOigv1PvAJedMDWzVUE",
//            'url'=>$href,
//            'data'=>array(
//                'first'=>array(
//                    'value'=>urlencode("退款到账通知"),
//                    'color'=>"#029700",
//                ),
//                'keyword1'=>array(
//                    'value'=>urlencode($ordertmp['goods_name']),
//                    'color'=>"#000000",
//                ),
//                'keyword2'=>array(
//                    'value'=>urlencode($ordertmp['order_id']),
//                    'color'=>"#000000",
//                ),
//                'keyword3'=>array(
//                    'value'=>urlencode($ordertmp['goods_price'].'元'),
//                    'color'=>"#000000",
//                ),
//                'keyword4'=>array(
//                    'value'=>urlencode($ordertmp['pay_type']),
//                    'color'=>"#000000",
//                ),
//                'keyword5'=>array(
//                    'value'=>urlencode(date('Y-m-d H:i:s',$time)),
//                    'color'=>"#000000",
//                ),
//            )
//        );
//        $this->send_template_message(urldecode(json_encode($template)));
//        $score['uid']=$uid;
//        $score['type']=2;//积分减少
//        $score['score']=floor($ordertmp['goods_price']);
//        $score['time']=$_SERVER['REQUEST_TIME'];
//        $score['ip']=9;
//        $score['desc']='退款'.$ordertmp['goods_price'].'元';
//        M('user_money_list')->update(array('type'=>3,'refund'=>2),array('auth_code'=>$auth_code));
//        M('user_score_list')->insert($score,true);
//	}

	/*
	 * 获取公众号平台二维码收款
	 * 陈琦
	 * 2016.11.9
	 */
	public function pay_dataForm($data)
	{
		if (IS_POST) {
			$date = strtotime(date('Y-m-d'));//当天凌晨时间
			$now = time();//当前时间
			//获取当前收银台mid对应O2O商户ID
			$stime = $this->stringtime($data);//获取生成二维码时间戳
			//$this->dexit(array('error'=>1,'msg'=>$stime.'--'.time()));
			if ((time() - $stime) > 30) {
				$this->dexit(array('error' => 1, 'mid' => $this->mid, 'msg' => '此二维码已过期，请刷新重试！'));
			}
			$b = 'appPay';
			$sql = 'select a.* from ' . $this->tablepre . 'cashier_order as a where a.pay_way ="' . $b . '" order by a.id desc LIMIT 10';
			$sqlObj = new model();
			$arr = $sqlObj->selectBySql($sql);
			foreach ($arr as $key => $value) {
				if ($arr[$key]['auth_code'] == $data['auth_code']) {
					$this->dexit(array('error' => 1, 'mid' => $this->mid, 'msg' => '二维码只能使用一次，请刷新重试！'));
				}
			}
			$data = $this->appOrder($data);
			//setCache('code1', $data['auth_code']);//第一次,上一次二维码
			//$now_code = getCache('code');//
			//if($now_code == $data['auth_code']){
			//	$this->dexit(array('error'=>1,'mid'=>$this->mid,'msg'=>'二维码只能使用一次，请刷新重试！'));
			//}else{
			//	setCache('code', $data['auth_code']);//第二次，当前二维码
			//$this->dexit(array('error'=>1,'msg'=>'二维码可用！'));
			$str = $data['auth_code'];
			$suid = intval(substr($str, 14));//获取用户uid
			$money = $data['goods_price'];    //实际收款
			if (!empty($suid)) {
				$user_info = M('user')->get_one(array('uid' => $suid), '*');    //获取用户信息
				$user_money = $user_info['now_money'];//用户余额
				//首先得到 用户商户关联表 余额
				$user_merchant_money = M('user_merchant_money')->get_one(array('mer_id' => $this->thirduserid, 'uid' => $suid), 'money');
				$merchant_name = M('merchant')->get_one(array('mer_id' => $this->thirduserid), 'name');
				$score['uid'] = $suid;
				$score['type'] = 1;//积分增加
				$score['score'] = floor($money);
				$score['time'] = $_SERVER['REQUEST_TIME'];
				$score['ip'] = 6;
				$score['desc'] = '消费' . $money . '元';
				M('user_score_list')->insert($score, true);//积分纪录
				if (!empty($user_merchant_money)) {//充值过的商户
					if ($money < $user_merchant_money['money'] || $money == $user_merchant_money['money']) {//判断该用户余额是否够付
						$rest_money = (float)$user_merchant_money['money'] - (float)$money;//扣款成功后用户余额
						$app_pay_money = 0;//该笔订单从平台扣款数
						$merchant_pay_money = $money;//该笔订单从对应商户余额扣款数
						M('user_merchant_money')->update(array('money' => $rest_money), array('mer_id' => $this->thirduserid, 'uid' => $suid));//更新余额
						$update = array('paytime' => time(), 'ispay' => 1, 'state' => 1, 'truename' => $user_info['nickname'], 'openid' => $suid, 'app_money' => $app_pay_money, 'merchant_money' => $merchant_pay_money);
						M('cashier_order')->update($update, array('id' => $data['id']));
						$result['uid'] = $suid;
						$result['type'] = 2;
						$result['money'] = $money;
						$result['app_money'] = 0;
						$result['merchant_money'] = $money;
						$result['time'] = $_SERVER['REQUEST_TIME'];
						$result['desc'] = '余额消费';
						$result['name'] = $merchant_name['name'];
						$result['order_id']='xf'.time().mt_rand(100, 1000);
						$result['mid']=$this->thirduserid;
						$result['refund']=1;
						$result['auth_code']=$str;
						$result['now_money']=$user_merchant_money['money']-$money;
						M('user_money_list')->insert($result, true);
						$sqlStr = 'select distinct case when o.openid = f.openid and o.mid=f.mid then f.headimgurl else null end as headimgurl,o.*,f.nickname from ' . $this->tablepre . 'cashier_order as o left join ' . $this->tablepre . 'cashier_fans as f on o.openid=f.openid and o.mid=f.mid where o.mid=' . $this->mid . ' and o.ispay="1" order by o.paytime desc limit 5';
						$sqlObj = new model();
						$neworder = $sqlObj->selectBySql($sqlStr);
						$order_arr = array();
						foreach ($neworder as $key => $val) {
							$order_arr[] = $val;
							$order_arr[$key]['paytime'] = date('Y-m-d H:i:s', $val['paytime']);
							$order_arr[$key]['add_time'] = date('Y-m-d H:i:s', $val['add_time']);
						}
						$lastOne = $order_arr[0];
						$sqlStr2 = "SELECT SUM(goods_price)FROM " . $this->tablepre . "cashier_order as ordr where ordr.mid=" . $this->mid . " AND ordr.ispay=1 AND ordr.refund!=2";
						$allarr = $sqlObj->selectBySql($sqlStr2);//总计金额
						$allpay = $allarr[0]['SUM(goods_price)'];
						$sqlStr3 = 'SELECT SUM(goods_price)FROM ' . $this->tablepre . 'cashier_order as ordr where ordr.mid=' . $this->mid . ' AND ordr.ispay=1 AND ordr.refund!=2 AND ordr.add_time>=' . $date . ' AND ordr.paytime <=' . $now;
						$dayarr = $sqlObj->selectBySql($sqlStr3);//当天
						$daypay = $dayarr[0]['SUM(goods_price)'];
						$this->dexit(array('error' => 0, 'mid' => $this->mid, 'method' => 'appPay', 'msg' => 'OK', 'orderList' => $order_arr, 'lastOne' => $lastOne, 'allpay' => $allpay, 'daypay' => $daypay));
						//通知用户手机端付款成功
					} else {//对应商户余额不够从平台扣款
						//$this->dexit(array('error'=>1,'msg'=>'gg'));
						if (!empty($user_money)) {
							if ($money < $user_money || $money == $user_money) {
								$app_pay_money = (float)$money - (float)$user_merchant_money['money'];//该笔订单从平台扣款数
								$rest_money_arr = (float)$user_money - $app_pay_money;//扣款后平台余额
								$merchant_pay_money = (float)$user_merchant_money['money'];//该笔订单从对应商户余额扣款数
								$merchant_money = 0;//对应商户余额
								M('user')->update(array('now_money' => $rest_money_arr), array('uid' => $suid));//更新user表中余额
								M('user_merchant_money')->update(array('money' => $merchant_money), array('mer_id' => $this->thirduserid, 'uid' => $suid));//更新对应商户表余额
								$update = array('paytime' => time(), 'ispay' => 1, 'state' => 1, 'truename' => $user_info['nickname'], 'openid' => $suid, 'app_money' => $app_pay_money, 'merchant_money' => $merchant_pay_money);
								M('cashier_order')->update($update, array('id' => $data['id']));
								$result['uid'] = $suid;
								$result['type'] = 2;
								$result['money'] = $money;
								$result['app_money'] = $app_pay_money;
								$result['merchant_money'] = $merchant_pay_money;
								$result['time'] = $_SERVER['REQUEST_TIME'];
								$result['desc'] = '余额消费';
								$result['name'] = $merchant_name['name'];
								$result['order_id']='xf'.time().mt_rand(100, 1000);
								$result['mid']=$this->thirduserid;
								$result['refund']=1;
								$result['auth_code']=$str;
								$result['now_money']=$user_merchant_money['money']-$money;
								$sqlStr = 'select distinct case when o.openid = f.openid and o.mid=f.mid then f.headimgurl else null end as headimgurl,o.*,f.nickname from ' . $this->tablepre . 'cashier_order as o left join ' . $this->tablepre . 'cashier_fans as f on o.openid=f.openid and o.mid=f.mid where o.mid=' . $this->mid . ' and o.ispay="1" order by o.paytime desc limit 5';
								$sqlObj = new model();
								$neworder = $sqlObj->selectBySql($sqlStr);
								$order_arr = array();
								foreach ($neworder as $key => $val) {
									$order_arr[] = $val;
									$order_arr[$key]['paytime'] = date('Y-m-d H:i:s', $val['paytime']);
									$order_arr[$key]['add_time'] = date('Y-m-d H:i:s', $val['add_time']);
								}
								$lastOne = $order_arr[0];
								$sqlStr2 = "SELECT SUM(goods_price)FROM " . $this->tablepre . "cashier_order as ordr where ordr.mid=" . $this->mid . " AND ordr.ispay=1 AND ordr.refund!=2";
								$allarr = $sqlObj->selectBySql($sqlStr2);//总计金额
								$allpay = $allarr[0]['SUM(goods_price)'];
								$sqlStr3 = 'SELECT SUM(goods_price)FROM ' . $this->tablepre . 'cashier_order as ordr where ordr.mid=' . $this->mid . ' AND ordr.ispay=1 AND ordr.refund!=2 AND ordr.add_time>=' . $date . ' AND ordr.paytime <=' . $now;
								$dayarr = $sqlObj->selectBySql($sqlStr3);//当天
								$daypay = $dayarr[0]['SUM(goods_price)'];
								$this->dexit(array('error' => 0, 'mid' => $this->mid, 'method' => 'appPay', 'msg' => 'OK', 'orderList' => $order_arr, 'lastOne' => $lastOne, 'allpay' => $allpay, 'daypay' => $daypay));
								//通知用户手机端扣款成功
							} elseif ($money < ($user_money + $user_merchant_money['money']) || $money == ($user_money + $user_merchant_money['money']) && $money > $user_money) {
								$sum_money = (float)$user_money + (float)$user_merchant_money['money'];
								$rest_money_arr = (float)$sum_money - (float)$money;//平台余额
								$merchant_money = 0;//对应商户余额
								$app_pay_money = (float)$user_money - (float)$rest_money_arr;//该笔订单从平台扣款数
								$merchant_pay_money = $user_merchant_money['money'];//该笔订单从对应商户余额扣款数
								M('user')->update(array('now_money' => $rest_money_arr), array('uid' => $suid));//更新user表中余额
								M('user_merchant_money')->update(array('money' => $merchant_money), array('mer_id' => $this->thirduserid, 'uid' => $suid));//更新对应商户表余额
								$update = array('paytime' => time(), 'ispay' => 1, 'state' => 1, 'truename' => $user_info['nickname'], 'openid' => $suid, 'app_money' => $app_pay_money, 'merchant_money' => $merchant_pay_money);
								M('cashier_order')->update($update, array('id' => $data['id']));
								$result['uid'] = $suid;
								$result['type'] = 2;
								$result['money'] = $money;
								$result['app_money'] = $app_pay_money;
								$result['merchant_money'] = $merchant_pay_money;
								$result['time'] = $_SERVER['REQUEST_TIME'];
								$result['desc'] = '余额消费';
								$result['name'] = $merchant_name['name'];
								$result['order_id']='xf'.time().mt_rand(100, 1000);
								$result['mid']=$this->thirduserid;
								$result['refund']=1;
								$result['auth_code']=$str;
								$result['now_money']=$user_merchant_money['money']-$money;
								M('user_money_list')->insert($result, true);
								$sqlStr = 'select distinct case when o.openid = f.openid and o.mid=f.mid then f.headimgurl else null end as headimgurl,o.*,f.nickname from ' . $this->tablepre . 'cashier_order as o left join ' . $this->tablepre . 'cashier_fans as f on o.openid=f.openid and o.mid=f.mid where o.mid=' . $this->mid . ' and o.ispay="1" order by o.paytime desc limit 5';
								$sqlObj = new model();
								$neworder = $sqlObj->selectBySql($sqlStr);
								$order_arr = array();
								foreach ($neworder as $key => $val) {
									$order_arr[] = $val;
									$order_arr[$key]['paytime'] = date('Y-m-d H:i:s', $val['paytime']);
									$order_arr[$key]['add_time'] = date('Y-m-d H:i:s', $val['add_time']);
								}
								$lastOne = $order_arr[0];
								$sqlStr2 = "SELECT SUM(goods_price)FROM " . $this->tablepre . "cashier_order as ordr where ordr.mid=" . $this->mid . " AND ordr.ispay=1 AND ordr.refund!=2";
								$allarr = $sqlObj->selectBySql($sqlStr2);//总计金额
								$allpay = $allarr[0]['SUM(goods_price)'];
								$sqlStr3 = 'SELECT SUM(goods_price)FROM ' . $this->tablepre . 'cashier_order as ordr where ordr.mid=' . $this->mid . ' AND ordr.ispay=1 AND ordr.refund!=2 AND ordr.add_time>=' . $date . ' AND ordr.paytime <=' . $now;
								$dayarr = $sqlObj->selectBySql($sqlStr3);//当天
								$daypay = $dayarr[0]['SUM(goods_price)'];
								$this->dexit(array('error' => 0, 'mid' => $this->mid, 'method' => 'appPay', 'msg' => 'OK', 'orderList' => $order_arr, 'lastOne' => $lastOne, 'allpay' => $allpay, 'daypay' => $daypay));
								//通知用户手机端扣款成功
							} else {
								$this->dexit(array('error' => 1, 'mid' => $this->mid, 'msg' => '余额不足，请先充值！'));
							}
						} else {
							$this->dexit(array('error' => 1, 'mid' => $this->mid, 'msg' => '余额不足，请先充值！'));
						}
					}
				} else {//还未充值的商户
					//$this->dexit(array('error'=>1,'msg'=>'ff'));
					if (!empty($user_money)) {
						if ($money < $user_money || $money == $user_money) {
							$rest_money_arr = (float)$user_money - (float)$money;
							$app_pay_money = $money;//该笔订单从平台扣款数
							$merchant_pay_money = 0;//该笔订单从对应商户余额扣款数
							M('user')->update(array('now_money' => $rest_money_arr), array('uid' => $suid));//更新user表中余额
							$update = array('paytime' => time(), 'ispay' => 1, 'state' => 1, 'truename' => $user_info['nickname'], 'openid' => $suid, 'app_money' => $app_pay_money, 'merchant_money' => $merchant_pay_money);
							M('cashier_order')->update($update, array('id' => $data['id']));
							$result['uid'] = $suid;
							$result['type'] = 2;
							$result['money'] = $money;
							$result['app_money'] = $app_pay_money;
							$result['merchant_money'] = $merchant_pay_money;
							$result['time'] = $_SERVER['REQUEST_TIME'];
							$result['desc'] = '余额消费';
							$result['name'] = $merchant_name['name'];
							$result['order_id']='xf'.time().mt_rand(100, 1000);
							$result['mid']=$this->thirduserid;
							$result['refund']=1;
							$result['auth_code']=$str;
							$result['now_money']=$user_merchant_money['money']-$money;
							M('user_money_list')->insert($result, true);
							$sqlStr = 'select distinct case when o.openid = f.openid and o.mid=f.mid then f.headimgurl else null end as headimgurl,o.*,f.nickname from ' . $this->tablepre . 'cashier_order as o left join ' . $this->tablepre . 'cashier_fans as f on o.openid=f.openid and o.mid=f.mid where o.mid=' . $this->mid . ' and o.ispay="1" order by o.paytime desc limit 5';
							$sqlObj = new model();
							$neworder = $sqlObj->selectBySql($sqlStr);
							$order_arr = array();
							foreach ($neworder as $key => $val) {
								$order_arr[] = $val;
								$order_arr[$key]['paytime'] = date('Y-m-d H:i:s', $val['paytime']);
								$order_arr[$key]['add_time'] = date('Y-m-d H:i:s', $val['add_time']);
							}
							$lastOne = $order_arr[0];
							$sqlStr2 = "SELECT SUM(goods_price)FROM " . $this->tablepre . "cashier_order as ordr where ordr.mid=" . $this->mid . " AND ordr.ispay=1 AND ordr.refund!=2";
							$allarr = $sqlObj->selectBySql($sqlStr2);//总计金额
							$allpay = $allarr[0]['SUM(goods_price)'];
							$sqlStr3 = 'SELECT SUM(goods_price)FROM ' . $this->tablepre . 'cashier_order as ordr where ordr.mid=' . $this->mid . ' AND ordr.ispay=1 AND ordr.refund!=2 AND ordr.add_time>=' . $date . ' AND ordr.paytime <=' . $now;
							$dayarr = $sqlObj->selectBySql($sqlStr3);//当天
							$daypay = $dayarr[0]['SUM(goods_price)'];
							$this->dexit(array('error' => 0, 'mid' => $this->mid, 'method' => 'appPay', 'msg' => 'OK', 'orderList' => $order_arr, 'lastOne' => $lastOne, 'allpay' => $allpay, 'daypay' => $daypay));
							//通知用户手机端扣款成功
						} else {
							$this->dexit(array('error' => 1, 'mid' => $this->mid, 'msg' => '余额不足，请先充值！'));
						}
					} else {
						$this->dexit(array('error' => 1, 'mid' => $this->mid, 'msg' => '余额不足，请先充值！'));
					}
				}
			}
		}
	}


	/*
	 * 公众号平台二维码收款生成订单
	 * 陈琦
	 * 2016.11.9
	 */
	public  function appOrder($datas){
		$data['mid'] =$this->mid;
		$data['goods_id'] = 1;
		$data['pay_way'] = 'appPay';
		$data['pay_type'] = 'appPay';
		$data['order_id'] = date('Ymdhis') . date('Ymdhis') . mt_rand(100, 1000);
		$data['goods_type'] = 'ordinary';
		$data['goods_name'] = '在线收款';
		$data['goods_describe'] = '公众平台条码付';
		$data['goods_price'] = trim($datas['goods_price']);
		$data['add_time'] = time();
		$data['auth_code']=$datas['auth_code'];
		$insertid = M('cashier_order')->insert($data, true);
		$data['id'] = $insertid;
		return array_merge($datas, $data);
		$this->dexit(array('error' => 1, 'msg' => '订单生成失败'));
	}

	/*
	 * 获取当前生成二维码时间戳
	 */
	public function stringtime($data){
		$snian = substr($data['auth_code'],1,1);//6 6 1109 09 52 30 36 0891
		$nian = '201'.$snian;//年份：2016
		$yue = substr($data['auth_code'],2,2);//月份
		$ri = substr($data['auth_code'],4,2);//日期
		$shi = substr($data['auth_code'],6,2);//时
		$fen = substr($data['auth_code'],8,2);//分
		$miao = substr($data['auth_code'],10,2);//秒
		$stime = mktime($shi,$fen,$miao,$yue,$ri,$nian);
		return $stime;
	}
	
	/* 自动生成二维码
	* @time 2016-07-18
	* @author	小邓  <969101097@qq.com>*/
	public function ewmChange(){
		if(IS_POST){
			$where_data=array(
				'mid'=>$this->mid,	//对应商家
				'pay_way'=>'weixin',
				'pay_type'=>'wxsaoma2pay',
				//'ispay'=>0,		//未付款的		
				//'add_time'=>array('egt',time()-30*60)	//半小时之内有效
			);
			$orderinfo=M('cashier_order')->get_one($where_data,'goods_price,goods_name,mid,ispay','add_time desc');
			if($orderinfo && !$orderinfo['ispay']){	//最后一条记录且未付款
				$erweimainfo=array('price' =>$orderinfo['goods_price'],'title'=>$orderinfo['goods_name'],'mid'=>$orderinfo['mid']);
				$this->dexit(array('error'=>0,'ewminfo'=>base64_encode(json_encode($erweimainfo)),'dataprice'=>$orderinfo['goods_price']));			
			}else{
				$this->dexit(array('error'=>1,'msg'=>'暂无收款二维码生成'));
			}
		}else{
			$SiteUrl=$this->SiteUrl;		
			include $this->showTpl();
		}		
	}
	
	/* 在线收款
	* @time 2016-08-22
	* @author	小邓  <969101097@qq.com>*/
	public function onLinepay(){
		$SiteUrl = $this->SiteUrl;
		$sqlStr = 'SELECT DISTINCT ordr.id,ordr.*,cf.nickname FROM ' . $this->tablepre . 'cashier_order as ordr LEFT JOIN ' . $this->tablepre . 'cashier_fans AS cf ON ordr.openid=cf.openid where ordr.mid=' . $this->mid . ' AND cf.mid=' . $this->mid . ' AND ordr.ispay="1" ORDER BY ordr.paytime DESC,ordr.id DESC LIMIT 0,20';
		$sqlObj = new model();
		$neworder = $sqlObj->selectBySql($sqlStr);
		include $this->showTpl();
			
	}

	public function getEwm2(){
		$datas = $this->clear_html($_POST);
		$paytype = (isset($datas['paytype']) ? $datas['paytype'] : '');
		switch ($paytype) {
			case 'wxpay':
				$orderinfo = $this->add_order($datas);
				if ($orderinfo) {
					bpBase::loadAppClass('wxSaoMaPay', 'User', 0);
					$wxSaoMaPay = new wxSaoMaPay();
					$product_id = $orderinfo['mid'] . '_' . $orderinfo['orderid'];
					$ewmurl2 = $wxSaoMaPay->GetPrePayUrl($product_id);
					$erweimainfo = array('price' => $orderinfo['goods_price'], 'title' => $orderinfo['goods_name'], 'mid' => $orderinfo['mid']);
					$this->dexit(array('error' => 0, 'qrcode' => $ewmurl2, 'ewminfo' => base64_encode(json_encode($erweimainfo))));
				}else {
					$this->dexit(array('error' => 1, 'msg' => '二维码生成失败'));
				}

				break;

			case 'alipay':
				break;

			default:
				break;
		}
	}
/*2016.8.24
 * 陈琦
 * 商家收款信息实时刷新数据
 */
	public function onLinepayajax(){
		if($_POST['action']=='ajax'){
			//echo json_encode(array('error' => 0, 'msg' => '成功'));
			$sqlStr='SELECT DISTINCT ordr.id,ordr.*,cf.nickname FROM '.$this->tablepre.'cashier_order as ordr LEFT JOIN '.$this->tablepre.'cashier_fans AS cf ON ordr.openid=cf.openid where ordr.mid='.$this->mid.' AND cf.mid='.$this->mid.' AND ordr.ispay="1" ORDER BY ordr.paytime DESC,ordr.id DESC LIMIT 0,10';
			$sqlObj=new model();
			$neworder=$sqlObj->selectBySql($sqlStr);	
			$order_arr=array();
			foreach($neworder as $key=>$val){
				$order_arr[]=$val;
				$order_arr[$key]['paytime']=date('Y-m-d H:i:s',$val['paytime']);
				$order_arr[$key]['add_time']=date('Y-m-d H:i:s',$val['add_time']);
			}
			$this->dexit(array('error'=>0,'msg'=>'成功','orderList'=>$order_arr));
		}else{
			$this->dexit(array('error'=>1,'msg'=>'失败'));
		}
	}
/*2016.8.24
* 陈琦
* 优惠信息
*/
	public function coupon(){
		include $this->showTpl();
}

	/*
	 * 商户替公司或员工）充值页面
	 * 陈琦
	 * 2016.11.21
	 */
	public function up(){
		bpBase::loadOrg('common_page');

		$info=M('merchant')->get_one(array('mer_id'=>$this->thirduserid),'village_id');//查询当前商户的社区id
		$sqlObj = new model();
		$keyword=$_POST['keyword'];
		if($_POST['keyword']){
			//$count='select count(*) from '.$this->tablepre.'company where company_name like "%'.$keyword.'%" and village_id ='.$info['village_id'];//在有模糊查询条件下所查询的公司个数
			$count='select count(*)  from (SELECT a.company_id cid ,a.company_name name from '.$this->tablepre.'company as a left join '.$this->tablepre.'company_merchant_money as b on a.company_id =b.company_id where a.company_name like "%'.$keyword.'%" and a.village_id ='.$info['village_id'].')c LEFT JOIN (SELECT a.company_id id ,b.money money from '.$this->tablepre.'company as a LEFT JOIN '. $this->tablepre.'company_merchant_money as b on a.company_id = b.company_id where a.company_name like "%'.$keyword.'%" and a.village_id ='.$info['village_id'].' and b.mer_id = '.$this->thirduserid.')d on c.cid = d.id';
			$result = $sqlObj->selectBySql($count);
			$p = new Page($result[0]["count(*)"], 10);
			$pagebar = $p->show(2);
			$sqlStr='select distinct c.company_id,d.money, c.name from (SELECT a.company_id company_id ,a.company_name name from '.$this->tablepre.'company as a left join '.$this->tablepre.'company_merchant_money as b on a.company_id =b.company_id where a.company_name like "%'.$keyword.'%" and a.village_id ='.$info['village_id'].')c LEFT JOIN (SELECT a.company_id id ,b.money money from '.$this->tablepre.'company as a LEFT JOIN '. $this->tablepre.'company_merchant_money as b on a.company_id = b.company_id where a.company_name like "%'.$keyword.'%" and a.village_id ='.$info['village_id'].' and b.mer_id = '.$this->thirduserid.')d on c.company_id = d.id LIMIT '.$p->firstRow.',' . $p->listRows;

			$list = $sqlObj->selectBySql($sqlStr);
			$page=isset($_GET['page'])?$_GET['page']:1;
			foreach ($list as $key=>$value){
				$count_sql='select count(*) from '.$this->tablepre.'house_village_user_bind as a where a.company_id='.$value['company_id'];
				$count_arr = $sqlObj->selectBySql($count_sql);
				$count=$count_arr[0]["count(*)"];

				$count2='select distinct count(*) from '.$this->tablepre.'company as a where a.company_name like "%'.$keyword.'%" and a.village_id='.$info['village_id'];//只要满足基本条件（社区id）即算数
				$result2 = $sqlObj->selectBySql($count2);
				$arr=$result2[0]["count(*)"];
				$list[$key]['number'] = $key+1+10*($page-1);
				$list[$key]['count']=$count;
			}
		}else{
			$count='select count(*)  from (SELECT a.company_id cid ,a.company_name name from '.$this->tablepre.'company as a left join '.$this->tablepre.'company_merchant_money as b on a.company_id =b.company_id where a.village_id ='.$info['village_id'].')c LEFT JOIN (SELECT a.company_id id ,b.money money from '.$this->tablepre.'company as a LEFT JOIN '. $this->tablepre.'company_merchant_money as b on a.company_id = b.company_id where a.village_id ='.$info['village_id'].' and b.mer_id = '.$this->thirduserid.')d on c.cid = d.id';
			$result = $sqlObj->selectBySql($count);
			$p = new Page($result[0]["count(*)"], 10);
			$sqlStr='select distinct c.company_id,d.money, c.name from (SELECT a.company_id company_id ,a.company_name name from '.$this->tablepre.'company as a left join '.$this->tablepre.'company_merchant_money as b on a.company_id =b.company_id where a.village_id ='.$info['village_id'].')c LEFT JOIN (SELECT a.company_id id ,b.money money from '.$this->tablepre.'company as a LEFT JOIN '. $this->tablepre.'company_merchant_money as b on a.company_id = b.company_id where a.village_id ='.$info['village_id'].' and b.mer_id = '.$this->thirduserid.')d on c.company_id = d.id order by c.company_id desc LIMIT '.$p->firstRow.',' . $p->listRows;
			$pagebar = $p->show(2);

			$list = $sqlObj->selectBySql($sqlStr);
			$page=isset($_GET['page'])?$_GET['page']:1;
			foreach ($list as $key=>$value){
				$count_sql='select count(*) from '.$this->tablepre.'house_village_user_bind as a where a.company_id='.$value['company_id'];
				$count_arr = $sqlObj->selectBySql($count_sql);
				$count=$count_arr[0]["count(*)"];

				$count2='select distinct count(*) from '.$this->tablepre.'company as a where a.village_id='.$info['village_id'];//只要满足基本条件（社区id）即算数  公司人数
				$result2 = $sqlObj->selectBySql($count2);
				$arr=$result2[0]["count(*)"];
				$list[$key]['number'] = $key+1+10*($page-1);
				$list[$key]['count']=$count;
			}
		}
		include $this->showTpl();
	}




	/*
	 * 公司充值明细
	 * 陈琦
	 * 2016.12.8
	 */
	public function company_rechargeHistory(){
		bpBase::loadOrg('common_page');
		$sqlObj = new model();
		$page=isset($_GET['page'])?$_GET['page']:1;
		$count='select count(*) from '.$this->tablepre.'up as a  where a.mid='.$this->thirduserid. ' and a.company_id='.$_GET['company_id'].' and a.type=1';
		$result = $sqlObj->selectBySql($count);
		$record_count=$result[0]["count(*)"];
		$p = new Page($record_count, 10);
		$pagebar = $p->show(2);
		$sql='select a.* from '.$this->tablepre.'up as a where a.mid='.$this->thirduserid.' and a.company_id='.$_GET['company_id'].' and a.type=1 order by a.add_time desc LIMIT '.$p->firstRow.',' . $p->listRows;
		$arr = $sqlObj->selectBySql($sql);//充值记录
		//dump($arr);
		$company=M('company')->get_one(array('company_id'=>$_GET['company_id']),'company_name');
		foreach ($arr as $key=>$value){
			$arr[$key]['number'] = $key+1+10*($page-1);
		}
		include $this->showTpl();
	}




	/*
	 * 所有充值记录
	 * 陈琦
	 * 2016.12.5
	 */
	public function all_record(){
		bpBase::loadOrg('common_page');
		$page=isset($_GET['page'])?$_GET['page']:1;
		$sqlObj = new model();
		$count='select count(*) from '.$this->tablepre.'up as a left join '.$this->tablepre.'house_village_user_bind as b on a.uid=b.uid and a.company_id=b.company_id where a.mid='.$this->thirduserid;
		$result = $sqlObj->selectBySql($count);
		$record_count=$result[0]["count(*)"];
		$p = new Page($record_count, 10);
		$pagebar = $p->show(2);
		$sql='select a.*,b.name from '.$this->tablepre.'up as a left join '.$this->tablepre.'house_village_user_bind as b on a.uid=b.uid and a.company_id=b.company_id where a.mid='.$this->thirduserid.' order by a.add_time desc LIMIT '.$p->firstRow.',' . $p->listRows;
		$arr = $sqlObj->selectBySql($sql);//充值记录
		foreach ($arr as $key=>&$value){
			if($value['uid']==0){
				$company_name=M('company')->get_one(array('company_id'=>$value['company_id']),'company_name');
				$value['name']=$company_name['company_name'];
			}
			$arr[$key]['number'] = $key+1+10*($page-1);
		}
		unset($value);
		//dump($arr);
		include $this->showTpl();
	}




	/*
	 *员工列表
	 * 陈琦
	 * 2016.12.5
	 */
	public function user_list(){
		bpBase::loadOrg('common_page');//引入分页
		$company_id=$_GET['company_id'];
		$mid=$this->thirduserid;//传到前台要为充值记录作为传参传过去
		$count='select count(*) from (SELECT a.uid uid,a.company_id company_id, a.name name from '.$this->tablepre.'house_village_user_bind as a where a.company_id = '.$company_id.')c LEFT JOIN (SELECT a.uid id ,b.money money from '.$this->tablepre.'house_village_user_bind as a LEFT JOIN '. $this->tablepre.'user_merchant_money as b on a.uid = b.uid where a.company_id = '.$company_id.' and b.mer_id = '.$this->thirduserid.')d on c.uid = d.id';
		$sqlObj = new model();
		$count_result = $sqlObj->selectBySql($count);
		$record_count=$count_result[0]["count(*)"];
		$p = new Page($record_count, 10);
		$pagebar = $p->show(2);
		$r='select distinct c.uid,d.money, c.name,c.company_id,c.group_name,c.phone,c.nickname,c.card_type,c.usernum,c.add_time from (SELECT a.uid uid,a.company_id company_id, a.name name,a.phone phone,a.card_type card_type,a.usernum usernum,a.add_time add_time,u.nickname nickname, b.group_name group_name from '.$this->tablepre.'house_village_user_bind as a left join '.$this->tablepre.'user as u on a.uid=u.uid left join '.$this->tablepre.'user_group as b on a.group_id =b.group_id where a.company_id = '.$company_id.')c LEFT JOIN (SELECT a.uid id ,b.money money from '.$this->tablepre.'house_village_user_bind as a LEFT JOIN '. $this->tablepre.'user_merchant_money as b on a.uid = b.uid where a.company_id = '.$company_id.' and b.mer_id = '.$this->thirduserid.')d on c.uid = d.id order by c.add_time desc LIMIT '.$p->firstRow.',' . $p->listRows;
		$user_list = $sqlObj->selectBySql($r);//员工列表
		$company_info=M('company')->get_one(array('company_id'=>$company_id),'company_name');//前台显示公司名称
		$page=isset($_GET['page'])?$_GET['page']:1;
		foreach ($user_list as $key=>&$value){
			$user_list[$key]['number'] = $key+1+10*($page-1);//编号
			$user_info=M('user')->get_one(array('uid'=>$value['uid']),'now_money');
			if($value['money']===NULL){
				$value['money']=floatval(0);
			}
			$value['money']=$value['money']+$user_info['now_money'];
		}
		unset($value);
		//dump($user_list);
		include $this->showTpl();
	}




	/*
	 * 员工充值页面
	 * 陈琦
	 * 2016.12.5
	 */
	public function user_recharge(){
		$company_id=$_GET['company_id'];
		$uid=$_GET['uid'];
		if($uid){
			$user_name=M('house_village_user_bind')->get_one(array('uid'=>$uid),'name');
		}
		$company_info=M('company')->get_one(array('company_id'=>$company_id),'company_name');//前台显示公司名称
		include $this->showTpl();
	}




	/*
	 * 员工充值
	 * 陈琦
	 * 2016.12.5
	 */
	public function user_recharge_submit(){
		$merchant_info=M('cashier_merchants')->get_one(array('thirduserid'=>$this->thirduserid),'wxname');
		$merchantOb = M('user_merchant_money');
		$money = $_POST['money'];
		$money=floatval($money);
		if($money<0 || $money==0){
			//$this->errorTip("请输入正确金额！");
			$this->dexit(array('error'=>1,'msg'=>'请输入正确金额！'));
		}
		$uid = $_POST['uid'];
		$data=array(
			'uid'=>$uid,
			'mid'=>$this->thirduserid,
			'money'=>$money,
			'company_id'=>$_POST['company_id'],
			'type'=>2,
			'add_time'=>time(),
			'recharge_name'=>$merchant_info['wxname'],
			'cz_id'=>'cz'.time().mt_rand(100, 1000),
		);

		$company_money=M('company_merchant_money')->get_one(array('company_id'=>$_POST['company_id'],'mer_id'=>$this->thirduserid),'money');//公司在当前商户的余额
		if($money>$company_money['money']){
			//$this->errorTip("余额不足！");
			$this->dexit(array('error'=>1,'msg'=>'余额不足！'));
		}
		$a=$merchantOb->get_one(array('uid'=>$uid,'mer_id'=>$this->thirduserid),'money');
		if($a){//用户在当前商户充过钱
			$merchantOb->update(array('money'=>$a['money']+$money),array('uid'=>$uid,'mer_id'=>$this->thirduserid));
		}else{//用户未在当前商户充过钱
			$res=array(
				'uid'=>$uid,
				'mer_id'=>$this->thirduserid,
				'money'=>$money,
			);
			$merchantOb->insert($res,true);
		}
		$recharge=array(
			'uid'=>$uid,
			'type'=>1,
			'money'=>$money,
			'app_money'=>0,
			'merchant_money'=>$money,
			'time'=>$_SERVER['REQUEST_TIME'],
			'desc'=>'商户充值',
			'name'=>$merchant_info['wxname'],
			'order_id'=>'cz'.time().mt_rand(100, 1000),
			'mid'=>$this->thirduserid,
			'refund'=>1,
			'now_money'=>$a['money']+$money,
		);
		M('user_money_list')->insert($recharge,true);
		$result=M('up')->insert($data,true);//充值成功后进充值记录表
		M('company_merchant_money')->update(array('money'=>($company_money['money']-$money)),array('company_id'=>$_POST['company_id'],'mer_id'=>$this->thirduserid));
		if($result){
//			$this->successTip('充值成功！','./merchants.php?m=User&c=cashier&a=user_list&company_id='.$_POST['company_id']);
//			exit;
			$this->dexit(array('error'=>0,'msg'=>'充值成功！'));
		}
	}




	/*
	 * 员工编辑
	 * 陈琦
	 * 2016.12.5
	 */
	public function user_edit(){
		$company_id=$_GET['company_id'];
		$uid=$_GET['uid'];
		$sql='select a.* from '.$this->tablepre.'user_group as a where a.company_id='.$company_id;
		$sqlObj = new model();
		$group = $sqlObj->selectBySql($sql);
		$sql='select b.* from '.$this->tablepre.'house_village_user_bind as b where b.uid='.$uid;
		$res=$sqlObj->selectBySql($sql);//二维数组
		$user=$res[0];
		$user_name=M('house_village_user_bind')->get_one(array('uid'=>$uid),'name');
		$company_info=M('company')->get_one(array('company_id'=>$company_id),'company_name');//前台显示公司名称
		include $this->showTpl();
	}



	/*
     * 员工编辑表单提交
     * 陈琦
     * 2016.12.5
     */
	public function ue_submit(){
		$company_id=$_POST['company_id'];
		$group_id=$_POST['group_id'];
		$name=$_POST['name'];
		$phone=$_POST['phone'];
		if(empty($name)){
			$this->errorTip('姓名不能为空！');
		}
		if(empty($phone)){
			$this->errorTip('联系电话不能为空！');
		}
		if(empty(preg_match("/^1[34578]{1}\d{9}$/",$_POST['phone']))){
			$this->errorTip('联系电话格式有误！');
		}
		if($group_id){
			$result=M('house_village_user_bind')->update(array('group_id'=>$group_id,'name'=>$name,'phone'=>$phone),array('company_id'=>$company_id,'uid'=>$_POST['uid']));
			if($result){
				$this->successTip('编辑成功！','./merchants.php?m=User&c=cashier&a=user_list&company_id='.$_POST['company_id']);
				exit;
			}
		}
	}



	/*
	 * 公司充值页面
	 * 陈琦
	 * 2016.12.5
	 */
	public function company_recharge(){
		$company_id=$_GET['company_id'];
		if($company_id){
			$company_name=M('company')->get_one(array('company_id'=>$company_id),'company_name');
		}
		include $this->showTpl();
	}




	/*
	 * 公司充值提交表单
	 * 陈琦
	 * 2016.12.5
	 */
	public function company_recharge_submit(){
		$merchant_info=M('cashier_merchants')->get_one(array('thirduserid'=>$this->thirduserid),'wxname');
		$company_id=$_POST['company_id'];
		$money=$_POST['money'];
		if($money<0 || $money==0){
			//$this->errorTip("请输入正确金额！");
			$this->dexit(array('error'=>1,'msg'=>'请输入正确金额！'));
		}
		$fore_money=M('company_merchant_money')->get_one(array('company_id'=>$company_id,'mer_id'=>$this->thirduserid),'money');//公司原来的金额
		if($fore_money){//公司在当前商户充过钱
			$left_money=$fore_money['money']+$money;
			$result=M('company_merchant_money')->update(array('money'=>($fore_money['money']+$money)),array('company_id'=>$company_id,'mer_id'=>$this->thirduserid));//更新
		}else{//公司未在当前商户充过钱
			$result=M('company_merchant_money')->insert(array('company_id'=>$company_id,'money'=>$money,'mer_id'=>$this->thirduserid),true);//新增
			$left_money=$money;
		}
		$data=array(
			'uid'=>0,
			'mid'=>$this->thirduserid,
			'money'=>$money,
			'company_id'=>$_POST['company_id'],
			'type'=>1,
			'add_time'=>time(),
			'recharge_name'=>$merchant_info['wxname'],
			'cz_id'=>'cz'.time().mt_rand(100, 1000),
			//'left_money'=>$left_money
		);
		if($result){
			M('up')->insert($data,true);
			$this->dexit(array('error'=>0,'msg'=>'充值成功！'));
		}
	}




	/*
	 * 公司各自的充值记录
	 * 陈琦
	 * 2016.12.5
	 */
	public function record(){
		bpBase::loadOrg('common_page');//引入分页
		$sqlObj = new model();
		$page=isset($_GET['page'])?$_GET['page']:1;
		$company_id=$_GET['company_id'];
		$count='select count(*) from '.$this->tablepre.'up as a left join '.$this->tablepre.'house_village_user_bind as b on a.uid=b.uid and a.company_id=b.company_id where a.mid='.$this->thirduserid.' and a.company_id='.$company_id;
		$result = $sqlObj->selectBySql($count);//记录条数
		$record_count=$result[0]["count(*)"];
		$p = new Page($record_count, 10);
		$pagebar = $p->show(2);
		$sql='select a.*,b.name from '.$this->tablepre.'up as a left join '.$this->tablepre.'house_village_user_bind as b on a.uid=b.uid and a.company_id=b.company_id where a.mid='.$this->thirduserid.' and a.company_id='.$company_id.' order by a.add_time desc LIMIT '.$p->firstRow.',' . $p->listRows;
		$arr = $sqlObj->selectBySql($sql);//充值记录
		foreach ($arr as $key=>&$value){
			if($value['uid']==0){
				$company_name=M('company')->get_one(array('company_id'=>$value['company_id']),'company_name');
				$value['name']=$company_name['company_name'];
			}
			$arr[$key]['number'] = $key+1+10*($page-1);
		}
		unset($value);
		$company_info=M('company')->get_one(array('company_id'=>$company_id),'company_name');//前台显示公司名称
		include $this->showTpl();
	}




	/*
	 * 分组管理
	 * 陈琦
	 * 2016.12.5
	 */
	public function group(){
		bpBase::loadOrg('common_page');//引入分页
		$page=isset($_GET['page'])?$_GET['page']:1;
		$company_id=$_GET['company_id'];
		$page_count='select count(*) from '.$this->tablepre.'user_group as a where a.company_id='.$company_id;
		$sqlObj = new model();
		$count_result = $sqlObj->selectBySql($page_count);
		$record_count=$count_result[0]["count(*)"];
		$p = new Page($record_count, 10);
		$pagebar = $p->show(2);//分组管理
		$sql='select a.* from '.$this->tablepre.'user_group as a where a.company_id='.$company_id.' order by a.group_id desc LIMIT '.$p->firstRow.',' . $p->listRows;
		$arr = $sqlObj->selectBySql($sql);//分组列表
		foreach ($arr as $key=>$value){//查询组内成员人数
			$count_sql='select count(*) from '.$this->tablepre.'house_village_user_bind as a where a.company_id='.$company_id .' and a.group_id='.$value['group_id'];
			$count_arr = $sqlObj->selectBySql($count_sql);
			$count=$count_arr[0]["count(*)"];
			$arr[$key]['count']=$count;
			$arr[$key]['number'] = $key+1+10*($page-1);
		}
		$company_info=M('company')->get_one(array('company_id'=>$company_id),'company_name');//前台显示公司名称
		include $this->showTpl();
	}



	/*
	 * 添加分组/页面
	 * 陈琦
	 * 2016.12.5
	 */
	public function add_group(){
		$company_id=$_GET['company_id'];
		$company_info=M('company')->get_one(array('company_id'=>$company_id),'company_name');//前台显示公司名称
		include $this->showTpl();
	}



	/*
	 * 添加分组/表单提交
	 * 陈琦
	 * 2016.12.5
	 */
	public function ag_submit(){
		$group_name=$_POST['group_name'];
		if($group_name){
			$desc=$_POST['desc'];
			$company_id=$_POST['company_id'];
			$all=M('user_group')->get_all('*',$this->tablepre.user_group,array('company_id'=>$company_id));
			foreach ($all as $key=>$value){
				if($value['group_name']==$group_name){
					$this->errorTip('已存在该组名！','./merchants.php?m=User&c=cashier&a=group&company_id='.$company_id);
				}
			}
			$result=M('user_group')->insert(array('group_name'=>$group_name,'desc'=>$desc,'company_id'=>$company_id),true);
			if($result){
				$this->successTip('添加成功！','./merchants.php?m=User&c=cashier&a=group&company_id='.$company_id);
				exit;
			}
		}else{
			$this->errorTip('请填写组名！');
		}

	}




	/*
	 * 分组充值/页面
	 * 陈琦
	 * 2016.12.5
	 */
	public function group_recharge(){
		$company_id=$_GET['company_id'];
		$group_id=$_GET['group_id'];
		$result=M('user_group')->get_one(array('group_id'=>$group_id),'*');
		$company_info=M('company')->get_one(array('company_id'=>$company_id),'company_name');//前台显示公司名称
		include $this->showTpl();
	}



	/*
     * 分组充值/表单提交
     * 陈琦
     * 2016.12.5
     */
	public function gr_submit(){
		$merchant_info=M('cashier_merchants')->get_one(array('thirduserid'=>$this->thirduserid),'wxname');
		$money = $_POST['money'];
		if($money<0 || $money==0){
			//$this->errorTip("请输入正确金额！");
			$this->dexit(array('error'=>1,'msg'=>'请输入正确金额！'));
		}
		$group_id = $_POST['group_id'];
		$mid=$this->thirduserid;
		$company_id=$_POST['company_id'];
		$sqlObj = new model();
		$result=M('house_village_user_bind')->get_all('*',$this->tablepre.house_village_user_bind,array('group_id'=>$group_id,'company_id'=>$company_id));//当前组名的所有用户
		$re=M('user_merchant_money')->get_all('uid',$this->tablepre.user_merchant_money,array('mer_id'=>$mid));//查询当前商户下存在的所有uid
		$all_uid=array();//存所有uid的一位数组
		foreach ($re as $key=>$value){
			$all_uid[]=$value['uid'];
		}
		$count_sql='select count(*) from '.$this->tablepre.'house_village_user_bind as a where a.group_id='.$group_id;
		$count_arr = $sqlObj->selectBySql($count_sql);
		$count=$count_arr[0]["count(*)"];//查询组内成员人数
		if($result){//当前组内有成员
			$company_money=M('company_merchant_money')->get_one(array('company_id'=>$company_id,'mer_id'=>$mid),'money');//公司在当前商户余额
			$row_money=$count*$money;//改组总共充值金额
			if($row_money>$company_money['money']){
				//$this->errorTip("余额不足！");
				$this->dexit(array('error'=>1,'msg'=>'余额不足！'));
			}
			foreach ($result as $key=>$value){
				$data=array(
					'uid'=>$value['uid'],
					'mid'=>$mid,
					'money'=>$money,
					'company_id'=>$company_id,
					'type'=>2,
					'add_time'=>time(),
					'recharge_name'=>$merchant_info['wxname'],
					'cz_id'=>'cz'.time().mt_rand(100, 1000),
				);

				$company_money=M('company_merchant_money')->get_one(array('company_id'=>$company_id,'mer_id'=>$mid),'money');//公司在当前商户余额
				$a=M('user_merchant_money')->get_one(array('uid'=>$value['uid'],'mer_id'=>$mid),'money');
				if(in_array($value['uid'],$all_uid)){
					$succcess=M('user_merchant_money')->update(array('money'=>$a['money']+$money),array('uid'=>$value['uid'],'mer_id'=>$mid));//更新
				}else{
					$succcess=M('user_merchant_money')->insert(array('money'=>$money,'uid'=>$value['uid'],'mer_id'=>$mid),true);//添加
				}
				$recharge=array(
					'uid'=>$value['uid'],
					'type'=>1,
					'money'=>$money,
					'app_money'=>0,
					'merchant_money'=>$money,
					'time'=>$_SERVER['REQUEST_TIME'],
					'desc'=>'商户充值',
					'name'=>$merchant_info['wxname'],
					'order_id'=>'cz'.time().mt_rand(100, 1000),
					'mid'=>$mid,
					'refund'=>1,
					'now_money'=>$a['money']+$money,
				);
				M('user_money_list')->insert($recharge,true);
				M('company_merchant_money')->update(array('money'=>($company_money['money']-$money)),array('company_id'=>$company_id,'mer_id'=>$mid));
				M('up')->insert($data,true);//循环的时候每次时间不一样
			}
			if($succcess){
				//$this->successTip('批量充值成功！','./merchants.php?m=User&c=cashier&a=group&company_id='.$company_id);
				$this->dexit(array('error'=>0,'msg'=>'批量充值成功！'));
			}
		}else{
			//$this->errorTip('请先添加组员！','./merchants.php?m=User&c=cashier&a=group&company_id='.$company_id);
			$this->dexit(array('error'=>1,'msg'=>'请先添加组员！'));
		}
	}



	/*
     * 分组编辑/页面
     * 陈琦
     * 2016.12.5
     */
	public function group_edit(){
		$company_id=$_GET['company_id'];
		$group_id=$_GET['group_id'];
		$result=M('user_group')->get_one(array('group_id'=>$group_id),'*');
		$company_info=M('company')->get_one(array('company_id'=>$company_id),'company_name');//前台显示公司名称
		include $this->showTpl();
	}



	/*
    * 分组编辑/表单提交
    * 陈琦
    * 2016.12.5
    */
	public function ge_submit(){
		$company_id=$_POST['company_id'];
		$group_id=$_POST['group_id'];//当前组id
		$group_name=$_POST['group_name'];
		if(empty($group_name)){
			$this->errorTip('组名不能为空！');
		}
		$desc=$_POST['desc'];
		$sql='select a.* from '.$this->tablepre.'user_group as a where a.company_id='.$company_id.' and a.group_id !='.$group_id;//除了当前组，其他组名
		$sqlObj = new model();
		$all = $sqlObj->selectBySql($sql);
		foreach ($all as $key=>$value){
			if($value['group_name']==$group_name){
				$this->errorTip('已存在该组名！','./merchants.php?m=User&c=cashier&a=group&company_id='.$company_id);
			}
		}
		$result=M('user_group')->update(array('group_name'=>$group_name,'desc'=>$desc),array('group_id'=>$group_id));
		if($result){
			$this->successTip('编辑成功！','./merchants.php?m=User&c=cashier&a=group&company_id='.$company_id);
			exit;
		}
	}




	public function group_del(){
		$group_id=$_GET['group_id'];
		$company_id=$_GET['company_id'];
		$arr=M('house_village_user_bind')->get_all('uid',$this->tablepre.house_village_user_bind,array('group_id'=>$_GET['group_id']));
		if($arr){
			$this->errorTip('该组尚有成员！','./merchants.php?m=User&c=cashier&a=group&company_id='.$company_id);
		}else{
			$del=M('user_group')->delete('group_id='.$group_id);
			if($del){
				$this->successTip('删除成功！','./merchants.php?m=User&c=cashier&a=group&company_id='.$company_id);
			}
		}
	}



	/*
     * 成员管理
     * 陈琦
     * 2016.12.5
     */
	public function user_manage(){
		bpBase::loadOrg('common_page');//引入分页
		$group_id=$_GET['group_id'];
		$company_id=$_GET['company_id'];
		$sql='select b.* from '.$this->tablepre.'user_group as b where b.company_id='.$company_id.' and b.group_id !='.$group_id;//该公司组名
		$sqlObj = new model();
		$count='select count(*) from '.$this->tablepre.'house_village_user_bind as c where c.group_id='.$group_id;
		$count_result = $sqlObj->selectBySql($count);
		$p = new Page($count_result[0]["count(*)"], 10);
		$pagebar = $p->show(2);
		$sql2='select a.* from '.$this->tablepre.'house_village_user_bind as a where a.company_id='.$company_id.' and a.group_id='.$group_id.' LIMIT '.$p->firstRow.',' . $p->listRows;//该组人名
		$user = $sqlObj->selectBySql($sql2);//该组人名
		$group = $sqlObj->selectBySql($sql);//该公司组名
		$this_group=M('user_group')->get_one(array('group_id'=>$group_id),'group_name');//当前组名
		$company_info=M('company')->get_one(array('company_id'=>$company_id),'company_name');//前台显示公司名称
		include $this->showTpl();
	}



	/*
     * 添加组员
     * 陈琦
     * 2016.12.5
     */
	public function add_user(){
		bpBase::loadOrg('common_page');//引入分页
		$sqlObj = new model();
		$company_id = $_GET['company_id'];
		$group_id = $_GET['group_id'];
		$count='select count(*) from ' . $this->tablepre . 'house_village_user_bind as a where a.company_id=' . $company_id . ' and a.group_id =0';
		$count_result = $sqlObj->selectBySql($count);
		$p = new Page($count_result[0]["count(*)"], 10);
		$pagebar = $p->show(2);
		$sql = 'select a.* from ' . $this->tablepre . 'house_village_user_bind as a where a.company_id=' . $company_id . ' and a.group_id =0 LIMIT '.$p->firstRow.',' . $p->listRows;
		$user = $sqlObj->selectBySql($sql);//用户名
		$result=M('user_group')->get_one(array('group_id'=>$group_id),'group_name');
		$group_name=$result['group_name'];
		$company_info=M('company')->get_one(array('company_id'=>$company_id),'company_name');//前台显示公司名称
		include $this->showTpl();
	}




	/*
     * 添加组员提交表单
     * 陈琦
     * 2016.12.5
     */
	public function au_submit(){
		$arr=$_POST['checkbox2'];
		//dump($arr);exit;
		if($arr){
			$group_id=$_POST['group_id'];
			$company_id=$_POST['company_id'];
			//dump($val);
			foreach ($arr as $key=>$val){
				$update=M('house_village_user_bind')->update(array('group_id'=>$group_id),array('uid'=>$val,'company_id'=>$company_id));
			}
			if($update){
				$this->successTip('添加成功！','./merchants.php?m=User&c=cashier&a=user_manage&company_id='.$company_id.'&group_id='.$group_id);
				exit;
			}
		}else{
			$this->errorTip('请选择成员！');
			exit;
		}
	}



	/*
     * 移动组员至别的组
     * 陈琦
     * 2016.12.5
     */
	public function move_user(){
		$arr=$_POST['checkbox2'];
		$group_id=$_POST['group_id'];//移动后组id
		$company_id=$_POST['company_id'];
		$this_group_id=$_POST['this_group_id'];//当前组id
		if(!empty($arr) && empty($group_id)){
			$this->errorTip('请选择操作！');
		}
		if(empty($arr) && !empty($group_id)){
			$this->errorTip('请选择人员！');
		}
		if(empty($arr) && empty($group_id)){
			$this->errorTip('请选择操作！');
		}
		if(!empty($arr) && !empty($group_id)){
			$group_name=M('user_group')->get_one(array('group_id'=>$group_id),'group_name');
			foreach($arr as $key=>$value){
				$update=M('house_village_user_bind')->update(array('group_id'=>$group_id),array('uid'=>$value));
			}
			if($update){
				$this->successTip('成功移至'.$group_name['group_name'].'!','./merchants.php?m=User&c=cashier&a=user_manage&company_id='.$company_id.'&group_id='.$this_group_id);
				exit;
			}
		}
	}



	/*
     * 剔除组员
     * 陈琦
     * 2016.11.30
     */
	public function user_del(){
		$uid=$_GET['uid'];
		$company_id=$_GET['company_id'];
		$group_id=$_GET['group_id'];
		$del=M('house_village_user_bind')->update(array('group_id'=>0),array('uid'=>$uid,'company_id'=>$company_id));
		if($del){
			$this->successTip('移除成功！','./merchants.php?m=User&c=cashier&a=user_manage&company_id='.$company_id.'&group_id='.$group_id);
		}
	}



	/*
     * 批量剔除组员
     * 陈琦
     * 2016.12.5
     */
	public function all_del(){
		if(IS_POST){
			$arr=$_POST['uid_arr'];
			$group_id=$_POST['group_id'];
			$company_id=$_POST['company_id'];
			foreach ($arr as $key=>$value){
				$update=M('house_village_user_bind')->update(array('group_id'=>0),array('uid'=>$value,'company_id'=>$company_id));
			}
			if($update){
				$sql2='select a.* from '.$this->tablepre.'house_village_user_bind as a where a.group_id='.$group_id;//该组人名
				$sqlObj = new model();
				$user = $sqlObj->selectBySql($sql2);//该组人名
				$list='<table width="50%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px; margin-bottom:20px;" class="table_list">';
				$list.='<thead><tr><td class="td_checkbox"><input type="checkbox" class="td_checkbox"  name="checkbox" value="checkbox" onclick="checkAll(this)" /></td>';
				$list.='<td class="td_left" width="5%" style="font-size:14px; font-weight:bold; color:#000000;">用户名</td>';
				$list.='<td class="td_left" width="5%" style="font-size:14px; font-weight:bold; color:#000000;">联系电话</td>';
				$list.='<td class="td_left" width="5%" style="font-size:14px; font-weight:bold; color:#000000;">证件类型</td>';
				$list.='<td class="td_left" width="5%" style="font-size:14px; font-weight:bold; color:#000000;">证件号</td>';
				$list.='<td class="td_left" width="5%" style="font-size:14px; font-weight:bold; color:#000000;">注册时间</td>';
				$list.='<td class="td_left" width="5%" style="font-size:14px; font-weight:bold; color:#000000;text-align:center;">操作</td></tr></thead>';
				if($user){
					foreach ($user as $key=>$value){
						if($value['card_type']==1){
							$card_name='现场审核';
						}elseif ($value['card_type']==2){
							$card_name='门禁卡';
						}elseif ($value['card_type']==3){
							$card_name='身份证';
						}elseif ($value['card_type']==4){
							$card_name='工作牌';
						}
						$url='./merchants.php?m=User&c=cashier&a=user_del&company_id='.$company_id.'&group_id='.$group_id.'&uid='.$value['uid'];
						$list.='<tr><td class="td_checkbox2"><input type="checkbox"  name="checkbox2[]" value="'.$value['uid'].'"/></td>';
						$list.='<td class="td_left" width="5%">'.$value['name'].'</td>';
						$list.='<td class="td_left" width="5%">'.$value['phone'].'</td>';
						$list.='<td class="td_left" width="5%">'.$card_name.'</td>';
						$list.='<td class="td_left" width="5%">'.$value['usernum'].'</td>';
						$list.='<td class="td_left" width="5%">'.date('Y-m-d H:i:s',$value['add_time']).'</td>';
						$list.='<td class="td_left" width="5%"><a href="'.$url.'"><div class="ff2">删除</div></a></td></tr>';
					}
				}else{
					$list.='<tr><td colspan="10">暂无记录</td></tr>';
				}
				$list.='</tbody></table>';

				$this->dexit(array('msg_code'=>0,'msg_data'=>$list));
			}else{
				$this->dexit(array('msg_code'=>1,'msg_data'=>'改变失败！'));
			}
		}
	}
	
}

?>
