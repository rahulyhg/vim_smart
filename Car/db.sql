--停车系统数据库，表前缀为"smart"


--进出记录表
create table if not exists smart_servicerecord(
	serv_id int(10) unsigned not null auto_increment PRIMARY KEY comment '停车记录id',
	car_no varchar(20) not null comment '车牌号',
	start_time int(10) unsigned not null default 0 comment '车辆入库时间',
	end_time int(10) unsigned not null default 0 comment '车辆出库时间',
	parking_space varchar(64) not null default '' comment '车辆车库位置',
	pay_record int(10) unsigned not null default 0 comment '缴费记录(缴费表id)',
	garage_no varchar(32) not null default '' comment '所在停车场编号',
	out_no tinyint(3) unsigned not null default 0 comment '出口门号，几号出口出去的',
	car_imgs varchar(1024) not null default '' comment '车辆入场抓拍照片',
	car_video varchar(1024) not null default '' comment '车辆入场视频',
	waiter int(10) unsigned not null default 0 comment '服务员编号(管理员表)',
	is_del enum('0','1') not null default '0' comment '是否“逻辑”删除本条记录，默认正常显示',
	key (car_no),
	key (start_time),
	key (end_time),
	key (pay_record),
	key (garage_no)
)engine=Myisam charset=utf8 comment '车辆进出记录表';


--消费记录表(也为订单表)
create table if not exists smart_payrecord(
	pay_id int(10) unsigned not null auto_increment primary key comment '消费记录id',
	user_id int(10) unsigned not null default 0 comment '消费用户(用户id，非系统用户默认未0)',
	payment decimal(10,2) unsigned not null comment '应付金额，精确到2为小数点',
	cp_loan decimal(10,2) unsigned not null comment '优惠金额，精确到2为小数点',
	pay_loan decimal(10,2) unsigned not null default 0 comment '实际支付金额，精确到2为小数点',
	pay_mode tinyint(3) not null default 0 comment '对应支付方式表id',
	serv_id int(10) unsigned not null comment '服务记录(费用明细)',
	create_time int(10) unsigned not null comment '订单产生时间',
	pay_time int(10) not null default 0 comment '支付时间',
	pay_status enum('0','1') not null default '0' comment '支付状态，默认失败或者未缴',
	pay_type tinyint(3) not null comment '对应消费类型表id',
	pay_no varchar(32) not null unique comment '支付流水号',
	api_pay_no varchar(32) not null unique comment '第三方接口订单号',
	is_del enum('0','1') not null default '0' comment '是否“逻辑”删除本条记录，默认正常显示',
	key (user_id),
	key (pay_mode),
	key (serv_id),
	key (create_time),
	key (pay_time),
	key (pay_type),
	key (pay_no)
)engine=Myisam charset=utf8 comment '消费记录表';


--【消费记录表应增加一个是否有优惠的记录字段，如果存在，则将对应的优惠记录维护到此字段】--


--支付方式表(例如现金支付，刷卡支付，支付宝支付，微信支付，财付通支付等)
create table if not exists smart_paymode(
	pm_id tinyint(3) unsigned not null auto_increment primary key comment '支付方式id',
	pm_name varchar(32) not null unique comment '支付方式名称',
	pm_img varchar(128)	not null default '' comment '支付方式图标',
	pm_desc varchar(1024) not null default '' comment '支付方式描述和备注',
	key (pm_name)
)engine=Myisam charset=utf8 comment '支付方式表';


--消费类型表(例如停车消费，洗车消费，汽车美容消费，其它管理服务费等)
create table if not exists smart_paytype(
	pp_id tinyint(3) unsigned not null auto_increment primary key comment '消费方式id',
	pp_name varchar(32) not null unique comment '消费方式名称',
	pp_img varchar(128)	not null default '' comment '消费方式图标',
	pp_desc varchar(1024) not null default '' comment '消费方式描述和备注',
	key (pm_name)
)engine=Myisam charset=utf8 comment '消费类型表';


