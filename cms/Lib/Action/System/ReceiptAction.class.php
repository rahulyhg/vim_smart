<?php

/**
 * @author zhukeqin
 * Class Receipt
 * 缴费管理及打印
 */
class ReceiptAction extends BaseAction{
    public function _initialize()
    {

        parent::_initialize();

        $this->admin_id = session('system.id');
        $this->village_id = filter_village(0, 2);
        $this->village_info=D('House_village')->get_one($this->village_id);
        if(empty($this->project_id)){
            $this->project_id=$_SESSION['project_id'];
        }else{
            $_SESSION['project_id']=$this->project_id;
        }
        if(empty($this->project_id)){
            $this->project_id=$_SESSION['project_id'];
        }
        //获得当前用户所拥有权限
        $this->role_list=explode(',',session('system.role_id'));
        //权限判断
        $this->is_pm=0;
        $this->is_fm=0;
        //判断是否是项目经理
        $pm_id=M('role')->where(array('role_name'=>'项目经理'))->find()['role_id'];
        if(in_array($pm_id,$this->role_list)) $this->is_pm=1;
        //判断是否是财务部
        $fm_list=M('role')->where(array('role_name'=>array('like','%财务%')))->select();
        foreach ($fm_list as $key=>$value){
            if(in_array($value['role_id'],$this->role_list)){
                $this->is_fm=1;
                break;
            }
        }

        $this->assign('is_pm',$this->is_pm);
        $this->assign('is_fm',$this->is_fm);
    }
    //账单明细表
    public function receipt_list(){
        $breadcrumb_diy = array(
            array('物业服务','#'),
            array('单元管理',U('PropertyService/room_list_uptown')),
            array('全部缴费记录','#'),
        );
        $this->assign('breadcrumb_diy',$breadcrumb_diy);

        $receiptModel=new House_village_receipt_requestModel();
        //表格排序设定
        $table_sort=json_encode(array('6','desc'));
        $this->assign('table_sort',$table_sort);
        //设定月份
        /*if(!empty(I('get.month'))){
            $month=$_SESSION['month']=I('get.month');
        }elseif(!empty($_SESSION['month'])){
            $month=$_SESSION['month'];
        }else{
            $month=$_SESSION['month']=date('Y-n');
        }*/
        //设定打印情况
        if(!empty(I('post.print_status'))){
            $print_status=$_SESSION['print_status']=I('post.print_status');
        }elseif(!empty($_SESSION['print_status'])){
            $print_status=$_SESSION['print_status'];
        }else{
            $print_status=$_SESSION['print_status']=3;
        }
        //按支付状态/删除状态筛选
        if(!empty(I('post.pay_status'))){
            $pay_status=$_SESSION['receipt']['pay_status']=I('post.pay_status');
        }elseif (!empty($_SESSION['receipt']['pay_status'])){
            $pay_status=$_SESSION['receipt']['pay_status'];
        }else{
            $pay_status=$_SESSION['receipt']['pay_status']=1;
        }
        if($pay_status==2){
            $receipt_pay_status=0;
        }elseif($pay_status==1){
            $receipt_pay_status=1;
        }else{
            $receipt_pay_status=array('in',array('0','1'));
        }
        //按时间筛选
        if(!empty(I('post.starttime'))){
            $time['start']=I('post.starttime');
            $time['end']=I('post.endtime');
            $_SESSION['receipt']['time']=$time;
        }elseif (!empty($_SESSION['receipt']['time'])){
            $time=$_SESSION['receipt']['time'];
        }else{
            $time=$_SESSION['receipt']['time']=array(
                'start'=>date('Y-m-01'),
                'end'=>date('Y-m-t'),
            );
        }
        //按类别筛选
        if(!empty(I('post.type'))){
            $type=I('post.type');
            $_SESSION['receipt']['type']=$type;
        }elseif (!empty($_SESSION['receipt']['type'])){
            $type=$_SESSION['receipt']['type'];
        }else{
            $type='9999';
        }
        $this->assign('time',$time);
/*        $create_time=array('between',strtotime(date("Y-m-01", strtotime($month))).','.strtotime(date('Y-m-t', strtotime($month))));*/
        $create_time=array('between',strtotime($time['start']).','.(strtotime($time['end'])+24*3600));
        //根据房间id搜索
        if(!empty(I('post.rid'))){
                $where1['rid']=I('get.rid');
                $where1['print_status']='1';
                $get_property_info=D('House_village_room_propertylist')->get_order_list($where1,$receipt_pay_status);
                $get_carspace_info=D('House_village_room_carspacelist')->get_order_list($where1,$receipt_pay_status);
                $get_other_info=D('House_village_otherfee')->get_order_list($where1,$receipt_pay_status);
            }else{
                $where1['create_time']=$create_time;
                if($type!='9999') $where1['type']=$type;
            if($print_status!=3){
                    $where1['print_status']=$print_status;
                }
                $get_property_info=D('House_village_room_propertylist')->get_order_list($where1,$receipt_pay_status);
                $where2['create_time']=$create_time;
                if($type!='9999') $where2['type']=$type;
            if($print_status!=3){
                    $where2['print_status']=$print_status;
                }
                $get_carspace_info=D('House_village_room_carspacelist')->get_order_list($where2,$receipt_pay_status);
                $where3['creattime']=$create_time;
                if($type!='9999') $where3['type']=$type;
            if($print_status!=3){
                    $where3['print_status']=$print_status;
                }
                $where3['project_id']=$this->project_id;
                $get_other_info=D('House_village_otherfee')->get_order_list($where3,$receipt_pay_status);
            }
            foreach ($get_other_info as &$value){
                $value['create_time']=$value['creattime'];
            }
            unset($value);
            $list=array_merge((array)$get_property_info,(array)$get_carspace_info);
            $list=array_merge((array)$list,(array)$get_other_info);
            array_multisort(array_column($list,'create_time'),SORT_ASC,$list);
            //一个房间只有一条待打印信息时 自动打印
            if(count($list)==1&&!empty(I('post.rid'))){
                foreach ($list as $key=>$value){
                    if($value['otherfee_type_id']){
                        $ids=$value['otherfee_id'].$value['otherfee_type_id'];
                    }else{
                        if($value['carspace_id']){
                            $type_id='carspace';
                        }else{
                            $type_id='property';
                        }
                        $ids=$value['pigcms_id'].'-'.$type_id;
                    }
                    $map=array(
                        'ids'=>$ids
                    );
                    redirect(U('Receipt/print_receipt',$map));
                    die;
                }
            }
            $fee_type_list=D('House_village_fee_type')->get_type_list();
            $otherfee_type_list=D('House_village_otherfee_type')->get_type_list($this->village_id);
            foreach ($list as $key=>&$value){
                if($value['otherfee_type_id']){
                    $value['create_time']=date('Y年m月d日',$value['creattime']);
                    $value['fee_type_name']=$fee_type_list[$value['type']];
                    $value['type_name']=$otherfee_type_list[$value['otherfee_type_id']];
                    $value['pay_receive']=$value['fee_receive'];
                    $value['pay_true']=$value['fee_true'];
                    if(empty($value['fee_true'])){
                        $value['fee_true']=$value['fee_receive'];
                    }elseif(empty($value['fee_receive'])&&$value['fee_true']){
                        unset($list[$key]);
                        continue;
                    }
                    $value['type_id']=$value['otherfee_type_id'];
                    $value['pigcms_id']=$value['otherfee_id'];
                }else{
                    $value['create_time']=date('Y年m月d日',$value['create_time']);
                    $value['fee_type_name']=$fee_type_list[$value['type']];
                    if($value['carspace_id']){
                        $value['type_name']='泊位费';
                        $value['type_id']='carspace';
                    }else{
                        $value['type_name']='物业费';
                        $value['type_id']='property';
                    }
                    $value['changetime']=date('Y.n.j',strtotime($value['last_endtime'])+24*3600).'-'.date('Y.n.j',strtotime($value['new_endtime']));
                }
                $room_info=M('house_village_room')->where(array('id'=>$value['rid']))->find();
                if(!empty($this->project_id)){
                    if($this->project_id!=$room_info['project_id']){
                        unset($list[$key]);
                        continue;
                    }
                }
                $owner_info=M('house_village_user_bind')->where(array('pigcms_id'=>$room_info['owner_id']))->find();
                $value['owner']=$room_info['room_name'].' '.$owner_info['name'].' ';
                if($value['carspace_id']){
                    $carspace_info=M('house_village_user_car')->where(array('pigcms_id'=>$value['carspace_id']))->find();
                    $value['owner'] .=$carspace_info['carspace_number'];
                }else{
                    $value['owner'] .=$room_info['roomsize'].'m²';
                }
                //支付及删除状态
                $receipt_request=$receiptModel->get_request_one($value['pigcms_id'].'-'.$value['type_id'],'');
                if($receipt_request){
                    $value['receipt_request']=$receipt_request;
                    if($receipt_request['check_type']==1){
                        $value['status_name']='已删除';
                    }elseif($receipt_request['check_type']==2){
                        $value['status_name_remark']='已驳回';
                    }else{
                        $value['status_name_remark']='待处理';
                    }
                }else{
                    if($value['status']==0) $value['status_name']='未支付';
                }
            }
            unset($value);
            $property=new PropertyModel();
            $fee_sum_list=array();
            $return=$property->get_sum_one('',strtotime($time['start']),strtotime($time['end'])+24*3600);
            $return['type_name']='合计';
            $fee_sum_list[]=$return;
            foreach ($fee_type_list as $key=>$value){
                $return=$property->get_sum_one($key,strtotime($time['start']),strtotime($time['end'])+24*3600);
                $return['type_name']=$value;
                $fee_sum_list[]=$return;
            }
            $this->assign('fee_sum_list',$fee_sum_list);
            $this->assign('print_status',$print_status);
            $this->assign('pay_status',$pay_status==0?2:$pay_status);
            $this->assign('fee_type_list',$fee_type_list);
            $this->assign('type',$type);
            //$this->assign('month',$month);
            $this->assign('list',$list);
            //全部收费类型总和
            $type_list=array(array('otherfee_type_id'=>'property','otherfee_type_name'=>'物业费'),array('otherfee_type_id'=>'carspace','otherfee_type_name'=>'包月泊位费'));
            $otherfee_type_list=D('House_village_otherfee_type')->get_type_list($this->village_id,'1');
            $type_list=array_merge($type_list,$otherfee_type_list);
            $this->assign('type_list',$type_list);
            //项目名称
            if(!empty($this->village_id)) $village_name=M('house_village')->where(array('village_id'=>$this->village_id))->find()['village_name'];
            if(!empty($this->project_id)) $project_name=M('house_village_project')->where(array('pigcms_id'=>$this->project_id))->find()['desc'];
            $this->assign('village_name',$village_name);
            $this->assign('project_name',$project_name);
            $this->display();
    }

