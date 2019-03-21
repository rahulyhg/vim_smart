<?php
class IndexAction extends BaseAction {
    protected $merchant_session;
    protected $store;
    protected $meal_orderDb;
    protected $group_orderDb;
    protected $merid;
    protected function _initialize() {
        parent::_initialize();
        $this->merchant_session = session('merchant_session');
        $this->merchant_session = !empty($this->merchant_session) && !is_array($this->merchant_session) ? unserialize($this->merchant_session) : array();
        if (!in_array(ACTION_NAME, array('login', 'merreg', 'mer_reg', 'verify','wxlogin'))) {
            if (empty($this->merchant_session)) {
                redirect(U('Index/login', array('referer' => urlencode('http://' . $_SERVER['HTTP_HOST'] . (!empty($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'])))));
                exit();
            }
            //$this->check_merchant_file();
            //$this->init_opt();
        }
        $this->merid = $this->merchant_session['mer_id'];
        $this->meal_orderDb = M('Meal_order');
        $this->group_orderDb = M('Group_order');
        $this->get_commonInfo();
        $this->getallordercount();
        $this->assign('merid', $this->merid);
		$this->assign('mer_name', $this->merchant_session['name']);
        $img = $this->merchant_session['img_info'];
        $merchant_image_class = new merchant_image();
        $mer_img=$merchant_image_class->get_image_by_path($img);
        $this->assign('mer_img', $mer_img);
        $this->assign('site_URl', trim($this->config['site_url'], '/'));
        $this->assign('merchantstatic_path', $this->config['site_url'] . '/tpl/Merchant/static/');
    }
	
    public function index() {
        /**  商家数据统计 * */
        /*
          //未处理订单数量
          $pigcms_data['card_count'] = M('Member_card_create')->where(array('token' => $mer_id, 'wecha_id' => array('neq', '')))->count();
          //未结束的钱
          $pigcms_data['lottery_count'] = M('Lottery')->where(array('mer_id' => $mer_id))->count();
          //店铺浏览量
          $pigcms_data['store_count'] = M('Merchant_store')->where(array('mer_id' => $mer_id))->count();
         */
		session('is_Merchant','merchant');	//商户中心标示
        $allincomecount = $this->getallincomecount();
        $this->assign('allincomecount', $allincomecount);
        $wap_MerchantAd = D('Adver')->get_adver_by_key('wap_Merchant', 7);
        $this->assign('wap_MerchantAd', $wap_MerchantAd);
        $this->assign('webviwe', $this->merchant_session['hits']);
        $this->display();
    }
	
    private function get_commonInfo() {
        //粉丝数量
        $fans_count = M('')->table(array(C('DB_PREFIX') . 'merchant_user_relation' => 'm', C('DB_PREFIX') . 'user' => 'u'))->where("`m`.`openid`=`u`.`openid` AND `m`.`mer_id`='$this->merid'")->count();
        $this->assign('fans_count', $fans_count);
    }
	
    private function getallordercount() {
        $meal_order_all = $this->meal_orderDb->where(array('mer_id' => $this->merid, 'status' => array('neq', 3)))->count();
        $nowtime = time();
        $todaystartime = strtotime(date('Y-m-d'));
        $monthstartime = strtotime(date('Y-m') . '-01 00:00:00');
        $meal_order_m = $this->meal_orderDb->where('mer_id=' . $this->merid . ' AND status!=3 AND dateline >' . $monthstartime . ' AND dateline <=' . $nowtime)->count();
        $meal_order_d = $this->meal_orderDb->where('mer_id=' . $this->merid . ' AND status!=3 AND dateline >' . $todaystartime . ' AND dateline <=' . $nowtime)->count();
        $group_order_all = $this->group_orderDb->where(array('mer_id' => $this->merid, 'status' => array('neq', 3)))->count();
        $group_order_m = $this->group_orderDb->where('mer_id=' . $this->merid . ' AND status!=3 AND add_time >' . $monthstartime . ' AND add_time <=' . $nowtime)->count();
        $group_order_d = $this->group_orderDb->where('mer_id=' . $this->merid . ' AND status!=3 AND add_time >' . $todaystartime . ' AND add_time <=' . $nowtime)->count();
        $this->assign('allordercount', intval($meal_order_all + $group_order_all));
        $this->assign('monthordercount', intval($meal_order_m + $group_order_m));
        $this->assign('todayordercount', intval($meal_order_d + $group_order_d));
    }
	
    private function getallincomecount() {
        $tmp_m_price = $this->meal_orderDb->where('mer_id=' . $this->merid . ' AND paid="1" AND status != 3')->field('sum(if(total_price>0,total_price,price)) as tprice,sum(minus_price) as offprice')->find();
        $tmp_m_price['tprice'] = number_format($tmp_m_price['tprice'],2, '.', '');//快餐实际总金额，应该要去掉已退款的
		$tmp_m_price['offprice'] = number_format($tmp_m_price['offprice'],2, '.', '');//快餐优惠总金额

        $meal_price = $tmp_m_price['tprice'] - $tmp_m_price['offprice'];
        $tmp_g_price = $this->group_orderDb->where('mer_id=' . $this->merid . ' AND paid="1" AND status != 3')->field('sum(total_money) as tprice,sum(wx_cheap) as offprice')->find();//团购
        $group_price = $tmp_g_price['tprice'] - $tmp_g_price['offprice'];
        $arr['payall'] = $meal_price + $group_price;//支付总金额；
        $arr['coupon'] = $tmp_m_price['offprice']+$tmp_g_price['offprice'];//优惠总金额
        $arr['actualall'] = $tmp_m_price['tprice']+$tmp_g_price['tprice'];//实际收入总金额
        return ($arr);
    }
	
    /*     * *首页图标统计数据*** */
    public function getchart() {
        $nowtime = time();
        $todaystartime = strtotime(date('Y-m-d'));
        $startime = $todaystartime - (7 * 24 * 3600);
        $action = trim($_POST['act']);
        $newdatas = array();
        for ($d = 0; $d < 8; $d++) {
            $datekey = date('m-d', $startime + $d * 24 * 3600);
            $newdatas[$datekey] = 0;
        }
        switch ($action) {
            case 'order' :
                $mdatas = $this->meal_orderDb->where('mer_id=' . $this->merchant_session['mer_id'] . ' AND dateline >' . $startime . ' AND dateline <=' . $nowtime . " AND status!=3")->field('count(order_id) as percount,FROM_UNIXTIME(dateline,"%m-%d") as perdate')->group('perdate')->select();
                foreach ($mdatas as $mvv) {
                    $newdatas[$mvv['perdate']] = $mvv['percount'];
                }
                unset($mdatas);
                $gdatas = $this->group_orderDb->where('mer_id=' . $this->merchant_session['mer_id'] . ' AND add_time  >' . $startime . ' AND add_time  <=' . $nowtime . " AND status!=3")->field('count(order_id) as percount,FROM_UNIXTIME(add_time,"%m-%d") as perdate')->group('perdate')->select();
                foreach ($gdatas as $gvv) {
                    $newdatas[$gvv['perdate']] = isset($newdatas[$gvv['perdate']]) ? $newdatas[$gvv['perdate']] + $gvv['percount'] : $gvv['percount'];
                }
                break;
            case 'income' :
                $mdatas = $this->meal_orderDb->where('mer_id=' . $this->merchant_session['mer_id'] . ' AND paid="1" AND dateline >' . $startime . ' AND dateline <=' . $nowtime . " AND status!=3")->field('sum(if(total_price>0,total_price,price)) as tprice,sum(minus_price) as offprice,FROM_UNIXTIME(dateline,"%m-%d") as perdate')->group('perdate')->select();
                if (!empty($mdatas)) {
                    foreach ($mdatas as $mvv) {
                        $newdatas[$mvv['perdate']] = $mvv['tprice'] - $mvv['offprice'];
                    }
                }
                unset($mdatas);
                $gdatas = $this->group_orderDb->where('mer_id=' . $this->merchant_session['mer_id'] . ' AND paid="1" AND add_time  >' . $startime . ' AND add_time  <=' . $nowtime . " AND status!=3")->field('sum(total_money) as tprice,sum(wx_cheap) as offprice,FROM_UNIXTIME(add_time,"%m-%d") as perdate')->group('perdate')->select();
                if (!empty($gdatas)) {
                    foreach ($gdatas as $gvv) {
                        $perprice = $gvv['tprice'] - $gvv['offprice'];
                        $newdatas[$gvv['perdate']] = isset($newdatas[$gvv['perdate']]) ? $newdatas[$gvv['perdate']] + $perprice : $perprice;
                    }
                }
                break;
            case 'member' :
                $fansdata = M('')->table(array(C('DB_PREFIX') . 'merchant_user_relation' => 'm', C('DB_PREFIX') . 'user' => 'u'))->where("`m`.`openid`=`u`.`openid` AND `m`.`mer_id`='" . $this->merchant_session['mer_id'] . "' AND dateline >" . $startime . " AND dateline <=" . $nowtime)->field('count(dateline) as percount,FROM_UNIXTIME(dateline,"%m-%d") as perdate')->group('perdate')->select();
                if (!empty($fansdata)) {
                    foreach ($fansdata as $fvv) {
                        $newdatas[$fvv['perdate']] = $fvv['percount'];
                    }
                }
                break;
            default:
                break;
        }
        $this->dexit(array('key' => array_keys($newdatas), 'value' => array_values($newdatas)));
    }
	
    public function ordermang() {
        $this->display();
    }
	
    public function gorder() {
        if (IS_AJAX) {
            $mer_id = $this->merchant_session['mer_id'];
            $status = isset($_POST['status']) ? trim($_POST['status']) : 'all';
            $keyword = isset($_POST['keyword']) ? trim($_POST['keyword']) : '';
            $where = 'gord.mer_id=' . $mer_id;
            if ($status != 'all') {
                $status = intval($status);
                if ($status == 0) {
                    $where.=' AND (gord.paid="0" OR (gord.third_id ="0" AND gord.pay_type="offline"))';
                } else {
                    $where.=' AND gord.status="' . ($status - 1) . '"';
                }
            }
            if (!empty($keyword)) {
                $where.=' AND (gord.phone like "%' . $keyword . '%" OR u.nickname like "%' . $keyword . '%" OR u.truename like "%' . $keyword . '%")';
            }
            /* //团购列表
              $now_group = D('Group')->get_group_by_groupId($group_id);
              if (empty($now_group)) {
              $this->error_tips('当前' . $this->config['group_alias_name'] . '不存在！');
              }
              $this->assign('now_group', $now_group); */
            //订单列表
            $order_count = $this->group_orderDb->where($where)->count();
            $pindex = intval(trim($_POST['pindex']));
            $pindex = $pindex > 0 ? $pindex : 1;
            $pagsize = 20;
            $offsize = ($pindex - 1) * 20;
            $newdatas = array();
            $jointable = C('DB_PREFIX') . 'user';
            $this->group_orderDb->join('as gord LEFT JOIN ' . $jointable . ' as u on gord.uid=u.uid');
            $order_list = $this->group_orderDb->field('gord.*,u.nickname,u.truename')->where($where)->order('gord.add_time DESC')->limit($offsize . ',' . $pagsize)->select();
            $hasmore = $order_count > ($pindex * $pagsize) ? 1 : 0;
            if (!empty($order_list)) {
                foreach ($order_list as $kk => $vv) {
                    if ($vv['status'] == 3) {
                        $newdatas[$kk]['order_status'] = '已取消';
                    } elseif ($vv['status'] == 4) {
                        $newdatas[$kk]['order_status'] = '已删除';
                    } elseif ($vv['paid'] > 0) {
                        if (($vv['third_id'] == "0") && ($vv['pay_type'] == 'offline')) {
                            $newdatas[$kk]['order_status'] = '线下未付款';
                        } elseif ($vv['status'] == 0) {
                            $newdatas[$kk]['order_status'] = '已付款';
                            if ($vv['tuan_type'] != 2) {
                                $newdatas[$kk]['order_status'].='<font color="red"> 未消费</font>';
                            } else {
                                $newdatas[$kk]['order_status'].='<font color="red"> 未发货</font>';
                            }
                        } elseif ($vv['status'] == 1) {
                            if ($vv['tuan_type'] != 2) {
                                $newdatas[$kk]['order_status'] = '<font color="red">已消费</font>';
                            } else {
                                $newdatas[$kk]['order_status'] = '<font color="red">已发货</font>';
                            }
                        } else {
                            $newdatas[$kk]['order_status'] = '已完成';
                        }
                    } else {
                        $newdatas[$kk]['order_status'] = '未付款';
                    }
                    $newdatas[$kk]['order_id'] = $vv['order_id'];
                    $newdatas[$kk]['nickname'] = !empty($vv['truename']) ? $vv['truename'] : $vv['nickname'];
                    $newdatas[$kk]['phone'] = $vv['phone'];
                    $newdatas[$kk]['address'] = $vv['adress'];
                    $newdatas[$kk]['final_price'] = $vv['total_money'] - $vv['wx_cheap'];
                    $newdatas[$kk]['num'] = $vv['num'] . '份';
                    $newdatas[$kk]['created'] = date('Y-m-d H:i:s', $vv['add_time']);
                }
            }
            unset($order_list);
            $this->dexit(array('has_more' => $hasmore, 'list' => $newdatas, 'pindex' => $pindex, 'type' => 'group'));
        } else {
            $this->display();
        }
    }
	
    public function morder() {
        if (IS_AJAX) {
            $mer_id = $this->merchant_session['mer_id'];
            $status = isset($_POST['status']) ? trim($_POST['status']) : 'all';
            $keyword = isset($_POST['keyword']) ? trim($_POST['keyword']) : '';
            $where = 'mord.mer_id=' . $mer_id;
            if ($status != 'all') {
                $status = intval($status);
                if ($status == 0) {
                    $where.=' AND (mord.paid="0" OR (mord.third_id ="0" AND mord.pay_type="offline"))';
                } else {
                    $where.=' AND mord.status="' . ($status - 1) . '"';
                }
            }
            if (!empty($keyword)) {
                $where.=' AND (mord.phone like "%' . $keyword . '%" OR mord.name like "%' . $keyword . '%")';
            }
            /* //团购列表
              $now_group = D('Group')->get_group_by_groupId($group_id);
              if (empty($now_group)) {
              $this->error_tips('当前' . $this->config['group_alias_name'] . '不存在！');
              }
              $this->assign('now_group', $now_group); */
            //订单列表
            $order_count = $this->meal_orderDb->where($where)->count();
            $pindex = intval(trim($_POST['pindex']));
            $pindex = $pindex > 0 ? $pindex : 1;
            $pagsize = 20;
            $offsize = ($pindex - 1) * 20;
            $newdatas = array();
            $jointable = C('DB_PREFIX') . 'merchant_store';
            $this->meal_orderDb->join('as mord LEFT JOIN ' . $jointable . ' as ms on mord.store_id=ms.store_id');
            $order_list = $this->meal_orderDb->field('mord.*,ms.name as storename')->where($where)->order('order_id  DESC')->limit($offsize . ',' . $pagsize)->select();
            $hasmore = $order_count > ($pindex * $pagsize) ? 1 : 0;
            if (!empty($order_list)) {
                foreach ($order_list as $kk => $vv) {
                    if ($vv['status'] == 3) {
                        $newdatas[$kk]['order_status'] = '已取消';
                    } elseif ($vv['status'] == 4) {
                        $newdatas[$kk]['order_status'] = '已删除';
                    } elseif ($vv['paid'] > 0) {
                        if (($vv['third_id'] == "0") && ($vv['pay_type'] == 'offline')) {
                            $newdatas[$kk]['order_status'] = '线下未付款';
                        } elseif ($vv['status'] == 0) {
                            $newdatas[$kk]['order_status'] = '已付款';
                            if ($vv['tuan_type'] != 2) {
                                $newdatas[$kk]['order_status'].='<font color="red"> 未消费</font>';
                            } else {
                                $newdatas[$kk]['order_status'].='<font color="red"> 未发货</font>';
                            }
                        } elseif ($vv['status'] == 1) {
                            if ($vv['tuan_type'] != 2) {
                                $newdatas[$kk]['order_status'] = '<font color="red">已消费</font>';
                            } else {
                                $newdatas[$kk]['order_status'] = '<font color="red">已发货</font>';
                            }
                        } else {
                            $newdatas[$kk]['order_status'] = '已完成';
                        }
                    } else {
                        $newdatas[$kk]['order_status'] = '未付款';
                    }
                    $newdatas[$kk]['order_id'] = $vv['order_id'];
                    $newdatas[$kk]['nickname'] = $vv['name'];
                    $newdatas[$kk]['storename'] = $vv['storename'];
                    $newdatas[$kk]['phone'] = $vv['phone'];
                    $newdatas[$kk]['address'] = $vv['address'];
                    $newdatas[$kk]['final_price'] = $vv['total_price'] > 0 ? $vv['total_price'] - $vv['minus_price'] : $vv['price'] - $vv['minus_price'];
                    $newdatas[$kk]['num'] = $vv['total'] . '道菜';
                    $newdatas[$kk]['created'] = date('Y-m-d H:i:s', $vv['dateline']);
                }
            }
            unset($order_list);
            $this->dexit(array('has_more' => $hasmore, 'list' => $newdatas, 'pindex' => $pindex, 'type' => 'meal'));
        } else {
            $this->display();
        }
    }
	
    /**
     * 商家提现
     * 汪威·
     * 2016.5.9
     */
    public function withdraw(){
        session('is_Merchant','merchant');	//商户中心标示
        $allincomecount = $this->getallincomecount();
//        商户已提现金额
        $d['mer_id'] = $this->merid;
        $d['status'] = "2";
        $count = M('take_cash')->where($d)->Sum('tc_money');
        //$allincomecount['payall'] = $this->merchant_session['money'];
		$allincomecount['payall']=M('merchant')->where(array('mer_id'=>$d['mer_id']))->getField('money');
        $this->assign('allincomecount', $allincomecount);
        $time=time()-3600*24*30;
        $mode = new Model();
        $sql = "SELECT 1 as name,'快店' as type,info as order_name,payment_money, paid, pay_time FROM ". C('DB_PREFIX') . "meal_order WHERE mer_id={$this->merid} AND paid=1 AND status in (1,2) AND (pay_type<>'offline' OR balance_pay<>'0.00') AND pay_time>{$time}";
        $sql .= ' UNION ALL ';
        $sql .= "SELECT 2 as name,'团购' as type,order_name,payment_money, paid,  pay_time FROM ". C('DB_PREFIX') . "group_order WHERE mer_id={$this->merid} AND paid=1 AND status in (1,2) AND (pay_type<>'offline' OR balance_pay<>'0.00') AND pay_time>{$time}";
        $sql .= ' UNION ALL ';
        $sql .= "SELECT 4 as name,'商家提现' as type,'商家提现' as order_name, tc_money as payment_money, status as paid, sub_time as pay_time FROM ". C('DB_PREFIX') . "take_cash WHERE mer_id={$this->merid} AND status=2";
        $sql .= " ORDER BY pay_time DESC";
        $list = $mode->query($sql);
        foreach($list as $ke=>$va){
			if($va['name']!="4"){
				$list[$ke]['order_name'] = unserialize($va['order_name'])[0];
			}
		}
        $mame = $this->merid;
        $data = M('take_cash')->where('mer_id='.$mame)->select();
        foreach($data as $ke=>$va){
            $data[$ke]['dispose_name'] = M('Admin')->where(array('id' =>$va['dispose_id']))->getField('realname');
        }
        $this->assign('title_name',"我要提现");
        $this->assign('info',$data);
        $this->assign('list', $list);
        $this->display();
    }
	
    /**
     * 商家提现操作
     * 汪威·
     * 2016.5.9
     */
    public function dodraw(){
        session('is_Merchant','merchant');	//商户中心标示
        $allincomecount = $this->getallincomecount();
        if(IS_AJAX){
                $money = floatval($allincomecount['payall']);
                $withdraw = trim($_POST['withdraw']);
                $withdraw = floatval($withdraw);
                $number = trim($_POST['number']);
                $name = trim($_POST['name']);
                $phone = trim($_POST['phone']);
                $bankname = trim($_POST['bankname']);
            $preg='/^\d{19}$/';
            $pregp = '/^(13[0-9]|14[0-9]|15[0-9]|18[0-9])\d{8}$/';
            if(!preg_match($preg,$number)){
                $this->error("请输入正确卡号");
            }
            if(!preg_match($pregp,$phone)){
                $this->error("请输入正确手机号");
            }
            if(empty($phone)){
                $this->error("请输入联系电话");
            }
            if(empty($bankname)){
                $this->error("请输入该系统支持的银行卡号");
            }
            if(empty($withdraw)){
                $this->error("请输入提现金额");
            }
            if($money<$withdraw){
                $this->error("提现金额不能大于可提现金额");
            }
            if(empty($number)){
                $this->error("请输入银行卡号");
            }
            if(empty($name)){
                $this->error("请输入姓名");
            }
            $data['mc_name'] = $this->merchant_session['name'];
            $data['mer_id'] = $this->merid;
            $data['tc_money'] = $withdraw;
            $data['contact_num'] = $phone;
            $data['sub_time'] = time();
            $data['status'] = "0";
            $data['bank_name'] = $name;
            $data['bank_num'] = $number;
            $data['bank'] = $bankname;
            $add = M('take_cash')->add($data);
            if($add){
				//M('merchant')->where(array('mer_id'=>$data['mer_id']))->setDec('money',$withdraw);	//商户金额更新
                $this->success("提交成功");
            }else{
                $this->error("提交失败");
            }
        }else{
            $d['mer_id'] = $this->merid;
            $d['status'] = "2";
            $count = M('take_cash')->where($d)->Sum('tc_money');
            //$allincomecount['payall'] = $this->merchant_session['money'];
			$allincomecount['payall']=M('merchant')->where(array('mer_id'=>$d['mer_id']))->getField('money');
            $this->assign('allincomecount', $allincomecount);
            $import_result = import('@.ORG.bank');
            $pay_class = new bank();
            $bankList = $pay_class->bankList;
            $banklist = json_encode($bankList);
            $this->assign('title_name',"我要提现");
            $this->assign('banklist', $banklist);
            $this->display();
        }
    }
	
    /**
     * 扫码支付
     */
    public function sorder() {
        if (IS_AJAX) {
            $mer_id = $this->merchant_session['mer_id'];
            $status = isset($_POST['status']) ? trim($_POST['status']) : 'all';
            $keyword = isset($_POST['keyword']) ? trim($_POST['keyword']) : '';
            //$where = 'ds_id <>"0" AND mord.mer_id=' . $mer_id;
			$where = 'mord.mer_id=' .$mer_id.' AND mord.pay_type="wxcode"';
            if ($status != 'all') {
                $status = intval($status);
                if ($status == 0) {
                    $where.=' AND (mord.paid="0" OR (mord.third_id ="0" AND mord.pay_type="offline"))';
                } else {
                    $where.=' AND mord.status="' . ($status - 1) . '"';
                }
            }
            if (!empty($keyword)) {
                $where.=' AND (mord.phone like "%' . $keyword . '%" OR mord.name like "%' . $keyword . '%")';
            }
            //订单列表
            $order_count = $this->meal_orderDb->where($where)->count();
            $pindex = intval(trim($_POST['pindex']));
            $pindex = $pindex > 0 ? $pindex : 1;
            $pagsize = 20;
            $offsize = ($pindex - 1) * 20;
            $newdatas = array();
            $jointable = C('DB_PREFIX') . 'merchant_store';
            $this->meal_orderDb->join('as mord LEFT JOIN ' . $jointable . ' as ms on mord.store_id=ms.store_id');
            $order_list = $this->meal_orderDb->field('mord.*,ms.name as storename')->where($where)->order('order_id  DESC')->limit($offsize . ',' . $pagsize)->select();
            $hasmore = $order_count > ($pindex * $pagsize) ? 1 : 0;
            if (!empty($order_list)) {
                foreach ($order_list as $kk => $vv) {
                    if ($vv['status'] == 3) {
                        $newdatas[$kk]['order_status'] = '已取消';
                    } elseif ($vv['status'] == 4) {
                        $newdatas[$kk]['order_status'] = '已删除';
                    } elseif ($vv['paid'] > 0) {
                        if (($vv['third_id'] == "0") && ($vv['pay_type'] == 'offline')) {
                            $newdatas[$kk]['order_status'] = '线下未付款';
                        } elseif ($vv['status'] == 0) {
                            $newdatas[$kk]['order_status'] = '已付款';
                            if ($vv['tuan_type'] != 2) {
                                $newdatas[$kk]['order_status'].='<font color="red"> 未消费</font>';
                            } else {
                                $newdatas[$kk]['order_status'].='<font color="red"> 未发货</font>';
                            }
                        } elseif ($vv['status'] == 1) {
                            if ($vv['tuan_type'] != 2) {
                                $newdatas[$kk]['order_status'] = '<font color="red">已消费</font>';
                            } else {
                                $newdatas[$kk]['order_status'] = '<font color="red">已发货</font>';
                            }
                        } else {
                            $newdatas[$kk]['order_status'] = '已完成';
                        }
                    } else {
                        $newdatas[$kk]['order_status'] = '未付款';
                    }
                    $newdatas[$kk]['order_id'] = $vv['order_id'];
                    $newdatas[$kk]['nickname'] = $vv['name'];
                    $newdatas[$kk]['storename'] = $vv['storename'];
                    $newdatas[$kk]['phone'] = $vv['phone'];
                    $newdatas[$kk]['address'] = $vv['address'];
                    $newdatas[$kk]['final_price'] = $vv['total_price'] > 0 ? $vv['total_price'] - $vv['minus_price'] : $vv['price'] - $vv['minus_price'];
                    $newdatas[$kk]['num'] = $vv['total'] . '道菜';
                    $newdatas[$kk]['created'] = date('Y-m-d H:i:s', $vv['dateline']);
                }
            }
            unset($order_list);
            $this->dexit(array('has_more' => $hasmore, 'list' => $newdatas, 'pindex' => $pindex, 'type' => 'pseudo'));
        } else {
            $this->display();
        }
    }
	
    public function gdetail() {
        $now_order = D('Group_order')->get_order_detail_by_id_and_merId($this->merchant_session['mer_id'], $_GET['order_id'], false);
        if (empty($now_order)) {
            exit('此订单不存在！');
        }
        if (!empty($now_order['pay_type'])) {
            $now_order['paytypestr'] = D('Pay')->get_pay_name($now_order['pay_type']);
            if (($now_order['pay_type'] == 'offline') && !empty($now_order['third_id']) && ($now_order['paid'] == 1)) {
                $now_order['paytypestr'] .='<span style="color:green">&nbsp; 已支付</span>';
            } else if (($now_order['pay_type'] != 'offline') && ($now_order['paid'] == 1)) {
                $now_order['paytypestr'] .='<span style="color:green">&nbsp; 已支付</span>';
            } else {
                $now_order['paytypestr'] .='<span style="color:red">&nbsp; 未支付</span>';
            }
        } else {
            $now_order['paytypestr'] = '未知';
        }
        $this->assign('now_order', $now_order);
        $group_store_list = D('Group_store')->get_storelist_by_groupId($now_order['group_id']);
        $this->assign('group_store_list', $group_store_list);
        $this->display();
    }
	
    public function order_store_id() {
        $now_order = D('Group_order')->get_order_detail_by_id_and_merId($this->merchant_session['mer_id'], $_GET['order_id'], true, false);
        if (empty($now_order)) {
            $this->error_tips('此订单不存在！');
        }
        if (empty($now_order['paid'])) {
            $this->error_tips('此订单尚未支付！');
        }
        $condition_group_order['order_id'] = $now_order['order_id'];
        $data_group_order['store_id'] = $_POST['store_id'];
        if (D('Group_order')->where($condition_group_order)->data($data_group_order)->save()) {
            $this->success_tips('修改成功！');
        } else {
            $this->error_tips('修改失败！请重试。');
        }
    }
	
    public function group_remark() {
        $now_order = D('Group_order')->get_order_detail_by_id_and_merId($this->merchant_session['mer_id'], $_GET['order_id'], true, false);
        if (empty($now_order)) {
            $this->error_tips('此订单不存在！');
        }
        if (empty($now_order['paid'])) {
            $this->error_tips('此订单尚未支付！');
        }
        $condition_group_order['order_id'] = $now_order['order_id'];
        $data_group_order['merchant_remark'] = $_POST['merchant_remark'];
        if (D('Group_order')->where($condition_group_order)->data($data_group_order)->save()) {
            $this->success_tips('修改成功！');
        } else {
            $this->error_tips('修改失败！请重试。');
        }
    }
	
    public function mdetail() {
        $this->merid = $this->merchant_session['mer_id'];
        $order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;
        $order = $this->meal_orderDb->where(array('mer_id' => $this->merid, 'order_id' => $order_id))->find();
        $order['info'] = unserialize($order['info']);
        if (empty($order['third_id']) && $order['pay_type'] == 'offline') {
            $order['paid'] = 0;
        }
        if (!empty($order['pay_type'])) {
            $order['paytypestr'] = D('Pay')->get_pay_name($order['pay_type']);
            if (($order['pay_type'] == 'offline') && !empty($order['third_id']) && ($order['paid'] == 1)) {
                $order['paytypestr'] .='<span style="color:green">&nbsp; 已支付</span>';
            } else if (($order['pay_type'] != 'offline') && ($order['paid'] == 1)) {
                $order['paytypestr'] .='<span style="color:green">&nbsp; 已支付</span>';
            } else {
                $order['paytypestr'] .='<span style="color:red">&nbsp; 未支付</span>';
            }
        } else {
            $order['paytypestr'] = '未知';
        }
        $this->assign('order', $order);
        $this->display();
    }
	
    public function sdetail() {
        $this->merid = $this->merchant_session['mer_id'];
        $order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;
        $order = $this->meal_orderDb->where(array('mer_id' => $this->merid,'ds_id'=>array('neq',"0"), 'order_id' => $order_id))->find();
        $order['info'] = unserialize($order['info']);
        if (empty($order['third_id']) && $order['pay_type'] == 'offline') {
            $order['paid'] = 0;
        }
        if (!empty($order['pay_type'])) {
            $order['paytypestr'] = D('Pay')->get_pay_name($order['pay_type']);
            if (($order['pay_type'] == 'offline') && !empty($order['third_id']) && ($order['paid'] == 1)) {
                $order['paytypestr'] .='<span style="color:green">&nbsp; 已支付</span>';
            } else if (($order['pay_type'] != 'offline') && ($order['paid'] == 1)) {
                $order['paytypestr'] .='<span style="color:green">&nbsp; 已支付</span>';
            } else {
                $order['paytypestr'] .='<span style="color:red">&nbsp; 未支付</span>';
            }
        } else {
            $order['paytypestr'] = '未知';
        }
        $this->assign('order', $order);
        $this->display();
    }
	
    public function promang() {
        $this->display();
    }
	
    public function gpro() {
        if (IS_AJAX) {
            $database_group = D('Group');
            $condition_group = 'mer_id=' . $this->merchant_session['mer_id'];
            $keyword = isset($_POST['keyword']) ? trim($_POST['keyword']) : '';
            if (!empty($keyword)) {
                $condition_group.=' AND (s_name like "%' . $keyword . '%" OR name like "%' . $keyword . '%")';
            }
            $group_count = $database_group->where($condition_group)->count();
            $pindex = intval(trim($_POST['pindex']));
            $pindex = $pindex > 0 ? $pindex : 1;
            $pagsize = 20;
            $offsize = ($pindex - 1) * 20;
            $group_list = $database_group->field('group_id,mer_id,prefix_title,name,s_name,pic ,	old_price,price,wx_cheap,discount,sale_count,status,type,tuan_type,qrcode_id')->where($condition_group)->order('`group_id` DESC')->limit($offsize . ',' . $pagsize)->select();
            $group_image_class = new group_image();
            foreach ($group_list as $key => $value) {
                $tmp_pic_arr = explode(';', $value['pic']);
				$group_list[$key]['old_price'] = floatval($value['old_price']);
				$group_list[$key]['price'] = floatval($value['price']);
				$group_list[$key]['wx_cheap'] = floatval($value['wx_cheap']);
                $group_list[$key]['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0], 's');
            }
            $hasmore = $group_count > ($pindex * $pagsize) ? 1 : 0;
            $this->dexit(array('has_more' => $hasmore, 'list' => !empty($group_list) ? $group_list : array(), 'pindex' => $pindex, 'type' => 'group'));
        } else {
            $this->display();
        }
    }
	
    public function group_add() {
        if (IS_POST) {
            if (empty($_POST['name'])) {
                $this->error_tips('请填写商品标题');
            }
            if (empty($_POST['s_name'])) {
                $this->error_tips('请填写商品名称');
            }
            if (empty($_POST['intro'])) {
                $this->error_tips('请填写商品简介');
            }
            //判断关键词
            $keywords = trim($_POST['keywords']);
            if (!empty($keywords)) {
                $tmp_key_arr = explode(' ', $keywords);
                $key_arr = array();
                foreach ($tmp_key_arr as $value) {
                    if (!empty($value)) {
                        array_push($key_arr, $value);
                    }
                }
                if (count($key_arr) > 5) {
                    $this->error_tips('关键词最多5个。');
                }
            }
            if (empty($_POST['old_price'])) {
                $this->error_tips('请填写商品原价');
            }
            if (empty($_POST['price'])) {
                $this->error_tips('请填写商品' . $this->config['group_alias_name'] . '价');
            }
            if (empty($_POST['store'])) {
                $this->error_tips('请至少选择一家店铺');
            }
            if (empty($_POST['content'])) {
                $this->error_tips('请填写本单详情');
            }
            if (empty($_POST['pic_detail'])) {
                $this->error_tips('请至少上传一张照片');
            }
            if (empty($_POST['success_num'])) {
                $this->error_tips('成功' . $this->config['group_alias_name'] . '人数要求至少为1人');
            }
            isset($_POST['tagname']) && $_POST['tagname'] = trim($_POST['tagname']);
            $packageid = isset($_POST['packageid']) ? intval($_POST['packageid']) : 0;
            if (($packageid > 0) && empty($_POST['tagname'])) {
                $this->error_tips($this->config['group_alias_name'] . '套餐标签必须要写上！');
            }
            $leveloff = isset($_POST['leveloff']) ? $_POST['leveloff'] : false;
            unset($_POST['leveloff']);
            /* $_POST['pic'] = implode(';', $_POST['pic_detail']); */
            $_POST['pic'] = $_POST['pic_detail'];
            unset($_POST['pic_detail']);
            if ($_POST['cue_field']) {
                $cue_field = array();
                foreach ($_POST['cue_field']['value'] as $key => $value) {
                    array_push($cue_field, array('key' => $_POST['cue_field']['key'][$key], 'value' => $value));
                }
                $_POST['cue'] = serialize($cue_field);
            }
            if (is_array($_POST['custom'])) {
                foreach ($_POST['custom'] as $key => $value) {
                    if (is_array($value)) {
                        $_POST[$key] = implode(',', $value);
                    } else {
                        $_POST[$key] = $value;
                    }
                }
            }
            $_POST['content'] = fulltext_filter($_POST['content']);
            $_POST['discount'] = $_POST['price'] / $_POST['old_price'] * 10;
            $_POST['mer_id'] = $this->merchant_session['mer_id'];
            if ($this->config['group_verify']) {
                $_POST['status'] = $this->merchant_session['issign'] ? 1 : 2;
            } else {
                $_POST['status'] = 1;
            }
            $_POST['last_time'] = $_SERVER['REQUEST_TIME'];
            $_POST['begin_time'] = strtotime($_POST['begin_time']);
            $_POST['end_time'] = strtotime($_POST['end_time']);
            $_POST['deadline_time'] = strtotime($_POST['deadline_time']);
            //店铺信息
            $database_merchant_store = D('Merchant_store');
            foreach ($_POST['store'] as $key => $value) {
                $condition_merchant_store['store_id'] = $value;
                $tmp_group_store = $database_merchant_store->field('`store_id`,`province_id`,`city_id`,`area_id`,`circle_id`')->where($condition_merchant_store)->find();
                if (!empty($tmp_group_store)) {
                    $data_group_store_arr[] = $tmp_group_store;
                }
                //给店铺添加分类
                if (!($store_catgory = D('Store_category')->field(true)->where(array('cat_id' => intval($_POST['cat_fid']), 'store_id' => $value))->find())) {
                    D('Store_category')->add(array('cat_id' => intval($_POST['cat_fid']), 'store_id' => $value));
                }
            }
            if (empty($data_group_store_arr)) {
                $this->error_tips('您选择的店铺信息不正确！请重试。');
            } else if ($_POST['tuan_type'] == 2) {
                $_POST['prefix_title'] = '购物';
            } else if (count($data_group_store_arr) == 1) {
                $circle_info = D('Area')->get_area_by_areaId($data_group_store_arr[0]['circle_id']);
                if (empty($circle_info)) {
                    $this->error_tips('您选择的店铺区域商圈信息不正确！请修改店铺资料后重试。');
                }
                $_POST['prefix_title'] = $circle_info['area_name'];
            } else {
                $_POST['prefix_title'] = count($data_group_store_arr) . '店通用';
            }
            $newleveloff = array();
            if (!empty($leveloff)) {
                foreach ($leveloff as $kk => $vv) {
                    $vv['type'] = intval($vv['type']);
                    $vv['vv'] = intval($vv['vv']);
                    if (($vv['type'] > 0) && ($vv['vv'] > 0)) {
                        $vv['level'] = $kk;
                        $newleveloff[$kk] = $vv;
                    }
                }
            }
            $_POST['leveloff'] = !empty($newleveloff) ? serialize($newleveloff) : '';
            if ($leveloff === false)
                unset($_POST['leveloff']);
            $database_group = D('Group');
            if ($group_id = $database_group->data($_POST)->add()) {
                $database_group_store = D('Group_store');
                foreach ($data_group_store_arr as $key => $value) {
                    $data_group_store = $value;
                    $data_group_store['group_id'] = $group_id;
                    $database_group_store->data($data_group_store)->add();
                }
                //判断关键词
                if (!empty($key_arr)) {
                    $database_keywords = D('Keywords');
                    $data_keywords['third_id'] = $group_id;
                    $data_keywords['third_type'] = 'group';
                    foreach ($key_arr as $value) {
                        $data_keywords['keyword'] = $value;
                        $database_keywords->data($data_keywords)->add();
                    }
                }
                //添加或删除到套餐
                if ($packageid > 0) {
                    $mpackageDb = M('Group_packages');
                    $mpackage = $mpackageDb->where(array('id' => $packageid, 'mer_id' => $this->merchant_session['mer_id']))->find();
                    if (!empty($mpackage)) {
                        $mpackage['groupidtext'] = !empty($mpackage['groupidtext']) ? unserialize($mpackage['groupidtext']) : array();
                        $mpackage['groupidtext'][$group_id] = $_POST['tagname'];
                        $mpackageDb->where(array('id' => $mpackage['id']))->save(array('groupidtext' => serialize($mpackage['groupidtext'])));
                    }
                }
                $this->success_tips('添加成功！', U('Index/gpro'));
            } else {
                $this->error_tips('添加失败！请重试。');
            }
        } else {
            $database_group_category = D('Group_category');
            $condition_f_group_category['cat_fid'] = 0;
            $f_category_list = $database_group_category->field('`cat_id`,`cat_name`,`cat_field`,`cue_field`')->where($condition_f_group_category)->order('`cat_sort` DESC,`cat_id` ASC')->select();
            $this->assign('f_category_list', $f_category_list);
            if (empty($f_category_list)) {
                $this->error_tips('管理员没有添加' . $this->config['group_alias_name'] . '分类！');
            }
            $condition_s_group_category['cat_fid'] = $f_category_list[0]['cat_id'];
            $condition_s_group_category['cat_status'] = 1;
            $s_category_list = $database_group_category->field('`cat_id`,`cat_name`')->where($condition_s_group_category)->order('`cat_sort` DESC,`cat_id` ASC')->select();
            $this->assign('s_category_list', $s_category_list);
            if (empty($s_category_list)) {
                $this->error_tips($f_category_list[0]['cat_name'] . ' 分类下没有添加子分类！');
            }
            if (!empty($f_category_list[0]['cat_field'])) {
                $cat_field = unserialize($f_category_list[0]['cat_field']);
                $custom_html = '';
                foreach ($cat_field as $key => $value) {
                    if (empty($value['use_field'])) {
                        $custom_html .= '<div class="pigcms-container"><p class="pigcms-form-title">' . $value['name'] . '：</p>';
                        if ($value['type'] == 0) {
                            $custom_html .= '<select name="custom[custom_' . $key . ']" class="pigcms-input-block">';
                            foreach ($value['value'] as $k => $v) {
                                $custom_html .= '<option value="' . $k . '">' . $v . '</option>';
                            }
                            $custom_html .= '</select>';
                        } else {
                            foreach ($value['value'] as $k => $v) {
                                $custom_html .= '<label style="margin-right:15px;"><input class="ace" type="checkbox" name="custom[custom_' . $key . '][]" value="' . $k . '" id="custom_' . $key . '_' . $k . '"/><span class="lbl"><label for="custom_' . $key . '_' . $k . '">&nbsp;' . $v . '</label></span></label>';
                            }
                        }
                        $custom_html .= '</div>';
                    }
                }
            }
            $this->assign('custom_html', $custom_html);
            if (!empty($f_category_list[0]['cue_field'])) {
                $cue_field = unserialize($f_category_list[0]['cue_field']);
                $cue_html = '';
                foreach ($cue_field as $key => $value) {
                    $cue_html .= '<div class="pigcms-container"><p class="pigcms-form-title">' . $value['name'] . '：</p>';
                    if ($value['type'] == 0) {
                        $cue_html .= '<input type="hidden" name="cue_field[key][]" value="' . $value['name'] . '"/><input type="text" class="pigcms-input-block" name="cue_field[value][]"/>';
                    } else {
                        $cue_html .= '<input type="hidden" name="cue_field[key][]" value="' . $value['name'] . '"/><textarea class="pigcms-textarea" rows="5" name="cue_field[value][]"></textarea>';
                    }
                    $cue_html .= '</div><div style="clear:both"></div>';					
                }
            }
            $this->assign('cue_html', $cue_html);
            $mer_id = $this->merchant_session['mer_id'];
            $db_arr = array(C('DB_PREFIX') . 'area' => 'a', C('DB_PREFIX') . 'merchant_store' => 's');
            $store_list = D()->table($db_arr)->field('a.`area_name`,s.`adress`,`s`.`name`,`s`.`store_id`')->where("`s`.`mer_id`='$mer_id' AND `s`.`status`='1' AND `s`.`have_group`='1' AND `s`.`area_id`=`a`.`area_id`")->order('`sort` DESC,`store_id` ASC')->select();
            if (empty($store_list)) {
                $this->error_tips('您暂时还没有能添加' . $this->config['group_alias_name'] . '信息的店铺！');
            }
            $this->assign('store_list', $store_list);
            $levelDb = M('User_level');
            $tmparr = $levelDb->where('22=22')->order('id ASC')->select();
            $levelarr = array();
            if ($tmparr && $this->config['level_onoff'] && $this->config['group_level_onoff']) {
                foreach ($tmparr as $vv) {
                    $levelarr[$vv['level']] = $vv;
                }
            }
            unset($tmparr);
            $this->assign('levelarr', $levelarr);
            $mpackageDb = M('Group_packages');
            $mpackagelist = $mpackageDb->field(true)->where(array('mer_id' => $this->merchant_session['mer_id']))->order('id DESC')->select();
            $this->assign('mpackagelist', $mpackagelist);
            $this->display();
        }
    }
	
    public function ajax_get_category() {
        $database_group_category = D('Group_category');
        $condition_now_group_category['cat_id'] = $_GET['cat_fid'];
        $condition_now_group_category['cat_status'] = 1;
        $now_category = $database_group_category->field('`cat_field`,`cue_field`')->where($condition_now_group_category)->find();
        if (empty($now_category)) {
            $return['error'] = 1;
            $return['msg'] = '该分类不存在！';
        } else {
            $condition_s_group_category['cat_fid'] = $_GET['cat_fid'];
            $condition_s_group_category['cat_status'] = 1;
            $s_category_list = $database_group_category->field('`cat_id`,`cat_name`')->where($condition_s_group_category)->order('`cat_sort` DESC,`cat_id` ASC')->select();
            if (empty($s_category_list)) {
                $return['error'] = 1;
                $return['msg'] = '该分类下没有添加子分类！请勿选择。';
            } else {
                if (!empty($now_category['cat_field'])) {
                    $cat_field = unserialize($now_category['cat_field']);
                    $custom_html = '';
                    foreach ($cat_field as $key => $value) {
                        if (empty($value['use_field'])) {
                            $custom_html .= '<div class="pigcms-container"><p class="pigcms-form-title">' . $value['name'] . '：</p>';
                            if ($value['type'] == 0) {
                                $custom_html .= '<select name="custom[custom_' . $key . ']" class="pigcms-input-block" style="margin-right:10px;">';
                                foreach ($value['value'] as $k => $v) {
                                    $custom_html .= '<option value="' . $k . '">' . $v . '</option>';
                                }
                                $custom_html .= '</select>';
                            } else {
                                foreach ($value['value'] as $k => $v) {
                                    $custom_html .= '<label style="margin-right:30px;"><input class="ace" type="checkbox" name="custom[custom_' . $key . '][]" value="' . $k . '" id="custom_' . $key . '_' . $k . '"/><span class="lbl"><label for="custom_' . $key . '_' . $k . '">&nbsp;' . $v . '</label></span></label>';
                                }
                            }
                            $custom_html .= '</div>';
                        }
                    }
                    $return['custom_html'] = $custom_html;
                } else {
                    $return['custom_html'] = '';
                }
                if (!empty($now_category['cue_field'])) {
                    $cue_field = unserialize($now_category['cue_field']);
                    $cue_html = '';
                    foreach ($cue_field as $key => $value) {
                        $cue_html .= '<div class="pigcms-container"><p class="pigcms-form-title">' . $value['name'] . '：</p>';
                        if ($value['type'] == 0) {
                            $cue_html .= '<input type="hidden" name="cue_field[key][]" value="' . $value['name'] . '"/><input type="text" class="pigcms-input-block" name="cue_field[value][]"/>';
                        } else {
                            $cue_html .= '<input type="hidden" name="cue_field[key][]" value="' . $value['name'] . '"/><textarea class="pigcms-textarea" rows="5" name="cue_field[value][]"></textarea>';
                        }
                        $cue_html .= '</div>';
                    }
                    $return['cue_html'] = $cue_html;
                } else {
                    $return['cue_html'] = '';
                }
                $return['error'] = 0;
                $return['cat_list'] = $s_category_list;
            }
        }
        exit(json_encode($return));
    }
	
    /*     * ****套餐管理页**开始****** */
    /* public function mpackage() {
      $mpackageDb = M('Group_packages');
      $_count = $mpackageDb->where(array('mer_id' => $this->merchant_session['mer_id']))->count();
      import('@.ORG.merchant_page');
      $p = new Page($_count, 20);
      $mpackagelist = $mpackageDb->field(true)->where(array('mer_id' => $this->merchant_session['mer_id']))->order('id DESC')->limit($p->firstRow . ',' . $p->listRows)->select();
      $pagebar = $p->show();
      $this->assign('pagebar', $pagebar);
      $this->assign('mpackagelist', $mpackagelist);
      $this->display();
      } */
    public function mpackageadd() {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $mpackageDb = M('Group_packages');
        if (IS_POST) {
            $_POST['title'] = trim($_POST['title']);
            if (empty($_POST['title']))
                $this->error_tips('套餐标示名称不能为空，必须填上');
            $id = isset($_POST['idx']) ? intval($_POST['idx']) : $id;
            unset($_POST['idx']);
            $_POST['mer_id'] = $this->merchant_session['mer_id'];
            if ($id > 0) {
                $tmpid = $mpackageDb->where(array('id' => $id))->save($_POST);
                $this->success_tips('修改成功！', U('Index/gpro'));
                exit();
            } else {
                $tmpid = $mpackageDb->add($_POST);
                $this->success_tips('保存成功！', U('Index/gpro'));
                exit();
            }
            $this->error_tips('保存失败');
            exit();
        } else {
            $mpackage = $mpackageDb->where(array('id' => $id))->find();
            $this->assign('mpackage', !empty($mpackage) ? $mpackage : array('id' => 0, 'title' => '', 'description' => ''));
            $this->display();
        }
    }
	
    /*     * ****套餐管理页**结束**** */
    public function mpro() {
        if (IS_AJAX) {
            $database_meal = D('Meal');
            $store_ids = $this->getstore_id_Bymerid($this->merchant_session['mer_id']);
            $condition_meal = 'store_id in (' . implode(',', $store_ids) . ')';
            $keyword = isset($_POST['keyword']) ? trim($_POST['keyword']) : '';
            if (!empty($keyword)) {
                $condition_meal.=' AND (name like "%' . $keyword . '%")';
            }
            $count_meal = $database_meal->where($condition_meal)->count();
            $pindex = intval(trim($_POST['pindex']));
            $pindex = $pindex > 0 ? $pindex : 1;
            $pagsize = 20;
            $offsize = ($pindex - 1) * 20;
            $meal_list = $database_meal->field(true)->where($condition_meal)->order('`sort` DESC,`meal_id` ASC')->limit($offsize . ',' . $pagsize)->select();
            $meal_image_class = new meal_image();
            if (!empty($meal_list)) {
                foreach ($meal_list as $mk => $mv) {
                    $meal_list[$mk]['list_pic'] = $meal_image_class->get_image_by_path($mv['image'], $this->config['site_url'], 's');
                    $meal_list[$mk]['s_name'] = $mv['name'];
                    $meal_list[$mk]['statusstr'] = $mv['status'] == 1 ? '在售' : '停售';
                    $meal_list[$mk]['statusoptstr'] = $mv['status'] == 1 ? '下架' : '上架';
                    $meal_list[$mk]['statusopt'] = $mv['status'] == 1 ? '0' : '1';
                    $meal_list[$mk]['old_price'] = floatval($mv['old_price']);
                    $meal_list[$mk]['price'] = floatval($mv['price']);
                }
            }
            $hasmore = $count_meal > ($pindex * $pagsize) ? 1 : 0;
            $this->dexit(array('has_more' => $hasmore, 'list' => !empty($meal_list) ? $meal_list : array(), 'pindex' => $pindex, 'type' => 'meal'));
        } else {
            $this->display();
        }
    }
	
    public function mstatusopt() {
        $status = intval($_POST['st']);
        $meal_id = intval($_POST['item_id']);
        $store_id = intval($_POST['storeid']);
        $now_store = $this->check_store($store_id, true);
        if ($store_id > 0 && $meal_id > 0) {
            if (M('Meal')->where(array('store_id' => $store_id, 'meal_id' => $meal_id))->save(array('status' => $status))) {
                $this->dexit(array('error' => 0));
            }
        }
        $this->dexit(array('error' => 1));
    }
	
    public function mdel() {
        $meal_id = intval($_POST['item_id']);
        $store_id = intval($_POST['storeid']);
        $now_store = $this->check_store($store_id, true);
        if (M('Meal')->where(array('store_id' => $store_id, 'meal_id' => $meal_id))->delete()) {
            $this->dexit(array('error' => 0));
        } else {
            $this->dexit(array('error' => 1));
        }
    }
	
    public function meal_add() {
        $mealid = isset($_GET['mealid']) ? intval($_GET['mealid']) : 0;
        $store_id = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
        $database_meal = M('Meal');
        if (IS_POST) {
            $meal_id = intval($_POST['mealid']);
            $store_id = intval($_POST['store_id']);
            unset($_POST['mealid']);
            $now_store = $this->check_store($store_id);
            if (empty($_POST['name'])) {
                $error_tips .= '商品名称必填！' . '<br/>';
            }
            if (empty($_POST['unit'])) {
                $error_tips .= '商品单位必填！' . '<br/>';
            }
            if (empty($_POST['price'])) {
                $error_tips .= '商品价格必填！' . '<br/>';
            }
            if (empty($_POST['pic_url'])) {
                $error_tips .= '商品图片必须上传！' . '<br/>';
            }
            $_POST['image'] = trim($_POST['pic_url']);
            unset($_POST['pic_url']);
            $_POST['des'] = stripslashes($_POST['des']);
            if (empty($error_tips)) {
                $_POST['last_time'] = $_SERVER['REQUEST_TIME'];
                if (($store_id > 0) && ($meal_id > 0)) {
                    unset($_POST['store_id']);
                    if ($database_meal->where(array('meal_id' => $meal_id, 'store_id' => $store_id))->save($_POST)) {
                        $this->success_tips('修改成功', U('Index/mpro'));
                    } else {
                        $this->error_tips('修改失败！');
                    }
                } else {
                    if ($meal_id = $database_meal->data($_POST)->add()) {
                        //D('Image')->update_table_id($_POST['image'], $meal_id, 'meal');
                        $this->success_tips('添加成功', U('Index/mpro'));
                    } else {
                        $this->error_tips('添加失败！');
                    }
                }
            } else {
                $this->error_tips($error_tips);
            }
        } else {
            $stores = $this->getstore_id_Bymerid($this->merchant_session['mer_id'], true);
            $now_meal = array();
            if ($mealid > 0) {
                $now_meal = $database_meal->where(array('meal_id' => $mealid, 'store_id' => $store_id))->find();
                if (!empty($now_meal['image'])) {
                    $meal_image = new meal_image();
                    $now_meal['piclist'] = $meal_image->get_image_by_path($now_meal['image'], $this->config['site_url'], 's');
                }
            }
            $meal_sort = array();
            if (!empty($stores)) {
                $meal_sortDb = D('Meal_sort');
                if (!empty($now_meal) && $now_meal['sort_id'] > 0) {
                    $meal_sort[$now_meal['store_id']] = $meal_sortDb->where(array('store_id' => $now_meal['store_id']))->select();
                } else {
                    foreach ($stores as $vv) {
                        $meal_sort[$vv['store_id']] = $meal_sortDb->where(array('store_id' => $vv['store_id']))->select();
                    }
                }
            }
            $this->assign('now_meal', $now_meal);
            $this->assign('store_id', $store_id);
            $this->assign('mealid', $mealid);
            $this->assign('meal_sortJSON', json_encode($meal_sort));
            $this->assign('stores', $stores);
            $this->display();
        }
    }
	
    public function getstore_id_Bymerid($mer_id, $name = false) {
        $tmpdatas = M('merchant_store')->field('store_id,name')->where(array('mer_id' => $mer_id, 'have_meal' => '1', 'status' => '1'))->select();
        if ($name)
            return $tmpdatas;
        $storeids = array();
        if (!empty($tmpdatas)) {
            foreach ($tmpdatas as $vv) {
                $storeids[] = $vv['store_id'];
            }
        }
        return $storeids;
    }
	
    public function table_add() {
        $now_store = $this->check_store($_GET['store_id']);
        $this->assign('now_store', $now_store);
        $database = D('Merchant_store_table');
        if (IS_POST) {
            $name = htmlspecialchars($_POST['name']);
            $pigcms_id = intval($_POST['tid']);
            unset($_POST['tid']);
            if (empty($name)) {
                $error_tips .= '分类名称必填！' . '<br/>';
            }
            $num = intval($_POST['num']);
			$status = intval($_POST['status']);
            $table = $database->field(true)->where(array('name' => $name, 'store_id' => $now_store['store_id']))->find();
            if (($pigcms_id > 0) && ($table['pigcms_id'] != $pigcms_id)) {
                $error_tips .= '分类名已经存在！' . '<br/>';
            } elseif (!($pigcms_id > 0) && !empty($table)) {
                $error_tips .= '分类名已经存在！' . '<br/>';
            }
            if (empty($error_tips)) {
                if ($pigcms_id > 0) {
                    if ($database->where(array('pigcms_id' => $pigcms_id, 'store_id' => $now_store['store_id']))->save(array('num' => $num, 'name' => $name,'status'=>$status))) {
                        $this->success_tips('编辑成功！', U('Index/tablelist', array('store_id' => $now_store['store_id'])));
                        exit();
                    } else {
                        $this->error_tips('编辑失败！');
                        exit();
                    }
                } else {
                    if ($database->data(array('name' => $name, 'store_id' => $now_store['store_id']))->add()) {
                        $ok_tips = '添加成功！';
                    } else {
                        $error_tips = '添加失败！请重试。';
                    }
                }
            }
            $this->assign('now_table', $_POST);
            $this->assign('ok_tips', $ok_tips);
            $this->assign('error_tips', $error_tips);
        } else {
            $pigcms_id = intval($_GET['tid']);
            $now_table = array();
            if ($pigcms_id > 0) {
                $now_table = $database->field(true)->where(array('pigcms_id' => $pigcms_id, 'store_id' => $now_store['store_id']))->find();
                if (empty($now_table)) {
                    $this->error_tips('该分类不存在！');
                }
            } else {
                $pigcms_id = 0;
            }
            $this->assign('tid', $pigcms_id);
            $this->assign('now_table', $now_table);
        }
        $this->display();
    }
	
    public function sortlist() {
        $now_store = $this->check_store($_GET['store_id']);
        $this->assign('now_store', $now_store);
        $database_meal_sort = D('Meal_sort');
        $condition_merchant_sort['store_id'] = $now_store['store_id'];
        //$count_sort = $database_meal_sort->where($condition_merchant_sort)->count();
        $sort_list = $database_meal_sort->field(true)->where($condition_merchant_sort)->order('`sort` DESC,`sort_id` ASC')->select();
        foreach ($sort_list as $key => $value) {
            if (!empty($value['week'])) {
                $week_arr = explode(',', $value['week']);
                $week_str = '';
                foreach ($week_arr as $k => $v) {
                    $week_str .= $this->get_week($v) . ' ';
                }
                $sort_list[$key]['week_str'] = $week_str;
            }
        }
        $this->assign('sort_list', $sort_list);
        $this->display();
    }
	
    protected function get_week($num) {
        switch ($num) {
            case 1:
                return '星期一';
            case 2:
                return '星期二';
            case 3:
                return '星期三';
            case 4:
                return '星期四';
            case 5:
                return '星期五';
            case 6:
                return '星期六';
            case 0:
                return '星期日';
            default:
                return '';
        }
    }
	
    /* 检测分类存在 */
    protected function check_sort($sort_id, $store_id) {
        $database_meal_sort = D('Meal_sort');
        $condition_merchant_sort['sort_id'] = $sort_id;
        $condition_merchant_sort['store_id'] = $store_id;
        $now_sort = $database_meal_sort->field(true)->where($condition_merchant_sort)->find();
        if (empty($now_sort)) {
            $this->error_tips('分类不存在！');
        }
        if (!empty($now_sort['week'])) {
            $now_sort['week'] = explode(',', $now_sort['week']);
        }
        return $now_sort;
    }
	
    public function sort_add() {
        $now_store = $this->check_store($_GET['store_id']);
        $this->assign('now_store', $now_store);
        if (IS_POST) {
            if (empty($_POST['sort_name'])) {
                $error_tips = '分类名称必填！' . '<br/>';
            } else {
                $database_meal_sort = D('Meal_sort');
                $data_meal_sort['store_id'] = $now_store['store_id'];
                $data_meal_sort['sort_name'] = $_POST['sort_name'];
                $data_meal_sort['sort'] = intval($_POST['sort']);
                $data_meal_sort['is_weekshow'] = intval($_POST['is_weekshow']);
                if ($_POST['week']) {
                    $data_meal_sort['week'] = strval(implode(',', $_POST['week']));
                }
                $stid = intval($_POST['stid']);
                unset($_POST['stid']);
                if ($stid > 0) {
                    if ($database_meal_sort->where(array('sort_id' => $stid, 'store_id' => $data_meal_sort['store_id']))->data($data_meal_sort)->save()) {
                        $this->success_tips('保存成功！！', U('Index/sortlist', array('store_id' => $now_store['store_id'])));
                        exit();
                    } else {
                        $this->error_tips('保存失败！！您是不是没做过修改？请重试。');
                        exit();
                    }
                } else {
                    if ($database_meal_sort->data($data_meal_sort)->add()) {
                        $ok_tips = '添加成功！！';
                    } else {
                        $error_tips = '添加失败！！请重试。';
                    }
                }
            }
            if (!empty($error_tips)) {
                $this->assign('now_sort', $_POST);
            }
            $this->assign('ok_tips', $ok_tips);
            $this->assign('error_tips', $error_tips);
        } else {
            $stid = intval($_GET['stid']);
            if ($stid > 0) {
                $now_sort = $this->check_sort($stid, $now_store['store_id']);
            } else {
                $stid = 0;
                $now_sort = array();
            }
            $this->assign('stid', $stid);
            $this->assign('now_sort', $now_sort);
        }
        $this->display();
    }
	
    public function mstdel() {
        $stid = intval($_POST['item_id']);
        $store_id = intval($_POST['storeid']);
        $now_store = $this->check_store($store_id, true);
        if (M('Meal_sort')->where(array('store_id' => $store_id, 'sort_id' => $stid))->delete()) {
            $this->dexit(array('error' => 0));
        } else {
            $this->dexit(array('error' => 1));
        }
    }
	
    /* 检测店铺存在，并检测是不是归属于商家 */
    protected function check_store($store_id, $ajax = false) {
        $database_merchant_store = D('Merchant_store');
        $condition_merchant_store['store_id'] = $store_id;
        $condition_merchant_store['mer_id'] = $this->merchant_session['mer_id'];
        $now_store = $database_merchant_store->field(true)->where($condition_merchant_store)->find();
        if (empty($now_store)) {
            if ($ajax) {
                $this->dexit(array('error' => 1, 'msg' => '店铺不存在'));
            } else {
                $this->error_tips('店铺不存在！');
                exit();
            }
        } else {
            return $now_store;
        }
    }
	
    public function hardware() {
        $staffList = M('Orderprinter')->where(array('mer_id' => $this->merchant_session['mer_id']))->select();
        $this->assign('list', $staffList);
        $this->display();
    }
	
    public function Capital() {
        $this->display();
    }
	
    public function hardware_dell() {
        $id = $this->_get('id', 'intval');
        if ($id == false)
            $this->error_tips('非法操作');
        $staff = M('Orderprinter')->where(array('pigcms_id' => $id, 'mer_id' => $this->merchant_session['mer_id']))->delete();
		$this->assign('url', U('Index/hardware'));
        if ($staff == false) {
            $this->error_tips('删除成功', U('Index/hardware'));
        } else {
            $this->success_tips('删除成功', U('Index/hardware'));
        }
    }
    public function hardware_add() {
        if (IS_POST) {
            $data['mcode'] = $this->_post('mcode');
            $data['username'] = $this->_post('username');
            $data['mkey'] = $this->_post('mkey');
            $data['mp'] = $this->_post('mp');
            $data['count'] = $this->_post('count');
            $data['paid'] = $this->_post('paid');
            $data['store_id'] = $this->_post('store_id');
            $data['mer_id'] = $this->merchant_session['mer_id'];
			$pigcms_id=(int)$this->_post('pigcms_id');
			if($pigcms_id >0){
               $sql = M('Orderprinter')->where(array('pigcms_id'=>$pigcms_id,'mer_id'=>$data['mer_id']))->save($data);
			}else{
			  $sql = M('Orderprinter')->add($data);
			}
            //exit(json_encode(array('error' => '2', 'msg' =>M('Orderprinter')->getLastSql() )));
            if ($sql == false) {
                exit(json_encode(array('error' => '2', 'msg' => M('Orderprinter')->getLastSql())));
            } else {
                exit(json_encode(array('error' => '0', 'msg' =>$pigcms_id >0 ? '修改成功':'添加成功')));
            }
        } else {
            $store = M('Merchant_store')->field('store_id,name')->where(array('status' => 1, 'mer_id' => $this->merchant_session['mer_id']))->select();
            if ($store == false)
                $this->error_tips('您还没创建店铺，无法添加硬件设备');
			$pigcms_id=intval($_GET['id']);
			if($pigcms_id>0){
			   $Orderprinter=M('Orderprinter')->where(array('pigcms_id' => $pigcms_id, 'mer_id' => $this->merchant_session['mer_id']))->find();
			}else{
			   $pigcms_id=0;
			   $Orderprinter=array();
			}
			$this->assign('pigcms_id', $pigcms_id);
			$this->assign('Orderprinter', $Orderprinter);
            $this->assign('store', $store);
            $this->display();
        }
    }
    public function store() {
        $id = $this->_get('store_id', 'intval');
        if (IS_POST) {
            if (empty($_POST['name'])) {
                $this->error_tips('店铺名称必填！');
            }
            if (empty($_POST['phone'])) {
                $this->error_tips('联系电话必填！');
            }
            if (empty($_POST['long']) || empty($_POST['lat'])) {
                $this->error_tips('店铺经纬度必填！');
            }
            if (empty($_POST['adress'])) {
                $this->error_tips('店铺地址必填！');
            }
            if (empty($_POST['permoney'])) {
                $this->error_tips('人均消费必填！');
            }
            if (empty($_POST['feature'])) {
                $this->error_tips('店铺特色必填！');
            }
//             if (empty($_POST['trafficroute'])) {
//                 $this->error_tips('交通路线必填！');
//             }
            if (empty($_POST['pic_detail'])) {
                $this->error_tips('请至少上传一张图片');
            }
            //$_POST['pic_info'] = implode(';', $_POST['pic_detail']);
			$_POST['pic_info'] =$_POST['pic_detail'];
			
			unset($_POST['pic_detail']);
            if (empty($_POST['txt_info'])) {
                $this->error_tips('请输入店铺描述信息');
            }
            //判断关键词
            $keywords = trim($_POST['keywords']);
            if (!empty($keywords)) {
                $tmp_key_arr = explode(' ', $keywords);
                $key_arr = array();
                foreach ($tmp_key_arr as $value) {
                    if (!empty($value)) {
                        array_push($key_arr, $value);
                    }
                }
                if (count($key_arr) > 5) {
                    $this->error_tips('关键词最多5个。');
                }
            }
            //营业时间
            $office_time = array();
            if ($_POST['office_start_time'] != '00:00' || $_POST['office_stop_time'] != '00:00') {
                array_push($office_time, array('open' => $_POST['office_start_time'], 'close' => $_POST['office_stop_time']));
            }
            if ($_POST['office_start_time2'] != '00:00' || $_POST['office_stop_time2'] != '00:00') {
                array_push($office_time, array('open' => $_POST['office_start_time2'], 'close' => $_POST['office_stop_time2']));
            }
            if ($_POST['office_start_time3'] != '00:00' || $_POST['office_stop_time3'] != '00:00') {
                array_push($office_time, array('open' => $_POST['office_start_time3'], 'close' => $_POST['office_stop_time3']));
            }
            $_POST['office_time'] = serialize($office_time);
            $_POST['sort'] = intval($_POST['sort']);
            /* $long_lat = explode(',',$_POST['long_lat']);
              $_POST['long'] = $long_lat[0];
              $_POST['lat'] = $long_lat[1];
             */
            $store_id = intval($_POST['store_id']);
            $_POST['last_time'] = $_SERVER['REQUEST_TIME'];
            $condition_merchant_store['store_id'] = $store_id;
            $condition_merchant_store['mer_id'] = $this->merchant_session['mer_id'];
            unset($_POST['store_id']);
			$database_merchant_store=M('Merchant_store');
            $ismain = intval($_POST['ismain']);
			if($this->config['store_verify']){
				$_POST['status'] = $this->merchant_session['issign'] ? '1' :'2';
			}else{
				$_POST['status'] = '1';
			}
            if ($ismain == 1) {
                $database_merchant_store->where(array('mer_id' => $this->merchant_session['mer_id']))->save(array('ismain' => 0));
            }
            $sflage = false;
            if ($store_id > 0) {
                $sflage = $database_merchant_store->where($condition_merchant_store)->data($_POST)->save();
            } else {
			    $_POST['mer_id']=$this->merid;
                $sflage = $store_id = $database_merchant_store->data($_POST)->add();
                if ($store_id > 0) {
                    M('Merchant_score')->add(array('parent_id' => $insert_id, 'type' => 2));
                }
            }
            if ($sflage) {
                $data_keywords['third_id'] = $store_id;
                $data_keywords['third_type'] = 'Merchant_store';
                $database_keywords = D('Keywords');
                $database_keywords->where($data_keywords)->delete();
                //判断关键词
                if (!empty($key_arr)) {
                    foreach ($key_arr as $value) {
                        $data_keywords['keyword'] = $value;
                        $database_keywords->data($data_keywords)->add();
                    }
                }
                $this->success_tips('创建店铺成功!');
            } else {
                $this->error_tips('创建店铺失败~');
            }
        } else {
            //查询要修改的内容
            $data = array();
            if ($id > 0) {
                $data = M('Merchant_store')->where(array('store_id' => $id, 'mer_id' => $this->merchant_session['mer_id']))->find();
                if (!empty($data)) {
                    $data['office_time'] = unserialize($data['office_time']);
                    if (!empty($data['pic_info'])) {
                        $store_image_class = new store_image();
                        $tmp_pic_arr = explode(';', $data['pic_info']);
                        foreach ($tmp_pic_arr as $key => $value) {
                            $data['pic'][$key] = "'" . $store_image_class->get_image_by_path($value) . "'";
                        }
                        $data['picstr'] = implode(',', $data['pic']);
                    }
                }
                $keywords = D('Keywords')->where(array('third_type' => 'Merchant_store', 'third_id' => $data['store_id']))->select();
                $str = "";
                foreach ($keywords as $key) {
                    $str .= $key['keyword'] . " ";
                }
                $data['keywords'] = $str;
            }
            $this->assign('store', $data);
            /* //营业时间选择
              $time = array('00:00', '00:30', '01:00', '01:30', '02:00', '02:30', '03:00', '03:30', '04:00', '04:30', '05:00', '05:30', '06:00', '06:30', '07:00', '07:30', '08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '13:00', '13:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30', '18:00', '18:30', '19:00', '19:30', '20:00', '20:30', '21:00', '21:30', '22:00', '22:30', '23:00', '23:30');
              $this->assign('time', $time); */
            $this->display();
        }
    }
    public function storemeal() {
        $now_store = $this->check_store($_GET['store_id']);
        if (IS_POST) {
            $deliver_time = array();
            foreach ($_POST['deliver_time'] as $key => $value) {
                if ($value['start'] != '00:00' || $value['stop'] != '00:00') {
                    array_push($deliver_time, $value);
                }
            }
            $_POST['delivery_fee_valid'] = isset($_POST['delivery_fee_valid']) ? intval($_POST['delivery_fee_valid']) : 0;
            if (is_array($deliver_time)) {
                $_POST['deliver_time'] = serialize($deliver_time);
            } else {
                $_POST['deliver_time'] = '';
            }
            $_POST['store_id'] = $now_store['store_id'];
            if (substr($_POST['store_notice'], -1) == ' ') {
                $_POST['store_notice'] = trim($_POST['store_notice']);
            } else {
                $_POST['store_notice'] = $_POST['store_notice'] . ' ';
            }
            if (empty($_POST['store_category'])) {
                $this->error_tips('请至少选一个分类！');
            }
            $leveloff = isset($_POST['leveloff']) ? $_POST['leveloff'] : false;
            unset($_POST['leveloff']);
// 			$database_meal_category = D('Meal_store_category');
// 			$condition_meal_category['cat_id'] = array('in',implode(',',$_POST['store_category']));
// 			$category_list = $database_meal_category->field(true)->where($condition_meal_category)->order('`cat_sort` DESC,`cat_id` ASC')->select();
// 			$category_txt_arr = array();
// 			foreach($category_list as $key=>$value){
// 				array_push($category_txt_arr,$value['cat_name']);
// 			}
// 			$_POST['cat_info'] = implode(' ',$category_txt_arr);
            $cat_ids = array();
            foreach ($_POST['store_category'] as $cat_a) {
                $a = explode('-', $cat_a);
                $cat_ids[] = array('cat_fid' => $a[0], 'cat_id' => $a[1]);
            }
            $newleveloff = array();
            if (!empty($leveloff)) {
                foreach ($leveloff as $kk => $vv) {
                    $vv['type'] = intval($vv['type']);
                    $vv['vv'] = intval($vv['vv']);
                    if (($vv['type'] > 0) && ($vv['vv'] > 0)) {
                        $vv['level'] = $kk;
                        $newleveloff[$kk] = $vv;
                    }
                }
            }
            $_POST['leveloff'] = !empty($newleveloff) ? serialize($newleveloff) : '';
            if ($leveloff === false)
                unset($_POST['leveloff']);
            $database_merchant_store_meal = D('Merchant_store_meal');
            if ($database_merchant_store_meal->data($_POST)->save()) {
                $database_meal_store_category_relation = D('Meal_store_category_relation');
                $condition_meal_store_category_relation['store_id'] = $now_store['store_id'];
                $database_meal_store_category_relation->where($condition_meal_store_category_relation)->delete();
                foreach ($cat_ids as $key => $value) {
                    $data_meal_store_category_relation[$key]['cat_id'] = $value['cat_id'];
                    $data_meal_store_category_relation[$key]['cat_fid'] = $value['cat_fid'];
                    $data_meal_store_category_relation[$key]['store_id'] = $now_store['store_id'];
                }
                $database_meal_store_category_relation->addAll($data_meal_store_category_relation);
                $this->success_tips('编辑成功！', U('Index/store_list'));
            } else {
                $this->error_tips('编辑失败！请重试。');
            }
        } else {
            $database_merchant_store_meal = D('Merchant_store_meal');
            $condition_merchant_store_meal['store_id'] = $now_store['store_id'];
            $store_meal = $database_merchant_store_meal->field(true)->where($condition_merchant_store_meal)->find();
            if (empty($store_meal)) {
                $data_merchant_store_meal['store_id'] = $now_store['store_id'];
                if ($this->config['store_open_payone']) {
                    $data_merchant_store_meal['openpayone'] = 1;
                }
                if ($this->config['store_open_paythree']) {
                    $data_merchant_store_meal['openpaythree'] = 1;
                }
                $data_merchant_store_meal['openpaytwo'] = 1;
                $data_merchant_store_meal['last_time'] = $_SERVER['REQUEST_TIME'];
                $database_merchant_store_meal->data($data_merchant_store_meal)->add();
                $condition_merchant_store_meal['store_id'] = $now_store['store_id'];
                $store_meal = $database_merchant_store_meal->field(true)->where($condition_merchant_store_meal)->find();
                if (empty($store_meal)) {
                    $this->error_tips('初始化失败！请重试。');
                }
            }
            //所有分类
            $database_meal_category = D('Meal_store_category');
            $category_list = $database_meal_category->field(true)->order('`cat_sort` DESC,`cat_id` ASC')->select();
            $list = array();
            foreach ($category_list as $row) {
                if ($row['cat_fid']) {
                    $list[$row['cat_fid']]['list'][] = $row;
                } else {
                    $list[$row['cat_id']] = isset($list[$row['cat_id']]) ? array_merge($list[$row['cat_id']], $row) : $row;
                }
            }
            $this->assign('category_list', $list);
// 			if(!empty($store_meal['cat_info'])){
            //此店铺有的分类
            $database_meal_store_category_relation = D('Meal_store_category_relation');
            $condition_meal_store_category_relation['store_id'] = $now_store['store_id'];
            $relation_list = $database_meal_store_category_relation->field(true)->where($condition_meal_store_category_relation)->select();
            $relation_array = array();
            foreach ($relation_list as $key => $value) {
                array_push($relation_array, $value['cat_id']);
            }
            $this->assign('relation_array', $relation_array);
// 			}
            if (!empty($store_meal['deliver_time'])) {
                $store_meal['deliver_time'] = unserialize($store_meal['deliver_time']);
            } else {
                $store_meal['deliver_time'] = array();
            }
            for ($i = count($store_meal['deliver_time']); $i < 20; $i++) {
                array_push($store_meal['deliver_time'], array('start' => '00:00', 'stop' => '00:00'));
            }
            $this->assign('store_meal', $store_meal);
            $leveloff = !empty($store_meal['leveloff']) ? unserialize($store_meal['leveloff']) : false;
            $levelDb = M('User_level');
            $tmparr = $levelDb->where('22=22')->order('id ASC')->select();
            $levelarr = array();
            if ($tmparr && $this->config['level_onoff']) {
                foreach ($tmparr as $vv) {
                    if (!empty($leveloff) && isset($leveloff[$vv['level']])) {
                        $vv['vv'] = $leveloff[$vv['level']]['vv'];
                        $vv['type'] = $leveloff[$vv['level']]['type'];
                    } else {
                        $vv['vv'] = '';
                        $vv['type'] = '';
                    }
                    $levelarr[$vv['level']] = $vv;
                }
            }
            unset($tmparr);
            $this->assign('levelarr', $levelarr);
            $this->assign('now_store', $now_store);
            $this->display();
        }
    }
    public function store_list() {
        $data = M('Merchant_store')->field(array('`mer_id`,`name`,`store_id`,`status`'))->where(array('mer_id' => $this->merchant_session['mer_id']))->select();
        $this->assign('store', $data);
        if ($data != false) {
            $data = M('Merchant_store')->field(array('mer_id,name,store_id'))->where(array('mer_id' => $this->merchant_session['mer_id']))->select();
            $count['all'] = M('Merchant_store')->where(array('mer_id' => $this->merchant_session['mer_id']))->count();
            $count['status1'] = M('Merchant_store')->where(array('status' => 1, 'mer_id' => $this->merchant_session['mer_id']))->count();
            $count['status2'] = M('Merchant_store')->where(array('status' => 2, 'mer_id' => $this->merchant_session['mer_id']))->count();
            $this->assign('count', $count);
        }
        $this->display();
    }
    /*     * ***桌台管理**** */
    public function tablelist() {
        $now_store = $this->check_store($_GET['store_id']);
        $this->assign('now_store', $now_store);
        $databasetableDb = D('Merchant_store_table');
        $where['store_id'] = $now_store['store_id'];
        //$count = $database->where($where)->count();
        $list = $databasetableDb->field(true)->where($where)->order('`pigcms_id` DESC')->select();
        $this->assign('list', $list);
        $this->display();
    }
    public function mtbdel() {
        $tbid = intval($_POST['item_id']);
        $store_id = intval($_POST['storeid']);
        $now_store = $this->check_store($store_id, true);
        if (M('Merchant_store_table')->where(array('store_id' => $store_id, 'pigcms_id' => $tbid))->delete()) {
            $this->dexit(array('error' => 0));
        } else {
            $this->dexit(array('error' => 1));
        }
    }
    public function staff_add() {
        if (IS_AJAX) {
            $data['tel'] = $this->_post('tel');
            $data['name'] = $this->_post('name');
            $data['username'] = $this->_post('username');
            $data['store_id'] = $this->_post('store_id');
            $data['password'] = md5($this->_post('password'));
            $data['token'] = $this->merchant_session['mer_id'];
            $checkUserName = M('Merchant_store_staff')->where(array('username' => $data['username']))->find();
            if ($checkUserName) {
                exit(json_encode(array('error' => '1', 'msg' => '该店员用户名已经存在，请重新填写')));
            }
            $sql = M('Merchant_store_staff')->add($data);
            if ($sql == false) {
                exit(json_encode(array('error' => '2', 'msg' => '添加失败，请稍候再试')));
            } else {
                exit(json_encode(array('error' => '0', 'msg' => '添加成功')));
            }
        } else {
            $store = M('Merchant_store')->field('store_id,name')->where(array('status' => 1, 'mer_id' => $this->merchant_session['mer_id']))->select();
            $this->assign('store', $store);
            $this->display();
        }
    }
    public function staff() {
        
		$database_merchant_store = M('Merchant_store');
        $mer_id = $this->merchant_session['mer_id'];
        $all_store = $database_merchant_store->where(array('mer_id' => $mer_id, 'status' => 1))->field('store_id,mer_id,name,status')->order('sort desc,store_id  ASC')->select();
        if (empty($all_store)) {
            $this->error_tips('店铺不存在！');
        }
        $allstore = array();
        foreach ($all_store as $vv) {
            $allstore[$vv['store_id']] = $vv;
        }
		$staffList = M('Merchant_store_staff')->where(array('token' => $mer_id))->order('`id` desc')->select();
        $newAllStaff = array();
        if (!empty($staffList)) {
            foreach ($staffList as $sv) {
                if (isset($allstore[$sv['store_id']])) {
                    $sv['storename'] = $allstore[$sv['store_id']]['name'];
                    $sv['mer_id'] = $allstore[$sv['store_id']]['mer_id'];
                    $newAllStaff[] = $sv;
                }
            }
        }
		unset($staff_list, $allstore, $all_store);
        $this->assign('list', $newAllStaff);
        $this->display();
    }
    public function staff_dell() {
        $id = $this->_get('staff_id', 'intval');
        if ($id == false)
            $this->error_tips('非法操作');
        $staff = M('Merchant_store_staff')->where(array('id' => $id, 'token' => $this->merchant_session['mer_id']))->delete();
        if ($staff == false) {
            $this->error_tips('删除成功');
        } else {
            $this->success_tips('删除成功');
        }
    }
    public function staff_edit() {
        if (IS_AJAX) {
            $data['tel'] = $this->_post('tel');
            $data['name'] = $this->_post('name');
            $data['password'] = md5($this->_post('password'));
            $where['token'] = $this->merchant_session['mer_id'];
            $where['id'] = $this->_post('id');
            $sql = M('Merchant_store_staff')->where($where)->save($data);
            if ($sql == false) {
                exit(json_encode(array('error' => '2', 'msg' => '修改失败')));
            } else {
                exit(json_encode(array('error' => '0', 'msg' => '修改成功')));
            }
        } else {
            $id = $this->_get('staff_id', 'intval');
            if ($id == false)
                $this->error_tips('非法操作');
            $staff = M('Merchant_store_staff')->where(array('id' => $id, 'token' => $this->merchant_session['mer_id']))->find();
            if ($id == false)
                $this->error_tips('店员不存在');
            $this->assign('staff', $staff);
            $store = M('Merchant_store')->field('store_id,name')->where(array('status' => 1, 'mer_id' => $this->merchant_session['mer_id']))->select();
            $this->assign('store', $store);
            $this->display();
        }
    }
    protected function check_merchant_file() {
        $filename = substr($_SERVER['PHP_SELF'], strrpos($_SERVER['PHP_SELF'], '/') + 1);
        if ($filename != 'index.php') {
            $this->error_tips('非法访问商家中心！');
        }
    }
    protected function init_opt() { /*     * **实时查找商家的权限*** */
        $tmerch = D("Merchant")->field('menus')->where(array('mer_id' => $this->merchant_session['mer_id']))->find();
        if (empty($tmerch['menus'])) {
            $this->merchant_session['menus'] = '';
        } else {
            $this->merchant_session['menus'] = explode(",", $tmerch['menus']);
        }
        /*         * **实时查找商家的权限*** */
        $this->assign('merchant_session', $this->merchant_session);
    }
    public function login() {
        if ($this->isAjax()) {
            /*$database_merchant = D('Merchant');
            $condition_merchant['account'] = trim($_POST['account']);
            $now_merchant = $database_merchant->field(true)->where($condition_merchant)->find();
            if (empty($now_merchant)) {
                exit(json_encode(array('error' => '2', 'msg' => '账户 ' . $condition_merchant['account'] . ' 不存在！', 'dom_id' => 'account')));
            }
            $pwd = md5(trim($_POST['pwd']));
            if ($pwd != $now_merchant['pwd']) {
                exit(json_encode(array('error' => '3', 'msg' => '密码错误！', 'dom_id' => 'pwd')));
            }
            if ($now_merchant['status'] == 0) {
                exit(json_encode(array('error' => '4', 'msg' => '您被禁止登录！请联系工作人员获得详细帮助。', 'dom_id' => 'account')));
            } else if ($now_merchant['status'] == 2) {
                exit(json_encode(array('error' => '5', 'msg' => '您的帐号正在审核中，请耐心等待或联系工作人员审核。', 'dom_id' => 'account')));
            }
            $data_merchant['mer_id'] = $now_merchant['mer_id'];
            $data_merchant['last_ip'] = get_client_ip(1);
            $data_merchant['last_time'] = $_SERVER['REQUEST_TIME'];
            $data_merchant['login_count'] = $now_merchant['login_count'] + 1;
            if ($database_merchant->data($data_merchant)->save()) {
                $now_merchant['login_count'] += 1;
                if (!empty($now_merchant['last_ip'])) {
                    import('ORG.Net.IpLocation');
                    $IpLocation = new IpLocation();
                    $last_location = $IpLocation->getlocation(long2ip($now_merchant['last_ip']));
                    $now_merchant['last']['country'] = iconv('GBK', 'UTF-8', $last_location['country']);
                    $now_merchant['last']['area'] = iconv('GBK', 'UTF-8', $last_location['area']);
                }
                session('merchant_session', serialize($now_merchant));
                exit(json_encode(array('error' => '0', 'msg' => '登录成功,现在跳转~', 'dom_id' => 'account')));
            } else {
                exit(json_encode(array('error' => '6', 'msg' => '登录信息保存失败,请重试！', 'dom_id' => 'account')));
            }*/
			$this->bindMerchant($account=trim($_POST['account']),$pwd=md5(trim($_POST['pwd'])));
        } else {
			if(empty($_GET['logType'])){
                //判断是否是退出登录
				$this->wxlogin();
			}else {
				if(!empty(session('user')) && empty($_GET['logType'])){
					$mer_id = M('user')->where(array('uid'=>session('user')['uid']))->getField('mer_id');
				}
				if(!empty(session('user')) && !empty($mer_id)){	//判断是否已绑定过商户
					$now_merchant=D('Merchant')->field(true)->where(array('mer_id'=>$mer_id))->find();
					$data_merchant=array();
					$data_merchant['mer_id'] = $now_merchant['mer_id'];
					$data_merchant['last_ip'] = get_client_ip(1);
					$data_merchant['last_time'] = $_SERVER['REQUEST_TIME'];
					$data_merchant['login_count']=$now_merchant['login_count']+1;	  //商户登录次数
					if(D('Merchant')->data($data_merchant)->save()){    //判断商户是否更新成功
						$now_merchant['login_count'] += 1;
						if(!empty($now_merchant['last_ip'])) {
							import('ORG.Net.IpLocation');
							$IpLocation = new IpLocation();
							$last_location = $IpLocation->getlocation(long2ip($now_merchant['last_ip']));
							$now_merchant['last']['country'] = iconv('GBK', 'UTF-8', $last_location['country']);
							$now_merchant['last']['area'] = iconv('GBK', 'UTF-8', $last_location['area']);
						}
						session('merchant_session', serialize($now_merchant));	//商户登录会话信息
						redirect(U('Index/index'));		//商户登录成功
					}	
				}else{
					$referer = isset($_GET['referer']) ? htmlspecialchars_decode(urldecode($_GET['referer']), ENT_QUOTES) : '';
					$this->assign('refererUrl', $referer);
					$this->display();
				}
			}
        }
    }
    public function merreg() {
        $this->display();
    }
    public function mer_reg() {
        if (IS_AJAX && IS_POST) {
            if (md5($_POST['verify']) != $_SESSION['merchant_reg_verify']) {
                $this->dexit(array('error' => 1, 'msg' => '验证码不正确！', 'dom_id' => 'verify'));
            }
            //帐号
            $database_merchant = D('Merchant');
            $condition_merchant['account'] = $_POST['account'];
            $now_merchant = $database_merchant->field('`mer_id`')->field(true)->where($condition_merchant)->find();
            if (!empty($now_merchant)) {
                $this->dexit(array('error' => 2, 'msg' => '帐号已经存在！', 'dom_id' => 'account'));
            }
            //名称
            $_POST['name'] = $condition_merchant['name'] = $_POST['mername'];
            unset($_POST['mername']);
            $now_merchant = $database_merchant->field('`mer_id`')->field(true)->where($condition_merchant)->find();
            if (!empty($now_merchant)) {
                $this->dexit(array('error' => 3, 'msg' => '商家名称已经存在！', 'dom_id' => 'email'));
            }
            //邮箱
            $condition_merchant['email'] = $_POST['email'];
            $now_merchant = $database_merchant->field('`mer_id`')->field(true)->where($condition_merchant)->find();
            if (!empty($now_merchant)) {
                $this->dexit(array('error' => 4, 'msg' => '邮箱已经存在！', 'dom_id' => 'email'));
            }
            //手机号
            $condition_merchant['phone'] = $_POST['phone'];
            $now_merchant = $database_merchant->field('`mer_id`')->field(true)->where($condition_merchant)->find();
            if (!empty($now_merchant)) {
                $this->dexit(array('error' => 5, 'msg' => '手机号已经存在！', 'dom_id' => 'phone'));
            }
            $config = D('Config')->get_config();
            $this->assign('config', $config);
            $_POST['mer_id'] = null;
            if ($config['merchant_verify']) {
                $_POST['status'] = 2;
            } else {
                $_POST['status'] = 1;
            }
            $_POST['pwd'] = md5($_POST['pwd']);
            $_POST['reg_ip'] = get_client_ip(1);
            $_POST['reg_time'] = $_SERVER['REQUEST_TIME'];
            $_POST['login_count'] = 0;
            $_POST['reg_from'] = 0;
            if ($insert_id = $database_merchant->data($_POST)->add()) {
                M('Merchant_score')->add(array('parent_id' => $insert_id, 'type' => 1));
                if ($config['merchant_verify']) {
                    $this->dexit(array('error' => 0, 'msg' => '注册成功,请耐心等待审核或联系工作人员审核。~', 'dom_id' => 'account'));
                } else {
                    $this->dexit(array('error' => 0, 'msg' => '注册成功,请登录~', 'dom_id' => 'account'));
                }
            } else {
                $this->dexit(array('error' => 6, 'msg' => '注册失败,请重试！', 'dom_id' => 'account'));
            }
        }
        $this->dexit(array('error' => 1, 'msg' => '帅哥OR美女你的请求失败啦！', 'dom_id' => ''));
    }
    public function verify() {
        $verify_type = $_GET['type'];
        if (empty($verify_type)) {
            exit;
        }
        import('ORG.Util.Image');
        Image::buildImageVerify(4, 1, 'jpeg', 53, 26, 'merchant_' . $verify_type . '_verify');
    }
    /*     * ****登陆店员中心******* */
    public function loginStaff() {
        $id = intval($_GET['id']);
        $store_id = intval($_GET['store_id']);
        $mer_id = $this->merchant_session['mer_id'];
        if (($id > 0) && ($store_id > 0)) {
            $store_staffDb = D('Merchant_store_staff');
            $now_staff = $tmp = $store_staffDb->field(true)->where(array('id' => $id, 'store_id' => $store_id, 'token' => $mer_id))->find();
            if (!empty($tmp)) {
                session('staff_session', serialize($tmp));
                $this->redirect(U('Wap/Storestaff/index'));
                exit();
            }
        }
        $this->error_tips('登陆失败！');
        exit();
    }
    /*     * *商家二维码** */
    public function merchantewm() {
        /*if (empty($this->merchant_session['qrcode_id'])) {
            $qrcode_return = D('Recognition')->get_new_qrcode('merchant', $this->merchant_session['mer_id']);
        } else {
            $qrcode_return = D('Recognition')->get_qrcode($this->merchant_session['qrcode_id']);
        }*/
		if (!empty($this->merchant_session['mer_id'])) {
            $qrcode_return = D('Recognition')->get_new_qrcode('merchant', $this->merchant_session['mer_id']);
        } else {
            $qrcode_return = D('Recognition')->get_qrcode($this->merchant_session['qrcode_id']);
        }
        $this->assign('qrcodeinfo', $qrcode_return);
        $this->display();
    }
    /*     * *店员管理** */
    public function mClerk() {
        $database_merchant_store = D('Merchant_store');
        $mer_id = $this->merchant_session['mer_id'];
        $all_store = $database_merchant_store->where(array('mer_id' => $mer_id, 'status' => 1))->field('store_id,mer_id,name,status')->order('sort desc,store_id  ASC')->select();
        if (empty($all_store)) {
            $this->error_tips('店铺不存在！');
        }
        $allstore = array();
        foreach ($all_store as $vv) {
            $allstore[$vv['store_id']] = $vv;
        }
        $m_s_staffDb = D('Merchant_store_staff');
        $staff_list = $m_s_staffDb->where(array('token' => $mer_id))->order('`id` desc')->select();
        $newAllStaff = array();
        if (!empty($staff_list)) {
            foreach ($staff_list as $sv) {
                if (isset($allstore[$sv['store_id']])) {
                    $sv['storename'] = $allstore[$sv['store_id']]['name'];
                    $sv['mer_id'] = $allstore[$sv['store_id']]['mer_id'];
                    $newAllStaff[] = $sv;
                }
            }
        }
        unset($staff_list, $allstore, $all_store);
        $this->assign('staff_list', $newAllStaff);
        $this->display();
    }
    /*     * *****删除店员******** */
    public function clerk_del() {
        $database_merchant_store = D('Merchant_store');
        $store_id = intval($_POST['storeid']);
        $id = intval($_POST['id']);
        $mer_id = $this->merchant_session['mer_id'];
        $now_store = $database_merchant_store->where(array('store_id' => $store_id, 'mer_id' => $mer_id))->find();
        if (empty($now_store)) {
            exit(json_encode(array('error' => 1, 'msg' => '店铺不存在！')));
        }
        $company_staff_db = M('Merchant_store_staff');
        if ($company_staff_db->where(array('id' => $id, 'token' => $mer_id))->delete()) {
            exit(json_encode(array('error' => 0, 'msg' => 'OK')));
        } else {
            exit(json_encode(array('error' => 1, 'msg' => '删除失败！')));
        }
    }
    /*     * *****添加店员信息******** */
    public function clerk_set() {
        $database_merchant_store = D('Merchant_store');
        $store_id = isset($_GET['store_id']) ? intval($_GET['store_id']) : 0;
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $mer_id = $this->merchant_session['mer_id'];
        $company_staff_db = M('Merchant_store_staff');
        if (IS_POST) {
            if (!trim($_POST['name']) || !trim($_POST['username'])) {
                $this->error_tips('姓名、帐号都不能为空');
            }
            $data['name'] = trim($_POST['name']);
            $data['username'] = trim($_POST['username']);
            $data['token'] = $mer_id;
            $data['time'] = time();
            $itemid = isset($_POST['id']) ? intval($_POST['id']) : 0;
            if (!($itemid > 0)) {
                $tmp = $company_staff_db->field('`id`')->where(array('username' => $data['username']))->find();
                if (!empty($tmp)) {
                    $this->error_tips('帐号已经存在！请换一个。');
                }
                if (!trim($_POST['password'])) {
                    $this->error_tips('密码不能为空');
                }
                $data['store_id'] = intval($_POST['store_id']);
                $data['password'] = md5(trim($_POST['password']));
                if (!$company_staff_db->add($data)) {
                    $this->error_tips('添加失败，请重试。');
                } else {
                    $this->success_tips('店员添加成功！', U('Commerce/mClerk'));
                }
            } else {
                /* 检测帐号 */
                $username_staff = $company_staff_db->field('`id`')->where(array('id' => $itemid))->find();
                if (empty($username_staff)) {
                    $this->error_tips('帐号不存在！请换一个。');
                }
                if (trim($_POST['password'])) {
                    $data['password'] = md5(trim($_POST['password']));
                }
                if (!$company_staff_db->where(array('id' => $itemid))->save($data)) {
                    $this->error_tips('修改失败，请重试。');
                } else {
                    $this->success_tips('操作成功', U('Commerce/mClerk'));
                }
            }
        } else {
            if ($id > 0) {
                $thisItem = $company_staff_db->where(array('id' => $id, 'store_id' => $store_id))->find();
            } else {
                $thisItem = array('name' => '', 'username' => '', 'tel' => '');
            }
            $all_store = $database_merchant_store->where(array('mer_id' => $mer_id, 'status' => 1))->field('store_id,mer_id,name,status')->order('sort desc,store_id  ASC')->select();
            $this->assign('id', isset($thisItem['id']) ? $thisItem['id'] : 0);
            $this->assign('store_id', isset($thisItem['store_id']) ? $thisItem['store_id'] : 0);
            $this->assign('all_store', $all_store);
            $this->assign('item', $thisItem);
            $this->display();
        }
    }
    /*     * *****订餐***** */
    public function meal() {
        $mer_id = $this->merchant_session['mer_id'];
        $db_arr = array(C('DB_PREFIX') . 'area' => 'a', C('DB_PREFIX') . 'merchant_store' => 's');
        $store_list = D()->table($db_arr)->field(true)->where("`s`.`mer_id`='$mer_id' AND `s`.`status`!='2' AND `s`.`have_meal`='1' AND `s`.`area_id`=`a`.`area_id`")->order('`sort` DESC,`store_id` ASC')->select();
        $this->assign('store_list', $store_list);
        $this->display();
    }
    /*     * *****团购***** */
    public function group() {
        $database_group = D('Group');
        $condition_group['mer_id'] = $this->merchant_session['mer_id'];
        $group_list = $database_group->field(true)->where($condition_group)->order('`group_id` DESC')->select();
        $this->assign('group_list', $group_list);
        $this->display();
    }
    /*     * *商家二维码** */
    public function erwm() {
        $type = trim($_POST['type']);
        $id = trim($_POST['sid']);
        if ($type == 'group') {
            $pigcms_return = D('Group')->get_qrcode($id);
        } elseif ($type == 'meal') {
            $pigcms_return = D('Merchant_store')->get_qrcode($id);
        }
        if (empty($pigcms_return['qrcode_id'])) {
            $qrcode_return = D('Recognition')->get_new_qrcode($type, $id);
        } else {
            $qrcode_return = D('Recognition')->get_qrcode($pigcms_return['qrcode_id']);
        }
        exit(json_encode($qrcode_return));
    }
    /*     * *商家统计** */
    public function statistical() {
        $condition_merchant_request['mer_id'] = $this->merchant_session['mer_id'];
        $today_zero_time = mktime(0, 0, 0, date('m', $_SERVER['REQUEST_TIME']), date('d', $_SERVER['REQUEST_TIME']), date('Y', $_SERVER['REQUEST_TIME']));
        $condition_merchant_request['time'] = array(array('egt', $today_zero_time - ((7 - 1) * 86400)), array('elt', $today_zero_time));
        $request_list = M('Merchant_request')->field(true)->where($condition_merchant_request)->order('`time` ASC')->select();
        foreach ($request_list as $value) {
            $tmp_time = date('Ymd', $value['time']);
            $tmp_array[$tmp_time] = $value;
        }
        for ($i = 1; $i <= 7; $i++) {
            $tmp_time = date('Ymd', $today_zero_time - (($i - 1) * 86400));
            if (empty($tmp_array[$tmp_time])) {
                $tmp_array[$tmp_time] = array('time' => $today_zero_time - (($i - 1) * 86400));
            }
        }
        foreach ($tmp_array as $key => $value) {
            //基础统计
            $pigcms_list['xAxis_arr'][] = '"' . date('j', $value['time']) . '日"';
            $pigcms_list['follow_arr'][] = '"' . intval($value['follow_num']) . '"';
            $pigcms_list['img_arr'][] = '"' . intval($value['img_num']) . '"';
            $pigcms_list['website_hits_arr'][] = '"' . intval($value['website_hits']) . '"';
            //团购统计
            $pigcms_list['group_hits_arr'][] = '"' . intval($value['group_hits']) . '"';
            $pigcms_list['group_buy_count_arr'][] = '"' . intval($value['group_buy_count']) . '"';
            $pigcms_list['group_buy_money_arr'][] = '"' . floatval($value['group_buy_money']) . '"';
            //订餐统计
            $pigcms_list['meal_hits_arr'][] = '"' . intval($value['meal_hits']) . '"';
            $pigcms_list['meal_buy_count_arr'][] = '"' . intval($value['meal_buy_count']) . '"';
            $pigcms_list['meal_buy_money_arr'][] = '"' . floatval($value['meal_buy_money']) . '"';
        }
        //基础统计
        $pigcms_list['xAxis_txt'] = implode(',', $pigcms_list['xAxis_arr']);
        $pigcms_list['follow_txt'] = implode(',', $pigcms_list['follow_arr']);
        $pigcms_list['img_txt'] = implode(',', $pigcms_list['img_arr']);
        $pigcms_list['website_hits_txt'] = implode(',', $pigcms_list['website_hits_arr']);
        //团购统计
        $pigcms_list['group_hits_txt'] = implode(',', $pigcms_list['group_hits_arr']);
        $pigcms_list['group_buy_count_txt'] = implode(',', $pigcms_list['group_buy_count_arr']);
        $pigcms_list['group_buy_money_txt'] = implode(',', $pigcms_list['group_buy_money_arr']);
        //订餐统计
        $pigcms_list['meal_hits_txt'] = implode(',', $pigcms_list['meal_hits_arr']);
        $pigcms_list['meal_buy_count_txt'] = implode(',', $pigcms_list['meal_buy_count_arr']);
        $pigcms_list['meal_buy_money_txt'] = implode(',', $pigcms_list['meal_buy_money_arr']);
        $this->assign($pigcms_list);
        krsort($tmp_array);
        $this->assign('request_list', $tmp_array);
        $this->display();
    }
    public function img_uplode() {
        $tokenData = D('Access_token_expires')->get_access_token();
        if (isset($tokenData['access_token'])) {
            $media_id = trim($_POST['media_id']);
            $imgtype = isset($_POST['imgcfy']) ? trim($_POST['imgcfy']) : 'img';
            $getimgurl = 'http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=' . $tokenData['access_token'] . '&media_id=' . $media_id;
            $imgtmpdata = $this->httpRequest($getimgurl);
            if ($imgtmpdata['1']) {
                $img_mer_id = sprintf("%09d", $this->merchant_session['mer_id']);
                $rand_num = substr($img_mer_id, 0, 3) . '/' . substr($img_mer_id, 3, 3) . '/' . substr($img_mer_id, 6, 3);
                $upload_dir = "/upload/" . $imgtype . "/{$rand_num}/";
                if (!is_dir('.' . $upload_dir)) {
                    mkdir('.' . $upload_dir, 0777, true);
                }
                $imgfile = date('mdHis') . createRandomStr(7, false, true) . '.jpg';
                file_put_contents('.' . $upload_dir . $imgfile, $imgtmpdata['1']);
                file_put_contents('.' . $upload_dir . 's_' . $imgfile, $imgtmpdata['1']);
                file_put_contents('.' . $upload_dir . 'm_' . $imgfile, $imgtmpdata['1']);
                /* // file_put_contents(DATA_PATH . 'wx11111111111img.log', "\n".$upload_dir.$imgfile . "\n\n".$rand_num.','.$imgfile."\n\n".json_encode($_POST), FILE_APPEND); */
                $this->dexit(array('error' => 0, 'imgsrc' => $upload_dir . $imgfile, 'imgpath' => $rand_num . ',' . $imgfile));
            }
        }
        $this->dexit(array('error' => 1, 'imgsrc' => '', 'imgpath' => ''));
    }
    public function logout() {
        session('merchant_session', null);
		session('is_Merchant',null);
		//session('user', null);
        header('Location: ' . U('Index/login',array('logType'=>'logout')));
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
	
	/* 商家转账二维码生成(带logo且转短地址)
	* @time 2016-04-22
	* @author	小邓  <969101097@qq.com>*/
	public function merchant_qrcode(){
		import('@.ORG.phpqrcode');	//引入二维码类
		$qrCon=urlencode(C('config.site_url').'/wap.php?g=Wap&c=Pay&a=give_money&mer_id='.$this->merchant_session['mer_id']); //url数据
		$ch = curl_init();
		$url = 'http://apis.baidu.com/3023/shorturl/shorten?url_long='.$qrCon;
		$header = array(
			'apikey: 603adaa4a3e928c50af7d2e8f18633f7',
		);		
		curl_setopt($ch, CURLOPT_HTTPHEADER ,$header);	// 添加apikey到header
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// 执行HTTP请求
		curl_setopt($ch , CURLOPT_URL , $url);
		$res = curl_exec($ch);
		$test_arr=json_decode($res);
		$short_arr=array();	
		if(is_object($test_arr)){
			$short_arr=(array)$test_arr;
		}else{
			$short_arr=$test_arr;
		}
		$result_arr=array();
		if(is_object($short_arr['urls'][0])){
			$result_arr=(array)$short_arr['urls'][0];
		}
		$img_info=str_replace(',','/',$this->merchant_session['img_info']);
		$logo=C('config.site_url').'/upload/merchant/'.$img_info;	//获取logo图片
		$qrcodepay_arr=array(
			'mer_id'=>$this->merchant_session['mer_id'],//商户ID
			'logo'=>$logo,		//logo图片
			'url_short'=>$result_arr['url_short']	//url数据
		);
		//$this->assign('qrcodepay_arr',$qrcodepay_arr);	//付款二维码数据
		QRcode::png($qrcodepay_arr['url_short'],'qrcode/qrcode'.$qrcodepay_arr['mer_id'].'.png','H',11,2);
		$QR = 'qrcode/qrcode'.$qrcodepay_arr['mer_id'].'.png';	//已经生成的原始二维码图
		$logo = $qrcodepay_arr['logo'];	//logo图片
		if($logo!==FALSE&&$QR!==FALSE){   
			$QR=imagecreatefromstring(file_get_contents($QR));   
			$logo=imagecreatefromstring(file_get_contents($logo));   
			$QR_width = imagesx($QR);//二维码图片宽度   
			$QR_height = imagesy($QR);//二维码图片高度   
			$logo_width = imagesx($logo);//logo图片宽度   
			$logo_height = imagesy($logo);//logo图片高度   
			$logo_qr_width = $QR_width/4;   
			$scale = $logo_width/$logo_qr_width;   
			$logo_qr_height = $logo_height/$scale;   
			$from_width =($QR_width - $logo_qr_width)/2;   //重新组合图片并调整大小   
			imagecopyresampled($QR,$logo,$from_width,$from_width,0,0,$logo_qr_width,$logo_qr_height,$logo_width,$logo_height); 
		}  //输出图片  
		//Header("Content-type: image/png"); 
		//ImagePng($QR);	
		imagepng($QR,'qrcode/qrcodeImg'.$qrcodepay_arr['mer_id'].'.png'); 
		//echo 'qrcodeImg'.$qrcodepay_arr['mer_id'].'.png'; 
		$this->assign('qrcodeImg','qrcode/qrcodeImg'.$qrcodepay_arr['mer_id'].'.png');
		$this->display();
    }
	
	/* 微信快捷登录
	* @time 2016-04-22
	* @author	小邓  <969101097@qq.com>*/
	public function wxlogin(){
		if(empty(session('user'))){	//判断是否已登录
			redirect(U('Wap/Login/weixin',array('referer'=>urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']))));
		}else{
			//echo '登录成功';
            if(isset(session('user')['uid'])){
                $mer_id = M('user')->where(array('uid'=>session('user')['uid']))->getField('mer_id');
            }
//			print_r($mer_id); exit;
			if(!$mer_id){	//判断是否绑定过商户
				$this->error('你尚未绑定任何商户',U('Index/login',array('logType'=>'logout')),1);
			}else{
				$now_merchant=D('Merchant')->field(true)->where(array('mer_id'=>$mer_id))->find();
				$data_merchant=array();
				$data_merchant['mer_id'] = $now_merchant['mer_id'];
				$data_merchant['last_ip'] = get_client_ip(1);
				$data_merchant['last_time'] = $_SERVER['REQUEST_TIME'];
				$data_merchant['login_count']=$now_merchant['login_count']+1;	  //商户登录次数
				if(D('Merchant')->data($data_merchant)->save()){    //判断商户是否更新成功
					$now_merchant['login_count'] += 1;
					if(!empty($now_merchant['last_ip'])) {
						import('ORG.Net.IpLocation');
						$IpLocation = new IpLocation();
						$last_location = $IpLocation->getlocation(long2ip($now_merchant['last_ip']));
						$now_merchant['last']['country'] = iconv('GBK', 'UTF-8', $last_location['country']);
						$now_merchant['last']['area'] = iconv('GBK', 'UTF-8', $last_location['area']);
					}
					session('merchant_session', serialize($now_merchant));	//商户登录会话信息
					redirect(U('Index/index'));		//商户登录成功
				}	
			}							          
		}
    }
	
	/* 绑定商家
	* account 账号
	* pwd 	密码
	* @time 2016-04-26
	* @author	小邓  <969101097@qq.com>*/
	public function bindMerchant($account='',$pwd=''){
		$merchant_find=D('Merchant')->where(array('account'=>$account,'pwd'=>$pwd))->find();
		if($merchant_find){	//判断绑定此商户是否存在
			$data_merchant['mer_id'] = $merchant_find['mer_id'];
            $data_merchant['last_ip'] = get_client_ip(1);
            $data_merchant['last_time'] = $_SERVER['REQUEST_TIME'];
            $data_merchant['login_count'] = $merchant_find['login_count'] + 1;
			if($merchant_find['uid']){	//判断是否已存在绑定的用户
				$openid_arr=explode(',',$merchant_find['uid']);
				if(in_array(session('user')['uid'],$openid_arr) || $openid_arr==session('user')['uid']){	//判断是否已绑定过此商户
					//$this->error_tips('您已绑定过当前商户，不可重复绑定！');
					$merchant_find['login_count'] += 1;
					if(!empty($merchant_find['last_ip'])) {
						import('ORG.Net.IpLocation');
						$IpLocation = new IpLocation();
						$last_location = $IpLocation->getlocation(long2ip($merchant_find['last_ip']));
						$merchant_find['last']['country']=iconv('GBK', 'UTF-8', $last_location['country']);
						$merchant_find['last']['area']=iconv('GBK', 'UTF-8', $last_location['area']);
					}
					session('merchant_session', serialize($merchant_find));
					exit(json_encode(array('error'=>'0','msg'=>'您已绑定过当前商户！','dom_id'=>'account')));					
				}else{
					if(count($openid_arr)>=10){	//判断绑定人数是否已满
						exit(json_encode(array('error' =>'6','msg'=>'当前商户绑定用户过多，请联系管理员解决！','dom_id'=>'account')));
					}else{
						$users_openid = $merchant_find['uid'].','.session('user')['uid'];
						$merchant_alter=D('Merchant')->where(array('mer_id' => $merchant_find['mer_id']))->data(array('uid' => $users_openid))->save();
						//商家id存入用户表
						M('user')->where(array('uid'=>session('user')['uid']))->setField('mer_id',$merchant_find['mer_id']);
						if($merchant_alter){
							//$this->success_tips('绑定成功！');
							$merchant_find['login_count'] += 1;
							if(!empty($merchant_find['last_ip'])) {
								import('ORG.Net.IpLocation');
								$IpLocation = new IpLocation();
								$last_location = $IpLocation->getlocation(long2ip($merchant_find['last_ip']));
								$merchant_find['last']['country']=iconv('GBK', 'UTF-8', $last_location['country']);
								$merchant_find['last']['area']=iconv('GBK', 'UTF-8', $last_location['area']);
							}
							session('merchant_session', serialize($merchant_find));
							exit(json_encode(array('error'=>'0','msg'=>'绑定成功！','dom_id'=>'account')));	
						}else{
							exit(json_encode(array('error' =>'6','msg'=>'绑定失败！','dom_id'=>'account')));
						}
					}					
				}
			}else{
				$merchant_alter=D('Merchant')->where(array('mer_id'=>$merchant_find['mer_id']))->data(array('uid'=>session('user')['uid']))->save();
				//商家id存入用户表
				M('user')->where(array('uid'=>session('user')['uid']))->setField('mer_id',$merchant_find['mer_id']);
				if($merchant_alter){
					$merchant_find['login_count'] += 1;
					if(!empty($merchant_find['last_ip'])) {
						import('ORG.Net.IpLocation');
						$IpLocation = new IpLocation();
						$last_location = $IpLocation->getlocation(long2ip($merchant_find['last_ip']));
						$merchant_find['last']['country']=iconv('GBK', 'UTF-8', $last_location['country']);
						$merchant_find['last']['area']=iconv('GBK', 'UTF-8', $last_location['area']);
					}
					session('merchant_session', serialize($merchant_find));
					exit(json_encode(array('error'=>'0','msg'=>'绑定成功！','dom_id'=>'account')));	
				}else{
					exit(json_encode(array('error' =>'6','msg'=>'绑定失败！','dom_id'=>'account')));
				}
			}
		}else{
			exit(json_encode(array('error' =>'6','msg'=>'你输入的商户账号或密码不对，请重新输入','dom_id'=>'account')));
		}
	}
	
}
?>