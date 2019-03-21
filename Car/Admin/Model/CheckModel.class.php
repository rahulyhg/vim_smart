<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/20
 * Time: 16:51
 */

namespace Admin\Model;
use Think\Model;
use Think\Page;

class CheckModel extends Model
{
    //定义表名称
    protected $tableName = 'check_record';
    /*
     * 显示客服所有信息
     * */
    public function get_check_list($garage_id){
        $check_array = $this
            ->alias('c')
            ->join('JOIN smart_yueka_payrecord y on c.yukepay_id=y.pay_id LEFT JOIN smart_user u on c.admin_id=u.user_id')
            ->where(array('c.check_type'=>0,'c.is_del'=>0,'c.garage_id'=>$garage_id))
            ->field('c.*,y.car_no,y.how_long,y.pay_time,u.user_t_name')
            ->order('c.check_request_time desc')
            ->select();
        return $check_array;
    }

    /*
     * 电脑端核心方法：（分步骤为了日后通用性）
     * 步骤一：根据check_id来查询所有的为方法准备的信息
     *
     * */
    public function get_ready_info($check_id){
        $check_array = $this
            ->alias('c')
            ->join('JOIN smart_yueka_payrecord y on c.yukepay_id=y.pay_id JOIN smart_user u on c.check_user=u.user_t_name')
            ->where(array('c.check_id'=>$check_id))
            ->field('c.*,y.car_no,y.how_long,u.user_wx_opid')
            ->find();
        $admin_user_id = M('admin')->where(array('ad_id'=>$_SESSION['admin_id']))->find();
        $admin_user_id = explode(",",$admin_user_id['ad_uid']);
        $admin_user_name = M('user')->where(array('user_id'=>$admin_user_id[0]))->find();
        $ready_array = array(
            'car_no'=>$check_array['car_no'],
            'how_long'=>$check_array['how_long'],
            'user_wx_opid'=>$check_array['user_wx_opid'],
            'check_id'=>$check_id,
            'admin_id'=>$admin_user_name['user_id']
        );
        return $ready_array;
    }

    /*
     *电脑端核心方法：（分步骤为了日后通用性）
     * 步骤二：根据数组ready_array维护本地数据库
     * */
    public function update_location($ready_array){
        $start_time = time();
        $end_time = time()+$ready_array['how_long']*30*24*3600;
        $result_code = M('car')->where(array('car_no'=>$ready_array['car_no']))->data(array('car_role'=>'1','start_time'=>$start_time,'end_time'=>$end_time))->save();
        $check_code = M('check_record')->where(array('check_id'=>$ready_array['check_id']))->data(array('admin_id'=>$ready_array['admin_id'],'check_process_time'=>$start_time,'check_state'=>1))->save();
        if($result_code&&$check_code){
            return true;
        }else{
            return false;
        }
    }



}