<?php
/**
 * 预约服务列表
 * AppointAction
 * @author yaolei
 */
class AppointAction extends BaseAction{
	/* 服务列表 */
	public function index(){
		$database_appoint = D('Appoint');
		$database_merchant = D('Merchant');
		$database_category = D('Appoint_category');
		$condition_appoint['mer_id'] = $this->merchant_session['mer_id'];
		$appoint_count = $database_appoint->where($condition_appoint)->count();
		
		import('@.ORG.merchant_page');
		$page = new Page($appoint_count, 20);
		$appoint_info = $database_appoint->field(true)->where($condition_appoint)->order('`appoint_id` DESC')->limit($page->firstRow.','.$page->listRows)->select();
		$merchant_info = $database_merchant->field(true)->where('mer_id = '.$this->merchant_session['mer_id'].'')->select();
		$category_info = $database_category->field(true)->where($condition_appoint)->select();
		$appoint_list = $this->formatArray($appoint_info, $merchant_info, $category_info);
		$this->assign('appoint_list', $appoint_list);
		$pagebar = $page->show();
		$this->assign('pagebar', $pagebar);
		
		$this->display();
	}
	
	/* 添加服务  */
	public function add(){
		$database_store = D('Merchant_store');
		$database_category = D('Appoint_category');
		$condition_appoint['mer_id'] = $this->merchant_session['mer_id'];
		$store_list = $database_store->field(true)->where($condition_appoint)->select();
		if(empty($store_list)){
			$this->error('现在还没有店铺，去添加吧。');
		}
		$condition_group_category['cat_status'] = 1;
		$condition_group_category['cat_fid'] = 0;
		$f_category_list = $database_category->field(true)->where($condition_group_category)->select();
		$this->assign('store_list' ,$store_list);
		$this->assign('f_category_list', $f_category_list);
		
		if(IS_POST){
			$_PostData['appoint_name'] = trim($_POST['appoint_name']);
			$_PostData['appoint_content'] = trim($_POST['appoint_content']);
			if(empty($_PostData['appoint_name'])) {
                $this->error('请填写预约名称');
            }
			if(empty($_PostData['appoint_content'])) {
                $this->error('请填写预约简介');
            }
            if($_POST['payment_status'] == 1)
            {
	            if (empty($_POST['payment_money']) || $_POST['payment_money'] <= '0.00') {
	                $this->error('请填写定金');
	            }
            }
			if(empty($_POST['appoint_price'])) {
                $this->error('请填写全价金额');
            }
            if(empty($_POST['store_id'])){
            	 $this->error('请至少选择一家店铺');
            }
			if(empty($_POST['appoint_pic_content'])) {
                $this->error('请填写服务详情');
            }
			if(empty($_POST['pic'])) {
                $this->error('请至少上传一张照片');
            }
            if($_POST['time_gap']%10 != 0){
            	$this->error('间隔时间必须是10的倍数');
            } 
            if($_POST['payment_money'] >= $_POST['appoint_price']){
            	$this->error('定金数额不能大于全价');
            }
            $times = mktime(0,0,0,date('m'),date('d'),date('Y'));
            if(strtotime($_POST['start_time']) < $times){
            	$this->error('开始时间不能小于当前时间');
            }
            if(strtotime($_POST['end_time']) <= $times){
            	$this->error('结束时间不能小于或等于当前时间');
            }
            if($_POST['cat_id']==null || $_POST['cat_fid']==null){
            	$this->error('分类不能为空');
            }
            
            $database_appoint = D('Appoint');
            //自定义分类
            $custom_fields = array();
            foreach($_POST['custom_name'] as $key=>$val){
            	$custom_fields[$key]['name'] = $val;
            }
            foreach($_POST['custom_price'] as $key=>$val){
            	$custom_fields[$key]['price'] = $val;
            }
			foreach($_POST['custom_content'] as $key=>$val){
            	$custom_fields[$key]['content'] = $val;
            }
            
			//营业时间
			$office_time = array();
			if($_POST['office_start_time'] != '00:00' || $_POST['office_stop_time'] != '00:00'){
				array_push($office_time,array('open'=>$_POST['office_start_time'],'close'=>$_POST['office_stop_time']));
			} else {
				array_push($office_time,array('open'=>'00:00','close'=>'00:00'));
			}
			if($_POST['office_start_time2'] != '00:00' || $_POST['office_stop_time2'] != '00:00'){
				array_push($office_time,array('open'=>$_POST['office_start_time2'],'close'=>$_POST['office_stop_time2']));
			} else {
				array_push($office_time,array('open'=>'00:00','close'=>'00:00'));
			}
			if($_POST['office_start_time3'] != '00:00' || $_POST['office_stop_time3'] != '00:00'){
				array_push($office_time,array('open'=>$_POST['office_start_time3'],'close'=>$_POST['office_stop_time3']));
			} else {
				array_push($office_time,array('open'=>'00:00','close'=>'00:00'));
			}
			$_POST['office_time'] = serialize($office_time);
            $_POST['mer_id'] = $this->merchant_session['mer_id'];
            $_POST['start_time'] = strtotime($_POST['start_time']);
            $_POST['end_time'] = strtotime($_POST['end_time']);
            $_POST['create_time'] = time();
            $_POST['pic'] = implode(';', $_POST['pic']);
            $_POST['appoint_pic_content'] = fulltext_filter($_POST['appoint_pic_content']);
            $config_condition['name'] = 'appoint_verify';
            $appoint_verify = D('Config')->field('`value`')->where($config_condition)->find();
            if($appoint_verify['value'] == '1'){
            	$_POST['check_status'] = '0';
            } else {
            	$_POST['check_status'] = '1';
            	$_POST['appoint_status'] = '0';
            }
            if($appoint_id = $database_appoint->data($_POST)->add()){
            	foreach($custom_fields as $key=>$val){
            		if(!empty($custom_fields[$key]['name'])){
            			$custom_fields[$key]['mer_id'] =  $this->merchant_session['mer_id'];
            			$custom_fields[$key]['appoint_id'] =  $appoint_id;
            			$custom_fields[$key]['cat_id'] =  $_POST['cat_id'];
            			D('Appoint_product')->data($custom_fields[$key])->add();
            		}
            	}
	            //店铺信息
				foreach($_POST['store_id'] as $key => $val){
					$condition_merchant_store['appoint_id'] = $appoint_id;
					$condition_merchant_store['store_id'] = $val;
					$tmp_appoint_store = $database_store->field('`store_id`,`province_id`,`city_id`,`area_id`,`circle_id`')->where($condition_merchant_store)->find();
					if (!empty($tmp_appoint_store)) {
						$tmp_appoint_store['appoint_id'] = $appoint_id;
	                    $data_appoint_store_arr = $tmp_appoint_store;
	                }
	                $database_appoint_store = D('Appoint_store');
	                if(!$database_appoint_store->data($data_appoint_store_arr)->add()){
	                	$this->error('关系添加失败！请重试。');
	                }
				}
				$this->success('添加成功！');
            } else {
            	$this->error('添加失败！请重试。');
            }
		}
		$this->display();
	}
	
