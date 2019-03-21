<?php
/**
 * 
 * 交友接收函数 查询本地数据库
 * 
 * 
*/	
    
    //根据Open_id 取个人信息和地理位置
    function get_open_info($openid)
    {
        //判断openid
        if(!empty($openid))
        {
            //查询数据库
            $info=$GLOBALS['db']->select("pigcms_user","openid='$openid'");
               
            return $info;
        }
        else
        {
            return 0;
        }  
    }
    
    
    //获得客服列表
    function server_list($id)
    {   
        //查询数据库  获得客服列表
        $list=$GLOBALS['db']->select("pigcms_customer_service","mer_id=$id","pigcms_id desc",1);
        
        //头像加上域名
        foreach($list as $key=>$temp)
        {
            $list[$key]['head_img'] = "http://" . $_SERVER['HTTP_HOST'] . $temp['head_img'];
        }
        
        return $list;
    }


?>