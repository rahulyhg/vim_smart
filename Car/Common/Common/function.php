<?php

/**
 * 通过id 获取用户信息，不传则获取自己的
 * @param $user_id
 * @return bool|mixed
 * @author 王亚雄
 */
function user_info($user_id){

    static $last_user_id;
    static $data =array();

    $user_id = $user_id?:session('user_id');
    if(!$user_id) return false;
    if($user_id==$last_user_id) return $data[$user_id];//单例

    $user_info =  M('user')->alias('u')
        ->field('*,a.role_id admin_role')
        ->join('left join __ADMIN__ a on find_in_set(u.user_id,a.ad_uid)')
        ->where('user_id=%d',$user_id)
        ->find();
    $last_user_id = $user_id;
    $data[$user_id] = $user_info;

    return $user_info;


}

/**
 * @param $admin_id
 * @return bool|mixed
 * 通过id 获取用户信息，不传则获取自己的
 * @update-time: 2017-03-22 17:25:47
 * @author: 王亚雄
 */
function admin_info($admin_id){
    static $last_admin_id;
    static $data =array();

    $admin_id = $admin_id?:session('admin_id');
    if(!$admin_id) return false;
    if($admin_id==$last_admin_id) return $data[$admin_id];//单例

    $user_info =  M('user')->alias('u')
        ->field('*')
        ->join('left join __ADMIN__ a on find_in_set(u.user_id,a.ad_uid)')
        ->where('a.ad_id=%d',$admin_id)
        ->select();
    $last_admin_id = $admin_id;
    $data[$admin_id] = $user_info;
    return $user_info;
}


/**
 * 通过角色id获取对应用户群的信息
 * @param $role_id
 * @param string $field
 * @return mixed
 * @author 王亚雄
 */
function getUsersByRole($role_id,$field=""){
    $default_field = array(
        'u.user_id',
        'u.user_wx_opid',
        'u.user_name',
    );
    $field = $field ?: $default_field;
    $map = array();
    $map['is_del'] = array('eq',"0");
    if(is_array($role_id)){
        $map['role_id'] = array('in',$role_id);
    }else{
        $map['role_id'] = array('eq',$role_id);
    }
    return $model = M('admin')->alias('a')
        ->field($field)
        ->join('left join __USER__ u on find_in_set(u.user_id,a.ad_uid)')
        ->where($map)
        ->select();
}



/**
 * 计算两时间戳时间差 最大单位为天
 * @param $timestamp1
 * @param $timestatmp2
 * @return string
 * @author 王亚雄
 */
function howlong($timestamp1,$timestatmp2){
    $mum = abs($timestamp1-$timestatmp2);
    $d = floor($mum/24/60/60);
    $h = floor($mum%(24*60*60)/(60*60));
    $m = floor($mum%(60*60)/60);

    return
     ($d ? $d . '天'  :"")
    .($h ? $h . '小时':"")
    .($m ? $m . '分钟'  :"");
}





/**
 * GET 请求
 * @param string $url
 */
function http_get($url){
    $oCurl = curl_init();
    if(stripos($url,"https://")!==FALSE){
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
    }
    curl_setopt($oCurl, CURLOPT_URL, $url);
    curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );
    $sContent = curl_exec($oCurl);
    $aStatus = curl_getinfo($oCurl);
    curl_close($oCurl);
    if(intval($aStatus["http_code"])==200){
        return $sContent;
    }else{
        return false;
    }
}

/**
 * POST 请求
 * @param string $url
 * @param array $param
 * @param boolean $post_file 是否文件上传
 * @return string content
 */
function http_post($url,$param,$post_file=false){
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
    $sContent = curl_exec($oCurl);
    $aStatus = curl_getinfo($oCurl);
    curl_close($oCurl);
    if(intval($aStatus["http_code"])==200){
        return $sContent;
    }else{
        return false;
    }
}


/**
 * 字符串截取，支持中文和其他编码
 * @static
 * @access public
 * @param string $str 需要转换的字符串
 * @param string $start 开始位置
 * @param string $length 截取长度
 * @param string $charset 编码格式
 * @param string $suffix 截断显示字符
 * @return string
 */
function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true) {
    if(function_exists("mb_substr"))
        $slice = mb_substr($str, $start, $length, $charset);
    elseif(function_exists('iconv_substr')) {
        $slice = iconv_substr($str,$start,$length,$charset);
        if(false === $slice) {
            $slice = '';
        }
    }else{
        $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
        $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
        $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
        $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("",array_slice($match[0], $start, $length));
    }
    return $suffix ? $slice.'...' : $slice;
}

