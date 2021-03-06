<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/20
 * Time: 16:51
 * 发票相关
 * @update-time: 2017-12-21 15:51:36
 * @author: 王亚雄
 */

namespace Common\Model;
use Think\Model;


class BillModel extends Model
{
    protected $tableName = 'bill';
    protected $garage_id = array();  //管理员所属的停车场，可能有多个id //主要用于PC端，wap端会指定一个ID
    protected $garage_name = ""; //停车场名称
    protected $kf_address = ""; //客服地址

    protected $user_id = 0;     //当前操作用户
    protected $admin_id = 0;    //当前操作管理员

    //角色配置
    const ADMIN_ROLE = 4;
    protected $kf_role = 0;
    public $allow_roles = array();

    //发票状态
    const BILL_STATUS_YSQ = 0; //已申请，待审核
    const BILL_STATUS_DLQ = 1; //已审核，待领取
    const BILL_STATUS_YLQ = 2; //已领取
    const BILL_STATUS_YHJ = 4; //客服回绝了用户的发票申请
    const BILL_MIN_LOAN_SUM = 0.1; //申请发票的限制，消费总额至少需要达到的数额


    protected $receive_type = "byself";//发票领取方式 byself,express
    const EXPRESS_LOAN_SUM = 200; // 达到多少数额后能够邮寄



    //消息链接地址
    const AUDIT_DETAIL_URL = "http://www.hdhsmart.com/Car/index.php?m=Home&c=Bill&a=audit_bill_list"; //客服审核页
    const DETAIL_URL = "http://www.hdhsmart.com/Car/index.php?m=Home&c=Bill&a=bill_list"; //客服审核页


    public function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub

