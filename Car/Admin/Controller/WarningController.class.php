<?php

namespace Admin\Controller;
//use Think\Controller;
use Admin\Common\RbacController;
class WarningController extends RbacController
{

    /*
     * 显示功能页
     * */
    public function index(){
        $wait_time = M()->table('smart_config')->where(array('name'=>'wait_time'))->find();
        $warning_start = M()->table('smart_config')->where(array('name'=>'warning_start'))->find();
        $warning_end = M()->table('smart_config')->where(array('name'=>'warning_end'))->find();
        $this->assign('wait_time',$wait_time);
        $this->assign('warning_start',$warning_start);
        $this->assign('warning_end',$warning_end);
        $this->display();
    }
    /*
     * 汽车系统异常报警
     * 短时间无人用
     * */
    public function nobady_use(){
        $wait_time = I('post.wait_time');
        $start_time = I('post.start_time');
        $end_time = I('post.end_time');

        M()->table('smart_config')->where(array('name'=>'wait_time'))->data(array('value'=>$wait_time))->save();
        M()->table('smart_config')->where(array('name'=>'warning_start'))->data(array('value'=>$start_time))->save();
        M()->table('smart_config')->where(array('name'=>'warning_end'))->data(array('value'=>$end_time))->save();

        //工作日时间最近n小时内无人使用停车系统
        if( date('w',time())==0 ||  date('w',time())==6) {
            //周末内容
            $result = array('error'=>1,'msg'=>'今天周末，异常系统不启动');

        }else if(strtotime($start_time)<time()&&time()<strtotime($end_time)){

            //工作日内容
            $payrecord_count = M('payrecord')->where(array('pay_status'=>'1','pay_time'=>array('gt',time()-$wait_time*3600)))->count();
            //dump(M('')->_sql());exit;
            if($payrecord_count==0){
                //异常
                //$this->warning_data_add('index',CONTROLLER_NAME,'3001','设置时间内没有一笔订单','交易异常，检查是否程序有错误');
                $result =array('error'=>2,'msg'=>'交易异常提醒!');
            }else{
                $result =array('error'=>0,'msg'=>'正在监听，运转正常');
            }

        }else{
            $result =array('error'=>1,'msg'=>'设置时间已过，结束日程安排！');

        }
        echo json_encode($result);
    }

    /*
     * 封装方法，处理警报流程一，入表
     * 警报反馈机制
     * */
    protected function warning_data_add($action,$control,$encode,$result,$warning_name){
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
            'first_value'=>$system_array['system_name'].'发生异常！！！',
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
                    'template_id'=>"cGt5Hgs0G2X8-5Tnft_WEEvY__lKYDymlOX46p0pDbI",
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
            if($res[0]['errmsg']=='ok'){
                return true;
            }else{
                return false;
            }
        }else{
            //入库失败
            return false;
        }
    }
}

