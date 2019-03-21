<?php

namespace Admin\Model;

use Think\Model;

class CarModel extends Model{
    
    //自动完成方法，系tp系统函数
    protected $_auto=array(
        array('add_time','time',1,'function'), //添加新记录时会触发此自动完成
        array('upd_time','time',2,'function'), //更新数据时才会触发此自动完成
    );

    //查询所有用户信息
    public function query_users_info($car_infos){
        $user_ids='';
        foreach($car_infos as $v){
            $user_ids.=',\''.$v['user_id'].'\'';
        }

        //查询所有用户id和用户名
        $db_name=C('DB_PREFIX')."user";
        return M()->query("select user_id,user_name from ".$db_name." where user_id in (".ltrim($user_ids,',').") order by user_id desc");
    }


    //2017.1.19 祝君伟 查询当前车辆绑定的车与车主信息
    public function query_car_user_info($car_id){
        //根据car_id 进行查询
        $car_info_array =  M()->query("select c.*,u.user_wxnik,u.user_phone,u.user_addr,u.user_level,u.score_count from ".C('DB_PREFIX')."car as c join ".C('DB_PREFIX')."user as u on c.user_id=u.user_id where c.car_id = $car_id and c.is_del='0' order by c.add_time desc limit 1");
        return $car_info_array;
    }

    //2017.1.19 祝君伟 查询当前车辆绑定的车的消费情况
    public function query_car_pay($car_id){
        //根据car_id 进行查询
        $car_pay_info = M()->query("select p.*,c.car_no,c.car_role,u.user_wxnik from ".C('DB_PREFIX')."payrecord as p join ".C('DB_PREFIX')."car as c on p.user_id=c.user_id join ".C('DB_PREFIX')."user as u on p.user_id=u.user_id where c.car_id = $car_id order by p.create_time desc");
        return $car_pay_info;
    }


}

