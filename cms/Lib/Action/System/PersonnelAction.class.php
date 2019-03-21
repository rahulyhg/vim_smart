<?php
/**
 * Created by PhpStorm.
 * User: zhukeqin
 * Date: 2018/11/12
 * Time: 15:06
 */
class PersonnelAction extends BaseAction{
    public function __construct()
    {
        parent::__construct();
    }

    public function personnel_list_news(){
        /*if($_SESSION['system']['account'] !=SUPER_ADMIN){
            $admin_array = M('admin')->where(array('id'=>$_SESSION['system']['id']))->find();
            if($admin_array['company_id']==0&&$admin_array['village_id']!=0){
                $where_data['village_id'] = array('eq',$admin_array['village_id']);
            }elseif ($admin_array['company_id']!=0&&$admin_array['village_id']!=0){
                $where_data['village_id'] = array('eq',$admin_array['village_id']);
                $where_data['company_id'] = array('eq',$admin_array['company_id']);
            }
        }
        $where_data['status']=array('eq',1);
        import('@.ORG.system_page');

        //多角色修改  start
        $count_user=M('admin')
            ->alias('a')
            ->where($where_data)
            ->count();
        $p=new Page($count_user,15,'page');
        $user_arr['user_list']=M('admin')
            ->alias('a')
            ->field('a.*')
            ->where($where_data)
            ->order('id desc')
            ->limit($p->firstRow.','.$p->listRows)
            ->select();
        foreach ($user_arr['user_list'] as &$v) {
            $role_idArr = explode(',',$v['role_id']);
            foreach ($role_idArr as $vv) {
                $role_name = D('role')->where(array('role_id'=>$vv))->getField('role_name');
                $v['role_name'] .= $role_name.',';
            }
            $v['role_name'] = trim($v['role_name'],',');
        }
        unset($v);
        //update end

        $user_arr['pagebar']=$p->show();
        $this->assign('user_arr',$user_arr);	*/
        //print_r($this->departmentTree($list_tree=''));	//部门树形分类列表
        //$this->assign('department_tree',$this->departmentTree($list_tree=''));
        $department_info=M('department')->where('pid=0')->field('id,deptname')->find();
        $this->assign('department_info',$department_info);
        $this->display('personnel_list');
    }

