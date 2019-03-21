<?php

/**
 * @author zhukeqin
 * 预算金额控制器
 * Class Budget_typeModel
 */
class Budget_moneyModel extends Model{

    /**
     * @author zhukeqin
     * @param $where
     * 取得符合要求的单条数据
     */

    public function get_money_one($where){
        $return=$this->where($where)->order('`money_id` ASC')->find();
        //dump(M()->_sql());
        return $return;

    }
    /**
     * @author zhukeqin
     * @param $where
     * @param $sort 排序方式
     * 取得符合要求的单条数据
     */
    public function  get_money_list($where,$sort='`money_id` ASC'){
        return $this->where($where)->order($sort)->select();

    }

    /**
     * @author zhukeqin
     * @param $money
     * @param $type_id
     * @param $village_id
     * @param $year
     * @param $project_id
     * @return string
     * 更改预算金额
     */
    public function change_money_one($money,$type_id,$village_id,$company_id,$year,$project_id){
        if(empty($year)){
            $year=date('Y');
        }
        if(empty($money)||empty($type_id)||empty($village_id)){
            return '请传入参数';
        }
        $where=array(
          'type_id'=>$type_id,
            'village_id'=>$village_id,
            'money_year'=>$year,
            'company_id'=>$company_id
        );
        if(!empty($project_id)){
            $where['project_id']=$project_id;
        }
        $money_info=$this->get_money_one($where);
        if(empty($money_info)){
            $return=$this->add_money_one($money,$type_id,$village_id,$company_id,$year,$project_id);
            $return=!$return;
        }else{
            $return=$this->where($where)->data(array('money_sum'=>$money))->save();
        }

            $add=D('Budget_log')->change_log_one($type_id,$village_id,$company_id,$project_id,$year);

            return '';
    }

    /**
     * @author zhukeqin
     * @param $money
     * @param $type_id
     * @param $village_id
     * @param $year
     * @param $project_id
     * @return string
     * 插入一条预算金额
     */
    public function add_money_one($money,$type_id,$village_id,$company_id,$year,$project_id){
        if(empty($year)){
            $year=date('Y');
        }
        if(empty($type_id)||empty($village_id)){
            return '请传入参数';
        }
        $where=array(
            'type_id'=>$type_id,
            'village_id'=>$village_id,
            'money_year'=>$year,
            'company_id'=>$company_id
        );
        if(!empty($project_id)){
            $where['project_id']=$project_id;
        }
        $money_info=$this->get_money_one($where);
        if(empty($money_info)){
            $data=$where;
            if(empty($money)){
                $where['money_year']--;
                $money_lastyear_info=$this->get_money_one($where);
                if(empty($money_lastyear_info)){
                    return '没有上一年的记录，请传入预算金额';
                }
                $data['money_sum']=$money_lastyear_info['money_sum'];
            }else{
                $data['money_sum']=$money;
            }
            $return=$this->data($data)->add();
        }else{
            return '已有记录，无法插入';
        }
        if($return){
            D('Budget_log')->change_log_one($type_id,$village_id,$company_id,$project_id,$year);
            return '';
        }else{
            return '插入失败';
        }
    }
    public function get_money_village_tree($village_id,$year,$project_id){
        if(empty($year)){
            $year=date('Y');
        }
        if(empty($village_id)||empty($village_id)){
            return '请传入参数';
        }
        $where=array(
            'village_id'=>$village_id,
            'money_year'=>$year,
        );
        if(!empty($project_id)){
            $where['project_id']=$project_id;
        }
        $list=$this->get_money_list($where);
        $return='';
        foreach ($list as $value){
            $return[$value['type_id']]=$value['money_sum'];
        }
        return $return;
    }
    public function get_money_village_list($village_id,$year,$project_id){
        if(empty($year)){
            $year=date('Y');
        }
        $where=array('village_id'=>$village_id,'log_time'=>$year);
        if(!empty($project_id))$where['project_id']=$project_id;
        $list=D('Budget_log')->get_log_list($where);
        $return=array();
        foreach ($list as $value){
            $cache=unserialize($value['log_data']);
            $return[$value['type_id']]=array('money_sum'=>$cache['money_sum'],'sum'=>$cache['sum']);
        }
        $company_id=M('house_village')->where(array('village_id'=>$village_id))->find()['department_id'];
        $type_list=D('Budget_type')->get_type_list(array('type_rank'=>3));
        foreach ($type_list as $value1){
            if(empty($return[$value1['type_id']])){
                $cache1=$this->add_money_one('',$value1['type_id'],$village_id,$company_id,$year,$project_id);
                if(empty($cache1)){
                    $get=$this->get_money_one(array('village_id'=>$village_id,'money_year'=>$year,'project_id'=>$project_id,$value1['type_id']));
                    if(!empty($get)){
                        $return[$value1['type_id']]=array('money_sum'=>$get['money_sum'],'sum'=>'0');
                    }
                }
            }
        }
        return $return;
    }
}



?>