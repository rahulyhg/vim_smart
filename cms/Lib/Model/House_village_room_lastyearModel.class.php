<?php
/**
 * Created by PhpStorm.
 * User: zhukeqin
 * Date: 2019/1/18
 * Time: 17:08
 */
class House_village_room_lastyearModel extends Model{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * @author zhukeqin
     * @param $rid
     * @param $year
     * @return array|mixed
     * 获得去年的物业费结余
     */
    public function get_lastyear_property($rid,$year){
        $propertyModel=new PropertyModel();
        if(empty($year)) $year=date('Y');
        $lastyear=$year-1;
        $data=$this->where(array('type' => 'property', 'year' => $year, 'rid' => $rid))->find();
        if(empty($data)){
            $propertyModel->property_update_cache($rid,$lastyear);
            $cache_info=M('house_village_fee_cache')->where(array('rid'=>$rid,'type'=>'property','year'=>$lastyear))->find();
            $json=unserialize($cache_info['data']);
            $data=array(
                'rid'=>$rid,
                'data'=>serialize(array('lastyear_receive'=>$json['list']['12']['payend_recive'],'lastyear_advance'=>$json['list']['12']['payend_advance'])),
                'type'=>'property',
                'year'=>$year
            );
            $this->data($data)->add();
        }
        return $data;
    }

    /**
     * @author zhukeqin
     * @param $carspace_id
     * @param $year
     * @return array|mixed
     * 获取一条去年停车费记录
     */
    public function get_lastyear_carspace($carspace_id,$year){
        $propertyModel=new PropertyModel();
        if(empty($year)) $year=date('Y');
        $lastyear=$year-1;
        $data=$this->where(array('type' => 'carspace', 'year' => $year, 'carspace_id' => $carspace_id))->find();
        if(empty($data)){
            $propertyModel->carspace_update_cache($carspace_id,$lastyear);
            $cache_info=M('house_village_fee_cache')->where(array('carspace_id'=>$carspace_id,'type'=>'carspace','year'=>$lastyear))->find();
            $json=unserialize($cache_info['data']);
            $data=array(
                'rid'=>$cache_info['rid'],
                'carspace_id'=>$carspace_id,
                'data'=>serialize(array('lastyear_receive'=>$json['sum_nowend'])),
                'type'=>'carspace',
                'year'=>$year
            );
            $this->data($data)->add();
        }
        return $data;
    }

    /**
     * @author zhukeqin
     * @param $rid
     * @param $year
     * @param $type
     * @return array|mixed
     * 获取一条其它记录
     */
    public function get_lastyear_otherfee($rid,$year,$type){
        $propertyModel=new PropertyModel();
        if(empty($year)) $year=date('Y');
        $lastyear=$year-1;
        $data=$this->where(array('type' => $type, 'year' => $year, 'rid' => $rid))->find();
        if(empty($data)){
            $propertyModel->other_update_cache($rid,$type,$year);
            $cache_info=M('house_village_fee_cache')->where(array('rid'=>$rid,'type'=>$type,'year'=>$lastyear))->find();
            $json=unserialize($cache_info['data']);
            $data=array(
                'rid'=>$rid,
                'data'=>serialize(array('lastyear_receive'=>$json['sum_nowend'])),
                'type'=>$type,
                'year'=>$year
            );
            $this->data($data)->add();
        }
        return $data;
    }

}