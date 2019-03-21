<?php
class House_village_room_propertylistModel extends Model{

    public function get_order_by_id($uid,$order_id){
        if($uid)$condition_user_recharge_order['uid'] = $uid;
        $condition_user_recharge_order['pigcms_id'] = $order_id;
        return $this->field(true)->where($condition_user_recharge_order)->find();
    }

    public function get_order_list($where,$status=1,$order_by='pigcms_id asc'){
        $where['status']=$status;
        return $this->where($where)->order($order_by)->select();
    }

    /**
     * @author zhukeqin
     * @param $uid
     * @param $order_id
     * @param bool $is_web
     * @return array
     */
    public function get_pay_property($uid,$order_id,$is_web=false){
        $now_order = $this->get_order_by_id($uid,$order_id);
        // dump($this);exit;
        if(empty($now_order)){
            return array('error'=>1,'msg'=>'当前订单不存在！');
        }

            $order_info = array(
                'order_id'			=>	$now_order['pigcms_id'],
                'order_type'		=>	'livepay_property',
                'order_name'		=>	'在线缴费',
                'order_num'			=>	1,
                'order_price'		=>	floatval($now_order['pay_receive']),
                'order_total_money'	=>	floatval($now_order['pay_receive']),
                'live_type'		=>	'livepay_property',	//缴费类型
            );
        return array('error'=>0,'order_info'=>$order_info);
    }



    public function after_pay($order_param){
        M('house_village_room_propertylist')->where(array('pigcms_id'=>$order_param['order_id']))->save(array('status'=>1,'pay_time'=>time()));	//改变支付状态
        $now_order = M('house_village_room_propertylist')->where(array('pigcms_id'=>$order_param['order_id']))->find();
        $room_uptown=M('house_village_room_uptown')->where(array('rid'=>$now_order['rid']))->find();
        $data['property_endtime']=date('Y-n-j', strtotime ("+".$now_order['mouth']." month", strtotime($room_uptown['property_endtime'])));
        M('house_village_room_uptown')->where(array('rid'=>$now_order['rid']))->data($data)->save();
    }

}