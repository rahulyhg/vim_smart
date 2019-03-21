<?php
class TestAction extends BaseAction
{
    public function index()
    {
    	$mod = new Model();
    	$sql = "SELECT COUNT( r.mer_id ) AS count, r.mer_id FROM  `pigcms_merchant_user_relation` as r INNER JOIN `pigcms_user` as u ON r.openid=u.openid GROUP BY r.mer_id";
    	$res = $mod->query($sql);
    	foreach ($res as $r) {
    		D('Merchant')->where(array('mer_id' => $r['mer_id']))->save(array('fans_count' => $r['count']));
    	}
    }
    
    public function check()
    {
    	$configs =  array (
    			'site_name' =>
    			array (
    					'name' => 'site_name',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '1',
    					'sort' => '12',
    					'status' => '1',
    			),
    			'site_url' =>
    			array (
    					'name' => 'site_url',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '1',
    					'sort' => '11',
    					'status' => '1',
    			),
    			'site_logo' =>
    			array (
    					'name' => 'site_logo',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '1',
    					'sort' => '10',
    					'status' => '1',
    			),
    			'site_qq' =>
    			array (
    					'name' => 'site_qq',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '1',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'site_email' =>
    			array (
    					'name' => 'site_email',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '1',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'site_icp' =>
    			array (
    					'name' => 'site_icp',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '1',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'seo_title' =>
    			array (
    					'name' => 'seo_title',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '1',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'seo_keywords' =>
    			array (
    					'name' => 'seo_keywords',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '1',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'seo_description' =>
    			array (
    					'name' => 'seo_description',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '1',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'site_footer' =>
    			array (
    					'name' => 'site_footer',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '1',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'live_service_appid' =>
    			array (
    					'name' => 'live_service_appid',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '0',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'live_service_appkey' =>
    			array (
    					'name' => 'live_service_appkey',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '0',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'live_service_have' =>
    			array (
    					'name' => 'live_service_have',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '0',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'merchant_verify' =>
    			array (
    					'name' => 'merchant_verify',
    					'tab_id' => 'base',
    					'tab_name' => '基础配置',
    					'gid' => '6',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'store_verify' =>
    			array (
    					'name' => 'store_verify',
    					'tab_id' => 'base',
    					'tab_name' => '基础配置',
    					'gid' => '6',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'meal_pic_size' =>
    			array (
    					'name' => 'meal_pic_size',
    					'tab_id' => 'base',
    					'tab_name' => '基础配置',
    					'gid' => '5',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'meal_pic_width' =>
    			array (
    					'name' => 'meal_pic_width',
    					'tab_id' => 'base',
    					'tab_name' => '基础配置',
    					'gid' => '5',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'meal_pic_height' =>
    			array (
    					'name' => 'meal_pic_height',
    					'tab_id' => 'base',
    					'tab_name' => '基础配置',
    					'gid' => '5',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'store_open_meal' =>
    			array (
    					'name' => 'store_open_meal',
    					'tab_id' => 'base',
    					'tab_name' => '基础配置',
    					'gid' => '5',
    					'sort' => '1',
    					'status' => '1',
    			),
    			'store_open_group' =>
    			array (
    					'name' => 'store_open_group',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '4',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'store_open_payone' =>
    			array (
    					'name' => 'store_open_payone',
    					'tab_id' => 'base',
    					'tab_name' => '基础配置',
    					'gid' => '5',
    					'sort' => '2',
    					'status' => '1',
    			),
    			'store_open_paythree' =>
    			array (
    					'name' => 'store_open_paythree',
    					'tab_id' => 'base',
    					'tab_name' => '基础配置',
    					'gid' => '5',
    					'sort' => '2',
    					'status' => '1',
    			),
    			'group_pic_size' =>
    			array (
    					'name' => 'group_pic_size',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '4',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'group_pic_width' =>
    			array (
    					'name' => 'group_pic_width',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '4',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'group_pic_height' =>
    			array (
    					'name' => 'group_pic_height',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '4',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'group_verify' =>
    			array (
    					'name' => 'group_verify',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '4',
    					'sort' => '1',
    					'status' => '1',
    			),
    			'wechat_qrcode' =>
    			array (
    					'name' => 'wechat_qrcode',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '8',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'now_city' =>
    			array (
    					'name' => 'now_city',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '0',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'group_page_row' =>
    			array (
    					'name' => 'group_page_row',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '4',
    					'sort' => '4',
    					'status' => '1',
    			),
    			'group_page_val' =>
    			array (
    					'name' => 'group_page_val',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '4',
    					'sort' => '3',
    					'status' => '1',
    			),
    			'wechat_name' =>
    			array (
    					'name' => 'wechat_name',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '8',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'wechat_sourceid' =>
    			array (
    					'name' => 'wechat_sourceid',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '8',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'wechat_id' =>
    			array (
    					'name' => 'wechat_id',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '8',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'wechat_appid' =>
    			array (
    					'name' => 'wechat_appid',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '8',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'wechat_appsecret' =>
    			array (
    					'name' => 'wechat_appsecret',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '8',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'wechat_token' =>
    			array (
    					'name' => 'wechat_token',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '8',
    					'sort' => '0',
    					'status' => '0',
    			),
    			'pay_alipay_open' =>
    			array (
    					'name' => 'pay_alipay_open',
    					'tab_id' => 'alipay',
    					'tab_name' => '支付宝支付',
    					'gid' => '7',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'pay_alipay_name' =>
    			array (
    					'name' => 'pay_alipay_name',
    					'tab_id' => 'alipay',
    					'tab_name' => '支付宝支付',
    					'gid' => '7',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'pay_alipay_pid' =>
    			array (
    					'name' => 'pay_alipay_pid',
    					'tab_id' => 'alipay',
    					'tab_name' => '支付宝支付',
    					'gid' => '7',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'pay_alipay_key' =>
    			array (
    					'name' => 'pay_alipay_key',
    					'tab_id' => 'alipay',
    					'tab_name' => '支付宝支付',
    					'gid' => '7',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'pay_tenpay_open' =>
    			array (
    					'name' => 'pay_tenpay_open',
    					'tab_id' => 'tenpay',
    					'tab_name' => '财付通支付',
    					'gid' => '7',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'pay_tenpay_partnerid' =>
    			array (
    					'name' => 'pay_tenpay_partnerid',
    					'tab_id' => 'tenpay',
    					'tab_name' => '财付通支付',
    					'gid' => '7',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'pay_tenpay_partnerkey' =>
    			array (
    					'name' => 'pay_tenpay_partnerkey',
    					'tab_id' => 'tenpay',
    					'tab_name' => '财付通支付',
    					'gid' => '7',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'pay_yeepay_open' =>
    			array (
    					'name' => 'pay_yeepay_open',
    					'tab_id' => 'yeepay',
    					'tab_name' => '银行卡支付（易宝支付）',
    					'gid' => '7',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'pay_yeepay_merchantaccount' =>
    			array (
    					'name' => 'pay_yeepay_merchantaccount',
    					'tab_id' => 'yeepay',
    					'tab_name' => '银行卡支付（易宝支付）',
    					'gid' => '7',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'pay_yeepay_merchantprivatekey' =>
    			array (
    					'name' => 'pay_yeepay_merchantprivatekey',
    					'tab_id' => 'yeepay',
    					'tab_name' => '银行卡支付（易宝支付）',
    					'gid' => '7',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'pay_yeepay_merchantpublickey' =>
    			array (
    					'name' => 'pay_yeepay_merchantpublickey',
    					'tab_id' => 'yeepay',
    					'tab_name' => '银行卡支付（易宝支付）',
    					'gid' => '7',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'pay_yeepay_yeepaypublickey' =>
    			array (
    					'name' => 'pay_yeepay_yeepaypublickey',
    					'tab_id' => 'yeepay',
    					'tab_name' => '易宝支付',
    					'gid' => '7',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'pay_yeepay_productcatalog' =>
    			array (
    					'name' => 'pay_yeepay_productcatalog',
    					'tab_id' => 'yeepay',
    					'tab_name' => '银行卡支付（易宝支付）',
    					'gid' => '7',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'pay_allinpay_open' =>
    			array (
    					'name' => 'pay_allinpay_open',
    					'tab_id' => 'allinpay',
    					'tab_name' => '银行卡支付（通联支付）',
    					'gid' => '7',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'pay_allinpay_merchantid' =>
    			array (
    					'name' => 'pay_allinpay_merchantid',
    					'tab_id' => 'allinpay',
    					'tab_name' => '银行卡支付（通联支付）',
    					'gid' => '7',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'pay_allinpay_merchantkey' =>
    			array (
    					'name' => 'pay_allinpay_merchantkey',
    					'tab_id' => 'allinpay',
    					'tab_name' => '银行卡支付（通联支付）',
    					'gid' => '7',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'pay_chinabank_open' =>
    			array (
    					'name' => 'pay_chinabank_open',
    					'tab_id' => 'chinabank',
    					'tab_name' => '银行卡支付（网银在线）',
    					'gid' => '7',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'pay_chinabank_account' =>
    			array (
    					'name' => 'pay_chinabank_account',
    					'tab_id' => 'chinabank',
    					'tab_name' => '银行卡支付（网银在线）',
    					'gid' => '7',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'pay_chinabank_key' =>
    			array (
    					'name' => 'pay_chinabank_key',
    					'tab_id' => 'chinabank',
    					'tab_name' => '银行卡支付（网银在线）',
    					'gid' => '7',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'pay_weixin_open' =>
    			array (
    					'name' => 'pay_weixin_open',
    					'tab_id' => 'weixin',
    					'tab_name' => '微信支付',
    					'gid' => '7',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'pay_weixin_appid' =>
    			array (
    					'name' => 'pay_weixin_appid',
    					'tab_id' => 'weixin',
    					'tab_name' => '微信支付',
    					'gid' => '7',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'pay_weixin_mchid' =>
    			array (
    					'name' => 'pay_weixin_mchid',
    					'tab_id' => 'weixin',
    					'tab_name' => '微信支付',
    					'gid' => '7',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'pay_weixin_key' =>
    			array (
    					'name' => 'pay_weixin_key',
    					'tab_id' => 'weixin',
    					'tab_name' => '微信支付',
    					'gid' => '7',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'pay_weixin_appsecret' =>
    			array (
    					'name' => 'pay_weixin_appsecret',
    					'tab_id' => 'weixin',
    					'tab_name' => '微信支付',
    					'gid' => '7',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'reply_pic_size' =>
    			array (
    					'name' => 'reply_pic_size',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '9',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'reply_pic_width' =>
    			array (
    					'name' => 'reply_pic_width',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '9',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'reply_pic_height' =>
    			array (
    					'name' => 'reply_pic_height',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '9',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'meal_score' =>
    			array (
    					'name' => 'meal_score',
    					'tab_id' => 'base',
    					'tab_name' => '基础配置',
    					'gid' => '5',
    					'sort' => '0',
    					'status' => '0',
    			),
    			'group_score' =>
    			array (
    					'name' => 'group_score',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '4',
    					'sort' => '0',
    					'status' => '0',
    			),
    			'login_weixin_appid' =>
    			array (
    					'name' => 'login_weixin_appid',
    					'tab_id' => 'login_weixin',
    					'tab_name' => 'Web微信登录',
    					'gid' => '10',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'login_weixin_appsecret' =>
    			array (
    					'name' => 'login_weixin_appsecret',
    					'tab_id' => 'login_weixin',
    					'tab_name' => 'Web微信登录',
    					'gid' => '10',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'user_score_get' =>
    			array (
    					'name' => 'user_score_get',
    					'tab_id' => 'user_score',
    					'tab_name' => '积分策略',
    					'gid' => '2',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'weixin_login_bind' =>
    			array (
    					'name' => 'weixin_login_bind',
    					'tab_id' => 'reg_login',
    					'tab_name' => '注册登录',
    					'gid' => '2',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'share_ticket' =>
    			array (
    					'name' => 'share_ticket',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '0',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'share_dated' =>
    			array (
    					'name' => 'share_dated',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '0',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'merchant_qrcode_indexsort' =>
    			array (
    					'name' => 'merchant_qrcode_indexsort',
    					'tab_id' => 'base',
    					'tab_name' => '基础配置',
    					'gid' => '6',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'pay_offline_open' =>
    			array (
    					'name' => 'pay_offline_open',
    					'tab_id' => 'offline',
    					'tab_name' => '线下支付',
    					'gid' => '7',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'group_around_range' =>
    			array (
    					'name' => 'group_around_range',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '4',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'meal_around_range' =>
    			array (
    					'name' => 'meal_around_range',
    					'tab_id' => 'base',
    					'tab_name' => '基础配置',
    					'gid' => '5',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'merchant_around_range' =>
    			array (
    					'name' => 'merchant_around_range',
    					'tab_id' => 'base',
    					'tab_name' => '基础配置',
    					'gid' => '6',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'im_appid' =>
    			array (
    					'name' => 'im_appid',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '0',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'im_appkey' =>
    			array (
    					'name' => 'im_appkey',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '0',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'wx_token' =>
    			array (
    					'name' => 'wx_token',
    					'tab_id' => 'weixinmp',
    					'tab_name' => '商家公众号绑定配置',
    					'gid' => '6',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'wx_appsecret' =>
    			array (
    					'name' => 'wx_appsecret',
    					'tab_id' => 'weixinmp',
    					'tab_name' => '商家公众号绑定配置',
    					'gid' => '6',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'wx_appid' =>
    			array (
    					'name' => 'wx_appid',
    					'tab_id' => 'weixinmp',
    					'tab_name' => '商家公众号绑定配置',
    					'gid' => '6',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'wx_componentverifyticket' =>
    			array (
    					'name' => 'wx_componentverifyticket',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '0',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'wx_encodingaeskey' =>
    			array (
    					'name' => 'wx_encodingaeskey',
    					'tab_id' => 'weixinmp',
    					'tab_name' => '商家公众号绑定配置',
    					'gid' => '6',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'site_merchant_logo' =>
    			array (
    					'name' => 'site_merchant_logo',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '1',
    					'sort' => '9',
    					'status' => '1',
    			),
    			'site_phone' =>
    			array (
    					'name' => 'site_phone',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '1',
    					'sort' => '8',
    					'status' => '1',
    			),
    			'wechat_encodingaeskey' =>
    			array (
    					'name' => 'wechat_encodingaeskey',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '8',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'wechat_encode' =>
    			array (
    					'name' => 'wechat_encode',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '8',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'wechat_follow_txt_url' =>
    			array (
    					'name' => 'wechat_follow_txt_url',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '8',
    					'sort' => '-2',
    					'status' => '1',
    			),
    			'wechat_follow_txt_txt' =>
    			array (
    					'name' => 'wechat_follow_txt_txt',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '8',
    					'sort' => '-1',
    					'status' => '1',
    			),
    			'is_open_oauth' =>
    			array (
    					'name' => 'is_open_oauth',
    					'tab_id' => 'base',
    					'tab_name' => '基础配置',
    					'gid' => '6',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'wechat_follow_show_open' =>
    			array (
    					'name' => 'wechat_follow_show_open',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '8',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'classify_verify' =>
    			array (
    					'name' => 'classify_verify',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '11',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'is_open_weidian' =>
    			array (
    					'name' => 'is_open_weidian',
    					'tab_id' => 'base',
    					'tab_name' => '基础配置',
    					'gid' => '6',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'wap_redirect' =>
    			array (
    					'name' => 'wap_redirect',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '1',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'wap_home_show_classify' =>
    			array (
    					'name' => 'wap_home_show_classify',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '11',
    					'sort' => '1',
    					'status' => '1',
    			),
    			'home_share_show_open' =>
    			array (
    					'name' => 'home_share_show_open',
    					'tab_id' => 'promote',
    					'tab_name' => '商家推广',
    					'gid' => '6',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'home_share_txt' =>
    			array (
    					'name' => 'home_share_txt',
    					'tab_id' => 'promote',
    					'tab_name' => '商家推广',
    					'gid' => '6',
    					'sort' => '-1',
    					'status' => '1',
    			),
    			'print_format' =>
    			array (
    					'name' => 'print_format',
    					'tab_id' => 'print',
    					'tab_name' => '小票打印机',
    					'gid' => '5',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'print_server_key' =>
    			array (
    					'name' => 'print_server_key',
    					'tab_id' => 'print',
    					'tab_name' => '小票打印机',
    					'gid' => '5',
    					'sort' => '1',
    					'status' => '1',
    			),
    			'print_server_topdomain' =>
    			array (
    					'name' => 'print_server_topdomain',
    					'tab_id' => 'print',
    					'tab_name' => '小票打印机',
    					'gid' => '5',
    					'sort' => '1',
    					'status' => '1',
    			),
    			'site_show_footer' =>
    			array (
    					'name' => 'site_show_footer',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '1',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'pay_weixin_client_cert' =>
    			array (
    					'name' => 'pay_weixin_client_cert',
    					'tab_id' => 'weixin',
    					'tab_name' => '微信支付',
    					'gid' => '7',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'pay_weixin_client_key' =>
    			array (
    					'name' => 'pay_weixin_client_key',
    					'tab_id' => 'weixin',
    					'tab_name' => '微信支付',
    					'gid' => '7',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'flseo_description' =>
    			array (
    					'name' => 'flseo_description',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '11',
    					'sort' => '1',
    					'status' => '1',
    			),
    			'flseo_keywords' =>
    			array (
    					'name' => 'flseo_keywords',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '11',
    					'sort' => '2',
    					'status' => '1',
    			),
    			'flseo_title' =>
    			array (
    					'name' => 'flseo_title',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '11',
    					'sort' => '3',
    					'status' => '1',
    			),
    			'platform_get_merchant_percent' =>
    			array (
    					'name' => 'platform_get_merchant_percent',
    					'tab_id' => 'base',
    					'tab_name' => '基础配置',
    					'gid' => '6',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'weixin_buy_follow_wechat' =>
    			array (
    					'name' => 'weixin_buy_follow_wechat',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '8',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'system_version' =>
    			array (
    					'name' => 'system_version',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '0',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'web_category_show_limit' =>
    			array (
    					'name' => 'web_category_show_limit',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '1',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'merchant_qrcode_fans' =>
    			array (
    					'name' => 'merchant_qrcode_fans',
    					'tab_id' => 'base',
    					'tab_name' => '基础配置',
    					'gid' => '6',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'is_open_click_fans' =>
    			array (
    					'name' => 'is_open_click_fans',
    					'tab_id' => 'base',
    					'tab_name' => '基础配置',
    					'gid' => '6',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'activity_sign_term' =>
    			array (
    					'name' => 'activity_sign_term',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '14',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'activity_pic_size' =>
    			array (
    					'name' => 'activity_pic_size',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '14',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'activity_pic_width' =>
    			array (
    					'name' => 'activity_pic_width',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '14',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'activity_pic_height' =>
    			array (
    					'name' => 'activity_pic_height',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '14',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'meal_page_row' =>
    			array (
    					'name' => 'meal_page_row',
    					'tab_id' => 'base',
    					'tab_name' => '基础配置',
    					'gid' => '5',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'meal_page_val' =>
    			array (
    					'name' => 'meal_page_val',
    					'tab_id' => 'base',
    					'tab_name' => '基础配置',
    					'gid' => '5',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'activity_score_scale' =>
    			array (
    					'name' => 'activity_score_scale',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '14',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'sms_key' =>
    			array (
    					'name' => 'sms_key',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '15',
    					'sort' => '12',
    					'status' => '1',
    			),
    			'sms_sign' =>
    			array (
    					'name' => 'sms_sign',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '15',
    					'sort' => '12',
    					'status' => '1',
    			),
    			'sms_place_order' =>
    			array (
    					'name' => 'sms_place_order',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '15',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'sms_success_order' =>
    			array (
    					'name' => 'sms_success_order',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '15',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'sms_finish_order' =>
    			array (
    					'name' => 'sms_finish_order',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '15',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'sms_cancel_order' =>
    			array (
    					'name' => 'sms_cancel_order',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '15',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'sms_server_topdomain' =>
    			array (
    					'name' => 'sms_server_topdomain',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '15',
    					'sort' => '12',
    					'status' => '1',
    			),
    			'level_onoff' =>
    			array (
    					'name' => 'level_onoff',
    					'tab_id' => 'level_manage',
    					'tab_name' => '会员等级管理',
    					'gid' => '2',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'group_level_onoff' =>
    			array (
    					'name' => 'group_level_onoff',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '4',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'wap_site_footer' =>
    			array (
    					'name' => 'wap_site_footer',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '1',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'live_service_type' =>
    			array (
    					'name' => 'live_service_type',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '0',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'activity_open' =>
    			array (
    					'name' => 'activity_open',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '14',
    					'sort' => '1',
    					'status' => '1',
    			),
    			'group_alias_name' =>
    			array (
    					'name' => 'group_alias_name',
    					'tab_id' => '0',
    					'tab_name' => '',
    					'gid' => '4',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'meal_alias_name' =>
    			array (
    					'name' => 'meal_alias_name',
    					'tab_id' => 'base',
    					'tab_name' => '基础配置',
    					'gid' => '5',
    					'sort' => '0',
    					'status' => '1',
    			),
    			'group_print_format' =>
    			array (
    					'name' => 'group_print_format',
    					'tab_id' => 'print',
    					'tab_name' => '小票打印机',
    					'gid' => '5',
    					'sort' => '0',
    					'status' => '1',
    			),
    	);
		foreach($configs as $key => $value){
			D('Config')->where(array('name' => $key))->save(array('tab_id' => $value['tab_id'], 'tab_name' => $value['tab_name'], 'gid' => $value['gid'], 'sort' => $value['sort'], 'status' => $value['status']));
		}
    }
}