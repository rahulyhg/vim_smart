<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/6/13
 * Time: 10:05
 */

/**
 * @author zhukeqin
 * 小区物业缴费计算类
 * Class PropertyAction
 */
class PropertyAction extends BaseAction
{
    public function _initialize()
    {

        parent::_initialize();
        $breadcrumb_diy = array(
            array('物业服务','#'),
            array('单元管理',U('PropertyService/room_list_uptown')),
            array('报表台账','#'),
        );
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $this->admin_id = session('system.id');
        $this->village_id = filter_village(0, 2);
        $this->project_id =$_POST['project_id'];
        if(empty($this->project_id)){
            $this->project_id=$_SESSION['project_id'];
        }else{
            $_SESSION['project_id']=$this->project_id;
        }
        /*dump($this->project_id);*/
        $project_list=M('house_village_project')->where(array('village_id'=>$this->village_id))->select();
        if(empty($this->project_id)){
            $this->project_id=$_SESSION['project_id']=$project_list['0']['pigcms_id'];
        }
        $this->year=$_GET['year'];
        if(empty($this->year)){
            if(empty($_SESSION['year'])){
                $this->year=$_SESSION['year']=date('Y');
            }else{
                $this->year=$_SESSION['year'];
            }
        }
        $this->lastyear=$this->year-1;
        $this->nextyear=$this->year+1;
        if($this->year==date('Y')){
            $this->month_number=date('n');
        }elseif($this->year>date('Y')){
            $this->month_number=0;
        }else{
            $this->month_number=12;
        }
        $this->type_list=array(
            array(
                'otherfee_type_name'=>'物业服务费',
                'url'=>U('property'),
                'type'=>'property',
            ),
            array(
                'otherfee_type_name'=>'包月泊车费',
                'url'=>U('carspace'),
                'type'=>'carspace',
            ),
        );
        $type_list_all=M('house_village_otherfee_type')->where(array('status'=>1,'village_id'=>$this->village_id,))->order('rank asc')->select();
        foreach ($type_list_all as $value){
            $this->type_list[]=array(
                'otherfee_type_name'=>$value['otherfee_type_name'],
                'url'=>U('otherfee',array('otherfee_type_id'=>$value['otherfee_type_id'])),
                'type'=>$value['otherfee_type_id'],
            );
        }
        $project_list=M('house_village_project')->where(array('village_id'=>$this->village_id))->select();
        if(empty($this->project_id)){
            $this->project_id=$_SESSION['project_id']=$project_list['0']['pigcms_id'];
        }
        $this->assign('type_list',$type_list_all);
        $this->assign('month_number',$this->month_number);
        $this->assign('month_number1',$this->month_number+1);
        $this->assign('project_list',$project_list);
        $this->assign('year',$this->year);
        /*if(!empty($this->project_id)){
            $where['r.project_id']=$this->projetct_id;
        }
        $field=array(
            'r.*',
            'ub.name',
        );
        $this->room_list=M('house_village_room')
            ->alias('r')
            ->join('left join __HOUSE_VILLAGE_USER_BIND__ ub on ub.pigcms_id=r.owner_id')
            ->where($where)
            ->field($field)
            ->select();*/
    }
    public function property(){
        /*$field=array(
          'r.*',
            'ru.property_endtime',
            'ru.property_defaulttime',
            'ub.name'=>'user_name',
            'rt.property_unit'
        );
        if(!empty($this->project_id)){
            $where['r.project_id']=$this->project_id;
        }
        $where['fid']=array('neq','0');
        $room_list=M('house_village_room')
            ->alias('r')
            ->join('left join __HOUSE_VILLAGE_ROOM_UPTOWN__ ru on ru.rid=r.id')
            ->join('left join __HOUSE_VILLAGE_ROOM_TYPE__ rt on rt.pigcms_id=r.room_type')
            ->join('left join __HOUSE_VILLAGE_USER_BIND__ ub on ub.pigcms_id=r.owner_id')
            ->where($where)
            ->field($field)
            ->select();
        $last_year= array(
          'last_recive'=>'0',
            'last_advance'=>'0'
        );
        $sum=array(
            'sum_lastadvance'=>0,
            'sum_lasttrue'=>0,
            'sum_nowrecive'=>0,
            'sum_nowtrue'=>0,
            'sum_nowend'=>0,
        );
        foreach ($room_list as $key=>$value){
            $result=unserialize(M('house_village_room_fee_lastyear')->where(array('type'=>'property','year'=>$this->lastyear,'rid'=>$value['id']))->find()['data']);
            $property_fee_list[$key]=array(
                'room_name'=>$value['room_name'],
                'property_unit'=>$value['property_unit'],
                'name'=>$value['user_name'],
                'roomsize'=>$value['roomsize'],
                'property_unit'=>$value['property_unit'],
                'lastyear_receive'=>round($result['lastyear_receive'],2),
                'lastyear_advance'=>round($result['lastyear_advance'],2),
                'property_mouth'=>round($value['property_unit']*$value['roomsize'],2),
            );
            $payend_recive=$property_fee_list[$key]['lastyear_receive'];
            $payend_advance=$property_fee_list[$key]['lastyear_advance'];
            for($i=1;$i<=$this->month_number;$i++){
                $time_start=strtotime($this->year.'-'.$i);
                $j=$i+1;
                $time_end=strtotime($this->year.'-'.$j);
                $info=M('house_village_room_propertylist')->where(array('rid'=>$value['id'],'pay_time'=>array('between',array($time_start,$time_end)),'status'=>1))->select();
                $all=0;
                foreach ($info as $value1){
                    $all +=$value1['pay_true'];
                }
                $property_fee_list[$key]['list'][$i]['pay_recive']=$property_fee_list[$key]['property_mouth'];
                $property_fee_list[$key]['list'][$i]['pay_true']=$all;
                $check=round($payend_recive+$property_fee_list[$key]['list'][$i]['pay_recive']-$payend_advance-$property_fee_list[$key]['list'][$i]['pay_true'],2);
                if($check>=0){
                    $property_fee_list[$key]['list'][$i]['payend_recive']=$check;
                    $property_fee_list[$key]['list'][$i]['payend_advance']=0;
                }else{
                    $property_fee_list[$key]['list'][$i]['payend_recive']=0;
                    $property_fee_list[$key]['list'][$i]['payend_advance']=-$check;
                }
                $payend_recive=$property_fee_list[$key]['list'][$i]['payend_recive'];
                $payend_advance=$property_fee_list[$key]['list'][$i]['payend_advance'];
            }
            $property_fee_list[$key]['remark']=str_replace('-','.',$value['property_defaulttime']).'-'.str_replace('-','.',$value['property_endtime']);
        }
        foreach ($property_fee_list as &$value){
            $sum_recive=$sum_true=$sum_endrecive=$sum_endadvance=0;
            foreach ($value['list'] as $key=>$value1){
                $sum_recive +=$value1['pay_recive'];
                $sum_true +=$value1['pay_true'];
                $sum['list'][$key]['sum_recive'] +=$value1['pay_recive'];
                $sum['list'][$key]['sum_true'] +=$value1['pay_true'];
                $sum['list'][$key]['sum_endrecive'] +=$value1['payend_recive'];
                $sum['list'][$key]['sum_endadvance'] +=$value1['payend_advance'];
            }

            $value['sum_recive']=$sum_recive;
            $value['sum_true']=$sum_true;
            $value['sum_nowend']=round($value['lastyear_receive']+$sum_recive-$sum_true-$value['lastyear_advance'],2);
            $sum['sum_lastyear_receive'] +=$value['lastyear_receive'];
            $sum['sum_lastyear_advance'] +=$value['lastyear_advance'];
            $sum['sum_nowrecive'] +=$sum_recive;
            $sum['sum_nowtrue'] +=$sum_true;
            $sum['sum_nowend'] +=$value['sum_nowend'];
            $sum['sum_roomsize'] +=$value['roomsize'];
            $sum['allprice'] +=$value['property_mouth'];
        }*/
        //取出缓存
        $property = new PropertyModel($this->project_id,$this->year);
        $data=$property->property();
        $property_fee_list=$data['fee_list'];
        $sum=$data['sum'];
        $this->assign('property_fee_list',$property_fee_list);
        $this->assign('sum',$sum);
        $this->display();
    }
    public function carspace(){

        /*$field=array(
            'uc.*',
            'r.*',
            'ub.name'=>'user_name',
        );
        if(!empty($this->project_id)){
            $where['uc.project_id']=$this->project_id;
        }
        $carspace_list=M('house_village_user_car')
            ->alias('uc')
            ->join('left join __HOUSE_VILLAGE_ROOM__ r on uc.rid=r.id')
            ->join('left join __HOUSE_VILLAGE_USER_BIND__ ub on ub.pigcms_id=r.owner_id')
            ->where($where)
            ->field($field)
            ->select();
        $carspace_fee_list=array();
        $sum=array(
            'sum_last'=>0,
            'sum_nowrecive'=>0,
            'sum_nowtrue'=>0,
            'sum_nowend'=>0,
            'num'=>0,
            'allprice'=>0,
            );
        foreach ($carspace_list as $key=>$value){
            $carspace_fee_list[$key]=array(
                'room_name'=>$value['room_name'],
                'carspace_price'=>$value['carspace_price'],
                'name'=>$value['user_name'],
                'rid'=>$value['rid'],
            );
            for($i=1;$i<=$this->month_number;$i++){
                $time_start=strtotime($this->year.'-'.$i);
                $j=$i+1;
                $time_end=strtotime($this->year.'-'.$j);
                $info=M('house_village_room_carspacelist')->where(array('carspace_id'=>$value['pigcms_id'],'pay_time'=>array('between',array($time_start,$time_end)),'status'=>1))->select();
                $all=0;
                foreach ($info as $value1){
                    $all +=$value1['pay_true'];
                }
                $carspace_fee_list[$key]['list'][$i]['pay_recive']=$value['carspace_price'];
                $carspace_fee_list[$key]['list'][$i]['pay_true']=$all;
            }
            $carspace_fee_list[$key]['remark']=str_replace('-','.',$value['carspace_start']).'-'.str_replace('-','.',$value['carspace_end']);
        }
        foreach ($carspace_fee_list as &$value){
            $sum_recive=$sum_true=0;
            foreach ($value['list'] as $key=>$value1){
                $sum_recive +=$value['carspace_price'];
                $sum_true +=$value1['pay_true'];
                $sum['list'][$key]['sum_recive'] +=$value['carspace_price'];
                $sum['list'][$key]['sum_true'] +=$value1['pay_true'];
            }
            $result=M('house_village_room_fee_lastyear')->where(array('type'=>'carspace','year'=>$this->lastyear,'rid'=>$value['rid']))->find();
            $value['sum_last']=round(unserialize($result['data'])['lastyear_receive'],'2');
            $value['sum_recive']=$sum_recive;
            $value['sum_true']=$sum_true;
            $value['sum_nowend']=round($value['sum_last']+$sum_recive-$sum_true,2);
            $sum['allprice'] +=$value['carspace_price'];
            $sum['num']++;
            $sum['sum_last'] +=$value['sum_last'];
            $sum['sum_nowrecive'] +=$sum_recive;
            $sum['sum_nowtrue'] +=$sum_true;
            $sum['sum_nowend'] +=round($value['sum_last']+$sum_recive-$sum_true,2);
        }*/
        $property = new PropertyModel($this->project_id,$this->year);
        $data=$property->carspace();
        $carspace_fee_list=$data['fee_list'];
        $sum=$data['sum'];
        $this->assign('carspace_fee_list',$carspace_fee_list);
        $this->assign('sum',$sum);
        $this->display();
    }
    public function other(){
        $type_id=$_GET['type_id'];
        $otherfee_type_info=M('house_village_otherfee_type')->where(array('otherfee_type_id'=>$type_id,'village_id'=>$this->village_id))->find();
        if(empty($otherfee_type_info)){
            $this->error('该类型不存在');
        }
        /*$field=array(
            'r.*',
            'ub.name'=>'user_name',
        );
        if(!empty($this->project_id)){
            $where['r.project_id']=$this->project_id;
        }
        $where['fid']=array('neq','0');
        $room_list=M('house_village_room')
            ->alias('r')
            ->join('left join __HOUSE_VILLAGE_USER_BIND__ ub on ub.pigcms_id=r.owner_id')
            ->where($where)
            ->field($field)
            ->select();
        $otherfee_list=array();
        $sum=array(
            'sum_last'=>0,
            'sum_nowrecive'=>0,
            'sum_nowtrue'=>0,
            'sum_nowend'=>0,
        );
        foreach ($room_list as $key=>$value){
            $otherfee_list[$key]=array(
                'room_name'=>$value['room_name'],
                'name'=>$value['user_name'],
                'rid'=>$value['rid'],
            );
            for($i=1;$i<=$this->month_number;$i++){
                $time_start=strtotime($this->year.'-'.$i);
                $j=$i+1;
                $time_end=strtotime($this->year.'-'.$j);
                $info=M('house_village_otherfee')->where(array('rid'=>$value['id'],'creattime'=>array('between',array($time_start,$time_end)),'status'=>1))->select();
                $all=0;
                $all_recive=0;
                foreach ($info as $value1){
                    $all_recive +=$value1['fee_receive'];
                    $all +=$value1['fee_true'];
                }
                $otherfee_list[$key]['list'][$i]['pay_recive']=$all_recive;
                $otherfee_list[$key]['list'][$i]['pay_true']=$all;
            }
            //$otherfee_list[$key]['remark']=str_replace('-','.',$value['carspace_start']).'-'.str_replace('-','.',$value['carspace_end']);
        }
        foreach ($otherfee_list as &$value){
            $sum_recive=$sum_true=0;
            foreach ($value['list'] as $key=>$value1){
                $sum_recive +=$value1['pay_recive'];
                $sum_true +=$value1['pay_true'];
                $sum['list'][$key]['sum_recive'] +=$value1['pay_recive'];
                $sum['list'][$key]['sum_true'] +=$value1['pay_true'];
            }
            $result=M('house_village_room_fee_lastyear')->where(array('type'=>$type_id,'year'=>$this->lastyear,'rid'=>$value['rid']))->find();
            $value['sum_last']=round(unserialize($result['data'])['lastyear_receive'],'2');
            $value['sum_recive']=$sum_recive;
            $value['sum_true']=$sum_true;
            $value['sum_nowend']=round($value['sum_last']+$sum_recive-$sum_true,2);
            $sum['sum_last'] +=$value['sum_last'];
            $sum['sum_nowrecive'] +=$sum_recive;
            $sum['sum_nowtrue'] +=$sum_true;
            $sum['sum_nowend'] +=round($value['sum_last']+$sum_recive-$sum_true,2);
        }*/
        $property = new PropertyModel($this->project_id,$this->year);
        $data=$property->other($type_id);
        $otherfee_list=$data['fee_list'];
        $sum=$data['sum'];
        $this->assign('otherfee_list',$otherfee_list);
        $this->assign('sum',$sum);
        $this->display();
    }
    public function month(){
        $property=new PropertyModel($this->project_id,$this->year);
        $data=$property->month();
        $type_list=$data['fee_list'];
        $sum=$data['sum'];
        //dump($sum);
        $this->assign('fee_list',$type_list);
        $this->assign('sum',$sum);
        $this->display();
    }

