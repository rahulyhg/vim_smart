<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/22
 * Time: 11:09
 * 抄表相关方法
 * @update-time: 2017-09-01 09:16:27
 * @author: 王亚雄
 */
class MeterModel extends Model
{
    protected $tableName = 'house_village_meters';
    //表类型
    const XLS_METER_TYPE_WATER = 1;//水表
    const XLS_METER_TYPE_ELECTRICITY = 2;//电表
    //计费类型
    const XLS_PRICE_TYPE_RESIDENT = 1; //居民
    const XLS_PRICE_TYPE_FINISH = 2; //装修

    /***设备相关***/
    //获取设备列表
    public function meter_list($village_id='',$village_type='0',$meter_code_list=''){
        $current_date =date("Y-m");//当前年月
        //指定年月的抄表数据sql，可视作视图
        $cousume_view =  <<<sql
(
	SELECT
		*, FROM_UNIXTIME(tmp.create_time, '%Y-%m') create_date
	FROM
		(SELECT * FROM pigcms_re_setmeter ORDER BY create_time DESC) AS tmp
    WHERE FROM_UNIXTIME(tmp.create_time, '%Y-%m') = '$current_date'
	GROUP BY
		tmp.meter_hash,create_date
)
sql;

        $field =array(
            'm.*',
            'GROUP_CONCAT(ub.tenantname ORDER BY tm.tid)'=>'tenantnames',//所有租户
            'GROUP_CONCAT(ub.pigcms_id ORDER BY tm.tid)'=>'tids',//所有租户
            'GROUP_CONCAT(tm.scale ORDER BY tm.tid)'=>'tsacles',//所有租户
            'c.total_consume-c.last_total_consume'=>'consume',//當月抄表用量
            'hv.village_name'
        );
        $map = array();
        $_GET['is_del'] = 0;
//        $map['m.id'] = array('gt',552);//test
//        $map['m.is_del'] = array('eq',0);//test
        if(isset($_GET['is_del'])){
            $is_del = $_GET['is_del'];
            $map['m.is_del'] = array('eq',$is_del);
        }
        if(!empty($village_id)){
            $map['m.village_id']=$village_id;
        }
        if(!empty($meter_code_list)){
            $map['m.meter_code']=array('IN',implode(',',$meter_code_list));
        }


       $list = $this->alias('m')
           ->field($field)
           ->join('left join __HOUSE_VILLAGE__ hv on m.village_id = hv.village_id')
           ->join('left join __HOUSE_VILLAGE_TM__ tm on m.meter_hash = tm.meter_hash')
           ->join('left join __HOUSE_VILLAGE_USER_BIND__ ub on ub.pigcms_id = tm.tid')
           ->join("left join $cousume_view c on c.meter_hash = m.meter_hash")
           //->cache('meter_list',3600)//由于有绑定操作 不用缓存
           ->group('m.meter_hash')
           ->order('m.id desc')
           ->where($map)
           ->select();
      // echo mysql_error(); exit();

       foreach($list as &$row){
           //设备描述
           $row['tids'] = $row['tids']?:array();
           if($row['tids']){
               $row['tids'] = explode(',',$row['tids'])?:array();
               $row['tenantnames'] = array_combine($row['tids'],explode(',',$row['tenantnames']));
               $row['tsacles'] = array_combine($row['tids'],explode(',',$row['tsacles']));
           }
           $row['meter_type_desc'] = $this->get_meter_type_list()[$row['meter_type_id']];
           if($village_type=='1'){
               $room_list=explode(',',$row['room_id']);
               $row['meter_floor']=M('house_village_room')->where('id='.$room_list['0'])->find()['room_name'];
           }
       }
       unset($row);
       return $list;
    }
    //逻辑删除
    public function logic_del_meter($meter_hash){
        return $this->where('meter_hash="%s"',$meter_hash)->setField('is_del',1);
    }


