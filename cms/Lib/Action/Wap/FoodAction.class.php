<?php
class FoodAction extends BaseAction
{
	public $store_id = 0;
	
	public $_store = null;
	
	public $session_index = '';
	
	public $session_table_index = '';
	
	public $order_index = '';

	public $leveloff = '';
	
	public function __construct(){
		parent::__construct();
		
		$this->store_id = isset($_REQUEST['store_id']) ? intval($_REQUEST['store_id']) : 0;
		
		$this->assign('store_id', $this->store_id);
		
		/* 粉丝行为分析 */
		D('Merchant_request')->add_request($this->mer_id, array('meal_hits' => 1));
		
		//店铺详情
		$merchant_store = M("Merchant_store")->where(array('store_id' => $this->store_id))->find();
		if($merchant_store['store_id']=='42'){
            $this->success("包厢预约请联系<br>邹经理<br>电话：‭13907172678‬");die;
        }

		if($merchant_store['status']=='0'){
            $this->error("抱歉，该店铺目前已关闭!");
        }
		$merchant_store['office_time'] = unserialize($merchant_store['office_time']);
		$store_image_class = new store_image();
		$merchant_store['images'] = $store_image_class->get_allImage_by_path($merchant_store['pic_info']);
		$t = $merchant_store['images'];
		$merchant_store['image'] = array_shift($t);
		
		$merchant_store_meal = M("Merchant_store_meal")->where(array('store_id' => $this->store_id))->find();
		if ($merchant_store_meal) $merchant_store = array_merge($merchant_store, $merchant_store_meal);
		$this->leveloff=!empty($merchant_store_meal['leveloff']) ? unserialize($merchant_store_meal['leveloff']) :'';
		$this->_store = $merchant_store;
		$this->assign('store', $this->_store);
		

		$this->session_index = "session_foods{$this->store_id}_{$this->mer_id}";
		$this->session_table_index = "session_table_{$this->store_id}_{$this->mer_id}";
		$this->order_index = "order_id_{$this->store_id}_{$this->mer_id}";
		if ($_SESSION['openid'] && ($services = D('Customer_service')->where(array('mer_id' => $this->mer_id))->select())) {
			$key = $this->get_encrypt_key(array('app_id'=>$this->config['im_appid'],'openid' => $_SESSION['openid']), $this->config['im_appkey']);
			$kf_url = ($this->config['im_url'] ? $this->config['im_url'] : 'http://im-link.meihua.com').'/?app_id=' . $this->config['im_appid'] . '&openid=' . $_SESSION['openid'] . '&key=' . $key . '#serviceList_' . $this->mer_id;
			$this->assign('kf_url', $kf_url);
		}


		//店铺公告
        $notice_model = new NoticeModel();
		$this->assign('mer_notice',$notice_model->get_newest_notice($this->mer_id));

	}
	
	public function index(){
		$name = isset($_GET['searhkey']) ? htmlspecialchars($_GET['searhkey']) : '';
		$where = array('mer_id' => $this->mer_id, 'have_meal' => 1);
		if ($name) $where['name'] = array('like', '%'.$name.'%');
		$stores = D('Merchant_store')->field(true)->where($where)->select();
		$store_image_class = new store_image();
		$list = array();
		foreach ($stores as $row) {
			$temp = array();
			$temp['position'] = array('lng' => $row['long'], 'lat' => $row['lat']);
			$temp['name'] = $row['name'];
			$temp['btndisabled'] = 0;
			$temp['isShow'] = 0;
			$temp['seeURL'] = '';
			$temp['showList'] = array();
			$temp['btnText'] = '我买';
			$temp['btnUrl'] = U('Food/menu', array('mer_id' => $row['mer_id'], 'store_id' => $row['store_id']));
			$temp['address'] = $row['adress'];
			$images = $store_image_class->get_allImage_by_path($row['pic_info']);
			$temp['imgurl'] = array_shift($images);
		
			$temp['storeDetailsURL'] = U('Food/shop', array('mer_id' => $row['mer_id'], 'store_id' => $row['store_id']));//'wap.php?mod=takeout&action=menu&com_id=' . $row['com_id'] . '&id=' . $row['id'];
			$list[] = $temp;
		}
		$this->assign('list', json_encode($list));
		$this->assign('total', count($list));
		
		$this->display();
	}
	
	
	public function shop(){
		empty($this->_store) && $this->error("不存在的商家店铺!");
		if ($this->_store['store_type'] == 2) {
			$this->redirect(U('Takeout/menu', array('mer_id' => $this->mer_id, 'store_id' => $this->_store['store_id'])));
		}
		$this->behavior(array('mer_id' => $this->mer_id, 'biz_id' => $this->store_id));
        if($this->_store['reply_count']){
            $reply_list = D('Reply')->get_reply_list($this->_store['store_id'], 1, 0, 10);

            $this->assign('reply_list',$reply_list);
        }
        $this->display();
	}
	
	
	public function shop_detail(){
		empty($this->_store) && $this->error("不存在的商家店铺!");
		if($this->_store['reply_count']){
			$reply_list = D('Reply')->get_reply_list($this->_store['store_id'], 1, 0, 10);
			$this->assign('reply_list',$reply_list);
		}
		
		$this->display();
	}
	
	public function ajaxreply(){
		$page = isset($_GET['page']) ? intval($_GET['page']) : 2;
		$pagesize = isset($_GET['pagesize']) ? intval($_GET['pagesize']) : 10;
		$start = ($page - 1) * $pagesize;
		$reply_list = D('Reply')->ajax_reply_list($this->_store['store_id'], 1, 0, $pagesize, $start);
		exit(json_encode(array('data' => $reply_list)));
		
		$html = '';
		foreach ($reply_list as $vo) {
			$html .= '<dd class="dd-padding">';
			$html .= '<div class="feedbackCard">';
			$html .= '<div class="userInfo">';
			$html .= '<weak class="username">' . $vo['nickname'] . '</weak>';
			$html .= '</div>';
			$html .= '<div class="score">';
			$html .= '<span class="stars">';
			for($i = 0; $i < 6; $i++) {
				if ($vo['score'] > $i) {
					$html .= '<i class="text-icon icon-star"></i>';
				} else {
					$html .= '<i class="text-icon icon-star-gray"></i>';
				}
			}
			$html .= '</span>';
			$html .= '<weak class="time">' . $vo['add_time'] . '</weak>';
			$html .= '</div>';
			$html .= '<div class="comment">';
			$html .= '<p>' . $vo['comment'] . '</p>';
			$html .= '</div>';
			if ($vo['pics']) {
				$html .= '<div class="pics view_album" data-pics="';
				$i = 1;
				foreach ($vo['pics'] as $vvoo) {
					$html .= $vvoo['m_image'];
					if (count($vo['pics']) > $i) {
						$html .= ',';
					}
					$i ++;
				}
				$html .= '">';
				foreach ($vo['pics'] as $voo) {
					$html .= '<span class="pic-container imgbox" style="background:none;"><img src="' . $voo['s_image'] . '" style="width:100%;"/></span>&nbsp;';
				}
				$html .= '</volist>';
				$html .= '</div>';
			}
			$html .= '</div>';
			$html .= '</dd>';
		}
	}
	
	public function menu(){
		empty($this->_store) && $this->error("不存在的商家店铺!");
		$orid = isset($_GET['orid']) ? intval($_GET['orid']) : 0;

		$tableid = isset($_GET['tableid']) ? intval($_GET['tableid']) : 0;
		if ($now_table = D('Merchant_store_table')->field(true)->where(array('pigcms_id' => $tableid, 'store_id' => $this->_store['store_id']))->find()) {
			$_SESSION[$this->session_table_index] = $tableid;
		}

		//客户的购物车记录
		$disharr = unserialize($_SESSION[$this->session_index]);
		if ($order = $this->check_order($orid)) {
			if ($order['paid'] != 1) {
				$info = unserialize($order['info']);
				foreach ($info as $om) {
					if (isset($disharr[$om['id']])) {
						$disharr[$om['id']]['num'] += $om['num'];
					} else {
						$disharr[$om['id']]['num'] = $om['num'];
					}
				}
			}
			$this->assign('orid', $orid);
		} else {
			$this->assign('orid', 0);
		}

		/**************客户收藏的菜品*****************/
		$like = D('Meal_like')->field('meal_ids')->where(array('uid' => $this->user_session['uid'], 'store_id' => $this->store_id, 'mer_id' => $this->mer_id))->find();
		$meal_ids = array();
		$like && $meal_ids = unserialize($like['meal_ids']);
		/**************客户收藏的菜品*****************/
		
		//菜品分类
		$sorts = M("Meal_sort")->where(array('store_id' => $this->store_id))->order('sort DESC, sort_id DESC')->select();
		$t_meals = $meals = $list = array();
		$ids = array();
		foreach ($sorts as $sort) {
			if ($sort['is_weekshow']) {
				$week = explode(",", $sort['week']);
				if (in_array(date("w"), $week)) {
					$list[$sort['sort_id']] = $sort;
					$ids[] = $sort['sort_id'];
				}
			} else {
				$list[$sort['sort_id']] = $sort;
				$ids[] = $sort['sort_id'];
			}
		}
		
		$nowDay = date('Ymd');
		$MOOBJ = D('Meal_order');
		$meal_image_class = new meal_image();
		$temp = M("Meal")->where(array('store_id' => $this->store_id, 'sort_id' => array('in', $ids), 'status' => 1))->order('sort DESC')->select();
		foreach ($temp as $m) {
			if (isset($disharr[$m['meal_id']])) {
				$m['num'] = $disharr[$m['meal_id']]['num'];
			} else {
				$m['num'] = 0;
			}
			if (in_array($m['meal_id'], $meal_ids)) {
				$m['like'] = 1;
			} else {
				$m['like'] = 0;
			}
			
			
			if ($m['sell_mouth'] != $nowDay) {
				$m['sell_count'] = 0;
			}
			
			/***库存的处理***/
			$m['max'] = -1;
			$check_stock = $MOOBJ->check_stock($m['meal_id']);
			$m['max'] = $check_stock['stock_num'];
			
			$m['image'] = $meal_image_class->get_image_by_path($m['image'], $this->config['site_url'], 's');
			if (isset($t_meals[$m['sort_id']]['list'])) {
				$t_meals[$m['sort_id']]['list'][] = $m;
			} else {
				$t_meals[$m['sort_id']]['list'] = array($m);
				$t_meals[$m['sort_id']]['sort_id'] = $m['sort_id'];
			}
		}
		
		foreach ($ids as $sort_id){
			if (isset($t_meals[$sort_id])) {
				$meals[$sort_id] = $t_meals[$sort_id];
			} else {
				unset($list[$sort_id]);
			}
		}
		
		/* 粉丝行为分析 */
		$this->behavior(array('mer_id' => $this->mer_id, 'biz_id' => $this->store_id,'keyword'=>strval($_GET['keywords'])));
        $where=array('s.mer_id'=>$this->mer_id,'s.store_id'=>$this->store_id);
        $store_info=D('merchant_store')->alias('s')
            ->join('left join __AREA__ a on s.area_id=a.area_id')
            ->join('left join __MERCHANT__ b on s.mer_id=b.mer_id')
            ->field('s.mer_id,s.store_id,b.name,a.area_ip_desc,s.txt_info,s.adress,s.pic_info,s.phone')
            ->where($where)
            ->find();
        $store_info['pic_info']=str_replace(',','/',$store_info['pic_info']);
        $this->assign('store_info',$store_info);
		
		$this->assign('meals', $meals);
		$this->assign("sortlist", $list);
		//根据不同的商铺类型区分进那个展示列表
		$choose_array = M('merchant_store')->where(array('store_id'=>$_GET['store_id'],'mer_id'=>$_GET['mer_id']))->find();
		if($choose_array['store_type'] == 3){
//		    dump($meals);
//		    dump($list);
	//	    dump($store_info);exit;
			$this->display('tj');
		}else{
			$this->display();
		}

	}