    /**
     * @author zhukeqin
     * 修改条目详细
     */
    public function update_receipt(){
        $id_info=explode('-',$_GET['id']);
        if(empty($id_info)) $this->error('需要修改的条目不存在');
        if($id_info['1']=='property'){
            //物业费获取信息
            $info=D('House_village_room_propertylist')->get_order_by_id('',$id_info['0']);
        }elseif($id_info['1']=='carspace'){
            $info=D('House_village_room_carspacelist')->get_order_by_id('',$id_info['0']);
        }else{
            $info=D('House_village_otherfee')->get_order_by_id('',$id_info['0']);
        }
        if(empty($info)) $this->error('需要修改的条目不存在');
        $where=array('id'=>$info['rid'],'village_id'=>$this->village_id);
        if($this->project_id) $where['project_id']=$this->project_id;
        $room_info=M('house_village_room')->where($where)->find();
        if(empty($room_info)) $this->error('该条目不属于当前项目');
        if(IS_POST){
            $data['type']=$_POST['type'];
            $data['remark']=$_POST['remark'];
            if($id_info['1']=='property'){
                $re=M('house_village_room_propertylist')->where(array('pigcms_id'=>$id_info['0']))->data($data)->save();
            }elseif($id_info['1']=='carspace'){
                $re=M('house_village_room_carspacelist')->where(array('pigcms_id'=>$id_info['0']))->data($data)->save();
            }else{
                $re=M('house_village_otherfee')->where(array('otherfee_id'=>$id_info['0']))->data($data)->save();
            }
            if($re){
                $this->success('修改成功！',U('receipt_list'));
            }else{
                $this->error('修改失败,请重试');
            }
        }else{
            $fee_type_list=D('House_village_fee_type')->get_type_list();
            $otherfee_type_list=D('House_village_otherfee_type')->get_type_list($this->village_id);
            if($info['otherfee_type_id']){
                $info['create_time']=date('Y年m月d日',$info['creattime']);
                $info['fee_type_name']=$fee_type_list[$info['type']];
                $info['type_name']=$otherfee_type_list[$info['otherfee_type_id']];
                $info['pay_receive']=$info['fee_receive'];
                $info['pay_true']=$info['fee_true'];
                $info['type_id']=$info['otherfee_type_id'];
                $info['pigcms_id']=$info['otherfee_id'];
            }else{
                $info['create_time']=date('Y年m月d日',$info['create_time']);
                $info['fee_type_name']=$fee_type_list[$info['type']];
                if($info['carspace_id']){
                    $info['type_name']='泊位费';
                    $info['type_id']='carspace';
                }else{
                    $info['type_name']='物业费';
                    $info['type_id']='property';
                }
                $info['changetime']=date('Y.n.j',strtotime($info['last_endtime'])+24*3600).'-'.date('Y.n.j',strtotime($info['new_endtime']));
            }
            $owner_info=M('house_village_user_bind')->where(array('pigcms_id'=>$room_info['owner_id']))->find();
            $info['owner']=$room_info['room_name'].' '.$owner_info['name'].' ';
            if($info['carspace_id']){
                $carspace_info=M('house_village_user_car')->where(array('pigcms_id'=>$info['carspace_id']))->find();
                $info['owner'] .=$carspace_info['carspace_number'];
            }else{
                $info['owner'] .=$room_info['roomsize'].'m²';
            }
            $this->assign('info',$info);
            $this->assign('fee_type_list',$fee_type_list);
            $this->display();
        }
    }
    //打印缴费单
    public function print_receipt(){
        $rid = $_REQUEST['rid'];
        $list=array();
        //$_POST['ids']=array('387-carspace','1133-15');
        //检查是否是重复打印
        if(!empty($_GET['print_id'])){
            $print_info=M('house_village_receipt_print')->where(array('print_id'=>$_GET['print_id']))->find();
            $ids=explode(',',$print_info['print_data']);
            //指定id进行打印
            foreach ($ids as $key=>$value){
                $info=explode('-',$value);
                if($info['1']=='property'){
                    $list[]=M('house_village_room_propertylist')->where(array('pigcms_id'=>$info['0'],'status'=>1))->find();
                }elseif($info['1']=='carspace'){
                    $list[]=M('house_village_room_carspacelist')->where(array('pigcms_id'=>$info['0'],'status'=>1))->find();
                }else{
                    $list[]=M('house_village_otherfee')->where(array('otherfee_id'=>$info['0'],'status'=>1))->find();
                }
            }
        }elseif(!empty($_POST['ids'])){
            $print_info=M('house_village_receipt_print')->where(array('print_data'=>$_POST['ids']))->find();
            if(!empty($print_info)){
                $ids=explode(',',$print_info['print_data']);
                $_GET['print_id']=$print_info['print_id'];
            }else{
                $ids=explode(',',$_POST['ids']);
            }
            //指定id进行打印
            foreach ($ids as $key=>$value){
                $info=explode('-',$value);
                if($info['1']=='property'){
                    $list[]=M('house_village_room_propertylist')->where(array('pigcms_id'=>$info['0'],'status'=>1))->find();
                }elseif($info['1']=='carspace'){
                    $list[]=M('house_village_room_carspacelist')->where(array('pigcms_id'=>$info['0'],'status'=>1))->find();
                }else{
                    $list[]=M('house_village_otherfee')->where(array('otherfee_id'=>$info['0'],'status'=>1))->find();
                }
            }
        }else{
            //设定月份
            if(!empty(I('get.month'))){
                $month=$_SESSION['month']=I('get.month');
            }elseif(!empty($_SESSION['month'])){
                $month=$_SESSION['month'];
            }else{
                $month=$_SESSION['month']=date('Y-n');
            }
            //设定打印情况
            if(!empty(I('get.print_status'))){
                $print_status=$_SESSION['print_status']=I('get.print_status');
            }elseif(!empty($_SESSION['print_status'])){
                $print_status=$_SESSION['print_status'];
            }else{
                $print_status=$_SESSION['print_status']=1;
            }
            //dump($print_status);die;
            $where=array();
            $create_time=array('between',strtotime(date("Y-m-01", strtotime($month))).','.strtotime(date('Y-m-t', strtotime($month))));
            if($print_status!=3){
                $where['print_status']=$print_status;
            }
            if(!empty($rid)){
                $where['rid'] = $rid;
            }
            $property_type=array('property','carspace','other');
            foreach ($property_type as $value){
                if($value=='property'){
                    $where1=$where;
                    $where1['create_time']=$create_time;
                    $get_info=D('House_village_room_propertylist')->get_order_list($where1);
                    if(!empty($get_info)){
                        foreach ($get_info as $value1){
                            $list[]=$value1;
                        }
                    }
                }elseif($value=='carspace'){
                    $where1=$where;
                    $where1['create_time']=$create_time;
                    $get_info=D('House_village_room_carspacelist')->get_order_list($where1);
                    if(!empty($get_info)){
                        foreach ($get_info as $value1){
                            $list[]=$value1;
                        }
                    }
                }else{
                    $where1=$where;
                    $where1['creattime']=$create_time;
                    $where1['project_id']=$this->project_id;
                    /*$where1['otherfee_type_id']=$value;*/
                    $get_info=D('House_village_otherfee')->get_order_list($where1);
                    if(!empty($get_info)){
                        foreach ($get_info as $value1){
                            $list[]=$value1;
                        }
                    }
                }
            }
        }
        $fee_type_list=D('House_village_fee_type')->get_type_list();
        $otherfee_type_list=D('House_village_otherfee_type')->get_type_list($this->village_id);
        $list_cache=array();
        foreach ($list as $value){
            $cache=array();
            if($value['otherfee_type_id']){
                //更改状态为已打印
                if($value['print_status']==1){
                    M('House_village_otherfee')->where(array('otherfee_id'=>$value['otherfee_id']))->data(array('print_status'=>2))->save();
                }
                $cache['create_time']=date('Y 年 n 月 j日',$value['creattime']);
                $cache['fee_type']=$fee_type_list[$value['type']];
                $cache['type']=$otherfee_type_list[$value['otherfee_type_id']];
                if(empty($value['fee_true'])){
                    $value['fee_true']=$value['fee_receive'];
                }elseif(empty($value['fee_receive']&&$value['fee_true'])){
                    continue;
                }
                $cache['money']=$value['fee_true'];
                //$cache['money_chinese']=$this->cny($value['fee_true']);
                $cache['id']=$value['otherfee_id'].'-'.$value['otherfee_type_id'];
                //$cache['id']=$this->village_info['logogram'].$value['otherfee_type_id'].sprintf('%06d',$value['otherfee_id']);
                $cache['remark']=$value['remark'];
                $remark=$value['explain'];
            }else{
                $cache['create_time']=date('Y 年 n 月 j日',$value['create_time']);
                $cache['fee_type']=$fee_type_list[$value['type']];
                if($value['carspace_id']){
                    //更改状态为已打印
                    M('House_village_room_carspacelist')->where(array('pigcms_id'=>$value['pigcms_id']))->data(array('print_status'=>2))->save();
                    $cache['type']='泊位费';
                    //$cache['id']=$this->village_info['logogram'].'C'.sprintf('%06d',$value['pigcms_id']);
                    $cache['id']=$value['pigcms_id'].'-carspace';
                    //泊位费打印时额外添加说明文字
                    $carspace_info=M('house_village_user_car')->where(array('pigcms_id'=>$value['carspace_id']))->find();
                    $remark=$carspace_info['carspace_number'].'&nbsp;'.$carspace_info['car_number'].'&nbsp;'.$value['remark'];
                }else{
                    //更改状态为已打印
                    M('House_village_room_propertylist')->where(array('pigcms_id'=>$value['pigcms_id']))->data(array('print_status'=>2))->save();
                    $cache['type']='物业费';
                    $cache['id']=$value['pigcms_id'].'-property';
                    $remark =$value['remark'];
                    //$cache['id']=$this->village_info['logogram'].'P'.sprintf('%06d',$value['pigcms_id']);
                }
                $starttime=date('Y.m.d',strtotime($value['last_endtime'])+24*3600);
                $endtime=date('Y.m.d',strtotime($value['new_endtime']));
                $cache['remark'] =$starttime.'-'.$endtime;
                $cache['money']=$value['pay_true'];
                /*$cache['money_chinese']=$this->cny($value['pay_true']);*/
            }
            //$cache['creattime']=$value['creattime'];
            $room_info=M('house_village_room')->where(array('id'=>$value['rid']))->find();
            if(empty($room_info)) continue;
            $cache['room_name']=$room_info['room_name'];
            $owner_info=M('house_village_user_bind')->where(array('pigcms_id'=>$room_info['owner_id']))->find();
           /* $cache['owner']=$owner_info['name'];*/
            /*if($value['carspace_id']){
                $carspace_info=M('house_village_user_car')->where(array('pigcms_id'=>$value['carspace_id']))->find();
                $cache['owner'] .=$carspace_info['carspace_number'];
            }else{
                $cache['owner'] .=$room_info['roomsize'].'m²';
            }*/
            /*if($value['pay_true']<1){
                $cache['money_chinese']=str_replace('圆','',$cache['money_chinese']);
            }*/
            $list_cache[$room_info['id']][]=$cache;
            $list_cache[$room_info['id']]['sum'] +=$cache['money'];
            $list_cache[$room_info['id']]['room_name']=$cache['room_name'];
            $list_cache[$room_info['id']]['owner']=$owner_info['name'];
            if(empty($value['creattime'])) $value['creattime']=$value['create_time'];
            $list_cache[$room_info['id']]['creattime']=date('Y-m-d',$value['creattime']);//转换时间
            $list_cache[$room_info['id']]['village_name']=M('house_village')->where(array('village_id'=>$room_info['village_id']))->find()['village_name'];
            $list_cache[$room_info['id']]['property_phone']=M('house_village')->where(array('village_id'=>$room_info['village_id']))->find()['property_phone'];
            if(!empty($room_info['project_id'])){
                $list_cache[$room_info['id']]['village_name'] .='·'.M('house_village_project')->where(array('pigcms_id'=>$room_info['project_id']))->find()['desc'];
                $list_cache[$room_info['id']]['property_phone'] =M('house_village_project')->where(array('pigcms_id'=>$room_info['project_id']))->find()['property_phone'];
            }
            //添加说明文字
            if(!empty($remark)){
                $list_cache[$room_info['id']]['remark']=$remark;
                unset($remark);
            }
            //dump($list_cache[$room_info['id']]['village_name']);
        }
        //dump($list_cache);die;
        foreach ($list_cache as $key=>$value){
            $date=date('Ymd',strtotime($value['creattime']));
            $date_log=date('Y-m-d',strtotime($value['creattime']));
            $where=array('village_id'=>$this->village_id,'print_date'=>$date_log);
            if(!empty($this->project_id)) $where['project_id']=$this->project_id;
            $num=M('house_village_receipt_print')->where($where)->order('print_id desc')->find()['print_num'];
            $log=array();
            $log['print_date']=$date_log;
            $log_data=array();
            foreach ($value as $key1=>$value1){
                if(!empty($value1['id'])){
                    $log_data[]=$value1['id'];
                }
            }

            $log['print_data']=implode(',',$log_data);
            $log['print_num']=$num+1;
            $list_cache[$key]['num']=strtoupper($this->village_info['logogram']).$date.sprintf('%06d',$log['print_num']);
            $list_cache[$key]['sum_chinese'] = $this->cny($list_cache[$key]['sum']);//中文大写转换
//            dump($list_cache);die;
            $log['village_id']=$this->village_id;
            $log['project_id']=$this->project_id;
            $log['admin_id']=$this->admin_id;
            if(!empty($_GET['print_id'])){
                $list_cache[$key]['num']=strtoupper($this->village_info['logogram']).$date.sprintf('%06d',$print_info['print_num']);
                $return_id=$_GET['print_id'];
            }else{
                $return_id=M('house_village_receipt_print')->data($log)->add();
            }
            $list_cache[$key]['print_id']=$return_id;
            $admin_id=M('house_village_receipt_print')->where(array('print_id'=>$return_id))->find()['admin_id'];
            $list_cache[$key]['realname']=M('admin')->where(array('id'=>$admin_id))->find()['realname'];
        }

        /*$lian=array('1'=>'一','2'=>'二','3'=>'三');
        $this->assign('lian',$lian);*/
//
        $this->assign('list_cache',$list_cache);
        $this->display();
    }