    /**
     * @author zhukeqin
     * ajax获取员工列表
     */
    public function ajax_personnel_list(){
        //时间戳相关
        $now=time();
        $thismonth_start=strtotime(date('Y-m'));//本月开始时间
        $thismonth_end=strtotime(date('Y-m-t'))+24*3600-1;//本月结束时间
        $departmentModel=new DepartmentModel();
        $personnel_contractModel=new Personnel_contractModel();
        $personnel_annualModel=new Personnel_annualModel();
        $personnel_positionModel=new Personnel_positionModel();
        $start=I('post.start');
        $length=I('post.length');
        //datatable适配  -1则代表显示全部信息
        if($length==-1){
            unset($length);
        }
        $where_data=array('status'=>1);
        //搜索类型
        if(!empty($_GET['search_type'])){
            $search_type=$_GET['search_type'];
            switch ($search_type){
                case 1:$where_data['social_addtime']=array('BETWEEN',array($thismonth_start,$thismonth_end)) ;break;
                case 2:$where_data['accumulation_addtime']=array('BETWEEN',array($thismonth_start,$thismonth_end)) ; break;
            }
        }
        if(!empty($_POST['search']['value'])){
            $search_value='%'.$_POST['search']['value'].'%';
            $where_data['name|phone|id_number']=array('LIKE',$search_value);
        }
        if(!empty($_GET['department_id'])&&$_GET['department_id']!='null'){
            //$child_arr=M('department')->where(array('path'=>array('like','%'.$_GET['department_id'].'%')))->field('id')->select();
            $child_arr=M('department')->where(array('_string'=>'find_in_set('.$_GET['department_id'].',path)'))->field('id')->select();
            $ids_str=array();
            if($child_arr && is_array($child_arr)){		//判断是否存在子类
                foreach($child_arr as $val){
                    $ids_str[]=$val['id'];
                }
                $ids_str[]=trim($_GET['department_id']);
                $where_data['department_id']=array('in',$ids_str);
            }else{
                $where_data['department_id']=intVal($_GET['department_id']);
            }
        }
        if($search_type==3){
            $where_data['entry_time']=array('egt',strtotime('-7 month'));
            $where_data['_string']='trim(induction_channel) !=""';
            $personnel_list_all=M('Personnel')->where($where_data)->select();
            $time_huidehang_start=strtotime('-3 month',$thismonth_start);
            $time_huidehang_end=strtotime('-3 month',$thismonth_end);
            $time_liangjiang_start=strtotime('-6 month',$thismonth_start);
            $time_liangjiang_end=strtotime('-6 month',$thismonth_end);
            foreach ($personnel_list_all as $key=>$value){
                $village_info=$departmentModel->get_department_village($value['department_id']);
                if(!empty($village_info['group_id'])){
                    if($village_info['group_id']==1){
                        $personnel_position=$personnel_positionModel->get_position_one(array('personnel_id'=>$value['personnel_id']))['position_now'];
                        if($value['entrytime']>$time_huidehang_start&&$value['entrytime']<$time_huidehang_end&&$personnel_position=='秩序员'){
                            $personnel_list[]=$value;
                        }
                    }
                    if($village_info['group_id']==2){
                        if($value['entrytime']>$time_liangjiang_start&&$value['entrytime']<$time_liangjiang_end){
                            $personnel_list[]=$value;
                        }
                    }
                }
            }
        }else{
            $personnel_list=M('Personnel')->where($where_data)->limit($start,$length)->select();
        }
        if(empty($personnel_list)) {
            $personnel_list = array();
        }else{
            foreach ($personnel_list as $key=>$value){
                $personnel_cache=array();
                $personnel_cache['name']=$value['name'];
                $department_info=D('Department')->get_department_one(array('id'=>$value['department_id']));
                $path_list=explode(',',$department_info['path']);
                if(empty($path_list['4'])) $path_list['4']=$department_info['id'];
                $department_info_one=$departmentModel->get_department_one(array('id'=>$path_list['4']));
                /*$department_info_two=$departmentModel->get_department_one(array('id'=>$path_list['5']));
                if($department_info_two['deptname']=='项目部'){
                    $department_info_two=$departmentModel->get_department_one(array('id'=>$path_list['6']));
                }*/
                $personnel_cache['department_name']=$department_info_one['deptname'];

                $personnel_cache['position']=$personnel_positionModel->get_position_one(array('personnel_id'=>$value['personnel_id']))['position_now'];
                $personnel_cache['social_addtime']=is_numeric($value['social_addtime'])?date('Y-m-d',$value['social_addtime']):$value['social_addtime'];
                $personnel_cache['social_condition']=$value['social_condition'];
                $personnel_cache['accumulation_addtime']=is_numeric($value['accumulation_addtime'])?date('Y-m-d',$value['accumulation_addtime']):$value['accumulation_addtime'];
                $personnel_cache['entrytime']=is_numeric($value['entrytime'])?date('Y-m-d',$value['entrytime']):$value['entrytime'];
                $personnel_cache['positivetime']=is_numeric($value['positivetime'])?date('Y-m-d',$value['positivetime']):$value['positivetime'];
                //合同信息
                $contract_info=$personnel_contractModel->get_contract_one(array('personnel_id'=>$value['personnel_id']));
                $personnel_cache['contract_end']=date('Y-m-d',$contract_info['time_end']);
                //年假剩余
                $year=date('Y');
                $annual_strat=strtotime('+1 year',$value['entrytime']);
                if($now<$annual_strat){
                    $personnel_cache['annual_residue']='<span style="color: red">暂无年假</span>';
                }else{
                   /* $day=date('m-d',$value['entrytime']);
                    if($now<strtotime($year.'-'.$day)) $year--;
                    $annual_year_start=strtotime($year.'-'.$day);
                    $annual_year_end=strtotime(($year+1).'-'.$day);
                    $last_annual=$personnel_annualModel->get_annual_one(array('personnel_id'=>$value['personnel_id'],'updatetime'=>array('BETWEEN',array($annual_year_start,$annual_year_end))),'updatetime desc');
                    $value['annual_day']=$personnel_annualModel->get_annual_day($value['personnel_id'])['data'];
                    $annual_residue_last=$last_annual?$last_annual['annual_residue']:$value['annual_day'];
                    $personnel_cache['annual_residue']=$annual_residue_last;*/
                    $personnel_cache['annual_residue']=$personnel_annualModel->get_annual_residue($value['personnel_id'],'')['data'];
                }


                $admin_info=M('admin')->where(array('id'=>$value['admin_id'],'status'=>1))->find();
                if(empty($admin_info)){
                    $personnel_cache['admin_type']='<span style="color: red;">暂无后台账号</span>';
                }else{
                    $personnel_cache['admin_type']=$admin_info['account'];
                }
                $url=U('Personnel/personnel_edit',array('personnel_id'=>$value['personnel_id']));
                $url_contract=U('Personnel/personnel_contract_list',array('personnel_id'=>$value['personnel_id']));
                $url_annual=U('Personnel/personnel_annual_list',array('personnel_id'=>$value['personnel_id']));
                $url_position=U('Personnel/personnel_position_list',array('personnel_id'=>$value['personnel_id']));
                $personnel_cache['action']=<<<EOT
                    
                    <div class="btn-group">
                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-left" role="menu" style="position:relative; margin-left:-90px;">
                            <li>
                                <a href="{$url}">
                                    <i class="icon-tag"></i> 信息编辑 </a>
                            </li>
                            <li>
                                <a href="{$url_contract}" data-toggle="modal" data-target="#modal_add">
                                    <i class="icon-tag"></i> 合同编辑 </a>
                            </li>
                            <li>
                                <a href="{$url_annual}" data-toggle="modal" data-target="#modal_add">
                                    <i class="icon-tag"></i> 年假编辑 </a>
                            </li>
                            <li>
                                <a href="{$url_position}" data-toggle="modal" data-target="#modal_add">
                                    <i class="icon-tag"></i> 职位编辑 </a>
                            </li>
                            <li>
                                <a onclick="delete_pr_info(this)" id="{$value['personnel_id']}">
                                    <i class="icon-tag"></i> 删除 </a>
                            </li>

                    </ul>
                    </div>
                    
EOT;
                $personnel_list[$key]=$personnel_cache;

            }
        }
        $personnel_count=M('Personnel')->where($where_data)->count();
        unset($where_data['name|phone|id_card']);
        $personnel_dimcount=M('Personnel')->where($where_data)->count();
        $result_array=array(
            'draw'=>intval(I('post.draw')),
            'recordsTotal'=>$personnel_count,
            'recordsFiltered'=>$personnel_dimcount,
            'data'=>$personnel_list
        );
        echo json_encode($result_array);
    }

