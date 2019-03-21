<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/14
 * Time: 16:34
 * @update-time: 2017-08-14 17:09:04
 * @author: 王亚雄
 * 抄表控制器
 */
class ReSetmeterAction extends BaseAction{

    public function __construct()
    {
        parent::__construct();
        $this->check_admin();

    }

    /**
     * 权限控制
     */
    protected function check_admin(){
        $allow_role = array('39','37','15','19');
        $role_id = user_info()['role_id'];
        //echo mysql_error();
        if(!in_array($role_id,$allow_role)){
            $this->error("你没有权限");
            exit();
        };

    }

    /**
     * 扫码抄表页面
     * @param $usernum
     * @param $sign
     */
    public function index($usernum,$sign,$tid){
        //获取设备信息
        $model = new ReSetmeterModel();
        $rinfo = $model->get_device_option($usernum,$sign,$tid);
        $last_month = date('Y-m',strtotime('-1 month'));//上个月日期
        $current_month = date('Y-m');//这个月日期
        $last_month_info = $model->get_month_info($usernum,$sign,$tid,$last_month);//上个月的数据
        $current_month_info = $model->get_month_info($usernum,$sign,$tid,$current_month);//这个月的数据
        //dump($current_month_info);exit();
        $this->assign('rinfo',$rinfo);
        $this->assign('current_month_total',$current_month_info['total_consume']?:"");
        $this->assign('last_month_total',$last_month_info['total_consume']?:0);

        $this->display();
    }


    /**
     * 添加数据
     */
    public function add_data(){
        $usernum = I('post.usernum');
        $consume = I('post.consume');
        $total_consume = I('post.total_consume');
        $tid = I('post.tid');
        $sign = I('post.sign');
        $tdesc = I('post.tdesc');
        if(!$consume) $this->error("请检查数据是否输入正确");

        //获取设备信息
        $model = new ReSetmeterModel();
        $device_option= $model->get_device_option($usernum,$sign,$tid);
        //数据组装
        $data = array(
            'village_id'=>$model->get_village_id($usernum),
            'device_name'=>$device_option['sign'],
            'device_des'=>$device_option['pdesc'].'-'.$device_option['desc'],
            'usernum'=>$usernum,
            'admin_id'=>user_info()['admin_id'],
            'consume'=>$consume,
            'total_consume'=>$total_consume,
            'unit'=>$device_option['unit'],
            'unit_price'=>$device_option['unit_price'],
            'create_time'=>time(),
            'tid'=>$tid,
            'tdesc'=>$tdesc
        );
        $num = M('re_setmeter','pigcms_')->add($data);
        if($num){
            $this->success("添加成功");
        }else{
            $this->error("失败" . mysql_error());
        }
    }

    public function ajax_get_month_info($usernum="",$sign="",$tid,$month=""){
        $date = date("Y") .'-' . $month;
        $model = new ReSetmeterModel();
        $info = $model->get_month_info($usernum,$sign,$tid,$date);
        if($info){
            $this->ajaxReturn(array('err'=>0,'msg'=>"正确",'data'=>$info));
        }else{
            $this->ajaxReturn(array('err'=>1,'msg'=>"发生错误",'data'=>mysql_error()));
        }

    }

    /**
     * 设置硬件码
     * @param $device_code 硬件码
     * @param $tid 楼层表主键
     * @param $sign 水电表类型标记
     * @update-time: 2017-08-23 15:49:37
     * @author: 王亚雄
     */
    public function edit_device_code($device_code,$tid,$sign){
        $model = new ReSetmeterModel();
        $re = $model->save_device_code($device_code,$tid,$sign);
        if($re!==false){
            $this->ajaxReturn(array('err'=>0,'msg'=>'成功','data'=>null));
        }else{
            $this->ajaxReturn(array('err'=>1,'msg'=>'失败','data'=>null));
        }
    }




}