    //获取单个设备信息
    public function meter_info($meter_hash){
        $field =array(
            'm.*',
            'GROUP_CONCAT(ub.tenantname ORDER BY tm.tid)'=>'tenantnames',//所有租户
            'GROUP_CONCAT(ub.pigcms_id ORDER BY tm.tid)'=>'tids',//所有租户
            'GROUP_CONCAT(tm.scale ORDER BY tm.tid)'=>'tsacles',//所有租户
        );
        $meter_info = $this->alias('m')
            ->field($field)
            ->join('left join __HOUSE_VILLAGE_TM__ tm on m.meter_hash = tm.meter_hash')
            ->join('left join __HOUSE_VILLAGE_USER_BIND__ ub on ub.pigcms_id = tm.tid')
            //->cache('meter_list',3600)//由于有绑定操作 不用缓存
            ->group('m.meter_hash')
            ->where('m.meter_hash="%s"',$meter_hash)
            ->find();



            //设备描述
            $row['tids'] = $meter_info['tids']?:array();
            if($meter_info['tids']){
                $meter_info['tids'] = explode(',',$meter_info['tids'])?:array();
                $meter_info['tenantnames'] = array_combine($meter_info['tids'],explode(',',$meter_info['tenantnames']));
                $meter_info['tsacles'] = array_combine($meter_info['tids'],explode(',',$meter_info['tsacles']));
                $meter_info['newest_cousume'] = explode(',',$meter_info['be_cousume'])[1];
            }
            $meter_info['meter_type_desc'] = $this->get_meter_type_list()[$meter_info['meter_type_id']];
            $meter_info['price_type_desc'] = $this->get_price_type_list()[$meter_info['price_type_id']];
            $meter_info['unit'] = $this->get_unit($meter_info['meter_type_id']);
            return $meter_info;
    }


    //生成设备hash码
    public function create_meter_hash($str){
        return md5($str);
        //return createRandomStr(32);
    }

    //添加单个设备 若不传入data 则尝试取post里的数据
    public function add_meter($data=array()){
        $data           =   $data?:$_POST;
        $last_cousume   =   $data['last_cousume']?:0;
        $cousume        =   $data['cousume']?:0;
        $tid            =   $data['tid']?:0;
        $meter_code     =   $data['meter_code']?:"";
        $data = array(
            'tid'=>$tid,
            'meter_code'=>$meter_code,
            'create_time'=>time(),
            'be_cousume'=>$last_cousume . ',' . $cousume,
            'be_date'=>date("Y-m-d",0) . ',' . date("Y-m-d"),
            'meter_hash'=>$this->create_meter_hash($meter_code),
        );
        $num = $this->add($data);
        return $num;
    }

    //批量添加设备
    public function add_meters($data){
        foreach($data as $key=>&$row){
            $row['tid']         =   $row['tid']?:0;
            $row['create_time'] =   time();
            $row['be_cousume']  =   ($row['last_cousume']?:0 ) . ',' . ($row['cousume']?:0);
            $row['be_date']     =   '0000-00-00' . ',' . date("Y-m-d");
            $row['meter_hash']  =   $this->create_meter_hash($row['meter_code'] . '&&' . $row['meter_floor']);
        }
        unset($row);
        $num = $this->addAll($data,$options=array(),$replace=true);
        return $num;
    }


    //更新设备
    public function save_meter($data){
        if(!$data['meter_hash']) return false;

        $meter_info = $this->get_meter_info($data['meter_hash']);
        if(!$meter_info) return false;

        $save_data = array();
        if($data['cousume']){//如果在修改用量，组装新数据
            list($last_cousume,$current_cousume)    = explode(',',$meter_info['be_cousume']);
            list($last_date,$current_date)          = explode(',',$meter_info['be_date']);
            $new_cousume                            = $data['cousume'];
            $new_date                               = date("Y-m-d");
            $save_data = array(
                'be_cousume'=>$current_cousume . ',' . $new_cousume,
                'be_date'=>$current_date . ',' . $new_date,
            );
        }

        $save_data = array_merge($data,$save_data);
        //dump($save_data);exit();
        $re = $this->where('meter_hash="%s"',$data['meter_hash'])->save($save_data);
        return $re;
    }


