<?php

/*
 * 用户中心
 *
 * @  Writers    yanleilei
 * @  BuildTime  2015/8/18 18:25
 * 
 */

class DeliverAction extends BaseAction {
	protected $deliver_user, $deliver_store, $deliver_location, $deliver_supply;
	
	protected function _initialize() {
		parent::_initialize();
		$this->deliver_user = D("Deliver_user");
		$this->deliver_store = D("Deliver_store");
		$this->deliver_location = D("Deliver_location");
		$this->deliver_supply = D("Deliver_supply");
	}
	/**
	 * 配送员列表
	 */
    public function user() {
        $condition_user['mer_id'] = $this->merchant_session['mer_id'];
        $condition_user['group'] = 2;
        $count_user = $this->deliver_user->where($condition_user)->count();
        import('@.ORG.system_page');
        $p = new Page($count_user, 15);
        $user_list = $this->deliver_user->field(true)->where($condition_user)->order('`uid` DESC')->limit($p->firstRow . ',' . $p->listRows)->select();
        
        $storeInfoNew = array();
        if(count($user_list)>0){
        	foreach ($user_list as $uinfo){
        		$store_id[$uinfo['store_id']] = $uinfo['store_id'];
        	}
        	$store_ids = join(',', $store_id);
        	$storeInfos = D('merchant_store')->field('name,store_id')->where(array('store_id'=>array('in',$store_ids)))->select();
        	foreach ($storeInfos as $storeOne){
        		$storeInfoNew[$storeOne['store_id']] = $storeOne;
        	}
        }
 
        $this->assign('storeInfoNew',$storeInfoNew);
        $this->assign('user_list', $user_list);
        $pagebar = $p->show();
        $this->assign('pagebar', $pagebar);
        $this->display();
    }
    
    /**
     * 配送员添加
     */
    public function user_add() {
    	$mer_id = $this->merchant_session['mer_id'];
    	if($_POST){
    		$column['name'] = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
    		$column['phone'] = isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '';
    		$column['pwd'] = isset($_POST['pwd']) ? htmlspecialchars($_POST['pwd']) : '';
    		$column['mer_id'] = $mer_id;
    		$column['store_id'] = $_POST['store_id'];
    		$column['city_id'] = $_POST['city_id'];
    		$column['province_id'] = $_POST['province_id'];
    		$column['circle_id'] = $_POST['circle_id'];
    		$column['area_id'] = $_POST['area_id'];
    		$column['site'] = $_POST['adress'];
    		$long_lat = explode(',',$_POST['long_lat']);
    		$column['lng'] = $long_lat[0];
    		$column['lat'] = $long_lat[1];
    		$column['create_time'] = $_SERVER['REQUEST_TIME'];
    		$column['status'] = intval($_POST['status']);
    		$column['last_time'] = $_SERVER['REQUEST_TIME'];
    		$column['group'] = 2;
    		$column['range'] = intval($_POST['range']);
    		if (empty($column['name'])) {
    			$this->error('姓名不能为空');
    		}
    		if (empty($column['phone'])) {
    			$this->error('联系电话不能为空');
    		}
    		if (empty($column['pwd'])) {
    			$this->error('密码不能为空');
    		}
    		$column['pwd'] = md5($column['pwd']);
    		if (D('Deliver_user')->field(true)->where(array('phone' => $column['phone']))->find()) {
    			$this->error('该手机号已经是配送员账号了，不能重复申请');
    		}
    		$id = D('Deliver_user')->data($column)->add();
    		
    		if(!$id){
    			$this->error('保存失败，请重试');
    		}
    		$this->success('保存成功');
    	}else{
    		// 该商家下的所有外卖店铺
    		$merstore['mer_id'] = $mer_id;
    		$merstore['have_waimai'] = 1;
    		$waimai_store = D('merchant_store')->where($merstore)->order('sort DESC')->select();
    		$this->assign('waimai_store',$waimai_store);
    	}
    	
    	$this->display();
    }
    
