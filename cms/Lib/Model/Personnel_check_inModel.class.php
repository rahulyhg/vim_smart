<?php
/**
 * Created by PhpStorm.
 * User: zhukeqin
 * Date: 2018/12/4
 * Time: 10:05
 */

/**
 * @author zhukeqin
 * 考勤相关控制器
 * Class Personnel_check_inModel
 */
class Personnel_check_inModel extends Model{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * @author zhukeqin
     * @param $where
     * @param string $order
     * @return mixed
     * 获取一条考勤数据
     */
    public function get_check_in_one($where,$order='check_in_id desc'){
        $return=$this->where($where)->order($order)->find();
        $return['department_info']=D('Department')->get_department_one(array('id'=>$return['department_id']));
        foreach ($return as $key=>$value){
            if(strstr($key,'type')!==false){
                $return[$key]=unserialize($value);
            }
        }
        if(!empty($return['type_file'])){
            $fileModel=new ImageModel();
            foreach ($return['type_file'] as $key=>$value){
                $return['type_file'][$key]=$fileModel->get_file_info($value);
            }
        }
        return $return;
    }

    /**
     * @author zhukeqin
     * @param $where
     * @param string $order
     * @return mixed
     * 获取一组考勤数据
     */
    public function get_check_in_list($where,$order='check_in_id desc'){
        $return=$this->where($where)->order($order)->select();
        return $return;
    }

    /**
     * @author zhukeqin
     * @param $data
     * @param $department_id 所属部门
     * @param $admin_id 上传者id
     * @param $ci_name 考勤员姓名
     * @param $pm_name 项目经理姓名
     * @param $status 状态
     * @param $remark 备注（选填）
     * @param string $check_in_id
     * @return array
     * 新增/修改一条数据
     */
    public function change_check_in_one($data,$department_id,$admin_id,$ci_name,$pm_name,$status,$remark,$check_in_id=''){
        if(!empty($check_in_id)){
            $check_in_info=$this->get_check_in_one(array('check_in_id'=>$check_in_id));
            if(empty($check_in_info)) return array('err'=>1,'data'=>'所需修改条目不存在');
            if($check_in_info['status']==2) return array('err'=>1,'data'=>'该条目已经通过审核,无法修改');
        }
        $check_in_data=array();
        //循环获取各个类目
        foreach ($data as $key=>$value){
            $check_in_data[$key]=serialize($value);
        }
        if(!empty($department_id)) $check_in_data['department_id']=$department_id;
        if(!empty($admin_id)) $check_in_data['admin_id']=$admin_id;
        if(!empty($ci_name)) $check_in_data['ci_name']=$ci_name;
        if(!empty($pm_name)) $check_in_data['pm_name']=$pm_name;
        if(!empty($status)) $check_in_data['status']=$status;
        if(!empty($remark)) $check_in_data['remark']=$remark;
        if($check_in_id){
            $check_in_data['checktime']=time();
            $re=$this->where(array('check_in_id'=>$check_in_id))->data($check_in_data)->save();
        }else{
            $check_in_data['uploadtime']=time();
            $re=$this->data($check_in_data)->add();
        }

        if($re){
            return array('err'=>0,'data'=>$re);
        }else{
            return array('err'=>0,'data'=>'数据修改错误');
        }
    }

    /**
     * @author zhukeqin
     * @param $check_in_id
     * @param $status
     * @param $remark
     * @return array
     * 审核一条数据
     */
    public function check_check_in_one($check_in_id,$status,$admin_id,$remark){
        if(empty($check_in_id)||empty($status)) return array('err'=>1,'data'=>'参数错误');
        $check_in_data=array('status'=>$status,'checktime'=>time(),'check_admin_id'=>$admin_id);
        if(!empty($remark)) $check_in_data['remark']=$remark;
        $re=$this->where(array('check_in_id'=>$check_in_id))->data($check_in_data)->save();
        if($re){
            return array('err'=>0,'data'=>$re);
        }else{
            return array('err'=>0,'data'=>'数据修改错误');
        }
    }

}