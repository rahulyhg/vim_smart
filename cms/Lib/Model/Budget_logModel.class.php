<?php

/**
 * @author zhukeqin
 * 统计记录控制器
 * Class Budget_logModel
 */
class Budget_logModel extends Model{

    /**
     * @author zhukeqin
     * @param $where
     * 取得符合要求的单条数据
     */

    public function get_log_one($where){
        $return=$this->where($where)->order('`log_id` ASC')->find();
        //标记project_id
        if(empty($return)){
            $type_info=D('Budget_type')->get_type_one(array('type_id'=>$where['type_id']));
            if($type_info['type_rank']==3 &&!empty($where['village_id'])&&!empty($where['project_id'])){

            }
        }
        //dump(M()->_sql());
        return $return;

    }
    /**
     * @author zhukeqin
     * @param $where
     * @param $sort 排序方式
     * 取得符合要求的单条数据
     */
    public function  get_log_list($where,$sort='`log_id` ASC'){
        return $this->where($where)->order($sort)->select();
    }

    /**
     * @author zhukeqin
     * @param $village_id
     * @param $project_id
     * @param $year
     * @return mixed
     * 获取对应项目在当前年份的所属公司
     */
    public function get_company_id($village_id,$project_id,$year){
        if(empty($year)) $year=date('Y');
        if($year<date('Y')){
            $where1=array('village_id'=>$village_id,'year'=>$year);
            if(!empty($project_id)) $where1['project_id']=$project_id;
//            dump($where1);die;
            //标记2
            $company_id=$this->get_log_one($where1)['company_id'];
            if(empty($company_id)) $company_id=M('house_village')->where(array('village_id'=>$village_id))->find()['department_id'];
        }else{
            $company_id=M('house_village')->where(array('village_id'=>$village_id))->find()['department_id'];
        }
        return $company_id;
    }

    public function change_log_one($type_id,$village_id,$company_id,$project_id,$year)
    {
        if (empty($type_id) || empty($village_id) ) {
            return '必须传入指定参数';
        }
        if (empty($year)) {
            $year = date('Y');
        }
        $month_number = date('n');
        $company_id=$this->get_company_id($village_id,$project_id,$year);
        $where = array(
            'type_id' => $type_id,
            'village_id' => $village_id,
            /*            'company_id' => $company_id,*/
            'money_year'=>$year
        );
        if (empty($project_id)) {

        } else {
            $where['project_id'] = $project_id;
            $project_info=M('house_village_project')->where(array('pigcms_id'=>$where['project_id'],'village_id'=>$village_id))->find();
            if(empty($project_info)) return '该小区不输于该项目';
        }
        //取出本年预算
        $result = D('Budget_money')->get_money_one($where);
        //如果当年预算不存在则获取去年的预算更新;去除
        /*if(empty($result)){
            D('Budget_money')->add_money_one('',$where['type_id'],$where['village_id'],$where['company_id'],$where['year'],$where['project_id']);
            $result=D('Budget_money')->get_money_one($where);
        }*/
        //去除年份
        unset($where['money_year']);
        //循环获取月份数据
        $sum = 0;
        $data = array();
        for ($i = 1; $i <= 12; $i++) {
            $time = strtotime($year . '-' .$i);
            //$where['record_time'] = array('like', $time);
            $starttime=strtotime(date('Y-m',$time));
            $endtime=strtotime(date('Y-m-t',$time))+24*3600;
            //$where['record_check_time']=array('between',array($starttime,$endtime));
            $where['record_check_time']=array(array('egt',$starttime),array('lt',$endtime));
            $where['record_status']='2';
            //标记3
            $info = D('Budget_record')->get_record_list($where);
            /*dump($info);
            dump($where);
            dump(M()->_sql());
            die;*/
            $all = 0;
            foreach ($info as $value1) {
                $all += $value1['record_money'];
            }
            $sum += $all;
            if(empty($all)){
                $data[$i]='';
            }else{
                $data[$i]=$all;
            }
        }
        $data['sum']=$sum;
        $data['money_sum']=$result['money_sum'];
        unset($where['record_time']);
        unset($where['record_status']);
        $where['log_time']=$year;
        $cache = $this->get_log_one($where);
        $add = array(
            'type_id' => $type_id,
            'village_id' => $village_id,
            'company_id' => $company_id,
            'log_time' => $year,
            'log_update' => time(),
            'log_data' => serialize($data),
        );
        if (empty($project_id)) {

        } else {
            $add['project_id'] = $project_id;
        }
        if (empty($cache)) {

            $re1 = $this->data($add)->add();
        } else {

            $re1 = $this->where($where)->data($add)->save();
        }
        return $re1;
    }

    /**
     * @author zhukeqin
     * @param $type_id
     * @param $village_id
     * @param $project_id
     * @param $company_id 需要查询某项目历史时，建议不要传入该参数  函数会自动获取那年的公司id
     * @param $year
     * @return array
     * 根据第一类来选择输出表格
     */
    public function get_excel_log_type($type_id,$village_id,$project_id,$company_id,$year){
        if(empty($year)){
            $year=date('Y');
        }
        $where=array(
            'log_time'=>$year
        );
        if(!empty($village_id)){
            $where['village_id']=$village_id;
        }

        if(empty($project_id)){

        }else{
            $where['project_id']=$project_id;
        }

        if(!empty($company_id)){
            $where['company_id']=$company_id;
        }
        $search=array('type_fid'=>$type_id);
        if(!empty($where['company_id'])){
            //计算分公司总和时遇到的问题进行处理
            if($where['company_id']['0']=='IN'){
                $search['company_id']=$company_id['1'];
            }else{
                $search['company_id']=$company_id;
            }
        }elseif(!empty($village_id)){
            $village_info=M('house_village')->where(array('village_id'=>$village_id))->find();
            /*$where1=array('village_id'=>$village_id,'year'=>$year);
            if(!empty($project_id)) $where1['project_id']=$project_id;
            $search['company_id']=$where['company_id']=$this->get_log_one($where1)['company_id'];//获取当年的公司id
            if(empty($search['company_id'])) $search['company_id']=$where['company_id']=$village_info['department_id'];*/
            //$search['company_id']=$village_info['department_id'];
            $search['company_id']=$where['company_id']=$this->get_company_id($village_id,$project_id,$year);
        }
        $type_second_list=D('Budget_type')->get_type_list($search);
        //
        $data=array();
        $sum=array(
            'sum_money'=>0,
            'sum_sum'=>0
        );
        foreach ($type_second_list as $value){
            unset($cache);
            $cache['type_name']=$value['type_name'];
            $cache['type_remark']=$value['type_remark'];
            $search['type_fid']=$value['type_id'];
            $type_third_list=D('Budget_type')->get_type_list($search);
            foreach ($type_third_list as $value1){
                $where['type_id']=$value1['type_id'];
                $cache['children'][$value1['type_id']]['type_name']=$value1['type_name'];
                $cache['children'][$value1['type_id']]['type_remark']=$value1['type_remark'];
                $log_list=$this->get_log_list($where);
                //dump($log_list);die;
                //如果log为空且为当个项目时，则刷新log
                /*if(empty($log_list)&&!empty($where['village_id'])){
                    $this->change_log_one($where['type_id'],$where['village_id'],$where['company_id'],$where['project_id'],$year);
                    $log_list=$this->get_log_list($where);
                }*/
                foreach ($log_list as $value2){
                    $log_data=unserialize($value2['log_data']);
                    $cache['children'][$value1['type_id']]['type_data']=$log_data;
                    //dump($log_data);
                    foreach ($log_data as $key=>$value3){
                        if($key=='money_sum'){
                            //echo 1;
                            $sum['sum_money'] +=$value3;
                            $cache['sum']['sum_money'] +=$value3;
                        }elseif($key=='sum'){
                            $sum['sum_sum'] +=$value3;
                            $cache['sum']['sum_sum'] +=$value3;
                        }else{
                            $sum[$key] +=$value3;
                            $cache['sum'][$key] +=$value3;
                        }
                    }
                }
            }
            $data[$value['type_id']]=$cache;
        }//die;
        $data['sum']=$sum;
        /*if(!empty($company_id)){
            dump($data);
        }*/
        return $data;
    }

