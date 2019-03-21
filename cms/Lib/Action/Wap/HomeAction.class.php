<?phpclass HomeAction extends BaseAction{	static $often_village_id;	public function _initialize() {	    parent::_initialize();	}    	public function index(){		//判断是否是微信浏览器，如果是读取微信提供的位置信息。		if($_SESSION['openid']) $this->assign('user_long_lat',D('User_long_lat')->getLocation($_SESSION['openid']));		//活动列表		if($this->config['activity_open']){			$now_activity = D('Extension_activity')->where(array('begin_time'=>array('lt',$_SERVER['REQUEST_TIME']),'end_time'=>array('gt',$_SERVER['REQUEST_TIME'])))->order('`activity_id` ASC')->find();            if($now_activity){				// list($time_array['d'],$time_array['h'],$time_array['m'],$time_array['s']) = explode(' ',date('j H i s',$now_activity['end_time'] - $_SERVER['REQUEST_TIME']));				$time = $now_activity['end_time'] - $_SERVER['REQUEST_TIME'];				$time_array['d'] = floor($time/86400);				$time_array['h'] = floor($time%86400/3600);				$time_array['m'] = floor($time%86400%3600/60);				$time_array['s'] = floor($time%86400%60);				// $activity_list = D('Extension_activity_list')->field('`pigcms_id`,`name`,`title`,`pic`,`all_count`,`part_count`,`price`,`mer_score`,`type`')->where(array('activity_term'=>$now_activity['activity_id'],'status'=>'1','is_finish'=>'0','index_sort'=>array('neq','0')))->order('`index_sort` DESC,`pigcms_id` DESC')->limit(3)->select();				$activity_list = D('')->field('`eac`.`pigcms_id`,`eac`.`name`,`eac`.`title`,`eac`.`pic`,`eac`.`all_count`,`eac`.`part_count`,`eac`.`price`,`eac`.`money`,`eac`.`mer_score`,`eac`.`type`')->table(array(C('DB_PREFIX').'extension_activity_list'=>'eac',C('DB_PREFIX').'merchant'=>'m'))->where("`eac`.activity_term='{$now_activity['activity_id']}' AND `eac`.`status`='1' AND `eac`.`is_finish`='0' AND `eac`.`index_sort`>0 AND `eac`.`mer_id`=`m`.`mer_id` AND `m`.`city_id`='{$this->config['now_city']}'")->order('`eac`.`index_sort` DESC,`eac`.`pigcms_id` DESC')->limit(3)->select();                if(empty($activity_list)){					unset($now_activity);				}				$this->assign('now_activity',$now_activity);				$this->assign('time_array',$time_array);				$extension_image_class = new extension_image();				foreach($activity_list as &$activity_value){					$activity_value['list_pic'] = $extension_image_class->get_image_by_path(array_shift(explode(';',$activity_value['pic'])),'s');				}				$this->assign('activity_list',$activity_list);			}		}		//手动首页排序团购		$index_sort_group_list = D('Group')->get_group_list('index_sort',3,true);		$this->assign('index_sort_group_list',$index_sort_group_list);				//顶部广告		$wap_index_top_adver = D('Adver')->get_adver_by_key('wap_index_top',5);		$this->assign('wap_index_top_adver',$wap_index_top_adver);				//中间广告		$wap_index_center_adver = D('Adver')->get_adver_by_key('wap_index_center',4);		$this->assign('wap_index_center_adver',$wap_index_center_adver);				//导航条		$tmp_wap_index_slider = D('Slider')->get_slider_by_key('wap_slider',0);		$wap_index_slider = array();		foreach($tmp_wap_index_slider as $key=>$value){			$tmp_i = floor($key/8);			$wap_index_slider[$tmp_i][] = $value;		}		$this->assign('wap_index_slider',$wap_index_slider);				//平台快报		$news_list = M('System_news')->field('`id`,`title`')->where('status = 1')->order('`sort` DESC,`id` DESC')->limit(8)->select();		$this->assign('news_list',$news_list);				//最新20条团购		$new_group_list = D('Group')->get_group_list('index_sort',15,true);		$this->assign('new_group_list',$new_group_list);				//分类信息分类		if($this->config['wap_home_show_classify']){			$database_Classify_category = D('Classify_category');			$Zcategorys = $database_Classify_category->field('`cid`,`cat_name`,`cat_pic`')->where(array('subdir' => 1, 'cat_status' => 1))->order('`cat_sort` DESC,`cid` ASC')->select();            if (!empty($Zcategorys)) {				$newtmp = array();				foreach ($Zcategorys as $vv) {					if(!empty($vv['cat_pic'])){						$vv['cat_pic'] = $this->config['site_url'].'/upload/system/'.$vv['cat_pic'];					}					unset($vv['cat_field']);					$subdir_info = $this->get_Subdirectory($vv['cid'], 1);					if(!empty($subdir_info)){						$vv['subdir'] = $subdir_info;					}					$newtmp[$vv['cid']] = $vv;					if(count($vv['subdir'])%3 != 0){						$newtmp[$vv['cid']]['subEmptyCount'] = 3-(count($vv['subdir'])%3);					}						}				$Zcategorys = $newtmp;			}			$this->assign('classify_Zcategorys', $Zcategorys);			// dump($Zcategorys);		}		/* 粉丝行为分析 */		//$this->behavior(array('model'=>'Home_index'),true);				$model = new Model();		$sql = " select m.pic_info, m.name, m.mer_id, m.share_open from " . C('DB_PREFIX') . "merchant as m inner join " . C('DB_PREFIX') . "merchant_user_relation as r on r.mer_id=m.mer_id where r.openid='{$_SESSION['openid']}' order by r.dateline asc limit 1";		$result = $model->query($sql);		$now_merchant = isset($result[0]) && $result[0] ? $result[0] : null;		if ($now_merchant) {			$pic = '';			if ($now_merchant['pic_info']) {				$images = explode(";", $now_merchant['pic_info']);				$merchant_image_class = new merchant_image();				$images = explode(";", $images[0]);				$pic = $merchant_image_class->get_image_by_path($images[0]);			}			switch ($this->config['home_share_show_open']) {				case 0: //总关闭					if ($now_merchant['share_open'] == 1) {						$share = D('Home_share')->where(array('mer_id' => $now_merchant['mer_id']))->find();						if (empty($share)) {							$share = array('title' => str_replace('{title}', $now_merchant['name'], $this->config['home_share_txt']), 'a_name' => '进入', 'a_href' => $this->config['site_url'] . '/wap.php?c=Index&a=index&token=' . $now_merchant['mer_id']);						}						$share['image'] = $pic;						$this->assign('share', $share);					} elseif ($now_merchant['share_open'] == 2) {						header('Location:' . $this->config['site_url'] . '/wap.php?c=Index&a=index&token=' . $now_merchant['mer_id']);						exit();					}					break;				case 1:	//全开启首页广告					$share = D('Home_share')->where(array('mer_id' => $now_merchant['mer_id']))->find();					if (empty($share)) {						$share = array('title' => str_replace('{title}', $now_merchant['name'], $this->config['home_share_txt']), 'a_name' => '进入', 'a_href' => $this->config['site_url'] . '/wap.php?c=Index&a=index&token=' . $now_merchant['mer_id']);					}					$share['image'] = $pic;					$this->assign('share', $share);					break;				case 2:	//全开启跳转到首页					header('Location:' . $this->config['site_url'] . '/wap.php?c=Index&a=index&token=' . $now_merchant['mer_id']);					exit();					break;			}		}		$pse = $_GET['pse'];		$this->assign('pse',$pse);//		dump($pse);exit;		$ty = $this->get_device_type();		$this->assign('type',$ty);		$share_arr=array(	//微信分享开始			'title'=>'汇得行智慧助手',			'desc'=>'打造真正的智慧物业服务平台',			'imgUrl'=>C('config.site_url').'/tpl/Wap/default/static/images/house.jpg',			'link'=>C('config.site_url').'/wap.php?g=Wap&c=Home&a=index'		);		$share = new WechatShare($this->config, $_SESSION['openid'],$share_arr);		$this->shareScript = $share->getSgin();		$this->assign('shareScript', $this->shareScript);//微信分享结束		$this->display();	}	/*	 * 新Wap主页--	 * 祝君伟	 * */	public function index_new(){		//获取新主页构造结构		//当前用户的所属社区信息		//判断当前用户是否切换首页		//判断是否是微信浏览器，如果是读取微信提供的位置信息。		//TODO：关于定位，只有当用户第一次进入首页的时候才自动定位，如果选择了项目则以后默认进入该项目，所有认证了业主的用户全部进入业主认证的项目        //首次进入以后需要验证是否登陆        if(empty($this->user_session)){            $location_param['referer'] = urlencode($_SERVER['REQUEST_URI']);            redirect(U('Login/index',$location_param));        }		//静态化选择的项目		if(self::$often_village_id!=''){			$village_id=self::$often_village_id;		}else{			$uid = session('user.uid');			if(empty($uid)){				$openid = session('openid');				$uid = M('user')->where(array('openid'=>$openid))->getField('uid');			}			$user_info = M('house_village_user_bind')->where(array('uid'=>$uid))->find();			if($user_info){				//该用户是认证过得老用户				$village_id = M('house_village_user_bind')->where(array('uid'=>$uid))->getField('village_id');			}else{				//该用户是没有认证过得新用户，默认进入最近的项目				$this->assign('v_state',1);			}			$village = I('get.village_id');			$model_choose = I('get.type');			if(!empty($village)){				//用户手动选择了项目				$village_id = $village;				//修改静态化项目id				self::$often_village_id = $village;			}		}		$village_name = M('house_village')->where(array('village_id'=>$village_id))->getField('village_name');		$field = array(			't.type_name',			't.short_tag',			'v.village_name',			'a.*'		);		$main_content = M('adver')			->alias('a')			->field($field)			->join('LEFT JOIN pigcms_house_village v on a.village_id=v.village_id')			->join('LEFT JOIN pigcms_wap_group_type t on a.type_id=t.type_id')			->where(array('a.village_id'=>$village_id,'a.fid'=>0,'a.status'=>1))			->select();		//分情况考虑情况。默认所有的项目都有八大模块，但是添加隐藏功能管理员可以更改模块。		//TODO: 主结构管理		if(empty($model_choose)){			//不启用修改主模块功能			//所有的项目都有模块			//主结构数组			$main_construction_array = array(				'ds',  //顶部搜索				'dp',  //顶部轮播				'si',  //上部图标导航				'zg',  //中部广告栏				'xm',  //下部图片服务栏				'dq',  //底部企业服务栏				'dd',  //底部导航栏			);		}else{			$main_construction_array =array();			//启用修改主模块功能			foreach ($main_content as $key=>$value){				$main_construction_array[] = $value['short_tag'];			}		}		//TODO: 子结构管理		if($main_content == null){			//如果没有查到数组,代表该项目下没有配置，那么现实默认通用模块			$field = array(				't.type_name',				't.short_tag',				'v.village_name',				'a.*'			);			$main_content_default = M('adver')				->alias('a')				->field($field)				->join('LEFT JOIN pigcms_house_village v on a.village_id=v.village_id')				->join('LEFT JOIN pigcms_wap_group_type t on a.type_id=t.type_id')				->where(array('a.village_id'=>1,'a.fid'=>0,'a.status'=>1))				->select();			//子结构数组			$children_construction_array = array();			//构造子内容数组			foreach ($main_content_default as $key=>$value){				$children_construction_array[$value['short_tag']] = M('adver')->where(array('fid'=>$value['id'],'status'=>1))->select();			}			//vd($children_construction_array);exit;		}else{		    //TODO:七大模块都能默认存在            //子结构数组            $children_construction_array = array();            //构造子内容数组            foreach ($main_construction_array as $value){                $children_construction_array[$value] = $this->magic_auto_complete($value,$village_id);            }            //vd($children_construction_array);exit;		}		//全项目显示		$village_array = M('house_village')->where(array('status'=>1))->select();		$this->assign('village_name',$village_name);		$this->assign('village_array',$village_array);		$this->assign('main_construction',$main_construction_array);		$this->assign('children_construction',$children_construction_array);		//社区新闻读取，基本规则：ACE 全区最新发布的新闻，TOP 该社区最新的新闻，BOSS 通用新闻,读最新的新闻		//全区通用的最新新闻		$new_comment_news = M('house_village_news')->where(array('village_id'=>1))->order('add_time desc')->find();		$new_village_news = M('house_village_news')->where(array('village_id'=>$village_id))->order('add_time desc')->find();		if($new_comment_news['add_time']>$new_village_news['add_time']){			$zn_array = $new_comment_news;		}else{			$zn_array = $new_village_news;		}		$this->assign('zn_array',$zn_array);		//TODO: 微信JSSDK配置		$share_arr=array(	//微信分享开始			'title'=>'汇得行智慧助手',			'desc'=>'打造真正的智慧物业服务平台',			'imgUrl'=>C('config.site_url').'/tpl/Wap/default/static/images/house.jpg',			'link'=>C('config.site_url').'/wap.php?g=Wap&c=Home&a=index'		);		if (isset($_GET['weixin_bind_ok'])) {            $this->redirect('PropertyService/bind_phone');        }        if (isset($_GET['fff_zzz'])) {            $this->redirect('PropertyService/punch_card',array('id'=>$_GET['fff_zzz']));        }		$share = new WechatShare($this->config, $_SESSION['openid'],$share_arr);		$this->shareScript = $share->getSgin();		$this->assign('shareScript', $this->shareScript);//微信分享结束        $village_info = M('house_village')->where(array('village_id'=>$village_id))->find();        $this->assign('village_info',$village_info);        //本次主页显示固定village_id		$this->assign('village_id',$village_id);		$this->display();	}	/*	 * 项目列表1	 * */	public function village_list(){		$village_array = M('house_village')->where(array('status'=>1))->select();		$village_list = '';		foreach ($village_array as $value){			$village_list.='<option value="'.$value['village_id'].'">'.$value['village_name'].'</option>';		}		echo $village_list;	}    /**     * 自动补全默认元素,重复模块支持排序     * @param $short_tag  短标记     * @param $village_id  所在社区id     * @return array|mixed  返回该短标记下的所有元素列表     * @author 祝君伟     * @time  2017年7月31日10:42:54     */	public function magic_auto_complete($short_tag,$village_id){	    if($short_tag == 'si' || $short_tag == 'xm' || $short_tag == 'dq'){            //特殊替换完成，需要元素的合并追加            $type_id = M('wap_group_type')->getFieldByShort_tag($short_tag,'type_id');            //先判断是否有创建该模块            $is_exist_module = M('adver')->where(array('village_id'=>$village_id,'type_id'=>$type_id,'fid'=>0))->find();            if($is_exist_module){                //存在该模块，判断底下有没有元素                $children_array = M('adver')->where(array('village_id'=>$village_id,'type_id'=>$type_id,'fid'=>array('neq',0),'status'=>1,'is_online'=>1))->select();                if($children_array == null){                    //顶部轮播栏元素为空的时候直接用默认的模板                    $children_array = M('adver')->where(array('village_id'=>1,'type_id'=>$type_id,'fid'=>array('neq',0)))->select();                }else{                    if($short_tag == 'xm'){                        //下部图片服务栏特殊，6格为上限，并不支持排序                        $children_conut = M('adver')->where(array('village_id'=>$village_id,'type_id'=>$type_id,'fid'=>array('neq',0)))->count();                        if($children_conut < 6){                            //存在元素，但是没有达到固定的上限                            for ($x=1; $x<=6; $x++){                                $number_count = M('adver')->where(array('village_id'=>$village_id,'type_id'=>$type_id,'fid'=>array('neq',0),'number'=>$x))->count();                                if($number_count == 0 ){                                    //缺失项，用默认的选项往里面补                                    $children_array[] = M('adver')->where(array('village_id'=>$village_id,'type_id'=>$type_id,'fid'=>array('neq',0),'number'=>$x))->find();                                }                            }                        }                    }else{                        // 8个为上限                        $children_conut = M('adver')->where(array('village_id'=>$village_id,'type_id'=>$type_id,'fid'=>array('neq',0)))->count();                        if($children_conut < 8){                            //存在元素，但是没有达到固定的上限                            for ($x=1; $x<=8; $x++){                                $number_count = M('adver')->where(array('village_id'=>$village_id,'type_id'=>$type_id,'fid'=>array('neq',0),'number'=>$x,'status'=>1,'is_online'=>1))->count();                                if($number_count == 0 && $short_tag !== 'si'){//顶部到导航栏不需自动填补 zhukeqin                                    //缺失项，用默认的选项往里面补                                    $children_array[] = M('adver')->where(array('village_id'=>1,'type_id'=>$type_id,'fid'=>array('neq',0),'number'=>$x,'status'=>1,'is_online'=>1))->find();                                }                            }                        }else{                            //针对排序                            $children_array = M('adver')->where(array('village_id'=>$village_id,'type_id'=>$type_id,'fid'=>array('neq',0),'status'=>1,'is_online'=>1))->order('number asc')->select();                        }                    }                }            }else{                //不存在该模块，直接用默认模块元素显示到页面                $children_array = M('adver')->where(array('village_id'=>1,'type_id'=>$type_id,'fid'=>array('neq',0)))->select();            }        }else{	        //普通完成，只需要查到该元素拥有便不使用默认元素            $type_id = M('wap_group_type')->getFieldByShort_tag($short_tag,'type_id');            //先判断是否有创建该模块            $is_exist_module = M('adver')->where(array('village_id'=>$village_id,'type_id'=>$type_id,'fid'=>0))->find();            if($is_exist_module){                //存在该模块，判断底下有没有元素                $children_array = M('adver')->where(array('village_id'=>$village_id,'type_id'=>$type_id,'fid'=>array('neq',0)))->select();                if($children_array == null){                    //顶部轮播栏元素为空的时候直接用默认的模板                    $children_array = M('adver')->where(array('village_id'=>1,'type_id'=>$type_id,'fid'=>array('neq',0)))->select();                }            }else{                //不存在该模块，直接用默认模块元素显示到页面                $children_array = M('adver')->where(array('village_id'=>1,'type_id'=>$type_id,'fid'=>array('neq',0)))->select();            }        }        return $children_array;    }//	扫码function pseudo(){	$this->display();}//	判断手机的类型	function get_device_type(){		$agent = strtolower($_SERVER['HTTP_USER_AGENT']);		$type = 'other';		if(strpos($agent, 'iphone') || strpos($agent, 'ipad')){			$type = 'ios';		}		if(strpos($agent, 'android')){			$type = 'android';		}		return $type;	}	public function near_info(){		$condition_where  = "`status`='1'";		switch($_POST['type']){			case 'merchant':// 				$condition_where  = '';				break;			case 'meal':				$condition_where .= " AND `have_meal`='1'";				break;			case 'group':				$condition_where .= " AND `have_group`='1'";				break;			default:				$this->error('非法访问！');		}		$x = $_POST['lat'];		$y = $_POST['long'];				import('@.ORG.longlat');		$longlat_class = new longlat();		$location = $longlat_class->gpsToBaidu($x,$y);//转换腾讯坐标到百度坐标		$x = $location['lat'];		$y = $location['lng'];		if($this->is_wexin_browser && !empty($_SESSION['openid'])){			$condition_user_long_lat['open_id'] = $_SESSION['openid'];			$data_user_long_lat['lat'] = $x;			$data_user_long_lat['long'] = $y;			$data_user_long_lat['dateline'] = $_SERVER['REQUEST_TIME'];			$database_user_long_lat = D('User_long_lat');			if($database_user_long_lat->field('`open_id`')->where($condition_user_long_lat)->find()){				$database_user_long_lat->where($condition_user_long_lat)->data($data_user_long_lat)->save();			}else{				$data_user_long_lat['open_id'] = $_SESSION['openid'];				$database_user_long_lat->data($data_user_long_lat)->add();			}		}				$store_list = D("Merchant_store")->field("*, ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$x}*PI()/180-`lat`*PI()/180)/2),2)+COS({$x}*PI()/180)*COS(`lat`*PI()/180)*POW(SIN(({$y}*PI()/180-`long`*PI()/180)/2),2)))*1000) AS juli")->where($condition_where)->order('`juli` ASC')->limit('0,6')->select();				if(!empty($store_list)){			$store_image_class = new store_image();			foreach($store_list as &$store){				$images = $store_image_class->get_allImage_by_path($store['pic_info']);				$store['image'] = $images ? array_shift($images) : '';								if($store['juli'] > 1000){					$store['juli'] = ' '.floatval(round($store['juli']/1000,1)).' 千米';				}else{					$store['juli'] = ' '.$store['juli'].' 米';				}								switch($_POST['type']){					case 'merchant':						$store['url'] = U('Index/index',array('token'=>$store['mer_id']));						break;					case 'meal':						$store['url'] = U('Meal/menu',array('mer_id'=>$store['mer_id'],'store_id'=>$store['store_id']));						break;					case 'group':						$store['url'] = U('Group/shop',array('store_id'=>$store['store_id']));						break;					default:						$this->error('非法访问！');				}			}			echo json_encode(array('error'=>0,'store_list'=>$store_list));		}else{			echo json_encode(array('error'=>1));		}	}		public function group_index_sort(){		$group_id = $_POST['id'];		$database_index_group_hits = D('Index_group_hits');		$data_index_group_hits['group_id'] = $group_id;		$data_index_group_hits['ip']		= get_client_ip();		if(!$database_index_group_hits->field('`group_id`')->where($data_index_group_hits)->find()){			$condition_group['group_id'] = $group_id;			if(M('Group')->where($condition_group)->setDec('index_sort')){				if ($this->config['is_open_click_fans'] && $_SESSION['openid']) {					$group = M('Group')->where($condition_group)->find();					if (!($relation = D('Merchant_user_relation')->field(true)->where(array('openid' => $_SESSION['openid'], 'mer_id' => $group['mer_id']))->find())) {						D('Merchant_user_relation')->add(array('openid' => $_SESSION['openid'], 'mer_id' => $group['mer_id'], 'dateline' => time(), 'from_merchant' => 3));//点击获取的粉丝类型					}				}				$data_index_group_hits['time'] = $_SERVER['REQUEST_TIME'];				$database_index_group_hits->data($data_index_group_hits)->add();			}		}	}	private function get_Subdirectory($cid, $subdir, $m = 2) {        $Classify_categoryDb = M('Classify_category');        $Subdirectory = array();        $where = false;        if ($m == 2) {            $where = array('fcid' => $cid, 'subdir' => 2, 'cat_status' => 1);        } elseif ($m == 3) {            if ($subdir == 1) {                $where = array('pfcid' => $cid, 'subdir' => 3, 'cat_status' => 1);            } else {                $where = array('fcid' => $cid, 'subdir' => 3, 'cat_status' => 1);            }        }        if ($where) {            $Subdirectory = $Classify_categoryDb->field('`cid`,`cat_name`')->where($where)->order('`cat_sort` DESC,`cid` ASC')->select();        }        return $Subdirectory;    }	public  function    ajaxLogin(){        echo 1;    }	/*	 * ajax 全页面加载完成以后定位当前位置与项目位置	 * author 祝君伟	 *	 * */	public function check_gps_near_village(){		$long = I('post.long');		$lat = I('post.lat');		import('@.ORG.longlat');		$longlat_class = new longlat();		//转化为百度坐标		$location2 = $longlat_class->gpsToBaidu($lat,$long);		//测算两者之间的距离		//全项目显示		$village_array = M('house_village')->where(array('status'=>1))->select();		$distance = array();		foreach ($village_array as $key => $value){			$distance[$value['village_id']] = $longlat_class->GetDistance($location2['lat'],$location2['lng'],$value['lat'],$value['long']);		}		arsort($distance);		$last = end($distance);		$last_key = key($distance);		echo $last_key;		//echo '离您最近的是'.$last_key.'距离'.$last.'m';	}}	?>