<?php

/**
 * @author zhukeqin
 * Class Budget_cashierModel
 * 出纳方法
 */
class Budget_cashierModel extends Model{

    /**
     * @author zhukeqin
     * @param $where
     * 取得符合要求的单条数据
     */

    public function get_cashier_one($where,$model=''){
        if(!empty($where['cashier_village_id'])) {
            $where['_string']='find_in_set("'.$where['cashier_village_id'].'",cashier_village_id)';
            unset($where['cashier_village_id']);
        }
        if(empty($model)) $where['status']=1;
        $return=$this->where($where)->order('`cashier_id` ASC')->find();
        //dump(M()->_sql());
        return $return;

    }
    /**
     * @author zhukeqin
     * @param $where
     * @param $sort 排序方式
     * 取得符合要求的多条数据
     */
    public function  get_cashier_list($where,$sort='`cashier_id` ASC',$model=''){
        if(!empty($where['cashier_village_id'])) {
            $where['_string']='find_in_set("'.$where['cashier_village_id'].'",cashier_village_id)';
            unset($where['cashier_village_id']);
        }
        if(empty($model)) $where['status']=1;
        return $this->where($where)->order($sort)->select();
    }

    /**
     * @author zhukeqin
     * @param $data
     * @param $admin_id
     * @return string
     * 修改/新增一条出纳员信息
     */
    public function change_cashier_one($data,$admin_id){
        $cashier['cashier_village_id']=implode(',',$data['cashier_village_id']);
        if(!empty($data['status'])) $cashier['status']=$data['status'];
        $cashier['remark']=$data['remark'];
        $cashier_info=$this->get_cashier_one(array('admin_id'=>$admin_id));
        if(empty($cashier_info)){
            $cashier['admin_id']=$admin_id;
            $return=$this->data($cashier)->add();
        }else{
            $return=$this->where(array('admin_id'=>$admin_id))->data($cashier)->save();
        }
        if($return){
            return '';
        }else{
            return '插入/修改失败';
        }
    }

    /**
     * @author zhukeqin
     * @return array|mixed
     * 获取全部出纳员信息
     */
    public function get_cashier_all($model=''){
        $role_id=M('role')->where(array('role_name'=>'出纳员'))->find()['role_id'];
        $admin_list=M('admin')->where(array('_string'=>'find_in_set("'.$role_id.'",role_id)'))->select();
        $return=array();
        foreach ($admin_list as $key=>$value){
            $cashier_info=$this->get_cashier_one(array('admin_id'=>$value['id']));
            if($cashier_info['status']==2&&empty($model)) continue;
            $return[$key]=array('account'=>$value['account'],'realname'=>$value['realname']);
            if($cashier_info){
                $village_list=explode(',',$cashier_info['cashier_village_id']);
                $return[$key]['village_list_id']=$village_list;
                $return[$key]['status']=$cashier_info['status'];
                $return[$key]['remark']=$cashier_info['remark'];
                $return[$key]['cashier_id']=$cashier_info['cashier_id'];
                $return[$key]['village_list_info']=M('house_village')->where(array('village_id'=>array('IN',$village_list)))->select();
            }
        }
        return $return;
    }

    /**
     * @author
     * @param string $model 不使用则返回默认第一个出纳，给予非空值则返回列表
     * @return array
     * 获取全部项目及对应出纳
     */
    public function get_cashier_village($model=''){
        //获取全部项目列表
        $village_list=M('house_village')->where(array('department_id'=>array('exp',' is not null AND department_id != ""')))->select();
        $cashier_list=array();
        foreach ($village_list as $value){
            if($model){
                $cashier_list[$value['village_id']]=$this->get_cashier_list(array('cashier_village_id'=>$value['village_id']));
            }else{
                $cashier_list[$value['village_id']]=$this->get_cashier_one(array('cashier_village_id'=>$value['village_id']))['cashier_id'];
            }
        }
        return $cashier_list;
    }



}