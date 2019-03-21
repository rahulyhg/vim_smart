<?php

//社区O2O

class HouseAction extends BaseAction{
	protected $village_bind;
	public function __construct(){
		parent::__construct();
		$this->village_bind = $_SESSION['now_village_bind'];
	}
	public $pay_list_type = array(
		'property'=>'物业费',
		'water'=>'水费',
		'electric'=>'电费',
		'gas'=>'燃气费',
		'park'=>'停车费',
		'custom'=>'其他缴费',
		'accessControl'=>'智能门禁',
		'jiaofei'=>'在线缴费',
		'repair'=>'在线报修',
		'suggest'=>'投诉建议',
		'houtai'=>'后台管理',
	);
	public function check_village_session($village_id){
		if(empty($this->village_bind) && !empty($this->user_session)){
			D('House_village')->get_bind_list($this->user_session['uid'],$this->user_session['phone']);
			$bind_village_list = D('House_village_user_bind')->get_user_bind_list($this->user_session['uid'],$village_id);
			if(!empty($bind_village_list)){
				if(count($bind_village_list) == 1){
					$this->village_bind = $_SESSION['now_village_bind'] = $bind_village_list[0];
				}else{
					redirect(U('House/village_select',array('village_id'=>$village_id,'referer'=>urlencode($_SERVER['REQUEST_URI']))));
				}
			}
		}
	}
	//小区列表
	public function village_list(){
		if($_GET['comm']){
			$condition['village_id'] = $_GET['village_id'];
			$info = M('house_commonphone');
			$server = $info->where(array('village_id'=>$condition['village_id'],'s_phone'=>'1'))->find();
//			dump($server['iphone']);exit;
			$this->assign('server',$server['iphone']);
			$ct_info = M('house_commontype');
			$ct_message = $ct_info->where('village_id ='.$condition['village_id'])->select();
			foreach($ct_message as $ke=>$va){
				$cp_message = $info->where(array('village_id'=>$condition['village_id'],'ct_id'=>$va['ct_id']))->order('ct_id DESC')->select();
				if(empty($cp_message)){
					unset($ct_message[$ke]);
				}else{
					foreach($cp_message as $key=>$val){
						$ct_message[$ke]['ct'][$key]['name'] = $val['nickname'];
						$ct_message[$ke]['ct'][$key]['phone'] = $val['iphone'];
					}
				}
			}
//			dump($ct_message);exit;
			$long_lat = D('User_long_lat')->getLocation($_SESSION['openid'],0);
			$long_lat['village_id'] = $_GET['village_id'];
//			dump($_GET);exit;
			$village_name=M('House_village')->where(array('village_id'=>$_GET['village_id']))->getField('village_name');
			//dump($village_name);exit;
			$this->assign('village_name',$village_name);
			$this->assign('now_village',$long_lat);
			$this->assign('ct_message',$ct_message);
			$this->display('House/commonphone_index');
		}else{
			//$long_lat=D('User_long_lat')->getLocation($_SESSION['openid'],0);				
			$long_lat=D('User_long_lat')->getLocation($_SESSION['openid'],5);	//定位
			//print_r($long_lat);
			$this->assign('long_lat',$long_lat);
			if($_GET['control'] && $_GET['control']=='key'){	//判断是否是我的钥匙
				$user_list=M('house_village_user_bind')->where(array('uid'=>$this->user_session['uid']))->select();
				if($user_list && is_array($user_list)){		//判断是否提交过资料
					$user_info=M('house_village_user_bind')->where(array('uid'=>$this->user_session['uid'],'role'=>array('neq',2)))->find();
					if($user_info){	//判断社区列表中是否存在业主
						if($user_info['ac_status']==1 || $user_info['ac_status']==3){	//是业主且已提交智能门禁审核但没得到认可时
							$this->redirect('你提交的资料正在审核中或审核未通过！',U('House/village_access_next',array('village_id'=>$user_info['village_id'])));
						}else if(empty($user_info['ac_status'])){	//是业主但没有提交智能门禁审核
							$this->redirect('请提交智能门禁资料审核',U('House/village_access_control',array('village_id'=>$user_info['village_id'])));
						}else{	//我的钥匙页面
							$this->redirect(U('House/control_show',array('village_id'=>$user_info['village_id'])));
						}
					}else{
						$this->redirect(U('House/noticeKid'));
					}
				}else{
					$this->assign('control',$_GET['control']);
					$this->display();
				}
			}else{
				$this->display();
			}
		}
	}
	public function ajax_village_list(){
		$this->header_json();
		$_SESSION['openid'] && $long_lat = D('User_long_lat')->getLocation($_SESSION['openid'],0);
		$return = array();

		//找到用户已绑定的小区
		if($this->user_session && $_GET['page'] < 2 && empty($_POST['keyword'])){
			$bind_village_list = D('House_village')->get_bind_list($this->user_session['uid'],$this->user_session['phone']);
			//dump($bind_village_list);exit;
			//判断得到用户位置
			if($bind_village_list && $long_lat){
				$rangeSort = array();
				foreach($bind_village_list as &$village_value){
					$village_value['range_int'] = getDistance($village_value['lat'],$village_value['long'],$long_lat['lat'],$long_lat['long']);
					$village_value['range'] = getRange($village_value['range_int']);
					$rangeSort[] = $village_value['range_int'];
				}
				array_multisort($rangeSort, SORT_ASC, $bind_village_list);
			}
			if($_SERVER['HTTP_HOST'] == 'www.hdhsmart.com' && $bind_village_list[0]['first_test']){
				$return['first_test'] = true;
			}
			$return['bind_village_list'] = $bind_village_list;
			//dump($bind_village_list);exit;
		}
		if(empty($this->user_session) && $_GET['page'] < 2 && empty($_POST['keyword'])){
			$return['login_test'] = true;
		}
		$return['village_list'] = D('House_village')->wap_get_list($long_lat,$_POST['keyword']);
		if(empty($return['village_list'])){
			unset($return['village_list']);
		}
		echo json_encode($return);
	}
	//户号选择，只有一个社区自动跳转
	public function village_select(){
		if($_GET['village_id']){
			$now_village = $this->get_village($_GET['village_id']);
			//$referer = $_GET['referer'] ? htmlspecialchars_decode($_GET['referer']) : U('House/village',array('village_id'=>$_GET['village_id']));
			$referer = $_GET['referer'] ? htmlspecialchars_decode($_GET['referer']) : U('House/access_control_change',array('village_id'=>$_GET['village_id'],'control'=>$_GET['control']));
		}else{
			$this->error_tips('非法访问');
		}
		if(!empty($this->user_session)){
			if($_GET['bind_id']){
				$bind_village = D('House_village_user_bind')->get_one($_GET['village_id'],$_GET['bind_id'],'pigcms_id');
				if(empty($bind_village) || $bind_village['uid'] != $this->user_session['uid']){
					$this->error_tips('非法访问');
				}
				$_SESSION['now_village_bind'] = $bind_village;
				redirect($referer);
			}else{
				D('House_village')->get_bind_list($this->user_session['uid'],$this->user_session['phone']);
				$bind_village_list = D('House_village_user_bind')->get_user_bind_list($this->user_session['uid'],$_GET['village_id']);
				if(empty($bind_village_list)){
					$_SESSION['now_village_bind']="";	//清空社区绑定session
					redirect($referer);
				}else{
					if(count($bind_village_list) == 1){
						$_SESSION['now_village_bind'] = $bind_village_list[0];
						redirect($referer);
					}else{
						$this->assign('bind_village_list',$bind_village_list);
					}
				}
			}
		}else{
			redirect($referer);
		}
		$this->assign('referer',$referer);
		$this->display();
	}
	public function village(){
		$now_village = $this->get_village($_GET['village_id']);
		$this->check_village_session($now_village['village_id']);
		//5条最新新闻
		$news_list = D('House_village_news')->get_limit_list($now_village['village_id'],6);
		$this->assign('news_list',$news_list);
		$user_long_lat = D('User_long_lat')->getLocation($_SESSION['openid'],0);
		//缴费
		$pay_list = array();
		$systemLiveServiceTypeArr = explode(',',$this->config['live_service_type']);
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
			'url' => U('House/village_access_control',array('village_id'=>$now_village['village_id'],'type'=>'accessControl')),
			//'url' => U('House/access_control_change',array('village_id'=>$now_village['village_id'],'type'=>'accessControl')),
		);

		$pay_list[] = array(
			'type' => 'jiaofei',
			'name' => $this->pay_list_type['jiaofei'],
			'url' => U('House/village_my_pay',array('village_id'=>$now_village['village_id'],'type'=>'jiaofei')),
		);
		$pay_list[] = array(
			'type' => 'repair',
			'name' => $this->pay_list_type['repair'],
			'url' => U('House/village_my_repair',array('village_id'=>$now_village['village_id'],'type'=>'repair')),
		);
		$pay_list[] = array(
			'type' => 'suggest',
			'name' => $this->pay_list_type['suggest'],
			'url' => U('House/village_my_suggest',array('village_id'=>$now_village['village_id'],'type'=>'suggest')),
		);
		$pay_list[]=array(
			'type'=>'houtai',
			'name'=>$this->pay_list_type['houtai'],
			'url'=>U('House/village_my_bind',array('village_id'=>$now_village['village_id'],'type'=>'houtai')),
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
		$appoint_list = D('House_village_appoint')->field('`appoint_id`,`label`,`pic`')->where(array('index_show'=>'1','village_id'=>$now_village['village_id']))->order('`sort` DESC')->select();
		foreach($appoint_list as $value){
			$pay_list[] = array(
				'type' => 'appoint',
				'name' => $value['label'],
				'url' => U('Appoint/detail',array('appoint_id'=>$value['appoint_id'])),
				'pic' => $this->config['site_url'].'/upload/house/appoint/'.$value['pic'],
			);
		}
		$this->assign('pay_list',$pay_list);
		//推荐团购
		$group_list = D('House_village_group')->get_limit_list($now_village['village_id'],3,$user_long_lat);
		$this->assign('group_list',$group_list);
		//推荐快店
		$meal_list = D('House_village_meal')->get_limit_list($now_village['village_id'],3,$user_long_lat);
		$this->assign('meal_list',$meal_list);
		//推荐预约
		$appoint_list = D('House_village_appoint')->get_limit_list($now_village['village_id'],3,$user_long_lat);
		$this->assign('appoint_list',$appoint_list);
		//找到模板排序
		$displayArr = explode(' ',$this->config['house_display']);
		$displayTplArr = array(
			1=>'village_index_news',
			2=>'village_index_pay',
			3=>'village_index_group',
			4=>'village_index_meal',
			5=>'village_index_appoint'
		);
		$displayIncludeTplArr = array();
		foreach($displayArr as $value){
			if($value>=1 && $value<=5){
				$displayIncludeTplArr[] = $displayTplArr[$value];
			}
		}
		$this->assign('displayIncludeTplArr',implode(',',$displayIncludeTplArr));
		$share_arr=array(
			'title'=>$now_village['village_name'],
			'desc'=>'汇得行-生活智慧助手',
			'imgUrl'=>C('config.site_url').'/tpl/Wap/myinterface/static/images/house.jpg',
			'link'=>C('config.site_url').'/wap.php?g=Wap&c=House&a=village&village_id='.$now_village['village_id']
		);
		$share = new WechatShare($this->config, $_SESSION['openid'],$share_arr);
		$this->shareScript = $share->getSgin();
		$this->assign('shareScript', $this->shareScript);
		$this->display();
	}

	public function village_newslist(){
		$now_village = $this->get_village($_GET['village_id']);

		$category_list = D('House_village_news_category')->get_limit_list($now_village['village_id']);
		if($category_list){
			$this->assign('category_list',$category_list);

			$news_list = D('House_village_news')->get_list_by_cid($category_list[0]['cat_id']);
			$this->assign('news_list',$news_list);

			$this->display();
		}else{
			$this->error_tips('本社区没有发布过新闻',U('House/village',array('village_id'=>$now_village['village_id'])));
		}
	}
	public function village_ajax_news(){
		$this->header_json();
		$news_list = D('House_village_news')->get_list_by_cid($_GET['cat_id']);
		foreach($news_list as &$newsValue){
			$newsValue['add_time_txt'] = date('m-d H:i',$newsValue['add_time']);
		}
		echo json_encode($news_list);
	}
	public function village_news(){
		$now_village = $this->get_village($_GET['village_id']);
		$this->check_village_session($now_village['village_id']);

		$now_news = D('House_village_news')->get_one($_GET['news_id']);
		if(empty($now_news)){
			$this->error_tips('当前文章不存在',U('House/village_newslist',array('village_id'=>$now_village['village_id'])));
		}
		$this->assign('now_news',$now_news);
		$this->display();
	}
	public function village_news_reply(){
		$this->header_json();
		$now_news = D('House_village_news')->get_one($_GET['news_id']);
		if(empty($now_news)){
			echo json_encode(array('errcode'=>2,'errmsg'=>'当前文章不存在'));
		}else if(empty($_POST['content'])){
			echo json_encode(array('errcode'=>3,'errmsg'=>'请填写评论的内容'));
		}else if(empty($this->user_session)){
			echo json_encode(array('errcode'=>4,'errmsg'=>'请先进行登录'));
		}else{
			$data_reply = array(
				'uid'=>$this->user_session['uid'],
				'village_id'=>$now_news['village_id'],
				'news_id'=>$now_news['news_id'],
				'content'=>$_POST['content'],
				'add_time'=>$_SERVER['REQUEST_TIME'],
				'add_ip'=>get_client_ip(1),
			);
			if(D('House_village_news_reply')->data($data_reply)->add()){
				echo json_encode(array('errcode'=>1,'errmsg'=>'发布成功，已经提交给小区管理员'));
			}else{
				echo json_encode(array('errcode'=>5,'errmsg'=>'发布失败'));
			}
		}
	}

	public function village_grouplist(){
		$now_village = $this->get_village($_GET['village_id']);

		$user_long_lat = D('User_long_lat')->getLocation($_SESSION['openid'],0);

		//推荐团购
		$group_list = D('House_village_group')->get_limit_list_page($now_village['village_id'],10,$user_long_lat);
		if(IS_POST){
			$this->header_json();
			// dump($group_list);
			echo json_encode($group_list['group_list']);
		}else{
			$this->assign($group_list);
			$this->display();
		}
	}
	public function village_meallist(){
		$now_village = $this->get_village($_GET['village_id']);

		$user_long_lat = D('User_long_lat')->getLocation($_SESSION['openid'],0);

		//推荐快店
		$store_list = D('House_village_meal')->get_limit_list_page($now_village['village_id'],10,$user_long_lat);
		if(IS_POST){
			$this->header_json();
			echo json_encode($store_list['store_list']);
		}else{
			$this->assign($store_list);
			$this->display();
		}
	}
	public function village_appointlist(){
		$now_village = $this->get_village($_GET['village_id']);

		$user_long_lat = D('User_long_lat')->getLocation($_SESSION['openid'],0);

		//推荐预约
		$appoint_list = D('House_village_appoint')->get_limit_list_page($now_village['village_id'],10,$user_long_lat);
		if(IS_POST){
			$this->header_json();
			echo json_encode($appoint_list['appoint_list']);
		}else{
			$this->assign($appoint_list);
			$this->display();
		}
	}

