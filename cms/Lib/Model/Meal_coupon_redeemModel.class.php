<?php

class Meal_coupon_redeemModel extends Model
{


    protected $user_info = array();
    protected $store_id;
    protected $mer_id = 0;


    public function __construct($store_id)
    {
        parent::__construct();
        $this->get_user_info();
        $this->store_id = $store_id;
        $this->mer_id =  M('merchant_store','pigcms_')->where('store_id=%d',$this->store_id)->getField('mer_id')?:0;
    }

    /**
     * @param array $store_id店铺ID
     * @return mixed
     */
    public function get_meals($store_id=0){
        $store_id = $store_id?:$this->store_id;
        $map = array();
        $map['ms.sort_id'] = array('gt',0);
        if($store_id){
            if(is_array($store_id)){
                $map['m.store_id'] = array('in',$store_id);
            }else{
                $map['m.store_id'] = array('eq',$store_id);
            }
        }
        $field = array(
            'm.meal_id',
            'm.name',
            'm.store_id',
            'ms.sort_id',
            'ms.sort_name',
            'm.price',
            'm.image',

        );
        $list =  M('meal','pigcms_')->alias('m')
            ->field($field)
            ->join('left join __MEAL_SORT__ ms on m.sort_id = ms.sort_id')
            ->where($map)
            ->order('ms.sort DESC,ms.sort_id ASC')
            ->select();
        if($list){
            $tmp = array();
           foreach($list as $row){
               $tmp[$row['sort_id']]['sort_id'] = $row['sort_id'];
               $tmp[$row['sort_id']]['sort_name'] = $row['sort_name'];
                $tmp[$row['sort_id']]['_meals'][] = array(
                    'meal_id'=>$row['meal_id'],
                    'name'=>$row['name'],
                    'price'=>$row['price'],
                    'coupon_num'=>10,
                    'image'=>$row['image'],
                    'pic'=>'/upload/meal/'.str_replace(',','/',$row['image'])
                );

           }
            return $tmp;
        }else{
            return false;
        }
    }

    /***
     * 获取用户信息
     * @return mixed
     */
    protected function get_user_info($user_id=0){
        $uid = $user_id?:session('user.uid');
        $user_info = M('user','pigcms_')->alias('u')
            ->join('left join __HOUSE_VILLAGE_USER_BIND__ ub on ub.uid=u.uid')
            ->where('u.uid=%d',$uid)
            ->find();
        $this->user_info = $user_info;
        return $user_info;
    }

    /**
     * 用户购买券
     * @param $meal_id
     * @param $meal_num
     * @return array()
     */
    public function add_data($order_id){
        //通过微信回传的订单号提取支付信息
        $order_info  = $this->order_id2meal_info($order_id);
        $meal_id = $order_info['meal_id'];
        $meal_num = $order_info['coupon_num'];
        $user_id = $order_info['user_id'];

        $info = $this->get_meal_info($meal_id,$meal_num);
        $user_info = $this->get_user_info($user_id);
        //需要添加的数据
        $data = array(
            'uid'=>$user_id,
            'mer_id'=>$this->mer_id,
            'store_id'=>$this->store_id,
            'store_uid'=>0,
            'orderid'=>date('YmdHis') . sprintf("%08d",$user_info['uid']),
            'status'=>0,
            'name'=>$user_info['nickname']?:"",
            'phone'=>$user_info['phone']?:0,
            'address'=>$user_info['address']?:"",
            'tableid'=>0,
            'note'=>'',
            'info'=>serialize($this->get_meal_info($meal_id,$meal_num)),
            'num'=>1,
            'total'=>$meal_num,
            'price'=>$info['price'],
            'dateline'=>time(),
            'paid'=>0,
            'pay_type'=>'weixin',
            'pay_time'=>0,
            'use_time'=>0,
            'third_id'=>'',
            'meal_type'=>0,
            'meal_pass'=>0,
            'is_mobile_pay'=>1,
            'balance_pay'=>'',
            'payment_money'=>'',
            'card_id'=>'',
            'last_time'=>'',
            'merchant_balance'=>'',
            'is_pay_bill'=>'',
            'refund_detail'=>'',
            'arrive_time'=>'',
            'sex'=>'',
            'delivery_fee'=>'',
            'pay_money'=>'',
            'is_own'=>'',
            'last_staff'=>'',
            'leveloff'=>'',
            'total_price'=>'',
            'minus_price'=>'',
            'ds_id'=>'',
            'is_confirm'=>'',
            'score_used_count'=>'',
            'submit_order_time'=>time(),
            'score_deducte'=>'',
            'refund'=>'',
        );
        $num = M('meal_order')->add($data);
        if($num){
            $data['order_id'] = $num;
            return $data;
        }else{
            return false;
        }
    }

