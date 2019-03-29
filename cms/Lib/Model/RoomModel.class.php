<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/18
 * Time: 17:26
 */
class RoomModel extends Model
{
    protected $tableName = 'house_village_room';
    protected $village_id;

    public function __construct()
    {
        parent::__construct();
        $this->village_id = I('get.village_id',4);
    }

    /**
     * 过滤入住单位列表
     * 入住公司角色只显示自己公司的信息
     * @param $list
     */
    public function filterlist_by_tid(&$list){
        //过滤
        $tid = M('admin')->where('id=%d',session('admin_id'))->getField('tid');
        if($tid){
            $list = array_filter($list,function($v)use($tid){
                return $v['tid'] == $tid;
            });
        }
    }



    /**列表****************************************************************************************************/
    /*************************************************************************************************************/

    //获取业主列表 显示其绑定的租户，设备，
    public function ownerlist($village_id=0){
        $field = array(
            'o.*',
            'group_concat(r1.id ORDER BY r2.room_name,r1.room_name)'=>'room_ids',
            'group_concat(concat(r2.room_name,"-",r1.room_name) ORDER BY r2.room_name,r1.room_name )'=>'room_names',
            'group_concat(r1.tid ORDER BY r2.room_name,r1.room_name )'=>'tids',
            'group_concat(ifnull(t.tenantname,"") ORDER BY r2.room_name,r1.room_name )'=>'tenant_names',
            'r1.village_id',
        );

        if($village_id!=0){
            $list = M('house_village_owner')->alias('o')
                ->field($field)
                ->join('left join __HOUSE_VILLAGE_ROOM__ r1 on find_in_set(o.id,r1.oid)')
                ->join('left join __HOUSE_VILLAGE_ROOM__ r2 on r1.fid=r2.id')
                ->join('left join __HOUSE_VILLAGE_USER_BIND__ t on t.pigcms_id=r1.tid and t.type=1')
                ->where(array('o.village_id'=>$village_id))
                ->group('o.id')
                ->order('o.id desc')
                ->select();
        }else{
            
            $list = M('house_village_owner')->alias('o')
                ->field($field)
                ->join('left join __HOUSE_VILLAGE_ROOM__ r1 on find_in_set(o.id,r1.oid)')
                ->join('left join __HOUSE_VILLAGE_ROOM__ r2 on r1.fid=r2.id')
                ->join('left join __HOUSE_VILLAGE_USER_BIND__ t on t.pigcms_id=r1.tid and t.type=1')
                ->group('o.id')
                ->order('o.id desc')
                ->select();
        }


        if($list){
            foreach($list as &$row){
                if($row['room_ids']){
                    $row['room_id_name'] = array_combine(
                        explode(',',$row['room_ids']),
                        explode(',',$row['room_names'])
                    );
                    $row['room_id_tid'] = array_combine(
                        explode(',',$row['room_ids']),
                        explode(',',$row['tids'])
                    );
                    $row['room_id_tname'] = array_combine(
                        explode(',',$row['room_ids']),
                        explode(',',$row['tenant_names'])
                    )?:array();
                }

                $row['room_names'] = $this->format_room_str(str_replace("-","",$row['room_names']),'<br />');
            }
            unset($row);
        }
//        dump($list);
//        echo mysql_error(); exit();
        return $list;
    }

    /**
     * 获取业主列表 小区列表 显示其绑定的租户，设备
     * @author zhukeqin
     * @param int $village_id
     * @return mixed
     */
    public function ownerlist_updown($village_id=0){

        if(empty($village_id)){
            $list=M('house_village_user_bind')->select();
        }else{
            $list=M('house_village_user_bind')->where('village_id='.$village_id)->select();
        }
        return $list;
    }
    //入住单位列表
    public function tenantlist($ym="",$village_id=0){
        $ym = $ym?:date("Y-m");//缴费记录的指定日期

        $map['type'] = array('eq',1);

        $village_id && $map['t.village_id']=array('eq',$village_id);

        $tid = session('system.tid');

        $tid && $map['t.pigcms_id'] = array('eq',$tid);

        //vd($b_sql);exit;
        $field = array(
            't.*',
            't.name'=>'tname',
            't.phone'=>'tphone',
            'o.fstatus',
            'group_concat(o.ownername)'=>'ownernames',
            'group_concat(o.id)'=>'oids',
            'group_concat(DISTINCT concat(r.id,"-",r.roomsize))'=>'rinfo',
            'group_concat(concat(r2.room_name,"-",r.room_name) ORDER BY r2.room_name,r.room_name )'=>'room_names',
            'r2.tung_unit',
            'p.usernum',
            'p.water_price',
            'p.electric_price',
            'p.gas_price',
            'p.property_price',
            'p.other_price',
            'p.is_enter_list',
            'p.pigcms_id'=>'pid',
            't.pigcms_id'=>'tid',
        );
        $list = M('house_village_user_bind')->alias('t')
            ->field($field)
            ->join('left join __HOUSE_VILLAGE_ROOM__ r on r.tid=t.pigcms_id')
            ->join('left join __HOUSE_VILLAGE_OWNER__ o on find_in_set(o.id,r.oid)')
            ->join('left join __HOUSE_VILLAGE_ROOM__ r2 on r.fid=r2.id')
            ->join("left join __HOUSE_VILLAGE_USER_PAYLIST__ p on p.usernum=t.usernum and create_date='{$ym}'")
            ->group('t.pigcms_id')
            ->order('t.pigcms_id desc')
            ->where($map)
            ->select();
        //dump($list); exit();
       //echo M()->getLastSql();exit();
        if($list){
            foreach($list as &$row){
                $row['ownernames'] = join(',',array_unique(explode(',',$row['ownernames'])));//去重复
                $row['oids'] = join(',',array_unique(explode(',',$row['oids'])));//去重复
                //计算面积
                $row['housesize'] = 0.00;
                $tmp = explode(',',$row['rinfo']);
                if($row['room_names']){
                    $row['room_id_name'] = explode(',',$row['room_names']);

                }
                foreach ($tmp as $v){
                    $row['housesize']  += explode('-',$v)[1];
                }

                $total_water = M('house_village_pay_order')->field(array('*','SUM(actual_payment)'=>'total'))->where(array('pid'=>$row['pid'],'order_type'=>'water','is_pay'=>1))->group('pid')->select()[0]['total']?:0;

                $total_electric = M('house_village_pay_order')->field(array('*','SUM(actual_payment)'=>'total'))->where(array('pid'=>$row['pid'],'order_type'=>'electric','is_pay'=>1))->group('pid')->select()[0]['total']?:0;

                $total_property = M('house_village_pay_order')->field(array('*','SUM(actual_payment)'=>'total'))->where(array('pid'=>$row['pid'],'order_type'=>'property','is_pay'=>1))->group('pid')->select()[0]['total']?:0;

                $total_other = M('house_village_pay_order')->field(array('*','SUM(actual_payment)'=>'total'))->where(array('pid'=>$row['pid'],'order_type'=>'other','is_pay'=>1))->group('pid')->select()[0]['total']?:0;

                $total_all = M('house_village_pay_order')->field(array('*','SUM(actual_payment)'=>'total'))->where(array('pid'=>$row['pid'],'order_type'=>'all','is_pay'=>1))->group('pid')->select()[0]['total']?:0;


                $row['total_water'] = $row['water_price']-$total_water;
                $row['total_electric'] = $row['electric_price']-$total_electric;
                $row['total_property'] = $row['property_price']-$total_property;
                $row['total_other'] = $row['other_price']-$total_other;
                $row['total_price'] = round($row['total_water']+$row['total_electric']+$row['total_property']+$row['total_other']-$total_all,2);

            }
            unset($row);
        }

        return $list;
    }

    public function tenant_getOne($ym="",$village_id=0,$pid=0){
        $ym = $ym?:date("Y-m");//缴费记录的指定日期

        $b_sql = M('house_village_pay_order')->field(array('*','SUM(actual_payment)'=>'total'))->where(array('is_pay'=>1))->group('pid,order_type')->buildSql();

        //echo $b_sql;exit;

        $map['type'] = array('eq',1);

        $village_id && $map['r.village_id']=array('eq',$village_id);

        $pid && $map['b.pid']=array('eq',$pid);

        //vd($b_sql);exit;
        $field = array(
            't.*',
            't.name'=>'tname',
            't.phone'=>'tphone',
            'o.fstatus',
            'group_concat(o.ownername)'=>'ownernames',
            'group_concat(DISTINCT concat(r.id,"-",r.roomsize))'=>'rinfo',
            'group_concat(concat(r2.room_name,"-",r.room_name) ORDER BY r2.room_name,r.room_name )'=>'room_names',
            'p.usernum',
            'if(b.order_type="water", p.water_price-b.total,p.water_price)'=>'total_water',
            'if(b.order_type="electric", p.electric_price-b.total,p.electric_price)'=>'total_electric',
            'if(b.order_type="property", p.property_price-b.total,p.property_price)'=>'total_property',
            'if(b.order_type="other", p.other_price-b.total,p.other_price)'=>'total_other',
            'p.water_price',
            'p.electric_price',
            'p.gas_price',
            'p.property_price',
            'p.other_price',
            'p.is_enter_list',
            'p.pigcms_id'=>'pid'
        );
        $list = M('house_village_user_bind')->alias('t')
            ->field($field)
            ->join('left join __HOUSE_VILLAGE_ROOM__ r on r.tid=t.pigcms_id')
            ->join('left join __HOUSE_VILLAGE_OWNER__ o on find_in_set(o.id,r.oid)')
            ->join('left join __HOUSE_VILLAGE_ROOM__ r2 on r.fid=r2.id')
            ->join("left join __HOUSE_VILLAGE_USER_PAYLIST__ p on p.usernum=t.usernum and create_date='{$ym}'")
            ->join("left join $b_sql as b on b.pid=p.pigcms_id")
            ->group('t.pigcms_id')
            ->order('t.pigcms_id desc')
            ->where($map)
            ->select();

        //echo M()->getLastSql();exit();
        if($list){
            foreach($list as &$row){
                $row['ownernames'] = join(',',array_unique(explode(',',$row['ownernames'])));//去重复
                //计算面积
                $row['housesize'] = 0.00;
                $tmp = explode(',',$row['rinfo']);
                if($row['room_names']){
                    $row['room_id_name'] = explode(',',$row['room_names']);

                }
                foreach ($tmp as $v){
                    $row['housesize']  += explode('-',$v)[1];
                }
            }
            unset($row);
        }


        return $list;
    }

    public function true_bill_list($ym="",$village_id=0,$pid=0){

        //TODO:数据准备

        $ym = $ym?:date("Y-m");//缴费记录的指定日期

        $map['type'] = array('eq',1);

        $village_id && $map['r.village_id']=array('eq',$village_id);

        $pid && $map['p.pigcms_id']=array('eq',$pid);

        $total_water = M('house_village_pay_order')->field(array('*','SUM(actual_payment)'=>'total'))->where(array('pid'=>$pid,'order_type'=>'water','is_pay'=>1))->group('pid')->select()[0]['total']?:0;

        $total_electric = M('house_village_pay_order')->field(array('*','SUM(actual_payment)'=>'total'))->where(array('pid'=>$pid,'order_type'=>'electric','is_pay'=>1))->group('pid')->select()[0]['total']?:0;

        $total_property = M('house_village_pay_order')->field(array('*','SUM(actual_payment)'=>'total'))->where(array('pid'=>$pid,'order_type'=>'property','is_pay'=>1))->group('pid')->select()[0]['total']?:0;

        $total_other = M('house_village_pay_order')->field(array('*','SUM(actual_payment)'=>'total'))->where(array('pid'=>$pid,'order_type'=>'other','is_pay'=>1))->group('pid')->select()[0]['total']?:0;

        $total_all = M('house_village_pay_order')->field(array('*','SUM(actual_payment)'=>'total'))->where(array('pid'=>$pid,'order_type'=>'all','is_pay'=>1))->group('pid')->select()[0]['total']?:0;

        //vd($b_sql);exit;
        $field = array(
            't.*',
            't.name'=>'tname',
            't.phone'=>'tphone',
            'o.fstatus',
            'group_concat(o.ownername)'=>'ownernames',
            'group_concat(DISTINCT concat(r.id,"-",r.roomsize))'=>'rinfo',
            'group_concat(concat(r2.room_name,"-",r.room_name) ORDER BY r2.room_name,r.room_name )'=>'room_names',
            'p.usernum',
            'p.water_price',
            'p.electric_price',
            'p.gas_price',
            'p.property_price',
            'p.other_price',
            'p.is_enter_list',
            'p.pigcms_id'=>'pid'
        );
        $list = M('house_village_user_bind')->alias('t')
            ->field($field)
            ->join('left join __HOUSE_VILLAGE_ROOM__ r on r.tid=t.pigcms_id')
            ->join('left join __HOUSE_VILLAGE_OWNER__ o on find_in_set(o.id,r.oid)')
            ->join('left join __HOUSE_VILLAGE_ROOM__ r2 on r.fid=r2.id')
            ->join("left join __HOUSE_VILLAGE_USER_PAYLIST__ p on p.usernum=t.usernum and create_date='{$ym}'")
            ->group('t.pigcms_id')
            ->order('t.pigcms_id desc')
            ->where($map)
            ->select();

        //echo M()->getLastSql();exit();
        if($list){
            foreach($list as &$row){
                $row['ownernames'] = join(',',array_unique(explode(',',$row['ownernames'])));//去重复
                //计算面积
                $row['housesize'] = 0.00;
                $tmp = explode(',',$row['rinfo']);
                if($row['room_names']){
                    $row['room_id_name'] = explode(',',$row['room_names']);

                }
                foreach ($tmp as $v){
                    $row['housesize']  += explode('-',$v)[1];
                }
                $row['total_water'] = $row['water_price']-$total_water;
                $row['total_electric'] = $row['electric_price']-$total_electric;
                $row['total_property'] = $row['property_price']-$total_property;
                $row['total_other'] = $row['other_price']-$total_other;
                $row['total_price'] = round($row['total_water']+$row['total_electric']+$row['total_property']+$row['total_other']-$total_all,2);

            }
            unset($row);
        }


        return $list;
    }

    public function tenantlist_bck($ym=""){
        $ym = $ym?:date("Y-m");//缴费记录的指定日期
        $field = array(
            't.*',
            'o.fstatus',
            'group_concat(o.ownername)'=>'ownernames',
            'group_concat(DISTINCT concat(r.id,"-",r.roomsize))'=>'rinfo',
            'group_concat(concat(r2.room_name,"-",r.room_name) ORDER BY r2.room_name,r.room_name )'=>'room_names',
            'p.usernum',
            'p.water_price',
            'p.electric_price',
            'p.gas_price',
            'p.property_price',
            'p.other_price',
            'p.is_enter_list',
        );
        $list = M('house_village_user_bind')->alias('t')
            ->field($field)
            ->join('left join __HOUSE_VILLAGE_ROOM__ r on r.tid=t.pigcms_id')
            ->join('left join __HOUSE_VILLAGE_OWNER__ o on find_in_set(o.id,r.oid)')
            ->join('left join __HOUSE_VILLAGE_ROOM__ r2 on r.fid=r2.id')
            ->join("left join __HOUSE_VILLAGE_USER_PAYLIST__ p on p.usernum=t.usernum and create_date='{$ym}'")
            ->group('t.pigcms_id')
            ->order('t.pigcms_id desc')
            ->where('type=1')
            ->select();

        //echo M()->getLastSql();exit();
        if($list){
            foreach($list as &$row){
                $row['ownernames'] = join(',',array_unique(explode(',',$row['ownernames'])));//去重复
                //计算面积
                $row['housesize'] = 0.00;
                $tmp = explode(',',$row['rinfo']);
                if($row['room_names']){
                    $row['room_id_name'] = explode(',',$row['room_names']);

                }
                foreach ($tmp as $v){
                    $row['housesize']  += explode('-',$v)[1];
                }
            }
            unset($row);
        }


        return $list;
    }
    //设备列表
    public function meterlist($ym="",$village_id=0){
        //设备编号，楼层，类型，止码
        $field = array(
            'm.*',
            'c.total_consume',
            'c.last_total_consume'
        );
        $map = array();
        $map['m.is_del'] = array('eq',0);
        $map['m.meter_type_id'] = array('neq',113);
        $village_id && $map['m.village_id'] = array('eq',$village_id);
        if(I('get.is_del')==1){
            $map['m.is_del'] = array('eq',1);
        }
        $list = M('house_village_meters')->alias('m')
            ->field($field)
            ->join("left join {$this->view_consume($ym)} c on c.meter_hash=m.meter_hash")
            ->where($map)
            ->select();
        foreach ($list as &$row){
            list($row['begin_num'],$row['end_num']) = explode(',',$row['be_cousume']);
            $row['meter_type_name'] = $this->get_meter_type_list()[$row['meter_type_id']];
            $row['price_type_name'] = $this->get_price_type_list()[$row['price_type_id']];
            $row['consume'] = $row['total_consume']?$row['total_consume']-$row['last_total_consume']:"当月未抄录";
            $row['is_record'] = $row['total_consume']?1:0;
        }
        unset($row);
        return $list;

    }

    //设备列表
    public function meters_cate($ym="",$village_id=0){
        //设备编号，楼层，类型，止码
        $field = array(
            'm.*',
            'c.total_consume',
            'c.last_total_consume'
        );
        $map = array();
        $map['m.is_del'] = array('eq',0);
        $map['m.meter_type_id'] = array('eq',113);
        $village_id && $map['m.village_id'] = array('eq',$village_id);
        if(I('get.is_del')==1){
            $map['m.is_del'] = array('eq',1);
        }
        $list = M('house_village_meters')->alias('m')
            ->field($field)
            ->join("left join {$this->view_consume($ym)} c on c.meter_hash=m.meter_hash")
            ->where($map)
            ->select();
        foreach ($list as &$row){
            list($row['begin_num'],$row['end_num']) = explode(',',$row['be_cousume']);
            $row['meter_type_name'] = $this->get_meter_type_list()[$row['meter_type_id']];
            $row['meter_cate_name'] = $this->get_meter_cate_list()[$row['cate_id']];
            $row['price_type_name'] = $this->get_price_type_list()[$row['price_type_id']];
            $row['consume'] = $row['total_consume']?$row['total_consume']-$row['last_total_consume']:"当月未抄录";
            $row['is_record'] = $row['total_consume']?1:0;
        }
        unset($row);
        return $list;

    }

