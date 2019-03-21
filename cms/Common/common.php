<?php
define('IS_AJAX',isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"])=="xmlhttprequest");
define('IS_WECHAT',strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ?true:false);
// 说明：获取完整URL
function curPageURL()
{
    $pageURL = 'http';

    if ($_SERVER["HTTPS"] == "on")
    {
        $pageURL .= "s";
    }
    $pageURL .= "://";

    if ($_SERVER["SERVER_PORT"] != "80")
    {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    }
    else
    {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}



/*
 * 截取中文字符串
 */
function msubstr($str,$start=0,$length,$suffix=true,$charset="utf-8"){
    if(function_exists("mb_substr")){
        if ($suffix && mb_strlen($str, $charset)>$length)
            return mb_substr($str, $start, $length, $charset)."...";
        else
            return mb_substr($str, $start, $length, $charset);
    }elseif(function_exists('iconv_substr')) {
        if ($suffix && strlen($str)>$length)
            return iconv_substr($str,$start,$length,$charset)."...";
        else
            return iconv_substr($str,$start,$length,$charset);
    }
    $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
    $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
    $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
    $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
    preg_match_all($re[$charset], $str, $match);
    $slice = join("",array_slice($match[0], $start, $length));
    if($suffix) return $slice."…";
    return $slice;
}

function arr_htmlspecialchars(&$value){
	$value = htmlspecialchars($value);
}

function fulltext_filter($value){
	return htmlspecialchars_decode($value);
}

    /**
     * 加密和解密函数
     *
     * <code>
     * // 加密用户ID和用户名
     * $auth = authcode("{$uid}\t{$username}", 'ENCODE');
     * // 解密用户ID和用户名
     * list($uid, $username) = explode("\t", authcode($auth, 'DECODE'));
     * </code>
     *
     * @access public
     * @param  string  $string    需要加密或解密的字符串
     * @param  string  $operation 默认是DECODE即解密 ENCODE是加密
     * @param  string  $key       加密或解密的密钥 参数为空的情况下取全局配置encryption_key
     * @param  integer $expiry    加密的有效期(秒)0是永久有效 注意这个参数不需要传时间戳
     * @return string
     */
    function Encryptioncode($string, $operation = 'DECODE', $key = '', $expiry = 0)
    {
        $ckey_length = 4;
        $key = md5($key != '' ? $key : 'lhs_simple_encryption_code_45120');
        $keya = md5(substr($key, 0, 16));
        $keyb = md5(substr($key, 16, 16));
        $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length) : substr(md5(microtime()), -$ckey_length)) : '';

        $cryptkey = $keya . md5($keya . $keyc);
        $key_length = strlen($cryptkey);

        $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0) . substr(md5($string . $keyb), 0, 16) . $string;
        $string_length = strlen($string);

        $result = '';
        $box = range(0, 255);

        $rndkey = array();
        for ($i = 0; $i <= 255; $i++) {
            $rndkey[$i] = ord($cryptkey[$i % $key_length]);
        }

        for ($j = $i = 0; $i < 256; $i++) {
            $j = ($j + $box[$i] + $rndkey[$i]) % 256;
            $tmp = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
        }

        for ($a = $j = $i = 0; $i < $string_length; $i++) {
            $a = ($a + 1) % 256;
            $j = ($j + $box[$a]) % 256;
            $tmp = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;
            $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
        }

        if ($operation == 'DECODE') {
            if ((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26) . $keyb), 0, 16)) {
                return substr($result, 26);
            } else {
                return '';
            }
        } else {
            return $keyc . str_replace('=', '', base64_encode($result));
        }
    }

 /*****
 **生成简单的随机数
 **$length 需要的长度
 **$onlynum 生成纯数字的
 **$nouppLetter  不需要大写的，数字和小写的混合
 **/
