<?php
//define('UC_CONNECT', 'mysql');
//define('UC_DBHOST', 'rds66568gp739413snzp.mysql.rds.aliyuncs.com');
//define('UC_DBUSER', 'vhi_uc');
//define('UC_DBPW', 'Vhi_uc123');
//define('UC_DBNAME', 'vhi_uc');
//define('UC_DBCHARSET', 'utf8');
//define('UC_DBTABLEPRE', '`vhi_uc`.uc_');
//define('UC_DBCONNECT', '0');
//define('UC_KEY', 'pigcmso2o');
//define('UC_API', 'http://uc.vhi99.com');
//define('UC_CHARSET', 'utf-8');
//define('UC_IP', '');
//define('UC_APPID', '3');
//define('UC_PPP', '20');

define('UC_CONNECT', 'mysql');
define('UC_DBHOST', 'vhkj2015.mysql.rds.aliyuncs.com');
define('UC_DBUSER', 'vhi_uc');
define('UC_DBPW', 'Vhi_uc123');
define('UC_DBNAME', 'vhi_uc');
define('UC_DBCHARSET', 'utf8');
define('UC_DBTABLEPRE', '`vhi_uc`.uc_');
define('UC_DBCONNECT', '0');
define('UC_KEY', 'pigcmso2o');
define('UC_API', 'http://uc.hdhsmart.com');
define('UC_CHARSET', 'utf-8');
define('UC_IP', '');
define('UC_APPID', '3');
define('UC_PPP', '20');
//
//define('UC_CONNECT', 'mysql');
//// mysql 是直接连接的数据库, 为了效率, 建议采用 mysql
//
////数据库相关 (mysql 连接时, 并且没有设置 UC_DBLINK 时, 需要配置以下变量)
//define('UC_DBHOST', 'rds66568gp739413snzp.mysql.rds.aliyuncs.com');			// UCenter 数据库主机
//define('UC_DBUSER', 'vhi_uc');				// UCenter 数据库用户名
//define('UC_DBPW', 'Vhi_uc123');					// UCenter 数据库密码
//define('UC_DBNAME', 'vhi_uc');				// UCenter 数据库名称
//define('UC_DBCHARSET', 'utf8');				// UCenter 数据库字符集
//define('UC_DBTABLEPRE', '`vhi_uc`.uc_');			// UCenter 数据库表前缀
//define('UC_DBCONNECT', '0');
////通信相关
//define('UC_KEY', 'pigcmso2o');				// 与 UCenter 的通信密钥, 要与 UCenter 保持一致
//define('UC_API', 'http://uc.vhi99.com');	// UCenter 的 URL 地址, 在调用头像时依赖此常量
//define('UC_CHARSET', 'utf-8');				// UCenter 的字符集
//define('UC_IP', '121.40.74.90');					// UCenter 的 IP, 当 UC_CONNECT 为非 mysql 方式时, 并且当前应用服务器解析域名有问题时, 请设置此值
//define('UC_APPID', '3');				// 当前应用的 ID
//define('UC_PPP', '20');