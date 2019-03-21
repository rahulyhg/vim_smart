<?php

namespace Admin\Model;

use Think\Model;

class CouponModel extends Model
{

    /**
     * 获取优惠活动相关信息
     * @param $act_id 优惠活动表ID
     * @return mixed
     * @update-time: 2017-03-17 10:22:40
     * @author: 王亚雄
     */
    public function act_info($act_id)
    {

        $field = array(
            'act_id',
            'a.act_start_time', //活动开始时间
            'a.act_end_time',   //活动结束时间
            'a.act_type',         //活动类型(活动类型表id)
            'a.act_name',
            'a.cp_type',        //优惠方式，例如0为免金额，1为免时间，3为全免等
            'a.cp_hilt',        //单个优惠额度
            'ad.ad_tname',
            'u.user_name',      //用户名称||公司名称
            'u.user_wx_opid'    //openid
        );


        $act_info = M('activity')->alias('a')
            ->field($field)
            ->join('left join __ADMIN__ ad on a.cp_lssuer = ad.ad_id')
            ->join('left join __USER__  u on find_in_set(u.user_id,ad.ad_uid)')
            ->where('act_id=%d', $act_id)
            ->group('a.act_id')
            ->find();
        if ($act_info) {
            $act_info['act_desc'] = $this->act_desc($act_info['cp_hilt'], $act_info['cp_type']);
            $act_info['acttype_name'] = $this->acttype_name($act_info['act_type']);
        }

        return $act_info;
    }


    /**
     * 获取活动类型名称
     * @param $attp_id 活动类型id
     * @return mixed
     * @update-time: 2017-03-23 14:58:06
     * @author: 王亚雄
     */
    public function acttype_name($attp_id)
    {

        static $type_names = array();
        if (!$type_names) {
            $map = array();
            $map['is_del'] = array('eq','0');
            $data = M('acttype')->where($map)->select();
            foreach ($data as $key => $row) {
                $type_names[$row['attp_id']] = $row['attp_name'];
            }
        }
        if (!$attp_id) {
            return $type_names;
        }


        return $type_names[$attp_id];
    }

    /**
     * 获取活动名称
     * @param $act_id
     * @return mixed
     * @update-time: 2017-03-27 10:52:43
     * @author: 王亚雄
     */
    public function act_name($act_id)
    {
        static $act_names = array();
        if (!$act_names) {
            $data = M('activity')->field('act_id,act_name')->select();
            foreach ($data as $key => $row) {
                $act_names[$row['act_id']] = $row['act_name'];
            }
            if (!$act_id) return $act_names;
            return $act_names['act_id'];
        }

    }


    /**
     * 获取优惠券信息
     * @param $cp_id  优惠卷记录id
     * @return array
     * @update-time: 2017-03-23 14:59:43
     * @author: 王亚雄
     */
    public function coupon_info($cp_id)
    {

        static $coupon_info_list = array();//单例
        if (!array_key_exists($cp_id, $coupon_info_list)) {
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
                'act.cp_type',        //优惠方式，例如0为免金额，1为免时间，3为全免等
                'act.cp_hilt',        //单个优惠额度
                'act.is_over',
                'act.act_desc',


                'au.user_name' => 'admin_user_name',      //商家员用户名称
                'uu.user_name' => 'user_user_name',      //用户的用户名
                'uu.user_wxnik',                        //用户的微信昵称

            );
            $coupon_info = $this->alias('c')
                ->field($field)
                ->join('left join __ACTIVITY__ act  on c.act_id = act.act_id')
                ->join('left join __ADMIN__ a       on  a.ad_id = act.cp_lssuer')//获取管理员信息
                ->join('left join __USER__ au        on  find_in_set(au.user_id,ad_uid)')//获取管理员对应的用户信息
                ->join('left join __USER__ uu        on c.user_id = uu.user_id')//获取用户对应的用户信息
                ->where('c.cp_id=%d', $cp_id)
                ->find();
            if ($coupon_info) {
                $coupon_info['act_desc'] = $this->act_desc($coupon_info['cp_hilt'], $coupon_info['cp_type']);
                $coupon_info['acttype_name'] = $this->acttype_name($coupon_info['act_type']);
                $coupon_info_list[$cp_id] = $coupon_info;
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
    public function act_desc($cp_hilt, $cp_type)
    {
        if ($cp_type == CPTYPE_TIME_FREE) {
            $cp_hilt = intval($cp_hilt);
        }
        $cp_free_types = array(
            CPTYPE_MONEY_FREE => "现金减免%s元",
            CPTYPE_TIME_FREE => "时间减免%s小时",
            CPTYPE_ALL_FREE => "全免"
        );
        return sprintf($cp_free_types[$cp_type], $cp_hilt);
    }


}

