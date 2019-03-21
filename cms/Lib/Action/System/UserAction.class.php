<?php
/*
 * 用户中心
 *
 */
class UserAction extends BaseAction {
    public function index() {
        //搜索
        if (!empty($_GET['keyword'])) {
            if ($_GET['searchtype'] == 'uid') {
                $condition_user['uid'] = $_GET['keyword'];
            } else if ($_GET['searchtype'] == 'nickname') {
                $condition_user['nickname'] = array('like', '%' . $_GET['keyword'] . '%');
            } else if ($_GET['searchtype'] == 'phone') {
                $condition_user['phone'] = array('like', '%' . $_GET['keyword'] . '%');
            }
        }
        $database_user = D('User');
        $count_user = $database_user->where($condition_user)->count();
        import('@.ORG.system_page');
        $p = new Page($count_user, 15);
        //$user_list = $database_user->field(true)->where($condition_user)->order('`last_time` DESC')->limit($p->firstRow . ',' . $p->listRows)->select();
		$user_list = $database_user->where($condition_user)->order('`last_time` DESC')->limit($p->firstRow . ',' . $p->listRows)->select();
		//dump($user_list);exit;
        if (!empty($user_list)) {
            import('ORG.Net.IpLocation');
            $IpLocation = new IpLocation();
            foreach ($user_list as &$value) {
                $last_location = $IpLocation->getlocation(long2ip($value['last_ip']));
                $value['last_ip_txt'] = iconv('GBK', 'UTF-8', $last_location['country']);
            }
        }
        $this->assign('user_list', $user_list);
        $pagebar = $p->show();
        $this->assign('pagebar', $pagebar);
        $this->display();
    }


    public function _before_index_news(){
        if(session('system.account')==SUPER_ADMIN){
            $this->assign('admin',1);
            $villageArray = M('house_village')->where(array('status'=>1))->select();
            $this->assign('villageArray',$villageArray);
            if(I('get.village_id')){
                $presentVillage = M('house_village')->find(I('get.village_id'))['village_name'];
            }else{
                $presentVillage = '全部显示';
            }
        }else{
            $this->assign('admin',0);
            $presentVillage = M('house_village')->find(session('system.village_id'))['village_name'];

        }

        $this->assign('presentVillage',$presentVillage);


    }

    public function index_news() {
        //搜索
        if (!empty($_GET['keyword'])) {
            if ($_GET['searchtype'] == 'uid') {
                $condition_user['uid'] = $_GET['keyword'];
            } else if ($_GET['searchtype'] == 'nickname') {
                $condition_user['nickname'] = array('like', '%' . $_GET['keyword'] . '%');
            } else if ($_GET['searchtype'] == 'phone') {
                $condition_user['phone'] = array('like', '%' . $_GET['keyword'] . '%');
            }
        }
//        $condition_user = filter_village($condition_user);

        $database_user = D('User');
        $count_user = $database_user->where($condition_user)->count();
        import('@.ORG.system_page');
        $p = new Page($count_user, 15);
        //$user_list = $database_user->field(true)->where($condition_user)->order('`last_time` DESC')->limit($p->firstRow . ',' . $p->listRows)->select();
        $user_list = $database_user->where($condition_user)->order('`last_time` DESC')->limit(1000)->select();
        //dump($user_list);exit;
        if (!empty($user_list)) {
            import('ORG.Net.IpLocation');
            $IpLocation = new IpLocation();
            foreach ($user_list as &$value) {
                $last_location = $IpLocation->getlocation(long2ip($value['last_ip']));
                $value['last_ip_txt'] = iconv('GBK', 'UTF-8', $last_location['country']);
            }
        }
        $this->assign('user_list', $user_list);
        $pagebar = $p->show();
        $this->assign('pagebar', $pagebar);
        $this->display();
    }
	
	public function index_news2(){
	 $this->display();
	}

