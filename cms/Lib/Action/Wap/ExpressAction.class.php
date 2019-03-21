<?php
/**
 * Created by PhpStorm.
 * User: 陈琦
 * Date: 2017/5/24
 * Time: 9:48
 */
class ExpressAction extends BaseAction{


//    protected $EBusinessID = "test1288093";//快递鸟相关(测试)
//    protected $AppKey = "1137b811-396e-4b83-8a0f-4a477e429ff8";//快递鸟key(测试)
//    protected $place_ReqURL = "http://sandboxapi.kdniao.cc:8080/gateway/exterfaceInvoke.json";//快递鸟在线下单请求地址(测试)
//    protected $single_ReqURL = "http://testapi.kdniao.cc:8081/api/Eorderservice";//快递鸟电子面单请求地址(测试)

    protected $EBusinessID = "1288093";//快递鸟相关
    protected $AppKey = "c46ea816-0768-4cda-a697-86d35d535fd0";//快递鸟key
    protected $place_ReqURL = "http://api.kdniao.cc/Ebusiness/EbusinessOrderHandle.aspx";//快递鸟在线下单请求地址(正式)
    protected $single_ReqURL = "http://api.kdniao.cc/api/Eorderservice";//快递鸟电子面单请求地址(正式)


    public function test(){
        $this->display();
    }
    //快递首页
    public function  index_old(){

        $where1=array('uid'=>$this->user_session['uid'],'default_address'=>array('gt',0));
        $where2=array('uid'=>$this->user_session['uid']);
        $where3=array('uid'=>$this->user_session['uid'],'type'=>2);
        $model=M('user_adress');

        //1.查询是否存在默认地址
        $default_address=M('user')->where($where1)->find();

        if(!$_GET['adress_id'] && !$_GET['go'] && !$_GET['type']){//不存在选择地址或者提交新的地址

            //收件信息
            $get_adr=$model->where($where3)->order('adress_id desc')->find();
            session('get',$get_adr);

            //不存在默认地址
            if(empty($default_address)){
                $out_adr=$model->alias('a')
                    ->join('left join __HOUSE_VILLAGE__ b on a.village_id=b.village_id')
                    ->where('a.uid='.$this->user_session['uid'].' and a.type=1')
                    ->field('a.adress_id,a.name,a.phone,a.detail,b.village_name')
                    ->order('adress_id desc')
                    ->find();

            }else{
                $out_adr=$model->alias('a')
                    ->join('left join __HOUSE_VILLAGE__ b on a.village_id=b.village_id')
                    ->where('a.adress_id='.$default_address['default_address'])
                    ->field('a.adress_id,a.name,a.phone,a.detail,b.village_name')
                    ->find();
            }
            session('out',$out_adr);
        }elseif ($_GET['adress_id'] && $_GET['type']==1){//选择寄件地址
            $out_adr=$model->alias('a')
                ->join('left join __HOUSE_VILLAGE__ b on a.village_id=b.village_id')
                ->where('a.adress_id='.$_GET['adress_id'])
                ->field('a.adress_id,a.name,a.phone,a.detail,b.village_name')
                ->find();
            $_SESSION['out']=$out_adr;
            $get_adr=$_SESSION['get'];
        }elseif ($_GET['adress_id'] && $_GET['type']==2){//选择收件地址
            $out_adr=$_SESSION['out'];
            $get_adr=$model->where(array('adress_id'=>$_GET['adress_id']))->find();
            $_SESSION['get']=$get_adr;
        }elseif (!$_GET['adress_id'] && $_GET['go']==1 && $_GET['type']==1){//提交寄件表单
            $out_adr=$model->alias('a')
                ->join('left join __HOUSE_VILLAGE__ b on a.village_id=b.village_id')
                ->where('a.uid='.$this->user_session['uid'].' and a.type=1')
                ->field('a.adress_id,a.name,a.phone,a.detail,b.village_name')
                ->order('adress_id desc')
                ->find();
            $_SESSION['out']=$out_adr;
            $get_adr=$_SESSION['get'];
        }elseif (!$_GET['adress_id'] && $_GET['go']==1 && $_GET['type']==2){//提交收件表单
            $out_adr=$_SESSION['out'];
            $get_adr=$model->where($where3)->order('adress_id desc')->find();
            $_SESSION['get']=$get_adr;
        }
//        dump($this->user_session['uid']);
//        dump($get_adr);
//        dump($out_adr);exit;
        //查询当前用户所有地址信息
        $address=$model->where($where2)->select();
        $this->assign('out_adr',$out_adr);
        $this->assign('get_adr',$get_adr);
        $this->assign('address',$address);
        $this->display();
    }

