<?php
class House_village_otherfeeModel extends Model{
    public function get_order_by_id($uid,$order_id){
        if($uid)$condition_user_recharge_order['uid'] = $uid;
        $condition_user_recharge_order['otherfee_id'] = $order_id;
        return $this->field(true)->where($condition_user_recharge_order)->find();
    }

    public function get_order_list($where,$status=1,$order_by='otherfee_id asc'){
        $where['status']=$status;
        return $this->where($where)->order($order_by)->select();
    }
}