<?php
/**
 * Created by 智能门禁.
 * User: pastime
 * Date: 16/6/15
 * Time: 下午5:55
 */
class Yeelink{
    //用户API KEY
    public $apikey;
    //设备ID
    public $deviceid;
    //传感器ID
    public $sensorid;
    //开关状态
    //public $status =0;
    /**
     * 门禁开关 constructor.
     * @param $apikey
     * @param $deviceid
     * @param $sensorid
     * @param $status
     */
    public function __construct($apikey="",$deviceid=""){
        $this->apikey = $apikey;
        $this->deviceid = $deviceid;
        //$this->sensorid = $sensorid;
        //$this->status = $status;
    }

    //查询设备及传感器是否存在
    public function saveSensor($ac_control,$sensorid='',$ac_type){
        //查询传感器
        if($sensorid!=""){
            $method = "PUT";
            $url = 'http://api.yeelink.net/v1.1/device/' . $this->deviceid . '/sensor/' . $sensorid ;
            $json = '{
              "title":"'.$ac_control['ac_name'].'",
              "about":"'.$ac_control['ac_desc'].'",
              "tags":"开关"
            }';
        }else{
            $method = "POST";
            $url = 'http://api.yeelink.net/v1.1/device/'.$this->deviceid.'/sensors/';
            $json = '{
              "type":"'.$ac_type['actype_value'].'",
              "title":"'.$ac_control['ac_name'].'",
              "about":"'.$ac_control['ac_desc'].'",
              "tags":"开关"
            }';
        }
        $curl = curl_init();
        //创建传感器
        // echo "deviceid". $this->deviceid."---".$sensorid."---apikey:". $this->apikey."json:".$json;
        // exit;
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_HTTPHEADER, Array("U-ApiKey:" . $this->apikey));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST,$method);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
        $data = curl_exec($curl);
        curl_close($curl);
        //print_r($data);
        $data_arr=json_decode($data);
        if(is_object($data_arr)){
            $data_arr=(array)$data_arr;
        }
        return $data_arr;
    }
    //编辑传感器开关
    public function yeelink($sensorid='',$status=''){
        //创建传感器
        $url = 'http://api.yeelink.net/v1.1/device/' . $this->deviceid . '/sensor/' . $sensorid . '/datapoints/';
        $curl = curl_init();
        //0关闭,1开启
        $json = '{
                "value":' .$status. '
                }';
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_HTTPHEADER, Array("U-ApiKey:" . $this->apikey));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
        $data = curl_exec($curl);
        curl_close($curl);
        //print_r($data);
        return $data;
    }

    //查询传感器状态
    public function getStatus($sensorid=''){
        //创建传感器
        $url = 'http://api.yeelink.net/v1.1/device/' . $this->deviceid . '/sensor/' . $sensorid . '/datapoint/';
        $curl = curl_init();
        //0关闭,1开启
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_HTTPHEADER, Array("U-ApiKey:" . $this->apikey));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        $data = curl_exec($curl);
        curl_close($curl);
        //print_r($data);
        $data_arr=json_decode($data);
        if(is_object($data_arr)){
            $data_arr=(array)$data_arr;
        }
        return $data_arr['value'];	//返回状态
    }

    public function  delSensor($sensorid=''){
        $url = 'http://api.yeelink.net/v1.1/device/' . $this->deviceid . '/sensor/' . $sensorid ;
        $method = "DELETE";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_HTTPHEADER, Array("U-ApiKey:" . $this->apikey));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST,$method);
        $data = curl_exec($curl);
        curl_close($curl);
        //print_r($data);
        $data_arr=json_decode($data);
        if(is_object($data_arr)){
            $data_arr=(array)$data_arr;
        }
        return $data_arr;
    }
}