<?php

bpBase::loadSysFunc('front');
class base_controller {
	public $site_info = array();
	public $SiteUrl;
	public $RlStaticResource;
	public $ResourceUrl='';
	public function __construct(){
		$this->site_info = loadConfig('info');
		if (!empty($this->site_info['SITE_URL'])) {
			$this->SiteUrl = rtrim($this->site_info['SITE_URL'], '/');
		} else {
			$this->SiteUrl = $_SERVER['HTTP_HOST'];
			$this->SiteUrl = strtolower($this->SiteUrl);
			if (strpos($this->SiteUrl, "http:") === false && strpos($this->SiteUrl, "https:") === false)
				$this->SiteUrl = 'http://' . $this->SiteUrl;
			$this->SiteUrl = rtrim($this->SiteUrl, '/');
		}
		if(!defined('SITEURL')) define('SITEURL',$this->SiteUrl);
		isset($this->site_info['ResourceUrl']) && !empty($this->site_info['ResourceUrl']) && $this->ResourceUrl=rtrim($this->site_info['ResourceUrl'],'/');
		$this->RlStaticResource=!empty($this->ResourceUrl) ? $this->ResourceUrl.ltrim(PIGCMS_STATIC_PATH,'.') : RL_PIGCMS_STATIC_PATH;
		if(!defined('RESOURCEURL')) define('RESOURCEURL',$this->ResourceUrl);

	}

    final public static function showTpl($file = '', $m = '', $c = '') {
        $file = empty($file) ? ROUTE_ACTION : $file;
        $m = empty($m) ? ROUTE_MODEL : $m;
        $c = empty($c) ? ROUTE_CONTROL : $c;
        if (empty($m))
            return false;
        if (defined('PIGCMS_TPL_PATH')) {
            $PIGCMS_TPL_PATH = defined('OPIGCMS_TPL_PATH') ? OPIGCMS_TPL_PATH : RL_PIGCMS_TPL_PATH;
            if (!defined('PIGCMS_TPL_STATIC_PATH')) {
				$tmppath=$PIGCMS_TPL_PATH . APP_NAME . '/' . 'Static' . '/';
				if(RESOURCEURL){
					$PIGCMS_TPL_PATH = defined('OPIGCMS_TPL_PATH') ? OPIGCMS_TPL_PATH : PIGCMS_TPL_PATH;
					$tmppath=$PIGCMS_TPL_PATH . APP_NAME . '/' . 'Static' . '/';
				    $tmppath=RESOURCEURL.ltrim($tmppath,'.');
				}
                define('PIGCMS_TPL_STATIC_PATH', $tmppath);
				unset($tmppath);
            }
			$tmpPIGCMS_TPL_PATH=defined('OPIGCMS_TPL_PATH') ? OPIGCMS_TPL_PATH : PIGCMS_TPL_PATH;
            return ABS_PATH . $tmpPIGCMS_TPL_PATH . APP_NAME . '/' . $m . '/' . $c . '/' . $file . '.tpl.php';
        } else {
            if (!defined('PIGCMS_TPL_STATIC_PATH')) {
				$tmppath=RL_PIGCMS_CORE_PATH . 'Lib' . '/' . APP_NAME . '/' . $m . '/' . 'templates' . '/' . 'Static' . '/';
				if(RESOURCEURL){
				    $tmppath=RESOURCEURL.ltrim($tmppath,'.');
				}
                define('PIGCMS_TPL_STATIC_PATH', $tmppath);
				unset($tmppath);
            }
            return ABS_PATH . PIGCMS_CORE_PATH . 'Lib' . '/' . APP_NAME . '/' . $m . '/' . 'templates' . '/' . $file . '.tpl.php';
        }
    }

	final public function dispatchJump($message,$status=1,$jumpUrl=''){
		$PIGCMS_TPL_PATH = defined('OPIGCMS_TPL_PATH') ? OPIGCMS_TPL_PATH : PIGCMS_TPL_PATH;
        //如果设置了关闭窗口，则提示完毕后自动关闭窗口
        if(isset($_GET['closeWin'])) $jumpUrl='javascript:window.close();';
        if($status) { //发送成功信息
            // 成功操作后默认停留1秒
			$s_message=$message;
            if(!isset($_GET['waitSecond']))    $waitSecond=1;
            // 默认操作成功自动返回操作前页面
            if(empty($jumpUrl)) $jumpUrl=$_SERVER["HTTP_REFERER"];
            include ABS_PATH.$PIGCMS_TPL_PATH.'/dispatch_jump.php';
        }else{
            //发生错误时候默认停留3秒
			$e_message=$message;
            if(!isset($_GET['waitSecond']))    $waitSecond=3;
            // 默认发生错误的话自动返回上页
            if(empty($jumpUrl)) $jumpUrl="javascript:history.back(-1);";
             include ABS_PATH.$PIGCMS_TPL_PATH.'/dispatch_jump.php';
            // 中止执行  避免出错后继续执行
            exit ;
        }
	}

