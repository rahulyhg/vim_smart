<?php

/**
 * 预算控制控制器
 * Class BudgetAction
 */
class BudgetAction extends BaseAction
{
    public function __construct()
    {
        parent::__construct();
        $this->village_id = $_SESSION['system']['village_id'];
        $this->village_info=M('house_village')->where(array('village_id'=>$this->village_id))->find();
        $this->department_info=M('department')->where(array('id'=>$this->village_info['department_id'],'budget_type'=>1))->find();
        $this->project_id=$_SESSION['project_id'];
        $this->role_id=explode(',',$_SESSION['system']['role_id']);
        $this->role_list=M('role')->where(array('role_id'=>array('IN',$_SESSION['system']['role_id'])))->select();
        //判断是否是财务 zhukeqin
        $this->is_finance=0;
        foreach ($this->role_list as $value){
            if(strstr($value['role_name'],'预算会计')!==false||strstr($value['role_name'],'分管执行总裁')!==false||strstr($value['role_name'],'集团预算分管领导')!==false){
                $this->is_finance=1;
                break;
            }
        }
        /*$this->is_finance=1;
        foreach ($this->role_list as $value){
            if($value['role_id']==83){
                $this->is_finance=0;
                break;
            }
        }*/
        //判断是否是出纳
        $this->is_cashier=0;
        $role_id=M('role')->where(array('role_name'=>'出纳员'))->find()['role_id'];
        if(in_array($role_id,$this->role_id)){
            $this->is_cashier=1;
            $this->cashier_info=D('Budget_cashier')->get_cashier_one(array('admin_id'=>$_SESSION['system']['id']));
        }
        $this->assign('is_finance',$this->is_finance);
        $this->assign('is_cashier',$this->is_cashier);
       /* if(empty($this->department_info)){
            $this->error('当前项目没有所属部门/公司，无法进行预算的相关操作');
        }*/
    }

    /**
     * @author zhukeqin
     * 财务查看全部账目
     */
    public function check_record_list(){
        if(in_array(101,$this->role_id)){//刘总直接跳转到预算页面
            redirect(U('Budget_predict/watch_company_one'));
        }
        //if(in_array([101],$this->role_id)){//杭总及刘总设置部分按钮隐藏
          //  $this->assign('isLeader',true);
        //}
        //设定检索时间
        if(!empty(I('get.month'))){
            $starttime=strtotime(date('Y-m',strtotime(I('get.month'))));
            $endtime=strtotime(date('Y-m-t',strtotime(I('get.month'))))+24*3600;
        }elseif(!empty(I('get.starttime'))){
            $starttime=strtotime(I('get.starttime'));
            if(!empty(I('get.endtime'))){
                $endtime=strtotime(I('get.endtime'))+24*3600;
            }else{
                $endtime=strtotime(date('Y-m-t',strtotime(I('get.starttime'))))+24*3600;
            }
        }elseif(!empty($_SESSION['record_check_time'])){
            $starttime=$_SESSION['record_check_time']['starttime'];
            $endtime=$_SESSION['record_check_time']['endtime'];
        }else{
            //默认为当前月份
            $starttime=strtotime(date('Y-m'));
            $endtime=strtotime(date('Y-m-t'))+24*3600;
        }
        $_SESSION['record_check_time']=array('starttime'=>$starttime,'endtime'=>$endtime);
        //设定审核情况
        if(!empty(I('get.record_status'))){
            $record_status=$_SESSION['record_status']=I('get.record_status');
        }elseif(!empty($_SESSION['record_status'])){
            $record_status=$_SESSION['record_status'];
        }else{
            $record_status=$_SESSION['record_status']=1;
        }
        $where['record_time']=array('between',array(date('Y-m-d',$starttime),date('Y-m-d',$endtime-3600*24)));
        /*where['record_time']=array('like',$month.'%');*/
        if($record_status!=4){
            $where['record_status']=$record_status;
        }
        //财务通过汇总查看明细筛选
        if(!empty(I('get.company_id'))){
            $where['company_id']=I('get.company_id');
        }elseif(!empty(I('get.village_id_search'))){
            $where['village_id']=I('get.village_id_search');
            if(!empty(I('get.project_id'))) $where['project_id']=I('get.project_id');
        }
        //财务查看  处理当所查看类目为一级 二级 三级等情况
        if(!empty(I('get.type_id'))){
            $type_info=D('Budget_type')->get_type_one(array('type_id'=>I('get.type_id')));
            $type_list=array();
            if($type_info['type_rank']==1){
                $type_list_second=D('Budget_type')->get_type_list(array('type_fid'=>I('get.type_id')));
                foreach ($type_list_second as $k=>$v){
                    $type_list_third=D('Budget_type')->get_type_list(array('type_fid'=>$v['type_id']));
                    foreach ($type_list_third as $k1=>$v1){
                        $type_list[]=$v1['type_id'];
                    }
                }
                $type_id=array('IN',$type_list);
            }elseif($type_info['type_rank']==2){
                $type_list_third=D('Budget_type')->get_type_list(array('type_fid'=>I('get.type_id')));
                foreach ($type_list_third as $k1=>$v1){
                    $type_list[]=$v1['type_id'];
                }
                $type_id=array('IN',$type_list);
            }else{
                $type_id=$type_info['type_id'];
            }
            $where['type_id']=$type_id;
            unset($where['record_time']);
            $where['record_check_time']=array('between',array($starttime,$endtime));
        }
        //出纳员查看
        if($this->is_cashier==1){
            $where['_string']='find_in_set("'.$this->cashier_info['cashier_id'].'",cashier_id)';
        }
        $record_list=D('Budget_record')->get_record_list($where);
        $village_list=D('House_village')->get_village_tree();
        $company_list=D('Department')->get_department_tree();
        $record_status_list=array('1'=>'待审核','2'=>'审核通过','3'=>'驳回');
        foreach ($record_list as &$value){
            $value['village_name']=$village_list[$value['village_id']];
            if(!empty($value['project_id'])){
                $project_name=M('house_village_project')->where(array('pigcms_id'=>$value['project_id']))->find()['desc'];
                $value['village_name'] .='-'.$project_name;
            }
            $value['type_name']=D('Budget_type')->get_type_name($value['type_id'],'1');
            $value['company_name']=$company_list[$value['company_id']];
            $value['record_status_name']=$record_status_list[$value['record_status']];
            //审核人员信息
            if(!empty($value['record_check_id'])){
                $record_check_info=M('admin')->where(array('id'=>$value['record_check_id']))->find();
                $value['record_check_name']=$record_check_info['realname']?:$record_check_info['account'];
            }
            
        }
        //dump($record_list);
        $this->assign('record_list',$record_list);
        $breadcrumb_diy = array(
            array('全部列表',U('check_record_list')),
        );
        $this->assign('starttime',$starttime);
        $this->assign('endtime',$endtime);
        $this->assign('record_status',$record_status);
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $this->assign('table_sort',json_encode(array('3','desc')));
        //判断是否是modal层打开
        if(I('get.modal')==1){
            $this->display('check_record_list_modal');
        }else{
            $this->display('check_record_list');
        }
    }