--车库信息表
create table if not exists smart_garage(
	garage_id int(10) unsigned not null auto_increment primary key comment '车库主键id',
	garage_name varchar(64) not null unique comment '车场名称(名称不可重复)',
	park_sp_num smallint(5) not null comment '车场车位数',
	had_num smallint(5) not null comment '已使用数',
	garage_no varchar(32) not null default '' comment '所在停车场编号',
	zone_id smallint(5) not null comment '车库所在地区(地区id)',
	garage_gps varchar(32) not null default '' unique comment '车场经纬度',
	park_d_addr varchar(64) not null default '' comment '车场的具体位置',
	park_status varchar(32) not null default '' comment '车场状态',
	park_host varchar(64) not null comment '车库负责人(后台人员id，一到多)',
	park_wking varchar(64) not null default '' comment '当前正值班人员',
	park_photo varchar(1024) not null default '' comment '车场照片',
	is_del enum('0','1') not null default '0' comment '是否“逻辑”删除本条记录，默认正常显示',
	key (garage_name),
	key (zone_id)
)engine=Myisam charset=utf8 comment '车库信息表';



--地区表zone
create table if not exists smart_zone(
	zone_id smallint(5) unsigned not null auto_increment comment '地区id',
	zone_name varchar(32) not null comment '地区名称',
	zone_pid smallint(5) unsigned not null default '0' comment '上级id',
	zone_path varchar(16) not null default '' comment '地区路径',
	zone_level tinyint unsigned not null default '0' comment '地区级别，0为省，1为市县，2为乡镇区',
	primary key (zone_id),
	unique key (zone_name)
)engine=Myisam charset=utf8 comment '地区表';


--用户信息表
create table if not exists smart_user(
	user_id int(10) unsigned not null auto_increment primary key comment '用户id',
	user_name varchar(32) not null unique comment '用户名',
	user_pwd varchar(128) not null comment '用户密码',
	user_t_name varchar(32) not null default '' comment '用户姓名',
	user_phone int(11) not null default 0 comment '用户手机',
	user_wxid varchar(32) not null default '' comment '用户微信号',
	user_wxnik varchar(32) not null default '' comment '用户微昵称',
	user_wx_opid varchar(128) not null default '' comment '微信用户openid',
	user_headerimg varchar(512) not null default '' comment '用户头像',
	user_sex enum('0','1','2') not null default '0' comment '用户性别(0为保密，1为男性，2为女性)',
	user_age tinyint(3) not null default 0 comment '用户年龄',
	user_city smallint(5) not null default 0 comment '用户所属城市',
	user_addr varchar(128) not null default '' comment '用户地址',
	user_level tinyint(3) not null default 0 comment '用户等级，例如0为普通用户，1为会员，2为超级会员等',
	user_balance decimal(10,2) not null default 0 comment '用户帐户余额，默认余额为0',
	user_logo varchar(128) not null default '' comment '用户头像',
	add_time int(10) unsigned not null comment '用户创建时间(自动完成 )',
	is_del enum('0','1') not null default '0' comment '是否“逻辑”删除本条记录，默认正常显示',
	key (user_name),
	key (user_phone),
	key (user_wxid)
)engine=Myisam charset=utf8 comment '用户表';


--会员类型表(待建)


--车辆信息表
create table if not exists smart_car(
	car_id int(10) unsigned not null auto_increment primary key comment '用车id',
	car_no varchar(20) not null comment '车牌号',
	user_id int(10) not null comment '车主信息',
	car_type varchar(32) not null default '' comment '车辆信息，例如车型等',
	car_price decimal(10,2) not null default 0 comment '车辆购入价格',
	add_time int(10) unsigned not null comment '车辆信息收录时间(自动完成)',
	upd_time int(10) unsigned not null default 0 comment '车辆信息最近更新时间(自动完成)',
	is_del enum('0','1') not null default '0' comment '是否“逻辑”删除本条记录，默认正常显示',
	key (user_id)
)engine=Myisam charset=utf8 comment '车辆信息表';


