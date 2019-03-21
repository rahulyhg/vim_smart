<?php

class AccessAction extends BaseAction{

    public function access_index(){
		if(IS_POST){
			if(intVal($_POST['ac_status'])==1){
				$ac_status=2;
			}else{
				$ac_status=1;
			}
			$alter_control=M('Access_control')->where(array('ac_id'=>$_POST['ac_id']))->data(array('ac_status'=>$ac_status))->save();
			if($alter_control){
				$this->ajaxReturn(array('msg_code'=>0,'msg_data'=>'改变成功！'));
			}else{
				$this->ajaxReturn(array('msg_code'=>1,'msg_data'=>'改变失败！'));
			}
		}else{
			$access_list = D('Access_control')->getlist();
            foreach ($access_list['access_list'] as &$v){
                $terrace_array = M('terrace')->where(array('is_del'=>0,'is_use'=>1))->find();
                M('access_control')->where(array('ac_id'=>$v['ac_id']))->data(array('terrace_id'=>$terrace_array['pigcms_id']))->save();
                $v['terrace_id'] = $terrace_array['terrace_name'];
            }
            unset($v);
			$this->assign('access_list',$access_list);
			$this->display();
		}     
    }

    public function _before_access_index_news(){
        if(session('system.account')==SUPER_ADMIN){
            $this->assign('admin',1);
            $villageArray = M('house_village')->where(array('status'=>1))->select();
            $this->assign('villageArray',$villageArray);
            if(I('get.village_id')){
                $presentVillage = M('house_village')->find(I('get.village_id'))['village_name'];
            }else{
                $presentVillage = '全部显示';
            }
        }else{
            $this->assign('admin',0);
            $presentVillage = M('house_village')->find(session('system.village_id'))['village_name'];

        }

        $this->assign('presentVillage',$presentVillage);


    }

    public function access_index_news(){
        if(IS_POST){
            if(intVal($_POST['ac_status'])==1){
                $ac_status=2;
            }else{
                $ac_status=1;
            }
            $alter_control=M('Access_control')->where(array('ac_id'=>$_POST['ac_id']))->data(array('ac_status'=>$ac_status))->save();
            if($alter_control){
                $this->ajaxReturn(array('msg_code'=>0,'msg_data'=>'改变成功！'));
            }else{
                $this->ajaxReturn(array('msg_code'=>1,'msg_data'=>'改变失败！'));
            }
        }else{
            $model = new Access_controlModel();
            $village_id = filter_village(0,2,'');
            //dump($_SESSION);exit;
            $access_list = $model->getlist($village_id);
//            dump($village_id);
//            dump($access_list);exit;
            foreach ($access_list['access_list'] as &$v){
                $terrace_array = M('terrace')->where(array('is_del'=>0,'is_use'=>1))->find();
                M('access_control')->where(array('ac_id'=>$v['ac_id']))->data(array('terrace_id'=>$terrace_array['pigcms_id']))->save();
                $v['terrace_id'] = $terrace_array['terrace_name'];
            }
            unset($v);
            //智慧门禁异常开关页面
            $door_state = M('config')->where(array('name'=>'door_state'))->getField('value');
            $this->door_state = $door_state;
            //$this->assign('door_state',$door_state);
            $this->assign('access_list',$access_list);
            $this->display();
        }
    }

    public function close_door(){
        $door_state = M('config')->where(array('name'=>'door_state'))->getField('value');
        if($door_state == '1'){
            M('config')->where(array('name'=>'door_state'))->data(array('value'=>'0'))->save();
            echo '0';
        }else{
            M('config')->where(array('name'=>'door_state'))->data(array('value'=>'1'))->save();
            echo '1';
        }
    }
    /**
     * 门禁编辑
     * 陈琦
     * 2016.6.14
     */
    public function access_edit(){
        if($_POST){
			if($_GET['isajax']){			
				$access_categorys = M('access_control_group')->where(array('village_id'=>$_POST['village_id']))->select();
				echo json_encode(array('err_code'=>0,'code_data'=>$access_categorys));		
				exit;
			}
            $ac_id = $_POST['ac_id'];
            $data['ac_name'] = trim(I('ac_name'));
            $data['apikey'] = trim(I('apikey'));
            $data['actype_id']=trim(I('actype_id'));
            $data['actype_name']=trim(I('actype_name'));
            $data['nodeid'] = trim(I('nodeid'));
            $data['ac_time'] = $_SERVER['REQUEST_TIME'];
            $data['ac_status'] = trim(I('ac_status'));
            $data['ag_id'] = trim(I('ag_id'));
            $data['ag_name'] = trim(I('ag_name'));
            $data['village_id'] = trim(I('village_id'));
            $data['ac_desc'] = trim(I('ac_desc'));
            $data['terrace_id'] = trim(I('terrace_id'));
            $data['unios_act'] = trim(I('unios_act'));
            $data['unios_pin'] = trim(I('unios_pin'));
            if(empty($data['ac_name'])){
                $this->error('名称不能为空');
            }else if(!(preg_match("/[\x{4e00}-\x{9fa5}]/u",$data['ac_name']))){
                $this->error('名称格式有误，请重填！');
                return false;
            }
            if(empty($data['apikey'])){
                $this->error('apikey不能为空');
            }/*else if(!(preg_match("^[A-Za-z0-9]$",$data['apikey']))){
                $this->error('apikey格式有误，请重填！');
                return false;
            }*/
            if(empty($data['nodeid'])){
                $this->error('节点ID不能为空');
            }else if(!(preg_match("/^(0|[1-9][0-9]*)$/",$data['nodeid']))){
                $this->error('节点ID格式有误，请重填！');
                return false;
            }

            if(empty($data['village_id'])){
                $this->error('请先选择社区！');
            }
            if(empty($data['ag_id'])){
                $this->error('该社区暂无门禁区域，请先添加区域！');
            }
            if($ac_id){
                $result = M('access_control')->where('ac_id='.$ac_id)->data($data)->save();
                if($result){
                    $this->success('编辑成功！');
                }else{
                    $this->error('编辑失败！请重试。');
                }
            }else{
                $result = M('access_control')->data($data)->add();
                if($result){
                    $this->success('添加成功！');
                }else{
                    $this->error('添加失败！请重试。');
                }
            }
            /*$device = D('access_control_type')->where(array('actype_id'=>$_POST['actype_id']))->find();
            import('@.ORG.Yeelink');
            $yeelink=new Yeelink($apikey=$_POST['apikey'],$deviceid=$_POST['nodeid']);
            $ac_control=array('ac_name'=>$_POST['ac_name'],'ac_desc'=>$_POST['ac_desc']);
            if($ac_id){
                $arr= $yeelink->saveSensor($ac_control,$sensorid=$_POST['sensorid']);
                $result = M('access_control')->where('ac_id='.$ac_id)->data($data)->save();
                if($result >= 0){
                    $this->success('修改成功！',U('Access/access_index'));
                }else{
                    $this->error('修改失败！请重试。');
                }
            }else{
                $ac_type=array('actype_value'=>$device['actype_value']);
                $yeelink_arr= $yeelink->saveSensor($ac_control,$sensorid='',$ac_type);
              //  print_r($yeelink_arr);exit;
                $data['sensorid']=$yeelink_arr['sensor_id'];
                if(!$yeelink_arr['sensor_id']){
                    $this->error($yeelink_arr['error']);
                }
                $result = M('access_control')->data($data)->add();
                if($result){
                    $this->success('添加成功！',U('Access/access_index'));
                }else{
                    $this->error('添加失败！请重试。');
                }
            }*/
        }else{
            $ac_id = $_GET['ac_id'];
            if($ac_id){
                $condition_table = array(C('DB_PREFIX') . 'access_control' => 'n',C('DB_PREFIX').'house_village'=>'v');
                $condition_where = " n.village_id = v.village_id and n.ac_id='$ac_id' ";
                $condition_field = 'n.*,v.village_name';
                $access_info = D('')->table($condition_table)->where( $condition_where)->field($condition_field)->find();
                // dump($access_info);exit;
                $terrace_array = M('terrace')->where(array('is_del'=>0))->select();
                $village=D('house_village')->where(array('village_id'=>$access_info['village_id']))->find();
                $device=D('access_control_type')->where(array('actype_id'=>$access_info['actype_id']))->find();
                $access_categorys = M('access_control_group')->where(array('village_id'=>$access_info['village_id']))->select();
                $this->assign('village', $village);

                $this->assign('device', $device);
                $this->assign('access_info',$access_info);
                $this->assign('access_categorys',$access_categorys);
            }
            //$ct=M('house_commontype')->where('village_id='.$condition['village_id'])->select();
            //$access_categorys = M('access_control_group')->select();
            $terrace_array = M('terrace')->where(array('is_del'=>0))->select();
            $village_categorys=D('house_village')->select();
            $device_categorys=D('access_control_type')->select();
            $this->assign('device_categorys',$device_categorys);
            $this->assign('village_categorys', $village_categorys);
            $this->assign('terrace_array', $terrace_array);
            //$this->assign('access_categorys',$access_categorys);
            $this->display();
        }
    }

