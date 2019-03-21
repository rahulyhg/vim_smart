<?php
/*
	 * 将一个三个后台需要执行的文件整合到一个文件中
	 * @author 祝君伟
	 * @time 2017.4.6
	 * */
class IndexAction extends Action
{
	/*
	 * 自动执行总方法
	 * @author 祝君伟
	 * @warning 该方法涉及多种定时功能，无法确认请不要轻易修改
	 * */
	public function index_bak(){
		//使用memcached
		$connect = new Memcached;  //声明一个新的memcached链接
		$connect->setOption(Memcached::OPT_COMPRESSION, false); //关闭压缩功能
		$connect->setOption(Memcached::OPT_BINARY_PROTOCOL, true); //使用binary二进制协议
		$connect->addServer('f120e580f9b74ec5.m.cnhzaliqshpub001.ocs.aliyuncs.com', 11211); //添加OCS实例地址及端口号
		//智能门禁开门系统配置
		$interval_time = M()->table('smart_config')->where(array('name'=>'interval_time'))->find();
		$interval_time = $interval_time['value'];
		if($connect->get('time_key')){					//修改对应设备开启时间
			$arr_key=unserialize($connect->get('time_key'));
			dump($arr_key);
			$new_arr=array();
			if(time()>=$arr_key['door_time']+$interval_time['value']){
				//智能门禁关门入口
				$this->auto_close_door();

				//同时更改时间
				$new_arr['door_time']=time();
				$new_arr['car_time']=$arr_key['car_time'];
				$new_arr['oa_time']=$arr_key['oa_time'];
				$connect->set('time_key',serialize($new_arr));	//修改
			}elseif (time()>=$arr_key['car_time']+3){
				//智能停车场交易金额监控入口
				$res = $this->auto_monitoring_deal();
				//同时更改时间
				$new_arr['door_time']=$arr_key['door_time'];
				$new_arr['oa_time']=$arr_key['oa_time'];
				$new_arr['car_time']=time();
				$connect->set('time_key',serialize($new_arr));	//修改
			}elseif (time()>=$arr_key['oa_time']+67){
				//OA系统查询
				$this->auto_check_oa_system();
				//自动续连开门
				$this->auto_notice_api_ok();
				//同时更改时间
				$new_arr['door_time']=$arr_key['door_time'];
				$new_arr['car_time']=$arr_key['car_time'];
				$new_arr['oa_time']=time();
				$connect->set('time_key',serialize($new_arr));	//修改
			}elseif (empty($arr_key['oa_time'])){
				//同时更改时间
				$new_arr['door_time']=$arr_key['door_time'];
				$new_arr['car_time']=$arr_key['car_time'];
				$new_arr['oa_time']=time();
				$connect->set('time_key',serialize($new_arr));	//修改
			}

		}else{
			$new_arr['door_time']=time();
			$new_arr['car_time']=time();
			$new_arr['oa_time']=time();
			$connect->set('time_key',serialize($new_arr));	//修改
		}
		//智能咖啡机制作入口
		$coffee_result = $this->auto_do_coffee();

	}