	public function frame_edit(){
		if (empty($_SESSION['system'])) {
            $this->error('非法修改');
        }
        
        $database_store = D('Merchant_store');
		$database_category = D('Appoint_category');
       	$database_appoint = D('Appoint');
        $condition_appoint['appoint_id'] = $_GET['appoint_id'];
        $condition_appoint['mer_id'] = $this->merchant_session['mer_id'];
        
        $appoint_info = $database_appoint->field(true)->where($condition_appoint)->order('`appoint_id` DESC')->select();
		$merchant_info = $database_store->field(true)->where('mer_id = '.$this->merchant_session['mer_id'].'')->select();
		$category_info = $database_category->field(true)->where('mer_id = '.$this->merchant_session['mer_id'].'')->select();
		$appoint_list = $this->formatArray($appoint_info, $merchant_info, $category_info);
		$appoint_list = $appoint_list[0];
		$this->assign('appoint_list', $appoint_list);
        
        $office_time = unserialize($appoint_list['office_time']);
        $office_time_1 = $office_time['0'];
        $office_time_2 = $office_time['1'];
        $office_time_3 = $office_time['2'];
        $this->assign('office_time_1', $office_time_1);
		$this->assign('office_time_2', $office_time_2);
		$this->assign('office_time_3', $office_time_3);
        
		$store_list = $database_store->field(true)->where($condition_appoint)->select();
		$appoint_store = D('Appoint_store')->field(true)->where('appoint_id = '.$condition_appoint['appoint_id'].'')->select();
		$store_arr = array();
        foreach ($appoint_store as $value) {
        	$store_arr[] = $value['store_id'];
        }
        $this->assign('store_arr', $store_arr);
		if(empty($store_list)){
			$this->error('现在还没有店铺，去添加吧。');
		}
		
        $condition_group_category['cat_status'] = 1;
		$condition_group_category['cat_fid'] = 0;
		$f_category_list = $database_category->field(true)->where($condition_group_category)->select();
		$s_category_list = $database_category->field(true)->where('cat_fid ='.$appoint_list['cat_fid'].'')->select();
		$product_list = D('Appoint_product')->field(true)->where('appoint_id ='.$appoint_list['appoint_id'].'')->select();
		
		$appoint_image_class = new appoint_image();
		$tmp_pic_arr = explode(';', $appoint_list['pic']);
	 	foreach ($tmp_pic_arr as $key => $value) {
        	$pic_list[$key]['title'] = $value;
            $pic_list[$key]['url'] = $appoint_image_class->get_image_by_path($value, 's');
        }
        $this->assign('store_list' ,$store_list);
		$this->assign('appoint_store', $appoint_store);
		$this->assign('f_category_list', $f_category_list);
        $this->assign('s_category_list', $s_category_list);
        $this->assign('product_list', $product_list);
        $this->assign('pic_list', $pic_list);
        
        if(IS_POST){
        	$_PostData = array();
        	$_PostData['appoint_name'] = trim($_POST['appoint_name']);
        	$_PostData['appoint_content'] = trim($_POST['appoint_content']);
        	if(empty($_PostData['appoint_name'])) {
                $this->error('请填写预约名称');
            }
			if(empty($_PostData['appoint_content'])) {
                $this->error('请填写预约简介');
            }
            if($_POST['payment_status'] == 1)
            {
	            if (empty($_POST['payment_money']) || $_POST['payment_money'] <= '0.00') {
	                $this->error('请填写定金');
	            }
            }
			if(empty($_POST['appoint_price'])) {
                $this->error('请填写全价金额');
            }
            if(empty($_POST['store'])){
            	 $this->error('请至少选择一家店铺');
            }
			if(empty($_POST['appoint_pic_content'])) {
                $this->error('请填写服务详情');
            }
			if(empty($_POST['pic'])) {
                $this->error('请至少上传一张照片');
            }
            if($_POST['time_gap']%10 != 0){
            	$this->error('间隔时间必须是10的倍数');
            } 
            if($_POST['payment_money'] >= $_POST['appoint_price']){
            	$this->error('定金数额不能大于全价');
            }
            if($_POST['cat_id']==null || $_POST['cat_fid']==null){
            	$this->error('分类不能为空');
            }
            
        	//营业时间
			$office_time = array();
			if($_POST['office_start_time'] != '00:00' || $_POST['office_stop_time'] != '00:00'){
				array_push($office_time,array('open'=>$_POST['office_start_time'],'close'=>$_POST['office_stop_time']));
			} else {
				array_push($office_time,array('open'=>'00:00','close'=>'00:00'));
			}
			if($_POST['office_start_time2'] != '00:00' || $_POST['office_stop_time2'] != '00:00'){
				array_push($office_time,array('open'=>$_POST['office_start_time2'],'close'=>$_POST['office_stop_time2']));
			} else {
				array_push($office_time,array('open'=>'00:00','close'=>'00:00'));
			}
			if($_POST['office_start_time3'] != '00:00' || $_POST['office_stop_time3'] != '00:00'){
				array_push($office_time,array('open'=>$_POST['office_start_time3'],'close'=>$_POST['office_stop_time3']));
			} else {
				array_push($office_time,array('open'=>'00:00','close'=>'00:00'));
			}
			
			//数据整合
			$_PostData['appoint_name'] = $_POST['appoint_name'];
			$_PostData['mer_id'] = $this->merchant_session['mer_id'];
			$_PostData['start_time'] = strtotime($_POST['start_time']);
			$_PostData['end_time'] = strtotime($_POST['end_time']);
			$_PostData['create_time'] = time();
			$_PostData['cat_fid'] = $_POST['cat_fid'];
			$_PostData['cat_id'] = $_POST['cat_id'];
			$_PostData['appoint_pic_content'] = fulltext_filter($_POST['appoint_pic_content']);
			$_PostData['payment_status'] = $_POST['payment_status'];
			$_PostData['payment_money'] = $_POST['payment_money'];
            $_PostData['appoint_status'] = $_POST['appoint_status'];
            if($_POST['appoint_status'] == 0 && $appoint_list['check_status'] == 0){
            	$_PostData['check_status'] = 1;
            }
            $_PostData['appoint_content'] = $_POST['appoint_content'];
            $_PostData['pic'] = implode(';', $_POST['pic']);
            $_PostData['appoint_price'] = $_POST['appoint_price'];
            $_PostData['appoint_type'] = $_POST['appoint_type'];
			$_PostData['appoint_type'] = $_POST['appoint_type'];
			$_PostData['office_time'] = serialize($office_time);
			$_PostData['appoint_people'] = $_POST['appoint_people'];
			$_PostData['time_gap'] = $_POST['time_gap'];
			$_PostData['before_time'] = $_POST['before_time'];
            
        	//自定义服务修改
            $custom_fields_s = array();
            foreach($_POST['custom_name_s'] as $key=>$val){
            	$custom_fields_s[$key]['name'] = $val;
            }
            foreach($_POST['custom_price_s'] as $key=>$val){
            	$custom_fields_s[$key]['price'] = floatval($val);
            }
			foreach($_POST['custom_content_s'] as $key=>$val){
            	$custom_fields_s[$key]['content'] = $val;
            }
        	foreach($_POST['custom_id_s'] as $key=>$val){
            	$custom_fields_s[$key]['id'] = $val;
            }
			
        	//自定义服务添加
            $custom_fields = array();
            foreach($_POST['custom_name'] as $key=>$val){
            	$custom_fields[$key]['name'] = $val;
            }
            foreach($_POST['custom_price'] as $key=>$val){
            	$custom_fields[$key]['price'] = $val;
            }
			foreach($_POST['custom_content'] as $key=>$val){
            	$custom_fields[$key]['content'] = $val;
            }
            
			if($database_appoint->where($condition_appoint)->data($_PostData)->save()){
	        	foreach($custom_fields_s as $key=>$val){
					if(!empty($val['name'])){
						$custom_fields_s[$key]['mer_id'] = $this->merchant_session['mer_id'];
						$custom_fields_s[$key]['appoint_id'] = $condition_appoint['appoint_id'];
						$custom_fields_s[$key]['cat_id'] = $_POST['cat_id'];
						D('Appoint_product')->data($custom_fields_s[$key])->where('id ='.$custom_fields_s[$key]['id'])->save();
					}else{
						D('Appoint_product')->where('id ='.$custom_fields_s[$key]['id'])->delete();
					}
	            }
				foreach($custom_fields as $key=>$val){
            		if(!empty($custom_fields[$key]['name'])){
            			$custom_fields[$key]['mer_id'] =  $this->merchant_session['mer_id'];
            			$custom_fields[$key]['appoint_id'] =  $condition_appoint['appoint_id'];
            			$custom_fields[$key]['cat_id'] =  $_POST['cat_id'];
            			D('Appoint_product')->data($custom_fields[$key])->add();
            		}
            	}
			
	            $appoint_store_id = array();
	            foreach($appoint_store as $key=>$val){
	            	$appoint_store_id[$key] = $val['store_id'];
	            }
	            $store_id_arr = array_diff($appoint_store_id, $_POST['store']);
            	if(!empty($store_id_arr)){
            		foreach($store_id_arr as $val){
            			$condition_appoint_store['appoint_id'] = $condition_appoint['appoint_id'];
            			$condition_appoint_store['store_id'] = $val;
            			D('Appoint_store')->where($condition_appoint_store)->delete();
            		}
            	} else {
            		foreach($_POST['store'] as $val){
            			$condition_appoint_store['appoint_id'] = $condition_appoint['appoint_id'];
            			$condition_appoint_store['store_id'] = $val;
            			$store_info = D('Appoint_store')->field(true)->where($condition_appoint_store)->find();
            			$tmp_appoint_store = $database_store->field('`store_id`,`province_id`,`city_id`,`area_id`,`circle_id`')->where($condition_appoint_store)->find();
            			if(empty($store_info)){
            				$tmp_appoint_store['appoint_id'] = $condition_appoint['appoint_id'];
            				$data_appoint_store_arr = $tmp_appoint_store;
		            		D('Appoint_store')->data($data_appoint_store_arr)->add();
            			}
            		}
            	}
            	$this->success('编辑成功！');
			} else {
            	$this->error('编辑失败！请重试。');
            }
        }
        $this->display();
	}
	