    //获取租户所有设备 by tenant_id
    public function get_tenant_meter_data($tenant_id,$meter_type_id){
        $model = M('house_village_user_bind');
        $map = array();
        $tenant_id && $map['tm.tid'] = array('eq',$tenant_id);
        $meter_type_id && $map['m.meter_type_id'] = array('eq',$meter_type_id);
        $meter_data = $model->alias('ub')
            ->join('left join __HOUSE_VILLAGE_TM__ tm on ub.pigcms_id=tm.tid')
            ->join('left join __HOUSE_VILLAGE_METERS__ m on tm.meter_hash = m.meter_hash')
            ->where($map)
            ->select();

        if($meter_data){
            foreach($meter_data as &$row){
                $row['meter_type_desc'] = $this->get_meter_type_list()[$row['meter_type_id']];
                $row['last_cousume'] = explode(',',$row['be_cousume'])[1];
                $row['price_type_desc'] = $this->get_price_type_list()[$row['price_type_id']];
            }
        }
        return $meter_data;
    }


    //获取设备信息by meterhash
    public function get_meter_info($meter_hash){
        $meter_info = $this->alias('m')
            ->field(array(
                'ub.tenantname',
                'm.tid',
                'm.meter_type_id',
                'm.price_type_id',
                'm.meter_code',
                'm.be_cousume',
                'm.be_date',
                'm.meter_floor',
                'm.meter_hash',
                'm.rate',
                'm.room_id',
                'cfg.desc',
                'cfg.unit'
            ))
            ->join('left join __HOUSE_VILLAGE_USER_BIND__ ub on ub.pigcms_id = m.tid')
            ->join('left join __RE_SETMETER_CONFIG__ cfg on cfg.id=m.meter_type_id')
            ->where('meter_hash="%s"',$meter_hash)
            ->find();
        if($meter_info){
            $meter_info['meter_type_desc'] = $this->get_meter_type_list()[$meter_info['meter_type_id']];
            //当为当前月份时进行处理  是否重复抄表
            $be_date=explode(',',$meter_info['be_date']);
            if(date('Y-m',strtotime($be_date['1']))==date('Y-m')){
                $meter_info['last_cousume'] = explode(',',$meter_info['be_cousume'])[0];
                $meter_info['last_date'] = explode(',',$meter_info['be_date'])[0];
            }else{
                $meter_info['last_cousume'] = explode(',',$meter_info['be_cousume'])[1];
                $meter_info['last_date'] = explode(',',$meter_info['be_date'])[1];
            }

            $meter_info['price_type_desc'] = $this->get_price_type_list()[$meter_info['price_type_id']];
            $meter_info['unit'] = $this->get_unit($meter_info['price_type_id'])?:"单位";
        }

        return $meter_info;
    }


    /***计费接口****/
    //获取社区计费标准
    public function get_village_utilities($village_id){
        $utilities = re_setmeter_config($village_id);
        return $utilities;
    }

    /**
     * 获取指定类型的价格
     * @param $village_id
     * @param $type
     */
    public function get_price_info($village_id,$meter_type){
        $utilities = $this->get_village_utilities($village_id);
       foreach($utilities as $row){
          foreach($row['_child'] as $rr){
              if($rr['sign']==$meter_type){
                  return $rr;
              }
          }
       }

    }


    /**
     * 获取租户所有计费信息
     * @param $tenant_id
     */
    public function get_utilities_data($tenant_id){
        //获取社区的计费标准
        $village_id = $this->tid2vid($tenant_id);//获取village_id
        $model = M('house_village_company_utilities');
        $rates = $model->where('tid=%d')->select();
        foreach($rates as &$row){
            $row['price_info'] = $this->get_price_info($village_id,$row['meter_type']);
            //TODO::还需加入 楼层 业主 租户等信息
        }
        unset($row);
        return $rates;
    }

    /**
     * 获取指定设备类型的计费信息
     * @param $tenant_id
     * @param $meter_type
     */
    public function get_utilities_info($tenant_id,$meter_type){
        $data = $this->get_utilities_data($tenant_id);
        foreach($data as $row){
            if($row['meter_type']==$meter_type){
                return $row;
            }
        }
    }

