<?php
return array(
	//'配置项'=>'配置值'
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  '127.0.0.1', // 服务器地址
    'DB_NAME'               =>  'vhi_smart',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'root',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'smart_',    // 数据库表前缀
    //'DB_CHARSET'            =>  'utf8mb4',   //数据库编码
    
    'URL_MODEL'             =>  '0',    //设置URL模式

   //'APP_DEBUG'             =>true,
    
    //显示页面跟踪信息
    //'SHOW_PAGE_TRACE' => true,
    
    //网站根域名111
    'WEB_DOMAIN' => 'http://www.pignewpay.com/Car',


     'LOAD_EXT_FILE'=>'define',//Common下自动加载文件名,'function'文件名为默认自动加载不要写入

    //自定义模板替换规则
    'TMPL_PARSE_STRING'  =>array(

        '__HOME_JS__'      =>  '/Car/Home/Public/js/',
        '__HOME_CSS__'     => '/Car/Home/Public/css/',
        '__HOME_IMG__'     => '/Car/Home/Public/images/',
        '__HOME_ASSETS__'     => '/Car/Home/Public/assets/',

        '__ADMIN_JS__'      =>  '/Car/Admin/Public/js/',
        '__ADMIN_CSS__'     => '/Car/Admin/Public/css/',
        '__ADMIN_IMG__'     => '/Car/Admin/Public/images/',
        '__ADMIN_ASSETS__'     => '/Car/Admin/Public/assets/',

    ),

    //默认模板设置
    // 默认错误跳转对应的模板文件
    'TMPL_ACTION_ERROR'     =>
        strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false
        ? 'Common@Tpl/wechat/error' //微信端使用的默认错误模板
        : THINK_PATH.'Tpl/dispatch_jump.tpl', //电脑端使用TP默认模板
    'TMPL_ACTION_SUCCESS'   =>
        strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false
            ? 'Common@Tpl/wechat/success' //微信端使用的默认错误模板
            : THINK_PATH.'Tpl/dispatch_jump.tpl', //电脑端使用TP默认模板
    'WEB_TITLE'=>'',
    'WEB_FOOTER'=>'汇得行（中国）集团有限公司',
    // 关闭字段缓存
    'DB_FIELDS_CACHE'=>false,
);