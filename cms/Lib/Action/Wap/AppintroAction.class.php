<?php
class AppintroAction extends BaseAction{
	public function  intro(){
		$intro = D('Appintro')->where('id='.$_GET['id'])->select();
		$this->assign('intro',$intro[0]);
		$this->display();
	}
}