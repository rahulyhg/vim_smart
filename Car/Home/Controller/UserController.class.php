<?php
namespace Home\Controller;
use Common\Model\WechatModel;
use Think\Controller;
use Home\Common\RbacController;
/*用户中心类
* @author 祝君伟
* @time 2017.2.14
* */
class UserController extends RbacController {

    protected $garage_id;
    public function __construct(){
        parent::__construct();
        $this->garage_id = $_SESSION['garage_id'];
        if(empty($this->garage_id)){
            $this->error('请选择停车场',U('car/choose_garage'));
        }
    }

    //用户中心界面
    public function user_index(){
        //dump($arr);
//        dump($_SESSION);exit;
        //根据用户的uid来拉取信息
        $uid = $_SESSION['user_id'];
        $user=new \Home\Model\UserModel();
        $user_info_array = $user->get_user_info($uid);
        if(!$user_info_array){
            $this->error('请选择停车场',U('car/choose_garage'));
        }
        if(!$user_info_array['user_t_name']||!$user_info_array['user_phone']){

            cookie('callBack_url',U('user/user_index'));

            $this->redirect('user/register');
        }
        if(isset($user_info_array['yueka_carNo'])){
            //前台如果有月卡车则算出其有多少天数剩余，不调用接口只从表里面读数据
            $car_array = M('car')->where(array('car_no'=>$user_info_array['yueka_carNo'][0]))->find();
            $how_much_day= $car_array['end_time']-time();
            /*$jieshun_api=new \Org\JieShunApi\Jieshun();
            $jieshun_return = json_decode($jieshun_api->use_api_yueka_info($user_info_array['yueka_carNo'][0]),true);
            $how_much_day = strtotime($jieshun_return['dataItems'][0]['subItems'][0]['attributes']['endTime'])-time();*/
            $how_much_day = $how_much_day/3600/24;
            $user_info_array['yueka_day']=floor($how_much_day);
        }
        $this->assign('user_info_array',$user_info_array);
        $this->display();
    }

    /**
     * 用户注册
     */
    public function register(){
        $user=new \Home\Model\UserModel();
        if(IS_POST){
            $data = $user->create();
            if(!$data['user_id']){
                $this->error('提交失败');
            }
            if(!$data['user_phone']){
                $this->error('请填写手机号');
            }
            if(!$data['user_t_name']){
                $this->error('请填写真实姓名');
            }
            $res = M('user')->save($data);

            $callBackUrl = cookie('callBack_url');

            if($res){
                $this->redirect($callBackUrl);
            }else{
                $this->redirect('car/use_service');
            }
        }else{

            //遍历所有的公司
            $company_array =$user->get_all_company();
            $this->assign('company_array',$company_array);
            $this->display();
        }

    }

    //用户————我的订单页面
    public function user_order_info(){
        //根据用户的uid来拉取信息
        $uid = $_SESSION['user_id'];
        $user=new \Home\Model\UserModel();
        $user_pay_info_array = $user->get_preson_pay_info($uid);
        $this->assign('user_pay_info_array',$user_pay_info_array);
        $this->display();
    }

    //用户---月卡充值
    public function user_yueka_recharge(){
        $uid = $_SESSION['user_id'];
        $user=new \Home\Model\UserModel();
        $user_car_array = $user->get_who_yueka_car($uid);
        if($user_car_array == 1){
            $this->error('请选择停车场',U('car/choose_garage'));
        }elseif ($user_car_array == 2){
            $this->error('您绑定的车辆里没有月卡车',U('user_index'));
        }
        //制作用户订单的UID
        $order_uid = sprintf("%04d",$uid);
        $this->assign('order_uid',$order_uid);
        $this->assign('uid',$uid);
        $this->assign('user_car_array',$user_car_array);
        $this->display();
    }

