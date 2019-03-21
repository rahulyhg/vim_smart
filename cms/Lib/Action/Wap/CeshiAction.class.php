<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/12/25
 * Time: 15:54
 */
class CeshiAction extends BaseAction{
    public function login() {
        $this->display();
    }

    public function index() {
        $account = I('post.account');
        $password = md5(I('post.password'));
        $re = D('admin')->where(array('account' => $account, 'pwd' => $password))->find();
        if ($re) {
            $openid = $_SESSION['openid'];
            $userArr = D('user')->where(array('openid'=>$openid))->find();
            $uid = $userArr['uid'];
            $u_arr = D('house_village_user_bind')->where(array('phone'=>$account,'type'=>1))->find();
            if ($u_arr) {
                $ure = D('house_village_user_bind')->where(array('pigcms_id'=>$u_arr['pigcms_id']))->save(array('uid'=>$uid));
                if ($ure) {
                  redirect(U('Wap/Houser/village_my_pay',array('type'=>'jiaofei','village_id'=>$u_arr['village_id'])));
                }
            }
        } else {
            $this->error('登陆失败');
        }

    }

//    public function save() {
//        $user_t_name = $_POST['user_t_name'];
//        $user_phone = $_POST['user_phone'];
//        $user_commpany = $_POST['user_commpany'];
//        $re = D('house_village_user_bind')->where(array('name'=>$user_t_name,'phone'=>$user_phone))->find();
//        if ($re) {
//            echo 1;
//        } else {
//            echo '输入信息不正确';
//        }
//    }
}