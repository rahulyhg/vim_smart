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
class Budget_predict_logModel extends Model{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * @author zhukeqin
     * @param $predict_id
     * @param $predict_log_id
     * @return mixed
     * 获取一条修改记录
     */
    public function get_log_one($predict_id,$predict_log_id=''){
        if(empty($predict_log_id)){
            $where=array('predict_id'=>$predict_id);
        }else{
            $where=array('perdict_log_id'=>$predict_log_id);
        }
        $data=$this->where($where)->order('predict_id desc')->find();
        $data['data_log']=unserialize($data['data_log']);
        $data['admin_name']=D('Admin')->get_admin_one(array('id'=>$data['admin_id']))['realname'];
        return $data;
    }

    /**
     * @author zhukeqin
     * @param $predict_id
     * @return array|mixed
     * 获取某条目所有的历史修改记录
     */
    public function get_log_list($predict_id){
        $where=array('predict_id'=>$predict_id);
        $data=$this->field(array('remark','updatetime','admin_id','status'))->where($where)->select();
        foreach ($data as &$value){
            $value['data_log']=unserialize($value['data_log']);
            $value['admin_name']=D('Admin')->get_admin_one(array('id'=>$value['admin_id']))['realname'];
        }

        return $data;
    }

    public function add_log_one($predict_id){
        $budget_predictModel=new Budget_predictModel();
        $predict_now=$budget_predictModel->get_predict_one(array('predict_id'=>$predict_id));
        if(empty($predict_now)) return array('err'=>1,'data'=>'所选条目不存在');
        $data=array(
            'predict_id'=>$predict_id,
            'data_log'=>serialize($predict_now['data']),
            'remark'=>$predict_now['remark'],
            'updatetime'=>time(),
            'admin_id'=>$predict_now['check_admin_id'],
            'status'=>$predict_now['status'],
        );
        $re=$this->data($data)->add();
        if($re){
            return array('err'=>0,'data'=>$re);
        }else{
            return array('err'=>1,'data'=>'插入失败');
        }
    }
}