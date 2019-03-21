<?php

/**
 * @author zhukeqin
 * 支出/收入详细记录控制器
 * Class Budget_recordModel
 */
class Budget_recordModel extends Model{

    /**
     * @author zhukeqin
     * @param $where
     * 取得符合要求的单条数据
     */

    public function get_record_one($where){
        $return=$this->where($where)->order('`record_id` ASC')->find();
        //dump(M()->_sql());
        return $return;

    }
    /**
     * @author zhukeqin
     * @param $where
     * @param $sort 排序方式
     * 取得符合要求的单条数据
     */
    public function  get_record_list($where,$sort='`record_id` ASC'){
        return $this->where($where)->order($sort)->select();

    }

    /**
     * @author zhukeqin
     * @param $data
     * 项目方新增/修改一条记录
     */
    public function  change_record_one($record,$village_id,$project_id){

        $village_info=D('House_village')->get_one($village_id);
        $company_info=D('Department')->get_department_one(array('id'=>$village_info['department_id']));
        if(empty($company_info)){
            return '当前选择的项目还没有分配公司，请先分配再提交！';
        }
        /*$type_info=D('Budget_type')->get_type_one(array('type_id'=>$record['type_id'],'type_rank'=>3));
        if(empty($type_info)){
            return '您没有选择正确的类目！请选择正确的三级类目';
        }*/
        $data['record_name']=$record['record_name'];
        $data['record_money']=$record['record_money'];
        $data['record_time']=$record['record_time'];
        if(!empty($record['record_file_path']))$data['record_file_path']=$record['record_file_path'];
        if(!empty($record['record_file_name']))$data['record_file_name']=$record['record_file_name'];
        $data['company_id']=$company_info['id'];
        $data['village_id']=$_SESSION['system']['village_id'];
        $data['record_remark']=$record['record_remark'];
        $data['record_status']='1';
        $data['record_create_time']=time();
        $data['record_create_id']=$_SESSION['admin_id'];
        if(!empty($project_id)){
            $data['project_id']=$project_id;
        }elseif(!empty($_SESSION['project_id'])){
            $data['project_id']=$_SESSION['project_id'];
        }
        if(!empty($data['type_id'])){
            $record_info=$this->get_record_one(array('record_id'=>$record['record_id']));
            if(empty($record_info)){
                return '您所选择更新的条目不存在请检查';
            }
            if($record_info['record_status']==2){
                return '该条类目已经审核成功，无法更改，如需更改，请联系财务';
            }
            $return=$this->where(array('record_id'=>$record['record_id']))->data($data)->save();
        }else{
            $return=$this->data($data)->add();
        }
        if($return){
            return 0;
        }else{
            return '插入/更新失败，请重试';
        }
    }
    /**
     * @author zhukeqin
     * @param $data
     * 财务审批
     **/
    public function  check_record_one($record,$record_id){
        $budget_logModel=new Budget_logModel();
        if(!empty($record['record_name']))$data['record_name']=$record['record_name'];
        if(!empty($record['record_money']))$data['record_money']=$record['record_money'];
        if(!empty($record['record_time']))$data['record_time']=$record['record_time'];
        if(!empty($record['record_remark']))$data['record_remark']=$record['record_remark'];
        $data['record_number']=$record['record_number'];
        if(!empty($record['type_id']))$data['type_id']=$record['type_id'];
        $data['record_check_remark']=$record['record_check_remark'];
        $data['record_audit_time']=time();
        $data['record_check_time']=$record['record_check_time']?strtotime($record['record_check_time']):time();
        $data['record_check_id']=$_SESSION['admin_id'];
        /*if($record['record_status']!=2&&$record['record_status']!=3){
            return '您所更改的状态不正确';
        }else{*/
            $data['record_status']=$record['record_status'];
        /*}*/
        $data['cashier_id']=implode(',',$record['cashier_id']);


        if(!empty($record_id)){
            $record_info=$this->get_record_one(array('record_id'=>$record_id));
            if(empty($record_info)){
                return '您所选择审核的条目不存在请检查';
            }
            if($record_info['record_status']==2){
                return '该条类目已经审核成功，无法更改';
            }
            //设置所属分公司
            $data['company_id']=$budget_logModel->get_company_id($record_info['village_id'],$record_info['project_id'],date('Y',$data['record_check_time']));
            $return=$this->where(array('record_id'=>$record_id))->data($data)->save();
        }else{
            return '您所选择审核的条目不存在请检查';
        }
        if(empty($record['type_id'])) $record['type_id']=$record_info['type_id'];
        if($return){
            if($record['record_status']==2){
                D('Budget_log')->change_log_one($record['type_id'],$record_info['village_id'],$record_info['company_id'],$record_info['project_id'],date('Y',$data['record_check_time']));
            }
            return 0;
        }else{
            return '插入/更新失败，请重试';
        }
    }

