<?php

namespace Home\Model;
use Think\Model;


class UserModel extends Model{
    //用户快捷登录
    
    public function login(){
                //使用微信登录接口获取用户的相关信息
                /*
                 * 
                 array(9) {
                    ["openid"] => string(28) "oa5Cas4dVgZLSh-7J5D3CtmKbPVA"
                    ["nickname"] => string(6) "小王"
                    ["sex"] => int(1)
                    ["language"] => string(5) "zh_CN"
                    ["city"] => string(6) "武汉"
                    ["province"] => string(6) "湖北"
                    ["country"] => string(6) "中国"
                    ["headimgurl"] => string(127) "http://wx.qlogo.cn/mmopen/7uSswQTgRTicpJsnA1QnCrO3Q6DdSXibsoExTfYEbCwA0VUL01DiajU9CcStIy3gzeTOCnXbdFawXvBP3Cbax6NxJmjeQmZykJk/0"
                    ["privilege"] => array(0) {
                    }
                  }
                 * 
                 */
                //实例化微信类
                $weixin=new \Org\Weixinpay\Weixinpay();
               /* if(empty($_GET['state_admin'])){
                    header('Location: http://www.hdhsmart.com/Car/index.php?m=Home&c=Car&a=use_service');
                }*/
                
                //进行微信登录
                $user_info=$weixin->authorize_openid(C('WEB_DOMAIN'));
                    //判断使用是否已经注册(到普通用户表进行查询)
                    $exists_status=M('user')->where(array('user_wx_opid'=>$user_info['openid']))->find();
                    if(!$exists_status){
                        $after_name=preg_replace('/[\x{10000}-\x{10FFFF}]/u', '', $user_info['nickname']);//去除非3字节的特殊符号
                        //版本更新方法
                        /*$is_old = M('user')->where(array('user_wxnik'=>$after_name))->find();
                        if($is_old){
                            //是老用户
                            $updateArray = array(
                                'user_wx_opid'=>$user_info['openid'],
                                'unionid'=>$user_info['unionid'],
                                'user_pwd'=>$user_info['openid'],
                                'update_time'=>time()
                            );
                            M('user')->where(array('user_wxnik'=>$after_name))->data($updateArray)->save();
                            //添加完成用户后执行制动登录操作
                            session('user_id',$is_old['user_id']);  //用户id
                            session('nickname',$user_info['nickname']);  //微信用户昵称
                            session('headimgurl',$user_info['headimgurl']);  //用户头像
                            session('wx_openid',$user_info['openid']);  //用户openid
                        }else{*/
                            if($after_name==null){//全部是表情符号没有文字
                                $wxnik='anonymity'.rand(1000,9999);
                                $nickname='anonymity'.rand(1000,9999);
                            }else{//一部分表情、一部分文字
                                $wxnik=$after_name;
                                $nickname=$after_name.rand(1000,9999);
                            }
                            //如果不存在，则进行微信用户注册
                            $user_insert_info=array(
                                'user_wx_opid'=>$user_info['openid'],
                                'user_wxnik'=>$wxnik,//昵称
                                'user_name'=>$nickname,//作为唯一性的昵称字段
                                'user_pwd'=>$user_info['openid'],
                                'user_sex'=>$user_info['sex'],
                                'user_addr'=>$user_info['country'].$user_info['province'].$user_info['city'],
                                'user_headerimg'=>$user_info['headimgurl'],
                                'unionid'=>$user_info['unionid'],
                                'add_time'=>time(),
                                'update_time'=>time()
                            );
                            //将数据添加到用户表
                            $insert_result=M('user')->add($user_insert_info);
                            if(!$insert_result){
                                //如果注册失败
                                echo '用户注册失败！请重试！或者联系管理员！';
                                exit;
                            }
                            //添加完成用户后执行制动登录操作
                            session('user_id',$insert_result);  //用户id
                            session('nickname',$user_info['nickname']);  //微信用户昵称
                            session('headimgurl',$user_info['headimgurl']);  //用户头像
                            session('wx_openid',$user_info['openid']);  //用户头像
                        //return true;
                    }else{
                        //已经存在的用户，执行自动登录操作,并且自动更新头像等信息
                        $after_name=preg_replace('/[\x{10000}-\x{10FFFF}]/u', '', $user_info['nickname']);//去除非3字节的特殊符号
                        if($after_name==null){//全部是表情符号没有文字
                            $wxnik='anonymity'.rand(1000,9999);
                            $nickname='anonymity'.rand(1000,9999);
                        }else{//一部分表情、一部分文字
                            $wxnik=$after_name;
                            $nickname=$after_name.rand(1000,9999);
                        }
                        $time=time();
                        $data=array('user_name'=>$nickname,'user_wxnik'=>$wxnik,'user_headerimg'=>$_SESSION['newinfo']['headimgurl'],'update_time'=>$time);//需要更新的数据
                        if(($time-$exists_status['update_time'])>30*24*60*60){//更新离上次更新时间大于30天的数据
                            M('user')->where(array('user_id'=>$exists_status['user_id']))->data($data)->save();
                            session('user_id',$exists_status['user_id']);
                            session('nickname',$wxnik);
                            session('headimgurl',$_SESSION['newinfo']['headimgurl']);
                            session('wx_openid',$exists_status['user_wx_opid']);
                        }else{
                            session('user_id',$exists_status['user_id']);
                            session('nickname',$exists_status['user_wxnik']);
                            session('headimgurl',$exists_status['user_headerimg']);
                            session('wx_openid',$exists_status['user_wx_opid']);
                            //return false;
                            //$this->admin_auto_login($exists_status['user_id']);
                        }

                    }
            
    }


