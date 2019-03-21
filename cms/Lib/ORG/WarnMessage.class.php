<?php
/*系统警报后执行类
 * @author 祝君伟
 * @time 2017.3.27
 * */
class WarnMessage
{
    public $action;
    public $control;
    public $encode;
    public $result;
    public $warning_name;

    /*
     * 构造方法
     * */
    public function __construct($action,$control,$encode,$result,$warning_name)
    {
            $this->action = $action;
            $this->control = $control;
            $this->encode = $encode;
            $this->result = $result;
            $this->warning_name = $warning_name;
    }


    /*
     * 制作插入数据库的数组，并且插入数据库(传统PDO 模式)
     * */
    public function get_data_pdo(){
        //根据现在的act和con来查询对应的系统的id
        //$system_array = M()->table('pigcms_system_control')->where(array('system_act'=>$this->action,'system_con'=>$this->control))->find();
        $config_array = array(
            'db_host'=>'rds66568gp739413snzpo.mysql.rds.aliyuncs.com',
            'db_name'=>'vhi_smart',
            'db_username'=>'vhi_smart',
            'db_password'=>'Vhi_smart123',
            'db_charset'=>'utf8',
            'db_table'=>'pigcms_system_warning_control'
        );
        $pdo = $pdo = new PdoDb($config_array);
        $sql = 'select * from pigcms_system_control WHERE system_act="'.$this->action.'" and system_con="'.$this->control.'" limit 1';
        $system_array = $pdo->query($sql);
        $data = array(
            'system_id'=>$system_array[0]['pigcms_id'],
            'warning_encoding'=>$this->encode,
            'warning_result'=>$this->result,
            'warning_name'=>$this->warning_name,
            'create_time'=>time()
        );
        //$result_code = M()->table('pigcms_system_warning_control')->data($data)->add();
        $result_code = $pdo->insert($data);
        //dump($result_code);exit;
        $admin_user = explode(",",$system_array[0]['user_wx_opid']);
        $warn_info = array(
            'first_value'=>$system_array[0]['system_name'].'发生异常！！！',
            'keyword1_value'=>$this->warning_name,
            'keyword2_value'=>'用户将无法使用该系统的功能',
            'remark_value'=>'(错误编码：'.$this->encode.')请开发者和错误处理人员尽快查看出错位置以便解决！'
        );
        /*if($result_code){
            //发送消息
            $send_result = $this->send_message_old($admin_user,$warn_info);
            return $send_result;
        }else{
            //入库失败
            return false;
        }*/
    }


    /*
     * 制作插入数据库的数组，并且插入数据库(tp 模式)
     * */
    public function get_data_tp(){
        //根据现在的act和con来查询对应的系统的id
        $system_array = M()->table('pigcms_system_control')->where(array('system_act'=>$this->action,'system_con'=>$this->control))->find();
        $data = array(
            'system_id'=>$system_array['pigcms_id'],
            'warning_encoding'=>$this->encode,
            'warning_result'=>$this->result,
            'warning_name'=>$this->warning_name,
            'create_time'=>time()
        );
        $result_code = M()->table('pigcms_system_warning_control')->data($data)->add();
        $admin_user = explode(",",$system_array['user_wx_opid']);
        $warn_info = array(
            'first_value'=>$system_array['system_name'].'发生异常！！！',
            'keyword1_value'=>$this->warning_name,
            'keyword2_value'=>'用户将无法使用该系统的功能',
            'remark_value'=>'(错误编码：'.$this->encode.')请开发者和错误处理人员尽快查看出错位置以便解决！'
        );
        /*if($result_code){
            //发送消息
            $send_result = $this->send_message_old($admin_user,$warn_info);
            return $send_result;
        }else{
            //入库失败
            return false;
        }*/
    }



    /*
     * 向相关人员发送推送消息(适用于020系统)
     * */
    protected function send_message_old($admin_user,$warn_info){
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
            import('@.ORG.pay.Weixin');
            $weixin=new Weixin();
            $res[] = $weixin->send_template_message(urldecode(json_encode($data)));
        }
        if($res[0]['errmsg']=='ok'){
            return true;
        }else{
            return false;
        }

    }


}