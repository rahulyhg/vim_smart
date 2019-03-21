<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/17
 * Time: 10:45
 * @author: 王亚雄
 */

class WechatModel
{
    public $wechat ;
    public $access_token;
    public $msg_id = 0;

    const TPLID_LCSPTX = "xLpzcYPX-Kgwsx6Ym3sHjp_CmZhn_n65_-v6CxC4gAc";//流程审批提醒
    //const TPLID_LCSPTX = "KSHPJt-SuUV-IQ7v7pcztQPwm6JJfAAEqAZV3Ms_xr8";//老公众号流程审批提醒
    const TPLID_WYGLTZ = "3f7Aj8ek27CxcZ_13hPl64uE3BNZkIMevtz606kdbTc";//物业管理通知
    //const TPLID_WYGLTZ = "ut2GVrbHm0H09LWjpb6TvxeZQZKtTXoDGQJrMniA";//老公众号物业管理通知

    public function __construct()
    {
        //http://www.hdhsmart.com/admin.php?g=System&c=Config&a=index&gid=8
        //在数据库中获取微信配置
        $names = array(
            'wx_appid',
            'wx_appsecret',
            'wx_encodingaeskey',
            'wx_token'
        );
        $data = M('config')->where(array('name'=>array('in',$names)))->select();
        $wxcfg = array();
        foreach($data as $k=>$v){
            $wxcfg[$v['name']] = $v['value'];
        }
        $options = array(
            'token'=>$wxcfg['wx_token'],
            'encodingaeskey'=>$wxcfg['wx_encodingaeskey'],
            'appid'=>$wxcfg['wx_appid'],
            'appsecret'=>$wxcfg['wx_appsecret'],
            'debug'=>'',
            'logcallback'=>''
        );
        $this->wechat =   new TPWechat($options);
        $this->options = $options;
        $this->access_token = $this->wechat->checkAuth();
        $this->use_cache = $this->wechat->use_cache;

    }


    //微信网页授权
    public function oauth($scope="snsapi_base"){
        //跳转信息
        $callback = curPageURL();//授权服务器回跳链接（当前页面链接）
        $state='123';
        $url = $this->wechat->getOauthRedirect($callback,$state,$scope);
        if(!$code = I('get.code')){//code 不存在进行跳转
            redirect($url);
        }else{//code存在,使用code获取用户资料
            $oauth_info = $this->wechat->getOauthAccessToken();
            //dump($oauth_info);exit();
            return $oauth_info;
        }

    }

    /**
     * 单发模板消息
     * @param $openid openid
     * @param $tpl_id 模板id
     * @param $url 点击消息跳转地址
     * @param $data 模板数据
     * @param string $color 颜色
     * @return array|bool
     * 标记 123
     */
    public function send_tpl_message($openid,$tpl_id,$url,$data,$color="",$type='1'){
        $data = array(
            "touser"=>$openid,
            "template_id"=>$tpl_id,
            "url"=>$url,
            "topcolor"=>$color?:"#FF0000",
            "data"=>$data,
            "type"=>$type
        );

        $re = $this->wechat->sendTemplateMessage($data);
        if(!$re){
            $re['errcode'] = $this->getErrCode();
            $re['errmsg'] = $this->getErrMsg();
        }else{
            $this->setErrCode($re['errcode']);
            $this->setErrMsg($re['errmsg']);
        }

        $this->save_log($data);

        return $re;
    }


    /**
     * 群发
     * @param $openid openid 数组，多个openid
     * @param $tpl_id 模板id
     * @param $url 点击消息跳转地址
     * @param $data 模板数据
     * @param string $color 颜色
     * @return array|bool
     */

    public function send_tpl_messages($openids,$tpl_id,$url="",$data,$color=""){

        set_time_limit(300);//超时时间
        static $res = array();
        if(!$openids) return $res;
        $err_openids = [];
        foreach($openids as $key=>$openid){
            $re = $this->send_tpl_message($openid,$tpl_id,$url,$data,$color);
            $res[]  = $re;
            if($re['errcode']==40001){//token 失效的情况下
                $err_openids[] = $openid;
            }
        }
        if($err_openids){
            $this->resetAuth();//重置token
            $this->send_tpl_messages($err_openids,$tpl_id,$url,$data,$color);
        }

    }

    /**
     * @param $openids
     * @param $tpl_id
     * @param string $url
     * @param $data
     * @param string $color
     * @param string $ctr_name //开关名称 给set ctr 使用
     * @return array
     */
    public function send_tpl_messages2($openids,$tpl_id,$url="",$data,$color="",$ctr_name=""){
        set_time_limit(300);//超时时间
        static $res = array();
        if(!$openids) return $res;

        if($ctr_name){// 创建 更新 消息开关
            $on = $this->set_ctr($openids,$tpl_id,$url,$data,$color,$ctr_name);
            if($on==0) return $res;
        }
        foreach($openids as $key=>$openid){
            //TODO::调试注释，上线时取消
            //sleep(1.5);
            $re = $this->send_tpl_message($openid,$tpl_id,$url,$data,$color); //



            //$re = array('errcode'=>0);
            if($re['errcode']!==40001){
                unset($openids[$key]);
            }
            if($ctr_name){// 创建 更新 消息开关
                $on = $this->set_ctr($openids,$tpl_id,$url,$data,$color,$ctr_name);
                if($on==0) return $res;
            }

            $res[]  = $re;
        }

        if($openids){
            $this->resetAuth();//重置token
            $this->send_tpl_messages2($openids,$tpl_id,$url,$data,$color,$ctr_name);
        }else{
            return $res;
        }

    }