    /**
     * 后台管理员自动登陆
     * @param $user_id
     * @update-time: 2017-03-28 09:32:16
     * @author: 王亚雄
     */
    protected function admin_auto_login($user_id){
        //只有在用户访问Admin模块才进行管理员自动登陆
        if(!strtolower(MODULE_NAME)==="admin"){
            return;
        }

        //用户为管理员才进行自动登陆
        if(!user_info()['ad_id']){
            return;
        }


        $timestamp = time();
        $nonce = mt_rand(100000,999999);
        $token = ADAUTO_LOGIN_TOKEN;
        $signature = create_signature($timestamp,$nonce,$token);
        $param  = array(
            'user_id'=>$user_id,
            'timestamp'=>$timestamp,
            'nonce'=>$nonce,
            'signature'=>$signature,
            'bakurl'=>urlencode(get_url()),//当前url
        );
        redirect(ROOT_URL . U('Admin/Login/wechat_auto_login',$param));
    }


    /*
     * 微信前端登录停车场后台系统
     * 2017.1.22
     * 陈琦
     */
    public function wx_login(){
        //实例化微信类
        $weixin=new \Org\Weixinpay\Weixinpay();

        //进行微信登录
        $user_info=$weixin->authorize_openid(C('WEB_DOMAIN'));
        return $user_info;
    }

    public function check_and_save($user_id){
        $admin_array = user_info($user_id);
        if(!empty($admin_array['ad_id'])){
            session('admin_id',$admin_array['ad_id']);
            session('admin_name',$admin_array['ad_name']);
        }
    }

    /*拉取用户的个人信息
     *祝君伟
     * */
    public function get_user_info($user_id){
        //拉取用户的信息来显示到个人中心上
        $user_info_array = $this->where(array('user_id'=>$user_id))->find();
        $result_array = array();
        $result_array['user_headerimg'] = $_SESSION['newinfo']['headimgurl'];
        $result_array['score_count']=$user_info_array['score_count'];
        $result_array['nick_name']=$_SESSION['newinfo']['nickname'];
        $result_array['user_phone']=$user_info_array['user_phone'];
        $result_array['user_t_name']=$user_info_array['user_t_name'];
        $result_array['user_card_number']=$user_info_array['user_card_number'];
        //查询其消费了多少
        $sum_money = M('payrecord')->where(array('pay_user'=>$user_id))->sum('pay_loan');
        if($sum_money ===NULL){
            $sum_money="0";
        }
        //查询一共多长时间
        $how_long = ceil($sum_money/5);
        $result_array['sum_money']=number_format($sum_money);
        $result_array['how_long']=$how_long;
        //查询该用户名下的车辆中是否存在月卡车辆
        $garage_id = session('garage_id');
        if(empty($garage_id)){
            return false;
        }
        $user_car_array = M('car')->where(array('user_id'=>$user_id,'garage_id'=>$garage_id))->select();
        $result_array['is_yuka']='0';
        foreach ($user_car_array as $k=>$v){
            if($v['car_role']=='1'){
                $result_array['is_yuka']='1';
                $result_array['yueka_carNo'][]=$v['car_no'];
                /*//捷顺接口获取汽车的新月卡剩余天数
                $jieshun_api=new \Org\JieShunApi\Jieshun();
                $jieshun_return = json_decode($jieshun_api->use_api_yueka_info($v['car_no']),true);
                $end_time =strtotime($jieshun_return['dataItems'][0]['subItems'][0]['attributes']['endTime']);
                M('car')->where(array('car_no'=>$v['car_no']))->data(array('end_time'=>$end_time))->save();*/
            }else{
                $result_array['putong_carNo'][]=$v['car_no'];
            }
        }
        return $result_array;
    }

    /*
     * 获取所有的注册公司的信息
     * */
    public function get_all_company(){
        $company_arr = D('')->table('pigcms_company')->field('company_name')->select();
        return $company_arr;
    }

