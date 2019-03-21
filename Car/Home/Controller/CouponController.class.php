<?php
namespace Home\Controller;

use Home\Model\CarModel;
use Home\Model\CouponModel;
use Think\Controller;

class CouponController extends BaseController
{
    /**
     * 用户扫码后跳转到的领取优惠卷页
     * @update-time: 2017-03-17 09:33:02
     * @author: 王亚雄
     */
    public function show_coupon($coupon_secret){

        //解密后，得到数组
        $arr = think_decrypt($coupon_secret, CRYPT_KEY_COUPON);
        $act_id = $arr['act_id'];
        $timestamp = $arr['timestamp'];//此时间戳可再次用于限制优惠卷的有效时间

        //如果解密后得不到act_id;
        if(!$act_id){
            $this->error('coupon_secret 解析错误！');
        }

        //视图数据
        $model = new CouponModel();
        $act_info = $model->act_info($act_id);
        $this->assign('act_info',$act_info);

        //获取用户车辆信息
        $user_id = session('user_id');
        $car_model = new CarModel();
        //组装数据给前台js使用
        $user_cars = $car_model->get_cars($user_id);
        $tmp = array();
        foreach($user_cars as $key => $row){
            $tmp[] = array(
                'title'=>$row,
                'value'=>$key,
            );
        }
        $user_cars = json_encode($tmp);
        $this->assign('user_cars',$user_cars);//传给js使用

        if (session('coupon.act_id')) {//用户是否有领取优惠券权限

            $this->display();

        } else {
            //用户扫码后
            if ($arr['act_id'] && G1($coupon_secret)) {//验证该加密信息是否被使用过一次
                //用户获取领取优惠卷权限
                session('coupon.act_id', 1);
                $this->display();

            } else {

                $this->error("此优惠卷已被领取或已过期！");
            }
        }


    }






    /**
     * 异步领取优惠卷方法
     * @param $act_id 优惠活动表id
     * @update-time: 2017-03-16 17:54:06
     * @author: 王亚雄
     */
    public function get_coupon($act_id,$car_no=""){



        $model = new CouponModel();

        $act_info = $model->act_info($act_id);

        $shop_id = $act_info['cp_lssuer'];

        //判断是否有资格领取优惠卷
        if(!session('coupon.act_id')){
            $this->error("此优惠卷已被领取");
        }

        $time = time();

//        if($time>$act_info['act_end_time']){
//            $this->error("活动已经结束");
//        }

        //TODO::同时限制一个用户只能领一次，一辆车只能领一次，优惠券使用的时候再限制



        //数据组装

        $data = array(
            'act_id'        => $act_id,                                            //优惠活动ID
            'cp_no'         => $time . $shop_id . rand(10000, 99999) . rand(1000, 9999),   //随机生成优惠券码(时间戳+商户id+1万到9.9万的随机数+1千到0.9万随机数)
            'car_no'        => $car_no,
            'user_id'       => session('user_id'),                                 //用户ID
            'add_time'      => $time,                                              //该条数据添加时间
            'start_time'    => $act_info['act_start_time'],                        //有效时间起
            'end_time'      => $act_info['act_end_time'],                          //有效时间终
            'cp_type'       => $act_info['cp_type'],                               //优惠券类型(根据活动表数据进行维护)
            'cp_hilt'       => $act_info['cp_hilt'],                               //根据对应的活动优惠额度进行维护
            'is_public'     => '0',                                                //是否为公开，公开后用户可以绕过接口领取，默认非公开
            'is_valid'      => COUPON_STATUS_VALID,                               //是否有效，默认为 1(0为自动过期，1为未使用，2为已使用,3待审核)
            'is_del'        => 0                                                   //是否逻辑删除

        );
        //添加数据
        $num = M('coupon')->add($data);
        if ($num) {
            session('coupon.act_id',null);
            $this->success("领取优惠券成功");
        } else {
            $this->error("领取优惠券失败");
        }

    }



