<?php

namespace Admin\Common;
use Think\Controller;

//我们自定一个父类控制来继承总控制器
class RbacController extends Controller{

    protected $garage_id;
    protected $s_garage_id;
    protected $s_garage_Arr;
    //设置构造方法，让用户在进行任何操作之前都先进行权限校验，防止翻墙
    function __construct(){
        parent::__construct();//自己定义了构造方法后，必须要先执行父类构造方法，否则可能会造成功能丢失甚至报错
        //新版权限控制
        //dump($_SESSION);exit;
        $admin_id=session('admin_id');
        $admin_name=session('admin_name');
        $role_id=session('role_id');
        $garage_id = I('garage_id');
        //实例化逻辑层
        //$rab_logic = D('Rbac','Logic');
        $rab_logic = Logic('Rbac');
        //一切权限对于超级管理员开放
        if($admin_name==SUPER_ADMIN){
            $arr = $rab_logic->super_admin_list();
            $garage_array = $rab_logic->super_garage_array();
            //dump($arr);exit;
            $this->assign('arr',$arr);
            $this->assign('garage_name','超级权限');
            $this->assign('garage_array',$garage_array);
        }else if(!empty($admin_name)){
            //TODO:只有在非超级管理员登陆的时候才会有停车场id检查
            $allow_string = $rab_logic->check_auth($role_id);
            $arr = $rab_logic->common_admin_list($allow_string);
            //dump($arr);exit;
            //停车场id检查并赋值
            //TODO:只有手动选择停车场的时候才会带url参数
            if(!empty($garage_id)){
                //人工切换停车场
                $this->garage_id = $garage_id;
                $garage_name =$rab_logic->get_garage_name($garage_id);
                session('garage_id',$garage_id);
            }else{
                //当不存在停车场id的时候，即没有进行人工选择
                //1) 检查是否有停车场id
                $this->garage_id=$rab_logic->garage_check();
                //2) 检查是否存在session，存在即代表曾用过人工选择且在三个小时中，不会自动切换为双停车场模式
                if(empty(session('garage_id'))){
                    $garage_name = $rab_logic->deal_srting_garage_id();
                }else{
                    $garage_name =  $garage_name =$rab_logic->get_garage_name(session('garage_id'));
                }
            }
            $garage_array = $rab_logic->check_special_garage();
            $this->assign('arr',$arr);
            $this->assign('garage_name',$garage_name);
            $this->assign('garage_array',$garage_array);
            //权限控制---逻辑权限控制
            //获取当前的控制器和操作方法
            $allow_array = explode(",",$allow_string);
            if($admin_name != 'admin'){
                $nowAC=CONTROLLER_NAME.'-'.ACTION_NAME;
                $dfault_allow_auth="Admin-admlogin,Admin-admlogout,Admin-checkCode,Admin-detail,Admin-check_code,Admin-self_detail,Admin-update_self,Index-index,Index-index_time_amount,Index-index_calendar,User-detail_info,User-password_update,Servicerecord-search,Index-flush_garage_choose";
                if(strpos($dfault_allow_auth,$nowAC)===false){
                    $allow_user_do_array = M('menu')->where(array('module'=>CONTROLLER_NAME,'action'=>ACTION_NAME))->find();
                    //dump($allow_array);exit;
                    $allow_user_do_id = $allow_user_do_array['id'];
                    if(!in_array($allow_user_do_id,$allow_array)){
                        $this->error('您无权执行当前操作！非法操作！！',U('Index/index'),1);
                        exit('您无权执行当前操作！非法操作！');
                    }
                }
            }
        }elseif(empty($admin_name)){

         $js=<<<eof
                   <script type="text/javascript">
                    window.top.location.href="?m=Admin&c=Login&a=admlogin";
                   </script>
eof;
            echo $js;
        }

        $admin_name = $_SESSION['admin_name'];
        $s_garage_id_Arr = D('admin')->field('garage_id')->where(array("ad_name"=>$admin_name))->find();
        $s_garage_id = $s_garage_id_Arr['garage_id'];
        //停车场权限ID转化成数组
        $s_arr = explode(',',$s_garage_id);//[2,4,6], [2] , [4];
        //根据停车场权限ID取停车场ID默认值
        if ($s_arr[0] == 0) {
            $garage_id = isset($_GET['garage_id'])?$_GET['garage_id']:2;
        }else{
            $garage_id = isset($_GET['garage_id'])?$_GET['garage_id']:$s_arr[0];
        }
        //设置权限
        if(!(in_array($garage_id,$s_arr)||$s_arr[0] == 0)) {
            $this->error("没有权限");
        }
        //停车场数组传给前台
        $map['garage_id'] = array('in',$s_garage_id);
        if ($s_arr[0] == 0) {
            $s_garage_Arr = D('garage')->select();
        }else{
            $s_garage_Arr = D('garage')->where($map)->select();
        }
        $this->garage_id = $garage_id;
        $this->s_garage_id = $s_garage_id;
        $this->s_garage_Arr = $s_garage_Arr;
        $this->assign('s_garage_id',$s_garage_id);
        $this->assign('garage_id',$garage_id);
        $this->assign('s_garage_Arr',$s_garage_Arr);
    }
    
}


