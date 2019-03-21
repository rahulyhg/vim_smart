<?php
/**
 * Car 系统 移植到020系统下面
 * User: 祝君伟
 * Date: 2017/6/8
 * Time: 13:46
 */
class CarAction extends BaseAction{

    /*
     * 停车用户信息
     * */
    public function car_user_info_news(){
        //实例化逻辑层
        $carLogic = D('Car','Logic');
        //非超级管理员传递过滤条件
        if($_SESSION['system']['account']!=SUPER_ADMIN){
            $user_info_list = $carLogic->get_user_list(array('g.village_id'=>$_SESSION['system']['village_id']));
        }else{
            $user_info_list = $carLogic->get_user_list();
        }

        $this->assign('user_info_list',$user_info_list);
        $this->display();

    }


    /*
     * 停车缴费记录
     * */
    public function car_pay_record_news(){
        //实例化逻辑层
        $carLogic = D('Car','Logic');
        //非超级管理员传递过滤条件
        if($_SESSION['system']['account']!=SUPER_ADMIN){
            $car_pay_record_list = $carLogic->get_car_pay_tp_page(2);
        }else{
            $car_pay_record_list = $carLogic->get_car_pay_tp_page(1);
        }
        $this->assign('car_pay_record_list',$car_pay_record_list);
        $this->display();

    }


    /*
     * 月卡管理信息列表
     * */
    public function car_yueka_list_news(){
        //实例化逻辑层
        $carLogic = D('Car','Logic');
        //非超级管理员传递过滤条件
        if($_SESSION['system']['account']!=SUPER_ADMIN){
            $yueka_list = $carLogic->get_yueka_car_list(array('g.village_id'=>$_SESSION['system']['village_id']));
        }else{
            $yueka_list = $carLogic->get_yueka_car_list();
        }

        $this->assign('yueka_list',$yueka_list);
        $this->display();
    }
}