    public function access_edit_news(){
        if($_POST){
            if($_GET['isajax']){
                $access_categorys = M('access_control_group')->where(array('village_id'=>$_POST['village_id']))->select();
                echo json_encode(array('err_code'=>0,'code_data'=>$access_categorys));
                exit;
            }
            $ac_id = $_POST['ac_id'];
            $data['ac_name'] = trim(I('ac_name'));
            $data['apikey'] = trim(I('apikey'));
            $data['actype_id']=trim(I('actype_id'));
            $data['actype_name']=trim(I('actype_name'));
            $data['nodeid'] = trim(I('nodeid'));
            $data['ac_time'] = $_SERVER['REQUEST_TIME'];
            $data['ac_status'] = trim(I('ac_status'));
            $data['ag_id'] = trim(I('ag_id'));
            $data['ag_name'] = trim(I('ag_name'));
            $data['village_id'] = trim(I('village_id'));
            $data['ac_desc'] = trim(I('ac_desc'));
            $data['terrace_id'] = trim(I('terrace_id'));
            $data['unios_act'] = trim(I('unios_act'));
            $data['unios_pin'] = trim(I('unios_pin'));
            $data['duration'] = trim(I('duration'));
            $data['assignment_token'] = trim(I('assignment_token'));
            //vd($data);exit;
            if(empty($data['ac_name'])){
                $this->error('名称不能为空');
            }else if(!(preg_match("/[\x{4e00}-\x{9fa5}]/u",$data['ac_name']))){
                $this->error('名称格式有误，请重填！');
                return false;
            }
            if(empty($data['apikey'])){
                $this->error('apikey不能为空');
            }/*else if(!(preg_match("^[A-Za-z0-9]$",$data['apikey']))){
                $this->error('apikey格式有误，请重填！');
                return false;
            }*/
            /*if(empty($data['nodeid'])){
                $this->error('节点ID不能为空');
            }else if(!(preg_match("/^(0|[1-9][0-9]*)$/",$data['nodeid']))){
                $this->error('节点ID格式有误，请重填！');
                return false;
            }*/

            if(empty($data['village_id'])){
                $this->error('请先选择社区！');
            }
            if(empty($data['ag_id'])){
                $this->error('该社区暂无门禁区域，请先添加区域！');
            }
            if($ac_id){
                $result = M('access_control')->where('ac_id='.$ac_id)->data($data)->save();
                if($result){
                    $this->success('编辑成功！',U('Access/access_index_news'));
                }else{
                    $this->error('编辑失败！请重试。');
                }
            }else{
                $result = M('access_control')->data($data)->add();
                if($result){
                    $this->success('添加成功！',U('Access/access_index_news'));
                }else{
                    $this->error('添加失败！请重试。');
                }
            }
        }else{
            $ac_id = $_GET['ac_id'];
            if($ac_id){
                $condition_table = array(C('DB_PREFIX') . 'access_control' => 'n',C('DB_PREFIX').'house_village'=>'v');
                $condition_where = " n.village_id = v.village_id and n.ac_id='$ac_id' ";
                $condition_field = 'n.*,v.village_name';
                $access_info = D('')->table($condition_table)->where( $condition_where)->field($condition_field)->find();
                // dump($access_info);exit;
                $terrace_array = M('terrace')->where(array('is_del'=>0))->select();
                $village=D('house_village')->where(array('village_id'=>$access_info['village_id']))->find();
                $device=D('access_control_type')->where(array('actype_id'=>$access_info['actype_id']))->find();
                $access_categorys = M('access_control_group')->where(array('village_id'=>$access_info['village_id']))->select();
                $this->assign('village', $village);

                $this->assign('device', $device);
                $this->assign('access_info',$access_info);
                $this->assign('access_categorys',$access_categorys);
            }
            //$ct=M('house_commontype')->where('village_id='.$condition['village_id'])->select();
            //$access_categorys = M('access_control_group')->select();
            $terrace_array = M('terrace')->where(array('is_del'=>0))->select();
            $village_categorys=D('house_village')->select();
            $device_categorys=D('access_control_type')->select();
            $this->assign('device_categorys',$device_categorys);
            $this->assign('village_categorys', $village_categorys);
            $this->assign('terrace_array', $terrace_array);
            //$this->assign('access_categorys',$access_categorys);
            $this->display();
        }
    }
    /**
     * 门禁删除
     * 陈琦
     * 2016.6.14
     */
    public function access_del(){

        $ac_id = I('get.ac_id');
        $device=M('access_control')->where('ac_id='.$ac_id)->find();
        import('@.ORG.Yeelink');//引入接口
        $yeelink=new Yeelink($apikey=$device['apikey'],$deviceid=$device['nodeid']);//传入apikey、节点id
        $yeelink_arr= $yeelink->delSensor($sensorid=$device['sensorid']);//调用该类内删除传感器的方法，并传入传感器id
        $del = M('access_control')->where('ac_id='.$ac_id)->delete();
        if($del){
            $this->success('删除成功！');
        }else{
            $this->error('删除失败！请重试。');
        }

    }

    /**
     * 区域管理列表
     * 陈琦
     * 2016.6.14
     */
    public function group_index(){
        $condition_table = array(C('DB_PREFIX') . 'access_control_group' => 'c',C('DB_PREFIX').'house_village'=>'v');
        $condition_where = " c.village_id = v.village_id ";
        $condition_field = 'c.*,v.village_name';
        import('@.ORG.system_page');
        $count_group = D('')->table($condition_table)->where($condition_where)->count();
        $p = new Page($count_group, 15, 'page');
		$order='c.ag_id desc ';
        $group_info = D('')->table($condition_table)->where($condition_where)->field($condition_field)->order($order)->limit($p->firstRow.','.$p->listRows)->select();
        $this->assign('group_info', $group_info);
        $pagebar = $p->show();
        $this->assign('pagebar', $pagebar);
        $this->display();
    }

    public function group_index_news(){
        $condition_table = array(C('DB_PREFIX') . 'access_control_group' => 'c',C('DB_PREFIX').'house_village'=>'v');
        $condition_where = " c.village_id = v.village_id ";
        $condition_field = 'c.*,v.village_name';
        import('@.ORG.system_page');
        $count_group = D('')->table($condition_table)->where($condition_where)->count();
        $p = new Page($count_group, 15, 'page');
        $order='c.ag_id desc ';
        $group_info = D('')->table($condition_table)->where($condition_where)->field($condition_field)->order($order)->limit($p->firstRow.','.$p->listRows)->select();
        $this->assign('group_info', $group_info);
        $pagebar = $p->show();
        $this->assign('pagebar', $pagebar);
        $this->display();
    }
    /**
     * 区域编辑
     * 陈琦
     * 2016.6.14
     */
    public function group_edit(){      
        if($_POST){
            $ag_id = $_POST['ag_id'];
            $_POST['ag_name'] = trim(I('ag_name'));
            $_POST['ag_desc'] = trim(I('ag_desc'));
            if(empty($_POST['ag_name'])){
                $this->error('区域名称不能为空');
            }
            if(empty($_POST['village_id'])){
                $this->error('请先选择社区！');
            }
            if($ag_id){
                $condition_village['village_id'] = $_POST['village_id'];
                $condition_village['ag_name'] = $_POST['ag_name'];
                $condition_village['ag_desc'] = $_POST['ag_desc'];
                $result = M('access_control_group')->where('ag_id='.$ag_id)->data($condition_village)->save();
                if($result >= 0){
                    $this->success('修改成功！',U('Access/group_index'));
                }else{
                    $this->error('修改失败！请重试。');
                }
            }else{
                //$add['ag_time'] = $_SERVER['REQUEST_TIME'];
                $add['village_id'] = $_POST['village_id'];
                $add['ag_name'] = $_POST['ag_name'];
                $add['ag_desc'] = $_POST['ag_desc'];
                $result = M('access_control_group')->data($add)->add();
                if($result){
                    $this->success('添加成功！',U('Access/group_index'));
                }else{
                    $this->error('添加失败！请重试。');
                }
            }
        }else{
			$ag_id = $_GET['ag_id'];
			$condition_table = array(C('DB_PREFIX') . 'access_control_group' => 'm',C('DB_PREFIX').'house_village'=>'v');
			$condition_where = "m.village_id = v.village_id and m.ag_id='$ag_id' ";
			$condition_field = 'm.*,v.village_name';
			$group_info = D('')->table($condition_table)->where( $condition_where)->field($condition_field)->find();
			$village_categorys=D('house_village')->select();
			$village=D('house_village')->where(array('village_id'=>$group_info['village_id']))->find();
			$this->assign('group_info',$group_info);
			$this->assign('village_categorys', $village_categorys);
			$this->assign('village', $village);
            $this->display();
        }
    }

    public function group_edit_news(){
        if($_POST){
            $ag_id = $_POST['ag_id'];
            $_POST['ag_name'] = trim(I('ag_name'));
            $_POST['ag_desc'] = trim(I('ag_desc'));
            if(empty($_POST['ag_name'])){
                $this->error('区域名称不能为空');
            }
            if(empty($_POST['village_id'])){
                $this->error('请先选择社区！');
            }
            if($ag_id){
                $condition_village['village_id'] = $_POST['village_id'];
                $condition_village['ag_name'] = $_POST['ag_name'];
                $condition_village['ag_desc'] = $_POST['ag_desc'];
                $result = M('access_control_group')->where('ag_id='.$ag_id)->data($condition_village)->save();
                if($result >= 0){
                    $this->success('修改成功！');
                }else{
                    $this->error('修改失败！请重试。');
                }
            }else{
                //$add['ag_time'] = $_SERVER['REQUEST_TIME'];
                $add['village_id'] = $_POST['village_id'];
                $add['ag_name'] = $_POST['ag_name'];
                $add['ag_desc'] = $_POST['ag_desc'];
                $result = M('access_control_group')->data($add)->add();
                if($result){
                    $this->success('添加成功！');
                }else{
                    $this->error('添加失败！请重试。');
                }
            }
        }else{
            $ag_id = $_GET['ag_id'];
            $condition_table = array(C('DB_PREFIX') . 'access_control_group' => 'm',C('DB_PREFIX').'house_village'=>'v');
            $condition_where = "m.village_id = v.village_id and m.ag_id='$ag_id' ";
            $condition_field = 'm.*,v.village_name';
            $group_info = D('')->table($condition_table)->where( $condition_where)->field($condition_field)->find();
            $village_categorys=D('house_village')->select();
            $village=D('house_village')->where(array('village_id'=>$group_info['village_id']))->find();
            $this->assign('group_info',$group_info);
            $this->assign('village_categorys', $village_categorys);
            $this->assign('village', $village);
            $this->display();
        }
    }
    /**
     * 区域删除
     * 陈琦
     * 2016.6.14
     */
    public function group_del(){
        $ag_id = $_GET['ag_id'];
        $x=M('access_control')->where('ag_id='.$ag_id)->select();
        if(!$x){
        $del = M('access_control_group')->where('ag_id='.$ag_id)->delete();
        if($del) {
            $this->success('删除成功！');
         }
        }else{
            $this->error('此区域下已有设备，请先删除该设备！');
        }
    }