function createRandomStr($length=6,$onlynum=false,$nouppLetter=false){
	if(!($length>0)) return false;
	$returnstr='';
	if($onlynum){
	   for($i=0;$i<$length;$i++){
	     $returnstr .= rand(0,9);
	   }
	}else if($nouppLetter){
	   $strarr = array_merge(range(0,9),range('a','z'));
	   shuffle($strarr);
	   shuffle($strarr);
	   $returnstr = implode('',array_slice($strarr,0,$length));
	}else{
	  $strarr = array_merge(range(0,9),range('a','z'),range('A','Z'));
	  shuffle($strarr);
	  shuffle($strarr);
	  $returnstr = implode('',array_slice($strarr,0,$length));
	}
    return $returnstr;
}

/**
 * *封装一个通用的
 * cURL封装**
 * *$postfields 参数
 * */
function httpRequest($url, $method = 'GET', $postfields = null, $headers = array(), $debug = false) {
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

/**
* @desc 根据两点间的经纬度计算距离
* @param float $lat 纬度值
* @param float $lng 经度值
*/
function getDistance($lat1, $lng1, $lat2, $lng2){
	$earthRadius = 6367000;
	$lat1 = ($lat1 * pi() ) / 180;
	$lng1 = ($lng1 * pi() ) / 180;

	$lat2 = ($lat2 * pi() ) / 180;
	$lng2 = ($lng2 * pi() ) / 180;

	$calcLongitude = $lng2 - $lng1;
	$calcLatitude = $lat2 - $lat1;
	$stepOne = pow(sin($calcLatitude / 2), 2) + cos($lat1) * cos($lat2) * pow(sin($calcLongitude / 2), 2);
	$stepTwo = 2 * asin(min(1, sqrt($stepOne)));
	$calculatedDistance = $earthRadius * $stepTwo;
	return round($calculatedDistance);
}

function getRange($range,$space = true){
	if($range < 1000){
		return $range.($spage ? ' ' : '').'m';
	}else{
		return floatval(round($range/1000,2)).($spage ? ' ' : '').'km';
	}
}

//得到带URL的链接
//支持最多5个参数
function UU(){
	switch(func_num_args()){
		case 0:
			return C('config.config_site_url');
		case 1:
			return C('config.config_site_url').U(func_get_arg(0));
		case 2:
			return C('config.config_site_url').U(func_get_arg(0),func_get_arg(1));
		case 3:
			return C('config.config_site_url').U(func_get_arg(0),func_get_arg(1),func_get_arg(2));
		case 4:
			return C('config.config_site_url').U(func_get_arg(0),func_get_arg(1),func_get_arg(2),func_get_arg(3));
		case 5:
			return C('config.config_site_url').U(func_get_arg(0),func_get_arg(1),func_get_arg(2),func_get_arg(3),func_get_arg(4));
	}


}


/**
 * 获取时间描述
 * @param $time
 * @return false|string
 */
function word_time($time) {
    $time = (int) substr($time, 0, 10);
    $int = time() - $time;
    $str = '';
    if ($int <= 2){
        $str = sprintf('刚刚', $int);
    }elseif ($int < 60){
        $str = sprintf('%d秒前', $int);
    }elseif ($int < 3600){
        $str = sprintf('%d分钟前', floor($int / 60));
    }elseif ($int < 86400){
        $str = sprintf('%d小时前', floor($int / 3600));
    }elseif ($int < 1728000){
        $str = sprintf('%d天前', floor($int / 86400));
    }else{
        $str = date('Y-m-d', $time);
    }
    return $str;
}


/**
 * 数组转xls格式的excel文件
 * @param  array  $data      需要生成excel文件的数组
 * @param  string $filename  生成的excel文件名
 *      示例数据：
$data = array(
array(NULL, 2010, 2011, 2012),
array('Q1',   12,   15,   21),
array('Q2',   56,   73,   86),
array('Q3',   52,   61,   69),
array('Q4',   30,   32,    0),
);
 */
function create_xls($data,$filename='user_detail.xls'){
    ini_set('max_execution_time', '0');
    import('@.ORG.phpexcel.PHPExcel');
    $filename=str_replace('.xls', '', $filename).'.xls';
    $phpexcel = new PHPExcel();
    $phpexcel->getProperties()
        ->setCreator("Maarten Balliauw")
        ->setLastModifiedBy("Maarten Balliauw")
        ->setTitle("Office 2007 XLSX Test Document")
        ->setSubject("Office 2007 XLSX Test Document")
        ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
        ->setKeywords("office 2007 openxml php")
        ->setCategory("Test result file");
    $phpexcel->getActiveSheet()->fromArray($data);
    $phpexcel->getActiveSheet()->setTitle('Sheet1');
    $phpexcel->setActiveSheetIndex(0);
    header('Content-Type: application/vnd.ms-excel');
    header("Content-Disposition: attachment;filename=$filename");
    header('Cache-Control: max-age=0');
    header('Cache-Control: max-age=1');
    header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
    header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header ('Pragma: public'); // HTTP/1.0
    $objwriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel5');
    $objwriter->save('php://output');
    exit;
}


/**
 * 把返回的数据集转换成Tree
 * @param array $list 要转换的数据集
 * @param string $pid parent标记字段
 * @param string $level level标记字段
 * @return array
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function list_to_tree($list, $pk='id', $pid = 'pid', $child = '_child', $root = 0) {
    // 创建Tree
    $tree = array();
    if(is_array($list)) {
        // 创建基于主键的数组引用
        $refer = array();
        foreach ($list as $key => $data) {
            $refer[$data[$pk]] =& $list[$key];
        }
        foreach ($list as $key => $data) {
            // 判断是否存在parent
            $parentId =  $data[$pid];
            if ($root == $parentId) {
                $tree[] =& $list[$key];
            }else{
                if (isset($refer[$parentId])) {
                    $parent =& $refer[$parentId];
                    $parent[$child][] =& $list[$key];
                }
            }
        }
    }
    return $tree;
}

/**
 * 将list_to_tree的树还原成列表
 * @param  array $tree  原来的树
 * @param  string $child 孩子节点的键
 * @param  string $order 排序显示的键，一般是主键 升序排列
 * @param  array  $list  过渡用的中间数组，
 * @return array        返回排过序的列表数组
 * @author yangweijie <yangweijiester@gmail.com>
 */
function tree_to_list($tree, $child = '_child', $order='id', &$list = array()){
    if(is_array($tree)) {
        foreach ($tree as $key => $value) {
            $reffer = $value;
            if(isset($reffer[$child])){
                unset($reffer[$child]);
                tree_to_list($value[$child], $child, $order, $list);
            }
            $list[] = $reffer;
        }
        $list = list_sort_by($list, $order, $sortby='asc');
    }
    return $list;
}

/**
* 对查询结果集进行排序
* @access public
* @param array $list 查询结果
* @param string $field 排序的字段名
* @param array $sortby 排序类型
* asc正向排序 desc逆向排序 nat自然排序
* @return array
*/
function list_sort_by($list,$field, $sortby='asc') {
    if(is_array($list)){
        $refer = $resultSet = array();
        foreach ($list as $i => $data)
            $refer[$i] = &$data[$field];
        switch ($sortby) {
            case 'asc': // 正向排序
                asort($refer);
                break;
            case 'desc':// 逆向排序
                arsort($refer);
                break;
            case 'nat': // 自然排序
                natcasesort($refer);
                break;
        }
        foreach ( $refer as $key=> $val)
            $resultSet[] = &$list[$key];
        return $resultSet;
    }
    return false;
}
/**
 * 獲取用戶信息
 * @param int $user_id
 * @return array
 * @update-time: 2017-08-09 14:32:57
 * @author: 王亚雄
 */
//微信端获取
function user_info($user_id=0){
    static $users = array();//避免多次查詢
    $uid = $user_id?:session('user.uid');
    $field = array(
        'a.id'=>'admin_id',
        'a.role_id',
        'u.uid',
        'u.openid',
        'u.phone',
        'u.avatar',
        'u.nickname',
        'v.village_id',
        'c.company_id',
        'c.company_name',
        'ub.address',
        'v.village_name'
    );
    if(!$user_info = $users[$user_id]){
        $user_info = M('user','pigcms_')->alias('u')
            ->field($field)
            ->join('left join __HOUSE_VILLAGE_USER_BIND__ ub on ub.uid=u.uid')
            ->join('left join __COMPANY__ c on ub.company_id=c.company_id')
            ->join('left join __HOUSE_VILLAGE__ v on c.village_id=v.village_id')
            ->join('left join __ADMIN__ a on u.openid=a.openid and a.openid!=""' )
            ->where('u.uid=%d',$uid)
            ->find();
        if($user_info){
            $users[$user_id] = $user_info;
        }
    }
    return $user_info;
}

/**
 * 获取配置信息
 * @update-time: 2017-08-14 16:02:56
 * @author: 王亚雄
 */

function config($name){
    return M('config','pigcms_')->where('name="%s"',$name)->getField('value');
}


/**
 * 获取物业抄表配置信息
 * @param int $village_id 社区ID
 * @param string $usernum 业主编号 若传入则创建业主二维码链接
 * @return array|mixed
 */
function re_setmeter_config($village_id=0){
    //默认配置项
    $default = M('re_setmeter_config')->where(array('village_id'=>array('in','0,'.$village_id)))->select();
    $default = list_to_tree($default, $pk='id', $pid = 'pid', $child = '_child', $root = 0);

    //社区配置项
    $re_setmeter = array();
    if($village_id){
        $re_setmeter = M('house_village','pigcms_')->where('village_id=%d',$village_id)->getField('re_setmeter');
        $re_setmeter = unserialize($re_setmeter)?:array();
    }

    $re_setmeter = array_replace_recursive($default,$re_setmeter);
    unset($row);
    //dump($default);
    //return $re_setmeter;
    //返回re_setmeter_config表中的配置项  by zhukeqin
    return $default;
}

/**
 * 查询当前小区的收费类型的单价价格
 * @param $typeName  收费类型
 * @param $village_id  小区id
 * @return int 单价
 */
function _filterPriceType($typeName,$village_id){
    //小区单价信息

    $villagePriceInfo = M('house_village')->getFieldByVillage_id($village_id,'re_setmeter');

    $villagePriceInfo = unserialize($villagePriceInfo);

    //根据类型的名称来寻找当前价格

    $return_price = '';

    foreach ($villagePriceInfo as $v){
        foreach ($v['_child'] as $k=>$vv){
            if($vv['sign'] == $typeName){
                $return_price = $vv['unit_price'];
            }
        }
    }

    return intval($return_price);


}

/**
 * 生成二维码链接 *并且不会生成本文件
 * 注：之前不要有输出
 * @param $url 扫描后跳转地址
 * @param string $logo 二维码中间的logo图片地址 默认为汇得行的logo
 * @update-time: 2017-08-23 14:56:44
 * @author: 王亚雄
 */
 function qr($url,$logo="http://www.hdhsmart.com/upload/config/000/000/001/574bfc73b7848.png"){
    import('@.ORG.phpqrcode');
    $size = $_GET['size'] ? $_GET['size']: 10;
    ob_start();
    QRcode::png(htmlspecialchars_decode(urldecode($url)),false,0,$size,1);
    $QR = ob_get_contents();//截取缓冲区中的二维码图
    ob_end_clean();
    if ($logo !== FALSE&&$logo!==1) {
        $QR = imagecreatefromstring($QR);
        $logo = imagecreatefromstring(file_get_contents($logo));
        $QR_width = imagesx($QR);//二维码图片宽度
        $QR_height = imagesy($QR);//二维码图片高度
        $logo_width = imagesx($logo);//logo图片宽度
        $logo_height = imagesy($logo);//logo图片高度
        $logo_qr_width = $QR_width / 5;
        $scale = $logo_width/$logo_qr_width;
        $logo_qr_height = $logo_height/$scale;
        $from_width = ($QR_width - $logo_qr_width) / 2;
        //重新组合图片并调整大小
        imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
    }
    //输出图片
    Header("Content-type: image/png");
    ImagePng($QR);
}
/**
 * 二维码生成本地文件
 * 注：之前不要有输出
 * @param $url 扫描后跳转地址
 * @param string $logo 二维码中间的logo图片地址 默认为汇得行的logo
 * @param string $path 本地二维码保存地址  如果为空则不生成
 * @author: 朱柯钦
 */
function qr_save($url,$logo="http://www.hdhsmart.com/upload/config/000/000/001/574bfc73b7848.png",$path=""){
    import('@.ORG.phpqrcode');
    $size = $_GET['size'] ? $_GET['size']: 10;
    ob_start();
    QRcode::png(htmlspecialchars_decode(urldecode($url)),false,0,$size,1);
    $QR = ob_get_contents();//截取缓冲区中的二维码图
    ob_end_clean();
    if ($logo !== FALSE) {
        $QR = imagecreatefromstring($QR);
        $logo = imagecreatefromstring(file_get_contents($logo));
        $QR_width = imagesx($QR);//二维码图片宽度
        $QR_height = imagesy($QR);//二维码图片高度
        $logo_width = imagesx($logo);//logo图片宽度
        $logo_height = imagesy($logo);//logo图片高度
        $logo_qr_width = $QR_width / 5;
        $scale = $logo_width/$logo_qr_width;
        $logo_qr_height = $logo_height/$scale;
        $from_width = ($QR_width - $logo_qr_width) / 2;
        //重新组合图片并调整大小
        imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
    }
    $file_name=time().rand(1000,9999);
    $file_name='save';
    //保存图片
    //file_put_contents($path.'/'.$file_name.'.png',$QR);
    file_put_contents($path.'/'.$file_name.'.png', base64_decode($QR));
    //return $path.'/'.$file_name.'.png';
    return 1;
}
function base64_image_content($base64_image_content,$path){
    //匹配出图片的格式
    if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)){
        $type = $result[2];
        $new_file = $path;
        if(!file_exists($new_file)){
            //检查是否有该文件夹，如果没有就创建，并给予最高权限
            mkdir($new_file, 0700);
        }
        $new_file = $new_file.time().rand(1000,9999).".{$type}";
        if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64_image_content)))){
            return '/'.$new_file;
        }else{
            return false;
        }
    }else{
        return false;
    }
}