    //设备列表
    //修改 适应手机端后台管理
    public function meterlist_two($village_id=0,$more=0,$type="",$search="",$ym=""){
        //type 1,水 5,电
        //设备编号，楼层，类型，止码
        $field = array(
            'm.*',
            'c.total_consume',
            'c.last_total_consume'
        );
        $map = array();
        $map['m.is_del'] = array('eq',0);
        $village_id && $map['m.village_id'] = array('eq',$village_id);
        $type && $map['m.meter_type_id'] = array('eq',$type);
        $search && $map['m.meter_floor|m.meter_code'] = array("like","%{$search}%");
        if(I('get.is_del')==1){
            $map['m.is_del'] = array('eq',1);
        }

        $list = M('house_village_meters')->alias('m')
            ->field($field)
            ->join("left join {$this->view_consume($ym)} c on c.meter_hash=m.meter_hash")
            ->where($map)
            ->limit($more,15)
            ->select();
//        echo M()->_sql();exit;
        foreach ($list as &$row){
            list($row['begin_num'],$row['end_num']) = explode(',',$row['be_cousume']);
            $row['meter_type_name'] = $this->get_meter_type_list()[$row['meter_type_id']];
            $row['price_type_name'] = $this->get_price_type_list()[$row['price_type_id']];
            $row['consume'] = $row['total_consume']?$row['total_consume']-$row['last_total_consume']:"当月未抄录";
            $row['is_record'] = $row['total_consume']?1:0;
        }
        unset($row);
        return $list;

    }

    //设备列表
    //修改 适应手机端后台管理
    public function meterlist_three($village_id=0,$type="",$search="",$ym=""){
        //type 1,水 5,电
        //设备编号，楼层，类型，止码
        $field = array(
            'm.*',
            'c.total_consume',
            'c.last_total_consume'
        );
        $map = array();
        $map['m.is_del'] = array('eq',0);
        $village_id && $map['m.village_id'] = array('eq',$village_id);
        $type && $map['m.meter_type_id'] = array('eq',$type);
        $search && $map['m.meter_floor|m.meter_code'] = array("like","%{$search}%");
        if(I('get.is_del')==1){
            $map['m.is_del'] = array('eq',1);
        }

        $list = M('house_village_meters')->alias('m')
            ->field($field)
            ->join("left join {$this->view_consume($ym)} c on c.meter_hash=m.meter_hash")
            ->where($map)
            ->select();
//        echo M()->_sql();exit;
        foreach ($list as &$row){
            list($row['begin_num'],$row['end_num']) = explode(',',$row['be_cousume']);
            $row['meter_type_name'] = $this->get_meter_type_list()[$row['meter_type_id']];
            $row['price_type_name'] = $this->get_price_type_list()[$row['price_type_id']];
            $row['consume'] = $row['total_consume']?$row['total_consume']-$row['last_total_consume']:"当月未抄录";
            $row['is_record'] = $row['total_consume']?1:0;
        }
        unset($row);
        return $list;

    }

    /**
     * 抄表记录
     * @param string $ym
     * @return mixed
     */
    public function meter_record($ym="",$is_record=-1,$village_id=0){
        $field = array(
            'm.id',
            'm.meter_hash',
            'm.meter_floor',
            'm.meter_code',
            'm.be_cousume',
            'm.meter_type_id',
            'm.price_type_id',
            'm.floor_id',
            'record.last_total_consume',
            'record.total_consume',
            'record.create_time',
            'record.ym',
            'a.realname',
            'record.id'=>'record_id',
        );

        $map = array();

        $map['m.is_del'] = array('eq',0);
        $map['m.meter_type_id'] = array('neq',113);

        $village_id && $map['m.village_id'] = array('eq',$village_id);

        if($is_record!=-1){
            if($is_record){
                $map['record.id'] = array("EXP",'IS NOT NULL');
            }else{
                $map['record.id'] = array("EXP",'IS  NULL');
            }
        }
        //$map['m.village_id'] = array('eq',$_SESSION['system']['village_id']);
        $list = M('house_village_meters')->alias('m')
            ->field($field)
            ->join("left join {$this->view_consume($ym)} record on record.meter_hash=m.meter_hash" )
            ->join('left join __ADMIN__ a on a.id = record.admin_id')
            ->where($map)
            ->select();
        //echo M()->getLastSql();
        foreach($list as &$row){
            $row['is_record'] = $row['total_consume'] ? 1 : 0;
            $row['meter_type_name'] = $this->get_meter_type_list()[$row['meter_type_id']];
            $row['price_type_name'] = $this->get_price_type_list()[$row['price_type_id']];
            if($row['is_record']){
                $row['consume'] = $row['total_consume']-$row['last_total_consume'] ;
                $row['create_time_desc'] = word_time($row['create_time']);
            }else{
                list($row['begin_num'],$row['end_num']) = explode(',',$row['be_cousume']);
                $row['last_total_consume'] = $row['end_num'];
            }
            $row['unit'] = $this->get_config($row['meter_type_id'])['unit'];
            if($row['create_time']){

            }

        }
        return $list;
    }

    /**
     * 修改 曾梦飞
     * 抄表记录
     * @param string $ym
     * @return mixed
     */
    public function meter_record_two($ym="",$is_record=-1,$village_id=0,$search="",$more=0){
        $field = array(
            'm.id',
            'm.meter_hash',
            'm.meter_floor',
            'm.meter_code',
            'm.be_cousume',
            'm.meter_type_id',
            'm.price_type_id',
            'm.floor_id',
            'record.last_total_consume',
            'record.total_consume',
            'record.create_time',
            'record.ym',
            'a.realname',
            'record.id'=>'record_id',
        );

        $map = array();
        if (!empty($search)) {
            $map['m.id|m.meter_floor'] = array("like","%{$search}%");
        }
        $map['m.is_del'] = array('eq',0);

        $village_id && $map['m.village_id'] = array('eq',$village_id);

        if($is_record!=-1){
            if($is_record){
                $map['record.id'] = array("EXP",'IS NOT NULL');
            }else{
                $map['record.id'] = array("EXP",'IS  NULL');
            }
        }

        $list = M('house_village_meters')->alias('m')
            ->field($field)
            ->join("left join {$this->view_consume($ym)} record on record.meter_hash=m.meter_hash" )
            ->join('left join __ADMIN__ a on a.id = record.admin_id')
            ->where($map)
            ->order('id desc')
            ->limit($more,15)
            ->select();



//        echo M()->getLastSql();
        foreach($list as &$row){
            $row['is_record'] = $row['total_consume'] ? 1 : 0;
            $row['meter_type_name'] = $this->get_meter_type_list()[$row['meter_type_id']];
            $row['price_type_name'] = $this->get_price_type_list()[$row['price_type_id']];
            if($row['is_record']){
                $row['consume'] = $row['total_consume']-$row['last_total_consume'] ;
                $row['create_time_desc'] = word_time($row['create_time']);
            }else{
                list($row['begin_num'],$row['end_num']) = explode(',',$row['be_cousume']);
                $row['last_total_consume'] = $row['end_num'];
            }
            $row['unit'] = $this->get_config($row['meter_type_id'])['unit'];
            if($row['create_time']){

            }

        }

        return $list;
    }

    public function get_record($record_id){
        $field = array(
            'm.id',
            'm.meter_hash',
            'm.meter_floor',
            'm.meter_code',
            'm.be_cousume',
            'm.meter_type_id',
            'm.price_type_id',
            'record.last_total_consume',
            'record.total_consume',
            'record.create_time',
            'record.ym',
            'a.realname',
            'record.id'=>'record_id'
        );
        $info = M('re_setmeter')->alias('record')
            ->field($field)
            ->join('left join __HOUSE_VILLAGE_METERS__ m on m.meter_hash = record.meter_hash')
            ->join('left join __ADMIN__ a on a.id = record.admin_id')
            ->where('record.id=%d',$record_id)
            ->find();
        if($info){
            $info['meter_type_name'] = $this->get_meter_type_list()[$info['meter_type_id']];
            $info['price_type_name'] = $this->get_price_type_list()[$info['price_type_id']];
            list($info['begin_num'],$info['end_num']) = explode(',',$info['be_cousume']);
            $info['is_record'] = $info['total_consume'] ? 1 : 0;
            if($info['is_record']){
                $info['consume'] = $info['total_consume']-$info['last_total_consume'] ;
            }
        }
        return $info;
    }

    /**
     * 设备列表 主要为了入住单位绑定设备的设备列表,其他地方也会用到
     * @param string $meter_hash
     * @return mixed
     */
    public function meterlist_for_tenant($meter_hash="",$village_id=4,$ym=""){
        $field = array(
            'm.*',//设备表信息
            'group_concat(DISTINCT t.pigcms_id)'=>'tids',//tids 一个设备可能绑定多个入住单位
            'group_concat(DISTINCT t.tenantname)'=>'tenantnames',//入住单位
            'group_concat(DISTINCT r.id)'=>'rids', //单元id
            'ifnull(f.room_name,"未知楼层")'=>'floor_name', //楼层描述
            'r.village_id',//社区ID
            't.pigcms_id'=>'tid',//tid 似乎没用的
            'm.cate_id'=>'cate_id',//设备用途类型id
            'group_concat(distinct cate.desc)'=>'cate_desc',//设备类型用途描述
            'c.last_total_consume',//抄表记录 上月止码
            'c.total_consume'//抄表记录 止码
        );
        $map = array();
        $map['m.is_del'] = array('eq',0);
        $meter_hash && $map['m.meter_hash'] = array('eq',$meter_hash);
        $village_id && $map['m.village_id'] = array('eq',$village_id);


        $list = M('house_village_meters')->alias('m')
            ->field($field)
            ->join('left join __HOUSE_VILLAGE_ROOM__ r on find_in_set(m.meter_hash,r.meter_hash)')
            ->join('left join __HOUSE_VILLAGE_USER_BIND__ t on r.tid =t.pigcms_id')
            ->join('left join __HOUSE_VILLAGE_ROOM__ f on m.floor_id = f.id')
            ->join('left join __HOUSE_VILLAGE_METER_CATE__ cate on find_in_set(cate.id,m.cate_id)')
            ->join("left join {$this->view_consume($ym)} c on c.meter_hash=m.meter_hash")
            ->group('m.meter_hash')
            ->where($map)
            ->order('CONVERT(floor_name,SIGNED),c.create_time')
            ->select();
        foreach($list as &$row){
            $row['tenantnames'] && $row['tenantnames'] = explode(',',$row['tenantnames']);
            $row['tids'] && $row['tids'] = explode(',',$row['tids']);
        }
        unset($row);


        return $list;
    }

    public function meterinfo_for_tenant($meter_hash="",$village_id=""){
        return $this->meterlist_for_tenant($meter_hash,$village_id)[0];
    }


    public function floor_list(){
        $map = array();
        $map['m.is_del'] = array('eq',0);
        $list = M('house_village_meters')->alias('m')
            ->join('left join __HOUSE_VILLAGE_ROOM__ r on r.id = m.floor_id')
            ->field('m.floor_id,r.room_name')
            ->group('m.floor_id')
            ->order('CONVERT(room_name,SIGNED)')
            ->where($map)
            ->select();
        $tmp = array();
        foreach($list as &$row){
            $tmp[$row['floor_id']] = $row['room_name'];
        }
        return $tmp;
    }


    /**
     * 获取房间列表
     */
    public function get_room_list($room_id=0,$village_id=0){
        static $data = array();
        if($data[$room_id]) return $data[$room_id];
        $map = array();
        $room_id && $map['r1.id'] = array('eq',$room_id);
        $village_id && $map['r1.village_id'] = array('eq',$village_id);
        $field = array(
            'r1.*',
            //房间描述
            //fid=0时为楼层数据，无房间描述
            'if(r1.fid=0,"",r1.room_name)'=>"room_name",
            //楼层描述
            // fid 等于 0（数据为楼层数据）它本身的room_name 就是'楼层';此时 r2.room_name 为 null,
            // fid<>0（数据为房间数据），fid对应的room_name即为 '楼层'
            'ifnull(r2.room_name,r1.room_name)'=>'floor_name',

            "concat(" .
                "CONVERT(r1.village_id,SIGNED)*1000000" . //社区sort 数值
                "+CONVERT(ifnull(r2.room_name,r1.room_name),SIGNED)*10000" .//楼层sort:首位是中文，sort值都等于0，
            ",ifnull(r2.room_name,r1.room_name)" .//楼层描述 ：解决中文排序
            ",CONVERT(if(r1.fid=0,0,r1.room_name),SIGNED)*100)"//房间sort数值
            =>'sort',//排序 社区sort . 楼层sort . 楼层描述 . 房间sort
            "ifnull(group_concat(o.ownername),'')"=>"ownernames",
            "ifnull(group_concat(m.meter_code),'')"=>"meter_codes",
            "ub.tenantname",
            "m.meter_code",
        );

        $room_list = $this->alias('r1')
            ->field($field)
            ->join('left join __HOUSE_VILLAGE_ROOM__ r2 on r1.fid=r2.id')
            ->join('left join __HOUSE_VILLAGE_OWNER__ o on find_in_set(o.id,r1.oid)')
            ->join('left join __HOUSE_VILLAGE_USER_BIND__ ub on ub.pigcms_id=r1.tid')
            ->join('left join __HOUSE_VILLAGE_METERS__ m on find_in_set(m.meter_hash,r1.meter_hash) and m.is_del=0')
            ->order('sort')
            ->group('r1.id')
            ->where($map)
            ->select();
        foreach($room_list as $key=>&$row){
            $row['ownernames'] = set_unique($row['ownernames']);
            $row['meter_codes'] = set_unique($row['meter_codes'] );
        }
        unset($row);
        $data[$room_id] = $room_list;
        return $room_list;
    }


    /**
     * 获取房间列表(小区专用)
     */
    public function get_room_list_two($room_id=0,$village_id=0){
        static $data = array();
        if($data[$room_id]) return $data[$room_id];
        $map = array();
        $room_id && $map['r1.id'] = array('eq',$room_id);
        $village_id && $map['r1.village_id'] = array('eq',$village_id);
        $field = array(
            'r1.*',
            //房间描述
            //fid=0时为楼层数据，无房间描述
            'if(r1.fid=0,"",r1.room_name)'=>"room_name",
            //楼层描述
            // fid 等于 0（数据为楼层数据）它本身的room_name 就是'楼层';此时 r2.room_name 为 null,
            // fid<>0（数据为房间数据），fid对应的room_name即为 '楼层'
            'ifnull(r2.room_name,r1.room_name)'=>'floor_name',

            "concat(" .
            "CONVERT(r1.village_id,SIGNED)*1000000" . //社区sort 数值
            "+CONVERT(ifnull(r2.room_name,r1.room_name),SIGNED)*10000" .//楼层sort:首位是中文，sort值都等于0，
            ",ifnull(r2.room_name,r1.room_name)" .//楼层描述 ：解决中文排序
            ",CONVERT(if(r1.fid=0,0,r1.room_name),SIGNED)*100)"//房间sort数值
            =>'sort',//排序 社区sort . 楼层sort . 楼层描述 . 房间sort
            "ifnull(group_concat(m.meter_code),'')"=>"meter_codes",
            "ub.tenantname",
            "m.meter_code",
        );

        $room_list = $this->alias('r1')
            ->field($field)
            ->join('left join __HOUSE_VILLAGE_ROOM__ r2 on r1.fid=r2.id')
            ->join('left join __HOUSE_VILLAGE_OWNER__ o on find_in_set(o.id,r1.oid)')
            ->join('left join __HOUSE_VILLAGE_USER_BIND__ ub on ub.pigcms_id=r1.tid')
            ->join('left join __HOUSE_VILLAGE_METERS__ m on find_in_set(m.meter_hash,r1.meter_hash) and m.is_del=0')
            ->order('sort')
            ->group('r1.id')
            ->where($map)
            ->select();
        foreach($room_list as $key=>&$row){
            $row['meter_codes'] = set_unique($row['meter_codes'] );
        }
        unset($row);
        foreach ($room_list as &$v) {
            $ownernamesStr = '';
            if ($v['oid']) {
                $oidArr = explode(',',$v['oid']);
                if (!empty($oidArr)) {
                    foreach ($oidArr as $sv) {
                        $name = D('house_village_user_bind')->where(array('pigcms_id'=>$sv))->getField('name');
                        $ownernamesStr .= $name.',';
                    }
                    $ownernamesStr = trim($ownernamesStr,',');
                }
            }
            $v['ownernames'] = $ownernamesStr;

        }
        unset($v);
        $data[$room_id] = $room_list;
        return $room_list;
    }



