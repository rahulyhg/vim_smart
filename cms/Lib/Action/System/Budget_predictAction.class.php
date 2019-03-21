<?php
/**
 * Created by PhpStorm.
 * User: zhukeqin
 * Date: 2018/12/10
 * Time: 14:22
 */
class Budget_predictAction extends BaseAction{
    function __construct()
    {
        parent::__construct();
        $this->village_id = $_SESSION['system']['village_id'];
        $this->project_id=$_SESSION['project_id'];
        if($this->village_id==86){
            $this->village_id=7;
            $this->project_id=7;
        }//虚构项目，默认关联紫阳之星

        $this->village_info=M('house_village')->where(array('village_id'=>$this->village_id))->find();
        $this->department_info=M('department')->where(array('id'=>$this->village_info['department_id'],'budget_type'=>1))->find();

        $this->role_id=explode(',',$_SESSION['system']['role_id']);
        $this->admin_id=$_SESSION['system']['id'];
        $this->role_list=M('role')->where(array('role_id'=>array('IN',$_SESSION['system']['role_id'])))->select();
        //预设管理员id
        $this->is_finance_1=array(429);//预算会计
        $this->is_finance_2=array(81,273,1);//财务总监
        //判断是否是财务 zhukeqin
        $this->is_finance=0;

        if(in_array('86',$this->role_id)||in_array('99',$this->role_id)) $this->is_finance=4;//分公司总经理
        if(in_array($this->admin_id,$this->is_finance_1)) $this->is_finance=1;
        if(in_array('98',$this->role_id)) $this->is_finance=2;//集团预算分管领导
        if(in_array($this->admin_id,$this->is_finance_2)) $this->is_finance=3;

        if(!empty($_GET['is_set'])) $this->is_finance=$_SESSION['Budget_predict']['is_finance']=$_GET['is_set'];
        if(!empty($_SESSION['Budget_predict']['is_finance'])) $this->is_finance=$_SESSION['Budget_predict']['is_finance'];
        //if($this->is_finance==4)$this->is_finance=0;
        $this->assign('is_finance',$this->is_finance);

        $this->status_list=array(
            '1'=>'仅保存，未提交',
            '2'=>'已提交，待分公司经理审核',
            '3'=>'已提交，待预算会计审核',
            '4'=>'已提交，待预算分管领导审核',
            '5'=>'已提交，待分管执行总裁审核',
            '6'=>'审核通过',
            '7'=>'驳回'
        );

        //邻钱科技
        if($this->village_info['department_id']==89){
            $this->department_child_list=array(
                '1'=>array('name'=>'公司经理','type'=>1),
                '2'=>array('name'=>'技术部','type'=>1),
                '3'=>array('name'=>'运营部','type'=>1),
            );
        }elseif($this->village_info['department_id']==51){
            $this->department_child_list=array(
                '11'=>array('name'=>'管理部门','type'=>1,'children'=>array('编制公司总经理')),
                '1'=>array('name'=>'项目经理','type'=>1,'children'=>array('项目经理')),
                '2'=>array('name'=>'客服部','type'=>1,'children'=>array('经理','主管','领班','专员','助理')),
                '3'=>array('name'=>'工程部','type'=>1,'children'=>array('经理','主管','领班','技师','技工')),
                '4'=>array('name'=>'秩序维护部','type'=>1,'children'=>array('经理','主管','班长','秩序形象岗','秩序员')),
                '8'=>array('name'=>'保洁部','type'=>1,'children'=>array('主管','领班','保洁员')),
                '12'=>array('name'=>'其它','type'=>1),
                '5'=>array('name'=>'保洁部（外派）','type'=>2),
                '6'=>array('name'=>'食堂','type'=>2),
                '7'=>array('name'=>'后勤','type'=>2),
                '9'=>array('name'=>'司机','type'=>2),
                '10'=>array('name'=>'其它','type'=>2),
            );
        }else{
            $this->department_child_list=array(
                '1'=>array('name'=>'项目经理','type'=>1,'children'=>array('项目经理')),
                '2'=>array('name'=>'客服部','type'=>1,'children'=>array('经理','主管','领班','专员','助理')),
                '3'=>array('name'=>'工程部','type'=>1,'children'=>array('经理','主管','领班','技师','技工')),
                '4'=>array('name'=>'秩序维护部','type'=>1,'children'=>array('经理','主管','班长','秩序形象岗','秩序员')),
                '8'=>array('name'=>'保洁部','type'=>1,'children'=>array('主管','领班','保洁员')),
                '12'=>array('name'=>'其它','type'=>1),
                '5'=>array('name'=>'保洁部（外派）','type'=>2),
                '6'=>array('name'=>'食堂','type'=>2),
                '7'=>array('name'=>'后勤','type'=>2),
                '9'=>array('name'=>'司机','type'=>2),
                '10'=>array('name'=>'其它','type'=>2),
            );
        }
        $this->assign('department_child_list',$this->department_child_list);
    }

    /**
     * @author zhukeqin
     * 判断入口
     */
    public function predict_in(){
        //预算领导及集团领导特殊处理
        if(($this->is_finance!=0&&$this->is_finance!=4)||in_array(101,$this->role_id)){
            echo 1;die;
            $this->check_predict_list();
        }else{
            $this->village_predict_list();
        }
    }