    /*
     * 更新用户基本信息
     * 修改
     * 2018.3.31
     */
    public function update_info2() {
        $time = time();
        $wechat = new WechatModel();
        $access_token = $wechat->access_token;
        $openid = "ohgcf0v4dWL-_Vk0n41AyLMTexVg";
        $url2="https://api.weixin.qq.com/cgi-bin/user/info?access_token=" . $access_token.'&openid='.$openid.'&lang=zh_CN';//获取用户基本信息url
        $res = $this->wxHttpsRequest($url2);
        dump($res);
    }


    /*
     * 更新用户基本信息,暂不使用
     * 陈琦
     * 2017.3.28
     */
    public function update_info(){
        $time = time();
        $wechat = new WechatModel();
        $access_token = $wechat->access_token;
        $arr=M('user')->where('%d-update_time>24*60*60 and uid>110' ,$time)->order('uid asc')->limit(10)->select();//用户表
        if($arr){
            M()->startTrans();
            $flag=true;
            foreach ($arr as $v){
                $openid=$v['openid'];
//                $info=M('user')->where(array('openid'=>$openid))->find();
                $url2="https://api.weixin.qq.com/cgi-bin/user/info?access_token=" . $access_token.'&openid='.$openid.'&lang=zh_CN';//获取用户基本信息url
                $result = $this->wxHttpsRequest($url2);
                dump($result);
                if(!$result['errcode']){
                    if($result['subscribe']==1){//关注了公众号
                        //if(!($info['nickname']==$result['nickname'] && $info['city']==$result['city'] && $info['province']==$result['province'] && $info['avatar']==$result['headimgurl'])){
                            $data=array('nickname'=>$result['nickname'],'city'=>$result['city'],'province'=>$result['province'],'avatar'=>$result['headimgurl'],'update_time'=>$time);
                            $update=M('user')->where(array('openid'=>$openid))->save($data);
                            $update = $update!==false?true:false;
                            $flag *= $update;
                        //}
                    }else{//未关注的
                        $data=array('update_time'=>time());
                        $update=M('user')->where(array('openid'=>$openid))->save($data);
                        $update = $update!==false?true:false;
                        $flag *= $update;
                    }
                } elseif($result['errcode'] == 42001) { //$access_token过期
                    $wechat = new WechatModel();
                    $wechat->resetAuth();
                    $access_token = $wechat->access_token;
                } else {
                    $data=array('update_time'=>time());
                    $update=M('user')->where(array('openid'=>$openid))->save($data);
                    $update = $update!==false?true:false;
                    $flag *= $update;
                }
            }
            if($flag){
                M()->commit();
                echo json_encode(array('error'=>0));
            }else{
                M()->rollback();
                echo json_encode(array('error'=>1));
            }
        }else{
            echo json_encode(array('error'=>2,'msg'=>'数据更新完毕'));
        }

    }


    /*
     * 定时更新用户表
     * 2018.4.2
     */
    public function update_info_time(){
        $count=M('user')->where('%d-update_time>24*60*60 and uid>110' ,time())->order('uid asc')->count();//还需更新数量
        dump($count);exit;

        $wechat = new WechatModel();
        $access_token = $wechat->access_token;
        $arr=M('user')->where('%d-update_time>24*60*60 and uid>110' ,time())->order('uid asc')->limit(10)->select();//用户表
        if($arr){
            foreach ($arr as $v){
                $openid=$v['openid'];
                $url2="https://api.weixin.qq.com/cgi-bin/user/info?access_token=" . $access_token.'&openid='.$openid.'&lang=zh_CN';//获取用户基本信息url
                $result = $this->wxHttpsRequest($url2);

                if(!$result['errcode']){
                    if($result['subscribe']==1){//关注了公众号
                        $data=array('nickname'=>$result['nickname'],'city'=>$result['city'],'province'=>$result['province'],'avatar'=>$result['headimgurl'],'update_time'=>time());
                        $update=M('user')->where(array('openid'=>$openid))->save($data);

                    }else{//未关注的
                        $data=array('update_time'=>time());
                        $update=M('user')->where(array('openid'=>$openid))->save($data);
                    }
                } elseif($result['errcode'] == 42001 || $result['errcode'] == 40001) { //$access_token过期
                    $wechat = new WechatModel();
                    $wechat->resetAuth();
                    $access_token = $wechat->access_token;
                    //添加到log日志里
                    $create_time = date('Y-m-d H:i:s',time());
                    $logData = array('openid'=>$openid,'errcode'=>$result['errcode'],'errmsg'=>$result['errmsg'],'create_time'=>$create_time,'type'=>2);
                    M('wxmsg_log')->add($logData);
                } else {
                    $data=array('update_time'=>time());
                    $update=M('user')->where(array('openid'=>$openid))->save($data);

                }
            }
        }
        $count=M('user')->where('%d-update_time>24*60*60 and uid>110' ,time())->order('uid asc')->count();//还需更新数量
        return intval($count);
    }

//    public function add_log($openid,$errcode,$errmsg,$time,$type=2) {
//        $data = array();
//        $data['openid'] = $openid;
//        $data['errcode'] = $errcode;
//        $data['errmsg'] = $errmsg;
//        $data['create_time'] = date('Y-m-d H:i:s',$time);
//        $data['type'] = $type;
//        D('wxmsg_log')->add($data);
//    }

