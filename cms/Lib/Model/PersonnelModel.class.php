<?php
/**
 * Created by PhpStorm.
 * User: zhukeqin
 * Date: 2018/11/5
 * Time: 10:07
 */
class PersonnelModel extends Model{
    public function __construct()
    {
        parent::__construct();
    }
    //获取一条人员信息
    public function get_personnel_one($where,$model=''){
        if(empty($model)) $where['status']=1;
        $return=$this->where($where)->order('personnel_id asc')->find();
        return $return;
    }
    //获取人员信息列表
    public function get_personnel_list($where,$order='personnel_id asc',$model=''){
        if(empty($model)) $where['status']=1;
        $return=$this->where($where)->order($order)->select();
        return $return;
    }

    /**
     * @author zhukeqin
     * @param $data
     * @param $id
     * @return array
     * 新增或修改一条记录
     */
    public function change_personnel_one($data,$id){
        $return['err']=0;
        if($id){
            $personnel=$this->get_personnel_one(array('personnel_id'=>$id));
            if(empty($personnel)) return array('err'=>1,'data'=>'该员工信息不存在');
        }else{
            $personnel=$this->get_personnel_one(array('name'=>$data['name'],'id_number'=>$data['id_number']));
            if(!empty($personnel)) $id=$personnel['personnel_id'];
        }
        $personnel_info=array();
        $personnel_info['department_id']=$data['department_id'];
        $personnel_info['job_number']=$data['job_number'];
        $personnel_info['name']=$data['name'];
        $personnel_info['sex']=$data['sex'];
        $personnel_info['phone']=$data['phone'];
        $personnel_info['position']=$data['position'];
        $personnel_info['native_place']=$data['native_place'];
        $personnel_info['id_number']=$data['id_number'];
        //自动计算生日 根据身份证号
        $id_number_info=$this->getIDCardInfo(trim($data['id_number']));
        if($id_number_info['error']!=2){
            return array('err'=>1,'data'=>'身份证格式错误'.$id_number_info['error'].$data['id_number']);
        }else{
            $personnel_info['birthday']=strtotime($id_number_info['tdate']);
        }
        //检查学历是否有误
        if($data['education']<0||$data['education']>8||!is_numeric($data['education'])){
            $personnel_info['education']='0';
        }else{
            $personnel_info['education']=$data['education'];
        }
        $personnel_info['education_remark']=$data['education_remark'];
        $personnel_info['marital']=$data['marital'];

        //检查政治身份
        if($data['politics']<1||$data['politics']>13||!is_numeric($data['politics'])){
            $personnel_info['politics']=13;
        }else{
            $personnel_info['politics']=$data['politics'];
        }


        $personnel_info['entrytime']=$data['entrytime'];//入职时间
        $personnel_info['positivetime']=$data['positivetime'];//转正时间
        $personnel_info['height']=$data['height'];
        $personnel_info['family_address']=$data['family_address'];
        $personnel_info['family_phone']=$data['family_phone'];
        $personnel_info['graduat_school']=$data['graduat_school'];
        $personnel_info['learning_type']=$data['learning_type'];
        $personnel_info['major']=$data['major'];
        $personnel_info['certification']=$data['certification'];
        $personnel_info['enlist']=$data['enlist'];
        $personnel_info['induction_channel']=$data['induction_channel'];
        $personnel_info['job_remark']=$data['job_remark'];
        $personnel_info['social_addtime']=$data['social_addtime'];
        $personnel_info['social_condition']=$data['social_condition'];
        $personnel_info['accumulation_addtime']=$data['accumulation_addtime'];
        $personnel_info['accumulation_money']=$data['accumulation_money'];
        if(empty($data['annual_day'])){
            $personnel_info['annual_day']=5;
        }else{
            $personnel_info['annual_day']=$data['annual_day'];
        }
        //新加人员则初始化年假数据
        if(empty($id)) $personnel_info['annual_vation']=serialize(array(date('Y')=>$personnel_info['annual_day']));

        $personnel_info['admin_id']=$data['admin_id'];
        $personnel_info['main_experience']=$data['main_experience'];
        $personnel_info['group_id']=$data['group_id'];

        if($id){
            $re=$this->data($personnel_info)->where(array('personnel_id'=>$id))->save();
        }else{
            $re=$this->data($personnel_info)->add();
        }
        if($re){
            return array('err'=>0,'data'=>$re);
        }else{
            return array('err'=>1,'data'=>'修改/插入失败');
        }
    }

    /**
     * @author zhukeqin
     * @param $id
     * @return array
     * 删除（隐藏）一个人员
     */
    public function delete_personnel_one($id){
        $personnel_info=$this->get_personnel_one(array('personnel_id'=>$id));
        if(empty($personnel_info)) return array('err'=>1,'data'=>'该人员信息不存在');
        if($personnel_info==2) return array('err'=>1,'data'=>'该人员信息不存在');
        $re=$this->where(array('personnel_id'=>$id))->data(array('status'=>2))->save();
        if($re){
            return array('err'=>0,'data'=>'删除成功');
        }else{
            return array('err'=>1,'data'=>'删除失败');
        }
    }