    /**
     * 用户资料审核
     * 陈琦
     * 2016.6.14
     */
    public function  userCheck_index(){
        $condition_table = array(C('DB_PREFIX') . 'House_village_user_bind' => 'n',C('DB_PREFIX').'user'=>'u',C('DB_PREFIX').'house_village'=>'v',C('DB_PREFIX').'company'=>'c') ;
        $condition_where="n.ac_status>=1 and u.uid=n.uid and n.village_id=v.village_id and c.company_id=n.company_id";
        if (!empty($_GET['keyword'])) {
            if ($_GET['searchtype'] == 'name') {
                $name = "n.name like '%" . $_GET['keyword'] . "%'";
                $condition_where .= ' and ' . $name;
            } else if ($_GET['searchtype'] == 'phone') {
                $phone = "n.phone like '%" . $_GET['keyword'] . "%'";
                $condition_where .= ' and ' . $phone;
            }
        }
        $t1= strtotime($_GET['startDate']);
        $t2= strtotime($_GET['endDate']);
        if($t1 && $t2){
            $date="n.add_time>='$t1'and n.add_time<='$t2'";
            $condition_where.=' and '.$date;
        }else if($t1 && !$t2){
            $date="n.add_time>='$t1'";
            $condition_where.=' and '.$date;
        }else if(!$t1 && $t2){
            $date="n.add_time<='$t2'";
            $condition_where.=' and '.$date;
        }
        import('@.ORG.system_page');	//引入分页
        $condition_field = 'n.*,u.nickname,v.village_name,c.company_name';
        $order = ' n.add_time DESC ';
        $count_userCheck = D('')->table($condition_table)->where($condition_where)->count();
        $p = new Page($count_userCheck, 15, 'page');
        $village_list = D('')->field($condition_field)->table($condition_table)->where($condition_where)->order($order)->limit($p->firstRow . ',' . $p->listRows)->select();
        $userCheck_list['pagebar'] = $p->show();
        $userCheck_list['userCheck_list'] = $village_list;
        $this->assign('userCheck_list',$userCheck_list);
        $this->display();
    }

    public function _before_userCheck_index_news(){
        if(session('system.account')==SUPER_ADMIN){
            $this->assign('admin',1);
            $villageArray = M('house_village')->where(array('status'=>1))->select();
            $this->assign('villageArray',$villageArray);
            if(I('get.village_id')){
                $presentVillage = M('house_village')->find(I('get.village_id'))['village_name'];
            }else{
                $presentVillage = '全部显示';
            }
        }else{
            $this->assign('admin',0);
            $presentVillage = M('house_village')->find(session('system.village_id'))['village_name'];

        }

        $this->assign('presentVillage',$presentVillage);


    }

    public function  userCheck_index_news(){
        $condition_table = array(
            C('DB_PREFIX') . 'House_village_user_bind' => 'n',
            C('DB_PREFIX').'user'=>'u',
            C('DB_PREFIX').'house_village'=>'v',
            C('DB_PREFIX').'company'=>'c'
        )
        ;
        $condition_where="n.ac_status>=1 and u.uid=n.uid and n.village_id=v.village_id and c.company_id=n.company_id";
        if (!empty($_GET['keyword'])) {
            if ($_GET['searchtype'] == 'name') {
                $name = "n.name like '%" . $_GET['keyword'] . "%'";
                $condition_where .= ' and ' . $name;
            } else if ($_GET['searchtype'] == 'phone') {
                $phone = "n.phone like '%" . $_GET['keyword'] . "%'";
                $condition_where .= ' and ' . $phone;
            }
        }
        $t1= strtotime($_GET['startDate']);
        $t2= strtotime($_GET['endDate']);
        if($t1 && $t2){
            $date="n.add_time>='$t1'and n.add_time<='$t2'";
            $condition_where.=' and '.$date;
        }else if($t1 && !$t2){
            $date="n.add_time>='$t1'";
            $condition_where.=' and '.$date;
        }else if(!$t1 && $t2){
            $date="n.add_time<='$t2'";
            $condition_where.=' and '.$date;
        }
        if($_SESSION['system']['account'] != SUPER_ADMIN){
            $filter_string = filter_list_role($_SESSION['system']['id']);
            $condition_where.=' and '.$filter_string;
        }
        $condition_field = 'n.*,u.nickname,v.village_name,c.company_name';
        $order = ' n.add_time DESC ';
        $condition_where = filter_village($condition_where,0);
        $village_list = D('')->field($condition_field)->table($condition_table)->where($condition_where)->order($order)->limit(100)->select();
        $userCheck_list['userCheck_list'] = $village_list;
//        dump($userCheck_list);exit;
        $this->assign('userCheck_list',$userCheck_list);
        $this->display();
    }
	
	/* 审核用户信息
	* @time 2016-06-15
	* @author	小邓  <969101097@qq.com>*/
	public function userCheck_edit(){		 
        if(IS_POST){
			$pigcms_id=$_POST['pigcms_id'];
            if($pigcms_id){
				$find_name=M('house_village_user_bind')->where(array('pigcms_id'=>$pigcms_id,'ac_status'=>array('in','2,3,4')))->getField('name');
				if($find_name){	//判断是否已审核过
					$this->success('当前资料已审核！',U('Access/userCheck_index'));
				}else{
					$_POST['check_name']='系统管理员';
					$condition_village['pigcms_id'] = $pigcms_id;            
					$result =M('house_village_user_bind')->where($condition_village)->data($_POST)->save();
					if($result){
						//审核信息推送
						$condition_table = array(C('DB_PREFIX') . 'House_village_user_bind' => 'n',C('DB_PREFIX').'user'=>'u') ;
						$condition_where="n.ac_status>=1 and u.uid=n.uid and n.pigcms_id=".$pigcms_id;
						$condition_field = 'n.*,u.openid,u.truename';       
						$userCheck_info=D('')->table($condition_table)->where($condition_where)->field($condition_field)->find();					
						$time = time();
						$model=new templateNews(C('config.wechat_appid'),C('config.wechat_appsecret'));	
						if($_POST['ac_status']==2){		
							$href=C('config.site_url').'/wap.php?c=House&a=village_access_finish&village_id='.$userCheck_info['village_id'];
							$model->sendTempMsg('OPENTM201136105',array('href'=>$href,'wecha_id'=>$userCheck_info['openid'],'first'=>'您提交的门禁信息已通过审核！','keyword1'=>$userCheck_info['truename'],'keyword2'=>$userCheck_info['phone'],'keyword3'=>date('Y-m-d H:i:s')));
						}else if($_POST['ac_status']==3){
							$href=C('config.site_url').'/wap.php?c=House&a=village_access_next&village_id='.$userCheck_info['village_id'];
							$model->sendTempMsg('OPENTM201136105',array('href'=>$href,'wecha_id'=>$userCheck_info['openid'],'first'=>'您提交的门禁信息未通过审核！','keyword1'=>$userCheck_info['truename'],'keyword2'=>$userCheck_info['phone'],'keyword3'=>date('Y-m-d H:i:s')));
						}else{
							$href=C('config.site_url').'/wap.php?c=House&a=village_control_checkInfo&village_id='.$userCheck_info['village_id'].'&id_val='.$userCheck_info['pigcms_id'];
							//$village_info=M('house_village')->where(array('village_id'=>$userCheck_info['village_id']))->find();
							//$openid_arr=explode(',',$village_info['uid']);
							//if(is_array($openid_arr)){	//判断是否有多个绑定的用户
								//foreach($openid_arr as $val){
									//$wecha_id=M('user')->where(array('uid'=>$val))->getField('openid');
									//$model->sendTempMsg('OPENTM207145917',array('href'=>$href,'wecha_id'=>$wecha_id,'first'=>'您有一个待审核的信息！','keyword1'=>'智能门禁','keyword2'=>'管理员审核','keyword3'=>date('Y-m-d H:i:s')));
								//}					
							//}else{		
								//$wecha_id=M('user')->where(array('uid'=>$openid_arr))->getField('openid');
								//$model->sendTempMsg('OPENTM207145917',array('href'=>$href,'wecha_id'=>$wecha_id,'first'=>'您有一个待审核的信息！','keyword1'=>'智能门禁','keyword2'=>'管理员审核','keyword3'=>date('Y-m-d H:i:s')));
							//}
							$role_arr=M('role')->where(array('menus'=>array('like',array('%,29','29,%'),'OR')))->field('role_id')->select();
							$role_str='';
							foreach($role_arr as $value){
								$role_str.=$value['role_id'].',';	//以,拼接角色ID
							}
							$uid_arr=M('login_user')->field('uid')->where(array('role_id'=>array('in',trim($role_str,',')),'village_id'=>$userCheck_info['village_id'],'status'=>1))->select();
							if(!empty($uid_arr)){
								foreach($uid_arr as $val){
									$wecha_id=M('user')->where(array('uid'=>$val['uid']))->getField('openid');
									$model->sendTempMsg('OPENTM207145917',array('href'=>$href,'wecha_id'=>$wecha_id,'first'=>'您有一个待审核的信息！','keyword1'=>'智能门禁','keyword2'=>'管理员审核','keyword3'=>date('Y-m-d H:i:s')));
								}					
							}
						}						
						$this->success('修改成功！',U('Access/userCheck_index'));						
					}else{
						$this->error('修改失败！请重试。');
					}
				}
            }
        }else{
			$pigcms_id = $_GET['pigcms_id'];
			if($pigcms_id){
				$condition_table=array(C('DB_PREFIX') . 'House_village_user_bind' => 'n',C('DB_PREFIX').'user'=>'u',C('DB_PREFIX').'company'=>'c');
				$condition_where="n.ac_status>=1 and u.uid=n.uid and c.company_id=n.company_id and n.pigcms_id=".$pigcms_id;
				$condition_field='n.*,u.nickname,c.company_name';       
				$userCheck_info=D('')->table($condition_table)->where( $condition_where)->field($condition_field)->find();
				//dump($userCheck_info);exit;
				$this->assign('userCheck_info',$userCheck_info);         
			}     
			$this->display();
		}      
    }

