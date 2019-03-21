<?php
bpBase::loadAppClass('common', 'User', 0);
class user_controller extends common_controller
{
    private $merchantsDb;

    public function __construct()
    {
        parent::__construct();
        $this->authorityControl(array('getchart', 'GetwxUserInfoFromSys'));
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

}

?>