    /**
     * 获取订单信息
     * @param $order_id 主键
     */
    public function get_order_info($order_id){
        $info =  M('meal_order')->where('order_id=%d',$order_id)->find();
        $info['meal_info'] = unserialize($info['info']);
        return $info;
    }

    /**
     * 用户兑换商品
     * @param $meal_id
     * @param $redeem_num
     * @param $group_hash //批次key
     * @return bool
     */
    public function redeem_goods($order_id,$redeem_num,$group_hash=false,$address=""){
        $group_hash = $group_hash?:createRandomStr(32);
        $order_info = $this->get_order_info($order_id);
        $meal_info = $order_info['meal_info'];
        $data = array(
            'buyer_uid'=>$this->user_info['uid'],
            'address'=>$address?:$this->user_info['address'],
            'remark'=>'',
            'fulfill_uid'=>'',
            'order_id'=>$order_id,
            'fulfill_time'=>'',
            'redeem_time'=>time(),
            'redeem_num'=>$redeem_num,
            'meal_id'=>$meal_info['id'],
            'group_hash'=>$group_hash,

        );
        return $this->add($data);
    }

    /**
     * 配送人确认已送达
     * @param $order_id
     * @return bool
     */
    public function affirm_fullfill($order_id){
        return false;
    }


    /**
     * 获取该店铺所有的购买记录
     * @return array
     */
    public function get_all_coupon(){
        $field = array(
            'mo.order_id',
            'mo.uid',
            'mo.store_id',
            'mo.mer_id',
            'mo.orderid',
            'mo.name',
            'mo.phone',
            'mo.address',
            'mo.total',
            'mo.info',
            'sum(IFNULL(mcr.redeem_num,0))',
            'mo.total - sum(IFNULL(mcr.redeem_num,0))'=>'left_coupon'//剩余券
        );
        $map = array();
        $map['store_id'] = array('eq',$this->store_id);
        $map['uid'] = array('eq',$this->user_info['uid']);
        $order_list = M('meal_order')->alias('mo')
            ->field($field)
            ->join('left join __MEAL_COUPON_REDEEM__ mcr on mcr.order_id = mo.order_id')
            ->group('mo.order_id')
            ->having('left_coupon > 0')
            ->where($map)
            ->select();
        if($order_list){
            foreach($order_list as &$row){
                $row['info'] = unserialize($row['info']);
                $row['redeem_num'] = 0;
            }
            //$order_list[0]['redeem_num'] = 1;//首个水券默认为1
        }
        return $order_list;
    }

    /**
     * 获取商品信息
     * @param $meal_id
     * @param $meal_num
     */
    public function get_meal_info($meal_id,$meal_num){
        $meal_info = M('meal','pigcms_')->where('meal_id=%d',$meal_id)->find();
        $info = array(
            'id'=>$meal_id,
            'name'=>$meal_info['name'],
            'price'=>$meal_info['price'],
            'num'=>$meal_num,
            'omark'=>'',
            'isadd'=>0,
            'iscount'=>0,
            'pic'=>'/upload/meal/'.str_replace(',','/',$meal_info['image'])
        );
        return $info;
    }

