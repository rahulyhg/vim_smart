<?php
Class ContractAction extends BaseAction {
    protected $village_id;

    protected $village;



    public function _initialize(){

        parent::_initialize();
        $this->village_id = session('system.village_id');
        $this->village = D('House_village')->field(true)->where(array('village_id'=>$this->village_id))->find();

            if(empty($this->village)){
                $this->error('该小区不存在！');
            }




    }
    //合同列表
    public function contract_news() {
        //导航设置
        $breadcrumb_diy = array(
            array('物业服务'),
            array('合同管理',U('contract_news'))
        );

        //获取筛选id  'check_time'=>array('between',array($nowDays,$nowDaye))
        $contract_time_id = I('get.contract_time_id');       
        $now_time1 = time()-86400;
        $time_now = date('Y-m-d',time());
        $time_start = '1970-01-01';
        $time_now1 = date('Y-m-d',$now_time1);
        // $time_about = date('Y-m-d', strtotime('-1 month', strtotime(date('Y-m-d', time()))));  array('lt',$time_now);
        $time_end = date('Y-m-d', strtotime('+1 month', strtotime(date('Y-m-d', time())))); 

        if ($contract_time_id == 2) {
            $where['hvs.contract_end'] = array('gt',$time_end);
        } elseif ($contract_time_id == 3) {
            $where['hvs.contract_end'] = array('between',array($time_now,$time_end));
        } elseif ($contract_time_id == 4) {
            $where['hvs.contract_end'] = array('between',array($time_start,$time_now1));
        } elseif ($contract_time_id == 5) {
            $where['hvs.contract_end'] = '';
        } else {
            $where['hvs.status'] = '1';
        }
        $this->assign('contract_time_id',$contract_time_id);

        //筛选合同类型
        $type = I('get.contract_type');
        if ($type == 1) {
            $where['hvs.type'] = '收入合同';
            $this->assign('type',1);
        } elseif ($type == 2) {
            $where['hvs.type'] = '支出合同';
            $this->assign('type',2);
        } elseif ($type == 3) {
            $where['hvs.type'] = '其他合同';
            $this->assign('type',3);
        } else {

        }
        
        // 筛选合同分类
        // $type = I('get.contract_type');
        // if ($type) {
        //     $where['hvs.type'] = array('eq',$type);
        // }
        // $this->assign('type',$type); 
        

        
        //条件
        $where['hvs.village_id'] = $this->village_id;
        
        if ($_SESSION['system']['id'] != 1) $this->contract_auth();//权限过滤
        $filed = array(
            'hvs.*',
            'hv.village_name'
        );
        $shequArr = D('house_village_shequ')->alias('hvs')
            ->field($filed)
            ->join('left join __HOUSE_VILLAGE__ hv on hv.village_id = hvs.village_id')
            // ->where(array('hv.village_id'=>$this->village_id))
            ->where($where)
            ->order('hvs.id desc')
            ->select();
        
        //处理合同状态显示
        foreach ($shequArr as $k => $v) {
            $time_start = strtotime($v['contract_start']);
            $time_end = strtotime($v['contract_end']);
            $time_about = strtotime($v['contract_end'])-2592000; //在截止日期上减一个月
            $time_now = time();

            if ($time_end) {
                if (($time_now > $time_start) && ($time_now < $time_about)) {
                    $rate = '1';
                } elseif (($time_now >= $time_about) && ($time_now <= $time_end)) {
                    $rate = '2';
                }  else {
                    $rate = '3';
                }
            } else {
                $rate = '4';
            }            
            $shequArr[$k]['rate'] = $rate;

            // $a = $time_end - $time_start;
            // $b = $time_now - $time_start;
            // if ($b < $a) {
            //     $rate = round(($b / $a) * 100, 0);
            // } else {
            //     $rate = 100;
            // }
            // $shequArr[$k]['rate'] = (int)$rate;
        }
        // var_dump($shequArr);die;
        if ($shequArr) $this->assign('shequArr',$shequArr);
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $this->display();
    }


    /*
     *合同的状态，终止与正常
     */
    public function contract_status(){
        $id = I('post.contract_id');
        $status = I('post.status');
        if ($status == 0) {//合同终止
            $data=array('status'=>1);
            $re=M('house_village_shequ')->where(array('id'=>$id))->data($data)->save();
            echo $re;
        } else {//合同正常
            $data=array('status'=>0);
            $re=M('house_village_shequ')->where(array('id'=>$id))->data($data)->save();
            echo $re;
        }        
    }


    /*
     *合同时长，长期与短期
     */
    public function contract_duration(){
        $id = I('post.contract_id');
        $duration = I('post.duration');
        if ($duration == 2) {//短期合同
            $data=array('duration'=>1);
            $re=M('house_village_shequ')->where(array('id'=>$id))->data($data)->save();
            echo $re;
        } else {//长期合同
            $data=array('duration'=>2);
            $re=M('house_village_shequ')->where(array('id'=>$id))->data($data)->save();
            echo $re;
        }        
    }


    /**
     * 合同详情
     *
     */
    public function contract_detail(){
        $id = I('get.id');
        //条件
        $_map =array('s.id'=>$id);
        //字段
        $field=array(
            's.*',
            'v.village_name',
        );
        //查询当前记录的信息
        $contractRecord = M('house_village_shequ')
            ->alias('s')
            ->field($field)
            // ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
            // ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
            ->join('LEFT JOIN __HOUSE_VILLAGE__ v on v.village_id=s.village_id')
            // ->join('LEFT JOIN __HOUSE_VILLAGE_USER_BIND__ b on b.uid=r.uid')
            ->where($_map)
            ->find();
        
        $this->assign('contractRecord',$contractRecord);
        $this->display();
    }


    public function contract() {
        //导航设置
        $breadcrumb_diy = array(
            array('物业服务'),
            array('合同管理',U('contract_news'))
        );
        if ($_SESSION['system']['id'] != 1) $this->contract_auth();//权限过滤
        $filed = array(
            'hvs.*',
            'hv.village_name'
        );
        $shequArr = D('house_village_shequ')->alias('hvs')
            ->field($filed)
            ->join('left join __HOUSE_VILLAGE__ hv on hv.village_id = hvs.village_id')
            ->where(array('hv.village_id'=>$this->village_id))
            ->select();

        if ($shequArr) $this->assign('shequArr',$shequArr);
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $this->display('contract_news');
    }

    //合同详情页
    public function contract_edit() {
        $breadcrumb_diy = array(
            array('物业服务'),
            array('合同管理',U('contract_news')),
            array('合同修改','#')
        );
        if ($_SESSION['system']['id'] != 1) $this->contract_auth();//权限过滤

        if ($_POST) {
            $id = $_POST['id'];
            if (!$id) $this->error('错误警告',U("Index/contract_news"));
            if(empty($_POST['pic'])){
                $this->error('请至少上传一张图片');
            }
            $data['pic_info'] = implode(';',$_POST['pic']);

            $data['contract_name'] =  $_POST['contract_name'];//合同名称
            $data['contract_start'] =  $_POST['contract_start'];//合同签订时间
            $data['contract_end'] =  $_POST['contract_end'];//合同截止时间

            $data['update_name'] = $_SESSION['system']['realname'];//修改人真实姓名
            $data['update_time'] = time();//修改时间
            $re = D('house_village_shequ')->where(array('id'=>$id))->save($data);

            if ($re) {
                $this->success('修改成功');
            } else {
                $this->error('修改失败');
            }
        } else {
            $id = $_GET['id'];
            if (!$id) $this->error('未选择合同',U("Contract/contract_news"));
            $shequArr = D('house_village_shequ')->where(array('id'=>$id))->find();
            if(!empty($shequArr['pic_info'])){
                $tmp_pic_arr = explode(';',$shequArr['pic_info']);
                foreach($tmp_pic_arr as $key=>$value){
                    $shequArr['pic'][$key]['title'] = $value;
                    $shequArr['pic'][$key]['url'] = $this->get_image_by_path($value);
                }
            }

            if ($shequArr) $this->assign('shequArr',$shequArr);
            $this->assign('breadcrumb_diy',$breadcrumb_diy);
            $this->display();
        }

    }


    /**
     * 物品表格数据导入
     * 第一步上传表格
     */
    public function contract_import_step(){
        //导航设置
        $breadcrumb_diy = array(
            array('物业服务','#'),
            array('合同管理',U('contract_news')),
            array('批量导入','#'),
        );
        $model = new OffModel();
        // $this->assign('village_list',$model->get_village_list());
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $this->display();
    }

    /**
     * 第二步将表格数据表格化
     */
    public function contract_import_step1(){
        //导航设置
        $breadcrumb_diy = array(
            array('物业服务','#'),
            array('合同管理',U('contract_news')),
            array('批量导入','#'),
        );
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        //获取社区名
        $model = new OffModel();
        $file = $_FILES['test'];
        // $village_id = session('system.village_id');
        // $village_name = $model->get_village_list()[$village_id];

        if($file){
            //导入数据
            $list = $model->contract_excel_to_data($file);
            $this->assign_json('list',$list);
            // $this->assign_json('selected_village_id',$village_id);
            // $this->assign_json('selected_village_name',$village_name);
            // $this->assign('selected_village_name',$village_name);
            $this->display();
        }else{
            $this->error("文件格式错误",U('contract_import_step'));
        }

    }

    /**
     * 第三步导入数据
     */
    public function contract_import_step2(){
        $data = $_POST;
        // $id = $_SESSION['system']['id'];
        // var_dump($village_id);exit();
        $data['data'] = json_decode(htmlspecialchars_decode($data['data']),true);
        $model = new OffModel();
         $re = $model->insert_contract_data_to_database($data['data']);
        if($re){
            return $this->success("操作成功","",$data);
        }else{
            $error = $model->get_import_error();
            return $this->error($error['msg'],"",$error['data']);
        }

    }


    /**
     * 传递json数组到模板 通过app_json.name获取
     * @param $name
     * @param array $val
     */
    public function assign_json($name,$val=array()){
        static $is_init = false;
        $name = "app_json.".$name;
        $val = json_encode($val)?:"{}";
        $json_str =  '<script>'.$name.' = '.$val.';</script>';
        if(!$is_init){//第一此传入的时候需要初始化
            $init = '<script>var app_json ={};</script>';
            $json_str = $init . $json_str;
            $is_init = true;
        }
        print_r($json_str);
    }


    //添加合同
    public function contract_add() {
        $breadcrumb_diy = array(
            array('物业服务'),
            array('合同管理',U('contract')),
            array('新增合同','#')
        );
        if ($_SESSION['system']['id'] != 1) $this->contract_auth();//权限过滤

        //查询所有合同
        $contract_array = D('house_village_shequ')->where(array('status'=>'1'))->select();

        //全社区
        $village_array = M('house_village')->where(array('status'=>1))->select();

        if ($_POST) {

            // if(empty($_POST['pic'])){
            //     $this->error('请至少上传一张图片');
            // }
            $data['pic_info'] = implode(';',$_POST['pic']);

            $data['contract_name'] =  $_POST['contract_name'];//合同名称            
            //合同名称不可重复
            if (D('house_village_shequ')->where(array('contract_name'=>$data['contract_name'],'contract_number'=>$data['contract_number']))->find()) $this->error('合同名称不可重复');

            $data['contract_number'] =  $_POST['contract_number'];//合同编号
            $data['first_party'] =  $_POST['first_party'];//合同甲方
            $data['second_party'] =  $_POST['second_party'];//合同乙方
            $data['third_party'] =  $_POST['third_party'];//合同丙方
            $data['contract_time'] =  $_POST['contract_time'];//合同备注
            $data['money'] =  $_POST['money'];//合同金额
            $data['area'] =  $_POST['area'];//合同面积
            $data['operator'] =  $_POST['operator'];//经办人
            // $data['duration'] =  $_POST['duration'];//合同时长
            $data['classify'] =  $_POST['classify'];//合同分类
            // $data['status'] =  $_POST['status'];//合同状态

            $data['contract_start'] =  $_POST['contract_start'];//合同签订时间
            $data['contract_end'] =  $_POST['contract_end'];//合同截止时间
            if ($_POST['village_id']) {
                $data['village_id'] = $_POST['village_id'];//对应社区
            } else {
                $data['village_id'] = '4';//默认社区
            }            
            $data['admin_id'] = $_SESSION['system']['id'];//创建人id
            $data['admin_name'] = $_SESSION['system']['realname'];//创建人姓名
            // $data['status'] = '1';//合同状态设为正常
            $data['create_time'] = time();//创建时间
            $re = D('house_village_shequ')->add($data);

            //关联合同终止
            $relevance_contract_id =  $_POST['relevance_contract_id'];
            if ($re) {
                if ($relevance_contract_id) {
                    $res = D('house_village_shequ')->where(array('id'=>$relevance_contract_id))->save(array('status'=>0));
                }
            }
            

            if ($re) {
                $this->success('添加成功');
            } else {
                $this->error('添加失败');
            }
        } else {
            $this->assign('breadcrumb_diy',$breadcrumb_diy);
            $this->assign('contract_array',$contract_array);
            $this->assign('village_array', $village_array);
            $this->display();
        }

    }

    //删除合同
    public function contract_del() {
        if ($_SESSION['system']['id'] != 1) $this->contract_auth();//权限过滤
        $id = $_GET['id'];
        if (!$id) $this->error('错误警告');
        $pic_info=D('house_village_shequ')->where(array('id'=>$id))->find()['pic_info'];
        $pic_list=explode(';',$pic_info);
        foreach ($pic_list as $v){
            $this->del_image_by_path($v);
        }
        $re = D('house_village_shequ')->where(array('id'=>$id))->delete();
        if ($re) {
            $this->success('删除成功',U('Contract/contract_news'));
        } else {
            $this->error('删除失败',U('Contract/contract_news'));
        }

    }

    /*
     * 删除合同图片
     */

    public function store_ajax_del_pic(){
        $this->del_image_by_path($_POST['path']);
    }

    /*根据商品数据表的图片字段来删除图片*/

    public function del_image_by_path($path){

        if(!empty($path)){

            $image_tmp = explode(',',$path);

            unlink('./upload/store/'.$image_tmp[0].'/'.$image_tmp['1']);
            return true;

        }else{
            return false;

        }

    }

    /*
     * 添加合同图片
     */
    public function store_ajax_upload_pic() {
        $fileArr = $_FILES['imgFile'];
        $type = explode('/',$fileArr['type'])[0];//判断文件类型
//        dump($fileArr);
//        dump(explode('/',$fileArr['type']));exit;
        if ($fileArr['error'] != 4) {
            if ($fileArr['size'] < 500000) {
                $image = D('Image')->handleTwo($this->merchant_session['mer_id'], 'contract', 1);
                if ($image['error']) {
                    exit(json_encode($image));
                } else {
                    $title = $image['title']['imgFile'];
                    $url = $this->get_image_by_path($title);
                    exit(json_encode(array('error' => 0, 'url' => $url, 'title' => $title )));
                }
            } else {
                exit(json_encode(array('error' => 1,'message' =>'文件过大')));
            }
        } else {
            exit(json_encode(array('error' => 1,'message' =>'没有选择文件')));
        }
    }

    /*
    * 查看合同大图
    */
    public function look_img() {
        $url = I('get.url');
        $this->assign('url',$url);
        $this->display();
    }


    /*根据商品数据表的图片字段的一段来得到图片*/

    public function get_image_by_path($path){

        if(!empty($path)){

            $image_tmp = explode(',',$path);

            $return = C('config.site_url').'/upload/contract/'.$image_tmp[0].'/'.$image_tmp['1'];

            return $return;

        }else{

            return false;

        }

    }

    /*
     * 图片上传
     */
    public function upload() {
        import('ORG.Net.UploadFile');
        $upload = new UploadFile();// 实例化上传类
        $upload->maxSize = 3145728;// 设置附件上传大小
        $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->savePath = './upload/';// 设置附件上传目录
        if (!$upload->upload()) {// 上传错误提示错误信息
            $this->error($upload->getErrorMsg());
        } else {// 上传成功 获取上传文件信息
            $info = $upload->getUploadFileInfo();
        }
        return $info;
    }


    //查看合同权限管理
    public function contract_auth() {
        $admin_id = $_SESSION['system']['id'];
        $adminArr = D('admin')->where(array('id'=>$admin_id))->find();
        if ($adminArr['village_id'] != $this->village_id) $this->error('抱歉，您不属于该小区');
        $roleArr = explode(',',$adminArr['role_id']);
        /*if (!in_array(68,$roleArr) && !in_array(78,$roleArr)) {
            $this->error('抱歉，您没有该权限');
        }*/

    }

    //查看城市天气调用接口
//    public function tianqi() {
//        $key = "3eef410048d3cdaf4c22c6bfb055c390";
//        $city_id = "936";//武汉
//        $weather_date = date("Y-m-d");
//        $weather_date = "2018-05-02";
//        $url = "http://v.juhe.cn/historyWeather/weather?key=$key&city_id=$city_id&weather_date=$weather_date";
//        $re = $this->http_get($url);
//        dump($re);
//    }

    //查看省份天气调用接口
    public function tianqiSheng() {
        $key = "3eef410048d3cdaf4c22c6bfb055c390";
        $url = "http://v.juhe.cn/historyWeather/province?key=$key";
        $re = $this->http_get($url);
        dump($re);
    }

    //查看城市天气调用接口
    public function tianqiChengshi() {
        $key = "3eef410048d3cdaf4c22c6bfb055c390";
        $province_id = "13";//湖北
        $url = "http://v.juhe.cn/historyWeather/citys?key=$key&province_id=$province_id";
        $re = $this->http_get($url);
        dump($re);
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