<?php
bpBase::loadAppClass('common', 'User', 0);
class statistics_controller extends common_controller
{
	private $merchantsDb;

	public function __construct()
	{
		parent::__construct();
		$this->authorityControl(array('getchart', 'GetwxUserInfoFromSys'));
	}

	public function index()
	{
//        $info=M('user')->get_one(array('openid'=>'oRn56wHhUfHCRt4-eIIw1El6AMgM'),'*');
//        dump($info);exit;

		$today = date('Y-m-d');
		$aweekago = date('Y-m-d', strtotime('-1 week'));
		$todaym = date('Y-m');
		$aYearagom = date('Y-m', strtotime('-6 month'));
		include $this->showTpl();
	}

	public function fans()
	{
		bpBase::loadOrg('common_page');
        $sqlObj = new model();
        $beginThismonth=strtotime(date('Y-m'));//这个月的月初时间戳
        $endThismonth=strtotime(date('Y-m-t'));//这个月的月末时间戳
		$fansDb = M('cashier_fans');
		$where = array('mid' => $this->mid);
		$_count = $fansDb->count($where);
		$p = new Page($_count, 20);
		$pagebar = $p->show(2);
		//$fansarr = $fansDb->select($where, '*', $p->firstRow . ',' . $p->listRows, 'id DESC');
		$sql='select *from pigcms_cashier_fans where mid='.$this->mid.' order by totalfee desc LIMIT '.$p->firstRow.',' . $p->listRows;
        $fansarr=$sqlObj->selectBySql($sql);
        //dump($fansarr);exit;
		foreach ($fansarr as &$v){
			$uid=M('user')->get_one(array('openid'=>$v['openid']),'uid');
			$v['uid']=$uid['uid'];
			$openid=$v['openid'];
			$month_money_sql='select sum(goods_price) from pigcms_cashier_order as a  where a.ispay=1 and a.openid="'.$openid.'" and a.mid='.$this->mid.' and a.add_time>'.$beginThismonth.' and a.add_time<'.$endThismonth;
            $month_money_arr=$sqlObj->selectBySql($month_money_sql);
            $month_money=$month_money_arr[0]['sum(goods_price)'];
            if($month_money==null){
                $month_money=0.00;
			}
            $v['month_money']=$month_money;//本月消费金额
            $month_count_sql='select count(*) from pigcms_cashier_order as a  where a.ispay=1 and a.openid="'.$openid.'" and a.mid='.$this->mid.' and a.add_time>'.$beginThismonth.' and a.add_time<'.$endThismonth;
            $month_count_arr=$sqlObj->selectBySql($month_count_sql);
            $month_count=$month_count_arr[0]['count(*)'];
            $v['month_count']=$month_count;//本月消费次数
		}
		foreach ($fansarr as &$v){
			if($v['uid']!=null){
                $info=M('house_village_user_bind')->get_one(array('uid'=>$v['uid']),'phone,company_id');
                //$v['phone']=$info['phone'];
				$phone=M('user')->get_one(array('uid'=>$v['uid']),'phone');
				$v['phone']=$phone['phone'];
                $company_name=M('company')->get_one(array('company_id'=>$info['company_id']),'company_name');
                $v['company_name']=$company_name['company_name'];
                $score=M('user')->get_one(array('uid'=>$v['uid']),'score_count');
                $v['score']=$score['score_count'];
			}else{
				$v['phone']=null;
				$v['company_name']=null;
				$v['all_money']=0;
				$v['score']=0;

			}
		}
//		$sort=array(
//			'direction'=>'SORT_DESC',
//			'field'=>'money'
//		);
//		$arrsort=array();
//		foreach ($fansarr as $uniqid=>$row){
//			foreach ($row as $key=>$value){
//				$arrsort[$key][$uniqid]=$value;
//			}
//		}
//		if($sort['direction']){
//			array_multisort($arrsort[$sort['field']],constant($sort['direction']),$fansarr);
//		}
		//dump($fansarr);exit;
//		$getwxuser = array(
//			'user_list' => array()
//			);
//		$tmpdata = array();
//
//		foreach ($fansarr as $kk => $vv) {
//			$tmpdata[$vv['openid']] = $vv;
//			if (empty($vv['nickname']) || empty($vv['headimgurl'])) {
//				$getwxuser['user_list'][$kk] = array('openid' => $vv['openid'], 'lang' => 'zh-CN');
//			}
//		}
//
//		$fansarr = $tmpdata;
//		unset($tmpdata);
//		$nowxinfoOpenid = array();
//
//		if (!empty($getwxuser['user_list'])) {
//			bpBase::loadOrg('wxCardPack');
//			$wx_user = M('cashier_payconfig')->getwxuserConf($this->mid);
//			$wxCardPack = new wxCardPack($wx_user, $this->mid);
//			$access_token = $wxCardPack->getToken();
//			$UserInfoList = $wxCardPack->GetwxUserInfoList($access_token, json_encode($getwxuser));
//
//			if (isset($UserInfoList['user_info_list'])) {
//				$fansDb = M('cashier_fans');
//
//				foreach ($UserInfoList['user_info_list'] as $uvv) {
//					if ($uvv['subscribe'] == 1) {
//						$wxuserinfo = array('is_subscribe' => $uvv['subscribe'], 'nickname' => $uvv['nickname'], 'sex' => $uvv['sex'], 'province' => $uvv['province'], 'city' => $uvv['city'], 'country' => $uvv['country'], 'headimgurl' => $uvv['headimgurl'], 'groupid' => $uvv['groupid']);
//						$fansDb->update($wxuserinfo, array('openid' => $uvv['openid'], 'mid' => $this->mid));
//						$fansarr[$uvv['openid']] = array_merge($fansarr[$uvv['openid']], $wxuserinfo);
//					}
//					else {
//						$nowxinfoOpenid[] = $uvv['openid'];
//					}
//				}
//			}
//
//			if (!empty($nowxinfoOpenid)) {
//			}
//		}
       //dump($fansarr);exit;

		/*测试*/
		//$test_sql = "select * from pigcms_cashier_fans where openid in (SELECT * FROM pigcms_cashier_fans where COUNT(openid)>1)";

		include $this->showTpl();
	}
	public function getchart()
	{
		$nowtime = time();
		$typ = trim($_POST['typ']);
		$dstart = trim($_POST['dstart']);
		$dend = trim($_POST['dend']);
		$orderDb = M('cashier_order');
		$totalmoney = $refund = $income = 0;
		$output = array();
        $weather = array();
		switch ($typ) {
		case 'date':
			$startime = $nowtime - (7 * 24 * 3600);
			$starttime = strtotime($dstart);
			!(0 < $starttime) && ($starttime = $startime);
			$endtime = strtotime($dend);

			if (!(0 < $endtime)) {
				$endtime = $nowtime;
			}
			else {
				$endtime = $endtime + (23 * 3600) + (59 * 60) + 30;
			}

			$xkey1 = $xkey2 = array();
			$s = $starttime;
			//緩存
            $connect = new Memcached;  //声明一个新的memcached链接
            $connect->setOption(Memcached::OPT_COMPRESSION, false); //关闭压缩功能
            $connect->setOption(Memcached::OPT_BINARY_PROTOCOL, true); //使用binary二进制协议
            $connect->addServer('f120e580f9b74ec5.m.cnhzaliqshpub001.ocs.aliyuncs.com', 11211); //添加OCS实例地址及端口号
//			dump(unserialize($connect->get('weather_key')));
			while ($s <= $endtime) {
				$datekey = date('m-d', $s);
				$ymd = trim(date('Y-m-d',$s),' ');

				/*$weatherArr = unserialize($connect->get('weather_key'));
				if ($weatherArr[$ymd]) {
                    $weather[$datekey] = $weatherArr[$ymd];
				} else {
                    //计算出当日天气
					if (date("Y-m-d",time()) != $ymd) {
                        $weaRes = json_decode($this->weather($ymd),true);
                        if ($weaRes['result']) {
                            $weather[$datekey] = $weaRes['result']['day_weather'];
                            //存入緩存裡面
                            $weatherArr[$ymd] = $weaRes['result']['day_weather'];
                            $connect->set('weather_key',serialize($weatherArr));
                        }
					}

				}*/


                $ww = date('w',strtotime($ymd));
                //计算出星期几
                if ($ww == 1) {
                    $ss = '星期一';
                } elseif($ww == 2) {
                    $ss = '星期二';
                } elseif($ww == 3) {
                    $ss = '星期三';
                } elseif($ww == 4) {
                    $ss = '星期四';
                } elseif($ww == 5) {
                    $ss = '星期五';
                } elseif($ww == 6) {
                    $ss = '星期六';
                } elseif($ww == 0) {
                    $ss = '星期天';
                }

                $xkey1[$datekey."\n".$ss] = 0;
//                $xkey1[$datekey] = 0;
				$s = $s + (23 * 3600) + (59 * 60) + 29;
			}

			$xkey2 = $xkey1;
			$wherestr = 'mid=' . $this->mid . ' AND  paytime >' . $starttime . ' AND paytime <=' . $endtime . ' AND  ispay=1';
			$fieldstr = 'sum(goods_price) as price,paytime,FROM_UNIXTIME(paytime,"%m-%d") as perdate';
			$tmpdatas = $orderDb->select($wherestr, $fieldstr, '', 'paytime ASC', 'perdate');
			foreach ($tmpdatas as $tvv) {
                $ww = date('w',strtotime(date('Y-m-d',$tvv['paytime'])));
				//计算出星期几
                if ($ww == 1) {
                    $ss = '星期一';
                } elseif($ww == 2) {
                    $ss = '星期二';
                } elseif($ww == 3) {
                    $ss = '星期三';
                } elseif($ww == 4) {
                    $ss = '星期四';
                } elseif($ww == 5) {
                    $ss = '星期五';
                } elseif($ww == 6) {
                    $ss = '星期六';
                } elseif($ww == 0) {
                    $ss = '星期天';
                }

				$xkey1[$tvv['perdate']."\n".$ss] = $tvv['price'];
//                $xkey1[$tvv['perdate']] = $tvv['price'];
				$totalmoney += $tvv['price'];
			}


			$output['idx1'] = array_values($xkey1);
			$wherestr = 'mid=' . $this->mid . ' AND  paytime >' . $starttime . ' AND paytime <=' . $endtime . ' AND  ispay=1 AND refund=2';
			$fieldstr = 'sum(goods_price) as price,paytime,FROM_UNIXTIME(paytime,"%m-%d") as perdate';
			$tmprefund = $orderDb->select($wherestr, $fieldstr, '', 'paytime ASC', 'perdate');

			foreach ($tmprefund as $fvv) {
				$xkey2[$fvv['perdate']] = $fvv['price'];
				$refund += $fvv['price'];
			}

			$output['idx2'] = array_values($xkey2);
			$xkey3 = array();

			foreach ($xkey1 as $kk => $vv) {
				$xkey3[$kk] = $vv - $xkey2[$kk];
				$income += $xkey3[$kk];
			}

			$output['idx3'] = array_values($xkey3);
			$expand = array('tt' => $totalmoney, 'rf' => $refund, 'ic' => $income);
			break;

		case 'month':
			$todaym = date('Y-m') . '-01';
			$aYearagom = date('Y-m', strtotime('-6 month'));
			$starttime = strtotime($dstart . '-01');

			if (!(0 < $starttime)) {
				$starttime = strtotime($todaym);
			}

			$t = date('t', $dend);
			$endtime = strtotime($dend);

			if (!(0 < $endtime)) {
				$endtime = $nowtime;
			}
			else {
				$endtime = strtotime($dend . '-' . $t . ' 23:59:59');
			}

			$xkey1 = $xkey2 = array();
			$s = $starttime;

			while ($s <= $endtime) {
				$datekey = date('Y-m', $s);
				$xkey1[$datekey] = 0;
				$s = $s + (31 * 24 * 3600) + 3600;
			}

			$xkey2 = $xkey1;
			$wherestr = 'mid=' . $this->mid . ' AND  paytime >' . $starttime . ' AND paytime <=' . $endtime . ' AND  ispay=1';
			$fieldstr = 'sum(goods_price) as price,paytime,FROM_UNIXTIME(paytime,"%Y-%m") as perdate';
			$tmpdatas = $orderDb->select($wherestr, $fieldstr, '', 'paytime ASC', 'perdate');

			foreach ($tmpdatas as $tvv) {
				$xkey1[$tvv['perdate']] = $tvv['price'];
				$totalmoney += $tvv['price'];
			}

			$output['idx1'] = array_values($xkey1);
			$wherestr = 'mid=' . $this->mid . ' AND  paytime >' . $starttime . ' AND paytime <=' . $endtime . ' AND  ispay=1 AND refund=2';
			$fieldstr = 'sum(goods_price) as price,paytime,FROM_UNIXTIME(paytime,"%Y-%m") as perdate';
			$tmprefund = $orderDb->select($wherestr, $fieldstr, '', 'paytime ASC', 'perdate');

			foreach ($tmprefund as $fvv) {
				$xkey2[$fvv['perdate']] = $fvv['price'];
				$refund += $fvv['price'];
			}

			$output['idx2'] = array_values($xkey2);
			$xkey3 = array();

			foreach ($xkey1 as $kk => $vv) {
				$xkey3[$kk] = $vv - $xkey2[$kk];
				$income += $xkey3[$kk];
			}

			$output['idx3'] = array_values($xkey3);
			$expand = array('tt' => $totalmoney, 'rf' => $refund, 'ic' => $income);
			break;

		case 'smcount':
			$startime = $nowtime - (7 * 24 * 3600);
			$starttime = strtotime($dstart);
			!(0 < $starttime) && ($starttime = $startime);
			$endtime = strtotime($dend);

			if (!(0 < $endtime)) {
				$endtime = $nowtime;
			}
			else {
				$endtime = $endtime + (23 * 3600) + (59 * 60) + 30;
			}

			$xkey1 = $xkey2 = array();
			$s = $starttime;

			while ($s <= $endtime) {
				$datekey = date('m-d', $s);
				$xkey1[$datekey] = 0;
				$s = $s + (23 * 3600) + (59 * 60) + 29;
			}

			$xkey2 = $xkey1;
			$wherestr1 = 'mid=' . $this->mid . ' AND  add_time >' . $starttime . ' AND add_time <=' . $endtime . ' AND pay_type="micropay" ';
			$wherestr2 = 'mid=' . $this->mid . ' AND  add_time >' . $starttime . ' AND add_time <=' . $endtime . ' AND pay_type!="micropay" ';
			$fieldstr = 'count(id) as perC,add_time,FROM_UNIXTIME(add_time,"%m-%d") as perdate';
			$tmpdatas1 = $orderDb->select($wherestr1, $fieldstr, '', 'add_time ASC', 'perdate');

			foreach ($tmpdatas1 as $cvv) {
				(0 < $cvv['perC']) && $xkey1[$cvv['perdate']] = $cvv['perC'];
				$micropay += $cvv['perC'];
			}

			$output['idx1'] = array_values($xkey1);
			$tmpdatas2 = $orderDb->select($wherestr2, $fieldstr, '', 'add_time ASC', 'perdate');

			foreach ($tmpdatas2 as $cvv) {
				(0 < $cvv['perC']) && $xkey2[$cvv['perdate']] = $cvv['perC'];
				$no_micropay += $cvv['perC'];
			}

			$output['idx2'] = array_values($xkey2);
			!(0 < $micropay) && ($micropay = 0);
			!(0 < $no_micropay) && ($no_micropay = 0);
			$expand = array('microC' => $micropay, 'nomicroC' => $no_micropay);
			print_r($tmpdatas);
			break;

		default:
			break;
		}
		if ($weather) {
            $weatherStr = "<table border='1px'><tr>
                                            <td style='width: 80px;text-align: center'>日期</td>";
			foreach ($weather as  $k => $v) {
                $weatherStr .= "<td style='width: 80px;text-align: center'>$k</td>";
			}

            $weatherStr .= "</tr>
                                        <tr>
                                            <td style='width: 80px;text-align: center'>天气</td>";

            foreach ($weather as  $k => $v) {
                $weatherStr .= "<td style='width: 80px;text-align: center'>$v</td>";
            }

            $weatherStr .= "</tr>
                                    </table>";


            $this->dexit(array('ydata' => $output, 'xdata' => array_keys($xkey1), 'expand' => $expand,'weatherStr' => $weatherStr));
		} else {
            $this->dexit(array('ydata' => $output, 'xdata' => array_keys($xkey1), 'expand' => $expand));
		}

	}

