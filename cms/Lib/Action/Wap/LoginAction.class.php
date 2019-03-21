<?php
class LoginAction extends BaseAction{
	public function index(){
		if(IS_POST){
			$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
			$pwd = isset($_POST['password']) ? $_POST['password'] : '';

			import("@.ORG.UcService");//导入UcService.class.php类
			$ucService = new UcService;
//        验证同步登录的账号密码的正确性
			$uidarray = $ucService->uc_login($phone, $pwd);
			$ucarray = $ucService->uc_synlogin($uidarray);
			if(is_array($uidarray)) {
//				或取头像
//				$pic = $ucService->uc_avatar($uidarray['uid'],'',0);
//				dump($pic) ;exit;
//				if(!empty($uidarray['phone'])){
					$uid =  M('User')->where('phone='.$uidarray['phone'])->getField("uid");
//                判断用户是否在此注册过
					if($uid){
//                    登录
						$login_result = D('User')->checkin($_POST['phone'],$_POST['password']);
					}else{
//                   添加登录
						$data_user['phone'] = $phone;
						$data_user['pwd'] = md5($pwd);
						$data_user['nickname'] = substr($phone,0,3).'****'.substr($phone,7);
						$data_user['add_time'] = $data_user['last_time'] = $_SERVER['REQUEST_TIME'];
						$data_user['add_ip'] = $data_user['last_ip'] = get_client_ip(1);
						$data_user['uc_id'] = $uidarray['uid'];
						if(D('User')->data($data_user)->add()){
							$login_result = D('User')->checkin($_POST['phone'],$_POST['password']);
						}
					}
//				}else{
//					$this->error('用户未绑定手机号');
//				}
			} elseif($uidarray == -1) {
//                解决老用户的问题
				$od_uid =  M('User')->where('phone='.$phone)->find();
				if(!empty($od_uid)){
					if($od_uid['pwd'] != md5($pwd)){
						$this->error('密码错误');
					}
					$data_user['phone'] = $phone;
					$data_user['nickname'] = substr($phone,0,3).'****'.substr($phone,7);
					$data_user['add_time'] = $data_user['last_time'] = $_SERVER['REQUEST_TIME'];
					$data_user['add_ip'] = $data_user['last_ip'] = get_client_ip(1);
					$uc = import("@.ORG.UcService");//导入UcService.class.php类
					$ucService = new UcService;//实例化UcService类
					$uid = $ucService->register($phone, $pwd,$phone,$data_user['add_time'],'','',$data_user['add_ip'],$data_user['add_time'],$data_user['add_time']);//注册到UCenter
					if($uid>0){
						M('User')->where('phone='.$phone)->setField('uc_id',$uid);
						$login_result = D('User')->checkin($phone, $pwd);
					}else{
						$this->error('账号有误');
					}
				}else{
					$this->error('用户不存在,或者被删除');
				}
			} elseif($uidarray == -2) {
				$this->error('密码错误');
			} elseif($uidarray == -3) {
				$this->error('安全提问错误');
			} else {
				$this->error('未知错误');
			}
//			if (empty($result['error_code'])) {
//				session('user', $result['user']);
//			}
//			$login_result = D('User')->checkin($_POST['phone'],$_POST['password']);
			if($login_result['error_code']){
				$this->error($login_result['msg']);
			}else{
				$now_user = $login_result['user'];
				session('user',$now_user);
				setcookie('login_name',$now_user['phone'],$_SERVER['REQUEST_TIME']+10000000,'/');
//				echo $ucarray;
				$this->success('登录成功！');
			}
		}else{
			if(!empty($this->user_session)){
				redirect(U('My/index'));
			}
			
			if($_GET['referer']){
				$referer = $_GET['referer'];
			}else{
				$referer = $_SERVER['HTTP_REFERER'];
			}
			$this->assign('referer',$referer);
			
			if($this->is_wexin_browser){
				redirect(U('Login/weixin',array('referer'=>urlencode($referer))));exit;
			}
			$this->display();
		}
	}
	public function reg(){
		if(IS_POST){
			$condition_user['phone'] = $data_user['phone'] = trim($_POST['phone']);
			
			$database_user = D('User');
			if($database_user->field('`uid`')->where($condition_user)->find()){
				$this->error('手机号已存在');
			}
			
			if(empty($data_user['phone'])){
				$this->error('请输入手机号');
			}else if(empty($_POST['password'])){
				$this->error('请输入密码');
			}

			if(!preg_match('/^[0-9]{11}$/',$data_user['phone'])){
				$this->error('请输入有效的手机号');
			}
			
			$data_user['pwd'] = md5($_POST['password']);
			
			$data_user['nickname'] = substr($data_user['phone'],0,3).'****'.substr($data_user['phone'],7);
			
			$data_user['add_time'] = $data_user['last_time'] = $_SERVER['REQUEST_TIME'];
			$data_user['add_ip'] = $data_user['last_ip'] = get_client_ip(1);
			//uc整合
			$uc = import("@.ORG.UcService");//导入UcService.class.php类
			$ucService = new UcService;//实例化UcService类
			$uid = $ucService->register($data_user['phone'], $_POST['password'],$data_user['phone'],$data_user['add_time'],'','',$data_user['add_ip'],$data_user['add_time'],$data_user['add_time']);//注册到UCenter
			if($uid <= 0) {
				if ($uid == -1) {
					$this->error('用户名不合法');
				} elseif ($uid == -2) {
					$this->error('包含不允许注册的词语');
				} elseif ($uid == -3) {
					$this->error('用户名已经存在,您可以直接登录');
				} elseif ($uid == -4) {
					$this->error('Email 格式有误');
				} elseif ($uid == -5) {
					$this->error('Email 不允许注册');
				} elseif ($uid == -6) {
					$this->error('该 Email 已经被注册');
				} else {
					$this->error('未知错误');
				}
			}else{
				/****判断此用户是否在user_import表中***/
				$user_importDb=D('User_import');
				$user_import=$user_importDb->where(array('telphone'=>$condition_user['phone'],'isuse'=>'0'))->find();
				if(!empty($user_import)){
					$data_user['truename']=$user_import['ppname'];
					$data_user['qq']=$user_import['qq'];
					$data_user['email']=$user_import['email'];
					$data_user['level']=$user_import['level'];
					$data_user['score_count']=$user_import['integral'];
					$data_user['now_money']=$user_import['money'];
					$data_user['importid']=$user_import['id'];
					$data_user['uc_id'] = $uid;
				}
				$data_user['uc_id'] = $uid;
//				dump($data_user);exit;
				if($uid = $database_user->data($data_user)->add()){
					$session['uid'] = $uid;
					$session['phone'] = $data_user['phone'];
					session('user',$session);

					setcookie('login_name',$session['phone'],$_SERVER['REQUEST_TIME']+1000000,'/');
					if(!empty($user_import)){
						$user_importDb->where(array('id'=>$user_import['id']))->save(array('isuse'=>2));
					}
					$this->success('注册成功');
				}else{
					$this->error('注册失败！请重试。');
				}
			}
		}else{
			if(!empty($this->user_session)){
				redirect(U('My/index'));
			}
			$this->display();
		}
	}
	public function logout(){
		session('user',null);
		session('openid',null);
		//uc整合同步退出
		$uc = import("@.ORG.UcService");//导入UcService.class.php类
		$ucService = new UcService;//实例化UcService类
		$logout = $ucService->user_synlogout();
		echo $logout;
		redirect(U('Home/index'));
	}
	public function weixin(){
		$_SESSION['weixin']['referer'] = !empty($_GET['referer']) ? htmlspecialchars_decode($_GET['referer']) : U('Home/index');
		$_SESSION['weixin']['state']   = md5(uniqid());
		
		$customeUrl = $this->config['site_url'].'/wap.php?c=Login&a=weixin_back';
		$oauthUrl='https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$this->config['wechat_appid'].'&redirect_uri='.urlencode($customeUrl).'&response_type=code&scope=snsapi_userinfo&state='.$_SESSION['weixin']['state'].'#wechat_redirect';
		redirect($oauthUrl);
	}
	public function weixin_back(){
		$referer = !empty($_SESSION['weixin']['referer']) ? $_SESSION['weixin']['referer'] : U('Home/index');
		
		// if (isset($_GET['code']) && isset($_GET['state']) && ($_GET['state'] == $_SESSION['weixin']['state'])){
		if (isset($_GET['code'])){
			unset($_SESSION['weixin']['state']);
			import('ORG.Net.Http');
			$http = new Http();
			$return = $http->curlGet('https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$this->config['wechat_appid'].'&secret='.$this->config['wechat_appsecret'].'&code='.$_GET['code'].'&grant_type=authorization_code');
			$jsonrt = json_decode($return,true);
			if($jsonrt['errcode']){
				$error_msg_class = new GetErrorMsg();
				$this->error_tips('授权发生错误：'.$error_msg_class->wx_error_msg($jsonrt['errcode']),U('Login/index'));
			}
			
			$return = $http->curlGet('https://api.weixin.qq.com/sns/userinfo?access_token='.$jsonrt['access_token'].'&openid='.$jsonrt['openid'].'&lang=zh_CN');
			$jsonrt = json_decode($return,true);
			if ($jsonrt['errcode']) {
				$error_msg_class = new GetErrorMsg();
				$this->error_tips('授权发生错误：'.$error_msg_class->wx_error_msg($jsonrt['errcode']),U('Login/index'));
			}
			if(!empty($this->user_session)){
				$data_user = array(
					'union_id' 	=> ($jsonrt['unionid'] ? $jsonrt['unionid'] : ''),
					'sex' 		=> $jsonrt['sex'],
					'province' 	=> $jsonrt['province'],
					'city' 		=> $jsonrt['city'],
					'avatar' 	=> $jsonrt['headimgurl'],
					'last_weixin_time' 	=> $_SERVER['REQUEST_TIME'],
				);
				D('User')->where(array('uid'=>$this->user_session['uid']))->data($data_user)->save();
			}else{
				/*优先使用 unionid 登录*/
				if(!empty($jsonrt['unionid'])){
                    $is_old_user = M('user')->where(array('unionid'=>$jsonrt['unionid']))->find();
                    if($is_old_user){
                        $this->autologin('unionid',$jsonrt['unionid'],$referer);
                    }else{
                        $info=M('user')->where(array('openid'=>$jsonrt['openid']))->find();
                        if(!$info){
                            //没有查到相关信息，查一下nickname
                            /*$after_name=preg_replace('/[\x{10000}-\x{10FFFF}]/u', '', $jsonrt['nickname']);//去除非3字节的特殊符号
                            if($after_name){
                                $is_old = M('user')->where(array('nickname'=>$after_name))->find();
                                if($is_old){
                                    //是老用户
                                    $updateArray = array(
                                        'openid'=>$jsonrt['openid'],
                                        'unionid'=>$jsonrt['unionid'],
                                        'update_time'=>time()
                                    );
                                    M('user')->where(array('uid'=>$is_old['uid']))->data($updateArray)->save();
                                }
                            }*/

                        }
                        $this->autologin('openid',$jsonrt['openid'],$referer);
                    }
				}else{
					/*再次使用 openid 登录*/
                    $time=time();
                    $info=M('user')->where(array('openid'=>$jsonrt['openid']))->find();
                    if(!$info){
                        //没有查到相关信息，查一下nickname
                        $after_name=preg_replace('/[\x{10000}-\x{10FFFF}]/u', '', $jsonrt['nickname']);//去除非3字节的特殊符号
                        if(str_replace(' ','',$after_name)!=''){
//                            $is_old = M('user')->where(array('nickname'=>$after_name))->find();
//                            if($is_old){
//                                //是老用户
//                                $updateArray = array(
//                                    'openid'=>$jsonrt['openid'],
//                                    'unionid'=>$jsonrt['unionid'],
//                                    'update_time'=>time()
//                                );
//                                M('user')->where(array('uid'=>$is_old['uid']))->data($updateArray)->save();
//                            }
                        }else{
                            $data_user = array(
                                'openid' 	=> $jsonrt['openid'],
                                'unionid' 	=> ($jsonrt['unionid'] ? $jsonrt['unionid'] : ''),
                                'nickname' 	=> '匿名用户'.rand(1000,9999),
                                'sex' 		=> $jsonrt['sex'],
                                'province' 	=> $jsonrt['province'],
                                'city' 		=> $jsonrt['city'],
                                'avatar' 	=> $jsonrt['headimgurl'],
                            );
                            $_SESSION['weixin']['user'] = $data_user;
                            $this->assign('referer',$referer);
                            redirect(U('Login/weixin_nobind'));
                        }

                    }
                    if(($time-$info['update_time'])>30*24*60*60){
                        M('user')->where(array('openid'=>$jsonrt['openid']))->data(array('nickname'=>$jsonrt['nickname'],'avatar'=>$jsonrt['headimgurl'],'update_time'=>$time))->save();
                    }
					$this->autologin('openid',$jsonrt['openid'],$referer);
				}
			}
//			dump($jsonrt['openid']);exit;
			$u_id = D('User')->where(array('openid'=>$jsonrt['openid']))->getField('uid');
			/*注册用户*/
			if(empty($u_id)){
			    //新版干掉emoji表情方法  by zhukeqin
                $after_name=D('User')->checkout_emoji($jsonrt['nickname']);
				$data_user = array(
					'openid' 	=> $jsonrt['openid'],
					'unionid' 	=> ($jsonrt['unionid'] ? $jsonrt['unionid'] : ''),
					'nickname' 	=> $after_name!=''?$after_name:'匿名用户'.rand(1000,9999),
					'sex' 		=> $jsonrt['sex'],
					'province' 	=> $jsonrt['province'],
					'city' 		=> $jsonrt['city'],
					'avatar' 	=> $jsonrt['headimgurl'],
				);
				$_SESSION['weixin']['user'] = $data_user;
				$this->assign('referer',$referer);
				redirect(U('Login/weixin_nobind'));
			}else{
			    $time=time();
			    $info=M('user')->where(array('openid'=>$jsonrt['openid']))->find();
			    if(($time-$info['update_time'])>30*24*60*60){
			        M('user')->where(array('openid'=>$jsonrt['openid']))->data(array('nickname'=>$jsonrt['nickname'],'avatar'=>$jsonrt['headimgurl'],'update_time'=>$time))->save();
                }
				$this->autologin('openid',$jsonrt['openid'],$referer);
			}
		}else{
			$this->error_tips('访问异常！请重新登录。',U('Login/index',array('referer'=>urlencode($referer))));
		}
	}

	public function weixin_bind(){
		if(empty($_SESSION['weixin']['user'])){
			$this->error('微信授权失效，请重新登录！');
		}
		$data_user['pwd'] = $_POST['password'];
		$data_user['nickname'] = substr($data_user['phone'],0,3).'****'.substr($data_user['phone'],7);
		$data_user['add_time'] = $data_user['last_time'] = $_SERVER['REQUEST_TIME'];
		$data_user['add_ip'] = $data_user['last_ip'] = get_client_ip(1);
		//uc整合
		$uc = import("@.ORG.UcService");//导入UcService.class.php类
		$ucService = new UcService;//实例化UcService类
		$uid = $ucService->register($data_user['phone'], $_POST['password'],$data_user['phone'],$data_user['add_time'],'','',$data_user['add_ip'],$data_user['add_time'],$data_user['add_time']);//注册到UCenter
		if($uid <= 0) {
			if ($uid == -1) {
				$this->error('用户名不合法');
			} elseif ($uid == -2) {
				$this->error('包含不允许注册的词语');
			} elseif ($uid == -3) {
				$this->error('用户名已经存在,您可以直接登录');
			} elseif ($uid == -4) {
				$this->error('Email 格式有误');
			} elseif ($uid == -5) {
				$this->error('Email 不允许注册');
			} elseif ($uid == -6) {
				$this->error('该 Email 已经被注册');
			} else {
				$this->error('未知错误');
			}
		}else{
			$login_result = D('User')->checkin($_POST['phone'],$_POST['password']);
		}
		if($login_result['error_code']){
			$this->error($login_result['msg']);
		}else{
			$now_user = $login_result['user'];
			$condition_user['uid'] = $now_user['uid'];
			$data_user['openid'] = $_SESSION['weixin']['user']['openid'];
			if($_SESSION['weixin']['user']['union_id']){
				$data_user['union_id'] 	= $_SESSION['weixin']['user']['union_id'];
			}
			if(empty($now_user['avatar'])){
				$data_user['avatar'] 	= $_SESSION['weixin']['user']['avatar'];
			}
			if(empty($now_user['sex'])){
				$data_user['sex']		= $_SESSION['weixin']['user']['sex'];
			}
			if(empty($now_user['province'])){
				$data_user['province'] 	= $_SESSION['weixin']['user']['province'];
			}
			if(empty($now_user['city'])){
				$data_user['city'] 		= $_SESSION['weixin']['user']['city'];
			}
			/****判断此用户是否在user_import表中***/
			$user_importDb=D('User_import');
			$user_import=$user_importDb->where(array('telphone'=>$condition_user['phone']))->find();
			if(!empty($user_import)){
			 if($user_import['isuse']==0){
			   $data_user['truename']=$user_import['ppname'];
			   $data_user['qq']=$user_import['qq'];
			   $data_user['email']=$user_import['email'];
			   $data_user['level']=$user_import['level'];
			   $data_user['score_count']=$user_import['integral'];
			   $data_user['now_money']=$user_import['money'];
			   $data_user['importid']=$user_import['id'];
			 }
			   $mer_id=$user_import['mer_id'];
			   if($mer_id>0){
			      $merchant_user_relationDb=M('Merchant_user_relation');
				  $mwhere=array('openid'=>$data_user['openid'],'mer_id'=>$mer_id);
				  $mtmp=$merchant_user_relationDb->where($mwhere)->find();
				  if(empty($mtmp)){
					 $mwhere['dateline']=time();
					 $mwhere['from_merchant']=3;
				     $merchant_user_relationDb->add($mwhere);
				  }
			   }
			}
			if(D('User')->where($condition_user)->data($data_user)->save()){
				unset($_SESSION['weixin']);
				session('user',$now_user);
				setcookie('login_name',$now_user['phone'],$_SERVER['REQUEST_TIME']+10000000,'/');
				if(!empty($user_import)){
				   $user_importDb->where(array('id'=>$user_import['id']))->save(array('isuse'=>1));
				}
				$this->success('登录成功！');
			}else{
				$this->error('绑定失败！请重试。');
			}
		}
	}
	public function weixin_bind_reg(){
		if(IS_POST){
			if(empty($_SESSION['weixin']['user'])){
				$this->error('微信授权失效，请重新登录！');
			}
		
			$condition_user['phone'] = $data_user['phone'] = trim($_POST['phone']);
			
			$database_user = D('User');
			if($database_user->field('`uid`')->where($condition_user)->find()){
				$this->error('手机号已存在');
			}
			
			if(empty($data_user['phone'])){
				$this->error('请输入手机号');
			}else if(empty($_POST['password'])){
				$this->error('请输入密码');
			}
			
			if(!preg_match('/^[0-9]{11}$/',$data_user['phone'])){
				$this->error('请输入有效的手机号');
			}

			$data_user['pwd'] = md5($_POST['password']);
			$data_user['add_time'] = $data_user['last_time'] = $_SERVER['REQUEST_TIME'];
			$data_user['add_ip'] = $data_user['last_ip'] = get_client_ip(1);
			//uc整合
			$uc = import("@.ORG.UcService");//导入UcService.class.php类
			$ucService = new UcService;//实例化UcService类
			$uid = $ucService->register($data_user['phone'], $_POST['password'],$data_user['phone'],$data_user['add_time'],'','',$data_user['add_ip'],$data_user['add_time'],$data_user['add_time']);//注册到UCenter
			if($uid <= 0) {
				if ($uid == -1) {
					$this->error('用户名不合法');
				} elseif ($uid == -2) {
					$this->error('包含不允许注册的词语');
				} elseif ($uid == -3) {
					$this->error('用户名已经存在,您可以直接登录');
				} elseif ($uid == -4) {
					$this->error('Email 格式有误');
				} elseif ($uid == -5) {
					$this->error('Email 不允许注册');
				} elseif ($uid == -6) {
					$this->error('该 Email 已经被注册');
				} else {
					$this->error('未知错误');
				}
			}else{
				$data_user['nickname'] = $_SESSION['weixin']['user']['nickname'];
				$data_user['openid'] = $_SESSION['weixin']['user']['openid'];
				if($_SESSION['weixin']['user']['union_id']){
					$data_user['union_id'] 	= $_SESSION['weixin']['user']['union_id'];
				}
				$data_user['avatar'] 	= $_SESSION['weixin']['user']['avatar'];
				$data_user['sex']		= $_SESSION['weixin']['user']['sex'];
				$data_user['province'] 	= $_SESSION['weixin']['user']['province'];
				$data_user['city'] 		= $_SESSION['weixin']['user']['city'];
				/****判断此用户是否在user_import表中***/
				$user_importDb=D('User_import');
				$user_import=$user_importDb->where(array('telphone'=>$condition_user['phone'],'isuse'=>'0'))->find();
				if(!empty($user_import)){
					$data_user['truename']=$user_import['ppname'];
					$data_user['qq']=$user_import['qq'];
					$data_user['email']=$user_import['email'];
					$data_user['level']=$user_import['level'];
					$data_user['score_count']=$user_import['integral'];
					$data_user['now_money']=$user_import['money'];
					$data_user['importid']=$user_import['id'];
					$mer_id=$user_import['mer_id'];
					if($mer_id>0){
						$merchant_user_relationDb=M('Merchant_user_relation');
						$mwhere=array('openid'=>$data_user['openid'],'mer_id'=>$mer_id);
						$mtmp=$merchant_user_relationDb->where($mwhere)->find();
						if(empty($mtmp)){
							$mwhere['dateline']=time();
							$mwhere['from_merchant']=3;
							$merchant_user_relationDb->add($mwhere);
						}
					}
				}
				if($uid = $database_user->data($data_user)->add()){
					$session['uid'] = $uid;
					$session['phone'] = $data_user['phone'];
					session('user',$session);

					setcookie('login_name',$session['phone'],$_SERVER['REQUEST_TIME']+1000000,'/');
					if(!empty($user_import)){
						$user_importDb->where(array('id'=>$user_import['id']))->save(array('isuse'=>1));
					}
					$this->success('注册成功');
				}else{
					$this->error('注册失败！请重试。');
				}
			}
		}
	}
	public function weixin_nobind(){
		if(empty($_SESSION['weixin']['user'])){
			$this->error('微信授权失效，请重新登录！');
		}
		$reg_result = D('User')->autoreg($_SESSION['weixin']['user']);
		if($reg_result['error_code']){
			$this->error_tips($reg_result['msg']);
		}else{
			$login_result = D('User')->autologin('openid',$_SESSION['weixin']['user']['openid']);
			if($login_result['error_code']){
				$this->error_tips($login_result['msg'],U('Login/index'));
			}else{
				$now_user = $login_result['user'];
				session('user',$now_user);
				$referer = !empty($_SESSION['weixin']['referer']) ? $_SESSION['weixin']['referer'] : U('Home/index');
				
				unset($_SESSION['weixin']);
				$url=str_replace('&amp;','&',$referer);
				//$this->success_tips('登录成功！',$referer);
				$this->redirect($url);
				exit;
			}
		}
	}
	protected function autologin($field,$value,$referer){
		$result = D('User')->autologin($field,$value);
		if(empty($result['error_code'])){
			$now_user = $result['user'];
			session('user',$now_user);
			//$this->success_tips('登录成功！',$referer);
			$url=str_replace('&amp;','&',$referer);
			$this->redirect($url);
			exit;
		}else if($result['error_code'] && $result['error_code'] != 1001){
			$this->error_tips($result['msg'],U('Login/index'));
		}
	}

    public function frame_login() {
        $pigcms_assign['referer'] = !empty($_GET['referer']) ? strip_tags($_GET['referer']) : (!empty($_SERVER['HTTP_REFERER']) ? strip_tags($_SERVER['HTTP_REFERER']) : U('Index/Index/index'));
        $pigcms_assign['url_referer'] = urlencode($pigcms_assign['referer']);
        $this->assign($pigcms_assign);

        $this->display();
    }
    
    public function login()
    {
    	$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    	$pwd = isset($_POST['pwd']) ? $_POST['pwd'] : '';

		import("@.ORG.UcService");//导入UcService.class.php类
		$ucService = new UcService;
//        验证同步登录的账号密码的正确性
		$uidarray = $ucService->uc_login($phone, $pwd);
		$ucarray = $ucService->uc_synlogin($uidarray);
		if(is_array($uidarray)) {
//				if(!empty($uidarray['phone'])){
			$uid =  M('User')->where('phone='.$uidarray['phone'])->getField("uid");
//                判断用户是否在此注册过
			if($uid){
//                    登录
				$result = D('User')->checkin($_POST['phone'],$_POST['password']);
			}else{
//                   添加登录
				$data_user['phone'] = $phone;
				$data_user['pwd'] = md5($pwd);
				$data_user['nickname'] = substr($phone,0,3).'****'.substr($phone,7);
				$data_user['add_time'] = $data_user['last_time'] = $_SERVER['REQUEST_TIME'];
				$data_user['add_ip'] = $data_user['last_ip'] = get_client_ip(1);
				if(D('User')->data($data_user)->add()){
					$result = D('User')->checkin($_POST['phone'],$_POST['password']);
				}
			}
//				}else{
//					$this->error('用户未绑定手机号');
//				}
		} elseif($uidarray == -1) {
//                解决老用户的问题
			$od_uid =  M('User')->where('phone='.$phone)->find();
			if(!empty($od_uid)){
				if($od_uid['pwd'] != md5($pwd)){
					$this->error('密码错误');
				}
				$data_user['phone'] = $phone;
				$data_user['nickname'] = substr($phone,0,3).'****'.substr($phone,7);
				$data_user['add_time'] = $data_user['last_time'] = $_SERVER['REQUEST_TIME'];
				$data_user['add_ip'] = $data_user['last_ip'] = get_client_ip(1);
				$uc = import("@.ORG.UcService");//导入UcService.class.php类
				$ucService = new UcService;//实例化UcService类
				$uid = $ucService->register($phone, $pwd,$phone,$data_user['add_time'],'','',$data_user['add_ip'],$data_user['add_time'],$data_user['add_time']);//注册到UCenter
				if($uid>0){
					$result = D('User')->checkin($phone, $pwd);
				}else{
					$this->error('账号有误');
				}
			}else{
				$this->error('用户不存在,或者被删除');
			}
		} elseif($uidarray == -2) {
			$this->error('密码错误');
		} elseif($uidarray == -3) {
			$this->error('安全提问错误');
		} else {
			$this->error('未知错误');
		}

//    	$result = D('User')->checkin($phone, $pwd);
    	if (empty($result['error_code'])) {
    		session('user', $result['user']);
    	}
    	exit(json_encode($result));
    }
    
	public function see_login_qrcode(){
		$qrcode_return = D('Recognition')->get_login_qrcode();
		if($qrcode_return['error_code']){
			echo '<html><head></head><body>'.$qrcode_return['msg'].'<br/><br/><font color="red">请关闭此窗口再打开重试。</font></body></html>';
		}else{
			$this->assign($qrcode_return);
			$this->display();
		}
	}

    public function ajax_weixin_login() {
        for ($i = 0; $i < 6; $i++) {
            $database_login_qrcode = D('Login_qrcode');
            $condition_login_qrcode['id'] = $_GET['qrcode_id'];
            $now_qrcode = $database_login_qrcode->field('`uid`')->where($condition_login_qrcode)->find();
            if (!empty($now_qrcode['uid'])) {
                if ($now_qrcode['uid'] == -1) {
                    $data_login_qrcode['uid'] = 0;
                    $database_login_qrcode->where($condition_login_qrcode)->data($data_login_qrcode)->save();
                    exit('reg_user');
                }
                $database_login_qrcode->where($condition_login_qrcode)->delete();
                $result = D('User')->autologin('uid', $now_qrcode['uid']);
                if (empty($result['error_code'])) {
                    session('user', $result['user']);
                    exit('true');
                } else if ($result['error_code'] == 1001) {
                    exit('no_user');
                } else if ($result['error_code']) {
                    exit('false');
                }
            }
            if ($i == 5) {
                exit('false');
            }
            sleep(3);
        }
    }
}
	
?>