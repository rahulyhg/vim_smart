<?php
/**
 * Created by PhpStorm.
 * author: zhukeqin
 * Date: 2018/4/11
 */
class FoodModel
{
    /**
     * @author zhukeqin
     * @param $orderid 订单编号
     * @return bool
     */
    public function send_food_tpl($order_id)
    {
        $orderinfo=M('meal_order')->where(array('orderid'=>$order_id))->find();
        //获取店员openid
        $map=array('store_id'=>$orderinfo['store_id'],'openid'=>array('neq',''));
        $openids=M('merchant_store_staff')->field('openid')->where($map)->select();
        foreach ($openids as $k=>$v){
            $openid[]=$v['openid'];
        }
        //获取店铺信息
        $store_info=M('merchant_store')->where(array('store_id'=>$orderinfo['store_id']))->find();
        //商品名称和数量,价格
        $order_info='';
        $pre='';
        $total_price=0;
        foreach (unserialize($orderinfo['info']) as $menu) {
            $order_info .= $pre . $menu['name'] . ':' . $menu['price'] . '*' . $menu['num'];
            $total_price +=$menu['price']*$menu['num'];
            $pre = '\n\t\t\t';
        }
        //转换交易类型名称
        switch ($orderinfo['pay_type']){
            case 'weixin':$orderinfo['pay_type_str']='在线支付';break;
            case 'offline':$orderinfo['pay_type_str']='线下支付';break;
        }
        $href = C('config.site_url').'/wap.php?g=Wap&c=Storestaff&a=meal_edit&order_id='. $orderinfo['order_id'];
        $address= $orderinfo['name'].'   '.$orderinfo['phone'].'   '.$orderinfo['address'];
        $data = array(
            'first'=>array(
                'value'=>$store_info['name'].",您有一笔新的订单",
                'color'=>"#029700",
            ),
            'keyword1'=>array(
                'value'=>$order_id,//订单编号
                'color'=>"#000000",
            ),
            'keyword2'=>array(
                'value'=>$order_info,//订单商品
                'color'=>"#000000",
            ),
            'keyword3'=>array(
                'value'=>sprintf("%.2f",$total_price).'元',//订单金额
                'color'=>"#000000",
            ),
            'keyword4'=>array(
                'value'=>$orderinfo['pay_type_str'],//交易方式
                'color'=>"#000000",
            ),
            'keyword5'=>array(
                'value'=>$address,//顾客信息
                'color'=>"#000000",
            ),
            'remark'=>array(
                'value'=>'顾客备注信息：'.$orderinfo['note'],//顾客备注
                'color'=>"#000000",
            )
        );
        $tempid=get_wxmsg_tpl('21');
        $model=new WechatModel();
        /*dump($openid);
        dump($tempid);
        dump($data);*/
        $model->send_tpl_messages($openid,$tempid,$href,$data);
    }
}