	/*
	 * 自动执行总方法
	 * @author 祝君伟
	 * @warning 该方法涉及多种定时功能，无法确认请不要轻易修改
	 * */
	public function index(){
		//使用memcached
		$connect = new Memcached;  //声明一个新的memcached链接
		$connect->setOption(Memcached::OPT_COMPRESSION, false); //关闭压缩功能
		$connect->setOption(Memcached::OPT_BINARY_PROTOCOL, true); //使用binary二进制协议
		$connect->addServer('f120e580f9b74ec5.m.cnhzaliqshpub001.ocs.aliyuncs.com', 11211); //添加OCS实例地址及端口号

        //群发消息
       /*if($group_msg = unserialize($connect->get('group_msg'))){
         $model=new GroupMsgModel();
           foreach($group_msg as $key=>$msg){
               if(time()>=$msg['send_time']){
                    unset($group_msg[$key]);
                    //及时更新，发送需要时间，避免重复发送
                    $connect->set('group_msg',serialize($group_msg));
                    //群发消息
                    $model->send_group_msg_act($msg['msg_id']);
               }
           }
       }*/
        $group_msg=M('wxmsg')->where(array('is_complete'=>0,'status'=>1))->select();
        if(!empty($group_msg)){
            $model=new GroupMsgModel();
            foreach($group_msg as $key=>$msg){
                if(time()>=$msg['send_time']){
                    //及时更新，发送需要时间，避免重复发送
                    M('wxmsg')->where('id='.$msg['id'])->data(array('is_complete'=>1))->save();
                    //群发消息
                    $model->send_group_msg_act($msg['id']);
                }
            }
        }
        //远洋会 自动任务执行
        $so_auto=M('config')->where(array('name'=>'so_auto'))->find();
        if($so_auto['value']<(time()-10*60)){
            M('config')->where(array('name'=>'so_auto'))->data(array('value'=>time()))->save();
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://so.vhi99.com/index.php?m=Home&c=Auto&a=overtime_repair_send");
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 1);
            curl_exec($ch);
            curl_close($ch);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://so.vhi99.com/index.php?m=Home&c=Auto&a=update_user_info");
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 1);
            curl_exec($ch);
            curl_close($ch);
        }
        //自动更新access_token by zhukeqin
        $access_token=new Access_token_expiresModel();
        $list=$access_token->get_access_token();
        //M('wxmsg_log_copy')->data(array('suser'=>json_encode($list)))->add();
        //自动更新短信详情 zhukeqin
        $model_sms = new PackageModel();
        $model_sms->sms_update();

        //巡更报表 自动任务执行        
        $msg = new System_msgModel();
    	$msg->timing_send_record_chart();      

       //更新设备止码，已将未来12个月的更新日期加入队列
        $update_meter_date = unserialize($connect->get('update_meter_date'));
        $current_date = date("Y-m-d");
        if(in_array($current_date,$update_meter_date)){
            array_shift($update_meter_date);//出列
            $push_date = date(
                'Y-m-d',
                strtotime(date('Y-m-01', strtotime($current_date)) . ' +1 year')
            );
            array_push($update_meter_date,$push_date);//入列
            $connect->set('update_meter_date',serialize($update_meter_date));
            $model = new RoomModel();
            $model->update_consume();

            $last_ym = $this->getLastYm($current_date);
            $model->set_account_list_log($last_ym);
        }

        //定时更新用户表
        $update_info_time = unserialize($connect->get('update_info_time'))?:0;
        if (time()-$update_info_time > 7*24*3600) {
            $update_info_count = unserialize($connect->get('update_info_count'));//获取更新剩余个数
            if (!$update_info_count && $update_info_count !== 0) {
                $update_info_count = -1;
            }
            if ($update_info_count) {
                $update_info_count = $this->update_info_time();
                $connect->set('update_info_count',serialize($update_info_count));
            } else {
                $connect->set('update_info_count',serialize(-1));//重置更新时间
                $connect->set('update_info_time',serialize(time()));//重置更新时间
            }

        }

        //合同到期提醒
//        $this->send_contract_msg();

		//智能门禁开门系统配置