    /**
     * tenant_id to village_id
     * @param $tenant_id
     * @return int
     */
    public function tid2vid($tenant_id){
        return 4;
    }


    /*********************************数据导入*******************************/
    /**
     *设备导入
     */
    public function meter_import(){
        $path = array_shift($_FILES)['tmp_name'];
        $PHPReader = new \PHPExcel_Reader_Excel5();
        $PHPExcel = $PHPReader->load($path);
        $data = $PHPExcel->getActiveSheet()->toArray(null, true, true, false);
        $columns = array(
            'meter_code',
            'meter_type_id',
            //'last_cousume',
            'cousume',
            'meter_floor',
            'rate',
            'price_type_id',
        );

        foreach ($data as &$d){
            $d = array_splice($d,0,6);
            $d = array_combine($columns,$d);
            $d = $this->set_array_default_val($d);
            $xls_meter_type_id = $d['meter_type_id'];
            $d['meter_type_id'] = $this->replace_meter_type_id($d['meter_type_id']);
            $d['price_type_id'] = $this->replace_price_type_id($d['price_type_id'],$xls_meter_type_id);

        }
        unset($d);
        array_shift($data);

        return $this->add_meters($data);
    }

    /**
     * 将xls表格中表类型替换成系统配置中的值
     * @param $xls_meter_type_id
     */
    protected function replace_meter_type_id($xls_meter_type_id ){
        $map = array(
          //xls                                 =>  re_setmeter_config
            self::XLS_METER_TYPE_WATER          =>  1, //水
            self::XLS_METER_TYPE_ELECTRICITY    =>  5, //电
            //0                                 =>  9, //燃气
        );
        return $map[$xls_meter_type_id];
    }



    /**
     * 将xls表格中计费类型替换成数据库配置中的值
     * @param $xls_price_type_id
     * @param int $xls_meter_type_id //默认水表
     */
    protected function replace_price_type_id($xls_price_type_id,$xls_meter_type_id=self::XLS_METER_TYPE_WATER){
        switch ($xls_meter_type_id){
            case self::XLS_METER_TYPE_WATER ://水表
                $map = array(
                    //xls                           =>  re_setmeter_config
                    self::XLS_PRICE_TYPE_RESIDENT   => 3,
                    self::XLS_PRICE_TYPE_FINISH     => 4,
                );
            break;

            case self::XLS_METER_TYPE_ELECTRICITY ://电表
                $map = array(
                    //xls                           =>  re_setmeter_config
                    self::XLS_PRICE_TYPE_RESIDENT   => 7,
                    self::XLS_PRICE_TYPE_FINISH     => 8,
                );
            break;
        }


        return $map[$xls_price_type_id];
    }



    /**
     * 租户导入
     */
    public function tenant_import($village_id){
        $xls_data = $this->tenant_xls_data($village_id);

        foreach($xls_data as $xls_info){
            $this->startTrans();

            //导入租户（公司）
            $xls_info['tid'] = $this->insert_user_bind($xls_info);//tid :tenant_id 租户（公司）ID

            if($xls_info['tid']===false){
                $this->rollback();
                return false;
            }

            //导入楼层
            $xls_info['fid'] = $this->insert_village_floor($xls_info);//fid:floor_id 楼层返回ID

            if($xls_info['fid']===false){
                $this->rollback();
                return false;
            }

            //导入计费
            $xls_info['tuid'] = $this->insert_tenant_utilities($xls_info);//tuid：tenant_utilities_id 计费标准ID

            if($xls_info['tuid']===false){
                $this->rollback();
                return false;
            }

            $this->commit();

        }

        // echo mysql_error();
        return true;

    }