    /**
     * @author zhukeqin
     * 删除一条条目
     */
    public function check_record_delete(){
        $record_id=I('get.record_id');
        $record_info=D('Budget_record')->get_record_one(array('record_id'=>$record_id));
        if(empty($record_info)) $this->error('您选择条目不存在');
        //if($record_info['record_status']!=3) $this->error('您所选择的条目不为驳回，不能删除');
        $return=D('Budget_record')->check_delete_one($record_id);
        if($return['err']==1){
            $this->error($return['msg']);
        }else{
            $this->success('删除成功');
        }
    }
    /**
     * @author zhukeqin
     * 显示全部类目列表
     */
    public function type_list(){
        $breadcrumb_diy = array(
            array('全部列表',U('village_record_list_news')),
            array('类目列表','#')
        );
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $company_list=D('Department')->get_department_tree(array('budget_type'=>1));
        $type_list=D('Budget_type')->get_type_list_tree();
        //循环获得所属项目
        foreach ($type_list as $k=>$v){
            $type_list[$k]['type_company_name']=implode(',',$this->get_value(explode(',',$v['type_company_id']),$company_list));
            foreach ($v['children'] as $k1=>$v1){
                $type_list[$k]['children'][$k1]['type_company_name']=implode(',',$this->get_value(explode(',',$v1['type_company_id']),$company_list));
                foreach ($v1['children'] as $k2=>$v2){
                    $type_list[$k]['children'][$k1]['children'][$k2]['type_company_name']=implode(',',$this->get_value(explode(',',$v2['type_company_id']),$company_list));
                }
            }
        }
        $this->assign('type_list',$type_list);
        $this->display();
    }
    /**
     * @author zhukeqin
     * 添加/修改类目
     */
    public function add_type(){
        if(IS_POST){
            $data=$_POST;
            $id=I('get.id');
            if(!empty($id)){
                $data['type_id']=$id;
            }
            $return=D('Budget_type')->change_type_one($data);
            if($return){
                $this->error($return);
            }else{
                $this->success('插入/修改成功',U('add_type'));
            }
        }else{
            //导航设置
            $breadcrumb_diy = array(
                array('类目列表',U('type_list')),
                array('添加/修改类目','#'),
            );
            $id=I('get.id');
            if(!empty($id)){
                $type_info=D('Budget_type')->get_type_one(array('type_id'=>$id));
                //dump($type_info);
                $this->assign('type_info',$type_info);
            }
            //获取全部公司
            $company_list=D('Department')->get_department_list(array('budget_type'=>1));
            //获取全部类目
            $type_list=D('Budget_type')->get_type_list(array('type_rank'=>array('neq','3')));
            //$type_list=M('budget_type')->where(array('type_rank'=>array('neq','3')))->select();
            $this->assign('breadcrumb_diy',$breadcrumb_diy);
            $this->assign('company_list',$company_list);
            $this->assign('type_list',json_encode($type_list));
            $this->display();
        }
    }
    /**
     * @author zhukeqin
     * 财务添加收入条目
     */
    public function check_add_record(){
        if(IS_POST){
            $data=$_POST;
            $project_id_change=$data['project_id_change'];
            unset($data['project_id_change']);
            $village_id=explode('-',$project_id_change)['0'];
            $project_id=explode('-',$project_id_change)['1'];
            //更改预算
            if(!empty($data['money_sum'])){
                $money_sum=$data['money_sum'];
                unset($data['money_sum']);
                $company_id=M('house_village')->where(array('village_id'=>$village_id))->find()['department_id'];
                D('Budget_money')->change_money_one($money_sum,$data['type_id'],$village_id,$company_id,'',$project_id);
            }
            if(!empty($_FILES['record_file']['name'])){
                $filepath=D('Budget_record')->upload_file($_FILES['record_file']);
                if(!$filepath) $this->error('附件上传失败，请重试');
                $data['record_file_path']=$filepath;
                $data['record_file_name']=$_FILES['record_file']['name'];
            }
            if(empty($data['type_id'])) $this->error('请选择类目');
            $return=D('Budget_record')->check_add_one($data,$village_id,$project_id);
            if($return){
                $this->error($return);
            }else{
                $this->success('新增收入条目成功',U('check_record_list'));
            }
        }else{
            //导航设置
            $breadcrumb_diy = array(
                array('详情列表',U('check_record_list')),
                array('添加收入条目','#'),
            );
            $this->assign('breadcrumb_diy',$breadcrumb_diy);
            //获取收入列表
            $type_second_list=D('Budget_type')->get_type_list(array('type_fid'=>4));
            $type_list=array();
            foreach ($type_second_list as $value){
                $type_third_list=D('Budget_type')->get_type_list(array('type_fid'=>$value['type_id']));
                foreach ($type_third_list as $value1){
                    $type_list[$value1['type_id']]=$value1['type_name'];
                }
            }
            $this->assign('type_list',$type_list);
            //获取所有项目列表  可见的
            $company_list=D('Department')->get_department_list(array('budget_type'=>1));
            $project_list=array();
            foreach ($company_list as $value){
                $project_list[$value['id']]['list']=$this->get_project_list($value['id']);
                $project_list[$value['id']]['deptname']=$value['deptname'];
            }
            $money_list=D('Budget_type')->get_type_list_tree();
            /*dump($money_list);*/
            $this->assign('project_list',$project_list);
            $this->assign('project_list_json',json_encode($project_list));
            $this->assign('money_list_json',json_encode($money_list));
            //出纳员信息检索
            $cashier_list_village=D('Budget_cashier')->get_cashier_village();
            $cashier_list=D('Budget_cashier')->get_cashier_all();
            $this->assign('cashier_list_village',json_encode($cashier_list_village));
            $this->assign('cashier_list',$cashier_list);
            $this->display();
        }
    }
    /**
     * @author zhukeqin
     * 菜单需要1
     */
    public function village_record_list_news(){
        if($this->is_finance==1||$this->is_cashier==1){
            $this->check_record_list();
        }elseif(in_array(101,$this->role_id)){//刘总 专门配置
            redirect(U('Budget_predict/watch_company_one'));
        }else{
            $this->village_record_list();
        }
    }
    /**
     * @author zhukeqin
     * 项目方列表
     */
    public function village_record_list(){
        //设定检索时间
        if(!empty(I('get.month'))){
            $starttime=strtotime(date('Y-m',strtotime(I('get.month'))));
            $endtime=strtotime(date('Y-m-t',strtotime(I('get.month'))))+24*3600;
        }elseif(!empty(I('get.starttime'))){
            $starttime=strtotime(I('get.starttime'));
            if(!empty(I('get.endtime'))){
                $endtime=strtotime(I('get.endtime'))+24*3600;
            }else{
                $endtime=strtotime(date('Y-m-t',strtotime(I('get.starttime'))))+24*3600;
            }
        }elseif(!empty($_SESSION['record_check_time'])){
            $starttime=$_SESSION['record_check_time']['starttime'];
            $endtime=$_SESSION['record_check_time']['endtime'];
        }else{
            //默认为当前月份
            $starttime=strtotime(date('Y-m'));
            $endtime=strtotime(date('Y-m-t'))+24*3600;
        }
        $_SESSION['record_check_time']=array('starttime'=>$starttime,'endtime'=>$endtime);
        //设定审核情况
        if(!empty(I('get.record_status'))){
            $record_status=$_SESSION['record_status']=I('get.record_status');//2
        }elseif(!empty($_SESSION['record_status'])){
            $record_status=$_SESSION['record_status'];
        }else{
            $record_status=$_SESSION['record_status']=1;
        }
        if(I('get.modal')==1){
            $where['record_check_time']=array('between',array($starttime,$endtime-3600*24));

        }else{
            $where['record_time']=array('between',array(date('Y-m-d',$starttime),date('Y-m-d',$endtime-3600*24)));
        }
        /*where['record_time']=array('like',$month.'%');*/
        if($record_status!=4){
            $where['record_status']=$record_status;
        }
        $where['village_id']=$this->village_id;
        if(empty($this->project_id)){

        }else{
            $where['project_id']=$this->project_id;
        }
        $type_id = I('get.type_id');
        if(!empty(I('get.type_id'))){
            $where['type_id'] = $type_id;
        }
        $record_list=D('Budget_record')->get_record_list($where);

        //转换状态
        $record_status_list=array('1'=>'待审核','2'=>'审核通过','3'=>'驳回');
        foreach ($record_list as &$value){
            $value['record_status_name']=$record_status_list[$value['record_status']];
        }
        $role_list=explode(',',$_SESSION['system']['role_id']);
        if(!in_array('68',$role_list)&&!in_array('86',$role_list)){
            unset($record_list);
        }
        $this->assign('record_list',$record_list);
        $breadcrumb_diy = array(
            array('全部列表',U('check_record_list')),
        );
        $this->assign('starttime',$starttime);
        $this->assign('endtime',$endtime);
        $this->assign('record_status',$record_status);
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $this->assign('table_sort',json_encode(array('3','desc')));
        if(I('get.modal')==1){
            $this->display('village_record_list_modal');
        }else{
            $this->display('village_record_list');
        }
    }
    /**
     * @author zhukeqin
     * 项目方添加一条详情
     */
    public function village_add_record(){
        $id=I('get.id');
        if(IS_POST){
            $data=$_POST;
            if(!empty($id)){
                $data['record_id']=$id;
            }
            if(!empty($_FILES['record_file'])){
                $filepath=D('Budget_record')->upload_file($_FILES['record_file']);
                if(!$filepath) $this->error('附件上传失败，请重试');
                $data['record_file_path']=$filepath;
                $data['record_file_name']=$_FILES['record_file']['name'];
            }
            $return=D('Budget_record')->change_record_one($data,$this->village_id);
            if($return){
                $this->error($return);
            }else{
                $this->success('新增/修改成功',U('village_record_list'));
            }
        }else{
            //导航设置
            $breadcrumb_diy = array(
                array('详情列表',U('village_record_list')),
                array('添加/修改详情','#'),
            );
            if(!empty($id)){
                $record_info=D('Budget_record')->get_record_one(array('record_id'=>$id));
                $this->assign('record_info',$record_info);
            }
            $this->assign('breadcrumb_diy',$breadcrumb_diy);
            if(empty($record_info)||$record_info['record_status']==3){
                $this->display();
            }else{
                $this->display('check_record_info');
            }
        }
    }