    //定时任务模拟
    public function time_go() {
        //使用memcached
        $connect = new Memcached;  //声明一个新的memcached链接
        $connect->setOption(Memcached::OPT_COMPRESSION, false); //关闭压缩功能
        $connect->setOption(Memcached::OPT_BINARY_PROTOCOL, true); //使用binary二进制协议
        $connect->addServer('f120e580f9b74ec5.m.cnhzaliqshpub001.ocs.aliyuncs.com', 11211); //添加OCS实例地址及端口号
        $update_info_time = unserialize($connect->get('update_info_time'))?:0;
        dump($update_info_time);exit;
        if (time()-$update_info_time > 24*3600) {
            $update_info_count = unserialize($connect->get('update_info_count'));//获取更新剩余个数
            if (!$update_info_count && $update_info_count !== 0) {
                $update_info_count = -1;
            }
            if ($update_info_count) {
                $update_info_count = $this->update_info_time();
                $connect->set('update_info_count',serialize($update_info_count));
            } else {
                $connect->set('update_info_count',serialize(-1));//重置更新时间
                $connect->set('update_info_time',serialize(time()));//重置更新时间
            }

        }

    }


    public function edit() {
        $this->assign('bg_color', '#F3F3F3');
        $database_user = D('User');
        $condition_user['uid'] = intval($_GET['uid']);
       // $now_user = $database_user->field(true)->where($condition_user)->find();
        $now_user = $database_user->where($condition_user)->find();
        if (empty($now_user)) {
            $this->frame_error_tips('没有找到该用户信息！');
        }
        $levelDb = M('User_level');
        $tmparr = $levelDb->field(true)->order('id ASC')->select();
        $levelarr = array();
        if ($tmparr) {
            foreach ($tmparr as $vv) {
                $levelarr[$vv['level']] = $vv;
            }
        }
        $this->assign('levelarr', $levelarr);
        $this->assign('now_user', $now_user);
        $this->display();
    }
    public function edit_news() {
        $this->assign('bg_color', '#F3F3F3');
        $database_user = D('User');
        $condition_user['uid'] = intval($_GET['uid']);
        // $now_user = $database_user->field(true)->where($condition_user)->find();
        $now_user = $database_user->where($condition_user)->find();
        if (empty($now_user)) {
            $this->frame_error_tips('没有找到该用户信息！');
        }
        $levelDb = M('User_level');
        $tmparr = $levelDb->field(true)->order('id ASC')->select();
        $levelarr = array();
        if ($tmparr) {
            foreach ($tmparr as $vv) {
                $levelarr[$vv['level']] = $vv;
            }
        }
        $this->assign('levelarr', $levelarr);
        $this->assign('now_user', $now_user);
        $this->display();
    }
    public function del(){
        if(IS_AJAX){
            $database_user = D('User');
            $condition_user['uid'] = intval($_POST['uid']);
            $now_user = $database_user->field(true)->where($condition_user)->find();
            if (empty($now_user)) {
                echo "2",exit;
            }
            $del = $database_user->field(true)->where($condition_user)->delete();
            if($del){
                echo "1",exit;
            }else{
                echo "0",exit;
            }
        }
    }
    public function amend() {
        if (IS_POST) {
            $database_user = D('User');
            $condition_user['uid'] = intval($_POST['uid']);
            //$now_user = $database_user->field(true)->where($condition_user)->find();
			$now_user = $database_user->where($condition_user)->find();
            if (empty($now_user)) {
                $this->error('没有找到该用户信息！');
            }
            $condition_user['uid'] = $now_user['uid'];
            $data_user['nickname'] = $_POST['nickname'];
            $data_user['phone'] = $_POST['phone'];
            if ($_POST['pwd']) {
                $data_user['pwd'] = md5($_POST['pwd']);
            }
            $data_user['sex'] = $_POST['sex'];
            $data_user['province'] = $_POST['province'];
            $data_user['city'] = $_POST['city'];
            $data_user['qq'] = $_POST['qq'];
            $data_user['status'] = $_POST['status'];
			$data_user['youaddress'] = trim($_POST['youaddress']);
			$data_user['truename'] = trim($_POST['truename']);
            $_POST['set_money'] = floatval($_POST['set_money']);
            if (!empty($_POST['set_money'])) {
                if ($_POST['set_money_type'] == 1) {
                    $data_user['now_money'] = $now_user['now_money'] + $_POST['set_money'];
                } else {
                    $data_user['now_money'] = $now_user['now_money'] - $_POST['set_money'];
                }
                if ($data_user['now_money'] < 0) {
                    $this->error('修改后，余额不能小于0');
                }
            }
            $_POST['set_score'] = intval($_POST['set_score']);
            if (!empty($_POST['set_score'])) {
                if ($_POST['set_score_type'] == 1) {
                    $data_user['score_count'] = $now_user['score_count'] + $_POST['set_score'];
                } else {
                    $data_user['score_count'] = $now_user['score_count'] - $_POST['set_score'];
                }
                if ($data_user['score_count'] < 0) {
                    $this->error('修改后，积分不能小于0');
                }
            }
            $data_user['level'] = intval($_POST['level']);
            if ($database_user->where($condition_user)->data($data_user)->save()) {
                if (!empty($_POST['set_money'])) {
                    D('User_money_list')->add_row($now_user['uid'], $_POST['set_money_type'], $_POST['set_money'], '管理员后台操作', false);
                }
                if (!empty($_POST['set_score'])) {
                    D('User_score_list')->add_row($now_user['uid'], $_POST['set_score_type'], $_POST['set_score'], '管理员后台操作', false);
                }
                $this->success('修改成功！');
            } else {
                $this->error('修改失败！请重试。');
            }
        } else {
            $this->error('非法访问！');
        }
    }
    public function money_list() {
        $this->assign('bg_color', '#F3F3F3');
        $database_user_money_list = D('User_money_list');
        $condition_user_money_list['uid'] = intval($_GET['uid']);
        $count = $database_user_money_list->where($condition_user_money_list)->count();
        import('@.ORG.system_page');
        $p = new Page($count, 15);
        $money_list = $database_user_money_list->field(true)->where($condition_user_money_list)->order('`time` DESC')->select();
        $this->assign('pagebar', $p->show());
        $this->assign('money_list', $money_list);
        $this->display();
    }
    