    public function userCheck_edit_news(){

        if(IS_POST){
            //dump($_POST);exit;
            $pigcms_id=$_POST['pigcms_id'];
            if($pigcms_id){
                $find_name=M('house_village_user_bind')->where(array('pigcms_id'=>$pigcms_id,'ac_status'=>array('in','2,3,4')))->getField('name');
                if($find_name){	//判断是否已审核过
                    $this->success('当前资料已审核！');
                }else{
                    $_POST['check_name']='系统管理员';
                    $condition_village['pigcms_id'] = $pigcms_id;
                    $result =M('house_village_user_bind')->where($condition_village)->data($_POST)->save();
                    if($result){
                        //审核信息推送
                        $condition_table = array(C('DB_PREFIX') . 'House_village_user_bind' => 'n',C('DB_PREFIX').'user'=>'u') ;
                        $condition_where="n.ac_status>=1 and u.uid=n.uid and n.pigcms_id=".$pigcms_id;
                        $condition_field = 'n.*,u.openid,u.truename';
                        $userCheck_info=D('')->table($condition_table)->where($condition_where)->field($condition_field)->find();
                        $time = time();
                        $model=new templateNews(C('config.wechat_appid'),C('config.wechat_appsecret'));
                        if($_POST['ac_status']==2){
                            $href=C('config.site_url').'/wap.php?c=House&a=village_access_finish&village_id='.$userCheck_info['village_id'];
                            $model->sendTempMsg('OPENTM201136105',array('href'=>$href,'wecha_id'=>$userCheck_info['openid'],'first'=>'您提交的门禁信息已通过审核！','keyword1'=>$userCheck_info['truename'],'keyword2'=>$userCheck_info['phone'],'keyword3'=>date('Y-m-d H:i:s')));
                        }else if($_POST['ac_status']==3){
                            $href=C('config.site_url').'/wap.php?c=House&a=village_access_next&village_id='.$userCheck_info['village_id'];
                            $model->sendTempMsg('OPENTM201136105',array('href'=>$href,'wecha_id'=>$userCheck_info['openid'],'first'=>'您提交的门禁信息未通过审核！','keyword1'=>$userCheck_info['truename'],'keyword2'=>$userCheck_info['phone'],'keyword3'=>date('Y-m-d H:i:s')));
                        }else{
                            $href=C('config.site_url').'/wap.php?c=House&a=village_control_checkInfo&village_id='.$userCheck_info['village_id'].'&id_val='.$userCheck_info['pigcms_id'];
                            //$village_info=M('house_village')->where(array('village_id'=>$userCheck_info['village_id']))->find();
                            //$openid_arr=explode(',',$village_info['uid']);
                            //if(is_array($openid_arr)){	//判断是否有多个绑定的用户
                            //foreach($openid_arr as $val){
                            //$wecha_id=M('user')->where(array('uid'=>$val))->getField('openid');
                            //$model->sendTempMsg('OPENTM207145917',array('href'=>$href,'wecha_id'=>$wecha_id,'first'=>'您有一个待审核的信息！','keyword1'=>'智能门禁','keyword2'=>'管理员审核','keyword3'=>date('Y-m-d H:i:s')));
                            //}					
                            //}else{		
                            //$wecha_id=M('user')->where(array('uid'=>$openid_arr))->getField('openid');
                            //$model->sendTempMsg('OPENTM207145917',array('href'=>$href,'wecha_id'=>$wecha_id,'first'=>'您有一个待审核的信息！','keyword1'=>'智能门禁','keyword2'=>'管理员审核','keyword3'=>date('Y-m-d H:i:s')));
                            //}
                            $role_arr=M('role')->where(array('menus'=>array('like',array('%,29','29,%'),'OR')))->field('role_id')->select();
                            $role_str='';
                            foreach($role_arr as $value){
                                $role_str.=$value['role_id'].',';	//以,拼接角色ID
                            }
                            $uid_arr=M('login_user')->field('uid')->where(array('role_id'=>array('in',trim($role_str,',')),'village_id'=>$userCheck_info['village_id'],'status'=>1))->select();
                            if(!empty($uid_arr)){
                                foreach($uid_arr as $val){
                                    $wecha_id=M('user')->where(array('uid'=>$val['uid']))->getField('openid');
                                    $model->sendTempMsg('OPENTM207145917',array('href'=>$href,'wecha_id'=>$wecha_id,'first'=>'您有一个待审核的信息！','keyword1'=>'智能门禁','keyword2'=>'管理员审核','keyword3'=>date('Y-m-d H:i:s')));
                                }
                            }
                        }
                        $this->success('修改成功！');
                    }else{
                        $this->error('修改失败！请重试。');
                    }
                }
            }
        }else{
            $pigcms_id = $_GET['pigcms_id'];
            if($pigcms_id){
                $condition_table=array(C('DB_PREFIX') . 'House_village_user_bind' => 'n',C('DB_PREFIX').'user'=>'u',C('DB_PREFIX').'company'=>'c');
                $condition_where="n.ac_status>=1 and u.uid=n.uid and c.company_id=n.company_id and n.pigcms_id=".$pigcms_id;
                $condition_field='n.*,u.nickname,c.company_name';
                $userCheck_info=D('')->table($condition_table)->where( $condition_where)->field($condition_field)->find();
                //dump($userCheck_info);exit;
                $this->assign('userCheck_info',$userCheck_info);
            }
            $this->display();
        }
    }
	
	/* 用户资料审核删除
	* @time 2016-06-15
	* @author	小邓  <969101097@qq.com>*/
	public function userCheck_del(){
        if (IS_POST){
            $pigcms_id=I('post.pigcms_id');
            $del=M('House_village_user_bind')->where('pigcms_id='.$pigcms_id)->delete();
            if($del){
                $this->success('删除成功！',U('Access/userCheck_index'));
            }else{
                $this->error('删除失败！请重试~');
            }
        }
    }
	
	/* 用户开门记录
	* @time 2016-06-14
	* @author	小邓  <969101097@qq.com>*/
	public function operatLog(){
        $condition_table=array(
            'pigcms_access_control'=>'control',
            'pigcms_house_village_user_bind'=>'bind',
            'pigcms_access_control_user_log'=> 'Log.class',
            'pigcms_house_village'=>'village',
            'pigcms_access_control_group'=>'group',
            'pigcms_company'=>'company'
        );
        $condition_where='control.ag_id=group.ag_id and log.ac_id=control.ac_id and bind.company_id=company.company_id and log.pigcms_id=bind.pigcms_id and log.village_id=village.village_id';
        if (!empty($_GET['keyword'])) {
            if ($_GET['searchtype'] == 'name') {
                $name = "bind.name like '%" . $_GET['keyword'] . "%'";
                $condition_where .= ' and ' . $name;
            } else if ($_GET['searchtype'] == 'phone') {
                $phone = "bind.phone like '%" . $_GET['keyword'] . "%'";
                $condition_where .= ' and ' . $phone;
            }
        }
        $t1= strtotime($_GET['startDate']);
        $t2= strtotime($_GET['endDate']);
        if($t1 && $t2){
            $date="log.opdate>='$t1'and log.opdate<='$t2'";
            $condition_where.=' and '.$date;
        }else if($t1 && !$t2){
            $date="log.opdate>='$t1'";
            $condition_where.=' and '.$date;
        }else if(!$t1 && $t2){
            $date="log.opdate<='$t2'";
            $condition_where.=' and '.$date;
        }
        import('@.ORG.system_page');	//引入分页
        $condition_field='group.ag_name,company.company_name,bind.card_type,bind.phone,control.ac_name,control.village_id,bind.usernum,bind.name,bind.company,log.log_id,log.opdate,village.village_name';
        $count_access = D('')->table($condition_table)->where($condition_where)->count();
        $p=new Page($count_access,15,'page');
        $order='log.opdate desc ';
        $access_control_result=D('')->table($condition_table)->where($condition_where)->field($condition_field)->order($order)->limit($p->firstRow .','.$p->listRows)->select();
        // dump($access_control_result); exit;
        $get_log_list['pagebar']=$p->show();
        $get_log_list['access_list']=$access_control_result;
        /* }else {
             $get_log_list = D('AccessControlLog')->getLoglist($village_id = $this->village_id);
         }*/
        $this->assign('log_list',$get_log_list);
        $this->display();
	}

    public function operatLog_news(){
        $condition_table=array(
            'pigcms_access_control'=>'control',
            'pigcms_house_village_user_bind'=>'bind',
            'pigcms_access_control_user_log'=> 'log',
            'pigcms_house_village'=>'village',
            'pigcms_access_control_group'=>'group',
            'pigcms_company'=>'company'
        );
        $condition_where='control.ag_id=group.ag_id and log.ac_id=control.ac_id and bind.company_id=company.company_id and log.pigcms_id=bind.pigcms_id and log.village_id=village.village_id';
        if (!empty($_GET['keyword'])) {
            if ($_GET['searchtype'] == 'name') {
                $name = "bind.name like '%" . $_GET['keyword'] . "%'";
                $condition_where .= ' and ' . $name;
            } else if ($_GET['searchtype'] == 'phone') {
                $phone = "bind.phone like '%" . $_GET['keyword'] . "%'";
                $condition_where .= ' and ' . $phone;
            }
        }
        $t1= I('get.startDate');
        $t2= I('get.endDate');
        if($t1 && $t2){
            $date="log.opdate>='$t1'and log.opdate<='$t2'";
            $condition_where.=' and '.$date;
        }else if($t1 && !$t2){
            $date="log.opdate>='$t1'";
            $condition_where.=' and '.$date;
        }else if(!$t1 && $t2){
            $date="log.opdate<='$t2'";
            $condition_where.=' and '.$date;
        }
        if($_SESSION['system']['account'] != SUPER_ADMIN){
            $filter_string = filter_list_door($_SESSION['system']['id']);
            $condition_where.=' and '.$filter_string;
        }
        $condition_field='group.ag_name,company.company_name,bind.card_type,bind.phone,control.ac_name,control.village_id,bind.usernum,bind.name,bind.company,log.type,log.log_id,log.opdate,village.village_name';
        $order='log.opdate desc ';
        $access_control_result=D('')->table($condition_table)->where($condition_where)->field($condition_field)->order($order)->limit(100)->select();
        // dump(M()->_sql());
        // dump($access_control_result); exit;
        $get_log_list['access_list']=$access_control_result;
        /* }else {
             $get_log_list = D('AccessControlLog')->getLoglist($village_id = $this->village_id);
         }*/
        $c1=M('access_control_user_log')->where(array('type'=>1,'opdate'=>array(array('gt',strtotime(date('Y-m-d'))),array('lt',strtotime(date('Y-m-d'))+24*3600))))->count();
        $c2=M('access_control_user_log')->where(array('type'=>2,'opdate'=>array(array('gt',strtotime(date('Y-m-d'))),array('lt',strtotime(date('Y-m-d'))+24*3600))))->count();

        $time = date('Y-m-d');

        $this->assign('c1',$c1);
        $this->assign('c2',$c2);
        $this->assign('log_list',$get_log_list);
        $this->assign('time',$time);
        $this->display();
    }
	
