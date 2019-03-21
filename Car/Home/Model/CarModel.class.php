<?php

namespace Home\Model;
use Think\Model;


class CarModel extends Model{

    //自动完成(必须有create收集功能，否则自定操作无法完成)
    protected $_auto=array(
        array('add_time','time',1,'function'),
    );


    //解除用户与车牌的绑定关系(即删除对应车辆信息)
    public function spell_binding_m($user_id,$car_no,$garage_id){
        if($this->where(array('user_id'=>$user_id,'car_no'=>$car_no,'garage_id'=>$garage_id))->delete()){
            return true;
        }else{
            return false;
        }

    }


    //通过用户id查询其名下的所有车辆，并将车牌返回
    public function query_carno_by_uid($user_id){
        return $this->where(array('user_id'=>$user_id))->getField('car_no',true);
    }

    /**
     * 通过用户id查询其名下的所有车辆，并将车牌返回
     * @param $user_id
     * @return array
     * @update-time: 2017-03-27 16:12:51
     * @author: 王亚雄
     */
    public function get_cars($user_id){
        $cars = $this->field('car_id,car_no')->where('user_id=%d',$user_id)->select();
        $tmp = array();
        foreach($cars as $key=>$row){
            $tmp[$row['car_id']] = $row['car_no'];
        }
        return $tmp;
    }


    /*
     * 用户进入以后查询当前的用户是否绑定车辆，如果没绑定就选择停车场
     * author 祝君伟
     * time 2017-6-1
     * */
    public function check_user_bind_car($user_id){
        $is_bind = M('car')->where(array('user_id'=>$user_id))->find();
        if($is_bind){
            //并没有查到
            return true;
        }else{
            return false;
        }
    }

}