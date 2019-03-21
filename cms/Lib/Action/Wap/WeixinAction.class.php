<?php

class WeixinAction extends CommonAction
{
    public $config = "";

    public function _initialize()
    {
        $this->config = D("Config")->get_config();
        C("config", $this->config);
        ob_end_clean();
    }

    public function index()
    {

		import('@.ORG.Wechat');
        $wechat = new Wechat($this->config);
		//dump($wechat);exit;
        $data = $wechat->request();
		$record_array = array(
			'user_wxopid'=>$data['FromUserName'],
			'create_time'=>$data['CreateTime'],
			'msg_type'=>$data['MsgType'],
			'content'=>$data['Content'],
			'msg_id'=>$data['MsgId']
		);
        //dump($record_array);exit;
		$res_id = M('user_record')->add($record_array);
		if($res_id){
			//如果录入客户信息成功的话，入提醒表中然后前台显示
			//查询所需要的uid等信息
			$user_array = M()->table('smart_user')->where(array('user_wx_opid'=>$data['FromUserName']))->find();
			import('@.ORG.WarnMessage');
			$warning = new WarnMessage('index','Weixin','0006',$user_array['user_id'],'有用户发送信息');
			$warning->get_data_tp();
		}
        
        list($content, $type) = $this->reply($data);
        
        if (!empty($content)) {
            $wechat->response($content, $type);
        }
        else {
            exit();
        }
    }

