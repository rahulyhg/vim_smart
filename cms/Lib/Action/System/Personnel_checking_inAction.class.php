<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/11/30
 * Time: 10:22
 */
class Personnel_checking_inAction extends BaseAction{
    function __construct()
    {
        parent::__construct();
        $this->admin_info=$_SESSION['system'];
        $this->checking_inModel=new Personnel_check_inModel();
        $this->is_personnel=1;//是否是人事;
        $this->assign('is_personnel',$this->is_personnel);
    }

    /**
     * @author zhukeqin
     * 部门信息查看列表
     */
    public function checking_in_list_news(){
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
            }elseif(!empty($_SESSION['check_in_time'])){
                $starttime=$_SESSION['check_in_time']['starttime'];
                $endtime=$_SESSION['check_in_time']['endtime'];
            }else{
                //默认为当前月份
                $starttime=strtotime(date('Y-m'));
                $endtime=strtotime(date('Y-m-t'))+24*3600;
            }
            $_SESSION['check_in_time']=array('starttime'=>$starttime,'endtime'=>$endtime);
            //设定审核情况
            if(!empty(I('get.check_in_status'))){
                $record_status=$_SESSION['check_in_status']=I('get.check_in_status');
            }elseif(!empty($_SESSION['check_in_status'])){
                $record_status=$_SESSION['check_in_status'];
            }else{
                $record_status=$_SESSION['check_in_status']=1;
            }
            $where['uploadtime']=array('between',array($starttime,$endtime));
            if($record_status!=4){
                $where['status']=$record_status;
            }
            $personnelModel=new PersonnelModel();
            //非人事查看
            if(empty($this->is_personnel)){
                $personnel_info=$personnelModel->get_personnel_one(array('admin_id'=>$this->admin_info['id']));
                if(empty($personnel_info)) $personnel_info['department_id']=$this->admin_info['department_id'];
                $department_id=$personnelModel->get_department_name($personnel_info['department_id'],'id');
                $where['department_id']=$department_id;
            }
            //获取条目
            $check_in_list=$this->checking_inModel->get_check_in_list($where);
            $record_status_list=array('1'=>'待审核','2'=>'审核通过','3'=>'有问题待处理');
            //循环改正部分类目
            foreach ($check_in_list as &$value){
                $value['department_name']=$personnelModel->get_department_name($value['department_id']);
                $value['status_name']=$record_status_list[$value['status']];
            }
            $this->assign('check_in_list',$check_in_list);
            $breadcrumb = array(
                array('考勤记录列表',U('Personnel_checking_in/checking_in_list_news')),
             );
            $this->assign('breadcrumb',$breadcrumb);
            $this->assign('starttime',$starttime);
            $this->assign('endtime',$endtime);
            $this->assign('check_in_status',$record_status);
            $this->assign('table_sort',json_encode(array('3','desc')));
            $this->display('checking_in_list_new');
    }

    /**
     * @author zhukeqin
     * 查看一条信息
     */
    public function check_in_watch(){
        $breadcrumb = array(
            array('考勤记录列表',U('Personnel_checking_in/checking_in_list_news')),
            array('考勤记录查看','#'),
        );
        $this->assign('breadcrumb',$breadcrumb);
        $id=$_GET['id'];
        $check_in_info=$this->checking_inModel->get_check_in_one(array('check_in_id'=>$id));

        if(empty($check_in_info)) $this->error('该条目不存在');
        $this->assign('check_in_info',$check_in_info);
        $this->assign('count','0');
        $this->display();
    }
    /**
     * @author zhukeqin
     * 导入表格
     */
    public function excel_check_input(){
        $breadcrumb = array(
            array('考勤记录列表',U('Personnel_checking_in/checking_in_list_news')),
            array('考勤记录导入','#'),
        );
        $this->assign('breadcrumb',$breadcrumb);

        $personnelModel=new PersonnelModel();
        $personnel_info=$personnelModel->get_personnel_one(array('admin_id'=>$this->admin_info['id']));
        if(empty($personnel_info)) $personnel_info['department_id']=$this->admin_info['department_id'];
        $department_id=$personnelModel->get_department_name($personnel_info['department_id'],'id');
        $department_name=$personnelModel->get_department_name($personnel_info['department_id']);
        if(IS_POST){
            $type_list=array('type_0'=>'全勤','type_1'=>'入/离职','type_2'=>'请假/旷工','type_3'=>'迟到/早退','type_4'=>'加班','type_5'=>'晋升/降免/调岗');
            $data=array();
            $error=array();
            $type_key='';
            $personnel_check_inModel=new Personnel_check_inModel();
            //读取excel文件
            $arr1 = import_excel_sheet_one($_FILES['test'],'L','','0');
            //去除头部
            unset($arr1['0']);
            unset($arr1['1']);
            unset($arr1['2']);
            unset($arr1['3']);
            foreach ($arr1 as $key=>$value){
                if(!empty($value['1'])){
                    $type_key=array_search($value['1'],$type_list);
                    if(empty($type_key)) $error[]='第'.($key+1).'行类别不正确，请检查是否和模板中的名称一致';
                }
                if(!empty($type_key)){
                    if(!empty($value['2'])){
                        $cache=array();
                        $cache['name']=$value['2'];
                        $cache['info']['0']=$value['3'];
                        $cache['info']['1']=$value['4'];
                        $cache['info']['2']=$value['5'];
                        $cache['info']['3']=$value['6'];
                        $cache['info']['4']=$value['7'];
                        $cache['info']['5']=$value['8'];
                        $cache['info']['6']=$value['9'];
                        $cache['info']['7']=$value['10'];
                        $cache['remark']=$value['11'];
                        $data[$type_key][]=$cache;
                    }
                }
                if(empty($type_key)&&!empty($value['2'])){
                    $error[]='第'.($key+1).'行员工没有所属类别，请检查';
                }
            }
            if(count($error)==0){
                $type_file=explode(',',$_POST['content']);
                array_shift($type_file);
                $data['type_file']=$type_file;
                $re=$personnel_check_inModel->change_check_in_one($data,$department_id,$this->admin_info['id'],$_POST['ci_name'],$_POST['pm_name'],'1','');
                if($re['err']==0){
                    $this->success('导入成功,即将前往预览',U('check_in_watch',array('id'=>$re['data'])));
                }else{
                    $this->error($re['data']);
                }
            }else{
                echo "<center>";
                echo "以下行数有对应问题，请处理之后再导入</br>";
                foreach ($error as $value){
                    echo $value."</br>";
                }
                echo "</center>";
            }


        }else{
            $ci_name=$this->admin_info['realname'];
            $pm_name=M('personnel')->alias('p')
                ->field(array('p.name'))
                ->join('left join __PERSONNEL_POSITION__ pp on pp.personnel_id=p.personnel_id')
                ->where(array('p.department_id'=>$department_id,'position'=>'项目经理'))
                ->order('pp.time_change desc')
                ->find()['name'];
            $pm_name=$pm_name?:$this->checking_inModel->get_check_in_one(array('department_id'=>$department_id))['pm_name'];
            $this->assign('department_id',$department_id);
            $this->assign('department_name',$department_name);
            $this->assign('ci_name',$ci_name);
            $this->assign('pm_name',$pm_name);
            $this->display();
        }
    }

    /**
     * @author zhukeqin
     * 文件上传
     */
    public function img_upload() {
        foreach ($_FILES as $value){
            $fileArr=$value;
            break;
        }
        $imageModel=new ImageModel();
        if ($fileArr['error'] != 4) {
            if ($fileArr['size'] < 500000) {
                $image = $imageModel->handleTwo('1', 'contract', 1,array('size' => 5),'',$fileArr['name']);
                if ($image['error']) {
                    exit(json_encode($image));
                } else {
                    foreach ($image['url'] as $value){
                        $id=M('image')->where(array('pic'=>$value))->find()['pigcms_id'];
                        break;
                    }
                    exit(json_encode(array('err' => 0, 'data' => $id )));
                }
            } else {
                exit(json_encode(array('err' => 1,'data' =>'文件过大')));
            }
        } else {
            exit(json_encode(array('err' => 1,'data' =>'没有选择文件')));
        }
    }

    /**
     * @author zhukeqin
     * 审核修改一条考勤记录
     */
    public function checking_in_edit(){
        if($this->is_personnel!=1){
            $this->error('');
        }
        $breadcrumb = array(
            array('考勤记录列表',U('Personnel_checking_in/checking_in_list')),
            array('编辑修改考勤记录','#'),
        );
        $this->assign('breadcrumb',$breadcrumb);
        $id=$_GET['id'];
        $check_in_info=$this->checking_inModel->get_check_in_one(array('check_in_id'=>$id));
        if(empty($check_in_info['check_in_id'])) $this->error('所选记录不存在');
        if($check_in_info['status']==2) $this->error('已通过审核，暂无法修改');
        if($_GET['status']==2){
            $re=$this->checking_inModel->check_check_in_one($id,'2',$this->admin_info['id'],'');
            if($re['err']==0){
                $this->success('审核成功！',U('check_in_watch',array('id'=>$id)));
                die;
            }else{
                $this->error($re['data'],U('check_in_watch',array('id'=>$id)));
            }
        }
        if(IS_POST){
            $post=$_POST;
            $data=array();
            $other=array();
            foreach ($post as $key=>$value){
                if(strstr($key,'type')!==false){
                    $data[$key]=$value;
                }elseif($key=='content'){
                    $value=explode(',',$value);
                    array_shift($value);
                    $data['type_file']=$value;
                }else{
                    $other[$key]=$value;
                }
            }
            $re=$this->checking_inModel->change_check_in_one($data,'','',$other['ci_name'],$other['pm_name'],'',$other['remark'],$id);
            if($re['err']==0){
                if(!empty($other['status'])){
                    $re=$this->checking_inModel->check_check_in_one($id,$other['status'],$this->admin_info['id'],$other['remark']);
                    if($re['err']==0){
                        $this->success('审核成功！',U('check_in_watch',array('id'=>$id)));
                    }else{
                        $this->error($re['data'],U('check_in_watch',array('id'=>$id)));
                    }
                }else{
                    $this->success('审核成功！',U('check_in_watch',array('id'=>$id)));
                }
            }else{
                $this->error('保存失败,可能是内容没有更改导致');
            }
        }else{
            $pic_list=array();
            $con=array();
            $count_list=array();
            foreach ($check_in_info as $key=>$value) {
                if (strstr($key, 'type') !== false&&$key!='type_file') {
                    end($value['info']);
                    $count_list[$key]=key($value['info']);//获取最后一个键值
                }
            }
            foreach ($check_in_info['type_file'] as $value){
                $pic_list[]=$value['pic'];
                $con[]=(object)array('caption'=>$value['name'],'size'=>abs(filesize($value['pic'])),'width'=>'200px','key'=>$value['pigcms_id']);
            }//,'url'=> U('img_delete')
            $this->assign('pic_list',json_encode($pic_list));
            $this->assign('con',json_encode($con));
            $this->assign('check_in_info',$check_in_info);
            $this->assign('count_list',$count_list);
            $this->display();
        }
    }

    /**
     * @author zhukeqin
     * 表格打印输出
     */
    public function check_excel_output(){
        $id=$_GET['id'];
        $check_in_info=$this->checking_inModel->get_check_in_one(array('check_in_id'=>$id));
        if(empty($check_in_info['check_in_id'])) $this->error('所选记录不存在');
        if($check_in_info['status']!=2) $this->error('所选记录尚未通过审核，暂无法打印');
        import('@.ORG.phpexcel.PHPExcel');
        $phpexcel = new PHPExcel();
        //设置基本信息
        $phpexcel->getProperties()->setCreator("admin")
            ->setLastModifiedBy(session('system.account'))
            ->setTitle(date('Y年m月',strtotime('-1 month',$check_in_info['uploadtime'])).$check_in_info['department_info']['deptname'].'员工月考勤汇总表')
            ->setSubject("员工月考勤汇总表")
            ->setDescription("")
            ->setKeywords("员工月考勤汇总表")
            ->setCategory("");
        $phpexcel->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpexcel->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        //执行主表页面
        $phpexcel->setActiveSheetIndex(0);
        //设置默认行高
        $phpexcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(26);

        $phpexcel->getActiveSheet()->setTitle('执行主表');
        $phpexcel->getActiveSheet()->setCellValue('A1', date('Y年m月',strtotime('-1 month',$check_in_info['uploadtime'])).$check_in_info['department_info']['deptname'].'员工月考勤汇总表');
        //合并单元格
        $phpexcel->getActiveSheet()->mergeCells('A1:L1');
        //设置表头
        $phpexcel->getActiveSheet()->setCellValue('A2', '序号');
        $phpexcel->getActiveSheet()->getStyle('A2')->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->mergeCells('A2:A4');

        $phpexcel->getActiveSheet()->setCellValue('B2', '类别');
        $phpexcel->getActiveSheet()->getStyle('B2')->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('B2')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->mergeCells('B2:B4');

        $phpexcel->getActiveSheet()->setCellValue('C2', '姓名');
        $phpexcel->getActiveSheet()->getStyle('C2')->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('C2')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->mergeCells('C2:C4');

        $phpexcel->getActiveSheet()->setCellValue('D2', '出勤');
        $phpexcel->getActiveSheet()->getStyle('D2')->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('D2')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->mergeCells('D2:D3');
        $phpexcel->getActiveSheet()->setCellValue('D4', '天数');

        $phpexcel->getActiveSheet()->setCellValue('E2', '休假');
        $phpexcel->getActiveSheet()->getStyle('E2')->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('E2')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->mergeCells('E2:E3');
        $phpexcel->getActiveSheet()->setCellValue('E4', '天数');

        $phpexcel->getActiveSheet()->setCellValue('F2', '请假');
        $phpexcel->getActiveSheet()->getStyle('F2')->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('F2')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->mergeCells('F2:H2');
        $phpexcel->getActiveSheet()->setCellValue('F3', '病假');
        $phpexcel->getActiveSheet()->setCellValue('G3', '事假');
        $phpexcel->getActiveSheet()->setCellValue('H3', '其它');
        $phpexcel->getActiveSheet()->setCellValue('F4', '天数');
        $phpexcel->getActiveSheet()->setCellValue('G4', '天数');
        $phpexcel->getActiveSheet()->setCellValue('H4', '天数');

        $phpexcel->getActiveSheet()->setCellValue('I2', '迟到');
        $phpexcel->getActiveSheet()->getStyle('I2')->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('I2')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->mergeCells('I2:I3');
        $phpexcel->getActiveSheet()->setCellValue('I4', '次数');

        $phpexcel->getActiveSheet()->setCellValue('J2', '早退');
        $phpexcel->getActiveSheet()->getStyle('J2')->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('J2')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->mergeCells('J2:J3');
        $phpexcel->getActiveSheet()->setCellValue('J4', '次数');

        $phpexcel->getActiveSheet()->setCellValue('K2', '旷工');
        $phpexcel->getActiveSheet()->getStyle('K2')->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('K2')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->mergeCells('K2:K3');
        $phpexcel->getActiveSheet()->setCellValue('K4', '次数');

        $phpexcel->getActiveSheet()->setCellValue('L2', '备注');
        $phpexcel->getActiveSheet()->getStyle('L2')->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('L2')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->mergeCells('L2:L4');

        //设置字体样式
        $phpexcel->getActiveSheet()->getStyle('A1')->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
        $phpexcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        //设置列宽
        $phpexcel->getActiveSheet()->getColumnDimension('B')->setWidth(18);
        $phpexcel->getActiveSheet()->getColumnDimension('L')->setWidth(37.5);


        $i=0;//设置循环数量
        $type_list=array('type_0'=>'全勤','type_1'=>'入/离职','type_2'=>'请假/旷工','type_3'=>'迟到/早退','type_4'=>'加班','type_5'=>'晋升/降免/调岗');
        //循环输出
        foreach($check_in_info as $key=>$value){
            if(!empty($type_list[$key])){
                $row_type=$i+5;
                $count=count($value);
                //设置类别名称
                $phpexcel->getActiveSheet()->setCellValue('B'.$row_type, $type_list[$key]);
                $phpexcel->getActiveSheet()->getStyle('B'.$row_type)->getFont()->setName('宋体');
                $phpexcel->getActiveSheet()->getStyle('B'.$row_type)->getFont()->setBold(true);
                $phpexcel->getActiveSheet()->mergeCells('B'.$row_type.':B'.($row_type+$count-1));
                foreach ($value as $key1=>$value1){
                    $row=++$i+4;
                    $phpexcel->getActiveSheet()->setCellValue('A'.$row, $i.'.');
                    $phpexcel->getActiveSheet()->setCellValue('C'.$row, $value1['name']);
                    foreach($value1['info'] as $key2=>$value2){
                        $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($key2+3).$row, $value2);
                    }
                    $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex(count($value1['info'])+3).$row, $value1['remark']);
                }
            }
        }
        $phpexcel->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY);

        $phpexcel->getActiveSheet()->getStyle('A2:L'.$row)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);

        $phpexcel->getActiveSheet()->setCellValue('A'.(++$i+4), '填表说明： 月考勤汇总表由考勤员填写；考勤异动（迟到、早退、旷工、请假、加班、补休   ');
        $phpexcel->getActiveSheet()->getStyle('A'.($i+4))->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('A'.($i+4))->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->mergeCells('A'.($i+4).':L'.($i+4));

        $phpexcel->getActiveSheet()->setCellValue('A'.(++$i+4), '等）须在备注栏加以说明，病事假须注明当年已休病事假天数；各类请假须附上请假单。');
        $phpexcel->getActiveSheet()->getStyle('A'.($i+4))->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('A'.($i+4))->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->mergeCells('A'.($i+4).':L'.($i+4));
        //设置A列左对齐

        $phpexcel->getActiveSheet()->mergeCells('A'.(++$i+4).':L'.($i+4));
        $phpexcel->getActiveSheet()->setCellValue('A'.(++$i+4), '考勤员  ： '.$check_in_info['ci_name'].'  '.date('Y-n-j',$check_in_info['uploadtime']));
        $phpexcel->getActiveSheet()->getStyle('A'.($i+4))->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('A'.($i+4))->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->mergeCells('A'.($i+4).':L'.($i+4));

        $phpexcel->getActiveSheet()->mergeCells('A'.(++$i+4).':L'.($i+4));
        $phpexcel->getActiveSheet()->mergeCells('A'.(++$i+4).':L'.($i+4));
        $phpexcel->getActiveSheet()->setCellValue('A'.(++$i+4), '部门/服务中心负责人： '.$check_in_info['ci_name'].'  '.date('Y-n-j',$check_in_info['uploadtime']));
        $phpexcel->getActiveSheet()->getStyle('A'.($i+4))->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('A'.($i+4))->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->mergeCells('A'.($i+4).':L'.($i+4));

        $phpexcel->getActiveSheet()->mergeCells('A'.(++$i+4).':L'.($i+4));
        $phpexcel->getActiveSheet()->mergeCells('A'.(++$i+4).':L'.($i+4));
        $phpexcel->getActiveSheet()->setCellValue('A'.(++$i+4), '分公司总经理（手签）：    ');
        $phpexcel->getActiveSheet()->getStyle('A'.($i+4))->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('A'.($i+4))->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->mergeCells('A'.($i+4).':L'.($i+4));

        $phpexcel->getActiveSheet()->mergeCells('A'.(++$i+4).':L'.($i+4));
        $phpexcel->getActiveSheet()->mergeCells('A'.(++$i+4).':L'.($i+4));
        $phpexcel->getActiveSheet()->setCellValue('A'.(++$i+4), '集团公司审批（手签）：     ');
        $phpexcel->getActiveSheet()->getStyle('A'.($i+4))->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('A'.($i+4))->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->mergeCells('A'.($i+4).':L'.($i+4));

        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=".date('Y年m月',strtotime('-1 month',$check_in_info['uploadtime'])).$check_in_info['department_info']['deptname']."员工月考勤汇总表.xls");
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0
        $objwriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel5');
        $objwriter->save('php://output');
        exit;
    }

    /**
     * @author zhukeqin
     * 在线打印
     */
    public function check_online_output(){
        $id=$_GET['id'];
        $check_in_info=$this->checking_inModel->get_check_in_one(array('check_in_id'=>$id));
        if(empty($check_in_info['check_in_id'])) $this->error('所选记录不存在');
        if($check_in_info['status']!=2) $this->error('所选记录尚未通过审核，暂无法打印');
        $this->assign('check_in_info',$check_in_info);
        $this->display();
    }

    /**
     * @author zhukeqin
     * 打包下载附件
     */
    public function check_download_file(){
        $id=$_GET['id'];
        $check_in_info=$this->checking_inModel->get_check_in_one(array('check_in_id'=>$id));
        if(empty($check_in_info['check_in_id'])) $this->error('所选记录不存在');
        if(count($check_in_info['type_file'])==0) $this->error('没有附件可以打包下载');
        $imgModel=new ImageModel();
        $type_file=array();
        foreach ($check_in_info['type_file'] as $key=>$value){
            $type_file[$value['name']]='.'.$value['pic'];
        }
        $imgModel->excu_zip($type_file,date('Y年m月',strtotime('-1 month',$check_in_info['uploadtime'])).$check_in_info['department_info']['deptname']."员工月考勤附件.zip");
    }

}