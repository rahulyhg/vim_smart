<?php
class BaseAction extends Action
{
	protected $system_session;
	protected $static_path;
	protected $static_public;

	protected function _initialize()
	{
		//二维码跳转至手机端 zhukeqin
		if(strpos($_SERVER["QUERY_STRING"],'products_qr_detail')){
            header("Location: /wap.php?g=Wap&c=Off&a=products_qr_detail_C&pro_qrcode=".$_GET['pro_qrcode']);
            die;
		}

		if(empty($_GET['system'])&&!empty($_SESSION['system_id'])){
            header("Location: http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'&system='.$_SESSION['system_id']);
            die;
		}

		$serverHost = '';

		if (function_exists('getallheaders')) {
			$allheaders = getallheaders();
			$serverHost = $allheaders['Host'];
		}

		if (empty($serverHost)) {
			$serverHost = $_SERVER['HTTP_HOST'];
		}

  //       //判断village_id权限
  //      $admin_id = $_SESSION['admin_id'];
  //       $auth_village_id_arr = D('admin')->where("id=$admin_id")->find();
  //       $auth_village_id = $auth_village_id_arr['village_id'];

  //       if (!empty($_GET['default_village_id'])) {
		// 	$v_id = $_GET['default_village_id'];
		// 	if($_SESSION['admin_name'] == 'admin'){
  //               D('admin')->where("id=$admin_id")->save(array('village_id'=>$v_id));
  //               //第二次查询更新后的数组
  //               $auth_village_id_arr = D('admin')->where("id=$admin_id")->find();
  //               $auth_village_id = $auth_village_id_arr['village_id'];
		// 	}else{
		// 		$this->error('您没有对应权限');
		// 	}

  //       }


		// //默认village_id传到get上并设置权限
  //       if (strpos($_SERVER['REQUEST_URI'],'&village_id') == false) {
  //           $_GET['village_id'] = $auth_village_id;
  //           $_SESSION['system']['village_id'] = $auth_village_id;
		// }
		
		//判断village_id权限
       $admin_id = $_SESSION['admin_id'];
        $auth_village_id_arr = D('admin')->where("id=$admin_id")->find();
        $auth_village_id = $auth_village_id_arr['village_id'];
        $village_id_list = $auth_village_id_arr['village_id_list'];
        $village_id_all = array();
        $arr = '';
        if ($village_id_list == 'all') {
        	$village_id_all = M('house_village')->field(array('village_id'))->where(array('status'=>1))->select();

            foreach ($village_id_all as $k => $v) {  //全项目包含已选的项目
                $arr .= $v['village_id'].',';                       
            }
            $arr = rtrim($arr, ",");
            $village_id_list = $arr;
            $village_id_list = explode(",", $village_id_list);
        } else {
        	$village_id_list = explode(",", $village_id_list);
        } 
        
        if (!empty($_GET['default_village_id'])) {
            $v_id = $_GET['default_village_id'];
            if(in_array($v_id, $village_id_list)){           	
                D('admin')->where("id=$admin_id")->save(array('village_id'=>$v_id));
                // 第二次查询更新后的数组
                $auth_village_id_arr = D('admin')->where("id=$admin_id")->find();
                $auth_village_id = $auth_village_id_arr['village_id'];
            }else{
                $this->error('您没有对应权限');
            }

        }

        // //默认village_id传到get上并设置权限
        if (strpos($_SERVER['REQUEST_URI'],'&village_id') == false) {
            $_GET['village_id'] = $auth_village_id;
            $_SESSION['system']['village_id'] = $auth_village_id;
		}

        //获取所有项目并传到前台
        if ($_SESSION['admin_name'] == 'admin'){
            $villageArr = D('house_village')->where(array('status'=>1))->select();
        }else{
	        $villageArr = array();
	        foreach ($village_id_list as $k => $v) {
	            $villageArr[] = D('house_village')->where("village_id=$v")->select()[0];
	        } 
        }

        //添加小区期数 by zhukeqin
		$village_info=M('house_village')->where('village_id='.$_SESSION['system']['village_id'])->find();
        if($village_info['village_type']==1){
        	if($_SESSION['admin_name'] == 'admin'){
                $project=M('house_village_project')->where('village_id='.$_SESSION['system']['village_id'])->select();
                if(!empty($_GET['default_project_id'])){
                    $_SESSION['project_id']=$_GET['default_project_id'];
				}elseif(empty($_SESSION['project_id'])){
                    $_SESSION['project_id']=$project['0']['pigcms_id'];
				}
			}else{
                $project_list=explode(',',$auth_village_id_arr['project_id']);
                if (!empty($_GET['default_project_id'])) {
                    if(in_array($_GET['default_project_id'],$project_list)){
                        $_SESSION['project_id']=$_GET['default_project_id'];
                    }else{
                        $this->error('您没有访问该期数的权限');
                    }
                }elseif(empty($_SESSION['project_id'])){
                    $_SESSION['project_id']=$project_list['0'];
                }
                $project=M('house_village_project')->where(array('pigcms_id'=>array('IN',$auth_village_id_arr['project_id'])))->select();
			}
            $this->assign('project',$project);
		}else{
        	unset($_SESSION['project_id']);
		}

        
/*dump(self::$default_village_id);
		dump($_GET['village_id']);exit;*/
//        dump($_GET['village_id']);exit;

		/*if (mt_rand(1, 5) == 1) {
			import('ORG.Net.Http');
			$http = new Http();
			$authorizeReturn = Http::curlGet('http://o2o-service.pigcms.com/authorize.php?domain=' . $serverHost);

			if ($authorizeReturn < -1) {
				$this->assign('jumpUrl', 'http://www.pigcms.com');
				$this->error('您现在访问的域名不在系统允许访问域名范围内！有疑问请联系PIGCMS！');
			}
		}*/

		$this->check_admin_file();
		$this->config = D('Config')->get_config();
		$authorizeReturnInt = intval($authorizeReturn);
		if (is_numeric($authorizeReturn) && (1 < $authorizeReturnInt)) {
			$this->config['now_city'] = $authorizeReturnInt;
		}

		$this->assign('config', $this->config);
		C('config', $this->config);
		session_start();
		//dump(2);exit;
		if (MODULE_NAME != 'Login') {
			$this->system_session = session('system');

			if (empty(session('system.account'))) {
				//优先尝试使用微信登陆
                $re = IS_WECHAT && $this->wechat_oauth_login();
				//$re = false;//测试 禁止微信登陆后台
				if(!$re){//不能使用微信登陆的话
					cookie("back_url",U(""));//记录登陆成功后跳转地址
                    header('Location: ' . U('Login/index_new'));
                    exit();
                }

            }

			$this->assign('system_session', $this->system_session);
		}

		$this->static_path = './tpl/System/Static/';
		$this->static_public = './static/';
		$this->assign('static_path', $this->static_path);
		$this->assign('static_public', $this->static_public);
		$tmerch = D('Admin')->field('menus')->where(array('id' => $this->system_session['id']))->find();

		if (empty($tmerch['menus'])) {
			$this->system_session['menus'] = '';
		}
		else {
			$this->system_session['menus'] = explode(',', $tmerch['menus']);
		}
		$database_system_menu = D('System_menu');
		$condition_system_menu['status'] = 1;
		$condition_system_menu['show'] = 1;
		$menu_list = $database_system_menu->field(true)->where($condition_system_menu)->order('`sort` DESC,`fid` ASC,`id` ASC')->select();
		//TODO:关于新版的O2O系统的权限 start
		//dump($_SESSION);exit;
		//检查当前的后台人员是否为超级管理员
		
		if($_SESSION['system']['account'] == SUPER_ADMIN){
			//dump($_SESSION['admin_name']);exit;
			$database_system_menu = D('permission_menu');
			//$condition_system_menu['status'] = 11;
			$condition_system_menu['is_show'] = 1;
			$condition_system_menu['auth_type'] = array(array('eq',3),array('eq',0), 'or') ;
			$condition_system_menu['auth_area'] = 0;
			$menu_list_new = $database_system_menu->field(true)->where($condition_system_menu)->order('sort desc')->select();
			//dump($menu_list_new);exit;
			//系统警告信息显示
			$warning_count = M('system_warning_control')->where(array('is_deal'=>0,'system_id'=>array('neq',10)))->count();
			$check_count = M('system_warning_control')->where(array('is_check'=>0,'system_id'=>array('neq',10)))->count();
			$warning_array = M('system_warning_control')->where(array('is_deal'=>0,'system_id'=>array('neq',10)))->order('create_time desc')->select();
			$deal_array = M('system_warning_control')->where(array('is_deal'=>0,'is_check'=>1,'system_id'=>array('neq',10)))->count();
			//未读邮件信息显示
			$unread_message_count = M('system_warning_control')->where(array('system_id'=>10,'is_check'=>0))->count();
			$unread_message_array = M('system_warning_control')->where(array('system_id'=>10,'is_check'=>0))->select();
			//待维修项目

            $noDealRpCount = M('house_village_repair_list')->where(array('type'=>1,'is_read'=>array('neq',1)))->count();
            //待处理投诉意见

            $noDealSgCount = M('house_village_repair_list')->where(array('type'=>3,'is_read'=>array('neq',1)))->count();
            //待处理预约

            $noDealAmCount = M('house_village_repair_list')->where(array('type'=>4,'is_read'=>array('neq',1)))->count();
            //未处理事项
            $noDealThingCount = M('house_village_repair_list')->where(array('is_read'=>array('neq',1)))->count();
            $noDealThingArray = M('house_village_repair_list')->where(array('is_read'=>array('neq',1)))->select();
            //整合数组
			$conutArray = array(
				'noDealRpCount'=>$noDealRpCount,
				'noDealSgCount'=>$noDealSgCount,
				'noDealAmCount'=>$noDealAmCount
			);

			//首页

		}else{
			//不是超级管理员的人进行权限审查
//			$O2O_role_id = M('admin')->where(array('id'=>$_SESSION['system']['id']))->getField('role_id');
//			$is_allowing_string = M('role')->where(array('role_id'=>$O2O_role_id))->getField('menus');
            //多角色权限管理修改
            $O2O_role_idStr = M('admin')->where(array('id'=>$_SESSION['system']['id']))->getField('role_id');
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
			//TODO：控制第一层--显示菜单控制
			//左边菜单栏
			$menu_list_new=M()->query("select * from pigcms_permission_menu where id in ($is_allowing_string) and auth_type=0 OR auth_type=3 and auth_area=0 and is_show=1");
//			echo M()->_sql();
//            dump($is_allowing_string);
//			dump($menu_list_new);exit;
			//访问权限控制，非法的url提交
			//TODO：控制第二层 -- 禁止url僭越访问

			/*$nowAC=MODULE_NAME.'-'.ACTION_NAME;
			$dfault_allow_auth ='Login-index_new,Login-index,Index-index_news,Index-index,Index-index_new';
			//dump($nowAC);
			if(strpos($dfault_allow_auth,$nowAC)===false){
				//不在公共方法外
				if(empty(getenv( "HTTP_REFERER" )))
				{
					//直接输入的url
					$this->error('警告！！！url僭越访问系统后台！请遵守相关法律法规');
				}
			}*/

            //待维修项目

            $noDealRpCount = M('house_village_repair_list')->where(array('type'=>1,'is_read'=>array('neq',1)))->count();
            //待处理投诉意见

            $noDealSgCount = M('house_village_repair_list')->where(array('type'=>3,'is_read'=>array('neq',1)))->count();
            //待处理预约

            $noDealAmCount = M('house_village_repair_list')->where(array('type'=>4,'is_read'=>array('neq',1)))->count();
            //未处理事项
            $noDealThingCount = M('house_village_repair_list')->where(array('is_read'=>array('neq',1)))->count();
            $noDealThingArray = M('house_village_repair_list')->where(array('is_read'=>array('neq',1)))->select();
            //整合数组
            $conutArray = array(
                'noDealRpCount'=>$noDealRpCount,
                'noDealSgCount'=>$noDealSgCount,
                'noDealAmCount'=>$noDealAmCount
            );


		}

        foreach ($menu_list_new as $k=>&$v){

            $v['url']=U($menu_list_new[$k]['module'].'/'.$menu_list_new[$k]['controller'].'/'.$menu_list_new[$k]['action']);

        }
        unset($v);

		$arr = list_to_tree($menu_list_new,'id','fid','child_list');
		/*//父级子级处理
		foreach ($menu_list_new as $k=>$v){

			$v['url']=U($menu_list_new[$k]['module'].'/'.$menu_list_new[$k]['controller'].'/'.$menu_list_new[$k]['action']);


			if($menu_list_new[$k]['fid']==0){
				$arr[$menu_list_new[$k]['id']]=$menu_list_new[$k];
			}else{

				$arr[$menu_list_new[$k]['fid']]
				['child_list']
				[]=$menu_list_new[$k];
			}

		}*/
		//模块处理
		$modelArray = M('permission_menu')->where(array('fid'=>0,'group_id'=>0,'auth_area'=>0))->order('sort desc')->select();

		//申请新菜单数组

		$newArray = array();

		foreach ($modelArray as $item=>$ms){
            $newArray[$ms['id']]=$ms;
			foreach ($arr as $ky=>$va){
				if($va['group_id']==$ms['id']){

                    $newArray[$ms['id']]['child_list'][]=$va;
				}
			}
		}

		//vd($newArray);exit;
		//TODO:剔除没有菜单的模块
		foreach ($newArray as $key1=>$value1){
			if(!isset($value1['child_list'])) unset($newArray[$key1]);
		}
		//vd($newArray);exit;

		//dump($arr);exit;
		//获取面包屑导航
		foreach($arr as $key=>$row){
			foreach($row['child_list'] as $kk=>$rr){
				if(strpos($row['url'],$rr['url'])!==false){
                    $breadcrumb = array(
                        array($row['name'],'#'),
                        array($row['child_list'][$kk]['name'],'#'),
                    );
                    break;
				}
			}
		}
        $this->assign('breadcrumb',$breadcrumb);
        //获取面包屑导航结束
//		dump($newArray);exit;
		$this->assign('arr',$newArray);
		$this->assign('auth_village_id',$auth_village_id);
        $this->assign('villageArr',$villageArr);
		//vd($noDealThingArray);
		$this->assign('check_count',$check_count);
		$this->assign('warning_count',$warning_count);
		$this->assign('warning_array',$warning_array);
		$this->assign('unread_message_count',$unread_message_count);
		$this->assign('unread_message_array',$unread_message_array);
        $this->assign('conutArray',$conutArray);
        $this->assign('noDealThingCount',$noDealThingCount);
        $this->assign('noDealThingArray',$noDealThingArray);
		$this->assign('deal_array',$deal_array);
		//TODO:关于新版的O2O系统的权限 end
		$flag = false;
		
		/*if (('login' == strtolower(MODULE_NAME)) && ('index_new' == strtolower(ACTION_NAME))) {

			$this->redirect(U('Index/index_new'));

		}*/
		$module = $action = '';

		foreach ($menu_list as $key => $value) {
			if ((strtolower($value['module']) == strtolower(MODULE_NAME)) && (strtolower($value['action']) == strtolower(ACTION_NAME))) {
				
				if (!empty($this->system_session['menus']) && !in_array($value['id'], $this->system_session['menus'])) {
					$flag = true;
					continue;
				}
			}

			if (empty($value['area_access']) && $this->system_session['area_id']) {
				continue;
			}

			if (!empty($this->system_session['menus']) && !in_array($value['id'], $this->system_session['menus'])) {
				continue;
			}

			if (empty($module)) {
				$module = ucfirst($value['module']);
			}

			if (empty($action)) {
				$action = $value['action'];
			}

			$value['name'] = str_replace('订餐', $this->config['meal_alias_name'], $value['name']);
			$value['name'] = str_replace('餐饮', $this->config['meal_alias_name'], $value['name']);
			$value['name'] = str_replace('团购', $this->config['group_alias_name'], $value['name']);

			if ($value['fid'] == 0) {
				$system_menu[$value['id']] = $value;
			}
			else {
				$system_menu[$value['fid']]['menu_list'][] = $value;
			}
		}

		if ($flag) {
			if (('index' == strtolower(MODULE_NAME)) && ('main' == strtolower(ACTION_NAME))) {
				$this->redirect(U($module . '/' . $action));
			}

			else {
				$this->error('您还没有这个使用权限，联系管理员开通！', U($module . '/' . $action));
			}

		}
		$this->assign('system_menu', $system_menu);
		//dump($system_menu);exit;
		if ($_GET['frame']) {
			$this->assign('bg_color', '#F3F3F3');
		}
	}

	protected function check_admin_file()
	{
		$filename = substr($_SERVER['PHP_SELF'], strrpos($_SERVER['PHP_SELF'], '/') + 1);

		if ($filename == 'index.php') {
			$this->error('非法访问系统后台！');
		}
	}

	public function _empty()
	{
		exit('对不起，您访问的页面不存在！');
	}

	protected function frame_main_ok_tips($tips, $time = 3, $href = '')
	{
		if ($href == '') {
			$tips = '<font color=\\"red\\">' . $tips . '</font>';
			$href = 'javascript:history.back(-1);';
			$tips .= '<br/><br/>系统正在跳转到上一个页面。';
		}

		if ($time != 3) {
			$tips .= $time . '秒后会提示将自动关闭，可手动关闭！';
		}

		exit('<html><head><script>window.top.msg(1,"' . $tips . '",true,' . $time . ');window.parent.frames[\'main\'].location.href="' . $href . '";</script></head></html>');
	}

	protected function error_tips($tips, $time = 3, $href = '')
	{
		if ($href == '') {
			$tips = '<font color=\\"red\\">' . $tips . '</font>';
			$href = 'javascript:history.back(-1);';
			$tips .= '<br/><br/>系统正在跳转到上一个页面。';
		}

		if ($time != 3) {
			$tips .= $time . '秒后会提示将自动关闭，可手动关闭！';
		}

		exit('<html><head><script>window.top.msg(0,"' . $tips . '",true,' . $time . ');location.href="' . $href . '";</script></head></html>');
	}

	protected function frame_error_tips($tips, $time = 3)
	{
		exit('<html><head><script>window.top.msg(0,"' . $tips . '",true,' . $time . ');window.top.closeiframe();</script></head></html>');
	}

	protected function frame_submit_tips($type, $tips, $time = 3)
	{
		if ($type) {
			exit('<html><head><script>window.top.msg(1,"' . $tips . '",true,' . $time . ');window.top.main_refresh();window.top.closeiframe();</script></head></html>');
		}
		else {
			exit(
				'<html><head><script>window.top.msg(0,"' . $tips . '",true,' . $time . ');
				window.top.frames["Openadd"].history.back();
				window.top.closeiframebyid("form_submit_tips");</script></head></html>'
			);
		}
	}

	final public function httpRequest($url, $method = 'GET', $postfields = NULL, $headers = array(), $debug = false)
	{
		$method = strtoupper($method);
		$ci = curl_init();
		curl_setopt($ci, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
		curl_setopt($ci, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:34.0) Gecko/20100101 Firefox/34.0');
		curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, 60);
		curl_setopt($ci, CURLOPT_TIMEOUT, 7);
		curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);

		switch ($method) {
		case 'POST':
			curl_setopt($ci, CURLOPT_POST, true);

			if (!empty($postfields)) {
				$tmpdatastr = (is_array($postfields) ? http_build_query($postfields) : $postfields);
				curl_setopt($ci, CURLOPT_POSTFIELDS, $tmpdatastr);
			}

			break;

		default:
			curl_setopt($ci, CURLOPT_CUSTOMREQUEST, $method);
			break;
		}

		$ssl = (preg_match('/^https:\\/\\//i', $url) ? true : false);
		curl_setopt($ci, CURLOPT_URL, $url);

		if ($ssl) {
			curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ci, CURLOPT_SSL_VERIFYHOST, false);
		}