	private function reply($data)
	{
		$keyword = (isset($data['Content']) ? $data['Content'] : (isset($data['EventKey']) ? $data['EventKey'] : ''));
		$mer_id = 0;
		if (!isset($data['Event']) || ('UNSUBSCRIBE' != strtoupper($data['Event']))) {
			D('User')->where(array('openid' => $data['FromUserName']))->save(array('is_follow' => 1));
		}

		if ($data['MsgType'] == 'event') {
			$id = $data['EventKey'];

			switch (strtoupper($data['Event'])) {
			case 'SCAN':
				if (import('@.ORG.scanEventReply')) {
					$thirdReply = new scanEventReply($this->config, $data);
					$third_result = $thirdReply->index();
					if (isset($third_result['isuse']) && $third_result['isuse']) {
						return $third_result['data'];
					}
				}

				return $this->scan($id, $data['FromUserName']);
			case 'CLICK':
				if (import('@.ORG.clickEventReply')) {
					$thirdReply = new clickEventReply($this->config, $data);
					$third_result = $thirdReply->index();
					if (isset($third_result['isuse']) && $third_result['isuse']) {
						return $third_result['data'];
					}
				}

				$return = $this->special_keyword($id, $data);
				return $return;
			case 'SUBSCRIBE':
				$this->route();

				if (import('@.ORG.subscribeEventReply')) {
					$thirdReply = new subscribeEventReply($this->config, $data);
					$third_result = $thirdReply->index();
					if (isset($third_result['isuse']) && $third_result['isuse']) {
						return $third_result['data'];
					}
				}

				if (isset($data['Ticket'])) {
					$id = substr($data['EventKey'], 8);
					return $this->scan($id, $data['FromUserName'], 1);
				}

				$first = D('First')->field(true)->where(array('reply_type' => 0))->find();

				if ($first) {
					if ($first['type'] == 0) {
						return array($first['content'], 'text');
					}

					if ($first['type'] == 1) {
						$return[] = array($first['title'], $first['info'], $this->config['site_url'] . $first['pic'], $first['url']);
						return array($return, 'news');
					}

					if ($first['type'] == 2) {
						if ($first['fromid'] == 1) {
							return $this->special_keyword('首页', $data);
						}

						if ($first['fromid'] == 2) {
							return $this->special_keyword($this->config['group_alias_name'], $data);
						}

						return $this->special_keyword($this->config['meal_alias_name'], $data);
					}

					if ($first['type'] == 3) {
						$now = time();
						$sql = 'SELECT g.* FROM ' . C('DB_PREFIX') . 'group as g INNER JOIN ' . C('DB_PREFIX') . 'merchant as m ON m.mer_id=g.mer_id WHERE m.status=1 AND g.begin_time<\'' . $now . '\' AND g.end_time>\'' . $now . '\' AND g.status=1 ORDER BY g.index_sort DESC LIMIT 0,9';
						$mode = new Model();
						$group_list = $mode->query($sql);
						$group_image_class = new group_image();

						foreach ($group_list as $g) {
							$tmp_pic_arr = explode(';', $g['pic']);
							$image = $group_image_class->get_image_by_path($tmp_pic_arr[0], 's');
							$return[] = array('[' . $this->config['group_alias_name'] . ']' . $g['s_name'], $g['name'], $image, $this->config['site_url'] . '/wap.php?g=Wap&c=Group&a=detail&group_id=' . $g['group_id']);
						}

						return array($return, 'news');
					}
				}
				else {
					return $this->invalid();
				}

				break;

			case 'UNSUBSCRIBE':
				D('User')->where(array('openid' => $data['FromUserName']))->save(array('is_follow' => 0));
				$user_relations = D('Merchant_user_relation')->where(array('openid' => $data['FromUserName']))->select();

				if ($user_relations) {
					foreach ($user_relations as $ur) {
						D('Merchant')->where(array('mer_id' => $ur['mer_id']))->setDec('fans_count', 1);
					}
				}

				D('Merchant_user_relation')->where(array('openid' => $data['FromUserName']))->delete();
				$this->route();

				if (import('@.ORG.unsubscribeEventReply')) {
					$thirdReply = new unsubscribeEventReply($this->config, $data);
					$third_result = $thirdReply->index();
					if (isset($third_result['isuse']) && $third_result['isuse']) {
						return $third_result['data'];
					}
				}

				return array('BYE-BYE', 'text');
			case 'LOCATION':
				if ($long_lat = D('User_long_lat')->field(true)->where(array('open_id' => $data['FromUserName']))->find()) {
					D('User_long_lat')->where(array('open_id' => $data['FromUserName']))->save(array('long' => $data['Longitude'], 'lat' => $data['Latitude'], 'dateline' => time()));
				}
				else {
					D('User_long_lat')->add(array('long' => $data['Longitude'], 'lat' => $data['Latitude'], 'dateline' => time(), 'open_id' => $data['FromUserName']));
				}

				if (import('@.ORG.locationEventReply')) {
					$thirdReply = new locationEventReply($this->config, $data);
					$third_result = $thirdReply->index();
					if (isset($third_result['isuse']) && $third_result['isuse']) {
						return $third_result['data'];
					}
				}

				break;

			case 'SCANCODE_PUSH':
				if (import('@.ORG.scancode_pushEventReply')) {
					$thirdReply = new scancode_pushEventReply($this->config, $data);
					$third_result = $thirdReply->index();
					if (isset($third_result['isuse']) && $third_result['isuse']) {
						return $third_result['data'];
					}
				}
			case 'SCANCODE_WAITMSG':
				if (import('@.ORG.scancode_waitmsgEventReply')) {
					$thirdReply = new scancode_waitmsgEventReply($this->config, $data);
					$third_result = $thirdReply->index();
					if (isset($third_result['isuse']) && $third_result['isuse']) {
						return $third_result['data'];
					}
				}
			case 'PIC_SYSPHOTO':
				if (import('@.ORG.pic_sysphotoEventReply')) {
					$thirdReply = new pic_sysphotoEventReply($this->config, $data);
					$third_result = $thirdReply->index();
					if (isset($third_result['isuse']) && $third_result['isuse']) {
						return $third_result['data'];
					}
				}
			case 'PIC_PHOTO_OR_ALBUM':
				if (import('@.ORG.pic_photo_or_albumEventReply')) {
					$thirdReply = new pic_photo_or_albumEventReply($this->config, $data);
					$third_result = $thirdReply->index();
					if (isset($third_result['isuse']) && $third_result['isuse']) {
						return $third_result['data'];
					}
				}
			case 'PIC_WEIXIN':
				if (import('@.ORG.pic_weixinEventReply')) {
					$thirdReply = new pic_weixinEventReply($this->config, $data);
					$third_result = $thirdReply->index();
					if (isset($third_result['isuse']) && $third_result['isuse']) {
						return $third_result['data'];
					}
				}
			case 'LOCATION_SELECT':
				if (import('@.ORG.location_selectEventReply')) {
					$thirdReply = new location_selectEventReply($this->config, $data);
					$third_result = $thirdReply->index();
					if (isset($third_result['isuse']) && $third_result['isuse']) {
						return $third_result['data'];
					}
				}
			}
		}
		else {
			if ($data['MsgType'] == 'text') {
				if (import('@.ORG.textMessageReply')) {
					$thirdReply = new textMessageReply($this->config, $data);
					$third_result = $thirdReply->index();
					if (isset($third_result['isuse']) && $third_result['isuse']) {
						return $third_result['data'];
					}
				}

				$content = $data['Content'];
				$return = $this->special_keyword($content, $data);
				if ((strtolower(trim($content)) == 'go') || (strtolower(trim($content)) == 'pw')) {
					$t_data = $this->route();

					if ($return[0] == '亲，暂时没有找到与“' . $content . '”相关的内容！请更换内容。') {
						header('Content-type: text/xml');
						exit($t_data);
					}
				}

				return $return;
			}

			if ($data['MsgType'] == 'location') {
				if (import('@.ORG.locationMessageReply')) {
					$thirdReply = new locationMessageReply($this->config, $data);
					$third_result = $thirdReply->index();
					if (isset($third_result['isuse']) && $third_result['isuse']) {
						return $third_result['data'];
					}
				}

				import('@.ORG.longlat');
				$longlat_class = new longlat();
				$location2 = $longlat_class->gpsToBaidu($data['Location_X'], $data['Location_Y']);
				$x = $location2['lat'];
				$y = $location2['lng'];
				$meals = D('Merchant_store')->field('*, ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN((' . $x . '*PI()/180-`lat`*PI()/180)/2),2)+COS(' . $x . '*PI()/180)*COS(`lat`*PI()/180)*POW(SIN((' . $y . '*PI()/180-`long`*PI()/180)/2),2)))*1000) AS juli')->where('`have_meal`=1')->order('juli ASC')->limit('0, 10')->select();
				$store_image_class = new store_image();

				foreach ($meals as $meal) {
					$images = $store_image_class->get_allImage_by_path($meal['pic_info']);
					$meal['image'] = $images ? array_shift($images) : '';
					$len = (1000 <= $meal['juli'] ? number_format($meal['juli'] / 1000, 2) . '千米' : $meal['juli'] . '米');
					$return[] = array($meal['name'] . '[' . $meal['adress'] . ']约' . $len, $meal['txt_info'], $meal['image'], $this->config['site_url'] . '/wap.php?g=Wap&c=Meal&a=menu&mer_id=' . $meal['mer_id'] . '&store_id=' . $meal['store_id']);
				}

				$meals = D('Merchant_store')->field('*, ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN((' . $x . '*PI()/180-`lat`*PI()/180)/2),2)+COS(' . $x . '*PI()/180)*COS(`lat`*PI()/180)*POW(SIN((' . $y . '*PI()/180-`long`*PI()/180)/2),2)))*1000) AS juli')->where('`have_group`=1')->order('juli ASC')->limit('0, 10')->select();
				$store_image_class = new store_image();

				foreach ($meals as $meal) {
					$images = $store_image_class->get_allImage_by_path($meal['pic_info']);
					$meal['image'] = $images ? array_shift($images) : '';
					$len = (1000 <= $meal['juli'] ? number_format($meal['juli'] / 1000, 2) . '千米' : $meal['juli'] . '米');
					$return[] = array($meal['name'] . '[' . $meal['adress'] . ']约' . $len, $meal['txt_info'], $meal['image'], $this->config['site_url'] . '/wap.php?g=Wap&c=Group&a=shop&store_id=' . $meal['store_id']);
				}

				if (10 < count($return)) {
					$return = array_slice($return, 0, 9);
				}

				return array($return, 'news');
			}

			if (import('@.ORG.' . $data['MsgType'] . 'MessageReply')) {
				$nfile = $data['MsgType'] . 'MessageReply';
				$thirdReply = new $nfile($this->config, $data);
				$third_result = $thirdReply->index();
				if (isset($third_result['isuse']) && $third_result['isuse']) {
					return $third_result['data'];
				}
			}
		}

		return false;
	}