	/* 二级分类 */
	public function ajax_get_category(){
		$database_Appoint_category = D('Appoint_category');
        $condition_now_Appoint_category['cat_id'] = $_GET['cat_fid'];
        $condition_now_Appoint_category['cat_status'] = 1;
        $now_category = $database_Appoint_category->field(true)->where($condition_now_Appoint_category)->find();
        if (empty($now_category)) {
            $return['error'] = 1;
            $return['msg'] = '该分类不存在！';
        } else {
            $condition_s_Appoint_category['cat_fid'] = $_GET['cat_fid'];
            $condition_s_Appoint_category['cat_status'] = 1;
            $s_category_list = $database_Appoint_category->field(true)->where($condition_s_Appoint_category)->order('`cat_sort` DESC,`cat_id` ASC')->select();
            if (empty($s_category_list)) {
                $return['error'] = 1;
                $return['msg'] = '该分类下没有添加子分类！请勿选择。';
            } else {
            	$return['error'] = 0;
				$return['cat_list'] = $s_category_list;
            }
        }
        exit(json_encode($return));
	}
	
	/* 上传图片 */
	public function ajax_upload_pic(){
		if ($_FILES['imgFile']['error'] != 4) {
            $img_mer_id = sprintf("%09d", $this->merchant_session['mer_id']);
            $rand_num = mt_rand(10, 99) . '/' . substr($img_mer_id, 0, 3) . '/' . substr($img_mer_id, 3, 3) . '/' . substr($img_mer_id, 6, 3);

            $upload_dir = './upload/appoint/' . $rand_num . '/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            import('ORG.Net.UploadFile');
            $upload = new UploadFile();
            $upload->maxSize = $this->config['group_pic_size'] * 1024 * 1024;
            $upload->allowExts = array('jpg', 'jpeg', 'png', 'gif');
            $upload->allowTypes = array('image/png', 'image/jpg', 'image/jpeg', 'image/gif');
            $upload->savePath = $upload_dir;
            $upload->thumb = true;
            $upload->imageClassPath = 'ORG.Util.Image';
            $upload->thumbPrefix = 'm_,s_';
            $upload->thumbMaxWidth = $this->config['group_pic_width'];
            $upload->thumbMaxHeight = $this->config['group_pic_height'];
            $upload->thumbRemoveOrigin = false;
            $upload->saveRule = 'uniqid';
            if ($upload->upload()) {
                $uploadList = $upload->getUploadFileInfo();

                $title = $rand_num . ',' . $uploadList[0]['savename'];

                $appoint_image_class = new appoint_image();
                $url = $appoint_image_class->get_image_by_path($title, 's');

                exit(json_encode(array('error' => 0, 'url' => $url, 'title' => $title)));
            } else {
                exit(json_encode(array('error' => 1, 'message' => $upload->getErrorMsg())));
            }
        } else {
            exit(json_encode(array('error' => 1, 'message' => '没有选择图片')));
        }
	}
	
