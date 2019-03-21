<?php

class BaseAction extends CommonAction
{
	public $token = '';
	public $mer_id = 0;
	public $wecha_id = '';
	public $is_wexin_browser = false;
	public $merchant_info;

	public function __construct()
	{
		parent::__construct();

		$this->token = $this->mer_id = isset($_REQUEST['mer_id']) ? htmlspecialchars($_REQUEST['mer_id']) : (isset($_REQUEST['token']) ? htmlspecialchars($_REQUEST['token']) : 0);

		if (strpos($_SERVER['HTTP_USER_AGENT'], 'icroMessenger') !== false) {
			$this->is_wexin_browser = true;
		}

		$this->assign('is_wexin_browser', $this->is_wexin_browser);
		if ($this->is_wexin_browser && empty($GLOBALS['_SESSION']['openid'])) {
			$this->authorize_openid();
		}

		if (!$this->is_wexin_browser) {
			exit('<div style="text-align: center;margin-top: 100px;font-size: 40px;font-weight: bold;"><p>请在微信端打开！</p></div>');
		}

		if ($this->config['wechat_follow_txt_url'] && $this->config['wechat_follow_txt_txt'] && !empty($_GET['openid'])) {
			if ($this->config['wechat_follow_show_open']) {
				$invote_follow = true;
			}
			else if ($this->user_session['uid']) {
				$now_user = D('User')->get_user($this->user_session['uid']);

				if (empty($now_user['is_follow'])) {
					$invote_follow = true;
				}
			}
			else {
				$invote_follow = true;
			}

			if ($invote_follow) {
				$invote_user = D('User')->get_user($_GET['openid'], 'openid');

				if ($invote_user) {
					$invote_nickname = (!empty($invote_user['truename']) ? $invote_user['truename'] : $invote_user['nickname']);
					$invote_array = array('url' => $this->config['wechat_follow_txt_url'], 'txt' => str_replace('{nickname}', $invote_nickname, $this->config['wechat_follow_txt_txt']), 'avatar' => $invote_user['avatar']);
					$this->assign('invote_array', $invote_array);
				}
			}
		}

		if (((MODULE_NAME == 'Meal') && (ACTION_NAME == 'index')) || ((MODULE_NAME == 'Group') && (ACTION_NAME == 'detail'))) {
			$otherwc = (isset($_GET['otherwc']) ? intval($_GET['otherwc']) : 0);

			if ($otherwc) {
				$GLOBALS['_SESSION']['otherwc'] = $otherwc;
			}
			else {
				$GLOBALS['_SESSION']['otherwc'] = 0;
			}
		}

		$this->assign('mer_id', $this->mer_id);
		$this->assign('token', $this->token);
		$this->merchant_info = D('Merchant_info')->field(true)->where(array('token' => $this->token))->find();
		$merchant = D('Merchant')->field('name')->where(array('mer_id' => $this->token))->find();
		if (empty($this->merchant_info) && $this->token) {
			$info = array('wxname' => $merchant['name'], 'createtime' => time(), 'updatetime' => time(), 'tpltypeid' => 1, 'tpllistid' => 1, 'tplcontentid' => 1, 'tpltypename' => '193_index_b4bt', 'tpllistname' => 'yl_list', 'tplcontentname' => 'ktv_content');
			$info['token'] = $info['uid'] = $this->token;
			$info['id'] = D('Merchant_info')->add($info);
			$this->merchant_info = $info;
		}
		else {
			if ($this->merchant_info['wxname'] != $merchant['name']) {
				D('Merchant_info')->where(array('id' => $this->merchant_info['id']))->save(array('wxname' => $merchant['name']));
			}
		}

		$this->merchant_info['wxname'] = $merchant['name'];
		$this->assign('wxuser', $this->merchant_info);
		$this->static_path = '/tpl/WapMerchant/' . C('DEFAULT_THEME') . '/static/';
		$this->assign('static_path', $this->static_path);
		$this->common_url['group_category_all'] = U('Wap/Group/index');
		$this->assign($this->common_url);
		$share = new WechatShare($this->config, $GLOBALS['_SESSION']['openid']);
		$this->shareScript = $share->getSgin();
		$this->assign('shareScript', $this->shareScript);
		$this->hideScript = $share->gethideOptionMenu();
		$this->assign('hideScript', $this->hideScript);
	}

