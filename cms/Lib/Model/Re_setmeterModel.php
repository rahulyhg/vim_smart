<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/9/10
 * Time: 9:48
 */
class Re_setmeterModel extends Model{
    /**
     * @author zhukeqin
     * @param $meter_search
     * @param $total_consume
     * @param $time 上传时间戳
     * @param string $type 为$meter_search参数类型，1为meter_hash,2为id，3为meter_code
     * 添加一条抄表记录
     */
    public function add_one($meter_search,$total_consume,$time,$type='1'){
        if(empty($time)) $time=time();
        if($type==2){
            $meter_hash=M('house_village_meters')->where(array('id'=>$meter_search['id']))->find()['meter_hash'];
        }elseif($type==3){
            $meter_hash=M('house_village_meters')->where(array('meter_code'=>$meter_search['meter_code'],'village_id'=>$meter_search['village_id']))->find()['meter_hash'];
        }else{
            $meter_hash=$meter_search['meter_hash'];
        }
        $meter=new MeterModel();
        $meter_info=$meter->get_meter_info($meter_hash);//获取设备详细信息
        dump($meter_info);
        dump($meter_hash);
        dump($_SESSION);
        die;
        if(empty($meter_info)){
            return '该设备不存在';
        }
        if(strtotime($meter_info['last_date'])>$time) return '该条记录重复导入不可';
        //设置条目信息
        $data['admin_id']=$_SESSION['system']['admin_id'];
        $data['last_total_consume']=$meter_info['last_cousume'];
        $data['total_consume']=$total_consume;
        $data['create_time']=$time;
        $data['meter_hash']=$meter_hash;
        $data['rate']=$meter_info['rate'];
        $data['price_type_id']=$meter_info['price_type_id'];
        $data['ym']=date('Y-m',$time);
        $res=$this->add($data);
        if($res){
            //更新设备表中的起止码
            $meter=$meter->set_be_cousume($meter_hash,$meter_info['last_cousume'],$total_consume,date('Y-m-d',$time));
            return '';
        }else{
            return '修改失败,请重试';
        }
    }

    /**
     * @author zhukeqin
     * @param $meter_hash
     * @param $year
     * @return
     * 获取单个设备的年度抄表记录
     */
    public function get_meter_record($meter_hash,$year){
        if(empty($year)) $year=date('Y');
        $meter_info=M('house_village_meters')->where(array('meter_hash'=>$meter_hash))->find();
        if(empty($meter_hash)) return '该表不存在';
        $unit_price=M('re_setmeter_config')->where(array('id'=>$meter_info['price_type_id']))->find()['unit_price'];
        $return=array();
        $sum=array('degree'=>0,'money'=>0);
        for ($i=1;$i<=12;$i++){
            $ym=$year.'-'.sprintf('%02d',$i);
            $record_list=$this->where(array('meter_hash'=>$meter_hash,'ym'=>$ym))->order('create_time asc')->select();
            $start=0;
            $end=0;
            //获取当月起码和止码
            foreach ($record_list as $key=>$value){
                if(empty($start)) $start=$value['last_total_consume'];
                if(empty($end)) $end=$value['total_consume'];
                $start = $start<$value['last_total_consume']?$start:$value['last_total_consume'];
                $end = $end>$value['total_consume']?$end:$value['total_consume'];
            }
            $degree=($start-$end)*$meter_info['rate'];
            $return[$i]=array('total_consume'=>$end,'degree'=>$degree,'money'=>$degree*$unit_price);
            $sum['degree'] +=$return[$i]['degree'];
            $sum['money'] +=$return[$i]['money'];
        }
        $return['sum']=$sum;
        return $return;
    }

    /**
     * @author zhukeqin
     * @param $village_id
     * @param $year
     * @param string $search
     * @return array|string
     * 批量获取抄表信息
     */
    public function meter_record_list($village_id,$year,$search=''){
        if(empty($village_id)) return '请选择项目';
        if(empty($year)) $year=date('Y');
        $where=array();
        if(!empty($search)) $where=$search;
        $where['is_del']=0;
        $where['village_id']=$village_id;
        //获取全部符合要求的设备信息
        $meter_list=M('house_village_meters')->where($where)->select();
        $return=array();
        $sum=array();
        foreach ($meter_list as $key=>$value){
            $unit_price=M('re_setmeter_config')->where(array('id'=>$value['price_type_id']))->find()['unit_price'];
            $cache=array(
                'meter_code'=>$value['meter_code'],
                 'rate'=>$value['rate'],
                'unit_price'=>$unit_price,
                'meter_desc'=>$value['meter_desc'],
             );
            $cache['list']=$this->get_meter_record($value['meter_hash'],$year);
            foreach ($cache['list'] as $key1=>$value1){
                $sum[$key1]['degree'] +=$value1['degree'];
                $sum[$key1]['money'] +=$value1['money'];
            }
            $return[$key]=$cache;
        }
        $return['sum']=$sum;
        return $return;

    }

}