--优惠活动表
create table if not exists smart_activity(
	act_id int(10) unsigned not null auto_increment primary key comment '活动id',
	act_name varchar(64) not null unique comment '活动名称',
	act_type tinyint(3) not null comment '活动类型(活动类型表id)',
	cp_count int(10) unsigned not null comment '优惠名额',
	cp_hilt decimal(10,2) not null comment '单个优惠额度',
	cp_token varchar(128) not null comment '优惠口令，当设置口令时要求用户必须输入正确的口令才能参加，不设置默认所有符合条件均可参与',
	cp_type tinyint(3) unsigned not null comment '优惠方式，例如0为免金额，1为免时间，2为全免等',
	act_start_time int(10) unsigned not null comment '活动开始时间',
	act_end_time int(10) unsigned not null comment '活动结束时间',
	act_poster_img varchar(128) not null default '' comment '活动海报图',
	act_desc varchar(2048) not null default '' comment '活动介绍',
	is_over enum('0','1') not null default '0' comment '活动是否已经结束，默认未结束',
	is_del enum('0','1') not null default '0' comment '是否删除本活动，默认未删除',
	key (act_name),
	key (act_type),
	key (cp_count),
	key (cp_hilt),
	key (cp_token),
	key (cp_type),
	key (act_start_time),
	key (act_end_time),
	key (is_over),
	key (is_del)
)engine=Myisam charset=utf8 comment '优惠活动表';


--优惠活动类型表
create table if not exists smart_acttype(
	attp_id tinyint(3) unsigned not null auto_increment primary key comment '活动类型id',
	attp_name varchar(32) not null unique comment '类名名称，例如线上活动，线下活动，亲子活动等优惠活动',
	key (attp_name)
)engine=Myisam charset=utf8 comment '活动类型表';




--优惠券表(时候时临时单张生成记录，上限以活动表的优惠名额为准)
create table if not exists smart_coupon(
	cp_id int(10) unsigned not null auto_increment primary key comment '优惠券id',
	act_id int(10) unsigned not null comment '所属活动(活动表id)',
	cp_no varchar(32) not null unique comment '优惠券编码(系统自动随机唯一生成)',
	user_id int(10) unsigned not null default 0 comment '优惠券持有者(普通用户)',
	cp_lssuer int(10) unsigned not null comment '优惠券发行者(后台用户id)',
	car_id int(10) unsigned not null default 0 comment '指定车辆id', 
	start_time int(10) not null comment '生效日期',
	end_time int(10) not null comment '失效日期 ',
	cp_type tinyint(3) not null comment '优惠券类型(根据活动表数据进行维护)',
	cp_hilt decimal(10,2) not null default 0.00 comment '根据对应的活动优惠额度进行维护',
	is_valid enum('0','1') not null default '1' comment '是否已经过期，默认未过期',
	is_del enum('0','1') not null default '0' comment '是否“逻辑”删除本条记录，默认正常显示',
	key (act_id),
	key (cp_no),
	key (cp_type),
	key (cp_lssuer),
	key (start_time),
	key (user_id),
	key (car_id),
	key (is_valid),
	key (is_del),
	key (end_time)
)engine=Myisam charset=utf8 comment '优惠券表';



--优惠类型表(项目正常运行时，此表的修改或者删除必须配合后台php代码就行维护，否则会导致系统付费情况打乱，后果严重)
create table if not exists smart_cptype(
	cptp_id tinyint(3) unsigned not null auto_increment primary key comment '优惠类型id',
	cptp_name varchar(32) not null unique comment '优惠类型名称',
	cptp_desc varchar(1024) not null default '' comment '优惠描述',
	cp_flag tinyint(3) unsigned not null default 0 comment '结算类型标识符，默认0为现金抵算，1为时间结算',
	key (cptp_name)
)engine=Myisam charset=utf8 comment '优惠类型表';




--用户充值记录表
create table if not exists smart_recharge(
	cg_id int(10) unsigned not null auto_increment primary key comment '充值记录id',
	cg_hilt decimal(10,2) not null comment '充值额度',
	cg_time int(10) not null comment '充值日期',
	user_id int(10) not null comment '充值帐户',
	cg_no varchar(32) not null comment '充值流水号',
	is_del enum('0','1') not null default '0' comment '是否“逻辑”删除本条记录，默认正常显示',
	key (cg_time),
	key (user_id),
	key (cg_no)
)engine=Myisam charset=utf8 comment '用户充值记录表';


