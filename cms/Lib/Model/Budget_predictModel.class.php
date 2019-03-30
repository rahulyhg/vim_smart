<?php
/**
 * Created by PhpStorm.
 * User: zhukeqin
 * Date: 2018/12/10
 * Time: 10:47
 */

class Budget_predictModel extends Model{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * @author zhukeqin
     * @param $where
     * @param string $order
     * @return mixed
     * 返回一条数据
     */
    public function get_predict_one($where,$order='predict_id desc'){
        $return=$this->where($where)->order($order)->find();
        $return['data']=unserialize($return['data']);
        $return['sum']=unserialize($return['sum']);
        return $return;
    }

    /**
     * @author zhukeqin
     * @param $where
     * @param string $order
     * @return mixed
     * 返回一组数据
     */
    public function get_predict_list($where,$order='predict_id desc'){
        $return=$this->where($where)->order($order)->select();
        return $return;
    }

    /**
     * @author zhukeqin
     * @param $data
     * @param $admin_id
     * @param $village_id
     * @param $project_id
     * @param $year
     * @param $predict_id
     * @return array
     * 插入/修改一条记录
     */
    public function change_predict_one($data,$admin_id,$village_id,$project_id,$year,$predict_id,$overtime_type='1'){
        $Budget_predict_logModel=new Budget_predict_logModel();
        $Budget_predict_configModel=new Budget_predict_configModel();
        if(!empty($predict_id)){
            $predict_info=$this->get_predict_one(array('predict_id'=>$predict_id));
            if(empty($predict_info)) return array('err'=>1,'data'=>'所需修改条目不存在');
            if($predict_info['status']==6) return array('err'=>1,'data'=>'该条目已经通过审核,无法修改');
        }
        $village_info=M('house_village')->where(array('village_id'=>$village_id))->find();
        if(empty($village_info['group_id'])) return array('err'=>1,'data'=>'请先设置该项目所属汇得行或靓江');
        $where=array('village_id'=>$village_id);
        if(!empty($project_id))$where['project_id']=$project_id;
        //月通信费设置
        if($village_info['department_id']==89){

        }else{
            $phone_fee=array(
                '1'=>array('项目经理'=>100,'village_id'=>array(2,3,4,14,47,48,49,50,51,52,53,82),'phone_fee'=>200),
                '2'=>array('经理'=>100,'主管'=>80,'领班'=>60),
                '3'=>array('经理'=>100,'主管'=>80,'领班'=>60),
                '4'=>array('经理'=>100,'主管'=>80,'班长'=>60),
            );
        }
        //获取物业费配置,如果没有则获取默认配置
        $proportion=$Budget_predict_configModel->get_config_one('property','',$village_id,$project_id);
        if(empty($proportion)){
            $proportion=array(
                '1'=>array('last'=>'95','now'=>'95'),
                '2'=>array('last'=>'70','now'=>'90'),
            );
        }
        //获取社保配置，如果没有则获取默认配置
        $social_security=$Budget_predict_configModel->get_config_one('social_security','',$village_id,$project_id)['config_num'];
        if(empty($social_security)){
            if($village_info['group_id']==1){//汇得行
                $social_security=985.89;
            }else{//靓江
                $social_security=981.81;
            }
        }
        if($village_id==51) $social_security_boss=1152;

        //最低工资
        $minimum_wage=$village_id==76?1380:1750;

        $predict_data=array();
        $sum=array();
        //循环获取各个类目
        foreach ($data as $key=>$value){
            $sum_cache=array();
            //人员支出处理
            if($key==1){
                foreach($value as $key1=>$value1){
                    $sum_cache1=array();
                    foreach ($value1 as $key2=>$value2){
                        $sum_cache2=array();
                        if(!empty($value2['job'])){
                            if(empty($value2['month'])) $value2['month']=$data[$key][$key1][$key2]['month']=12;
                            $value2['month_0']=$this->get_number($value2['month_0']);//提取数字
                            //年终奖判定
                            if($key1==12){
                                //当为其它部门时，不做处理
                            }elseif($village_info['department_id']=='87'||$village_info['department_id']=='88'||$village_id==14||$village_id==49){
                                //第九第十分公司不同处理
                                if($value2['job']=='项目经理'||$value2['job']=='经理'||$value2['job']=='主管'){
                                    $value2['year_end']=$data[$key][$key1][$key2]['year_end']=$value2['month_0'];
                                }else{
                                    if($key1=='4'){
                                        $value2['year_end']=$data[$key][$key1][$key2]['year_end']=$value2['month_0']*0.6;
                                    }elseif($key1=='8'&&$village_id==49){//武汉市人民政府的保洁部 年终奖为0.6
                                        $value2['year_end']=$data[$key][$key1][$key2]['year_end']=$value2['month_0']*0.6;
                                    }else{
                                        $value2['year_end']=$data[$key][$key1][$key2]['year_end']=$value2['month_0']*0.8;
                                    }
                                }
                                /*if($value2['year_end']<$minimum_wage){
                                    $value2['year_end']=$data[$key][$key1][$key2]['year_end']=$minimum_wage;
                                }*/
                            }elseif($village_info['department_id']=='89'){
                                //邻钱科技和武汉市人民政府按一个月计算
                                $value2['year_end']=$data[$key][$key1][$key2]['year_end']=$value2['month_0'];
                            }elseif($village_id==33){
                                $value2['year_end']=$data[$key][$key1][$key2]['year_end']=0;
                            }else{
                                switch ($value2['job']){
                                    case '项目经理':$value2['year_end']=$data[$key][$key1][$key2]['year_end']=$value2['month_0'];break;
                                    case '经理':$value2['year_end']=$data[$key][$key1][$key2]['year_end']='1000';break;
                                    case '主管':$value2['year_end']=$data[$key][$key1][$key2]['year_end']='1000';break;
                                    case '领班':$value2['year_end']=$data[$key][$key1][$key2]['year_end']='500';break;
                                    case '班长':$value2['year_end']=$data[$key][$key1][$key2]['year_end']='500';break;
                                    default:$value2['year_end']=$data[$key][$key1][$key2]['year_end']='300';break;
                                }
                            }
                            $value2['year_end']=$data[$key][$key1][$key2]['year_end']=$value2['year_end']*($value2['month']/12);//年终奖按照月份折算
                            if(empty($value2['year_end'])) $value2['year_end']=$data[$key][$key1][$key2]['year_end']=0;
                            if(!empty($value2['month_1'])){
                                if($key1==9){
                                    $value2['month_1']=$data[$key][$key1][$key2]['month_1']=$social_security_boss;
                                }else{
                                    $value2['month_1']=$data[$key][$key1][$key2]['month_1']=$social_security;
                                }
                            }
                            //邻钱工服费默认全部为70/人
                            if($village_id==70) {
                                $value2['clothes_fee']=70;
                            }else{
                                //其它项目工程和保洁部为35/人
                                $value2['clothes_fee']=$key1==3||$key1==8?35:70;
                            }

                            if($key1==12) unset($value2['clothes_fee']);//其它去掉服装费
                            if($village_id==33) unset($value2['clothes_fee']);//汉阳区检察院去掉服装费
                            $where_cache=$where;
                            $where_cache['config_type_id']='phone_fee';
                            $phone_fee_info=M('budget_predict_config')->where($where_cache)->find();
                            if($phone_fee_info){
                                $value2['month_4']=$data[$key][$key1][$key2]['month_4']=$phone_fee_info['config_num'];
                            }else{
                                if($key1==1&&in_array($village_id,$phone_fee[$key1]['village_id'])){
                                    $value2['month_4']=$data[$key][$key1][$key2]['month_4']=$phone_fee[$key1]['phone_fee'];
                                }else{
                                    $value2['month_4']=$data[$key][$key1][$key2]['month_4']=$phone_fee[$key1][$value2['job']];
                                }
                            }
                            $sum_cache2['clothes_fee']=$value2['clothes_fee']*$value2['month']*$value2['num'];
                            $sum_cache2['month_0']=$value2['month_0']*$value2['month']*$value2['num'];
                            $sum_cache2['month_1']=($value2['month_1']+$value2['month_8'])*$value2['month']*$value2['num'];
                            $sum_cache2['month_2']=$value2['month_2']*$value2['month']*$value2['num'];
                            $sum_cache2['month_other']=($value2['month_3']+$value2['month_4']+$value2['month_5']+$value2['month_6']+$value2['month_7'])*$value2['month']*$value2['num'];
                            $sum_cache2['year_end']=$value2['year_end']*$value2['num'];
                            foreach ($sum_cache2 as $key3=>$value3){
                                if($key3=='clothes_fee'){
                                    if(!empty($value2['clothes_fee'])){
                                        $data['clothesfee'][$key1][$key2]=array('job'=>$value2['job'],'num'=>$value2['num'],'price'=>$value2['clothes_fee'],'month'=>$value2['month']);
                                    }
                                    /*$sum_sum=$value2['clothes_fee']*$value2['num']*$value2['month'];
                                    $sum['clothesfee'][$key1][$key2]['clothesfee']=$sum_sum;
                                    $sum['clothesfee']['sum']['sum'] +=$sum_sum;
                                    $sum['clothesfee']['sum']['num'] +=$value2['num'];
                                    $data['2']['18']['children']['42']['type_data']['sum'] +=$sum_sum;
                                    $sum['2']['18']['42']['sum'] +=$sum_sum;
                                    $sum['2']['18']['sum'] +=$sum_sum;
                                    $sum['2']['sum']['sum'] +=$sum_sum;*/
                                }else{
                                    $sum_cache2['sum'] +=$value3;
                                    $sum_cache['sum'][$key3] +=$value3;
                                }
                            }
                            //商业保险费计算
                            $sum_sum=0;
                            if(empty($value2['month_1'])){
                                if($village_info['group_id']==1){
                                    $sum_sum=130*$value2['num'];
                                }else{
                                    $sum_sum=108*$value2['num'];
                                }
                            }

                            $data['2']['24']['children']['51']['type_data']['sum'] +=$sum_sum;
                            $sum['2']['24']['51']['sum'] +=$sum_sum;
                            $sum['2']['24']['sum'] +=$sum_sum;
                            $sum['2']['sum']['sum'] +=$sum_sum;
/*                            $sum_cache1['sum']['clothes_fee'] +=$sum_cache2['clothes_fee'];*/
                            $sum_cache1['sum']['num'] +=$value2['num'];
                            $sum_cache['sum']['sum'] +=$sum_cache2['sum'];
                            $sum_cache['sum']['num'] +=$value2['num'];
                        }else{
                            unset($data[$key][$key1][$key2]);
                        }
                        $sum_cache1[$key2]=$sum_cache2;
                    }
                    $sum_cache[$key1]=$sum_cache1;
                }
            }elseif($key=='dispatch'){//劳务外派处理
                foreach($value as $key1=>$value1){
                    $sum_cache1=array();
                    foreach ($value1 as $key2=>$value2){
                        $sum_cache2=array();
                        if(!empty($value2['job'])){
                            if(empty($value2['month'])) $value2['month']=$data[$key][$key1][$key2]['month']=12;

/*                            $sum_cache2['clothes_fee']=$value2['clothes_fee']*$value2['month']*$value2['num'];*/
                            $sum_cache2['month_0']=$value2['month_0']*$value2['month']*$value2['num'];
                            $sum_cache2['month_1']=($value2['month_1']+$value2['month_2']+$value2['month_6'])*$value2['month']*$value2['num'];
                            //$sum_cache2['month_2']=$value2['month_2']*$value2['month']*$value2['num'];
                            $sum_cache2['month_other']=($value2['month_3']+$value2['month_4'])*$value2['month']*$value2['num'];
                            $sum_cache2['month_5']=$value2['month_5']*$value2['month']*$value2['num'];
                            $sum_cache2['insurance']=$value2['insurance']*$value2['num'];
                            $sum_cache2['year_end']=$value2['year_end']*$value2['num'];
                            foreach ($sum_cache2 as $key3=>$value3){
                                $sum_cache2['sum'] +=$value3;
                                $sum_cache['sum'][$key3] +=$value3;
                            }
                            $sum_cache1['sum']['num'] +=$value2['num'];
                            $sum_cache['sum']['sum'] +=$sum_cache2['sum'];
                            $sum_cache['sum']['num'] +=$value2['num'];
                        }else{
                            unset($data[$key][$key1][$key2]);
                        }
                        $sum_cache1[$key2]=$sum_cache2;
                    }
                    $sum_cache[$key1]=$sum_cache1;
                }
                $data['3']['59']['children']['97']['type_data']['sum']=$sum_cache['sum']['sum'];
                $sum['3']['59']['97']['sum'] +=$sum_cache['sum']['sum'];
                $sum['3']['59']['sum'] +=$sum_cache['sum']['sum'];
                $sum['3']['sum']['sum'] +=$sum_cache['sum']['sum'];
            }elseif($key=='clothesfee'){//服装费
                $value=$data['clothesfee'];
                foreach($value as $key1=>$value1){
                    $sum_cache1=array();
                    foreach ($value1 as $key2=>$value2){
                        $sum_cache2=array();
                        if(!empty($value2['num'])){
                            if(empty($value2['month'])) $value2['month']=$data[$key][$key1][$key2]['month']=12;
                            $sum_cache2['clothesfee']=$value2['price']*$value2['num']*12;//$value2['month'] 工服费全部12个月
                            $sum_cache['sum']['sum'] +=$sum_cache2['clothesfee'];
                            $sum_cache['sum']['num'] +=$value2['num'];
                        }else{
                            unset($data[$key][$key1][$key2]);
                        }
                        $sum_cache1[$key2]=$sum_cache2;
                    }
                    $sum_cache[$key1]=$sum_cache1;
                }

                $data['2']['18']['children']['42']['type_data']['sum'] +=$sum_cache['sum']['sum'];
                $sum['2']['18']['42']['sum'] +=$sum_cache['sum']['sum'];
                $sum['2']['18']['sum'] +=$sum_cache['sum']['sum'];
                $sum['2']['sum']['sum'] +=$sum_cache['sum']['sum'];
            }elseif($key=='overtime'){//加班费
                foreach($value as $key1=>$value1){
                    $sum_cache1=array();
                    foreach ($value1 as $key2=>$value2){
                        $sum_cache2=array();
                        if(!empty($value2['job'])){
                            if($overtime_type==1){
                                if($village_info['group_id']==1){
                                    if($key1==2||$key1==3){
                                        $data[$key][$key1][$key2]['overtime']=$value2['overtime']=$this->get_number($value2['regime'])*0.8;
                                    }elseif($key1==4||$key1==8){
                                        $data[$key][$key1][$key2]['overtime']=$value2['overtime']=$this->get_number($value2['regime'])*0.6;
                                    }
                                }else{
                                    $data[$key][$key1][$key2]['overtime']=$value2['overtime']=$this->get_number($value2['regime']);
                                }
                                if($value2['overtime']<$minimum_wage){
                                    $data[$key][$key1][$key2]['overtime']=$value2['overtime']=$minimum_wage;
                                }
                                if($village_info['group_id']==1){//汇得行
                                    $sum_cache2['overtime']=round(($value2['overtime']/21.75)*3*$value2['day']*$value2['classes']*$value2['classes_num'],2);
                                }else{//靓江
                                    $sum_cache2['overtime']=round(($value2['overtime']/168)*3*$value2['day']*$value2['classes']*$value2['hour']*$value2['classes_num'],2);
                                }
                            }else{
                                $config_info=$Budget_predict_configModel->get_config_one('overtime_type','',$village_id,$project_id);
                                $sum_cache2['overtime']=round($config_info['remark']*$value2['day']*$value2['classes']*$value2['classes_num'],2);
                            }
                            $sum_cache['sum']['sum'] +=$sum_cache2['overtime'];
                            $sum_cache['sum']['num'] +=$value2['num'];
                        }else{
                            unset($data[$key][$key1][$key2]);
                        }
                        $sum_cache1[$key2]=$sum_cache2;
                    }
                    $sum_cache[$key1]=$sum_cache1;
                }
            }elseif($key=='gongling'){//工龄
                foreach($value as $key1=>$value1){
                    $sum_cache1=array();
                    foreach ($value1 as $key2=>$value2){
                        $sum_cache2=array();
                        if(!empty($value2['job'])){
                            $sum_cache2['gongling']=$value2['num']*$value2['money']*12;
                            $sum_cache2['sum']=$sum_cache2['gongling'];
                            $sum_cache['sum']['sum'] +=$sum_cache2['sum'];
                            $sum_cache['sum']['gongling'] +=$sum_cache2['gongling'];
                            $sum_cache['sum']['num'] +=$value2['num'];
                        }else{
                            unset($data[$key][$key1][$key2]);
                        }
                        $sum_cache1[$key2]=$sum_cache2;
                    }
                    $sum_cache[$key1]=$sum_cache1;
                }
            }elseif($key=='property'){//物业费
                foreach($value as $key1=>$value1){
                    $sum_cache1=array();
                    foreach ($value1 as $key2=>$value2){
                        $sum_cache2=array();
                        if(!empty($value2['name'])){
                            $sum_cache2['year_last_sum']=round($value2['year_last_0']*($proportion[$key1]['last']/100),2);
                            $sum_cache2['year_now_sum']=round($value2['year_now_0']*$value2['year_now_1']*12*($proportion[$key1]['now']/100),2);
                            $sum_cache2['sum']=$sum_cache2['year_last_sum']+$sum_cache2['year_now_sum'];
                            $sum_cache['sum']['year_last_0'] +=$value2['year_last_0'];
                            $sum_cache['sum']['year_last_sum'] +=$sum_cache2['year_last_sum'];
                            $sum_cache['sum']['year_now_0'] +=$value2['year_now_0'];
                            $sum_cache['sum']['year_now_sum'] +=$sum_cache2['year_now_sum'];
                            $sum_cache['sum']['sum'] +=$sum_cache2['sum'];
                        }else{
                            unset($data[$key][$key1][$key2]);
                        }
                        $sum_cache1[$key2]=$sum_cache2;
                    }
                    $sum_cache[$key1]=$sum_cache1;
                }
                if(!empty($sum_cache['sum']['sum'])){
                    if(!empty($data['4']['101']['children']['106']['type_data']['sum'])){
                        $cache=$data['4']['101']['children']['106']['type_data']['sum'];
                        $data['4']['101']['children']['106']['type_data']['sum'] -=$cache;
                        $sum['4']['101']['sum'] -=$cache;
                        $sum['4']['sum']['sum'] -=$cache;
                    }
                    $data['4']['101']['children']['106']['type_data']['sum'] =$sum_cache['sum']['sum'];
                    $sum['4']['101']['sum']=$sum_cache['sum']['sum'];
                    $sum['4']['sum']['sum'] +=$sum_cache['sum']['sum'];
                }

            }elseif($key=='zichan'){//资产费用
                $sum_cache=0;
                foreach($value as $key1=>$value1){
                    $data['zichan'][$key1]['sum']=$value1['sum']=$value1['unit']*$value1['num'];
                    $sum_cache +=$value1['sum'];
                }
                if(!empty($sum_cache)){
                    if(!empty($data['2']['23']['children']['50']['type_data']['sum'])){
                        $cache=$data['2']['23']['children']['50']['type_data']['sum'];
                        $data['2']['23']['children']['50']['type_data']['sum'] -=$cache;
                        $sum['2']['23']['sum'] -=$cache;
                        $sum['2']['sum']['sum'] -=$cache;
                    }
                    $data['2']['23']['children']['50']['type_data']['sum'] =$sum_cache;
                    $sum['2']['23']['sum']=$sum_cache;
                    $sum['2']['sum']['sum'] +=$sum_cache;
                }


            }elseif($key=='yunxing'){//运行费用
                $sum_cache=0;
                foreach($value as $key1=>$value1){
                    $sum_cache +=$value1['sum'];
                }
                if(!empty($sum_cache)){
                    if(!empty($data['3']['99']['children']['100']['type_data']['sum'])){
                        $cache=$data['3']['99']['children']['100']['type_data']['sum'];
                        $data['3']['99']['children']['100']['type_data']['sum'] -=$cache;
                        $sum['3']['99']['sum'] -=$cache;
                        $sum['3']['sum']['sum'] -=$cache;
                    }
                    $data['3']['99']['children']['100']['type_data']['sum'] =$sum_cache;
                    $sum['3']['99']['sum']=$sum_cache;
                    $sum['3']['sum']['sum'] +=$sum_cache;
                }
            }else{
                $sum_cache=array();
                foreach($value as $key1=>$value1){
                    $sum_cache1=0;
                    foreach ($value1['children'] as $key2=>$value2){
                        $sum_cache1 +=$this->get_number($value2['type_data']['sum']);
                    }
                    $sum_cache[$key1]['sum'] +=$sum_cache1;
                    $sum_cache['sum']['sum'] +=$sum_cache1;
                }
                //商业保险被覆盖处理
                if($key==2){
                    $sum_cache['24']['51']['sum'] +=$sum['2']['24']['51']['sum'];
                    $sum_cache['24']['sum'] +=$sum['2']['24']['sum'];
                    $sum_cache['sum']['sum'] +=$sum['2']['sum']['sum'];
                }
                /*if($key==4){
                    dump($sum[4]);
                }*/
            }
            $sum[$key]=$sum_cache;
        }
        //防止工服费没有被计算上的处理
        if(empty($sum['clothesfee'])&&!empty($data['clothesfee'])){
            $value=$data['clothesfee'];
            $sum_cache=array();
            foreach($value as $key1=>$value1){
                $sum_cache1=array();
                foreach ($value1 as $key2=>$value2){
                    $sum_cache2=array();
                    if(!empty($value2['num'])){
                        if(empty($value2['month'])) $value2['month']=$data['clothesfee'][$key1][$key2]['month']=12;
                        $sum_cache2['clothesfee']=$value2['price']*$value2['num']*$value2['month'];
                        $sum_cache['sum']['sum'] +=$sum_cache2['clothesfee'];
                        $sum_cache['sum']['num'] +=$value2['num'];
                    }else{
                        unset($data['clothesfee'][$key1][$key2]);
                    }
                    $sum_cache1[$key2]=$sum_cache2;
                }
                $sum_cache[$key1]=$sum_cache1;
            }

            $data['2']['18']['children']['42']['type_data']['sum'] +=$sum_cache['sum']['sum'];
            $sum['2']['18']['42']['sum'] +=$sum_cache['sum']['sum'];
            $sum['2']['18']['sum'] +=$sum_cache['sum']['sum'];
            $sum['2']['sum']['sum'] +=$sum_cache['sum']['sum'];
            $sum['clothesfee']=$sum_cache;
        }
        //交通费
        if($village_id==33||$village_id==15){//汉阳区检察院交通费为0
            $sum_sum=0;
        }elseif($village_id==70){
            $sum_sum=200*12;
        }elseif($village_id==76||$village_id==54){
            $sum_sum=300*12;
        }elseif($village_id==87){//汉桥城中花园二期 九个月
            $sum_sum=100*9;
        }else{
            $sum_sum=100*12;
        }
        //die;
        $data['2']['19']['children']['43']['type_data']['sum'] +=$sum_sum;
        $sum['2']['19']['43']['sum'] +=$sum_sum;
        $sum['2']['19']['sum'] +=$sum_sum;
        $sum['2']['sum']['sum'] +=$sum_sum;
        $predict_data['data']=serialize($data);
        $predict_data['sum']=serialize($sum);
        if(empty($village_id)) return array('err'=>1,'data'=>'请选择对应的项目');
        $village_info=D('House_village')->get_one($village_id);
        if(empty($village_info)) return array('err'=>1,'data'=>'选择项目不存在');
        if(empty($village_info['department_id'])) return array('err'=>1,'data'=>'所选项目没有归属部门无法使用');
        if(empty($year)) return array('err'=>1,'data'=>'请选择年份');
        $predict_data['village_id']=$village_id;
        if(!empty($project_id)) $predict_data['project_id']=$project_id;
        $predict_data['company_id']=$village_info['department_id'];
        $predict_data['year']=$year;
        $predict_data['admin_id']=$admin_id;
        $predict_data['overtime_type']=$overtime_type;
        $predict_data['is_apply']=0;//修改条目后重置应用状态
        $this->startTrans();
        if(empty($predict_id)){
            $predict_data['updatetime']=time();
            $re=$this->data($predict_data)->add();
            $predict_id=$re;
        }else{
            unset($predict_data['village_id']);
            unset($predict_data['project_id']);
            unset($predict_data['company_id']);
            unset($predict_data['admin_id']);
            $re=$this->data($predict_data)->where(array('predict_id'=>$predict_id))->save();
            $re=true;
        }
        //$re1=$Budget_predict_logModel->add_log_one($predict_id);
        $re1['err']=0;
        if($re){
            if($re1['err']==0){
                $this->commit();
                return array('err'=>0,'data'=>$predict_id);
            }else{
                $this->rollback();
                return array('err'=>1,'data'=>'插入历史记录时：'.$re1['data']);
            }
        }else{
            $this->rollback();
            return array('err'=>1,'data'=>'修改/插入失败');
        }
    }
    public function change_predict_status($predict_id,$status,$remark,$is_fance){
        $status_list=array(
            '0'=>array(1,2),
            '1'=>array(1,2,3,4,7),
            '2'=>array(1,2,3,4,5,7),
            '3'=>array(1,2,3,4,5,6,7),
            '4'=>array(1,2,3,7),
        );

        $Budget_predict_logModel=new Budget_predict_logModel();
        if(!empty($predict_id)){
            $predict_info=$this->get_predict_one(array('predict_id'=>$predict_id));
            if(empty($predict_info)) return array('err'=>1,'data'=>'所需修改条目不存在');
            if(!in_array($status,$status_list[$is_fance])) return array('err'=>1,'data'=>'您无法修改成该状态');
            if($status==$predict_info['status']) return array('err'=>0,'data'=>'无需修改');
            $Budget_predict_logModel->add_log_one($predict_id);//产生新的历史记录
            $data=array('status'=>$status,'remark'=>$remark,'check_admin_id'=>$_SESSION['system']['id'],'checktime'=>time());
            $re=$this->where(array('predict_id'=>$predict_id))->data($data)->save();
            if($re){
                return array('err'=>0,'data'=>'成功');
            }else{
                return array('err'=>1,'data'=>'状态改变失败,请重试');
            }
        }else{
            return array('err'=>1,'data'=>'参数错误');
        }

    }
    public function load_predict_one($predict_id){
        $predict_info=$this->get_predict_one(array('predict_id'=>$predict_id));
        if(empty($predict_info)) return array('err'=>1,'data'=>'所需修改条目不存在');

    }