/**
 * 搜索条件过滤
 * @param $request 必须为二维数组
 * @return array|int|mixed
 * @update-time: 2017-05-22 15:34:48
 * @author: 王亚雄
 */
function search_filter( array $request ){


    foreach($request as $k => &$v){
        //过滤掉特殊字符
        $v = preg_replace('/[\',:;*?~`!@#$%^&+=)(<>{}]|\]|\[|\/|\\\|\"|\|/',"",$v);
        //参数两端空格
        $v = trim($v);
    }

    //删除掉全等于空字符串的参数
    $request = array_filter($request,function($v,$k){
        return $v!=="";
    },ARRAY_FILTER_USE_BOTH);
    return $request;

}



/**
 * 添加值到逗号链接的字符串
 * @param $val 需要添加的值
 * @param $string 逗号链接的字符串
 */
function add_set($val,$string,$delimiter=",",$sort=true){
    $arr1 = explode($delimiter,$string);
    $arr2 = explode($delimiter,$val);
    $arr = array_merge($arr1,$arr2);
    if($sort){
        sort($arr);
    }
    $arr = array_unique($arr);
    $arr = array_filter($arr);
    $newstr = join(',',$arr);
    return $newstr;
}

/**
 * 删除值从逗号链接的字符串中
 * @param $val
 * @param $string
 */