--管理员表
create table if not exists smart_admin(
	ad_id int(10) unsigned not null auto_increment primary key comment '管理员id',
	ad_name varchar(32) not null unique comment '管理员用户名',
	ad_pwd varchar(128) not null comment '管理员密码',
	garage_id int(10) not null comment '所在车场(车场表id)',
	ad_tname varchar(32) not null comment '管理员真实姓名',
	ad_sex enum('1','2') not null comment '管理员性别，1为男2为女',
	ad_age tinyint(3) not null comment '管理员年龄',
	ad_no varchar(32) not null unique comment '管理员编号/工号',
	ad_sfz varchar(32) not null unique comment '管理员身份证号',
	ad_sfzimg1 varchar(128) not null default '' comment '管理员身份证正面照片',
	ad_sfzimg2 varchar(128) not null default '' comment '管理员身份证反面照片',
	ad_phone varchar(11) not null unique comment '管理员手机号',
	role_id smallint(5) not null comment '管理员角色(角色表id)',
	ad_wxid varchar(32) not null unique comment '管理员微信id',
	ad_wxnk varchar(32) not null comment '管理员微信昵称',
	ad_addr varchar(64) not null comment '管理员住址',
	add_time int(10) not null comment '注册时间',
	is_check enum('0','1') not null default '0' comment '是否通过审核，默认未审核 ',
	key (ad_name),
	key (garage_id),
	key (ad_tname),
	key (ad_no),
	key (ad_sfz),
	key (ad_phone),
	key (ad_wxid),
	key (ad_wxnk)
)engine=Myisam charset=utf8 comment '管理员表';


--权限表
CREATE TABLE IF NOT EXISTS smart_auth (
  auth_id smallint(5) unsigned NOT NULL auto_increment,
  auth_name varchar(20) NOT NULL COMMENT '权限名称',
  auth_pid smallint(6) unsigned NOT NULL COMMENT '父id',
  auth_c varchar(32) NOT NULL default '' COMMENT '控制器',
  auth_a varchar(32) NOT NULL default '' COMMENT '操作方法',
  auth_path varchar(32) NOT NULL default '' COMMENT '全路径',
  auth_level tinyint(4) NOT NULL default 0 COMMENT '级别',
  PRIMARY KEY  (auth_id)
) ENGINE=Myisam CHARSET=utf8 comment '角色权限表';


--角色表
CREATE TABLE IF NOT EXISTS smart_role (
  role_id smallint(5) NOT NULL auto_increment,
  role_name varchar(32) NOT NULL COMMENT '角色名称',
  role_auth_ids varchar(128) NOT NULL default '' COMMENT '权限ids,1,2,5',
  role_auth_ac text COMMENT '模块-操作',
  PRIMARY KEY  (role_id),
  unique key (role_name)
) ENGINE=Myisam CHARSET=utf8 comment '用户角色表';



--微信回调记录表
create table if not exists smart_wxcallback(
	cb_id int(10) unsigned not null auto_increment primary key comment '记录id',
	us_opid varchar(64) not null comment '支付用户的openid，也可能为代付人opid',
	pay_record_id varchar(64) not null unique comment '被支付的订单id(本系统订单)',
	result_code varchar(16) not null comment '微信支付结果',
	return_code varchar(16) not null comment '微信返回结果',
	wx_sign varchar(64) not null comment '本订单微信服务号签名',
	time_end int(10) unsigned not null comment '微信支付成功时间',
	total_fee decimal(10,2) not null comment '微信支付金额(微信返回为分)',
	transaction_id varchar(64) not null unique comment '微信官方订单编号',
	create_time int(10) unsigned not null comment '本订单创建时间',
	key (us_opid),
	key (pay_record_id),
	key (result_code),
	key (return_code),
	key (wx_sign),
	key (time_end),
	key (transaction_id),
	key (create_time)
)engine=Myisam charset=utf8 comment '微信回调记录表';



--停车场系统相关配置(此表在安装系统后可以进行对应值的修改，不要随意添加新记录或者删除原有记录，也不要随意改变name对应的值)
create table if not exists smart_sysconf(
	conf_id smallint(5) unsigned not null auto_increment primary key comment '配置id',
	conf_name varchar(32) not null unique comment '配置项名称',
	conf_value varchar(128) not null comment '配置项对应的配置值',
	conf_desc varchar(1024) not null comment '配置项注释和说明',
	key (conf_name),
	key (conf_value)
)engine=Myisam charset=utf8 comment '停车场系统相关配置表';

