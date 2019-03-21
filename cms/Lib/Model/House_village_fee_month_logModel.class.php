<?php
/**
 * Created by PhpStorm.
 * User: admin
 */

/**
 * 月报表历史统计存储控制器
 * Class House_village_fee_month_logModel
 */
class House_village_fee_month_logModel extends Model{
    /**
     * @author zhukeqin
     * @param $village_id
     * @param $project_id
     * @param $year
     * 获取一条记录
     */
    public function get_log_one($village_id,$project_id,$year){
        if(empty($year)) $year=date('Y');
        $where=array(
            'village_id'=>$village_id,
            'project_id'=>$project_id,
            'year'=>$year,
        );
        $return=$this->where($where)->find();
        if($return) {
            $data=unserialize($return['log_data']);
        }else{
            $data=array();
        }
        return $data;
    }


    /**
     * @author zhukeqin
     * @param $data
     * @param $village_id
     * @param $project_id
     * @param $year
     * @return string
     * 修改/新增一条记录，成功则返回空
     */
    public function update_log_one($data,$village_id,$project_id,$year){
        if(empty($year)) $year=date('Y');
        $where=array(
            'village_id'=>$village_id,
            'project_id'=>$project_id,
            'year'=>$year,
        );
        $return=$this->where($where)->find();
        $log_data=array();
        foreach ($data as $key=>$value){
            $type_id=M('house_village_fee_type')->where(array('type_name'=>trim($value['0'])))->find()['type_id'];
            if(empty($type_id)) continue;
            for($i=1;$i<=12;$i++){
                $log_data[$type_id][$i]=$value[$i+2];
            }
        }
        $data=array(
            'log_data'=>serialize($log_data),
            'village_id'=>$village_id,
            'project_id'=>$project_id,
            'year'=>$year
        );
        if(empty($return)){
            $return=$this->data($data)->add();
        }else{
            $return=$this->where($where)->data($data)->save();
        }
        if($return){
            return '';
        }else{
            return '修改/新增失败';
        }
    }




}