		curl_setopt($ci, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ci, CURLOPT_MAXREDIRS, 2);
		curl_setopt($ci, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ci, CURLINFO_HEADER_OUT, true);
		$response = curl_exec($ci);
		$requestinfo = curl_getinfo($ci);
		$http_code = curl_getinfo($ci, CURLINFO_HTTP_CODE);

		if ($debug) {
			echo "=====post data======\r\n";
			var_dump($postfields);
			echo "=====info===== \r\n";
			print_r($requestinfo);
			echo "=====response=====\r\n";
			print_r($response);
		}

		curl_close($ci);
		return array($http_code, $response, $requestinfo);
	}

    /**
     * 微信登陆智慧助手后台
     * @return bool
     */
	public function wechat_oauth_login(){
		$model = new WechatModel();
		$oauth_info = $model->oauth();
		session('oauth_info',$oauth_info);//微信端进入后台后获取的微信用户信息
        $database_admin = D('Admin');
		$admin =$database_admin->where('openid="%s" and status=%d',$oauth_info['openid'],1)->find();

        //设置session
        if($admin){
                $admin['show_account'] = '超级管理员';

                if ($admin['level'] == 1) {

                    if ($admin['area_id']) {

                        $area = D('Area')->field(true)->where(array('area_id' => $admin['area_id']))->find();

                        $admin['show_account'] = $area['area_name'] . '管理员';

                    }

                } else {
                    $admin['show_account'] = '普通管理员';
                }

                $car_role_id = D('role')->where(array('role_id'=>$admin['role_id']))->getField('car_role_id');
                session('role_id', $car_role_id);
                session('admin_id', $admin['id']);
                session('admin_name', $admin['account']);

                $data_admin['id'] = $admin['id'];

                $data_admin['last_ip'] = get_client_ip(1);

                $data_admin['last_time'] = $_SERVER['REQUEST_TIME'];

                $data_admin['login_count'] = $admin['login_count']+1;

                if($database_admin->data($data_admin)->save()) {

                    $admin['login_count'] += 1;

                    import('ORG.Net.IpLocation');

                    $IpLocation = new IpLocation();

                    $last_location = $IpLocation->getlocation(long2ip($admin['last_ip']));

                    $admin['last']['country'] = iconv('GBK', 'UTF-8', $last_location['country']);

                    $admin['last']['area'] = iconv('GBK', 'UTF-8', $last_location['area']);

                    session('system', $admin);

                    return true;
                }

            }

        return false;

	}
    /**
     * 操作错误但不跳转的快捷方法
     * @access protected
     * @param string $message 错误信息
     * @param string $jumpUrl 页面跳转地址
     * @param mixed $ajax 是否为Ajax方式 当数字时指定跳转时间
     * @return void
     */
    protected function error_new($message='',$jumpUrl='',$ajax=false) {
        $this->dispatchJump_new($message,0,$jumpUrl,$ajax);
    }
    /**
     * 操作成功但不跳转的快捷方法
     * @access protected
     * @param string $message 提示信息
     * @param string $jumpUrl 页面跳转地址
     * @param mixed $ajax 是否为Ajax方式 当数字时指定跳转时间
     * @return void
     */
    protected function success_new($message='',$jumpUrl='',$ajax=false) {
        $this->dispatchJump_new($message,1,$jumpUrl,$ajax);
    }
    /**
     * 默认跳转操作 支持错误导向和正确跳转
     * 调用模板显示 默认为public目录下面的success页面
     * 提示页面为可配置 支持模板标签
     * @param string $message 提示信息
     * @param Boolean $status 状态
     * @param string $jumpUrl 页面跳转地址
     * @param mixed $ajax 是否为Ajax方式 当数字时指定跳转时间
     * @access private
     * @return void
     */
    private function dispatchJump_new($message,$status=1,$jumpUrl='',$ajax=false) {
        /*if(true === $ajax || IS_AJAX) {// AJAX提交
            $data           =   is_array($ajax)?$ajax:array();
            $data['info']   =   $message;
            $data['status'] =   $status;
            $data['url']    =   $jumpUrl;
            $this->ajaxReturn($data);
        }*/
        if(is_int($ajax)) $this->assign('waitSecond',$ajax);
        if(!empty($jumpUrl)) $this->assign('jumpUrl',$jumpUrl);
        // 提示标题
        $this->assign('msgTitle',$status? L('_OPERATION_SUCCESS_') : L('_OPERATION_FAIL_'));
        //如果设置了关闭窗口，则提示完毕后自动关闭窗口
        if($this->get('closeWin'))    $this->assign('jumpUrl','javascript:window.close();');
        $this->assign('status',$status);   // 状态
        //保证输出不受静态缓存影响
        C('HTML_CACHE_ON',false);
        if($status) { //发送成功信息
            $this->assign('message',$message);// 提示信息
            // 成功操作后默认停留1秒
            if(!isset($this->waitSecond))    $this->assign('waitSecond','1');
            // 默认操作成功自动返回操作前页面
            if(!isset($this->jumpUrl)) $this->assign("jumpUrl",$_SERVER["HTTP_REFERER"]);
            $this->display(C('TMPL_ACTION_SUCCESS_NEW'));
        }else{
            $this->assign('error',$message);// 提示信息
            //发生错误时候默认停留3秒
            if(!isset($this->waitSecond))    $this->assign('waitSecond','3');
            // 默认发生错误的话自动返回上页
            if(!isset($this->jumpUrl)) $this->assign('jumpUrl',"javascript:history.back(-1);");
            $this->display(C('TMPL_ACTION_ERROR_NEW'));
            // 中止执行  避免出错后继续执行
            exit ;
        }
    }
}

?>