	public function error_tips($msg, $url = 'javascript:history.back(-1);')
	{
		$this->assign('msg', $msg);
		$this->assign('url', $url);
		$this->display('error');
		exit();
	}

	public function success_tips($msg, $url = 'javascript:history.back(-1);')
	{
		$this->assign('msg', $msg);
		$this->assign('url', $url);
		$this->display('success');
		exit();
	}

	public function authorize_openid()
	{
		if (empty($_GET['code'])) {
			$GLOBALS['_SESSION']['weixin']['state'] = md5(uniqid());
			$customeUrl = $this->config['site_url'] . $_SERVER['REQUEST_URI'];
			$oauthUrl = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $this->config['wechat_appid'] . '&redirect_uri=' . urlencode($customeUrl) . '&response_type=code&scope=snsapi_base&state=' . $GLOBALS['_SESSION']['weixin']['state'] . '#wechat_redirect';
			redirect($oauthUrl);
			exit();
		}
		else {
			if (isset($_GET['code']) && isset($_GET['state']) && ($_GET['state'] == $GLOBALS['_SESSION']['weixin']['state'])) {
				unset($GLOBALS['_SESSION']['weixin']);
				import('ORG.Net.Http');
				$http = new Http();
				$return = $http->curlGet('https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $this->config['wechat_appid'] . '&secret=' . $this->config['wechat_appsecret'] . '&code=' . $_GET['code'] . '&grant_type=authorization_code');
				$jsonrt = json_decode($return, true);

				if ($jsonrt['errcode']) {
					$error_msg_class = new GetErrorMsg();
					$this->error_tips('授权发生错误：' . $error_msg_class->wx_error_msg($jsonrt['errcode']), U('Home/index'));
				}

				if ($jsonrt['openid']) {
					$GLOBALS['_SESSION']['openid'] = $jsonrt['openid'];
					$result = D('User')->autologin('openid', $jsonrt['openid']);

					if (empty($result['error_code'])) {
						$now_user = $result['user'];
						session('user', $now_user);
						$this->user_session = session('user');
					}
				}
				else {
					redirect(U('Home/index'));
				}
			}
			else {
				redirect(U('Home/index'));
			}
		}
	}

	public function behavior($param = array(), $extra_param = false)
	{
		$openid = $GLOBALS['_SESSION']['openid'];
		if (empty($param) || empty($openid)) {
			return false;
		}

		if (empty($param['model'])) {
			$param['model'] = MODULE_NAME . '_' . ACTION_NAME;
		}

		$database_behavior = M('Behavior');
		$data_behavior = $param;
		$data_behavior['openid'] = $openid;
		$data_behavior['date'] = $data_behavior['last_date'] = $_SERVER['REQUEST_TIME'];
		$database_behavior->data($data_behavior)->add();
	}

	public function _modules()
	{
		return array('Home_index' => '首页', 'Search_group' => $this->config['group_alias_name'] . '搜索', 'Search_meal' => $this->config['meal_alias_name'] . '搜索', 'Group_index' => $this->config['group_alias_name'] . '列表', 'Group_detail' => $this->config['group_alias_name'] . '内页', 'Group_feedback' => $this->config['group_alias_name'] . '评论列表', 'Group_branch' => $this->config['group_alias_name'] . '页店铺列表', 'Group_buy' => '提交' . $this->config['group_alias_name'] . '订单', 'Group_shop' => '店铺' . $this->config['group_alias_name'] . '页面', 'Group_addressinfo' => '店家地图', 'Group_get_route' => '店家路线', 'Pay_group' => $this->config['group_alias_name'] . '确认订单', 'Pay_meal' => $this->config['meal_alias_name'] . '确认订单', 'Meal_index' => '店铺介绍', 'Meal_menu' => '店铺菜单', 'Meal_thissort' => '菜品分类', 'Meal_cart' => '确认我的菜单', 'Meal_saveorder' => '提交我的菜单', 'Meal_detail' => '订单详情', 'Meal_my' => '我的' . $this->config['meal_alias_name'] . '记录', 'Meal_order' => $this->config['meal_alias_name'] . '订单列表', 'Meal_selectmeal' => $this->config['meal_alias_name'] . '点菜', 'Index_index' => '微网站');
	}

	public function get_encrypt_key($array, $app_key)
	{
		$new_arr = array();
		ksort($array);

		foreach ($array as $key => $value) {
			$new_arr[] = $key . '=' . $value;
		}

		$new_arr[] = 'app_key=' . $app_key;
		$string = implode('&', $new_arr);
		return md5($string);
	}

	protected function get_im_encrypt_key($array, $app_key)
	{
		$new_arr = array();
		ksort($array);

		foreach ($array as $key => $value) {
			$new_arr[] = $key . '=' . $value;
		}

		$new_arr[] = 'app_key=' . $app_key;
		$string = implode('&', $new_arr);
		return md5($string);
	}

	public function _wapthisCard()
	{
		$thisCard = M('Member_card_set')->where(array('token' => $this->token, 'id' => intval($_GET['cardid'])))->find();
		return $thisCard;
	}

	protected function _waptodaySigned()
	{
		$signined = 0;
		$now = time();
		$where = array('token' => $this->token, 'wecha_id' => $this->user_session['uid'], 'score_type' => 1);
		$sign = M('Member_card_sign')->where($where)->order('sign_time desc')->find();
		$today = date('Y-m-d', $now);
		$itoday = date('Y-m-d', intval($sign['sign_time']));
		if ($sign && ($itoday == $today)) {
			$signined = 1;
		}

		return $signined;
	}

	protected function wapIsLogin()
	{
		if (empty($this->user_session)) {
			$this->error_tips('请先进行登录！', U('Login/index'));
		}
	}

	final public function httpRequest($url, $method = 'GET', $postfields = NULL, $headers = array(), $debug = false)
	{
		$method = strtoupper($method);
		$ci = curl_init();
		curl_setopt($ci, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
		curl_setopt($ci, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:34.0) Gecko/20100101 Firefox/34.0');
		curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, 60);
		curl_setopt($ci, CURLOPT_TIMEOUT, 7);
		curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);

		switch ($method) {
		case 'POST':
			curl_setopt($ci, CURLOPT_POST, true);

			if (!empty($postfields)) {
				$tmpdatastr = (is_array($postfields) ? http_build_query($postfields) : $postfields);
				curl_setopt($ci, CURLOPT_POSTFIELDS, $tmpdatastr);
			}

			break;

		default:
			curl_setopt($ci, CURLOPT_CUSTOMREQUEST, $method);
			break;
		}

		$ssl = (preg_match('/^https:\\/\\//i', $url) ? true : false);
		curl_setopt($ci, CURLOPT_URL, $url);

		if ($ssl) {
			curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ci, CURLOPT_SSL_VERIFYHOST, false);
		}

		curl_setopt($ci, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ci, CURLOPT_MAXREDIRS, 2);
		curl_setopt($ci, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ci, CURLINFO_HEADER_OUT, true);
		$response = curl_exec($ci);
		$requestinfo = curl_getinfo($ci);
		$http_code = curl_getinfo($ci, CURLINFO_HTTP_CODE);

		if ($debug) {
			echo "=====post data======\r\n";
			var_dump($postfields);
			echo "=====info===== \r\n";
			print_r($requestinfo);
			echo "=====response=====\r\n";
			print_r($response);
		}

		curl_close($ci);
		return array($http_code, $response, $requestinfo);
	}
}

?>