    /**
     * @author zhukeqin
     * 财务、总经理等管理
     */
    public function check_predict_list(){
        $breadcrumb_diy = array(
            array('全部列表',U('predict_in')),
        );
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $status_list=array(
            '3'=>array('1'=>array(5),'2'=>array(6),'3'=>array(7)),
            '2'=>array('1'=>array(4),'2'=>array(5,6),'3'=>array(7)),
            '1'=>array('1'=>array(3),'2'=>array(4,5,6),'3'=>array(7)),
        );

        $predictModel=new Budget_predictModel();
        if(!empty($_POST['year'])){
            $year=$_SESSION['year']=$_POST['year'];
        }elseif(!empty($_SESSION['Budget_predict']['year'])){
            $year=$_SESSION['Budget_predict']['year'];
        }else{
            $year=$_SESSION['Budget_predict']['year']=date('Y');
        }
        if(!empty($_POST['predict_status'])){
            $status=$_SESSION['Budget_predict']['predict_status']=$_POST['predict_status'];
        }elseif(!empty($_SESSION['Budget_predict']['predict_status'])){
            $status=$_SESSION['Budget_predict']['predict_status'];
        }else{
            $status=$_SESSION['Budget_predict']['predict_status']=4;
        }
        if(!empty($_POST['company_id'])){
            $company_id=$_SESSION['Budget_predict']['company_id']=$_POST['company_id'];
        }elseif(!empty($_SESSION['Budget_predict']['company_id'])){
            $company_id=$_SESSION['Budget_predict']['company_id'];
        }else{
            $company_id=$_SESSION['Budget_predict']['company_id']=1;
        }
        $where=array('year',$year);
        if($status!=4){
            $where['status']=array('IN',$status_list[$this->is_finance][$status]);
        }
        if($company_id!=1){
            $where['company_id']=$company_id;
        }
        $predict_list=$predictModel->get_predict_list($where);
        foreach ($predict_list as &$value){
            $value['village_name']=M('house_village')->where(array('village_id'=>$value['village_id']))->find()['village_name'];
            if(!empty($value['project_id'])){
                $project_list=M('house_village_project')->where(array('village_id'=>$value['village_id']))->select();
                if(count($project_list)>1){
                    $value['village_name'] .='-'.M('house_village_project')->where(array('pigcms_id'=>$value['project_id']))->find()['desc'];
                }
            }
            $value['company_name']=M('department')->where(array('id'=>$value['company_id']))->find()['deptname'];
            $value['status_name']=$this->status_list[$value['status']];
            $admin_info=M('admin')->where(array('id'=>$value['admin_id']))->find();
            $value['admin_name']=$admin_info['realname']?:$admin_info['account'];
            $check_admin_info=M('admin')->where(array('id'=>$value['check_admin_id']))->find();
            $value['check_admin_name']=$check_admin_info['realname']?:$check_admin_info['account'];
        }
        $this->assign('predict_list',$predict_list);
        $this->assign('predict_status',$status);
        $this->assign('year',$year);
        $this->assign('company_id',$company_id);

        $company_list=M('department')->where(array('budget_type'=>1))->select();
        $this->assign('company_list',$company_list);

        //可做操作权限数组
        $action_list=array(
            '1'=>array('status'=>array(3)),
            '2'=>array('status'=>array(4)),
            '3'=>array('status'=>array(5,6)),
            '4'=>array('status'=>array(2)),
        );
        //判断id为刘总时，隐藏导出按钮
        if($this->admin_id == '268') {
            $this->assign('isLiu',true);
        }
        $this->assign('action_now',$action_list[$this->is_finance]);
        $this->display('check_predict_list');
    }