	private function scan($id, $openid = '', $issubscribe = 0)
	{
		if ((4100000000 < $id) && $openid) {
			$id -= 4100000000;
			$wxapp = D('Wxapp_list')->field(true)->where(array('pigcms_id' => $id))->find();

			if ($wxapp) {
				$return[] = array('' . $wxapp['title'], $wxapp['info'], $wxapp['image'], $this->config['site_url'] . '/wap.php?c=Wxapp&a=location_href&id=' . $wxapp['pigcms_id']);
			}
			else {
				return array('很抱歉，暂时获取不到该二维码的信息!', 'text');
			}

			return array($return, 'news');
		}

		if ((4000000000 < $id) && $openid) {
			$id -= 4000000000;

			if ($lottery = D('Lottery')->field(true)->where(array('id' => $id))->find()) {
				switch ($lottery['type']) {
				case 1:
					$return[] = array('[活动]' . $lottery['title'], $lottery['info'], $this->config['site_url'] . $lottery['starpicurl'], $this->config['site_url'] . '/wap.php?c=Lottery&a=index&token=' . $lottery['mer_id'] . '&id=' . $lottery['id']);
					break;

				case 2:
					$return[] = array('[活动]' . $lottery['title'], $lottery['info'], $this->config['site_url'] . $lottery['starpicurl'], $this->config['site_url'] . '/wap.php?c=Guajiang&a=index&token=' . $lottery['mer_id'] . '&id=' . $lottery['id']);
					break;

				case 3:
					$return[] = array('[活动]' . $lottery['title'], $lottery['info'], $this->config['site_url'] . $lottery['starpicurl'], $this->config['site_url'] . '/wap.php?c=Coupon&a=index&token=' . $lottery['mer_id'] . '&id=' . $lottery['id']);
					break;

				case 4:
					$return[] = array('[活动]' . $lottery['title'], $lottery['info'], $this->config['site_url'] . $lottery['starpicurl'], $this->config['site_url'] . '/wap.php?c=LuckyFruit&a=index&token=' . $lottery['mer_id'] . '&id=' . $lottery['id']);
					break;

				case 5:
					$return[] = array('[活动]' . $lottery['title'], $lottery['info'], $this->config['site_url'] . $lottery['starpicurl'], $this->config['site_url'] . '/wap.php?c=GoldenEgg&a=index&token=' . $lottery['mer_id'] . '&id=' . $lottery['id']);
					break;
				}

				return array($return, 'news');
			}

			return array('很抱歉，暂时获取不到该二维码的信息!', 'text');
		}

		if ((3000000000 < $id) && $openid) {
			$id -= 3000000000;

			if ($meal_order = D('Meal_order')->field('order_id, mer_id, store_id, meal_type')->where(array('order_id' => $id))->find()) {
				if ($meal_order['meal_type']) {
					return array('<a href="' . $this->config['site_url'] . '/wap.php?c=Takeout&a=order_detail&order_id=' . $id . '&mer_id=' . $meal_order['mer_id'] . '&store_id=' . $meal_order['store_id'] . '&otherrm=1">查看' . $this->config['meal_alias_name'] . '订单详情</a>', 'text');
				}

				return array('<a href="' . $this->config['site_url'] . '/wap.php?c=Food&a=order_detail&order_id=' . $id . '&mer_id=' . $meal_order['mer_id'] . '&store_id=' . $meal_order['store_id'] . '&otherrm=1">查看' . $this->config['meal_alias_name'] . '订单详情</a>', 'text');
			}

			return array('获取不到该订单信息', 'text');
		}

		if ((2000000000 < $id) && $openid) {
			$id -= 2000000000;
			return array('<a href="' . $this->config['site_url'] . '/wap.php?c=My&a=group_order&order_id=' . $id . '&otherrm=1">查看' . $this->config['group_alias_name'] . '订单详情</a>', 'text');
		}

		if ((1000000000 < $id) && $openid) {
			if ($user = D('User')->field('uid')->where(array('openid' => $openid))->find()) {
				D('Login_qrcode')->where(array('id' => $id))->save(array('uid' => $user['uid']));
				return array('登陆成功', 'text');
			}

			D('Login_qrcode')->where(array('id' => $id))->save(array('uid' => -1));
			$return[] = array('点击授权登录', '', $this->config['site_logo'], $this->config['site_url'] . '/wap.php?c=Web_bind&a=ajax_web_login&qrcode_id=' . $id);
			return array($return, 'news');
		}

		if ($recognition = M('Recognition')->field(true)->where(array('id' => $id))->find()) {
			switch ($recognition['third_type']) {
			case 'group':
				$now_group = D('Group')->field(true)->where(array('group_id' => $recognition['third_id']))->find();
				$group_image_class = new group_image();
				$tmp_pic_arr = explode(';', $now_group['pic']);
				$image = $group_image_class->get_image_by_path($tmp_pic_arr[0], 's');
				$return[] = array('[' . $this->config['group_alias_name'] . ']' . $now_group['s_name'], $now_group['name'], $image, $this->config['site_url'] . '/wap.php?g=Wap&c=Group&a=detail&group_id=' . $now_group['group_id']);
				$this->saverelation($openid, $now_group['mer_id'], 0);
				$return = $this->other_message($return, $now_group['mer_id'], $now_group['group_id']);
				break;

			case 'merchant':
				$now_merchant = D('Merchant')->field(true)->where(array('mer_id' => $recognition['third_id']))->find();
				$pic = '';

				if ($now_merchant['pic_info']) {
					$images = explode(';', $now_merchant['pic_info']);
					$merchant_image_class = new merchant_image();
					$images = explode(';', $images[0]);
					$pic = $merchant_image_class->get_image_by_path($images[0]);
				}

				$return[] = array('[商家]' . $now_merchant['name'], $now_merchant['txt_info'], $pic, $this->config['site_url'] . '/wap.php?g=Wap&c=Index&a=index&token=' . $recognition['third_id']);
				$return = $this->other_message($return, $now_merchant['mer_id']);
				$this->saverelation($openid, $now_merchant['mer_id'], 1, $issubscribe);
				break;

			case 'meal':
				$now_store = D('Merchant_store')->field(true)->where(array('store_id' => $recognition['third_id']))->find();
				$group_id = 0;

				if ($now_store['have_group']) {
					$nowtime = time();
					$group = D('Group')->field(true)->where('`mer_id`=\'' . $now_store['mer_id'] . '\' AND `status`=1 AND `begin_time`<\'' . $nowtime . '\' AND `end_time`>\'' . $nowtime . '\'')->order('group_id DESC')->find();
					$group_image_class = new group_image();

					if ($group) {
						$group_id = $group['group_id'];
						$tmp_pic_arr = explode(';', $group['pic']);
						$image = $group_image_class->get_image_by_path($tmp_pic_arr[0], 's');
						$return[] = array('[' . $this->config['group_alias_name'] . ']' . $group['s_name'], $group['name'], $image, $this->config['site_url'] . '/wap.php?g=Wap&c=Group&a=detail&group_id=' . $group['group_id']);
					}
				}

				$this->saverelation($openid, $now_store['mer_id'], 0);
				$return = $this->other_message($return, $now_store['mer_id'], $group_id, 0);

				foreach ($return as $returnKey => $returnValue) {
					if ($returnValue[0] == '[' . $this->config['meal_alias_name'] . ']' . $now_store['name']) {
						unset($return[$returnKey]);
						array_unshift($return, $returnValue);
						$return = array_slice($return, 0, 1);
						break;
					}
				}

				break;

			case 'lottery':
				$lottery = D('Lottery')->field(true)->where(array('id' => $recognition['third_id']))->find();

				switch ($lottery['type']) {
				case 1:
					$return[] = array('[活动]' . $lottery['title'], $lottery['info'], $this->config['site_url'] . $lottery['starpicurl'], $this->config['site_url'] . '/wap.php?c=Lottery&a=index&token=' . $lottery['token'] . '&id=' . $lottery['id']);
					break;

				case 2:
					$return[] = array('[活动]' . $lottery['title'], $lottery['info'], $this->config['site_url'] . $lottery['starpicurl'], $this->config['site_url'] . '/wap.php?c=Guajiang&a=index&token=' . $lottery['token'] . '&id=' . $lottery['id']);
					break;

				case 3:
					$return[] = array('[活动]' . $lottery['title'], $lottery['info'], $this->config['site_url'] . $lottery['starpicurl'], $this->config['site_url'] . '/wap.php?c=Coupon&a=index&token=' . $lottery['token'] . '&id=' . $lottery['id']);
					break;

				case 4:
					$return[] = array('[活动]' . $lottery['title'], $lottery['info'], $this->config['site_url'] . $lottery['starpicurl'], $this->config['site_url'] . '/wap.php?c=LuckyFruit&a=index&token=' . $lottery['token'] . '&id=' . $lottery['id']);
					break;

				case 5:
					$return[] = array('[活动]' . $lottery['title'], $lottery['info'], $this->config['site_url'] . $lottery['starpicurl'], $this->config['site_url'] . '/wap.php?c=GoldenEgg&a=index&token=' . $lottery['token'] . '&id=' . $lottery['id']);
					break;
				}

				break;
			}
		}

		if ($return) {
			return array($return, 'news');
		}

		return array('很抱歉，暂时获取不到该二维码的信息!', 'text');
	}

