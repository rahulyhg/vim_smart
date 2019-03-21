<?php
/**
 * Created by PhpStorm.
 * User: zhukeqin
 * Date: 2018/11/9
 * Time: 11:16
 */

/**
 * @author zhukeqin
 * Class Personnel_annualModel
 * 年假model
 */
class Personnel_annualModel extends Model {
    public function __construct()
    {
        parent::__construct();
    }

    //获取一条年假信息
    public function get_annual_one($where,$order='updatetime desc'){
        $return=$this->where($where)->order($order)->find();
        return $return;
    }
    //获取年假信息列表
    public function get_annual_list($where,$order='updatetime asc'){
        $return=$this->where($where)->order($order)->select();
        return $return;
    }

    /**
     * @author zhukeqin
     * @param $personnel_id
     * @param $use_day
     * @param $updatetime
     * @return array
     * 员工使用年假
     */
    public function  add_annual_one($personnel_id,$use_day,$updatetime,$remark=''){
        if(empty($updatetime)) $updatetime=time();
        if(empty($year)) $year=date('Y',$updatetime);
        //先获取员工信息
        $personnel_info=D('Personnel')->get_personnel_one(array('personnel_id'=>$personnel_id));
        if(empty($personnel_info)) return array('err'=>1,'data'=>'该员工信息不存在');
        $annual_strat=strtotime('+1 year',$personnel_info['entrytime']);
        if($updatetime<$annual_strat) return array('err'=>1,'data'=>'该员工入职不满一年，暂无法进行年假操作');
        //决定年假所属时间段
        /*$day=date('m-d',$personnel_info['entrytime']);
        if($updatetime<strtotime($year.'-'.$day)) $year--;
        $annual_year_start=strtotime($year.'-'.$day);
        $annual_year_end=strtotime((++$year).'-'.$day);
        $last_annual=$this->get_annual_one(array('personnel_id'=>$personnel_id,'updatetime'=>array('BETWEEN',array($annual_year_start,$annual_year_end))),'updatetime desc');
        $personnel_info['annual_day']=$this->get_annual_day($personnel_id)['data'];
        $annual_residue_last=$last_annual?$last_annual['annual_residue_last']:$personnel_info['annual_day'];*/
        $annual_residue_last=$this->get_annual_residue($personnel_id,$updatetime)['data'];
        $annual_residue=$annual_residue_last-$use_day;
        if($annual_residue<0) return array('err'=>1,'data'=>'年假天数不足');
        $data['annual_day']=$personnel_info['annual_day'];
        $data['annual_use']=$use_day;
        $data['annual_residue_last']=$annual_residue_last;
        $data['annual_residue']=$annual_residue;
        $data['updatetime']=$updatetime;
        $data['year']=$year;
        $data['personnel_id']=$personnel_id;
        $data['admin_id']=$_SESSION['system']['id'];
        $data['remark']=$remark;
        $re=$this->data($data)->add();
        if($re){
            return array('err'=>0,'data'=>$re);
        }else{
            return array('err'=>1,'data'=>'修改失败');
        }
    }

    /**
     * @author zhukeqin
     * @param $personnel_id
     * @return array
     * 获取某一员工整年年假天数
     */
    public function get_annual_day($personnel_id){
        //先获取员工信息
        $updatetime=time();
        $personnel_info=D('Personnel')->get_personnel_one(array('personnel_id'=>$personnel_id));
        if(empty($personnel_info)) return array('err'=>1,'data'=>'该员工信息不存在');
        $annual_strat=strtotime('+1 year',$personnel_info['entrytime']);
        if($updatetime<$annual_strat) return array('err'=>1,'data'=>'暂无年假');
        $annual_15=strtotime('+15 year',$personnel_info['entrytime']);
        $annual_10=strtotime('+10 year',$personnel_info['entrytime']);
        $annual_1=strtotime('+1 year',$personnel_info['entrytime']);
        if($updatetime>$annual_15) return array('err'=>0,'data'=>'20');
        if($updatetime>$annual_10) return array('err'=>0,'data'=>'10');
        if($updatetime>$annual_1) return array('err'=>0,'data'=>'5');
        return array('err'=>1,'data'=>'未知错误');
    }

    public function get_annual_residue($personnel_id,$updatetime){
        if(empty($updatetime)) $updatetime=time();
        if(empty($year)) $year=date('Y',$updatetime);
        //先获取员工信息
        $personnel_info=D('Personnel')->get_personnel_one(array('personnel_id'=>$personnel_id));
        if(empty($personnel_info)) return array('err'=>1,'data'=>'该员工信息不存在');
        $annual_strat=strtotime('+1 year',$personnel_info['entrytime']);
        if($updatetime<$annual_strat) return array('err'=>1,'data'=>'暂无年假');
        //决定年假所属时间段
        $day=date('m-d',$personnel_info['entrytime']);
        if($updatetime<strtotime($year.'-'.$day)) $year--;
        $annual_year_start=strtotime($year.'-'.$day);
        $annual_year_end=strtotime((++$year).'-'.$day);
        $last_annual=$this->get_annual_one(array('personnel_id'=>$personnel_id,'updatetime'=>array('BETWEEN',array($annual_year_start,$annual_year_end))),'updatetime desc');
        $personnel_info['annual_day']=$this->get_annual_day($personnel_id)['data'];
        $annual_residue_last=$last_annual?$last_annual['annual_residue']:$personnel_info['annual_day'];
        return array('err'=>0,'data'=>$annual_residue_last);
    }
}