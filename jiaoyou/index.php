<?php
/**
 * 
 * 交友接收端 根据参数，反回需要的内容
 * 
 * 
*/

require "mysql.php";  //加载数据库
require "api.php";  //加载类库


//获得参数
$cat= @$_GET['cat'];

//获得指定open_id信息
if($cat == "info")
{
    //读取个人信息
    $open_info=get_open_info(@$_POST['open_id']);
    
    exit(json_encode($open_info));
}

//获得客服列表
if($cat == "server")
{
    $server=server_list(@$_POST['id']);
    
    exit(json_encode($server));
}

?>