    //新开卡用户信息表单页
    public function new_user_info(){
        $this->error('月卡线上开通功能暂时关闭，敬请谅解！',U('user_index'));
        //遍历出用户名下所绑定的车牌
        $uid = $_SESSION['user_id'];
//        if($uid!=424&&$uid!=2203) {//TODO::测试 记得删除
//            echo "系统升级中..";exit();
//        }
        $user=new \Home\Model\UserModel();
        $old_user = $user->where(array('user_id'=>$uid))->find();

        //获取用户公司信息 根据openid在user_bind 表中获取公司相关信息
        //@update-time: 2018-02-02 16:02:06
        //@author: 王亚雄
        $company_info = M('house_village_user_bind','pigcms_')
            ->alias('ub')
            ->join('join pigcms_user u on u.uid = ub.uid')
            ->field(array(
                'pigcms_id'=>'user_bind_id',
                'ub.company'=>'user_commpany',
                'ub.card_type',
                'ub.id_card'=>'card_number',
            ))
            ->where('u.openid="%s"',$old_user['user_wx_opid'])
            ->find();
        $old_user = array_merge($old_user,$company_info);
        //获取用户公司信息 结束

        if(isset($old_user['user_t_name'])){
            $this->assign('old_user',$old_user);
        }
        $user_car_array = $user->get_who_car($uid);
        if(!$user_car_array){
            $this->error('请选择停车场',U('car/choose_garage'));
        }
        //制作用户订单的UID
        $order_uid = sprintf("%04d",$uid);
        //遍历所有的公司
        $company_array =$user->get_all_company();
        //制作价格列表
        $price_list_array = $user->get_price_list();
        if(!$price_list_array){
            $this->error('请选择停车场',U('car/choose_garage'));
        }
        $this->assign('price_list_array',$price_list_array);
        $this->assign('user_car_array',$user_car_array);
        $this->assign('order_uid',$order_uid);
        $this->assign('company_array',$company_array);
        $this->assign('uid',$uid);
        $this->display();
    }


    //新开卡用户填写的表单提交位置
    public function do_post_info(){
        //dump($_POST['user_phone']);exit;
        //传递进来的POST值入库
        if(IS_POST){
            $user=new \Home\Model\UserModel();
            $yueka_info = $_POST;
            $result_code = $user->user_info_add_bank($yueka_info);
            if($result_code){
                //插入数据库后向微信发推送消息
                $yueka_info['first_value']="新用户开卡提醒";
                $yueka_info['keyword1_value']="月卡开卡申请";
                $yueka_info['keyword2_value']=$yueka_info['user_t_name'];
                $yueka_info['keyword3_value']=$yueka_info['user_t_name']."的开卡申请";
                $yueka_info['yukepay_id']=session('yueka_pay_id');
                //$yueka_info['yukepay_id']=15; // 测试
                //先给方法做数据准备
                //向客服审核表中增加一条新数据
                $check_result = $user->insert_to_check($yueka_info);
                $yueka_info['url']=C("WEB_DOMAIN").'/index.php?m=Home&c=User&a=service_ask&pay_id='.$yueka_info['yukepay_id'].'&check_id='.$check_result.'&car_no='.$yueka_info['car_no'].'&garage_id='.session('garage_id');
                $admin_user = $user->make_admin_info();//TODO 未设置推送管理员

                $admin_user = array("ohgcf0jY6c8Rnj8hgkJw8mcVpOR8"); //TODO::测试记得删除


                $dose_not_send = $this->auto_send_message2($admin_user,$yueka_info);
                //dump($dose_not_send[0]['errmsg']);
                if($dose_not_send[0]['errmsg']=='ok'){
                    //发送成功！
                    echo '1';
                }else{
                    //消息发送失败错误编号0006
                    echo '0006';
                }
            }else{
                //维护本地数据库失败 错误编号0005
                echo '0005';
            }
        }else{
            //非法的post值， 错误编号0007
            echo '0007';
        }
    }

    /*
     * 核心方法————月卡支付方法(新开月卡)
     * @author 祝君伟
     * @time 2017.2.16
     * */
    public function yueka_pay_now(){
        $this->error('月卡线上开通功能暂时关闭，敬请谅解！',U('user_index'));
        //查询当前开通的停车场
        $garage_id = session('garage_id');
        if(empty($garage_id)){
            echo json_encode(3);exit;//没有选择停车场id
        }
        $garage_array = M('garage')->where(array('garage_id'=>$garage_id))->find();
        $order_name=$garage_array['garage_name'].'月卡费用';
        $order_no=I('post.order_no');    //订单编号
        $car_no=I('post.car_no');  //车牌号
        $total_fee=I('post.total_fee'); //总费用(仅供用户参考，不作为最终的支付数据)
        $user_id=I('post.user_id');
        $how_log=I('post.how_log');
        $space_type=I('post.space_type');
        $start_date = I('post.start_date');
        $now_time_for_log = time();

        //创建订单，维护本地数据
        $order_add_data = array(
            'user_id'=>$user_id,
            'payment'=>$total_fee,
            'car_no'=>$car_no,
            'how_long'=>$how_log,
            'create_time'=>$now_time_for_log,
            'pay_type'=>1,
            'order_no'=>$order_no,
            'garage_id'=>$garage_id,
            'space_type'=>$space_type,
            'start_time'=>strtotime($start_date)
        );
        //维护本地数据库（插入）
        $add_result = M('yueka_payrecord')->add($order_add_data);
        session('yueka_pay_id',$add_result);
        if(!$add_result){
            echo json_encode(2);exit;//插入数据库失败0001
        }
        $total_fee = 0.01; //TODO::测试

        //实例化微信类
        $weixin=new \Org\Weixinpay\Weixinpay( array('order_name'=>$order_name,'order_id'=>$order_no),'', array('openid'=>session('wx_openid')) );
        //读取调试配置信息
        $test_pay = M('config')->where(array('name'=>'test_pay'))->find();
        if($test_pay['value'] == 1){
            $test_money = M('config')->where(array('name'=>'test_money'))->find();
            $weixinpay_recode=$weixin->mobile_pay('/weixin_pay_callback.php',floatval($test_money['value']));
        }else{
            $weixinpay_recode=$weixin->mobile_pay('/weixin_pay_callback.php',$total_fee);
        }

        if($weixinpay_recode['error']==0){
            $wx_ready_pay_arr=array(
                'wx_pay'=>'1',
                'vals'=>$weixinpay_recode['weixin_param']
            );
            echo json_encode($wx_ready_pay_arr);
        }else{
            echo json_encode(1);    //支付失败，微信没有任何信息返回 错误编码0008
        }
    }