    //转换为大写汉字
    function cny($num){
        $c1 = "零壹贰叁肆伍陆柒捌玖";
        $c2 = "分角元拾佰仟万拾佰仟亿";
        //留两个小数位
        $num = round($num, 2);
        //将数字转化为整数
        $num = $num * 100;
        if (strlen($num) > 10) {
            return "金额太大，请检查";
        }
        $i = 0;
        $c = "";
        while (1) {
            if ($i == 0) {
                //获取最后一位数字
                $n = substr($num, strlen($num)-1, 1);
            } else {
                $n = $num % 10;
            }
            $p1 = substr($c1, 3 * $n, 3);
            $p2 = substr($c2, 3 * $i, 3);
            if ($n != '0' || ($n == '0' && ($p2 == '亿' || $p2 == '万' || $p2 == '元'))) {
                $c = $p1 . $p2 . $c;
            } else {
                $c = $p1 . $c;
            }
            $i = $i + 1;
            $num = $num / 10;
            $num = (int)$num;
            if ($num == 0) {
                break;
            }
        }
        $j = 0;
        $slen = strlen($c);
        while ($j < $slen) {
            //utf8一个汉字相当3个字符
            $m = substr($c, $j, 6);
            //处理数字中很多0的情况,每次循环去掉一个汉字“零”
            if ($m == '零元' || $m == '零万' || $m == '零亿' || $m == '零零') {
                $left = substr($c, 0, $j);
                $right = substr($c, $j + 3);
                $c = $left . $right;
                $j = $j-3;
                $slen = $slen-3;
            }
            $j = $j + 3;
        }
        //这个是为了去掉类似23.0中最后一个“零”字
        if (substr($c, strlen($c)-3, 3) == '零') {
            $c = substr($c, 0, strlen($c)-3);
        }
        if (empty($c)) {
            return "零元";
        }else{
            return $c;
        }
    }