	protected function successTip($message,$jumpUrl='') {
        $this->dispatchJump($message,1,$jumpUrl);
    }
    protected function errorTip($message,$jumpUrl='') {
        $this->dispatchJump($message,0,$jumpUrl);
    }
	protected function toPassword($password,$salt){
		$password_code = md5(md5($password.'_'.$salt).$salt);
		return $password_code;
	}
	final public function authority($info){
		$data = strtolower(APP_NAME.'/'.ROUTE_MODEL.'/'.ROUTE_CONTROL.'/'.ROUTE_ACTION);
		$allowAuthority = explode(',',strtolower($info));
		$status = false;
		foreach($allowAuthority as $key=>$val){
			$num = $this->comparison($val,$data);
			if($num > 3 ){
				$status = true;
			}
		}
		if($status == false){
			return false;
		}
		return true;
	}
	final public function comparison($info,$data){
		$info = explode('/',$info);
		$data = explode('/',$data);
		$num = 0;
		foreach($info as $key=>$val){
			if(count(explode('|',$val)) > 1){
				foreach(explode('|',$val) as $ke=>$va){
					if(in_array($va,$data)){
						$num += 1;
					}
				}
			}elseif(in_array($val,$data)){
				$num += 1;
			}
		}
		return $num;
	}
    final public function curlGet($url) {
        $ch = curl_init();
        $header = "Accept-Charset: utf-8";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $temp = curl_exec($ch);
        return $temp;
    }

