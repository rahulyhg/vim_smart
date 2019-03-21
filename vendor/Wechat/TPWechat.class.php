<?php
/**
 *	微信公众平台PHP-SDK, ThinkPHP实例
 *  @author dodgepudding@gmail.com
 *  @link https://github.com/dodgepudding/wechat-php-sdk
 *  @version 1.2
 *  usage:
 *   $options = array(
 *			'token'=>'tokenaccesskey', //填写你设定的key
 *			'encodingaeskey'=>'encodingaeskey', //填写加密用的EncodingAESKey
 *			'appid'=>'wxdk1234567890', //填写高级调用功能的app id
 *			'appsecret'=>'xxxxxxxxxxxxxxxxxxx' //填写高级调用功能的密钥
 *		);
 *	 $weObj = new TPWechat($options);
 *   $weObj->valid();
 *   ...
 *
 */
class TPWechat extends Wechat
{
	/**
	 * log overwrite
	 * @see Wechat::log()
	 */
	protected function log($log){
		if ($this->debug) {
			if (function_exists($this->logcallback)) {
				if (is_array($log)) $log = print_r($log,true);
				return call_user_func($this->logcallback,$log);
			}elseif (class_exists('Log')) {
				Log::write('wechat：'.$log, Log::DEBUG);
				return true;
			}
		}
		return false;
	}

	/**
	 * 重载设置缓存
	 * @param string $cachename
	 * @param mixed $value
	 * @param int $expired
	 * @return boolean
	 */
	protected function setCache_bak($cachename,$value,$expired){
		return S($cachename,$value,$expired);
	}

    protected function setCache($cachename,$value,$expired){
	    $cachename = str_replace('wechat_access_token','',$cachename);
        $data = array(
            'appid'=>$cachename,
            'access_token'=>$value,
            'expires_in'=>$expired,
            'create_time'=>time()
        );
        $num =  M('wx_token','pigcms_')->add($data);
        return $num;
	}

	/**
	 * 重载获取缓存
	 * @param string $cachename
	 * @return mixed
	 */
	protected function getCache_bak($cachename){
		return S($cachename);
	}

    protected function getCache($cachename){
        $cachename = str_replace('wechat_access_token','',$cachename);
        $info = M('wx_token','pigcms_')->where('appid="%s"',$cachename)->order('create_time desc')->find();
        if(!$info) return null;
        if(time()-$info['create_time']>$info['expires_in']) return null;
        return $info['access_token'];
    }

	/**
	 * 重载清除缓存
	 * @param string $cachename
	 * @return boolean
	 */
    protected function removeCache_bak($cachename){
        return S($cachename,null);
    }

	protected function removeCache($cachename){
        $cachename = str_replace('wechat_access_token','',$cachename);
		return M('wx_token','pigcms_')->where('appid="%s"',$cachename)->delete();
	}

}



