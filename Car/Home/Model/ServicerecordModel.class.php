<?php

namespace Home\Model;

use Think\Model;


class ServicerecordModel extends Model{
    
    //字段映射
    protected $_map = array(
        'c_no' => 'car_no',
    );

    //生成停车记录
    public function make_serv_recored($data){
        
        $car_no=$data['carNo'];
        
        //创建停车记录
        $record_data=array(
            'car_no'=>$car_no, //车牌号
            'car_imgs'=>$data['enterPicUrl'], //车辆入场时电子抓拍照片
            'start_time'=>$data['enterTime'], //停车场进入时间
            //'garage_id'=> 2,
            'garage_id'=> session('garage_id'), //停车场编号
        );
        
        //判断时间是否为字串形式，如果为字串形式，将字串形式转为时间戳格式
        if( is_string($record_data['start_time']) ){
            $record_data['start_time'] = strtotime($record_data['start_time']);
        }
        
        $recored_id=$this->add($record_data);
        
        if( $recored_id ){
            return $recored_id;     //添加停车记录成功，返回插入成功的id
        }else{
            return false;       //添加失败，返回false
        }
    }


    //创建真实订单（本程序订单）
    public function self_make_order($simple_car_info,$recored_id){
        //判断是否存在用户登录
        if(session('user_id')){
            $user_id= session('user_id');
        }else{
            $user_id=0;
        }
        
        //消费类型(停车消费)
        $pay_type=1;
        
        //自定义订单编号生成算法
        $pay_no=date('YmdHis').rand(10000,32767);
        
        //检测时间字段是否为字符串，为字符串的话转为时间戳(注意时间字串格式yyyy-MM-dd HH:mi:ss，否则转换不准)
        if( is_string( $simple_car_info['enterTime']) ){
            $simple_car_info['enterTime']= strtotime($simple_car_info['enterTime']);
        }
        
        $payment=$this->make_fee_by_time_rule($simple_car_info['enterTime']); //计算应付金额
        

        $our_order_data=array(
            'serv_id'=>$recored_id, //对应停车记录表
            'user_id'=>$user_id, //用户id
            'pay_user'=>$user_id,//创建订单人
            'start_time'=>$simple_car_info['enterTime'], //车辆进入停车场时间
            'create_time'=>time(), //本订单生成时间
            'pay_type'=>$pay_type, //消费类型
            'pay_no'=>$pay_no, //先生成我们自己的，后期调用第三方的再进行更新，否则不更新此字段
            'api_pay_no'=>$pay_no,  //第三方订单编号，如果没有第三方订单编号，默认与本程序订单一致
            'payment'=>$payment,//应付金额
        );
        
        //正式生成订单
        $order_add_id=M('payrecord')->add($our_order_data);
        if( $order_add_id ){
            
            //生成订单成功后，对停车记录表servicerecord的缴费记录id字段进行维护
            if( M('servicerecord')->where("serv_id=$recored_id")->setField('pay_record',$order_add_id) ){
                return array('resul_no'=>1,'order_add_id'=>$order_add_id);   //订单生成ok，且同时对停车记录表servicerecord的缴费记录id字段进行维护成功，返回1
            }else{
                return array('resul_no'=>2,'order_add_id'=>$order_add_id);   //订单生成ok，但是对停车记录表servicerecord的缴费记录id字段进行维护失败，返回2
            }
            
        }else{
            //订单生成失败，返回3
            return 3;
        }
        
    }

    /*//停车服务根据时间计费规则(5元/小时，向上取整原则)
    public function make_fee_by_time_rule($start_time){
        $now_time= time();
        if( $now_time-$start_time<900 ){
            $payment=0;
        }else{
            $payment=ceil(($now_time-$start_time)/3600)*5;
        }

        return $payment;
    }*/

    public function make_fee_by_time_rule($start_time){
        //读出关于停车场的配置文件
        if(!session('garage_id')){
            return false;
        }else{
            $car_univalence = M('config')->where(array('name'=>'car_univalence_'.session('garage_id')))->find();
            $car_free_time  = M('config')->where(array('name'=>'car_free_time_'.session('garage_id')))->find();
            //$garage_info=M('garage')->where(array('garage_no'=>$this->garage_no))->find();//停车场收费信息
            //$car_free_time['value']=$garage_info['garage_free_time'];
            //$car_univalence['value']=$garage_info['garage_unit_price'];
            $now_time= time();
            if($now_time-$start_time<$car_free_time['value']){
                $payment=0;
            }else{
                $payment=ceil(($now_time-$start_time)/3600)*$car_univalence['value'];
            }
            return $payment;
        }
    }
    
}

