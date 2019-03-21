<?php
/*
 * 渠道二维码
 *
 */
class RecognitionAction extends BaseAction{
    public function see_qrcode($type,$id){
		//判断ID是否正确，如果正确且以前生成过二维码则得到ID
		if($type == 'group'){
			$pigcms_return = D('Group')->get_qrcode($id);
		}elseif($type == 'merchant'){
			$pigcms_return = D('Merchant')->get_qrcode($id);
		}elseif($type == 'meal'){
			$pigcms_return = D('Merchant_store')->get_qrcode($id);
		}elseif($type == 'lottery'){
			$pigcms_return = D('Lottery')->get_qrcode($id);
		}elseif($type == 'appoint'){
			$pigcms_return = D('Appoint')->get_qrcode($id);
		}elseif($type == 'wifi'){
			$pigcms_return = D('Recognition')->get_wifi_qrcode($id);
		}elseif($type == 'waimai'){
			$pigcms_return = D('Waimai_store')->get_qrcode($id);
		}elseif($type == 'chanel'){
			$pigcms_return = D('Chanel_msg_list')->get_qrcode($id);
                }elseif($type == 'house'){
                         $pigcms_return = D('House_village')->get_qrcode($id);
                }else{
			exit('您查看的内容非法！无法查看二维码！');
		}

		if(empty($pigcms_return) && $type == 'waimai'){
			exit('请您完善店铺设置信息！');
		}
		elseif(empty($pigcms_return)){
			exit('您查看的内容不存在！无法查看二维码！');
		}

		/*if(empty($pigcms_return['qrcode_id'])){
			$qrcode_return = D('Recognition')->get_new_qrcode($type,$id);
		}else{
			$qrcode_return = D('Recognition')->get_qrcode($pigcms_return['qrcode_id']);
		}*/
		if(!empty($pigcms_return['mer_id'])) {
            $qrcode_return = D('Recognition')->get_new_qrcode($type,$id);
        }else{
            $qrcode_return = D('Recognition')->get_qrcode($pigcms_return['qrcode_id']);
        }
		if($qrcode_return['error_code']){
			exit($qrcode_return['msg']);
		}else if($qrcode_return['qrcode'] == 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='){
			$qrcode_return = D('Recognition')->get_new_qrcode($type,$id);
		}

		if($_GET['img']){
			echo '<html><head><style>*{margin:0;padding:0;}</style></head><body><img src="'.$qrcode_return['qrcode'].'"/></body></html>';
		}else{
			redirect($qrcode_return['qrcode']);
		}
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
	public function see_tmp_qrcode(){
		$qrcode_return = D('Recognition')->get_tmp_qrcode($_GET['qrcode_id']);
		if($qrcode_return['error_code']){
			echo '<html><head></head><body>'.$qrcode_return['msg'].'<br/><br/><font color="red">请关闭此窗口再打开重试。</font></body></html>';
		}else{
			$this->assign($qrcode_return);
			$this->display();
		}
	}
	
	public function get_tmp_qrcode(){
		$qrcode_return = D('Recognition')->get_tmp_qrcode($_GET['qrcode_id']);
		if($qrcode_return['error_code']){
			exit($qrcode_return['msg']);
		}else{
			redirect($qrcode_return['ticket']);
		}
	}
	
	public function get_own_qrcode(){
		$qrCon = $_GET['qrCon'];
		import('@.ORG.phpqrcode');
		$size = $_GET['size'] ? $_GET['size']: 10;
		QRcode::png(htmlspecialchars_decode(urldecode($qrCon)),false,0,$size,1);
	}
	
	/* 商家转账二维码生成(带logo且转短地址)
	* mer_id 商户ID
	* @time 2016-04-14
	* @author	小邓  <969101097@qq.com>*/
	public function get_merchant_qrcode(){
		import('@.ORG.phpqrcode');	//引入二维码类
		$mer_id=I('get.mer_id');	//商户ID
		$qrCon=urlencode(C('config.site_url').'/wap.php?g=Wap&c=Pay&a=give_money&mer_id='.$mer_id); //url数据
		//echo $qrCon.'------------<br/>';
		$ch = curl_init();
		$url = 'http://apis.baidu.com/3023/shorturl/shorten?url_long='.$qrCon;
		$header = array(
			'apikey: 603adaa4a3e928c50af7d2e8f18633f7',
		);		
		curl_setopt($ch, CURLOPT_HTTPHEADER ,$header);	// 添加apikey到header
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// 执行HTTP请求
		curl_setopt($ch , CURLOPT_URL , $url);
		$res = curl_exec($ch);
		$test_arr=json_decode($res);
		$short_arr=array();	
		if(is_object($test_arr)){
			$short_arr=(array)$test_arr;
		}else{
			$short_arr=$test_arr;
		}
		//print_r($short_arr['urls'][0]);
		$result_arr=array();
		if(is_object($short_arr['urls'][0])){
			$result_arr=(array)$short_arr['urls'][0];
		}
		//echo $result_arr['url_long'].'-------------';
		//echo $result_arr['url_short'];
		QRcode::png($result_arr['url_short'],'qrcode/qrcode'.I('get.mer_id').'.png','H',11,2);
		$img_info=str_replace(',','/',I('get.img_info'));
		$logo=C('config.site_url').'/upload/merchant/'.$img_info;	//获取logo图片
		$QR = 'qrcode/qrcode'.I('get.mer_id').'.png';	//已经生成的原始二维码图
		if($logo!==FALSE&&$QR!==FALSE){   
			$QR=imagecreatefromstring(file_get_contents($QR));   
			$logo=imagecreatefromstring(file_get_contents($logo));   
			$QR_width = imagesx($QR);//二维码图片宽度   
			$QR_height = imagesy($QR);//二维码图片高度   
			$logo_width = imagesx($logo);//logo图片宽度   
			$logo_height = imagesy($logo);//logo图片高度   
			$logo_qr_width = $QR_width/4;   
			$scale = $logo_width/$logo_qr_width;   
			$logo_qr_height = $logo_height/$scale;   
			$from_width =($QR_width - $logo_qr_width)/2;   //重新组合图片并调整大小   
			imagecopyresampled($QR,$logo,$from_width,$from_width,0,0,$logo_qr_width,$logo_qr_height,$logo_width,$logo_height); 
		}  //输出图片  
		Header("Content-type: image/png"); 
		ImagePng($QR);
    }
	
	/* 访客二维码生成(转短地址)
	* @time 2016-06-28
	* @author	小邓  <969101097@qq.com>*/
	public function access_qrcode(){
		import('@.ORG.phpqrcode');	//引入二维码类
		$village_id=I('get.village_id');//社区ID
		//$qrCon=urlencode(C('config.site_url').'/wap.php?g=Wap&c=House&a=access_control_ask&village_id='.$village_id.'&ac_id='.$ac_id); //url数据
		$qrCon=urlencode(C('config.site_url').'/wap.php?g=Wap&c=House&a=access_control_change&village_id='.$village_id); //url数据
		$ch = curl_init();
		$url = 'http://apis.baidu.com/3023/shorturl/shorten?url_long='.$qrCon;
		$header = array(
			'apikey: 603adaa4a3e928c50af7d2e8f18633f7',
		);		
		curl_setopt($ch, CURLOPT_HTTPHEADER ,$header);	// 添加apikey到header
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// 执行HTTP请求
		curl_setopt($ch , CURLOPT_URL , $url);
		$res = curl_exec($ch);
		$test_arr=json_decode($res);
		$short_arr=array();	
		if(is_object($test_arr)){
			$short_arr=(array)$test_arr;
		}else{
			$short_arr=$test_arr;
		}
		$result_arr=array();
		if(is_object($short_arr['urls'][0])){
			$result_arr=(array)$short_arr['urls'][0];
		}
		QRcode::png($result_arr['url_short'],false,'H',11,2); 
		Header("Content-type: image/png");  
		ImagePng($QR);	//输出图片
    }
	
	/* 设备二维码生成(转短地址)
	* @time 2016-06-29
	* @author	小邓  <969101097@qq.com>*/
	public function control_qrcode(){
		import('@.ORG.phpqrcode');	//引入二维码类
		$village_id=I('get.village_id');//社区ID
		$ac_id=I('get.ac_id');	//设备ID
		//$qrCon=urlencode(C('config.site_url').'/wap.php?g=Wap&c=House&a=access_control_open&village_id='.$village_id.'&ac_id='.$ac_id); //url数据
		$qrCon=urlencode(C('config.site_url').'/wap.php?g=Wap&c=House&a=access_control_open&village_id='.$village_id.'&ac_id='.$ac_id.'&control=key'); //url数据
		$ch = curl_init();
		$url = 'http://apis.baidu.com/3023/shorturl/shorten?url_long='.$qrCon;
		$header = array(
			'apikey: 603adaa4a3e928c50af7d2e8f18633f7',
		);		
		curl_setopt($ch, CURLOPT_HTTPHEADER ,$header);	// 添加apikey到header
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// 执行HTTP请求
		curl_setopt($ch , CURLOPT_URL , $url);
		$res = curl_exec($ch);
		$test_arr=json_decode($res);
		$short_arr=array();	
		if(is_object($test_arr)){
			$short_arr=(array)$test_arr;
		}else{
			$short_arr=$test_arr;
		}
		$result_arr=array();
		if(is_object($short_arr['urls'][0])){
			$result_arr=(array)$short_arr['urls'][0];
		}
		//控制二维码生成尺寸
		QRcode::png($result_arr['url_short'],false,'H',10,2);
		Header("Content-type: image/png");  
		ImagePng($QR);	//输出图片
    }
	
}