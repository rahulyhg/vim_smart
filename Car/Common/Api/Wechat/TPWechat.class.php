<?php
namespace Common\Api\Wechat;
use Common\Api\Wechat\Wechat;

class TPWechat extends Wechat
{
    /**
     * 重载构造方法，从数据库中获取默认配置项
     * TPWechat constructor.
     * @param $options
     * @update-time: 2017-03-20 09:56:31
     * @author: 王亚雄
     */
    public function __construct($options){


        //默认使用数据库中的配置
        $default_options = array(
            'token'         =>  WXCONFIG_DB_TOKEN,
            'encodingaeskey'=>  WXCONFIG_DB_ENCODINGAESKEY,
            'appid'         =>  WXCONFIG_DB_APPID,
            'appsecret'     =>  WXCONFIG_DB_APPSECRET,
        );
        //dump($default_options);

        $default_options['token']            = isset($default_options['token'])           ?   $default_options['token']            :"";
        $default_options['encodingaeskey']   = isset($default_options['encodingaeskey'])  ?   $default_options['encodingaeskey']   :"";
        $default_options['appid']            = isset($default_options['appid'])           ?   $default_options['appid']            :"";
        $default_options['appsecret']        = isset($default_options['appsecret'])       ?   $default_options['appsecret']        :"";
        $default_options['debug']            = isset($default_options['debug'])           ?   $default_options['debug']            :false;
        $default_options['logcallback']      = isset($default_options['logcallback'])     ?   $default_options['logcallback']      :false;


        $this->token            = isset($options['token'])          ?   $options['token']           :$default_options['token'];
        $this->encodingAesKey   = isset($options['encodingaeskey']) ?   $options['encodingaeskey']  :$default_options['encodingaeskey'];
        $this->appid            = isset($options['appid'])          ?   $options['appid']           :$default_options['appid'];
        $this->appsecret        = isset($options['appsecret'])      ?   $options['appsecret']       :$default_options['appsecret'];
        $this->debug            = isset($options['debug'])          ?   $options['debug']           :$default_options['debug'];
        $this->logcallback      = isset($options['logcallback'])    ?   $options['logcallback']     :$default_options['logcallback'];
//        dump(  $this->token    );
//        dump(  $this->encodingAesKey    );
//        dump(  $this->appid    );
//        dump(  $this->appsecret    );


    }


    /**
	 * log overwrite
	 * @see Wechat::log()
	 */
	protected function log($log){
		if ($this->debug) {
			if (function_exists($this->logcallback)) {
				if (is_array($log)) $log = print_r($log,true);
				return call_user_func($this->logcallback,$log);
			}elseif (class_exists('Log.class')) {
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
	protected function setCache($cachename,$value,$expired){
		return S($cachename,$value,$expired);
	}

	/**
	 * 重载获取缓存
	 * @param string $cachename
	 * @return mixed
	 */
	protected function getCache($cachename){
		return S($cachename);
	}

	/**
	 * 重载清除缓存
	 * @param string $cachename
	 * @return boolean
	 */
	protected function removeCache($cachename){
		return S($cachename,null);
	}

}



