<?php
    
    /*
    if(substr($_SERVER['REMOTE_ADDR'],0,10)!='140.207.54'){
        $fp= fopen('./weixin_pay_ok_notice.log', 'a+');
        fwrite($fp,'ip地址不合法，拒绝回调访问');
        exit;
    }
    */
    
    //$apyrecord=new \Home\Controller\PayrecordController();
    //$apyrecord=new PayrecordController();
    //$apyrecord->WeiXin_call_back();
    //
    
    
    //$_SERVER['REMOTE_ADDR'] #正在浏览当前页面用户的 IP 地址。140.207.54.74   140.207.54.75

    //$_SERVER['REMOTE_HOST'] #正在浏览当前页面用户的 主机名。

    $xml = file_get_contents("php://input");
    
    //将xml字串转为数组
    $xml_arr= json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)),true);
    
    //生成文件名唯一的文件(避免重复生成)
    if(!file_exists('./'.$xml_arr['out_trade_no'].'.xml')){
        $fp= fopen('./'.$xml_arr['out_trade_no'].'.xml', 'a+');
        fwrite($fp, $xml);
        fclose($fp);
    }

?>

      
    
           
            
