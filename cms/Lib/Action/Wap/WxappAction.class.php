<?php
/* ================================ */
/* O2O对接CMS核心文件 ticket        */
/* Author:          Lee 	        */
/* Copyright:	    www.inxcms.com  */
/* Create Date:	    2015-10-30	    */
/* Retrofit Date:   2015-12-20      */
/* Abouts：         QQ884511959     */
/* ================================ */
class WxappAction extends BaseAction{
	public $apiUrl;
	public $selectUrl;
	public $insertUrl;
	public $oauth2Url;
	public $orderUrl;
	public $SALT;
	public $synType;
	public $_accessListAction;
	public $mer_id;
	public $token;
	protected function _initialize(){
		parent::_initialize();
		$this->apiUrl  = $this->config['wxapp_url'];
		if(empty($this->apiUrl)){
			$this->error_tips('请联系管理员在后台配置营销功能');
		}
		$this->selectUrl = $this->apiUrl.'/index.php?g=Home&m=Auth&a=select';
		$this->insertUrl = $this->apiUrl.'/index.php?g=Home&m=Auth&a=insert';
		$this->oauth2Url = $this->apiUrl.'/index.php?g=Home&m=Auth&a=oauth2';
		$this->orderUrl = $this->apiUrl.'/index.php?g=Home&m=Auth&a=order';
		$this->SALT 	= $this->config['wxapp_encrypt'] ? $this->config['wxapp_encrypt'] : 'pigcms';
		$this->synType 	= 'o2o';
		$this->_accessListAction = array(
			'bargain'       => '砍价', 
			'seckill'       =>'秒杀', 
			'crowdfunding'  =>'众筹',
			'unitary'       =>'一元夺宝',
			'cutprice'      =>'降价拍',
			'lottery'		=>'大转盘',
			'red_packet'	=>'微信红包',
			'guajiang'		=>'刮刮卡',
			'jiugong'		=>'九宫格',
			'luckyFruit'	=>'幸运水果机',
			'goldenEgg'		=>'砸金蛋',
			'voteimg'		=>'图文投票',
			'custom'		=>'万能表单',
			'card'			=>'微贺卡',
			'game'			=>'微游戏',
			'live'			=>'微场景',
			'research'		=>'微调研',
			'forum'			=>'讨论社区',
			'autumn'		=>'中秋吃月饼活动',
			'helping'		=>'微助力',
		);
		$this->_accessListModel = array(
			'bargain'       => array('name'=>'Bargain','condition'=>array(),'autoid'=>'pigcms_id'), 
			'seckill'       => array('name'=>'SeckillAction','condition'=>array(),'autoid'=>'action_id'), 
			'crowdfunding'  => array('name'=>'Crowdfunding','condition'=>array()),
			'unitary'       => array('name'=>'Unitary','condition'=>array()),
			'cutprice'      => array('name'=>'Cutprice','condition'=>array(),'autoid'=>'pigcms_id'),
			'lottery'		=> array('name'=>'Lottery','condition'=>array('type'=>1)),
			'red_packet'	=> array('name'=>'RedPacket','condition'=>array()),
			'guajiang'		=> array('name'=>'Lottery','condition'=>array('type'=>2)),
			'jiugong'		=> array('name'=>'Lottery','condition'=>array('type'=>10)),
			'luckyFruit'	=> array('name'=>'Lottery','condition'=>array('type'=>4)),
			'goldenEgg'		=> array('name'=>'Lottery','condition'=>array('type'=>5)),
			'voteimg'		=> array('name'=>'Voteimg','condition'=>array()),
			'custom'		=> array('name'=>'CustomSet','condition'=>array()),
			'card'			=> array('name'=>'Cards','condition'=>array()),
			'game'			=> array('name'=>'Games','condition'=>array()),
			'live'			=> array('name'=>'Live','condition'=>array()),
			'research'		=> array('name'=>'Research','condition'=>array()),
			'forum'			=> array('name'=>'ForumConfig','condition'=>array()),
			'autumn'		=> array('name'=>'Lottery','condition'=>array()),
			'helping'		=> array('name'=>'Helping','condition'=>array()),
		);
	}
	public function qrcode(){
		if(empty($_SESSION['merchant'])){
			redirect($this->config['site_url'].'/static/qrcode/wxapp/not_login.jpg');
		}
		$this->mer_id = $_SESSION['merchant']['mer_id'];
		$this->token = $this->getToken($this->mer_id);
		
		$modle  = lcfirst($_GET['modle']);
		$id 	= $_GET['id'];
		// echo $modle;
		// dump($this->_accessListAction);exit;
		if(empty($this->_accessListAction[$modle])){
			redirect($this->config['site_url'].'/static/qrcode/wxapp/not_found.jpg');
		}else{
			/*查询本地数据库*/
			$wxappCon = D('Wxapp_list')->field('`pigcms_id`')->where(array('mer_id'=>$_SESSION['merchant']['mer_id'],'type'=>$modle,'id'=>$id))->find();
			if(empty($wxappCon)){
				$post_data 	= array(
					'token' 	=> $this->token,
					'model' 	=> $this->_accessListModel[$modle]['name'],
					'debug'		=> true,
					'option' 	=> array(
						'where' => $this->_accessListModel[$modle]['condition'],
					),
				);
				if($this->_accessListModel[$modle]['autoid']){
					$post_data['option']['where'][$this->_accessListModel[$modle]['autoid']] = $id;
				}else if($modle == 'forum'){
					$post_data['option']['where']['token'] = $this->token;
				}else if($modle != 'forum'){
					$post_data['option']['where']['id'] = $id;
				}
				
				if(empty($post_data['option']['where'])){
					unset($post_data['option']);
				}
				$post_data['sign'] 	= $this->getSign($post_data);
				$result = $this->curl_post($this->selectUrl,$post_data);
				$resultArr = json_decode($result,true);
				// dump($post_data);
				// dump($resultArr);exit;
				if($resultArr['status'] != 0 || $resultArr['message'] != 'success'){
					redirect($this->config['site_url'].'/static/qrcode/wxapp/not_found.jpg');
				}else{
					$wxappInfo = $this->getWxappInfo($modle,$resultArr['data']);
					$wxappInfo = $wxappInfo[0];
					// dump($wxappInfo);exit;
					$pigcms_id = D('Wxapp_list')->data(array('mer_id'=>$this->mer_id,'type'=>$modle,'id'=>$wxappInfo['modelId'],'title'=>$wxappInfo['title'],'info'=>$wxappInfo['info'],'image'=>$wxappInfo['image'],'time'=>$wxappInfo['time'],'add_time'=>$_SERVER['REQUEST_TIME'],'status'=>'1'))->add();
					// dump(D('Wxapp_list'));exit;
					if(empty($pigcms_id)){
						redirect($this->config['site_url'].'/static/qrcode/wxapp/not_found.jpg');
					}
				}
			}else{
				$pigcms_id = $wxappCon['pigcms_id'];
			}
			redirect($this->config['site_url'].'/index.php?c=Recognition&a=get_tmp_qrcode&qrcode_id='.(4100000000+$pigcms_id));
			// dump($resultArr);
			// dump($wxappInfo);exit;
			// $imgUrl = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=gQEy8DoAAAAAAAAAASxodHRwOi8vd2VpeGluLnFxLmNvbS9xL2FYWDFMbmpsbEZidFVaUkpZRm5mAAIEDUuWVQMEAAAAAA%3D%3D';
		}
		redirect($imgUrl);
	}
	public function share(){
		$share = new WechatShare($this->config,'');
		$share->checkTicket();
		echo json_encode(array('appid'=>$this->config['wechat_appid'],'ticket'=>$share->share_ticket));
	}
	/*跳转活动到营销系统*/
	public function location_href(){
		$wxapp = D("Wxapp_list")->field(true)->where(array('pigcms_id' => $_GET['id']))->find();
		if($wxapp){
			$url = $this->getWxappUrl($wxapp);
			if($url){
				// echo '<html><title>'.$this->_accessListAction[$wxapp['type']].'</title><body style="margin:0;padding:0;"><iframe src="'.$url.'" style="width:100%;height:100%;margin:0;padding:0;border:0;"></iframe></body></html>';
				redirect($url);
			}else{
				$this->error_tips('该活动不存在！',U('Home/index'));
			}
		}else{
			$this->error_tips('该活动不存在！',U('Home/index'));
		}
	}
	