    /**
     * @author zhukeqin
     *项目查看自身报表
     */
    public function village_excel_print(){
        $budget_logModel=new Budget_logModel();
        if(I('get.type')){
            $type=I('get.type');
        }else{
            $type='sum';
        }
        if(!empty(I('get.year'))){
            $year=$_SESSION['budget']['year']=I('get.year');
        }elseif(!empty($_SESSION['budget']['year'])){
            $year=$_SESSION['budget']['year'];
        }else{
            $year=date('Y');
        }
        $where['village_id']=$this->village_id;
        $where['project_id']=$this->project_id;
        $where['company_id']=$this->department_info['id'];
        $breadcrumb_diy = array(
            array('全部列表',U('village_record_list')),
            array('预算执行汇总表','#'),
        );
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $this->assign('year',$year);
        //设置标题名称
            $village_info=M('house_village')->where(array('village_id'=>$where['village_id']))->find();
            $title=$village_info['village_name'];
            $project_id_change=$where['village_id'];
            if(!empty($where['project_id'])){
                $title .='-'.M('house_village_project')->where(array('pigcms_id'=>$where['project_id']))->find()['desc'];
                $project_id_change .='-'.$where['project_id'];
            }
            $this->assign('project_id_change',$project_id_change);
            $this->assign('company_id',$village_info['department_id']);
            $company_id=$budget_logModel->get_company_id($where['village_id'],$where['project_id'],$year);//$village_info['department_id'];//获取公司id  用来筛选类别
        $this->assign('title1',$title);
        $type_first_list=D('Budget_type')->get_type_list(array('type_fid'=>0,'company_id'=>$company_id));
        $this->assign('type_list',$type_first_list);

        if($type=='sum'){

            $data=D('Budget_log')->get_excel_log_sum($where['village_id'],$where['project_id'],$where['company_id'],$year);
            $this->assign('data',$data);
            $this->display('village_excel_print_sum');
        }else{
            $data=D('Budget_log')->get_excel_log_type($type,$where['village_id'],$where['project_id'],$where['company_id'],$year);
            $this->assign('data',$data);
            $type_name=D('Budget_type')->get_type_one(array('type_id'=>$type))['type_name'];
            $this->assign('type_name',$type_name);

            $this->display('village_excel_print_type');
        }
    }

    /**
     * @author zhukeqin
     * 项目导出其报表
     */
    public function ajax_village_excel_print(){
        $year=I('get.year');
        if(empty($year)) $year=date('Y');
            D('Budget_log')->output_log_village($this->village_id,$this->project_id,$year);
        //$this->error('参数传入错误，请按正确的操作步骤进行操作');
    }

    /**
     * @author zhukeqin
     * 批量审核通过
     */
    public function check_record_batch(){
        $ids=explode(',',I('post.ids'));
        $ym=I('post.ym')?I('post.ym'):date('Y-m-d');
        if(empty($ids)) $this->error('没有选中条目不存在');
        $error=array();
        $record_model=new Budget_recordModel();
        foreach ($ids as $value){
            $record_info=$record_model->get_record_one(array('record_id'=>$value));
            $record=array(
                'record_check_time'=>$ym,
                'cashier_id'=>explode(',',$record_info['cashier_id']),
                'record_status'=>'2'
            );
            $return=$record_model->check_record_one($record,$value);
            if($return) $error[]=$record_info['record_name'].$return;
        }
        if(empty($error)){
            $this->success('批量审核成功');
        }else{
            $this->error(implode(',',$error));
        }
    }
    /**
     * @author zhukeqin
     * 财务审核详情
     */
    public function check_record(){
        $id=I('get.id');
        if(IS_POST){
            $data=$_POST;
            /*if(!empty($data['money_sum'])){
                $money_sum=$data['money_sum'];
                unset($data['money_sum']);
                $record_info=D('Budget_record')->get_record_one(array('record_id'=>$id));
                D('Budget_money')->change_money_one($money_sum,$record_info['type_id'],$record_info['village_id'],$record_info['company_id'],'',$record_info['project_id']);
            }*/
            //判断是否是补全支付凭证
            $record_info=D('Budget_record')->get_record_one(array('record_id'=>$id));
//            dump($record_info);
            if($record_info['record_status']=='2'){
                //检查是否有反审核操作
                if(!empty($data['record_status'])&&$data['record_status']!=$record_info['record_status']){
                    $return_history=D('Budget_record')->check_anti_one($id,$data['record_status']);
                    if($return_history) $this->error($return_history);
                }
                //补全支付凭证以及重新设置归档时间
//                dump($id);
//                dump($data);die;
                $return=D('Budget_record')->check_change_record($id,$data);
                //$return=!M('budget_record')->where(array('record_id'=>$id))->data(array('record_number'=>$data['record_number']))->save();
            }else{
                $return=D('Budget_record')->check_record_one($data,$id);
            }
            if($return){
                $this->error($return);
            }else{
                $this->success('审核修改成功',U('check_record_list'));
            }
        }else{
            //导航设置
            $breadcrumb_diy = array(
                array('全部列表',U('check_record_list')),
                array('审核条目','#'),
            );
            if(!empty($id)){
                $record_info=D('Budget_record')->get_record_one(array('record_id'=>$id));
                $village_list=D('House_village')->get_village_tree();
                $company_list=D('Department')->get_department_tree();
                $record_info['village_name']=$village_list[$record_info['village_id']];
                if(!empty($record_info['project_id'])){
                    $project_name=M('house_village_project')->where(array('pigcms_id'=>$record_info['project_id']))->find()['desc'];
                    $record_info['village_name'] .='-'.$project_name;
                }
                if(!empty($record_info['type_id'])){
                    //获取类别信息
                    $type_third=D('Budget_type')->get_type_one(array('type_id'=>$record_info['type_id']));
                    $type_second=D('Budget_type')->get_type_one(array('type_id'=>$type_third['type_fid']));
                    $type_first=D('Budget_type')->get_type_one(array('type_id'=>$type_second['type_fid']));
                    $record_status_list=array('1'=>'待审核','2'=>'审核通过','3'=>'驳回');
                    $record_info['record_status_name']=$record_status_list[$record_info['record_status']];

                    $record_info['type_name']=$type_first['type_name'].'-'.$type_second['type_name'].'-'.$type_third['type_name'];
                }
                $record_info['company_name']=$company_list[$record_info['company_id']];
                $this->assign('record_info',$record_info);
                $year=date('Y',strtotime($record_info['record_time']));
                $this->assign('year',$year);
                $project_id_change=$record_info['village_id'];
                if(!empty($record_info['project_id'])) $project_id_change .='-'.$record_info['project_id'];
                $this->assign('project_id_change',$project_id_change);
            }
            if(empty($record_info)){
                $this->error('系统没有找到您选择条目,请重试');
            }
            $type_list=D('Budget_type')->get_type_list_tree(array('company_id'=>$record_info['company_id']));
            $money_list=D('Budget_money')->get_money_village_list($record_info['village_id'],date('Y',strtotime($record_info['record_time'])),$record_info['project_id']);
            /*dump($type_list);
            die;*/
            $this->assign('breadcrumb_diy',$breadcrumb_diy);
            $this->assign('money_list',json_encode($money_list));
            $this->assign('type_list',json_encode($type_list));
            $url=U('Budget/ajax_change_money',array('project_id_change'=>$project_id_change,'year'=>$year,'url'=>urlencode(U('Budget/check_record',array('id'=>$_GET['id'])))));
            $this->assign('url',$url);
            if($record_info['record_status']==2){
                $this->display('check_record_info');
            }else{
                $this->assign('type_first',$type_first['type_id']);
                $this->assign('type_second',$type_second['type_id']);
                $this->assign('type_third',$type_third['type_id']);
                //出纳员信息检索
                $cashier_list_village=D('Budget_cashier')->get_cashier_village();
                $cashier_list=D('Budget_cashier')->get_cashier_all();
                $this->assign('cashier_list_village',json_encode($cashier_list_village));
                $this->assign('cashier_list',$cashier_list);
                if($record_info['record_status']==3){
                    $this->display();
                }else{

                    $this->display('check_record_news');
                }


            }
        }
    }
    /**
     * @author zhukeqin
     * ajax获取预算明细
     */
    public function ajax_get_money_list(){
        $village_id=explode('-',I('post.project_id_change'))['0'];
        $project_id=explode('-',I('post.project_id_change'))['1'];
        $village_info=M('house_village')->where(array('village_id'=>$village_id))->find();
        /*dump($village_info);*/
        $type_list=D('Budget_type')->get_type_list_tree(array('company_id'=>$village_info['department_id']));
        $money_list=D('Budget_money')->get_money_village_list($village_info['village_id'],date('Y'),$project_id);
        /*$this->assign('money_list',json_encode($money_list));
        $this->assign('type_list',json_encode($type_list));*/
        echo json_encode(array('money_list'=>$money_list,'type_list'=>$type_list));
    }/**
     * @author zhukeqin
     * ajax获取预算明细
     */
    public function get_money_list($project_id_change){
        $village_id=explode('-',$project_id_change)['0'];
        $project_id=explode('-',$project_id_change)['1'];
        $village_info=M('house_village')->where(array('village_id'=>$village_id))->find();
        /*dump($village_info);*/
        $type_list=D('Budget_type')->get_type_list_tree(array('company_id'=>$village_info['department_id']));
        $money_list=D('Budget_money')->get_money_village_list($village_info['village_id'],date('Y'),$project_id);
        /*$this->assign('money_list',json_encode($money_list));
        $this->assign('type_list',json_encode($type_list));*/
        return array('money_list'=>$money_list,'type_list'=>$type_list);
    }

