<?php

    header('content-type:text/html;charset=utf-8');//设置全局编码
    require '../vendor/autoload.php';
    //设置模式
    define('APP_DEBUG',true);//开发调试模式
    //define('APP_DEBUG',false);//生产模式

    error_reporting(E_ERROR | E_WARNING | E_PARSE);

    require './ThinkPHP/ThinkPHP.php';