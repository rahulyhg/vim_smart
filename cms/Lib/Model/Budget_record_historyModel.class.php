<?php

/**
 * @author zhukeqin
 * 记录操作历史控制器
 * Class Budget_recordModel
 */
class Budget_record_historyModel extends Model{

    /**
     * @author zhukeqin
     * @param $where
     * 取得符合要求的单条数据
     */

    public function get_history_one($where){
        $return=$this->where($where)->order('`history_id` ASC')->find();
        //dump(M()->_sql());
        return $return;

    }
    /**
     * @author zhukeqin
     * @param $where
     * @param $sort 排序方式
     * 取得符合要求的单条数据
     */
    public function  get_history_list($where,$sort='`history_id` ASC'){
        return $this->where($where)->order($sort)->select();

    }

    /**
     * @author zhukeqin
     * @param $record_id
     * @param $last_record_status 更改前的状态
     * @param string $remark
     * @param string $data
     * @return bool
     * 增加一条操作记录
     */
    public function add_history_one($record_id,$last_record_status,$remark='',$data=''){
        $now_record_status=D('Budget_record')->get_record_one(array('record_id'=>$record_id))['record_status'];
        $data=array(
            'record_id'=>$record_id,
            'admin_id'=>$_SESSION['system']['id'],
            'last_record_status'=>$last_record_status,
            'now_record_status'=>$now_record_status,
            'remark'=>$remark,
            'data'=>serialize($data),
            'updatetime'=>time(),
        );
        $this->data($data)->add();
        return true;
    }

}



?>