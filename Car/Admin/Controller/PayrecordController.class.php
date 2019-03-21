<?php
namespace ThinkPHP\Library\Org\phpexcel;
namespace Admin\Controller;
//use Think\Controller;
use Admin\Common\RbacController;
use Admin\Model\PayrecordModel;
use Think\Page;

class PayrecordController extends RbacController {

    //消费记录列表
    public function showlist_bak(){
        //查询消费记录信息
        //echo strtotime('03-01-2017');exit;
        //为了减轻服务器的压力，建议使用条件进行查询，涉及默认全部查询时我们只显示最近500条（后期可设置到配置项）
        //只显示未逻辑删除的信息
        //实例化本model
        $t1= $_GET['startDate'];//开始时间
        $t2= $_GET['endDate'];//结束时间
        $where="is_del='0'";
        if($t1 && $t2){
            $date="pay_time>='$t1'and pay_time<='$t2'";
            $where.=' and '.$date;
        }
        //$pr_infos=$payrecord->where(array('is_del'=>'0','pay_time'))->order('pay_id desc')->limit(500)->select();
        $user_dbname=C('DB_PREFIX')."payrecord";
        $pr_infos=M()->query("select * from ".$user_dbname." where ".$where." order by pay_id desc limit 1000");//2017.3.31改成1000条
        $payrecord=new \Admin\Model\PayrecordModel();
        //查询对应的用户信息和对应的车牌，已经车辆角色,并将数据返回
        if($pr_infos){
            $user_car_arr=$payrecord->query_user_and_car_info($pr_infos);
        }

        foreach ($user_car_arr['car'] as $k=>&$v){
            $car_info=M('car')->where(array('car_no'=>$v['car_no']))->find();
            $v['car_id']=$car_info['car_id'];
        }
        unset($v);
        //dump($user_car_arr['user']);
        //dump($pr_infos);exit;
        $this->assign('users_arr',$user_car_arr['user']);
        $this->assign('cars_arr',$user_car_arr['car']);

        foreach($pr_infos as $k=>$v){
            $pr_infos[$k]['cp_hilt']=number_format(($v['payment']-$v['pay_loan']),2);
        }

        //计算停车时长
        $pr_infos=$payrecord->count_use_time($pr_infos,$user_car_arr['car']);

        //将数据返回模板
        $this->assign('pr_infos',$pr_infos);

        //调用模板
        $this->display();
    }


    public function _before_showlist(){
        if(session('admin_name')==SUPER_ADMIN){
            $this->assign('admin',1);
            $garageArray = M('garage')->select();
            $this->assign('garageArray',$garageArray);
            if(I('get.garage_id')){
                $presentGarage = M('garage')->find(I('get.garage_id'))['garage_name'];
            }else{
                $presentGarage = '全部显示';
            }
        }else{
            $this->assign('admin',0);
            $presentGarage = M('garage')->find(session('admin_id'))['garage_name'];

        }

        $this->assign('presentGarage',$presentGarage);


    }

