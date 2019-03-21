<?php
/*
 * 后台配置文件
 *
 * @  Writers    Jaty
 * @  BuildTime  2014/11/05 15:43
 * 
 */
return array(
	/*URL配置*/
	'URL_MODEL' => '0',
	//'LAYOUT_ON' => 'true',//启用布局
	'LAYOUT_NAME' => 'layout',
	'ADMIN_CSS_URL' => '/Car/Admin/Public/css/',//后台模板css样式公共路径
	'ADMIN_JS_URL' => '/Car/Admin/Public/js/',//后台模板js公共路径
	'ADMIN_IMG_URL' => '/Car/Admin/Public/images/',//后台模板图片公共路径
	'ADMIN_ASSETS_URL' => '/Car/Admin/Public/assets/',//后台模板bootstrap框架样式公共路径
	// 关闭字段缓存
	'DB_FIELDS_CACHE'=>false,
	'VAR_FILTERS' => 'arr_htmlspecialchars',

	//默认错误跳转对应的模板文件
	'TMPL_ACTION_ERROR' => 'core/Tpl/message.php',
	'TMPL_ACTION_ERROR_NEW' => 'core/Tpl/message_new.php',
	//默认成功跳转对应的模板文件
	'TMPL_ACTION_SUCCESS' => 'core/Tpl/message.php',
	'TMPL_ACTION_SUCCESS_NEW' => 'core/Tpl/message_new.php',
	'WEB_DOMAIN'=>'http://www.hdhsmart.com',
    //'SHOW_PAGE_TRACE' =>true,

	//session 时间设置
	/*'SESSION_OPTIONS'         =>  array(
		'name'                =>  'system',                    //设置session名
		'expire'              =>  3600*24*10,                      //SESSION保存10天
		'use_trans_sid'       =>  1,                               //跨页传递
		'use_only_cookies'    =>  0,                               //是否只开启基于cookies的session的会话方式
	),*/
);
?>