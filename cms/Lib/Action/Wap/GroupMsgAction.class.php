<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/11
 * Time: 18:34
 */
class GroupMsgAction extends BaseAction
{
    //管理员审核页
    public function audit($msg_id){
        $model = new GroupMsgModel();
        $this->is_audit($msg_id);
        $msg_info = $model->get_msg_info($msg_id);
        $this->assign_json('msg_info',$msg_info);
        $admins=$model->getAuditRole($msg_id,$_SESSION['openid']);
        $roleid=explode(',',$admins['role_id']);
        $role = $model->role;
        if(in_array($role[0],$roleid)){
            $this->display();
        }else{
            $this->display('audit_new');
        }
    }
    
    //审核执行
    public function audit_act(){
        $data = $_POST;
        $msg_id = $data['msg_id'];
        $to_status = $data['status'];
        $model = new GroupMsgModel();
        $this->is_audit($msg_id);//获取发送状态 是否开启群发消息 是否是审核人员
        $re = $model->audit_act($msg_id,$data['status']); //判断消息是否发送或退回 设置审核人
        if($re){
            switch ($to_status) {
                case $model::MSG_STATUS_SEND://审核通过发送消息
                    $model->auto_send_msg($msg_id);//发送消息

                    $this->redirect(U('send_ROP',array('msg_id'=>$data['msg_id'])));
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
     * 推送给项目经理审核
     */
    public function audit_act_new()
    {
        $data = $_POST;
        $msg_id = $data['msg_id'];
        $to_status = $data['status'];
        $model = new GroupMsgModel();
        $this->is_audit($msg_id);//获取发送状态 是否开启群发消息 是否是审核人员
        switch ($to_status) {
            case $model::MSG_STATUS_SEND:
                //判断是否已经推送给项目经理
                $res = $model->audit_act_new($msg_id);
                if($res){
                    $model->send_to_audit_new($msg_id);
                    $this->success("已推送给项目经理审核");
                }else{
                    $this->error($model->getErrMsg());
                }
                break;
            case $model::MSG_STATUS_RETURNED://退回修改发送消息消息编辑者
                $model->send_to_publish($msg_id);
                $re1 = $model->set_msg_status($msg_id,$to_status);//修改消息状态
                $re2 = $model->set_audit_admin_id($msg_id,$model->admin_id);//设置审核人
                $re = $re1!==false && $re2!==false;
                if(!$re){
                    $this->setErrCode(1);
                    $this->setErrMsg("发生错误，审核失败!".mysql_error());
                }
                break;
            default:
                break;
        }
        $this->success("操作成功");
    }

    //发送进度查询
    public function send_ROP($msg_id){
        $model = new GroupMsgModel();
        $this->is_audit($msg_id);
        $msg_info = $model->get_msg_info($msg_id);
        //dump($msg_info);
        //该部分测试专用  上线后请注意 BY zhukeqin
        //$wechat->send_tpl_message('ohgcf0nvRzH_W8gJb9eqFKwDucy0',$tpl_id,$url,$data);
        /*dump($model->get_rusers_list($msg_info['village_id'],$msg_info['company_id']));
        dump($model->get_rusers_num($msg_info['village_id'],$msg_info['company_id']));*/
        $model->auto_set_ctr_name($msg_id);
        $model->auto_send_msg($msg_id);//判断是发送类型
        $this->assign_json('msg_info',$msg_info);
        $this->display();
    }

    //进度条
    public function get_send_msg_progress($msg_id){
        $model = new GroupMsgModel();
        $this->is_audit($msg_id);
        $msg_info = $model->get_msg_info($msg_id);
        $wechat_model = new WechatModel();
        $ctr = $wechat_model->get_ctr($msg_info['ctr_name']);
        if($ctr){
            $ctr['ruser_num'] = $msg_info['ruser_num'];
            $ctr['openids_count'] = count($ctr['openids']);
            $ctr['scale'] =  ($ctr['ruser_num']-$ctr['openids_count']) .'/'. $ctr['ruser_num'];
            $ctr['percent'] =  (1-$ctr['openids_count']/$ctr['ruser_num']) * 100 . '%';
            $ctr['complate'] = $ctr['openids_count'] ? 0 : 1;
            $ctr['status'] = $this->get_status($ctr['on'],$ctr['openids_count']);
        }
        $this->success(1-$ctr['openids_count']/$ctr['ruser_count'],'',$ctr);
    }

    /**
     * 获取状态
     * @param $ctr_on
     * @param $openids_count
     * @return int
     */
    public function get_status($ctr_on,$openids_count){
        if($openids_count){

            if($ctr_on){
                $status = 1;//进行中
            }else{
                $status = 0; //暂停中
            }

        }else{
            $status = 2;//已完成
        }

        return $status;
    }


    //暂停发送
    public function stop_send($msg_id){
       $model = new GroupMsgModel();
        $this->is_audit($msg_id);
       $msg_info = $model->get_msg_info($msg_id);
       $re = $model->ctr_off($msg_info['ctr_name']);
       if($re){
           $this->success('关闭成功');
       }else{
           $this->error("发生错误");
       }
    }

    //继续发送
    public function go_on_send($msg_id){
        $model = new GroupMsgModel();
        $this->is_audit($msg_id);
        $msg_info = $model->get_msg_info($msg_id);
        $re = $model->ctr_on($msg_info['ctr_name']);
        if($re!==false){
            $model->send_now_msg($msg_id);
            $this->success('继续发送');
        }else{
            $this->error(mysql_error());
        }
    }



    //用户最后看到的页面
    public function view_msg($msg_id){
        $visitor_model = new Visitor_logModel();
        $visitor_model->add_log(array('msg_id'=>$msg_id));//访问日志记录
        $model = new GroupMsgModel();
        $msg_info = $model->get_msg_info($msg_id);
        $this->assign('msg_info',$msg_info);
        $this->display();
    }



    /***************************工具*************************/
    /*******************************************************/

    protected function success($message='',$jumpUrl='',$data){
        if(IS_AJAX==1){

            $this->ajaxReturn(array('err'=>0,'msg'=>$message,'data'=>$data));

        }else{

            parent::success($message,$jumpUrl,false);

        }
    }

    public function error($message='',$jumpUrl='',$data){
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
    public function demo(){
        $group_msg=M('wxmsg')->where(array('is_complete'=>0,'status'=>1))->select();
        dump(M()->_sql());
        dump($group_msg);
    }
    /**
     * 获取身份并判断,并判断能否发送
     * @author zhukeqin
     *
     */
    public function is_audit($msg_id)
    {
        $model = new GroupMsgModel();
        //标记
        $return=$model->is_audit($msg_id,$_SESSION['openid']);
        if(!$return){
            $this->error('您不是审核人员，没有访问权限');
            die;
        }
        $return=$model->is_wxmsg($msg_id);
        switch ($return){
            case 0:$this->error('群发开关尚未打开，请前往后台开启后再来进入本页面');die;break;
            case 1:break;
            case 2:$this->error('群发全部项目不被允许，请修改至具体项目后再来');die;break;
        }
        if(ACTION_NAME=='send_ROP'){
            //获取当前发送状态 提升体验 by zhukeqin
            $wechat_model = new WechatModel();
            $msg_info = $model->get_msg_info($msg_id);
            $ctr = $wechat_model->get_ctr($msg_info['ctr_name']);
            $msg_status = $this->get_status($ctr['on'],$ctr['openids_count']);
            switch ($return){
                case 2:$this->error('当前任务今天已发送完成，一天内不能重复发送');die;break;
                default:break;
            }
        }

    }

}