    /**
     * @author zhukeqin
     * 输出预算执行表到网页
     **/
    public function check_excel_print(){
        $budget_logModel=new Budget_logModel();
        if(I('get.type')){
            $type=I('get.type');
        }else{
            $type='sum';
        }
        if(!empty(I('get.project_id_change'))){
            $_GET['village_id_budget']=explode('-',I('get.project_id_change'))['0'];
            $_GET['project_id_budget']=explode('-',I('get.project_id_change'))['1'];
        }
        if(!empty(I('get.year'))){
            $year=$_SESSION['budget']['year']=I('get.year');
        }elseif(!empty($_SESSION['budget']['year'])){
            $year=$_SESSION['budget']['year'];
        }else{
            $year=date('Y');
        }
        $where=array();
        if(!empty(I('get.company_id'))){
            unset($_SESSION['budget']['village_id']);
            unset($_SESSION['budget']['project_id']);
            $where['company_id']=$_SESSION['budget']['company_id']=I('get.company_id');
        }elseif(!empty(I('get.village_id_budget'))){
            unset($_SESSION['budget']['company_id']);
            $where['village_id']=$_SESSION['budget']['village_id']=I('get.village_id_budget');
            if(!empty(I('get.project_id_budget'))){
                $where['project_id']=$_SESSION['budget']['project_id']=I('get.project_id_budget');
            }
        }elseif(!empty($_SESSION['budget'])){
            $where=$_SESSION['budget'];
        }else{
            $where=$_SESSION['budget']=array('village_id'=>2,'project_id'=>1);
        }
        $breadcrumb_diy = array(
            array('全部列表',U('check_record_list')),
            array('预算执行汇总表','#'),
        );
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $this->assign('year',$year);
        //设置标题名称
        if(!empty($where['company_id'])){
            //标记
            $title=D('Department')->get_department_one(array('id'=>$where['company_id']))['deptname'];
            $this->assign('company_id',$where['company_id']);
            $company_id=$where['company_id'];//获取公司id  用来筛选类别
            $project_list=$this->get_project_list($where['company_id'],$year);
        }else{
            $village_info=M('house_village')->where(array('village_id'=>$where['village_id']))->find();
            $village_info['department_id']=$budget_logModel->get_company_id($where['village_id'],$where['project_id'],$year);
            $title=$village_info['village_name'];
            $project_id_change=$where['village_id'];
            if(!empty($where['project_id'])){
               $title .='-'.M('house_village_project')->where(array('pigcms_id'=>$where['project_id']))->find()['desc'];
               $project_id_change .='-'.$where['project_id'];
            }
            $this->assign('project_id_change',$project_id_change);
            $this->assign('company_id',$village_info['department_id']);
            $company_id=$village_info['department_id'];//获取公司id  用来筛选类别
            $project_list=$this->get_project_list($village_info['department_id'],$year);

        }
        $this->assign('title1',$title);
        $type_first_list=D('Budget_type')->get_type_list(array('type_fid'=>0,'company_id'=>$company_id));
        $this->assign('type_list',$type_first_list);
        $company_list=D('Department')->get_department_list(array('budget_type'=>1));
        array_unshift($company_list,array('id'=>'all','deptname'=>'集团预算执行汇总'),array('id'=>'all_company','deptname'=>'各分公司预算执行汇总'));
        /*$company_list['all_company']='各分公司预算执行汇总';
        $company_list['all']='集团预算执行汇总';*/
        if (in_array(101,$this->role_id)){//对集团领导(杭总、刘总)进行单独处理（隐藏预算金额修改按钮）
            $this->assign('isLeader',true);
        }else {
            $this->assign('isLeader',false);
        }
        $this->assign('company_list',$company_list);
        $this->assign('where',$where);
        if($type=='sum'){
            if(!empty($where['company_id'])){
                if(count($project_list)==1&&!empty($project_list)&&$where['company_id'] != 'all_company'){
                    //$village_id_get=array_pop($project_list);
                    $village_id_get=key($project_list);//获取项目id
                    $where['village_id']=explode(',',$village_id_get)['0'];
                    $where['project_id']=explode(',',$village_id_get)['1'];
                    $data=D('Budget_log')->get_excel_log_sum($where['village_id'],$where['project_id'],$where['company_id'],$year);
                    $project_id_change=$where['village_id'];
                    $project_id_change .=$where['project_id']?'':'-'.$where['project_id'];
                    $this->assign('data',$data);
                    $this->assign('project_id_change',$project_id_change);
                    $this->display('check_excel_print_sum');
                    die;
                }
                if($where['company_id']=='all_company'){
                    $data=D('Budget_log')->get_excel_log_sum_all_company($year);
                }elseif($where['company_id']=='all'){
                    $data=D('Budget_log')->get_excel_log_sum_all($year);
                }else{
//                    echo $where['company_id'];die;
                    $data=D('Budget_log')->get_excel_log_sum_company($where['company_id'],$year);
                }
                $sum=$data['sum'];
                $data=$data['list'];
//                dump($data);die;
                $this->assign('data',$data);
                $this->assign('sum',$sum);
                $this->display('check_excel_print_sum_company');
                die;
            }else{
                $data=D('Budget_log')->get_excel_log_sum($where['village_id'],$where['project_id'],$where['company_id'],$year);
            }
//            dump($data);die;
            $this->assign('data',$data);
            $this->display('check_excel_print_sum');
        }else{
            $data=D('Budget_log')->get_excel_log_type($type,$where['village_id'],$where['project_id'],$where['company_id'],$year);
            $this->assign('data',$data);
            $type_name=D('Budget_type')->get_type_one(array('type_id'=>$type))['type_name'];
            $this->assign('type_name',$type_name);
            $this->display('check_excel_print_type');
        }

    }

    public function ajax_excel_print(){
        $year=I('get.year');
        if(empty($year)) $year=date('Y');
        $company_id=I('get.company_id');
        $project_id_budget=I('get.project_id_change');
        if(!empty($company_id)) {
            D('Budget_log')->output_log_company($company_id,$year);
            die;
        }
        if(!empty($project_id_budget)){
            $village_id_budget=explode('-',$project_id_budget);
            D('Budget_log')->output_log_village($village_id_budget['0'],$village_id_budget['1'],$year);
            die;
        }
        $this->error('参数传入错误，请按正确的操作步骤进行操作');
    }
    public function check_money_list(){
        if(!empty(I('get.year'))){
            $year=$_SESSION['budget']['year']=I('get.year');
        }elseif(!empty($_SESSION['budget']['year'])){
            $year=$_SESSION['budget']['year'];
        }else{
            $year=date('Y');
        }
        if(!empty(I('get.project_id_change'))){
            $_GET['village_id_budget']=explode('-',I('get.project_id_change'))['0'];
            $_GET['project_id_budget']=explode('-',I('get.project_id_change'))['1'];
        }
        $breadcrumb_diy = array(
            array('全部列表',U('check_record_list')),
            array('预算金额表','#'),
        );
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $this->assign('year',$year);
        if(!empty(I('get.village_id_budget'))){
            unset($_SESSION['budget']['company_id']);
            $where['village_id']=$_SESSION['budget']['village_id']=I('get.village_id_budget');
            if(!empty(I('get.project_id_budget'))){
                $where['project_id']=$_SESSION['budget']['project_id']=I('get.project_id_budget');
            }
        }elseif(!empty($_SESSION['budget']['village_id'])){
            $where=$_SESSION['budget'];
        }else{
            $where=$_SESSION['budget']=array('village_id'=>2,'project_id'=>1);
        }
        $where['log_time']=$year;
        $village_info=M('house_village')->where(array('village_id'=>$where['village_id']))->find();
          $type_list=D('Budget_type')->get_type_list_tree(array('company_id'=>$village_info['department_id']));
          $money_list=array();
          foreach ($type_list as $key=>$value){
              $count2=0;
              foreach ($value['children'] as $key1=>$value1){
                  $count3=0;
                  foreach ($value1['children'] as $key2=>$value2){
                      $where['type_id']=$key2;
                      $money_list[$key]['children'][$key1]['children'][$key2]['data']=unserialize(D('Budget_log')->get_log_one($where)['log_data']);
                      $money_list[$key]['children'][$key1]['children'][$key2]['type_name']=$value2['type_name'];
                      $money_list[$key]['children'][$key1]['children'][$key2]['type_id']=$value2['type_id'];
                      $count3++;
                  }
                  $money_list[$key]['children'][$key1]['count']=$count3;
                  $money_list[$key]['children'][$key1]['type_name']=$value1['type_name'];
                  $money_list[$key]['children'][$key1]['type_id']=$value1['type_id'];
                  $count2 +=$count3;
              }
              $money_list[$key]['count']=$count2;
              $money_list[$key]['type_name']=$value['type_name'];
              $money_list[$key]['type_id']=$value['type_id'];
          }
          /*dump($money_list);*/
        $company_list=D('Department')->get_department_list(array('budget_type'=>1));
        $project_list=array();
        foreach ($company_list as $value){
            $project_list[$value['id']]['list']=$this->get_project_list($value['id'],$year);
            $project_list[$value['id']]['deptname']=$value['deptname'];
        }

        //设置标题
        $village_info=M('house_village')->where(array('village_id'=>$where['village_id']))->find();
        $title=$village_info['village_name'];
        $project_id_change=$where['village_id'];
        if(!empty($where['project_id'])){
            $title .='-'.M('house_village_project')->where(array('pigcms_id'=>$where['project_id']))->find()['desc'];
            $project_id_change .='-'.$where['project_id'];
        }
        $this->assign('project_id_change',$project_id_change);
        $this->assign('company_id',$village_info['department_id']);
        $this->assign('title1',$title);
        $this->assign('project_list',json_encode($project_list));
        $this->assign('money_list',$money_list);
        $this->display();

    }

