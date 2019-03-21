<?php
/**
 * 物业管理模块
 * @update-time: 2017-06-12 11:00:45
 * @author: 王亚雄
 */

class PropertyServiceAction extends BaseAction{

    protected $village_id; //社区ID

    protected $default_village_id; //社区ID

    protected $village; //社区信息

    protected $img_dir ="upload/house/";

    protected $EBusinessID = "1288093";//快递鸟相关

    protected $AppKey = "c46ea816-0768-4cda-a697-86d35d535fd0";//快递鸟key

    protected $ReqURL = "http://api.kdniao.cc/Ebusiness/EbusinessOrderHandle.aspx";//快递鸟请求地址

    public function _initialize(){

        parent::_initialize();
        //图片路径

    }


    /**
     * 使得_news后缀可以不加
     * @param string $name
     * @param array $arguments
     * @update-time: 2017-06-05 11:24:25
     * @author: 王亚雄
     */
    public function __call($name, $arguments)
    {
        if(strpos($name,'_news')!==false){

            $name = str_replace('_news','',$name);

            $this->$name($arguments);

        }else{

            parent::__call();

        }
    }


    /**
     * 投诉建议执行操作
     * @update-time: 2017-06-12 11:48:21
     * @author: 王亚雄
     */
    public function suggest_act(){
        $contact = I('post.contact',"");
        $content = I('post.content',"");
        $pic_arr = I('post.img_name',array());
        $meal_id = I('post.meal_id');
        //图片地址调整
        foreach($pic_arr as $k=> &$v){
            $v =  str_replace('./' . $this->img_dir,'',$v);
        }
        unset($v);
        $pic_str = join('|',$pic_arr);
        $model = M('house_village_repair_list','pigcms_');
        //新增数据
        $data = array(
            'village_id'=>$this->mealid2vid($meal_id)?:0,       //社区ID
            'uid'       =>session('user.uid')?:0,       //用户ID
            'bind_id'   =>'',       //？？
            'content'   =>$content,//内容
            'pic'       =>$pic_str,//图片
            'is_read'   =>0,       //是否审核
            'type'      =>3,        //3 投诉建议
            'time'      =>time(),
            'contact'   =>$contact,
            'appointment_start_time'=>0,
            'appointment_end_time'  =>0,
            'meal_id'=>$meal_id,
        );
        $num = $model->add($data);
        if($num){
            $this->suc("提交成功",$data);
        }else{
            $this->err("提交失败",$data);
        }


    }
    /**
     * 预约
     * @update-time: 2017-06-12 11:48:26
     * @author: 王亚雄
     */
    public function appointment(){
        $model = M('meal','pigcms_');
        $meal_img_path = 'upload/meal/';
        $meal_id = I('get.meal_id',0,'intval');
        //获取服务商品
        $map = array();
        $map['meal_id'] = array('eq',$meal_id);
        if(!$meal_id){
            $this->error_tips("meal_id不存在");
        }
        $info = $model->where($map)->find();
        //图片链接补全
        $info['image'] = $meal_img_path . str_replace(',','/',$info['image']);
        $info['logo'] = $meal_img_path . str_replace(',','/',$info['logo']);
        $info['banner_imgs'] = explode(',',$info['banner_imgs']);
        foreach($info['banner_imgs'] as &$v){
            $v = $meal_img_path . $v;
        }
        unset($v);
        //dump($info);exit;
        $this->assign('info',$info);
        $this->display();
    }

    /**
     * 预约添加操作
     * @update-time: 2017-06-12 11:48:29
     * @author: 王亚雄
     */
    public function appointment_act(){

        $name = I('post.name');
        $content = I('post.content');
        $contact = I('post.contact');
        $pic = I('post.image');
        //图片地址调整
        foreach($pic as $k=> &$v){
            $v =  str_replace('./' . $this->img_dir,'',$v);
        }
        unset($v);
        $pic = join('|',$pic);
        $start_time = strtotime(I('post.appoinment_start_time'));
        $end_time = strtotime(I('post.appoinment_end_time'));
        $meal_id = I('post.meal_id','0','intval');
        //验证
        if(!$name) {
            $this->error_tips("请留下您的姓名");
            exit();
        }
        if(!$start_time||!$end_time) {
            $this->error_tips("请选择预约时间");
            exit();
        }
        if(!$contact) {
            $this->error_tips("请留下您的联系方式");
            exit();
        }
        //新增数据
        $data = array(
            'village_id'=>$this->mealid2vid($meal_id)?:0,       //社区ID
            'uid'       =>session('user.uid')?:0,       //用户ID
            'bind_id'   =>'',       //？？
            'content'   =>$content,//内容
            'pic'       =>$pic?:"",//图片
            'is_read'   =>0,       //是否审核
            'type'      =>4,        //4 预约会议室
            'time'      =>time(),
            'contact'   =>$contact,
            'appointment_start_time'=>$start_time,
            'appointment_end_time'  =>$end_time,
            'meal_id'=>$meal_id,
            'name'=>$name
        );
        $model = M('house_village_repair_list','pigcms_');
        //执行新增
        $num = $model->add($data);

        if($num){
            //推送消息
            //固定为 ： http://www.hdhsmart.com/wap.php?g=Wap&c=House&a=appointment_list&village_id=4
            $url = C('WEB_DOMIAN') . U('Wap/House/appointment_list',array('village_id'=>4));
            $info = array(
                $name,M('meal')->where('meal_id=%d',$meal_id)->getField('name')
            );
            $this->send_msg($info,$url);
            $this->success("预约完成");
        }else{

            $this->error_tips("预约失败");
        }

    }


    /**
     * 客服中心
     * @update-time: 2017-06-12 11:48:26
     * @author: 王亚雄
     */
    public function service(){
        $model = M('meal','pigcms_');
        $meal_img_path = 'upload/meal/';
        $meal_id = I('get.meal_id',0,'intval');
        //获取服务商品
        $map = array();
        $map['meal_id'] = array('eq',$meal_id);
        if(!$meal_id){
            $this->error_tips("meal_id不存在");
        }
        $info = $model->where($map)->find();
        //图片链接补全
        $info['image'] = $meal_img_path . str_replace(',','/',$info['image']);
        $info['logo'] = $meal_img_path . str_replace(',','/',$info['logo']);
        $info['banner_imgs'] = explode(',',$info['banner_imgs']);
        foreach($info['banner_imgs'] as &$v){
            $v = $meal_img_path . $v;
        }
        unset($v);
        //分割图片前4张与后续图片
        $info['introduce_imgs'] = array_slice($info['banner_imgs'],0,4);
        $info['banner_imgs'] = array_splice($info['banner_imgs'],4);
        $this->assign('info',$info);
        $this->display('service');
    }

    /**
     * 客服中心
     * @update-time: 2017-06-12 11:48:26
     * @author: 王亚雄
     */
    public function service_two(){
        $_GET['meal_id'] = 1006;
        $this->display();
    }

    /**
     * 客服中心添加操作
     * @update-time: 2017-06-12 11:48:29
     * @author: 王亚雄
     */
    public function service_act(){
        $name = I('post.name');
        $content = I('post.content');
        $contact = I('post.contact');
        $start_time = strtotime(I('post.appoinment_start_time'));
        $end_time = strtotime(I('post.appoinment_end_time'));
        $meal_id = I('post.meal_id','0','intval');
        //图片地址补全
        $pic_arr = I('post.img_name',array());
        foreach($pic_arr as $k=> &$v){
            $v =  str_replace('./' . $this->img_dir,'',$v);
        }
        unset($v);
        $pic_str = join('|',$pic_arr);

        //新增数据
        $data = array(
            'village_id'=>$this->mealid2vid($meal_id)?:0,       //社区ID
            'uid'       =>session('user.uid')?:0,       //用户ID
            'bind_id'   =>'',       //？？
            'content'   =>$content,//内容
            'pic'       =>$pic_str,//图片
            'is_read'   =>0,       //是否审核
            'type'      =>4,        //4 预约会议室
            'time'      =>time(),
            'contact'   =>$contact,
            'appointment_start_time'=>$start_time,
            'appointment_end_time'  =>$end_time,
            'meal_id'=>$meal_id,
            'name'=>$name
        );

        $model = M('house_village_repair_list','pigcms_');
        //执行新增
        $num = $model->add($data);

        if($num){
            //推送消息
            //固定为 ： http://www.hdhsmart.com/wap.php?g=Wap&c=House&a=appointment_list&village_id=4
            $url = C('WEB_DOMIAN') . U('Wap/House/appointment_list',array('village_id'=>4));
            $info = array(
                $name,M('meal')->where('meal_id=%d',$meal_id)->getField('name')
            );
            $this->send_msg($info,$url);


            $this->suc("预约完成");
        }else{
            $this->err("预约失败");
        }

    }




    /**
     * 上传文件类型控制 此方法仅限ajax上传使用
     * @param  string   $path    字符串 保存文件路径示例： /Upload/image/
     * @param  string   $format  文件格式限制
     * @param  integer  $maxSize 允许的上传文件最大值 52428800
     * @return booler   返回ajax的json格式数据
     */
    public function ajax_upload(){
        $path='images/' . date("Y-m-d"). "/";
        $format='empty';
        $maxSize='52428800';

        ini_set('max_execution_time', '0');
        // 去除两边的/
        $path=trim($path,'/');
        // 添加Upload根目录
        $path=strtolower($this->img_dir .  $path);

        if(!is_dir($path)){
             $b = mkdir($path,0777,true);
             if(!$b){
                 $this->err("创建文件夹失败",$path);
             }
        }
        // 上传文件类型控制
        $ext_arr= array(
            'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
            'photo' => array('jpg', 'jpeg', 'png'),
            'flash' => array('swf', 'flv'),
            'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
            'file' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2','pdf')
        );
        if(!empty($_FILES)){
            // 上传文件配置
            $config=array(
                'maxSize'   =>  $maxSize,               // 上传文件最大为50M
                'rootPath'  =>  './',                   // 文件上传保存的根路径
                'savePath'  =>  './'.$path.'/',         // 文件上传的保存路径（相对于根路径）
                'saveName'  =>  array('uniqid',''),     // 上传文件的保存规则，支持数组和字符串方式定义
                'autoSub'   =>  true,                   // 自动使用子目录保存上传文件 默认为true
                'exts'      =>    isset($ext_arr[$format])?$ext_arr[$format]:'',
            );
            // 实例化上传
            import('ORG.Net.UploadFile');
            $upload = new UploadFile($config);// 实例化上传类
            // 调用上传方法
            $res=$upload->upload();
            // p($info);
            if(!$res){
                // 返回错误信息
                $error=$upload->getErrorMsg();
                $data['error_info']=$error;
                $this->err("上传失败",$data);
            }else{
                // 返回成功信息
                $info =  $upload->getUploadFileInfo();
                $this->suc("上传成功",$info[0]);

            }
        }
    }


    /**
     * 物业相关推送消息
     */
    public function send_msg($info=array(),$url="")
    {
        //微信类库
        $wechat = new WechatModel();

        //获取物业相关人员微信openid
        //相关角色
        $role_names = array(
            '16'=>"社区管理员",
        );
        $role_ids = array_keys($role_names);
        $map = array();
        $map['role_id'] = array('in',$role_ids);
        $map['village_id'] = array('eq',4);
        $admins = M('admin')->where($map)->select();
        $openids = array();
        foreach($admins as $admin){
            if($admin['openid']){
                $openids[] = $admin['openid'];
            }
        }
        //流程审批提醒模板ID
        $tpl_id = $wechat::TPLID_LCSPTX;
        $data = array(
            'first'=>array(
                'value'=>"在线预约提醒",
                'color'=>"#029700",
            ),
            'keyword1'=>array(
                'value'=>"在线预约提醒",
                'color'=>"#000000",
            ),
            'keyword2'=>array(
                'value'=>$info[0],
                'color'=>"#000000",
            ),
            'keyword3'=>array(
                'value'=>$info[1],
                'color'=>"#000000",
            ),
            'keyword4'=>array(
                'value'=>date('Y-m-d H:i:s',time()),
                'color'=>"#000000",
            ),
        );
        $res = $wechat->send_tpl_messages($openids, $tpl_id, $url, $data);
        if($res[0]['errcode']!==0){
            //TODO::与用户方逻辑无关，暂不提醒，应记录在日志系统当中
           // $this->error("推送消息失败");
        }
    }
    /**
     * 使用meal_id计算village_id
     */
    public function mealid2vid($meal_id){
        $model = M('meal','pigcms_');
        $info = $model->alias('m')
            ->join('left join __MERCHANT_STORE__ ms on ms.store_id=m.store_id')
            ->join('left join __MERCHANT__ mc on mc.mer_id=ms.mer_id')
            ->where('m.meal_id=%d',$meal_id)
            ->find();
        return $info['village_id'];
    }

    public function test(){
        $meal_id = $_GET['meal_id'];
        echo $this->mealid2vid($meal_id);
    }


    //修改页面
    //自定义二维码详情
    public function punch_safety_card_C() {
        if (IS_POST) {
            // var_dump($_POST);exit();
            $village_id = I('post.village_id');
            $rid = I('post.rid');
            $orientation = I('post.orientation');
            $borrower = I('post.borrower');
            $pro_qrcode = I('post.pro_qrcode');
            $zone_id=I('post.zone_id');
            $safetyPoint = D('house_village_point')->where(array('rid'=>$rid,'orientation'=>$orientation))->getField('orientation');
            // var_dump($safetyPoint);exit();
            if (!$safetyPoint) {
                     $pointArray = array(
                           'rid'=>$rid,
                           'name'=>$orientation,
                           'orientation'=>$orientation,
                           'type' => 1,
                           'direction' => 2
                       );
                       $re = D('house_village_point')->data($pointArray)->add();
                }
            
                if ($re) {
                    $point_id = D('house_village_point')->where(array('rid'=>$rid,'orientation'=>$orientation))->getField('id');
                    $data = array();
                    $data['borrower'] = $borrower;  //责任人
                    $data['pro_code'] = $point_id;  //商品编号、消防点编号
                    $data['trans_time'] = time();   //申请时间
                    $data['receive'] = 1;           //是否被领取
                    $data['zone_id'] = $zone_id;
                    $data['direction'] =2;
                    $res = D('off_products_ercode')->where(array('pro_qrcode'=>$pro_qrcode))->save($data);
                    if ($res) {
                        $this->success('更新成功',U('PropertyService/punch_safety_card',array('id'=>$point_id)));
                    } else {
                        $this->error('更新失败',U('PropertyService/punch_safety_card_C',array('pro_qrcode'=>$pro_qrcode)));
                    }
            } else {
                $this->error('该编号已存在，请重新输入！',U('PropertyService/punch_safety_card_C',array('pro_qrcode'=>$pro_qrcode)));
            }

        } else {
            //dump(strpos($_SERVER["QUERY_STRING"],'punch_safety_card'));
            $pro_qrcode = I('get.pro_qrcode');
            $openid = session('openid'); 
            // var_dump($openid);exit();
            $re = D('user')->where(array('openid'=>$openid))->getField('openid');
            if ($re) {//判断是否关注公众号
                $res = M('user')->alias('u')
                ->join('LEFT JOIN __HOUSE_VILLAGE_USER_BIND__ b on b.uid=u.uid')
                ->where(array('u.openid'=>$openid))
                ->getField('b.village_id');
                // dump($res);exit();
                // dump(M()->_sql());
                // die;
                if ($res) {//判断是否进行业主认证
                    $id = D('off_products_ercode')->where(array('pro_qrcode'=>$pro_qrcode))->getField('pro_code');
                    $receive = D('off_products_ercode')->where(array('pro_qrcode'=>$pro_qrcode))->getField('receive');
                    $direction = D('off_products_ercode')->where(array('pro_qrcode'=>$pro_qrcode))->getField('direction');
                    $villageArr = D('off_products_ercode')
                    ->alias('e')
                    ->field(array('v.village_name','v.village_id'))
                    ->join('left join __HOUSE_VILLAGE__ v on v.village_id=e.village_id')
                    ->where(array('e.pro_qrcode'=>$pro_qrcode))
                    ->select();
                    // var_dump($villageStr);exit();
                    if ($receive == 1 && $direction == 2 ) {
                        $this->redirect(U('PropertyService/punch_safety_card',array('id'=>$id)));
                    }
                    // $villageArr = M('house_village')->where(array('status'=>array('eq',1)))->select();
                    $roomArr = M('house_village_room')->where(array('status'=>0,'fid'=>0,'village_id'=>array('eq',$villageArr[0]['village_id'])))->select();
                    $name = M('admin')->where(array('openid'=>$openid))->getField('realname');
                    // dump(M()->_sql());
                    // var_dump($name);exit();
                    $this->is_audit($villageArr[0]['village_id']);
                    $this->assign('villageArr',$villageArr);
                    $this->assign('roomArr',$roomArr);
                    $this->assign('name',$name);
                    $this->assign('pro_qrcode',$pro_qrcode);
                    $this->display();
                } else {
                    $this->error('请进入汇得行智慧助手公众号,进行业主认证！');
                }
            }else{
                $this->error('请微信关注公众号：汇得行智慧助手！');
            }            
        }
    }


    //验证管理员权限
    public function is_audit($village_id=0){
        $where=array(
          'openid'=>$_SESSION['openid'],
            '_string' => 'find_in_set("82",role_id)',
        );
        if(!empty($village_id)){
            $where['village_id']=$village_id;
        }
        $role_id=M('admin')->where($where)->find();
        if ($role_id) {
            $this->assign('isOpen',1);
            return true;
        }else{
            return false;
        }
    }


    /**
     * 根据village_id改变option
     */
    public function change_village(){
        $village_id = I('post.village_id');
        $villageArr = $roomArr = M('house_village_room')->where(array('status'=>0,'fid'=>0,'village_id'=>array('eq',$village_id)))->select();
        $optionStr = '';
        foreach ($villageArr as $value){
            $optionStr .='<option value="'.$value['id'].'">'.$value['room_name'].'</option>';
        }
        echo $optionStr;
    }

    /**
     * 根据orientation判断该点位是否存在
     */
    public function check_orientation(){
        $rid = I('post.rid');
        $orientation = I('post.orientation');
        $res= M('house_village_point')->where(array('is_del'=>0,'type'=>1,'rid'=>array('eq',$rid),'orientation'=>array('eq',$orientation)))->select();
        if ($res) {
            $message = $res;
        }
        echo $message;
    }

     /**
     * 多角色权限处理后扫码后跳转方法
     */
    public function punch_safety_card(){
        //查询审核权限
        $id = I('get.id');//消防点位id
        // $pro_code = D('off_products_ercode')->where(array('id'=>$id))->getField('pro_code');
        // var_dump($id);exit();
        $openid = session('openid');
        $user_uid = D('user')->where(array('openid'=>$openid))->getField('uid');
        // var_dump($openid);exit();
        if ($user_uid) {
            $res = M('user')->alias('u')
                ->join('LEFT JOIN __HOUSE_VILLAGE_USER_BIND__ b on b.uid=u.uid')
                ->where(array('u.openid'=>$openid))
                ->getField('b.village_id');

            if ($res) {
                $name = D('user')->where(array('openid'=>$openid))->getField('truename');
                if (empty($name)) $name = D('house_village_user_bind')->where(array('uid'=>$user_uid))->getField('name');
                if (empty($name)) $name = D('admin')->where(array('openid'=>$openid))->getField('realname');
                if ($name) $this->assign('name',$name);
                $this->assign('id',$id);

                $pointArray = M('house_village_point')
                    ->alias('p')
                    ->field(array('p.*','r.room_name','r.village_id','r.project_id'))
                    ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ r on r.id=p.rid')
                    ->where(array('p.type'=>1))
                    ->where(array('p.id'=>$id))
                    ->find();
                    // var_dump($pointArray);exit();
                $village = M('house_village')
                    ->field(array('village_name'))
                    ->where(array('village_id'=>$pointArray['village_id']))
                    ->find();
                
                // dump($village);exit();
                $this->assign('pointArray',$pointArray);
                $this->assign('village',$village);
                //vd($_SESSION);

                $date = array(
                    $year=date('Y'),
                    $month=date('m'),
                    $day=date('d'),
                );
                $this->assign('date',$date);

                $this->display();
            } else {
                $this->error('请进入汇得行智慧助手公众号,进行业主认证！');
            }
        } else {
            $this->error('请微信关注公众号：汇得行智慧助手！');
        }        
    }

    //巡更日报表推送消息自动发送 手动测试
    public function send_record_msg()
    {
        //微信类库
        $msg = new System_msgModel();
        $re = $msg->send_record_msg_day();
        // var_dump($re);exit();
        if($res[0]['errcode']==0){
            //TODO::与用户方逻辑无关，暂不提醒，应记录在日志系统当中
           // $this->error("推送消息失败");
            $this->success("推送消息成功！");
        }
    }


    //合同到期推送消息自动发送 手动测试
    public function send_record_msg1()
    {
        //微信类库
        $msg = new System_msgModel();
        $re = $msg->send_contract_msg_remind();
        // var_dump($re);exit();
        if($res[0]['errcode']==0){
            //TODO::与用户方逻辑无关，暂不提醒，应记录在日志系统当中
           // $this->error("推送消息失败");
            $this->success("推送消息成功！");
        }
    }

     /**
     * 处理巡检点位提交信息
     */
    public function deal_safety_point() {
         $_pata = $_POST;
         // var_dump($_FILES);exit();
        //如果不是管理员或者业主，就将名字存入user表中
        $f1 = D('admin')->where(array('openid'=>$_SESSION['openid']))->getField('realname');
        // dump(M()->_sql());
        $f2 = D('house_village_user_bind')->where(array('uid'=>$_SESSION['user']['uid']))->getField('name');
        $f3 = D('user')->where(array('openid'=>$_SESSION['openid']))->getField('truename');

        // var_dump($f1);exit();

        if(empty(trim($_POST['name']))) {
            $this->error('请填写您的姓名');
        }
        if(trim($_POST['name'])) {
            D('user')->where(array('openid'=>$_SESSION['openid']))->save(array('truename'=>$_POST['name']));
        }elseif (empty($f3)) {
           $this->error('请填写您的姓名');
        }
        if (!$f1 && !$f2 && !$f3) {
            D('user')->where(array('openid'=>$_SESSION['openid']))->save(array('truename'=>$_POST['name']));
        }
        unset($_pata['name']);

         $adminRole = M('admin')->where(array('openid'=>$_SESSION['openid']))->getField('role_id');
         // var_dump($adminRole);exit();
       $role_idArr = explode(',',$adminRole);
       // var_dump($role_idArr);exit();
       //角色权限遍历整合
       // foreach ($role_idArr as $k => $v) {
            //var_dump($role_idArr);exit();
            if(in_array(82, $role_idArr)) {
                $imageArray =array();
                if($_FILES['imageUrl']['name'][0]!=''){
                    if($_FILES['imageUrl']['error'][0]==0){
                        import('ORG.Net.UploadFile');
                        $upload = new UploadFile();// 实例化上传类
        //                $upload->maxSize = 3145728;// 设置附件上传大小
                        $upload->maxSize = 5000000;// 设置附件上传大小
                        $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                        $upload->savePath = './upload/adver/';// 设置附件上传目录
                        $upload->autoSub = true; //使用子目录上传模式
                        $upload->subType = 'date';  //使用date作为子目录的名称
                        $upload->dateFormat = 'Y/m/d';//指定date的格式
                        $upload->saveName = array('uniqid','');
                        if (!$upload->upload()) {
                            // 上传错误提示错误信息
                            $this->error($upload->getErrorMsg());
                        } else {
                            // 上传成功 获取上传文件信息
                            $info = $upload->getUploadFileInfo();
                            foreach ($info as $file){
                                $imageArray[] = $file['savename'];
                            }

                        }
                    }else{
                        $this->error('上传失败');
                    }
                }
                //判断该点位是否已经巡检过了
                //当天的日期
                //已经巡检的消防点
                // $nowDay = date("Y-m-t",time());
                // $nowDay = date('Y-m-t');  
                // $check_time = M('village_point_safety_record')->where(array('pid'=>$_pata['point_id']))->getField('check_time');
                // var_dump($nowDays);exit();

                $nowDays = strtotime(date('Y-m-01',time()).'00:00:00');
                $nowDaye = strtotime(date('Y-m-t',time()).'23:59:59');
                
                $is_check = M('village_point_safety_record')->where(array('pid'=>$_pata['point_id'],'check_time'=>array('between',array($nowDays,$nowDaye))))->find();
                // var_dump($is_check);exit();

                if($is_check){
                    //重复上传则，更新当前的信息
                    $updateArray = array(
                        'uid'=>session('user.uid'),
                        'check_time'=>time(),
                        'point_status'=>$_pata['point_status']?:'status_1-0,status_2-0,status_3-0,status_4-0,status_5-0',
                        'point_desc'=>$_pata['point_desc']?:'',
                    );
                    //对多图片上传的处理
                    if(count($imageArray)>1){
                        $updateArray['image'] = join(",",$imageArray);
                    }else{
                        $updateArray['image'] = $imageArray[0];
                    }
                    //将异常添加到报修业务
                    $updateArray['pid'] = $_pata['point_id'];

                    // var_dump($updateArray);exit();
                    // $this->extra_act_for_deal_safety_point($updateArray);
                    
                    $res = M('village_point_safety_record')->where(array('pigcms_id'=>$is_check['pigcms_id']))->data($updateArray)->save();

                    if($res){
                        $this->p_suc('上报更新成功',$_pata['point_id']);
                    }else{
                        $this->p_err('上报更新失败',$_pata['point_id']);
                    }

                }else{
                    //添加数组定义            
                    $addArray = array(
                        'qrcode_id' => $_pata['qrcode_id'],
                        'pid'=>$_pata['point_id'],
                        'uid'=>session('user.uid'),
                        'check_time'=>time(),                    
                        'point_status'=>$_pata['point_status']?:'status_1-0,status_2-0,status_3-0,status_4-0,status_5-0',
                        'point_desc'=>$_pata['point_desc']?:'',
                        'is_check'=>1,
                    );
                }
                //对多图片上传的处理
                if(count($imageArray)>1){
                    $addArray['image'] = join(",",$imageArray);
                }else{
                    $addArray['image'] = $imageArray[0];
                }
                //添加
                // var_dump($addArray);die();
                //将异常添加到报修业务
                // $this->extra_act_for_deal_safety_point($addArray);
                $res = M('village_point_safety_record')->data($addArray)->add();
                if($res){

                    $this->p_suc_safety('上报成功',$addArray['pid']);
                    die;
                }else{
                    $this->p_err('上报失败',$addArray['pid']);
                    die;
                }

            } else {
                $this->error('对不起，您没有权限！');
            }
       // } 
    }

    /**
     * 巡检上报附加操作：报修提交，推送消息
     * @param $data
     * @update-time: 2018-8-29 17:16:52
     * @author: libin
     * 巡检异常上报数据格式参考
     * array(6) {
            * ["uid"] => string(4) "1548"
            * ["check_time"] => int(1512010297)
     *      ["pid"]=>int(4)
            * ["point_status"] => string(1) "1"
            * ["point_desc"] => string(18) "吃是发士大夫"
            * ["warning_level"] => string(1) "3"
            * ["image"] => string(28) "2017/11/30/5a1f723939c22.jpg"
        * }
     * ./upload/adver/
     * 报修表单提交的数据参考格式
     * array(5) {
            * ["content"] => string(44) "类别：灯具  内容：更换日光灯管"
            * ["contact"] => string(11) "17768686868"
            * ["village_id"] => string(1) "4"
            * ["image"] => array(1) {
                * [0] => string(47) "/upload/house/53/000/001/548/20171130104622.jpg"
            * }
            * ["details"] => string(4) "test"
        * }
     */
    public function extra_act_for_deal_safety_point($data){
        if($data['point_status']=='status_1-0,status_2-0,status_3-0,status_4-0,status_5-0') return; //未出现异常，不用进行报修

        //巡更异常上报数据格式 转化成 报修表单提交的数据格式
        $format_data = array(); //报修表单数据设置

        //摘要content
        $format_data['content']     =   "类别：其他 - ";
        $format_data['content']     .=  "巡检异常反馈";
        //联系方式，社区id
        $format_data['contact']     =   user_info()['phone'];
        $format_data['village_id']  =   user_info()['village_id'];

        //图片
        $img_pre = "/upload/adver/"; //巡更异常上报图片保留目录
        if(is_array($data['image'])){
            $format_data['image'] = array_map(function($v)use($img_pre){
                return $img_pre . $v;
            },$data['image']);
        }else{
            $format_data['image'] = [ $img_pre . $data['image'] ];
        }

        //详细
        $pointArray = M('house_village_point')
            ->alias('p')
            ->field(array('p.*','r.room_name'))
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ r on r.id=p.rid')
            ->where(array('p.id'=>$data['pid']))
            ->find();
        $format_data['details'] = "地点：" .$pointArray['room_name'] . $pointArray['orientation'] . '，';
        $format_data['details'] .= $data['point_desc'];
        //dump($format_data); exit();
        //报修表单提交
        $post = $_POST;
        $_POST = $format_data;
        $ctr = new HouseAction();
        $re = $ctr->ajax_submit_form();
        $_POST = $post;
        return $re;
    }

    /**
     * 巡检列表，当月已巡检和未巡检
     */
    public function check_safety_record(){
        $village_id=$_GET['village_id'];
        $project_id=$_GET['project_id'];
        $where=array('p.is_del'=>0);
        if(!empty($village_id))$where['m.village_id']=$village_id;
        if(!empty($project_id))$where['m.project_id']=$project_id;
        //一共多少巡更点
        $pointCount = M('house_village_point')
                ->alias('p')
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
                ->where(array('p.type' => 1))
                ->where($where)
                ->count();
        //已经巡检的巡更点
        $nowDays = strtotime(date('Y-m-01',time()).'00:00:00');
        $nowDaye = strtotime(date('Y-m-t',time()).'23:59:59');
        
        // $is_check = M('village_point_safety_record')->where(array('pid'=>$_pata['point_id'],'check_time'=>array('between',array($nowDays,$nowDaye))))->find();


        // $nowTime = time();
        // if($nowTime>=strtotime(date('Y-m-d').'07:00:00')&&$nowTime<=strtotime(date('Y-m-d').'15:00:00')){
        //     $nowDays = strtotime(date('Y-m-d').'07:00:00');
        //     $nowDaye = strtotime(date('Y-m-d').'15:00:00');
        // }elseif ($nowTime>=strtotime(date('Y-m-d').'15:00:00')&&$nowTime<=strtotime(date('Y-m-d').'23:00:00')){
        //     $nowDays = strtotime(date('Y-m-d').'15:00:00');
        //     $nowDaye = strtotime(date('Y-m-d').'23:00:00');
        // }elseif ($nowTime>=strtotime(date('Y-m-d').'23:00:00')&&$nowTime<=strtotime('+1 day',strtotime(date('Y-m-d').'07:00:00'))){
        //     $nowDays = strtotime(date('Y-m-d').'23:00:00');
        //     $nowDaye = strtotime('+1 day',strtotime(date('Y-m-d').'07:00:00'));
        // }
        //本月已经巡检了多少点位
        $where=array('r.check_time'=>array('between',array($nowDays,$nowDaye)));
        if(!empty($village_id))$where['m.village_id']=$village_id;
        if(!empty($project_id))$where['m.project_id']=$project_id;
        $nowPointCount = M('village_point_safety_record')
            ->alias('r')
            ->field(array("count(DISTINCT r.pid)"=>'num'))
            ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid ')
            ->where($where)
            ->where(array('p.is_del'=>0))
            ->select()[0]['num'];
        /*dump(M()->_sql());*/
        //还剩多少点位未巡检
        $lowPoint = $pointCount-$nowPointCount;
        if($lowPoint<=0)$lowPoint=0;
        //本月已经巡检的点
        //字段
        $field_now =array(
            'r.*',
            'p.orientation',
            'm.room_name',
            'v.village_name',
            'b.name',
            'u.truename'
        );
        //构建子查询
        $chlidSql = M('house_village_user_bind')->field(array('uid','`name`','MAX(pigcms_id)'))->group('uid')->buildSql();
        //主查询
        $where=array('r.check_time'=>array('between',array($nowDays,$nowDaye)),'r.is_check'=>1);
        if(!empty($village_id))$where['m.village_id']=$village_id;
        if(!empty($project_id))$where['m.project_id']=$project_id;
        $nowPointList = M('village_point_safety_record')
            ->alias('r')
            ->field($field_now)
            ->join('LEFT JOIN '.$chlidSql.' b on b.uid=r.uid')
            ->join('LEFT JOIN __USER__ u on r.uid=u.uid')
            ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
            ->join('LEFT JOIN __HOUSE_VILLAGE__ v on v.village_id=m.village_id')
            ->where($where)
            ->where(array('p.is_del'=>0))
            ->order('r.point_status desc,r.check_time desc')
            ->select();
       // dump($nowPointList);exit;

        //将point_status 进行处理，使其能作为判断的标准
        foreach ($nowPointList as $k => $v) {
            $nowPointList[$k]['point_status'] = explode(',',$v['point_status']);
        }
        // var_dump($nowPointList);exit();

        //正常的巡检点数与异常的巡检点位
        $statusArr = [];
        foreach ($nowPointList as $v) {
            $statusArr[] = $v['point_status'];
        }
        // var_dump( $statusArr);exit();
        $warningNum = 0;
        foreach ($statusArr as $v) {
            // var_dump($v[1]== "status_2-0");exit();
            if ($v[0] == "status_1-1" || $v[1] == "status_2-1" || $v[2] == "status_3-1" || $v[3] == "status_4-1" || $v[4] == "status_5-1") {
                $warningNum += 1;
            }
        }
        
        $warningPoint = $warningNum;
        $safetyPoint = $nowPointCount - $warningPoint;

        //各种描述信息的统计
        
        $spearheadNum = 0;
        $hoseNum = 0;
        $buttonNum = 0;
        $glassNum = 0;
        $extinguisherNum = 0;
        $count = 0;
        
        foreach ( $statusArr as $v) {
            if ($v[0] == "status_1-1") {
                $spearheadNum += 1;
                $count+= 1;
            } elseif ($v[1] == "status_2-1") {
                $hoseNum += 1;
                $count+= 1;
            } elseif ($v[2] == "status_3-1") {
                $buttonNum += 1;
                $count+= 1;
            } elseif ($v[3] == "status_4-1") {
                $glassNum += 1;
                $count+= 1;
            } elseif ($v[4] == "status_5-1") {
                $extinguisherNum += 1;
                $count+= 1;
            }
        }

        $statusNum = array($spearheadNum, $hoseNum, $buttonNum, $glassNum, $extinguisherNum,$count);
        // var_dump($statusNum);exit();

        $this->assign('nowPointCount',$nowPointCount);
        $this->assign('lowPoint',$lowPoint);
        $this->assign('safetyPoint',$safetyPoint);
        $this->assign('warningPoint',$warningPoint);
        $this->assign('statusNum',$statusNum);
        $this->assign('nowPointList',$nowPointList);
        //本月没有巡检的点
        $noInArray = array();
        foreach ($nowPointList as $key=>$value){
            $noInArray[] = $value['pid'];
        }

        //未检字段
        $field_low = array(
            'GROUP_CONCAT(p.orientation) AS oname',
            'm.room_name',
        );
        if(empty($noInArray)){
            $where=array('p.is_del'=>0);
            if(!empty($village_id))$where['m.village_id']=$village_id;
            if(!empty($project_id))$where['m.project_id']=$project_id;
            $lowPointList = M('house_village_point')
                ->alias('p')
                ->field($field_low)
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
                ->where(array('p.type' => 1))
                ->where($where)
                ->group('p.rid')
                ->order('m.room_name asc')
                ->select();
        }else{
            $where=array('p.is_del'=>0,'p.id'=>array('not in',$noInArray));
            if(!empty($village_id))$where['m.village_id']=$village_id;
            if(!empty($project_id))$where['m.project_id']=$project_id;
            $lowPointList = M('house_village_point')
                ->alias('p')
                ->field($field_low)
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
                ->where(array('p.type' => 1))
                ->where($where)
                ->order('m.room_name asc')
                ->group('p.rid')
                ->select();
        }
        // var_dump($lowPointList);exit();
        $this->assign('lowPointList',$lowPointList);

        //时间
        $date = array(
            $year=date('Y'),
            $year=date('m'),
            $day=date('Y-m-d'),
        );
        $this->assign('date',$date);

        $this->display();
    }