    /**
     * @author zhukeqin
     * @param $record
     * @param $village_id
     * @param $project_id
     * @return string
     * 财务增加一条收入
     */
    public function check_add_one($record,$village_id,$project_id){
        $village_info=D('House_village')->get_one($village_id);
        $company_info=D('Department')->get_department_one(array('id'=>$village_info['department_id']));
        if(empty($company_info)){
            return '当前选择的项目还没有分配公司，请先分配再提交！';
        }
        /*$type_info=D('Budget_type')->get_type_one(array('type_id'=>$record['type_id'],'type_rank'=>3));
        if(empty($type_info)){
            return '您没有选择正确的类目！请选择正确的三级类目';
        }*/
        $data['record_name']=$record['record_name'];
        $data['record_money']=$record['record_money'];
        $data['record_time']=$record['record_time']?$record['record_time']:date('Y-m-d');
        if(!empty($record['record_file_path']))$data['record_file_path']=$record['record_file_path'];
        if(!empty($record['record_file_name']))$data['record_file_name']=$record['record_file_name'];
        $data['company_id']=$company_info['id'];
        $data['village_id']=$village_id;
        $data['record_remark']=$record['record_remark'];
        $data['record_status']=$record['record_status']?$record['record_status']:'2';
        $data['record_create_time']=$record['record_create_time']?$record['record_create_time']:strtotime($data['record_time']);
        $data['record_create_id']=$_SESSION['admin_id'];
        if(!empty($project_id)){
            $data['project_id']=$project_id;
        }
        $data['record_number']=$record['record_number'];
        $data['type_id']=$record['type_id'];
        $data['record_check_remark']=$record['record_check_remark'];
        $data['record_check_time']=$record['record_check_time']?$record['record_check_time']:strtotime($data['record_time']);
        $data['record_audit_time']=$record['record_audit_time']?$record['record_audit_time']:strtotime($data['record_time']);
        $data['record_check_id']=$_SESSION['admin_id'];
        $data['cashier_id']=implode(',',$record['cashier_id']);
        $return=$this->data($data)->add();
        if($return){
            D('Budget_log')->change_log_one($record['type_id'],$village_id,$company_info['id'],$project_id,date('Y',$data['record_check_time']));
            return 0;
        }else{
            return '插入/更新失败，请重试';
        }
    }

    public function upload_file($file){
        $last=array_pop(explode('.',$file['name']));//获取文件后缀
        $filename=time().rand(1000,9999).'.'.$last;
        //检查是否存在同名文件
        while (file_exists("./upload/extension/" .$filename)){
            $filename=time().rand(1000,9999).'.'.$last;
        }
        $status=move_uploaded_file($file["tmp_name"],
            "./upload/extension/" . $filename);//保存文件
        if(!$status) {
            return false;
        }else{
            return "./upload/extension/" . $filename;
        }
    }

