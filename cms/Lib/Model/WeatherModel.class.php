<?php

/**
 * @author zhukeqin
 * Class WeatherModel
 * 天气缓存控制器
 */
class WeatherModel extends Model{

    private $appkey = false; //申请的聚合天气预报APPKEY

    private $cityUrl = 'http://v.juhe.cn/weather/citys'; //城市列表API URL

    private $weatherUrl = 'http://v.juhe.cn/weather/index'; //根据城市请求天气API URL

    private $weatherIPUrl = 'http://v.juhe.cn/weather/ip'; //根据IP地址请求天气API URL

    private $weatherGeoUrl = 'http://v.juhe.cn/weather/geo'; //根据GPS坐标获取天气API URL

    private $forecast3hUrl = 'http://v.juhe.cn/weather/forecast3h'; //获取城市天气3小时预报API URL

    public function __construct()
    {
        parent::__construct();
        $this->nowdaytime=strtotime(date('Y-m-d'));
        $this->appkey="c3db663d074070884b93d092c456cb82";
    }

    /**
     * @author zhukeqin
     * @param $where
     * 取得符合要求的单条数据
     */
    public function get_weather_one($where){
        $return=$this->where($where)->order('`weather_id` ASC')->find();
        //dump(M()->_sql());
        return $return;

    }
    /**
     * @author zhukeqin
     * @param $where
     * @param $sort 排序方式
     * 取得符合要求的数据组
     */
    public function  get_weather_list($where,$sort='`weather_id` ASC'){
        return $this->where($where)->order($sort)->select();

    }

    public function get_weather_date($time){
        if(empty($time)) $time=$this->nowdaytime;
        if(is_string($time))$time=strtotime($time);
        $time=strtotime(date('Y-m-d',$time));
        $weather_time=$time<$this->nowdaytime?$time:$this->nowdaytime;
        $data=$this->get_weather_one(array('weather_time'=>$weather_time));
        if(empty($data)){
            $return=$this->add_weather_one();
            if($return){
                return $return;
            }
            $data=$this->get_weather_one(array('weather_time'=>$time));
        }
        return json_decode($data['weather_data']);
    }


    /**
     * @author zhukeqin
     * @return string
     * 获取最新的天气信息，限制实例调用
     */
    protected function add_weather_one(){
        $content = $this->getWeather('武汉');
        if($content){
            if($content['error_code']=='0'){
                $data=array(
                    'weather_data'=>json_encode($content['result']),
                    'weather_time'=>$this->nowdaytime,
                    'update_time'=>$this->nowdaytime,
                );
                $this->data($data)->add();
                return '';
            }else{
                return $content['error_code'].":".$content['reason'];
            }
        }else{
            return "请求失败";
        }
    }
    /**
    * 获取天气预报支持城市列表
    * @return array
    */
    public function getCitys(){
        $params = 'key='.$this->appkey;
        $content = $this->juhecurl($this->cityUrl,$params);
        return $this->_returnArray($content);
    }

    /**
     * 根据城市名称/ID获取详细天气预报
     * @param string $city [城市名称/ID]
     * @return array
     */
    public function getWeather($city){
        $paramsArray = array(
            'key'   => $this->appkey,
            'cityname'  => $city,
            'format'    => 2
        );
        $params = http_build_query($paramsArray);
        $content = $this->juhecurl($this->weatherUrl,$params);
        return $this->_returnArray($content);
    }

    /**
     * 根据IP地址获取当地天气预报
     * @param string $ip [IP地址]
     * @return array
     */
    public function getWeatherByIP($ip){
        $paramsArray = array(
            'key'   => $this->appkey,
            'ip'  => $ip,
            'format'    => 2
        );
        $params = http_build_query($paramsArray);
        $content = $this->juhecurl($this->weatherIPUrl,$params);
        return $this->_returnArray($content);
    }

    /**
     * 根据GPS坐标获取当地的天气预报
     * @param  string $lon [经度]
     * @param  string $lat [纬度]
     * @return array
     */
    public function getWeatherByGeo($lon,$lat){
        $paramsArray = array(
            'key'   => $this->appkey,
            'lon'  => $lon,
            'lat'   => $lat,
            'format'    => 2
        );
        $params = http_build_query($paramsArray);
        $content = $this->juhecurl($this->weatherGeoUrl,$params);
        return $this->_returnArray($content);
    }

    /**
     * 获取城市三小时预报
     * @param  string $city [城市名称]
     * @return array
     */
    public function getForecast($city){
        $paramsArray = array(
            'key'   => $this->appkey,
            'cityname'  => $city,
            'format'    => 2
        );
        $params = http_build_query($paramsArray);
        $content = $this->juhecurl($this->forecast3hUrl,$params);
        return $this->_returnArray($content);
    }

    /**
     * 将JSON内容转为数据，并返回
     * @param string $content [内容]
     * @return array
     */
    public function _returnArray($content){
        return json_decode($content,true);
    }

    /**
     * 请求接口返回内容
     * @param  string $url [请求的URL地址]
     * @param  string $params [请求的参数]
     * @param  int $ipost [是否采用POST形式]
     * @return  string
     */
    public function juhecurl($url,$params=false,$ispost=0){
        $httpInfo = array();
        $ch = curl_init();

        curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );
        curl_setopt( $ch, CURLOPT_USERAGENT , 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36' );
        curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 30 );
        curl_setopt( $ch, CURLOPT_TIMEOUT , 30);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
        if( $ispost )
        {
            curl_setopt( $ch , CURLOPT_POST , true );
            curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
            curl_setopt( $ch , CURLOPT_URL , $url );
        }
        else
        {
            if($params){
                curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params );
            }else{
                curl_setopt( $ch , CURLOPT_URL , $url);
            }
        }
        $response = curl_exec( $ch );
        if ($response === FALSE) {
            //echo "cURL Error: " . curl_error($ch);
            return false;
        }
        $httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
        $httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
        curl_close( $ch );
        return $response;
    }
}



?>