    /**
     * 创建order_id
     * @param $meal_id
     * @param $coupon_num
     * 商户订单号 购买时间毫秒时间戳组成 使用用户ID 商品ID 购买数量
     */
    public function set_order_id($meal_id,$coupon_num){
        if(!$meal_id) return false;
        if(!$coupon_num) return false;
        list($msec, $sec) = explode(' ', microtime());
        $msectime =  (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
        $order_id = $msectime
        . 'u' . sprintf("%04d",$this->user_info['uid'])
        . 'm' . sprintf("%04d",$meal_id)
        . 'n' . sprintf("%04d",$coupon_num);
        return $order_id;
    }

    /**
     * 提取订单信息
     * @param $orderid 这个是给微信的orderid
     * @return array
     */
    public function order_id2meal_info($orderid){
        $str = preg_replace('/(\d+)u(\d+)m(\d+)n(\d+)/','$1,$2,$3,$4',$orderid);
        list($msectime,$user_id,$meal_id,$coupon_num) = explode(',',$str);
        return array(
            'msectime'=>$msectime,
            'user_id'=>intval($user_id),
            'meal_id'=>intval($meal_id),
            'coupon_num'=>intval($coupon_num),
        );
    }

    /**
     * 发送消息给送水工
     * @param $group_hash
     * @return bool
     */
    public function send_water_msg($group_hash){
        $audit_role = 64;//送水工角色
        $openids = M('admin','pigcms_')->where('role_id=%d',$audit_role)->select();
        $openids = array_column($openids,'openid');
        $wx_model = new WechatModel();
        $url =  C('WEB_DOMIAN') . U('Wap/Food/water_audit',array('group_hash'=>$group_hash));
        $data = array(
            'first'=>array(
                'value'=>"用户定水提醒",
                'color'=>"#029700",
            ),
            'keyword1'=>array(
                'value'=>"用户定水提醒",
                'color'=>"#000000",
            ),
            'keyword2'=>array(
                'value'=>$this->user_info['nickname'],
                'color'=>"#000000",
            ),
            'keyword3'=>array(
                'value'=>$this->user_info['address'],
                'color'=>"#000000",
            ),
            'keyword4'=>array(
                'value'=>date('Y-m-d H:i:s',time()),
                'color'=>"#000000",
            ),
        );

        return $wx_model->send_tpl_messages($openids,$wx_model::TPLID_LCSPTX,$url,$data);
    }
    /**
     * 通知用户
     * @param $group_hash
     * @return bool
     */
    public function send_start_msg($group_hash){
        $data = $this->get_redeem_log($group_hash);
        $msg = "";

        foreach ($data as $d){
            $msg .= $d['meal_info']['name'] . ' x' . $d['redeem_num'];
            $accept_user_id = $d['buyer_uid'];
        }
        $msg = trim($msg,',');
        $wx_model = new WechatModel();
        $url =  C('WEB_DOMIAN') . U('Wap/Food/start_send_water',array('group_hash'=>$group_hash));
        $data = array(
            'first'=>array(
                'value'=>"汇得行物业送水通知",
                'color'=>"#029700",
            ),
            'keyword1'=>array(
                'value'=>"您订购的桶装水正在派送中",
                'color'=>"#000000",
            ),
            'keyword2'=>array(
                'value'=>'派送员：'.$this->user_info['nickname'],
                'color'=>"#000000",
            ),
            'keyword3'=>array(
                'value'=> $msg,
                'color'=>"#000000",
            ),
            'keyword4'=>array(
                'value'=>date('Y-m-d H:i:s',time()),
                'color'=>"#000000",
            ),
        );
        $user_info = $this->get_user_info($accept_user_id);
        return $wx_model->send_tpl_message($user_info['openid'],$wx_model::TPLID_LCSPTX,$url,$data);
    }


    /**
     * 获取购买记录
     * @param $group_hash
     * @return mixed
     */
    public function get_redeem_log($group_hash){

        $data = $this->alias('mcr')
            ->field('*,mcr.status as redeem_status,mcr.address true_address')
            ->join('left join __MEAL_ORDER__ mo on mo.order_id=mcr.order_id')
            ->where('mcr.group_hash="%s"',$group_hash)
            ->select();
        if($mysql_error = mysql_error()) {
            dump($mysql_error);
            echo M()->getLastSql();
        }
        if($data){
            foreach($data as &$row){
                $row['meal_info'] = unserialize($row['info']);
                $row['admin_user_info'] = M('user')->where('uid=%d',$row['fulfill_uid'])->find();
            }
        }


        return $data;
    }




}