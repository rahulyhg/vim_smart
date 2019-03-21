<?php
class DiscountSpeadAction extends BaseAction
{
    public $member_card_set_db;
    public $thisCard;

    public function _initialize()
    {
        parent::_initialize();

        $this->assign('token',$this->token);

        $this->wxuser_db = M("Merchant_info");
        $this->member_card_set_db = M('Member_card_set');

        //获取所在组的开卡数量
        $thisWxUser = $this->wxuser_db->where(array('token'=>$this->token))->find();
        $thisUser = $this->merchant_session;
// 		$thisGroup = $this->userGroup;
// 		$this->wxuser_db->where(array('token'=>$this->token))->save(array('allcardnum'=>$thisGroup['create_card_num']));
        //总数
        //if (!$thisUser['card_num']){
// 			$allcards = M('Member_card_create')->where(array('token'=>$this->token))->select();

// 			$cardTotal = count($allcards);

// 			M('Users')->where(array('id' => $thisUser['id']))->save(array('card_num'=>$cardTotal));
// 			M('Wxuser')->where(array('token' => $this->token))->save(array('yetcardnum'=>$cardTotal));
        //}else {
        //$cardTotal=$thisUser['card_num'];
        //}
        //
        $can_cr_num = $thisWxUser['allcardnum'] - $cardTotal;
        if($can_cr_num > 0){
            $data['cardisok'] = 1;
        }else{
            $data['cardisok'] = 0;
        }
        //$this->wxuser_db->where(array('uid' => $this->merchant_session['mer_id'], 'token' => $this->token))->save($data);
        //

        //
        $id = intval($_GET['id']);
        if ($id) {
            $this->thisCard = $this->member_card_set_db->where(array('id' => $id))->find();
            if ($this->thisCard && $this->thisCard['token'] != $this->token) {
                $this->error('非法操作');
            }
            $this->assign('thisCard', $this->thisCard);
        }

        $type = $this->_get('type','intval');
        $this->assign('type', $type ? $type : 1);
    }
    /**
     * 优惠卷推广
     * 汪威
     * 2016.04.12
     */
    public function index(){
        $mer_info = $this->merchant_session;
        $discount_spead = M('merchant_discount_spead');
        $data = $discount_spead->where(array( 'ds_merId' => $mer_info['mer_id']))->order('ds_id desc')->select();
        $this->assign('mer_info','$mer_info');
        $this->assign('data_vip',$data);
//        dump($data);exit;
        $this->display();
    }
    /**
     * 优惠卷的推广新增编辑
     * 汪威
     * 2016.04.12
     */
    public function ds_edit()
    {
        $mer_info = $this->merchant_session;
        $discount_spead = M('merchant_discount_spead');
        if (IS_POST) {
            $_POST['ds_name'] = htmlspecialchars($_POST['name']);
            $_POST['ds_img'] = htmlspecialchars($_POST['pic']);
            $_POST['ds_description'] = I('info');
            $_POST['ds_type'] = I('ds_type');
            $_POST['ds_scale'] = sprintf("%.2f",I('ds_scale'));
            $_POST['ds_scope'] = I('ds_scope');
            $_POST['ds_money'] =  I('ds_money');
            $_POST['ds_minmoney'] =  I('ds_minmoney');
            $_POST['ds_maxmoney'] =  I('ds_maxmoney');
            $_POST['ds_reMoney'] = I('ds_money');
            $_POST['ds_merId'] = $mer_info['mer_id'];
            if (empty($_POST['ds_name'])) $this->error('优惠名称不能为空');
            if (empty($_POST['ds_img'])) $this->error('您还没有上传图片');
            if (empty($_POST['ds_money'])) $this->error('请输入总金额');
            $_POST['ds_beginTime'] = strtotime($_POST['statdate']);
            $_POST['ds_endTime'] = strtotime($_POST['enddate'].' 23:59:59');
            $atime = $_POST['ds_endTime']-$_POST['ds_beginTime'];
            if($atime<=0){
                $this->error('您填写的时间有误！');
            }
            if($_POST['ds_type']=="1"){
                if($_POST['ds_scale']<0||$_POST['ds_scale']>1){
                    $this->error('折扣必须在0-1之间！');
                }
            }
            $_POST['ds_day'] = intval(($atime)/(3600*24));
            if (!isset($_GET['disid'])) {
                //				添加
                $res = $discount_spead->add($_POST);
//                echo  $discount_spead->getLastSql();exit;
				$merchant_alter=D('Merchant')->where(array('mer_id'=>$this->merchant_session['mer_id']))->setDec('money',I('ds_money'));//修改当前商户余额
            } else {
//				编辑
                $id = intval($_GET['disid']);
                $res = $discount_spead->where(array('ds_id' => $id))->save($_POST);
				$ds_money=$discount_spead->where(array('ds_id' => $id))->find();
				if(I('ds_money')>=$ds_money){	//比对修改优惠总金额与之前的优惠总金额
					$money=I('ds_money')-$ds_money['ds_money'];
					$merchant_alter=D('Merchant')->where(array('mer_id'=>$this->merchant_session['mer_id']))->setDec('money',$money);	
				}else{
					$money=$ds_money['ds_money']-I('ds_money');
					$merchant_alter=D('Merchant')->where(array('mer_id'=>$this->merchant_session['mer_id']))->setInc('money',$money);
				}
            }
            if ($res) {
                $this->success('操作成功', U('DiscountSpead/index'));
            } else {
                $this->error('操作失败');
            }
        } else {
            $now = time();
            $this->assign('point',$mer_info['point']);
            if (isset($_GET['disid'])) {
                $data = $discount_spead->where(array('ds_id'=>$_GET['disid']))->find();
                $data['statdate'] = $data['ds_beginTime'];
                $data['enddate'] = $data['ds_endTime'];
                $this->assign('disid', $_GET['disid']);	//获取id
            } else {
                $data['statdate'] = $now;
                $data['enddate'] = $now + 10 * 24 * 3600;
            }
//            dump($data);
            $this->assign('vip', $data);
			$merchant_one=D('Merchant')->where(array('mer_id'=>$this->merchant_session['mer_id']))->find();								
			$this->assign('money', $merchant_one['money']);	//获取商户余额
            $this->display();
        }

    }
    /**
     * 优惠卷的查看
     * 汪威
     * 2016.04.12
     */
    public function ds_look()
    {
        $mer_info = $this->merchant_session;
        $discount_spead = M('merchant_discount_spead');
            $now = time();
            $this->assign('point',$mer_info['point']);
            if (isset($_GET['disid'])) {
                $data = $discount_spead->where(array('ds_id'=>$_GET['disid']))->find();
                $data['statdate'] = $data['ds_beginTime'];
                $data['enddate'] = $data['ds_endTime'];
            } else {
                $data['statdate'] = $now;
                $data['enddate'] = $now + 10 * 24 * 3600;
            }
//            dump($data);
            $this->assign('vip', $data);
            $this->display();
    }
    /**
     * 优惠卷的推广删除
     * 汪威
     * 2016.04.12
     */
    public function ds_del()
    {
        $data = M('merchant_discount_spead')->where(array('ds_id'=>$_GET['itemid']))->delete();
        if ($data == false) {
            $this->error('没删除成功');
        } else {
            $this->success('操作成功', U('DiscountSpead/index'));
        }
    }
    public function ds_administration(){
        $mer_id = intval($this->merchant_session['mer_id']);
        $percent = '';
        if ($this->merchant_session['percent']) {
            $percent = $this->merchant_session['percent'];
        } elseif ($this->config['platform_get_merchant_percent']) {
            $percent = $this->config['platform_get_merchant_percent'];
        }
        $this->assign('percent', $percent);
        $merchant = D('Merchant')->field(true)->where('mer_id=' . $mer_id)->find();
        $result = D("Meal_order")->get_order_id($mer_id);
//        dump($result);exit;
        $count = "";
        foreach($result['order_list'] as $ke=>$va){
            if($va['card_id']==0){
                unset($result['order_list'][$ke]);
            }else{
                $count+=$va['merchant_balance'];
            }
        }
//        dump($result);exit;
        $this->assign($result);
        $this->assign('count',$count);
        $this->assign('total_percent', $result['total'] * (100 - $percent) * 0.01);
        $this->assign('all_total_percent', ($result['alltotal'] + $result['alltotalfinsh']) * (100 - $percent) * 0.01);
        $this->assign('now_merchant', $merchant);
        $this->assign('mer_id', $mer_id);
        $this->display();
    }

}
?>