/**
 * 系统加密方法
 * @param string $data 要加密的字符串
 * @param string $key  加密密钥
 * @param int $expire  过期时间 单位 秒
 * @return string
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function think_encrypt($data, $key = '', $expire = 0) {
    $data = serialize($data);
    $key  = md5(empty($key) ? C('DATA_AUTH_KEY') : $key);
    $data = base64_encode($data);
    $x    = 0;
    $len  = strlen($data);
    $l    = strlen($key);
    $char = '';

    for ($i = 0; $i < $len; $i++) {
        if ($x == $l) $x = 0;
        $char .= substr($key, $x, 1);
        $x++;
    }

    $str = sprintf('%010d', $expire ? $expire + time():0);

    for ($i = 0; $i < $len; $i++) {
        $str .= chr(ord(substr($data, $i, 1)) + (ord(substr($char, $i, 1)))%256);
    }
    return str_replace(array('+','/','='),array('-','_',''),base64_encode($str));
}

/**
 * 系统解密方法
 * @param  string $data 要解密的字符串 （必须是think_encrypt方法加密的字符串）
 * @param  string $key  加密密钥
 * @return string
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function think_decrypt($data, $key = ''){
    $key    = md5(empty($key) ? C('DATA_AUTH_KEY') : $key);
    $data   = str_replace(array('-','_'),array('+','/'),$data);
    $mod4   = strlen($data) % 4;
    if ($mod4) {
        $data .= substr('====', $mod4);
    }
    $data   = base64_decode($data);
    $expire = substr($data,0,10);
    $data   = substr($data,10);

    if($expire > 0 && $expire < time()) {
        return '';
    }
    $x      = 0;
    $len    = strlen($data);
    $l      = strlen($key);
    $char   = $str = '';

    for ($i = 0; $i < $len; $i++) {
        if ($x == $l) $x = 0;
        $char .= substr($key, $x, 1);
        $x++;
    }

    for ($i = 0; $i < $len; $i++) {
        if (ord(substr($data, $i, 1))<ord(substr($char, $i, 1))) {
            $str .= chr((ord(substr($data, $i, 1)) + 256) - ord(substr($char, $i, 1)));
        }else{
            $str .= chr(ord(substr($data, $i, 1)) - ord(substr($char, $i, 1)));
        }
    }
    return unserialize(base64_decode($str));
}

/**
 * 设置跳转页面URL
 * 使用函数再次封装，方便以后选择不同的存储方式（目前使用cookie存储）
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function set_redirect_url($url){
    cookie('redirect_url', $url);
}

/**
 * 获取跳转页面URL
 * @return string 跳转页URL
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function get_redirect_url(){
    $url = cookie('redirect_url');
    return empty($url) ? __APP__ : $url;
}

/**
 * 获取记录的浏览历史
 * @param int  -1:获取本站上一次访问的url，0 为当前的url
 * @return array|mixed
 * @author 王亚雄
 */
function get_history_url($i=0){
    $url = cookie('history_url');
    return $url[$i]?:"";
}

/* 获取当前完整url
 * @author 网上找的兼容性比较好
 * */
function get_url() {
    $sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
    $php_self = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
    $path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
    $relate_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $php_self.(isset($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : $path_info);
    return $sys_protocal.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '').$relate_url;
}


/**
 * 一次性值注册
 * @param $key
 * @param int $time  默认有效时间
 * @author 王亚雄
 */
function S1($key,$time=300){

    S($key,1,$time);//注册一次性值，有效期为5分钟

}

/**
 * 判断该值是否被使用过一次
 * @param $key
 * @return bool
 * @author 王亚雄
 */
function G1($key){

    if(S($key)===1){

        S($key,null);//销毁一次性值
        return true;

    }else{
        return false;
    }
}

/**
 * @param $url 二维码所需字符串
 * @param bool $local_save 是否保存到本地，如果需要保存则填写文件路径  example: /path/filename.jpg
 * @param string $level  纠错级别：L、M、Q、H
 * @param int $size  点的大小：1到10,用于手机端4就可以了
 * @author 王亚雄
 */
function QR($url,$local_save=false,$level='L',$size=4){
    import("Org.QrCode.phpqrcode");
    \QRcode::png($url,$local_save,$level,$size);
}


/**
 * 获取配置信息 数据库记录数不多直接全部获取，上线后，考虑使用缓存
 * @param $k    键名
 * @return mixed
 * @update-time: 2017-03-23 14:14:53
 * @author: 王亚雄
 */
function get_cfg($k){
    static $config = array(); //单例模式，避免多次访问数据库
    if(!$config){
        $config = M('config')->field('name,value')->select();
        $tmp = array();
        foreach($config as $key => $row){
            $tmp[$row['name']] = $row['value'];
        }
        $config = $tmp;
    }

    return $config[$k];

}