    /**添加编辑****************************************************************************************************/
    /*************************************************************************************************************/
    public function add_tenant(){
        $tmp = $_POST;
        $data = array(
            'village_id'=>$tmp['village_id'],
            'uid'=>'',
            'usernum'=>$this->create_usernum($tmp['village_id']),
            'entr_card'=>'',
            'name'=>$tmp['name'],
            'phone'=>$tmp['phone'],
            'park_price'=>'',
            'park_flag'=>'',
            'address'=>$tmp['address'],
            'role'=>'',
            'company'=>'',
            'department'=>'',
            'workcard_img'=>'',
            'ac_status'=>'',
            'ac_desc'=>'',
            'is_sadmin'=>'',
            'add_time'=>time(),
            'last_time'=>'',
            'open_num'=>'',
            'id_card'=>'',
            'check_name'=>'',
            'company_id'=>'',
            'card_type'=>'',
            'group_id'=>'',
            'is_pay_user'=>'',
            'tenantname'=>$tmp['ownername'],
            'type'=>1,

        );
//        dump($data);exit();
        $this->startTrans();
        $num = M('house_village_user_bind')->add($data);
        if($num){
            //绑定房间
            $map = array();
            $map['id'] = array('in',$tmp['room_ids']);
            $save_data = array(
                'tid'=>$num,
                'property_unit'=>$tmp['property_unit']
            );
            $res = $this->where($map)->save($save_data);
            if($res!==false){
                $this->commit();
            }else{

                $this->rollback();
                return false;
            }
        }

        return $num;

    }

    /**
     * 添加设备
     * @param $data
     */
    public function add_meter($data){
        $model = M('house_village_meters');
        $num = $model->add($data);
        return $num;
    }

    /**
     * 添加自定义配置
     * @param $data
     */
    public function add_custom($data){
        $model = M('house_village_meters_custom');
        $num = $model->add($data);
        return $num;
    }

    /**
     * 修改自定义配置
     * @param $data
     */
    public function update_custom($data){
        $model = M('house_village_meters_custom');
        $is_set = $model->where(array('custom_id'=>$data['custom_id'],'meter_hash'=>$data['meter_hash']))->select();
        // var_dump($is_set);
        if ($is_set) {
            $res = $model->where(array('id'=>$is_set[0]['id']))->save($data);
        } else {
            $res = $model->add($data);
        }       
        return $res;
    }



    /**单条数据获取****************************************************************************************************/
    /*************************************************************************************************************/

    /**
     * 获取指定业主信息
     * @param $oid  业主ID
     * @return mixed
     */
    public function ownerinfo($oid){
        $field = array(
            'o.*',
            'group_concat(r1.id ORDER BY r2.room_name,r1.room_name)'=>'room_ids',
            'group_concat(concat(r2.room_name,"-",r1.room_name) ORDER BY r2.room_name,r1.room_name )'=>'room_names',
        );
        $info = M('house_village_owner')->alias('o')
            ->field($field)
            ->join('left join __HOUSE_VILLAGE_ROOM__ r1 on find_in_set(o.id,r1.oid)')
            ->join('left join __HOUSE_VILLAGE_ROOM__ r2 on r1.fid=r2.id')
            ->group('o.id')
            ->order('o.id desc')
            ->where('o.id=%d',$oid)
            ->find();
        // echo mysql_error(); exit();
        return $info;
    }

    //入住单位信息
    public function tenantinfo($tid){
        $info = M('house_village_user_bind')->where('type=1 and pigcms_id=%d',$tid)->find();
        return $info;
    }

    //设备信息
    public function meterinfo($meter_hash){
        $info = M('house_village_meters')->where('meter_hash="%s"',$meter_hash)->find();
        return $info;
    }


    /**
     * 获取指定房间信息
     * @param $room_id
     * @return mixed
     */
    public function get_room_info($room_id){
        return $this->get_room_list($room_id)[0];
    }

    /**绑定操作****************************************************************************************************/
    /*************************************************************************************************************/

    //业主绑定房间
    public function owner_bind_room($room_id,$oid){
        $info = $this->where('id=%d',$room_id)->find();
        $oid = add_set($oid,$info['oid']);
        $re = $this->where('id=%d',$room_id)->setField('oid',$oid);
        return $re;
    }

    //业主绑定房间 批量
    public function owner_bind_room_batch($room_ids,$oid){
        $flag = true;
        foreach($room_ids as $room_id){
            $re = $this->owner_bind_room($room_id,$oid);
            $flag *= $re!==false;
        }
        return $flag;
    }

    //业主解绑房间
    public function owner_unbind_room($room_id,$oid){
        $info = $this->where('id=%d',$room_id)->find();
        $oid = del_set($oid,$info['oid']);
        $re = $this->where('id=%d',$room_id)->setField('oid',$oid);
        return $re;
    }



    //入住单位绑定房间
    public function tenant_bind_room($room_id,$tid){
        return $this->where('id=%d',$room_id)->setField('tid',$tid);
    }

    //入住单位解绑房间
    public function tenant_unbind_room($room_id,$tid){
        return $this->where('id=%d',$room_id)->setField('tid',0);
    }

    //入住单位绑定设备
    public function tenant_bind_meter($meter_hash,$tid){
        $data = $this->where('tid=%d',$tid)->select();
        $flag = 1;
        $this->startTrans();
        foreach($data as $row){
            $re = $this->meter_bind_room($row['id'],$meter_hash);
            $flag *= $re!==false;
        }
        if($flag){
            $this->commit();
        }else{
            $this->rollback();
        }
        return $flag;
    }


    //入住单位解绑设备
    public function tenant_unbind_meter($meter_hash,$tid){
        $data = $this->where('tid=%d',$tid)->select();
        $flag = 1;
        $this->startTrans();
        foreach($data as $row){
            $re = $this->meter_unbind_room($row['id'],$meter_hash);
            $flag *= $re!==false;
        }
        if($flag){
            $this->commit();
        }else{
            $this->rollback();
        }
        return $flag;
    }

    //设备绑定房间
    public function meter_bind_room($room_id,$meter_hash){
        $info = $this->where('id=%d',$room_id)->find();
        $meter_hash = add_set($meter_hash,$info['meter_hash']);
        $re = M('house_village_room')->where('id=%d',$room_id)->setField('meter_hash',$meter_hash);
        return $re;
    }

    //设备解绑房间
    public function meter_unbind_room($room_id,$meter_hash){
        $info = $this->where('id=%d',$room_id)->find();
        $meter_hash = del_set($meter_hash,$info['meter_hash']);
        return $this->where('id=%d',$room_id)->setField('meter_hash',$meter_hash);
    }






    /**账单相关****************************************************************************************************/
    /*************************************************************************************************************/

    /**
     * 账单预览
     * 此方法是做账单预览时创建的，其实后边的台账，各种入住单位相关的数据，也使用了此方法。
     * @param int $tid 入住单位ID//过滤条件 为0 不进行条件过滤
     * @param int $village_id 社区ID//过滤条件 为0 不进行条件过滤
     * @param string $ym  年月 date("Y-m",TIME)//过滤条件 为"" 默认使用当前年月
     * @return mixed
     */
    public function preview_list($tid=0,$village_id=0,$ym=""){
        $ym = $ym?:date("Y-m");
//        if($ym!==date("Y-m")){//若不是当月数据使用缓存
//            $data =  $this->get_account_list_log($tid,$village_id,$ym);
//            return $data;
//        }

        $view_consume = $this->view_consume($ym);//当月抄表记录
        //【重要！！！】rinfo连接的字符串过长 group_concat 默认长度为1024，不够用！需要修改
        $this->query('SET SESSION group_concat_max_len = 1500000;');
        $rinfo = $this->create_group_concat_field(//每一个单元的子数据
            array(
                //房间
                'r.id',//房间id
                'r.tid',//租户id
                'r.roomsize',//房间大小
                'concat(r2.room_name,r.room_name)',
                //'r.scale',//
                'r.village_id',
                'r.property_unit',
                //设备
                "if(m.meter_hash<>'',m.meter_hash,'')",//绑定的设备hash
                "if(m.meter_code<>'',m.meter_code,'')",
                "if(m.meter_floor<>'',m.meter_floor,'未知楼层')",
                "if(m.meter_type_id,m.meter_type_id,'')",
                "if(m.price_type_id,m.price_type_id,'')",
                "if(m.be_cousume<>'',m.be_cousume,'')",
                "if(m.be_date<>'',m.be_date,'')",
                "m.is_public",
                //"if(m.rate,m.rate,'')",
                //抄表
                "ifnull(c.id,'')",//当月抄表记录ID,未抄录为 0
                "if(c.id,last_total_consume,'')",//上月止码
                "if(c.id,total_consume,'')",//止码
                "if(c.id,admin_defined_price,'')",//自定义金额
                "if(c.id,defined_price_data,'')",//自定义金额
                "if(c.id,c.create_time,'')",//时间
                //"c.create_time",//shijian
                //比例
                'if(s.tid,s.rate,if(m.rate,m.rate,1))',
                'if(s.tid,s.tts,1.0000)',
                'if(s.tid,s.tos,1.0000)',
            ),true,'|'
        );

        $field = array(
            'r.oid',
            't.*',
            't.pigcms_id'=>'tid',
            'o.fstatus',
            'group_concat(o.ownername)'=>'ownernames',
             $rinfo=>'rinfo',
            'if(p.usernum<>"",1,0)'=>'is_enter_paylist',
            'if(p.is_enter_list<>"",1,0)'=>'is_enter_list',
//            "group_concat(DISTINCT if(m.meter_hash<>'',m.meter_hash,''))"
            'p.use_other',
            'm.set_start_time',
            'm.set_end_time',

        );
        $map['t.type'] = array('eq',1);
        $tid && $map['t.pigcms_id'] = array('eq',$tid);
        $map['o.id'] = array('EXP','IS NOT NULL');
        $village_id && $map['t.village_id'] = array('eq',$village_id);
        $list = M('house_village_user_bind')->alias('t')
            ->field($field)
            ->join('left join __HOUSE_VILLAGE_ROOM__ r on r.tid=t.pigcms_id')
            ->join('left join __HOUSE_VILLAGE_OWNER__ o on find_in_set(o.id,r.oid)')
            ->join("left join __HOUSE_VILLAGE_METERS__ m on find_in_set(m.meter_hash,r.meter_hash) and m.meter_hash!='' and m.is_del=0")
            ->join("left join {$view_consume} c on c.meter_hash=m.meter_hash")
            ->join("left join __HOUSE_VILLAGE_ROOM__ r2 on r.fid = r2.id ")
            ->join("left join __HOUSE_VILLAGE_USER_PAYLIST__ p on t.usernum=p.usernum and p.create_date='{$ym}'")//查询他是否已经出账
            ->join("left join __HOUSE_VILLAGE_TENANT_SCALE__ s on s.tid = t.pigcms_id and s.meter_hash=m.meter_hash")
            ->group('t.pigcms_id')
            ->where($map)
            ->order('t.pigcms_id desc')
            ->select();
        if($list){
            foreach($list as &$row){
                $row['ownernames'] = join(',',array_unique(explode(',',$row['ownernames'])));//去重复
                //房间信息
                $data =  $this->set_room_data($row['rinfo'],$row['tid']);
                $row['room_data'] = $data['room_data'];
                $row['property_data'] =  $data['property_data'];
                $row['stat'] = $data['stat'];
                $row['original_room_data'] = $data['original_room_data'];
                //当月是否都抄录
                $row['is_all_record'] = $this->is_all_recorded($row['stat']['format']);
                $row['combine_status'] = bindec((int)$row['is_enter_paylist'] .(string)$row['is_all_record']);

            }

            unset($row);
        }
        return $list;
    }
    /**
     * 账单预览 小区
     * @author zhukeqin
     * @param int $village_id 社区ID//过滤条件 为0 不进行条件过滤
     * @param string $ym  年月 date("Y-m",TIME)//过滤条件 为"" 默认使用当前年月
     * @return mixed
     */
    public function preview_list_uptown($village_id=0,$ym=""){
        $ym = $ym?:date("Y-m");
        //$view_consume = $this->view_consume($ym);//当月抄表记录
        $field=array(
            'r.*',
            'ru.*',
            't.property_unit',
            'p.desc'=>'project_desc',
            'p.carspace_price'
        );
        $where=array(
            'r.village_id'=>$village_id,
            'r.fid'=>array('neq',0),
            'r.oid'=>array('neq',''),
        );
        $list=M('house_village_room')->alias('r')
            ->field($field)
            ->join('left join __HOUSE_VILLAGE_ROOM_UPTOWN__ ru on r.id=ru.rid')
            ->join('left join __HOUSE_VILLAGE_ROOM_TYPE__ t on r.room_type=t.pigcms_id')
            ->join('left join __HOUSE_VILLAGE_PROJECT__ p on r.project_id=p.pigcms_id')
            ->where($where)
            ->order('r.id desc')
            ->select();
        foreach ($list as $key=>&$value){
            $uidlist=explode(',',$value['oid']);
            $value['oid_list']=M('house_village_user_bind')->where(array('pigcms_id'=>array('IN',$uidlist)))->select();
            $value['pay']=$this->get_paylist_one($value['room_name'],$village_id,$value['project_id'],$ym);
            $value['pay']['use_other']=unserialize($value['pay']['use_other']);
            $value['pay']['use_total']=$value['pay']['use_water']+$value['pay']['use_electric']+$value['pay']['use_gas']+$value['pay']['use_park']+$value['pay']['use_property'];
            foreach ($value['pay']['use_other'] as $key1=>$value1){
                $value['pay']['use_total'] +=$value1;
            }
        }
        return $list;
    }
    /**
     * 统计预览中房间信息,返回一个规整的数组
     */
    public function set_room_data($room_info,$tid){
        $original_room_data = array();
        if($room_info){
            $keys = array(
                //房间信息
                'room_id','tid','roomsize','room_name','village_id', 'property_unit',
                //设备信息
                'meter_hash', 'meter_code','meter_floor','meter_type_id','price_type_id','be_cousume','be_date','is_public',
                //抄表信息
                'record_id', 'last_total_consume','total_consume','admin_defined_price','defined_price_data','create_time',
                //比例
                'rate','scale','tos',

            );
            $arr = explode('|',$room_info);
            foreach($arr as $r){

                $sub =  explode('%',$r);
                //dump($sub);
                $sub =  array_combine($keys,$sub);
               // dump($sub);
                $original_room_data[] = $sub;
            }

        }
        $tmp = array_group_by($original_room_data,'meter_type_id','meter_hash');
        $stat = array();

        foreach($tmp as $k=>&$v){  //$k 为meter_type_id
            if(!empty($k)) $stat['meter_count'][$k] = count($v); //该类型表的数量
            if(!empty($k)) $stat['record_meter_count'][$k] = 0; //已统计表的数量
            foreach($v as $kk=>&$vv){ //$kk 为 meter_hash
                $t = array();
                $t['room_id'] = "";
                $t['tid'] = "";
                $t['roomsize'] = "";
                $t['room_name'] = "";
                $t['property_unit'] = "";
                foreach($vv as $kkk=>$vvv){//$vvv为单个的房间数据，遍历多次就为了合并这些房间数据
                    $t['room_id'] .= $vvv['room_id'].',';
                    $t['tid'] .= $vvv['tid'].',';
                    $t['roomsize'] .= $vvv['roomsize'].',';
                    $t['room_name'] .= $vvv['room_name'].',';
                    $t['property_unit'] .= $vvv['property_unit'].',';
                }
                $t['room_id'] = rtrim( $t['room_id'],',');
                $t['tid'] = rtrim( $t['tid'],',');
                $t['roomsize'] = rtrim( $t['roomsize'],',');
                $t['room_name'] = rtrim( $t['room_name'],',');
                $t['room_name_format'] = $this->format_room_str($t['room_name'],'<br>');
                $t['property_unit'] = rtrim( $t['property_unit'],',');

                $vv = array_merge($vvv,$t);
                if($vv['record_id']){
                    if(!empty($k)) $stat['record_meter_count'][$k]++;
                    //计算费用
                    $vv['unit_price'] = $this->get_unit_price($vv['village_id'],$vv['price_type_id']);
                    $vv['consume'] = $vv['total_consume']-$vv['last_total_consume'];
                    $vv['cost'] = $this->set_cost(
                        $vv['village_id'],
                        $vv['consume'],
                        $vv['rate'],
                        $vv['price_type_id'],
                        $vv['scale']
                    );
                    //自定义金额
                     if($vv['defined_price_data']){
                         $vv['admin_defined_price'] = unserialize($vv['defined_price_data'])[$tid];
    //
                     }


                };
            }
            if(!empty($k)) $stat['format'][$k] =  $stat['meter_count'][$k] .'/'. $stat['record_meter_count'][$k];
            unset($vv);
        }
        unset($v);

        //物业信息
        $property_data = array_group_by($original_room_data,'room_id');
        $tmp2 = array();
        foreach($property_data as $key=>&$row){
            $tmp2[$key] = array(
                'room_id'=>$row[0]['room_id'],
                'tid'=>$row[0]['tid'],
                'roomsize'=>$row[0]['roomsize'],
                'room_name'=>$row[0]['room_name'],
                'property_unit'=>$row[0]['property_unit'],
                'village_id'=>$row[0]['village_id'],
                'scale'=>$row[0]['scale'],
            );
        }
        unset($row);



        $room_data = $tmp;
        $property_data = $tmp2;
        return array('room_data'=>$room_data,'property_data'=>$property_data,'original_room_data'=>$original_room_data,'stat'=>$stat);
    }

    /**
     * 获取设备详细的类型配置
     * @param $meter_type_id
     */
    public function get_config($type_id){
        static $type_list = array();
        if(!$type_list){
            $type_list = M('re_setmeter_config')->select();
            $tmp = array();
            foreach($type_list as $key =>$row){
                $tmp[$row['id']] = $row;
            }
            $type_list = $tmp;
        }
        return $type_list[$type_id];
    }

    /**
     * 获取计费配置
     * @param $village_id 社区ID
     * @param $price_type_id 计费类型
     * @return mixed
     */
    public function get_price_config($village_id,$price_type_id){
        static $village_configs = array(); //静态，re_setmeter_config方法 会访问数据库，在遍历操作中减少访问数据库次数，
        if(!in_array($village_id,array_keys($village_configs))){

            $config_list = re_setmeter_config($village_id);
            $village_configs[$village_id] = $config_list;

        }else{
            $config_list = $village_configs[$village_id];
        }
        foreach($config_list as $row){
            foreach($row['_child'] as $rr){
                if($rr['id']==$price_type_id){
                    $config = $rr;
                    break;
                }
            }
        }
        return $config;
    }
    