    public function village_predict_list(){
        $breadcrumb_diy = array(
            array('全部列表',U('predict_in')),
        );
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        //分公司总经理做额外判断
        if($this->is_finance==4){
            $status_list=array(
                '1'=>array(1,7),
                '2'=>array(2),
                '3'=>array(6),
            );
        }else{
            $status_list=array(
                '1'=>array(1,7),
                '2'=>array(2,3,4,5),
                '3'=>array(6),
            );
        }


        if(!empty($_POST['predict_status'])){
            $status=$_SESSION['Budget_predict']['predict_status']=$_POST['predict_status'];
        }elseif(!empty($_SESSION['Budget_predict']['predict_status'])){
            $status=$_SESSION['Budget_predict']['predict_status'];
        }else{
            $status=$_SESSION['Budget_predict']['predict_status']=4;
        }

        $predictModel=new Budget_predictModel();
        //分公司总经理判断
        if($this->is_finance==4){
            //获取当前分公司用户信息
            $admin_info=M('admin')->where(array('id'=>$this->admin_id))->find();
            $village_list=explode(',',$admin_info['village_id_list']);
            $village_list[]=$admin_info['village_id'];
            $village_list=M('house_village')->where(array('village_id'=>array('IN',$village_list)))->group('department_id')->select();
            $department_list=array();
            foreach ($village_list as $value){
                $department_list[]=$value['department_id'];
            }
            $where['company_id']=array('IN',$department_list);
        }else{
            $where=array('village_id'=>$this->village_id);
            if(!empty($this->project_id)) $where['project_id']=$this->project_id;
        }
        if($status!=4){
            $where['status']=array('IN',$status_list[$status]);
        }
        $predict_list=$predictModel->get_predict_list($where);
        foreach ($predict_list as &$value){
            $value['village_name']=M('house_village')->where(array('village_id'=>$value['village_id']))->find()['village_name'];
            if(!empty($value['project_id'])){
                $project_list=M('house_village_project')->where(array('village_id'=>$value['village_id']))->select();
                if(count($project_list)>1){
                    $value['village_name'] .='-'.M('house_village_project')->where(array('pigcms_id'=>$value['project_id']))->find()['desc'];
                }
            }
            $value['company_name']=M('department')->where(array('id'=>$value['company_id']))->find()['deptname'];
            $value['status_name']=$this->status_list[$value['status']];
            $admin_info=M('admin')->where(array('id'=>$value['admin_id']))->find();
            $value['admin_name']=$admin_info['realname']?:$admin_info['account'];
            $check_admin_info=M('admin')->where(array('id'=>$value['check_admin_id']))->find();
            $value['check_admin_name']=$check_admin_info['realname']?:$check_admin_info['account'];
        }
        $this->assign('predict_list',$predict_list);
        $this->assign('predict_status',$status);
        $this->display('village_predict_list');
    }