	/* 删除图片  */
	public function ajax_del_pic() {
        $group_image_class = new appoint_image();
        $group_image_class->del_image_by_path($_POST['path']);
    }
	
    /* 订单列表  */
    public function order_list(){
    	$database_order = D('Appoint_order');
    	$database_user = D('User');
    	$database_appoint = D('Appoint');
    	$database_store = D('Merchant_store');
    	$where['appoint_id'] = intval($_GET['appoint_id']);
    	$order_count = $database_order->where($where)->count();
    	
    	import('@.ORG.merchant_page');
    	$page = new Page($order_count, 20);
    	$order_info = $database_order->field(true)->where($where)->order('`order_id` DESC')->limit($page->firstRow.','.$page->listRows)->select();
    	$user_info = $database_user->field('`uid`, `phone`, `nickname`')->select();
    	$appoint_info = $database_appoint->field('`appoint_id`, `appoint_name`, `appoint_type`')->select();
    	$store_info = $database_store->field('`store_id`, `name`, `adress`')->select();
    	$order_list = $this->formatOrderArray($order_info, $user_info, $appoint_info, $store_info);
    	$now_group = $database_appoint->field('`appoint_name`')->where($where)->find();
    	
    	$pagebar = $page->show();
    	$this->assign('now_group', $now_group);
    	$this->assign('pagebar', $pagebar);
    	$this->assign('order_list', $order_list);
    	$this->display();
    }
    