    public function score_list() {
        $this->assign('bg_color', '#F3F3F3');
        $database_user_score_list = D('User_score_list');
        $condition_user_score_list['uid'] = intval($_GET['uid']);
        $count = $database_user_score_list->where($condition_user_score_list)->count();
        import('@.ORG.system_page');
        $p = new Page($count, 15);
        $score_list = $database_user_score_list->field(true)->where($condition_user_score_list)->order('`time` DESC')->select();
        $this->assign('pagebar', $p->show());
        $this->assign('score_list', $score_list);
        $this->display();
    }
    /*     * *导入客户页**** */
    public function import() {
        $this->display();
    }
    /*     * *导入客户页**** */
    public function execimport() {
        if ($_FILES['file']['error'] != 4) {
            $getupload_dir = "/upload/excel/user/" . date('Ymd') . '/';
            $upload_dir = "." . $getupload_dir;
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            import('ORG.Net.UploadFile');
            $upload = new UploadFile();
            $upload->maxSize = 10 * 1024 * 1024;
            $upload->allowExts = array('xls', 'xlsx');
            $upload->allowTypes = array(); // 允许上传的文件类型 留空不做检查
            $upload->savePath = $upload_dir;
            $upload->thumb = false;
            $upload->thumbType = 0;
            $upload->imageClassPath = '';
            $upload->thumbPrefix = '';
            $upload->saveRule = 'uniqid';
            if ($upload->upload()) {
                $uploadList = $upload->getUploadFileInfo();
                require_once APP_PATH . 'Lib/ORG/phpexcel/PHPExcel/IOFactory.php';
                $path = $uploadList['0']['savepath'] . $uploadList['0']['savename'];
                //$reader = PHPExcel_IOFactory::createReader('Excel5');
                $fileType = PHPExcel_IOFactory::identify($path); //文件名自动判断文件类型
                $objReader = PHPExcel_IOFactory::createReader($fileType);
                $excelObj = $objReader->load($path);
                $result = $excelObj->getActiveSheet()->toArray(null, true, true, true);
                if (!empty($result) && is_array($result)) {
                    unset($result[1]);
                    $user_importDb = D('User_import');
                    foreach ($result as $kk => $vv) {
                        if (empty($vv['A']) || empty($vv['B']) || empty($vv['C']))
                            continue;
                        $tmpdata = array();
                        $tmpdata['ppname'] = htmlspecialchars(trim($vv['A']), ENT_QUOTES);
                        $tmpdata['telphone'] = htmlspecialchars(trim($vv['B']), ENT_QUOTES);
                        $tmpdata['address'] = htmlspecialchars(trim($vv['C']), ENT_QUOTES);
                        !empty($vv['D']) && $tmpdata['mer_id'] = intval(trim($vv['D']));
                        !empty($vv['E']) && $tmpdata['memberid'] = htmlspecialchars(trim($vv['E']), ENT_QUOTES);
                        !empty($vv['F']) && $tmpdata['level'] = intval(trim($vv['F']));
                        !empty($vv['G']) && $tmpdata['qq'] = htmlspecialchars(trim($vv['G']), ENT_QUOTES);
                        !empty($vv['H']) && $tmpdata['email'] = htmlspecialchars(trim($vv['H']), ENT_QUOTES);
                        !empty($vv['I']) && $tmpdata['money'] = intval(trim($vv['I']));
                        !empty($vv['J']) && $tmpdata['integral'] = htmlspecialchars(trim($vv['J']), ENT_QUOTES);
                        !empty($vv['K']) && $tmpdata['useraccount'] = htmlspecialchars(trim($vv['K']), ENT_QUOTES);
                        if (!empty($vv['L'])) {
                            $tmpdata['pwdmw'] = trim($vv['L']);
                            $tmpdata['pwd'] = md5($tmpdata['pwdmw']);
                        }
                        $tmpdata['isuse'] = 0;
                        $tmpdata['addtime'] = time();
                        $user_importDb->add($tmpdata);
                    }
                    if (!empty($tmpdata)) {
                        $this->dexit(array('error' => 0));
                    } else {
                        $this->dexit(array('error' => 1, 'msg' => '导入失败！'));
                    }
                }
            } else {
                $this->dexit(array('error' => 1, 'msg' => $upload->getErrorMsg()));
            }
        }
        $this->dexit(array('error' => 1, 'msg' => '文件上传失败！'));
    }


