<?php

class System_msgModel extends Model
{

    /*
     *定时发送巡更模板消息
     *author: libin
     */
    public function timing_send_record_chart(){   
        //日报告消息推送
        $record_chart=M('config')->where(array('name'=>'record_chart'))->find();
        if($record_chart['value'] != strtotime(date('Y-m-d'))){
            $send_time = strtotime(date('Y-m-d').' 07:30:00');
            $now_time = strtotime(date('Y-m-d H:i:s'));
            if ($send_time < $now_time){
                $res =$this->send_record_msg_day();
                M('config')->where(array('name'=>'record_chart'))->data(array('value'=>strtotime(date('Y-m-d'))))->save();
            }
        }

        //周报告消息推送
        $record_chart_week=M('config')->where(array('name'=>'record_chart_week'))->find();
        $end_time = strtotime(date('Y-m-d', (time() - ((date('w') == 0 ? 7 : date('w')) - 1) * 24 * 3600)));
        if($record_chart_week['value'] != $end_time){
            $send_time = strtotime(date('Y-m-d', (time() - ((date('w') == 0 ? 7 : date('w')) - 1) * 24 * 3600)).' 07:30:00');
            $now_time = strtotime(date('Y-m-d H:i:s'));
            if ($send_time < $now_time){
                $res =$this->send_record_msg_week();
                M('config')->where(array('name'=>'record_chart_week'))->data(array('value'=>$end_time))->save();
            }
        }

        //月报告消息推送
        $record_chart_month=M('config')->where(array('name'=>'record_chart_month'))->find();
        if($record_chart_month['value'] != strtotime(date('Y-m-01'))){
            $send_time = strtotime(date('Y-m-01').' 07:30:00');
            $now_time = strtotime(date('Y-m-d H:i:s'));
            if ($send_time < $now_time){
                $res =$this->send_record_msg_month();
                M('config')->where(array('name'=>'record_chart_month'))->data(array('value'=>strtotime(date('Y-m-01'))))->save();
            }
        }             
    }

    public function get_send_time($openid){
        $village_id = D('admin')->where(array('openid'=>$openid))->getField('village_id');
        $times = M('house_village_shift')
            ->field(array("morning_time_to","middle_time_to","night_time_to"))
            ->where(array('village_id'=>$village_id))
            ->find();
        if (!$times) {
            $times = M('house_village_shift')
                ->field(array("morning_time_to","middle_time_to","night_time_to"))
                ->where(array('village_id'=>1))
                ->find();
        }                
        if ($times['night_time_to']) {
            $end_time = $times['night_time_to'];
        } elseif ($times['middle_time_to']) {
            $end_time = $times['middle_time_to'];
        } else {
            $end_time = $times['morning_time_to'];
        }
        $time = $end_time;
        echo $time;
    }