    public function ajax_update_collect_time(){
        if(IS_POST){
            $data=$_POST['data'];
            $return=D('House_village_fee_collect_time')->update_time_one($data,$this->village_id,$this->project_id,$this->year);
            if($return){
                $this->error($return);
            }else{
                $this->success('更新成功，即将更新');
            }
        }else{
            $collect_time=D('House_village_fee_collect_time')->get_time_one($this->village_id,$this->project_id,$this->year);
            if(!is_array($collect_time)) $this->error($collect_time);
            $this->assign('collect_time',$collect_time);
            $this->display();
        }
    }

    public function sum_fee($village_id,$project_id,$type,$feetype,$timearray,$otherfee_type=''){
        if($type=='property'){
            $table=M('house_village_room_propertylist');
            $get='tab.pay_true';
            $time='tab.pay_time';
        }elseif($type=='carspace'){
            $table=M('house_village_room_carspacelist');
            $get='tab.pay_true';
            $time='tab.pay_time';
        }else{
            $table=M('house_village_otherfee');
            $get='tab.fee_true';
            $time='tab.creattime';
        }
        $where=array(
            'r.village_id'=>$village_id,
            'r.project_id'=>$project_id,
            $time=>array('between',$timearray),
            'tab.status'=>1
        );
        if(!empty($feetype)){
            $where['tab.type']=$feetype;
        }
        if(!empty($otherfee_type)&&$type=='other'){
            $where['tab.otherfee_type_id']=$otherfee_type;
        }
        $return=$table
            ->alias('tab')
            ->join('left join __HOUSE_VILLAGE_ROOM__ r on tab.rid=r.id')
            ->where($where)
            ->sum($get);
        return $return;

    }
    public function update_step1(){
        //导航设置
        $breadcrumb_diy = array(
            array('物业服务','#'),
            array('业主列表',U('ownerlist_uptown_news')),
            array('批量导入','#'),
        );
        $model = new RoomModel();
        $village_list=$model->get_village_list(array('village_id'=>$this->village_id));
        $project_list=M('house_village_project')->where('village_id='.$this->village_id)->select();
        $fee_type=M('house_village_otherfee_type')->where('village_id='.$this->village_id)->select();
        $fee_type[]=array('otherfee_type_id'=>'property','otherfee_type_name'=>'物业服务费');
        $fee_type[]=array('otherfee_type_id'=>'carspace','otherfee_type_name'=>'包月泊车费');
        $this->assign('project_list',$project_list);
        $this->assign('village_list',$village_list);
        $this->assign('fee_type',$fee_type);
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $this->display();
    }
    public function update_step2(){
        //导航设置
        $breadcrumb_diy = array(
            array('物业服务','#'),
            array('业主列表',U('ownerlist_news')),
            array('批量导入','#'),
        );
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        //获取社区名
        $model = new RoomModel();
        $file = $_FILES['test'];
        $village_id = $this->village_id;

        $village_name = $model->get_village_list()[$village_id];

        if($file){
            $project_id=I('post.project_id');
            if(empty($project_id)){
                $this->error("请选择园区",U('update_step1'));
            }
            $fee_lastyear_id=I('post.fee_lastyear_id');
            $year=I('post.year');
            //导入数据
            $list = $this->owner_uptown_excel_to_data($file,$village_id,$project_id,$fee_lastyear_id,$year);
            $this->assign_json('list',$list);
            $this->assign_json('selected_village_id',$village_id);
            $this->assign_json('selected_village_name',$village_name);
            $this->assign('selected_village_name',$village_name);
            $this->success("导入成功");
            //$this->display();
        }else{
            $this->error("文件格式错误",U('owner_uptown_import_step1'));
        }

    }

