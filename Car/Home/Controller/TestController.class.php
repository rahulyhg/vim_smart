<?php

namespace Home\Controller;
use Org\JieShunApi\Jieshun;
//测试类，仅供测试接口使用，上线后请删除类文件
class TestController extends Jieshun{

    public function query_by_car_no(){
        $car_no='鄂-AKA737';
        session('garage_no','0000002265');
        //调用第三方接口
        dump(json_decode($this->use_api_is_in($car_no),true));
        dump($car_no);
        dump(strtotime('2016-09-02 08:56:40'));
    }

    public function make_api_order(){
        $car_no='鄂-A8SZ01';

        //调用第三方接口
        $res = $this->api_make_order($car_no);
        print_r($res);
        //dump('okok');
    }


    //查询订单状态
    public function query_order_status_test()
    {
        $order='BK4871774586906587988';
        dump($this->query_order_status($order));
    }

    public function notice_api(){
        $order_no = 'BK5441705860318009096';
        dump($this->notice_api_pay_ok($order_no));
    }

    public function tset_yuka_car(){
        $car_no='鄂-A8SZ01';
        dump(json_decode($this->use_api_yueka_info($car_no),true));
    }

    //月卡车辆时间新增

    public function add_yueka(){
        //实例化捷顺接口
        $jieshun=new \Org\JieShunApi\Jieshun();
        $can_no="鄂-APS693";
        $month=0;
        $money=0.00;
        $newBeginDate="2017-02-10";
        $newEndDate="2018-02-23";
        $result=$jieshun->yueka_add_time($can_no,$month,$money,$newBeginDate,$newEndDate);
        dump($result);
    }

    public function test_car_time(){
        $car_no = '鄂-A511A1';
        $res = $this->car_enter_time($car_no);
        dump($res);
    }


    /*
      * 封装方法，处理警报流程一，入表
      * 警报反馈机制
      * */
    public function warning_data_add(){
        //dump(S('wechat_access_tokenwx49b9dbe4f861f4f8'));
        $action = 'warning_data_add';
        $control = 'Test';
        $encode = '2001';
        $result = '测试推送';
        $warning_name = '测试异常';
        //根据act和con来获得系统名称
        $system_array = M()->table('pigcms_system_control')->where(array('system_act'=>$action,'system_con'=>$control))->find();
        $data = array(
            'system_id'=>$system_array['pigcms_id'],
            'warning_encoding'=>$encode,
            'warning_result'=>$result,
            'warning_name'=>$warning_name,
            'create_time'=>time()
        );
        $result_code = M()->table('pigcms_system_warning_control')->data($data)->add();
        $admin_user = explode(",",$system_array['user_wx_opid']);
        $warn_info = array(
            'first_value'=>$system_array['system_name'].'发生错误！！！',
            'keyword1_value'=>$warning_name,
            'keyword2_value'=>'用户将无法使用该系统的功能',
            'remark_value'=>'(错误编码：'.$encode.')请开发者和错误处理人员尽快查看出错位置以便解决！'
        );
        if($result_code){
            //发送消息
            $res =array();
            foreach ($admin_user as $value){//
                $time = time();
                $data=array(
                    'touser'=>$value,
                    'template_id'=>"31Q6rbAa0NQdVuFMH6oyYwdSdOEwQ7aYQuM1d5fXQEk",
                    'data'=>array(
                        'first'=>array(
                            'value'=>urlencode($warn_info['first_value']),
                            'color'=>"#029700",
                        ),
                        'keyword1'=>array(
                            'value'=>urlencode($warn_info['keyword1_value']),
                            'color'=>"#000000",
                        ),
                        'keyword2'=>array(
                            'value'=>urlencode($warn_info['keyword2_value']),
                            'color'=>"#000000",
                        ),
                        'keyword3'=>array(
                            'value'=>urlencode(date('Y-m-d H:i:s',$time)),
                            'color'=>"#000000",
                        ),
                        'remark'=>array(
                            'value'=>urlencode($warn_info['remark_value']),
                            'color'=>"#000000",
                        ),
                    )
                );
                $weixin=new \Org\Weixinpay\Weixinpay();
                $res[] = $weixin->send_template_message(urldecode(json_encode($data)));
            }
            dump($res);
        }else{
            //入库失败
            return false;
        }
    }

    public function testS(){
        dump(S('data'));
        $dir = scandir(getcwd());
        dump($dir);
    }

}