    /**
     * @author zhukeqin
     * 修改一条信息
     */
    public function edit_predict_one(){
        $breadcrumb_diy = array(
            array('全部列表',U('predict_in')),
            array('修改条目详情','#')
        );
        $this->assign('breadcrumb',$breadcrumb_diy);
        $status_list=array(
            '0'=>array('1','7'),
            '1'=>array('3'),
            '2'=>array('4'),
            '3'=>array('5'),
            '4'=>array('1','2','7')
        );

        $breadcrumb_diy = array(
            array('全部列表',U('village_record_list_news')),
            array('填写类目','#')
        );
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $budget_logModel=new Budget_logModel();
        $budget_predictModel=new Budget_predictModel();
        $budget_typeModel=new Budget_typeModel();
        $budget_configModel=new Budget_predict_configModel();
        if(empty($_GET['id'])){
            $year=$_GET['year']?:date('Y');//默认年份为当年
            $last_year=$year-1;
            $last_last_year=$year-2;
            $where=array('village_id'=>$this->village_id,'year'=>$year);
            if(!empty($this->project_id)) $where['project_id']=$this->project_id;
            $predict_info=$budget_predictModel->get_predict_one($where);
            if(!empty($predict_info['predict_id'])) $this->error('该项目当前年份已有预算条目，请不要重复新建',U('predict_in'),'1');
            /*dump(M()->_sql());
            die;*/
        }else{
            $predict_id=$_GET['id'];
            $predict_info=$budget_predictModel->get_predict_one(array('predict_id'=>$predict_id));
            if(empty($predict_info['predict_id'])) $this->error('所选条目不存在,请重试');
            if(!in_array($predict_info['status'],$status_list[$this->is_finance])) $this->error('当前状态您暂时不能修改',U('predict_in'),'1');
            $this->set_department_list($predict_info['village_id'],$predict_info['project_id']);//设置部门
            $year=$predict_info['year'];//默认年份为下一年
            $last_year=$year-1;
            $last_last_year=$year-2;
        }
        //获取部门列表
        $department_child_list=$this->department_child_list;
        $department_paiqian_list=array(

        );
        $this->assign('department_child_list',$department_child_list);
        $this->assign('village_info',$this->village_info);


        $property_list=array(
            '1'=>'写字楼',
            '2'=>'住宅'
        );
        $this->assign('property_list',$property_list);

        $proportion=array(
            '1'=>array('last'=>'95','now'=>'95'),
            '2'=>array('last'=>'70','now'=>'90'),
        );
        $this->assign('proportion',$proportion);
        if(IS_POST){
            $status=$_POST['status'];
            $remark=$_POST['remark'];
            $data=$_POST['data'];
            $overtime_type=$_POST['overtime_type'];
            if(empty($status)) $this->error('状态提交不正确，请重试');
            $re=$budget_predictModel->change_predict_one($data,$_SESSION['system']['id'],$this->village_id,$this->project_id,$year,$predict_id,$overtime_type);
            if(empty($predict_id)) $predict_id=$re['data'];
            $predict_info=$budget_predictModel->get_predict_one(array('predict_id'=>$predict_id));
            if($re['err']==0){
                if($status==$predict_info['status']&&$remark==$predict_info['remark']){
                    $this->success('提交成功,即将前往预览',U('watch_predict_one',array('id'=>$re['data'])));
                }else{
                    $re1=$budget_predictModel->change_predict_status($predict_id,$status,$remark,$this->is_finance);
                    if($re1['err']==0){
                        $this->success('提交成功,即将前往预览',U('watch_predict_one',array('id'=>$re['data'])),1);
                    }else{
                        $this->error($re1['data']);
                    }
                }

            }else{
                $this->error($re['data']);
            }
        }else{
            $type_first_list=$budget_typeModel->get_type_list(array('type_fid'=>0,'company_id'=>$this->village_info['department_id']));
            $data_type=array();
            foreach ($type_first_list as $value){
                $data_type[$value['type_id']]['info']=$value;
                $type_second_list=$budget_typeModel->get_type_list(array('type_fid'=>$value['type_id'],'company_id'=>$this->village_info['department_id']));
                foreach ($type_second_list as $value1){
                    $data_type[$value['type_id']]['children'][$value1['type_id']]['children']=$budget_typeModel->get_type_list(array('type_fid'=>$value1['type_id'],'company_id'=>$this->village_info['department_id']));
                    $data_type[$value['type_id']]['children'][$value1['type_id']]['type_name']=$value1['type_name'];
                    $data_type[$value['type_id']]['children'][$value1['type_id']]['type_id']=$value1['type_id'];
                }
                $data_type[$value['type_id']]['data']=$predict_info['data'][$value['type_id']];
                $data_type[$value['type_id']]['last_data']=$budget_logModel->get_excel_log_type($value['type_id'],$this->village_id,$this->project_id,'',$last_year);
                $data_type[$value['type_id']]['last_last_data']=$budget_logModel->get_excel_log_type($value['type_id'],$this->village_id,$this->project_id,'',$last_last_year);
            }
            if(empty($predict_info['overtime_type'])){
                $config_info=$budget_configModel->get_config_one('overtime_type','',$this->village_id,$this->project_id);
                $predict_info['overtime_type']=$config_info['config_num']?:1;
            }
            //个人福利费配置
            $salary_config=array('month_5'=>7.5,'month_6'=>2.5);
            if(in_array($this->village_id,array(15,33))){
                $salary_config=array('month_5'=>0,'month_6'=>0);
            }
            $this->assign('salary_config',$salary_config);

            $this->assign('overtime',$predict_info['data']['overtime']);
            $this->assign('property',$predict_info['data']['property']);
            $this->assign('dispatch',$predict_info['data']['dispatch']);
            $this->assign('clothesfee',$predict_info['data']['clothesfee']);
            $this->assign('zichan',$predict_info['data']['zichan']);
            $this->assign('yunxing',$predict_info['data']['yunxing']);
            $this->assign('gongling',$predict_info['data']['gongling']);
            $this->assign('year',$year);
            $this->assign('data_type',$data_type);
            $this->assign('predict_info',$predict_info);
            $this->display();
        }

    }
    //查看预算编制详情
    public function watch_predict_one(){
        $breadcrumb_diy = array(
            array('全部列表',U('predict_in')),
            array('查看条目详情','#')
        );

        //判断id为刘总时，隐藏导出按钮
        if($this->admin_id == '268') {
            $this->assign('isLiu',true);
        }
        $this->assign('breadcrumb',$breadcrumb_diy);
        $budget_logModel=new Budget_logModel();
        $budget_predictModel=new Budget_predictModel();
        $budget_typeModel=new Budget_typeModel();
        if(empty($_GET['id'])){
            $this->error('参数错误,请重试',U('predict_in'),'1');
        }else{
            $predict_id=$_GET['id'];
            $predict_info=$budget_predictModel->get_predict_one(array('predict_id'=>$predict_id));
            if(empty($predict_info)) $this->error('所选条目不存在,请重试',U('predict_in'),'1');
            $this->set_department_list($predict_info['village_id'],$predict_info['project_id']);//设置部门
            $year=$predict_info['year'];//默认年份为下一年
            $last_year=$year-1;
            $last_last_year=$year-2;
        }
        //部门列表
        $department_child_list=$this->department_child_list;
        $this->assign('department_child_list',$department_child_list);
        $this->assign('village_info',$this->village_info);


        $property_list=array(
            '1'=>'写字楼',
            '2'=>'住宅'
        );
        $this->assign('property_list',$property_list);

        $proportion=array(
            '1'=>array('last'=>'95','now'=>'95'),
            '2'=>array('last'=>'70','now'=>'90'),
        );
        $this->assign('proportion',$proportion);
        if(IS_POST){
            $re=$budget_predictModel->change_predict_status($predict_id,$_POST['status'],$_POST['remark'],$this->is_finance);
            if($re['err']==0){
                $this->success('审核成功！',U('predict_in'));
            }else{
                $this->error($re['data']);
            }
        }else{
            $type_first_list=$budget_typeModel->get_type_list(array('type_fid'=>0,'company_id'=>$this->village_info['department_id']));
            $data_type=array();
            foreach ($type_first_list as $value){
                $data_type[$value['type_id']]['info']=$value;
                $type_second_list=$budget_typeModel->get_type_list(array('type_fid'=>$value['type_id'],'company_id'=>$this->village_info['department_id']));
                foreach ($type_second_list as $value1){
                    $data_type[$value['type_id']]['children'][$value1['type_id']]['children']=$budget_typeModel->get_type_list(array('type_fid'=>$value1['type_id'],'company_id'=>$this->village_info['department_id']));
                    $data_type[$value['type_id']]['children'][$value1['type_id']]['type_name']=$value1['type_name'];
                    $data_type[$value['type_id']]['children'][$value1['type_id']]['type_id']=$value1['type_id'];
                }
                $data_type[$value['type_id']]['data']=$predict_info['data'][$value['type_id']];
                $data_type[$value['type_id']]['last_data']=$budget_logModel->get_excel_log_type($value['type_id'],$this->village_id,$this->project_id,'',$last_year);
                $data_type[$value['type_id']]['last_last_data']=$budget_logModel->get_excel_log_type($value['type_id'],$this->village_id,$this->project_id,'',$last_last_year);
            }
            $this->assign('overtime',$predict_info['data']['overtime']);
            $this->assign('property',$predict_info['data']['property']);
            $this->assign('dispatch',$predict_info['data']['dispatch']);
            $this->assign('clothesfee',$predict_info['data']['clothesfee']);
            $this->assign('zichan',$predict_info['data']['zichan']);
            $this->assign('yunxing',$predict_info['data']['yunxing']);
            $this->assign('gongling',$predict_info['data']['gongling']);
            $this->assign('year',$year);
            $this->assign('data_type',$data_type);
            $this->assign('sum',$predict_info['sum']);
            $this->assign('predict_info',$predict_info);
            $log_sum['last']=D('Budget_log')->get_excel_log_sum($this->village_id,$this->project_id,$this->village_info['department_id'],$last_year);
            $log_sum['last_last']=D('Budget_log')->get_excel_log_sum($this->village_id,$this->project_id,$this->village_info['department_id'],$last_last_year);
            $this->assign('log_sum',$log_sum);
            $this->assign('predict_all',$budget_predictModel->get_predict_all($predict_info['sum'],$predict_info['village_id'],$predict_info['project_id'],$predict_info['company_id']));

            //获取历史备注
            $predict_logModel=new Budget_predict_logModel();
            $predict_log=$predict_logModel->get_log_list($predict_id);
            foreach ($predict_log as $key=>$value){
                    $predict_log[$key]=$this->get_flow_info($value['admin_id'],$value['remark'],$value['updatetime']);
                    if($predict_log[$key]['admin_role_name']=='发起人' || empty($predict_log[$key]['admin_role_name'])){
                        unset($predict_log[$key]);
                    }
            }
            if(!empty($predict_info['check_admin_id'])&&$predict_info['status']!=2){
                $predict_log[]=$this->get_flow_info($predict_info['check_admin_id'],$predict_info['remark'],$predict_info['checktime']);
            }
            array_unshift($predict_log,$this->get_flow_info($predict_info['admin_id'],'',$predict_info['updatetime']));
            /*if($predict_id==39){
                dump($predict_log);
            }*/
            $this->assign('predict_log',$predict_log);

            $return_action=array(
                '1'=>array('status'=>1,'name'=>'退回项目'),
                '2'=>array('status'=>2,'name'=>'退回分公司经理'),
                '3'=>array('status'=>3,'name'=>'退回预算会计'),
                '4'=>array('status'=>4,'name'=>'退回预算分管领导'),
                '5'=>array('status'=>4,'name'=>'退回分管执行总裁'),
            );
            //可做操作权限数组
            $action_list=array(
                '1'=>array('status'=>3,'next'=>array('status'=>4,'name'=>'审核通过，转交预算分管领导'),'return'=>array($return_action['1'],$return_action['2'])),
                '2'=>array('status'=>4,'next'=>array('status'=>5,'name'=>'审核通过，转交分管执行总裁'),'return'=>array($return_action['1'],$return_action['2'],$return_action['3'])),
                '3'=>array('status'=>5,'next'=>array('status'=>6,'name'=>'审核通过,办结'),'return'=>array($return_action['1'],$return_action['2'],$return_action['3'],$return_action['4'])),
                '4'=>array('status'=>2,'next'=>array('status'=>3,'name'=>'审核通过，转交预算会计'),'return'=>array($return_action['1'])),
            );
            if($predict_info['status']==6) $action_list['3']=array('status'=>6,'next'=>'','return'=>array($return_action['1'],$return_action['2'],$return_action['3'],$return_action['4'],$return_action['5']));
            $this->assign('action_now',$action_list[$this->is_finance]);
            //设置标题
            $title1 =$this->village_info['village_name'];
            if(!empty($predict_info['project_id'])){
                $title1 .='-'.M('house_village_project')->where(array('pigcms_id'=>$predict_info['project_id']))->find()['desc'];
            }
            $this->assign('title1',$title1);
            
            $this->display();
        }
    }

