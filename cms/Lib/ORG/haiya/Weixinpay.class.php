<?php
class Weixinpay{
    protected $order_info;
    protected $pay_money;
    protected $pay_type;
    protected $is_mobile;
    protected $user_info;

    //$order_info为数组形式(且数据必须包含两个元素，键值分别为order_name,order_id)
    //$user_info也为数组形式（且数据必须包含openid）
    public function __construct($order_info=array(),$pay_type='',$user_info=array()){
        $this->order_info = $order_info;//订单信息 里面含有 order_id order_name order_detail
        $this->pay_type   = $pay_type;//支付方式
        //$this->is_mobile   = $is_mobile;//判断支付的方式 为2的时候为app支付，为0的时候为网页支付，为其他数字时为原生支付
        $this->config = $this->getconfig();
        //支付的配置项，最好写到你的wxpaypubconfig里面去（包含 appid appsecret mchid key site_url）
        $this->user_info  = $user_info;//用户的信息 必须有openid
        //$this->pay();
    }

    /*工具类getconfig
     * 获取表中的配置项
     *2016.11.17
     */
    protected function getconfig(){
           $m=M('config','smart_');
           $configArr = $m->field("name,value")->select();
            foreach($configArr as $key=>$value){

            $config[$value['name']] = $value['value'];

            }
           return $config;
    }