    /* 订单详情  */
    public function order_detail(){
    	$database_order = D('Appoint_order');
    	$database_user = D('User');
    	$database_appoint = D('Appoint');
    	$database_store = D('Merchant_store');
    	$where['order_id'] = intval($_GET['order_id']);
    	$where['mer_id'] = $this->merchant_session['mer_id'];
    	
    	$now_order = $database_order->field(true)->where($where)->find();
    	$where_user['uid'] = $now_order['uid'];
    	$user_info = $database_user->field('`uid`, `phone`, `nickname`')->where($where_user)->find();
    	$where_appoint['appoint_id'] = $now_order['appoint_id'];
    	$appoint_info = $database_appoint->field('`appoint_id`, `appoint_name`, `appoint_type`, `appoint_price`')->where($where_appoint)->find();
    	$where_store['store_id'] = $now_order['store_id'];
    	$store_info = $database_store->field('`store_id`, `name`, `adress`')->where($where_store)->find();
    	
    	$now_order['phone'] = $user_info['phone'];
    	$now_order['nickname'] = $user_info['nickname'];
    	$now_order['appoint_name'] = $appoint_info['appoint_name'];
    	$now_order['appoint_type'] = $appoint_info['appoint_type'];
    	$now_order['appoint_price'] = $appoint_info['appoint_price'];
    	$now_order['store_name'] = $store_info['name'];
    	$now_order['store_adress'] = $store_info['adress'];
    	
    	$cue_info = unserialize($now_order['cue_field']);
    	$cue_list = array();
    	foreach($cue_info as $key=>$val){
    		if(!empty($cue_info[$key]['value'])){
    			$cue_list[$key]['name'] = $val['name'];
    			$cue_list[$key]['value'] = $val['value'];
    			$cue_list[$key]['type'] = $val['type'];
    			if($cue_info[$key]['type'] == 2){
    				$cue_list[$key]['long'] = $val['long'];
    				$cue_list[$key]['lat'] = $val['lat'];
    				$cue_list[$key]['address'] = $val['address'];
    			}
    		}
    	}
    	$this->assign('cue_list', $cue_list);
    	
    	$this->assign('now_order', $now_order);
    	$this->display();
    }
    
