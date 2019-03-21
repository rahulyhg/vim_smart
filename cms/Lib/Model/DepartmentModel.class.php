<?php
class DepartmentModel extends Model{


    /**
     * @author zhukeqin
     * @param $where
     * 取得符合要求的单条数据
     */

    public function get_department_one($where){
        $return=$this->where($where)->order('`id` ASC')->find();
        //dump(M()->_sql());
        return $return;

    }
    /**
     * @author zhukeqin
     * @param $where
     * @param $sort 排序方式
     * 取得符合要求的数据
     */
    public function  get_department_list($where,$sort='`id` ASC'){
        return $this->where($where)->order($sort)->select();
    }

    public function get_department_tree($where,$sort='id ASC'){
        $list=$this->where($where)->order($sort)->select();
        $return=array();
        foreach ($list as $value){
            $return[$value['id']]=$value['deptname'];
        }
        return $return;
    }

    public function get_department_path($id){
        $path=array($id);
        while (!empty($id)){
            $department_info=$this->get_department_one(array('id'=>$id));
            array_unshift($path,$department_info['pid']);
            $id=$department_info['pid'];
        }
        return $path;
    }

    /**
     * @author zhukeqin
     * @param $id
     * @return mixed
     * 获取部门所属项目的信息
     */
    public function get_department_village($id){
        while (!empty($id)){
            $department_info=$this->get_department_one(array('id'=>$id));
            if(!empty($department_info['village_id'])){
                $village_info=M('house_village')->where(array('village_id'=>$department_info['village_id']))->find();
                break;
            }
            $id=$department_info['pid'];
        }
        return $village_info;
    }

}
?>