    /**
     * 获取文件数据
     */
    public function tenant_xls_data($village_id){
        $path = array_shift($_FILES)['tmp_name'];
        $PHPReader = new \PHPExcel_Reader_Excel5();
        $PHPExcel = $PHPReader->load($path);
        $data = $PHPExcel->getActiveSheet()->toArray(null, true, true, false);
        $columns = array(
            'fstatus',
            'fdesc',
            'ownername',
            'tenantname',
            'housesize',
            'property_unit',
            'property_start',
            'contract_start',
            'contract_end',
            'name',
            'phone',
            'water_price',
            'electric_price',
            'is_property',
        );
        foreach ($data as &$d){
            $d = array_splice($d,0,14);
            $d = array_combine($columns,$d);
            $d['village_id'] = $village_id;
            $d = $this->set_array_default_val($d);
        }
        unset($d);
        array_shift($data);
        //dump($data);exit();
        return $data;
    }


    //向公司（租户）表插入数据 pigcms_house_village_user_bind
    protected function insert_user_bind($xls_info){
        if($xls_info['tenantname']=="") return 0;

        $model = M('house_village_user_bind');
        $info = $model->where('tenantname="%s"',$xls_info['tenantname'])->find();
        if($info){//查询数据是否已导入
            $model->where('tenantname="%s"' ,$xls_info['tenantname'])->save($xls_info);
            return $info['pigcms_id'];//pigcms_id
        }else{
            $xls_info['usernum'] = 'GFYH' . date("YmdHis") .mt_rand(100000,999999);//'GFYH' . date("YmdHis") .mt_rand(100000,999999);//租户（公司）编号
            return $model->add($xls_info);
        }
    }

    //向楼层表插入数据
    protected function insert_village_floor($xls_info){
        $model = M('house_village_floor');
        $info = $model->where('fdesc="%s"',$xls_info['fdesc'])->find();
        if($info){//查询数据是否已导入
            $model->where('fdesc="%s"',$xls_info['fdesc'])->save($xls_info);
            return $info['id'];
        }else{
            return $model->add($xls_info);
        }
    }

    //向收费表准表插入数据  pigcms_house_village_tenant_utilities
    protected function insert_tenant_utilities($xls_info){
//        $model = M('house_village_floor');
//        $info = $model->where('fdesc="%s"',$xls_info['fdesc'])->find();
//        if($info){//查询数据是否已导入
//            return $info['id'];
//        }else{
//            return $model->add($xls_info);
//        }
    }



    /**
     * 过滤掉表格中的空值
     * @param $arr
     * @return array
     */
    protected function set_array_default_val($arr){
        array_walk_recursive($arr,function(&$v){
            if(!$v||trim($v)=="/"){
                if(is_string($v)){
                    $v="";
                }else{
                    $v=0;
                }
            }
        });
        return $arr;
    }

    /**
     * @return bool|mixed
     */
    public function get_village(){
        if(session('system.account')==SUPER_ADMIN){
            //超级权限
            if(empty($_POST['village_id'])){
                //如果不存在village_id  报错
                return false;
            }else{
                $village_id = $_POST['village_id'];
            }
        }else{
            //非超级权限
            $village_id = $this->village_id;
        }

        return $village_id;
    }



    /**
     * 获取设备类型
     * @return array
     */
    public function get_meter_type_list($is_json=false){

        static $meter_type_list =array();
        if(!$meter_type_list){
            $tmp = M('re_setmeter_config')->where('pid=%d',0)->select();
            $meter_type_list = array();
            foreach($tmp as $row){
                $meter_type_list[$row['id']] = $row['desc'];
            }
        }
        if($is_json==true){
            $meter_type_list = json_encode($meter_type_list);
        }
        return $meter_type_list;

    }

    /**
     * 获取计费类型
     * @return array
     */
    public function get_price_type_list($is_json=false){
        static $meter_type_list =array();
        if(!$meter_type_list){
            $tmp = M('re_setmeter_config')->where('pid<>%d',0)->select();
            $meter_type_list = array();
            foreach($tmp as $row){
                $meter_type_list[$row['id']] = $row['desc'];
            }
        }
        if($is_json==true){
            $meter_type_list = json_encode($meter_type_list);
        }
        return $meter_type_list;
    }
    