//		$interval_time = M()->table('smart_config')->where(array('name'=>'interval_time'))->find();
//		$interval_time = $interval_time['value'];
//		if($connect->get('time_key')){					//修改对应设备开启时间
//			$arr_key=unserialize($connect->get('time_key'));
//			//dump($arr_key);
//			$new_arr=array();
//			if(time()>=$arr_key['door_time']+$interval_time['value']){
//				//智能门禁关门入口
//				$this->auto_close_door();
//
//				//同时更改时间
//				$new_arr['door_time']=time();
//				$new_arr['car_time']=$arr_key['car_time'];
//				$new_arr['oa_time']=$arr_key['oa_time'];
//				$connect->set('time_key',serialize($new_arr));	//修改
//			}
//			if (time()>=$arr_key['car_time']+3){
//				//智能停车场交易金额监控入口
//				$res = $this->auto_monitoring_deal();
//				//同时更改时间
//				$new_arr['door_time']=$arr_key['door_time'];
//				$new_arr['oa_time']=$arr_key['oa_time'];
//				$new_arr['car_time']=time();
//				$connect->set('time_key',serialize($new_arr));	//修改
//			}
//			if (time()>=$arr_key['oa_time']+67){
//				//OA系统查询
//				$this->auto_check_oa_system();
//				//自动续连开门
//				$this->auto_notice_api_ok();
//				//同时更改时间
//				$new_arr['door_time']=$arr_key['door_time'];
//				$new_arr['car_time']=$arr_key['car_time'];
//				$new_arr['oa_time']=time();
//				$connect->set('time_key',serialize($new_arr));	//修改
//			}
//
//
//
//		}else{
//
//			$new_arr['door_time']=time();
//			$new_arr['car_time']=time();
//			$new_arr['oa_time']=time();
//			$connect->set('time_key',serialize($new_arr));	//修改
//		}


		//智能咖啡机制作入口
		$coffee_result = $this->auto_do_coffee();



	}


    /*
    * 定时更新用户表
    * 2018.4.2
    */
    public function update_info_time(){
        $wechat = new WechatModel();
        $access_token = $wechat->access_token;
        $arr=M('user')->where('%d-update_time>24*60*60 and uid>110' ,time())->order('uid asc')->limit(10)->select();//用户表
        if($arr){
            foreach ($arr as $v){
                $openid=$v['openid'];
                $url2="https://api.weixin.qq.com/cgi-bin/user/info?access_token=" . $access_token.'&openid='.$openid.'&lang=zh_CN';//获取用户基本信息url
                $result = $this->wxHttpsRequest($url2);

                if(!$result['errcode']){
                    //干掉emoji表情 by zhukeqin
                    $after_name=D('User')->checkout_emoji($result['nickname']);
                    if($result['subscribe']==1){//关注了公众号
                        $data=array('nickname'=>$after_name,'city'=>$result['city'],'province'=>$result['province'],'avatar'=>$result['headimgurl'],'update_time'=>time(),'unionid'=>$result['unionid']);//增加unionid更新
                        $update=M('user')->where(array('openid'=>$openid))->save($data);

                    }else{//未关注的
                        $data=array('update_time'=>time());
                        $update=M('user')->where(array('openid'=>$openid))->save($data);
                    }
                } elseif($result['errcode'] == 42001 || $result['errcode'] == 40001) { //$access_token过期
                    $wechat = new WechatModel();
                    $wechat->resetAuth();
                    $access_token = $wechat->access_token;
                    //添加到log日志里
                    $create_time = date('Y-m-d H:i:s',time());
                    $logData = array('openid'=>$openid,'errcode'=>$result['errcode'],'errmsg'=>$result['errmsg'],'create_time'=>$create_time,'type'=>2);
                    M('wxmsg_log')->add($logData);
                } else {
                    $data=array('update_time'=>time());
                    $update=M('user')->where(array('openid'=>$openid))->save($data);

                }
            }
        }
        $count=M('user')->where('%d-update_time>24*60*60 and uid>110' ,time())->order('uid asc')->count();//还需更新数量
        return intval($count);
    }


    //供更新用户表专用
    public function wxHttpsRequest($url, $data = null) {
        $curl = curl_init();
        //curl_setopt($curl, CURLOPT_SAFE_UPLOAD, FALSE); //针对php5.6版本
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        $errorno = curl_errno($curl);
        curl_close($curl);
        if ($errorno) {
            return array('curl' => false, 'errorno' => $errorno);
        } else {
            $res = json_decode($output, 1);
            if ($res['errcode']) {
                return array('errcode' => $res['errcode'], 'errmsg' => $res['errmsg']);
            } else {
                return $res;
            }
        }
    }


	public function show_now(){
		//适应020系统的代码段开始
		$database_system_menu = D('System_menu');
		$condition_system_menu['status'] = 1;
		$condition_system_menu['show'] = 1;
		$menu_list = $database_system_menu->field(true)->where($condition_system_menu)->order('`sort` DESC,`fid` ASC,`id` ASC')->select();
		$warning_count = M('system_warning_control')->where(array('is_deal'=>0))->count();
		$check_count = M('system_warning_control')->where(array('is_check'=>0))->count();
		$warning_array = M('system_warning_control')->where(array('is_deal'=>0))->order('create_time desc')->select();
		$deal_array = M('system_warning_control')->where(array('is_deal'=>0,'is_check'=>1))->count();
		$arr=array();
		foreach ($menu_list as $k=>&$v){
			if($v['id']==6){
				$v['url']='http://www.hdhsmart.com/admin.php?g=System&c='.$v['module'].'&a='.$v['action'];
			}else{
				$v['url']='http://www.hdhsmart.com/admin.php?g=System&c='.$v['module'].'&a='.$v['action'];
			}
			if($v['fid']==0){
				$arr[$v['id']]=$v;
			}else{
				$arr[$v['fid']]['child_list'][]=$v;
			}
		}
		unset($v);
		$this->assign('arr',$arr);
		$this->assign('check_count',$check_count);
		$this->assign('warning_count',$warning_count);
		$this->assign('warning_array',$warning_array);
		$this->assign('deal_array',$deal_array);
		//适应020系统的代码段结束
		//计划配置显示
		//交易异常参数
		$car_warning_wait = M()->table('smart_config')->where(array('name'=>'wait_time'))->find();
		$car_warning_start = M()->table('smart_config')->where(array('name'=>'warning_start'))->find();
		$car_warning_end = M()->table('smart_config')->where(array('name'=>'warning_end'))->find();
		$car_warning = array(
			'wait_time'=>$car_warning_wait['value'],
			'warning_start'=>$car_warning_start['value'],
			'warning_end'=>$car_warning_end['value']
		);
		//交易异常的控制
		//查询判断条件：如果在库里面有一条一样的异常情况未处理的话，就将停止。
		$is_not_deal = M('system_warning_control')->where(array('system_id'=>5,'is_deal'=>0))->count();
		$is_work = M()->table('smart_config')->where(array('name'=>'is_work'))->find();
		$interval_time = M()->table('smart_config')->where(array('name'=>'interval_time'))->find();
		$is_work = $is_work['value'];

		$this->assign('car_warning',$car_warning);
		$this->assign('interval_time',$interval_time['value']);
		$this->assign('is_not_deal',$is_not_deal);
		$this->assign('is_work',$is_work);
		$this->display();

	}
	/*
	 * 保存配置ajax
	 * */
	public function ajax_to_config(){

		foreach ($_POST as $key => $value){
			$res_code = M()->table('smart_config')->where(array('name'=>$key))->data(array('value'=>$value))->save();
			if($res_code===false){
				echo 1;
				exit;
			}
		}
		echo 2;
	}

	/*
	 * ajax开始检索
	 * */
	public function ajax_to_work(){
		//激活马上就改变
		$state = I('post.is_work');
		$result_code = M()->table('smart_config')->where(array('name'=>'is_work'))->data(array('value'=>$state))->save();
		if($result_code){
			echo 1;
		}else{
			echo 2;
		}
	}

	/*
	 * 智能停车场交易金额监控
	 * */
	protected function auto_monitoring_deal(){
		
		$wait_array = M()->table('smart_config')->where(array('name'=>'wait_time'))->find();
		$start_array = M()->table('smart_config')->where(array('name'=>'warning_start'))->find();
		$end_array = M()->table('smart_config')->where(array('name'=>'warning_end'))->find();
		$is_end_work = M()->table('pigcms_system_warning_control')->where(array('system_id'=>5,'is_deal'=>0))->count();
		$is_work = M()->table('smart_config')->where(array('name'=>'is_work'))->find();
		if($is_end_work == 0 && $is_work['value'] == 1){
			//只有当前面没有任何未处理信息才进行轮询
			//工作日时间最近n小时内无人使用停车系统

			if( date('w',time())==0 ||  date('w',time())==6) {
				//周末内容
				$result_array = array('error'=>1,'msg'=>'非工作日');

			}else if(strtotime($start_array['value'])<time()&&time()<strtotime($end_array['value'])){
				$show_time = time()-$wait_array['value']*3600;
				//工作日内容
				$payrecord_count = M()->table('smart_payrecord')->where(array('pay_status'=>'1','pay_time'=>array('gt',$show_time)))->count();
				if($payrecord_count==0){
					//异常
					//$this->warning_data_add('index',CONTROLLER_NAME,'3001','设置时间内没有一笔订单','交易异常，检查是否程序有错误');
					import('@.ORG.WarnMessage');
					$message = new WarnMessage('index','Warning','1031','设置时间内没有一笔订单','交易异常，检查是否程序有错误');
					$message->get_data_pdo();
					$result_array = array('error'=>1,'msg'=>'交易异常');
				}else{
					$result_array = array('error'=>0,'msg'=>'正在监听，运转正常');
				}

			}else{
				$result_array = array('error'=>1,'msg'=>'设置时间已过，结束日程安排！');

			}

		}else{
			$result_array = array('error'=>1,'msg'=>'您的监控计划没有开启');
		}
		return $result_array;
	}
	
	/*
	 * 智能门禁通知关门入口
	 * */
	protected function auto_close_door(){
		//查询缓5秒执行
		//sleep(5);
		import('@.ORG.Yeelink');
		//--Memcache begin
		$connect = new Memcached;  //声明一个新的memcached链接
		$connect->setOption(Memcached::OPT_COMPRESSION, false); //关闭压缩功能
		$connect->setOption(Memcached::OPT_BINARY_PROTOCOL, true); //使用binary二进制协议
		$connect->addServer('f120e580f9b74ec5.m.cnhzaliqshpub001.ocs.aliyuncs.com', 11211); //添加OCS实例地址及端口号
		//--Memcache end
		$arr_key=unserialize($connect->get("arr_key"));
		//print_r($arr_key);exit;

		if(is_array($arr_key)){
			foreach($arr_key as $key=>$val){
				$yeelink=new Yeelink($apikey=$val['apikey'],$deviceid=$val['nodeid'],'http://api.yeelink.net/v1.1/device/');
				if($yeelink->getStatus($sensorid=$val['sensorid'])==1){	//判断是否是开启状态
					//if(time()-$val['datetime']>1){
					$yeelink->yeelink($sensorid=$val['sensorid'],$status=0);	//触发开关关
					//sleep(2);
					//}
				}
			}
		}
	}


	/*
	 * 智能制作咖啡机入口
	 * 须调用内部接口
	 * */
	protected function auto_do_coffee(){
		//获取token，先行版写死，后期入库
		$token = md5('vhkj2015');
		$token_array = array('token'=>$token);
		//调用接口地址
		$url = 'coffee.vhi99.com/index.php?m=default&c=lineproduction&a=connector_coffee';
		//curl
		$ch = curl_init();
		// 设置超时
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		// 这里设置代理，如果有的话
		// curl_setopt($ch,CURLOPT_PROXY, '8.8.8.8');
		// curl_setopt($ch,CURLOPT_PROXYPORT, 8080);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		// 设置header
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		// 要求结果为字符串且输出到屏幕上
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		// post提交方式
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $token_array);
		// 运行curl
		$data = curl_exec($ch);
		return $data;
	}

	/*
	 * OA 的警告查询方法
	 * 默认两分钟访问这个方法
	 * */
	protected function auto_check_oa_system(){
		$is_end_work = M()->table('pigcms_system_warning_control')->where(array('system_id'=>11,'is_deal'=>0))->count();
		if($is_end_work == 0){
			$http_res = get_headers("http://oa.huidehang.cn");
			if($http_res[0] !='HTTP/1.1 200 OK'){
				//发送错误编码
				import('@.ORG.WarnMessage');
				$message = new WarnMessage('index','unity','1031','OA系统现在无法访问','OA异常，检查OA系统是否正常');
				$message->get_data_pdo();
			}
		}
	}

	/*
	 * 停车场抬杠失败自动通知
	 * 默认2分钟请求一次
	 * */
	public function auto_notice_api_ok(){
		$defeated_array = M()->table('pigcms_system_warning_control')->where(array('system_id'=>2,'is_deal'=>0))->select();
		if($defeated_array == null){
			exit();
		}else{
			//将所有的数组执行一次通知
			foreach ($defeated_array as $value){
				//实例化捷顺接口类
				import('@.ORG.Jieshun');
				$jieshun = new Jieshun();
				$notice_jieshun_result=$jieshun->notice_api_pay_ok($value['warning_info']);
				if($notice_jieshun_result['dataItems'][0]['attributes']['retCode']=='0'){
					//当发现返回值已经通知成功的时候，将这条警告信息处理掉
					M()->table('pigcms_system_warning_control')->where(array('pigcms_id'=>$value['pigcms_id']))->data(array('is_deal'=>1))->save();
				}
				//没有成功的不做任何处理，直接跳过，然后2分钟后自动再调用该方法，该方法会把没有成功的再调用一遍，直到成功
			}
		}

	}


	public function deal_error_car($car_no){
        //实例化捷顺接口类
        import('@.ORG.Jieshun');
        $jieshun = new Jieshun();
        $notice_jieshun_result=$jieshun->notice_api_pay_ok($car_no);
        vd($notice_jieshun_result);
    }

    //获取当月第一天
    function getCurMonthFirstDay($date) {
        return date('Y-m-01', strtotime($date));
    }
    //获取当月最后一天
    function getCurMonthLastDay($date) {
        return date('Y-m-d', strtotime(date('Y-m-01', strtotime($date)) . ' +1 month -1 day'));
    }

    //获取上个月的年月
    public function getLastYm($date){
        return date('Y-m', strtotime(date('Y-m', strtotime($date)) . ' -1 month '));
    }

    //合同到期提醒
    public function send_contract_msg(){
        $time = time()+30*24*3600;

        $re = D('house_village_shequ')->where(array('is_send'=>0))->where("unix_timestamp(contract_end) < $time")->find();
        //距离合同截止日期还有一个月就提醒该社区项目经理（更改后）
        $adminArr = D('admin')->where("FIND_IN_SET(68,role_id)")->where(array('village_id'=>$re['village_id']))->find();
        if ($adminArr) {
            $openid = $adminArr['openid'];
            //如果admin没有openid，则取user查
            if (!$openid) {
                $openid = D('user')->where(array('phone'=>$adminArr['phone']))->getField('openid');
            }
        }
        if ($openid) {
            $wechat = new WechatModel();
            $tpl_id = $wechat::TPLID_LCSPTX;;
            $url = '';
            $data = array(
                'first'=>array(
                    'value'=>'合同到期提醒',
                    'color'=>"#029700",
                ),
                'keyword1'=>array(
                    'value'=>'签订日期：'.$re['contract_start'],
                    'color'=>"#000000",
                ),
                'keyword2'=>array(
                    'value'=>'截止日期：'.$re['contract_end'],
                    'color'=>"#000000",
                ),
                'keyword3'=>array(
                    'value'=>$adminArr['realname'],
                    'color'=>"#000000",
                ),
                'keyword4'=>array(
                    'value'=>'当前时间：'.date('Y-m-d H:i:s',time()),
                    'color'=>"#000000",
                ),
                'remark'=>array(
                    'value'=>'请尽快重新拟定',
                    'color'=>"#000000",
                ),
            );
            $res = $wechat->send_tpl_message($openid, $tpl_id, $url, $data);
            if ($res['errcode'] == 0 && $res['errmsg'] == 'ok') {
                //发送消息成功后，把状态改成已发送
                D('house_village_shequ')->where(array('id'=>$re['id']))->save(array('is_send'=>1));
            }

        }

    }



}