    /**
     * @author zhukeqin
     * @param $village_id
     * @param $project_id
     * @param $company_id
     * @param $year
     * @return array
     * 输出合计
     */
    public function get_excel_log_sum($village_id,$project_id,$company_id,$year){
        //设定搜索条件
        if(empty($year)){
            $year=date('Y');
        }
        $where=array('type_fid'=>0);
        if(!empty($company_id)){
            if($company_id['0']=='IN'){
                $where['company_id']=$company_id['1'];
            }else{
                $where['company_id']=$company_id;
            }
        }elseif(!empty($village_id)){

            $village_info=M('house_village')->where(array('village_id'=>$village_id))->find();

            $where['company_id']=$village_info['department_id'];
        }
        $type_first_list=D('Budget_type')->get_type_list($where);
        $data=array();
        $sum=array(
            'sum_money'=>0,
            'sum_sum'=>0,
            'difference'=>0,
        );
        foreach ($type_first_list as $value){
            unset($cache);
            $cache['type_name']=$value['type_name'];
            $cache['type_remark']=$value['type_remark'];
            $log=$this->get_excel_log_type($value['type_id'],$village_id,$project_id,$company_id,$year);
//            dump($log);die;
            /*if($company_id&&$value['type_id']==4){
                dump($log);
            }*/
            $log_sum=$log['sum'];
            unset($log['sum']);
            dump($log);
            foreach ($log as $value1){
                $cache['children'][$value1['type_name']]['type_name']=$value1['type_name'];
                $cache['children'][$value1['type_name']]['type_remark']=$value1['type_remark'];
                $cache_sum=0;
                $cache_money=0;
                /*foreach ($value1['children'] as $key2=>$value2){
                        $cache_money +=$value2['type_data']['money_sum'];
                        $cache_sum +=$value2['type_data']['sum'];
                }*/
                $cache_money=$value1['sum']['sum_money'];
                $cache_sum=$value1['sum']['sum_sum'];
                $cache['children'][$value1['type_name']]['sum_money']+=$cache_money;
                $cache['children'][$value1['type_name']]['difference']+=$cache_money-$cache_sum;
                $cache['children'][$value1['type_name']]['sum_sum']+=$cache_sum;
            }
            $cache['sum_money']=$log_sum['sum_money'];
            $cache['difference']=$log_sum['sum_money']-$log_sum['sum_sum'];
            $cache['sum_sum']=$log_sum['sum_sum'];
//            dump($cache);
            if($cache['type_name']=='收入明细'){
                $sum['sum_money'] +=$cache['sum_money'];
                $sum['sum_sum'] +=$cache['sum_sum'];
                $sum['difference'] +=$cache['difference'];
                /*dump($sum);*/
                //修改处
                $data['input']['sum_money']=$cache['sum_money'];
                $data['input']['difference']=$cache['difference'];
                $data['input']['1']=$cache;
                $data['input']['sum_sum']=$cache['sum_sum'];
                //计算增值税
                $data_cache['type_name']='增值税及附加';
                $data_cache['type_remark']='按收入6.3%测算';
                $data_cache['children']['增值税及附加']['type_name']='增值税及附加';
                if($village_id==54){
                    //修改处

                    $data_cache['children']['增值税及附加']['sum_money']=$cache['sum_money']/(1+0.03)*0.03*(1+0.055);//增值税金额都由6.3%计算

                    $data_cache['children']['增值税及附加']['sum_sum']=$cache['sum_sum']/(1+0.03)*0.03*(1+0.055);
                }elseif($village_id==70){
                    $cache_type=0.03;
                    //修改处
                    $data_cache['children']['增值税及附加']['sum_money']=$cache['sum_money']/(1+$cache_type)*$cache_type*(1+0.115);//增值税金额都由6.3%计算

                    $data_cache['children']['增值税及附加']['sum_sum']=$cache['sum_sum']/(1+$cache_type)*$cache_type*(1+0.115);
                }else{
                    $cache_type=0.06;
                    //修改处
                    $data_cache['children']['增值税及附加']['sum_money']=$cache['sum_money']/(1+$cache_type)*$cache_type*(1+0.115);//增值税金额都由6.3%计算

                    $data_cache['children']['增值税及附加']['sum_sum']=$cache['sum_sum']/(1+$cache_type)*$cache_type*(1+0.115);
                }

                $data_cache['children']['增值税及附加']['difference']=$data_cache['children']['增值税及附加']['sum_money']-$data_cache['children']['增值税及附加']['sum_sum'];
                $data_cache['sum_money']=$data_cache['children']['增值税及附加']['sum_money'];
                $data_cache['sum_sum']=$data_cache['children']['增值税及附加']['sum_sum'];
                $data_cache['difference']=$data_cache['children']['增值税及附加']['difference'];
                $data['output']['4']=$data_cache;
                //修改处

                $data['output']['sum_money'] +=$data_cache['sum_money'];
                $data['output']['difference'] +=$data_cache['difference'];

                $data['output']['sum_sum'] +=$data_cache['sum_sum'];
                //修改处
                $sum['sum_money'] -=$data_cache['sum_money'];
                $sum['difference'] -=$data_cache['difference'];

                $sum['sum_sum'] -=$data_cache['sum_sum'];

                /*dump($sum);*/
            }else{
                $sum['sum_money'] -=$cache['sum_money'];
                $sum['sum_sum'] -=$cache['sum_sum'];
                $sum['difference'] -=$cache['difference'];
                /*dump($sum);*/
                $data['output'][$value['type_id']]=$cache;
                //修改处
                $data['output']['sum_money'] +=$cache['sum_money'];
                $data['output']['difference'] +=$cache['difference'];

                $data['output']['sum_sum'] +=$cache['sum_sum'];
            }

        }die;
        //dump($data);die;
        $data['sum']=$sum;
        return $data;
    }

    public function get_tax_cache($village_id,$project_id,$year){
        $village_list=array('54','70');
        if(!in_array($village_id,$village_list)) return array('sum_money'=>0,'sum_sum'=>0,'difference'=>0);
        if(!empty($village_id)){
            $village_info=M('house_village')->where(array('village_id'=>$village_id))->find();
            $where['company_id']=$village_info['department_id'];
        }
        $type_first_list=D('Budget_type')->get_type_list($where);
        $data=array();
        $sum=array(
            'sum_money'=>0,
            'sum_sum'=>0,
            'difference'=>0,
        );
        foreach ($type_first_list as $value){
            unset($cache);
            $cache['type_name']=$value['type_name'];
            $cache['type_remark']=$value['type_remark'];
            $log=$this->get_excel_log_type($value['type_id'],$village_id,$project_id,'',$year);
            /*if($company_id&&$value['type_id']==4){
                dump($log);
            }*/
            $log_sum=$log['sum'];
            unset($log['sum']);
            foreach ($log as $value1){
                $cache['children'][$value1['type_name']]['type_name']=$value1['type_name'];
                $cache['children'][$value1['type_name']]['type_remark']=$value1['type_remark'];
                $cache_sum=0;
                $cache_money=0;
                /*foreach ($value1['children'] as $key2=>$value2){
                        $cache_money +=$value2['type_data']['money_sum'];
                        $cache_sum +=$value2['type_data']['sum'];
                }*/
                $cache_money=$value1['sum']['sum_money'];
                $cache_sum=$value1['sum']['sum_sum'];

                $cache['children'][$value1['type_name']]['sum_money']+=$cache_money;
                $cache['children'][$value1['type_name']]['sum_sum']+=$cache_sum;
                $cache['children'][$value1['type_name']]['difference']+=$cache_money-$cache_sum;
            }
            $cache['sum_money']=$log_sum['sum_money'];
            $cache['sum_sum']=$log_sum['sum_sum'];
            $cache['difference']=$log_sum['sum_money']-$log_sum['sum_sum'];
            if($cache['type_name']=='收入明细'){
                $sum['sum_money'] +=$cache['sum_money'];
                $sum['sum_sum'] +=$cache['sum_sum'];
                $sum['difference'] +=$cache['difference'];
                /*dump($sum);*/
                $data['input']['1']=$cache;
                $data['input']['sum_money']=$cache['sum_money'];
                $data['input']['sum_sum']=$cache['sum_sum'];
                $data['input']['difference']=$cache['difference'];
                //计算增值税
                $data_cache['type_name']='增值税及附加';
                $data_cache['type_remark']='按收入6.3%测算';
                $data_cache['children']['增值税及附加']['type_name']='增值税及附加';
                if($village_id==54){
                    $data_cache['children']['增值税及附加']['sum_money']=$cache['sum_money']/(1+0.03)*0.03*(1+0.055);//增值税金额都由6.3%计算
                    $data_cache['children']['增值税及附加']['sum_sum']=$cache['sum_sum']/(1+0.03)*0.03*(1+0.055);
                }elseif($village_id==70){
                    $cache_type=0.03;
                    $data_cache['children']['增值税及附加']['sum_money']=$cache['sum_money']/(1+$cache_type)*$cache_type*(1+0.115);//增值税金额都由6.3%计算
                    $data_cache['children']['增值税及附加']['sum_sum']=$cache['sum_sum']/(1+$cache_type)*$cache_type*(1+0.115);
                }
                $cache_type=0.06;
                $different['sum_money']=$cache['sum_money']/(1+$cache_type)*$cache_type*(1+0.115);//增值税金额都由6.3%计算
                $different['sum_sum']=$cache['sum_sum']/(1+$cache_type)*$cache_type*(1+0.115);
                $different['difference']=$different['sum_money']-$different['sum_sum'];
                $data_cache['children']['增值税及附加']['difference']=$data_cache['children']['增值税及附加']['sum_money']-$data_cache['children']['增值税及附加']['sum_sum'];
                $data_cache['sum_money']=$data_cache['children']['增值税及附加']['sum_money'];
                $data_cache['sum_sum']=$data_cache['children']['增值税及附加']['sum_sum'];
                $data_cache['difference']=$data_cache['children']['增值税及附加']['difference'];
                $data['output']['4']=$data_cache;
                $data['output']['sum_money'] +=$data_cache['sum_money'];
                $data['output']['sum_sum'] +=$data_cache['sum_sum'];
                $data['output']['difference'] +=$data_cache['difference'];
                $sum['sum_money'] -=$data_cache['sum_money'];
                $sum['sum_sum'] -=$data_cache['sum_sum'];
                $sum['difference'] -=$data_cache['difference'];
                /*dump($sum);*/
            }
        }
        $now['sum_money']=-$different['sum_money']+$data['output']['4']['sum_money'];
        $now['sum_sum']=-$different['sum_sum']+$data['output']['4']['sum_sum'];
        $now['difference']=-$different['difference']+$data['output']['4']['difference'];
        return $now;
    }

