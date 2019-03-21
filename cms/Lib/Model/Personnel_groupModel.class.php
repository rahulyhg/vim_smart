<?php
/**
 * Created by PhpStorm.
 * User: zhukeqin
 * Date: 2018/11/9
 * Time: 11:56
 */

/**
 * 管理员对应管理分类管理
 * Class Personnel_groupModel
 */
class Personnel_groupModel extends Model{
    public function __construct()
    {
        parent::__construct();
    }


    public function get_group_one($where){
        $return=$this->where($where)->find();
        return $return;
    }

    public function get_group_list($where){
        $return=$this->where($where)->select();
        return $return;
    }

    /**
     * @author zhukeqin
     * @param $group_id
     * @param $admin_id
     * @return array
     * 改变某一个组类别
     */
    public function change_group_one($group_id,$admin_id){
        /*$re=$this->where(array('group_id'=>$group_id))->delete();
        foreach ($data as $value){
            $this->data(array('admin_id'=>$value,'group_id'=>$group_id))->add();
        }*/
        $group_info=$this->get_group_one(array('group_id'=>$group_id));
        if(empty($group_info)){
            $re=$this->data(array('group_id'=>$group_id,'admin_id'=>$admin_id))->add();
        }else{
            $re=$this->data(array('admin_id'=>$admin_id))->where(array('group_id'=>$group_id))->save();
        }
        if($re){
            return array('err'=>0,'data'=>'执行成功');
        }else{
            return array('err'=>1,'data'=>'执行失败，请重试');
        }
    }



}