    /**
     * 巡更记录日报表推送消息模板
     */
    public function send_contract_msg_remind()
    {
        //微信类库
        $wechat = new WechatModel();

        //获取物业相关人员微信openid
        //相关角色
        $role_names = array(
            '97'=>"合同管理员",
        );
        $role_ids = array_keys($role_names);
        $map = array();
        // $map['role_id'] = array('in',$role_ids);
        $map['_string'] = "find_in_set($role_ids[0],role_id)";
        // $map['village_id'] = array('eq',4);
        $admins = M('admin')->where($map)->select();
        $resArr = array();
        foreach($admins as $admin){
            if($admin['openid']){
                // $openid = $admin['openid'];
                $openid = "ohgcf0lvS3Ht7vH5n9PXbr5AEKtU";
            }                      
        
            //巡更报告模板ID
            $tpl_id = "BeFjeCRSsRek2cnJy-cQvMdOxbjNdbd3LrYUbuWprs4";

            //获取当天巡更报告数据
            $info = $this->get_record_contract($openid);
            // var_dump($info);exit();
            foreach ($info as $k => $v) {
                $data = array(
                    "first"=>array(
                           "value"=>"您好，您有一份合同到期提醒。",
                           "color"=>"#173177"
                   ),
                   "keyword1"=>array(
                       "value"=>$v['village_name']."项目 合同管理",
                       "color"=>"#173177"
                   ),
                   "keyword2"=>array(
                       "value"=>'汇得行智慧助手',
                       "color"=>"#173177"
                   ),
                   "keyword3"=>array(
                       "value"=>date('Y-m-d H:i:s'),
                       "color"=>"#173177"
                   ),
                   "keyword4"=>array(
                       "value"=>"合同名称：".$v['contract_name'],
                       "color"=>"#173177"
                   ),
                   "keyword5"=>array(
                       "value"=>'到期提醒',
                       "color"=>"#173177"
                   ),
                   "remark"=>array(
                       "value"=>"查看报告",
                       "color"=>"#173177"
                   ),
                );
                $url = "http://www.hdhsmart.com/admin.php?&g=System&c=Contract&a=contract_news";
                $res = $wechat->send_tpl_message($openid, $tpl_id, $url, $data);
                // if($res[0]['errcode']==0){
                //     //TODO::与用户方逻辑无关，暂不提醒，应记录在日志系统当中
                //    // $this->error("推送消息失败");
                //     $this->success("推送消息成功！");
                // }
                $resArr[] = $res;
            }            
        }
        //对发送的报告返回信息进行判断，当全部推送完成时关闭发送
        //M('config')->where(array('name'=>'record_chart'))->data(array('value'=>strtotime(date('Y-m-d'))))->save();
        return $resArr;
    }


    /**
     * 获取合同管理推送消息数据
     */
    public function get_record_contract($openid){

        $village_id = D('admin')->where(array('openid'=>$openid))->getField('village_id');

        //查询所有合同到期时间
        $contract_array = D('house_village_shequ')->where(array('village_id'=>$village_id))->select();
        //发送消息有效时间
        $valid_time = array();
        //获取合同到期时间
        foreach ($contract_array as $k => $v) {
            $end_time = $v['contract_end'];
            $lose_time = $v['contract_end'].''.'24:00:00';
            $now_time = time();
            if ((strtotime($end_time) < $now_time) && ($now_time < strtotime($lose_time))) {
                $valid_time[] = $v['contract_end'];
            }
        }
        //获取发送消息的合同
        foreach ($valid_time as $ke => $val) {
            $contract_arr = D('house_village_shequ')
                ->alias('s')
                ->field('s.*,v.village_name')
                ->join('left join __HOUSE_VILLAGE__ v on v.village_id = s.village_id')
                ->where(array('s.contract_end'=>$val))
                ->select();
        }
               
        // var_dump($dataArr);exit();
        return $contract_arr;
    }