    public function menu_check(){
        empty($this->_store) && $this->error("不存在的商家店铺!");
        $orid = isset($_GET['orid']) ? intval($_GET['orid']) : 0;

        $tableid = isset($_GET['tableid']) ? intval($_GET['tableid']) : 0;
        if ($now_table = D('Merchant_store_table')->field(true)->where(array('pigcms_id' => $tableid, 'store_id' => $this->_store['store_id']))->find()) {
            $_SESSION[$this->session_table_index] = $tableid;
        }

        //客户的购物车记录
        $disharr = unserialize($_SESSION[$this->session_index]);

        if ($order = $this->check_order($orid)) {
            if ($order['paid'] != 1) {
                $info = unserialize($order['info']);
                foreach ($info as $om) {
                    if (isset($disharr[$om['id']])) {
                        $disharr[$om['id']]['num'] += $om['num'];
                    } else {
                        $disharr[$om['id']]['num'] = $om['num'];
                    }
                }
            }
            $this->assign('orid', $orid);
        } else {
            $this->assign('orid', 0);
        }

        /**************客户收藏的菜品*****************/
        $like = D('Meal_like')->field('meal_ids')->where(array('uid' => $this->user_session['uid'], 'store_id' => $this->store_id, 'mer_id' => $this->mer_id))->find();
        $meal_ids = array();
        $like && $meal_ids = unserialize($like['meal_ids']);
        /**************客户收藏的菜品*****************/

        //菜品分类
        $sorts = M("Meal_sort")->where(array('store_id' => $this->store_id))->order('sort DESC, sort_id DESC')->select();
        $t_meals = $meals = $list = array();
        $ids = array();
        foreach ($sorts as $sort) {
            if ($sort['is_weekshow']) {
                $week = explode(",", $sort['week']);
                if (in_array(date("w"), $week)) {
                    $list[$sort['sort_id']] = $sort;
                    $ids[] = $sort['sort_id'];
                }
            } else {
                $list[$sort['sort_id']] = $sort;
                $ids[] = $sort['sort_id'];
            }
        }

        $nowDay = date('Ymd');
        $MOOBJ = D('Meal_order');
        $meal_image_class = new meal_image();
        $temp = M("Meal")->where(array('store_id' => $this->store_id, 'sort_id' => array('in', $ids), 'status' => 1))->order('sort DESC')->select();
        foreach ($temp as $m) {
            if (isset($disharr[$m['meal_id']])) {
                $m['num'] = $disharr[$m['meal_id']]['num'];
            } else {
                $m['num'] = 0;
            }
            if (in_array($m['meal_id'], $meal_ids)) {
                $m['like'] = 1;
            } else {
                $m['like'] = 0;
            }


            if ($m['sell_mouth'] != $nowDay) {
                $m['sell_count'] = 0;
            }

            /***库存的处理***/
            $m['max'] = -1;
            $check_stock = $MOOBJ->check_stock($m['meal_id']);
            $m['max'] = $check_stock['stock_num'];

            $m['image'] = $meal_image_class->get_image_by_path($m['image'], $this->config['site_url'], 's');
            if (isset($t_meals[$m['sort_id']]['list'])) {
                $t_meals[$m['sort_id']]['list'][] = $m;
            } else {
                $t_meals[$m['sort_id']]['list'] = array($m);
                $t_meals[$m['sort_id']]['sort_id'] = $m['sort_id'];
            }
        }

        foreach ($ids as $sort_id){
            if (isset($t_meals[$sort_id])) {
                $meals[$sort_id] = $t_meals[$sort_id];
            } else {
                unset($list[$sort_id]);
            }
        }

        /* 粉丝行为分析 */
        $this->behavior(array('mer_id' => $this->mer_id, 'biz_id' => $this->store_id,'keyword'=>strval($_GET['keywords'])));
        $where=array('s.mer_id'=>$this->mer_id,'s.store_id'=>$this->store_id);
        $store_info=D('merchant_store')->alias('s')
            ->join('left join __AREA__ a on s.area_id=a.area_id')
            ->join('left join __MERCHANT__ b on s.mer_id=b.mer_id')
            ->field('s.mer_id,s.store_id,b.name,a.area_ip_desc,s.txt_info,s.adress,s.pic_info,s.phone')
            ->where($where)
            ->find();
        $store_info['pic_info']=str_replace(',','/',$store_info['pic_info']);
        $this->assign('store_info',$store_info);

        $this->assign('meals', $meals);
        $this->assign("sortlist", $list);
        //根据不同的商铺类型区分进那个展示列表
        $choose_array = M('merchant_store')->where(array('store_id'=>$_GET['store_id'],'mer_id'=>$_GET['mer_id']))->find();
        if($choose_array['store_type'] == 3){
//		    dump($meals);
//		    dump($list);
//		    dump($store_info);
            $this->display('tj');
        }else{
            $this->display();
        }

    }
	
	/**
	 * 保存到购物车
	 */
	public function processOrder(){
		empty($this->_store) && $this->error("不存在的商家店铺!");
		
		$foods = $_POST['cart'];
		$disharr = array();
		$sure_dish = unserialize($_SESSION[$this->session_index]);
		$MOOBJ = D('Meal_order');
		foreach ($foods as $kk => $vv) {
			$count = $vv['count'] ? intval($vv['count']) : 0;
			if ($count > 0) {
				$check_stock = $MOOBJ->check_stock($vv['id']);
				if ($check_stock['stock_num'] > -1 && $check_stock['stock_num'] < $count) {
					exit(json_encode(array('error' => 1, 'msg' => '您购买的' . $check_stock['name'] . '超出了库存量！')));
				}
				$disharr[$vv['id']] = array('id' => $vv['id'], 'num' => $count, 'omark' => '');
				if (isset($sure_dish[$vv['id']]['omark']) && $sure_dish[$vv['id']]['omark']) {
					$disharr[$vv['id']]['omark'] = $sure_dish[$vv['id']]['omark'];
				}
			}
		}
		empty($disharr) && exit(json_encode(array('error' => 1, 'msg' => '您尚未点菜！')));
		$_SESSION[$this->session_index] = serialize($disharr);
		exit(json_encode(array('error' => 0, 'msg' => 'ok')));
	}
	
