<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/17
 * Time: 10:45
 * @author: 王亚雄
 */
namespace Org\Weixinpay;
use TPWechat;
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
        $data = M('config','pigcms_')->where(array('name'=>array('in',$names)))->select();
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
     */
    public function send_tpl_message($openid,$tpl_id,$url,$data,$color=""){
        $data = array(
            "touser"=>$openid,
            "template_id"=>$tpl_id,
            "url"=>$url,
            "topcolor"=>$color?:"#FF0000",
            "data"=>$data
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
        }else{
            return $res;
        }

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

    /**
     * 发送通知
     * @param $msg_id 消息id
     */
    public function send_group_msg($msg_id){
        $this->msg_id = $msg_id;//记录msg_id
        ini_set('max_execution_time', '0');//取消超时限制
        $msg_model = M('wxmsg','pigcms_');
        $msg_info = $msg_model->where('id=%d',$msg_id)->find();
        //获取发送公司
        if($msg_info['company_ids']==0){

            if($msg_info['village_ids']){

                $company_ids = M('company')->where('village_id=%d',$msg_info['village_ids'])->select();

            }else{

                $company_ids = M('company')->select();

            }

            $company_ids = array_column($company_ids,'company_id');//转一纬数组

        }else{

            $company_ids = $msg_info['company_ids'];

        }
        //获取社区名称
        $village_name = M('house_village')->where('village_id=%d',$msg_info['village_ids'])->getField('village_name');
        //获取用户
        $map['ub.company_id'] = array('in',$company_ids);

        $openids = M('user')->alias('u')
            ->field('u.openid')
            ->join('left join __HOUSE_VILLAGE_USER_BIND__ ub on u.uid = ub.uid')
            ->where($map)
            ->select();
        $openids = array_column($openids,'openid');
        //测试
//        $openids = array(
//            'ohgcf0jY6c8Rnj8hgkJw8mcVpOR8'
//        );
        //if(count($openids)>20) return false;//测试
        $tpl_id = self::TPLID_WYGLTZ;
        $data = array(
            'first'=>array(
                'value'=>"尊敬的".$village_name."业主",
                'color'=>"#029700",
            ),
            'keyword1'=>array(
                'value'=>$msg_info['title'],
                'color'=>"#000000",
            ),
            'keyword2'=>array(
                'value'=>date("Y-m-d H:i"),
                'color'=>"#000000",
            ),
            'keyword3'=>array(
                'value'=>$msg_info['digest'],
                'color'=>"#000000",
            ),
            'keyword4'=>array(
                'value'=>"点击查看详情",
                'color'=>"#000000",
            ),
        );
        $url = C('WEB_DOMAIN') . '/wap.php?g=Wap&c=House&a=view_msg&msg_id=' . $msg_id;
        return $this->send_tpl_messages($openids,$tpl_id,$url,$data);

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
                ?'smart_' . M('admin')->where('ad_id=%d',session('admin_id'))->getField('ad_name')
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
}


?>

