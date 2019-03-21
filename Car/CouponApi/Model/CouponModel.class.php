<?php
namespace CouponApi\Model;
use Think\Model;

class CouponController extends Model{
    //优惠券生成【系统自动执行】
    //参数说明：活动id，商户id，用户名，车牌号，优惠券口令，获取方式
    public function cp_add($act_id,$shop_id,$user_name,$car_no,$cp_token,$get_type){

        //查询是否存在对应的活动【并且未过期】
        //①：接口
        if($get_type=='api'){
        $act_info=M('activity')->where(array('act_id'=>$act_id,'cp_lssuer'=>$shop_id))->find();}
        //②：公开形式发放
        if($get_type=='easy'){
        $act_info=M('activity')->where(array('act_id'=>$act_id,'cp_lssuer'=>$shop_id))->find();}

        //如果没有任何对应正在进行的活动，那么禁止生成优惠券
        if(!$act_info){
            //$this->error('当前没有可创建优惠请的活动或者活动与商户不匹配',U('showlist'),1);
            return 4;
        }
        //判断活动是否结束
        if($act_info['is_over']=='1' || time()>$act_info['act_end_time']){
            return 11;
        }

        //判断发放数量，如果已经超过了商家规定的上限，禁止生成优惠券
        $exists_cp_count=count($this->where(array('act_id'=>$act_id))->getField('cp_id',true));
        $top_limit=M('activity')->where(array('act_id'=>$act_id))->getField('cp_count');
        if($exists_cp_count>=$top_limit){
            return 12;
        }

        //防止同一辆车或者同一个用户多次参与同一次优惠活动

        //用户名和车牌号需要进行简单的数据制作
        if($user_name){
            $use_id=M('user')->where(array('user_name'=>$user_name))->getField('user_id');
            //如果用户不存在，返回对应的错误
            if(!$use_id){
                return 5;
            }
            $data['user_id']=$use_id;   //数据制作
            $is_have_cp=$this->where(array('user_id'=>$data['user_id'],'act_id'=>$act_id))->getField('cp_id');
            if($is_have_cp){    //已经享受过本活动优惠
                return 10;
            }

        }elseif($car_no){
            $data['car_no']=$car_no;    //数据制作
            $is_have_cp=$this->where(array('car_no'=>$car_no,'act_id'=>$act_id))->getField('cp_id');
            if($is_have_cp){    //已经享受过本活动优惠
                return 10;
            }
        }

        //校验优惠活动口令
        $cp_token_check=M('activity')->where('act_id='.$act_id)->getField('cp_token');
        if($cp_token_check){
            if($cp_token!==$cp_token_check){
                return 6;
            }
        }

        //随机生成优惠券码(时间戳+商户id+1万到9.9万的随机数+1千到0.9万随机数)
        $data['cp_no']=time().$shop_id.rand(10000,99999).rand(1000.9999);

        //生效时间和失效时间
        $data['start_time']=$act_info['act_start_time'];
        $data['end_time']=$act_info['act_end_time'];

        //优惠类型(即结算方式)
        $data['cp_type']=$act_info['cp_type'];

        //校验发行者是否合法(商户在发起活动时被平台强制管制的，禁止其优惠券进行继续发放，减少平台损失)
        if($shop_id){
            $check_shop_id=M('admin')->where(array('ad_id'=>$shop_id,'is_check'=>'1'))->getField('ad_id');
            if(!$check_shop_id){
                return 7;
            }
        }

        //优惠券单张面额
        $data['cp_hilt']=M('activity')->where('act_id='.$act_id)->getField('cp_hilt');

        //指定对应的优惠活动
        $data['act_id']=$act_id;

        //将数据插入到数据库
        $data['add_time']=time();

        $z=$this->add($data);
        if($z){
            //$this->success('优惠券添加成功！',U('showlist'),1);
            return 8;
        }else{
            //$this->error('优惠券添加失败，请检查！',U('add'),1);
            return 9;
        }
    }
}