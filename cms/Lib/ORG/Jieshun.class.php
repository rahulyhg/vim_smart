<?php


class Jieshun{

    protected $api_token;   //第三方token
    protected $businesserCode=880002701002185;  //商户码
    protected $login_url='http://www.jslife.com.cn/jsaims/login';   //登录地址
    protected $function_url='http://www.jslife.com.cn/jsaims/as';   //具体功能地址
    protected $signKey='ba95949943eb724942688378091e11cf';  //签名

    //构造方法初始化接口参数
    function __construct(){
        //先进行第三方身份校验登录
        //调用接口(登录验证，获取token)
            $url =$this->login_url;
            $curl = curl_init();
            $post_data = "cid={$this->businesserCode}&v=2&usr={$this->businesserCode}&psw={$this->businesserCode}";
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HEADER, 0);
            //curl_setopt($curl, CURLOPT_HTTPHEADER, Array("cid:880002701002185\nv:2\nusr:880002701002185\n:psw:880002701002185"));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
            $data = curl_exec($curl);
            curl_close($curl);

            $data= json_decode($data ,true); //将json对象转为数组

            if($token=$data['token']){
                $this->api_token=$token;
            }else{
                return array('api_error_no'=>1);   //登录失败
                exit;
            }
    }


    //根据车牌号查询停车场内是否存在相关车辆
    public function use_api_is_in($car_no){
        $api_p = '{
                "serviceId":"3c.pay.querycarbycarno",
                "requestType":"DATA",
                "attributes":{
                     "parkCode": "0000002265",
                     "carNo": "'.$car_no.'"
                     }
                 }';

        $sn= strtoupper( md5($api_p.$this->signKey) ); //对p进行加密后，将加密的字段进行大写转换

        $url=$this->function_url;

        $post_data = "cid={$this->businesserCode}&v=2&tn={$this->api_token}&sn={$sn}&p={$api_p}";

        return $this->use_curl($url, $post_data);
    }


    //查询月卡车信息
    public function use_api_yueka_info($car_no){
        $api_p = '{
                "serviceId":"3c.base.querypersonsbycar",
                "requestType":"DATA",
                "attributes":{
                     "areaCode": "0000002265",
                     "carNo": "'.$car_no.'"
                     }
                 }';

        $sn= strtoupper( md5($api_p.$this->signKey)); //对p进行加密后，将加密的字段进行大写转换

        $url=$this->function_url;

        $post_data = "cid={$this->businesserCode}&v=2&tn={$this->api_token}&sn={$sn}&p={$api_p}";
        return $this->use_curl($url, $post_data);
    }


    //通过车牌号生成第三方订单
    public function api_make_order($car_no){

        $api_p = '{
            "serviceId":"3c.pay.createorderbycarno",
            "requestType":"DATA",
            "attributes":{
                "businesserCode": "'.$this->businesserCode.'",
                "parkCode": "0000002265",
                "orderType": "VNP",
                "carNo": "'.$car_no.'"
            }
        }';


        $sn= strtoupper( md5($api_p.$this->signKey)); //对p进行加密后，将加密的字段进行大写转换

        $url=$this->function_url;

        $post_data = "cid={$this->businesserCode}&v=2&tn={$this->api_token}&sn={$sn}&p={$api_p}";
        $order_info = $this->use_curl($url, $post_data);

        return json_decode($order_info,true);
    }


    //通知第三方支付成功(通知成功后在免费时间内对应车辆出场会自动抬杆，所以此方法也称为【通知开门】)
    public function notice_api_pay_ok($order_no){

        //二维码支付订单生通知p
        $api_p = '{
            "serviceId":"3c.pay.notifyorderresult",
            "requestType":"DATA",
            "attributes":{
            "orderNo": "'.$order_no.'",
            "tradeStatus": 0,
            "isCallBack": 0,
            "notifyUrl": "http://www.test.com.cn/jsaims/callBackUrl.Servlet" 
            }
        }';


        $sn= strtoupper( md5($api_p.$this->signKey)); //对p进行加密后，将加密的字段进行大写转换

        $url=$this->function_url;

        $post_data = "cid={$this->businesserCode}&v=2&tn={$this->api_token}&sn={$sn}&p={$api_p}";
        $notice_result_info = $this->use_curl($url, $post_data);

        return json_decode($notice_result_info,true);
    }


    //通过第三方订单编号查询对应第三方订单状态
    public function query_order_status($order_no){

        $api_p = '{
            "serviceId":"3c.pay.queryorder",
            "requestType":"DATA",
            "attributes":{
                "orderNo": "'.$order_no.'"
            }
        }';


        $sn= strtoupper( md5($api_p.$this->signKey)); //对p进行加密后，将加密的字段进行大写转换

        $url=$this->function_url;

        $post_data = "cid={$this->businesserCode}&v=2&tn={$this->api_token}&sn={$sn}&p={$api_p}";
        $notice_result_info = $this->use_curl($url, $post_data);

        return json_decode($notice_result_info,true);
    }


    //通过车牌进行月卡延期
    //参数：停车编号，车牌号，月数，金额（两位小数），开始时间以及结束时间（格式例：2017-01-09）
    public function yueka_add_time($can_no,$month,$money,$newBeginDate,$newEndDate){

        $api_p = '{
            "serviceId":"3c.card.delaybycar",
            "requestType":"DATA",
            "attributes":{
                "parkCode": "0000002265",
                "carNo": "'.$can_no.'",
                "month": '.$month.',
                "money": '.number_format($money,2).',
                "newBeginDate": "'.$newBeginDate.'",
                "newEndDate": "'.$newEndDate.'"
            }
        }'
        ;


        $sn= strtoupper( md5($api_p.$this->signKey)); //对p进行加密后，将加密的字段进行大写转换

        $url=$this->function_url;

        $post_data = "cid={$this->businesserCode}&v=2&tn={$this->api_token}&sn={$sn}&p={$api_p}";
        $query_result_info = $this->use_curl($url, $post_data);

        return json_decode($query_result_info,true);
    }

    //查询车辆进出场时间
    public function car_enter_time($car_no){
        $today_time_start = strtotime("00:00");
        $today_time_end = $today_time_start+86400;
        $today_time_start = date("Y-m-d H:i:s",$today_time_start);
        $today_time_end = date("Y-m-d H:i:s",$today_time_end);
        $api_p = '{
        "serviceId":"3c.park.queryparkout",
        "requestType":"DATA",
        "attributes":{
				"parkCode": "0000002265",
				"carNo": "'.$car_no.'",
				"beginDate": "'.$today_time_start.'",
				"endDate": "'.$today_time_end.'",
                "pageSize": 1,
                "pageIndex": 10
        }
    }';

        $sn= strtoupper( md5($api_p.$this->signKey)); //对p进行加密后，将加密的字段进行大写转换

        $url=$this->function_url;

        $post_data = "cid={$this->businesserCode}&v=2&tn={$this->api_token}&sn={$sn}&p={$api_p}";
        $query_result_info = $this->use_curl($url, $post_data);

        return json_decode($query_result_info,true);
    }


    //封装好了的curl方法
    public function use_curl( $url ,$post_data ){

        $this_header = array("content-type: application/x-www-form-urlencoded;charset=UTF-8");
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl,CURLOPT_HTTPHEADER,$this_header);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
        $data = curl_exec($curl);
        curl_close($curl);

        return $data;
    }

}