function del_set($val,$string,$delimiter=",",$sort=true){
    $arr1 = explode($delimiter,$string);
    $arr2 = explode($delimiter,$val);
    $arr = array_diff($arr1,$arr2);
    $arr = array_filter($arr);
    if($sort){
        sort($arr);
    }
    $arr = array_unique($arr);
    $arr = array_filter($arr);
    $newstr = join(',',$arr);
    return $newstr;
}

/**
 * 过滤掉逗号链接的字符串中重复的值
 * @param $val
 * @param $string
 */
function set_unique($string){
    $arr = explode(',',$string);
    $arr = array_unique($arr);
    $string = join(',',$arr);
    return $string;
}

/**
 * 二位数组根据指定的值分组
 * @param $arr
 * @param $key
 * @return array
 */
function array_group_by($arr, $key)
{
    $grouped = [];
    foreach ($arr as $value) {
        $grouped[$value[$key]][] = $value;
    }
    // Recursively build a nested grouping if more parameters are supplied
    // Each grouped array value is grouped according to the next sequential key
    if (func_num_args() > 2) {
        $args = func_get_args();
        foreach ($grouped as $key => $value) {
            $parms = array_merge([$value], array_slice($args, 2, func_num_args()));
            $grouped[$key] = call_user_func_array('array_group_by', $parms);
        }
    }
    return $grouped;
}