    /**
     * @author zhukeqin
     * 审核单条记录
     */
    public function check_predict_one(){
        $budget_predictModel=new Budget_predictModel();
        $predict_id=$_GET['id'];
        $predict_info=$budget_predictModel->get_predict_one(array('predict_id'=>$predict_id));
        if(empty($predict_info)) $this->error('所选条目不存在,请重试',U('predict_in'),'1');
        if(IS_POST){
            $re=$budget_predictModel->change_predict_status($predict_id,$_POST['status'],$_POST['remark'],$this->is_finance);
            if($re['err']==0){
                $this->success('审核成功！',U('predict_in'));
            }else{
                $this->error($re['data']);
            }
        }else{
            $return_action=array(
                '1'=>array('status'=>1,'name'=>'退回项目'),
                '2'=>array('status'=>2,'name'=>'退回分公司经理'),
                '3'=>array('status'=>3,'name'=>'退回预算会计'),
                '4'=>array('status'=>4,'name'=>'退回预算分管领导'),
                '5'=>array('status'=>5,'name'=>'退回分管执行总裁'),
            );
            //可做操作权限数组
            $action_list=array(
                '1'=>array('status'=>3,'next'=>array('status'=>4,'name'=>'审核通过，转交预算分管领导'),'return'=>array($return_action['1'],$return_action['2'])),
                '2'=>array('status'=>4,'next'=>array('status'=>5,'name'=>'审核通过，转交分管执行总裁'),'return'=>array($return_action['1'],$return_action['2'],$return_action['3'])),
                '3'=>array('status'=>5,'next'=>array('status'=>6,'name'=>'审核通过,办结'),'return'=>array($return_action['1'],$return_action['2'],$return_action['3'],$return_action['4'])),
                '4'=>array('status'=>2,'next'=>array('status'=>3,'name'=>'审核通过，转交预算会计'),'return'=>array($return_action['1'])),
            );
            if($predict_info['status']==6) $action_list['3']=array('status'=>6,'next'=>'','return'=>array($return_action['1'],$return_action['2'],$return_action['3'],$return_action['4'],$return_action['5']));
            $this->assign('action_now',$action_list[$this->is_finance]);
            $this->assign('predict_info',$predict_info);
            $this->display();
        }
    }
    public function apply_predict_one(){
        $predict_id=$_GET['id'];
        $budget_predictModel=new Budget_predictModel();
        $return=$budget_predictModel->apply_predict_one($predict_id);
        if($return['err']==0){
            $this->success('应用成功！');
        }else{
            $this->error($return['data']);
        }
    }