    /**
     * @author zhukeqin
     * @param $file
     * @param $village_id
     * @param $project_id
     * @param $year
     * @param string $modle 默认为全导，设置为0或空，则只导入预算
     * @return array|string
     *上传历史记录
     */
    public function update_history_log($file,$village_id,$project_id,$year,$modle='1'){
        if(empty($year)) $year=date('Y');
        $village_info=D('House_village')->get_one($village_id);
        $company_info=D('Department')->get_department_one(array('id'=>$village_info['department_id']));
        if(empty($company_info)){
            return '当前选择的项目还没有分配公司，请先分配再提交！';
        }
        $error=array();
        //人员支出
        $arr1 = import_excel_sheet_one($file,'','','1');
        foreach ($arr1 as $key1=>$value1){
            if($key1<4) continue;
            $type_name=str_replace(' ','',trim($value1['0']));
            if($type_name=='合计'||$type_name=='小计') continue;//合计
            $type_info=D('Budget_type')->get_type_one(array('type_name'=>$type_name,'type_rank'=>3));
            $type_id=$type_info['type_id'];
            if(empty($type_id)) {
                $error[]='人员支出第'.($key1+1).'行项目不存在或不为第三级项目';
                continue;
            }
            if($type_info['type_company_id']!=0&&!in_array($village_info['department_id'],explode(',',$type_info['type_company_id']))) {
                $error[]='人员支出第'.($key1+1).'行项目存在但不属于该公司，请重新设置';
                continue;
            }
            //更新预算
            $return1=D('Budget_money')->change_money_one($value1['1'],$type_id,$village_id,$company_info['id'],$year,$project_id);
            //插入历史记录
            if($modle){
                for ($i=0;$i<12;$i++){
                    $col=$i+3;//位移3列
                    $value1[$col]=str_replace(',','',$value1[$col]);//去除千分号
                    if(empty($value1[$col])) continue;

                    $data=array();
                    $data['record_name']=($i+1).'月'.$type_name;
                    $data['record_money']=$value1[$col];
                    $data['record_time']=strtotime($year.'-'.($i+1).'-2');
                    $data['record_remark']='数据初始化导入';
                    $data['record_create_time']=strtotime($year.'-'.($i+1).'-2');
                    $data['type_id']=$type_id;
                    $data['record_check_remark']='数据初始化导入';
                    $data['record_check_time']=strtotime($year.'-'.($i+1).'-2');
                    $data['record_audit_time']=$data['record_check_time'];
                    $this->check_add_one($data,$village_id,$project_id);
                }

            }
        }

        //公用经费
        $arr1 = import_excel_sheet_one($file,'','','2');
        foreach ($arr1 as $key1=>$value1){
            if($key1<4) continue;
            $type_name=str_replace(' ','',trim($value1['1']));
            if(empty($type_name)) $type_name=str_replace(' ','',trim($value1['0']));
            if($type_name=='合计'||$type_name=='小计') continue;//合计
            if($type_name=='其他'||$type_name=='其它'){
                $i=$key1;
                while(empty($arr1[$i]['0'])){
                    $i--;
                }
                $type_father_info=D('Budget_type')->get_type_one(array('type_name'=>$arr1[$i]['0'],'type_rank'=>2,'type_fid'=>2));
                $type_info=D('Budget_type')->get_type_one(array('type_name'=>$type_name,'type_rank'=>3,'type_fid'=>$type_father_info['type_id']));
            }else{
                $type_info=D('Budget_type')->get_type_one(array('type_name'=>$type_name,'type_rank'=>3));
            }
            $type_id=$type_info['type_id'];
            if(empty($type_id)) {
                $error[]='公用经费第'.($key1+1).'行项目不存在或不为第三级项目';
                continue;
            }
            if($type_info['type_company_id']!=0&&!in_array($village_info['department_id'],explode(',',$type_info['type_company_id']))) {
                $error[]='公用经费第'.($key1+1).'行项目存在但不属于该公司，请重新设置';
                continue;
            }
            //更新预算
            $return1=D('Budget_money')->change_money_one($value1['2'],$type_id,$village_id,$company_info['id'],$year,$project_id);
            //插入历史记录
            if($modle){
                for ($i=0;$i<12;$i++){
                    $col=$i+4;//位移4列
                    $value1[$col]=str_replace(',','',$value1[$col]);//去除千分号
                    if(empty($value1[$col])) continue;

                    $data=array();
                    $data['record_name']=($i+1).'月'.$type_name;
                    $data['record_money']=$value1[$col];
                    $data['record_time']=strtotime($year.'-'.($i+1).'-2');
                    $data['record_remark']='数据初始化导入';
                    $data['record_create_time']=strtotime($year.'-'.($i+1).'-2');
                    $data['type_id']=$type_id;
                    $data['record_check_remark']='数据初始化导入';
                    $data['record_check_time']=strtotime($year.'-'.($i+1).'-2');
                    $data['record_audit_time']=$data['record_check_time'];
                    $this->check_add_one($data,$village_id,$project_id);
                }

            }
        }

        //运行明细
        $arr1 = import_excel_sheet_one($file,'','','3');
        foreach ($arr1 as $key1=>$value1){
            if($key1<4) continue;
            $type_name=$type_name=str_replace(' ','',trim($value1['1']));;
            if(empty($type_name)) $type_name=str_replace(' ','',trim($value1['0']));
            if($type_name=='合计'||$type_name=='小计') continue;//合计
            if($type_name=='其他'||$type_name=='其它'){
                $i=$key1;
                while(empty($arr1[$i]['0'])){
                    $i--;
                }
                $type_father_info=D('Budget_type')->get_type_one(array('type_name'=>$arr1[$i]['0'],'type_rank'=>2,'type_fid'=>3));
                $type_info=D('Budget_type')->get_type_one(array('type_name'=>$type_name,'type_rank'=>3,'type_fid'=>$type_father_info['type_id']));
            }else{
                $type_info=D('Budget_type')->get_type_one(array('type_name'=>$type_name,'type_rank'=>3));
            }
            $type_id=$type_info['type_id'];
            if(empty($type_id)) {
                $error[]='运行明细第'.($key1+1).'行项目不存在或不为第三级项目';
                continue;
            }
            if($type_info['type_company_id']!=0&&!in_array($village_info['department_id'],explode(',',$type_info['type_company_id']))) {
                $error[]='运行明细第'.($key1+1).'行项目存在但不属于该公司，请重新设置';
                continue;
            }
            //更新预算
            $return1=D('Budget_money')->change_money_one($value1['2'],$type_id,$village_id,$company_info['id'],$year,$project_id);
            //插入历史记录
            if($modle){
                for ($i=0;$i<12;$i++){
                    $col=$i+4;//位移4列
                    $value1[$col]=str_replace(',','',$value1[$col]);//去除千分号
                    if(empty($value1[$col])) continue;

                    $data=array();
                    $data['record_name']=($i+1).'月'.$type_name;
                    $data['record_money']=$value1[$col];
                    $data['record_time']=strtotime($year.'-'.($i+1).'-2');
                    $data['record_remark']='数据初始化导入';
                    $data['record_create_time']=strtotime($year.'-'.($i+1).'-2');
                    $data['type_id']=$type_id;
                    $data['record_check_remark']='数据初始化导入';
                    $data['record_check_time']=strtotime($year.'-'.($i+1).'-2');
                    $data['record_audit_time']=$data['record_check_time'];
                    $this->check_add_one($data,$village_id,$project_id);
                }

            }
        }

        //收入明细
        $arr1 = import_excel_sheet_one($file,'','','4');
        foreach ($arr1 as $key1=>$value1){
            if($key1<4) continue;
            $type_name=$type_name=str_replace(' ','',trim($value1['1']));;
            if(empty($type_name)) $type_name=str_replace(' ','',trim($value1['0']));
            if($type_name=='合计'||$type_name=='小计') continue;//合计
            if($type_name=='其他'||$type_name=='其它'){
                $i=$key1;
                while(empty($arr1[$i]['0'])){
                    $i--;
                }
                $type_father_info=D('Budget_type')->get_type_one(array('type_name'=>$arr1[$i]['0'],'type_rank'=>2,'type_fid'=>4));
                $type_info=D('Budget_type')->get_type_one(array('type_name'=>$type_name,'type_rank'=>3,'type_fid'=>$type_father_info['type_id']));
            }else{
                $type_info=D('Budget_type')->get_type_one(array('type_name'=>$type_name,'type_rank'=>3));
            }
            $type_id=$type_info['type_id'];
            if(empty($type_id)) {
                $error[]='收入明细第'.($key1+1).'行项目不存在或不为第三级项目';
                continue;
            }
            if($type_info['type_company_id']!=0&&!in_array($village_info['department_id'],explode(',',$type_info['type_company_id']))) {
                $error[]='收入明细第'.($key1+1).'行项目存在但不属于该公司，请重新设置';
                continue;
            }
            //更新预算
            $return1=D('Budget_money')->change_money_one($value1['2'],$type_id,$village_id,$company_info['id'],$year,$project_id);
            //插入历史记录
            if($modle){
                for ($i=0;$i<12;$i++){
                    $col=$i+4;//位移4列
                    $value1[$col]=str_replace(',','',$value1[$col]);//去除千分号
                    if(empty($value1[$col])) continue;

                    $data=array();
                    $data['record_name']=($i+1).'月'.$type_name;
                    $data['record_money']=$value1[$col];
                    $data['record_time']=strtotime($year.'-'.($i+1).'-2');
                    $data['record_remark']='数据初始化导入';
                    $data['record_create_time']=strtotime($year.'-'.($i+1).'-2');
                    $data['type_id']=$type_id;
                    $data['record_check_remark']='数据初始化导入';
                    $data['record_check_time']=strtotime($year.'-'.($i+1).'-2');
                    $data['record_audit_time']=$data['record_check_time'];
                    $this->check_add_one($data,$village_id,$project_id);
                }

            }
        }
        //收入明细2
        $arr1 = import_excel_sheet_one($file,'','','5');
        foreach ($arr1 as $key1=>$value1){
            if($key1<4) continue;
            $type_name=$type_name=str_replace(' ','',trim($value1['1']));;
            if(empty($type_name)) $type_name=str_replace(' ','',trim($value1['0']));
            if($type_name=='合计'||$type_name=='小计') continue;//合计
            $type_info=D('Budget_type')->get_type_one(array('type_name'=>$type_name,'type_rank'=>3));
            $type_id=$type_info['type_id'];
            if(empty($type_id)) {
                $error[]='收入明细2第'.($key1+1).'行项目不存在或不为第三级项目';
                continue;
            }
            if($type_info['type_company_id']!=0&&!in_array($village_info['department_id'],explode(',',$type_info['type_company_id']))) {
                $error[]='收入明细2第'.($key1+1).'行项目存在但不属于该公司，请重新设置';
                continue;
            }
            //更新预算
            $return1=D('Budget_money')->change_money_one($value1['2'],$type_id,$village_id,$company_info['id'],$year,$project_id);
            //插入历史记录
            if($modle){
                for ($i=0;$i<12;$i++){
                    $col=$i+4;//位移4列
                    $value1[$col]=str_replace(',','',$value1[$col]);//去除千分号
                    if(empty($value1[$col])) continue;

                    $data=array();
                    $data['record_name']=($i+1).'月'.$type_name;
                    $data['record_money']=$value1[$col];
                    $data['record_time']=strtotime($year.'-'.($i+1).'-2');
                    $data['record_remark']='数据初始化导入';
                    $data['record_create_time']=strtotime($year.'-'.($i+1).'-2');
                    $data['type_id']=$type_id;
                    $data['record_check_remark']='数据初始化导入';
                    $data['record_check_time']=strtotime($year.'-'.($i+1).'-2');
                    $data['record_audit_time']=$data['record_check_time'];
                    $this->check_add_one($data,$village_id,$project_id);
                }

            }
        }
        if($error){
            return $error;
        }else{
            return '';
        }

    }