	public function village_pay(){
//		dump($_GET['village_id']);
		$phone = $this->user_session['phone'];
		if(empty($phone)){
			$this->error_tips('为了保护您的权益，在缴费之前您必须绑定手机号码！',U('My/bind_user',array('referer'=>urlencode(U('House/village_pay',$_GET)))));
		}
		$now_village = $this->get_village($_GET['village_id']);
		if(empty($this->user_session['phone'])){
			$this->user_session['phone'] = $_SESSION['user']['phone'];
		}
		D('House_village')->get_bind_list($this->user_session['uid'],$this->user_session['phone']);
		$bind_village_list = D('House_village_user_bind')->get_user_bind_list($this->user_session['uid'],$_GET['village_id']);
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
		if(empty($this->village_bind)){
			//$this->check_ajax_error_tips('您不属于当前小区，无法使用缴费功能');
			$this->redirect(U('House/village_access_control',array('village_id'=>$now_village['village_id'])));
		}
		$pay_type = $_GET['type'];
		$pay_name = $this->pay_list_type[$pay_type];
		if(empty($pay_name)){
			$this->check_ajax_error_tips('当前访问的缴费类型不存在');
		}
		//判断用户是否属于本小区
		if(empty($this->user_session)){
			$this->check_ajax_error_tips('请先进行登录',U('Login/index'));
		}
		$now_user_info = $this->get_user_village_info($this->village_bind['pigcms_id']);

		$pay_money = 0;
		switch($pay_type){
			case 'property':
				if(empty($now_village['property_price'])) $this->check_ajax_error_tips('当前小区不支持缴纳'.$pay_name);
				$pay_money = $now_user_info['property_price'];
				$order_list = D('House_village_user_paylist')->field('`ydate`,`mdate`,`property_price` AS `price`')->where(array('usernum'=>$now_user_info['usernum']))->order('`pigcms_id` DESC')->select();
				foreach($order_list as $key=>$value){
					$order_list[$key]['desc'] = '物业费 '.floatval($value['price']).' 元';
				}
				break;
			case 'water':
				if(empty($now_village['water_price'])) $this->check_ajax_error_tips('当前小区不支持缴纳'.$pay_name);
				$pay_money = $now_user_info['water_price'];
				$order_list = D('House_village_user_paylist')->field('`ydate`,`mdate`,`use_water` AS `use`,`water_price` AS `price`')->where(array('usernum'=>$now_user_info['usernum']))->order('`pigcms_id` DESC')->select();
				foreach($order_list as $key=>$value){
					$order_list[$key]['desc'] = '用水 '.floatval($value['use']).' 立方米，总费用 '.floatval($value['price']).' 元';
				}
				break;
			case 'electric':
				if(empty($now_village['electric_price'])) $this->check_ajax_error_tips('当前小区不支持缴纳'.$pay_name);
				$pay_money = $now_user_info['electric_price'];
				$order_list = D('House_village_user_paylist')->field('`ydate`,`mdate`,`use_electric` AS `use`,`electric_price` AS `price`')->where(array('usernum'=>$now_user_info['usernum']))->order('`pigcms_id` DESC')->select();
				foreach($order_list as $key=>$value){
					$order_list[$key]['desc'] = '用电 '.floatval($value['use']).' 千瓦时(度)，总费用 '.floatval($value['price']).' 元';
				}
				break;
			case 'gas':
				if(empty($now_village['gas_price'])) $this->check_ajax_error_tips('当前小区不支持缴纳'.$pay_name);
				$pay_money = $now_user_info['gas_price'];
				$order_list = D('House_village_user_paylist')->field('`ydate`,`mdate`,`use_gas` AS `use`,`gas_price` AS `price`')->where(array('usernum'=>$now_user_info['usernum']))->order('`pigcms_id` DESC')->select();
				foreach($order_list as $key=>$value){
					$order_list[$key]['desc'] = '使用燃气 '.floatval($value['use']).' 立方米，总费用 '.floatval($value['price']).' 元';
				}
				break;
			case 'park':
				if(empty($now_village['park_price'])) $this->check_ajax_error_tips('当前小区不支持缴纳'.$pay_name);
				$pay_money = $now_user_info['park_price'];
				$order_list = D('House_village_user_paylist')->field('`ydate`,`mdate`,`park_price` AS `price`')->where(array('usernum'=>$now_user_info['usernum']))->order('`pigcms_id` DESC')->select();
				foreach($order_list as $key=>$value){
					$order_list[$key]['desc'] = '停车费 '.floatval($value['price']).' 元';
				}
				break;
			case 'custom':
				if(empty($now_village['has_custom_pay'])) $this->check_ajax_error_tips('当前小区不支持缴纳'.$pay_name);
				break;
		}
		// dump(D('House_village_user_paylist'));exit;
		if(IS_POST){
			if($pay_type == 'custom'){
				if(empty($_POST['txt'])){
					$this->check_ajax_error_tips('请填写缴费事项');
				}else{
					$data_order['order_name'] = '社区缴费：'.$_POST['txt'];
				}
				$_POST['money'] = floatval($_POST['money']);
				if(empty($_POST['money'])){
					$this->check_ajax_error_tips('请填写缴费金额');
				}else{
					$data_order['money'] = $_POST['money'] > 10000 ? 10000 : $_POST['money'];
				}
			}else{
				$data_order['order_name'] = '缴纳'.$pay_name;
				$data_order['money'] = $pay_money > 10000 ? 10000 : $pay_money;
			}
			$data_order['uid'] = $this->user_session['uid'];
			$data_order['bind_id'] = $now_user_info['pigcms_id'];
			$data_order['village_id'] = $now_village['village_id'];
			$data_order['time'] = $_SERVER['REQUEST_TIME'];
			$data_order['paid'] = 0;
			$data_order['order_type'] = $pay_type;
			if($order_id = D('House_village_pay_order')->data($data_order)->add()){
				$this->header_json();
				//echo json_encode(array('err_code'=>1,'order_url'=>U('House/pay_order',array('order_id'=>$order_id))));
				echo json_encode(array('err_code'=>1,'order_url'=>U('Pay/check',array('order_id'=>$order_id,'type'=>'livepay'))));
				exit();
			}else{
				$this->check_ajax_error_tips('下单失败，请重试');
			}
			exit();
		}

		$this->assign('pay_type',$pay_type);
		$this->assign('pay_name',$pay_name);
		$this->assign('pay_money',$pay_money);
		$this->assign('order_list',$order_list);
		$this->display();
	}

