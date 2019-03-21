<?php
/**
 * Created by PhpStorm.
 * author: zhukeqin
 * Date: 2018/3/24
 * Time: 9:01
 * 阿里云短信方法类
 */
use Aliyun\Core\Config;
use Aliyun\Core\Profile\DefaultProfile;
use Aliyun\Core\DefaultAcsClient;
use Aliyun\Api\Sms\Request\V20170525\SendSmsRequest;
//use Aliyun\Api\Sms\Request\V20170525\SendBatchSmsRequest;
use Aliyun\Api\Sms\Request\V20170525\QuerySendDetailsRequest;

class Sms_aliyunModel extends Model{
    static $acsClient = null;
    function __construct()
    {
        //包含相关类
        require(LIB_PATH.'ORG/sms/sms_aliyun/vendor/autoload.php');
        //parent::__construct();
        Config::load();
        //产品名称:云通信流量服务API产品
        $this->product = "Dysmsapi";

        $this->domain = "dysmsapi.aliyuncs.com";

        $this->accessKeyId = "LTAIX5jgMNGiDZWb"; // AccessKeyId

        $this->accessKeySecret = "X6EA1IkJ8DRrmzrmPCGsUOcLqp6vLU"; // AccessKeySecret

        // 暂时不支持多Region
        $this->region = "cn-hangzhou";

        // 服务结点
        $this->endPointName = "cn-hangzhou";
    }
    /**
     * 取得AcsClient
     *
     * @return DefaultAcsClient
     */
    public function getAcsClient() {


        if(static::$acsClient == null) {

            //初始化acsClient,暂不支持region化
            $profile = DefaultProfile::getProfile($this->region, $this->accessKeyId, $this->accessKeySecret);

            // 增加服务结点
            DefaultProfile::addEndpoint($this->endPointName, $this->region, $this->product, $this->domain);

            // 初始化AcsClient用于发起请求
            $acsClient = new DefaultAcsClient($profile);
        }
        return $acsClient;
    }
    /**
     * 发送短信 快递邮件
     * @return stdClass
     */
    public function sendSms_expressage($phone,$number,$express,$address) {

        // 初始化SendSmsRequest实例用于设置发送短信的参数
        $request = new SendSmsRequest();

        // 必填，设置短信接收号码
        $request->setPhoneNumbers($phone);

        // 必填，设置签名名称，应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
        $request->setSignName("汇得行智慧助手");

        // 必填，设置模板CODE，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
        $request->setTemplateCode("SMS_127167401");

        // 可选，设置模板参数, 假如模板中存在变量需要替换则为必填项
        $request->setTemplateParam(json_encode(array(  // 短信模板中字段的值
            "number"=>$number,
            "express"=>$express,
            "address"=>$address
        ), JSON_UNESCAPED_UNICODE));

        // 发起访问请求
        $acsResponse = $this->getAcsClient()->getAcsResponse($request);

        return $acsResponse;
    }
    /**
     * 发送短信 验证码
     * @return stdClass
     */
    public function sendSms_authcode($phone,$vcode,$sendto='') {

        // 初始化SendSmsRequest实例用于设置发送短信的参数
        $request = new SendSmsRequest();

        // 必填，设置短信接收号码
        $request->setPhoneNumbers($phone);

        // 必填，设置签名名称，应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
        $request->setSignName("汇得行智慧助手");

        // 必填，设置模板CODE，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
        $request->setTemplateCode("SMS_133977022");

        // 可选，设置模板参数, 假如模板中存在变量需要替换则为必填项
        $request->setTemplateParam(json_encode(array(  // 短信模板中字段的值
            "vcode"=>$vcode
        ), JSON_UNESCAPED_UNICODE));

        // 发起访问请求
        $acsResponse = $this->getAcsClient()->getAcsResponse($request);
        $data=array(
            'mer_id'=>'',
            'store_id'=>'67',
            'uid'=>'0',
            'phone'=>$phone,
            'text'=>$vcode,
            'time'=>time(),
            'sendto'=>$sendto,
            'type'=>'authcode',
            'bizid'=>$acsResponse->BizId);
        if($acsResponse->Code=='OK'){
            $data['status']='0';
            $res = M('sms_record')->add($data);
            return 1;
        }else{
            $data['status']='1';
            $data['remark']=$acsResponse->Code;
            $res = M('sms_record')->add($data);
            return 2;
        }
        //return $acsResponse;
    }
    /**
     * 短信发送记录查询
     * @return stdClass
     */
    public function sendSms_query($phone,$time,$size='1',$page='1',$bizId) {

        // 初始化QuerySendDetailsRequest实例用于设置短信查询的参数
        $request = new QuerySendDetailsRequest();

        // 必填，短信接收号码
        $request->setPhoneNumber($phone);
        //短信发送流水号
        if(!empty($bizId)) {
            $request->setBizId($bizId);
        }

        // 必填，短信发送日期，格式Ymd，支持近30天记录查询
        $day=date('Ymd',$time);
        $request->setSendDate($day);

        // 必填，分页大小
        $request->setPageSize($size);

        // 必填，当前页码
        $request->setCurrentPage($page);


        // 发起访问请求
        $acsResponse = $this->getAcsClient()->getAcsResponse($request);

        return $acsResponse;
    }
}