    /**
     * @author zhukeqin
     * @param $company_id
     * @param $year
     * @return array
     * 输出公司合计
     */
    public function get_excel_log_sum_company($company_id,$year,$model=''){
        //设定搜索条件
        if(empty($year)){
            $year=date('Y');
        }
        if($year<date('Y')){
            $log_list=M('budget_log')->where(array('company_id'=>$company_id))->group('village_id')->select();
            foreach ($log_list as $value){
                $village_list[]=M('house_village')->where(array('village_id'=>$value['village_id']))->find();
            }
        }else{
            $village_list = M('house_village')->where(array('department_id'=>$company_id))->select();
        }
        $data=array();
        //dump($village_list);die;
//        $village_list=M('house_village')->where(array('department_id'=>$company_id))->select();
        $sum_sum_add=0;//增值税单独处理
        $sum_money_add=0;
        if(empty($model)){
            foreach ($village_list as $value){
                $cache=M('house_village_project')->where(array('village_id'=>$value['village_id']))->select();
                if(empty($cache)){
                    $list=$this->get_excel_log_sum($value['village_id'],'','',$year);
                    $list['village_name']=$value['village_name'];
                    $data['list'][]=$list;
                    /*foreach ($list['output'] as $key2=>$value2){
                        if($value2['type_name']=='增值税及附加'){
                            $sum_sum_add +=$value2['sum_sum'];
                            $sum_money_add +=$value2['sum_money'];
                        }
                    }*/
                }else{
                    foreach ($cache as $key1=>$value1){
                        $list=$this->get_excel_log_sum($value['village_id'],$value1['pigcms_id'],'',$year);
                        $list['village_name']=$value['village_name'].'-'.$value1['desc'];
                        $data['list'][]=$list;
                        /*foreach ($list['output'] as $key2=>$value2){
                            if($value2['type_name']=='增值税及附加'){
                                $sum_sum_add +=$value2['sum_sum'];
                                $sum_money_add +=$value2['sum_money'];
                            }
                        }*/
                    }
                }
            }
        }

        $sum=$this->get_excel_log_sum('','',$company_id,$year);
        //增值税处理
        if($company_id=='88'||$company_id=='57'||is_array($company_id)){
            if ($company_id == '88'||in_array('88',$company_id['1'])) {
                $return = $this->get_tax_cache('54', '', $year);
                foreach ($sum['output'] as $key1=>$value1) {
                    if($value1['type_name']=='增值税及附加') {
                        $sum['output']['sum_sum'] = $sum['output']['sum_sum'] + $return['sum_sum'];
                        $sum['output']['sum_money'] = $sum['output']['sum_money'] + $return['sum_money'];
                        $sum['output']['difference'] = $sum['output']['sum_money'] - $sum['output']['sum_sum'];
                        $sum['sum']['sum_sum'] = $sum['input']['sum_sum'] - $sum['output']['sum_sum'];
                        $sum['sum']['sum_money'] = $sum['input']['sum_money'] - $sum['output']['sum_money'];
                        $sum['sum']['difference'] = $sum['sum_money'] - $sum['sum_sum'];
                        $sum['output'][$key1]['sum_sum'] += $return['sum_sum'];
                        $sum['output'][$key1]['sum_money'] += $return['sum_money'];
                        $sum['output'][$key1]['difference'] += $return['difference'];
                        $sum['output'][$key1]['children']['增值税及附加']['sum_sum'] += $return['sum_sum'];
                        $sum['output'][$key1]['children']['增值税及附加']['sum_money'] += $return['sum_money'];
                        $sum['output'][$key1]['children']['增值税及附加']['difference'] += $return['difference'];
                        break;
                    }
                }
            }
            if ($company_id == '57'||in_array('57',$company_id['1'])) {
                $return = $this->get_tax_cache('70', '', $year);
                foreach ($sum['output'] as $key1=>$value1) {
                    if($value1['type_name']=='增值税及附加') {
                        $sum['output']['sum_sum'] = $sum['output']['sum_sum'] + $return['sum_sum'];
                        $sum['output']['sum_money'] = $sum['output']['sum_money'] + $return['sum_money'];
                        $sum['output']['difference'] = $sum['output']['sum_money'] - $sum['output']['sum_sum'];
                        $sum['sum']['sum_sum'] = $sum['input']['sum_sum'] - $sum['output']['sum_sum'];
                        $sum['sum']['sum_money'] = $sum['input']['sum_money'] - $sum['output']['sum_money'];
                        $sum['sum']['difference'] = $sum['sum_money'] - $sum['sum_sum'];
                        $sum['output'][$key1]['sum_sum'] += $return['sum_sum'];
                        $sum['output'][$key1]['sum_money'] += $return['sum_money'];
                        $sum['output'][$key1]['difference'] += $return['difference'];
                        $sum['output'][$key1]['children']['增值税及附加']['sum_sum'] += $return['sum_sum'];
                        $sum['output'][$key1]['children']['增值税及附加']['sum_money'] += $return['sum_money'];
                        $sum['output'][$key1]['children']['增值税及附加']['difference'] += $return['difference'];
                        break;
                    }
                }
            }

        }
        /*foreach ($sum['output'] as $key1=>$value1){
            if($value1['type_name']=='增值税及附加'){
                $now_sum_sum=$sum['output'][$key1]['sum_sum'];
                $now_sum_money=$sum['output'][$key1]['sum_money'];
                $sum['output']['sum_sum'] =$sum['output']['sum_sum']-$now_sum_sum+$sum_sum_add;
                $sum['output']['sum_money'] =$sum['output']['sum_money']-$now_sum_money+$sum_money_add;
                $sum['output']['difference']=$sum['output']['sum_money']-$sum['output']['sum_sum'];
                $sum['sum']['sum_sum']=$sum['input']['sum_sum']-$sum['output']['sum_sum'];
                $sum['sum']['sum_money']=$sum['input']['sum_money']-$sum['output']['sum_money'];
                $sum['sum']['difference']=$sum['sum_money']-$sum['sum_sum'];
                $sum['output'][$key1]['sum_sum']=$sum_sum_add;
                $sum['output'][$key1]['sum_money']=$sum_money_add;
                $sum['output'][$key1]['difference']=$sum_money_add-$sum_sum_add;
                $sum['output'][$key1]['children']['增值税及附加']['sum_sum']=$sum_sum_add;
                $sum['output'][$key1]['children']['增值税及附加']['sum_money']=$sum_money_add;
                $sum['output'][$key1]['children']['增值税及附加']['difference']=$sum_money_add-$sum_sum_add;
            }
        }*/
        $data['sum']=$sum;
        return $data;
    }

