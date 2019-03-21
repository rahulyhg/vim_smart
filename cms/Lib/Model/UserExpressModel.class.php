<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/9
 * Time: 11:51
 * @update-time: 2017-06-09 14:28:33
 * @author: 王亚雄
 */
class UserExpressModel extends Model{
    //数据库名
    protected $table_name = 'express_order';
    //表前缀
    public  $db_tablepre = 'pigcms_';

    protected $eBusinessID = 1288093;
    //APPKEY
    protected $appKey = 'c46ea816-0768-4cda-a697-86d35d535fd0';
    //接口调用地址
    const API_DOMAIN = "http://api.kdniao.cc/Ebusiness/EbusinessOrderHandle.aspx";

    /**
     * 通过物流单号查询快递公司名称及其编号
     * @param $LogisticCode //物流单号
     */
    public function get_express_company_info($LogisticCode){
        $requestData = array(
            'LogisticCode'=>$LogisticCode,//物流单号
        );
        $requestType =  2002;
        //调用接口
        return $this->api_request($requestData,$requestType);
    }

    /**
     * 通过快递单号，查询快递物流信息
     * @param $orderCode 订单编号
     * @param $ShipperCode 快递公司编码
     * @param $LogisticCode 物流单号
     */
    public function get_trail_info($LogisticCode,$ShipperCode,$orderCode=""){
        $requestData = array(
            'LogisticCode'=>$LogisticCode,//物流单号
            'OrderCode'=>$orderCode,//订单编号
            'ShipperCode'=>$ShipperCode,//快递公司编码
        );
        $requestType =  8001;
        //调用接口
        return $this->api_request($requestData,$requestType);
    }


















/******以下为私有方法****************************************************************************************************/
    /**
     * @param $RequestData 请求参数数据包
     * @param $RequestType 请求指令id
     * @param $DataType    数据格式
     */
    protected function api_request($requestData,$requestType,$dataType=2){
        $requestData = json_encode($requestData);
        $dataSign = $this->create_sign($requestData,$this->appKey);//签名
        $eBusinessID = $this->eBusinessID;//电商id
        //数据组装
        $data = array(
            'EBusinessID' => $eBusinessID,
            'RequestType' => $requestType,
            'RequestData' => $requestData,
            'DataType' => $dataType,
            'DataSign'=>$dataSign,
        );

        $result=$this->http_request(self::API_DOMAIN,'post',$data);
        return json_decode($result,true);
    }

    //签名生成
    protected function create_sign($data, $appkey) {
        return urlencode(base64_encode(md5($data.$appkey)));
    }

    //curl封装方法
    protected function http_request($url,$method="get",$param="",$header=array(),$post_file=false){
        $oCurl = curl_init();
        //设置头部信息
        if(!empty($header)&&is_array($header)){
            curl_setopt($oCurl,CURLOPT_HTTPHEADER,$header);
        }


        //區分https和http
        if(stripos($url,"https://")!==FALSE){
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
        }

        //判断php是否支持CURLFile(curl文件上传)
        if (PHP_VERSION_ID >= 50500 && class_exists('\CURLFile')) {
            $is_curlFile = true;
        } else {
            $is_curlFile = false;
            if (defined('CURLOPT_SAFE_UPLOAD')) {
                curl_setopt($oCurl, CURLOPT_SAFE_UPLOAD, false);
            }
        }

        //数据处理
        if (is_string($param)) {
            $strPOST = $param;
        }elseif($post_file) {//
            if($is_curlFile) {
                foreach ($param as $key => $val) {
                    if (substr($val, 0, 1) == '@') {
                        $param[$key] = new \CURLFile(realpath(substr($val,1)));
                    }
                }
            }
            $strPOST = $param;
        } else {
            $aPOST = array();
            foreach($param as $key=>$val){
                $aPOST[] = $key."=".urlencode($val);
            }
            $strPOST =  join("&", $aPOST);
        }
        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );

        //根据请求类型设置curl参数
        switch (strtoupper($method)){
            case "GET" :
                curl_setopt($oCurl, CURLOPT_HTTPGET, true);
                break;
            case "POST":
                curl_setopt($oCurl, CURLOPT_POST,true);
                curl_setopt($oCurl, CURLOPT_POSTFIELDS,$strPOST);
                break;
            case "PUT" :
                curl_setopt ($oCurl, CURLOPT_CUSTOMREQUEST, "PUT");
                curl_setopt($oCurl, CURLOPT_POSTFIELDS,$strPOST);
                break;
            case "DELETE":
                curl_setopt ($oCurl, CURLOPT_CUSTOMREQUEST, "DELETE");
                curl_setopt($oCurl, CURLOPT_POSTFIELDS,$strPOST);
                break;
        }

        $sContent = curl_exec($oCurl);
        $aStatus = curl_getinfo($oCurl);
        curl_close($oCurl);
        if(intval($aStatus["http_code"])==200){
            return $sContent;
        }else{
            return $sContent;
        }




    }
}