    /*
     * 核心方法————微信发送推送消息
     * 祝君伟
     * @time 2017.2.17
     * ags1 array 接受人的openid所组成的数据
     * ags2 array 消息模板所组成的关联数组
     * return 成功或失败
     * @waring 参数一必须传入有效的openid
     * */
    public function auto_send_message($admin_user,$yueka_info,$tempid){
        //制作本地推送内容
        foreach ($admin_user as $value){//
            $time = time();
            $href = $yueka_info['url'];
            $data=array(
                'touser'=>$value,
                'template_id'=>$tempid?:WXMSG_TPL_SPTX,
                'url'=>$href,
                'data'=>array(
                    'first'=>array(
                        'value'=>urlencode($yueka_info['first_value']),
                        'color'=>"#029700",
                    ),
                    'keyword1'=>array(
                        'value'=>urlencode($yueka_info['keyword1_value']),
                        'color'=>"#000000",
                    ),
                    'keyword2'=>array(
                        'value'=>urlencode($yueka_info['keyword2_value']),
                        'color'=>"#000000",
                    ),
                    'keyword3'=>array(
                        'value'=>urlencode($yueka_info['keyword3_value']),
                        'color'=>"#000000",
                    ),
                    'keyword4'=>array(
                        'value'=>urlencode(date('Y-m-d H:i:s',$time)),
                        'color'=>"#000000",
                    ),
                )
            );
            $weixin=new \Org\Weixinpay\Weixinpay();
            $res[] = $weixin->send_template_message(urldecode(json_encode($data)));
        }
        return $res;
    }

    /*
    *  功能与auto_send_message相同，遇到errcode40001 自动刷新token 再次进行发送
     * @update-time: 2018-02-02 15:02:59
     @author: 王亚雄
    * */
    public function auto_send_message2($admin_user,$yueka_info,$tempid=""){
        $model = new WechatModel();
        $data = array(
            'first'=>array(
                'value'=>$yueka_info['first_value'],
                'color'=>"#029700",
            ),
            'keyword1'=>array(
                'value'=>$yueka_info['keyword1_value'],
                'color'=>"#000000",
            ),
            'keyword2'=>array(
                'value'=>$yueka_info['keyword2_value'],
                'color'=>"#000000",
            ),
            'keyword3'=>array(
                'value'=>$yueka_info['keyword3_value'],
                'color'=>"#000000",
            ),
            'keyword4'=>array(
                'value'=>date('Y-m-d H:i:s',time()),
                'color'=>"#000000",
            ),
        );
        $res = $model->send_tpl_messages(
            $admin_user,
            $tempid?:$model::TPLID_LCSPTX,
            $yueka_info['url'],
            $data
        );
        return $res;
    }

    /*
     * 退款模板
     */
    public function refund_message($admin_user,$yueka_info){
        //制作本地推送内容
        foreach ($admin_user as $value){
            $href = $yueka_info['url'];
            $data=array(
                'touser'=>$value,
                'template_id'=>"RNSDxboHz27xeeN5l0EJ2ufCqAdzy2SawXXi8rQ1fss",
                'url'=>$href,
                'data'=>array(
                    'first'=>array(
                        'value'=>urlencode($yueka_info['first_value']),
                        'color'=>"#029700",
                    ),
                    'reason'=>array(
                        'value'=>urlencode($yueka_info['reason']),
                        'color'=>"#000000",
                    ),
                    'refund'=>array(
                        'value'=>urlencode($yueka_info['refund']),
                        'color'=>"#000000",
                    ),
                )
            );
            $weixin=new \Org\Weixinpay\Weixinpay();
            $res[] = $weixin->send_template_message(urldecode(json_encode($data)));
        }
        return $res;
    }


