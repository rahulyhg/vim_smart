<?php

namespace Admin\Model;

use Think\Model;

class ConfigModel extends Model{
    //protected $tableName='config_copy';

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
    public function get_and_update($data,$files){

        //$file_upload_flag=false;
        //dump($files);exit;
            //改变标志
            $file_upload_flag=false;

            //进行文件上传操作
            $data=$this->admin_sfzimg_upload($data,$files);
           // dump($data);exit;
            foreach ($data as $key=>$value){
                $data1['name'] = $key;

                $data1['value'] = trim(stripslashes(htmlspecialchars_decode($value)));

                $this->save($data1);

            }
        $file_upload_flag=true;

        return $file_upload_flag;

        //将数据更新到数据库

    }

    //文件上传
    public function admin_sfzimg_upload($data,$files){
        //图片上传
        $cfg=array(
            'rootPath'      =>  './Common/Uploads/AdminSFZ/', //保存根路径
        );
        $up=new \Think\Upload($cfg);

        $z=$up->uploadOne($files['pay_weixin_client_cert']);//$up -> uploadOne($_FILES['goods_logo']);
        $user_logo_save_path=$up->rootPath.$z['savepath'].$z['savename'];
        //这里的$data是引用传递，这里进行值的改变可以影响到函数外的$data
        $data['pay_weixin_client_cert']= ltrim($user_logo_save_path,'./');

        $z2=$up->uploadOne($files['pay_weixin_client_key']);//$up -> uploadOne($_FILES['goods_logo']);
        $user_logo_save_path=$up->rootPath.$z2['savepath'].$z2['savename'];
        //这里的$data是引用传递，这里进行值的改变可以影响到函数外的$data
        $data['pay_weixin_client_key']= ltrim($user_logo_save_path,'./');

        $z2=$up->uploadOne($files['pay_weixin_rootca']);//$up -> uploadOne($_FILES['goods_logo']);
        $user_logo_save_path=$up->rootPath.$z2['savepath'].$z2['savename'];
        //这里的$data是引用传递，这里进行值的改变可以影响到函数外的$data
        $data['pay_weixin_rootca']= ltrim($user_logo_save_path,'./');

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

    //2017.1.19 祝君伟 查询当前车辆绑定的车的消费情况
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


    public function get_car_garage_config($garage_id){

        //TODO:该停车场通用

        $garageInfo = M('garage')->find($garage_id);

        //TODO:系统通用配置项

        //系统故障开关
        $web_state = M('config')->where(array('name'=>'problem_state'))->find();

        //网站根目录
        $web_domain = M('config')->where(array('name'=>'web_domain'))->find();

        //通知开门系统的状态
        $notice_api =M('config')->where(array('name'=>'notice_api'))->find();

        //调试金额开启状态
        $test_pay = M('config')->where(array('name'=>'test_pay'))->find();
        $test_money = M('config')->where(array('name'=>'test_money'))->find();

        //审核指定组成员
        $push_group = M('config')->where(array('name'=>'push_group'))->find();

        $return =array(
            'web_state'=>$web_state['value'],
            'notice_api'=>$notice_api['value'],
            'test_pay'=>$test_pay['value'],
            'test_money'=>$test_money['value'],
            'web_domain'=>$web_domain['value'],
            'push_group'=>$push_group['value'],
            'garage_unit_price'=>$garageInfo['garage_unit_price'],
            'garage_max_price'=>$garageInfo['garage_max_price'],
            'garage_max_time'=>$garageInfo['garage_max_time'],
            'garage_free_time'=>$garageInfo['garage_free_time'],
            'garage_name'=>$garageInfo['garage_name'],
            'monthly_fee_fixed'=>$garageInfo['monthly_fee_fixed'],
            'monthly_fee_non_fixed'=>$garageInfo['monthly_fee_non_fixed'],
        );

        return $return;

    }

}