/**
 * 多项目列表显示过滤
 * @author 祝君伟
 * @time 2017年11月22日10:01:37
 * @param $map                             过滤前条件
 * @param int $type                        返回值类型
 * @param string $_prefix                  表别名
 * @return array|mixed|null|string|void    返回值
 */
function filter_village($map,$type=1,$_prefix='v')
{
    $sesVillageId = session('system.village_id');
    $getVillageId= I('get.village_id');
    if(!$sesVillageId&&!$getVillageId) return $map;

    if($sesVillageId!=''){

        if ($sesVillageId != $getVillageId){

            $villageId = $sesVillageId;

        }else{

            $villageId = $getVillageId;

        }

    }else{

        $villageId = $getVillageId;

    }

    if($type == 1){

        $map[($_prefix?$_prefix.'.':'').'village_id'] = $villageId;

    }else if($type ==2){

        $map = $villageId;

    }else{

        $map .= ' and '.($_prefix?$_prefix.'.':'').'village_id='.$villageId;

    }



    return $map;


}
/****************************************************** 工具方法  *****************************************************/

/**
 * 快捷实例化logic类
 * @param $modelName
 * @return bool|Model|\Think\Model
 */
function Logic($modelName){

    if(!$modelName) return false;

    $Object = D(ucfirst($modelName),'Logic');

    if(is_object($Object)) return $Object;else return false;
}

