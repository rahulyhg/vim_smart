<?php
/*
 * 微信图文的文章页
 *
 */
class ArticleAction extends BaseAction{
	public function __construct()
	{
		parent::__construct();
	}
	public function index(){
		
		if (isset($_GET['imid'])) {
			$id = isset($_GET['imid']) ? intval($_GET['imid']) : 0;
			$image_text = D('Image_text')->where(array('pigcms_id' => $id))->find();
			$image_text['now'] = date('Y-m-d');
			$this->assign('url', U('Article/index', array('imid' => $image_text['pigcms_id'])));
			
			if($_SESSION['openid'] && isset($_GET['lid'])){
				
				$logid = intval($_GET['lid']);
				$openid = $_SESSION['openid'];
				$log = D('Send_user')->where(array('log_id' => $logid,'openid'=>$openid,'status'=>1))->find();
				if (empty($log))return;
				
				$log['is_read'] = intval($log['is_read']);
				if($log['is_read'] == 0){
					$user = D('User')->get_user($openid,'openid');
					if($user){
						D('User')->add_score($user['uid'],$this->config['customer_one_score'],'群发消息 粉丝查看消息后获得积分');
						D('Send_user')->where(array('log_id' => $logid,'openid'=>$openid))->save(array('is_read'=>1));
					}
				}
			}
		} elseif (isset($_GET['sid'])) {
			$id = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
			$image_text = D('Platform')->where(array('id' => $id))->find();
			$image_text['cover_pic'] = $this->config['site_url'] . $image_text['pic'];
			$image_text['now'] = date('Y-m-d');
			$this->assign('url', U('Article/index', array('sid' => $image_text['id'])));
		}
		isset($image_text['content']) && !empty($image_text['content']) && $image_text['content']=htmlspecialchars_decode($image_text['content'],ENT_QUOTES);
		$this->assign('nowImage', $image_text);
		$this->display();
	}
}
?>