    /**
     * 订单记录表 后端分页
     * @update-time: 2017-05-23 11:41:02
     * @author: 王亚雄
     */
    public function showlist(){
        $model = new PayrecordModel();
        //条件
        $map = array();
        if(session('admin_id')!=1){
            if(I('get.garage_id')!=''){
                //进行了人工选择
                $map['serv.garage_id'] = array('eq',I('get.garage_id'));
            }else{
                //没有进行人工选择
                $admin_garage_id = check_garage_filter($this->garage_id);
                if(is_array($admin_garage_id)){
                    //是数组，则代表有多个停车场
                    $map['serv.garage_id'] =array();
                    foreach ($admin_garage_id as $s=>$m){
                        $map['serv.garage_id'][$s] = array('eq',$m);
                    }
                    $map['serv.garage_id'][] = 'or' ;
                }else{
                    $map['serv.garage_id'] = array('eq',$admin_garage_id);
                }
            }
        }else{
            //进行了人工选择
            I('get.garage_id') && $map['serv.garage_id'] = array('eq',I('get.garage_id'));
        }

        //dump($map);exit;

        //搜索条件
        $get = search_filter($_GET);
        //搜索车主与车牌
        isset($get['keywords']) && $map['u.user_name|serv.car_no'] = array("like",'%' . $get['keywords'] . '%');
        //支付状态
        isset($get['pay_status']) && $map['p.pay_status'] = array('eq',$get['pay_status']);
        //时间条件
        if($get['startDate'] && $get['endDate']){
            $map['p.pay_time']=array(array('egt',$get['startDate']),array('elt',$get['endDate']));
        }

        $map['serv.garage_id'] = $this->garage_id;

        //字段
        $field = array(
            'p.pay_id',
            'u.user_id',
            'car.car_id',
            'cp.cp_id',
            'u.user_name', //车主名称
            'serv.car_no', //车牌
            'p.payment', //应付金额
            'p.pay_loan', //实缴金额
            'CASE cp.cp_type' . //优惠金额计算
            ' WHEN ' .CPTYPE_MONEY_FREE .' THEN cp.cp_hilt ' . //金额减免
            ' WHEN ' .CPTYPE_TIME_FREE. ' THEN cp.cp_hilt*' . PARK_FEE_Q1H . //时间减免 量化成金额减免
            ' WHEN ' .CPTYPE_ALL_FREE. ' THEN p.payment' . //全免,量化成金额减免
            ' END'=>'pay_free',//优惠金额
            'g.garage_name',
            'car.car_role', //是否是月卡
            'serv.start_time'=>'in_part_time',//车辆进场时间
            'serv.end_time'=>'out_part_time', //车辆出场时间
            'p.pay_status', //支付状态
            'p.pay_time', //支付时间戳
            'p.create_time', //创建时间戳

        );

        //计算总条数
        $count = $model->alias('p')
            ->field('count(*)')
            ->join('left join __SERVICERECORD__ serv on serv.serv_id = p.serv_id')
            ->join('left join __CAR__ car on car.car_no = serv.car_no')
            ->join('left join __GARAGE__ g on g.garage_id = serv.garage_id')
            ->join('left join __USER__ u on u.user_id = p.user_id')
            ->join('left join __COUPON__ cp on cp.cp_id = p.cp_id ')
            ->where($map)
            ->group('p.pay_id')
            ->select(false);
        //由于使用了group，总条数为
        $count = $model->query("select count(*) as count from ($count) as c")[0]['count'];
        //分页
        $page = new Page($count,I('get.list_rows',0,'int')?:LIST_ROWS);
        //分页数据
        $list = $model->alias('p')
            ->field($field)
            ->join('left join __SERVICERECORD__ serv on serv.serv_id = p.serv_id')
            ->join('left join __CAR__ car on car.car_no = serv.car_no')
            ->join('left join __GARAGE__ g on g.garage_id = serv.garage_id')
            ->join('left join __USER__ u on u.user_id = p.user_id')
            ->join('left join __COUPON__ cp on cp.cp_id = p.cp_id')
            ->where($map)
            ->limit($page->firstRow,$page->listRows)
            ->group('p.pay_id')
            ->order('p.pay_id desc')
            ->select();

        //现金及扫码支付信息
        //字段
        $field2 = array(
            'oi.id',
            'd.desc',
            'oi.payment',
            'oi.pay_loan',
            'g.garage_name',
            'oi.enter_date',
            'oi.pay_type',
        );
        $sTime = $get['startDate']-7*3600;
        $eTime = $get['endDate']-7*3600;
        $other_arr1 = D('offline_income')->alias('oi')
            ->field($field2)
            ->join('left join __DUTY__ d on d.id = oi.duty_id')
            ->join('left join __GARAGE__ g on g.garage_id = oi.garage_id')
            ->where(array('oi.garage_id'=>$this->garage_id,'oi.pay_type'=>0))
            ->where("UNIX_TIMESTAMP(enter_date)>=$sTime and UNIX_TIMESTAMP(enter_date)<=$eTime")
            ->select();

        $other_arr2 = D('offline_income')->alias('oi')
            ->field($field2)
            ->join('left join __DUTY__ d on d.id = oi.duty_id')
            ->join('left join __GARAGE__ g on g.garage_id = oi.garage_id')
            ->where(array('oi.garage_id'=>$this->garage_id,'oi.pay_type'=>1))
            ->where("UNIX_TIMESTAMP(enter_date)>=$sTime and UNIX_TIMESTAMP(enter_date)<=$eTime")
            ->select();

//        dump($other_arr);exit;
        $this->assign('other_arr1',$other_arr1);
        $this->assign('other_arr2',$other_arr2);
        $this->assign('list',$list);
        $this->assign('count',$count);
        $this->assign('pageStr',bootstrap_page_style($page->show()));
        $this->assign('admin',session('admin_id'));
        $this->display('showlist');

    }

    /**
     * 消费记录表 后台分页
     * @update-time: 2017-05-23 15:49:10
     * @author: 王亚雄
     */
    public function showlist_pay(){
        $_GET['qufen'] = 1;
        $_GET['pay_status'] = 1;
//        dump($_GET);exit;
        $this->showlist();
    }