    /*
     * 退款成功通知模板
     */
    public function refund_success_message($admin_user,$yueka_info){
        //制作本地推送内容
        foreach ($admin_user as $value){
            $href = $yueka_info['url'];
            $time=time();
            $data=array(
                'touser'=>$value,
                'template_id'=>"X8Lxr1sGl8_kcli3VQG9D7ZDS0-sBBp8GaPVFEObsQ0",
                'url'=>$href,
                'data'=>array(
                    'first'=>array(
                        'value'=>urlencode($yueka_info['first_value']),
                        'color'=>"#029700",
                    ),
                    'keyword1'=>array(
                        'value'=>urlencode($yueka_info['keyword1_value']),
                        'color'=>"#000000",
                    ),
                    'keyword2'=>array(
                        'value'=>urlencode($yueka_info['keyword2_value']),
                        'color'=>"#000000",
                    ),
                    'keyword3'=>array(
                        'value'=>urlencode(date('Y-m-d H:i:s',$time)),
                        'color'=>"#000000",
                    ),
                )
            );
            $weixin=new \Org\Weixinpay\Weixinpay();
            $res[] = $weixin->send_template_message(urldecode(json_encode($data)));
        }
        return $res;
    }



    /*
     * 客服人员审核页面
     * */
    public function service_ask(){
        $pay_id=I('get.pay_id');
        $car_no=I('get.car_no');
        $garage_id = session('garage_id');
        $state=I('get.state');
        if($state==1){
            $car_no = $this->jieshu_plate($car_no);
        }
        //跟据$user_id 来拉取用户的信息
        $user=new \Home\Model\UserModel();
        $user_info = $user->select_user_info($pay_id,$car_no);
        $user_info[0]['garage_id'] = $garage_id;
        //dump($user_info);exit;
        //根据当前session来拉去当前的客服user_id
        $admin_info = $user->get_admin_info(array('user_wx_opid'=>$_SESSION['openid']));
        //dump($user_info);
        $this->assign('admin_info',$admin_info);
        $this->assign('user_info',$user_info[0]);
        $this->display();
    }

    /*
     * 开卡流程显示（用户端）
     * */
    public function user_show_list(){
        $uid = $_SESSION['user_id'];
        $user_array=M('user')->where(array('user_id'=>$uid))->find();
        $user_show_array = M('check_record')->where(array('check_user'=>$user_array['user_t_name']))->select();
        $this->assign('user_show_array',$user_show_array);
        $this->display();
    }

    /*
     * 开卡流程显示（客服端）
     * */
    public function admin_show_list(){
        $uid = $_SESSION['user_id'];
        //拉取所有的新用户开卡信息
        $user = new \Home\Model\UserModel();
        $is_sever=$user->is_user_of_admin($uid);
        //dump($is_sever);exit;
        if($is_sever){
            $all_info_array=$user->person_show_list($uid,0);
            $nopass_array=$user->person_show_list($uid,1);
            $pass_array = $user->person_show_list($uid,2);
        }else{
            //客服显示页
            $all_info_array = $user->get_all_show_list();
            $nopass_array = $user->make_magic_sql(1);
            $pass_array = $user->make_magic_sql(2);

        }
        //dump($all_info_array);exit;
        foreach ($all_info_array as &$value){
            $value['car_no']=$this->normal_plate($value['car_no']);
            $value['car_nos']=explode(",",$value['car_nos']);
            $value['car_nos'] =$this->normal_plate($value['car_nos'][0]);
        }
        foreach ($pass_array as &$value1){
            $value1['car_no']=$this->normal_plate($value1['car_no']);
            $value1['car_nos']=explode(",",$value1['car_nos']);
            $value1['car_nos'] =$this->normal_plate($value1['car_nos'][0]);
        }
        foreach ($nopass_array as &$value2){
            $value2['car_no']=$this->normal_plate($value2['car_no']);
            $value2['car_nos']=explode(",",$value2['car_nos']);
            $value2['car_nos'] =$this->normal_plate($value2['car_nos'][0]);
        }
        unset($value);
        unset($value1);
        unset($value2);
        $this->assign('all_info_array',array_reverse($all_info_array));
        $this->assign('pass_array',array_reverse($pass_array));
        $this->assign('nopass_array',array_reverse($nopass_array));
        $this->display();
    }

