<?php
return array(
	//'配置项'=>'配置值'
    'URL_MODEL'             =>  '3',    //设置URL模式
    'ADMIN_CSS_URL' => '/Car/Admin/Public/css/',//后台模板css样式公共路径
    'ADMIN_JS_URL' => '/Car/Admin/Public/js/',//后台模板js公共路径
    'ADMIN_IMG_URL' => '/Car/Admin/Public/images/',//后台模板图片公共路径
    'ADMIN_ASSETS_URL' => '/Car/Admin/Public/assets/',//后台模板bootstrap框架样式公共路径

    //加上这句话即可
    'URL_CASE_INSENSITIVE'=>false, //设置debug在关闭的时候，生成的url变成小写的问题
    
    'LAYOUT_ON' => 'true',//启用布局
    'LAYOUT_NAME' => 'layout',//布局名称，默认为layout
    'SUPPER_ADMIN_LIST'=>array('admin'),//后台超级管理员用户名列表(创始人必须出现在此数组)
    'FOUNDER'=>'admin',//系统创始人用户名(创始人仅限一个用户)
    'DB_FIELDS_CACHE'=>false,
);