<?php

class BaseAction extends Action{
	protected $house_session;
	protected $config;
	protected $static_path;
	protected $static_public;
	public $token;

	protected function _initialize(){
		$this->check_merchant_file();
		$this->config = D('Config')->get_config();
		$authorizeReturnInt = intval($authorizeReturn);
		if (is_numeric($authorizeReturn) && (1 < $authorizeReturnInt)) {
			$this->config['now_city'] = $authorizeReturnInt;
		}

		$this->assign('config', $this->config);
		C('config', $this->config);
		session_start();
		if ((MODULE_NAME != 'Login') && (MODULE_NAME != 'Area')){
			//$this->house_session = session('house');
			if(empty(session('house'))){//这里的session('house')是LoginAction里面创建的，为以系统管理员身份登录的session信息，若它为空，则...
				//echo M('house_village')->where(array('village_id'=>session('house_user')['village_id']))->getField('village_name');
				$_SESSION['house_user']['village_name']=M('house_village')->where(array('village_id'=>session('house_user')['village_id']))->getField('village_name');//session('house_user')是LoginAction里面创建的，为以普通用户
				//身份登录的session信息，这里获取到该用户携带的社区名称。注意读的是house_village表，根据表中village_id与session中的village_id相对应获取house_village中的village_name。充实session('house_user')
				//dump(session('house_user'));exit;
				$this->house_session = session('house_user');//这一步必须要有，将充实后的session('house_user')赋值给$this->house_session，而这个$this->house_session是后面要传到前台的
				$role_menus=M('role')->where(array('role_id'=>session('house_user')['role_id']))->getField('menus');//获取登陆信息中role_id的menu信息
				$village_arr=array();
				if(!empty($role_menus)){
					$village_menu=M('village_menu')->where(array('id'=>array('in',$role_menus),'status'=>1))->select();
					//print_r($village_menu);exit;
					foreach($village_menu as $key=>$value){
						$select_module = explode(',', $value['select_module']);
						$select_action = explode(',', $value['select_action']);
						if (in_array(MODULE_NAME, $select_module) && (empty($value['select_action']) || in_array(ACTION_NAME, $select_action))) {
							$value['is_active'] = true;
						}
						//dump(in_array(ACTION_NAME, $select_action));exit;
						$value['url']=U($value['module'].'/'.$value['action']);
						//dump($value);exit;
						if($value['fid']==0){
							$village_arr[$value['id']]=$value;
						}else{
							$village_arr[$value['fid']]['menu_list'][]=$value;
						}
					}
					foreach ($village_arr as &$value) {
						$tmp_class = '';
						if ($value['is_active'] && $value['menu_list']) {
							$tmp_class = 'open';
						}
						if ($value['is_active']) {
							$tmp_class .= ' active';
							//dump($tmp_class);
						}
						if ($value['menu_list']) {
							$tmp_class .= ' hsub';
						}
						$value['style_class'] = $tmp_class;
						//dump($tmp_class);
					}
					//dump($village_arr);exit;
				}
				$this->assign('village_arr',$village_arr);
			}else{
				$this->house_session = session('house');//若不是以普通用户身份登录进来的，则赋值。
			}
			if (empty($this->house_session)) {
				redirect(U('Login/index'));//redirect跳转
				exit();
			}

			$this->assign('house_session', $this->house_session);
			$this->token = $this->house_session['village_id'];
		}

		$this->static_path = './tpl/House/' . C('DEFAULT_THEME') . '/static/';
		$this->static_public = './static/';
		$this->assign('static_path', $this->static_path);
		$this->assign('static_public', $this->static_public);
	}

	protected function check_merchant_file(){
		$filename = substr($_SERVER['PHP_SELF'], strrpos($_SERVER['PHP_SELF'], '/') + 1);

		if ($filename == 'index.php') {
			$this->error('非法访问商家中心！');
		}
	}

	public function _empty(){
		$this->error('您访问错了！该页面不存在。');
	}

	protected function frame_main_ok_tips($tips, $time = 2, $href = ''){
		if ($href == '') {
			$tips = '<font color=\\"red\\">' . $tips . '</font>';
			$href = 'javascript:history.back(-1);';
			$tips .= '<br/><br/>系统正在跳转到上一个页面。';
		}

		if ($time != 2) {
			$tips .= $time . '秒后会提示将自动关闭，可手动关闭！';
		}

		exit('<html><head><script>window.top.msg(1,"' . $tips . '",true,' . $time . ');window.parent.frames[\'main\'].location.href="' . $href . '";</script></head></html>');
	}

	protected function error_tips($tips, $time = 2, $href = ''){
		if ($href == '') {
			$tips = '<font color=\\"red\\">' . $tips . '</font>';
			$href = 'javascript:history.back(-1);';
			$tips .= '<br/><br/>系统正在跳转到上一个页面。';
		}

		if ($time != 2) {
			$tips .= $time . '秒后会提示将自动关闭，可手动关闭！';
		}

		exit('<html><head><script>window.top.msg(0,"' . $tips . '",true,' . $time . ');location.href="' . $href . '";</script></head></html>');
	}

	protected function frame_error_tips($tips, $time = 2){
		exit('<html><head><script>window.top.msg(0,"' . $tips . '",true,' . $time . ');window.top.closeiframe();</script></head></html>');
	}

	protected function frame_submit_tips($type, $tips, $time = 3){
		if ($type) {
			exit('<html><head><script>window.top.msg(1,"' . $tips . '",true,' . $time . ');window.top.main_refresh();window.top.closeiframe();</script></head></html>');
		}
		else {
			exit('<html><head><script>window.top.msg(0,"' . $tips . '",true,' . $time . ');window.top.frames["Openadd"].history.back();window.top.closeiframebyid("form_submit_tips");</script></head></html>');
		}
	}
}

?>
