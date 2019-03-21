<?php
define('ROOT_URL' ,         $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME']);  //网站根路径
define('IS_WECHAT',         strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ?true:false);//粗略判断请求是否来自微信端
define('ADAUTO_LOGIN_TOKEN','asdasdasda33sda22sdaa11'); //微信端管理员自动登陆所需token

define('SUPPER_ADMIN_NAME','admin');//超级管理员名称






/**项目相关常量**/
/**
 * 加密解密密钥区域开始
 */
define('CRYPT_KEY_COUPON','afrgrmkladg6'); //优惠卷生成二维码加密key
define('COOKIE_LOGIN_KEY','asdgfggh4124dg');//cookie登陆密匙

/**
 * 加密解密密钥区域结束
 */

//数据分页 每页显示条数
define('LIST_ROWS',10);

/**
 * 微信推送消息模板
 */
define('WXMSG_TPL_SPTX',get_wxmsg_tpl(20));//流程审批提醒模板ID








/**
 * 系统配置区开始
 */

//从数据库中获取微信配置信息
define('WXCONFIG_DB_TOKEN',             get_cfg('wechat_token'));
define('WXCONFIG_DB_ENCODINGAESKEY',    get_cfg('wechat_encodingaeskey'));
define('WXCONFIG_DB_APPID',             get_cfg('wechat_appid'));
define('WXCONFIG_DB_APPSECRET',         get_cfg('wechat_appsecret'));


//微信api配置
//邻钱科技测试号
define('WXCONFIG_VHKJ_TEST_TOKEN',                  'b2f40d6bf18aa46351bdda56f024b646');            //token
define('WXCONFIG_VHKJ_TEST_ENCODINGAESKEY',         'noqRDMYpdWVolAfmfVQplQrbdpZIVtyiIOalAZBEVwS'); //ENCODINGAESKEY
define('WXCONFIG_VHKJ_TEST_APPID',                  'wx4c9f2ead52f08cdf');                          //APPID
define('WXCONFIG_VHKJ_TEST_APPSECRET',              'd783884fafd63721d3acfc912daacb74');            //APPSECRET


//配置表分组GID vhi_car.smart_config 字段 gid
define('CFG_GID_CAR',30);//停车场配置分组ID
                        //其它的不太清楚，暂时不写



//停车场配置
define('PARK_FEE_Q1H',5.00);//每小时的停车费用
define('PARK_FEE_FREETIME',1800);//免费停车时间单位【秒】

/**
 * 系统配置区结束
 */








/**
 * 数据表字段状态开始
 */

//优惠券状态 数据表：vhi_car.smart_coupon 字段：is_valid 默认为 COUPON__STATUS_VALID
define('COUPON_STATUS_OVERDUE',    0); //过期
define('COUPON_STATUS_VALID',      1); //有效的
define('COUPON_STATUS_INVALID',    2); //无效的
define('COUPON_STATUS_TOAUDIT',    3); //需要审核的
define('COUPON_STATUS_DESTROY',    4); //已作废

//活动类型 数据表：vhi_smart_alpha.smart_activity  字段：cp_type 默认为 CPTYPE_MONEY_FREE
define('CPTYPE_MONEY_FREE',1);      //现金减免
define('CPTYPE_TIME_FREE',2);       //时间减免
define('CPTYPE_ALL_FREE',3);        //全都免

/**
 * 数据表字段状态结束
 */



//新版权限控制
define('SUPER_ADMIN','admin');
define('DELIMITER',',');



/**
 * 其他配置开始
 */

//登陆COOKIE有效时间
define('COOKIE_VALID_TIME',30*24*60*60);

/**
 * 其他配置结束
 */