    /**
     * @author zhukeqin
     * ajax删除条目
     */
    public function ajax_delete_fee(){
        if(!$this->is_pm) $this->error('您不是项目经理，无权删除','','true');
        $ids=explode(',',$_POST['ids']);
        $fee_log=new House_village_fee_logModel();
        $error='';
        foreach ($ids as $key=>$value){
            $info=explode('-',$value);
            $return=$fee_log->delete_fee_one($info['0'],$info['1']);
            if($return) $error .=$return;
        }
        if($error){
            $this->error($error,'','true');
        }else{
            $this->success('删除成功','','true');
        }

    }

    /**
     * @author zhukeqin
     * 提交删除审核
     */
    public function ajax_delete_request_fee(){
        $ids=$_POST['ids'];
        $remark=$_POST['remark'];
        $requestModel=new House_village_receipt_requestModel();
        $re=$requestModel->add_request_one($ids,$remark);
        if($re['err']==0){
            echo json_encode(array('status'=>1,'info'=>'提交审核成功'));
            die;
        }else{
            echo json_encode(array('status'=>0,'info'=>$re['data']));
            die;
        }
    }
    /**
     * @author zhukeqin
     * ajax退款操作
     */
    public function ajax_refund_fee(){
        if(!$this->is_fm) $this->error('您不是财务部人员，无权退款','','true');
        $ids=$_POST['ids'];
        $money=$_POST['money'];
        $fee_log=new House_village_fee_logModel();
        $error='';
            $info=explode('-',$ids);
            $return=$fee_log->refund_fee_one($info['0'],$info['1'],$money);
            if($return) $error .=$return;
        if($error){
            $this->error($error,'','true');
        }else{
            $this->success('删除成功','','true');
        }

    }
}