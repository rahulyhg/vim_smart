<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/20
 * Time: 16:15
 */

namespace Home\Controller;
use Common\Model\ExpressModel;
use Common\Model\ParkBillModel;
use Common\Model\YuekaBillModel;

class BillController extends BaseController{
    public function test(){
        $model = new YuekaBillModel();
        $list = $model->get_kf_openids();
        if(session('openid'))
        dump($_SESSION);
        dump($list);
    }


    public function __construct()
    {

        parent::__construct();
        //session('user_id',325);
        if(!session('garage_id')){
            redirect(U('Car/choose_garage'));
        }

//        if(session('user_id')==424){
//            session('user_id',1183);
//        }else{
//            echo '系统升级中...';
//        }
    }


    public function assign_json($name,$val=array()){
        static $is_init = false;
        $name = "app_json.".$name;

        if(is_array($val)){
            $val = json_encode($val)?:"{}";
        }

        $json_str =  '<script>'.$name.' = '.$val.';</script>';
        if(!$is_init){//第一此传入的时候需要初始化
            $init = '<script>var app_json ={};</script>';
            $json_str = $init . $json_str;
            $is_init = true;
        }
        print_r($json_str);
    }


    public function _before_record(){

        $uid = session('user_id');

        $userInfo = M('user')->where(array('user_id'=>$uid))->find();

        if(!$userInfo['user_t_name']||!$userInfo['user_phone']){

            cookie('callBack_url',U('Bill/record'));

            $this->redirect('user/register');
        }

    }
    /**
     * 发票领取
     * @update-time: 2017-04-13 13:59:45
     * @author: 王亚雄
     */
    public function record(){
        //dump(session());
        //session(null);
        $this->assign('title',"发票申请");
        $t_3m=strtotime('-3 month');
        $park_model = new ParkBillModel();
        $park_list = $park_model->get_user_record();
        //echo M()->getLastSql();exit();
        $yueka_model = new YuekaBillModel();
        $yueka_list = $yueka_model->get_user_record();
        $list = array_merge($park_list,$yueka_list);

        $this->assign_json('t_3m',$t_3m);
        $this->assign_json('list',$list);
        $this->assign_json('bill_status_desc_list',$park_model->bill_status_desc());
        $this->display();
    }




    //用户申领发票
    public function apply_bill(){
        $this->assign('title',"发票申请");
        //消费记录ID
        $pay_ids = json_decode(htmlspecialchars_decode(file_get_contents('php://input')),true);
        //创建发票
        $park_model = new ParkBillModel();
        $yueka_model = new YuekaBillModel();
        $park_model->startTrans();
        $bill_id = $park_model->create_bill($pay_ids['park']);
        $bill_id = $yueka_model->create_bill($pay_ids['yueka']);

        //$park_model->rollback();
        if($bill_id){
            $park_model->commit();
            $res1 = $park_model->send_msg_to_kf($bill_id);
            //向用户发送消息
            $res2 = $park_model->send_msg_to_user($bill_id);

            $this->success("成功");

        }else{
            $park_model->rollback();
            $this->error("发生错误,".mysql_error(),"",array(mysql_error()));

        }

    }



    //用户选择邮寄方式申领发票
    public function apply_bill_express(){
        $address_id = I('post.address_id');
        //消费记录ID
        $pay_ids = json_decode(htmlspecialchars_decode(cookie('pay_ids')),true);
        //pay_ids cookie 过期
        if(!count($pay_ids)){
            $this->error("操作超时",U('record'));
        }
        $park_model = new ParkBillModel();
        $yueka_model = new YuekaBillModel();
        $park_model->startTrans();
        $express_id = $park_model->insert_into_express_order($address_id);
        $bill_id = $park_model->create_bill($pay_ids['park'],$express_id);
        $bill_id = $yueka_model->create_bill($pay_ids['yueka'],$express_id);

        //$park_model->rollback();
        if($bill_id&&$express_id){
            $re = $this->create_bill_three($bill_id);
            $park_model->commit();
            $res1 = $park_model->send_msg_to_kf($bill_id);
            //向用户发送消息
            $res2 = $park_model->send_msg_to_user($bill_id);
            cookie('pay_ids',null);//销毁 避免重复提交
            $this->redirect(U('apply_success',array('receive_type'=>'express')));

        }else{
            $park_model->rollback();
            $this->error("发生错误,".mysql_error(),"",array(mysql_error()));

        }

    }