/**
 * POST 请求
 * @param string $url
 * @param array $param
 * @param boolean $post_file 是否文件上传
 * @return string content
 */
function http_post($url,$param,$cookie=array(),$post_file=false){
    $oCurl = curl_init();
    if(stripos($url,"https://")!==FALSE){
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
    }
    if (PHP_VERSION_ID >= 50500 && class_exists('\CURLFile')) {
        $is_curlFile = true;
    } else {
        $is_curlFile = false;
        if (defined('CURLOPT_SAFE_UPLOAD')) {
            curl_setopt($oCurl, CURLOPT_SAFE_UPLOAD, false);
        }
    }
    if (is_string($param)) {
        $strPOST = $param;
    }elseif($post_file) {
        if($is_curlFile) {
            foreach ($param as $key => $val) {
                if (substr($val, 0, 1) == '@') {
                    $param[$key] = new \CURLFile(realpath(substr($val,1)));
                }
            }
        }
        $strPOST = $param;
    } else {
        $aPOST = array();
        foreach($param as $key=>$val){
            $aPOST[] = $key."=".urlencode($val);
        }
        $strPOST =  join("&", $aPOST);
    }
    curl_setopt($oCurl, CURLOPT_URL, $url);
    curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt($oCurl, CURLOPT_POST,true);
    curl_setopt($oCurl, CURLOPT_POSTFIELDS,$strPOST);

    //设置cookie
    if($cookie){
        //fruit=apple; colour=red
        $cookiestr = "";
        if(is_array($cookie)){
            foreach($cookie as $key=>$val){
                $cookiestr .= $key . '=' . $val . '; ';
            }
        }else{
            $cookiestr = $cookie;
        }
        $cookiestr = trim($cookiestr);
        dump($cookiestr);
        //curl_setopt($oCurl, CURLOPT_COOKIE,$cookiestr);
    }

    $sContent = curl_exec($oCurl);
    $aStatus = curl_getinfo($oCurl);
    curl_close($oCurl);
    if(intval($aStatus["http_code"])==200){
        return $sContent;
    }else{
        //dump($aStatus);
        return false;
    }
}