    final public function clear_html($array) {
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

    final public function decode_html($array, $flage = false) {
        if (is_array($array)) {
            foreach ($array as $key => $value) {
                if (is_array($value)) {
                    $array[$key] = $this->decode_html($value, $flage);
                } else {
                    //if($flage && ($key=='content') && !empty($value)){
                    if ($flage && stripos($value, 's_#|')) {
                        $value = str_replace('is_#|', '', $value);
                        $value = base64_decode($value);
                    }
                    $array[$key] = htmlspecialchars_decode($value, ENT_QUOTES);
                }
            }
            return $array;
        } else {
            return htmlspecialchars_decode($array, ENT_QUOTES);
        }
    }

    final public function _add($model, $data) {
        $data = $this->clear_html($data);
        $r_id = $model->insert($data, 1);
        return $r_id;
    }

    final public function _save($model, $data) {
        $info = $model->getPK();
        $data = $this->clear_html($data);
        $condition = array();
        foreach ($data as $key => $val) {
            if ($key == $info['name']) {
                $condition[$key] = $val;
                unset($data[$key]);
            }
        }
        if (empty($condition)) {
            $return['status'] = 0;
            $return['msg'] = '没有主键字段';
            return $return;
        }
        if ($model->update($data, $condition)) {
            $return['status'] = 1;
            $return['msg'] = '修改成功';
        } else {
            $return['status'] = 0;
            $return['msg'] = '修改失败';
        }
        return $return;
    }
	final public function _delAll($model, $data){
		$pk = $model->getPK();
		if(is_array($data)){
			$condition = to_sqls($data,'',$pk['name']);
		}else{
			$condition = $pk['name'].' in ('.$data.')';
		}
		if ($model->delete($condition)) {
            $return['status'] = 1;
            $return['msg'] = '删除成功';
        } else {
            $return['status'] = 0;
            $return['msg'] = '删除失败';
        }
		return $return;
	}
	final public function _del($model,$data,$extsql=''){
		$pk = $model->getPK();
		$condition = $pk['name']." = ".$data;
		if(!empty($extsql)){
			$condition .=" AND ".$extsql;
		}
		if ($model->delete($condition)){
            $return['status'] = 1;
            $return['msg'] = '删除成功';
        } else {
            $return['status'] = 0;
            $return['msg'] = '删除失败';
        }
		return $return;
	}
    final public function _uplode($ext = '', $size = 0, $saveRule = 'uniqid') {
        $uploadConfig = loadConfig('upload');
        if ($ext == '')
            $ext = uploadExt;
        if ($size == 0)
            $size = maxUploadSize;
        $uploadType = uploadType;


        $config = array(
            'maxSize' => $size, // 上传文件的最大值
            'allowExts' => $ext, // 允许上传的文件后缀 留空不作后缀检查
            'saveRule' => $saveRule, // 允许上传的文件上传地址规则，默认为随机字符
        );
        if ($uploadType == 'Local') {
            $config['savePath'] = uploadPath;
        }
        bpBase::loadOrg('UploadOauth');
        $upload = new UploadOauth($config);
        $return = $upload->$uploadType($uploadConfig[$uploadType]);
        return $return;
    }

    public function oldUploadFile($filemulu ='images', $token = '') {
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

    public function _setField($model, $data) {
        $info = $model->getPK();
        $data = $this->clear_html($data);
        $condition = array();
        foreach ($data as $key => $val) {
            if ($key == $info['name']) {
                $condition[$key] = $val;
            }
        }
        if (empty($condition)) {
            if ($this->_add($model, $data)) {
                $return['status'] = 1;
                $return['msg'] = '修改成功';
            } else {
                $return['status'] = 0;
                $return['msg'] = '修改失败';
            }
        } else {
            $return = $this->_save($model, $data);
        }
        return $return;
    }

    /*     * json 格式封装函数* */

    final public function dexit($data = '') {
        if (is_array($data)) {
            echo json_encode($data);
        } else {
            echo $data;
        }
        exit();
    }

    /*     * *cURl封装*** */

    final public function httpRequest($url, $method, $postfields = null, $headers = array(), $debug = false) {
        /* $Cookiestr = "";  * cUrl COOKIE处理* 
          if (!empty($_COOKIE)) {
          foreach ($_COOKIE as $vk => $vv) {
          $tmp[] = $vk . "=" . $vv;
          }
          $Cookiestr = implode(";", $tmp);
          } */
        $method = strtoupper($method);
        $ci = curl_init();
        /* Curl settings */
        curl_setopt($ci, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
        curl_setopt($ci, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.2; WOW64; rv:34.0) Gecko/20100101 Firefox/34.0");
        curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, 60); /* 在发起连接前等待的时间，如果设置为0，则无限等待 */
        curl_setopt($ci, CURLOPT_TIMEOUT, 7); /* 设置cURL允许执行的最长秒数 */
        curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
        switch ($method) {
            case "POST":
                curl_setopt($ci, CURLOPT_POST, true);
                if (!empty($postfields)) {
                    $tmpdatastr = is_array($postfields) ? http_build_query($postfields) : $postfields;
                    curl_setopt($ci, CURLOPT_POSTFIELDS, $tmpdatastr);
                }
                break;
            default:
                curl_setopt($ci, CURLOPT_CUSTOMREQUEST, $method); /* //设置请求方式 */
                break;
        }
        $ssl = preg_match('/^https:\/\//i', $url) ? TRUE : FALSE;
        curl_setopt($ci, CURLOPT_URL, $url);
        if ($ssl) {
            curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, FALSE); // https请求 不验证证书和hosts
            curl_setopt($ci, CURLOPT_SSL_VERIFYHOST, FALSE); // 不从证书中检查SSL加密算法是否存在
        }
        //curl_setopt($ci, CURLOPT_HEADER, true); /*启用时会将头文件的信息作为数据流输出*/
        curl_setopt($ci, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ci, CURLOPT_MAXREDIRS, 2); /* 指定最多的HTTP重定向的数量，这个选项是和CURLOPT_FOLLOWLOCATION一起使用的 */
        curl_setopt($ci, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ci, CURLINFO_HEADER_OUT, true);
        /* curl_setopt($ci, CURLOPT_COOKIE, $Cookiestr); * *COOKIE带过去** */
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
	
	/*获取微信配置参数*/
	public function getwxuserConf($mid,$type="wx"){
       // $configData = getCache('configData_'.$mid);
		$wx_user=array();
       // if(empty($configData) || !isset($configData)) {
            $payconfig = M('config')->select(array('tab_id' => 'weixin'), 'name,value');
            foreach ($payconfig as $val) {
                $key_value = str_replace('pay_weixin_', '', $val['name']);
                //echo $key_value.'---';
                if ($key_value == 'appsecret') {
                    $key_value = 'appSecret';
                }
                if ($key_value == 'open') {
                    $key_value = 'isOpen';
                }
                if (strstr($key_value, 'client') || $key_value == 'rootca') {
                    $key_value = str_replace('client', 'apiclient', $key_value);
                    $val['value'] = urlencode($val['value']);
                }
                $wx_user[$key_value] = $val['value'];
            }
            $wx_user['proxymid'] = strval('0');
            $wx_user['mid'] = $mid;
            unset($wx_user['isOpen']);
            unset($wx_user['apiclient_cert']);
            unset($wx_user['apiclient_key']);
            unset($wx_user['rootca']);
            $payConfig2 = M('cashier_payconfig')->get_one(array('mid' => $mid), '*');
            if ($payConfig2) {
                if ($payConfig2['configData']) {
                    $payConfig2['configData'] = unserialize(htmlspecialchars_decode($payConfig2['configData']));
                } else {
                    $payConfig2['configData'] = array();
                }
            }
            $wx_user['sub_mch_id'] = $payConfig2['configData']['weixin']['mchid'];
            $wx_user['apiclient_cert'] = $payConfig2['configData']['weixin']['apiclient_cert'];
            $wx_user['apiclient_key'] = $payConfig2['configData']['weixin']['apiclient_key'];
            $wx_user['rootca'] = $payConfig2['configData']['weixin']['rootca'];
            $wx_user['pid']= $payConfig2['configData']['alipay']['pid'];
            $wx_user['token']= $payConfig2['configData']['alipay']['token'];
        //    setCache('configData_'.$mid, $wx_user);
       // }else{
        //    $wx_user=$configData;
       // }
		$is_define=true;
		if(empty($wx_user) || !isset($wx_user['mchid'])){
		  !defined('WxPay_CfgTips') && define('WxPay_CfgTips','商家没有配置微信支付，支付和卡券将不能正常使用！');
		    if($wx_user['isOpen']==0) {
				!defined('WxPay_CfgTips') && define('WxPay_CfgTips','商家关闭了微信支付配置');
            }
		  unset($wx_user['mchid'],$wx_user['key']);
		  $is_define=false; 
		}
		if($is_define){
			$tips='';
			if(!isset($wx_user['rootca']) || empty($wx_user['rootca'])) $tips='CA证书文件没上传配置，微信退款功能可能会不能正常使用';
			if(!isset($wx_user['apiclient_key']) || empty($wx_user['apiclient_key'])) $tips='apiclient_key 公钥文件没上传配置，微信退款功能不能正常使用';
			if(!isset($wx_user['apiclient_cert']) || empty($wx_user['apiclient_cert'])) $tips='apiclient_cert 私钥文件没上传配置，微信退款功能不能正常使用';
			if(!isset($wx_user['key']) || empty($wx_user['key'])) $tips='API 密钥没配置，微信支付不能正常使用';
			if(!isset($wx_user['mchid']) || empty($wx_user['mchid'])) $tips='微支付商户号没配置，微信支付不能正常使用';
			if(!isset($wx_user['appSecret']) || empty($wx_user['appSecret'])) $tips='appSecret 没配置，微信支付不能正常使用';
			if(!isset($wx_user['appid']) || empty($wx_user['appid'])) $tips='appid 没配置，微信支付不能正常使用';
			!defined('WxPay_CfgTips') && define('WxPay_CfgTips', !empty($tips) ? $tips:'');
			!defined('WxPay_APPID') && define('WxPay_APPID', $wx_user['appid']);
			!defined('WxPay_MCHID') && define('WxPay_MCHID', $wx_user['mchid']);
            isset($wx_user['sub_mch_id']) && !defined('WxPay_SUBMCHID') && define('WxPay_SUBMCHID', $wx_user['sub_mch_id']);
			!defined('WxPay_KEY') && define('WxPay_KEY', $wx_user['key']);
			!defined('WxPay_SSLCERT_PATH') && define('WxPay_SSLCERT_PATH', urldecode($wx_user['apiclient_cert']));
			!defined('WxPay_SSLKEY_PATH') && define('WxPay_SSLKEY_PATH', urldecode($wx_user['apiclient_key']));
			!defined('WxPay_SSLCA_PATH') && define('WxPay_SSLCA_PATH', urldecode($wx_user['rootca']));
			!defined('WxPay_CURL_PROXY_HOST') && define('WxPay_CURL_PROXY_HOST', '0.0.0.0');
			!defined('WxPay_CURL_PROXY_PORT') && define('WxPay_CURL_PROXY_PORT', 0);
			!defined('WxPay_REPORT_LEVENL') && define('WxPay_REPORT_LEVENL', 1);
		}
		if($type=='wx'){
			return $wx_user;
		}
    }


    public function getaliuserConf($mid,$type="ali") {
        $ali_user=array();
        $payConfig = M('cashier_payconfig')->get_one(array('mid' => $mid), '*');
        if ($payConfig['configData']){
            $payConfig['configData'] = unserialize(htmlspecialchars_decode($payConfig['configData'],ENT_QUOTES));
        }
        $ali_user =$payConfig['configData']['alipay'];
        if($type=='ali'){
            return $ali_user;
        }
    }

}

?>