    /**
     * 巡检列表，当月已巡检和未巡检(图表页)
     */
    public function check_safety_record_chart(){

        $village_id=$_GET['village_id'];
        $project_id=$_GET['project_id'];
        $where=array('p.is_del'=>0);
        if(!empty($village_id))$where['m.village_id']=$village_id;
        if(!empty($project_id))$where['m.project_id']=$project_id;
        //一共多少巡更点
        $pointCount = M('house_village_point')
                ->alias('p')
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
                ->where(array('p.type' => 1))
                ->where($where)
                ->count();
        //已经巡检的巡更点
        $nowDays = strtotime(date('Y-m-01',time()).'00:00:00');
        $nowDaye = strtotime(date('Y-m-t',time()).'23:59:59');
        
        
        //本月已经巡检了多少点位
        $where=array('r.check_time'=>array('between',array($nowDays,$nowDaye)));
        if(!empty($village_id))$where['m.village_id']=$village_id;
        if(!empty($project_id))$where['m.project_id']=$project_id;
        $nowPointCount = M('village_point_safety_record')
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
        //本月已经巡检的点
        //字段
        $field_now =array(
            'r.*',
            'p.orientation',
            'm.room_name',
            'v.village_name',
            'b.name',
            'u.truename'
        );
        //构建子查询
        $chlidSql = M('house_village_user_bind')->field(array('uid','`name`','MAX(pigcms_id)'))->group('uid')->buildSql();
        //主查询
        $where=array('r.check_time'=>array('between',array($nowDays,$nowDaye)),'r.is_check'=>1);
        if(!empty($village_id))$where['m.village_id']=$village_id;
        if(!empty($project_id))$where['m.project_id']=$project_id;
        $nowPointList = M('village_point_safety_record')
            ->alias('r')
            ->field($field_now)
            ->join('LEFT JOIN '.$chlidSql.' b on b.uid=r.uid')
            ->join('LEFT JOIN __USER__ u on r.uid=u.uid')
            ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
            ->join('LEFT JOIN __HOUSE_VILLAGE__ v on v.village_id=m.village_id')
            ->where($where)
            ->order('r.point_status desc,r.check_time desc')
            ->select();
//        dump($nowPointList);exit;

         //将point_status 进行处理，使其能作为判断的标准
        foreach ($nowPointList as $k => $v) {
            $nowPointList[$k]['point_status'] = explode(',',$v['point_status']);
        }
        // var_dump($nowPointList);exit();

        //正常的巡检点数与异常的巡检点位
        $statusArr = [];
        foreach ($nowPointList as $v) {
            $statusArr[] = $v['point_status'];
        }
        // var_dump( $statusArr);exit();
        $warningNum = 0;
        foreach ($statusArr as $v) {
            // var_dump($v[1]== "status_2-0");exit();
            if ($v[0] == "status_1-1" || $v[1] == "status_2-1" || $v[2] == "status_3-1" || $v[3] == "status_4-1" || $v[4] == "status_5-1") {
                $warningNum += 1;
            }
        }
        
        $warningPoint = $warningNum;
        $safetyPoint = $nowPointCount - $warningPoint;

        //各种描述信息的统计
        
        $spearheadNum = 0;
        $hoseNum = 0;
        $buttonNum = 0;
        $glassNum = 0;
        $extinguisherNum = 0;
        $count = 0;
        
        foreach ( $statusArr as $v) {
            if ($v[0] == "status_1-1") {
                $spearheadNum += 1;
                $count+= 1;
            } elseif ($v[1] == "status_2-1") {
                $hoseNum += 1;
                $count+= 1;
            } elseif ($v[2] == "status_3-1") {
                $buttonNum += 1;
                $count+= 1;
            } elseif ($v[3] == "status_4-1") {
                $glassNum += 1;
                $count+= 1;
            } elseif ($v[4] == "status_5-1") {
                $extinguisherNum += 1;
                $count+= 1;
            }
        }

        $statusNum = array($spearheadNum, $hoseNum, $buttonNum, $glassNum, $extinguisherNum,$count);
        // var_dump($statusNum);exit();

        $this->assign('nowPointCount',$nowPointCount);
        $this->assign('lowPoint',$lowPoint);
        $this->assign('safetyPoint',$safetyPoint);
        $this->assign('warningPoint',$warningPoint);
        $this->assign('statusNum',$statusNum);
        $this->assign('nowPointList',$nowPointList);
        //本月没有巡检的点
        $noInArray = array();
        foreach ($nowPointList as $key=>$value){
            $noInArray[] = $value['pid'];
        }
        // var_dump($noInArray); exit();
        //未检字段
        $field_low = array(
            'GROUP_CONCAT(p.orientation) AS oname',
            'm.room_name',
        );
        if(empty($noInArray)){
            $where=array('p.is_del'=>0);
            if(!empty($village_id))$where['m.village_id']=$village_id;
            if(!empty($project_id))$where['m.project_id']=$project_id;
            $lowPointList = M('house_village_point')
                ->alias('p')
                ->field($field_low)
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
                ->where(array('p.type' => 1))
                ->where($where)
                ->group('p.rid')
                ->order('m.room_name asc')
                ->select();
        }else{
            $where=array('p.is_del'=>0,'p.id'=>array('not in',$noInArray));
            if(!empty($village_id))$where['m.village_id']=$village_id;
            if(!empty($project_id))$where['m.project_id']=$project_id;
            $lowPointList = M('house_village_point')
                ->alias('p')
                ->field($field_low)
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
                ->where(array('p.type' => 1))
                ->where($where)
                ->order('m.room_name asc')
                ->group('p.rid')
                ->select();
        }

        $this->assign('lowPointList',$lowPointList);

        //时间
        $date = array(
            $year=date('Y'),
            $year=date('m'),
            $day=date('Y-m-d'),
        );
        $this->assign('date',$date);

        $this->display();
    }


    /**
     * 巡检记录详细
     */
    public function record_safety_detail(){
        $id = I('get.id');
        //条件
        $_map =array('p.is_del'=>0,'r.pigcms_id'=>array('eq',$id));
        //字段
        $field_now =array(
            'r.*',
            'p.orientation',
            'm.room_name',
            'v.village_name',
            'b.name',
            'u.truename'
        );
        //构建子查询
        $chlidSql = M('house_village_user_bind')->field(array('uid','`name`','MAX(pigcms_id)'))->group('uid')->buildSql();
        //主查询
        $pointRecord = M('village_point_safety_record')
            ->alias('r')
            ->field($field_now)
            ->join('LEFT JOIN '.$chlidSql.' b on b.uid=r.uid')
            ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
            ->join('LEFT JOIN __HOUSE_VILLAGE__ v on v.village_id=m.village_id')
            ->join('LEFT JOIN __USER__ u on u.uid=r.uid')
            ->where($_map)
            ->find();
        if (empty($pointRecord['name'])) $pointRecord['name'] = D('user')->where(array('uid'=>$pointRecord['uid']))->getField('truename');
        /*var_dump($pointRecord);exit();*/

        //对 image 进行判断处理
        $images = explode(',',$pointRecord['image']);

        // $data = json_encode($images);
        // var_dump($data);exit();
        // $this -> assign('list',$data);

        // var_dump($images);exit();
        //对point_status数据进行处理，方便前端进行处理
        $pointRecord['point_status'] = explode(',',$pointRecord['point_status']);
        // var_dump($pointRecord);exit();
        //vdump(M()->_sql());
        $this->assign('pointRecord',$pointRecord);
        $this->assign('images',$images);
        $this->display();
    }


    /**
     * 巡检异常设备列表显示
     */
    public function check_safety_record_menu(){
        $data = $_GET;

        // var_dump($data);exit();
    
        
        //已经巡检的消防点
        $nowDays = strtotime(date('Y-m-01',time()).'00:00:00');
        $nowDaye = strtotime(date('Y-m-t',time()).'23:59:59');
        //字段
        $field_now =array(
            'r.*',
            'p.orientation',
            'm.room_name',
            'v.village_name',
            'b.name',
            'u.truename'
        );
        //构建子查询
        $chlidSql = M('house_village_user_bind')->field(array('uid','`name`','MAX(pigcms_id)'))->group('uid')->buildSql();
        //主查询
        $where=array('r.check_time'=>array('between',array($nowDays,$nowDaye)),'r.is_check'=>1);
        if(!empty($village_id))$where['m.village_id']=$village_id;
        if(!empty($project_id))$where['m.project_id']=$project_id;
        //在这里对数据进行判断，判断是显示单条的还是总的
        if ($data['status'] == status) {
                $where['_string']='find_in_set("'.'status_1-1'.'",r.point_status) or ';
                $where['_string'] .='find_in_set("'.'status_2-1'.'",r.point_status) or ';
                $where['_string'] .='find_in_set("'.'status_3-1'.'",r.point_status) or ';
                $where['_string'] .='find_in_set("'.'status_4-1'.'",r.point_status) or ';
                $where['_string'] .='find_in_set("'.'status_5-1'.'",r.point_status)';
                $nowPointList = M('village_point_safety_record')
                ->alias('r')
                ->field($field_now)
                ->join('LEFT JOIN '.$chlidSql.' b on b.uid=r.uid')
                ->join('LEFT JOIN __USER__ u on r.uid=u.uid')
                ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
                ->join('LEFT JOIN __HOUSE_VILLAGE__ v on v.village_id=m.village_id')
                ->where($where)     
                ->order('r.point_status desc,r.check_time desc')
                ->select();
        } else {
                $where['_string']='find_in_set("'.$data['status'].'",r.point_status)';
                $nowPointList = M('village_point_safety_record')
                    ->alias('r')
                    ->field($field_now)
                    ->join('LEFT JOIN '.$chlidSql.' b on b.uid=r.uid')
                    ->join('LEFT JOIN __USER__ u on r.uid=u.uid')
                    ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
                    ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
                    ->join('LEFT JOIN __HOUSE_VILLAGE__ v on v.village_id=m.village_id')
                    ->where($where)     
                    ->order('r.point_status desc,r.check_time desc')
                    ->select();                 
                
        }
        // dump(M()->_sql());
        // var_dump($nowPointList);exit();
      
        $this->assign('nowPointList',$nowPointList);      

        //时间
        $date = array(
            $year=date('Y'),
            $year=date('m'),
            $day=date('Y-m-d'),
        );
        $this->assign('date',$date);

        $this->display();
    }




    /**
     * 扫码后跳转方法
     */
//    public function punch_card(){
//        //查询审核权限
//        $openid = session('user.openid');
//        $allowMenu = 174;
//        $adminRole = M('admin')->getFieldByOpenid($openid,'role_id');
//        $allow_menus = M('role','pigcms_')->where('role_id=%d',$adminRole)->getField('menus');
//        $allow_menus_arr = explode(',',$allow_menus);
//        //vd($openid);exit;
//        if(!in_array($allowMenu,$allow_menus_arr)){
//            $this->error("你没有权限！");
//        }
//        $id = I('get.id');
//        $pointArray = M('house_village_point')
//            ->alias('p')
//            ->field(array('p.*','r.room_name'))
//            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ r on r.id=p.rid')
//            ->where(array('p.id'=>$id))
//            ->find();
//        $this->assign('pointArray',$pointArray);
//        //vd($_SESSION);
//        $this->display();
//    }

    /**
     * 多角色权限处理后扫码后跳转方法
     */
    public function punch_card(){
        //查询审核权限
        $id = I('get.id');//二维码id
        $openid = session('openid');
        $user_uid = D('user')->where(array('openid'=>$openid))->getField('uid');

        if (!$openid || !$user_uid) $this->redirect(U('Home/index_new',array('fff_zzz'=>$id)));

//        $allowMenu = 174;
//        $adminRole = M('admin')->getFieldByOpenid($openid,'role_id');
//
//        $role_idArr = explode(',',$adminRole);
//        $is_allowing_string = '';
//        //角色权限遍历整合
//        foreach ($role_idArr as $v) {
//            $string = M('role')->where(array('role_id'=>$v))->getField('menus');
//            $is_allowing_string .= $string.',';
//        }
//        $is_allowing_string = trim($is_allowing_string,',');

        //去重
        //$allow_menus_arr = array_unique(explode(',',$is_allowing_string));
        //去除权限限制 zhukeqin
        /*if(!in_array($allowMenu,$allow_menus_arr)){
            $this->error("你没有权限！");
        }*/
        $name = D('user')->where(array('openid'=>$openid))->getField('truename');
        if (empty($name)) $name = D('house_village_user_bind')->where(array('uid'=>$user_uid))->getField('name');
        if (empty($name)) $name = D('admin')->where(array('openid'=>$openid))->getField('realname');;
        if ($name) $this->assign('name',$name);

        $pointArray = M('house_village_point')
            ->alias('p')
            ->field(array('p.*','r.room_name','r.village_id','r.project_id'))
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ r on r.id=p.rid')
            ->where(array('type' => 0))
            ->where(array('p.id'=>$id))
            ->find();
        //dump(M()->_sql());
        $this->assign('pointArray',$pointArray);
        //vd($_SESSION);
        $this->display();
    }

    /**
     * 处理点位提交信息
     */
    public function deal_point(){
        $_pata = $_POST;

        //如果不是管理员或者业主，就将名字存入user表中
        $f1 = D('admin')
          ->field(array('realname','village_id'))
          ->where(array('openid'=>$_SESSION['openid']))
          ->select();
        $f2 = D('house_village_user_bind')
          ->field(array('name','village_id'))
          ->where(array('uid'=>$_SESSION['user']['uid']))
          ->select();
        $f3 = D('user')->where(array('openid'=>$_SESSION['openid']))->getField('truename');
        if(empty(trim($_POST['name']))){
            $this->error('请填写您的姓名');
        }
        if(trim($_POST['name'])){
            D('user')->where(array('openid'=>$_SESSION['openid']))->save(array('truename'=>$_POST['name']));
        }elseif(empty($f3)){
            $this->error('请填写您的姓名');
        }
        if (!$f1['realname'] && !$f2['name'] && !$f3) D('user')->where(array('openid'=>$_SESSION['openid']))->save(array('truename'=>$_POST['name']));
        unset($_pata['name']);

        //是否设置班次信息
        $village_id = $f1['village_id'];
        if (!$village_id) {
            $village_id = $f2['village_id'];
        }
        $is_set = M('house_village_shift')->where(array('village_id'=>$village_id))->find();
        if (!$is_set) {
            $is_set = M('house_village_shift')->where(array('id'=>1))->find();
        }

        $imageArray =array();
        if($_FILES['imageUrl']['name'][0]!=''){
            if($_FILES['imageUrl']['error'][0]==0){
                import('ORG.Net.UploadFile');
                $upload = new UploadFile();// 实例化上传类
//                $upload->maxSize = 3145728;// 设置附件上传大小
                $upload->maxSize = 5000000;// 设置附件上传大小
                $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                $upload->savePath = './upload/adver/';// 设置附件上传目录
                $upload->autoSub = true; //使用子目录上传模式
                $upload->subType = 'date';  //使用date作为子目录的名称
                $upload->dateFormat = 'Y/m/d';//指定date的格式
                $upload->saveName = array('uniqid','');
                if (!$upload->upload()) {
                    // 上传错误提示错误信息
                    $this->error($upload->getErrorMsg());
                } else {
                    // 上传成功 获取上传文件信息
                    $info = $upload->getUploadFileInfo();
                    foreach ($info as $file){
                        $imageArray[] = $file['savename'];
                    }

                }
            }else{
                $this->error('上传失败');
            }
        }
        //判断该点位是否已经巡检过了
        //当天班的时间戳
        //已经巡检的巡更点
        $nowTime = time();
        if($nowTime>=strtotime(date('Y-m-d').$is_set['morning_time_from'])&&$nowTime<=strtotime(date('Y-m-d').$is_set['morning_time_to'])){
            $nowDays = strtotime(date('Y-m-d').$is_set['morning_time_from']);
            $nowDaye = strtotime(date('Y-m-d').$is_set['morning_time_to']);
        }elseif ($nowTime>=strtotime(date('Y-m-d').$is_set['middle_time_from'])&&$nowTime<=strtotime(date('Y-m-d').$is_set['middle_time_to'])){
            $nowDays = strtotime(date('Y-m-d').$is_set['middle_time_from']);
            $nowDaye = strtotime(date('Y-m-d').$is_set['middle_time_to']);
        }elseif ($nowTime>=strtotime(date('Y-m-d').$is_set['night_time_from'])&&$nowTime<=strtotime('+1 day',strtotime(date('Y-m-d').$is_set['night_time_to']))){
            $nowDays = strtotime(date('Y-m-d').$is_set['night_time_from']);
            $nowDaye = strtotime('+1 day',strtotime(date('Y-m-d').$is_set['night_time_to']));
        }
        $is_check = M('village_point_record')->where(array('pid'=>$_pata['point_id'],'check_time'=>array('between',array($nowDays,$nowDaye))))->find();
        if($is_check){
            //重复上传则，更新当前的信息
            $updateArray = array(
                'uid'=>session('user.uid'),
                'check_time'=>time(),
                'point_status'=>$_pata['point_status'],
                'point_desc'=>$_pata['point_desc']?:'',
                'warning_level'=>$_pata['warning_level']?:0
            );
            //对多图片上传的处理
            if(count($imageArray)>1){
                $updateArray['image'] = join(",",$imageArray);
            }else{
                $updateArray['image'] = $imageArray[0];
            }
            //将异常添加到报修业务
            $updateArray['pid'] = $_pata['point_id'];
            $this->extra_act_for_deal_point($updateArray);
            //dump($updateArray);exit();
            $res = M('village_point_record')->where(array('pigcms_id'=>$is_check['pigcms_id']))->data($updateArray)->save();

            if($res){
                $this->p_suc('上报更新成功',$_pata['point_id']);
            }else{
                $this->p_err('上报更新失败',$_pata['point_id']);
            }

        }else{
            //添加数组定义
            if($_pata['point_status'] ==0){
                $addArray = array(
                    'pid'=>$_pata['point_id'],
                    'uid'=>session('user.uid'),
                    'check_time'=>time(),
                    'is_check'=>1,
                    'point_status'=>$_pata['point_status'],
                    'point_desc'=>$_pata['point_desc']?:'',
                    'warning_level'=>0
                );
            }else{
                $addArray = array(
                    'pid'=>$_pata['point_id'],
                    'uid'=>session('user.uid'),
                    'check_time'=>time(),
                    'is_check'=>1,
                    'point_status'=>$_pata['point_status'],
                    'point_desc'=>$_pata['point_desc']?:'',
                    'warning_level'=>$_pata['warning_level']
                );
            }
            //对多图片上传的处理
            if(count($imageArray)>1){
                $addArray['image'] = join(",",$imageArray);
            }else{
                $addArray['image'] = $imageArray[0];
            }
            //添加
            //vd($addArray);exit;
            //将异常添加到报修业务
            $this->extra_act_for_deal_point($addArray);
            $res = M('village_point_record')->data($addArray)->add();
            if($res){

                $this->p_suc('上报成功',$addArray['pid']);
            }else{
                $this->p_err('上报失败',$addArray['pid']);
            }
        }


    }

    /**
     * 巡更上报附加操作：报修提交，推送消息
     * @param $data
     * @update-time: 2017-12-01 09:55:52
     * @author: 王亚雄
     * 巡更异常上报数据格式参考
     * array(6) {
            * ["uid"] => string(4) "1548"
            * ["check_time"] => int(1512010297)
     *      ["pid"]=>int(4)
            * ["point_status"] => string(1) "1"
            * ["point_desc"] => string(18) "吃是发士大夫"
            * ["warning_level"] => string(1) "3"
            * ["image"] => string(28) "2017/11/30/5a1f723939c22.jpg"
        * }
     * ./upload/adver/
     * 报修表单提交的数据参考格式
     * array(5) {
            * ["content"] => string(44) "类别：灯具  内容：更换日光灯管"
            * ["contact"] => string(11) "17768686868"
            * ["village_id"] => string(1) "4"
            * ["image"] => array(1) {
                * [0] => string(47) "/upload/house/53/000/001/548/20171130104622.jpg"
            * }
            * ["details"] => string(4) "test"
        * }
     */
    public function extra_act_for_deal_point($data){
        if($data['point_status']==0) return; //未出现异常，不用进行报修

        //巡更异常上报数据格式 转化成 报修表单提交的数据格式
        $format_data = array(); //报修表单数据设置

        //摘要content
        $format_data['content']     =   "类别：其他 - ";
        $format_data['content']     .=  "巡更异常反馈";
        $format_data['content']     .=  "（{$this->_get_warning_level_desc($data['warning_level'])}）";
        //联系方式，社区id
        $format_data['contact']     =   user_info()['phone'];
        $format_data['village_id']  =   user_info()['village_id'];

        //图片
        $img_pre = "/upload/adver/"; //巡更异常上报图片保留目录
        if(is_array($data['image'])){
            $format_data['image'] = array_map(function($v)use($img_pre){
                return $img_pre . $v;
            },$data['image']);
        }else{
            $format_data['image'] = [ $img_pre . $data['image'] ];
        }

        //详细
        $pointArray = M('house_village_point')
            ->alias('p')
            ->field(array('p.*','r.room_name'))
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ r on r.id=p.rid')
            ->where(array('type' => 0))
            ->where(array('p.id'=>$data['pid']))
            ->find();
        $format_data['details'] = "地点：" .$pointArray['room_name'] . $pointArray['orientation'] . '，';
        $format_data['details'] .= $data['point_desc'];
        //dump($format_data); exit();
        //报修表单提交
        $post = $_POST;
        $_POST = $format_data;
        $ctr = new HouseAction();
        $re = $ctr->ajax_submit_form();
        $_POST = $post;
        return $re;
    }

    /**
     * 获取警告等级描述
     * @param $warning_level
     * @return string
     * @update-time: 2017-12-01 09:56:05
     * @author: 王亚雄
     */
    protected function _get_warning_level_desc($warning_level){
        $warning_level_desc = "";            //异常状态描述
        switch($warning_level){
            case 1 : $warning_level_desc = "一般";      break;
            case 2 : $warning_level_desc = "紧急";      break;
            case 3 : $warning_level_desc = "非常紧急";  break;
        }
        return $warning_level_desc;
    }

    //获取社区名称
    public  function get_village_list($village_id=0){
        $tmp = M('house_village')->field('village_id,village_name')->select();
        $village_list = array();
        foreach($tmp as $row){
            $village_list[$row['village_id']] = $row['village_name'];
        }
        if($village_id) return $village_list[$village_id];
        return $village_list;
    }
    /**
     * 在线报修 管理员审核页
     * @param $repair_id `pigcms_house_village_repair_list`表主键
     * @update-time: 2017-12-01 09:57:10
     * @author: 王亚雄
     */
    public function repair_inform($repair_id){
        $repair_info = M('house_village_repair_list')->where('pigcms_id=%d',$repair_id)->find();
        $repair_info['village_name'] = $this->get_village_list($repair_info['village_id']);
        $repair_info['nickname'] = user_info($repair_info['uid'])['nickname'];
        //图片处理
        if($repair_info['pic']){
            $repair_info['pic'] = explode('|', $repair_info['pic']);
            $picArray = array();
            foreach ($repair_info['pic'] as $pic){
                if(strpos($pic,'upload/adver')>-1){
                    $picArray[] = C('config.site_url').$pic;
                }else{
                    $picArray[] = C('config.site_url')."/upload/house/".$pic;
                }
            }
            $repair_info['pic'] = $picArray;
        }
        $this->assign('info',$repair_info);
        //dump($repair_info);
        $this->display();
    }

    /**
     * 在线报修列表
     */
    public function repair_list(){
        new House_village_repair_listModel();
        $repair_list = D('House_village_repair_list')->getlist();
        foreach($repair_list['repair_list'] as &$row){
            $row['create_date'] = date("Y-m-d H:i",$row['time']);
        }
        unset($row);
        $this->assign('list',$repair_list);
        $this->display();
    }

    /**
     * 在线报修标记为已处理
     * @param $repair_id
     */
    public function audit_repair($repair_id){
        $re = M('house_village_repair_list')
            ->where('pigcms_id=%d',$repair_id)
            ->setField('is_read',1);

        if($re!==false){//发送消息
            $data_repair = M('house_village_repair_list')->where('pigcms_id=%d',$repair_id)->find();
            $wechat  = new WechatModel();
            $tpl_id = $wechat::TPLID_WYGLTZ;
            $openids = user_info($data_repair['uid'])['openid'];
            $data = array(
                'first'=>array(
                    'value'=>"在线报修业务提醒",
                    'color'=>"#029700",
                ),
                'keyword1'=>array(
                    'value'=>"您反馈的设备故障正在检修中",
                    'color'=>"#000000",
                ),
                'keyword2'=>array(
                    'value'=>date("Y-m-d H:i"),
                    'color'=>"#000000",
                ),
                'keyword3'=>array(
                    'value'=>msubstr($data_repair['details'],0,16),
                    'color'=>"#000000",
                ),
                'keyword4'=>array(
                    'value'=>"点击查看详情",
                    'color'=>"#000000",
                ),
            );
            $url = C('WEB_DOMAIN') . '/wap.php?g=Wap&c=PropertyService&a=repair_inform&repair_id=' . $repair_id;
            $wechat->send_tpl_message($openids,$tpl_id,$url,$data);
            ////发送消息结束


            $this->success("处理完毕",U('repair_list'));
        }else{
            $this->error("发生错误",U('repair_inform',array('repair_id'=>$repair_id)));
        }
    }


    /**
     * 巡更列表，当前班次已巡更和未巡更
     */
    public function check_record(){
        $village_id=$_GET['village_id'];
        $project_id=$_GET['project_id'];
        $time=$_GET['time'];  //添加了时间验证,这样可以查看其它日期的巡更情况
        // $timeStr = strtotime($time);
        // var_dump($time);exit();
        
        //是否设置班次信息
        $is_set = M('house_village_shift')->where(array('village_id'=>$village_id))->find();
        if (!$is_set) {
            $is_set = M('house_village_shift')->where(array('id'=>1))->find();
        } 
        
        $where=array('p.is_del'=>0);
        if(!empty($village_id))$where['m.village_id']=$village_id;
        if(!empty($project_id))$where['m.project_id']=$project_id;
        //一共多少巡更点
        $pointCount = M('house_village_point')
                ->alias('p')
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
                ->where(array('type' => 0,'is_del'=>0))
                ->where($where)
                ->count();
        //已经巡检的巡更点
        if(isset($time)){
            // $nowTime = $timeStr;
            $nowDays = strtotime($time.$is_set['morning_time_from']);
            $nowDaye = strtotime('+1 day',strtotime($time.$is_set['night_time_to']));
            // $nowDaye = strtotime($time.'07:00:00');
        }else{
            $nowTime = time();
            if($nowTime>=strtotime(date('Y-m-d').$is_set['morning_time_from'])&&$nowTime<=strtotime(date('Y-m-d').$is_set['morning_time_to'])){
                $nowDays = strtotime(date('Y-m-d').$is_set['morning_time_from']);
                $nowDaye = strtotime(date('Y-m-d').$is_set['morning_time_to']);
            }elseif ($nowTime>=strtotime(date('Y-m-d').$is_set['middle_time_from'])&&$nowTime<=strtotime(date('Y-m-d').$is_set['middle_time_to'])){
                $nowDays = strtotime(date('Y-m-d').$is_set['middle_time_from']);
                $nowDaye = strtotime(date('Y-m-d').$is_set['middle_time_to']);
            }elseif ($nowTime>=strtotime(date('Y-m-d').$is_set['night_time_from'])&&$nowTime<=strtotime('+1 day',strtotime(date('Y-m-d').$is_set['night_time_to']))){
                $nowDays = strtotime(date('Y-m-d').$is_set['night_time_from']);
                $nowDaye = strtotime('+1 day',strtotime(date('Y-m-d').$is_set['night_time_to']));
            }
        }        
        
        //本班次已经巡检了多少点位
        $where=array('r.check_time'=>array('between',array($nowDays,$nowDaye)));
        if(!empty($village_id))$where['m.village_id']=$village_id;
        if(!empty($project_id))$where['m.project_id']=$project_id;
        $nowPointCount = M('village_point_record')
            ->alias('r')
            ->field(array("count(DISTINCT r.pid)"=>'num'))
            ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid ')
            ->where($where)
            ->where(array('p.is_del'=>0))
            ->select()[0]['num'];
        // var_dump($pointCount);
        // var_dump($nowPointCount);exit();
        /*dump(M()->_sql());*/
        //还剩多少点位未巡检
        $lowPoint = intval($pointCount-$nowPointCount)?:0;
        if($lowPoint<=0)$lowPoint=0;
        //本班次已经巡检的点
        //字段
        $field_now =array(
            'r.*',
            'p.orientation',
            'm.room_name',
            'v.village_name',
            'b.name',
            'u.truename'
        );
        //构建子查询
        $chlidSql = M('house_village_user_bind')->field(array('uid','`name`','MAX(pigcms_id)'))->group('uid')->buildSql();
        //主查询
        $where=array('r.check_time'=>array('between',array($nowDays,$nowDaye)),'r.is_check'=>1);
        if(!empty($village_id))$where['m.village_id']=$village_id;
        if(!empty($project_id))$where['m.project_id']=$project_id;
        $nowPointList = M('village_point_record')
            ->alias('r')
            ->field($field_now)
            ->join('LEFT JOIN '.$chlidSql.' b on b.uid=r.uid')
            ->join('LEFT JOIN __USER__ u on r.uid=u.uid')
            ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
            ->join('LEFT JOIN __HOUSE_VILLAGE__ v on v.village_id=m.village_id')
            ->where($where)
            ->where(array('p.is_del'=>0))
            ->order('r.point_status desc,r.check_time desc')
            ->select();
//        dump($nowPointList);exit;
        //正常的巡更点数
        $where=array('r.check_time'=>array('between',array($nowDays,$nowDaye)),'r.point_status'=>0,'p.is_del'=>0);
        if(!empty($village_id))$where['m.village_id']=$village_id;
        if(!empty($project_id))$where['m.project_id']=$project_id;
        $safetyPoint = M('village_point_record')
            ->alias('r')
            ->field(array("count(DISTINCT r.pid)"=>'num'))
            ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid ')
            ->where($where)
            ->select()[0]['num'];
        
        //不正常的点
        $where['r.point_status']=1;
        $warningPoint = M('village_point_record')
            ->alias('r')
            ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid ')
            ->where($where)
            ->count();
        $this->assign('safetyPoint',$safetyPoint);
        $this->assign('warningPoint',$warningPoint);
        //本班次没有巡更的点
        $noInArray = array();
        foreach ($nowPointList as $key=>$value){
            $noInArray[] = $value['pid'];
        }
        //未检字段
        $field_low = array(
            'GROUP_CONCAT(p.orientation) AS oname',
            'm.room_name',
        );
        if(empty($noInArray)){
            $where=array('p.is_del'=>0);
            if(!empty($village_id))$where['m.village_id']=$village_id;
            if(!empty($project_id))$where['m.project_id']=$project_id;
            $lowPointList = M('house_village_point')
                ->alias('p')
                ->field($field_low)
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
                ->where(array('type' => 0))
                ->where($where)
                ->group('p.rid')
                ->order('m.room_name asc')
                ->select();
        }else{
            $where=array('p.is_del'=>0,'p.id'=>array('not in',$noInArray));
            if(!empty($village_id))$where['m.village_id']=$village_id;
            if(!empty($project_id))$where['m.project_id']=$project_id;
            $lowPointList = M('house_village_point')
                ->alias('p')
                ->field($field_low)
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
                ->where(array('type' => 0))
                ->where($where)
                ->order('m.room_name asc')
                ->group('p.rid')
                ->select();
        }


        //TODO: 微信JSSDK配置

        $share_arr=array(	//微信分享开始
            'title'=>'汇得行智慧助手',
            'desc'=>'打造真正的智慧物业服务平台',
            'imgUrl'=>C('config.site_url').'/tpl/Wap/default/static/images/house.jpg',
            'link'=>C('config.site_url').'/wap.php?g=Wap&c=Home&a=index'
        );
        $share = new WechatShare($this->config, $_SESSION['openid'],$share_arr);
        $this->shareScript = $share->getSgin();
        $this->assign('shareScript', $this->shareScript);//微信分享结束

        //vd($lowPointList);exit;
        $this->assign('nowPointCount',$nowPointCount);
        $this->assign('lowPoint',$lowPoint);
        $this->assign('nowPointList',$nowPointList);
        $this->assign('lowPointList',$lowPointList);
        $this->display();
    }

