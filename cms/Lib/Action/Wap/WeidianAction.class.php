<?php

class WeidianAction extends BaseAction{

	public $weidian_wap_url = '';

	public $weidian_api_url = '';

	

	public function __construct()

	{

		parent::__construct();

		$this->weidian_wap_url = $this->config['weidian_url'].'/wap/';

		$this->weidian_api_url = $this->config['weidian_url'].'/api/';

	}

	public function share(){

		$share = new WechatShare($this->config,'');

		$share->checkTicket();

		echo json_encode(array('appid'=>$this->config['wechat_appid'],'ticket'=>$share->share_ticket));

	}

	//跳转管理微店

	public function redirect(){

		if(empty($this->user_session)){

			if(!empty($_GET['return_url'])){

				$_SESSION['weidian_return_url'] = $_GET['return_url'];

			}

			redirect(U('Login/index',array('referer'=>urlencode(U('Weidian/redirect',array('token'=>$_GET['token'],'store_id'=>$_GET['store_id']))))));

			// $this->error_tips('请先登录！',U('Login/index',array('referer'=>urlencode(U('Weidian/redirect',array('token'=>$_GET['token'],'store_id'=>$_GET['store_id']))))));

		}

		if(!empty($_GET['token']) && !empty($_GET['store_id'])){

			$user = D('User')->field(true)->where(array('uid' => $this->user_session['uid']))->find();

			$data = array(

				'token'      => $_GET['token'],

				'wecha_id'   => $this->user_session['uid'],

				'wechaname'  => isset($user['nickname']) ? $user['nickname'] : $this->user_session['nickname'],

				'portrait'     => isset($user['avatar']) ? $user['avatar'] : $this->user_session['avatar'],

				'tel'     => isset($user['phone']) ? $user['phone'] : $this->user_session['phone'],

				'return_url' => $_GET['return_url'] ? $_GET['return_url'] : ($_SESSION['weidian_return_url'] ? $_SESSION['weidian_return_url'] : ''),

				'address' => '',

				'site_url' => C('config.site_url'),

				'app_id' => 2,

				'store_id' => $_GET['store_id'],

			);

			$sort_data = $data;

			$sort_data['salt'] = 'pigcms';

			ksort($sort_data);

			$sign_key = sha1(http_build_query($sort_data));

			$data['sign_key'] = $sign_key;

			$data['request_time'] = $_SERVER['REQUEST_TIME'];

			$result = $this->curl_post($this->weidian_api_url.'fans.php',$data);

			if($result){

				$json_arr = json_decode($result,true);

				if($json_arr['error_code']){

					$this->error('操作失败，请重试。');

				}else{

					redirect($json_arr['return_url']);

				}

			}else{

				$this->error_tips('操作失败，请重试。');

			}

		}else{

			$this->error_tips('参数缺失，无法跳转！请返回重试。');

		}

	}

	//附近微店跳转

	public function near_store_redirect(){

		redirect($this->weidian_wap_url.'nearweidian.php?domain='.urlencode($this->config['site_url']));

	}

	public function getImUrl(){

		if($_GET['token'] && $_GET['wecha_id']){

			$services = D('Customer_service')->where(array('mer_id' => $_GET['token']))->select();

			if(empty($services)){

				$this->error_tips('该商家未设置客服');

			}

			$now_user = D('User')->get_user($_GET['wecha_id']);

			if(empty($now_user) || empty($now_user['openid'])){

				$this->error_tips('系统中没有查找到您的用户信息');

			}

			$key = $this->get_encrypt_key(array('app_id'=>$this->config['im_appid'],'openid' => $now_user['openid']), $this->config['im_appkey']);

			$kf_url = ($this->config['im_url']).'/?app_id=' . $this->config['im_appid'] . '&openid=' . $now_user['openid'] . '&key=' . $key . '#serviceList_' . $_GET['token'];

			redirect($kf_url);

		}else{

			$this->error_tips('访问方式不对，请返回重试');

		}

	}

	//消息通知

	public function api_msg(){

		if($_POST['type'] == 3){

			$now_user = D('User')->get_user($_POST['wecha_id']);

			if($now_user && $now_user['openid']){

				$model = new templateNews(C('config.wechat_appid'), C('config.wechat_appsecret'));

				$model->sendTempMsg('OPENTM202521011', array('href' => $_POST['href'], 'wecha_id' => $now_user['openid'], 'first' => '尊敬的用户您好，您的订单已完成。', 'keyword1' => $_POST['order_detail']['order_no'], 'keyword2' => date('m月d日,H:i',$_POST['order_detail']['complate_time']),'remark' => '如有任何疑问，请您及时联系商家'));

			}

		}

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

	

?>