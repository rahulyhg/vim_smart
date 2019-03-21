<?php
class LinkAction extends BaseAction
{
	public $modules;
	
	public function _initialize() 
	{
		parent::_initialize();
		
		$this->modules = array(
			'Home' => '首页', 
			'AroundGroup' => '附近'.$this->config['group_alias_name'], 
			'Group' => $this->config['group_alias_name'], 
			'AroundMeal' => '附近'.$this->config['meal_alias_name'], 
			'Meal' => '餐饮', 
			'Kd' => '快店', 
			'Meal_order' => $this->config['meal_alias_name'].'订单', 
			'Group_order' => $this->config['group_alias_name'].'订单', 
			'Group_collect' => $this->config['group_alias_name'].'收藏', 
			'Card_list' => '我的优惠券', 
			'Member' => '会员中心',
			'Navigation' => $this->config['group_alias_name'].'导航',
			'Activity' => '找活动',
			'Storestaff' => '店员中心',
			'Takeout' => '外卖',
			'NearMerchant' => '附近商家',
			'Lifeservice' => '生活缴费',
			'Wapmerchant' => '手机版商家中心',
			'WapmerchantReg' => '手机版商家入驻',
			'AppointList' => '预约列表',
			'News' => '平台快报',
		);
	}
	public function insert()
	{
		$modules = $this->modules();
		$this->assign('modules', $modules);
		$this->display();
	}
	public function modules()
	{
		$t = array(
		array('module' => 'Home', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Home/index', '', true, false, true)), 'name'=>'微站首页','sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>$this->modules['Home'],'askeyword'=>1),
		array('module' => 'Group', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Group/index', '', true, false, true)),'name'=>$this->modules['Group'],'sub'=>1,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module' => 'News', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Systemnews/index', '', true, false, true)),'name'=>$this->modules['News'],'sub'=>1,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module' => 'AroundGroup', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Group/around', '', true, false, true)),'name'=>$this->modules['AroundGroup'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module' => 'Meal', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Meal_list/index', '', true, false, true)),'name'=>$this->modules['Meal'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module' => 'Kd', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Meal_list/index', array('store_type' => 2), true, false, true)),'name'=>$this->modules['Kd'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module' => 'AroundMeal', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Meal_list/around', '', true, false, true)),'name'=>$this->modules['AroundMeal'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module' => 'Meal_order', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/My/meal_order_list', '', true, false, true)),'name'=>$this->modules['Meal_order'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module' => 'Group_order', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/My/group_order_list', '', true, false, true)),'name'=>$this->modules['Group_order'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module' => 'Group_collect', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/My/group_collect', '', true, false, true)),'name'=>$this->modules['Group_collect'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module' => 'Card_list', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/My/card_list', '', true, false, true)),'name'=>$this->modules['Card_list'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module' => 'Member', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/My/index', '', true, false, true)),'name'=>$this->modules['Member'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module' => 'Invitation', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Invitation/datelist', '', true, false, true)),'name'=>$this->modules['Invitation'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module' => 'Navigation', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Group/navigation', '', true, false, true)),'name'=>$this->modules['Navigation'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
// 		array('module' => 'Activity_1', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Activity/index', array('type' => 1), true, false, true)),'name'=>$this->modules['Activity_1'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
// 		array('module' => 'Activity_2', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Activity/index', array('type' => 2), true, false, true)),'name'=>$this->modules['Activity_2'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
// 		array('module' => 'Activity_4', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Activity/index', array('type' => 4), true, false, true)),'name'=>$this->modules['Activity_4'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
// 		array('module' => 'Activity_5', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Activity/index', array('type' => 5), true, false, true)),'name'=>$this->modules['Activity_5'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module' => 'Activity', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Activity/index', '', true, false, true)),'name'=>$this->modules['Activity'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module' => 'Classify', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Classify/index', '', true, false, true)),'name'=>$this->modules['Classify'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module' => 'Storestaff', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Storestaff/index', '', true, false, true)),'name'=>$this->modules['Storestaff'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module' => 'Takeout', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Takeout/index', '', true, false, true)),'name'=>$this->modules['Takeout'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module' => 'NearMerchant', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Merchant/around', '', true, false, true)),'name'=>$this->modules['NearMerchant'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module' => 'Lifeservice', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Lifeservice/index', '', true, false, true)),'name'=>$this->modules['Lifeservice'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module' => 'Wapmerchant', 'linkcode' => str_replace('admin.php', 'index.php', U('WapMerchant/Index/index', '', true, false, true)),'name'=>$this->modules['Wapmerchant'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module' => 'WapmerchantReg', 'linkcode' => str_replace('admin.php', 'index.php', U('WapMerchant/Index/merreg', '', true, false, true)),'name'=>$this->modules['WapmerchantReg'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module' => 'AppointList', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Appoint/index', '', true, false, true)),'name'=>$this->modules['AppointList'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		);
		if ($this->config['house_open']) {
			$t[] = array('module' => 'HousevillageList', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/House/village_list', '', true, false, true)),'name'=>$this->modules['HousevillageList'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1);
		}
		if ($this->config['is_open_weidian']) {
			$t[] = array('module' => 'NearWeiDian', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Weidian/near_store_redirect', '', true, false, true)),'name'=>$this->modules['NearWeiDian'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1);
		}
		if($this->config['waimai_alias_name']){
			$t[] = array('module' => 'WaimaiIndex', 'linkcode' => str_replace('admin.php', 'index.php', U('WaimaiWap/Index/index', '', true, false, true)),'name'=>$this->modules['WaimaiIndex'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1);
			$t[] = array('module' => 'WaimaiUser', 'linkcode' => str_replace('admin.php', 'index.php', U('WaimaiWap/User/index', '', true, false, true)),'name'=>$this->modules['WaimaiUser'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1);
			$t[] = array('module' => 'WaimaiOrder', 'linkcode' => str_replace('admin.php', 'index.php', U('WaimaiWap/Order/index', '', true, false, true)),'name'=>$this->modules['WaimaiOrder'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1);
			$t[] = array('module' => 'WaimaiCoupon2', 'linkcode' => str_replace('admin.php', 'index.php', U('WaimaiWap/User/coupon', array('coupon_type'=>2), true, false, true)),'name'=>$this->modules['WaimaiCoupon2'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1);
			$t[] = array('module' => 'WaimaiCoupon1', 'linkcode' => str_replace('admin.php', 'index.php', U('WaimaiWap/User/coupon', array('coupon_type'=>1), true, false, true)),'name'=>$this->modules['WaimaiCoupon1'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1);
			$t[] = array('module' => 'WaimaiAddress', 'linkcode' => str_replace('admin.php', 'index.php', U('WaimaiWap/User/adresList', '', true, false, true)),'name'=>$this->modules['WaimaiAddress'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1);
			$t[] = array('module' => 'WaimaiDeliver', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Deliver/grab', '', true, false, true)),'name'=>$this->modules['WaimaiDeliver'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1);
		}
		foreach($t as $key=>$value){
			if(empty($value['name'])){
				unset($t[$key]);
			}
		}
		return $t;
	}
	
	public function Group()
	{
		$this->assign('moduleName', $this->modules['Group']);
		$cat_fid = isset($_GET['cat_fid']) ? intval($_GET['cat_fid']) : 0;
		$where = array('cat_fid' => $cat_fid);
		$db = D('Group_category');
		$count      = $db->where($where)->count();
		$Page       = new Page($count, 5);
		$show       = $Page->show();

		$list = $db->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
		$items = array();
		foreach ($list as $item){
			if ($db->where(array('cat_fid' => $item['cat_id']))->find()) {
				array_push($items, array('id' => $item['cat_id'], 'sub' => 1, 'name' => $item['cat_name'], 'linkcode'=> str_replace('admin.php', 'wap.php', U('Wap/Group/index', array('cat_url' => $item['cat_url']), true, false, true)),'sublink' => U('Link/group', array('cat_fid' => $item['cat_id']), true, false, true),'keyword' => $item['cat_name']));
			} else {
				array_push($items, array('id' => $item['cat_id'], 'sub' => 0, 'name' => $item['cat_name'], 'linkcode'=> str_replace('admin.php', 'wap.php', U('Wap/Group/index', array('cat_url' => $item['cat_url']), true, false, true)),'sublink' => '','keyword' => $item['cat_name']));
			}
		}
		dump($items);
		$this->assign('list', $items);
		$this->assign('page', $show);
		$this->display('detail');
	}

	public function News()
	{
		$this->assign('moduleName', $this->modules['News']);
		$where['status'] =  1;
		$db = D('System_news_category');
		$count      = $db->where($where)->count();
		$Page       = new Page($count, 5);
		$show       = $Page->show();
		$list = $db->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
		$items = array();
		foreach ($list as $item){
			if ($db->where(array('id' => $item['id']))->find()) {
				array_push($items, array('id' => $item['id'], 'sub' => 1, 'name' => $item['name'], 'linkcode'=> str_replace('admin.php', 'wap.php',  U('Wap/Systemnews/index', array('cat_id' => $item['id']), true, false, true)),'sublink' => U('Link/news', array('cat_fid' => $item['cat_id']), true, false, true),'keyword' => $item['cat_name']));
			} else {
				array_push($items, array('id' => $item['id'], 'sub' => 0, 'name' => $item['name'], 'linkcode'=> str_replace('admin.php', 'wap.php', U('Wap/Systemnews/index', array('cat_id' => $item['id']), true, false, true)),'sublink' => '','keyword' => $item['cat_name']));
			}
		}
		$this->assign('list', $items);
		$this->assign('page', $show);
		$this->display('detail');
	}
}
?>