    /**
     * 获取单价
     * @param $village_id
     * @param $price_type_id
     * @return mixed
     */
    public function get_unit_price($village_id,$price_type_id){
        $config = $this->get_price_config($village_id,$price_type_id);
        $unit_price = $config['unit_price'];
        return $unit_price;
    }



    /**
     * 计算缴费金额
     * @param $village_id
     * @param $cousume
     * @param int $rate
     * @param $price_type_id
     * @param int $scale
     * @return mixed
     */
    public function set_cost($village_id,$cousume,$rate=1,$price_type_id,$scale=1){
        $unit_price = $this->get_unit_price($village_id,$price_type_id);
        $re =  $cousume*$rate*$unit_price*$scale;
        //dump($unit_price.','.$cousume.','.$rate.','.$scale);
        //$re = ceil($re * 100) / 100;
        return $re;
    }

    /**
     * 管理员设置自定义金额
     * @param $info 设备及抄表数据
     */
    public function admin_defined_price($info){
        //数据库中的抄表数据
        $db_record = M('re_setmeter')->where('id=%d',$info['record_id'])->find();
        //修改前的金额
        $old_price = floatval($db_record['admin_defined_price'])  ?:  floatval($db_record['cost']);


        $defined_price_data = unserialize($db_record['defined_price_data']);
        $tid = explode(',',htmlspecialchars_decode(urldecode($info['tid'])))[0];
        $defined_price_data[$tid] = $info['admin_defined_price'];

        //修改执行
        $save_data = array(
            'admin_defined_price'=>$info['admin_defined_price'],
            'defined_price_data'=>serialize($defined_price_data)
        );
        $res = M('re_setmeter')
            ->where('id=%d',$info['record_id'])
            ->save($save_data);

        //额外操作
        if($res!==false){//查看账单表中是否有当月的数据，若存在则进行修改
            //获取usernum
            $usernum = M('house_village_user_bind')
                ->where('pigcms_id=%d',$info['tid'])
                ->getField('usernum');
//            dump($usernum);
            if(!$usernum) return null;

            //修改后的金额
            $new_price = floatval($info['admin_defined_price'])         ?:  floatval($info['cost']);

            $field_name = $this->get_paylist_price_field($info['meter_type_id']);
            $res2 = M('house_village_user_paylist')
                ->where('usernum="%s"',$usernum,date("Y-m"))
                ->setInc($field_name,$new_price-$old_price);
//            echo $new_price.'-'.$old_price;
//            echo M()->getLastSql();
//            echo mysql_error();
        }

        return $res;
    }

    /**
     * @param $format room_data->stat->format
     * @return bool
     */
    public function is_all_recorded($format=array()){
        if(!$format) return 0;
        $flag = 1;
        foreach($format as $key =>$row){
//            [1] => string(3) "2/1"
//            [5] => string(3) "1/0"
            if(empty($key)) continue; //为绑定设备的房间不进行统计
            list ($a,$b) = explode('/',$row);
            $flag *= $a==$b; //若不相等 则表示没有统计完成
        }
        return $flag;
    }


    /**描述获取****************************************************************************************************/
    /*************************************************************************************************************/

    /**
     * 获取入住状态列表 key:fstuatus val:描述
     */
    public function get_fstatus_list(){
        //房屋入住状态：0.待租待售，1.出租已住入，2.出售已注入，3.出售未注入，4集团自用
        $fstatus_list = array(
            0=>'待租待售',
            1=>'出租已住入',
            2=>'出售已住入',
            3=>'出售未住入',
            4=>'集团自用',
            5=>'待租待售',
            6=>"居民自用"
        );
        return $fstatus_list;
    }



    /**
     * 获取社区列表 key:village_id val:village_name
     * @return array
     */
    public function get_village_list($search=''){
        //添加搜索条件 by zhukeqin
        if(!empty($search)){
            foreach ($search as $k=>$v) {
                $map[$k]=$v;
            }
        }
        if(empty($search)){
            $tmp = M('house_village')->field('village_id,village_name')->select();
        }else{
            $tmp = M('house_village')->field('village_id,village_name')->where($map)->select();
        }
        $village_list = array();
        foreach($tmp as $row){
            $village_list[$row['village_id']] = $row['village_name'];
        }
        return $village_list;

    }

    /**
     * 获取所有设备配
     */
    public function get_type_tree($village_id=''){
        if(empty($village_id)){
            $maps['village_id']='0';
        }else{
            $maps['village_id']=array('in','0,'.$village_id);
        }
        $data = M('re_setmeter_config')->where($maps)->select();
        // $cate = array();
        // foreach ($data as $k => $v) {
        //     $cate = M('house_village_meter_cate')->where(array('meter_type_id'=>$v['id']))->select();
        //     if ($cate) {
        //         $data[$k]['cate'] = $cate;
        //     } else {
        //         continue;
        //     }
            
        // }
        // var_dump($data);exit;
        $data = list_to_tree($data,'id','pid','price_type_list');
        return $data;
    }

    /**
     * 获取所有设备分类
     */
    public function get_meter_cate($meter_type_id=''){
        if(empty($meter_type_id)){
            $maps['meter_type_id']='113';
        }
        $data = M('house_village_meter_cate')->where($maps)->select();
        // $cate = array();
        // foreach ($data as $k => $v) {
        //     $cate = M('house_village_meter_cate')->where(array('meter_type_id'=>$v['id']))->select();
        //     if ($cate) {
        //         $data[$k]['cate'] = $cate;
        //     } else {
        //         continue;
        //     }
            
        // }
        // var_dump($data);
        // $data = list_to_tree($data,'id','pid','price_type_list');
        // var_dump($data);exit;
        return $data;
    }


    /**
     * 获取设备类型
     * @return array
     */
    public function get_meter_type_list(){

        static $meter_type_list =array();
        if(!$meter_type_list){
            $tmp = M('re_setmeter_config')->where('pid=%d',0)->select();
            $meter_type_list = array();
            foreach($tmp as $row){
                $meter_type_list[$row['id']] = $row['desc'];
            }
        }
        return $meter_type_list;

    }

    /**
     * 获取设备分类
     * @return array
     */
    public function get_meter_cate_list($cate_id=0){
        // var_dump($cate_id);
        // var_dump($_GET);exit;
        $meter_cate_list =array();
        if($cate_id){
            $map['id'][] = array('eq',$cate_id);
        }
        
        $tmp = M('house_village_meter_cate')->where($map)->select();
        $meter_cate_list = array();
        foreach($tmp as $row){
            $meter_cate_list[$row['id']] = $row['desc'];
        }
        
        return $meter_cate_list;

    }

    /**
     * 获取计费类型
     * @return array
     */
    public function get_price_type_list($meter_type_id=0,$village_id=''){
        static $price_type_list =array();
        if(!$price_type_list){
            $map = array();
            $map['pid'][] = array('neq',0);
            if($meter_type_id){
                $map['pid'][] = array('eq',$meter_type_id);
                $map['pid'][] = 'and';
            }
            if(!empty($village_id)){
                $map['village_id']=$village_id;
            }
            $tmp = M('re_setmeter_config')->where($map)->select();
            $price_type_list = array();
            foreach($tmp as $row){
                $price_type_list[$row['id']] = $row['desc'];
            }
        }
        return $price_type_list;
    }

    /**
     * 获取租户抄表流程的进行状态
     */
    public function get_combine_status($status=0){
        $arr = array(
            0=>"未抄录完成",
            1=>"未出账",//该住户的设备已经全部抄录，还未出账
            3=>"已出账"
        );
        if($status==='all') return $arr;
        return $arr[$status];
    }

    /**
     *
     */
    public function room_string_change($list){

        foreach ($list as $key=>$value){
            $floor ='';
            $room='';
            $floorArray =array();
            if(is_array($value['room_id_name'])){
                $num = count($value['room_id_name']);
                foreach ($value['room_id_name'] as $kk =>$vv){
                    $floor = explode("-",$vv)[0];
                    $room = explode("-",$vv)[1].'，';
                    if($kk+1==$num){
                        $room = explode("-",$vv)[1];
                    }
                    $floorArray[$floor][]=$room;
                }

            }

            $list[$key]['room_string'] = $floorArray;
        }
        //return $floorArray;

        return $list;
    }

    /**
     * 更新该楼层房间号
     * @param $allowRoomNumber  允许的房间号
     * @param $fid   所属楼层id
     * @param $roomArray  post的房间号checkbox
     * @return bool  是否完成更新
     */
    public function update_room($allowRoomNumber,$fid,$roomArray){
        //设立标志位
        $_flag = false;
        $fatherRoomInfo = M('house_village_room')->find($fid);
        foreach ($allowRoomNumber as $value){
            if(in_array($value,$roomArray)){
                $is_has = M('house_village_room')->where(array('fid'=>$fid,'room_name'=>$value))->find();
                if($is_has){
                    M('house_village_room')->where(array('id'=>$is_has['id']))->data(array('status'=>0))->save();
                    $_flag=true;
                }else{
                    $addArray = array(
                        'fid'=>$fid,
                        'desc'=>'',
                        'room_name'=>$value,
                        'village_id'=>$fatherRoomInfo['village_id']

                    );
                    $res = M('house_village_room')->data($addArray)->add();
                    if($res){
                        $_flag=true;
                    }
                }
            }else{
                $is_has = M('house_village_room')->where(array('fid'=>$fid,'room_name'=>$value))->find();
                if($is_has){
                    M('house_village_room')->where(array('id'=>$is_has['id']))->data(array('status'=>1))->save();
                    $_flag=true;
                }
            }
        }

        return $_flag;

    }
    /**
     * 更新房间信息 小区
     * @author zhukeqin
     * @param $id   房间id
     * @param $roomArray  房间信息
     * @return bool  是否完成更新
     */
    public function update_room_uptown($id,$roomArray){
        //设立标志
        $_flag = false;
        $RoomInfo = M('house_village_room')->where(array('id'=>$id,'village_id'=>$this->village_id))->find();
        if(!empty($RoomInfo)){
            $uptown=$roomArray['uptown'];
            unset($roomArray['uptown']);
            M('house_village_room')->where(array('id'=>$id,'village_id'=>$this->village_id))->data($roomArray)->save();
            $_flag = true;
            $uptownInfo=M('house_village_room_uptown')->where(array('rid'=>$id,'village_id'=>$this->village_id))->find();
            if($uptownInfo['house_type']==0&&$uptown['house_type']!=0){
                $uptown['property_emptytime']=time();
            }elseif($uptown['house_type']==0){
                $uptown['property_emptytime']=1;
            }elseif(!empty($uptown['property_emptytime'])){
                $uptown['property_emptytime']=strtotime($uptown['property_emptytime']);
            }
            if(!empty($uptownInfo)){
                $uptown['addtime']=strtotime($uptown['addtime']);
                $uptown['checktime']=strtotime($uptown['checktime']);
                $uptown['fixhouse_start']=strtotime($uptown['fixhouse_start']);
                $uptown['fixhouse_end']=strtotime($uptown['fixhouse_end']);
                $uptown['updatetime']=time();
                M('house_village_room_uptown')->where(array('rid'=>$id,'village_id'=>$this->village_id))->data($uptown)->save();
            }
        }

        return $_flag;

    }
    /**设备基础配置****************************************************************************************************/
    /*************************************************************************************************************/
    /**
     * 获取设备配置列表
     * @return mixed
     */
    public function meter_config_list($config_id=0,$pid=0){

        $map = array();
        if($config_id) $map['config.id'] = array('eq',$config_id);
        if($pid) $map['pid'] = array('eq',$pid);
        $field = array(
            'config.*',
        );
        $config = M('re_setmeter_config')->alias('config')
            ->field($field)
            ->where($map)
            ->select();
        foreach($config as &$row){
            $custom_config = M('re_setmeter_config_custom')->where('config_id=%d',$row['id'])->select();
            $row['custom_config'] = $custom_config?:array();
            $cate = M('house_village_meter_cate')->where('meter_type_id=%d',$row['id'])->select();
            $row['cate'] = $cate?:array();
            if($row['village_id']==0){
                $row['village_name']='通用';
            }else{
                $village_info=M('house_village')->where(array('village_id'=>$row['village_id']))->find();
                $row['village_name']=$village_info['village_name'];
            }
        }
        unset($row);
        return $config;
    }
    /**
     * 获取设备配置列表 可以按项目获取
     * @author zhukeqin
     * @return mixed
     */
    public function meter_config_village_list($config_id=0,$pid=0,$village_id=0){

        $map = array();
        if($config_id) $map['config.id'] = array('eq',$config_id);
        if($pid) $map['pid'] = array('eq',$pid);
        $map['village_id']=array('eq',$village_id);
        $field = array(
            'config.*',
        );
        $config = M('re_setmeter_config')->alias('config')
            ->field($field)
            ->where($map)
            ->select();        
        foreach($config as &$row){
            $custom_config = M('re_setmeter_config_custom')->where('config_id=%d',$row['id'])->select();
            $row['custom_config'] = $custom_config?:array();
            $cate = M('house_village_meter_cate')->where('meter_type_id=%d',$row['id'])->select();
            $row['cate'] = $cate?:array();
            if($row['village_id']==0){
                $row['village_name']='通用';
            }else{
                $village_info=M('house_village')->where(array('village_id'=>$row['village_id']))->find();
                $row['village_name']=$village_info['village_name'];
            }
            //查询下一级参数
            $row['parameters'] = M('re_setmeter_config')->where(array('pid'=>$row['id'],'is_use'=>1))->select();
            if (!$row['parameters']) {
                $row['parameters']['0'] = array('desc'=>'','sign'=>'','village_id'=>$row['village_id']);
            }
        }
        unset($row);
        return $config;
    }

    /**
     * 获取设备配置 （单条数据）
     * @param $config_id
     * @return mixed
     */
    public function meter_config_info($config_id){
        $info = $this->meter_config_list($config_id)[0];
        return $info;
    }

    /**
     * 获取设备用途类型及配置列表
     * @param int $cate_id
     */
    public function meter_cate_list($cate_id=0){
        $map = array();
        $map['cate.id'] = array('eq',$cate_id);
        $list = M('house_village_meter_cate')->alias('cate')
            ->where($map)
            ->select();
        foreach($list as &$row){
            //获取cate 配置
            $custom_config = M('re_setmeter_config_custom')->where(array('cate_id'=>$row['id'],'is_use'=>1))->select();
            $row['custom_config'] = $custom_config?:array();
            // $row['parameters'] = $custom_config?:array();
            foreach ($row['custom_config'] as $k => &$v) {
                $custom_config1 = M('re_setmeter_config_custom')->where(array('cate_id'=>$v['id'],'is_use'=>1))->select();
                $v['parameters'] = $custom_config1?:array();
            }
            unset($v);
        }
        unset($row);
        return $list;

    }

    /**
     * 获取设备用途类型及配置（单条数据）
     * @param $cate_id
     * @return mixed
     */
    public function meter_cate_info($cate_id){
        $info = $this->meter_cate_list($cate_id)[0];
        return $info;
    }


    /**
     * 保存基础配置
     * @param $data
     */
    public function save_config($data){
        $model = M('re_setmeter_config');
        if($data['id']){//保存
            $config_id = $data['id'];
            $model->where('id=%d',$config_id)->save($data);
            //循环遍历第三级参数，对数据进行处理
            // $Arr = $data['parameters'];
            // foreach ($Arr as $k => &$v) {
            //     if ($v['id']) {
            //         $id = $v['id'];
            //         $model->where('id=%d',$id)->save($v);
            //     } else {
            //         $v['pid'] = $data['id'];
            //         $v['village_id'] = $data['village_id'];
            //         $config_id1 = $model->add($v);
            //     }
            // }
            // unset($v);
        }else{//新增
            $config_id = $model->add($data);
        } 
        $re = $this->save_custom_config($data['custom_config'],$config_id);                        
        return $re ? $config_id : false;

    }

    //根据查询的第三级数据建表
    function create_custom_table($data,$cate_id) {
               
        $model = M('re_setmeter_config_custom');
        $field = $data['sign'];
        $table_name = 'pigcms_'.$field.'_config_record';
        // var_dump($table_name);exit;
        //建表        
        $sql = "create table if not exists $table_name(
            `id` int(11) unsigned key auto_increment comment '主键',
            `meter_id` int(11) comment '设备ID',
            `check_name` varchar(20) comment '检查人',
            `check_time` int(11) comment '检查时间'
        )default character set utf8";
        M()->query($sql);
        // var_dump(M()->_sql());exit;

        //数据库表中原有的字段名
        $db_field = M()->query("select COLUMN_NAME from information_schema.COLUMNS where table_name = $table_name");
        unset($db_field[0]);
        unset($db_field[1]);
        unset($db_field[2]);
        unset($db_field[3]);

        //对数据进行处理
          //表字段添加时数据对比
        $tmp = array();
        foreach($db_field as $key =>$row){
            $Arr = split('_',$row['COLUMN_NAME']);
            $tmp[$Arr[0]] = $Arr;
        }
        unset($Arr);
        $db_field1 = $tmp;
        
          //表字段添加时数据使用
        $tmp = array();
        foreach($db_field as $key =>$row){
            $Arr = split('_',$row['COLUMN_NAME']);
            $tmp[$Arr[1]] = $Arr;
        }
        unset($Arr);
        $db_field2 = $tmp;

        //查询表中的相关数据
        $dataArr = array();
        $field_2 = $model->where(array('cate_id'=>$cate_id))->select();  //二级参数
        foreach ($field_2 as $k => $v) {
            $dataArr[] = $model->where(array('cate_id'=>$v['id']))->select();  //所有的三级参数
        }
        //对查询的参数进行处理
        $tmp = array();
        foreach ($dataArr as $k => $v) {
            foreach ($v as $kk => $vv) {
                $tmp[$vv['key']] = $vv;    
            }              
        }
        $data2 = $tmp;

