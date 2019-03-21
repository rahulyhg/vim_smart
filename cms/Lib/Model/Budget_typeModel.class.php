<?php

/**
 * @author zhukeqin
 * 预算类目控制器
 * Class Budget_typeModel
 */
class Budget_typeModel extends Model{

    /**
     * @author zhukeqin
     * @param $where
     * 取得符合要求的单条数据
     */

    public function get_type_one($where){
        if(!empty($where['company_id'])) {
            $company_id=$where['company_id'];
            unset($where['company_id']);
            if(is_array($company_id)){
                $where['_string']='find_in_set("0",type_company_id) ';
                foreach ($company_id as $value){
                    $where['_string'] .='or find_in_set("'.$value.'",type_company_id) ';
                }
            }else{
                $where['_string']='find_in_set("'.$company_id.'",type_company_id) or find_in_set("0",type_company_id)';
            }
        }
        $return=$this->where($where)->order('`type_id` ASC')->find();
        //dump(M()->_sql());
        return $return;

    }
    /**
     * @author zhukeqin
     * @param $where
     * @param $sort 排序方式
     * 取得符合要求的单条数据
     */
    public function  get_type_list($where,$sort='`type_sort` DESC,`type_id` ASC'){
        if(!empty($where['company_id'])){
            if(empty($where['type_fid'])){
                $company_id=$where['company_id'];
                unset($where['company_id']);
                if(is_array($company_id)){
                    $where['_string']='find_in_set("0",type_company_id) ';
                    foreach ($company_id as $value){
                        $where['_string'] .='or find_in_set("'.$value.'",type_company_id) ';
                    }
                }else{
                    $where['_string']='find_in_set("'.$company_id.'",type_company_id) or find_in_set("0",type_company_id)';
                }
            }else{
                $type_fid_info=$this->get_type_one(array('type_id'=>$where['type_fid']));
                if($type_fid_info['type_rank']!=3){
                    $company_id=$where['company_id'];
                    unset($where['company_id']);
                    if(is_array($company_id)){
                        $where['_string']='find_in_set("0",type_company_id) ';
                        foreach ($company_id as $value){
                            $where['_string'] .='or find_in_set("'.$value.'",type_company_id) ';
                        }
                    }else{
                        $where['_string']='find_in_set("'.$company_id.'",type_company_id) or find_in_set("0",type_company_id)';
                    }
                }else{
                    unset($where['company_id']);
                }
            }
        }
        return $this->where($where)->order($sort)->select();

    }
    /**
     * @author zhukeqin
     * @param $data
     * 新增/修改一条类目
     */
    public function  change_type_one($data){
        if(!empty($data['type_fid'])){
            $fid_info=$this->get_type_one(array('type_id'=>$data['type_fid']));
            if(empty($fid_info)){
                return '您所选择的父类目不存在，请重新选择';
            }
        }
        //检测是否有同名的项在同一级类目中
        $type_name_info=$this->get_type_one(array('type_name'=>$data['type_name'],'type_fid'=>$data['type_fid']));
        if(!empty($type_name_info)&&$type_name_info['type_id']!=$data['type_id']){
            return '当前项目名字出现重复，请更改名字重新提交或者更改原项目';
        }
        //检查所属公司
        if(empty($data['type_company_id'])){
            if($data['type_rank']==1){
                $data['type_company_id']=0;
            }else{
                $data['type_company_id']=$fid_info['type_company_id'];
            }
        }else{
            if ($data['type_rank']==1){
                $data['type_company_id']=implode(',',$data['type_company_id']);
            }else{
                $fid_company_list=explode(',',$fid_info['type_company_id']);
                $cache=array();
                //判断父类目是否是全公司通用
                if($fid_company_list['0']==0){
                    $cache=$data['type_company_id'];
                }else{
                    foreach ($data['type_company_id'] as $value){
                        if(in_array($value,$fid_company_list)) $cache[]=$value;
                    }
                }
                $data['type_company_id']=implode(',',$cache);
            }
        }
        if(!empty($data['type_id'])){
            $type_info=$this->get_type_one(array('type_id'=>$data['type_id']));
            if(empty($type_info)){
                return '您所选择类目更新的类目不存在请检查';
            }
            $return=$this->where(array('type_id'=>$data['type_id']))->data($data)->save();
        }else{
            $return=$this->data($data)->add();
        }
        if($return){
            return 0;
        }else{
            return '插入/更新失败，请重试';
        }
    }

    public function get_type_list_tree($where){
        $where['type_rank']=1;
        //保证收入在最上面
        if(empty($where['type_id'])){
            $where['type_id']=array('neq',4);
            $type_list=$this->get_type_list($where);
            $shouru=$this->get_type_list(array('type_id'=>4));
            $type_list=array_merge($shouru,$type_list);
            unset($where['type_id']);
        }else{
            $type_list=$this->get_type_list($where);
        }
        $data=array();
        foreach ($type_list as $key=>$value){
            $data[$value['type_id']]=$value;
            $where['type_rank']=2;
            $where['type_fid']=$value['type_id'];
            $type_list1=$this->get_type_list($where);
            foreach ($type_list1 as $key1=>$value1){
                $data[$value['type_id']]['children'][$value1['type_id']]=$value1;
                $where['type_rank']=3;
                $where['type_fid']=$value1['type_id'];
                $type_list2=$this->get_type_list($where);
                foreach ($type_list2 as $key2=>$value2){
                    $data[$value['type_id']]['children'][$value1['type_id']]['children'][$value2['type_id']]=$value2;
                }
            }
        }
        return $data;
    }

    /**
     * @author zhukeqin
     * @param $type_id
     * @param string $model
     * @return string
     * 返回名字，model不给值则返回完整名字链
     */
    public function get_type_name($type_id,$model=''){
        $type_info=$this->get_type_one(array('type_id'=>$type_id));
        if(empty($model)){
            $fid=$type_info['type_fid'];
            $type_name=$type_info['type_name'];
            //循环 直到为一级分类
            while($fid){
                $type_info=$this->get_type_one(array('type_id'=>$fid));
                $fid=$type_info['type_fid'];
                $type_name= $type_info['type_name'].'-'.$type_name;
            }
        }else{
            $type_name=$type_info['type_name'];
        }
        return $type_name;
    }

}



?>