    /**
     * @author zhukeqin
     * 个人信息修改
     */
    public function personnel_edit(){
        $personnel=new PersonnelModel();
        $personnel_contract=new Personnel_contractModel();
        $idVal=intVal(I('get.personnel_id'));
        if(IS_POST){
            $data=$_POST;
            if($_POST['admin_get']==3){
                $admin_info=$data['admin_info'];
                $admin_info['realname']=$data['name'];
                $admin_info['phone']=$data['phone'];
                $admin_info['phone']=$data['phone'];
                $admin_info['project_id']=explode('-',$admin_info['village_id'])['1'];
                $admin_info['village_id']=explode('-',$admin_info['village_id'])['0'];
                $re_admin=D('Admin')->admin_save($admin_info);
                if($re_admin['err']==1) $this->error($re_admin['data']);
                if($re_admin['err']==0) $data['admin_id']=$re_admin['data'];
            }elseif($_POST['admin_get']==1){
                $data['admin_id']='';
            }
            if(!empty($data['entrytime']))$data['entrytime']=strtotime($data['entrytime']);
            if(!empty($data['positivetime']))$data['positivetime']=strtotime($data['positivetime']);
            if(!empty($data['social_addtime']))$data['social_addtime']=strtotime($data['social_addtime']);
            if(!empty($data['accumulation_addtime']))$data['accumulation_addtime']=strtotime($data['accumulation_addtime']);
            $re=$personnel->change_personnel_one($data,$idVal);
            if(empty($idVal)) $idVal=$re['data'];
            if(!empty($data['contract'])&&$re['err']==0){
                if(!empty($data['contract']['time_start']))$data['contract']['time_start']=strtotime($data['contract']['time_start']);
                if(!empty($data['contract']['time_start']))$data['contract']['time_end']=strtotime($data['contract']['time_end']);
                $re=$personnel_contract->change_contract_one($data['contract'],$data['contract']['personnel_contract_id']);
            }
            if($re['err']==1) $this->error($re['data']);
            if($re['err']==0) $this->success('上传成功',U('Personnel/personnel_list_news'));
        }else{
            if(!empty($idVal)){
                $personnel_info=$personnel->get_personnel_one(array('personnel_id'=>$idVal));
                if(empty($personnel_info)) $this->error('没有该人员');
                if(!empty($personnel_info['admin_id'])) $personnel_info['admin_info']=M('admin')->where(array('id'=>$personnel_info['admin_id']))->find();
                $personnel_info['admin_info']['role_id']=explode(',',$personnel_info['admin_info']['role_id']);
                //查询其昵称名
                $nickname = M('user')->getFieldByOpenid($personnel_info['admin_info']['openid'],'nickname');
                $personnel_info['admin_info']['nickname']=$nickname;
                $this->assign('personnel_info',$personnel_info);

                $personnel_contract_info=$personnel_contract->get_contract_one(array('personnel_id'=>$idVal));
                $this->assign('personnel_contract_info',$personnel_contract_info);
            }



            $department_list=M('department')->order('add_time asc')->select();	//部门列表
            foreach($department_list as $k=>&$v){
                $v['text']=$v['deptname'];
                //$v['url']='<a href="'.U('House/employee',array('department_id'=>$v['id'])).'"></a>';
            }
            $list_tree=$this->list_to_tree($department_list,$pk='id',$pid='pid',$child='children',$root=0,$key='');
            $departmentLogic = D('Department','Logic');
            $optionArray = $departmentLogic->tree_array_to_option($list_tree);
            $role_list=M('role')->field('role_id,role_name')->select();
            $village_list=M('house_village')->field('village_id,village_name,village_type')->order('village_id DESC')->select();
            foreach ($village_list as $key=>$value){
                if($value['village_type']==1){
                    $village_list[$key]['project_list']=M('house_village_project')->where(array('village_id'=>$value['village_id']))->select();
                }
            }
            $this->assign('department_categorys',$optionArray);	//部门分类列表
            $this->assign('role_list',$role_list);	//角色列表
            $this->assign('village_list',$village_list);	//社区列表

            $admin_list=M('admin')->where(array('status'=>1,'account'=>array('neq','admin')))->select();
            $this->assign('admin_list',$admin_list);

            $department_id=intVal(I('get.department_id'));
            $this->assign('department_id',$department_id);

            $group_list=M('house_village_group_list')->select();
            $this->assign('group_list',$group_list);
            $this->display();
        }
    }

