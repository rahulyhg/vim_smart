<?php
//保存用户的地理位置
class UserlonglatAction extends BaseAction{
	public function report(){
		if(IS_POST){
			if($_SESSION['openid'] && $_POST['userLong'] && $_POST['userLat']){
				D('User_long_lat')->saveLocation($_SESSION['openid'],$_POST['userLong'],$_POST['userLat']);
				empty($_COOKIE['userLocationHasRecord']) && setcookie('userLocationHasRecord','1',$_SERVER['REQUEST_TIME']+120,'/');
			}
		}
	}
}
?>