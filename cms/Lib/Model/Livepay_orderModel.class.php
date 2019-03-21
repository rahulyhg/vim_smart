<?php
class Livepay_orderModel extends Model{
    public function after_pay($order_param){
        M('House_village_pay_order')->where(array('order_id'=>$order_param['order_id']))->save(array('is_pay'=>1,'pay_time'=>time()));	//改变支付状态
        $now_order = M('House_village_pay_order')->where(array('order_id'=>$order_param['order_id']))->find();
        $type_price=$now_order['order_type'].'_price';	//缴费类型
        $pid=explode(',',$now_order['pid']);
        foreach ($pid as $pid_key=>$pid_value){
            $payinfo=M('House_village_user_paylist')->where(array('pigcms_id'=>$pid_value))->find();
            $now_total=$payinfo['total_price']-$payinfo[$type_price];
            $data=array("$type_price"=>0,'total_price'=>$now_total);
            if($now_total==0){
                $data['is_create']=1;
            }
            M('House_village_user_paylist')->where(array('pigcms_id'=>$pid_value))->data($data)->save();
        }
    }
}