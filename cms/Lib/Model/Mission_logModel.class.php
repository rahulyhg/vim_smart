<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/9/12
 * Time: 9:14
 */

/**
 * @author zhukeqin
 * Class Mission_log
 * 分批大型任务控制器
 */
class Mission_logModel extends Model{
    public function _initialize()
    {
        parent::_initialize();
        $this->admin_id = session('system.id');
        $this->village_id = filter_village(0, 2);
    }

    /**
     * @author zhukeqin
     * @param $data
     * @param $action_name
     * @return mixed
     * 添加一条任务
     */
    public function add_mission_one($data,$action_name){
        $add=array(
            'log_data'=>serialize($data),
            'log_action'=>$action_name,
            'admin_id'=>$this->admin_id,
            'log_status'=>1,
            'village_id'=>$this->village_id
        );
        $return=$this->data($add)->add();
        return $return;
    }

    /**
     * @author zhukeqin
     * @param $log_id
     * @return mixed
     * 获取一条任务信息
     */
    public function get_mission_one($log_id){
        $where=array(
            'log_id'=>$log_id,
            'admin_id'=>$this->admin_id,
            'village_id'=>$this->village_id
        );
        $return=$this->where($where)->find();
        $return['log_data']=unserialize($return['log_data']);
        return $return;
    }

    /**
     * @author zhukeqin
     * @param $log_id
     * @param $data
     * @param $status
     * 改变一条任务信息
     */
    public function change_mission_one($log_id,$data,$status=''){
        $where=array(
            'log_id'=>$log_id,
            'admin_id'=>$this->admin_id,
            'village_id'=>$this->village_id
        );

        $data=array('log_data'=>serialize($data));
        if(!empty($status)){
            $data['log_status']=$status;
        }
        $return=$this->where($where)->data($data)->save();
        return $return;
    }
}