    /*根据pay_user id来拉取用户订单信息
     * @author 祝君伟
     * @time 2017.2.15
     * */
    public function get_preson_pay_info($user_id){
        //更具用户的userid来查询用户的信息
        $payrecord_array = M('payrecord')->alias('p')->join('LEFT JOIN smart_servicerecord s on s.serv_id=p.serv_id')->where(array('p.pay_user'=>$user_id,'p.pay_status'=>'1'))->field('p.pay_loan,p.pay_status,s.start_time,s.car_no,s.start_time,s.end_time')->order('p.pay_time desc')->select();
        return $payrecord_array;
    }

    /*查询当前用户绑定的非月卡车辆
     * 祝君伟
     * 2017.2.15
     * */
    public function get_who_car($user_id){
        $garage_id = session('garage_id');
        if(empty($garage_id)){
            return false;
        }
        $user_car_array = M('car')->where(array('user_id'=>$user_id,'car_role'=>'0','garage_id'=>$garage_id))->select();
        return $user_car_array;
    }

    /*查询当前用户绑定的月卡车辆
     * 祝君伟
     * 2017.2.15
     * */
    public function get_who_yueka_car($user_id){
        $garage_id = session('garage_id');
        if(empty($garage_id)){
            return 1;
        }
        $user_car_array = M('car')->where(array('user_id'=>$user_id,'car_role'=>'1','garage_id'=>$garage_id))->select();
        if($user_car_array){
            return $user_car_array;
        }else{
            return 2;
        }

    }

    /*将前台传过来的POST剔除不需要入库的项剩下的入库
    *祝君伟
    * 2017.2.16
    */
    public function user_info_add_bank($data){
        unset($data['howlong']);
        unset($data['car_no']);
        $re1 = M('user')->save($data);
        //user_bind 表更新
        $user_bind_data = array();
        $data['user_commpany']  && $user_bind_data['company']   = $data['user_commpany'];
        $data['card_type']      && $user_bind_data['card_type'] = $data['card_type'];
        $data['card_number']    && $user_bind_data['id_card']   = $data['card_number'];
        $re2 = M('house_village_user_bind','pigcms_')
            ->where('uid=%d',$data['user_id'])
            ->save($user_bind_data);
        return $re1!==false && $re2!==false;


//        if($result_code!==false||$result_code!==0){
//            return true;
//        }else{
//            return false;
//        }
    }

    /*
     * 制作前台显示的价钱列表
     * */
    public function get_price_list_bak(){
        $garage_id = session('garage_id');
        if (empty($garage_id)){
            return false;
        }
        //查询当前车场下的月卡单月价格为多少
        $yueka_price = M('config')->where(array('name'=>'yueka_univalence_'.$garage_id))->getField('value');
        $price_array = array(
            array(
                'price'=>$yueka_price,
                'month'=>'1个月'
            ),
            array(
                'price'=>(int)$yueka_price*3,
                'month'=>'3个月'
            ),
            array(
                'price'=>(int)$yueka_price*6,
                'month'=>'6个月'
            ),
            array(
                'price'=>(int)$yueka_price*9,
                'month'=>'9个月'
            ),
            array(
                'price'=>(int)$yueka_price*12,
                'month'=>'1年'
            ),
            array(
                'price'=>(int)$yueka_price*24,
                'month'=>'2年'
            ),
        );
        return $price_array;
    }

    /**
     * 制作前台显示的价钱列表
     * 月卡月费区分固定停车位与非固定停车位，
     * 配置记录在smart_garage表中：monthly_fee_fixed 固定停车位月费，monthly_fee_no_fixed 非固定停车位
     * @update-time: 2018-01-30 15:37:04
     * @author: 王亚雄
     */
    public function get_price_list(){
        $garage_id = session('garage_id');
        if (empty($garage_id)){
            return false;
        }
        $garage_info = M('garage')->where('garage_id=%d',$garage_id)->find();
        //前台提供的月卡时长的选择列表
        $month_length_list = [1,3,6,9,12,24];//办理时长可选的值(单位月)
        $list = [];
        foreach ($month_length_list as $month_count){
            $list[$month_count] = array(
                'desc'          =>$this->get_month_desc($month_count),
                'price_fixed'   =>$month_count * $garage_info['monthly_fee_fixed'],
                'price_non_fixed'=>$month_count * $garage_info['monthly_fee_non_fixed']
            );
        }

        return $list;

    }

    //获取月份描述
    protected function get_month_desc($month_count){
        $zh_num = [
            1=>'一', 2=>'两', 3=>'三',
            4=>'四', 5=>'五', 6=>'六',
            7=>'七', 8=>'八', 9=>'九',
            10=>'十',
        ];

        $year       =  floor($month_count/12);
        $month      = $month_count%12;
        $year_desc  = $year  ? $zh_num[$year] . '年'  : "";
        $month_desc = $month ? $month . '个月'        : "";
        return $year_desc . $month_desc;
    }