    public function  index(){
        $openid = $_SESSION['openid'];
        $village_id = D('house_village_user_bind')->alias('bind')
            ->field(array('bind.village_id'))
            ->join('left join __USER__ u on u.uid = bind.uid')
            ->where(array('u.openid'=>$openid))
            ->find()['village_id'];
        if (!$village_id) $this->error('请先对账号进行绑定',U('House/village_list'));

        $where1=array('uid'=>$this->user_session['uid'],'default_address'=>array('gt',0));
        $where2=array('uid'=>$this->user_session['uid']);
        $where3=array('uid'=>$this->user_session['uid'],'type'=>2);
        $model=M('user_adress');

        //1.查询是否存在默认地址
        $default_address=M('user')->where($where1)->find();

        if(!$_GET['adress_id'] && !$_GET['post'] && !$_GET['type']){//不存在选择地址或者提交新的地址

            //收件信息
            $get_adr=$model->where($where3)->order('adress_id desc')->find();
            session('get',$get_adr);

            //不存在默认地址
            if(empty($default_address)){
                $out_adr=$model->alias('a')
                    ->join('left join __HOUSE_VILLAGE__ b on a.village_id=b.village_id')
                    ->where('a.uid='.$this->user_session['uid'].' and a.type=1')
                    ->field('a.adress_id,a.name,a.phone,a.detail,b.village_name')
                    ->order('adress_id desc')
                    ->find();

            }else{
                $out_adr=$model->alias('a')
                    ->join('left join __HOUSE_VILLAGE__ b on a.village_id=b.village_id')
                    ->where('a.adress_id='.$default_address['default_address'])
                    ->field('a.adress_id,a.name,a.phone,a.detail,b.village_name')
                    ->find();
            }
            session('out',$out_adr);
        }elseif ($_GET['adress_id'] && $_GET['type']==1 && !$_GET['post']){//选择寄件地址
            $out_adr=$model->alias('a')
                ->join('left join __HOUSE_VILLAGE__ b on a.village_id=b.village_id')
                ->where('a.adress_id='.$_GET['adress_id'])
                ->field('a.adress_id,a.name,a.phone,a.detail,b.village_name')
                ->find();
            $_SESSION['out']=$out_adr;
            $get_adr=$_SESSION['get'];
        }elseif ($_GET['adress_id'] && $_GET['type']==2 && !$_GET['post']){//选择收件地址
            $out_adr=$_SESSION['out'];
            $get_adr=$model->where(array('adress_id'=>$_GET['adress_id']))->find();
            $_SESSION['get']=$get_adr;
        }elseif ($_GET['adress_id'] && $_GET['post']==1 && $_GET['type']==1){//提交寄件表单
            $out_adr=$model->alias('a')
                ->join('left join __HOUSE_VILLAGE__ b on a.village_id=b.village_id')
                ->where('a.adress_id='.$_GET['adress_id'])
                ->field('a.adress_id,a.name,a.phone,a.detail,b.village_name')
                ->find();
            $_SESSION['out']=$out_adr;
            $get_adr=$_SESSION['get'];
        }elseif ($_GET['adress_id'] && $_GET['post']==1 && $_GET['type']==2){//提交收件表单
            $out_adr=$_SESSION['out'];
            $get_adr=$model->where(array('adress_id'=>$_GET['adress_id']))->find();
            $_SESSION['get']=$get_adr;
        }

        $map['staff'] = array('neq','');
        $expressArr = D('express')->field(array('id','name'))->where(array('status'=>1))->where($map)->select();
//        dump($this->user_session['uid']);
//        dump($get_adr);
//        dump($out_adr);exit;
        //查询当前用户所有地址信息
        $address=$model->where($where2)->select();
        $this->assign('out_adr',$out_adr);
        $this->assign('get_adr',$get_adr);
        $this->assign('address',$address);
        $this->assign('village_id',$village_id);
        $this->assign('expressArr',$expressArr);
        $this->display();
    }