    /**
     * 打印消费记录
     * @author zhukeqin
     *
     */
    public function out_showlist(){
        $_GET['qufen'] = 1;
        $_GET['pay_status'] = 1;
        $model = new PayrecordModel();
        //条件
        $map = array();
        if(session('admin_id')!=1){
            if(I('get.garage_id')!=''){
                //进行了人工选择
                $map['serv.garage_id'] = array('eq',I('get.garage_id'));
            }else{
                //没有进行人工选择
                $admin_garage_id = check_garage_filter($this->garage_id);
                if(is_array($admin_garage_id)){
                    //是数组，则代表有多个停车场
                    $map['serv.garage_id'] =array();
                    foreach ($admin_garage_id as $s=>$m){
                        $map['serv.garage_id'][$s] = array('eq',$m);
                    }
                    $map['serv.garage_id'][] = 'or' ;
                }else{
                    $map['serv.garage_id'] = array('eq',$admin_garage_id);
                }
            }
        }else{
            //进行了人工选择
            I('get.garage_id') && $map['serv.garage_id'] = array('eq',I('get.garage_id'));
        }

        //dump($map);exit;

        //搜索条件
        $get = search_filter($_GET);
        //搜索车主与车牌
        isset($get['keywords']) && $map['u.user_name|serv.car_no'] = array("like",'%' . $get['keywords'] . '%');
        //支付状态
        isset($get['pay_status']) && $map['p.pay_status'] = array('eq',$get['pay_status']);
        //时间条件
        if($get['startDate'] && $get['endDate']){
            $map['p.pay_time']=array(array('egt',$get['startDate']),array('elt',$get['endDate']));
        }

        $map['serv.garage_id'] = $this->garage_id;
        //停车场名称
        $garage_name=M('garage')->where('garage_id='.$this->garage_id)->find()['garage_name'];
        $starttime=date('Y-m-d',$get['startDate']);
        $endtime=date('Y-m-d',$get['endDate']);
        $field = array(
            'p.pay_id',
            'u.user_id',
            'car.car_id',
            'cp.cp_id',
            'u.user_name', //车主名称
            'serv.car_no', //车牌
            'p.payment', //应付金额
            'p.pay_loan', //实缴金额
            'CASE cp.cp_type' . //优惠金额计算
            ' WHEN ' .CPTYPE_MONEY_FREE .' THEN cp.cp_hilt ' . //金额减免
            ' WHEN ' .CPTYPE_TIME_FREE. ' THEN cp.cp_hilt*' . PARK_FEE_Q1H . //时间减免 量化成金额减免
            ' WHEN ' .CPTYPE_ALL_FREE. ' THEN p.payment' . //全免,量化成金额减免
            ' END'=>'pay_free',//优惠金额
            'g.garage_name',
            'car.car_role', //是否是月卡
            'serv.start_time'=>'in_part_time',//车辆进场时间
            'serv.end_time'=>'out_part_time', //车辆出场时间
            'p.pay_status', //支付状态
            'p.pay_time', //支付时间戳
            'p.create_time', //创建时间戳

        );
        $list = $model->alias('p')
            ->field($field)
            ->join('left join __SERVICERECORD__ serv on serv.serv_id = p.serv_id')
            ->join('left join __CAR__ car on car.car_no = serv.car_no')
            ->join('left join __GARAGE__ g on g.garage_id = serv.garage_id')
            ->join('left join __USER__ u on u.user_id = p.user_id')
            ->join('left join __COUPON__ cp on cp.cp_id = p.cp_id')
            ->where($map)
            ->group('p.pay_id')
            ->order('p.pay_id desc')
            ->select();
        $filename=$garage_name.$starttime.'至'.$endtime.'停车收费清单';
        $littlefilename=$garage_name;
        @include_once LIB_PATH.'Org/phpexcel/PHPExcel.php';
        $phpexcel = new \PHPexcel();
        //设置基本信息
        $phpexcel->getProperties()->setCreator("admin")
            ->setLastModifiedBy(session('system.account'))
            ->setTitle($littlefilename)
            ->setSubject("清单列表")
            ->setDescription("")
            ->setKeywords("清单列表")
            ->setCategory("");
        $phpexcel->setActiveSheetIndex(0);
        $phpexcel->getActiveSheet()->setTitle($littlefilename);
        //填入主标题
        $phpexcel->getActiveSheet()->setCellValue('A1', $filename);
        //填入副标题
        $phpexcel->getActiveSheet()->setCellValue('A2', '清单列表(导出日期：'.date('Y-m-d',time()).')');

        //合并单元格
        $phpexcel->getActiveSheet()->mergeCells('A1:L1');
        $phpexcel->getActiveSheet()->mergeCells('A2:L2');

        //设置字体样式
        $phpexcel->getActiveSheet()->getStyle('A1')->getFont()->setName('黑体');
        $phpexcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
        $phpexcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);



