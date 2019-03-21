<?php

namespace Admin\Model;

use Think\Model;

class ServicerecordModel extends Model{
    
    //自动完成方法，系tp系统函数
    protected $_auto=array(
        //array('start_time','time',1,'function'), //添加新记录时会触发此自动完成
        //array('end_time','time',2,'function'), //更新数据时才会触发此自动完成
    );
    
    //将时间字符串(英文格式)转换为时间戳
    public function time_str_to_int($time_str){
        $time_ints= strtotime($time_str);
        return $time_ints;
    }
    
    
    //系统自动调用函数(数据插入完成收使用)
    protected function _after_insert($data, $options) {
        //同时产生(停车)消费记录
        //设置消费类型
        $pay_data['pay_type']=1; //1为停车消费
        //查询本车辆车主是否为系统用户，
        $user_info=M('car')->where( array('car_no'=>$data['car_no']) )->find();
        if($user_info){
            $pay_data['user_id']=$user_info['user_id'];
        }else{
            $pay_data['user_id']=0; //0为非系统会员
        }
        //服务记录id
        $pay_data['serv_id']=$data['serv_id'];
        
        //计算应付金额
            //计量单位(收费时间单位)
            $per_time=3600; //【后期写到配置表】(例如：隔10分钟算一次计费，设置为10*60，如隔一个小时就是60*60，以此类推)
            
            $payment=0; //初始化应付金额
            
            //设置入场免费时间
            $free_time=30*60; //【后期写到配置表】,设置免费时间(例如超过30分钟后开始计费)
            
            //设置价格
            $unit_price=15; //【后期写到配置表】每个间隔时间计费15元
            
            //设置偏移模式(3种模式，1为向下取整，2为四舍五入，3为向上取整 )
            $offset=2; //【后期写到配置表】默认未2，因为此种模式比较容易为双方所接受
            
            //计算时长
            $total_time=$data['end_time']-$data['start_time']; 
            
            if($total_time>$free_time){
                //算出计费节点数（浮点型)
                if($offset==1){
                    $per_fe_no=floor( ($total_time-$free_time)/$per_time ); //向下取整
                }elseif($offset==2){
                    $per_fe_no=round( ($total_time-$free_time)/$per_time ); //四舍五入法
                }elseif($offset==3){
                    $per_fe_no=ceil( ($total_time-$free_time)/$per_time ); //向上取整
                }
            }
            
            //应付金额
            $payment=$per_fe_no*$unit_price;
            $pay_data['payment']=$payment; //应付金额
            
        //实例化消费记录Model
        $pr=new \Admin\Model\PayrecordModel();
        $pr->add_record($pay_data);
    }
    
    
    /*
     * 根据输入车牌号模糊查询
     * 陈琦
     * 2017.2.15
     */
    public function selectBy_num_info($serv_infos){
        //查询所有对应车主名称，并将数据返回模板
        $pay_ids='';
        foreach($serv_infos as $k=>$v){
            $pay_ids.=',\''.$v['pay_record'].'\'';
        }
        $user_id_arr=M()->query("select user_id,pay_id,pay_type,pay_time from ".C('DB_PREFIX')."payrecord where pay_id in (".ltrim($pay_ids,',').")");
        $user_ids='';
        foreach($user_id_arr as $k=>$v){
            $user_ids.=',\''.$v['user_id'].'\'';
        }
        $user_dbname=C('DB_PREFIX')."user";
        $users_info_arr=M()->query("select user_name,user_id from ".$user_dbname." where user_id in (".ltrim($user_ids,',').")");
        $arr=array('user_id_arr'=>$user_id_arr,'users_info_arr'=>$users_info_arr);
        return $arr;
    }


    /*
     * 根据输入姓名模糊查询
     * 陈琦
     * 2017.2.15
     */
    public function selectBy_name_info($arr){
        $user_ids='';
        foreach($arr as $k=>$v){
            $user_ids.=',\''.$v['user_id'].'\'';
        }
        $user_dbname=C('DB_PREFIX')."user";
        $users_info_arr=M()->query("select user_name,user_id from ".$user_dbname." where user_id in (".ltrim($user_ids,',').")");
        $user_id_arr=M()->query("select user_id,pay_id,pay_type,pay_time,serv_id from ".C('DB_PREFIX')."payrecord where user_id in (".ltrim($user_ids,',').")");
        $res=array('user_id_arr'=>$user_id_arr,'users_info_arr'=>$users_info_arr);
        return $res;
    }
}



















