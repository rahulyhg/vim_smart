<?php
class HotactivityAction extends BaseAction{
    public $appid='wx49b9dbe4f861f4f8';
    public $appSecret='9d93154d0f0b3bc9c15c7c34e3edd2f3';

    /*热门活动首页*/
    public function index(){

        if(!isset($_SESSION['newinfo']['openid'])){
            $this->check();
        }else{
            $this->changeold();
        }
     
    }
    /*热门活动页面登陆控制*/
    public function check(){
        //调用微信快捷登陆
          import('ORG.Net.Http');
        $http = new Http();
       // $redirecturl5='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'];  //正确的url路径
        $redirecturl='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];   //正确的url路径
        if (empty($_GET['code'])) {
            $_SESSION['weixinstate'] = md5(uniqid());
            $oauthUrl = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $this->appid. '&redirect_uri=' . urlencode($redirecturl) . '&response_type=code&scope=snsapi_userinfo&state=' . $_SESSION['weixinstate'] . '#wechat_redirect';
            header('Location: ' . $oauthUrl);

        } else if (isset($_GET['code'])  && isset($_GET['state']) && ($_GET['state'] == $_SESSION['weixinstate'])) {
            unset($_SESSION['weixin']);
            $return = $http->curlGet('https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $this->appid . '&secret=' . $this->appSecret. '&code=' . $_GET['code'] . '&grant_type=authorization_code');
            $jsonrt = json_decode($return,true);
            if($jsonrt['errcode']){
                $error_msg_class = new GetErrorMsg();
                $this->error_tips('授权发生错误：'.$error_msg_class->wx_error_msg($jsonrt['errcode']),U('Login/index'));
            }
            $result = $http->curlGet('https://api.weixin.qq.com/sns/userinfo?access_token='.$jsonrt['access_token'].'&openid='.$jsonrt['openid'].'&lang=zh_CN');
            $jsonrt = json_decode($result,true);
            if ($jsonrt['errcode']) {
                $error_msg_class = new GetErrorMsg();
                $this->error_tips('授权发生错误：'.$error_msg_class->wx_error_msg($jsonrt['errcode']),U('Login/index'));
            }
            $_SESSION['newinfo']=$jsonrt;
            redirect(U('Wap/Hotactivity/index'));

        }else{
            echo "<span style='font-size: 30px;display: block;margin: 0 auto;'>您的网络繁忙，请重新进入再试！谢谢！</span>";
        }

    }
    /*热门活动页面手机录入*/
    public function addPhone(){
        if(IS_POST){
            //获取用户提交的手机号
            if(!empty($_POST['phone'])){
                $phone = $_POST['phone'];
                $time = time();
                /*var_dump($_SESSION);exit;*/
                $openid = $_SESSION['newinfo']['openid'];
                $m = M('user');
                $re = $m->where(array('openid'=>$openid))->find();
                /*var_dump($re);exit;*/
                if($re){
                    $res = $m->where(array('openid'=>$openid))->data(array('phone'=>$phone,'order_time'=>$time))->save();
                    echo $phone;
                }else{
                    $arr = array(
                        'openid'=>$openid,
                        'phone'=>$phone,
                        'nickname'=>$_SESSION['newinfo']['nickname'],
                        'sex'=>$_SESSION['newinfo']['sex'],
                        'province'=>$_SESSION['newinfo']['province'],
                        'city'=>$_SESSION['newinfo']['city'],
                        'order_time'=>$time,
                        'avater'=>$_SESSION['newinfo']['headimgurl'],
                        'add_time' => $_SERVER['REQUEST_TIME'],
                        'add_ip' =>  get_client_ip(1),
                        'last_time'=>$_SERVER['REQUEST_TIME'],
                        'last_ip'=>get_client_ip(1),
                        'last_weixin_time' 	=> $_SERVER['REQUEST_TIME']
                    );
                    $res = $m->data($arr)->add();
                    echo $phone;
                }

            }
        }

    }
    /*测试数据方法*/
    public function textinsert(){
        $m = M('user');
        $arr = array(
            'openid'=>123456,
            'phone'=>123456,
            'nickname'=>$_SESSION['newinfo']['nickname'],
            'sex'=>$_SESSION['newinfo']['sex'],
            'province'=>$_SESSION['newinfo']['province'],
            'city'=>$_SESSION['newinfo']['city'],
            'order_time'=>time(),
            'avater'=>$_SESSION['newinfo']['headimgurl'],
            'add_time' => $_SERVER['REQUEST_TIME'],
            'add_ip' =>  get_client_ip(1),
            'last_time'=>$_SERVER['REQUEST_TIME'],
            'last_ip'=>get_client_ip(1),
            'last_weixin_time' 	=> $_SERVER['REQUEST_TIME']
        );
        $res = $m->data($arr)->add();
        if($res){
            echo '2';
        }else{
            echo '3';
        }

    }
    public function changeold(){
        $openid = $_SESSION['newinfo']['openid'];//oA82ws25YzmIhFFzqX90wZGOPtbU
        //echo $openid;
        $m = M('User');
        $time=array('gt',1478707200);
        $re = $m->where(array('openid'=>$openid,'order_time'=>$time))->find();
        $phone = $re['phone'];

        if($re){
            $this->assign('phone',$phone);
            $this->display("Hotactivity/newindex");
        }else{
            $this->display("Hotactivity/index");
        }
    }

    public function activity_index_new(){
        //获取当前的项目id
        $village_id = I('get.village_id');
        //公共的热门活动
        $activity_list_commone = M('adver')->where(array('type_id'=>9,'status'=>1,'fid'=>array('neq',0),'is_general'=>1))->select();
        //本项目独有的热门活动
        $activity_list_link = M('adver')->where(array('type_id'=>9,'status'=>1,'fid'=>array('neq',0),'is_general'=>0,'village_id'=>$village_id))->select();
        $this->assign('activity_list_commone',$activity_list_commone);
        $this->assign('activity_list_link',$activity_list_link);
        $this->display();
    }



}