function timediff($begin_time,$end_time)
{
    if($begin_time < $end_time){
        $starttime = $begin_time;
        $endtime = $end_time;
    }else{
        $starttime = $end_time;
        $endtime = $begin_time;
    }

    //计算天数
    $timediff = $endtime-$starttime;
    $days = intval($timediff/86400);
    //计算小时数
    $remain = $timediff%86400;
    $hours = intval($remain/3600);
    //计算分钟数
    $remain = $remain%3600;
    $mins = intval($remain/60);
    //计算秒数
    $secs = $remain%60;
    $time = array("day" => $days,"hour" => $hours,"min" => $mins,"sec" => $secs);
    //分钟、秒个位数时,前面加0
    if($time['sec']<10){
        $time['sec'] = '0'.$time['sec'];
    }else if($time['min']<10){
        $time['min'] = '0'.$time['min'];
    }
    if($time['day']==0 && $time['hour']!=0 && $time['min']!=0){
        $c_time=$time['hour'].'小时'.$time['min'].'分钟'.$time['sec'].'秒';
    }
    if($time['day']==0 && $time['hour']==0 && $time['min']!=0){
        $c_time=$time['min'].'分钟'.$time['sec'].'秒';
    }
    if($time['day']==0 && $time['hour']==0 && $time['min']==0){
        $c_time=$time['sec'].'秒';
    }
    if($time['day']!=0){
        $c_time=$time['day'].'天'.$time['hour'].'小时'.$time['min'].'分钟'.$time['sec'].'秒';
    }
    return $c_time;
}

/**
 * 浮点数转换百分数并保留两位小数
 * @param $float
 * @return float|string
 */
function float_to_percent($float)
{
   $number =  round($float, 4);

   $number =  sprintf("%01.2f", $number*100).'%';

   return $number;
}


function _verify($data)
{
    if(I($data))
    {
        return I($data);
    }else{

        exit(999);
    }
}

/**
 * 导入excel文件
 * @param  string $file excel文件路径
 * @return array        excel文件内容数组
 */
/**
 * @param $file $_FILES['n'];
 * @param string $endcol //获取最大列
 * @param string $endrow //获取最大行
 * @return array
 */
function import_excel($file,$endcol="",$endrow=""){
    // 判断文件是什么格式
    $type = substr($file['name'],stripos($file['name'],'.')+1);
    $type = strtolower($type);
    switch ($type){
        case  'xlsx':
            $objReader = new PHPExcel_Reader_Excel2007();
            break;
        default :
            $class_type = $type=== "csv" ?  $type : 'Excel5';
            $objReader = PHPExcel_IOFactory::createReader($class_type);
    }


   // ini_set('max_execution_time', '0');
    // 判断使用哪种格式
    $objPHPExcel = $objReader->load($file['tmp_name']);

    $sheet = $objPHPExcel->getSheet(0);
    $highestRow = $sheet->getHighestRow();
    $highestColumn = $sheet->getHighestColumn();

    $data=array();
    $endcol = $endcol?:$highestColumn;
    $endrow = $endrow?:$highestRow;

    for ($row = 1; $row <= $endrow; $row++){
        //  Read a row of data into an array
        $rowData = $sheet->rangeToArray('A' . $row . ':' . $endcol . $row,
            NULL,
            TRUE,
            FALSE);
        $data[] = $rowData[0];

    }


    return $data;
}

/**
 * 导入excel文件  多页读取
 * @author zhukeqin
 * @param  string $file excel文件路径
 * @return array        excel文件内容数组
 */
