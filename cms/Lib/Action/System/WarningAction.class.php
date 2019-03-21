<?php

/*

 * 系统警告信息管理

 *author 祝君伟

 */



class WarningAction extends BaseAction
{
   /*
    * 系统配置列表
    * */
    public function system_index(){
        $system_array  =M('system_control')->select();
        $this->assign('system_array',$system_array);
        $this->display();
    }

    /*
     * 添加新系统
     * */
    public function system_add(){
        if(IS_POST){
            //执行了添加
            //dump($_POST);exit;
            if(count($_POST['user_wx_opid'])>1){
                foreach ($_POST['user_wx_opid'] as $value){
                    $openid_array = M('user')->where(array('nickname'=>$value))->find();
                    $openid_str_array[]=$openid_array['openid'];
                }
                $openid_string = join(",",$openid_str_array);
            }else{
                $openid_string = $_POST['user_wx_opid'][0];
                $openid_array = M('user')->where(array('nickname'=>$openid_string))->find();
                $openid_string=$openid_array['openid'];
            }

            $data = array(
                'system_name'=>$_POST['system_name'],
                'user_wx_opid'=>$openid_string,
                'system_act'=>$_POST['system_act'],
                'system_con'=>$_POST['system_con'],
                'system_type'=>$_POST['system_type']
            );
            //dump($data);exit;
            $result_code = M('system_control')->data($data)->add();
            if($result_code){
                $this->success('添加成功');
            }else{
                $this->error('添加失败');
            }

        }else{
            //正常显示页面
            $this->display();
        }
    }

    /*
     * 编辑系统
     * */
    public function system_edit(){
        if(IS_POST){
            //执行编辑操作
            if(count($_POST['user_wx_opid'])>1){
                foreach ($_POST['user_wx_opid'] as $value){
                    $openid_array = M('user')->where(array('nickname'=>$value))->find();
                    $openid_str_array[]=$openid_array['openid'];
                }
                $openid_string = join(",",$openid_str_array);
            }else{
                $openid_string = $_POST['user_wx_opid'][0];
                $openid_array = M('user')->where(array('nickname'=>$openid_string))->find();
                $openid_string=$openid_array['openid'];
            }

            $data = array(
                'pigcms_id'=>$_POST['pigcms_id'],
                'system_name'=>$_POST['system_name'],
                'user_wx_opid'=>$openid_string,
                'system_act'=>$_POST['system_act'],
                'system_con'=>$_POST['system_con'],
                'system_type'=>$_POST['system_type']
            );
            //dump($data);exit;
            $result_code = M('system_control')->save($data);
            if($result_code){
                $this->success('修改成功');
            }else{
                $this->error('修改失败');
            }
        }else{
            //正常显示的页面
            $system_id = I('get.system_id');
            $system_array = M('system_control')->where(array('pigcms_id'=>$system_id))->find();
            $openid_array_old = explode(",",$system_array['user_wx_opid']);
            foreach ($openid_array_old as $value){
                $user_info_array = M('user')->where(array('openid'=>$value))->find();
                $openid_array[]=$user_info_array['nickname'];
            }
            $this->assign('system_array',$system_array);
            $this->assign('openid_array',$openid_array);
            $this->display();
        }
    }