        //填入表头
        $phpexcel->getActiveSheet()->setCellValue('A3', 'ID');
        $phpexcel->getActiveSheet()->getStyle('A3')->getFont()->setName('黑体');
        $phpexcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('B3', '消费者');
        $phpexcel->getActiveSheet()->getStyle('B3')->getFont()->setName('黑体');
        $phpexcel->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('C3', '车牌号');
        $phpexcel->getActiveSheet()->getStyle('C3')->getFont()->setName('黑体');
        $phpexcel->getActiveSheet()->getStyle('C3')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('D3', '应付金额');
        $phpexcel->getActiveSheet()->getStyle('D3')->getFont()->setName('黑体');
        $phpexcel->getActiveSheet()->getStyle('D3')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('E3', '实际金额');
        $phpexcel->getActiveSheet()->getStyle('E3')->getFont()->setName('黑体');
        $phpexcel->getActiveSheet()->getStyle('E3')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('F3', '优惠金额');
        $phpexcel->getActiveSheet()->getStyle('F3')->getFont()->setName('黑体');
        $phpexcel->getActiveSheet()->getStyle('F3')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('G3', '临时/月卡');
        $phpexcel->getActiveSheet()->getStyle('G3')->getFont()->setName('黑体');
        $phpexcel->getActiveSheet()->getStyle('G3')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('H3', '停车场');
        $phpexcel->getActiveSheet()->getStyle('H3')->getFont()->setName('黑体');
        $phpexcel->getActiveSheet()->getStyle('H3')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('I3', '停车时长');
        $phpexcel->getActiveSheet()->getStyle('I3')->getFont()->setName('黑体');
        $phpexcel->getActiveSheet()->getStyle('I3')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('J3', '支付时间');
        $phpexcel->getActiveSheet()->getStyle('J3')->getFont()->setName('黑体');
        $phpexcel->getActiveSheet()->getStyle('J3')->getFont()->setBold(true);



