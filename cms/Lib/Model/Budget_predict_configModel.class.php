<?php
/**
 * Created by PhpStorm.
 * User: zhukeqin
 * Date: 2018/12/14
 * Time: 8:50
 */

/**
 * @author zhukeqin
 * Class Budget_predict_logModel
 * 预算审批历史条目控制
 */
class Budget_predict_configModel extends Model{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * @author zhukeqin
     * @param $config_type_id
     * @param $department_id
     * @param $village_id
     * @param $project_id
     * @return mixed
     * 获取一条记录，当部门id不为空时，项目id失效，部门id为空时，项目id有效
     */
    public function get_config_one($config_type_id,$department_id,$village_id,$project_id){
        if(empty($department_id)){
            $where=array('village_id'=>$village_id,'config_type_id'=>$config_type_id);
            if(!empty($project_id)) $where['project_id']=$project_id;
        }else{
            $where=array('config_type_id'=>$config_type_id,'department_id'=>$department_id);
        }
        $data=$this->where($where)->order('predict_config_id desc')->find();

        return $data;
    }

}