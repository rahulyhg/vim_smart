<?php
/*
 * Wap端配置文件
 *
 */
return array(
	// 关闭字段缓存
	'DB_FIELDS_CACHE'=>false,
	/*默认模板*/
	'DEFAULT_THEME' => 'default',
	/*外卖优惠券加密密钥，任意长度加密串*/
    'WAIMAI_COUPON_KEY' => '56314720b2e6d1d56859b6a80bb8016e',
	/*URL配置*/
	'URL_MODEL' => '0',
	'DEFAULT_MODULE' => 'Home',
	'WEB_DOMIAN'=>'http://www.hdhsmart.com',



    'TMPL_ACTION_ERROR'     =>
        strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false
            ? 'jumptpl/error' //微信端使用的默认错误模板
            : THINK_PATH.'Tpl/dispatch_jump.tpl', //电脑端使用TP默认模板
    'TMPL_ACTION_SUCCESS'   =>
        strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false
            ? 'jumptpl/success' //微信端使用的默认成功模板
            : THINK_PATH.'Tpl/dispatch_jump.tpl', //电脑端使用TP默认模板

    /****首页管理***/
    'WEB_TITLE'=> '',
    'WEB_FOOTER'=>'',


);
?>