	/**
     * 巡更记录日报表推送消息模板
     */
    public function send_record_msg_day()
    {
        //微信类库
        $wechat = new WechatModel();

        //获取物业相关人员微信openid
        //相关角色
        $role_names = array(
            '82'=>"在线巡检",
        );
        $role_ids = array_keys($role_names);
        $map = array();
        // $map['role_id'] = array('in',$role_ids);
        $map['_string'] = "find_in_set($role_ids[0],role_id)";
        // $map['village_id'] = array('eq',4);
        $admins = M('admin')->where($map)->select();
        $resArr = array();
        foreach($admins as $admin){
            if($admin['openid']){
                $openid = $admin['openid'];
                // $openids[] = "ohgcf0lvS3Ht7vH5n9PXbr5AEKtU";
            }

            //进行定时发送时间判断
            // $time = $this->get_send_time($openid);
            // $record_chart=M('config')->where(array('name'=>'record_chart'))->find();
            // if($record_chart['value'] != strtotime(date('Y-m-d'))){
            //     $send_time = strtotime(date('Y-m-d').$time);
            //     $now_time = strtotime(date('Y-m-d H:i:s'));
            //     if ($send_time < $now_time){
            //         //巡更报告模板ID
            //         $tpl_id = "BeFjeCRSsRek2cnJy-cQvMdOxbjNdbd3LrYUbuWprs4";

            //         //获取当天巡更报告数据
            //         $info = $this->get_record_chart_day($openid);
            //         // var_dump($info);exit();

            //         $data = array(
            //             "first"=>array(
            //                    "value"=>"您好，您有一份巡更统计报告。",
            //                    "color"=>"#173177"
            //            ),
            //            "keyword1"=>array(
            //                "value"=>$info['village_name']."项目 在线巡更日报",
            //                "color"=>"#173177"
            //            ),
            //            "keyword2"=>array(
            //                "value"=>$info['name'],
            //                "color"=>"#173177"
            //            ),
            //            "keyword3"=>array(
            //                "value"=>$info['time'],
            //                "color"=>"#173177"
            //            ),
            //            "keyword4"=>array(
            //                "value"=>"已巡更：".$info['nowPointCount'].","."未巡更：".$info['lowPoint'],
            //                "color"=>"#173177"
            //            ),
            //            "keyword5"=>array(
            //                "value"=>$info['status'],
            //                "color"=>"#173177"
            //            ),
            //            "remark"=>array(
            //                "value"=>"查看报告",
            //                "color"=>"#173177"
            //            ),
            //         );
            //         $url = "http://www.hdhsmart.com/wap.php?g=Wap&c=PropertyService&a=check_record_chart";
            //         $res = $wechat->send_tpl_message($openid, $tpl_id, $url, $data);
            //         $resArr[] = $res;                    
            //     }else{
            //         continue;
            //     }
            // }                      
        
	        //巡更报告模板ID
	        $tpl_id = "BeFjeCRSsRek2cnJy-cQvMdOxbjNdbd3LrYUbuWprs4";

	        //获取当天巡更报告数据
	        $info = $this->get_record_chart_day($openid);
	        // var_dump($info);exit();

	        $data = array(
	            "first"=>array(
	                   "value"=>"您好，您有一份巡更统计报告。",
	                   "color"=>"#173177"
	           ),
	           "keyword1"=>array(
	               "value"=>$info['village_name']."项目 在线巡更日报",
	               "color"=>"#173177"
	           ),
	           "keyword2"=>array(
	               "value"=>$info['name'],
	               "color"=>"#173177"
	           ),
	           "keyword3"=>array(
	               "value"=>$info['time'],
	               "color"=>"#173177"
	           ),
	           "keyword4"=>array(
	               "value"=>"已巡更：".$info['nowPointCount'].","."未巡更：".$info['lowPoint'],
	               "color"=>"#173177"
	           ),
	           "keyword5"=>array(
	               "value"=>$info['status'],
	               "color"=>"#173177"
	           ),
	           "remark"=>array(
	               "value"=>"查看报告",
	               "color"=>"#173177"
	           ),
	        );
	        $url = "http://www.hdhsmart.com/wap.php?g=Wap&c=PropertyService&a=check_record_chart";
	        $res = $wechat->send_tpl_message($openid, $tpl_id, $url, $data);
	        // if($res[0]['errcode']==0){
	        //     //TODO::与用户方逻辑无关，暂不提醒，应记录在日志系统当中
	        //    // $this->error("推送消息失败");
	        //     $this->success("推送消息成功！");
	        // }
	        $resArr[] = $res;
        }
        //对发送的报告返回信息进行判断，当全部推送完成时关闭发送
        //M('config')->where(array('name'=>'record_chart'))->data(array('value'=>strtotime(date('Y-m-d'))))->save();
        return $resArr;
    }

