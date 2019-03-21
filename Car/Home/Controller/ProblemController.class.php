<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/4/26
 * Time: 9:33
 */
namespace Home\Controller;
use Think\Controller;
class ProblemController extends Controller
{
    //跳转主页面
    public function index(){
        $this->display();
    }

    //版本更新页面
    public function update_version(){
        $type=I('get.type')?:0;
        if($type==0){
            if(session('newinfo')){
                $exists_status=M('user')->where(array('user_wx_opid'=>$_SESSION['newinfo']['openid']))->find();
                if(!$exists_status){
                    //清除缓存
                    session(null);
                    cookie(null);
                    $c_url = "http://www.hdhsmart.com/Car/index.php?m=Home&c=Car&a=use_service";
                    $this->assign('c_url',$c_url);
                    $this->display();
                }else{

                    header('Location:http://www.hdhsmart.com/Car/index.php?m=Home&c=Car&a=use_service');
                }

            }else{

                header('Location:http://www.hdhsmart.com/Car/index.php?m=Home&c=Car&a=use_service');
            }
        }else{
            //dump($_SESSION);exit;
            if(session('user')){
                $exists_status=M()->table('pigcms_user')->where(array('openid'=>$_SESSION['user']['openid']))->find();
                if(!$exists_status){
                    //清除缓存
                    session(null);
                    cookie(null);
                    $c_url = "http://www.hdhsmart.com/wap.php?g=Wap&c=Home&a=index_new";
                    $this->assign('c_url',$c_url);
                    $this->display();
                }else{
                    header('Location:http://www.hdhsmart.com/wap.php?g=Wap&c=Home&a=index_new');
                }

            }else{

                header('Location:http://www.hdhsmart.com/wap.php?g=Wap&c=Home&a=index_new');
            }
        }


    }
}