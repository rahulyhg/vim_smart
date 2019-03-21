<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/8
 * Time: 16:44
 */
//设置面包屑导航
//        $breadcrumb_diy = array(
//            array('消息发布','#'),
//            array('群发消息列表','#'),
//        );
//        $this->assign('breadcrumb_diy',$breadcrumb_diy);
class GroupMsgAction extends BaseAction
{

    public function __construct()
    {
        parent::__construct();
        $this->village_id = $_SESSION['system']['village_id'];
    }
    public function dump_log(){
        //md('start');
        $list = M('dump_log')->order('id desc')->select();
        foreach($list as &$row){
            $row['content'] = json_decode($row['content'],true);

        }
        unset($row);
        $this->assign('list',$list);
        $this->display();
    }

    public function stop_send($ctr_name){
        $model = new WechatModel();
        if(!$ctr_name) {
            echo "请输入ctr_name";
            exit();
        }
        $re = $model->ctr_off($ctr_name);
        if($re){
            echo '暂停成功';
        }else{
            if($re===0) echo "不存在的";
            if($re===false) echo "发生错误";
        }
    }

    public function continue_send(){
        $ctr_name = "测试1_201803021012";
        $model = new GroupMsgModel();
        $model->continue_send_msg($ctr_name);
    }



    public function lists_news(){
        $breadcrumb_diy = array(
            array('消息发布','#'),
            array('群发消息列表','#'),
        );
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $model = new GroupMsgModel();
        $list = $model->get_msg_list();
        $is_wxmsg=$model->is_wxmsg('',$this->village_id);
        //echo M()->getLastSql();
        $this->assign('village_id',$this->village_id);
        $this->assign('list',$list);
        $this->assign('is_wxmsg',$is_wxmsg);
        $this->display('lists');
    }

    public function modal_msg_info($msg_id){
        $model = new GroupMsgModel();
        $msg_info = $model->get_msg_info($msg_id);
        $msg_info['rusers_num'] = $model->get_rusers_num($msg_info['village_id'],$msg_info['company_id']);
        $visitor_model = new Visitor_logModel();
        $visitor_data = $visitor_model->get_vistor_users('/wap.php/Wap/House/view_msg',array('msg_id'=>$msg_id));
        $this->assign('visitor_data',$visitor_data);
        $this->assign('info',$msg_info);
        $this->display();
    }


    //添加\编辑群发消息表单
    public function save_group_msg($msg_id=0){
        $breadcrumb_diy = array(
            array('消息发布','#'),
            array('群发消息列表',U('lists_news')),
            array($msg_id?"编辑消息":'添加消息','#'),
        );
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $model = new GroupMsgModel();
        if($msg_id){
            $msg_info = $model->get_msg_info($msg_id);
            if(!$msg_info){
                $this->error("该消息已被删除");
            }
            $this->assign("msg_info",$msg_info);
            $this->assign_json('msg_info',$msg_info);
        }
        $is_wxmsg=$model->is_wxmsg('',$this->village_id);
        $this->assign_json('village_list',$model->get_village_list());
        $this->assign_json('company_list',$model->get_company_list());
        $this->assign('is_wxmsg',$is_wxmsg);
        $this->display();
    }

    //保存/添加消息执行
    public function save_group_msg_act(){
        $data = $_POST;
        $data['send_time']=strtotime($data['send_time']);
        $model = new GroupMsgModel();

        $re = $model->save_group_msg($data);//新增数据
        //dump($re);die;
        if($re!==false){
            $model->send_to_audit($re);
            $this->success("成功");
        }else{
            $this->error($model->getError());
        }
    }

    //审核消息
    public function ajax_audit_msg($msg_id,$to_status){
        $model = new GroupMsgModel();
        $re = $model->audit_act($msg_id,$to_status);
        if($re){
            switch ($to_status) {
                case $model::MSG_STATUS_SEND://审核通过发送消息
                    $model->auto_send_msg($msg_id);
                    break;
                case $model::MSG_STATUS_RETURNED://退回修改发送消息消息编辑者
                    $model->send_to_publish($msg_id);
                    break;
                default:
                    break;
            }

            $this->success("操作成功");
        }else{
            $this->error($model->getErrMsg());
        }

    }

    /**
     * @author zhukeqin
     * ajax改变群发开关状态
     * @return bool
     */
    public function ajax_change_wxmsg(){
        $village_id=I('post.village_id');
        if($village_id==0){
            dump(false);
        }
        $model = new GroupMsgModel();
        $re = $model->change_wxmsg($village_id);
        //echo M()->getLastSql();
        echo $re;

    }



    /**
     * 兼容ajax的success和error方法
     * @param string $message
     * @param string $jumpUrl
     * @param bool|mixed $data
     */
    protected function success($message='',$jumpUrl='',$data){
        if(IS_AJAX==1){

            $this->ajaxReturn(array('err'=>0,'msg'=>$message,'data'=>$data));

        }else{

            parent::success($message,$jumpUrl,false);

        }
    }

    protected function error($message='',$jumpUrl='',$data){
        if(IS_AJAX==1){

            $this->ajaxReturn(array('err'=>__LINE__,'msg'=>$message,'data'=>$data));

        }else{

            parent::error($message,$jumpUrl,false);

        }
    }
    /**
     * 传递json数组到模板 通过app_json.name获取
     * @param $name
     * @param array $val
     */
    public function assign_json($name,$val=array()){
        static $is_init = false;
        $name = "app_json.".$name;
        $val = json_encode($val)?:"{}";
        $json_str =  '<script>'.$name.' = '.$val.';</script>';
        if(!$is_init){//第一此传入的时候需要初始化
            $init = '<script>var app_json ={};</script>';
            $json_str = $init . $json_str;
            $is_init = true;
        }
        print_r($json_str);
    }

    /**
     * 前端配置
     * @param $option
     * @param $val
     * @return bool 设置成功 返回 true
     */
    protected function html_option($option,$val){
        static $options = array(
            'table_init_length'=>'15', //默认列表初始长度
            'table_sort'=>'[1,"desc"]' //默认排序
        );

        if( key_exists($option,$options)){
            if($option=="table_sort") $val = json_encode($val);
            $options[$option] = $val;
            $this->assign($options);
            return true;
        }else{
            return false;
        }
    }



}