    /**
     * @author zhukeqin
     * @param $record_id
     * @param $data
     * @return string
     * 用于修改已经审核完成的条目
     */
    public function check_change_record($record_id,$data){
        //标记1
            $record_info=$this->get_record_one(array('record_id'=>$record_id));
            if(empty($record_info)) return '该条目不存在';
            $save['record_number']=$data['record_number'];
//            dump($data);
            if(!empty($data['record_check_time'])) {
                if(is_numeric($data['record_check_time'])){
                    $save['record_check_time']=$data['record_check_time'];
                }else{
                    $save['record_check_time']=strtotime($data['record_check_time']);
                }
            }
//            dump($data);
//            dump($save);
            $return=$this->where(array('record_id'=>$record_id))->data($save)->save();
            if($return){
                if(!empty($data['record_check_time'])){
                    //跨年更新处理
                    D('Budget_log')->change_log_one($record_info['type_id'],$record_info['village_id'],$record_info['company_id'],$record_info['project_id'],date('Y',$record_info['record_check_time']));
                    D('Budget_log')->change_log_one($record_info['type_id'],$record_info['village_id'],$record_info['company_id'],$record_info['project_id'],date('Y',$save['record_check_time']));
                }
                return '';
            }else{
                return '修改失败,请重试';
            }
    }