        //需要使用的数据
        $add_data = array_diff_key($data2,$db_field1);  

        if (count($data2) == count($db_field1)) {
            //需要更新的字段 
            if ($add_data) {
                foreach ($add_data as $k => $v) {
                    $res = M()->query("alter table $table_name change {$db_field2[$v['id']][0]}_{$db_field2[$v['id']][1]} {$v['key']}_{$v['id']} varchar(20)");
                }
            }
        } else {
            //需要增加的字段
            if ($add_data) {
                foreach ($add_data as $k => $v) {
                    $res = M()->query("alter table $table_name add {$v['key']}_{$v['id']} varchar(20) comment '{$v['desc']}'");
                }
            }
        }
    }

    /**
     * 保存设备用途配置
     * @param $data
     * @return bool|mixed
     */
    public function save_cate($data){
        // var_dump($data);
        $model = M('house_village_meter_cate');
        $Arr = array( // 防止数据变更报错
            'id'=>$data['id'],
            'meter_type_id'=>$data['meter_type_id'],
            'desc'=>$data['desc'],
            'sign'=>$data['sign'],
            );
        if($Arr['id']){//保存
            $cate_id = $Arr['id'];
            $model->where('id=%d',$cate_id)->save($Arr);
        }else{//新增
            $cate_id = $model->add($Arr);
        }
        $re = $this->save_custom_cate($data['custom_config'],$cate_id,'cate_id');
        //处理完所有数据后开始更新记录表的字段
        if ($re) {
            $res = $this->create_custom_table($data,$cate_id);
        }
        return $re ? $cate_id:false;
    }

    /**
     * 删除用途类型
     */
    public function del_cate($cate_id){
        //var_dump($cate_id);
        $model1 = M('house_village_meter_cate');
        $model2 = M('re_setmeter_config_custom');

        $model1->startTrans();

        $re1 = $model1->where('id=%d',$cate_id)->delete();
        $re2 = $model2->where('cate_id=%d',$cate_id)->delete();
        if($re1!==false&&$re2!==false){
            $model1->commit();
            return true;
        }else{
            $model1->rollback();
            return false;
        }
    }

    /**
     * 删除用途类型
     */
    public function del_meter_cate($cate_id){
        //var_dump($cate_id);
        $model = M('re_setmeter_config_custom');

        $model->startTrans();
        $map = array('is_use'=>0);
        $re1 = $model->where('id=%d',$cate_id)->save($map);
        $re2 = $model->where('cate_id=%d',$cate_id)->save($map);
        if($re1!==false&&$re2!==false){
            $model->commit();
            return true;
        }else{
            $model->rollback();
            return false;
        }
    }

    /**
     * 保存自定义配置
     * @param $data
     * @param $_id config_id or cate_id
     * @return bool
     */
    public function save_custom_cate($data,$_id,$field="cate_id"){
        // var_dump($data);
        $model = M('re_setmeter_config_custom');
        $db_data = $model->where($field.'=%d',$_id)->select();
        //循环查找其下一级的数据
        foreach ($db_data as $k => &$v) {
            $v['parameters'] = $model->where(array('cate_id'=>$v['id']))->select();
        }
        unset($v);
        // var_dump($db_data);
        
        //新增数据
        $add_data = array();
        foreach($data as $key =>&$row){
            $row['val'] = str_replace(PHP_EOL,'',$row['val']);//删除换行
            $row['cate_id'] = $_id;
            if(!$row['id']) $add_data[] = $row;
            foreach ($row['parameters'] as $k => &$v) {
                $v['val'] = str_replace(PHP_EOL,'',$v['val']);//删除换行
                $v['cate_id'] = $row['id'];
                if(!$v['id']) $add_data[] = $v;
            }
            unset($v);
        }
        unset($row);
        // var_dump($add_data);

        //处理数据，data，db_data 使用id 作为key
        $tmp = array();
        foreach($data as $k =>$v){
            $data1 = $v['parameters'];
            unset($v['parameters']);
            $tmp[$v['id']] = $v;
            foreach ($data1 as $kk => $vv) {
                $tmp[$vv['id']] = $vv;
            }           
        }
        $data = $tmp;
        // var_dump($data);

        $tmp = array();
        foreach($db_data as $key =>$row){
            $data2 = $row['parameters'];
            unset($row['parameters']);
            $tmp[$row['id']] = $row;
            foreach ($data2 as $kk => $vv) {
                $tmp[$vv['id']] = $vv;
            }            
        }
        $db_data = $tmp;
        // var_dump($db_data);

        //需要删除的数据
        $del_data = array_diff_key($db_data,$data);

        //需要更新的数据
        $update_data = array_intersect_key($data,$db_data);
        // var_dump($add_data);
        // var_dump($del_data);
        // var_dump($update_data);
        // exit;
        //执行操作
        //事务
        $model->startTrans();
        $flag = 1; //flag

        

        //执行添加
        if($add_data){
            foreach($add_data as $key =>$row){

                //查询表中是否存在该字段，存在则启用，不存在则添加
                $is_set = $model->where(array('key'=>$row['key']))->select();
                // var_dump($is_set);
                if ($is_set) {
                    $row['is_use'] = 1;
                    $row['create_time'] = time();
                    $re = $model->where(array('id'=>$is_set[0]['id']))->save($row);
                    
                    $flag *= $re!==false;
                } else {
                    $row['create_time'] = time();
                    $re = $model->add($row);
                    $flag *= $re!==false;
                }

                // $row[$field] = $_id;
                // $row['create_time'] = time();
                // $re = $model->add($row);
                // $flag *= $re!==false;
            }
            // var_dump($flag);
            // var_dump(M()->_sql());
        }
        // var_dump(M()->_sql());

        //执行更新
        if($update_data){
            foreach($update_data as $key =>$row){
                $re = $model->where('id=%d',$key)->save($row);
                $flag *= $re!==false;
            }
        }

        //执行删除
        if($del_data){
            foreach($del_data as $key => $row){
                $row['is_use'] = 0;
                $row['create_time'] = time();
                $re = $model->where('id=%d',$key)->save($row);               
                $flag *= $re!==false;
            }
        }

        //事务提交
        if($flag){
            $model->commit();
        }else{
            $model->rollback();
        }

        return $flag?true:false;

    }

    /**
     * 保存自定义配置
     * @param $data
     * @param $_id config_id or cate_id
     * @return bool
     */
    public function save_custom_config($data,$_id,$field="config_id"){
        $model = M('re_setmeter_config_custom');
        $db_data = $model->where($field.'=%d',$_id)->select();
        //新增数据
        $add_data = array();
        foreach($data as $key =>&$row){
            $row['val'] = str_replace(PHP_EOL,'',$row['val']);//删除换行
            if(!$row['id']) $add_data[] = $row;
        }
        unset($row);
        //print_r($data);
        //处理数据，data，db_data 使用id 作为key
        $tmp = array();
        foreach($data as $key =>$row){
            $tmp[$row['id']] = $row;
        }
        $data = $tmp;
        $tmp = array();
        foreach($db_data as $key =>$row){
            $tmp[$row['id']] = $row;
        }
        $db_data = $tmp;
        //需要删除的数据
        $del_data = array_diff_key($db_data,$data);
        // var_dump($del_data);

        //需要更新的数据
        $update_data = array_intersect_key($data,$db_data);

        //执行操作
        //事务
        $model->startTrans();
        $flag = 1; //flag

        //执行添加
        if($add_data){
            foreach($add_data as $key =>$row){
                $row[$field] = $_id;
                $row['create_time'] = time();
                $re = $model->add($row);
                $flag *= $re!==false;
            }
        }

        //执行更新
        if($update_data){
            foreach($update_data as $key =>$row){
                $re = $model->where('id=%d',$key)->save($row);
                $flag *= $re!==false;
            }
        }

        //执行删除
        if($del_data){
            foreach($del_data as $key => $row){
                $re = $model->where('id=%d',$key)->delete();
                $flag *= $re!==false;
            }
        }

        //事务提交
        if($flag){
            $model->commit();
        }else{
            $model->rollback();
        }

        return $flag?true:false;

    }


    /**
     * 保存自定义参数配置
     * @param $data
     * @param $_id config_id or cate_id
     * @return bool
     */
    public function save_custom_parameters_config($data,$id){
        $model = M('re_setmeter_config');        
        $db_data = $model->where(array('pid'=>$id,'is_use'=>1))->select();
        //新增数据
        $add_data = array();
        foreach($data as $key =>&$row){
            $row['desc'] = str_replace(PHP_EOL,'',$row['desc']);//删除换行
            if(!$row['id']){
                $add_data[] = $row;
            } 
        }
        unset($row);
        // print_r($add_data);
        //处理数据，data，db_data 使用id 作为key
        $tmp1 = array();
        foreach($data as $key =>$row){
            $tmp1[$row['id']] = $row;
        }
        $data = $tmp1;
        $tmp2 = array();
        foreach($db_data as $key =>$row){
            $tmp2[$row['id']] = $row;
        }
        $db_data = $tmp2;
        // var_dump($db_data);
        // var_dump($data);
        //需要删除的数据
        $del_data = array_diff_key($db_data,$data);
        // var_dump($del_data);
        //需要更新的数据
        $update_data = array_intersect_key($data,$db_data);

        //执行操作
        //事务
        $model->startTrans();
        $flag = 1; //flag

        //执行添加
        if($add_data){
            foreach($add_data as $key =>$row){
                //查询表中是否存在该字段，存在则启用，不存在则添加
                $is_set = $model->where(array('sign'=>$row['sign']))->select();
                if ($is_set) {
                    $re = $model->where(array('id'=>$is_set[0]['id']))->save(array('is_use'=>'1'));
                    $flag *= $re!==false;
                } else {
                    $row['pid'] = $id;
                    $re = $model->add($row);
                    $flag *= $re!==false;
                }
                
            }
            //echo $model->getLastSql();
        }

        //执行更新
        if($update_data){
            foreach($update_data as $key =>$row){
                $re = $model->where(array('id'=>$key))->save($row);
                $flag *= $re!==false;

            }
        }

        //执行删除
        if($del_data){
            foreach($del_data as $key => $row){
                $re = $model->where(array('id'=>$key))->save(array('is_use'=>0));
                $flag *= $re!==false;

            }
        }
        //事务提交
        if($flag){
            $model->commit();
        }else{
            $model->rollback();
        }

        return $flag?true:false;

    }

    /**
     * 配置删除
     * @param $config_id
     * @return bool
     */
    public function del_config($config_id){
        $model1 = M('re_setmeter_config');
        $model2 = M('re_setmeter_config_custom');
        //递归获取子id
        $config_ids = $this->get_child_id($model1,$config_id);
        $config_ids[] = $config_id;//取的子id当然还有加上自己
        //事务开始
        $model1->startTrans();

        //删除默认配置
        $map1 = array();
        $map1['id'] = array('in',$config_ids);
        $re1 = $model1->where($map1)->delete();

        //删除自定义配置
        $map2 = array();
        $map2['config_id'] = array('in',$config_ids);
        $re2 = $model2->where($map2)->save(array('is_use'=>0));

        $re = $re1!==false && $re2 !==false;

        //提交
        if($re){
            $model1->commit();
        }else{
            $model2->rollback();
        }

        return $re;
    }

    /**
     * 获取设备额外属性
     * @param $meter_hash
     */
    public function get_custom_info($meter_hash,$cate_id=0){
        //获取设备数据
        $meter =  M('house_village_meters')->where('meter_hash="%s"',$meter_hash)->find();
        $field = array(
            'custom.*',
            'custom.val'=>'default_val', //默认值
            'custom.id'=>'config_custom_id', //配置自定义表的ID
            'mc.val'=>'val', //实际值
            'mc.id'=>'meter_custom_id' //设备自定义属性的值的ID
        );

        //获取设备额外的属性值
        $map = array();//条件
        $map['_complex'] = array(
            'custom.config_id'=>array('eq',$meter['meter_type_id']),//获取父类配置
            '_logic'=>'or'
        );
        if($cate_id){//若指定了cate_id 则只取该cate_id 的配置
            $map['_complex']['custom.cate_id'] = array('eq',$cate_id);
        }else{//没有指定则把该设备所属的所有用途配置全部取出
            $map['_complex']['_string'] = "find_in_set(custom.cate_id,'{$meter['cate_id']}')";
        }


        $info = M('re_setmeter_config_custom')->alias('custom') //自定义设备配置表
            ->field($field)
            ->join('left join __HOUSE_VILLAGE_METERS_CUSTOM__ mc ' .
                'on mc.custom_id=custom.id and mc.meter_hash="'.$meter_hash.'"') //[custom_id,meter_hash]组合是该表数据的唯一标识
            ->where($map)
            ->select();


        //求值
        foreach($info as &$row){
            //将设备表的数据，填充到这里，方便取值
            $row['meter_hash'] = $meter_hash;
            $row['meter_code'] = $meter['meter_code'];
            $row['meter_floor'] = $meter['meter_floor'];
            //根据表单类型设置默认值,不存在实际值则使用默认值
            if($row['type']==="select"){
                //下拉菜单的默认值为default_val逗号分割后数组的第一个
                $row['val'] = $row['val'] ?: explode(',',$row['default_val'])[0];
            }else{
                //其他的为default_val
                $row['val'] = $row['val'] ?: $row['default_val'];
            }
        }
        unset($row);
        return $info;
    }


    /**
     * 保存设备额外配置
     * @param $data
     */
    public function save_meter_custom($data){
        $model = M('house_village_meters_custom');
        foreach($data as $row){
            $data = array(
                'meter_hash'=>$row['meter_hash'],
                'custom_id'=>$row['config_custom_id'],
                'val'=>$row['val'],
            );
            if($row['meter_custom_id']){//保存
                $re = $model
                    ->where('meter_hash="%s" and custom_id=%d',$row['meter_hash'],$row['config_custom_id'])
                    ->save($data);
            }else{//新增
                $re = $model->add($data);
            }
        }

        return $re;


//        Array
//        (
//            [data] => Array
//            (
//                [0] => Array
//                (
//                    [id] => 42
//                    [key] => transformer
//        [val] => 1号变压器
//        [config_id] => 5
//                    [cate_id] => 0
//                    [pid] => 0
//                    [desc] => 线路
//        [sort] => 0
//                    [create_time] => 1511234671
//                    [type] => select
//        [default_val] => 1号变压器,
//2号变压器,
//3号变压器,
//4号变压器
//        [config_custom_id] => 42
//                    [meter_custom_id] =>
//                )
//
//            [1] => Array
//        (
//            [id] => 46
//                    [key] => 444
//                    [val] => 555
//                    [config_id] => 0
//                    [cate_id] => 1
//                    [pid] => 0
//                    [desc] => 照明属性2
//        [sort] => 0
//                    [create_time] => 1511420809
//                    [type] => input_text
//        [default_val] => 555
//                    [config_custom_id] => 46
//                    [meter_custom_id] =>
//                )
//
//            [2] => Array
//        (
//            [id] => 47
//                    [key] => 3333
//                    [val] => 4444
//                    [config_id] => 0
//                    [cate_id] => 1
//                    [pid] => 0
//                    [desc] => 照明属性1
//        [sort] => 0
//                    [create_time] => 1511420809
//                    [type] => input_text
//        [default_val] => 4444
//                    [config_custom_id] => 47
//                    [meter_custom_id] =>
//                )
//
//        )
//
//)




    }

    /**工具****************************************************************************************************/
    /*************************************************************************************************************/
    /**
     * 获取所有子节点ID
     * @param $model
     * @param string $id
     * @param string $pid
     */
    public function get_child_id($model,$id=0,$id_column_name="id",$pid_column_name="pid"){
        static $arr = array();
        $map = array();
        $map[$pid_column_name] = array('eq',$id);
        $ids = $model->field($id_column_name)->where($map)->select()?:array();

        $ids = array_column($ids,$id_column_name);
        $arr = array_merge($arr,$ids);//储存
        if($ids){
            foreach($ids as $id){
                $this->get_child_id($model,$id,$id_column_name,$pid_column_name);
            }
        }
        return $arr;

    }

    /**
     * 创建较复杂的group_concat语句
     * @param $arr
     * @param bool $distinct 是否过滤重复
     * @param string $order TODO
     * @return string
     */
    protected function create_group_concat_field($arr,$distinct=true,$separator=",",$order=""){
        $str = sprintf(
            "group_concat(%s concat(%s) separator '%s' %s)",
            $distinct?'DISTINCT':"",
            join(',"%",',$arr),
            $separator,
            $order?'order by' . $order : ""
        );
        return $str;
    }

    /**
     * 获取指定月份抄表信息
     * @param $meter_hash 设备编号
     */
    public function get_month_record($meter_hash,$ym=""){
        $ym = $ym ?: date("Y-m"); //默认取当权月份
        $info =  M()->table($this->view_consume($ym))->alias('c')
            ->where("meter_hash='%s'",$meter_hash)
            ->find();
        return $info;

    }

    /**
     * 创建新的订单
     * @param $tenant_bill
     * @param string $ym
     * @return array
     */
    public function create_bill($tenant_bill,$ym=''){
        $billArray = array();
        $totalWater=0;$totalElectric=0;$totalProperty=0;$totalWaterPrice=0;$totalElectricPrice=0;$totalPropertyPrice=0;
        $billArray['village_id'] = $tenant_bill['village_id'];
        $billArray['usernum'] = $tenant_bill['usernum'];
        $billArray['name'] = $tenant_bill['name']?:'';
        $billArray['phone'] = $tenant_bill['phone']?:'';
        //水电费
        foreach ($tenant_bill['room_data'] as $key=>$value){
            if($key==1){
                //当标识等于1的时候，为水表
                foreach ($value as $vv){
                    $totalWaterPrice +=floatval($vv['admin_defined_price'])?:$vv['cost'];
                    $price_difference = $vv['total_consume']-$vv['last_total_consume'];
                    $totalWater += $price_difference;
                }

            }else if($key==5){
                //当标识等于5时，为电表
                foreach ($value as $vv){
                    $totalElectricPrice +=floatval($vv['admin_defined_price'])?:$vv['cost'];
                    $price_difference = $vv['total_consume']-$vv['last_total_consume'];
                    $totalElectric += $price_difference;
                }

            }
        }
        $billArray['use_water'] = $totalWater?:0;
        $billArray['water_price'] = $totalWaterPrice?:0;
        $billArray['use_electric'] = $totalElectric?:0;
        $billArray['electric_price'] = $totalElectricPrice?:0;

        //物业费
        foreach ($tenant_bill['property_data'] as $vs){
            $totalProperty += $vs['roomsize'];
            $totalPropertyPrice += $vs['roomsize']*$vs['property_unit'];
        }
        $billArray['use_property'] = $totalProperty?:0;
        $billArray['property_price'] = $totalPropertyPrice?:0;

        //其他字段
        $billArray['create_date']     = $ym?:date("Y-m");
        $billArray['add_time']        = time();
        $billArray['is_enter_list']   = 0;

        return $billArray;
    }



    /**
     * 根据设备类型 获取账单表中对应的字段名
     * @param $meter_type_id
     */
    protected function get_paylist_price_field($meter_type_id){
        switch ($meter_type_id){
            case 1: $field = 'water_price' ;    break;
            case 5: $field = 'electric_price';  break;
            case 9: $field = 'gas_price';       break;
            default: $field = false;
        }
        return $field;
    }

    /**
     * 创建设备二位码
     * @param $meter_hash
     * @return string
     */
    public function create_meter_qr($meter_hash){
        $url = C('WEB_DOMAIN') . '/wap.php?g=Wap&c=Meter&a=enter&meter_hash=' . $meter_hash;
        $qr_img_url =  U('Room/show_qr') . '&url=' . urlencode($url);
        return $qr_img_url;
    }

    //将下列格式的房间号处理成
    //example：12F01,12F02,12F03,12F05,12F06,13F02
    //          => 12F(01,02,03,05,06);
    public function format_room_str($room_str,$floor_delimiter="&nbsp"){
        if(is_string($room_str)){
            $room_arr = explode(',',$room_str);
        }else{
            $room_arr = $room_str;
        }
        $tmp = array();
        foreach($room_arr as $row){
            preg_match('/(\d*?)f[^\d]?(\d+)/i',$row,$match);
            $floor = $match[1];
            $room = sprintf("%02d", $match[2]);
            $tmp[$floor][] = $room;
        }

        ksort($tmp);
        $str = "";
        foreach($tmp as $key=>$row){
            $str .= $key."F";
            $str .= "(";
            //$str .= join(",",$row);
            //取首尾单元进行拼接
            $row = array_unique($row);
            $str .= array_shift($row) . ( count($row) ? "-" : '' ) . array_pop($row);
            $str .= ")$floor_delimiter";
            //$str = str_replace("(01)","",$str);//只有01的楼层 去掉房间号
        }
        return $str;
    }

    /**
     * 房间id转房间名称
     * @param $room_id
     * @return mixed
     */
    public function room_id2name($room_id){
        if(is_array($room_id)){
            $arr = array();
            foreach($room_id as $id){
                $arr[] = M('house_village_room')->where('id=%d',$id)->getField('room_name');
            }
            return $arr;
        }
        return M('house_village_room')->where('id=%d',$room_id)->getField('room_name');
    }



    /**
     * 创建usernum
     * @param int $village_id
     * @return string
     */
    protected function create_usernum($village_id=4){
        switch ($village_id){
            case 4: $pr = "GFYH";break;
            case 2: $pr = "YLW";break;
            default: return false;
        }
        return $pr . date("YmdHis") .mt_rand(100000,999999);//
    }

    /**
     * 创建meter_hash
     * @param $meter_code
     * @param $meter_floor
     * @param int $village_id
     * @return string
     */
    public function create_meter_hash($meter_code,$meter_floor,$village_id=4){
        return MD5($meter_code . '&&' . $meter_floor . '&&' . intval($village_id));
    }





    /**关系视图****************************************************************************************************/
    /*************************************************************************************************************/


    /**
     * 获取指定月份的抄表记录，去重复后的视图
     * @param $ym 时间 默认为当前年月
     * @return string
     *
     */
    protected function view_consume($ym=""){
        $ym = $ym?:date("Y-m");
        return <<<sql
(
	SELECT
		*, FROM_UNIXTIME(tmp.create_time, '%Y-%m') create_date
	FROM
		(SELECT * FROM pigcms_re_setmeter ORDER BY create_time DESC) AS tmp
    WHERE FROM_UNIXTIME(tmp.create_time, '%Y-%m') = '$ym'
	GROUP BY
		tmp.meter_hash,create_date
)
sql;

    }

    /**
     * 分割好的oid的数据视图
     * time_zone //任意表
     * Time_zone_id //任意表连续主键 和业务无关
     */
    protected function view_base($is_sql=true){
        $field = array(
            'a.*',
            "substring_index(substring_index(a.oid,',',b.Time_zone_id + 1),',' ,- 1)"=>'oid'
        );
        $view = $this->alias('a')
            ->field($field)
            ->join("JOIN mysql.time_zone b ON b.Time_zone_id < (length(a.oid) - length(REPLACE(a.oid, ',', '')) + 1)")
            ->order('a.id')
            ->select($is_sql?false:null);
        return $view;
    }


    /**
     * 业主租户关联视图
     */
    protected function view_ot(){
        return $this
            ->group('oid,tid')
            ->select(false);
    }

    /**
     * 业主设备关联视图
     */
    protected function view_om(){

    }

    /**
     * 租户设备关联视图
     */
    protected function view_tm(){

    }



    /**数据导入****************************************************************************************************/
    /*************************************************************************************************************/





    /**
     * 表格数据导入1，钰龙湾业主数据导入
     * 文件参考格式
     * http://www.hdhsmart.com/upload/example/owner.xlsx
     */
    public function owner_excel_to_data($file,$village_id){
        $arr = import_excel($file,'G');
        $tmp = array();
        $title = array(
            '客户名称',
//            '所在社区',
            '栋单元',
            '楼层',
            '房间号',
            '房屋面积（㎡）',
            '物业单价（￥）',
        );
        unset($arr[0]);
        //匹配正则
        $pattern = "/(.*)-(\d{1,2}(?=\d{2})|\d{0}(?=\d{1}))(\d*)/u";
        $room_hash_arr = [];//记录room_hash 为查询是否为重复数据做准备
        foreach($arr as $key=> $row){
            preg_match($pattern,$row[0],$matches);
            //$matches[0] 为符合格式的原数据
            //$matches[1] 栋-单元
            //$matches[2] 楼层
            //$matches[3] 为房间号
            //商铺、复式楼数据没有楼层，将其楼层设置为 1 ,房间号需要补0
            if(!$matches[2]){
                $matches[2] = 1;
                $matches[3] = sprintf("%02d", $matches[3]);
            }

            list($original,$tung_unit,$floor_name,$room_name) = $matches;
            $room_hash = $this->create_room_hash($village_id,$tung_unit,$floor_name,$room_name);
            $room_hash_arr[] = $room_hash;
            $tmp[$room_hash] = array(
                'ownername'=>$row[1],
                'tung_unit'=>$tung_unit,
                'floor_name'=>$floor_name . 'F', //加个F
                'room_name'=>$room_name,
                'roomsize'=>$row[2],
                'property_unit'=>$row[3],
                'original' =>$original,
                'room_hash'=>$room_hash,
                'is_exist'=>0
            );

        }

        $map = array();
        $map['room_hash'] = array('in',$room_hash_arr);
        $matche_database_room_hash_arr = $this->field('room_hash')->where($map)->select();
        $matche_database_room_hash_arr = array_column($matche_database_room_hash_arr,'room_hash');
        //标记已存在数据
        foreach($tmp as $room_hash=>&$row){
            if(in_array($room_hash,$matche_database_room_hash_arr)){
                $row['is_exist'] = 1;
            }
        }
        unset($row);

        $data = array(
            'title'=>$title,
            'body'=>$tmp
        );

        return $data;
    }
    /**
     * 表格数据导入1，钰龙湾业主数据导入 小区
     * 文件参考格式
     * http://www.hdhsmart.com/upload/example/owner.xlsx
     */
    public function owner_uptown_excel_to_data($file,$village_id,$project_id){
        $arr = import_excel_sheet($file,'X');
        $tmp = array();
        unset($arr[0]);
        //dump($arr);
        $project=M('house_village_project')->where('pigcms_id='.$project_id)->find();
        foreach($arr as $key=> $row){
            //归类表格数据
            $room=array(
              'room_name'=>$row['0'],
                'desc'=>$project['desc'],
                'roomsize'=>$row['1'],
                'village_id'=>$village_id,
                'project_id'=>$project_id
            );
            $property_time=explode('-',$row['17']);
            $property_start=trim(str_replace('.','-',$property_time['0']));
            $property_end=trim(str_replace('.','-',$property_time['1']));
            if(empty($property_end))$property_end=$property_start;
            if($row['16']==0)$row['22']='1';
            if($row['16']!=0&&empty($row['22']))$row['22']='0';
            if($row['16']!=0&&!empty($row['22']))$row['22']=strtotime(trim(str_replace('.','-',$row['22'])));
            $room_uptown=array(
                'addtime'=>strtotime(trim(str_replace('.','-',$row['5']))),
                'house_program'=>$row['6'],
                'house_return'=>$row['7'],
                'fixhouse_start'=>strtotime(trim(str_replace('.','-',$row['8']))),
                'fixhouse_end'=>strtotime(trim(str_replace('.','-',$row['9']))),
                'house_error'=>$row['10'],
                'house_abarbeitung'=>$row['11'],
                'checktime'=>strtotime(trim(str_replace('.','-',$row['12']))),
                'checktime_second'=>strtotime(trim(str_replace('.','-',$row['13']))),
                'updatetime'=>time(),
                'cash_type'=>$row['14'],
                'cash_price'=>$row['15'],
                'house_type'=>$row['16'],
                'property_endtime'=>$property_end,
                'property_defaulttime'=>$property_start,
                'property_emptytime'=>$row['22']
            );
            $user=array(
                'village_id'=>$this->village_id,
                'name'=>explode(' ',$row['2']),
                'usernum'=>explode(' ',$row['3']),
                'phone'=>explode(' ',$row['4']),
            );
            $carpspace_time=explode('-',$row['20']);
            $carspace_start=trim(str_replace('.','-',$carpspace_time['0']));
            $carspace_end=trim(str_replace('.','-',$carpspace_time['1']));
            if(empty($carspace_end))$carspace_end=$carspace_start;
            $user_car=array(
              'carspace_number'=>explode(' ',trim($row['18'])),
                'car_number'=>explode(' ',trim($row['19'])),
                'carspace_start'=>$carspace_start,
                'carspace_end'=>$carspace_end,
                'project_id'=>$project_id,
                'carspace_endtime'=>$carspace_end,
                'carspace_defaulttime'=>$carspace_end,
                'carspace_price'=>$row['21']?$row['21']:$project['carspace_price'],
            );
            /*dump($row);
            dump($user_car);
            die;*/
            if(empty($room['room_name']))continue;
            //添加或修改用户
            $userinfoid=array();
            unset($owner_id);
            foreach ($user['name'] as $k=>$v){
                if(empty($v))continue;
                if(empty($user['usernum'][$k])) $user['user_num'][$k]=$user['user_num']['0'];
                if(empty($user['phone'][$k])) $user['phone'][$k]=$user['phone']['0'];
                $userinfo=M('house_village_user_bind')->where(array('name'=>$v,'phone'=>$user['phone'][$k], 'village_id'=>$room['village_id']))->find();
                if(empty($userinfo)){
                    $userinfoid[]=M('house_village_user_bind')->data(array( 'village_id'=>$room['village_id'],
                        'name'=>$v,
                        'usernum'=>$user['usernum'][$k],
                        'phone'=>$user['phone'][$k],
                        'is_uptown'=>1))->add();
                }else{
                    M('house_village_user_bind')->where('pigcms_id='.$userinfo['pigcms_id'])->data(array('usernum'=>$user['usernum'][$k]))->save();
                    $userinfoid[]=$userinfo['pigcms_id'];
                }
                if($k==0){
                    $owner_id=$userinfoid['0'];
                }
            }
            //dump($userinfoid);
            //逗号连接user_bind中的id
            $userinfoid=implode(',',$userinfoid);
            //检查楼层是否存在  不存在则创建
            $room_name_explode=$this->get_house_number($room['room_name'],$village_id,$project_id);
            foreach ($room_name_explode as $key2=>$value2){
                $room[$key2]=$value2;
            }

            $room['room_type']=$this->get_room_type($row['23'],$village_id)?:'';//物业费单价设置查找
            $fname='';
            if(empty($room['tung_unit'])&&empty($room['tung_floor'])){
                if(strpos($room['tung_build'],'商')===0){
                    $fname=$room['tung_build'].'-';
                }else{
                    $fname=$room['tung_build'].'区域';
                }
            }else{
                if(!empty($room['tung_build'])) $fname .=$room['tung_build'].'栋';
                if(!empty($room['tung_unit'])) $fname .=$room['tung_unit'].'单元';
                if(!empty($room['tung_floor'])) $fname .=$room['tung_floor'].'层';
            }
            //dump(array('room_name'=>$fname,'project_id'=>$room['project_id'],'village_id'=>$room['village_id'],'fid'=>'0'));
            $finfo=M('house_village_room')->where(array('room_name'=>$fname,'project_id'=>$room['project_id'],'village_id'=>$room['village_id'],'fid'=>'0'))->find();
            //dump($finfo);die;
            if(empty($finfo)){
                $finfo_add=array('fid'=>0,'room_name'=>$fname,'desc'=>$room['desc'],'status'=>0,'village_id'=>$room['village_id'],'project_id'=>$project_id,'tung_build'=>$room['tung_build'],'tung_unit'=>$room['tung_unit'],'tung_floor'=>$room['tung_floor']);
                //dump($finfo_add);die;
                $fid=M('house_village_room')->data($finfo_add)->add();
            }else{
                $fid=$finfo['id'];
            }
            //添加或编辑房间信息
            //dump(array('room_name'=>$room['room_name'],'project_id'=>$room['project_id'],'village_id'=>$room['village_id'],'fid'=>array('neq',0)));
            $roominfo=M('house_village_room')->where(array('room_name'=>$room['room_name'],'project_id'=>$room['project_id'],'village_id'=>$room['village_id'],'fid'=>array('neq',0)))->find();
            $room['fid']=$fid;
            $room['oid']=$userinfoid;
            $room['owner_id']=$owner_id;
            //dump($room);die;
            if(empty($roominfo)){
                $roomid=M('house_village_room')->data($room)->add();
                /*dump($room);
                dump(M()->_sql());
                die;*/
            }else{
                M('house_village_room')->where(array('room_name'=>$room['room_name'],'desc'=>$room['desc'],'village_id'=>$room['village_id']))->data($room)->save();
                $roomid=$roominfo['id'];
            }
            $room_uptowninfo=M('house_village_room_uptown')->where('rid='.$roomid)->find();
            $room_uptown['rid']=$roomid;
            if(empty($room_uptown['house_type'])&&empty($userinfoid)){
                $room_uptown['house_type']=0;
            }elseif(empty($room_uptown['house_type'])&&!empty($userinfoid)){
                $room_uptown['house_type']=2;
            }
            if(empty($room_uptowninfo)){
                M('house_village_room_uptown')->data($room_uptown)->add();
            }else{
                /*if(!empty($room_uptown['property_endtime'])){
                    unset($room_uptown['property_endtime']);
                }*/
                M('house_village_room_uptown')->where('rid='.$roomid)->data($room_uptown)->save();
            }
            //添加或修改车位
            foreach ($user_car['carspace_number'] as $key1=>$value1){
                $user_carinfo=M('house_village_user_car')->where(array('carspace_number'=>$value1, 'village_id'=>$room['village_id']))->find();
                $carinfo=array('ubid'=>$userinfoid,
                    'carspace_number'=>$value1,
                    'car_number'=>$user_car['car_number'][$key1],
                    'carspace_start'=>$user_car['carspace_start'],
                    'carspace_end'=>$user_car['carspace_end'],
                    'project_id'=>$user_car['project_id'],//泊位费待更改
                    'village_id'=>$room['village_id'],
                    'rid'=>$roomid,
                    'carspace_endtime'=>$user_car['carspace_endtime'],
                    'carspace_defaultime'=>$user_car['carspace_defaultime'],
                    'carspace_price'=>$user_car['carspace_price'],
                    );
                //if(empty($carinfo['carspace_price']))$carinfo['carspace_price']='95';
                //dump($user_carinfo);
                if(empty($user_carinfo)){
                    M('house_village_user_car')->data($carinfo)->add();
                }else{
                    if(!empty($user_carinfo['carspace_endtime'])){
                        unset($carinfo['carspace_endtime']);
                    }
                    M('house_village_user_car')->where(array('carspace_number'=>$value1, 'village_id'=>$room['village_id']))->data($carinfo)->save();
                }
            }
        }


        //return $data;
    }
    /**
     * 表格数据导入1，钰龙湾业主数据导入 小区
     * 文件参考格式
     * http://www.hdhsmart.com/upload/example/owner.xlsx
     */
    public function owner_uptown_excel_to_update_data($file,$village_id,$project_id,$fee_lastyear_id,$year){
        //set_time_limit(0);
        $arr = import_excel_sheet($file,'AZ','1500','0','4');
        $tmp = array();
        unset($arr[0]);
        unset($arr[1]);
        unset($arr[2]);
        $project=M('house_village_project')->where('pigcms_id='.$project_id)->find();
        if($fee_lastyear_id=='property'){
            $key_list=array(
                'fee_recive'=>12,
                'step'=>4,
            );
        }elseif($fee_lastyear_id=='carspace'){
            $key_list=array(
                'fee_recive'=>10,
                'step'=>2
            );
        }else{
            $key_list=array(
                'fee_recive'=>8,
                'step'=>2
            );
        }
        $fee_recive=$key_list['fee_recive'];

        foreach($arr as $key=> $row){
            $key_list['fee_recive']=$fee_recive;
            /*dump($row);
            die;*/
            $error=array('error1'=>'','error2'=>'','error3'=>'');
            $key1=$key++;
            if(empty($row[1])){$error['error1'] .=$key1.',';dump($key1);continue;}
            $rid=M('house_village_room')->where(array('project_id'=>$project_id,'room_name'=>$row['1']))->find()['id'];
            if(empty($rid)) {$error['error2'] .=$row[1].',';dump($row[1]);dump(M()->_sql());continue;}
            if($fee_lastyear_id=='carspace'){
                $carspace_info=M('house_village_user_car')->where('rid='.$rid)->find();
                //if(empty($carspace_info))continue;
            }
            $property_model=new PropertyModel();
            for ($i=1;$i<=12;$i++,$key_list['fee_recive']+=$key_list['step']){
                if(!empty($row[$key_list['fee_recive']])){
                    switch ($fee_lastyear_id){
                        case 'property':$return=$this->add_propertylist_log($rid,2,'1',$year.'-'.$i.'-2',$row[$key_list['fee_recive']],$_SESSION['admin_id'],'1','数据初始化导入操作增加');
                                        break;
                        case 'carspace':$return=$this->add_carspacelist_log($rid,$carspace_info['pigcms_id'],2,'1',$year.'-'.$i.'-2',$row[$key_list['fee_recive']],$_SESSION['admin_id'],'1','数据初始化导入操作增加',$row['4']);
                                        break;
                        default:$return=$this->add_otherfee_log($rid,$project_id,$fee_lastyear_id,2,$year.'-'.$i.'-2',$row[$key_list['fee_recive']],'1','数据初始化导入操作增加');
                            break;
                    }
                }
                if($return==false){
                    $error['error3'] .=$row[1].'房间'.$i.'月,';
                    dump($row);
                }
            }

            switch ($fee_lastyear_id){
                case 'property':
                    $property_model->property_update_cache($rid,$year);
                    break;
                case 'carspace':
                    $property_model->carspace_update_cache($carspace_info['pigcms_id'],$year);
                    break;
                default:
                    $property_model->other_update_cache($rid,$fee_lastyear_id,$year);
                    break;
            }
            if($fee_lastyear_id=='property'||$fee_lastyear_id=='carspace'){
                $cache='';
                while (empty($cache)){
                    if(empty($row)){
                        break;
                    }else{
                        $cache=array_pop($row);
                    }
                }
                $property_time=explode('-',$cache);
                $property_start=trim(str_replace('.','-',$property_time['0']));
                $property_end=trim(str_replace('.','-',array_pop($property_time)));
                if(empty($property_end))$property_end=$property_start;
                if($fee_lastyear_id=='property'){
                    M('house_village_room_uptown')->where(array('rid'=>$rid))->data(array('property_endtime'=>$property_end))->save();
                }
                if(strstr($property_time['0'],'七折')){
                    M('house_village_room_uptown')->where(array('rid'=>$rid))->data(array('property_emptytime'=>$property_end))->save();
                }
                if($fee_lastyear_id=='carspace'){
                    if(empty($carspace_info)){
                        $carspace_info=M('house_village_user_car')->where('rid='.$rid)->find();
                    }
                    if(empty($carspace_info)){
                        continue;
                    }
                    $data=array(
                        'carspace_start'=>$property_start,
                        'carspace_end'=>$property_end,
                        'carspace_defaulttime'=>$property_end,
                        'carspace_endtime'=>$property_end
                    );
                    M('house_village_user_car')->where('rid='.$rid)->data($data)->save();
                }
            }

        }
        if($error){
            echo "以下行数没有房间名，无法导入:".$error['error1'].'</br>';
            echo "以下名称的房间没有找到对应的房间，无法导入:".$error['error2'].'</br>';
            echo "以下名称的房间水费记录插入失败:".$error['error3'].'</br>';
            die;
        }


        //return $data;
    }
    /**
     * @author zhukeqin
     * 杂项导入
     */
    public function import_other_price_uptown_todata($file,$village_id,$project_id){
        $ym = date("Y-m");//缴费记录的指定日期
        $arr = import_excel_sheet($file);
        $title=$arr[0];
        unset($arr[0]);
        $error_list='';
        //$project=M('house_village_project')->where('pigcms_id='.$project_id)->find();
        foreach($arr as $key=> $row){
            $other_total=0;
            $row['0']=trim($row['0']);
            $pay=$this->get_paylist_one($row['0'],$village_id,$project_id,$ym,'0');
            if($pay==false){
                $error_list .=$row['0'].',';
                continue;
            }
            $use_other=unserialize($pay['use_other']);
            foreach ($row as $key1=>$value1){
                if($key1==0){
                    continue;
                }
                if(empty($value1)){
                    continue;
                }
                switch ($key1){
                    case 1:$pay['use_water']=$value1;break;
                    case 2:$pay['use_electric']=$value1;break;
                    case 3:$pay['use_gas']=$value1;break;
                    default:$use_other[$title[$key1]]=$value1;;
                }
            }
            $pay['use_other']=serialize($use_other);
            //防止数据重复导入出现问题
            foreach ($use_other as $key2=>$value2){
                $other_total +=$value2;
            }
            $pay['total_price'] = $pay['total_price']-$pay['other_price']+$other_total;
            $pay['other_price'] = $other_total;
            if(empty($pay['pigcms_id'])){
                M('house_village_user_paylist')->data($pay)->add();
            }else{
                M('house_village_user_paylist')->where('pigcms_id='.$pay['pigcms_id'])->data($pay)->save();
            }
        }
        return $error_list;
    }

    /**
     * @author zhukeqin
     * 获取一条账单数据
     */
    public function get_paylist_one($room_name,$village_id='',$project_id='',$ym='',$is_enter_list){
        $ym =$ym?$ym:date("Y-m");
        if(empty($room_name)){
            return false;
        }
        $field=array(
            'r.*',
            'ru.*',
            't.property_unit',
            'p.desc'=>'project_desc',
            'p.carspace_price'
        );
        $where['r.room_name']=$room_name;
        if(!empty($village_id)) $where['r.village_id']=$village_id;
        if(!empty($project_id)) $where['r.project_id']=$project_id;
        $list=M('house_village_room')->alias('r')
            ->field($field)
            ->join('left join __HOUSE_VILLAGE_ROOM_UPTOWN__ ru on r.id=ru.rid')
            ->join('left join __HOUSE_VILLAGE_ROOM_TYPE__ t on r.room_type=t.pigcms_id')
            ->join('left join __HOUSE_VILLAGE_PROJECT__ p on r.project_id=p.pigcms_id')
            ->where($where)
            ->order('r.id desc')
            ->find();
        if(empty($list)){
            return false;
        }
        $car_list=M('house_village_user_car')->where('rid='.$list['id'])->select();
        $car_num=count($car_list);
        $where_pay=array('rid'=>$list['id'],'create_date'=>$ym);
        if(!empty($is_enter_list))$where_pay['is_enter_list']=$is_enter_list;
        $pay=M('house_village_user_paylist')->where($where_pay)->find();
        if(empty($pay)){
            $pay=array(
                'use_water'=>number_format(0,'2'),
                'use_electric'=>number_format(0,'2'),
                'use_gas'=>number_format(0,'2'),
                'use_park'=>number_format($list['carspace_price']*$car_num,'2'),
                'use_property'=>$list['roomsize']*$list['property_unit'],
                'water_price'=>number_format(0,'2'),
                'electric_price'=>number_format(0,'2'),
                'gas_price'=>number_format(0,'2'),
                'park_price'=>number_format($list['carspace_price']*$car_num,'2'),
                'property_price'=>$list['roomsize']*$list['property_unit'],
                'add_time'=>time(),
                'create_date'=>$ym,
                'rid'=>$list['id'],
                'village_id'=>$village_id
            );
            $pay['total_price']=$pay['water_price']+$pay['electric_price']+$pay['gas_price']+$pay['park_price']+$pay['property_price'];
        }
        return $pay;
    }
    /**
     * @author zhukeqin
     * 发送缴费提醒模板消息
     */
    public function send_msg($ubid,$village_id,$ym,$rid){
        $ub_info=M('house_village_user_bind')->where('pigcms_id='.$ubid)->find();
        $openid=M('user')->where('uid='.$ub_info['uid'])->find()['openid'];
        $room_info=M('house_village_room')->where('id='.$rid)->find();
        $payinfo=$this->get_paylist_one($room_info['room_name'],$room_info['village_id'],$room_info['project_id'],$ym);
        $village_name=M('house_village')->where('village_id='.$village_id)->find()['village_name'];
        $href = C('config.site_url').'/wap.php?g=Wap&c=House&a=village_my_pay&village_id='.$village_id;

            $data=array(
                'first'=>array(
                    'value'=>$village_name.$ym.'物业费缴费提醒',
                    'color'=>"#029700",
                ),
                'keyword1'=>array(
                    'value'=>$village_name.$room_info['room_name'],
                    'color'=>"#000000",
                ),
                'keyword2'=>array(
                    'value'=>$ub_info['name'],//人
                    'color'=>"#000000",
                ),
                'keyword3'=>array(
                    'value'=>'综合',
                    'color'=>"#000000",
                ),
                'keyword4'=>array(
                    'value'=>'未缴费',
                    'color'=>"#000000",
                ),
                'keyword5'=>array(
                    'value'=>$payinfo['total_price'],
                    'color'=>"#000000",
                ),
                'remark'=>array(
                    'value'=>'烦请您拨冗交纳为盼，如您需要，也可以预约我们上门收取。感谢您的支持和配合，祝您生活愉快！物业服务中心',
                    'color'=>"#000000",
                ),
            );
        $tempid=get_wxmsg_tpl('22');
        /*dump($rid);
        dump($room_info);
        dump($payinfo);*/
        $model=new WechatModel();
        //die;
        $model->send_tpl_message($openid,$tempid,$href,$data);
    }
    /**
     * 向数据表中插入数据
     * @param 导入的数据
     * @village_id 选择的社区
     */
    //插入数据的village_id
    protected $database_village_id = 0;
    protected $import_error = array();
    protected function set_import_error($err,$msg,$data){
        $this->import_error =  array(
            'err'=>$err,
            'msg'=>$msg,
            'data'=>$data,
        );
        return $this->import_error;
    }
    public function get_import_error(){
        return $this->import_error;
    }

    //导入
    public function insert_owner_data_to_database($data,$village_id){
        $this->database_village_id = $village_id;
        $this->startTrans();
        $flag = 1;
        foreach($data as $row){
            $oid = $this->insert_to_ownerbase($row);
            $row['oid'] = $oid;
            $flag *= $oid;


            $tid = $this->insert_to_tenantbase($row);
            $row['tid'] = $tid;
            $flag *= $tid;


            $room_id = $this->insert_to_roombase($row);
            $flag *= $room_id;


            if(!$flag) {
                $this->rollback();
                break;
            };
        }

        if($flag){
            $this->commit();
            return true;
        }else{
            return false;
        }

    }

    /**
     * 向业主表添加数据
     * pigcms_house_village_owner
     */
    public function insert_to_ownerbase($info){
        $data = array(
            'uid'=>'',
            'tid'=>$info['tid']?:0,
            'ownername'=>$info['ownername'],
            'fstatus'=>6,
            'contract_start'=>'',
            'contract_end'=>'',
            'property_unit'=>$info['property_unit'],
            'is_property'=>1,
            'property_start'=>'',
            'name'=>$info['ownername'],
            'phone'=>'',
            'village_id'=>$this->database_village_id,
        );
        $oid = M('house_village_owner')->add($data);
        if(!$oid){
            $this->set_import_error(1,"导入业主时发生错误",mysql_error());
        }


        return $oid;
    }


    /**
     * 向入住单位表添加数据
     * pigcms_house_village_user_bind
     */
    public function insert_to_tenantbase($info){
        $data = array(
            'village_id'=>$this->database_village_id,
            'uid'=>'',
            'usernum'=>$this->create_usernum($this->database_village_id),
            'entr_card'=>'',
            'name'=>$info['ownername'],
            'phone'=>'',
            'park_price'=>'',
            'park_flag'=>'',
            'address'=>'',
            'role'=>'',
            'company'=>'',
            'department'=>'',
            'workcard_img'=>'',
            'ac_status'=>'',
            'ac_desc'=>'',
            'is_sadmin'=>'',
            'add_time'=>time(),
            'last_time'=>'',
            'open_num'=>'',
            'id_card'=>'',
            'check_name'=>'',
            'company_id'=>'',
            'card_type'=>'',
            'group_id'=>'',
            'is_pay_user'=>'',
            'tenantname'=>$info['ownername'],//居民业主和入住单位是同一个人
            'type'=>1,

        );

        $tid = M('house_village_user_bind')->add($data);

        if(!$tid){
            $this->set_import_error(2,"导入业主时发生错误",mysql_error());
        }

        return $tid;
    }

    /**
     * 向房间表添加数据
     * pigcms_house_village_room
     */
    public function insert_to_roombase($info){
        $room_hash = $this->create_room_hash(
            $this->database_village_id,
            $info['tung_unit'],
            $info['floor_name'],
            $info['room_name']
        );

        $floor_hash = $this->create_room_hash(
            $this->database_village_id,
            $info['tung_unit'],
            $info['floor_name'],
            ""
        );

        //阻止重复导入
        $model = M('house_village_room');
        $re = $model->where("room_hash='%s'",$room_hash)->count();
        if($re){
            $this->set_import_error("4","该房间已经导入过了",mysql_error());
            return false;
        }

        //判断是否需要导入楼层
        $floor = $model->where('room_hash="%s"',$floor_hash)->find();
        if(!$floor){//add_floor
            $floor = array(
                'fid'=>0,
                'room_name'=>$info['floor_name'],
                'desc'=>$this->get_village_list()[$this->database_village_id]
                    .'-'
                    . $info['tung_unit']
                    .'-'
                    . $info['floor_name'],
                'status'=>1,
                'village_id'=>$this->database_village_id,
                'oid'=>0,
                'room_hash'=>$floor_hash,
                'meter_hash'=>'',
                'scale'=>'',
                'tid'=>0,
                'roomsize'=>'',
                'property_unit'=>'',
                'tung_unit'=>$info['tung_unit'],
            );
            $floor_id = $model->add($floor);

            if(!$floor_id){
                $this->set_import_error(3,"导入楼层时发生错误",mysql_error());
            }

            $floor['id'] = $floor_id;
        }

        //add_room
        $data = array(
            'fid'=>$floor['id'],
            'room_name'=>$info['room_name'],
            'desc'=>$this->get_village_list()[$this->database_village_id]
                .'-'
                . $info['tung_unit']
                .'-'
                . $info['floor_name']
                .'-'
                .  $info['room_name'],
            'status'=>1,
            'village_id'=>$this->database_village_id,
            'oid'=>$info['oid'],
            'room_hash'=>$room_hash,
            'meter_hash'=>'',
            'scale'=>'',
            'tid'=>$info['tid'],
            'roomsize'=>$info['roomsize'],
            'property_unit'=>$info['property_unit'],
            'tung_unit'=>$info['tung_unit'],
        );

        $room_id = M('house_village_room')->add($data);

        if(!$room_id){
            $this->set_import_error(2,"导入房间时发生错误",mysql_error());
        }
        return $room_id;
    }

    /**
     * 创建room 唯一识别码
     * @param $village_id
     * @param $tung_unit
     * @param $floor_name
     * @param $room_name
     */
    public function create_room_hash($village_id,$tung_unit,$floor_name,$room_name){
        return MD5(
            $village_id
            .'&&'.$tung_unit
            .'&&'.intval($floor_name)
            .'&&'.intval($room_name)
        );
    }





    /**
     * 手动将指定月份的【默认上月】的抄表记录中的止码，更新到设备表中
     * 注意：SPLIT_STR 为自定义的函数
     */
    public function update_consume($ym=""){
        $ym = $ym ?: date("Y-m",strtotime("-1 month"));
        $view = $this->view_consume($ym);
        $sql = <<<sql
            UPDATE pigcms_house_village_meters m,
             $view record
            SET m.be_date = CONCAT(
                SPLIT_STR (m.be_date, ',', '2'),
                ',',
                FROM_UNIXTIME(
                    record.create_time,
                    '%Y-%m-%d'
                )
            ),
             m.be_cousume = CONCAT(
                record.last_total_consume,
                ',',
                record.total_consume
            )
            WHERE
                m.meter_hash = record.meter_hash;
sql;
        return $this->query($sql);

    }

    /**
     * 添加台账日志  放到定时任务中了
     * @param int $tid
     * @param int $village_id
     * @param $ym
     * @return mixed
     */
    public function set_account_list_log($ym){
        $data = $this->preview_list(0,0,$ym);
        $save_data = array(
            'data'=>serialize($data),
            'create_time'=>time(),
            'ym'=>$ym
        );
        return M('house_village_account_log')->add($save_data);
    }

    /**
     * 获取台账日志
     * @param int $tid
     * @param int $village_id
     * @param $ym
     * @return mixed
     */
    public function get_account_list_log($tid=0,$village_id=0,$ym){
        $map = array();
        $map['ym'] = array('eq',$ym);
        $data =  M('house_village_account_log')
            ->where($map)
            ->order('create_time desc')
            ->getField('data');
        if(!$data) return false;
        $data =  unserialize($data);


        $data = array_filter($data,function($v)use($tid,$village_id){
            $re1 = !$tid  ?: $v['tid'] == $tid;
            $re2 = !$village_id ?: $v['village_id'] == $village_id;
            return $re1 && $re2;
        });
        return $data;
    }


    /**
     * 格式化 主要为了自定义属性设备列表  台账
     */
    public function format_custom_meter($info)
    {
        //必要字段中文描述
        $map = array(
            'meter_code'=>"设备编号",
            'meter_floor'=>"楼层描述",
            'floor_name' => "单元号",
            'rate'=>"倍率",
            'last_total_consume'=>"上月止码",
            'total_consume'=>"本月止码",
            'meter_type_id'=>"设备ID",
            'cate_id'=>"用途类别",
            'unit_price'=>"单价",
            'price_type_name'=>"计费类型",
            'consume'=>"用量",
            'price'=>"费用",
        );


        $tmp = array();
        foreach($info as $key => $val){
            if($key==="custom_info") continue;
            if($map[$key]){
                $tmp[] = array(
                    'cate_id'=>-1,
                    'config_custom_id'=>-1,
                    'key'=>$key,
                    'val'=>$val,
                    'desc'=>$map[$key],
                );
            }

        }
        $arr = $info['custom_info'];
        foreach($arr as $row){
            $tmp[] = array(
                'cate_id'=>$row['cate_id'],
                'config_custom_id'=>$row['config_custom_id'],
                'key'=>$row['key'],
                'desc'=>$row['desc'],
                'val'=>$row['val'],
                'meter_type_id'=>$row['meter_type_id'],
                'input_type'=>$row['input_type']
            );

        }

        return $tmp;
    }
    /**
     * @author zhukeqin
     * 获取门牌号中的相关信息
     */
    public function get_house_number($room_name,$village_id,$project_id){
        $explode=explode('-',$room_name);
        if($village_id==2&&$project_id==1){
            $return['tung_build']=$explode['0'];
            $return['tung_unit']=0;
            $return['tung_floor']=0;
            $return['tung_number']=0;
            if(strpos($return['tung_build'],'商')===0){
                $return['tung_number']=$explode['1'];
                $return['tung_floor']=0;
                $return['room_type']=2;
            }elseif(!empty($explode['1'])){
                if(strlen($explode['1'])==3){
                    $return['tung_floor']=substr($explode['1'],'0','1');
                    $return['tung_number']=substr($explode['1'],'1','2');
                }else{
                    $return['tung_floor']=substr($explode['1'],'0','2');
                    $return['tung_number']=substr($explode['1'],'2','2');
                }
                $return['room_type']=1;
            }else{
                $return['tung_number']=$explode['0'];
                $return['tung_floor']=0;
                $return['room_type']=2;
            }
        }elseif($village_id==2&&$project_id==2){
            $return['tung_build']=$explode['0'];
            $return['tung_unit']=$explode['1'];
            $return['tung_floor']=0;
            $return['tung_number']=0;
            if(strpos($return['tung_build'],'商')===0){
                $return['tung_number']=$explode['1'];
                $return['tung_floor']=0;
                $return['room_type']=2;
            }elseif(!empty($explode['1'])){
                if (strlen($explode['2']) == 3) {
                    $return['tung_floor'] = substr($explode['2'], '0', '1');
                    $return['tung_number'] = substr($explode['2'], '1', '2');
                } else {
                    $return['tung_floor'] = substr($explode['2'], '0', '2');
                    $return['tung_number'] = substr($explode['2'], '2', '2');
                }
                $return['room_type']=1;
            }else{
                $return['tung_number']=$explode['0'];
                $return['tung_floor']=0;
                $return['room_type']=2;
            }
        }else{
            $return['tung_build']=$explode['0'];
            $return['tung_unit']=0;
            $return['tung_floor']=0;
            $return['tung_number']=0;
            if(strpos($return['tung_build'],'商')===0){
                $return['tung_number']=$explode['1'];
                $return['tung_floor']=0;
                $return['room_type']=2;
            }elseif(!empty($explode['1'])){
                if(strlen($explode['1'])==3){
                    $return['tung_floor']=substr($explode['1'],'0','1');
                    $return['tung_number']=substr($explode['1'],'1','2');
                }else{
                    $return['tung_floor']=substr($explode['1'],'0','2');
                    $return['tung_number']=substr($explode['1'],'2','2');
                }
                $return['room_type']=1;
            }else{
                $return['tung_number']=$explode['0'];
                $return['tung_floor']=0;
                $return['room_type']=2;
            }
        }
        return $return;
    }

    public function get_room_type($property_unit,$village_id){
        if(empty($property_unit)) return false;
        $property_unit_info=M('house_village_room_type')->where(array('property_unit'=>$property_unit,'village_id'=>$village_id))->find();
        $return=$property_unit_info['pigcms_id'];
        if(empty($return)){
            $return=M('house_village_room_type')->data(array('property_unit'=>$property_unit,'village_id'=>$village_id))->add();
        }
        return $return;
    }
    /**
     * @author zhukeqin
     * 获取指定社区的费用是否需要计算
     * $village_id 小区id
     * $type 费用种类 可以携带use_或者_price
     * @return bool
     */
    public function get_livetype($village_id,$type){
        if(empty($village_id)||empty($type)){
            return false;
        }
        //去除type参数中包含的东西
        $type=str_replace('use_','',$type);
        $type=str_replace('_price','',$type);
        $livetype=M('house_village_livetype')->find();
        if($livetype[$type]==1){
            return true;
        }else{
            return false;
        }

    }

    /**
     * @author zhukeqin
     * @param $rid 房间id
     * @param $type 0 线上缴费 1 线下缴费
     * @param $mouth 月数
     * @param string $pay_true 实际缴费数额  一般只有后台操作才需要
     * @param $uid 为adminid或userid
     * @param $status 订单状态  后台操作有需要才赋值为1  即已成功支付
     * @param $remark  备注  一般后台才用到
     * @return order_id
     */
    public function add_propertylist($rid,$type,$month,$pay_true='',$uid,$status="0",$remark="",$pay_recive=''){
        if(empty($month)||$month<1){
            return false;
        }
        $room_info=M('house_village_room')->where('id='.$rid)->find();
        $room_uptown=M('house_village_room_uptown')->where('rid='.$rid)->find();
        if($room_uptown&&empty($room_uptown['defaultday'])){
            $defaultday=explode('-',$room_uptown['property_endtime'])['2'];
            M('house_village_room_uptown')->where('rid='.$rid)->data(array('defaultday'=>$defaultday))->save();
        }else{
            $defaultday=$room_uptown['defaultday'];
        }
        $property_price=M('house_village_room_type')->where('pigcms_id='.$room_info['room_type'])->find();
        if(empty($pay_recive)){
            $pay_recive=round($room_info['roomsize']*$property_price['property_unit']*$month,2);
        }
        $dateModel=new DateModel();
        $data=array(
            'rid'=>$rid,
            'roomsize'=>$room_info['roomsize'],
            'property_unit'=>$property_price['property_unit'],
            'mouth'=>$month,
            'last_endtime'=>$room_uptown['property_endtime'],
/*            'new_endtime'=>date('Y-n-j', strtotime ("+".$month." month", strtotime($room_uptown['property_endtime']))),*/
            'new_endtime'=>$dateModel->change_date($room_uptown['property_endtime'],$month,'month','','add',false,'Y-n-j',$defaultday),
            'pay_receive'=>$pay_recive,
            'type'=>$type,
            'status'=>$status,
            'create_time'=>time(),
            'remark'=>$remark
        );//sprintf("%.2f",$room_info['roomsize']*$property_price['property_unit']*$month)
        if(empty($pay_true)){
           $data['pay_true']=$data['pay_receive'];
        }else{
            $data['pay_true']=$pay_true;
        }
        if($type=='1'){
            $data['uid']=$uid;
        }else{
            $data['admin_id']=$uid;
        }
        $orderid=M('house_village_room_propertylist')->data($data)->add();
        if($orderid){
            if($status==1){
                M('house_village_room_propertylist')->data(array('pay_time'=>time()))->where('pigcms_id='.$orderid)->save();
                M('house_village_room_uptown')->data(array('property_endtime'=>$data['new_endtime']))->where('rid='.$rid)->save();
            }
            return $orderid;
        }else{
            return false;
        }
    }
    /**
     * 泊位费缴费
     * @author zhukeqin
     * @param $rid 房间id
     * @param $carspace_id 车位ID
     * @param $type 0 线上缴费 1 线下缴费
     * @param $mouth 月数
     * @param string $pay_true 实际缴费数额  一般只有后台操作才需要
     * @param $uid 为adminid或userid
     * @param $status 订单状态  后台操作有需要才赋值为1  即已成功支付
     * @param $remark  备注  一般后台才用到
     * @return order_id
     */
    public function add_carspacelist($rid,$carspace_id,$type,$month,$pay_true='',$uid,$status="0",$remark=""){
        if(empty($month)||$month<1){
            return false;
        }
        $room_info=M('house_village_room')->where('id='.$rid)->find();
        $carspace_info=M('house_village_user_car')->where('pigcms_id='.$carspace_id)->find();
        if($carspace_info&&empty($carspace_info['defaultday'])){
            $defaultday=explode('-',$carspace_info['carspace_endtime'])['2'];
            M('house_village_user_car')->where('pigcms_id='.$carspace_id)->data(array('defaultday'=>$defaultday))->save();
        }else{
            $defaultday=$carspace_info['defaultday'];
        }
        $project_info=M('house_village_project')->where('pigcms_id='.$room_info['project_id'])->find();
        $dateModel=new DateModel();
        $data=array(
            'rid'=>$rid,
            'carspace_id'=>$carspace_id,
            'carspace_unit'=>$carspace_info['carspace_price'],
            'mouth'=>$month,
            'last_endtime'=>$carspace_info['carspace_endtime'],
/*            'new_endtime'=>date('Y-n-j', strtotime ("+".$month." month", strtotime($carspace_info['carspace_endtime']))),*/
            'new_endtime'=>$dateModel->change_date($carspace_info['carspace_endtime'],$month,'month','','add',false,'Y-n-j',$defaultday),
            'pay_receive'=>round($carspace_info['carspace_price']*$month,2),
            'type'=>$type,
            'status'=>$status,
            'create_time'=>time(),
            'remark'=>$remark
        );//sprintf("%.2f",$room_info['roomsize']*$property_price['property_unit']*$month)
        if(empty($pay_true)){
            $data['pay_true']=$data['pay_receive'];
        }else{
            $data['pay_true']=$pay_true;
        }
        if($type=='1'){
            $data['uid']=$uid;
        }else{
            $data['admin_id']=$uid;
        }
        $orderid=M('house_village_room_carspacelist')->data($data)->add();
        if($orderid){
            if($status==1){
                M('house_village_room_carspacelist')->data(array('pay_time'=>time()))->where('pigcms_id='.$orderid)->save();
                M('house_village_user_car')->data(array('carspace_endtime'=>$data['new_endtime'],'carspace_end'=>$data['new_endtime']))->where('pigcms_id='.$carspace_id)->save();
            }
            return $orderid;
        }else{
            return false;
        }
    }

    /**
     * 增加一条新的物业缴费记录  仅限初始化时使用  不建议其他场合使用
     * @author zhukeqin
     * @param $rid 房间id
     * @param $type 前台缴费还是后台
     * @param $month 月数
     * @param string $pay_true 实际付款金额
     * @param $uid 操作者或者用户id
     * @param string $status 缴费状态
     * @param string $remark 备注
     * @param string $pay_recive 应缴费金额
     * @return bool|mixed
     */
    public function add_propertylist_log($rid,$type,$month,$time,$pay_true='',$uid,$status="0",$remark="",$pay_recive=''){
        if(empty($month)||$month<1){
            return false;
        }
        if(strstr($pay_true,'-')){
            return false;
        }
        $room_info=M('house_village_room')->where('id='.$rid)->find();
        $room_uptown=M('house_village_room_uptown')->where('rid='.$rid)->find();
        $property_price=M('house_village_room_type')->where('pigcms_id='.$room_info['room_type'])->find();
        if(empty($pay_recive)){
            $pay_recive=round($room_info['roomsize']*$property_price['property_unit']*$month,2);
        }
        $data=array(
            'rid'=>$rid,
            'roomsize'=>$room_info['roomsize'],
            'property_unit'=>$property_price['property_unit'],
            'mouth'=>$month,
            'last_endtime'=>$room_uptown['property_endtime'],
            'new_endtime'=>$room_uptown['property_endtime'],
            'pay_receive'=>$pay_recive,
            'type'=>$type,
            'status'=>$status,
            'create_time'=>strtotime($time),
            'remark'=>$remark
        );//sprintf("%.2f",$room_info['roomsize']*$property_price['property_unit']*$month)
        if(empty($pay_true)){
            $data['pay_true']=$data['pay_receive'];
        }else{
            $data['pay_true']=$pay_true;
        }
        if($type=='1'){
            $data['uid']=$uid;
        }else{
            $data['admin_id']=$uid;
        }
        $orderid=M('house_village_room_propertylist')->data($data)->add();
        if($orderid){
            if($status==1){
                M('house_village_room_propertylist')->data(array('pay_time'=>strtotime($time)))->where('pigcms_id='.$orderid)->save();
            }
            return $orderid;
        }else{
            return false;
        }
    }
    /**
     * 增加一条新的泊位费缴费记录  仅限初始化时使用  不建议其他场合使用
     * @author zhukeqin
     * @param $rid 房间id
     * @param $carspace_id 车位ID
     * @param $type 0 线上缴费 1 线下缴费
     * @param $mouth 月数
     * @param string $pay_true 实际缴费数额  一般只有后台操作才需要
     * @param $uid 为adminid或userid
     * @param $status 订单状态  后台操作有需要才赋值为1  即已成功支付
     * @param $remark  备注  一般后台才用到
     * @return order_id
     */
    public function add_carspacelist_log($rid,$carspace_id,$type,$month,$time,$pay_true='',$uid,$status="0",$remark="",$carspace_price){
        if(empty($month)||$month<1){
            return false;
        }
        if(strstr($pay_true,'-')){
            return false;
        }
        $room_info=M('house_village_room')->where('id='.$rid)->find();
        $carspace_info=M('house_village_user_car')->where('pigcms_id='.$carspace_id)->find();
        if(empty($room_info)){
            return false;
        }
        if(empty($carspace_info)){
            $carspace_info=M('house_village_user_car')->where('rid='.$rid)->find();
            $carspace_id=$carspace_info['pigcms_id'];
        }
        if($room_info&&empty($carspace_info)){
            $carinfo=array('ubid'=>$room_info['owner_id'],
                'carspace_number'=>$room_info['room_name'].'车位',
                'car_number'=>$room_info['room_name'],
                'carspace_start'=>'',
                'carspace_end'=>'',
                'project_id'=>$room_info['project_id'],//泊位费待更改
                'village_id'=>$room_info['village_id'],
                'rid'=>$rid,
                'carspace_endtime'=>'',
                'carspace_defaultime'=>'',
                'carspace_price'=>$carspace_price,
            );
            $carspace_id=M('house_village_user_car')->data($carinfo)->add();
            $carspace_info=M('house_village_user_car')->where('pigcms='.$carspace_id)->find();
        }
        $project_info=M('house_village_project')->where('pigcms_id='.$room_info['project_id'])->find();
        $data=array(
            'rid'=>$rid,
            'carspace_id'=>$carspace_id,
            'carspace_unit'=>$carspace_info['carspace_price'],
            'mouth'=>$month,
            'last_endtime'=>$carspace_info['carspace_endtime'],
            'new_endtime'=>$carspace_info['carspace_endtime'],
            'pay_receive'=>round($carspace_info['carspace_price']*$month,2),
            'type'=>$type,
            'status'=>$status,
            'create_time'=>strtotime($time),
            'remark'=>$remark
        );//sprintf("%.2f",$room_info['roomsize']*$property_price['property_unit']*$month)
        if(empty($pay_true)){
            $data['pay_true']=$data['pay_receive'];
        }else{
            $data['pay_true']=$pay_true;
        }
        if($type=='1'){
            $data['uid']=$uid;
        }else{
            $data['admin_id']=$uid;
        }
        $orderid=M('house_village_room_carspacelist')->data($data)->add();
        if($orderid){
            if($status==1){
                M('house_village_room_carspacelist')->data(array('pay_time'=>strtotime($time)))->where('pigcms_id='.$orderid)->save();
            }
            return $orderid;
        }else{
            return false;
        }
    }
    public function add_otherfee_log($rid,$project_id,$type_id,$type,$time,$fee_receive='',$status="0",$remark=""){
        $check=M('house_village_otherfee_type')->where(array('village_id'=>$this->village_id,'status'=>1,'otherfee_type_id'=>$type_id))->find();
        if(!$check){
            echo json_encode(array('err'=>1,'msg'=>'缴费类型不存在'));
            die;
        }
        if(strstr($fee_receive,'-')){
            return false;
        }
        $data=array(
            'otherfee_type_id'=>$type_id,
            'rid'=>$rid,
            'village_id'=>$this->village_id,
            'project_id'=>$project_id,
            'fee_receive'=>$fee_receive,
            'fee_true'=>$fee_receive,
            'fee_mouth'=>date('Y-n',strtotime($time)),
            'fee_time'=>$time,
            'creattime'=>strtotime($time),
            'admin_id'=>$_SESSION['admin_id'],
            'type'=>$type,
            'remark'=>$remark,
            'status'=>'1',
            'updatetime'=>time(),
        );
        $orderid=M('house_village_otherfee')->data($data)->add();
        if($orderid){
            if($status==1){
                M('house_village_room_carspacelist')->data(array('pay_time'=>strtotime($time)))->where('pigcms_id='.$orderid)->save();
            }
            return $orderid;
        }else{
            return false;
        }
    }



}