    /**
     * 业主管理
     */
    public function tenant_list_news(){
        $model = new MeterModel();

        //获取入住状态下拉
        $fstatus_list = $model->get_fstatus_list();
        $this->assign('fstatus_list',$fstatus_list);

        //获取社区下拉
        $village_list = $model->get_village_list();
        $this->assign('village_list',$village_list);

        $model = M('house_village_user_bind')->alias('ub');
        // 显示字段
        $field = array(
            'ub.pigcms_id'=>'tid',//业主表主键id
            'ub.usernum',//业主（此处指租户）编号
            'ub.phone'=>'tenant_phone',//租户的电话
            'ub.name'=>'tenant_name',//租户的姓名
            'ub.tenantname',
            'GROUP_CONCAT(f.name ORDER BY f.id)'=>'names',//联系人
            'GROUP_CONCAT(f.phone ORDER BY f.id)'=>'phones',//联系方式
            'v.village_name',//社区ID
            'GROUP_CONCAT(f.fdesc ORDER BY f.id)'=>'floors',//楼层
            'GROUP_CONCAT(f.ownername ORDER BY f.id)'=>'ownernames',//所有业主
            'GROUP_CONCAT(f.housesize ORDER BY f.id)'=>'housesize',//房子大小
            'GROUP_CONCAT(f.property_unit ORDER BY f.id)'=>'property_units',//物业单价
            'GROUP_CONCAT(f.fstatus ORDER BY f.id)'=>'fstatus',//物业单价
            'ub.park_flag',
            'p.usernum'=>'is_enter_paylist',//是否出账
            'p.property_price',//物业费
            'p.electric_price',//电费
            'p.water_price',//水费

        );
        //搜索条件
        $get = search_filter($_GET);
        $map = array();
        if($keywords = $get['keywords']){
            $map['ub.tenantname|f.fdesc'] = array('like','%' . $keywords . '%');
        }else{
            $map['ub.tenantname'] = array('neq',"");//不进行搜索时也要过滤掉业主名为空的数据
        }

        //入住状态
        isset($get['fstatus']) && $map['f.fstatus'] = array('eq' ,$get['fstatus']);

        //社区
        $map['ub.village_id'] = array('eq',4);//默认为广发大厦
        isset($get['village_id']) && $map['ub.village_id'] = array('eq',$get['village_id']);

        //出账状态
        if(isset($get['is_enter_paylist'])){
            if($get['is_enter_paylist']==1){
                $map['p.usernum'] = array('EXP','IS NOT NULL');
            }else{
                $map['p.usernum'] = array('EXP','IS NULL');
            }
        }

        /**
         * 权限配置
         */

//        if(session('system.account')!=="admin"){
//            session('system.village_id') && $map['v.village_id'] = array('eq',session('system.village_id'));
//            if(
//                session('system.company_id')
//                && !in_array(session('system.role_id'),[48,47,46,45,43,42,38])
//            ){
//                session('system.phone') && $map['f.phone|ub.phone'] = array('eq',session('system.phone'));
//            }
//        }
        //多角色权限配置
        $role_idStr = session('system.role_id');
        $role_idArr = explode(',',$role_idStr);
        $intnum = 0;
        foreach ($role_idArr as $v) {
            if (in_array($v,[48,47,46,45,43,42,38])) {
                $intnum++;
            }
        }
        if(session('system.account')!=="admin"){
            session('system.village_id') && $map['v.village_id'] = array('eq',session('system.village_id'));

            if(
                session('system.company_id')
                && !$intnum
            ){
                session('system.phone') && $map['f.phone|ub.phone'] = array('eq',session('system.phone'));
            }
        }
        //当前年月
        $current_date = date("Y-m");
        //计算总条数
        $count_group = $model->field('count(ub.usernum)')
            ->join('left join __HOUSE_VILLAGE_FLOOR__ f on f.tid=ub.pigcms_id and f.tid')
            ->join('left join __HOUSE_VILLAGE__ v on v.village_id=ub.village_id')
            ->join('left join __HOUSE_VILLAGE_USER_PAYLIST__ p on p.usernum=ub.usernum and p.create_date="%s"',$current_date)
            ->where($map)
            ->group('ub.usernum')
            ->select(false);
        //总条数
        $count = $model->query("select count(1) count from ($count_group) c")[0]['count'];
        //分页样式
        import('@.ORG.bootstrap_page');
        //分页类实例化
        $page = new Page($count,9999);// 实例化分页类 传入总记录数和每页显示的记录数
        //列表
        $list = $model->alias('ub')
            ->field($field)
            ->join('left join __HOUSE_VILLAGE_FLOOR__ f on f.tid=ub.pigcms_id')
            ->join('left join __HOUSE_VILLAGE__ v on v.village_id=ub.village_id')
            ->join('left join __HOUSE_VILLAGE_USER_PAYLIST__ p on p.usernum=ub.usernum')
            ->where($map)
            ->group('ub.usernum')
            ->order('ub.pigcms_id desc')
            ->limit($page->firstRow,$page->listRows)
            ->select();

        //处理数据
        foreach($list as &$row){
            if($row['floors']){
                $row['total_housesize'] = 0;
                foreach(explode(',',$row['floors']) as $kk => $rr){
                    $row['concat_info'][] = array(
                        'floor'=>$rr,
                        'name'=>explode(',',$row['names'])[$kk],
                        'phone'=>explode(',',$row['phones'])[$kk],
                        'housesize'=>explode(',',$row['housesize'])[$kk],
                        'property_unit'=>explode(',',$row['property_units'])[$kk]?:"0.00",
                        'fstatus'=>explode(',',$row['fstatus'])[$kk],
                    );
                    //计算总面积
                    $row['total_housesize'] += explode(',',$row['housesize'])[$kk];
                    //删除重复的业主
                    $row['ownernames'] = explode(',',$row['ownernames']);
                    $row['ownernames'] = join(',',array_unique($row['ownernames']));

                }
            }

        }
        $this->assign('list',$list);
        $this->assign('pagebar',$page->show());//页码栏
        $this->display('tenant_list_news');
    }