	public function otherpie()
	{
		$today = date('Y-m-d');
		$aweekago = date('Y-m-d', strtotime('-1 week'));
		$orderDb = M('cashier_order');
		$wherestr = 'mid=' . $this->mid . ' AND pay_type="micropay" AND comefrom="0"';
		$mt_count = $orderDb->count($wherestr);
		$wherestr = $wherestr . ' AND ispay=1';
		$wherestr = 'mid=' . $this->mid . ' AND pay_type !="micropay" AND comefrom="0"';
		$wt_count = $orderDb->count($wherestr);
		$entirearr = array('local' => 0, 'other' => 0, 'refund' => 0);
		$wherestr = 'mid=' . $this->mid . ' AND ispay=1 AND comefrom="0"';
		$tmpprice = $orderDb->get_one($wherestr, 'sum(goods_price) as tprice');
		(0 < $tmpprice['tprice']) && $entirearr['local'] = $tmpprice['tprice'];
		$wherestr = 'mid=' . $this->mid . ' AND ispay=1 AND comefrom !="0"';
		$tmpprice = $orderDb->get_one($wherestr, 'sum(goods_price) as tprice');
		(0 < $tmpprice['tprice']) && $entirearr['other'] = $tmpprice['tprice'];
		include $this->showTpl();
	}

	public function GetwxUserInfoFromSys($jsonData)
	{
		$url = 'http://test.me.cc/cgi-bin/user/info/batchget?access_token=' . $wxAccessToken . '&lang=zh_CN';
		$result = $this->wxHttpsRequest($url, $jsonData);
		return $result;
	}


    //查看城市天气调用接口
    public function weather($weather_date) {
        $key = "3eef410048d3cdaf4c22c6bfb055c390";
        $city_id = "936";//武汉
        $url = "http://v.juhe.cn/historyWeather/weather?key=$key&city_id=$city_id&weather_date=$weather_date";
        $re = $this->http_get($url);
		return $re;
    }

    /**
     * GET 请求
     * @param string $url
     */
    public function http_get($url){
        $oCurl = curl_init();
        if(stripos($url,"https://")!==FALSE){
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
        }
        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );
        $sContent = curl_exec($oCurl);
        $aStatus = curl_getinfo($oCurl);
        curl_close($oCurl);
        if(intval($aStatus["http_code"])==200){
            return $sContent;
        }else{
            return false;
        }
    }

}

?>