    /**
     * @author zhukeqin
     * 某一个员工劳动合同列表
     */
    public function personnel_contract_list(){
        $idVal=intVal(I('get.personnel_id'));
        if(empty($idVal)) {
            $this->error_new('参数不正确');
        };
        $personnel_contract=new Personnel_contractModel();
        $personnel_contract_list=$personnel_contract->get_contract_list(array('personnel_id'=>$idVal),'time_end desc');
        $this->assign('contract_list',$personnel_contract_list);
        $this->assign('personnel_id',$idVal);
        $this->display();
    }

    /**
     * @author zhukeqin
     * 合同新增或修改
     */
    public function personnel_contract_edit(){
        $idVal=intVal(I('get.contract_id'));
        $personnel_contract=new Personnel_contractModel();
        if(IS_POST){
            $data=$_POST;
            $data['time_start']=strtotime($data['time_start']);
            $data['time_end']=strtotime($data['time_end']);
            if(!empty(I('get.personnel_id'))){
                $data['personnel_id']=intVal(I('get.personnel_id'));
            }
            $re=$personnel_contract->change_contract_one($data,$idVal);
            if($re['err']==1) $this->error($re['data']);
            if($re['err']==0) $this->success('上传成功',U('Personnel/personnel_list_news'));
        }else{
            $personnel_contract_info=$personnel_contract->get_contract_one(array('personnel_contract_id'=>$idVal));
            $this->assign('contract_info',$personnel_contract_info);
            $this->display();
        }

    }


