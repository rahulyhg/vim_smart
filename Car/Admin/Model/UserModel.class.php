<?php

namespace Admin\Model;

use Think\Model;

class UserModel extends Model{
    
    //自动完成方法，系tp系统函数
    protected $_auto=array(
        array('add_time','time',1,'function'), //添加新记录时会触发此自动完成
    );
    
    
    //处理数据，并处理到数据库(插入操作)
    public function get_and_add($data,$files){
        //处理car_nos表单信息
        $car_nos="";
        foreach($data['car_nos'] as $k => $v){
            if(!empty($v)){
                $car_nos.=','.$v;
            }
        }
        $data['car_nos']= ltrim($car_nos,',');
        
        //处理图片上传问题
        if($files['user_logo']['error']===0){//错误号为0表示文件上传成功，1，2表示尺寸过大，4表示其它错误
            $data=$this->user_log_upload($data,$files);
        }
        
        //将数据插入到数据库
        //处理微信登录用户无注册时间的问题
        if(!$data['add_time']){
            $data['add_time']=time();
        }
        return $this->add($data);//返回更新结果
        
    }
    
    
    //处理数据，并处理到数据库(更新操作)
    public function get_and_update($uid,$data,$files){
        //处理car_nos表单信息
        $car_nos="";
        foreach($data['car_nos'] as $k => $v){
            if(!empty($v)){
                $car_nos.=','.$v;
            }
        }
        $data['car_nos']= ltrim($car_nos,',');
        
        //处理图片上传问题
        if($files['user_logo']['error']===0){//错误号为0表示文件上传成功，1，2表示尺寸过大，4表示其它错误
            $data=$this->user_log_upload($data,$files);
            //同时删除原来的图片
            if(file_exists('./'.$data['old_user_logo'])){
                unlink($data['old_user_logo']);
            }
        }
        
        //将数据更新到数据库
        return $this->where(array('user_id'=>$uid))->save($data); //返回更新结果
    }
    
    
    //文件上传
    public function user_log_upload($data,$files){
        //图片上传
            $cfg=array(
                'rootPath'      =>  './Common/Uploads/UserLogo/', //保存根路径
            );
            $up=new \Think\Upload($cfg);
            $z=$up->uploadOne($files['user_logo']);//$up -> uploadOne($_FILES['goods_logo']);
            $user_logo_save_path=$up->rootPath.$z['savepath'].$z['savename'];
            //这里的$data是引用传递，这里进行值的改变可以影响到函数外的$data
            $data['user_logo']= ltrim($user_logo_save_path,'./');
            
            return $data;
    }
    
    
    
    //对车牌号字段数据进行二次制作
    public function car_no_str_to_arr($car_nos){
        $car_no_arr= explode(',', $car_nos);
        //将车牌号数组返回
        return $car_no_arr;
    }
    
    
    //彻底删除用户以及对应的关联表对应的记录
    public function destroy_user($uid){
        //查询对应用的的信息
        $user_info=$this->find($uid);
        if(!$user_info){
            return false; //用户不存在，直接返回
        }
        //指定用户表对应用户的删除操作
        if( !( $this->delete($uid) ) ){
            return false;
        }
        //同时删除头像
        if( file_exists('./'.$user_info['user_logo']) ){
                unlink($user_info['user_logo']);
        }
        //同时删除对应的关联表对应的记录
        
        return true;
    }


    //查询用户所有的车牌号和对应的车辆id
    public function query_car_no_id($user_infos){
        $user_ids='';
        foreach($user_infos as $v){
            $user_ids.=',\''.$v['user_id'].'\'';
        }
        $db_name=C('DB_PREFIX')."car";
        return M()->query("select car_id,car_no,user_id from ".$db_name." where user_id in (".ltrim($user_ids,',').") order by car_id desc");
    }

