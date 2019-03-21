<?php

/**
 * @author zhukeqin
 * Class IndexajaxAction
 * 主要用于首页ajax交互数据
 */



class IndexajaxAction extends BaseAction{

    public function __construct()
    {
        parent::__construct();
        $this->village_id=filter_village(0, 2);;
        $this->project_id=$_SESSION['project_id'];
        //遍历获取菜单权限
        if(session('system.account')==SUPER_ADMIN){
            $_map['is_show'] = 1;
            $_map['status'] = 1;
            $_map['auth_type'] = 4;
            $_map['auth_area'] = 0;
            $this->modelList = M('permission_menu')->where($_map)->order('`sort` DESC,`fid` ASC,`id` ASC')->select();
        }else{
            $O2O_role_idStr = M('admin')->where(array('id'=>$_SESSION['system']['id']))->getField('role_id');
            //多角色权限修改
            $O2O_role_idArr = explode(',',$O2O_role_idStr);
            $is_allowing_string = '';
            //角色权限遍历整合
            foreach ($O2O_role_idArr as $v) {
                $string = M('role')->where(array('role_id'=>$v))->getField('menus');
                $is_allowing_string .= $string.',';
            }
            $is_allowing_string = trim($is_allowing_string,',');

            //去重
            $is_allowing_stringArr = array_unique(explode(',',$is_allowing_string));

            $is_allowing_string = implode(',',$is_allowing_stringArr);
            $this->modelList = M()->query("select * from pigcms_permission_menu where id in ($is_allowing_string) and auth_type=4 and auth_area=0 and is_show=1 ORDER BY `sort` DESC,`fid` ASC,`id` ASC");
        }
        $this->modelList_id=array_map(function ($val){return $val['id'];},$this->modelList);//取出菜单id值

    }

    public function ajax_get(){
        $ids=$_POST['ids'];
        $time=$_POST['time']?$_POST['time']:'0至'.date('Y-m-d');
        //遍历获取符合权限的菜单id
        $id_list=array_filter($ids,function ($val){if(in_array($val,$this->modelList_id))return true; else return false;});
        $echo=array();
        foreach ($id_list as $value){
            $data=M('permission_menu')->where(array('id'=>$value))->find();
            $data['arguments']=$this->arguments($data['arguments']);
            if(!empty($data['arguments']['sql'])){
                $data['data']=$this->action_sql($data['arguments']['sql'],$time);
            }
            if(empty($data['data'])&&$data!==0)$data['data']=0;
            $echo[]=$data;
        }
        echo json_encode($echo);
    }

