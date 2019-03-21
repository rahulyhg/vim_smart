<?php
namespace Wxorg\Controller;
use Think\Controller;
class WxcallbackController extends Controller {

        protected $order_info;
        protected $pay_money;
        protected $pay_type;
        protected $is_mobile;
        protected $user_info;

        //$order_info为数组形式(且数据必须包含两个元素，键值分别为order_name,order_id)
        //$user_info也为数组形式（且数据必须包含openid）
        public function __construct($order_info=array(),$pay_type='',$user_info=array()){
            $this->order_info = $order_info;//订单信息 里面含有 order_id order_name order_detail
            $this->pay_type   = $pay_type;//支付方式
            //$this->is_mobile   = $is_mobile;//判断支付的方式 为2的时候为app支付，为0的时候为网页支付，为其他数字时为原生支付
            $this->config = $this->getconfig();
            //支付的配置项，最好写到你的wxpaypubconfig里面去（包含 appid appsecret mchid key site_url）
            $this->user_info  = $user_info;//用户的信息 必须有openid
            //$this->pay();
        }

        /*工具类getconfig
         * 获取表中的配置项
         *2016.11.17
         */
        protected function getconfig(){
            $m=D('config');
            $configArr = $m->field("name,value")->select();
            foreach($configArr as $key=>$value){

                $config[$value['name']] = $value['value'];

            }
            return $config;
        }

