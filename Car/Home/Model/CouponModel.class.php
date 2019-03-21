<?php
/**
 * Created by PhpStorm.
 * User: 王亚雄
 * Date: 2017/3/17
 * Time: 10:19
 */

namespace Home\Model;


class CouponModel extends BaseModel
{
    /**
     * 获取优惠活动相关信息
     * @param $act_id 优惠活动表ID
     * @return mixed
     * @update-time: 2017-03-17 10:22:40
     * @author: 王亚雄
     */
    public function act_info($act_id){

        $field = array(
                  'act_id',
                  'a.act_start_time', //活动开始时间
                  'a.act_end_time',   //活动结束时间
                  'a.act_type',         //活动类型(活动类型表id)
                  'a.act_name',
                  'a.cp_type',        //优惠方式，例如0为免金额，1为免时间，3为全免等
                  'a.cp_hilt',        //单个优惠额度
                  'ad.ad_tname',
                  'ad.ad_id',
                  'u.user_name',      //用户名称||公司名称
                  'u.user_wx_opid'    //openid
              );


        $act_info  = M('activity')->alias('a')
            ->field($field)
            ->join('left join __ADMIN__ ad on a.cp_lssuer = ad.ad_id')
            ->join('left join __USER__  u on find_in_set(u.user_id,ad.ad_uid)')
            ->where('act_id=%d' , $act_id)
            ->group('a.act_id')
            ->find();
        if($act_info){
            $act_info['act_desc'] = $this->act_desc($act_info['cp_hilt'],$act_info['cp_type']);
            $act_info['acttype_name'] = $this->acttype_name($act_info['act_type']);
        }

        return $act_info;
    }


    /**
     * 根据用户ID查找该用户的有效优惠券
     * @param $user_id
     * @return mixed
     */
    public function get_user_coupons($user_id,$is_valid = COUPON_STATUS_VALID){
        $user_id = $user_id ?: session('user_id');
        if(!$user_id) return false;
        $filed = array(
            'act.act_name',
            'act.act_desc',
            'act.act_poster_img',
            'c.cp_type',
            'c.cp_hilt',
            'act.act_type',
            'a.ad_tname',
            'c.end_time',
            'c.cp_id',
            'c.is_valid'=>'coupon_valid'

        );
        $map = array();
        $map['c.user_id'] = array('eq',$user_id);
        $map['c.is_del'] = array('eq','0');

        //有效优惠券的附加条件
        if($is_valid===COUPON_STATUS_VALID){
            $map['c.is_valid'] = array('eq',1); //数据表里面为varchar类型
            $map['c.end_time'] = array('gt',time());
            $map['act.is_over'] = array('eq','0');
        }




        $list = $this->alias('c')
            ->field($filed)
            ->join('left join __ACTIVITY__ act on c.act_id = act.act_id')
            ->join('left join __ADMIN__ a on a.ad_id = act.cp_lssuer')
            ->order('c.cp_id desc')
            ->where($map)
            ->select();
        if($list){
            foreach($list as &$row){
                $row['act_desc'] = $this->act_desc($row['cp_hilt'],$row['cp_type']);
                $row['acttype_name'] = $this->acttype_name($row['act_type']);
            }
        }

        return $list;
    }