    /*
     * 制作自动发送微信信息的必要openid数组
     * 没有过滤无效的uid，上线没有无效uid，暂不考虑
     * 加入指定组配置
     * */
    public function make_admin_info(){
        $push_group = M('config')->where(array('name'=>'push_group'))->find();
        $admin_array = M('admin')->where(array('role_id'=>$push_group['value'],'is_check'=>'1'))->select();
        //分出两种情况
        //1.多组数据的
        $result_array =array();
        $admin_uid_string='';
        $admin_openid_array=array();
        if(isset($admin_array[1])){
            foreach ($admin_array as $k=>$v){
                $admin_uid_string=$v['ad_uid'];
            }
            $result_array=explode(",",$admin_uid_string);
        }else{
            //2.一组数据的
            $admin_uid_string=$admin_array[0]['ad_uid'];
            $result_array=explode(",",$admin_uid_string);
        }
        foreach ($result_array as $vo){
            $user_info =M('user')->where(array('user_id'=>$vo))->find();
            $admin_openid_array[]=$user_info['user_wx_opid'];
        }
        return $admin_openid_array;
    }

    /*
     * 制做审核页面的数组信息
     * */
    public function select_user_info($pay_id,$car_no){
        //获取openid
        $map = array();
        $map['y.pay_id'] = array('eq',$pay_id);
        $map['y.car_no'] = array('eq',$car_no);
        $field = array(
            'u.user_id',
            'u.user_t_name',
            'u.user_phone',
            'u.user_wx_opid',
            'y.car_no',
            'y.how_long',

        );
        $info = M('yueka_payrecord')
            ->alias('y')
            ->field($field)
            ->where($map)
            ->join('left join __USER__ u on u.user_id = y.user_id')
            ->find()?:array();

        //使用openid 关联查询用户数据
        if($info){
            $company_info = M('house_village_user_bind','pigcms_')
                ->alias('ub')
                ->join('join pigcms_user u on u.uid = ub.uid')
                ->field(array(
                    'pigcms_id'=>'user_bind_id',
                    'ub.company'=>'user_commpany',
                    'ub.card_type',
                    'ub.id_card'=>'card_number',
                ))
                ->where('u.openid="%s"',$info['user_wx_opid'])
                ->find();
        }
        $company_info = $company_info?:array();




        $res =array( //因为原来的代码 是使用原生sql 查询的 返回结果是个二维长度为一 的数组，为了不影响其他代码我就这么写了
            array_merge($company_info,$info)
        );

        return $res;

    }



    //证件类型
    public function get_card_type_name($card_type=null){
        //证件类型 4:工牌;2:门禁卡;3:身份证 1：现场审核
        $arr = array(
            4=>'工牌',
            2=>'门禁卡',
            3=>'身份证',
            1=>'现场审核'
        );
        if($card_type===null){
            return $arr;
        }else{
            return $arr[$card_type];
        }
    }
    
    /*
     * 月卡用户续费成功，拉取他的openid
     * */
    public function make_user_openid($uid,$phone){
        M('user')->where(array('user_id'=>$uid))->data(array('user_phone'=>$phone))->save();
        $user_openid_array = M('user')->where(array('user_id'=>$uid))->find();
        $admin_openid_array[]=$user_openid_array['user_wx_opid'];
        return $admin_openid_array;
    }

    /*
     * 拉取后台管理的信息
     * 完全通用版
     * ags array 查询条件 数组形式
     * */
    public function get_admin_info($where_array){
        $admin_user_info =M('user')->where($where_array)->find();
        return $admin_user_info;
    }

    /*
     * 制作向check表中插入的新数据
     * */
    public function insert_to_check($info_array){
        $add_array = array(
              'check_title'=>$info_array['first_value'],
              'check_user'=>$info_array['user_t_name'],
              'check_request_time'=>time(),
              'check_process_time'=>time(),
              'yukepay_id'=>$info_array['yukepay_id'],
              'check_type'=>0,
              'check_state'=>0,
              'is_del'=>0
        );
        $result = M('check_record')->add($add_array);
        return $result;
    }
    /*
     * 获得客服所显示的列表页
     * */
    public function get_check_list(){
        $check_array = M('check_record')
            ->alias('c')
            ->join('JOIN smart_yueka_payrecord y on c.yukepay_id=y.pay_id LEFT JOIN smart_user u on c.check_user=u.user_t_name')
            ->where(array('c.check_type'=>0,'c.is_del'=>0))
            ->field('c.*,y.car_no,y.how_long,y.pay_time,u.user_id')
            ->order('c.check_request_time desc')
            ->select();
        return $check_array;
    }


