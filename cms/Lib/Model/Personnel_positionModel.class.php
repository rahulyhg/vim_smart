<?php
/**
 * Created by PhpStorm.
 * User: zhukeqin
 * Date: 2018/11/9
 * Time: 11:56
 */
class Personnel_positionModel extends Model{
    public function __construct()
    {
        parent::__construct();
    }

    //获取一条职位变动信息
    public function get_position_one($where,$order='time_change desc'){
        $return=$this->where($where)->order($order)->find();
        return $return;
    }
    //获取职位变动信息列表
    public function get_position_list($where,$order='time_change asc'){
        $return=$this->where($where)->order($order)->select();
        return $return;
    }

    /**
     * @author zhukeqin
     * @param $data
     * @param $personnel_position_id
     * @return array
     * 改变/新增一条职位变更信息
     */
    public function change_position_one($data,$personnel_position_id){
        if($personnel_position_id){
            $position_info=$this->get_position_one(array('personnel_position_id'=>$personnel_position_id));
            if(empty($position_info)) return array('err'=>1,'data'=>'该职位变动信息不存在');
        }
        $last_postion=$this->get_position_one(array('personnel_id'=>$data['personnel_id']));
        $position['position_last']=$data['position_last']?:$last_postion['position_now'];
        $position['position_now']=$data['position_now'];
        if(empty($position['position_now'])) return array('err'=>1,'data'=>'当前职位信息不可为空');
        $position['time_change']=$data['time_change'];
        $position['time_updatetime']=time();
        $position['because']=$data['because'];
        $position['remark']=$data['remark'];
        if(!empty($data['personnel_id'])){
            $position['personnel_id']=$data['personnel_id'];
        }
        $position['admin_id']=$_SESSION['system']['id'];
        if(empty($personnel_position_id)){
            $re=$this->data($position)->add();
        }else{
            $re=$this->where(array('personnel_position_id'=>$personnel_position_id))->data($position)->save();
        }

        if($re){
            return array('err'=>0,'data'=>$re);
        }else{
            return array('err'=>1,'data'=>'执行失败');
        }
    }
}