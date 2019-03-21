<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/9/15
 * Time: 10:16
 * 智慧助手总后台测试接口
 */
class testAction extends Action{

    /**
     * 友联开门接口测试
     */
    public function test_unios(){
        import('@.ORG.Unios');
        $keyOb=new Unios(4,1,'f4ffdf14-cd73-4656-bffb-a5df4e9a74c5',5000,'http://iot.vhi99.com/console/api/assignments/');
        $data = $keyOb->Linkhickey();
        vd($data);exit;
        $result_json = json_decode($data,true);
        //vd($result_json);
    }

    /**
     * 友联获取commands_token 测试1
     */
    public function test_token(){
        import('@.ORG.Unios');
        $keyOb=new Unios(4,1,'f4ffdf14-cd73-4656-bffb-a5df4e9a74c5',5000,'http://iot.vhi99.com/console/api/assignments/');
        $data = $keyOb->getCommandToken();
        vd($data);
    }


    /**
     *yeelink 接口测试
     */
    public function test_yeelink(){

    }

    /**
     * 测试车辆是否在场
     */
    public function test_car_in_park(){
        redirect('http://www.hdhsmart.com/Car/index.php?m=home&c=test&a=query_by_car_no');

    }

    /**
     * 手动排除抬杠故障（慎用）
     */
    public function hm_deal_problem_car(){
        redirect('http://www.hdhsmart.com/unify.php?m=Unify&c=Index&a=auto_notice_api_ok');

    }

    /**
     * 测试生成订单接口
     */
    public function make_car_order(){
        redirect('http://www.hdhsmart.com/Car/index.php?m=home&c=test&a=make_api_order');

    }

    /**
     * 显示所有的接口测试信息
     */
    public function index(){
        $this->display();
    }



    /**
     * 更新user表中用户的openid
     * @warning only once 慎用
     */
    public function update_user_openid(){

        set_time_limit(300);

        $wechatUser = M('wechat_user')->where(array('openid'=>array('neq','')))->select();

       //vd($wechatUser);exit;

        foreach ($wechatUser as $key=>$value){

            $res = M('user')->where(array('openid'=>$value['openid']))->find();
            if(!$res){
                $uid = M('user')->where(array('nickname'=>$value['nickname']))->find();
                if($uid){
                    M('user')->where(array('uid'=>array('eq',$uid['uid'])))->data(array('openid'=>$value['openid'],'unionid'=>$value['unionid']))->save();
                }
            }

        }

    }

}