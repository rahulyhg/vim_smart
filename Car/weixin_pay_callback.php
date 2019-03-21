<?php

    header('content-type:text/html;charset=utf-8');//设置全局编码

    //设置模式
    define('APP_DEBUG',true);//开发调试模式
    //define('APP_DEBUG',false);//生产模式


    $_GET['m'] = 'Wxorg'; // 绑定Wx_org模块到当前入口文件
    $_GET['c'] = 'Wxcallback'; // 绑定Wx_callback控制器到当前入口文件
    $_GET['a'] = 'weixin_callback'; // 绑定weixin_callback为默认的操作方法

    require './ThinkPHP/ThinkPHP.php';

?>

      
    
           
            
