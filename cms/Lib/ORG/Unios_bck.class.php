<?php
/*
 * 友联云平台接口类
 * @time 2016.12.1
 * @author 祝君伟
 */
class UniosBck{
    public $card_id;
    public $urlToken;
    public $commandToken;

    public function __construct($act,$pin,$urlToken,$commandToken,$url)
    {
        $this->act=$act;     //动作号
        $this->pin=$pin;     //执行参数
        $this->urlToken =$urlToken;     //URLToken
        $this->commandToken =$commandToken;  //commandToken
        $this->url =$url;
    }
    /*向接口传递JSON串
     * @return JSON字符串
     * @waring 如果服务器错误，有可能返回一个空串
     * */
    public function Linkhickey(){
        $ylurl = $this->url.$this->urlToken.'/invocations';
        $curl = curl_init();
        $time = date("c");//ISO 8601 格式的日期
        $sv = date("B");
        $str = explode("+",$time);
        $time = $str[0].".".$sv."+0800";
        $post_data = $this->commandToken;
        $json = '{
                      "eventDate": "'.$time.'",
                      "updateState": false,
                      "metadata": {},
                      "initiator": "REST",
                      "initiatorId": "admin",
                      "target": "Assignment",
                      "targetId": "",
                      "commandToken": "'.$post_data.'",
                      "parameterValues": {
                      "act":'."$this->pin".',
                      "pin":'."$this->act".'
                      },
                      "status": "Pending"
                    }';
        curl_setopt($curl, CURLOPT_URL, $ylurl);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_HTTPHEADER, Array("Authorization: Basic YWRtaW46MTIzNDU2Nzg5YWJj\nOrigin: http://unios.cc\nAccept-Encoding: gzip, deflate\nAccept-Language: en-US,en;q=0.8,zh-CN;q=0.6,zh;q=0.4\nX-Sitewhere-Tenant: unios1234567890\nContent-Type: application/json\nCookie: JSESSIONID=B52828ACD5955F429C9E7E3EA4944559; i18next=zh\nConnection: keep-alive"));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_ENCODING, 'gzip,deflate');
        curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
        $data = curl_exec($curl);
        curl_close($curl);
        return $data;
    }

}