	private function other_message($return, $token, $group_id = 0, $store_id = 0)
	{
		$nowtime = time();
		$group_list = D('Group')->field(true)->where('`mer_id`=\'' . $token . '\' AND `group_id`<>\'' . $group_id . '\' AND `status`=1 AND `begin_time`<\'' . $nowtime . '\' AND `end_time`>\'' . $nowtime . '\'')->order('group_id DESC')->select();
		$group_image_class = new group_image();

		foreach ($group_list as $g) {
			$tmp_pic_arr = explode(';', $g['pic']);
			$image = $group_image_class->get_image_by_path($tmp_pic_arr[0], 's');
			$return[] = array('[' . $this->config['group_alias_name'] . ']' . $g['s_name'], $g['name'], $image, $this->config['site_url'] . '/wap.php?g=Wap&c=Group&a=detail&group_id=' . $g['group_id']);
		}

		if (10 < count($return)) {
			return array_slice($return, 0, 9);
		}

		$stores = D('Merchant_store')->field(true)->where('`mer_id`=\'' . $token . '\' AND `status`=1 AND `have_meal`=1 AND `store_id`<>\'' . $store_id . '\'')->order('store_id DESC')->select();
		$store_image_class = new store_image();

		foreach ($stores as $store) {
			if ($store['have_meal']) {
				$images = $store_image_class->get_allImage_by_path($store['pic_info']);
				$img = array_shift($images);
				$return[] = array('[' . $this->config['meal_alias_name'] . ']' . $store['name'], $store['txt_info'], $img, $this->config['site_url'] . '/wap.php?c=Food&a=shop&mer_id=' . $store['mer_id'] . '&store_id=' . $store['store_id']);
			}
		}

		if (10 < count($return)) {
			return array_slice($return, 0, 9);
		}

		if ($card = D('Member_card_set')->field(true)->where(array('token' => $token))->limit('0,1')->find()) {
			$return[] = array('[会员卡]' . $card['cardname'], $card['msg'], $this->config['site_url'] . $card['logo'], $this->config['site_url'] . '/wap.php?c=Card&a=index&token=' . $token);
		}

		if (10 < count($return)) {
			return array_slice($return, 0, 9);
		}

		$lotterys = D('Lottery')->field(true)->where(array(
	'token'    => $token,
	'statdate' => array('lt', time()),
	'enddate'  => array('gt', time())
	))->select();

		foreach ($lotterys as $lottery) {
			switch ($lottery['type']) {
			case 1:
				$return[] = array('[活动]' . $lottery['title'], $lottery['info'], $this->config['site_url'] . $lottery['starpicurl'], $this->config['site_url'] . '/wap.php?c=Lottery&a=index&token=' . $token . '&id=' . $lottery['id']);
				break;

			case 2:
				$return[] = array('[活动]' . $lottery['title'], $lottery['info'], $this->config['site_url'] . $lottery['starpicurl'], $this->config['site_url'] . '/wap.php?c=Guajiang&a=index&token=' . $token . '&id=' . $lottery['id']);
				break;

			case 3:
				$return[] = array('[活动]' . $lottery['title'], $lottery['info'], $this->config['site_url'] . $lottery['starpicurl'], $this->config['site_url'] . '/wap.php?c=Coupon&a=index&token=' . $token . '&id=' . $lottery['id']);
				break;

			case 4:
				$return[] = array('[活动]' . $lottery['title'], $lottery['info'], $this->config['site_url'] . $lottery['starpicurl'], $this->config['site_url'] . '/wap.php?c=LuckyFruit&a=index&token=' . $token . '&id=' . $lottery['id']);
				break;

			case 5:
				$return[] = array('[活动]' . $lottery['title'], $lottery['info'], $this->config['site_url'] . $lottery['starpicurl'], $this->config['site_url'] . '/wap.php?c=GoldenEgg&a=index&token=' . $token . '&id=' . $lottery['id']);
				break;
			}
		}

		if (10 < count($return)) {
			return array_slice($return, 0, 9);
		}

        $stores = D("Merchant_store")->field(true)->where("`mer_id`='$token' AND `status`=1 AND `have_meal`=1 AND `store_id`<>'$store_id'")->select();
        $store_image_class = new store_image();

        foreach ($stores as $store ) {
            if ($store["have_meal"]) {
                $images = $store_image_class->get_allImage_by_path($store["pic_info"]);
                $img = array_shift($images);
                $return[] = array("[订餐]" . $store["name"], $store["txt_info"], $img, $this->config["site_url"] . "/wap.php?c=Meal&a=menu&mer_id=".$store["mer_id"]."&store_id=".$store["store_id"]."");
            }
        }

        if (10 < count($return)) {
            return array_slice($return, 0, 9);
        }
        else {
            return $return;
        }
    }