    /*
     * 魔术方法：制作一个列表中能显示两个不同链接表的数组
     * type=1时显示没有处理完毕的所有项
     * type=2时显示已经处理完毕的所有项
     * @author 祝君伟
     * @time 2017.2.28
     * */
    public function make_magic_sql($type=1){
        $is_yueka_array = M('check_record')->select();
        $check_array =array();
        foreach ($is_yueka_array as $key=>$value){
            if($value['check_type']==0&&$type==1&&$value['check_state']==0){
                //为月卡审核
                $check_array[] = M('check_record')
                    ->alias('c')
                    ->join('JOIN smart_yueka_payrecord y on c.yukepay_id=y.pay_id LEFT JOIN smart_user u on c.check_user=u.user_t_name')
                    ->where(array('c.check_id'=>$value['check_id']))
                    ->field('c.*,y.car_no,y.how_long,y.pay_time,u.user_id')
                    ->order('c.check_request_time desc')
                    ->find();

            }else if($value['check_type']==2&&$type==1&&($value['check_state']==0||$value['check_state']==1||$value['check_state']==3)){
                //为发票审核
                $map = array();
                $map['b.is_del']  = array('eq','0');
                $map['p.is_del']  = array('eq','0');
                $map['p.in_bill'] = array('eq','1');
                $map['c.check_id'] = array('eq',$value['check_id']);
                $field = array(
                    'b.bill_id',
                    'b.create_time',    //账单创建时间
                    'b.bill_status',    //账单状态
                    'c.check_title',
                    'c.check_user',
                    'c.check_request_time',
                    'c.check_state',
                    'b.user_id',
//            'p.pay_loan',       //支付金额
//            's.garage_id',      //停车场编号
//            's.waiter',         //服务员编号
//            's.out_no ',        //出口门号
//             's.car_no',         //车牌号码
//            'car_imgs',
                    'group_concat(s.car_no)'=>'car_nos',         //车牌号码总汇
                    'sum(p.pay_loan)'=>'total_pay_loan'
                );
                $list = M('check_record')->alias('c')
                    ->field($field)
                    ->join('left join __BILL__ b on b.bill_id = c.bill_id')
                    ->join('left join __PAYRECORD__ p on find_in_set( p.pay_id ,b.pay_id)')
                    ->join('left join __SERVICERECORD__ s on s.serv_id = p.serv_id')
                    ->where($map)
                    ->group('b.bill_id')
                    ->order('c.check_request_time desc')
                    ->find();
                $check_array[] =  $list;
            }else if($value['check_type']==0&&$type==2&&$value['check_state']==1){
                //为月卡审核
                $check_array[] = M('check_record')
                    ->alias('c')
                    ->join('JOIN smart_yueka_payrecord y on c.yukepay_id=y.pay_id LEFT JOIN smart_user u on c.check_user=u.user_t_name')
                    ->where(array('c.check_id'=>$value['check_id']))
                    ->field('c.*,y.car_no,y.how_long,y.pay_time,u.user_id')
                    ->order('c.check_request_time desc')
                    ->find();
            }else if($value['check_type']==2&&$type==2&&$value['check_state']==4){
                //为发票审核
                $map = array();
                $map['b.is_del']  = array('eq','0');
                $map['p.is_del']  = array('eq','0');
                $map['p.in_bill'] = array('eq','1');
                $map['c.check_id'] = array('eq',$value['check_id']);
                $field = array(
                    'b.bill_id',
                    'b.create_time',    //账单创建时间
                    'b.bill_status',    //账单状态
                    'c.check_title',
                    'c.check_user',
                    'c.check_request_time',
                    'c.check_state',
                    'b.user_id',
//            'p.pay_loan',       //支付金额
//            's.garage_id',      //停车场编号
//            's.waiter',         //服务员编号
//            's.out_no ',        //出口门号
//             's.car_no',         //车牌号码
//            'car_imgs',
                    'group_concat(s.car_no)'=>'car_nos',         //车牌号码总汇
                    'sum(p.pay_loan)'=>'total_pay_loan'
                );
                $list = M('check_record')->alias('c')
                    ->field($field)
                    ->join('left join __BILL__ b on b.bill_id = c.bill_id')
                    ->join('left join __PAYRECORD__ p on find_in_set( p.pay_id ,b.pay_id)')
                    ->join('left join __SERVICERECORD__ s on s.serv_id = p.serv_id')
                    ->where($map)
                    ->group('b.bill_id')
                    ->order('c.check_request_time desc')
                    ->find();
                $check_array[] =  $list;
            }
        }

        return $check_array;
    }

