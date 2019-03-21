<?php
bpBase::loadAppClass('base', '', 0);
class login_controller extends base_controller {
	public $merchants;
	public $employees;
	protected  $merchant_session;	//声明一个商户session变量
	public function __construct(){
		parent::__construct();
		$this->merchants = M('cashier_merchants');
		$this->employee = M('cashier_employee');
		session_start();
		if(!empty($_SESSION['merchant_session'])){
			$this->merchant_session=unserialize($_SESSION['merchant_session']);
		}else if(!empty($_SESSION['merchant'])){
			$this->merchant_session=$_SESSION['merchant'];
		}		
		if(trim($_GET['type'])=='merchant' && $this->merchant_session['mer_id']){	//商户登录时
			$find_mid=$this->merchants->get_one(array('thirduserid'=>$this->merchant_session['mer_id']),'mid');
			if(!$find_mid['mid']){	//判断此商户已认证(收银系统)
				$merchants_arr=array(
					'username'=>$this->merchant_session['account'],		//账号
					'thirduserid'=>$this->merchant_session['mer_id'],	//第三唯一标识ID(此处为商户ID)
					'password'=>$this->merchant_session['pwd'],
					'salt'=>mt_rand(111111,999999),
					'wxname'=>$this->merchant_session['name'],
					'email'=>$this->merchant_session['email'],
					'regTime'=>$this->merchant_session['reg_time'],
					'regIp'=>$this->merchant_session['reg_ip'],
					'lastLoginTime'=>$this->merchant_session['last_time'],
					'lastLoginIp'=>$this->merchant_session['last_ip'],
					'wxtoken' =>randStr(30, true),
					'aeskey' => randStr(43, true)
				);
				$merchants_add=$this->merchants->insert($merchants_arr,1);	//进商户表
				if($merchants_add){
					$user=$this->merchants->get_one(array('mid'=>$merchants_add));
				}
			}else{
				$user=$this->merchants->get_one(array('mid'=>$find_mid['mid']));
			}
			$session_storage=getSessionStorageType();
			bpBase::loadSysClass($session_storage);
			$_SESSION['merchant']['mid']=$user['mid'];
			//dump($_SESSION); exit;
			if($_SESSION['merchant']['mid']){
				$this->successTip('登录成功！','./merchants.php?m=User&c=index&a=index');
				exit;
			}			
		}else if(trim($_GET['type'])=='employee'){	//员工登录时
			if(!empty($_SESSION['staff_session'])){
				$staff_session=unserialize($_SESSION['staff_session']);
			}
			$authority='Merchants/User/Cashier/Index,Merchants/User/Cashier/PayRecord,Merchants/User/Cashier/EwmRecord,Merchants/User/Cashier/Odetail,Merchants/User/Cashier/DelOrderByid,Merchants/User/Cashier/WxRefund,Merchants/User/Cashier/payment,Merchants/User/Cashier/wxSmRefund,Merchants/User/Merchant/Employers,Merchants/User/Merchant/EmployersAdd,Merchants/User/Merchant/EmployersAppemd,Merchants/User/Merchant/Field,Merchants/User/Merchant/EmployersDel|EmployersDelAll,Merchants/User/Merchant/employersEdit,Merchants/User/statistics/index,Merchants/User/statistics/fans,Merchants/User/statistics/otherpie,Merchants/User/wxCoupon/index,Merchants/User/wxCoupon/createKq|docreateKq,Merchants/User/wxCoupon/delCardByid,Merchants/User/wxCoupon/ModifyStock,Merchants/User/wxCoupon/wxReceiveList,Merchants/User/wxCoupon/consumeCard';
			$find_eid=$this->employee->get_one(array('thirduserid'=>$staff_session['id']),'eid');
			if(!$find_eid['eid']){	//判断此员工已认证(收银系统)
				$employee_arr=array(
					'mid'=>$this->merchant_session['mer_id'],	//商户ID(merchant表中的mer_id)
					'account'=>$staff_session['username'],		//账号
					'thirduserid'=>$staff_session['id'],	//第三唯一标识ID(此处为店员ID)
					'password'=>$staff_session['password'],
					'salt'=>mt_rand(111111,999999),
					'authority'=>$authority,	//可访问的菜单权限
					'username'=>$staff_session['name'],
					'tel'=>$staff_session['tel'],
					'store_id'=>$staff_session['store_id']
				);
				$employee_add=$this->employee->insert($employee_arr,1);	//进员工表
				if($employee_add){
					$user=$this->employee->get_one(array('eid'=>$employee_add));
				}
			}else{
				$user=$this->employee->get_one(array('eid'=>$find_eid['eid']));
			}
			$session_storage=getSessionStorageType();
			bpBase::loadSysClass($session_storage);
			$_SESSION['employer']['eid']=$user['eid'];
			//dump($_SESSION); exit;
			if($_SESSION['employer']['eid']){
				$this->successTip('登录成功！','./merchants.php?m=User&c=index&a=index');
				exit;
			}
		}	
		
	}
	