    /*工具类https_request
     * http 请求返回res的函数
     *2016.11.17
     */
    public function https_request($url, $data = null,$noprocess=false) {
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

    /**支付方式选择方法
     * 	0 -- 网页支付
     *  1 -- 原生支付
     * 2016.11.16
     */
    public function pay($ticket=null, $deviceId=null){
        if(empty($this->config['pay_weixin_appid']) || empty($this->config['pay_weixin_mchid']) || empty($this->config['pay_weixin_key']) || empty($this->config['pay_weixin_appsecret'])){
            return array('error'=>1,'msg'=>'微信支付缺少配置信息！请联系管理员处理或选择其他支付方式。');
        }
        if($this->is_mobile == 2){
            return $this->app_pay($ticket, $deviceId);
        }elseif($this->is_mobile){
            return $this->mobile_pay();
        }elseif($this->is_mobile == 1){
            return $this->web_pay();
        }else{
            return $this->authorize_openid();
        }
    }


    /**微信快捷登陆
     *2016.11.16
     *祝君伟
     * @waring import('@.ORG.pay.Weixinnewpay.WxPayPubHelper');第三方类引用
     *$redirect string 成功后跳转地址
     */
    public function authorize_openid($redirect='')
    {
        //dump($this->config['wechat_appid']);exit;
        if (empty($_GET['code']) || empty($_SESSION['weixin']['state'])) {
            //真正意义上的超全局变量
            $GLOBALS['_SESSION']['weixin']['state'] = md5(uniqid());
            //先正则匹配掉以前客户端可能存下的code
            $customeUrl = preg_replace('#&code=(\\w+)#', '', $this->config['site_url'] . $_SERVER['REQUEST_URI']);
            //拼接出要跳转的URL来给微信（这里的state状态值必须还是填上，因为苹果手机的防火墙会自动先进行一次请求，会让你的code被使用而过期）
            $oauthUrl = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $this->config['wechat_appid'] . '&redirect_uri=' . urlencode($customeUrl) . '&response_type=code&scope=snsapi_userinfo&state=' . $_SESSION['weixin']['state'] . '#wechat_redirect';

            //进行下一步跳转
            //redirect($oauthUrl);
            header('Location:'.$oauthUrl);
            exit();
        } else {
            //只有带state的请求才是正式请求所以要先判断
            if (isset($_GET['code']) && isset($_GET['state']) && ($_GET['state'] == $GLOBALS['_SESSION']['weixin']['state'])) {
                unset($_SESSION['weixin']);
                //根据拿的code来拿access_token
                $return = $this->https_request('https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $this->config['wechat_appid'] . '&secret=' . $this->config['wechat_appsecret'] . '&code=' . $_GET['code'] . '&grant_type=authorization_code');

                //$jsonrt = json_decode($return, true);
                $jsonrt = $return;

                if ($jsonrt['errcode']) {
                    $this->show('授权发生错误');
                }

                if ($jsonrt['openid']) {
                    $GLOBALS['_SESSION']['openid'] = $jsonrt['openid'];
                    $access_token=$jsonrt['access_token'];
                    $openid=$jsonrt['openid'];
                    //根据你的access_token 和 openid 来拿客户的资料
                    $url='https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';//通过access_token和openid调用此接口获得用户详细信息
                    $res=$this->https_request($url);
                    //下方写上你的业务逻辑
                    $_SESSION['newinfo'] = $res;

                    return $res;
                    //dump($res);
                    //exit;
                    //redirect(U("$redirect"));
                    //redirect($redirect);
                    //header('Location:'.$redirect);

                } else {
                    //没有拿到openid而报的错
                    //redirect(U('Home/index'));
                }
            } else {
                //没有拿到code或者state值不存在或者和seesion里的值不一样而报的错
                //redirect(U('Home/index'));
            }
        }
    }


    /**微信快捷登陆
     *2016.11.16
     *祝君伟
     * @waring import('@.ORG.pay.Weixinnewpay.WxPayPubHelper');第三方类引用
     *$redirect string 成功后跳转地址
     */
    public function authorize_openid_of_old($redirect='')
    {
        //dump($this->config['wechat_appid']);exit;
        if (empty($_GET['code']) || empty($_SESSION['weixin']['state'])) {
            //真正意义上的超全局变量
            $GLOBALS['_SESSION']['weixin']['state'] = md5(uniqid());
            //先正则匹配掉以前客户端可能存下的code
            $customeUrl = preg_replace('#&code=(\\w+)#', '', $this->config['site_url'] . $_SERVER['REQUEST_URI']);
            //拼接出要跳转的URL来给微信（这里的state状态值必须还是填上，因为苹果手机的防火墙会自动先进行一次请求，会让你的code被使用而过期）
            $oauthUrl = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $this->config['wechat_appid'] . '&redirect_uri=' . urlencode($customeUrl) . '&response_type=code&scope=snsapi_userinfo&state=' . $_SESSION['weixin']['state'] . '#wechat_redirect';

            //进行下一步跳转
            //redirect($oauthUrl);
            header('Location:'.$oauthUrl);
            exit();
        } else {
            //只有带state的请求才是正式请求所以要先判断
            if (isset($_GET['code']) && isset($_GET['state']) && ($_GET['state'] == $GLOBALS['_SESSION']['weixin']['state'])) {
                unset($_SESSION['weixin']);
                //根据拿的code来拿access_token
                $return = $this->https_request('https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $this->config['wechat_appid'] . '&secret=' . $this->config['wechat_appsecret'] . '&code=' . $_GET['code'] . '&grant_type=authorization_code');

                //$jsonrt = json_decode($return, true);
                $jsonrt = $return;

                if ($jsonrt['errcode']) {
                    $this->show('授权发生错误');
                }

                if ($jsonrt['openid']) {
                    $GLOBALS['_SESSION']['openid'] = $jsonrt['openid'];
                    $access_token=$jsonrt['access_token'];
                    $openid=$jsonrt['openid'];
                    //根据你的access_token 和 openid 来拿客户的资料
                    $url='https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';//通过access_token和openid调用此接口获得用户详细信息
                    $res=$this->https_request($url);
                    //下方写上你的业务逻辑
                    $_SESSION['newinfo'] = $res;

                    return $res;
                    //dump($res);
                    //exit;
                    //redirect(U("$redirect"));
                    //redirect($redirect);
                    //header('Location:'.$redirect);

                } else {
                    //没有拿到openid而报的错
                    //redirect(U('Home/index'));
                }
            } else {
                //没有拿到code或者state值不存在或者和seesion里的值不一样而报的错
                //redirect(U('Home/index'));
            }
        }
    }
    /**
     *扫码支付（由微信生成支付二维码）
     *2016.11.15
     *祝君伟
     * @waring import('@.ORG.pay.Weixinnewpay.WxPayPubHelper');第三方类引用
     * $notice_url string 微信支付成功回调地址
     * $pay_money number  支付的钱数
     */
    public function web_pay($notice_url,$pay_money=0.01){
        //引用的微信支付类
        import('@.ORG.pay.Weixinnewpay.WxPayPubHelper');
        //使用jsapi接口
        $jsApi = new JsApi_pub($this->config['pay_weixin_appid'],$this->config['pay_weixin_mchid'],$this->config['pay_weixin_key'],$this->config['pay_weixin_appsecret']);
        //使用统一支付接口
        $unifiedOrder = new UnifiedOrder_pub($this->config['pay_weixin_appid'],$this->config['pay_weixin_mchid'],$this->config['pay_weixin_key'],$this->config['pay_weixin_appsecret']);
        $unifiedOrder->setParameter("body",$this->order_info['order_detail']);//商品描述
        //自定义订单号，此处仅作举例
        $unifiedOrder->setParameter("out_trade_no",$this->order_info['order_id']);//商户订单号
        $unifiedOrder->setParameter("total_fee",floatval($pay_money*100));//总金额以分为单位
        //$unifiedOrder->setParameter("notify_url",$this->config['site_url'].'/source/'.$notice_url.'php');//通知地址
        $unifiedOrder->setParameter("notify_url",$this->config['site_url'].'/source/'.$notice_url.'php');//通知地址
        $unifiedOrder->setParameter("trade_type","NATIVE");//交易类型
        $unifiedOrder->setParameter("attach",'weixin');//附加数据
        $prepay_result = $unifiedOrder->getPrepayId();
        if($prepay_result['return_code'] == 'FAIL'){
            return array('error'=>1,'msg'=>'没有获取微信支付的预支付ID，请重新发起支付！<br/><br/>微信支付错误返回：'.$prepay_result['return_msg']);
        }
        if($prepay_result['err_code']){
            return array('error'=>1,'msg'=>'没有获取微信支付的预支付ID，请重新发起支付！<br/><br/>微信支付错误返回：'.$prepay_result['err_code_des']);
        }
        //=========步骤3：得到微信的二维码============
        $jsApi->setPrepayId($prepay_result['prepay_id']);
        return array('error'=>0,'qrcode'=>$prepay_result['code_url']);
    }
    /**
     *公众号平台微信支付
     *2016.11.16
     *祝君伟
     * @waring import('@.ORG.pay.Weixinnewpay.WxPayPubHelper');第三方类引用
     * $notice_url string 微信支付成功回调地址
     * $pay_money number  支付的钱数
     */
    public function mobile_pay($notice_url,$pay_money){


        //先正则匹配掉以前客户端可能存下的code
        $customeUrl = preg_replace('#&code=(\\w+)#', '', $this->config['site_url'] . $_SERVER['REQUEST_URI']);
            //拼接出要跳转的URL来给微信（这里的state状态值必须还是填上，因为苹果手机的防火墙会自动先进行一次请求，会让你的code被使用而过期）
        $oauthUrl = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $this->config['wechat_appid'] . '&redirect_uri=' . urlencode($customeUrl) . '&response_type=code&scope=snsapi_userinfo&state=' . $_SESSION['weixin']['state'] . '#wechat_redirect';


        //使用jsapi接口

        $jsApi = new JsApi_pub($this->config['pay_weixin_appid'],$this->config['pay_weixin_mchid'],$this->config['pay_weixin_key'],$this->config['pay_weixin_appsecret']);
        //使用统一支付接口

        $unifiedOrder = new UnifiedOrder_pub($this->config['pay_weixin_appid'],$this->config['pay_weixin_mchid'],$this->config['pay_weixin_key'],$this->config['pay_weixin_appsecret']);

        $unifiedOrder->setParameter("openid",$this->user_info['openid']);//用户微信唯一标识
        $unifiedOrder->setParameter("body",$this->order_info['order_name']);//商品描述
        //自定义订单号，此处仅作举例
        $unifiedOrder->setParameter("out_trade_no",$this->order_info['order_id']);//商户订单号
        $unifiedOrder->setParameter("total_fee",floatval($pay_money*100));//总金额
        $unifiedOrder->setParameter("notify_url",C('WEB_DOMAIN').$notice_url);//通知地址
        //$unifiedOrder->setParameter("notify_url",$notice_url);//通知地址
        $unifiedOrder->setParameter("trade_type","JSAPI");//交易类型

        $prepay_result = $unifiedOrder->getPrepayId();

        $fp= fopen('./Common/Log/WeiXin_notice/555555.log', 'a+');
        foreach($prepay_result as $k=>$v){
            fwrite($fp, $k."=>".$v);
        }
        fclose($fp);

        if($prepay_result['return_code'] == 'FAIL'){
            return array('error'=>1,'msg'=>'没有获取微信支付的预支付ID，请重新发起支付！微信支付错误返回：'.$prepay_result['return_msg']);
        }
        if($prepay_result['err_code']){
            return array('error'=>1,'msg'=>'没有获取微信支付的预支付ID，请重新发起支付！<br/><br/>微信支付错误返回：'.$prepay_result['err_code_des']);
        }
        //=========步骤3：使用jsapi调起支付============
        $jsApi->setPrepayId($prepay_result['prepay_id']);
        return array('error'=>0,'weixin_param'=>$jsApi->getParameters());
    }

    /**
     *微信支付回应信息url
     *2016.11.16
     * @waring import('@.ORG.pay.Weixinnewpay.WxPayPubHelper');第三方类引用
     * @waring 注意回调url的地址路由器要写对位置
     *祝君伟
     */
    public function return_url(){
        if(empty($this->config['pay_weixin_appid']) || empty($this->config['pay_weixin_mchid']) || empty($this->config['pay_weixin_key']) || empty($this->config['pay_weixin_appsecret'])){
            return array('error'=>1,'msg'=>'微信支付缺少配置信息！请联系管理员处理或选择其他支付方式。');
        }

        import('@.ORG.pay.Weixinnewpay.WxPayPubHelper');
        //使用通用通知接口
        $notify = new Notify_pub($this->config['pay_weixin_appid'],$this->config['pay_weixin_mchid'],$this->config['pay_weixin_key'],$this->config['pay_weixin_appsecret']);
        //存储微信的回调
        $xml = file_get_contents("php://input");
        $notify->saveData($xml);
        //验证签名，并回应微信。
        if($notify->checkSign() == FALSE){
            $notify->setReturnParameter("return_code","FAIL");//返回状态码
            $notify->setReturnParameter("return_msg","签名失败");//返回信息*/

            //return array('error'=>3,'msg'=>$notify->returnXml());
        }else{

            $notify->setReturnParameter("return_code","SUCCESS");//设置返回码

            if($notify->data['return_code']=='SUCCESS' && $notify->data['result_code']=='SUCCESS'){
                $order_id_arr = explode('_',$notify->data['out_trade_no']);
                $order_param['pay_type'] = 'weixin';
                $order_param['is_mobile'] = $this->is_mobile;
                $order_param['order_type'] = $order_id_arr[0];
                $order_param['order_id'] = $order_id_arr[1];
                $order_param['is_own'] = intval($order_id_arr[2]);
                $order_param['third_id'] = $notify->data['transaction_id'];
                $order_param['pay_money'] = $notify->data['total_fee']/100;
                return array('error'=>0,'order_param'=>$order_param);
            }else{
                return array('error'=>1,'msg'=>'支付时发生错误!');
            }
        }
    }



    /**
     *微信支付退款
     *2016.11.17
     *祝君伟
     * @waring import('@.ORG.pay.Weixinnewpay.WxPayPubHelper');第三方类引用
     * $order_recnid string 商家自己的退款单号
     * $pay_money number 退款钱数
     */
    public function refund($order_recnid,$pay_money){

        if(empty($this->config['pay_weixin_appid']) || empty($this->config['pay_weixin_mchid']) || empty($this->config['pay_weixin_key']) || empty($this->config['pay_weixin_appsecret'])){
            return array('error'=>1,'msg'=>'微信支付缺少配置信息！请联系管理员处理或选择其他支付方式。');
        }
        $weixin_cert = $this->config['pay_weixin_client_cert'];
        $weixin_key =  $this->config['pay_weixin_client_key'];
        if(empty($weixin_cert) || empty($weixin_key)){
            return array('error'=>1,'msg'=>'管理员在后台支付配置中必须上传 微信支付证书和微信支付证书密钥！');
        }

        import('@.ORG.pay.Weixinnewpay.WxPayPubHelper');
        $refund = new Refund_pub($this->config['pay_weixin_appid'],$this->config['pay_weixin_mchid'],$this->config['pay_weixin_key'],$this->config['pay_weixin_appsecret']);
        // dump($this->order_info);exit;
        $refund->setParameter("out_trade_no",$this->order_info['order_id']);//商户订单号
       // $refund->setParameter("out_trade_no",'2017021411164022845');//商户订单号
        $refund->setParameter("out_refund_no",$order_recnid);//商户退款单号
        $refund->setParameter("total_fee",$pay_money*100);//总金额
        $refund->setParameter("refund_fee",$pay_money*100);//退款金额
        $refund->setParameter("op_user_id",$this->config['pay_weixin_mchid']);//操作员
        $refundResult = $refund->getResult();
        if($refundResult['result_code'] == 'FAIL' && $refundResult['err_code'] != 'REFUND_FEE_INVALID'){
            $refund_param['err_msg'] = $refundResult['err_code_des'];
            $refund_param['refund_time'] = time();
            return array('error'=>1,'type'=>'fail','msg'=>'退款申请失败！如果重试多次还是失败请联系系统管理员。','refund_param'=>$refund_param);
        }else{
            //$refund_param['refund_id'] = $refundResult['refund_id'];
           // $refund_param['refund_time'] = time();
            return array('error'=>0,'type'=>'ok','msg'=>'退款申请成功！请注意查收“微信支付”给您发的退款通知。','refund_param'=>$refundResult);
        }

    }

    /*
    * 获取普通的token，不是网页授权access_token
    *
    * */
    public function getToken_bak(){
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . $this->config['wechat_appid'] . "&secret=" . $this->config['wechat_appsecret'];
        $Tokenarr = $this->https_request($url);
        if (isset($Tokenarr['access_token'])) {
            return $Tokenarr['access_token'];
        }
        return false;
    }

    /**
     * 获取token添加缓存
     * @return bool|mixed
     * @update-time: 2017-07-13 15:46:46
     * @author: 王亚雄
     */
    public function getToken(){

        $authname = $this->config['wechat_appid'];//缓存key值
        //先尝试从数据库中
        if($token = $this->getCache($authname)){
            //返回
            return $token;
        }else{//缓存中没有则调用接口获取
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . $this->config['wechat_appid'] . "&secret=" . $this->config['wechat_appsecret'];
            $Tokenarr = $this->https_request($url);
            if (isset($Tokenarr['access_token'])) {
                $token = $Tokenarr['access_token'];
                //缓存
//                $expire = $Tokenarr['expires_in'] ? intval($Tokenarr['expires_in'])-10 : 10;
//                $this->setCache($authname,$token,$expire);
                //返回
                return $token;
            }
            return false;
        }
    }

    /**
     * 获取缓存
     * @param $cachename
     * @param $value
     * @param $expired
     * @return mixed
     * @update-time: 2017-07-14 15:21:07
     * @author: 王亚雄
     */
    protected function setCache($cachename,$value,$expired){
        $data = array(
            'appid'=>$cachename,
            'access_token'=>$value,
            'expires_in'=>$expired,
            'create_time'=>time()
        );
        $num =  M('wx_token','pigcms_')->add($data);
        return $num;
    }

    /**
     * 获取缓存
     * @param $cachename
     * @return null
     * @update-time: 2017-07-14 15:21:26
     * @author: 王亚雄
     */
    protected function getCache($cachename){
        $info = M('wx_token','pigcms_')->where('appid="%s"',$cachename)->order('create_time desc')->find();
        if(!$info) return null;
        if(time()-$info['create_time']>$info['expires_in']) return null;
        return $info['access_token'];
    }


    /*
     * 向用户推送模板消息
     * */
    public function send_template_message($data){
        $access_token = $this->getToken();
        $url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$access_token;
        $res=$this->https_request($url,$data);
//        print_r($res);exit;
        return $res;
    }

    /*
     * 向用户单独推送消息
     * */
    public function send_user_message($data){
        $access_token = $this->getToken();
        $url = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token='.$access_token;
        $res=$this->https_request($url,$data);
        return $res;
    }

    /*
     * 客服聊天记录查询接口
     * */
    public function watch_message($data){
        $access_token = $this->getToken();
        $url = 'https://api.weixin.qq.com/customservice/msgrecord/getrecord?access_token='.$access_token;
        $res=$this->https_request($url,$data);
        return $res;
    }

    /*
     * 查询客服人员基本信息
     * */
    public function get_service_list(){
        $access_token = $this->getToken();
        $url = 'https://api.weixin.qq.com/cgi-bin/customservice/getkflist?access_token='.$access_token;
        $res=$this->https_request($url);
        return $res;
    }

    /*
     * 用户和客服之间创建一个对话
     * */
    public function create_service_conversation($data){
        $access_token = $this->getToken();
        $url = 'https://api.weixin.qq.com/customservice/kfsession/create?access_token='.$access_token;
        $res=$this->https_request($url,$data);
        return $res;
    }
}