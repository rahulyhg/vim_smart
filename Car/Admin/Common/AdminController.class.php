<?php

namespace Admin\Common;
use Think\Controller;

//我们自定一个父类控制来继承总控制器
class AdminController extends Controller
{
    //设置构造方法，让用户在进行任何操作之前都先进行权限校验，防止翻墙
    function __construct()
    {
        parent::__construct();//自己定义了构造方法后，必须要先执行父类构造方法，否则可能会造成功能丢失甚至报错
        //获取当前的控制和操作方法
        $nowAC = CONTROLLER_NAME . '-' . ACTION_NAME;
        //查询当前用户的数据库权限信息，并且与当前的请求的权限进行对比，进行允许和拒绝操作
        $admin_id = session('admin_id');
        $admin_name = session('admin_name');
        $allow_anyone = "Admin-admlogin,Admin-admlogout,Admin-checkCode,Admin-check_code";//允许任何人的默认权限

        //自己优化的代码(因为登录状态时操作走此控制器的次数要比未登录状态的次数要多得多)
        if (!empty($admin_id)) {//登录状态
            $info = D('Admin')->alias('a')->join('__ROLE__ r on a.role_id=r.role_id')->field('r.role_auth_ac')->where("a.user_id=$admin_id")->find();
            $role_auth_ac = $info['role_auth_ac'];
            //所有默认允许的权限
            $dfault_allow_auth = "Admin-admlogin,Admin-admlogout,Admin-checkCode,Admin-check_code,Admin-self_detail,Admin-self_update,Index-index";
            //当不满足以下条件时就拒绝
            //①：当前请求的权限不在自己数据库中
            //②：当前请求的权限不在默认允许的权限列表中
            //③：用户名不为admin
            if (strpos($role_auth_ac, $nowAC) === false && strpos($dfault_allow_auth, $nowAC) === false && $admin_name != 'vhkj') {
                exit('您无权执行当前操作！非法操作！');
            }
        } else {//未登录状态
            /*  if(strpos($allow_anyone,$nowAC)===false){
              $js=<<<eof
                     <script type="text/javascript">
                      window.top.location.href="?m=Admin&c=Admin&a=admlogin";
                     </script>
  eof;
              echo $js;*/
        }
    }



}