    /**
     * 获取巡更推送消息数据
     */
    public function get_record_chart_day($openid){
        // $openid = $openid;
        // var_dump($openidArr);exit();

    	$village_id = D('admin')->where(array('openid'=>$openid))->getField('village_id');
        $village_name = D('house_village')->where(array('village_id'=>$village_id))->getField('village_name');
        // var_dump($village_id);exit();
        // $project_id = $_GET['project_id'];
        $where=array('p.is_del'=>0);
        if(!empty($village_id))$where['m.village_id']=$village_id;
        // if(!empty($project_id))$where['m.project_id']=$project_id;
        //一共多少巡更点
        $pointCount = M('house_village_point')
                ->alias('p')
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
                ->where(array('p.type' => 0,'p.is_del'=>0))
                ->where($where)
                ->count();

        //获取班次的开始和结束时间
        $timeArr = $this->get_shift_time($village_id);

        //一天的巡更时间段
        $nowDays = strtotime('-1 day',strtotime(date('Y-m-d').$timeArr[2]));
        $nowDaye = strtotime(date('Y-m-d').$timeArr[2]);
        // var_dump($nowDaye);exit();
        //前一天已经巡检了多少点位
        $where=array('r.check_time'=>array('between',array($nowDays,$nowDaye)),'p.is_del'=>0);
        if(!empty($village_id))$where['m.village_id']=$village_id;
        // if(!empty($project_id))$where['m.project_id']=$project_id;
        $nowPointCount = M('village_point_record')
            ->alias('r')
            ->field(array("count(DISTINCT r.pid)"=>'num'))
            ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid ')
            ->where($where)
            ->select()[0]['num'];
        /*dump(M()->_sql());*/
        //还剩多少点位未巡检
        $lowPoint = $pointCount-$nowPointCount;
        if($lowPoint<=0)$lowPoint=0;

        //巡更人
        $uidArr = M('village_point_record')->alias('r')
            ->field(array('r.pigcms_id','r.uid'))
            ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
            ->where(array('r.check_time'=>array('between',array($nowDays,$nowDaye))))
            ->where(array('m.village_id'=>$village_id))
            ->order('r.pigcms_id desc')
            ->select();
        //获取数组中每个uid数量得数组
        $uids = array_column($uidArr, 'uid');
        $count = array_count_values($uids);
        $uid = max($count);  //取数组中的最大值
        $uid = array_search($uid,$count);  //取最大值的键值
        // var_dump($count);exit();
        
        $name = M('house_village_user_bind')
            ->field(array('name'))
            ->where(array('uid'=>$uid))
            ->select()[0]['name'];

        if (empty($name)) {//未绑定就在微信用户表里查找真实姓名
                $name = M('user')
                    ->field(array('truename'))
                    ->where(array('uid'=>$uid))
                    ->select()[0]['truename'];
            }

        //当天未巡更判断
        if ($nowPointCount == 0) {
            $name = '当天未巡更';
        }

        //不正常的巡更点数
        $where=array('r.check_time'=>array('between',array($nowDays,$nowDaye)),'r.point_status'=>1);
        if(!empty($village_id))$where['m.village_id']=$village_id;
        $warningPoint = M('village_point_record')
            ->alias('r')
            ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid ')
            ->where($where)
            ->count();

       //  //正常巡更点数量
       //  $safetyPoint = $nowPointCount - $warningPoint;
     
        //给每日的模板消息推送提供数据
        $datas = [
            'village_name' => $village_name,
            'name' => $name,
            'time' => date('Y-m-d H:i:s'),
            'nowPointCount' => $nowPointCount,
            'lowPoint' => $lowPoint,
        ];
        if ($warningPoint) {
            $datas['status'] = '异常：'. $warningPoint . '个';
        } else {
            $datas['status'] = '正常';
        }
               
        // var_dump($dataArr);exit();
        return $datas;
    }