    /**
     * @author zhukeqin
     * @param $year
     * @return array
     * 获取全部分公司汇总
     */
    public function get_excel_log_sum_all_company($year){
        //设定搜索条件
        if(empty($year)){
            $year=date('Y');
        }
        $data=array();
        $company_list=D('Department')->get_department_list(array('deptname'=>array('like','%分公司%'),'budget_type'=>1));
        $cache=array();
        $sum_sum_add=0;//增值税单独处理
        $sum_money_add=0;
        foreach ($company_list as $value){
            //$list=$this->get_excel_log_sum('','',$value['id'],$year);
            $list=$this->get_excel_log_sum_company($value['id'],$year,'1')['sum'];
            $list['village_name']=$value['deptname'];
            $data['list'][]=$list;
            $cache[]=$value['id'];
            foreach ($list['output'] as $key2=>$value2){
                if($value2['type_name']=='增值税及附加'){
                    $sum_sum_add +=$value2['sum_sum'];
                    $sum_money_add +=$value2['sum_money'];
                    break;
                }
            }
        }
        $sum=$this->get_excel_log_sum('','',array('IN',$cache),$year);
        foreach ($sum['output'] as $key1=>$value1){
            if($value1['type_name']=='增值税及附加'){
                $now_sum_sum=$sum['output'][$key1]['sum_sum'];
                $now_sum_money=$sum['output'][$key1]['sum_money'];
                $sum['output']['sum_sum'] =$sum['output']['sum_sum']-$now_sum_sum+$sum_sum_add;
                $sum['output']['sum_money'] =$sum['output']['sum_money']-$now_sum_money+$sum_money_add;
                $sum['output']['difference']=$sum['output']['sum_money']-$sum['output']['sum_sum'];
                $sum['sum']['sum_sum']=$sum['input']['sum_sum']-$sum['output']['sum_sum'];
                $sum['sum']['sum_money']=$sum['input']['sum_money']-$sum['output']['sum_money'];
                $sum['sum']['difference']=$sum['sum_money']-$sum['sum_sum'];
                $sum['output'][$key1]['sum_sum']=$sum_sum_add;
                $sum['output'][$key1]['sum_money']=$sum_money_add;
                $sum['output'][$key1]['difference']=$sum_money_add-$sum_sum_add;
                $sum['output'][$key1]['children']['增值税及附加']['sum_sum']=$sum_sum_add;
                $sum['output'][$key1]['children']['增值税及附加']['sum_money']=$sum_money_add;
                $sum['output'][$key1]['children']['增值税及附加']['difference']=$sum_money_add-$sum_sum_add;
            }
        }
        $data['sum']=$sum;
        return $data;
    }

    /**
     * @author zhukeqin
     * @param $year
     * @return array
     * 设置全部公司的
     */
    public function get_excel_log_sum_all($year){
        //设定搜索条件
        if(empty($year)){
            $year=date('Y');
        }
        $data=array();
        $company_info=D('Department')->get_department_one(array('deptname'=>array('like','%汇得行总部%'),'budget_type'=>1));
        if(empty($company_info)){
            $company_info['id']='all';
        }
        $data['list']['0']=$this->get_excel_log_sum_company($company_info['id'],$year,'1')['sum'];
        $data['list']['0']['village_name']='集团各中心';
        $company_list=D('Department')->get_department_list(array('deptname'=>array('like','%分公司%'),'budget_type'=>1));
        $cache=array();
        foreach ($company_list as $value){
            $cache[]=$value['id'];
        }
        if(empty($cache)){
            $cache=array('all');
        }
        $data['list']['1']=$this->get_excel_log_sum_company(array('IN',$cache),$year,'1')['sum'];
        $data['list']['1']['village_name']='各分公司合计';
        $company_info=D('Department')->get_department_one(array('deptname'=>array('like','%邻钱网络科技%'),'budget_type'=>1));
        if(empty($company_info)){
            $company_info['id']='all';
        }
        $data['list']['2']=$this->get_excel_log_sum_company($company_info['id'],$year,'1')['sum'];
        $data['list']['2']['village_name']='邻钱网络';
        $company_list=D('Department')->get_department_list(array('budget_type'=>1));
        $cache=array();
        foreach ($company_list as $value){
            $cache[]=$value['id'];
        }
        if(empty($cache)){
            $cache=array('all');
        }
        $sum=$this->get_excel_log_sum_company(array('IN',$cache),$year)['sum'];
        $data['sum']=$sum;
        return $data;
    }

    /**
     * @author zhukeqin
     * @param $type_id
     * @param $village_id
     * @param $project_id
     * @param $company_id
     * @param $year
     * @return array|string
     * 获取单条类型输出
     */
    public function get_excel_type_one($type_id,$village_id,$project_id,$company_id,$year){
        $type_info=D('Budget_type')->get_type_one(array('type_id'=>$type_id));
        /*if($type_info['type_rank']!=3){
            return "当前类目不允许导出";
        }*/
        //当所需导出类目不为三级类目时
        $type_list=array();
        if($type_info['type_rank']==1){
            $type_list_second=D('Budget_type')->get_type_list(array('type_fid'=>$type_id));
            foreach ($type_list_second as $k=>$v){
                $type_list_third=D('Budget_type')->get_type_list(array('type_fid'=>$v['type_id']));
                foreach ($type_list_third as $k1=>$v1){
                    $type_list[]=$v1['type_id'];
                }
            }
            $type_id=array('IN',$type_list);
        }elseif($type_info['type_rank']==2){
            $type_list_third=D('Budget_type')->get_type_list(array('type_fid'=>$type_id));
            foreach ($type_list_third as $k1=>$v1){
                $type_list[]=$v1['type_id'];
            }
            $type_id=array('IN',$type_list);
        }
        //设定搜索条件
        if(empty($year)){
            $year=date('Y');
        }
        $where['year']=$year;
        $where['type_id']=$type_id;
        if($company_id){
            $where['company_id']=$company_id;
        }elseif($village_id){
            $where['village_id']=$village_id;
            if(!empty($project_id)){
                $where['project_id']=$project_id;
            }
        }
        $log_list=$this->get_log_list($where);
        $return=array();
        foreach ($log_list as $value){
            $cache=unserialize($value['log_data']);
            foreach ($cache as $key1=>$value1){
                $return[$key1] +=$value1;
            }
        }
        return $return;
    }

