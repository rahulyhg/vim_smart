<?php
/*
 * 店员中心
 */

class StoreAction extends BaseAction{
	protected $staff_session;
	protected $store;
	public function _initialize(){
		parent::_initialize();
		$this->staff_session = session('staff');
		
		if(ACTION_NAME != 'login' && ACTION_NAME != 'cashierBack'){
			if(empty($this->staff_session)){
				redirect(U('Store/login'));
				exit();
			}else{
				$this->assign('staff_session',$this->staff_session);
				$database_merchant_store = D('Merchant_store');
				$condition_merchant_store['store_id'] = $this->staff_session['store_id'];
				$this->store = $database_merchant_store->field(true)->where($condition_merchant_store)->find();
				if(empty($this->store)){
					$this->error('店铺不存在！');
				}
			}
		}
	}
	public function login(){
		if(IS_POST){
			if(md5($_POST['verify']) != $_SESSION['merchant_store_login_verify']){
				exit(json_encode(array('error'=>'1','msg'=>'验证码不正确！','dom_id'=>'verify')));
			}
			
			$database_store_staff = D('Merchant_store_staff');
			$condition_store_staff['username'] = $_POST['account'];
			$now_staff = $database_store_staff->field(true)->where($condition_store_staff)->find();

			if(empty($now_staff)){
				exit(json_encode(array('error'=>'2','msg'=>'帐号不存在！','dom_id'=>'account')));
			}
			$pwd = md5($_POST['pwd']);
			if($pwd != $now_staff['password']){
				exit(json_encode(array('error'=>'3','msg'=>'密码错误！','dom_id'=>'pwd')));
			}
			$data_store_staff['id'] = $now_staff['id'];
			$data_store_staff['last_time'] = $_SERVER['REQUEST_TIME'];
			if($database_store_staff->data($data_store_staff)->save()){
				session('staff',$now_staff);
				exit(json_encode(array('error'=>'0','msg'=>'登录成功,现在跳转~','dom_id'=>'account')));
			}else{
				exit(json_encode(array('error'=>'6','msg'=>'登录信息保存失败,请重试！','dom_id'=>'account')));
			}
		}else{
			$this->display();
		}
	}
    public function index(){
		if(!empty($this->store['have_group'])){
			redirect(U('Store/group_list'));
		}else{
			redirect(U('Store/meal_list'));
		}
		exit();
    }
	public function coupon_list(){
		$store_id = $this->store['store_id'];
		$condition_where = "`ear`.`uid`=`u`.`uid` AND `ear`.`activity_list_id`=`eal`.`pigcms_id` AND `ecr`.`record_id`=`ear`.`pigcms_id` AND `ecr`.`store_id`='$store_id'";

		$condition_table = array(C('DB_PREFIX').'extension_activity_list'=>'eal',C('DB_PREFIX').'extension_activity_record'=>'ear',C('DB_PREFIX').'extension_coupon_record'=>'ecr',C('DB_PREFIX').'user'=>'u');
		$order_list = D('')->field('`eal`.`name`,`ecr`.*,`ear`.`time`,`u`.`uid`,`u`.`nickname`,`u`.`phone`')->where($condition_where)->table($condition_table)->order('`ecr`.`check_time` DESC')->select();
		$this->assign('order_list',$order_list);
		$this->display();
	}
	public function coupon_find(){
		if(IS_POST){
			$mer_id = $this->store['mer_id'];
			$condition_where = "`ear`.`uid`=`u`.`uid` AND `ear`.`activity_list_id`=`eal`.`pigcms_id` AND `ecr`.`record_id`=`ear`.`pigcms_id` AND `eal`.`mer_id`='$mer_id'";
			$find_value = $_POST['find_value'];
			$store_id = $this->store['store_id'];
			if($_POST['find_type'] == 1 && strlen($find_value) == 16){
				$condition_where .= " AND `ecr`.`number`='$find_value'";
			}else{
				$condition_where .= " AND `ecr`.`store_id`='$store_id'";
				if($_POST['find_type'] == 1){
					$condition_where .= " AND `ecr`.`number` like '$find_value%'";
				}else if($_POST['find_type'] == 2){
					$condition_where .= " AND `eal`.`pigcms_id` like '$find_value%'";
				}else if($_POST['find_type'] == 3){
					$condition_where .= " AND `u`.`uid`='$find_value'";
				}else if($_POST['find_type'] == 4){
					$condition_where .= " AND `u`.`nickname`='$find_value'";
				}else if($_POST['find_type'] == 5){
					$condition_where .= " AND `u`.`phone` like '$find_value%'";
				}
			}
			$condition_table = array(C('DB_PREFIX').'extension_activity_list'=>'eal',C('DB_PREFIX').'extension_activity_record'=>'ear',C('DB_PREFIX').'extension_coupon_record'=>'ecr',C('DB_PREFIX').'user'=>'u');
			$order_list = D('')->field('`eal`.`name`,`ecr`.*,`ear`.`time`,`u`.`uid`,`u`.`nickname`,`u`.`phone`,`ecr`.`check_time`')->where($condition_where)->table($condition_table)->order('`ecr`.`check_time` DESC')->select();
			if($order_list){
				foreach($order_list as $key=>$value){
					$order_list[$key]['time_txt'] = date('Y-m-d H:i:s',$value['time']);
					$order_list[$key]['check_time_txt'] = date('Y-m-d H:i:s',$value['check_time']);
				}
			}
			$return['list'] = $order_list;
			$return['row_count'] = count($order_list);
			echo json_encode($return);
		}else{
			$this->display();
		}
	}
	public function coupon_verify(){
		$mer_id = $this->store['mer_id'];
		$condition_table = array(C('DB_PREFIX').'extension_activity_list'=>'eal',C('DB_PREFIX').'extension_activity_record'=>'ear',C('DB_PREFIX').'extension_coupon_record'=>'ecr');
		$condition_where = "`ear`.`activity_list_id`=`eal`.`pigcms_id` AND `ecr`.`record_id`=`ear`.`pigcms_id` AND `eal`.`mer_id`='$mer_id' AND `ecr`.`pigcms_id`='{$_GET['id']}'";
		$now_order = D('')->field('`ecr`.`pigcms_id`')->where($condition_where)->table($condition_table)->find();
		if(!empty($now_order)){
			if(D('Extension_coupon_record')->where(array('pigcms_id'=>$now_order['pigcms_id']))->data(array('check_time'=>time(),'store_id'=>$this->store['store_id'],'last_staff'=>$this->staff_session['name']))->save()){
				$this->success('验证成功！');
			}else{
				$this->error('验证失败！请重试。');
			}
		}else{
			$this->error('当前订单不存在！');
		}
	}
	/* 团购相关 */
	protected function check_group(){
		if(empty($this->store['have_group'])){
			$this->error('您访问的店铺没有开通'.$this->config['group_alias_name'].'功能！');
		}
	}
	public function group_list(){
		$this->check_group();
		$store_id = $this->store['store_id'];
		$condition_where = "`o`.`uid`=`u`.`uid` AND `o`.`group_id`=`g`.`group_id` AND `o`.`store_id`='$store_id'";

		$condition_table = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'group_order'=>'o',C('DB_PREFIX').'user'=>'u');
		$order_list = D('')->field('`o`.`phone` AS `group_phone`,`o`.*,`g`.`s_name`,`u`.`uid`,`u`.`nickname`,`u`.`phone`')->where($condition_where)->table($condition_table)->order('`o`.`add_time` DESC')->select();
		$this->assign('order_list',$order_list);