    /**
     * 获取社区列表 key:village_id val:village_name
     * @return array
     */
    public function get_village_list($is_json=false){
        $tmp = M('house_village')->field('village_id,village_name')->select();
        $village_list = array();
        foreach($tmp as $row){
            $village_list[$row['village_id']] = $row['village_name'];
        }
        if($is_json==true){
            $village_list = json_encode($village_list);
        }
        return $village_list;

    }


    /**
     * 获取单位
     * @param $meter_id
     */
    public function get_unit($meter_id){
        return M('re_setmeter_config')->where('id=%d',$meter_id)->getField('unit');

    }

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
        );
        return $fstatus_list;
    }

    /**
     * 获取所有楼层 去重复
     * @return array
     */
    public function get_meter_floors(){
        $floors = $this->field('meter_floor')->distinct(true)->select();
        $floors = array_column($floors,'meter_floor');
        sort($floors,SORT_NUMERIC);
        return $floors;
    }

    /**
     * 租户用量统计
     * @param int $village_id 社区ID
     * @param int $tid 租户ID
     * @param int $month 月份
     * @return array
     * 业主编号	所属公司名称	姓名	手机号	住址	本月因缴	是否缴物业费	是否缴停车费	操作
     */
    public function get_tenant_cousume_list($village_id=0,$tid=0,$date=""){

        $current_date = $date ?  :date("Y-m");//当前年月
        //指定年月的抄表数据sql，可视作视图
        $cousume_view =  <<<sql
(
	SELECT
		*, FROM_UNIXTIME(tmp.create_time, '%Y-%m') create_date
	FROM
		(SELECT * FROM pigcms_re_setmeter ORDER BY create_time DESC) AS tmp
    WHERE FROM_UNIXTIME(tmp.create_time, '%Y-%m') = '$current_date'
	GROUP BY
		tmp.meter_hash,create_date
)
sql;
        $map = array();
        $village_id && $map['ub.village_id'] = array('eq',$village_id);//若传入社区ID 则根据社区ID 进行过滤
        $tid && $map['ub.pigcms_id'] = array('eq',$tid);//若传入租户ID 则根据租户ID过滤
        $field = array(
            'ub.pigcms_id'=>'ub_id',
            'ub.usernum',
            'ub.tenantname',
            'ub.village_id',
            'm.*',
            'sum(if(m.meter_type_id=1, c.total_consume-c.last_total_consume,0))'=>'water_cousume',//水总量
            'sum(if(m.meter_type_id=5, c.total_consume-c.last_total_consume,0))'=>'electricity_cousume',//电总量
            //租户拥有的设备中，若有抄表记录，则取出它的meter_hash 、用量、 倍率、价格、比例 为计算费用做准备，没有则标记为 no_record
            'GROUP_CONCAT(  if(c.meter_hash is not null,
                            CONCAT(c.meter_hash,"-",c.total_consume-c.last_total_consume,"-",m.rate,"-",m.price_type_id,"-",m.meter_type_id,"-",tm.scale,"-",c.admin_defined_price,"-",c.id,"-",c.total_consume,"-",c.last_total_consume),
                            CONCAT("no_record","-",m.meter_hash,"-",m.rate,"-",m.price_type_id,"-",m.meter_type_id,"-",tm.scale)))'
            =>'records',
            'c.create_date',//date("Y-m")
            'p.usernum'=>'is_enter_paylist',//是否出账
            'p.other_price',
            'p.use_other',
            'p.is_enter_list'
        );

        $tenant = M('house_village_user_bind')->alias('ub')
            ->field($field)
            ->join('left join __HOUSE_VILLAGE_USER_PAYLIST__ p on ub.usernum=p.usernum and p.create_date="%s"',$current_date)//查询他是否已经出账
                ->join('left join __HOUSE_VILLAGE_TM__ tm on tm.tid=ub.pigcms_id')//中间表
                ->join('left join __HOUSE_VILLAGE_METERS__ m on tm.meter_hash=m.meter_hash')//获取设备用量的比例,设备信息
            ->join("left join $cousume_view as c on m.meter_hash=c.meter_hash")//查询租户的抄表记录
            ->where($map)
            //根据租户聚合
            ->group('tm.tid,tm.meter_hash')
            ->select(false);
       // echo $tenant.'<br>';
        $field2 =array(
            't.*',
            'GROUP_CONCAT(t.records ORDER BY f.id)'=>'records',//抄表记录
            'GROUP_CONCAT(f.id ORDER BY f.id)'=>'ids',//id
            'GROUP_CONCAT(f.name ORDER BY f.id)'=>'names',//联系人
            'GROUP_CONCAT(f.phone ORDER BY f.id)'=>'phones',//联系方式
            'GROUP_CONCAT(f.fdesc ORDER BY f.id)'=>'floors',//楼层
            'GROUP_CONCAT(f.housesize ORDER BY f.id)'=>'housesize',//房子大小
            'sum(f.housesize*f.property_unit)'=>'property_total_price',//物业费总额
            'GROUP_CONCAT(f.property_unit ORDER BY f.id)'=>'property_units',//物业单价
        );

        $list= M()->table($tenant)->alias('t')
            ->field($field2)
            ->join('left join __HOUSE_VILLAGE_FLOOR__ f on t.tid=f.tid')
            ->group('t.ub_id')
            ->order('t.ub_id desc')
            ->select();
        //dump($list);
        //echo M()->getLastSql();

