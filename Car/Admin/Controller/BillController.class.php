<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/20
 * Time: 16:15
 */

namespace Admin\Controller;

use Common\Model\ParkBillModel;
use Common\Model\YuekaBillModel;

class BillController extends BaseController{
    public function test(){
        $model = new \Common\Model\ParkBillModel();
        $re = $model->get_kf_openids();
        dump($re);
    }


    //管理员审核申请，准备工作
    public function audit($bill_id,$bill_status){
        $model = new \Common\Model\ParkBillModel();
        if($bill_status==2) $this->error("该发票已核销！");

        $new_bill_status = $model->audit($bill_id,$bill_status);
        if($new_bill_status){
            $model->send_msg_to_user($bill_id);
            $this->success("操作成功");

        }else{
            $this->error("操作失败");
        }

    }

    //管理员端发票列表
    public function bill_list(){
        C('LAYOUT_ON',true);
        $park_model = new ParkBillModel();
        $yueka_model = new YuekaBillModel();
        $park_list = $park_model->audit_bill_list();
        $yueka_list = $yueka_model->audit_bill_list();
        //合计数据
        $bill_ids = array_unique(
            array_merge(
                array_keys($park_list)?:[],
                array_keys($yueka_list)?:[]
            )
        );

        $list = array();
        foreach($bill_ids as $id){
            $park_info = $park_list[$id];
            $yueka_info = $yueka_list[$id];
            $list[] = $this->merage_info($park_info,$yueka_info);
        }

        $this->assign('list',$list);
        $this->display();
    }


    public function merage_info($park_info,$yueka_info){
        $info = $park_info?:$yueka_info;
        //消费记录合并
        $info['pay_list'] = array_merge(
            $park_info['pay_list']?:[],
            $yueka_info['pay_list']?:[]
        );
        //消费总额合计
        $info['loan_sum'] =  ($park_info['loan_sum']?:0) +($yueka_info['loan_sum']?:0);
        //消费记录数合计
        $info['count_pay_list'] =  ($park_info['count_pay_list']?:0) +($yueka_info['count_pay_list']?:0);
        //车牌统计
        $info['car_no_list'] = array_unique(
            array_merge(
                $park_info['car_no_list']?:[],
                $yueka_info['car_no_list']?:[]
            )
        );
        //支付时间区间统计
        $info['max_time'] = max($park_info['max_time'],$yueka_info['max_time']);
        $info['min_time'] = min($park_info['min_time'],$yueka_info['min_time']);
        return $info;
    }



    //发票详情页
    public function bill_detail($bill_id){
        C('LAYOUT_ON',true);
        $park_model = new ParkBillModel();
        $yueka_model = new YuekaBillModel();
        $park_info = $park_model->get_bill_detail($bill_id);
        $yueka_info = $yueka_model->get_bill_detail($bill_id);
        $bill_detail =  $this->merage_info($park_info,$yueka_info);
        $this->assign('bill_detail',$bill_detail);
        $this->display();
    }



}