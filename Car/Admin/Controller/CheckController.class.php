<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/20
 * Time: 16:15
 */

namespace Admin\Controller;
use Admin\Common\RbacController;

class CheckController extends RbacController{

    //后台显示客服询问列表
    public function showlist_yueka(){
      //显示所有的审核信息页
        //var_dump($_SESSION);exit;
        $check = new \Admin\Model\CheckModel();
        $admin_show_list = $check->get_check_list($this->garage_id);
        $this->assign('admin_show_list',$admin_show_list);
        $this->display();
    }
    
    /*
     * 审核完毕，把本地数据维护
     * */
    public function change_user_state(){
        $check_id = I('get.check_id');
        $check = new \Admin\Model\CheckModel();
        $ready_array = $check->get_ready_info($check_id);
        $result_code = $check->update_location($ready_array);
        if($result_code){
            //开卡成功，推送给用户成功信息
            $person_info =array(
                'url'=>C("WEB_DOMAIN").'/index.php?m=Home&c=Car&a=use_service',
                'first_value'=>'新用户开卡情况提醒',
                'keyword1_value'=>'新用户开卡成功！',
                'keyword2_value'=>'已经成功为车牌号为'.$ready_array['car_no'].'的车开通月卡！',
                'keyword3_value'=>'有任何问题请致电技术人员解决 TEL:027-87779655'
            );

            $admin_user = array(
                0=>$ready_array['user_wx_opid']
            );
            $dose_not_send=A('Home/user')->auto_send_message($admin_user,$person_info);
            if($dose_not_send[0]['errmsg']=='ok'){
                //发送成功！
                echo '1';
            }else{
                //消息发送失败错误编号0006
                echo '0006';
            }
        }else{
            //维护本地数据库失败 错误编号0005
            echo '0005';
        }
    }

}