    /*
     * 开卡流程显示（手机端后台管理）
     * */
    public function admin_show_list_all(){
        $uid = $_SESSION['user_id'];
        //拉取所有的新用户开卡信息
        $user = new \Home\Model\UserModel();
//        $is_sever=$user->is_user_of_admin($uid);
        //dump($is_sever);exit;
        $is_sever = 0;
//        dump(1);exit;
        if($is_sever){
            $all_info_array=$user->person_show_list($uid,0);
            $nopass_array=$user->person_show_list($uid,1);
            $pass_array = $user->person_show_list($uid,2);
        }else{
            //客服显示页
            $all_info_array = $user->get_all_show_list();
            $nopass_array = $user->make_magic_sql(1);
            $pass_array = $user->make_magic_sql(2);

        }
        //dump($all_info_array);exit;
        foreach ($all_info_array as &$value){
            $value['car_no']=$this->normal_plate($value['car_no']);
            $value['car_nos']=explode(",",$value['car_nos']);
            $value['car_nos'] =$this->normal_plate($value['car_nos'][0]);
        }
        foreach ($pass_array as &$value1){
            $value1['car_no']=$this->normal_plate($value1['car_no']);
            $value1['car_nos']=explode(",",$value1['car_nos']);
            $value1['car_nos'] =$this->normal_plate($value1['car_nos'][0]);
        }
        foreach ($nopass_array as &$value2){
            $value2['car_no']=$this->normal_plate($value2['car_no']);
            $value2['car_nos']=explode(",",$value2['car_nos']);
            $value2['car_nos'] =$this->normal_plate($value2['car_nos'][0]);
        }
        unset($value);
        unset($value1);
        unset($value2);
        $this->assign('all_info_array',array_reverse($all_info_array));
        $this->assign('pass_array',array_reverse($pass_array));
        $this->assign('nopass_array',array_reverse($nopass_array));
        $this->display();
    }

    /*
     * 判断当前的审核信息有没有人已经审核完毕
     * */
    public function is_have_admin_check(){
        $check_id = I('post.check_id');
        $is_have = M('check_record')->where(array('check_id'=>$check_id))->find();
        if($is_have['check_state']==0){
            echo 1;
        }else{
            echo 2;
        }
    }

    /*
     * 三重验证，改变车辆基本信息，变为月卡车
     * */
    public function change_car_yue(){
        $car_no=I('post.car_no');
        $user_id=I('post.user_id');
        $how_long=I('post.how_long');
        $check_id=I('post.check_id');
        $admin_id=I('post.admin_id');
        $start_time = time();
        $end_time = time()+$how_long*30*24*3600;
        $garage_id = I('post.garage_id');
        if(empty($garage_id)){
            echo 3;
        }
        $result_code = M('car')->where(array('car_no'=>$car_no,'garage_id'=>$garage_id))->data(array('car_role'=>'1','start_time'=>$start_time,'end_time'=>$end_time))->save();
        $check_code = M('check_record')->where(array('check_id'=>$check_id))->data(array('admin_id'=>$admin_id,'check_process_time'=>$start_time,'check_state'=>1))->save();
        if($result_code&&$check_code){
            //开卡成功，推送给用户成功信息
            $person_info =array(
                'url'=>C("WEB_DOMAIN").'/index.php?m=Home&c=Car&a=use_service',
                'first_value'=>'新用户开卡情况提醒',
                'keyword1_value'=>'新用户开卡成功！',
                'keyword2_value'=>'已经成功为车牌号为'.$car_no.'的车开通月卡！',
                'keyword3_value'=>'有任何问题请致电技术人员解决 TEL:027-87779655'
            );
            $user_openid_array = M('user')->where(array('user_id'=>$user_id))->find();
            $admin_user = array(
                '0'=>$user_openid_array['user_wx_opid']
            );
            $dose_not_send=$this->auto_send_message($admin_user,$person_info);
            if($dose_not_send[0]['errmsg']=='ok'){
                //发送成功！
                echo '1';
            }else{
                //消息发送失败错误编号0006
                echo '0006';
            }
        }else{
            echo 2;
        }
    }

    /*
     * 拼接续费日期信息计算出价格并返回给前台
     * */
    public function count_day(){
        $start_time = I('post.start_time');
        $end_time = I('post.end_time');
        $start_time =$this->special_date_to_time($start_time);
        //$end_time=$this->special_date_to_time('2017年2月24日')1;
        $how_day = strtotime($end_time)-$start_time;
        $how_day = ceil($how_day/3600/24);
        $how_much_money = $how_day*87;
        echo $how_much_money;
    }