    /**
     * 根据cp_id获取优惠券信息
     * @param $cp_id  优惠卷记录id
     * @return array
     * @update-time: 2017-03-23 14:59:43
     * @author: 王亚雄
     */
    public function coupon_info($cp_id){

        static $coupon_info_list = array();//单例
        if(!array_key_exists($cp_id,$coupon_info_list)){
            $field = array(
                'c.cp_id',
                'c.is_valid',
                'au.user_id',
                'a.ad_id',
                'a.ad_tname',
                'act.act_id',
                'act.act_name',       //活动名称
                'act.act_start_time', //活动开始时间
                'act.act_end_time',   //活动结束时间
                'act.act_type',         //活动类型(活动类型表id)
                'c.cp_type',        //优惠方式，例如0为免金额，1为免时间，3为全免等
                'c.cp_hilt',        //单个优惠额度
                'act.is_over',
                'act.act_desc',
                 'au.user_id'=>'admin_user_id',
                'au.user_name'=>'admin_user_name',      //商家员用户名称
                'uu.user_name'=>'user_user_name',      //用户的用户名
                'uu.user_wxnik',                        //用户的微信昵称

            );
            $coupon_info = $this->alias('c')
                ->field($field)
                ->join('left join __ACTIVITY__ act  on c.act_id = act.act_id')
                ->join('left join __ADMIN__ a       on  a.ad_id = act.cp_lssuer') //获取管理员信息
                ->join('left join __USER__ au        on  find_in_set(au.user_id,ad_uid)') //获取管理员对应的用户信息
                ->join('left join __USER__ uu        on c.user_id = uu.user_id') //获取用户对应的用户信息
                ->where('c.cp_id=%d',$cp_id)
                ->find();
            if($coupon_info){
                $coupon_info['act_desc'] = $this->act_desc($coupon_info['cp_hilt'],$coupon_info['cp_type']);
                $coupon_info['acttype_name'] = $this->acttype_name($coupon_info['act_type']);
                $coupon_info_list[$cp_id] =   $coupon_info;
            }






        }

        return $coupon_info_list[$cp_id];
    }

    /**
     * 根据优惠额度，优惠方式获取优惠描述 -- 虽然数据库中有活动描述字段，但不建议使用该字段
     * @param $cp_hilt 优惠额度 根据优惠类型单位会发生变化
     * @param $cp_type 优惠类型
     * @return string
     * @update-time: 2017-03-31 15:03:08
     * @author: 王亚雄
     */
    public function act_desc($cp_hilt,$cp_type){
        if($cp_type==CPTYPE_TIME_FREE){
            $cp_hilt = intval($cp_hilt);
        }
        $cp_free_types = array(
            CPTYPE_MONEY_FREE   =>  "现金减免%s元",
            CPTYPE_TIME_FREE    =>  "时间减免%s小时",
            CPTYPE_ALL_FREE     =>  "全免"
        );
        return sprintf($cp_free_types[$cp_type],$cp_hilt);
    }

    /**
     * 获取活动类型名称
     * @param $attp_id 活动类型id
     * @return mixed
     * @update-time: 2017-03-23 14:58:06
     * @author: 王亚雄
     */
    public function acttype_name($attp_id){

        static $type_names = array();
        if(!$type_names){
            $data = M('acttype')->select();
            foreach($data as $key => $row){
                $type_names[$row['attp_id']] = $row['attp_name'];
            }
        }
        if(!$attp_id){
            return $type_names;
        }


        return $type_names[$attp_id];
    }

    /**
     * 验证用户领取优惠券时，该活动是否合法
     * @param $act_id
     * @return array
     * @update-time: 2017-03-27 18:00:49
     * @author: 王亚雄
     */
    public static $activity_error;
    public function get_activity_error($act_id){
        return array();
    }


