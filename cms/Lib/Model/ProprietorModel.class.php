<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/26
 * Time: 10:17
 */
class ProprietorModel extends Model
{
    protected $tableName = 'house_village_user_bind_tenement';
    public $village_id = 0;
    public function _initialize(){
        parent::_initialize();
        $this->village_id =  M('admin','pigcms_')->where('id=%d',session('system.id'))->getField('village_id');
    }

    public function build_data($data){
        $this->startTrans();
        $this->add_to_user_bind($data);
        $this->add_to_user_bind_tenement($data);
        $this->commit();
    }

    /**
     * 向house_village_user_bind表添加数据
     */
    public function add_to_user_bind($data){

        foreach($data as $key=>&$row){
            if(!$row['ownername']){
                unset($data[$key]);
                continue;
            }
            //删除已经存在的业主
            if(M('house_village_user_bind')->where('ownername="%s"',$row['ownername'])->count()){
                unset($data[$key]);
                continue;
            }
            $row['village_id'] = $this->village_id;
            $row['add_time'] = time();
        }

        $re = M('house_village_user_bind')->addAll($data);
        return $re;
    }
    /**
     * 向house_village_user_bind_tenement表添加数据
     */
    public function add_to_user_bind_tenement($data){




        foreach($data as $key=>&$row){
            //删除存在的楼层
            if(M('house_village_user_bind_tenement')->where('tdesc="%s"',$row['tdesc'])->count()){
                unset($data[$key]);
                continue;
            }
            //水格式转换
            list($row['water_price'],$row['water_type'],$row['water_total_consume']) = explode('-',$row['water_price']);
            $row['water_price'] = floatval($row['water_price']);
            $row['water_type'] = $this->switch_water_type($row['water_type'])?:0;
            //电格式转换
            list($row['electric_price'],$row['electric_type'],$row['electric_total_consume']) = explode('-',$row['electric_price']);
            $row['electric_price'] = floatval($row['electric_price']);
            $row['electric_type'] = $this->switch_electric_type($row['electric_type'])?:0;
            $num = M('house_village_user_bind_tenement')->add($row);
            //向device_code 表添加数据
            if($num){
                $water_device = array(
                    'tid'=>$num,
                    'device_code'=>'',
                    'create_time'=>time(),
                    'sign_id'=>$row['water_type'],
                    'sign'=>$this->get_water_sign($row['water_type'])?:"",
                    'total_consume'=>$row['water_total_consume']?:0,

                );

                M('device_code')->add($water_device);
                $electric_device = array(
                    'tid'=>$num,
                    'device_code'=>'',
                    'create_time'=>time(),
                    'sign_id'=>$row['electric_type'],
                    'sign'=>$this->get_electric_sign($row['electric_type'])?:"",
                    'total_consume'=>$row['electric_total_consume']?:0,
                );
                M('device_code')->add($electric_device);
            }

        }
        unset($row);

    }

    /**
     * 获取水费类型id
     * @param $xls_type 表格上的类型编号
     * @return mixed
     */
    protected function switch_water_type($xls_type){
        $m =array(
            1=>3, //普通用水
            2=>2, //商用水
            3=>4, //装修用水
        );
        return $m[$xls_type];
    }

    /**
     * 获取水费标记sign
     * @param $meter_type re_setmeter_config 表里的类型编号
     * @return mixed
     */
    protected function get_water_sign($meter_type){
        $m =array(
            3=>'p_water', //普通用水
            2=>'c_water', //商用水
            4=>'p_water', //装修用水
        );
        return $m[$meter_type];
    }

    /**
     * 获取电费类型id
     * @param $xls_type 表格上的类型编号
     * @return mixed
     */
    protected function switch_electric_type($xls_type){
        $m =array(
            1=>7, //普通用电
            2=>6, //商用电
            3=>8, //装修用电
        );
        return $m[$xls_type];
    }

    /**
     * 获取电费标记sign
     * @param $meter_type
     * @return mixed
     */
    protected function get_electric_sign($meter_type){
        $m =array(
            7=>'p_electricity', //普通电
            6=>'c_electricity', //商用电
            8=>'f_electricity', //装修电
        );
        return $m[$meter_type];
    }

    /**
     * 过滤掉表格中的空值
     * @param $arr
     * @return array
     */
    public function set_array_default_val($arr){
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
     * 列表
     * @return mixed
     */
    public function lists(){
        $list = M('house_village_user_bind_tenement')->alias('t')
            ->field('* ,t.id as tid')
            ->join('left join __HOUSE_VILLAGE_USER_BIND__ ub on ub.usernum=t.usernum and ub.usernum<>""')
            ->select();

        foreach($list as $key=>&$row){
            $row['devices'] = M('device_code')->where(array('tid'=>$row['tid']))->select();
        }
        return $list;
    }

    public function import($village_id){
        $path = array_shift($_FILES)['tmp_name'];
        $PHPReader = new \PHPExcel_Reader_Excel5();
        $PHPExcel = $PHPReader->load($path);
        $data = $PHPExcel->getActiveSheet()->toArray(null, true, true, false);
        $columns = array(
            'tstatus',
            'tdesc',
            'ownername',
            'tenementname',
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
            $d['usernum'] = 'GFYH' . date("YmdHis") .mt_rand(100000,999999);
            $d['village_id'] = $village_id;
            $d = $this->set_array_default_val($d);
        }
        unset($d);
        array_shift($data);
        //dump($data);
        $this->build_data($data);

    }

    /**
     * 获取社区ID
     * @return bool|mixed
     */
    public function get_proprietor_village(){
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
}