		$this->display();
	}
	public function group_find(){
		if(IS_POST){
			$mer_id = $this->store['mer_id'];
			$condition_where = "`o`.`uid`=`u`.`uid` AND `o`.`group_id`=`g`.`group_id` AND `o`.`mer_id`='$mer_id'";
			$find_value = $_POST['find_value'];
			$store_id = $this->store['store_id'];
			if($_POST['find_type'] == 1 && strlen($find_value) == 14){
				$condition_where .= " AND `o`.`group_pass`='$find_value'";
			}else{
				$condition_where .= " AND `o`.`store_id`='$store_id'";
				if($_POST['find_type'] == 1){
					$condition_where .= " AND `o`.`group_pass` like '$find_value%'";
				}else if($_POST['find_type'] == 2){
					$condition_where .= " AND `o`.`express_id` like '$find_value%'";
				}else if($_POST['find_type'] == 3){
					$condition_where .= " AND `o`.`order_id`='$find_value'";
				}else if($_POST['find_type'] == 4){
					$condition_where .= " AND `o`.`group_id`='$find_value'";
				}else if($_POST['find_type'] == 5){
					$condition_where .= " AND `o`.`uid`='$find_value'";
				}else if($_POST['find_type'] == 6){
					$condition_where .= " AND `u`.`nickname` like '$find_value%'";
				}else if($_POST['find_type'] == 7){
					$condition_where .= " AND `o`.`phone` like '$find_value%'";
				}
			}
			$condition_table = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'group_order'=>'o',C('DB_PREFIX').'user'=>'u');
			$order_list = D('')->field('`o`.`phone` AS `group_phone`,`o`.*,`g`.`s_name`,`u`.`uid`,`u`.`nickname`,`u`.`phone`')->where($condition_where)->table($condition_table)->order('`o`.`add_time` DESC')->select();
			if($order_list){
				foreach($order_list as $key=>$value){
					$order_list[$key]['add_time'] = date('Y-m-d H:i:s',$value['add_time']);
					$order_list[$key]['pay_time'] = date('Y-m-d H:i:s',$value['pay_time']);
					$order_list[$key]['use_time'] = !empty($value['use_time']) ? date('Y-m-d H:i:s',$value['use_time']):'';
				}
			}
			$return['list'] = $order_list;
			$return['row_count'] = count($order_list);
			echo json_encode($return);
		}else{
			$this->check_group();
			$this->display();
		}
	}
	public function group_verify(){
		$this->check_group();
		$database_group_order = D('Group_order');
		$now_order = $database_group_order->get_order_detail_by_id_and_merId($this->store['mer_id'],$_GET['order_id'],false);
		if(empty($now_order)){
			$this->error('当前订单不存在！');
		}else if($now_order['paid'] && $now_order['status'] == 0){
			$condition_group_order['order_id'] = $now_order['order_id'];
			if (empty($now_order['third_id']) && $now_order['pay_type'] == 'offline') {
				$data_group_order['third_id'] = $now_order['order_id'];
			}
			$data_group_order['status'] = '1';
			$data_group_order['store_id'] = $this->store['store_id'];
			$data_group_order['use_time'] = $_SERVER['REQUEST_TIME'];
			$data_group_order['last_staff'] = $this->staff_session['name'];
			if($database_group_order->where($condition_group_order)->data($data_group_order)->save()){
				$this->group_notice($now_order);
				$this->success('验证成功！');
			}else{
				$this->error('验证失败！请重试。');
			}
		}else{
			$this->error('当前订单的状态并不是未消费。');
		}
	}
	
	public function group_edit(){
		$this->check_group();
		$now_order = D('Group_order')->get_order_detail_by_id_and_merId($this->store['mer_id'],$_GET['order_id'],false);
		
		if(empty($now_order)){
			exit('此订单不存在！');
		}
		if($now_order['tuan_type'] == 2 && $now_order['paid'] == 1){
			$express_list = D('Express')->get_express_list();
			$this->assign('express_list',$express_list);
		}
		if(!empty($now_order['pay_type'])){
		     $now_order['paytypestr'] = D('Pay')->get_pay_name($now_order['pay_type']);
			 if(($now_order['pay_type']=='offline') && !empty($now_order['third_id']) && ($now_order['paid']==1)){
			     $now_order['paytypestr'] .='<span style="color:green">&nbsp; 已支付</span>';
			 }else if(($now_order['pay_type']!='offline') && ($now_order['paid']==1)){
			    $now_order['paytypestr'] .='<span style="color:green">&nbsp; 已支付</span>';
			 }else{
			    $now_order['paytypestr'] .='<span style="color:red">&nbsp; 未支付</span>';
			 }
		}else{
		    $now_order['paytypestr'] = '未知';
		}
		$this->assign('now_order',$now_order);
		$this->display();
	}
	public function group_express(){
		$this->check_group();
		$now_order = D('Group_order')->get_order_detail_by_id_and_merId($this->store['mer_id'],$_GET['order_id'],false);
		if(empty($now_order)){
			$this->error('此订单不存在！');
		}
		if(empty($now_order['paid'])){
			$this->error('此订单尚未支付！');
		}
		
		$condition_group_order['order_id'] = $now_order['order_id'];
		$data_group_order['express_type'] = $_POST['express_type'];
		$data_group_order['express_id'] = $_POST['express_id'];
		$data_group_order['last_staff'] = $this->staff_session['name'];
		if($now_order['paid'] == 1 && $now_order['status'] == 0){
			if (empty($now_order['third_id']) && $now_order['pay_type'] == 'offline') {
				$data_group_order['third_id'] = $now_order['order_id'];
			}
			$data_group_order['status'] = 1;
			$data_group_order['use_time'] = $_SERVER['REQUEST_TIME'];
			$data_group_order['store_id'] = $this->store['store_id'];
		}
		
		if(D('Group_order')->where($condition_group_order)->data($data_group_order)->save()){
			$this->group_notice($now_order);
			$this->success('修改成功！');
		}else{
			$this->error('修改失败！请重试。');
		}
	}
	public function group_remark(){
		$this->check_group();
		$now_order = D('Group_order')->get_order_detail_by_id_and_merId($this->store['mer_id'],$_GET['order_id'],true,false);
		if(empty($now_order)){
			$this->error('此订单不存在！');
		}
		if(empty($now_order['paid'])){
			$this->error('此订单尚未支付！');
		}
		$condition_group_order['order_id'] = $now_order['order_id'];
		$data_group_order['merchant_remark'] = $_POST['merchant_remark'];
		if(D('Group_order')->where($condition_group_order)->data($data_group_order)->save()){
			$this->success('修改成功！');
		}else{
			$this->error('修改失败！请重试。');
		}
	}
	
	
	/*检查是否开启订餐*/
	protected function check_meal(){
		if(empty($this->store['have_meal'])){
			$this->error('您访问的店铺没有开通'.$this->config['meal_alias_name'].'功能！');
		}
	}
	
	
	public function meal_list()
	{
		$this->check_meal();
		$store_id = intval($this->store['store_id']);
		$where = array();
		if (IS_POST) {
			$order_id = isset($_POST['order_id']) ? htmlspecialchars($_POST['order_id']) : '';
			$name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
			$phone = isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '';
			$meal_pass = isset($_POST['meal_pass']) ? htmlspecialchars($_POST['meal_pass']) : '';
			$table_name = isset($_POST['table_name']) ? htmlspecialchars($_POST['table_name']) : '';
			$order_id && $where['order_id'] = array('like', "%$order_id%");
			$name && $where['name'] = array('like', "%$name%");
			$phone && $where['phone'] = array('like', "%$phone%");
			$meal_pass && $where['meal_pass'] = array('like', "%$meal_pass%");
			if ($table_name) {
				$tables = D('Merchant_store_table')->where(array('name' => array('like', "%$table_name%"), 'store_id' => $store_id))->select();
				$tableids = array();
				foreach ($tables as $table) {
					$tableids[] = $table['pigcms_id'];
				}
				$tableids && $where['tableid'] = array('in', $tableids);
			}
			$this->assign('meal_pass', $meal_pass);
			$this->assign('order_id', $order_id);
			$this->assign('name', $name);
			$this->assign('phone', $phone);
			$this->assign('table_name', $table_name);
		}
		$this->assign(D("Meal_order")->get_order_list($this->store['mer_id'], $store_id, $where));
		$this->assign('now_store', $this->store);
		$this->display();
	}
	
	public function meal_edit(){
		$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;
		$store_id = intval($this->store['store_id']);
		if (IS_POST) {
			if (isset($_POST['status'])) {
				$status = intval($_POST['status']);
				if ($order = D("Meal_order")->where(array('mer_id' => $this->store['mer_id'], 'order_id' => $order_id, 'store_id' => $store_id))->find()) {
					$data = array('store_uid' => $this->staff_session['id'], 'status' => $status);
					$data['last_staff'] = $this->staff_session['name'];
					if (empty($order['third_id']) && $order['pay_type'] == 'offline') {
						$order['paid'] = 0;
					}
					
					if ($order['paid'] == 0) {
						$notOffline = 1;
						if ($this->config['pay_offline_open'] == 1) {
							$now_merchant = D('Merchant')->get_info($order['mer_id']);
							if ($now_merchant) {
								$notOffline =($now_merchant['is_close_offline'] == 0 && $now_merchant['is_offline'] == 1) ? 0 : 1;
							}
						}
						if ($notOffline) {
							$this->error('当前订单的状态并不是未消费。');
							exit;
						}
					}
					
					if ($status && $order['paid'] == 0) {//将未支付的订单，由店员改成已消费，其订单状态则修改成线下已支付！
						$data['third_id'] = $order['order_id'];
						$order['pay_type'] = $data['pay_type'] = 'offline';
						$data['paid'] = 1;
						$price = $order['total_price'] > 0 ? $order['total_price'] : $order['price'];
						$data['pay_money'] = $price - $order['minus_price'];
						$order['pay_time'] = $_SERVER['REQUEST_TIME'];
					}
					$data['use_time'] = $_SERVER['REQUEST_TIME'];
					if (D("Meal_order")->where(array('mer_id' => $this->store['mer_id'], 'order_id' => $order_id, 'store_id' => $store_id))->save($data)) {
// 						if ($status && $order['status'] == 0) {
							$this->meal_notice($order);
// 						}
						$this->success("更新成功", U('Store/meal_list'));
					} else {
						$this->success("更新失败，稍后重试", U('Store/meal_list'));
					}
				} else {
					$this->error('不合法的请求');
				}
			} else {
				$this->redirect(U('Store/meal_list'));
			}
		} else {
			$order = D("Meal_order")->where(array('mer_id' => $this->store['mer_id'], 'order_id' => $order_id, 'store_id' => $store_id))->find();
			$order['info'] = unserialize($order['info']);
			if ($order['store_uid']) {
				$staff = D("Merchant_store_staff")->where(array('id' => $order['store_uid']))->find();
				$order['store_uname'] = $staff['name'];
			}
			if (empty($order['third_id']) && $order['pay_type'] == 'offline') {
				$order['paid'] = 0;
			}
			
			if (empty($order['tableid'])) {
				$order['tablename'] = '不限';
			} else {
				$table = D('Merchant_store_table')->where(array('pigcms_id' => $order['tableid'], 'store_id' => $store_id))->find();
				$order['tablename'] = isset($table['name']) ? $table['name'] : '不限';
			}
			
			$this->assign('order', $order);
			$this->display();
		}
	}
	
	/*预约订单列表*/
	public function appoint_list(){
		$store_id = $this->store['store_id'];
		
		$database_order = D('Appoint_order');
    	$database_user = D('User');
    	$database_appoint = D('Appoint');
    	$database_store = D('Merchant_store');
    	$where['store_id'] = $store_id;
    	$order_info = $database_order->field(true)->where($where)->order('`order_id` DESC')->select();
    	$user_info = $database_user->field('`uid`, `phone`, `nickname`')->select();
    	$appoint_info = $database_appoint->field('`appoint_id`, `appoint_name`, `appoint_type`, `appoint_price`')->select();
    	$store_info = $database_store->field('`store_id`, `name`, `adress`')->select();
    	$order_list = $this->formatOrderArray($order_info, $user_info, $appoint_info, $store_info);
    	
    	$this->assign('order_list', $order_list);
    	$this->display();
	}
	
	/*预约订单查找*/
	public function appoint_find(){
		if(IS_POST){
			$database_order = D('Appoint_order');
	    	$database_user = D('User');
	    	$database_appoint = D('Appoint');
	    	$database_store = D('Merchant_store');
			
			$appoint_where['mer_id'] = $this->store['mer_id'];
			if($_POST['find_type'] == 1 && strlen($_POST['find_value']) == 16){
				$appoint_where['appoint_pass'] = $_POST['find_value'];
			} else {
				if($_POST['find_type'] == 1){
					$appoint_where['appoint_pass'] = array('LIKE', '%'.$_POST['find_value'].'%');
				} else if($_POST['find_type'] == 2){
					$appoint_where['order_id'] = $_POST['find_value'];
				} else if($_POST['find_type'] == 3){
					$appoint_where['appoint_id'] = $_POST['find_value'];
				} else if($_POST['find_type'] == 4){
					$user_where['uid'] = $_POST['find_value'];
				} else if($_POST['find_type'] == 5){
					$user_where['nickname'] = array('LIKE', '%'.$_POST['find_value'].'%');
				} else if($_POST['find_type'] == 6){
					$user_where['phone'] = array('LIKE', '%'.$_POST['find_value'].'%');
				}
			}
	    	
	    	$order_info = $database_order->field(true)->where($appoint_where)->order('`order_id` DESC')->select();
	    	$user_info = $database_user->field('`uid`, `phone`, `nickname`')->where($user_where)->select();
	    	$appoint_info = $database_appoint->field('`appoint_id`, `appoint_name`, `appoint_type`, `appoint_price`')->select();
	    	$store_info = $database_store->field('`store_id`, `name`, `adress`')->select();
	    	$order_list = $this->formatOrderArray($order_info, $user_info, $appoint_info, $store_info);
	    	if($order_list){
	    		foreach($order_list as $key=>$val){
	    			$order_list[$key]['pay_time'] = date('Y-m-d H:i:s', $order_list[$key]['pay_time']);
	    			$order_list[$key]['order_time'] = date('Y-m-d H:i:s', $order_list[$key]['order_time']);
	    		}
	    	}
	    	
	    	$return['list'] = $order_list;
			$return['row_count'] = count($order_list);
			echo json_encode($return);
		} else {
			$this->display();
		}
	}
	
	/*订单详情*/
	public function appoint_detail(){
		$where['order_id'] = $_GET['order_id'];
		
		$database_order = D('Appoint_order');
    	$database_user = D('User');
    	$database_appoint = D('Appoint');
    	$database_store = D('Merchant_store');
	$database_appoint_visit_order_info = D('Appoint_visit_order_info');
	$database_merchant_workers = D('Merchant_workers');
    	
    	$order_info = $database_order->field(true)->where($where)->order('`order_id` DESC')->select();
    	$user_info = $database_user->field('`uid`, `phone`, `nickname`')->select();
    	$appoint_info = $database_appoint->field('`appoint_id`, `appoint_name`, `appoint_type`, `appoint_price`')->select();
    	$store_info = $database_store->field('`store_id`, `name`, `adress`')->select();
    	$order_list = $this->formatOrderArray($order_info, $user_info, $appoint_info, $store_info);
    	$now_order = $order_list[0];
    	$cue_info = unserialize($now_order['cue_field']);
    	$cue_list = array();
    	foreach($cue_info as $key=>$val){
    		if(!empty($cue_info[$key]['value'])){
    			$cue_list[$key]['name'] = $val['name'];
    			$cue_list[$key]['value'] = $val['value'];
    			$cue_list[$key]['type'] = $val['type'];
    			if($cue_info[$key]['type'] == 2){
    				$cue_list[$key]['long'] = $val['long'];
    				$cue_list[$key]['lat'] = $val['lat'];
    				$cue_list[$key]['address'] = $val['address'];
    			}
    		}
    	}
	
	//上门预约工作人员信息start
	$tmp_order_info=reset($order_info);
	
	    $Map['appoint_order_id'] = $tmp_order_info['order_id'];
	    $Map['uid'] = $tmp_order_info['uid'];
	    $appoint_visit_order_info = $database_appoint_visit_order_info->where($Map)->find();
	    $service_address=  unserialize($appoint_visit_order_info['service_address']);
	    if($tmp_order_info['appoint_type'] == 1){
	    $service_address_info = array();
		foreach($service_address as $key=>$val){
		    if(!empty($service_address[$key]['value'])){
			    $service_address_info[$key]['name'] = $val['name'];
			    $service_address_info[$key]['value'] = $val['value'];
			    $service_address_info[$key]['type'] = $val['type'];
			    if($appoint_visit_order_info[$key]['type'] == 2){
				    $service_address_info[$key]['long'] = $val['long'];
				    $service_address_info[$key]['lat'] = $val['lat'];
				    $service_address_info[$key]['address'] = $val['address'];
			    }
		    }
	    }
	    }
	    $cue_list = $service_address_info;
	    
	    $worker_where['merchant_worker_id'] = $appoint_visit_order_info['merchant_worker_id'];
	    $worker_field=array('merchant_worker_id','name','mobile');
	    $merchant_workers_info = $database_merchant_workers->appoint_worker_info($worker_where,$worker_field);
	    $this->assign('merchant_workers_info',$merchant_workers_info);
	
	//上门预约工作人员信息end
	
    	$this->assign('cue_list', $cue_list);
    	$this->assign('now_order', $now_order);
    	$this->display();
	}
	
	/*验证预约服务*/
	public function appoint_verify(){
		$database_order = D('Appoint_order');
		$database_appoint_visit_order_info = D('Appoint_visit_order_info');
		$database_merchant_workers = D('Merchant_workers');
		$database_appoint = D('Appoint');
		
		$where['store_id'] = $this->store['store_id'];
		$where['order_id'] = $_GET['order_id'];
		$order_info = $database_order->field(true)->where($where)->find();
		if(empty($order_info)){
			$this->error('当前订单不存在！');
		} else {
			$fields['store_id'] = $this->staff_session['store_id'];
			$fields['last_staff'] = $this->staff_session['name'];
			$fields['last_time'] = time();
			$fields['service_status'] = 1;
			$fields['paid'] = 1;
			if($database_order->where($where)->data($fields)->save()){
			    $Map['appoint_order_id'] =  $_GET['order_id'] + 0;
			    $appoint_visit_order_info = $database_appoint_visit_order_info->where($Map)->find();
			    
			    $worker_where['merchant_worker_id'] = $appoint_visit_order_info['merchant_worker_id'];
			    $pay_money_count = $database_appoint_visit_order_info->order_appoint_price_sum($worker_where);
			    $database_merchant_workers->where($worker_where)->where($worker_where)->setField('appoint_price',$pay_money_count);
			    $database_merchant_workers->where($worker_where)->setInc('order_num');

			    $this->success('验证成功！');
			} else {
				$this->error('验证失败！请重试。');
			}
		}
	}
	
	/* 格式化订单数据  */
    protected function formatOrderArray($order_info, $user_info, $appoint_info, $store_info){
    	if(!empty($user_info)){
    		$user_array = array();
    		foreach($user_info as $val){
    			$user_array[$val['uid']]['phone'] = $val['phone'];
    			$user_array[$val['uid']]['nickname'] = $val['nickname'];
    		}
    	}
    	if(!empty($appoint_info)){
    		$appoint_array = array();
    		foreach($appoint_info as $val){
    			$appoint_array[$val['appoint_id']]['appoint_name'] = $val['appoint_name'];
    			$appoint_array[$val['appoint_id']]['appoint_type'] = $val['appoint_type'];
    			$appoint_array[$val['appoint_id']]['appoint_price'] = $val['appoint_price'];
    		}
    	}
    	if(!empty($store_info)){
    		$store_array = array();
    		foreach($store_info as $val){
    			$store_array[$val['store_id']]['store_name'] = $val['name'];
    			$store_array[$val['store_id']]['store_adress'] = $val['adress'];
    		}
    	}
    	if(!empty($order_info)){
    		foreach($order_info as &$val){
    			$val['phone'] = $user_array[$val['uid']]['phone'];
    			$val['nickname'] = $user_array[$val['uid']]['nickname'];
    			$val['appoint_name'] = $appoint_array[$val['appoint_id']]['appoint_name'];
    			$val['appoint_type'] = $appoint_array[$val['appoint_id']]['appoint_type'];
    			$val['appoint_price'] = $appoint_array[$val['appoint_id']]['appoint_price'];
    			$val['store_name'] = $store_array[$val['store_id']]['store_name'];
    			$val['store_adress'] = $store_array[$val['store_id']]['store_adress'];
    		}
    	}
    	return $order_info;
    }
	
	public function logout(){
		session('staff_session',null);
		redirect(U('Store/login'));
	}
	
	public function bill()
	{
		$mer_id = intval($this->store['mer_id']);
		$this->assign(D("Meal_order")->get_offlineorder_by_mer_id($mer_id, $this->staff_session['name']));
		$this->display();
	}
	private function meal_notice($order)
	{
		//积分
		D('User')->add_score($order['uid'], floor($order['price'] * C('config.user_score_get')), '在 ' . $this->store['name'] . ' 中消费' . floatval($order['price']) . '元 获得积分');
		D('Userinfo')->add_score($order['uid'], $order['mer_id'], $order['price'], '在 ' . $this->store['name'] . ' 中消费' . floatval($order['price']) . '元 获得积分');
		//短信
		$sms_data = array('mer_id' => $this->store['mer_id'], 'store_id' => $this->store['store_id'], 'type' => 'food');
		if ($this->config['sms_finish_order'] == 1 || $this->config['sms_finish_order'] == 3) {
			if (empty($order['phone'])) {
				$user = D('User')->field(true)->where(array('uid' => $order['uid']))->find();
				$order['phone'] = $user['phone'];
			}
			$sms_data['uid'] = $order['uid'];
			$sms_data['mobile'] = $order['phone'];
			$sms_data['sendto'] = 'user';
			$sms_data['content'] = '您在 ' . $this->store['name'] . '店中下的订单(订单号：' . $order['order_id'] . '),已经完成了消费，如有任何疑意，请您及时联系本店，欢迎再次光临！';
			Sms::sendSms($sms_data);
		}
		if ($this->config['sms_finish_order'] == 2 || $this->config['sms_finish_order'] == 3) {
			$sms_data['uid'] = 0;
			$sms_data['mobile'] = $this->store['phone'];
			$sms_data['sendto'] = 'merchant';
			$sms_data['content'] = '顾客购买的' . $order['name'] . '的订单(订单号：' . $order['order_id'] . '),已经完成了消费！';
			Sms::sendSms($sms_data);
		}
		
		//打印
		$msg = ArrayToStr::array_to_str($order['order_id']);
		$op = new orderPrint($this->config['print_server_key'], $this->config['print_server_topdomain']);
		$op->printit($this->store['mer_id'], $this->store['store_id'], $msg, 1);


		$str_format = ArrayToStr::print_format($order['order_id']);
		foreach ($str_format as $print_id => $print_msg) {
			$print_id && $op->printit($this->store['mer_id'], $this->store['store_id'], $print_msg, 1, $print_id);
		}
		
	}
	
	private function group_notice($order)
	{
		//积分
		D('User')->add_score($order['uid'],floor($order['total_money']*C('config.user_score_get')),'购买 '.$order['order_name'].' 消费'.floatval($order['total_money']).'元 获得积分');
		D('Userinfo')->add_score($order['uid'], $order['mer_id'], $order['total_money'], '购买 '.$order['order_name'].' 消费'.floatval($order['total_money']).'元 获得积分');
		
		//短信
		$sms_data = array('mer_id' => $order['mer_id'], 'store_id' => $this->store['store_id'], 'type' => 'group');
		if ($this->config['sms_finish_order'] == 1 || $this->config['sms_finish_order'] == 3) {
			$sms_data['uid'] = $order['uid'];
			$sms_data['mobile'] = $order['phone'];
			$sms_data['sendto'] = 'user';
			$sms_data['content'] = '您购买 '.$order['order_name'].'的订单(订单号：' . $order['order_id'] . ')已经完成了消费，如有任何疑意，请您及时联系本店，欢迎再次光临！';
			Sms::sendSms($sms_data);
		}
		if ($this->config['sms_finish_order'] == 2 || $this->config['sms_finish_order'] == 3) {
			$sms_data['uid'] = 0;
			$sms_data['mobile'] = $this->store['phone'];
			$sms_data['sendto'] = 'merchant';
			$sms_data['content'] = '顾客购买的' . $order['order_name'] . '的订单(订单号：' . $order['order_id'] . '),已经完成了消费！';
			Sms::sendSms($sms_data);
		}
		
		//打印
		$msg = ArrayToStr::array_to_str($order['order_id'], 'group_order');
		$op = new orderPrint($this->config['print_server_key'], $this->config['print_server_topdomain']);
		$op->printit($this->store['mer_id'], $this->store['store_id'], $msg, 1);
	}
	
	public function check_confirm()
	{
		$database = D('Meal_order');
		$order_id = $condition['order_id'] = intval($_POST['order_id']);
		$condition['store_id'] = $this->store['store_id'];
		$order = $database->field(true)->where($condition)->find();
		if(empty($order)){
			$this->error('订单不存在！');
		}
		
		$data['is_confirm'] = 1;
		$data['order_status'] = 3;
		if($database->where($condition)->data($data)->save()){
			if ($order['meal_type'] == 1) {
				$deliverCondition['store_id'] = $this->store['store_id'];
				$deliverCondition['mer_id'] = $this->store['mer_id'];
				// 商家是否接入配送
				$deliver = D('Deliver_store')->where($deliverCondition)->find();
				if(!$deliver){
					$this->success('已接单');
				}
				$deliverType = $deliver['type'];
				
				// 订单的配送地址
				$address_id = $order['address_id'];
				$address_info = D('User_adress')->where(array('adress_id' => $address_id))->find();
				
				$supply['order_id'] = $order_id;
				$supply['store_id'] = $this->store['store_id'];
				$supply['mer_id'] = $this->store['mer_id'];
				$supply['from_site'] = $this->store['adress'];
				$supply['from_lnt'] = $this->store['long'];
				$supply['from_lat'] = $this->store['lat'];
				
				$supply['aim_site'] =  $address_info['adress'].' '.$address_info['detail'];
				$supply['aim_lnt'] = $address_info['longitude'];
				$supply['aim_lat'] = $address_info['latitude'];
				$supply['name']  = $address_info['name'];
				$supply['phone'] = $address_info['phone'];
				
				$supply['status'] =  1;
				$supply['type'] = $deliverType;
				$supply['item'] = 0;
	// 			$supply['code'] = $order['code'];//'收货码',
				$supply['create_time'] = $_SERVER['REQUEST_TIME'];
				$supply['start_time'] = $_SERVER['REQUEST_TIME'];
				$supply['appoint_time'] = $_SERVER['REQUEST_TIME'];
				
	// 			if ($storeInfo && $storeInfo['close'] == '1') {
	// 				$supply['appoint_time'] = strtotime(date('Y-m-d').''.$storeInfo['start_time_2']);
	// 			}
				
				$addResult = D('Deliver_supply')->data($supply)->add();
				
				if (!$addResult) {
					$this->error('接单失败');
				}
			}
			$this->success('已接单');
		} else {
			$this->error('接单失败');
		}
		
	}
	public function waimai(){
		$store_id = intval($this->store['store_id']);
		$mer_id = intval($this->store['mer_id']);
	
		$condition['store_id'] = $store_id;
		$condition['mer_id'] = $mer_id;
		$this->check_meal();
	
		if (IS_POST) {
			$order_id = isset($_POST['order_id']) ? htmlspecialchars($_POST['order_id']) : '';
			$name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
			$phone = isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '';
			$meal_pass = isset($_POST['meal_pass']) ? htmlspecialchars($_POST['meal_pass']) : '';
			$order_id && $condition['order_id'] = array('like', "%$order_id%");
			$name && $condition['username'] = array('like', "%$name%");
			$phone && $condition['userphone'] = array('like', "%$phone%");
			$meal_pass && $condition['code'] = array('like', "%$meal_pass%");
			$this->assign('meal_pass', $meal_pass);
			$this->assign('order_id', $order_id);
			$this->assign('name', $name);
			$this->assign('phone', $phone);
		}

		$count = D('waimai_order')->where($condition)->count();
		import('@.ORG.merchant_page');
		$p = new Page($count, 20);
		$list = D('waimai_order')->where($condition)->order("order_id DESC")->limit($p->firstRow . ',' . $p->listRows)->select();
		$pay_method = D('Config')->get_pay_method();
		
		if(count($list)){
			foreach ($list as $listInfo){
				$addressId[$listInfo['address_id']] = $listInfo['address_id'];
				$orderId[$listInfo['order_id']] = $listInfo['order_id'];
			}
			$allGoodsOrder = D('Waimai_goods')->get_all_order_goods($orderId);
			
			foreach ($list as $k=>$listInfo){
				if($listInfo['address']){
					$list[$k]['address_info'] = unserialize($listInfo['address']);
				}
				if($pay_method[$listInfo['pay_type']]){
					$list[$k]['pay_method'] = 	$pay_method[$listInfo['pay_type']]['name'];
				}
				if($allGoodsOrder[$listInfo['order_id']]){
					$list[$k]['order_info'] = $allGoodsOrder[$listInfo['order_id']];
				}
			}
		}
		$pagebar =  $p->show();
		$this->assign('pagebar',$pagebar);
		$this->assign('order_list',$list);
		$this->assign('now_store', $this->store);
		$this->display();
	}
	
	public function waimai_add(){
		
		$store_id = intval($this->store['store_id']);
		$mer_id = intval($this->store['mer_id']);
		$status = intval($_POST['status']);
		$order_id = intval($_POST['order_id']);
		
		$storeInfo =  D('Waimai_store')->where(array('store_id'=>$store_id))->find();
		
		$condition['store_id'] = $store_id;
		$condition['mer_id'] = $mer_id;
		$deliverCondition = $condition;
		$condition['order_id'] = $order_id;
		
		$this->check_waimai();
		$order = D('Waimai_order')->where($condition)->find();
		if(!$order){
			$this->error('非法操作');
		}
		$order_status = 3;
		if($status == 2){
			$order_status = 7;
			// 取消订单 申请 
			
		}
		$result = D('Waimai_order')->field('order_id,code,address_id')->where($condition)->save(array('order_status'=>$order_status));
		if(!$result){
			$this->error('操作失败');
		}
		// 如果商家已接单 并且已经配送
		if($status == 2 && $result){
			$this->success('取消订单成功');
		}
		// 商家是否接入配送
		$deliver = D('Deliver_store')->where($deliverCondition)->find();
// 		echo D('Deliver_store')->_sql();die;
		if(!$deliver){
			$this->success('已接单');
		}
		$deliverType = $deliver['type'];
		// 订单的配送地址
		$address_id = $order['address_id'];
		$address_info = D('Waimai_user_address')->where(array('address_id'=>$address_id))->find();
		$supply['order_id'] = $order_id;
		$supply['store_id'] = $store_id;
		$supply['mer_id'] = $mer_id;
		$supply['from_site'] = $this->store['adress'];
		$supply['from_lnt'] = $this->store['long'];
		$supply['from_lat'] = $this->store['lat'];
		$supply['aim_site'] =  $address_info['address'].' '.$address_info['detail'];
		$supply['aim_lnt'] = $address_info['longitude'];
		$supply['aim_lat'] = $address_info['latitude'];
		$supply['status'] =  1;
		$supply['type'] = $deliverType;
		$supply['item'] = 1;
		$supply['code'] = $order['code'];//'收货码',
		$supply['name']  = $address_info['name'];
		$supply['phone'] = $address_info['phone'];
		$supply['create_time'] = $_SERVER['REQUEST_TIME'];
		$supply['start_time'] = $_SERVER['REQUEST_TIME'];
		$supply['appoint_time'] = $_SERVER['REQUEST_TIME'];
		if($storeInfo && $storeInfo['close'] == '1'){
			$supply['appoint_time'] = strtotime(date('Y-m-d').''.$storeInfo['start_time_2']);
		}
		
		$addResult = D('Deliver_supply')->data($supply)->add();

		if(!$addResult){
			$this->error('接单失败');
		}

		//添加订单日志
		$log = array();
		$log['status'] = $order_status;
		$log['order_id'] = $order_id;
		$log['store_id'] = $store_id;
		$log['uid'] = $this->staff_session['id'];
		$log['time'] = time();
		$log['group'] = 2;
		$result = D("Waimai_order_log")->add($log);
		if (!$result) {
			//$this->error("添加订单日志失败");exit;
		}

		$this->success('已接单');
	}
	
	public function waimai_num(){
		$count = 0;
		$store_id = intval($this->store['store_id']);
		$mer_id = intval($this->store['mer_id']);
		$condition['store_id'] = $store_id;
		$condition['mer_id'] = $mer_id;
		$condition['order_status'] = 2;
		$count = D('waimai_order')->where($condition)->count();
		
		$this->success($count);
	}
	
	/*
	 * 外卖取消订单退款
	 */
	public function waimai_cancel() {
		$store_id = intval($this->store['store_id']);
		$mer_id = intval($this->store['mer_id']);
		$order_id = I('order_id', 0, 'intval');
		if (!$order_id) {
			$this->error("订单信息错误");exit;
		}
		//查找订单
		$where = array();
		$where['store_id'] = $store_id;
		$where['mer_id'] = $mer_id;
		$where['order_id'] = $order_id;
		$where['order_status'] = array('in',"2,3,4,5");
		$orderModel = D("Waimai_order");
		$order = $orderModel->field(true)->where($where)->find();
		if (!$order) {
			$this->error("订单不存在或已取消");exit;
		}
		
		D()->startTrans();
		//更新订单状态为取消状态
		$result = $orderModel->where($where)->data(array('order_status'=>7))->save();
		if (!$result) {
			D()->rollback();
			$this->error("订单状态修改失败");
		}
		
		//商家商品数回归
		$sell_log = D("Waimai_sell_log")->field(true)->where(array('order_id'=>$order_id, 'store_id'=>$store_id))->select();
		if (!$sell_log) {
			$this->error("销售记录为空");
		}
		foreach ($sell_log as $val) {
			$result = D("Waimai_goods")->where(array('goods_id'=>$val['goods_id']))->setDec("sell_count", $val['num']);
			if (!$result) {
				D()->rollback();
				$this->error("商品数量修改失败");exit;
			}
		}
		//订单到付
		if($now_order['pay_type'] == 'offline') {
			$update = array();
			$update['order_status'] = 7;
			$update['refund_detail'] = serialize(array('refund_time'=>time()));
			$result = $orderModel->where($where)->data($update)->save();
			if (!$result) {
				D()->rollback();
				$this->error("订单状态修改失败");
			}
			D()->commit();
			$this->success("取消成功");
		}
		
		$order_refund_params = array();
		//平台余额退款
		if ($order['balance_pay'] != '0.00') {
			$add_result = D('User')->add_money($order['uid'],$order['balance_pay'],'退款 '.$order['order_name'].' 增加余额');
			if (!$add_result) {
				D()->rollback();
				$this->error("平台余额退款失败");
			}
				
			$param = array('refund_time' => time());
			if($result['error_code']){
				$param['err_msg'] = $result['msg'];
			} else {
				$param['refund_id'] = $order['order_id'];
			}
			$param['balance_pay'] = $order['balance_pay'];	
			$order_refund_params['balance_pay_refund'] = serialize($param);
		}

		//线上支付退款
		if ($order['online_pay'] != '0.00') {
			$pay_method = D('Config')->get_pay_method();
			if(empty($pay_method)){
				$this->error('系统管理员没开启任一一种支付方式！');
			}
			if(empty($pay_method[$order['pay_type']])){
				$this->error('您选择的支付方式不存在，请更新支付方式！');
			}
		
			$pay_class_name = ucfirst($order['pay_type']);
			$import_result = import('@.ORG.pay.'.$pay_class_name);
			if(empty($import_result)){
				$this->error('系统管理员暂未开启该支付方式，请更换其他的支付方式');
			}
			$order['order_type'] = 'waimai';
			$order['submit_order_time'] = $order['create_time'];
			$pay_class = new $pay_class_name($order, $order['online_pay'], $order['pay_type'], $pay_method[$order['pay_type']]['config'], $this->staff_session, 1);
			$go_refund_param = $pay_class->refund();
			$order_refund_params['online_pay_refund'] = serialize($go_refund_param['refund_param']);
			if ($go_refund_param['type'] != 'ok') {
				//退款失败
				D()->rollback();
				$this->error($go_refund_param['msg']);
			}
		}
		//先保证退款完整，再更新退款信息
		D()->commit();
		
		$update = array();
		$update['refund_detail'] = $order_refund_params;
		$result = D('Waimai_order')->where(array('order_id'=>$order_id))->data($update)->save();
		if(! $result){
			//退款成功，修改退款信息失败，记录日志
			error_log(date("Y-m-d H:i:s")."=>TYPE:Waimai OrderID:".$order_id." Refund:".$order['online_pay'].PHP_EOL, 3, RUNTIME_PATH."Logs/waimai_payement".date("Y-m-d").".log");
		}

		//添加订单日志
		$log = array();
		$log['status'] = 7;
		$log['order_id'] = $order_id;
		$log['store_id'] = $store_id;
		$log['uid'] = $this->staff_session['id'];
		$log['time'] = time();
		$log['group'] = 2;
		$result = D("Waimai_order_log")->add($log);
		if (!$result) {
			$this->error("添加订单日志失败");exit;
		}
		
		$this->success("订单取消成功");
	}
	
	/*检查是否开启订餐*/
	protected function check_waimai(){
		if(empty($this->store['have_waimai'])){
			$this->error('您访问的店铺没有开通'.$this->config['waimai_alias_name'].'功能！');
		}
	}
	
	/***收银台返回处理****/
	public function cashierBack()
	{
		$lgcode=isset($_GET['lgcode']) ? trim($_GET['lgcode']) :'';
		if($lgcode){
			$staff_session = session('staff');
			$database_store_staff = D('Merchant_store_staff');
			$condition_store_staff['username'] = $staff_session['account'];
			$now_staff = $database_store_staff->field(true)->where($condition_store_staff)->find();
			if(!empty($now_staff)){
				$tmplgcode = md5($now_staff['username']);
				if($lgcode == $tmplgcode){
					session('staff',$now_staff);
					Header('Location:/store.php?g=Merchant&c=Store&a=group_list');
					exit();
				}
			}
		}
		session('merchant',null);
		$this->error('非法访问登陆！');
	}
	
	public function cashier()
	{
		$siteurl = $this->config['site_url'];
		$siteurl = rtrim($siteurl,'/');
		
		if(empty($siteurl)){
			$siteurl=isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '');
			$siteurl = strtolower($siteurl);
			if(strpos($siteurl,"http:")===false && strpos($siteurl,"https:")===false) $siteurl='http://'.$siteurl;
			$siteurl = rtrim($siteurl,'/');
		}
		
		$postdata = array('account' => $this->staff_session['username'], 'mer_id' => $this->staff_session['token'], 'store_id' => $this->staff_session['store_id'], 'domain' => ltrim($siteurl, 'http://'));
		$postdata['sign'] = $this->getSign($postdata);
		$postdataStr = json_encode($postdata);
		$postdataStr = $this->Encryptioncode($postdataStr,'ENCODE');
		$postdataStr = base64_encode($postdataStr);

		header('Location: '. $siteurl .'/merchants.php?m=Index&c=auth&a=elogin&code=' . $postdataStr);
	}
	
	private function getSign($data) {
		foreach ($data as $key => $value) {
			if (is_array($value)) {
				$validate[$key] = $this->getSign($value);
			} else {
				$validate[$key] = $value;
			}
		}
		$validate['salt'] = 'pigcmso2oCashier';	//salt
		sort($validate, SORT_STRING);
		return sha1(implode($validate));
	}
	
	/**
	 * 加密和解密函数
	 *
	 * @access public
	 * @param  string  $string    需要加密或解密的字符串
	 * @param  string  $operation 默认是DECODE即解密 ENCODE是加密
	 * @param  string  $key       加密或解密的密钥 参数为空的情况下取全局配置encryption_key
	 * @param  integer $expiry    加密的有效期(秒)0是永久有效 注意这个参数不需要传时间戳
	 * @return string
	 */
	private function Encryptioncode($string, $operation = 'DECODE', $key = '', $expiry = 0) 
	{
		$ckey_length = 4;
		$key = md5($key != '' ? $key : 'lhs_simple_encryption_code_87063');
		$keya = md5(substr($key, 0, 16));
		$keyb = md5(substr($key, 16, 16));
		$keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length) : substr(md5(microtime()), -$ckey_length)) : '';
	
		$cryptkey = $keya . md5($keya . $keyc);
		$key_length = strlen($cryptkey);
	
		$string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0) . substr(md5($string . $keyb), 0, 16) . $string;
		$string_length = strlen($string);
	
		$result = '';
		$box = range(0, 255);
	
		$rndkey = array();
		for ($i = 0; $i <= 255; $i++) {
			$rndkey[$i] = ord($cryptkey[$i % $key_length]);
		}
	
		for ($j = $i = 0; $i < 256; $i++) {
			$j = ($j + $box[$i] + $rndkey[$i]) % 256;
			$tmp = $box[$i];
			$box[$i] = $box[$j];
			$box[$j] = $tmp;
		}
	
		for ($a = $j = $i = 0; $i < $string_length; $i++) {
			$a = ($a + 1) % 256;
			$j = ($j + $box[$a]) % 256;
			$tmp = $box[$a];
			$box[$a] = $box[$j];
			$box[$j] = $tmp;
			$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
		}
	
		if ($operation == 'DECODE') {
			if ((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26) . $keyb), 0, 16)) {
				return substr($result, 26);
			} else {
				return '';
			}
		} else {
			return $keyc . str_replace('=', '', base64_encode($result));
		}
	}
	
	public function table()
	{
		$this->assign('now_store', $this->store);
	
		$database = D('Merchant_store_table');
		$where['store_id'] = $this->store['store_id'];
		$count = $database->where($where)->count();
		import('@.ORG.merchant_page');
		$p = new Page($count, 20);
		$list = $database->field(true)->where($where)->order('`pigcms_id` DESC')->limit($p->firstRow.','.$p->listRows)->select();
		$this->assign('list', $list);
		$this->display();
	}
	
	public function table_order()
	{
		$tableid = intval($_GET['id']);
		$database = D('Merchant_store_table');
		$condition['pigcms_id'] = $tableid;
		$now_table = $database->field(true)->where($condition)->find();
		if(empty($now_table)){
			$this->error('桌台不存在！');
		}
		$this->assign('table', $now_table);
		$this->assign('now_store', $this->store);
		$order_list = D('Meal_order')->field(true)->where(array('tableid' => $tableid, 'mer_id' => $this->store['mer_id'], 'status' => 0, 'arrive_time' => array('gt', time() - 10800)))->order('arrive_time ASC')->select();
		$this->assign('order_list', $order_list);
		$this->display();
	}
	
	/* 分类状态 */
	public function table_status()
	{
		$database = D('Merchant_store_table');
		$condition['pigcms_id'] = intval($_POST['id']);
		$now_table = $database->field(true)->where($condition)->find();
		if(empty($now_table)){
			$this->error('桌台不存在！');
		}
		$data['status'] = $_POST['type'] == 'open' ? '1' : '0';
		if($database->where($condition)->data($data)->save()){
			exit('1');
		}else{
			exit;
		}
	}
}