    /**
     * 巡更列表，当前班次已巡更和未巡更
     */
    public function check_record2(){
        //筛选社区
        if ($_GET['village_id']) {
            $village_id =  $_GET['village_id'];
        } else {
            $openid = $_SESSION['openid'];
            $village_id = D('admin')->where(array('openid'=>$openid))->find()['village_id'];
        }

        //一共多少巡更点
        $pointCount = M('house_village_point')->alias('p')
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
                ->join('LEFT JOIN __HOUSE_VILLAGE__ v on v.village_id=m.village_id')
                ->where(array('type' => 0))
                ->where(array('p.is_del'=>0,'v.village_id'=>$village_id))
                ->count();

        //已经巡检的巡更点
        $nowTime = I('get.ym');
        $nowDays = $nowTime+7*3600;
        $nowDaye = $nowTime+31*3600;
        //本班次已经巡检了多少点位
        $nowPointCount = M('village_point_record')->alias('r')
            ->field(array("count(DISTINCT r.pid)"=>'num'))
            ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
            ->join('LEFT JOIN __HOUSE_VILLAGE__ v on v.village_id=m.village_id')
            ->where(array('r.check_time'=>array('between',array($nowDays,$nowDaye))))
            ->where(array('v.village_id'=>$village_id))
            ->select()[0]['num'];

        //还剩多少点位未巡检
        $lowPoint = $pointCount-$nowPointCount;
        if($lowPoint<=0)$lowPoint=0;

        //本班次已经巡检的点
        //字段
        $field_now =array(
            'r.*',
            'p.orientation',
            'm.room_name',
            'v.village_name',
            'b.name'
        );
        $map['v.village_id'] = array('eq',$village_id);
        //构建子查询
        $chlidSql = M('house_village_user_bind')->field(array('uid','`name`','MAX(pigcms_id)'))->group('uid')->buildSql();
        //主查询
        $nowPointList = M('village_point_record')
            ->alias('r')
            ->field($field_now)
            ->join('LEFT JOIN '.$chlidSql.' b on b.uid=r.uid')
            ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
            ->join('LEFT JOIN __HOUSE_VILLAGE__ v on v.village_id=m.village_id')
            ->where(array('r.check_time'=>array('between',array($nowDays,$nowDaye)),'r.is_check'=>1))
            ->where($map)
            ->order('r.point_status desc,r.check_time desc')
            ->select();
        //正常的巡更点数
//        $safetyPoint = M('village_point_record')->where(array('check_time'=>array('between',array($nowDays,$nowDaye)),'point_status'=>0))->count();
        $safetyPoint = M('village_point_record')
            ->alias('r')
            ->field($field_now)
            ->join('LEFT JOIN '.$chlidSql.' b on b.uid=r.uid')
            ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
            ->join('LEFT JOIN __HOUSE_VILLAGE__ v on v.village_id=m.village_id')
            ->where(array('r.check_time'=>array('between',array($nowDays,$nowDaye)),'r.point_status'=>0))
            ->where($map)
            ->count();
        //不正常的点
        //$warningPoint = M('village_point_record')->where(array('check_time'=>array('between',array($nowDays,$nowDaye)),'point_status'=>1))->count();
        $warningPoint = M('village_point_record')
            ->alias('r')
            ->field($field_now)
            ->join('LEFT JOIN '.$chlidSql.' b on b.uid=r.uid')
            ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
            ->join('LEFT JOIN __HOUSE_VILLAGE__ v on v.village_id=m.village_id')
            ->where(array('r.check_time'=>array('between',array($nowDays,$nowDaye)),'r.point_status'=>1))
            ->where($map)
            ->count();
        $this->assign('safetyPoint',$safetyPoint);
        $this->assign('warningPoint',$warningPoint);
        //本班次没有巡更的点
        $noInArray = array();
        foreach ($nowPointList as $key=>$value){
            $noInArray[] = $value['pid'];
        }
        //未检字段
        $field_low = array(
            'GROUP_CONCAT(p.orientation) AS oname',
            'm.room_name',
        );
        if(empty($noInArray)){
            $lowPointList = M('house_village_point')
                ->alias('p')
                ->field($field_low)
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
                ->join('LEFT JOIN __HOUSE_VILLAGE__ v on v.village_id=m.village_id')
                ->where(array('type' => 0))
                ->where($map)
                ->where(array('p.is_del'=>0))
                ->group('p.rid')
                ->order('m.room_name asc')
                ->select();
        }else{
            $lowPointList = M('house_village_point')
                ->alias('p')
                ->field($field_low)
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
                ->join('LEFT JOIN __HOUSE_VILLAGE__ v on v.village_id=m.village_id')
                ->where(array('type' => 0))
                ->where($map)
                ->where(array('p.is_del'=>0,'p.id'=>array('not in',$noInArray)))
                ->order('m.room_name asc')
                ->group('p.rid')
                ->select();
        }


        //TODO: 微信JSSDK配置

        $share_arr=array(	//微信分享开始
            'title'=>'汇得行智慧助手',
            'desc'=>'打造真正的智慧物业服务平台',
            'imgUrl'=>C('config.site_url').'/tpl/Wap/default/static/images/house.jpg',
            'link'=>C('config.site_url').'/wap.php?g=Wap&c=Home&a=index'
        );
        $share = new WechatShare($this->config, $_SESSION['openid'],$share_arr);
        $this->shareScript = $share->getSgin();
        $this->assign('shareScript', $this->shareScript);//微信分享结束

        $this->assign('nowPointCount',$nowPointCount);
        $this->assign('lowPoint',$lowPoint);
        $this->assign('nowPointList',$nowPointList);
        $this->assign('lowPointList',$lowPointList);
        $this->display();
    }


