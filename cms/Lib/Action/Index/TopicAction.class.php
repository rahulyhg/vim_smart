<?php
/*
 * 活动界面
 *
 * 采用空方法处理，可以自定义页面。
 * 
 */
class TopicAction extends BaseAction{
	public function _empty(){
		//热门搜索词
    	$search_hot_list = D('Search_hot')->get_list(12);
    	$this->assign('search_hot_list',$search_hot_list);
		
		//所有分类 包含2级分类
		$all_category_list = D('Group_category')->get_category();
		$this->assign('all_category_list',$all_category_list);
		
		$this->display(ACTION_NAME);
	}
}