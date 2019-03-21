<?php
/**
 * Created by PhpStorm.
 * User: zhukeqin
 * Date: 2018/11/9
 * Time: 10:43
 */

class Personnel_contractModel extends Model{
    public function __construct()
    {
        parent::__construct();

    }

    //获取一条合同信息
    public function get_contract_one($where,$order='time_end desc'){
        $return=$this->where($where)->order($order)->find();
        return $return;
    }
    //获取合同信息列表
    public function get_contract_list($where,$order='time_end asc'){
        $return=$this->where($where)->order($order)->select();
        return $return;
    }

    /**
     * @author zhukeqin
     * @param $data
     * @param $contract_id
     * @return array
     * 增加或修改一条合同信息
     */
    public function change_contract_one($data,$contract_id){
        if($contract_id){
            $contract_info=$this->get_contract_one(array('personnel_contract_id'=>$contract_id));
            if(empty($contract_info)) return array('err'=>1,'data'=>'该合同信息不存在');
        }
        $contract['time_start']=$data['time_start'];
        $contract['time_end']=$data['time_end'];
        $contract['time_update']=time();
        $contract['remark']=$data['remark'];
        if(!empty($data['personnel_id'])){
            $contract['personnel_id']=$data['personnel_id'];
        }
        $contract['admin_id']=$_SESSION['system']['id'];
        if(empty($contract_id)){
            $contract['time_add']=time();
            $re=$this->data($contract)->add();
        }else{
            $re=$this->where(array('personnel_contract_id'=>$contract_id))->data($contract)->save();
        }

        if($re){
            return array('err'=>0,'data'=>$re);
        }else{
            return array('err'=>1,'data'=>'修改/插入失败');
        }
    }

    /**
     * @author zhukeqin
     * @param $contract_id
     * @return array
     * 删除一条
     */
    public function delete_contract_one($contract_id){
        $re=$this->where(array('personnel_contract_id'=>$contract_id))->delete();
        if($re){
            return array('err'=>0,'data'=>$re);
        }else{
            return array('err'=>1,'data'=>'删除失败');
        }
    }


}