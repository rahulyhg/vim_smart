<?php
class ActivityhotAction extends BaseAction{
    /*public $appid='wx4c9f2ead52f08cdf';
    public $appSecret='d783884fafd63721d3acfc912daacb74';*/
    public function index(){

        if(!isset($_SESSION['newinfo']['openid'])){
            $this->authorize_openid();
        }else{
            $this->changeold();
        }

    }
    protected function https_request($url, $data = null,$noprocess=false) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; WOW64; rv:39.0) Gecko/20100101 Firefox/39.0");
        $header = array("Accept-Charset: utf-8");
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        //curl_setopt($curl, CURLOPT_SSLVERSION, 3);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header); /* * *$header 必须是一个数组** */
        curl_setopt($curl, CURLOPT_HEADER, FALSE);
        curl_setopt($curl, CURLINFO_HEADER_OUT, true);
        if (!empty($data)) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        if($noprocess) return $output;
        $errorno = curl_errno($curl);
        if ($errorno) {
            return array('curl' => false, 'errorno' => $errorno);
        } else {
            $res = json_decode($output, 1);
            if ($res['errcode']) {
                return array('errcode' => $res['errcode'], 'errmsg' => $res['errmsg']);
            } else {
                return $res;
            }
        }
        curl_close($curl);
    }

    public function authorize_openid()
    {
        if (empty($_GET['code'])) {
            $GLOBALS['_SESSION']['weixin']['state'] = md5(uniqid());
            $customeUrl = $this->config['site_url'] . $_SERVER['REQUEST_URI'];
            $oauthUrl = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $this->config['wechat_appid'] . '&redirect_uri=' . urlencode($customeUrl) . '&response_type=code&scope=snsapi_base&state=' . $GLOBALS['_SESSION']['weixin']['state'] . '#wechat_redirect';
            redirect($oauthUrl);
            exit();
        }
        else {
            if (isset($_GET['code']) && isset($_GET['state']) && ($_GET['state'] == $GLOBALS['_SESSION']['weixin']['state'])) {
                unset($GLOBALS['_SESSION']['weixin']);
                import('ORG.Net.Http');
                $http = new Http();
                $return = $http->curlGet('https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $this->config['wechat_appid'] . '&secret=' . $this->config['wechat_appsecret'] . '&code=' . $_GET['code'] . '&grant_type=authorization_code');
                $jsonrt = json_decode($return, true);

                if ($jsonrt['errcode']) {
                    $error_msg_class = new GetErrorMsg();
                    $this->error_tips('授权发生错误：' . $error_msg_class->wx_error_msg($jsonrt['errcode']), U('Home/index'));
                }

                if ($jsonrt['openid']) {
                    $GLOBALS['_SESSION']['openid'] = $jsonrt['openid'];
                    $access_token=$jsonrt['access_token'];
                    $openid=$jsonrt['openid'];
                    $url='https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';//通过access_token和openid调用此接口获得用户详细信息
                    $res=$this->https_request($url);
                    /*var_dump($res);exit;*/
                    $_SESSION['newinfo'] = $res;
                    redirect(U('Wap/Activityhot/index'));

                }
                else {
                    echo '网络繁忙稍后再试';
                }
            }
            else {
                echo '网络繁忙稍后请再试';
            }
        }
    }

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

                }

            }
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

}