    /**
     * @author zhukeqin
     * 修改/新增一条配置项
     */
    public function edit_config_one(){
        $configModel=new Budget_predict_configModel();
        $id=$_GET['id'];
        $info=$configModel->where(array('predict_config_id'=>$id))->find();
        $info['config_num']=unserialize($info['config_num']);
        if(IS_POST){

        }else{
            //获取所有项目列表  可见的
            $company_list=D('Department')->get_department_list(array('budget_type'=>1));
            $project_list=array();
            foreach ($company_list as $value){
                $project_list[$value['id']]['list']=$this->get_project_list($value['id']);
                $project_list[$value['id']]['deptname']=$value['deptname'];
            }

            $this->assign('info',$info);
            $this->assign('project_list',$project_list);
            $this->assign('project_list_json',json_encode($project_list));
            $this->display();
        }
    }

    /**
     * @author zhukeqin
     * 获取一个或多个公司的合计
     */
    public function watch_company_one(){
        $budget_predictModel=new Budget_predictModel();
        $company_id=$_GET['company_id']?:-2;
        $year=$_GET['year']?:date('Y');
        $company_list=M('department')->where(array('budget_type'=>1))->select();
        $predict_list=array();
        if($company_id==1){//分公司汇总
            foreach ($company_list as $key=>$value){
                if($value['id']!=2&&$value['id']!=89){//排除总部和邻钱科技
                    $predict_list[$key]=array('village_name'=>$value['deptname'],'sum'=>$this->get_company_sum($value['id'],$year));
                }
            }
            $company_info['deptname']='分公司汇总';
            $type_list=$this->get_all_type();
        }elseif($company_id==-2){//集团预算汇总
            foreach ($company_list as $key=>$value){
                $predict_list[$key]=array('village_name'=>$value['deptname'],'sum'=>$this->get_company_sum($value['id'],$year));
            }
            $company_info['deptname']='集团预算汇总';
            $type_list=$this->get_all_type();
        }elseif($company_id==-1){//分公司汇总 所属项目
            foreach ($company_list as $key=>$value){
                if($value['id']==2||$value['id']==89){//排除总部和邻钱科技
                    continue;
                }
                $predict_list[$key]=array('village_name'=>$value['deptname'],'sum'=>$this->get_company_sum($value['id'],$year));
                $project_list=$this->get_project_list($value['id']);
                foreach ($project_list as $key1=>$value1){
                    $value_list=explode('-',$key1);
                    $village_id=$value_list[0];
                    $project_id=$value_list[1];
                    $where=array('village_id'=>$village_id,'year'=>$year);
                    if(!empty($project_id)) $where['project_id']=$project_id;
                    $predict_info=$budget_predictModel->get_predict_one($where);
                    $predict_list[$key]['children'][$key1]=array('village_name'=>$value1,'sum'=>$budget_predictModel->get_predict_all($predict_info['sum'],$predict_info['village_id'],'',$value['id']));
                }
            }
            $company_info['deptname']='分公司和所属项目汇总';
            $type_list=$this->get_all_type();
        }else{
            $project_list=$this->get_project_list($company_id);
            foreach ($project_list as $key=>$value){
                $value_list=explode('-',$key);
                $village_id=$value_list[0];
                $project_id=$value_list[1];
                $where=array('village_id'=>$village_id,'year'=>$year);
                if(!empty($project_id)) $where['project_id']=$project_id;
                $predict_info=$budget_predictModel->get_predict_one($where);
                $predict_list[$key]=array('village_name'=>$value,'sum'=>$budget_predictModel->get_predict_all($predict_info['sum'],$predict_info['village_id'],'',$company_id));
            }
            $company_info=M('department')->where(array('id'=>$company_id))->find();
            $type_list=$predict_list[key($predict_list)]['sum'];
        }

        //dump($predict_list);

        $this->assign('predict_list',$predict_list);
        $this->assign('title1',$company_info['deptname']);
        $this->assign('type_list',$type_list);//第一个key值
        array_unshift($company_list,array('id'=>-1,'deptname'=>'按分公司及项目汇总'));
        array_unshift($company_list,array('id'=>1,'deptname'=>'按分公司汇总'));
        array_unshift($company_list,array('id'=>-2,'deptname'=>'全部汇总'));
        $this->assign('company_list',$company_list);

        $this->assign('year',$year);
        $this->assign('company_id',$company_id);
        if($company_id==-1){//当为全部分公司和所属项目时，切换模板
            $this->display('watch_company_all');
        }else{
            $this->display();
        }
    }