    /**
     * 巡更记录周报表推送消息模板
     */
    public function send_record_msg_week()
    {
        //微信类库
        $wechat = new WechatModel();

        //获取物业相关人员微信openid
        //相关角色
        $role_names = array(
            '82'=>"在线巡检",
        );
        $role_ids = array_keys($role_names);
        $map = array();
        // $map['role_id'] = array('in',$role_ids);
        $map['_string'] = "find_in_set($role_ids[0],role_id)";
        // $map['village_id'] = array('eq',4);
        $admins = M('admin')->where($map)->select();
        $resArr = array();
        foreach($admins as $admin){
            if($admin['openid']){
                $openid = $admin['openid'];
                // $openids[] = "ohgcf0lvS3Ht7vH5n9PXbr5AEKtU";
            }
        
            //巡更报告模板ID
            $tpl_id = "BeFjeCRSsRek2cnJy-cQvMdOxbjNdbd3LrYUbuWprs4";

            //获取当天巡更报告数据
            $info = $this->get_record_chart_week($openid);
            // var_dump($info);exit();

            $data = array(
                "first"=>array(
                       "value"=>"您好，您有一份巡更统计报告。",
                       "color"=>"#173177"
               ),
               "keyword1"=>array(
                   "value"=>$info['village_name']."项目 在线巡更周报",
                   "color"=>"#173177"
               ),
               "keyword2"=>array(
                   "value"=>$info['name'],
                   "color"=>"#173177"
               ),
               "keyword3"=>array(
                   "value"=>$info['time'],
                   "color"=>"#173177"
               ),
               "keyword4"=>array(
                   "value"=>"已巡更：".$info['nowPointCount'].","."未巡更：".$info['lowPointCount'].","."巡更率: ".$info['rate'],
                   "color"=>"#173177"
               ),
               "keyword5"=>array(
                   "value"=>$info['status'],
                   "color"=>"#173177"
               ),
               "remark"=>array(
                   "value"=>"查看报告",
                   "color"=>"#173177"
               ),
            );
            $url = "http://www.hdhsmart.com/wap.php?g=Wap&c=PropertyService&a=check_record_chart_week";
            $res = $wechat->send_tpl_message($openid, $tpl_id, $url, $data);
            // if($res[0]['errcode']==0){
            //     //TODO::与用户方逻辑无关，暂不提醒，应记录在日志系统当中
            //    // $this->error("推送消息失败");
            //     $this->success("推送消息成功！");
            // }
            $resArr[] = $res;
        }
        return $resArr;
    }

    /**
     * 获取巡更推送消息数据
     */
    public function get_record_chart_week($openid){
        $village_id = D('admin')->where(array('openid'=>$openid))->getField('village_id');
        $village_name = D('house_village')->where(array('village_id'=>$village_id))->getField('village_name');
        $where=array('p.is_del'=>0);
        if(!empty($village_id))$where['m.village_id']=$village_id;
        // if(!empty($project_id))$where['m.project_id']=$project_id;
        //一共多少巡更点
        $pointCount = M('house_village_point')
                ->alias('p')
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
                ->where(array('p.type' => 0,'p.is_del' => 0))
                ->where($where)
                ->count();

        //获取班次的开始和结束时间
        $timeArr = $this->get_shift_time($village_id);

        //一周的巡更结束时间
        $start_time = strtotime(date('Y-m-d', (time() - ((date('w') == 0 ? 7 : date('w')) - 1) * 24 * 3600)));
        //将时间点进行for循环得到每天的结束时间
        $array = array();
        for($i=1;$i<=7;$i++){
            $array[] = date('Y-m-d',$start_time-$i*86400); //每隔一天赋值给数组
        }

        $newArr = array();
        foreach ($array as $k => $v) {
            $time = strtotime($v);
            $Start_Time = $time+$timeArr[0]*3600;
            $End_Time = $time+$timeArr[1]*3600;

        //巡更人
        $uidArr = M('village_point_record')->alias('r')
            ->field(array('r.pigcms_id','r.uid'))
            ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
            ->where(array('r.check_time'=>array('between',array($Start_Time,$End_Time))))
            ->where(array('m.village_id'=>$village_id))
            ->order('r.pigcms_id desc')
            ->select();
        //获取数组中每个uid数量得数组
        $uids = array_column($uidArr, 'uid');
        $count = array_count_values($uids);
        $uid = max($count);  //取数组中的最大值
        $uid = array_search($uid,$count);  //取最大值的键值
        // var_dump($count);exit();
        
        $name = M('house_village_user_bind')
            ->field(array('name'))
            ->where(array('uid'=>$uid))
            ->select()[0]['name'];

        if (empty($name)) {//未绑定就在微信用户表里查找真实姓名
                $name = M('user')
                    ->field(array('truename'))
                    ->where(array('uid'=>$uid))
                    ->select()[0]['truename'];
            }

            //已经巡检的巡更点
            $yes_Count = M('village_point_record')->alias('r')
                ->field(array("count(DISTINCT pid)"=>'num'))
                ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
                ->where(array('r.check_time'=>array('between',array($Start_Time,$End_Time))))
                ->where(array('m.village_id'=>$village_id,'p.is_del'=>0))
                ->select()[0]['num'];

            //当天未巡更判断
            if ($yes_Count == 0) {
                $name = '当天未巡更';
            }

            //异常巡更点数量
            $where=array('r.check_time'=>array('between',array($Start_Time,$End_Time)),'r.point_status'=>1);
            if(!empty($village_id))$where['m.village_id']=$village_id;
            $warningPoint = M('village_point_record')
                ->alias('r')
                ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid ')
                ->where($where)
                ->count();

            $newArr['nowPointCount'] += $yes_Count;
            $newArr['warningPoint'] += $warningPoint;
        }
        //未巡更点
        $lowPointCount = intval($pointCount*7-$newArr['nowPointCount'])?:0;
        //巡更率
        $rate = round(($newArr['nowPointCount']/($pointCount*7))*100,0).'%';
        
        //给周报告的模板消息推送提供数据
        $datas = [
            'village_name' => $village_name,
            'name' => $name,
            'time' => date('Y-m-d H:i:s'),
            'nowPointCount' => $newArr['nowPointCount'],
            'lowPointCount' => $lowPointCount,
            'rate' => $rate
        ];
        if ($newArr['warningPoint']) {
            $datas['status'] = '异常：'. $newArr['warningPoint'] . '个';
        } else {
            $datas['status'] = '正常';
        }
               
        // var_dump($datas);exit();
        return $datas;
    }