        $k = 1;
        foreach ($list as $key=>$value){
            $total_price=0;

            /*if(count($value['room_data'])==0||array_key_exists('',$value['room_data'])){

                //设置居中
                $phpexcel->getActiveSheet()->getStyle('A1:L1'.($k+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                //所有垂直居中
                $phpexcel->getActiveSheet()->getStyle('A1:L2'.($k+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

                //保存数据

                //入住单位（客户名称）
                $phpexcel->getActiveSheet()->setCellValue('B'.($k+3), $value['tenantname']);
                //业主
                $phpexcel->getActiveSheet()->setCellValue('C'.($k+3), $value['ownernames']);
                $k++;
            }else{*/
                            //保存数据
                            //ID
                            $phpexcel->getActiveSheet()->setCellValue('A'.($k+3), $value['pay_id']);
                            //消费者
                            $phpexcel->getActiveSheet()->setCellValue('B'.($k+3), $value['user_name']);
                            //车牌号
                            $phpexcel->getActiveSheet()->setCellValue('C'.($k+3), $value['car_no']);

                            //应付金额
                            $phpexcel->getActiveSheet()->setCellValue('D'.($k+3), $value['payment']);
                            //实缴金额
                            $phpexcel->getActiveSheet()->setCellValue('E'.($k+3), $value['pay_loan']);
                            if(!empty($value['car_role'])){
                                $car_type='月卡车';
                            }elseif(!empty($value['cp_id'])){
                                $car_type=$value['pay_free'].'优惠券';
                            }else{
                                $car_type='';
                            }
                            //优惠金额
                            $phpexcel->getActiveSheet()->setCellValue('F'.($k+3), $car_type);
                            //临时/月卡
                            $phpexcel->getActiveSheet()->setCellValue('G'.($k+3), empty($value['car_role'])?'临时车':'月卡车');
                            //停车场
                            $phpexcel->getActiveSheet()->setCellValue('H'.($k+3), $value['garage_name']);
                            //停车时长
                            $phpexcel->getActiveSheet()->setCellValue('I'.($k+3), empty($value['out_part_time'])?'未出场':howlong($value['out_part_time'],$value['in_part_time']));
                            //支付时间
                            $phpexcel->getActiveSheet()->setCellValue('J'.($k+3), date('Y-m-d H:i:s',$value['pay_time']));

                            $k++;
                        }

        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=$filename.xls");
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0
        $objwriter = \PHPExcel_IOFactory::createWriter($phpexcel, 'Excel5');
        $objwriter->save('php://output');
        exit;

    }

    //消费记录信息删除(逻辑删除)
    public function delete(){
        //接收要被删除的对应的记录id
        $pr_id=I('get.pr_id');
        //将对应的记录进行逻辑删除
        $z=D('payrecord')->where(array('pay_id'=>$pr_id))->save(array('is_del'=>'1'));
        if($z){
            echo json_encode('1');//逻辑删除操作成功！
        }else{
            echo json_encode('2');//逻辑删除操作失败！
        }
    }
    
    
    //消费记录彻底删除(物理删除，不可恢复！)
    public function destroy(){
        //接收要被删除的对应的记录id
        $pr_id=I('get.pr_id');
        //将对应的记录进行逻辑删除
        $z=D('payrecord')->where(array('pay_id'=>$pr_id))->delete();
        if($z){
            echo json_encode('1');//删除操作成功！
        }else{
            echo json_encode('2');//删除操作失败！
        }
    }
    
    
    //消费记录回收站列表展示
    public function recycle(){
        //查询所有被逻辑删除的车辆信息
        //为了减轻服务器的压力，建议使用条件进行查询，涉及默认全部查询时我们只显示最近500条（后期可设置到配置项）
        $pr_infos=D('payrecord')->where(array('is_del'=>'1'))->limit(500)->select();
        
        //将数据返回模板
        $this->assign('pr_infos',$pr_infos);
        
        
        //调用模板
        $this->display();
    }
    
    
    //消费记录逻辑删除数据恢复
    public function recover(){
        //接收要被恢复的对应的记录id
        $pr_id=I('get.pr_id');
        //将对应的记录进行恢复
        $z=D('payrecord')->where(array('pay_id'=>$pr_id))->save(array('is_del'=>'0'));
        if($z){
            echo json_encode('1');//恢复操作成功！
        }else{
            echo json_encode('2');//恢复操作失败！
        }
    }
    
    
    //消费信息详情页
    public function detail(){
        //接收对应的pr_id
        $pr_id=I('get.pay_id');

        if(!$pr_id){
            $this->error('非法操作',U('Servicerecord/showlist'),1);
        }

        $payrecord=new \Admin\Model\PayrecordModel();
        
        //查询对应的车辆详情信息
        $pr_info=$payrecord->find($pr_id);
        
        //查询本次消费用户的所有信息
        $uid=(int)$pr_info['user_id'];
        $user_info=D('user')->field('user_pwd',true)->where(array('user_id'=>$uid))->find();
        
        //判断产生记录类型，查询对应的记录
        //例如1为停车消费，2为洗车消费，3为美容消费 
        if( $pr_info['pay_type']==1 ){
            //查询停车记录表 
            $serv_info=D('servicerecord')->where(array('serv_id'=>$pr_info['serv_id']))->find();
            
            //查询对应的车场名称
            $serv_info['garage_name']=D('garage')->where(array('garage_id'=>$serv_info['garage_id']))->getField('garage_name');
            
            //查询对应的当值人员
        }

        //算出优惠金额
        $pr_info['cp_hilt']=number_format(($pr_info['payment']-$pr_info['pay_loan']),2);

        //算出停车时长
        if($serv_info['end_time']==0){
            $serv_info['end_time']=time();  //如果不存在则以现在时间为准，如果出现时间异常偏大，说明该车辆是以现金缴费方式出场
        }
        $serv_info['use_time_one']=$payrecord->make_easy_time($serv_info['end_time']-$serv_info['start_time']);

        //列出当前用户的所有消费记录
        $all_datas=$payrecord->query_single_order($uid);
        $this->assign('users_arr',$all_datas['user_car_arr']['user']);
        $this->assign('cars_arr',$all_datas['user_car_arr']['car']);
        //将数据返回模板
        //dump($all_datas);exit;
        $this->assign('pr_infos',$all_datas['pr_infos']);


        //将数据返回模板
        $this->assign('pr_info',$pr_info);
        $this->assign('user_info',$user_info);
        $this->assign('serv_info',$serv_info);
        
        //调用模板
        $this->display();
    }


    //条件搜索页
    public function payrecord_search(){

        //调用模板
        $this->display();
    }


    //根据时间进行搜索
    public function search_by_time_c(){
        //接收对应的数据，查询对应的结果集
        $search_type=I('post.search_type');
        if(!$search_type){return false;}
        //实例化本model
        $payrecord=new \Admin\Model\PayrecordModel();

        //①：根据时间作为查询条件
        if($search_type=='time'){
            $start_time=I('post.start_time');
            $end_time=I('post.end_time');
            $payrecord_infos=$payrecord->search_by_time_m($start_time,$end_time);
            if($payrecord_infos) {
                echo json_encode($payrecord_infos); //一维数组转json
            }else{
                echo 1; //无结果
            }
        }
    }

    /*消费记录表
     * @author 祝君伟
     * @time 2017.1.24
     * */
    public function showlist_pay_bak(){
        //查询消费记录信息
        //为了减轻服务器的压力，建议使用条件进行查询，涉及默认全部查询时我们只显示最近500条（后期可设置到配置项）
        //只显示未逻辑删除的信息
        //实例化本model
        $t1= $_GET['startDate'];//开始时间
        $t2= $_GET['endDate'];//结束时间
        $where="is_del='0' and pay_time !=0";
        if($t1 && $t2){
            $date="pay_time>='$t1'and pay_time<='$t2'";
            $where.=' and '.$date;
        }
        //$pr_infos=$payrecord->where(array('is_del'=>'0','pay_time'))->order('pay_id desc')->limit(500)->select();
        $user_dbname=C('DB_PREFIX')."payrecord";
        $pr_infos=M()->query("select * from ".$user_dbname." where ".$where." order by pay_id desc limit 500");
        $payrecord=new \Admin\Model\PayrecordModel();
        //查询对应的用户信息和对应的车牌，已经车辆角色,并将数据返回
        if($pr_infos){
            $user_car_arr=$payrecord->query_user_and_car_info_pay($pr_infos);
        }
        foreach ($user_car_arr['car'] as $k=>&$v){
            $car_info=M('car')->where(array('car_no'=>$v['car_no']))->find();
            $v['car_id']=$car_info['car_id'];
        }
        unset($v);
        $this->assign('users_arr',$user_car_arr['user']);
        $this->assign('cars_arr',$user_car_arr['car']);

        foreach($pr_infos as $k=>$v){
            $pr_infos[$k]['cp_hilt']=number_format(($v['payment']-$v['pay_loan']),2);
        }

        //计算停车时长
        $pr_infos=$payrecord->count_use_time($pr_infos,$user_car_arr['car']);


        //将数据返回模板
        $this->assign('pr_infos',$pr_infos);


        //调用模板
        $this->display('showlist_pay');

    }


    /*不同时间段值班收入
    * @author 祝君伟
    * @time 2017.3.17
    * */
    public function this_job_money(){
        //查询消费记录信息
        $time_start = I('get.startDate');//开始时间
        $time_end = I('get.endDate');//结束时间
        $state = I('get.state');
        $time_start=strtotime($time_start);
        $time_end=strtotime($time_end);
       /* $time_start=1489593600;
        $time_end=1489680000;
        $state ='1';*/
        $where="is_del='0' and pay_time !=0";
        if($time_start && $time_end){
            $date="pay_time>='$time_start'and pay_time<='$time_end'";
            $where.=' and '.$date;
        }
        if($state =='0') {
            $job_begin=$time_start + 7*60*60;
            $job_end=$time_start+15*60*60;

        }else if($state =='1'){
            $job_begin=$time_start+15*60*60;
            $job_end=$time_start+23*60*60;
        }else{
            $job_begin=$time_start;
            $job_end=$time_start + 7*60*60;
        }
        $job_array=M('payrecord')->query("select * from ".C('DB_PREFIX')."payrecord where pay_time>".$job_begin." and pay_time<".$job_end." and pay_status='1' order by pay_id desc");
        //查询对应的用户信息和对应的车牌，已经车辆角色,并将数据返回
        //将数据返回模板
        $payrecord=new \Admin\Model\PayrecordModel();
        if($job_array){
            $user_car_arr=$payrecord->query_user_and_car_info_pay($job_array);
        }
        foreach ($user_car_arr['car'] as $k=>&$v){
            $car_info=M('car')->where(array('car_no'=>$v['car_no']))->find();
            $v['car_id']=$car_info['car_id'];
        }
        unset($v);
        $this->assign('users_arr',$user_car_arr['user']);
        $this->assign('cars_arr',$user_car_arr['car']);

        foreach($job_array as $k=>$v){
            $job_array[$k]['cp_hilt']=number_format(($v['payment']-$v['pay_loan']),2);
        }

        //计算停车时长
        $job_array=$payrecord->count_use_time($job_array,$user_car_arr['car']);
        $this->assign('pr_infos',$job_array);
        //dump($job_array);exit;
        //调用模板
        $this->display();

    }
    
    /*
     * 当前订单消费详情
     *  陈琦
     * 2016.2.9
     */
    public function now_order(){
        //接收对应的pr_id
        $pr_id=I('get.pay_id');

        if(!$pr_id){
            $this->error('非法操作',U('Servicerecord/showlist'),1);
        }

        $payrecord=new \Admin\Model\PayrecordModel();

        //查询对应的车辆详情信息
        $pr_info=$payrecord->find($pr_id);

        //查询本次消费用户的所有信息
        $uid=(int)$pr_info['user_id'];
        $user_info=D('user')->field('user_pwd',true)->where(array('user_id'=>$uid))->find();

        //判断产生记录类型，查询对应的记录
        //例如1为停车消费，2为洗车消费，3为美容消费 
        if( $pr_info['pay_type']==1 ){
            //查询停车记录表 
            $serv_info=D('servicerecord')->where(array('serv_id'=>$pr_info['serv_id']))->find();

            //查询对应的车场名称
            $serv_info['garage_name']=D('garage')->where(array('garage_id'=>$serv_info['garage_id']))->getField('garage_name');

            //查询对应的当值人员
        }

        //算出优惠金额
        $pr_info['cp_hilt']=number_format(($pr_info['payment']-$pr_info['pay_loan']),2);

        //算出停车时长
        if($serv_info['end_time']==0){
            $serv_info['end_time']=time();  //如果不存在则以现在时间为准，如果出现时间异常偏大，说明该车辆是以现金缴费方式出场
        }
        $serv_info['use_time_one']=$payrecord->make_easy_time($serv_info['end_time']-$serv_info['start_time']);

        //列出当前用户的所有消费记录
        $all_datas=$payrecord->query_single_order($uid);
        $this->assign('users_arr',$all_datas['user_car_arr']['user']);
        $this->assign('cars_arr',$all_datas['user_car_arr']['car']);
        //将数据返回模板
        //dump($all_datas);exit;
        $this->assign('pr_infos',$all_datas['pr_infos']);


        //将数据返回模板
        $this->assign('pr_info',$pr_info);
        $this->assign('user_info',$user_info);
        $this->assign('serv_info',$serv_info);

        //调用模板
        $this->display();
    }



        /*消费记录表
         * @author 王亚雄
         * @time 2017.03.02
         * */