    public function create_bill_three($bill_id) {
        $userinfo = user_info();
        $cr_data = array();
        $cr_data['garage_id'] = $_SESSION['garage_id'];
        $cr_data['admin_id'] = $_SESSION['user_id'];
        $cr_data['check_title'] = '发票申领';
        $cr_data['bill_id'] = $bill_id;
        $cr_data['check_type'] = 2;
        $cr_data['check_state'] = 1;
        $cr_data['check_request_time'] = time();
        $cr_data['user_t_name'] = $userinfo['user_t_name'];
        $re = D('check_record')->add($cr_data);
    }


    /**
     * 申请成功跳转模板
     */
    public function apply_success($receive_type="express"){
        $model = new \Common\Model\ParkBillModel();
        $this->assign(array(
            'message'=>$model->bill_status_desc($model::BILL_STATUS_DLQ,$receive_type)[3],
            'jumpUrl'=>U('bill_list'),
        ));
        $this->display('apply_success');
    }


    /**
     * 发票邮寄信息设置
     */
    public function express_order(){

        $express_model = new ExpressModel();
        $user_id = session('user_id');;
        $address_list = $express_model->get_user_address($user_id);
        if(!$address_list){
            //若没有录入过地址，跳转到添加地址页
            $this->redirect(U('add_address'));
        }
        //默认地址
        $default_address_id = current($address_list)['adress_id'];
        $this->assign_json('address_list',$address_list);
        $this->assign_json('default_address_id',$default_address_id);
        $this->display();
    }

    /**
     * 添加地址
     */
    public function add_address(){

        if(IS_POST){
            $express_model = new ExpressModel();
            $data = array(
                'uid'=>0,
                'name'=>I('post.name'),
                'phone'=>I('post.phone'),
                'province'=>'',
                'city'=>'',
                'area'=>'',
                'adress'=>'',
                'zipcode'=>'',
                'detail'=>I('post.detail'),
                'village_id'=>'',
                'type'=>'',
                'position'=>I('post.position'),
                'smart_user_id'=>session('user_id'),
                'sort'=>0
            );
            $address_id = $express_model->add_address($data);
            $re = $express_model->set_default_address(session('user_id'),$address_id);
            if($re!==false){
                $this->redirect(U('express_order'));
            }else{
                $this->error("发生错误".mysql_error());
            }

        }
        $this->display();
    }

    //用户端发票列表
    public function bill_list(){
        $this->assign('title',"发票申请");
        $park_model = new ParkBillModel();
        $yueka_model = new YuekaBillModel();
        $park_list = $park_model->get_user_bill_list();
        $yueka_list = $yueka_model->get_user_bill_list();
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
//        dump($list);exit;
        $this->assign_json('list',$list);
        $this->assign_json('is_audit',0);
        $this->assign('header','发票');
        $this->display();
    }

    //用户端发票列表
//    public function bill_list_yuka(){
//        $bill_id = $_GET['bill_id'];
//        $this->assign('title',"发票申请");
//        $yueka_model = new YuekaBillModel();
//        $yueka_list = $yueka_model->get_user_bill_list_two($bill_id);
//        //合计数据
//        $bill_ids = array_unique(
//            array_merge(
//                array_keys($yueka_list)?:[]
//            )
//        );
//
//        $list = array();
//        foreach($bill_ids as $id){
//            $yueka_info = $yueka_list[$id];
//            $list[] = $yueka_info;
//        }
//        dump($list);exit;
//        $this->assign_json('list',$list);
//        $this->assign_json('is_audit',0);
//        $this->assign('header','发票');
//        $this->display();
//    }



    //发票审核列表
    public function audit_bill_list(){
        $this->assign('title',"发票审核");
        $park_model = new ParkBillModel();
        $yueka_model = new YuekaBillModel();

        if(!$park_model->can_audit()){
            $this->error("你没有权限");
        }

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
        $this->assign_json('list',$list);
        $this->assign_json('is_audit',1);
        $this->assign('header','发票审核');
        $this->display('bill_list');
    }

    //管理员审核
    public function audit()
    {

        $this->assign('title',"发票审核");
        $data = json_decode(htmlspecialchars_decode(file_get_contents('php://input')), true);
        $model = new \Common\Model\BillModel();
        if(!$model->can_audit()){
            $this->error("你没有权限");
        }
        if($current_bill_status = $model->audit($data['bill_id'],$data['bill_status'])){
            $desc = $model->bill_status_desc($current_bill_status);
            $model->send_msg_to_user($data['bill_id']);
            $new_bill_info = $model->get_bill_detail($data['bill_id']);
            $this->success($desc[0], '', $new_bill_info);
        }else{
            $this->error("发生错误");
        }


    }

    //合并多种发票的数据
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





}