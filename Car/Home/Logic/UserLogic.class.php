<?php
namespace Home\Logic;
use \Think\Model;
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/5/24
 * Time: 16:41
 * 用户中心逻辑层
 */
class UserLogic extends Model{

    //验证传入的user_id 是否和admin表中的任意id相同
    public function check_and_save($user_id){
        $admin_array = user_info($user_id);
        if(empty($admin_array['ad_id'])){
            session('ad_id',$admin_array['ad_id']);
        }
    }
    

}