    /**
     * @author zhukeqin
     * @param $village_id
     * @param $project_id
     * @param $year
     * 按项目表格导出
     */
    public function output_log_village($village_id,$project_id,$year){
        if(empty($year)) $year=date('Y');
        $village_info=M('house_village')->where(array('village_id'=>$village_id))->find();
        //表头设定
        $title=$village_info['village_name'];
        $project_list=M('house_village_project')->where(array('village_id'=>$village_id))->select();
        if(count($project_list)>1&&!empty($project_id)) $title .='-'.M('house_village_project')->where(array('pigcms_id'=>$project_id))->find()['desc'];
        //文件名设定
        $file_name=$title;
        if(!empty($village_info['group_id'])){
            switch ($village_info['group_id']){
                case '1': $file_name ='汇得行'.$file_name;break;
                case '2': $file_name ='靓江物业'.$file_name;break;
            }
        }
        $company_id=$village_info['department_id'];
        //导出合计
        $data_sum=$this->get_excel_log_sum($village_id,$project_id,$company_id,$year);
        //dump($data_sum);die;
        //set_time_limit(0);
        import('@.ORG.phpexcel.PHPExcel');
        $phpexcel = new PHPExcel();
        //设置基本信息
        $phpexcel->getProperties()->setCreator("admin")
            ->setLastModifiedBy(session('system.account'))
            ->setTitle($year.'年'.$file_name.'预算执行')
            ->setSubject("预算执行")
            ->setDescription("")
            ->setKeywords("预算执行")
            ->setCategory("");
        $phpexcel->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpexcel->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        //执行主表页面
        $phpexcel->setActiveSheetIndex(0);
        //设置默认行高
        $phpexcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(26);

        $phpexcel->getActiveSheet()->setTitle('执行主表');
        $phpexcel->getActiveSheet()->setCellValue('A1', $year.'年预算编制汇总表');
        $phpexcel->getActiveSheet()->setCellValue('A2', '编制单位:'.$title);
        $phpexcel->getActiveSheet()->setCellValue('G2', '金额：元');
        //合并单元格
        $phpexcel->getActiveSheet()->mergeCells('A1:G1');
        $phpexcel->getActiveSheet()->mergeCells('A2:E2');
        //设置表头
        $phpexcel->getActiveSheet()->setCellValue('A3', '序号');
        $phpexcel->getActiveSheet()->getStyle('A3')->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('B3', '预算项目');
        $phpexcel->getActiveSheet()->getStyle('B3')->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->mergeCells('B3:C3');
        $phpexcel->getActiveSheet()->setCellValue('D3', '预算金额');
        $phpexcel->getActiveSheet()->getStyle('D3')->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('D3')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('E3', '执行金额');
        $phpexcel->getActiveSheet()->getStyle('E3')->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('E3')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('F3', '两者差异');
        $phpexcel->getActiveSheet()->getStyle('F3')->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('F3')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('G3', '编制说明');
        $phpexcel->getActiveSheet()->getStyle('G3')->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('G3')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->getColumnDimension('G3')->setAutoSize(true);

        //设置字体样式
        $phpexcel->getActiveSheet()->getStyle('A1')->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
        $phpexcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        //设置列宽
        $phpexcel->getActiveSheet()->getColumnDimension('B')->setWidth(17);
        $phpexcel->getActiveSheet()->getColumnDimension('C')->setWidth(17);
        $phpexcel->getActiveSheet()->getColumnDimension('D')->setWidth(28);
        $phpexcel->getActiveSheet()->getColumnDimension('E')->setWidth(28);
        $phpexcel->getActiveSheet()->getColumnDimension('F')->setWidth(28);
        $phpexcel->getActiveSheet()->getColumnDimension('G')->setWidth(37.5);

        //收入合计
        $phpexcel->getActiveSheet()->setCellValue('A4', '一');
        $phpexcel->getActiveSheet()->getStyle('A4')->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('A4')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('B4','收入合计');
        $phpexcel->getActiveSheet()->getStyle('B4')->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('B4')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->mergeCells('B4:C4');
        $phpexcel->getActiveSheet()->setCellValue('D4', number_format($data_sum['input']['sum_money'],2));
        $phpexcel->getActiveSheet()->getStyle('D4')->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('D4')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('E4', number_format($data_sum['input']['sum_sum'],2));
        $phpexcel->getActiveSheet()->getStyle('E4')->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('E4')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('F4',number_format($data_sum['input']['difference'],2));
        $phpexcel->getActiveSheet()->getStyle('F4')->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('F4')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('G4', '含税金额');
        $phpexcel->getActiveSheet()->getStyle('G4')->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('G4')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->getColumnDimension('G4')->setAutoSize(true);
        $phpexcel->getActiveSheet()->getStyle('A4:G4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('ccffff');
        //收入具体金额
        $low=5;//当前行数
        $i=1;//当前循环计数
        foreach ($data_sum['input']['1']['children'] as $value){
            $phpexcel->getActiveSheet()->setCellValue('A'.$low,$i);
            $phpexcel->getActiveSheet()->setCellValue('B'.$low,$value['type_name']);
            $phpexcel->getActiveSheet()->mergeCells('B'.$low.':C'.$low);
            $phpexcel->getActiveSheet()->setCellValue('D'.$low,number_format($value['sum_money'],2));
            $phpexcel->getActiveSheet()->setCellValue('E'.$low,number_format($value['sum_sum'],2));
            $phpexcel->getActiveSheet()->setCellValue('F'.$low,number_format($value['difference'],2));
            $phpexcel->getActiveSheet()->setCellValue('G'.$low,$value['type_remark']);
            $phpexcel->getActiveSheet()->getStyle('G'.$low)->getAlignment()->setWrapText(true);//??
            $i++;
            $low++;
        }
        //支出合计
        $low=$i+4;
        $phpexcel->getActiveSheet()->setCellValue('A'.$low, '二');
        $phpexcel->getActiveSheet()->getStyle('A'.$low)->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('A'.$low)->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('B'.$low,'支出合计');
        $phpexcel->getActiveSheet()->getStyle('B'.$low)->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('B'.$low)->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->mergeCells('B'.$low.':C'.$low);
        $phpexcel->getActiveSheet()->setCellValue('D'.$low, number_format($data_sum['output']['sum_money'],2));
        $phpexcel->getActiveSheet()->getStyle('D'.$low)->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('D'.$low)->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('E'.$low, number_format($data_sum['output']['sum_sum'],2));
        $phpexcel->getActiveSheet()->getStyle('E'.$low)->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('E'.$low)->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('F'.$low,number_format($data_sum['output']['difference'],2));
        $phpexcel->getActiveSheet()->getStyle('F'.$low)->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('F'.$low)->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('G'.$low, '含税金额');
        $phpexcel->getActiveSheet()->getStyle('G'.$low)->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('G'.$low)->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->getColumnDimension('G'.$low)->setAutoSize(true);
        $phpexcel->getActiveSheet()->getStyle('A'.$low.':G'.$low)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('ccffff');
        $low++;//当前行数
        $i=1;//当前循环计数
        foreach ($data_sum['output'] as $value){
            if(is_array($value)){
                $phpexcel->getActiveSheet()->setCellValue('A'.$low,$i);
                $phpexcel->getActiveSheet()->setCellValue('B'.$low,$value['type_name']);
                $start=$low;//记录起始行数
                foreach ($value['children'] as $key1=>$value1){
                    $phpexcel->getActiveSheet()->setCellValue('C'.$low,$value1['type_name']);
                    $phpexcel->getActiveSheet()->setCellValue('D'.$low,number_format($value1['sum_money'],2));
                    $phpexcel->getActiveSheet()->setCellValue('E'.$low,number_format($value1['sum_sum'],2));
                    $phpexcel->getActiveSheet()->setCellValue('F'.$low,number_format($value1['difference'],2));
                    $phpexcel->getActiveSheet()->setCellValue('G'.$low,$value1['type_remark']);
                    $phpexcel->getActiveSheet()->getStyle('G'.$low)->getAlignment()->setWrapText(true);
                    $low++;
                }
                $phpexcel->getActiveSheet()->setCellValue('C'.$low,'小计');
                $phpexcel->getActiveSheet()->setCellValue('D'.$low,number_format($value['sum_money'],2));
                $phpexcel->getActiveSheet()->setCellValue('E'.$low,number_format($value['sum_sum'],2));
                $phpexcel->getActiveSheet()->setCellValue('F'.$low,number_format($value['difference'],2));
                //合并单元格
                $phpexcel->getActiveSheet()->mergeCells('A'.$start.':A'.$low);
                $phpexcel->getActiveSheet()->mergeCells('B'.$start.':B'.$low);
                $i++;
                $low++;
            }
        }
        //净收支合计
        //收入合计
        $phpexcel->getActiveSheet()->setCellValue('A'.$low, '三');
        $phpexcel->getActiveSheet()->getStyle('A'.$low)->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('A'.$low)->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('B'.$low,'净收支');
        $phpexcel->getActiveSheet()->getStyle('B'.$low)->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('B'.$low)->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->mergeCells('B'.$low.':C'.$low);
        $phpexcel->getActiveSheet()->setCellValue('D'.$low, number_format($data_sum['sum']['sum_money'],2));
        $phpexcel->getActiveSheet()->getStyle('D'.$low)->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('D'.$low)->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('E'.$low, number_format($data_sum['sum']['sum_sum'],2));
        $phpexcel->getActiveSheet()->getStyle('E'.$low)->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('E'.$low)->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('F'.$low,number_format($data_sum['sum']['difference'],2));
        $phpexcel->getActiveSheet()->getStyle('F'.$low)->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('F'.$low)->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('G'.$low, '含税金额');
        $phpexcel->getActiveSheet()->getStyle('G'.$low)->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('G'.$low)->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->getColumnDimension('G'.$low)->setAutoSize(true);
        $phpexcel->getActiveSheet()->getStyle('A'.$low)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('ccffff');
        //设置边框样式
        $phpexcel->getActiveSheet()->getStyle('A3:G'.$low)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);

        //各类型综合
        //获取全部一级类型
        $type_first_list=D('Budget_type')->get_type_list(array('type_fid'=>0,'company_id'=>$company_id));
        foreach ($type_first_list as $key=>$value){
            $data_type=$this->get_excel_log_type($value['type_id'],$village_id,$project_id,$company_id,$year);
            $phpexcel->createSheet();//新建一个页面
            $phpexcel->setActiveSheetIndex($key+1);
            //设置默认行高
            $phpexcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(25);

            $phpexcel->getActiveSheet()->setTitle($value['type_name']);
            $phpexcel->getActiveSheet()->setCellValue('A1', $year.'年'.$value['type_name'].'明细表');
            $phpexcel->getActiveSheet()->setCellValue('A2', '编制单位:'.$title);
            $phpexcel->getActiveSheet()->setCellValue('Q2', '金额：元');
            //合并单元格
            $phpexcel->getActiveSheet()->mergeCells('A1:Q1');
            $phpexcel->getActiveSheet()->mergeCells('A2:E2');
            //插入表头
            //设置表头
            $phpexcel->getActiveSheet()->setCellValue('A3', '项目');
            $phpexcel->getActiveSheet()->getStyle('A3')->getFont()->setName('宋体');
            $phpexcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
            $phpexcel->getActiveSheet()->mergeCells('A3:B4');
            $phpexcel->getActiveSheet()->setCellValue('C3', '预算金额');
            $phpexcel->getActiveSheet()->getStyle('C3')->getFont()->setName('宋体');
            $phpexcel->getActiveSheet()->getStyle('C3')->getFont()->setBold(true);
            $phpexcel->getActiveSheet()->mergeCells('C3:C4');
            $phpexcel->getActiveSheet()->setCellValue('D3', $year.'年执行情况');
            $phpexcel->getActiveSheet()->getStyle('D3')->getFont()->setName('宋体');
            $phpexcel->getActiveSheet()->getStyle('D3')->getFont()->setBold(true);
            $phpexcel->getActiveSheet()->mergeCells('D3:P3');
            $phpexcel->getActiveSheet()->setCellValue('D4', '合计');
            $phpexcel->getActiveSheet()->getStyle('D4')->getFont()->setName('宋体');
            $phpexcel->getActiveSheet()->getStyle('D4')->getFont()->setBold(true);

            //设置字体样式
            $phpexcel->getActiveSheet()->getStyle('A1')->getFont()->setName('宋体');
            $phpexcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
            $phpexcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            //设置列宽
            $phpexcel->getActiveSheet()->getColumnDimension('A')->setWidth(14.5);
            $phpexcel->getActiveSheet()->getColumnDimension('B')->setWidth(14.5);
            $phpexcel->getActiveSheet()->getColumnDimension('C')->setWidth(14.5);
            $phpexcel->getActiveSheet()->getColumnDimension('D')->setWidth(14.5);
            for ($i=1;$i<=12;$i++){
                $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($i+3).'4', $i.'月');
                $phpexcel->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($i+3).'4')->getFont()->setName('宋体');
                $phpexcel->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($i+3).'4')->getFont()->setBold(true);
                $phpexcel->getActiveSheet()->getColumnDimension(PHPExcel_Cell::stringFromColumnIndex($i+3))->setWidth(14.5);
            }
            $phpexcel->getActiveSheet()->getColumnDimension('Q')->setWidth(40);
            $low=5;
            foreach ($data_type as $key1=>$value1){
                if($key1!=='sum'){
                    $start=$low;
                    $phpexcel->getActiveSheet()->setCellValue('A'.$low,$value1['type_name']);
                    foreach ($value1['children'] as $key2=>$value2){
                        $phpexcel->getActiveSheet()->setCellValue('B'.$low, $value2['type_name']);
                        $phpexcel->getActiveSheet()->setCellValue('C'.$low, number_format($value2['type_data']['money_sum'],2));
                        $phpexcel->getActiveSheet()->setCellValue('D'.$low, number_format($value2['type_data']['sum'],2));
                        for ($i=1;$i<=12;$i++){
                            $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($i+3).$low, number_format($value2['type_data'][$i],2));
                        }
                        $phpexcel->getActiveSheet()->setCellValue('Q'.$low, $value2['type_remark']);
                        $phpexcel->getActiveSheet()->getStyle('Q'.$low)->getAlignment()->setWrapText(true);

                        $low++;
                    }
                    $phpexcel->getActiveSheet()->setCellValue('B'.$low, '小计');
                    $phpexcel->getActiveSheet()->setCellValue('C'.$low, number_format($value1['sum']['sum_money'],2));
                    $phpexcel->getActiveSheet()->setCellValue('D'.$low, number_format($value1['sum']['sum_sum'],2));
                    for ($i=1;$i<=12;$i++){
                        $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($i+3).$low, number_format($value1['sum'][$i],2));
                    }
                    $phpexcel->getActiveSheet()->getStyle('A'.$low.':Q'.$low)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('ccffff');
                    $phpexcel->getActiveSheet()->mergeCells('A'.$start.':A'.$low);
                    $low++;
                }/*else{
                    $phpexcel->getActiveSheet()->setCellValue('A'.$low,'合计');

                    $phpexcel->getActiveSheet()->setCellValue('C'.$low, number_format($value1['sum_money'],2));
                    $phpexcel->getActiveSheet()->setCellValue('D'.$low, number_format($value1['sum_sum'],2));
                    for ($i=1;$i<=12;$i++){
                        $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($i+3).$low, number_format($value1[$i],2));
                    }
                    $phpexcel->getActiveSheet()->getStyle('A'.$low)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('ccffff');
                }*/
            }
            $phpexcel->getActiveSheet()->setCellValue('A'.$low,'合计');

            $phpexcel->getActiveSheet()->setCellValue('C'.$low, number_format($data_type['sum']['sum_money'],2));
            $phpexcel->getActiveSheet()->setCellValue('D'.$low, number_format($data_type['sum']['sum_sum'],2));
            for ($i=1;$i<=12;$i++){
                $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($i+3).$low, number_format($data_type['sum'][$i],2));
            }
            $phpexcel->getActiveSheet()->getStyle('A'.$low.':Q'.$low)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('ccffff');
            $phpexcel->getActiveSheet()->getStyle('A3:Q'.$low)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
        }
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=".$year."年".$file_name."预算执行.xls");
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
     * @param $list
     * @param $village_id
     * 导出业主excel表
     */
    public function excel_log_village($list,$village_id)
    {
        //dump($list);die;
        $name = M('house_village')->where(array('village_id'=>$village_id))->find()['village_name'];
        import('@.ORG.phpexcel.PHPExcel');
        $phpexcel = new PHPExcel();
        //设置基本信息
        $phpexcel->getProperties()->setCreator("admin")
            ->setLastModifiedBy(session('system.account'))
            ->setTitle("业主信息")
            ->setSubject("业主信息")
            ->setDescription("")
            ->setKeywords("业主信息")
            ->setCategory("");
        $phpexcel->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpexcel->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        //执行主表页面
        $phpexcel->setActiveSheetIndex(0);
        //设置默认行高
        $phpexcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(40);
        $phpexcel->getActiveSheet()->setTitle('执行主表');
        $phpexcel->getActiveSheet()->setCellValue('A1', '门牌号');
        $phpexcel->getActiveSheet()->setCellValue('B1', '面积');
        $phpexcel->getActiveSheet()->setCellValue('C1', '业主姓名');
        $phpexcel->getActiveSheet()->setCellValue('D1', '身份证号');
        $phpexcel->getActiveSheet()->setCellValue('E1', '联系电话');
        $phpexcel->getActiveSheet()->setCellValue('F1', '入伙日期');
        $phpexcel->getActiveSheet()->setCellValue('G1', '房屋质量问题');
        $phpexcel->getActiveSheet()->setCellValue('H1', '处理结果');
        $phpexcel->getActiveSheet()->setCellValue('I1', '装修开始时间');
        $phpexcel->getActiveSheet()->setCellValue('J1', '装修结束时间');
        $phpexcel->getActiveSheet()->setCellValue('K1', '违规内容');
        $phpexcel->getActiveSheet()->setCellValue('L1', '是否整改(0为否 1为是)');
        $phpexcel->getActiveSheet()->setCellValue('M1', '第一次验收时间');
        $phpexcel->getActiveSheet()->setCellValue('N1', '第二次验收时间');
        $phpexcel->getActiveSheet()->setCellValue('O1', '押金情况(0为未退还 1为已退还)');
        $phpexcel->getActiveSheet()->setCellValue('P1', '房屋状态(0为空置 1为出租 2为自住)');
        $phpexcel->getActiveSheet()->setCellValue('Q1', '物业费到期时间');
        $phpexcel->getActiveSheet()->setCellValue('R1', '车位号');
        $phpexcel->getActiveSheet()->setCellValue('S1', '车牌号');
        $phpexcel->getActiveSheet()->setCellValue('T1', '泊位费时间');
        $phpexcel->getActiveSheet()->setCellValue('U1', '泊位费用');
        $phpexcel->getActiveSheet()->setCellValue('V1', '物业费单价(不填则按0处理)');
        //设置列宽
        foreach(range('A','V') as $v){
            $phpexcel->getActiveSheet()->getColumnDimension($v)->setWidth(28);
        }
        $low=2;//当前行数
        foreach ($list as $value){
            $phpexcel->getActiveSheet()->setCellValue('A'.$low,$value['room_name']);
            $phpexcel->getActiveSheet()->setCellValue('B'.$low,$value['roomsize']);
            $phpexcel->getActiveSheet()->setCellValue('C'.$low ,$value['name']."\t");
            $phpexcel->getActiveSheet()->setCellValue('D'.$low,$value['usernum']);
            $phpexcel->getActiveSheet()->setCellValue('E'.$low,$value['phone']);
            $phpexcel->getActiveSheet()->setCellValue('F'.$low,$value['addtime']);
            $phpexcel->getActiveSheet()->setCellValue('G'.$low,$value['house_program']);
            $phpexcel->getActiveSheet()->setCellValue('H'.$low,$value['house_return']);
            $phpexcel->getActiveSheet()->setCellValue('I'.$low,$value['fixhouse_start']);
            $phpexcel->getActiveSheet()->setCellValue('J'.$low,$value['fixhouse_end']);
            $phpexcel->getActiveSheet()->setCellValue('K'.$low,$value['house_error']);
            $phpexcel->getActiveSheet()->setCellValue('L'.$low,$value['house_abarbeitung']);
            $phpexcel->getActiveSheet()->setCellValue('M'.$low,$value['checktime']);
            $phpexcel->getActiveSheet()->setCellValue('N'.$low,$value['checktime_second']);
            $phpexcel->getActiveSheet()->setCellValue('O'.$low,$value['cash_type']);
            $phpexcel->getActiveSheet()->setCellValue('P'.$low,$value['house_type']);
            $phpexcel->getActiveSheet()->setCellValue('Q'.$low,$value['property_endtime']);
            $phpexcel->getActiveSheet()->setCellValue('R'.$low,$value['carspace_number']);
            $phpexcel->getActiveSheet()->setCellValue('S'.$low,$value['car_number']);
            $phpexcel->getActiveSheet()->setCellValue('T'.$low,$value['carspace_start']."-".$value['carspace_end']);
            $phpexcel->getActiveSheet()->setCellValue('U'.$low,$value['carspace_price']);
            $phpexcel->getActiveSheet()->setCellValue('V'.$low,$value['property_unit']);
            $low++;
        }
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=".$name.$list[0]['desc']."业主信息.xls");
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
     * @param $company_id
     * @param $year
     * 按公司类型表格输出
     */
    public function output_log_company($company_id,$year){
        if(empty($year)) $year=date('Y');
        if($company_id=='all_company'){
            $data=$this->get_excel_log_sum_all_company($year);
            $file_name='各分公司预算执行汇总表';
            $title='汇得行集团';
        }elseif($company_id=='all'){
            $data=$this->get_excel_log_sum_all($year);
            $file_name='集团预算执行汇总表';
            $title='汇得行集团';
        }else{
            $data=$this->get_excel_log_sum_company($company_id,$year);
            $title=D('Department')->get_department_one(array('id'=>$company_id))['deptname'];
            $file_name=$year.'年'.$title.'汇总表';
        }
        $sum=$data['sum'];
        $data=$data['list'];
        import('@.ORG.phpexcel.PHPExcel');
        $max_col=PHPExcel_Cell::stringFromColumnIndex(count($data)*2+4);
        $phpexcel = new PHPExcel();
        //设置基本信息
        $phpexcel->getProperties()->setCreator("admin")
            ->setLastModifiedBy(session('system.account'))
            ->setTitle($file_name)
            ->setSubject("汇总表")
            ->setDescription("")
            ->setKeywords("汇总表")
            ->setCategory("");
        $phpexcel->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpexcel->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        //执行主表页面
        $phpexcel->setActiveSheetIndex(0);
        //设置默认行高
        $phpexcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(26);

        $phpexcel->getActiveSheet()->setTitle('汇总表');
        $phpexcel->getActiveSheet()->setCellValue('A1', $year.'年预算编制汇总表');
        $phpexcel->getActiveSheet()->setCellValue('A2', '编制单位:'.$title);
        $phpexcel->getActiveSheet()->setCellValue($max_col.'2', '金额：元');
        //合并单元格
        $phpexcel->getActiveSheet()->mergeCells('A1:'.$max_col.'1');
        $phpexcel->getActiveSheet()->mergeCells('A2:E2');
        //设置表头
        $phpexcel->getActiveSheet()->setCellValue('A3', '序号');
        $phpexcel->getActiveSheet()->getStyle('A3')->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->mergeCells('A3:A4');
        $phpexcel->getActiveSheet()->setCellValue('B3', '预算项目');
        $phpexcel->getActiveSheet()->getStyle('B3')->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->mergeCells('B3:C4');
        $phpexcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        $phpexcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $phpexcel->getActiveSheet()->setCellValue('D3', '合计');
        $phpexcel->getActiveSheet()->getStyle('D3')->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('D3')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->mergeCells('D3:E3');
        $phpexcel->getActiveSheet()->setCellValue('D4', '预算合计');
        $phpexcel->getActiveSheet()->getStyle('D4')->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('D4')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('E4', '执行合计');
        $phpexcel->getActiveSheet()->getStyle('E4')->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('E4')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->getColumnDimension('D')->setWidth(17);
        $phpexcel->getActiveSheet()->getColumnDimension('E')->setWidth(17);
        $i=0;
        foreach ($data as $value){
            $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($i+5).'3', $value['village_name']);
            $phpexcel->getActiveSheet()->mergeCells(PHPExcel_Cell::stringFromColumnIndex($i+5).'3:'.PHPExcel_Cell::stringFromColumnIndex($i+6).'3');
            $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($i+5).'4', '预算合计');
            $phpexcel->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($i+5).'4')->getFont()->setName('宋体');
            $phpexcel->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($i+5).'4')->getFont()->setBold(true);
            $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($i+6).'4', '执行合计');
            $phpexcel->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($i+6).'4')->getFont()->setName('宋体');
            $phpexcel->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($i+6).'4')->getFont()->setBold(true);
            $phpexcel->getActiveSheet()->getColumnDimension(PHPExcel_Cell::stringFromColumnIndex($i+5))->setWidth(17);
            $phpexcel->getActiveSheet()->getColumnDimension(PHPExcel_Cell::stringFromColumnIndex($i+6))->setWidth(17);
            $i +=2;
        }

        //设置字体样式
        $phpexcel->getActiveSheet()->getStyle('A1')->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
        $phpexcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

        //收入合计
        $phpexcel->getActiveSheet()->setCellValue('A5', '一');
        $phpexcel->getActiveSheet()->getStyle('A5')->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('A5')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('B5','收入合计');
        $phpexcel->getActiveSheet()->getStyle('B5')->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('B5')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->mergeCells('B5:C5');
        $phpexcel->getActiveSheet()->setCellValue('D5', number_format($sum['input']['sum_money'],2));
        $phpexcel->getActiveSheet()->getStyle('D5')->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('D5')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('E5', number_format($sum['input']['sum_sum'],2));
        $phpexcel->getActiveSheet()->getStyle('E5')->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('E5')->getFont()->setBold(true);
        $i=0;
        foreach ($data as $value){
            $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($i+5).'5', number_format($value['input']['sum_money'],2));
            $phpexcel->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($i+5).'5')->getFont()->setName('宋体');
            $phpexcel->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($i+5).'5')->getFont()->setBold(true);
            $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($i+6).'5', number_format($value['input']['sum_sum'],2));
            $phpexcel->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($i+6).'5')->getFont()->setName('宋体');
            $phpexcel->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($i+6).'5')->getFont()->setBold(true);
            $i +=2;
        }
        $phpexcel->getActiveSheet()->getStyle('A4:'.$max_col.'4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('ccffff');
        //收入具体金额
        $low=6;//当前行数
        $i=0;//当前循环计数
        foreach ($sum['input']['1']['children'] as $key=>$value){
            $phpexcel->getActiveSheet()->setCellValue('A'.$low,$i+1);
            $phpexcel->getActiveSheet()->setCellValue('B'.$low,$value['type_name']);
            $phpexcel->getActiveSheet()->mergeCells('B'.$low.':C'.$low);
            $phpexcel->getActiveSheet()->setCellValue('D'.$low,number_format($value['sum_money'],2));
            $phpexcel->getActiveSheet()->setCellValue('E'.$low,number_format($value['sum_sum'],2));
            $j=0;
            foreach ($data as $value1){
                $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($j+5).$low, number_format($value1['input']['1']['children'][$key]['sum_money'],2));
                $phpexcel->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($j+5).$low)->getFont()->setName('宋体');
                $phpexcel->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($j+5).$low)->getFont()->setBold(true);
                $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($j+6).$low, number_format($value1['input']['1']['children'][$key]['sum_sum'],2));
                $phpexcel->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($j+6).$low)->getFont()->setName('宋体');
                $phpexcel->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($j+6).$low)->getFont()->setBold(true);
                $j +=2;
            }
            $i++;
            $low++;
        }
        //支出合计
        $phpexcel->getActiveSheet()->setCellValue('A'.$low, '二');
        $phpexcel->getActiveSheet()->getStyle('A'.$low)->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('A'.$low)->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('B'.$low,'支出合计');
        $phpexcel->getActiveSheet()->getStyle('B'.$low)->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('B'.$low)->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->mergeCells('B'.$low.':C'.$low);
        $phpexcel->getActiveSheet()->setCellValue('D'.$low, number_format($sum['output']['sum_money'],2));
        $phpexcel->getActiveSheet()->getStyle('D'.$low)->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('D'.$low)->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('E'.$low, number_format($sum['output']['sum_sum'],2));
        $phpexcel->getActiveSheet()->getStyle('E'.$low)->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('E'.$low)->getFont()->setBold(true);
        $i=0;
        foreach ($data as $value){
            $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($i+5).$low, number_format($value['output']['sum_money'],2));
            $phpexcel->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($i+5).$low)->getFont()->setName('宋体');
            $phpexcel->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($i+5).$low)->getFont()->setBold(true);
            $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($i+6).$low, number_format($value['output']['sum_sum'],2));
            $phpexcel->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($i+6).$low)->getFont()->setName('宋体');
            $phpexcel->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($i+6).$low)->getFont()->setBold(true);
            $i +=2;
        }
        $phpexcel->getActiveSheet()->getStyle('A'.$low.':'.$max_col.$low)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('ccffff');
        $low++;//当前行数
        $i=0;//当前循环计数
        foreach ($sum['output'] as $key=>$value){
            if(is_array($value)){
                $phpexcel->getActiveSheet()->setCellValue('A'.$low,$i+1);
                $phpexcel->getActiveSheet()->setCellValue('B'.$low,$value['type_name']);
                $start=$low;//记录起始行数
                foreach ($value['children'] as $key1=>$value1){
                    $phpexcel->getActiveSheet()->setCellValue('C'.$low,$value1['type_name']);
                    $phpexcel->getActiveSheet()->setCellValue('D'.$low,number_format($value1['sum_money'],2));
                    $phpexcel->getActiveSheet()->setCellValue('E'.$low,number_format($value1['sum_sum'],2));
                    $j=0;
                    foreach ($data as $value2){
                        $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($j+5).$low, number_format($value2['output'][$key]['children'][$key1]['sum_money'],2));
                        $phpexcel->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($j+5).$low)->getFont()->setName('宋体');
                        $phpexcel->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($j+5).$low)->getFont()->setBold(true);
                        $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($j+6).$low, number_format($value2['output'][$key]['children'][$key1]['sum_sum'],2));
                        $phpexcel->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($j+6).$low)->getFont()->setName('宋体');
                        $phpexcel->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($j+6).$low)->getFont()->setBold(true);
                        $j +=2;
                    }
                    $low++;
                }
                $phpexcel->getActiveSheet()->setCellValue('C'.$low,'小计');
                $phpexcel->getActiveSheet()->setCellValue('D'.$low,number_format($value['sum_money'],2));
                $phpexcel->getActiveSheet()->setCellValue('E'.$low,number_format($value['sum_sum'],2));
                $j=0;
                foreach ($data as $value1){
                    $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($j+5).$low, number_format($value1['output'][$key]['sum_money'],2));
                    $phpexcel->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($j+5).$low)->getFont()->setName('宋体');
                    $phpexcel->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($j+5).$low)->getFont()->setBold(true);
                    $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($j+6).$low, number_format($value1['output'][$key]['sum_sum'],2));
                    $phpexcel->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($j+6).$low)->getFont()->setName('宋体');
                    $phpexcel->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($j+6).$low)->getFont()->setBold(true);
                    $j +=2;
                }
                //合并单元格
                $phpexcel->getActiveSheet()->mergeCells('A'.$start.':A'.$low);
                $phpexcel->getActiveSheet()->mergeCells('B'.$start.':B'.$low);
                $i++;
                $low++;
            }
        }
        //净收支合计
        //收入合计
        $phpexcel->getActiveSheet()->setCellValue('A'.$low, '三');
        $phpexcel->getActiveSheet()->getStyle('A'.$low)->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('A'.$low)->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('B'.$low,'净收支');
        $phpexcel->getActiveSheet()->getStyle('B'.$low)->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('B'.$low)->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->mergeCells('B'.$low.':C'.$low);
        $phpexcel->getActiveSheet()->setCellValue('D'.$low, number_format($sum['sum']['sum_money'],2));
        $phpexcel->getActiveSheet()->getStyle('D'.$low)->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('D'.$low)->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('E'.$low, number_format($sum['sum']['sum_sum'],2));
        $phpexcel->getActiveSheet()->getStyle('E'.$low)->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('E'.$low)->getFont()->setBold(true);
        $j=0;
        foreach ($data as $value){
            $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($j+5).$low, number_format($value['sum']['sum_money'],2));
            $phpexcel->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($j+5).$low)->getFont()->setName('宋体');
            $phpexcel->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($j+5).$low)->getFont()->setBold(true);
            $phpexcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($j+6).$low, number_format($value['sum']['sum_sum'],2));
            $phpexcel->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($j+6).$low)->getFont()->setName('宋体');
            $phpexcel->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($j+6).$low)->getFont()->setBold(true);
            $j +=2;
        }
        $phpexcel->getActiveSheet()->getStyle('A'.$low.':'.$max_col.$low)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('ccffff');
        //设置边框样式
        $phpexcel->getActiveSheet()->getStyle('A3:'.$max_col.$low)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);

        //审批签名
        $low +=2;//空一行
        $phpexcel->getActiveSheet()->setCellValue('A'.$low, '董事长：');
        $phpexcel->getActiveSheet()->getStyle('A'.$low)->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('A'.$low)->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->mergeCells('A'.$low.':B'.$low);
        $phpexcel->getActiveSheet()->setCellValue('D'.$low, '分管执行总裁:');
        $phpexcel->getActiveSheet()->getStyle('D'.$low)->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('D'.$low)->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('G'.$low, '法务审计中心副总裁：');
        $phpexcel->getActiveSheet()->getStyle('G'.$low)->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('G'.$low)->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('K'.$low, '财务证券中心预算会计：');
        $phpexcel->getActiveSheet()->getStyle('K'.$low)->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('K'.$low)->getFont()->setBold(true);
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=".$file_name.".xls");
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
}



?>