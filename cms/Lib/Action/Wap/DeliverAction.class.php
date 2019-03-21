<?php
/**
 * 配送员登录
 * @author yanleilei
 */
class DeliverAction extends BaseAction {
	protected $deliver_session;
	protected $item = array(
			"0" => "快店的外送",
			"1" => "外卖",
	);
	protected $deliver_supply;

    public function __construct() {
        parent::__construct();
        $this->deliver_session = session('deliver_session');
		$this->deliver_session = !empty($this->deliver_session)? unserialize($this->deliver_session): false;
        if (ACTION_NAME != 'login') {
			if(empty($this->deliver_session) && $this->is_wexin_browser && !empty($_SESSION['openid'])){
				$tmp=D('Deliver_user')->field(true)->where(array('openid'=>trim($_SESSION['openid'])))->find();
			   if(!empty($tmp)){
			     session('deliver_session', serialize($tmp));
				 $this->deliver_session = $tmp;
			   }
			}

            if (empty($this->deliver_session)) {
                redirect(U('Deliver/login', array('referer' => urlencode('http://' . $_SERVER['HTTP_HOST'] . (!empty($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'])))));
                exit();
            } else {
                $this->assign('deliver_session', $this->deliver_session);
            }
        }
        $this->assign('merchantstatic_path', $this->config['site_url'] . '/tpl/Merchant/static/');
        $this->deliver_supply = D("Deliver_supply");
        
        //查看骑士是否需要上传位置
        $where = array();
        $where['status'] = array('in', '3, 4');
//         $where['item'] = 1;
        $where['uid'] = $this->deliver_session['uid'];
        $have_send = $this->deliver_supply->field("`supply_id`")->where($where)->find();
        if ($have_send) {
        	$this->assign("have_send", true);
        } else {
        	$this->assign("have_send", false);
        }
    }
    
    /**
     * 登录
     */
    public function login() {
    	if (IS_POST) {
    		$condition_deliver_user['phone'] = trim($_POST['phone']);
    		$database_deliver_user = D('Deliver_user');
    		$now_user = $database_deliver_user->field(true)->where($condition_deliver_user)->find();
    		if (empty($now_user)) {
    			exit(json_encode(array('error' => 2, 'msg' => '帐号不存在！', 'dom_id' => 'account')));
    		}
    		if (empty($now_user['status'])) {
    			exit(json_encode(array('error' => 2, 'msg' => '此账号已冻结！', 'dom_id' => 'account')));
    		}
    		$pwd = md5(trim($_POST['pwd']));
    		if ($pwd != $now_user['pwd']) {
    			exit(json_encode(array('error' => 3, 'msg' => '密码错误！', 'dom_id' => 'pwd')));
    		}
    		$data_deliver_user['last_time'] = $_SERVER['REQUEST_TIME'];
    		if ($database_deliver_user->where(array('uid'=>$now_user['uid']))->data($data_deliver_user)->save()) {
    			session('deliver_session', serialize($now_user));
    			exit(json_encode(array('error' => 0, 'msg' => '登录成功,现在跳转~', 'dom_id' => 'account')));
    		} else {
    			exit(json_encode(array('error' => 6, 'msg' => '登录信息保存失败,请重试！', 'dom_id' => 'account')));
    		}
    	} else {
    		if($this->is_wexin_browser && !empty($_SESSION['openid'])){
    			$this->assign('openid',$_SESSION['openid']);
    		}
    		$referer=isset($_GET['referer']) ? htmlspecialchars_decode(urldecode($_GET['referer']),ENT_QUOTES) : '';
    		$this->assign('refererUrl',$referer);
    		$this->display();
    	}
    }
    
    /**
     * 绑定微信，下次免登陆
     */
    public function freeLogin(){
    	if(IS_POST && $this->is_wexin_browser && !empty($_SESSION['openid']) && is_array($this->deliver_session)){
    		$bindwx= D('Deliver_user')->where(array('uid'=>$this->deliver_session['uid']))->save(array('openid'=>trim($_SESSION['openid'])));
    		if($bindwx){
    			exit(json_encode(array('error' => 0)));
    		}else{
    			exit(json_encode(array('error' => 1)));
    		}
    	}
    	exit(json_encode(array('error' => 1)));
    }

    //抢
    public function grab() {
    	if (IS_POST) {
    		$supply_id = intval(I("supply_id"));
    		if (! $supply_id) {
    			$this->error("参数错误");exit;
    		}
    		$uid = $this->deliver_session['uid'];
    		$columns = array();
    		$columns['uid'] = $uid;
    		$columns['status'] = 2;
    		D()->startTrans();
    		$result = $this->deliver_supply->where(array("supply_id"=>$supply_id, 'status'=>1))->data($columns)->save();
    		if (false === $result) {
                D()->rollback();
    			$this->error("抢单失败");exit;
    		}
            //获取order_id
            $supply = $this->deliver_supply->find($supply_id);
            if (!$supply['order_id']) {
                D()->rollback();
                $this->error("配送信息错误");
            }
            //获取订单信息
            $order_id = $supply['order_id'];
            
            if ($supply['item'] == 1) {
	            $order = D("Waimai_order")->find($order_id);
	            if ($order['order_status'] != 3) {
	                D()->rollback();
	                $this->error("订单信息错误");exit;
	            }
	            //更新订单状态
	            $result = D("Waimai_order")->where(array('order_id'=>$order_id))->data(array('order_status'=>8))->save();
	            if (!$result) {
	                D()->rollback();
	                $this->error("更新订单信息错误");exit;
	            }
	            //添加订单日志
	            $log = array();
	            $log['status'] = 8;
				$log['order_id'] = $order_id;
				$log['store_id'] = $order['store_id'];
	            $log['uid'] = $uid;
	            $log['time'] = time();
	            $log['group'] = 4;
	            $result = D("Waimai_order_log")->add($log);
	            if (!$result) {
	                $this->error("添加订单日志失败");exit;
	                D()->rollback();
	            }
            } elseif ($supply['item'] == 0) {
            	//更新订单状态
            	$order = D("Meal_order")->where(array('order_id' => $order_id))->find();
	            if ($order['order_status'] != 3) {
	                D()->rollback();
	                $this->error("订单信息错误");exit;
	            }
	            //更新订单状态
	            $result = D("Meal_order")->where(array('order_id'=>$order_id))->data(array('order_status'=>8))->save();
	            if (!$result) {
	                D()->rollback();
	                $this->error("更新订单信息错误");exit;
	            }
            }
            
            
            
    		D()->commit();

    		$this->success("抢单成功");exit;
    	}
    	
        if (IS_AJAX) {
    		$my_lnt = I("lng");
    		//$my_lnt = 116.372612;
    		if (!$my_lnt) {
    			$this->error("获取坐标失败");
    		}
    		$my_lat = I("lat");
    		//$my_lat = 39.8185234;
    		if (!$my_lat) {
    			$this->error("获取坐标失败");
    		}

    		//error_log(date("Y-m-d H:i:s=>")."lng:$my_lnt lat:$my_lat".PHP_EOL, 3, "/work/log/debug.log");
    		$my_distance = $this->deliver_session['range'] * 1000 * 1000;
            $time = time();
            $db_array = array(
                    C('DB_PREFIX')."deliver_supply"=>"d",
                    C('DB_PREFIX')."waimai_order"=>"w"
                );
//     		$where = "d.`appoint_time`<$time AND d.`status`=1 AND d.`item`=1 AND ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$my_lat}*PI()/180-d.`from_lat`*PI()/180)/2),2)+COS({$my_lat}*PI()/180)*COS(d.`from_lat`*PI()/180)*POW(SIN(({$my_lnt}*PI()/180-d.`from_lnt`*PI()/180)/2),2)))*1000) < $my_distance AND w.`order_id`=d.`order_id`";
//     		$fields = "w.`pay_type`,d.`supply_id`,d.`name`,d.`phone`,d.`from_site`,d.`aim_site`,ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$my_lat}*PI()/180-d.`from_lat`*PI()/180)/2),2)+COS({$my_lat}*PI()/180)*COS(d.`from_lat`*PI()/180)*POW(SIN(({$my_lnt}*PI()/180-d.`from_lnt`*PI()/180)/2),2)))*1000) AS distance, d.`from_lat`, d.`from_lnt`";
//     		if ($this->deliver_session['group'] == 2 && $this->deliver_session['store_id']) {
//     			$where = "d.`type`= 1 AND d.`store_id`=".$this->deliver_session['store_id']." AND ".$where;
//     		} else {
//                 $where = "d.`type`= 0 AND ".$where;
//             }
    		$where = "`appoint_time`<$time AND `status`=1 AND ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$my_lat}*PI()/180-`from_lat`*PI()/180)/2),2)+COS({$my_lat}*PI()/180)*COS(`from_lat`*PI()/180)*POW(SIN(({$my_lnt}*PI()/180-`from_lnt`*PI()/180)/2),2)))*1000) < $my_distance ";
    		$fields = "*,ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$my_lat}*PI()/180-`from_lat`*PI()/180)/2),2)+COS({$my_lat}*PI()/180)*COS(`from_lat`*PI()/180)*POW(SIN(({$my_lnt}*PI()/180-`from_lnt`*PI()/180)/2),2)))*1000) AS distance";
    		if ($this->deliver_session['group'] == 2 && $this->deliver_session['store_id']) {
    			$where = "`type`= 1 AND `store_id`=" . $this->deliver_session['store_id'] . " AND " . $where;
    		} else {
                $where = "`type`= 0 AND " . $where;
            }
//     		$list = D()->table($db_array)->field($fields)->where($where)->order("d.`create_time` DESC")->select();
    		$list = D("Deliver_supply")->field($fields)->where($where)->order("`create_time` DESC")->select();
//     		echo D("Deliver_supply")->_sql();die;
            foreach ($list as $key=>$val) {
                switch ($val['pay_type']) {
                    case 'offline':
                        $list[$key]['pay_method'] = '线下支付'; break;
                    default:
                    	if ($val['paid']) {
                    		$list[$key]['pay_method'] = '在线支付'; break;
                    	} else {
                    		$list[$key]['pay_method'] = '未支付'; break;
                    	}
                        
                }
            }
    		if (false === $list) {
    			$this->error("系统错误");exit;
    		}
    		//error_log(date("Y-m-d H:i:s=>").json_encode($list).PHP_EOL, 3, "/work/log/debug.log");
    		$this->ajaxReturn(array('status'=>1, 'list'=>$list));exit;
    	}
    	
    	$this->display();
    }
    //取
    public function pick() {
    	$uid = $this->deliver_session['uid'];
    	if (IS_POST) {
    		$supply_id = intval(I("supply_id"));
    		if (! $supply_id) {
    			$this->error("参数错误");exit;
    		}
    		//获取order_id
    		$supply = $this->deliver_supply->find($supply_id);
    		if (!$supply['order_id']) {
    			$this->error("配送信息错误");
    		}
    		$order_id = $supply['order_id'];
    		
    		D()->startTrans();
    		$columns = array();
    		$columns['uid'] = $uid;
    		$columns['status'] = 3;
    		$columns['start_time'] = time();
    		$result = $this->deliver_supply->where(array("supply_id"=>$supply_id, 'status'=>2))->data($columns)->save();
    		if (false === $result) {
    			$this->error("更新状态失败");exit;
    		}
    		if ($supply['item'] == 1) {
	            //获取订单信息
	            $order = D("Waimai_order")->find($order_id);
	            if (!$order) {
	                $this->error("订单信息错误");
	            }
	
	    		//更新订单状态
	    		$result = D("Waimai_order")->where(array('order_id'=>$order_id))->data(array('order_status'=>4))->save();
	    		if (!$result) {
	    			D()->rollback();
	    			$this->error("更新订单信息错误");exit;
	    		}
	            //添加订单日志
	            $log = array();
				$log['status'] = 4;
				$log['order_id'] = $order_id;
	            $log['store_id'] = $order['store_id'];
	            $log['uid'] = $uid;
	            $log['time'] = time();
	            $log['group'] = 4;
	            $result = D("Waimai_order_log")->add($log);
	            if (!$result) {
	                $this->error("添加订单日志失败");exit;
	                D()->rollback();
	            }
            } elseif ($supply['item'] == 0) {
            	//更新订单状态
            	$result = D("Meal_order")->where(array('order_id' => $order_id))->data(array('order_status' => 4))->save();
            	if (!$result) {
            		D()->rollback();
            		$this->error("更新订单信息错误");exit;
            	}
            }
    		D()->commit();
    		
    			
    		
    		$this->success("更新状态成功");exit;
    	}
    	$where = array();
    	$where['status'] = 2;
//     	$where['item'] = 1;
    	$where['uid'] = $uid;
    	if ($this->deliver_session['group'] == 2 && $this->deliver_session['store_id']) {
    		$where['store_id'] = $this->deliver_session['store_id'];
    	}
    	$list = $this->deliver_supply->field(true)->where($where)->order("`create_time` DESC")->select();
    	if (false === $list) {
    		$this->error("系统错误");exit;
    	}
    	$this->assign('list', $list);
    	$this->display();
    }
    //送
    public function send() {
    	$uid = $this->deliver_session['uid'];
    	if (IS_POST) {
    		$supply_id = intval(I("supply_id"));
    		if (! $supply_id) {
    			$this->error("参数错误");exit;
    		}
    		//获取order_id
    		$supply = $this->deliver_supply->find($supply_id);
    		if (!$supply['order_id']) {
    			$this->error("配送信息错误");
    		}
    		$order_id = $supply['order_id'];
    		
    		D()->startTrans();
    		$columns = array();
    		$columns['uid'] = $uid;
    		$columns['status'] = 4;
    		//$columns['end_time'] = time();
    		$result = $this->deliver_supply->where(array("supply_id"=>$supply_id, 'status'=>3))->data($columns)->save();
    		if (false === $result) {
    			$this->error("更新状态失败");exit;
    		}
    		if ($supply['item'] == 1) {
	            //获取订单信息
	            $order = D("Waimai_order")->find($order_id);
	            if (!$order) {
	                $this->error("订单信息错误");
	            }
	    		
	    		//更新订单状态
	    		$result = D("Waimai_order")->where(array('order_id'=>$order_id))->data(array('order_status'=>5))->save();
	    		if (!$result) {
	    			D()->rollback();
	    			$this->error("更新订单信息错误");exit;
	    		}
	            //添加订单日志
	            $log = array();
	            $log['status'] = 5;
				$log['order_id'] = $order_id;
				$log['store_id'] = $order['store_id'];
	            $log['uid'] = $uid;
	            $log['time'] = time();
	            $log['group'] = 4;
	            $result = D("Waimai_order_log")->add($log);
	            if (!$result) {
	                $this->error("添加订单日志失败");exit;
	                D()->rollback();
	            }
    		} elseif ($supply['item'] == 0) {
            	//更新订单状态
            	$result = D("Meal_order")->where(array('order_id' => $order_id))->data(array('order_status' => 5))->save();
            	if (!$result) {
            		D()->rollback();
            		$this->error("更新订单信息错误");exit;
            	}
    		}
    		D()->commit();

    		$this->success("更新状态成功");exit;
    	}
    	$where = array();
    	$where['status'] = 3;
//     	$where['item'] = 1;
    	$where['uid'] = $uid;
    	if ($this->deliver_session['group'] == 2 && $this->deliver_session['store_id']) {
    		$where['store_id'] = $this->deliver_session['store_id'];
    	}
    	$list = $this->deliver_supply->field(true)->where($where)->order("`create_time` DESC")->select();
    	if (false === $list) {
    		$this->error("系统错误");exit;
    	}
    	$this->assign('list', $list);
    	$this->display();
    }
    //我的
    public function my() {
    	$uid = $this->deliver_session['uid'];
    	if (IS_POST) {
    		$supply_id = intval(I("supply_id"));
    		if (! $supply_id) {
    			$this->error("参数错误");exit;
    		}
    		//获取order_id
    		$supply = $this->deliver_supply->find($supply_id);
    		if (!$supply['order_id']) {
    			$this->error("配送信息错误");
    		}
    		$order_id = $supply['order_id'];
    		
    		D()->startTrans();
    		$columns = array();
    		$columns['uid'] = $uid;
    		$columns['status'] = 5;
    		$columns['end_time'] = time();
    		$result = $this->deliver_supply->where(array("supply_id"=>$supply_id, 'status'=>4))->data($columns)->save();
    		if (false === $result) {
    			$this->error("更新状态失败");exit;
    		}
    		
    		if ($supply['item'] == 1) {
			
	            //获取订单信息
	            $order = D("Waimai_order")->find($order_id);
	            if (!$order) {
	                $this->error("订单信息错误");
	            }
	    		
	    		//更新订单状态
	    		$result = D("Waimai_order")->where(array('order_id'=>$order_id))->data(array('order_status'=>1))->save();
	    		if (!$result) {
	    			D()->rollback();
	    			$this->error("更新订单信息错误");exit;
	    		}
	            //添加订单日志
	            $log = array();
	            $log['status'] = 1;
				$log['order_id'] = $order_id;
				$log['store_id'] = $order['store_id'];
	            $log['uid'] = $uid;
	            $log['time'] = time();
	            $log['group'] = 4;
	            $result = D("Waimai_order_log")->add($log);
	            if (!$result) {
	                $this->error("添加订单日志失败");exit;
	                D()->rollback();
	            }
            
    		} elseif ($supply['item'] == 0) {
            	//更新订单状态//获取订单信息
	            $order = D("Meal_order")->field(true)->where(array('order_id' => $order_id))->find();
	            if (!$order) {
	                $this->error("订单信息错误");
	            }
	            $data = array('order_status' => 1, 'status' => 1);
	            if ($order['paid'] == 0) {
	            	$data['paid'] = 1;
	            	if (empty($data['pay_type']) && empty($data['pay_time'])) $data['pay_type'] = 'offline';
	            	if (empty($data['pay_time'])) $data['pay_time'] = time();
	            }
            	$result = D("Meal_order")->where(array('order_id' => $order_id))->data($data)->save();
            	if (!$result) {
            		D()->rollback();
            		$this->error("更新订单信息错误");exit;
            	}
    		}
            
    		D()->commit();

    		$this->success("更新状态成功");exit;
    	}
    	$where = array();
    	$where['status'] = array('in', array(4, 5));
//     	$where['item'] = 1;
    	$where['uid'] = $uid;
    	if ($this->deliver_session['group'] == 2 && $this->deliver_session['store_id']) {
    		$where['store_id'] = $this->deliver_session['store_id'];
    	}
    	$list = $this->deliver_supply->field(true)->where($where)->order("`status` ASC,`create_time` DESC")->select();
    	if (false === $list) {
    		$this->error("系统错误");exit;
    	}

    	$this->assign('list', $list);
    	$this->display();
    }

	public function detail() {
		$uid = $this->deliver_session['uid'];
		$supply_id = intval(I("supply_id"));
		if (! $supply_id) {
			$this->error_tips("参数错误");
		}
		$where = array();
		$where['uid'] = $uid;
		$where['supply_id'] = $supply_id;
// 		$where['item'] = 1;
		$supply = D("Deliver_supply")->where($where)->find();
		if (! $supply) {
			$this->error_tips("配送源不存在");
		}
		$this->assign('supply', $supply);
		
		if ($supply['item'] == 1) {
			//订单信息
			$where = array();
			$where['order_id'] = $supply['order_id'];
			$order = D("Waimai_order")->where($where)->find();
			if (! $order) {
				$this->error_tips("订单信息有误");
			}
			$pay_method = D('Config')->get_pay_method();
			$order['pay_type'] = $pay_method[$order['pay_type']]['name'];
			$this->assign('order', $order);
			//商品信息
			$goods = D()->field(true)->table(array(C('DB_PREFIX').'waimai_sell_log'=>'sl', C('DB_PREFIX').'waimai_goods'=>'wg'))->where("sl.order_id=".$supply['order_id']." AND sl.goods_id=wg.goods_id")->select();
			$this->assign('goods', $goods);
	
			//店铺信息
			$store = D()->field(true)->table(array(C('DB_PREFIX').'merchant_store'=>'ms', C('DB_PREFIX').'waimai_store'=>'ws'))->where("ms.store_id=".$order['store_id']." AND ms.store_id=ws.store_id")->find();
			if (! $store) {
				$this->error_tips("店铺信息有误");
			}
			if ($store['total_money'] <= 0) {
				$store['send_money'] = $store['send_money'];
			} else {
				$store['send_money'] = $order['price'] > $store['total_money']? 0: $store['send_money'];
			}
			$store['tools_money'] = 0;
			if ($store['tools_money_have'] == 1) {
				foreach ($goods as $v) {
					$store['tools_money'] += $v['tools_price'] * $v['num'];
				}
			}
			$this->assign('store', $store);
	
			//红包信息
			$where = array();
			$where['id'] = $order['coupon_id'];
			$couponInfo = D("Waimai_user_coupon")->field(true)->where($where)->find();
			$this->assign('couponInfo', $couponInfo);
			//优惠信息
			$discountInfo = json_decode($order['discount_detail'], true);
			$this->assign('discountInfo', $discountInfo);
		
		} elseif ($supply['item'] == 0) {
			//订单信息
			$where = array();
			$where['order_id'] = $supply['order_id'];
			$order = D("Meal_order")->where($where)->find();
			if (! $order) {
				$this->error_tips("订单信息有误");
			}
			$pay_method = D('Config')->get_pay_method();
			$order['pay_type'] = $pay_method[$order['pay_type']]['name'];
			$order['discount_price'] = $order['price'];
			$this->assign('order', $order);
			$goods = unserialize($order['info']);
			foreach ($goods as &$g) {
				$g['tools_money'] = 0;
			}
			$this->assign('goods', $goods);
			//店铺信息
			$store = D()->field(true)->table(array(C('DB_PREFIX').'merchant_store'=>'ms', C('DB_PREFIX').'merchant_store_meal'=>'ml'))->where("ms.store_id=".$order['store_id']." AND ms.store_id=ml.store_id")->find();
			if (!$store) {
				$this->error_tips("店铺信息有误");
			}
			if ($store['total_money'] <= 0) {
				$store['send_money'] = $store['send_money'];
			} else {
				$store['send_money'] = $order['price'] > $store['total_money']? 0: $store['send_money'];
			}
			$store['tools_money'] = 0;
			if ($store['tools_money_have'] == 1) {
				foreach ($goods as $v) {
					$store['tools_money'] += $v['tools_price'] * $v['num'];
				}
			}
			$this->assign('store', $store);
		}
		
		
		$this->display();
	}
    //上传位置
    public  function location() {
    	error_log(date("Y-m-d H:i:s=>").json_encode($_POST).PHP_EOL, 3, "/work/log/debug.log");
	    $lng = I("lng");
	    if (!$lng) {
	    	$this->error("获取坐标失败");
	    }
	    $lat = I("lat");
	    if (!$lat) {
	    	$this->error("获取坐标失败");
	    }
	    $uid = $this->deliver_session['uid'];
	    
	    $columns = array();
	    $columns['uid'] = $uid;
	    $columns['lng'] = $lng;
	    $columns['lat'] = $lat;
	    $columns['create_time'] = time();
	    
	    $result = D("Deliver_user_location_log")->add($columns);
	    error_log(date("Y-m-d H:i:s=>").json_encode($result).PHP_EOL, 3, "/work/log/debug.log");
	    if (!$result) {
	    	$this->error("位置查找失败");
	    }
	    $this->success("位置上传成功");
    }

    //位置导航
    public function map() {
        $supply_id = I("supply_id", 0, 'intval');
        if (! $supply_id) {
            $this->error("SupplyId不能为空");
        }
        $supply = D("Deliver_supply")->where(array('supply_id'=>$supply_id))->find();
        if (! $supply) {
            $this->error("配送源不存在");
        }
        $this->assign('supply', $supply);
        $this->display();
    }
}