    /*
    * 核心方法————月卡支付方法(续费月卡)
    * @author 祝君伟
    * @time 2017.2.16
    * */
    public function yueka_old_pay(){
        //查询当前开通的停车场
        $garage_id = session('garage_id');
        if(empty($garage_id)){
            echo json_encode(3);exit;//没有选择停车场id
        }
        $garage_array = M('garage')->where(array('garage_id'=>$garage_id))->find();
        $order_name=$garage_array['garage_name'].'月卡费用';
        $order_no=I('post.order_no');    //订单编号
        $car_no=I('post.car_no');  //车牌号
        $total_fee=I('post.total_fee'); //总费用(仅供用户参考，不作为最终的支付数据)
        $user_id=I('post.user_id');
        $end_time=I('post.end_time');
        $now_time_for_log = time();
        //对特殊字段进行计算后入库
        $how_much_day = $total_fee/2585;
        $how_much_day=$how_much_day*30;
        $how_much_day=ceil($how_much_day);
        //创建订单，维护本地数据
        $order_add_data = array(
            'user_id'=>$user_id,
            'payment'=>$total_fee,
            'car_no'=>$car_no,
            'how_long'=>$end_time,
            'pay_type'=>2,
            'create_time'=>$now_time_for_log,
            'order_no'=>$order_no
        );
        //维护本地数据库（插入）
        $add_result = M('yueka_payrecord')->add($order_add_data);
        //session('yueka_renew_id',$add_result);
        if(!$add_result){
            echo json_encode(2);exit;//插入数据库失败0001
        }

        //实例化微信类
        $weixin=new \Org\Weixinpay\Weixinpay( array('order_name'=>$order_name,'order_id'=>$order_no),'', array('openid'=>session('wx_openid')) );
        //读取调试配置信息
        $test_pay = M('config')->where(array('name'=>'test_pay'))->find();
        if($test_pay['value'] == 1){
            $test_money = M('config')->where(array('name'=>'test_money'))->find();
            $weixinpay_recode=$weixin->mobile_pay('/weixin_pay_callback.php',floatval($test_money['value']));
        }else{
            $weixinpay_recode=$weixin->mobile_pay('/weixin_pay_callback.php',$total_fee);
        }

        if($weixinpay_recode['error']==0){
            $wx_ready_pay_arr=array(
                'wx_pay'=>'1',
                'vals'=>$weixinpay_recode['weixin_param']
            );
            echo json_encode($wx_ready_pay_arr);
        }else{
            echo json_encode(1);    //支付失败，微信没有任何信息返回 错误编码0008
        }
    }

    /*
     * 获得月卡车的到期时间
     *for ajax
     * */
    public function get_car_time(){
        $car_no = I('post.car_no');
        //$car_no ='鄂-A7F497';
        $start_time =M('car')->where(array('car_no'=>$car_no))->find();
        $time_of_loca = date('Y年n月d日',$start_time['end_time']);
        echo $time_of_loca;
    }

    /*
     * 月卡续费完成后的post处理逻辑
     * */
    public function do_renew_car(){
        //为了确保订单的有效性，把捷顺通知续费月卡的步骤放到微信回调中
        //查询定单状态看是否成功然后通知用户
        if(IS_POST){
            $end_time = $_POST['end_time'];
            $garage_id = session('garage_id');
            if(empty($garage_id)){
                //没有停车场信息
                echo '1325';
            }
            $car_array=M('car')->where(array('car_no'=>$_POST['car_no'],'garage_id'=>$garage_id))->find();
            if(strtotime($end_time) == $car_array['end_time']){
                //延期成功，推送给用户成功信息
                $person_info =array(
                    'url'=>C("WEB_DOMAIN").'/index.php?m=Home&c=Car&a=use_service',
                    'first_value'=>'月卡续费情况提醒',
                    'keyword1_value'=>'月卡续费成功！',
                    'keyword2_value'=>'车牌号为'.$_POST['car_no'].'的月卡续费成功了！',
                    'keyword3_value'=>'有任何问题请致电技术人员解决 TEL:027-87779655'
                );
                //给方法做数据准备
                $user=new \Home\Model\UserModel();
                $admin_user = $user->make_user_openid($_POST['user_id'],$_POST['user_phone']);
                $dose_not_send=$this->auto_send_message($admin_user,$person_info);
                if($dose_not_send[0]['errmsg']=='ok'){
                    //发送成功！
                    echo '1';
                }else{
                    //消息发送失败错误编号0006
                    echo '0006:';
                    echo $dose_not_send[0]['errmsg'];
                }
            }else{
                //延期失败，推送给用户失败信息，（测试信息，正式环境删掉）
                $person_info =array(
                    'url'=>C("WEB_DOMAIN").'/index.php?m=Home&c=User&a=user_index',
                    'first_value'=>'月卡续费情况提醒',
                    'keyword1_value'=>'月卡续费失败！',
                    'keyword2_value'=>'车牌号为'.$_POST['car_no'].'的月卡续费失败了！',
                    'keyword3_value'=>'有任何问题请致电技术人员解决 TEL:027-87779655'
                );
                //给方法做数据准备
                $user=new \Home\Model\UserModel();
                $admin_user = $user->make_user_openid($_POST['user_id'],$_POST['user_phone']);
                $dose_not_send=$this->auto_send_message($admin_user,$person_info);
                if($dose_not_send[0]['errmsg']=='ok'){
                    //发送成功！，但续费失败，错误编码0010，业务逻辑出错
                    echo '0010';
                }else{
                    //消息发送失败错误编号0006
                    echo '0006';
                }
            }
        }else{
            //非法的post值， 错误编号0007
            echo '0007';
        }

    }


