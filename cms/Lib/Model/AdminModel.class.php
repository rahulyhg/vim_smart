<?php
/**
 * Created by PhpStorm.
 * User: zhukeqin
 * Date: 2018/11/13
 * Time: 15:11
 */
class AdminModel extends Model{
    public function __construct()
    {
        parent::__construct();
    }


    public function get_admin_one($where,$order='id desc'){
        $return=$this->where($where)->order($order)->find();
        return $return;
    }

    public function get_admin_list($where,$order='id desc'){
        $return=$this->where($where)->order($order)->select();
        return $return;
    }

    public function admin_save($data,$admin_id){
        $admin=array();
        if(empty($data['account'])) return array('err'=>1,'data'=>'账号不能为空');
        if(empty($admin_id)){
            $admin_info=$this->get_admin_one(array('account'=>$data['account']));
            if($admin_info) return array('err'=>1,'data'=>'账号已存在，请重新设置');
        }else{
            $admin_info=$this->get_admin_one(array('id'=>$admin_id));
            if($admin_info['account']!=$data['account']) return array('err'=>1,'data'=>'不能更改账号名');
        }
        $admin['account']=$data['account'];
        if(!empty($data['pwd'])){
            $admin['pwd']=md5($data['pwd']);
        }
        if($data['nickname']){
            $user_openid =  M('user')->where(array('nickname'=>(string)$data['nickname']))->getField('openid')?:'';
            if(empty($user_openid)){
                return array('err'=>1,'data'=>'该微信账号不存在');
            }else{
                $admin['openid']=$user_openid;
            }
        }
        $admin['village_id']=$data['village_id'];
        $admin['realname']=$data['realname'];
        $admin['phone']=$data['phone'];
        $admin['role_id']=implode(',',$data['role_id']);
        $admin['department_id']=$data['department_id'];
        $admin['project_id']=implode(',',$data['project_id']);
        if(empty($admin_id)){
            $this->data($admin)->add();
        }else{
            $this->data($admin)->where(array('admin_id'=>$admin_id))->save();
        }
        return array('err'=>0,'data'=>'上传成功！');
    }

    public function get_admin($admin_id)
    {
        return $this->where(array('id'=>$admin_id))->find();
    }

}