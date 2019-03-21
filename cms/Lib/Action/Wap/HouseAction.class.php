<?php

//社区O2O

class HouseAction extends BaseAction
{
    protected $village_bind;

    public function __construct()
    {
        parent::__construct();
        $this->village_bind = $_SESSION['now_village_bind'];
        $this->room = $_SESSION['room'];
        //$this->user_session=$_SESSION['user'];
        if (empty($this->user_session)) {
            $location_param['referer'] = urlencode($_SERVER['REQUEST_URI']);
            redirect(U('Login/index', $location_param));
        }
    }

    public $pay_list_type = array(
        'property' => '物业费',
        'carspace'=>'泊位费',
        'water' => '水费',
        'electric' => '电费',
        'gas' => '燃气费',
        'park' => '停车费',
        'custom' => '其他缴费',
        'accessControl' => '智能门禁',
        'jiaofei' => '在线缴费',
        'repair' => '在线报修',
        'suggest' => '投诉建议',
        'houtai' => '后台管理',
        'xunjian' => '巡检图表',
    );

    public function check_village_session($village_id)
    {
        if (empty($this->village_bind) && !empty($this->user_session)) {
            D('House_village')->get_bind_list($this->user_session['uid'], $this->user_session['phone']);
            $bind_village_list = D('House_village_user_bind')->get_user_bind_list($this->user_session['uid'], $village_id);
            if (!empty($bind_village_list)) {
                if (count($bind_village_list) == 1) {
                    $this->village_bind = $_SESSION['now_village_bind'] = $bind_village_list[0];
                } else {
                    redirect(U('House/village_select', array('village_id' => $village_id, 'referer' => urlencode($_SERVER['REQUEST_URI']))));
                }
            }
        }
    }

    //小区列表
    public function village_list()
    {
        if ($_GET['comm']) {
            $condition['village_id'] = $_GET['village_id'];
            $info = M('house_commonphone');
            $server = $info->where(array('village_id' => $condition['village_id'], 's_phone' => '1'))->find();
//			dump($server['iphone']);exit;
            $this->assign('server', $server['iphone']);
            $ct_info = M('house_commontype');
            $ct_message = $ct_info->where('village_id =' . $condition['village_id'])->select();
            foreach ($ct_message as $ke => $va) {
                $cp_message = $info->where(array('village_id' => $condition['village_id'], 'ct_id' => $va['ct_id']))->order('ct_id DESC')->select();
                if (empty($cp_message)) {
                    unset($ct_message[$ke]);
                } else {
                    foreach ($cp_message as $key => $val) {
                        $ct_message[$ke]['ct'][$key]['name'] = $val['nickname'];
                        $ct_message[$ke]['ct'][$key]['phone'] = $val['iphone'];
                    }
                }
            }
//			dump($ct_message);exit;
            $long_lat = D('User_long_lat')->getLocation($_SESSION['openid'], 0);
            $long_lat['village_id'] = $_GET['village_id'];
//			dump($_GET);exit;
            $village_name = M('House_village')->where(array('village_id' => $_GET['village_id']))->getField('village_name');
            //dump($village_name);exit;
            $this->assign('village_name', $village_name);
            $this->assign('now_village', $long_lat);
            $this->assign('ct_message', $ct_message);
            $this->display('House/commonphone_index');
        } else {
            //$long_lat=D('User_long_lat')->getLocation($_SESSION['openid'],0);
            $long_lat = D('User_long_lat')->getLocation($_SESSION['openid'], 5);    //定位
            //print_r($long_lat);
            $this->assign('long_lat', $long_lat);
            if ($_GET['control'] && $_GET['control'] == 'key') {    //判断是否是我的钥匙
                $user_list = M('house_village_user_bind')->where(array('uid' => $this->user_session['uid']))->select();
                if ($user_list && is_array($user_list)) {        //判断是否提交过资料
                    $user_info = M('house_village_user_bind')->where(array('uid' => $this->user_session['uid'], 'role' => array('neq', 2)))->find();
                    if ($user_info) {    //判断社区列表中是否存在业主
                        if ($user_info['ac_status'] == 1 || $user_info['ac_status'] == 3) {    //是业主且已提交智能门禁审核但没得到认可时
                            $this->redirect('你提交的资料正在审核中或审核未通过！', U('House/village_access_next', array('village_id' => $user_info['village_id'])));
                        } else if (empty($user_info['ac_status'])) {    //是业主但没有提交智能门禁审核
                            $this->redirect('请提交智能门禁资料审核', U('House/village_access_control', array('village_id' => $user_info['village_id'])));
                        } else {    //我的钥匙页面
                            $this->redirect(U('House/control_show', array('village_id' => $user_info['village_id'])));
                        }
                    } else {
                        $this->redirect(U('House/noticeKid'));
                    }
                } else {
                    $this->assign('control', $_GET['control']);
                    $this->display();
                }
            } else {
                /*$user_list=M('house_village_user_bind')->where(array('uid'=>$this->user_session['uid']))->select();
                if(!$user_list){
                    $this->redirect(U('House/access_control_change'));
                }*/
                $this->display();
            }
        }
    }

    public function ajax_village_list()
    {
        $this->header_json();
        $_SESSION['openid'] && $long_lat = D('User_long_lat')->getLocation($_SESSION['openid'], 0);
        $return = array();

        //找到用户已绑定的小区
        if ($this->user_session && $_GET['page'] < 2 && empty($_POST['keyword'])) {
            $bind_village_list = D('House_village')->get_bind_list($this->user_session['uid'], $this->user_session['phone']);
            //dump($bind_village_list);exit;
            //判断得到用户位置
            if ($bind_village_list && $long_lat) {
                $rangeSort = array();
                foreach ($bind_village_list as &$village_value) {
                    $village_value['range_int'] = getDistance($village_value['lat'], $village_value['long'], $long_lat['lat'], $long_lat['long']);
                    $village_value['range'] = getRange($village_value['range_int']);
                    $rangeSort[] = $village_value['range_int'];
                }
                array_multisort($rangeSort, SORT_ASC, $bind_village_list);
            }
            if ($_SERVER['HTTP_HOST'] == 'www.hdhsmart.com' && $bind_village_list[0]['first_test']) {
                $return['first_test'] = true;
            }
            $return['bind_village_list'] = $bind_village_list;
            //dump($bind_village_list);exit;
        }
        if (empty($this->user_session) && $_GET['page'] < 2 && empty($_POST['keyword'])) {
            $return['login_test'] = true;
        }
        unset($long_lat);//取消地理位置授权 zhukeqin
        $return['village_list'] = D('House_village')->wap_get_list($long_lat, $_POST['keyword']);
        if (empty($return['village_list'])) {
            unset($return['village_list']);
        }
        echo json_encode($return);
    }

    //户号选择，只有一个社区自动跳转 zhukeqin
    public function village_select()
    {
        if ($_GET['village_id']) {
            $now_village = $this->get_village($_GET['village_id']);
            //$referer = $_GET['referer'] ? htmlspecialchars_decode($_GET['referer']) : U('House/village',array('village_id'=>$_GET['village_id']));
            $referer = $_GET['referer'] ? htmlspecialchars_decode($_GET['referer']) : U('House/access_control_change', array('village_id' => $_GET['village_id'], 'control' => $_GET['control']));
        } else {
            $this->error_tips('非法访问');
        }
        if (!empty($this->user_session)) {
            if ($_GET['bind_id']) {
                $bind_village = D('House_village_user_bind')->get_one($_GET['village_id'], $_GET['bind_id'], 'pigcms_id');
                if (empty($bind_village) || $bind_village['uid'] != $this->user_session['uid']) {
                    $this->error_tips('非法访问');
                }
                $_SESSION['now_village_bind'] = $bind_village;
                redirect($referer);
            } else {
                D('House_village')->get_bind_list($this->user_session['uid'], $this->user_session['phone']);
                $bind_village_list = D('House_village_user_bind')->get_user_bind_list($this->user_session['uid'], $_GET['village_id']);
                if (empty($bind_village_list)) {
                    $_SESSION['now_village_bind'] = "";    //清空社区绑定session
                    redirect($referer);
                } else {
                    if (count($bind_village_list) == 1) {
                        $_SESSION['now_village_bind'] = $bind_village_list[0];
                        redirect($referer);
                    } else {
                        $this->assign('bind_village_list', $bind_village_list);
                    }
                }
            }
        } else {
            redirect($referer);
        }
        $this->assign('referer', $referer);
        $this->display();
    }

    public function village()
    {
        $now_village = $this->get_village($_GET['village_id']);
        $this->check_village_session($now_village['village_id']);
        //5条最新新闻
        $news_list = D('House_village_news')->get_limit_list($now_village['village_id'], 6);
        $this->assign('news_list', $news_list);
        $user_long_lat = D('User_long_lat')->getLocation($_SESSION['openid'], 0);
        //缴费
        $pay_list = array();
        $systemLiveServiceTypeArr = explode(',', $this->config['live_service_type']);
        //注释社区首页菜单在线缴费等按钮
        $now_village['property_price'] = floatval($now_village['property_price']);
        $now_village['water_price'] = floatval($now_village['water_price']);
        $now_village['electric_price'] = floatval($now_village['electric_price']);
        $now_village['gas_price'] = floatval($now_village['gas_price']);
        $now_village['park_price'] = floatval($now_village['park_price']);
        //新增在线报修、投诉建议
        $pay_list[] = array(
            'type' => 'accessControl',
            'name' => $this->pay_list_type['accessControl'],
            'url' => U('House/village_access_control', array('village_id' => $now_village['village_id'], 'type' => 'accessControl')),
            //'url' => U('House/access_control_change',array('village_id'=>$now_village['village_id'],'type'=>'accessControl')),
        );

        $pay_list[] = array(
            'type' => 'jiaofei',
            'name' => $this->pay_list_type['jiaofei'],
            'url' => U('House/village_my_pay', array('village_id' => $now_village['village_id'], 'type' => 'jiaofei')),
        );
        $pay_list[] = array(
            'type' => 'repair',
            'name' => $this->pay_list_type['repair'],
            'url' => U('House/village_my_repair', array('village_id' => $now_village['village_id'], 'type' => 'repair')),
        );
        $pay_list[] = array(
            'type' => 'suggest',
            'name' => $this->pay_list_type['suggest'],
            'url' => U('House/village_my_suggest', array('village_id' => $now_village['village_id'], 'type' => 'suggest')),
        );
        $pay_list[] = array(
            'type' => 'houtai',
            'name' => $this->pay_list_type['houtai'],
            'url' => U('House/village_my_bind', array('village_id' => $now_village['village_id'], 'type' => 'houtai')),
        );
        $pay_list[] = array(
            'type' => 'xunjian',
            'name' => $this->pay_list_type['xunjian'],
            'url' => U('PropertyService/check_safety_record_chart', array('village_id' => $now_village['village_id'], 'type' => 'xunjian')),
        );
        /*
		if($now_village['property_price']){
			$pay_list[] = array(
				'type' => 'property',
				'name' => $this->pay_list_type['property'],
				'url' => U('House/village_pay',array('village_id'=>$now_village['village_id'],'type'=>'property')),
			);
		}
		if($now_village['water_price'] || in_array('water',$systemLiveServiceTypeArr)){
			$pay_list[] = array(
				'type' => 'water',
				'name' => $this->pay_list_type['water'],
				'url' => $now_village['water_price'] ? U('House/village_pay',array('village_id'=>$now_village['village_id'],'type'=>'water')) : U('Lifeservice/query',array('type'=>'water')),
			);
		}
		if($now_village['electric_price'] || in_array('electric',$systemLiveServiceTypeArr)){
			$pay_list[] = array(
				'type' => 'electric',
				'name' => $this->pay_list_type['electric'],
				'url' => $now_village['electric_price'] ? U('House/village_pay',array('village_id'=>$now_village['village_id'],'type'=>'electric')) : U('Lifeservice/query',array('type'=>'electric')),
			);
		}
		if($now_village['gas_price'] || in_array('gas',$systemLiveServiceTypeArr)){
			$pay_list[] = array(
				'type' => 'gas',
				'name' => $this->pay_list_type['gas'],
				'url' => $now_village['electric_price'] ? U('House/village_pay',array('village_id'=>$now_village['village_id'],'type'=>'gas')) : U('Lifeservice/query',array('type'=>'gas')),
			);
		}
		if($now_village['park_price']){
			$pay_list[] = array(
				'type' => 'park',
				'name' => $this->pay_list_type['park'],
				'url' => U('House/village_pay',array('village_id'=>$now_village['village_id'],'type'=>'park')),
			);
		}
		if($now_village['has_custom_pay']){
			$pay_list[] = array(
				'type' => 'custom',
				'name' => $this->pay_list_type['custom'],
				'url' => U('House/village_pay',array('village_id'=>$now_village['village_id'],'type'=>'custom')),
			);
		}*/

        //找出社区自定义的预约列表
        $appoint_list = D('House_village_appoint')->field('`appoint_id`,`label`,`pic`')->where(array('index_show' => '1', 'village_id' => $now_village['village_id']))->order('`sort` DESC')->select();
        foreach ($appoint_list as $value) {
            $pay_list[] = array(
                'type' => 'appoint',
                'name' => $value['label'],
                'url' => U('Appoint/detail', array('appoint_id' => $value['appoint_id'])),
                'pic' => $this->config['site_url'] . '/upload/house/appoint/' . $value['pic'],
            );
        }
        $this->assign('pay_list', $pay_list);
        //推荐团购
        $group_list = D('House_village_group')->get_limit_list($now_village['village_id'], 3, $user_long_lat);
        $this->assign('group_list', $group_list);
        //推荐快店
        $meal_list = D('House_village_meal')->get_limit_list($now_village['village_id'], 3, $user_long_lat);
        $this->assign('meal_list', $meal_list);
        //推荐预约
        $appoint_list = D('House_village_appoint')->get_limit_list($now_village['village_id'], 3, $user_long_lat);
        $this->assign('appoint_list', $appoint_list);
        //找到模板排序
        $displayArr = explode(' ', $this->config['house_display']);
        $displayTplArr = array(
            1 => 'village_index_news',
            2 => 'village_index_pay',
            3 => 'village_index_group',
            4 => 'village_index_meal',
            5 => 'village_index_appoint'
        );
        $displayIncludeTplArr = array();
        foreach ($displayArr as $value) {
            if ($value >= 1 && $value <= 5) {
                $displayIncludeTplArr[] = $displayTplArr[$value];
            }
        }
        $this->assign('displayIncludeTplArr', implode(',', $displayIncludeTplArr));
        $share_arr = array(
            'title' => $now_village['village_name'],
            'desc' => '汇得行-生活智慧助手',
            'imgUrl' => C('config.site_url') . '/tpl/Wap/myinterface/static/images/house.jpg',
            'link' => C('config.site_url') . '/wap.php?g=Wap&c=House&a=village&village_id=' . $now_village['village_id']
        );
        $share = new WechatShare($this->config, $_SESSION['openid'], $share_arr);
        $this->shareScript = $share->getSgin();
        $this->assign('shareScript', $this->shareScript);
        $this->display();
    }

    public function village_newslist()
    {
        $now_village = $this->get_village($_GET['village_id']);

        $category_list = D('House_village_news_category')->get_limit_list($now_village['village_id']);
        if ($category_list) {
            $this->assign('category_list', $category_list);

            $news_list = D('House_village_news')->get_list_by_cid($category_list[0]['cat_id']);
            $this->assign('news_list', $news_list);

            $this->display();
        } else {
            $this->error_tips('本社区没有发布过新闻', U('House/village', array('village_id' => $now_village['village_id'])));
        }
    }

    public function village_ajax_news()
    {
        $this->header_json();
        $news_list = D('House_village_news')->get_list_by_cid($_GET['cat_id']);
        foreach ($news_list as &$newsValue) {
            $newsValue['add_time_txt'] = date('m-d H:i', $newsValue['add_time']);
        }
        echo json_encode($news_list);
    }

    public function village_news()
    {
        $now_village = $this->get_village($_GET['village_id']);
        $this->check_village_session($now_village['village_id']);

        $now_news = D('House_village_news')->get_one($_GET['news_id']);
        if (empty($now_news)) {
            $this->error_tips('当前文章不存在', U('House/village_newslist', array('village_id' => $now_village['village_id'])));
        }
        $this->assign('now_news', $now_news);
        $this->display();
    }

    public function village_news_reply()
    {
        $this->header_json();
        $now_news = D('House_village_news')->get_one($_GET['news_id']);
        if (empty($now_news)) {
            echo json_encode(array('errcode' => 2, 'errmsg' => '当前文章不存在'));
        } else if (empty($_POST['content'])) {
            echo json_encode(array('errcode' => 3, 'errmsg' => '请填写评论的内容'));
        } else if (empty($this->user_session)) {
            echo json_encode(array('errcode' => 4, 'errmsg' => '请先进行登录'));
        } else {
            $data_reply = array(
                'uid' => $this->user_session['uid'],
                'village_id' => $now_news['village_id'],
                'news_id' => $now_news['news_id'],
                'content' => $_POST['content'],
                'add_time' => $_SERVER['REQUEST_TIME'],
                'add_ip' => get_client_ip(1),
            );
            if (D('House_village_news_reply')->data($data_reply)->add()) {
                echo json_encode(array('errcode' => 1, 'errmsg' => '发布成功，已经提交给小区管理员'));
            } else {
                echo json_encode(array('errcode' => 5, 'errmsg' => '发布失败'));
            }
        }
    }

    public function village_grouplist()
    {
        $now_village = $this->get_village($_GET['village_id']);

        $user_long_lat = D('User_long_lat')->getLocation($_SESSION['openid'], 0);

        //推荐团购
        $group_list = D('House_village_group')->get_limit_list_page($now_village['village_id'], 10, $user_long_lat);
        if (IS_POST) {
            $this->header_json();
            // dump($group_list);
            echo json_encode($group_list['group_list']);
        } else {
            $this->assign($group_list);
            $this->display();
        }
    }

    public function village_meallist()
    {
        $now_village = $this->get_village($_GET['village_id']);

        $user_long_lat = D('User_long_lat')->getLocation($_SESSION['openid'], 0);

        //推荐快店
        $store_list = D('House_village_meal')->get_limit_list_page($now_village['village_id'], 10, $user_long_lat);
        if (IS_POST) {
            $this->header_json();
            echo json_encode($store_list['store_list']);
        } else {
            $this->assign($store_list);
            $this->display();
        }
    }

    public function village_appointlist()
    {
        $now_village = $this->get_village($_GET['village_id']);

        $user_long_lat = D('User_long_lat')->getLocation($_SESSION['openid'], 0);

        //推荐预约
        $appoint_list = D('House_village_appoint')->get_limit_list_page($now_village['village_id'], 10, $user_long_lat);
        if (IS_POST) {
            $this->header_json();
            echo json_encode($appoint_list['appoint_list']);
        } else {
            $this->assign($appoint_list);
            $this->display();
        }
    }

    public function village_pay()
    {
//		dump($_GET['village_id']);
        $phone = $this->user_session['phone'];
        if (empty($phone)) {
            $this->error_tips('为了保护您的权益，在缴费之前您必须绑定手机号码！', U('My/bind_user', array('referer' => urlencode(U('House/village_pay', $_GET)))));
        }
        $now_village = $this->get_village($_GET['village_id']);
        if (empty($this->user_session['phone'])) {
            $this->user_session['phone'] = $_SESSION['user']['phone'];
        }
        D('House_village')->get_bind_list($this->user_session['uid'], $this->user_session['phone']);
        $bind_village_list = D('House_village_user_bind')->get_user_bind_list($this->user_session['uid'], $_GET['village_id']);
        $this->village_bind = $_SESSION['now_village_bind'] = $bind_village_list[0];
//		if(!empty($bind_village_list)){
//			if(count($bind_village_list) == 1){
//				$this->village_bind = $_SESSION['now_village_bind'] = $bind_village_list[0];
//			}else{
//				redirect(U('House/village_select',array('village_id'=>$village_id,'referer'=>urlencode($_SERVER['REQUEST_URI']))));
//			}
//		}
//		dump($now_village);
////		$this->check_village_session($now_village['village_id']);
//		dump($this->village_bind);exit;
        if ($this->village_bind['village_type'] == 1) $this->redirect(U('village_uptown_pay', array('village_id' => $_GET['village_id'])));
        if (empty($this->village_bind)) {
            //$this->check_ajax_error_tips('您不属于当前小区，无法使用缴费功能');
            $this->redirect(U('House/village_access_control', array('village_id' => $now_village['village_id'])));
        }
        $pay_type = $_GET['type'];
        $pay_name = $this->pay_list_type[$pay_type];
        if (empty($pay_name)) {
            $this->check_ajax_error_tips('当前访问的缴费类型不存在');
        }
        //判断用户是否属于本小区
        if (empty($this->user_session)) {
            $this->check_ajax_error_tips('请先进行登录', U('Login/index'));
        }
        $now_user_info = $this->get_user_village_info($this->village_bind['pigcms_id']);

        $pay_money = 0;
        switch ($pay_type) {
            case 'property':
                if (empty($now_village['property_price'])) $this->check_ajax_error_tips('当前小区不支持缴纳' . $pay_name);
                $pay_money = $now_user_info['property_price'];
                $order_list = D('House_village_user_paylist')->field('`ydate`,`mdate`,`property_price` AS `price`')->where(array('usernum' => $now_user_info['usernum']))->order('`pigcms_id` DESC')->select();
                foreach ($order_list as $key => $value) {
                    $order_list[$key]['desc'] = '物业费 ' . floatval($value['price']) . ' 元';
                }
                break;
            case 'water':
                if (empty($now_village['water_price'])) $this->check_ajax_error_tips('当前小区不支持缴纳' . $pay_name);
                $pay_money = $now_user_info['water_price'];
                $order_list = D('House_village_user_paylist')->field('`ydate`,`mdate`,`use_water` AS `use`,`water_price` AS `price`')->where(array('usernum' => $now_user_info['usernum']))->order('`pigcms_id` DESC')->select();
                foreach ($order_list as $key => $value) {
                    $order_list[$key]['desc'] = '用水 ' . floatval($value['use']) . ' 立方米，总费用 ' . floatval($value['price']) . ' 元';
                }
                break;
            case 'electric':
                if (empty($now_village['electric_price'])) $this->check_ajax_error_tips('当前小区不支持缴纳' . $pay_name);
                $pay_money = $now_user_info['electric_price'];
                $order_list = D('House_village_user_paylist')->field('`ydate`,`mdate`,`use_electric` AS `use`,`electric_price` AS `price`')->where(array('usernum' => $now_user_info['usernum']))->order('`pigcms_id` DESC')->select();
                foreach ($order_list as $key => $value) {
                    $order_list[$key]['desc'] = '用电 ' . floatval($value['use']) . ' 千瓦时(度)，总费用 ' . floatval($value['price']) . ' 元';
                }
                break;
            case 'gas':
                if (empty($now_village['gas_price'])) $this->check_ajax_error_tips('当前小区不支持缴纳' . $pay_name);
                $pay_money = $now_user_info['gas_price'];
                $order_list = D('House_village_user_paylist')->field('`ydate`,`mdate`,`use_gas` AS `use`,`gas_price` AS `price`')->where(array('usernum' => $now_user_info['usernum']))->order('`pigcms_id` DESC')->select();
                foreach ($order_list as $key => $value) {
                    $order_list[$key]['desc'] = '使用燃气 ' . floatval($value['use']) . ' 立方米，总费用 ' . floatval($value['price']) . ' 元';
                }
                break;
            case 'park':
                if (empty($now_village['park_price'])) $this->check_ajax_error_tips('当前小区不支持缴纳' . $pay_name);
                $pay_money = $now_user_info['park_price'];
                $order_list = D('House_village_user_paylist')->field('`ydate`,`mdate`,`park_price` AS `price`')->where(array('usernum' => $now_user_info['usernum']))->order('`pigcms_id` DESC')->select();
                foreach ($order_list as $key => $value) {
                    $order_list[$key]['desc'] = '停车费 ' . floatval($value['price']) . ' 元';
                }
                break;
            case 'custom':
                if (empty($now_village['has_custom_pay'])) $this->check_ajax_error_tips('当前小区不支持缴纳' . $pay_name);
                break;
        }
        // dump(D('House_village_user_paylist'));exit;
        if (IS_POST) {
            if ($pay_type == 'custom') {
                if (empty($_POST['txt'])) {
                    $this->check_ajax_error_tips('请填写缴费事项');
                } else {
                    $data_order['order_name'] = '社区缴费：' . $_POST['txt'];
                }
                $_POST['money'] = floatval($_POST['money']);
                if (empty($_POST['money'])) {
                    $this->check_ajax_error_tips('请填写缴费金额');
                } else {
                    $data_order['money'] = $_POST['money'] > 10000 ? 10000 : $_POST['money'];
                }
            } else {
                $data_order['order_name'] = '缴纳' . $pay_name;
                $data_order['money'] = $pay_money > 10000 ? 10000 : $pay_money;
            }
            $data_order['uid'] = $this->user_session['uid'];
            $data_order['bind_id'] = $now_user_info['pigcms_id'];
            $data_order['village_id'] = $now_village['village_id'];
            $data_order['time'] = $_SERVER['REQUEST_TIME'];
            $data_order['paid'] = 0;
            $data_order['order_type'] = $pay_type;
            if ($order_id = D('House_village_pay_order')->data($data_order)->add()) {
                $this->header_json();
                //echo json_encode(array('err_code'=>1,'order_url'=>U('House/pay_order',array('order_id'=>$order_id))));
                echo json_encode(array('err_code' => 1, 'order_url' => U('Pay/check', array('order_id' => $order_id, 'type' => 'livepay'))));
                exit();
            } else {
                $this->check_ajax_error_tips('下单失败，请重试');
            }
            exit();
        }

        $this->assign('pay_type', $pay_type);
        $this->assign('pay_name', $pay_name);
        $this->assign('pay_money', $pay_money);
        $this->assign('order_list', $order_list);
        $this->display();
    }

    public function village_uptown_pay()
    {
//		dump($_GET['village_id']);
        $phone = $this->user_session['phone'];
        //dump($_SESSION);
        if(empty($phone)){
            $phone = $this->user_session['phone'] = $_SESSION['now_village_bind']['phone'];
        }
        if (empty($phone)) {
            $this->error_tips('为了保护您的权益，在缴费之前您必须绑定手机号码！', U('My/bind_user', array('referer' => urlencode(U('House/village_pay', $_GET)))));
        }
        $now_village = $this->get_village($_GET['village_id']);
        if (empty($this->user_session['phone'])) {
            $this->user_session['phone'] = $_SESSION['user']['phone'];
        }
        D('House_village')->get_bind_list($this->user_session['uid'], $this->user_session['phone']);
        $bind_village_list = D('House_village_user_bind')->get_user_bind_list_uptown($this->user_session['uid'], $_GET['village_id']);
        $this->village_bind = $_SESSION['now_village_bind'] = $bind_village_list[0];
//		if(!empty($bind_village_list)){
//			if(count($bind_village_list) == 1){
//				$this->village_bind = $_SESSION['now_village_bind'] = $bind_village_list[0];
//			}else{
//				redirect(U('House/village_select',array('village_id'=>$village_id,'referer'=>urlencode($_SERVER['REQUEST_URI']))));
//			}
//		}
//		dump($now_village);
////		$this->check_village_session($now_village['village_id']);
//		dump($this->village_bind);exit;
        if (empty($this->village_bind)) {
            //$this->check_ajax_error_tips('您不属于当前小区，无法使用缴费功能');
            $this->redirect(U('House/village_access_control_uptown', array('village_id' => $now_village['village_id'])));
        }
        $pay_type = $_GET['type'];
        $pay_name = $this->pay_list_type[$pay_type];
        if (empty($pay_name)) {
            $this->check_ajax_error_tips('当前访问的缴费类型不存在');
        }
        //判断用户是否属于本小区
        if (empty($this->user_session)) {
            $this->check_ajax_error_tips('请先进行登录', U('Login/index'));
        }
        $now_user_info = $this->get_user_village_info($this->village_bind['pigcms_id']);
        $rid = $this->get_room($_GET['rid']);
        $paylist = $this->get_user_village_uptown_info($this->village_bind['pigcms_id'], $rid['id'], '1');
        $pay_money = 0;
        switch ($pay_type) {
            case 'property':
                if (empty($now_village['property_price'])) $this->check_ajax_error_tips('当前小区不支持缴纳' . $pay_name);
                $room_uptown=M('house_village_room_uptown')->where('rid='.$this->room['rid'])->find();
                $property_price=M('house_village_room_type')->where('pigcms_id='.$rid['room_type'])->find();
                if (empty($room_uptown['property_endtime'])) $this->check_ajax_error_tips('此房屋暂不能进行线上缴纳' . $pay_name);
                $room_uptown_property=explode('-',$room_uptown['property_endtime']);
                $room_uptown['property_endtime_str']=$room_uptown_property['0'].'年'.$room_uptown_property['1'].'月';
                break;
            case 'carspace':
                if (empty($now_village['property_price'])) $this->check_ajax_error_tips('当前小区不支持缴纳' . $pay_name);
                $carspace_id=$_GET['carspace_id']?$_GET['carspace_id']:$_SESSION['carspace']['carspace_id'];
                $carspace_info=M('house_village_user_car')->where('pigcms_id='.$carspace_id)->find();
                if (empty($carspace_info)) $this->check_ajax_error_tips('此车位不存在' . $pay_name);
                if (empty($carspace_info['carspace_endtime'])) $this->check_ajax_error_tips('此车位暂不能进行线上缴纳' . $pay_name);
                $room_uptown_property=explode('-',$carspace_info['carspace_endtime']);
                $carspace_info['carspace_endtime_str']=$room_uptown_property['0'].'年'.$room_uptown_property['1'].'月';
                $project_info=M('house_village_project')->where('pigcms_id='.$carspace_info['project_id'])->find();
                $this->assign('project_info',$project_info);
                $this->assign('carspace_info',$carspace_info);
                break;
            case 'water':
                if (empty($now_village['water_price'])) $this->check_ajax_error_tips('当前小区不支持缴纳' . $pay_name);
                $pay_money = $now_user_info['water_price'];
                $order_list = D('House_village_user_paylist')->field('`ydate`,`mdate`,`use_water` AS `use`,`water_price` AS `price`')->where(array('usernum' => $now_user_info['usernum']))->order('`pigcms_id` DESC')->select();
                foreach ($order_list as $key => $value) {
                    $order_list[$key]['desc'] = '用水 ' . floatval($value['use']) . ' 立方米，总费用 ' . floatval($value['price']) . ' 元';
                }
                break;
            case 'electric':
                if (empty($now_village['electric_price'])) $this->check_ajax_error_tips('当前小区不支持缴纳' . $pay_name);
                $pay_money = $now_user_info['electric_price'];
                $order_list = D('House_village_user_paylist')->field('`ydate`,`mdate`,`use_electric` AS `use`,`electric_price` AS `price`')->where(array('usernum' => $now_user_info['usernum']))->order('`pigcms_id` DESC')->select();
                foreach ($order_list as $key => $value) {
                    $order_list[$key]['desc'] = '用电 ' . floatval($value['use']) . ' 千瓦时(度)，总费用 ' . floatval($value['price']) . ' 元';
                }
                break;
            case 'gas':
                if (empty($now_village['gas_price'])) $this->check_ajax_error_tips('当前小区不支持缴纳' . $pay_name);
                $pay_money = $now_user_info['gas_price'];
                $order_list = D('House_village_user_paylist')->field('`ydate`,`mdate`,`use_gas` AS `use`,`gas_price` AS `price`')->where(array('usernum' => $now_user_info['usernum']))->order('`pigcms_id` DESC')->select();
                foreach ($order_list as $key => $value) {
                    $order_list[$key]['desc'] = '使用燃气 ' . floatval($value['use']) . ' 立方米，总费用 ' . floatval($value['price']) . ' 元';
                }
                break;
            case 'park':
                if (empty($now_village['park_price'])) $this->check_ajax_error_tips('当前小区不支持缴纳' . $pay_name);
                $pay_money = $now_user_info['park_price'];
                $order_list = D('House_village_user_paylist')->field('`ydate`,`mdate`,`park_price` AS `price`')->where(array('usernum' => $now_user_info['usernum']))->order('`pigcms_id` DESC')->select();
                foreach ($order_list as $key => $value) {
                    $order_list[$key]['desc'] = '停车费 ' . floatval($value['price']) . ' 元';
                }
                break;
            case 'custom':
                if (empty($now_village['has_custom_pay'])) $this->check_ajax_error_tips('当前小区不支持缴纳' . $pay_name);
                break;
        }
        //dump($bind_village_list);
        // dump(D('House_village_user_paylist'));exit;
        if (IS_POST) {
            if(empty($_POST['paylist_form'])&&$pay_type!='property'){
                $this->error_tips('请选择账单再提交缴费！');
            }if(empty($_POST['mouth'])&&$pay_type=='property'){
                $this->error_tips('请选择缴纳的月份再缴费！');
            }else{
                $paylist_form=$_POST['paylist_form'];
            }
            //区分物业费账单生成
            if($pay_type=='property'){
                $mouth=$_POST['mouth'];
                $model=new RoomModel();
                $order_id=$model->add_propertylist($this->room['rid'],1,$mouth,'',$this->user_session['uid'],0,'');
            }else{
                $data_order['money']=$this->get_money_sum($rid['id'],$paylist_form,$pay_type);
                $data_order['pid']=implode(',',$paylist_form);
                $data_order['uid'] = $this->user_session['uid'];
                $data_order['bind_id'] = $now_user_info['pigcms_id'];
                $data_order['village_id'] = $now_village['village_id'];
                $data_order['create_time'] = $_SERVER['REQUEST_TIME'];
                $data_order['paid'] = 0;
                $data_order['order_type'] = $pay_type;
                $order_id = D('House_village_pay_order')->data($data_order)->add();
            }

            if ($order_id) {
                $this->header_json();
                //echo json_encode(array('err_code'=>1,'order_url'=>U('House/pay_order',array('order_id'=>$order_id))));
                //redirect(U('Pay/check', array('order_id' => $order_id, 'type' => 'livepay_uptown')));
                if($pay_type=='property'){
                    redirect(U('Pay/go_pay', array('order_id' => $order_id, 'order_type' => 'livepay_property','showwxpaytitle1'=>1,'pay_type'=>'weixin')));
                }else{
                    redirect(U('Pay/go_pay', array('order_id' => $order_id, 'order_type' => 'livepay_uptown','showwxpaytitle1'=>1,'pay_type'=>'weixin')));
                }
                //echo json_encode(array('err_code' => 1, 'order_url' => U('Pay/check', array('order_id' => $order_id, 'type' => 'livepay_uptown'))));
                exit();
            } else {
                $this->check_ajax_error_tips('下单失败，请重试');
            }
            exit();
        }
        //dump($paylist);
        foreach ($paylist as $key => &$value) {
            $ym = explode('-', $value['create_date']);
            $value['ydate'] = $ym['0'];
            $value['mdate'] = $ym['1'];
        }
        $this->assign('paylist', $paylist);
        $this->assign('pay_type', $pay_type);
        $this->assign('pay_type_price',$pay_type.'_price');
        $this->assign('pay_name', $pay_name);
        $this->assign('pay_money', $pay_money);
        $this->assign('order_list', $order_list);
        $this->assign('room_uptown',$room_uptown);
        $this->assign('property_price',$property_price);
        $this->assign('room_info',$rid);
        $this->display();
    }

