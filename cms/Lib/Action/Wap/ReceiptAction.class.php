<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/9/13
 * Time: 14:23
 */
class ReceiptAction extends BaseAction
{
    public function _initialize()
    {

        parent::_initialize();

        $this->admin_id = session('system.id');
        $this->village_id = filter_village(0, 2);
        $this->village_info = D('House_village')->get_one($this->village_id);
        if (empty($this->project_id)) {
            $this->project_id = $_SESSION['project_id'];
        } else {
            $_SESSION['project_id'] = $this->project_id;
        }
        if (empty($this->project_id)) {
            $this->project_id = $_SESSION['project_id'];
        }

    }

    //打印缴费单
    public function print_receipt(){
        $list=array();
        //$_POST['ids']=array('387-carspace','1133-15');
        if(!empty($_GET['print_id'])) {
            $print_info = M('house_village_receipt_print')->where(array('print_id' => $_GET['print_id']))->find();
            $ids = explode(',', $print_info['print_data']);
            //指定id进行打印
            foreach ($ids as $key => $value) {
                $info = explode('-', $value);
                if ($info['1'] == 'property') {
                    $list[] = M('house_village_room_propertylist')->where(array('pigcms_id' => $info['0'], 'status' => 1))->find();
                } elseif ($info['1'] == 'carspace') {
                    $list[] = M('house_village_room_carspacelist')->where(array('pigcms_id' => $info['0'], 'status' => 1))->find();
                } else {
                    $list[] = M('house_village_otherfee')->where(array('otherfee_id' => $info['0'], 'status' => 1))->find();
                }
            }
        }
        $fee_type_list=D('House_village_fee_type')->get_type_list();
        $otherfee_type_list=D('House_village_otherfee_type')->get_type_list($print_info['village_id']);
        $this->village_info = D('House_village')->get_one($print_info['village_id']);
        $list_cache=array();
        foreach ($list as $value){
            $cache=array();
            if($value['otherfee_type_id']){
                //更改状态为已打印
                if($value['print_status']==1){
                    M('House_village_otherfee')->where(array('otherfee_id'=>$value['otherfee_id']))->data(array('print_status'=>2))->save();
                }
                $cache['create_time']=date('Y 年 n 月 j日',$value['creattime']);
                $cache['creattime']=$value['creattime'];
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
            }else{
                $cache['create_time']=date('Y 年 n 月 j日',$value['create_time']);
                $cache['creattime']=$value['create_time'];
                $cache['fee_type']=$fee_type_list[$value['type']];
                if($value['carspace_id']){
                    //更改状态为已打印
                    M('House_village_room_carspacelist')->where(array('pigcms_id'=>$value['pigcms_id']))->data(array('print_status'=>2))->save();
                    $cache['type']='泊位费';
                    //$cache['id']=$this->village_info['logogram'].'C'.sprintf('%06d',$value['pigcms_id']);
                    $cache['id']=$value['pigcms_id'].'-carspace';
                }else{
                    //更改状态为已打印
                    M('House_village_room_propertylist')->where(array('pigcms_id'=>$value['pigcms_id']))->data(array('print_status'=>2))->save();
                    $cache['type']='物业费';
                    $cache['id']=$value['pigcms_id'].'-property';
                    //$cache['id']=$this->village_info['logogram'].'P'.sprintf('%06d',$value['pigcms_id']);
                }
                $starttime=date('Y.n.j',strtotime($value['last_endtime'])+24*3600);
                $endtime=date('Y.n.j',strtotime($value['new_endtime']));
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
            $list_cache[$room_info['id']]['create_time']=$cache['create_time'];//转换时间
            $list_cache[$room_info['id']]['creattime']=$cache['creattime'];//转换时间
            $list_cache[$room_info['id']]['village_name']=M('house_village')->where(array('village_id'=>$room_info['village_id']))->find()['village_name'];
            $list_cache[$room_info['id']]['property_phone']=M('house_village')->where(array('village_id'=>$room_info['village_id']))->find()['property_phone'];
            if(!empty($room_info['project_id'])){
                $list_cache[$room_info['id']]['village_name'] .='·'.M('house_village_project')->where(array('pigcms_id'=>$room_info['project_id']))->find()['desc'];
            }
            //dump($list_cache[$room_info['id']]['village_name']);
        }

        foreach ($list_cache as $key=>$value){
            $date=date('Ymd',$value['creattime']);
            $list_cache[$key]['sum_chinese'] = $this->cny($list_cache[$key]['sum']);//中文大写转换
                $list_cache[$key]['num']=$this->village_info['logogram'].$date.sprintf('%06d',$print_info['print_num']);
                $return_id=$_GET['print_id'];
            $list_cache[$key]['print_id']=$return_id;
        }
        /*$lian=array('1'=>'一','2'=>'二','3'=>'三');
        $this->assign('lian',$lian);*/
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

    public function check_receipt(){
        $receiptModel=new House_village_receipt_requestModel();
        $request_id=$_GET['id'];
        $user=$_SESSION['user'];
        $request_info=$receiptModel->get_request_one('',$request_id);
        if(empty($request_info)) $this->error_tips('该条目不存在');
        $user_list=explode(',',$request_info['user_list']);
        $admin=in_array($user['openid'],$user_list)?1:0;
        if(IS_POST){
            if($admin!=1) $this->error_tips('您不符合审核条件！');
            $check_type=$_POST['check_type'];
            $remark=$_POST['check_remark'];
            $re=D('House_village_receipt_request')->check_request_one($request_id,$check_type,$remark);
            if($re['err']==0){
                echo json_encode(array('err'=>'0','data'=>'审核成功'));
            }else{
                echo json_encode(array('err'=>'1','data'=>$re['data']));
            }
        }else{
            $info=$receiptModel->get_order_one($request_info['order_id']);
            $request_info['admin_info']=M('admin')->where(array('id'=>$request_info['admin_id']))->find();
            $request_info['check_info']=M('admin')->where(array('id'=>$request_info['check_id']))->find();
            $this->assign('info',$info);
            $this->assign('request_info',$request_info);
            $this->assign('admin',$admin);
            $this->assign('static_path','./tpl/Wap/pure/static/');
            $this->display();
        }
    }
}