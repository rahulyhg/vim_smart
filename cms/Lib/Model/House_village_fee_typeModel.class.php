<?php

/**
 * @author zhukeqin
 * Class House_village_fee_type
 * 费用类型控制器
 */
class House_village_fee_typeModel extends Model{
    /**
     * @author zhukeqin
     * @param $model
     * @return array|mixed
     * 获取全部支付类型   参数为空时传出type_id为键值   type_name为值的数组
     * 不为空时则传出全部信息
     */
    public function get_type_list($model){
        $type_list=$this->select();
        $return=array();
        if(empty($model)){
            foreach ($type_list as $value){
                $return[$value['type_id']]=$value['type_name'];
            }
        }else{
            $return=$type_list;
        }
        return $return;
    }

    /**
     * @author zhukeqin
     * @param $type_id
     * @param $model
     * @return mixed
     * 返回一条数据信息    model值为空时则只传出type_name
     */
    public function get_type_one($type_id,$model){
        $type_info=$this->where(array('type_id'=>$type_id))->find();
        if(empty($model)){
            $return=$type_info['type_name'];
        }else{
            $return=$type_info;
        }
        return $return;
    }
}