/**
 * @param $file $_FILES['n'];
 * @param string $endcol //获取最大列
 * @param string $endrow //获取最大行
 * @param string $endrow //获取最大页
 * @param string $handrow //表头有几行 默认为1行
 * @return array
 */
function import_excel_sheet($file,$endcol="",$endrow="",$endsheet="",$handrow="1"){
    // 判断文件是什么格式
    $type = substr($file['name'],stripos($file['name'],'.')+1);
    $type = strtolower($type);
    switch ($type){
        case  'xlsx':
            $objReader = new PHPExcel_Reader_Excel2007();
            break;
        default :
            $class_type = $type=== "csv" ?  $type : 'Excel5';
            $objReader = PHPExcel_IOFactory::createReader($class_type);
    }


    // ini_set('max_execution_time', '0');
    // 判断使用哪种格式  标记
    $objPHPExcel = $objReader->load($file['tmp_name']);
//    dump($objPHPExcel);die;
    $highestSheet = $objPHPExcel->getSheetCount();
    $endsheet = $endsheet?:$highestSheet;
//    dump($endsheet);die;
    $data=array();
    for($sheet=0;$sheet<$endsheet;$sheet++){
        $sheetinfo = $objPHPExcel->getSheet($sheet);
        $highestRow = $sheetinfo->getHighestRow();
        $highestColumn = $sheetinfo->getHighestColumn();
        $endcol = $endcol?:$highestColumn;
        $endrow = $endrow?:$highestRow;

        for ($row = 1; $row <= $endrow; $row++){
            //  Read a row of data into an array
            if($sheet>0&&$row<=$handrow)continue;
            $rowData = $sheetinfo->rangeToArray('A' . $row . ':' . $endcol . $row,
                NULL,
                TRUE,
                FALSE);
            $data[] = $rowData[0];

        }
    }
    return $data;
}

/**
 * @author zhukeqin
 * @param $file
 * @param string $endcol
 * @param string $endrow
 * @param string $sheet_number
 * @param string $handrow
 * @return array
 * 获取表格某一页的数据
 */
function import_excel_sheet_one($file,$endcol="",$endrow="",$sheet_number=""){
    // 判断文件是什么格式
    $type = substr($file['name'],stripos($file['name'],'.')+1);
    $type = strtolower($type);
    switch ($type){
        case  'xlsx':
            $objReader = new PHPExcel_Reader_Excel2007();
            break;
        default :
            $class_type = $type=== "csv" ?  $type : 'Excel5';
            $objReader = PHPExcel_IOFactory::createReader($class_type);
    }


    // ini_set('max_execution_time', '0');
    // 判断使用哪种格式
    $objPHPExcel = $objReader->load($file['tmp_name']);
    $data=array();
        $sheetinfo = $objPHPExcel->getSheet($sheet_number);
        $highestRow = $sheetinfo->getHighestRow();
        $highestColumn = $sheetinfo->getHighestColumn();
        $endcol = $endcol?:$highestColumn;
        $endrow = $endrow?:$highestRow;

        for ($row = 1; $row <= $endrow; $row++){
            //  Read a row of data into an array
            $rowData = $sheetinfo->rangeToArray('A' . $row . ':' . $endcol . $row,
                NULL,
                TRUE,
                FALSE);
            $data[] = $rowData[0];

        }


    return $data;
}
/**
 * 用于任务调度时查看打印类容
 * 将content 存储到 pigcms_dupm_log 表中
 */
function md($content,$line=__LINE__){
    $content = json_encode($content);
    $data = array(
        'content'=>$content,
        'action'=>__ACTION__,
        'create_time'=>date("Y-m-d H:i:s"),
        'line'=>$line
    );
    return M('dump_log')->add($data);
}
/**
 * 获取模板信息
 * @author zhukeqin
 * @return string
 */
function get_wxmsg_tpl($id,$col="tempid"){
    $tpl =  M('tempmsg','pigcms_')->where('id=%d',$id)->getField($col);
    return $tpl;
}
?>