    public function address(){
        if(IS_POST){
            if(empty($_POST['name'])){
                $this->error('姓名不能为空');
            }elseif (empty($_POST['phone'])){
                $this->error('手机号码不能为空');
            }elseif (empty($_POST['detail'])){
                $this->error('详细地址不能为空');
            }
            $data=array(
                'uid'=>$this->user_session['uid'],
                'name'=>$_POST['name'],
                'phone'=>$_POST['phone'],
                //'default'=>$_POST['default'],
                'detail'=>$_POST['detail'],
                'village_id'=>$_POST['village_id']?$_POST['village_id']:0,
                'type'=>$_POST['type'],
                'position'=>$_POST['position']?$_POST['position']:''
            );
            //dump($data);exit;
            if($_POST['adress_id']){//更新地址
                if(!empty($_POST['default'])){//更新默认地址
                    $update_default=M('user')->where(array('uid'=>$this->user_session['uid']))->save(array('default_address'=>$_POST['adress_id']));
                }
                $update=M('user_adress')->where(array('adress_id'=>$_POST['adress_id']))->data($data)->save();
                if($update!==false){
                    redirect(U('index',array('type'=>$_POST['type'],'post'=>'1','adress_id'=>$_POST['adress_id'])));
                }else{
                    $this->error('操作失败！');
                }
            }else{
                $add=M('user_adress')->data($data)->add();
                //新增的地址如果是默认地址，则存入user表中
                if(!empty($_POST['default'])){
                    $update=M('user')->where(array('uid'=>$this->user_session['uid']))->save(array('default_address'=>$add));
                }
                if($add){
                    redirect(U('index',array('post'=>'1','type'=>$_POST['type'],'adress_id'=>$add)));
                }else{
                    $this->error('提交失败');
                }
            }
        }else{
            $adress_id=$_GET['adress_id'];
            $type=$_GET['type'];
            $village_id = $_GET['village_id'];
            $village_arr=M('house_village')->field('village_id,village_name')->select();//社区信息
            $adr_list=M('user_adress')->where(array('adress_id'=>$adress_id))->find();
            $this->assign('village_arr',$village_arr);
            $this->assign('village_id',$village_id);
            $this->assign('adr_list',$adr_list);
            $this->assign('type',$type);
            $this->display();
        }
    }



    //地址列表页
    public function existed_address(){
        $type=$_GET['type'];
        $village_id = $_GET['village_id'];
        $where=array('uid'=>$this->user_session['uid']);
        //查询默认地址id
        $default_id=M('user')->where($where)->getField('default_address');

        //寄件地址列表集合
        if($type==1){
            //若存在默认地址，整理数据
            if(!empty($default_id)){
                //默认地址信息
                $default_adr=M('user_adress')->alias('a')
                    ->join('left join __HOUSE_VILLAGE__ b on a.village_id=b.village_id')
                    ->where('a.adress_id='.$default_id)
                    ->field('a.adress_id,a.name,a.phone,a.detail,b.village_name')
                    ->find();

                //非默认地址信息
                $other_adr=M('user_adress')
                    ->where(array('adress_id'=>array('neq',$default_id),'uid'=>$this->user_session['uid'],'type'=>1))
                    ->order('adress_id desc')
                    ->select();

                //将社区名称放入数组中
                foreach ($other_adr as &$v){
                    if($v['type']==1){
                        $v['village_name']=M('house_village')->where(array('village_id'=>$v['village_id']))->getField('village_name');
                    }else{
                        $v['village_name']='';
                    }
                }
                unset($v);
            }else{
                //非默认地址信息
                $other_adr=M('user_adress')
                    ->where(array('uid'=>$this->user_session['uid'],'type'=>1))
                    ->order('adress_id desc')
                    ->select();

                //将社区名称放入数组中
                foreach ($other_adr as &$v){
                    if($v['type']==1){
                        $v['village_name']=M('house_village')->where(array('village_id'=>$v['village_id']))->getField('village_name');
                    }else{
                        $v['village_name']='';
                    }
                }
                unset($v);
            }
        }else{
            //收件地址信息集合
            $get_adr=M('user_adress')->where(array('uid'=>$this->user_session['uid'],'type'=>2))->order('adress_id desc')->select();
        }

        $this->assign('type',$type);
        $this->assign('village_id',$village_id);
        $this->assign('get_adr',$get_adr);
        $this->assign('other_adr',$other_adr);
        $this->assign('default_adr',$default_adr);
        $this->display();
    }