    /**
     * 扫码商家出示的静态二维码 领取优惠券页
     * @param $act_id
     * @update-time: 2017-03-22 14:31:08
     * @author: 王亚雄
     */
    public function show_static_coupon($act_id){
        $model = new CouponModel();

        $act_info = $model->act_info($act_id);
        //dump($act_info);
        //获取用户车辆信息
        $user_id = session('user_id');
        $car_model = new CarModel();
        //组装数据给前台js使用
        $user_cars = $car_model->get_cars($user_id);
        $tmp = array();
        foreach($user_cars as $key => $row){
            $tmp[] = array(
                'title'=>$row,
                'value'=>$key,
            );
        }
        $user_cars = json_encode($tmp);


        $this->assign('act_info',$act_info);
        $this->assign('act_id',$act_id);
        $this->assign('user_cars',$user_cars);//传给js使用
        $this->display('show_static_coupon');
    }




    /**
     * 扫码商家出示的静态二维码，后跳转的页面 ajax点击领取优惠券（待审核的）
     * @update-time: 2017-03-22 14:07:35
     * @author: 王亚雄
     */
    public function get_static_coupon($act_id,$car_no=""){
        $model = new CouponModel();
        $act_info = $model->act_info($act_id);
        $shop_id = $act_info['cp_lssuer'];
        // dump($act_info);exit();
        //TODO::限制一个用户只能领一次



        $time = time();
        $data = array(
            'act_id'        => $act_id,                                            //优惠活动ID
            'cp_no'         => $time . $shop_id . rand(10000, 99999) . rand(1000, 9999),   //随机生成优惠券码(时间戳+商户id+1万到9.9万的随机数+1千到0.9万随机数)
            'car_no'        => $car_no,
            'user_id'       => session('user_id'),                                 //用户ID
            'add_time'      => $time,                                              //该条数据添加时间
            'start_time'    => $act_info['act_start_time'],                        //有效时间起
            'end_time'      => $act_info['act_end_time'],                          //有效时间终
            'cp_type'       => $act_info['cp_type'],                               //优惠券类型(根据活动表数据进行维护)
            'cp_hilt'       => $act_info['cp_hilt'],                               //根据对应的活动优惠额度进行维护
            'is_public'     => '0',                                                //是否为公开，公开后用户可以绕过接口领取，默认非公开
            'is_valid'      => COUPON_STATUS_TOAUDIT,                             //待审核的优惠券
            'is_del'        => 0                                                   //是否逻辑删除

        );


        //添加数据
        $model->startTrans();//消息发送失败回滚
        $num = $model->add($data);
        if ($num) {
            //发送消息
            $contents = array(
                'first_value'=> "用户领取优惠券提醒",
                'keyword1_value'=>$act_info['act_name'],
                'keyword2_value'=>user_info()['user_name'],
                'keyword3_value'=>"",
                'url'=>ROOT_URL . U('CouponAdmin/audit',array('cp_id'=>$num)),
            );

            $openids = array($act_info['user_wx_opid']);

            //执行
            $ctrl = new UserController();
            $re =  $ctrl->auto_send_message($openids,$contents);

            if($re[0]['errcode']===0){
                $model->commit();
                $this->success("领取优惠券成功");
            }else{
                $model->rollback();
                $re['openid'] = $act_info['user_wx_opid'];
                $this->error("发送消息失败","",$re) ;
            }
       // $this->error("opid","",array($openids,$act_info));


        } else {
            $this->error("领取优惠券失败");
        }


    }


    /**
     * 用户查看自己所有优惠券
     * @update-time: 2017-03-30 14:37:24
     * @author: 王亚雄
     */
    public function my_coupons(){
        $model = new CouponModel();
        $list = $model->get_user_coupons();
        $this->assign('list',$list);
        $this->display();
    }


    /**
     * 用户使用优惠券，点击调到车辆管理页面而已
     * @update-time: 2017-03-30 15:12:43
     * @author: 王亚雄
     */
    public function clip_coupon($cp_id){
        $model = new CouponModel();
        $coupon_info = $model -> coupon_info($cp_id);
        //dump($coupon_info)
        $this->assign('coupon_info',$coupon_info);
        $this->display();
    }


    //前端页面的提交过来的信息进行处理
    public function village_control_checkInfo()
    {
        $this->display();
    }


    public function test(){
        get_class_methods(BaseController::class);
    }
}