    /*
     * 显示后台的警告信息
     * */
    public function showlist(){
        $system_id = I('get.system_id');

        $map = array();

        if(!empty(I('get.is_deal')))$map['w.is_deal']=0;



        if(!empty($system_id)){

            $map['w.is_del'] = array('eq',0);

            $map['w.system_id'] = array('eq',$system_id);

            $warnings_array = M('system_warning_control')
                ->alias('w')
                ->join('JOIN pigcms_system_control as s on w.system_id=s.pigcms_id')
                ->field('w.*,s.system_name,s.system_act,s.system_con')
                ->where($map)
                ->order('w.create_time desc')
                ->select();
        }else{

            $map['w.is_del'] = array('eq',0);

            $warnings_array = M('system_warning_control')
                ->alias('w')
                ->join('JOIN pigcms_system_control as s on w.system_id=s.pigcms_id')
                ->field('w.*,s.system_name,s.system_act,s.system_con')
                ->where($map)
                ->order('w.create_time desc')
                ->select();
            //dump($warnings_array);exit;
        }
        //附加信息处理
        foreach ($warnings_array as $key=>$value){
            if($value['warning_info']!=null){
                //附加信息栏不为空
                $car_no = M()
                    ->table('smart_payrecord')
                    ->alias('p')
                    ->join('LEFT JOIN smart_servicerecord s on p.serv_id=s.serv_id')
                    ->where(array('p.api_pay_no'=>$value['warning_info']))
                    ->getField('s.car_no');
                $warnings_array[$key]['warning_info']=$car_no;
            }
        }
        //vd($warnings_array);exit;
        $this->assign('warnings_array',$warnings_array);
        $this->display();
    }

    /**
     * 一键处理全部警告信息
     * @author zjw
     * @time 2017年9月4日8:55:52
     */
    public function deal_all(){
        $res = M('system_warning_control')->where(array('is_check'=>array('eq',0),'is_deal'=>array('eq',0)))->data(array('is_check'=>1,'is_deal'=>1))->save();
        if($res){
            $this->success('一键处理成功',U('showlist'));
        }else{
            $this->error('处理失败',U('showlist'));
        }
    }

    /*
     * 查看警告信息的详细页
     * */
    public function warning_detail(){
        if(IS_POST){
            $pigcms_id = $_POST['pigcms_id'];
            $result_code = M('system_warning_control')->where(array('pigcms_id'=>$pigcms_id))->data(array('is_deal'=>1))->save();
            if($result_code){
                $this->success('处理完毕');
            }else{
                $this->error('处理失败');
            }
        }else{
            $id = I('get.pigcms_id');
            //区分是否是对话请求
            $warnings_array = M('system_warning_control')
                ->alias('w')
                ->join('JOIN pigcms_system_control as s on w.system_id=s.pigcms_id')
                ->field('w.*,s.system_name,s.system_act,s.system_con,s.system_type')
                ->where(array('w.is_del'=>0,'w.pigcms_id'=>$id))
                ->find();
            //dump($warnings_array);exit;
            if($warnings_array['system_id'] == 10){
                redirect('http://www.hdhsmart.com/Car/index.php?s=/Admin/Payrecord/chat_windows/user_id/'.$warnings_array['warning_result'].'/pigcms_id/'.$id);
                exit();
            }
            //附加信息处理
            $car_no = M()
                ->table('smart_payrecord')
                ->alias('p')
                ->join('LEFT JOIN smart_servicerecord s on p.serv_id=s.serv_id')
                ->where(array('p.api_pay_no'=>$warnings_array['warning_info']))
                ->getField('s.car_no');
            $warnings_array['car_no']=$car_no;
            //dump($warnings_array);exit;
            //进入详细页代表被查看
            M('system_warning_control')->where(array('pigcms_id'=>$id))->data(array('is_check'=>1))->save();
            $this->assign('warnings_array',$warnings_array);
            $this->display();
        }
    }

    /*
     * 自动完成提供数据方法
     * */
    public function ajax_to_autocomplete(){
        $keyword = I('get.query');
        //制作查询语句
        $map['nickname']=array('like','%'.$keyword.'%');
        $keyword_array = M('user')->where($map)->limit(5)->select();
        foreach ($keyword_array as $value){
            $result_array[] =array(
                'label'=>$value['nickname'],
            );
        }
        echo json_encode($result_array);
    }

    /*
     * 测试方法
     * */
    public function pdo_test(){
        import('@.ORG.WarnMessage');
        $message = new WarnMessage('open_door','House','0001','not fund','开门异常');
        $arr = $message->get_data_tp();
        dump($arr);
    }

    public function html_test(){
        $this->display();
    }

}