    /**
     * @author zhukeqin
     * @param $id
     * @param $year
     * @param $day
     * @return array
     * 年假信息更新
     */
    public function annual_personnel_one($id,$year,$day){
        $personnel_info=$this->get_personnel_one(array('personnel_id'=>$id));
        if(empty($personnel_info)) return array('err'=>1,'data'=>'该人员信息不存在');
        if(empty($year)) $year=date('Y');
        if(empty($day)) $day=$personnel_info['annual_day'];
        $annual_vation=unserialize($personnel_info['annual_vation']);
        $annual_vation[$year]=$day;
        $re=$this->where(array('personnel_id'=>$personnel_info['personnel_id']))->data(array('annual_vation'=>serialize($annual_vation)))->save();
        if($re){
            return array('err'=>0,'data'=>'年假信息更新成功');
        }else{
            return array('err'=>1,'data'=>'年假信息更新失败');
        }
    }

    /**
     * @author zhukeqin
     * @param $IDCard
     * @param int $format 默认返回年月日 2则返回月日
     * @return mixed
     */
    public function getIDCardInfo($IDCard,$format=1){
    $result['error']=0;//0：未知错误，1：身份证格式错误，2：无错误
    $result['tdate']='';//生日，格式如：2012-11-15
    if(!preg_match("/^(\d{15}$|^\d{18}$|^\d{17}(\d|X|x))$/",$IDCard)){
        $result['error']=1;
        return $result;
    }else{
    if(strlen($IDCard)==18)
    {
        $tyear=intval(substr($IDCard,6,4));
        $tmonth=intval(substr($IDCard,10,2));
        $tday=intval(substr($IDCard,12,2));
    }
    elseif(strlen($IDCard)==15)
    {
        $tyear=intval("19".substr($IDCard,6,2));
        $tmonth=intval(substr($IDCard,8,2));
        $tday=intval(substr($IDCard,10,2));
    }

        if($format)
        {
            $tdate=$tyear."-".$tmonth."-".$tday;
        }
        else
        {
            $tdate=$tmonth."-".$tday;
        }
    }
    $result['error']=2;//0：未知错误，1：身份证格式错误，2：无错误
    $result['tdate']=$tdate;
    return $result;
    }

    /**
     * @author zhukeqin
     * @return bool
     * 参保提醒
     */
    public function send_personnel_list(){
        $wechatModle=new WechatModel();
        $group_list=M('house_village_group_list')->select();
        foreach ($group_list as $value){
            $personnel_social=$this->personnel_social('',$value['group_id']);
            $personnel_accumulation=$this->personnel_accumulation('',$value['group_id']);
            $personnel_contract=$this->personnel_contract('',$value['group_id']);
            $personnel_recommd=$this->personnel_recommd('',$value['group_id']);
            $admin_list=array(array('openid'=>'ohgcf0nvRzH_W8gJb9eqFKwDucy0'));
            $data = array(
                "first"=>array(
                    "value"=>date('n')."月份人员情况统计提醒",
                    "color"=>"#173177"
                ),
                "keyword1"=>array(
                    "value"=>$value['group_name'],
                    "color"=>"#173177"
                ),
                "keyword2"=>array(
                    "value"=>date('Y年m月d日 H:i'),
                    "color"=>"#173177"
                ),
                "keyword3"=>array(
                    "value"=>'社保待缴'.count($personnel_social).'人，公积金待缴'.count($personnel_accumulation).'人，合同即将到期'.count($personnel_contract).',介绍奖励'.count($personnel_recommd).'人',
                    "color"=>"#173177"
                ),
                "remark"=>array(
                    "value"=>'点击查看详情',
                    "color"=>"#173177"
                ),
            );
            $tpl_id='SsUpKhlg63beYfsObEi4P-1DrwQIN5wXUykYLHSrAu8';
            $url='http://www.hdhsmart.com/wap.php?g=Wap&c=Personnel&a=personnel_list';
            foreach ($admin_list as $value){
                $res = $wechatModle->send_tpl_message($value['openid'],$tpl_id,$url,$data);
            }
        }




            /*dump($wechatModle->send_kf_text($value['openid'],$text));
            dump($wechatModle->getErrMsg());*/
        return true;
    }
    /**
     * @author zhukeqin
     * 参保人员列表
     */
    public function personnel_social($time,$group_id=''){
        $now=$time?strtotime($time):time();
        $thismonth_start=strtotime(date('Y-m',$now));//本月开始时间
        $thismonth_end=strtotime(date('Y-m-t',$now))+24*3600-1;//本月结束时间
        $departmentModel=new DepartmentModel();
        $where_data=array('status'=>1);
        if(!empty($group_id)) $where_data['group_id']=$group_id;
        $where_data['social_addtime']=array('BETWEEN',array($thismonth_start,$thismonth_end)) ;
        $personnel_list=$this->get_personnel_list($where_data);
        foreach ($personnel_list as $key=>$value){
            $personnel_list[$key]['department_name']=$this->get_department_name($value['department_id']);
            /*if(!empty($group_id)){
                $department_info=$departmentModel->get_department_village($value['department_id']);
                if($department_info['group_id']!=$group_id) unset($personnel_list[$key]);
            }*/
        }
        /*$this->assign('personnel_list',$personnel_list);
        $this->display();*/
        return $personnel_list;
    }

