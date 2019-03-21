<?php
/*系统操作日志类
 * @author 祝君伟
 * @time 2017.1.17
 * */
class syslog
{
    public $url_string;
    public $is_check;


    /*日志通用类文件*/
    public function __construct($opera_name,$table_name,$adminuser)
    {
        $this->url_string = $_SERVER['QUERY_STRING'];
        $this->is_check = $_SERVER['PHP_SELF'];
        $this->opera_name = $opera_name;
        $this->table_name = $table_name;
        $this->adminuser = $adminuser;
    }

    /*检查方法
     *
     * */
    public function get_nowurl(){
        //$url = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
        return  $this->url_string;
    }

    /*根据调用的地方自动生成一维数组
     * return array $data
     * 2017.1.17
     * */
    public function get_data(){
        $url_array = explode("&",$this->url_string);
        $module_name = explode("=",$url_array[1]);
        $action_name = explode("=",$url_array[2]);
        $module_name = $module_name[1];
        $action_name = $action_name[1];
        $data_array = array(
            'opera_name'=>$this->opera_name,
            'module_name'=>$module_name,
            'action_name'=>$action_name,
            'table_name'=>$this->table_name,
            'adminuser'=>$this->adminuser,
            'do_time'=>time(),
            'do_ip'=>$this->getIP()
        );
        return $data_array;
    }


    /*得出精确的IP算法
     *
     *
     * */
    function getIP() {
        if (getenv('HTTP_CLIENT_IP')) {
            $ip = getenv('HTTP_CLIENT_IP');
        }
        elseif (getenv('HTTP_X_FORWARDED_FOR')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        }
        elseif (getenv('HTTP_X_FORWARDED')) {
            $ip = getenv('HTTP_X_FORWARDED');
        }
        elseif (getenv('HTTP_FORWARDED_FOR')) {
            $ip = getenv('HTTP_FORWARDED_FOR');

        }
        elseif (getenv('HTTP_FORWARDED')) {
            $ip = getenv('HTTP_FORWARDED');
        }
        else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }






}