    /*     * *导入客户的列表页**** */
    public function importlist() {
        $user_importDb = D('User_import');
        $count_userimportDb = $user_importDb->where('22=22')->count();
        import('@.ORG.system_page');
        $p = new Page($count_userimportDb, 20);
        $pagebar = $p->show();
        $this->assign('pagebar', $pagebar);
        $tmpdatas = $user_importDb->where('22=22')->order('id ASC')->limit($p->firstRow . ',' . $p->listRows)->select();
        $this->assign('userimport', $tmpdatas);
        $this->display();
    }
    public function importlist_news() {
        $user_importDb = D('User_import');
        $count_userimportDb = $user_importDb->where('22=22')->count();
        import('@.ORG.system_page');
        $p = new Page($count_userimportDb, 20);
        $pagebar = $p->show();
        $this->assign('pagebar', $pagebar);
        $tmpdatas = $user_importDb->where('22=22')->order('id ASC')->limit(100)->select();
        $this->assign('userimport', $tmpdatas);
        $this->display();
    }
    /*     * *导入客户的列表页**** */
    public function levellist() {
        $user_levelDb = D('User_level');
        $count_userlevelDb = $user_levelDb->count();
        import('@.ORG.system_page');
        $p = new Page($count_userlevelDb, 20);
        $pagebar = $p->show();
        $this->assign('pagebar', $pagebar);
        $tmpdatas = $user_levelDb->where('22=22')->order('id ASC')->limit($p->firstRow . ',' . $p->listRows)->select();
        $this->assign('userlevel', $tmpdatas);
        $this->display();
    }