    /**
     * @author zhukeqin
     * 历史职位列表
     */
    public function personnel_position_list(){
        $idVal=intVal(I('get.personnel_id'));
        if(empty($idVal)) {
            echo "参数不正确";
            die;
        };
        $personnel_position=new Personnel_positionModel();
        $personnel_position_list=$personnel_position->get_position_list(array('personnel_id'=>$idVal),'time_change desc');
        $this->assign('position_list',$personnel_position_list);
        $this->assign('personnel_id',$idVal);
        $this->display();
    }
    /**
     * @author zhukeqin
     * 职位变更
     */
    public function personnel_position_edit(){
        $idVal=intVal(I('get.personnel_id'));
        $personnel_position_id=intVal(I('get.position'));
        $personnel_position=new Personnel_positionModel();
        if(IS_POST){
            $data=$_POST;
            $data['time_change']=strtotime($data['time_change']);
            if(I('get.personnel_id')){
                $data['personnel_id']=intVal(I('get.personnel_id'));
            }
            $re=$personnel_position->change_position_one($data,$personnel_position_id);
            if($re['err']==1) $this->error($re['data']);
            if($re['err']==0) $this->success('上传成功',U('Personnel/personnel_list_news'));
        }else{
            $personnel_position_last=$personnel_position->get_position_one(array('personnel_id'=>$idVal));
            $personnel_position_info=$personnel_position->get_position_one(array('personnel_position_id'=>$personnel_position_id));
            $this->assign('position_info',$personnel_position_info);
            $this->assign('position_last',$personnel_position_last);
            $this->display();
        }

    }
    /**
     * @author zhukeqin
     * 年假详情
     */
    public function personnel_annual_list(){
        $idVal=intVal(I('get.personnel_id'));
        if(empty($idVal)) {
            echo "参数不正确";
            die;
        };
        define('IS_AJAX',false);
        $personnel=new PersonnelModel();
        $personnel_info=$personnel->get_personnel_one(array('personnel_id'=>$idVal));
        if(empty($personnel_info['entrytime'])){
            $this->error_new('该员工没有入职时间，无法进行年假操作');
            /*echo '该员工没有入职时间，无法进行年假操作';
            die;*/
        }
        //入职满一年才能有年假
        $annual_strat=strtotime('+1 year',$personnel_info['entrytime']);
        if(time()<$annual_strat){
            $this->error_new('该员工入职尚未满一年，无法进行年假操作');
            /*echo '该员工入职尚未满一年，无法进行年假操作';
            die;*/
        }
        $personnel_annual=new Personnel_annualModel();
        $personnel_annual_list=$personnel_annual->get_annual_list(array('personnel_id'=>$idVal),'updatetime desc');
        $this->assign('personnel_id',$idVal);
        $this->assign('personnel_annual_list',$personnel_annual_list);
        $this->display();
    }
    /**
     * @author zhukeqin
     * 使用年假
     */
    public function personnel_annual_edit(){
        $idVal=intVal(I('get.personnel_id'));
        $personnel_annual=new Personnel_annualModel();
        if(IS_POST){
            $use_day=$_POST['use_day'];
            if(!empty($_POST['updatetime'])){
                $updatetime=strtotime($_POST['updatetime']);
            }else{
                $updatetime=time();
            }
            $remark=$_POST['remark'];
            $re=$personnel_annual->add_annual_one($idVal,$use_day,$updatetime,$remark);
            if($re['err']==1) $this->error($re['data']);
            if($re['err']==0) $this->success('上传成功',U('Personnel/personnel_list_news'));
        }else{
            $personnel_info=D('Personnel')->get_personnel_one(array('personnel_id'=>$idVal));
            if(empty($personnel_info)){
                $this->error_new('该员工不存在');
            }
            $now=time();
            $year=date('Y');
            $annual_strat=strtotime('+1 year',$personnel_info['entrytime']);
            if($now<$annual_strat){
                $this->error_new('该员工入职尚未满一年，无法进行年假操作');
            }
            $day=date('m-d',$personnel_info['entrytime']);
            /*if($now<strtotime($year.'-'.$day)) $year--;
            $annual_year_start=strtotime($year.'-'.$day);
            $annual_year_end=strtotime((++$year).'-'.$day);
            $last_annual=$personnel_annual->get_annual_one(array('personnel_id'=>$idVal,'updatetime'=>array('BETWEEN',array($annual_year_start,$annual_year_end))),'updatetime desc');
            $annual_residue_last=$last_annual?$last_annual['annual_residue_last']:$personnel_info['annual_day'];*/
            $annual_residue_last=$personnel_annual->get_annual_residue($idVal,'')['data'];
            $this->assign('annual_residue_last',$annual_residue_last);
            $this->assign('day',$day);
            $this->display();
        }
    }