    /**
     * @author zhukeqin
     * 公积金列表
     */
    public function personnel_accumulation($time,$group_id=''){
        $now=$time?strtotime($time):time();
        $thismonth_start=strtotime(date('Y-m',$now));//本月开始时间
        $thismonth_end=strtotime(date('Y-m-t',$now))+24*3600-1;//本月结束时间
        $departmentModel=new DepartmentModel();
        $where_data=array('status'=>1);
        if(!empty($group_id)) $where_data['group_id']=$group_id;
        $where_data['accumulation_addtime']=array('BETWEEN',array($thismonth_start,$thismonth_end)) ;
        $personnel_list=$this->get_personnel_list($where_data);
        foreach ($personnel_list as $key=>$value){
            $personnel_list[$key]['department_name']=$this->get_department_name($value['department_id']);
            /*if(!empty($group_id)){
                $department_info=$departmentModel->get_department_village($value['department_id']);
                if($department_info['group_id']!=$group_id) unset($personnel_list[$key]);
            }*/
        }
        /*$this->assign('personnel_list',$personnel_list);
        $this->display();*/
        return $personnel_list;
    }

    /**
     * @author zhukeqin
     * 合同到期列表
     */
    public function personnel_contract($time,$group_id=''){
        $now=$time?strtotime($time):time();
        $thismonth_start=strtotime(date('Y-m',$now));//本月开始时间
        $thismonth_end=strtotime(date('Y-m-t',$now))+24*3600-1;//本月结束时间
        $departmentModel=new DepartmentModel();
        $where_data=array('p.status'=>1);
        if(!empty($group_id)) $where_data['p.group_id']=$group_id;
        $where_data['pc.time_end']=array('BETWEEN',array($thismonth_start,$thismonth_end)) ;
        $personnel_list=$this->alias('p')
            ->field('p.*,pc.time_end,pc.time_start')
            ->join('left join __PERSONNEL_CONTRACT_NOREPEAT__ pc on pc.personnel_id=p.personnel_id ')
            ->where($where_data)
            ->select();
        foreach ($personnel_list as $key=>$value){
            $personnel_list[$key]['department_name']=$this->get_department_name($value['department_id']);
            /*if(!empty($group_id)){
                $department_info=$departmentModel->get_department_village($value['department_id']);
                if($department_info['group_id']!=$group_id) unset($personnel_list[$key]);
            }*/
        }
        /*$this->assign('personnel_list',$personnel_list);
        $this->display();*/
        return $personnel_list;
    }
    /**
     * @author zhukeqin
     * 入职推荐提醒列表
     */
    public function personnel_recommd($time,$group_id=''){
        $now=$time?strtotime($time):time();
        $thismonth_start=strtotime(date('Y-m',$now));//本月开始时间
        $thismonth_end=strtotime(date('Y-m-t',$now))+24*3600-1;//本月结束时间
        $departmentModel=new DepartmentModel();
        $personnel_positionModel=new Personnel_positionModel();
        $where_data['status']=1;
        $where_data['entry_time']=array('egt',strtotime('-7 month'));
        $where_data['_string']='trim(induction_channel) !=""';
        if(!empty($group_id)) $where_data['group_id']=$group_id;
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
                    $personnel_list[$key]['induction_info']=$this->get_personnel_one(array('name'=>$personnel_list[$key]['induction_name']));
                    $personnel_list[$key]['induction_info']['department_name']=$this->get_department_name(array('name'=>$personnel_list[$key]['induction_info']['department_id']));
                }
                /*if(!empty($group_id)){
                    $department_info=$departmentModel->get_department_village($value['department_id']);
                    if($department_info['group_id']!=$group_id) unset($personnel_list[$key]);
                }*/
            }else{
                unset($personnel_list[$key]);
            }
        }
        /*$this->assign('personnel_list',$personnel_list);
        $this->display();*/
        return $personnel_list;
    }

    /**
     * @author zhukeqin
     * @param $department_id
     * @param string $model 所要获取字段
     * @return mixed
     * 获取部门名称
     */
    public function get_department_name($department_id,$model='deptname'){
        $departmentModel=new DepartmentModel();
        $department_info=$departmentModel->get_department_one(array('id'=>$department_id));
        $path_list=explode(',',$department_info['path']);
        if(empty($path_list['4'])) $path_list['4']=$department_info['id'];
        if($department_info['pid']=='89') $path_list['4']=$department_info['pid'];//邻钱科技单独处理
        $department_info_one=$departmentModel->get_department_one(array('id'=>$path_list['4']));
        if(empty($model)){
            $return=$department_info_one;
        }else{
            $return=$department_info_one[$model];
        }
        return $return;
    }
}