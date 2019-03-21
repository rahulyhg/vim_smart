<?php
/**
 * Created by PhpStorm.
 * User: zhukeqin
 * Date: 2018/11/23
 * Time: 15:55
 */

/**
 * @author zhukeqin
 * Class PersonnelAction
 * 人事管理微信端控制器相关
 */
class PersonnelAction extends BaseAction{
    function __construct()
    {
        parent::__construct();
        $this->admin_info=D('Admin')->get_admin_one(array('openid'=>$_SESSION['openid']));
    }
    public function personnel_list(){
        $now=$_GET['time']?$_GET['time']:date('Y-m');
        //$personnel_group_list=D('Personnel_group')->get_group_list(array('admin_id'=>$this->admin_info['id']));
        $personnel_group_list=M('personnel_group')
            ->alias('pg')
            ->field('pg.admin_id,gl.*')
            ->join('left join __HOUSE_VILLAGE_GROUP_LIST__ gl on gl.group_id=pg.group_id')
            ->where(array('pg.admin_id'=>$this->admin_info['id']))
            ->select();
        $personnel_group=$_GET['group_id']?$_GET['group_id']:$personnel_group_list['0']['group_id'];
        $personnelModel=new PersonnelModel();
        $personnel_social=$personnelModel->personnel_social($now,$personnel_group);
        $personnel_accumulation=$personnelModel->personnel_accumulation($now,$personnel_group);
        $personnel_contract=$personnelModel->personnel_contract($now,$personnel_group);
        $personnel_recommd=$personnelModel->personnel_recommd($now,$personnel_group);
        $this->assign('personnel_social',$personnel_social);
        $this->assign('personnel_accumulation',$personnel_accumulation);
        $this->assign('personnel_contract',$personnel_contract);
        $this->assign('personnel_recommd',$personnel_recommd);
        $this->assign('time',$now);
        if(!empty($personnel_group)){
            $group_name=M('house_village_group_list')->where(array('group_id'=>$personnel_group))->find()['group_name'];
            $this->assign('group_name',$group_name);
        }
        $this->assign('personnel_group',$personnel_group);
        $this->assign('personnel_group_list',$personnel_group_list);
        $this->display();
    }

    /**
     * @author zhukeqin
     * 人员信息查看
     */
    public function personnel_info(){
        $personnel_id=$_GET['personnel_id'];
        $personnelModel=new PersonnelModel();
        $personnel_contract=new Personnel_contractModel();
        $personnel_info=$personnelModel->get_personnel_one(array('personnel_id'=>$personnel_id));
        if(empty($personnel_info)) $this->error('系统没有找到该员工');
        $personnel_info['contract']=$personnel_contract->get_contract_one(array('personnel_id'=>$personnel_id));
        $personnel_info['department_name']=$personnelModel->get_department_name($personnel_info['department_id']);
        $this->assign('personnel_info',$personnel_info);
        $this->display();
    }
    /**
     * @author zhukeqin
     * 参保人员列表
     */
    /*public function personnel_social($time,$group_id=''){
        $now=$time?strtotime($time):time();
        $thismonth_start=strtotime(date('Y-m',$now));//本月开始时间
        $thismonth_end=strtotime(date('Y-m-t',$now))+24*3600-1;//本月结束时间
        $departmentModel=new DepartmentModel();
        $personnelModel=new PersonnelModel();
        $where_data=array('status'=>1);
        $where_data['social_addtime']=array('BETWEEN',array($thismonth_start,$thismonth_end)) ;
        $personnel_list=$personnelModel->get_personnel_list($where_data);
        foreach ($personnel_list as $key=>$value){
            $personnel_list[$key]['department_name']=$this->get_department_name($value['department_id']);
            if(!empty($group_id)){
                $department_info=$departmentModel->get_department_village($value['department_id']);
                if($department_info['group_id']!=$group_id) unset($personnel_list[$key]);
            }
        }
        return $personnel_list;
    }*/