/**
 * Thinkphp默认分页样式转Bootstrap分页样式
 * @author H.W.H
 * @param string $page_html tp默认输出的分页html代码
 * @return string 新的分页html代码
 */
function bootstrap_page_style($page_html){
    if ($page_html) {
        $page_show = str_replace('<div>','<nav><ul class="pagination">',$page_html);
        $page_show = str_replace('</div>','</ul></nav>',$page_show);
        $page_show = str_replace('<span class="current">','<li class="active"><a>',$page_show);
        $page_show = str_replace('</span>','</a></li>',$page_show);
        $page_show = str_replace(array('<a class="num"','<a class="prev"','<a class="next"','<a class="end"','<a class="first"'),'<li><a',$page_show);
        $page_show = str_replace('</a>','</a></li>',$page_show);
    }
    return $page_show;
}

/**
 * 生成签名
 * @param $timestamp 时间戳
 * @param $nonce 随机数
 * @param $token token
 * @return string
 * @update-time: 2017-03-28 10:20:30
 * @author: 王亚雄
 */
function create_signature($timestamp,$nonce,$token){
    $tmpArr = array($token, $timestamp, $nonce);
    sort($tmpArr, SORT_STRING);
    $tmpStr = implode( $tmpArr );
    $tmpStr = sha1( $tmpStr );
    return $tmpStr;
}

/**
 * 获取微信模板id信息
 * @param $id
 * @return mixed
 */
function get_wxmsg_tpl($id,$col="tempid"){
    $tpl =  M('tempmsg','pigcms_')->where('id=%d',$id)->getField($col);
    return $tpl;
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
 * 是否需要使用 停车场id 进行条件过滤
 * @return mixed 需要的话返回管理员停车场ID
 * @update-time: 2017-05-23 10:21:42
 * @author: 王亚雄
 */
function use_garage_filter(){
    if(session('admin_name') !== SUPPER_ADMIN_NAME){
        //不是超管且garage_id不为0
        $admin_garage_id = M('admin')->where('ad_name="%s"',session('admin_name'))->getField('garage_id');
        if($admin_garage_id!=0){
            return $admin_garage_id;
        }
    }
    return false;
}

/*
 * 过滤不符合当前管理员显示权限的条件
 * */
function check_garage_filter($garage_id){
    if(strpos($garage_id,DELIMITER)){
        //存在多个id
        $garage_id_array = explode(DELIMITER,$garage_id);
        return $garage_id_array;
    }else{
        return $garage_id;
    }

}

/**
 * 多停车场列表显示过滤
 * @author 祝君伟
 * @time 2017年12月12日10:01:37
 * @param $map                             过滤前条件
 * @param int $type                        返回值类型
 * @param string $_prefix                  表别名
 * @return array|mixed|null|string|void    返回值
 */
function filter_garage($map,$type=1,$_prefix='v')
{
    $sesVillageId = session('garage_id');
    $getVillageId= I('get.garage_id');
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

        $map[($_prefix?$_prefix.'.':'').'garage_id'] = $villageId;

    }else if($type ==2){

        $map = $villageId;

    }else{

        $map .= ' and '.($_prefix?$_prefix.'.':'').'garage_id='.$villageId;

    }



    return $map;


}


function true_garage_id(){

    if(session('admin_name') == SUPPER_ADMIN_NAME) return 0;

    $sesGarageId = session('garage_id');
    $getGarageId= I('get.garage_id');

    if(!$sesGarageId&&!$getGarageId) return false;

    if($sesGarageId!=''){

        if ($sesGarageId != $getGarageId){

            $garageId = $sesGarageId;

        }else{

            $garageId = $getGarageId;

        }

    }else{

        return false;

    }

    return $garageId;
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
 * 符合人类视觉美工输出
 * @author：BJY
 * @param $data
 */
function vd($data){
    // 定义样式
    $str='<pre style="display: block;padding: 9.5px;margin: 44px 0 0 0;font-size: 13px;line-height: 1.42857;color: #333;word-break: break-all;word-wrap: break-word;background-color: #F5F5F5;border: 1px solid #CCC;border-radius: 4px;">';
    // 如果是boolean或者null直接显示文字；否则print
    if (is_bool($data)) {
        $show_data=$data ? 'true' : 'false';
    }elseif (is_null($data)) {
        $show_data='null';
    }else{
        $show_data=print_r($data,true);
    }
    $str.=$show_data;
    $str.='</pre>';
    echo $str;
}


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