    /**
     * @author zhukeqin
     * @param $company_id
     * @param $year
     * @return array
     * 获取全部部门
     */
    public function get_company_sum($company_id,$year){
        $budget_predictModel=new Budget_predictModel();
        $project_list=$this->get_project_list($company_id);
        $return=array();
        foreach ($project_list as $key=>$value){
            $value_list=explode('-',$key);
            $village_id=$value_list[0];
            $project_id=$value_list[1];
            $where=array('village_id'=>$village_id,'year'=>$year);
            if(!empty($project_id)) $where['project_id']=$project_id;
            $predict_info=$budget_predictModel->get_predict_one($where);
            $predict_info=$budget_predictModel->get_predict_all($predict_info['sum'],$predict_info['village_id'],'',$company_id);
            foreach ($predict_info['input'] as $key1=>$value1){
                if($key1!='sum_sum'){
                    foreach ($value1['children'] as $key2=>$value2){
                        $return['input'][$key1]['children'][$key2]['sum_sum'] +=$value2['sum_sum'];
                    }
                }else{
                    $return['input']['sum_sum'] +=$value1;
                }

            }
            foreach ($predict_info['output'] as $key1=>$value1){
                if($key1!='sum_sum') {
                    foreach ($value1['children'] as $key2 => $value2) {
                        $return['output'][$key1]['children'][$key2]['sum_sum'] += $value2['sum_sum'];
                    }
                    $return['output'][$key1]['sum_sum']+=$value1['sum_sum'];
                }else{
                    $return['output']['sum_sum'] +=$value1;
                }
            }
            $return['sum']['sum_sum'] +=$predict_info['sum']['sum_sum'];
        }
        return $return;

    }
    /**
     * @author zhukeqin
     * @param $company_id
     * @return array
     * 获取某一公司所属的所有项目
     */
    public function get_project_list($company_id){
        //获取所有项目列表
        $village_list=D('House_village')->get_village_tree(array('department_id'=>$company_id));
        $project_list=array();
        foreach ($village_list as $key=>$value){
            $cache=M('house_village_project')->where(array('village_id'=>$key))->select();
            if(empty($cache)){
                $project_list[$key]=$value;
            }else{
                foreach ($cache as $key1=>$value1){
                    $project_list[$key.'-'.$value1['pigcms_id']]=$value.'-'.$value1['desc'];
                }
            }
        }
        return $project_list;
    }

    /**
     * @author zhukeqin
     * @return array
     * 获取全部分公司汇总
     */
    public function get_all_type(){
        $where=array('type_fid'=>0);
        $type_first_list=D('Budget_type')->get_type_list($where);
        $type_list=array();
        foreach ($type_first_list as $key=>$value){
            unset($cache);
            $cache['type_name']=$value['type_name'];
            $cache['type_remark']=$value['type_remark'];
            $where['type_fid']=$value['type_id'];
            $type_second_list=D('Budget_type')->get_type_list($where);
            if($value['type_id']==1){
                foreach ($type_second_list as $key1=>$value1){
                    $cache['children'][$value1['type_name']]['type_name']=$value1['type_name'];
                    $cache['children'][$value1['type_name']]['type_remark']=$value1['type_remark'];
                }
            }else{
                foreach ($type_second_list as $key1=>$value1){
                    $cache['children'][$value1['type_name']]['type_name']=$value1['type_name'];
                    $cache['children'][$value1['type_name']]['type_remark']=$value1['type_remark'];
                }
            }
            if($cache['type_name']=='收入明细') {
                $type_list['input']['1']=$cache;
            }else{
                $type_list['output'][$value['type_id']]=$cache;
            }
        }
        $type_list['output']['4']['type_name']='增值税及附加';
        $type_list['output']['4']['type_remark']='按收入6.3%测算';
        $type_list['output']['4']['children']['增值税及附加']['type_name']='增值税及附加';
        return $type_list;
    }