    /**
     * 获取最佳优惠券
     * 停车缴费页需要默认选择最合适的优惠券,使得用户享受最大优惠
     * @param $cp_data
     * example:$cp_data = array(
                    array('cp_id'=>1,'cp_hilt'=>5.00,'cp_type'=>CPTYPE_MONEY_FREE),
                    array('cp_id'=>2,'cp_hilt'=>2,'cp_type'=>CPTYPE_TIME_FREE),
                    array('cp_id'=>3,'cp_hilt'=>0,'cp_type'=>CPTYPE_ALL_FREE),
     *         );
     * @park_fee    停车费用
     * @return int  返回cp_id
     * @update-time: 2017-04-05 14:47:39
     * @author: 王亚雄
     */
    public function get_optimal_coupon($cp_data,$park_fee=0){

        //数据整理
        $tmp = array();
        foreach($cp_data as $key => $cp){

            $cp_free = 0;//量化后优惠额度

            switch ($cp['cp_type']){
                case CPTYPE_MONEY_FREE:
                    $cp_free = $cp['cp_hilt'];
                    break;
                case CPTYPE_TIME_FREE:
                    $cp_free = $cp['cp_hilt'] * PARK_FEE_Q1H;
                    break;
                case CPTYPE_ALL_FREE:
                    $cp_free = 9999;
                    break;
            }

            $tmp[$cp['cp_id']] = array(
                'cp_type'=>$cp['cp_type'],
                'cp_hilt'=>$cp['cp_hilt'],
                'cp_free'=>$cp_free
            );

            //如果传入停车费用，并且优惠额度大于停车费用，那么需要寻找最合适的优惠券，而不是优惠额度最大的优惠券，
            //例如停车一小时需要5元，而用户有优惠10元，和15元的优惠券，那么应该选择优惠10元的优惠券
            if($park_fee){
                $tmp[$cp['cp_id']]['cp_optimal'] = abs($park_fee-$cp_free);//最后选取cp_optimal值最小的优惠券
            }
        }


        if($park_fee){//cp_optimal最小则最好

            $arr =  array_map(function($v){
                return $v['cp_optimal'];
            },$tmp);

            $optimal_cp_id =  array_search(min($arr), $arr);


        }else{//没有传入$park_free则比较cp_free 最大则最好

            $arr =  array_map(function($v){
                return $v['cp_free'];
            },$tmp);

            $optimal_cp_id =  array_search(max($arr), $arr);

        }


        return $optimal_cp_id;


    }

    /**
     * 获取该用户可领取的系统优惠券,然后自动领取
     * 通常是在生成订单的时候自动获取
     * @param $user_id
     * @return array 返回领取的优惠券的信息
     * @update-time: 2017-04-06 09:12:19
     * @author: 王亚雄
     */
    public function receive_system_coupons($user_id=0){
        //检查当前有哪些可以领取优惠券的系统活动,
        $map = array();
        $map['act.is_over']      = array('eq','0');
        $map['act.is_del']       = array('eq','0');
        $map['act_end_time'] = array('gt',time());
        $map['act.act_type'] = array('eq',1);
        $field = array(
            'act.act_id',
            'act.act_name',
            'count(1)' =>'coupon_count',
            'group_concat(c.user_id)'=>'receive_users',
            'act.cp_count',
        );
        $system_acts = M('activity act')
            ->field($field)
            ->join('left join __COUPON__ c on act.act_id = c.act_id')
            ->group('act.act_id')
            ->having('coupon_count<cp_count')//已领取的优惠券是不得超过活动允许的优惠券发布数量
            ->where($map)
            ->select();

        //检查该用户是否领取，领取过，禁止领取
        $unreceive_coupons = array(); //该用户未领取的系统优惠券
        $user_id = $user_id?:session('user_id');
        if($system_acts){
            foreach($system_acts as $act){

                $receive_users =$act['receive_users'] ? explode(',',$act['receive_users']) : array();
                if( !$receive_users || !in_array($user_id,$receive_users) ){
                    //领取优惠券
                    $act['user_id'] = $user_id;
                    $act['cp_id'] = $this->receive_coupon($act['act_id']);
                    $unreceive_coupons[] = $act;

                }
            }

        }

        return $unreceive_coupons;


    }