    public function month_histoty_update(){
        if(IS_POST){
            $file = $_FILES['test'];
            $arr = import_excel_sheet($file,'','','0','4');
            $return=D('House_village_fee_month_log')->update_log_one($arr,$this->village_id,$this->project_id,$this->year);
            if($return){
                $this->error($return);
            }else{
                $this->success('导入成功');
            }
        }else{
            $this->display();
        }
    }
    public function demo(){
        $property=new PropertyModel();
        dump($property->property_update_cache(2989,2018));
        dump(M()->_sql());
    }
    public function output_excel(){
        set_time_limit(0);
        import('@.ORG.phpexcel.PHPExcel');
        if(empty($this->village_id)){
            dump('error');
            die;
        }

        $village_info=M('house_village')->where('village_id='.$this->village_id)->find();
        $project_info=M('house_village_project')->where('pigcms_id='.$this->project_id)->find();
        $property = new PropertyModel($this->project_id,$this->year);
        $phpexcel = new PHPExcel();
        //设置基本信息
        $phpexcel->getProperties()->setCreator("admin")
            ->setLastModifiedBy(session('system.account'))
            ->setTitle($this->year.'年'.$village_info['village_name'].$project_info['desc'].'物业收费登记账')
            ->setSubject("账单列表")
            ->setDescription("")
            ->setKeywords("账单列表")
            ->setCategory("");
        $phpexcel->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpexcel->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        //物业服务费页面
        $phpexcel->setActiveSheetIndex(0);
        $phpexcel->getActiveSheet()->setTitle('物业服务费');
        $phpexcel->getActiveSheet()->setCellValue('A1', $this->year.'年'.$village_info['village_name'].$project_info['desc'].'物业服务费明细账');
        //合并单元格
        $phpexcel->getActiveSheet()->mergeCells('A1:J1');
        for ($i=0;$i<6;$i++){
            $num=PHPExcel_Cell::stringFromColumnIndex($i);
            $phpexcel->getActiveSheet()->mergeCells($num.'2:'.$num.'3');
        }
        $phpexcel->getActiveSheet()->setCellValue('G2', '合计');
        $phpexcel->getActiveSheet()->getStyle('G2')->getFont()->setName('黑体');
        $phpexcel->getActiveSheet()->getStyle('G2')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('G3', '上年应收');
        $phpexcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
        $phpexcel->getActiveSheet()->setCellValue('H3', '上年预收');
        $phpexcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
        $phpexcel->getActiveSheet()->setCellValue('I3', '本年应收');
        $phpexcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
        $phpexcel->getActiveSheet()->setCellValue('J3', '本年实收');
        $phpexcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
        $phpexcel->getActiveSheet()->setCellValue('K3', '年末应收及预收');
        $phpexcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
        $phpexcel->getActiveSheet()->mergeCells('G2:K2');
        for($i=1;$i<=$this->month_number;$i++) {
            $min=7+$i*4;
            $max=$min+3;
            $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min).'2', $i.'月');
            $phpexcel->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($min).'2')->getFont()->setName('黑体');
            $phpexcel->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($min).'2')->getFont()->setBold(true);
            $phpexcel->getActiveSheet()->mergeCells(PHPExcel_Cell::stringFromColumnIndex($min).'2:'.PHPExcel_Cell::stringFromColumnIndex($max).'2');
            $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min).'3', '本月应收');
            $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min+1).'3', '本月实收');
            $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min+2).'3', '月末应收');
            $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min+3).'3', '月末预收');
            $phpexcel->getActiveSheet()->getColumnDimension(PHPExcel_Cell::stringFromColumnIndex($min+1))->setWidth(15);
            $phpexcel->getActiveSheet()->getColumnDimension(PHPExcel_Cell::stringFromColumnIndex($min+2))->setWidth(15);
            $phpexcel->getActiveSheet()->getColumnDimension(PHPExcel_Cell::stringFromColumnIndex($min+3))->setWidth(15);
            $phpexcel->getActiveSheet()->getColumnDimension(PHPExcel_Cell::stringFromColumnIndex($min))->setWidth(15);
        }
        $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min+4).'3', '备注');
        $phpexcel->getActiveSheet()->getColumnDimension(PHPExcel_Cell::stringFromColumnIndex($min+4))->setAutoSize(true);

        //设置字体样式
        $phpexcel->getActiveSheet()->getStyle('A1')->getFont()->setName('黑体');
        $phpexcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
        $phpexcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

        //填入表头
        $phpexcel->getActiveSheet()->setCellValue('A2', '序号');
        $phpexcel->getActiveSheet()->getStyle('A2')->getFont()->setName('黑体');
        $phpexcel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('B2', '房号');
        $phpexcel->getActiveSheet()->getStyle('B2')->getFont()->setName('黑体');
        $phpexcel->getActiveSheet()->getStyle('B2')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('C2', '客户名称');
        $phpexcel->getActiveSheet()->getStyle('C2')->getFont()->setName('黑体');
        $phpexcel->getActiveSheet()->getStyle('C2')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('D2', '面积（㎡）');
        $phpexcel->getActiveSheet()->getStyle('D2')->getAlignment()->setWrapText(true);
        $phpexcel->getActiveSheet()->getStyle('D2')->getFont()->setName('黑体');
        $phpexcel->getActiveSheet()->getStyle('D2')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('E2', '单价（元/㎡/月）');
        $phpexcel->getActiveSheet()->getStyle('E2')->getAlignment()->setWrapText(true);
        $phpexcel->getActiveSheet()->getStyle('E2')->getFont()->setName('黑体');
        $phpexcel->getActiveSheet()->getStyle('E2')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('F2', '月应收');
        $phpexcel->getActiveSheet()->getStyle('F2')->getAlignment()->setWrapText(true);
        $phpexcel->getActiveSheet()->getStyle('F2')->getFont()->setName('黑体');
        $phpexcel->getActiveSheet()->getStyle('F2')->getFont()->setBold(true);

        $data=$property->property();
        /*dump($data);
        die;*/
        $fee_list=$data['fee_list'];
        $sum=$data['sum'];
        foreach ($fee_list as $key=>$value){
            $low=$key+4;
            $phpexcel->getActiveSheet()->setCellValue('A'.$low, $key+1);
            $phpexcel->getActiveSheet()->setCellValue('B'.$low, $value['room_name']);
            $phpexcel->getActiveSheet()->setCellValue('C'.$low, $value['name']);
            $phpexcel->getActiveSheet()->setCellValue('D'.$low, $value['roomsize']);
            $phpexcel->getActiveSheet()->setCellValue('E'.$low, $value['property_unit']);
            $phpexcel->getActiveSheet()->setCellValue('F'.$low, $value['property_mouth']);
            $phpexcel->getActiveSheet()->setCellValue('G'.$low, number_format($value['lastyear_receive'],2));
            $phpexcel->getActiveSheet()->setCellValue('H'.$low, number_format($value['lastyear_advance'],2));
            $phpexcel->getActiveSheet()->setCellValue('I'.$low, number_format($value['sum_recive'],2));
            $phpexcel->getActiveSheet()->setCellValue('J'.$low, number_format($value['sum_true'],2));
            $phpexcel->getActiveSheet()->setCellValue('K'.$low, number_format($value['sum_nowend'],2));
            foreach ($value['list'] as $key1=>$value1){
                $min=7+$key1*4;
                //$max=$min+3;
                $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min).$low, number_format($value1['pay_recive'],2));
                $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min+1).$low, number_format($value1['pay_true'],2));
                $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min+2).$low, number_format($value1['payend_recive'],2));
                $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min+3).$low, number_format($value1['payend_advance'],2));
            }
            $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min+4).$low, $value['remark']);
        }
        $low=$low+1;
        $phpexcel->getActiveSheet()->setCellValue('B'.$low, '合计');
        $phpexcel->getActiveSheet()->mergeCells('B'.$low.':C'.$low);
        $phpexcel->getActiveSheet()->setCellValue('D'.$low, number_format($sum['sum_roomsize'],2));
        $phpexcel->getActiveSheet()->setCellValue('F'.$low, number_format($sum['allprice'],2));
        $phpexcel->getActiveSheet()->setCellValue('G'.$low, number_format($sum['sum_lastyear_receive'],2));
        $phpexcel->getActiveSheet()->setCellValue('H'.$low, number_format($sum['sum_lastyear_advance'],2));
        $phpexcel->getActiveSheet()->setCellValue('I'.$low, number_format($sum['sum_nowrecive'],2));
        $phpexcel->getActiveSheet()->setCellValue('J'.$low, number_format($sum['sum_nowtrue'],2));
        $phpexcel->getActiveSheet()->setCellValue('K'.$low, number_format($sum['sum_nowend'],2));
        for($i=1;$i<=$this->month_number;$i++) {
            $min=7+$i*4;
            $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min).$low, number_format($sum['list'][$i]['sum_recive'],2));
            $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min+1).$low, number_format($sum['list'][$i]['sum_true'],2));
            $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min+2).$low, number_format($sum['list'][$i]['sum_endrecive'],2));
            $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min+3).$low, number_format($sum['list'][$i]['sum_endadvance'],2));
        }
        $phpexcel->getActiveSheet()->freezePaneByColumnAndRow(1,4);
        //设置背景颜色
        $phpexcel->getActiveSheet()->getStyle('G2:K'.$low)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $phpexcel->getActiveSheet()->getStyle( 'G2:K'.$low)->getFill()->getStartColor()->setARGB('FFFF99CC');
        foreach ($value['list'] as $key1=>$value1){
            $min1=7+$key1*4;
            $phpexcel->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($min1+2).'3:'.PHPExcel_Cell::stringFromColumnIndex($min1+3).$low)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
            $phpexcel->getActiveSheet()->getStyle( PHPExcel_Cell::stringFromColumnIndex($min1+2).'3:'.PHPExcel_Cell::stringFromColumnIndex($min1+3).$low)->getFill()->getStartColor()->setARGB('FFFF99CC');
        }
        //设置边框样式
        $phpexcel->getActiveSheet()->getStyle('A2:'.PHPExcel_Cell::stringFromColumnIndex($min+3).$low)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);

        //包月泊车费页面
        $phpexcel->createSheet();//新建一个页面
        $phpexcel->setActiveSheetIndex(1);
        $phpexcel->getActiveSheet()->setTitle('包月泊车费');
        $phpexcel->getActiveSheet()->setCellValue('A1', $this->year.'年'.$village_info['village_name'].$project_info['desc'].'包月泊车费明细账');
        //合并单元格
        $phpexcel->getActiveSheet()->mergeCells('A1:J1');
        for ($i=0;$i<5;$i++){
            $num=PHPExcel_Cell::stringFromColumnIndex($i);
            $phpexcel->getActiveSheet()->mergeCells($num.'2:'.$num.'3');
        }
        $phpexcel->getActiveSheet()->setCellValue('F2', '合计');
        $phpexcel->getActiveSheet()->getStyle('F2')->getFont()->setName('黑体');
        $phpexcel->getActiveSheet()->getStyle('F2')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('F3', '上年应收');
        $phpexcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
        $phpexcel->getActiveSheet()->setCellValue('G3', '本年应收已收');
        $phpexcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
        $phpexcel->getActiveSheet()->setCellValue('H3', '本年实收');
        $phpexcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
        $phpexcel->getActiveSheet()->setCellValue('I3', '年末应收');
        $phpexcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
        $phpexcel->getActiveSheet()->mergeCells('F2:I2');
        for($i=1;$i<=$this->month_number;$i++) {
            $min=7+$i*2;
            $max=$min+1;
            $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min).'2', $i.'月');
            $phpexcel->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($min).'2')->getFont()->setName('黑体');
            $phpexcel->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($min).'2')->getFont()->setBold(true);
            $phpexcel->getActiveSheet()->mergeCells(PHPExcel_Cell::stringFromColumnIndex($min).'2:'.PHPExcel_Cell::stringFromColumnIndex($max).'2');
            $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min).'3', '应收已收');
            $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min+1).'3', '本月实收');
            $phpexcel->getActiveSheet()->getColumnDimension(PHPExcel_Cell::stringFromColumnIndex($min))->setWidth(15);
            $phpexcel->getActiveSheet()->getColumnDimension(PHPExcel_Cell::stringFromColumnIndex($min+1))->setWidth(15);
        }
        $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min+2).'3', '备注');
        //设置字体样式
        $phpexcel->getActiveSheet()->getStyle('A1')->getFont()->setName('黑体');
        $phpexcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
        $phpexcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);



        //填入表头
        $phpexcel->getActiveSheet()->setCellValue('A3', '序号');
        $phpexcel->getActiveSheet()->getStyle('A3')->getFont()->setName('黑体');
        $phpexcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('B3', '房号');
        $phpexcel->getActiveSheet()->getStyle('B3')->getFont()->setName('黑体');
        $phpexcel->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('C3', '客户名称');
        $phpexcel->getActiveSheet()->getStyle('C3')->getFont()->setName('黑体');
        $phpexcel->getActiveSheet()->getStyle('C3')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('D3', '车位数');
        $phpexcel->getActiveSheet()->getStyle('D3')->getFont()->setName('黑体');
        $phpexcel->getActiveSheet()->getStyle('D3')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('E3', '月应收');
        $phpexcel->getActiveSheet()->getStyle('E3')->getFont()->setName('黑体');
        $phpexcel->getActiveSheet()->getStyle('E3')->getFont()->setBold(true);

        $data=$property->carspace();
        $fee_list=$data['fee_list'];
        $sum=$data['sum'];

        foreach ($fee_list as $key=>$value){
            $low=$key+4;
            $phpexcel->getActiveSheet()->setCellValue('A'.$low, $key+1);
            $phpexcel->getActiveSheet()->setCellValue('B'.$low, $value['room_name']);
            $phpexcel->getActiveSheet()->setCellValue('C'.$low, $value['name']);
            $phpexcel->getActiveSheet()->setCellValue('D'.$low, '1');
            $phpexcel->getActiveSheet()->setCellValue('E'.$low, $value['carspace_price']);
            $phpexcel->getActiveSheet()->setCellValue('F'.$low, number_format($value['sum_last'],2));
            $phpexcel->getActiveSheet()->setCellValue('G'.$low, number_format($value['sum_recive'],2));
            $phpexcel->getActiveSheet()->setCellValue('H'.$low, number_format($value['sum_true'],2));
            $phpexcel->getActiveSheet()->setCellValue('I'.$low, number_format($value['sum_nowend'],2));
            foreach ($value['list'] as $key1=>$value1){
                $min=7+$key1*2;
                $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min).$low, number_format($value1['pay_recive'],2));
                $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min+1).$low, number_format($value1['pay_true'],2));
            }
            $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min+2).$low, $value['remark']);
        }
        $low=$low+1;
        $phpexcel->getActiveSheet()->setCellValue('B'.$low, '合计');
        $phpexcel->getActiveSheet()->mergeCells('B'.$low.':C'.$low);
        $phpexcel->getActiveSheet()->setCellValue('D'.$low, number_format($sum['num'],2));
        $phpexcel->getActiveSheet()->setCellValue('E'.$low, number_format($sum['allprice'],2));
        $phpexcel->getActiveSheet()->setCellValue('F'.$low, number_format($sum['sum_last'],2));
        $phpexcel->getActiveSheet()->setCellValue('G'.$low, number_format($sum['sum_nowrecive'],2));
        $phpexcel->getActiveSheet()->setCellValue('H'.$low, number_format($sum['sum_nowtrue'],2));
        $phpexcel->getActiveSheet()->setCellValue('I'.$low, number_format($sum['sum_nowend'],2));
        for($i=1;$i<=$this->month_number;$i++) {
            $min=7+$i*2;
            $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min).$low, number_format($sum['list'][$i]['sum_recive'],2));
            $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min+1).$low, number_format($sum['list'][$i]['sum_true'],2));
        }
        $phpexcel->getActiveSheet()->freezePaneByColumnAndRow(1,4);
        //设置背景颜色
        $phpexcel->getActiveSheet()->getStyle('F2:I'.$low)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $phpexcel->getActiveSheet()->getStyle( 'F2:I'.$low)->getFill()->getStartColor()->setARGB('FFFF99CC');
        //设置边框样式
        $phpexcel->getActiveSheet()->getStyle('A2:'.PHPExcel_Cell::stringFromColumnIndex($min+2).$low)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);

        //各种杂费创建
        $type_list_all=M('house_village_otherfee_type')->where(array('status'=>1,'village_id'=>$this->village_id,))->order('rank asc')->select();
        foreach ($type_list_all as $key=>$value){

            $phpexcel->createSheet();//新建一个页面
            $phpexcel->setActiveSheetIndex($key+2);
            $sheet=$key+2;
            $phpexcel->getActiveSheet()->setTitle($value['otherfee_type_name']);
            $phpexcel->getActiveSheet()->setCellValue('A1', $this->year.'年'.$village_info['village_name'].$project_info['desc'].$value['otherfee_type_name'].'明细账');
            //合并单元格
            $phpexcel->getActiveSheet()->mergeCells('A1:J1');
            for ($i=0;$i<3;$i++){
                $num=PHPExcel_Cell::stringFromColumnIndex($i);
                $phpexcel->getActiveSheet()->mergeCells($num.'2:'.$num.'3');
            }
            $phpexcel->getActiveSheet()->setCellValue('D2', '合计');
            $phpexcel->getActiveSheet()->getStyle('D2')->getFont()->setName('黑体');
            $phpexcel->getActiveSheet()->getStyle('D2')->getFont()->setBold(true);
            if($value['type']==1){
                $phpexcel->getActiveSheet()->setCellValue('D3', '上年应收');
                $phpexcel->getActiveSheet()->setCellValue('E3', '本年应收');
                $phpexcel->getActiveSheet()->setCellValue('F3', '本年实收');
                $phpexcel->getActiveSheet()->setCellValue('G3', '年末应收');
            }else{
                $phpexcel->getActiveSheet()->setCellValue('D3', '上年结转');
                $phpexcel->getActiveSheet()->setCellValue('E3', '本年实收');
                $phpexcel->getActiveSheet()->setCellValue('F3', '本年实退');
                $phpexcel->getActiveSheet()->setCellValue('G3', '年末余额');
            }
            $phpexcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
            $phpexcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
            $phpexcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
            $phpexcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);

            $phpexcel->getActiveSheet()->mergeCells('D2:G2');
            for($i=1;$i<=$this->month_number;$i++) {
                $min=5+$i*2;
                $max=$min+1;
                $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min).'2', $i.'月');
                $phpexcel->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($min).'2')->getFont()->setName('黑体');
                $phpexcel->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($min).'2')->getFont()->setBold(true);
                $phpexcel->getActiveSheet()->mergeCells(PHPExcel_Cell::stringFromColumnIndex($min).'2:'.PHPExcel_Cell::stringFromColumnIndex($max).'2');
                if($value['type']==1){
                    $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min).'3', '本月应收');
                    $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min+1).'3', '本月实收');
                }else{
                    $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min).'3', '本月实收');
                    $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min+1).'3', '本月实退');
                }
                $phpexcel->getActiveSheet()->getColumnDimension(PHPExcel_Cell::stringFromColumnIndex($min))->setWidth(15);
                $phpexcel->getActiveSheet()->getColumnDimension(PHPExcel_Cell::stringFromColumnIndex($min+1))->setWidth(15);
            }
            $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min+2).'3', '备注');
            //设置字体样式
            $phpexcel->getActiveSheet()->getStyle('A1')->getFont()->setName('黑体');
            $phpexcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
            $phpexcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);



            //填入表头
            $phpexcel->getActiveSheet()->setCellValue('A3', '序号');
            $phpexcel->getActiveSheet()->getStyle('A3')->getFont()->setName('黑体');
            $phpexcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
            $phpexcel->getActiveSheet()->setCellValue('B3', '房号');
            $phpexcel->getActiveSheet()->getStyle('B3')->getFont()->setName('黑体');
            $phpexcel->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);
            $phpexcel->getActiveSheet()->setCellValue('C3', '客户名称');
            $phpexcel->getActiveSheet()->getStyle('C3')->getFont()->setName('黑体');
            $phpexcel->getActiveSheet()->getStyle('C3')->getFont()->setBold(true);

            $data=$property->other($value['otherfee_type_id']);
            $fee_list=$data['fee_list'];
            $sum=$data['sum'];

            foreach ($fee_list as $key=>$value){
                $low=$key+4;
                $phpexcel->getActiveSheet()->setCellValue('A'.$low, $key+1);
                $phpexcel->getActiveSheet()->setCellValue('B'.$low, $value['room_name']);
                $phpexcel->getActiveSheet()->setCellValue('C'.$low, $value['name']);
                $phpexcel->getActiveSheet()->setCellValue('D'.$low, number_format($value['sum_last'],2));
                $phpexcel->getActiveSheet()->setCellValue('E'.$low, number_format($value['sum_recive'],2));
                $phpexcel->getActiveSheet()->setCellValue('F'.$low, number_format($value['sum_true'],2));
                $phpexcel->getActiveSheet()->setCellValue('G'.$low, number_format($value['sum_nowend'],2));
                foreach ($value['list'] as $key1=>$value1){
                    $min=5+$key1*2;
                    $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min).$low, number_format($value1['pay_recive'],2));
                    $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min+1).$low, number_format($value1['pay_true'],2));
                }
                $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min+2).$low, $value['remark']);
            }
            $low=$low+1;
            $phpexcel->getActiveSheet()->setCellValue('B'.$low, '合计');
            $phpexcel->getActiveSheet()->mergeCells('B'.$low.':C'.$low);
            $phpexcel->getActiveSheet()->setCellValue('D'.$low, number_format($sum['sum_last'],2));
            $phpexcel->getActiveSheet()->setCellValue('E'.$low, number_format($sum['sum_nowrecive'],2));
            $phpexcel->getActiveSheet()->setCellValue('F'.$low, number_format($sum['sum_nowtrue'],2));
            $phpexcel->getActiveSheet()->setCellValue('G'.$low, number_format($sum['sum_nowend'],2));
            for($i=1;$i<=$this->month_number;$i++) {
                $min=5+$i*2;
                $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min).$low, number_format($sum['list'][$i]['sum_recive'],2));
                $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min+1).$low, number_format($sum['list'][$i]['sum_true'],2));
            }
            $phpexcel->getActiveSheet()->freezePaneByColumnAndRow(1,4);
            //设置背景颜色
            $phpexcel->getActiveSheet()->getStyle('D2:G'.$low)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
            $phpexcel->getActiveSheet()->getStyle( 'D2:G'.$low)->getFill()->getStartColor()->setARGB('FFFF99CC');

            $phpexcel->getActiveSheet()->getStyle('A2:'.PHPExcel_Cell::stringFromColumnIndex($min+2).$low)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
        }
        //月报表
        $phpexcel->createSheet();//新建一个页面
        $phpexcel->setActiveSheetIndex($sheet+1);
        $phpexcel->getActiveSheet()->setTitle('月报表');
        $phpexcel->getActiveSheet()->setCellValue('A1', $this->year.'年'.$village_info['village_name'].$project_info['desc'].'物业收费月报表');
        $phpexcel->getActiveSheet()->getStyle('A1')->getFont()->setName('黑体');
        $phpexcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
        $phpexcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        //合并单元格
        $phpexcel->getActiveSheet()->mergeCells('A1:J1');

        //填入表头
        $phpexcel->getActiveSheet()->setCellValue('A2', '序号');
        $phpexcel->getActiveSheet()->getStyle('A2')->getFont()->setName('黑体');
        $phpexcel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('B2', '收款名目');
        $phpexcel->getActiveSheet()->getStyle('B2')->getFont()->setName('黑体');
        $phpexcel->getActiveSheet()->getStyle('B2')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $phpexcel->getActiveSheet()->setCellValue('C2', '本年实收累计');
        $phpexcel->getActiveSheet()->getStyle('C2')->getFont()->setName('黑体');
        $phpexcel->getActiveSheet()->getStyle('C2')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        for($i=1;$i<=$this->month_number;$i++) {
            $min=2+$i;
            $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min).'2', $i.'月');
            $phpexcel->getActiveSheet()->getColumnDimension(PHPExcel_Cell::stringFromColumnIndex($min))->setWidth(15);
        }
        $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min+1).'2', '备注');
        $phpexcel->getActiveSheet()->getColumnDimension(PHPExcel_Cell::stringFromColumnIndex($min))->setWidth(20);
        $data=$property->month();
        $fee_list=$data['fee_list'];
        $sum=$data['sum'];

        foreach ($fee_list as $key=>$value){
            $low=$key+3;
            $phpexcel->getActiveSheet()->setCellValue('A'.$low, $key+1);
            $phpexcel->getActiveSheet()->setCellValue('B'.$low, $value['otherfee_type_name']);
            $phpexcel->getActiveSheet()->setCellValue('C'.$low, number_format($value['list']['sum'],2));
            unset($value['list']['sum']);
            $remark=$value['list']['remark'];
            unset($value['list']['remark']);
            foreach ($value['list'] as $key1=>$value1){
                $min=2+$key1;
                if(!empty($value1)){
                    $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min).$low, number_format($value1,2));
                }
            }
            //$phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min+1).$low, $remark);
        }
        $low=$low+1;
        $phpexcel->getActiveSheet()->setCellValue('A'.$low, '合计');
        $phpexcel->getActiveSheet()->mergeCells('A'.$low.':B'.$low);
        $phpexcel->getActiveSheet()->setCellValue('C'.$low, $value['remark']);
        $low1=$low+1;
        $phpexcel->getActiveSheet()->setCellValue('A'.$low1, '其它：线上支付');
        $phpexcel->getActiveSheet()->mergeCells('A'.$low1.':B'.$low1);
        $low1=$low+2;
        $phpexcel->getActiveSheet()->setCellValue('A'.$low1, '现金');
        $phpexcel->getActiveSheet()->mergeCells('A'.$low1.':B'.$low1);
        $low1=$low+3;
        $phpexcel->getActiveSheet()->setCellValue('A'.$low1, '转账');
        $phpexcel->getActiveSheet()->mergeCells('A'.$low1.':B'.$low1);
        $low1=$low+4;
        $phpexcel->getActiveSheet()->setCellValue('A'.$low1, 'POS单');
        $phpexcel->getActiveSheet()->mergeCells('A'.$low1.':B'.$low1);
        $low1=$low+5;
        $phpexcel->getActiveSheet()->setCellValue('A'.$low1, '现金缴款单');
        $phpexcel->getActiveSheet()->mergeCells('A'.$low1.':B'.$low1);
        $min=2;
        $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min).$low, number_format($sum['sum'],2));
        $low1=$low+1;
        $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min).$low1, number_format($sum['1'],2));
        $low1=$low+2;
        $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min).$low1, number_format($sum['2'],2));
        $low1=$low+3;
        $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min).$low1, number_format($sum['3'],2));
        $low1=$low+4;
        $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min).$low1, number_format($sum['4'],2));
        $low1=$low+5;
        $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min).$low1, number_format($sum['5'],2));
        for($i=1;$i<=$this->month_number;$i++) {
            $min=2+$i;
            $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min).$low, number_format($sum['list'][$i]['sum'],2));
            $low1=$low+1;
            $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min).$low1, number_format($sum['list'][$i]['1'],2));
            $low1=$low+2;
            $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min).$low1, number_format($sum['list'][$i]['2'],2));
            $low1=$low+3;
            $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min).$low1, number_format($sum['list'][$i]['3'],2));
            $low1=$low+4;
            $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min).$low1, number_format($sum['list'][$i]['4'],2));
            $low1=$low+5;
            $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($min).$low1, number_format($sum['list'][$i]['5'],2));
        }

        $phpexcel->getActiveSheet()->getStyle('A2:'.PHPExcel_Cell::stringFromColumnIndex($min).$low1)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);



        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=".$this->year."年".$village_info['village_name'].$project_info['desc']."物业收费登记账.xls");
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

    public function owner_uptown_excel_to_data($file,$village_id,$project_id,$fee_lastyear_id,$year){
        //set_time_limit(0);
        $arr = import_excel_sheet($file,'k','1500','0','4');
        $tmp = array();
        unset($arr[0]);
        unset($arr[1]);
        unset($arr[2]);
        $project=M('house_village_project')->where('pigcms_id='.$project_id)->find();
        if($fee_lastyear_id=='property'){
            $key_list=array(
                'lastyear_receive'=>6,
                'lastyear_advance'=>7,
            );
        }elseif($fee_lastyear_id=='carspace'){
            $key_list=array(
                'lastyear_receive'=>5,
            );
        }else{
            $key_list=array(
                'lastyear_receive'=>3,
            );
        }
        foreach($arr as $key=> $row){
            if(empty($row[1]))continue;
            $rid=M('house_village_room')->where(array('project_id'=>$project_id,'room_name'=>$row['1']))->find()['id'];
            if(empty($rid))continue;
            $fee_lastyear=M('house_village_room_fee_lastyear')->where(array('rid'=>$rid,'year'=>$year,'type'=>$fee_lastyear_id))->select();
            $data=array();
            foreach ($key_list as $key1=>$value){
                $data[$key1]=(string)$row[$value];
            }
            $save=array('rid'=>$rid,'data'=>serialize($data),'type'=>$fee_lastyear_id,'year'=>$year);
            if($fee_lastyear_id=='carspace'){
                $save['carspace_id']=M('house_village_user_car')->where('rid='.$rid)->find()['pigcms_id'];
            }
            if(empty($fee_lastyear)){
                M('house_village_room_fee_lastyear')->data($save)->add();
            }else{
                M('house_village_room_fee_lastyear')->data($save)->where('fee_lastyear_id='.$fee_lastyear['fee_lastyear_id'])->save();
            }
        }
        $this->success('成功导入');

        //return $data;
    }

    /**
     * @author zhukeqin
     * 添加物业缴费详细
     */
    public function add_property_fee(){
        if(IS_POST){

        }else{
            $this->display();
        }
    }
    public function ajax_change(){
        if(!empty($_GET['rid'])){
            $_SESSION['rid']=$_GET['rid'];
        }
    }
    /**
     * @author zhukeqin
     * ajax获取房间信息  用于自动补全
     */
    public function ajax_room_list(){
        if(empty($_GET['project_id'])){
            $project_id=$_SESSION['project_id'];
        }else{
            $project_id=$_GET['project_id'];
        }
        $keyword=$_POST['keyword'];
        $where=array(
            'project_id'=>$project_id,
            'fid'=>array('neq','0')
        );
        if(empty($_POST['type'])){
            $where['room_name']= array('like','%'.$keyword.'%');
        }else{
            $where['room_name']= $keyword;
        }
        $field=array(
            'r.*',
            'rt.property_unit'
        );
        $roomlist=M('house_village_room')
            ->alias('r')
            ->join('left join __HOUSE_VILLAGE_ROOM_TYPE__ rt on rt.pigcms_id=r.room_type')
            ->where($where)
            ->limit('10')
            ->field($field)
            ->select();
        $result=array();
        foreach ($roomlist as $key=>$value){
            $user_info=M('house_village_user_bind')->where('pigcms_id='.$value['owner_id'])->find();
            $value['user_info']=$user_info;
            $result[]=array('title'=>$value['room_name'],'result'=>$value);
        }
        echo json_encode(array('data'=>$result));
    }
    /**
     * @author zhukeqin
     * ajax获取类型及相关信息
     */
    public function ajax_otherfee_type(){
        $otherfee_type_id=$_POST['otherfee_type_id'];

        $room_name=$_POST['room_name'];
        $room_info=M('house_village_room')->where(array('room_name'=>$room_name,'project_id'=>$this->project_id))->find();
        if(empty($room_info)){
            $room_info=M('house_village_room')->where(array('room_name'=>$room_name))->find();
        }
        $_SESSION['rid']=$room_info['id'];
        if($otherfee_type_id=='property'){
            $data=M('house_village_room_uptown')->where(array('rid'=>$room_info['id']))->find();
        }elseif ($otherfee_type_id=='carspace'){
            $data=M('house_village_user_car')->where(array('rid'=>$room_info['id']))->select();
        }else{
            $data=M('house_village_otherfee_type')->where(array('otherfee_type_id'=>$otherfee_type_id))->find();
            $where = array(
                'otherfee_type_id'=>$otherfee_type_id,
                'rid'              =>$room_info['id'],
                'village_id'       =>$this->village_id,
            );

            //计算剩余应交金额
            $info = $this->get_house_village_water($room_info['id'],$data['otherfee_type_name']);
            $info['balance'] = M('house_village_otherfee')->where($where)->order('creattime desc')->find()['balance'];
            //dump($info);die;
            $info['fee_receive'] = ($info['end_code'] - $info['start_code'])*$info['price'] - $info['balance'];//应收
            $info['fee_true'] = ($info['end_code'] - $info['start_code'])*$info['price'];//实收
            //取出月份
            $res = $this->get_water_mouth($room_info['id'],$data['otherfee_type_name']);
            foreach($res as $v){
                $arr[] = strtotime(str_replace('.','-',$v['start_time']));
                $arr1[] = strtotime(str_replace('.','-',$v['end_time']));
            }

            if(!empty($arr) && !empty($arr1)){
                $start_time = date("Y-m-d",min($arr));
                $end_time = date("Y-m-d",max($arr1));
            }
        }

        echo json_encode(array('type'=>$otherfee_type_id,'data'=>$data,'info'=>$info,'start_time'=>$start_time,'end_time'=>$end_time,'rid'=>$room_info['id']));
    }

    public function get_water_mouth($rid,$type)
    {
        return M('house_village_water')->where(array('rid'=>$rid,'type'=>$type,'result'=>0))->field('start_time,end_time')->select();
    }

    public function get_house_village_water($rid,$type)
    {
        return M('house_village_water')->where(array('rid'=>$rid,'type'=>$type,'result'=>0))->field("sum(start_code) start_code,sum(end_code) end_code,price,rid")->find();
    }
    /**
     * @author zhukeqin
     * ajax 获取应付价格
     */
    public function ajax_fee_get(){
        $type=$_POST['type'];
        $room_name=$_POST['room_name'];
        $month=$_POST['month'];
        if($type=='property'){
            $room_info=M('house_village_room')->where(array('room_name'=>$room_name,'project_id'=>$this->project_id))->find();
            $_SESSION['rid']=$room_info['id'];
            $property_price=M('house_village_room_type')->where('pigcms_id='.$room_info['room_type'])->find();
            $result['pay_recive']=$result['pay_true']=round($room_info['roomsize']*$property_price['property_unit']*$month,2);
            $result['unit']=$property_price['property_unit'];
        }else{
            $carspace_info=M('house_village_user_car')->where('pigcms_id='.$room_name)->find();
            $result['pay_recive']=$result['pay_true']=round($carspace_info['carspace_price']*$month,2);
            $result['unit']=$carspace_info['carspace_price'];
        }
        echo json_encode($result);
    }
    /**
     * @author zhukeqin
     * ajax 添加费用
     */
    public function ajax_in_fee(){
        //dump($_POST);die;
        $room_name=$_POST['room_name'];
        $type=$_POST['otherfee_type_id'];
        $room_info=M('house_village_room')->where(array('room_name'=>$room_name,'project_id'=>$this->project_id))->find();
        if(empty($room_info)){
            $room_info = M('house_village_room')->where(array('room_name'=>$room_name))->find();
        }
        if(empty($room_info)){
            echo json_encode(array('err'=>1,'msg'=>'该房间不存在'));
            die;
        }
        $model=new RoomModel();
        $property_model=new PropertyModel();
        if($type=='property'){
            $result=$model->add_propertylist($room_info['id'],$_POST['type'],$_POST['property_mouth'],$_POST['property_true'],$_SESSION['admin_id'],'1',$_POST['remark'],$_POST['property_recive']);
            $property_model->property_update_cache($room_info['id']);
        }elseif($type=='carspace'){
            $result=$model->add_carspacelist($room_info['id'],$_POST['carspace_id'],$_POST['type'],$_POST['carspace_mouth'],$_POST['property_true'],$_SESSION['admin_id'],'1',$_POST['remark']);
            $property_model->carspace_update_cache($_POST['carspace_id']);
        }else{
            $check=M('house_village_otherfee_type')->where(array('village_id'=>$this->village_id,'status'=>1,'otherfee_type_id'=>$type))->find();
            if(!$check){
                echo json_encode(array('err'=>1,'msg'=>'缴费类型不存在'));
                die;
            }
            if(empty($_POST['fee_true'])) $_POST['fee_true']=$_POST['fee_receive'];
            if(!empty($_POST['code_end'])&&!empty($_POST['unit'])){
                $_POST['explain'] =';起码:'.$_POST['code_start'].',止码:'.$_POST['code_end'].',单价:'.$_POST['unit'];
            }
            $data=array(
                'otherfee_type_id'=>$type,
                'rid'=>$room_info['id'],
                'village_id'=>$this->village_id,
                'project_id'=>$this->project_id,
                'fee_receive'=>$_POST['fee_receive'],
                'fee_true'=>$_POST['fee_true'],
                'balance'=>$_POST['fee_true'] - $_POST['fee_receive'] - $_POST['balance'],
                'fee_mouth'=>date('Y-n'),
                'fee_time'=>date('Y-n-j'),
                'creattime'=>time(),
                'admin_id'=>$_SESSION['admin_id'],
                'type'=>$_POST['type'],
                'remark'=>$_POST['remark'],
                'status'=>'1',
                'updatetime'=>time(),
                'explain'=>$_POST['explain']
            );
            //修改记录
            $type_name = M('house_village_otherfee_type')->where(array('otherfee_type_id'=>$_POST['otherfee_type_id']))->find()['otherfee_type_name'];

            if(!empty($_POST['start_time']) || !empty($_POST['end_time'])){
                $where = array(
                    'rid'       =>$room_info['id'],
                    'type'      =>$type_name,
                    'start_time'=>array('EGT',$_POST['start_time']),
                    'end_time'  =>array('ELT',$_POST['end_time']),
                );
                M('house_village_water')->where($where)->setField('result',1);
            }

            $result=M('house_village_otherfee')->data($data)->add();
            $property_model->other_update_cache($room_info['id'],$type);
        }
        if($result){
            echo json_encode(array('err'=>0,'msg'=>$room_info['id']));
        }else{
            echo json_encode(array('err'=>1,'msg'=>'添加失败，请重试'));
        }
    }
    /**
     * @author zhukeqin
     * 打印物业费催款单
     */
    public function print_property(){
        if(!empty($_POST['ids'])){
            $where['r.id']=array('IN',$_POST['ids']);
        }
        if(!empty($_POST['project_id'])){
            $where['r.project_id']=$_POST['project_id'];
            $where['ru.property_endtime']=array('lt',date('Y-n-j'));
            $where['_string']='unix_timestamp(ru.property_endtime) <'.time();
        }
        $where['r.village_id']=$this->village_id;
        $field=array(
            'r.*',
            'ru.property_endtime',
            'p.desc'=>'project_name',
            'p.property_phone',
            'ub.name'=>'owner_name',
            'rt.property_unit'=>'room_property_unit'
        );
        $list=M('house_village_room')
            ->alias('r')
            ->join('left join __HOUSE_VILLAGE_ROOM_UPTOWN__ ru on ru.rid=r.id')
            ->join('left join __HOUSE_VILLAGE_USER_BIND__ ub on ub.pigcms_id=r.owner_id')
            ->join('left join __HOUSE_VILLAGE_ROOM_TYPE__ rt on rt.pigcms_id=r.room_type')
            ->join('left join __HOUSE_VILLAGE_PROJECT__ p on p.pigcms_id=r.project_id')
            ->where($where)
            ->field($field)
            ->select();
        $year=date('Y');
        $month=date('m');
        foreach ($list as $key=>$value){
            $cache_year=$year-date('Y',strtotime($value['property_endtime']));
            $cache_month=$month-date('m',strtotime($value['property_endtime']));
            $month_num=$cache_year*12+$cache_month;
            $list[$key]['property_money']=$month_num*$value['roomsize']*$value['room_property_unit'];
        }
        $village_info=M('house_village')->where('village_id='.$this->village_id)->find();
        switch ($village_info['group_id']){
            case 1:$village_info['group_name']='汇得行';break;
            case 2:$village_info['group_name']='靓江';break;
        }
        $this->assign('village_info',$village_info);
        $season=array('1'=>'一','2'=>'二','3'=>'三','4'=>'四');
        $last_time=time()+15*3600*24;
        $last_day=array(
            'year'=>date('Y',$last_time),
            'month'=>date('m',$last_time),
            'day'=>date('d',$last_time),
        );
        $season_number=$season[ceil(date('m')/3)];
        $this->assign('season_number',$season_number);
        $this->assign('last_day',$last_day);
        $this->assign('list',$list);
        $this->display();
    }


    /**
     * @author zhukeqin
     * ajax获取指定时间内的现金缴费笔数以及总和
     */
    public function ajax_cash_sum(){
        $start_time=strtotime(I('post.start_time'));
        $end_time=strtotime(I('post.end_time'))+24*3600;
        $type_id=M('house_village_fee_type')->where(array('type_name'=>'现金'))->find()['type_id'];
        $PropertyModel=new PropertyModel($this->project_id,$this->year);
        $property_sum=$PropertyModel->sum_fee($this->village_id,$this->project_id,'property',$type_id,array($start_time,$end_time));
        $property_count=$PropertyModel->sum_fee($this->village_id,$this->project_id,'property',$type_id,array($start_time,$end_time),'',1);
        $carspace_sum=$PropertyModel->sum_fee($this->village_id,$this->project_id,'carspace',$type_id,array($start_time,$end_time));
        $carspace_count=$PropertyModel->sum_fee($this->village_id,$this->project_id,'carspace',$type_id,array($start_time,$end_time),'',1);
        $otherfee_sum=$PropertyModel->sum_fee($this->village_id,$this->project_id,'other',$type_id,array($start_time,$end_time));
        $otherfee_count=$PropertyModel->sum_fee($this->village_id,$this->project_id,'other',$type_id,array($start_time,$end_time),'',1);

        $sum_cash=number_format($property_sum+$carspace_sum+$otherfee_sum,2);
        $sum_count=$property_count+$carspace_count+$otherfee_count;
        echo json_encode(array('sum_cash'=>$sum_cash,'sum_count'=>$sum_count));
    }

    /**
     *show_detailed
     * 查看明细
     */
    public function show_detailed()
    {
        //echo 1;die;
        $rid = I('get.id');
        $info = M('house_village_water')->alias('a')
            ->join('left join pigcms_house_village_room b on a.rid = b.id')
            ->where(array('a.rid'=>$rid))
            ->field('a.*,b.room_name')
            ->select();
        $data = M('house_village_water')->alias('a')
            ->join('left join pigcms_house_village_room b on a.rid = b.id')
            ->where(array('a.rid'=>$rid))
            ->field('a.*,b.room_name')
            ->find();
        $this->assign('info',$info);
        $this->assign('data',$data);
        $this->display();
    }

    /**
     * @author zhukeqin
     * 根据月份获取应收和实收金额
     */
    public function ajax_mouth_get()
    {
        $data = $_POST;
        if($data['start_mouth'] < 10){
            $data['start_mouth'] = "0".$data['start_mouth'];
        }
        if($data['end_mouth'] < 10){
            $data['end_mouth'] = "0".$data['end_mouth'];
        }
        $year = date("Y");
        $start_mouth = $year."-".$data['start_mouth'];
        $end_mouth = $year."-".$data['end_mouth'];
        //判断是水费还是电费
        $res=M('house_village_otherfee_type')->where(array('otherfee_type_id'=>$data['otherfee_type_id']))->find();
        $room_info=M('house_village_room')->where(array('room_name'=>$data['room_name']))->find();
        //取出区间内总起码止码和单价
        $info = $this->get_info($room_info['id'],$start_mouth,$end_mouth,$res['otherfee_type_name']);
        //dump($info);die;
        $where = array(
            'rid'              =>$room_info['id'],
            'village_id'       =>$this->village_id,
            'project_id'       =>$this->project_id
        );
        $result = M('house_village_otherfee')->where($where)->order('creattime desc')->find();
        //计算剩余应交金额
        if($result){
            $info['fee_receive'] = ($result['fee_receive']-$result['fee_true'])+($info['end_code'] - $info['start_code'])*$info['price'];
            $info['fee_receive_code'] = $result['fee_receive']-$result['fee_true'];
        }else{
            $info['fee_receive'] = ($info['end_code'] - $info['start_code'])*$info['price'];
            $info['fee_receive_code'] = 0;
        }
        echo json_encode(array('info'=>$info));
    }

    public function get_info($rid,$start_mouth,$end_mouth,$type)
    {
        $where = array(
            'rid' =>$rid,
            'start_time'=>array('EGT',$start_mouth),
            'end_time'  =>array('ELT',$end_mouth),
            'type'      =>$type,
            'result'    =>0
        );
        return M('house_village_water')->where($where)->field("sum(start_code) start_code,sum(end_code) end_code,price,rid")->find();
    }

    /**
     * @author zhukeqin
     * 删除缴费记录
     */
    public function delete_water()
    {
        $id = I('get.id');
        $res = M('house_village_water')->where(array('id'=>$id))->delete();
        if($res){
            $this->success('删除成功');
        }else{
            $this->success('删除失败');
        }
    }
}