	private function check_order($order_id){
		if ($order = D('Meal_order')->where(array('uid' => $this->user_session['uid'], 'store_id' => $this->store_id, 'order_id' => $order_id))->find()) {
			return $order;
		} else {
			return false;
		}
	}
	/**
	 * 确认购物车 
	 */
	public function cart(){
		$this->isLogin();
		$isclean = $this->_get('isclean', 'trim');
		$orid = $this->_get('orid', 'intval');
		if ($this->check_order($orid)) {
			$this->assign('action_url', U('Food/saveorder', array('mer_id' => $this->mer_id, 'store_id' => $this->store_id, 'orid' => $orid)));
			$this->assign('orid', $orid);
		} else {
			$this->assign('action_url', U('Food/sureorder', array('mer_id' => $this->mer_id, 'store_id' => $this->store_id)));
			$this->assign('orid', 0);
		}
		$level_off=false;
		if(!empty($this->user_level) && !empty($this->leveloff) && !empty($this->user_session) && isset($this->user_session['level'])){
		     /****type:0无优惠 1百分比 2立减*******/
			if(isset($this->leveloff[$this->user_session['level']]) && isset($this->user_level[$this->user_session['level']])){
				$level_off=$this->leveloff[$this->user_session['level']];
				if($level_off['type']==1){
				  $level_off['offstr']='按此次总价'.$level_off['vv'].'%来结算';
				}elseif($level_off['type']==2){
				  $level_off['offstr']='此次总价立减'.$level_off['vv'].'元';
				}
			}
		}
		$this->assign('level_off', $level_off);		
		if ($isclean == 1) {
			$_SESSION[$this->session_index] = '';
			$disharr = '';
		} else {
			$disharr = unserialize($_SESSION[$this->session_index]);
		}
		if (!empty($disharr)) {
			$idarr = array_keys($disharr);
			$meal_image_class = new meal_image();
			$dish = M("Meal")->where(array('store_id' => $this->store_id, 'meal_id' => array('in', $idarr), 'status' => 1))->select();
			$MOOBJ = new Meal_orderModel();
			foreach ($dish as $val) {
				$val['image'] = $meal_image_class->get_image_by_path($val['image'],$this->config['site_url'],'s');
				
				//库存的处理
				$check_stock = $MOOBJ->check_stock($val['meal_id']);
				$val['max'] = $check_stock['stock_num'];
				
				$disharr[$val['meal_id']] = array_merge($disharr[$val['meal_id']], $val);
			}
		}
		$allmark = $_SESSION["allmark" . $this->store_id . $this->mer_id];
		$this->assign('allmark', $allmark);
		$this->assign('ordishs', $disharr);
		$this->display();
	}
	
	
	/**
	 * 填写客户的个人信息
	 */
	public function sureorder(){
	    $uid=$this->user_session['uid'];
	    $phone=$this->user_session['phone'];
	    $name=M('user')->where(array('uid'=>$uid))->getField('truename');
	    $name=$name?$name:'';
	    $address=M('user')->where(array('uid'=>$this->user_session['uid']))->getField('youaddress');
	    $this->assign('address',$address);
	    $this->assign('phone',$phone);
        $this->assign('name',$name);
	    $store_id=$_GET['store_id'];
	    $this->assign('store_id',$store_id);
		//dump($_SESSION);exit;
		$this->isLogin();
		$is_reserve = isset($_GET['is_reserve']) ? intval($_GET['is_reserve']) : 0 ;
		$this->assign('is_reserve', $is_reserve);
		
		$tableid = $_SESSION[$this->session_table_index];
		$this->assign('tableid', $tableid);

        $disharr = $_POST['dish'];
        $allmark = htmlspecialchars(trim($_POST['allmark']), ENT_QUOTES);
        $_SESSION["allmark" . $this->store_id . $this->mer_id] = $allmark;
        $orid = $this->_get('orid') ? intval($this->_get('orid', "trim")) : 0;
        if ($this->_store) {
            $tmparr = array();
            $MOOBJ = D('Meal_order');
            foreach ($disharr as $dk => $dv) {
                if (!empty($dv)) {
                    $tmpnum = intval($dv['num']);
                    if ($tmpnum > 0) {
                    	
                    	$check_stock = $MOOBJ->check_stock($dk);
                    	if ($check_stock['stock_num'] > -1 && $check_stock['stock_num'] < $tmpnum) {
                    		$this->error('您购买的' . $check_stock['name'] . '超出了库存量！');
                    	}
                    	
                        $tmparr[$dk] = array();
                        $tmparr[$dk]['id'] = $dk;
                        $tmparr[$dk]['num'] = $tmpnum;
                        $tmparr[$dk]['omark'] = htmlspecialchars(trim($dv['omark']), ENT_QUOTES);
                    }
                }
            }
            if ($tmparr) {
                $_SESSION[$this->session_index] = serialize($tmparr);
            }
			$totalmoney = trim($_POST['totalmoney']);
			$totalnum = trim($_POST['totalnum']);
			$level_off=false;
			$finaltotalprice=0;
			if(!empty($this->user_level) && !empty($this->leveloff) && !empty($this->user_session) && isset($this->user_session['level'])){
			     /****type:0无优惠 1百分比 2立减*******/
				if(isset($this->leveloff[$this->user_session['level']]) && isset($this->user_level[$this->user_session['level']])){
					$level_off=$this->leveloff[$this->user_session['level']];
					if($level_off['type']==1){
					  $finaltotalprice=$totalmoney *($level_off['vv']/100);
					  $finaltotalprice=$finaltotalprice>0 ? $finaltotalprice : 0;
					  $level_off['offstr']='按此次总价'.$level_off['vv'].'%来结算';
					}elseif($level_off['type']==2){
					  $finaltotalprice=$totalmoney-$level_off['vv'];
					  $finaltotalprice=$finaltotalprice>0 ? $finaltotalprice : 0;
					  $level_off['offstr']='此次总价立减'.$level_off['vv'].'元';
					}
				}
			}
			$this->assign('totalmoney', $totalmoney);
			$this->assign('totalnum', $totalnum);
			$this->assign('finaltotalprice', round($finaltotalprice,2));
			$this->assign('level_off', $level_off);
			/*****************************************/
			$arrive_time = time();
			$star_time = $arrive_time - 7200;
			$end_time = $arrive_time + 7200;
			$tables = D('Merchant_store_table')->field(true)->where(array('store_id' => $this->store_id))->select();
			$orders = D('Meal_order')->field('tableid')->where("`store_id`={$this->store_id} AND `paid`=1 AND `is_confirm`=1 AND `status`=0 AND `arrive_time`>'{$star_time}' AND `arrive_time`<'{$end_time}' AND tableid>0")->select();
			$tids = array();
			foreach ($orders as $row) {
				$tids[$row['tableid']] = $row;
			}
			$table_list = array();
			foreach ($tables as $table) {
				if (!isset($tids[$table['pigcms_id']])) {
					$table_list[] = $table;
				}
			}
			$this->assign('tables', $table_list);
			/*****************************************/
			if (empty($tables)) {
				$this->assign('seattype', 0);
			} else {
				$this->assign('seattype', $tables[0]['pigcms_id']);
			}
            $user_info = D('User_adress')->get_one_adress($this->user_session['uid'], intval($_GET['adress_id']));
			$store_info=M('merchant_store')->where('store_id='.$this->store_id)->find();
			$merchant_info=M('merchant')->where('mer_id='.$store_info['mer_id'])->find();
			$this->assign('merchant_info',$merchant_info);
            $this->assign('date', date('Y-m-d'));
            $this->assign('time', date('H:i', time() + 1200));
            $this->assign('user_info', $user_info);
            $this->display();
        } else {
            $jumpurl = U('Food/index', array('mer_id' => $this->mer_id, 'store_id' => $this->store_id));
            $this->error('订单信息中店面信息出错', $jumpurl);
        }
	}
	