//        public function showlist_pay(){
//            $model=new \Admin\Model\PayrecordModel();
//            //条件
//            $map = array();
//            $map['p.is_del'] = array('eq','0');
//            $map['s.is_del'] = array('eq','0');
//            $map['u.is_del'] = array('eq','0');
//
//            //选择字段
//            $field = array(  //	ID	消费者	车牌号	应付金额	实缴金额	优惠金额	临时/月卡	停车时长	支付时间
//                 'p.pay_id',
//                 'p.user_id',
//                 'u.user_wxnik',
//                 'u.user_name',
//                 's.car_no',
//                 'p.payment',
//                 'p.pay_loan',
//                 's.start_time',
//                 's.end_time',
//                 'p.pay_time',
//                 'p.in_bill',
//                 'c.car_id',
//                 'p.pay_status'
//            );
//
//            //分页
//            $count = $model->alias('p')
//                ->where('p.is_del="0"')
//                ->count();
//            $page = new Page($count,500);
//
//            //优化处理，先进行子查询
//            $view =$model
//                ->field('pay_id,payment,pay_loan,pay_time,in_bill,serv_id,user_id,pay_status')
//                ->where('is_del="0"')
//                ->order('pay_id desc')
//                ->limit($page->firstRow,$page->listRows)
//                ->select(false);
//            $list = M('servicerecord')->alias('s')
//                ->field($field)
//                ->join("right join ($view) p on p.serv_id = s.serv_id")
//                ->join('left join __CAR__ c on c.car_no = s.car_no and c.user_id = p.user_id')
//                ->join('left join __USER__ u on u.user_id = p.user_id')
//                ->order('p.pay_id desc')
//                ->select();
//            //发票状态描述
//            $bill_model = D('Bill');
//
//            $this->assign('bill_step',$bill_model->status_step(false));//获取状态描述
//            $this->assign('list',$list);
//            $this->assign('pageStr',$page->show());
//            $this->display();
//
//        }

    /*
     * 订单退款操作
     * 陈琦
     * 2017.2.14
     */
    public function wx_refund(){
        $pr_id=I('post.pr_id');
        $info=M('payrecord')->where(array('pay_id'=>$pr_id))->find();
        $pay_no=$info['pay_no'];
        $fee=I('post.fee');
        $weixin=new \Org\Weixinpay\Weixinpay(array('order_id'=>$pay_no),'','');
        $arr=$weixin->refund($pr_id,$fee);
        if($arr['error']==0){
           echo json_encode($arr);
        }else{
            echo '1';
        }
    }

    /*
     * 公众号发送信息封装方法(文本类)
     * */
    public function send_message_now($openid,$content){
        $weixin=new \Org\Weixinpay\Weixinpay();
        $data = array(
            "touser"=>$openid,
            "msgtype"=>"text",
            "text"=>array(
                "content"=>$content
            )
        );
        $res = $weixin->send_user_message(json_encode($data,JSON_UNESCAPED_UNICODE));
        return $res;
    }
    /*
     * 客服发送信息封装方法(文本类)
     * */
    public function send_message_service(){
        $weixin=new \Org\Weixinpay\Weixinpay();
        $data = array(
            "touser"=>'oRn56wDSr7lDE63hX8VuBzLR4mYc',
            "msgtype"=>"text",
            "text"=>array(
                "content"=>'我是测试客服'
            ),
            "customservice"=>array(
                "kf_account"=>"kf2001@hdhzhzs"
            ),
        );
        $res = $weixin->send_user_message(json_encode($data,JSON_UNESCAPED_UNICODE));
        return $res;
    }

    /*
     * 向用户单独发送信息
     * @author 祝君伟
     * @time 2017.3.21
     * */
    public function system_send_user(){
        $openid = I('post.openid');
        $content = I('post.content');
        $result_code = $this->send_message_now($openid,$content);
        if($result_code['errmsg']=='ok'){
            //向聊天记录表中插入数据
            $data = array(
                'user_wxopid'=>$openid,
                'create_time'=>time(),
                'msg_type'=>'text',
                'content'=>$content
            );
            $result_add = M()->table('pigcms_user_record')->data($data)->add();
            if($result_add){
                echo '1';
            }else{
                //维护本地数据库失败
                echo '0005';
            }
        }else{
            //发送客服信息失败
            echo $result_code['errmsg'];
        }
    }

    /*
     * ajax长轮询方法
     * */
    public function user_send_system(){
        $time = I('post.time');
        $user_wxopid = I('post.user_wxopid');
        if(empty($time)) exit();
        set_time_limit(0);// 无限请求超时时间
        usleep($time);// 等待时间
        while(true){
            //在数据库中查找相应的最后条未读数据出来
            $user_record_array = D()->table('pigcms_user_record')->where(array('user_wxopid'=>$user_wxopid,'msg_id'=>array('neq',0)))->order('pigcms_id desc')->find();
            $user_info_array = M('user')->where(array('user_wx_opid'=>$user_wxopid))->find();
            if(empty($user_record_array)){
                $arr = array('success'=>'0','error'=>'无新数据');
                echo json_encode($arr);
                exit();
            }else{
                if($user_record_array['state'] == 0){
                    $arr = array('success'=>'1','headerimg'=>$user_info_array['user_headerimg'],'user_name'=>$user_info_array['user_name'],'create_time'=>date('Y-m-d H:i:s',$user_record_array['create_time']),'user_content'=>$user_record_array['content']);
                    echo json_encode($arr);
                    //将标记改信息为已经查看
                    M()->table('pigcms_user_record')->where(array('pigcms_id'=>$user_record_array['pigcms_id']))->data(array('state'=>1))->save();
                    exit();
                }else{
                    $arr = array('success'=>'0','error'=>'无新数据');
                    echo json_encode($arr);
                    exit();
                }
            }

        }
    }

    /*
     * 聊天界面demo
     * */
    public function chat_windows(){
        //用户的个人信息
        $uid =I('get.user_id');
        $pigcms_id = I('get.pigcms_id');
        $user_info_array = M('user')->where(array('user_id'=>$uid))->find();
        //历史记录显示
        $chat_record_count =M()->table('pigcms_user_record')->where(array('user_wxopid'=>$user_info_array['user_wx_opid']))->count();
        if($chat_record_count<=6){
            $start = 0;
        }else{
            $start=$chat_record_count-6;
        }
        //异常记录处理
        if(!empty($pigcms_id)){
            M()->table('pigcms_system_warning_control')->where(array('pigcms_id'=>$pigcms_id))->data(array('is_check'=>1,'is_deal'=>1))->save();
        }
        $chat_record_array =M()->table('pigcms_user_record')->where(array('user_wxopid'=>$user_info_array['user_wx_opid']))->limit($start,6)->select();
        $this->assign('chat_record_array',$chat_record_array);
        $this->assign('chat_record_count',$chat_record_count);
        $this->assign('user_info_array',$user_info_array);
        $this->display();
    }
    /*
     * 测试对话查询
     * */
    public function watch_test(){
        $weixin=new \Org\Weixinpay\Weixinpay();
        $data = array(
            "endtime" => 1490112000,
            "pageindex" => 1,
            "pagesize" => 10,
            "starttime" => 1490025600
        );
        $res = $weixin->watch_message(json_encode($data));
        dump($res);
    }
    /*
     * 测试客服基本信息查询
     * */
    public function get_service_list(){
        $weixin=new \Org\Weixinpay\Weixinpay();
        $res = $weixin->get_service_list();
        dump($res);
    }

    /*
    * 测试客服会话创建
    * */
    public function create_conversation(){
        $weixin=new \Org\Weixinpay\Weixinpay();
        $data = array(
            "kf_account" => "kf2001@hdhzhzs",
            "openid" => "oRn56wDSr7lDE63hX8VuBzLR4mYc"
        );
        $res = $weixin->create_service_conversation(json_encode($data));
        dump($res);
    }
}
























