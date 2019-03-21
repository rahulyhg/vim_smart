<?php
class SearchAction extends BaseAction{
	public function index(){
		//热门搜索词
		if(empty($_GET['type'])){
			
		}
		$type = $_GET['type'] == 'meal' ? 1 : 0;
    	$search_hot_list = D('Search_hot')->get_list(18,$type,true);
    	$this->assign('search_hot_list',$search_hot_list);
		
		$this->display();
	}
	public function group(){
		$keywords = htmlspecialchars($_REQUEST['w']);
		$this->assign('keywords',$keywords);
		
		$group_category = D('Group_category')->field('`cat_url`')->where(array('cat_name'=>$keywords,'cat_status'=>'1'))->find();
		if($group_category['cat_url']){
			redirect(U('Group/index',array('cat_url'=>$group_category['cat_url'],'w'=> urlencode($keywords))));exit;
		}
		
		$sort = empty($_GET['sort']) ? 'default' : $_GET['sort'];
		
		$this->assign('now_sort',$sort);
		
		//得到搜索的团购列表
		$group_return = D('Group')->get_group_list_by_keywords($keywords,$sort,true);
		$this->assign($group_return);
		// dump($group_return);exit;
		
		$this->display();
	}
	
	public function meal()
	{
		$keywords = htmlspecialchars($_REQUEST['w']);
		$this->assign('keywords',$keywords);
		
		$sort = empty($_GET['sort']) ? 'default' : $_GET['sort'];
		
		$this->assign('now_sort',$sort);
		
		//得到搜索的店铺列表
		$return = D('Merchant_store')->get_list_by_search($keywords, $sort, true);
		$this->assign($return);

		$this->display();
	}
	
	public function appoint()
	{
		$keywords = htmlspecialchars($_REQUEST['w']);
		
		$this->assign('keywords',$keywords);
	
		$sort = empty($_GET['sort']) ? 'default' : $_GET['sort'];
		
		$this->assign('now_sort',$sort);
		
		//得到搜索的店铺列表
		$return = D('Appoint')->get_list_by_search($keywords, $sort, true);

		$this->assign($return);
				
		$this->display();
	}
}
?>