    public function levellist_news() {
        $user_levelDb = D('User_level');
        $count_userlevelDb = $user_levelDb->count();
        import('@.ORG.system_page');
        $p = new Page($count_userlevelDb, 20);
        $pagebar = $p->show();
        $this->assign('pagebar', $pagebar);
        $tmpdatas = $user_levelDb->where('22=22')->order('id ASC')->limit(100)->select();
        $this->assign('userlevel', $tmpdatas);
        $this->display();
    }
    /*     * *添加等级**** */
    public function addlevel() {
        $levelDb = M('User_level');
        $tmparr = $levelDb->where('22=22')->order('level DESC')->find();
        $level = 0;
        if (!empty($tmparr)) {
            $level = $tmparr['level'];
        }
        $level = $level + 1;
        if (IS_POST) {
            $lid = intval($_POST['lid']);
            if (!($lid > 0)) {
                $newdata = array('level' => $level);
            }
            $lname = trim($_POST['lname']);
            if (empty($lname))
                $this->error('等级名称没有填写！');
            $newdata['lname'] = $lname;
            $integral = intval($_POST['integral']);
            if (!($integral > 0))
                $this->error('等级积分没有填写！');
            $newdata['integral'] = $integral;
            $newdata['icon'] = trim($_POST['icon']);
            $newdata['type'] = trim($_POST['fltype']);
            $newdata['boon'] = trim($_POST['boon']);
            $newdata['description'] = trim($_POST['description']);
            if ($lid > 0) {
                $inser_id = $levelDb->where(array('id' => $lid))->save($newdata);
            } else {
                $inser_id = $levelDb->add($newdata);
            }
            if ($inser_id) {
                $this->success('保存成功！');
            } else {
                $this->error('保存失败！');
            }
        } else {
            $lid = intval($_GET['lid']);
            $tmpdata = $levelDb->where(array('id' => $lid))->find();
            if (empty($tmpdata)) {
                $tmpdata = array('id' => 0, 'level' => $level, 'lname' => '', 'integral' => '', 'icon' => '', 'boon' => '', 'type' => 0, 'description' => '');
            }
            $this->assign('leveldata', $tmpdata);
            $this->display();
        }
    }