//        $list = M('house_village_floor')->alias('f')
//            ->field($field2)
//            ->join("right join ($tenant) t on t.tid=f.tid")//获取租户对应的业主信息
//            ->group('t.ub_id')
//            ->order('t.ub_id desc')
//            ->select();
       if($list){
           foreach($list as &$row){
               //获取设备名称，用量，倍率，价格配置ID
               $records = explode(',',$row['records']);//设备抄表记录
               $row['is_enter'] = $records?1:0;//是否统计完成
               foreach($records as $k=>$r){
                   if(strpos($r,"no_record")===0){
                        list($no_record,$meter_hash,$rate,$price_type_id,$meter_type_id,$scale) = explode('-',$r);
                        //未抄表的设备数据
                        $row['no_record_data'][] = array(
                            'meter_hash'=>$meter_hash,
                            'rate'=>$rate,
                            'price_type_id'=>$price_type_id,
                            'meter_type_id'=>$meter_type_id,
                            'scale'=>$scale,
                        );
                        $row['is_enter'] = 0;//有一个表未抄就没有统计完成

                   }else{//记录已抄表的信息c.total_consume-c.last_total_consume

                      list($meter_hash,$cousume,$rate,$price_type_id,$meter_type_id,$scale,$admin_defined_price,$cid,$total_consume,$last_total_consume) = explode('-',$r);
                      $row['already_record_data'][] = array(
                          'meter_hash'=>$meter_hash,
                          'cousume'=>$cousume,
                          'rate'=>$rate,
                          'price_type_id'=>$price_type_id,
                          'meter_type_id'=>$meter_type_id,
                          'scale'=>$scale,
                          'last_total_consume'=>$last_total_consume,
                          'total_consume'=>$total_consume,
                          //根据计费接口生成价格
                          'price'=>$this->get_tenant_price($row['village_id'],$cousume,$rate,$price_type_id,$scale),
                          'admin_defined_price'=>$admin_defined_price,//管理员设置的价格
                          'cid'=>$cid,

                     );
                   }
               }
               /**统计**/
               //统计抄表数据
               //计算出的费用总计
               $row['water_total_price'] = 0.00;
               $row['electricity_total_price'] = 0.00;
               //结合管理员自定义价格计算出的真实费用总计
               $row['water_total_price_true'] = 0.00;
               $row['electricity_total_price_true'] = 0.00;
               //记录数
               $row['record_water_meter_count'] = 0;
               $row['record_electricity_meter_count'] = 0;

               foreach($row['already_record_data'] as $rr){
                   if($rr['meter_type_id']==1){
                       $row['water_total_price']        +=  $rr['price'];
                       //若管理员设置了费用则取管理员设置的费用 否则选择系统计算出的费用
                       $row['water_total_price_true']   +=  $rr['admin_defined_price']>0?$rr['admin_defined_price']:$rr['price'];
                       $row['record_water_meter_count'] +=  1;
                   }
                   if($rr['meter_type_id']==5){
                       $row['electricity_total_price']          +=  $rr['price'];
                       //若管理员设置了费用则取管理员设置的费用 否则选择系统计算出的费用
                       $row['electricity_total_price_true']     +=  $rr['admin_defined_price']>0?$rr['admin_defined_price']:$rr['price'];
                       $row['record_electricity_meter_count']   +=  1;
                   }
               }
               //统计设备数据
               $row['no_record_water_meter_count'] = 0;
               $row['no_record_electricity_meter_count'] = 0;

               foreach($row['no_record_data'] as $rr){
                   if($rr['meter_type_id']==1){
                       $row['no_record_water_meter_count']+=1;
                   }
                   if($rr['meter_type_id']==5){
                       $row['no_record_electricity_meter_count']+=1;
                   }
               }
               //总设备数
               $row['meter_count'] =  $row['record_water_meter_count']
                   + $row['no_record_water_meter_count']
                   + $row['record_electricity_meter_count']
                   + $row['no_record_electricity_meter_count'];
               //总水表数
               $row['water_meter_count'] =  $row['record_water_meter_count']
                   + $row['no_record_water_meter_count'];
               //总电表数
               $row['electricity_meter_count'] = $row['record_electricity_meter_count']
                   + $row['no_record_electricity_meter_count'];
                /**统计结束**/
               //获取楼层信息
               if($row['floors']){
                   foreach(explode(',',$row['floors']) as $kk => $rr){
                       $id=explode(',',$row['ids'])[$kk];
                       $row['concat_info'][$id] = array(
                           'floor'=>$rr,
                           'name'=>explode(',',$row['names'])[$kk],
                           'phone'=>explode(',',$row['phones'])[$kk],
                           'housesize'=>explode(',',$row['housesize'])[$kk],
                           'property_unit'=>explode(',',$row['property_units'])[$kk]?:"0.00",
                       );
                   }
               }

           }
       }
       return $list;
    }

    /**
     * 计算费用
     * @param $tid
     * @param $cousume_data
     */
    public function get_tenant_price($village_id,$cousume,$rate=1,$price_type_id,$scale=1){
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
                }
            }
        }
        
        $unit_price = $config['unit_price'];
        return $cousume*$rate*$unit_price*$scale;

    }

    /**
     * 更新 止码 在确认出账后进行更新
     * @param $meter_hash
     * @param $cousume  当前用量
     * $time 增加时间更新，为年月日格式时间 zhukeqin
     */
    public function set_be_cousume($meter_hash,$last_total_consume,$total_consume,$time){
        if(empty($time)) $time=date("Y-m");
        if(is_numeric($time)) $time=date("Y-m",$time);//判断是否是时间戳，防止传参错误 zhukeqin
        $model = M('house_village_meters');
        $info = $model->where('meter_hash="%s"',$meter_hash)->find();
        $be_date=explode(',',$info['be_date']);
        //判断是否是当月多次抄表
        if(date('Y-m',strtotime($be_date['1']))==$time){
            $data = array(
                'be_date'=>explode(',',$info['be_date'])[0] . ',' . $time,
                'be_cousume'=> $last_total_consume .  ',' . $total_consume,
            );
        }else{
            $data = array(
                'be_date'=>explode(',',$info['be_date'])[1] . ',' . $time,
                'be_cousume'=> $last_total_consume .  ',' . $total_consume,
            );
        }

        return $model->where('meter_hash="%s"',$meter_hash)->save($data);
    }

    /**
     * @param bool $is_json 是否返回json
     * @return array|mixed
     */
    public function room_list($is_json=false){
        $tmp =  M('house_village_room')->select();
        $list = array();
        foreach($tmp as $key=>$row){
            $list[$row['id']] = $row;
        }
        if($is_json){
            $list = json_encode($list);
        }
        return $list;
    }

    public function sd($str){
        echo '<script>console.log("'.$str.'")</script>';
    }

}

?>
