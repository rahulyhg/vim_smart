<?php
/**
 * 
 * 交友调用类
 * 
 * 小猪系统调用文件 require 'jiaoyou/cms.php';
 * 
*/	

//加载调用类
$jiaoyou=new jiaoyou();

class jiaoyou
{

    var $appid="";
    
    var $key=""; 
    
    var $url="http://im.hi0818.com";  //交友请求网站
    
    
    /*--加载类时执行程序--*/
    function __construct()  
    {
       //从数据库取appid key
       $appid = D("Config")->where("`name`='im_appid'")->find();
       $key = D("Config")->where("`name`='im_key'")->find();
       
       //配置appid
       if($appid)
       {
            $this->appid = $appid['value'];
       }
       
       //配置key
       if($key)
       {
            $this->key = $key['value'];
       }
    }
    

    //合成密匙
    function key($open_id)
    {
        //组合字符串
        $key="open_id=".$open_id."&appid=" . $this->appid . "&key=" . $this->key;
        
        //生成md5
        return md5($key);
    }  
    
    
    // type参数说明 ：  0为首页 1为指定聊天 2客服页
    function url($openid,$type="0")
    {
         
        //生成openid加key
        $url=$this->url . "?open_id=" . $openid . "&appid=" . $this->appid ."&key=" . $this->key($openid);
        

        if($type == 0)
        {
            return $url;
        }
        if($type == 1)
        {
            return $url."#to_open_id_";
        }
        if($type == 2)
        {
            return $url."#server_";
        }
    }
    
    
    // 获取 appid 和 key 的域名
    function access()
    {
        $url=$this->url . "/access.php";
        
        return $url;
    }
       
}
?>