	/**
	 * 保存订单
	 */
	public function saveorder(){
		if(empty($this->user_session)){
			exit(json_encode(array('status' => 1, 'message' => '请先进行登录！', 'url' => U('Login/index'))));
		}
		$orid = isset($_REQUEST['orid']) ? intval($_REQUEST['orid']) : 0;
		$isdeposit = isset($_POST['isdeposit']) ? intval($_POST['isdeposit']) : 0;/***isdeposit 1 支付预定经***/
		$is_reserve = isset($_POST['is_reserve']) ? intval($_POST['is_reserve']) : 0;/***is_reserve 1 预约***/
		
		$total = $price = $tmpprice=0;
		//print_r($_POST); exit;
		$disharr_session=array();
		if(I('post.dish')){		//判断是否是在线购买
			foreach($_POST['dish'] as $key=>$val){
				$disharr_session[$key]['id']=$key;
				$disharr_session[$key]['num']=$val['num'];
				$disharr_session[$key]['omark']=$val['omark'];
			}
			$_SESSION[$this->session_index] = '';
			$_SESSION[$this->session_index]=serialize($disharr_session);
			$disharr = unserialize($_SESSION[$this->session_index]);
		}else{
			$disharr = unserialize($_SESSION[$this->session_index]);
		}		
		//print_r($disharr);exit;
		$idarr = array_keys($disharr);
		$store_meal = D('Merchant_store_meal')->where(array('store_id' => $this->store_id))->find();
		$MOOBJ = new Meal_orderModel();
		if ($old_order = $this->check_order($orid)) {//加菜
			$info = $old_order['info'] ? unserialize($old_order['info']) : array();
			$isadd = empty($info) ? 0 : 1;
			$oldmenus = array();
			if ($old_order['paid'] != 1) {
				foreach ($info as $om) {
					$oldmenus[$om['id']] = $om['num'];
				}
			}
			if ($idarr) {
				$dish = M("Meal")->where(array('store_id' => $this->store_id, 'meal_id' => array('in', $idarr), 'status' => 1))->select();
				foreach ($dish as $val) {
					$num = isset($disharr[$val['meal_id']]['num']) ? intval($disharr[$val['meal_id']]['num']) : 0;
					$omark = isset($disharr[$val['meal_id']]['omark']) ? htmlspecialchars($disharr[$val['meal_id']]['omark']) : '';
					$check_num = 0;
					if (isset($oldmenus[$val['meal_id']])) {
						for ($i = 0; $i < count($info); $i++) {
							if ($info[$i]['id'] == $val['meal_id']) {
								$isadd = $info[$i]['num'] == $num ? 0 : 1;
								$info[$i] = array('id' => $val['meal_id'], 'name' => $val['name'], 'price' => $val['price'], 'num' => $num, 'omark' => $omark, 'isadd' => $isadd, 'iscount' => 0);
								$check_num = $num - $info[$i]['num'];
							}
						}
					} else {
						$info[] = array('id' => $val['meal_id'], 'name' => $val['name'], 'price' => $val['price'], 'num' => $num, 'omark' => $omark, 'isadd' => 1, 'iscount' => 0);
						$check_num = $num;
					}
					
					$check_stock = $MOOBJ->check_stock($val['meal_id']);
					if ($check_stock['stock_num'] > -1 && $check_stock['stock_num'] < $check_num) {
						$this->error('您购买的' . $check_stock['name'] . '超出了库存量！');
					}
					
					$total += $num;
					$tmpprice += $val['price'] * $num;
				}

				//会员等级优惠
				$level_off = false;
				$finaltotalprice = 0;
				if(!empty($this->user_level) && !empty($this->leveloff) && !empty($this->user_session) && isset($this->user_session['level'])){
					 /****type:0无优惠 1百分比 2立减*******/
					if(isset($this->leveloff[$this->user_session['level']]) && isset($this->user_level[$this->user_session['level']])){
						$level_off = $this->leveloff[$this->user_session['level']];
						if($level_off['type'] == 1){
						  $finaltotalprice = $tmpprice *($level_off['vv'] / 100);
						  $finaltotalprice = $finaltotalprice > 0 ? $finaltotalprice : 0;
						  $level_off['offstr'] = '按此次总价' . $level_off['vv'] . '%来结算';
						} elseif($level_off['type'] == 2) {
						  $finaltotalprice = $tmpprice - $level_off['vv'];
						  $finaltotalprice = $finaltotalprice > 0 ? $finaltotalprice : 0;
						  $level_off['offstr'] = '此次总价立减' . $level_off['vv'] . '元';
						}
					}
				}

				if (!empty($old_order['leveloff'])) {
					$leveloff = unserialize($old_order['leveloff']);
					if ($old_order['paid'] == 1) {
						$price = $finaltotalprice > 0 ? $leveloff['totalprice']+$finaltotalprice : $leveloff['totalprice']+$tmpprice;
					} else {
						$price = $finaltotalprice > 0 ? $finaltotalprice : $tmpprice;
					}
					$price = round($price, 2);
					is_array($level_off) && $level_off['totalprice']=$price;
				}else{
					foreach ($info as $v) {
						$price += $v['price'] * $v['num'];
					}
					$price = max($price, $old_order['price']);
				}
				
				$total_price = $price;
				$minus_price = 0;
				if ($store_meal && !empty($store_meal['minus_money']) && $price > $store_meal['full_money']) {
					$price = $price - $store_meal['minus_money'];
					$minus_price = $store_meal['minus_money'];
				}
				
				$data = array('price' => $price, 'dateline' => time());
				if ($old_order['paid'] == 1) {
					$data['total'] = $total + $old_order['total'];
				} else {
					$data['total'] = $total;
				}
				$data['orderid'] = date("YmdHis") . sprintf("%08d", $this->user_session['uid']);
				$data['info'] = $info ? serialize($info) : '';
				
				$data['total_price'] = $total_price;
				$data['minus_price'] = $minus_price;
				
				$data['paid'] = $old_order['paid'] == 1 ? 2 : 0;
				
				!empty($level_off) && $data['leveloff']=serialize($level_off);
				if ($return = D("Meal_order")->where(array('order_id' => $orid, 'uid' => $this->user_session['uid']))->save($data)) {
					$_SESSION[$this->session_index]  = null;
					$_SESSION["allmark" . $this->store_id . $this->mer_id] = null;
					redirect(U('Pay/check', array('order_id' => $orid, 'type'=>'food')));
				} else {
					exit(json_encode(array('status' => 1, 'message' => '服务器繁忙，稍后重试！')));
					$this->error('服务器繁忙，稍后重试');
				}
			} else {
				$jumpurl = U('Food/menu', array('mer_id' => $this->mer_id, 'store_id' => $this->store_id, 'orid' => $orid));
				//exit(json_encode(array('status' => 1, 'message' => '还没有加菜呢', 'url' => $jumpurl)));
				$this->error('还没有加菜呢', $jumpurl);
			}
		} else {//点菜的新单信息
			$phone = isset($_POST['tel']) ? htmlspecialchars($_POST['tel']) : '';
			$name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
			$address = isset($_POST['address']) ? htmlspecialchars($_POST['address']) : '';
			$note = isset($_POST['mark']) ? htmlspecialchars($_POST['mark']) : '';
			$date = isset($_POST['date']) ? htmlspecialchars($_POST['date']) : '';
			$time = isset($_POST['time']) ? htmlspecialchars($_POST['time']) : '';
			$sex = isset($_POST['sex']) ? intval($_POST['sex']) : 1;
			$people_num = isset($_POST['num']) ? intval($_POST['num']) : 2;
			$tableid = isset($_POST['seattype']) ? intval($_POST['seattype']) : 0;
			//if (empty($date)) exit(json_encode(array('status' => 1, 'message' => '使用日期不能为空')));
			//if (empty($time)) exit(json_encode(array('status' => 1, 'message' => '使用时间不能为空')));
			//if (empty($name)) exit(json_encode(array('status' => 1, 'message' => '您的姓名不能为空')));
			//if (empty($phone)) exit(json_encode(array('status' => 1, 'message' => '您的电话不能为空')));
			$arrive_time = strtotime($date . ' ' . $time . ":00");
			/*if ($is_reserve) {
				if (empty($tableid))$this->error('请您选择要预定的餐桌');
				$star_time = $arrive_time - 7200;
				$end_time = $arrive_time + 7200;
				$count = D('Meal_order')->where("`tableid`={$tableid} AND `store_id`={$store_id} AND `paid`=1 AND `status`=0 AND `is_confirm`=1 AND `arrive_time`>'{$star_time}' AND `arrive_time`<'{$end_time}'")->count();
				if ($count > 0) $this->error('您选择预定的餐桌已被预定，请重新选择');
			}*/
			$info = array();
			if ($idarr) {//点餐
				$dish = M("Meal")->where(array('store_id' => $this->store_id, 'meal_id' => array('in', $idarr), 'status' => 1))->select();
				foreach ($dish as $val) {
					$num = isset($disharr[$val['meal_id']]['num']) ? intval($disharr[$val['meal_id']]['num']) : 0;
					
					$check_stock = $MOOBJ->check_stock($val['meal_id']);
					if ($check_stock['stock_num'] > -1 && $check_stock['stock_num'] < $num) {
						$this->error('您购买的' . $check_stock['name'] . '超出了库存量！');
					}
					
					$omark = isset($disharr[$val['meal_id']]['omark']) ? htmlspecialchars($disharr[$val['meal_id']]['omark']) : '';
					$info[] = array('id' => $val['meal_id'], 'name' => $val['name'], 'price' => $val['price'], 'num' => $num, 'omark' => $omark, 'isadd' => 0, 'iscount' => 0);
					$total += $num;
					$price += $val['price'] * $num;
				}
				//会员等级优惠
				$level_off = false;
				$finaltotalprice = 0;
				if (!empty($this->user_level) && !empty($this->leveloff) && !empty($this->user_session) && isset($this->user_session['level'])) {
					 /****type:0无优惠 1百分比 2立减*******/
					if (isset($this->leveloff[$this->user_session['level']]) && isset($this->user_level[$this->user_session['level']])) {
						$level_off = $this->leveloff[$this->user_session['level']];
						if ($level_off['type'] == 1) {
						  $finaltotalprice = $price * ($level_off['vv'] / 100);
						  $finaltotalprice = $finaltotalprice>0 ? $finaltotalprice : 0;
						  $level_off['offstr'] = '按此次总价' . $level_off['vv'] . '%来结算';
						} elseif ($level_off['type'] == 2) {
						  $finaltotalprice = $price - $level_off['vv'];
						  $finaltotalprice = $finaltotalprice > 0 ? $finaltotalprice : 0;
						  $level_off['offstr'] = '此次总价立减' . $level_off['vv'] . '元';
						}
					}
				}
			  $price = $finaltotalprice > 0 ? round($finaltotalprice,2) : $price;
			  $level_off && is_array($level_off) && $level_off['totalprice']=$price;
			} else {
				//预定
				if ($is_reserve!=0) {
					$jumpurl = U('Food/menu', array('mer_id' => $this->mer_id, 'store_id' => $this->store_id));
					exit(json_encode(array('status' => 1, 'message' => '您还没有买或订单已生成', 'url' => $jumpurl)));
					$this->error('您还没有买或订单已生成', $jumpurl);
				}
				//dump($this->_store);
				$price = $this->_store['deposit'];
			}
			$total_price = $price;
			$minus_price = 0;
			if ($store_meal && !empty($store_meal['minus_money']) && $price > $store_meal['full_money']) {
				$price = $price - $store_meal['minus_money'];
				$minus_price = $store_meal['minus_money'];
			}			
			$price = $isdeposit ? $this->_store['deposit'] : $price;
			if(isset($level_off) && $isdeposit && (isset($level_off['totalprice']) && $level_off['totalprice'] < $price)){
			    $level_off['totalprice'] = $price;
			}
			$data = array('mer_id' => $this->mer_id, 'tableid' => $tableid, 'store_id' => $this->store_id, 'name' => $name, 'phone' => $phone, 'address' => $address, 'note' => $note, 'dateline' => time(), 'total' => $total, 'price' => $price, 'arrive_time' => $arrive_time);
			$data['orderid'] = date("YmdHis") . sprintf("%08d", $this->user_session['uid']);
			$data['uid'] = $this->user_session['uid'];
			$data['sex'] = $sex;
			$data['num'] = $people_num;
			$data['info'] = $info ? serialize($info) : '';
			
			$data['is_confirm'] = $is_reserve;//预定餐台的默认是店员已确认
			$data['total_price'] = $total_price;
			$data['minus_price'] = $minus_price;
			isset($level_off) && !empty($level_off) && $data['leveloff']=serialize($level_off);
			$orderid = D("Meal_order")->add($data);
			if ($orderid) {
				$_SESSION[$this->session_index] = null;
				$_SESSION["allmark" . $this->store_id . $this->mer_id] = null;
				if ($this->user_session['openid']) {
					$keyword2 = '';
					$pre = '';
					foreach (unserialize($data['info']) as $menu) {
						$keyword2 .= $pre . $menu['name'] . ':' . $menu['price'] . '*' . $menu['num'];
						$pre = '\n\t\t\t';
					}

					/*$model = new templateNews(C('config.wechat_appid'), C('config.wechat_appsecret'));
					$model->sendTempMsg('OPENTM201682460', array('href' => $href, 'wecha_id' => $this->user_session['openid'], 'first' => '您好，您的订单已生成', 'keyword3' => $orderid, 'keyword1' => date('Y-m-d H:i:s'), 'keyword2' => $keyword2, 'remark' => '您的该次'.$this->config['meal_alias_name'].'下单成功，感谢您的使用！'));*/
				}
				$msg = ArrayToStr::array_to_str($orderid);
				$op = new orderPrint($this->config['print_server_key'], $this->config['print_server_topdomain']);
				$op->printit($this->mer_id, $this->store_id, $msg, 0);
	
				$str_format = ArrayToStr::print_format($orderid);
				foreach ($str_format as $print_id => $print_msg) {
					$print_id && $op->printit($this->mer_id, $this->store_id, $print_msg, 0, $print_id);
				}
				
				$sms_data = array('mer_id' => $this->mer_id, 'store_id' => $this->store_id, 'type' => 'food');
				/*if ($this->config['sms_place_order'] == 1 || $this->config['sms_place_order'] == 3) {
					$sms_data['uid'] = $this->user_session['uid'];
					$sms_data['mobile'] = $data['phone'] ? $data['phone'] : $this->user_session['phone'];
					$sms_data['sendto'] = 'user';
					$sms_data['content'] = '您在' . $this->_store['name'] . '中预定的用餐的订单生产成功，订单号：' . $orderid;
					Sms::sendSms($sms_data);
				}
				if ($this->config['sms_place_order'] == 2 || $this->config['sms_place_order'] == 3) {
					$sms_data['uid'] = 0;
					$sms_data['mobile'] = $this->_store['phone'];
					$sms_data['sendto'] = 'merchant';
					$sms_data['content'] = '顾客' . $data['name'] . '刚刚下了一个订单，订单号：' . $orderid . '请您注意查看并处理';
					Sms::sendSms($sms_data);
				}*/
				/* 粉丝行为分析 */
				$this->behavior(array('mer_id' => $this->mer_id, 'biz_id' => $orderid));
				if ($data['total_price'] - $data['minus_price'] <= 0) {
					//D("Meal_order")->where(array('order_id' => $orderid))->save(array('paid' => 1));
					D("user_adress")->where(array('uid'=>$this->user_session['uid']))->save(array('phone' =>$phone,'adress' =>$address,'name' =>$name));	//修改预约用户地址信息
					//exit(json_encode(array('status' => 0, 'url' => U('Food/order_detail', array('order_id' => $orderid, 'mer_id'=> $this->mer_id, 'store_id' => $this->store_id)))));
                    exit(json_encode(array('status' => 0, 'url' => U('Pay/check', array('order_id' => $orderid, 'type'=>'food', 'isdeposit' => $is_reserve)))));
				}
                D('user')->where(array('uid'=>$this->user_session['uid']))->save(array('youaddress'=>$address,'truename'=>$name,'phone'=>$phone));

				exit(json_encode(array('status' => 0, 'url' => U('Pay/check', array('order_id' => $orderid, 'type'=>'food', 'isdeposit' => $is_reserve)))));
			} else {
				exit(json_encode(array('status' => 1, 'message' => '服务器繁忙，稍后重试')));
			}
		}
	}
	