    public function pay_order()
    {
        if (empty($this->user_session)) {
            $this->check_ajax_error_tips('请先进行登录', U('Login/index'));
        }
        $now_user = D('User')->get_user($this->user_session['uid']);
        $order_id = $_GET['order_id'];
        $now_order = D('House_village_pay_order')->where(array('order_id' => $order_id, 'uid' => $this->user_session['uid']))->find();
        if (empty($now_order)) {
            $this->check_ajax_error_tips('当前订单不存在');
        }
        if ($now_order['paid']) {
            $this->check_ajax_error_tips('当前订单已支付', U('House/my_order_detail', array('order_id' => $now_order['order_id'])));
        }
        if ($now_user['now_money'] >= $now_order['money']) {
            $use_result = D('User')->user_money($now_order['uid'], $now_order['money'], $now_order['order_name'] . ' 扣除余额');
            if ($use_result['error_code']) {
                redirect(U('House/my_order_detail', array('order_id' => $now_order['order_id'])));
            }
            $data_order['order_id'] = $order_id;
            $data_order['pay_time'] = $_SERVER['REQUEST_TIME'];
            $data_order['paid'] = 1;
            D('House_village_pay_order')->data($data_order)->save();

            if ($now_order['order_type'] != 'custom') {
                switch ($now_order['order_type']) {
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
                if (!empty($bind_field)) {
                    $now_user_info = D('House_village_user_bind')->get_one($now_order['village_id'], $now_order['bind_id'], 'pigcms');
                    $data_bind['pigcms_id'] = $now_user_info['pigcms_id'];
                    $data_bind[$bind_field] = $now_user_info[$bind_field] - $now_order['money'] > 0 ? $now_user_info[$bind_field] - $now_order['money'] : 0;
                    D('House_village_user_bind')->data($data_bind)->save();
                }
            }
            redirect(U('House/my_order_detail', array('order_id' => $now_order['order_id'])));
        } else {
            redirect(U('My/recharge', array('money' => $now_order['money'] - $now_user['now_money'], 'label' => 'wap_village_' . $order_id)));
        }
    }

    public function village_my()
    {
        //判断用户是否属于本小区
        if (empty($this->user_session)) {
            if (IS_POST) {
                $this->check_ajax_error_tips('请先进行登录', U('Login/index'));
            } else {
                redirect(U('Login/index'));
            }
        }
        $now_village = $this->get_village($_GET['village_id']);
        $this->check_village_session($now_village['village_id']);
        //dump($this->village_bind);exit;
        if (empty($this->village_bind)) {
            $this->check_ajax_error_tips('您不属于当前小区，无法进入个人中心');
        }
        $now_user_info = $this->get_user_village_info($this->village_bind['pigcms_id']);
//dump($now_user_info);exit;读的是house_village_user_bind表，个人提交的审核资料信息，个人中心处的名字就是表中的name字段
        $now_user = D('User')->get_user($this->user_session['uid']);
        $this->assign('now_user', $now_user);

        $this->display();
    }

    public function village_my_pay()
    {
        if (empty($this->user_session)) {
            $this->check_ajax_error_tips('请先进行登录', U('Login/index'));
        }
        $now_village = $this->get_village($_GET['village_id']);
        $this->check_village_session($now_village['village_id']);
        if (empty($this->village_bind)) {
            //$this->check_ajax_error_tips('您不属于当前小区，无法使用缴费功能');
            $this->redirect(U('House/village_access_control', array('village_id' => $now_village['village_id'])));
        }
        if ($now_village['village_type'] == 1) $this->redirect(U('village_uptown_my_room_select', array('village_id' => $_GET['village_id'])));
        $now_user_info = $this->get_user_village_info($this->village_bind['pigcms_id']);

        //缴费
        $pay_list = array();
        $now_village['property_price'] = floatval($now_village['property_price']);
        $now_village['water_price'] = floatval($now_village['water_price']);
        $now_village['electric_price'] = floatval($now_village['electric_price']);
        $now_village['gas_price'] = floatval($now_village['gas_price']);
        $now_village['park_price'] = floatval($now_village['park_price']);
        if ($now_village['property_price']) {
            $pay_list[] = array(
                'type' => 'property',
                'name' => $this->pay_list_type['property'],
                'url' => U('House/village_pay', array('village_id' => $now_village['village_id'], 'type' => 'property')),
                'money' => floatval($now_user_info['property_price']),
            );
        }
        if ($now_village['water_price']) {
            $pay_list[] = array(
                'type' => 'water',
                'name' => $this->pay_list_type['water'],
                'url' => $now_village['water_price'] ? U('House/village_pay', array('village_id' => $now_village['village_id'], 'type' => 'water')) : U('Lifeservice/query', array('type' => 'water')),
                'money' => floatval($now_user_info['water_price']),
            );
        }
        if ($now_village['electric_price']) {
            $pay_list[] = array(
                'type' => 'electric',
                'name' => $this->pay_list_type['electric'],
                'url' => U('House/village_pay', array('village_id' => $now_village['village_id'], 'type' => 'electric')),
                'money' => floatval($now_user_info['electric_price']),
            );
        }
        if ($now_village['gas_price']) {
            $pay_list[] = array(
                'type' => 'gas',
                'name' => $this->pay_list_type['gas'],
                'url' => U('House/village_pay', array('village_id' => $now_village['village_id'], 'type' => 'gas')),
                'money' => floatval($now_user_info['gas_price']),
            );
        }
        if ($now_village['park_price']) {
            $pay_list[] = array(
                'type' => 'park',
                'name' => $this->pay_list_type['park'],
                'url' => U('House/village_pay', array('village_id' => $now_village['village_id'], 'type' => 'park')),
                'money' => floatval($now_user_info['park_price']),
            );
        }
        if ($now_village['has_custom_pay']) {
            $pay_list[] = array(
                'type' => 'custom',
                'name' => $this->pay_list_type['custom'],
                'url' => U('House/village_pay', array('village_id' => $now_village['village_id'], 'type' => 'custom')),
                'money' => -1,
            );
        }
        $this->assign('pay_list', $pay_list);

        $this->display();
    }

    /**
     * @author zhukeqin
     * 自动跳转或选择房产
     */
    public function village_uptown_my_room_select()
    {
        if (empty($this->user_session)) {
            $this->check_ajax_error_tips('请先进行登录', U('Login/index'));
        }
        $now_village = $this->get_village($_GET['village_id']);
        $this->check_village_session($now_village['village_id']);
        if (empty($this->village_bind)) {
            $this->redirect(U('House/access_control_change_uptown', array('village_id' => $now_village['village_id'])));
        }
        $uid = $this->village_bind['pigcms_id'];
        $map = array(
            'village_id' => $now_village['village_id'],
            '_string' => 'find_in_set("' . $uid . '",oid)'
        );
        $roomlist = M('house_village_room')->where($map)->select();
        foreach ($roomlist as &$value){
            $value['project_name']=M('house_village_project')->where('pigcms_id='.$value['project_id'])->find()['desc'];
        }
        if (empty($roomlist)) {
            $this->check_ajax_error_tips('您在此小区还没有房产', U('House/access_control_change_uptown'));
        } /*elseif (count($roomlist) == 1) {
            $_SESSION['room']['rid'] = $roomlist['0']['id'];
            $this->redirect(U('village_uptown_my_pay', array('village_id' => $now_village['village_id'], 'rid' => $roomlist['0']['id'])));
        }*/ else {
            $this->assign('village_id',$now_village['village_id']);
            $this->assign('roomlist', $roomlist);
            $this->display();
        }

    }

    public function village_uptown_my_pay()
    {
        if (empty($this->user_session)) {
            $this->check_ajax_error_tips('请先进行登录', U('Login/index'));
        }
        $now_village = $this->get_village($_GET['village_id']);
        $this->check_village_session($now_village['village_id']);
        if (empty($this->village_bind)) {
            //$this->check_ajax_error_tips('您不属于当前小区，无法使用缴费功能');
            $this->redirect(U('House/village_access_control', array('village_id' => $now_village['village_id'])));
        }
        $rid = $this->get_room($_GET['rid']);
        $now_user_info = $this->get_user_village_uptown_sum($this->village_bind['pigcms_id'], $rid['id']);
        $room_uptown=M('house_village_room_uptown')->where('rid='.$_GET['rid'])->find();
        $room_uptown_property=explode('-',$room_uptown['property_endtime']);
        $room_uptown['property_endtime']=$room_uptown_property['0'].'年'.$room_uptown_property['1'].'月';
        $room_carspace=M('house_village_user_car')->where('rid='.$_GET['rid'])->select();
        if(empty($room_carspace)){
            $car_url='';
            $car_money='';
        }elseif(count($room_carspace)==1){
            $room_carspace=$room_carspace['0'];
            if(empty($room_carspace['carspace_endtime'])){
                $car_url='';
                $car_money='';
            }else{
                $car_url=U('House/village_uptown_my_carspace_select', array('village_id' => $now_village['village_id'],'rid'=>$rid));
                $room_carspace_endtimelist=explode('-',$room_carspace['carspace_endtime']);
                $car_money=$room_carspace_endtimelist['0'].'年'.$room_carspace_endtimelist['1'].'月';
            }

        }else{
            $car_url=U('House/village_uptown_my_carspace_select', array('village_id' => $now_village['village_id'],'rid'=>$rid));
            $car_money='点击查看更多';
        }
        //缴费
        $pay_list = array();
        $now_village['property_price'] = floatval($now_village['property_price']);
        $now_village['carspace_price'] = floatval($now_village['carspace_price']);
        $now_village['water_price'] = floatval($now_village['water_price']);
        $now_village['electric_price'] = floatval($now_village['electric_price']);
        $now_village['gas_price'] = floatval($now_village['gas_price']);
        $now_village['park_price'] = floatval($now_village['park_price']);
            $pay_list[] = array(
                'type' => 'property',
                'name' => $this->pay_list_type['property'],
                'url' => $room_uptown['property_endtime']? U('House/village_uptown_pay', array('village_id' => $now_village['village_id'], 'type' => 'property')):'',
                'money' => $room_uptown['property_endtime']? $room_uptown['property_endtime']:'暂无法缴费',
            );
        $pay_list[] = array(
            'type' => 'park',
            'name' => $this->pay_list_type['carspace'],
            'url' => $car_url,
            'money' => $car_money,
        );
        if ($now_village['water_price']) {
            $pay_list[] = array(
                'type' => 'water',
                'name' => $this->pay_list_type['water'],
                'url' => $now_village['water_price'] ? U('House/village_uptown_pay', array('village_id' => $now_village['village_id'], 'type' => 'water')) : U('Lifeservice/query', array('type' => 'water')),
                'money' => floatval($now_user_info['water_price']),
            );
        }
        if ($now_village['electric_price']) {
            $pay_list[] = array(
                'type' => 'electric',
                'name' => $this->pay_list_type['electric'],
                'url' => U('House/village_uptown_pay', array('village_id' => $now_village['village_id'], 'type' => 'electric')),
                'money' => floatval($now_user_info['electric_price']),
            );
        }
        if ($now_village['gas_price']) {
            $pay_list[] = array(
                'type' => 'gas',
                'name' => $this->pay_list_type['gas'],
                'url' => U('House/village_uptown_pay', array('village_id' => $now_village['village_id'], 'type' => 'gas')),
                'money' => floatval($now_user_info['gas_price']),
            );
        }
        /*if ($now_village['park_price']) {
            $pay_list[] = array(
                'type' => 'park',
                'name' => $this->pay_list_type['park'],
                'url' => U('House/village_uptown_pay', array('village_id' => $now_village['village_id'], 'type' => 'park')),
                'money' => floatval($now_user_info['park_price']),
            );
        }*/
        if ($now_village['has_custom_pay']) {
            $pay_list[] = array(
                'type' => 'custom',
                'name' => $this->pay_list_type['custom'],
                'url' => U('House/village_uptown_pay', array('village_id' => $now_village['village_id'], 'type' => 'custom')),
                'money' => -1,
            );
        }
        $this->assign('pay_list', $pay_list);

        $this->display();
    }
    public function village_uptown_my_pay_back(){
        $village_id=$_GET['village_id'];
        $rid=$_GET['rid'];
        $order_id=$_GET['order_id'];
        $order_info=D('House_village_room_propertylist')->get_order_by_id($this->user_session['uid'],$order_id);
        if(empty($order_info)){
            $this->error('订单不存在');
        }
        if($order_info['status']!=1){
            $this->error('订单没有支付完成！',U('village_uptown_my_pay',array('village_id'=>$village_id,'rid'=>$rid)));
        }
        $room_uptown_property=explode('-',$order_info['new_endtime']);
        $order_info['new_endtime_str']=$room_uptown_property['0'].'年'.$room_uptown_property['1'].'月';
        $this->success('您的订单已经支付完成！<br/>成功缴纳'.$order_info['mouth'].'个月物业费<br/>已缴纳至'.$order_info['new_endtime_str'],U('village_uptown_my_pay',array('village_id'=>$village_id,'rid'=>$rid)));
    }
    public function village_uptown_my_pay_back_carspace(){
        $village_id=$_GET['village_id'];
        $rid=$_GET['rid'];
        $order_id=$_GET['order_id'];
        $order_info=D('House_village_room_carspacelist')->get_order_by_id($this->user_session['uid'],$order_id);
        if(empty($order_info)){
            $this->error('订单不存在');
        }
        if($order_info['status']!=1){
            $this->error('订单没有支付完成！',U('village_uptown_my_carspace_select',array('village_id'=>$village_id,'rid'=>$rid)));
        }
        $room_uptown_property=explode('-',$order_info['new_endtime']);
        $order_info['new_endtime_str']=$room_uptown_property['0'].'年'.$room_uptown_property['1'].'月';
        $this->success('您的订单已经支付完成！<br/>成功缴纳'.$order_info['mouth'].'个月泊位费<br/>已缴纳至'.$order_info['new_endtime_str'],U('village_uptown_my_carspace_select',array('village_id'=>$village_id,'rid'=>$rid)));
    }
    /**
     * @author zhukeqin
     * 自动跳转或选择车位
     */
    public function village_uptown_my_carspace_select()
    {
        if (empty($this->user_session)) {
            $this->check_ajax_error_tips('请先进行登录', U('Login/index'));
        }
        $now_village = $this->get_village($_GET['village_id']);
        $this->check_village_session($now_village['village_id']);
        if (empty($this->village_bind)) {
            $this->redirect(U('House/village_access_control', array('village_id' => $now_village['village_id'])));
        }
        $uid = $this->village_bind['pigcms_id'];
        $rid=$this->get_room();
        if (empty($rid)) {
            $this->check_ajax_error_tips('请先选择房产', U('village_uptown_my_room_select'));
        } /*elseif (count($roomlist) == 1) {
            $_SESSION['room']['rid'] = $roomlist['0']['id'];
            $this->redirect(U('village_uptown_my_pay', array('village_id' => $now_village['village_id'], 'rid' => $roomlist['0']['id'])));
        }*/
        $carspace_list=M('house_village_user_car')->where('rid='.$rid['id'])->select();
        if(count($carspace_list)==1){
            $_SESSION['carspace']['carspace_id'] = $carspace_list['0']['pigcms_id'];
            $this->redirect(U('House/village_uptown_pay', array('village_id' => $now_village['village_id'], 'type' => 'carspace')));
        }else{
            $this->assign('village_id',$now_village['village_id']);
            $this->assign('carspace_list', $carspace_list);
            $this->display();
        }


    }
    public function village_my_paylists()
    {
        if (empty($this->user_session)) {
            $this->check_ajax_error_tips('请先进行登录', U('Login/index'));
        }
        $now_village = $this->get_village($_GET['village_id']);
        $this->check_village_session($now_village['village_id']);
        if (empty($this->village_bind)) {
            //$this->check_ajax_error_tips('您不属于当前小区，无法使用缴费功能');
            $this->redirect(U('House/village_access_control', array('village_id' => $now_village['village_id'])));
        }
        $now_user_info = $this->get_user_village_info($this->village_bind['pigcms_id']);

        $now_user = D('User')->get_user($this->user_session['uid']);

        $order_list = D('House_village_pay_order')->field(true)->where(array('bind_id' => $now_user_info['pigcms_id'], 'village_id' => $now_village['village_id'], 'paid' => '1'))->order('`order_id` DESC')->select();
        $this->assign('order_list', $order_list);

        $this->display();
    }

    public function village_my_repairlists()
    {
        if (empty($this->user_session)) {
            $this->check_ajax_error_tips('请先进行登录', U('Login/index'));
        }
        $now_village = $this->get_village($_GET['village_id']);
        $this->check_village_session($now_village['village_id']);
        if (empty($this->village_bind)) {
            //$this->check_ajax_error_tips('您不属于当前小区，无法使用报修功能');
            $this->redirect(U('House/village_access_control', array('village_id' => $now_village['village_id'])));
        }
        $now_user_info = $this->get_user_village_info($this->village_bind['pigcms_id']);

        $repair_list = D('House_village_repair_list')->field(true)->where(array('bind_id' => $now_user_info['pigcms_id'], 'village_id' => $now_village['village_id'], 'type' => '1'))->order('`pigcms_id` DESC')->select();
        $this->assign('repair_list', $repair_list);

        $this->display();
    }

    public function village_my_repair_detail()
    {
        if (empty($this->user_session)) {
            $this->check_ajax_error_tips('请先进行登录', U('Login/index'));
        }
        $now_village = $this->get_village($_GET['village_id']);
        $this->check_village_session($now_village['village_id']);
        if (empty($this->village_bind)) {
            //$this->check_ajax_error_tips('您不属于当前小区，无法使用报修功能');
            $this->redirect(U('House/village_access_control', array('village_id' => $now_village['village_id'])));
        }
        $now_user_info = $this->get_user_village_info($this->village_bind['pigcms_id']);

        $repair_detail = D('House_village_repair_list')->field(true)->where(array('pigcms_id' => $_GET['id']))->find();
        if (empty($repair_detail)) {
            $this->check_ajax_error_tips('当前报修内容不存在');
        }
        if ($repair_detail['pic']) {
            $repair_detail['picArr'] = explode('|', $repair_detail['pic']);
        }
        $this->assign('repair_detail', $repair_detail);

        $this->display();
    }

    /*
	 *
	 * 旧版首页报修页面
	 * */
    public function village_my_repair()
    {
        if (empty($this->user_session)) {
            $this->check_ajax_error_tips('请先进行登录', U('Login/index'));
        }
        $now_village = $this->get_village($_GET['village_id']);
        $this->check_village_session($now_village['village_id']);
        if (empty($this->village_bind)) {
            //$this->check_ajax_error_tips('您不属于当前小区，无法使用报修功能');
            $this->redirect(U('House/village_access_control', array('village_id' => $now_village['village_id'])));
        }
        $now_user_info = $this->get_user_village_info($this->village_bind['pigcms_id']);

        if (IS_POST) {
            if (empty($_POST['content'])) {
                $this->check_ajax_error_tips('请填写内容');
            }
            $inputimg = isset($_POST['inputimg']) ? $_POST['inputimg'] : '';
            $picArr = array();
            if (!empty($inputimg)) {
                foreach ($inputimg as $imgv) {
                    $imgv = str_replace('/upload/house/', '', $imgv);
                    $picArr[] = $imgv;
                }
            }
            $data_repair['pic'] = implode('|', $picArr);
            $data_repair['content'] = $_POST['content'];
            $data_repair['village_id'] = $now_village['village_id'];
            $data_repair['uid'] = $this->user_session['uid'];
            $data_repair['bind_id'] = $now_user_info['pigcms_id'];
            $data_repair['is_read'] = '0';
            $data_repair['type'] = '1';
            $data_repair['time'] = $_SERVER['REQUEST_TIME'];
            if (D('House_village_repair_list')->data($data_repair)->add()) {
                $this->header_json();
                echo json_encode(array('err_code' => 1, 'order_url' => U('House/pay_order', array('order_id' => $order_id))));
                exit();
            } else {
                $this->check_ajax_error_tips('提交失败，请重试');
            }
        } else {
            $this->display();
        }
    }


    /*
	 *
	 * 新版报修页面
	 * */

    public function village_my_repair_new()
    {
        //先检查是否为登陆状态
        //vd($_SESSION);
        if (empty($this->user_session)) {
            $this->check_ajax_error_tips('请先进行登录', U('Login/index'));
        }
        //检查该小区是否已经开通了报修功能
        $now_village = $this->get_village($_GET['village_id']);
        $this->check_village_session($now_village['village_id']);
        if (empty($this->village_bind)) {
            //$this->check_ajax_error_tips('您不属于当前小区，无法使用报修功能');
            $this->redirect(U('House/village_access_control', array('village_id' => $now_village['village_id'])));
        }

        $repair_type_array = M('repair_type')->where(array('is_del' => 0))->select();
        $this->assign('repair_type_array', $repair_type_array);
        $this->display();

    }


    /*
	 *AJAX 根据前台传来的信息，返回相应的表格
	 * */
    public function ajax_repair_table()
    {
        //接受关于维修项目的id
        $is_cost = 1;
        $repair_type_id = I('post.repair_type');
        //查询对应的项目列表中的数据
        $repair_project = M('repair_project')->where(array('type_id' => $repair_type_id, 'is_cost' => $is_cost))->select();
        $html_table = '<tr><td width="60%" height="40" align="center" bgcolor="#f1f1f1" style="border:1px #d3d4d6 solid; color:#333333;">服务项目</td><td width="20%" height="40" align="center" bgcolor="#f1f1f1" style="border:1px #d3d4d6 solid; border-left:none; color:#333333;">价格</td><td width="20%" height="40" align="center" bgcolor="#f1f1f1" style="border:1px #d3d4d6 solid; border-left:none; color:#333333;">选择</td></tr>';
        if ($repair_project == null) {
            //为空的时候没有数据
            $html_table .= '<tr><td colspan="3" height="40" align="center" bgcolor="#f8f9fb" style="border:1px #d3d4d6 solid; border-top:none; color:#676767; font-size:14px;">没有相关服务项目</td></tr>';
        } else {
            //查询有数据的时候拼接前台表格
            foreach ($repair_project as $value) {
                $html_table .= '<tr><td height="40" align="center" bgcolor="#f8f9fb" style="border:1px #d3d4d6 solid; border-top:none; color:#676767; font-size:14px;">' . $value['project_name'] . '</td><td height="40" align="center" bgcolor="#f8f9fb" style="border:1px #d3d4d6 solid; border-left:none; border-top:none; color:#676767; font-size:14px;">￥' . $value['cost'] . '</td><td height="40" align="center" bgcolor="#f8f9fb" style="border:1px #d3d4d6 solid; border-left:none; border-top:none; color:#676767; font-size:14px;"><button style="border:none; background-color:#0697dc; color:#ffffff; border-radius:4px; line-height:25px;">选择</button></td></tr>';
            }
        }

        echo $html_table;
    }

    /*
	 * AJAX 根据前台传来的信息，进行表单提交上报
	 * */
    public function ajax_submit_form()
    {
        //dump($_POST); exit();
        //接受关于表单提交的必要信息
        $content = I('post.content');
        $contact = I('post.contact');
        $village_id = I('post.village_id');
        $image = I('post.image');
        $details = I('post.details');
        $data_repair = array();
        //报修内容
        $data_repair['content'] = $content;
        //报修的小区
        $data_repair['village_id'] = $village_id;
        //报修的人id
        $data_repair['uid'] = $_SESSION['user']['uid'];
        $data_repair['bind_id'] = M('house_village_user_bind')->where(array('uid' => $_SESSION['user']['uid']))->getField('pigcms_id');
        $data_repair['is_read'] = '0';
        //报修人联系方式
        $data_repair['contact'] = $contact;
        //报修为在线报修
        $data_repair['type'] = '1';
        //报修备注
        $data_repair['details'] = $details;
        //报修时间
        $data_repair['time'] = $_SERVER['REQUEST_TIME'];
        //报修图片
        if (count($image) > 1) {
            //有多个数组
            $picArr = array();
            if (!empty($image)) {
                foreach ($image as $imgv) {
                    $imgv = str_replace('/upload/house/', '', $imgv);
                    $picArr[] = $imgv;
                }
            }
            //拼接为字符串
            $data_repair['pic'] = implode('|', $picArr);
        } else {
            //处理字符串
            $data_repair['pic'] = str_replace('/upload/house/', '', $image[0]);
        }
        //$data_repair['pic'] = $image;
        //vd($data_repair);exit;
        //提交表单并且增加到数据库中
        $res = M('House_village_repair_list')->data($data_repair)->add();

        if ($res) {
            //成功插入,发送消息
            $wechat = new WechatModel();
            $tpl_id = $wechat::TPLID_WYGLTZ;
            //获取管理员opnenids
            $role_id = 42;//TODO::维修人员 role_id = 51 也是维修人员 不知道有什么差别 最好改为40
            $admins = M('admin')->where('role_id=%d', $role_id)->select();
            $openids = array_column($admins, 'openid');
//            $openids = array(
//                'ohgcf0jY6c8Rnj8hgkJw8mcVpOR8'
//            );
            $data = array(
                'first' => array(
                    'value' => "在线报修业务提醒",
                    'color' => "#029700",
                ),
                'keyword1' => array(
                    'value' => $data_repair['content'],
                    'color' => "#000000",
                ),
                'keyword2' => array(
                    'value' => date("Y-m-d H:i"),
                    'color' => "#000000",
                ),
                'keyword3' => array(
                    'value' => msubstr($data_repair['details'], 0, 16),
                    'color' => "#000000",
                ),
                'keyword4' => array(
                    'value' => "点击查看详情",
                    'color' => "#000000",
                ),
            );
            $url = C('WEB_DOMAIN') . '/wap.php?g=Wap&c=PropertyService&a=repair_inform&repair_id=' . $res;
            $wechat->send_tpl_messages($openids, $tpl_id, $url, $data);
            ////发送消息结束

            echo 1;
            return true;
        } else {
            //插入失败
            echo 2;
            return false;
        }

    }


    //获取社区名称
    public function get_village_list($village_id = 0)
    {
        $tmp = M('house_village')->field('village_id,village_name')->select();
        $village_list = array();
        foreach ($tmp as $row) {
            $village_list[$row['village_id']] = $row['village_name'];
        }
        if ($village_id) return $village_list[$village_id];
        return $village_list;
    }


    /*
	 * AJAX 图片文件上传提交
	 * */
    public function ajax_upload()
    {
        vd($_FILES);
    }


    public function village_my_utilitieslists()
    {
        if (empty($this->user_session)) {
            $this->check_ajax_error_tips('请先进行登录', U('Login/index'));
        }
        $now_village = $this->get_village($_GET['village_id']);
        $this->check_village_session($now_village['village_id']);
        if (empty($this->village_bind)) {
            $this->redirect(U('House/village_access_control', array('village_id' => $now_village['village_id'])));
        }
        $now_user_info = $this->get_user_village_info($this->village_bind['pigcms_id']);

        $repair_list = D('House_village_repair_list')->field(true)->where(array('bind_id' => $now_user_info['pigcms_id'], 'village_id' => $now_village['village_id'], 'type' => '2'))->order('`pigcms_id` DESC')->select();
        $this->assign('repair_list', $repair_list);

        $this->display();
    }

    public function village_my_utilities_detail()
    {
        if (empty($this->user_session)) {
            $this->check_ajax_error_tips('请先进行登录', U('Login/index'));
        }
        $now_village = $this->get_village($_GET['village_id']);
        $this->check_village_session($now_village['village_id']);
        if (empty($this->village_bind)) {
            $this->redirect(U('House/village_access_control', array('village_id' => $now_village['village_id'])));
        }
        $now_user_info = $this->get_user_village_info($this->village_bind['pigcms_id']);

        $repair_detail = D('House_village_repair_list')->field(true)->where(array('pigcms_id' => $_GET['id']))->find();
        if (empty($repair_detail)) {
            $this->check_ajax_error_tips('当前报修内容不存在');
        }
        if ($repair_detail['pic']) {
            $repair_detail['picArr'] = explode('|', $repair_detail['pic']);
        }
        $this->assign('repair_detail', $repair_detail);

        $this->display();
    }

    public function village_my_utilities()
    {
        if (empty($this->user_session)) {
            $this->check_ajax_error_tips('请先进行登录', U('Login/index'));
        }
        $now_village = $this->get_village($_GET['village_id']);
        $this->check_village_session($now_village['village_id']);
        if (empty($this->village_bind)) {
            //$this->check_ajax_error_tips('您不属于当前小区，无法使用缴费功能');
            $this->redirect(U('House/village_access_control', array('village_id' => $now_village['village_id'])));
        }
        $now_user_info = $this->get_user_village_info($this->village_bind['pigcms_id']);

        if (IS_POST) {
            if (empty($_POST['content'])) {
                $this->check_ajax_error_tips('请填写内容');
            }
            $inputimg = isset($_POST['inputimg']) ? $_POST['inputimg'] : '';
            $picArr = array();
            if (!empty($inputimg)) {
                foreach ($inputimg as $imgv) {
                    $imgv = str_replace('/upload/house/', '', $imgv);
                    $picArr[] = $imgv;
                }
            }
            $data_repair['pic'] = implode('|', $picArr);
            $data_repair['content'] = $_POST['content'];
            $data_repair['village_id'] = $now_village['village_id'];
            $data_repair['uid'] = $this->user_session['uid'];
            $data_repair['bind_id'] = $now_user_info['pigcms_id'];
            $data_repair['is_read'] = '0';
            $data_repair['type'] = '2';
            $data_repair['time'] = $_SERVER['REQUEST_TIME'];
            if (D('House_village_repair_list')->data($data_repair)->add()) {
                $this->header_json();
                echo json_encode(array('err_code' => 1, 'order_url' => U('House/pay_order', array('order_id' => $order_id))));
                exit();
            } else {
                $this->check_ajax_error_tips('提交失败，请重试');
            }
        } else {
            $this->display();
        }
    }

    public function village_my_suggest()
    {
        if (empty($this->user_session)) {
            $this->check_ajax_error_tips('请先进行登录', U('Login/index'));
        }
        $now_village = $this->get_village($_GET['village_id']);
        $this->check_village_session($now_village['village_id']);
        if (empty($this->village_bind)) {
            //$this->check_ajax_error_tips('您不属于当前小区，无法使用投诉功能');
            $this->redirect(U('House/village_access_control', array('village_id' => $now_village['village_id'])));
        }
        $now_user_info = $this->get_user_village_info($this->village_bind['pigcms_id']);

        if (IS_POST) {
            if (empty($_POST['content'])) {
                $this->check_ajax_error_tips('请填写内容');
            }
            $inputimg = isset($_POST['inputimg']) ? $_POST['inputimg'] : '';
            $picArr = array();
            if (!empty($inputimg)) {
                foreach ($inputimg as $imgv) {
                    $imgv = str_replace('/upload/house/', '', $imgv);
                    $picArr[] = $imgv;
                }
            }
            $data_repair['pic'] = implode('|', $picArr);
            $data_repair['content'] = $_POST['content'];
            $data_repair['village_id'] = $now_village['village_id'];
            $data_repair['uid'] = $this->user_session['uid'];
            $data_repair['bind_id'] = $now_user_info['pigcms_id'];
            $data_repair['is_read'] = '0';
            $data_repair['type'] = '3';
            $data_repair['time'] = $_SERVER['REQUEST_TIME'];
            if (D('House_village_repair_list')->data($data_repair)->add()) {
                $this->header_json();
                echo json_encode(array('err_code' => 1, 'order_url' => U('House/pay_order', array('order_id' => $order_id))));
                exit();
            } else {
                $this->check_ajax_error_tips('提交失败，请重试');
            }
        } else {
            $this->display();
        }
    }

    /*     * *图片上传** */
    public function ajaxImgUpload()
    {
        $filename = trim($_POST['filename']);
        $img = $_POST[$filename];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $imgdata = base64_decode($img);
        $img_order_id = sprintf("%09d", $this->user_session['uid']);
        $rand_num = mt_rand(10, 99) . '/' . substr($img_order_id, 0, 3) . '/' . substr($img_order_id, 3, 3) . '/' . substr($img_order_id, 6, 3);
        $getupload_dir = "/upload/house/" . $rand_num;

        $upload_dir = "." . $getupload_dir;
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $newfilename = date('YmdHis') . '.jpg';
        $save = file_put_contents($upload_dir . '/' . $newfilename, $imgdata);
        $save = file_put_contents($upload_dir . '/m_' . $newfilename, $imgdata);
        $save = file_put_contents($upload_dir . '/s_' . $newfilename, $imgdata);
        if ($save) {
            $this->dexit(array('error' => 0, 'data' => array('code' => 1, 'siteurl' => $this->config['site_url'], 'imgurl' => $getupload_dir . '/' . $newfilename, 'msg' => '')));
        } else {
            $this->dexit(array('error' => 1, 'data' => array('code' => 0, 'url' => '', 'msg' => '保存失败！')));
        }
    }

    /*     * json 格式封装函数* */
    private function dexit($data = '')
    {
        if (is_array($data)) {
            echo json_encode($data);
        } else {
            echo $data;
        }
        exit();
    }

    protected function get_user_village_info($bind_id)
    {
        $now_user_info = D('House_village_user_bind')->get_one_by_bindId($bind_id);
        if (empty($now_user_info)) {
            $this->check_ajax_error_tips('您不是该小区业主');
        }
        //获取账单信息
        $nowList = date('Y-m');
        $payList = M('house_village_user_paylist')->where(array('uid' => $now_user_info['uid'], 'create_date' => $nowList))->find();
        $this->assign('now_user_info', $payList);
        return $payList;
    }

    /**
     * 获取账单详情 小区版本
     * @author zhukeqin
     * @param $bind_id
     * @return mixed
     */
    protected function get_user_village_uptown_info($bind_id, $rid, $type = '')
    {
        $now_user_info = D('House_village_user_bind')->get_one_by_bindId($bind_id);
        if (empty($now_user_info)) {
            $this->check_ajax_error_tips('您不是该小区业主');
        }
        //获取账单信息
        //$nowList = date('Y-m');
        $search = array('rid' => $rid);
        $search['is_enter_list'] = '1';
        $search['is_create'] = '0';
        if (empty($type)) {
            $search['is_create'] = '1';
            //暂时不显示未出账订单
            /*unset($search['is_enter_list']);*/
        }
        $payList = M('house_village_user_paylist')->where($search)->select();
        $this->assign('now_paylist', $payList);
        return $payList;
    }

    /**
     * 获取未付款账单金额总和 小区版本
     * @author zhukeqin
     * @param $bind_id
     * @return mixed
     */
    protected function get_user_village_uptown_sum($bind_id, $rid)
    {
        $payList = $this->get_user_village_uptown_info($bind_id, $rid, '1');
        $payList_info = array('water_price' => 0, 'electric_price' => 0, 'gas_price' => 0, 'park_price' => 0, 'property_price' => 0, 'other_price' => 0);
        foreach ($payList as $key => $value) {
            $payList_info['water_price'] += $value['water_price'];
            $payList_info['electric_price'] += $value['electric_price'];
            $payList_info['gas_price'] += $value['gas_price'];
            $payList_info['park_price'] += $value['park_price'];
            $payList_info['property_price'] += $value['property_price'];
            $payList_info['other_price'] += $value['other_price'];
        }
        return $payList_info;
    }

    protected function check_ajax_error_tips($err_tips, $err_url = '')
    {
        if (IS_POST) {
            $this->header_json();
            echo json_encode(array('err_code' => -1, 'err_msg' => $err_tips, 'err_url' => $err_url));
            exit();
        } else {
            if ($err_url) {
                $this->error_tips($err_tips, $err_url);
            } else {
                $this->error_tips($err_tips);
            }
        }
    }

    protected function get_village($village_id)
    {
        $now_village = D('House_village')->get_one($village_id);
        if (empty($now_village)) {
            $this->error_tips('当前访问的小区不存在或未开放');
        }
        $this->assign('now_village', $now_village);
        return $now_village;
    }

    /**
     * @author zhukeqin
     * @param $rid
     * @return array
     */
    protected function get_room($rid)
    {
        $uid = $this->village_bind['pigcms_id'];
        if (empty($rid)) {
            $rid = $this->room['rid'];
        }
        if (empty($this->room['rid']) && !empty($rid)) {
            $_SESSION['room']['rid'] = $rid;
        }
        $map = array(
            'r.id' => $rid,
            '_string' => 'find_in_set("' . $uid . '",r.oid)'
        );
        $field = array(
            'r.*',
            'p.*',
            'p.desc' => 'project_desc'
        );
        $now_room = M('House_village_room')->alias('r')->field($field)->where($map)
            ->join('left join __HOUSE_VILLAGE_PROJECT__ p on r.project_id=p.pigcms_id')->find();
        if (empty($now_room)) {
            $this->error_tips('当前房产不存在或您不是该房产的业主');
        }
        $this->assign('now_room', $now_room);
        return $now_room;
    }
    /**
     * @author zhukeqin
     * 获取需要支付的总金额
     */
    protected function get_money_sum($rid,$paylist,$pay_type)
    {
        $paylist_info=M('house_village_user_paylist')->where(array('rid'=>$rid,'pigcms_id'=>array('IN',$paylist)))->select();
        if(empty($paylist_info)){
            $this->error_tips('找不到任意的选中账单，请重试！');
        }
        $money=0;
        foreach ($paylist_info as $key=>$value){
            $money +=$value[$pay_type.'_price'];
        }
        return $money;
    }
    /**
     * 业主的常用手机号码前台显示
     * 汪威
     * 2016.4.18
     */
    public function commonphone_index()
    {
        $condition['village_id'] = $this->village_id;
        $info = M('house_commonphone');
        $ct_info = M('house_commontype');
        $ct_message = $ct_info->where('village_id =' . $condition['village_id'])->select();
        foreach ($ct_message as $ke => $va) {
            $cp_message = $info->where(array('village_id' => $condition['village_id'], 'ct_id' => $va['ct_id']))->order('ct_id DESC')->select();
            if (empty($cp_message)) {
                unset($ct_message[$ke]);
            } else {
                foreach ($cp_message as $key => $val) {
                    $ct_message[$ke]['ct'][$key]['name'] = $val['nickname'];
                    $ct_message[$ke]['ct'][$key]['phone'] = $val['iphone'];
                }
            }

        }
        $this->assign('ct_message', $ct_message);
        $this->display();
    }

    /* 智能门禁
	* @time 2016-06-6
	* @author	小邓  <969101097@qq.com>*/
    public function village_access_control()
    {
        $now_village = $this->get_village($_GET['village_id']);
        if ($_GET['ac_id']) {    //判断是否是扫设备码进入
            import('ORG.Net.Http');
            $http = new Http();
            $access_token = D('Access_token_expires')->get_access_token()['access_token'];
            $return = $http->curlGet('https://api.weixin.qq.com/cgi-bin/user/info?access_token=' . $access_token . '&openid=' . $this->user_session['openid'] . '&lang=zh_CN');
            $jsonrt = json_decode($return, true);
            if ($jsonrt && !$jsonrt['subscribe']) {    //判断是否已关注
                $this->redirect(U('House/access_control_show', array('village_id' => $_GET['village_id'], 'msg' => '请先关注汇得行智慧助手公众号后使用微信开门功能！')));
            }
        }
        if (empty($this->user_session)) {
            $this->check_ajax_error_tips('请先进行登录', U('Login/index'));
        }
        $where_data = array(
            'uid' => $this->user_session['uid'],
            'village_id' => $_GET['village_id']
        );
        if (IS_POST) {
            if (empty($_POST['truename'])) {
                $this->check_ajax_error_tips('请填写真实姓名');
            } else {
                $_POST['name'] = $_POST['truename'];
                unset($_POST['truename']);
            }
            if (empty($_POST['phone'])) {
                $this->check_ajax_error_tips('请填写手机号码');
            }
            //配合小区  去掉公司验证
            if (empty($_POST['company_id'])) {
                if ($now_village['village_type'] == 1) {
                    $_POST['company_id'] = 2;
                    $_POST['is_updown'] = 1;
                } else {
                    $this->check_ajax_error_tips('请选择公司');
                }
            }
            if (empty($_POST['usernum']) && $now_village['village_type'] == 0) {
                $_POST['usernum'] = time();
            }
            $inputimg = isset($_POST['inputimg']) ? $_POST['inputimg'] : '';
            if (!empty($inputimg)) {
                $pic_arr = array();
                foreach ($inputimg as $imgv) {
                    $imgv = str_replace('/upload/house/', '', $imgv);
                    $pic_arr[] = $imgv;
                }
                $_POST['workcard_img'] = implode('|', $pic_arr);    //图片(即证件)
            }
            $phone = M('house_village_user_bind')->where(array('uid' => array('neq', $this->user_session['uid']), 'village_id' => $_GET['village_id'], 'phone' => $_POST['phone']))->getField('phone');
            if ($phone == $_POST['phone'] && $now_village['village_type'] == 0) {    //判断非本人时此手机号码是否存在
                header('Content-type: application/json');
                echo json_encode(array('err_code' => 1, 'err_msg' => '此手机号码已存在请重新填写'));
                exit;
            }
            $addtime = M('user_modifypwd')->where(array('telphone' => $_POST['phone'], 'vfcode' => $_POST['vcode']))->order('addtime desc')->getField('addtime');
            if (!$addtime || (time() - $addtime > 20 * 60)) {    //判断验证码是否存在或过期
                header('Content-type: application/json');
                echo json_encode(array('err_code' => 2, 'err_msg' => '此验证码已过期或错误，请重新输入'));
                exit;
            }
            $usernum = M('house_village_user_bind')->where(array('uid' => array('neq', $this->user_session['uid']), 'usernum' => $_POST['usernum']))->getField('usernum');
            if ($usernum && $now_village['village_type'] == 0) {
                header('Content-type: application/json');
                echo json_encode(array('err_code' => 1, 'err_msg' => '此工牌号已存在，请重新填写'));    //工牌号唯一
                exit;
            }
            $village_name = M('house_village')->where(array('village_id'=>$_GET['village_id']))->getField('village_name');
            $_POST['ac_status'] = 1;    //改变其状态，以证明提交过
            $_POST['role'] = 1;    //表示加入了智能门禁
            //小区业主额外查询判断 by zhukeqin
            if ($now_village['village_type'] == 1) {
                $where_data = array('name' => $_POST['name'], 'phone' => $_POST['phone'], 'village_id' => $_GET['village_id']);
                $village_bind_name = M('house_village_user_bind')->where($where_data)->getField('name');
                if (empty($village_bind_name)) {
                    unset($where_data['name']);
                    $village_bind_name = M('house_village_user_bind')->where($where_data)->getField('name');
                }
            } else {
                $village_bind_name = M('house_village_user_bind')->where($where_data)->getField('name');
            }
            if ($village_bind_name) {    //判断是否已存在
                $_POST['last_time'] = time();    //修改时间
                if ($now_village['village_type'] == 1) {
                    $_POST['ac_status'] = 2;
                    $_POST['uid'] = $this->user_session['uid'];
                }
                $village_bind = M('house_village_user_bind')->where($where_data)->data($_POST)->save();
            } else {
                $_POST['uid'] = $this->user_session['uid'];
                $_POST['village_id'] = $_GET['village_id'];    //社区ID
                $_POST['add_time'] = time();    //新增时间
                $village_bind = M('house_village_user_bind')->data($_POST)->add();
            }
            if ($village_bind) {
                M('user')->where(array('uid' => $this->user_session['uid']))->data(array('truename' => $_POST['name'], 'phone' => $_POST['phone']))->save();    //修改用户表
                //判断是否能绑定admin表
                $this->bind_admin_pigcms($this->user_session['uid'], $_GET['village_id']);
                //end
                header('Content-type: application/json');
                echo json_encode(array('err_code' => 0, 'err_msg' => ''));    //提交成功
                $condition_table = array(C('DB_PREFIX') . 'house_village_user_bind' => 'v', C('DB_PREFIX') . 'company' => 'c');
                $condition_where = 'v.role=1 and v.company_id=c.company_id and v.village_id=' . $_GET['village_id'] . ' and v.uid=' . $this->user_session['uid'];
                $user_info = D('')->table($condition_table)->where($condition_where)->field('v.pigcms_id,c.company_id')->find();
                $time = time();        //审核信息推送
                $href = C('config.site_url') . '/wap.php?c=House&a=village_control_checkInfo&village_id=' . $_GET['village_id'] . '&id_val=' . $user_info['pigcms_id'];
                //微信类库
                $wechat = new WechatModel();
                $model = new templateNews(C('config.wechat_appid'), C('config.wechat_appsecret'));
                // $role_arr = M('role')->where(array('menus' => array('like', '%29%')))->field('role_id')->select();

                $where=array(
                    '_string' => 'find_in_set("29",menus)',
                );
                $role_arr = M('role')->where($where)->field(array('role_id'))->select();
                // var_dump($role_arr);exit;

                $role_str = array();
                foreach ($role_arr as $value) {
                    //$role_str .= $value['role_id'] . ',';    //以,拼接角色ID
                    //'_string' => implode(' or ',$role_str).' or '."find_in_set($_GET['village_id'],village_id_list)".' or '.'village_id_list' => 'all',
                    $role_str[]='find_in_set('.$value['role_id'].',role_id)';
                }

                $wheres=array(
                    // '_string' => implode(' or ',$role_str),
                    // 'village_id' => $_GET['village_id'],
                    'status' => 1,
                    '_string' => implode(' or ',$role_str).' and '.'find_in_set("'.$_GET['village_id'].'",village_id_list)'.' or '.implode(' or ',$role_str).' and '.'village_id_list="all"',
                );
                if (M('company')->where(array('company_id' => $user_info['company_id'], 'is_admin' => array('neq', 2)))->find()) {    //判断是否须管理员审核
                    //不需要
                    $wheres['company_id']=array('in', '0,' . $user_info['company_id']);
                    $uid_arr = M('admin')->field(array('openid'))->where($wheres)->select();
                    // var_dump(1);
                    
                } else {
                    // var_dump(2);
                    //需要
                    $wheres['company_id']=$user_info['company_id'];
                    $uid_arr = M('admin')->field(array('openid'))->where($wheres)->select();
                    
                    //修改处
                    $wh=array(
                        '_string' => 'find_in_set("89",role_id)'.' and '.'find_in_set("'.$_GET['village_id'].'",village_id_list)'.' or '.'find_in_set("89",role_id)'.' and '.'village_id_list="all"',
                    );
                    $user1 = M('admin')->field(array('openid'))->where($wh)->select();
                    $uid_arr = array_merge((array)$user1,(array)$uid_arr);
                    
                    $openid_arr = array();  //二维数组去重
                    foreach ($uid_arr as $k => $v) {
                        $openid_arr[] = $v['openid'];
                    }
                    $openid_arr = array_unique($openid_arr);
                    unset($uid_arr);
                    foreach ($openid_arr as $k => $v) { //重新拼接二维数组
                        $uid_arr[$k]['openid'] = $v;
                    }                              
                }
                
                if (!empty($uid_arr)) {
                    foreach ($uid_arr as $val) {
                        // $wecha_id = M('user')->where(array('uid' => $val['uid']))->getField('openid');//获取user微信用户表中有权限29用户的openid，
                        // $model->sendTempMsg('xLpzcYPX-Kgwsx6Ym3sHjp_CmZhn_n65_-v6CxC4gAc', array('href' => $href, 'wecha_id' => $wecha_id, 'first' => '您有一个待审核的信息！', 'keyword1' => '智能门禁', 'keyword2' => '管理员审核', 'keyword3' => date('Y-m-d H:i:s')));

                        //修改点
                        // var_dump($wecha_id);
                        // $openid = $wecha_id;
                        if ($val['openid'] == '') {
                            continue;
                        } else {
                            $openid = $val['openid'];
                        
                            // $openid = 'ohgcf0lvS3Ht7vH5n9PXbr5AEKtU';
                            $tpl_id = "xLpzcYPX-Kgwsx6Ym3sHjp_CmZhn_n65_-v6CxC4gAc";
                            $data = array(
                                "first"=>array(
                                       "value"=>"您有一个待审核的信息！",
                                       "color"=>"#173177"
                               ),
                               "keyword1"=>array(
                                   "value"=>"智能门禁",
                                   "color"=>"#173177"
                               ),
                               "keyword2"=>array(
                                   "value"=>$_POST['name'],
                                   "color"=>"#173177"
                               ),
                               "keyword3"=>array(
                                   "value"=>$village_name,
                                   "color"=>"#173177"
                               ),
                               "keyword4"=>array(
                                   "value"=>date('Y-m-d H:i:s'),
                                   "color"=>"#173177"
                               ),
                            );
                            $url = $href;
                            $res = $wechat->send_tpl_message($openid, $tpl_id, $url, $data);
                        }                        
                    }
                }
            } else {
                header('Content-type: application/json');
                echo json_encode(array('err_code' => 1, 'err_msg' => '提交失败，请重试'));    //提交失败
            }
        } else {
            $company_list = M('company')->where(array('village_id' => $now_village['village_id']))->field('company_id,company_name,company_first')->order('company_first ASC')->select();
            if(empty($company_list)) $company_list=M('company')->where(array('company_id' => '26'))->field('company_id,company_name,company_first')->order('company_first ASC')->select();
            //dump($company_list);exit;
            $this->assign('company_list', $company_list);
            $operat_type = isset($_GET['operat_type']) ? $_GET['operat_type'] : '';
            $this->assign('village_type', $now_village['village_type']);
            $user_info = M('house_village_user_bind')->where($where_data)->find();
            if (!empty($operat_type)) {    //判断是否是因审核不通过返回修改的
                $this->assign('user_info', $user_info);
                $this->display();
            } else {
                $ac_status = M('house_village_user_bind')->where($where_data)->getField('ac_status');
                switch ($ac_status) {
                    case '1':    //已提交申请
                        $this->redirect(U('House/village_access_next', array('village_id' => $now_village['village_id'])));
                        break;
                    case '2':    //审核通过
                        $this->redirect(U('House/village_access_finish', array('village_id' => $now_village['village_id'])));
                        break;
                    case '3':    //审核不通过
                        $this->redirect(U('House/village_access_next', array('village_id' => $now_village['village_id'])));
                        break;
                    case '4':    //已完成
                        $this->redirect(U('House/village_access_show', array('village_id' => $now_village['village_id'])));
                        break;
                    default:    //提交申请
                        //print_r($user_info);
                        $this->assign('user_info', $user_info);
                        $this->display();
                        break;
                }
            }
        }
    }
    public function village_access_control_uptown()
    {
        $now_village = $this->get_village($_GET['village_id']);
        if ($_GET['ac_id']) {    //判断是否是扫设备码进入
            import('ORG.Net.Http');
            $http = new Http();
            $access_token = D('Access_token_expires')->get_access_token()['access_token'];
            $return = $http->curlGet('https://api.weixin.qq.com/cgi-bin/user/info?access_token=' . $access_token . '&openid=' . $this->user_session['openid'] . '&lang=zh_CN');
            $jsonrt = json_decode($return, true);
            if ($jsonrt && !$jsonrt['subscribe']) {    //判断是否已关注
                $this->redirect(U('House/access_control_show', array('village_id' => $_GET['village_id'], 'msg' => '请先关注汇得行智慧助手公众号后使用房屋绑定功能')));
            }
        }
        if (empty($this->user_session)) {
            $this->check_ajax_error_tips('请先进行登录', U('Login/index'));
        }
        $where_data = array(
            'uid' => $this->user_session['uid'],
            'village_id' => $_GET['village_id']
        );
        if (IS_POST) {
            if (empty($_POST['truename'])) {
                $this->check_ajax_error_tips('请填写真实姓名');
            } else {
                $_POST['name'] = $_POST['truename'];
                unset($_POST['truename']);
            }
            if (empty($_POST['phone'])) {
                $this->check_ajax_error_tips('请填写手机号码');
            }
            //配合小区  去掉公司验证
            if (empty($_POST['company_id'])) {
                if ($now_village['village_type'] == 1) {
                    $_POST['company_id'] = 2;
                    $_POST['is_updown'] = 1;
                } else {
                    $this->check_ajax_error_tips('请选择公司');
                }
            }
            if (empty($_POST['usernum']) && $now_village['village_type'] == 0) {
                $_POST['usernum'] = time();
            }
            $inputimg = isset($_POST['inputimg']) ? $_POST['inputimg'] : '';
            if (!empty($inputimg)) {
                $pic_arr = array();
                foreach ($inputimg as $imgv) {
                    $imgv = str_replace('/upload/house/', '', $imgv);
                    $pic_arr[] = $imgv;
                }
                $_POST['workcard_img'] = implode('|', $pic_arr);    //图片(即证件)
            }
            $phone = M('house_village_user_bind')->where(array('uid' => array('neq', $this->user_session['uid']), 'village_id' => $_GET['village_id'], 'phone' => $_POST['phone']))->getField('phone');
            if ($phone == $_POST['phone'] && $now_village['village_type'] == 0) {    //判断非本人时此手机号码是否存在
                header('Content-type: application/json');
                echo json_encode(array('err_code' => 1, 'err_msg' => '此手机号码已存在请重新填写'));
                exit;
            }
            $addtime = M('user_modifypwd')->where(array('telphone' => $_POST['phone'], 'vfcode' => $_POST['vcode']))->order('addtime desc')->getField('addtime');
            if (!$addtime || (time() - $addtime > 20 * 60)) {    //判断验证码是否存在或过期
                header('Content-type: application/json');
                echo json_encode(array('err_code' => 2, 'err_msg' => '此验证码已过期或错误，请重新输入'));
                exit;
            }
            $usernum = M('house_village_user_bind')->where(array('uid' => array('neq', $this->user_session['uid']), 'usernum' => $_POST['usernum']))->getField('usernum');
            if ($usernum && $now_village['village_type'] == 0) {
                header('Content-type: application/json');
                echo json_encode(array('err_code' => 1, 'err_msg' => '此工牌号已存在，请重新填写'));    //工牌号唯一
                exit;
            }
            $_POST['ac_status'] = 1;    //改变其状态，以证明提交过
            $_POST['role'] = 1;    //表示加入了智能门禁
            //小区业主额外查询判断 by zhukeqin
            if ($now_village['village_type'] == 1) {
                $where_data = array('name' => $_POST['name'], 'phone' => $_POST['phone'], 'village_id' => $_GET['village_id']);
                $village_bind_name = M('house_village_user_bind')->where($where_data)->getField('name');
                if (empty($village_bind_name)) {
                    unset($where_data['name']);
                    $village_bind_name = M('house_village_user_bind')->where($where_data)->getField('name');
                }
            } else {
                $village_bind_name = M('house_village_user_bind')->where($where_data)->getField('name');
            }
            if ($village_bind_name) {    //判断是否已存在
                $_POST['last_time'] = time();    //修改时间
                if ($now_village['village_type'] == 1) {
                    $_POST['ac_status'] = 2;
                    $_POST['uid'] = $this->user_session['uid'];
                }
                $village_bind = M('house_village_user_bind')->where($where_data)->data($_POST)->save();
            } else {
                $_POST['uid'] = $this->user_session['uid'];
                $_POST['village_id'] = $_GET['village_id'];    //社区ID
                $_POST['add_time'] = time();    //新增时间
                $village_bind = M('house_village_user_bind')->data($_POST)->add();
            }
            if ($village_bind) {
                M('user')->where(array('uid' => $this->user_session['uid']))->data(array('truename' => $_POST['name'], 'phone' => $_POST['phone']))->save();    //修改用户表
                //判断是否能绑定admin表
                $this->bind_admin_pigcms($this->user_session['uid'], $_GET['village_id']);
                //end
                header('Content-type: application/json');
                echo json_encode(array('err_code' => 0, 'err_msg' => ''));    //提交成功
                $condition_table = array(C('DB_PREFIX') . 'house_village_user_bind' => 'v', C('DB_PREFIX') . 'company' => 'c');
                $condition_where = 'v.role=1 and v.company_id=c.company_id and v.village_id=' . $_GET['village_id'] . ' and v.uid=' . $this->user_session['uid'];
                $user_info = D('')->table($condition_table)->where($condition_where)->field('v.pigcms_id,c.company_id')->find();
                $time = time();        //审核信息推送
                $href = C('config.site_url') . '/wap.php?c=House&a=village_control_checkInfo&village_id=' . $_GET['village_id'] . '&id_val=' . $user_info['pigcms_id'];
                $model = new templateNews(C('config.wechat_appid'), C('config.wechat_appsecret'));
                $role_arr = M('role')->where(array('menus' => array('like', '%29%')))->field('role_id')->select();
                $role_str = '';
                foreach ($role_arr as $value) {
                    $role_str .= $value['role_id'] . ',';    //以,拼接角色ID
                }
                if (M('company')->where(array('company_id' => $user_info['company_id'], 'is_admin' => array('neq', 2)))->find()) {    //判断是否须管理员审核
                    $uid_arr = M('login_user')->field('uid')->where(array('role_id' => array('in', trim($role_str, ',')), 'village_id' => $_GET['village_id'], 'status' => 1, 'company_id' => array('in', '0,' . $user_info['company_id'])))->select();
                } else {
                    $uid_arr = M('login_user')->field('uid')->where(array('role_id' => array('in', trim($role_str, ',')), 'village_id' => $_GET['village_id'], 'status' => 1, 'company_id' => $user_info['company_id']))->select();
                }
                if (!empty($uid_arr)) {
                    foreach ($uid_arr as $val) {
                        $wecha_id = M('user')->where(array('uid' => $val['uid']))->getField('openid');//获取user微信用户表中有权限29用户的openid，
                        $model->sendTempMsg('OPENTM207145917', array('href' => $href, 'wecha_id' => $wecha_id, 'first' => '您有一个待审核的信息！', 'keyword1' => '智能门禁', 'keyword2' => '管理员审核', 'keyword3' => date('Y-m-d H:i:s')));
                    }
                }
            } else {
                header('Content-type: application/json');
                echo json_encode(array('err_code' => 1, 'err_msg' => '提交失败，请重试'));    //提交失败
            }
        } else {
             $project_list_all=M('house_village_project')->where('village_id='.$_GET['village_id'])->select();
             $project_list='0,[';
             foreach ($project_list_all as $value){
                $project_list .='{value:"'.$value['pigcms_id'].'",text:"'.$value['desc'].'"},';
             }
             $project_list .=']';
            $this->assign('now_village',$now_village);
            $this->assign('project_list',$project_list);
            $this->display();
        }
    }
    //动态获取房间信息 zhukeqin
    public function village_access_control_uptown_ajax($project_id){
        if(empty($project_id)){
            echo '错误';
        }
        $room_list=$this->get_room_list($project_id);
        $echo=array('level'=>4,'data'=>$room_list);
        echo json_encode($echo);
    }
    //动态获取业主信息 zhukeqin
    public function village_access_control_uptown_userinfo_ajax($id){
        $room_info=M('house_village_room')->where('id='.$id)->find();
        $data=array();
        if(empty($room_info['oid'])){
            $error=0;
        }else{
            $error=1;
            $user_list=explode(',',$room_info['oid']);
            $user_info=M('house_village_user_bind')->where('pigcms_id='.$user_list['0'])->find();
            if(empty($user_info)){
                $error=0;
            }else{
                $user_name=mb_substr($user_info['name'],0,1).'**';
                $user_usernum=mb_substr($user_info['usernum'],0,strlen($user_info['usernum'])-6).'******';
                $_SESSION['check_usernum']=mb_substr($user_info['usernum'],-6,6);
                $_SESSION['check_roomid']=$id;
                $data=array(
                    'name'=>$user_name,
                    'usernum'=>$user_usernum,
                );
            }
        }
        $echo=array('error'=>$error,'data'=>$data);
        echo json_encode($echo);

    }
    //验证业主信息 zhukeqin
    public function village_access_control_uptown_check_ajax(){
        $data=array();
        $uid=$_SESSION['user']['uid'];
        if(empty($_POST['usernum'])||empty($_SESSION['check_usernum'])||empty($_POST['village_id'])){
            $error=0;
        }else{
            if($_POST['usernum']===$_SESSION['check_usernum']){
                $user_info=M('house_village_user_bind')->where(array('uid'=>$uid,'village_id'=>$_POST['village_id']))->find();
                if(empty($user_info)){
                    $error=2;
                    $_SESSION['check_usernum']=true;
                }else{
                    $error=1;
                    $roominfo=M('house_village_room')->where('id='.$_SESSION['check_roomid'])->find();
                    $oid=explode(',',$roominfo['oid']);
                    if(in_array($user_info['pigcms_id'],$oid)){
                        $error=3;
                    }else{
                        $save['oid']=$roominfo['oid'].','.$user_info['pigcms_id'];
                        M('house_village_room')->where('id='.$_SESSION['check_roomid'])->data($save)->save();
                    }
                }
            }else{
                $error=0;
            }
        }
        echo json_encode(array('error'=>$error));
    }
    //添加业主信息 zhukeqin
    public function village_access_control_uptown_add_ajax(){
        $phone=$_POST['phone'];
        $name=$_POST['name'];
        $village_id=$_POST['village_id'];
        $uid=$_SESSION['user']['uid'];
        if(empty($phone)||empty($name)||empty($village_id)||$_SESSION['check_usernum']!==true){
            echo json_encode(array('error'=>0));
            die;
        }
        $user_info=M('house_village_user_bind')->where(array('name'=>$name,'phone'=>$phone,'village_id'=>$village_id))->find();
        if(!empty($user_info)){
            if(empty($user_info['uid'])){
                $data=array(
                    'uid'=>$uid,
                    'company_id'=>2,
                    'is_uptown'=>1,
                    'ac_status'=>2,
                    'role'=>0,
                    'add_time'=>time(),
                );
                M('house_village_user_bind')->data($data)->save();
                M('user')->where('uid='.$uid)->data(array('phone'=>$phone))->save();
                $user_id=$user_info['pigcms_id'];
            }else{
                echo json_encode(array('error'=>1));
                die;
            }
        }else{
            $data=array(
                'village_id'=>$village_id,
                'uid'=>$uid,
                'name'=>$name,
                'phone'=>$phone,
                'company_id'=>2,
                'is_uptown'=>1,
                'ac_status'=>2,
                'role'=>0,
                'add_time'=>time(),
            );
            M('user')->where('uid='.$uid)->data(array('phone'=>$phone))->save();
            $user_id=M('house_village_user_bind')->data($data)->add();
        }
        $roominfo=M('house_village_room')->where('id='.$_SESSION['check_roomid'])->find();
        $oid=explode(',',$roominfo['oid']);
        if(in_array($user_id,$oid)){
            $error=2;
        }else{
            $save['oid']=$roominfo['oid'].','.$user_id;
            M('house_village_room')->where('id='.$_SESSION['check_roomid'])->data($save)->save();
        }
        unset($_SESSION['check_usernum']);
        unset($_SESSION['check_roomid']);
        echo json_encode(array('error'=>2));
        die;
    }
    public function get_room_list($project_id){
        $build_list=M('house_village_room')->distinct(true)->field('tung_build')->where('project_id='.$project_id)->order('id asc')->select();
        $room_list=array();
        foreach ($build_list as $key=>$value){
            $room_list[$key]=array('value'=>$value['tung_build'],'text'=>$value['tung_build'].'栋','children'=>array());
            $unit_list=M('house_village_room')->distinct(true)->field('tung_unit')->where(array('project_id'=>$project_id,'fid'=>0,'tung_build'=>$value['tung_build']))->order('id asc')->select();
                foreach ($unit_list as $key1=>$value1){
                    $room_list[$key]['children'][$key1]=array('value'=>$value1['tung_unit'],'text'=>$value1['tung_unit'].'单元','children'=>array());
                    $floor_list=M('house_village_room')->distinct(true)->field(array('tung_floor','id'))->where(array('project_id'=>$project_id,'fid'=>0,'tung_build'=>$value['tung_build'],'tung_unit'=>$value1['tung_unit']))->order('id asc')->select();
                    foreach ($floor_list as $key2=>$value2){
                        $room_list[$key]['children'][$key1]['children'][$key2]=array('value'=>$value2['tung_floor'],'text'=>$value2['tung_floor'].'层','children'=>array());
                        $number_list=M('house_village_room')->where(array('project_id'=>$project_id,'fid'=>$value2['id']))->order('id asc')->select();
                        foreach ($number_list as $key3=>$value3){
                            $room_list[$key]['children'][$key1]['children'][$key2]['children'][$key3]=array('value'=>$value3['id'],'text'=>$value3['tung_number'].'号');
                        }
                    }
                }
            }
        return $room_list;
    }
    //判断是否能绑定admin表操作方法
    public function bind_admin_pigcms($uid, $village_id)
    {
        $pigcms_Arr = M('house_village_user_bind')->where(array('uid' => $uid, 'village_id' => $village_id))->find();
        if ($pigcms_Arr) {
            $admin_map['realname'] = array('eq', $pigcms_Arr['name']);
            $admin_map['phone'] = array('eq', $pigcms_Arr['phone']);
            $admin_map['village_id'] = array('eq', $pigcms_Arr['village_id']);
            $admin_map['company_id'] = array('eq', $pigcms_Arr['company_id']);
            $admin_id = D('admin')->where($admin_map)->getField('id');
            if ($admin_id) D('admin')->where(array('id' => $admin_id))->save(array('tid' => $pigcms_Arr['pigcms_id']));
        }

    }


    /* 智能门禁
* @time 2016-06-6
* @author	小邓  <969101097@qq.com>*/
    public function village_access_control_sub()
    {
        $now_village = $this->get_village($_GET['village_id']);
        /*if(empty($now_village)){
			$this->error_tips('当前访问的小区不存在或未开放');
		}*/
        $this->display();
    }

    /* 智能门禁(提交审核第二步)
	* @time 2016-06-7
	* @author	小邓  <969101097@qq.com>*/
    public function village_access_next()
    {
        $now_village = $this->get_village($_GET['village_id']);
        //echo $this->user_session['uid'];
        $where_data = array(
            'uid' => $this->user_session['uid'],
            'role' => 1,
            'village_id' => $_GET['village_id']
        );
        //$user_info=M('house_village_user_bind')->where($condition_where)->field(array('pigcms_id,name,phone,company,department,address,usernum,ac_status,ac_desc'))->find();
        $condition_table = array(C('DB_PREFIX') . 'house_village_user_bind' => 'v', C('DB_PREFIX') . 'company' => 'c');
        $condition_where = 'v.role=1 and v.company_id=c.company_id and v.village_id=' . $_GET['village_id'] . ' and v.uid=' . $this->user_session['uid'];
        $condition_field = 'v.pigcms_id,v.usernum,v.name,v.phone,v.card_type,c.company_id,c.company_name,v.ac_status,v.ac_desc';
        $user_info = D('')->table($condition_table)->where($condition_where)->field($condition_field)->find();
        //dump(M()->_sql());
        $this->assign('user_info', $user_info);
        $ac_status = M('house_village_user_bind')->where($where_data)->getField('ac_status');
        switch ($ac_status) {
            case '2':    //审核通过
                $this->redirect(U('House/village_access_finish', array('village_id' => $now_village['village_id'])));
                break;
            default:
                $this->display();
                break;
        }
        //$this->display();
    }

    /* 智能门禁(提交审核第三步)
	* @time 2016-06-7
	* @author	小邓  <969101097@qq.com>*/
    public function village_access_finish()
    {
        $now_village = $this->get_village($_GET['village_id']);
        if (IS_POST) {
            //$_POST['ac_status']=4;	//改变其状态，以证明审核通过
            //$alter_status=M('user')->where(array('uid'=>$this->user_session['uid']))->data(array('ac_status'=>$_POST['ac_status']))->save();
            $ac_status = M('house_village_user_bind')->where(array('uid' => $this->user_session['uid'], 'village_id' => $_GET['village_id'], 'ac_status' => $_POST['ac_status']))->getField('ac_status');
            if ($ac_status == 4) {
                echo json_encode(array('err_code' => 0, 'code_url' => U('House/village_access_show', array('village_id' => $now_village['village_id']))));
            } else {
                $alter_status = M('house_village_user_bind')->where(array('uid' => $this->user_session['uid'], 'role' => 1, 'village_id' => $_GET['village_id']))->data(array('ac_status' => $_POST['ac_status']))->save();
                if ($alter_status) {
                    echo json_encode(array('err_code' => 0, 'code_url' => U('House/village_access_show', array('village_id' => $now_village['village_id']))));
                } else {
                    echo json_encode(array('err_code' => 1, 'code_url' => ''));
                }
            }
        } else {

            $this->assign('now_village',$now_village);
            $this->display();
        }
    }

    /* 智能门禁展示选项
	* @time 2016-06-17
	* @author	小邓  <969101097@qq.com>*/
    public function village_access_show()
    {
        $now_village = $this->get_village($_GET['village_id']);
        if (IS_POST) {
            import('@.ORG.longlat');
            $longlat_class = new longlat();
            $user_long_lat = D('User_long_lat')->getLocation($_SESSION['openid'], 0);    //获取用户位置信息
            $user_location = $longlat_class->gpsToBaidu($user_long_lat['lat'], $user_long_lat['long']);
            $village_long_lat = M('house_village')->where(array('village_id' => $_GET['village_id']))->find();
            $village_location = $longlat_class->gpsToBaidu($village_long_lat['lat'], $village_long_lat['long']);
            $get_distance = GetDistance($user_location['lat'], $user_location['long'], $village_location['lat'], $village_location['long']);
            if ($get_distance > 2000) {    //判断是否在社区范围之内
                echo json_encode(array('err_code' => 2, 'code_msg' => '您当前位置不在写字楼附近，无法开门！'));
                exit;
            }
            //$pigcms_id=M('house_village_user_bind')->where(array('uid'=>$this->user_session['uid'],'role'=>1,'village_id'=>$_GET['village_id']))->getField('pigcms_id');
            $pigcms_id = M('house_village_user_bind')->where(array('uid' => $this->user_session['uid'], 'village_id' => $_GET['village_id']))->getField('pigcms_id');
            $add_data = array(
                //'uid'=>$this->user_session['uid'],
                'pigcms_id' => $pigcms_id,
                'ac_id' => $_POST['ac_id'],    //开关ID
                'village_id' => $_GET['village_id'],    //社区ID
                'opdate' => time(),//开门时间.
                'type' => 2
            );
            $control_log = M('access_control_user_log')->data($add_data)->add();
            if ($control_log) {
                //开门操作
                //修改于2017.1.5
                $where_terrace = M('terrace')->where(array('is_use' => 1, 'is_del' => 0))->find();
                $choose_hick = M('hickey')->where(array('terrace_id' => $where_terrace['pigcms_id'], 'is_use' => 1, 'is_del' => 0, 'hick_action' => '智能门禁'))->find();
                //对于独特字段参数字段进行后台处理
                $arguments = $choose_hick['arguments'];
                $arguments_value = $choose_hick['arguments_value'];
                $arguments_array = explode(",", $arguments);
                $arguments_array_value = explode(",", $arguments_value);
                $arguments_all_feild = array(
                    'village_id' => $_POST['village_id'],
                    'ac_id' => $_POST['ac_id'],
                    'state' => 'key'
                );
                foreach ($arguments_array_value as $k => $v) {
                    if ($v != '') {
                        $arguments_all_feild[$arguments_array[$k]] = $v;
                    }
                }
                $msg_array = $this->$choose_hick['hickey_control']($arguments_all_feild);
                echo json_encode($msg_array);

            } else {
                echo json_encode(array('err_code' => 1, 'code_msg' => '记录失败'));
            }
        } else {
            $access_control_result = D('AccessControl')->getAccesscontrollist($village_id = $_GET['village_id']);
            //dump($access_control_result);
            $new_arr = array();
            foreach ($access_control_result as $key => $val) {
                $new_arr[$val['ag_id']]['parent'] = $val['ag_name'];    //父级名称
                $new_arr[$val['ag_id']]['child'][] = $val;    //子级数组内容
            }
            //dump($new_arr);
            $this->assign('control_result', $new_arr);
            $share_arr = array(        //分享
                'title' => $now_village['village_name'],
                'desc' => '汇得行-生活智慧助手',
                'imgUrl' => C('config.site_url') . '/tpl/Wap/myinterface/static/images/house.jpg',
                'link' => C('config.site_url') . '/wap.php?g=Wap&c=House&a=village_access_show&village_id=' . $now_village['village_id']
            );
            $share = new WechatShare($this->config, $_SESSION['openid'], $share_arr);
            $this->shareScript = $share->getSgin();
            $this->assign('shareScript', $this->shareScript);
            $role = M('house_village_user_bind')->where(array('uid' => $this->user_session['uid'], 'village_id' => $now_village['village_id']))->getField('role');
            $this->assign('role', $role);
            $this->display();
        }
    }

    /* 个人绑定社区
	* @time 2016-06-20
	* @author	小邓  <969101097@qq.com>*/
    public function village_my_bind()
    {
        $now_village = $this->get_village($_GET['village_id']);
        $this->check_village_session($now_village['village_id']);
        if (empty($this->village_bind)) {
            $this->redirect(U('House/village_access_control', array('village_id' => $now_village['village_id'])));
        }
        if (IS_POST) {
            $w=array(
                '_string' => 'find_in_set("'.$now_village['village_id'].'",village_id_list)'.' or '.'village_id_list="all"',
                'account' => trim(I('account')),
                'pwd' => md5(trim(I('pwd'))),

            );
            $village_find = D('admin')->where($w)->find();
            
            if ($village_find) {
                if (!$village_find['status']) {
                    $this->error_tips('你的账号已被禁用，请联系管理员！');
                } else {
                    if ($village_find['openid']) {
                        if ($village_find['openid'] == $this->user_session['openid']) {//如果员工列表的账号密码绑定的微信号换了，用原来的微信号登录后台时应该提示错误
                            $car_role_id = M('role')->where(array('role_id' => $village_find['role_id']))->find();
                            session('admin_name', $village_find['account']);
                            session('role_id', $car_role_id['car_role_id']);
                            $this->redirect(U('House/village_my_bind', array('village_id' => $village_find['village_id'])));
                        } else {
                            $this->error_tips('你输入的账号已绑定微信号！');
                        }
                    } else {
                        $village_alter = D('admin')->where(array('account' => trim(I('account')), 'pwd' => md5(trim(I('pwd'))), 'village_id' => $village_find['village_id'], 'status' => 1))->data(array('openid' => $this->user_session['openid']))->save();
                        //dump($village_alter);exit;
                        if ($village_alter) {
                            $car_role_id = M('role')->where(array('role_id' => $village_find['role_id']))->find();
                            session('admin_name', $village_find['account']);
                            session('role_id', $car_role_id['car_role_id']);
                            //dump($_SESSION);exit;
                            $this->success_tips('绑定成功！', U('House/village_my_bind', array('village_id' => $village_find['village_id'])));
                        } else {
                            $this->error_tips('绑定失败！');
                        }
                    }
                }
            } else {
                $this->error_tips('你输入的社区账号或密码不对，请重新输入！');
            }

            /*$village_find=D('house_village')->where(array('account'=>trim(I('account')),'pwd'=>md5(trim(I('pwd'))),'village_id'=>$now_village['village_id']))->find();
			if($village_find){	//判断绑定此社区是否存在
				if($village_find['uid']){	//判断是否已存在绑定的用户
					$openid_arr=explode(',',$village_find['uid']);
					if(count($openid_arr)>=10){	//判断绑定人数是否已满
						$this->error_tips('当前社区绑定用户过多，请联系管理员解决！');
					}else{
						if(in_array($this->user_session['uid'],$openid_arr) || $openid_arr==$this->user_session['uid']){	//判断是否已绑定过此社区
							$this->error_tips('您已绑定过当前社区，不可重复绑定！');
						}else{
							$users_openid = $village_find['uid'].','.$this->user_session['uid'];
							$merchant_alter=D('house_village')->where(array('village_id' => $village_find['village_id']))->data(array('uid' => $users_openid))->save();
							if($merchant_alter){
								$this->success_tips('绑定成功！');
							}else{
								$this->error_tips('绑定失败！');
							}
						}
					}
				}else{
					$village_alter=D('house_village')->where(array('village_id'=>$village_find['village_id']))->data(array('uid'=>$this->user_session['uid']))->save();
					if($village_alter){
						$this->success_tips('绑定成功！');
					}else{
						$this->error_tips('绑定失败！');
					}
				}
			}else{
				$this->error_tips('你输入的社区账号或密码不对，请重新输入！');
			}*/
        } else {
            M('house_village')->where(array('village_id' => $_GET['village_id']))->data(array('last_time' => time()))->save();    //修改登录时间
            $village_info = D('login_user')->where(array('village_id' => $_GET['village_id'], 'uid' => $this->user_session['uid'], 'status' => 1))->field('uid,account,village_id,role_id')->find();//根据它来判断该微信用户是否已经绑定到login_user表中
            //echo $village_info;exit;
            if ($village_info['role_id']) {
                $this->user_session['role_id'] = M('login_user')->where(array('uid' => $this->user_session['uid'], 'village_id' => $_GET['village_id']))->getField('role_id');
                $role_menus = M('role')->where(array('role_id' => $this->user_session['role_id']))->getField('menus');//获取登陆信息中role_id的menu信息
                $car_role_id = M('role')->where(array('role_id' => $village_info['role_id']))->find();
                session('admin_name', $village_info['account']);
                session('role_id', $car_role_id['car_role_id']);
                //dump($role_menus);exit;
                $village_menu = M('permission_menu')->where(array('id' => array('in', $role_menus), 'is_show' => 1, 'auth_area' => 1))->select();
                //dump($village_menu);exit;
                $village_arr = array();
                foreach ($village_menu as $key => $val) {
                    $village_arr[$key]['url'] = U($val['controller'] . '/' . $val['action'], array('village_id' => $now_village['village_id']));
                    $village_arr[$key]['src'] = $this->static_path . $val['icon'];
                    $village_arr[$key]['name'] = $val['name'];
                    /*switch($val['controller'].'-'.$val['action']){
						case 'Access-userCheck':
							$village_arr[$key]['url']=U('House/village_control_check',array('village_id'=>$now_village['village_id']));
							$village_arr[$key]['src']=$this->static_path .'/images/fe2.png';
							$village_arr[$key]['name']='用户资料审核';
							break;
						case 'Access-operatLog':
							$village_arr[$key]['url']=U('House/village_user_openLog',array('village_id'=>$now_village['village_id']));
							$village_arr[$key]['src']=$this->static_path .'/images/fe3.png';
							$village_arr[$key]['name']='访客出入记录';
							break;
						case 'Repair-index':
							$village_arr[$key]['url']=U('House/village_repair',array('village_id'=>$now_village['village_id']));
							$village_arr[$key]['src']=$this->static_path .'/images/fe4.png';
							$village_arr[$key]['name']='在线报修管理';
							break;
						case 'News-reply':
							$village_arr[$key]['url']=U('House/village_newsReply',array('village_id'=>$now_village['village_id']));
							$village_arr[$key]['src']=$this->static_path .'/images/fe5.png';
							$village_arr[$key]['name']='新闻评论管理';
							break;
						case 'Repair-suggess':
							$village_arr[$key]['url']=U('House/village_suggest',array('village_id'=>$now_village['village_id']));
							$village_arr[$key]['src']=$this->static_path .'/images/fe2.png';
							$village_arr[$key]['name']='投诉建议管理';
							break;
						case 'Access-visitorLog':
							$village_arr[$key]['url']=U('House/village_visitorLog',array('village_id'=>$now_village['village_id']));
							$village_arr[$key]['src']=$this->static_path .'/images/fe2.png';
							$village_arr[$key]['name']='访客信息管理';
							break;
					}*/

                }
                $this->assign('village_arr', $village_arr);
            }
            $this->assign('village_info', $village_info);
            //计算待处理数量
            $dcl_model = new UnprocessedMessageModel();
            $this->assign('dcl_count', $dcl_model->count('appointment'));;


            $this->display();
        }
    }


    /**
     * 巡检列表，当月已巡检和未巡检(图表页)
     */
    public function village_my_safety(){
        $village_id=$_GET['village_id'];
        $project_id=$_GET['project_id'];
        $where=array('p.is_del'=>0);
        if(!empty($village_id))$where['m.village_id']=$village_id;
        if(!empty($project_id))$where['m.project_id']=$project_id;
        //一共多少巡更点
        $pointCount = M('house_village_point')
                ->alias('p')
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
                ->where(array('p.type' => 1))
                ->where($where)
                ->count();
        //已经巡检的巡更点
        $nowDays = strtotime(date('Y-m-01',time()).'00:00:00');
        $nowDaye = strtotime(date('Y-m-t',time()).'23:59:59');
        
        
        //本月已经巡检了多少点位
        $where=array('r.check_time'=>array('between',array($nowDays,$nowDaye)));
        if(!empty($village_id))$where['m.village_id']=$village_id;
        if(!empty($project_id))$where['m.project_id']=$project_id;
        $nowPointCount = M('village_point_safety_record')
            ->alias('r')
            ->field(array("count(DISTINCT r.pid)"=>'num'))
            ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid ')
            ->where($where)
            ->select()[0]['num'];
        /*dump(M()->_sql());*/
        //还剩多少点位未巡检
        $lowPoint = $pointCount-$nowPointCount;
        if($lowPoint<=0)$lowPoint=0;
        //本月已经巡检的点
        //字段
        $field_now =array(
            'r.*',
            'p.orientation',
            'm.room_name',
            'v.village_name',
            'b.name',
            'u.truename'
        );
        //构建子查询
        $chlidSql = M('house_village_user_bind')->field(array('uid','`name`','MAX(pigcms_id)'))->group('uid')->buildSql();
        //主查询
        $where=array('r.check_time'=>array('between',array($nowDays,$nowDaye)),'r.is_check'=>1);
        if(!empty($village_id))$where['m.village_id']=$village_id;
        if(!empty($project_id))$where['m.project_id']=$project_id;
        $nowPointList = M('village_point_safety_record')
            ->alias('r')
            ->field($field_now)
            ->join('LEFT JOIN '.$chlidSql.' b on b.uid=r.uid')
            ->join('LEFT JOIN __USER__ u on r.uid=u.uid')
            ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
            ->join('LEFT JOIN __HOUSE_VILLAGE__ v on v.village_id=m.village_id')
            ->where($where)
            ->order('r.point_status desc,r.check_time desc')
            ->select();
//        dump($nowPointList);exit;

         //将point_status 进行处理，使其能作为判断的标准
        foreach ($nowPointList as $k => $v) {
            $nowPointList[$k]['point_status'] = explode(',',$v['point_status']);
        }
        // var_dump($nowPointList);exit();

        //正常的巡检点数与异常的巡检点位
        $statusArr = [];
        foreach ($nowPointList as $v) {
            $statusArr[] = $v['point_status'];
        }
        // var_dump( $statusArr);exit();
        $warningNum = 0;
        foreach ($statusArr as $v) {
            // var_dump($v[1]== "status_2-0");exit();
            if ($v[0] == "status_1-1" || $v[1] == "status_2-1" || $v[2] == "status_3-1" || $v[3] == "status_4-1" || $v[4] == "status_5-1") {
                $warningNum += 1;
            }
        }
        
        $warningPoint = $warningNum;
        $safetyPoint = $nowPointCount - $warningPoint;

        //各种描述信息的统计
        
        $spearheadNum = 0;
        $hoseNum = 0;
        $buttonNum = 0;
        $glassNum = 0;
        $extinguisherNum = 0;
        $count = 0;
        
        foreach ( $statusArr as $v) {
            if ($v[0] == "status_1-1") {
                $spearheadNum += 1;
                $count+= 1;
            } elseif ($v[1] == "status_2-1") {
                $hoseNum += 1;
                $count+= 1;
            } elseif ($v[2] == "status_3-1") {
                $buttonNum += 1;
                $count+= 1;
            } elseif ($v[3] == "status_4-1") {
                $glassNum += 1;
                $count+= 1;
            } elseif ($v[4] == "status_5-1") {
                $extinguisherNum += 1;
                $count+= 1;
            }
        }

        $statusNum = array($spearheadNum, $hoseNum, $buttonNum, $glassNum, $extinguisherNum,$count);
        // var_dump($statusNum);exit();

        $this->assign('nowPointCount',$nowPointCount);
        $this->assign('lowPoint',$lowPoint);
        $this->assign('safetyPoint',$safetyPoint);
        $this->assign('warningPoint',$warningPoint);
        $this->assign('statusNum',$statusNum);
        $this->assign('nowPointList',$nowPointList);
        //本月没有巡检的点
        $noInArray = array();
        foreach ($nowPointList as $key=>$value){
            $noInArray[] = $value['pid'];
        }
        // var_dump($noInArray); exit();
        //未检字段
        $field_low = array(
            'GROUP_CONCAT(p.orientation) AS oname',
            'm.room_name',
        );
        if(empty($noInArray)){
            $where=array('p.is_del'=>0);
            if(!empty($village_id))$where['m.village_id']=$village_id;
            if(!empty($project_id))$where['m.project_id']=$project_id;
            $lowPointList = M('house_village_point')
                ->alias('p')
                ->field($field_low)
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
                ->where(array('p.type' => 1))
                ->where($where)
                ->group('p.rid')
                ->order('m.room_name asc')
                ->select();
        }else{
            $where=array('p.is_del'=>0,'p.id'=>array('not in',$noInArray));
            if(!empty($village_id))$where['m.village_id']=$village_id;
            if(!empty($project_id))$where['m.project_id']=$project_id;
            $lowPointList = M('house_village_point')
                ->alias('p')
                ->field($field_low)
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
                ->where(array('p.type' => 1))
                ->where($where)
                ->order('m.room_name asc')
                ->group('p.rid')
                ->select();
        }

        $this->assign('lowPointList',$lowPointList);

        //时间
        $date = array(
            $year=date('Y'),
            $year=date('m'),
            $day=date('Y-m-d'),
        );
        $this->assign('date',$date);

        $this->display();
    }

    /**
     * 新版单一入口来显示钥匙开门页面
     * @author 祝君伟
     * @time 2017年8月4日10:07:45
     */
    public function my_key_show()
    {
        //第一步。判断是否门禁处于关闭状态
        $door_state = M('config')->getFieldByName('door_state', 'value');
        if ($door_state == '1') {
            //如果存在，查一下第三方平台是否有回应
            $where_terrace = M('terrace')->where(array('is_use' => 1, 'is_del' => 0))->find();
            $choose_hick = M('hickey')->where(array('terrace_id' => $where_terrace['pigcms_id'], 'is_use' => 1, 'is_del' => 0, 'hick_action' => '智能门禁'))->find();
            //对于独特字段参数字段进行后台处理
            $arguments = $choose_hick['arguments'];
            $arguments_value = $choose_hick['arguments_value'];
            $arguments_array = explode(",", $arguments);
            $arguments_array_value = explode(",", $arguments_value);
            $arguments_all_feild = array(
                'village_id' => 4,
                'ac_id' => 88,
                'state' => 'key'
            );
            foreach ($arguments_array_value as $k => $v) {
                if ($v != '') {
                    $arguments_all_feild[$arguments_array[$k]] = $v;
                }
            }
            $msg_array = $this->$choose_hick['hickey_control']($arguments_all_feild);
            //dump($msg_array);
            if ($msg_array['err_code'] == 0) {
                //平台正常了
                //同时更改状态,异常关闭
                M('config')->where(array('name' => 'door_state'))->data(array('value' => 0))->save();
                //再进一次方法
                redirect(U('Wap/House/my_key_show'));
            } else {
                //平台不正常
                header("Location:http://www.hdhsmart.com/Car/index.php?m=Home&c=problem&a=index");
            }

        } else {
            //第二步，如果没有系统关闭则，验证其是否登录
            if (empty($this->user_session)) {
                //判断是否已登录
                redirect(U('Wap/Login/weixin', array('referer' => urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']))));
            } else {
                //如果已经登录了,判断是否有带get village_id
                $get_village_id = I('get.village_id');
                if (empty($get_village_id)) {
                    // 没有id显示所有社区钥匙
                    if (IS_POST) {
                        import('@.ORG.longlat');
                        $longlat_class = new longlat();
                        $user_long_lat = D('User_long_lat')->getLocation($_SESSION['openid'], 0);    //获取用户位置信息
                        $user_location = $longlat_class->gpsToBaidu($user_long_lat['lat'], $user_long_lat['long']);
                        $village_long_lat = M('house_village')->where(array('village_id' => $_POST['village_id']))->find();    //获取当前社区信息
                        $village_location = $longlat_class->gpsToBaidu($village_long_lat['lat'], $village_long_lat['long']);
                        $get_distance = GetDistance($user_location['lat'], $user_location['long'], $village_location['lat'], $village_location['long']);
                        if ($get_distance > 2000) {    //判断是否在社区范围之内
                            echo json_encode(array('err_code' => 2, 'code_msg' => '您当前位置不在写字楼附近，无法开门！'));
                            exit;
                        }
                        $where_data = array(
                            'uid' => $this->user_session['uid'],
                            'village_id' => $_POST['village_id']    //社区ID
                        );
                        $user_info = M('house_village_user_bind')->where($where_data)->field('role,ac_status')->find();
                        if (!$user_info) {    //判断是否已存在
                            echo json_encode(array('err_code' => 3, 'code_msg' => U('House/access_control_change', array('village_id' => $_POST['village_id']))));
                        } else {
                            if ($user_info['role'] <= 1 && ($user_info['ac_status'] == 1 || $user_info['ac_status'] == 3)) { //是业主且已提交智能门禁审核但没得到认可时
                                echo json_encode(array('err_code' => 3, 'code_msg' => U('House/village_access_next', array('village_id' => $_POST['village_id']))));
                            } else if ($user_info['role'] <= 1 && empty($user_info['ac_status'])) {    //是业主但没有提交智能门禁审核
                                echo json_encode(array('err_code' => 3, 'code_msg' => U('House/village_access_control', array('village_id' => $_POST['village_id']))));
                            } else if ($user_info['role'] == 2 && time() - $user_info['last_time'] > 24 * 60 * 60) {    //是访客但上次提交的审核资料超过24小时
                                echo json_encode(array('err_code' => 3, 'code_msg' => U('House/access_control_change', array('village_id' => $_POST['village_id']))));
                            } else {
                                //echo json_encode(array('err_code'=>0,'code_msg'=>'可以进行操作啦'));
                                //$pigcms_id=M('house_village_user_bind')->where(array('uid'=>$this->user_session['uid'],'role'=>1,'village_id'=>$_POST['village_id']))->getField('pigcms_id');
                                $pigcms_id = M('house_village_user_bind')->where(array('uid' => $this->user_session['uid'], 'village_id' => $_POST['village_id']))->getField('pigcms_id');
                                $add_data = array(
                                    'pigcms_id' => $pigcms_id,
                                    'ac_id' => $_POST['ac_id'],    //开关ID
                                    'village_id' => $_POST['village_id'],    //社区ID
                                    'opdate' => time(),//开门时间
                                    'type' => 2//通过我的钥匙进入
                                );
                                $control_log = M('access_control_user_log')->data($add_data)->add();
                                if ($control_log) {
                                    //开门操作
                                    //修改于2017.1.5
                                    $where_terrace = M('terrace')->where(array('is_use' => 1, 'is_del' => 0))->find();
                                    $choose_hick = M('hickey')->where(array('terrace_id' => $where_terrace['pigcms_id'], 'is_use' => 1, 'is_del' => 0, 'hick_action' => '智能门禁'))->find();
                                    //对于独特字段参数字段进行后台处理
                                    $arguments = $choose_hick['arguments'];
                                    $arguments_value = $choose_hick['arguments_value'];
                                    $arguments_array = explode(",", $arguments);
                                    $arguments_array_value = explode(",", $arguments_value);
                                    $arguments_all_feild = array(
                                        'village_id' => $_POST['village_id'],
                                        'ac_id' => $_POST['ac_id'],
                                        'state' => 'key'
                                    );
                                    foreach ($arguments_array_value as $k => $v) {
                                        if ($v != '') {
                                            $arguments_all_feild[$arguments_array[$k]] = $v;
                                        }
                                    }
                                    $msg_array = $this->$choose_hick['hickey_control']($arguments_all_feild);
                                    echo json_encode($msg_array);

                                } else {
                                    echo json_encode(array('err_code' => 1, 'code_msg' => '记录失败'));
                                }
                            }
                        }
                    } else {
                        $condition_table = array(
                            'pigcms_house_village' => 'village',
                            'pigcms_access_control_group' => 'group',
                            'pigcms_access_control' => 'control'
                        );
                        $condition_where = 'village.village_id=group.village_id and group.ag_id=control.ag_id and control.ac_status=1';
                        $condition_field = 'village.village_id,village.village_name,village.lat,village.long,group.ag_name,control.ac_id,control.ag_id,control.ac_name,control.apikey,control.nodeid,control.sensorid';
                        $access_control_result = M('')->table($condition_table)->where($condition_where)->field($condition_field)->select();
                        $long_lat = D('User_long_lat')->getLocation($_SESSION['openid'], 0);    //获取用户位置信息
                        //dump($long_lat);
                        if ($access_control_result && $long_lat) {
                            $rangeSort = array();
                            foreach ($access_control_result as &$village_value) {
                                $village_value['range_int'] = getDistance($village_value['lat'], $village_value['long'], $long_lat['lat'], $long_lat['long']);//用户与社区距离
                                $village_value['range'] = getRange($village_value['range_int']);
                                $rangeSort[] = $village_value['range_int'];
                            }
                            array_multisort($rangeSort, SORT_ASC, $access_control_result);//按距离近远排序
                        }
                        $new_arr = array();
                        foreach ($access_control_result as $key => $val) {
                            $new_arr[$val['village_id']]['beforparent'] = $val['village_name'];    //一级父级名称
                            $new_arr[$val['village_id']]['range'] = $val['range'];    //一级父级距离
                            $new_arr[$val['village_id']]['beforchild'][$val['ag_id']]['afterparent'] = $val['ag_name'];    //二级父级名称
                            $new_arr[$val['village_id']]['beforchild'][$val['ag_id']]['afterchild'][] = $val;    //子级数组内容
                        }
                        //dump($new_arr);
                        $this->assign('control_result', $new_arr);
                        $signa_arr = unserialize($this->getSigna(D('Access_token_expires')->get_access_token()['access_token']));
                        //dump($signa_arr);
                        $signa_arr['appid'] = $this->config['wechat_appid'];
                        $this->assign('signa_arr', $signa_arr);    //微信定位所须参数
                        $share_arr = array(        //分享
                            'title' => '我的钥匙',
                            'desc' => '汇得行-生活智慧助手',
                            'imgUrl' => C('config.site_url') . '/tpl/Wap/myinterface/static/images/house.jpg',
                            'link' => C('config.site_url') . '/wap.php?g=Wap&c=House&a=access_control_ask&village_id=' . $_GET['village_id']
                        );
                        $share = new WechatShare($this->config, $_SESSION['openid'], $share_arr);
                        $this->shareScript = $share->getSgin();
                        $this->assign('shareScript', $this->shareScript);
                        $this->display();
                    }
                } else {
                    //有id，显示当前社区的钥匙
                    $now_village = $this->get_village($get_village_id);
                    if (IS_POST) {
                        import('@.ORG.longlat');
                        $longlat_class = new longlat();
                        $user_long_lat = D('User_long_lat')->getLocation($_SESSION['openid'], 0);    //获取用户位置信息
                        $user_location = $longlat_class->gpsToBaidu($user_long_lat['lat'], $user_long_lat['long']);
                        $village_long_lat = M('house_village')->where(array('village_id' => $_GET['village_id']))->find();
                        $village_location = $longlat_class->gpsToBaidu($village_long_lat['lat'], $village_long_lat['long']);
                        $get_distance = GetDistance($user_location['lat'], $user_location['long'], $village_location['lat'], $village_location['long']);
                        if ($get_distance > 2000) {    //判断是否在社区范围之内
                            echo json_encode(array('err_code' => 2, 'code_msg' => '您当前位置不在写字楼附近，无法开门！'));
                            exit;
                        }
                        //$pigcms_id=M('house_village_user_bind')->where(array('uid'=>$this->user_session['uid'],'role'=>1,'village_id'=>$_GET['village_id']))->getField('pigcms_id');
                        $pigcms_id = M('house_village_user_bind')->where(array('uid' => $this->user_session['uid'], 'village_id' => $_GET['village_id']))->getField('pigcms_id');
                        $add_data = array(
                            //'uid'=>$this->user_session['uid'],
                            'pigcms_id' => $pigcms_id,
                            'ac_id' => $_POST['ac_id'],    //开关ID
                            'village_id' => $_GET['village_id'],    //社区ID
                            'opdate' => time(),//开门时间.
                            'type' => 2
                        );
                        $control_log = M('access_control_user_log')->data($add_data)->add();
                        if ($control_log) {
                            //开门操作
                            //修改于2017.1.5
                            $where_terrace = M('terrace')->where(array('is_use' => 1, 'is_del' => 0))->find();
                            $choose_hick = M('hickey')->where(array('terrace_id' => $where_terrace['pigcms_id'], 'is_use' => 1, 'is_del' => 0, 'hick_action' => '智能门禁'))->find();
                            //对于独特字段参数字段进行后台处理
                            $arguments = $choose_hick['arguments'];
                            $arguments_value = $choose_hick['arguments_value'];
                            $arguments_array = explode(",", $arguments);
                            $arguments_array_value = explode(",", $arguments_value);
                            $arguments_all_feild = array(
                                'village_id' => $_POST['village_id'],
                                'ac_id' => $_POST['ac_id'],
                                'state' => 'key'
                            );
                            foreach ($arguments_array_value as $k => $v) {
                                if ($v != '') {
                                    $arguments_all_feild[$arguments_array[$k]] = $v;
                                }
                            }
                            $msg_array = $this->$choose_hick['hickey_control']($arguments_all_feild);
                            echo json_encode($msg_array);

                        } else {
                            echo json_encode(array('err_code' => 1, 'code_msg' => '记录失败'));
                        }
                    } else {
                        $access_control_result = D('AccessControl')->getAccesscontrollist($village_id = $_GET['village_id']);
                        //dump($access_control_result);exit;
                        $new_arr = array();
                        foreach ($access_control_result as $key => $val) {
                            $new_arr[$val['ag_id']]['parent'] = $val['ag_name'];    //父级名称
                            $new_arr[$val['ag_id']]['child'][] = $val;    //子级数组内容
                        }
                        //dump($new_arr);
                        $this->assign('control_result', $new_arr);
                        $share_arr = array(        //分享
                            'title' => $now_village['village_name'],
                            'desc' => '汇得行-生活智慧助手',
                            'imgUrl' => C('config.site_url') . '/tpl/Wap/myinterface/static/images/house.jpg',
                            'link' => C('config.site_url') . '/wap.php?g=Wap&c=House&a=village_access_show&village_id=' . $now_village['village_id']
                        );
                        $share = new WechatShare($this->config, $_SESSION['openid'], $share_arr);
                        $this->shareScript = $share->getSgin();
                        $this->assign('shareScript', $this->shareScript);
                        $role = M('house_village_user_bind')->where(array('uid' => $this->user_session['uid'], 'village_id' => $now_village['village_id']))->getField('role');
                        $this->assign('role', $role);
                        $this->assign('key', 1);
                        $this->display();
                    }
                }

            }
        }
    }


    /* 我的钥匙展示（所有社区）
	* @time 2016-06-22
	* @author	小邓  <969101097@qq.com>*/
    public function control_show()
    {
        $door_state = M('config')->where(array('name' => 'door_state'))->getField('value');
        if ($door_state == '1') {
            header("Location:http://www.hdhsmart.com/Car/index.php?m=Home&c=problem&a=index");
        }

        if (empty($this->user_session)) {    //判断是否已登录
            redirect(U('Wap/Login/weixin', array('referer' => urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']))));
        } else {
            if (IS_POST) {
                import('@.ORG.longlat');
                $longlat_class = new longlat();
                $user_long_lat = D('User_long_lat')->getLocation($_SESSION['openid'], 0);    //获取用户位置信息
                $user_location = $longlat_class->gpsToBaidu($user_long_lat['lat'], $user_long_lat['long']);
                $village_long_lat = M('house_village')->where(array('village_id' => $_POST['village_id']))->find();    //获取当前社区信息
                $village_location = $longlat_class->gpsToBaidu($village_long_lat['lat'], $village_long_lat['long']);
                $get_distance = GetDistance($user_location['lat'], $user_location['long'], $village_location['lat'], $village_location['long']);
                if ($get_distance > 2000) {    //判断是否在社区范围之内
                    echo json_encode(array('err_code' => 2, 'code_msg' => '您当前位置不在写字楼附近，无法开门！'));
                    exit;
                }
                $where_data = array(
                    'uid' => $this->user_session['uid'],
                    'village_id' => $_POST['village_id']    //社区ID
                );
                $user_info = M('house_village_user_bind')->where($where_data)->field('role,ac_status')->find();
                if (!$user_info) {    //判断是否已存在
                    echo json_encode(array('err_code' => 3, 'code_msg' => U('House/access_control_change', array('village_id' => $_POST['village_id']))));
                } else {
                    if ($user_info['role'] <= 1 && ($user_info['ac_status'] == 1 || $user_info['ac_status'] == 3)) { //是业主且已提交智能门禁审核但没得到认可时
                        echo json_encode(array('err_code' => 3, 'code_msg' => U('House/village_access_next', array('village_id' => $_POST['village_id']))));
                    } else if ($user_info['role'] <= 1 && empty($user_info['ac_status'])) {    //是业主但没有提交智能门禁审核
                        echo json_encode(array('err_code' => 3, 'code_msg' => U('House/village_access_control', array('village_id' => $_POST['village_id']))));
                    } else if ($user_info['role'] == 2 && time() - $user_info['last_time'] > 24 * 60 * 60) {    //是访客但上次提交的审核资料超过24小时
                        echo json_encode(array('err_code' => 3, 'code_msg' => U('House/access_control_change', array('village_id' => $_POST['village_id']))));
                    } else {
                        //echo json_encode(array('err_code'=>0,'code_msg'=>'可以进行操作啦'));
                        //$pigcms_id=M('house_village_user_bind')->where(array('uid'=>$this->user_session['uid'],'role'=>1,'village_id'=>$_POST['village_id']))->getField('pigcms_id');
                        $pigcms_id = M('house_village_user_bind')->where(array('uid' => $this->user_session['uid'], 'village_id' => $_POST['village_id']))->getField('pigcms_id');
                        $add_data = array(
                            'pigcms_id' => $pigcms_id,
                            'ac_id' => $_POST['ac_id'],    //开关ID
                            'village_id' => $_POST['village_id'],    //社区ID
                            'opdate' => time(),//开门时间
                            'type' => 2//通过我的钥匙进入
                        );
                        $control_log = M('access_control_user_log')->data($add_data)->add();
                        if ($control_log) {
                            //开门操作
                            //修改于2017.1.5
                            $where_terrace = M('terrace')->where(array('is_use' => 1, 'is_del' => 0))->find();
                            $choose_hick = M('hickey')->where(array('terrace_id' => $where_terrace['pigcms_id'], 'is_use' => 1, 'is_del' => 0, 'hick_action' => '智能门禁'))->find();
                            //对于独特字段参数字段进行后台处理
                            $arguments = $choose_hick['arguments'];
                            $arguments_value = $choose_hick['arguments_value'];
                            $arguments_array = explode(",", $arguments);
                            $arguments_array_value = explode(",", $arguments_value);
                            $arguments_all_feild = array(
                                'village_id' => $_POST['village_id'],
                                'ac_id' => $_POST['ac_id'],
                                'state' => 'key'
                            );
                            foreach ($arguments_array_value as $k => $v) {
                                if ($v != '') {
                                    $arguments_all_feild[$arguments_array[$k]] = $v;
                                }
                            }
                            $msg_array = $this->$choose_hick['hickey_control']($arguments_all_feild);
                            echo json_encode($msg_array);

                        } else {
                            echo json_encode(array('err_code' => 1, 'code_msg' => '记录失败'));
                        }
                    }
                }
            } else {
                $condition_table = array(
                    'pigcms_house_village' => 'village',
                    'pigcms_access_control_group' => 'group',
                    'pigcms_access_control' => 'control'
                );
                $condition_where = 'village.village_id=group.village_id and group.ag_id=control.ag_id and control.ac_status=1';
                $condition_field = 'village.village_id,village.village_name,village.lat,village.long,group.ag_name,control.ac_id,control.ag_id,control.ac_name,control.apikey,control.nodeid,control.sensorid';
                $access_control_result = M('')->table($condition_table)->where($condition_where)->field($condition_field)->select();
                $long_lat = D('User_long_lat')->getLocation($_SESSION['openid'], 0);    //获取用户位置信息
                //dump($long_lat);
                if ($access_control_result && $long_lat) {
                    $rangeSort = array();
                    foreach ($access_control_result as &$village_value) {
                        $village_value['range_int'] = getDistance($village_value['lat'], $village_value['long'], $long_lat['lat'], $long_lat['long']);//用户与社区距离
                        $village_value['range'] = getRange($village_value['range_int']);
                        $rangeSort[] = $village_value['range_int'];
                    }
                    array_multisort($rangeSort, SORT_ASC, $access_control_result);//按距离近远排序
                }
                $new_arr = array();
                foreach ($access_control_result as $key => $val) {
                    $new_arr[$val['village_id']]['beforparent'] = $val['village_name'];    //一级父级名称
                    $new_arr[$val['village_id']]['range'] = $val['range'];    //一级父级距离
                    $new_arr[$val['village_id']]['beforchild'][$val['ag_id']]['afterparent'] = $val['ag_name'];    //二级父级名称
                    $new_arr[$val['village_id']]['beforchild'][$val['ag_id']]['afterchild'][] = $val;    //子级数组内容
                }
                //dump($new_arr);
                $this->assign('control_result', $new_arr);
                $signa_arr = unserialize($this->getSigna(D('Access_token_expires')->get_access_token()['access_token']));
                $signa_arr['appid'] = $this->config['wechat_appid'];
                $this->assign('signa_arr', $signa_arr);    //微信定位所须参数
                $share_arr = array(        //分享
                    'title' => '我的钥匙',
                    'desc' => '汇得行-生活智慧助手',
                    'imgUrl' => C('config.site_url') . '/tpl/Wap/myinterface/static/images/house.jpg',
                    'link' => C('config.site_url') . '/wap.php?g=Wap&c=House&a=access_control_ask&village_id=' . $_GET['village_id']
                );
                $share = new WechatShare($this->config, $_SESSION['openid'], $share_arr);
                $this->shareScript = $share->getSgin();
                $this->assign('shareScript', $this->shareScript);
                $this->display();
            }
        }
    }

    /* 我的钥匙展示（所有社区）
	* @time 2016-08-08
	* @author	小邓  <969101097@qq.com>*/
    public function control_show_ajax()
    {
        $condition_table = array(
            'pigcms_house_village' => 'village',
            'pigcms_access_control_group' => 'group',
            'pigcms_access_control' => 'control'
        );
        $condition_where = 'village.village_id=group.village_id and group.ag_id=control.ag_id and control.ac_status=1';
        $condition_field = 'village.village_id,village.village_name,village.lat,village.long,group.ag_name,control.ac_id,control.ag_id,control.ac_name,control.apikey,control.nodeid,control.sensorid';
        $access_control_result = M('')->table($condition_table)->where($condition_where)->field($condition_field)->select();
        $long_lat = D('User_long_lat')->getLocation($_SESSION['openid'], 0);    //获取用户位置信息
        //dump($long_lat);
        if ($access_control_result && $long_lat) {
            $rangeSort = array();
            foreach ($access_control_result as &$village_value) {
                $village_value['range_int'] = getDistance($village_value['lat'], $village_value['long'], $long_lat['lat'], $long_lat['long']);//用户与社区距离
                $village_value['range'] = getRange($village_value['range_int']);
                $rangeSort[] = $village_value['range_int'];
            }
            array_multisort($rangeSort, SORT_ASC, $access_control_result);//按距离近远排序
        }
        $new_arr = array();
        foreach ($access_control_result as $key => $val) {
            $new_arr[$val['village_id']]['beforparent'] = $val['village_name'];    //一级父级名称
            $new_arr[$val['village_id']]['range'] = $val['range'];    //一级父级距离
            $new_arr[$val['village_id']]['beforchild'][$val['ag_id']]['afterparent'] = $val['ag_name'];    //二级父级名称
            $new_arr[$val['village_id']]['beforchild'][$val['ag_id']]['afterchild'][] = $val;    //子级数组内容
        }
        //dump($new_arr);
        $this->ajaxReturn(array('code_err' => 0, 'code_msg' => $new_arr));
    }

    /* 用户资料审核列表
	* @time 2016-08-20
	* @author	陈琦  <969101097@qq.com>*/
    public function village_control_check()
    {
        /*$now_village=$this->get_village($_GET['village_id']);
		$check_info=M('login_user')->where(array('uid'=>$this->user_session['uid'],'village_id'=>$now_village['village_id']))->field('status,company_id')->find();
		if(!$check_info['status']){
			$this->redirect(U('House/village_my_bind',array('village_id'=>$now_village['village_id'])));
		}else{
			if($check_info['company_id']){
				$condition_table=array(C('DB_PREFIX').'House_village_user_bind'=>'n',C('DB_PREFIX').'user'=>'u',C('DB_PREFIX').'house_village'=>'v',C('DB_PREFIX').'company'=>'c');
				$condition_where="n.ac_status>=1 and u.uid=n.uid and n.village_id=v.village_id and c.company_id=n.company_id and n.company_id=".$check_info['company_id']." and n.village_id=".$_GET['village_id'];
			}else{
				$condition_table=array(C('DB_PREFIX').'House_village_user_bind'=>'n',C('DB_PREFIX').'user'=>'u',C('DB_PREFIX').'house_village'=>'v',C('DB_PREFIX').'company'=>'c');
				$condition_where="n.ac_status>=1 and u.uid=n.uid and n.village_id=v.village_id and c.company_id=n.company_id and n.village_id=".$_GET['village_id'];
			}
			$condition_field='n.*,u.nickname,c.company_name';
			$order='n.add_time DESC';
			$userCheck_list=D('')->field($condition_field)->table($condition_table)->where($condition_where)->order($order)->select();
			$this->assign('check_list',$userCheck_list);
			$this->display();
		}*/
        if (IS_AJAX) {
            $check_info = M('login_user')->where(array('uid' => $this->user_session['uid'], 'village_id' => $_POST['village_id']))->field('status,company_id')->find();
            $condition_table = array(C('DB_PREFIX') . 'House_village_user_bind' => 'n', C('DB_PREFIX') . 'user' => 'u', C('DB_PREFIX') . 'house_village' => 'v', C('DB_PREFIX') . 'company' => 'c');
            if ($check_info['company_id']) {
                $condition_where = "n.ac_status>=1 and u.uid=n.uid and n.village_id=v.village_id and c.company_id=n.company_id and n.company_id=" . $check_info['company_id'] . " and n.village_id=" . $_POST['village_id'];
            } else {
                $condition_where = "n.ac_status>=1 and u.uid=n.uid and n.village_id=v.village_id and c.company_id=n.company_id and n.village_id=" . $_POST['village_id'];
            }
            $condition_field = 'n.*,u.nickname,c.company_name';
            $order = 'n.add_time DESC';
            $keyword = isset($_POST['keyword']) ? trim($_POST['keyword']) : '';
            if (!empty($keyword) || ($keyword == 0)) {
                $condition_where .= ' AND (n.name like "%' . $keyword . '%" OR c.company_name like "%' . $keyword . '%")';
            }
            $pindex = intval(trim($_POST['pindex']));
            $pindex = $pindex > 0 ? $pindex : 1;

            $pagsize = 20;
            $offsize = ($pindex - 1) * 20;

            $check_list = D('')->table($condition_table)->field($condition_field)->where($condition_where)->order($order)->limit($offsize . ',' . $pagsize)->select();
            if (!empty($check_list)) {
                foreach ($check_list as $kk => $vv) {
                    $check_list[$kk]['created'] = date('Y-m-d H:i:s', $vv['add_time']);
                }
            }
            $this->dexit(array('list' => !empty($check_list) ? $check_list : array(), 'pindex' => $pindex));
        } else {
            $now_village = $this->get_village($_GET['village_id']);
            $check_info = M('login_user')->where(array('uid' => $this->user_session['uid'], 'village_id' => $now_village['village_id']))->field('status,company_id')->find();
            if (!$check_info['status']) {
                $this->redirect(U('House/village_my_bind', array('village_id' => $now_village['village_id'])));
            }
            $this->display();
        }
    }

    /* 用户资料审核详细
	* @time 2016-06-24
	* @author	小邓  <969101097@qq.com>*/
    public function village_control_checkInfo()
    {
        //dump($this->user_session);exit;
        $now_village = $this->get_village($_GET['village_id']);
        //微信类库
        $wechat = new WechatModel();
        if (IS_POST) {
            //$find_name=M('house_village_user_bind')->where(array('pigcms_id'=>$_POST['id_val'],'ac_status'=>$_POST['ac_status']))->getField('name');
            $find_name = M('house_village_user_bind')->where(array('pigcms_id' => $_POST['id_val'], 'ac_status' => array('in', '2,3,4')))->getField('name');
            if ($find_name) {    //判断是否已通过或不通过
                echo json_encode(array('err_code' => 1, 'code_msg' => '当前资料已审核！'));
            } else {
                if (!empty($_POST['ac_desc'])) {
                    $data = array(
                        'ac_status' => $_POST['ac_status'],
                        'ac_desc' => $_POST['ac_desc']
                    );
                } else {
                    $data['ac_status'] = $_POST['ac_status'];
                }
                if ($this->user_session['truename']) {
                    $data['check_name'] = $this->user_session['truename'];//手机端添加审核人名称，$this->user_session其实就是user表。user表中truename来自user_bind表中最新的name,若没提交资料则truename为空
                } else {
                    $data['check_name'] = $this->user_session['nickname'];
                }
                //判断审核人的身份
                $w=array(
                    '_string' => 'find_in_set("'.$_GET['village_id'].'",village_id_list)'.' or '.'village_id_list="all"',
                    'openid' =>  $_SESSION['openid'],
                );
                $login_info = M('admin')->where($w)->find();
                
                if ($login_info && !$login_info['company_id']) {   //非公司管理员                    
                    $alter = M('house_village_user_bind')->where(array('pigcms_id' => $_POST['id_val']))->data($data)->save();
                    if ($alter) {
                        echo json_encode(array('err_code' => 0, 'code_msg' => '提交成功'));
                        if (intVal($_POST['ac_status']) == 2) {
                            $first = '您提交的门禁信息已通过审核！';
                            $href = C('config.site_url') . '/wap.php?c=House&a=village_access_finish&village_id=' . $_GET['village_id'];
                        } else {
                            $first = '您提交的门禁信息未通过审核！';
                            $href = C('config.site_url') . '/wap.php?c=House&a=village_access_next&village_id=' . $_GET['village_id'];
                        }                                                //消息推送
                        $user_info = M('user')->where(array('uid' => $_POST['uid_val']))->field('openid,truename,phone')->find();
                        $model = new templateNews(C('config.wechat_appid'), C('config.wechat_appsecret'));
                        // $model->sendTempMsg('OPENTM201136105', array('href' => $href, 'wecha_id' => $user_info['openid'], 'first' => $first, 'keyword1' => $user_info['truename'], 'keyword2' => $user_info['phone'], 'keyword3' => date('Y-m-d H:i:s')));

                        $openid = $user_info['openid'];
                        // $openid = 'ohgcf0lvS3Ht7vH5n9PXbr5AEKtU';
                        $tpl_id = "xLpzcYPX-Kgwsx6Ym3sHjp_CmZhn_n65_-v6CxC4gAc";
                        $data = array(
                            "first"=>array(
                                   "value"=>$first,
                                   "color"=>"#173177"
                           ),
                            "keyword1"=>array(
                               "value"=>"智能门禁",
                               "color"=>"#173177"
                           ),
                           "keyword2"=>array(
                               "value"=>$user_info['truename'],
                               "color"=>"#173177"
                           ),
                           "keyword3"=>array(
                               "value"=>$user_info['phone'],
                               "color"=>"#173177"
                           ),
                           "keyword4"=>array(
                               "value"=>date('Y-m-d H:i:s'),
                               "color"=>"#173177"
                           ),
                        );
                        $url = $href;
                        $res = $wechat->send_tpl_message($openid, $tpl_id, $url, $data);

                    } else {

                        echo json_encode(array('err_code' => 1, 'code_msg' => '提交失败'));
                    }
                } else {    //公司管理员
                    
                    if ($login_info && $login_info['company_id']) {
                        
                        $is_admin = M('company')->where(array('company_id' => $login_info['company_id']))->getField('is_admin');
                        if ($is_admin == 1) {    //无须社区管理员二次审核
                            
                            $alter = M('house_village_user_bind')->where(array('pigcms_id' => $_POST['id_val']))->data($data)->save();
                            if ($alter) {
                                echo json_encode(array('err_code' => 0, 'code_msg' => '提交成功'));
                                if (intVal($_POST['ac_status']) == 2) {
                                    $first = '您提交的门禁信息已通过审核！';
                                    $href = C('config.site_url') . '/wap.php?c=House&a=village_access_finish&village_id=' . $_GET['village_id'];
                                } else {
                                    $first = '您提交的门禁信息未通过审核！';
                                    $href = C('config.site_url') . '/wap.php?c=House&a=village_access_next&village_id=' . $_GET['village_id'];
                                }                                                //消息推送
                                $user_info = M('user')->where(array('uid' => $_POST['uid_val']))->field('openid,truename,phone')->find();
                                //审核后推送给发起人的信息
                                $model = new templateNews(C('config.wechat_appid'), C('config.wechat_appsecret'));
                                // $model->sendTempMsg('OPENTM201136105', array('href' => $href, 'wecha_id' => $user_info['openid'], 'first' => $first, 'keyword1' => $user_info['truename'], 'keyword2' => $user_info['phone'], 'keyword3' => date('Y-m-d H:i:s')));
                                //修改处
                                $openid = $user_info['openid'];
                                // $openid = 'ohgcf0lvS3Ht7vH5n9PXbr5AEKtU';
                                $tpl_id = "xLpzcYPX-Kgwsx6Ym3sHjp_CmZhn_n65_-v6CxC4gAc";
                                $data = array(
                                    "first"=>array(
                                           "value"=>$first,
                                           "color"=>"#173177"
                                   ),
                                    "keyword1"=>array(
                                       "value"=>"智能门禁",
                                       "color"=>"#173177"
                                   ),
                                   "keyword2"=>array(
                                       "value"=>$user_info['truename'],
                                       "color"=>"#173177"
                                   ),
                                   "keyword3"=>array(
                                       "value"=>$user_info['phone'],
                                       "color"=>"#173177"
                                   ),
                                   "keyword4"=>array(
                                       "value"=>date('Y-m-d H:i:s'),
                                       "color"=>"#173177"
                                   ),
                                );
                                $url = $href;
                                $res = $wechat->send_tpl_message($openid, $tpl_id, $url, $data);
                            } else {
                                echo json_encode(array('err_code' => 1, 'code_msg' => '提交失败'));
                            }
                        } else {    //须社区管理员二次审核
                            
                            echo json_encode(array('err_code' => 1, 'code_msg' => '转交给社区管理员审核'));
                            $time = time();        //审核信息推送
                            $href = C('config.site_url') . '/wap.php?c=House&a=village_control_checkInfo&village_id=' . $_GET['village_id'] . '&id_val=' . $_POST['id_val'];
                            $model = new templateNews(C('config.wechat_appid'), C('config.wechat_appsecret'));
                            // $role_arr = M('role')->where(array('menus' => array('like', '%29%')))->field('role_id')->select();
                            $where=array(
                                '_string' => 'find_in_set("29",menus)',
                            );
                            $role_arr = M('role')->where($where)->field(array('role_id'))->select();
                            $role_str = '';
                            foreach ($role_arr as $value) {
                                $role_str .= $value['role_id'] . ',';    //以,拼接角色ID
                            }
                            $uid_arr = M('admin')->field('openid')->where(array('role_id' => array('in', trim($role_str, ',')), 'village_id' => $_GET['village_id'], 'status' => 1, 'company_id' => 0))->select();
                            if (!empty($uid_arr)) {
                                foreach ($uid_arr as $val) {
                                    // $wecha_id = $val['openid'];
                                    // $wecha_id = M('user')->where(array('uid' => $val['uid']))->getField('openid');//获取user微信用户表中有权限29用户的openid，
                                    // $model->sendTempMsg('OPENTM207145917', array('href' => $href, 'wecha_id' => $wecha_id, 'first' => '您有一个待审核的信息！', 'keyword1' => '智能门禁', 'keyword2' => '管理员审核', 'keyword3' => date('Y-m-d H:i:s')));

                                    $openid = $val['openid'];
                                    // $openid = 'ohgcf0lvS3Ht7vH5n9PXbr5AEKtU';
                                    $tpl_id = "xLpzcYPX-Kgwsx6Ym3sHjp_CmZhn_n65_-v6CxC4gAc";
                                    $data = array(
                                        "first"=>array(
                                               "value"=>"您有一个待审核的信息！",
                                               "color"=>"#173177"
                                       ),
                                       "keyword1"=>array(
                                           "value"=>"智能门禁",
                                           "color"=>"#173177"
                                       ),
                                       "keyword2"=>array(
                                           "value"=>$_POST['name'],
                                           "color"=>"#173177"
                                       ),
                                       "keyword3"=>array(
                                           "value"=>$village_name,
                                           "color"=>"#173177"
                                       ),
                                       "keyword4"=>array(
                                           "value"=>date('Y-m-d H:i:s'),
                                           "color"=>"#173177"
                                       ),
                                    );
                                    $url = $href;
                                    $res = $wechat->send_tpl_message($openid, $tpl_id, $url, $data);
                                }
                            }
                        }
                    }
                }
            }
        } else {
            $condition_table = array(C('DB_PREFIX') . 'house_village_user_bind' => 'v', C('DB_PREFIX') . 'company' => 'c', C('DB_PREFIX') . 'house_village' => 'a');
            $condition_where = 'v.company_id=c.company_id and v.village_id=a.village_id and v.pigcms_id=' . $_GET['id_val'];
            $condition_field = 'v.*,c.company_name,a.village_name';
            $user_info = D('')->table($condition_table)->where($condition_where)->field($condition_field)->find();
            //dump($user_info);
            //$user_info=M('house_village_user_bind')->where(array('pigcms_id'=>$_GET['id_val']))->find();
            $this->assign('user_info', $user_info);
            $this->display();
        }
    }

    /* 用户资料审核删除
	* @time 2016-06-24
	* @author	小邓  <969101097@qq.com>*/
    public function village_control_checkdel()
    {
        $now_village = $this->get_village($_POST['village_id']);
        if (IS_POST) {
            $pigcms_id = I('post.id_val');
            $del = M('House_village_user_bind')->where('pigcms_id=' . $pigcms_id)->delete();
            if ($del) {
                //$this->success('删除成功！',U('House/village_control_check',array('village_id'=>$now_village['village_id'])));
                $this->dexit(array('error' => 0));
            } else {
                //$this->error('删除失败！请重试~');
                $this->dexit(array('error' => 1));
            }
        }
    }

    /* 在线报表
       @time 2016-07-14
       @author	陈琦  <849176855@qq.com>
	*/
    public function village_repair()
    {
        if (IS_AJAX) {
            $condition_table = array(C('DB_PREFIX') . 'house_village_repair_list' => 'r', C('DB_PREFIX') . 'house_village_user_bind' => 'b');
            $condition_where = " r.village_id = b.village_id  AND r.bind_id = b.pigcms_id AND r.type=1 AND r.village_id=" . $_POST['village_id'];
            $condition_field = 'r.pigcms_id as pid,r.*,b.*';
            $order = ' r.pigcms_id DESC,r.is_read ASC ';
            $keyword = isset($_POST['keyword']) ? trim($_POST['keyword']) : '';
            if (!empty($keyword) || ($keyword == 0)) {
                $condition_where .= ' AND (b.usernum like "%' . $keyword . '%" OR b.name like "%' . $keyword . '%")';
            }
            $pindex = intval(trim($_POST['pindex']));
            $pindex = $pindex > 0 ? $pindex : 1;
            $pagsize = 20;
            $offsize = ($pindex - 1) * 20;
            $repair_list = D('')->table($condition_table)->field($condition_field)->where($condition_where)->order($order)->limit($offsize . ',' . $pagsize)->select();
            if (!empty($repair_list)) {
                foreach ($repair_list as $kk => $vv) {
                    $repair_list[$kk]['created'] = date('Y-m-d H:i:s', $vv['time']);
                }
            }
            $this->dexit(array('list' => !empty($repair_list) ? $repair_list : array(), 'pindex' => $pindex));
        } else {
            $now_village = $this->get_village($_GET['village_id']);
            $this->display();
        }
    }

    /* 在线报表详情
       @time 2016-07-14
       @author	陈琦  <849176855@qq.com>
	*/
    public function village_repairDetail()
    {
        $now_village = $this->get_village($_GET['village_id']);
        $pigcms_id = I('get.pigcms_id');
        //dump($pigcms_id);exit;
        $repair_info = D('VillageRepair')->getRepairInfo($now_village['village_id'], $pigcms_id);
        //dump($repair_info);exit;
        $this->assign('repair_info', $repair_info);
        $this->display();
    }

    /* 在线报表标记处理
       @time 2016-07-14
       @author	陈琦  <849176855@qq.com>
	*/
    public function do_repair()
    {
        if (IS_AJAX) {
            $village_id = $_POST['village_id'] ? intval($_POST['village_id']) : 0;
            $cms_id = $_POST['cid'] ? intval($_POST['cid']) : 0;
            if ($cms_id && $village_id) {
                $data['village_id'] = $village_id;
                $data['pigcms_id'] = $cms_id;
                $result = D('House_village_repair_list')->where($data)->data(array('is_read' => 1))->save();
                if ($result !== false) {
                    $this->ajaxReturn(array('error' => 0));
                } else {
                    $this->ajaxReturn(array('msg' => '处理失败请重试', 'error' => 1));
                }
            } else {
                $this->ajaxReturn(array('msg' => '信息有误', 'error' => 1));
            }
        }
    }

    /* 用户开门记录列表
	* @time 2016-06-29
	* @author	陈琦  <849176855@qq.com>*/
    public function village_user_openLog()
    {
        if (IS_AJAX) {
            $condition_table = array(
                'pigcms_access_control' => 'control',
                'pigcms_house_village_user_bind' => 'bind',
                'pigcms_access_control_user_log' => 'Log.class',
                'pigcms_house_village' => 'village',
                'pigcms_company' => 'company'
            );
            $check_info = M('login_user')->where(array('uid' => $this->user_session['uid'], 'village_id' => $_POST['village_id']))->field('status,company_id')->find();
            if ($check_info['company_id']) {
                $condition_where = 'log.ac_id=control.ac_id and log.pigcms_id=bind.pigcms_id and company.company_id=bind.company_id and bind.company_id=' . $check_info['company_id'] . ' and log.village_id=village.village_id and log.village_id=' . $_POST['village_id'];
            } else {
                $condition_where = 'log.ac_id=control.ac_id and log.pigcms_id=bind.pigcms_id and log.village_id=village.village_id and company.company_id=bind.company_id and log.village_id=' . $_POST['village_id'];
            }
            $condition_field = 'control.ac_name,control.village_id,card_type,bind.usernum,bind.name,bind.company,log.log_id,log.opdate,village.village_name,bind.company_id,company.company_id';
            $order = 'log.opdate desc ';
            $keyword = isset($_POST['keyword']) ? trim($_POST['keyword']) : '';
            if (!empty($keyword) || ($keyword == 0)) {
                $condition_where .= ' AND (bind.name like "%' . $keyword . '%" OR bind.usernum like "%' . $keyword . '%")';
            }
            $pindex = intval(trim($_POST['pindex']));
            $pindex = $pindex > 0 ? $pindex : 1;
            $pagsize = 20;
            $offsize = ($pindex - 1) * 20;
            $group_list = D('')->table($condition_table)->field($condition_field)->where($condition_where)->order($order)->limit($offsize . ',' . $pagsize)->select();
            if (!empty($group_list)) {
                foreach ($group_list as $kk => $vv) {
                    $group_list[$kk]['created'] = date('Y-m-d H:i:s', $vv['opdate']);
                }
            }
            $this->dexit(array('list' => !empty($group_list) ? $group_list : array(), 'pindex' => $pindex));
        } else {
            $now_village = $this->get_village($_GET['village_id']);
            $check_info = M('login_user')->where(array('uid' => $this->user_session['uid'], 'village_id' => $now_village['village_id']))->field('status,company_id')->find();
            if (!$check_info['status']) {
                $this->redirect(U('House/village_my_bind', array('village_id' => $now_village['village_id'])));
            }
            $this->display();
        }
    }

    /* 用户开门记录详情
	* @time 2016-06-29
	* @author	陈琦  <849176855@qq.com>*/
    public function village_user_openDetail()
    {
        $now_village = $this->get_village($_GET['village_id']);
        $log_id = I('get.log_id');
        $get_log_info = D('AccessControlLog')->getLoginfo($log_id);
        $this->assign('log_info', $get_log_info);
        $this->display();
    }

    /* 访客登记信息
        * @time 2016-08-22
        * @author	陈琦  <849176855@qq.com>*/
    public function village_visitorLog()
    {
        if (IS_AJAX) {
            $condition_table = array(
                'pigcms_house_village_user_bind' => 'bind',
                'pigcms_house_village' => 'village',
            );
            $condition_where = 'bind.village_id=village.village_id and bind.role=2 and bind.village_id=' . $_POST['village_id'];
            $condition_field = 'bind.name,bind.add_time,bind.company,bind.pigcms_id,bind.village_id,village.village_name';
            $order = 'bind.add_time desc ';
            $keyword = isset($_POST['keyword']) ? trim($_POST['keyword']) : '';
            if (!empty($keyword) || ($keyword == 0)) {
                $condition_where .= ' AND (bind.name like "%' . $keyword . '%")';
            }
            $pindex = intval(trim($_POST['pindex']));
            $pindex = $pindex > 0 ? $pindex : 1;
            $pagsize = 20;
            $offsize = ($pindex - 1) * 20;
            $group_list = D('')->table($condition_table)->field($condition_field)->where($condition_where)->order($order)->limit($offsize . ',' . $pagsize)->select();
            if (!empty($group_list)) {
                foreach ($group_list as $kk => $vv) {
                    $group_list[$kk]['created'] = date('Y-m-d H:i:s', $vv['add_time']);
                }
            }
            $this->dexit(array('list' => !empty($group_list) ? $group_list : array(), 'pindex' => $pindex));
        } else {
            $now_village = $this->get_village($_GET['village_id']);
            $this->display();
        }
    }

    /* 访客登记详情
	* @time 2016-08-22
	* @author	陈琦  <849176855@qq.com>*/
    public function village_visitorLog_detail()
    {
        $now_village = $this->get_village($_GET['village_id']);
        $pigcms_id = $_GET['pigcms_id'];
        if ($pigcms_id) {
            $condition_table = array(C('DB_PREFIX') . 'House_village_user_bind' => 'n', C('DB_PREFIX') . 'user' => 'u', C('DB_PREFIX') . 'house_village' => 'v');
            $condition_where = "u.uid=n.uid and n.village_id=v.village_id and n.role=2 and n.pigcms_id=" . $pigcms_id;
            $condition_field = 'n.*,u.nickname';
            $visitor_info = D('')->table($condition_table)->where($condition_where)->field($condition_field)->find();
            //dump($visitor_info);exit;
            $this->assign('visitor_info', $visitor_info);

        }
        $this->display();
    }

    /* 新闻评论
	* @time 2016-07-15
	* @author	陈琦  <849176855@qq.com>*/
//	public function village_newsReply(){
//		$now_village=$this->get_village($_GET['village_id']);
//		$condition_table  = array(C('DB_PREFIX').'house_village_news'=>'n',C('DB_PREFIX').'house_village_news_category'=>'c',C('DB_PREFIX').'house_village_news_reply'=>'r',C('DB_PREFIX').'user'=>'u');
//		$condition_where = " n.village_id = r.village_id  AND n.village_id = c.village_id  AND n.news_id = r.news_id  AND r.uid = u.uid AND  n.cat_id = c.cat_id AND c.cat_status=1  AND n.village_id=".$_GET['village_id'];
//		$condition_field = 'n.title,c.cat_name,r.*,u.nickname';
//		$order='r.add_time DESC';
//		$reply_list = D('')->field($condition_field)->table($condition_table)->where($condition_where)->order($order)->select();
//		$this->assign('reply_list',$reply_list);
//		$this->display();
//	}
    public function village_newsReply()
    {
        if (IS_AJAX) {
            $condition_table = array(C('DB_PREFIX') . 'house_village_news' => 'n', C('DB_PREFIX') . 'house_village_news_category' => 'c', C('DB_PREFIX') . 'house_village_news_reply' => 'r', C('DB_PREFIX') . 'user' => 'u');
            $condition_where = " n.village_id = r.village_id  AND n.village_id = c.village_id  AND n.news_id = r.news_id  AND r.uid = u.uid AND  n.cat_id = c.cat_id AND c.cat_status=1  AND n.village_id=" . $_POST['village_id'];
            $condition_field = 'n.title,c.cat_name,r.*,u.nickname';
            $order = 'r.add_time DESC';
            $keyword = isset($_POST['keyword']) ? trim($_POST['keyword']) : '';
            if (!empty($keyword) || ($keyword == 0)) {
                $condition_where .= ' AND (n.title like "%' . $keyword . '%")';
            }

            $pindex = intval(trim($_POST['pindex']));
            $pindex = $pindex > 0 ? $pindex : 1;
            $pagsize = 20;
            $offsize = ($pindex - 1) * 20;
            $repair_list = D('')->table($condition_table)->field($condition_field)->where($condition_where)->order($order)->limit($offsize . ',' . $pagsize)->select();
            if (!empty($repair_list)) {
                foreach ($repair_list as $kk => $vv) {
                    $repair_list[$kk]['created'] = date('Y-m-d H:i:s', $vv['add_time']);
                }
            }
            $this->dexit(array('list' => !empty($repair_list) ? $repair_list : array(), 'pindex' => $pindex));
        } else {
            $now_village = $this->get_village($_GET['village_id']);
            $this->display();
        }

    }

    public function village_suggest()
    {
        if (IS_AJAX) {
            $condition_table = array(C('DB_PREFIX') . 'house_village_repair_list' => 'r', C('DB_PREFIX') . 'house_village_user_bind' => 'b');
            $condition_where = " r.village_id = b.village_id  AND r.bind_id = b.pigcms_id AND r.type=3 AND r.village_id=" . $_POST['village_id'];
            $condition_field = 'r.pigcms_id as pid,r.*,b.*';
            $order = ' r.pigcms_id DESC,r.is_read ASC ';
            $keyword = isset($_POST['keyword']) ? trim($_POST['keyword']) : '';
            if (!empty($keyword) || ($keyword == 0)) {
                $condition_where .= ' AND (b.usernum like "%' . $keyword . '%" OR b.name like "%' . $keyword . '%")';
            }
            $pindex = intval(trim($_POST['pindex']));
            $pindex = $pindex > 0 ? $pindex : 1;
            $pagsize = 20;
            $offsize = ($pindex - 1) * 20;
            $repair_list = D('')->table($condition_table)->field($condition_field)->where($condition_where)->order($order)->limit($offsize . ',' . $pagsize)->select();
            if (!empty($repair_list)) {
                foreach ($repair_list as $kk => $vv) {
                    $repair_list[$kk]['created'] = date('Y-m-d H:i:s', $vv['time']);
                }
            }
            $this->dexit(array('list' => !empty($repair_list) ? $repair_list : array(), 'pindex' => $pindex));
        } else {
            $now_village = $this->get_village($_GET['village_id']);
            $this->display();
        }


    }

    public function do_suggest()
    {
        if (IS_AJAX) {
            $village_id = $_POST['village_id'] ? intval($_POST['village_id']) : 0;
            $cms_id = $_POST['cid'] ? intval($_POST['cid']) : 0;
            if ($cms_id && $village_id) {
                $data['village_id'] = $village_id;
                $data['pigcms_id'] = $cms_id;
                $result = D('House_village_repair_list')->where($data)->data(array('is_read' => 1))->save();
                if ($result !== false) {
                    $this->ajaxReturn(array('error' => 0));
                } else {
                    $this->ajaxReturn(array('msg' => '处理失败请重试', 'error' => 1));
                }
            } else {
                $this->ajaxReturn(array('msg' => '信息有误', 'error' => 1));
            }
        }
    }

    public function village_suggestDetail()
    {
        $now_village = $this->get_village($_GET['village_id']);
        $pigcms_id = I('get.pigcms_id');
        //dump($pigcms_id);exit;
        $suggest_info = D('VillageRepair')->getSuggestInfo($now_village['village_id'], $pigcms_id);
        //dump($repair_info);exit;
        $this->assign('suggest_info', $suggest_info);
        $this->display();
    }

    /* 开门申请选择
	* @time 2016-06-30
	* @author	小邓  <969101097@qq.com>*/
    public function access_control_change()
    {
        $now_village = $this->get_village($_GET['village_id']);
        if($now_village['village_type']==1) redirect(U('access_control_change_uptown',array('village_id'=>$_GET['village_id'])));
        if (empty($this->user_session)) {    //判断是否已登录
            redirect(U('Wap/Login/weixin', array('referer' => urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']))));
        } else {
            if ($_GET['control'] && $_GET['control'] == 'key') {
                $this->assign('control', $_GET['control']);
            }
            if (!empty($_GET['ac_id'])) {    //判断是否是扫设备码进入
                $this->assign('ac_id', $_GET['ac_id']);
                if (!empty($this->user_session)) {    //判断是否获取到当前用户
                    $dateline = M('user_long_lat')->where(array('open_id' => $this->user_session['openid']))->getField('dateline');
                    if (empty($dateline) || ($dateline && time() - $dateline > 5 * 60)) {
                        $signa_arr = unserialize($this->getSigna(D('Access_token_expires')->get_access_token()['access_token']));
                        $signa_arr['appid'] = $this->config['wechat_appid'];
                        $this->assign('signa_arr', $signa_arr);    //微信定位所须参数
                    }
                }
            }
            $user_info = M('house_village_user_bind')->where(array('uid' => $this->user_session['uid'], 'village_id' => $_GET['village_id']))->find();
            if (!$user_info) {    //判断是否已存在
                $this->display();
            } else {
                if ($user_info['role'] <= 1 || $user_info['role'] == "") {    //业主身份
                    if ($user_info['ac_status'] == 1 || $user_info['ac_status'] == 3) {    //是业主且已提交智能门禁审核但没得到认可时
                        if ($_GET['control'] && $_GET['control'] == 'key') {    //判断是否是我的钥匙
                            $this->redirect('你提交的资料正在审核中或审核未通过', U('House/village_access_next', array('village_id' => $_GET['village_id'])));
                        } else {
                            $this->redirect(U('House/village', array('village_id' => $_GET['village_id'])));
                        }
                    } else if (empty($user_info['ac_status'])) {    //是业主但没有提交智能门禁审核
                        if ($_GET['control'] && $_GET['control'] == 'key') {    //判断是否是我的钥匙
                            $this->redirect('请提交智能门禁资料审核', U('House/village_access_control', array('village_id' => $_GET['village_id'])));
                        } else {
                            $this->redirect(U('House/village', array('village_id' => $_GET['village_id'])));
                        }
                    } else {    //门禁展示页面
                        if ($_GET['control'] && $_GET['control'] == 'key') {    //判断是否是我的钥匙
                            $this->redirect(U('House/village_access_show', array('village_id' => $_GET['village_id'])));
                        } else {
                            $this->redirect(U('House/village', array('village_id' => $_GET['village_id'])));
                        }
                    }
                } else {                            //临时访客身份
                    if (time() - $user_info['last_time'] > 24 * 60 * 60) {    //访客上次提交的审核资料超过24小时
                        $this->display();
                    } else {    //访客扫码提示页面
                        $this->redirect(U('House/noticeKid', array('village_id' => $_GET['village_id'])));
                    }
                }
            }
        }
    }

    /**
     * 业主认证 小区版本
     * @author zhukeqin
     */
    public function access_control_change_uptown()
    {
        $now_village = $this->get_village($_GET['village_id']);
        if($now_village['village_type']==0) redirect(U('access_control_change',array('village_id'=>$_GET['village_id'])));
        if (empty($this->user_session)) {    //判断是否已登录
            redirect(U('Wap/Login/weixin', array('referer' => urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']))));
        } else {
            if ($_GET['control'] && $_GET['control'] == 'key') {
                $this->assign('control', $_GET['control']);
            }
            if (!empty($_GET['ac_id'])) {    //判断是否是扫设备码进入
                $this->assign('ac_id', $_GET['ac_id']);
                if (!empty($this->user_session)) {    //判断是否获取到当前用户
                    $dateline = M('user_long_lat')->where(array('open_id' => $this->user_session['openid']))->getField('dateline');
                    if (empty($dateline) || ($dateline && time() - $dateline > 5 * 60)) {
                        $signa_arr = unserialize($this->getSigna(D('Access_token_expires')->get_access_token()['access_token']));
                        $signa_arr['appid'] = $this->config['wechat_appid'];
                        $this->assign('signa_arr', $signa_arr);    //微信定位所须参数
                    }
                }
            }
            $user_info = M('house_village_user_bind')->where(array('uid' => $this->user_session['uid'], 'village_id' => $_GET['village_id']))->find();
            if (!$user_info) {    //判断是否已存在
                $this->display();
            } elseif($user_info['ac_status']!=2){
                redirect(U('village_access_control',array('village_id'=>$_GET['village_id'])));
            }else{
                $room_list=M('house_village_room')->where(array('village_id'=>$_GET['village_id'],'_string'=>'find_in_set("'.$user_info['pigcms_id'].'","oid")'))->select();
                if(empty($room_list)){
                    redirect(U('village_access_control_uptown',array('village_id'=>$_GET['village_id'])));
                }else{
                    redirect(U('village_uptown_my_room_select',array('village_id'=>$_GET['village_id'])));
                }
            }
        }
    }
    /* 访客开门申请
	* @time 2016-06-28
	* @author	小邓  <969101097@qq.com>*/
    public function access_control_ask()
    {
        $now_village = $this->get_village($_GET['village_id']);
        if (empty($this->user_session)) {    //判断是否已登录
            redirect(U('Wap/Login/weixin', array('referer' => urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']))));
        } else {
            $where_data = array(
                'uid' => $this->user_session['uid'],
                'role' => 2,
                'village_id' => $_GET['village_id']
            );
            if (IS_POST) {
                if (empty($_POST['truename'])) {
                    $this->check_ajax_error_tips('请填写真实姓名');
                } else {
                    $_POST['name'] = $_POST['truename'];
                    unset($_POST['truename']);
                }
                if (empty($_POST['phone'])) {
                    $this->check_ajax_error_tips('请填写手机号码');
                }
                if (empty($_POST['company'])) {
                    $this->check_ajax_error_tips('请填写公司名');
                }
                if (empty($_POST['id_card'])) {
                    $this->check_ajax_error_tips('请填写身份证号码');
                }
                $phone = M('house_village_user_bind')->where(array('uid' => array('neq', $this->user_session['uid']), 'village_id' => $_GET['village_id'], 'phone' => $_POST['phone']))->getField('phone');
                if ($phone == $_POST['phone']) {    //判断非本人时此手机号码是否存在
                    header('Content-type: application/json');
                    echo json_encode(array('code_error' => 1, 'code_msg' => '此手机号码已存在请重新填写'));
                    exit;
                }
                $addtime = M('user_modifypwd')->where(array('telphone' => $_POST['phone'], 'vfcode' => $_POST['vcode']))->order('addtime desc')->getField('addtime');
                if (!$addtime || (time() - $addtime > 20 * 60)) {    //判断验证码是否存在或过期
                    header('Content-type: application/json');
                    echo json_encode(array('err_code' => 2, 'code_msg' => '此验证码已过期或错误，请重新输入'));
                    exit;
                }
                $village_bind_name = M('house_village_user_bind')->where($where_data)->getField('name');
                if ($village_bind_name) {    //判断是否已存在
                    $_POST['last_time'] = time();    //修改时间
                    $village_bind = M('house_village_user_bind')->where($where_data)->data($_POST)->save();
                } else {                    //首次访问
                    $_POST['uid'] = $this->user_session['uid'];
                    $_POST['village_id'] = $_GET['village_id'];    //社区ID
                    $_POST['role'] = 2;    //表示加入了智能门禁(访客)
                    $_POST['add_time'] = time();    //初始化时间
                    $_POST['last_time'] = time();    //初始化时间
                    $village_bind = M('house_village_user_bind')->data($_POST)->add();
                }
                if ($village_bind) {
                    M('user')->where(array('uid' => $this->user_session['uid']))->data(array('truename' => $_POST['name'], 'phone' => $_POST['phone']))->save();    //修改用户表
                    header('Content-type: application/json');
                    if (!empty($_GET['ac_id'])) {    //判断是否已扫过设备码
                        //echo json_encode(array('err_code'=>0,'code_msg'=>'你已取得访问权限，可以开门啦!'));	//提交成功
                        $control_info = M('access_control')->where(array('ac_id' => $_GET['ac_id']))->field('nodeid,sensorid')->find();
                        $this->access_control_operat_ajax($village_id = $_GET['village_id'], $ac_id = $_GET['ac_id'], $nodeid = $control_info['nodeid'], $sensorid = $control_info['sensorid']);
                    } else {
                        echo json_encode(array('err_code' => 0, 'code_msg' => '你已取得访问权限，请扫设备二维码开门!'));    //提交成功
                    }
                } else {
                    header('Content-type: application/json');
                    echo json_encode(array('err_code' => 1, 'code_msg' => '提交失败，请重试'));    //提交失败
                }
            } else {
                $user_info = M('house_village_user_bind')->where($where_data)->field(array('name,phone,company,id_card'))->find();
                $this->assign('user_info', $user_info);
                $this->assign('ac_id', $_GET['ac_id']);    //设备ID
                $this->display();
            }
        }
    }

    /* 设备二维码开门
	* @time 2016-06-29
	* @author	小邓  <969101097@qq.com>
	 * 修改于2017.1.4，实现可配置原理
	 * */
    public function access_control_open2()
    {
        $now_village = $this->get_village($_GET['village_id']);
        if (empty($this->user_session)) {    //判断是否已登录
            redirect(U('Wap/Login/weixin', array('referer' => urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']))));
        } else {
            $where_data = array(
                'uid' => $this->user_session['uid'],
                'village_id' => $_GET['village_id']    //社区ID
            );
            $user_info = M('house_village_user_bind')->where($where_data)->find();
            if (!$user_info) {    //判断是否已存在
                $this->redirect('请选择身份', U('House/access_control_change', array('village_id' => $_GET['village_id'], 'ac_id' => $_GET['ac_id'], 'control' => 'key')));
            } else {
                if ($user_info['role'] <= 1 || $user_info['role'] == "") {    //业主身份
                    import('ORG.Net.Http');
                    $http = new Http();
                    $access_token = D('Access_token_expires')->get_access_token()['access_token'];
                    $return = $http->curlGet('https://api.weixin.qq.com/cgi-bin/user/info?access_token=' . $access_token . '&openid=' . $this->user_session['openid'] . '&lang=zh_CN');
                    $jsonrt = json_decode($return, true);
                    if ($jsonrt && $jsonrt['subscribe']) {    //判断是否已关注
                        if ($user_info['ac_status'] == 1 || $user_info['ac_status'] == 3) {    //是业主且已提交智能门禁审核但没得到认可时
                            $this->redirect(U('House/access_control_show', array('village_id' => $_GET['village_id'], 'msg' => '你提交的资料正在审核中或审核未通过！', 'url' => 'House/village_access_next')));
                        } else if (empty($user_info['ac_status'])) {    //是业主但没有提交智能门禁审核
                            $this->redirect(U('House/access_control_show', array('village_id' => $_GET['village_id'], 'msg' => '请提交智能门禁资料审核', 'url' => 'House/village_access_control')));
                        } else {
                            //开门操作
                            //修改于2017.1.4
                            $choose_hick = M('hickey')->where(array('hick_action' => '智能门禁', 'is_use' => 1, 'is_del' => 0, 'hick_ac_id' => $_GET['ac_id']))->find();
                            //对于独特字段参数字段进行后台处理
                            $arguments = $choose_hick['arguments'];
                            $arguments_value = $choose_hick['arguments_value'];
                            $arguments_array = explode(",", $arguments);
                            $arguments_array_value = explode(",", $arguments_value);

                            $arguments_all_feild = array(
                                'village_id' => $_GET['village_id'],
                                'ac_id' => $_GET['ac_id'],
                                'terrace_id' => $choose_hick['terrace_id']
                            );
                            foreach ($arguments_array as $k => $v) {
                                $arguments_all_feild[$v] = $arguments_array_value[$k];
                            }
                            $this->redirect(U('House/' . $choose_hick['hickey_control']), $arguments_all_feild);
                            //$control_info=M('access_control')->where(array('ac_id'=>$_GET['ac_id']))->field('nodeid,sensorid')->find();
                            //$this->redirect(U('House/access_control_operat', array('village_id' => $_GET['village_id'], 'ac_id' => $_GET['ac_id'], 'nodeid' => $control_info['nodeid'], 'sensorid' => $control_info['sensorid'])));
                        }
                    } else {
                        $this->redirect(U('House/access_control_show', array('village_id' => $_GET['village_id'], 'msg' => '请先关注汇得行智慧助手公众号后使用微信开门功能！')));
                    }
                } else {                            //临时访客身份
                    if (time() - $user_info['last_time'] > 24 * 60 * 60) {    //访客上次提交的审核资料超过24小时
                        $this->redirect('请重新选择身份', U('House/access_control_change', array('village_id' => $_GET['village_id'], 'ac_id' => $_GET['ac_id'], 'control' => 'key')));
                    } else {    //开门操作
                        $control_info = M('access_control')->where(array('ac_id' => $_GET['ac_id']))->field('nodeid,sensorid')->find();
                        $this->redirect(U('House/access_control_operat', array('village_id' => $_GET['village_id'], 'ac_id' => $_GET['ac_id'], 'nodeid' => $control_info['nodeid'], 'sensorid' => $control_info['sensorid'])));
                    }
                }
            }
        }
    }

    public function access_control_open()
    {
        $now_village = $this->get_village($_GET['village_id']);
        if (empty($this->user_session)) {    //判断是否已登录
            redirect(U('Wap/Login/weixin', array('referer' => urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']))));
        } else {
            $where_data = array(
                'uid' => $this->user_session['uid'],
                'village_id' => $_GET['village_id']    //社区ID
            );
            $user_info = M('house_village_user_bind')->where($where_data)->find();
            //vd(1);exit;
            if (!$user_info) {    //判断是否已存在
                $this->redirect('请选择身份', U('House/access_control_change', array('village_id' => $_GET['village_id'], 'ac_id' => $_GET['ac_id'], 'control' => 'key')));
            } else {
                //vd(1);exit;
                if ($user_info['role'] <= 1 || $user_info['role'] == "") {    //业主身份
                    if ($user_info['ac_status'] == 1 || $user_info['ac_status'] == 3) {    //是业主且已提交智能门禁审核但没得到认可时
                        $this->redirect(U('House/access_control_show', array('village_id' => $_GET['village_id'], 'msg' => '你提交的资料正在审核中或审核未通过！', 'url' => 'House/village_access_next')));
                    } else {
                        //开门操作
                        //修改于2017.1.5
                        $where_terrace = M('terrace')->where(array('is_use' => 1, 'is_del' => 0))->find();
                        $choose_hick = M('hickey')->where(array('terrace_id' => $where_terrace['pigcms_id'], 'is_use' => 1, 'is_del' => 0, 'hick_action' => '智能门禁'))->find();
                        //对于独特字段参数字段进行后台处理
                        $arguments = $choose_hick['arguments'];
                        $arguments_value = $choose_hick['arguments_value'];
                        $arguments_array = explode(",", $arguments);
                        $arguments_array_value = explode(",", $arguments_value);
                        $arguments_all_feild = array(
                            'village_id' => $_GET['village_id'],
                            'ac_id' => $_GET['ac_id']
                        );
                        foreach ($arguments_array_value as $k => $v) {
                            if ($v != '') {
                                $arguments_all_feild[$arguments_array[$k]] = $v;
                            }
                        }
                        //var_dump($choose_hick);exit;
                        $this->redirect(U('House/' . $choose_hick['hickey_control'], array('agv_arr' => $arguments_all_feild)));
                        //$control_info = M('access_control')->where(array('ac_id' => $_GET['ac_id']))->field('nodeid,sensorid')->find();
                        //$this->redirect(U('House/access_control_operat', array('village_id' => $_GET['village_id'], 'ac_id' => $_GET['ac_id'], 'nodeid' => $control_info['nodeid'], 'sensorid' => $control_info['sensorid'])));
                    }
                } else {                            //临时访客身份
                    if (time() - $user_info['last_time'] > 24 * 60 * 60) {    //访客上次提交的审核资料超过24小时
                        $this->redirect('请重新选择身份', U('House/access_control_change', array('village_id' => $_GET['village_id'], 'ac_id' => $_GET['ac_id'], 'control' => 'key')));
                    } else {    //开门操作
                        $control_info = M('access_control')->where(array('ac_id' => $_GET['ac_id']))->field('nodeid,sensorid')->find();
                        //$this->access_control_operat($village_id = $_GET['village_id'], $ac_id = $_GET['ac_id'], $nodeid = $control_info['nodeid'], $sensorid = $control_info['sensorid']);12-26号更改 @waring 跳转失败，
                        $this->redirect(U('House/access_control_operat', array('village_id' => $_GET['village_id'], 'ac_id' => $_GET['ac_id'], 'nodeid' => $control_info['nodeid'], 'sensorid' => $control_info['sensorid'])));
                    }
                }
            }
            //} else {
            //	$this->redirect(U('House/access_control_show', array('village_id' => $_GET['village_id'], 'msg' => '请先关注汇得行智慧助手公众号后使用微信开门功能！')));
            //}
        }
    }

    /*智能门禁统一调度方法
	 * @time 2017-01-11
	 * @author 祝君伟
	 * int village_id 所在社区id
	 * int ac_id 所在设备的id
	 * string 判断是何种进门方式
	 * */
    public function open_door($agv_arr)
    {
        //echo 1;exit();
        //开门数据准备
        //预先读出表中在使用的平台的信息
        $terrace_Ob = M('terrace');
        $access_Ob = M('access_control');
        $where_terrace = $terrace_Ob->where(array('is_use' => 1, 'is_del' => 0))->find();
        $access_array = $access_Ob->where(array('ac_id' => $agv_arr['ac_id']))->find();
        if ($agv_arr['state'] == '') {
            //特殊字段为空的时候为扫码进门
            $where_data = array(
                'uid' => $this->user_session['uid'],
                'village_id' => $agv_arr['village_id'],    //社区ID
            );
            $pigcms_id = M('house_village_user_bind')->where($where_data)->getField('pigcms_id');
            $add_data = array(
                'pigcms_id' => $pigcms_id,
                'ac_id' => $agv_arr['ac_id'],    //开关ID
                'village_id' => $agv_arr['village_id'],    //社区ID
                'opdate' => time(),//开门时间
                'type' => 1
            );
            if ($where_terrace['terrace_class'] == 'Yeelink') {
                //当查询到的类名称为Yeelink时
                //调用yeelink接口
                /*yeelink平台开门方式
	 			* */
                import('@.ORG.' . $where_terrace['terrace_class']);
                $yeelink = new $where_terrace['terrace_class']($apikey = $where_terrace['key'], $deviceid = $access_array['nodeid'], $url = $where_terrace['url']);
                $connect = new Memcached;  //声明一个新的memcached链接
                $connect->setOption(Memcached::OPT_COMPRESSION, false); //关闭压缩功能
                $connect->setOption(Memcached::OPT_BINARY_PROTOCOL, true); //使用binary二进制协议
                $connect->addServer('f120e580f9b74ec5.m.cnhzaliqshpub001.ocs.aliyuncs.com', 11211); //添加OCS实例地址及端口号
                if ($yeelink->getStatus($access_array['sensorid'])) {    //判断开关是否已开
                    $this->redirect(U('House/access_control_show', array('village_id' => $agv_arr['village_id'], 'ac_id' => $agv_arr['ac_id'], 'msg' => '门已开，请直接进入！')));
                    if ($connect->get('arr_key')) {                    //修改对应设备开启时间
                        $arr_key = unserialize($connect->get('arr_key'));
                        $new_arr = array();
                        foreach ($arr_key as $key => $val) {
                            $new_arr[$key] = $val;
                            if ($val['ac_id'] == $agv_arr['ac_id']) {
                                $new_arr[$key]['datetime'] = time();
                            }
                        }
                        $connect->set('arr_key', serialize($new_arr));    //修改
                    }
                } else {
                    $status_data = $yeelink->$where_terrace['terrace_class']($access_array['sensorid'], $status = 1);    //触发开关开
                    if ($status_data == "" && $status_data !== false) {
                        $control_log = M('access_control_user_log')->data($add_data)->add();
                        //$this->warning_data_add(ACTION_NAME,MODULE_NAME,'1010',$status_data,'智能门禁开门异常');
                        M('house_village_user_bind')->where($where_data)->data(array('last_time' => time()))->save();    //修改时间
                        $this->redirect(U('House/access_control_show', array('village_id' => $agv_arr['village_id'], 'ac_id' => $agv_arr['ac_id'], 'msg' => '开门成功')));
                        $add_arr = array(
                            'ac_id' => $agv_arr['ac_id'],
                            'apikey' => 'b11cb20c2903230a0463fdc6ce337e2d',
                            'nodeid' => $access_array['nodeid'],
                            'sensorid' => $access_array['sensorid'],
                            'datetime' => time()
                        );
                        if ($connect->get('arr_key')) {    //判断是否是首次触发
                            $arr_key = unserialize($connect->get('arr_key'));
                            $new_arr = array();
                            foreach ($arr_key as $key => $val) {
                                $new_arr[$key] = $val;
                                if ($val['ac_id'] == $agv_arr['ac_id']) {
                                    $new_arr[$key]['datetime'] = time();
                                    $new_upd = true;    //修改标示
                                }
                            }
                            if ($new_upd) {
                                $connect->set('arr_key', serialize($new_arr));//修改
                            } else {
                                array_push($arr_key, $add_arr);                //追加
                                $connect->set('arr_key', serialize($arr_key));
                            }
                        } else {
                            $arr_key = array($add_arr);                    //首次添加
                            $connect->set('arr_key', serialize($arr_key));
                        }
                    } else {
                        $this->warning_data_add(ACTION_NAME, MODULE_NAME, '1010', $status_data, '智能门禁开门异常');
                        header("Location: http://www.hdhsmart.com/Car/index.php?m=Home&c=problem&a=index");
                        //$this->redirect(U('House/access_control_show_old',array('village_id'=>$agv_arr['village_id'],'ac_id'=>$agv_arr['ac_id'],'msg'=>'操作过于频繁,请稍后再试!')));
                    }
                }
                $connect->quit();//重新存入
                if (!$control_log) {
                    $this->warning_data_add(ACTION_NAME, MODULE_NAME, '0001', 'null', '智能门禁开门异常');
                    header("Location: http://www.hdhsmart.com/Car/index.php?m=Home&c=problem&a=index");
                    //$this->redirect(U('House/access_control_show_old', array('village_id' => $agv_arr['village_id'], 'ac_id' => $agv_arr['ac_id'], 'msg' => '记录失败')));
                }
            } elseif ($where_terrace['terrace_class'] == 'Unios') {
                //当查询到打开的平台是Unios时
                /*友联unios平台开门
				 * commandToken string 必要参数
	 			 * act string 对应闸机的编号
				 * pin 时长 -1的时候状态翻转 1的时候状态保持 大于1的时候状态保持 当前值ms后翻转
				 * */
                import('@.ORG.' . $where_terrace['terrace_class']);
                /*vd($access_array);
				vd($where_terrace);exit;*/
                $keyOb = new $where_terrace['terrace_class']($access_array['unios_pin'], $access_array['unios_act'], $access_array['assignment_token'], $access_array['duration'], $where_terrace['url']);
                $data = $keyOb->Linkhickey();
                //vd($data);exit;
                $result_json = json_decode($data, true);
                //vd($result_json);exit;
                if (empty($result_json)) {
                    //服务器问题调用返回状态500（维护等）
                    //开门异常进入后台日志
                    $this->warning_data_add(ACTION_NAME, MODULE_NAME, '2500', '服务器未响应', '智能门禁开门异常');
                    header("Location: http://www.hdhsmart.com/Car/index.php?m=Home&c=problem&a=index");
                    //$this->redirect(U('House/access_control_show_old', array('village_id' => $agv_arr['village_id'], 'ac_id' => $agv_arr['ac_id'], 'msg' => '服务器连接失败')));
                } else if (isset($result_json['error'])) {
                    //失败调用返回状态0
                    $this->warning_data_add(ACTION_NAME, MODULE_NAME, '2001', $result_json['error'], '智能门禁开门异常');
                    header("Location: http://www.hdhsmart.com/Car/index.php?m=Home&c=problem&a=index");
                    //$this->redirect(U('House/access_control_show_old', array('village_id' => $agv_arr['village_id'], 'ac_id' => $agv_arr['ac_id'], 'msg' => '开门不成功')));
                } else {
                    $control_log = M('access_control_user_log')->data($add_data)->add();
                    M('house_village_user_bind')->where($where_data)->data(array('last_time' => time()))->save();    //修改时间
                    $this->redirect(U('House/access_control_show', array('village_id' => $agv_arr['village_id'], 'ac_id' => $agv_arr['ac_id'], 'msg' => '开门成功')));

                }
                if (!$control_log) {
                    $this->warning_data_add(ACTION_NAME, MODULE_NAME, '0001', '记录未成功', '智能门禁开门异常');
                    header("Location: http://www.hdhsmart.com/Car/index.php?m=Home&c=problem&a=index");
                    //$this->redirect(U('House/access_control_show_old', array('village_id' => $agv_arr['village_id'], 'ac_id' => $agv_arr['ac_id'], 'msg' => '记录失败')));
                }
            }
        } elseif ($agv_arr['state'] == 'key') {
            //此时的开门模式为我的钥匙进门
            if ($where_terrace['terrace_class'] == 'Yeelink') {
                //当查询到的类名称为Yeelink时
                //调用yeelink接口
                /*yeelink平台开门方式
	 			* */
                import('@.ORG.' . $where_terrace['terrace_class']);
                $yeelink = new $where_terrace['terrace_class']($apikey = $where_terrace['key'], $deviceid = $access_array['nodeid'], $url = $where_terrace['url']);
                $connect = new Memcached;  //声明一个新的memcached链接
                $connect->setOption(Memcached::OPT_COMPRESSION, false); //关闭压缩功能
                $connect->setOption(Memcached::OPT_BINARY_PROTOCOL, true); //使用binary二进制协议
                $connect->addServer('f120e580f9b74ec5.m.cnhzaliqshpub001.ocs.aliyuncs.com', 11211); //添加OCS实例地址及端口号
                if ($yeelink->getStatus($access_array['sensorid'])) {    //判断开关是否已开
                    if ($connect->get('arr_key')) {                    //修改对应设备开启时间
                        $arr_key = unserialize($connect->get('arr_key'));
                        $new_arr = array();
                        foreach ($arr_key as $key => $val) {
                            $new_arr[$key] = $val;
                            if ($val['ac_id'] == $agv_arr['ac_id']) {
                                $new_arr[$key]['datetime'] = time();
                            }
                        }
                        $connect->set('arr_key', serialize($new_arr));    //修改
                    }
                    return array('err_code' => 2, 'code_msg' => '门已开，请直接进入！');
                } else {
                    $status_data = $yeelink->$where_terrace['terrace_class']($access_array['sensorid'], $status = 1);    //触发开关开
                    //var_dump($status_data);exit;
                    if ($status_data == "") {

                        $add_arr = array(
                            'ac_id' => $_POST['ac_id'],
                            'apikey' => 'b11cb20c2903230a0463fdc6ce337e2d',
                            'nodeid' => $_POST['nodeid'],
                            'sensorid' => $_POST['sensorid'],
                            'datetime' => time()
                        );
                        if ($connect->get('arr_key')) {    //判断是否是首次触发
                            $arr_key = unserialize($connect->get('arr_key'));
                            $new_arr = array();
                            foreach ($arr_key as $key => $val) {
                                $new_arr[$key] = $val;
                                if ($val['ac_id'] == $_POST['ac_id']) {
                                    $new_arr[$key]['datetime'] = time();
                                    $new_upd = true;    //修改标示
                                }
                            }
                            if ($new_upd) {
                                $connect->set('arr_key', serialize($new_arr));//修改
                            } else {
                                array_push($arr_key, $add_arr);                //追加
                                $connect->set('arr_key', serialize($arr_key));
                            }
                        } else {
                            $arr_key = array($add_arr);                    //首次添加
                            $connect->set('arr_key', serialize($arr_key));
                        }
                        return array('err_code' => 0, 'code_msg' => '记录成功');
                    } else {
                        $this->warning_data_add(ACTION_NAME, MODULE_NAME, '1010', $status_data, '智能门禁开门异常');
                        //同时更改状态,异常开启
                        M('config')->where(array('name' => 'door_state'))->data(array('value' => 1))->save();
                        return array('err_code' => 1, 'code_msg' => $status_data);
                    }
                }
                $connect->quit();//重新存入

            } elseif ($where_terrace['terrace_class'] == 'Unios') {
                //当查询到打开的平台是Unios时
                /*友联unios平台开门
				 * commandToken string 必要参数
	 			 * act string 对应闸机的编号
				 * pin 时长 -1的时候状态翻转 1的时候状态保持 大于1的时候状态保持 当前值ms后翻转
				 * */
                import('@.ORG.' . $where_terrace['terrace_class']);
                $keyOb = new $where_terrace['terrace_class']($access_array['unios_pin'], $access_array['unios_act'], $access_array['assignment_token'], $access_array['duration'], $where_terrace['url']);
                $data = $keyOb->Linkhickey();
                $result_json = json_decode($data, true);
                //vd($result_json);exit;
                if (empty($result_json)) {
                    //服务器问题调用返回状态500（维护等）
                    $this->warning_data_add(ACTION_NAME, MODULE_NAME, '2500', '服务器500', '智能门禁开门异常');
                    //同时更改状态,异常开启
                    M('config')->where(array('name' => 'door_state'))->data(array('value' => 1))->save();
                    return array('err_code' => 1, 'code_msg' => '服务器异常');
                } else if (isset($result_json['error'])) {
                    //失败调用返回状态0
                    $this->warning_data_add(ACTION_NAME, MODULE_NAME, '2001', $result_json['error'], '智能门禁开门异常');
                    //同时更改状态,异常开启
                    M('config')->where(array('name' => 'door_state'))->data(array('value' => 1))->save();
                    return array('err_code' => 2, 'code_msg' => $result_json['error']);
                } else {
                    return array('err_code' => 0, 'code_msg' => '开门成功');
                }
            }
        }

    }

    /* 开门操作
	* ac_id	设备ID
	* nodeid	节点ID
	* sensorid	传感器ID
	* @time 2016-06-29
	* @author	小邓  <969101097@qq.com>*/
    public function access_control_operat($village_id = '', $ac_id = '', $nodeid = '', $sensorid = '')
    {
        $where_data = array(
            'uid' => $this->user_session['uid'],
            'village_id' => $village_id,    //社区ID
            //'role'=>2
        );
//		import('@.ORG.longlat');
//		$longlat_class = new longlat();
//		$user_long_lat=D('User_long_lat')->getLocation($_SESSION['openid'],0);	//获取用户位置信息
//		$user_location=$longlat_class->gpsToBaidu($user_long_lat['lat'], $user_long_lat['long']);
//		$village_long_lat=M('house_village')->where(array('village_id' =>$village_id))->find();
//		$village_location=$longlat_class->gpsToBaidu($village_long_lat['lat'], $village_long_lat['long']);
//		$get_distance=GetDistance($user_location['lat'],$user_location['long'],$village_location['lat'],$village_location['long']);
        /*if($get_distance>1000){	//判断是否在社区范围之内,此行之前已经注释
			//echo json_encode(array('err_code'=>2,'code_msg'=>'您当前位置不在写字楼附近，无法开门！'));
			$this->redirect(U('House/access_control_show',array('village_id'=>$village_id,'ac_id'=>$ac_id,'msg'=>'您当前位置不在写字楼附近，无法开门！')));
			exit;
		}*/
        $pigcms_id = M('house_village_user_bind')->where($where_data)->getField('pigcms_id');
        $add_data = array(
            'pigcms_id' => $pigcms_id,
            'ac_id' => $ac_id,    //开关ID
            'village_id' => $village_id,    //社区ID
            'opdate' => time()//开门时间
        );

        import('@.ORG.Yeelink');
        $yeelink = new Yeelink($apikey = 'b11cb20c2903230a0463fdc6ce337e2d', $deviceid = $nodeid);
        $connect = new Memcached;  //声明一个新的memcached链接
        $connect->setOption(Memcached::OPT_COMPRESSION, false); //关闭压缩功能
        $connect->setOption(Memcached::OPT_BINARY_PROTOCOL, true); //使用binary二进制协议
        $connect->addServer('f120e580f9b74ec5.m.cnhzaliqshpub001.ocs.aliyuncs.com', 11211); //添加OCS实例地址及端口号
        if ($yeelink->getStatus($sensorid)) {    //判断开关是否已开
            //echo json_encode(array('err_code'=>2,'code_msg'=>'门已开，请直接进入！'));
            $this->redirect(U('House/access_control_show', array('village_id' => $village_id, 'ac_id' => $ac_id, 'msg' => '门已开，请直接进入！')));
            if ($connect->get('arr_key')) {                    //修改对应设备开启时间
                $arr_key = unserialize($connect->get('arr_key'));
                $new_arr = array();
                foreach ($arr_key as $key => $val) {
                    $new_arr[$key] = $val;
                    if ($val['ac_id'] == $ac_id) {
                        $new_arr[$key]['datetime'] = time();
                    }
                }
                $connect->set('arr_key', serialize($new_arr));    //修改
            }
        } else {
            $status_data = $yeelink->yeelink($sensorid, $status = 1);    //触发开关开
            if ($status_data == "") {
                $control_log = M('access_control_user_log')->data($add_data)->add();
                M('house_village_user_bind')->where($where_data)->data(array('last_time' => time()))->save();    //修改时间
                //echo json_encode(array('err_code'=>0,'code_msg'=>'开门成功'));
                $this->redirect(U('House/access_control_show', array('village_id' => $village_id, 'ac_id' => $ac_id, 'msg' => '开门成功')));
                $add_arr = array(
                    'ac_id' => $ac_id,
                    'apikey' => 'b11cb20c2903230a0463fdc6ce337e2d',
                    'nodeid' => $nodeid,
                    'sensorid' => $sensorid,
                    'datetime' => time()
                );
                if ($connect->get('arr_key')) {    //判断是否是首次触发
                    $arr_key = unserialize($connect->get('arr_key'));
                    $new_arr = array();
                    foreach ($arr_key as $key => $val) {
                        $new_arr[$key] = $val;
                        if ($val['ac_id'] == $ac_id) {
                            $new_arr[$key]['datetime'] = time();
                            $new_upd = true;    //修改标示
                        }
                    }
                    if ($new_upd) {
                        $connect->set('arr_key', serialize($new_arr));//修改
                    } else {
                        array_push($arr_key, $add_arr);                //追加
                        $connect->set('arr_key', serialize($arr_key));
                    }
                } else {
                    $arr_key = array($add_arr);                    //首次添加
                    $connect->set('arr_key', serialize($arr_key));
                }
            } else {
                //echo json_encode(array('err_code'=>1,'code_msg'=>'操作过于频繁,请稍后再试!'));
                $this->redirect(U('House/access_control_show_old', array('village_id' => $village_id, 'ac_id' => $ac_id, 'msg' => '操作过于频繁,请稍后再试!')));
            }
        }

        $connect->quit();//重新存入
        /*$control_log=M('access_control_user_log')->data($add_data)->add();*/
        if (!$control_log) {
            //echo json_encode(array('err_code'=>1,'code_msg'=>'记录失败'));
            $this->redirect(U('House/access_control_show_old', array('village_id' => $village_id, 'ac_id' => $ac_id, 'msg' => '记录失败')));
        }
    }

    /* 开门操作(须访客提交资料后)
	* ac_id	设备ID
	* nodeid	节点ID
	* sensorid	传感器ID
	* @time 2016-08-10
	* @author	小邓  <969101097@qq.com>*/
    public function access_control_operat_ajax($village_id = '', $ac_id = '', $nodeid = '', $sensorid = '')
    {
        $where_data = array(
            'uid' => $this->user_session['uid'],
            'village_id' => $village_id,    //社区ID
        );
        import('@.ORG.longlat');
        $longlat_class = new longlat();
        $user_long_lat = D('User_long_lat')->getLocation($_SESSION['openid'], 0);    //获取用户位置信息
        $user_location = $longlat_class->gpsToBaidu($user_long_lat['lat'], $user_long_lat['long']);
        $village_long_lat = M('house_village')->where(array('village_id' => $village_id))->find();
        $village_location = $longlat_class->gpsToBaidu($village_long_lat['lat'], $village_long_lat['long']);
        $get_distance = GetDistance($user_location['lat'], $user_location['long'], $village_location['lat'], $village_location['long']);
        /*if($get_distance>1000){	//判断是否在社区范围之内
			echo json_encode(array('err_code'=>2,'code_msg'=>'您当前位置不在写字楼附近，无法开门！'));
			exit;
		}*/
        $pigcms_id = M('house_village_user_bind')->where($where_data)->getField('pigcms_id');
        $add_data = array(
            'pigcms_id' => $pigcms_id,
            'ac_id' => $ac_id,    //开关ID
            'village_id' => $village_id,    //社区ID
            'opdate' => time()//开门时间
        );
        $control_log = M('access_control_user_log')->data($add_data)->add();
        if ($control_log) {
            import('@.ORG.Yeelink');
            $yeelink = new Yeelink($apikey = 'b11cb20c2903230a0463fdc6ce337e2d', $deviceid = $nodeid);
            $connect = new Memcached;  //声明一个新的memcached链接
            $connect->setOption(Memcached::OPT_COMPRESSION, false); //关闭压缩功能
            $connect->setOption(Memcached::OPT_BINARY_PROTOCOL, true); //使用binary二进制协议
            $connect->addServer('f120e580f9b74ec5.m.cnhzaliqshpub001.ocs.aliyuncs.com', 11211); //添加OCS实例地址及端口号
            if ($yeelink->getStatus($sensorid)) {    //判断开关是否已开
                echo json_encode(array('err_code' => 2, 'code_msg' => '门已开，请直接进入！'));
                if ($connect->get('arr_key')) {                    //修改对应设备开启时间
                    $arr_key = unserialize($connect->get('arr_key'));
                    $new_arr = array();
                    foreach ($arr_key as $key => $val) {
                        $new_arr[$key] = $val;
                        if ($val['ac_id'] == $ac_id) {
                            $new_arr[$key]['datetime'] = time();
                        }
                    }
                    $connect->set('arr_key', serialize($new_arr));    //修改
                }
            } else {
                //测试环境关闭开门
                //$status_data=$yeelink->yeelink($sensorid,$status=1);	//触发开关开
                $status_data = "";
                if ($status_data == "") {
                    echo json_encode(array('err_code' => 0, 'code_msg' => '开门成功'));
                    $add_arr = array(
                        'ac_id' => $ac_id,
                        'apikey' => 'b11cb20c2903230a0463fdc6ce337e2d',
                        'nodeid' => $nodeid,
                        'sensorid' => $sensorid,
                        'datetime' => time()
                    );
                    if ($connect->get('arr_key')) {    //判断是否是首次触发
                        $arr_key = unserialize($connect->get('arr_key'));
                        $new_arr = array();
                        foreach ($arr_key as $key => $val) {
                            $new_arr[$key] = $val;
                            if ($val['ac_id'] == $ac_id) {
                                $new_arr[$key]['datetime'] = time();
                                $new_upd = true;    //修改标示
                            }
                        }
                        if ($new_upd) {
                            $connect->set('arr_key', serialize($new_arr));//修改
                        } else {
                            array_push($arr_key, $add_arr);                //追加
                            $connect->set('arr_key', serialize($arr_key));
                        }
                    } else {
                        $arr_key = array($add_arr);                    //首次添加
                        $connect->set('arr_key', serialize($arr_key));
                    }
                } else {
                    echo json_encode(array('err_code' => 1, 'code_msg' => '操作过于频繁,请稍后再试!'));
                }
            }
            $connect->quit();
            //重新存入
        } else {
            echo json_encode(array('err_code' => 1, 'code_msg' => '记录失败'));
        }
    }

    /* 设备二维码扫码开门提示
	* @time 2016-06-28
	* @author	小邓  <969101097@qq.com>
	 * 修改于2016.11.17(平时开门)
	 * 修改于2016.12.9(圣诞活动)
	 * */
    public function access_control_show()
    {
        if ($_GET['village_id'] == 3) {
//			$this->display("House/access_control_show_new");
            redirect(U('access_control_show_new'));
        } else {
            $uid = $this->user_session['uid'];
            $recordOb = M('Extension_activity_record');
            $record_result = $recordOb->where(array('uid' => $uid, 'activity_id' => 5))->find();
            if ($record_result) {
                //设置查询的变量
                $condition_where_pastgift = "record.pigcms_id=coupon.record_id and record.uid=$uid and record.activity_id=5";
                $condition_table_pastgift = array(
                    'pigcms_extension_activity_record' => 'record',
                    'pigcms_extension_coupon_record' => 'coupon'
                );
                $order = "record.time desc";
                $condition_field_pastgift = "coupon.record_id,record.giftname,record.time,coupon.plate,coupon.number";
                $pastgift_result = D('')->table($condition_table_pastgift)->field($condition_field_pastgift)->where($condition_where_pastgift)->order($order)->limit(3)->select();

                //var_dump($re_id);exit;
                $listTd = $this->get_coupon_list($pastgift_result);
                $this->assign('rc_result', $pastgift_result[0]['record_id']);
                $this->assign('listTd', $listTd);//$re_id
//				$this->display("House/access_control_show_new");
                redirect(U('access_control_show_new'));
            } else {
                //对进门的用户进行判断
                //用户没有抽过奖
                //在数据库里面读出相应的活动数据配置
                $activtyOb = M("Extension_activity");
                $gift_str_array = $activtyOb->where(array("activity_id" => 5))->find();
                $gift_str = $gift_str_array['gift'];
                $gift_sum = $gift_str_array['probability'];
                $gift_type = $gift_str_array['gifttype'];
                //调用随机算法，获取中奖项目
                $gift_name = $this->randomGift($gift_str, $gift_sum);
                $this->assign("gift", $gift_name);
                $recordOb = M('Extension_activity_record');
                $record_array = array(
                    'activity_id' => 5,
                    'time' => time(),
                    'uid' => $this->user_session['uid'],
                    'part_count' => '1',
                    'giftname' => $gift_name
                );
                //将抽到的奖励名称添加到数据库中
                $rc_result = $recordOb->data($record_array)->add();
                $this->assign("rc_result", $rc_result);
                //根据抽到的奖励调用相应的接口
                $postion = '';
                $gift_array = explode(",", $gift_str);
                foreach ($gift_array as $key => $value) {
                    if ($gift_name == $value) {
                        $postion = $key;
                    }
                }
                $gift_type_array = explode(",", $gift_type);
                $gift_type_number = $gift_type_array[$postion];
                if ($gift_type_number == 1) {

                    //提示信息
                    $message = '赶快到公众号对话框中领取吧！';
                    $note = '确定';
                    $this->assign("message", $message);
                    $this->assign("note", $note);
                } else if ($gift_type_number == 2) {

                    //提示信息
                    $message = '赶快去食堂使用吧！';
                    $note = '确定';
                    $this->assign("message", $message);
                    $this->assign("note", $note);
                } else if ($gift_type_number == 3) {

                    //提示信息
                    $message = '快去使用停车优惠吧';
                    $note = '确定';
                    $this->assign("message", $message);
                    $this->assign("note", $note);
                    //根据类型不同传递参数
                    $this->assign("state", 1);
                } else {
                    //其他类别
                    //提示信息
                    $message = '您真是太幸运了';
                    $note = '确定';
                    $this->assign("message", $message);
                    $this->assign("note", $note);
                }
//				$this->display("House/access_control_show");
                redirect(U('access_control_show_new'));
            }

        }
    }


    /*
     * 扫码开门后跳转页面（动态读取广告管理中的图片，目前id为固定的，指向成功开门）
     * 陈琦
     * 2017.4.24
     */
    public function access_control_show_new()
    {
        $adver_info = M('Adver')->where(array('id' => 26))->find();//智能门禁的广告
        $this->assign('adver_info', $adver_info);
        $this->display();
    }

    /*根据前台获得的奖品类型在后台选择调用接口
	 * @time 2016.12.20
	 *@author 祝君伟
	 * */
    function get_gift_port($gift_name, $rc_result)
    {
        if ($gift_name == '现金红包') {
            //现金红包类接口  1
            $res = $this->wechatCash();
            //将抽到的金额入库
            $couponOb = M('Extension_coupon_record');
            $coupon_array = array(
                'activity_id' => 5,
                'record_id' => $rc_result,
                'number' => $res['total_amount']
            );
            //将抽到的奖励名称添加到数据库中
            $couponOb->data($coupon_array)->add();

        } else if ($gift_name == '大头仔现金券') {
            //现金优惠券类  2
            $res = $this->wechatCoupon();
            $coupon_id = isset($res['coupon_id']) ? $res['coupon_id'] : '';
            //将抽到的金额入库
            $couponOb = M('Extension_coupon_record');
            $coupon_array = array(
                'activity_id' => 5,
                'record_id' => $rc_result,
                'number' => $coupon_id
            );
            //将抽到的奖励添加到数据库中
            $couponOb->data($coupon_array)->add();

        } else if ($gift_name == '停车优惠券') {
            //停车优惠券类  3
            //一开始领取时没有使用优惠券
            $couponOb = M('Extension_coupon_record');
            $coupon_array = array(
                'activity_id' => 5,
                'record_id' => $rc_result,
                'plate' => ''
            );
            //将抽到的奖励添加到数据库中
            $couponOb->data($coupon_array)->add();

        } else {
            //其他类别
            //提示信息
        }
    }

    /*调用微信现金红包
	 * @time 2016.12.9
	 * @author 祝君伟
	 * @接口提供 陈琦
	 * */
    public function wechatCash()
    {
        $payConfig = M('cashier_payconfig')->where(array('mid' => 14))->find();//读取收银台配置文件
        $payConfig['configData'] = unserialize(htmlspecialchars_decode($payConfig['configData'], ENT_QUOTES));//反序列化
        $wx_user = $payConfig['configData']['weixin'];
        //证书路径
        $cert = urldecode($wx_user['apiclient_cert']);
        $key = urldecode($wx_user['apiclient_key']);
        $rootca = urldecode($wx_user['rootca']);
        $apiclient_cert = getcwd() . '/Cashier' . $cert;
        $apiclient_key = getcwd() . '/Cashier' . $key;
        $rootca = getcwd() . '/Cashier' . $rootca;
        $money = rand(100, 200);
        $mid = '1273021101';
        $url = "https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack";
        $arr['mch_billno'] = $mid . date('YmdHis') . rand(1000, 9999);
        $arr['nick_name'] = '汇得行';
        $arr['send_name'] = '汇得行智慧助手';
        $arr['re_openid'] = $_SESSION['user']['openid'];
        $arr['total_amount'] = $money;
        $arr['total_num'] = '1';//普通红包个数只能为1
        $arr['wishing'] = '汇得行平安夜送红包！';
        $arr['act_name'] = '平安夜活动';
        $arr['remark'] = '圣诞快乐！';
        $arr['wxappid'] = 'wx4c9f2ead52f08cdf';
        $arr['mch_id'] = '1273021101';
        $arr['client_ip'] = $_SERVER['REMOTE_ADDR'];
        import('@.ORG.redpack');//引进现金红包类
        $redpack = new Redpack();
        $arr['nonce_str'] = $redpack->createNoncestr();//获取随机数
        $arr['sign'] = $redpack->getSign($arr);//获取签名
        $xml = $redpack->arrayToXml($arr);//将数组转化成xml格式请求
        $result = $redpack->postXmlSSLCurl($xml, $url, $second = 30, $apiclient_cert, $apiclient_key, $rootca);
        $RES = $redpack->xmlToArray($result);
        return $RES;

    }

    /*调用微信优惠券
	 * @time 2016.12.9
	 * @author 祝君伟
	 * @接口提供 陈琦
	 * */
    public function wechatCoupon()
    {
        $payConfig = M('cashier_payconfig')->where(array('mid' => 14))->find();//读取收银台配置文件
        $payConfig['configData'] = unserialize(htmlspecialchars_decode($payConfig['configData'], ENT_QUOTES));//反序列化
        $wx_user = $payConfig['configData']['weixin'];
        //证书路径
        $cert = urldecode($wx_user['apiclient_cert']);
        $key = urldecode($wx_user['apiclient_key']);
        $rootca = urldecode($wx_user['rootca']);
        $apiclient_cert = getcwd() . '/Cashier' . $cert;
        $apiclient_key = getcwd() . '/Cashier' . $key;
        $rootca = getcwd() . '/Cashier' . $rootca;
        $mid = '1273021101';
        $url = "https://api.mch.weixin.qq.com/mmpaymkttransfers/send_coupon";
        $arr['coupon_stock_id'] = '963408';//代金券批次id
        $arr['openid'] = $_SESSION['user']['openid'];
        $arr['openid_count'] = 1;//openid记录数
        $arr['partner_trade_no'] = $mid . date('YmdHis') . rand(1000, 9999);//商户单据号
        $arr['appid'] = 'wx4c9f2ead52f08cdf';
        $arr['mch_id'] = '1273021101';
        import('@.ORG.redpack');//引进现金红包类
        $redpack = new Redpack();
        $arr['nonce_str'] = $redpack->createNoncestr();//获取随机数
        $arr['sign'] = $redpack->getSign($arr);//获取签名
        $xml = $redpack->arrayToXml($arr);//将数组转化成xml格式请求
        $result = $redpack->postXmlSSLCurl($xml, $url, $second = 30, $apiclient_cert, $apiclient_key, $rootca);
        $RES = $redpack->xmlToArray($result);
        /*dump($RES);*/
        return $RES;
    }

    /*
	 *查询优惠券状态
	 * 陈琦
	 * 2016.12.20
	 */
    public function ask_couponStatus($coupon_id)
    {
        $url = "https://api.mch.weixin.qq.com/mmpaymkttransfers/querycouponsinfo";
        $arr['stock_id'] = '963408';//代金券批次id
        $arr['openid'] = $_SESSION['user']['openid'];
        $arr['appid'] = 'wx4c9f2ead52f08cdf';
        $arr['mch_id'] = '1273021101';
        $arr['coupon_id'] = $coupon_id;
        import('@.ORG.redpack');//引进现金红包类
        $redpack = new Redpack();
        $arr['nonce_str'] = $redpack->createNoncestr();//获取随机数
        $arr['sign'] = $redpack->getSign($arr);//获取签名
        $xml = $redpack->arrayToXml($arr);//将数组转化成xml格式请求
        $result = $redpack->postXmlCurl($xml, $url, $second = 30);
        $RES = $redpack->xmlToArray($result);
        return $RES;
    }

    /*调用停车优惠券接口
	 * @time 2016.12.9
	 * @author 祝君伟
	 * array $criterion_pause_array; post接口的数据
	 * string $rc_result 插入的record_id号
	 * @接口提供 小王
	 * */
    public function pauseCoupon($criterion_pause_array, $rc_result)
    {
        //调用接口地址 car.vhi99.com/?m=Admin&c=Api&a=check_legal&act_id=1&shop_id=76&car_no
        $url = 'car.vhi99.com/?m=Admin&c=Api&a=check_legal&act_id=1&shop_id=76&car_no';
        //curl
        $ch = curl_init();
        // 设置超时
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        // 这里设置代理，如果有的话
        // curl_setopt($ch,CURLOPT_PROXY, '8.8.8.8');
        // curl_setopt($ch,CURLOPT_PROXYPORT, 8080);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        // 设置header
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        // 要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        // post提交方式
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $criterion_pause_array);
        // 运行curl
        $data = curl_exec($ch);
        //把返回的结果存入数据库
        $couponOb = M('Extension_coupon_record');
        $coupon_array = array(
            'data_state' => $data
        );
        //将抽到的奖励添加到数据库中
        $couponOb->where(array('record_id' => $rc_result))->data($coupon_array)->save();
        return $data;
    }

    /* 成功开门之后获取优惠券
	* @time 2016-11-17
	* @author	祝君伟*/
    public function coupon()
    {
        //用户没有领取过
        //获取优惠券
        $coupon = I('get.coupon');
        //点击领取后优惠券码入库
        $record_array = array(
            'activity_id' => '4',
            'time' => time(),
            'uid' => $this->user_session['uid'],
            'part_count' => '1'
        );
        $m = M('Extension_activity_record');
        //向数据表里面插入数据
        //活动参与记录表
        $record_id = $m->data($record_array)->add();
        //活动优惠券记录表
        $coupon_array = array(
            'record_id' => $record_id,
            'activity_id' => '4',
            'number' => $coupon
        );
        $couponOb = M('Extension_coupon_record');
        $re_coupon = $couponOb->data($coupon_array)->add();
    }

    /*活动抽奖随机算法
	 * @time 2016.12.9
	 * @author 祝君伟
	 * string $gift_array 礼物的数组
	 * string $gift_sum 礼物的概率数组（与礼物要一一对应）
	 * @return string 抽取到的礼物
	 * */
    public function randomGift($gift_str, $gift_sum)
    {
        //将gift里面的字符进行拆分为数组
        $gift_array = explode(",", $gift_str);
        $gift_sum_array = explode(",", $gift_sum);
        $proSum = array_sum($gift_sum_array);
        //抽奖概率算法
        foreach ($gift_sum_array as $key => $proCur) {
            $randNum = mt_rand(1, $proSum);
            if ($randNum <= $proCur) {
                $getgift = $gift_array[$key];
                break;
            } else {
                $proSum -= $proCur;
            }
        }
        return $getgift;
    }

    /*记录车牌数据后台处理
	 * @time 2016-12-13
	 * @author 祝君伟
	 * */
    public function pause()
    {
        //获取前台传来的车牌
        $pause = I('get.pause');
        $rc_result = I('get.rc_result');
        //给接口传递正确的车牌
        $pause_array = explode("-", $pause);
        $new_pause = mb_substr($pause_array[0], 0, 1, 'utf-8');
        $new_plate = mb_substr($pause_array[0], 1, 1, 'utf-8');
        $criterion_pause = $new_pause . '-' . $new_plate . $pause_array[1];
        $criterion_pause = strtoupper($criterion_pause);
        //将车牌录入到数据库中
        $couponOb = M('Extension_coupon_record');
        $coupon_array = array(
            'plate' => $criterion_pause
        );
        //将抽到的奖励添加到数据库中
        $couponOb->where(array('record_id' => $rc_result))->data($coupon_array)->save();
        $criterion_pause_array = array('car_no' => $criterion_pause);
        //给接口传递值
        $res = $this->pauseCoupon($criterion_pause_array, $rc_result);
        echo $res;

    }

    /*查询现在这个用户的历史活动信息
	 * @time 2016.12.15
	 * @author 祝君伟
	 * */
    public function pastgift()
    {
        //根据uid在表中查询
        $uid = $this->user_session['uid'];
        //设置查询的变量
        $condition_where_pastgift = "record.pigcms_id=coupon.record_id and record.uid=$uid";
        $condition_table_pastgift = array(
            'pigcms_extension_activity_record' => 'record',
            'pigcms_extension_coupon_record' => 'coupon'
        );
        $order = "record.time desc";
        $condition_field_pastgift = "record.giftname,record.time,coupon.plate,coupon.number";
        $pastgift_result = D('')->table($condition_table_pastgift)->field($condition_field_pastgift)->where($condition_where_pastgift)->order($order)->limit(3)->select();
        $listTd = $this->get_coupon_list($pastgift_result);
        echo $listTd;
    }

    /*获得优惠券的列表页面
	 *@author 祝君伟
	 *@time 2016.12.22
	 * */
    public function get_coupon_list($pastgift_result)
    {
        //过期时间计算
        $pasttime = 1483200000 - time();
        $pastday = floor($pasttime / 86400);
        $listTd = '';
        foreach ($pastgift_result as $value) {
            if ($value['giftname'] == '停车优惠券' && $value['plate'] == '') {
                //没有使用停车优惠券
                $listTd .= '<div style="margin:10px auto; width:93%;" id="plate">
				<div style="width:100%; background-color:#febe39;">
					<div class="demo">
						<span style="width:100%; margin:0px auto; padding-top:20px;">
							<div style="width:70%; margin:0px auto;">
							<div style="width:100%; height:50px; line-height:50px; border-bottom:1px #01b1a1 solid; color:#FFFFFF; font-size:18px; text-align:center;">
								<div style="margin:0px auto; width:100%;"><div style="font-size:20px; text-align: center">1小时</div></div>
							</div>
							<div style="width:100%; line-height:30px; color:#FFFFFF; text-align:center; height:30px;">减免</div>
							</div>
						</span>
					</div>
					<div style="width:70%; height:126px; float:left; background-color:#FFFFFF; border-radius:0 6px 6px 0;">
						<div style="width:80%; margin:0px auto;">
							<div style="width:100%; height:40px; line-height:40px; color:#000000; font-size:16px; font-family:\'微软雅黑\';">停车减免一小时优惠券</div>
							<div style="width:100%; height:15px; line-height:15px; color:#999999; font-size:14px; font-family:\'微软雅黑\';" id="mybutton2">点我使用</div>
							<div style="width:100%; padding-top:34px; height:35px; line-height:35px; color:#999999; font-size:14px; font-family:\'微软雅黑\'; border-bottom:0.8px #f3f3f3 solid;">
								
								<div style="width:60%; float:right; line-height:35px; color:#909090; font-family:\'微软雅黑\'; font-size:12px; text-align:right;">有效期至12-31</div>
								<div style="clear:both"></div>
							</div>
						</div>
					</div>
					<div style="clear:both"></div>
				</div>
			</div>';
            } else if ($value['giftname'] == '大头仔现金券') {
                $coupon_state = $this->ask_couponStatus($value['number']);
                if ($coupon_state['coupon_state'] == "SENDED") {
                    //没有使用大头仔现金券
                    $listTd .= '<div style="margin:10px auto; width:93%;">
				<div style="width:100%; background-color:#febe39;">
					<div class="demo">
						<span style="width:100%; margin:0px auto; padding-top:20px;">
							<div style="width:70%; margin:0px auto;">
							<div style="width:100%; height:50px; line-height:50px; border-bottom:1px #01b1a1 solid; color:#FFFFFF; font-size:18px; text-align:center;">
								<div style="margin:0px auto; width:100%;"><div style="font-size:65px; float:left;">5</div><div style="font-size:16px; float:left; padding-top:5px; font-family:\'微软雅黑\';">元</div></div>
							</div>
							<div style="width:100%; line-height:30px; color:#FFFFFF; text-align:center; height:30px;">代金券</div>
							</div>
						</span>
					</div>
					<div style="width:70%; height:126px; float:left; background-color:#FFFFFF; border-radius:0 6px 6px 0;">
						<div style="width:80%; margin:0px auto;">
							<div style="width:100%; height:40px; line-height:40px; color:#000000; font-size:16px; font-family:\'微软雅黑\';">六楼食堂5元代金券</div>
							<div style="width:100%; height:15px; line-height:15px; color:#999999; font-size:14px; font-family:\'微软雅黑\';">满5.1元即可用，去食堂消费自动使用</div>
							<div style="width:100%; padding-top:34px; height:35px; line-height:35px; color:#999999; font-size:14px; font-family:\'微软雅黑\'; border-bottom:0.8px #f3f3f3 solid;">
								
								<div style="width:60%; float:right; line-height:35px; color:#909090; font-family:\'微软雅黑\'; font-size:12px; text-align:right;">有效期至12-31</div>
								<div style="clear:both"></div>
							</div>
						</div>
					</div>
					<div style="clear:both"></div>
				</div>
			</div>';
                } elseif ($coupon_state['coupon_state'] == "USED") {
                    //使用大头仔现金券
                    $url = C('config.site_url');
                    $listTd .= '<div style="background:url(' . $url . '/tpl/Wap/pure/static/images/137/xxx.png) no-repeat; background-size:100% 100%; width:57px; height:48px; margin-top:10px; right:12%; z-index:999; position:absolute;"></div>
			<div style="margin:10px auto; width:93%;">
				<div style="width:100%; background-color:#febe39;">
					<div class="demo">
						<span style="width:100%; margin:0px auto; padding-top:20px;">
							<div style="width:70%; margin:0px auto;">
							<div style="width:100%; height:50px; line-height:50px; border-bottom:1px #01b1a1 solid; color:#FFFFFF; font-size:18px; text-align:center;">
								<div style="margin:0px auto; width:100%;"><div style="font-size:65px; float:left;">5</div><div style="font-size:16px; float:left; padding-top:5px; font-family:\'微软雅黑\';">元</div></div>
							</div>
							<div style="width:100%; line-height:30px; color:#FFFFFF; text-align:center; height:30px;">代金券</div>
							</div>
						</span>
					</div>
					<div style="width:70%; height:126px; float:left; background-color:#FFFFFF; border-radius:0 6px 6px 0;">
						<div style="width:80%; margin:0px auto;">
							<div style="width:100%; height:40px; line-height:40px; color:#000000; font-size:16px; font-family:\'微软雅黑\';">六楼食堂5元代金券</div>
							<div style="width:100%; height:15px; line-height:15px; color:#999999; font-size:14px; font-family:\'微软雅黑\';">满5.1元即可用，去食堂消费自动使用</div>
							<div style="width:100%; padding-top:34px; height:35px; line-height:35px; color:#999999; font-size:14px; font-family:\'微软雅黑\'; border-bottom:0.8px #f3f3f3 solid;">
								
								<div style="width:60%; float:right; line-height:35px; color:#909090; font-family:\'微软雅黑\'; font-size:12px; text-align:right;">有效期至12-31</div>
								<div style="clear:both"></div>
							</div>
						</div>
					</div>
					<div style="clear:both"></div>
				</div>
			</div>';
                } else {
                    //使用大头仔现金券
                    $listTd .= '<div style="margin:10px auto; width:93%;">
				<div style="width:100%; background-color:#febe39;">
					<div class="demo">
						<span style="width:100%; margin:0px auto; padding-top:20px;">
							<div style="width:100%; margin:0px auto;">
							<div style="width:100%; height:50px; line-height:50px; border-bottom:1px #01b1a1 solid; color:#FFFFFF; font-size:18px; text-align:center;">
								<div style="margin:0px auto; width:100%;"><div style="font-size:38px;">5</div><div style="font-size:16px; float:left; padding-top:5px; font-family:\'微软雅黑\';">元</div></div>
							</div>
							<div style="width:100%; line-height:30px; color:#FFFFFF; text-align:center; height:30px;">代金券</div>
							</div>
						</span>
					</div>
					<div style="width:70%; height:126px; float:left; background-color:#FFFFFF; border-radius:0 6px 6px 0;">
						<div style="width:80%; margin:0px auto;">
							<div style="width:100%; height:40px; line-height:40px; color:#000000; font-size:16px; font-family:\'微软雅黑\';">六楼食堂5元代金券</div>
							<div style="width:100%; height:15px; line-height:15px; color:#999999; font-size:14px; font-family:\'微软雅黑\';">满5.1元即可用，去食堂消费自动使用</div>
							<div style="width:100%; padding-top:34px; height:35px; line-height:35px; color:#999999; font-size:14px; font-family:\'微软雅黑\'; border-bottom:0.8px #f3f3f3 solid;">
								
								<div style="width:60%; float:right; line-height:35px; color:#909090; font-family:\'微软雅黑\'; font-size:12px; text-align:right;">有效期至12-31</div>
								<div style="clear:both"></div>
							</div>
						</div>
					</div>
					<div style="clear:both"></div>
				</div>
			</div>';
                }

            } else if ($value['giftname'] == '停车优惠券' && $value['plate'] != '') {
                //使用停车优惠券
                $url = C('config.site_url');
                $listTd .= '<div style="background:url(' . $url . '/tpl/Wap/pure/static/images/137/xxx.png) no-repeat; background-size:100% 100%; width:57px; height:48px; margin-top:10px; right:12%; z-index:999; position:absolute;"></div>
			<div style="margin:10px auto; width:93%;">
				<div style="width:100%; background-color:#febe39;">
					<div class="demo2">
						<span style="width:100%; margin:0px auto; padding-top:20px;">
							<div style="width:70%; margin:0px auto;">
							<div style="width:100%; height:50px; line-height:50px; border-bottom:1px #b8b9bb solid; color:#FFFFFF; font-size:18px; text-align:center;">
								<div style="margin:0px auto; width:100%;"><div style="font-size:16px; text-align: center"">1小时</div></div>
							</div>
							<div style="width:100%; line-height:30px; color:#FFFFFF; text-align:center; height:30px;">减免</div>
							</div>
						</span>
					</div>
					<div style="width:70%; height:126px; float:left; background-color:#FFFFFF; border-radius:0 6px 6px 0;">
						<div style="width:80%; margin:0px auto;">
							<div style="width:100%; height:40px; line-height:40px; color:#9a9a9a; font-size:16px; font-family:\'微软雅黑\';">停车减免一小时优惠券</div>
							<div style="width:100%; height:15px; line-height:15px; color:#9a9a9a; font-size:14px; font-family:\'微软雅黑\';">已使用，使用车牌为' . $value['plate'] . '</div>
							<div style="width:100%; padding-top:34px; height:35px; line-height:35px; color:#999999; font-size:14px; font-family:\'微软雅黑\'; border-bottom:0.8px #f3f3f3 solid;">
								<div style="width:60%; float:right; line-height:35px; color:#9a9a9a; font-family:\'微软雅黑\'; font-size:12px; text-align:right;">有效期至12-31</div>
								<div style="clear:both"></div>
							</div>
						</div>
					</div>
					<div style="clear:both"></div>
				</div>
			</div>';

            } else {
                $money = $value['number'] / 100;
                //获取了现金红包
                $listTd .=
                    '<div style="margin:10px auto; width:93%;">
				<div style="width:100%; background-color:#febe39;">
					<div class="demo">
						<span style="width:100%; margin:0px auto; padding-top:20px;">
							<div style="width:70%; margin:0px auto;">
							<div style="width:100%; height:50px; line-height:50px; border-bottom:1px #01b1a1 solid; color:#FFFFFF; font-size:18px; text-align:center;">
								<div style="margin:0px auto; width:100%;"><div style="font-size:26px;text-align:center;">' . $money . '</div></div>
							</div>
							<div style="width:100%; line-height:30px; color:#FFFFFF; text-align:center; height:30px;">现金红包</div>
							</div>
						</span>
					</div>
					<div style="width:70%; height:126px; float:left; background-color:#FFFFFF; border-radius:0 6px 6px 0;">
						<div style="width:80%; margin:0px auto;">
							<div style="width:100%; height:40px; line-height:40px; color:#000000; font-size:16px; font-family:\'微软雅黑\';">微信现金红包</div>
							<div style="width:100%; height:15px; line-height:15px; color:#999999; font-size:14px; font-family:\'微软雅黑\';">请去公众号对话框中领取红包</div>
							<div style="width:100%; padding-top:34px; height:35px; line-height:35px; color:#999999; font-size:14px; font-family:\'微软雅黑\'; border-bottom:0.8px #f3f3f3 solid;">
								
								<div style="width:60%; float:right; line-height:35px; color:#909090; font-family:\'微软雅黑\'; font-size:12px; text-align:right;">有效期至12-31</div>
								<div style="clear:both"></div>
							</div>
						</div>
					</div>
					<div style="clear:both"></div>
				</div>
			</div>';
            }
        }
        return $listTd;
    }


    /*获得平时优惠券的列表页面
	 *@author 祝君伟
	 *@time 2016.12.22
	 * */
    public function get_coupon_list_p($pastgift_result)
    {
        //过期时间计算
        $pasttime = 1483200000 - time();
        $pastday = floor($pasttime / 86400);
        $listTd = '';
        foreach ($pastgift_result as $value) {
            if ($value['giftname'] == '停车优惠券' && $value['plate'] == '') {
                //没有使用停车优惠券
                $listTd .= '<div style="margin:10px auto; width:93%;" id="plate">
				<div style="width:100%; background-color:#febe39;">
					<div class="demo">
						<span style="width:100%; margin:0px auto; padding-top:20px;">
							<div style="width:70%; margin:0px auto;">
							<div style="width:100%; height:50px; line-height:50px; border-bottom:1px #01b1a1 solid; color:#FFFFFF; font-size:18px; text-align:center;">
								<div style="margin:0px auto; width:100%;"><div style="font-size:20px; text-align: center">1小时</div></div>
							</div>
							<div style="width:100%; line-height:30px; color:#FFFFFF; text-align:center; height:30px;">减免</div>
							</div>
						</span>
					</div>
					<div style="width:70%; height:126px; float:left; background-color:#FFFFFF; border-radius:0 6px 6px 0;">
						<div style="width:80%; margin:0px auto;">
							<div style="width:100%; height:40px; line-height:40px; color:#000000; font-size:16px; font-family:\'微软雅黑\';">停车减免一小时优惠券</div>
							<div style="width:100%; height:15px; line-height:15px; color:#999999; font-size:14px; font-family:\'微软雅黑\';" id="mybutton2">点我使用</div>
							<div style="width:100%; padding-top:34px; height:35px; line-height:35px; color:#999999; font-size:14px; font-family:\'微软雅黑\'; border-bottom:0.8px #f3f3f3 solid;">
								
								<div style="width:60%; float:right; line-height:35px; color:#909090; font-family:\'微软雅黑\'; font-size:12px; text-align:right;">有效期至12-31</div>
								<div style="clear:both"></div>
							</div>
						</div>
					</div>
					<div style="clear:both"></div>
				</div>
			</div>';
            } else if ($value['giftname'] == '大头仔现金券') {
                $coupon_state = $this->ask_couponStatus($value['number']);
                if ($coupon_state['coupon_state'] == "SENDED") {
                    //没有使用大头仔现金券
                    $listTd .= '<div style="margin:10px auto; width:93%;">
				<div style="width:100%;">
					<div class="demo">
						<span style="width:100%; margin:0px auto; padding-top:20px;">
							<div style="width:70%; margin:0px auto;">
							<div style="width:100%; height:50px; line-height:50px; border-bottom:1px #01b1a1 solid; color:#FFFFFF; font-size:18px; text-align:center;">
								<div style="margin:0px auto; width:100%;"><div style="font-size:65px; float:left;">5</div><div style="font-size:16px; float:left; padding-top:5px; font-family:\'微软雅黑\';">元</div></div>
							</div>
							<div style="width:100%; line-height:30px; color:#FFFFFF; text-align:center; height:30px;">代金券</div>
							</div>
						</span>
					</div>
					<div style="width:70%; height:126px; float:left; background-color:#FFFFFF; border-radius:0 6px 6px 0;">
						<div style="width:80%; margin:0px auto;">
							<div style="width:100%; height:40px; line-height:40px; color:#000000; font-size:16px; font-family:\'微软雅黑\';">六楼食堂5元代金券</div>
							<div style="width:100%; height:15px; line-height:15px; color:#999999; font-size:14px; font-family:\'微软雅黑\';">满5.1元即可用，去食堂消费自动使用</div>
							<div style="width:100%; padding-top:34px; height:35px; line-height:35px; color:#999999; font-size:14px; font-family:\'微软雅黑\'; border-bottom:0.8px #f3f3f3 solid;">
								
								<div style="width:60%; float:right; line-height:35px; color:#909090; font-family:\'微软雅黑\'; font-size:12px; text-align:right;">有效期至12-31</div>
								<div style="clear:both"></div>
							</div>
						</div>
					</div>
					<div style="clear:both"></div>
				</div>
			</div>';
                } elseif ($coupon_state['coupon_state'] == "USED") {
                    //使用大头仔现金券
                    $url = C('config.site_url');
                    $listTd .= '<div style="background:url(' . $url . '/tpl/Wap/pure/static/images/137/xxx.png) no-repeat; background-size:100% 100%; width:57px; height:48px; margin-top:10px; right:12%; z-index:999; position:absolute;"></div>
			<div style="margin:10px auto; width:93%;">
				<div style="width:100%;">
					<div class="demo">
						<span style="width:100%; margin:0px auto; padding-top:20px;">
							<div style="width:70%; margin:0px auto;">
							<div style="width:100%; height:50px; line-height:50px; border-bottom:1px #01b1a1 solid; color:#FFFFFF; font-size:18px; text-align:center;">
								<div style="margin:0px auto; width:100%;"><div style="font-size:65px; float:left;">5</div><div style="font-size:16px; float:left; padding-top:5px; font-family:\'微软雅黑\';">元</div></div>
							</div>
							<div style="width:100%; line-height:30px; color:#FFFFFF; text-align:center; height:30px;">代金券</div>
							</div>
						</span>
					</div>
					<div style="width:70%; height:126px; float:left; background-color:#FFFFFF; border-radius:0 6px 6px 0;">
						<div style="width:80%; margin:0px auto;">
							<div style="width:100%; height:40px; line-height:40px; color:#000000; font-size:16px; font-family:\'微软雅黑\';">六楼食堂5元代金券</div>
							<div style="width:100%; height:15px; line-height:15px; color:#999999; font-size:14px; font-family:\'微软雅黑\';">满5.1元即可用，去食堂消费自动使用</div>
							<div style="width:100%; padding-top:34px; height:35px; line-height:35px; color:#999999; font-size:14px; font-family:\'微软雅黑\'; border-bottom:0.8px #f3f3f3 solid;">
								
								<div style="width:60%; float:right; line-height:35px; color:#909090; font-family:\'微软雅黑\'; font-size:12px; text-align:right;">有效期至12-31</div>
								<div style="clear:both"></div>
							</div>
						</div>
					</div>
					<div style="clear:both"></div>
				</div>
			</div>';
                } else {
                    //使用大头仔现金券
                    $listTd .= '<div style="margin:10px auto; width:93%;">
				<div style="width:100%;">
					<div class="demo">
						<span style="width:100%; margin:0px auto; padding-top:20px;">
							<div style="width:100%; margin:0px auto;">
							<div style="width:100%; height:50px; line-height:50px; border-bottom:1px #01b1a1 solid; color:#FFFFFF; font-size:18px; text-align:center;">
								<div style="margin:0px auto; width:100%;"><div style="font-size:38px;">5</div><div style="font-size:16px; float:left; padding-top:5px; font-family:\'微软雅黑\';">元</div></div>
							</div>
							<div style="width:100%; line-height:30px; color:#FFFFFF; text-align:center; height:30px;">代金券</div>
							</div>
						</span>
					</div>
					<div style="width:70%; height:126px; float:left; background-color:#FFFFFF; border-radius:0 6px 6px 0;">
						<div style="width:80%; margin:0px auto;">
							<div style="width:100%; height:40px; line-height:40px; color:#000000; font-size:16px; font-family:\'微软雅黑\';">六楼食堂5元代金券</div>
							<div style="width:100%; height:15px; line-height:15px; color:#999999; font-size:14px; font-family:\'微软雅黑\';">满5.1元即可用，去食堂消费自动使用</div>
							<div style="width:100%; padding-top:34px; height:35px; line-height:35px; color:#999999; font-size:14px; font-family:\'微软雅黑\'; border-bottom:0.8px #f3f3f3 solid;">
								
								<div style="width:60%; float:right; line-height:35px; color:#909090; font-family:\'微软雅黑\'; font-size:12px; text-align:right;">有效期至12-31</div>
								<div style="clear:both"></div>
							</div>
						</div>
					</div>
					<div style="clear:both"></div>
				</div>
			</div>';
                }

            } else if ($value['giftname'] == '停车优惠券' && $value['plate'] != '') {
                //使用停车优惠券
                $url = C('config.site_url');
                $listTd .= '<div style="background:url(' . $url . '/tpl/Wap/pure/static/images/137/xxx.png) no-repeat; background-size:100% 100%; width:57px; height:48px; margin-top:10px; right:12%; z-index:999; position:absolute;"></div>
			<div style="margin:10px auto; width:93%;">
				<div style="width:100%; background-color:#febe39;">
					<div class="demo2">
						<span style="width:100%; margin:0px auto; padding-top:20px;">
							<div style="width:70%; margin:0px auto;">
							<div style="width:100%; height:50px; line-height:50px; border-bottom:1px #b8b9bb solid; color:#FFFFFF; font-size:18px; text-align:center;">
								<div style="margin:0px auto; width:100%;"><div style="font-size:16px; text-align: center"">1小时</div></div>
							</div>
							<div style="width:100%; line-height:30px; color:#FFFFFF; text-align:center; height:30px;">减免</div>
							</div>
						</span>
					</div>
					<div style="width:70%; height:126px; float:left; background-color:#FFFFFF; border-radius:0 6px 6px 0;">
						<div style="width:80%; margin:0px auto;">
							<div style="width:100%; height:40px; line-height:40px; color:#9a9a9a; font-size:16px; font-family:\'微软雅黑\';">停车减免一小时优惠券</div>
							<div style="width:100%; height:15px; line-height:15px; color:#9a9a9a; font-size:14px; font-family:\'微软雅黑\';">已使用，使用车牌为' . $value['plate'] . '</div>
							<div style="width:100%; padding-top:34px; height:35px; line-height:35px; color:#999999; font-size:14px; font-family:\'微软雅黑\'; border-bottom:0.8px #f3f3f3 solid;">
								<div style="width:60%; float:right; line-height:35px; color:#9a9a9a; font-family:\'微软雅黑\'; font-size:12px; text-align:right;">有效期至12-31</div>
								<div style="clear:both"></div>
							</div>
						</div>
					</div>
					<div style="clear:both"></div>
				</div>
			</div>';

            } else {
                $money = $value['number'] / 100;
                //获取了现金红包
                $listTd .=
                    '<div style="margin:10px auto; width:93%;">
				<div style="width:100%; background-color:#febe39;">
					<div class="demo">
						<span style="width:100%; margin:0px auto; padding-top:20px;">
							<div style="width:70%; margin:0px auto;">
							<div style="width:100%; height:50px; line-height:50px; border-bottom:1px #01b1a1 solid; color:#FFFFFF; font-size:18px; text-align:center;">
								<div style="margin:0px auto; width:100%;"><div style="font-size:26px;text-align:center;">' . $money . '</div></div>
							</div>
							<div style="width:100%; line-height:30px; color:#FFFFFF; text-align:center; height:30px;">现金红包</div>
							</div>
						</span>
					</div>
					<div style="width:70%; height:126px; float:left; background-color:#FFFFFF; border-radius:0 6px 6px 0;">
						<div style="width:80%; margin:0px auto;">
							<div style="width:100%; height:40px; line-height:40px; color:#000000; font-size:16px; font-family:\'微软雅黑\';">微信现金红包</div>
							<div style="width:100%; height:15px; line-height:15px; color:#999999; font-size:14px; font-family:\'微软雅黑\';">请去公众号对话框中领取红包</div>
							<div style="width:100%; padding-top:34px; height:35px; line-height:35px; color:#999999; font-size:14px; font-family:\'微软雅黑\'; border-bottom:0.8px #f3f3f3 solid;">
								<div style="width:60%; float:right; line-height:35px; color:#909090; font-family:\'微软雅黑\'; font-size:12px; text-align:right;">有效期至12-31</div>
								<div style="clear:both"></div>
							</div>
						</div>
					</div>
					<div style="clear:both"></div>
				</div>
			</div>';
            }
        }
        return $listTd;
    }

    /*错误提示页面
	 * @author 祝君伟
	 * @time 2017.1.5
	 * */
    public function access_control_show_old()
    {
        $this->display();
    }

    /* 发送手机验证码
	* @time 2016-07-05
	* @author	小邓  <969101097@qq.com>*/
    public function SmsCodeverify()
    {
        if (isset($_POST['phone']) && !empty($_POST['phone'])) {
            $phone = M('house_village_user_bind')->where(array('uid' => array('neq', $this->user_session['uid']), 'village_id' => $_GET['village_id'], 'phone' => $_POST['phone']))->getField('phone');
            if ($phone == $_POST['phone']) {    //判断此手机号码是否存在
                $this->ajaxReturn(array('code_error' => 1, 'code_msg' => '此手机号码已存在请重新填写'));
            } else {
                $chars = '0123456789';
                mt_srand((double)microtime() * 1000000 * getmypid());
                $vcode = "";
                while (strlen($vcode) < 6) {
                    $vcode .= substr($chars, (mt_rand() % strlen($chars)), 1);
                }
                $addtime = time();
                $expiry = $addtime + 20 * 60; /*             * **二十分钟有效期*** */
                $data = array('telphone' => $_POST['phone'], 'vfcode' => $vcode, 'expiry' => $expiry, 'addtime' => $addtime);
                $insert_id = M('User_modifypwd')->add($data);
                if ($insert_id) {
                    $sms_model = new Sms_aliyunModel();
                    $return = $sms_model->sendSms_authcode($_POST['phone'], $vcode, ACTION_NAME);
                    if ($return == '1') {
                        $this->ajaxReturn(array('code_error' => 0, 'code_msg' => '发送成功'));
                    } else {
                        $this->ajaxReturn(array('code_error' => 1, 'code_msg' => '发送失败'));
                    }
                    /*$content='您的验证码是：'. $vcode . '。此验证码20分钟内有效，请不要把验证码泄露给其他人。如非本人操作，可不用理会！';
					//Sms::sendSms(array('mer_id'=>0,'store_id'=>0,'content'=>$content,'mobile'=>$_POST['phone'],'uid' =>$this->now_user['uid'],'type'=>'bindphone'));
					$post_data=array(			//短信发送所须参数
						'userid'=>'13296',
						'account'=>C('config.sms_uid'),
						'password'=>C('config.sms_pwd'),
						'content'=>$content,
						'mobile'=>$_POST['phone'],
						'sendtime'=>date('Y-m-d H:i:s'), //此处不可以写成时间戳形式
						'action'=>'send'
					);
					$url='http://www.duanxin10086.com/sms.aspx';
					$o='';
					foreach ($post_data as $k=>$vs){
						$o.="$k=".$vs.'&';
					}
					$post_data=substr($o,0,-1);
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_HEADER, 0);
					curl_setopt($ch, CURLOPT_URL,$url);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //如果需要将结果直接返回到变量里，那加上这句。
					$str = curl_exec($ch);
					$xml=simplexml_load_string($str);
					if($xml->returnstatus =='Success'){
						$this->ajaxReturn(array('code_error'=>0,'code_msg'=>'发送成功'));
					}else{
						$this->ajaxReturn(array('code_error'=>1,'code_msg'=>'发送失败'));
					}*/
                    //$result['msg']=$xml->message;
                } else {
                    $this->ajaxReturn(array('code_error' => 1, 'code_msg' => '失败啦'));
                }
            }
        } else {
            $this->ajaxReturn(array('code_error' => 2, 'code_msg' => '请输入手机号码'));
        }
    }

    /* 微信定位
	* @time 2016-07-22
	* @author	小邓  <969101097@qq.com>*/
    public function userLocation()
    {
        if (empty($this->user_session)) {    //判断是否已登录
            redirect(U('Wap/Login/weixin', array('referer' => urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']))));
        } else {
            //dump($this->user_session);
            if (IS_POST) {
                if ($_POST['control'] && $_POST['control'] == 'is_control') {    //判断是否是智能门禁定位
                    //D('User_long_lat')->saveLocation($this->user_session['openid'],$_POST['long'],$_POST['lat']);
                    if (M('user_long_lat')->where(array('open_id' => $this->user_session['openid']))->find()) {
                        $log_lat = M('user_long_lat')->where(array('open_id' => $this->user_session['openid']))->save(array('long' => $_POST['long'], 'lat' => $_POST['lat'], 'dateline' => $_SERVER['REQUEST_TIME']));
                    } else {
                        $log_lat = M('user_long_lat')->add(array('long' => $_POST['long'], 'lat' => $_POST['lat'], 'dateline' => $_SERVER['REQUEST_TIME'], 'open_id' => $this->user_session['openid']));
                    }
                    if ($log_lat) {
                        $this->ajaxReturn(array('code_error' => 0, 'code_msg' => '定位更新成功'));
                    } else {
                        $this->ajaxReturn(array('code_error' => 1, 'code_msg' => '定位更新失败'));
                    }
                } else {
                    $add_data = array(
                        'openid' => $this->user_session['openid'],
                        'wxname' => $this->user_session['nickname'],
                        'lat' => $_POST['lat'],
                        'long' => $_POST['long'],
                        'addtime' => date('Y-m-d H:i:s', time())
                    );
                    $add = M('user_location')->data($add_data)->add();
                    if ($add) {
                        $this->ajaxReturn(array('code_error' => 0, 'code_msg' => '添加成功'));
                    } else {
                        $this->ajaxReturn(array('code_error' => 1, 'code_msg' => '添加失败'));
                    }
                }
            } else {
                $signa_arr = unserialize($this->getSigna(D('Access_token_expires')->get_access_token()['access_token']));
                $signa_arr['appid'] = $this->config['wechat_appid'];
                $this->assign('signa_arr', $signa_arr);
                $this->display();
            }
        }
    }

    /* 获取随机数及签名
	* @time 2016-07-22
	* @author	小邓  <969101097@qq.com>*/
    public function getSigna($token = '')
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=' . $token . '&type=jsapi';
        $file_contents = file_get_contents($url);
        $file_contents = json_decode($file_contents, TRUE);
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url_host = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $str = "";
        for ($i = 0; $i < 16; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        $signature = sha1('jsapi_ticket=' . $file_contents['ticket'] . '&noncestr=' . $str . '&timestamp=' . time() . '&url=' . $url_host);
        $signa_arr = array();
        $signa_arr['str'] = $str;
        $signa_arr['signature'] = $signature;
        $result_signa = serialize($signa_arr);
        return $result_signa;
    }

    /* 我的钥匙提示页面(只访客点击时)
	* @time 2016-08-10
	* @author	小邓  <969101097@qq.com>*/
    public function noticeKid()
    {

        $this->display();
    }

    /* 测试
	* @time 2016-07-22
	* @author	小邓  <969101097@qq.com>*/
    public function testCompany()
    {
        if (IS_AJAX) {
            //$this->ajaxReturn(array('error_code'=>0,'code_msg'=>$_GET['village_id']));
            $village_id = intval($_GET['village_id']);    //社区ID
            $company_name = trim($_POST['company_name']);
            if (!empty($company_name)) {
                $company_head = M('company')->where(array('village_id' => $village_id, 'company_name' => array('like', $company_name . '%')))->field('company_id,company_name')->select();
                $company_cent = M('company')->where(array('village_id' => $village_id, 'company_name' => array('like', '%' . $company_name . '%')))->field('company_id,company_name')->select();
                if ($company_head) {
                    $this->ajaxReturn(array('error_code' => 0, 'code_msg' => $company_head));
                } else if ($company_cent) {
                    $this->ajaxReturn(array('error_code' => 0, 'code_msg' => $company_cent));
                } else {
                    $this->ajaxReturn(array('error_code' => 2, 'code_msg' => ''));
                }
            } else {
                $this->ajaxReturn(array('error_code' => 2, 'code_msg' => ''));
            }
        } else {
            //$company_list=M('company')->where(array('village_id'=>4))->order('CONVERT(company_name USING gbk) COLLATE gbk_chinese_ci ASC')->select();
            $company_list = M('company')->where(array('village_id' => 4))->field('company_id,company_name,company_first')->order('company_first ASC')->select();
            $this->assign('company_list', $company_list);
            $this->display();
        }
    }

    /*
	 * 封装方法，处理警报流程一，入表
	 * 警报反馈机制
	 * */
    protected function warning_data_add($action, $control, $encode, $result, $warning_name)
    {
        //根据act和con来获得系统名称
        $system_array = M('system_control')->where(array('system_act' => $action, 'system_con' => $control))->find();
        $data = array(
            'system_id' => $system_array['pigcms_id'],
            'warning_encoding' => $encode,
            'warning_result' => $result,
            'warning_name' => $warning_name,
            'create_time' => time()
        );
        //dump($data);exit();
        $result_code = M('system_warning_control')->data($data)->add();
        $admin_user = explode(",", $system_array['user_wx_opid']);
        $warn_info = array(
            'first_value' => $system_array['system_name'] . '发生错误！！！',
            'keyword1_value' => $warning_name,
            'keyword2_value' => '用户将无法使用该系统的功能',
            'remark_value' => '(错误编码：' . $encode . ')请开发者和错误处理人员尽快查看出错位置以便解决！'
        );
        if ($result_code) {
            //发送消息
            $res = array();
            foreach ($admin_user as $value) {//
                $time = time();
                $data = array(
                    'touser' => $value,
                    'template_id' => "31Q6rbAa0NQdVuFMH6oyYwdSdOEwQ7aYQuM1d5fXQEk",
                    'data' => array(
                        'first' => array(
                            'value' => urlencode($warn_info['first_value']),
                            'color' => "#029700",
                        ),
                        'keyword1' => array(
                            'value' => urlencode($warn_info['keyword1_value']),
                            'color' => "#000000",
                        ),
                        'keyword2' => array(
                            'value' => urlencode($warn_info['keyword2_value']),
                            'color' => "#000000",
                        ),
                        'keyword3' => array(
                            'value' => urlencode(date('Y-m-d H:i:s', $time)),
                            'color' => "#000000",
                        ),
                        'remark' => array(
                            'value' => urlencode($warn_info['remark_value']),
                            'color' => "#000000",
                        ),
                    )
                );
                import('@.ORG.pay.Weixin');
                $weixin = new Weixin();
                $res[] = $weixin->send_template_message(urldecode(json_encode($data)));
            }
            if ($res[0]['errmsg'] == 'ok') {
                return true;
            } else {
                return false;
            }
        } else {
            //入库失败
            return 1;
        }
    }

    public function test()
    {
        $res = $this->warning_data_add('open_door', MODULE_NAME, '1010', 'not found', '智能门禁开门异常');
        dump($res);
    }


    /**
     * 在线预约
     * @update-time: 2017-06-29 15:47:48
     * @author: 王亚雄
     */
    public function appointment_list()
    {
        define('IS_AJAX', isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest");
        if (IS_AJAX) {//ajax分页
            $village_id = I('get.village_id', 0);
            $model = M('house_village_repair_list', 'pigcms_');
            //条件
            $map = array();
            $map['hvrl.meal_id'] = array('gt', 0);
            $map['hvrl.village_id'] = array('eq', $village_id);
            $field = array(
                'hvrl.pigcms_id',//编号
                'hvrl.content',//描述
                'hvrl.name',//姓名
                'hvrl.pic',//图片
                'hvrl.appointment_start_time',//预约起始时间
                'hvrl.appointment_end_time',//预约结束时间
                'hvrl.meal_id',
                'hvrl.contact',//联系方式
                'hvrl.is_read',//是否审核
                'hvrl.time',//记录添加时间
                'hvrl.village_id',//社区ID
                'm.price',//价格
                'm.unit',//单位
                'm.name' => 'meal_name',//商铺名称
            );
            //搜索条件
            $_GET['keywords'] && $map['hvrl.contact|hvrl.name'] = array('like', '%' . $_GET['keywords'] . '%');
            //总条数
            $count = $model->alias('hvrl')
                ->join('left join __MEAL__ m on m.meal_id = hvrl.meal_id')
                ->where($map)
                ->order('hvrl.pigcms_id desc')
                ->count();
            //分页
            import('@.ORG.Page');
            $page = new Page($count, 4);
            $list = $model->alias('hvrl')
                ->field($field)
                ->join('left join __MEAL__ m on m.meal_id = hvrl.meal_id')
                ->where($map)
                ->order('hvrl.pigcms_id desc')
                ->limit(($_GET['p'] - 1) * $page->listRows, $page->listRows)
                ->select();
            if ($list) {
                //数据处理
                foreach ($list as &$row) {
                    $row['is_read_text'] = $row['is_read'] ? "已处理" : "未处理";
                    $row['appointment_start_time'] = date("Y-m-d H:i", $row['appointment_start_time']);
                    $row['appointment_end_time'] = date("Y-m-d H:i", $row['appointment_end_time']);
                    $row['detail_link'] = U('appointment_detail', array('pigcms_id' => $row['pigcms_id']));
                }
                $this->ajaxReturn(array('err' => 0, 'msg' => $_GET['p'] - 1, 'data' => $list));
            } else {
                $this->ajaxReturn(array('err' => 999, 'msg' => mysql_error(), 'data' => $list));
            }
        }

        $url_params = $_GET;
        unset($url_params['p']);
        $this->assign("url", U('', $url_params));//链接带除了页码外的所有参数
        $this->display('appointment_list');
    }

    /**
     * 在线预约>>>标记为已读
     * @update-time: 2017-06-30 10:19:32
     * @author: 王亚雄
     */
    public function is_read()
    {
        $pigcms_id = I('get.pigcms_id', 0, 'intval');
        $res = M('house_village_repair_list')->where('pigcms_id=%d', $pigcms_id)->setField('is_read', 1);
        if ($res) {
            $this->ajaxReturn(array('err' => 0, 'msg' => "成功"));
        } else {
            $this->ajaxReturn(array('err' => 999, 'msg' => mysql_error()));
        }
    }

    /**
     * 在线预约>>>详情
     * @update-time: 2017-06-30 10:56:11
     * @author: 王亚雄
     */
    public function appointment_detail()
    {
        $pigcms_id = I('get.pigcms_id', 0, 'intval');

        $model = M('house_village_repair_list', 'pigcms_');
        //计算记录所对应的sort_id
        $map = array();
        $map['pigcms_id'] = array('eq', $pigcms_id);
        $field = array(
            'hvrl.pigcms_id',//编号
            'hvrl.content',//描述
            'hvrl.name',//姓名
            'hvrl.pic',//图片
            'hvrl.appointment_start_time',//预约起始时间
            'hvrl.appointment_end_time',//预约结束时间
            'hvrl.meal_id',
            'hvrl.contact',//联系方式
            'hvrl.is_read',//是否审核
            'hvrl.time',//记录添加时间
            'hvrl.pic',//图片
            'm.price',//价格
            'm.unit',//单位
            'm.name' => 'meal_name',//商铺名称
        );
        //数据
        $info = $model->alias('hvrl')
            ->field($field)
            ->join('left join __MEAL__ m on m.meal_id = hvrl.meal_id')
            ->where($map)
            ->find();
        //图片补全
        if ($info['pic']) {
            $info['pic'] = explode('|', $info['pic']);
            foreach ($info['pic'] as &$v) {
                $v = "upload/house/" . $v;
            }
            unset($v);
        }

        $this->assign('info', $info);

//        dump($info);exit();


        $this->display('appointment_detail');
    }

    /**
     * 微信群发消息
     */
    public $wxmsg_audit_role = 45;
    public $audit_admin_info = array();

    //添加消息
    public function add_group_msg()
    {

    }

    //列表
    public function group_msg_list()
    {
        define('IS_AJAX', isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest");
        if (IS_AJAX) {//ajax分页
            $model = M('wxmsg', 'pigcms_');
            $field = array(
                'msg.id',
                'msg.title',
                'msg.status',
                'msg.msg_type',
                'msg.send_type',
                'msg.send_time',
                'msg.publish_admin_id',
                'c.company_id',
                'msg.village_ids',
                'c.village_id',
                'c.company_name',
                'hv.village_name',
                'a.realname',
            );
            $count = $model->count();
            import('@.ORG.Page');
            $page = new Page($count, 4);
            $list = $model->alias('msg')
                ->field($field)
                ->join('left join __COMPANY__ c on msg.company_ids=c.company_id')
                ->join('left join __HOUSE_VILLAGE__ hv on hv.village_id = c.village_id')
                ->join('left join __ADMIN__ a on a.id = msg.publish_admin_id')
                ->limit(($_GET['p'] - 1) * $page->listRows, $page->listRows)
                ->order('id desc')
                ->select();


            if ($list) {
                foreach ($list as &$row) {
                    $row['msg_type_name'] = $this->get_msg_type_name($row['msg_type']);
                    $row['send_type_name'] = $this->get_send_type_name($row['send_type']);
                    $row['status_name'] = $this->get_status_name($row['status']);
                    $row['send_time'] = $row['send_time'] ? date("Y-m-d H:i", $row['send_time']) : "";
                    $row['detail_link'] = U('audit_group_msg', array('msg_id' => $row['id']));
                }
                $this->ajaxReturn(array('err' => 0, 'msg' => $_GET['p'] - 1, 'data' => $list, 'sql' => M()->getLastSql()));
            } else {
                $this->ajaxReturn(array('err' => 999, 'msg' => mysql_error(), 'data' => $list));
            }
        }

        $url_params = $_GET;
        unset($url_params['p']);
        $this->assign("url", U('', $url_params));//链接带除了页码外的所有参数
        $this->display('group_msg_list');
    }

    //详情
    public function group_msg_detail($msg_id)
    {
        $msg_info = $this->get_msg_info($msg_id);
        $this->assign('info', $msg_info);
        $this->display();
    }

    /**
     * 普通用户查看具体内容
     */
    public function view_msg($msg_id)
    {
        $msg_info = $this->get_msg_info($msg_id);
        $this->assign('msg_info', $msg_info);
        $visitor_model = new Visitor_logModel();
        $visitor_model->add_log(array('msg_id' => $msg_id));//访问日志记录
        $this->display('view_msg2');
    }

    //管理员审核详情页
    public function audit_group_msg($msg_id)
    {
        //$this->can_audit();
        $msg_info = $this->get_msg_info($msg_id);
        $this->assign('info', $msg_info);
        $this->display();
    }

    //管理员审核执行
    public function audit_group_msg_act($msg_id)
    {
//        dump($_POST);
//        //审核权限判断
//        $this->can_audit();
        $status = I('post.status');
        $remark = I('post.remark');
        if ($status == 2 && $remark == "") {
            $this->error("请填写退回意见", U('audit_group_msg', array('msg_id' => $msg_id)));
        }
        //msg_info
        $msg_info = M('wxmsg', 'pigcms_')->where('id=%d', $msg_id)->find();

        //验证状态
        switch ($msg_info['status']) {
            case 1:
                $this->error("该信息已通过审核，请不要重复提交");
                break;
            case 2:
                $this->error("该信息已被退回");
                break;
        }


        //更新的数据
        $data = array('status' => $status, 'remark' => $remark, 'audit_admin_id' => $this->audit_admin_info['id']);
        $data['update_time'] = time();
        $re = M('wxmsg', 'pigcms_')->where('id=%d', $msg_id)->save($data);
        if ($re !== false) {

            if ($status == 2) {//退回修改意见
                $this->send_to_publish($this->audit_admin_info['id'], $msg_info['title'], C('WEB_DOMAIN') . U('group_msg_detail', array('msg_id' => $msg_id)));
            } else {//执行发送
                $this->send_group_msg($msg_id, $msg_info['send_type'] == "fixed", $msg_info['send_time']);
            }
            $this->success("操作成功");
        } else {
            $this->error("操作失败 " . mysql_error());
        }
    }


    /**
     * @param int $msg_id 消息ID
     * @param bool $fixed 是否为定时发送
     * @param int $send_time 定时发送的时间戳
     */
    public function send_group_msg($msg_id = 50, $fixed = false, $send_time = 0)
    {
        if ($fixed) {
            $this->add_fixedtime_task($msg_id, $send_time);
        } else {
            $wx = new WechatModel();
            //更新发送时间
            M('wxmsg')->where('id=%d', $msg_id)->setField('send_time', time());
            return $wx->send_group_msg($msg_id);
        }


    }

    /**
     * @param $msg_id
     * 获取消息信息
     */
    protected function get_msg_info($msg_id)
    {
        $model = M('wxmsg', 'pigcms_');
        $field = array(
            'msg.id',
            'msg.title',
            'msg.status',
            'msg.msg_type',
            'msg.send_type',
            'msg.send_time',
            'msg.content',
            'msg.digest',
            'msg.cover',
            'msg.publish_admin_id',
            'msg.status',
            'msg.remark',
            'msg.create_time',
            'c.company_id',
            'msg.village_ids',
            'c.village_id',
            'ifnull(c.company_name,"所有公司")' => 'company_name',
            'ifnull(hv.village_name,"所有社区")' => 'village_name',

        );
        $info = $model->alias('msg')
            ->field($field)
            ->join('left join __COMPANY__ c on msg.company_ids=c.company_id')
            ->join('left join __HOUSE_VILLAGE__ hv on hv.village_id = msg.village_ids')
            ->where('id=%d', $msg_id)
            ->find();

        if ($info) {
            $info['msg_type_name'] = $this->get_msg_type_name($info['msg_type']);
            $info['send_type_name'] = $this->get_send_type_name($info['send_type']);
            $info['status_name'] = $this->get_status_name($info['status']);
            $info['content'] = htmlspecialchars_decode($info['content']);
            $info['publish_admin'] = M('admin')->where('id=%d', $info['publish_admin_id'])->getField('realname');
            $info['count_users'] = $this->count_users($info['village_id'], $info['company_id']);
        }

        return $info;


    }

    //获取消息类型
    protected function get_msg_type_name($type)
    {
        $names = array(
            'image' => '图片',
            'text' => '纯文本',
            'image_text' => '图文'
        );

        return $names[$type] ?: "没有找到";
    }

    //获取发送类型
    protected function get_send_type_name($type)
    {
        $names = array(
            'moment' => '立即发送',
            'fixed' => '定时发送',
        );

        return $names[$type] ?: "没有找到";
    }

    //获取状态描述
    protected function get_status_name($type)
    {
        $names = array(
            0 => '未审核',
            1 => '审核通过',
            2 => '审核未通过'
        );
        return $names[$type] ?: "没有找到";
    }

    /**
     * 计算用户数量 根据社区id、公司id
     * @param $village_id
     * @param $company_id
     * @return mixed
     */
    protected function count_users($village_id, $company_id)
    {
        $map = array();
        $village_id && $map['c.village_id'] = array('eq', $village_id);
        $company_id && $map['c.company_id'] = array('eq', $company_id);
        $count = M('house_village_user_bind')->alias('u')
            ->join('left join __COMPANY__ c on c.company_id=u.company_id')
            ->join('left join __HOUSE_VILLAGE__ v on v.village_id=c.village_id ')
            ->where($map)
            ->count();

        return $count ?: 0;

    }

    //向审核管理员推送消息
    protected function send_to_audit($title, $url = "")
    {
        //微信类库
        $wechat = new WechatModel();

        //获取物业相关人员微信openid
        //相关角色
        $role_names = array(
            '45' => "微信推送消息审核管理员",
            '16' => '点点滴滴',
        );
        $role_ids = array_keys($role_names);
        $map = array();
        $map['role_id'] = array('in', $role_ids);
        $admins = M('admin')->where($map)->select();
        $openids = array();
        foreach ($admins as $admin) {
            if ($admin['openid']) {
                $openids[] = $admin['openid'];
            }
        }
        $openids = array_unique($openids);
        //流程审批提醒模板ID
        $tpl_id = $wechat::TPLID_LCSPTX;
        $data = array(
            'first' => array(
                'value' => "微信群发通知审核提醒",
                'color' => "#029700",
            ),
            'keyword1' => array(
                'value' => "微信群发通知审核提醒",
                'color' => "#000000",
            ),
            'keyword2' => array(
                'value' => session('admin_name'),
                'color' => "#000000",
            ),
            'keyword3' => array(
                'value' => $title,
                'color' => "#000000",
            ),
            'keyword4' => array(
                'value' => date('Y-m-d H:i:s', time()),
                'color' => "#000000",
            ),
        );
        $res = $wechat->send_tpl_messages($openids, $tpl_id, $url, $data);
        if ($res[0]['errcode'] !== 0) {
            //TODO::与用户方逻辑无关，暂不提醒，应记录在日志系统当中
            // $this->error("推送消息失败");
        }
    }

    //向发布者推送消息 修改意见反馈
    protected function send_to_publish($admin_id, $title, $url = "")
    {
        //微信类库
        $wechat = new WechatModel();

        //获取微信openid
        $admin_info = M('admin', 'pigcms_')->where('id=%d', $admin_id)->find();
        $openid = $admin_info['openid'];
        //流程审批提醒模板ID
        $tpl_id = $wechat::TPLID_LCSPTX;
        $data = array(
            'first' => array(
                'value' => "微信群发通知审核提醒",
                'color' => "#029700",
            ),
            'keyword1' => array(
                'value' => "退回修改意见",
                'color' => "#000000",
            ),
            'keyword2' => array(
                'value' => $admin_info['realname'],//人
                'color' => "#000000",
            ),
            'keyword3' => array(
                'value' => $title,
                'color' => "#000000",
            ),
            'keyword4' => array(
                'value' => date('Y-m-d H:i:s', time()),
                'color' => "#000000",
            ),
        );
        if ($openid) {
            $res = $wechat->send_tpl_message($openid, $tpl_id, $url, $data);
            if ($res[0]['errcode'] !== 0) {
                //TODO::与用户方逻辑无关，暂不提醒，应记录在日志系统当中
                // $this->error("推送消息失败");
            }
        } else {
            return false;
        }

        return $openid;

    }

    /**
     * 是否能够审核
     */
    protected function can_audit()
    {
        $admin_model = M('admin', 'pigcms_');
        //是否具有审核权限
        $admin_data = $admin_model->where('openid="%s"', session('user.openid'))->select();
        $can_audit = false;
        foreach ($admin_data as $row) {
            //超管和审核角色才能进行审核
            if ($row['id'] == 1 || $row['role_id'] == $this->wxmsg_audit_role) {
                $can_audit = true;
                $this->audit_admin_info = $row;
            }
        }
        if (!$can_audit) {
            $this->error("你无权进行审核");
            exit();
        }
        //是否需要被审核
        $wxmsg_model = M('wxmsg', 'pigcms_');
        $msg_id = I('request.msg_id', 0, 'intval');
        $wxmsg_info = $wxmsg_model->where('id=%d', $msg_id)->find();
        if (!$wxmsg_info) {
            $this->error("该条信息已被删除");
            exit();
        }
        //已审核直接跳转到详情页
        if ($wxmsg_info && $wxmsg_info['status'] != 0) {
            $this->redirect(U('group_msg_detail', array('msg_id' => $msg_id)));
        }


    }

    /**
     * 添加到定时任务
     * @param $msg_id
     * @param $send_time
     */
    protected function add_fixedtime_task($msg_id, $send_time)
    {
        $connect = new Memcached;  //声明一个新的memcached链接
        $connect->setOption(Memcached::OPT_COMPRESSION, false); //关闭压缩功能
        $connect->setOption(Memcached::OPT_BINARY_PROTOCOL, true); //使用binary二进制协议
        $connect->addServer('f120e580f9b74ec5.m.cnhzaliqshpub001.ocs.aliyuncs.com', 11211); //添加OCS实例地址及端口号
        $group_msg = unserialize($connect->get('group_msg')) ?: array();
        $add_msg = array();
        $add_msg['msg_id'] = $msg_id;
        $add_msg['send_time'] = $send_time;
        $group_msg[] = $add_msg;
        return $connect->set('group_msg', serialize($group_msg));
    }

    /**
     * @param string $message
     * @param string $jumpUrl
     * @param bool|mixed $data
     * @author 王亚雄
     */
    protected function success($message = '', $jumpUrl = '', $data)
    {
        if (IS_AJAX == 1) {

            $this->ajaxReturn(array('error' => 0, 'msg' => $message, 'data' => $data));

        } else {

            parent::success($message, $jumpUrl, false);

        }
    }

    public function error($message = '', $jumpUrl = '', $data)
    {
        if (IS_AJAX == 1) {

            $this->ajaxReturn(array('error' => __LINE__, 'msg' => $message, 'data' => $data));

        } else {

            parent::error($message, $jumpUrl, false);

        }
    }

    public function wx_test()
    {
//        $connect = new Memcached;  //声明一个新的memcached链接
//        $connect->setOption(Memcached::OPT_COMPRESSION, false); //关闭压缩功能
//        $connect->setOption(Memcached::OPT_BINARY_PROTOCOL, true); //使用binary二进制协议
//        $connect->addServer('f120e580f9b74ec5.m.cnhzaliqshpub001.ocs.aliyuncs.com', 11211); //添加OCS实例地址及端口号
//        $group_msg = unserialize($connect->get(
    }

}