<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/6/28
 * Time: 11:35
 */
class PropertyModel extends Model{
    public function _initialize($project_id,$year)
    {

        parent::_initialize();

        $this->admin_id = session('system.id');
        $this->village_id = filter_village(0, 2);
        $this->project_id = $project_id;
        if (empty($this->project_id)) {
            $this->project_id = $_SESSION['project_id'];
        } else {
            $_SESSION['project_id'] = $this->project_id;
        }
        $project_list = M('house_village_project')->where(array('village_id' => $this->village_id))->select();
        if (empty($this->project_id)) {
            $this->project_id = $_SESSION['project_id'] = $project_list['0']['pigcms_id'];
        }
        $this->year = $year;
        if (empty($this->year)) {
            $this->year = date('Y');
        }
        $this->lastyear = $this->year - 1;
        $this->nextyear = $this->year + 1;
        if ($this->year == date('Y')) {
            $this->month_number = date('n');
        } elseif ($this->year > date('Y')) {
            $this->month_number = 0;
        } else {
            $this->month_number = 12;
        }
        $this->type_list = array(
            array(
                'otherfee_type_name' => '物业服务费',
                'url' => U('property'),
                'type' => 'property',
            ),
            array(
                'otherfee_type_name' => '包月泊车费',
                'url' => U('carspace'),
                'type' => 'carspace',
            ),
        );
        $type_list_all = M('house_village_otherfee_type')->where(array('status' => 1, 'village_id' => $this->village_id,))->select();
        $project_list = M('house_village_project')->where(array('village_id' => $this->village_id))->select();
        if (empty($this->project_id)) {
            $this->project_id = $_SESSION['project_id'] = $project_list['0']['pigcms_id'];
        }
    }
    public function property(){
        $village_id=$this->village_id;
        $project_id=$this->project_id;
        $where=array('r.roomsize'=>array('exp',' is not null AND r.roomsize <> "" AND r.roomsize <> 0'),'r.village_id'=>$village_id);
        if(!empty($project_id)) $where['r.project_id']=$project_id;
        $field=array('r.*','rt.property_unit','rt.desc');
        $room_list=M('house_village_room')
            ->alias('r')
            ->field($field)
            ->join('left join __HOUSE_VILLAGE_ROOM_TYPE__ as rt on rt.village_id=r.village_id')
            ->where($where)
            ->select();
        //$data=M('house_village_fee_cache')->where(array('village_id'=>$this->village_id,'project_id'=>$this->project_id,'type'=>'property','year'=>$this->year))->select();
        //dump($this->project_id);
        $sum = array(
            'sum_lastadvance' => 0,
            'sum_lasttrue' => 0,
            'sum_nowrecive' => 0,
            'sum_nowtrue' => 0,
            'sum_nowend' => 0,
        );
        foreach ($room_list as $v){
            if($v['desc']=='商铺') continue;
            $value=M('house_village_fee_cache')->where(array('rid'=>$v['id'],'type'=>'property','year'=>$this->year))->find();
            $json=unserialize($value['data']);
            //判断是否更新为最新月份
            //dump(count($json));
            if(count($json['list'])<$this->month_number){
                $this->property_update_cache($v['id'],$this->year);
                $value=M('house_village_fee_cache')->where(array('rid'=>$v['id'],'type'=>'property','year'=>$this->year))->find();
                $json=unserialize($value['data']);
            }
            $property_fee_list[]=$json;
            $sum_recive = $sum_true = $sum_endrecive = $sum_endadvance = 0;

            /*foreach ($json['list'] as $key => $value1) {

                $sum_recive += $value1['pay_recive'];
                $sum_true += $value1['pay_true'];
                $sum['list'][$key]['sum_recive'] += $value1['pay_recive'];
                $sum['list'][$key]['sum_true'] += $value1['pay_true'];
                $sum['list'][$key]['sum_endrecive'] += $value1['payend_recive'];
                $sum['list'][$key]['sum_endadvance'] += $value1['payend_advance'];
            }*/
            $sum_recive += $json['pay_recive'];
            $sum_true += $json['pay_true'];
            for($i=1;$i<=$this->month_number;$i++){
                $sum['list'][$i]['sum_recive'] += $json['list'][$i]['pay_recive'];
                $sum['list'][$i]['sum_true'] += $json['list'][$i]['pay_true'];
                $sum['list'][$i]['sum_endrecive'] += $json['list'][$i]['payend_recive'];
                $sum['list'][$i]['sum_endadvance'] += $json['list'][$i]['payend_advance'];
            }
            $sum['sum_lastyear_receive'] += $json['lastyear_receive'];
            $sum['sum_lastyear_advance'] += $json['lastyear_advance'];
            $sum['sum_nowrecive'] += $sum_recive;
            $sum['sum_nowtrue'] += $sum_true;
            $sum['sum_nowend'] += $json['sum_nowend'];
            $sum['sum_roomsize'] += $json['roomsize'];
            $sum['allprice'] += $json['property_mouth'];
        }
        $result=array('fee_list'=>$property_fee_list,'sum'=>$sum);
        //$result=json_decode($data['data'],'true');
        /*dump($carspace_fee_list);
        dump($sum);*/
        /*dump($data);
        dump(M()->_sql());
        die;*/
        return $result;
    }
    public function carspace(){
        $carspace_list=M('house_village_user_car')->where(array('village_id'=>$this->village_id,'project_id'=>$this->project_id,'carspace_endtime'=>array('neq','')))->select();
        //$data=M('house_village_fee_cache')->where(array('village_id'=>$this->village_id,'project_id'=>$this->project_id,'type'=>'carspace','year'=>$this->year))->select();
        $sum = array(
            'sum_last' => 0,
            'sum_nowrecive' => 0,
            'sum_nowtrue' => 0,
            'sum_nowend' => 0,
            'num' => 0,
            'allprice' => 0,
        );
        foreach ($carspace_list as $v){
            $value=M('house_village_fee_cache')->where(array('village_id'=>$this->village_id,'project_id'=>$this->project_id,'type'=>'carspace','carspace_id'=>$v['pigcms_id'],'year'=>$this->year))->find();
            $json=unserialize($value['data']);
            //判断是否更新为最新月份
            if(count($json['list'])<$this->month_number){
                $this->carspace_update_cache($v['pigcms_id'],$this->year);
                $value=M('house_village_fee_cache')->where(array('village_id'=>$this->village_id,'project_id'=>$this->project_id,'type'=>'carspace','carspace_id'=>$v['pigcms_id'],'year'=>$this->year))->find();
                $json=unserialize($value['data']);
            }
            $carspace_fee_list[]=$json;
            $sum_recive = $sum_true = $sum_endrecive = $sum_endadvance = 0;
            foreach ($json['list'] as $key => $value1) {
                $sum_recive += $value1['pay_recive'];
                $sum_true += $value1['pay_true'];
                $sum['list'][$key]['sum_recive'] += $json['carspace_price'];
                $sum['list'][$key]['sum_true'] += $value1['pay_true'];
            }
            $sum['allprice'] += $json['carspace_price'];
            $sum['num']++;
            $sum['sum_last'] += $json['sum_last'];
            $sum['sum_nowrecive'] += $sum_recive;
            $sum['sum_nowtrue'] += $sum_true;
            $sum['sum_nowend'] += round($json['sum_last'] + $sum_recive - $sum_true, 2);
        }
        $result=array('fee_list'=>$carspace_fee_list,'sum'=>$sum);
        //$result=json_decode($data['data'],'true')
        /*dump($carspace_fee_list);
        dump($sum);*/
        return $result;

    }
    public function other($type_id){
        $otherfee_type_info=M('house_village_otherfee_type')->where(array('otherfee_type_id'=>$type_id,'village_id'=>$this->village_id))->find();
        if(empty($otherfee_type_info)){
            $this->error('该类型不存在');
        }
        $data=M('house_village_fee_cache')->where(array('village_id'=>$this->village_id,'project_id'=>$this->project_id,'type'=>$type_id,'year'=>$this->year))->select();
        $sum = array(
            'sum_last' => 0,
            'sum_nowrecive' => 0,
            'sum_nowtrue' => 0,
            'sum_nowend' => 0,
            'num' => 0,
            'allprice' => 0,
        );
        foreach ($data as $value){
            $json=unserialize($value['data']);
            if(empty($json['room_name'])) continue;
            $other_fee_list[]=$json;
            $sum_recive = $sum_true = $sum_endrecive = $sum_endadvance = 0;
            foreach ($json['list'] as $key => $value1) {
                if($otherfee_type_info['type']==2) $value1['pay_true']=$value1['pay_recive']-$value1['pay_true'];
                $sum_recive += $value1['pay_recive'];
                $sum_true += $value1['pay_true'];
                $sum['list'][$key]['sum_recive'] +=$value1['pay_recive'];
                $sum['list'][$key]['sum_true'] +=$value1['pay_true'];
            }
            $sum['sum_last'] +=$json['sum_last'];
            $sum['sum_nowrecive'] +=$sum_recive;
            $sum['sum_nowtrue'] +=$sum_true;
            $sum['sum_nowend'] +=round($json['sum_last']+$sum_recive-$sum_true,2);
        }
        //$result=array('fee_list'=>$carspace_fee_list,'sum'=>$sum);
        $result=array('fee_list'=>$other_fee_list,'sum'=>$sum);
        //$result=json_decode($data['data'],'true');


        return $result;
    }
    public function month(){
        $type_list=array(
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
        $type_list_all=M('house_village_otherfee_type')->where(array('status'=>1,'village_id'=>$this->village_id,))->select();
        foreach ($type_list_all as $value){
            $type_list[]=array(
                'otherfee_type_name'=>$value['otherfee_type_name'],
                'url'=>U('otherfee',array('otherfee_type_id'=>$value['otherfee_type_id'])),
                'type'=>$value['otherfee_type_id'],
            );
        }
        //$month_fee_list=array();

        //获取月报表结算时间
        $collect_time=D('House_village_fee_collect_time')->get_time_one($this->village_id,$this->project_id,$this->year);
        if(!is_array($collect_time)) $this->error($collect_time);
        $last_collect_time=D('House_village_fee_collect_time')->get_time_one($this->village_id,$this->project_id,($this->year-1));
        if(!is_array($last_collect_time)) $this->error($last_collect_time);
        $sum=array();
        foreach ($type_list as $key=>&$value){
            unset($time_start);
            unset($time_end);
            foreach ($collect_time as $key1=>$value1){
                if($key1==1){
                    //1月时则获取上年十二月的结算时间
                    $time_start=strtotime(($this->year-1).'-12-'.$last_collect_time['12'])+24*3600;
                    $time_end=strtotime($this->year.'-1-'.$value1)+24*3600;
                }else{
                    $time_start=$time_end;
                    $time_end=strtotime($this->year.'-'.$key1.'-'.$value1)+24*3600;
                }
                //超过当前月份则跳出
                if($key1>$this->month_number) break;
                if($value['type']=='property'||$value['type']=='carspace'){
                    $value['list'][$key1]=$this->sum_fee($this->village_id,$this->project_id,$value['type'],'',array($time_start,$time_end));
                    //$value['list'][$i]=M('house_village_room_propertylist')->where(array('pay_time'=>array('between',array($time_start,$time_end)),'status'=>1))->sum('pay_true');
                }else{
                    $value['list'][$key1]=$this->sum_fee($this->village_id,$this->project_id,'other','',array($time_start,$time_end),$value['type']);
                    //$value['list'][$i]=M('house_village_otherfee')->where(array('pay_time'=>array('between',array($time_start,$time_end)),'status'=>1))->sum('pay_true');
                }
                if(empty($value['list'][$key1])) $value['list'][$key1]=0;
                $value['list']['sum'] +=$value['list'][$key1];
            }
            /*旧版月报表结算方法
             * for($i=1;$i<=$this->month_number;$i++){
                $time_start=strtotime($this->year.'-'.$i);
                $j=$i+1;
                $time_end=strtotime($this->year.'-'.$j);
                if($value['type']=='property'||$value['type']=='carspace'){
                    $value['list'][$i]=$this->sum_fee($this->village_id,$this->project_id,$value['type'],'',array($time_start,$time_end));
                    //$value['list'][$i]=M('house_village_room_propertylist')->where(array('pay_time'=>array('between',array($time_start,$time_end)),'status'=>1))->sum('pay_true');
                }else{
                    $value['list'][$i]=$this->sum_fee($this->village_id,$this->project_id,'other','',array($time_start,$time_end),$value['type']);
                    //$value['list'][$i]=M('house_village_otherfee')->where(array('pay_time'=>array('between',array($time_start,$time_end)),'status'=>1))->sum('pay_true');
                }
                if(empty($value['list'][$i])) $value['list'][$i]=0;
                $value['list']['sum'] +=$value['list'][$i];
            }*/
            if($value['type']=='property'){
                $value['list']['remark']=M('house_village_room_propertylist')->order('pigcms_id desc')->find()['remark'];
            }elseif($value['type']=='carspace'){
                $value['list']['remark']=M('house_village_room_carspacelist')->order('pigcms_id desc')->find()['remark'];
            }else{
                $value['list']['remark']=M('house_village_otherfee')->order('otherfee_id desc')->find()['remark'];
            }
        }
        //获取历史记录
        $month_log=D('House_village_fee_month_log')->get_log_one($this->village_id,$this->project_id,$this->year);
        unset($value);
        /*foreach ($type_list as $key=>$value){*/
        unset($time_start);
        unset($time_end);
        foreach ($collect_time as $key1=>$value1){
            //超过当前月份则跳出
            if($key1>$this->month_number) break;
            //$sum['list'][$key1]['sum'] +=$value['list'][$key1];
            if($key1==1){
                //1月时则获取上年十二月的结算时间
                $time_start=strtotime($this->lastyear.'-12-'.$last_collect_time['12'])+24*3600;
                $time_end=strtotime($this->year.'-1-'.$value1)+24*3600;
            }else{
                $time_start=$time_end;
                $time_end=strtotime($this->year.'-'.$key1.'-'.$value1)+24*3600;
            }
            for ($j=1;$j<=5;$j++){
                if(empty($month_log[$j][$key1])){
                    //$property=M('house_village_room_propertylist')->where(array('pay_time'=>array('between',array($time_start,$time_end)),'type'=>$j,'status'=>1))->sum('pay_true');
                    $property=$this->sum_fee($this->village_id,$this->project_id,'property',$j,array($time_start,$time_end));
                    //$carspace=M('house_village_room_carspacelist')->where(array('pay_time'=>array('between',array($time_start,$time_end)),'type'=>$j,'status'=>1))->sum('pay_true');
                    $carspace=$this->sum_fee($this->village_id,$this->project_id,'carspace',$j,array($time_start,$time_end));
                    //$otherfee=M('house_village_otherfee')->where(array('pay_time'=>array('between',array($time_start,$time_end)),'type'=>$j,'status'=>1))->sum('pay_true');
                    $otherfee=$this->sum_fee($this->village_id,$this->project_id,'other',$j,array($time_start,$time_end));
                    $sum['list'][$key1][$j]=$property+$carspace+$otherfee;
                }else{
                    $sum['list'][$key1][$j]=$month_log[$j][$key1];
                }

                if(empty($sum['list'][$key1][$j])) $sum['list'][$key1][$j]=0;
                $sum['list'][$key1]['sum'] +=$sum['list'][$key1][$j];
            }
            /*}*/
        }
        foreach ($sum['list'] as $key=>$value){
            $sum['sum'] += $value['sum'];
            for ($j = 1; $j <= 5; $j++) {
                $sum[$j] += $value[$j];
            }
        }
        return array('fee_list'=>$type_list,'sum'=>$sum);
    }

    /**
     * @author zhukeqin
     * @param $village_id
     * @param $project_id
     * @param $type
     * @param $feetype
     * @param $timearray
     * @param string $otherfee_type
     * @param string $count 设置为1时返回数量
     * @return mixed
     */
    public function sum_fee($village_id,$project_id,$type,$feetype,$timearray,$otherfee_type='',$count=''){
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
        if($count==1){
            $return=$table
                ->alias('tab')
                ->join('left join __HOUSE_VILLAGE_ROOM__ r on tab.rid=r.id')
                ->where($where)
                ->count();
        }else{
            $return=$table
                ->alias('tab')
                ->join('left join __HOUSE_VILLAGE_ROOM__ r on tab.rid=r.id')
                ->where($where)
                ->sum($get);
        }

        return $return;
    }

    /**
     * @author zhukeqin
     * 物业费记录单条更新
     * @param $rid
     * @param string $year
     * @return string
     */
    public function property_update_cache($rid,$year=''){
        $lastyearModel=new House_village_room_fee_lastyearModel();
        $this->set_year($year);
        if(empty($rid)){
            return '必须传入房间id';
        }
        if(empty($year)){
            $year=date('Y');
        }
        //取出去年记录
        /*if($rid=='4879'){*/
            $result = unserialize($lastyearModel->get_lastyear_property($rid,$year)['data']);
        /*}else{
            $result = unserialize(M('house_village_room_fee_lastyear')->where(array('type' => 'property', 'year' => $year, 'rid' => $rid))->find()['data']);
        }*/
        //查找房间信息
        $field = array(
            'r.*',
            'ru.property_endtime',
            'ru.property_defaulttime',
            'ub.name' => 'user_name',
            'rt.property_unit'
        );
        $room_info = M('house_village_room')
            ->alias('r')
            ->join('left join __HOUSE_VILLAGE_ROOM_UPTOWN__ ru on ru.rid=r.id')
            ->join('left join __HOUSE_VILLAGE_ROOM_TYPE__ rt on rt.pigcms_id=r.room_type')
            ->join('left join __HOUSE_VILLAGE_USER_BIND__ ub on ub.pigcms_id=r.owner_id')
            ->where(array('r.id'=>$rid))
            ->field($field)
            ->find();
        $property_fee_list = array(
            'room_name' => $room_info['room_name'],
            'property_unit' => $room_info['property_unit'],
            'name' => $room_info['user_name'],
            'roomsize' => $room_info['roomsize'],
            'property_unit' => $room_info['property_unit'],
            'lastyear_receive' => round($result['lastyear_receive'], 2),
            'lastyear_advance' => round($result['lastyear_advance'], 2),
            'property_mouth' => round($room_info['property_unit'] * $room_info['roomsize'], 2),
        );
        $payend_recive = $property_fee_list['lastyear_receive'];
        $payend_advance = $property_fee_list['lastyear_advance'];
        //循环获取月份数据
        for ($i = 1; $i <= $this->month_number; $i++) {
            $time_start = strtotime($year . '-' . $i);
            $j = $i + 1;
            $time_end = strtotime($year . '-' . $j);
            $info = M('house_village_room_propertylist')->where(array('rid' => $rid, 'pay_time' => array('between', array($time_start, $time_end)), 'status' => 1))->select();
            $all = 0;
            foreach ($info as $value1) {
                $all += $value1['pay_true'];
            }
            if($room_info['property_emptytime']==1||$room_info['property_emptytime']>$time_end){
                $property_fee_list['list'][$i]['pay_recive'] = round($property_fee_list['property_mouth']*0.7,2);
            }else{
                $property_fee_list['list'][$i]['pay_recive'] = $property_fee_list['property_mouth'];
            }
            $property_fee_list['list'][$i]['pay_true'] = $all;
            $check = round($payend_recive + $property_fee_list['list'][$i]['pay_recive'] - $payend_advance - $property_fee_list['list'][$i]['pay_true'], 2);
            if ($check >= 0) {
                $property_fee_list['list'][$i]['payend_recive'] = $check;
                $property_fee_list['list'][$i]['payend_advance'] = 0;
            } else {
                $property_fee_list['list'][$i]['payend_recive'] = 0;
                $property_fee_list['list'][$i]['payend_advance'] = -$check;
            }
            $payend_recive = $property_fee_list['list'][$i]['payend_recive'];
            $payend_advance = $property_fee_list['list'][$i]['payend_advance'];
        }
        if($room_info['property_emptytime']==1||$room_info['property_emptytime']>$time_end){
            $property_fee_list['remark'] = str_replace('-', '.', $room_info['property_defaulttime']) . '-' . str_replace('-', '.', $room_info['property_endtime']).'\n物业费已七折';
        }elseif($room_info['property_emptytime']<$time_end){
            $property_fee_list['remark'] = str_replace('-', '.', $room_info['property_defaulttime']) . '-' .date('Y.n.j',$room_info['property_emptytime']).'\n物业费已七折\n'.date('Y.n.j',$room_info['property_emptytime']) . '-' . str_replace('-', '.', $room_info['property_endtime']);
        }else{
            $property_fee_list['remark'] = str_replace('-', '.', $room_info['property_defaulttime']) . '-' . str_replace('-', '.', $room_info['property_endtime']);
        }
        $sum_recive = $sum_true = $sum_endrecive = $sum_endadvance = 0;
        foreach ($property_fee_list['list'] as $key => $value1) {
            $sum_recive += $value1['pay_recive'];
            $sum_true += $value1['pay_true'];
        }

        $property_fee_list['sum_recive'] = $sum_recive;
        $property_fee_list['sum_true'] = $sum_true;
        $property_fee_list['sum_nowend'] = round($property_fee_list['lastyear_receive'] + $sum_recive - $sum_true - $property_fee_list['lastyear_advance'], 2);
        $cache=M('house_village_fee_cache')->where(array('rid'=>$rid,'year'=>$year,'type'=>'property'))->find();
        $data=array(
            'rid'=>$rid,
            'village_id'=>$this->village_id,
            'project_id'=>$room_info['project_id'],
            'data'=>serialize($property_fee_list),
            'updatetime'=>time(),
            'type'=>'property',
            'year'=>$year
        );
        if(empty($cache)){
            $re1=M('house_village_fee_cache')->data($data)->add();
        }else{
            $re1=M('house_village_fee_cache')->where(array('rid'=>$rid,'year'=>$year,'type'=>'property'))->data($data)->save();
        }
        return $re1;

    }
    /**
     * @author zhukeqin
     * 泊位费记录单条更新
     * @param $carspace_id
     * @param string $year
     * @return string
     */
    public function carspace_update_cache($carspace_id,$year=''){
        $this->set_year($year);
        $lastyearModel=new House_village_room_fee_lastyearModel();
        if(empty($carspace_id)){
            return '必须传入车位id';
        }
        if(empty($year)){
            $year=date('Y');
        }
        //取出去年记录
        //$result = unserialize(M('house_village_room_fee_lastyear')->where(array('type' => 'carspace', 'year' => $year, 'carspace_id' => $carspace_id))->find()['data']);
        $result = unserialize($lastyearModel->get_lastyear_carspace($carspace_id,$year)['data']);
        //查找车位信息
        $field = array(
            'uc.*',
            'r.*',
            'ub.name' => 'user_name',
        );
        if (!empty($this->project_id)) {
            $where['uc.project_id'] = $this->project_id;
        }
        $where['uc.pigcms_id']=$carspace_id;
        $carspace_list = M('house_village_user_car')
            ->alias('uc')
            ->join('left join __HOUSE_VILLAGE_ROOM__ r on uc.rid=r.id')
            ->join('left join __HOUSE_VILLAGE_USER_BIND__ ub on ub.pigcms_id=r.owner_id')
            ->where($where)
            ->field($field)
            ->find();
        $carspace_fee_list = array();
        $sum = array(
            'sum_last' => 0,
            'sum_nowrecive' => 0,
            'sum_nowtrue' => 0,
            'sum_nowend' => 0,
            'num' => 0,
            'allprice' => 0,
        );
        $carspace_fee_list = array(
            'room_name' => $carspace_list['room_name'],
            'carspace_price' => $carspace_list['carspace_price'],
            'name' => $carspace_list['user_name'],
            'rid' => $carspace_list['rid'],
        );
        for ($i = 1; $i <= $this->month_number; $i++) {
            $time_start = strtotime($year . '-' . $i);
            $j = $i + 1;
            $time_end = strtotime($year . '-' . $j);
            $info = M('house_village_room_carspacelist')->where(array('carspace_id' => $carspace_list['pigcms_id'], 'pay_time' => array('between', array($time_start, $time_end)), 'status' => 1))->select();
            $all = 0;
            foreach ($info as $value1) {
                $all += $value1['pay_true'];
            }
            $carspace_fee_list['list'][$i]['pay_recive'] = $carspace_list['carspace_price'];
            $carspace_fee_list['list'][$i]['pay_true'] = $all;
        }
        $carspace_fee_list['remark'] = str_replace('-', '.', $carspace_list['carspace_start']) . '-' . str_replace('-', '.', $carspace_list['carspace_end']);

        $sum_recive = $sum_true = 0;
        foreach ($carspace_fee_list['list'] as $key => $value1) {
            $sum_recive += $carspace_fee_list['carspace_price'];
            $sum_true += $value1['pay_true'];
            $sum['list'][$key]['sum_recive'] += $carspace_fee_list['carspace_price'];
            $sum['list'][$key]['sum_true'] += $value1['pay_true'];
        }
        $carspace_fee_list['sum_last'] = round(unserialize($result['data'])['lastyear_receive'], '2');
        $carspace_fee_list['sum_recive'] = $sum_recive;
        $carspace_fee_list['sum_true'] = $sum_true;
        $carspace_fee_list['sum_nowend'] = round($carspace_fee_list['sum_last'] + $sum_recive - $sum_true, 2);
        $data = array(
            'rid'=>$carspace_list['rid'],
            'carspace_id'=>$carspace_id,
            'village_id' => $this->village_id,
            'project_id' => $carspace_list['project_id'],
            'data' => serialize($carspace_fee_list),
            'updatetime' => time(),
            'type' => 'carspace',
            'year' => $year
        );
        $cache=M('house_village_fee_cache')->where(array('carspace_id'=>$carspace_id,'year'=>$year,'type'=>'carspace'))->find();
        if (empty($cache)) {
            $re1=M('house_village_fee_cache')->data($data)->add();
        } else {
            $re1=M('house_village_fee_cache')->where(array('carspace_id'=>$carspace_id, 'year' => $year,'type'=>'carspace'))->data($data)->save();
        }
        return $re1;
    }
    /**
     * @author zhukeqin
     * 物业费记录单条更新
     * @param $rid
     * @param string $year
     * @return string
     */
    public function other_update_cache($rid,$type_id,$year=''){
        $this->set_year($year);
        $lastyearModel=new House_village_room_fee_lastyearModel();
        if(empty($rid)){
            return '必须传入房间id';
        }
        if(empty($year)){
            $year=date('Y');
        }
        //取出去年记录
        if($rid=='4879'){
            $result=$lastyearModel->get_lastyear_otherfee($rid,$year,$type_id);
        }else{
            $result = unserialize(M('house_village_room_fee_lastyear')->where(array('type' => $type_id, 'year' => $year, 'rid' => $rid))->find()['data']);
        }

        //查找房间信息
        $field=array(
            'r.*',
            'ub.name'=>'user_name',
        );
        if(!empty($this->project_id)){
            $where['r.project_id']=$this->project_id;
        }
        $where['r.id']=$rid;
//dump($where);die;
        $room_list=M('house_village_room')
            ->alias('r')
            ->join('left join __HOUSE_VILLAGE_USER_BIND__ ub on ub.pigcms_id=r.owner_id')
            ->where($where)
            ->field($field)
            ->find();
//
        //dump(M()->_sql());

        $otherfee_list=array(
            'room_name'=>$room_list['room_name'],
            'name'=>$room_list['user_name'],
            'rid'=>$room_list['rid'],
        );
        for($i=1;$i<=$this->month_number;$i++){
            $time_start=strtotime($year.'-'.$i);
            $j=$i+1;
            $time_end=strtotime($year.'-'.$j);
            $info=M('house_village_otherfee')->where(array('rid'=>$room_list['id'],'otherfee_type_id'=>$type_id,'creattime'=>array('between',array($time_start,$time_end)),'status'=>1))->select();
            $all=0;
            $all_recive=0;
            foreach ($info as $value1){
                $all_recive +=$value1['fee_receive'];
                $all +=$value1['fee_true'];
            }
            $otherfee_list['list'][$i]['pay_recive']=$all_recive;
            $otherfee_list['list'][$i]['pay_true']=$all;
        }
        //$otherfee_list[$key]['remark']=str_replace('-','.',$value['carspace_start']).'-'.str_replace('-','.',$value['carspace_end']);

        $sum_recive=$sum_true=0;
        foreach ($otherfee_list['list'] as $key=>$value1){
            $sum_recive +=$value1['pay_recive'];
            $sum_true +=$value1['pay_true'];
        }
        $otherfee_list['sum_last']=round(unserialize($result['data'])['lastyear_receive'],'2');
        $otherfee_list['sum_recive']=$sum_recive;
        $otherfee_list['sum_true']=$sum_true;
        $otherfee_list['sum_nowend']=round($otherfee_list['sum_last']+$sum_recive-$sum_true,2);

        $data = array(
            'rid'=>$rid,
            'village_id' => $this->village_id,
            'project_id' => $this->project_id,
            'data' => serialize($otherfee_list),
            'updatetime' => time(),
            'type' => $type_id,
            'year' => $year
        );
        $cache=M('house_village_fee_cache')->where(array('rid'=>$rid,'year'=>$year,'type'=>$type_id))->find();

        if (empty($cache)) {
            $re1=M('house_village_fee_cache')->data($data)->add();
        } else {
            $re1=M('house_village_fee_cache')->where(array('rid'=>$rid, 'type' => $type_id, 'year' => $year))->data($data)->save();
        }
        return $re1;

    }
    /**
     * @author zhukeqin
     * 获取指定时间内的现金缴费笔数以及总和
     */
    public function get_sum_one($type_id,$start_time,$end_time){
        $property_sum=$this->sum_fee($this->village_id,$this->project_id,'property',$type_id,array($start_time,$end_time));
        $property_count=$this->sum_fee($this->village_id,$this->project_id,'property',$type_id,array($start_time,$end_time),'',1);
        $carspace_sum=$this->sum_fee($this->village_id,$this->project_id,'carspace',$type_id,array($start_time,$end_time));
        $carspace_count=$this->sum_fee($this->village_id,$this->project_id,'carspace',$type_id,array($start_time,$end_time),'',1);
        $sum_list=array(
            'property'=>array('sum_cash'=>$property_sum,'sum_count'=>$property_count),
            'carspace'=>array('sum_cash'=>$carspace_sum,'sum_count'=>$carspace_count)
        );
        $type_list_all=D('House_village_otherfee_type')->get_type_list($this->village_id,'1');
        //设置初始值
        $otherfee_count=0;
        $otherfee_sum=0;
        foreach ($type_list_all as $key=>$value){
            $otherfee_sum_cache=$this->sum_fee($this->village_id,$this->project_id,'other',$type_id,array($start_time,$end_time),$value['otherfee_type_id']);
            $otherfee_count_cache=$this->sum_fee($this->village_id,$this->project_id,'other',$type_id,array($start_time,$end_time),$value['otherfee_type_id'],1);
            $sum_list[$value['otherfee_type_id']]=array('sum_cash'=>$otherfee_sum_cache,'sum_count'=>$otherfee_count_cache);
            $otherfee_sum +=$otherfee_sum_cache;
            $otherfee_count +=$otherfee_count_cache;
        }


        $sum_cash=$property_sum+$carspace_sum+$otherfee_sum;
        $sum_count=$property_count+$carspace_count+$otherfee_count;
        return array('sum_cash'=>$sum_cash,'sum_count'=>$sum_count,'sum_list'=>$sum_list);
    }

    /**
     * @author zhukeqin
     * @param $village_id
     * @param $project_id
     * @return array
     * 获取项目的详细统计信息
     */
    public function get_info_sum($village_id,$project_id){
        $time=strtotime(date('Y-m-d'));
        $year=date('Y');
        //设定合计数组
        $sum=array('room'=>0,'empty'=>0,'prepay'=>0,'noprepay'=>0,'add_money'=>0,'noprepay_money'=>0);
        //获取房间类型列表
        $type_list=M('house_village_room_type')->where(array('village_id'=>$village_id))->select();
        $data=array();
        foreach ($type_list as $key=>$value){
            if($value['desc']=='普通业主') $type_owner=$key;
            if($value['desc']=='商铺') $type_shop=$key;
            $data[$key]['name']=$value['desc'];
            //获取房间数
            $data[$key]['room']=M('house_village_room')
                ->where(array('village_id'=>$village_id,'project_id'=>$project_id,'room_type'=>$value['pigcms_id'],'roomsize'=>array('exp',' is not null AND roomsize != ""')))
                ->count();
            //获取空置数
            $data[$key]['empty']=M('house_village_room')
                ->alias('r')
                ->join('left join __HOUSE_VILLAGE_ROOM_UPTOWN__ ru on ru.rid=r.id')
                ->where(
                    array(
                        'r.village_id'=>$village_id,
                        'r.project_id'=>$project_id,
                        'r.room_type'=>$value['pigcms_id'],
                        'ru.house_type'=>'0',
                        'roomsize'=>array('exp',' is not null AND roomsize != ""')
                    )
                )
                ->count();
            //获取已预交
            $data[$key]['prepay']=M('house_village_room')
                ->alias('r')
                ->join('left join __HOUSE_VILLAGE_ROOM_UPTOWN__ ru on ru.rid=r.id')
                ->where(
                    array(
                        'r.village_id'=>$village_id,
                        'r.project_id'=>$project_id,
                        'r.room_type'=>$value['pigcms_id'],
                        'ru.house_type'=>array('neq','0'),
                        'roomsize'=>array('exp',' is not null AND roomsize != ""'),
                        '_string'=>'UNIX_TIMESTAMP(ru.property_endtime)>='.$time,
                    )
                )
                ->count();
            //获取欠费
            $data[$key]['noprepay']=M('house_village_room')
                ->alias('r')
                ->join('left join __HOUSE_VILLAGE_ROOM_UPTOWN__ ru on ru.rid=r.id')
                ->where(
                    array(
                        'r.village_id'=>$village_id,
                        'r.project_id'=>$project_id,
                        'r.room_type'=>$value['pigcms_id'],
                        'ru.house_type'=>array('neq','0'),
                        '_string'=>'UNIX_TIMESTAMP(ru.property_endtime)<'.$time,
                        'roomsize'=>array('exp',' is not null AND roomsize != ""')
                    )
                )
                ->count();
            //计算总和
            $sum['room'] +=$data[$key]['room'];
            $sum['empty'] +=$data[$key]['empty'];
            $sum['prepay'] +=$data[$key]['prepay'];
            $sum['noprepay'] +=$data[$key]['noprepay'];
        }
        //业主空置面积总和
        $empty_roomsize=M('house_village_room')
            ->alias('r')
            ->join('left join __HOUSE_VILLAGE_ROOM_UPTOWN__ ru on ru.rid=r.id')
            ->where(
                array(
                    'r.village_id'=>$village_id,
                    'r.project_id'=>$project_id,
                    'r.room_type'=>$type_list[$type_owner]['pigcms_id'],
                    'ru.house_type'=>'0',
                    'roomsize'=>array('exp',' is not null AND roomsize != ""')
                )
            )
            ->sum('r.roomsize');
        //商铺面积总和
        $shop_roomsize=M('house_village_room')
            ->alias('r')
            ->join('left join __HOUSE_VILLAGE_ROOM_UPTOWN__ ru on ru.rid=r.id')
            ->where(
                array(
                    'r.village_id'=>$village_id,
                    'r.project_id'=>$project_id,
                    'r.room_type'=>$type_list[$type_shop]['pigcms_id'],
                    'ru.house_type'=>'0',
                    'roomsize'=>array('exp',' is not null AND roomsize != ""')
                )
            )
            ->sum('r.roomsize');
        //地产应补金额
        $sum['add_money']=$shop_roomsize*12*$type_list[$type_shop]['property_unit']+$empty_roomsize*12*$type_list[$type_owner]['property_unit']*0.7;
        //年底时间戳
        $last_time=strtotime(($year+1).'-01-01');
        //欠缴金额
        $noprepay_room=M('house_village_room')
            ->alias('r')
            ->field(array('r.roomsize','ru.property_endtime'))
            ->join('left join __HOUSE_VILLAGE_ROOM_UPTOWN__ ru on ru.rid=r.id')
            ->where(
                array(
                    'r.village_id'=>$village_id,
                    'r.project_id'=>$project_id,
                    'r.room_type'=>$type_list[$type_owner]['pigcms_id'],
                    'ru.house_type'=>array('neq','0'),
                    'roomsize'=>array('exp',' is not null AND roomsize != ""'),
                    '_string'=>'UNIX_TIMESTAMP(ru.property_endtime)<'.$last_time,
                )
            )
            ->group('r.room_name')
            ->select();
        foreach ($noprepay_room as $value){
            $month=explode('-',$value['property_endtime'])['1'];
            $year_cache=$year-explode('-',$value['property_endtime'])['0'];
            $sum['noprepay_money'] +=(13-$month+$year_cache*12)*$type_list[$type_owner]['property_unit']*$value['roomsize'];
        }

        return array('data'=>$data,'sum'=>$sum);
    }

    public function set_year($year){
        $this->year=$year?:date('Y');
        $this->lastyear = $this->year - 1;
        $this->nextyear = $this->year + 1;
        if ($this->year == date('Y')) {
            $this->month_number = date('n');
        } elseif ($this->year > date('Y')) {
            $this->month_number = 0;
        } else {
            $this->month_number = 12;
        }
    }

}