    /**
     * @author zhukeqin
     * @param $village_id
     * @param $project_id
     * @return bool
     * 设置当前页面的部门
     */
    public function set_department_list($village_id,$project_id){
        $this->village_id=$village_id;
        $this->project_id=$project_id;
        $this->village_info=M('house_village')->where(array('village_id'=>$village_id))->find();
        $display_button=0;
        if($this->admin_id==269&&$this->village_info['department_id']==80){
            $display_button=1;
        }
        if($this->admin_id==359&&($this->village_info['department_id']==82||$this->village_info['department_id']==83)){
            $display_button=1;
        }
        $this->assign('display_button',$display_button);
        
        $this->department_info=M('department')->where(array('id'=>$this->village_info['department_id'],'budget_type'=>1))->find();
        if($this->village_info['department_id']==89){
            $this->department_child_list=array(
                '1'=>array('name'=>'公司经理','type'=>1),
                '2'=>array('name'=>'技术部','type'=>1),
                '3'=>array('name'=>'运营部','type'=>1),
            );
        }elseif($this->village_info['department_id']==51){
            $this->department_child_list=array(
                '11'=>array('name'=>'管理部门','type'=>1,'children'=>array('编制公司总经理')),
                '1'=>array('name'=>'项目经理','type'=>1,'children'=>array('项目经理')),
                '2'=>array('name'=>'客服部','type'=>1,'children'=>array('经理','主管','领班','专员','助理')),
                '3'=>array('name'=>'工程部','type'=>1,'children'=>array('经理','主管','领班','技师','技工')),
                '4'=>array('name'=>'秩序维护部','type'=>1,'children'=>array('经理','主管','班长','秩序形象岗','秩序员')),
                '8'=>array('name'=>'保洁部','type'=>1,'children'=>array('主管','领班','保洁员')),
                '12'=>array('name'=>'其它','type'=>1),
                '5'=>array('name'=>'保洁部（外派）','type'=>2),
                '6'=>array('name'=>'食堂','type'=>2),
                '7'=>array('name'=>'后勤','type'=>2),
                '9'=>array('name'=>'司机','type'=>2),
                '10'=>array('name'=>'其它','type'=>2),
            );
        }else{
            $this->department_child_list=array(
                '1'=>array('name'=>'项目经理','type'=>1,'children'=>array('项目经理')),
                '2'=>array('name'=>'客服部','type'=>1,'children'=>array('经理','主管','领班','专员','助理')),
                '3'=>array('name'=>'工程部','type'=>1,'children'=>array('经理','主管','领班','技师','技工')),
                '4'=>array('name'=>'秩序维护部','type'=>1,'children'=>array('经理','主管','班长','秩序形象岗','秩序员')),
                '8'=>array('name'=>'保洁部','type'=>1,'children'=>array('主管','领班','保洁员')),
                '12'=>array('name'=>'其它','type'=>1),
                '5'=>array('name'=>'保洁部（外派）','type'=>2),
                '6'=>array('name'=>'食堂','type'=>2),
                '7'=>array('name'=>'后勤','type'=>2),
                '9'=>array('name'=>'司机','type'=>2),
                '10'=>array('name'=>'其它','type'=>2),
            );
        }
        $this->assign('department_child_list',$this->department_child_list);
        return true;
    }

    /**
     * @author zhukeqin
     * @param string $admin_id
     * @param $remark
     * @param $updatetime
     * @return array|bool
     * 查找审核流程记录，admin_id必须传入
     */
    public function get_flow_info($admin_id='',$remark,$updatetime){
        if(empty($admin_id)) return false;
        $admin_info=M('admin')->where(array('id'=>$admin_id))->find();
        $now_predict_log=array(
            'admin_name'=>$admin_info['realname']?:$admin_info['account'],
            'remark'=>$remark,
            'updatetime'=>$updatetime,
        );
        $role_list=explode(',',$admin_info['role_id']);
        $admin_role_name=0;
        if(in_array('86',$role_list)) $admin_role_name=3;
        if(in_array('98',$role_list)) $admin_role_name=4;
        if(in_array($admin_id,$this->is_finance_1)) $admin_role_name=1;
        if(in_array($admin_id,$this->is_finance_2)) $admin_role_name=2;
        switch ($admin_role_name){
            case 0:$now_predict_log['admin_role_name']='发起人';break;
            case 1:$now_predict_log['admin_role_name']='预算会计';break;
            case 2:$now_predict_log['admin_role_name']='分管执行总裁';break;
            case 3:$now_predict_log['admin_role_name']='分公司总经理';break;
            case 4:$now_predict_log['admin_role_name']='预算分管领导';break;
        }
        return $now_predict_log;
    }

    public function output_excel_one(){
        if(!empty($_GET['id'])){
            $modal=new Budget_predictModel();
            $modal->output_predict_excel($_GET['id']);
        }else{
            $this->error('请选择条目之后再打印',U('predict_id'),'1');
        }
    }

    public function demo(){
        $budget_predict=new Budget_predictModel();
        dump($budget_predict->apply_predict_one(19));
    }
}