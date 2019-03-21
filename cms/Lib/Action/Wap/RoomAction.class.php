<?php
/**
 * 专业设备管理模块
 * @update-time: 2018-11-07 15:38:45
 * @author: libin
 */

class RoomAction extends BaseAction
{   
    /**
     *多角色权限处理后扫码后跳转方法
     *
     */
    public function meter_bind_card() 
    {           
        $model = M('re_setmeter_config_custom');

        // $data = $_GET;
        $meter_hash = I('get.meter_hash');
        // var_dump($meter_hash);

        $meter = M('house_village_meters')->where(array('meter_hash'=>$meter_hash))->select();
        //设备id
        $id = $meter[0]['id'];
        // var_dump($id);       
        $openid = session('openid');
        // $id = 2049;
        // $openid = 'ohgcf0lvS3Ht7vH5n9PXbr5AEKtU';
        
        //查询当前设备的基本配置
        $meter_config = $meter;
        foreach ($meter_config as $key => $val) {
            $meter_type = M('re_setmeter_config')->where(array('id'=>$val['meter_type_id']))->getField('desc');
            $meter_config[$key]['meter_type'] = $meter_type;
            $cate_type = M('house_village_meter_cate')->where(array('id'=>$val['cate_id']))->getField('desc');
            $meter_config[$key]['cate_type'] = $cate_type;
            $configArr = M('house_village_meters_custom')->where(array('meter_hash'=>$val['meter_hash']))->select();
            $meter_config[$key]['configArr'] = $configArr;
        }
        foreach ($meter_config as $key => $va) {
            foreach ($va['configArr'] as $k => $v) {
                $desc = M('re_setmeter_config_custom')->where(array('id'=>$v['custom_id']))->select()[0]['desc'];
                $meter_config[$key]['configArr'][$k]['desc'] = $desc;
                // var_dump($desc);exit;
                              
            }
        }
        $this->assign('meter_config',$meter_config);

        //检查人
        $user_uid = D('user')->where(array('openid'=>$openid))->getField('uid');        
        if ($user_uid) {
            $name = D('user')->where(array('openid'=>$openid))->getField('truename');
            if (empty($name)) $name = D('house_village_user_bind')->where(array('uid'=>$user_uid))->getField('name');
            if (empty($name)) $name = D('admin')->where(array('openid'=>$openid))->getField('realname');
            if ($name) $this->assign('name',$name);
        }

        //时间
        $time = date('Y-m-d H:i:s');
        $this->assign('time',$time);

        //设备的基本信息
        $data = M('house_village_meters')
            ->alias('m')
            ->field(array('m.*','c.desc as desc_bind','g.desc','c.sign'))
            ->join('LEFT JOIN __HOUSE_VILLAGE_METER_CATE__ c on c.id=m.cate_id')
            ->join('LEFT JOIN __RE_SETMETER_CONFIG__ g on g.id=m.meter_type_id')
            ->where(array('m.id' => $id))
            ->select();
        // var_dump($data);
        // var_dump(M()->_sql());

        $cate_id = $data[0]['cate_id'];
        //二级参数
        $data_2 = $model->where(array('cate_id'=>$cate_id))->select();
        //循环，获取三级参数
        // $data_3 = array();
        foreach ($data_2 as $k => &$v) {
            $v['parameters'] = $model->where(array('cate_id'=>$v['id'],'is_use'=>1))->select();
        }
        unset($v);
        // var_dump($data_2);
        // exit;

        $this->assign('data',$data);
        $this->assign('data_2',$data_2);
        $this->display();
    }

