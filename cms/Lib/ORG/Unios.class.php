<?php
/*
 * 友联云平台接口类
 * @time 2016.12.1
 * @author 祝君伟
 */
class Unios{
    public $card_id;
    public $urlToken;
    public $commandToken;

    public function __construct($pin,$act,$urlToken,$duration,$url,$delay='')
    {
        $this->act=$act;     //动作号
        $this->pin=$pin;     //执行参数
        $this->urlToken =$urlToken;     //URLToken
        $this->url =$url;
        $this->duration = $duration;
        $this->delay = $delay;
    }
    /*向接口传递JSON串
     * @return JSON字符串
     * @waring 如果服务器错误，有可能返回一个空串
     * */
    public function Linkhickey(){
        $ylurl = $this->url.$this->urlToken.'/invocations';
        $reGetArray = $this->getCommandToken();
        //vd($reGetArray);exit;
        $commandToken = $reGetArray['results'][0]['command']['token'];
        //return $ylurl;
        $json ='{
          "metadata": {},
          "initiator": "REST",
          "initiatorId": "admin",
          "target": "Assignment",
          "targetId": "",
          "commandToken": "'.$commandToken.'",
          "parameterValues": {
          "act":'."$this->act".',
          "pin":'."$this->pin".',
          "delay": "",
          "duration": '."$this->duration".'
          },
          "status": "Pending"}';
        $curl = curl_init();
        //return $json;
        curl_setopt($curl, CURLOPT_URL, $ylurl);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        //curl_setopt($curl, CURLOPT_HTTPHEADER, Array("Authorization: Basic YWRtaW46MTIzNDU2Nzg5YWJj\nOrigin: http://unios.cc\nAccept-Encoding: gzip, deflate\nAccept-Language: en-US,en;q=0.8,zh-CN;q=0.6,zh;q=0.4\nX-Sitewhere-Tenant: unios123456789abc\nContent-Type: application/json;"));
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Basic YWRtaW46MTIzNDU2Nzg5QWJj","X-Sitewhere-Tenant: unios123456789abc","Content-Type: application/json;"));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_ENCODING, 'gzip,deflate');
        curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
        $data = curl_exec($curl);
        curl_close($curl);
        return $data;
    }

    public function getCommandToken(){
        $TokenUrl = $this->url.$this->urlToken.'/invocations';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $TokenUrl);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Basic YWRtaW46MTIzNDU2Nzg5QWJj","X-Sitewhere-Tenant: unios123456789abc"));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl, CURLOPT_ENCODING, 'gzip,deflate');
        $data = curl_exec($curl);
        curl_close($curl);
        return json_decode($data,true);
        //return $TokenUrl;
    }

    public function stabilizeGetToken(){
        $TokenUrl = 'http://unios.cc/console/api/specifications/f7d95bc9-daf0-4a06-8903-727f2050d77d/commands';
        //return $TokenUrl;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $TokenUrl);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Basic YWRtaW46MTIzNDU2Nzg5QWJj","X-Sitewhere-Tenant: unios123456789abc"));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl, CURLOPT_ENCODING, 'gzip,deflate');
        $data = curl_exec($curl);
        curl_close($curl);
        return $data;
        //return json_decode($data,true);
    }

}