    /*
     * 显示全部的客服列表页
     * */
    public function get_all_show_list(){
        $is_yueka_array = M('check_record')->select();
        $check_array =array();
        foreach ($is_yueka_array as $key=>$value) {
            if ($value['check_type'] == 0) {
                //为月卡审核
                $check_array[] = M('check_record')
                    ->alias('c')
                    ->join('JOIN smart_yueka_payrecord y on c.yukepay_id=y.pay_id LEFT JOIN smart_user u on c.check_user=u.user_t_name')
                    ->where(array('c.check_id' => $value['check_id']))
                    ->field('c.*,y.car_no,y.how_long,y.pay_time,u.user_id')
                    ->order('c.check_request_time asc')
                    ->find();

            } else if ($value['check_type'] == 2) {
                //为发票审核
                $map = array();
                $map['b.is_del']  = array('eq','0');
                $map['p.is_del']  = array('eq','0');
                $map['p.in_bill'] = array('eq','1');
                $map['c.check_id'] = array('eq',$value['check_id']);
                $field = array(
                    'b.bill_id',
                    'b.create_time',    //账单创建时间
                    'b.bill_status',    //账单状态
                    'c.check_title',
                    'c.check_user',
                    'c.check_request_time',
                    'c.check_state',
                    'b.user_id',
//            'p.pay_loan',       //支付金额
//            's.garage_id',      //停车场编号
//            's.waiter',         //服务员编号
//            's.out_no ',        //出口门号
//             's.car_no',         //车牌号码
//            'car_imgs',
                    'group_concat(s.car_no)'=>'car_nos',         //车牌号码总汇
                    'sum(p.pay_loan)'=>'total_pay_loan'
                );
                $list = M('check_record')->alias('c')
                    ->field($field)
                    ->join('left join __BILL__ b on b.bill_id = c.bill_id')
                    ->join('left join __PAYRECORD__ p on find_in_set( p.pay_id ,b.pay_id)')
                    ->join('left join __SERVICERECORD__ s on s.serv_id = p.serv_id')
                    ->where($map)
                    ->group('b.bill_id')
                    ->order('c.check_request_time desc')
                    ->find();
                $check_array[] =  $list;
            }
        }
        return $check_array;
    }

    /*
     * 判断如果当前用户的uid存在于客服表中就返回false
     * */
    public function is_user_of_admin($user_id){
        $admin_array = M('admin')->where(array('role_id'=>3))->find();
        $admin_array = $admin_array['ad_uid'];
        $admin_array=explode(",",$admin_array);
        if(in_array($user_id,$admin_array)){
            //不是用户，而是客服
            return false;
        }else{
            //是用户不是客服
            return true;
        }
    }

    /*
     * 用户所展现的列表页
     * */
    public function person_show_list($user_id,$type=0){
        $user_info_array = M('user')->where(array('user_id'=>$user_id))->find();
        $user_t_name = $user_info_array['user_t_name'];
        $is_yueka_array = M('check_record')->select();
        $check_array =array();
        foreach ($is_yueka_array as $key=>$value) {
            if ($value['check_type'] == 0&&$type==0&&$value['check_user']==$user_t_name) {
                //为月卡审核
                $check_array[] = M('check_record')
                    ->alias('c')
                    ->join('JOIN smart_yueka_payrecord y on c.yukepay_id=y.pay_id LEFT JOIN smart_user u on c.check_user=u.user_t_name')
                    ->where(array('c.check_id' => $value['check_id']))
                    ->field('c.*,y.car_no,y.how_long,y.pay_time,u.user_id')
                    ->order('c.check_request_time asc')
                    ->find();

            } else if ($value['check_type'] == 2&&$type==0&&$value['check_user']==$user_t_name) {
                //为发票审核
                $map = array();
                $map['b.is_del']  = array('eq','0');
                $map['p.is_del']  = array('eq','0');
                $map['p.in_bill'] = array('eq','1');
                $map['c.check_id'] = array('eq',$value['check_id']);
                $field = array(
                    'b.bill_id',
                    'b.create_time',    //账单创建时间
                    'b.bill_status',    //账单状态
                    'c.check_title',
                    'c.check_user',
                    'c.check_request_time',
                    'c.check_state',
                    'b.user_id',
                    'group_concat(s.car_no)'=>'car_nos',         //车牌号码总汇
                    'sum(p.pay_loan)'=>'total_pay_loan'
                );
                $list = M('check_record')->alias('c')
                    ->field($field)
                    ->join('left join __BILL__ b on b.bill_id = c.bill_id')
                    ->join('left join __PAYRECORD__ p on find_in_set( p.pay_id ,b.pay_id)')
                    ->join('left join __SERVICERECORD__ s on s.serv_id = p.serv_id')
                    ->where($map)
                    ->group('b.bill_id')
                    ->order('c.check_request_time desc')
                    ->find();
                $check_array[] =  $list;
            }else if($value['check_type']==0&&$type==1&&$value['check_state']==0&&$value['check_user']==$user_t_name){
                //为月卡审核
                $check_array[] = M('check_record')
                    ->alias('c')
                    ->join('JOIN smart_yueka_payrecord y on c.yukepay_id=y.pay_id LEFT JOIN smart_user u on c.check_user=u.user_t_name')
                    ->where(array('c.check_id'=>$value['check_id']))
                    ->field('c.*,y.car_no,y.how_long,y.pay_time,u.user_id')
                    ->order('c.check_request_time desc')
                    ->find();

            }else if($value['check_type']==2&&$value['check_user']==$user_t_name&&$type==1&&($value['check_state']==0||$value['check_state']==1||$value['check_state']==3)){
                //为发票审核
                $map = array();
                $map['b.is_del']  = array('eq','0');
                $map['p.is_del']  = array('eq','0');
                $map['p.in_bill'] = array('eq','1');
                $map['c.check_id'] = array('eq',$value['check_id']);
                $field = array(
                    'b.bill_id',
                    'b.create_time',    //账单创建时间
                    'b.bill_status',    //账单状态
                    'c.check_title',
                    'c.check_user',
                    'c.check_request_time',
                    'c.check_state',
                    'b.user_id',
                    'group_concat(s.car_no)'=>'car_nos',         //车牌号码总汇
                    'sum(p.pay_loan)'=>'total_pay_loan'
                );
                $list = M('check_record')->alias('c')
                    ->field($field)
                    ->join('left join __BILL__ b on b.bill_id = c.bill_id')
                    ->join('left join __PAYRECORD__ p on find_in_set( p.pay_id ,b.pay_id)')
                    ->join('left join __SERVICERECORD__ s on s.serv_id = p.serv_id')
                    ->where($map)
                    ->group('b.bill_id')
                    ->order('c.check_request_time desc')
                    ->find();
                $check_array[] =  $list;
            }else if($value['check_type']==0&&$type==2&&$value['check_state']==1&&$value['check_user']==$user_t_name){
                //为月卡审核
                $check_array[] = M('check_record')
                    ->alias('c')
                    ->join('JOIN smart_yueka_payrecord y on c.yukepay_id=y.pay_id LEFT JOIN smart_user u on c.check_user=u.user_t_name')
                    ->where(array('c.check_id'=>$value['check_id']))
                    ->field('c.*,y.car_no,y.how_long,y.pay_time,u.user_id')
                    ->order('c.check_request_time desc')
                    ->find();
            }else if($value['check_type']==2&&$type==2&&$value['check_state']==4&&$value['check_user']==$user_t_name){
                //为发票审核
                $map = array();
                $map['b.is_del']  = array('eq','0');
                $map['p.is_del']  = array('eq','0');
                $map['p.in_bill'] = array('eq','1');
                $map['c.check_id'] = array('eq',$value['check_id']);
                $field = array(
                    'b.bill_id',
                    'b.create_time',    //账单创建时间
                    'b.bill_status',    //账单状态
                    'c.check_title',
                    'c.check_user',
                    'c.check_request_time',
                    'c.check_state',
                    'b.user_id',
                    'group_concat(s.car_no)'=>'car_nos',         //车牌号码总汇
                    'sum(p.pay_loan)'=>'total_pay_loan'
                );
                $list = M('check_record')->alias('c')
                    ->field($field)
                    ->join('left join __BILL__ b on b.bill_id = c.bill_id')
                    ->join('left join __PAYRECORD__ p on find_in_set( p.pay_id ,b.pay_id)')
                    ->join('left join __SERVICERECORD__ s on s.serv_id = p.serv_id')
                    ->where($map)
                    ->group('b.bill_id')
                    ->order('c.check_request_time desc')
                    ->find();
                $check_array[] =  $list;
            }
        }
        return $check_array;
    }