    /**
     * 创建群发控制器，用来控制其暂停、继续发送
     * @param $openids
     * @param $tpl_id
     * @param $url
     * @param $data
     * @param $color
     * @param $ctr_name
     * @return mixed
     */
    public function set_ctr($openids,$tpl_id,$url,$data,$color,$ctr_name){
        $model = M('wxmsg_ctr','pigcms_');
        $ctr = $this->get_ctr($ctr_name);
        if($ctr){
            $res = $model->where('name="%s"',$ctr_name)->setField('openids',serialize($openids));
        }else{
            $ctr = array(
                'openids'=>serialize($openids),
                'tpl_id'=>$tpl_id,
                'url'=>$url,
                'data'=>serialize($data),
                'color'=>$color,
                'on'=>1,
                'name'=>$ctr_name,
            );
            $num = $model->add($ctr);
        }
        return $ctr['on'];
    }

    //获取控制器数据
    public function get_ctr($ctr_name){
        $model = M('wxmsg_ctr','pigcms_');
        $ctr = $model->where('name="%s"',$ctr_name)->order('id desc')->find();
        if($ctr){
            $ctr['openids'] = unserialize($ctr['openids']);
            $ctr['data'] = unserialize($ctr['data']);
        }

        return $ctr;
    }


    /**
     * 客服消息-图文
     * @param $openid
     * @param $title 标题
     * @param $digest 摘要
     * @param $url 链接
     * @param $pic 图片
     */
    public function send_kf_news($openid,$title,$digest,$url,$pic){
        $data = array(
            'touser' => $openid,
            'msgtype' => 'news',
            'news' => array(
                'articles'=>array(
                    array(
                        'title'=>$title,
                        'description'=>$digest,
                        'url'=>$url,
                        'picurl'=>$pic,
                    )
                )
            ),
        );
        return $this->wechat->sendCustomMessage($data);
    }

    /**
     * 客服消息-纯文本
     * @param $openid
     * @param $content 内容
     */
    public function send_kf_text($openid,$content){
        $data = array(
            'touser' => $openid,
            'msgtype' => 'text',
            'text' => array(
                'content'=>$content
            ),

        );
        return $this->wechat->sendCustomMessage($data);
    }

    public function getUserList(){
        return $this->wechat->getUserList();
    }

    public function getUserInfo($openid){
        return $this->wechat->getUserInfo($openid);
    }



    /**
     * 保存消息发送日志
     * @param $openid
     * @param $data
     * @param int $msg_id
     */
    public function save_log($data){
        //判断是否为微信端
        define('IS_WECHAT',strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ?true:false);
        //获取发送者名称
        if(IS_WECHAT){//如果是微信端则
            $suser =  session('user.openid')
                ?M('user','pigcms_')->where('openid="%s"',session('user.openid'))->getField('nickname')
                :"";
        }else{//pc端则
            $suser = session('admin_id')
                ?M('admin','pigcms_')->where('id=%d',session('admin_id'))->getField('realname')
                :"";
        }
        //接收者名称
        $ruser = M('user','pigcms_')->where('openid="%s"',$data['touser'])->getField('nickname')?:"";
        $add_data = array(
            'msg_id'=>$this->msg_id?:0,
            'openid'=>$data['touser'],
            'errcode'=>$this->getErrCode(),
            'errmsg'=>$this->getErrMsg(),
            'tpl_id'=>$data['template_id'],
            'create_time'=>date("Y-m-d H:i:s"),
            'suser'=>$suser?:0,
            'ruser'=>$ruser?:0,
            'tpl_info'=>serialize($data),
        );
        $re =M('wxmsg_log','pigcms_')->add($add_data);
        return $re;

    }

    //https://api.weixin.qq.com/cgi-bin/template/get_all_private_template?access_token=ACCESS_TOKEN

    /**
     * 获取所有的模板信息
     * @return bool|mixed
     */
    public function get_all_private_template(){
        $url = 'https://api.weixin.qq.com/cgi-bin/template/get_all_private_template?access_token=' . $this->access_token;
        $result = $this->wechat->http_get($url);
        if ($result)
        {
            $json = json_decode($result,true);
            if (!$json || !empty($json['errcode'])) {
                $this->setErrCode($json['errcode']);
                $this->setErrMsg($json['errmsg']);
                return false;
            }
            return $json;
        }
        return false;
    }