    /**
     * 秩序部
     */
    public function ajax_get_order(){
        $ids=$_POST['ids'];
        $time=$_POST['time']?$_POST['time']:'0至'.date('Y-m-d');
        $time=explode('至',$time);
        $begin_time=strtotime($time['0']);
        $end_time=strtotime($time['1'])+24*3600;
        $day=ceil(($end_time-$begin_time)/(24*3600));
        $id_list=array_filter($ids,function ($val){if(in_array($val,$this->modelList_id))return true; else return false;});
        foreach ($id_list as $value){
            $data=M('permission_menu')->where(array('id'=>$value))->find();
            $data['arguments']=$this->arguments($data['arguments']);
            $map['p.pay_time']=array(array('gt',$begin_time),array('lt',$end_time));//时间条件
            $map['p.pay_status']='1';
            $garage_id=M('garage','smart_')->where(array('village_id'=>$this->village_id))->find()['garage_id'];
            if($value==304){
                $sum = M('payrecord','smart_')->alias('p')
                    ->join('LEFT JOIN smart_servicerecord s on p.serv_id = s.serv_id')
                    ->where($map)
                    ->where("s.garage_id=$garage_id and FROM_UNIXTIME(p.pay_time,'%H%i')>='0700' and FROM_UNIXTIME(p.pay_time,'%H%i')<='1500'")
                    ->sum('p.payment');
                //dump(M()->_sql());
            } elseif($value==305) {
                $sum = M('payrecord','smart_')->alias('p')
                    ->join('LEFT JOIN smart_servicerecord s on p.serv_id = s.serv_id')
                    ->where($map)
                    ->where("s.garage_id=$garage_id and FROM_UNIXTIME(p.pay_time,'%H%i')>'1500' and FROM_UNIXTIME(p.pay_time,'%H%i')<'2300'")
                    ->sum('p.payment');
            } elseif($value==306) {
                $sum1 = M('payrecord','smart_')->alias('p')
                    ->join('LEFT JOIN smart_servicerecord s on p.serv_id = s.serv_id')
                    ->where($map)
                    ->where("s.garage_id=$garage_id and FROM_UNIXTIME(p.pay_time,'%H%i')>='2300' and FROM_UNIXTIME(p.pay_time,'%H%i')<='2359'")
                    ->sum('p.payment');

                $sum2 = M('payrecord','smart_')->alias('p')
                    ->join('LEFT JOIN smart_servicerecord s on p.serv_id = s.serv_id')
                    ->where($map)
                    ->where("s.garage_id=$garage_id and FROM_UNIXTIME(p.pay_time,'%H%i')>='0000' and FROM_UNIXTIME(p.pay_time,'%H%i')<'0700'")
                    ->sum('p.payment');
                $sum = $sum1+$sum2;
            }elseif($value==301){
                //大于一年时默认选择一个月
                if($day>365){
                    $begin_time1=strtotime(date('Y-m-d'))-29*3600*24;
                    $end_time1=strtotime(date('Y-m-d'))+24*3600;
                    $day1=30;
                }else{
                    $begin_time1=$begin_time;
                    $end_time1=$end_time;
                    $day1=$day;
                }
                $sum1 = M('village_point_record')->alias('r')
                    ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
                    ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
                    ->where(array('r.check_time'=>array('between',array($begin_time1,$end_time1))))
                    ->where(array('m.village_id'=>$this->village_id,'p.is_del'=>0))
                    ->count();
                $sum_point = M('house_village_point')->alias('p')
                    ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
                    ->where(array('m.village_id'=>$this->village_id,'p.is_del'=>0,'p.type'=>0))
                    ->count();
                $sum=$sum1/($sum_point*$day1);
            }elseif($value==302){
                $sum1 = M('village_point_safety_record')->alias('r')
                    ->field(array("count(DISTINCT r.pid)"=>'num'))
                    ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
                    ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
                    ->where(array('p.type'=>1))
                    ->where(array('m.village_id'=>$this->village_id,'p.is_del'=>array('eq',0)))
                    ->select()[0]['num'];
                $sum_point=M('house_village_point')->alias('p')
                    ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ r ON p.rid=r.id')
                    ->where(array('p.type'=>1))
                    ->where(array('r.village_id'=>session('system.village_id')))
                    ->where(array('p.status'=>array('eq',0),'p.is_del'=>array('eq',0)))
                    ->count()?:0;
                $sum=$sum1/$sum_point;
            }elseif($value==303){
                $sum1 = M()->query("SELECT count(r.pigcms_id) as 'sum'
 FROM pigcms_village_point_safety_record r
 LEFT JOIN pigcms_house_village_point p on p.id=r.pid
 LEFT JOIN pigcms_house_village_room m on m.id=p.rid
 WHERE p.type=1 and m.village_id=$this->village_id and p.is_del=0 and r.point_status LIKE '%-1%' LIMIT 0,1")['0']['sum'];
                $sum_point=M('house_village_point')->alias('p')
                    ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ r ON p.rid=r.id')
                    ->where(array('p.type'=>1))
                    ->where(array('r.village_id'=>session('system.village_id')))
                    ->where(array('p.status'=>array('eq',0),'p.is_del'=>array('eq',0)))
                    ->count()?:0;
                $sum=$sum1/$sum_point;
            }
            $data['data']=$sum?$sum:0;
            $echo[]=$data;
        }
        echo json_encode($echo);
    }

    /**
     * 财务部ajax获取
     */
    public function ajax_get_budget(){
        $ids=$_POST['ids'];
        $time=$_POST['time']?$_POST['time']:'0至'.date('Y-m-d');
        $time=explode('至',$time);
        $begin_time=strtotime($time['0']);
        $end_time=strtotime($time['1'])+24*3600;
        $day=ceil(($end_time-$begin_time)/(24*3600));
        $id_list=array_filter($ids,function ($val){if(in_array($val,$this->modelList_id))return true; else return false;});
        $budget_log=new Budget_logModel();
        $company_id=M('house_village')->where(array('village_id'=>$this->village_id))->find()['department_id'];
        $sum_list=$budget_log->get_excel_log_sum($this->village_id,$this->project_id,$company_id,'');
        foreach ($id_list as $value){
            $data=M('permission_menu')->where(array('id'=>$value))->find();
            $data['arguments']=$this->arguments($data['arguments']);
            if($value==325){
                $sum=$sum_list['output']['sum_money'];
            }elseif($value==326){
                $sum=$sum_list['output']['sum_sum'];
            }elseif($value==327){
                $sum=$sum_list['output']['difference'];
            }elseif($value==328){
                $sum=$sum_list['input']['sum_money'];
            }elseif($value==329){
                $sum=$sum_list['input']['sum_sum'];
            }elseif($value==330){
                $sum=$sum_list['input']['difference'];
            }
            $data['data']=$sum?$sum:0;
            $echo[]=$data;
        }
        $where=array('type_fid'=>0);
        $village_info=M('house_village')->where(array('village_id'=>$this->village_id))->find();
        $where['company_id']=$village_info['department_id'];
        $where['type_id']=array('neq','4');
        $type_first_list=D('Budget_type')->get_type_list($where);
        $log_list=array();
        foreach ($type_first_list as $value){
            $log_list[]=$budget_log->get_excel_log_type($value['type_id'],$this->village_id,$this->project_id,$company_id,'');
        }
        $map=array();
        $month=date('n');
        for ($i=1;$i<=$month;$i++){
            $cache=0;
            foreach ($log_list as $key=>$value){
                $cache +=$value['sum'][$i];
            }
            $map[]=array(
                'date'=>$i.'月',
                'visits'=>$cache
            );
        }
        unset($data);
        $data['echo']=$echo;
        $data['map']=$map;
        echo json_encode($data);
    }

    public function action_sql($sql,$time){
        $village_id=$this->village_id;
        $project_id=$this->project_id;
        $sql=str_replace('{village_id}',$village_id,$sql);
        if(empty($project_id)){
            $sql=str_replace('vp.pigcms_id={project_id}','1=1',$sql);
            $sql=str_replace('left join pigcms_house_village_project vp on vp.village_id=v.village_id','',$sql);
        }else{
            $sql=str_replace('{project_id}',$project_id,$sql);
        }
        $time=explode('至',$time);
        $date_start=$time['0'];
        $date_end=$time['1'];
        //日期替换
        $sql=str_replace('{date_start}',$date_start,$sql);
        $sql=str_replace('{date_end}',$date_end,$sql);
        //时间戳替换
        $sql=str_replace('{time_start}',strtotime($time['0']),$sql);
        $sql=str_replace('{time_end}',strtotime($time['1'])+24*3600,$sql);

        $reutrn=array_shift(M()->query($sql)['0']);
        return $reutrn;

    }

    public function arguments($arguments){
        $arguments=unserialize($arguments);
        foreach ($arguments as $key2=>$value2){
            $return[$value2['a_key']]=htmlspecialchars_decode($value2['a_value']);
        }
        return $return;
    }

    public function ajax_get_weater(){
        $time=$_POST['time']?$_POST['time']:"";
        $data=D('Weather')->get_weather_date($time);
        echo json_encode($data);
    }



}