<?php

namespace Home\Common;
use Think\Controller;

//我们自定一个父类控制来继承总控制器
class RbacController extends Controller{
    //设置构造方法，让用户在进行任何操作之前都先进行权限校验，防止翻墙
    function __construct(){
        parent::__construct();//自己定义了构造方法后，必须要先执行父类构造方法，否则可能会造成功能丢失甚至报错
        //新版前台权限控制
        $user_id =session('user_id');
        if(!empty($user_id)){
            $user_info = M('user')->where(array('user_id'=>$user_id))->find();
            $user_can_do = M('role')->where(array('role_id'=>$user_info['user_role_id']))->find();
            $allow_string=$user_can_do['role_auth_ids'];
            $allow_array = explode(",",$allow_string);
            //用户端菜单栏显示
            $left_menu=M()->query("select * from ".C('DB_PREFIX')."menu where id in ($allow_string) and auth_type=1 and create_type=0 and fid!=0");

            $arr=array();
            foreach ($left_menu as $k=>&$v){
                $v['url']=U($v['model'].'/'.$v['module'].'/'.$v['action']);
                $arr[$v['id']]=$v;
            }
            unset($v);
            //dump($arr);exit;
            $this->assign('arr',$arr);
        }else{
            $user=new \Home\Model\UserModel();
            $user->login();
        }
        //初始化统一配置
        $web_title = M('config')->getFieldByName('car_web_title','value');
        $web_footer = M('config')->getFieldByName('car_web_footer','value');
        //dump($web_footer);exit;
        C('WEB_TITLE',$web_title);
        C('WEB_FOOTER',$web_footer);
    }
}


