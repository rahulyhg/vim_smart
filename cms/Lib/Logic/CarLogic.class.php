<?php
/**
 * 区分于020系统的独立停车场数据模型逻辑类
 * User: 祝君伟
 * Date: 2017/6/8
 * Time: 14:02
 */

class CarLogic extends Model{

    /*
     * 获取停车场用户的基本信息列表
     * param 数组  筛选条件
     * */
    public function get_user_list($condition_array=array()){
        //字段
        $field = array(
            'u.user_id',
            'u.user_wxnik',
            'u.user_phone',
            'group_concat(car.car_id)'=>'car_ids',
            'group_concat(car.car_no)'=>'car_nos',
            'u.user_role_id',
            'r.role_name',
            'u.add_time',
            'g.garage_name'
        );

        //条件
        $map = $condition_array;
        
        //查询
        $list = M()->table('smart_user')->alias('u')
            ->field($field)
            ->join('left join smart_car car on car.user_id = u.user_id')
            ->join('left join smart_role r on u.user_role_id = r.role_id')
            ->join('left join smart_garage g on g.garage_id = car.garage_id')
            ->where($map)
            ->group('u.user_id')
            ->order('u.user_id desc')
            ->select();
        return $list;
    }


    /*
     * 获取停车场缴费信息
     * param 数组 筛选条件
     * */
    public function get_car_pay_record($condition_array=array()){
        //字段
        $field = array(
            'p.pay_id',
            'u.user_id',
            'car.car_id',
            'cp.cp_id',
            'u.user_name', //车主名称
            'serv.car_no', //车牌
            'p.payment', //应付金额
            'p.pay_loan', //实缴金额
            'CASE cp.cp_type' . //优惠金额计算
            ' WHEN ' .CPTYPE_MONEY_FREE .' THEN cp.cp_hilt ' . //金额减免
            ' WHEN ' .CPTYPE_TIME_FREE. ' THEN cp.cp_hilt*' . PARK_FEE_Q1H . //时间减免 量化成金额减免
            ' WHEN ' .CPTYPE_ALL_FREE. ' THEN p.payment' . //全免,量化成金额减免
            ' END'=>'pay_free',//优惠金额
            'g.garage_name',
            'car.car_role', //是否是月卡
            'serv.start_time'=>'in_part_time',//车辆进场时间
            'serv.end_time'=>'out_part_time', //车辆出场时间
            'p.pay_status', //支付状态
            'p.pay_time' //支付时间戳
        );

        //条件
        $map =$condition_array;

        //查询
        $list = M()
            ->table('smart_payrecord')
            ->alias('p')
            ->field($field)
            ->join('left join smart_servicerecord serv on serv.serv_id = p.serv_id')
            ->join('left join smart_car car on car.car_no = serv.car_no')
            ->join('left join smart_garage g on g.garage_id = car.garage_id')
            ->join('left join smart_user u on u.user_id = p.user_id')
            ->join('left join smart_coupon cp on cp.cp_id = p.cp_id')
            ->where($map)
            ->group('p.pay_id')
            ->order('p.pay_id desc')
            ->limit(1000)
            ->select();

        return $list;
    }


    /*
     * 获得停车场的月卡车的基本信息
     *param 数组 筛选条件
     * */
    public function get_yueka_car_list($condition_array=array()){

        //字段
        $field =array(
            'u.user_id',
            'u.user_wxnik',
            'u.user_phone',
            'g.garage_name',
            'c.car_role',
            'c.car_no',
            'c.car_id',
            'c.end_time'
        );

        //条件
        $map['car_role']=array('eq','1');
        if(!empty($condition_array)){
            $map = array_merge($condition_array,$map);
        }
        //查询
        $list = M()->table('smart_car')->alias('c')
            ->field($field)
            ->join('left join smart_user u on c.user_id = u.user_id')
            ->join('left join smart_garage g on c.garage_id = g.garage_id')
            ->where($map)
            ->group('u.user_id')
            ->order('u.user_id desc')
            ->select();
        return $list;
    }

    /*
     * 缴费记录--Tp分页版
     * */
    public function get_car_pay_tp_page($type=1){
        //条件
        $map = array();
        //搜索车主与车牌
        $get = $_GET;
        isset($get['keywords']) && $map['u.user_name|serv.car_no'] = array("like",'%' . $get['keywords'] . '%');
       if($type != 1){
          //非超级管理员的过滤
           $map['g.village_id'] = array('eq',$_SESSION['system']['village_id']);
       }
        $map['pay_status'] =array('eq','1');
        //字段
        $field = array(
            'p.pay_id',
            'u.user_id',
            'car.car_id',
            'cp.cp_id',
            'u.user_name', //车主名称
            'serv.car_no', //车牌
            'p.payment', //应付金额
            'p.pay_loan', //实缴金额
            'CASE cp.cp_type' . //优惠金额计算
            ' WHEN ' .CPTYPE_MONEY_FREE .' THEN cp.cp_hilt ' . //金额减免
            ' WHEN ' .CPTYPE_TIME_FREE. ' THEN cp.cp_hilt*' . PARK_FEE_Q1H . //时间减免 量化成金额减免
            ' WHEN ' .CPTYPE_ALL_FREE. ' THEN p.payment' . //全免,量化成金额减免
            ' END'=>'pay_free',//优惠金额
            'g.garage_name',
            'car.car_role', //是否是月卡
            'serv.start_time'=>'in_part_time',//车辆进场时间
            'serv.end_time'=>'out_part_time', //车辆出场时间
            'p.pay_status', //支付状态
            'p.pay_time' //支付时间戳
        );
        
        //统计数量
        $count = M()
            ->table('smart_payrecord')
            ->alias('p')
            ->field('count(*)')
            ->join('left join smart_servicerecord serv on serv.serv_id = p.serv_id')
            ->join('left join smart_car car on car.car_no = serv.car_no')
            ->join('left join smart_garage g on g.garage_id = car.garage_id')
            ->join('left join smart_user u on u.user_id = p.user_id')
            ->join('left join smart_coupon cp on cp.cp_id = p.cp_id')
            ->where($map)
            ->group('p.pay_id')
            ->select(false);

        //由于使用了group，总条数为
        $count = M()->query("select count(*) as count from ($count) as c")[0]['count'];
        //分页，使用bootstrap 分页样式
        import('@.ORG.bootstrap_page');
        $page = new Page($count,I('get.list_rows',0,'int')?:LIST_ROWS);
        //分页数据

        $list = M()
            ->table('smart_payrecord')
            ->alias('p')
            ->field($field)
            ->join('left join smart_servicerecord serv on serv.serv_id = p.serv_id')
            ->join('left join smart_car car on car.car_no = serv.car_no')
            ->join('left join smart_garage g on g.garage_id = car.garage_id')
            ->join('left join smart_user u on u.user_id = p.user_id')
            ->join('left join smart_coupon cp on cp.cp_id = p.cp_id')
            ->where($map)
            ->group('p.pay_id')
            ->order('p.pay_id desc')
            ->limit($page->firstRow,$page->listRows)
            ->select();
        
        $res_array = array(
            'list'=>$list,
            'count'=>$count,
            'pageStr'=>$page->show()
        );
        return $res_array;
        
    }
}