    /**
     * @author zhukeqin
     * 公积金列表
     */
    /*public function personnel_accumulation($time,$group_id=''){
        $now=$time?strtotime($time):time();
        $thismonth_start=strtotime(date('Y-m',$now));//本月开始时间
        $thismonth_end=strtotime(date('Y-m-t',$now))+24*3600-1;//本月结束时间
        $departmentModel=new DepartmentModel();
        $personnelModel=new PersonnelModel();
        $where_data=array('status'=>1);
        $where_data['accumulation_addtime']=array('BETWEEN',array($thismonth_start,$thismonth_end)) ;
        $personnel_list=$personnelModel->get_personnel_list($where_data);
        foreach ($personnel_list as $key=>$value){
            $personnel_list[$key]['department_name']=$this->get_department_name($value['department_id']);
            if(!empty($group_id)){
                $department_info=$departmentModel->get_department_village($value['department_id']);
                if($department_info['group_id']!=$group_id) unset($personnel_list[$key]);
            }
        }

        return $personnel_list;
    }*/

    /**
     * @author zhukeqin
     * 合同到期列表
     */
    /*public function personnel_contract($time,$group_id=''){
        $now=$time?strtotime($time):time();
        $thismonth_start=strtotime(date('Y-m',$now));//本月开始时间
        $thismonth_end=strtotime(date('Y-m-t',$now))+24*3600-1;//本月结束时间
        $departmentModel=new DepartmentModel();
        $personnelModel=new PersonnelModel();
        $where_data=array('p.status'=>1);
        $where_data['pc.time_end']=array('BETWEEN',array($thismonth_start,$thismonth_end)) ;
        $personnel_list=M('personnel')->alias('p')
            ->field('p.*,pc.time_end,pc.time_start')
            ->join('left join __PERSONNEL_CONTRACT_NOREPEAT__ pc on pc.personnel_id=p.personnel_id ')
            ->where($where_data)
            ->select();
        foreach ($personnel_list as $key=>$value){
            $personnel_list[$key]['department_name']=$this->get_department_name($value['department_id']);
            if(!empty($group_id)){
                $department_info=$departmentModel->get_department_village($value['department_id']);
                if($department_info['group_id']!=$group_id) unset($personnel_list[$key]);
            }
        }

        return $personnel_list;
    }*/
    /**
     * @author zhukeqin
     * 入职推荐提醒列表
     */
    /*public function personnel_recommd($time,$group_id=''){
        $now=$time?strtotime($time):time();
        $thismonth_start=strtotime(date('Y-m',$now));//本月开始时间
        $thismonth_end=strtotime(date('Y-m-t',$now))+24*3600-1;//本月结束时间
        $departmentModel=new DepartmentModel();
        $personnelModel=new PersonnelModel();
        $personnel_positionModel=new Personnel_positionModel();
        $where_data['status']=1;
        $where_data['entry_time']=array('egt',strtotime('-7 month'));
        $where_data['_string']='trim(induction_channel) !=""';
        $personnel_list=M('Personnel')->where($where_data)->select();
        $time_huidehang_start=strtotime('-3 month',$thismonth_start);
        $time_huidehang_end=strtotime('-3 month',$thismonth_end);
        $time_liangjiang_start=strtotime('-6 month',$thismonth_start);
        $time_liangjiang_end=strtotime('-6 month',$thismonth_end);
        $text='';
        foreach ($personnel_list as $key=>$value){
            $check='';
            $village_info=$departmentModel->get_department_village($value['department_id']);
            if(!empty($village_info['group_id'])){
                if($village_info['group_id']==1){
                    $personnel_position=$personnel_positionModel->get_position_one(array('personnel_id'=>$value['personnel_id']))['position_now'];
                    if($value['entrytime']>$time_huidehang_start&&$value['entrytime']<$time_huidehang_end&&mb_strpos('秩序员',$personnel_position)!==false){
                        $check=$value;
                    }
                }
                if($village_info['group_id']==2||$village_info['group_id']==4){
                    if($value['entrytime']>$time_liangjiang_start&&$value['entrytime']<$time_liangjiang_end){
                        $check=$value;
                    }
                }
            }
            if(!empty($check)){
                $personnel_list[$key]['department_name']=$this->get_department_name($value['department_id']);
                $personnel_list[$key]['induction_name']=explode('介绍',$value['induction_channel'])['0'];
                if(!empty($personnel_list[$key]['induction_name'])){
                    $personnel_list[$key]['induction_info']=$personnelModel->get_personnel_one(array('name'=>$personnel_list[$key]['induction_name']));
                }
                if(!empty($group_id)){
                    $department_info=$departmentModel->get_department_village($value['department_id']);
                    if($department_info['group_id']!=$group_id) unset($personnel_list[$key]);
                }
            }else{
                unset($personnel_list[$key]);
            }
        }

        return $personnel_list;
    }*/

}