    public function get_predict_all($sum_get,$village_id,$project_id,$company_id){
        //设定搜索条件
        $where=array('type_fid'=>0);
        if(!empty($company_id)){
                $where['company_id']=$company_id;
        }elseif(!empty($village_id)){
            $village_info=M('house_village')->where(array('village_id'=>$village_id))->find();
            $where['company_id']=$village_info['department_id'];
        }
        $type_first_list=D('Budget_type')->get_type_list($where);
        //dump($type_first_list);die;
        $data=array();
        $sum=array(
            'sum_money'=>0,
            'sum_sum'=>0,
            'difference'=>0,
        );
        foreach ($type_first_list as $key=>$value){
            unset($cache);
            $cache['type_name']=$value['type_name'];
            $cache['type_remark']=$value['type_remark'];
            $where['type_fid']=$value['type_id'];
            $type_second_list=D('Budget_type')->get_type_list($where);
            //dump($type_second_list);die;
            if($value['type_id']==1){
                foreach ($type_second_list as $key1=>$value1){
                    $cache['children'][$value1['type_name']]['type_name']=$value1['type_name'];
                    $cache['children'][$value1['type_name']]['type_remark']=$value1['type_remark'];
                    $cache_sum=0;
                    $cache_money=0;
                    switch ($value1['type_id']){
                        case '5':$cache_sum=$sum_get[$value['type_id']]['sum']['month_0']+$sum_get[$value['type_id']]['sum']['year_end']+$sum_get['overtime']['sum']['sum']+$sum_get['gongling']['sum']['sum'];break;
                        case '6':$cache_sum=$sum_get[$value['type_id']]['sum']['month_1']+$sum_get[$value['type_id']]['sum']['month_2'];break;
                        case '7':$cache_sum=$sum_get[$value['type_id']]['sum']['month_other'];break;
                    }
                    $cache_money=$cache_sum;
                    /*$cache_sum=$sum[$value['type_id']][$value1['type_id']]['sum'];*/

                    $cache['children'][$value1['type_name']]['sum_money']+=$cache_money;
                    $cache['children'][$value1['type_name']]['sum_sum']+=$cache_sum;
                    $cache['children'][$value1['type_name']]['difference']+=$cache_money-$cache_sum;
                }
            }else{
                foreach ($type_second_list as $key1=>$value1){
                    $cache['children'][$value1['type_name']]['type_name']=$value1['type_name'];
                    $cache['children'][$value1['type_name']]['type_remark']=$value1['type_remark'];
                    $cache_sum=0;
                    $cache_money=0;
                    $cache_money=$sum_get[$value['type_id']][$value1['type_id']]['sum'];
                    $cache_sum=$sum_get[$value['type_id']][$value1['type_id']]['sum'];

                    $cache['children'][$value1['type_name']]['sum_money']+=$cache_money;
                    $cache['children'][$value1['type_name']]['sum_sum']+=$cache_sum;
                    $cache['children'][$value1['type_name']]['difference']+=$cache_money-$cache_sum;
                }
            }
            if($value['type_id']==1){
                $cache['sum_money']=$sum_get['1']['sum']['sum']+$sum_get['overtime']['sum']['sum']+$sum_get['gongling']['sum']['sum'];
                $cache['sum_sum']=$sum_get['1']['sum']['sum']+$sum_get['overtime']['sum']['sum']+$sum_get['gongling']['sum']['sum'];
                $cache['difference']=$cache['sum_money']-$cache['sum_sum'];
            }else{
                $cache['sum_money']=$sum_get[$value['type_id']]['sum']['sum'];
                $cache['sum_sum']=$sum_get[$value['type_id']]['sum']['sum'];
                $cache['difference']=$cache['sum_money']-$cache['sum_sum'];
            }

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
                }else{
                    $cache_type=0.06;
                    $data_cache['children']['增值税及附加']['sum_money']=$cache['sum_money']/(1+$cache_type)*$cache_type*(1+0.115);//增值税金额都由6.3%计算
                    $data_cache['children']['增值税及附加']['sum_sum']=$cache['sum_sum']/(1+$cache_type)*$cache_type*(1+0.115);
                }

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
            }else{
                $sum['sum_money'] -=$cache['sum_money'];
                $sum['sum_sum'] -=$cache['sum_sum'];
                $sum['difference'] -=$cache['difference'];
                /*dump($sum);*/
                $data['output'][$value['type_id']]=$cache;
                $data['output']['sum_money'] +=$cache['sum_money'];
                $data['output']['sum_sum'] +=$cache['sum_sum'];
                $data['output']['difference'] +=$cache['difference'];
            }
        }