	public function index(){
		//echo 2;exit;
		$ltyp=isset($_GET['ltyp']) ? intval($_GET['ltyp']) :0;
		
    	include $this->showTpl();
    }
	public function register(){
		include $this->showTpl();
	}
//	public function signin(){
//		if(IS_POST){
//			$data = $this->clear_html($_POST);
//			if($data['type'] == 'merchant'){
//				$user = $this->merchants->get_one(array('username'=>$data['username']));
//			}elseif($data['type'] == 'employee'){
//				$user = $this->employee->get_one(array('account'=>$data['username']));
//			}
//
//			if(!$user){
//				$this->errorTip('用户名不存在！', $_SERVER['HTTP_REFERER']);exit;
//			}
//			//if($this->toPassword($data['password'],$user['salt']) != $user['password']){
//			if(md5($data['password']) != $user['password']){
//				$this->errorTip('密码错误！', $_SERVER['HTTP_REFERER']);exit;
//			}
//			if($user['status'] == 0){
//				$this->errorTip('该账户暂时被禁止登录！', $_SERVER['HTTP_REFERER']);exit;
//			}
//			$_SESSION['employer']=null;
//			$_SESSION['merchant']=null;
//			unset($_SESSION['employer'],$_SESSION['merchant']);
//			$session_storage = getSessionStorageType();
//			bpBase::loadSysClass($session_storage);
//			if($data['type'] == 'merchant'){
//				$_SESSION['merchant']['mid'] = $user['mid'];
//			}elseif($data['type'] == 'employee'){
//				$_SESSION['employer']['eid'] = $user['eid'];
//			}
//			$this->successTip('登录成功！', './merchants.php?m=User&c=index&a=index');exit;
//		}
//	}
	public function signin(){
		if(IS_POST){
			$data = $this->clear_html($_POST);
			$session_storage = getSessionStorageType();
			bpBase::loadSysClass($session_storage);
			if($data['type'] == 'merchant'){
				$user = $this->merchants->get_one(array('username'=>$data['username']));
				if(!$user){
					$this->errorTip('用户名不存在！', $_SERVER['HTTP_REFERER']);exit;
				}
				if(md5($data['password']) != $user['password']){
					$this->errorTip('密码错误！', $_SERVER['HTTP_REFERER']);exit;
				}
				if($user['status'] == 0){
					$this->errorTip('该账户暂时被禁止登录！', $_SERVER['HTTP_REFERER']);exit;
				}
				$_SESSION['merchant']['mid'] = $user['mid'];
				$this->successTip('登录成功！', './merchants.php?m=User&c=index&a=index');exit;
			}elseif($data['type'] == 'employee'){
				$user = $this->employee->get_one(array('account'=>$data['username']));
				if(!$user){
					$this->errorTip('用户名不存在！', $_SERVER['HTTP_REFERER']);exit;
				}
				if(md5($data['password']) != $user['password']){
					$this->errorTip('密码错误！', $_SERVER['HTTP_REFERER']);exit;
				}
				if($user['status'] == 0){
					$this->errorTip('该账户暂时被禁止登录！', $_SERVER['HTTP_REFERER']);exit;
				}
				$_SESSION['employer'] = $user;
				$this->successTip('登录成功！', './merchants.php?m=User&c=index&a=index');exit;
			}elseif($data['type']=='company'){
				unset($_SESSION['employer'],$_SESSION['merchant']);
				$user = M('login_user')->get_one(array('account'=>$data['username']),'*');
				if(!$user){
					$this->errorTip('用户名不存在！', $_SERVER['HTTP_REFERER']);exit;
				}
				if(md5($data['password']) != $user['pwd']){
					$this->errorTip('密码错误！', $_SERVER['HTTP_REFERER']);exit;
				}
				$_SESSION['company'] = $user;//建立店员的个人信息session
				$company_info=M('company')->get_one(array('company_id'=>$_SESSION['company']['company_id']),'company_name');
				$_SESSION['company_name']=$company_info['company_name'];
				$this->successTip('登录成功！', './merchants.php?m=User&c=company&a=index');exit;
			}
		}
	}

	public function signed(){
		if(IS_POST){
			$data = $this->clear_html($_POST);
			$merchants = $this->merchants->get_one("username='".$data['username']."' OR email='".$data['email']."'");
			if($merchants){
				if($merchants['username'] == $data['username']){
					$this->errorTip('用户名已存在！', $_SERVER['HTTP_REFERER']);exit;
				}elseif($merchants['email'] == $data['email']){
					$this->errorTip('邮箱已存在！', $_SERVER['HTTP_REFERER']);exit;
				}
			}
			if($data['agree'] != 1){
				$this->errorTip('请先同意使用条款！', $_SERVER['HTTP_REFERER']);exit;
			}
			unset($data['agree']);
			$_SESSION['merchant']=null;
			$data['salt'] = mt_rand(111111,999999);
			//$data['password'] = $this->toPassword($data['password'],$data['salt']);
			$data['password'] = md5($data['password']);
			$data['lastLoginTime'] = $data['regTime'] = SYS_TIME;
			$data['lastLoginIp'] = $data['regIp'] = ip2long(ip());
			if($vo = $this->merchants->insert($data,1)){
				$session_storage = getSessionStorageType();
				bpBase::loadSysClass($session_storage);
	
				$_SESSION['merchant']['mid'] = $vo;
				$this->successTip('注册成功！', '/merchants.php?m=User&c=index&a=index');exit;
			}else{
				$this->errorTip('注册失败！', $_SERVER['HTTP_REFERER']);exit;
			}
		}
	}
}

?>