    /**
     * 巡更记录日报表推送消息模板
     */
    public function send_record_msg_month()
    {
        //微信类库
        $wechat = new WechatModel();

        //获取物业相关人员微信openid
        //相关角色
        $role_names = array(
            '82'=>"在线巡检",
        );
        $role_ids = array_keys($role_names);
        $map = array();
        // $map['role_id'] = array('in',$role_ids);
        $map['_string'] = "find_in_set($role_ids[0],role_id)";
        // $map['village_id'] = array('eq',4);
        $admins = M('admin')->where($map)->select();
        $resArr = array();
        foreach($admins as $admin){
            if($admin['openid']){
                $openid = $admin['openid'];
                // $openids[] = "ohgcf0lvS3Ht7vH5n9PXbr5AEKtU";
            }
        
            //巡更报告模板ID
            $tpl_id = "BeFjeCRSsRek2cnJy-cQvMdOxbjNdbd3LrYUbuWprs4";

            //获取当天巡更报告数据
            $info = $this->get_record_chart_month($openid);
            // var_dump($info);exit();

            $data = array(
                "first"=>array(
                       "value"=>"您好，您有一份巡更统计报告。",
                       "color"=>"#173177"
               ),
               "keyword1"=>array(
                   "value"=>$info['village_name']."项目 在线巡更月报",
                   "color"=>"#173177"
               ),
               "keyword2"=>array(
                   "value"=>$info['name'],
                   "color"=>"#173177"
               ),
               "keyword3"=>array(
                   "value"=>$info['time'],
                   "color"=>"#173177"
               ),
               "keyword4"=>array(
                   "value"=>"已巡更：".$info['nowPointCount'].","."未巡更：".$info['lowPointCount'].","."巡更率: ".$info['rate'],
                   "color"=>"#173177"
               ),
               "keyword5"=>array(
                   "value"=>$info['status'],
                   "color"=>"#173177"
               ),
               "remark"=>array(
                   "value"=>"查看报告",
                   "color"=>"#173177"
               ),
            );
            $url = "http://www.hdhsmart.com/wap.php?g=Wap&c=PropertyService&a=check_record_chart_month";
            $res = $wechat->send_tpl_message($openid, $tpl_id, $url, $data);
            // if($res[0]['errcode']==0){
            //     //TODO::与用户方逻辑无关，暂不提醒，应记录在日志系统当中
            //    // $this->error("推送消息失败");
            //     $this->success("推送消息成功！");
            // }
            $resArr[] = $res;
        }
        return $resArr;
    }