	public function pay_order(){
		if(empty($this->user_session)){
			$this->check_ajax_error_tips('请先进行登录',U('Login/index'));
		}
		$now_user = D('User')->get_user($this->user_session['uid']);
		$order_id = $_GET['order_id'];
		$now_order = D('House_village_pay_order')->where(array('order_id'=>$order_id,'uid'=>$this->user_session['uid']))->find();
		if(empty($now_order)){
			$this->check_ajax_error_tips('当前订单不存在');
		}
		if($now_order['paid']){
			$this->check_ajax_error_tips('当前订单已支付',U('House/my_order_detail',array('order_id'=>$now_order['order_id'])));
		}
		if($now_user['now_money'] >= $now_order['money']){
			$use_result = D('User')->user_money($now_order['uid'],$now_order['money'],$now_order['order_name'].' 扣除余额');
			if($use_result['error_code']){
				redirect(U('House/my_order_detail',array('order_id'=>$now_order['order_id'])));
			}
			$data_order['order_id'] = $order_id;
			$data_order['pay_time'] = $_SERVER['REQUEST_TIME'];
			$data_order['paid'] = 1;
			D('House_village_pay_order')->data($data_order)->save();

			if($now_order['order_type'] != 'custom'){
				switch($now_order['order_type']){
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
				if(!empty($bind_field)){
					$now_user_info = D('House_village_user_bind')->get_one($now_order['village_id'],$now_order['bind_id'],'pigcms');
					$data_bind['pigcms_id'] = $now_user_info['pigcms_id'];
					$data_bind[$bind_field] = $now_user_info[$bind_field] - $now_order['money'] > 0 ? $now_user_info[$bind_field] - $now_order['money'] : 0;
					D('House_village_user_bind')->data($data_bind)->save();
				}
			}
			redirect(U('House/my_order_detail',array('order_id'=>$now_order['order_id'])));
		}else{
			redirect(U('My/recharge',array('money'=>$now_order['money']-$now_user['now_money'],'label'=>'wap_village_'.$order_id)));
		}
	}
	public function village_my(){
		//判断用户是否属于本小区
		if(empty($this->user_session)){
			if(IS_POST){
				$this->check_ajax_error_tips('请先进行登录',U('Login/index'));
			}else{
				redirect(U('Login/index'));
			}
		}
		$now_village = $this->get_village($_GET['village_id']);
		$this->check_village_session($now_village['village_id']);
		//dump($this->village_bind);exit;
		if(empty($this->village_bind)){
			$this->check_ajax_error_tips('您不属于当前小区，无法进入个人中心');
		}
		$now_user_info = $this->get_user_village_info($this->village_bind['pigcms_id']);
//dump($now_user_info);exit;读的是house_village_user_bind表，个人提交的审核资料信息，个人中心处的名字就是表中的name字段
		$now_user = D('User')->get_user($this->user_session['uid']);
		$this->assign('now_user',$now_user);

		$this->display();
	}
	public function village_my_pay(){
		if(empty($this->user_session)){
			$this->check_ajax_error_tips('请先进行登录',U('Login/index'));
		}
		$now_village = $this->get_village($_GET['village_id']);
		$this->check_village_session($now_village['village_id']);
		if(empty($this->village_bind)){
			//$this->check_ajax_error_tips('您不属于当前小区，无法使用缴费功能');
			$this->redirect(U('House/village_access_control',array('village_id'=>$now_village['village_id'])));
		}
		$now_user_info = $this->get_user_village_info($this->village_bind['pigcms_id']);

		//缴费
		$pay_list = array();
		$now_village['property_price'] = floatval($now_village['property_price']);
		$now_village['water_price'] = floatval($now_village['water_price']);
		$now_village['electric_price'] = floatval($now_village['electric_price']);
		$now_village['gas_price'] = floatval($now_village['gas_price']);
		$now_village['park_price'] = floatval($now_village['park_price']);
		if($now_village['property_price']){
			$pay_list[] = array(
				'type' => 'property',
				'name' => $this->pay_list_type['property'],
				'url' => U('House/village_pay',array('village_id'=>$now_village['village_id'],'type'=>'property')),
				'money'=>floatval($now_user_info['property_price']),
			);
		}
		if($now_village['water_price']){
			$pay_list[] = array(
				'type' => 'water',
				'name' => $this->pay_list_type['water'],
				'url' => $now_village['water_price'] ? U('House/village_pay',array('village_id'=>$now_village['village_id'],'type'=>'water')) : U('Lifeservice/query',array('type'=>'water')),
				'money'=>floatval($now_user_info['water_price']),
			);
		}
		if($now_village['electric_price']){
			$pay_list[] = array(
				'type' => 'electric',
				'name' => $this->pay_list_type['electric'],
				'url' => U('House/village_pay',array('village_id'=>$now_village['village_id'],'type'=>'electric')),
				'money'=>floatval($now_user_info['electric_price']),
			);
		}
		if($now_village['gas_price']){
			$pay_list[] = array(
				'type' => 'gas',
				'name' => $this->pay_list_type['gas'],
				'url' => U('House/village_pay',array('village_id'=>$now_village['village_id'],'type'=>'gas')),
				'money'=>floatval($now_user_info['gas_price']),
			);
		}
		if($now_village['park_price']){
			$pay_list[] = array(
				'type' => 'park',
				'name' => $this->pay_list_type['park'],
				'url' => U('House/village_pay',array('village_id'=>$now_village['village_id'],'type'=>'park')),
				'money'=>floatval($now_user_info['park_price']),
			);
		}
		if($now_village['has_custom_pay']){
			$pay_list[] = array(
				'type' => 'custom',
				'name' => $this->pay_list_type['custom'],
				'url' => U('House/village_pay',array('village_id'=>$now_village['village_id'],'type'=>'custom')),
				'money'=> -1,
			);
		}
		$this->assign('pay_list',$pay_list);

		$this->display();
	}
	public function village_my_paylists(){
		if(empty($this->user_session)){
			$this->check_ajax_error_tips('请先进行登录',U('Login/index'));
		}
		$now_village = $this->get_village($_GET['village_id']);
		$this->check_village_session($now_village['village_id']);
		if(empty($this->village_bind)){
			//$this->check_ajax_error_tips('您不属于当前小区，无法使用缴费功能');
			$this->redirect(U('House/village_access_control',array('village_id'=>$now_village['village_id'])));
		}
		$now_user_info = $this->get_user_village_info($this->village_bind['pigcms_id']);

		$now_user = D('User')->get_user($this->user_session['uid']);

		$order_list = D('House_village_pay_order')->field(true)->where(array('bind_id'=>$now_user_info['pigcms_id'],'village_id'=>$now_village['village_id'],'paid'=>'1'))->order('`order_id` DESC')->select();
		$this->assign('order_list',$order_list);

		$this->display();
	}
	public function village_my_repairlists(){
		if(empty($this->user_session)){
			$this->check_ajax_error_tips('请先进行登录',U('Login/index'));
		}
		$now_village = $this->get_village($_GET['village_id']);
		$this->check_village_session($now_village['village_id']);
		if(empty($this->village_bind)){
			//$this->check_ajax_error_tips('您不属于当前小区，无法使用报修功能');
			$this->redirect(U('House/village_access_control',array('village_id'=>$now_village['village_id'])));
		}
		$now_user_info = $this->get_user_village_info($this->village_bind['pigcms_id']);

		$repair_list = D('House_village_repair_list')->field(true)->where(array('bind_id'=>$now_user_info['pigcms_id'],'village_id'=>$now_village['village_id'],'type'=>'1'))->order('`pigcms_id` DESC')->select();
		$this->assign('repair_list',$repair_list);

		$this->display();
	}
	public function village_my_repair_detail(){
		if(empty($this->user_session)){
			$this->check_ajax_error_tips('请先进行登录',U('Login/index'));
		}
		$now_village = $this->get_village($_GET['village_id']);
		$this->check_village_session($now_village['village_id']);
		if(empty($this->village_bind)){
			//$this->check_ajax_error_tips('您不属于当前小区，无法使用报修功能');
			$this->redirect(U('House/village_access_control',array('village_id'=>$now_village['village_id'])));
		}
		$now_user_info = $this->get_user_village_info($this->village_bind['pigcms_id']);

		$repair_detail = D('House_village_repair_list')->field(true)->where(array('pigcms_id'=>$_GET['id']))->find();
		if(empty($repair_detail)){
			$this->check_ajax_error_tips('当前报修内容不存在');
		}
		if($repair_detail['pic']){
			$repair_detail['picArr'] = explode('|',$repair_detail['pic']);
		}
		$this->assign('repair_detail',$repair_detail);

		$this->display();
	}
	public function village_my_repair(){
		if(empty($this->user_session)){
			$this->check_ajax_error_tips('请先进行登录',U('Login/index'));
		}
		$now_village = $this->get_village($_GET['village_id']);
		$this->check_village_session($now_village['village_id']);
		if(empty($this->village_bind)){
			//$this->check_ajax_error_tips('您不属于当前小区，无法使用报修功能');
			$this->redirect(U('House/village_access_control',array('village_id'=>$now_village['village_id'])));
		}
		$now_user_info = $this->get_user_village_info($this->village_bind['pigcms_id']);

		if(IS_POST){
			if(empty($_POST['content'])){
				$this->check_ajax_error_tips('请填写内容');
			}
			$inputimg=isset($_POST['inputimg']) ? $_POST['inputimg'] :'';
			$picArr = array();
			if(!empty($inputimg)){
				foreach($inputimg as $imgv){
					$imgv = str_replace('/upload/house/','',$imgv);
					$picArr[] = $imgv;
				}
			}
			$data_repair['pic'] = implode('|',$picArr);
			$data_repair['content'] = $_POST['content'];
			$data_repair['village_id'] = $now_village['village_id'];
			$data_repair['uid'] = $this->user_session['uid'];
			$data_repair['bind_id'] = $now_user_info['pigcms_id'];
			$data_repair['is_read'] = '0';
			$data_repair['type'] = '1';
			$data_repair['time'] = $_SERVER['REQUEST_TIME'];
			if(D('House_village_repair_list')->data($data_repair)->add()){
				$this->header_json();
				echo json_encode(array('err_code'=>1,'order_url'=>U('House/pay_order',array('order_id'=>$order_id))));
				exit();
			}else{
				$this->check_ajax_error_tips('提交失败，请重试');
			}
		}else{
			$this->display();
		}
	}
	public function village_my_utilitieslists(){
		if(empty($this->user_session)){
			$this->check_ajax_error_tips('请先进行登录',U('Login/index'));
		}
		$now_village = $this->get_village($_GET['village_id']);
		$this->check_village_session($now_village['village_id']);
		if(empty($this->village_bind)){
			$this->redirect(U('House/village_access_control',array('village_id'=>$now_village['village_id'])));
		}
		$now_user_info = $this->get_user_village_info($this->village_bind['pigcms_id']);

		$repair_list = D('House_village_repair_list')->field(true)->where(array('bind_id'=>$now_user_info['pigcms_id'],'village_id'=>$now_village['village_id'],'type'=>'2'))->order('`pigcms_id` DESC')->select();
		$this->assign('repair_list',$repair_list);

		$this->display();
	}
	public function village_my_utilities_detail(){
		if(empty($this->user_session)){
			$this->check_ajax_error_tips('请先进行登录',U('Login/index'));
		}
		$now_village = $this->get_village($_GET['village_id']);
		$this->check_village_session($now_village['village_id']);
		if(empty($this->village_bind)){
			$this->redirect(U('House/village_access_control',array('village_id'=>$now_village['village_id'])));
		}
		$now_user_info = $this->get_user_village_info($this->village_bind['pigcms_id']);

		$repair_detail = D('House_village_repair_list')->field(true)->where(array('pigcms_id'=>$_GET['id']))->find();
		if(empty($repair_detail)){
			$this->check_ajax_error_tips('当前报修内容不存在');
		}
		if($repair_detail['pic']){
			$repair_detail['picArr'] = explode('|',$repair_detail['pic']);
		}
		$this->assign('repair_detail',$repair_detail);

		$this->display();
	}
	public function village_my_utilities(){
		if(empty($this->user_session)){
			$this->check_ajax_error_tips('请先进行登录',U('Login/index'));
		}
		$now_village = $this->get_village($_GET['village_id']);
		$this->check_village_session($now_village['village_id']);
		if(empty($this->village_bind)){
			//$this->check_ajax_error_tips('您不属于当前小区，无法使用缴费功能');
			$this->redirect(U('House/village_access_control',array('village_id'=>$now_village['village_id'])));
		}
		$now_user_info = $this->get_user_village_info($this->village_bind['pigcms_id']);

		if(IS_POST){
			if(empty($_POST['content'])){
				$this->check_ajax_error_tips('请填写内容');
			}
			$inputimg=isset($_POST['inputimg']) ? $_POST['inputimg'] :'';
			$picArr = array();
			if(!empty($inputimg)){
				foreach($inputimg as $imgv){
					$imgv = str_replace('/upload/house/','',$imgv);
					$picArr[] = $imgv;
				}
			}
			$data_repair['pic'] = implode('|',$picArr);
			$data_repair['content'] = $_POST['content'];
			$data_repair['village_id'] = $now_village['village_id'];
			$data_repair['uid'] = $this->user_session['uid'];
			$data_repair['bind_id'] = $now_user_info['pigcms_id'];
			$data_repair['is_read'] = '0';
			$data_repair['type'] = '2';
			$data_repair['time'] = $_SERVER['REQUEST_TIME'];
			if(D('House_village_repair_list')->data($data_repair)->add()){
				$this->header_json();
				echo json_encode(array('err_code'=>1,'order_url'=>U('House/pay_order',array('order_id'=>$order_id))));
				exit();
			}else{
				$this->check_ajax_error_tips('提交失败，请重试');
			}
		}else{
			$this->display();
		}
	}
	public function village_my_suggest(){
		if(empty($this->user_session)){
			$this->check_ajax_error_tips('请先进行登录',U('Login/index'));
		}
		$now_village = $this->get_village($_GET['village_id']);
		$this->check_village_session($now_village['village_id']);
		if(empty($this->village_bind)){
			//$this->check_ajax_error_tips('您不属于当前小区，无法使用投诉功能');
			$this->redirect(U('House/village_access_control',array('village_id'=>$now_village['village_id'])));
		}
		$now_user_info = $this->get_user_village_info($this->village_bind['pigcms_id']);

		if(IS_POST){
			if(empty($_POST['content'])){
				$this->check_ajax_error_tips('请填写内容');
			}
			$inputimg=isset($_POST['inputimg']) ? $_POST['inputimg'] :'';
			$picArr = array();
			if(!empty($inputimg)){
				foreach($inputimg as $imgv){
					$imgv = str_replace('/upload/house/','',$imgv);
					$picArr[] = $imgv;
				}
			}
			$data_repair['pic'] = implode('|',$picArr);
			$data_repair['content'] = $_POST['content'];
			$data_repair['village_id'] = $now_village['village_id'];
			$data_repair['uid'] = $this->user_session['uid'];
			$data_repair['bind_id'] = $now_user_info['pigcms_id'];
			$data_repair['is_read'] = '0';
			$data_repair['type'] = '3';
			$data_repair['time'] = $_SERVER['REQUEST_TIME'];
			if(D('House_village_repair_list')->data($data_repair)->add()){
				$this->header_json();
				echo json_encode(array('err_code'=>1,'order_url'=>U('House/pay_order',array('order_id'=>$order_id))));
				exit();
			}else{
				$this->check_ajax_error_tips('提交失败，请重试');
			}
		}else{
			$this->display();
		}
	}
	/*     * *图片上传** */
	public function ajaxImgUpload(){
		$filename = trim($_POST['filename']);
		$img = $_POST[$filename];
		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$imgdata = base64_decode($img);
		$img_order_id = sprintf("%09d",$this->user_session['uid']);
		$rand_num = mt_rand(10,99).'/'.substr($img_order_id,0,3).'/'.substr($img_order_id,3,3).'/'.substr($img_order_id,6,3);
		$getupload_dir = "/upload/house/" .$rand_num;

		$upload_dir = "." . $getupload_dir;
		if (!is_dir($upload_dir)) {
			mkdir($upload_dir, 0777, true);
		}
		$newfilename = date('YmdHis') . '.jpg';
		$save = file_put_contents($upload_dir . '/' . $newfilename, $imgdata);
		$save = file_put_contents($upload_dir . '/m_' . $newfilename, $imgdata);
		$save = file_put_contents($upload_dir . '/s_' . $newfilename, $imgdata);
		if ($save) {
			$this->dexit(array('error' => 0, 'data' => array('code' => 1, 'siteurl'=>$this->config['site_url'],'imgurl' =>$getupload_dir . '/' . $newfilename, 'msg' => '')));
		} else {
			$this->dexit(array('error' => 1, 'data' => array('code' => 0, 'url' => '', 'msg' => '保存失败！')));
		}
	}
	/*     * json 格式封装函数* */
	private function dexit($data = '') {
		if (is_array($data)) {
			echo json_encode($data);
		} else {
			echo $data;
		}
		exit();
	}
	protected function get_user_village_info($bind_id){
		$now_user_info = D('House_village_user_bind')->get_one_by_bindId($bind_id);
		if(empty($now_user_info)){
			$this->check_ajax_error_tips('您不是该小区业主');
		}
		$this->assign('now_user_info',$now_user_info);
		return $now_user_info;
	}
	protected function check_ajax_error_tips($err_tips,$err_url=''){
		if(IS_POST){
			$this->header_json();
			echo json_encode(array('err_code'=>-1,'err_msg'=>$err_tips,'err_url'=>$err_url));
			exit();
		}else{
			if($err_url){
				$this->error_tips($err_tips,$err_url);
			}else{
				$this->error_tips($err_tips);
			}
		}
	}
	protected function get_village($village_id){
		$now_village = D('House_village')->get_one($village_id);
		if(empty($now_village)){
			$this->error_tips('当前访问的小区不存在或未开放');
		}
		$this->assign('now_village',$now_village);
		return $now_village;
	}
	/**
	 * 业主的常用手机号码前台显示
	 * 汪威
	 * 2016.4.18
	 */
	public function commonphone_index(){
		$condition['village_id'] = $this->village_id;
		$info = M('house_commonphone');
		$ct_info = M('house_commontype');
		$ct_message = $ct_info->where('village_id ='.$condition['village_id'])->select();
		foreach($ct_message as $ke=>$va){
			$cp_message = $info->where(array('village_id'=>$condition['village_id'],'ct_id'=>$va['ct_id']))->order('ct_id DESC')->select();
			if(empty($cp_message)){
				unset($ct_message[$ke]);
			}else{
				foreach($cp_message as $key=>$val){
					$ct_message[$ke]['ct'][$key]['name'] = $val['nickname'];
					$ct_message[$ke]['ct'][$key]['phone'] = $val['iphone'];
				}
			}

		}
		$this->assign('ct_message',$ct_message);
		$this->display();
	}

	/* 智能门禁
	* @time 2016-06-6
	* @author	小邓  <969101097@qq.com>*/
	public function village_access_control(){
		$now_village = $this->get_village($_GET['village_id']);
		if($_GET['ac_id']){	//判断是否是扫设备码进入
			import('ORG.Net.Http');
			$http=new Http();
			$access_token=D('Access_token_expires')->get_access_token()['access_token'];
			$return=$http->curlGet('https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$access_token.'&openid='.$this->user_session['openid'].'&lang=zh_CN');
			$jsonrt=json_decode($return,true);
			if($jsonrt && !$jsonrt['subscribe']){	//判断是否已关注
				$this->redirect(U('House/access_control_show',array('village_id'=>$_GET['village_id'],'msg'=>'请先关注汇得行智慧助手公众号后使用微信开门功能！')));
			}
		}
		if(empty($this->user_session)){
			$this->check_ajax_error_tips('请先进行登录',U('Login/index'));
		}
		$where_data=array(
			'uid'=>$this->user_session['uid'],
			'village_id'=>$_GET['village_id']
		);
		if(IS_POST){
			if(empty($_POST['truename'])){
				$this->check_ajax_error_tips('请填写真实姓名');
			}else{
				$_POST['name']=$_POST['truename'];
				unset($_POST['truename']);
			}
			if(empty($_POST['phone'])){
				$this->check_ajax_error_tips('请填写手机号码');
			}
			if(empty($_POST['company_id'])){
				$this->check_ajax_error_tips('请选择公司');
			}
			if(empty($_POST['usernum'])){
				$_POST['usernum']=time();	
			}
			$inputimg=isset($_POST['inputimg']) ? $_POST['inputimg'] :'';
			if(!empty($inputimg)){
				$pic_arr = array();
				foreach($inputimg as $imgv){
					$imgv = str_replace('/upload/house/','',$imgv);
					$pic_arr[] = $imgv;
				}
				$_POST['workcard_img']=implode('|',$pic_arr);	//图片(即证件)
			}
			$phone=M('house_village_user_bind')->where(array('uid'=>array('neq',$this->user_session['uid']),'village_id'=>$_GET['village_id'],'phone'=>$_POST['phone']))->getField('phone');
			if($phone==$_POST['phone']){	//判断非本人时此手机号码是否存在
				header('Content-type: application/json');
				echo json_encode(array('err_code'=>1,'err_msg'=>'此手机号码已存在请重新填写'));
				exit;
			}
			$addtime=M('user_modifypwd')->where(array('telphone'=>$_POST['phone'],'vfcode'=>$_POST['vcode']))->order('addtime desc')->getField('addtime');
			if(!$addtime || (time()-$addtime>20*60)){	//判断验证码是否存在或过期
				header('Content-type: application/json');
				echo json_encode(array('err_code'=>2,'err_msg'=>'此验证码已过期或错误，请重新输入'));
				exit;
			}
			//此代码作废，无须做唯一性验证
//			$usernum=M('house_village_user_bind')->where(array('uid'=>array('neq',$this->user_session['uid']),'usernum'=>$_POST['usernum']))->getField('usernum');
//			if($usernum){
//				header('Content-type: application/json');
//				echo json_encode(array('err_code'=>1,'err_msg'=>'此工牌号已存在，请重新填写'));	//工牌号唯一
//				exit;
//			}
			$_POST['ac_status']=1;	//改变其状态，以证明提交过
			$_POST['role']=1;	//表示加入了智能门禁
			$village_bind_name=M('house_village_user_bind')->where($where_data)->getField('name');
			if($village_bind_name){	//判断是否已存在
				$_POST['last_time']=time();	//修改时间
				$village_bind=M('house_village_user_bind')->where($where_data)->data($_POST)->save();
			}else{
				$_POST['uid']=$this->user_session['uid'];
				$_POST['village_id']=$_GET['village_id'];	//社区ID
				$_POST['add_time']=time();	//新增时间
				$village_bind=M('house_village_user_bind')->data($_POST)->add();
			}
			if($village_bind){
				M('user')->where(array('uid'=>$this->user_session['uid']))->data(array('truename'=>$_POST['name'],'phone'=>$_POST['phone']))->save();	//修改用户表
				header('Content-type: application/json');
				echo json_encode(array('err_code'=>0,'err_msg'=>''));	//提交成功	
				$condition_table=array(C('DB_PREFIX').'house_village_user_bind'=>'v',C('DB_PREFIX').'company'=>'c');
				$condition_where='v.role=1 and v.company_id=c.company_id and v.village_id='.$_GET['village_id'].' and v.uid='.$this->user_session['uid'];
				$user_info=D('')->table($condition_table)->where($condition_where)->field('v.pigcms_id,c.company_id')->find();
				$time=time();		//审核信息推送
				$href=C('config.site_url').'/wap.php?c=House&a=village_control_checkInfo&village_id='.$_GET['village_id'].'&id_val='.$user_info['pigcms_id'];
				$model=new templateNews(C('config.wechat_appid'),C('config.wechat_appsecret'));
				$role_arr=M('role')->where(array('menus'=>array('like','%29%')))->field('role_id')->select();
				$role_str='';
				foreach($role_arr as $value){
					$role_str.=$value['role_id'].',';	//以,拼接角色ID
				}
				if(M('company')->where(array('company_id'=>$user_info['company_id'],'is_admin'=>array('neq',2)))->find()){	//判断是否须管理员审核
					$uid_arr=M('login_user')->field('uid')->where(array('role_id'=>array('in',trim($role_str,',')),'village_id'=>$_GET['village_id'],'status'=>1,'company_id'=>array('in','0,'.$user_info['company_id'])))->select();
				}else{
					$uid_arr=M('login_user')->field('uid')->where(array('role_id'=>array('in',trim($role_str,',')),'village_id'=>$_GET['village_id'],'status'=>1,'company_id'=>$user_info['company_id']))->select();
				}			
				if(!empty($uid_arr)){
					foreach($uid_arr as $val){
						$wecha_id=M('user')->where(array('uid'=>$val['uid']))->getField('openid');//获取user微信用户表中有权限29用户的openid，
						$model->sendTempMsg('OPENTM207145917',array('href'=>$href,'wecha_id'=>$wecha_id,'first'=>'您有一个待审核的信息！','keyword1'=>'智能门禁','keyword2'=>'管理员审核','keyword3'=>date('Y-m-d H:i:s')));
					}
				}
			}else{
				header('Content-type: application/json');
				echo json_encode(array('err_code'=>1,'err_msg'=>'提交失败，请您重试!'));	//提交失败
			}
		}else{
			$company_list=M('company')->where(array('village_id'=>$now_village['village_id']))->field('company_id,company_name,company_first')->order('company_first ASC')->select();
			//dump($company_list);exit;
			$this->assign('company_list',$company_list);
			$operat_type=isset($_GET['operat_type']) ? $_GET['operat_type'] : '';
			$user_info=M('house_village_user_bind')->where($where_data)->find();
			if(!empty($operat_type)){	//判断是否是因审核不通过返回修改的
				$this->assign('user_info',$user_info);
				$this->display();
			}else{
				$ac_status=M('house_village_user_bind')->where($where_data)->getField('ac_status');
				switch($ac_status){
					case '1':	//已提交申请
						$this->redirect(U('House/village_access_next',array('village_id'=>$now_village['village_id'])));
						break;
					case '2':	//审核通过
						$this->redirect(U('House/village_access_finish',array('village_id'=>$now_village['village_id'])));
						break;
					case '3':	//审核不通过
						$this->redirect(U('House/village_access_next',array('village_id'=>$now_village['village_id'])));
						break;
					case '4':	//已完成
						$this->redirect(U('House/village_access_show',array('village_id'=>$now_village['village_id'])));
						break;
					default:	//提交申请
						//print_r($user_info);
						$this->assign('user_info',$user_info);
						$this->display();
						break;
				}
			}
		}
	}
	/* 智能门禁
* @time 2016-06-6
* @author	小邓  <969101097@qq.com>*/
	public function village_access_control_sub(){
		$now_village = $this->get_village($_GET['village_id']);
		/*if(empty($now_village)){
			$this->error_tips('当前访问的小区不存在或未开放');
		}*/
		$this->display();
	}
	/* 智能门禁(提交审核第二步)
	* @time 2016-06-7
	* @author	小邓  <969101097@qq.com>*/
	public function village_access_next(){
		$now_village=$this->get_village($_GET['village_id']);		
		//echo $this->user_session['uid'];
		$where_data=array(
			'uid'=>$this->user_session['uid'],
			'role'=>1,
			'village_id'=>$_GET['village_id']
		);
		//$user_info=M('house_village_user_bind')->where($condition_where)->field(array('pigcms_id,name,phone,company,department,address,usernum,ac_status,ac_desc'))->find();
		$condition_table=array(C('DB_PREFIX').'house_village_user_bind'=>'v',C('DB_PREFIX').'company'=>'c');
		$condition_where='v.role=1 and v.company_id=c.company_id and v.village_id='.$_GET['village_id'].' and v.uid='.$this->user_session['uid'];
		$condition_field='v.pigcms_id,v.usernum,v.name,v.phone,v.card_type,c.company_id,c.company_name,v.ac_status,v.ac_desc';
		$user_info=D('')->table($condition_table)->where($condition_where)->field($condition_field)->find();
		//dump($user_info);exit;
		$this->assign('user_info',$user_info);
		$ac_status=M('house_village_user_bind')->where($where_data)->getField('ac_status');
		switch($ac_status){
			case '2':	//审核通过
				$this->redirect(U('House/village_access_finish',array('village_id'=>$now_village['village_id'])));
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
	public function village_access_finish(){
		$now_village = $this->get_village($_GET['village_id']);
		if(IS_POST){
			//$_POST['ac_status']=4;	//改变其状态，以证明审核通过
			//$alter_status=M('user')->where(array('uid'=>$this->user_session['uid']))->data(array('ac_status'=>$_POST['ac_status']))->save();
			$ac_status=M('house_village_user_bind')->where(array('uid'=>$this->user_session['uid'],'village_id'=>$_GET['village_id'],'ac_status'=>$_POST['ac_status']))->getField('ac_status');
			if($ac_status==4){
				echo json_encode(array('err_code'=>0,'code_url'=>U('House/village_access_show',array('village_id'=>$now_village['village_id']))));
			}else{
				$alter_status=M('house_village_user_bind')->where(array('uid'=>$this->user_session['uid'],'role'=>1,'village_id'=>$_GET['village_id']))->data(array('ac_status'=>$_POST['ac_status']))->save();
				if($alter_status){
					echo json_encode(array('err_code'=>0,'code_url'=>U('House/village_access_show',array('village_id'=>$now_village['village_id']))));
				}else{
					echo json_encode(array('err_code'=>1,'code_url'=>''));
				}
			}
		}else{

			$this->display();
		}
	}

	/* 智能门禁展示选项
	* @time 2016-06-17
	* @author	小邓  <969101097@qq.com>*/
	public function village_access_show(){
		$now_village = $this->get_village($_GET['village_id']);
		if(IS_POST){
			import('@.ORG.longlat');
			$longlat_class = new longlat();
			$user_long_lat=D('User_long_lat')->getLocation($_SESSION['openid'],0);	//获取用户位置信息
			$user_location=$longlat_class->gpsToBaidu($user_long_lat['lat'], $user_long_lat['long']);
			$village_long_lat=M('house_village')->where(array('village_id' =>$_GET['village_id']))->find();
			$village_location=$longlat_class->gpsToBaidu($village_long_lat['lat'], $village_long_lat['long']);
			$get_distance=GetDistance($user_location['lat'],$user_location['long'],$village_location['lat'],$village_location['long']);
			if($get_distance>2000){	//判断是否在社区范围之内
				echo json_encode(array('err_code'=>2,'code_msg'=>'您当前位置不在写字楼附近，无法开门！'));
				exit;
			}
			//$pigcms_id=M('house_village_user_bind')->where(array('uid'=>$this->user_session['uid'],'role'=>1,'village_id'=>$_GET['village_id']))->getField('pigcms_id');
			$pigcms_id=M('house_village_user_bind')->where(array('uid'=>$this->user_session['uid'],'village_id'=>$_GET['village_id']))->getField('pigcms_id');
			$add_data=array(
				//'uid'=>$this->user_session['uid'],
				'pigcms_id'=>$pigcms_id,
				'ac_id'=>$_POST['ac_id'],	//开关ID
				'village_id'=>$_GET['village_id'],	//社区ID
				'opdate'=>time()//开门时间
			);
			$control_log=M('access_control_user_log')->data($add_data)->add();
			if($control_log){
				import('@.ORG.Yeelink');
				$yeelink=new Yeelink($apikey='b11cb20c2903230a0463fdc6ce337e2d',$deviceid=$_POST['nodeid']);
				$connect = new Memcached;  //声明一个新的memcached链接
				$connect->setOption(Memcached::OPT_COMPRESSION, false); //关闭压缩功能
				$connect->setOption(Memcached::OPT_BINARY_PROTOCOL, true); //使用binary二进制协议
				$connect->addServer('f120e580f9b74ec5.m.cnhzaliqshpub001.ocs.aliyuncs.com', 11211); //添加OCS实例地址及端口号
				if($yeelink->getStatus($sensorid=$_POST['sensorid'])){	//判断开关是否已开
					echo json_encode(array('err_code'=>2,'code_msg'=>'门已开，请直接进入！'));
					if($connect->get('arr_key')){					//修改对应设备开启时间
						$arr_key=unserialize($connect->get('arr_key'));
						$new_arr=array();
						foreach($arr_key as $key=>$val){
							$new_arr[$key]=$val;
							if($val['ac_id']==$_POST['ac_id']){
								$new_arr[$key]['datetime']=time();
							}
						}
						$connect->set('arr_key',serialize($new_arr));	//修改
					}
				}else{
					$status_data=$yeelink->yeelink($sensorid=$_POST['sensorid'],$status=1);	//触发开关开
					if($status_data==""){
						echo json_encode(array('err_code'=>0,'code_msg'=>'记录成功'.$status_data));
						$add_arr=array(
							'ac_id'=>$_POST['ac_id'],
							'apikey'=>'b11cb20c2903230a0463fdc6ce337e2d',
							'nodeid'=>$_POST['nodeid'],
							'sensorid'=>$_POST['sensorid'],
							'datetime'=>time()
						);
						if($connect->get('arr_key')){	//判断是否是首次触发
							$arr_key=unserialize($connect->get('arr_key'));
							$new_arr=array();
							foreach($arr_key as $key=>$val){
								$new_arr[$key]=$val;
								if($val['ac_id']==$_POST['ac_id']){
									$new_arr[$key]['datetime']=time();
									$new_upd=true;	//修改标示
								}
							}
							if($new_upd){
								$connect->set('arr_key',serialize($new_arr));//修改
							}else{
								array_push($arr_key,$add_arr);				//追加
								$connect->set('arr_key',serialize($arr_key));
							}
						}else{
							$arr_key=array($add_arr);					//首次添加
							$connect->set('arr_key',serialize($arr_key));
						}
					}else{
						echo json_encode(array('err_code'=>1,'code_msg'=>'操作过于频繁,请稍后再试!'));
					}
				}
				$connect->quit();
				//重新存入
			}else{
				echo json_encode(array('err_code'=>1,'code_msg'=>'记录失败'));
			}
		}else{
			$access_control_result=D('AccessControl')->getAccesscontrollist($village_id=$_GET['village_id']);
			//dump($access_control_result);
			$new_arr=array();
			foreach($access_control_result as $key=>$val){
				$new_arr[$val['ag_id']]['parent']=$val['ag_name'];	//父级名称
				$new_arr[$val['ag_id']]['child'][]=$val;	//子级数组内容
			}
			//dump($new_arr);
			$this->assign('control_result',$new_arr);
			$share_arr=array(		//分享
				'title'=>$now_village['village_name'],
				'desc'=>'汇得行-生活智慧助手',
				'imgUrl'=>C('config.site_url').'/tpl/Wap/myinterface/static/images/house.jpg',
				'link'=>C('config.site_url').'/wap.php?g=Wap&c=House&a=village_access_show&village_id='.$now_village['village_id']
			);
			$share=new WechatShare($this->config,$_SESSION['openid'],$share_arr);
			$this->shareScript=$share->getSgin();
			$this->assign('shareScript',$this->shareScript);
			$role=M('house_village_user_bind')->where(array('uid'=>$this->user_session['uid'],'village_id'=>$now_village['village_id']))->getField('role');
			$this->assign('role',$role);
			$this->display();
		}
	}

	/* 个人绑定社区
	* @time 2016-06-20
	* @author	小邓  <969101097@qq.com>*/
	public function village_my_bind(){
		$now_village = $this->get_village($_GET['village_id']);
		$this->check_village_session($now_village['village_id']);
		if(empty($this->village_bind)){
			$this->redirect(U('House/village_access_control',array('village_id'=>$now_village['village_id'])));
		}
		if(IS_POST){
			$village_find=D('login_user')->where(array('account'=>trim(I('account')),'pwd'=>md5(trim(I('pwd'))),'village_id'=>$now_village['village_id']))->find();
			if($village_find){
				if(!$village_find['status']){
					$this->error_tips('你的账号已被禁用，请联系管理员！');
				}else{
					if($village_find['uid']){
						if($village_find['uid']==$this->user_session['uid']){//如果员工列表的账号密码绑定的微信号换了，用原来的微信号登录后台时应该提示错误
							$this->redirect(U('House/village_my_bind', array('village_id'=>$village_find['village_id'])));
						}else{
							$this->error_tips('你输入的账号已绑定微信号！');
						}
					}else{
						$village_alter=D('login_user')->where(array('account'=>trim(I('account')),'pwd'=>md5(trim(I('pwd'))),'village_id'=>$village_find['village_id'],'status'=>1))->data(array('uid'=>$this->user_session['uid']))->save();
						//dump($village_alter);exit;
						if($village_alter){
							$this->success_tips('绑定成功！',U('House/village_my_bind', array('village_id'=>$village_find['village_id'])));
						}else{
							$this->error_tips('绑定失败！');
						}
					}
				}
			}else{
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
		}else{
			M('house_village')->where(array('village_id'=>$_GET['village_id']))->data(array('last_time'=>time()))->save();	//修改登录时间
			$village_info=D('login_user')->where(array('village_id'=>$_GET['village_id'],'uid'=>$this->user_session['uid'],'status'=>1))->field('uid,village_id,role_id')->find();//根据它来判断该微信用户是否已经绑定到login_user表中
			//echo $village_info;exit;
			if($village_info['role_id']){
				$this->user_session['role_id']=M('login_user')->where(array('uid'=>$this->user_session['uid'],'village_id'=>$_GET['village_id']))->getField('role_id');
				$role_menus=M('role')->where(array('role_id'=>$this->user_session['role_id']))->getField('menus');//获取登陆信息中role_id的menu信息
				//dump($role_menus);exit;
				$village_menu=M('village_menu')->where(array('id'=>array('in',$role_menus),'status'=>1,'fid'=>array('gt',0)))->select();
				//dump($village_menu);
				$village_arr=array();
				foreach($village_menu as $key=>$val){
					switch($val['module'].'-'.$val['action']){
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
					}
				}
				$this->assign('village_arr',$village_arr);
			}
			$this->assign('village_info',$village_info);
			$this->display();
		}
	}

	/* 我的钥匙展示（所有社区）
	* @time 2016-06-22
	* @author	小邓  <969101097@qq.com>*/
	public function control_show(){
		/*header("Location: http://car.vhi99.com/?m=Home&c=Payrecord&a=problem");
		exit();*/
		if(empty($this->user_session)){	//判断是否已登录
			redirect(U('Wap/Login/weixin',array('referer'=>urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']))));
		}else{
			if(IS_POST){
				import('@.ORG.longlat');
				$longlat_class = new longlat();
				$user_long_lat=D('User_long_lat')->getLocation($_SESSION['openid'],0);	//获取用户位置信息
				$user_location=$longlat_class->gpsToBaidu($user_long_lat['lat'], $user_long_lat['long']);
				$village_long_lat=M('house_village')->where(array('village_id' =>$_POST['village_id']))->find();	//获取当前社区信息
				$village_location=$longlat_class->gpsToBaidu($village_long_lat['lat'], $village_long_lat['long']);
				$get_distance=GetDistance($user_location['lat'],$user_location['long'],$village_location['lat'],$village_location['long']);
				if($get_distance>2000){	//判断是否在社区范围之内
					echo json_encode(array('err_code'=>2,'code_msg'=>'您当前位置不在写字楼附近，无法开门！'));
					exit;
				}
				$where_data=array(
					'uid'=>$this->user_session['uid'],
					'village_id'=>$_POST['village_id']	//社区ID
				);
				$user_info=M('house_village_user_bind')->where($where_data)->field('role,ac_status')->find();
				if(!$user_info){	//判断是否已存在
					echo json_encode(array('err_code'=>3,'code_msg'=>U('House/access_control_change',array('village_id'=>$_POST['village_id']))));
				}else{
					if($user_info['role']<=1 && ($user_info['ac_status']==1 || $user_info['ac_status']==3)){ //是业主且已提交智能门禁审核但没得到认可时
						echo json_encode(array('err_code'=>3,'code_msg'=>U('House/village_access_next',array('village_id'=>$_POST['village_id']))));
					}else if($user_info['role']<=1 && empty($user_info['ac_status'])){	//是业主但没有提交智能门禁审核
						echo json_encode(array('err_code'=>3,'code_msg'=>U('House/village_access_control',array('village_id'=>$_POST['village_id']))));
					}else if($user_info['role']==2 && time()-$user_info['last_time']>24*60*60){	//是访客但上次提交的审核资料超过24小时
						echo json_encode(array('err_code'=>3,'code_msg'=>U('House/access_control_change',array('village_id'=>$_POST['village_id']))));
					}else{
						//echo json_encode(array('err_code'=>0,'code_msg'=>'可以进行操作啦'));
						//$pigcms_id=M('house_village_user_bind')->where(array('uid'=>$this->user_session['uid'],'role'=>1,'village_id'=>$_POST['village_id']))->getField('pigcms_id');
						$pigcms_id=M('house_village_user_bind')->where(array('uid'=>$this->user_session['uid'],'village_id'=>$_POST['village_id']))->getField('pigcms_id');
						$add_data=array(
							'pigcms_id'=>$pigcms_id,
							'ac_id'=>$_POST['ac_id'],	//开关ID
							'village_id'=>$_POST['village_id'],	//社区ID
							'opdate'=>time()//开门时间
						);
						$control_log=M('access_control_user_log')->data($add_data)->add();
						if($control_log){
							import('@.ORG.Yeelink');
							$yeelink=new Yeelink($apikey='b11cb20c2903230a0463fdc6ce337e2d',$deviceid=$_POST['nodeid']);
							$connect = new Memcached;  //声明一个新的memcached链接
							$connect->setOption(Memcached::OPT_COMPRESSION, false); //关闭压缩功能
							$connect->setOption(Memcached::OPT_BINARY_PROTOCOL, true); //使用binary二进制协议
							$connect->addServer('f120e580f9b74ec5.m.cnhzaliqshpub001.ocs.aliyuncs.com', 11211); //添加OCS实例地址及端口号
							if($yeelink->getStatus($sensorid=$_POST['sensorid'])){	//判断开关是否已开
								echo json_encode(array('err_code'=>2,'code_msg'=>'门已开，请直接进入！'));
								if($connect->get('arr_key')){					//修改对应设备开启时间
									$arr_key=unserialize($connect->get('arr_key'));
									$new_arr=array();
									foreach($arr_key as $key=>$val){
										$new_arr[$key]=$val;
										if($val['sensorid']==$_POST['sensorid']){
											$new_arr[$key]['datetime']=time();
										}
									}
									$connect->set('arr_key',serialize($new_arr));	//修改
								}
							}else{
								$status_data=$yeelink->yeelink($sensorid=$_POST['sensorid'],$status=1);	//触发开关开
//								$myfile = fopen("de.log", "a+") or die("Unable to open file!");
//								fwrite($myfile, $status_data);
								if($status_data==""&&$status_data!==false){
									echo json_encode(array('err_code'=>0,'code_msg'=>'记录成功'));
									$add_arr=array(
										'ac_id'=>$_POST['ac_id'],
										'apikey'=>'b11cb20c2903230a0463fdc6ce337e2d',
										'nodeid'=>$_POST['nodeid'],
										'sensorid'=>$_POST['sensorid'],
										'datetime'=>time()
									);
									if($connect->get('arr_key')){	//判断是否是首次触发
										$arr_key=unserialize($connect->get('arr_key'));
										$new_arr=array();
										foreach($arr_key as $key=>$val){
											$new_arr[$key]=$val;
											if($val['sensorid']==$_POST['sensorid']){
												$new_arr[$key]['datetime']=time();
												$new_upd=true;	//修改标示
											}
										}
										if($new_upd){
											$connect->set('arr_key',serialize($new_arr));//修改
										}else{
											array_push($arr_key,$add_arr);				//追加
											$connect->set('arr_key',serialize($arr_key));
										}
									}else{
										$arr_key=array($add_arr);					//首次添加
										$connect->set('arr_key',serialize($arr_key));
									}
								}else{
									echo json_encode(array('err_code'=>1,'code_msg'=>'操作过于频繁,请稍后再试!'));
								}
							}
							$connect->quit();
							//重新存入
						}else{
							echo json_encode(array('err_code'=>1,'code_msg'=>'记录失败'));
						}
					}
				}
			}else{
				$condition_table=array(
					'pigcms_house_village'=>'village',
					'pigcms_access_control_group'=>'group',
					'pigcms_access_control'=>'control'
				);
				$condition_where='village.village_id=group.village_id and group.ag_id=control.ag_id and control.ac_status=1';
				$condition_field='village.village_id,village.village_name,village.lat,village.long,group.ag_name,control.ac_id,control.ag_id,control.ac_name,control.apikey,control.nodeid,control.sensorid';
				$access_control_result=M('')->table($condition_table)->where($condition_where)->field($condition_field)->select();
				$long_lat=D('User_long_lat')->getLocation($_SESSION['openid'],0);	//获取用户位置信息
				//dump($long_lat);
				//dump($access_control_result);
				if($access_control_result && $long_lat){
					$rangeSort=array();
					foreach($access_control_result as &$village_value){
						$village_value['range_int']=getDistance($village_value['lat'],$village_value['long'],$long_lat['lat'],$long_lat['long']);//用户与社区距离
						$village_value['range']=getRange($village_value['range_int']);
						$rangeSort[]=$village_value['range_int'];
					}
					array_multisort($rangeSort,SORT_ASC,$access_control_result);//按距离近远排序
				}
				//dump($access_control_result);
				$new_arr=array();
				foreach($access_control_result as $key=>$val){
					$new_arr[$val['village_id']]['beforparent']=$val['village_name'];	//一级父级名称
					$new_arr[$val['village_id']]['range']=$val['range'];	//一级父级距离
					$new_arr[$val['village_id']]['beforchild'][$val['ag_id']]['afterparent']=$val['ag_name'];	//二级父级名称
					$new_arr[$val['village_id']]['beforchild'][$val['ag_id']]['afterchild'][]=$val;	//子级数组内容
				}
				//dump($new_arr);
				$this->assign('control_result',$new_arr);
				$signa_arr=unserialize($this->getSigna(D('Access_token_expires')->get_access_token()['access_token']));
				$signa_arr['appid']=$this->config['wechat_appid'];
				$this->assign('signa_arr',$signa_arr);	//微信定位所须参数
				$share_arr=array(		//分享
					'title'=>'我的钥匙',
					'desc'=>'汇得行-生活智慧助手',
					'imgUrl'=>C('config.site_url').'/tpl/Wap/myinterface/static/images/house.jpg',
					'link'=>C('config.site_url').'/wap.php?g=Wap&c=House&a=access_control_ask&village_id='.$_GET['village_id']
				);
				$share=new WechatShare($this->config,$_SESSION['openid'],$share_arr);
				$this->shareScript=$share->getSgin();
				$this->assign('shareScript',$this->shareScript);
				$this->display();
			}
		}
	}

	/* 我的钥匙展示（所有社区）
	* @time 2016-08-08
	* @author	小邓  <969101097@qq.com>*/
	public function control_show_ajax(){
		$condition_table=array(
			'pigcms_house_village'=>'village',
			'pigcms_access_control_group'=>'group',
			'pigcms_access_control'=>'control'
		);
		$condition_where='village.village_id=group.village_id and group.ag_id=control.ag_id and control.ac_status=1';
		$condition_field='village.village_id,village.village_name,village.lat,village.long,group.ag_name,control.ac_id,control.ag_id,control.ac_name,control.apikey,control.nodeid,control.sensorid';
		$access_control_result=M('')->table($condition_table)->where($condition_where)->field($condition_field)->select();
		$long_lat=D('User_long_lat')->getLocation($_SESSION['openid'],0);	//获取用户位置信息
		if($access_control_result && $long_lat){
			$rangeSort=array();
			foreach($access_control_result as &$village_value){
				$village_value['range_int']=getDistance($village_value['lat'],$village_value['long'],$long_lat['lat'],$long_lat['long']);//用户与社区距离
				$village_value['range']=getRange($village_value['range_int']);
				$rangeSort[]=$village_value['range_int'];
			}
			array_multisort($rangeSort,SORT_ASC,$access_control_result);//按距离近远排序
		}
		$new_arr=array();
		foreach($access_control_result as $key=>$val){
			$new_arr[$val['village_id']]['beforparent']=$val['village_name'];	//一级父级名称
			$new_arr[$val['village_id']]['range']=$val['range'];	//一级父级距离
			$new_arr[$val['village_id']]['beforchild'][$val['ag_id']]['afterparent']=$val['ag_name'];	//二级父级名称
			$new_arr[$val['village_id']]['beforchild'][$val['ag_id']]['afterchild'][]=$val;	//子级数组内容
		}
		$this->ajaxReturn(array('code_err'=>0,'code_msg'=>$new_arr));
	}

	/* 用户资料审核列表
	* @time 2016-08-20
	* @author	陈琦  <969101097@qq.com>*/
	public function village_control_check(){
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
		if(IS_AJAX){
			$check_info=M('login_user')->where(array('uid'=>$this->user_session['uid'],'village_id'=>$_POST['village_id']))->field('status,company_id')->find();
			$condition_table=array(C('DB_PREFIX').'House_village_user_bind'=>'n',C('DB_PREFIX').'user'=>'u',C('DB_PREFIX').'house_village'=>'v',C('DB_PREFIX').'company'=>'c');
			if($check_info['company_id']){
				$condition_where="n.ac_status>=1 and u.uid=n.uid and n.village_id=v.village_id and c.company_id=n.company_id and n.company_id=".$check_info['company_id']." and n.village_id=".$_POST['village_id'];
			}else{
				$condition_where="n.ac_status>=1 and u.uid=n.uid and n.village_id=v.village_id and c.company_id=n.company_id and n.village_id=".$_POST['village_id'];
			}
			$condition_field='n.*,u.nickname,c.company_name';
			$order='n.add_time DESC';
			$keyword = isset($_POST['keyword']) ? trim($_POST['keyword']) : '';
			if (!empty($keyword) || ($keyword == 0)) {
				$condition_where .= ' AND (n.name like "%' . $keyword . '%" OR c.company_name like "%' . $keyword . '%")';
			}
			$count = D('')->table($condition_table)->where($condition_where)->count();
			$pindex = intval(trim($_POST['pindex']));
			$pindex = $pindex > 0 ? $pindex : 1;
			$pagsize = 10;
			$offsize = ($pindex - 1) * 10;
			$check_list = D('')->table($condition_table)->field($condition_field)->where($condition_where)->order($order)->limit($offsize . ',' . $pagsize)->select();
			$hasmore = $count > ($pindex * $pagsize) ? 1 : 0;
			if (!empty($check_list)) {
				foreach ($check_list as $kk => $vv) {
					$check_list[$kk]['created'] = date('Y-m-d H:i:s', $vv['add_time']);
				}
			}
			$this->dexit(array('has_more' => $hasmore, 'list' => !empty($check_list) ? $check_list : array(), 'pindex' => $pindex));
		}else{
			$now_village=$this->get_village($_GET['village_id']);
			$check_info=M('login_user')->where(array('uid'=>$this->user_session['uid'],'village_id'=>$now_village['village_id']))->field('status,company_id')->find();
			if(!$check_info['status']){
				$this->redirect(U('House/village_my_bind',array('village_id'=>$now_village['village_id'])));
			}
			$this->display();
		}
	}
	/* 用户资料审核详细
	* @time 2016-06-24
	* @author	小邓  <969101097@qq.com>*/
	public function village_control_checkInfo(){
		//dump($this->user_session);exit;
		$now_village=$this->get_village($_GET['village_id']);
		if(IS_POST){
			//$find_name=M('house_village_user_bind')->where(array('pigcms_id'=>$_POST['id_val'],'ac_status'=>$_POST['ac_status']))->getField('name');
			$find_name=M('house_village_user_bind')->where(array('pigcms_id'=>$_POST['id_val'],'ac_status'=>array('in','2,3,4')))->getField('name');
			if($find_name){	//判断是否已通过或不通过
				echo json_encode(array('err_code'=>1,'code_msg'=>'当前资料已审核！'));
			}else{
				if(!empty($_POST['ac_desc'])){
					$data=array(
						'ac_status'=>$_POST['ac_status'],
						'ac_desc'=>$_POST['ac_desc']
					);
				}else{
					$data['ac_status']=$_POST['ac_status'];
				}
				if($this->user_session['truename']){
					$data['check_name']=$this->user_session['truename'];//手机端添加审核人名称，$this->user_session其实就是user表。user表中truename来自user_bind表中最新的name,若没提交资料则truename为空
				}else{
					$data['check_name']=$this->user_session['nickname'];
				}
				
			    $login_info=M('login_user')->where(array('village_id'=>$_GET['village_id'],'uid'=>$this->user_session['uid']))->find();
				if($login_info && !$login_info['company_id']){	//非公司管理员					
					$alter=M('house_village_user_bind')->where(array('pigcms_id'=>$_POST['id_val']))->data($data)->save();
					if($alter){
						echo json_encode(array('err_code'=>0,'code_msg'=>'通过或不通过成功'));
						if(intVal($_POST['ac_status'])==2){
							$first='您提交的门禁信息已通过审核！';
							$href=C('config.site_url').'/wap.php?c=House&a=village_access_finish&village_id='.$_GET['village_id'];
						}else{
							$first='您提交的门禁信息未通过审核！';
							$href=C('config.site_url').'/wap.php?c=House&a=village_access_next&village_id='.$_GET['village_id'];
						}												//消息推送
						$user_info=M('user')->where(array('uid'=>$_POST['uid_val']))->field('openid,truename,phone')->find();
						$model=new templateNews(C('config.wechat_appid'),C('config.wechat_appsecret'));
						$model->sendTempMsg('OPENTM201136105',array('href'=>$href,'wecha_id'=>$user_info['openid'],'first'=>$first,'keyword1'=>$user_info['truename'],'keyword2'=>$user_info['phone'],'keyword3'=>date('Y-m-d H:i:s')));
					}else{
						echo json_encode(array('err_code'=>1,'code_msg'=>'通过或不通过失败'));
					}
				}else{	//公司管理员
					if($login_info && $login_info['company_id']){
						$is_admin=M('company')->where(array('company_id'=>$login_info['company_id']))->getField('is_admin');
						if($is_admin==1){	//无须社区管理员二次审核
							$alter=M('house_village_user_bind')->where(array('pigcms_id'=>$_POST['id_val']))->data($data)->save();
							if($alter){
								echo json_encode(array('err_code'=>0,'code_msg'=>'通过或不通过成功'));
								if(intVal($_POST['ac_status'])==2){
									$first='您提交的门禁信息已通过审核！';
									$href=C('config.site_url').'/wap.php?c=House&a=village_access_finish&village_id='.$_GET['village_id'];
								}else{
									$first='您提交的门禁信息未通过审核！';
									$href=C('config.site_url').'/wap.php?c=House&a=village_access_next&village_id='.$_GET['village_id'];
								}												//消息推送
								$user_info=M('user')->where(array('uid'=>$_POST['uid_val']))->field('openid,truename,phone')->find();
								$model=new templateNews(C('config.wechat_appid'),C('config.wechat_appsecret'));
								$model->sendTempMsg('OPENTM201136105',array('href'=>$href,'wecha_id'=>$user_info['openid'],'first'=>$first,'keyword1'=>$user_info['truename'],'keyword2'=>$user_info['phone'],'keyword3'=>date('Y-m-d H:i:s')));
							}else{
								echo json_encode(array('err_code'=>1,'code_msg'=>'通过或不通过失败'));
							}
						}else{	//须社区管理员二次审核
							echo json_encode(array('err_code'=>1,'code_msg'=>'转交给社区管理员审核'));
							$time=time();		//审核信息推送
							$href=C('config.site_url').'/wap.php?c=House&a=village_control_checkInfo&village_id='.$_GET['village_id'].'&id_val='.$_POST['id_val'];
							$model=new templateNews(C('config.wechat_appid'),C('config.wechat_appsecret'));
							$role_arr=M('role')->where(array('menus'=>array('like','%29%')))->field('role_id')->select();
							$role_str='';
							foreach($role_arr as $value){
								$role_str.=$value['role_id'].',';	//以,拼接角色ID
							}
							$uid_arr=M('login_user')->field('uid')->where(array('role_id'=>array('in',trim($role_str,',')),'village_id'=>$_GET['village_id'],'status'=>1,'company_id'=>0))->select();
							if(!empty($uid_arr)){
								foreach($uid_arr as $val){
									$wecha_id=M('user')->where(array('uid'=>$val['uid']))->getField('openid');//获取user微信用户表中有权限29用户的openid，
									$model->sendTempMsg('OPENTM207145917',array('href'=>$href,'wecha_id'=>$wecha_id,'first'=>'您有一个待审核的信息！','keyword1'=>'智能门禁','keyword2'=>'管理员审核','keyword3'=>date('Y-m-d H:i:s')));
								}
							}
						}
					}									
				}
			}
		}else{
			$condition_table=array(C('DB_PREFIX').'house_village_user_bind'=>'v',C('DB_PREFIX').'company'=>'c',C('DB_PREFIX').'house_village'=>'a');
			$condition_where='v.company_id=c.company_id and v.village_id=a.village_id and v.pigcms_id='.$_GET['id_val'];
			$condition_field='v.*,c.company_name,a.village_name';
			$user_info=D('')->table($condition_table)->where($condition_where)->field($condition_field)->find();
			//dump($user_info);
			//$user_info=M('house_village_user_bind')->where(array('pigcms_id'=>$_GET['id_val']))->find();
			$this->assign('user_info',$user_info);
			$this->display();
		}
	}

	/* 用户资料审核删除
	* @time 2016-06-24
	* @author	小邓  <969101097@qq.com>*/
	public function village_control_checkdel(){
		$now_village=$this->get_village($_POST['village_id']);
		if(IS_POST){
			$pigcms_id=I('post.id_val');
			$del=M('House_village_user_bind')->where('pigcms_id='.$pigcms_id)->delete();
			if($del){
				//$this->success('删除成功！',U('House/village_control_check',array('village_id'=>$now_village['village_id'])));
				$this->dexit(array('error' => 0));
			}else{
				//$this->error('删除失败！请重试~');
				$this->dexit(array('error' => 1));
			}
		}
	}
	/* 在线报表
       @time 2016-07-14
       @author	陈琦  <849176855@qq.com>
	*/
	public function village_repair(){
		if(IS_AJAX){
			$condition_table  = array(C('DB_PREFIX').'house_village_repair_list'=>'r',C('DB_PREFIX').'house_village_user_bind'=>'b');
			$condition_where = " r.village_id = b.village_id  AND r.bind_id = b.pigcms_id AND r.type=1 AND r.village_id=".$_POST['village_id'] ;
			$condition_field = 'r.pigcms_id as pid,r.*,b.*';
			$order = ' r.pigcms_id DESC,r.is_read ASC ';
			$keyword = isset($_POST['keyword']) ? trim($_POST['keyword']) : '';
			if(!empty($keyword)||($keyword==0)){
				$condition_where.=' AND (b.usernum like "%' . $keyword . '%" OR b.name like "%' . $keyword . '%")';
			}
			$count = D('')->table($condition_table)->where($condition_where)->count();
			$pindex = intval(trim($_POST['pindex']));
			$pindex = $pindex > 0 ? $pindex : 1;
			$pagsize = 10;
			$offsize = ($pindex - 1) * 10;
			$repair_list = D('')->table($condition_table)->field($condition_field)->where($condition_where)->order($order)->limit($offsize . ',' . $pagsize)->select();
			$hasmore = $count > ($pindex * $pagsize) ? 1 : 0;
			if (!empty($repair_list)){
				foreach ($repair_list as $kk => $vv) {
					$repair_list[$kk]['created'] = date('Y-m-d H:i:s', $vv['time']);
				}
			}
			$this->dexit(array('has_more' => $hasmore, 'list' => !empty($repair_list) ? $repair_list : array(), 'pindex' => $pindex));
		}else{
			$now_village=$this->get_village($_GET['village_id']);
			$this->display();
		}
	}
	/* 在线报表详情
       @time 2016-07-14
       @author	陈琦  <849176855@qq.com>
	*/
	public function village_repairDetail(){
		$now_village=$this->get_village($_GET['village_id']);
		$pigcms_id=I('get.pigcms_id');
		//dump($pigcms_id);exit;
		$repair_info=D('VillageRepair')->getRepairInfo($now_village['village_id'],$pigcms_id);
		//dump($repair_info);exit;
		$this->assign('repair_info',$repair_info);
		$this->display();
	}
	/* 在线报表标记处理
       @time 2016-07-14
       @author	陈琦  <849176855@qq.com>
	*/
	public function do_repair(){
		if(IS_AJAX){
			$village_id=$_POST['village_id']?intval($_POST['village_id']):0;
			$cms_id=$_POST['cid']?intval($_POST['cid']):0;
			if($cms_id && $village_id){
				$data['village_id']=$village_id;
				$data['pigcms_id']=$cms_id;
				$result=D('House_village_repair_list')->where($data)->data(array('is_read'=>1))->save();
				if($result!==false){
					$this->ajaxReturn(array('error'=>0));
				}else{
					$this->ajaxReturn(array('msg'=>'处理失败请重试','error'=>1));
				}
			}else{
				$this->ajaxReturn(array('msg'=>'信息有误','error'=>1));
			}
		}
	}
	/* 用户开门记录列表
	* @time 2016-06-29
	* @author	陈琦  <849176855@qq.com>*/
	public function village_user_openLog(){
		if(IS_AJAX){
			$condition_table=array(
				'pigcms_access_control'=>'control',
				'pigcms_house_village_user_bind'=>'bind',
				'pigcms_access_control_user_log'=> 'Log.class',
				'pigcms_house_village'=>'village',
				'pigcms_company'=>'company'
			);
			$check_info=M('login_user')->where(array('uid'=>$this->user_session['uid'],'village_id'=>$_POST['village_id']))->field('status,company_id')->find();
			if ($check_info['company_id']) {
				$condition_where = 'log.ac_id=control.ac_id and log.pigcms_id=bind.pigcms_id and company.company_id=bind.company_id and bind.company_id='.$check_info['company_id'].' and log.village_id=village.village_id and log.village_id=' . $_POST['village_id'];
			}else{
				$condition_where = 'log.ac_id=control.ac_id and log.pigcms_id=bind.pigcms_id and log.village_id=village.village_id and company.company_id=bind.company_id and log.village_id=' . $_POST['village_id'];
			}
			$condition_field = 'control.ac_name,control.village_id,card_type,bind.usernum,bind.name,bind.company,log.log_id,log.opdate,village.village_name,bind.company_id,company.company_id';
			$order = 'log.opdate desc ';
			$keyword = isset($_POST['keyword']) ? trim($_POST['keyword']) : '';
			if (!empty($keyword) || ($keyword == 0)) {
				$condition_where .= ' AND (bind.name like "%' . $keyword . '%" OR bind.usernum like "%' . $keyword . '%")';
			}
			$count = D('')->table($condition_table)->where($condition_where)->count();
			$pindex = intval(trim($_POST['pindex']));
			$pindex = $pindex > 0 ? $pindex : 1;
			$pagsize = 10;
			$offsize = ($pindex - 1) * 10;
			$group_list = D('')->table($condition_table)->field($condition_field)->where($condition_where)->order($order)->limit($offsize . ',' . $pagsize)->select();
			$hasmore = $count > ($pindex * $pagsize) ? 1 : 0;
			if (!empty($group_list)) {
				foreach ($group_list as $kk => $vv) {
					$group_list[$kk]['created'] = date('Y-m-d H:i:s', $vv['opdate']);
				}
			}
			$this->dexit(array('has_more' => $hasmore,'list' => !empty($group_list) ? $group_list : array(), 'pindex' => $pindex));
		}else{
			$now_village=$this->get_village($_GET['village_id']);
			$check_info=M('login_user')->where(array('uid'=>$this->user_session['uid'],'village_id'=>$now_village['village_id']))->field('status,company_id')->find();
			if(!$check_info['status']){
				$this->redirect(U('House/village_my_bind',array('village_id'=>$now_village['village_id'])));
			}
			$this->display();
		}
	}
	/* 用户开门记录详情
	* @time 2016-06-29
	* @author	陈琦  <849176855@qq.com>*/
	public function village_user_openDetail(){
		$now_village=$this->get_village($_GET['village_id']);
		$log_id=I('get.log_id');
		$get_log_info=D('AccessControlLog')->getLoginfo($log_id);
		$this->assign('log_info',$get_log_info);
		$this->display();
	}
	
	/* 访客登记信息
        * @time 2016-08-22
        * @author	陈琦  <849176855@qq.com>*/
	public function village_visitorLog(){
		if(IS_AJAX){
			$condition_table=array(
				'pigcms_house_village_user_bind'=>'bind',
				'pigcms_house_village'=>'village',
			);
			$condition_where ='bind.village_id=village.village_id and bind.role=2 and bind.village_id='.$_POST['village_id'];
			$condition_field = 'bind.name,bind.add_time,bind.company,bind.pigcms_id,bind.village_id,village.village_name';
			$order = 'bind.add_time desc ';
			$keyword = isset($_POST['keyword']) ? trim($_POST['keyword']) : '';
			if (!empty($keyword) || ($keyword == 0)) {
				$condition_where .= ' AND (bind.name like "%' . $keyword . '%")';
			}
			$count = D('')->table($condition_table)->where($condition_where)->count();
			$pindex = intval(trim($_POST['pindex']));
			$pindex = $pindex > 0 ? $pindex : 1;
			$pagsize = 10;
			$offsize = ($pindex - 1) * 10;
			$group_list = D('')->table($condition_table)->field($condition_field)->where($condition_where)->order($order)->limit($offsize . ',' . $pagsize)->select();
			$hasmore = $count > ($pindex * $pagsize) ? 1 : 0;
			if (!empty($group_list)) {
				foreach ($group_list as $kk => $vv) {
					$group_list[$kk]['created'] = date('Y-m-d H:i:s', $vv['add_time']);
				}
			}
			$this->dexit(array('has_more' => $hasmore,'list' => !empty($group_list) ? $group_list : array(), 'pindex' => $pindex));
		}else{
			$now_village=$this->get_village($_GET['village_id']);
			$this->display();
		}
	}

	/* 访客登记详情
	* @time 2016-08-22
	* @author	陈琦  <849176855@qq.com>*/
	public function village_visitorLog_detail(){
		$now_village=$this->get_village($_GET['village_id']);
		$pigcms_id = $_GET['pigcms_id'];
		if($pigcms_id){
			$condition_table = array(C('DB_PREFIX') . 'House_village_user_bind' => 'n',C('DB_PREFIX').'user'=>'u',C('DB_PREFIX').'house_village'=>'v') ;
			$condition_where="u.uid=n.uid and n.village_id=v.village_id and n.role=2 and n.pigcms_id=".$pigcms_id;
			$condition_field = 'n.*,u.nickname';
			$visitor_info=D('')->table($condition_table)->where($condition_where)->field($condition_field)->find();
			//dump($visitor_info);exit;
			$this->assign('visitor_info',$visitor_info);

		}
		$this->display();
	}

	/* 新闻评论
	* @time 2016-07-15
	* @author	陈琦  <849176855@qq.com>*/
	public function village_newsReply(){
		$now_village=$this->get_village($_GET['village_id']);
		$condition_table  = array(C('DB_PREFIX').'house_village_news'=>'n',C('DB_PREFIX').'house_village_news_category'=>'c',C('DB_PREFIX').'house_village_news_reply'=>'r',C('DB_PREFIX').'user'=>'u');
		$condition_where = " n.village_id = r.village_id  AND n.village_id = c.village_id  AND n.news_id = r.news_id  AND r.uid = u.uid AND  n.cat_id = c.cat_id AND c.cat_status=1  AND n.village_id=".$_GET['village_id'];
		$condition_field = 'n.title,c.cat_name,r.*,u.nickname';
		$order='r.add_time DESC';
		$reply_list = D('')->field($condition_field)->table($condition_table)->where($condition_where)->order($order)->select();
		$this->assign('reply_list',$reply_list);
		$this->display();
	}
	public function village_suggest(){
		if(IS_AJAX){
			$condition_table  = array(C('DB_PREFIX').'house_village_repair_list'=>'r',C('DB_PREFIX').'house_village_user_bind'=>'b');
			$condition_where = " r.village_id = b.village_id  AND r.bind_id = b.pigcms_id AND r.type=3 AND r.village_id=".$_POST['village_id'] ;
			$condition_field = 'r.pigcms_id as pid,r.*,b.*';
			$order = ' r.pigcms_id DESC,r.is_read ASC ';
			$keyword = isset($_POST['keyword']) ? trim($_POST['keyword']) : '';
			if(!empty($keyword)||($keyword==0)){
				$condition_where.=' AND (b.usernum like "%' . $keyword . '%" OR b.name like "%' . $keyword . '%")';
			}
			$count = D('')->table($condition_table)->where($condition_where)->count();
			$pindex = intval(trim($_POST['pindex']));
			$pindex = $pindex > 0 ? $pindex : 1;
			$pagsize = 10;
			$offsize = ($pindex - 1) * 10;
			$repair_list = D('')->table($condition_table)->field($condition_field)->where($condition_where)->order($order)->limit($offsize . ',' . $pagsize)->select();
			$hasmore = $count > ($pindex * $pagsize) ? 1 : 0;
			if (!empty($repair_list)){
				foreach ($repair_list as $kk => $vv) {
					$repair_list[$kk]['created'] = date('Y-m-d H:i:s', $vv['time']);
				}
			}
			$this->dexit(array('has_more' => $hasmore,'list' => !empty($repair_list) ? $repair_list : array(), 'pindex' => $pindex));
		}else{
			$now_village=$this->get_village($_GET['village_id']);
			$this->display();
		}


	}
	public function do_suggest(){
		if(IS_AJAX){
			$village_id=$_POST['village_id']?intval($_POST['village_id']):0;
			$cms_id=$_POST['cid']?intval($_POST['cid']):0;
			if($cms_id && $village_id){
				$data['village_id']=$village_id;
				$data['pigcms_id']=$cms_id;
				$result=D('House_village_repair_list')->where($data)->data(array('is_read'=>1))->save();
				if($result!==false){
					$this->ajaxReturn(array('error'=>0));
				}else{
					$this->ajaxReturn(array('msg'=>'处理失败请重试','error'=>1));
				}
			}else{
				$this->ajaxReturn(array('msg'=>'信息有误','error'=>1));
			}
		}
	}
	public function village_suggestDetail(){
		$now_village=$this->get_village($_GET['village_id']);
		$pigcms_id=I('get.pigcms_id');
		//dump($pigcms_id);exit;
		$suggest_info=D('VillageRepair')->getSuggestInfo($now_village['village_id'],$pigcms_id);
		//dump($repair_info);exit;
		$this->assign('suggest_info',$suggest_info);
		$this->display();
	}

	/* 开门申请选择
	* @time 2016-06-30
	* @author	小邓  <969101097@qq.com>*/
	public function access_control_change(){
		$now_village=$this->get_village($_GET['village_id']);
		if(empty($this->user_session)){	//判断是否已登录
			redirect(U('Wap/Login/weixin',array('referer'=>urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']))));
		}else{
			if($_GET['control'] && $_GET['control']=='key'){
				$this->assign('control',$_GET['control']);
			}
			if(!empty($_GET['ac_id'])){	//判断是否是扫设备码进入
				$this->assign('ac_id',$_GET['ac_id']);
				if(!empty($this->user_session)){	//判断是否获取到当前用户
					$dateline=M('user_long_lat')->where(array('open_id'=>$this->user_session['openid']))->getField('dateline');
					if(empty($dateline) || ($dateline && time()-$dateline>5*60)){
						$signa_arr=unserialize($this->getSigna(D('Access_token_expires')->get_access_token()['access_token']));
						$signa_arr['appid']=$this->config['wechat_appid'];
						$this->assign('signa_arr',$signa_arr);	//微信定位所须参数
					}
				}
			}
			$user_info=M('house_village_user_bind')->where(array('uid'=>$this->user_session['uid'],'village_id'=>$_GET['village_id']))->find();
			if(!$user_info){	//判断是否已存在
				$this->display();
			}else{
				if($user_info['role']<=1 || $user_info['role']==""){	//业主身份
					if($user_info['ac_status']==1 || $user_info['ac_status']==3){	//是业主且已提交智能门禁审核但没得到认可时
						if($_GET['control'] && $_GET['control']=='key'){	//判断是否是我的钥匙
							$this->redirect('你提交的资料正在审核中或审核未通过',U('House/village_access_next',array('village_id'=>$_GET['village_id'])));
						}else{
							$this->redirect(U('House/village',array('village_id'=>$_GET['village_id'])));
						}
					}else if(empty($user_info['ac_status'])){	//是业主但没有提交智能门禁审核
						if($_GET['control'] && $_GET['control']=='key'){	//判断是否是我的钥匙
							$this->redirect('请提交智能门禁资料审核',U('House/village_access_control',array('village_id'=>$_GET['village_id'])));
						}else{
							$this->redirect(U('House/village',array('village_id'=>$_GET['village_id'])));
						}
					}else{	//门禁展示页面
						if($_GET['control'] && $_GET['control']=='key'){	//判断是否是我的钥匙							
							$this->redirect(U('House/village_access_show',array('village_id'=>$_GET['village_id'])));
						}else{
							$this->redirect(U('House/village',array('village_id'=>$_GET['village_id'])));
						}
					}
				}else{							//临时访客身份
					if(time()-$user_info['last_time']>24*60*60){	//访客上次提交的审核资料超过24小时
						$this->display();
					}else{	//访客扫码提示页面
						$this->redirect(U('House/noticeKid',array('village_id'=>$_GET['village_id'])));
					}
				}
			}
		}
	}

	/* 访客开门申请
	* @time 2016-06-28
	* @author	小邓  <969101097@qq.com>*/
	public function access_control_ask(){
		$now_village=$this->get_village($_GET['village_id']);
		if(empty($this->user_session)){	//判断是否已登录
			redirect(U('Wap/Login/weixin',array('referer'=>urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']))));
		}else{
			$where_data=array(
				'uid'=>$this->user_session['uid'],
				'role'=>2,
				'village_id'=>$_GET['village_id']
			);
			if(IS_POST){
				if(empty($_POST['truename'])){
					$this->check_ajax_error_tips('请填写真实姓名');
				}else{
					$_POST['name']=$_POST['truename'];
					unset($_POST['truename']);
				}
				if(empty($_POST['phone'])){
					$this->check_ajax_error_tips('请填写手机号码');
				}
				if(empty($_POST['company'])){
					$this->check_ajax_error_tips('请填写公司名');
				}
				if(empty($_POST['id_card'])){
					$this->check_ajax_error_tips('请填写身份证号码');
				}
				$phone=M('house_village_user_bind')->where(array('uid'=>array('neq',$this->user_session['uid']),'village_id'=>$_GET['village_id'],'phone'=>$_POST['phone']))->getField('phone');
				if($phone==$_POST['phone']){	//判断非本人时此手机号码是否存在
					header('Content-type: application/json');
					echo json_encode(array('code_error'=>1,'code_msg'=>'此手机号码已存在请重新填写'));
					exit;
				}
				$addtime=M('user_modifypwd')->where(array('telphone'=>$_POST['phone'],'vfcode'=>$_POST['vcode']))->order('addtime desc')->getField('addtime');
				if(!$addtime || (time()-$addtime>20*60)){	//判断验证码是否存在或过期
					header('Content-type: application/json');
					echo json_encode(array('err_code'=>2,'code_msg'=>'此验证码已过期或错误，请重新输入'));
					exit;
				}
				$village_bind_name=M('house_village_user_bind')->where($where_data)->getField('name');
				if($village_bind_name){	//判断是否已存在
					$_POST['last_time']=time();	//修改时间
					$village_bind=M('house_village_user_bind')->where($where_data)->data($_POST)->save();
				}else{					//首次访问
					$_POST['uid']=$this->user_session['uid'];
					$_POST['village_id']=$_GET['village_id'];	//社区ID
					$_POST['role']=2;	//表示加入了智能门禁(访客)
					$_POST['add_time']=time();	//初始化时间
					$_POST['last_time']=time();	//初始化时间
					$village_bind=M('house_village_user_bind')->data($_POST)->add();
				}
				if($village_bind){
					M('user')->where(array('uid'=>$this->user_session['uid']))->data(array('truename'=>$_POST['name'],'phone'=>$_POST['phone']))->save();	//修改用户表
					header('Content-type: application/json');
					if(!empty($_GET['ac_id'])){	//判断是否已扫过设备码
						//echo json_encode(array('err_code'=>0,'code_msg'=>'你已取得访问权限，可以开门啦!'));	//提交成功
						$control_info=M('access_control')->where(array('ac_id'=>$_GET['ac_id']))->field('nodeid,sensorid')->find();
						$this->access_control_operat_ajax($village_id=$_GET['village_id'],$ac_id=$_GET['ac_id'],$nodeid=$control_info['nodeid'],$sensorid=$control_info['sensorid']);
					}else{
						echo json_encode(array('err_code'=>0,'code_msg'=>'你已取得访问权限，请扫设备二维码开门!'));	//提交成功
					}
				}else{
					header('Content-type: application/json');
					echo json_encode(array('err_code'=>1,'code_msg'=>'提交失败，请重试'));	//提交失败
				}
			}else{
				$user_info=M('house_village_user_bind')->where($where_data)->field(array('name,phone,company,id_card'))->find();
				$this->assign('user_info',$user_info);
				$this->assign('ac_id',$_GET['ac_id']);	//设备ID
				$this->display();
			}
		}
	}

	/* 设备二维码开门
	* @time 2016-06-29
	* @author	小邓  <969101097@qq.com>*/
	public function access_control_open2(){
		$now_village=$this->get_village($_GET['village_id']);
		if(empty($this->user_session)){	//判断是否已登录
			redirect(U('Wap/Login/weixin',array('referer'=>urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']))));
		}else{
			$where_data=array(
				'uid'=>$this->user_session['uid'],
				'village_id'=>$_GET['village_id']	//社区ID
			);
			$user_info=M('house_village_user_bind')->where($where_data)->find();
			if(!$user_info){	//判断是否已存在
				$this->redirect('请选择身份',U('House/access_control_change',array('village_id'=>$_GET['village_id'],'ac_id'=>$_GET['ac_id'],'control'=>'key')));
			}else{
				if($user_info['role']<=1 || $user_info['role']==""){	//业主身份
					import('ORG.Net.Http');
					$http=new Http();
					$access_token=D('Access_token_expires')->get_access_token()['access_token'];
					$return=$http->curlGet('https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$access_token.'&openid='.$this->user_session['openid'].'&lang=zh_CN');
					$jsonrt=json_decode($return,true);
					if($jsonrt && $jsonrt['subscribe']){	//判断是否已关注
						if($user_info['ac_status']==1 || $user_info['ac_status']==3){	//是业主且已提交智能门禁审核但没得到认可时
							$this->redirect(U('House/access_control_show',array('village_id'=>$_GET['village_id'],'msg'=>'你提交的资料正在审核中或审核未通过！','url'=>'House/village_access_next')));
						}else if(empty($user_info['ac_status'])){	//是业主但没有提交智能门禁审核
							$this->redirect(U('House/access_control_show',array('village_id'=>$_GET['village_id'],'msg'=>'请提交智能门禁资料审核','url'=>'House/village_access_control')));
						}else{	//开门操作
							$control_info=M('access_control')->where(array('ac_id'=>$_GET['ac_id']))->field('nodeid,sensorid')->find();
							$this->redirect(U('House/access_control_operat', array('village_id' => $_GET['village_id'], 'ac_id' => $_GET['ac_id'], 'nodeid' => $control_info['nodeid'], 'sensorid' => $control_info['sensorid'])));
						}
					}else{
						$this->redirect(U('House/access_control_show',array('village_id'=>$_GET['village_id'],'msg'=>'请先关注汇得行智慧助手公众号后使用微信开门功能！')));
					}
				}else{							//临时访客身份
					if(time()-$user_info['last_time']>24*60*60){	//访客上次提交的审核资料超过24小时				
						$this->redirect('请重新选择身份',U('House/access_control_change',array('village_id'=>$_GET['village_id'],'ac_id'=>$_GET['ac_id'],'control'=>'key')));
					}else{	//开门操作
						$control_info=M('access_control')->where(array('ac_id'=>$_GET['ac_id']))->field('nodeid,sensorid')->find();
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
		}else{
			//import('ORG.Net.Http');
			//$http = new Http();
			//$access_token = D('Access_token_expires')->get_access_token()['access_token'];
			//$return = $http->curlGet('https://api.weixin.qq.com/cgi-bin/user/info?access_token=' . $access_token . '&openid=' . $this->user_session['openid'] . '&lang=zh_CN');
			//$jsonrt = json_decode($return, true);
			//if ($jsonrt && $jsonrt['subscribe']) {    //判断是否已关注
				$where_data = array(
					'uid' => $this->user_session['uid'],
					'village_id' => $_GET['village_id']    //社区ID
				);
				$user_info = M('house_village_user_bind')->where($where_data)->find();
				if (!$user_info) {    //判断是否已存在
					//dump(2);exit;
					$this->redirect('请选择身份', U('House/access_control_change', array('village_id' => $_GET['village_id'], 'ac_id' => $_GET['ac_id'], 'control' => 'key')));
				} else {
					if ($user_info['role'] <= 1 || $user_info['role'] == "") {    //业主身份
						if ($user_info['ac_status'] == 1 || $user_info['ac_status'] == 3) {    //是业主且已提交智能门禁审核但没得到认可时
							$this->redirect(U('House/access_control_show', array('village_id' => $_GET['village_id'], 'msg' => '你提交的资料正在审核中或审核未通过！', 'url' => 'House/village_access_next')));
						} else {    //开门操作
							$control_info = M('access_control')->where(array('ac_id' => $_GET['ac_id']))->field('nodeid,sensorid')->find();
							$this->redirect(U('House/access_control_operat', array('village_id' => $_GET['village_id'], 'ac_id' => $_GET['ac_id'], 'nodeid' => $control_info['nodeid'], 'sensorid' => $control_info['sensorid'])));
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
				
				
			
			
			
			
			
			
			

	/* 开门操作
	* ac_id	设备ID
	* nodeid	节点ID
	* sensorid	传感器ID
	* @time 2016-06-29
	* @author	小邓  <969101097@qq.com>*/
	public function access_control_operat($village_id='',$ac_id='',$nodeid='',$sensorid=''){
		$where_data=array(
			'uid'=>$this->user_session['uid'],
			'village_id'=>$village_id,	//社区ID
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
		$pigcms_id=M('house_village_user_bind')->where($where_data)->getField('pigcms_id');
		$add_data=array(
			'pigcms_id'=>$pigcms_id,
			'ac_id'=>$ac_id,	//开关ID
			'village_id'=>$village_id,	//社区ID
			'opdate'=>time()//开门时间
		);

			import('@.ORG.Yeelink');
			$yeelink=new Yeelink($apikey='b11cb20c2903230a0463fdc6ce337e2d',$deviceid=$nodeid);
			$connect = new Memcached;  //声明一个新的memcached链接
			$connect->setOption(Memcached::OPT_COMPRESSION, false); //关闭压缩功能
			$connect->setOption(Memcached::OPT_BINARY_PROTOCOL, true); //使用binary二进制协议
			$connect->addServer('f120e580f9b74ec5.m.cnhzaliqshpub001.ocs.aliyuncs.com', 11211); //添加OCS实例地址及端口号

       /*     header("Location: http://car.vhi99.com/?m=Home&c=Payrecord&a=problem");
		exit();*/
            if($yeelink->getStatus($sensorid)){	//判断开关是否已开
				//echo json_encode(array('err_code'=>2,'code_msg'=>'门已开，请直接进入！'));
				$this->redirect(U('House/access_control_show',array('village_id'=>$village_id,'ac_id'=>$ac_id,'msg'=>'门已开，请直接进入！')));
				if($connect->get('arr_key')){					//修改对应设备开启时间
					$arr_key=unserialize($connect->get('arr_key'));
					$new_arr=array();
					foreach($arr_key as $key=>$val){
						$new_arr[$key]=$val;
						if($val['ac_id']==$ac_id){
							$new_arr[$key]['datetime']=time();
						}
					}
					$connect->set('arr_key',serialize($new_arr));	//修改
				}
			}else{
				$status_data=$yeelink->yeelink($sensorid,$status=1);	//触发开关开
				if($status_data==""&&$status_data!==false){
					//var_dump($status_data);exit;
					$control_log=M('access_control_user_log')->data($add_data)->add();
					M('house_village_user_bind')->where($where_data)->data(array('last_time'=>time()))->save();	//修改时间
					//echo json_encode(array('err_code'=>0,'code_msg'=>'开门成功'));
					$this->redirect(U('House/access_control_show',array('village_id'=>$village_id,'ac_id'=>$ac_id,'msg'=>'开门成功')));
					$add_arr=array(
						'ac_id'=>$ac_id,
						'apikey'=>'b11cb20c2903230a0463fdc6ce337e2d',
						'nodeid'=>$nodeid,
						'sensorid'=>$sensorid,
						'datetime'=>time()
					);
					if($connect->get('arr_key')){	//判断是否是首次触发
						$arr_key=unserialize($connect->get('arr_key'));
						$new_arr=array();
						foreach($arr_key as $key=>$val){
							$new_arr[$key]=$val;
							if($val['ac_id']==$ac_id){
								$new_arr[$key]['datetime']=time();
								$new_upd=true;	//修改标示
							}
						}
						if($new_upd){
							$connect->set('arr_key',serialize($new_arr));//修改
						}else{
							array_push($arr_key,$add_arr);				//追加
							$connect->set('arr_key',serialize($arr_key));
						}
					}else{
						$arr_key=array($add_arr);					//首次添加
						$connect->set('arr_key',serialize($arr_key));
					}
				}else{
					header("Location: http://car.vhi99.com/?m=Home&c=Payrecord&a=problem");
					//echo json_encode(array('err_code'=>1,'code_msg'=>'操作过于频繁,请稍后再试!'));
					//$this->redirect(U('House/access_control_show_old',array('village_id'=>$village_id,'ac_id'=>$ac_id,'msg'=>'操作过于频繁,请稍后再试!')));
				}
			}
			
			$connect->quit();//重新存入
		/*$control_log=M('access_control_user_log')->data($add_data)->add();*/
		if(!$control_log) {
			//echo json_encode(array('err_code'=>1,'code_msg'=>'记录失败'));
			header("Location: http://car.vhi99.com/?m=Home&c=Payrecord&a=problem");
			//$this->redirect(U('House/access_control_show_old', array('village_id' => $village_id, 'ac_id' => $ac_id, 'msg' => '记录失败')));
		}
	}

	/*门禁未能开门报错页面
	 *
	 * */
	public function access_control_show_old(){
		$this->display();
	}

	/* 开门操作(须访客提交资料后)
	* ac_id	设备ID
	* nodeid	节点ID
	* sensorid	传感器ID
	* @time 2016-08-10
	* @author	小邓  <969101097@qq.com>*/
	public function access_control_operat_ajax($village_id='',$ac_id='',$nodeid='',$sensorid=''){
		$where_data=array(
			'uid'=>$this->user_session['uid'],
			'village_id'=>$village_id,	//社区ID
		);
		import('@.ORG.longlat');
		$longlat_class = new longlat();
		$user_long_lat=D('User_long_lat')->getLocation($_SESSION['openid'],0);	//获取用户位置信息
		$user_location=$longlat_class->gpsToBaidu($user_long_lat['lat'], $user_long_lat['long']);
		$village_long_lat=M('house_village')->where(array('village_id' =>$village_id))->find();
		$village_location=$longlat_class->gpsToBaidu($village_long_lat['lat'], $village_long_lat['long']);
		$get_distance=GetDistance($user_location['lat'],$user_location['long'],$village_location['lat'],$village_location['long']);
		/*if($get_distance>1000){	//判断是否在社区范围之内
			echo json_encode(array('err_code'=>2,'code_msg'=>'您当前位置不在写字楼附近，无法开门！'));
			exit;
		}*/
		$pigcms_id=M('house_village_user_bind')->where($where_data)->getField('pigcms_id');
		$add_data=array(
			'pigcms_id'=>$pigcms_id,
			'ac_id'=>$ac_id,	//开关ID
			'village_id'=>$village_id,	//社区ID
			'opdate'=>time()//开门时间
		);
		$control_log=M('access_control_user_log')->data($add_data)->add();
		if($control_log){
			import('@.ORG.Yeelink');
			$yeelink=new Yeelink($apikey='b11cb20c2903230a0463fdc6ce337e2d',$deviceid=$nodeid);
			$connect = new Memcached;  //声明一个新的memcached链接
			$connect->setOption(Memcached::OPT_COMPRESSION, false); //关闭压缩功能
			$connect->setOption(Memcached::OPT_BINARY_PROTOCOL, true); //使用binary二进制协议
			$connect->addServer('f120e580f9b74ec5.m.cnhzaliqshpub001.ocs.aliyuncs.com', 11211); //添加OCS实例地址及端口号
			if($yeelink->getStatus($sensorid)){	//判断开关是否已开
				echo json_encode(array('err_code'=>2,'code_msg'=>'门已开，请直接进入！'));
				if($connect->get('arr_key')){					//修改对应设备开启时间
					$arr_key=unserialize($connect->get('arr_key'));
					$new_arr=array();
					foreach($arr_key as $key=>$val){
						$new_arr[$key]=$val;
						if($val['ac_id']==$ac_id){
							$new_arr[$key]['datetime']=time();
						}
					}
					$connect->set('arr_key',serialize($new_arr));	//修改
				}
			}else{
				$status_data=$yeelink->yeelink($sensorid,$status=1);	//触发开关开
				if($status_data==""){
					echo json_encode(array('err_code'=>0,'code_msg'=>'开门成功'));
					$add_arr=array(
						'ac_id'=>$ac_id,
						'apikey'=>'b11cb20c2903230a0463fdc6ce337e2d',
						'nodeid'=>$nodeid,
						'sensorid'=>$sensorid,
						'datetime'=>time()
					);
					if($connect->get('arr_key')){	//判断是否是首次触发
						$arr_key=unserialize($connect->get('arr_key'));
						$new_arr=array();
						foreach($arr_key as $key=>$val){
							$new_arr[$key]=$val;
							if($val['ac_id']==$ac_id){
								$new_arr[$key]['datetime']=time();
								$new_upd=true;	//修改标示
							}
						}
						if($new_upd){
							$connect->set('arr_key',serialize($new_arr));//修改
						}else{
							array_push($arr_key,$add_arr);				//追加
							$connect->set('arr_key',serialize($arr_key));
						}
					}else{
						$arr_key=array($add_arr);					//首次添加
						$connect->set('arr_key',serialize($arr_key));
					}
				}else{
					echo json_encode(array('err_code'=>1,'code_msg'=>'操作过于频繁,请稍后再试!'));
				}
			}
			$connect->quit();
			//重新存入
		}else{
			echo json_encode(array('err_code'=>1,'code_msg'=>'记录失败'));
		}
	}

	/* 设备二维码扫码开门提示
        * @time 2016-06-28
        * @author	小邓  <969101097@qq.com>
         * 修改于2016.11.17(平时开门)
         * 修改于2016.12.9(圣诞活动)
         * */
	public function access_control_show(){
		if($_GET['village_id'] == 3){
			$this->display("House/access_control_show_pufa");
		}else{
			$uid = $this->user_session['uid'];
			$recordOb = M('Extension_activity_record');
			$record_result =$recordOb->where(array('uid'=>$uid,'activity_id'=>5))->find();
			if($record_result){
				//设置查询的变量
				$condition_where_pastgift = "record.pigcms_id=coupon.record_id and record.uid=$uid and record.activity_id=5";
				$condition_table_pastgift = array(
					'pigcms_extension_activity_record'=>'record',
					'pigcms_extension_coupon_record'=>'coupon'
				);
				$order = "record.time desc";
				$condition_field_pastgift = "coupon.record_id,record.giftname,record.time,coupon.plate,coupon.number";
				$pastgift_result = D('')->table($condition_table_pastgift)->field($condition_field_pastgift)->where($condition_where_pastgift)->order($order)->limit(3)->select();

				//var_dump($re_id);exit;
				$listTd = $this->get_coupon_list($pastgift_result);
				$this->assign('rc_result',$pastgift_result[0]['record_id']);
				$this->assign('listTd',$listTd);//$re_id
				$this->display("House/access_control_show_new");
			}else{
				//对进门的用户进行判断
				//用户没有抽过奖
				//在数据库里面读出相应的活动数据配置
				//2016.12.27 00:00:00 活动上线
				//2016.12.30 00:00:00 活动下线
				$show_time = time();
				if($show_time>1483027200){
					$this->display("House/access_control_show_done");
				}else{
					$activtyOb = M("Extension_activity");
					$gift_str_array= $activtyOb->where(array("activity_id"=>5))->find();
					$gift_str = $gift_str_array['gift'];
					$gift_sum = $gift_str_array['probability'];
					$gift_type = $gift_str_array['gifttype'];
					//调用随机算法，获取中奖项目
					$gift_name = $this->randomGift($gift_str,$gift_sum);
					$this->assign("gift",$gift_name);
					$recordOb = M('Extension_activity_record');
					$record_array= array(
						'activity_id'=>5,
						'time'=>time(),
						'uid'=>$this->user_session['uid'],
						'part_count'=>'1',
						'giftname'=>$gift_name
					);
					//将抽到的奖励名称添加到数据库中
					$rc_result =$recordOb->data($record_array)->add();
					$this->assign("rc_result",$rc_result);
					//根据抽到的奖励调用相应的接口
					$postion ='';
					$gift_array = explode(",",$gift_str);
					foreach ($gift_array as $key=>$value){
						if($gift_name == $value){
							$postion = $key;
						}
					}
					$gift_type_array = explode(",",$gift_type);
					$gift_type_number = $gift_type_array[$postion];
					if($gift_type_number == 1){

						//提示信息
						$message = '赶快到公众号对话框中领取吧！';
						$note = '确定';
						$this->assign("message",$message);
						$this->assign("note",$note);
					}else if($gift_type_number == 2){

						//提示信息
						$message = '赶快去食堂使用吧！';
						$note = '确定';
						$this->assign("message",$message);
						$this->assign("note",$note);
					}else if($gift_type_number == 3){

						//提示信息
						$message = '快去使用停车优惠吧';
						$note = '确定';
						$this->assign("message",$message);
						$this->assign("note",$note);
						//根据类型不同传递参数
						$this->assign("state",1);
					}else{
						//其他类别
						//提示信息
						$message = '您真是太幸运了';
						$note = '确定';
						$this->assign("message",$message);
						$this->assign("note",$note);
					}
					$this->display("House/access_control_show");
				}
			}

		}
	}

	/*根据前台获得的奖品类型在后台选择调用接口
	 * @time 2016.12.20
	 *@author 祝君伟
	 * */
	function get_gift_port($gift_name,$rc_result){
		if($gift_name == '现金红包'){
			//现金红包类接口  1
			$res = $this->wechatCash();
			//将抽到的金额入库
			$couponOb = M('Extension_coupon_record');
			$coupon_array= array(
				'activity_id'=>5,
				'record_id'=>$rc_result,
				'number'=>$res['total_amount']
			);
			//将抽到的奖励名称添加到数据库中
			$couponOb->data($coupon_array)->add();

		}else if($gift_name == '大头仔现金券'){
			//现金优惠券类  2
			$res = $this->wechatCoupon();
			$coupon_id = isset($res['coupon_id'])?$res['coupon_id']:'';
			//将抽到的金额入库
			$couponOb = M('Extension_coupon_record');
			$coupon_array= array(
				'activity_id'=>5,
				'record_id'=>$rc_result,
				'number'=>$coupon_id
			);
			//将抽到的奖励添加到数据库中
			$couponOb->data($coupon_array)->add();

		}else if($gift_name == '停车优惠券'){
			//停车优惠券类  3
			//一开始领取时没有使用优惠券
			$couponOb = M('Extension_coupon_record');
			$coupon_array= array(
				'activity_id'=>5,
				'record_id'=>$rc_result,
				'plate'=>''
			);
			//将抽到的奖励添加到数据库中
			$couponOb->data($coupon_array)->add();

		}else{
			//其他类别
			//提示信息
		}
	}
	/*调用微信现金红包
	 * @time 2016.12.9
	 * @author 祝君伟
	 * @接口提供 陈琦
	 * */
	public function wechatCash(){
		//证书路径
		$apiclient_cert=getcwd().'/conf/cert/apiclient_cert.pem';
		$apiclient_key=getcwd().'/conf/cert/apiclient_key.pem';
		$rootca=getcwd().'/conf/cert/rootca.pem';
		$money= rand(100,500);
		$arr['mch_id']='1327750001';
		$url="https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack";
		$arr['mch_billno']=$arr['mch_id'].date('YmdHis').rand(1000,9999);
		$arr['nick_name']='汇得行';
		$arr['send_name']='扫码开门';
		$arr['re_openid']=$_SESSION['user']['openid'];
		$arr['total_amount']=$money;
		$arr['total_num']='1';//普通红包个数只能为1
		$arr['wishing']='汇得行祝福您新年快乐！';
		$arr['act_name']='新年活动';
		$arr['remark']='新年快乐！';
		$arr['wxappid']='wx49b9dbe4f861f4f8';
		$arr['client_ip']=$_SERVER['REMOTE_ADDR'];
		import('@.ORG.redpack');//引进现金红包类
		$redpack=new Redpack();
		$arr['nonce_str']=$redpack->createNoncestr();//获取随机数
		$arr['sign']=$redpack->getSign($arr);//获取签名
		$xml=$redpack->arrayToXml($arr);//将数组转化成xml格式请求
		$result=$redpack->postXmlSSLCurl($xml,$url,$second=30,$apiclient_cert,$apiclient_key,$rootca);
		$RES=$redpack->xmlToArray($result);
		return $RES;
	}

	/*调用微信优惠券
	 * @time 2016.12.9
	 * @author 祝君伟
	 * @接口提供 陈琦
	 * */
	public function wechatCoupon(){
		//证书路径
		$apiclient_cert=getcwd().'/conf/cert/apiclient_cert.pem';
		$apiclient_key=getcwd().'/conf/cert/apiclient_key.pem';
		$rootca=getcwd().'/conf/cert/rootca.pem';
		$arr['mch_id']='1327750001';
		$url="https://api.mch.weixin.qq.com/mmpaymkttransfers/send_coupon";
		$arr['coupon_stock_id']='1081600';//代金券批次id
		$arr['openid']=$_SESSION['user']['openid'];
		$arr['openid_count']=1;//openid记录数
		$arr['partner_trade_no']=$arr['mch_id'].date('YmdHis').rand(1000,9999);//商户单据号
		$arr['appid']='wx49b9dbe4f861f4f8';
		import('@.ORG.redpack');//引进现金红包类
		$redpack=new Redpack();
		$arr['nonce_str']=$redpack->createNoncestr();//获取随机数
		$arr['sign']=$redpack->getSign($arr);//获取签名
		$xml=$redpack->arrayToXml($arr);//将数组转化成xml格式请求
		$result=$redpack->postXmlSSLCurl($xml,$url,$second=30,$apiclient_cert,$apiclient_key,$rootca);
		$RES=$redpack->xmlToArray($result);
		/*dump($RES);*/
		return $RES;
	}

	/*
	 *查询优惠券状态
	 * 陈琦
	 * 2016.12.20
	 */
	public function ask_couponStatus($coupon_id){
		$url="https://api.mch.weixin.qq.com/mmpaymkttransfers/querycouponsinfo";
		$arr['stock_id']='1081600';//代金券批次id
		$arr['openid']=$_SESSION['user']['openid'];
		$arr['appid']='wx49b9dbe4f861f4f8';
		$arr['mch_id']='1327750001';
		$arr['coupon_id']=$coupon_id;
		import('@.ORG.redpack');//引进现金红包类
		$redpack=new Redpack();
		$arr['nonce_str']=$redpack->createNoncestr();//获取随机数
		$arr['sign']=$redpack->getSign($arr);//获取签名
		$xml=$redpack->arrayToXml($arr);//将数组转化成xml格式请求
		$result=$redpack->postXmlCurl($xml,$url,$second=30);
		$RES=$redpack->xmlToArray($result);
		return $RES;
	}

	/*调用停车优惠券接口
	 * @time 2016.12.9
	 * @author 祝君伟
	 * array $criterion_pause_array; post接口的数据
	 * string $rc_result 插入的record_id号
	 * @接口提供 小王
	 * */
	public function pauseCoupon($criterion_pause_array,$rc_result){
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
		$coupon_array= array(
			'data_state' =>$data
		);
		//将抽到的奖励添加到数据库中
		$couponOb->where(array('record_id'=>$rc_result))->data($coupon_array)->save();
		return $data;
	}

	/* 成功开门之后获取优惠券
	* @time 2016-11-17
	* @author	祝君伟*/
	public function coupon(){
		//用户没有领取过
		//获取优惠券
		$coupon = I('get.coupon');
		//点击领取后优惠券码入库
		$record_array= array(
			'activity_id'=>'4',
			'time'=>time(),
			'uid'=>$this->user_session['uid'],
			'part_count'=>'1'
		);
		$m = M('Extension_activity_record');
		//向数据表里面插入数据
		//活动参与记录表
		$record_id = $m->data($record_array)->add();
		//活动优惠券记录表
		$coupon_array = array(
			'record_id'=>$record_id,
			'activity_id'=>'4',
			'number'=>$coupon
		);
		$couponOb = M('Extension_coupon_record');
		$re_coupon =$couponOb->data($coupon_array)->add();
	}

	/*活动抽奖随机算法
	 * @time 2016.12.9
	 * @author 祝君伟
	 * string $gift_array 礼物的数组
	 * string $gift_sum 礼物的概率数组（与礼物要一一对应）
	 * @return string 抽取到的礼物
	 * */
	public function randomGift($gift_str,$gift_sum){
		//将gift里面的字符进行拆分为数组
		$gift_array = explode(",",$gift_str);
		$gift_sum_array = explode(",",$gift_sum);
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
	public function pause(){
		//获取前台传来的车牌
		$pause = I('get.pause');
		$rc_result = I('get.rc_result');
		//给接口传递正确的车牌
		$pause_array = explode("-",$pause);
		$new_pause = mb_substr($pause_array[0],0,1,'utf-8');
		$new_plate = mb_substr($pause_array[0],1,1,'utf-8');
		$criterion_pause = $new_pause.'-'.$new_plate.$pause_array[1];
		$criterion_pause=strtoupper($criterion_pause);
		//将车牌录入到数据库中
		$couponOb = M('Extension_coupon_record');
		$coupon_array= array(
			'plate'=>$criterion_pause
		);
		//将抽到的奖励添加到数据库中
		$couponOb->where(array('record_id'=>$rc_result))->data($coupon_array)->save();
		$criterion_pause_array = array('car_no'=>$criterion_pause);
		//给接口传递值
		$res = $this->pauseCoupon($criterion_pause_array,$rc_result);
		echo $res;

	}
	/*查询现在这个用户的历史活动信息
	 * @time 2016.12.15
	 * @author 祝君伟
	 * */
	public function pastgift(){
		//根据uid在表中查询
		$uid = $this->user_session['uid'];
		//设置查询的变量
		$condition_where_pastgift = "record.pigcms_id=coupon.record_id and record.uid=$uid";
		$condition_table_pastgift = array(
			'pigcms_extension_activity_record'=>'record',
			'pigcms_extension_coupon_record'=>'coupon'
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
	public function get_coupon_list($pastgift_result){
		//过期时间计算
		$pasttime = 1485792000-time();
		$pastday = floor($pasttime/86400);
		$listTd = '';
		foreach ($pastgift_result as $value){
			if($value['giftname']=='停车优惠券'&&$value['plate']==''){
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
								<div style="width:40%; float:left; line-height:35px; color:#e65c51; font-family:\'微软雅黑\'; font-size:12px;">已过期</div>
								<div style="width:60%; float:right; line-height:35px; color:#909090; font-family:\'微软雅黑\'; font-size:12px; text-align:right;">有效期至01-31</div>
								<div style="clear:both"></div>
							</div>
						</div>
					</div>
					<div style="clear:both"></div>
				</div>
			</div>';
			}else if($value['giftname']=='大头仔现金券'){
				$coupon_state = $this->ask_couponStatus($value['number']);
				if($coupon_state['coupon_state'] == "SENDED" && $pastday>0){
					//没有使用大头仔现金券
					$listTd .= '<div style="margin:10px auto; width:93%;">
				<div style="width:100%; background-color:#febe39;">
					<div class="demo">
						<span style="width:100%; margin:0px auto; padding-top:20px;">
							<div style="width:70%; margin:0px auto;">
							<div style="width:100%; height:50px; line-height:50px; border-bottom:1px #01b1a1 solid; color:#FFFFFF; font-size:18px; text-align:center;">
								<div style="margin:0px auto;">
									<div style="font-size:50px; float:left; width:60%; text-align: right">5</div>
									<div style="font-size:16px; float:left; width:40%; padding-top:10px; font-family:\'微软雅黑\';text-align: left;">元</div>
								</div>
							</div>
							<div style="width:100%; line-height:30px; color:#FFFFFF; text-align:center; height:30px; paddint-top:-10px;">代金券</div>
							</div>
						</span>
					</div>
					<div style="width:70%; height:126px; float:left; background-color:#FFFFFF; border-radius:0 6px 6px 0;">
						<div style="width:80%; margin:0px auto;">
							<div style="width:100%; height:40px; line-height:40px; color:#000000; font-size:16px; font-family:\'微软雅黑\';">六楼食堂5元代金券</div>
							<div style="width:100%; height:15px; line-height:15px; color:#999999; font-size:14px; font-family:\'微软雅黑\';">满8元即可用，去食堂消费自动使用</div>
							<div style="width:100%; padding-top:34px; height:35px; line-height:35px; color:#999999; font-size:14px; font-family:\'微软雅黑\'; border-bottom:0.8px #f3f3f3 solid;">
								<div style="width:40%; float:left; line-height:35px; color:#e65c51; font-family:\'微软雅黑\'; font-size:12px;">'.$pastday.'天过期</div>
								<div style="width:60%; float:right; line-height:35px; color:#909090; font-family:\'微软雅黑\'; font-size:12px; text-align:right;">有效期至01-31</div>
								<div style="clear:both"></div>
							</div>
						</div>
					</div>
					<div style="clear:both"></div>
				</div>
			</div>';
				}elseif ($coupon_state['coupon_state'] == "USED"){
					//使用大头仔现金券
					$url = C('config.site_url');
					$listTd .='<div style="background:url('.$url.'/tpl/Wap/pure/static/images/137/xxx.png) no-repeat; background-size:100% 100%; width:57px; height:48px; margin-top:10px; right:12%; z-index:999; position:absolute;"></div>
			<div style="margin:10px auto; width:93%;">
				<div style="width:100%; background-color:#febe39;">
					<div class="demo">
						<span style="width:100%; margin:0px auto; padding-top:20px;">
							<div style="width:70%; margin:0px auto;">
							<div style="width:100%; height:50px; line-height:50px; border-bottom:1px #01b1a1 solid; color:#FFFFFF; font-size:18px; text-align:center;">
								<div style="margin:0px auto;">
									<div style="font-size:50px; float:left; width:60%; text-align: right">5</div>
									<div style="font-size:16px; float:left; width:40%; padding-top:10px; font-family:\'微软雅黑\';text-align: left;">元</div>
								</div>
							</div>
							<div style="width:100%; line-height:30px; color:#FFFFFF; text-align:center; height:30px; paddint-top:-10px;">代金券</div>
							</div>
						</span>
					</div>
					<div style="width:70%; height:126px; float:left; background-color:#FFFFFF; border-radius:0 6px 6px 0;">
						<div style="width:80%; margin:0px auto;">
							<div style="width:100%; height:40px; line-height:40px; color:#000000; font-size:16px; font-family:\'微软雅黑\';">六楼食堂5元代金券</div>
							<div style="width:100%; height:15px; line-height:15px; color:#999999; font-size:14px; font-family:\'微软雅黑\';">满8元即可用，去食堂消费自动使用</div>
							<div style="width:100%; padding-top:34px; height:35px; line-height:35px; color:#999999; font-size:14px; font-family:\'微软雅黑\'; border-bottom:0.8px #f3f3f3 solid;">							
								<div style="width:60%; float:right; line-height:35px; color:#909090; font-family:\'微软雅黑\'; font-size:12px; text-align:right;">有效期至01-31</div>
								<div style="clear:both"></div>
							</div>
						</div>
					</div>
					<div style="clear:both"></div>
				</div>
			</div>';
				}else{
					//使用大头仔现金券
					$url = C('config.site_url');
					$listTd .='<div style="background:url('.$url.'/tpl/Wap/pure/static/images/137/xxx.png) no-repeat; background-size:100% 100%; width:57px; height:48px; margin-top:10px; right:12%; z-index:999; position:absolute;"></div>
					<div style="margin:10px auto; width:93%;">
				<div style="width:100%; background-color:#febe39;">
					<div class="demo">
						<span style="width:100%; margin:0px auto; padding-top:20px;">
							<div style="width:70%; margin:0px auto;">
							<div style="width:100%; height:50px; line-height:50px; border-bottom:1px #01b1a1 solid; color:#FFFFFF; font-size:18px; text-align:center;">
								<div style="margin:0px auto;">
									<div style="font-size:50px; float:left; width:60%; text-align: right">5</div>
									<div style="font-size:16px; float:left; width:40%; padding-top:10px; font-family:\'微软雅黑\';text-align: left;">元</div>
								</div>
							</div>
							<div style="width:100%; line-height:30px; color:#FFFFFF; text-align:center; height:30px; paddint-top:-10px;">代金券</div>
							</div>
						</span>
					</div>
					<div style="width:70%; height:126px; float:left; background-color:#FFFFFF; border-radius:0 6px 6px 0;">
						<div style="width:80%; margin:0px auto;">
							<div style="width:100%; height:40px; line-height:40px; color:#000000; font-size:16px; font-family:\'微软雅黑\';">六楼食堂5元代金券</div>
							<div style="width:100%; height:15px; line-height:15px; color:#999999; font-size:14px; font-family:\'微软雅黑\';">满8元即可用，去食堂消费自动使用</div>
							<div style="width:100%; padding-top:34px; height:35px; line-height:35px; color:#999999; font-size:14px; font-family:\'微软雅黑\'; border-bottom:0.8px #f3f3f3 solid;">
								<div style="width:60%; float:right; line-height:35px; color:#909090; font-family:\'微软雅黑\'; font-size:12px; text-align:right;">有效期至01-31</div>
								<div style="clear:both"></div>
							</div>
						</div>
					</div>
					<div style="clear:both"></div>
				</div>
			</div>';
				}

			}else if($value['giftname']=='停车优惠券'&&$value['plate']!=''){
				//使用停车优惠券
				$url = C('config.site_url');
				$listTd .='<div style="background:url('.$url.'/tpl/Wap/pure/static/images/137/xxx.png) no-repeat; background-size:100% 100%; width:57px; height:48px; margin-top:10px; right:12%; z-index:999; position:absolute;"></div>
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
							<div style="width:100%; height:15px; line-height:15px; color:#9a9a9a; font-size:14px; font-family:\'微软雅黑\';">已使用，使用车牌为<br/>'.$value['plate'].'</div>
							<div style="width:100%; padding-top:34px; height:35px; line-height:35px; color:#999999; font-size:14px; font-family:\'微软雅黑\'; border-bottom:0.8px #f3f3f3 solid;">
								<div style="width:60%; float:right; line-height:35px; color:#9a9a9a; font-family:\'微软雅黑\'; font-size:12px; text-align:right;">有效期至01-31</div>
								<div style="clear:both"></div>
							</div>
						</div>
					</div>
					<div style="clear:both"></div>
				</div>
			</div>';

			}else{
				$money = $value['number']/100;
				//获取了现金红包
				if($pastday>0){
					$listTd .='<div style="margin:10px auto; width:93%;">
				<div style="width:100%; background-color:#febe39;">
					<div class="demo">
						<span style="width:100%; margin:0px auto; padding-top:20px;">
							<div style="width:70%; margin:0px auto;">
							<div style="width:100%; height:50px; line-height:50px; border-bottom:1px #01b1a1 solid; color:#FFFFFF; font-size:18px; text-align:center;">
								<div style="margin:0px auto; width:100%;"><div style="font-size:26px;text-align:center;">'.$money.'</div></div>
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
								<div style="width:40%; float:left; line-height:35px; color:#e65c51; font-family:\'微软雅黑\'; font-size:12px;">'.$pastday.'天过期</div>
								<div style="width:60%; float:right; line-height:35px; color:#909090; font-family:\'微软雅黑\'; font-size:12px; text-align:right;">有效期至01-31</div>
								<div style="clear:both"></div>
							</div>
						</div>
					</div>
					<div style="clear:both"></div>
				</div>
			</div>';
				}else{
					$url = C('config.site_url');
					$listTd .='<div style="background:url('.$url.'/tpl/Wap/pure/static/images/137/xxx.png) no-repeat; background-size:100% 100%; width:57px; height:48px; margin-top:10px; right:12%; z-index:999; position:absolute;"></div>
			<div style="margin:10px auto; width:93%;">
				<div style="width:100%; background-color:#febe39;">
					<div class="demo">
						<span style="width:100%; margin:0px auto; padding-top:20px;">
							<div style="width:70%; margin:0px auto;">
							<div style="width:100%; height:50px; line-height:50px; border-bottom:1px #01b1a1 solid; color:#FFFFFF; font-size:18px; text-align:center;">
								<div style="margin:0px auto; width:100%;"><div style="font-size:26px;text-align:center;">'.$money.'</div></div>
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
								<div style="width:40%; float:left; line-height:35px; color:#e65c51; font-family:\'微软雅黑\'; font-size:12px;">已使用</div>
								<div style="width:60%; float:right; line-height:35px; color:#909090; font-family:\'微软雅黑\'; font-size:12px; text-align:right;">有效期至01-31</div>
								<div style="clear:both"></div>
							</div>
						</div>
					</div>
					<div style="clear:both"></div>
				</div>
			</div>';
				}
			}
		}
		return $listTd;
	}

	/* 发送手机验证码
	* @time 2016-07-05
	* @author	小邓  <969101097@qq.com>*/
	public function SmsCodeverify(){
		if(isset($_POST['phone']) && !empty($_POST['phone'])){
			$phone=M('house_village_user_bind')->where(array('uid'=>array('neq',$this->user_session['uid']),'village_id'=>$_GET['village_id'],'phone'=>$_POST['phone']))->getField('phone');
			if($phone==$_POST['phone']){	//判断此手机号码是否存在
				$this->ajaxReturn(array('code_error'=>1,'code_msg'=>'此手机号码已存在请重新填写'));
			}else{
				$chars='0123456789';
				mt_srand((double)microtime()*1000000* getmypid());
				$vcode="";
				while(strlen($vcode)<6){
					$vcode.=substr($chars,(mt_rand()%strlen($chars)),1);
				}
				$addtime=time();
				$expiry=$addtime + 20 * 60; /*             * **二十分钟有效期*** */
				$data=array('telphone' => $_POST['phone'],'vfcode' =>$vcode,'expiry'=>$expiry,'addtime'=>$addtime);
				$insert_id=M('User_modifypwd')->add($data);
				if($insert_id){
					$content='您的验证码是：'. $vcode . '。此验证码20分钟内有效，请不要把验证码泄露给其他人。如非本人操作，可不用理会！';
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
					}
					//$result['msg']=$xml->message;
				}else{
					$this->ajaxReturn(array('code_error'=>1,'code_msg'=>'失败啦'));
				}
			}
		}else{
			$this->ajaxReturn(array('code_error'=>2,'code_msg'=>'请输入手机号码'));
		}
	}

	/* 微信定位
	* @time 2016-07-22
	* @author	小邓  <969101097@qq.com>*/
	public function userLocation(){
		if(empty($this->user_session)){	//判断是否已登录
			redirect(U('Wap/Login/weixin',array('referer'=>urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']))));
		}else{
			//dump($this->user_session);
			if(IS_POST){
				if($_POST['control'] && $_POST['control']=='is_control'){	//判断是否是智能门禁定位
					//D('User_long_lat')->saveLocation($this->user_session['openid'],$_POST['long'],$_POST['lat']);
					if(M('user_long_lat')->where(array('open_id'=>$this->user_session['openid']))->find()){
						$log_lat=M('user_long_lat')->where(array('open_id' =>$this->user_session['openid']))->save(array('long'=>$_POST['long'],'lat'=>$_POST['lat'],'dateline'=>$_SERVER['REQUEST_TIME']));
					}else{
						$log_lat=M('user_long_lat')->add(array('long'=>$_POST['long'],'lat'=>$_POST['lat'],'dateline'=>$_SERVER['REQUEST_TIME'],'open_id'=>$this->user_session['openid']));
					}
					if($log_lat){
						$this->ajaxReturn(array('code_error'=>0,'code_msg'=>'定位更新成功'));
					}else{
						$this->ajaxReturn(array('code_error'=>1,'code_msg'=>'定位更新失败'));
					}
				}else{
					$add_data=array(
						'openid'=>$this->user_session['openid'],
						'wxname'=>$this->user_session['nickname'],
						'lat'=>$_POST['lat'],
						'long'=>$_POST['long'],
						'addtime'=>date('Y-m-d H:i:s',time())
					);
					$add=M('user_location')->data($add_data)->add();
					if($add){
						$this->ajaxReturn(array('code_error'=>0,'code_msg'=>'添加成功'));
					}else{
						$this->ajaxReturn(array('code_error'=>1,'code_msg'=>'添加失败'));
					}
				}
			}else{
				$signa_arr=unserialize($this->getSigna(D('Access_token_expires')->get_access_token()['access_token']));
				$signa_arr['appid']=$this->config['wechat_appid'];
				$this->assign('signa_arr',$signa_arr);
				$this->display();
			}
		}
	}

	/* 获取随机数及签名
	* @time 2016-07-22
	* @author	小邓  <969101097@qq.com>*/
	public function getSigna($token=''){
		$url='https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token='.$token.'&type=jsapi';
		$file_contents=file_get_contents($url);
		$file_contents=json_decode($file_contents,TRUE);
		$chars="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$protocol=(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS']!=='off' || $_SERVER['SERVER_PORT']==443) ? "https://" : "http://";
		$url_host="$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$str="";
		for($i=0;$i<16;$i++){
			$str.=substr($chars,mt_rand(0,strlen($chars)-1),1);
		}
		$signature=sha1('jsapi_ticket='.$file_contents['ticket'].'&noncestr='.$str.'&timestamp='.time().'&url='.$url_host);
		$signa_arr=array();
		$signa_arr['str']=$str;
		$signa_arr['signature']=$signature;
		$result_signa=serialize($signa_arr);
		return $result_signa;
	}

	/* 我的钥匙提示页面(只访客点击时)
	* @time 2016-08-10
	* @author	小邓  <969101097@qq.com>*/
	public function noticeKid(){

		$this->display();
	}

	/* 测试
	* @time 2016-07-22
	* @author	小邓  <969101097@qq.com>*/
	public function testCompany(){
		if(IS_AJAX){
			//$this->ajaxReturn(array('error_code'=>0,'code_msg'=>$_GET['village_id']));
			$village_id=intval($_GET['village_id']);	//社区ID
			$company_name=trim($_POST['company_name']);
			if(!empty($company_name)){
				$company_head=M('company')->where(array('village_id'=>$village_id,'company_name'=>array('like',$company_name.'%')))->field('company_id,company_name')->select();
				$company_cent=M('company')->where(array('village_id'=>$village_id,'company_name'=>array('like','%'.$company_name.'%')))->field('company_id,company_name')->select();
				if($company_head){
					$this->ajaxReturn(array('error_code'=>0,'code_msg'=>$company_head));
				}else if($company_cent){
					$this->ajaxReturn(array('error_code'=>0,'code_msg'=>$company_cent));
				}else{
					$this->ajaxReturn(array('error_code'=>2,'code_msg'=>''));
				}
			}else{
				$this->ajaxReturn(array('error_code'=>2,'code_msg'=>''));
			}			
		}else{
			//$company_list=M('company')->where(array('village_id'=>4))->order('CONVERT(company_name USING gbk) COLLATE gbk_chinese_ci ASC')->select();
			$company_list=M('company')->where(array('village_id'=>4))->field('company_id,company_name,company_first')->order('company_first ASC')->select();
			$this->assign('company_list',$company_list);
			$this->display();
		}
	}

}

?>