    /**
     * @author zhukeqin
     * 改变预算总金额列表
     */
    public function check_money_list_change(){
        $this->check_money_list();
    }
    /**
     * @author zhukeqin
     * 改变预算金额
     */
    public function ajax_change_money(){
        $type_id=I('get.type_id');
        $project_id_change=I('get.project_id_change');
        $year=I('get.year');
        //参数都不能为空
        if(empty($type_id)||empty($project_id_change)||empty($year)){
            $this->error('参数不正确');
        }
        $village_id=explode('-',$project_id_change)['0'];
        $project_id=explode('-',$project_id_change)['1'];
        if(IS_POST){
            $company_id=M('house_village')->where(array('village_id'=>$village_id))->find()['department_id'];
            $return=D('Budget_money')->change_money_one($_POST['money_sum'],$type_id,$village_id,$company_id,$year,$project_id);
            D('Budget_log')->change_log_one($type_id,$village_id,$company_id,$project_id);
            if(empty($_GET['url'])){
                $url=U('Budget/check_money_list_change',array('project_id_change'=>$project_id_change));
            }else{
                $url=html_entity_decode(html_entity_decode(html_entity_decode(html_entity_decode($_GET['url']))));
            }
            if($return){
                $this->error($return,$url);
            }else{
                redirect($url);
                die;
            }
        }else{
            $where=array(
                'type_id'=>$type_id,
                'village_id'=>$village_id,
                'log_time'=>$year,
            );
            if(!empty($project_id)) $where['project_id']=$project_id;
            $log_data=D('Budget_log')->get_log_one($where);
            if(empty($log_data))$log_data=array('log_data'=>'');
            $data=unserialize($log_data['log_data']);
            $this->assign('data',$data);
            $type_info=D('Budget_type')->get_type_one(array('type_id'=>$type_id));
            $this->assign('type_info',$type_info);
            $this->assign('year',$year);
            $this->display();
        }
    }

