<?php
/*
 * 社区首页
 *
 */
class AccessAction extends BaseAction{
    protected $village_id;
    protected $village;
    public function _initialize(){
        parent::_initialize();
        $this->village_id = $this->house_session['village_id'];
        $this->village = D('House_village')->where(array('village_id' => $this->village_id))->find();
        if (empty($this->village)) {
            $this->error('该小区不存在！');
        }
        if ($this->village['status'] == 0) {
            $this->assign('jumpUrl', U('Index/index'));
            $this->error('您需要先完善信息才能继续操作');
        }
    }
	/*门禁列表
	 * 2016.6.17
	 * 陈琦
	 */
    public function index(){
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
            }//通过ajax改变前台页面状态
        }else{
            $condition['village_id'] = $this->village_id;
            $access_list = D('Access_control')->getlist($this->village_id);
            $this->assign('access_list', $access_list);
            $this->display();
        }
    }
	
    public function access_edit(){
        $ac_id = $_GET['ac_id'];
        $condition['village_id'] = $this->village_id;
        $access_categorys = D('access_control_group')->order('ag_id ASC')->where($condition)->select();
        $device_categorys=D('access_control_type')->select();
        if (count($access_categorys) < 1) {
            $this->error('您还未添加区域分类，请先去添加区域分类', U('Access/group_edit'));
        }
        if (count($device_categorys) < 1) {
            $this->error('您还未添加设备类型，请先去添加设备类型', U('Access/deviceType_edit'));
        }
        $this->assign('access_categorys', $access_categorys);
        $this->assign('device_categorys', $device_categorys);
        if ($ac_id) {
            $condition_table = array(C('DB_PREFIX') . 'access_control' => 'n',C('DB_PREFIX').'house_village'=>'v');
            $condition_where = " n.village_id = v.village_id and n.ac_id='$ac_id' and n.village_id='$this->village_id'";
            $condition_field = 'n.*,v.village_name';
            $access_info = D('')->table($condition_table)->where( $condition_where)->field($condition_field)->find();
           // print_r($access_info);exit;
            if (empty($access_info)) {
                $this->error('暂无此闸机');
            }
            $group = D('access_control_group')->where(array('ag_id'=>$access_info['ag_id'],'village_id'=>$this->village_id))->find();
            $device = D('access_control_type')->where(array('actype_id'=>$access_info['actype_id']))->find();
            if(empty($group)){
                $this->error('暂无此分类');
            }
            if(empty($device)){
                $this->error('暂无此设备类型');
            }
            $this->assign('group', $group);
            $this->assign('device', $device);
            $this->assign('access_info', $access_info);
        }else{
            $this->assign('access_info', null);
        }
        $this->display();
    }
	
    public function access_edit_do(){
       // $x=M('access_control')->where('ac_id=135')->data('actype_id=0')->save();
       // echo $x;exit;
        $ac_id = $_POST['ac_id'];
        if(IS_POST){
            if(empty($_POST['ac_name'])){
                $this->error('名称必填！');
            }
            if(empty($_POST['apikey'])){
                $this->error('APIKEY必填！');
            }
            if(empty($_POST['nodeid'])){
                $this->error('nodeid必填！');
            }
            //$_POST['ag_id'] = intval($_POST['ag_id']);
            // $_POST['content'] = $_POST['description'];            
            $_POST['village_id'] = $this->village_id;
            //unset($_POST['description']);
            //print_r($ac_id);exit;
            $device = D('access_control_type')->where(array('actype_id'=>$_POST['actype_id']))->find();
            import('@.ORG.Yeelink');
            $yeelink=new Yeelink($apikey=$_POST['apikey'],$deviceid=$_POST['nodeid']);
            $ac_control=array('ac_name'=>$_POST['ac_name'],'ac_desc'=>$_POST['ac_desc']);
            if($ac_id){
                $condition_village['village_id'] = $this->village_id;
                $condition_village['ac_id'] = $ac_id;
                $access_info = D('access_control')->where($condition_village)->find();
                if(empty($access_info)){
                    $this->error('暂无此闸机');
                }
                $group = D('access_control_group')->where(array('ag_id'=>$_POST['ag_id'],'village_id'=>$this->village_id))->find();
               // print_r($device);exit;
                if(empty($group)){
                    $this->error('暂无此区域');
                }
                if(empty($device)){
                    $this->error('暂无此设备类型');
                }
                $arr= $yeelink->saveSensor($ac_control,$sensorid=$_POST['sensorid']);
              // echo $_POST['ac_desc'];exit;
                $result = M('access_control')->where($condition_village)->data($_POST)->save();
                if($result !== false){
                    $this->success('修改成功！',U('Access/index'));
                }else{
                    $this->error('修改失败！请重试。');
                }
            }else{
                $_POST['ac_time'] = $_SERVER['REQUEST_TIME'];
                $ac_type=array('actype_value'=>$device['actype_value']);
               // print_r($ac_type);exit;
                $yeelink_arr= $yeelink->saveSensor($ac_control,$sensorid='',$ac_type);
                //print_r($yeelink_arr);exit;
                $_POST['sensorid']=$yeelink_arr['sensor_id'];
                //print_r($yeelink_arr);exit;
               if(!$yeelink_arr['sensor_id']){
                   $this->error($yeelink_arr['error']);
                }
                $result = M('access_control')->data($_POST)->add();
               // print_r($_POST);exit;
                if($result){
                    $this->success('添加成功！',U('Access/index'));
                }else{
                    $this->error('添加失败！请重试。');
                }
            }
        }
    }
	
    public function access_del(){
        if (IS_GET) {
            $ac_id=I('get.ac_id');
            // $data = D('access_control');
            //$del=$data->where('ac_id='.$ac_id)->delete();
            $device=M('access_control')->where('ac_id='.$ac_id)->find();
            import('@.ORG.Yeelink');//引入接口
            $yeelink=new Yeelink($apikey=$device['apikey'],$deviceid=$device['nodeid']);//传入apikey、节点id
            //print_r($yeelink);exit;
            $yeelink_arr= $yeelink->delSensor($sensorid=$device['sensorid']);//调用该类内删除传感器的方法，并传入传感器id
            //print_r($yeelink_arr);exit;
            $del=M('access_control')->where('ac_id='.$ac_id)->delete();
            //$del=M('access_control')->where(array('ac_id'=>$ac_id))->delete();
            if($del){
                $this->success('删除成功！');
            }else{
                $this->error('删除失败！请重试~');
            }
        }
    }
	
    public function group(){
        $condition_table = array(C('DB_PREFIX') . 'access_control_group' => 'c',C('DB_PREFIX').'house_village'=>'v');
        $condition_where = " c.village_id = v.village_id and c.village_id=".$this->village_id;
        $condition_field = 'c.*,v.village_name';
        $count_group=D('')->table($condition_table)->where($condition_where)->field($condition_field)->count();
        import('@.ORG.merchant_page');
        $p=new Page($count_group,15,'page');
        $pagebar=$p->show();
        $order = ' c.ag_id DESC ';
        $access_categorys = D('')->table($condition_table)->where( $condition_where)->field($condition_field)->order($order)->limit($p->firstRow.','.$p->listRows)->select();
        //  print_r($access_categorys);exit;
        $this->assign('pagebar',$pagebar);
        $this->assign('access_categorys', $access_categorys);
        $this->display();
    }
	
    public function group_edit(){
        $ag_id = intval($_GET['ag_id']);
        if ($ag_id) {
            $condition['village_id'] = $this->village_id;
            $condition['ag_id'] = $_GET['ag_id'];
            $access_categorys = D('access_control_group')->where($condition)->find();
            if (!$access_categorys) {
                $this->error('此区域不存在');
            }
            $this->assign('ag_id', $ag_id);
            $this->assign('group_info', $access_categorys);
        }
        $this->display();
    }
	
    public function group_edit_do(){
        $ag_id = intval($_POST['ag_id']);
        if($ag_id){
            $condition['village_id'] = $this->village_id;
            $condition['ag_id'] = $ag_id;
            $access_categorys = D('access_control_group')->where($condition)->find();
            if(!$access_categorys){
                $this->error('此区域不存在');
            }
            $data['ag_name'] = $_POST['ag_name'];
            $data['ag_desc'] = $_POST['ag_desc'];
            $result = D('access_control_group')->where($condition)->save($data);
            if($result !== false){
                $this->success('修改成功！',U('Access/group'));
            }else{
                $this->error('修改失败！请重试。');
            }
        }else{
            // 添加
            $data['ag_name'] = $_POST['ag_name'];
            $data['ag_desc'] = $_POST['ag_desc'];
            $data['village_id'] = $this->village_id;
            $result = D('access_control_group')->data($data)->add();
            if($result !== false){
                $this->success('添加成功！',U('Access/group'));
            }else{
                $this->error('添加失败！请重试。');
            }
        }
        $this->assign('access_categorys',$access_categorys);
    }
	
    public function group_del(){
        if (IS_GET) {
            $ag_id=I('get.ag_id');
            // $data = D('house_commonphone');
            //$del=$data->where('cp_id='.$cp_id)->delete();
            $x=M('access_control')->where('ag_id='.$ag_id)->select();
            if(!$x){
            $del=M('access_control_group')->where('ag_id='.$ag_id)->delete();
            if($del){
                $this->success('删除成功！');
                }
            }else{
                $this->error('此区域下已有设备，请先删除该设备！');
            }
        }
    }
	
    public function userCheck(){
       $condition_table=array(
           'pigcms_user'=>'u',
           'pigcms_house_village_user_bind'=>'n',
           'pigcms_house_village'=>'v',
           'pigcms_company'=>'c'
       );
        $condition_where="n.ac_status>=1 and u.uid=n.uid and n.village_id=v.village_id and c.company_id=n.company_id and n.village_id=".$this->village_id;
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
        $condition_field = 'n.*,u.nickname,c.company_name';
        import('@.ORG.merchant_page');
        $order = ' n.add_time DESC ';
        $count_userCheck = D('')->table($condition_table)->where($condition_where)->count();
        $p = new Page($count_userCheck, 15, 'page');
        $village_list = D('')->field($condition_field)->table($condition_table)->where($condition_where)->order($order)->limit($p->firstRow . ',' . $p->listRows)->select();
        $userCheck_list['pagebar'] = $p->show();
        $userCheck_list['userCheck_list'] = $village_list;
        $this->assign('userCheck_list',$userCheck_list);
        $this->display();

    }

    public function userCheck_del(){
        if (IS_GET) {
            $pigcms_id=I('get.pigcms_id');
            // $data = D('house_commonphone');
            //$del=$data->where('cp_id='.$cp_id)->delete();
            $del=M('House_village_user_bind')->where('pigcms_id='.$pigcms_id)->delete();
            if($del){
                $this->success('删除成功！');
            }else{
                $this->error('删除失败！请重试~');
            }
        }
    }
	
    public function userCheck_edit(){
            $pigcms_id = $_GET['pigcms_id'];
            // echo $pigcms_id;exit;
            if ($pigcms_id) {
                //$condition_village['pigcms_id'] = $pigcms_id;
                //$check_name=$_SESSION['house_user']['truename'];
                //echo $check_name;exit;
                $condition_table = array(C('DB_PREFIX') . 'House_village_user_bind' => 'n',C('DB_PREFIX').'user'=>'u',C('DB_PREFIX').'company'=>'c') ;
                $condition_where="n.ac_status>=1 and u.uid=n.uid and c.company_id=n.company_id and n.pigcms_id=".$pigcms_id;
                $condition_field = 'n.*,u.nickname,c.company_name';
                $userCheck_info = D('')->table($condition_table)->where( $condition_where)->field($condition_field)->find();
                ///dump($userCheck_info);exit;
                $this->assign('userCheck_info', $userCheck_info);
            }
       
        $this->display();
    }
	
    public function userCheck_edit_do(){
        $pigcms_id = $_POST['pigcms_id'];
        if(IS_POST){
            if($pigcms_id){
				$find_name=M('house_village_user_bind')->where(array('pigcms_id'=>$pigcms_id,'ac_status'=>array('in','2,3,4')))->getField('name');
				if($find_name){	//判断是否已审核过
					$this->error('当前资料已审核！',U('Access/userCheck'));
				}else{
					$condition_village['pigcms_id'] = $pigcms_id;
					unset($_POST['nickname']);				
					if($_SESSION['house_user']['truename']){
						$_POST['check_name']=$_SESSION['house_user']['truename'];
					}else{
						$_POST['check_name']='社区管理员';
					}
				   // dump($_POST);
					$result =M('house_village_user_bind')->where($condition_village)->data($_POST)->save();
				   //print_r($result);exit;
					if($result){
						//审核信息推送
						$condition_table=array(C('DB_PREFIX').'House_village_user_bind'=>'n',C('DB_PREFIX').'user'=>'u');
						$condition_where="n.ac_status>=1 and u.uid=n.uid and n.pigcms_id=".$pigcms_id;
						$condition_field = 'n.*,u.openid,u.truename';       
						$userCheck_info=D('')->table($condition_table)->where($condition_where)->field($condition_field)->find();
						//dump($userCheck_info);exit;
						$time = time();
						$model=new templateNews(C('config.wechat_appid'),C('config.wechat_appsecret'));	
						if($_POST['ac_status']==2){		
							$href=C('config.site_url').'/wap.php?c=House&a=village_access_finish&village_id='.$this->village_id;
							$model->sendTempMsg('OPENTM201136105',array('href'=>$href,'wecha_id'=>$userCheck_info['openid'],'first'=>'您提交的门禁信息已通过审核！','keyword1'=>$userCheck_info['truename'],'keyword2'=>$userCheck_info['phone'],'keyword3'=>date('Y-m-d H:i:s')));
						}else if($_POST['ac_status']==3){
							$href=C('config.site_url').'/wap.php?c=House&a=village_access_next&village_id='.$this->village_id;
							$model->sendTempMsg('OPENTM201136105',array('href'=>$href,'wecha_id'=>$userCheck_info['openid'],'first'=>'您提交的门禁信息未通过审核！','keyword1'=>$userCheck_info['truename'],'keyword2'=>$userCheck_info['phone'],'keyword3'=>date('Y-m-d H:i:s')));
						}else{
							$href=C('config.site_url').'/wap.php?c=House&a=village_control_checkInfo&village_id='.$this->village_id.'&id_val='.$userCheck_info['pigcms_id'];
							//$village_info=M('house_village')->where(array('village_id'=>$this->village_id))->find();
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
							$uid_arr=M('login_user')->field('uid')->where(array('role_id'=>array('in',trim($role_str,',')),'village_id'=>$this->village_id,'status'=>1))->select();
							if(!empty($uid_arr)){
								foreach($uid_arr as $val){
									$wecha_id=M('user')->where(array('uid'=>$val['uid']))->getField('openid');
									$model->sendTempMsg('OPENTM207145917',array('href'=>$href,'wecha_id'=>$wecha_id,'first'=>'您有一个待审核的信息！','keyword1'=>'智能门禁','keyword2'=>'管理员审核','keyword3'=>date('Y-m-d H:i:s')));
								}					
							}
						}		
						$this->success('修改成功！',U('Access/userCheck'));
					}else{
						$this->error('修改失败！请重试。');
					}
				}
            }
        }
    }
	
	/* 开门记录
	* @time 2016-06-13
	* @author	小邓  <969101097@qq.com>*/
	public function operatLog(){
		//echo $this->village_id;
        $condition_table=array(
            'pigcms_access_control'=>'control',
            'pigcms_house_village_user_bind'=>'bind',
            'pigcms_access_control_user_log'=> 'Log.class',
            'pigcms_house_village'=>'village',
            'pigcms_access_control_group'=>'group',
            'pigcms_company'=>'company',
        );
        $condition_where='control.ag_id=group.ag_id and company.company_id=bind.company_id and log.ac_id=control.ac_id and log.pigcms_id=bind.pigcms_id and log.village_id=village.village_id and log.village_id='.$this->village_id;
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
        import('@.ORG.merchant_page');	//引入分页
        $condition_field='control.ac_name,control.village_id,company.company_name,bind.phone,bind.card_type,bind.usernum,bind.name,bind.company,log.log_id,log.opdate,village.village_name,group.ag_name';
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
	
	/* 开门记录删除
	* @time 2016-06-14
	* @author	小邓  <969101097@qq.com>*/
	public function operatLog_del(){
        if(IS_GET){
            $log_id=I('get.log_id');
            $del=M('access_control_user_log')->where('log_id='.$log_id)->delete();
            if($del){
                $this->success('删除成功！');
            }else{
                $this->error('删除失败！请重试~');
            }
        }
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



    public function deviceType(){
        $condition_table = array(C('DB_PREFIX') . 'access_control_type' => 't');
        $condition_field = 't.*';
        $count_group=D('')->table($condition_table)->field($condition_field)->count();
        import('@.ORG.merchant_page');
        $p=new Page($count_group,15,'page');
        $pagebar=$p->show();
        $order = ' t.actype_id DESC ';
        $device_categorys = D('')->table($condition_table)->field($condition_field)->order($order)->limit($p->firstRow.','.$p->listRows)->select();
       // print_r($device_categorys);exit;
        $this->assign('pagebar',$pagebar);
        $this->assign('device_categorys', $device_categorys);
        $this->display();


    }

    public function deviceType_edit(){
        $actype_id = intval($_GET['actype_id']);
        if ($actype_id) {
            $condition['actype_id'] = $_GET['actype_id'];
            $device_categorys = D('access_control_type')->where($condition)->find();
            if (!$device_categorys) {
                $this->error('此设备不存在');
            }
            $this->assign('actype_id', $actype_id);
            $this->assign('device_info', $device_categorys);
        }
        $this->display();
    }

    public function deviceType_edit_do(){
        $actype_id = intval($_POST['actype_id']);
        if($actype_id){
            $condition['actype_id'] = $actype_id;
            $device_categorys = D('access_control_type')->where($condition)->find();
            if(!$device_categorys){
                $this->error('此设备不存在');
            }
            $data['actype_name'] = $_POST['actype_name'];
            $data['actype_value'] = $_POST['actype_value'];
            //print_r($data['actype_value']);exit;
            $result = D('access_control_type')->where($condition)->save($data);
            if($result !== false){
                $this->success('修改成功！',U('Access/deviceType'));
            }else{
                $this->error('修改失败！请重试。');
            }
        }else{
            // 添加
            $data['actype_name'] = $_POST['actype_name'];
            $data['actype_value'] = $_POST['actype_value'];
            $result = D('access_control_type')->data($data)->add();
            if($result !== false){
                $this->success('添加成功！',U('Access/deviceType'));
            }else{
                $this->error('添加失败！请重试。');
            }
        }
        $this->assign('device_categorys',$device_categorys);
    }

    public function deviceType_del(){
        if (IS_GET) {
            $actype_id=I('get.actype_id');
            // $data = D('house_commonphone');
            //$del=$data->where('cp_id='.$cp_id)->delete();
            $x=M('access_control')->where('actype_id='.$actype_id)->select();
            if(!$x){
                $del=M('access_control_type')->where('actype_id='.$actype_id)->delete();
                if($del){
                    $this->success('删除成功！');
                }
            }else{
                $this->error('此类型下已有设备，请先删除该设备！');
            }
        }
    }

    public function visitorLog(){
        $visitor_list = D('House_village_user_bind')->getVisitor($village_id=$this->village_id);
        // $access_list =M('access_control')->where(array('village_id'=>$this->village_id))->select();
        //dump($userCheck_list);exit;
        $this->assign('visitor_list', $visitor_list);
        $this->display();
    }

    public function visitorLog_edit(){
        $pigcms_id = $_GET['pigcms_id'];
        if($pigcms_id){
            $condition_table = array(C('DB_PREFIX') . 'House_village_user_bind' => 'n',C('DB_PREFIX').'user'=>'u',C('DB_PREFIX').'house_village'=>'v') ;
            $condition_where="u.uid=n.uid and n.village_id=v.village_id and n.role=2 and n.village_id=".$this->village_id ." and n.pigcms_id=".$pigcms_id;
            $condition_field = 'n.*,u.nickname';
            $visitor_info=D('')->table($condition_table)->where($condition_where)->field($condition_field)->find();
            //dump($visitor_info);exit;
            $this->assign('visitor_info',$visitor_info);

        }
        $this->display();
    }

    public function visitorLog_del(){
		if(IS_AJAX){
			$pigcms_id=intVal($_POST['pigcms_id']);
			$del=M('House_village_user_bind')->where('pigcms_id='.$pigcms_id)->delete();
			if($del){
				$this->ajaxReturn(array('err_code'=>0,'code_data'=>'删除成功'));
			}else{
				$this->ajaxReturn(array('err_code'=>2,'code_data'=>'删除失败'));
			}
		}

    }
}