    /**
     * 处理巡检点位提交信息
     */
    public function deal_meter_bind_card() {

        //确定提交人的身份
        $openid = session('openid');
        $adminRole = M('admin')->where(array('openid'=>$openid))->getField('role_id');
        $role_idArr = explode(',',$adminRole);
        if (in_array(85, $role_idArr)) {
            //表单数据
            $data = $_POST;
            // var_dump($data);
            // exit;
             
            //确定要提交的表名
            $table_name = $data['sign'].'_config_record';       
            // var_dump($table_name);

            //判断该点位是否已经检查过了
            //当天班的时间戳
            //已经检查的点位
            $nowTime = time();
            if($nowTime>=strtotime(date('Y-m-d').'08:00')&&$nowTime<strtotime(date('Y-m-d').'12:00')){
                $nowDays = strtotime(date('Y-m-d').'08:00');
                $nowDaye = strtotime(date('Y-m-d').'12:00');
            }elseif ($nowTime>=strtotime(date('Y-m-d').'12:00')&&$nowTime<strtotime(date('Y-m-d').'18:00')){
                $nowDays = strtotime(date('Y-m-d').'12:00');
                $nowDaye = strtotime(date('Y-m-d').'18:00');
            }elseif ($nowTime>=strtotime(date('Y-m-d').'18:00')&&$nowTime<=strtotime(date('Y-m-d').'23:59')){
                $nowDays = strtotime(date('Y-m-d').'18:00');
                $nowDaye = strtotime(date('Y-m-d').'23:59');
            }elseif ($nowTime>=strtotime('+1 day',strtotime(date('Y-m-d').'01:00'))&&$nowTime<strtotime('+1 day',strtotime(date('Y-m-d').'08:00'))){
                $nowDays = strtotime('+1 day',strtotime(date('Y-m-d').'01:00'));
                $nowDaye = strtotime('+1 day',strtotime(date('Y-m-d').'08:00'));
            }
            //检查数据是否存在
            $is_check = M($table_name)->where(array('meter_id'=>$data['meter_id'],'check_time'=>array('between',array($nowDays,$nowDaye))))->find();
            
            $data['check_time'] = $nowTime;
            
            //声音和低压侧母字段的判断与值处理
            if ($data['sign'] == 'byq') {
                if ($data['voice']) {
                    $data['Vo_100'] = 1;
                    $data['Vw_101'] = 0;
                    unset($data['voice']);           
                } else {
                    $data['Vo_100'] = 0;
                    $data['Vw_101'] = 1; 
                }
                if ($data['ohm']) {
                    $data['Oo_102'] = 1;
                    $data['Ow_103'] = 0;
                    unset($data['ohm']);
                } else {
                    $data['Oo_102'] = 0;
                    $data['Ow_103'] = 1;
                }
            }
            unset($data['sign']);
            
            // var_dump($data);
            // exit;
            //填入表单的数据
            if ($is_check) {
                $res = M($table_name)->where(array('id'=>$is_check['id']))->data($data)->save();
            } else {
               $res = M($table_name)->data($data)->add(); 
            }
            // var_dump(M()->_sql());
            if($res){
                $this->success('提交成功',$data);
            }else{
                $this->error('提交失败',$data);
            }
        } else {
            $this->error('对不起，您没有权限！');
        }

    }