        //本控制器默认访问的方法
        public function weixin_callback(){
            //实例化wxcbModel
            $wxcb=new \Wxorg\Model\WxcallbackModel();

            $xml = file_get_contents("php://input");


            //将xml字串转为数组
            $xml_arr= json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)),true);
            //同时记下支付记录日志
            $fp= fopen('./Common/Log/WeiXin_notice/wxin_back_'.$xml_arr['out_trade_no'].'.log', 'a+');
            fwrite($fp, print_r($xml_arr, true));
            fclose($fp);

            //判断数据库是否已经存在本次数据
            $is_exists_cb_id=$wxcb->where(array('pay_record_id'=>$xml_arr['out_trade_no']))->getField('cb_id');
            if($is_exists_cb_id){
                //如果已经存在同样的数据，则直接屏蔽微信此次回调数据
                exit;
            }

            //将微信回调信息写入数据库

            //实例化微信某个类
            $wx_nt_pub = new \Org\Weixinpay\Notify_pub($this->config['pay_weixin_appid'],$this->config['pay_weixin_mchid'],$this->config['pay_weixin_key'],$this->config['pay_weixin_appsecret']);
            $wx_nt_pub->saveData($xml); //成员属性$data进行赋值

            //允许外部请求post内容写入本数据库校验签名
            if(!($wx_nt_pub->checkSign())){
                //校验失败，禁止数据入本地库
                $wx_nt_pub->setReturnParameter("return_code","FAIL");//返回状态码
                $wx_nt_pub->setReturnParameter("return_msg","签名失败");//返回信息*/
                exit;
            }else{
                $returnXml=array();
                $returnXml['return_code']='SUCCESS';
                $returnXml['result_code']='ok';
                $notice_wxin_str="<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>";
                echo $wx_nt_pub->arrayToXml($returnXml);
                echo $notice_wxin_str;
                echo "SUCCESS";
            }

            //判断微信回调信息，判断本次订单的支付情况，如果微信通知支付成功，将数据入库
            if($wx_nt_pub->data['return_code']=='SUCCESS' && $wx_nt_pub->data['result_code']=='SUCCESS'){
                //多类型支付走一个回调地址，需要分开区别入表
                $what_the_order_type = substr($xml_arr['out_trade_no'],0,1);
                if($what_the_order_type=='6'){
                    //特殊标识6是新用户开卡的操作
                    $old_order_no=substr($xml_arr['out_trade_no'],0,18);
                    //对本地订单表对应数据进行维护
                    $yuekarecord=M('yueka_payrecord');
                    //改变支付状态为成功状态，将实际支付金额维护为微信返回金额(注意：微信返回的金额单位为分)
                    $pay_ok_datas=array(
                        'pay_status'=>'1',
                        'pay_loan'=>($xml_arr['total_fee']/100),
                        'pay_time'=>time()
                    );
                    $yuekarecord->where('order_no='.$old_order_no)->setField($pay_ok_datas);
                }else if($what_the_order_type=='2'||$what_the_order_type=='5'){
                    $old_order_no=substr($xml_arr['out_trade_no'],0,19);    //还原本程序原始真实订单号
                    //特殊标识2是普通临时车进出场的标识,特殊标识5是溢价模式下的再次缴费订单
                    //读出系统配置项看是否开启了通知接口
                    $notice_api = M('config')->where(array('name'=>'notice_api'))->find();
                    //①：对本地订单表对应数据进行维护
                    $payrecord=new \Home\Model\PayrecordModel();

                    //添加积分记录 陈琦 2017.1.4
                    $user=new \Home\Model\UserModel();
                    $user_info=$user->where(array('user_wx_opid'=>$xml_arr['openid']))->find();
                    $score_update=array(
                        'score_count'=>$user_info['score_count']+($xml_arr['total_fee']/100)*($this->config['user_score_get'])
                    );
                    $user->where(array('user_wx_opid'=>$xml_arr['openid']))->setField($score_update);
                    //改变支付状态为成功状态，将实际支付金额维护为微信返回金额(注意：微信返回的金额单位为分)
                    $pay_ok_datas=array(
                        'pay_status'=>'1',
                        'pay_loan'=>($xml_arr['total_fee']/100),
                        'pay_user'=>$user_info['user_id'],
                        'pay_time'=>time()
                    );
                    //①：如果用户使用了优惠券参与部分支付
                    $payrecord_info=$payrecord->field('cp_id,serv_id')->where('pay_no='.$old_order_no)->find();
                    if($payrecord_info['cp_id']){
                        //如果有使用优惠券支付，那么在支付成功后将此优惠券设置为失效状态(已使用)
                        if(D('coupon')->where(array('cp_id'=>$payrecord_info['cp_id']))->setField(array('is_valid'=>'2'))){
                            $payrecord->where('pay_no='.$old_order_no)->setField($pay_ok_datas);
                            if($notice_api['value']==1){
                                //②：通知硬件第三方开门，同时将通知开门状态维护到对应的停车记录表
                                $jieshun_api=new \Org\JieShunApi\Jieshun();
                                //通知第三方本系统已经支付

                                $api_order_no=$payrecord->where(array('pay_no'=>$old_order_no))->getField('api_pay_no');
                                $garage_id = D('servicerecord')->where(array('serv_id'=>$payrecord_info['serv_id']))->find()['garage_id'];
                                $notice_jieshun_result=$jieshun_api->notice_api_pay_ok($api_order_no,$garage_id);
                                if($notice_jieshun_result['dataItems'][0]['attributes']['retCode']=='0'){
                                    //通知支付成功(本次订单自此时起免费期内自动抬杆)，同时维护本系统停车记录表
                                    $end_time=time()+300;   //车辆出场时间，在支付时间基础上加5分钟
                                    D('servicerecord')->where(array('serv_id'=>$payrecord_info['serv_id']))->setField(array('open_door'=>'1','end_time'=>$end_time));

                                }
                            }
                        }else{
                            //微信扣款成功，但是优惠券支付失败！将优惠券金额设置为应付金额，用户可再次使用微信支付差额，进行开门
                            //查询优惠券对应的面额,
                            $cp_hilt=D('coupon')->where(array('cp_id'=>$payrecord_info['cp_id']))->getField('cp_hilt');
                            $pay_ok_datas=array(
                                'pay_no'=>$old_order_no,
                                'payment'=>$cp_hilt //应补差额
                            );
                            $payrecord->where('pay_no='.$old_order_no)->setField($pay_ok_datas);    //部分数据回滚
                        }
                    }
                    //②：没使用优惠券
                    else{
                        //车辆缴费成功后通知捷顺开门操作
                        if($payrecord->where('pay_no='.$old_order_no)->setField($pay_ok_datas)){
                            if($notice_api['value']==1){
                                //②：通知硬件第三方开门，同时将通知开门状态维护到对应的停车记录表
                                $jieshun_api=new \Org\JieShunApi\Jieshun();
                                //通知第三方本系统已经支付
                                $api_order_no=$payrecord->where(array('pay_no'=>$old_order_no))->getField('api_pay_no');
                                $garage_id = D('servicerecord')->where(array('serv_id'=>$payrecord_info['serv_id']))->find()['garage_id'];
                                $notice_jieshun_result=$jieshun_api->notice_api_pay_ok($api_order_no,$garage_id);
                                $fp= fopen('./Common/Log/WeiXin_notice/wxin_back_'.$api_order_no.'.log', 'a+');
                                fwrite($fp,print_r($notice_jieshun_result,true));
                                fwrite($fp, '通知开门的结果是：'.$notice_jieshun_result['message']."\r\n resultCode为".$notice_jieshun_result['resultCode']."\r\n 捷顺通知开门的结果为".$notice_jieshun_result['dataItems'][0]['attributes']['retCode']);
                                fclose($fp);
                                if($notice_jieshun_result['dataItems'][0]['attributes']['retCode']=='0'){
                                    //通知支付成功(本次订单自此时起免费期内自动抬杆)，同时维护本系统停车记录表
                                    $end_time=time()+300;   //车辆出场时间，在支付时间基础上加5分钟
                                    D('servicerecord')->where(array('serv_id'=>$payrecord_info['serv_id']))->setField(array('open_door'=>'1','end_time'=>$end_time));
                                    $this->suc_advise($payrecord_info['serv_id']);
                                }else{
                                    //开门失败！！
                                    $this->warning_data_add('notice_api_pay_ok','jieshun_api','1324',$notice_jieshun_result['message'],'停车场抬杆失败',$api_order_no);
                                }
                            }
                        }
                    }
                }else if($what_the_order_type=='8'){
                    //特殊标识为8，则是老月卡用户续费操作单号
                    $old_order_no=substr($xml_arr['out_trade_no'],0,18);
                    //对本地订单表对应数据进行维护
                    $yuekarecord=M('yueka_payrecord');
                    //改变支付状态为成功状态，将实际支付金额维护为微信返回金额(注意：微信返回的金额单位为分)
                    $pay_ok_datas=array(
                        'pay_status'=>'1',
                        'pay_loan'=>($xml_arr['total_fee']/100),
                        'pay_time'=>time()
                    );
                    $yuekarecord->where('order_no='.$old_order_no)->setField($pay_ok_datas);
                    $check_result = $this->get_check_xufei($old_order_no);
                    //执行业务逻辑顺序，捷顺 >本地
                    //开始时间为当前时间减5天
                    /*$yueka_array = $yuekarecord->where('order_no='.$old_order_no)->find();
                    $newBeginDate=date("Y-m-d",strtotime("-5 day"));
                    $jieshun=new \Org\JieShunApi\Jieshun();
                    $can_no=$yueka_array['car_no'];
                    $month=0;
                    $money=0.00;
                    $newEndDate=$yueka_array['how_long'];
                    $result=$jieshun->yueka_add_time($can_no,$month,$money,$newBeginDate,$newEndDate);
                    $fp= fopen('./Common/Log/WeiXin_notice/wxin_back_'.$old_order_no.'.log', 'a+');
                    fwrite($fp,print_r($result,true));
                    fwrite($fp, '月卡续费的结果是：'.$result['message']."\r\n resultCode为".$result['resultCode']);
                    fclose($fp);
                    if($result['resultCode'] ==0){
                        //捷顺延期成功,维护本地记录表
                        M('car')->where(array('car_no'=>$yueka_array['car_no']))->data(array('end_time'=>$yueka_array['how_long']))->save();
                    }else{
                        //捷顺延期失败,记录失败的返回值和错误原因
                        $fp= fopen('./Common/Log/WeiXin_notice/yueka_problem_'.$old_order_no.'.log', 'a+');
                        fwrite($fp,print_r($result,true));
                        fwrite($fp, '月卡续费的结果是：'.$result['message']."\r\n resultCode为".$result['resultCode']);
                        fclose($fp);
                    }*/
                }



                //同时记下支付成功单号
                $fp= fopen('./Common/Log/WeiXin_notice/wxin_back_'.$xml_arr['out_trade_no'].'.log', 'a+');
                fwrite($fp, '['.$old_order_no.']');
                fclose($fp);




            }else{
                return array('error'=>1,'msg'=>'支付时发生错误!');
            }

            //数据制作
            $datas['us_opid']=$xml_arr['openid'];
            $datas['pay_record_id']=$xml_arr['out_trade_no'];
            $datas['result_code']=$xml_arr['result_code'];
            $datas['return_code']=$xml_arr['return_code'];
            $datas['wx_sign']=$xml_arr['sign'];
            $datas['time_end']=(int)$xml_arr['time_end'];
            $datas['total_fee']=floatval($xml_arr['total_fee']);
            $datas['transaction_id']=$xml_arr['transaction_id'];
            $datas['create_time']=time();

            //执行数据插入操作
            $wxcb->add($datas);
        }

    public function get_check_xufei($old_order_no) {
        $check_yuekarecord_data = M('yueka_payrecord')->where(array('order_no'=>$old_order_no))->find();
        $pay_user_id = $check_yuekarecord_data['user_id'];
        $check_user_arr = M('user')->where(array('user_id'=>$pay_user_id))->find();
        $check_user = $check_user_arr['user_t_name']?:$check_user_arr['user_wxnik'];
        $check_data = array();
        $check_data['check_title'] = "月卡延期";
        $check_data['check_type'] = 1;
        $check_data['check_state'] = 1;
        $check_data['check_user'] = $check_user;
        $check_data['yukepay_id'] = $check_yuekarecord_data['pay_id'];
        $check_data['check_request_time'] = time();
        $check_data['check_process_time'] = time();
        $check_data['garage_id'] = $check_yuekarecord_data['garage_id'];
        M('check_record')->add($check_data);
    }
    /*
      * 封装方法，处理警报流程一，入表
      * 警报反馈机制
      * */
    protected function warning_data_add($action,$control,$encode,$result,$warning_name,$warning_info){
        //根据act和con来获得系统名称
        $system_array = M()->table('pigcms_system_control')->where(array('system_act'=>$action,'system_con'=>$control))->find();
        $data = array(
            'system_id'=>$system_array['pigcms_id'],
            'warning_encoding'=>$encode,
            'warning_result'=>$result,
            'warning_name'=>$warning_name,
            'warning_info'=>$warning_info,
            'create_time'=>time()
        );
        $result_code = M()->table('pigcms_system_warning_control')->data($data)->add();
        $admin_user = explode(",",$system_array['user_wx_opid']);
        $warn_info = array(
            'first_value'=>$system_array['system_name'].'发生错误！！！',
            'keyword1_value'=>$warning_name,
            'keyword2_value'=>'用户将无法使用该系统的功能',
            'remark_value'=>'(错误编码：'.$encode.')请开发者和错误处理人员尽快查看出错位置以便解决！'
        );
        if($result_code){
            //发送消息
            $res =array();
            foreach ($admin_user as $value){//
                $time = time();
                $data=array(
                    'touser'=>$value,
                    'template_id'=>"cGt5Hgs0G2X8-5Tnft_WEEvY__lKYDymlOX46p0pDbI",
                    'data'=>array(
                        'first'=>array(
                            'value'=>urlencode($warn_info['first_value']),
                            'color'=>"#029700",
                        ),
                        'keyword1'=>array(
                            'value'=>urlencode($warn_info['keyword1_value']),
                            'color'=>"#000000",
                        ),
                        'keyword2'=>array(
                            'value'=>urlencode($warn_info['keyword2_value']),
                            'color'=>"#000000",
                        ),
                        'keyword3'=>array(
                            'value'=>urlencode(date('Y-m-d H:i:s',$time)),
                            'color'=>"#000000",
                        ),
                        'remark'=>array(
                            'value'=>urlencode($warn_info['remark_value']),
                            'color'=>"#000000",
                        ),
                    )
                );
                $weixin=new \Org\Weixinpay\Weixinpay();
                $res[] = $weixin->send_template_message(urldecode(json_encode($data)));
            }
            if($res[0]['errmsg']=='ok'){
                return true;
            }else{
                return false;
            }
        }else{
            //入库失败
            return false;
        }
    }

    //支付成功推送
    public function suc_advise($serv_id) {
        $servArr = D('servicerecord')->alias('ser')
            ->join('left join __PAYRECORD__ p on p.serv_id=ser.serv_id')
            ->join('left join __USER__ u on p.user_id=u.user_id')
            ->join('left join smart_garage g on ser.garage_id=g.garage_id')
            ->where(array('ser.serv_id'=>$serv_id))
            ->find();
        $openid = $servArr['user_wx_opid'];
//        $openid = 'ohgcf0uwR88TdPtMs7UMD2qYiOHQ';
        $url = 'http://www.hdhsmart.com/wap.php?g=Wap&c=PropertyService&a=suc_advise&serv_id=' . $serv_id;
        $tpl_id = 'LqC3nBER74fj0_va8-lrr8jQ66QU4Q_Qq6onvzSLK4k';
        $out_time = $servArr['pay_time']+5*60;
        $time = $this->timediff($servArr['start_time'],$out_time);
        $serv_info['first_value']="您在".$servArr['garage_name']."成功缴交一笔停车费";
        $serv_info['keyword1_value']=$servArr['car_no'];
        $serv_info['keyword2_value']=date('Y-m-d H:i:s',$servArr['start_time']);
        $serv_info['keyword3_value']=$time;
        $serv_info['keyword4_value']=$servArr['payment'].'元';

        $data = array(
            'touser'=>$openid,
            'template_id'=>$tpl_id,
            'url'=>$url,
            'data'=>array(
                'first'=>array(
                    'value'=>$serv_info['first_value'],
                    'color'=>"#029700",
                ),
                'keyword1'=>array(
                    'value'=>$serv_info['keyword1_value'],
                    'color'=>"#000000",
                ),
                'keyword2'=>array(
                    'value'=>$serv_info['keyword2_value'],
                    'color'=>"#000000",
                ),
                'keyword3'=>array(
                    'value'=>$serv_info['keyword3_value'],
                    'color'=>"#000000",
                ),
                'keyword4'=>array(
                    'value'=>$serv_info['keyword4_value'],
                    'color'=>"#000000",
                ),
                'remark'=>array(
                    'value'=>'缴费后15分钟内免费出场，超时将继续计算停车费用，感谢您的使用！',
                    'color'=>"#000000",
                ),
            )
        );

        $weixin=new \Org\Weixinpay\Weixinpay();
        $res = $weixin->send_template_message(urldecode(json_encode($data)));
        return $res;
    }

    //根据时间戳计算时间差
    public function timediff($begin_time,$end_time)
    {
        if($begin_time < $end_time){
            $starttime = $begin_time;
            $endtime = $end_time;
        }else{
            $starttime = $end_time;
            $endtime = $begin_time;
        }

        //计算天数
        $timediff = $endtime-$starttime;
        $days = intval($timediff/86400);
        //计算小时数
        $remain = $timediff%86400;
        $hours = intval($remain/3600);
        //计算分钟数
        $remain = $remain%3600;
        $mins = intval($remain/60);
        //计算秒数
        $secs = $remain%60;
        $time = array("day" => $days,"hour" => $hours,"min" => $mins,"sec" => $secs);
        //分钟、秒个位数时,前面加0
        if($time['sec']<10){
            $time['sec'] = '0'.$time['sec'];
        }else if($time['min']<10){
            $time['min'] = '0'.$time['min'];
        }
        if($time['day']==0 && $time['hour']!=0 && $time['min']!=0){
            $c_time=$time['hour'].'小时'.$time['min'].'分钟'.$time['sec'].'秒';
        }
        if($time['day']==0 && $time['hour']==0 && $time['min']!=0){
            $c_time=$time['min'].'分钟'.$time['sec'].'秒';
        }
        if($time['day']==0 && $time['hour']==0 && $time['min']==0){
            $c_time=$time['sec'].'秒';
        }
        if($time['day']!=0){
            $c_time=$time['day'].'天'.$time['hour'].'小时'.$time['min'].'分钟'.$time['sec'].'秒';
        }
        return $c_time;
    }
}