    /**
     * 获取巡更推送消息数据
     */
    public function get_record_chart_month($openid){
        // $openid = $openid;
        // var_dump($openidArr);exit();

        $village_id = D('admin')->where(array('openid'=>$openid))->getField('village_id');
        $village_name = D('house_village')->where(array('village_id'=>$village_id))->getField('village_name');
        // var_dump($village_id);exit();
        // $project_id = $_GET['project_id'];
        $where=array('p.is_del'=>0);
        if(!empty($village_id))$where['m.village_id']=$village_id;
        // if(!empty($project_id))$where['m.project_id']=$project_id;
        //一共多少巡更点
        $pointCount = M('house_village_point')
                ->alias('p')
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
                ->where(array('p.type' => 0,'p.is_del'=>0))
                ->where($where)
                ->count();

        //获取班次的开始和结束时间
        $timeArr = $this->get_shift_time($village_id);

        $start_time = strtotime(date('Y-m-01'));  //获取本月第一天的时间戳
        $daysCount = date("t", strtotime('-1 month'));  //上个月一共多少天
        //将时间点进行for循环得到每天的结束时间
        $array = array();
        for($i=1;$i<=$daysCount;$i++){
            $array[] = date('Y-m-d',$start_time-$i*86400); //每隔一天赋值给数组
        }

        $newArr = array();
        $nameArr = array();
        foreach ($array as $k => $v) {
            $time = strtotime($v);
            $Start_Time = $time+$timeArr[0]*3600;
            $End_Time = $time+$timeArr[1]*3600;

        //巡更人
        $uidArr = M('village_point_record')->alias('r')
            ->field(array('r.pigcms_id','r.uid'))
            ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
            ->where(array('r.check_time'=>array('between',array($Start_Time,$End_Time))))
            ->where(array('m.village_id'=>$village_id))
            ->order('r.pigcms_id desc')
            ->select();
        //获取数组中每个uid数量得数组
        $uids = array_column($uidArr, 'uid');
        $count = array_count_values($uids);
        $uid = max($count);  //取数组中的最大值
        $uid = array_search($uid,$count);  //取最大值的键值
        // var_dump($count);exit();
        
        $name = M('house_village_user_bind')
            ->field(array('name'))
            ->where(array('uid'=>$uid))
            ->select()[0]['name'];

        if (empty($name)) {//未绑定就在微信用户表里查找真实姓名
                $name = M('user')
                    ->field(array('truename'))
                    ->where(array('uid'=>$uid))
                    ->select()[0]['truename'];
            }
        $nameArr[] = $name;
            //已经巡检的巡更点
            $yes_Count = M('village_point_record')->alias('r')
                ->field(array("count(DISTINCT pid)"=>'num'))
                ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
                ->where(array('r.check_time'=>array('between',array($Start_Time,$End_Time))))
                ->where(array('m.village_id'=>$village_id,'p.is_del'=>0))
                ->select()[0]['num'];

            //异常巡更点数量
            $where=array('r.check_time'=>array('between',array($Start_Time,$End_Time)),'r.point_status'=>1);
            if(!empty($village_id))$where['m.village_id']=$village_id;
            $warningPoint = M('village_point_record')
                ->alias('r')
                ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid ')
                ->where($where)
                ->count();

            $newArr['nowPointCount'] += $yes_Count;
            $newArr['warningPoint'] += $warningPoint;
        }
        //未巡更点
        $lowPointCount = intval($pointCount*$daysCount-$newArr['nowPointCount'])?:0;
        //巡更率
        $rate = round(($newArr['nowPointCount']/($pointCount*$daysCount))*100,0).'%';
        //巡更人
        $count = array_count_values($nameArr);
        $max = max($count);  //取数组中的最大值
        $name = array_search($max,$count);
        //给月报告的模板消息推送提供数据
        $datas = [
            'village_name' => $village_name,
            'name' => $name,
            'time' => date('Y-m-d H:i:s'),
            'nowPointCount' => $newArr['nowPointCount'],
            'lowPointCount' => $lowPointCount,
            'rate' => $rate
        ];
        if ($newArr['warningPoint']) {
            $datas['status'] = '异常：'. $newArr['warningPoint'] . '个';
        } else {
            $datas['status'] = '正常';
        }               
        // var_dump($datas);exit();
        return $datas;
    }

