<?php
class CashierAction extends BaseAction {
	protected $merchant=array();
    public function _initialize() {
        parent::_initialize();
        //$this->canUseFunction("Cashier");
		//print_r($this->merchant_session);exit;
		$find_mid=M('cashier_merchants')->where(array('thirduserid'=>$this->merchant_session['mer_id']))->getField('mid');	
		if(!$find_mid){	//判断此商户已认证(收银系统)
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
				'wxtoken' =>$this->randStr(30, true),
				'aeskey' => $this->randStr(43, true)
			);
			$merchants_add=M('cashier_merchants')->data($merchants_arr)->add();
			if($merchants_add){
				$this->merchant=M('cashier_merchants')->where(array('mid'=>$merchants_add))->find();
			}
		}else{
			$this->merchant=M('cashier_merchants')->where(array('mid'=>$find_mid))->find();
		}
    }
	/* 首页
	* @time 2016-05-10
	* @author	小邓  <969101097@qq.com>*/
    public function index(){
		//include $this->showTpl();
		$this->display();
	}
	
	/* 商家设置
	* @time 2016-05-10
	* @author	小邓  <969101097@qq.com>*/
	public function merchant(){
		if(IS_POST){
			$data = $this->clear_html($_POST);
			$account=M('cashier_employee')->where(array('account' =>$data['account']))->getField('account');	
			if($account){	//验证此账号是否已存在
				echo json_encode(array('status' => 0, 'msg' => '登录账号已存在'));
			}else {
				echo json_encode(array('status' => 1, 'msg' => '验证成功'));
			}
		}else{
			//$authority = $this->authorityList('Merchants/User');
			$employees=M('cashier_employee')->where(array('mid'=>$this->merchant['mid']))->select();
			$this->assign('employees',$employees);
			$this->display();
		}
	}
	
	/* 新增或修改员工
	* @time 2016-05-12
	* @author	小邓  <969101097@qq.com>*/
	public function merchantOperat(){
		if(IS_POST){	
			$data=$this->clear_html($_POST);
			if($data['eid']){	//判断是修改还是新增
				$employee=M('cashier_employee')->where(array('eid' =>$data['eid']))->field('eid,account,salt')->find();
				if($data['account']!=$employee['account']){
					if(M('cashier_employee')->where(array('account' =>$data['account']))->getField('account')){
						$this->error('登录账号已存在！',$_SERVER['HTTP_REFERER']);
					}
				}
				if($data['password']=='') {
					unset($data['password']);
				}else if($data['password']!=$data['confirm']) {
					$this->error('两次输入密码不一致！',$_SERVER['HTTP_REFERER']);
				}else {
					$data['password']=md5(md5($data['password'].'_'.$employee['salt']).$employee['salt']);
				}
				unset($data['confirm']);
				$data['authority']=!empty($data['authority']) ? implode(',',$data['authority']) : '';
				$employee_alter=M('cashier_employee')->where(array('eid'=>$data['eid']))->data($data)->save();
				if($employee_alter){
					$this->success('修改员工账号成功！',$_SERVER['HTTP_REFERER']);
				}else{
					$this->error('修改员工账号失败！',$_SERVER['HTTP_REFERER']);
				}
			}else{
				if($data['password']!=$data['confirm']){
					$this->error('两次输入密码不一致！', $_SERVER['HTTP_REFERER']);
				}
				$data['mid'] = $this->merchant['mid'];
				$data['salt'] = mt_rand(111111, 999999);
				$data['password'] = md5(md5($data['password'] . '_' . $data['salt']) . $data['salt']);
				$data['authority'] = !empty($data['authority']) ? implode(',', $data['authority']) : '';
				unset($data['confirm']);
				$employee_add=M('cashier_employee')->data($data)->add();
				if ($employee_add){
					$this->success('添加员工账号成功！', $_SERVER['HTTP_REFERER']);
				}else {
					$this->error('添加员工账号失败！', $_SERVER['HTTP_REFERER']);
				}
			}
		}else{		//修改页面
			$data=$this->clear_html($_GET);
			//$authority = $this->authorityList('Merchants/User');
			$employee=M('cashier_employee')->where(array('eid' =>$data['eid']))->find();
			$employee['authority']=explode(',', $employee['authority']);
			$this->assign('employee',$employee);
			$this->display('merchantEdit');
		}				
	}
	
	/* 删除员工(含批量删除)
	* @time 2016-05-12
	* @author	小邓  <969101097@qq.com>*/
	public function employersDel(){
		if (IS_POST){
			$data=$this->clear_html($_POST);
			if(!empty($data['id'])){	//判断是否是批量删除
				$eids=array('in',trim(implode(',',$data['id'])));
				//print_r($eids);exit;
				$employees_del=M('cashier_employee')->where(array('eid' =>$eids))->delete();
				if($employees_del){
					$this->success('删除成功', $_SERVER['HTTP_REFERER']);
				}else{
					$this->error('删除失败', $_SERVER['HTTP_REFERER']);
				}
			}else{
				$employee_del=M('cashier_employee')->where(array('eid' =>$data['eid']))->delete();
				if($employee_del){
					$return['status']=1;
					$return['msg']='删除成功';
				}else{
					$return['status']=0;
					$return['msg']='删除失败';
				}
				exit(json_encode($return));
			}
		}
	}
	
	/* 修改员工状态 
	* @time 2016-05-12
	* @author	小邓  <969101097@qq.com>*/
	public function employersField(){
		if (IS_POST) {
			$data=$this->clear_html($_POST);
			$status_alter=M('cashier_employee')->where(array('eid' =>$data['eid']))->setField('status',$data['status']);
			if($status_alter){
				$return['status']=1;
				$return['msg']='删除成功';
			}else{
				$return['status']=0;
				$return['msg']='删除失败';
			}
			echo json_encode($return);
		}
	}
	
	/* 在线支付设置
	* @time 2016-05-10
	* @author	小邓  <969101097@qq.com>*/
	public function pay(){
		$payConfig=M('cashier_payconfig')->where(array('mid' =>$this->merchant['mid']))->find();		
		//print_r($this->merchant['mid']);exit;
		if(IS_POST){
			$data = $this->clear_html($_POST['data']);
			if($payConfig){
				$dataType = array_keys($data);
				$dataType = $dataType[0];
				if (isset($payConfig['configData'][$dataType])) {
					$configData = array_merge($payConfig['configData'][$dataType], $data[$dataType]);
				}else{
					$configData = $data[$dataType];
				}
				$payConfig['configData'][$dataType] = $configData;
				$payConfig['configData']=serialize($payConfig['configData']);
				//$vo=$this->_save($this->payConfigDb, $payConfig);
				$vo=M('cashier_payconfig')->where(array('mid'=>$this->merchant['mid']))->data($payConfig)->save();
			}else{
				$payConfig=array('mid'=>$this->merchant['mid'],'isOpen'=>1,'configData'=>serialize($data));
				//$vo=$this->_add($this->payConfigDb, $payConfig);
				$vo=M('cashier_payconfig')->data($payConfig)->add();
			}
			if($vo){
				$return['status'] = 1;
				$return['msg'] = '支付配置修改成功';
			}else{
				$return['status'] = 0;
				$return['msg'] = '支付配置修改失败';
			}
			echo json_encode($return);
		}else{		
			if($payConfig) {
				if($payConfig['configData']){
					$payConfig['configData']=unserialize(htmlspecialchars_decode($payConfig['configData']));
				}else{
					$payConfig['configData']=array();
				}
			}
			$this->assign('payConfig',$payConfig);
			$this->display();
		}		
	}
	
	/* 信息推送
	* @time 2016-05-12
	* @author	小邓  <969101097@qq.com>*/
	public function sendCms(){
		if(IS_GET && isset($_GET['echostr'])){
            $echoStr = $_GET["echostr"];
			$signature = $_GET["signature"];
			$timestamp=isset($_REQUEST['timestamp']) ? $_REQUEST['timestamp'] : time();
			$nonce=isset($_REQUEST['nonce']) ? $_REQUEST['nonce'] : '';
			$tmpArr=array($this->merchant['wxtoken'],$timestamp,$nonce);
			sort($tmpArr, SORT_STRING);
			$tmpStr = implode($tmpArr);
			$tmpStr = sha1($tmpStr);
			if(trim($tmpStr)==trim($signature)){
				echo $echoStr;
				exit();
			}
        }else{
            //$this->responseMsg();
        }
	}
	
	/* 商家收银台
	* @time 2016-05-10
	* @author	小邓  <969101097@qq.com>*/
	public function cash(){
		if(IS_POST){
			//$orderid = $this->clear_html($_POST['auth_code']);
			//bpBase::loadAppClass('wxSaoMaPay', 'User', 0);
			//$wxSaoMaPay = new wxSaoMaPay();
			//$ret = $wxSaoMaPay->wxRefund($orderid, $this->wx_user, $this->mid, 'micropay');
			//$this->dexit($ret);
			$return['status'] = 0;
			$return['msg'] = '失败';
			echo json_encode($return);
		}else{
			//bpBase::loadOrg('wxCardPack');
			//$wxCardPack = new wxCardPack($this->wx_user, $this->mid);
			//$access_token = $wxCardPack->getToken();
			//$signdata = $wxCardPack->getSgin($access_token);
			$type=isset($_GET['type']) ? intval($_GET['type']) : 1;
			$type=$type == 2 ? $type : 1;
			$this->assign('type',$type);
			$this->display();
		}
	}
	
	/* 商户认证生成字符规则(收银系统)
	* @time 2016-05-11
	* @author	小邓  <969101097@qq.com>*/
	function randStr($randLength,$hasnum=false) {
        $randLength = intval($randLength);
        $chars = 'ABCDEFGHJKLMNPQRTUVWXYZabcdefghjkmnpqrstuvwxyz';
		if($hasnum) $chars=$chars.'0123456789A';
        $len = strlen($chars);
        $randStr = '';
        for ($i = 0; $i < $randLength; $i++) {
            $randStr.=$chars[rand(0, $len - 1)];
        }
        return $randStr;
    }
	
	/* 微信API接口数据(收银系统)
	* @time 2016-05-11
	* @author	小邓  <969101097@qq.com>*/
	public function getApiData(){
		$datas=array('wxtoken' => $this->merchant['wxtoken'],'aeskey'=>$this->merchant['aeskey'],'encodetype'=>$this->merchant['encodetype'],'mid'=>$this->merchant['mid']);
		if(empty($datas['wxtoken']) || empty($datas['aeskey'])) {
			$datas['wxtoken'] =$this->randStr(30, true);
			$datas['aeskey'] = $this->randStr(43, true);
			//M('cashier_merchants')->update(array('wxtoken' => $datas['wxtoken'], 'aeskey' => $datas['aeskey']), array('mid' => $this->mid));
			M('cashier_merchants')->where(array('mid'=>$this->merchant['mid']))->data(array('wxtoken'=>$datas['wxtoken'],'aeskey'=>$datas['aeskey']))->save();
		}
		//$this->dexit($datas);
		if(is_array($datas)){
            echo json_encode($datas);
        }else{
            echo $datas;
        }
	}
	
	/* 解析html特殊字符(收银系统)
	* @time 2016-05-11
	* @author	小邓  <969101097@qq.com>*/
	public function clear_html($array) {
        if (!is_array($array))
            return trim(htmlspecialchars($array, ENT_QUOTES));
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $this->clear_html($value);
            } else {
                $array[$key] = trim(htmlspecialchars($value, ENT_QUOTES));
            }
        }
        return $array;
    }
	
	/* 微信证书及认证文件上传(收银系统)
	* @time 2016-05-11
	* @author	小邓  <969101097@qq.com>*/
	public function pem_upload(){
		if(IS_POST) {
			if(!empty($_FILES)){
				$return = $this->oldUploadFile('pem', $this->mid);
				if(0<$return['error']) {
					//$this->dexit(array('error' => 1,'msg'=>$return['data']));
					echo json_encode(array('error' => 1,'msg'=>$return['data']));
				}
				else {
					$filesinfo=$return['data'][0];
					//$this->dexit(array('error' => 0, 'msg' => 'OK', 'fileUrl' => $return['imgurl'] . $filesinfo['savename'], 'originalfilename' => $filesinfo['name'], 'fileSize' => $filesinfo['size']));
					echo json_encode(array('error'=>0,'msg'=>'OK','fileUrl'=>$return['imgurl'].$filesinfo['savename'],'originalfilename'=>$filesinfo['name'],'fileSize'=> $filesinfo['size']));
				}
			}
			//$this->dexit(array('error' => 1, 'msg' => '没有上传文件！'));
			echo json_encode(array('error' => 1, 'msg' => '没有上传文件！'));
		}
	}
	
	/* 二维码收款(收银系统)
	* @time 2016-05-12
	* @author	小邓  <969101097@qq.com>*/
	public function ewmPay(){
		if(IS_POST){			
			$return['status'] = 0;
			$return['msg'] = '失败';
			echo json_encode($return);
		}else{
			
			$this->display();
		}
	}
	
	/* 二维码记录(收银系统)
	* @time 2016-05-12
	* @author	小邓  <969101097@qq.com>*/
	public function ewmRecord(){
		if(IS_POST){			
			$return['status'] = 0;
			$return['msg'] = '失败';
			echo json_encode($return);
		}else{
			
			$this->display();
		}
	}
	
	/* 收款记录(收银系统)
	* @time 2016-05-12
	* @author	小邓  <969101097@qq.com>*/
	public function payRecord(){
		if(IS_POST){			
			$return['status'] = 0;
			$return['msg'] = '失败';
			echo json_encode($return);
		}else{
			
			$this->display();
		}
	}
	
	/* 商家收支(收银系统)
	* @time 2016-05-12
	* @author	小邓  <969101097@qq.com>*/
	public function statistics(){		
		if(IS_POST){			
			$return['status'] = 0;
			$return['msg'] = '失败';
			echo json_encode($return);
		}else{
			
			$this->display();
		}
	}
	
	/* 概况统计(收银系统)
	* @time 2016-05-12
	* @author	小邓  <969101097@qq.com>*/
	public function otherpie(){		
		if(IS_POST){			
			$return['status'] = 0;
			$return['msg'] = '失败';
			echo json_encode($return);
		}else{
			
			$this->display();
		}
	}
	
	/* 粉丝支付排行(收银系统)
	* @time 2016-05-12
	* @author	小邓  <969101097@qq.com>*/
	public function fans(){		
			
		$this->display();
	}
	
	public function oldUploadFile($filemulu ='images', $token = ''){
        $token = !empty($token) ? $token : date('Ymd');
        bpBase::loadOrg('UploadFile');
        $getupload_dir = "/upload/" . $filemulu . "/" . $token . "/" . date('Ymd') . '/';
		if(defined('ABS_UPLOAD_PATH')) $getupload_dir=ABS_UPLOAD_PATH.$getupload_dir;
        $upload_dir = "." . $getupload_dir;
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $upload = new UploadFile();
        $upload->maxSize = 10 * 1024 * 1024;
        $upload->allowExts = array('jpeg', 'jpg', 'png', 'mp3', 'gif', 'pem');
        //$upload->allowTypes = array('image/png', 'image/jpg', 'image/jpeg', 'image/gif','application/octet-stream');
        $upload->savePath = $upload_dir;
        $upload->thumb = false;
        $upload->saveRule = 'uniqid';
        if ($upload->upload()) {
            $uploadList = $upload->getUploadFileInfo();
            return array('error' => 0, 'imgurl' => $getupload_dir, 'data' => $uploadList);
        } else {
            return array('error' => 1, 'imgurl' => $getupload_dir, 'data' => $upload->getErrorMsg());
        }
    }
	
}

?>