	private function special_keyword($key, $data = array())
	{
		$return = array();
		if (($key == '附近' . $this->config['group_alias_name']) || ($key == '附近' . $this->config['meal_alias_name'])) {
			$dateline = time() - (3600 * 2);

			if ($long_lat = D('User_long_lat')->field(true)->where('`open_id`=\'' . $data['FromUserName'] . '\' AND `dateline`>\'' . $dateline . '\'')->find()) {
				import('@.ORG.longlat');
				$longlat_class = new longlat();
				$location2 = $longlat_class->gpsToBaidu($long_lat['lat'], $long_lat['long']);
				$x = $location2['lat'];
				$y = $location2['lng'];

				if ($key == '附近' . $this->config['meal_alias_name']) {
					$meals = D('Merchant_store')->field('*, ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN((' . $x . '*PI()/180-`lat`*PI()/180)/2),2)+COS(' . $x . '*PI()/180)*COS(`lat`*PI()/180)*POW(SIN((' . $y . '*PI()/180-`long`*PI()/180)/2),2)))*1000) AS juli')->where('`have_meal`=1')->order('juli ASC')->limit('0, 10')->select();
					$store_image_class = new store_image();

					foreach ($meals as $meal) {
						$images = $store_image_class->get_allImage_by_path($meal['pic_info']);
						$meal['image'] = $images ? array_shift($images) : '';
						$len = (1000 <= $meal['juli'] ? number_format($meal['juli'] / 1000, 1) . '千米' : $meal['juli'] . '米');
						$return[] = array($meal['name'] . '[' . $meal['adress'] . ']约' . $len, $meal['txt_info'], $meal['image'], $this->config['site_url'] . '/wap.php?g=Wap&c=Food&a=shop&mer_id=' . $meal['mer_id'] . '&store_id=' . $meal['store_id']);
					}
				}
				else {
					$meals = D('Merchant_store')->field('*, ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN((' . $x . '*PI()/180-`lat`*PI()/180)/2),2)+COS(' . $x . '*PI()/180)*COS(`lat`*PI()/180)*POW(SIN((' . $y . '*PI()/180-`long`*PI()/180)/2),2)))*1000) AS juli')->where('`have_group`=1')->order('juli ASC')->limit('0, 10')->select();
					$store_image_class = new store_image();

					foreach ($meals as $meal) {
						$images = $store_image_class->get_allImage_by_path($meal['pic_info']);
						$meal['image'] = $images ? array_shift($images) : '';
						$len = (1000 <= $meal['juli'] ? number_format($meal['juli'] / 1000, 1) . '千米' : $meal['juli'] . '米');
						$return[] = array($meal['name'] . '[' . $meal['adress'] . ']约' . $len, $meal['txt_info'], $meal['image'], $this->config['site_url'] . '/wap.php?g=Wap&c=Group&a=shop&store_id=' . $meal['store_id']);
					}
				}
			}

			if ($return) {
				return array($return, 'news');
			}

			return array('主人【小猪猪】已经接收到你的指令请发送您的地理位置(对话框右下角点击＋号，然后点击“位置”)给我哈', 'text');
		}

		if ($key == '交友') {
			$return[] = array('交友约会', '结交一些朋友吃喝玩乐', $this->config['site_url'] . '/static/images/jiaoyou.jpg', $this->config['site_url'] . '/wap.php?c=Invitation&a=datelist');
			return array($return, 'news');
		}

		$platforms = D('Platform')->field(true)->where(array('key' => $key))->order('id DESC')->limit('0,9')->select();

		if ($platforms) {
			foreach ($platforms as $platform) {
				if ($platform['api_url']) {
					$data = $this->api_url($platform['api_url']);
					exit($data);
				}

				$url = ($platform['url'] ? $platform['url'] : $this->config['site_url'] . '/wap.php?g=Wap&c=Article&a=index&sid=' . $platform['id']);
				$return[] = array($platform['title'], $platform['info'], $this->config['site_url'] . $platform['pic'], $url);
			}
		}
		else {
			$keys = D('Keywords')->field(true)->where(array('keyword' => $key))->order('id DESC')->limit('0,9')->select();
			$lotteryids = $mealids = $groupids = array();

			foreach ($keys as $k) {
				while ($k['third_type'] == 'group') {
					$groupids[] = $k['third_id'];
				}

				if ($k['third_type'] == 'Merchant_store') {
					$mealids[] = $k['third_id'];
				}
				else {
					if ($k['third_type'] == 'lottery') {
						$lotteryids[] = $k['third_id'];
					}
				}
			}

			if ($groupids) {
				$nowtime = time();
				$list = D('Group')->field(true)->where(array(
	'group_id'   => array('in', $groupids),
	'status'     => 1,
	'begin_time' => array('lt', $nowtime),
	'end_time'   => array('gt', $nowtime)
	))->select();
				$group_image_class = new group_image();

				foreach ($list as $li) {
					$tmp_pic_arr = explode(';', $li['pic']);
					$image = $group_image_class->get_image_by_path($tmp_pic_arr[0], 's');
					$return[] = array($li['s_name'], $li['name'], $image, $this->config['site_url'] . '/wap.php?g=Wap&c=Group&a=detail&group_id=' . $li['group_id']);
				}
			}

			if ($mealids) {
				$list = D('Merchant_store')->field(true)->where(array(
	'store_id' => array('in', $mealids)
	))->select();
				$store_image_class = new store_image();

				foreach ($list as $now_store) {
					while ($now_store['have_meal']) {
						$images = $store_image_class->get_allImage_by_path($now_store['pic_info']);
						$now_store['image'] = $images ? array_shift($images) : '';
						$return[] = array($now_store['name'], $now_store['txt_info'], $now_store['image'], $this->config['site_url'] . '/wap.php?g=Wap&c=Food&a=shop&mer_id=' . $now_store['mer_id'] . '&store_id=' . $now_store['store_id']);
					}

					$return[] = array($now_store['name'], $now_store['txt_info'], $now_store['image'], $this->config['site_url'] . '/wap.php?g=Wap&c=Group&a=shop&store_id=' . $now_store['store_id']);
				}
			}

			if ($lotteryids) {
				$lotterys = D('Lottery')->field(true)->where(array(
	'id'       => array('in', $lotteryids),
	'statdate' => array('lt', time()),
	'enddate'  => array('gt', time())
	))->select();

				foreach ($lotterys as $lottery) {
					switch ($lottery['type']) {
					case 1:
						$return[] = array('[活动]' . $lottery['title'], $lottery['info'], $this->config['site_url'] . $lottery['starpicurl'], $this->config['site_url'] . '/wap.php?c=Lottery&a=index&token=' . $lottery['token'] . '&id=' . $lottery['id']);
						break;

					case 2:
						$return[] = array('[活动]' . $lottery['title'], $lottery['info'], $this->config['site_url'] . $lottery['starpicurl'], $this->config['site_url'] . '/wap.php?c=Guajiang&a=index&token=' . $lottery['token'] . '&id=' . $lottery['id']);
						break;

					case 3:
						$return[] = array('[活动]' . $lottery['title'], $lottery['info'], $this->config['site_url'] . $lottery['starpicurl'], $this->config['site_url'] . '/wap.php?c=Coupon&a=index&token=' . $lottery['token'] . '&id=' . $lottery['id']);
						break;

					case 4:
						$return[] = array('[活动]' . $lottery['title'], $lottery['info'], $this->config['site_url'] . $lottery['starpicurl'], $this->config['site_url'] . '/wap.php?c=LuckyFruit&a=index&token=' . $lottery['token'] . '&id=' . $lottery['id']);
						break;

					case 5:
						$return[] = array('[活动]' . $lottery['title'], $lottery['info'], $this->config['site_url'] . $lottery['starpicurl'], $this->config['site_url'] . '/wap.php?c=GoldenEgg&a=index&token=' . $lottery['token'] . '&id=' . $lottery['id']);
						break;
					}
				}
			}
		}

		if ($return) {
			return array($return, 'news');
		}

		return $this->invalid();
	}