    //下单提交表单
    public function order(){
//        C('TOKEN_ON',true); // 是否开启令牌验证
//        C('TOKEN_NAME','__hash__');// 令牌验证的表单隐藏字段名称
//        C('TOKEN_TYPE','md5'); //令牌哈希验证规则 默认为MD5
//        C('TOKEN_RESET',true);//令牌验证出错后是否重置令牌 默认为true
        $data['user_id']=$this->user_session['uid'];
        $data['express_id']=$_POST['express_id'];//快递公司id
        $data['billing_adid']=$_POST['billing_adid'];//寄件id
        $data['shipping_adid']=$_POST['shipping_adid'];//收件id
        $data['goods_type_name']=$_POST['goods_type_name'];//物品类型
        $data['save_pay']=$_POST['save_pay']?:0;
        $data['billing_type_id']=$_POST['billing_type_id'];//付款方式
        $data['time_period']=strtotime(date($_POST['time_period']));//时间点
        $data['create_time']=time();
        //供快递鸟API调用
        //电子面单 start
        $single_eorder = $this->place_sub($data,2);
        $jsonEorder = json_encode($single_eorder, JSON_UNESCAPED_UNICODE);
        $single_jsonResult = $this->submitEOrder($jsonEorder);
//        $singleArr = json_decode($single_jsonResult,1);
//        if ($singleArr['Success']) {
//            $PrintTemplate = $singleArr['PrintTemplate'];
//            $this->assign('PrintTemplate',$PrintTemplate);
//            $this->display('singlePrintTemplate');exit;
//        }
        dump($single_jsonResult);exit;

        //end

        //在线电子下单 start
//        $place_eorder = $this->place_sub($data);
//        $jsonEorder = json_encode($place_eorder, JSON_UNESCAPED_UNICODE);
//        $place_jsonResult = $this->submitOOrder($jsonEorder);
//
//        dump($place_jsonResult);exit;
       //end

        $village_id=M('user_adress')->where(array('adress_id'=>$data['billing_adid']))->getField('village_id');//获取寄件人社区id

        $name=M('house_village_user_bind')->where(array('uid'=>$data['user_id'],'village_id'=>$village_id))->getField('name');

        //获取该快递公司取件员
        $staffStr = D('express')->where(array('id'=>$_POST['express_id']))->find()['staff'];
        //入表
        $add=M('express_order')->data($data)->add();
        if($add){
            $date2=array(
                'type_id'=>1, //业务类型id
                'p_id'=>$add, //当前业务主键id
                'uid'=>$this->user_session['uid'],
                'username'=>$name,
                'phone'=>M('house_village_user_bind')->where(array('uid'=>$data['user_id'],'village_id'=>$village_id))->getField('phone'),
                'theme'=>'快递',
                'status'=>'1',//用户下单状态值，未处理。
                'create_time'=>$data['create_time'],
            );
            M('user_progress')->data($date2)->add();//将记录添加至进度列表
            $detail =array(
                'url'=>C('config.site_url').'/wap.php?c=Express&a=detail&order_id='.$add,
                'first_value'=>'快递提醒',
                'keyword1_value'=>'新的快递订单！',
                'keyword2_value'=>$name,
                'keyword3_value'=>'有任何问题请致电技术人员解决 TEL:027-87779655'
            );
//            $arr=M('login_user')->where(array('role_id'=>35,'village_id'=>$village_id,'status'=>1))->field('uid')->select();//配送员角色ID为35，从员工列表分配快递员账号
            $map['id'] = array('in',$staffStr);
            $map['_string']="FIND_IN_SET(76,role_id)";//tid为表字段
            $arr = D('admin')->where($map)->find();

            if(!$arr){
                $this->error_tips('此快递公司暂无此社区配送员',U('index'));
            }else{//数据制作，一维数组的uid
                $openid_arr[]=$arr['openid'];
                $result=$this->auto_send_message($openid_arr,$detail);
                if($result[0]['errmsg']=='ok'){
                    redirect(U('My/progress'));
                }
            }
        }
    }