	/**
	 * 订单列表
	 */
	public function order_list(){
		$this->isLogin();
		$meal_type = isset($_GET['meal_type']) ? intval($_GET['meal_type']) : 0;
		$this->assign('meal_type', $meal_type);
        $sql = "SELECT `s`.`name` as s_name, `o`.* FROM " . C('DB_PREFIX') . 'merchant_store AS s INNER JOIN ' . C('DB_PREFIX') . "meal_order as o ON s.store_id=o.store_id WHERE o.store_id={$this->store_id} AND o.mer_id={$this->mer_id} AND o.uid={$this->user_session['uid']}  AND o.meal_type={$meal_type} AND o.status<3 ORDER BY o.order_id DESC LIMIT 0, 30";
        $mode = new Model();
        $meal_list = $mode->query($sql);
        $list = array();
        $weekarr = array('0' => '周日', '1' => '周一', '2' => '周二', '3' => '周三', '4' => '周四', '5' => '周五', '6' => '周六');
        $nowtime = time();
        foreach ($meal_list as $tmp) {
        	//if ($tmp['pay_type'] == 'offline' && empty($tmp['thrid_id'])) $tmp['paid'] = 0;
        	$tmp['topay'] = false;
        	if ($tmp['status'] == 4) {
				$tmp['css'] = ' faild hasicon';
				$tmp['show_status'] = '<label>×</label>已取消';
			} elseif ($tmp['status'] == 3) {
				$tmp['css'] = ' faild hasicon';
				$tmp['show_status'] = '<label>×</label>已退款';
			} elseif ($tmp['paid'] == 1) {
        		if ($tmp['status']) {
        			$tmp['css'] = ' faild hasicon';
        			$tmp['show_status'] = '<label>√</label>已完成';
        		} else {
        			$tmp['css'] = ' processing';
        			$tmp['show_status'] = '已付款';
        		}
        	} elseif ($tmp['paid'] == 2) {
				$tmp['topay'] = true;
				$tmp['css'] = 'processing';
				$tmp['show_status'] = '处理中';
			} else {//预定时间加3个小时 if (intval($tmp['arrive_time']) + 10800 > time())
				$tmp['topay'] = true;
				$tmp['css'] = 'processing';
				$tmp['show_status'] = '处理中';
			}
        	
            $tmp['otimestr'] = date('Y-m-d', $tmp['dateline']) . " " . $weekarr[date('w', $tmp['dateline'])] . " " . date('H:i', $tmp['dateline']);
            $list[] = $tmp;
        }
        $this->assign('orderList', $list);
        $this->display();
	}
	
	/**
	 * 订单详情
	 */
	public function order_detail(){
		$this->isLogin();
		//print_r($_GET);exit;
		//$orderid = intval($_GET['order_id']);
		$orderid = $_GET['order_id'];
// 		$otherrm = isset($_GET['otherrm']) ? intval($_GET['otherrm']) : 0;	
		//$order = M("Meal_order")->where(array('order_id' => $orderid, 'uid' => $this->user_session['uid'], 'store_id' => $this->store_id))->find();
		//echo $orderid.'---'.$this->user_session['uid'].'---'.$this->store_id; exit;
		$order = M("Meal_order")->where(array('order_id|orderid' =>$orderid,'uid' =>$this->user_session['uid'],'store_id'=>$this->store_id))->find();
		if (empty($order)) {
			$this->error('错误的订单信息', U('Meal/index'));
		}
		$meallist = unserialize($order['info']);
		//线下付款推送 by zhukeqin
        if($order['pay_type']=='offline'&&$order['is_mobile_pay']=='1'&&$order['is_send']=='0'){
            $model=new FoodModel();
            $model->send_food_tpl($order['orderid']);
            M('Meal_order')->where(array('orderid'=>$order['orderid']))->data(array('is_send'=>1))->save();
        }
		//if ($order['pay_type'] == 'offline' && empty($order['third_id'])) $order['paid'] = 0;
		$order['topay'] = false;
		$order['jiaxcai'] = false;
		$order['cancel'] = 0;
		// if ($order['paid'] == 1 && !($order['pay_type'] == 'offline' && empty($order['third_id']))) {
		if ($order['status'] == 4) {
			$order['cancel'] = 2;//删除
			$order['css'] = ' faild hasicon';
			$order['show_status'] = '<label>×</label>已取消';
		} elseif ($order['status'] == 3) {
			$order['cancel'] = 1;//退款
			$order['css'] = ' faild hasicon';
			$order['show_status'] = '<label>×</label>已退款';
		} elseif ($order['paid'] == 1) {
			if ($order['status']) {
				$order['css'] = ' faild hasicon';
				$order['show_status'] = '<label>√</label>已完成';
			} else {
				$order['css'] = ' processing';
				$order['show_status'] = '已付款';
				$order['jiaxcai'] = true;
				$order['cancel'] = 1;//退款
			}
		} else {
// 			if (intval($order['arrive_time']) + 10800 > time()) {//预定时间加3个小时
				$order['topay'] = true;
				if ($order['paid'] == 2) {
					$order['cancel'] = 1;//退款
				} else {
					$order['cancel'] = 2;//删除
					$order['jiaxcai'] = true;
				}
				$order['css'] = 'processing';
				$order['show_status'] = '处理中';
// 			} else {
// 				if ($order['paid'] == 2) {
// 					//$order['cancel'] = 1;//退款
// 			 	} else {
// 					//$order['cancel'] = 2;//删除
// 				}
// 				$order['css'] = ' faild hasicon';
// 				$order['show_status'] = '<label>×</label>已过期';
// 			}
		}
// 		if ($order['paid'] == 1 && !($order['pay_type'] == 'offline' && empty($order['third_id']))) $order['jiaxcai'] = false;
		$order['paytypestr'] = D('Pay')->get_pay_name($order['pay_type']);
		if ($order['paid'] == 0) {
			$order['paytypestr'] = $order['paidstr'] = '未支付';
		} elseif ($order['paid'] == 1) {
			if ($order['pay_type'] == 'offline' && empty($order['third_id'])) {
				$order['paidstr'] = '还未付款';
			} else {
				$order['paidstr'] = '全额付款';
			}
		} else {
			$order['paidstr'] = '已付订金';
		}
		
		if ($order['status'] > 2) {
			$order['topay'] = false;
			$order['jiaxcai'] = false;
			$order['cancel'] = 0;
		}
		if (empty($order['tableid'])) {
			$order['tablename'] = '不限';
		} else {
			$table = D('Merchant_store_table')->where(array('pigcms_id' => $order['tableid'], 'store_id' => $this->store_id))->find();
			$order['tablename'] = isset($table['name']) ? $table['name'] : '不限';
		}
		if(!empty($order['leveloff'])) $order['leveloff']=unserialize($order['leveloff']);
		/* 粉丝行为分析 */
		
		$this->behavior(array('mer_id' => $this->mer_id, 'biz_id' => $this->store_id));
		$this->assign('meallist', $meallist);
		$this->assign('order', $order);
		$this->display();
	}
	