	/*将各种类型的活动转换为统一的方式*/
	public function getWxappUrl($data){
		switch($data['type']){
			case 'red_packet':
				return $this->apiUrl.'/index.php?g=Wap&m=Red_packet&a=index&token='.$this->getToken($data['mer_id']).'&id='.$data['id'];
				break;
			case 'lottery':
				return $this->apiUrl.'/index.php?g=Wap&m=Lottery&a=index&token='.$this->getToken($data['mer_id']).'&id='.$data['id'];
				break;
			case 'bargain':
				return $this->apiUrl.'/index.php?g=Wap&m=Bargain&a=index&token='.$this->getToken($data['mer_id']).'&id='.$data['id'];
				break;
			case 'guajiang':
				return $this->apiUrl.'/index.php?g=Wap&m=Guajiang&a=index&token='.$this->getToken($data['mer_id']).'&id='.$data['id'];
				break;
			case 'crowdfunding':
				return $this->apiUrl.'/index.php?g=Wap&m=Crowdfunding&a=index&token='.$this->getToken($data['mer_id']).'&id='.$data['id'];
				break;
			case 'unitary':
				return $this->apiUrl.'/index.php?g=Wap&m=Unitary&a=index&token='.$this->getToken($data['mer_id']).'&id='.$data['id'];
				break;
			case 'jiugong':
				return $this->apiUrl.'/index.php?g=Wap&m=Jiugong&a=index&token='.$this->getToken($data['mer_id']).'&id='.$data['id'];
				break;
			case 'luckyFruit':
				return $this->apiUrl.'/index.php?g=Wap&m=LuckyFruit&a=index&token='.$this->getToken($data['mer_id']).'&id='.$data['id'];
				break;
			case 'goldenEgg':
				return $this->apiUrl.'/index.php?g=Wap&m=GoldenEgg&a=index&token='.$this->getToken($data['mer_id']).'&id='.$data['id'];
				break;
			case 'seckill':
				return $this->apiUrl.'/index.php?g=Wap&m=Seckill&a=index&token='.$this->getToken($data['mer_id']).'&id='.$data['id'];
				break;
			case 'cutprice':
				return $this->apiUrl.'/index.php?g=Wap&m=Cutprice&a=index&token='.$this->getToken($data['mer_id']).'&id='.$data['id'];
				break;	
			case 'voteimg':
				return $this->apiUrl.'/index.php?g=Wap&m=Voteimg&a=index&token='.$this->getToken($data['mer_id']).'&id='.$data['id'];
				break;	
			case 'custom':
				return $this->apiUrl.'/index.php?g=Wap&m=Custom&a=index&token='.$this->getToken($data['mer_id']).'&id='.$data['id'];
				break;
			case 'card':
				return $this->apiUrl.'/index.php?g=Wap&m=Game&a=card&token='.$this->getToken($data['mer_id']).'&id='.$data['id'];
				break;
			case 'live':
				return $this->apiUrl.'/index.php?g=Wap&m=Live&a=index&token='.$this->getToken($data['mer_id']).'&id='.$data['id'];
				break;
			case 'forum':
				return $this->apiUrl.'/index.php?g=Wap&m=Forum&a=index&token='.$this->getToken($data['mer_id']);
				break;
			case 'autumn':
				return $this->apiUrl.'/index.php?g=Wap&m=Autumn&a=index&token='.$this->getToken($data['mer_id']).'&id='.$data['id'];
				break;
			case 'research':
				return $this->apiUrl.'/index.php?g=Wap&m=Research&a=index&token='.$this->getToken($data['mer_id']).'&reid='.$data['id'];
				break;
			case 'game':
				return $this->apiUrl.'/index.php?g=Wap&m=Game&a=link&token='.$this->getToken($data['mer_id']).'&id='.$data['id'];
				break;
			case 'helping':
				return $this->apiUrl.'/index.php?g=Wap&m=Helping&a=index&token='.$this->getToken($data['mer_id']).'&id='.$data['id'];
				break;
		}
	}
	/*统一的支付方式*/
	public function pay(){
		// dump($_GET);exit;
		$wxapp_token = D('Wxpp_token')->field('`mer_id`')->where(array('pigcms_token'=>$_GET['token']))->find();
		if(empty($wxapp_token)){
			$this->error_tips('访问出错！该商家不存在。');
		}
		$now_user = D('User')->get_user($_GET['wecha_id']-100000000);
		if(empty($now_user)){
			$this->error_tips('访问出错！该用户不存在。');
		}
		$_GET['mer_id'] = $wxapp_token['mer_id'];
		$_GET['uid'] 	= $now_user['uid'];
		$_GET['type'] 	= 'wxapp';
		$param = array();
		foreach($_GET as $key=>$value){
			$param[$key] = urlencode($value);
		}
		redirect(U('Pay/check',$param));
	}
	/*支付后跳转到营销系统*/
	public function pay_back(){
		$now_order = D('Wxapp_order')->get_order_by_id($_GET['order_id']);
		if(empty($now_order)){
			$this->error_tips('访问出错！该订单不存在。');
		}else if(empty($now_order['paid'])){
			$this->error_tips('当前订单还未支付！',U('Pay/check',array('type'=>'wxapp','order_id'=>$now_order['order_id'])));
		}
		$params = array(
			'from' => $now_order['from'],
			'transactionid' => $now_order['third_id'],
			'token' => $this->getToken($now_order['mer_id']),
			'orderid' => $now_order['wxapp_order_id'],
			'payType' => $now_order['pay_type'],
		);
		$params['sign'] 	= $this->getSign($params);
		redirect($this->orderUrl.'&'.http_build_query($params));
	}
	/*将各种类型的活动转换为统一的方式*/
	public function getWxappInfo($type,$data){
		$return = array();
		switch($type){
			case 'red_packet':
				foreach($data as $key=>$val){
					$return[$key]['type'] = 'red_packet';
					$return[$key]['modelId'] = $val['id'];
					$return[$key]['title'] = $val['title'];
					$return[$key]['info'] = $val['desc'];
					$return[$key]['image'] = substr($val['msg_pic'],0,4) == 'http' ? $val['msg_pic'] : $this->apiUrl.$val['msg_pic'];
					$return[$key]['token'] = $val['token'];
					$return[$key]['time'] = $val['start_time'];
				}
				break;
			case 'lottery':
				foreach($data as $key=>$val){
					$return[$key]['type'] = 'lottery';
					$return[$key]['modelId'] = $val['id'];
					$return[$key]['title'] = $val['title'];
					$return[$key]['info'] = $val['info'];
					$return[$key]['image'] = substr($val['starpicurl'],0,4) == 'http' ? $val['starpicurl'] : $this->apiUrl.$val['starpicurl'];
					$return[$key]['token'] = $val['token'];
					$return[$key]['time'] = $val['statdate'];
				}
				break;
			case 'bargain':
				foreach($data as $key=>$val){
					$return[$key]['type'] = 'bargain';
					$return[$key]['modelId'] = $val['pigcms_id'];
					$return[$key]['title'] = $val['wxtitle'];
					$return[$key]['info'] = $val['wxinfo'];
					$return[$key]['image'] = substr($val['wxpic'],0,4) == 'http' ? $val['wxpic'] : $this->apiUrl.$val['wxpic'];
					$return[$key]['token'] = $val['token'];
					$return[$key]['time'] = $val['addtime'];
				}
				break;
			case 'guajiang':
				foreach($data as $key=>$val){
					$return[$key]['type'] = 'guajiang';
					$return[$key]['modelId'] = $val['id'];
					$return[$key]['title'] = $val['title'];
					$return[$key]['info'] = $val['info'];
					$return[$key]['image'] = substr($val['starpicurl'],0,4) == 'http' ? $val['starpicurl'] : $this->apiUrl.$val['starpicurl'];
					$return[$key]['token'] = $val['token'];
					$return[$key]['time'] = $val['statdate'];
				}
				break;
			case 'cutprice':
				foreach($data as $key=>$val){
					$return[$key]['type'] = 'cutprice';
					$return[$key]['modelId'] = $val['pigcms_id'];
					$return[$key]['title'] = $val['wxtitle'];
					$return[$key]['info'] = $val['wxinfo'];
					$return[$key]['image'] = substr($val['wxpic'],0,4) == 'http' ? $val['wxpic'] : $this->apiUrl.$val['wxpic'];
					$return[$key]['token'] = $val['token'];
					$return[$key]['time'] = $val['starttime'];
				}
				break;
			case 'seckill':
				foreach($data as $key=>$val){
					$return[$key]['type'] = 'seckill';
					$return[$key]['modelId'] = $val['action_id'];
					$return[$key]['title'] = $val['reply_title'];
					$return[$key]['info'] = $val['reply_content'];
					$return[$key]['image'] = substr($val['reply_pic'],0,4) == 'http' ? $val['reply_pic'] : $this->apiUrl.$val['reply_pic'];
					$return[$key]['token'] = $this->token;
					$return[$key]['time'] = $val['action_sdate'];
				}
				break;
			case 'crowdfunding':
				foreach($data as $key=>$val){
					$return[$key]['type'] = 'crowdfunding';
					$return[$key]['modelId'] = $val['id'];
					$return[$key]['title'] = $val['name'];
					$return[$key]['info'] = $val['intro'];
					$return[$key]['image'] = substr($val['pic'],0,4) == 'http' ? $val['pic'] : $this->apiUrl.$val['pic'];
					$return[$key]['token'] = $this->token;
					$return[$key]['time'] = $val['start'];
				}
				break;
			case 'unitary':
				foreach($data as $key=>$val){
					$return[$key]['type'] = 'unitary';
					$return[$key]['modelId'] = $val['id'];
					$return[$key]['title'] = $val['name'];
					$return[$key]['info'] = $val['wxinfo'];
					$return[$key]['image'] = substr($val['wxpic'],0,4) == 'http' ? $val['wxpic'] : $this->apiUrl.$val['wxpic'];
					$return[$key]['token'] = $this->token;
					$return[$key]['time'] = $val['addtime'];
				}
				break;
			case 'jiugong':
				foreach($data as $key=>$val){
					$return[$key]['type'] = 'jiugong';
					$return[$key]['modelId'] = $val['id'];
					$return[$key]['title'] = $val['title'];
					$return[$key]['info'] = $val['info'];
					$return[$key]['image'] = substr($val['starpicurl'],0,4) == 'http' ? $val['starpicurl'] : $this->apiUrl.$val['starpicurl'];
					$return[$key]['token'] = $this->token;
					$return[$key]['time'] = $val['statdate'];
				}
				break;
			case 'jiugong':
				foreach($data as $key=>$val){
					$return[$key]['type'] = 'jiugong';
					$return[$key]['modelId'] = $val['id'];
					$return[$key]['title'] = $val['title'];
					$return[$key]['info'] = $val['info'];
					$return[$key]['image'] = substr($val['starpicurl'],0,4) == 'http' ? $val['starpicurl'] : $this->apiUrl.$val['starpicurl'];
					$return[$key]['token'] = $this->token;
					$return[$key]['time'] = $val['statdate'];
				}
				break;
			case 'luckyFruit':
				foreach($data as $key=>$val){
					$return[$key]['type'] = 'luckyFruit';
					$return[$key]['modelId'] = $val['id'];
					$return[$key]['title'] = $val['title'];
					$return[$key]['info'] = $val['info'];
					$return[$key]['image'] = substr($val['starpicurl'],0,4) == 'http' ? $val['starpicurl'] : $this->apiUrl.$val['starpicurl'];
					$return[$key]['token'] = $this->token;
					$return[$key]['time'] = $val['statdate'];
				}
				break;
			case 'goldenEgg':
				foreach($data as $key=>$val){
					$return[$key]['type'] = 'goldenEgg';
					$return[$key]['modelId'] = $val['id'];
					$return[$key]['title'] = $val['title'];
					$return[$key]['info'] = $val['info'];
					$return[$key]['image'] = substr($val['starpicurl'],0,4) == 'http' ? $val['starpicurl'] : $this->apiUrl.$val['starpicurl'];
					$return[$key]['token'] = $this->token;
					$return[$key]['time'] = $val['statdate'];
				}
				break;
			case 'voteimg':
				foreach($data as $key=>$val){
					$return[$key]['type'] = 'voteimg';
					$return[$key]['modelId'] = $val['id'];
					$return[$key]['title'] = $val['reply_title'];
					$return[$key]['info'] = $val['reply_content'];
					$return[$key]['image'] = substr($val['reply_pic'],0,4) == 'http' ? $val['reply_pic'] : $this->apiUrl.$val['reply_pic'];
					$return[$key]['token'] = $this->token;
					$return[$key]['time'] = $val['start_time'];
				}
				break;
			case 'custom':
				foreach($data as $key=>$val){
					$return[$key]['type'] = 'custom';
					$return[$key]['modelId'] = $val['set_id'];
					$return[$key]['title'] = $val['title'];
					$return[$key]['info'] = $val['intro'];
					$return[$key]['image'] = substr($val['top_pic'],0,4) == 'http' ? $val['top_pic'] : $this->apiUrl.$val['top_pic'];
					$return[$key]['token'] = $this->token;
					$return[$key]['time'] = $val['addtime'];
				}
				break;
			case 'card':
				foreach($data as $key=>$val){
					$return[$key]['type'] = 'card';
					$return[$key]['modelId'] = $val['id'];
					$return[$key]['title'] = $val['title'];
					$return[$key]['info'] = $val['intro'];
					$return[$key]['image'] = substr($val['picurl'],0,4) == 'http' ? $val['picurl'] : $this->apiUrl.$val['picurl'];
					$return[$key]['token'] = $this->token;
					$return[$key]['time'] = $val['time'];
				}
				break;
			case 'live':
				foreach($data as $key=>$val){
					$return[$key]['type'] = 'live';
					$return[$key]['modelId'] = $val['id'];
					$return[$key]['title'] = $val['name'];
					$return[$key]['info'] = $val['intro'];
					$return[$key]['image'] = substr($val['end_pic'],0,4) == 'http' ? $val['end_pic'] : $this->apiUrl.$val['end_pic'];
					$return[$key]['token'] = $this->token;
					$return[$key]['time'] = $val['add_time'];
				}
				break;
			case 'forum':
				foreach($data as $key=>$val){
					$return[$key]['type'] = 'forum';
					$return[$key]['modelId'] = $val['id'];
					$return[$key]['title'] = $val['forumname'];
					$return[$key]['info'] = $val['intro'];
					$return[$key]['image'] = substr($val['picurl'],0,4) == 'http' ? $val['picurl'] : $this->apiUrl.$val['picurl'];
					$return[$key]['token'] = $this->token;
					$return[$key]['time'] = $_SERVER['REQUEST_TIME'];
				}
				break;
			case 'autumn':
				foreach($data as $key=>$val){
					$return[$key]['type'] = 'autumn';
					$return[$key]['modelId'] = $val['id'];
					$return[$key]['title'] = $val['title'];
					$return[$key]['info'] = $val['info'];
					$return[$key]['image'] = substr($val['starpicurl'],0,4) == 'http' ? $val['starpicurl'] : $this->apiUrl.$val['starpicurl'];
					$return[$key]['token'] = $this->token;
					$return[$key]['time'] = $val['statdate'];
				}
				break;
			case 'research':
				foreach($data as $key=>$val){
					$return[$key]['type'] = 'research';
					$return[$key]['modelId'] = $val['id'];
					$return[$key]['title'] = $val['title'];
					$return[$key]['info'] = $val['description'];
					$return[$key]['image'] = substr($val['logourl'],0,4) == 'http' ? $val['logourl'] : $this->apiUrl.$val['logourl'];
					$return[$key]['token'] = $this->token;
					$return[$key]['time'] = $val['dateline'];
				}
				break;
			case 'game':
				foreach($data as $key=>$val){
					$return[$key]['type'] = 'game';
					$return[$key]['modelId'] = $val['id'];
					$return[$key]['title'] = $val['title'];
					$return[$key]['info'] = $val['intro'];
					$return[$key]['image'] = substr($val['picurl'],0,4) == 'http' ? $val['picurl'] : $this->apiUrl.$val['picurl'];
					$return[$key]['token'] = $this->token;
					$return[$key]['time'] = $val['time'];
				}
				break;
			case 'helping':
				foreach($data as $key=>$val){
					$return[$key]['type'] = 'helping';
					$return[$key]['modelId'] = $val['id'];
					$return[$key]['title'] = $val['title'];
					$return[$key]['info'] = $val['intro'];
					$return[$key]['image'] = substr($val['reply_pic'],0,4) == 'http' ? $val['reply_pic'] : $this->apiUrl.$val['reply_pic'];
					$return[$key]['token'] = $this->token;
					$return[$key]['time'] = $val['add_time'];
				}
				break;
		}
		return $return;
	}
	/*营销系统授权登录接口*/
	public function redirect(){
		if(empty($this->user_session)){
			if(!empty($_GET['return_url'])){
				$_SESSION['weidian_return_url'] = $_GET['return_url'];
			}
			redirect(U('Login/index',array('referer'=>urlencode(U('Wxapp/redirect',array('token'=>$_GET['token'],'source'=>$_GET['source']))))));
		}else{
			$wxapp_token = D('Wxpp_token')->field('`mer_id`')->where(array('pigcms_token'=>$_GET['token']))->find();
			if(empty($wxapp_token)){
				$this->error_tips('访问出错！',U('Home/index'));
			}
			$now_user = D('User')->get_user($this->user_session['uid']);
			$this->saverelation($now_user['openid'],$wxapp_token['mer_id']);
			
			$post_data 	= array(
				'token' 	=> $_GET['token'],
				'model' 	=> 'Userinfo',
				'option'    => array(
					'where'=>array(
						'token' 		=> $_GET['token'],
						'wecha_id' 		=> 100000000+$now_user['uid'],
					),					
				),
				'data' 		=> array(
					'token' 		=> $_GET['token'],
					'wecha_id' 		=> 100000000+$now_user['uid'],
					'wechaname' 	=> $now_user['nickname'],
					'truename' 		=> $now_user['truename'] ? $now_user['truename'] : $now_user['nickname'],
					'sex' 			=> $now_user['sex'],
					'portrait' 		=> $now_user['avatar'],
					'province' 		=> $now_user['province'],
					'city' 			=> $now_user['city'],
					'issub' 		=> $now_user['is_follow'],
				),
			);
			$post_data['sign'] 	= $this->getSign($post_data);
			$result = $this->curl_post($this->insertUrl,$post_data);
			$resultArr = json_decode($result,true);
			// dump($post_data);exit;
			if($resultArr['status'] != 0 || $resultArr['message'] != 'success'){
				$this->error_tips('访问出错！',U('Home/index'));
			}else{
				redirect($this->oauth2Url.'&token='.$_GET['token'].'&wechat_id='.(100000000+$now_user['uid']));
			}
		}
	}
	/*保存用户和商家的关注关系*/
	private function saverelation($openid,$mer_id){
		if(empty($openid) || empty($mer_id)){
			return false;
		}
    	$relation = D('Merchant_user_relation')->field('mer_id')->where(array('openid' => $openid, 'mer_id' => $mer_id))->find();
    	$where = array('img_num' => 1);
    	if (empty($relation)){
    		$relation = array('openid' => $openid, 'mer_id' => $mer_id, 'dateline' => time(), 'from_merchant' => 0);
    		D('Merchant_user_relation')->add($relation);
    		$where['follow_num'] = 1;
    		D('Merchant')->where(array('mer_id' => $mer_id))->setInc('fans_count', 1);
    	}
    	D('Merchant_request')->add_request($mer_id, $where);
		return true;
    }
	/*将Pigcms的控制器名转换成Tp识别的Model形式*/
	public function getModuleName($actionName){
		$actionArr = explode('_',$actionName);
		$moduleName = '';
		foreach($actionArr as $value){
			$moduleName .= ucfirst($value);
		}
		return $moduleName;
	}
	/*模拟公众号token*/
	public function getToken($id){
		return substr(md5($this->config['site_url'].$id.$this->synType),8,16);
	}
	/*Pigcms规定的密钥*/
	private function getSign($data){
		foreach ($data as $key => $value) {
			$validate[$key] = is_array($value) ? $this->getSign($value) : $value;
		}
		$validate['salt'] = $this->SALT;
		sort($validate, SORT_STRING);
		return sha1(implode($validate));
	}
	protected function curl_post($url,$data){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
		return curl_exec($ch);
	}
}