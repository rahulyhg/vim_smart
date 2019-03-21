<?php

class BaseAction extends CommonAction
{
    public $now_user;

    protected function _initialize()
    {
        parent::_initialize();

        if (empty($this->user_session)) {
			redirect(u('Index/Login/index', array('referer' => urlencode('http://' . $_SERVER['HTTP_HOST'] . (!(true == empty($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'])))));
            exit();
        }

		$now_user = d('User')->get_user($this->user_session['uid']);

        import("@.ORG.UcService");//导入UcService.class.php类
        $ucService = new UcService;
        $status = $ucService->check_avatar($now_user['uc_id']);
//        dump($status);exit;
        if($status){
            $this->assign('pic','<img src="http://www.yourwebsite.com/uc_server/avatar.php?uid=$now_user[\'uc_id\']&size=big" />');
        }

        if (empty($now_user)) {
			$this->error_tips('未获取到您的帐号信息，请重试！');
        }

		$now_user['now_money'] = floatval($now_user['now_money']);
        $this->now_user = $now_user;
		$this->assign('now_user', $now_user);
    }

    public function _empty()
    {
		$this->error('Fuck ! 你搞错了。');
    }
}


?>