    /**
     * @author zhukeqin
     * 提醒列表
     */
    public function personnel_check_list(){
        $now=$_GET['time']?$_GET['time']:date('Y-m');
        $personnel_group=D('Personnel_group')->get_group_one(array('admin_id'=>$_SESSION['system']['id']))['group_id'];
        $personnel_group=$_GET['group_id']?$_GET['group_id']:$personnel_group;
        if($personnel_group=='all') $personnel_group='';
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
        $group_list=M('house_village_group_list')->select();
        $this->assign('group_list',$group_list);
        $this->assign('group_id',$personnel_group);
        $this->assign('time',$now);

        $this->display();
    }

    /**
     * @author zhukeqin
     * 管理员控制
     */
    public function group_list(){
        if(IS_POST){
            $data=$_POST;
            $personnel_groupModel=new Personnel_groupModel();
            foreach ($data as $value){
                $value['admin_id']=M('admin')->where(array('realname'=>$value['realname']))->find()['id'];
                $re=$personnel_groupModel->change_group_one($value['group_id'],$value['admin_id']);
            }
            $this->success('提交成功！');
        }else{
            $group_list=M('house_village_group_list')
                ->alias('gl')
                ->field('gl.*,g.admin_id,ad.realname')
                ->join('left join __PERSONNEL_GROUP__ g on g.group_id=gl.group_id')
                ->join('left join __ADMIN__ ad on ad.id=g.admin_id')
                ->select();
            $this->assign('group_list',$group_list);
            $this->display();
        }
    }

    /**
     * @author zhukeqin
     * ajax获取管理员信息  用于自动补全
     */
    public function ajax_admin_list(){
        $keyword=$_POST['keyword'];
        $where=array('realname'=>array('like','%'.$keyword.'%'));
        $admin_list=M('admin')->where($where)->select();
        $result=array();
        foreach ($admin_list as $key=>$value){
            $result[]=array('title'=>$value['realname'],'result'=>$value);
        }
        echo json_encode(array('data'=>$result));
    }