    /**
     *自定义班次的开始时间点和结束时间点
     */
    public function get_shift_time($village_id){
        //查询是否设置班次
        $is_set = M('house_village_shift')->where(array('village_id'=>$village_id))->find();
        if ($is_set) {
            $night_to = explode(':',$is_set['night_time_to']);
            $middle_to = explode(':',$is_set['middle_time_to']);
            $morning_to = explode(':',$is_set['morning_time_to']);
            $night_from = explode(':',$is_set['night_time_from']);
            $middle_from = explode(':',$is_set['middle_time_from']);
            $morning_from = explode(':',$is_set['morning_time_from']);
            $night_to_num = intval($night_to[0]);
            $middle_to_num = intval($middle_to[0]);
            $morning_to_num = intval($morning_to[0]);
            $night_from_num = intval($night_from[0]);
            $middle_from_num = intval($middle_from[0]);
            $morning_from_num = intval($morning_from[0]);
            if ($is_set['night_shift']) {
                $time_end = $is_set['night_time_to'];
                if ($night_to_num>12&&$night_to_num<24) {
                    $num_end = $night_to_num;                    
                } else {
                    $num_end = $night_to_num + 24;
                }
            } elseif ($is_set['middle_shift']) {
                $time_end = $is_set['middle_time_to'];
                if ($middle_to_num>12&&$middle_to_num<24) {
                    $num_end = $middle_to_num;
                } else {
                    $num_end = $middle_to_num + 24;
                }
            } else {
                $time_end = $is_set['morning_time_to'];
                $num_end = $morning_to_num;
            }
            if ($is_set['morning_shift']) {
                $time_start = $is_set['morning_time_from'];
                $num_start = $morning_from_num;
            } elseif ($is_set['middle_shift']) {
                $time_start = $is_set['middle_time_from'];
                $num_start = $middle_from_num;
            } else {
                $time_start = $is_set['night_time_from'];
                $num_start = $night_from_num;
            }
        } else {//未设置则使用标准班次时间
            $status = M('house_village_shift')->where(array('id'=>1))->find();
            $night_to = explode(':',$status['night_time_to']);
            $middle_to = explode(':',$status['middle_time_to']);
            $morning_to = explode(':',$status['morning_time_to']);
            $night_from = explode(':',$status['night_time_from']);
            $middle_from = explode(':',$status['middle_time_from']);
            $morning_from = explode(':',$status['morning_time_from']);
            $night_to_num = intval($night_to[0]);
            $middle_to_num = intval($middle_to[0]);
            $morning_to_num = intval($morning_to[0]);
            $night_from_num = intval($night_from[0]);
            $middle_from_num = intval($middle_from[0]);
            $morning_from_num = intval($morning_from[0]);
            //设置结束时间点
            if ($status['night_shift']) {
                $time_end = $status['night_time_to'];
                if ($night_to_num>12&&$night_to_num<24) {
                    $num_end = $night_to_num;
                } else {
                    $num_end = $night_to_num + 24;
                }
            } elseif ($status['middle_shift']) {
                $time_end = $status['middle_time_to'];
                if ($middle_to_num>12&&$middle_to_num<24) {
                    $num_end = $middle_to_num;
                } else {
                    $num_end = $middle_to_num + 24;
                }
            } else {
                $time_end = $status['morning_time_to'];
                $num_end = $morning_to_num;
            }
            //设置开始时间点
            if ($status['morning_shift']) {
                $time_start = $status['morning_time_from'];
                $num_start = $morning_from_num;
            } elseif ($status['middle_shift']) {
                $time_start = $status['middle_time_from'];
                $num_start = $middle_from_num;
            } else {
                $time_start = $status['night_time_from'];
                $num_start = $night_from_num;
            }
            
        }
        $num = array($num_start,$num_end,$time_end,$time_start);
        return $num;
    }


}



?>