	private function saverelation($openid, $mer_id, $from_merchant, $issubscribe = 0)
	{
		$relation = D('Merchant_user_relation')->field('mer_id')->where(array('openid' => $openid, 'mer_id' => $mer_id))->find();
		$where = array('img_num' => 1);

		if (empty($relation)) {
			$relation = array('openid' => $openid, 'mer_id' => $mer_id, 'dateline' => time(), 'from_merchant' => $from_merchant);
			D('Merchant_user_relation')->add($relation);
			$where['follow_num'] = 1;
			D('Merchant')->where(array('mer_id' => $mer_id))->setInc('fans_count', 1);
			$issubscribe && $this->add_fans($mer_id);
			$from_merchant && D('Merchant')->update_group_indexsort($mer_id);
		}
		else {
			if (empty($relation['from_merchant']) && $from_merchant) {
				D('Merchant')->update_group_indexsort($mer_id);
				D('Merchant_user_relation')->where(array('openid' => $openid, 'mer_id' => $mer_id))->save(array('from_merchant' => $from_merchant));
			}
		}

		D('Merchant_request')->add_request($mer_id, $where);
	}

	private function add_fans($mer_id)
	{
		if ($store = D('Merchant_store')->field(true)->where(array('mer_id' => $mer_id))->order('store_id ASC')->find()) {
			$lat = $store['lat'];
			$long = $store['long'];
			$order = 'ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN((' . $lat . ' * PI() / 180- `c`.`lat` * PI()/180)/2),2)+COS(' . $lat . ' *PI()/180)*COS(`c`.`lat`*PI()/180)*POW(SIN((' . $long . ' *PI()/180- `c`.`long`*PI()/180)/2),2)))*1000) ASC';
			$mod = new Model();
			$limit = $this->config['merchant_qrcode_fans'];
			$sql = 'SELECT DISTINCT(openid) FROM  ' . C('DB_PREFIX') . 'merchant_user_relation AS a INNER JOIN  ' . C('DB_PREFIX') . 'user_long_lat as c ON c.open_id=a.openid WHERE NOT EXISTS (SELECT openid FROM  ' . C('DB_PREFIX') . 'merchant_user_relation AS b WHERE a.openid = b.openid AND b.mer_id=2) ORDER BY ' . $order . ' LIMIT ' . $limit;
			$res = $mod->query($sql);

			foreach ($res as $v) {
				if (!($relation = D('Merchant_user_relation')->field('mer_id')->where(array('openid' => $v['openid'], 'mer_id' => $mer_id))->find())) {
					D('Merchant_user_relation')->add(array('openid' => $v['openid'], 'mer_id' => $mer_id, 'dateline' => time(), 'from_merchant' => 2));
					D('Merchant')->where(array('mer_id' => $mer_id))->setInc('fans_count', 1);
				}
			}
		}
	}