    /**
     * @author zhukeqin
     * 使用excel导入人员信息
     */
    public function add_personnel_excel(){
        if(IS_POST){
            //PHPExcel_Shared_Date::ExcelToPHP($value['4']);
            $education=array( '1'=>'小学', '2'=>'初中','3'=>'高中','4'=>'中专','5'=>'大专','6'=>'本科','7'=>'研究生','8'=>'博士');
            $politics=array( '1'=>'中共党员', '2'=>'中共预备党员','3'=>'共青团员','4'=>'民革党员','5'=>'民盟盟员','6'=>'民建会员','7'=>'民进会员','8'=>'农工党党员','9'=>'致公党党员','10'=>'九三学社社员','11'=>'台盟盟员','12'=>'无党派人士','13'=>'普通居民');
            $marital=array('1'=>'未婚','2'=>'已婚','3'=>'离异');
            $group_id=$_POST['group_id'];
            $arr1 = import_excel_sheet_one($_FILES['test'],'AQ','','0');
            if(empty($arr1)) $this->error('文件不能为空');
            $err=array();
            $department_id='';
            $department_name='';
            $personnelModel=new PersonnelModel();
            $personnel_annualModel=new Personnel_annualModel();
            $personnel_contractModel=new Personnel_contractModel();
            $personnel_positionModle=new Personnel_positionModel();
            foreach ($arr1 as $key=>$value){
                if(strstr($value['0'],'单位名称')){
                    unset($department_id);
                    preg_match_all('/\(?（?\d{2}(.*?)\)?）?/', $value['0'], $match);
                    $department_name=$match['1']['0'];
                    $department_info=M('department')->where(array('deptname'=>array('LIKE','%'.$department_name.'%')))->find();
                    if(empty($department_info)&&$department_name!='职能中心'){
                        $err[]=$department_name.'该部门不存在，请检查';
                        continue;
                    }else{
                        $department_id=$department_info['id'];
                        if(empty($department_id)) $department_id=1;
                    }
                }elseif(is_numeric($value['0'])){
                    if(empty($department_id)) continue;
                    $personnel=array();
                    $personnel_annual=array();
                    $personnel_contract=array();
                    $personnel_position=array();
                    if($value['4']=='公司'){
                        if($value['5']=='领导'){
                            if($value['7']=='执行总裁'||$value['7']=='副总裁'){
                                $personnel['department_id']=69;
                            }else{
                                $cache=str_replace('总经理','',$value['7']);
                                $cache_de=M('department')->where(array('deptname'=>array('LIKE','%'.$cache.'%')))->find();
                                $cache_department=M('department')->where(array('deptname'=>'公司领导','pid'=>$cache_de['id']))->find();
                                $personnel['department_id']=$cache_department['id'];
                            }
                        }else{
                            $cache_department=M('department')->where(array('deptname'=>$value['5']))->find();
                            $personnel['department_id']=$cache_department['id'];
                        }
                    }else{
                        //查找是否有子部门，没有就归属根部门
                        $department_child_list=M('department')->where(array('pid'=>$department_id))->select();
                        if(empty($department_child_list)){
                            $personnel['department_id']=$department_id;
                        }else{
                            $cache_department=M('department')->where(array('deptname'=>array('LIKE','%'.$value['5'].'%'),'pid'=>$department_id))->find();
                            if(empty($cache_department)){
                                $personnel['department_id']=$department_id;
                            }else{
                                $personnel['department_id']=$cache_department['id'];
                            }
                        }

                    }

                    $personnel['job_number']=$value['1'];
                    $personnel['name']=$value['2'];
                    $personnel['sex']=$value['3']=='男'?1:2;
                    $personnel['position']=$value['6'];
                    $personnel['entrytime']=is_numeric($value['12'])?PHPExcel_Shared_Date::ExcelToPHP($value['12']):$value['12'];
                    $personnel['positivetime']=is_numeric($value['14'])?PHPExcel_Shared_Date::ExcelToPHP($value['14']):$value['14'];
                    $personnel['social_addtime']=is_numeric($value['16'])?PHPExcel_Shared_Date::ExcelToPHP($value['16']):$value['16'];
                    $personnel['social_condition']=$value['17'];
                    $personnel['accumulation_addtime']=is_numeric($value['18'])?PHPExcel_Shared_Date::ExcelToPHP($value['18']):$value['18'];
                    $personnel['accumulation_money']=$value['19'];
                    $personnel['id_number']=$value['23'];
                    $personnel['height']=$value['26'];
                    $personnel['education']=array_search($value['27'],$education)?:'0';
                    if($personnel['education']=='0') $personnel['education_remark']=$value['27'];
                    $personnel['graduat_school']=$value['28'];
                    $personnel['learning_type']=$value['29'];
                    $personnel['major']=$value['30'];
                    $personnel['certification']=$value['31'];
                    $personnel['native_place']=$value['32'];
                    $personnel['politics']=array_search($value['33'],$politics)?:'13';
                    $personnel['marital']=array_search($value['34'],$marital)?:'1';
                    $personnel['phone']=$value['35'];
                    $personnel['family_address']=$value['36'];
                    $personnel['family_phone']=$value['37'];
                    $personnel['main_experience']=$value['38'];
                    $personnel['enlist']=$value['39'];
                    $personnel['induction_channel']=$value['40'];
                    $personnel['job_remark']=$value['41'];
                    $personnel['group_id']=$group_id;
                    $re=$personnelModel->change_personnel_one($personnel,'');
                    if($re['err']==1) $err[]=($key+1).'行'.$re['data'];
                    if($re['err']==0){
                        $personnel_contract['time_start']=is_numeric($value['20'])?PHPExcel_Shared_Date::ExcelToPHP($value['20']):$value['20'];
                        $personnel_contract['time_end']=is_numeric($value['21'])?PHPExcel_Shared_Date::ExcelToPHP($value['21']):$value['21'];
                        $personnel_contract['personnel_id']=$re['data'];
                        $re_contract=$personnel_contractModel->change_contract_one($personnel_contract,'');
                        if($re_contract['err']==1) $err[]=($key+1).'行'.$re_contract['data'];

                        $re_position=$personnel_positionModle->change_position_one(array('personnel_id'=>$re['data'],'position_now'=>$value['7'],'time_change'=>time()),'');
                        if($re_position['err']==1) $err[]=($key+1).'行'.$re_position['data'];

                        //绑定admin表中的账号
                        $admin_id=M('admin')->where(array('realname'=>$personnel['name'],'department_id'=>$personnel['department_id']))->find()['id'];
                        if(!empty($admin_id)) M('personnel')->where(array('personnel_id'=>$re['data']))->data(array('id'=>$admin_id))->save();

                    }




                }
            }
            if(count($err)==0){
                $this->success('导入成功');
            }else{
                echo "<center>";
                echo "以下行数有对应问题，请处理之后再单独导入</br>";
                foreach ($err as $value){
                    echo $value."</br>";
                }
                echo "</center>";
            }
        }else{
            $group_list=M('house_village_group_list')->select();
            $this->assign('group_list',$group_list);
            $this->display();
        }
    }
    /**
     * 树形结构方法
     * @param $list
     * @param string $pk
     * @param string $pid
     * @param string $child
     * @param int $root
     * @param string $key
     * @return array
     */
    public function list_to_tree($list,$pk='id',$pid='pid',$child='_child',$root=0,$key=''){
        // 创建Tree
        $tree=array();
        if(is_array($list)){
            // 创建基于主键的数组引用
            $refer=array();
            foreach($list as $k=>$data){
                $refer[$data[$pk]]=&$list[$k];//即$refer[id的值]
            }
            foreach($list as $k=>$data){
                // 判断是否存在parent
                $parentId=$data[$pid];//pid的值
                if($root==$parentId){
                    if($key!=''){
                        $tree[$data[$key]]=&$list[$k];
                    }else{
                        $tree[]=&$list[$k];
                    }
                }else{
                    if(isset($refer[$parentId])){
                        $parent=&$refer[$parentId];
                        if($key!=''){
                            $parent[$child][$data[$key]]=&$list[$k];
                        }else{
                            $parent[$child][]=&$list[$k];
                        }
                    }
                }
            }
        }
        return $tree;
    }

    public function demo(){
        /*$personnelModel=new PersonnelModel();
        dump($personnelModel->send_personnel_list());*/
        $timeModel=new DateModel();
        dump($timeModel->change_date($_GET['date'],$_GET['num'],'month','','add',false,'Y-n-j',$_GET['defalutday']));
    }
}