    public function check_record_bck(){

        //一共多少巡更点
        $pointCount = M('house_village_point')->where(array('type' => 0))->where(array('is_del'=>0))->count();
        //已经巡检的巡更点
        $nowTime = time();
        if($nowTime>=strtotime(date('Y-m-d').'07:00:00')&&$nowTime<=strtotime(date('Y-m-d').'15:00:00')){
            $nowDays = strtotime(date('Y-m-d').'07:00:00');
            $nowDaye = strtotime(date('Y-m-d').'15:00:00');
        }elseif ($nowTime>=strtotime(date('Y-m-d').'15:00:00')&&$nowTime<=strtotime(date('Y-m-d').'23:00:00')){
            $nowDays = strtotime(date('Y-m-d').'15:00:00');
            $nowDaye = strtotime(date('Y-m-d').'23:00:00');
        }elseif ($nowTime>=strtotime(date('Y-m-d').'23:00:00')&&$nowTime<=strtotime('+1 day',strtotime(date('Y-m-d').'07:00:00'))){
            $nowDays = strtotime(date('Y-m-d').'23:00:00');
            $nowDaye = strtotime('+1 day',strtotime(date('Y-m-d').'07:00:00'));
        }
        //本班次已经巡检了多少点位
        $nowPointCount = M('village_point_record')->where(array('check_time'=>array('between',array($nowDays,$nowDaye))))->count();
        //还剩多少点位未巡检
        $lowPoint = $pointCount-$nowPointCount;
        //本班次已经巡检的点
        //字段
        $field_now =array(
            'r.*',
            'p.orientation',
            'm.room_name',
            'v.village_name',
            'b.name'
        );
        //构建子查询
        $chlidSql = M('house_village_user_bind')->field(array('uid','`name`','MAX(pigcms_id)'))->group('uid')->buildSql();
        //主查询
        $nowPointList = M('village_point_record')
            ->alias('r')
            ->field($field_now)
            ->join('LEFT JOIN '.$chlidSql.' b on b.uid=r.uid')
            ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
            ->join('LEFT JOIN __HOUSE_VILLAGE__ v on v.village_id=m.village_id')
            ->where(array('r.check_time'=>array('between',array($nowDays,$nowDaye)),'r.is_check'=>1))
            ->order('r.point_status desc,r.check_time desc')
            ->select();
        //正常的巡更点数
        $safetyPoint = M('village_point_record')->where(array('check_time'=>array('between',array($nowDays,$nowDaye)),'point_status'=>0))->count();
        //不正常的点
        $warningPoint = M('village_point_record')->where(array('check_time'=>array('between',array($nowDays,$nowDaye)),'point_status'=>1))->count();

        $this->assign('safetyPoint',$safetyPoint);
        $this->assign('warningPoint',$warningPoint);
        //本班次没有巡更的点
        $noInArray = array();
        foreach ($nowPointList as $key=>$value){
            $noInArray[] = $value['pid'];
        }
        //未检字段
        $field_low = array(
            'GROUP_CONCAT(p.orientation) AS oname',
            'm.room_name',
        );
        if(empty($noInArray)){
            $lowPointList = M('house_village_point')
                ->alias('p')
                ->field($field_low)
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
                ->where(array('p.type' => 0))
                ->where(array('p.is_del'=>0))
                ->group('p.rid')
                ->order('m.room_name asc')
                ->select();
        }else{
            $lowPointList = M('house_village_point')
                ->alias('p')
                ->field($field_low)
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
                ->where(array('p.type' => 0))
                ->where(array('p.is_del'=>0,'p.id'=>array('not in',$noInArray)))
                ->order('m.room_name asc')
                ->group('p.rid')
                ->select();
        }

        //TODO: 微信JSSDK配置

        $share_arr=array(	//微信分享开始
            'title'=>'汇得行智慧助手',
            'desc'=>'打造真正的智慧物业服务平台',
            'imgUrl'=>C('config.site_url').'/tpl/Wap/default/static/images/house.jpg',
            'link'=>C('config.site_url').'/wap.php?g=Wap&c=Home&a=index'
        );
        $share = new WechatShare($this->config, $_SESSION['openid'],$share_arr);
        $this->shareScript = $share->getSgin();
        $this->assign('shareScript', $this->shareScript);//微信分享结束

        //vd($lowPointList);exit;
        $this->assign('nowPointCount',$nowPointCount);
        $this->assign('lowPoint',$lowPoint);
        $this->assign('nowPointList',$nowPointList);
        $this->assign('lowPointList',$lowPointList);
        $this->display();
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


    /**
     * 前一天巡更列表，已巡更和未巡更(图表页)
     */
    public function check_record_chart(){
        $openid = session('user.openid');
        $village_id = D('admin')->where(array('openid'=>$openid))->getField('village_id');

        //查看班次时间
        $is_set = $this->get_shift_time($village_id);
        // var_dump($is_set);exit();

        $village_name = D('house_village')->where(array('village_id'=>$village_id))->getField('village_name');
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

        //一天的巡更时间段
        $nowDays = strtotime('-1 day',strtotime(date('Y-m-d').$is_set[2]));
        $nowDaye = strtotime(date('Y-m-d').$is_set[2]);
        // var_dump($nowDaye);exit();
        // 
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
        // dump(M()->_sql());
        // var_dump($pointCount);exit();

        //还剩多少点位未巡检
        $lowPoint = $pointCount-$nowPointCount;
        if($lowPoint<=0)$lowPoint=0;

        //前一天已经巡检的点位数据
        //字段
        $field_now =array(
            'r.*',
            'p.orientation',
            'm.room_name',
            'v.village_name',
            'b.name',
            'u.truename'
        );
        //构建子查询
        $chlidSql = M('house_village_user_bind')->field(array('uid','`name`','MAX(pigcms_id)'))->group('uid')->buildSql();
        //主查询
        $where=array('r.check_time'=>array('between',array($nowDays,$nowDaye)),'r.is_check'=>1);
        if(!empty($village_id))$where['m.village_id']=$village_id;
        // if(!empty($project_id))$where['m.project_id']=$project_id;
        $nowPointList = M('village_point_record')
            ->alias('r')
            ->field($field_now)
            ->join('LEFT JOIN '.$chlidSql.' b on b.uid=r.uid')
            ->join('LEFT JOIN __USER__ u on r.uid=u.uid')
            ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
            ->join('LEFT JOIN __HOUSE_VILLAGE__ v on v.village_id=m.village_id')
            ->where($where)
            ->order('r.point_status desc,r.check_time desc')
            ->select();

        //正常的巡更点数
        // $where=array('r.check_time'=>array('between',array($nowDays,$nowDaye)),'r.point_status'=>0);
        // if(!empty($village_id))$where['m.village_id']=$village_id;
        // // if(!empty($project_id))$where['m.project_id']=$project_id;
        // $safetyPoint = M('village_point_record')
        //     ->alias('r')
        //     ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
        //     ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid ')
        //     ->where(array('p.type' => 0))
        //     ->where($where)
        //     ->count();
        // //不正常的点
        // $where['r.point_status']=1;
        // $warningPoint = M('village_point_record')
        //     ->alias('r')
        //     ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
        //     ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid ')
        //     ->where(array('p.type' => 0))
        //     ->where($where)
        //     ->count();
        // dump(M()->_sql());
        // var_dump($safetyPoint);exit();
        // 
        
        //不正常的巡更点数
        $where=array('r.check_time'=>array('between',array($nowDays,$nowDaye)),'r.point_status'=>1,'p.is_del'=>0);
        if(!empty($village_id))$where['m.village_id']=$village_id;
        $warningPoint = M('village_point_record')
            ->alias('r')
            ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid ')
            ->where($where)
            ->count();
            // dump(M()->_sql());
        //正常巡更点数量
        $safetyPoint = $nowPointCount - $warningPoint;

        $this->assign('nowPointCount',$nowPointCount);
        $this->assign('lowPoint',$lowPoint);
        $this->assign('safetyPoint',$safetyPoint);
        $this->assign('warningPoint',$warningPoint);
        $this->assign('nowPointList',$nowPointList);
        $this->assign('village_name',$village_name);
        $this->assign('village_id',$village_id);
        //本月没有巡检的点
        $noInArray = array();
        foreach ($nowPointList as $key=>$value){
            $noInArray[] = $value['pid'];
        }
        // var_dump($noInArray); exit();
        //未检字段
        $field_low = array(
            'GROUP_CONCAT(p.orientation) AS oname',
            'm.room_name',
        );
        if(empty($noInArray)){
            $where=array('p.is_del'=>0);
            if(!empty($village_id))$where['m.village_id']=$village_id;
            if(!empty($project_id))$where['m.project_id']=$project_id;
            $lowPointList = M('house_village_point')
                ->alias('p')
                ->field($field_low)
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
                ->where(array('p.type' => 1))
                ->where($where)
                ->group('p.rid')
                ->order('m.room_name asc')
                ->select();
        }else{
            $where=array('p.is_del'=>0,'p.id'=>array('not in',$noInArray));
            if(!empty($village_id))$where['m.village_id']=$village_id;
            if(!empty($project_id))$where['m.project_id']=$project_id;
            $lowPointList = M('house_village_point')
                ->alias('p')
                ->field($field_low)
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
                ->where(array('p.type' => 1))
                ->where($where)
                ->order('m.room_name asc')
                ->group('p.rid')
                ->select();
        }

        $this->assign('lowPointList',$lowPointList);

        //查询近7天的巡更记录
        $week = 1;
        $week_pointRecord = $this->get_week_point_record($week);
        unset($week_pointRecord['nowPointCount']);
        $this->assign('week_pointRecord',$week_pointRecord);

        //时间
        $date = array(
            'year'=>date('Y'),
            'month'=>date('m'),
            'day'=>date("Y-m-d",strtotime("-1 day")),
        );
        $this->assign('date',$date);

        $this->display();    
    }


    /**
     * 过去一周的巡更记录
     */
    public function get_week_point_record($week) {
        $type = $week;
        if ($type == 1) {
            $start_time = strtotime(date('Y-m-d'));  //获取当天时间戳
        } else {
           $start_time = strtotime(date('Y-m-d', (time() - ((date('w') == 0 ? 7 : date('w')) - 1) * 24 * 3600)));  //获取当天时间戳 
        }
        
        $array = array();
        for($i=1;$i<=7;$i++){
            $array[] = date('Y-m-d',$start_time-$i*86400); //每隔一天赋值给数组
        }

        $openid = session('user.openid');
        $village_id = D('admin')->where(array('openid'=>$openid))->getField('village_id');
        // var_dump($village_id);exit();
        //总巡更点
        $pointNum = M('house_village_point')->alias('p')
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ r ON p.rid=r.id')
            ->where(array('p.type'=>0))
            ->where(array('r.village_id'=>$village_id))
            ->where(array('p.status'=>array('eq',0),'p.is_del'=>array('eq',0)))
            ->count()?:0;

        //查询是否设置班次
        $is_set = $this->get_shift_time($village_id);

        $newArr = array();
        $nowPointCount = 0;
        foreach ($array as $k => $v) {
            $time = strtotime($v);
            $Start_Time = $time+$is_set[0]*3600;
            $End_Time = $time+$is_set[1]*3600;
            
            //巡更人
            $uidArr = M('village_point_record')->alias('r')
                ->field(array('r.pigcms_id','r.uid'))
                ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
                ->where(array('r.check_time'=>array('between',array($Start_Time,$End_Time))))
                ->where(array('m.village_id'=>$village_id,'p.is_del'=>0))
                ->order('r.pigcms_id desc')
                ->select();
            //获取数组中每个uid数量得数组
            $uids = array_column($uidArr, 'uid');
            $count = array_count_values($uids);
            $uid_max = max($count);  //取数组中的最大值
            $uid = array_search($uid_max,$count);  //取最大值的键值
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
            // dump(M()->_sql());
            // var_dump($name);exit();
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
            
            $no_Count = intval($pointNum-$yes_Count)?:0;
            $rate = round(($yes_Count / $pointNum)*100, 0).'%';
            $newArr[$k]['date'] = $v;
            $newArr[$k]['pointNum'] = $pointNum;
            $newArr[$k]['yes_Count'] = $yes_Count;
            $newArr[$k]['no_Count'] = $no_Count;
            $newArr[$k]['rate'] = $rate;
            $newArr[$k]['name'] = $name;

            $newArr['nowPointCount'] += $yes_Count;
        }
        return $newArr;
    }


    /**
     * 前一天巡更列表，已巡更和未巡更(图表页)
     */
    public function check_record_chart_week(){
        $openid = session('user.openid');
        $village_id = D('admin')->where(array('openid'=>$openid))->getField('village_id');
        $village_name = D('house_village')->where(array('village_id'=>$village_id))->getField('village_name');
        // $project_id = $_GET['project_id'];
        $where=array('p.is_del'=>0);
        if(!empty($village_id))$where['m.village_id']=$village_id;
        // if(!empty($project_id))$where['m.project_id']=$project_id;
        //一共多少巡更点
        $pointCount = M('house_village_point')
                ->alias('p')
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
                ->where(array('p.type' => 0))
                ->where($where)
                ->count();

        //查询是否设置班次
        $is_set = $this->get_shift_time($village_id);

        //一个星期的巡更时间段
        // $nowDays = strtotime('-7 day',strtotime(date("Y-m-d",strtotime("last Monday")).$is_set[2]));
        $nowDays = strtotime(date('Y-m-d', (time() - ((date('w') == 0 ? 7 : date('w')) - 1) * 24 * 3600)));
        $nowDaye = strtotime('-7 day',strtotime(date('Y-m-d', (time() - ((date('w') == 0 ? 7 : date('w')) - 1) * 24 * 3600))));
        // var_dump($nowDaye);exit();
        // 
        //前一个星期已经巡检了多少点位
        $where=array('r.check_time'=>array('between',array($nowDays,$nowDaye)));
        if(!empty($village_id))$where['m.village_id']=$village_id;
 
        //查询最近一个周的巡更记录
        $week = 2;
        $week_pointRecord = $this->get_week_point_record($week);
        
        //已巡更点数量
        $nowPointCount = $week_pointRecord['nowPointCount'];
        unset($week_pointRecord['nowPointCount']);
        //还剩多少点位未巡检
        $lowPointCount = $pointCount*7-$nowPointCount;
        if($lowPointCount<=0)$lowPointCount=0;

        $this->assign('week_pointRecord',$week_pointRecord);

        //巡更率
        $rate = round($nowPointCount / ($pointCount*7)*100, 0).'%';

        //前一个星期已经巡检的点位数据
        //字段
        $field_now =array(
            'r.*',
            'p.orientation',
            'm.room_name',
            'v.village_name',
            'b.name',
            'u.truename'
        );
        //构建子查询
        $chlidSql = M('house_village_user_bind')->field(array('uid','`name`','MAX(pigcms_id)'))->group('uid')->buildSql();
        //主查询
        $where=array('r.check_time'=>array('between',array($nowDays,$nowDaye)),'r.is_check'=>1);
        if(!empty($village_id))$where['m.village_id']=$village_id;
        // if(!empty($project_id))$where['m.project_id']=$project_id;
        $nowPointList = M('village_point_record')
            ->alias('r')
            ->field($field_now)
            ->join('LEFT JOIN '.$chlidSql.' b on b.uid=r.uid')
            ->join('LEFT JOIN __USER__ u on r.uid=u.uid')
            ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
            ->join('LEFT JOIN __HOUSE_VILLAGE__ v on v.village_id=m.village_id')
            ->where($where)
            ->order('r.point_status desc,r.check_time desc')
            ->select();
       // var_dump($nowPointList);exit(); 
        
        //不正常的巡更点数
        $where=array('r.check_time'=>array('between',array($nowDays,$nowDaye)),'r.point_status'=>1);
        if(!empty($village_id))$where['m.village_id']=$village_id;
        $warningPoint = M('village_point_record')
            ->alias('r')
            ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid ')
            ->where($where)
            ->count();
            // dump(M()->_sql());
        //正常巡更点数量
        $safetyPoint = $nowPointCount - $warningPoint;

        $this->assign('nowPointCount',$nowPointCount);
        $this->assign('lowPointCount',$lowPointCount);
        $this->assign('rate',$rate);
        $this->assign('safetyPoint',$safetyPoint);
        $this->assign('warningPoint',$warningPoint);
        $this->assign('nowPointList',$nowPointList);
        $this->assign('village_name',$village_name);
        $this->assign('village_id',$village_id);
        //本月没有巡检的点
        $noInArray = array();
        foreach ($nowPointList as $key=>$value){
            $noInArray[] = $value['pid'];
        }

        //时间
        $date = array(
            'year' => date('Y'),
            'month' => date('m'),
            'day' => date("Y-m-d",strtotime("-1 day")),
        );
        $this->assign('date',$date);

        $this->display();    
    }


    /**
     * 前一天巡更列表，已巡更和未巡更(图表页)
     */
    public function check_record_chart_month() {
        // $updateArray = array(
        //     'direction' => 2
        // );
        // $where=array('id'=>array('between',array(4118,24117)),'type'=>2);
        // $res = M('off_products_ercode')->where($where)->data($updateArray)->save();
        // die;

        $openid = session('user.openid');
        $village_id = D('admin')->where(array('openid'=>$openid))->getField('village_id');
        $village_name = D('house_village')->where(array('village_id'=>$village_id))->getField('village_name');
        $start_time = strtotime(date('Y-m-01'));  //获取本月第一天的时间戳
        $nowDays = strtotime('-1 month',strtotime(date('Y-m-01').$is_set[2]));
        $nowDaye = strtotime(date('Y-m-01').$is_set[2]);
        //查询月报表是否存在数据，不存在则添加
        $is_set = D('village_point_record_month')->where(array('village_name'=>$village_name,'createtime'=>$start_time))->select();
        // var_dump($is_set);exit();
        //查询是否设置班次
        $is_set2 = $this->get_shift_time($village_id);
        if ($is_set) {
            //社区名称
            $village_name = $is_set[0]['village_name'];
            //一共多少巡更点
            $pointCount = $is_set[0]['pointCount'];       
            //前一个月已经巡检了多少点位
            $nowPointCount = $is_set[0]['nowPointCount'];
            //前一个月还剩多少点位未巡检
            $lowPointCount = $is_set[0]['lowPointCount'];
            //巡更率
            $rate = $is_set[0]['rate'];

            $month_pointRecord = D('village_point_record_month')->where(array('createtime'=>$start_time))->select();
        } else {    
            $where=array('p.is_del'=>0);
            if(!empty($village_id))$where['m.village_id']=$village_id;
            // if(!empty($project_id))$where['m.project_id']=$project_id;
            
            $month_pointRecord = $this->get_month_point_record();      

            //社区名称
            $village_name = $month_pointRecord[$village_id]['village_name'];
            //一共多少巡更点
            $pointCount = $month_pointRecord[$village_id]['pointCount'];       
            //前一个月已经巡检了多少点位
            $nowPointCount = $month_pointRecord[$village_id]['nowPointCount'];
            //前一个月还剩多少点位未巡检
            $lowPointCount = $month_pointRecord[$village_id]['lowPointCount'];
            //巡更率
            $rate = $month_pointRecord[$village_id]['rate'];
        }
               
        //对数组按照巡更率的降序进行排序 
         $sort = array(
            'direction' => 'SORT_DESC', //排序顺序标志 SORT_DESC 降序；SORT_ASC 升序
            'field'     => 'rate',       //排序字段
         );
         $arrSort = array();
         foreach($month_pointRecord AS $uniqid => $row){
             foreach($row AS $key=>$value){
                 $arrSort[$key][$uniqid] = $value;
             }
         }
         if($sort['direction']){
             array_multisort($arrSort[$sort['field']], constant($sort['direction']), $month_pointRecord);
         }
         // var_dump($month_pointRecord);exit();
        $this->assign('month_pointRecord',$month_pointRecord);
        
       //  //不正常的巡更点数
        $where=array('r.check_time'=>array('between',array($nowDays,$nowDaye)),'r.point_status'=>1);
        if(!empty($village_id))$where['m.village_id']=$village_id;
        $warningPoint = M('village_point_record')
            ->alias('r')
            ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid ')
            ->where($where)
            ->count();
            // dump(M()->_sql());
        //正常巡更点数量
        $safetyPoint = $nowPointCount - $warningPoint;

        $this->assign('nowPointCount',$nowPointCount);
        $this->assign('lowPointCount',$lowPointCount);
        $this->assign('rate',$rate);
        $this->assign('safetyPoint',$safetyPoint);
        $this->assign('warningPoint',$warningPoint);
        $this->assign('nowPointList',$nowPointList);
        $this->assign('village_name',$village_name);
        $this->assign('village_id',$village_id);
        $this->assign('time',$nowDaye);

        $this->display();    
    }


    /**
     * 过去一个月的巡更记录
     */
    public function get_month_point_record() {
        $start_time = strtotime(date('Y-m-01'));  //获取本月第一天的时间戳
        $daysCount = date("t", strtotime('-1 month'));  //上个月一共多少天
        
        $array = array();
        for($i=1;$i<=$daysCount;$i++){
            $array[] = date('Y-m-d',$start_time-$i*86400); //每隔一天将时间戳赋值给数组
        }
        //所有的社区
        $newArr = array();
        // $nowPointCount = 0;
        // $lowPointCount = 0;
        $villageArray = M('house_village')->field(array('village_id','village_name'))->where(array('status'=>1))->select();

        foreach ($villageArray as $kk => $vv) {
            $village_id = $vv['village_id'];  //社区id            
            $village_name = $vv['village_name'];  //社区名称

            //查询月报表是否存在数据，不存在则添加
            $is_set = D('village_point_record_month')->where(array('village_name'=>$village_name,'createtime'=>$start_time))->select();
            if (!$is_set) {
                //总巡更点
                $pointNum = M('house_village_point')->alias('p')
                    ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ r ON p.rid=r.id')
                    ->where(array('p.type'=>0))
                    ->where(array('r.village_id'=>$village_id))
                    ->where(array('p.status'=>0,'p.is_del'=>0))
                    ->count()?:0;

                //去掉巡更点为0的village_id数据
                if ($pointNum == 0) {
                    continue;
                }

                //查询是否设置班次
                $is_set = $this->get_shift_time($village_id);

                //循环时间戳数组
                foreach ($array as $k => $v) {
                    $time = strtotime($v);
                    $Start_Time = $time+$is_set[0]*3600;
                    $End_Time = $time+$is_set[1]*3600;
                    //已经巡检的巡更点
                    /*$point_list=M('house_village_point')->alias('p')
                        ->field(array('p.id'))
                        ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
                        ->where(array('m.village_id'=>$village_id))
                        ->select();*/
                    /*$point_get=array_column($point_list,'id');
                    $yes_Count=M('village_point_record')->field(array("count(DISTINCT pid)"=>'num'))
                        ->where(array('check_time'=>array('between',array($Start_Time,$End_Time)),'pid'=>array('IN',$point_get)))
                        ->find()['num'];*/
                        /*if($village_id==4){
                            dump(M()->_sql());
                        die;
                        }*/
                    $yes_Count = M('village_point_record')
                    // M('month_view'.'_'.$village_id)
                        ->alias('r')
                        ->field(array("count(DISTINCT r.pid)"=>'num'))  //distinct 可以去掉晚上不用巡更的点位
                        ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
                        ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
                        ->where(array('check_time'=>array('between',array($Start_Time,$End_Time))))
                        ->where(array('m.village_id'=>$village_id,'p.is_del'=>0))
                        ->find()['num'];
                        // var_dump(M()->_sql());
                        // var_dump($yes_Count);exit();
                    $no_Count = intval($pointNum-$yes_Count)?:0;
                    $rate = round(($yes_Count / $pointNum), 3);

                    $newArr[$village_id]['village_name'] = $village_name;
                    $newArr[$village_id]['pointCount'] = $pointNum*$daysCount;
                    $newArr[$village_id]['nowPointCount'] += $yes_Count;
                    $newArr[$village_id]['lowPointCount'] += $no_Count;
                    $newArr[$village_id]['rate'] += $rate;                
                }
                $newArr[$village_id]['rate'] = round(($newArr[$village_id]['rate']/$daysCount)*100,0);

                //添加月报表数据
                $addArray = array(
                    'village_name' => $newArr[$village_id]['village_name'],
                    'pointCount' => $newArr[$village_id]['pointCount'],
                    'nowPointCount' => $newArr[$village_id]['nowPointCount'],
                    'lowPointCount' => $newArr[$village_id]['lowPointCount'],
                    // 'warningPoint' => $newArr['warningPoint'],
                    'rate' => $newArr[$village_id]['rate'],
                    // 'name' => $name,
                    'createdate' => $start_time
                    );
                $res = M('village_point_record_month')->data($addArray)->add();                                  
            }
        } 
        return $newArr;
    }

    /**
     * 记录详细
     */
    public function record_detail(){
        $id = I('get.id');
        //条件
        $_map =array('p.is_del'=>0,'r.pigcms_id'=>array('eq',$id));
        //字段
        $field_now =array(
            'r.*',
            'p.orientation',
            'm.room_name',
            'v.village_name',
            'b.name',
            'u.truename'
        );
        //构建子查询
        $chlidSql = M('house_village_user_bind')->field(array('uid','`name`','MAX(pigcms_id)'))->group('uid')->buildSql();
        //主查询
        $pointRecord = M('village_point_record')
            ->alias('r')
            ->field($field_now)
            ->join('LEFT JOIN '.$chlidSql.' b on b.uid=r.uid')
            ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
            ->join('LEFT JOIN __HOUSE_VILLAGE__ v on v.village_id=m.village_id')
            ->join('LEFT JOIN __USER__ u on u.uid=r.uid')
            ->where($_map)
            ->find();
        if (empty($pointRecord['name'])) $pointRecord['name'] = D('user')->where(array('uid'=>$pointRecord['uid']))->getField('truename');

        //vd(M()->_sql());
        $this->assign('pointRecord',$pointRecord);
        $this->display();
    }

    /**
     * 账单预览
     * @param $id
     */
    public function payListInfo($id){
        $payList = M('house_village_user_paylist')->find($id);
        $nowList = date('Y-m');
        $userInfo = M('house_village_user_bind')->getByUsernum($payList['usernum']);
        //$userInfo = M('house_village_user_paylist')->where(array('usernum'=>$usernum,'create_date'=>$nowList))->find();
        $totalPrice = $payList['water_price']+$payList['electric_price']+$payList['property_price']+$payList['other_price'];
        $payList['total_price'] = $totalPrice;
        //vd($payList);exit;
        $this->assign('payList',$payList);
        $this->assign('userInfo',$userInfo);
        $this->display();
    }

    /**
     * 返回json数据
     */
    protected function suc($message='',$data=null)
    {
        echo json_encode(
            array(
                'err' => 0,
                'msg' => $message,
                'data' => $data
            ),
            $json_option=JSON_UNESCAPED_UNICODE //不转义中文
        );
        exit();
    }

    public function err($message='',$data=null,$errno=999){

        echo json_encode(
            array(
                'err'=> $errno,
                'msg'=> $message,
                'data'=>$data
            ),
            $json_option=JSON_UNESCAPED_UNICODE //不转义中文
        );
        exit();

    }

    public function testjump(){
        $this->success("成功");
    }

    /**
     * 特殊toggle页 success
     * @param string $message 显示提示信息
     *
     */
    public function p_suc($message='',$point_id=''){
        //将所传递的值转入模板中
        //TODO: 微信JSSDK配置

        $share_arr=array(	//微信分享开始
            'title'=>'汇得行智慧助手',
            'desc'=>'打造真正的智慧物业服务平台',
            'imgUrl'=>C('config.site_url').'/tpl/Wap/default/static/images/house.jpg',
            'link'=>C('config.site_url').'/wap.php?g=Wap&c=Home&a=index'
        );
        $share = new WechatShare($this->config, $_SESSION['openid'],$share_arr);
        $this->shareScript = $share->getSgin();
        $room_info=M('house_village_room')->where(array('id'=>$point_id))->find();
        //设置跳转详细列表
        if(!empty($room_info['village_id']))$this->assign('village_id',$room_info['village_id']);
        if(!empty($room_info['project_id']))$this->assign('project_id',$room_info['project_id']);
        $this->assign('shareScript', $this->shareScript);//微信分享结束
        $this->assign('message',$message);
        $this->display('success');
    }


    /**
     * 特殊toggle页 success   巡检提交成功跳转
     * @param string $message 显示提示信息
     *
     */
    public function p_suc_safety($message='',$point_id=''){
        //将所传递的值转入模板中
        //TODO: 微信JSSDK配置

        $share_arr=array(   //微信分享开始
            'title'=>'汇得行智慧助手',
            'desc'=>'打造真正的智慧物业服务平台',
            'imgUrl'=>C('config.site_url').'/tpl/Wap/default/static/images/house.jpg',
            'link'=>C('config.site_url').'/wap.php?g=Wap&c=Home&a=index'
        );
        $share = new WechatShare($this->config, $_SESSION['openid'],$share_arr);
        $this->shareScript = $share->getSgin();
        $room_info=M('house_village_room')->where(array('id'=>$point_id))->find();
        //设置跳转详细列表
        if(!empty($room_info['village_id']))$this->assign('village_id',$room_info['village_id']);
        if(!empty($room_info['project_id']))$this->assign('project_id',$room_info['project_id']);
        $this->assign('shareScript', $this->shareScript);//微信分享结束
        $this->assign('message',$message);
        $this->display('success_safety');
    }


    /**
     * 特殊toggle页 error
     * @param string $message 显示提示信息
     */
    public function p_err($message='',$point_id=''){
        //将所传递的值转入模板中
        //TODO: 微信JSSDK配置

        $share_arr=array(	//微信分享开始
            'title'=>'汇得行智慧助手',
            'desc'=>'打造真正的智慧物业服务平台',
            'imgUrl'=>C('config.site_url').'/tpl/Wap/default/static/images/house.jpg',
            'link'=>C('config.site_url').'/wap.php?g=Wap&c=Home&a=index'
        );
        $share = new WechatShare($this->config, $_SESSION['openid'],$share_arr);
        $this->shareScript = $share->getSgin();
        $room_info=M('house_village_room')->where(array('id'=>$point_id))->find();
        //设置跳转详细列表
        if(!empty($room_info['village_id']))$this->assign('village_id',$room_info['village_id']);
        if(!empty($room_info['project_id']))$this->assign('project_id',$room_info['project_id']);
        $this->assign('shareScript', $this->shareScript);//微信分享结束
        $this->assign('message',$message);
        $this->display('error');
    }


    /**
     * 预览发送模板
     * @param  $meter_type string  1 水费  5 电费
     * @param  $type  查看的物业费还是水电
     */
    public function show_this_template(){

        $type = I('get.type');


        $ym = empty(I('get.ym'))?date('Y-m'):I('get.ym');


        $endYear = date('Y',strtotime('+1 month',strtotime($ym)));

        $endMonth = date('m',strtotime('+1 month',strtotime($ym)));

        $usernum = I('get.usernum');

        $userInfo = M('house_village_user_bind')->getByUsernum($usernum);

        //其他费用

        $other_array = M('house_village_user_paylist')->where(array('usernum'=>$usernum,'create_date'=>$ym))->find()['use_other'];

        if($other_array!=''){
            $other_array = unserialize($other_array);

            $this->assign('other_array',$other_array);
        }

        $room_model = new RoomModel();

        $presonInfo = $room_model->preview_list($userInfo['pigcms_id'],0,$ym);


        //处理数据
        foreach($presonInfo as &$row){
            $row['room_names'] = [];
            $row['roomsizes'] = 0;//物业总面积
            $row['property_price'] = 0; //物业费总合
            foreach($row['property_data'] as $p){
                $row['room_names'][] = $p['room_name'];
                $row['roomsizes'] += $p['roomsize'];
                $row['property_price'] += $p['property_unit'] * $p['roomsize'];
                $row['true_property_unit'] = $p['property_unit'];
            }
            $row['room_names'] = $room_model->format_room_str($row['room_names'],',');

            foreach ($row['room_data'] as $kk=>$vv){

                foreach ($vv as $vvv){

                    if($kk==5){

                        $meterElectricArray[] = $vvv;



                    }else{

                        $meterWaterArray[] = $vvv;

                    }

                }

            }
        }
        unset($row);
        //vd($presonInfo);exit;

        if($type == 1){

            $billTemplateArray = array(
                'ym'=>$ym,
                'company_name'=>$presonInfo[0]['tenantname'],
                'room_name'=>substr($presonInfo[0]['room_names'],0,-1)?substr($presonInfo[0]['room_names'],0,-1):'/',
                'last_month_time'=>explode(',',$presonInfo[0]['original_room_data'][0]['be_date'])[0],
                'this_month_time'=>explode(',',$presonInfo[0]['original_room_data'][0]['be_date'])[1],
                'create_time'=>date('Y-m-d',$presonInfo[0]['original_room_data'][0]['create_time']),
                'end_year'=>$endYear,
                'end_month'=>$endMonth
            );

            foreach ($meterWaterArray as $wk=>$wv){

                $meterWaterArray[$wk]['now_consume'] = $wv['total_consume']-$wv['last_total_consume'];

                $billTemplateArray['total_water'] += $wv['cost'];

            }


            foreach ($meterElectricArray as $ek=>$ev){

                $meterElectricArray[$ek]['now_consume'] = $ev['total_consume']-$ev['last_total_consume'];

                $billTemplateArray['total_electric'] += $ev['cost'];

            }

            $billTemplateArray['water']=$meterWaterArray;

            $billTemplateArray['electric']=$meterElectricArray;

            $billTemplateArray['total_money']=$billTemplateArray['total_electric']+$billTemplateArray['total_water'];


        }else{

            $thisMonth = date('m',strtotime($ym));



            switch ($thisMonth){
                case $thisMonth==1 || $thisMonth==2 || $thisMonth==3:
                    $quarterStart = date('Y年').'1月1日';
                    $quarterEnd = date('Y年').'3月31日';
                    break;

                case $thisMonth==4 || $thisMonth==5 || $thisMonth==6:
                    $quarterStart = date('Y年').'4月1日';
                    $quarterEnd = date('Y年').'6月30日';
                    break;

                case $thisMonth==7 || $thisMonth==8 || $thisMonth==9:
                    $quarterStart = date('Y年').'7月1日';
                    $quarterEnd = date('Y年').'9月31日';
                    break;

                case $thisMonth==10 || $thisMonth==11 || $thisMonth==12:
                    $quarterStart = date('Y年').'10月1日';
                    $quarterEnd = date('Y年').'12月31日';
                    break;
            }

            $billTemplateArray = array(
                'ym'=>$ym,
                'company_name'=>$presonInfo[0]['tenantname'],
                'end_year'=>$endYear,
                'end_month'=>$endMonth,
                'roomsizes'=>$presonInfo[0]['roomsizes'],
                'property_price'=>$presonInfo[0]['property_price'],
                'total_property'=>$presonInfo[0]['property_price']*3,
                'true_property_unit'=>$presonInfo[0]['true_property_unit'],
                'quarterStart'=> $quarterStart,
                'quarterEnd'=>$quarterEnd
            );

        }

        //vd($billTemplateArray);exit;

        $this->assign('billTemplateArray',$billTemplateArray);

        $this->display();

    }

    /******************************手机端物业缴费**********************************/
    /*
     * @author 曾梦飞
     * @time 2017年12月28日16:55:12
     */

    public function pay_index() {
        //查询到社区
        $v_id = $_GET['village_id'];
        $villageArr = D('house_village')->where("village_id=$v_id")->find();
        $village_name = $villageArr['village_name'];
        //查询用户信息
        $openid = $_SESSION['openid'];
        $userArr = D('user')->where(array('openid'=>$openid))->find();
        $uid = $userArr['uid'];
        $field = array(
            'u.pigcms_id',
            'u.village_id',
            'u.tenantname',
            'v.village_name',
        );
        $u_arr = D('house_village_user_bind')->alias('u')
            ->field($field)
            ->join("LEFT JOIN __HOUSE_VILLAGE__ v on u.village_id = v.village_id")
            ->where("find_in_set($uid,u.uid) and u.type = 1")
            ->select();
        $now_user['avatar'] = $_SESSION['user']['avatar'];
        $now_user['nickname'] = $_SESSION['user']['nickname'];
//        $now_user['tid'] = $u_arr['pigcms_id'];
//        $now_user['village_id'] = $u_arr['village_id'];
//        dump($_GET);exit;
        //查看老用户绑定房间号
        if ($u_arr) {
            $data = array();
            $model = new RoomModel();
            foreach ($u_arr as $v) {
                $tid = $v['pigcms_id'];
                $village_id = $v['village_id'];
                $preview_list = $model->preview_list($tid,$village_id);
                foreach ($preview_list as $sv) {
                    if ($sv['property_data']) {
                        foreach ($sv['property_data'] as $zv) {
                            $zv['pigcms_id'] = $tid;
                            $zv['village_name'] = $v['village_name'];
                            $zv['tenantname'] = $v['tenantname'];
                            $data[] = $zv;
                        }
                    }
                }
            }
        }
        //将相同的tid整合在一起
        if ($data) {
            $result = array();
            foreach ($data as $info) {
                $result[$info['tid']][] = $info;
            }
            //将所得数组再进行拆分
            $resArr = array();
            foreach ($result as $v) {
                $roomStr = '';
                foreach ($v as $sv) {
                    $resArr[$sv['tid']]['pigcms_id'] = $sv['pigcms_id'];
                    $resArr[$sv['tid']]['tid'] = $sv['tid'];
                    $resArr[$sv['tid']]['village_name'] = $sv['village_name'];
                    $resArr[$sv['tid']]['tenantname'] = $sv['tenantname'];
//                $top = substr($sv['room_name'],0,strpos($sv['room_name'],'F')+1);
//                $bottom = substr($sv['room_name'],strpos($sv['room_name'],'F')+1);
                    if ($roomStr) {
                        $roomStr .= ','.$sv['room_name'];
                    } else {
                        $roomStr .= $sv['room_name'];
                    }
                    $resArr[$sv['tid']]['room_name'] = $roomStr;
                }
            }

            //获得最终的数组
            $arr_zongji = array();
            foreach ($resArr as $v) {
                $arr_zongji[] = array_slice($v,-5,5);
            }
            //继续重组
            $model = new RoomModel();
            foreach ($arr_zongji as &$v) {
                $v['room_name'] = $model->format_room_str($v['room_name']);
            }
            unset($v);
            $this->assign('arr_zongji',$arr_zongji);
        }
        $this->assign('uid',$uid);
        $this->assign('village_id',$v_id);
        $this->assign('village_name',$village_name);
        $this->assign('now_user',$now_user);
        $this->display();
    }

    /**
     * 绑定公司
     * @param $name
     * @param array $val
     */

    public function pay_add_tenant() {
        $village_id = I('get.village_id');
        $uid = $_GET['uid'];
        if (!$uid) $this->error('未登录',U('pay_index',array('village_id'=>$village_id)));
        //判断社区是否为商业楼 0为商业楼 1为居民楼
        $vArr = D('house_village')->where("village_id=$village_id")->find();
        $village_type = $vArr['village_type'];
        $field = array(
            'u.pigcms_id',
            'u.village_id',
            'u.tenantname',
            'u.uid',
            'v.village_name',
        );
        $map['u.type'] = array("eq","1");
        if ($_GET['search']) $map['u.tenantname'] = array("like","%{$_GET['search']}%");
        $u_arr = D('house_village_user_bind')->alias('u')
            ->field($field)
            ->join("LEFT JOIN __HOUSE_VILLAGE__ v on u.village_id = v.village_id")
            ->where($map)
            ->where("v.village_id=$village_id")
            ->select();
//        dump($u_arr);exit;
        $data = array();
        foreach ($u_arr as &$v) {
            $uidArr = explode(',',$v['uid']);
            $re = in_array($uid,$uidArr);
            $bid = $v['pigcms_id'];
            $list_arr = D('house_village_repair_list')->where(array('bind_id'=>$bid,'uid'=>$uid,'type'=>5))->find();
            $is_read = $list_arr['is_read'];
            if ($re) {
                $v['status'] = 1;
            } elseif(!$re && $list_arr) {
                if ($is_read == 0) {
                    $v['status'] = 2;
                }
            } else {
                $v['status'] = 0;
            }
            $data[] = $v;
        }
        unset($v);

        if ($_GET['search']) $this->assign('searchV',$_GET['search']);
        $this->assign('uid',$uid);
        $this->assign('village_id',$village_id);
        $this->assign('village_type',$village_type);
        $this->assign('data',$data);
        $this->display();
    }

    /**
     * 添加审核
     */
    public function pay_add_tenant_auditing() {
        $uid = I('post.uid');
        //查询
        $pigcms_id = I('post.pigcms_id');
        $village_id = I('post.village_id');
        $data['village_id'] = $village_id;
        $data['uid'] = $uid;
        $data['bind_id'] = $pigcms_id;
        $data['content'] = '绑定审核';
        $data['type'] = 5;
        $data['time'] = time();
        $list_arr = D('house_village_repair_list')->where(array('bind_id'=>$pigcms_id,'uid'=>$uid,'type'=>5))->find();
//        dump(M()->_sql());exit;
        if ($list_arr) {
            echo '不可重复提交审核';
        } else {
            $re =  D('house_village_repair_list')->add($data);
            if ($re) {
                $result = $this->send_message($re);
                if (!$result) {
                    echo 1;
                } else {
                    echo '审核失败，请稍后重试';
                }
            } else {
                echo '审核失败';
            }
        }
    }

    /*
     * 审核消息发送给客服
     */
    public function send_message($id) {
        $wechat = new WechatModel();
        $openid = 'ohgcf0uwR88TdPtMs7UMD2qYiOHQ';
        $nickname = $_SESSION['user']['nickname'];
        $openids[] = $openid;
        $tpl_id = $wechat::TPLID_LCSPTX;
        $now_time = date('Y-m-d H:i:s',time());
        $url = C('WEB_DOMAIN') . '/wap.php?g=Wap&c=PropertyService&a=send_content&id=' . $id .'&nickname='.$nickname.'&now_time='.$now_time;
        $data = array(
            'first'=>array(
                'value'=>"绑定租户审核提醒",
                'color'=>"#029700",
            ),
            'keyword1'=>array(
                'value'=>"审核提醒",
                'color'=>"#000000",
            ),
            'keyword2'=>array(
                'value'=>$nickname,
                'color'=>"#000000",
            ),
            'keyword3'=>array(
                'value'=>'绑定租户审核',
                'color'=>"#000000",
            ),
            'keyword4'=>array(
                'value'=>$now_time,
                'color'=>"#000000",
            ),
        );
        $re = $wechat->send_tpl_messages($openids,$tpl_id,$url,$data);
        return $re;
    }

    //客服审核消息内容
    public function send_content() {
        $id = I('get.id');
        $nickname = I('get.nickname');
        $now_time = I('get.now_time');
        $this->assign('id',$id);
        $this->assign('nickname',$nickname);
        $this->assign('now_time',$now_time);
        $this->display();
    }

    //通过审核，ajax操作方法
    public function send_content_adopt() {
        $id = I('get.id');
        $list_re = D('house_village_repair_list')->where(array('pigcms_id'=>$id))->find();
        if ($list_re) {
            $uid = $list_re['uid'];
            $pigcms_id = $list_re['bind_id'];
            $re = $this->pay_add_tenant_bind_adopt($uid,$pigcms_id);
            if ($re == 1) {
                D('house_village_repair_list')->where(array('pigcms_id'=>$id))->save(array('is_read'=>1));
                echo 1;
            } else {
                echo 2;
            }
        } else {
            echo 2;
        }
    }

    //供通过审核调用
    public function pay_add_tenant_bind_adopt($uid='',$pigcms_id='') {
        $uid = isset($uid)?$uid:'';
        $pigcms_id = isset($pigcms_id)?$pigcms_id:'';
        if (!$uid || !$pigcms_id) $this->error('请登录');
        $field = array(
            'u.pigcms_id',
            'u.village_id',
            'u.tenantname',
            'u.uid',
            'v.village_name',
        );
        $u_arr = D('house_village_user_bind')->alias('u')
            ->field($field)
            ->join("LEFT JOIN __HOUSE_VILLAGE__ v on u.village_id = v.village_id")
            ->where("pigcms_id = $pigcms_id")
            ->find();
        //判断公司是否还绑定了其他用户
        if ($u_arr['uid']) {
            $uidArr = explode(',',$u_arr['uid']);
            $uidArr[] = $uid;
            $uidStr = implode(',',$uidArr);
            $re = D('house_village_user_bind')
                ->where("pigcms_id = $pigcms_id")
                ->save(array('uid'=>$uidStr));
            if ($re) {
                return 1;
            } else {
                return 2;
            }
        } else {
            $re = D('house_village_user_bind')
                ->where("pigcms_id = $pigcms_id")
                ->save(array('uid'=>$uid));
            if ($re) {
                return 1;
            } else {
                return 2;
            }
        }
    }

    public function pay_add_tenant_bind() {
        $uid = I('post.uid');
        $pigcms_id = I('post.pigcms_id');
        if (!$uid || !$pigcms_id) $this->error('请登录');
        $field = array(
            'u.pigcms_id',
            'u.village_id',
            'u.tenantname',
            'u.uid',
            'v.village_name',
        );
        $u_arr = D('house_village_user_bind')->alias('u')
            ->field($field)
            ->join("LEFT JOIN __HOUSE_VILLAGE__ v on u.village_id = v.village_id")
            ->where("pigcms_id = $pigcms_id")
            ->find();
        //判断公司是否还绑定了其他用户
        if ($u_arr['uid']) {
            $uidArr = explode(',',$u_arr['uid']);
            $uidArr[] = $uid;
            $uidStr = implode(',',$uidArr);
            $re = D('house_village_user_bind')
                ->where("pigcms_id = $pigcms_id")
                ->save(array('uid'=>$uidStr));
            if ($re) {
                echo 1;
            } else {
                echo 2;
            }
        } else {
            $re = D('house_village_user_bind')
                ->where("pigcms_id = $pigcms_id")
                ->save(array('uid'=>$uid));
            if ($re) {
                echo 1;
            } else {
                echo 2;
            }
        }
    }

    public function pay_add_tenant_del() {
        $uid = I('post.uid');
        $pigcms_id = I('post.pigcms_id');
        if (!$uid || !$pigcms_id) $this->error('请登录');
        $field = array(
            'u.pigcms_id',
            'u.village_id',
            'u.tenantname',
            'u.uid',
            'v.village_name',
        );
        $u_arr = D('house_village_user_bind')->alias('u')
            ->field($field)
            ->join("LEFT JOIN __HOUSE_VILLAGE__ v on u.village_id = v.village_id")
            ->where("pigcms_id = $pigcms_id")
            ->find();
        $uidArr = explode(',',$u_arr['uid']);
        $arr = array();
        foreach ($uidArr as $v) {
            if ($v != $uid) {
                $arr[] =  $v;
            }
        }
        $arrStr = implode(',',$arr);
        $re = D('house_village_user_bind')
            ->where("pigcms_id = $pigcms_id")
            ->save(array('uid'=>$arrStr));
        if ($re) {
            echo 1;
        } else {
            echo 2;
        }
    }
    /**
     * 传递json数组到模板 通过app_json.name获取
     * @param $name
     * @param array $val
     */
//    public function assign_json($name,$val=array()){
//        static $is_init = false;
//        $name = "app_json.".$name;
//        $val = json_encode($val)?:"{}";
//        $json_str =  '<script>'.$name.' = '.$val.';</script>';
//        if(!$is_init){//第一此传入的时候需要初始化
//            $init = '<script>var app_json ={};</script>';
//            $json_str = $init . $json_str;
//            $is_init = true;
//        }
//        print_r($json_str);
//    }

//    public function pay_add_room() {
//        $data = array();
//        $v_arr = D('house_village')
//            ->field('village_id,village_name')
//            ->select();
//        foreach ($v_arr as $v) {
//            $r_arr = D('house_village_room')
//                ->where(array('village_id'=>$v['village_id'],'fid'=>0))
//                ->select();
//            $v['son'] = $r_arr;
//            foreach ($v['son'] as &$sv) {
//                $r_arr_s = D('house_village_room')
//                    ->where(array('village_id'=>$v['village_id'],'fid'=>$sv['id']))
//                    ->select();
//                $sv['g_son'] = $r_arr_s;
//            }
//            unset($sv);
//            $data[$v['village_id']] = $v;
//        }
//
////        dump($data);exit;
//        $this->assign_json('json_data',$data);
//        $this->assign('data',$data);
//        $this->display();
//
//    }


//    public function pay_add_room2() {
//        $tid = I('get.tid');
//        $model = new RoomModel();
//        $this->assign_json('room_list',$model->get_room_list());//单元列表
//        $this->assign_json('village_list',$model->get_village_list());//社区
//        $tenantinfo = $model->tenantinfo($tid);
////        dump($model->get_village_list());exit;
//        $this->assign('tid',$tid);//业主ID
//        $this->assign('modal_title',"入住单位绑定单元-" .$tenantinfo['tenantname'] . "($tid)");
//        $this->display();
//    }

    /**
     * 入住单位绑定房间执行
     * @param $room_id
     * @param $tid
     */
//    public function pay_bind_room_act($room_id,$tid){
//        $model = new RoomModel();
//        $re = $model->tenant_bind_room($room_id,$tid);
//        if($re!==false){
//            $this->success("成功","",$model->get_room_info($room_id));
//        }else{
//            $this->error(mysql_error(),"",$_GET);
//        }
//    }

    /**
     * 入住单位解绑房间执行
     * @param $room_id
     * @param $tid
     */
//    public function pay_unbind_room_act($room_id,$tid){
//        $model = new RoomModel();
//        $re = $model->tenant_unbind_room($room_id,$tid);
//        if($re!==false){
//            $this->success("成功","",$model->get_room_info($room_id));
//        }else{
//            $this->error(mysql_error(),"",$_GET);
//        }
//    }

    //月份
    public function pay_month_index() {
        $pigcms_id = I('get.pigcms_id');
        $village_id = I('get.village_id');
        if (!$pigcms_id || !$village_id) $this->error('没有登录');
        //算出各个月的时间
        $date = time();
        $date_str = array();
        $u_arr = D('house_village_user_bind')->alias('u')
            ->join("LEFT JOIN __HOUSE_VILLAGE__ v on u.village_id = v.village_id")
            ->where("u.pigcms_id = $pigcms_id")
            ->find();
        $usernum = $u_arr['usernum'];
        for ($i=0; $i<12; $i++) {
            $time = strtotime('-'.$i.' months',$date);
            $data_time = date('Y-m',$time);
            $re = D('house_village_user_paylist')->where(array('usernum'=>$usernum,'create_date'=>$data_time))->find();
            $payNum = '';
            if ($re) {
                $payNum = $re['water_price']+$re['property_price']+$re['electric_price']+$re['gas_price']+$re['park_price']+$re['other_price'];
            }
            $date_str[$data_time] = $payNum;
        }
        $this->assign('village_id',$village_id);
        $this->assign('pigcms_id',$pigcms_id);
        $this->assign('date_str',$date_str);
        $this->display();
    }

//    protected function get_user_village_info($bind_id){
//        $now_user_info = D('House_village_user_bind')->get_one_by_bindId($bind_id);
//        if(empty($now_user_info)){
//            $this->check_ajax_error_tips('您不是该小区业主');
//        }
//        //获取账单信息
//        $nowList = date('Y-m');
//        $payList = M('house_village_user_paylist')->where(array('uid'=>$now_user_info['uid'],'create_date'=>$nowList))->find();
//        $this->assign('now_user_info',$payList);
//        return $payList;
//    }
//
//    protected function check_ajax_error_tips($err_tips,$err_url='')
//    {
//        if (IS_POST) {
//            header('Content-type: application/json');
//            echo json_encode(array('err_code' => -1, 'err_msg' => $err_tips, 'err_url' => $err_url));
//            exit();
//        } else {
//            if ($err_url) {
//                $this->error_tips($err_tips, $err_url);
//            } else {
//                $this->error_tips($err_tips);
//            }
//        }
//    }
//
//    public function error_tips($msg, $url = 'javascript:history.back(-1);')
//    {
//        $this->assign('msg', $msg);
//        $this->assign('url', $url);
//        $this->display('Home/error');
//        exit();
//    }

    //定义物业缴费操作数组
    public $pay_list_type = array(
        'property'=>'物业费',
        'water'=>'水费',
        'electric'=>'电费',
        'gas'=>'燃气费',
        'park'=>'停车费',
        'custom'=>'其他缴费',
        'other'=>'其他缴费',
        'accessControl'=>'智能门禁',
        'jiaofei'=>'在线缴费',
        'repair'=>'在线报修',
        'suggest'=>'投诉建议',
        'houtai'=>'后台管理',
    );

    //物业缴费月份区分页面
    public function pay_month() {
        $village_id = I('get.village_id');
        $pigcms_id = I('get.pigcms_id');
        $date = I('get.date');
        if (!$village_id || !$pigcms_id || !$date) $this->error('没有选择社区');
        $now_village = D('House_village')->where(array('village_id'=>$village_id))->find();
//        $openid = $_SESSION['openid'];
//        $userArr = D('user')->where(array('openid'=>$openid))->find();
//        $uid = $userArr['uid'];
        $u_arr = D('house_village_user_bind')->alias('u')
            ->join("LEFT JOIN __HOUSE_VILLAGE__ v on u.village_id = v.village_id")
            ->where("u.pigcms_id = $pigcms_id")
            ->find();
        $usernum = $u_arr['usernum'];
        $now_user_info = D('house_village_user_paylist')->where(array('usernum'=>$usernum,'create_date'=>$date))->find();
//        dump($now_user_info);exit;
        $pid = $now_user_info['pigcms_id'];
        //水费已缴纳
        $total_water = M('house_village_pay_order')
            ->field(array('*','SUM(actual_payment)'=>'total'))
            ->where(array('pid'=>$pid,'order_type'=>'water','is_pay'=>1))
            ->group('pid')->select()[0]['total']?:0;
        //物业费已缴纳
        $total_property = M('house_village_pay_order')
            ->field(array('*','SUM(actual_payment)'=>'total'))
            ->where(array('pid'=>$pid,'order_type'=>'property','is_pay'=>1))
            ->group('pid')->select()[0]['total']?:0;
        //电费已缴纳
        $total_electric = M('house_village_pay_order')
            ->field(array('*','SUM(actual_payment)'=>'total'))
            ->where(array('pid'=>$pid,'order_type'=>'electric','is_pay'=>1))
            ->group('pid')->select()[0]['total']?:0;
        //燃气费已缴纳
        $total_gas = M('house_village_pay_order')
            ->field(array('*','SUM(actual_payment)'=>'total'))
            ->where(array('pid'=>$pid,'order_type'=>'gas','is_pay'=>1))
            ->group('pid')->select()[0]['total']?:0;
        //停车费已缴纳
        $total_park = M('house_village_pay_order')
            ->field(array('*','SUM(actual_payment)'=>'total'))
            ->where(array('pid'=>$pid,'order_type'=>'park','is_pay'=>1))
            ->group('pid')->select()[0]['total']?:0;
        //其他费用已缴纳
        $total_other = M('house_village_pay_order')
            ->field(array('*','SUM(actual_payment)'=>'total'))
            ->where(array('pid'=>$pid,'order_type'=>'other','is_pay'=>1))
            ->group('pid')->select()[0]['total']?:0;

        $pay_list = array();
        $now_village['property_price'] = floatval($now_village['property_price']);
        $now_village['water_price'] = floatval($now_village['water_price']);
        $now_village['electric_price'] = floatval($now_village['electric_price']);
        $now_village['gas_price'] = floatval($now_village['gas_price']);
        $now_village['park_price'] = floatval($now_village['park_price']);
//        dump($now_village);exit;
        if($now_village['property_price']){
            $pay_list[] = array(
                'type' => 'property',
                'name' => $this->pay_list_type['property'],
                'url' => U('PropertyService/village_pay',array('village_id'=>$now_village['village_id'],'type'=>'property','pid'=>$now_user_info['pigcms_id'])),
                'money'=>floatval($now_user_info['property_price']-$total_property),
            );
        }
        if($now_village['water_price']){
            $pay_list[] = array(
                'type' => 'water',
                'name' => $this->pay_list_type['water'],
                'url' =>  U('PropertyService/village_pay',array('village_id'=>$now_village['village_id'],'type'=>'water','pid'=>$now_user_info['pigcms_id'])),
                'money'=>floatval($now_user_info['water_price']-$total_water),
            );
        }
        if($now_village['electric_price']){
            $pay_list[] = array(
                'type' => 'electric',
                'name' => $this->pay_list_type['electric'],
                'url' => U('PropertyService/village_pay',array('village_id'=>$now_village['village_id'],'type'=>'electric','pid'=>$now_user_info['pigcms_id'])),
                'money'=>floatval($now_user_info['electric_price']-$total_electric),
            );
        }
        if($now_village['gas_price']){
            $pay_list[] = array(
                'type' => 'gas',
                'name' => $this->pay_list_type['gas'],
                'url' => U('PropertyService/village_pay',array('village_id'=>$now_village['village_id'],'type'=>'gas','pid'=>$now_user_info['pigcms_id'])),
                'money'=>floatval($now_user_info['gas_price']-$total_gas),
            );
        }
        if($now_village['park_price']){
            $pay_list[] = array(
                'type' => 'park',
                'name' => $this->pay_list_type['park'],
                'url' => U('PropertyService/village_pay',array('village_id'=>$now_village['village_id'],'type'=>'park','pid'=>$now_user_info['pigcms_id'])),
                'money'=>floatval($now_user_info['park_price']-$total_park),
            );
        }
        //其他费用
        $pay_list[] = array(
                'type' => 'custom',
                'name' => $this->pay_list_type['custom'],
                'url' => U('PropertyService/village_pay',array('village_id'=>$now_village['village_id'],'type'=>'other','pid'=>$now_user_info['pigcms_id'])),
                'money'=> floatval($now_user_info['other_price']),
        );
        $this->assign('pay_list',$pay_list);
        $this->assign('village_id',$village_id);
        $this->display();
    }

    //缴费页面
    public function village_pay() {
        $village_id = I('get.village_id');//所在社区
        //查询用户信息
        $openid = $_SESSION['openid'];
        $userArr = D('user')->where(array('openid'=>$openid))->find();
        $uid = $userArr['uid'];
        if (!$uid) $this->error('请登录',U('pay_index',array('village_id'=>$village_id)));
        //防止重复提交
        $re = D('house_village_pay_order')
            ->where(array('uid'=>$uid))
            ->order('order_id desc')
            ->find();
        if ($re && time()-$re['create_time']<30) $this->error('请不要重复提交',U('pay_index',array('village_id'=>$village_id)));
        $data = array();
        $pay_type = I('get.type');
        $data['order_type'] = $pay_type;
        $data['order_name'] = '缴纳'.$this->pay_list_type[$pay_type];
        $data['money'] = I('get.money');
        $data['order_no'] = time().mt_rand(100000,999999);
        $data['pid'] = I('get.pid');
        $data['uid'] = $uid;
        $data['create_time'] = time();
        //应付款
        $data['payable'] = I('get.money');
        //实付款
//        $data['actual_payment'] = I('get.actual_payment');目前未知
        //还有多少未付
//        $data['final_payment'] = I('get.money');//目前未知
        $order_id = D('house_village_pay_order')->add($data);
        $orderArr = D('house_village_pay_order')->where("order_id=$order_id")->find();
        $this->assign('orderArr',$orderArr);
        $this->assign('village_id',$village_id);
        $this->display();
    }

    //开始缴费
    public function real_payment(){
        $village_id = I('post.village_id');
        $order_id = I('post.order_id');
        $orderArr = D('house_village_pay_order')->where("order_id=$order_id")->find();
//        dump($orderArr);exit;
        if (!$orderArr) $this->error('抱歉，未找到您的订单',U(array('village_id'=>$village_id)));

        $pay_class_name = 'Weixin';
        import('@.ORG.pay.'.$pay_class_name);
        $pay_method =  (new ConfigModel())->get_pay_method(0,0,true);

        $order_info = array(
            'order_name'=>$orderArr['order_name'],
            'order_id'=>$orderArr['order_no'],//订单号
        );
        $pay_method['weixin']['config']['sub_mch_id']=1489131162;
        $pay_money = $orderArr['payable'];
//        $pay_money = 0.01;//测试
        $pay_type = 'weixin';
        $pay_class = new Weixin(
            $order_info,
            $pay_money,
            $pay_type,
            $pay_method['weixin']['config'],
            $this->user_session,
            1
        );
        $pay_param = $pay_class->pay(null,null,'/source/web_weixin_notice_wuye.php');
//        dump($pay_class);exit;
        $this->assign('pay_money',$pay_money);
        $this->assign('village_id',$village_id);
        $this->assign('weixin_param',$pay_param['weixin_param']);
        $this->display();
    }

    //缴费回调方法
    public function pay_wuye_back() {
        $pay_class_name = 'Weixin';
        import('@.ORG.pay.'.$pay_class_name);
        $pay_method = D('Config')->get_pay_method(0,0,true);
        $pay_class = new Weixin(
            $order_info=null,
            $pay_money=null,
            $pay_type='weixin',
            $pay_method['weixin']['config'],
            $this->user_session,
            1
        );
        $data = $pay_class->return_url();
        if($data['error']==0){
            $orderArr = $data['order_param'];
            $order_data = array();
            $order_no = $orderArr['order_id'];//订单号
            $arr = D('house_village_pay_order')->where("order_no=$order_no")->find();//查询未支付前的订单
            $order_data['actual_payment'] = $orderArr['pay_money'];//实际支付的钱
            $order_data['final_payment'] = $arr['payable'] - $order_data['actual_payment'];//算出还有多少未付
            $order_data['is_pay'] = 1;//改为支付状态
            $order_data['pay_time'] = time();//支付时间
            $re = D('house_village_pay_order')->where("order_no=$order_no")->save($order_data);
            exit('<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>');
        }

    }

    //管理员账号密码登录页面
    public function login() {
        $this->display();
    }

    //登录验证
    public function check() {
        $account = I('post.account');
        $password = md5(I('post.password'));
        $adminArr = D('admin')->where(array('account'=>$account, 'pwd'=>$password))->find();
        if ($adminArr == null) $this->error('登陆失败',U('PropertyService/login'));
        $tid = $adminArr['tid'];
        $bindArr = D('house_village_user_bind')->where(array('pigcms_id'=>$tid))->find();
        //查询出uid的绑定人员数组
        $uidArr = explode(',',$bindArr['uid']);
        $openid = $_SESSION['openid'];
        $nickname = $_SESSION['user']['nickname'];
        $avatar = $_SESSION['user']['avatar'];
        $userArr = D('user')->where(array('openid'=>$openid))->find();
        $uid = $userArr['uid'];
        $data = array();
        if (!in_array($uid,$uidArr)) {
            $re = $this->pay_add_tenant_bind_two($uid,$bindArr['pigcms_id']);
            if ($re == 1) {
                $data['status'] = 1;
            } else {
                $data['status'] = 0;
            }
        } else {
            $data['status'] = 1;
        }

        $data['pigcms_id'] = $bindArr['pigcms_id'];
        $data['uid'] = $uid;
        $data['avatar'] = $avatar;
        $data['tenantname'] = $bindArr['tenantname'];
        $data['nickname'] = $nickname;


        /**
         * 智能门禁的广告
         */
        $adver_info=M('Adver')->where(array('id'=>26))->find();
        $this->assign('adver_info',$adver_info);

        $this->assign('data',$data);
        $this->display();
    }

    /**
     * 修改后绑定公司操作方法
     * @param $uid
     * @param $pigcms_id
     */
    public function pay_add_tenant_bind_two($uid,$pigcms_id) {
        if (!$uid || !$pigcms_id) $this->error('抱歉，您没有绑定入住单位',U('PropertyService/login'));
        $field = array(
            'u.pigcms_id',
            'u.village_id',
            'u.tenantname',
            'u.uid',
            'v.village_name',
        );
        $u_arr = D('house_village_user_bind')->alias('u')
            ->field($field)
            ->join("LEFT JOIN __HOUSE_VILLAGE__ v on u.village_id = v.village_id")
            ->where("pigcms_id = $pigcms_id")
            ->find();
        //判断公司是否还绑定了其他用户
        if ($u_arr['uid']) {
            $uidArr = explode(',',$u_arr['uid']);
            $uidArr[] = $uid;
            $uidStr = implode(',',$uidArr);
            $re = D('house_village_user_bind')
                ->where("pigcms_id = $pigcms_id")
                ->save(array('uid'=>$uidStr));
            if ($re) {
                return 1;
            } else {
                return 2;
            }
        } else {
            $re = D('house_village_user_bind')
                ->where("pigcms_id = $pigcms_id")
                ->save(array('uid'=>$uid));
            if ($re) {
                return 1;
            } else {
                return 2;
            }
        }
    }


    /******************************后台管理模块**********************************/
    /*
     * @author 曾梦飞
     * @time 2018年1月22日16:55:12
     */

    /**
     * 后台管理模块主页
     */
    public function administration() {
        $ym = empty($_GET['ym'])?strtotime(date("Y-m-d")):strtotime($_GET['ym']);
        $openid = $_SESSION['openid'];
        //判断社区
        if ($_GET['village_id']) {
            $village_id = $_GET['village_id'];
        } else {
            $village_id = D('admin')->where(array('openid'=>$openid))->find()['village_id'];
        }

        $village_arr = M('house_village')->where(array('village_id'=>$village_id))->find();
        $village_name = $village_arr['village_name'];
        //判断停车场
        $garage_id = $village_arr['garage_id'];

//        dump($village_name);exit;
        $adminArr = D('admin')->alias('a')
            ->where(array('a.openid'=>$openid))
            ->find();

        if (!$adminArr) $this->redirect(U('PropertyService/administration_login'));

        //多角色权限修改
        $roleArr = explode(',',$adminArr['role_id']);
        $menusStr = '';
        foreach ($roleArr as $v) {
            $string = M('role')->where(array('role_id'=>$v))->getField('menus');
            if ($menusStr) {
                $i = ',';
            }
            $menusStr .= $i.$string;
        }

        //去重
        $menusArr = array_unique(explode(',',$menusStr));
        $menusStr = implode(',',$menusArr);
        //上层管理分类
        $topArr = D('permission_menu')->where(array('auth_type'=>5,'is_show'=>1,'auth_area'=>1,'fid'=>0))->select();
        foreach ($topArr as $k=> $v) {
            $id = $v['id'];
            if (!in_array($id,$menusArr)){
                unset($topArr[$k]);
            }
        }


        foreach ($topArr as $key=>$value){
            $g = $topArr[$key]['module'];
            $c = $topArr[$key]['controller'];
            $a = $topArr[$key]['action'];
            $topArr[$key]['url'] = U("$g/$c/$a")."&ym=$ym&village_id=$village_id";
            if ($value['name'] == '停车缴费') {
                $topArr[$key]['url'] = U("$g/$c/$a")."&ym=$ym&village_id=$village_id&garage_id=$garage_id";
            }
        }

        //算出预览外层分类
        $bigArr = D('permission_menu')->where(array('auth_type'=>4,'is_show'=>1,'auth_area'=>1,'fid'=>0))->select();
        //计算出管理员可看到的模块
        $map['auth_type'] = array('eq',4);
//        $map['auth_area'] = array('eq',0);
        $map['is_show'] = array('eq',1);
        $map['id']  = array('in',$menusStr);
        $menus_auth_arr = D('permission_menu')->alias('p')
            ->where($map)
            ->select();

        //逻辑层
        $logic =  Logic('wap');
        $index_box_array = $logic->index_dashboard_data($ym,$garage_id,$village_id);
        $begin_time=$ym;   //开始时间
        $end_time=$begin_time+86400;    //结束时间

        $today_begin_time = strtotime(date("Y-m-d"));//当天开始时间
        $today_end_time = $today_begin_time+86400;//当天结束时间

        foreach ($menus_auth_arr as $key=>$value){
            $argArray = unserialize($value['arguments']);
            foreach ($argArray as $kk=>$vv){
                if($vv['a_value'] ==''){
                    $referer ='&'.$argArray[0]['a_key'].'='.$begin_time.'&'.$argArray[1]['a_key'].'='.$end_time;
                }else{
                    $referer .='&'.$vv['a_key'].'='.$vv['a_value'];
                }
            }
            $g = $menus_auth_arr[$key]['module'];
            $c = $menus_auth_arr[$key]['controller'];
            $a = $menus_auth_arr[$key]['action'];
            $menus_auth_arr[$key]['url'] = U("$g/$c/$a")."&ym=$ym";
//            if ($a == 'Payrecord/showlist_pay' || $a == 'Car/showlist') {
//                $menus_auth_arr[$key]['url'] = "Car/index.php?s=/Admin/$a/startDate/$begin_time/endDate/$end_time/garage_id/$garage_id";
//            } else {
//                $menus_auth_arr[$key]['url'] = "/admin.php?g=$g&c=$c&a=$a".$referer;
//            }
            //是否为已抄表数
            if ($value['name'] == '已抄表数'){
                $menus_auth_arr[$key]['url'] .= '&is_record=1';
            }elseif ($value['name'] == '未抄表数'){
                $menus_auth_arr[$key]['url'] .= '&is_record=0';
            } elseif ($value['name'] == '巡更异常数') {
                $menus_auth_arr[$key]['url'] .= '&point_status=1';
            } elseif ($value['name'] == '总交易金额') {
                $menus_auth_arr[$key]['url'] .= '&point_status=1';
            } elseif ($value['name'] == '早班') {
                $menus_auth_arr[$key]['url'] .= '&work_time=1';
            } elseif ($value['name'] == '中班') {
                $menus_auth_arr[$key]['url'] .= '&work_time=2';
            } elseif ($value['name'] == '晚班') {
                $menus_auth_arr[$key]['url'] .= '&work_time=3';
            } elseif ($value['name'] == '已上线项目') {
                $menus_auth_arr[$key]['url'] .= '&point_status=1';
            } elseif ($value['name'] == '水表') {
                $menus_auth_arr[$key]['url'] .= '&type=1';
            } elseif ($value['name'] == '电表') {
                $menus_auth_arr[$key]['url'] .= '&type=5';
            }
            $menus_auth_arr[$key]['url'] .= '&village_id='.$village_id;
            $menus_auth_arr[$key]['data_value'] = $index_box_array[$value['data_value']];
        }
//        $data = array();
        foreach ($bigArr as &$v) {
            $id = $v['id'];
            foreach ($menus_auth_arr as $sv) {
                if ($sv['fid'] == $id) {
                    $v['son'][] = $sv;
                }
            }
        }
        unset($v);
        //剔除掉son为空的子集
        foreach ($bigArr as $k => $v) {
            if (empty($v['son'])) unset($bigArr[$k]);
        }

        //所有社区
        $villageAll = M('house_village')->where(array('status'=>1))->select();
        $this->assign('villageAll',$villageAll);
        $this->assign('village_id',$village_id);
        $this->assign('topArr',$topArr);
        $this->assign('bigArr',$bigArr);
        $this->assign('village_name',$village_name);
        $this->assign('begin_time',$begin_time);
        $this->assign('today_begin_time',$today_begin_time);
        $this->assign('today_end_time',$today_end_time);
        $this->display();
    }

    //登录
    public function administration_login() {
        if ($_POST) {
            $account = I('post.account');
            $pwd = md5(I('post.pwd'));
            $re = D('admin')->where(array('account'=>$account,'pwd'=>$pwd))->find();
            if ($re) {
                $openid = $_SESSION['openid'];
                if (empty($openid)) $this->error('请用微信登录');
                D('admin')->where(array('account'=>$account,'pwd'=>$pwd))->save(array('openid'=>$openid));
                $this->success('登录成功',U('PropertyService/administration'));
            } else {
                $this->error('登陆失败',U('PropertyService/administration_login'));
            }
        } else {
            $this->display();
        }

    }

    //在线抄表
    public function meter_record_news() {
        //筛选社区
        if ($_GET['village_id']) {
            $village_id =  $_GET['village_id'];
        } else {
            $openid = $_SESSION['openid'];
            $village_id = D('admin')->where(array('openid'=>$openid))->find()['village_id'];
        }

        $ym = empty($_GET['ym'])?date("Y-m-d"):date('Y-m-d',$_GET['ym']);
        $time_ym = empty($_GET['ym'])?date("Y-m"):date('Y-m',$_GET['ym']);
        $is_record = $_GET['is_record'];
//        $is_record = 0;
        $model = new RoomModel();
        $search = empty($_GET['search'])?'':$_GET['search'];

        $list = $model->meter_record_two($time_ym,$is_record,$village_id,$search);//取全部数据，取完再做赛选
        //算出总记录数
        $list_chaobiao = $model->meter_record($time_ym,$is_record,$village_id);//取全部数据，取完再做赛选
        $is_record_count = 0;
        $no_record_count = 0;
        foreach($list_chaobiao as $key=>$row){
            if($row['is_record']){
                //10.已抄表数
                $is_record_count ++;
            }else{
                //11.未抄表数
                $no_record_count ++;
            }


        }
//        dump($list);exit;
//        dump($is_record_count);exit;
        if(!empty($search)) $this->assign('searchV',$search);
        $this->assign('village_id',$village_id);
        $this->assign('list',$list);
        $this->assign('is_record',$is_record);
        $this->assign('begin_time',$ym);
        $this->assign('time',$_GET['ym']);
        $this->assign('is_record_count',$is_record_count);
        $this->assign('no_record_count',$no_record_count);
        $this->display();
    }

    //在线抄表下拉刷新操作
    public function meter_record_news_ajax() {
        //筛选社区
        if ($_POST['village_id']) {
            $village_id =  $_POST['village_id'];
        } else {
            $openid = $_SESSION['openid'];
            $village_id = D('admin')->where(array('openid'=>$openid))->find()['village_id'];
        }
        $model = new RoomModel();
        $ym = date('Y-m',I('post.ym'));
        $search = I('post.search');
        $is_record = I('post.is_record');
        $more = I('post.more');
        $list =  $model->meter_record_two($ym,$is_record,$village_id,$search,$more);//取全部数据，取完再做赛选
        $str = '';
        if ($list) {
            foreach ($list as $v) {
                $id = $v['id'];
                $meter_floor = $v['meter_floor'];
                $meter_type_name = $v['meter_type_name'];
                $consume = number_format($v['consume'],2);
                if ($is_record != 1) $consume = '未知';
                $str.= "<tr>
                        <td height=\"40\" align=\"center\" style=\"font-size:14px; color:#515455; border-bottom:1px #efefef solid;\">$id</td>
                        <td height=\"40\" align=\"center\" style=\"font-size:14px; color:#515455; border-bottom:1px #efefef solid;\">$meter_floor</td>
                        <td height=\"40\" align=\"center\" style=\"font-size:14px; color:#515455; border-bottom:1px #efefef solid;\">$meter_type_name</td>
                        <td height=\"40\" align=\"center\" style=\"font-size:14px; color:#515455; border-bottom:1px #efefef solid;\">$consume</td>
                    </tr>";
            }
        }
        echo $str;

    }


    //在线巡更
    public function point_record() {
        //筛选社区
        if ($_GET['village_id']) {
            $village_id =  $_GET['village_id'];
        } else {
            $openid = $_SESSION['openid'];
            $village_id = D('admin')->where(array('openid'=>$openid))->find()['village_id'];
        }

        //查询是否设置班次信息
        $setArr = M('house_village_shift')->where(array('village_id'=>$village_id))->find();
        if (!$setArr) {
                  $setArr = M('house_village_shift')->where(array('id'=>1))->find();
              }      

        if (isset($_GET['ym'])) $_GET['d_time'] = date('Y-m-d',$_GET['ym']);
        if(isset($_GET['d_time'])&&empty($_GET['work_time'])){
            $thisDayStart = strtotime('+7 hours',strtotime($_GET['d_time']));
            $thisDayEnd = strtotime('+1 days',$thisDayStart);

        }elseif (!isset($_GET['d_time'])&&!empty($_GET['work_time'])){
            if($_GET['work_time'] == 1){
                $thisDayStart = strtotime(date('Y-m-d').$setArr['morning_time_from']);
                $thisDayEnd =strtotime(date('Y-m-d').$setArr['morning_time_to']);
            }elseif ($_GET['work_time'] == 2){
                $thisDayStart = strtotime(date('Y-m-d').$setArr['middle_time_from']);
                $thisDayEnd =strtotime(date('Y-m-d').$setArr['middle_time_to']);
            }else{
                $thisDayStart = strtotime(date('Y-m-d').$setArr['night_time_from']);
                $thisDayEnd =strtotime('+1 day',strtotime(date('Y-m-d').$setArr['night_time_to']));
            }
        }elseif (isset($_GET['d_time'])&&!empty($_GET['work_time'])){
            if($_GET['work_time'] == 1){
                $thisDayStart = strtotime($_GET['d_time'].$setArr['morning_time_from']);
                $thisDayEnd =strtotime($_GET['d_time'].$setArr['morning_time_to']);
            }elseif ($_GET['work_time'] == 2){
                $thisDayStart = strtotime($_GET['d_time'].$setArr['middle_time_from']);
                $thisDayEnd =strtotime($_GET['d_time'].$setArr['middle_time_to']);
            }else{
                $thisDayStart = strtotime($_GET['d_time'].$setArr['night_time_from']);
                $thisDayEnd =strtotime('+1 day',strtotime($_GET['d_time'].$setArr['night_time_to']));
            }
        }else{
            //如果没有任何选项则进入当前当班的统计
            $nowTime = time();
            if($nowTime>=strtotime(date('Y-m-d').$setArr['morning_time_from'])&&$nowTime<=strtotime(date('Y-m-d').$setArr['morning_time_to'])){
                $thisDayStart = strtotime(date('Y-m-d').$setArr['morning_time_from']);
                $thisDayEnd = strtotime(date('Y-m-d').$setArr['morning_time_to']);
                $this->assign('w_time',1);
            }elseif ($nowTime>=strtotime(date('Y-m-d').$setArr['middle_time_from'])&&$nowTime<=strtotime(date('Y-m-d').$setArr['middle_time_to'])){
                $thisDayStart = strtotime(date('Y-m-d').$setArr['middle_time_from']);
                $thisDayEnd = strtotime(date('Y-m-d').$setArr['middle_time_to']);
                $this->assign('w_time',2);
            }elseif ($nowTime>=strtotime(date('Y-m-d').$setArr['night_time_from'])&&$nowTime<=strtotime('+1 day',strtotime(date('Y-m-d').$setArr['night_time_to']))){
                $thisDayStart = strtotime(date('Y-m-d').$setArr['night_time_from']);
                $thisDayEnd = strtotime('+1 day',strtotime(date('Y-m-d').$setArr['night_time_to']));
                $this->assign('w_time',3);
            }

        }

        //已经巡检的巡更点
        $nowPointCount = M('village_point_record')->alias('r')
            ->field(array("count(DISTINCT pid)"=>'num'))
            ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
            ->where(array('r.check_time'=>array('between',array($thisDayStart,$thisDayEnd))))
            ->where(array('m.village_id'=>$village_id))
            ->select()[0]['num'];
//        vd($nowPointCount);exit;
        $_map['r.check_time'] =array('between',array($thisDayStart,$thisDayEnd));
        //字段
        $field=array(
            'r.*',
            'p.orientation',
            'm.room_name',
            'v.village_name',
            'b.name'
        );
        $_map['v.village_id'] = array('eq',$village_id);
        //搜索
        $search = empty($_GET['search'])?'':$_GET['search'];
        if (!empty($search)) {
            $_map['r.pigcms_id|m.room_name|b.name'] = array("like","%{$search}%");
        }
        //巡更异常情况
        if (!empty($_GET['point_status']) && $_GET['point_status'] == 1) $_map['r.point_status'] = array('eq',1);
        //普通管理员
        //构建子查询
        $chlidSql = M('house_village_user_bind')->field(array('uid','`name`','MAX(pigcms_id)'))->group('uid')->buildSql();
        //主查询

        $pointRecord = M('village_point_record')
            ->alias('r')
            ->field($field)
            ->join('LEFT JOIN '.$chlidSql.' b on b.uid=r.uid')
            ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
            ->join('LEFT JOIN __HOUSE_VILLAGE__ v on v.village_id=m.village_id')
            ->where($_map)
            ->order('r.point_status desc,r.check_time desc')
            ->limit(15)
            ->select();

        //巡更更改（范围更广）2018/5/19
        foreach ($pointRecord as &$v) {
            if (empty($v['name'])) $v['name'] = D('user')->where(array('uid'=>$v['uid']))->getField('truename');
        }
        unset($v);

        //已巡更点数
        $ok_Record_num = count($pointRecord);
//        dump($pointRecord);exit;

        //一共多少巡更点
        $pointCount = M('house_village_point')->where(array('type' => 0))->where(array('is_del'=>0))->count();


        //未巡更的点
        $lowPointCount = $pointCount-$nowPointCount;
        if($lowPointCount<=0)$lowPointCount=0;

        if(!empty($search)) $this->assign('searchV',$search);
        if(!empty($work_time)) $this->assign('work_time',$work_time);
        $this->assign('point_status',$_GET['point_status']);
        $this->assign('ok_Record_num',$ok_Record_num);
        $this->assign('pointRecord',$pointRecord);
        $this->assign('lowPointCount',$lowPointCount);
        $this->assign('pointCount',$pointCount);
        $this->assign('nowPointCount',$nowPointCount);
        $this->assign('begin_time',date('Y-m-d',$_GET['ym']));
        $this->assign('time',$_GET['ym']);
        $this->assign('village_id',$village_id);
        $this->display();
    }


    //在线巡更
    public function no_point_record() {

    }

    //在线巡更下拉刷新
    public function point_record_ajax() {
        //筛选社区
        if ($_GET['village_id']) {
            $village_id =  $_GET['village_id'];
        } else {
            $openid = $_SESSION['openid'];
            $village_id = D('admin')->where(array('openid'=>$openid))->find()['village_id'];
        }

        if (isset($_GET['ym'])) $_GET['d_time'] = date('Y-m-d',$_GET['ym']);
        if(isset($_GET['d_time'])&&empty($_GET['work_time'])){
            $thisDayStart = strtotime('+7 hours',strtotime($_GET['d_time']));
            $thisDayEnd = strtotime('+1 days',$thisDayStart);

        }elseif (!isset($_GET['d_time'])&&!empty($_GET['work_time'])){
            if($_GET['work_time'] == 1){
                $thisDayStart = strtotime(date('Y-m-d').'07:00:00');
                $thisDayEnd =strtotime(date('Y-m-d').'15:00:00');
            }elseif ($_GET['work_time'] == 2){
                $thisDayStart = strtotime(date('Y-m-d').'15:00:00');
                $thisDayEnd =strtotime(date('Y-m-d').'23:00:00');
            }else{
                $thisDayStart = strtotime(date('Y-m-d').'23:00:00');
                $thisDayEnd =strtotime('+1 day',strtotime(date('Y-m-d').'07:00:00'));
            }
        }elseif (isset($_GET['d_time'])&&!empty($_GET['work_time'])){
            if($_GET['work_time'] == 1){
                $thisDayStart = strtotime($_GET['d_time'].'07:00:00');
                $thisDayEnd =strtotime($_GET['d_time'].'15:00:00');
            }elseif ($_GET['work_time'] == 2){
                $thisDayStart = strtotime($_GET['d_time'].'15:00:00');
                $thisDayEnd =strtotime($_GET['d_time'].'23:00:00');
            }else{
                $thisDayStart = strtotime($_GET['d_time'].'23:00:00');
                $thisDayEnd =strtotime('+1 day',strtotime($_GET['d_time'].'07:00:00'));
            }
        }else{
            //如果没有任何选项则进入当前当班的统计
            $nowTime = time();
            if($nowTime>=strtotime(date('Y-m-d').'07:00:00')&&$nowTime<=strtotime(date('Y-m-d').'15:00:00')){
                $thisDayStart = strtotime(date('Y-m-d').'07:00:00');
                $thisDayEnd = strtotime(date('Y-m-d').'15:00:00');
                $this->assign('w_time',1);
            }elseif ($nowTime>=strtotime(date('Y-m-d').'15:00:00')&&$nowTime<=strtotime(date('Y-m-d').'23:00:00')){
                $thisDayStart = strtotime(date('Y-m-d').'15:00:00');
                $thisDayEnd = strtotime(date('Y-m-d').'23:00:00');
                $this->assign('w_time',2);
            }elseif ($nowTime>=strtotime(date('Y-m-d').'23:00:00')&&$nowTime<=strtotime('+1 day',strtotime(date('Y-m-d').'07:00:00'))){
                $thisDayStart = strtotime(date('Y-m-d').'23:00:00');
                $thisDayEnd = strtotime('+1 day',strtotime(date('Y-m-d').'07:00:00'));
                $this->assign('w_time',3);
            }

        }

        $_map['r.check_time'] =array('between',array($thisDayStart,$thisDayEnd));
        //字段
        $field=array(
            'r.*',
            'p.orientation',
            'm.room_name',
            'v.village_name',
            'b.name'
        );
        $_map['v.village_id'] = array('eq',$village_id);
        //搜索
        $search = empty($_GET['search'])?'':$_GET['search'];
        if (!empty($search)) {
            $_map['r.pigcms_id|m.room_name|b.name'] = array("like","%{$search}%");
        }
        //巡更异常情况
        if (!empty($_GET['point_status']) && $_GET['point_status'] == 1) $_map['r.point_status'] = array('eq',1);
        //普通管理员
        //构建子查询
        $chlidSql = M('house_village_user_bind')->field(array('uid','`name`','MAX(pigcms_id)'))->group('uid')->buildSql();
        //主查询
        $more = $_GET['more']?:0;
        $pointRecord = M('village_point_record')
            ->alias('r')
            ->field($field)
            ->join('LEFT JOIN '.$chlidSql.' b on b.uid=r.uid')
            ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
            ->join('LEFT JOIN __HOUSE_VILLAGE__ v on v.village_id=m.village_id')
            ->where($_map)
            ->order('r.point_status desc,r.check_time desc')
            ->limit($more,15)
            ->select();
        $str = '';
        foreach ($pointRecord as $v) {
            $pigcms_id = $v['pigcms_id'];
            $room_name = $v['room_name'];
            $name = $v['name'];
            $point_status = $v['point_status'];
            $str .= "<tr><td height=\"40\" align=\"center\" style=\"font-size:14px; color:#515455; border-bottom:1px #efefef solid;\">$pigcms_id</td>
                        <td height=\"40\" align=\"center\" style=\"font-size:14px; color:#515455; border-bottom:1px #efefef solid;\">$room_name</td>
                        <td height=\"40\" align=\"center\" style=\"font-size:14px; color:#515455; border-bottom:1px #efefef solid;\">$name</td>";
            if ($point_status == 0) {
                $str .= "<td height=\"40\" align=\"center\" style=\"font-size:14px; color:#515455; border-bottom:1px #efefef solid;\">正常</td></tr>";
            } else {
                $str .= "<td height=\"40\" align=\"center\" style=\"font-size:14px; color:#cc463d; border-bottom:1px #efefef solid;\">异常</td></tr>";
            }
        }
        echo $str;

    }

    //停车缴费
    public function showlist_pay() {
        //筛选社区
        if ($_GET['village_id']) {
            $village_id =  $_GET['village_id'];
        } else {
            $openid = $_SESSION['openid'];
            $village_id = D('admin')->where(array('openid'=>$openid))->find()['village_id'];
        }
        //判断停车场
        $garage_id = M('house_village')->where(array('village_id'=>$village_id))->find()['garage_id'];
        $nowtime = isset($_GET['ym'])?$_GET['ym']:strtotime(date('Y-m-d'));
        $startDate = isset($_GET['ym'])?$_GET['ym']:strtotime(date('Y-m-d'));
        $endDate = $startDate+24*3600;
        //早中晚班
        if (!empty($_GET['work_time'])){
            if($_GET['work_time'] == 1){
                $startDate = $nowtime+7*3600;
                $endDate =$nowtime+15*3600;
            }elseif ($_GET['work_time'] == 2){
                $startDate = $nowtime+15*3600;
                $endDate = $nowtime+23*3600;
            }else{
                $startDate = $nowtime+23*3600;
                $endDate = $nowtime+31*3600;
            }
        }
        if (empty($_GET['point_status']) || $_GET['point_status'] != 1) {
            $map['p.pay_time']=array(array('egt',$startDate),array('elt',$endDate));
        };
        $map['serv.garage_id'] = $garage_id;

        //字段
        $field = array(
            'p.pay_id',
            'u.user_id',
            'car.car_id',
            'cp.cp_id',
            'u.user_name', //车主名称
            'serv.car_no', //车牌
            'p.payment', //应付金额
            'p.pay_loan', //实缴金额
            'CASE cp.cp_type' . //优惠金额计算
            ' WHEN ' .CPTYPE_MONEY_FREE .' THEN cp.cp_hilt ' . //金额减免
            ' WHEN ' .CPTYPE_TIME_FREE. ' THEN cp.cp_hilt*' . PARK_FEE_Q1H . //时间减免 量化成金额减免
            ' WHEN ' .CPTYPE_ALL_FREE. ' THEN p.payment' . //全免,量化成金额减免
            ' END'=>'pay_free',//优惠金额
            'g.garage_name',
            'car.car_role', //是否是月卡
            'serv.start_time'=>'in_part_time',//车辆进场时间
            'serv.end_time'=>'out_part_time', //车辆出场时间
            'p.pay_status', //支付状态
            'p.pay_time', //支付时间戳
            'p.create_time', //创建时间戳

        );
        $search = empty($_GET['search'])?'':$_GET['search'];
        if (!empty($search)) {
            $map['u.user_name|serv.car_no|p.pay_loan'] = array("like","%{$search}%");
        }
        $count = M('payrecord','smart_')->alias('p')
            ->field('count(*)')
            ->join('left join smart_servicerecord serv on serv.serv_id = p.serv_id')
            ->join('left join smart_car car on car.car_no = serv.car_no')
            ->join('left join smart_garage g on g.garage_id = serv.garage_id')
            ->join('left join smart_user u on u.user_id = p.user_id')
            ->join('left join smart_coupon cp on cp.cp_id = p.cp_id ')
            ->where($map)
            ->group('p.pay_id')
            ->select(false);
        //由于使用了group，总条数为
        $count = M('payrecord','smart_')->query("select count(*) as count from ($count) as c")[0]['count'];
        //分页
//        $page = new Page($count,I('get.list_rows',0,'int')?:LIST_ROWS);
        //分页数据
        $list = M('payrecord','smart_')->alias('p')
            ->field($field)
            ->join('left join smart_servicerecord serv on serv.serv_id = p.serv_id')
            ->join('left join smart_car car on car.car_no = serv.car_no')
            ->join('left join smart_garage g on g.garage_id = serv.garage_id')
            ->join('left join smart_user u on u.user_id = p.user_id')
            ->join('left join smart_coupon cp on cp.cp_id = p.cp_id')
            ->where($map)
            ->limit(15)
            ->group('p.pay_id')
            ->order('p.pay_time desc')
            ->select();

//        dump($list);exit();
        if(!empty($search)) $this->assign('searchV',$search);
        if(!empty($_GET['work_time'])) $this->assign('work_time',$_GET['work_time']);
        $this->assign('list',$list);
        $this->assign('count',$count);
        $this->assign('point_status',$_GET['point_status']);
        $this->assign('time',$nowtime);
        $this->assign('begin_time',date('Y-m-d',$_GET['ym']));
        $this->assign('village_id',$village_id);
        $this->display();
    }

    //停车缴费下拉刷新
    public function showlist_pay_ajax() {
        //筛选社区
        if ($_GET['village_id']) {
            $village_id =  $_GET['village_id'];
        } else {
            $openid = $_SESSION['openid'];
            $village_id = D('admin')->where(array('openid'=>$openid))->find()['village_id'];
        }
        //判断停车场
        $garage_id = M('house_village')->where(array('village_id'=>$village_id))->find()['garage_id'];
        $nowtime = isset($_GET['ym'])?$_GET['ym']:strtotime(date('Y-m-d'));
        $startDate = isset($_GET['ym'])?$_GET['ym']:strtotime(date('Y-m-d'));
        $endDate = $startDate+24*3600;
        //早中晚班
        if (!empty($_GET['work_time'])){
            if($_GET['work_time'] == 1){
                $startDate = $nowtime+7*3600;
                $endDate =$nowtime+15*3600;
            }elseif ($_GET['work_time'] == 2){
                $startDate = $nowtime+15*3600;
                $endDate = $nowtime+23*3600;
            }else{
                $startDate = $nowtime+23*3600;
                $endDate = $nowtime+31*3600;
            }
        }
        if (empty($_GET['point_status']) || $_GET['point_status'] != 1) {
            $map['p.pay_time']=array(array('egt',$startDate),array('elt',$endDate));
        };
        $map['serv.garage_id'] = $garage_id;

        //字段
        $field = array(
            'p.pay_id',
            'u.user_id',
            'car.car_id',
            'cp.cp_id',
            'u.user_name', //车主名称
            'serv.car_no', //车牌
            'p.payment', //应付金额
            'p.pay_loan', //实缴金额
            'CASE cp.cp_type' . //优惠金额计算
            ' WHEN ' .CPTYPE_MONEY_FREE .' THEN cp.cp_hilt ' . //金额减免
            ' WHEN ' .CPTYPE_TIME_FREE. ' THEN cp.cp_hilt*' . PARK_FEE_Q1H . //时间减免 量化成金额减免
            ' WHEN ' .CPTYPE_ALL_FREE. ' THEN p.payment' . //全免,量化成金额减免
            ' END'=>'pay_free',//优惠金额
            'g.garage_name',
            'car.car_role', //是否是月卡
            'serv.start_time'=>'in_part_time',//车辆进场时间
            'serv.end_time'=>'out_part_time', //车辆出场时间
            'p.pay_status', //支付状态
            'p.pay_time', //支付时间戳
            'p.create_time', //创建时间戳

        );
        $search = empty($_GET['search'])?'':$_GET['search'];
        if (!empty($search)) {
            $map['u.user_name|serv.car_no|p.pay_loan'] = array("like","%{$search}%");
        }
        $more = $_GET['more']?:0;
        $list = M('payrecord','smart_')->alias('p')
            ->field($field)
            ->join('left join smart_servicerecord serv on serv.serv_id = p.serv_id')
            ->join('left join smart_car car on car.car_no = serv.car_no')
            ->join('left join smart_garage g on g.garage_id = serv.garage_id')
            ->join('left join smart_user u on u.user_id = p.user_id')
            ->join('left join smart_coupon cp on cp.cp_id = p.cp_id')
            ->where($map)
            ->limit($more,15)
            ->group('p.pay_id')
            ->order('p.pay_time desc')
            ->select();
        $str = '';
        foreach ($list as $v) {
            $user_name = substr($v['user_name'],0,15);
            $car_no = $v['car_no'];
            $pay_loan = $v['pay_loan'];
            $pay_time = date('H:i',$v['pay_time']);
            $str .= "<tr>
                        <td height=\"40\" align=\"center\" style=\"font-size:14px; color:#515455; border-bottom:1px #efefef solid;\">$user_name</td>
                        <td height = \"40\" align=\"center\" style=\"font-size:14px; color:#515455; border-bottom:1px #efefef solid;\">$car_no</td>
                        <td height=\"40\" align=\"center\" style=\"font-size:14px; color:#515455; border-bottom:1px #efefef solid;\">$pay_loan</td>
                        <td height=\"40\" align=\"center\" style=\"font-size:14px; color:#515455; border-bottom:1px #efefef solid;\">$pay_time</td>
                    </tr>";
        }
        echo $str;


    }

    /**
     * 车辆信息列表
     * @update-time: 2018-1-26 16:23
     */
    public function showlist_car(){
        $startDate = isset($_GET['ym'])?$_GET['ym']:strtotime(date('Y-m-d'));
        //筛选社区
        if ($_GET['village_id']) {
            $village_id =  $_GET['village_id'];
        } else {
            $openid = $_SESSION['openid'];
            $village_id = D('admin')->where(array('openid'=>$openid))->find()['village_id'];
        }
        //判断停车场
        $garage_id = M('house_village')->where(array('village_id'=>$village_id))->find()['garage_id'];
        //字段
        $field = array(
            'c.user_id',
            'c.car_id',
            'c.car_no',
            'u.user_name',
            'c.add_time',
            'c.car_role',
            'c.end_time', //结束时间戳
        );
        $map['c.garage_id'] = array('eq',$garage_id);
        $search = empty($_GET['search'])?'':$_GET['search'];
        if (!empty($search)) {
            $map['u.user_name|c.car_no'] = array("like","%{$search}%");
        }
        //总条数
        $count = M('car','smart_')->alias('c')
            ->field('distinct c.car_no,count(*) as num')
            ->join('left join smart_user u on c.user_id=u.user_id')
            ->join('left join smart_garage g on c.garage_id=g.garage_id')
            ->where($map)
            ->group("c.car_no")
            ->select();//车辆数
        $count = count($count);
        //列表数据
        $list = M('car','smart_')->alias('c')
            ->field($field)
            ->join('left join smart_user u on c.user_id=u.user_id')
            ->join('left join smart_garage g on c.garage_id=g.garage_id')
            ->where($map)
            ->group("c.car_no")
            ->limit(15)
            ->order('c.add_time desc')
            ->select();//车辆数

//        dump($list);exit;
//        dump($model->getLastSql());exit;
        if(!empty($search)) $this->assign('searchV',$search);
        $this->assign('list',$list);//当页数据
        $this->assign('count',$count);//总条数
        $this->assign('time',$startDate);
        $this->assign('village_id',$village_id);
        $this->assign('begin_time',date('Y-m-d',$_GET['ym']));
        $this->display();
    }

    /**
     * 车辆信息列表下拉刷新
     * @update-time: 2018-1-27 16:00
     */
    public function showlist_car_ajax() {
        $startDate = isset($_GET['ym'])?$_GET['ym']:strtotime(date('Y-m-d'));
        //筛选社区
        if ($_GET['village_id']) {
            $village_id =  $_GET['village_id'];
        } else {
            $openid = $_SESSION['openid'];
            $village_id = D('admin')->where(array('openid'=>$openid))->find()['village_id'];
        }
        //判断停车场
        $garage_id = M('house_village')->where(array('village_id'=>$village_id))->find()['garage_id'];
        //字段
        $field = array(
            'c.user_id',
            'c.car_id',
            'c.car_no',
            'u.user_name',
            'c.add_time',
            'c.car_role',
            'c.end_time', //结束时间戳
        );
        $map['c.garage_id'] = array('eq',$garage_id);
        $search = empty($_GET['search'])?'':$_GET['search'];
        if (!empty($search)) {
            $map['u.user_name|c.car_no'] = array("like","%{$search}%");
        }
        $more = $_GET['more']?:0;
        //列表数据
        $list = M('car','smart_')->alias('c')
            ->field($field)
            ->join('left join smart_user u on c.user_id=u.user_id')
            ->join('left join smart_garage g on c.garage_id=g.garage_id')
            ->where($map)
            ->group("c.car_no")
            ->limit($more,15)
            ->order('c.add_time desc')
            ->select();//车辆数
        $str = '';
        foreach ($list as $v) {
            $user_name = substr($v['user_name'],0,15);
            $car_no = $v['car_no'];
            $car_role = $v['car_role'];
            $add_time = date('Y-m-d H:i',$v['add_time']);
            if ($car_role == 0) {
                $car_roleStr = "临时卡";
            } else {
                $car_roleStr = "月卡";
            }
            if ($user_name) {
                $str .= "<tr>
                            <td height=\"40\" align=\"center\" style=\"font-size:14px; color:#515455; border-bottom:1px #efefef solid;\">$user_name</td>
                            <td height = \"40\" align=\"center\" style=\"font-size:14px; color:#515455; border-bottom:1px #efefef solid;\">$car_no</td>
                            <td height=\"40\" align=\"center\" style=\"font-size:14px; color:#515455; border-bottom:1px #efefef solid;\">$car_roleStr</td>
                            <td height=\"40\" align=\"center\" style=\"font-size:12px; color:#515455; border-bottom:1px #efefef solid;\">$add_time</td>
                        </tr>";
            }
        }
        echo $str;
    }


    /**
     * 意见反馈列表
     */
    public function suggess_list(){
        //筛选社区
        if ($_GET['village_id']) {
            $village_id =  $_GET['village_id'];
        } else {
            $openid = $_SESSION['openid'];
            $village_id = D('admin')->where(array('openid'=>$openid))->find()['village_id'];
        }

        $model = M('house_village_repair_list','pigcms_');
        //计算记录所对应的sort_id

        $field = array(
            'hvrl.pigcms_id',//编号
            'hvrl.content',//描述
            'hvrl.name',//姓名
            'hvrl.pic',//图片
            'hvrl.appointment_start_time',//预约起始时间
            'hvrl.appointment_end_time',//预约结束时间
            'hvrl.meal_id',
            'hvrl.contact',//联系方式
            'hvrl.is_read',//是否审核
            'hvrl.time',//记录添加时间
            'hvrl.village_id',//社区ID
            'm.price',//价格
            'm.unit',//单位
            'm.name'=>'meal_name',//商铺名称
        );
        $map = array();
        $map['hvrl.type'] = array('in','3,4');
        $map['hvrl.village_id'] = array('eq',$village_id);

        $search = empty($_GET['search'])?'':$_GET['search'];
        if (!empty($search)) {
            $map['hvrl.name|hvrl.content'] = array("like","%{$search}%");
        }

        $list = $model->alias('hvrl')
            ->field($field)
            ->join('left join __MEAL__ m on m.meal_id = hvrl.meal_id')
            ->where($map)
            ->order('hvrl.pigcms_id desc')
            ->limit(15)
            ->select();
        $list_num = $model->alias('hvrl')
            ->field('count(*) as num')
            ->join('left join __MEAL__ m on m.meal_id = hvrl.meal_id')
            ->where($map)
            ->order('hvrl.time desc')
            ->count();

//        foreach($list as $k=>&$v){
//            $v['village_name'] = $this->get_village_name($v['village_id']);
//        }
//        unset($v);
        if(!empty($search)) $this->assign('searchV',$search);
        $this->assign('list',$list);
        $this->assign('count',$list_num);
        $this->assign('time',$_GET['ym']);
        $this->assign('village_id',$village_id);
        $this->assign('begin_time',date('Y-m-d',$_GET['ym']));
        $this->display();
    }

    /**
     * 意见反馈下拉刷新
     */
    public function suggess_list_ajax() {
        //筛选社区
        if ($_GET['village_id']) {
            $village_id =  $_GET['village_id'];
        } else {
            $openid = $_SESSION['openid'];
            $village_id = D('admin')->where(array('openid'=>$openid))->find()['village_id'];
        }

        $model = M('house_village_repair_list','pigcms_');
        //计算记录所对应的sort_id

        $field = array(
            'hvrl.pigcms_id',//编号
            'hvrl.content',//描述
            'hvrl.name',//姓名
            'hvrl.pic',//图片
            'hvrl.appointment_start_time',//预约起始时间
            'hvrl.appointment_end_time',//预约结束时间
            'hvrl.meal_id',
            'hvrl.contact',//联系方式
            'hvrl.is_read',//是否审核
            'hvrl.time',//记录添加时间
            'hvrl.village_id',//社区ID
            'm.price',//价格
            'm.unit',//单位
            'm.name'=>'meal_name',//商铺名称
        );
        $map = array();
        $map['hvrl.type'] = array('in','3,4');
        $map['hvrl.village_id'] = array('eq',$village_id);

        $search = empty($_GET['search'])?'':$_GET['search'];
        if (!empty($search)) {
            $map['hvrl.name|hvrl.content'] = array("like","%{$search}%");
        }

        $more = $_GET['more']?:0;
        $list = $model->alias('hvrl')
            ->field($field)
            ->join('left join __MEAL__ m on m.meal_id = hvrl.meal_id')
            ->where($map)
            ->order('hvrl.time desc')
            ->limit($more,15)
            ->select();
        $str = '';
        foreach ($list as $v) {
            $name = $v['name'];
            $content = substr($v['content'],0,15);
            $is_read = $v['is_read'];
            $time = date('Y-m-d H:i:s',$v['time']);
            if ($name) {
                $nameStr = substr($name,0,15);
            } else {
                $nameStr = "该神秘人未透露姓名";
            }
            if ($is_read == 0) {
                $is_readStr = "未处理";
            } else {
                $is_readStr = "已处理";
            }
            $str .= "<tr>
                            <td height=\"40\" align=\"center\" style=\"font-size:12px; color:#515455; border-bottom:1px #efefef solid;\">$nameStr</td>
                            <td height = \"40\" align=\"center\" style=\"font-size:12px; color:#515455; border-bottom:1px #efefef solid;\"><span style=\"font-size: 12px;\">$content</span></td>
                            <td height = \"40\" align=\"center\" style=\"font-size:12px; color:#515455; border-bottom:1px #efefef solid;\">$is_readStr</td>
                            <td height=\"40\" align=\"center\" style=\"font-size:12px; color:#515455; border-bottom:1px #efefef solid;\">$time</td>
                        </tr>";
        }
        echo $str;

    }

    //项目管理
    public function village_news() {
        $search = empty($_GET['search'])?'':$_GET['search'];
        if (!empty($search)) {
            $map['v.village_name|v.property_name|v.property_phone'] = array("like","%{$search}%");
        }
        $more = isset($_GET['more'])?$_GET['more']:0;
        if (!empty($_GET['point_status']) && $_GET['point_status'] == 1) $map['v.status'] = array('eq',1);
        $field = array(
            'v.village_id',
            'v.village_name',
            'v.property_name',
            'v.status',
            'v.property_phone'
        );
        $list = D('house_village')->alias('v')
            ->field($field)
            ->where($map)
            ->limit(15)
            ->select();

        $list_num = D('house_village')->alias('v')
            ->field('count(*) as num')
            ->where($map)
            ->count();
        if(!empty($search)) $this->assign('searchV',$search);
//        $this->assign('more',$more);
        $this->assign('list',$list);
        $this->assign('time',$_GET['ym']);
        $this->assign('begin_time',date('Y-m-d',$_GET['ym']));
        $this->assign('count',$list_num);
        $this->assign('point_status',$_GET['point_status']);
        $this->display();
    }

    //项目管理下拉刷新
    public function village_news_ajax() {
        $search = empty($_GET['search'])?'':$_GET['search'];
        if (!empty($search)) {
            $map['v.village_name|v.property_name|v.property_phone'] = array("like","%{$search}%");
        }
        $more = isset($_GET['more'])?$_GET['more']:0;
        if (!empty($_GET['point_status']) && $_GET['point_status'] == 1) $map['v.status'] = array('eq',1);
        $field = array(
            'v.village_id',
            'v.village_name',
            'v.property_name',
            'v.status',
            'v.property_phone'
        );
        $list = D('house_village')->alias('v')
            ->field($field)
            ->where($map)
            ->limit($more,15)
            ->select();
//        dump($list);exit;
        $str = '';
        foreach ($list as $v) {
            $village_name = $v['village_name'];
            $property_name = substr($v['property_name'],0,15);
            $property_phone = $v['property_phone'];
            $status = $v['status'];
            $str .= "<tr style=\"font-size: 12px;\">
                        <td height=\"40\" align=\"center\" style=\"color:#515455; border-bottom:1px #efefef solid;\">$village_name</td>
                        <td height=\"40\" align=\"center\" style=\"font-size:14px; color:#515455; border-bottom:1px #efefef solid;\"><span style=\"font-size: 12px;\">$property_name</span></td>
                        <td height = \"40\" align=\"center\" style=\"font-size:14px; color:#515455; border-bottom:1px #efefef solid;\">$property_phone</td>";
            if ($status == 1) {
                $str .= "<td height=\"40\" align=\"center\" style=\"font-size:14px; color:#515455; border-bottom:1px #efefef solid;\">正常</td></tr>";
            } else {
                $str .= "<td height=\"40\" align=\"center\" style=\"font-size:14px; color:#515455; border-bottom:1px #efefef solid;\"><span style=\"color: #cc463d;\">未开放</span></td></tr>";
            }

        }

        echo $str;

    }


    //设备管理
    public function meterlist() {
        //筛选社区
        if ($_GET['village_id']) {
            $village_id =  $_GET['village_id'];
        } else {
            $openid = $_SESSION['openid'];
            $village_id = D('admin')->where(array('openid'=>$openid))->find()['village_id'];
        }
        $model = new RoomModel();
        $search = empty($_GET['search'])?'':$_GET['search'];

        if ($_GET['type']) {
            if ($search) {
//                dump($search);exit;
                $list = $model->meterlist_two($village_id,0,$_GET['type'],$search);
            } else {
                $list = $model->meterlist_two($village_id,0,$_GET['type']);
            }
            $list_num = $model->meterlist_three($village_id,$_GET['type'],$search);
        } else {
            if ($search) {
                $list = $model->meterlist_two($village_id,0,'',$search);
            } else {
                $list = $model->meterlist_two($village_id,0);
            }
            $list_num = $model->meterlist_three($village_id,'',$search);
        }

        $count = count($list_num);

        if (!empty($_GET['type'])) $this->assign("type",$_GET['type']);
        if(!empty($search)) $this->assign('searchV',$search);
        $this->assign("list",$list);
        $this->assign("count",$count);
        $this->assign('time',$_GET['ym']);
        $this->assign('village_id',$village_id);
        $this->assign('begin_time',date('Y-m-d',$_GET['ym']));
        $this->display();
    }

    //设备管理下拉刷新
    public function meterlist_ajax() {
        //筛选社区
        if ($_POST['village_id']) {
            $village_id =  $_POST['village_id'];
        } else {
            $openid = $_SESSION['openid'];
            $village_id = D('admin')->where(array('openid'=>$openid))->find()['village_id'];
        }
        $search = I('post.search');
        $type = I('post.type');
        $more = I('post.more');
        $model = new RoomModel();
        if ($type) {
            if ($search) {
                $list = $model->meterlist_two($village_id,$more,$type,$search);
            } else {
                $list = $model->meterlist_two($village_id,$more,$type);
            }
        } else {
            if ($search) {
                $list = $model->meterlist_two($village_id,$more,'',$search);
            } else {
                $list = $model->meterlist_two($village_id,$more);
            }
        }
        $str = "";
        if ($list) {
            foreach ($list as $v) {
                $meter_floor = $v['meter_floor'];
                $meter_code = substr($v['meter_code'],0,15);
                $meter_type_name = $v['meter_type_name'];
                $consume = $v['consume'];
                $str .= "<tr style=\"font-size: 12px;\">
                        <td height=\"40\" align=\"center\" style=\"color:#515455; border-bottom:1px #efefef solid;\">$meter_floor</td>
                        <td height=\"40\" align=\"center\" style=\"font-size:14px; color:#515455; border-bottom:1px #efefef solid;\"><span style=\"font-size: 12px;\">$meter_code</span></td>
                        <td height = \"40\" align=\"center\" style=\"font-size:14px; color:#515455; border-bottom:1px #efefef solid;\">$meter_type_name</td>
                        <td height=\"40\" align=\"center\" style=\"font-size:14px; color:#515455; border-bottom:1px #efefef solid;\">$consume</td>
                    </tr>";
            }
        }
        echo $str;


    }

    //食堂收款
    public function get_money() {
        //筛选社区
        if ($_GET['village_id']) {
            $village_id =  $_GET['village_id'];
        } else {
            $openid = $_SESSION['openid'];
            $village_id = D('admin')->where(array('openid'=>$openid))->find()['village_id'];
        }
        $todayTime = $_GET['ym']?:strtotime(date('Y-m-d'));
        $end_today_time = $todayTime+24*2600;
        $search = empty($_GET['search'])?'':$_GET['search'];
        $field = array(
            'o.mid',
            'o.goods_describe',
            'o.paytime',
            'o.goods_price',
            'cm.wxname'
        );
        $map = array();
        $map['o.ispay'] = array('eq',1);
        if (!empty($search)) {
            $map['o.goods_describe|cm.wxname|o.goods_price'] = array("like","%{$search}%");
        }
        $list = D('cashier_order')->alias('o')
            ->field($field)
            ->join('left join __CASHIER_MERCHANTS__ cm on cm.mid=o.mid')
            ->join('LEFT JOIN __MERCHANT__ m on cm.thirduserid = m.mer_id')
            ->where($map)
            ->where("o.refund != 2 and o.paytime>$todayTime and o.paytime<$end_today_time and m.village_id = $village_id")
            ->limit(15)
            ->order("o.paytime desc")
            ->select();
//        echo M()->_sql();
        $list_num = D('cashier_order')->alias('o')
            ->field('count(*) as num')
            ->join('left join __CASHIER_MERCHANTS__ cm on cm.mid=o.mid')
            ->join('LEFT JOIN __MERCHANT__ m on cm.thirduserid = m.mer_id')
            ->where($map)
            ->where("o.refund != 2 and o.paytime>$todayTime and o.paytime<$end_today_time and m.village_id = $village_id")
            ->count();

        if(!empty($search)) $this->assign('searchV',$search);
        $this->assign("list",$list);
        $this->assign("count",$list_num);
        $this->assign('time',$_GET['ym']);
        $this->assign('village_id',$village_id);
        $this->assign('begin_time',date('Y-m-d',$_GET['ym']));
        $this->display();
    }

    //食堂收款下拉刷新
    public function get_money_ajax() {
        //筛选社区
        if ($_GET['village_id']) {
            $village_id =  $_GET['village_id'];
        } else {
            $openid = $_SESSION['openid'];
            $village_id = D('admin')->where(array('openid'=>$openid))->find()['village_id'];
        }
        $todayTime = $_GET['ym']?:strtotime(date('Y-m-d'));
        $end_today_time = $todayTime+24*2600;
        $search = empty($_GET['search'])?'':$_GET['search'];
        $field = array(
            'o.mid',
            'o.goods_describe',
            'o.paytime',
            'o.goods_price',
            'cm.wxname'
        );
        $map = array();
        $map['o.ispay'] = array('eq',1);
        if (!empty($search)) {
            $map['o.goods_describe|cm.wxname|o.goods_price'] = array("like","%{$search}%");
        }
        $more = $_GET['more']?:0;
        $list = D('cashier_order')->alias('o')
            ->field($field)
            ->join('left join __CASHIER_MERCHANTS__ cm on cm.mid=o.mid')
            ->join('LEFT JOIN __MERCHANT__ m on cm.thirduserid = m.mer_id')
            ->where($map)
            ->where("o.refund != 2 and o.paytime>$todayTime and o.paytime<$end_today_time and m.village_id = $village_id")
            ->limit($more,15)
            ->order("o.paytime desc")
            ->select();
        $str = '';
        foreach ($list as $v) {
            $wxname = substr($v['wxname'],0,15);
            $goods_price = $v['goods_price'];
            $goods_describe = $v['goods_describe'];
            $paytime = date('Y-m-d H:i:s',$v['paytime']);
            $str .= "<tr style=\"font-size: 12px;\">
                        <td height=\"40\" align=\"center\" style=\"color:#515455; border-bottom:1px #efefef solid;\"><span style=\"font-size: 12px;\">$wxname</span></td>
                        <td height = \"40\" align=\"center\" style=\"font-size:14px; color:#515455; border-bottom:1px #efefef solid;\">$goods_price</td>
                        <td height=\"40\" align=\"center\" style=\"font-size:14px; color:#515455; border-bottom:1px #efefef solid;\">$goods_describe</td>
                        <td height=\"40\" align=\"center\" style=\"font-size:12px; color:#515455; border-bottom:1px #efefef solid;\">$paytime</td>
                    </tr >";
        }

        echo $str;

    }

    //食堂收款-交易总额
    public function get_all_money() {
        //筛选社区
        if ($_GET['village_id']) {
            $village_id =  $_GET['village_id'];
        } else {
            $openid = $_SESSION['openid'];
            $village_id = D('admin')->where(array('openid'=>$openid))->find()['village_id'];
        }

        $search = empty($_GET['search'])?'':$_GET['search'];
        $field = array(
            'o.mid',
            'o.goods_describe',
            'o.paytime',
            'o.goods_price',
            'cm.wxname'
        );
        $map = array();
        $map['o.ispay'] = array('eq',1);
        if (!empty($search)) {
            $map['o.goods_describe|cm.wxname|o.goods_price'] = array("like","%{$search}%");
        }
        $list = D('cashier_order')->alias('o')
            ->field($field)
            ->join('left join __CASHIER_MERCHANTS__ cm on cm.mid=o.mid')
            ->join('LEFT JOIN __MERCHANT__ m on cm.thirduserid = m.mer_id')
            ->where($map)
            ->where("o.refund != 2 and m.village_id = $village_id")
            ->limit(15)
            ->order('o.paytime desc')
            ->select();
//        echo M()->_sql();
        $list_num = D('cashier_order')->alias('o')
            ->field('count(*) as num')
            ->join('left join __CASHIER_MERCHANTS__ cm on cm.mid=o.mid')
            ->join('LEFT JOIN __MERCHANT__ m on cm.thirduserid = m.mer_id')
            ->where($map)
            ->where("o.refund != 2 and m.village_id = $village_id")
            ->order('o.paytime desc')
            ->count();

        if(!empty($search)) $this->assign('searchV',$search);
        $this->assign("list",$list);
        $this->assign("count",$list_num);
        $this->assign('time',$_GET['ym']);
        $this->assign('village_id',$village_id);
        $this->assign('begin_time',date('Y-m-d',$_GET['ym']));
        $this->display();
    }

    //食堂收款-交易总额下拉刷新
    public function get_all_money_ajax() {
        //筛选社区
        if ($_GET['village_id']) {
            $village_id =  $_GET['village_id'];
        } else {
            $openid = $_SESSION['openid'];
            $village_id = D('admin')->where(array('openid'=>$openid))->find()['village_id'];
        }

        $search = empty($_GET['search'])?'':$_GET['search'];
        $field = array(
            'o.mid',
            'o.goods_describe',
            'o.paytime',
            'o.goods_price',
            'cm.wxname'
        );
        $map = array();
        $map['o.ispay'] = array('eq',1);
        if (!empty($search)) {
            $map['o.goods_describe|cm.wxname|o.goods_price'] = array("like","%{$search}%");
        }
        $more = $_GET['more']?:0;
        $list = D('cashier_order')->alias('o')
            ->field($field)
            ->join('left join __CASHIER_MERCHANTS__ cm on cm.mid=o.mid')
            ->join('LEFT JOIN __MERCHANT__ m on cm.thirduserid = m.mer_id')
            ->where($map)
            ->where("o.refund != 2 and m.village_id = $village_id")
            ->limit($more,15)
            ->order('o.paytime desc')
            ->select();
        $str = '';
        foreach ($list as $v) {
            $wxname = substr($v['wxname'],0,15);
            $goods_price = $v['goods_price'];
            $goods_describe = $v['goods_describe'];
            $paytime = date('Y-m-d H:i:s',$v['paytime']);
            $str .= "<tr style=\"font-size: 12px;\">
                        <td height=\"40\" align=\"center\" style=\"color:#515455; border-bottom:1px #efefef solid;\"><span style=\"font-size: 12px;\">$wxname</span></td>
                        <td height = \"40\" align=\"center\" style=\"font-size:14px; color:#515455; border-bottom:1px #efefef solid;\">$goods_price</td>
                        <td height=\"40\" align=\"center\" style=\"font-size:14px; color:#515455; border-bottom:1px #efefef solid;\">$goods_describe</td>
                        <td height=\"40\" align=\"center\" style=\"font-size:12px; color:#515455; border-bottom:1px #efefef solid;\">$paytime</td>
                    </tr >";
        }

        echo $str;

    }

    //桶装水
    public function water_tong() {
//        pigcms_meal_coupon_redeem
        $field = array(
            'mcr.id',
            'mcr.address',
            'mcr.fulfill_uid',
            'mcr.status',
            'mcr.redeem_num',
            'u.nickname',
            'ms.store_id',
        );
        $openid = $_SESSION['openid'];
//        $uid = $_SESSION['user']['uid'];
        $info = D('admin')->where(array('openid'=>$openid))->find();
        //判断访客是否为送水工
//        role_id : 64
//        $role_id = $info['role_id'];
//        $info_status = 0;
//        if ($role_id == 64) {
//            $info_status = 1;
//        }
        $info_status = 1;
        $village_id = $info['village_id'];
        $map['mer.village_id'] = array('eq',$village_id);
        $search = empty($_GET['search'])?'':$_GET['search'];
        if (!empty($search)) {
            $map['mcr.address|u.nickname|mcr.redeem_num'] = array("like","%{$search}%");
        }
        $list = D('meal_coupon_redeem')->alias('mcr')
            ->field($field)
            ->join('left join __USER__ u on u.uid=mcr.buyer_uid')
            ->join('left join __MEAL__ m on m.meal_id=mcr.meal_id')
            ->join('left join __MERCHANT_STORE__ ms on ms.store_id=m.store_id')
            ->join('left join __MERCHANT__ mer on mer.mer_id=ms.mer_id')
            ->where($map)
            ->limit(15)
            ->select();
        $list_num = D('meal_coupon_redeem')->alias('mcr')
            ->field('count(*) as num')
            ->join('left join __USER__ u on u.uid=mcr.buyer_uid')
            ->join('left join __MEAL__ m on m.meal_id=mcr.meal_id')
            ->join('left join __MERCHANT_STORE__ ms on ms.store_id=m.store_id')
            ->join('left join __MERCHANT__ mer on mer.mer_id=ms.mer_id')
            ->where($map)
            ->count();
//        echo M()->_sql();
        if(!empty($search)) $this->assign('searchV',$search);
        $this->assign('info_status',$info_status);
        $this->assign('list',$list);
        $this->assign('count',$list_num);
        $this->assign('time',$_GET['ym']);
        $this->assign('begin_time',date('Y-m-d',$_GET['ym']));
        $this->display();
    }

    //桶装水下拉刷新
    public function water_tong_ajax() {
        $field = array(
            'mcr.id',
            'mcr.address',
            'mcr.fulfill_uid',
            'mcr.status',
            'mcr.redeem_num',
            'u.nickname',
            'ms.store_id',
        );
        $more = $_GET['more'];
        $openid = $_SESSION['openid'];
        $info = D('admin')->where(array('openid'=>$openid))->find();
        //判断访客是否为送水工
//        role_id : 64
//        $role_id = $info['role_id'];
//        $info_status = 0;
//        if ($role_id == 64) {
//            $info_status = 1;
//        }
        $info_status = 1;
        $village_id = $info['village_id'];
        $map['mer.village_id'] = array('eq',$village_id);
        $search = empty($_GET['search'])?'':$_GET['search'];
        if (!empty($search)) {
            $map['mcr.address|u.nickname|mcr.redeem_num'] = array("like","%{$search}%");
        }
        $list = D('meal_coupon_redeem')->alias('mcr')
            ->field($field)
            ->join('left join __USER__ u on u.uid=mcr.buyer_uid')
            ->join('left join __MEAL__ m on m.meal_id=mcr.meal_id')
            ->join('left join __MERCHANT_STORE__ ms on ms.store_id=m.store_id')
            ->join('left join __MERCHANT__ mer on mer.mer_id=ms.mer_id')
            ->where($map)
            ->limit($more,15)
            ->select();
//        dump($list);exit;
        $str = "";
        foreach ($list as $v) {
            $nickname = $v['nickname'];
            $address = substr($v['address'],0,30);
            $redeem_num = $v['redeem_num'];
            $status = $v['status'];
            $id = $v['id'];
            $str .= "<tr style=\"font-size: 12px;\"><td height=\"40\" align=\"center\" style=\"color:#515455; border-bottom:1px #efefef solid;\">$nickname</td>
                        <td height=\"40\" align=\"center\" style=\"font-size:14px; color:#515455; border-bottom:1px #efefef solid;\"><span style=\"font-size: 12px;\">$address</span></td>
                        <td height=\"40\" align=\"center\" style=\"font-size:14px; color:#515455; border-bottom:1px #efefef solid;\">$redeem_num</td>";
            $str .= "<td height=\"40\" align=\"center\" style=\"font-size:14px; color:#515455; border-bottom:1px #efefef solid;\">";
            if ($info_status == 0) {
                if ($status == 0) {
                    $str .= "<span style=\"color: #cc463d;\">未审核</span>";
                } elseif ($status == 1) {
                    $str .= "<span style=\"color: #0b94ea;\">送水中</span>";
                } elseif ($status == 100) {
                    $str .= "<span style=\"color: #0ccfa3;\">已完成</span>";
                }
            } else {
                if ($status == 0) {
                    $str .= "<span onclick=\"shenhe(this, $id)\" style=\"color: #cc463d;\">点击审核</span>";
                } elseif ($status == 1) {
                    $str .= "<span onclick=\"wancheng(this,$id)\" style=\"color: #0b94ea;\">点击核销</span>";
                } elseif ($status == 100) {
                    $str .= "<span style=\"color: #0ccfa3;\">已完成</span>";
                }
            }
            $str .= "</td></tr>";

        }

        echo $str;

    }

    //桶装水核销
    public function water_tong_hexiao_ajax() {
        $openid = $_SESSION['openid'];
        $info = D('admin')->where(array('openid'=>$openid))->find();
        $realname = $info['realname'];
        $id = I('get.id');
        $re = D('meal_coupon_redeem')
            ->where(array('id'=>$id))
            ->save(array('status'=>100,'cancel_name'=>$realname));
//        echo M()->_sql();
        if ($re) {
            echo 1;
        } else {
            echo false;
        }
    }

    //桶装水审核
    public function water_tong_shenhe_ajax() {
        $openid = $_SESSION['openid'];
        $info = D('admin')->where(array('openid'=>$openid))->find();
        $realname = $info['realname'];
        $id = I('get.id');
        $re = D('meal_coupon_redeem')
            ->where(array('id'=>$id))
            ->save(array('status'=>1,'examine_name'=>$realname));
        if ($re) {
            echo 1;
        } else {
            echo false;
        }
    }

    //智能门禁
    public function userCheck_index_news() {
        //筛选社区
        if ($_GET['village_id']) {
            $village_id =  $_GET['village_id'];
        } else {
            $openid = $_SESSION['openid'];
            $village_id = D('admin')->where(array('openid'=>$openid))->find()['village_id'];
        }
        $field = array(
            'hvub.pigcms_id',
            'hvub.village_id',
            'hvub.name',
            'hvub.card_type',
            'hvub.ac_status',
            'u.nickname',
            'v.village_name',
            'c.company_name',
        );
        $map['hvub.village_id'] = array('eq',$village_id);
        $map['hvub.ac_status'] = array('neq','');
        $search = empty($_GET['search'])?'':$_GET['search'];
        if (!empty($search)) {
            $map['hvub.name|c.company_name'] = array("like","%{$search}%");
        }
//        $map['hvub.usernum'] = array('neq','');
        $list = D('House_village_user_bind')->alias('hvub')
            ->field($field)
            ->join("left join __USER__ u on hvub.uid = u.uid")
            ->join('left join __HOUSE_VILLAGE__ v on v.village_id=hvub.village_id')
            ->join("left join __COMPANY__ c on c.company_id = hvub.company_id")
            ->where($map)
            ->order('hvub.add_time desc')
            ->limit(15)
            ->select();
        $list_num = D('House_village_user_bind')->alias('hvub')
            ->field('count(*) as num')
            ->join("left join __USER__ u on hvub.uid = u.uid")
            ->join('left join __HOUSE_VILLAGE__ v on v.village_id=hvub.village_id')
            ->join("left join __COMPANY__ c on c.company_id = hvub.company_id")
            ->where($map)
            ->order('hvub.add_time desc')
            ->count();
        if(!empty($search)) $this->assign('searchV',$search);
        $this->assign('list',$list);
        $this->assign('count',$list_num);
        $this->assign('time',$_GET['ym']);
        $this->assign('village_id',$village_id);
        $this->assign('begin_time',date('Y-m-d',$_GET['ym']));
        $this->display();

    }

    //智能门禁下拉刷新
    public function userCheck_index_news_ajax() {
        //筛选社区
        if ($_GET['village_id']) {
            $village_id =  $_GET['village_id'];
        } else {
            $openid = $_SESSION['openid'];
            $village_id = D('admin')->where(array('openid'=>$openid))->find()['village_id'];
        }

        $more = $_GET['more'];
        $field = array(
            'hvub.pigcms_id',
            'hvub.village_id',
            'hvub.name',
            'hvub.card_type',
            'hvub.ac_status',
            'u.nickname',
            'v.village_name',
            'c.company_name',
        );
        $map['hvub.village_id'] = array('eq',$village_id);
        $map['hvub.ac_status'] = array('neq','');
        $search = empty($_GET['search'])?'':$_GET['search'];
        if (!empty($search)) {
            $map['hvub.name|c.company_name'] = array("like","%{$search}%");
        }
        $list = D('House_village_user_bind')->alias('hvub')
            ->field($field)
            ->join("left join __USER__ u on hvub.uid = u.uid")
            ->join('left join __HOUSE_VILLAGE__ v on v.village_id=hvub.village_id')
            ->join("left join __COMPANY__ c on c.company_id = hvub.company_id")
            ->where($map)
            ->order('hvub.add_time desc')
            ->limit($more,15)
            ->select();
        $str = '';
        foreach ($list as $v) {
            $id = $v['pigcms_id'];
            $name = $v['name']?:'未知';
            $company_name = substr($v['company_name'],0,30)?:'未知';
            $card_type = $v['card_type'];
            $ac_status = $v['ac_status'];
            $str .= "<tr style=\"font-size: 12px;\" onclick=\"aaa($id)\">
                        <td height=\"40\" align=\"center\" style=\"color:#515455; border-bottom:1px #efefef solid;\">$name</td>
                        <td height=\"40\" align=\"center\" style=\"font-size:14px; color:#515455; border-bottom:1px #efefef solid;\"><span style=\"font-size: 12px;\">$company_name</span></td>
                        <td height=\"40\" align=\"center\" style=\"font-size:14px; color:#515455; border-bottom:1px #efefef solid;\">";
            if ($card_type == 1) {
                $str .= "现场审核";
            } elseif ($card_type == 2) {
                $str .= "门禁卡";
            } elseif ($card_type == 3) {
                $str .= "身份证";
            } elseif ($card_type == 4) {
                $str .= "工牌";
            }
            $str .= "</td><td height=\"40\" align=\"center\" style=\"font-size:14px; color:#515455; border-bottom:1px #efefef solid;\">";

            if ($ac_status == 1) {
                $str .= "<span style=\"color: #cc463d;\">审核中</span>";
            } elseif ($ac_status == 2 || $ac_status == 4) {
                $str .= "<span style=\"color: #0dcecb;\">通过</span>";
            } elseif ($ac_status == 3) {
                $str .= "<span style=\"color: #cc463d;\">不通过</span>";
            }
            $str .= "</td></tr>";
        }

        echo $str;
    }

    //用户认证页
    public function userCheck_detail() {
        $village_id = I('get.village_id');
        if (IS_POST){
            $openid = $_SESSION['openid'];
            $check_name = D('admin')->where(array('openid'=>$openid))->find()['realname'];
            $id = I('post.pigcms_id');
            $ym = I('post.ym');
            $data = array();
            $data['department'] = I('post.department');
            $data['ac_status'] = I('post.ac_status');
            $data['check_name'] = $check_name;
            $re = D('house_village_user_bind')->where(array('pigcms_id'=>$id))->save($data);
            if ($re) {
                $this->success('审核成功',U('userCheck_detail',array('id'=>$id,'ym'=>$ym,'village_id'=>$village_id)));
            } else {
                $this->error('审核失败',U('userCheck_detail',array('id'=>$id,'ym'=>$ym,'village_id'=>$village_id)));
            }
//            dump($_POST);
        } else {
            $field = array(
                'hvub.pigcms_id',
                'hvub.village_id',
                'hvub.name',
                'hvub.card_type',
                'hvub.ac_status',
                'hvub.usernum',
                'hvub.workcard_img',
                'hvub.department',
                'hvub.check_name',
                'u.nickname',
                'v.village_name',
                'c.company_name',
            );
            $id = I('get.id');
            $list = D('House_village_user_bind')->alias('hvub')
                ->field($field)
                ->join("left join __USER__ u on hvub.uid = u.uid")
                ->join('left join __HOUSE_VILLAGE__ v on v.village_id=hvub.village_id')
                ->join("left join __COMPANY__ c on c.company_id = hvub.company_id")
                ->where(array('pigcms_id'=>$id))->find();
//            dump($list);exit;
            $this->assign('list',$list);
            $this->assign('ym',$_GET['ym']);
            $this->assign('village_id',$village_id);
            $this->display();
        }

    }

    /*
     * 开卡流程显示（手机端后台管理）
     * */
    public function admin_show_list_all(){
//        $uid = $_SESSION['user_id'];
        $openid = $_SESSION['openid'];
        //判断社区
        $village_id = D('admin')->where(array('openid'=>$openid))->find()['village_id'];
        //判断停车场
        $garage_id = M('house_village')->where(array('village_id'=>$village_id))->find()['garage_id'];
        //拉取所有的新用户开卡信息
          //客服显示页
        $all_info_array = $this->get_all_show_list();
        $nopass_array = $this->make_magic_sql(1);
        $pass_array = $this->make_magic_sql(2);


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
        $this->assign('garage_id',$garage_id);
        $this->display();
    }


    /*
     * 显示全部的客服列表页
     * */
    public function get_all_show_list(){
        $is_yueka_array = M('check_record','smart_')->select();
        $check_array =array();
        foreach ($is_yueka_array as $key=>$value) {
            if ($value['check_type'] == 0) {
                //为月卡审核
                $check_array[] = M('check_record','smart_')
                    ->alias('c')
                    ->join('JOIN smart_yueka_payrecord y on c.yukepay_id=y.pay_id LEFT JOIN smart_user u on c.check_user=u.user_t_name')
                    ->where(array('c.check_id' => $value['check_id']))
                    ->field('c.*,y.car_no,y.how_long,y.pay_time,u.user_id')
                    ->order('c.check_request_time asc')
                    ->find();

            } else if ($value['check_type'] == 2) {
                //为发票审核
                $map = array();
                $map['b.is_del']  = array('eq','0');
//                $map['p.is_del']  = array('eq','0');
                $map['c.check_id'] = array('eq',$value['check_id']);
                $map['b.bill_id'] = array('eq',$value['bill_id']);
                $field = array(
                    'b.bill_id',
                    'b.create_time',    //账单创建时间
                    'b.bill_status',    //账单状态
                    'c.check_title',
                    'c.check_user',
                    'c.check_request_time',
                    'c.check_state',
                    'c.check_type',
                    'b.user_id',
//            'p.pay_loan',       //支付金额
//            's.garage_id',      //停车场编号
//            's.waiter',         //服务员编号
//            's.out_no ',        //出口门号
//             's.car_no',         //车牌号码
//            'car_imgs',
                    'group_concat(s.car_no)'=>'car_nos',         //车牌号码总汇
                    'sum(p.pay_loan)'=>'total_pay_loan'
                );
                $list = M('check_record','smart_')->alias('c')
                    ->field($field)
                    ->join('left join smart_bill b on b.bill_id = c.bill_id')
                    ->join('left join smart_payrecord p on p.bill_id = b.bill_id')
                    ->join('left join smart_servicerecord s on s.serv_id = p.serv_id')
                    ->where($map)
                    ->group('b.bill_id')
                    ->order('c.check_request_time desc')
                    ->find();
//                echo M()->_sql();exit();
                $check_array[] =  $list;
            } else if ($value['check_type'] == 1) {
                //为月卡延期
                $check_array[] = M('check_record','smart_')
                    ->alias('c')
                    ->join('JOIN smart_yueka_payrecord y on c.yukepay_id=y.pay_id LEFT JOIN smart_user u on c.check_user=u.user_t_name')
                    ->where(array('c.check_id' => $value['check_id']))
                    ->field('c.*,y.car_no,y.how_long,y.pay_time,u.user_id')
                    ->order('c.check_request_time asc')
                    ->find();
            }
        }

        return $check_array;
    }


    /*
     * 魔术方法：制作一个列表中能显示两个不同链接表的数组
     * type=1时显示没有处理完毕的所有项
     * type=2时显示已经处理完毕的所有项
     * @author 祝君伟
     * @time 2017.2.28
     * */
    public function make_magic_sql($type=1){
        $is_yueka_array = M('check_record','smart_')->select();
        $check_array =array();
        foreach ($is_yueka_array as $key=>$value){
            if($value['check_type']==0&&$type==1&&$value['check_state']==0){
                //为月卡审核
                $check_array[] = M('check_record','smart_')
                    ->alias('c')
                    ->join('JOIN smart_yueka_payrecord y on c.yukepay_id=y.pay_id LEFT JOIN smart_user u on c.check_user=u.user_t_name')
                    ->where(array('c.check_id'=>$value['check_id']))
                    ->field('c.*,y.car_no,y.how_long,y.pay_time,u.user_id')
                    ->order('c.check_request_time desc')
                    ->find();

            }else if($value['check_type']==2&&$type==1&&($value['check_state']==0||$value['check_state']==2||$value['check_state']==3)){
                //为发票审核
                $map = array();
                $map['b.is_del']  = array('eq','0');
//                $map['p.is_del']  = array('eq','0');
                $map['c.check_id'] = array('eq',$value['check_id']);
                $field = array(
                    'b.bill_id',
                    'b.create_time',    //账单创建时间
                    'b.bill_status',    //账单状态
                    'c.check_title',
                    'c.check_user',
                    'c.check_request_time',
                    'c.check_state',
                    'c.check_type',
                    'b.user_id',
//            'p.pay_loan',       //支付金额
//            's.garage_id',      //停车场编号
//            's.waiter',         //服务员编号
//            's.out_no ',        //出口门号
//             's.car_no',         //车牌号码
//            'car_imgs',
                    'group_concat(s.car_no)'=>'car_nos',         //车牌号码总汇
                    'sum(p.pay_loan)'=>'total_pay_loan'
                );
                $list = M('check_record','smart_')->alias('c')
                    ->field($field)
                    ->join('left join smart_bill b on b.bill_id = c.bill_id')
                    ->join('left join smart_payrecord p on p.bill_id = b.bill_id')
                    ->join('left join smart_servicerecord s on s.serv_id = p.serv_id')
                    ->where($map)
                    ->group('b.bill_id')
                    ->order('c.check_request_time desc')
                    ->find();
                $check_array[] =  $list;
            }else if($value['check_type']==0&&$type==2&&$value['check_state']==1){
                //为月卡审核
                $check_array[] = M('check_record','smart_')
                    ->alias('c')
                    ->join('JOIN smart_yueka_payrecord y on c.yukepay_id=y.pay_id LEFT JOIN smart_user u on c.check_user=u.user_t_name')
                    ->where(array('c.check_id'=>$value['check_id']))
                    ->field('c.*,y.car_no,y.how_long,y.pay_time,u.user_id')
                    ->order('c.check_request_time desc')
                    ->find();
            }else if($value['check_type']==2&&$type==2&&$value['check_state']==1){
                //为发票审核
                $map = array();
                $map['b.is_del']  = array('eq','0');
//                $map['p.is_del']  = array('eq','0');
                $map['c.check_id'] = array('eq',$value['check_id']);
                $field = array(
                    'b.bill_id',
                    'b.create_time',    //账单创建时间
                    'b.bill_status',    //账单状态
                    'c.check_title',
                    'c.check_user',
                    'c.check_request_time',
                    'c.check_state',
                    'c.check_type',
                    'b.user_id',
//            'p.pay_loan',       //支付金额
//            's.garage_id',      //停车场编号
//            's.waiter',         //服务员编号
//            's.out_no ',        //出口门号
//             's.car_no',         //车牌号码
//            'car_imgs',
                    'group_concat(s.car_no)'=>'car_nos',         //车牌号码总汇
                    'sum(p.pay_loan)'=>'total_pay_loan'
                );
                $list = M('check_record','smart_')->alias('c')
                    ->field($field)
                    ->join('left join smart_bill b on b.bill_id = c.bill_id')
                    ->join('left join smart_payrecord p on p.bill_id = b.bill_id')
                    ->join('left join smart_servicerecord s on s.serv_id = p.serv_id')
                    ->where($map)
                    ->group('b.bill_id')
                    ->order('c.check_request_time desc')
                    ->find();
                $check_array[] =  $list;
            } else if($value['check_type']==1&&$type==2&&$value['check_state']==1) {
                //为月卡延期
                $check_array[] = M('check_record','smart_')
                    ->alias('c')
                    ->join('JOIN smart_yueka_payrecord y on c.yukepay_id=y.pay_id LEFT JOIN smart_user u on c.check_user=u.user_t_name')
                    ->where(array('c.check_id'=>$value['check_id']))
                    ->field('c.*,y.car_no,y.how_long,y.pay_time,u.user_id')
                    ->order('c.check_request_time desc')
                    ->find();
            }
        }

        return $check_array;
    }

    //管理员审核申请，准备工作
    public function audit(){
        $bill_id = I('get.bill_id');
        $bill_status = I('get.bill_status');
        if($bill_status==2) $this->error("该发票已核销！");
        $new_bill_status = $this->audit_up($bill_id,$bill_status);
        if($new_bill_status){
            //逻辑层
            $logic =  Logic('wap');
            $res = $logic->send_msg_to_user($bill_id);
            if ($res[0]['errcode'] == 0) {
                M('check_record','smart_')->where(array('bill_id'=>$bill_id))->save(array('check_state'=>1));
                $this->success("操作成功",U('PropertyService/admin_show_list_all'));
            }
        }else{
            $this->error("操作失败");
        }

    }

    //管理员审核修改发票状态
    public function audit_up($bill_id,$bill_status){
        $save = array();
        $openid = $_SESSION['openid'];
        $user_id = M('user','smart_')->where(array('user_wx_opid'=>$openid))->find()['user_id'];
        switch($bill_status){
            case 0:
                $save = array(
                    'audit_id1'=>$user_id,
                    'audit_id2'=>0,
                    'bill_status'=>1
                );
                break;
            case 1:
                $save = array(
                    'audit_id2'=>$user_id,
                    'bill_status'=>2
                );
        }

        if($save){
            $re = M('bill','smart_')->where(array('bill_id'=>$bill_id))->save($save);
            if($re!==false){
                return $save['bill_status'];
            }
        }

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

    /*
    * 客服人员审核页面
    * */
    public function service_ask(){
        $openid = $_SESSION['openid'];
        //判断社区
        $village_id = D('admin')->where(array('openid'=>$openid))->find()['village_id'];
        //判断停车场
        $garage_id = M('house_village')->where(array('village_id'=>$village_id))->find()['garage_id'];
        $pay_id=I('get.pay_id');
        $car_no=I('get.car_no');
//        $garage_id = session('garage_id');
        $state=I('get.state');

        if($state==1){
            $car_no = $this->jieshu_plate($car_no);
        }
//        dump(1);exit();
        $user_info = $this->select_user_info($pay_id,$car_no);
        $user_info[0]['garage_id'] = $garage_id;
        //dump($user_info);exit;
        //根据当前session来拉去当前的客服user_id
        $admin_info = $this->get_admin_info(array('user_wx_opid'=>$_SESSION['openid']));

//        dump($user_info);exit;
        $this->assign('admin_info',$admin_info);
        $this->assign('user_info',$user_info[0]);
        $this->display();
    }

    /*
    * 制做审核页面的数组信息
    * */
    public function select_user_info($pay_id,$car_no){
        //获取openid
        $map = array();
        $map['y.pay_id'] = array('eq',$pay_id);
        $map['y.car_no'] = array('eq',$car_no);
        $field = array(
            'u.user_id',
            'u.user_t_name',
            'u.user_phone',
            'u.user_wx_opid',
            'y.car_no',
            'y.how_long',
            'y.pay_type',

        );
        $info = M('yueka_payrecord','smart_')
            ->alias('y')
            ->field($field)
            ->where($map)
            ->join('left join smart_user u on u.user_id = y.user_id')
            ->find()?:array();
        //使用openid 关联查询用户数据
        if($info){
            $company_info = M('house_village_user_bind','pigcms_')
                ->alias('bind')
                ->join('left join pigcms_user u on u.uid = bind.uid')
                ->join('left join pigcms_company c on c.company_id = bind.company_id')
                ->field(array(
                    'pigcms_id'=>'user_bind_id',
                    'c.company_name'=>'user_commpany',
                    'bind.card_type',
                    'bind.id_card'=>'card_number',
                ))
                ->where('u.openid="%s"',$info['user_wx_opid'])
                ->find();

        }

        $company_info = $company_info?:array();




        $res =array( //因为原来的代码 是使用原生sql 查询的 返回结果是个二维长度为一 的数组，为了不影响其他代码我就这么写了
            array_merge($company_info,$info)
        );

        return $res;

    }

    /*
     * 制作自动发送微信信息的必要openid数组
     * 没有过滤无效的uid，上线没有无效uid，暂不考虑
     * 加入指定组配置
     * */
    public function make_admin_info(){
        $push_group = M('config','smart_')->where(array('name'=>'push_group'))->find();
        $admin_array = M('admin','smart_')->where(array('role_id'=>$push_group['value'],'is_check'=>'1'))->select();
        //分出两种情况
        //1.多组数据的
        $result_array =array();
        $admin_uid_string='';
        $admin_openid_array=array();
        if(isset($admin_array[1])){
            foreach ($admin_array as $k=>$v){
                $admin_uid_string=$v['ad_uid'];
            }
            $result_array=explode(",",$admin_uid_string);
        }else{
            //2.一组数据的
            $admin_uid_string=$admin_array[0]['ad_uid'];
            $result_array=explode(",",$admin_uid_string);
        }
        foreach ($result_array as $vo){
            $user_info =M('user')->where(array('user_id'=>$vo))->find();
            $admin_openid_array[]=$user_info['user_wx_opid'];
        }
        return $admin_openid_array;
    }

    /*
     * 拉取后台管理的信息
     * 完全通用版
     * ags array 查询条件 数组形式
     * */
    public function get_admin_info($where_array){
        $admin_user_info =M('user','smart_')->where($where_array)->find();
        return $admin_user_info;
    }

    /*
     * 判断当前的审核信息有没有人已经审核完毕
     * */
    public function is_have_admin_check(){
        $check_id = I('post.check_id');
        $is_have = M('check_record','smart_')->where(array('check_id'=>$check_id))->find();
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
        $result_code = M('car','smart_')->where(array('car_no'=>$car_no,'garage_id'=>$garage_id))->data(array('car_role'=>'1','start_time'=>$start_time,'end_time'=>$end_time))->save();
        $check_code = M('check_record','smart_')->where(array('check_id'=>$check_id))->data(array('admin_id'=>$admin_id,'check_process_time'=>$start_time,'check_state'=>1))->save();
        if($result_code&&$check_code){
            //开卡成功，推送给用户成功信息
            $person_info =array(
                'url'=>C("WEB_DOMAIN").'/Car/index.php?m=Home&c=Car&a=use_service',
                'first_value'=>'新用户开卡情况提醒',
                'keyword1_value'=>'新用户开卡成功！',
                'keyword2_value'=>'已经成功为车牌号为'.$car_no.'的车开通月卡！',
                'keyword3_value'=>'有任何问题请致电技术人员解决 TEL:027-87779655'
            );
            $user_openid_array = M('user','smart_')->where(array('user_id'=>$user_id))->find();
            $admin_user = array(
                '0'=>$user_openid_array['user_wx_opid']
            );
            $dose_not_send=$this->auto_send_message($admin_user,$person_info);
//            dump($dose_not_send);exit;
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
                'template_id'=>$tempid?:$this->get_wxmsg_tpl(20),
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
            import("@.ORG.haiya.Weixinpay");
            $weixin= new Weixinpay();
            $res[] = $weixin->send_template_message(urldecode(json_encode($data)));
        }
        return $res;
    }

    //发票详情页
    public function service_ask_two() {
        $bill_id = I('get.bill_id');
        $bill_status = I('get.bill_status');
        $logic =  Logic('wap');
        $user_info = $logic->get_bill_list(0,$bill_id)[$bill_id];
//        dump($user_info);exit;
        $this->assign('user_info',$user_info);
        $this->assign('list',$user_info['pay_list']);
        $this->assign('bill_id',$bill_id);
        $this->assign('bill_status',$bill_status);
        $this->display();
    }

    /**
     * 获取微信模板id信息
     * @param $id
     * @return mixed
     */
    public function get_wxmsg_tpl($id,$col="tempid"){
        $tpl =  M('tempmsg','pigcms_')->where('id=%d',$id)->getField($col);
        return $tpl;
    }

    //手机端收发快递
    public function express_delivery() {
        //筛选社区
        if ($_GET['village_id']) {
            $village_id =  $_GET['village_id'];
        } else {
            $openid = $_SESSION['openid'];
            $village_id = D('admin')->where(array('openid'=>$openid))->find()['village_id'];
        }
        $search = empty($_GET['search'])?'':$_GET['search'];

        $model = new PackageModel();

        $company_list = $model->getAllCompany_list();

        $list = $model->getPackage_list_two(false,$search);

        $list_little = $model->getPackage_list_little(false,$search);

        $outList = $model->getPackage_list_little(1,$search);

        $list_num = $model->getPackage_list_num(false,$search);

        if(!empty($search)) $this->assign('searchV',$search);
        $this->assign('list',$list);
        $this->assign('list_little',$list_little);
        $this->assign('out_list',$outList);
        $this->assign('company_list',$company_list);
        $this->assign('count',$list_num);
        $this->assign('begin_time',date('Y-m-d',$_GET['ym']));
        $this->assign('time',$_GET['ym']);
        $this->assign('village_id',$village_id);
//        $cid = I('get.cid')?I('get.cid'):1;
//        $company_name = M('expressage_company')->find($cid)['company_name'];
//        $userList = $model->getUser_list();
//        dump($list);exit;
//        $this->assign('userList',$userList);
//        $this->assign('company_name',$company_name);

        $this->display();
    }

    //手机端收发快递下拉刷新
    public function express_delivery_ajax() {
        $search = empty($_GET['search'])?'':$_GET['search'];

        $model = new PackageModel();
        $more = isset($_GET['more'])?$_GET['more']:0;
        $list = $model->getPackage_list_two(false,$search,$more);
        $str = '';
        foreach ($list as $v) {
            $id = $v['id'];
            $waybill_number = $v['waybill_number'];
            $name = $v['name'];
            $receipt_code = $v['receipt_code'];
            $status = $v['status'];
            $str .= "<tr style=\"font-size: 12px;\" >
                                    <td height=\"40\" align=\"center\" style=\"color:#515455; border-bottom:1px #efefef solid;\" onclick=\"aaa($id)\">$waybill_number</td>
                                    <td height=\"40\" align=\"center\" style=\"font-size:14px; color:#515455; border-bottom:1px #efefef solid;\" onclick=\"aaa($id)\"><span style=\"font-size: 12px;\">$name</span></td>
                                    <td height=\"40\" align=\"center\" style=\"font-size:14px; color:#515455; border-bottom:1px #efefef solid;\" onclick=\"aaa($id)\">$receipt_code</td>
                                    <td height=\"40\" align=\"center\" style=\"font-size:14px; color:#515455; border-bottom:1px #efefef solid;\">";
            if ($status == 0) {
                $str .= "<span style=\"color: #0e62cd;\">已到站</span>";
            } elseif ($status == 1) {
                $str .= "<span style=\"color: #0ccfa3;\">已提货</span>";
            } elseif ($status == 2) {
                $str .= "<span style=\"color: #cc463d;\">顾客拒收</span>";
            } elseif ($status == 3) {
                $str .= "<span style=\"color: #cc463d;\">站点拒签</span>";
            } elseif ($status == 4) {
                $str .= "<span style=\"color: #cc463d;\">已退件</span>";
            }
            $str .= "</td></tr>";
        }
        echo $str;

    }

    //手机端收发快递详情页
    public function express_delivery_detail() {
        //筛选社区
        if ($_GET['village_id']) {
            $village_id =  $_GET['village_id'];
        } else {
            $openid = $_SESSION['openid'];
            $village_id = D('admin')->where(array('openid'=>$openid))->find()['village_id'];
        }
        if (IS_POST) {
            $openid = session('openid');
            $admin_id = D('admin')->where(array('openid'=>$openid))->find()['id'];
            $id = I('post.id');
            $status = I('post.status');
            $time = time();
            if ($status == 1) {
                $re = D('package')->where(array('id'=>$id))->save(array('status'=>$status,'admin_id'=>$admin_id,'out_package_time'=>$time));
            } else {
                $re = D('package')->where(array('id'=>$id))->save(array('status'=>$status,'admin_id'=>$admin_id));
            }
            if ($re) {
                $this->success('更新成功',U('express_delivery_detail',array('id'=>$id,'village_id'=>$village_id)));
            } else {
                $this->error('更新失败',U('express_delivery_detail',array('id'=>$id,'village_id'=>$village_id)));
            }

        } else {
            $id = I('get.id');
            $model=new PackageModel();
            //使用新的快递信息获取方法 by zhukeqin
            $list=$model->getPackage_list_search(array('id'=>$id))[0];
            /*$field = array(
                'p.*',
                'c.company_name',
                'u.name',
                'u.phone',
                'a.realname'
            );
            $list = M('package')
                ->alias('p')
                ->field($field)
                ->join('LEFT JOIN __EXPRESSAGE_COMPANY__ c on c.company_id=p.cid')
                ->join('LEFT JOIN __EXPRESSAGE_USER__ u on u.pigcms_id=p.aid')
                ->join('LEFT JOIN __ADMIN__ a on a.id=p.admin_id')
                ->where(array('p.id'=>$id))
                ->find();*/
            $this->assign('time',$_GET['ym']);
            $this->assign('list',$list);
            $this->assign('village_id',$village_id);
            $this->display();
        }

    }

    /**
     * ajax 的包裹入库
     */
    public function ajax_in_database()
    {
        $phone = I('post.phone');

        $name = I('post.name');

        $waybill_number = I('post.waybill_number');

        $model = new PackageModel();

        //var_dump($_POST);exit;

        $cid = I('post.cid');

        if($cid==0||empty($cid)) $this->err('快递公司不能为空');

        if(!$waybill_number) $this->err('运单号不能为空');

        if(!$phone) $this->err('手机不能为空');

        $check_status = $model->waybillNumber_check($waybill_number,$cid);

        if($check_status == 2)
        {
            $this->err('运单号必须为数字');
        }
        elseif ($check_status == 3)
        {
            $this->err('运单号有误');
        }
        else
        {
            /**
             * 拼接取货码
             * 第一位 ： 快递公司编号
             *         -
             * 第二位 ： 暂时固定值  =  1
             *         -
             * 后四位 ： 订单编号后四位
             *
             * exp ：  5-1-6359
             */

            $receipt_code = $cid.'-1-'.substr($waybill_number,-4);

            $is_in_data = M('package')->getByWaybill_number($waybill_number);

            //vd($is_in_data);exit;

            if($is_in_data['status'] === '0')
            {
                $this->err('该货物已经入库');
            }
            else if($is_in_data['status'] == 1)
            {
                $this->err('该货物已经出库');
            }
            else if($is_in_data['status'] == 2)
            {
                $this->err('该货物顾客拒收');
            }
            else if($is_in_data['status'] == 3)
            {
                $this->err('该货物站点拒签');
            }
            else if($is_in_data['status'] == 4)
            {
                $this->err('该货物已退件');
            }
            else if($is_in_data === null)
            {

                $is_user_in_data = M('expressage_user')->getByPhone($phone);

                if(!$is_user_in_data)
                {
                    $userDate = array(
                        'name'     =>  $name?:'匿名人员',
                        'phone'    =>  $phone
                    );

                    $userRes = M('expressage_user')->data($userDate)->add();
                }
                else
                {
                    if($is_user_in_data['status'] == 1)
                    {
                        $this->err('该人员是黑名单人员，不收取其快件');
                    }
                    else
                    {
                        $userRes = $is_user_in_data['pigcms_id'];

                        M('expressage_user')->where(array('pigcms_id'=>$userRes))->setInc('active_value',1);
                    }


                }


                if($userRes)
                {
                    $openid = session('openid');
                    $admin_id = D('admin')->where(array('openid'=>$openid))->find()['id'];
                    if ($admin_id) {
                        $packageDate = array(
                            'waybill_number'   =>  $waybill_number,
                            'cid'              =>  $cid,
                            'aid'              =>  $userRes,
                            'in_package_time'  =>  time(),
                            'receipt_code'     =>  $receipt_code,
                            'admin_id'         =>  $admin_id
                        );

                        $packageRes =  M('package')->data($packageDate)->add();
                        if($packageRes)
                        {
                            //发送短信

                            $smsRes = $this->intelligence_choose_send_type($packageRes);
                            $packageInfo = $model->getPackageInfo($packageRes);

                            $data = "";
                            $id = $packageInfo['id'];
                            $waybill_number = $packageInfo['waybill_number'];
                            $name = $packageInfo['name'];
                            $receipt_code = $packageInfo['receipt_code'];
//                            $status = $packageInfo['status'];
                            $data .= "<tr style=\"font-size: 12px;\" >
                                    <td height=\"40\" align=\"center\" style=\"color:#515455; border-bottom:1px #efefef solid;\" onclick=\"aaa($id)\">$waybill_number</td>
                                    <td height=\"40\" align=\"center\" style=\"font-size:14px; color:#515455; border-bottom:1px #efefef solid;\" onclick=\"aaa($id)\"><span style=\"font-size: 12px;\">$name</span></td>
                                    <td height=\"40\" align=\"center\" style=\"font-size:14px; color:#515455; border-bottom:1px #efefef solid;\" onclick=\"aaa($id)\">$receipt_code</td>
                                    <td height=\"40\" align=\"center\" style=\"font-size:14px; color:#515455; border-bottom:1px #efefef solid;\">";
                            $data .= "<span style=\"color: #0e62cd;\">已到站</span></td></tr>";

                            if($smsRes==1)
                            {
                                $this->suc('成功',$data);
                            } else {
                                $this->err('入库成功，消息发送失败,请重新短信提醒');
                            }


                        } else {
                            $this->err('添加数据库失败');
                        }
                    } else {
                        $this->err('您无法执行此项操作');
                    }


                }else{

                    $this->err('入库出错，请联系系统管理员');

                }

            }
        }
    }

    /**
     * ajax 包裹出库
     */
    public function ajax_out_database()
    {
        $code = I('post.code');
        $model = new PackageModel();
        $packageArr = D('package')->where(array('waybill_number'=>$code))->find();
        if (!empty($packageArr)) {
            $status = $packageArr['status'];
            $packageInfo = $model->getPackageInfo($packageArr['id']);
            if ($status == 0) {
                $out_package_time = time();
                $re = D('package')->where(array('waybill_number'=>$code))->save(array('status'=>1,'out_package_time'=>$out_package_time));
                $data = "";
                $id = $packageInfo['id'];
                $waybill_number = $packageInfo['waybill_number'];
                $name = $packageInfo['name'];
                $receipt_code = $packageInfo['receipt_code'];
//                            $status = $packageInfo['status'];
                $data .= "<tr style=\"font-size: 12px;\" >
                                    <td height=\"40\" align=\"center\" style=\"color:#515455; border-bottom:1px #efefef solid;\" onclick=\"aaa($id)\">$waybill_number</td>
                                    <td height=\"40\" align=\"center\" style=\"font-size:14px; color:#515455; border-bottom:1px #efefef solid;\" onclick=\"aaa($id)\"><span style=\"font-size: 12px;\">$name</span></td>
                                    <td height=\"40\" align=\"center\" style=\"font-size:14px; color:#515455; border-bottom:1px #efefef solid;\" onclick=\"aaa($id)\">$receipt_code</td>
                                    <td height=\"40\" align=\"center\" style=\"font-size:14px; color:#515455; border-bottom:1px #efefef solid;\">";
                $data .= "<span style=\"color: #0ccfa3;\">已提货</span></td></tr>";
                if ($re) {
                    $this->suc('成功更新',$data);
                } else {
                    $this->err('更新数据库失败');
                }
            } elseif ($status == 1) {
                $this->err('该货物已经出库了');
            } elseif ($status == 2) {
                $this->err('该顾客拒收');
            } elseif ($status == 3) {
                $this->err('该站点拒签');
            } elseif ($status == 4) {
                $this->err('该货物已退件');
            } else {
                $this->err('其他原因');
            }
        } else {
            $this->err('没有找到取货号');
        }

    }

    /**
     * 智能选择发送类型
     * @param $packageId
     * @return bool|int
     */
    protected function intelligence_choose_send_type($packageId)
    {
        $model = new PackageModel();

        $is_auto = $model->get_config()['express_is_intelligence_choose'];

        $packageInfo = $model->getPackageInfo($packageId);

        if($is_auto == 1)
        {
            if($packageInfo['openid']=='')
            {
                $res = $this->SmsCodeverify($packageInfo['phone'],$packageInfo['receipt_code']);
            }
            else if(preg_match("/^ohg/",$packageInfo['openid']))
            {
                $res = $this->send_template($packageId);
            }
            else
            {
                $res = $this->SmsCodeverify($packageInfo['phone'],$packageInfo['receipt_code']);
            }
        }
        else
        {
            $res = $this->SmsCodeverify($packageInfo['phone'],$packageInfo['receipt_code']);
        }

        return $res;
    }

    /* 发送手机验证码
    * @time 2018-01-12
    * @author	曾梦飞
    */
    protected function SmsCodeverify($phone,$vcode){
        $company_id = substr($vcode,0,1);
        $packagemodel=new PackageModel();
        $company_name=$packagemodel->getCompany_info($company_id)['company_name'];
        //$company_name = M('expressage_company')->find($company_id)['company_name'];
        //require(LIB_PATH.'ORG/sms/sms_aliyun/vendor/autoload.php');
        $model=new Sms_aliyunModel();
        $request=$model->sendSms_expressage($phone,$vcode,$company_name,'广发银行大厦立体车库1F');
        /*$content='货号'. $vcode . '您好，您的'.$company_name.'已经到达广发银行大厦立体车库1F快递收发室，请凭取货码取件。（取件时间：工作日上午8:30-11:30 下午2:00-17:30）请熟知，谢谢！';
        //$content='您的取件码是：'. $vcode . '。请凭该取件码到广发大厦立体车库一楼快递收发室取件，请您尽快取件,谢谢。';
        $post_data=array(			//短信发送所须参数
            'userid'=>'13296',
            'account'=>C('config.sms_uid'),
            'password'=>C('config.sms_pwd'),
            'content'=>$content,
            'mobile'=>$phone,
            'sendtime'=>date('Y-m-d H:i:s'), //此处不可以写成时间戳形式
            'action'=>'send'
        );
        $url='http://www.duanxin10086.com/sms.aspx';
        $o='';
        foreach ($post_data as $k=>$vs){
            $o.="$k=".$vs.'&';
        }
        $post_data=substr($o,0,-1);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //如果需要将结果直接返回到变量里，那加上这句。
        $str = curl_exec($ch);
        $xml=simplexml_load_string($str);*/
        $packagemodel=new PackageModel();
        $package_info=$packagemodel->getPackage_list_search(array('receipt_code'=>$vcode))['0'];
        $data=array(
            'mer_id'=>$package_info['id'],
            'store_id'=>'66',
            'uid'=>'0',
            'phone'=>$phone,
            'text'=>$vcode.','.$company_name.',广发银行大厦立体车库1F',
            'time'=>time(),
            'sendto'=>'SmsCodeverify',
            'type'=>'expressage',
            'bizid'=>$request->BizId);
        if($request->Code=='OK'){
            $data['status']='0';
            $res = M('sms_record')->add($data);

            return 1;
        }else{
            $data['status']='1';
            $data['remark']=$request->Code;
            $res = M('sms_record')->add($data);
            return 2;
        }

    }


    /**
     * 发送快递模版消息
     * @param $packageId
     * @return bool
     */
    public function send_template($packageId)
    {
        $wechat = new WechatModel();

        $model = new PackageModel();

        $packageInfo = $model->getPackageInfo($packageId);

        $url=C('WEB_DOMAIN').'/wap.php?&g=Wap&c=Express&a=express_detail&id='.$packageId;
        //流程审批提醒模板ID
        $tpl_id = "CoBIh-8pk7EZx0IJ7MHY69-G9_725Iq_w28Ai5ZZ3Ks";
        $data = array(
            'first'=>array(
                'value'=>"您的快件已经到达广发银行大厦立体车库1F快递收发室，请凭取件码取件。（取件时间：工作日上午8:30-11:30 下午2:00-17:30）请熟知，谢谢！",
                'color'=>"#029700",
            ),
            'keyword1'=>array(
                'value'=>$packageInfo['receipt_code'],
                'color'=>"#000000",
            ),
            'keyword2'=>array(
                'value'=>$packageInfo['waybill_number'],//人
                'color'=>"#000000",
            ),
            'keyword3'=>array(
                'value'=>$packageInfo['company_name'],
                'color'=>"#000000",
            ),
            'keyword4'=>array(
                'value'=>'18056092778',
                'color'=>"#000000",
            ),
            /*'remark'=>array(
                'value'=>'请凭取件码到广发银行大厦立体车库1F快递收发室取件',
                'color'=>"#000000",
            )*/
        );

        if($packageInfo['openid']){
            $res = $wechat->send_tpl_message($packageInfo['openid'], $tpl_id, $url, $data);

            if($res['errcode']!==0){
                //TODO::与用户方逻辑无关，暂不提醒，应记录在日志系统当中
                // $this->error("推送消息失败");
                return 2;
            }else{
                return 1;
            }
        }else{
            return 2;
        }

    }

    //计算快递公司单号限制位数
    public function ok_way_num_ajax() {
        $id = I('get.id');
        $model=new PackageModel();
        //改变获取方式  zhukeqin
        $str=$model->getCompany_info($id)['single_number'];
        //$str = D('expressage_company')->where(array('company_id'=>$id))->find()['single_number'];
        $arr = explode(',',$str);
        echo json_encode($arr);
    }

    /**
     * ajax用户的信息，传到前台
     */
    public function ajax_user_info()
    {
        $phone = I('post.phone');

        $userInfo = M('expressage_user')->where(array('phone'=>$phone))->find();

        if($userInfo)
        {
            echo $userInfo['name'];
        }
        else
        {
            $userBindInfo = M('house_village_user_bind')->where(array('phone'=>$phone))->find();

            if($userBindInfo)
            {
                echo $userBindInfo['name'];
            }
        }
    }

    /**
     * 获取包裹详细信息
     * @param $id        包裹id
     * @return mixed
     */
    public function getPackageInfo($id)
    {
        $model=new PackageModel();
        //使用新的快递信息获取方法 by zhukeqin
        $info=$model->getPackage_list_search(array('id'=>$id))[0];
        /*$field = array(
            'p.*',
            'c.company_name',
            'u.name',
            'u.phone',
            'a.realname',
            'user.nickname',
            'user.avatar',
            'user.openid'
        );

        $info = M('package')
            ->alias('p')
            ->field($field)
            ->join('LEFT JOIN __EXPRESSAGE_COMPANY__ c on c.company_id=p.cid')
            ->join('LEFT JOIN __EXPRESSAGE_USER__ u on u.pigcms_id=p.aid')
            ->join('LEFT JOIN __ADMIN__ a on a.id=p.admin_id')
            ->join('LEFT JOIN __USER__ user on user.uid=u.uid')
            ->where(array('p.id'=>$id))
            ->find();*/

        return $info;
    }



    /**
     * 线下支付停车费
     * @author 祝君伟
     * @time 二〇一八年二月二十六日 10:21:53
     */
    public function outLinkPay()
    {

        $model = new CarModel();

        if(IS_POST)
        {
            $payment  = I('post.payment');

            if(!$payment) echo 3;

            $pay_type  = I('post.pay_type');

            if($pay_type=='') echo 4;

            $garage_id = I('post.garage_id');

            if(!$garage_id) echo 5;

            $duty_id = I('post.duty_id');

            if(!$duty_id) echo 6;

            $ym = I('post.ym')?:date('Y-m-d');


            $dutyInfo = $model->check_this_duty($duty_id,date('Y-m-d'),$pay_type,$garage_id);

            if($dutyInfo['id']!==null)
            {
                //有数据，做更新
                $updateArray = array(
                    'id'=>$dutyInfo['id'],
                    'payment'=>$payment,
                    'pay_loan'=>$payment,
                    'enter_time'=>time(),
                    'enter_date'=>$ym
                );

                $res = M('')->table('smart_offline_income')->save($updateArray);

                if($res) echo 1;else echo 2;
            }else{

                //无数据执行添加
                $dataArray = array(
                    'duty_id'=>$duty_id,
                    'garage_id'=>$garage_id,
                    'payment'=>$payment,
                    'pay_loan'=>$payment,
                    'pay_type'=>$pay_type,
                    'enter_time'=>time(),
                    'is_check'=>1,
                    'enter_date'=>$ym
                );

                $res = M('')->table('smart_offline_income')->data($dataArray)->add();

                if($res) echo 1;else echo 2;
            }




        }else{

            $res = $model->O2O_checkAdmin();

            if($res)
            {

                $duty = $model->check_duty();

                $res['duty'] = $duty;

                $this->assign('info',$res);

                $this->assign('ym',date('Y-m-d',time()));

                $this->display();

            }else{
                $this->error('你没有权限');
            }
        }



    }

    /**
     * 线下收款记录
     *
     *
     */
    public function outLinkRecord()
    {
        $model = new CarModel();

        $allRecord = $model->outPayRecord();

        $cashRecord = $model->outPayRecord(0);

        $weChatRecord = $model->outPayRecord(1);

        $OtherRecord = $model->outPayRecord(2);

        $recordArray =array(
            'cash'=>$cashRecord,
            'weChat'=>$weChatRecord,
            'Other'=>$OtherRecord,
            'all'=>$allRecord,
            'cash_count'=>count($cashRecord),
            'weChat_count'=>count($weChatRecord),
            'Other_count'=>count($OtherRecord),
            'all_count'=>count($allRecord)
        );

        $this->assign('recordArray',$recordArray);

        $this->display();
    }

    //数据统计传到前台
    public function ajax_count()
    {
        $model = new CarModel();

        $garage_id = I('post.garage_id');

        $duty_id = I('post.duty_id');

        $reArr = $model->count_this_duty($duty_id,date('Y-m-d'),$garage_id);

        if($reArr['all']['total'] == 0){
            echo 1;
        }else{
            echo '<p class="weui-msg__desc">'.$reArr['all']['desc'].'数据统计：<a href="javascript:void(0);">总计：'.$reArr['all']['total'].',其中现金：'.$reArr['Cash']['total'].',微信扫码支付：'.$reArr['WeChat']['total'].',其他：'.$reArr['Other']['total'].'</a></p>';
        }


    }

    //旧模板，已弃用
    public function send_express3() {
        $openid = $_SESSION['openid'];
        //判断用户是否首次关注
        $userArr = D('user')->where(array('openid'=>$openid))->find();
        if ($userArr) {
            $phone = $userArr['phone'];
            if (!$phone) {
                $this->redirect(U('bind_phone'));
            }

            //显示字段
            $field = array(
                'o.order_id',
                'o.goods_type_name',
                'o.pay_type_name',
                'o.billing_type_id',
                'o.ems_order_id',
                'o.create_time'=>'od_create_time',
                'o.billing_adid',
                'o.shipping_adid',
                'bad.uid'=>'bad_uid',
                'bad.name'=>'bad_name',
                'bad.phone'=>'bad_phone',
                'bad.detail'=>'bad_detail',
                'sad.uid'=>'sad_uid',
                'sad.name'=>'sad_name',
                'sad.phone'=>'sad_phone',
                'sad.detail'=>'sad_detail',
                'u.nickname',
            );

            $list = D('express_order')->alias('o')
                ->field($field)
                ->join('left join __USER__ u on u.uid=o.user_id')
                ->join('LEFT JOIN __USER_ADRESS__ bad ON bad.adress_id = o.billing_adid')
                ->join('LEFT JOIN __USER_ADRESS__ sad ON sad.adress_id = o.shipping_adid')
                ->where(array('u.openid'=>$openid,'o.is_pay'=>1))
                ->order('o.order_id desc')
                ->select();
            $badList = array();//寄件信息
            $sadList = array();//收件信息
            foreach ($list as $v) {
                if ($v['bad_phone'] == $phone) {
                    $badList[] = $v;
                } elseif ($v['sad_phone'] == $phone) {
                    $sadList[] = $v;
                }
            }

            //快递公司
            $companyArr = D('express')->where(array('status'=>1))->select();

            $this->assign('companyArr',$companyArr);
            $this->assign('badList',$badList);
            $this->assign('sadList',$sadList);
        } else {
            $this->redirect(U('weixin_bind'));
        }

        $this->display();
    }

    //手机端寄件管理
    public function send_express() {
        $openid = $_SESSION['openid'];
        //判断用户是否首次关注
        $userArr = D('user')->where(array('openid'=>$openid))->find();
        if ($userArr) {
            $phone = $userArr['phone'];
            if (!$phone) {
                $this->redirect(U('bind_phone'));
            }

            //寄出快递
            $badList = $this->getBadList($phone);

            //接收快递
            $listTwo = $this->getExpressList($phone,0);//到站
            $listThree = $this->getExpressList($phone,1);//已提货
//            dump($listThree);exit;
            //快递公司
            $companyArr = D('express')->where(array('status'=>1))->select();
            $this->assign('companyArr',$companyArr);
            $this->assign('badList',$badList);
            $this->assign('listTwo',$listTwo);
            $this->assign('listThree',$listThree);
            $this->assign('phone',$phone);
        } else {
            $this->redirect(U('weixin_bind'));
        }

        $this->display();
    }

    //寄件列表刷新
    public function express_getBadList_ajax() {
        $phone = I('get.phone');
        $more = I('get.more');
        $list = $this->getBadList($phone,$more);
        $str = '';
        if ($list) {
            foreach ($list as $v) {
                $logo = $v['logo'];
                $exp_name = $v['exp_name'];
                $od_create_time = date('Y-m-d',$v['od_create_time']);
                $bad_position = $v['bad_position'];
                $bad_name = $v['bad_name'];
                $exs_status = $v['exs_status'];
                if ($exs_status == 1) {
                    $exs_str =  '<span style="color: #0ccfa3;">已送达</span>';
                } else {
                    $exs_str =  '运送中';
                }
                $ems_order_id = $v['ems_order_id'];
                $sad_position = $v['sad_position'];
                $sad_name = $v['sad_name'];
                $order_id = $v['order_id'];
                $str .= "<div style=\"height:30px; overflow:hidden; width:100%;\"></div>
                                    <div class=\"zk3 i2\">
                                        <div class=\"sm4\">
                                            <div class=\"f1\"><img src=\"$logo\" style=\"height:33px;\"></div>
                                            <div class=\"f2\">$exp_name</div>
                                            <div class=\"f4\">$od_create_time</div>
                                            <div style=\"clear:both\"></div>
                                        </div>
                                        <div class=\"xt\">
                                            <div class=\"gs\">
                                                <div class=\"wk\">$bad_position</div>
                                                <div class=\"wk2\">$bad_name</div>
                                            </div>
                                            <div class=\"gs2\">
                                                <div class=\"sk\">$exs_str</div>
                                                <div class=\"sk2\">$ems_order_id</div>
                                            </div>
                                            <div class=\"gs3\">
                                                <div class=\"wk\">$sad_position</div>
                                                <div class=\"wk2\">$sad_name</div>
                                            </div>
                                            <div style=\"clear:both\"></div>
                                        </div>
                                        <div class=\"sm5\">
                                            <div class=\"ht2\">
                                                <div class=\"few\" onClick=\"detail_exs($order_id)\">详 情</div>
                                            </div>
                                            <div style=\"clear:both\"></div>
                                        </div>
                                    </div>";
            }
        }

        echo $str;




    }

    //已取件列表刷新
    public function getExpressList_ajax() {
        $phone = I('get.phone');
        $status = I('get.status');
        $more = I('get.more');
        $list = $this->getExpressList($phone,$status,$more);
        $str = '';
        if ($list) {
            foreach ($list as $v) {
                $logo = $v['logo'];
                $company_name = $v['company_name'];
                $receipt_code = $v['receipt_code'];
                $name = $v['name'];
                $phone = $v['phone'];
                $waybill_number = $v['waybill_number'];
                $id = $v['id'];
                $str .= "<div style=\"height:30px; overflow:hidden; width:100%;\"></div>
                            <div class=\"zk2 i3\" >
                                <div class=\"sm\">
                                    <div class=\"f1\"><img src=\"$logo\" style=\"height:33px;\"></div>
                                    <div class=\"f2\">$company_name</div>
                                    <div class=\"f3\">取件码：$receipt_code</div>
                                    <div style=\"clear:both\"></div>
                                </div>
                                <div class=\"sm2\">
                                    <div class=\"ht\">取件人：<span style=\"color:#000000;\">$name</span></div>
                                    <div class=\"ht2\">手机号：<span style=\"color:#000000;\">$phone</span></div>
                                    <div style=\"clear:both\"></div>
                                </div>
                                <div class=\"sm3\">
                                    <div class=\"ht3\">运单号：<span style=\"color:#000000;\">$waybill_number</span></div>
                                    <div class=\"ht4\">
                                        <div class=\"few\" onClick=\"detail_package($id)\">详 情</div>
                                    </div>
                                    <div style=\"clear:both\"></div>
                                </div>
                            </div>";
            }
        }
        echo $str;
    }

    //未取件列表刷新
    public function getExpressList_two_ajax() {
        $phone = I('get.phone');
        $status = I('get.status');
        $more = I('get.more');
        $list = $this->getExpressList($phone,$status,$more);
        $str = '';
        if ($list) {
            foreach ($list as $v) {
                $logo = $v['logo'];
                $company_name = $v['company_name'];
                $receipt_code = $v['receipt_code'];
                $name = $v['name'];
                $phone = $v['phone'];
                $waybill_number = $v['waybill_number'];
                $id = $v['id'];
                $str .= "<div style=\"height:30px; overflow:hidden; width:100%;\"></div>
                            <div class=\"zk2 i1\" >
                                <div class=\"sm\">
                                    <div class=\"f1\"><img src=\"$logo\" style=\"height:33px;\"></div>
                                    <div class=\"f2\">$company_name</div>
                                    <div class=\"f3\">取件码：$receipt_code</div>
                                    <div style=\"clear:both\"></div>
                                </div>
                                <div class=\"sm2\">
                                    <div class=\"ht\">取件人：<span style=\"color:#000000;\">$name</span></div>
                                    <div class=\"ht2\">手机号：<span style=\"color:#000000;\">$phone</span></div>
                                    <div style=\"clear:both\"></div>
                                </div>
                                <div class=\"sm3\">
                                    <div class=\"ht3\">运单号：<span style=\"color:#000000;\">$waybill_number</span></div>
                                    <div class=\"ht4\">
                                        <div class=\"few\" onClick=\"detail_package($id)\">详 情</div>
                                    </div>
                                    <div style=\"clear:both\"></div>
                                </div>
                            </div>";
            }
        }
        echo $str;
    }

    /*
     * 寄件信息方法
     * @param $phone 手机号
     * @param $more 刷新操作
     */
    public function getBadList($phone,$more=0) {
        $openid = $_SESSION['openid'];
        //显示字段
        $field1 = array(
            'o.order_id',
            'o.goods_type_name',
            'o.pay_type_name',
            'o.billing_type_id',
            'o.ems_order_id',
            'o.create_time'=>'od_create_time',
            'o.billing_adid',
            'o.shipping_adid',
            'bad.uid'=>'bad_uid',
            'bad.name'=>'bad_name',
            'bad.phone'=>'bad_phone',
            'bad.detail'=>'bad_detail',
            'bad.position'=>'bad_position',
            'sad.uid'=>'sad_uid',
            'sad.name'=>'sad_name',
            'sad.phone'=>'sad_phone',
            'sad.detail'=>'sad_detail',
            'sad.position'=>'sad_position',
            'u.nickname',
            'exp.name' => 'exp_name',
            'exp.coding'=> 'exp_coding',
            'u.phone'=>'user_phone',
            'logo',
        );


        $map['ems_order_id'] = array('neq','');
        //寄件服务
        $list = D('express_order')->alias('o')
            ->field($field1)
            ->join('left join __USER__ u on u.uid=o.user_id')
            ->join('LEFT JOIN __USER_ADRESS__ bad ON bad.adress_id = o.billing_adid')
            ->join('LEFT JOIN __USER_ADRESS__ sad ON sad.adress_id = o.shipping_adid')
            ->join('left join __EXPRESS__  exp on exp.id=o.express_id')
            ->where(array('u.openid'=>$openid,'o.is_pay'=>1))
            ->where($map)
            ->order('o.order_id desc')
            ->limit($more,5)
            ->select();

        $badList = array();//寄件信息
        foreach ($list as &$v) {
            $order_id = $v['ems_order_id'];
            $coding = $v['exp_coding'];
            if (empty($_SESSION['exs']['status_'.$order_id])) {
                $resJson = $this->getOrderArr($coding,$order_id);
                $resArr = $resJson['Traces'];
                $oneStr = $resArr[count($resArr)-1]['AcceptStation'];
                if (strpos($oneStr,'签收') > -1) {
                    $_SESSION['exs']['status_'.$order_id] = 1;
                    $v['exs_status'] = 1;
                } else {
                    $v['exs_status'] = 0;
                }
            } else {
                $v['exs_status'] = 1;
            }

            if (!$v['bad_name']) $v['bad_name'] = $v['nickname'];

            if (!$v['sad_name']) $v['sad_name'] = '未知';

            if ($v['user_phone'] == $phone) {
                $badList[] = $v;
            }


        }
        unset($v);
        return $badList;
    }

    /*
     * 取件信息方法
     * @param $phone 手机号
     * @param $status 0：到站 1 ：已取件
     * @param $more
     */
    public function getExpressList($phone,$status,$more=0) {
        $model=new PackageModel();
        //获取用户id用于查询
        $user_info=$model->getUser_info(array('phone'=>$phone))['pigcms_id'];
        //使用新的快递信息获取方法 by zhukeqin
        $list=$model->getPackage_list_search(array('aid'=>$user_info, 'status'=>$status),$more,5);
        /*$map2 = array(
            'c.status'=>0,
            'u.status'=>0,
            'u.phone'=>$phone,
        );


        $field2 = array(
            'p.*',
            'c.company_name',
            'c.logo',
            'u.name',
            'u.phone',
            'a.realname'
        );

        //到站
        $list = M('package')
            ->alias('p')
            ->field($field2)
            ->join('LEFT JOIN __EXPRESSAGE_COMPANY__ c on c.company_id=p.cid')
            ->join('LEFT JOIN __EXPRESSAGE_USER__ u on u.pigcms_id=p.aid')
            ->join('LEFT JOIN __ADMIN__ a on a.id=p.admin_id')
            ->where($map2)
            ->where(array('p.status'=>$status))
            ->order('in_package_time desc')
            ->limit($more,5)
            ->select();*/
        return $list;
    }

    /*
     * 获取单个取件信息方法
     * @param $id
     */
    public function getExpressListOne($id) {
        $model=new PackageModel();
        //使用新的快递信息获取方法 by zhukeqin
        $list=$model->getPackage_list_search(array('id'=>$id))[0];
        return $list;
    }

    //快件详情页
    public function detail_all() {
        $id = $_GET['id'];
        $type = $_GET['type'];
        if ($type == 1) {
            $listOneArr = $this->getExpressListOne($id);
            $coding = $listOneArr['coding'];
            $order_id = $listOneArr['waybill_number'];
            $wuliuArr = $this->getOrderArr($coding,$order_id);
            $resArr = $wuliuArr['Traces'];
            if ($resArr) {
                krsort($resArr);
                $this->assign('resArr',$resArr);
            }
            $this->assign('list',$listOneArr);

        } elseif ($type == 2) {
            $listTwoArr = $this->getBadListOne($id);
            $coding = $listTwoArr['exp_coding'];
            $order_id = $listTwoArr['ems_order_id'];
            $wuliuArr = $this->getOrderArr($coding,$order_id);
            $resArr = $wuliuArr['Traces'];
            if ($resArr) {
                krsort($resArr);
                $this->assign('resArr',$resArr);
            }
            $this->assign('listTwoArr',$listTwoArr);
        }

        $this->display();
    }

    /*
     * 获取单个寄件信息方法
     * @param $id
     */
    public function getBadListOne($id) {
        $field1 = array(
            'o.order_id',
            'o.goods_type_name',
            'o.pay_type_name',
            'o.billing_type_id',
            'o.ems_order_id',
            'o.create_time'=>'od_create_time',
            'o.billing_adid',
            'o.shipping_adid',
            'bad.uid'=>'bad_uid',
            'bad.name'=>'bad_name',
            'bad.phone'=>'bad_phone',
            'bad.detail'=>'bad_detail',
            'bad.position'=>'bad_position',
            'sad.uid'=>'sad_uid',
            'sad.name'=>'sad_name',
            'sad.phone'=>'sad_phone',
            'sad.detail'=>'sad_detail',
            'sad.position'=>'sad_position',
            'u.nickname',
            'exp.name' => 'exp_name',
            'exp.coding'=> 'exp_coding',
        );

        $list = D('express_order')->alias('o')
            ->field($field1)
            ->join('left join __USER__ u on u.uid=o.user_id')
            ->join('LEFT JOIN __USER_ADRESS__ bad ON bad.adress_id = o.billing_adid')
            ->join('LEFT JOIN __USER_ADRESS__ sad ON sad.adress_id = o.shipping_adid')
            ->join('left join __EXPRESS__  exp on exp.id=o.express_id')
            ->where(array('o.order_id'=>$id))
            ->order('o.order_id desc')
            ->find();
        $order_id = $list['ems_order_id'];
        $coding = $list['exp_coding'];
        if (empty($_SESSION['exs']['status_'.$order_id])) {
            $resJson = $this->getOrderArr($coding,$order_id);
            $resArr = $resJson['Traces'];
            $oneStr = $resArr[count($resArr)-1]['AcceptStation'];
            if (strpos($oneStr,'已签收') > -1) {
                $_SESSION['exs']['status_'.$order_id] = 1;
                $list['exs_status'] = 1;
            } else {
                $list['exs_status'] = 0;
            }
        } else {
            $list['exs_status'] = 1;
        }
        if (!$list['bad_name']) $list['bad_name'] = $list['nickname'];
        return $list;
    }

    //用户绑定手机号操作
    public function bind_phone() {
        if (IS_POST) {
            $phone = I('post.phone');
            $openid = $_SESSION['openid'];
            $uid = D('user')->where(array('openid'=>$openid))->find()['uid'];
            $re = D('user')->where(array('uid'=>$uid))->save(array('phone'=>$phone));
            if ($re) {
                $this->success('绑定成功',U('send_express'));
            } else {
                $this->error('绑定失败',U('bind_phone'));
            }
        } else {
            $this->display();
        }
    }

    //提供微信绑定方法
    public function weixin_bind() {
        $this->redirect('Home/index_new', array('weixin_bind_ok' => 1));
    }

    //寄件管理中在线缴费
    public function send_express_pay() {
        $money = I('post.money');
        $data['express_id'] = I('post.express_id');
        $data['user_id'] = $_SESSION['user']['uid'];
        $data['order_on'] = $data['order_no'] = time().mt_rand(100000,999999);
        $data['save_pay']=$money?:0;
        $data['billing_type_id']='线上支付';//付款方式
        $data['create_time']=time();
        $order_id = M('express_order')->data($data)->add();
        if ($order_id) {
            $orderArr = D('express_order')->where(array('order_id'=>$order_id))->find();
            $pay_class_name = 'Weixin';
            import('@.ORG.pay.'.$pay_class_name);
            $pay_method =  (new ConfigModel())->get_pay_method(0,0,true);

            $order_info = array(
                'order_name'=>'快递寄件',
                'order_id'=>$orderArr['order_on'],//订单号
            );
            $pay_method['weixin']['config']['sub_mch_id']=1489131162;
//            $pay_money = $orderArr['save_pay'];
            $pay_money = 0.01;//测试
            $pay_type = 'weixin';
            $pay_class = new Weixin(
                $order_info,
                $pay_money,
                $pay_type,
                $pay_method['weixin']['config'],
                $this->user_session,
                1
            );
            $pay_param = $pay_class->pay(null,null,'/source/web_weixin_notice_jijian.php');
            $weixin_param = $pay_param['weixin_param'];
            echo json_encode(array('error'=>0,'msg'=>'创建订单成功','data'=>$weixin_param));

        } else {
//            $this->error('创建订单失败',U('send_express'));
            echo json_encode(array('error'=>1,'msg'=>'创建订单失败'));
        }

    }

    //寄件缴费回调
    public function pay_jijian_back() {
        $pay_class_name = 'Weixin';
        import('@.ORG.pay.'.$pay_class_name);
        $pay_method = D('Config')->get_pay_method(0,0,true);
        $pay_class = new Weixin(
            $order_info=null,
            $pay_money=null,
            $pay_type='weixin',
            $pay_method['weixin']['config'],
            $this->user_session,
            1
        );
        $data = $pay_class->return_url();
        if($data['error']==0){
            $orderArr = $data['order_param'];
            $order_no = $orderArr['order_id'];//订单号
            $re = D('express_order')->where(array('order_on'=>$order_no))->save(array('is_pay'=>1));
            exit('<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>');
        }

    }

    //停车缴费推送页面详情页
    public function suc_advise($serv_id) {
        $field = array(
            'ser.serv_id',
            'ser.car_no',
            'ser.start_time',
            'ser.end_time',
            'p.pay_time',
            'p.payment',
            'p.pay_loan',
            'u.user_name',
            'u.user_headerimg',
            'g.garage_name',
        );
        $servArr = M('servicerecord','smart_')->alias('ser')
            ->join('left join smart_payrecord p on p.serv_id=ser.serv_id')
            ->join('left join smart_user u on p.user_id=u.user_id')
            ->join('left join smart_garage g on ser.garage_id=g.garage_id')
            ->where(array('ser.serv_id'=>$serv_id))
            ->find();
        $out_time = $servArr['pay_time']+5*60;
        $time = $this->timediff($servArr['start_time'],$out_time);
        $this->assign('servArr',$servArr);
        $this->assign('time',$time);
        $this->assign('out_time',$out_time);
        $this->display();
    }

    /**
     * @param $url url路径
     * 生成二维码
     */
    public function QR($url,$type){
        //url解码
        $url=urldecode($url);
        $url=htmlspecialchars_decode($url);
        if($type=='notlogo'){
            qr($url,'1');
        }else{
            qr($url,'./static/PropertyService/images/xx.png');
        }

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

    //物流信息测试方法
    public function hello() {
        $res = $this->getOrderTracesByJson('ZTO','630630689865');
        dump($res);
    }

    /**
     * Json方式 查询订单物流轨迹
     */
    function getOrderTracesByJson($coding,$order_id){
        $requestData= "
        {'OrderCode':'',
        'ShipperCode':'$coding',
        'LogisticCode':'$order_id'
        }";
        $datas = array(
            'EBusinessID' => $this->EBusinessID,
            'RequestType' => '1002',
            'RequestData' => urlencode($requestData) ,
            'DataType' => '2',
        );
        $datas['DataSign'] = $this->encrypt($requestData, $this->AppKey);
        $result=$this->sendPost($this->ReqURL, $datas);

        $res = json_decode($result,true);
        //根据公司业务处理返回的信息......
        //查询物流信息
        if ($res['State'] !== 0) {
            $list = $res['Traces'];
//            $coding = $res['ShipperCode'];
//            $exsArr = D('express')->where(array('coding'=>$coding))->find();
            foreach ($list as &$v) {
                $y = substr($v['AcceptTime'],0,strpos($v['AcceptTime'],' '));
                $h = substr($v['AcceptTime'],strpos($v['AcceptTime'],' ')+1);
                $v['y'] = $y;
                $v['h'] = $h;
            }
            unset($v);
            krsort($list);
            if ($list) $this->assign('list',$list);
//            $this->assign('exsArr',$exsArr);
        }
        //数据库快递信息
        $field1 = array(
            'o.order_id',
            'o.goods_type_name',
            'o.pay_type_name',
            'o.billing_type_id',
            'o.ems_order_id',
            'o.create_time'=>'od_create_time',
            'o.billing_adid',
            'o.shipping_adid',
            'bad.uid'=>'bad_uid',
            'bad.name'=>'bad_name',
            'bad.phone'=>'bad_phone',
            'bad.detail'=>'bad_detail',
            'bad.position'=>'bad_position',
            'sad.uid'=>'sad_uid',
            'sad.name'=>'sad_name',
            'sad.phone'=>'sad_phone',
            'sad.detail'=>'sad_detail',
            'sad.position'=>'sad_position',
            'u.nickname',
            'u.phone',
            'exp.name' => 'exp_name',
            'exp.coding'=> 'exp_coding',
        );
        $exs_list = D('express_order')->alias('o')
            ->field($field1)
            ->join('left join __USER__ u on u.uid=o.user_id')
            ->join('LEFT JOIN __USER_ADRESS__ bad ON bad.adress_id = o.billing_adid')
            ->join('LEFT JOIN __USER_ADRESS__ sad ON sad.adress_id = o.shipping_adid')
            ->join('left join __EXPRESS__  exp on exp.id=o.express_id')
            ->where(array('o.ems_order_id'=>$order_id))
            ->order('o.order_id desc')
            ->find();

        if (!$exs_list['bad_name']) $exs_list['bad_name'] = $exs_list['nickname'];
        if ($exs_list) $this->assign('exs_list',$exs_list);

        $this->display();
    }

    //调用的方法
    function getOrderArr($coding,$order_id){
        $requestData= "
        {'OrderCode':'',
        'ShipperCode':'$coding',
        'LogisticCode':'$order_id'
        }";
        $datas = array(
            'EBusinessID' => $this->EBusinessID,
            'RequestType' => '1002',
            'RequestData' => urlencode($requestData) ,
            'DataType' => '2',
        );
        $datas['DataSign'] = $this->encrypt($requestData, $this->AppKey);
        $result=$this->sendPost($this->ReqURL, $datas);

        $res = json_decode($result,true);
        return $res;
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

//    public function xmqk() {
//        $this->display();
//    }
//
//    public function xmqk2() {
//        $this->display();
//    }

}