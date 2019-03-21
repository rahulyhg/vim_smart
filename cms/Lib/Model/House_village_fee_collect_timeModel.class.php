<?php
/**
 * Created by PhpStorm.
 * User: admin
 */

/**
 * 月报表统计日期存储控制器
 * Class House_village_fee_collect_timeModel
 */
class House_village_fee_collect_timeModel extends Model{
    /**
     * @author zhukeqin
     * @param $village_id
     * @param $project_id
     * @param $year
     * 获取一条记录，如果不存在则新建 成功则返回空
     */
    public function get_time_one($village_id,$project_id,$year){
        if(empty($year)) $year=date('Y');
        $where=array(
            'village_id'=>$village_id,
            'project_id'=>$project_id,
            'year'=>$year,
        );
        $return=$this->where($where)->find();
        if(empty($return)){
            $return1=$this->add_time_one($village_id,$project_id,$year);
            if($return1) return $return1;
            $return=$this->where($where)->find();
        }
        $data=unserialize($return['collect_time_data']);
        return $data;
    }

    /**
     * @author zhukeqin
     * @param $village_id
     * @param $project_id
     * @param $year
     * @return string
     * 添加一个新的记录
     */
    public function add_time_one($village_id,$project_id,$year){
        if(empty($year)) $year=date('Y');
        $where=array(
            'village_id'=>$village_id,
            'project_id'=>$project_id,
            'year'=>$year,
        );
        $return=$this->where($where)->find();
        if($return) return '已存在，添加失败';
        $village_info=M('house_village')->where(array('village_id'=>$village_id))->find();
        if(empty($village_info)) return '所选项目不存在';
        if($project_id) {
            $project_info=M('house_village_project')->where(array('pigcms_id'=>$project_id))->find();
            if(empty($project_info)) return '所选小区不存在';
        }
        $collect_time_data=array();
        for($i=1;$i<=12;$i++){
            $collect_time_data[$i]='25';
        }
        $data=array(
          'collect_time_data'=>serialize($collect_time_data),
            'village_id'=>$village_id,
            'project_id'=>$project_id,
            'year'=>$year
        );
        $return=$this->data($data)->add();
        if($return){
            return '';
        }else{
            return '添加失败';
        }
    }

    /**
     * @author zhukeqin
     * @param $data
     * @param $village_id
     * @param $project_id
     * @param $year
     * @return string
     * 修改一条记录，成功则返回空
     */
    public function update_time_one($data,$village_id,$project_id,$year){
        if(empty($year)) $year=date('Y');
        $where=array(
            'village_id'=>$village_id,
            'project_id'=>$project_id,
            'year'=>$year,
        );
        $return=$this->where($where)->find();
        if(empty($return)){
            $return1=$this->add_time_one($village_id,$project_id,$year);
            if($return1) return $return1;
        }
        $collect_time_data=array();
        for($i=1;$i<=12;$i++){
            $collect_time_data[$i]=$data[$i];
        }
        $data=array(
            'collect_time_data'=>serialize($collect_time_data),
        );
        $return=$this->where($where)->data($data)->save();
        if($return){
            return '';
        }else{
            return '修改失败';
        }
    }




}