    /**
     * @author zhukeqin
     * 财务批量导入预算/收入表
     */
    public function check_import_record(){
        if(IS_POST){
            $file = $_FILES['test'];
            /*$project_id_change = I('post.project_id_change');
            $village_id=explode('-',$project_id_change)['0'];
            $project_id=explode('-',$project_id_change)['1'];
            if(empty($village_id)){
                $this->error('当前项目选择为空');
            }
            $company_id=M('house_village')->where(array('village_id'=>$village_id))->find()['department_id'];
            if(empty($company_id)){
                $this->error('当前选择项目没有所属公司，请设置后再来导入');
            }*/
            $type_list_arr=D('Budget_type')->get_type_list(array('type_rank'=>3));
            $type_list=array();
            foreach ($type_list_arr as $value){
                $type_list[$value['type_id']]=$value['type_name'];
            }
            $arr = import_excel_sheet($file,'H');
            unset($arr[0]);
            $error=array();
            foreach ($arr as $key=>$value){
                //第一列为空则跳过
                if(empty($value['0'])){
                    continue;
                }
                $village_name=explode('-',$value['0'])['0'];
                $project_name=explode('-',$value['0'])['1'];
                if(empty($village_name)) continue;
                $village_info=M('house_village')->where(array('village_name'=>$village_name))->find();
                if(empty($village_info)){
                    $error[]='第'.($key+1).'行所属项目不存在';
                    continue;
                }
                $village_id=$village_info['village_id'];
                //是小区则获取
                if($village_info['village_type']==1){
                    //防止某些小区没有期数存在的问题
                    if(empty($project_name)){
                        $project_id=M('house_village_project')->where(array('village_id'=>$village_id))->find()['pigcms_id'];
                    }else{
                        $project_id=M('house_village_project')->where(array('village_id'=>$village_id,'desc'=>$project_name))->find()['pigcms_id'];
                        if(empty($project_id)){
                            $error[]='第'.($key+1).'行所属项目的期数不存在';
                            continue;
                        }
                    }
                }else{
                    $project_id='';
                }
                $company_id=$village_info['department_id'];
                if(empty($company_id)){
                    $error[]='第'.($key+1).'行项目不存在所属公司，无法导入';
                    continue;
                }
                $type_id=array_search($value['1'],$type_list);
                //检查类型
                if(empty($type_id)){
                    $error[]='第'.($key+1).'行的预算/收入类型没有找到';
                    continue;
                }
                //检查金额
                if(empty($value['3'])){
                    $error[]='第'.($key+1).'行的金额为空';
                    continue;
                }else{
                    $money=$value['3'];
                }
                //检查日期
                if(empty($value['4'])){
                    $error[]='第'.($key+1).'行的日期为空为空';
                    continue;
                }else{
                    if(is_numeric($value['4'])){
                        $time=date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($value['4']));
                    }else{
                        $time=date('Y-m-d',strtotime($value['4']));
                    }
                    $year=date('Y',strtotime($time));
                }
                //设置摘要
                if(empty($value['2'])){
                    $name=$value['4'].$value['1'];
                }else{
                    $name=$value['2'];
                }
                //设置出纳
                $cashier_id='';
                if(!empty($value['7'])){
                    $admin_info=M('admin')->where(array('account'=>$value['7']))->find();
                    $cashier_id=D('Budget_cashier')->get_cashier_one(array('admin_id'=>$admin_info['id']))['cashier_id'];
                    if(empty($cashier_id)) $error[]='第'.($key+1).'行出纳没有找到，请之后手动修改';
                }

                
                $data=array(
                    'record_name'=>$name,
                    'record_money'=>$money,
                    'record_time'=>$time,
                    'record_number'=>$value['5'],
                    'type_id'=>$type_id,
                    'village_id'=>$village_id,
                    'company_id'=>$company_id,
                    'record_remark'=>$value['6'],
                    'record_status'=>1,
                    /*'record_create_time'=>strtotime($time),*/
                    'record_create_id'=>$_SESSION['admin_id'],
                   'cashier_id'=>$cashier_id,
                   /* 'record_check_id'=>$_SESSION['admin_id'],
                    'record_check_time'=>strtotime($time),
                    'record_audit_time'=>strtotime($time),*/
                );
                /*$return=D('Budget_record')->get_record_list(array('record_name'=>$data['record_name'],'record_money'=>$data['record_money'],'record_time'=>$data['record_time'],'type_id'=>$data['type_id'],'village_id'=>$data['village_id']));
                if(count($return)>=2){
                    $village_name=M('house_village')->where(array('village_id'=>$data['village_id']))->find()['village_name'];
                    $type_name=M('budget_type')->where(array('type_id'=>$data['type_id']))->find()['type_name'];
                    dump($type_name.'-'.$village_name);
                }
                foreach ($return as $value){
                        if($value['record_status']==3){
                            $res=M('budget_record')->where(array('record_id'=>$value['record_id']))->delete();
                        }
                    }*/
                if(!empty($project_id))$data['project_id']=$project_id;
                $return=M('budget_record')->data($data)->add();
                if(empty($return)){
                    $error[]='第'.($key+1).'行插入失败，请重试';
                }else{
                    $return1=D('Budget_log')->change_log_one($type_id,$village_id,$company_id,$project_id,$year);
                }
            }
            if(empty($error)){
                $this->success('导入预算信息成功！',U('Budget/check_record_list'));
            }else{
                echo "<center>";
                echo "以下行数有对应问题，请处理之后再单独导入</br>";
                foreach ($error as $value){
                    echo $value."</br>";
                }
                echo "</center>";
            }
        }else{
            //获取分公司及项目列表
            /*$company_list=D('Department')->get_department_list(array('budget_type'=>1));
            $project_list=array();
            foreach ($company_list as $value){
                $project_list[$value['id']]['list']=$this->get_project_list($value['id']);
                $project_list[$value['id']]['deptname']=$value['deptname'];
            }
            $this->assign('project_list',json_encode($project_list));*/
            $breadcrumb_diy = array(
                array('全部列表',U('check_record_list')),
                array('批量导入预算/收入','#'),
            );
            $this->assign('breadcrumb_diy',$breadcrumb_diy);
            $this->display();
        }
    }

    /**
     * @author  zhukeqin
     * ajax修改支付代码
     */
    public function ajax_change_number(){
        $id=I('post.id');
        $record_number=I('post.record_number');
        $record_info=D('Budget_record')->get_record_one(array('record_id'=>$id));
        if(empty($record_info)){
            echo json_encode(array('err'=>1,'msg'=>'无法找到对应的预算记录'));
            die;
        }
        if($record_info['record_status']==1){
            echo json_encode(array('err'=>1,'msg'=>'该条信息尚未审核，请先审核后再来修改'));
            die;
        }
        $return=M('budget_record')->where(array('record_id'=>$id))->data(array('record_number'=>$record_number))->save();
        if($return){
            echo json_encode(array('err'=>0,'msg'=>''));
            die;
        }else{
            echo json_encode(array('err'=>1,'msg'=>'更新失败，请重试'));
            die;
        }
    }
    public function ajax_change_check_time(){
        $id=I('post.id');
        $record_check_time=I('post.record_check_time');
        $record_info=D('Budget_record')->get_record_one(array('record_id'=>$id));
        if(empty($record_info)){
            echo json_encode(array('err'=>1,'msg'=>'无法找到对应的预算记录'));
            die;
        }
        if($record_info['record_status']==1){
            echo json_encode(array('err'=>1,'msg'=>'该条信息尚未审核，请先审核后再来修改'));
            die;
        }
        if($record_info['record_status']==3){
            echo json_encode(array('err'=>1,'msg'=>'该条信息被驳回，无法修改归档时间'));
            die;
        }
        $return=D('Budget_record')->check_change_record($id,array('record_check_time'=>strtotime($record_check_time)));
        if($return){
            echo json_encode(array('err'=>0,'msg'=>''));
            die;
        }else{
            echo json_encode(array('err'=>1,'msg'=>'更新失败，请重试'));
            die;
        }

    }
    public function check_excel_print_type_select(){
        if(!empty(I('post.project_id_change'))){
            $_POST['village_id_budget']=explode('-',I('post.project_id_change'))['0'];
            $_POST['project_id_budget']=explode('-',I('post.project_id_change'))['1'];
        }
        if(!empty(I('post.year'))){
            $year=I('post.year');
        }else{
            $year=date('Y');
        }
        $type_id_first=I('post.type_id_first');
        $type_id_second=I('post.type_id_second');
        $type_id_third=I('post.type_id_third');
        if($type_id_third){
            $type_id=$type_id_third;
        }elseif($type_id_second){
            $type_id=$type_id_second;
        }elseif($type_id_first){
            $type_id=$type_id_first;
        }else{
            $type_id='8';
        }

        /*if(!empty(I('post.type_id'))){
            $type_id=I('post.type_id');
        }else{
            $type_id='8';
        }*/
        if(!empty(I('post.company_id'))){
            $company_id=I('post.company_id');
        }
        if(empty(I('post.type'))){
            $type=1;
        }else{
            $type=I('post.type');
        }
        $budget_log=new Budget_logModel();
        $data=array();
        if($type==1){
            //全部分公司统计
            $company_list=D('Department')->get_department_list(array('budget_type'=>1));
            foreach ($company_list as $value){
                $cache=$budget_log->get_excel_type_one($type_id,'','',$value['id'],$year);
                $data[]=array('name'=>$value['deptname'],'list'=>$cache,'company_id'=>$value['id']);
            }
            $sum=$budget_log->get_excel_type_one($type_id,'','','',$year);
        }elseif($type==2||$type==4){
            if($type==4){
                //某总公司下所有项目统计
                $village_list=M('house_village')->where(array('group_id'=>I('post.group_id')))->select();
            }else{
                //某分公司下所有项目统计
                $village_list=M('house_village')->where(array('department_id'=>$company_id))->select();
            }

            if(empty($village_list)){
                $this->error('所选公司没有所属项目');
            }
            $sum=array();
            foreach ($village_list as $value){
                if($value['village_type']==1){
                    $project_list=M('house_village_project')->where(array('village_id'=>$value['village_id']))->select();
                    foreach ($project_list as $value1){
                        $cache=$budget_log->get_excel_type_one($type_id,$value['village_id'],$value1['pigcms_id'],'',$year);
                        $data[]=array('name'=>$value['village_name'].'-'.$value1['desc'],'list'=>$cache,'village_id'=>$value['village_id'],'project_id'=>$value1['pigcms_id']);
                    }
                }else{
                    $cache=$budget_log->get_excel_type_one($type_id,$value['village_id'],'','',$year);
                    $data[]=array('name'=>$value['village_name'],'list'=>$cache,'village_id'=>$value['village_id']);
                }
                foreach ($cache as $key2=>$value2){
                    $sum[$key2] +=$value2;
                }
            }
            //$sum=$budget_log->get_excel_type_one($type_id,'','',$company_id,$year);
        }else{
            //全部项目统计
            $village_list=M('house_village')->where(array('department_id'=>array('neq','')))->select();
            foreach ($village_list as $value){
                if($value['village_type']==1){
                    $project_list=M('house_village_project')->where(array('village_id'=>$value['village_id']))->select();
                    foreach ($project_list as $value1){
                        $cache=$budget_log->get_excel_type_one($type_id,$value['village_id'],$value1['pigcms_id'],'',$year);
                        $data[]=array('name'=>$value['village_name'].'-'.$value1['desc'],'list'=>$cache,'village_id'=>$value['village_id'],'project_id'=>$value1['pigcms_id']);
                    }
                }else{
                    $cache=$budget_log->get_excel_type_one($type_id,$value['village_id'],'','',$year);
                    $data[]=array('name'=>$value['village_name'],'list'=>$cache,'village_id'=>$value['village_id']);
                }
            }
            $sum=$budget_log->get_excel_type_one($type_id,'','','',$year);
        }
        $type_list=D('Budget_type')->get_type_list_tree();
        $this->assign('type_list',json_encode($type_list));
        $company_list=D('Department')->get_department_list(array('budget_type'=>1));
        $this->assign('company_list',$company_list);
        $title=D('Budget_type')->get_type_one(array('type_id'=>$type_id))['type_name'];
        $this->assign('title1',$title);
        $breadcrumb_diy = array(
            array('全部列表',U('check_record_list')),
            array('按预算类别汇总','#'),
        );
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $this->assign('year',$year);
        $this->assign('data',$data);
        $this->assign('sum',$sum);
        $this->assign('type_id',$type_id);
        $this->display();
    }

    /**
     * @author zhukeqin
     *获取指定条件的预算清单文件列表
     */
    public function check_file_list(){
        if(!empty(I('get.year'))){
            $year=$_SESSION['budget_file']['year']=I('get.year');
        }elseif(!empty($_SESSION['budget_file']['year'])){
            $year=$_SESSION['budget_file']['year'];
        }else{
            $year=$_SESSION['budget_file']['year']=date('Y');
        }
        if(!empty(I('get.project_id_change'))){
            $_GET['village_id_budget']=explode('-',I('get.project_id_change'))['0'];
            $_GET['project_id_budget']=explode('-',I('get.project_id_change'))['1'];
            $_SESSION['budget_file']['village_id']=$_GET['village_id_budget'];
            $_SESSION['budget_file']['project_id']=$_GET['project_id_budget'];
        }
        if(!empty(I('get.file_status'))){
            $_SESSION['budget_file']['file_status']=I('get.file_status');
        }
        if(!empty(I('get.company_id'))){
            $_SESSION['budget_file']['company_id']=I('get.company_id');
            $_SESSION['budget_file']['village_id']='all';
            $_SESSION['budget_file']['project_id']='';
        }
        if(empty($_SESSION['budget_file']['village_id'])) $_SESSION['budget_file']['village_id']='all';
        $breadcrumb_diy = array(
            array('全部列表',U('check_record_list')),
            array('预算总金额列表',U('check_money_list')),
            array('预算清单文件预览及管理','#'),
        );
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $this->assign('year',$year);

        if(empty($_SESSION['budget_file']['company_id'])||$_SESSION['budget_file']['company_id']=='all'){
            $_SESSION['budget_file']['company_id']='all';
            $_SESSION['budget_file']['village_id']='all';
            $project_id_change='all';
        }else{
            $where['company_id']=$_SESSION['budget_file']['company_id'];
            if($_SESSION['budget_file']['village_id']=='all'||empty($_SESSION['budget_file']['village_id'])){
                $project_id_change='all';
            }else{
                $where['village_id']=$_SESSION['budget_file']['village_id'];
                $project_id_change=$_SESSION['budget_file']['village_id'];
                if(!empty($_SESSION['budget_file']['project_id'])){
                    $where['project_id']=$_SESSION['budget_file']['project_id'];
                    $project_id_change .='-'.$_SESSION['budget_file']['project_id'];
                }else{
                    $where['project_id']='';
                }
            }
        }


        if(empty($_SESSION['budget_file']['file_status'])) $_SESSION['budget_file']['file_status']=1;//设置初始值待审核
        if($_SESSION['budget_file']['file_status']!=4) $where['file_status']=$_SESSION['budget_file']['file_status'];

        $where['year']=$year;
        /*$village_info=M('house_village')->where(array('village_id'=>$where['village_id']))->find();
        $type_list=D('Budget_type')->get_type_list_tree(array('company_id'=>$village_info['department_id']));*/
        $file_list=D('Budget_file')->get_file_list($where);
        foreach ($file_list as $key=>$value){
            $file_list[$key]['company_name']=M('department')->where(array('id'=>$value['company_id']))->find()['deptname'];
            $file_list[$key]['village_name']=M('house_village')->where(array('village_id'=>$value['village_id']))->find()['village_name'];
            if(!empty($value['project_id'])){
                $file_list[$key]['village_name'] .='-'.M('house_village_project')->where(array('pigcms_id'=>$value['project_id']))->find()['desc'];
            }
        }
        /*dump($money_list);*/
        $company_list=D('Department')->get_department_list(array('budget_type'=>1));
        $project_list=array();
        foreach ($company_list as $value){
            $project_list[$value['id']]['list']=$this->get_project_list($value['id'],$year);
            $project_list[$value['id']]['deptname']=$value['deptname'];
        }


        $project_list['all']=array();
        $this->assign('project_id_change',$project_id_change);
        $this->assign('company_id',$_SESSION['budget_file']['company_id']);
        $this->assign('file_status',$_SESSION['budget_file']['file_status']);

        $this->assign('project_list',json_encode($project_list));
        $this->assign('file_list',$file_list);
        $this->display();
    }

    /**
     * @author zhukeqin
     * 预算清单文件上传
     */
    public function check_file_upload(){
        $breadcrumb_diy = array(
            array('全部列表',U('check_record_list')),
            array('预算总金额列表',U('check_money_list')),
            array('预算清单文件预览及管理',U('check_file_list')),
            array('预算清单文件修改','#'),
        );
        if(!empty(I('get.file_id'))){
            $file_info=D('Budget_file')->get_file_one(array('file_id'=>I('get.file_id')));
            if(empty($file_info)) $this->error('当前所选文件不存在');
        }
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        if(IS_POST){
            if(!empty(I('post.project_id_change'))){
                $file_info['village_id']=explode('-',I('post.project_id_change'))['0'];
                $file_info['project_id']=explode('-',I('post.project_id_change'))['1'];
            }
            $file_info['year']=I('post.year');
            $file_info['file_remark']=I('post.file_remark');
            $file_info['file_status']=I('post.file_status');
            $file_info['file_check_remark']=I('post.file_check_remark');
            $file_info['type_id']='1';
            $return=D('Budget_file')->change_file_list($file_info,$_FILES['file'],$file_info['file_id'],$file_info['village_id'],$file_info['project_id'],$file_info['file_status']);
            if($return){
                $this->error($return,U('Budget/check_file_list'));
            }else{
                $this->success('上传成功',U('Budget/check_file_list'));
            }
        }else{
            $company_list=D('Department')->get_department_list(array('budget_type'=>1));
            $project_list=array();
            $year=$file_info['year']?$file_info['year']:date('Y');
            foreach ($company_list as $value){
                $project_list[$value['id']]['list']=$this->get_project_list($value['id'],$year);
                $project_list[$value['id']]['deptname']=$value['deptname'];
            }

            if(empty($file_info)){
                $company_id='2';
                $project_id_change='71';
            }else{
                $company_id=$file_info['company_id'];
                $project_id_change=$file_info['village_id'];
                if(!empty($file_info['project_id'])) $project_id_change .='-'.$file_info['project_id'];
            }
            $year=$file_info['year']?$file_info['year']:date('Y');
            $this->assign('project_id_change',$project_id_change);
            $this->assign('company_id',$company_id);
            $this->assign('year',$year);
            $this->assign('project_list',json_encode($project_list));
            $this->assign('file_info',$file_info);
            $this->display();
        }
    }

    public function check_file_online(){
        $file_id=I('get.file_id');
        $file_info=D('Budget_file')->get_file_one(array('file_id'=>$file_id));
        if(empty($file_info)) $this->error('指定文件不存在');
        $url=urlencode('http://'.$_SERVER['SERVER_NAME'].substr($file_info['file_path'],1));
        redirect('http://view.officeapps.live.com/op/view.aspx?src='.$url);
        die;
    }
    /**
     * @author zhukeqin
     * 删除一个文件
     */
    public function check_file_delete(){
        $file_id=I('get.file_id');
        if(empty($file_id)) echo json_encode(array('err'=>1,'msg'=>'请选择正确的文件进行删除'));
        $return=D('Budget_file')->delete_file_one($file_id);
        if($return){
            echo json_encode(array('err'=>1,'msg'=>$return));
        }else{
            echo json_encode(array('err'=>0,'msg'=>'删除成功'));
        }
    }

    /**
     * @author zhukeqin
     * 财务通过一条审核
     */
    public function check_file_checkout(){
        $file_id=I('get.file_id');
        $re=D('Budget_file')->check_file_one($file_id,'2','');
        if($re){
            $this->error($re);
        }else{
            $this->success('审核成功！');
        }
    }

    /**
     * @author zhukeqin
     * 财务批量审核通过
     */
    public function check_file_autocheck(){
        $id_list=explode(',',I('post.ids'));
        $file_check_remark=I('post.file_check_remark');
        foreach ($id_list as $value){
            $re=D('Budget_file')->check_file_one($value,'2',$file_check_remark);
        }
        $this->success('审核成功！');
    }
    /**
     * @author zhukeqin
     * 项目查看自身文件列表
     */
    public function village_file_list(){
        if(!empty(I('get.year'))){
            $year=$_SESSION['budget_file']['year']=I('get.year');
        }elseif(!empty($_SESSION['budget_file']['year'])){
            $year=$_SESSION['budget_file']['year'];
        }else{
            $year=$_SESSION['budget_file']['year']=date('Y');
        }

        if(!empty(I('get.file_status'))){
            $_SESSION['budget_file']['file_status']=I('get.file_status');
        }
        $breadcrumb_diy = array(
            array('全部列表',U('village_record_list')),
            array('预算清单文件预览及管理','#'),
        );
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $this->assign('year',$year);


        if(empty($_SESSION['budget_file']['file_status'])) $_SESSION['budget_file']['file_status']=1;//设置初始值待审核
        if($_SESSION['budget_file']['file_status']!=4) $where['file_status']=$_SESSION['budget_file']['file_status'];

        $where['year']=$year;
        $where['village_id']=$_SESSION['system']['village_id'];
        if(!empty($_SESSION['project_id']))$where['project_id']=$_SESSION['project_id'];
        /*$village_info=M('house_village')->where(array('village_id'=>$where['village_id']))->find();
        $type_list=D('Budget_type')->get_type_list_tree(array('company_id'=>$village_info['department_id']));*/
        $file_list=D('Budget_file')->get_file_list($where);
        foreach ($file_list as $key=>$value){
            $file_list[$key]['company_name']=M('department')->where(array('id'=>$value['company_id']))->find()['deptname'];
            $file_list[$key]['village_name']=M('house_village')->where(array('village_id'=>$value['village_id']))->find()['village_name'];
            if(!empty($value['project_id'])){
                $file_list[$key]['village_name'] .='-'.M('house_village_project')->where(array('pigcms_id'=>$value['project_id']))->find()['desc'];
            }
        }

        $this->assign('file_status',$_SESSION['budget_file']['file_status']);
        $this->assign('file_list',$file_list);
        $this->display();
    }
    /**
     * @author zhukeqin
     * 项目清单文件上传
     */
    public function village_file_upload(){
        $breadcrumb_diy = array(
            array('全部列表',U('village_record_list')),
            array('预算清单文件预览及管理',U('village_file_list')),
            array('预算清单文件修改','#'),
        );
        $village_id=$_SESSION['system']['village_id'];
        $project_id=$_SESSION['project_id'];
        if(!empty(I('get.file_id'))){
            $file_info=D('Budget_file')->get_file_one(array('file_id'=>I('get.file_id'),'village_id'=>$village_id));
            if(empty($file_info)) $this->error('当前所选文件不存在');
        }
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        if(IS_POST){
            $file_info['year']=I('post.year')?I('post.year'):$file_info['year'];
            $file_info['file_remark']=I('post.file_remark');
            $file_info['type_id']='1';
            $return=D('Budget_file')->village_add_one($file_info,$_FILES['file'],$file_info['file_id']);
            if($return){
                $this->error($return,U('Budget/village_file_list'));
            }else{
                $this->success('上传成功',U('Budget/village_file_list'));
            }
        }else{
            $village_name=M('house_village')->where(array('village_id'=>$village_id))->find()['village_name'];
            if(!empty($value['project_id'])){
                $village_name .='-'.M('house_village_project')->where(array('pigcms_id'=>$project_id))->find()['desc'];
            }
            $year=$file_info['year']?$file_info['year']:date('Y');
            $this->assign('year',$year);
            $this->assign('file_info',$file_info);
            $this->assign('village_name',$village_name);
            $this->display();
        }
    }
    /**
     * @author zhukeqin
     * 出纳列表
     */
    public function check_cashier_list(){
        $breadcrumb_diy = array(
            array('全部列表',U('check_record_list')),
            array('出纳列表','#'),
        );
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $cashier_list=D('Budget_cashier')->get_cashier_all('1');
        $this->assign('cashier_list',$cashier_list);
        $this->display();
    }

    /**
     * @author zhukeqin
     * 出纳编辑
     */
    public function check_cashier_change(){
        $breadcrumb_diy = array(
            array('全部列表',U('check_record_list')),
            array('出纳列表',U('check_cashier_list')),
            array('出纳编辑','#'),
        );
        $cashier_id=I('get.cashier_id');
        $cashier_info=D('Budget_cashier')->get_cashier_one(array('cashier_id'=>$cashier_id),'1');
        if(empty($cashier_info)) $this->error('您所选择的出纳不存在');
        if(IS_POST){
            $data=$_POST;
            $return=D('Budget_cashier')->change_cashier_one($data,$cashier_info['admin_id']);
            if($return){
                $this->error($return);
            }else{
                $this->success('编辑成功',U('check_cashier_list'));
            }
        }else{
            $this->assign('breadcrumb_diy',$breadcrumb_diy);
            $cashier_info['admin_info']=M('admin')->where(array('id'=>$cashier_info['admin_id']))->find();
            $this->assign('cashier_info',$cashier_info);
           $village_list=M('house_village')->where(array('department_id'=>array('exp',' is not null AND department_id != ""')))->select();
            $this->assign('village_list',$village_list);
            $this->display();
        }

    }
    /**
     * @author zhukeqin
     * 导入历史记录
     */
    public function upload_history_log(){
        if(IS_POST){
            $data=$_POST;
            $project_id_change=$data['project_id_change'];
            unset($data['project_id_change']);
            $village_id=explode('-',$project_id_change)['0'];
            $project_id=explode('-',$project_id_change)['1'];
            $file=$_FILES['test'];
            $error=D('Budget_record')->update_history_log($file,$village_id,$project_id,$data['year']);
            if(empty($error)){
                $this->success('导入预算信息成功！');
            }elseif(!is_array($error)){
                echo "<center>";
                echo $error;
                echo "</center>";
            }else{
                dump($error);
                echo "<center>";
                echo "以下行数有对应问题，请处理之后再单独导入</br>";
                foreach ($error as $value){
                    echo $value."</br>";
                }
                echo "</center>";
            }
        }else{
            //获取所有项目列表
            $village_list=D('House_village')->get_village_tree(array('department_id'=>array('neq','')),'department_id asc');
            $project_list=array();
            foreach ($village_list as $key=>$value){
                $cache=M('house_village_project')->where(array('village_id'=>$key))->select();
                if(empty($cache)){
                    $money_list=D('Budget_money')->get_money_village_tree($key);
                    $project_list[$key]=array('name'=>$value,'money_list'=>$money_list);
                }else{
                    foreach ($cache as $key1=>$value1){
                        $money_list=D('Budget_money')->get_money_village_tree($key,'',$value1['pigcms_id']);
                        $project_list[$key.'-'.$value1['pigcms_id']]=array('name'=>$value.'-'.$value1['desc'],'money_list'=>$money_list);
                    }
                }
            }
            $this->assign('project_list',$project_list);
            $this->display();
        }
    }
    /**
     * @author zhukeqin
     * @param $company_id
     * @return array
     * 获取某一公司所属的所有项目
     */
    public function get_project_list($company_id,$year=''){
        if(empty($year)) $year=date('Y');
        if($year<date('Y')){
            $log_list=M('budget_log')->where(array('company_id'=>$company_id))->group('village_id')->select();
            foreach ($log_list as $value){
                $village_list[$value['village_id']]=M('house_village')->where(array('village_id'=>$value['village_id']))->find()['village_name'];
            }
        }else{
            $village_list=D('House_village')->get_village_tree(array('department_id'=>$company_id));
        }
        //获取所有项目列表
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
        $this->assign('project_list',$project_list);
        return $project_list;
    }

    /**
     * @author zhukeqin
     * @param $key_list
     * @param string $list
     * @return array
     * 获取value值列表  用于批量获取type_name  village_name 和 department_name
     */
    public function get_value($key_list,$list=''){
        if(empty($list)) $list=D('Department')->get_type_list_tree();
        $return=array();
        foreach ($key_list as $key=>$value){
            $return[]=$list[$value];
        }
        return $return;
    }

    public function check_add_history(){
        if(IS_POST){
            $data=import_excel_sheet($_FILES['test'],'','','4','3');
            foreach ($data as $key=>$value){
                $type_info=D('Budget_type')->get_type_one(array('type_name'=>preg_replace('# #','',$value['0'])));
                if($type_info['type_rank']!=3) $type_info=D('Budget_type')->get_type_one(array('type_name'=>preg_replace('# #','',$value['1'])));
                if($type_info['type_rank']==3){
                    dump($type_info);
                    die;

                }
            }
        }else{
            $this->display();
        }
    }

    public function add(){
        /*$record_list=M('budget_record')->select();
        foreach ($record_list as $value){
            if(is_numeric($value['record_time'])){
                $data=array('record_time'=>date('Y-m-d',$value['record_time']));
                M('budget_record')->where(array('record_id'=>$value['record_id']))->data($data)->save();
            }
        }*/
        /*$model=new MeterModel();
        $meter_list=M('house_village_meters')->select();
        foreach ($meter_list as $value){
            $record_list=M('re_setmeter')->where(array('meter_hash'=>$value['meter_hash']))->order('id desc')->limit('0,2')->select();
            if(empty($record_list)||count($record_list)==1) continue;
            $data=array('last_total_consume'=>$record_list['1']['total_consume']);
            M('re_setmeter')->where(array('id'=>$record_list['0']['id']))->data($data)->save();
            $model->set_be_cousume($value['meter_hash'],$record_list['1']['total_consume'],$record_list['0']['total_consume'],date('Y-m-d',$record_list['0']['create_time']));
        }*/
        /*$record_info=array(
            'type_id'=>'94',
            'village_id'=>2,
            'project_id'=>1,
            'company_id'=>88
        );
        $where=array(
            'type_id'=>$record_info['type_id'],
            'village_id'=>$record_info['village_id'],
            'status'=>2
        );
        if(!empty($record_info['project_id'])) $where['project_id']=$record_info['project_id'];
        $record_list=D('Budget_record')->get_record_list($where);
        foreach ($record_list as $value){
            $record_name=explode('月',$value['record_name']);
            $record_name['0']--;
            $record_time='2018-'.sprintf('%02d',$record_name['0']).'-02';
            $data=array(
                'record_name'=>implode('月',$record_name),
                'record_time'=>$record_time,
                'record_create_time'=>strtotime($record_time),
                'record_check_time'=>strtotime($record_time),
                'record_audit_time'=>strtotime($record_time),
            );
            D('Budget_record')->where(array('record_id'=>$value['record_id']))->data($data)->save();
        }
        D('Budget_log')->change_log_one($record_info['type_id'],$record_info['village_id'],$record_info['company_id'],$record_info['project_id']);*/
        $type_id=I('get.type_id');
        $village_id=explode('-',I('get.id'))['0'];
        $project_id=explode('-',I('get.id'))['1'];
        $company_id=M('house_village')->where(array('village_id'=>$village_id))->find()['department_id'];
        $record_info=array(
            'type_id'=>$type_id,
            'village_id'=>$village_id,
            'company_id'=>$company_id,
            'project_id'=>$project_id
        );
        D('Budget_log')->change_log_one($record_info['type_id'],$record_info['village_id'],$record_info['company_id'],$record_info['project_id']);

    }

    public function demo(){
        $budget_logModel=new Budget_logModel();
        //$record_list=M('budget_record')->where(array('record_check_time'=>array('elt',strtotime('2019-1-1')),'record_audit_time'=>array('egt',strtotime('2019-1-1'))))->select();
        /*foreach ($record_list as $value){
            $company_id='';
            $company_id=$budget_logModel->get_company_id($value['village_id'],$value['project_id'],date('Y',$value['record_check_time']));
            if($company_id!=$value['company_id']){
                echo '条目id:'.$value['record_id'].';正确公司id:'.$company_id.';当前公司id:'.$value['company_id'].'<br/>';
            }
        }*/
        $log_list=M('budget_log')->where(array('log_time'=>2018))->select();
        foreach ($log_list as $value){
            $where=array('village_id'=>$value['village_id'],'log_time'=>2018,'company_id'=>array('neq',$value['company_id']),'type_id'=>$value['type_id']);
            if(!empty($value['project_id'])) $where['project_id']=$value['project_id'];
            $other_log=M('budget_log')->where($where)->find();
            if($other_log){
                echo '原条目id:'.$value['log_id'].';新条目id:'.$other_log['log_id'].';类型id:'.$value['type_id'].';当前公司id:'.$value['company_id'].'<br/>';
/*                $budget_logModel->change_log_one($value['type_id'],$value['village_id'],$value['company_id'],$value['project_id'],$value['log_time']);*/
            }
        }
    }

    /**
     * @author zhukeqin
     * 批量更新执行记录
     */
    public function execute()
    {
        if($_POST){
            //$village_id = $_POST['village_id'];
            $data = $_POST;
            if(!empty($data['project_id']) && $data['project_id']!='0'){
                $record = M('budget_record')->where(array('village_id'=>$data['village_id']))->select();
                foreach($record as $v){
                    //添加project_id
                    if($v['project_id'] == null){
                        $where = array(
                            'record_id'=>$v['record_id'],
                            'village_id'=>$v['village_id'],
                        );
                        M('budget_record')->where($where)->save(array('project_id'=>$data['project_id']));
                    }
                }
                $record_info = M('budget_record')->where(array('village_id'=>$data['village_id'],'project_id'=>$data['project_id']))->select();
            }else{
                $record_info = M('budget_record')->where(array('village_id'=>$data['village_id']))->select();
            }
//            dump($record_info);die;
            foreach($record_info as $v){
                if($v['record_status'] == "2"){
//                    echo 1 ."<br/>";
//                    跨年更新处理
                    $budget_log = D('Budget_log');
                    $res[$v['record_id']][]=$budget_log->change_log_one($v['type_id'],$v['village_id'],$v['company_id'],$v['project_id'],date('Y',$v['record_check_time']));
                }
            }
            dump($res);
        }else{
            //取出所有项目
            $data = M('budget_record')->alias('a')
                ->join('left join pigcms_house_village b ON a.village_id=b.village_id')
                ->field('b.village_id,b.village_name,b.village_type')
                ->group('a.village_id')
                ->select();
            $this->assign('data',$data);
            $this->display('budget_execute');
        }
    }

    /**
     * @author zhukeqin
     * 获取小区信息
     */
    public function Budget_project_info()
    {
        $village_id = $_POST['village_id'];
        $project = M('house_village_project')->where(array('village_id'=>$village_id))->field('pigcms_id,desc')->select();
        echo json_encode($project);
    }

}