    /**
     * 配送员修改
     */
    public function user_edit() {
    	$mer_id = $this->merchant_session['mer_id'];
    	if($_POST){
    		$uid = intval($_POST['uid']);
    		$column['name'] = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
    		$column['phone'] = isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '';
    		$column['pwd'] = isset($_POST['pwd']) ? htmlspecialchars($_POST['pwd']) : '';
    		$column['store_id'] = $_POST['store_id'];
    		if($column['pwd']){
    			$column['pwd'] = md5($column['pwd']);
    		} else {
    			unset($column['pwd']);
    		}
    		$column['city_id'] = $_POST['city_id'];
    		$column['province_id'] = $_POST['province_id'];
    		$column['circle_id'] = $_POST['circle_id'];
    		$column['area_id'] = $_POST['area_id'];
    		$column['site'] = $_POST['adress'];
    		$long_lat = explode(',',$_POST['long_lat']);
    		$column['lng'] = $long_lat[0];
    		$column['lat'] = $long_lat[1];
    		$column['status'] = intval($_POST['status']);
    		$column['range'] = intval($_POST['range']);
    		$column['last_time'] = $_SERVER['REQUEST_TIME'];
    		if (empty($column['name'])) {
    			$this->error('姓名不能为空');
    		}
    		if (empty($column['phone'])) {
    			$this->error('联系电话不能为空');
    		}
    		$user = D('Deliver_user')->field(true)->where(array('phone' => $column['phone']))->find();
    		if ($user && $user['uid'] != $uid) {
    			$this->error('该手机号已经是配送员账号了，不能重复申请');
    		}
    		
    		if(D('deliver_user')->where(array('uid'=>$uid,'mer_id'=>$mer_id))->data($column)->save()){
    			$this->success('修改成功！');
    		}else{
    			$this->error('修改失败！请检查内容是否有过修改（必须修改）后重试~');
    		}
    	}else{
    		$uid = $_GET['uid'];
    		if(!$uid){
    			$this->error('非法操作');
    		}
    		$deliver = D('deliver_user')->where(array('uid'=>$uid,'mer_id'=>$mer_id))->find();
    		if(!$deliver){
    			$this->error('非法操作');
    		}
    		$this->assign('now_user',$deliver);
    		
    		$merstore['mer_id'] = $mer_id;
    		$merstore['have_waimai'] = 1;
    		$waimai_store = D('merchant_store')->where($merstore)->order('sort DESC')->select();
    		$this->assign('waimai_store',$waimai_store);
    	}
    	$this->display();
    }
    
    public function user_del(){
    	$uid = $_GET['uid'];
    	if(!$uid){
    		$this->error('非法操作');
    	}
    	$mer_id = $this->merchant_session['mer_id'];
    	$condition_user['mer_id'] = $mer_id;
    	$condition_user['uid'] = $uid;
    	$count_user = $this->deliver_user->where($condition_user)->find();
    	if(!$count_user){
    		$this->error('非法操作');
    	}
    	
    	$result = $this->deliver_user->where($condition_user)->save(array('status'=>0));
    	if(!$result){
    		$this->error('删除失败，请稍后重试');
    	}
    	$this->success('操作成功');
    }