    /*
   * 用户所展现的列表页
   * */
    public function person_show_list_new($user_id,$type=0){
        $user_info_array = M('user')->where(array('user_id'=>$user_id))->find();
        $user_t_name = $user_info_array['user_t_name'];
        $is_yueka_array = M('check_record')->select();
        $check_array =array();
        foreach ($is_yueka_array as $key=>$value) {
            if ($value['check_type'] == 0&&$type==0&&$value['check_user']==$user_t_name) {
                //为月卡审核
                $check_array[] = M('check_record')
                    ->alias('c')
                    ->join('JOIN smart_yueka_payrecord y on c.yukepay_id=y.pay_id LEFT JOIN smart_user u on c.check_user=u.user_t_name')
                    ->where(array('c.check_id' => $value['check_id']))
                    ->field('c.*,y.car_no,y.how_long,y.pay_time,u.user_id')
                    ->order('c.check_request_time asc')
                    ->find();

            } else if ($value['check_type'] == 2&&$type==0&&$value['check_user']==$user_t_name) {
                //为发票审核
                $map = array();
                $map['b.is_del']  = array('eq','0');
                $map['p.is_del']  = array('eq','0');
                //$map['p.in_bill'] = array('eq','1');
                $map['c.check_id'] = array('eq',$value['check_id']);
                $field = array(
                    'b.bill_id',
                    'b.create_time',    //账单创建时间
                    'b.bill_status',    //账单状态
                    'c.check_title',
                    'c.check_user',
                    'c.check_request_time',
                    'c.check_state',
                    'b.user_id',
                    'group_concat(s.car_no)'=>'car_nos',         //车牌号码总汇
                    'sum(p.pay_loan)'=>'total_pay_loan'
                );
                $list = M('check_record')->alias('c')
                    ->field($field)
                    ->join('left join __BILL__ b on b.bill_id = c.bill_id')
                    ->join('left join __PAYRECORD__ p on find_in_set( p.pay_id ,b.pay_id)')
                    ->join('left join __SERVICERECORD__ s on s.serv_id = p.serv_id')
                    ->where($map)
                    ->group('b.bill_id')
                    ->order('c.check_request_time desc')
                    ->find();
                $check_array[] =  $list;
            }else if($value['check_type']==0&&$type==1&&$value['check_state']==0&&$value['check_user']==$user_t_name){
                //为月卡审核
                $check_array[] = M('check_record')
                    ->alias('c')
                    ->join('JOIN smart_yueka_payrecord y on c.yukepay_id=y.pay_id LEFT JOIN smart_user u on c.check_user=u.user_t_name')
                    ->where(array('c.check_id'=>$value['check_id']))
                    ->field('c.*,y.car_no,y.how_long,y.pay_time,u.user_id')
                    ->order('c.check_request_time desc')
                    ->find();

            }else if($value['check_type']==2&&$value['check_user']==$user_t_name&&$type==1&&$value['check_state']==1){//发票处理中
                //为发票审核
                $map = array();
                $map['b.is_del']  = array('eq','0');
                $map['p.is_del']  = array('eq','0');
                $map['p.in_bill'] = array('eq','1');
                $map['c.check_id'] = array('eq',$value['check_id']);
                $field = array(
                    'b.bill_id',
                    'b.create_time',    //账单创建时间
                    'b.bill_status',    //账单状态
                    'c.check_title',
                    'c.check_user',
                    'c.check_request_time',
                    'c.check_state',
                    'b.user_id',
                    'group_concat(s.car_no)'=>'car_nos',         //车牌号码总汇
                    'sum(p.pay_loan)'=>'total_pay_loan'
                );
                $list = M('check_record')->alias('c')
                    ->field($field)
                    ->join('left join __BILL__ b on b.bill_id = c.bill_id')
                    ->join('left join __PAYRECORD__ p on find_in_set( p.pay_id ,b.pay_id)')
                    ->join('left join __SERVICERECORD__ s on s.serv_id = p.serv_id')
                    ->where($map)
                    ->group('b.bill_id')
                    ->order('c.check_request_time desc')
                    ->find();
                $check_array[] =  $list;
            }else if($value['check_type']==0&&$type==2&&$value['check_state']==1&&$value['check_user']==$user_t_name){
                //为月卡审核
                $check_array[] = M('check_record')
                    ->alias('c')
                    ->join('JOIN smart_yueka_payrecord y on c.yukepay_id=y.pay_id LEFT JOIN smart_user u on c.check_user=u.user_t_name')
                    ->where(array('c.check_id'=>$value['check_id']))
                    ->field('c.*,y.car_no,y.how_long,y.pay_time,u.user_id')
                    ->order('c.check_request_time desc')
                    ->find();
            }else if($value['check_type']==2&&$type==2&&$value['check_state']==2&&$value['check_user']==$user_t_name){//已处理
                //为发票审核
                $map = array();
                $map['b.is_del']  = array('eq','0');
                $map['p.is_del']  = array('eq','0');
                $map['p.in_bill'] = array('eq','2');
                $map['c.check_id'] = array('eq',$value['check_id']);
                $field = array(
                    'b.bill_id',
                    'b.create_time',    //账单创建时间
                    'b.bill_status',    //账单状态
                    'c.check_title',
                    'c.check_user',
                    'c.check_request_time',
                    'c.check_state',
                    'b.user_id',
                    'group_concat(s.car_no)'=>'car_nos',         //车牌号码总汇
                    'sum(p.pay_loan)'=>'total_pay_loan'
                );
                $list = M('check_record')->alias('c')
                    ->field($field)
                    ->join('left join __BILL__ b on b.bill_id = c.bill_id')
                    ->join('left join __PAYRECORD__ p on find_in_set( p.pay_id ,b.pay_id)')
                    ->join('left join __SERVICERECORD__ s on s.serv_id = p.serv_id')
                    ->where($map)
                    ->group('b.bill_id')
                    ->order('c.check_request_time desc')
                    ->find();
                $check_array[] =  $list;
            }
        }
        return $check_array;
    }


    /**
     * o2o权限的认证
     * @return bool|mixed
     */
    public function O2O_checkAdmin()
    {
        $openid = $_SESSION['newinfo']['openid'];

        $info = M()->table('pigcms_admin')->where(array('openid'=>$openid))->find();

        $role_id =  $info['role_id'];

        $allow_role = array('53','54','55','60');

        if(in_array($role_id,$allow_role)){

            return $info;
        }else{
            return false;
        }
    }

    public function check_duty()
    {
        $duty = '';

        if(date('H')>=7&&date('H')<15)
        {
            $duty = '早班';

        }else if(date('H')>=15&&date('H')<23)
        {
            $duty = '中班';

        }else if(date('H')>=23&&date('H')<7)
        {
            $duty = '晚班';

        }

        return $duty;
    }
}