    //获取所有的模板信息 优先使用缓存
    public function get_all_private_template_use_cache(){
        $cachename = $this->options['appid'] . '_all_private_template';
        if($tpls = S($cachename)){
            return $tpls;
        }else{
            $tpls = $this->get_all_private_template();
            if($tpls){
                S($cachename,$tpls,60*60*24*30);//缓存30天
            }
            return $tpls;
        }
    }



    /**
     * @param $tpl_id
     * 获取模板信息
     */
    public function get_private_template($tpl_id=""){
        $all_private_template = $this->get_all_private_template_use_cache();
        foreach($all_private_template['template_list'] as $row){
            if($row['template_id']==$tpl_id){
                return $row;
            }
        }
        return false;
    }
    /**
     * 获取微信模板id信息
     * @author zhukeqin
     * @param $id
     * @return mixed
     */
    public function get_wxmsg_tpl($id,$col="tempid"){
        $tpl =  M('tempmsg','pigcms_')->where('id=%d',$id)->getField($col);
        return $tpl;
    }
    /**
     * 创建html
     * @param $content_tpl
     * @param $data
     */
    public function create_msg_html($content_tpl,$data){
        $content_tpl = explode(PHP_EOL,$content_tpl);
        $html = "<div>";
        foreach($content_tpl as $key=>$row){
            $html .= "<p style='color:'>$row</p>";
        }
        $html .= "</div>";
        //填充文字
        $search = array_map(function($v){
            return "{{".$v.".DATA}}";
        },array_keys($data));
        $replace =array_column($data,'value');
        $html = str_replace($search, $replace, $html);
        $html = preg_replace('/{{.*?}}/','',$html);
        return $html;
    }


    //获取错误码
    public function getErrCode(){
        return $this->wechat->errCode;
    }
    //获取错误描述
    public function getErrMsg(){
        return $this->wechat->errMsg;
    }

    public function setErrCode($errcode){
        $this->wechat->errCode = $errcode;
    }

    public function setErrMsg($errmsg){
        $this->wechat->errMsg = $errmsg;
    }

    public function set_msg_id($msg_id){
        $this->msg_id = $msg_id;
    }

    //删除access_token 缓存
    public function resetAuth(){
        return $this->wechat->resetAuth();
    }

    /**- 商家中心navbar-header pull-left
     * @author zhukeqin
     * @param $mid 商户id
     * @param $openid
     * @param $money 金额  单位分
     * @return mixed
     *
     */
    public function wechatCash($mid,$openid,$money)
    {
        $mid =$mid?:'1488333212';
        //证书路径
        $apiclient_cert = './conf/cert/mer_cert/'.$mid.'/apiclient_cert.pem';
        $apiclient_key = './conf/cert/mer_cert/'.$mid.'/apiclient_key.pem';

        $user_info=M('user')->where(array('openid'=>$openid))->find();

        $url = "https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack";
        $arr['mch_billno'] = $mid . date('YmdHis') . rand(1000, 9999);
        $arr['nick_name'] = '汇得行';
        $arr['send_name'] = '汇得行';
        $arr['re_openid'] = $openid?:$_SESSION['openid'];
        $arr['total_amount'] = $money;
        $arr['total_num'] = '1';//普通红包个数只能为1
        $arr['wishing'] = '汇得行诚意圣诞礼活动';
        $arr['act_name'] = '汇得行诚意圣诞礼活动';
        $arr['remark'] = $user_info['nickname']?:'匿名用户';
        $arr['wxappid'] = 'wxa5172ba00401e26e';
        $arr['mch_id'] = $mid;
        $arr['client_ip'] = $_SERVER['REMOTE_ADDR'];
        $arr['scene_id'] = 'PRODUCT_2';//红包活动指明
        import('@.ORG.redpack');//引进现金红包类
        $redpack = new Redpack();
        $arr['nonce_str'] = $redpack->createNoncestr();//获取随机数
        $arr['sign'] = $redpack->getSign($arr);//获取签名
        $xml = $redpack->arrayToXml($arr);//将数组转化成xml格式请求
        $result = $redpack->postXmlSSLCurl($xml, $url, $second = 30, $apiclient_cert, $apiclient_key, $rootca);
        $RES = $redpack->xmlToArray($result);
        return $RES;

    }

    /**
     * @author zhukeqin
     * @return array|bool
     * 获取jssdk分享用参数
     */
    public function getJsSign(){
        $url=$this->curPageURL();
        return $this->wechat->getJsSign($url);
    }

    /**
     * @author zhukeqin
     * @return string
     * 获取完整url链接
     */
    public function curPageURL()
    {
        $pageURL = 'http';

        if ($_SERVER["HTTPS"] == "on")
        {
            $pageURL .= "s";
        }
        $pageURL .= "://";

        if ($_SERVER["SERVER_PORT"] != "80")
        {
            $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        }
        else
        {
            $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        }
        return $pageURL;
    }
}


?>