	/**
	 * 客户收藏
	 */
	public function dolike(){
		if(empty($this->user_session)) exit('no');
		$meal_id = isset($_POST['meal_id']) ? intval($_POST['meal_id']) : 0;
		$islove = isset($_POST['islove']) ? intval($_POST['islove']) : 0;
		$like = D('Meal_like')->where(array('uid' => $this->user_session['uid'], 'mer_id' => $this->mer_id, 'store_id' => $this->store_id))->find();
		if ($like) {
			$meal_ids = unserialize($like['meal_ids']);
			if ($islove) {
				in_array($meal_id, $meal_ids) || $meal_ids[$meal_id] = $meal_id;
			} else {
				unset($meal_ids[$meal_id]);
			}
			D('Meal_like')->where(array('uid' => $this->user_session['uid'], 'mer_id' => $this->mer_id, 'store_id' => $this->store_id))->save(array('meal_ids' => serialize($meal_ids)));
		} elseif ($islove) {
			$meal_ids = array();
			$meal_ids[$meal_id] = $meal_id;
			D('Meal_like')->add(array('uid' => $this->user_session['uid'], 'mer_id' => $this->mer_id, 'store_id' => $this->store_id, 'meal_ids' => serialize($meal_ids)));
		}
	}
	
	private function isLogin(){
		if(empty($this->user_session)){
			$this->error_tips('请先进行登录！',U('Login/index', array('referer' => urlencode("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']))));
		}
	}
	
	public function orderdel(){
		$this->isLogin();
		$id = isset($_GET['orderid']) ? intval($_GET['orderid']) : 0;
		if ($order = M('Meal_order')->where(array('order_id' => $id, 'uid' => $this->user_session['uid'], 'mer_id' => $this->mer_id, 'store_id' => $this->store_id))->find()) {
			
			if ($order['paid'] == 1 && date('m', $order['dateline']) == date('m')) {
				foreach (unserialize($order['info']) as $menu) {
					D('Meal')->where(array('meal_id' => $menu['id'], 'sell_count' => array('gt', $menu['num'])))->setDec('sell_count', $menu['num']);
				}
			}
			D("Merchant_store_meal")->where(array('store_id' => $order['store_id']))->setDec('sale_count', 1);
			/* 粉丝行为分析 */
			$this->behavior(array('mer_id' => $this->mer_id, 'biz_id' => $this->store_id));
			
			M('Meal_order')->where(array('order_id' => $id, 'uid' => $this->user_session['uid'], 'mer_id' => $this->mer_id, 'store_id' => $this->store_id))->save(array('status' => 4));
			$this->success('订单取消成功', U('My/order_list', array('mer_id' => $this->mer_id, 'store_id' => $this->store_id, 'type' => 0)));
		} else {
			$this->error('订单取消失败！');
		}
		
	}
		
	/**
	 * iPad点餐模板
	 */
	public function pad(){
		empty($this->_store) && $this->error("不存在的商家店铺!");
		if ($this->_store['store_type'] > 1) $this->error("您的店铺没有点餐的权限");
// 		$orid = isset($_GET['orid']) ? intval($_GET['orid']) : 0;

		//客户的购物车记录
// 		$disharr = unserialize($_SESSION[$this->session_index]);
		
		/**********已买的订单加菜处理
		if ($order = $this->check_order($orid)) {
			if ($order['paid'] != 1) {
				$info = unserialize($order['info']);
				foreach ($info as $om) {
					if (isset($disharr[$om['id']])) {
						$disharr[$om['id']]['num'] += $om['num'];
					} else {
						$disharr[$om['id']]['num'] = $om['num'];
					}
				}
			}
			$this->assign('orid', $orid);
		} else {
			$this->assign('orid', 0);
		}
		*********************************************/
		/**************客户收藏的菜品*****************/
// 		$like = D('Meal_like')->field('meal_ids')->where(array('uid' => $this->user_session['uid'], 'store_id' => $this->store_id, 'mer_id' => $this->mer_id))->find();
// 		$meal_ids = array();
// 		$like && $meal_ids = unserialize($like['meal_ids']);
		/**************客户收藏的菜品*****************/
		
		//菜品分类
		$sorts = M("Meal_sort")->where(array('store_id' => $this->store_id))->order('sort DESC, sort_id DESC')->select();
		
		$sort_list = array();
		$sortids = array();
		foreach ($sorts as $sort) {
			if ($sort['is_weekshow']) {
				$week = explode(",", $sort['week']);
				if (in_array(date("w"), $week)) {
					$sort_list[$sort['sort_id']] = $sort;
					$sortids[] = $sort['sort_id'];
				}
			} else {
				$sort_list[$sort['sort_id']] = $sort;
				$sortids[] = $sort['sort_id'];
			}
		}
		
		$nowMouth = date('Ym');
		$sort_meal_list = array();
		$meal_image_class = new meal_image();
		$meals = M("Meal")->where(array('store_id' => $this->store_id, 'sort_id' => array('in', $sortids), 'status' => 1))->order('sort DESC')->select();
		foreach ($meals as $meal) {
			if (isset($disharr[$m['meal_id']])) {
				$meal['num'] = $disharr[$meal['meal_id']]['num'];
			} else {
				$meal['num'] = 0;
			}
// 			if (in_array($m['meal_id'], $meal_ids)) {
// 				$m['like'] = 1;
// 			} else {
// 				$m['like'] = 0;
// 			}
// 			if ($meal['sell_mouth'] != $nowMouth) $meal['sell_count'] = 0;//跨月销售额清零
			$meal['image'] = $meal_image_class->get_image_by_path($meal['image'], $this->config['site_url'], 's');
			if (isset($sort_meal_list[$meal['sort_id']]['list'])) {
				$sort_meal_list[$meal['sort_id']]['list'][] = $meal;
			} else {
				$sort_meal_list[$meal['sort_id']]['list'] = array($meal);
				$sort_meal_list[$meal['sort_id']]['sort_id'] = $meal['sort_id'];
				$sort_meal_list[$meal['sort_id']]['sort_name'] = isset($sort_list[$meal['sort_id']]['sort_name']) ? $sort_list[$meal['sort_id']]['sort_name'] : '';
			}
		}
// 		echo "<pre/>";
// 		print_r($sort_meal_list);die;
		
		$temp_array = $sort_meal_list;
		$sort_meal_list = array();
		foreach ($sortids as $sort_id) {
			if (isset($temp_array[$sort_id])) {
				$sort_meal_list[$sort_id] = $temp_array[$sort_id];
			} else {
				unset($sort_list[$sort_id]);
			}
// 			isset($temp_array[$sort_id]) && $sort_meal_list[$sort_id] = $temp_array[$sort_id];
		}
		/* 粉丝行为分析 */
		$this->behavior(array('mer_id' => $this->mer_id, 'biz_id' => $this->store_id,'keyword'=>strval($_GET['keywords'])));
		
		$merchant = D('Merchant')->get_info($this->mer_id);
		$notOffline = 0;
		if ($merchant) {
			$notOffline = $merchant['is_close_offline'] == 0 && $merchant['is_offline'] == 1 ? 0 : 1;
		}
		$this->assign('notOffline', $notOffline);
		$tables = D('Merchant_store_table')->where(array('store_id' => $this->store_id))->select();
		$this->assign('tables', $tables);
		
		$this->assign('meals', $sort_meal_list);
		$this->assign("sortlist", $sort_list);
		$this->display();
	}
	
	public function save_pad_order(){
    	$tableid = isset($_POST['tableid']) ? intval($_POST['tableid']) : 0;
    	$pay_type = isset($_POST['pay_type']) ? intval($_POST['pay_type']) : 1;
    	$people_num = isset($_POST['num']) ? intval($_POST['num']) : 0;
    	$shop_cart = isset($_POST['shop_cart']) ? htmlspecialchars($_POST['shop_cart']) : '';

		if(empty($shop_cart)){
			exit(json_encode(array('error_code' => 1, 'msg' => '购物车没有商品，请重新下单')));
		}
    	$temp = explode(":", $shop_cart);
    	$store_id = $temp[0];
    	if ($store_id != $this->_store['store_id']) {
    		exit(json_encode(array('error_code' => 1, 'msg' => '店铺不存在')));
    	}
    	$menus = explode("|", $temp[1]);
    	$ids = $list = array();
    	$MOOBJ = D('Meal_order');
    	foreach ($menus as $m){
    		$t = explode(",", $m);
    		$ids[] = $t[0];
    		$list[$t[0]] = $t[1];
    		
    		$check_stock = $MOOBJ->check_stock($t[0]);
    		if ($check_stock['stock_num'] > -1 && $check_stock['stock_num'] < $t[1]) {
    			exit(json_encode(array('error_code' => 1, 'msg' => '您购买的' . $check_stock['name'] . '超出了库存量！')));
    			break;
    		}
    	}
    	
    	$ids && $meals = D("Meal")->field(true)->where(array('store_id' => $store_id, 'meal_id' => array('in', $ids)))->select();
		if(empty($meals)){
			exit(json_encode(array('error_code' => 1, 'msg' => '购物车没有商品，请重新下单')));
		}
		
		$total = 0;
		$price = 0;
    	foreach ($meals as $meal) {
    		$info[] = array('id' => $meal['meal_id'],'name' => $meal['name'], 'num' => $list[$meal['meal_id']], 'price' => $meal['price']);
			$total += $list[$meal['meal_id']];
			$price += $list[$meal['meal_id']] * $meal['price'];
    	}

         //用户等级 优惠
		$finaltotalprice = 0;
		$store_meal = D('Merchant_store_meal')->where(array('store_id' => $store_id))->find();
		if ($this->user_session) {
			$level_off = false;
			if (!empty($this->user_level) && !empty($store_meal) && !empty($store_meal['leveloff'])) {
				$leveloff = unserialize($store_meal['leveloff']);	
				if (!empty($this->user_session) && isset($this->user_session['level'])) {
					/****type:0无优惠 1百分比 2立减*******/
					if (!empty($leveloff) && is_array($leveloff) && isset($this->user_level[$this->user_session['level']]) && isset($leveloff[$this->user_session['level']])) {
						$level_off = $leveloff[$this->user_session['level']];
						if ($level_off['type'] == 1) {
							$finaltotalprice = $price *($level_off['vv']/100);
							$finaltotalprice = $finaltotalprice > 0 ? $finaltotalprice : 0;
							$level_off['offstr'] = '按此次总价' . $level_off['vv'] . '%来结算';
						} elseif($level_off['type'] == 2) {
							$finaltotalprice = $price - $level_off['vv'];
							$finaltotalprice = $finaltotalprice > 0 ? $finaltotalprice : 0;
							$level_off['offstr'] = '此次总价立减' . $level_off['vv'] . '元';
						}
					}
				}
				unset($leveloff);
			}
		}
		
		$price = $finaltotalprice > 0 ? round($finaltotalprice,2) : $price;
		$total_price = $price;
		$minus_price = 0;
		if ($store_meal && !empty($store_meal['minus_money']) && $price > $store_meal['full_money']) {
			$price = $price - $store_meal['minus_money'];
			$minus_price = $store_meal['minus_money'];
		}
		
		is_array($level_off) && $level_off['totalprice'] = $price;
		
		$data = array('mer_id' => $this->_store['mer_id'], 'store_id' => $store_id, 'name' => '', 'phone' => '', 'address' => '', 'note' => '', 'info' => serialize($info), 'dateline' => time(), 'total' => $total, 'price' => $price);
		$data['total_price'] = $total_price;
		$data['minus_price'] = $minus_price;
		
		$data['num'] = $people_num;
		$data['tableid'] = $tableid;
		$data['meal_type'] = 2;//现场点餐
		$data['arrive_time'] = time();
		
		$data['orderid'] = $this->_store['mer_id'] . $store_id . date("YmdHis") . rand(1000000, 9999999);
		$data['uid'] = $this->user_session['uid'];
		$level_off && is_array($level_off) && $data['leveloff'] = serialize($level_off);
		$orderid = D("Meal_order")->add($data);
		if ($orderid) {
			$msg = ArrayToStr::array_to_str($orderid);
			$op = new orderPrint($this->config['print_server_key'], $this->config['print_server_topdomain']);
			$op->printit($this->_store['mer_id'], $this->_store['store_id'], $msg, 0);
			
			$str_format = ArrayToStr::print_format($orderid);
			foreach ($str_format as $print_id => $print_msg) {
				$print_id && $op->printit($this->_store['mer_id'], $this->_store['store_id'], $print_msg, 0, $print_id);
			}
			
			$sms_data = array('mer_id' => $store['mer_id'], 'store_id' => $store['store_id'], 'type' => 'food');
			if ($this->config['sms_place_order'] == 1 || $this->config['sms_place_order'] == 3) {
				$sms_data['uid'] = $this->user_session['uid'];
				$sms_data['mobile'] = $data['phone'] ? $data['phone'] : $this->user_session['phone'];
				$sms_data['sendto'] = 'user';
				$sms_data['content'] = '您在' . $store['name'] . '中下单成功，订单号：' . $orderid;
				Sms::sendSms($sms_data);
			}
			if ($this->config['sms_place_order'] == 2 || $this->config['sms_place_order'] == 3) {
				$sms_data['uid'] = 0;
				$sms_data['mobile'] = $store['phone'];
				$sms_data['sendto'] = 'merchant';
				$sms_data['content'] = '客户' . $data['name'] . '刚刚下了一个订单，订单号：' . $orderid . '，请您注意查看并处理';
				Sms::sendSms($sms_data);
			}
			exit(json_encode(array('error_code' => 0, 'msg' => '', 'url' => U('Pay/check',array('order_id' => $orderid, 'type'=>'foodPad', 'online' => $pay_type)))));
		} else {
			exit(json_encode(array('error_code' => 1, 'msg' => D("Meal_order")->getError())));
		}
	}
	
	public function get_table(){
		empty($this->_store) && exit(json_encode(array('errcode' => 1, 'msg' => '不存在的店铺')));
		$store_id = $this->_store['store_id'];
		$date = isset($_POST['date']) ? $_POST['date'] : '';
		$time = isset($_POST['time']) ? $_POST['time'] : '';
		$arrive_time = strtotime($date . ' ' . $time . ':00');
		if ($arrive_time < time()) {
			$arrive_time = time();
// 			exit(json_encode(array('errcode' => 1, 'msg' => '预订时间不能小于当前时间')));
		}
		$star_time = $arrive_time - 7200;
		$end_time = $arrive_time + 7200;
		$tables = D('Merchant_store_table')->field(true)->where(array('store_id' => $store_id))->select();
		
		$orders = D('Meal_order')->field('tableid')->where("`store_id`={$store_id} AND `paid`=1 AND `status`=0 AND `is_confirm`=1 AND `arrive_time`>'{$star_time}' AND `arrive_time`<'{$end_time}' AND tableid>0")->select();
		$tids = array();
		foreach ($orders as $row) {
			$tids[$row['tableid']] = $row;
		}
		
		$table_list = array();
		foreach ($tables as $table) {
			if (!isset($tids[$table['pigcms_id']])) {
				$table_list[] = $table;
			}
		}
		exit(json_encode(array('errcode' => 0, 'data' => $table_list)));
	}
	
	public function logout(){
		session('user', null);
		exit();
	}
	public function tj(){
		empty($this->_store) && $this->error("不存在的商家店铺!");
		$orid = isset($_GET['orid']) ? intval($_GET['orid']) : 0;

		$tableid = isset($_GET['tableid']) ? intval($_GET['tableid']) : 0;
		if ($now_table = D('Merchant_store_table')->field(true)->where(array('pigcms_id' => $tableid, 'store_id' => $this->_store['store_id']))->find()) {
			$_SESSION[$this->session_table_index] = $tableid;
		}

		//客户的购物车记录
		$disharr = unserialize($_SESSION[$this->session_index]);
		
		if ($order = $this->check_order($orid)) {
			if ($order['paid'] != 1) {
				$info = unserialize($order['info']);
				foreach ($info as $om) {
					if (isset($disharr[$om['id']])) {
						$disharr[$om['id']]['num'] += $om['num'];
					} else {
						$disharr[$om['id']]['num'] = $om['num'];
					}
				}
			}
			$this->assign('orid', $orid);
		} else {
			$this->assign('orid', 0);
		}

		/**************客户收藏的菜品*****************/
		$like = D('Meal_like')->field('meal_ids')->where(array('uid' => $this->user_session['uid'], 'store_id' => $this->store_id, 'mer_id' => $this->mer_id))->find();
		$meal_ids = array();
		$like && $meal_ids = unserialize($like['meal_ids']);
		/**************客户收藏的菜品*****************/
		
		//菜品分类
		$sorts = M("Meal_sort")->where(array('store_id' => $this->store_id))->order('sort DESC, sort_id DESC')->select();
		$t_meals = $meals = $list = array();
		$ids = array();
		foreach ($sorts as $sort) {
			if ($sort['is_weekshow']) {
				$week = explode(",", $sort['week']);
				if (in_array(date("w"), $week)) {
					$list[$sort['sort_id']] = $sort;
					$ids[] = $sort['sort_id'];
				}
			} else {
				$list[$sort['sort_id']] = $sort;
				$ids[] = $sort['sort_id'];
			}
		}
		
		$nowDay = date('Ymd');
		$MOOBJ = D('Meal_order');
		$meal_image_class = new meal_image();
		$temp = M("Meal")->where(array('store_id' => $this->store_id, 'sort_id' => array('in', $ids), 'status' => 1))->order('sort DESC')->select();
		foreach ($temp as $m) {
			if (isset($disharr[$m['meal_id']])) {
				$m['num'] = $disharr[$m['meal_id']]['num'];
			} else {
				$m['num'] = 0;
			}
			if (in_array($m['meal_id'], $meal_ids)) {
				$m['like'] = 1;
			} else {
				$m['like'] = 0;
			}
			
			
			if ($m['sell_mouth'] != $nowDay) {
				$m['sell_count'] = 0;
			}
			
			/***库存的处理***/
			$m['max'] = -1;
			$check_stock = $MOOBJ->check_stock($m['meal_id']);
			$m['max'] = $check_stock['stock_num'];
			
			$m['image'] = $meal_image_class->get_image_by_path($m['image'], $this->config['site_url'], 's');
			if (isset($t_meals[$m['sort_id']]['list'])) {
				$t_meals[$m['sort_id']]['list'][] = $m;
			} else {
				$t_meals[$m['sort_id']]['list'] = array($m);
				$t_meals[$m['sort_id']]['sort_id'] = $m['sort_id'];
			}
		}
		
		foreach ($ids as $sort_id){
			if (isset($t_meals[$sort_id])) {
				$meals[$sort_id] = $t_meals[$sort_id];
			} else {
				unset($list[$sort_id]);
			}
		}
		
		/* 粉丝行为分析 */
		$this->behavior(array('mer_id' => $this->mer_id, 'biz_id' => $this->store_id,'keyword'=>strval($_GET['keywords'])));
        $where=array('s.mer_id'=>$this->mer_id,'s.store_id'=>$this->store_id);
        $store_info=D('merchant_store')->alias('s')
            ->join('left join __AREA__ a on s.area_id=a.area_id')
            ->join('left join __MERCHANT__ b on s.mer_id=b.mer_id')
            ->field('s.mer_id,s.store_id,b.name,a.area_ip_desc,s.txt_info,s.adress,s.pic_info')
            ->where($where)
            ->find();
        $store_info['pic_info']=str_replace(',','/',$store_info['pic_info']);
        $this->assign('store_info',$store_info);
		
		$this->assign('meals', $meals);
		$this->assign("sortlist", $list);
		$this->display();
	}


	public function test(){
        $pay_class_name = 'Weixin';
        import('@.ORG.pay.'.$pay_class_name);
        $pay_method = D('Config')->get_pay_method(0,0,true);
        $order_info = array(
            'order_name'=>'微信支付测试',
            'order_id'=>time().mt_rand(0,999999),
        );
        $pay_method['weixin']['config']['sub_mch_id']=1392691402;
        $pay_money = 0.01;
        $pay_type = 'weixin';
        $pay_class = new Weixin(
            $order_info,
            $pay_money,
            $pay_type,
            $pay_method['weixin']['config'],
            $this->user_session,
            1
        );
        $pay_param = $pay_class->pay(null,null,'/source/web_weixin_notice_water.php');
        dump($pay_param);
        $this->assign('weixin_param',$pay_param['weixin_param']);
        $this->display('custom_water1');
    }
    public function test2(){
        $this->display('custom_water2');


    }
    public function test3(){

        $this->display('custom_water3');
    }

    /**
     * 购买列表
     */
    public function water_list(){
        $this->display('meal_list');
    }

    /**
     * 异步获取购买列表内容
     */
    public function get_meal_list(){
        $store_id = 33;//桶装水ID
        $model = new Meal_coupon_redeemModel($store_id);
        $meal_list = $model->get_meals();
        if($meal_list){
            $this->ajaxReturn(array('err'=>0,'msg'=>'','data'=>$meal_list));
        }else{
            $this->ajaxReturn(array('err'=>1,'msg'=>'获取数据失败','data'=>null));
        }
    }

    public function buy_now($meal_id,$coupon_num){
        $model = new Meal_coupon_redeemModel(33);
        $meal_info = $model->get_meal_info($meal_id,$coupon_num);
        if(!$meal_info){
            $this->ajaxReturn(array('err'=>1,'msg'=>'获取数据失败'));
        }

        //微信支付数据构建
        $pay_class_name = 'Weixin';
        import('@.ORG.pay.'.$pay_class_name);
        $pay_method = D('Config')->get_pay_method(0,0,true);
        $order_info = array(
            'order_name'=>'微信支付测试',
            'order_id'=>$model->set_order_id($meal_id,$coupon_num),
        );
        $pay_method['weixin']['config']['sub_mch_id']=1489561792;//子商户大头仔ID
        $pay_money = $meal_info['price'] * $coupon_num;
        $pay_money = 0.01;
        $pay_type = 'weixin';
        $pay_class = new Weixin(
            $order_info,
            $pay_money,
            $pay_type,
            $pay_method['weixin']['config'],
            $this->user_session,
            1
        );
        $pay_param = $pay_class->pay(null,null,'/source/web_weixin_notice_water.php');
        $pay_param['data'] = $pay_param['weixin_param'];
        $this->ajaxReturn($pay_param);
    }

    /**
     * 兑换水的列表，若没有直接买水
     */
    public function water_introduce(){
     /*  $tmp = session('user');
       $tmp['uid'] = 164;
       session('user',$tmp);
        dump($_SESSION);*/
        $this->get_store_info(33);
        $user_info = user_info();
        $this->assign('user_info',$user_info);
        //dump($user_info);exit();
        //查询是否还有兑换卷
        $model = new Meal_coupon_redeemModel(33);
        $list = $model->get_all_coupon();
        if($list){
            $this->assign('list',$list);
            $this->display('water_coupon');
        }else{
            $this->display('water_introduce');
        }

    }

    /**
     * 用户使用券兑换水
     */
    public function redeem_water(){
        $this->get_store_info(33);
        $order = array_filter(json_decode(htmlspecialchars_decode($_POST['order']),true));
        $address = I('post.address','','htmlspecialchars_decode');
        $flag = 1;
        $model = new Meal_coupon_redeemModel(33);
        $model->startTrans();
        if($order){
            $group_hash = createRandomStr(32);
            foreach($order as $row){
                $num = $model->redeem_goods($row['order_id'],$row['redeem_num'],$group_hash,$address);
                $flag *= ($num?1:0);
            }
        }
        if($flag){
            $model->commit();
            $model->send_water_msg($group_hash);
            $this->ajaxReturn(array('err'=>0,'msg'=>'预定成功','data'=>json_decode($_POST)));
        }else{
            $model->rollback();
            $this->ajaxReturn(array('err'=>1,'msg'=>'失败'));
        }

    }

    /**
     * 向管理员（送水工） 推送的消息页面
     */
    public function water_audit($group_hash){
        $model = new Meal_coupon_redeemModel(33);
        $water_data = $model->get_redeem_log($group_hash);
        $this->assign('data',$water_data);
        $this->display();
    }

    /**
     * 管理员向用户 推送的消息页面
     */
    public function start_send_water($group_hash){
        $model = new Meal_coupon_redeemModel(33);
        $water_data = $model->get_redeem_log($group_hash);
        $this->assign('data',$water_data);
        $this->display();
    }

    public function test1(){
//        $model = new Meal_coupon_redeem2Model();
//        $list = $model->water_list();
//        dump($list);
        dump($_SESSION);
    }

    /**
     * 确认送达
     */
    public function  audit_fulfill(){
        $this->check_water_admin();
        $model = new Meal_coupon_redeemModel(33);
        $status = I('post.status',0,'intval');
        $group_hash = I('post.group_hash');
        $fulfill_time = time();
        $fulfill_uid = session('user.uid');
        switch ($status){
            case 1:
                $save_data = array(
                    'fulfill_uid'=>$fulfill_uid,
                );
                $model->send_start_msg($group_hash);
                break;
            case 100:
                $save_data = array(
                    'fulfill_time'=>$fulfill_time,
                    'fulfill_uid'=>$fulfill_uid,
                );
                break;
        }
        $save_data['status'] = $status;

        $re = $model->where('group_hash="%s"',$group_hash)->save($save_data);
        if($re!==false){
            $this->success("更新完成");
        }else{
            $this->error("发送错误");
        }
    }

    /**
     * 检查权限
     */
//    public function check_water_admin(){
//        $res = M('user')->alias('u')
//            ->join('join __ADMIN__ a on u.openid=a.openid')
//            ->where('a.role_id=64 and u.uid=%d',session('user.uid'))
//            ->count();
//        if(!$res) $this->error("你没有权限");
//    }

    /**
     * 检查多角色权限
     */
    public function check_water_admin(){
        $res = M('user')->alias('u')
            ->join('join __ADMIN__ a on u.openid=a.openid')
            ->where('u.uid=%d',session('user.uid'))
            ->find();
        if ($res) {
            $role_idArr = explode(',',$res['role_id']);
            if (!in_array('64',$role_idArr)) $this->error("你没有权限");
        } else {
            $this->error("你没有权限");
        }

    }


    /**
     * 获取店铺信息
     */
    public function get_store_info($store_id){
        $mer_id = M('merchant_store')->where('store_id=%d',$store_id)->getField('mer_id');
        $where=array('s.mer_id'=>$mer_id,'s.store_id'=>$store_id);
        $store_info=D('merchant_store')->alias('s')
            ->join('left join __AREA__ a on s.area_id=a.area_id')
            ->join('left join __MERCHANT__ b on s.mer_id=b.mer_id')
            ->field('s.mer_id,s.store_id,b.name,a.area_ip_desc,s.txt_info,s.adress,s.pic_info,s.phone')
            ->where($where)
            ->find();
        $store_info['pic_info']=str_replace(',','/',$store_info['pic_info']);
        $this->assign('store_info',$store_info);
    }



}
?>