        $this->user_id      = $this->get_user_id();
        $this->admin_id      = $this->get_admin_id();
        $this->garage_id    = $this->get_garage_id();
        $this->garage_name  = $this->get_garage_name($this->garage_id[0]);
        $this->kf_address   = $this->get_kf_address($this->garage_id[0]);
        $this->kf_role = $this->get_kf_role($this->garage_id[0]);
        $this->allow_roles = array($this->kf_role,self::ADMIN_ROLE);

//        if(!$this->user_id){
//            exit("出错了！你无权访问，或者也许是客服角色未绑定任何用户");
//        }


    }

    /**
     * 设置发票领取类型
     * @param $type
     */
    public function set_receive_type($type){
        $this->receive_type = $type;
    }


    //获取用户ID
    protected function get_user_id(){
        if(IS_WECHAT){
            $user_id = session('user_id');
        }else{
            $admin_info = admin_info(); //获取所有该管理员下所有的用户
            $user_id = $admin_info[0]['user_id'] ?: 0; //选择第一个用户作为PC端的user_id
        }

        return $user_id;
    }

    //获取adminID
    protected function get_admin_id(){
        if(IS_WECHAT){
            $admin_id = user_info()['ad_id']||0;
        }else{
            $admin_id = session('admin_id');
        }
        return $admin_id;
    }


    //获取停车场ID
    /**
     * @return array
     */
    protected function get_garage_id(){
        if(IS_WECHAT){

            $garage_id = array(session("garage_id"));

        }else{//PC端
            //获取所有停车场ID
            $all_garage_id = M('garage')->select();
            $all_garage_id = array_column($all_garage_id,'garage_id');
            $garage_id = M('admin')->where('ad_id=%d',$this->admin_id)->getField('garage_id');
            //admin时选择所有停车场ID 作为他的所属停车场
            $garage_id = $garage_id ? explode(',',$garage_id) : $all_garage_id;
            //如果有get参数传入则进行筛选
            if($get_garage_id = I('get.garage_id')){
                $garage_id = array_intersect($garage_id,array($get_garage_id));
            }

        }

        return $garage_id;
    }

    //获取停车场名称
    public function get_garage_name($garage_id){
        static $garage_list = array();
        if(!$garage_list){
            $tmp = array();
            $garage_list = M('garage')->select();
            foreach($garage_list as &$row){
                $tmp[$row['garage_id']] = $row['garage_name'];
            }
            $garage_list = $tmp;
        }
        return $garage_list[$garage_id];
    }

    //获取客服所在地
    protected function get_kf_address($garage_id){
        $arr = array(
            2=>'广发大厦24楼客服服务中心',
            4=>"钰龙大厦xx楼"
        );
        return $arr[$garage_id];
    }

    //获取停车场客服角色
    protected function get_kf_role($garage_id){

        $arr = array(
            //停车场ID   =>  客服角色ID
            2           =>  3,
            4           =>  5,
        );

        return $arr[$garage_id];
    }

    //TODO::设置发票发件的地址，根据每个停车场会有不同
    protected function get_garage_address($garage_id){

        $address_list = array(
            2 => 0,
        );
        $address_id = $address_list[$garage_id];//pigcms_user_adress 主键
        return $address_id;
    }



    //获取发票状态描述
    public function bill_status_desc($status=-1,$receive_type='byself'){
        $arr = array(
            self::BILL_STATUS_YSQ=>array(
                "已申请",
                "待审核",
                "审核",
                "您的发票申请已提交,请等待审核"
            ),
            self::BILL_STATUS_DLQ=>array(
                "已审核",
                "待领取",
                "核销",
                $receive_type==="byself"
                    ?"您的发票申请已经通过审核，请于一个工作日后到{$this->kf_address}领取"
                    :"您的发票申请已通过审核,发票会在3日内快递送达",
            ),
            self::BILL_STATUS_YLQ=>array(
                "已核销",
                "已领取",
                "已核销",
                "您的发票已经领取，如有疑问请联系客服"
            ),
        );

        if($status===-1){
            return $arr;
        }else{
            return $arr[$status];
        }
    }

    public function get_receive_type_name($receive_type=-1){
        $types = array(
            'byself'=>"上门自领",
            'express'=>"邮寄"
        );

        if($receive_type===-1) return $types;
        return $types[$receive_type];
    }

    /**
     * 消费记录 临时停车
     * @param int $user_id
     * @param int $garage_id
     * @param int $start_time
     * @return mixed
     */
    public function get_park_record($user_id=0,$garage_id=0,$start_time=0){
        //条件
        $map = array();
        $user_id    && $map['p.user_id']     = array( 'eq', $user_id );
        $garage_id  && $map['s.garage_id']   = array( 'eq' , $garage_id);
        $start_time && $map['p.create_time'] = array('egt',$start_time); //时间条件必要 测试注释掉

        $map['p.pay_status']    = array( 'eq', '1' );   //已经支付过的
        $map['p.is_del']        = array(  'eq', '0'  );//没有被逻辑删除的

        //字段
        $field = array(
            'p.user_id',
            'p.pay_id',
            'p.pay_status',
            'p.pay_time',       //支付时间
            'p.pay_loan',       //支付金额
            'p.bill_id',
            'p.pay_no',
            's.garage_id',      //停车场编号
            's.waiter',         //服务员编号
            's.out_no ',        //出口门号
            's.car_no',         //车牌号码
            's.start_time',
            's.end_time',       //停车起始时间
            'ifnull(b.bill_status,-1)'=>'bill_status'
        );

        $list =M('payrecord')->alias('p')
            ->join('LEFT JOIN __SERVICERECORD__ s on s.serv_id=p.serv_id')
            ->join('left join __BILL__ b on b.bill_id = p.bill_id')
            ->where($map)
            ->field($field)
            ->order('p.bill_id asc,pay_time desc')
            ->select();

        if($list){
            foreach($list as &$row){
                $row['pay_record_type'] = "park";
            }
            unset($row);
        }

        return $list;
    }

    /**
     * 获取用户的消费记录 临时停车
     * @param $start_time
     * @return mixed
     */
    public function get_user_park_record($start_time=0){
        return $this->get_park_record($this->user_id,$this->garage_id[0],$start_time);
    }

    /**
     * 消费记录 月卡
     * @param int $user_id
     * @param int $garage_id
     * @param int $start_time
     */
    public function get_yueka_record($user_id=0,$garage_id=0,$start_time=0){
        //条件
        $map = array();
        $user_id    && $map['yk.user_id']     = array( 'eq', $user_id );
        $garage_id  && $map['yk.garage_id']   = array( 'eq' , $garage_id);
        $start_time && $map['yk.create_time'] = array('egt',$start_time); //时间条件必要 测试注释掉

        $map['yk.pay_status']    = array( 'eq', '1' );   //已经支付过的
        $map['yk.is_del']        = array(  'eq', '0'  );//没有被逻辑删除的

        $field = array(
            'yk.pay_id',
            'yk.user_id',
            'yk.payment',
            'yk.pay_loan',
            'yk.car_no',
            'yk.pay_type',
            'yk.how_long',
            'yk.create_time',
            'yk.pay_time',
            'yk.pay_status',
            'yk.order_no',
            'yk.order_no'=>'pay_no',
            'yk.is_del',
            'yk.bill_id',
            'ifnull(b.bill_status,-1)'=>'bill_status',
        );
        $list = M('yueka_payrecord')->alias('yk')
            ->field($field)
            ->where($map)
            ->join('left join __BILL__ b on b.bill_id = yk.bill_id')
            ->select();
        if($list){
            foreach($list as &$row){
                $row['pay_record_type'] = "yueka";
            }
            unset($row);
        }


        return $list?:array();
    }

    /**
     * 获取用户的消费记录 月卡
     * @param int $start_time
     */
    public function get_user_yueka_record($start_time=0){
        return $this->get_yueka_record($this->user_id,$this->garage_id[0],$start_time);
    }



    //获取发票列表 包括账单信息等数据
    public function get_bill_list($user_id=0,$bill_id=0){
        $field = array(
            'bill.*',
            'bill.create_time'=>'bill_create_time',

            'serv.car_no',
            'serv.start_time',
            'serv.end_time',

            'pay.pay_id',
            'pay.payment',//应付金额
            'pay.pay_loan',//实际付款
            'pay.pay_time',//付款时间
            'pay.pay_user',//付款人ID

            'u.user_t_name',
            'u.user_phone',
            //快递信息

            'ad.adress_id',
            'ad.detail',
            'ad.position'



        );
        $map = array();
        $bill_id && $map['bill.bill_id'] = array('eq',$bill_id);
        $user_id && $map['bill.user_id'] = array('eq',$user_id);

        //停车场过滤
        if(!$this->garage_id) return null;
        $map['serv.garage_id'] = array('in',$this->garage_id);//只能查看自己所在停车场的ID

        $list = $this->alias('bill')
            ->field($field)
            ->where($map)
            ->join('left join __PAYRECORD__ pay on pay.bill_id = bill.bill_id')//获取消费记录
            ->join('left join __USER__ u on u.user_id = bill.user_id')//获取申请人信息
            ->join('left join __SERVICERECORD__ serv on serv.serv_id = pay.serv_id')//获取车辆信息 1:m
            ->join('left join pigcms_express_order e on e.order_id=bill.express_id')
            ->join('left join pigcms_user_adress ad on ad.adress_id = e.shipping_adid')
            ->order('bill.bill_id desc,pay.pay_time desc')
            ->select();

        //echo $list;exit();

        //分组
        if($list){
            $tmp = array();
            foreach($list as $row){
                $row['pay_user_name'] = $row['pay_user'] ? user_info($row['pay_user'])['user_name'] : "";
                //发票数据
                $tmp[$row['bill_id']]['bill_id']        = $row['bill_id'];
                $tmp[$row['bill_id']]['audit_id1']      = $row['audit_id1'];
                $tmp[$row['bill_id']]['audit_id2']      = $row['audit_id2'];
                $tmp[$row['bill_id']]['bill_status']    = $row['bill_status'];
                $tmp[$row['bill_id']]['user_id']        = $row['user_id'];
                $tmp[$row['bill_id']]['user_t_name']    = $row['user_t_name'];
                $tmp[$row['bill_id']]['user_phone']     = $row['user_phone'];
                $tmp[$row['bill_id']]['bill_create_time']   = $row['bill_create_time'];
                $tmp[$row['bill_id']]['garage_id']          = $row['garage_id'];
                $tmp[$row['bill_id']]['garage_name']        = $this->get_garage_name($row['garage_id']);
                $tmp[$row['bill_id']]['receive_type']       = $row['receive_type'];
                $tmp[$row['bill_id']]['receive_type_name']  = $this->get_receive_type_name($row['receive_type']);



                //快递信息
                $tmp[$row['bill_id']]['adress_id']  = $row['adress_id'];
                $tmp[$row['bill_id']]['detail']     = $row['detail'];
                $tmp[$row['bill_id']]['position']  = $row['position'];
                $tmp[$row['bill_id']]['express_id'] = $row['express_id'];

                //合计数据
                $tmp[$row['bill_id']]['count_pay_list'] ++;
                $tmp[$row['bill_id']]['loan_sum'] =
                    floatval($tmp[$row['bill_id']]['loan_sum'])
                    + $row['pay_loan'];
                //车牌号码统计
                if(!in_array($row['car_no'],$tmp[$row['bill_id']]['car_no_list']?:[])){
                    $tmp[$row['bill_id']]['car_no_list'][] = $row['car_no'];
                }

                //起始时间
                $tmp[$row['bill_id']]['max_time'] = $row['start_time'] > $tmp[$row['bill_id']]['max_time']
                    ? $row['start_time']
                    :$tmp[$row['bill_id']]['max_time'];
                if(!$tmp[$row['bill_id']]['min_time']) $tmp[$row['bill_id']]['min_time'] = time();
                $tmp[$row['bill_id']]['min_time'] = $row['start_time'] < $tmp[$row['bill_id']]['min_time']
                    ? $row['start_time']
                    :$tmp[$row['bill_id']]['min_time'];


                //获取描述
                $tmp[$row['bill_id']]['audit_name1']        = $row['audit_id1'] ? user_info($row['audit_id1'])['user_name'] :"";
                $tmp[$row['bill_id']]['audit_name2']        = $row['audit_id2'] ? user_info($row['audit_id2'])['user_name'] :"";
                $tmp[$row['bill_id']]['user_name']          = $row['user_id'] ? user_info($row['user_id'])['user_name'] :"";
                $tmp[$row['bill_id']]['bill_status_desc']   = $this->bill_status_desc($row['bill_status'],$row['receive_type']);

                //消费记录 一个发票id 有多条消费记录
                $tmp[$row['bill_id']]['pay_list'][] = array(
                    'car_no'    => $row['car_no'],
                    'start_time'=> $row['start_time'],
                    'end_time'  => $row['end_time'],
                    'pay_id'    => $row['pay_id'],
                    'payment'   => $row['payment'],//应付金额
                    'pay_loan'  => $row['pay_loan'],//实际付款
                    'pay_time'  => $row['pay_time'],//付款时间
                    'pay_user_name' => $row['pay_user_name'],
                );
            }


            $list = $tmp;
        }

        return $list;

    }

    /**
     * 管理员审核发票列表
     */
    public function audit_bill_list(){
        return $this->get_bill_list();
    }


    //获取发票详情
    public function get_bill_detail($bill_id)
    {
        return $this->get_bill_list(0,$bill_id)[$bill_id];
    }



    /**
     * 创建发票的时候过滤掉无效的数据
     * @param $pay_ids
     * @return array
     */
    public function filter_pay_ids($pay_ids)
    {
        //选取当前停车场的记录
        $map = array();
        $map['pay.pay_id']  = array('in',$pay_ids);
        $map['s.garage_id'] = array('in',$this->garage_id);
        $map['pay.bill_id']     = array('eq',0); //过滤掉已经被申请的缴费记录
        $map['pay.user_id']     = array('eq',$this->user_id);
        $payrecord = M('payrecord')->alias('pay')
            ->field('pay.*')
            ->join('left join __SERVICERECORD__ s on pay.serv_id = s.serv_id')
            ->where($map)
            ->select();
        $pay_ids = array_column($payrecord,'pay_id');
        $loan_sum = array_sum(array_column($payrecord,'pay_loan'));
        if($loan_sum<self::BILL_MIN_LOAN_SUM){//总额小于200 不符合要求
            $pay_ids = false;
        }
        return $pay_ids;
    }

    /**
     * 创建发票
     * @param $pay_ids
     */
    public function create_bill($pay_ids,$express_id=0){
        if(!$this->filter_pay_ids($pay_ids)) return false;
        $this->startTrans();
        $flag = true;
        $data = array(
            'user_id'=>user_info()['user_id'],
            'create_time'=>time(),
            'bill_status'=>self::BILL_STATUS_YSQ,
            'audit_id1'=>0,
            'audit_id2'=>0,
            'garage_id'=>$this->garage_id[0],//账单所属停车场跟随用户当前选择的停车场
            'is_del'=>'0',
            'receive_type'=>$express_id ? "express" : "byself",
            'express_id'=>$express_id,
        );

        $bill_id =  $this->add($data);
        $flag *= $bill_id;
        if($bill_id){
            $res = $this->create_bill_three($bill_id);
            $map = array();
            $map['pay_id'] = array('in',$pay_ids);
            $re = M('payrecord')->where($map)->setField('bill_id',$bill_id);
            $flag *= $re!==false;
        }

        if($flag){
            $this->commit();
        }else{
            $this->rollback();
        }

        return $bill_id ?: $flag;
    }

    //添加审核状态
    public function create_bill_three($bill_id) {
        $userinfo = user_info();
        $cr_data = array();
        $cr_data['garage_id'] = $_SESSION['garage_id'];
        $cr_data['admin_id'] = $_SESSION['user_id'];
        $cr_data['check_title'] = '发票申领';
        $cr_data['bill_id'] = $bill_id;
        $cr_data['check_type'] = 2;
        $cr_data['check_state'] = 0;
        $cr_data['check_request_time'] = time();
        $cr_data['user_t_name'] = $userinfo['user_t_name'];
        $re = D('check_record')->add($cr_data);
    }

    //向客服推送消息
    public function send_msg_to_kf($bill_id){
        $wechat = new WechatModel();
        $tpl_id = WechatModel::TPLID_LCSPTX;
        $url    = self::AUDIT_DETAIL_URL . '&bill_id=' . $bill_id;
        $bill_data  =  $this->get_bill_detail($bill_id);
        $data = array(
            'first'=>array(
                'value'=>$this->garage_name . "发票申请提醒",
                'color'=>"#029700",
            ),
            'keyword1'=>array(
                'value'=>'金额：￥' . $bill_data['loan_sum']
                    . '/'
                    . '车牌：'. join(',',$bill_data['car_no_list']),
                'color'=>"#000000",
            ),
            'keyword2'=>array(
                'value'=>$bill_data['user_name'],
                'color'=>"#000000",
            ),
            'keyword3'=>array(
                'value'=>"发票申请提醒",
                'color'=>"#000000",
            ),
            'keyword4'=>array(
                'value'=>date('Y-m-d H:i:s',time()),
                'color'=>"#000000",
            ),
        );

        $users  = getUsersByRole($this->kf_role);
        $openids = array_unique(array_column($users,'user_wx_opid'));
        $openids = array('ohgcf0jY6c8Rnj8hgkJw8mcVpOR8');
        $res = $wechat->send_tpl_messages($openids,$tpl_id,$url,$data);
        return $res;
    }


    //向用用户推送消息
    public function send_msg_to_user($bill_id){
        $wechat = new WechatModel();
        $tpl_id = WechatModel::TPLID_LCSPTX;
        $url    = self::DETAIL_URL . '&bill_id=' . $bill_id;
        $bill_data  =  $this->get_bill_detail($bill_id);
        $data = array(
            'first'=>array(
                'value'=>$this->garage_name . "发票申请提醒",
                'color'=>"#029700",
            ),
            'keyword1'=>array(
                'value'=>'金额：￥' . $bill_data['loan_sum']
                    . '/'
                    . '车牌：'. join(',',$bill_data['car_no_list']),
                'color'=>"#000000",
                'color'=>"#000000",
            ),
            'keyword2'=>array(
                'value'=>$bill_data['user_name'],
                'color'=>"#000000",
            ),
            'keyword3'=>array(
                'value'=>$bill_data['bill_status_desc'][3],
                'color'=>"#000000",
            ),
            'keyword4'=>array(
                'value'=>date('Y-m-d H:i:s',time()),
                'color'=>"#000000",
            ),
        );

        $openid =  array(user_info($bill_data['user_id'])['user_wx_opid']);
        $res = $wechat->send_tpl_messages($openid,$tpl_id,$url,$data);
        return $res;
    }

    //管理员审核修改发票状态
    public function audit($bill_id,$bill_status){
        $save = array();
        switch($bill_status){
            case 0:
                $save = array(
                    'audit_id1'=>$this->user_id,
                    'audit_id2'=>0,
                    'bill_status'=>1
                );
                break;
            case 1:
                $save = array(
                    'audit_id2'=>$this->user_id,
                    'bill_status'=>2
                );
        }

        if($save){
            $re = $this->where('bill_id=%d',$bill_id)->save($save);
            if($re!==false){
                return $save['bill_status'];
            }
        }

    }

    /**
     * 添加到寄件信息
     * @param $shipping_adid 收件地址外键
     */
    public function insert_into_express_order($shipping_adid){
        //TODO 指定发票发件地址，根据每个项目会有同
        $billing_id = $this->get_garage_address($this->garage_id[0]);
        $data = array(
            'user_id'=>0,
            'billing_adid'=>$billing_id,
            'goods_type_name'=>"发票",
            'billing_type_id'=>"免费包邮",
            'shipping_adid'=>$shipping_adid,
            'pay_type_name'=>"发票寄送",
            'ems_order_id'=>"",
            'ems_order_update_time'=>0,
            'create_time'=>time(),
            'is_del'=>0,
            'save_pay'=>0,
            'time_period'=>0,
            'status'=>1,
            'type_id'=>2,
            'smart_user_id'=>user_info()['user_id'],
        );

        $express_model = new ExpressModel();
        $express_id = $express_model->add($data);
        return $express_id;
    }
















}