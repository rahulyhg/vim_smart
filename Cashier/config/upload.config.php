<?php
	/* 上传文件大小设置,单位为KB*/
	define('maxUploadSize',2048); 
	
	/* 上传文件方式设置
	 * Local 代表本地上传
	 * 如果需要设置为云上传需要设置相对应的信息
	 */
	define('uploadType','Local');
	
	/* 上传文件地址,需要设置权限为0777 */
	define('uploadPath','./Uplode');
	
	/* 上传文件允许后缀 */
	define('uploadExt','jpeg,jpg,png,mp3,gif,pem');
	
	//云上传配置
	return array(
		'UpYun' => array(
			'up_bucket' => '',
			'up_form_api_secret' => '',
			'up_username' => '',
			'up_password' => '',
			'up_domainname' => ''
		)
	);
?>