    /* 格式化订单数据  */
    protected function formatOrderArray($order_info, $user_info, $appoint_info, $store_info){
    	if(!empty($user_info)){
    		$user_array = array();
    		foreach($user_info as $val){
    			$user_array[$val['uid']]['phone'] = $val['phone'];
    			$user_array[$val['uid']]['nickname'] = $val['nickname'];
    		}
    	}
    	if(!empty($appoint_info)){
    		$appoint_array = array();
    		foreach($appoint_info as $val){
    			$appoint_array[$val['appoint_id']]['appoint_name'] = $val['appoint_name'];
    			$appoint_array[$val['appoint_id']]['appoint_type'] = $val['appoint_type'];
    		}
    	}
    	if(!empty($store_info)){
    		$store_array = array();
    		foreach($store_info as $val){
    			$store_array[$val['store_id']]['store_name'] = $val['name'];
    			$store_array[$val['store_id']]['store_adress'] = $val['adress'];
    		}
    	}
    	if(!empty($order_info)){
    		foreach($order_info as &$val){
    			$val['phone'] = $user_array[$val['uid']]['phone'];
    			$val['nickname'] = $user_array[$val['uid']]['nickname'];
    			$val['appoint_name'] = $appoint_array[$val['appoint_id']]['appoint_name'];
    			$val['appoint_type'] = $appoint_array[$val['appoint_id']]['appoint_type'];
    			$val['store_name'] = $store_array[$val['store_id']]['store_name'];
    			$val['store_adress'] = $store_array[$val['store_id']]['store_adress'];
    		}
    	}
    	return $order_info;
    }
    
	/* 格式化数据 */
	protected function formatArray($appoint_info, $merchant_info, $category_info){
		if(!empty($merchant_info)){
			$merchant_array = array();
			foreach($merchant_info as $val ){
				$merchant_array[$val['mer_id']]['mer_name'] = $val['name'];
			}
		}
		if(!empty($category_info)){
			$category_array = array();
			foreach($category_info as $val){
				$category_array[$val['cat_id']]['category_name'] = $val['cat_name'];
			}
		}
		if(!empty($appoint_info)){
			foreach($appoint_info as &$val ){
				$val['mer_name'] = $merchant_array[$val['mer_id']]['mer_name'];
				$val['category_name'] = $category_array[$val['cat_id']]['category_name'];
			}
		}
		return $appoint_info;
	}
}