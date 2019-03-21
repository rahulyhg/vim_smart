<?PHP

/**
 * Class UcService
 *Ucenter的通讯处理类文件
 */
class UcService
{
    /**
     * UcService constructor.
     * 构造方法
     * 包含文件
     */
    public function __construct()
    {
        include_once(THINK_PATH . 'conf/config_ucenter.php');//ucenter的配置处理类文件
        include_once(THINK_PATH . 'uc_client/client.php');//客户文件
    }
    /**
     * 会员注册
     *
     */
    public function register($username, $password){
        return APP_PATH . 'conf/config_ucenter.php';
        $uid = uc_user_register($username, $password);//UCenter的注册验证函数
        return intval($uid);
    }

    /**
     * @param $username 用户名
     * @param $password 密码
     * @return array|string 返回值
     * 用户同步uc的登录
     */
    public function uc_login($username, $password){
        list($uid, $username, $password, $email) = uc_user_login($username, $password);
        if($uid > 0) {
            return array(
                'uid' => $uid,
                'username' => $username,
                'password' => $password,
                'email' => $email
            );
        } elseif($uid == -1) {
            return '用户不存在,或者被删除';
        } elseif($uid == -2) {
            return '密码错误';
        } elseif($uid == -3) {
            return '安全提问错误';
        } else {
            return '未定义';
        }
    }

    /**
     * @param $uid 用户id
     * @return string
     * 使用uc同步登录
     */
    public function uc_synlogin($uid){
        return uc_user_synlogin($uid);
    }


}