	/* 开门记录详情
	* @time 2016-06-14
	* @author	小邓  <969101097@qq.com>*/
	public function operatLog_edit(){
        if(IS_GET){
            $log_id=I('get.log_id');
			$get_log_info=D('AccessControlLog')->getLoginfo($log_id);
			$this->assign('log_info',$get_log_info);
			$this->display();
        }
    }

    public function operatLog_edit_news(){
        if(IS_GET){
            $log_id=I('get.log_id');
            $get_log_info=D('AccessControlLog')->getLoginfo($log_id);
            $this->assign('log_info',$get_log_info);
            $this->display();
        }
    }
	
	/* 开门记录删除
	* @time 2016-06-15
	* @author	小邓  <969101097@qq.com>*/
    public function operatLog_del(){
        if(IS_POST){
            $log_id=I('post.log_id');
            $del=M('access_control_user_log')->where('log_id='.$log_id)->delete();
            if($del){
                $this->success('删除成功！');
            }else{
                $this->error('删除失败！请重试。');
            }
        }
    }
     /**
     * 开门统计列表
     *祝君伟
     * 2016.11.03
     */
    public function openDoor(){
        //设置公用变量
        $condition_table=array(
            'pigcms_house_village_user_bind'=>'bind',
            'pigcms_access_control_user_log'=> 'Log.class',
            'pigcms_company'=>'company'
        );
        $condition_field="count(bind.uid) as allnum,company.company_name,bind.company_id,bind.name,bind.card_type,bind.phone,bind.usernum";
        //$condition_where ="log.pigcms_id=bind.pigcms_id and bind.company_id=company.company_id";
        $condition_join_one = 'inner join pigcms_house_village_user_bind ON pigcms_access_control_user_log.pigcms_id=pigcms_house_village_user_bind.pigcms_id';
        $condition_join_two = 'inner join pigcms_company ON pigcms_house_village_user_bind.company_id=pigcms_company.company_id';
        $searchtype = $_GET['searchtype'];
        $searchtime = $_GET['searchtime'];
        //获取从今天零点开始算的时间戳
        $y=date("Y");
        $m=date("m");
        $d=date("d");
        $todayTime= mktime(0,0,0,$m,$d,$y);
        $end_today_time = $todayTime+86400;
        $now = time();
        $yday = $todayTime-24*3600;
        $zday = $todayTime-7*24*3600;
        $mday = $todayTime-30*24*3600;
        $condition_where ="log.opdate BETWEEN $todayTime and $end_today_time";
        //显示一天内有几个用户开门
        $access_openOne=M();
        $sql_one="select count(DISTINCT pigcms_id) as daynum from pigcms_access_control_user_log where opdate>=$todayTime and opdate<=$end_today_time";
        $access_openOne_result = $access_openOne->query($sql_one);
        $get_log_list['access_one']=$access_openOne_result;
        $text_array_count = D('')->table( $condition_table)->field($condition_field)->join($condition_join_two)->join($condition_join_one)->where($condition_where)->count();
        import('@.ORG.system_page');    //引入分页
        $p=new Page($text_array_count,15,'page');
        $text_array = D('')->table( $condition_table)->field($condition_field)->join($condition_join_one)->join($condition_join_two)->where($condition_where)->limit($p->firstRow. ',' . $p->listRows)->order('allnum desc')->select();
        //var_dump(D()->getlastSql());
        //var_dump($text_array);

        //显示一周内有几个用户到访
        $sql_seven = "select count(DISTINCT pigcms_id) as daynum from pigcms_access_control_user_log where opdate>=$zday";
        $access_openSeven_result=$access_openOne->query($sql_seven);
        $get_log_list['access_seven']=$access_openSeven_result;
        //显示三十天内有几个用户到访
        $sql_mom = "select count(DISTINCT pigcms_id) as daynum from pigcms_access_control_user_log where opdate>=$mday";
        $access_openMom_result=$access_openOne->query($sql_mom);
        $get_log_list['access_mom']=$access_openMom_result;
        /*对下拉列表值进行判断*/
        if(!empty($searchtype)){
            //引入分页类
            import('@.ORG.system_page');    //引入分页
            if($searchtype == 'name' && $searchtime == 'zday') {
                //在今天的时间内的数据
                $count_access=$access_openSeven_result[0]['daynum'];
                $p=new Page($count_access,15,'page');
                $get_log_list['pagebar']=$p->show();
              $sql = "select count(bind.uid) as allnum,company.company_name,bind.company_id,bind.name,bind.card_type,bind.phone,bind.usernum from pigcms_access_control_user_log as log join
                pigcms_house_village_user_bind as bind on log.pigcms_id=bind.pigcms_id join pigcms_company as company on bind.company_id=company.company_id  where opdate>$zday group by 
                bind.uid order by allnum desc limit ".$p->firstRow. ',' . $p->listRows;

            }else if($searchtype == 'name' && $searchtime == 'yday'){
                $count_access=$access_openOne_result[0]['daynum'];
                $p=new Page($count_access,15,'page');
                $get_log_list['pagebar']=$p->show();
                $sql = "select count(bind.uid) as allnum,company.company_name,bind.company_id,bind.name,bind.card_type,bind.phone,bind.usernum from pigcms_access_control_user_log as log join
                pigcms_house_village_user_bind as bind on log.pigcms_id=bind.pigcms_id join pigcms_company as company on bind.company_id=company.company_id  where opdate>$todayTime group by 
                bind.uid order by allnum desc limit ".$p->firstRow. ',' . $p->listRows;

            }else if($searchtype == 'name' && $searchtime == 'mday'){
                $count_access=$access_openMom_result[0]['daynum'];
                $p=new Page($count_access,15,'page');
                $get_log_list['pagebar']=$p->show();
                $sql = "select count(bind.uid) as allnum,company.company_name,bind.company_id,bind.name,bind.card_type,bind.phone,bind.usernum from pigcms_access_control_user_log as log join
                pigcms_house_village_user_bind as bind on log.pigcms_id=bind.pigcms_id join pigcms_company as company on bind.company_id=company.company_id  where opdate>$mday group by 
                bind.uid order by allnum desc limit ".$p->firstRow. ',' . $p->listRows;

            }else if($searchtype == 'company' && $searchtime == 'zday'){
                //公司的数据
                $count_sql = "select count(*) as num from (select count(log.pigcms_id) as allnum,login.account,login.truename from pigcms_access_control_user_log as log join
                pigcms_house_village_user_bind as bind on log.pigcms_id=bind.pigcms_id join pigcms_login_user as login on bind.company_id=login.company_id where opdate BETWEEN $zday AND $todayTime group by 
                login.truename order by allnum desc) temp";
                $count_access_old=D('')->query($count_sql);
                $count_access = $count_access_old[0]['num'];
                $p=new Page($count_access,15,'page');
                $this->assign('state',1);
                $get_log_list['pagebar']=$p->show();
                $sql = "select count(log.pigcms_id) as allnum,login.account,login.truename from pigcms_access_control_user_log as log join
                pigcms_house_village_user_bind as bind on log.pigcms_id=bind.pigcms_id join pigcms_login_user as login on bind.company_id=login.company_id where opdate BETWEEN $zday AND $todayTime group by 
                login.truename order by allnum desc limit ".$p->firstRow. ',' . $p->listRows;

            }else if($searchtype == 'company' && $searchtime == 'yday'){
                $count_sql = "select count(*) as num from(select count(log.pigcms_id) as allnum,login.account,login.truename from pigcms_access_control_user_log as log join
                pigcms_house_village_user_bind as bind on log.pigcms_id=bind.uid right join pigcms_login_user as login on bind.company_id=login.company_id where opdate>$yday AND $todayTime group by 
                login.truename order by allnum desc) temp";
                $count_access_old=D('')->query($count_sql);
                $count_access = $count_access_old[0]['num'];
                $p=new Page($count_access,15,'page');
                $this->assign('state',1);
                $get_log_list['pagebar']=$p->show();
                $sql = "select count(log.pigcms_id) as allnum,login.account,login.truename from pigcms_access_control_user_log as log join
                pigcms_house_village_user_bind as bind on log.pigcms_id=bind.uid right join pigcms_login_user as login on bind.company_id=login.company_id where opdate>$yday AND $todayTime group by 
                login.truename order by allnum desc limit ".$p->firstRow. ',' . $p->listRows;

            }else if($searchtype == 'company' && $searchtime == 'mday'){
                $count_sql = "select count(*) as num from(select count(log.pigcms_id) as allnum,login.account,login.truename from pigcms_access_control_user_log as log join
                pigcms_house_village_user_bind as bind on log.pigcms_id=bind.pigcms_id join pigcms_login_user as login on bind.company_id=login.company_id where opdate>$mday AND $todayTime group by 
                login.truename order by allnum desc) temp";
                $count_access_old=D('')->query($count_sql);
                $count_access = $count_access_old[0]['num'];
                $p=new Page($count_access,15,'page');
                $this->assign('state',1);
                $get_log_list['pagebar']=$p->show();
                $sql = "select count(log.pigcms_id) as allnum,login.account,login.truename from pigcms_access_control_user_log as log join
                pigcms_house_village_user_bind as bind on log.pigcms_id=bind.pigcms_id join pigcms_login_user as login on bind.company_id=login.company_id where opdate>$mday AND $todayTime group by 
                login.truename order by allnum desc limit ".$p->firstRow. ',' . $p->listRows;

            }else{
                $count_sql="select count(*) as num FROM (select count(DISTINCT bind.uid) as allnum,company.company_name,bind.company_id from pigcms_access_control_user_log as log join
                pigcms_house_village_user_bind as bind on log.pigcms_id=bind.pigcms_id join pigcms_company as company on bind.company_id=company.company_id  group by 
                company.company_name order by allnum desc) temp";
                $count_access_old=D('')->query($count_sql);
                $count_access = $count_access_old[0]['num'];
                $p=new Page($count_access,15,'page');
                $this->assign('state',2);
                $get_log_list['pagebar']=$p->show();
                $sql = "select count(DISTINCT bind.uid) as allnum,company.company_name,bind.company_id from pigcms_access_control_user_log as log join
                pigcms_house_village_user_bind as bind on log.pigcms_id=bind.pigcms_id join pigcms_company as company on bind.company_id=company.company_id  group by 
                company.company_name order by allnum desc limit ".$p->firstRow. ',' . $p->listRows;

            }
        }else{
            $count_access=$access_openOne_result[0]['daynum'];
            $p=new Page($count_access,15,'page');
            $get_log_list['pagebar']=$p->show();
                $sql = "select count(bind.uid) as allnum,company.company_name,bind.company_id,bind.name,bind.card_type,bind.phone,bind.usernum from pigcms_access_control_user_log as log join
                pigcms_house_village_user_bind as bind on log.pigcms_id=bind.pigcms_id join pigcms_company as company on bind.company_id=company.company_id  where opdate>$todayTime group by 
                bind.uid order by allnum desc limit ".$p->firstRow. ',' . $p->listRows;


        }
        //向页面传送图表数据
        //七天内的数据
        $edxmt=$this->changeSevenDay();
        $edymt=$this->changeSeven();
        //三十天内的数据
        $mdxmt=$this->changeSanDay();
        $mdymt=$this->changeSan();
        //显示一天内有几个用户用的详细信息
        $access_openDoor = M();
        $access_openDoor_result = $access_openDoor->query($sql);
        //var_dump(D()->getlastSql());
        $get_log_list['access_list']=$access_openDoor_result;
        $this->assign('edxmt',$edxmt);
        $this->assign('edymt',$edymt);
        $this->assign('mdxmt',$mdxmt);
        $this->assign('mdymt',$mdymt);
        $this->assign('log_list',$get_log_list);
        $this->display();
        /*echo '123';*/


    }

    public function openDoor_news(){
        //设置公用变量
        $condition_table=array(
            'pigcms_house_village_user_bind'=>'bind',
            'pigcms_access_control_user_log'=> 'Log.class',
            'pigcms_company'=>'company'
        );
        $condition_field="count(bind.uid) as allnum,company.company_name,bind.company_id,bind.name,bind.card_type,bind.phone,bind.usernum";
        //$condition_where ="log.pigcms_id=bind.pigcms_id and bind.company_id=company.company_id";
        $condition_join_one = 'inner join pigcms_house_village_user_bind ON pigcms_access_control_user_log.pigcms_id=pigcms_house_village_user_bind.pigcms_id';
        $condition_join_two = 'inner join pigcms_company ON pigcms_house_village_user_bind.company_id=pigcms_company.company_id';
        $searchtype = $_GET['searchtype'];
        $searchtime = $_GET['searchtime'];
        //获取从今天零点开始算的时间戳
        $y=date("Y");
        $m=date("m");
        $d=date("d");
        $todayTime= mktime(0,0,0,$m,$d,$y);
        $end_today_time = $todayTime+86400;
        $now = time();
        $yday = $todayTime-24*3600;
        $zday = $todayTime-7*24*3600;
        $mday = $todayTime-30*24*3600;
        $condition_where ="log.opdate BETWEEN $todayTime and $end_today_time";
        //显示一天内有几个用户开门
        $access_openOne=M();
        $sql_one="select count(DISTINCT pigcms_id) as daynum from pigcms_access_control_user_log where opdate>=$todayTime and opdate<=$end_today_time";
        $access_openOne_result = $access_openOne->query($sql_one);
        $get_log_list['access_one']=$access_openOne_result;
        $text_array_count = D('')->table( $condition_table)->field($condition_field)->join($condition_join_two)->join($condition_join_one)->where($condition_where)->count();
        import('@.ORG.system_page');    //引入分页
        $p=new Page($text_array_count,15,'page');
        $text_array = D('')->table( $condition_table)->field($condition_field)->join($condition_join_one)->join($condition_join_two)->where($condition_where)->limit(100)->order('allnum desc')->select();
        //var_dump(D()->getlastSql());
        //var_dump($text_array);

        //显示一周内有几个用户到访
        $sql_seven = "select count(DISTINCT pigcms_id) as daynum from pigcms_access_control_user_log where opdate>=$zday";
        $access_openSeven_result=$access_openOne->query($sql_seven);
        $get_log_list['access_seven']=$access_openSeven_result;
        //显示三十天内有几个用户到访
        $sql_mom = "select count(DISTINCT pigcms_id) as daynum from pigcms_access_control_user_log where opdate>=$mday";
        $access_openMom_result=$access_openOne->query($sql_mom);
        $get_log_list['access_mom']=$access_openMom_result;
        /*对下拉列表值进行判断*/
        if(!empty($searchtype)){
            //引入分页类
            import('@.ORG.system_page');    //引入分页
            if($searchtype == 'name' && $searchtime == 'zday') {
                //在今天的时间内的数据
                $count_access=$access_openSeven_result[0]['daynum'];
                $p=new Page($count_access,15,'page');
                $get_log_list['pagebar']=$p->show();
                $sql = "select count(bind.uid) as allnum,company.company_name,bind.company_id,bind.name,bind.card_type,bind.phone,bind.usernum from pigcms_access_control_user_log as log join
                pigcms_house_village_user_bind as bind on log.pigcms_id=bind.pigcms_id join pigcms_company as company on bind.company_id=company.company_id  where opdate>$zday group by 
                bind.uid order by allnum desc limit ".$p->firstRow. ',' . $p->listRows;

            }else if($searchtype == 'name' && $searchtime == 'yday'){
                $count_access=$access_openOne_result[0]['daynum'];
                $p=new Page($count_access,15,'page');
                $get_log_list['pagebar']=$p->show();
                $sql = "select count(bind.uid) as allnum,company.company_name,bind.company_id,bind.name,bind.card_type,bind.phone,bind.usernum from pigcms_access_control_user_log as log join
                pigcms_house_village_user_bind as bind on log.pigcms_id=bind.pigcms_id join pigcms_company as company on bind.company_id=company.company_id  where opdate>$todayTime group by 
                bind.uid order by allnum desc limit ".$p->firstRow. ',' . $p->listRows;

            }else if($searchtype == 'name' && $searchtime == 'mday'){
                $count_access=$access_openMom_result[0]['daynum'];
                $p=new Page($count_access,15,'page');
                $get_log_list['pagebar']=$p->show();
                $sql = "select count(bind.uid) as allnum,company.company_name,bind.company_id,bind.name,bind.card_type,bind.phone,bind.usernum from pigcms_access_control_user_log as log join
                pigcms_house_village_user_bind as bind on log.pigcms_id=bind.pigcms_id join pigcms_company as company on bind.company_id=company.company_id  where opdate>$mday group by 
                bind.uid order by allnum desc limit ".$p->firstRow. ',' . $p->listRows;

            }else if($searchtype == 'company' && $searchtime == 'zday'){
                //公司的数据
                $count_sql = "select count(*) as num from (select count(log.pigcms_id) as allnum,login.account,login.truename from pigcms_access_control_user_log as log join
                pigcms_house_village_user_bind as bind on log.pigcms_id=bind.pigcms_id join pigcms_login_user as login on bind.company_id=login.company_id where opdate BETWEEN $zday AND $todayTime group by 
                login.truename order by allnum desc) temp";
                $count_access_old=D('')->query($count_sql);
                $count_access = $count_access_old[0]['num'];
                $p=new Page($count_access,15,'page');
                $this->assign('state',1);
                $get_log_list['pagebar']=$p->show();
                $sql = "select count(log.pigcms_id) as allnum,login.account,login.truename from pigcms_access_control_user_log as log join
                pigcms_house_village_user_bind as bind on log.pigcms_id=bind.pigcms_id join pigcms_login_user as login on bind.company_id=login.company_id where opdate BETWEEN $zday AND $todayTime group by 
                login.truename order by allnum desc limit ".$p->firstRow. ',' . $p->listRows;

            }else if($searchtype == 'company' && $searchtime == 'yday'){
                $count_sql = "select count(*) as num from(select count(log.pigcms_id) as allnum,login.account,login.truename from pigcms_access_control_user_log as log join
                pigcms_house_village_user_bind as bind on log.pigcms_id=bind.uid right join pigcms_login_user as login on bind.company_id=login.company_id where opdate>$yday AND $todayTime group by 
                login.truename order by allnum desc) temp";
                $count_access_old=D('')->query($count_sql);
                $count_access = $count_access_old[0]['num'];
                $p=new Page($count_access,15,'page');
                $this->assign('state',1);
                $get_log_list['pagebar']=$p->show();
                $sql = "select count(log.pigcms_id) as allnum,login.account,login.truename from pigcms_access_control_user_log as log join
                pigcms_house_village_user_bind as bind on log.pigcms_id=bind.uid right join pigcms_login_user as login on bind.company_id=login.company_id where opdate>$yday AND $todayTime group by 
                login.truename order by allnum desc limit ".$p->firstRow. ',' . $p->listRows;

            }else if($searchtype == 'company' && $searchtime == 'mday'){
                $count_sql = "select count(*) as num from(select count(log.pigcms_id) as allnum,login.account,login.truename from pigcms_access_control_user_log as log join
                pigcms_house_village_user_bind as bind on log.pigcms_id=bind.pigcms_id join pigcms_login_user as login on bind.company_id=login.company_id where opdate>$mday AND $todayTime group by 
                login.truename order by allnum desc) temp";
                $count_access_old=D('')->query($count_sql);
                $count_access = $count_access_old[0]['num'];
                $p=new Page($count_access,15,'page');
                $this->assign('state',1);
                $get_log_list['pagebar']=$p->show();
                $sql = "select count(log.pigcms_id) as allnum,login.account,login.truename from pigcms_access_control_user_log as log join
                pigcms_house_village_user_bind as bind on log.pigcms_id=bind.pigcms_id join pigcms_login_user as login on bind.company_id=login.company_id where opdate>$mday AND $todayTime group by 
                login.truename order by allnum desc limit ".$p->firstRow. ',' . $p->listRows;

            }else{
                $count_sql="select count(*) as num FROM (select count(DISTINCT bind.uid) as allnum,company.company_name,bind.company_id from pigcms_access_control_user_log as log join
                pigcms_house_village_user_bind as bind on log.pigcms_id=bind.pigcms_id join pigcms_company as company on bind.company_id=company.company_id  group by 
                company.company_name order by allnum desc) temp";
                $count_access_old=D('')->query($count_sql);
                $count_access = $count_access_old[0]['num'];
                $p=new Page($count_access,15,'page');
                $this->assign('state',2);
                $get_log_list['pagebar']=$p->show();
                $sql = "select count(DISTINCT bind.uid) as allnum,company.company_name,bind.company_id from pigcms_access_control_user_log as log join
                pigcms_house_village_user_bind as bind on log.pigcms_id=bind.pigcms_id join pigcms_company as company on bind.company_id=company.company_id  group by 
                company.company_name order by allnum desc limit ".$p->firstRow. ',' . $p->listRows;

            }
        }else{
            $count_access=$access_openOne_result[0]['daynum'];
            $p=new Page($count_access,15,'page');
            $get_log_list['pagebar']=$p->show();
            $sql = "select count(bind.uid) as allnum,company.company_name,bind.company_id,bind.name,bind.card_type,bind.phone,bind.usernum from pigcms_access_control_user_log as log join
                pigcms_house_village_user_bind as bind on log.pigcms_id=bind.pigcms_id join pigcms_company as company on bind.company_id=company.company_id  where opdate>$todayTime group by 
                bind.uid order by allnum desc limit ".$p->firstRow. ',' . $p->listRows;


        }
        //向页面传送图表数据
        //七天内的数据
        $edxmt=$this->changeSevenDay();
        $edymt=$this->changeSeven();
        //三十天内的数据
        $mdxmt=$this->changeSanDay();
        $mdymt=$this->changeSan();
        //显示一天内有几个用户用的详细信息
        $access_openDoor = M();
        $access_openDoor_result = $access_openDoor->query($sql);
        //var_dump(D()->getlastSql());
        $get_log_list['access_list']=$access_openDoor_result;
        $this->assign('edxmt',$edxmt);
        $this->assign('edymt',$edymt);
        $this->assign('mdxmt',$mdxmt);
        $this->assign('mdymt',$mdymt);
        $this->assign('log_list',$get_log_list);
        $this->display();
        /*echo '123';*/


    }
    /* 七天的Y轴数据
    * @time 2016-10-03
    * 祝君伟*/
    function changeSeven(){
        //设置常用变量
        $sql = '';
        $newStr="";
        $y=date("Y");
        $m=date("m");
        $d=date("d");
        $todayTime= mktime(0,0,0,$m,$d,$y);
        $changeOb = M();
        for($i=7;$i>0;$i--){
            $showTime = $todayTime-($i*24*3600);
            $endTime = $showTime+86400;
            $sql = "select count(DISTINCT pigcms_id) as daynum from pigcms_access_control_user_log where opdate>=$showTime and opdate<=$endTime";
            $res =$changeOb->query($sql);
            $num = $res[0]['daynum'];
            $newStr.= isset($num)?$num.",":$num;
        }

        $lastStr = substr($newStr,'0',strrpos($newStr,','));
       return $lastStr;
    }
    /* 七天的x轴数据
   * @time 2016-10-03
   * 祝君伟*/
    function changeSevenDay(){
        $newStr='';
        $y=date("Y");
        $m=date("m");
        $d=date("d");
        $todayTime= mktime(0,0,0,$m,$d,$y);
        for($i=7;$i>0;$i--){
            $showTime = $todayTime-($i*24*3600);
            $week = date("m月d日",$showTime);
            $newStr.= isset($week)?"'".$week."',":"'".$week."'";
        }
        $lastStr = substr($newStr,'0',strrpos($newStr,','));
        return $lastStr;
    }
    /* 三十天的y轴数据
   * @time 2016-10-03
   * 祝君伟*/
    function changeSan(){
        //设置常用变量
        $sql = '';
        $newStr="";
        $y=date("Y");
        $m=date("m");
        $d=date("d");
        $todayTime= mktime(0,0,0,$m,$d,$y);
        $changeOb = M();
        for($i=30;$i>0;$i--){
            $showTime = $todayTime-($i*24*3600);
            $endTime = $showTime+86400;
            $sql = "select count(DISTINCT pigcms_id) as daynum from pigcms_access_control_user_log where opdate>=$showTime and opdate<=$endTime";
            $res =$changeOb->query($sql);
            $num = $res[0]['daynum'];
            $newStr.= isset($num)?$num.",":$num;
        }

        $lastStrSan = substr($newStr,'0',strrpos($newStr,','));
        return $lastStrSan;

    }
    /* 三十天的x轴数据
   * @time 2016-10-03
   * 祝君伟*/
    function changeSanDay(){
        $newStr='';
        $y=date("Y");
        $m=date("m");
        $d=date("d");
        $todayTime= mktime(0,0,0,$m,$d,$y);
        for($i=30;$i>0;$i--){
            $showTime = $todayTime-($i*24*3600);
            $week = date("m月d日",$showTime);
            $newStr.= isset($week)?"'".$week."',":"'".$week."'";
        }
        $lastStrSan = substr($newStr,'0',strrpos($newStr,','));
        return $lastStrSan;
    }

    public function deviceType(){
        $condition_table = array(C('DB_PREFIX') . 'access_control_type' => 't');
        $condition_field = 't.*';
        import('@.ORG.system_page');
        $count_group = D('')->table($condition_table)->count();
        $p = new Page($count_group, 15, 'page');
        $order='t.actype_id desc ';
        $deviceType_info = D('')->table($condition_table)->field($condition_field)->order($order)->limit($p->firstRow.','.$p->listRows)->select();
        $this->assign('deviceType_info', $deviceType_info);
        $pagebar = $p->show();
        $this->assign('pagebar', $pagebar);
        $this->display();
    }

    public function deviceType_news(){
        $condition_table = array(C('DB_PREFIX') . 'access_control_type' => 't');
        $condition_field = 't.*';
        import('@.ORG.system_page');
        $count_group = D('')->table($condition_table)->count();
        $p = new Page($count_group, 15, 'page');
        $order='t.actype_id desc ';
        $deviceType_info = D('')->table($condition_table)->field($condition_field)->order($order)->limit($p->firstRow.','.$p->listRows)->select();
        $this->assign('deviceType_info', $deviceType_info);
        $pagebar = $p->show();
        $this->assign('pagebar', $pagebar);
        $this->display();
    }
    /**
     * 区域编辑
     * 陈琦
     * 2016.6.14
     */
    public function deviceType_edit(){
        if($_POST){
            $actype_id = $_POST['actype_id'];
            $_POST['actype_name'] = trim(I('actype_name'));
            $_POST['desc'] = trim(I('desc'));
            if(empty($_POST['actype_name'])){
                $this->error('设备类型名称不能为空');
            }
            if($actype_id){
                $condition_village['actype_name'] = $_POST['actype_name'];
                $condition_village['desc'] = $_POST['desc'];
                $result = M('access_control_type')->where('actype_id='.$actype_id)->data($condition_village)->save();
                if($result >= 0){
                    $this->success('修改成功！',U('Access/deviceType'));
                }else{
                    $this->error('修改失败！请重试。');
                }
            }else{
                //$add['ag_time'] = $_SERVER['REQUEST_TIME'];
                $add['actype_name'] = $_POST['actype_name'];
                $add['desc'] = $_POST['desc'];
                $result = M('access_control_type')->data($add)->add();
                if($result){
                    $this->success('添加成功！',U('Access/deviceType'));
                }else{
                    $this->error('添加失败！请重试。');
                }
            }
        }else{
            $actype_id = $_GET['actype_id'];
            $condition_table = array(C('DB_PREFIX') . 'access_control_type' => 'm',C('DB_PREFIX').'house_village'=>'v');
            $condition_where = "m.actype_id='$actype_id' ";
            $condition_field = 'm.*';
            $deviceType_info = D('')->table($condition_table)->where( $condition_where)->field($condition_field)->find();
            $village_categorys=D('house_village')->select();
            $village=D('house_village')->where(array('village_id'=>$deviceType_info['village_id']))->find();
            $this->assign('deviceType_info',$deviceType_info);
            $this->assign('village_categorys', $village_categorys);
            $this->assign('village', $village);
            $this->display();
        }
    }

    public function deviceType_edit_news(){
        if($_POST){
            $actype_id = $_POST['actype_id'];
            $_POST['actype_name'] = trim(I('actype_name'));
            $_POST['desc'] = trim(I('desc'));
            if(empty($_POST['actype_name'])){
                $this->error('设备类型名称不能为空');
            }
            if($actype_id){
                $condition_village['actype_name'] = $_POST['actype_name'];
                $condition_village['actype_value'] = $_POST['actype_value'];
                $result = M('access_control_type')->where('actype_id='.$actype_id)->data($condition_village)->save();
                if($result >= 0){
                    $this->success('修改成功！');
                }else{
                    $this->error('修改失败！请重试。');
                }
            }else{
                //$add['ag_time'] = $_SERVER['REQUEST_TIME'];
                $add['actype_name'] = $_POST['actype_name'];
                $add['desc'] = $_POST['desc'];
                $result = M('access_control_type')->data($add)->add();
                if($result){
                    $this->success('添加成功！');
                }else{
                    $this->error('添加失败！请重试。');
                }
            }
        }else{
            $actype_id = $_GET['actype_id'];
            $condition_table = array(C('DB_PREFIX') . 'access_control_type' => 'm',C('DB_PREFIX').'house_village'=>'v');
            $condition_where = "m.actype_id='$actype_id' ";
            $condition_field = 'm.*';
            $deviceType_info = D('')->table($condition_table)->where( $condition_where)->field($condition_field)->find();
            $village_categorys=D('house_village')->select();
            $village=D('house_village')->where(array('village_id'=>$deviceType_info['village_id']))->find();
            $this->assign('deviceType_info',$deviceType_info);
            $this->assign('village_categorys', $village_categorys);
            $this->assign('village', $village);
            $this->display();
        }
    }
    /**
     * 区域删除
     * 陈琦
     * 2016.6.14
     */
    public function deviceType_del(){
        $actype_id = $_POST['actype_id'];
        $x=M('access_control')->where('actype_id='.$actype_id)->select();
        if(!$x){
            $del = M('access_control_type')->where('actype_id='.$actype_id)->delete();
            if($del) {
                $this->success('删除成功！', U('Access/deviceType'));
            }
        }else{
            $this->error('此类型下已有设备，请先删除该设备！');
        }
    }
    /**
     * 访客信息管理
     * 陈琦
     * 2016.8.18
     */
    public function visitorLog(){
        $condition_table = array(
            C('DB_PREFIX') . 'House_village_user_bind' => 'n',
            C('DB_PREFIX').'user'=>'u',
            C('DB_PREFIX').'house_village'=>'v'
        );
        $condition_where="u.uid=n.uid and n.role=2 and n.village_id=v.village_id";
        if (!empty($_GET['keyword'])) {
            if ($_GET['searchtype'] == 'name') {
                $name = "n.name like '%" . $_GET['keyword'] . "%'";
                $condition_where .= ' and ' . $name;
            } else if ($_GET['searchtype'] == 'phone') {
                $phone = "n.phone like '%" . $_GET['keyword'] . "%'";
                $condition_where .= ' and ' . $phone;
            }
        }
        $t1= strtotime($_GET['startDate']);
        $t2= strtotime($_GET['endDate']);
        if($t1 && $t2){
            $date="n.add_time>='$t1'and n.add_time<='$t2'";
            $condition_where.=' and '.$date;
        }else if($t1 && !$t2){
            $date="n.add_time>='$t1'";
            $condition_where.=' and '.$date;
        }else if(!$t1 && $t2){
            $date="n.add_time<='$t2'";
            $condition_where.=' and '.$date;
        }
        import('@.ORG.system_page');
        $order = ' n.add_time DESC ';
        $condition_field = 'n.*,u.nickname,v.village_name';
        $count_visitor = D('')->table($condition_table)->where($condition_where)->count();
        $p = new Page($count_visitor, 15, 'page');
        $visitor_list = D('')->field($condition_field)->table($condition_table)->where($condition_where)->order($order)->limit($p->firstRow . ',' . $p->listRows)->select();
        $result['pagebar'] = $p->show();
        $result['visitor_list'] = $visitor_list;
        $this->assign('visitor_list',$result);
        $this->display();
    }


    public function _before_visitorLog_news(){
        if(session('system.account')==SUPER_ADMIN){
            $this->assign('admin',1);
            $villageArray = M('house_village')->where(array('status'=>1))->select();
            $this->assign('villageArray',$villageArray);
            if(I('get.village_id')){
                $presentVillage = M('house_village')->find(I('get.village_id'))['village_name'];
            }else{
                $presentVillage = '全部显示';
            }
        }else{
            $this->assign('admin',0);
            $presentVillage = M('house_village')->find(session('system.village_id'))['village_name'];

        }

        $this->assign('presentVillage',$presentVillage);


    }

    public function visitorLog_news(){
        $condition_table = array(
            C('DB_PREFIX') . 'House_village_user_bind' => 'n',
            C('DB_PREFIX').'user'=>'u',
            C('DB_PREFIX').'house_village'=>'v'
        );
        $condition_where="u.uid=n.uid and n.role=2 and n.village_id=v.village_id";
        if (!empty($_GET['keyword'])) {
            if ($_GET['searchtype'] == 'name') {
                $name = "n.name like '%" . $_GET['keyword'] . "%'";
                $condition_where .= ' and ' . $name;
            } else if ($_GET['searchtype'] == 'phone') {
                $phone = "n.phone like '%" . $_GET['keyword'] . "%'";
                $condition_where .= ' and ' . $phone;
            }
        }
        $t1= strtotime($_GET['startDate']);
        $t2= strtotime($_GET['endDate']);
        if($t1 && $t2){
            $date="n.add_time>='$t1'and n.add_time<='$t2'";
            $condition_where.=' and '.$date;
        }else if($t1 && !$t2){
            $date="n.add_time>='$t1'";
            $condition_where.=' and '.$date;
        }else if(!$t1 && $t2){
            $date="n.add_time<='$t2'";
            $condition_where.=' and '.$date;
        }

        // $condition_where = filter_auth($condition_where,3);

        //vd($condition_where);exit;

        $order = ' n.add_time DESC ';
        $condition_field = 'n.*,u.nickname,v.village_name';
        $visitor_list = D('')->field($condition_field)->table($condition_table)->where($condition_where)->order($order)->limit(100)->select();
        $result['visitor_list'] = $visitor_list;
        $this->assign('visitor_list',$result);

        $this->display();
    }

    public function visitorLog_edit(){
        if (IS_GET) {
            $pigcms_id = I('get.pigcms_id');
            if ($pigcms_id) {
                $condition_table = array(C('DB_PREFIX') . 'House_village_user_bind' => 'n', C('DB_PREFIX') . 'user' => 'u', C('DB_PREFIX') . 'house_village' => 'v');
                $condition_where = "u.uid=n.uid and n.village_id=v.village_id and n.role=2 and n.pigcms_id=" . $pigcms_id;
                $condition_field = 'n.*,u.nickname';
                $visitor_info = D('')->table($condition_table)->where($condition_where)->field($condition_field)->find();
                //dump($visitor_info);exit;
                $this->assign('visitorLog_info', $visitor_info);

            }
            $this->display();
        }
    }

    public function visitorLog_edit_news(){
        if (IS_GET) {
            $pigcms_id = I('get.pigcms_id');
            if ($pigcms_id) {
                $condition_table = array(C('DB_PREFIX') . 'House_village_user_bind' => 'n', C('DB_PREFIX') . 'user' => 'u', C('DB_PREFIX') . 'house_village' => 'v');
                $condition_where = "u.uid=n.uid and n.village_id=v.village_id and n.role=2 and n.pigcms_id=" . $pigcms_id;
                $condition_field = 'n.*,u.nickname';
                $visitor_info = D('')->table($condition_table)->where($condition_where)->field($condition_field)->find();
                //dump($visitor_info11);exit;
                $this->assign('visitorLog_info', $visitor_info);

            }
            $this->display();
        }
    }

    public function visitorLog_del(){
        if(IS_POST){
            $pigcms_id=I('post.pigcms_id');
            $del=M('House_village_user_bind')->where('pigcms_id='.$pigcms_id)->delete();
            if($del){
                $this->success('删除成功！');
            }else{
                $this->error('删除失败！请重试。');
            }
        }
    }


    /*--------------------------------------- 关于项目运营（门禁部分）-------------------------------------*/

    /*
     * 门禁服务 - 进出记录
     * */
    public function program_access_record_news(){
        //全部查出进出表
        //查询字段
        $field = array(
            'log.log_id',
            'log.opdate',
            'log.type',
            'user.name',
            'user.phone',
            'user.usernum',
            'user.card_type',
            'company.company_name',
            'control.ac_name',
            'g.ag_name',
            'type.actype_name',
            'village.village_name',
        );
        //筛选条件
        $condition_array =array();
        if($_SESSION['system']['account'] != SUPER_ADMIN){
            $village_id = M('admin')->where(array('id'=>$_SESSION['system']['id']))->getField('village_id');
            $company_id = M('admin')->where(array('id'=>$_SESSION['system']['id']))->getField('company_id');
            if($village_id !=0&&$company_id ==0){
                //社区管理员
                $condition_array['log.village_id']=array('eq',$village_id);

            }elseif ($village_id!=0&&$company_id!=0){
                //公司代表人
                $condition_array['log.village_id']=array('eq',$village_id);
                $condition_array['user.company_id']=array('eq',$company_id);
            }
        }

        $access_array = M('access_control_user_log')
            ->alias('Log.class')
            ->field($field)
            ->join('LEFT JOIN pigcms_house_village_user_bind user on log.pigcms_id=user.pigcms_id')
            ->join('LEFT JOIN pigcms_access_control control on log.ac_id=control.ac_id')
            ->join('LEFT JOIN pigcms_company company on user.company_id=company.company_id')
            ->join('LEFT JOIN pigcms_access_control_group g on control.ag_id=g.ag_id')
            ->join('LEFT JOIN pigcms_access_control_type type on control.actype_id=type.actype_id')
            ->join('LEFT JOIN pigcms_house_village village on log.village_id=village.village_id')
            ->where($condition_array)
            ->order('log.opdate desc')
            ->limit(500)
            ->select();
        //dump($access_array);
        /*foreach ($access_array as $key=>$value){
            if($value['name'] == null){
                unset($access_array[$key]);
            }
        }*/

        $this->assign('log_list',$access_array);
        $this->display();

    }

    /*
     * 门禁服务 -- 访客登记
     * */
    public function program_visitor_record_news(){
        $condition_table = array(
            C('DB_PREFIX') . 'House_village_user_bind' => 'n',
            C('DB_PREFIX').'user'=>'u',
            C('DB_PREFIX').'house_village'=>'v'
        );
        $condition_where="u.uid=n.uid and n.role=2 and n.village_id=v.village_id";
        if (!empty($_GET['keyword'])) {
            if ($_GET['searchtype'] == 'name') {
                $name = "n.name like '%" . $_GET['keyword'] . "%'";
                $condition_where .= ' and ' . $name;
            } else if ($_GET['searchtype'] == 'phone') {
                $phone = "n.phone like '%" . $_GET['keyword'] . "%'";
                $condition_where .= ' and ' . $phone;
            }
        }
        $t1= strtotime($_GET['startDate']);
        $t2= strtotime($_GET['endDate']);
        if($t1 && $t2){
            $date="n.add_time>='$t1'and n.add_time<='$t2'";
            $condition_where.=' and '.$date;
        }else if($t1 && !$t2){
            $date="n.add_time>='$t1'";
            $condition_where.=' and '.$date;
        }else if(!$t1 && $t2){
            $date="n.add_time<='$t2'";
            $condition_where.=' and '.$date;
        }
        if($_SESSION['system']['account'] != SUPER_ADMIN){
            $village_id = M('admin')->where(array('id'=>$_SESSION['system']['id']))->getField('village_id');
            $company_id = M('admin')->where(array('id'=>$_SESSION['system']['id']))->getField('company_id');
            if($village_id!=0&&$company_id==0){
                $condition_where.=' and v.village_id='.$village_id;
                $order = ' n.add_time DESC ';
                $condition_field = 'n.*,u.nickname,v.village_name';
                $visitor_list = D('')->field($condition_field)->table($condition_table)->where($condition_where)->order($order)->limit(100)->select();
                $result['visitor_list'] = $visitor_list;
                $this->assign('visitor_list',$result);
            }
        }else{
            $order = ' n.add_time DESC ';
            $condition_field = 'n.*,u.nickname,v.village_name';
            $visitor_list = D('')->field($condition_field)->table($condition_table)->where($condition_where)->order($order)->limit(100)->select();
            $result['visitor_list'] = $visitor_list;
            $this->assign('visitor_list',$result);
        }

        $this->display();
    }
}