    /**
     * @author zhukeqin
     * @param $record_id
     * @return array
     * 删除一条记录不为驳回状态不能删除
     */
    public function check_delete_one($record_id){
        $record_info=$this->get_record_one(array('record_id'=>$record_id));
        if(empty($record_info)) return array('err'=>1,'msg'=>'您所选择的项目不存在');
        if($record_info['record_status']!=3) return array('err'=>1,'msg'=>'不为驳回状态，不能删除');
        $reurn=$this->where(array('record_id'=>$record_id))->delete();
        if($reurn){
            /**/
            /*$where=array(
                'type_id'=>$record_info['type_id'],
                'village_id'=>$record_info['village_id'],
                'status'=>2
            );
            if(!empty($record_info['project_id'])) $where['project_id']=$record_info['project_id'];
            $record_list=$this->get_record_list($where);
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
                $this->where(array('record_id'=>$value['record_id']))->data($data)->save();
            }*/
            /**/
            D('Budget_log')->change_log_one($record_info['type_id'],$record_info['village_id'],$record_info['company_id'],$record_info['project_id'],date('Y',$record_info['record_check_time']));
            return array('err'=>0,'msg'=>'删除成功');
        }else{
            return array('err'=>1,'msg'=>'删除失败');
        }
    }

    public function check_anti_one($record_id,$record_status){
        $record_info=$this->get_record_one(array('record_id'=>$record_id));
        if(empty($record_info)) return '您所选择的条目不存在';
        if($record_info['record_status']!=2) return '该该条目不为审核成功，无法进行反审核操作';
        if($record_status==2) return '不能修改成审核成功状态';
        $return=$this->data(array('record_status'=>$record_status))->where(array('record_id'=>$record_id))->save();
        if($return){
            D('Budget_record_history')->add_history_one($record_id,$record_info['record_status'],'反审核操作');
            $return=D('Budget_log')->change_log_one($record_info['type_id'],$record_info['village_id'],$record_info['company_id'],$record_info['project_id'],date('Y',$record_info['record_check_time']));
            if($return){
                return '';
            }else{
                return '更新缓存失败';
            }
        }else{
            return '状态更新失败，请重试';
        }
    }

}



?>