    /*
     * 验证用户手机号码，是否存在于user表中
     * for ajax
     * */
    public function check_user_phone(){
        $user_phone = I('post.user_phone');
        $result_totel = M('user')->where(array('user_phone'=>$user_phone))->find();
        if($result_totel){
            echo '1';
        }else{
            echo '2';
        }
    }


    /*
   * 退款审核页面
   * 陈琦
   * 2017.2.24
   */
    public function refund_check(){
        $pay_id=I('get.pay_id');
        $workman=I('get.workman');//操作人员
        $openid=I('get.openid');
        $car_no=I('get.car_no');//车牌号
        $fee=I('get.fee');//退款金额
        $reason=I('get.reason');//退款理由
        $time=I('get.time');//退款时间
        $refund_arr=array(
            'pay_id'=>$pay_id,
            'workman'=>$workman,
            'car_no'=>$car_no,
            'fee'=>$fee,
            'reason'=>$reason,
            'time'=>$time,
            'openid'=>$openid
        );
//        dump($refund_arr);exit;
        $this->assign('refund_arr',$refund_arr);
        $this->display();
    }


    /*
     * 确认退款、通知值班人员和用户处理
     * 陈琦
     * 2017.2.24
     */
    public function car_refund(){
        $pay_id=I('post.pay_id');
        $info=M('payrecord')->where(array('pay_id'=>$pay_id))->find();//该笔订单信息
        $pay_no=$info['pay_no'];//支付流水号
        $fee=I('post.fee');//退款金额
        $user_id=M('payrecord')->where(array('pay_id'=>$pay_id))->getField('user_id');
        $user_info=M('user')->where(array('user_id'=>$user_id))->find();
        $user_openid=array('0'=>$user_info['user_wx_opid']);//用户的openid，以数组形式传给发送消息的方法
        $openid=I('post.openid');
        if(strlen($openid)<10){//电脑端申请退款
            $ad_info=M('admin')->where(array('ad_id'=>$openid))->field('ad_uid')->select();
            $string='';
            foreach ($ad_info as $k=>$v){
                $string=$v['ad_uid'];
            }
            $all_uid=explode(',',$string);//当前所有值班人员
            $admin_openid_array=array();
            foreach ($all_uid as $v){
                $work_info =M('user')->where(array('user_id'=>$v))->find();
                $admin_openid_array[]=$work_info['user_wx_opid'];
            }
            $send_id=array_filter($admin_openid_array);//过滤掉空值
        }else{//手机端申请退款
            $send_id=array('0'=>$openid);
        }
        $car_no=I('post.car_no');
        $time=time();
        $message1 =array(
            'url'=>C("WEB_DOMAIN").'/index.php?m=Home&c=User&a=refund_success&fee='.$fee.'&pay_no='.$pay_no.'&time='.$time.'&car_no='.$car_no,
            'first_value'=>'退款成功通知！',
            'keyword1_value'=>$pay_no,
            'keyword2_value'=>$user_info['user_wxnik'].'  '.$car_no,
        );
        $reason=I('post.reason');
        $message2 =array(
            'url'=>C("WEB_DOMAIN").'/index.php?m=Home&c=User&a=refund_success&fee='.$fee.'&pay_no='.$pay_no.'&time='.$time.'&car_no='.$car_no,
            'first_value'=>'退款审批提醒',
            'reason'=>$reason,//退款原因
            'refund'=>$fee.'元',//退款金额
        );
        $res1=$this->refund_success_message($send_id,$message1);//这里是推送给值班人员，另外要加推送给用户的代码
        // $res2=$this->refund_message($user_openid,$message2);//推送给用户
        echo json_encode(array('error'=>0));exit;
        $weixin=new \Org\Weixinpay\Weixinpay(array('order_id'=>$pay_no),'','');
        $refund_no=date('YmdHis').rand(111,999).$pay_id;
        $arr=$weixin->refund($refund_no,$fee);
        echo json_encode($arr);
    }