	private function route()
	{
		$xml = $GLOBALS['HTTP_RAW_POST_DATA'];
		$data = $this->api_notice_increment('http://we-cdn.net', $xml);
		return $data;
	}

	private function api_url($apiurl)
	{
		$xml = $GLOBALS['HTTP_RAW_POST_DATA'];
		$data = $this->api_notice_increment($apiurl, $xml);
		return $data;
	}

	private function invalid()
	{
		$first = D('First')->field(true)->where(array('reply_type' => 1))->find();

		if ($first) {
			if ($first['type'] == 0) {
				return array($first['content'], 'text');
			}

			if ($first['type'] == 1) {
				$return[] = array($first['title'], $first['info'], $this->config['site_url'] . $first['pic'], $first['url']);
				return array($return, 'news');
			}

			if ($first['type'] == 2) {
				if ($first['fromid'] == 1) {
					return $this->special_keyword('首页', $data);
				}

				if ($first['fromid'] == 2) {
					return $this->special_keyword($this->config['group_alias_name'], $data);
				}

				return $this->special_keyword($this->config['meal_alias_name'], $data);
			}

			if ($first['type'] == 3) {
				$now = time();
				$sql = 'SELECT g.* FROM ' . C('DB_PREFIX') . 'group as g INNER JOIN ' . C('DB_PREFIX') . 'merchant as m ON m.mer_id=g.mer_id WHERE m.status=1 AND g.begin_time<\'' . $now . '\' AND g.end_time>\'' . $now . '\' AND g.status=1 ORDER BY g.index_sort DESC LIMIT 0,9';
				$mode = new Model();
				$group_list = $mode->query($sql);
				$group_image_class = new group_image();

				foreach ($group_list as $g) {
					$tmp_pic_arr = explode(';', $g['pic']);
					$image = $group_image_class->get_image_by_path($tmp_pic_arr[0], 's');
					$return[] = array('[' . $this->config['group_alias_name'] . ']' . $g['s_name'], $g['name'], $image, $this->config['site_url'] . '/wap.php?g=Wap&c=Group&a=detail&group_id=' . $g['group_id']);
				}

				return array($return, 'news');
			}
		}
		else {
			return array('感谢您的关注，我们将竭诚为您服务！', 'text');
		}
	}

	private function api_notice_increment($url, $data)
	{
		$ch = curl_init();
		$headers = array('User-Agent: Mozilla/5.0 (Windows NT 5.1; rv:14.0) Gecko/20100101 Firefox/14.0.1', 'Accept-Language: en-us,en;q=0.5', 'Referer:http://mp.weixin.qq.com/', 'Content-type: text/xml');
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$tmpInfo = curl_exec($ch);
		$error = curl_errno($ch);
		curl_close($ch);

		if ($error) {
			return false;
		}

		return $tmpInfo;
	}
}

?>