    /**
     * 用户领取优惠券
     * @param $act_id
     * @param int $is_valid
     * @param int $user_id
     * @update-time: 2017-04-06 10:52:04
     * @author: 王亚雄
     */
    public function receive_coupon($act_id,$is_valid=COUPON_STATUS_VALID,$user_id=0){

        $user_id = $user_id?:session('user_id');
        $act_info = $this->act_info($act_id);
        $shop_id = $act_info['cp_lssuer'];
        $time = time();
        $data = array(
            'act_id'        => $act_id,                                            //优惠活动ID
            'cp_no'         => $time . $shop_id . rand(10000, 99999) . rand(1000, 9999),   //随机生成优惠券码(时间戳+商户id+1万到9.9万的随机数+1千到0.9万随机数)
            'car_no'        => '',
            'user_id'       => $user_id,                                 //用户ID
            'add_time'      => $time,                                              //该条数据添加时间
            'start_time'    => $act_info['act_start_time'],                        //有效时间起
            'end_time'      => $act_info['act_end_time'],                          //有效时间终
            'cp_type'       => $act_info['cp_type'],                               //优惠券类型(根据活动表数据进行维护)
            'cp_hilt'       => $act_info['cp_hilt'],                               //根据对应的活动优惠额度进行维护
            'is_public'     => '0',                                                //是否为公开，公开后用户可以绕过接口领取，默认非公开
            'is_valid'      => $is_valid,                               //是否有效，默认为 1(0为自动过期，1为未使用，2为已使用,3待审核)
            'is_del'        => 0                                                   //是否逻辑删除

        );
        $num = M('coupon')->add($data);
        if(!$num){
            return false;
        }
        return $num;


    }

    /**
     * 检测该用户是否拥有该优惠券
     * @param $cp_id
     * @param int $user_id
     * @return bool
     * @update-time: 2017-04-07 16:11:14
     * @author: 王亚雄
     */
    public function is_own_coupon($cp_id,$user_id=0){
        $user_id = $user_id?:session('user_id');
        $count = $this->where('cp_id=%d and user_id=%d',$cp_id,$user_id)->count();
        if($count){
            return true;
        }else{
            return false;
        }
    }



    /**
     * 管理员审核操作时验证优惠券的合法性：
     * @param $cp_id 优惠券ID
     * @update-time: 2017-03-23 16:43:24
     * @author: 王亚雄
     */
    public static  $coupon_error;
    public function check_coupon($cp_id){
        $coupon_info = $this->coupon_info($cp_id);
        //优惠券不存在
        if(!$coupon_info){

            self::$coupon_error = array('err'=>1,'msg'=>"优惠券不存在");

        }else if($coupon_info['is_over']==1){ //活动关闭

            self::$coupon_error = array('err'=>2,'msg'=>"活动关闭");

        }else if($coupon_info['admin_user_id']!=session('user_id')){//如果优惠券不属于该商家发布，拒绝

            //dump($coupon_info);exit();
            self::$coupon_error = array('err'=>3,'msg'=>"你无权审核其他商家发布的优惠券".session('admin_id'));

        }else if($coupon_info['act_end_time']<time()){//优惠券过期

            self::$coupon_error = array('err'=>4,'msg'=>"优惠券过期");

        }else if($coupon_info['is_valid']==COUPON_STATUS_INVALID){//无效的优惠券

            self::$coupon_error = array('err'=>5,'msg'=>"无效的优惠券");

        }else if($coupon_info['is_valid']==COUPON_STATUS_OVERDUE){//过期的优惠券

            self::$coupon_error = array('err'=>6,'msg'=>"过期的优惠券");

        }else if($coupon_info['is_valid']==COUPON_STATUS_DESTROY){//该优惠券被商家作废

            self::$coupon_error = array('err'=>7,'msg'=>"该优惠券被商家作废");

        }else if($coupon_info['is_valid']==COUPON_STATUS_VALID){//已经通过审核的优惠券

            self::$coupon_error = array('err'=>8,'msg'=>"该优惠券已被审核");

        }else{

            self::$coupon_error = array('err'=>0,'msg'=>'');

        }

        return $this;//链式操作

    }

    public function get_coupon_msg(){
        return self::$coupon_error['msg'];
    }

    public function get_coupon_code(){
        return self::$coupon_error['err'];
    }



}