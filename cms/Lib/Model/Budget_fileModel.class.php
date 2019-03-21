<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/9/19
 * Time: 16:46
 */

class Budget_fileModel extends Model{

    /**
     * @author zhukeqin
     * @param $where
     * 取得符合要求的单条数据
     */

    public function get_file_one($where){
        $return=$this->where($where)->order('`file_id` ASC')->find();
        //dump(M()->_sql());
        return $return;

    }
    /**
     * @author zhukeqin
     * @param $where
     * @param $sort 排序方式
     * 取得符合要求的多条数据
     */
    public function  get_file_list($where,$sort='`file_id` ASC'){
        return $this->where($where)->order($sort)->select();
    }

    /**
     * @author zhukeqin
     * @param $data
     * @param $file
     * @param $id
     * 新增/修改一条文件信息的方法
     */
    public function change_file_list($data,$file,$id,$village_id,$project_id='',$file_status='1'){
        $village_info=M('house_village')->where(array('village_id'=>$village_id))->find();
        if(empty($village_info)) return '所选项目不存在';
        if(empty($village_info['department_id'])) return '所选项目暂不存在所属公司，无法添加';
        if($id){
            //检测需要修改的信息是否存在
            $file_info=$this->get_file_one(array('file_id'=>$id));
            if(empty($file_info)) {
                return '需要修改的信息不存在';
            }
            unlink($file_info['file_path']);
        }
        //保存文件
        $filepath=D('Budget_record')->upload_file($file);
        if(empty($id)&&!$filepath) return '文件上传失败';
        $cache=array(
            'file_remark'=>$data['file_remark'],
            'file_update_time'=>time(),
            'type_id'=>$data['type_id'],
            'year'=>$data['year'],
            'file_status'=>$file_status,
            'file_check_time'=>time(),
            'file_check_remark'=>$data['file_check_remark'],
            'file_check_admin_id'=>$_SESSION['system']['id']
        );
        //应对没有上传文件的情况
        if($filepath){
            $cache['file_path']=$filepath;
            $cache['file_name']=$file['name'];
            $cache['file_type']=array_pop(explode('.',$file['name']));
        }
        if(empty($id)){
            $cache['village_id']=$village_id;
            if(!empty($project_id))$cache['project_id']=$project_id;
            $cache['company_id']=$village_info['department_id'];
            $cache['file_create_time']=$cache['file_update_time'];
            $return=$this->data($cache)->add();
        }else{
            $return=$this->where(array('file_id'=>$id))->data($cache)->save();
        }
        if($return){
            return '';
        }else{
            unlink($filepath);//删除对应的文件
            return '添加失败';
        }
    }

    /**
     * @author zhukeqin
     * @param $file_id
     * @return string
     * 删除一条文件记录
     */
    public function delete_file_one($file_id){
        $file_info=$this->get_file_one(array('file_id'=>$file_id));
        if(empty($file_info)) return '该文件不存在';
        $return_file_status=unlink($file_info['file_path']);
        if(!$return_file_status) return '文件删除失败';
        $return_status=$this->where(array('file_id'=>$file_id))->delete();
        if($return_status){
            return '';
        }else{
            return '删除失败';
        }
    }

    public function check_file_one($file_id,$file_status,$file_check_remark){
        $file_info=$this->get_file_one(array('file_id'=>$file_id));
        if(empty($file_info)) return '该文件不存在';
        $file_status_list=array('1','2','3');
        if(!in_array($file_status,$file_status_list)) return '类型不正确';
        $data=array(
            'file_status'=>$file_status,
            'file_check_time'=>time(),
            'file_check_remark'=>$file_check_remark,
            'file_check_admin_id'=>$_SESSION['system']['id'],
        );
        $re=$this->data($data)->where(array('file_id'=>$file_id))->save();
        if($re){
            return '';
        }else{
            return $re;
        }
    }

    public function village_add_one($data,$file,$id){
        $village_id=$_SESSION['system']['village_id'];
        $project_id=$_SESSION['project_id'];
        $village_info=M('house_village')->where(array('village_id'=>$village_id))->find();
        if(empty($village_info)) return '所选项目不存在';
        if(empty($village_info['department_id'])) return '所选项目暂不存在所属公司，无法添加';
        if($id){
            //检测需要修改的信息是否存在
            $file_info=$this->get_file_one(array('file_id'=>$id));
            if(empty($file_info)) {
                return '需要修改的信息不存在';
            }
            if($file_info['file_status']!=3){
                return '目标当前无法修改';
            }
            unlink($file_info['file_path']);
        }
        //保存文件
        $filepath=D('Budget_record')->upload_file($file);
        if(empty($id)&&!$filepath) return '文件上传失败';
        $cache=array(
            'file_remark'=>$data['file_remark'],
            'file_update_time'=>time(),
            'type_id'=>$data['type_id'],
            'year'=>$data['year'],
        );
        //应对没有上传文件的情况
        if($filepath){
            $cache['file_path']=$filepath;
            $cache['file_name']=$file['name'];
            $cache['file_type']=array_pop(explode('.',$file['name']));
        }
        if(empty($id)){
            $cache['village_id']=$village_id;
            if(!empty($project_id))$cache['project_id']=$project_id;
            $cache['company_id']=$village_info['department_id'];
            $cache['file_create_time']=$cache['file_update_time'];
            $return=$this->data($cache)->add();
        }else{
            $return=$this->where(array('file_id'=>$id))->data($cache)->save();
        }
        if($return){
            return '';
        }else{
            unlink($filepath);//删除对应的文件
            return '添加失败';
        }
    }

}