//        dump($data);die;
        $data['sum']=$sum;
        return $data;
    }

    public function output_predict_excel($predict_id){
        //ini_set('memory_limit', '-1');
        $budget_typeModel=new Budget_typeModel();
        $budget_logModel=new Budget_logModel();
        $predict_info=$this->get_predict_one(array('predict_id'=>$predict_id));
        if(empty($predict_info)) return false;
        $last_year=$predict_info['year']-1;
        $last_last_year=$predict_info['year']-2;
        $village_name=M('house_village')->where(array('village_id'=>$predict_info['village_id']))->find()['village_name'];
        if(!empty($predict_id['project_id'])) $village_name .='-'.M('house_village_project')->where(array('pigcms_id'=>$predict_info['project_id']))->find()['desc'];
        $data_sum=$this->get_predict_all($predict_info['sum'],$predict_info['village_id'],$predict_info['project_id'],'');
        $log_sum['last']=$budget_logModel->get_excel_log_sum($predict_info['village_id'],$predict_info['project_id'],$predict_info['company_id'],$last_year);
        $log_sum['last_last']=$budget_logModel->get_excel_log_sum($predict_info['village_id'],$predict_info['project_id'],$predict_info['company_id'],$last_last_year);
        //获取部门列表
        $department_list=$this->get_department_list($predict_info['village_id'],$predict_info['project_id']);
        import('@.ORG.phpexcel.PHPExcel');
        $phpexcel = new PHPExcel();
        //设置基本信息
        $phpexcel->getProperties()->setCreator("admin")
            ->setLastModifiedBy(session('system.account'))
            ->setTitle($predict_info['year'].'年'.$village_name.'项目预算编制汇总表')
            ->setSubject("预算编制表")
            ->setDescription("")
            ->setKeywords("预算编制表")
            ->setCategory("");
        $phpexcel->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpexcel->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        //执行主表页面
        $phpexcel->setActiveSheetIndex(0);
        //设置默认行高
        $phpexcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(26);

        $phpexcel->getActiveSheet()->setTitle('预算编制汇总表');
        $phpexcel->getActiveSheet()->setCellValue('A1', $predict_info['year'].'年预算编制汇总表');
        $phpexcel->getActiveSheet()->setCellValue('A2', '编制单位:'.$village_name);
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
        $phpexcel->getActiveSheet()->setCellValue('D3', '金额');
        $phpexcel->getActiveSheet()->getStyle('D3')->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('D3')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('E3', '编制说明');
        $phpexcel->getActiveSheet()->getStyle('E3')->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('E3')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->getColumnDimension('E3')->setAutoSize(true);

        //设置字体样式
        $phpexcel->getActiveSheet()->getStyle('A1')->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
        $phpexcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        //设置列宽
        $phpexcel->getActiveSheet()->getColumnDimension('B')->setWidth(17);
        $phpexcel->getActiveSheet()->getColumnDimension('C')->setWidth(17);
        $phpexcel->getActiveSheet()->getColumnDimension('D')->setWidth(28);
        $phpexcel->getActiveSheet()->getColumnDimension('E')->setWidth(37.5);

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
        $phpexcel->getActiveSheet()->setCellValue('E4', '含税金额');
        $phpexcel->getActiveSheet()->getStyle('E4')->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('E4')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->getColumnDimension('E4')->setAutoSize(true);
        $phpexcel->getActiveSheet()->getStyle('A4:E4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('ccffff');
        //收入具体金额
        $low=5;//当前行数
        $i=1;//当前循环计数
        foreach ($data_sum['input']['1']['children'] as $value){
            $phpexcel->getActiveSheet()->setCellValue('A'.$low,$i);
            $phpexcel->getActiveSheet()->setCellValue('B'.$low,$value['type_name']);
            $phpexcel->getActiveSheet()->mergeCells('B'.$low.':C'.$low);
            $phpexcel->getActiveSheet()->setCellValue('D'.$low,number_format($value['sum_money'],2));
            $phpexcel->getActiveSheet()->setCellValue('E'.$low,$value['type_remark']);
            $phpexcel->getActiveSheet()->getStyle('E'.$low)->getAlignment()->setWrapText(true);
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
        $phpexcel->getActiveSheet()->getStyle('E'.$low)->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('E'.$low)->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->getColumnDimension('E'.$low)->setAutoSize(true);
        $phpexcel->getActiveSheet()->getStyle('A'.$low.':E'.$low)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('ccffff');
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
                    $phpexcel->getActiveSheet()->setCellValue('E'.$low,$value1['type_remark']);
                    $phpexcel->getActiveSheet()->getStyle('E'.$low)->getAlignment()->setWrapText(true);
                    $low++;
                }
                $phpexcel->getActiveSheet()->setCellValue('C'.$low,'小计');
                $phpexcel->getActiveSheet()->setCellValue('D'.$low,number_format($value['sum_money'],2));
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
        $phpexcel->getActiveSheet()->setCellValue('E'.$low, '含税金额');
        $phpexcel->getActiveSheet()->getStyle('E'.$low)->getFont()->setName('宋体');
        $phpexcel->getActiveSheet()->getStyle('E'.$low)->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->getColumnDimension('E'.$low)->setAutoSize(true);
        $phpexcel->getActiveSheet()->getStyle('A'.$low)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('ccffff');
        //设置边框样式
        $phpexcel->getActiveSheet()->getStyle('A3:E'.$low)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);

        //各类型综合
        $sum=$predict_info['sum'];
        //获取全部一级类型
        $type_first_list=$budget_typeModel->get_type_list(array('type_fid'=>0,'company_id'=>$predict_info['company_id']));
        foreach ($type_first_list as $key=>$value){
            $data_type=array();
            $type_second_list=$budget_typeModel->get_type_list(array('type_fid'=>$value['type_id'],'company_id'=>$predict_info['company_id']));
            foreach ($type_second_list as $value1){
                $data_type['children'][$value1['type_id']]['children']=$budget_typeModel->get_type_list(array('type_fid'=>$value1['type_id'],'company_id'=>$predict_info['company_id']));
                $data_type['children'][$value1['type_id']]['type_name']=$value1['type_name'];
                $data_type['children'][$value1['type_id']]['type_id']=$value1['type_id'];
            }

            //获取当前数据和历史数据
            $data_type['data']=$predict_info['data'][$value['type_id']];
            $data_type['last_data']=$budget_logModel->get_excel_log_type($value['type_id'],$predict_info['village_id'],$predict_info['project_id'],'',$last_year);
            $data_type['last_last_data']=$budget_logModel->get_excel_log_type($value['type_id'],$predict_info['village_id'],$predict_info['project_id'],'',$last_last_year);
            $phpexcel->createSheet();//新建一个页面
            $phpexcel->setActiveSheetIndex($key+1);
            //设置默认行高
            $phpexcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(25);

            $phpexcel->getActiveSheet()->setTitle($value['type_name']);
            $phpexcel->getActiveSheet()->setCellValue('A1', $predict_info['year'].'年'.$value['type_name'].'明细表');
            $phpexcel->getActiveSheet()->setCellValue('A2', '编制单位:'.$village_name);
            if($value['type_id']==1){//人员支出
                for($i=0;$i<20;$i++){
                    $phpexcel->getActiveSheet()->getColumnDimension(chr(65+$i))->setWidth(20);
                }
                $phpexcel->getActiveSheet()->setCellValue('T2', '金额：元');
                //合并单元格
                $phpexcel->getActiveSheet()->mergeCells('A1:T1');
                $phpexcel->getActiveSheet()->mergeCells('A2:E2');
                //设置表头
                $title=array('部门','岗位','人数','工作月数','月工资','社保','社补','公积金',
                    array('name'=>'月福利费','child'=>array('餐费补贴','通信费','降温费','慰问费','其它')),
                    array('name'=>'年度小计','child'=>array('工资','社保社补','公积金','福利费','年度奖金')),
                    '年度小计','编制说明'
                );
                $chr=64;//循环计数
                foreach ($title as $title_key=>$title_value){
                    if(is_array($title_value)){
                        $phpexcel->getActiveSheet()->setCellValue(chr($chr+1).'3', $title_value['name']);
                        $phpexcel->getActiveSheet()->getStyle(chr($chr+1).'3')->getFont()->setName('宋体');
                        $phpexcel->getActiveSheet()->getStyle(chr($chr+1).'3')->getFont()->setBold(true);
                        $phpexcel->getActiveSheet()->mergeCells(chr($chr+1).'3:'.chr($chr+count($title_value['child'])).'3');
                        foreach ($title_value['child'] as $title_child_key=>$title_child_value){
                            $chr++;
                            $phpexcel->getActiveSheet()->setCellValue(chr($chr).'4', $title_child_value);
                            $phpexcel->getActiveSheet()->getStyle(chr($chr).'4')->getFont()->setName('宋体');
                            $phpexcel->getActiveSheet()->getStyle(chr($chr).'4')->getFont()->setBold(true);
                        }
                    }else{
                        $chr++;
                        $phpexcel->getActiveSheet()->setCellValue(chr($chr).'3', $title_value);
                        $phpexcel->getActiveSheet()->getStyle(chr($chr).'3')->getFont()->setName('宋体');
                        $phpexcel->getActiveSheet()->getStyle(chr($chr).'3')->getFont()->setBold(true);
                        $phpexcel->getActiveSheet()->mergeCells(chr($chr).'3:'.chr($chr).'4');
                    }
                }
                //输出部门与金额
                $low=4;//行数
                foreach ($department_list as $key1=>$value1){
                    if(!empty($data_type['data'])&&$value1['type']==1){
                        $cache_key=key($data_type['data'][$key1]);
                        foreach ($data_type['data'][$key1] as $key2=>$value2){
                            $low++;
                            if($key2==$cache_key){//部门
                                $phpexcel->getActiveSheet()->setCellValue('A'.$low, $value1['name']);
                                $phpexcel->getActiveSheet()->getStyle('A'.$low)->getFont()->setName('宋体');
                                $phpexcel->getActiveSheet()->getStyle('A'.$low)->getFont()->setBold(true);
                                $phpexcel->getActiveSheet()->mergeCells('A'.$low.':A'.($low+count($data_type['data'][$key1])-1));
                            }
                            $phpexcel->getActiveSheet()->setCellValue('B'.$low, $value2['job']);
                            $phpexcel->getActiveSheet()->setCellValue('C'.$low, $value2['num']);
                            $phpexcel->getActiveSheet()->setCellValue('D'.$low, $value2['month']);
                            $phpexcel->getActiveSheet()->setCellValue('E'.$low, $value2['month_0']?:'-');
                            $phpexcel->getActiveSheet()->setCellValue('F'.$low, $value2['month_1']?:'-');
                            $phpexcel->getActiveSheet()->setCellValue('G'.$low, $value2['month_8']?:'-');
                            $phpexcel->getActiveSheet()->setCellValue('H'.$low, $value2['month_2']?:'-');
                            $phpexcel->getActiveSheet()->setCellValue('I'.$low, $value2['month_3']?:'-');
                            $phpexcel->getActiveSheet()->setCellValue('J'.$low, $value2['month_4']?:'-');
                            $phpexcel->getActiveSheet()->setCellValue('K'.$low, $value2['month_5']?:'-');
                            $phpexcel->getActiveSheet()->setCellValue('L'.$low, $value2['month_6']?:'-');
                            $phpexcel->getActiveSheet()->setCellValue('M'.$low, $value2['month_7']?:'-');
                            $phpexcel->getActiveSheet()->setCellValue('N'.$low, $sum[$value['type_id']][$key1][$key2]['month_0']?:'-');
                            $phpexcel->getActiveSheet()->setCellValue('O'.$low, $sum[$value['type_id']][$key1][$key2]['month_1']?:'-');
                            $phpexcel->getActiveSheet()->setCellValue('P'.$low, $sum[$value['type_id']][$key1][$key2]['month_2']?:'-');
                            $phpexcel->getActiveSheet()->setCellValue('Q'.$low, $sum[$value['type_id']][$key1][$key2]['month_other']?:'-');
                            $phpexcel->getActiveSheet()->setCellValue('R'.$low, $sum[$value['type_id']][$key1][$key2]['year_end']?:'-');
                            $phpexcel->getActiveSheet()->setCellValue('S'.$low, $sum[$value['type_id']][$key1][$key2]['sum']?:'-');
                            $phpexcel->getActiveSheet()->setCellValue('T'.$low, $sum[$value['type_id']][$key1][$key2]['remark']);
                        }
                    }
                }
                //合计
                $low++;
                $phpexcel->getActiveSheet()->setCellValue('A'.$low, '合计');
                $phpexcel->getActiveSheet()->getStyle('A'.$low)->getFont()->setName('宋体');
                $phpexcel->getActiveSheet()->getStyle('A'.$low)->getFont()->setBold(true);
                $phpexcel->getActiveSheet()->mergeCells('A'.$low.':B'.$low);
                $phpexcel->getActiveSheet()->setCellValue('N'.$low, $sum[$value['type_id']]['sum']['month_0']?:'-');
                $phpexcel->getActiveSheet()->setCellValue('O'.$low, $sum[$value['type_id']]['sum']['month_1']?:'-');
                $phpexcel->getActiveSheet()->setCellValue('P'.$low, $sum[$value['type_id']]['sum']['month_2']?:'-');
                $phpexcel->getActiveSheet()->setCellValue('Q'.$low, $sum[$value['type_id']]['sum']['month_other']?:'-');
                $phpexcel->getActiveSheet()->setCellValue('R'.$low, $sum[$value['type_id']]['sum']['year_end']?:'-');
                $phpexcel->getActiveSheet()->setCellValue('S'.$low, $sum[$value['type_id']]['sum']['sum']?:'-');

                //工龄工资
                $low++;
                $phpexcel->getActiveSheet()->setCellValue('A'.$low, '工龄工资');
                $phpexcel->getActiveSheet()->getStyle('A'.$low)->getFont()->setName('宋体');
                $phpexcel->getActiveSheet()->getStyle('A'.$low)->getFont()->setBold(true);
                $phpexcel->getActiveSheet()->mergeCells('A'.$low.':B'.$low);
                $phpexcel->getActiveSheet()->setCellValue('S'.$low, $sum['gongling']['sum']['sum']?:'-');

                //加班工资
                $low++;
                $phpexcel->getActiveSheet()->setCellValue('A'.$low, '加班工资');
                $phpexcel->getActiveSheet()->getStyle('A'.$low)->getFont()->setName('宋体');
                $phpexcel->getActiveSheet()->getStyle('A'.$low)->getFont()->setBold(true);
                $phpexcel->getActiveSheet()->mergeCells('A'.$low.':B'.$low);
                $phpexcel->getActiveSheet()->setCellValue('E'.$low, '按基本工资/计薪天数*3计算');
                $phpexcel->getActiveSheet()->mergeCells('E'.$low.':Q'.$low);
                $phpexcel->getActiveSheet()->setCellValue('S'.$low, $sum['overtime']['sum']['sum']?:'-');

                //总计
                $low++;
                $phpexcel->getActiveSheet()->setCellValue('A'.$low, '总计');
                $phpexcel->getActiveSheet()->getStyle('A'.$low)->getFont()->setName('宋体');
                $phpexcel->getActiveSheet()->getStyle('A'.$low)->getFont()->setBold(true);
                $phpexcel->getActiveSheet()->mergeCells('A'.$low.':B'.$low);
                $phpexcel->getActiveSheet()->setCellValue('S'.$low, $sum['overtime']['sum']['sum']+$sum['1']['sum']['sum']+$sum['gongling']['sum']['sum']);
                //设置边框样式
                $phpexcel->getActiveSheet()->getStyle('A3:T'.$low)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            }else{
                for($i=0;$i<6;$i++){
                    $phpexcel->getActiveSheet()->getColumnDimension(chr(65+$i))->setWidth(25);
                }
                $phpexcel->getActiveSheet()->setCellValue('F2', '金额：元');
                //合并单元格
                $phpexcel->getActiveSheet()->mergeCells('A1:F1');
                $phpexcel->getActiveSheet()->mergeCells('A2:C2');
                //表头
                $phpexcel->getActiveSheet()->setCellValue('A3', '项目');
                $phpexcel->getActiveSheet()->getStyle('A3')->getFont()->setName('宋体');
                $phpexcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
                $phpexcel->getActiveSheet()->mergeCells('A3:B3');
                $phpexcel->getActiveSheet()->setCellValue('C3', $predict_info['year'].'年预算金额');
                $phpexcel->getActiveSheet()->getStyle('A3')->getFont()->setName('宋体');
                $phpexcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
                $phpexcel->getActiveSheet()->setCellValue('D3', $last_year.'年预算金额');
                $phpexcel->getActiveSheet()->getStyle('A3')->getFont()->setName('宋体');
                $phpexcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
                $phpexcel->getActiveSheet()->setCellValue('E3', $last_last_year.'年预算金额');
                $phpexcel->getActiveSheet()->getStyle('E3')->getFont()->setName('宋体');
                $phpexcel->getActiveSheet()->getStyle('E3')->getFont()->setBold(true);
                $phpexcel->getActiveSheet()->setCellValue('F3', '编制说明');
                $phpexcel->getActiveSheet()->getStyle('F3')->getFont()->setName('宋体');
                $phpexcel->getActiveSheet()->getStyle('F3')->getFont()->setBold(true);
                //内容
                $low=3;
                foreach($data_type['children'] as $key1=>$value1){
                    $phpexcel->getActiveSheet()->setCellValue('A'.($low+1), $value1['type_name']);
                    $phpexcel->getActiveSheet()->getStyle('A'.($low+1))->getFont()->setName('宋体');
                    $phpexcel->getActiveSheet()->getStyle('A'.($low+1))->getFont()->setBold(true);
                    $phpexcel->getActiveSheet()->mergeCells('A'.($low+1).':A'.(($low+1)+count($value1['children'])));
                    foreach ($value1['children'] as $key2=>$value2){
                        $low++;
                        $phpexcel->getActiveSheet()->setCellValue('B'.$low, $value2['type_name']);
                        $phpexcel->getActiveSheet()->setCellValue('C'.$low, $data_type['data'][$key1]['children'][$value2['type_id']]['type_data']['sum']);
                        $phpexcel->getActiveSheet()->setCellValue('D'.$low, $data_type['last_data'][$key1]['children'][$value2['type_id']]['type_data']['sum']?number_format($data_type['last_data'][$key1]['children'][$value2['type_id']]['type_data']['sum'],2):'-');
                        $phpexcel->getActiveSheet()->setCellValue('E'.$low, $data_type['last_last_data'][$key1]['children'][$value2['type_id']]['type_data']['sum']?number_format($data_type['last_last_data'][$key1]['children'][$value2['type_id']]['type_data']['sum'],2):'-');
                        $phpexcel->getActiveSheet()->setCellValue('F'.$low, $data_type['data'][$key1]['children'][$value2['type_id']]['type_data']['remark']);
                    }
                    $low++;
                    $phpexcel->getActiveSheet()->setCellValue('B'.$low, '小计');
                    $phpexcel->getActiveSheet()->setCellValue('C'.$low, $sum[$value['type_id']][$key1]['sum']?:'');
                    if($value['type_id']==4){
                        $phpexcel->getActiveSheet()->setCellValue('D'.$low, $log_sum['last']['input']['1']['children'][$value1['type_name']]['sum_sum']?number_format($log_sum['last']['input']['1']['children'][$value1['type_name']]['sum_sum'],2):'-');
                        $phpexcel->getActiveSheet()->setCellValue('E'.$low, $log_sum['last_last']['input']['1']['children'][$value1['type_name']]['sum_sum']?number_format($log_sum['last_last']['input']['1']['children'][$value1['type_name']]['sum_sum'],2):'-');
                    }else{
                        $phpexcel->getActiveSheet()->setCellValue('D'.$low, $log_sum['last']['output'][$value['type_id']]['children'][$value1['type_name']]['sum_sum']?number_format($log_sum['last']['output'][$value['type_id']]['children'][$value1['type_name']]['sum_sum'],2):'-');
                        $phpexcel->getActiveSheet()->setCellValue('E'.$low, $log_sum['last_last']['output'][$value['type_id']]['children'][$value1['type_name']]['sum_sum']?number_format($log_sum['last_last']['output'][$value['type_id']]['children'][$value1['type_name']]['sum_sum'],2):'-');
                    }
                    $phpexcel->getActiveSheet()->getStyle('B'.$low)->getFont()->setColor(new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_RED ));
                    $phpexcel->getActiveSheet()->getStyle('C'.$low)->getFont()->setColor(new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_RED ));
                    $phpexcel->getActiveSheet()->getStyle('D'.$low)->getFont()->setColor(new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_RED ));
                    $phpexcel->getActiveSheet()->getStyle('E'.$low)->getFont()->setColor(new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_RED ));
                }
                $low++;
                $phpexcel->getActiveSheet()->setCellValue('B'.$low, '合计');
                $phpexcel->getActiveSheet()->setCellValue('C'.$low, $sum[$value['type_id']]['sum']['sum']?:'');
                if($value['type_id']==4){
                    $phpexcel->getActiveSheet()->setCellValue('D'.$low, $log_sum['last']['input']['1']['sum_sum']?number_format($log_sum['last']['input']['1']['sum_sum'],2):'-');
                    $phpexcel->getActiveSheet()->setCellValue('E'.$low, $log_sum['last_last']['input']['1']['sum_sum']?number_format($log_sum['last_last']['input']['1']['sum_sum'],2):'-');
                }else{
                    $phpexcel->getActiveSheet()->setCellValue('D'.$low, $log_sum['last']['output'][$value['type_id']]['sum_sum']?number_format($log_sum['last']['output'][$value['type_id']]['sum_sum'],2):'-');
                    $phpexcel->getActiveSheet()->setCellValue('E'.$low, $log_sum['last_last']['output'][$value['type_id']]['sum_sum']?number_format($log_sum['last_last']['output'][$value['type_id']]['sum_sum'],2):'-');
                }
                $phpexcel->getActiveSheet()->getStyle('B'.$low)->getFont()->setColor(new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_RED ));
                $phpexcel->getActiveSheet()->getStyle('C'.$low)->getFont()->setColor(new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_RED ));
                $phpexcel->getActiveSheet()->getStyle('D'.$low)->getFont()->setColor(new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_RED ));
                $phpexcel->getActiveSheet()->getStyle('E'.$low)->getFont()->setColor(new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_RED ));
                //设置边框样式
                $phpexcel->getActiveSheet()->getStyle('A3:F'.$low)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            }
        }
        $index=$key+1;
        //是否存在物业费详细收入
        $is_property=!empty($predict_info['data']['property']);
        //$is_property=0;
        if($is_property){
            $property=$predict_info['data']['property'];
            $property_list=array(
                '1'=>'写字楼',
                '2'=>'住宅'
            );
            $proportion=array(
                '1'=>array('last'=>'95','now'=>'95'),
                '2'=>array('last'=>'70','now'=>'90'),
            );
            $phpexcel->createSheet();//新建一个页面
            $phpexcel->setActiveSheetIndex(++$index);
            //设置默认行高
            $phpexcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(25);

            $phpexcel->getActiveSheet()->setTitle('物业费详细收入');
            $phpexcel->getActiveSheet()->setCellValue('A1', $predict_info['year'].'年物业费详细收入明细表');
            $phpexcel->getActiveSheet()->setCellValue('A2', '编制单位:'.$village_name);
            for($i=0;$i<11;$i++){
                $phpexcel->getActiveSheet()->getColumnDimension(chr(65+$i))->setWidth(20);
            }
            $phpexcel->getActiveSheet()->setCellValue('K2', '金额：元');
            //合并单元格
            $phpexcel->getActiveSheet()->mergeCells('A1:K1');
            $phpexcel->getActiveSheet()->mergeCells('A2:E2');
            $title=array('类型','收费类别',
                array('name'=>'以前年度','child'=>array('上年欠费','预算比例','列入本年预算数')),
                array('name'=>'本年度','child'=>array('可收费面积','收费标准','预算比例','本年收入')),
                '本年度预算数','编制说明'
            );
            $chr=64;//循环计数
            foreach ($title as $title_key=>$title_value){
                if(is_array($title_value)){
                    $phpexcel->getActiveSheet()->setCellValue(chr($chr+1).'3', $title_value['name']);
                    $phpexcel->getActiveSheet()->getStyle(chr($chr+1).'3')->getFont()->setName('宋体');
                    $phpexcel->getActiveSheet()->getStyle(chr($chr+1).'3')->getFont()->setBold(true);
                    $phpexcel->getActiveSheet()->mergeCells(chr($chr+1).'3:'.chr($chr+count($title_value['child'])).'3');
                    foreach ($title_value['child'] as $title_child_key=>$title_child_value){
                        $chr++;
                        $phpexcel->getActiveSheet()->setCellValue(chr($chr).'4', $title_child_value);
                        $phpexcel->getActiveSheet()->getStyle(chr($chr).'4')->getFont()->setName('宋体');
                        $phpexcel->getActiveSheet()->getStyle(chr($chr).'4')->getFont()->setBold(true);
                    }
                }else{
                    $chr++;
                    $phpexcel->getActiveSheet()->setCellValue(chr($chr).'3', $title_value);
                    $phpexcel->getActiveSheet()->getStyle(chr($chr).'3')->getFont()->setName('宋体');
                    $phpexcel->getActiveSheet()->getStyle(chr($chr).'3')->getFont()->setBold(true);
                    $phpexcel->getActiveSheet()->mergeCells(chr($chr).'3:'.chr($chr).'4');
                }
            }
            $low=3;
            foreach ($property_list as $key=>$value){
                if(!empty($property[$key])){
                    $cache_key=key($property[$key]);
                    $phpexcel->getActiveSheet()->setCellValue('A'.($low+1), $value);
                    $phpexcel->getActiveSheet()->getStyle('A'.($low+1))->getFont()->setName('宋体');
                    $phpexcel->getActiveSheet()->getStyle('A'.($low+1))->getFont()->setBold(true);
                    $phpexcel->getActiveSheet()->mergeCells('A'.($low+1).':A'.($low+count($property[$key])));
                    foreach ($property[$key] as $key1=>$value1){
                        $low++;
                        $phpexcel->getActiveSheet()->setCellValue('B'.$low, $value1['name']);
                        $phpexcel->getActiveSheet()->setCellValue('C'.$low, $value1['year_last_0']);
                        if($key1==$cache_key){
                            $phpexcel->getActiveSheet()->setCellValue('D'.$low, $proportion[$key]['last'].'%');
                            $phpexcel->getActiveSheet()->getStyle('D'.$low)->getFont()->setName('宋体');
                            $phpexcel->getActiveSheet()->getStyle('D'.$low)->getFont()->setBold(true);
                            $phpexcel->getActiveSheet()->mergeCells('D'.$low.':D'.($low+count($property[$key])-1));
                        }
                        $phpexcel->getActiveSheet()->setCellValue('E'.$low, $sum['property'][$key][$key1]['year_last_sum']);
                        $phpexcel->getActiveSheet()->setCellValue('F'.$low, $value1['year_now_0']);
                        $phpexcel->getActiveSheet()->setCellValue('G'.$low, $value1['year_now_1']);
                        if($key1==$cache_key){
                            $phpexcel->getActiveSheet()->setCellValue('H'.$low, $proportion[$key]['now'].'%');
                            $phpexcel->getActiveSheet()->getStyle('H'.$low)->getFont()->setName('宋体');
                            $phpexcel->getActiveSheet()->getStyle('H'.$low)->getFont()->setBold(true);
                            $phpexcel->getActiveSheet()->mergeCells('H'.$low.':H'.($low+count($property[$key])-1));
                        }
                        $phpexcel->getActiveSheet()->setCellValue('I'.$low, $sum['property'][$key][$key1]['year_now_sum']);
                        $phpexcel->getActiveSheet()->setCellValue('J'.$low, $sum['property'][$key][$key1]['sum']);
                        if($key1==$cache_key){
                            if($key=='1'){
                                $phpexcel->getActiveSheet()->setCellValue('K'.$low, '以在管物业可收费面积为依据，按上年未收（含历欠）'.$proportion[$key]['last'].'%和当年应'.$proportion[$key]['now'].'%计算，中途退租和出租的均不作调整。');
                            }else{
                                $phpexcel->getActiveSheet()->setCellValue('K'.$low, '以实际向业主交房面积为依据，按上年未收（含历欠）按'.$proportion[$key]['last'].'，当年应收'.$proportion[$key]['now'].'%计算，不论何因均不考虑扣减');
                            }
                            $phpexcel->getActiveSheet()->getStyle('K'.$low)->getFont()->setName('宋体');
                            $phpexcel->getActiveSheet()->getStyle('K'.$low)->getFont()->setBold(true);
                            $phpexcel->getActiveSheet()->mergeCells('K'.$low.':K'.($low+count($property[$key])-1));
                        }
                    }
                }
            }
            $low++;
            $phpexcel->getActiveSheet()->setCellValue('B'.$low, '合计');
            $phpexcel->getActiveSheet()->setCellValue('C'.$low, $sum['property']['sum']['year_last_0']?:'');
            $phpexcel->getActiveSheet()->setCellValue('E'.$low, $sum['property']['sum']['year_last_sum']?:'');
            $phpexcel->getActiveSheet()->setCellValue('F'.$low, $sum['property']['sum']['year_now_0']?:'');
            $phpexcel->getActiveSheet()->setCellValue('I'.$low, $sum['property']['sum']['year_now_sum']?:'');
            $phpexcel->getActiveSheet()->setCellValue('J'.$low, $sum['property']['sum']['sum']?:'');
            $phpexcel->getActiveSheet()->getStyle('C'.$low)->getFont()->setColor(new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_RED ));
            $phpexcel->getActiveSheet()->getStyle('B'.$low)->getFont()->setColor(new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_RED ));
            $phpexcel->getActiveSheet()->getStyle('E'.$low)->getFont()->setColor(new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_RED ));
            $phpexcel->getActiveSheet()->getStyle('F'.$low)->getFont()->setColor(new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_RED ));
            $phpexcel->getActiveSheet()->getStyle('I'.$low)->getFont()->setColor(new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_RED ));
            $phpexcel->getActiveSheet()->getStyle('J'.$low)->getFont()->setColor(new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_RED ));
            //设置边框样式
            $phpexcel->getActiveSheet()->getStyle('A3:K'.$low)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
        }
        //是否存在工龄工资
        $is_gongling=0;
        if(!empty($sum['gongling']['sum']['sum'])) $is_gongling=1;

        if($is_gongling){
            $gongling=$predict_info['data']['gongling'];
            $phpexcel->createSheet();//新建一个页面
            $phpexcel->setActiveSheetIndex(++$index);
            //设置默认行高
            $phpexcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(25);

            $phpexcel->getActiveSheet()->setTitle('工龄工资明细');
            $phpexcel->getActiveSheet()->setCellValue('A1', $predict_info['year'].'年工龄工资明细表');
            $phpexcel->getActiveSheet()->setCellValue('A2', '编制单位:'.$village_name);
            for($i=0;$i<6;$i++){
                $phpexcel->getActiveSheet()->getColumnDimension(chr(65+$i))->setWidth(20);
            }
            $phpexcel->getActiveSheet()->setCellValue('F2', '金额：元');
            //合并单元格
            $phpexcel->getActiveSheet()->mergeCells('A1:F1');
            $phpexcel->getActiveSheet()->mergeCells('A2:C2');
            $title=array('部门','岗位', '人数','天数','工龄工资','备注');
            $chr=64;//循环计数
            foreach ($title as $title_key=>$title_value){
                    $chr++;
                    $phpexcel->getActiveSheet()->setCellValue(chr($chr).'3', $title_value);
                    $phpexcel->getActiveSheet()->getStyle(chr($chr).'3')->getFont()->setName('宋体');
                    $phpexcel->getActiveSheet()->getStyle(chr($chr).'3')->getFont()->setBold(true);
            }
            $low=3;
            foreach ($department_list as $key=>$value){
                if(!empty($gongling[$key])){
                    $phpexcel->getActiveSheet()->setCellValue('A'.($low+1), $value['name']);
                    $phpexcel->getActiveSheet()->getStyle('A'.($low+1))->getFont()->setName('宋体');
                    $phpexcel->getActiveSheet()->getStyle('A'.($low+1))->getFont()->setBold(true);
                    $phpexcel->getActiveSheet()->mergeCells('A'.($low+1).':A'.($low+count($gongling[$key])));
                    foreach ($gongling[$key] as $key1=>$value1){
                        $low++;
                        $phpexcel->getActiveSheet()->setCellValue('B'.$low, $value1['job']);
                        $phpexcel->getActiveSheet()->setCellValue('C'.$low, $value1['num']);
                        $phpexcel->getActiveSheet()->setCellValue('D'.$low, $value1['money']);
                        $phpexcel->getActiveSheet()->setCellValue('E'.$low, $sum['gongling'][$key][$key1]['sum']);
                        $phpexcel->getActiveSheet()->setCellValue('F'.$low, $value1['remark']);
                    }
                }
            }
            $low++;
            $phpexcel->getActiveSheet()->setCellValue('B'.$low, '合计');
            $phpexcel->getActiveSheet()->setCellValue('E'.$low, $sum['gongling']['sum']['sum']?:'');
            $phpexcel->getActiveSheet()->getStyle('B'.$low)->getFont()->setColor(new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_RED ));
            $phpexcel->getActiveSheet()->getStyle('E'.$low)->getFont()->setColor(new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_RED ));
            //设置边框样式
            $phpexcel->getActiveSheet()->getStyle('A3:E'.$low)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
        }
        //是否存在加班工资
        if(!empty($predict_info['data']['overtime'])){
            $overtime=$predict_info['data']['overtime'];
            $phpexcel->createSheet();//新建一个页面
            $phpexcel->setActiveSheetIndex(++$index);
            //设置默认行高
            $phpexcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(25);

            $phpexcel->getActiveSheet()->setTitle('加班工资明细');
            $phpexcel->getActiveSheet()->setCellValue('A1', $predict_info['year'].'年加班工资明细表');
            $phpexcel->getActiveSheet()->setCellValue('A2', '编制单位:'.$village_name);
            for($i=0;$i<8;$i++){
                $phpexcel->getActiveSheet()->getColumnDimension(chr(65+$i))->setWidth(20);
            }
            $phpexcel->getActiveSheet()->setCellValue('H2', '金额：元');
            //合并单元格
            $phpexcel->getActiveSheet()->mergeCells('A1:H1');
            $phpexcel->getActiveSheet()->mergeCells('A2:C2');
            $overtime_type_name=$predict_info['overtime_type']==1?'制度工资':'每日加班工资';
            $title=array('部门','岗位', $overtime_type_name,'天数','每天班次数','每班次人数','加班工资','备注');
            $chr=64;//循环计数
            foreach ($title as $title_key=>$title_value){
                    $chr++;
                    $phpexcel->getActiveSheet()->setCellValue(chr($chr).'3', $title_value);
                    $phpexcel->getActiveSheet()->getStyle(chr($chr).'3')->getFont()->setName('宋体');
                    $phpexcel->getActiveSheet()->getStyle(chr($chr).'3')->getFont()->setBold(true);
            }
            $low=3;
            foreach ($department_list as $key=>$value){
                if(!empty($overtime[$key])){
                    $phpexcel->getActiveSheet()->setCellValue('A'.($low+1), $value['name']);
                    $phpexcel->getActiveSheet()->getStyle('A'.($low+1))->getFont()->setName('宋体');
                    $phpexcel->getActiveSheet()->getStyle('A'.($low+1))->getFont()->setBold(true);
                    $phpexcel->getActiveSheet()->mergeCells('A'.($low+1).':A'.($low+count($overtime[$key])));
                    foreach ($overtime[$key] as $key1=>$value1){
                        $low++;
                        $phpexcel->getActiveSheet()->setCellValue('B'.$low, $value1['job']);
                        $phpexcel->getActiveSheet()->setCellValue('C'.$low, $value1['overtime']?:$value1['regime']);
                        $phpexcel->getActiveSheet()->setCellValue('D'.$low, $value1['day']);
                        $phpexcel->getActiveSheet()->setCellValue('E'.$low, $value1['classes']);
                        $phpexcel->getActiveSheet()->setCellValue('F'.$low, $value1['classes_num']);
                        $phpexcel->getActiveSheet()->setCellValue('G'.$low, $sum['overtime'][$key][$key1]['overtime']);
                        $phpexcel->getActiveSheet()->setCellValue('H'.$low, $value1['remark']);
                    }
                }
            }
            $low++;
            $phpexcel->getActiveSheet()->setCellValue('B'.$low, '合计');
            $phpexcel->getActiveSheet()->setCellValue('G'.$low, $sum['overtime']['sum']['sum']?:'');
            $phpexcel->getActiveSheet()->getStyle('B'.$low)->getFont()->setColor(new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_RED ));
            $phpexcel->getActiveSheet()->getStyle('G'.$low)->getFont()->setColor(new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_RED ));
            //设置边框样式
            $phpexcel->getActiveSheet()->getStyle('A3:H'.$low)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
        }
        //是否存在工服费
        if(!empty($predict_info['data']['clothesfee'])){
            $clothesfee=$predict_info['data']['clothesfee'];
            $phpexcel->createSheet();//新建一个页面
            $phpexcel->setActiveSheetIndex(++$index);
            //设置默认行高
            $phpexcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(25);

            $phpexcel->getActiveSheet()->setTitle('工服费明细');
            $phpexcel->getActiveSheet()->setCellValue('A1', $predict_info['year'].'年工服费明细表');
            $phpexcel->getActiveSheet()->setCellValue('A2', '编制单位:'.$village_name);
            for($i=0;$i<7;$i++){
                $phpexcel->getActiveSheet()->getColumnDimension(chr(65+$i))->setWidth(20);
            }
            $phpexcel->getActiveSheet()->setCellValue('G2', '金额：元');
            //合并单元格
            $phpexcel->getActiveSheet()->mergeCells('A1:G1');
            $phpexcel->getActiveSheet()->mergeCells('A2:C2');
            $title=array('部门','岗位', '人数','计算标准（元/每人/月）','月份','工服费','备注',);
            $chr=64;//循环计数
            foreach ($title as $title_key=>$title_value){
                    $chr++;
                    $phpexcel->getActiveSheet()->setCellValue(chr($chr).'3', $title_value);
                    $phpexcel->getActiveSheet()->getStyle(chr($chr).'3')->getFont()->setName('宋体');
                    $phpexcel->getActiveSheet()->getStyle(chr($chr).'3')->getFont()->setBold(true);
            }
            $low=3;
            foreach ($department_list as $key=>$value){
                if(!empty($clothesfee[$key])){
                    $phpexcel->getActiveSheet()->setCellValue('A'.($low+1), $value['name']);
                    $phpexcel->getActiveSheet()->getStyle('A'.($low+1))->getFont()->setName('宋体');
                    $phpexcel->getActiveSheet()->getStyle('A'.($low+1))->getFont()->setBold(true);
                    $phpexcel->getActiveSheet()->mergeCells('A'.($low+1).':A'.($low+count($clothesfee[$key])));
                    foreach ($clothesfee[$key] as $key1=>$value1){
                        $low++;
                        $phpexcel->getActiveSheet()->setCellValue('B'.$low, $value1['job']);
                        $phpexcel->getActiveSheet()->setCellValue('C'.$low, $value1['num']);
                        $phpexcel->getActiveSheet()->setCellValue('D'.$low, $value1['price']);
                        $phpexcel->getActiveSheet()->setCellValue('E'.$low, $value1['month']);
                        $phpexcel->getActiveSheet()->setCellValue('F'.$low, $sum['clothesfee'][$key][$key1]['clothesfee']);
                        $phpexcel->getActiveSheet()->setCellValue('G'.$low, $value1['remark']);
                    }
                }
            }
            $low++;
            $phpexcel->getActiveSheet()->setCellValue('B'.$low, '合计');
            $phpexcel->getActiveSheet()->setCellValue('C'.$low, $sum['clothesfee']['sum']['num']?:'');
            $phpexcel->getActiveSheet()->setCellValue('F'.$low, $sum['clothesfee']['sum']['sum']?:'');
            $phpexcel->getActiveSheet()->getStyle('B'.$low)->getFont()->setColor(new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_RED ));
            $phpexcel->getActiveSheet()->getStyle('C'.$low)->getFont()->setColor(new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_RED ));
            $phpexcel->getActiveSheet()->getStyle('G'.$low)->getFont()->setColor(new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_RED ));
            //设置边框样式
            $phpexcel->getActiveSheet()->getStyle('A3:G'.$low)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
        }
        //是否存在资产购置费
        $is_zichan=0;
        if(!empty($sum['zichan']['sum']['sum'])) $is_zichan=1;
        if($is_zichan){
            $zichan=$predict_info['data']['zichan'];
            $phpexcel->createSheet();//新建一个页面
            $phpexcel->setActiveSheetIndex(++$index);
            //设置默认行高
            $phpexcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(25);

            $phpexcel->getActiveSheet()->setTitle('资产购置费明细');
            $phpexcel->getActiveSheet()->setCellValue('A1', $predict_info['year'].'年资产购置费明细表');
            $phpexcel->getActiveSheet()->setCellValue('A2', '编制单位:'.$village_name);
            for($i=0;$i<7;$i++){
                $phpexcel->getActiveSheet()->getColumnDimension(chr(65+$i))->setWidth(20);
            }
            $phpexcel->getActiveSheet()->setCellValue('D2', '金额：元');
            //合并单元格
            $phpexcel->getActiveSheet()->mergeCells('A1:D1');
            $phpexcel->getActiveSheet()->mergeCells('A2:B2');
            $title=array('项目明细','单价', '数量','合计');
            $chr=64;//循环计数
            foreach ($title as $title_key=>$title_value){
                $chr++;
                $phpexcel->getActiveSheet()->setCellValue(chr($chr).'3', $title_value);
                $phpexcel->getActiveSheet()->getStyle(chr($chr).'3')->getFont()->setName('宋体');
                $phpexcel->getActiveSheet()->getStyle(chr($chr).'3')->getFont()->setBold(true);
            }
            $low=3;
            foreach ($zichan[$key] as $key=>$value){
                $low++;
                $phpexcel->getActiveSheet()->setCellValue('A'.$low, $value['name']);
                $phpexcel->getActiveSheet()->setCellValue('B'.$low, $value['unit']);
                $phpexcel->getActiveSheet()->setCellValue('C'.$low, $value['num']);
                $phpexcel->getActiveSheet()->setCellValue('D'.$low, $value['sum']);
            }
            //设置边框样式
            $phpexcel->getActiveSheet()->getStyle('A3:D'.$low)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
        }
        //是否存在劳务派遣费用
        $is_dispatch=0;
        if(!empty($sum['dispatch']['sum']['sum'])) $is_dispatch=1;
        if($is_dispatch){
            $dispatch=$predict_info['data']['dispatch'];
            $phpexcel->createSheet();//新建一个页面
            $phpexcel->setActiveSheetIndex(++$index);
            //设置默认行高
            $phpexcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(25);

            $phpexcel->getActiveSheet()->setTitle('劳务派遣费用明细');
            $phpexcel->getActiveSheet()->setCellValue('A1', $predict_info['year'].'年劳务派遣费用明细表');
            $phpexcel->getActiveSheet()->setCellValue('A2', '编制单位:'.$village_name);
            for($i=0;$i<6;$i++){
                $phpexcel->getActiveSheet()->getColumnDimension(chr(65+$i))->setWidth(20);
            }
            $phpexcel->getActiveSheet()->setCellValue('U2', '金额：元');
            //合并单元格
            $phpexcel->getActiveSheet()->mergeCells('A1:U1');
            $phpexcel->getActiveSheet()->mergeCells('A2:C2');
            //设置表头
            $title=array('部门','岗位','人数','工作月数','月工资','社保','社补','公积金',
                array('name'=>'月福利费','child'=>array('降温费','慰问费')),
                '管理费','保险费(单价)','年终奖(单价)',
                array('name'=>'年度小计','child'=>array('工资','五险一金','福利费','管理费	','保险费','年终奖')),
                '年度合计','备注'
            );
            $chr=64;//循环计数
            foreach ($title as $title_key=>$title_value){
                if(is_array($title_value)){
                    $phpexcel->getActiveSheet()->setCellValue(chr($chr+1).'3', $title_value['name']);
                    $phpexcel->getActiveSheet()->getStyle(chr($chr+1).'3')->getFont()->setName('宋体');
                    $phpexcel->getActiveSheet()->getStyle(chr($chr+1).'3')->getFont()->setBold(true);
                    $phpexcel->getActiveSheet()->mergeCells(chr($chr+1).'3:'.chr($chr+count($title_value['child'])).'3');
                    foreach ($title_value['child'] as $title_child_key=>$title_child_value){
                        $chr++;
                        $phpexcel->getActiveSheet()->setCellValue(chr($chr).'4', $title_child_value);
                        $phpexcel->getActiveSheet()->getStyle(chr($chr).'4')->getFont()->setName('宋体');
                        $phpexcel->getActiveSheet()->getStyle(chr($chr).'4')->getFont()->setBold(true);
                    }
                }else{
                    $chr++;
                    $phpexcel->getActiveSheet()->setCellValue(chr($chr).'3', $title_value);
                    $phpexcel->getActiveSheet()->getStyle(chr($chr).'3')->getFont()->setName('宋体');
                    $phpexcel->getActiveSheet()->getStyle(chr($chr).'3')->getFont()->setBold(true);
                    $phpexcel->getActiveSheet()->mergeCells(chr($chr).'3:'.chr($chr).'4');
                }
            }
            $low=4;
            foreach ($department_list as $key=>$value){
                if(!empty($dispatch[$key])){
                    $phpexcel->getActiveSheet()->setCellValue('A'.($low+1), $value['name']);
                    $phpexcel->getActiveSheet()->getStyle('A'.($low+1))->getFont()->setName('宋体');
                    $phpexcel->getActiveSheet()->getStyle('A'.($low+1))->getFont()->setBold(true);
                    $phpexcel->getActiveSheet()->mergeCells('A'.($low+1).':A'.($low+count($dispatch[$key])));
                    foreach ($dispatch[$key] as $key1=>$value1){
                        $low++;
                        $phpexcel->getActiveSheet()->setCellValue('B'.$low, $value1['job']);
                        $phpexcel->getActiveSheet()->setCellValue('C'.$low, $value1['num']);
                        $phpexcel->getActiveSheet()->setCellValue('D'.$low, $value1['month']);
                        $phpexcel->getActiveSheet()->setCellValue('E'.$low, $value1['month_0']);
                        $phpexcel->getActiveSheet()->setCellValue('F'.$low, $value1['month_1']);
                        $phpexcel->getActiveSheet()->setCellValue('G'.$low, $value1['month_6']);
                        $phpexcel->getActiveSheet()->setCellValue('H'.$low, $value1['month_2']);
                        $phpexcel->getActiveSheet()->setCellValue('I'.$low, $value1['month_3']);
                        $phpexcel->getActiveSheet()->setCellValue('J'.$low, $value1['month_4']);
                        $phpexcel->getActiveSheet()->setCellValue('K'.$low, $value1['month_5']);
                        $phpexcel->getActiveSheet()->setCellValue('L'.$low, $value1['insurance']);
                        $phpexcel->getActiveSheet()->setCellValue('M'.$low, $value1['year_end']);
                        $phpexcel->getActiveSheet()->setCellValue('N'.$low, $sum['dispatch'][$key][$key1]['month_0']);
                        $phpexcel->getActiveSheet()->setCellValue('O'.$low, $sum['dispatch'][$key][$key1]['month_1']);
                        $phpexcel->getActiveSheet()->setCellValue('P'.$low, $sum['dispatch'][$key][$key1]['month_other']);
                        $phpexcel->getActiveSheet()->setCellValue('Q'.$low, $sum['dispatch'][$key][$key1]['month_5']);
                        $phpexcel->getActiveSheet()->setCellValue('R'.$low, $sum['dispatch'][$key][$key1]['insurance']);
                        $phpexcel->getActiveSheet()->setCellValue('S'.$low, $sum['dispatch'][$key][$key1]['year_end']);
                        $phpexcel->getActiveSheet()->setCellValue('T'.$low, $sum['dispatch'][$key][$key1]['sum']);
                        $phpexcel->getActiveSheet()->setCellValue('U'.$low, $value1['remark']);
                    }
                }
            }
            $low++;
            $phpexcel->getActiveSheet()->setCellValue('B'.$low, '合计');
            $phpexcel->getActiveSheet()->setCellValue('N'.$low, $sum['dispatch']['sum']['month_0']?:'');
            $phpexcel->getActiveSheet()->setCellValue('O'.$low, $sum['dispatch']['sum']['month_1']?:'');
            $phpexcel->getActiveSheet()->setCellValue('P'.$low, $sum['dispatch']['sum']['month_other']?:'');
            $phpexcel->getActiveSheet()->setCellValue('Q'.$low, $sum['dispatch']['sum']['month_5']?:'');
            $phpexcel->getActiveSheet()->setCellValue('R'.$low, $sum['dispatch']['sum']['insurance']?:'');
            $phpexcel->getActiveSheet()->setCellValue('S'.$low, $sum['dispatch']['sum']['year_end']?:'');
            $phpexcel->getActiveSheet()->setCellValue('T'.$low, $sum['dispatch']['sum']['sum']?:'');
            $phpexcel->getActiveSheet()->getStyle('B'.$low)->getFont()->setColor(new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_RED ));
            $phpexcel->getActiveSheet()->getStyle('T'.$low)->getFont()->setColor(new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_RED ));$low++;
            $low++;
            $phpexcel->getActiveSheet()->setCellValue('B'.$low, '总计');
            $phpexcel->getActiveSheet()->setCellValue('T'.$low, $sum['dispatch']['sum']['sum']?:'');
            $phpexcel->getActiveSheet()->getStyle('B'.$low)->getFont()->setColor(new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_RED ));
            $phpexcel->getActiveSheet()->getStyle('T'.$low)->getFont()->setColor(new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_RED ));
            //设置边框样式
            $phpexcel->getActiveSheet()->getStyle('A3:U'.$low)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
        }

        //是否存在其它运行费用
        $is_yunxing=0;
        if(!empty($sum['yunxing']['sum']['sum'])) $is_yunxing=1;
        if($is_yunxing){
            $yunxing=$predict_info['data']['yunxing'];
            $phpexcel->createSheet();//新建一个页面
            $phpexcel->setActiveSheetIndex(++$index);
            //设置默认行高
            $phpexcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(25);

            $phpexcel->getActiveSheet()->setTitle('其它运行费用明细');
            $phpexcel->getActiveSheet()->setCellValue('A1', $predict_info['year'].'年其它运行费用明细表');
            $phpexcel->getActiveSheet()->setCellValue('A2', '编制单位:'.$village_name);
            for($i=0;$i<7;$i++){
                $phpexcel->getActiveSheet()->getColumnDimension(chr(65+$i))->setWidth(20);
            }
            $phpexcel->getActiveSheet()->setCellValue('B2', '金额：元');
            //合并单元格
            $phpexcel->getActiveSheet()->mergeCells('A1:B1');
            $title=array('项目明细','具体金额');
            $chr=64;//循环计数
            foreach ($title as $title_key=>$title_value){
                $chr++;
                $phpexcel->getActiveSheet()->setCellValue(chr($chr).'3', $title_value);
                $phpexcel->getActiveSheet()->getStyle(chr($chr).'3')->getFont()->setName('宋体');
                $phpexcel->getActiveSheet()->getStyle(chr($chr).'3')->getFont()->setBold(true);
            }
            $low=2;
            foreach ($yunxing[$key] as $key=>$value){
                $low++;
                $phpexcel->getActiveSheet()->setCellValue('A'.$low, $value['name']);
                $phpexcel->getActiveSheet()->setCellValue('D'.$low, $value['sum']);
            }
            //设置边框样式
            $phpexcel->getActiveSheet()->getStyle('A3:B'.$low)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
        }


        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=".$predict_info['year'].'年'.$village_name.'预算编制表.xls');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0
        $objwriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel5');
        $objwriter->save('php://output');
        /*unlink('./upload/qrcode/'.$predict_info['year'].'年'.$village_name.'预算编制表.xls');
        $objwriter->save('./upload/qrcode/'.$predict_info['year'].'年'.$village_name.'预算编制表.xls');*/
        exit;
    }
    public function apply_predict_one($predict_id){
        $Budget_moneyModel=new Budget_moneyModel();
        $Budget_logModel=new Budget_logModel();
        if(!empty($predict_id)){
            $predict_info=$this->get_predict_one(array('predict_id'=>$predict_id));
            if(empty($predict_info)) return array('err'=>1,'data'=>'所需修改条目不存在');
/*            if($predict_info['status']!=6) return array('err'=>1,'data'=>'该条目尚未通过审核,无法应用');*/
        }else{
            return array('err'=>1,'data'=>'参数不正确');
        }
        //删除当年的全部预算总金额条目
        $where=array('village_id'=>$predict_info['village_id'],'money_year'=>$predict_info['year']);
        if(!empty($predict_info['project_id'])) $where['project_id']=$predict_info['project_id'];
        $Budget_moneyModel->where($where)->delete();
        //删除已用金额不为0的缓存条目
        $where=array('village_id'=>$predict_info['village_id'],'log_time'=>$predict_info['year']);
        if(!empty($predict_info['project_id'])) $where['project_id']=$predict_info['project_id'];
        $log_list=$Budget_logModel->get_log_list($where);
        foreach ($log_list as $key=>$value){
            $log_data=unserialize($value['log_data']);
            if(empty($log_data['sum'])){
                $Budget_logModel->where(array('log_id'=>$value['log_id']))->delete();
            }
        }
//        dump($predict_info['data']);die;
        foreach ($predict_info['data'] as $key=>$value){
            if(is_numeric($key)&&$key!=1){//判断是否为数字且不为人员支出
                foreach ($value as $key1=>$value1){
                    foreach ($value1['children'] as $key2=>$value2){
                        $Budget_moneyModel->change_money_one($value2['type_data']['sum'],$key2,$predict_info['village_id'],$predict_info['company_id'],$predict_info['year'],$predict_info['project_id']);
                    }
                }
            }
        }
        //人员支出
        $personnel_output=$predict_info['data']['1'];
        //dump($personnel_output);die;
        $sum=array();
        foreach ($personnel_output as $key=>$value){
            if(is_numeric($key)){//排除sum
                foreach ($value as $key1=>$value1){
                    if(is_numeric($key1)){//排除sum
                        $sum[8] +=$value1['month_0']*$value1['month']*$value1['num']+$value1['year_end']*$value1['num'];//工资
                        //$sum[9]//绩效奖无
                        $sum[11] +=$value1['month_1']*$value1['month']*$value1['num'];//公司缴纳社保
                        $sum[12] +=$value1['month_8']*$value1['month']*$value1['num'];//社保补助
                        $sum[13] +=$value1['month_2']*$value1['month']*$value1['num'];//公积金
                        $sum[14] +=($value1['month_5']+$value1['month_7'])*$value1['month']*$value1['num'];//福利费
                        $sum[16] +=$value1['month_4']*$value1['month']*$value1['num'];//福利费
                        $sum[179] +=$value1['month_6']*$value1['month']*$value1['num'];//慰问费
                        $sum[187] +=$value1['month_3']*$value1['month']*$value1['num'];//餐补

                    }
                }
            }
        }
        $sum['10']=$predict_info['sum']['overtime']['sum']['sum'];//加班费
        $sum['175']=$predict_info['sum']['gongling']['sum']['sum'];//工龄
        //dump($sum);die;
        //应用刷新
        foreach ($sum as $key=>$value){
            $Budget_moneyModel->change_money_one($value,$key,$predict_info['village_id'],$predict_info['company_id'],$predict_info['year'],$predict_info['project_id']);
        }
        $this->where(array('predict_id'=>$predict_id))->data(array('is_apply'=>1))->save();//更新状态
        return array('err'=>0,'data'=>'更新成功');
    }
    /**
     * @author zhukeqin
     * @param string $str
     * @return int/float
     * 返回
     */
    public function get_number($str=''){
        $str=trim($str);
        if(empty($str)){return 0;}
        $temp=array('1','2','3','4','5','6','7','8','9','0','.');
        $result='';
        for($i=0;$i<strlen($str);$i++){
            if(in_array($str[$i],$temp)){
                $result.=$str[$i];
            }
        }
        if(empty($result)){
            return 0;
        }
        return $result;
    }
    /**
     * @author zhukeqin
     * @param $village_id
     * @param $project_id
     * @return array
     * 获取指定项目的部门列表
     */
    public function get_department_list($village_id,$project_id){
        $village_info=M('house_village')->where(array('village_id'=>$village_id))->find();
        $department_child_list=array();
        if($village_info['department_id']==89){
            $department_child_list=array(
                '1'=>array('name'=>'公司经理','type'=>1),
                '2'=>array('name'=>'技术部','type'=>1),
                '3'=>array('name'=>'运营部','type'=>1),
            );
        }elseif($village_info['department_id']==51){
            $department_child_list=array(
                '11'=>array('name'=>'管理部门','type'=>1,'children'=>array('编制公司总经理')),
                '1'=>array('name'=>'项目经理','type'=>1,'children'=>array('项目经理')),
                '2'=>array('name'=>'客服部','type'=>1,'children'=>array('经理','主管','领班','专员','助理')),
                '3'=>array('name'=>'工程部','type'=>1,'children'=>array('经理','主管','领班','技师','技工')),
                '4'=>array('name'=>'秩序维护部','type'=>1,'children'=>array('经理','主管','班长','秩序形象岗','秩序员')),
                '8'=>array('name'=>'保洁部','type'=>1,'children'=>array('主管','领班','保洁员')),
                '12'=>array('name'=>'其它','type'=>1),
                '5'=>array('name'=>'保洁部（外派）','type'=>2),
                '6'=>array('name'=>'食堂','type'=>2),
                '7'=>array('name'=>'后勤','type'=>2),
                '9'=>array('name'=>'司机','type'=>2),
                '10'=>array('name'=>'其它','type'=>2),
            );
        }else{
            $department_child_list=array(
                '1'=>array('name'=>'项目经理','type'=>1,'children'=>array('项目经理')),
                '2'=>array('name'=>'客服部','type'=>1,'children'=>array('经理','主管','领班','专员','助理')),
                '3'=>array('name'=>'工程部','type'=>1,'children'=>array('经理','主管','领班','技师','技工')),
                '4'=>array('name'=>'秩序维护部','type'=>1,'children'=>array('经理','主管','班长','秩序形象岗','秩序员')),
                '8'=>array('name'=>'保洁部','type'=>1,'children'=>array('主管','领班','保洁员')),
                '12'=>array('name'=>'其它','type'=>1),
                '5'=>array('name'=>'保洁部（外派）','type'=>2),
                '6'=>array('name'=>'食堂','type'=>2),
                '7'=>array('name'=>'后勤','type'=>2),
                '9'=>array('name'=>'司机','type'=>2),
                '10'=>array('name'=>'其它','type'=>2),
            );
        }
        return $department_child_list;
    }
}