    //2017.1.19 祝君伟 查询当前车辆绑定的车的订单情况
    public function query_car_pay($user_id){
        //根据car_id 进行查询
        //$car_pay_info = M()->query("select p.*,c.car_no,c.car_role,u.user_wxnik from ".C('DB_PREFIX')."payrecord as p join ".C('DB_PREFIX')."car as c on p.user_id=c.user_id join ".C('DB_PREFIX')."user as u on p.user_id=u.user_id where c.user_id = $user_id order by p.create_time desc");
        $condition_table=array(C('DB_PREFIX').'payrecord'=>'p',C('DB_PREFIX').'servicerecord'=>'s',C('DB_PREFIX').'user'=>'u',C('DB_PREFIX').'car'=>'c');
        $condition_where='p.serv_id=s.serv_id and p.user_id=u.user_id and s.car_no=c.car_no and c.user_id='.$user_id.' and p.user_id='.$user_id;
        $condition_field='p.*,s.car_no,c.car_role,u.user_wxnik';
        $condition_order='p.create_time desc';
        $car_pay_info=D('')->table($condition_table)->where($condition_where)->field($condition_field)->order($condition_order)->select();
       // dump($car_pay_info);exit;
        return $car_pay_info;
    }

    //查询消费情况
    public function query_money_info($user_id){
        //根据car_id 进行查询
        //$car_pay_info = M()->query("select p.*,c.car_no,c.car_role,u.user_wxnik from ".C('DB_PREFIX')."payrecord as p join ".C('DB_PREFIX')."car as c on p.user_id=c.user_id join ".C('DB_PREFIX')."user as u on p.user_id=u.user_id where c.user_id = $user_id order by p.create_time desc");
        $condition_table=array(C('DB_PREFIX').'payrecord'=>'p',C('DB_PREFIX').'servicerecord'=>'s',C('DB_PREFIX').'user'=>'u',C('DB_PREFIX').'car'=>'c');
        $condition_where='p.serv_id=s.serv_id and p.user_id=u.user_id and p.pay_status="1" and s.car_no=c.car_no and c.user_id='.$user_id.' and p.user_id='.$user_id;
        $condition_field='p.*,s.car_no,c.car_role,u.user_wxnik';
        $condition_order='p.create_time desc';
        $car_pay_info=D('')->table($condition_table)->where($condition_where)->field($condition_field)->order($condition_order)->select();
        // dump($car_pay_info);exit;
        return $car_pay_info;
    }

    //查询发票总金额
    public function query_money_sum($uid){
        $all_bill=M('bill')->where(array('user_id'=>$uid,'bill_status'=>array('gt',0)))->select();//所有发票记录
        $pay_idall=array();//创建pay_id的一维数组
        foreach ($all_bill as $k=>$v){
            $v['pay_id']=explode(',',$v['pay_id']);
            $pay_idall = array_merge($pay_idall,$v['pay_id']);
        }
        $money=array();//消费实际金额
        foreach ($pay_idall as $v){
            $info=M('payrecord')->where(array('pay_id'=>$v,'in_bill'=>array('gt',0)))->find();
            $money[]=$info['pay_loan'];
        }
        $sum1=0;//领取了发票的实际金额总和
        $sum2=0;//实际金额总和
        foreach ($money as $v){
            $sum1+=$v;
        }
        $all=M('payrecord')->where(array('user_id'=>$uid,'pay_status'=>'1'))->select();
        foreach ($all as $v){
            $sum2+=$v['pay_loan'];
        }
        $sum3=$sum2-$sum1;//未领取发票金额
        $sum=array(
            'sum1'=>$sum1,
            'sum2'=>$sum2,
            'sum3'=>$sum3,
            'all_bill'=>$all_bill
        );
        return $sum;
    }

    //查询个人发票信息
    public function query_bill_info($all_bill){
        foreach ($all_bill as $k=>&$v){
            $v['pay_id']=explode(',',$v['pay_id']);
            $v['car_no']=array();
            $v['pay_loan']=array();
            foreach ($v['pay_id'] as $value){
                $p_info=M('payrecord')->where(array('pay_id'=>$value))->field('serv_id,pay_loan')->find();
                $v['pay_loan'][]=$p_info['pay_loan'];
                $car_no=M('servicerecord')->where(array('serv_id'=>$p_info['serv_id']))->getField('car_no');
                $v['car_no'][]=$car_no;

            }
            $v['car_no']=array_flip(array_flip($v['car_no']));

        }
        unset($v);
        foreach ($all_bill as &$value){
            $value['sum']=0;
            foreach ($value['pay_loan'] as $v){
                $value['sum']+=$v;
            }
        }
        unset($value);
        $result=$all_bill;
        return $result;
    }
    
}

