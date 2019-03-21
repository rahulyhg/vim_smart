<?php
class RedirectAction extends BaseAction{
    public function index(){
    	$url = htmlspecialchars_decode($_GET['url']);
		$param = 'openid='.$_SESSION['openid'].'&uid='.$_SESSION['user']['uid'];
		if(strpos($url,'?') !== false){
			redirect($url.'&'.$param);
		}else{
			redirect($url.'?'.$param);
		}
    }
}
?>