    /*
     * 成功退款通知页面
     * 陈琦
     * 2017.2.27
     */
    public function refund_success(){
        $car_no=I('get.car_no');//车牌号
        $fee=I('get.fee');//退款金额
        $pay_no=I('get.pay_no');//支付单号
        $time=I('get.time');
        $arr=array('fee'=>$fee,'pay_no'=>$pay_no,'time'=>$time,'car_no'=>$car_no);
        $this->assign('arr',$arr);
        $this->display();
    }


    /**
     * 线下支付停车费
     * @author 祝君伟
     * @time 二〇一八年二月二十六日 10:21:53
     */
    public function outLinkPay()
    {

        $model = new \Home\Model\UserModel();

        $res = $model->O2O_checkAdmin();

        if($res)
        {

            $duty = $model->check_duty();

            $res['duty'] = $duty;

            $this->assign('info',$res);

            $this->display();

        }else{
            $this->error('你没有权限');
        }

    }




/*******************************************************工具方法****************************************************/

    /*
     * 工具方法：特定的字符串转换位时间戳
     * */
    public function special_str_to_time($data){
        $bengin_str = preg_replace("/\s|　/","",$data);
        $day = mb_substr($bengin_str,0,2);
        //$min = mb_substr($bengin_str,-5,5);
        $year = mb_substr($bengin_str,-10,4);
        preg_match_all("/[\x{4e00}-\x{9fa5}]+/u",$bengin_str,$math);
        $mon = '';
        if($math[0][0]=='一月'){
            $mon='1';
        }else if($math[0][0]=='二月'){
            $mon='2';
        }else if($math[0][0]=='三月'){
            $mon='3';
        }else if($math[0][0]=='四月'){
            $mon='4';
        }else if($math[0][0]=='五月'){
            $mon='5';
        }else if($math[0][0]=='六月'){
            $mon='6';
        }else if($math[0][0]=='七月'){
            $mon='7';
        }else if($math[0][0]=='八月'){
            $mon='8';
        }else if($math[0][0]=='九月'){
            $mon='9';
        }else if($math[0][0]=='十月'){
            $mon='10';
        }else if($math[0][0]=='十一月'){
            $mon='11';
        }else if($math[0][0]=='十二月'){
            $mon='12';
        }
        $end_time = strtotime($year.'-'.$mon.'-'.$day.' 00:00:00');
        return $end_time;
    }

    /*
     * 工具方法：将特殊的时间格式替换为正常的时间格式
     * */
    public function special_date_to_time($date){
        $date = preg_replace("/[\x{4e00}-\x{9fa5}]+/u","-",$date);
        $date = substr($date,0,-1);
        $date=strtotime($date);
        return $date;
    }

    /*工具方法：车牌人类视觉习惯显示
     * @author 祝君伟
     * @time 2017.2.10
     * */
    public function normal_plate($car_no_array){
        $user_view_car_no=str_replace('-','',$car_no_array);
        $car_no_pre=mb_substr($user_view_car_no,0,2,'utf-8');
        $car_no_after=mb_substr($user_view_car_no,2,6,'utf-8');
        $user_view_car_no=$car_no_pre.'-'.$car_no_after;
        $user_view_car_no=strtoupper($user_view_car_no);
        return $user_view_car_no;
    }

    /*工具方法：车牌适应捷顺接口规则方法
     *@author 祝君伟
     * @time 2017.2.10
     * */
    public function jieshu_plate($car_no_array){
        $user_view_car_no=str_replace('-','',$car_no_array);
        $car_no_pre=mb_substr($user_view_car_no,0,1,'utf-8');
        $car_no_after=mb_substr($user_view_car_no,1,6,'utf-8');
        $user_view_car_no=$car_no_pre.'-'.$car_no_after;
        $user_view_car_no=strtoupper($user_view_car_no);
        return $user_view_car_no;
    }



    
}