    //配送列表
    public  function deliverList()
    {
        $selectStoreId = I("selectStoreId", 0, "intval");
        $selectUserId = I("selectUserId", 0, "intval");
        $phone = I("phone", 0);
        $orderNum = I("orderNum", 0);

        $mer_id = $this->merchant_session['mer_id'];
        //获取商家店铺ID
        $stores = D("Merchant_store")->field(true)->where(array('mer_id'=>$mer_id, 'have_waimai'=>1, 'status'=>1))->select();
        $storeIds = array();
        foreach ($stores as $val) {
            $storeIds[] = $val['store_id'];
        }

        if ($selectStoreId && !in_array($selectStoreId, $storeIds)) {
            $this->error("参数出错");
        }
        //获取商家的所有配送员
        $delivers = D("Deliver_user")->field(true)->where(array('mer_id'=>$mer_id))->order('status DESC')->select();
        foreach ($delivers as $key => $val) {
            if ($val['status'] == 0) {
                $delivers[$key]['name'] = $val['name']." (已禁用)";
            }
        }
        
        $db_arr = array(C('DB_PREFIX').'deliver_supply'=>'s',C('DB_PREFIX').'deliver_user'=>'u',C('DB_PREFIX').'merchant_store'=>'m');
        $fields = "s.order_id, s.name as username, s.phone as userphone, m.name as storename, s.money, u.name, u.phone, s.start_time, s.end_time, s.create_time, s.aim_site, s.pay_type, s.paid, s.status, u.group";
        $where = 'm.store_id=s.store_id AND s.uid=u.uid';
        if ($phone) {
            $where .= " AND s.phone=".$phone;
        }
        if ($orderNum) {
            $where .= " AND o.order_number=".$orderNum;
        }
        if ($selectStoreId) {
            $where .= " AND s.store_id=".$selectStoreId;
        }
        if ($selectUserId) {
            $where .= "  AND u.mer_id=$mer_id AND s.uid=".$selectUserId;
        }
        if (!($selectStoreId || $selectUserId || $phone || $orderNum)) {
            $where .= ' AND s.store_id in ('.implode(",", $storeIds).')';
        }
        
        import('@.ORG.merchant_page');
        $count_order = D()->table($db_arr)->where($where)->count();
        $p = new Page($count_order, 20);
        $supply_info = D()->table($db_arr)->field($fields)->where($where)->order('s.`order_id` DESC')->limit($p->firstRow.','.$p->listRows)->select();
        foreach ($supply_info as $key => $value) {
            $supply_info[$key]['create_time'] = date("Y-m-d H:i:s", $value['create_time']);
            if ($value['start_time']) {
                $supply_info[$key]['start_time'] = date("Y-m-d H:i:s", $value['start_time']);
            } else {
                $supply_info[$key]['start_time'] = '-';
            }
            if ($value['end_time']) {
                $supply_info[$key]['end_time'] = date("Y-m-d H:i:s", $value['end_time']);
            } else {
                $supply_info[$key]['end_time'] = '-';
            }
            $supply_info[$key]['paid'] = $value['paid'] == 1? "已支付": "未支付";
            $supply_info[$key]['group'] = $value['group'] == 1? "平台配送员": "店铺配送员";
            $supply_info[$key]['pay_type'] = $value['pay_type'] == "offline"? "线下支付": "线上支付";
            //订单状态（0：订单失效，1:订单完成，2：商家未确认，3：商家已确认，4已取餐，5：正在配送，6：退单,7商家取消订单,8配送员已接单）
            //配送状态(0失败 1等待接单 2接单 3取货 4开始配送 5完成）
            switch ($value['status']) {
                case 1:
                    $supply_info[$key]['status'] = "等待接单";
                    break;
                case 2:
                    $supply_info[$key]['status'] = "已接单";
                    break;
                case 3:
                    $supply_info[$key]['status'] = "已取货";
                    break;
                case 4:
                    $supply_info[$key]['status'] = "开始配送";
                    break;
                case 5:
                    $supply_info[$key]['status'] = "完成配送";
                    break;
                case 6:
                    $supply_info[$key]['status'] = "已退单";
                    break;
                case 7:
                    $supply_info[$key]['status'] = "已取消";
                    break;
                case 68:
                    $supply_info[$key]['status'] = "已接单";
                default:
                    $supply_info[$key]['status'] = "订单失效";
                    break;
            }
        }
        $pagebar = $p->show();
        $this->assign('selectStoreId', $selectStoreId);
        $this->assign('phone', $phone);
        $this->assign('orderNum', $orderNum);
        $this->assign('selectUserId', $selectUserId);
        $this->assign('stores', $stores);
        $this->assign('delivers', $delivers);
        $this->assign('pagebar', $pagebar);
        $this->assign('supply_info', $supply_info);

        $this->display();
    }
}