    //构造在线下单提交信息
    public function place_sub($data,$sta_type=1) {
        if (!$data) $this->error('操作失败',U('index'));
        $billArr = D('user_adress')->where(array('adress_id'=>$data['billing_adid']))->find();//发件人信息
        $shipArr = D('user_adress')->where(array('adress_id'=>$data['shipping_adid']))->find();//收件人消息
        $expressArr = D('express')->where(array('id'=>$data['express_id']))->find();
        if ($data['billing_type_id'] == '寄付现结') {
            $PayType = 1;
        } elseif ($data['billing_type_id'] == '到付') {
            $PayType = 2;
        } elseif ($data['billing_type_id'] == '寄付月结') {
            $PayType = 3;
        } else {
            $PayType = 4;
        }

        //发件人默认
        $sender_ProvinceName = '湖北省';
        $sender_CityName = '武汉市';
        $sender_ExpAreaName = '江汉区';

        $positionArr = explode(' ',$shipArr['position']);
        if ($positionArr[0] == '北京' || $positionArr[0] == '上海' || $positionArr[0] == '天津' || $positionArr[0] == '重庆') {
            $receiver_ProvinceName = $positionArr[0];
        } elseif ($positionArr[0] == '内蒙古' || $positionArr[0] == '西藏' || $positionArr[0] == '宁夏'|| $positionArr[0] == '新疆') {
            $receiver_ProvinceName = $positionArr[0].'自治区';
        } elseif ($positionArr[0] == '广西') {
            $receiver_ProvinceName = $positionArr[0].'壮族自治区';
        } elseif ($positionArr[0] == '宁夏') {
            $receiver_ProvinceName = $positionArr[0].'回族自治区';
        } elseif ($positionArr[0] == '新疆') {
            $receiver_ProvinceName = $positionArr[0].'维吾尔自治区';
        } else {
            $receiver_ProvinceName = $positionArr[0].'省';
        }
        $receiver_CityName = $positionArr[1].'市';
        $receiver_ExpAreaName = $positionArr[2];

        $eorder = [];
        $eorder["ShipperCode"] = $expressArr['coding'];//快递公司编码
        $eorder["OrderCode"] = time().rand(1000,9999);//订单号
        $eorder["PayType"] = $PayType;//支付方式 1-现付，2-到付，3-月结，4-第三方付
        $eorder["ExpType"] = 1;//快递类型：1-标准快件

        $sender = [];
        $sender["Name"] = $billArr['name'];//发件人
        $sender["Mobile"] = $billArr['phone'];//电话号码
        $sender["ProvinceName"] = $sender_ProvinceName;//发件省
        $sender["CityName"] = $sender_CityName;//发件市
        $sender["ExpAreaName"] = $sender_ExpAreaName;//发件区/县
        $sender["Address"] = $billArr['detail'];//发件人详细地址

        $receiver = [];
        $receiver["Name"] = $shipArr['name'];//收件人
        $receiver["Mobile"] = $shipArr['phone'];//收件人电话
        $receiver["ProvinceName"] = $receiver_ProvinceName;//收件省
        $receiver["CityName"] = $receiver_CityName;//收件市
        $receiver["ExpAreaName"] = $receiver_ExpAreaName;//收件区/县
        $receiver["Address"] = $shipArr['detail'];//收件人详细地址

        $commodityOne = [];
        $commodityOne["GoodsName"] = $data['goods_type_name'];//商品名称
        $commodity = [];
        $commodity[] = $commodityOne;

        $eorder["Sender"] = $sender;
        $eorder["Receiver"] = $receiver;
        $eorder["Commodity"] = $commodity;
        if ($sta_type == 2) $eorder['IsReturnPrintTemplate'] = 1;
//        dump($eorder);exit;
        return $eorder;
    }