    public function addlevel_news() {
        $levelDb = M('User_level');
        $tmparr = $levelDb->where('22=22')->order('level DESC')->find();
        $level = 0;
        if (!empty($tmparr)) {
            $level = $tmparr['level'];
        }
        $level = $level + 1;
        if (IS_POST) {
            $lid = intval($_POST['lid']);
            if (!($lid > 0)) {
                $newdata = array('level' => $level);
            }
            $lname = trim($_POST['lname']);
            if (empty($lname))
                $this->error('等级名称没有填写！');
            $newdata['lname'] = $lname;
            $integral = intval($_POST['integral']);
            if (!($integral > 0))
                $this->error('等级积分没有填写！');
            $newdata['integral'] = $integral;
            $newdata['icon'] = trim($_POST['icon']);
            $newdata['type'] = trim($_POST['fltype']);
            $newdata['boon'] = trim($_POST['boon']);
            $newdata['description'] = trim($_POST['description']);
            if ($lid > 0) {
                $inser_id = $levelDb->where(array('id' => $lid))->save($newdata);
            } else {
                $inser_id = $levelDb->add($newdata);
            }
            if ($inser_id) {
                $this->success('保存成功！');
            } else {
                $this->error('保存失败！');
            }
        } else {
            $lid = intval($_GET['lid']);
            $tmpdata = $levelDb->where(array('id' => $lid))->find();
            if (empty($tmpdata)) {
                $tmpdata = array('id' => 0, 'level' => $level, 'lname' => '', 'integral' => '', 'icon' => '', 'boon' => '', 'type' => 0, 'description' => '');
            }
            $this->assign('leveldata', $tmpdata);
            $this->display();
        }
    }
    /*     * **删除一条导入的记录**** */
    function delimportuser(){
        $idx=(int)trim($_POST['id']);
        $user_importDb=D('User_import');
        if($user_importDb->where(array('id'=>$idx))->delete()){
        	$this->success('删除成功');
        }else{
        	$this->error('删除失败'.$this->_get('id'));
        }
    }
    /*     * json 格式封装函数* */
    private function dexit($data='') {
        if(is_array($data)){
            echo json_encode($data);
        }else{
            echo $data;
        }
        exit();
    }

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

    public function wxHttpsRequest($url, $data = null) {
        $curl = curl_init();
        //curl_setopt($curl, CURLOPT_SAFE_UPLOAD, FALSE); //针对php5.6版本
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        $errorno = curl_errno($curl);
        curl_close($curl);
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
    }
 
}