    /**
     * 处理巡检点位提交信息
     */
    public function meter_record_list() {
        //获取设备绑定类型
        $cateArr = M('house_village_meter_cate')->where(array('meter_type_id'=>113))->select();
        $son = array();
        foreach ($cateArr as $k => $v) {
            $son = M('house_village_meters')->where(array('cate_id'=>$v['id']))->select();
            $cateArr[$k]['son'] = $son;
        }
        $this->assign('cateArr',$cateArr);
        // var_dump($cateArr);
         
        //对班次进行判断，未设置则使用默认班次
        if(isset($_GET['d_time'])&&!isset($_GET['work_time'])){
            $thisDayStart = strtotime($_GET['d_time'])+8*3600;
            $thisDayEnd = strtotime($_GET['d_time'])+32*3600;
            $this->assign('w_time',1);
        }elseif (!isset($_GET['d_time'])&&isset($_GET['work_time'])){
            if($_GET['work_time'] == 1){
                $thisDayStart = strtotime(date('Y-m-d').'08:00');
                $thisDayEnd =strtotime(date('Y-m-d').'12:00');
                $this->assign('w_time',1);
            }elseif ($_GET['work_time'] == 2){
                $thisDayStart = strtotime(date('Y-m-d').'12:00');
                $thisDayEnd =strtotime(date('Y-m-d').'18:00');
                $this->assign('w_time',2);
            }elseif ($_GET['work_time'] == 3){
                $thisDayStart = strtotime(date('Y-m-d').'18:00');
                $thisDayEnd =strtotime(date('Y-m-d').'23:59');
                $this->assign('w_time',3);
            }else{
                $thisDayStart = strtotime('+1 day',strtotime(date('Y-m-d').'01:00'));
                $thisDayEnd =strtotime('+1 day',strtotime(date('Y-m-d').'08:00'));
                $this->assign('w_time',4);
            }
        }elseif (isset($_GET['d_time'])&&isset($_GET['work_time'])){
            if($_GET['work_time'] == 1){
                $thisDayStart = strtotime($_GET['d_time'].'08:00');
                $thisDayEnd =strtotime($_GET['d_time'].'12:00');
                $this->assign('w_time',1);
            }elseif ($_GET['work_time'] == 2){
                $thisDayStart = strtotime($_GET['d_time'].'12:00');
                $thisDayEnd =strtotime($_GET['d_time'].'18:00');
                $this->assign('w_time',2);
            }elseif ($_GET['work_time'] == 3){
                $thisDayStart = strtotime($_GET['d_time'].'18:00');
                $thisDayEnd =strtotime($_GET['d_time'].'23:59');
                $this->assign('w_time',3);
            }else{
                $thisDayStart = strtotime('+1 day',strtotime($_GET['d_time'].'01:00'));
                $thisDayEnd = strtotime('+1 day',strtotime($_GET['d_time'].'08:00'));
                $this->assign('w_time',4);
            }
        }else{
            //如果没有任何选项则进入当前当班的统计
            $nowTime = time();
            if($nowTime>=strtotime(date('Y-m-d').'08:00')&&$nowTime<strtotime(date('Y-m-d').'12:00')){
                $thisDayStart = strtotime(date('Y-m-d').'08:00');
                $thisDayEnd = strtotime(date('Y-m-d').'12:00');
                $this->assign('w_time',1);
            }elseif ($nowTime>=strtotime(date('Y-m-d').'12:00')&&$nowTime<strtotime(date('Y-m-d').'18:00')){
                $thisDayStart = strtotime(date('Y-m-d').'12:00');
                $thisDayEnd = strtotime(date('Y-m-d').'18:00');
                $this->assign('w_time',2);
            }elseif ($nowTime>=strtotime(date('Y-m-d').'18:00')&&$nowTime<=strtotime(date('Y-m-d').'23:59')){
                $thisDayStart = strtotime(date('Y-m-d').'18:00');
                $thisDayEnd = strtotime(date('Y-m-d').'23:59');
                $this->assign('w_time',3);
            }elseif ($nowTime>=strtotime('+1 day',strtotime(date('Y-m-d').'01:00'))&&$nowTime<strtotime('+1 day',strtotime(date('Y-m-d').'08:00'))){
                $thisDayStart = strtotime('+1 day',strtotime(date('Y-m-d').'01:00'));
                $thisDayEnd = strtotime('+1 day',strtotime(date('Y-m-d').'08:00'));
                $this->assign('w_time',4);
            }
        }

        // $a = date('Y-m-d H:i:s', $thisDayStart);
        // $b = date('Y-m-d H:i:s', $thisDayEnd);
        // var_dump($a);
        // var_dump($b);        

        //对类型进行判断，未设置则查询所有
        if (isset($_GET['choose_cate'])&&($_GET['choose_cate'] != '')) {
            $cate_id = $_GET['choose_cate'];
        } else {
            $meter_type_id = 113;
        }
        $choose_cate = $cate_id;
        $this->assign('choose_cate',$choose_cate);               

        //获取类型下所有设备
        
        $is_check = M('house_village_meter_cate')->where(array('id'=>$cate_id))->select();
        if ($is_check || $meter_type_id) {
            //查询所有的设备
            $meterArr = array();
            if ($cate_id) {            
                $meterArr[] = M('house_village_meters')->where(array('cate_id'=>$cate_id))->select();
            }
            if ($meter_type_id) {
                $cateAr = M('house_village_meter_cate')->where(array('meter_type_id'=>$meter_type_id))->select();
                
                foreach ($cateAr as $k => $v) {
                    $meterArr[] = M('house_village_meters')->where(array('cate_id'=>$v['id']))->select();
                }
            }
            // var_dump($meterArr);
            //查询设备的基本信息(二级参数)
            $cateArray = array();
            foreach ($meterArr as $key => $value) {
                foreach ($value as $k => $v) {
                    $cate_id = $v['cate_id'];               
                    $cateArray = M('re_setmeter_config_custom')->where(array('cate_id'=>$cate_id))->select();
                    $meterArr[$key][$k]['cateArray'] = $cateArray;
                }           
            }
            // var_dump($meterArr);
            //查询设备的基本信息(三级参数)
            $childArr = array();
            foreach ($meterArr as $key => $value) {
                foreach ($value as $ke => $val) {
                    $meter_id = $val['id'];
                    $field = M('house_village_meter_cate')->where(array('id'=>$val['cate_id']))->getField('sign');
                    //获得表名               
                    $table_name = $field.'_config_record';

                    foreach ($val['cateArray'] as $k => $v) {
                        $childArr = M('re_setmeter_config_custom')->where(array('cate_id'=>$v['id']))->select();
                        foreach ($childArr as $key1 => $va) {
                            $field1 = $va['key'].'_'.$va['id'];
                            // var_dump($field1);
                            $parameter = M($table_name)->where(array('meter_id'=>$meter_id,'check_time'=>array('between',array($thisDayStart,$thisDayEnd))))->getField($field1);
                            // var_dump($parameter);
                            // var_dump(M()->_sql());
                            if (!$parameter) {
                                $parameter = 0;
                            }
                            $childArr[$key1]['parameter'] = $parameter;
                        }                                       
                        $meterArr[$key][$ke]['cateArray'][$k]['child'] = $childArr;
                    }
                }
            }
        } else {
            //查询设备的基本信息
            $meterArr = array();
            $meter = M('house_village_meters')->where(array('id'=>$cate_id))->select();
            $meter_config = $meter;
            $meterArr[] = $meter;
            $this->assign('meter',1);

            //查询当前设备的基本配置
            foreach ($meter_config as $key => $val) {
                $meter_type = M('re_setmeter_config')->where(array('id'=>$val['meter_type_id']))->getField('desc');
                $meter_config[$key]['meter_type'] = $meter_type;
                $cate_type = M('house_village_meter_cate')->where(array('id'=>$val['cate_id']))->getField('desc');
                $meter_config[$key]['cate_type'] = $cate_type;
                $configArr = M('house_village_meters_custom')->where(array('meter_hash'=>$val['meter_hash']))->select();
                //剔除信息为空的数据          
                foreach ($configArr as $k => $v) {               
                    if ($v['val'] == '') {
                        unset($configArr[$k]);
                    }
                }
                $meter_config[$key]['configArr'] = $configArr;
            }
            foreach ($meter_config as $key => $va) {
                foreach ($va['configArr'] as $k => $v) {
                    $desc = M('re_setmeter_config_custom')->where(array('id'=>$v['custom_id']))->getField('desc');
                    $meter_config[$key]['configArr'][$k]['desc'] = $desc;              
                }
            }
            $this->assign('meter_config',$meter_config);            
            // var_dump($meter_config);
            
            // var_dump($meter);
            //该设备的二级参数
            $cateArray = array();
            foreach ($meterArr as $key => $val) {
                foreach ($val as $k => $v) {
                    $cateArray = M('re_setmeter_config_custom')->where(array('cate_id'=>$v['cate_id']))->select();
                    $meterArr[$key][$k]['cateArray'] = $cateArray;
                }               
            }           
            // var_dump($meterArr);
            //查询设备的基本信息(三级参数)
            $childArr = array();
            foreach ($meterArr as $key => $value) {
                foreach ($value as $ke => $val) {
                    // var_dump($val);
                    if (!$val) {
                        continue;
                    }
                    $meter_id = $val['id'];
                    $field = M('house_village_meter_cate')->where(array('id'=>$val['cate_id']))->getField('sign');
                    //获得表名               
                    $table_name = $field.'_config_record';
                    // var_dump($table_name);
                    // var_dump($val['cateArray']);
                    foreach ($val['cateArray'] as $k => $v) {
                        $childArr = M('re_setmeter_config_custom')->where(array('cate_id'=>$v['id'],'is_use'=>1))->select();
                        foreach ($childArr as $key1 => $va) {
                            $field1 = $va['key'].'_'.$va['id'];
                            $parameter = M($table_name)->where(array('meter_id'=>$meter_id,'check_time'=>array('between',array($thisDayStart,$thisDayEnd))))->getField($field1);
                            // var_dump(M()->_sql());
                            if (!$parameter) {
                                $parameter = 0;
                            }
                            $childArr[$key1]['parameter'] = $parameter;
                        }                                       
                        $meterArr[$key][$ke]['cateArray'][$k]['child'] = $childArr;
                    }
                }
            }                      
        }
        // var_dump($meterArr);
          
        $this->assign('meterArr',$meterArr);
        $this->display();
    }













}