    /**
     * Json方式 调用电子面单接口
     */
    function submitEOrder($requestData){
        $datas = array(
            'EBusinessID' => $this->EBusinessID,
            'RequestType' => '1007',
            'RequestData' => urlencode($requestData) ,
            'DataType' => '2',
        );
        $datas['DataSign'] = $this->encrypt($requestData, $this->AppKey);
        $result = $this->sendPost($this->single_ReqURL, $datas);
//        $datas = json_encode($datas);
//        dump($datas);exit;
//        $result = $this->https_request($this->single_ReqURL, $datas);

        //根据公司业务处理返回的信息......

        return $result;
    }

    /**
     * Json方式 提交在线下单
     */
    function submitOOrder($requestData){
        $datas = array(
            'EBusinessID' => $this->EBusinessID,
            'RequestType' => '1001',
            'RequestData' => urlencode($requestData) ,
            'DataType' => '2',
        );
        $datas['DataSign'] = $this->encrypt($requestData, $this->AppKey);

        $result = $this->sendPost($this->place_ReqURL, $datas);
//        $result = $this->https_request($this->place_ReqURL, $datas);

        //根据公司业务处理返回的信息......

        return $result;
    }


    //https请求（支持GET和POST）
    protected function https_request($url, $data = null,$noprocess=false) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; WOW64; rv:39.0) Gecko/20100101 Firefox/39.0");
        $header = array("Accept-Charset: utf-8");
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        //curl_setopt($curl, CURLOPT_SSLVERSION, 3);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header); /* * *$header 必须是一个数组** */
        curl_setopt($curl, CURLOPT_HEADER, FALSE);
        curl_setopt($curl, CURLINFO_HEADER_OUT, true);
        if (!empty($data)) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        if($noprocess) return $output;
        $errorno = curl_errno($curl);
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
        curl_close($curl);
    }

    /**
     *  post提交数据
     * @param  string $url 请求Url
     * @param  array $datas 提交的数据
     * @return url响应返回的html
     */
    function sendPost($url, $datas) {
        $temps = array();
        foreach ($datas as $key => $value) {
            $temps[] = sprintf('%s=%s', $key, $value);
        }
        $post_data = implode('&', $temps);
        $url_info = parse_url($url);
        if(empty($url_info['port']))
        {
            $url_info['port']=80;
        }
        $httpheader = "POST " . $url_info['path'] . " HTTP/1.0\r\n";
        $httpheader.= "Host:" . $url_info['host'] . "\r\n";
        $httpheader.= "Content-Type:application/x-www-form-urlencoded\r\n";
        $httpheader.= "Content-Length:" . strlen($post_data) . "\r\n";
        $httpheader.= "Connection:close\r\n\r\n";
        $httpheader.= $post_data;
        $fd = fsockopen($url_info['host'], $url_info['port']);
        fwrite($fd, $httpheader);
        $gets = "";
        $headerFlag = true;
        while (!feof($fd)) {
            if (($header = @fgets($fd)) && ($header == "\r\n" || $header == "\n")) {
                break;
            }
        }
        while (!feof($fd)) {
            $gets.= fread($fd, 128);
        }
        fclose($fd);

        return $gets;
    }

    /**
     * 电商Sign签名生成
     * @param data 内容
     * @param appkey Appkey
     * @return DataSign签名
     */
    function encrypt($data, $appkey) {
        return urlencode(base64_encode(md5($data.$appkey)));
    }


    public function auto_send_message($admin_user,$yueka_info){
        //制作本地推送内容
        foreach ($admin_user as $value){//
            $time = time();
            $href = $yueka_info['url'];
            $data=array(
                'touser'=>$value,
                'template_id'=>"xLpzcYPX-Kgwsx6Ym3sHjp_CmZhn_n65_-v6CxC4gAc",
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
            import('@.ORG.pay.Weixin');
            $weixin=new Weixin();
            $res[] = $weixin->send_template_message(urldecode(json_encode($data)));
        }
        return $res;
    }


    public function detail(){
        $order_id=$_GET['order_id'];//下单的编号
        $order_info=M('express_order')->where(array('order_id'=>$order_id))->find();//订单信息
        $out_info=M('user_adress')->where(array('adress_id'=>$order_info['billing_adid']))->find();//寄件信息
        $get_info=M('user_adress')->where(array('adress_id'=>$order_info['shipping_adid']))->find();//收件信息
        $out_village=M('house_village')->where(array('village_id'=>$out_info['village_id']))->getField('village_name');//寄件人社区
        $phone=$out_info['phone'];
        $info=array(
            'order_id'=>$order_id,
            'out_name'=>$out_info['name'],//寄件人姓名
            'get_name'=>$get_info['name'],//收件人姓名
            'create_time'=>$order_info['create_time'],//下单时间
            'out_village'=>$out_village,//寄件人社区
            'out_detail'=>$out_info['detail'],//寄件人详细地址
            'get_position'=>$get_info['position'],//收件人地址
            'get_detail'=>$get_info['detail'],//收件人详细地址
            'goods'=>$order_info['goods_type_name'],//物品
            'express_time'=>$order_info['time_period'],//配送时间
            'status'=>$order_info['status'],//订单状态  1为未处理  2为通知用户接单  3为已处理
            'phone'=>$phone,
            'save_pay'=>$order_info['save_pay']//保价费用
        );
        $this->assign('info',$info);
        $this->display();
    }


    /*
     * 通知用户
     */
    public function change_status1(){
        $order_id=$_POST['order_id'];
        $update1=M('express_order')->where(array('order_id'=>$order_id))->save(array('status'=>2));//更新订单中的status
        $update2=M('user_progress')->where(array('type_id'=>1,'p_id'=>$order_id))->save(array('status'=>2,'check_time'=>time()));
        $msg_u =array(
            'first_value'=>'您的寄件已受理，配送员会在三小时内上门取件',
            'keyword1_value'=>'您的寄件已受理，配送员会在三小时内上门取件',
            'keyword2_value'=>'您的寄件已受理，配送员会在三小时内上门取件',
            'keyword3_value'=>'有任何问题请致电技术人员解决 TEL:027-87779655'
        );
        $uid=M('express_order')->where(array('order_id'=>$order_id))->getField('user_id');//发起订单人的uid
        $openid=M('user')->where(array('uid'=>$uid))->getField('openid');
        $openid=array('0'=>$openid);
        $result=$this->auto_send_message($openid,$msg_u);
        if($update1 && $update2 && $result[0]['errmsg']=='ok'){
            echo json_encode(array('error'=>0,'msg'=>'已接单'));
        }
    }


    /*
     * 处理完毕
     */
    public function change_status2(){
        $order_id=$_POST['order_id'];
        $update1=M('express_order')->where(array('order_id'=>$order_id))->save(array('status'=>3));//更新订单中的status
        $update2=M('user_progress')->where(array('type_id'=>1,'p_id'=>$order_id))->save(array('status'=>3,'check_time'=>time()));
        $msg_u =array(
            'first_value'=>'您的订单已处理完毕',
            'keyword1_value'=>'您的订单已处理完毕',
            'keyword2_value'=>'您的订单已处理完毕',
            'keyword3_value'=>'有任何问题请致电技术人员解决 TEL:027-87779655'
        );
        $uid=M('express_order')->where(array('order_id'=>$order_id))->getField('user_id');//发起订单人的uid
        $openid=M('user')->where(array('uid'=>$uid))->getField('openid');
        $openid=array('0'=>$openid);
        $result=$this->auto_send_message($openid,$msg_u);
        if($update1 && $update2 && $result[0]['errmsg']=='ok'){
            echo json_encode(array('error'=>0,'msg'=>'已完毕'));
        }
    }


    /**
     * 收件详细
     */
    public function express_detail()
    {
        //vd($_SESSION);exit;

        $id = I('get.id');

        $model = new PackageModel();

        $info = $model->getPackageInfo($id);

        $this->assign('info',$info);

        $this->display();
    }

    //电子面单模板
    public function singlePrintTemplate(){
        $this->display();
    }
    /**
     *
     */
    public function openid(){
        dump($_SESSION);
    }



    /***********************************************************************************************************/
    public function water(){$this->display();}
    public function water0(){$this->display();}
    public function water1(){$this->display();}
    public function water2(){$this->display();}
    public function water3(){$this->display();}
    public function shui(){$this->display();}
    public function shui2(){$this->display();}
    public function shui3(){$this->display();}
    public function shui4(){$this->display();}
    public function shui5(){$this->display();}
    public function xun(){$this->display();}
    public function lby(){$this->display();}
    public function delete(){$this->display($_GET['html']);}
}