<?php
/**
 * 物业管理模块
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/8
 * Time: 14:18
 * @update-time: 2017-06-08 14:18:20
 * @author: 王亚雄
 */
class PropertyServiceAction extends BaseAction{

    protected $village_id; //社区ID

    protected $village; //社区信息

    protected $is_supper_admin = false;

    protected $house_keeper_sort_id = 26;

    protected $img_dir ="upload/house/";

    public function _initialize(){

        parent::_initialize();

        $this->is_supper_admin = session('system.account')==="admin";


        $pigcms_admin_id = session('system.id');

        $this->village_id = filter_village(0, 2);
        //dump(M()->_sql());exit;

        $this->village = D('House_village')->where(array('village_id'=>$this->village_id))->find();



        if(empty($this->village)){

            $this->error('该小区不存在！');

        }




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
     * 报修管理列表
     */
    public function repair_list(){

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



        $map = array();//条件

        if(!empty(I('get.is_deal')))$map['is_read']=0;

        $map['type'] = 1;

        $map = filter_village($map,1,'');


        $repair_list = D('House_village_repair_list')->getlist($map,500);//取500条

        $this->assign('repair_list',$repair_list);


        $this->display('repair_list');
    }

    /**
     * 投诉管理列表
     */
    public function suggess_list(){


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

        $model = M('house_village_repair_list','pigcms_');
        //根据sort_id过滤显示预约列表
        $sort_arr = array(
            $this->house_keeper_sort_id,
        );
        //计算记录所对应的sort_id
        $map = array();
        //$map['sort_id'] = array('in',$sort_arr);
        $map['hvrl.meal_id'] = array('eq',1006);

        if(!empty(I('get.is_deal')))$map['hvrl.is_read']=0;

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

        $map = filter_village($map,1,'');


        $list = $model->alias('hvrl')
            ->field($field)
            ->join('left join __MEAL__ m on m.meal_id = hvrl.meal_id')
            ->where($map)
            ->order('hvrl.pigcms_id desc')
            ->select();
        foreach($list as $k=>&$v){
            $v['village_name'] = $this->get_village_name($v['village_id']);
        }
        unset($v);

        $this->assign('list',$list);
        $this->display('suggess_list');
    }



    /**
     * 物业缴费新版2.0
     * @author 祝君伟
     * @time 2017年8月7日11:03:43
     */
    public function village_order_list_bck(){
        //获取当前的年月来筛选账单
        $month = I('get.month');
        if(empty($month)){
            //取当前的年月
            $year = date('Y');
            $month = date('m');
        }else{
            //取当前的年
            $year = date('Y');
        }
        //区分超级管理员和普通管理员
        if($_SESSION['system']['account']==SUPER_ADMIN){
            //超级管理员：能看见所有业主（个人/公司）的账单
            //条件
            $map = array(
                'p.ydate'=>$year,
                'p.mdate'=>$month,

            );
        }else{
            //作为其他普通管理员的角色
            //当前物业数据全部取出，只显示每个人当前月份的账单
            $company_id = session('system.company_id');
            $village_id = session('system.village_id');
            if(!empty($company_id)){
                //公司管理员
                $map = array(
                    'p.ydate'=>$year,
                    'p.mdate'=>$month,
                    'b.company_id'=>$company_id
                );
            }else{
                //社区管理员
                $map = array(
                    'p.ydate'=>$year,
                    'p.mdate'=>$month,
                    'b.village_id'=>$village_id
                );
            }
        }

        //字段
        $field=array(
            'p.*',
            'b.village_id',
            'b.company_id',
            'v.village_name',
            'c.company_name'
        );
        //制作分页
        $data_count = M('house_village_user_paylist')
            ->alias('p')
            ->field($field)
            ->join('LEFT JOIN pigcms_house_village_user_bind b on p.bind_id=b.pigcms_id')
            ->join('LEFT JOIN pigcms_house_village v on p.village_id=v.village_id')
            ->join('LEFT JOIN __COMPANY__ c on b.company_id=c.company_id')
            ->where($map)
            ->count();
        //分页样式
        import('@.ORG.bootstrap_page');
        $Page       = new Page($data_count,15);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        //数据展示
        $show_data = M('house_village_user_paylist')
            ->alias('p')
            ->field($field)
            ->join('LEFT JOIN pigcms_house_village_user_bind b on p.bind_id=b.pigcms_id')
            ->join('LEFT JOIN pigcms_house_village v on p.village_id=v.village_id')
            ->join('LEFT JOIN __COMPANY__ c on b.company_id=c.company_id')
            ->where($map)
            ->limit($Page->firstRow.','.$Page->listRows)
            ->select();

        //做特殊字段的处理
        foreach ($show_data as $key=>$value){
            $show_data[$key]['totle_money'] = round($value['water_price'],2)+round($value['electric_price'],2)+round($value['gas_price'],2)+round($value['property_price'],2)+round($value['park_price'],2);
        }

        $this->assign('show_array',$show_data);
        $this->assign('show',$show);
        $this->display('village_order_list');
    }


    public function village_order_list(){
        session('is_o2o_system',1);
        //区分管理员权限

        $user_list = D('House_village_user_bind')->get_super_user_list();

        //vd($village_id);exit;

        $this->assign('user_list',$user_list);

        $this->display('village_order_list');

    }

    public function list_for_more(){

        $usernum = I('get.usernum');

        $user_list = D('House_village_user_bind')->get_this_user_list($usernum);


        $this->assign('user_list',$user_list);

        $this->display('list_for_more');

    }


    /**
     * 用户批量导入新版2.0
     * @author 祝君伟
     * @time 2017年8月8日11:13:18
     */
    public function user_import(){
        if(IS_POST){

            //vd($_POST);exit;
            //区分高级权限

            if(session('system.account')==SUPER_ADMIN){

                //超级权限

                if(empty($_POST['village_id'])){

                    //如果不存在village_id  报错

                    $this->error('没有选择社区');
                }else{

                    $village_id = $_POST['village_id'];

                }

            }else{

                //非超级权限

                $village_id = $this->village_id;

            }



            if ($_FILES['file']['error'] != 4) {

                set_time_limit(0);

                $upload_dir = './upload/excel/villageuser/'.date('Ymd').'/';

                if (!is_dir($upload_dir)) {

                    mkdir($upload_dir, 0777, true);

                }

                import('ORG.Net.UploadFile');

                $upload = new UploadFile();

                $upload->maxSize = 10 * 1024 * 1024;

                $upload->allowExts = array('xls','xlsx');

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

                    $fileType = PHPExcel_IOFactory::identify($path); //文件名自动判断文件类型

                    $objReader = PHPExcel_IOFactory::createReader($fileType);

                    $excelObj = $objReader->load($path);

                    $result = $excelObj->getActiveSheet()->toArray(null, true, true, true);



                    $database_user = D('User');

                    if (!empty($result) && is_array($result)) {

                        unset($result[1]);

                        //vd($result);exit;

                        //定义错误储存数组
                        $err_array = array();

                        foreach ($result as $kk => $vv) {

                            $vv['K'] = intval($vv['K']);


                            if(empty($vv['A']) || empty($vv['B']) || empty($vv['C']) || !isset($vv['D']) || !isset($vv['E']) || !isset($vv['F']) || !isset($vv['G'])|| !isset($vv['H'])|| !isset($vv['I']) || empty($vv['J']) || empty($vv['K'])){

                                $err_array[]=array('err'=>1,'msg'=>'导入信息失败，具体原因为：信息不全。','name'=>htmlspecialchars(trim($vv['B']), ENT_QUOTES));

                                continue;
                            }

                            $tmpdata = array();

                            //$tmpdata['usernum'] = htmlspecialchars(trim($vv['A']), ENT_QUOTES);
                            $tmpdata['phone'] = htmlspecialchars(trim($vv['C']), ENT_QUOTES);
                            //检测用户是否已存在，存在该用户则直接更新信息

                            if(empty($tmpdatap['phone'])&&!isset($tmpdata['phone'])) exit('致命错误');

                            $old_info = D('House_village_user_bind')->where(array('phone'=>$tmpdata['phone']))->find();

                            if($old_info != null){
                                //存在该用户需要更新

                                $tmpdata['name'] = htmlspecialchars(trim($vv['B']), ENT_QUOTES);

                                //中转水费组成
                                $transfer_array = explode("-",htmlspecialchars(trim($vv['D']), ENT_QUOTES));

                                $tmpdata['water_type'] = $transfer_array[1];

                                $tmpdata['water_price'] = $transfer_array[0];

                                //中转电费组成
                                $transfer_array = explode("-",htmlspecialchars(trim($vv['E']), ENT_QUOTES));

                                $tmpdata['electric_type'] = $transfer_array[1];

                                $tmpdata['electric_price'] = $transfer_array[0];

                                //中转燃气费组成
                                $transfer_array = explode("-",htmlspecialchars(trim($vv['F']), ENT_QUOTES));

                                $tmpdata['gas_type'] = $transfer_array[1];

                                $tmpdata['gas_price'] = $transfer_array[0];

                                $tmpdata['is_property'] = htmlspecialchars(trim($vv['G']), ENT_QUOTES);

                                $tmpdata['park_flag'] = htmlspecialchars(trim($vv['H']), ENT_QUOTES);

                                $tmpdata['park_price'] = htmlspecialchars(trim($vv['I']), ENT_QUOTES);

                                $tmpdata['tdesc'] = htmlspecialchars(trim($vv['J']), ENT_QUOTES);

                                $tmpdata['housesize'] = $vv['K'];

                                $tmpdata['contract_start'] = strtotime(htmlspecialchars(trim($vv['L']), ENT_QUOTES));

                                $tmpdata['contract_end'] = strtotime(htmlspecialchars(trim($vv['M']), ENT_QUOTES));

                                $tmpdata['bill_date'] = strtotime(htmlspecialchars(trim($vv['N']), ENT_QUOTES));

                                $tmpdata['property_unit'] = htmlspecialchars(trim($vv['O']), ENT_QUOTES);

                                $tmpdata['tstatus'] = htmlspecialchars(trim($vv['P']), ENT_QUOTES);

                                $tmpdata['village_id'] = $village_id;

                                $company_id = $this->select_this_company(htmlspecialchars(trim($vv['A']), ENT_QUOTES));

                                if($company_id === false){

                                    $tmpdata['company'] = htmlspecialchars(trim($vv['A']), ENT_QUOTES);

                                }else{

                                    $tmpdata['company_id'] = $company_id;

                                }

                                $user = $database_user->get_user($tmpdata['phone'],'phone');

                                if($user){

                                    $tmpdata['uid'] = $user['uid'];

                                }

                                //处理exel数据，分别入库


                                $tenement_insert_array = array(
                                    'usernum'=>$old_info['usernum'],
                                    'water_type'=>$tmpdata['water_type'],
                                    'water_price'=>$tmpdata['water_price'],
                                    'electric_type'=>$tmpdata['electric_type'],
                                    'electric_price'=>$tmpdata['electric_price'],
                                    'gas_type'=>$tmpdata['gas_type'],
                                    'gas_price'=>$tmpdata['gas_price'],
                                    'is_property'=>$tmpdata['is_property'],
                                    'tdesc'=>$tmpdata['tdesc'],
                                    'housesize'=>$tmpdata['housesize'],
                                    'contract_start'=>$tmpdata['contract_start'],
                                    'contract_end'=>$tmpdata['contract_end'],
                                    'bill_date'=>$tmpdata['bill_date'],
                                    'property_unit'=>$tmpdata['property_unit'],
                                    'tstatus'=>$tmpdata['tstatus'],
                                    'uid'=>$tmpdata['uid']?:0
                                );

                                //vd($tenement_insert_array);exit;

                                if(!empty($old_info['pigcms_id'])&&isset($old_info['pigcms_id'])){

                                    $update_res = M('House_village_user_bind_tenement')->data($tenement_insert_array)->add();

                                    if(!$update_res){

                                        $err_array[]=array('err'=>1,'msg'=>'更新信息失败，信息不全。','name'=>$tmpdata['name']);


                                        //$this->error('导入失败');exit;

                                    }else{

                                        $err_array[]=array('err'=>0,'name'=>$tmpdata['name']);


                                    }

                                }


                            }else{

                                $tmpdata['name'] = htmlspecialchars(trim($vv['B']), ENT_QUOTES);

                                $tmpdata['phone'] = htmlspecialchars(trim($vv['C']), ENT_QUOTES);

                                //中转水费组成
                                $transfer_array = explode("-",htmlspecialchars(trim($vv['D']), ENT_QUOTES));

                                $tmpdata['water_type'] = $transfer_array[1];

                                $tmpdata['water_price'] = $transfer_array[0];

                                //中转电费组成
                                $transfer_array = explode("-",htmlspecialchars(trim($vv['E']), ENT_QUOTES));

                                $tmpdata['electric_type'] = $transfer_array[1];

                                $tmpdata['electric_price'] = $transfer_array[0];

                                //中转燃气费组成
                                $transfer_array = explode("-",htmlspecialchars(trim($vv['F']), ENT_QUOTES));

                                $tmpdata['gas_type'] = $transfer_array[1];

                                $tmpdata['gas_price'] = $transfer_array[0];

                                $tmpdata['is_property'] = htmlspecialchars(trim($vv['G']), ENT_QUOTES);

                                $tmpdata['park_flag'] = htmlspecialchars(trim($vv['H']), ENT_QUOTES);

                                $tmpdata['park_price'] = htmlspecialchars(trim($vv['I']), ENT_QUOTES);

                                $tmpdata['tdesc'] = htmlspecialchars(trim($vv['J']), ENT_QUOTES);

                                $tmpdata['housesize'] = $vv['K'];

                                $tmpdata['contract_start'] = strtotime(htmlspecialchars(trim($vv['L']), ENT_QUOTES));

                                $tmpdata['contract_end'] = strtotime(htmlspecialchars(trim($vv['M']), ENT_QUOTES));

                                $tmpdata['bill_date'] = strtotime(htmlspecialchars(trim($vv['N']), ENT_QUOTES));

                                $tmpdata['property_unit'] = htmlspecialchars(trim($vv['O']), ENT_QUOTES);

                                $tmpdata['tstatus'] = htmlspecialchars(trim($vv['P']), ENT_QUOTES);

                                $tmpdata['village_id'] = $village_id;

                                $tmpdata['usernum'] = $this->make_number_no($village_id);

                                $company_id = $this->select_this_company(htmlspecialchars(trim($vv['A']), ENT_QUOTES));

                                if($company_id === false){

                                    $tmpdata['company'] = htmlspecialchars(trim($vv['A']), ENT_QUOTES);

                                }else{

                                    $tmpdata['company_id'] = $company_id;

                                }

                                $user = $database_user->get_user($tmpdata['phone'],'phone');

                                if($user){

                                    $tmpdata['uid'] = $user['uid'];

                                }

                                //处理exel数据，分别入库

                                $bind_insert_array = array(
                                    'name'=>$tmpdata['name'],
                                    'phone'=>$tmpdata['phone'],
                                    'usernum'=>$tmpdata['usernum'],
                                    'village_id'=>$tmpdata['village_id'],
                                    'company_id'=>$tmpdata['company_id']?:null,
                                    'company'=>$tmpdata['company']?:null,
                                    'is_pay_user'=>1
                                );


                                $tenement_insert_array = array(
                                    'usernum'=>$tmpdata['usernum'],
                                    'water_type'=>$tmpdata['water_type'],
                                    'water_price'=>$tmpdata['water_price'],
                                    'electric_type'=>$tmpdata['electric_type'],
                                    'electric_price'=>$tmpdata['electric_price'],
                                    'gas_type'=>$tmpdata['gas_type'],
                                    'gas_price'=>$tmpdata['gas_price'],
                                    'is_property'=>$tmpdata['is_property'],
                                    'tdesc'=>$tmpdata['tdesc'],
                                    'housesize'=>$tmpdata['housesize'],
                                    'contract_start'=>$tmpdata['contract_start'],
                                    'contract_end'=>$tmpdata['contract_end'],
                                    'bill_date'=>$tmpdata['bill_date'],
                                    'property_unit'=>$tmpdata['property_unit'],
                                    'tstatus'=>$tmpdata['tstatus'],
                                    'uid'=>$tmpdata['uid']?:0
                                );
                                /*vd($bind_insert_array);
                                vd($tenement_insert_array);exit();*/

                                $last_user_id = D('House_village_user_bind')->data($bind_insert_array)->add();

                                $last_tent_id = M('house_village_user_bind_tenement')->data($tenement_insert_array)->add();

                                //var_dump($last_tent_id);exit;

                                if(empty($last_user_id)&&empty($last_tent_id)) {

                                    $err_array[] = array('msg' => '名字为：' . $tmpdata['name'] . '录入信息失败，具体原因为：必填数据未填。');

                                    continue;

                                }else if(!empty($last_user_id)&&empty($last_tent_id)){

                                    $err_array[] = array('msg' => '名字为：' . $tmpdata['name'] . '录入详细信息失败，具体原因为：必填数据未填。');

                                    continue;

                                }else if(empty($last_user_id)&&!empty($last_tent_id)){

                                    $err_array[] = array('msg' => '名字为：' . $tmpdata['name'] . '录入基本信息失败，具体原因为：必填数据未填。');

                                    continue;

                                }else{

                                    $err_array[]=array('err'=>0,'name'=>$tmpdata['name']);


                                    continue;

                                }

                            }



                        }

                        //$this->success('导入成功');exit();
                        foreach ($err_array as $key => $value){
                            if($value['name']==''){
                                unset($err_array[$key]);
                            }
                        }

                        $this->assign('err_array',$err_array);

                        $this->display('upload_state');

                    }

                } else {

                    $this->error($upload->getErrorMsg());exit;

                }

            }else{


                $this->error('文件上传失败');exit;
            }



        }else{

            //所有社区的信息

            $village_array = M('house_village')->where(array('status'=>1))->select();

            $this->assign('village_array',$village_array);

            $this->display();

        }

    }


    public function detail_import(){

        if(IS_POST){


            //区分高级权限

            if(session('system.account')==SUPER_ADMIN){

                //超级权限

                if(!isset($_POST['village_id'])&&empty($_POST['village_id'])){

                    //如果不存在village_id  报错

                    $this->error('没有选择社区');
                }else{

                    $village_id = $_POST['village_id'];

                }

            }else{

                //非超级权限

                $village_id = $this->village_id;

            }

            if(!$_POST['paytime']){

                $this->error('请选择时间');exit;

            }

            $yearArray = explode('年', $_POST['paytime']);

            $year = $yearArray[0];

            $m =  str_replace('月', '', $yearArray[1]);



            unset($_POST['paytime']);

            $_POST['ydate'] = $year;

            $_POST['mdate'] = intval($m);



            if ($_FILES['file']['error'] != 4) {

                $upload_dir = './upload/house/excel/paydetail/'.date('Ymd').'/';

                if (!is_dir($upload_dir)) {

                    mkdir($upload_dir, 0777, true);

                }

                import('ORG.Net.UploadFile');

                $upload = new UploadFile();

                $upload->maxSize = 10 * 1024 * 1024;

                $upload->allowExts = array('xls','xlsx');

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

                    $fileType = PHPExcel_IOFactory::identify($path); //文件名自动判断文件类型

                    $objReader = PHPExcel_IOFactory::createReader($fileType);

                    $excelObj = $objReader->load($path);

                    $result = $excelObj->getActiveSheet()->toArray(null, true, true, true);



                    $old_end_user_id = D('House_village_user_paylist')->field('pigcms_id')->order('pigcms_id DESC')->find();



                    if (!empty($result) && is_array($result)) {

                        unset($result[1]);

                        $last_user_id = 0;



                        foreach ($result as $kk => $vv){

                            if(empty($vv['A']) || empty($vv['B']) || empty($vv['C']) || empty($vv['I'])) continue;

                            $tmpdata = array();

                            $tmpdata['mdate'] = $_POST['mdate'];

                            $tmpdata['ydate'] = $_POST['ydate'];

                            $tmpdata['village_id'] = $village_id;


                            $tmpdata['usernum'] = htmlspecialchars(trim($vv['A']), ENT_QUOTES);

                            //检测业主是否已经导入

                            $condition = array('usernum'=>array('eq',$tmpdata['usernum']),'ydate'=>$tmpdata['ydate'],'mdate'=>$tmpdata['mdate']);


                            $pay_list = D('House_village_user_paylist')->where($condition)->find();


                            $conditionBind = array('village_id' => $village_id,'usernum'=>array('eq',$tmpdata['usernum']));

                            $bindInfo = D('House_village_user_bind')->field('`pigcms_id`,`usernum`,`uid`,`housesize`')->where($conditionBind)->find();
                            //dump(M()->_sql());exit;

                            if($pay_list || !$bindInfo){

                                continue;

                            }

                            $tmpdata['name'] = htmlspecialchars(trim($vv['B']), ENT_QUOTES);

                            $tmpdata['phone'] = htmlspecialchars(trim($vv['C']), ENT_QUOTES);

                            $tmpdata['use_water'] = floatval(htmlspecialchars(trim($vv['D']), ENT_QUOTES));

                            $tmpdata['use_electric'] = floatval(htmlspecialchars(trim($vv['E']), ENT_QUOTES));

                            $tmpdata['use_gas'] = floatval(htmlspecialchars(trim($vv['F']), ENT_QUOTES));

                            $tmpdata['use_property'] = intval(htmlspecialchars(trim($vv['G']), ENT_QUOTES));

                            $tmpdata['use_park'] = intval(htmlspecialchars(trim($vv['H']), ENT_QUOTES));

                            $tmpdata['address'] = htmlspecialchars(trim($vv['I']), ENT_QUOTES);

                            $tmpdata['bind_id'] = $bindInfo['pigcms_id'];

                            $tmpdata['uid'] = $bindInfo['uid'];

                            $tmpdata['add_time'] = $_SERVER['REQUEST_TIME'];



                            if($tmpdata['use_water']){

                                $tmpdata['water_price'] = $tmpdata['use_water']*$this->village['water_price'];

                                //D('House_village_user_bind')->where($conditionBind)->setInc('water_price',$tmpdata['water_price']);

                            }

                            if($tmpdata['use_electric']){

                                $tmpdata['electric_price'] = $tmpdata['use_electric']*$this->village['electric_price'];

                                //D('House_village_user_bind')->where($conditionBind)->setInc('electric_price',$tmpdata['electric_price']);

                            }

                            if($tmpdata['use_gas']){

                                $tmpdata['gas_price'] = $tmpdata['use_gas']*$this->village['gas_price'];

                                //D('House_village_user_bind')->where($conditionBind)->setInc('gas_price',$tmpdata['gas_price']);

                            }

                            if($tmpdata['use_property']){

                                //$tmpdata['property_price'] = $tmpdata['use_property'];
                                $tmpdata['property_price'] = $this->village['property_price']*$bindInfo['housesize'];

                                //D('House_village_user_bind')->where($conditionBind)->setInc('property_price',$tmpdata['property_price']);

                            }

                            if($tmpdata['use_park']){

                                $tmpdata['park_price'] = $this->village['park_price'];

                                //D('House_village_user_bind')->where($conditionBind)->setInc('park_price',$this->village['park_price']);

                            }

                            //dump($tmpdata);

                            $last_user_id = D('House_village_user_paylist')->data($tmpdata)->add();

                        }

                        //vd($tmpdata);exit;

                        if(!empty($last_user_id)){

                            // 模板消息

                            $this->success('导入成功');



                        }else{

                            $this->error('导入失败');exit;

                        }

                    }

                } else {

                    $this->error($upload->getErrorMsg());exit;

                }

            }

            $this->error('文件上传失败');exit;

        }else{

            //所有社区的信息

            $village_array = M('house_village')->where(array('status'=>1))->select();

            $this->assign('village_array',$village_array);

            $this->display();

        }

    }


    /**
     * 制作物业编号
     * 编号规则：项目名称大写+时间+四位随机
     * @param $village_id
     * @return string
     */
    protected function make_number_no($village_id){
        //获取当前社区的信息
        $village_info = M('house_village')->find($village_id);
        //项目名称大写
        $top_str = strtoupper($village_info['account']);
        //标准时间
        $date = date('YmdHis');
        //编号
        $number_no = $top_str.$date.rand(1000,9999);

        return $number_no;

    }

    /**
     * 查询当前公司的id
     * @param $company_name
     * @return bool
     */
    protected function select_this_company($company_name){
        //获取当前公司的名称和id
        $company_info = M('company')->where(array('company_name'=>$company_name))->find();

        if($company_info == null){
            //未找到当前的公司
            return false;
        }else{
            return $company_info['company_id'];
        }
    }


    /**
     * 增加单个业主
     * @author 祝君伟
     * @time 2017年8月8日16:57:00
     */
    public function add_bindUser(){
        if(IS_POST){
            //执行添加
            $data = $_POST;
            if($data['company_id']==''){
                //表示没有匹配到当前的公司，先行添加公司
                //获取当前公司的首字母大写
                import('@.ORG.Pinyin');
                $pinyin = new CUtf8_PY();
                $first_word =substr(strtoupper($pinyin->encode($data['company_name'])),0,1);
                //制作公司添加数组
                $company_array = array(
                    'company_name'=>$data['company_name'],
                    'village_id'=>$this->village_id,
                    'company_phone'=>$data['phone'],
                    'add_time'=>time(),
                    'company_first'=>$first_word,
                    'is_admin'=>1,
                    'floor'=>$data['floor']
                );
                $company_id = M('company')->data($company_array)->add();
                if($company_id){
                    //插入成功
                    $bind_array = array(
                        'village_id'=>$this->village_id,
                        'usernum'=>$this->make_number_no($this->village_id),
                        'name'=>$data['name'],
                        'phone'=>$data['phone'],
                        'housesize'=>$data['housesize'],
                        'water_price'=>$data['water_price'],
                        'electric_price'=>$data['electric_price'],
                        'gas_price'=>$data['gas_price'],
                        'park_price'=>$data['park_price'],
                        'property_price'=>$data['property_price'],
                        'add_time'=>time(),
                        'company_id'=>$company_id,
                    );
                    //添加到业主表中
                    $res = M('house_village_user_bind')->data($bind_array)->add();
                    if($res){
                        $this->success('添加成功');
                    }else{
                        $this->error('添加失败');
                    }
                }else{
                    $this->error('公司添加失败');
                }
            }else{
                //制作业主添加数组
                $bind_array = array(
                    'village_id'=>$this->village_id,
                    'usernum'=>$this->make_number_no($this->village_id),
                    'name'=>$data['name'],
                    'phone'=>$data['phone'],
                    'housesize'=>$data['housesize'],
                    'water_price'=>$data['water_price'],
                    'electric_price'=>$data['electric_price'],
                    'gas_price'=>$data['gas_price'],
                    'park_price'=>$data['park_price'],
                    'property_price'=>$data['property_price'],
                    'add_time'=>time(),
                    'company_id'=>$data['company_id'],
                );
                //添加到业主表中
                $res = M('house_village_user_bind')->data($bind_array)->add();
                if($res){
                    $this->success('添加成功');
                }else{
                    $this->error('添加失败');
                }
            }
        }else{
            //执行显示
            $this->display();
        }

    }


    /**
     * 自动完成公司
     *
     */
    public function autocomplete_company(){
        $keyword = I('get.query');
        //制作查询语句
        $map['company_name']=array('like','%'.$keyword.'%');
        $keyword_array = M('company')->where($map)->limit(5)->order('company_id desc')->select();
        foreach ($keyword_array as $value){
            $result_array[] =array(
                'label'=>$value['company_name'],
            );
        }
        echo json_encode($result_array);
    }


    /**
     * 获取当前的公司信息
     */
    public function check_this_company(){
        $company_name = I('post.company_name');
        $company_info = M('company')->where(array('village_id'=>$this->village_id,'company_name'=>$company_name))->find();
        if($company_info == null){
            echo json_encode(array('error'=>1));
        }else{
            $res_array = array(
                'error'=>0,
                'floor'=>$company_info['floor'],
                'company_id'=>$company_info['company_id']
            );
            echo json_encode($res_array);
        }
    }


    /**
     * 缴费历史详细信息
     */
    public function order_history(){
        $bind_id = I('get.bind_id');
        $order_count = M('house_village_pay_order')->where(array('bind_id'=>$bind_id,'paid'=>1))->count();
        import('@.ORG.merchant_page');
        $p = new Page($order_count,15,'page');
        $order_array = M('house_village_pay_order')
            ->where(array('bind_id'=>$bind_id,'paid'=>1))
            ->order('`order_id` DESC')
            ->limit($p->firstRow.','.$p->listRows)
            ->select();
        if($order_array){
            $return['totalPage'] = ceil($order_count/15);
            $return['user_count'] = count($order_array);
            $return['pagebar'] = $p->show();
            $return['user_list'] = $order_array;
        }
        $this->assign('user_list',$return);
        $this->display();
    }


    /**
     * 每月账单预览
     * @author 祝君伟
     * @time  2017年8月14日15:59:57
     */
    public function exit_xls_bak(){
        //条件
        $_map = array(
            'water_price'=>array('EXP','IS NOT NULL')
        );
        //区分高级权限
        if($_SESSION['system']['account'] == SUPER_ADMIN){
            $village_id = isset($_GET['village_id'])?$_GET['village_id']:4;
        }else{
            $village_id = isset($_GET['village_id'])?$_GET['village_id']:$this->village_id;
            if($_SESSION['system']['village_id']!=null&&$_SESSION['system']['company_id']!=null){
                //公司管理员
                $_map['village_id']=array('b.village_id'=>$village_id);
                $_map['company_id']=array('b.company_id'=>$_SESSION['system']['company_id']);
            }else if($_SESSION['system']['village_id']!=null&&$_SESSION['system']['company_id']==null){
                //社区管理员
                $_map['village_id']=array('b.village_id'=>$village_id);
            }
        }



        $village_info = M('house_village')->find($village_id);

        if($village_info['bill_begin_time'] != date('d')){
            $this->assign('is_create',0);
        }else{
            $this->assign('is_create',1);
        }
        //当前管理员的身份默认为社区管理员
        //查询该社区下的所有信息





        $pageSize = 15;
        $count_user = M('house_village_user_bind')
            ->alias('b')
            ->field(array('b.*','c.company_name'))
            ->join('LEFT JOIN __COMPANY__ c on b.company_id=c.company_id')
            ->where($_map)
            ->count();

        import('@.ORG.merchant_page');
        $p = new Page($count_user,$pageSize,'page');
        $user_list = M('house_village_user_bind')
            ->alias('b')
            ->field(array('b.*','c.company_name'))
            ->join('LEFT JOIN __COMPANY__ c on b.company_id=c.company_id')
            ->where($_map)
            ->order('`pigcms_id` DESC')
            ->limit($p->firstRow.','.$p->listRows)
            ->select();
        //当前应查表的月份
        $now_month = strtotime(date('Y-m'));
        $end_month = strtotime(date('Y-m-t'));
        //查询如果已经有当月的账单就不能保存账单,查询当前月份的读表信息
        foreach ($user_list as $key=>$value){
            //查询是否已经有当前账单了
            $user_now_order = M('house_village_user_paylist')->where(array('usernum'=>$value['usernum'],'ydate'=>date('Y'),'mdate'=>date('m')))->find();
            if($user_now_order){
                $user_list[$key]['has_save'] = 1;
            }else{
                //没有当前账单的时候直接查询是否有当月的查表信息
                //组织查表条件
                $map = array(
                    'usernum'=>$value['usernum'],

                    'create_time'=>array('between',array($now_month,$end_month)),

                );

                $water_meter_data = M('re_setmeter')->where($map)->where(array('device_name'=>M('re_setmeter_config')->getFieldById($value['water_type'],'sign')))->order('create_time desc')->find();

                //vd(M()->_sql());exit;

                $gas_meter_data = M('re_setmeter')->where($map)->where(array('device_name'=>M('re_setmeter_config')->getFieldById($value['gas_type'],'sign')))->order('create_time desc')->find();



                $electricity_meter_data = M('re_setmeter')->where($map)->where(array('device_name'=>M('re_setmeter_config')->getFieldById($value['electric_type'],'sign')))->order('create_time desc')->find();


                //水费单价

                $waterUnitPrice = _filterPriceType($water_meter_data['device_name'],$value['village_id']);

                //电费单价

                $electUnitPrice = _filterPriceType($electricity_meter_data['device_name'],$value['village_id']);

                //燃气费单价

                $gasUnitPrice = _filterPriceType($gas_meter_data['device_name'],$value['village_id']);

                //vd($waterUnitPrice);

                $water_mater_price = !empty($water_meter_data)?$water_meter_data['consume']*$waterUnitPrice:0;

                $gas_mater_price = !empty($gas_meter_data)?$gas_meter_data['consume']*$gasUnitPrice:0;

                $electricity_mater_price = !empty($electricity_meter_data)?$electricity_meter_data['consume']*$electUnitPrice:0;

                $user_list[$key]['now_water_price'] = $water_mater_price;

                $user_list[$key]['now_electric_price'] = $electricity_mater_price;

                $user_list[$key]['now_gas_price'] = $gas_mater_price;

                $user_list[$key]['has_save'] = 0;

                //vd($gas_mater_price);exit();

            }

        }

        if($user_list){
            $return['totalPage'] = ceil($count_user/$pageSize);
            $return['user_count'] = count($user_list);
            $return['pagebar'] = $p->show();
            $return['user_list'] = $user_list;
        }


        //所有社区的信息

        $village_array = M('house_village')->where(array('status'=>1))->select();

        $this->assign('village_array',$village_array);

        //vd($return);
        $this->assign('village_user_array',$return);
        $this->display();

    }





    /**
     * 完成批量导入账单
     * @author 祝君伟
     * @time 2017.8.18
     */
    public function complete_all_order(){
        //区分高级权限
        if($_SESSION['system']['account'] == SUPER_ADMIN){
            $village_id = I('get.village_id');
            if(empty($village_id)){
                $this->error('请先选择社区',U('exit_xls'));
            }
        }else{
            //当前的社区id
            $village_id = $this->village_id;
        }


        //小区信息
        $village_info = M('house_village')->find($village_id);

        if($village_info['bill_begin_time'] != date('d')){
            $this->error('当前日期不是生成订单日！',U('exit_xls'));
        }

        //查询社区下所有的业主信息
        $user_list = M('house_village_user_bind')
            ->alias('b')
            ->field(array('b.*','c.company_name'))
            ->join('LEFT JOIN __COMPANY__ c on b.company_id=c.company_id')
            ->where('water_price is not null and b.village_id='.$village_id)
            ->order('`pigcms_id` DESC')
            ->select();

        //当前应查表的月份
        $now_month = strtotime(date('Y-m'));
        $end_month = strtotime(date('Y-m-t'));
        //该社区下的所有业主的账单信息
        foreach ($user_list as $key=>$value){
            $user_now_order = M('house_village_user_paylist')->where(array('usernum'=>$value['usernum'],'ydate'=>date('Y'),'mdate'=>date('m')))->find();

            if(!$user_now_order){
                //没有账单的，添加账单
                //组织查表条件
                $map = array(
                    'usernum'=>$value['usernum'],

                    'create_time'=>array('between',array($now_month,$end_month)),

                );

                $water_meter_data = M('re_setmeter')->where($map)->where(array('device_name'=>M('re_setmeter_config')->getFieldById($value['water_type'],'sign')))->order('create_time desc')->find();

                //vd(M()->_sql());exit;

                $gas_meter_data = M('re_setmeter')->where($map)->where(array('device_name'=>M('re_setmeter_config')->getFieldById($value['gas_type'],'sign')))->order('create_time desc')->find();



                $electricity_meter_data = M('re_setmeter')->where($map)->where(array('device_name'=>M('re_setmeter_config')->getFieldById($value['electric_type'],'sign')))->order('create_time desc')->find();


                //水费单价

                $waterUnitPrice = _filterPriceType($water_meter_data['device_name'],$value['village_id']);

                //电费单价

                $electUnitPrice = _filterPriceType($electricity_meter_data['device_name'],$value['village_id']);

                //燃气费单价

                $gasUnitPrice = _filterPriceType($gas_meter_data['device_name'],$value['village_id']);

                //vd($waterUnitPrice);

                $water_mater_price = !empty($water_meter_data)?$water_meter_data['consume']*$waterUnitPrice:0;

                $gas_mater_price = !empty($gas_meter_data)?$gas_meter_data['consume']*$gasUnitPrice:0;

                $electricity_mater_price = !empty($electricity_meter_data)?$electricity_meter_data['consume']*$electUnitPrice:0;

                //小区信息

                //$park_price = round($village_info['park_price'],2);

                $property_price = round($value['housesize']*$village_info['property_price'],2);

                //制作插入数组

                $add_array = array(
                    'village_id'=>$village_id,
                    'usernum'=>$value['usernum'],
                    'name'=>$value['name'],
                    'phone'=>$value['phone'],
                    'address'=>$value['address']?:'',
                    'bind_id'=>$value['pigcms_id'],
                    'ydate'=>date('Y'),
                    'mdate'=>date('m'),
                    'add_time'=>time(),
                    'use_water'=>$water_meter_data['consume']?:0,
                    'use_electric'=>$electricity_meter_data['consume']?:0,
                    'use_gas'=>$gas_meter_data['consume']?:0,
                    'use_park'=>0,
                    'use_property'=>1,
                    'water_price'=>$water_mater_price,
                    'electric_price'=>$electricity_mater_price,
                    'gas_price'=>$gas_mater_price,
                    'park_price'=>0,
                    'property_price'=>$property_price,
                );

                $res = M('house_village_user_paylist')->data($add_array)->add();
                if($res){
                    //插入成功
                    $err_array[]=array('err'=>0,'name'=>$value['name']);
                }else{
                    //插入失败
                    $err_array[]=array('msg'=>'名字为：'.$value['name'].'录入信息失败，具体原因为：非空字段为空。');
                }

            }
        }

        foreach ($err_array as $key => $value){
            if($value['name']==''){
                unset($err_array[$key]);
            }
        }

        $this->assign('err_array',$err_array);

        $this->display('upload_state');

    }


    /**
     * 账单单个保存
     * @author 祝君伟
     * @time 2017年8月16日10:25:33
     */
    public function ajax_complete_order(){
        //准备入表数据
        //查询当前的小区单价信息

        //查询当前业主的信息
        $usernum = I('post.usernum');
        $user_bind_info = M('house_village_user_bind')->where(array('usernum'=>$usernum))->find();
        $village_info = M('house_village')->find($user_bind_info['village_id']);
        //准备金额数据
        $order_price = I('post.string');
        $is_property = I('post.is_property');
        $is_park = I('post.is_park');
        $order_array = explode("\n",$order_price);
        $water_price = mb_substr(explode("：",$order_array[0])[1],1);
        $electric_price = mb_substr(explode("：",$order_array[1])[1],1);
        $gas_price = mb_substr(explode("：",$order_array[2])[1],1);
        $property_price = empty($is_property)?0:round($user_bind_info['housesize']*$village_info['property_price'],2);
        $park_price = empty($is_park)?0:round($village_info['park_price'],2);
        //制作账单表结构对应数组
        $add_array = array(
            'village_id'=>$user_bind_info['village_id'],
            'usernum'=>$usernum,
            'name'=>$user_bind_info['name'],
            'phone'=>$user_bind_info['phone'],
            'address'=>$user_bind_info['address']?:'',
            'bind_id'=>$user_bind_info['pigcms_id'],
            'ydate'=>date('Y'),
            'mdate'=>date('m'),
            'add_time'=>time(),
            'use_water'=>round($water_price/$village_info['water_price'],2),
            'use_electric'=>round($electric_price/$village_info['electric_price'],2),
            'use_gas'=>round($gas_price/$village_info['gas_price'],2),
            'use_park'=>$is_park,
            'use_property'=>$is_property,
            'water_price'=>$water_price,
            'electric_price'=>$electric_price,
            'gas_price'=>$gas_price,
            'park_price'=>$park_price,
            'property_price'=>$property_price,
        );
        //vd($add_array);
        $res = M('house_village_user_paylist')->data($add_array)->add();
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }

    public function edit(){

        if(IS_POST){

            $condition['usernum'] = $_POST['usernum'];

            $condition['pigcms_id'] = $_POST['pigcms_id'];

            // $condition['village_id'] = $this->village_id;



            $_POST['add_time'] = $_SERVER['REQUEST_TIME'];

            /*vd($condition);
            vd($_POST);exit;*/

            if(D('House_village_user_bind')->where($condition)->data($_POST)->save()){

                $this->success('保存成功',U('village_order_list'));

                exit;

            }

            $this->error('保存失败');

            exit;

        }else{


            //获取高级搜索选项值
            $model = new MeterModel();

            //获取入住状态
            $fstatus_list = $model->get_fstatus_list();
            $this->assign('fstatus_list',$fstatus_list);

            //获取社区
            $village_list = $model->get_village_list();
            $this->assign('village_list',$village_list);

            $model = M('house_village_user_bind')->alias('ub');
            // 显示字段
            $field = array(
                'ub.pigcms_id'=>'tid',//业主表主键id
                'ub.usernum',//业主（此处指租户）编号
                'ub.phone'=>'tenant_phone',//租户的电话
                'ub.name'=>'tenant_name',
                // 'if(f.property_unit,f.property_unit,0.00)'=>'property_unit',
                'ub.tenantname',
                'GROUP_CONCAT(f.name ORDER BY f.id)'=>'names',//联系人
                'GROUP_CONCAT(f.phone ORDER BY f.id)'=>'phones',//联系方式
                'v.village_name',//社区ID
                'GROUP_CONCAT(f.fdesc ORDER BY f.id)'=>'floors',//楼层
                'GROUP_CONCAT(f.fstatus ORDER BY f.id)'=>'fstatus',//房屋状态
                'GROUP_CONCAT(f.contract_start ORDER BY f.id)'=>'contract_start',//合同开始日期
                'GROUP_CONCAT(f.contract_end ORDER BY f.id)'=>'contract_end',//合同结束日期
                'GROUP_CONCAT(f.property_start ORDER BY f.id)'=>'property_start',//物业费起算日期
                'GROUP_CONCAT(f.housesize ORDER BY f.id)'=>'housesize',//房子大小
                'GROUP_CONCAT(f.property_unit ORDER BY f.id)'=>'property_units',//物业单价
                'GROUP_CONCAT(f.id ORDER BY f.id)'=>'fid',//floors 的主键
                'GROUP_CONCAT(f.name ORDER BY f.id)'=>'relation_name',//floors 的主键
                'ub.park_flag',
                'p.usernum'=>'is_enter_paylist'

            );
            //条件
            $map = array();
            /**
             * 权限配置
             */
            if(session('system.account')!=="admin"){
                session('system.village_id') && $map['v.village_id'] = array('eq',session('system.village_id'));
                if(
                    session('system.company_id')
                    && !in_array(session('system.role_id'),[48,47,46,45,43,42,38])
                ){
                    session('system.phone') && $map['f.phone|ub.phone'] = array('eq',session('system.phone'));
                }
            }
            $map['ub.tenantname'] = array('neq',"");
            $map['ub.usernum'] = array('eq',I('get.usernum'));
            $current_date = date("Y-m");

            $list = $model->alias('ub')
                ->field($field)
                ->join('left join __HOUSE_VILLAGE_FLOOR__ f on f.tid=ub.pigcms_id')
                ->join('left join __HOUSE_VILLAGE__ v on v.village_id=ub.village_id')
                ->join('left join __HOUSE_VILLAGE_USER_PAYLIST__ p on p.usernum=ub.usernum and p.create_date="%s"',$current_date)
                ->where($map)
                ->group('ub.usernum')
                ->find();

            //根据情况进行分割
            if(strpos($list['floors'],',')){
                $list['floors'] = explode(',',$list['floors']);
                $list['phones'] = explode(',',$list['phones']);
                //$list['fstatus'] = explode(',',$list['fstatus']);
                $list['contract_start'] = explode(',',$list['contract_start']);
                $list['contract_end'] = explode(',',$list['contract_end']);
                $list['property_start'] = explode(',',$list['property_start']);
                $list['housesize'] = explode(',',$list['housesize']);
                $list['property_units'] = explode(',',$list['property_units']);
                $list['fid'] = explode(',',$list['fid']);
                $list['relation_name'] = explode(',',$list['relation_name']);
            }
            //vd($list);exit;
            $this->assign('list',$list);
            $this->display();

        }

    }

    public function edit_this(){
        $id = I('post.id');
        $field = I('post.field');
        $value= I('post.value');
        if(!isset($id)||empty($id)) exit();
        $res = M('house_village_floor')->where(array('id'=>array('eq',$id)))->data(array($field=>$value))->save();
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }


    public function update_this(){
        $id = I('post.id');
        $field = I('post.field');
        $value= I('post.value');
        if(!isset($id)||empty($id)) exit();
        if($field == 'fstatus'){
            //单独处理房屋状态
            //查询当前的bind_id
            $bind_id = M('house_village_user_bind')->getByUsernum($id)['pigcms_id'];
            $res = M('house_village_floor')->where(array('tid'=>array('eq',$bind_id)))->data(array('fstatus'=>$value))->save();
        }else{
            $res = M('house_village_user_bind')->where(array('usernum'=>array('eq',$id)))->data(array($field=>$value))->save();
        }

        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }



    /**
     * 支付当前订单
     */
    public function pay_order_bck(){
        $type = I('get.type');
        $bind_id = I('get.order_id');
        $order_no = session('chinaPay.MerOrderNo');
        if(session('chinaPay.OrderStatus') == '0000'){
            //支付完全成功
            //支付完成后制作维护列表
            $order_update_array = array(
                'pay_time'=>time(),
                'paid'=>1,
            );
            if(empty($order_no)&&!isset($order_no)) exit('系统出错');
            $res = M('house_village_pay_order')->where(array('order_no'=>$order_no))->data($order_update_array)->save();
            if($res){
                switch ($type)
                {
                    case 'water':
                        $up_arr = array('water_price'=>0);
                        break;
                    case 'electric':
                        $up_arr = array('electric_price'=>0);
                        break;
                    case 'gas':
                        $up_arr = array('gas_price'=>0);
                        break;
                    case 'park':
                        $up_arr = array('park_price'=>0);
                        break;
                    case 'property':
                        $up_arr = array('property_price'=>0);
                        break;
                    case 'all':
                        $up_arr = array(
                            'water_price'=>0,
                            'electric_price'=>0,
                            'gas_price'=>0,
                            'park_price'=>0,
                            'property_price'=>0
                        );
                }
                if(empty($bind_id)&&!isset($bind_id))exit('系统出错');
                $b_res = M('house_village_user_bind')->where(array('pigcms_id'=>$bind_id))->data($up_arr)->save();
                if($b_res){
                    //维护字段成功，完全成功
                    $this->success('支付成功');
                }else{
                    //维护字段失败，不完全成功
                    $this->error('支付出错');
                }
            }else{
                //维护字段失败，不完全成功
                $this->error('支付出错');
            }
        }else{
            //支付未成功
            $this->error('支付失败');

        }

    }

    public function pay_order(){
        $order_no = session('chinaPay.MerOrderNo');
        if(session('chinaPay.OrderStatus') == '0000'){
            //支付已经完全成功
            //支付完成后制作维护列表
            $order_update_array = array(
                'pay_time'=>time(),
                'is_pay'=>1,
            );
            if(empty($order_no)&&!isset($order_no)) exit('系统出错');
            $res = M('house_village_pay_order')->where(array('order_no'=>$order_no))->data($order_update_array)->save();
            if($res){
                $this->success('支付成功',U('tenant_list'));
            }else{
                $this->error('支付成功，维护字段失败',U('tenant_list'));
            }
        }else{
            $this->error('支付失败',U('tenant_list'));
        }

    }


    /*
     * 缴费明细列表
     * */
    public function pay_order_list(){
        $id = I('get.id');
        if($_SESSION['system']['account']==SUPER_ADMIN){
            //超级管理员所看到的页面
            $field = array(
                'p.*',
                'a.realname',
                'v.village_name',
                'u.nickname'
            );
            //在电脑端就只查admin_id
            $order_list = M('house_village_pay_order')
                ->alias('p')
                ->field($field)
                ->join('left join __ADMIN__ a on p.admin_id=a.id')
                ->join('left join pigcms_house_village v on p.village_id=v.village_id')
                ->join('left join pigcms_user u on p.uid=u.uid')
                ->where(array('p.admin_id'=>$id))
                ->select();
            //vd($order_list);exit;
        }else{
            //非超级管理员所看到的页面
            $field = array(
                'p.*',
                'a.realname',
                'v.village_name',
            );
            //在电脑端就只查admin_id
            $order_list = M('house_village_pay_order')
                ->alias('p')
                ->field($field)
                ->join('left join __ADMIN__ a on p.admin_id=a.id')
                ->join('left join pigcms_house_village v on p.village_id=v.village_id')
                ->where(array('p.admin_id'=>$id))
                ->select();
            //vd($order_list);exit;

        }
        $this->assign('order_list',$order_list);
        $this->display();
    }

    /**
     * 查看详情
     */
    public function info(){

        $bind_id = $_GET['bindid']?intval($_GET['bindid']):0;

        $cms_id = $_GET['pid']?intval($_GET['pid']):0;

        //$village_id = $this->village_id;

        $condition['bind_id'] = $bind_id;

        $condition['pigcms_id'] = $cms_id;

        //$condition['village_id'] = $village_id;



        $repair = D('House_village_repair_list')->getlist($condition,1);
//        dump($repair); exit();
        $this->assign('repair',$repair['repair_list'][0]);

//        if($bind_id && $cms_id){
//
//
//
//        }



        $this->display();

    }


    /**
     * 标记为已处理
     */
    public function do_repair(){
        if(IS_AJAX){
            $village_id = $this->village_id;
            $bind_id = $_POST['bind_id']?intval($_POST['bind_id']):0;
            $cms_id = $_POST['cid']?intval($_POST['cid']):0;
            if(true){
                //$data['village_id'] = $this->village_id;
                //$data['bind_id'] = $bind_id;
                $data['pigcms_id'] = $cms_id;
                $result = D('House_village_repair_list')->where($data)->data(array('is_read'=>1))->save();
                if($result !== false){
                    $this->ajaxReturn(array('error'=>0,'mysql_error'=>mysql_error()));
                }
                $this->ajaxReturn(array('msg'=>'处理失败请重试','error'=>1));
            }else{
                $this->ajaxReturn(array('msg'=>'信息有误','error'=>1));
            }
            exit;
        }else{
            $this->display();
        }
    }


    /**
     * 在线预约
     */
    public function appointment_list(){

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

        $model = M('house_village_repair_list','pigcms_');
        //根据sort_id过滤显示预约列表
        $sort_arr = array(
            $this->house_keeper_sort_id,
        );
        //计算记录所对应的sort_id
        $map = array();
        //$map['sort_id'] = array('in',$sort_arr);
        $map['hvrl.meal_id'] = array(
            array('neq',0),
            array('neq',1006),
            'and'
        );

        if(!empty(I('get.is_deal')))$map['hvrl.is_read']=0;

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

        $map = filter_village($map,1,'');


        $list = $model->alias('hvrl')
            ->field($field)
            ->join('left join __MEAL__ m on m.meal_id = hvrl.meal_id')
            ->where($map)
            ->order('hvrl.pigcms_id desc')
            ->select();
        foreach($list as $k=>&$v){
            $v['village_name'] = $this->get_village_name($v['village_id']);
        }
        unset($v);

        $this->assign('list',$list);
        $this->display('appointment_list');
    }

    /**
     * 在线预约>>>标记为已读
     */
    public function is_read(){
        $pigcms_id = I('post.pigcms_id',0,'intval');
        $res = M('house_village_repair_list')->where('pigcms_id=%d',$pigcms_id)->setField('is_read',1);
        if($res){
            $this->suc("成功");
        }else{
            $this->err("失败",mysql_error());
        }
    }


    /**
     * 在线预约>>>查看详情
     */
    public function appointment_info(){
        $pigcms_id = I('get.pigcms_id',0,'intval');
        $model = M('house_village_repair_list','pigcms_');
        //计算记录所对应的sort_id
        $map = array();
        $map['pigcms_id'] = array('eq',$pigcms_id);
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
            'hvrl.pic',//图片
            'm.price',//价格
            'm.unit',//单位
            'm.name'=>'meal_name',//商铺名称
        );
        //数据
        $info = $model->alias('hvrl')
            ->field($field)
            ->join('left join __MEAL__ m on m.meal_id = hvrl.meal_id')
            ->where($map)
            ->find();
        //图片补全
        if($info['pic']){
            $info['pic'] = explode('|',$info['pic']);
            foreach($info['pic'] as &$v){
                $v = $this->img_dir . $v;
            }
            unset($v);
        }

        $this->assign('info',$info);
        $this->display('appointment_info');
    }

    /**
     * 预约列表>>>删除
     */
    public function appointment_del(){
        $pigcms_id = I('get.pigcms_id',0,'intval');
        if(!$pigcms_id) $this->err("参数错误");

        $model = M('house_village_repair_list','pigcms_');
        $res = $model->where('pigcms_id=%d',$pigcms_id)->delete();
        if($res!==false){
            $this->suc("删除成功");
        }else{
            $this->err("删除失败");
        }
    }

    /**
     * 预约管理
     */
    public function appointment_cate_list(){
        //编号	排序	商品名称	价格	单位	销售量	最后操作时间	状态	操作
        $model = M('meal','pigcms_');
        $field = array(
            'm.meal_id',
            'm.sort_id',
            'm.name',
            'm.old_price',
            'm.price',
            'm.vip_price',
            'm.unit',
            'm.sell_count',
            'm.status',
            'm.last_time'
        );
        $map = array();
        $map['is_server'] = array('eq',1);
        //区分社区
        if(!$this->is_supper_admin){
            $map['hvu.village_id'] = array('eq',$this->village_id);//
        }
        //$map['hvu.village_id'] = array('eq',$this->village_id)
        $count = $model->alias('m')
            ->join('left join __HOUSE_VILLAGE_MEAL__ hvu on hvu.store_id = m.store_id')
            ->where($map)
            ->count();
        //加载分页类
        import('@.ORG.merchant_page');
        $page = new Page($count,500);
        $list = $model->alias('m')
            ->field($field)
            ->join('left join __HOUSE_VILLAGE_MEAL__ hvu on hvu.store_id = m.store_id')
            ->where($map)
            ->order('meal_id desc')
            ->limit($page->firstRow,$page->listRows)
            ->select();
        $this->assign('list',$list);
        $this->assign('pagebar',$page->show());
        $this->display('appointment_cate_list');
    }

    /**
     * 编辑分类
     */
    public function modal_edit_appointment_cate(){
        $meal_id = I('get.meal_id',0,'intval');
        $model =  $model = M('meal','pigcms_');
        $info = $model->where('meal_id=%d',$meal_id)->find();
        if(!$info){
            $this->error("数据不存在！");
        }
        $this->assign('info',$info);
        $this->display('modal_edit_appointment_cate');
    }


    public function get_village_name($village_id){
        static $tmp = array();
        if(!$tmp){
            $model = M('house_village','pigcms_');
            $data = $model->field('village_id,village_name')->select();
            foreach($data as $k=>$v){
                $tmp[$v['village_id']] = $v['village_name'];
            }
        }
        return $tmp[$village_id];
    }




    /**
     * 返回json数据
     */
    protected function suc($message='',$data=null)
    {
        echo json_encode(
            array(
                'error' => 0,
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
                'error'=> $errno,
                'msg'=> $message,
                'data'=>$data
            ),
            $json_option=JSON_UNESCAPED_UNICODE //不转义中文
        );
        exit();

    }

    /**
     * 添加物业缴费的账单
     * @author 祝君伟
     * @time 2017年8月5日9:12:27
     */
    public function add_property_order(){
        if(IS_POST){
            //执行的是添加
            $data=$_POST;
            /* if(empty($data['uid'])&&empty($data['bind_id'])&&empty($data['company_id'])){
                 //代表未进入bind表中且公司名称也不在表中
                 //入公司表
                 $company_array = array(
                     'company_name'=>trim($data['company_name']),
                     'village_id'=>trim($data['village_id']),
                     'company_phone'=>trim($data['phone']),
                     'floor'=>trim($data['floor']),
                     'add_time'=>$data['add_time']
                 );
                 $company_id = M('company')->data($company_array)->add();
                 if($company_id){
                     //入bind表
                     $bind_array =array(
                         'village_id'=>trim($data['village_id']),
                         'uid'=>0,
                         'name'=>trim($data['name']),
                         'phone'=>trim($data['phone']),
                         'housesize'=>trim($data['housesize']),
                         'address'=>trim($data['address']),
                         'role'=>1,
                         'company'=>trim($data['company_name']),
                         'company_id'=>trim($data['company_id']),
                     );
                 }
             }*/
        }else{
            //显示所有社区
            $village_array = M('house_village')->where(array('status'=>1))->select();
            $this->assign('village_array',$village_array);
            //显示页面
            $this->display('add_property_order');

        }
    }

    /**
     * 自动完成，人名填写
     * @author 祝君伟
     * @time 2017年8月5日9:59:59
     */
    public function  ajax_to_autocomplete(){
        $keyword = I('get.query');
        //制作查询语句
        $map['name']=array('like','%'.$keyword.'%');
        $keyword_array = M('house_village_user_bind')->where($map)->limit(5)->order('pigcms_id desc')->select();
        foreach ($keyword_array as $value){
            $result_array[] =array(
                'label'=>$value['name'],
            );
        }
        echo json_encode($result_array);
    }

    /**
     * 自动完成，公司名填写
     * @author 祝君伟
     * @time 2017年8月5日11:26:25
     */
    public function company_to_autocomplete(){
        $keyword = I('get.query');
        //制作查询语句
        $map['company_name']=array('like','%'.$keyword.'%');
        $keyword_array = M('company')->where($map)->limit(5)->order('company_id desc')->select();
        foreach ($keyword_array as $value){
            $result_array[] =array(
                'label'=>$value['company_name'],
            );
        }
        echo json_encode($result_array);
    }

    /**
     * 该公司是否记录在表中
     * @author 祝君伟
     * @time 2017年8月5日11:28:49
     */
    /* public function check_this_company(){
         $village_id = I('post.village_id');
         $company_name = I('post.company_name');
         $company_info = M('company')->where(array('village_id'=>$village_id,'company_name'=>$company_name))->find();
         if($company_info == null){
             echo json_encode(array('error'=>1));
         }else{
             $res_array = array(
                 'error'=>0,
                 'floor'=>$company_info['floor'],
                 'company_id'=>$company_info['company_id']
             );
             echo json_encode($res_array);
         }

     }*/

    /**
     * 该人名是否在表中
     * @author 祝君伟
     * @time 2017年8月5日10:00:04
     */
    public function check_this_name(){
        $village_id = I('post.village_id');
        $name = I('post.name');
        $bind_info = M('house_village_user_bind')->where(array('village_id'=>$village_id,'name'=>$name))->find();
        if($bind_info == NULL){
            echo json_encode(array('error'=>1));
        }else{
            $res_array = array(
                'error'=>0,
                'uid'=>$bind_info['uid'],
                'usernum'=>$bind_info['usernum'],
                'bind_id'=>$bind_info['pigcms_id'],
                'address'=>$bind_info['address'],
                'phone'=>$bind_info['phone']
            );
            echo json_encode($res_array);
        }
    }

    /*
     * 报修管理 list
     * @author  祝君伟
     * */
    public function repair_control_list(){
        //字段
        $field = array(
            'p.*',
            't.type_name'
        );
        $repair_array = M('repair_project')
            ->alias('p')
            ->field($field)
            ->join('LEFT JOIN pigcms_repair_type t on p.type_id=t.type_id')
            ->where(array('status'=>0))
            ->select();

        //vd($repair_array);
        $this->assign('repair_array',$repair_array);
        $this->display();

    }

    /*
     * 报修项目添加 add
     * @author 祝君伟
     * */
    public function repair_project_add(){
        //区分显示和添加
        if(IS_POST){
            //执行添加操作
            $repair_model = M('repair_project');
            //创建添加数据模型
            $data = $repair_model->create();
            $res = $repair_model->data($data)->add();
            if($res){
                $this->success('添加完成');
            }else{
                $this->error('添加失败');
            }
        }else{
            //执行显示操作
            //报修项目类型
            $repair_type_array = M('repair_type')->where(array('is_del'=>0))->select();
            $this->assign('repair_type_array',$repair_type_array);
            $this->display();
        }
    }

    /*
     * 报修项目更新
     * @author 祝君伟
     * */
    public function repair_project_edit(){
        //区分展示和修改
        if(IS_POST){
            //执行修改操作
            $repair_model = M('repair_project');
            //创建添加数据模型
            $data = $repair_model->create();
            //过滤数组不符合项
            if($data['is_cost'] == 0){
                //无偿服务的话
                $data['cost'] = 0;
            }
            $res = $repair_model->save($data);
            if($res){
                $this->success('修改完成',U('repair_control_list'));
            }else{
                $this->error('修改失败',U('repair_control_list'));
            }
        }else{
            //显示
            $pro_id = I('get.pro_id');
            $project_array = M('repair_project')->where(array('pro_id'=>$pro_id))->find();
            //全分类显示
            $repair_type_array = M('repair_type')->where(array('is_del'=>0))->select();
            $this->assign('repair_type_array',$repair_type_array);

            $this->assign('project_array',$project_array);
            $this->display();
        }
    }

    /*
     * 报修类型管理
     * @author 祝君伟
     * */
    public function repair_type_list(){
        //字段前台显示
        $repair_type_array = M('repair_type')->where(array('is_del'=>0))->select();
        $this->assign('repair_type_array',$repair_type_array);
        $this->display();
    }

    /*
     * 报修类型添加
     * @author 祝君伟
     * */
    public function repair_type_add(){
        //区分显示和添加
        if(IS_POST){
            //执行添加操作
            $repair_model = M('repair_type');
            //创建添加数据模型
            $data = $repair_model->create();
            $res = $repair_model->data($data)->add();
            if($res){
                $this->success('添加完成');
            }else{
                $this->error('添加失败');
            }
        }else{
            $this->display();
        }
    }

    /*
     * 报修类型修改
     * @author 祝君伟
     * */
    public function repair_type_edit(){
        //区分显示与修改
        if(IS_POST){
            //执行修改操作
            $repair_model = M('repair_type');
            //创建添加数据模型
            $data = $repair_model->create();
            $res = $repair_model->save($data);
            if($res){
                $this->success('修改完成',U('repair_type_list'));
            }else{
                $this->error('修改失败',U('repair_type_list'));
            }
        }else{
            $type_id = I('get.type_id');
            $repair_type_array = M('repair_type')->where(array('type_id'=>$type_id))->find();
            $this->assign('repair_type_array',$repair_type_array);
            $this->display();
        }
    }

    /*
     * 报修类型删除
     * @author 祝君伟
     * */
    public function repair_type_delete(){
        //获取要删除的id
        $type_id = I('get.type_id');
        $res = M('repair_type')->where(array('type_id'=>$type_id))->data(array('is_del'=>1))->save();
        if($res){
            $this->success('删除完成',U('repair_type_list'));
        }else{
            $this->error('删除失败',U('repair_type_list'));
        }
    }

    /**
     *选择充值方式
     */
    public function choose_pay_type(){
        //当前账单id
        $pid = I('get.pid');
        //缴费的钱数
        $money = I('get.money');
        //获取当前type
        $type = I('get.type');
        //银联支付链接
        $chinaPayUrl = U('chinaPay',array('money'=>$money,'type'=>$type,'pid'=>$pid));
        //现金支付链接
        $outLink = U('outLinkPay',array('money'=>$money,'type'=>$type,'pid'=>$pid));
        //微信支付
        $weChatPay = U('weChatPay',array('money'=>$money,'type'=>$type,'pid'=>$pid));
        //支付宝支付
        $AliPay = U('aliPay',array('money'=>$money,'type'=>$type,'pid'=>$pid));
        //选择支付方式集合
        $typeArray = array(
            '银联支付'=>$chinaPayUrl,
            '线下支付'=>$outLink,
            '微信支付'=>$weChatPay,
            '支付宝'  =>$AliPay
        );

        $this->assign('typeArray',$typeArray);
        $this->display();
    }


    public function aliPay(){
        //当前账单id1
        $pid = I('get.pid');
        //缴费的钱数
        $money = I('get.money');
        //获取当前type
        $type = I('get.type');

        $order_type = [
            'out_trade_no'=>time().mt_rand(111111, 999999),
            'subject'=>$type.'缴纳',
            'total_amount'=>0.01
        ];

        import('@.ORG.pay.AlipayMaster');

        $alipay = new AlipayMaster($order_type);

        $alipay->page_pay();

    }

    /**
     * 微信扫码缴费
     * @author 祝君伟
     */
    public function weChatPay(){
        //当前账单id
        $pid = I('get.pid');
        //缴费的钱数
        $money = I('get.money');
        //获取当前type
        $type = I('get.type');

        //TODO：数据准备
        $type=$type.'_price';
        $userInfo = M('house_village_user_paylist')->find($pid);

        $order_info = array(
            'order_no'=>time().mt_rand(111111, 999999)
        );

        if($type=='all_price'){
            $total_water = M('house_village_pay_order')->field(array('*','SUM(actual_payment)'=>'total'))->where(array('pid'=>$pid,'order_type'=>'water','is_pay'=>1))->group('pid')->select();
            $total_electric = M('house_village_pay_order')->field(array('*','SUM(actual_payment)'=>'total'))->where(array('pid'=>$pid,'order_type'=>'electric','is_pay'=>1))->group('pid')->select();
            $total_property = M('house_village_pay_order')->field(array('*','SUM(actual_payment)'=>'total'))->where(array('pid'=>$pid,'order_type'=>'property','is_pay'=>1))->group('pid')->select();
            $total_other = M('house_village_pay_order')->field(array('*','SUM(actual_payment)'=>'total'))->where(array('pid'=>$pid,'order_type'=>'other','is_pay'=>1))->group('pid')->select();
            $total_money = M('house_village_pay_order')->field(array('*','SUM(actual_payment)'=>'total'))->where(array('pid'=>$pid,'order_type'=>'all','is_pay'=>1))->group('pid')->select();
            if($total_money>0){
                $userInfo['nowPay'] = array(
                    '水费'=>array($userInfo['water_price'],$userInfo['water_price'],0),
                    '电费'=>array($userInfo['electric_price'],$userInfo['electric_price'],0),
                    '物业费'=>array($userInfo['property_price'],$userInfo['property_price'],0),
                    '其他费用'=>array($userInfo['other_price'],$userInfo['other_price'],0),
                    '总计'=>array(
                        round($userInfo['water_price']+$userInfo['electric_price']+$userInfo['property_price']+$userInfo['other_price'],2),
                        round($total_water[0]['total']?:0+$total_electric[0]['total']?:0+$total_property[0]['total']?:0+$total_other[0]['total']?:0,2),
                        round($userInfo['water_price']+$userInfo['electric_price']+$userInfo['property_price']+$userInfo['other_price'],2)-round($total_water[0]['total']?:0+$total_electric[0]['total']?:0+$total_property[0]['total']?:0+$total_other[0]['total']?:0,2),
                        round($userInfo['water_price']+$userInfo['electric_price']+$userInfo['property_price']+$userInfo['other_price'],2)-round($total_water[0]['total']?:0+$total_electric[0]['total']?:0+$total_property[0]['total']?:0+$total_other[0]['total']?:0,2)
                    )
                );
                $true_money = 0;
            }else{
                $userInfo['nowPay'] = array(
                    '水费'=>array($userInfo['water_price'],$total_water[0]['total']?:0,$userInfo['water_price']-$total_water[0]['total']),
                    '电费'=>array($userInfo['electric_price'],$total_electric[0]['total']?:0,$userInfo['electric_price']-$total_electric[0]['total']),
                    '物业费'=>array($userInfo['property_price'],$total_property[0]['total']?:0,$userInfo['property_price']-$total_property[0]['total']),
                    '其他费用'=>array($userInfo['other_price'],$total_other[0]['total']?:0,$userInfo['other_price']-$total_other[0]['total']),
                    '总计'=>array(
                        round($userInfo['water_price']+$userInfo['electric_price']+$userInfo['property_price']+$userInfo['other_price'],2),
                        round($total_water[0]['total']?:0+$total_electric[0]['total']?:0+$total_property[0]['total']?:0+$total_other[0]['total']?:0,2),
                        round($userInfo['water_price']+$userInfo['electric_price']+$userInfo['property_price']+$userInfo['other_price'],2)-round($total_water[0]['total']?:0+$total_electric[0]['total']?:0+$total_property[0]['total']?:0+$total_other[0]['total']?:0,2),
                        round($userInfo['water_price']+$userInfo['electric_price']+$userInfo['property_price']+$userInfo['other_price'],2)-round($total_water[0]['total']?:0+$total_electric[0]['total']?:0+$total_property[0]['total']?:0+$total_other[0]['total']?:0,2)
                    )
                );
                $true_money = round($userInfo['water_price']+$userInfo['electric_price']+$userInfo['property_price']+$userInfo['other_price'],2)-round($total_water[0]['total']?:0+$total_electric[0]['total']?:0+$total_property[0]['total']?:0+$total_other[0]['total']?:0,2);
            }

            $order_info['order_body'] = '物业水电费缴纳';

        }else{

            switch ($type){
                case 'water_price':
                    $total_water = M('house_village_pay_order')->field(array('*','SUM(actual_payment)'=>'total'))->where(array('pid'=>$pid,'order_type'=>'water','is_pay'=>1))->group('pid')->select()[0]['total']?:0;
                    $userInfo['nowPay'] = array(
                        '水费'=>array($userInfo['water_price'],$total_water,$userInfo['water_price']-$total_water),
                    );
                    $order_info['order_body'] = '水费缴纳';
                    $true_money = $userInfo['water_price']-$total_water;
                    break;

                case 'electric_price':
                    $total_electric = M('house_village_pay_order')->field(array('*','SUM(actual_payment)'=>'total'))->where(array('pid'=>$pid,'order_type'=>'electric','is_pay'=>1))->group('pid')->select()[0]['total']?:0;
                    $userInfo['nowPay'] = array(
                        '电费'=>array($userInfo['electric_price'],$total_electric,$userInfo['electric_price']-$total_electric)
                    );
                    $order_info['order_body'] = '电费缴纳';
                    $true_money = $userInfo['electric_price']-$total_electric;
                    break;

                case 'property_price':
                    $total_property = M('house_village_pay_order')->field(array('*','SUM(actual_payment)'=>'total'))->where(array('pid'=>$pid,'order_type'=>'property','is_pay'=>1))->group('pid')->select()[0]['total']?:0;
                    $userInfo['nowPay'] = array(
                        '物业费'=>array($userInfo['property_price'],$total_property,$userInfo['property_price']-$total_property)
                    );
                    $order_info['order_body'] = '物业费缴纳';
                    $true_money = $userInfo['property_price']-$total_property;
                    break;
                case 'other_price':
                    $total_other = M('house_village_pay_order')->field(array('*','SUM(actual_payment)'=>'total'))->where(array('pid'=>$pid,'order_type'=>'other','is_pay'=>1))->group('pid')->select()[0]['total']?:0;
                    $userInfo['nowPay'] = array(
                        '其他费用'=>array($userInfo['other_price'],$total_other,$userInfo['other_price']-$total_other)
                    );
                    $order_info['order_body'] = '其他费用缴纳';
                    $true_money = $userInfo['other_price']-$total_other;
                    break;
                case 'all_price':
                    $userInfo['nowPay'] = array(
                        '全部缴费'=>array($userInfo['all_price'],$userInfo['all_price']-$money,$money)
                    );
                    break;
            }

        }

        $fieldArray = array(
            '水费'=>'water_price',
            '电费'=>'electric_price',
            '物业费'=>'property_price',
            '其他费用'=>'other_price',
        );

        //vd($fieldArray);exit;
        $this->assign('type',$type);
        $this->assign('userInfo',$userInfo);
        $this->assign('fieldArray',$fieldArray);

        if($true_money==0){
            $this->display();
        }else{
            //创建订单

            $property_array = array(
                'order_name'=>$order_info['order_body'],
                'order_type'=>explode("_",$type)[0],
                'uid'=>0,
                'order_no'=>$order_info['order_no'],
                'pid'=>$pid,
                'money'=>$true_money,
                'create_time'=>time(),
                'admin_id'=>$_SESSION['system']['id'],
                'actual_payment'=>$true_money,
                'final_payment'=>0,
                'payable'=>$true_money,
                'is_pay'=>0
            );

            $res = M('house_village_pay_order')->data($property_array)->add();

            if($res)
            {
                import('@.ORG.pay.WeChatPay');
                $weChat = new WeChatPay($order_info);
                //$w_res= $weChat->web_pay($true_money);
                $w_res= $weChat->web_pay(0.01);
                if($w_res['error']==0){
                    $this->assign('payUrl',$w_res['qrcode']);
                    $this->assign('order_no',$order_info['order_no']);
                    $this->display();
                }else{
                    $this->error('缴费出错，请联系管理员');
                }

            }else{
                $this->error('缴费出错，请联系管理员');
            }
        }



        //获取微信支付二维码




    }


    /**
     * 每秒轮询查询订单完成情况
     */
    public function check_this_order(){

        $order_no = I('post.order_no');

        $is_pay = M('house_village_pay_order')->getFieldByOrder_no($order_no,'is_pay');

        if($is_pay==1)echo 1;else echo 2;
    }


    /**
     * 线下支付
     */
    public function outLinkPay(){
        if(IS_POST){
            //当前账单id
            $pid = I('get.pid');
            //缴费的钱数
            $money = I('get.money');
            //获取当前type
            $type = I('get.type');
            //实际付款
            //①水费
            $water_actual_payment = I('post.water_price');
            //②电费
            $electric_actual_payment = I('post.electric_price');
            //③物业费
            $property_actual_payment = I('post.property_price');
            //④其他费用
            $other_actual_payment = I('post.other_price');
            //当前的账单的信息
            /* var_dump($water_actual_payment);
              var_dump($electric_actual_payment);
              var_dump($property_actual_payment);
              var_dump($other_actual_payment);
              exit;*/
            $billInfo = M('house_village_user_paylist')->find($pid);
            $total_water = M('house_village_pay_order')->field(array('*','SUM(actual_payment)'=>'total'))->where(array('pid'=>$pid,'order_type'=>'water'))->group('pid')->select();
            $total_electric = M('house_village_pay_order')->field(array('*','SUM(actual_payment)'=>'total'))->where(array('pid'=>$pid,'order_type'=>'electric'))->group('pid')->select();
            $total_property = M('house_village_pay_order')->field(array('*','SUM(actual_payment)'=>'total'))->where(array('pid'=>$pid,'order_type'=>'property'))->group('pid')->select();
            $total_other = M('house_village_pay_order')->field(array('*','SUM(actual_payment)'=>'total'))->where(array('pid'=>$pid,'order_type'=>'other'))->group('pid')->select();
            //订单
            $orderNo = time().mt_rand(111111, 999999);
            //制作订单数组
            $order_name = '';

            switch ($type)
            {
                case 'water':
                    $order_name = '缴纳水费';
                    if($billInfo['water_price']-$total_water[0]['total']>$water_actual_payment){
                        //费用没有缴完
                        //差额计算
                        $final_payment = $billInfo['water_price']-$total_water[0]['total']-$water_actual_payment;
                        $property_array = array(
                            'order_name'=>$order_name,
                            'order_type'=>$type,
                            'uid'=>0,
                            'order_no'=>$orderNo,
                            'pid'=>$pid,
                            'money'=>$money,
                            'create_time'=>time(),
                            'admin_id'=>$_SESSION['system']['id'],
                            'actual_payment'=>$water_actual_payment,
                            'final_payment'=>$final_payment,
                            'payable'=>$money,
                            'is_pay'=>1
                        );
                        $res = M('house_village_pay_order')->data($property_array)->add();
                        if($res){
                            $this->success('缴费完成,但还剩余'.$final_payment.'元水费未缴，请下次缴清',U('Room/tenantlist_news'));
                        }else{
                            $this->error('缴费失败',U('Room/tenantlist_news'));
                        }
                    }else if($billInfo['water_price']-$total_water[0]['total']==$water_actual_payment){
                        //费用没有缴完
                        $property_array = array(
                            'order_name'=>$order_name,
                            'order_type'=>$type,
                            'uid'=>0,
                            'order_no'=>$orderNo,
                            'pid'=>$pid,
                            'money'=>$money,
                            'create_time'=>time(),
                            'admin_id'=>$_SESSION['system']['id'],
                            'actual_payment'=>$water_actual_payment,
                            'final_payment'=>0,
                            'payable'=>$money,
                            'is_pay'=>1
                        );
                        $res = M('house_village_pay_order')->data($property_array)->add();
                        if($res){
                            $this->success('缴费完成',U('Room/tenantlist_news'));
                        }else{
                            $this->error('缴费失败',U('Room/tenantlist_news'));
                        }
                    }else{
                        $this->error('暂不支持预付款模式',U('Room/tenantlist_news'),60);
                    }
                    break;
                case 'electric':
                    $order_name = '缴纳电费';
                    if($billInfo['electric_price']-$total_electric[0]['total']>$electric_actual_payment){
                        //费用没有缴完
                        //差额计算
                        $final_payment = $billInfo['electric_price']-$total_electric[0]['total']-$electric_actual_payment;
                        $property_array = array(
                            'order_name'=>$order_name,
                            'order_type'=>$type,
                            'uid'=>0,
                            'order_no'=>$orderNo,
                            'pid'=>$pid,
                            'money'=>$money,
                            'create_time'=>time(),
                            'admin_id'=>$_SESSION['system']['id'],
                            'actual_payment'=>$electric_actual_payment,
                            'final_payment'=>$final_payment,
                            'payable'=>$money,
                            'is_pay'=>1
                        );
                        $res = M('house_village_pay_order')->data($property_array)->add();
                        if($res){
                            $this->success('缴费完成，但还剩余'.$final_payment.'元电费未缴，请下次缴清',U('Room/tenantlist_news'));
                        }else{
                            $this->error('缴费失败',U('Room/tenantlist_news'));
                        }
                    }else if($billInfo['electric_price']-$total_electric[0]['total']==$electric_actual_payment){
                        //费用没有缴完
                        $property_array = array(
                            'order_name'=>$order_name,
                            'order_type'=>$type,
                            'uid'=>0,
                            'order_no'=>$orderNo,
                            'pid'=>$pid,
                            'money'=>$money,
                            'create_time'=>time(),
                            'admin_id'=>$_SESSION['system']['id'],
                            'actual_payment'=>$electric_actual_payment,
                            'final_payment'=>0,
                            'payable'=>$money,
                            'is_pay'=>1
                        );
                        $res = M('house_village_pay_order')->data($property_array)->add();
                        if($res){
                            $this->success('缴费完成',U('Room/tenantlist_news'));
                        }else{
                            $this->error('缴费失败',U('Room/tenantlist_news'));
                        }
                    }else{
                        $this->error('暂不支持预付款模式',U('Room/tenantlist_news'));
                    }
                    break;
                case 'property':
                    $order_name = '缴纳物业费';
                    if($billInfo['property_price']-$total_property[0]['total']>$property_actual_payment){
                        //费用没有缴完
                        //差额计算
                        $final_payment = $billInfo['property_price']-$total_property[0]['total']-$property_actual_payment;
                        $property_array = array(
                            'order_name'=>$order_name,
                            'order_type'=>$type,
                            'uid'=>0,
                            'order_no'=>$orderNo,
                            'pid'=>$pid,
                            'money'=>$money,
                            'create_time'=>time(),
                            'admin_id'=>$_SESSION['system']['id'],
                            'actual_payment'=>$property_actual_payment,
                            'final_payment'=>$final_payment,
                            'payable'=>$money,
                            'is_pay'=>1
                        );
                        $res = M('house_village_pay_order')->data($property_array)->add();
                        if($res){
                            $this->success('缴费完成，但还剩余'.$final_payment.'元物业费未缴，请下次缴清',U('Room/tenantlist_news'));
                        }else{
                            $this->error('缴费失败',U('Room/tenantlist_news'));
                        }
                    }else if($billInfo['property_price']-$total_property[0]['total']==$property_actual_payment){
                        //费用没有缴完
                        $property_array = array(
                            'order_name'=>$order_name,
                            'order_type'=>$type,
                            'uid'=>0,
                            'order_no'=>$orderNo,
                            'pid'=>$pid,
                            'money'=>$money,
                            'create_time'=>time(),
                            'admin_id'=>$_SESSION['system']['id'],
                            'actual_payment'=>$property_actual_payment,
                            'final_payment'=>0,
                            'payable'=>$money,
                            'is_pay'=>1
                        );
                        $res = M('house_village_pay_order')->data($property_array)->add();
                        if($res){
                            $this->success('缴费完成',U('Room/tenantlist_news'));
                        }else{
                            $this->error('缴费失败',U('Room/tenantlist_news'));
                        }
                    }else{
                        $this->error('暂不支持预付款模式',U('Room/tenantlist_news'));
                    }
                    break;

                case 'other':
                    $order_name = '缴纳其他费用';
                    if($billInfo['other_price']-$total_other[0]['total']>$other_actual_payment){
                        //费用没有缴完
                        //差额计算
                        $final_payment = $billInfo['other_price']-$total_other[0]['total']-$other_actual_payment;
                        $property_array = array(
                            'order_name'=>$order_name,
                            'order_type'=>$type,
                            'uid'=>0,
                            'order_no'=>$orderNo,
                            'pid'=>$pid,
                            'money'=>$money,
                            'create_time'=>time(),
                            'admin_id'=>$_SESSION['system']['id'],
                            'actual_payment'=>$other_actual_payment,
                            'final_payment'=>$final_payment,
                            'payable'=>$money,
                            'is_pay'=>1
                        );
                        $res = M('house_village_pay_order')->data($property_array)->add();
                        if($res){
                            $this->success('缴费完成，但还剩余'.$final_payment.'元其他费用未缴，请下次缴清',U('Room/tenantlist_news'));
                        }else{
                            $this->error('缴费失败',U('Room/tenantlist_news'));
                        }
                    }else if($billInfo['other_price']-$total_other[0]['total']==$other_actual_payment){
                        //费用没有缴完
                        $property_array = array(
                            'order_name'=>$order_name,
                            'order_type'=>$type,
                            'uid'=>0,
                            'order_no'=>$orderNo,
                            'pid'=>$pid,
                            'money'=>$money,
                            'create_time'=>time(),
                            'admin_id'=>$_SESSION['system']['id'],
                            'actual_payment'=>$other_actual_payment,
                            'final_payment'=>0,
                            'payable'=>$money,
                            'is_pay'=>1
                        );
                        $res = M('house_village_pay_order')->data($property_array)->add();
                        if($res){
                            $this->success('缴费完成',U('Room/tenantlist_news'));
                        }else{
                            $this->error('缴费失败',U('Room/tenantlist_news'));
                        }
                    }else{
                        $this->error('暂不支持预付款模式',U('Room/tenantlist_news'));
                    }
                    break;
                case 'all':
                    $order_name = '全部缴费';
                    if($billInfo['property_price']-$total_property[0]['total']>$property_actual_payment&&!empty($property_actual_payment)){
                        //费用没有缴完
                        //差额计算
                        $final_payment = $billInfo['property_price']-$total_property[0]['total']-$property_actual_payment;
                        $property_array = array(
                            'order_name'=>$order_name,
                            'order_type'=>'property',
                            'uid'=>0,
                            'order_no'=>$orderNo,
                            'pid'=>$pid,
                            'money'=>$money,
                            'create_time'=>time(),
                            'admin_id'=>$_SESSION['system']['id'],
                            'actual_payment'=>$property_actual_payment,
                            'final_payment'=>$final_payment,
                            'payable'=>$money,
                            'is_pay'=>1
                        );
                        $res = M('house_village_pay_order')->data($property_array)->add();
                        if(!$res){
                            $this->error('物业缴费失败');
                        }
                    }else if($billInfo['property_price']-$total_property[0]['total']==$property_actual_payment&&!empty($property_actual_payment)){
                        //费用没有缴完
                        $property_array = array(
                            'order_name'=>$order_name,
                            'order_type'=>'property',
                            'uid'=>0,
                            'order_no'=>$orderNo,
                            'pid'=>$pid,
                            'money'=>$money,
                            'create_time'=>time(),
                            'admin_id'=>$_SESSION['system']['id'],
                            'actual_payment'=>$property_actual_payment,
                            'final_payment'=>0,
                            'payable'=>$money,
                            'is_pay'=>1
                        );
                        $res = M('house_village_pay_order')->data($property_array)->add();
                        if(!$res){
                            $this->error('物业缴费失败');
                        }
                    }else if($billInfo['property_price']-$total_property[0]['total']<$property_actual_payment&&!empty($property_actual_payment)){
                        $this->error('暂不支持预付款模式',U('Room/tenantlist_news'));
                    }


                    if($billInfo['electric_price']-$total_electric[0]['total']>$electric_actual_payment&&!empty($electric_actual_payment)){
                        //费用没有缴完
                        //差额计算
                        $final_payment = $billInfo['electric_price']-$total_electric[0]['total']-$electric_actual_payment;
                        $property_array = array(
                            'order_name'=>$order_name,
                            'order_type'=>'electric',
                            'uid'=>0,
                            'order_no'=>$orderNo,
                            'pid'=>$pid,
                            'money'=>$money,
                            'create_time'=>time(),
                            'admin_id'=>$_SESSION['system']['id'],
                            'actual_payment'=>$electric_actual_payment,
                            'final_payment'=>$final_payment,
                            'payable'=>$money,
                            'is_pay'=>1
                        );
                        $res = M('house_village_pay_order')->data($property_array)->add();
                        if(!$res){
                            $this->error('电费缴费失败');
                        }
                    }else if($billInfo['electric_price']-$total_electric[0]['total']==$electric_actual_payment&&!empty($electric_actual_payment)){
                        //费用没有缴完
                        $property_array = array(
                            'order_name'=>$order_name,
                            'order_type'=>'electric',
                            'uid'=>0,
                            'order_no'=>$orderNo,
                            'pid'=>$pid,
                            'money'=>$money,
                            'create_time'=>time(),
                            'admin_id'=>$_SESSION['system']['id'],
                            'actual_payment'=>$electric_actual_payment,
                            'final_payment'=>0,
                            'payable'=>$money,
                            'is_pay'=>1
                        );
                        $res = M('house_village_pay_order')->data($property_array)->add();
                        if(!$res){
                            $this->error('电费缴费失败');
                        }
                    }else if($billInfo['electric_price']-$total_electric[0]['total']<$electric_actual_payment&&!empty($electric_actual_payment)){
                        $this->error('暂不支持预付款模式',U('Room/tenantlist_news'));
                    }


                    if($billInfo['water_price']-$total_water[0]['total']>$water_actual_payment&&!empty($water_actual_payment)){
                        //费用没有缴完
                        //差额计算
                        $final_payment = $billInfo['water_price']-$total_water[0]['total']-$water_actual_payment;
                        $property_array = array(
                            'order_name'=>$order_name,
                            'order_type'=>'water',
                            'uid'=>0,
                            'order_no'=>$orderNo,
                            'pid'=>$pid,
                            'money'=>$money,
                            'create_time'=>time(),
                            'admin_id'=>$_SESSION['system']['id'],
                            'actual_payment'=>$water_actual_payment,
                            'final_payment'=>$final_payment,
                            'payable'=>$money,
                            'is_pay'=>1
                        );
                        $res = M('house_village_pay_order')->data($property_array)->add();
                        if(!$res){
                            $this->error('水费缴费失败');
                        }
                    }else if($billInfo['water_price']-$total_water[0]['total']==$water_actual_payment&&!empty($water_actual_payment)){
                        //费用没有缴完
                        $property_array = array(
                            'order_name'=>$order_name,
                            'order_type'=>'water',
                            'uid'=>0,
                            'order_no'=>$orderNo,
                            'pid'=>$pid,
                            'money'=>$money,
                            'create_time'=>time(),
                            'admin_id'=>$_SESSION['system']['id'],
                            'actual_payment'=>$water_actual_payment,
                            'final_payment'=>0,
                            'payable'=>$money,
                            'is_pay'=>1
                        );
                        $res = M('house_village_pay_order')->data($property_array)->add();
                        if(!$res){
                            $this->error('水费缴费失败');
                        }
                    }else if($billInfo['water_price']-$total_water[0]['total']<$water_actual_payment&&!empty($water_actual_payment)){
                        $this->error('暂不支持预付款模式',U('Room/tenantlist_news'));
                    }


                    if($billInfo['other_price']-$total_other[0]['total']>$other_actual_payment&&!empty($other_actual_payment)){
                        //费用没有缴完
                        //差额计算
                        $final_payment = $billInfo['other_price']-$total_other[0]['total']-$other_actual_payment;
                        $property_array = array(
                            'order_name'=>$order_name,
                            'order_type'=>'other',
                            'uid'=>0,
                            'order_no'=>$orderNo,
                            'pid'=>$pid,
                            'money'=>$money,
                            'create_time'=>time(),
                            'admin_id'=>$_SESSION['system']['id'],
                            'actual_payment'=>$other_actual_payment,
                            'final_payment'=>$final_payment,
                            'payable'=>$money,
                            'is_pay'=>1
                        );
                        $res = M('house_village_pay_order')->data($property_array)->add();
                        if(!$res){
                            $this->error('其他费缴费失败');
                        }
                    }else if($billInfo['other_price']-$total_other[0]['total']==$other_actual_payment&&!empty($other_actual_payment)){
                        //费用没有缴完
                        $property_array = array(
                            'order_name'=>$order_name,
                            'order_type'=>'other',
                            'uid'=>0,
                            'order_no'=>$orderNo,
                            'pid'=>$pid,
                            'money'=>$money,
                            'create_time'=>time(),
                            'admin_id'=>$_SESSION['system']['id'],
                            'actual_payment'=>$other_actual_payment,
                            'final_payment'=>0,
                            'payable'=>$money,
                            'is_pay'=>1
                        );
                        $res = M('house_village_pay_order')->data($property_array)->add();
                        if(!$res){
                            $this->error('其他费缴费失败');
                        }
                    }else if($billInfo['other_price']-$total_other[0]['total']<$other_actual_payment&&!empty($other_actual_payment)){
                        $this->error('暂不支持预付款模式',U('Room/tenantlist_news'));
                    }
                    $this->success('缴费完成',U('Room/tenantlist_news'));
                    break;
            }

        }else{

            if(session('system.tid')) exit('您无权使用该支付方式');
            //当前账单id
            $pid = I('get.pid');
            //缴费的钱数
            $money = I('get.money');
            //获取当前type
            $type = I('get.type');
            $type=$type.'_price';
            //当前的账单的信息
            $userInfo = M('house_village_user_paylist')->find($pid);
            if($type=='all_price'){
                $total_water = M('house_village_pay_order')->field(array('*','SUM(actual_payment)'=>'total'))->where(array('pid'=>$pid,'order_type'=>'water'))->group('pid')->select();
                $total_electric = M('house_village_pay_order')->field(array('*','SUM(actual_payment)'=>'total'))->where(array('pid'=>$pid,'order_type'=>'electric'))->group('pid')->select();
                $total_property = M('house_village_pay_order')->field(array('*','SUM(actual_payment)'=>'total'))->where(array('pid'=>$pid,'order_type'=>'property'))->group('pid')->select();
                $total_other = M('house_village_pay_order')->field(array('*','SUM(actual_payment)'=>'total'))->where(array('pid'=>$pid,'order_type'=>'other'))->group('pid')->select();
                /*$userInfo['nowPay'] = array(
                    '水费'=>$userInfo['water_price']-$total_water[0]['total'],
                    '电费'=>$userInfo['electric_price']-$total_electric[0]['total'],
                    '物业费'=>$userInfo['property_price']-$total_property[0]['total'],
                    '其他费用'=>$userInfo['other_price']-$total_other[0]['total'],
                );*/
                $userInfo['nowPay'] = array(
                    '水费'=>array($userInfo['water_price'],$total_water[0]['total']?:0,$userInfo['water_price']-$total_water[0]['total']),
                    '电费'=>array($userInfo['electric_price'],$total_electric[0]['total']?:0,$userInfo['electric_price']-$total_electric[0]['total']),
                    '物业费'=>array($userInfo['property_price'],$total_property[0]['total']?:0,$userInfo['property_price']-$total_property[0]['total']),
                    '其他费用'=>array($userInfo['other_price'],$total_other[0]['total']?:0,$userInfo['other_price']-$total_other[0]['total']),
                );
            }else{

                switch ($type){
                    case 'water_price':
                        $total_water = M('house_village_pay_order')->field(array('*','SUM(actual_payment)'=>'total'))->where(array('pid'=>$pid,'order_type'=>'water'))->group('pid')->select()[0]['total']?:0;
                        $userInfo['nowPay'] = array(
                            '水费'=>array($userInfo['water_price'],$total_water,$userInfo['water_price']-$total_water)
                        );
                        break;

                    case 'electric_price':
                        $total_electric = M('house_village_pay_order')->field(array('*','SUM(actual_payment)'=>'total'))->where(array('pid'=>$pid,'order_type'=>'electric'))->group('pid')->select()[0]['total']?:0;
                        $userInfo['nowPay'] = array(
                            '电费'=>array($userInfo['electric_price'],$total_electric,$userInfo['electric_price']-$total_electric)
                        );
                        break;

                    case 'property_price':
                        $total_property = M('house_village_pay_order')->field(array('*','SUM(actual_payment)'=>'total'))->where(array('pid'=>$pid,'order_type'=>'property'))->group('pid')->select()[0]['total']?:0;
                        $userInfo['nowPay'] = array(
                            '物业费'=>array($userInfo['property_price'],$total_property,$userInfo['property_price']-$total_property)
                        );
                        break;
                    case 'other_price':
                        $total_other = M('house_village_pay_order')->field(array('*','SUM(actual_payment)'=>'total'))->where(array('pid'=>$pid,'order_type'=>'other'))->group('pid')->select()[0]['total']?:0;
                        $userInfo['nowPay'] = array(
                            '其他费用'=>array($userInfo['other_price'],$total_other,$userInfo['other_price']-$total_other)
                        );
                        break;
                    case 'all_price':
                        $userInfo['nowPay'] = array(
                            '全部缴费'=>array($userInfo['all_price'],$userInfo['all_price']-$money,$money)
                        );
                        break;
                }

            }

            $fieldArray = array(
                '水费'=>'water_price',
                '电费'=>'electric_price',
                '物业费'=>'property_price',
                '其他费用'=>'other_price',
            );

            //vd($fieldArray);exit;
            $this->assign('type',$type);
            $this->assign('userInfo',$userInfo);
            $this->assign('fieldArray',$fieldArray);
            $this->display();
        }

    }



    /*
     * 银联支付
     * @author 祝君伟
     * */
    public function chinaPay(){
        //当前账单id
        $pid = I('get.pid');
        //缴费的钱数
        $money = I('get.money');
        //充值商户id
        $mid=14;
        //获取当前type
        $type = I('get.type');
        //银联接口地址
        $pay_url="https://payment.chinapay.com/CTITS/service/rest/page/nref/000000000017/0/0/0/0/0";
        $tmp=M('cashier_merchants')->where(array('thirduserid'=>$mid))->getField('mid');
        //该商户所有支付配置参数
        $payConfig = M('cashier_payconfig')->where(array('mid' => $tmp))->find();
        if ($payConfig) {
            if ($payConfig['configData']) {
                $payConfig['configData'] = unserialize(htmlspecialchars_decode($payConfig['configData']));
            }else {
                $payConfig2['configData'] = array();
            }
        }
        //读取银联的配置
        $info=M('config')->where(array('name'=>'pay_allinpay_merchantid'))->find();
        //主商户编号
        $MerId=$info['value'];//主商户编号
        //银联下的分账商户编号
        $sub_mid=$payConfig['configData']['chinaPay']['MerId'];
        //vd($payConfig);exit;
        //商户私有域定义
        $MerResv = $type.','.$pid;
        $MerOrderNo=time().mt_rand(111111, 999999);//订单编号
        $TranDate=date('Ymd');//交易日期
        $TranTime=date('His');//交易时间
        $this->assign('pay_url',$pay_url);
        $this->assign('MerId',$MerId);
        $this->assign('sub_mid',$sub_mid);
        $this->assign('MerOrderNo',$MerOrderNo);
        $this->assign('TranDate',$TranDate);
        $this->assign('TranTime',$TranTime);
        $this->assign('money',$money);
        $this->assign('pid',$pid);
        $this->assign('mid',$mid);
        $this->assign('type',$type);
        $this->assign('MerResv',$MerResv);
        //dump(getcwd());exit;
        $this->display();
    }

    /*
   * 银联转账提交表单
   * 陈琦
   * 2017.2.21
   */
    public function chinaPay_submit(){
        $paramArray = array(
            'MerId'=>$_POST['MerId'],//商户编号
            'MerOrderNo'=>$_POST['MerOrderNo'],//订单编号
            'OrderAmt'=>$_POST['OrderAmt']*100,//订单金额
            'TranDate'=>$_POST['TranDate'],//交易日期
            'TranTime'=>$_POST['TranTime'],//交易时间
            'TranType'=>'0002',//交易类型
            'BusiType'=>'0001',//业务类型
            'Version'=>'20140728',//版本号
            'MerBgUrl'=>'http://www.hdhsmart.com/admin.php?g=System&c=PropertyService&a=bgReturn',//后台
            'MerPageUrl'=>'http://www.hdhsmart.com/admin.php?g=System&c=PropertyService&a=pgReturn&company_id='.$_POST['company_id'].'&mid='.$_POST['mid'].'&type='.$_POST['type'].'&order_id='.$_POST['order_id'],//前台
            'SplitType'=>'0001',//分账类型
            'SplitMethod'=>'0',//分账方式'0'按金额分账，'1'按比例
            'MerSplitMsg'=>$_POST['MerSplitMsg'],//分账信息
            'MerResv'=>$_POST['MerResv']
        );
        //银联接口类
        import('@.ORG.SecssUtil');
        $secssUtil = new SecssUtil();
        //用于提供商户签名、验签、加密、解密、文件验签等方法调用
        $securityPropFile = getcwd().'/cms/Lib/Action/System/class/security.properties';//写到类的路径下面
        //初始化配置文件
        $secssUtil->init($securityPropFile);
        //签名
        $secssUtil->sign($paramArray);
        //获取签名
        $Signature=$secssUtil->getSign();
        if ("00" !== $secssUtil->getErrCode()) {
            echo json_encode(array('error'=>1,'msg'=>"签名过程发生错误，错误信息为-->" . $secssUtil->getErrMsg()));
        }else{
            //寻找当前的用户绑定信息
            $order_name = '';
            switch ($_POST['type'])
            {
                case 'water':
                    $order_name = '缴纳水费';
                    break;
                case 'electric':
                    $order_name = '缴纳电费';
                    break;
                case 'gas':
                    $order_name = '缴纳燃气费';
                    break;
                case 'park':
                    $order_name = '缴纳停车费';
                    break;
                case 'property':
                    $order_name = '缴纳物业费';
                    break;
                case 'all':
                    $order_name = '全部缴费';
            }
            $property_array = array(
                'order_name'=>$order_name,
                'order_type'=>$_POST['type'],
                'uid'=>0,
                'order_no'=>$_POST['MerOrderNo'],
                'pid'=>$_POST['pid'],
                'money'=>$_POST['OrderAmt'],
                'create_time'=>time(),
                'admin_id'=>$_SESSION['system']['id'],
                'actual_payment'=>$_POST['OrderAmt'],
                'final_payment'=>0,
                'payable'=>$_POST['OrderAmt'],
            );
            //添加数组至物业订单表
            M('house_village_pay_order')->data($property_array)->add();
            echo json_encode(array('error'=>0,'msg'=>$Signature));
        }
    }


    /*
    * 银联后台接收
    */
    public function bgReturn(){
        //接受银联回传值并转换成数组
        parse_str(file_get_contents('php://input'), $data);
        import('@.ORG.SecssUtil');
        include "./cms/Lib/ORG/chinaPay/common.php";
        $secssUtil = new SecssUtil();
        //指定签名验签证书文件存放路径
        $securityPropFile = getcwd().'/cms/Lib/Action/System/class/security.properties';
        $secssUtil->init($securityPropFile);
        $text = array();
        foreach($data as $key=>$value){
            $text[$key] = urldecode($value);
        }
        $secssUtil->verify($text);
    }


    /*
     * 银联前台接收回传数据
     */
    public function pgReturn(){
        //接受银联回传值并转换成数组
        parse_str(file_get_contents('php://input'), $data);
        $dispatchUrl='http://www.hdhsmart.com/admin.php?g=System&c=PropertyService&a=pay_order';
        import('@.ORG.SecssUtil');
        include "./cms/Lib/ORG/chinaPay/common.php";
        $secssUtil = new SecssUtil();
        //指定签名验签证书文件存放路径
        $securityPropFile = getcwd().'/cms/Lib/Action/System/class/security.properties';
        //初始化
        $secssUtil->init($securityPropFile);
        //验签
        if ($secssUtil->verify($_POST)) {
            $_SESSION["VERIFY_KEY"] = "success";
        } else {
            $_SESSION["VERIFY_KEY"] = "fail";
        }
        //存入session
        foreach ($data as $k=>$v){
            $newdata[$k]=$v;
            $newdata['mid']=$_GET['mid'];
        }
        $_SESSION['chinaPay']=$newdata;
        header("Location:" . $dispatchUrl);
    }

    /*
    * 用户完成交易以后调用银联查询接口查询支付结果
    * 2017.7.26
    * */
    public function china_pay_select(){
        $paramArray = array(
            'MerId'=>$_POST['MerId'],//商户编号
            'MerOrderNo'=>$_POST['MerOrderNo'],//订单编号
            'TranDate'=>$_POST['TranDate'],//交易日期
            'TranTime'=>$_POST['TranTime'],//交易时间
            'TranType'=>'0502',//交易类型
            'BusiType'=>'0001',//业务类型
            'Version'=>'20140728',//版本号
        );
        //银联接口类
        import('@.ORG.SecssUtil');
        $secssUtil = new SecssUtil();
        //用于提供商户签名、验签、加密、解密、文件验签等方法调用
        $securityPropFile = getcwd().'/cms/Lib/Action/System/class/security.properties';//写到类的路径下面
        //初始化配置文件
        $secssUtil->init($securityPropFile);
        //签名
        $secssUtil->sign($paramArray);
        //获取签名
        $Signature=$secssUtil->getSign();
        $request_array = array(
            'MerId'=>$_POST['MerId'],//商户编号
            'MerOrderNo'=>$_POST['MerOrderNo'],//订单编号
            'TranDate'=>$_POST['TranDate'],//交易日期
            'TranTime'=>$_POST['TranTime'],//交易时间
            'TranType'=>'0502',//交易类型
            'BusiType'=>'0001',//业务类型
            'Version'=>'20140728',//版本号
            'Signature'=>$Signature
        );
        //加载Snoopy，高级表单提交方法
        import('@.ORG.Snoopy');
        $snoopy = new Snoopy();
        $action = "https://payment.chinapay.com/CTITS/service/rest/forward/syn/000000000060/0/0/0/0/0";//表单提交地址
        $snoopy->submit($action,$request_array);//$formvars为提交的数组
        $result_str = $snoopy->results; //获取表单提交后的 返回的结果
        //dump($result_str);exit;
        $result_array = explode("&",$result_str);
        $select_info =array();
        foreach ($result_array as $key=>$value){
            $msg_arr = explode("=",$value);
            $select_info[$msg_arr[0]]=$msg_arr[1];
        }
        if($select_info['respCode'] == '0000'){
            //根据银联文档提示：表示同步应答码，只有"0000才为处理成功，其他均为处理失败
            if($select_info['OrderStatus'] == '0001'){
                //支付完全成功
                //支付完成后制作维护列表
                $order_update_array = array(
                    'pay_time'=>time(),
                    'is_pay'=>1,
                );
                if(empty($select_info['MerOrderNo'])&&!isset($select_info['MerOrderNo'])) exit('系统出错');
                $res = M('house_village_pay_order')->where(array('order_no'=>$select_info['MerOrderNo']))->data($order_update_array)->save();
                if($res){
                    echo 1;
                }else{
                    echo 2;
                }
            }else{
                dump($select_info);
            }
        }else{
            //查询失败
            dump($select_info);
        }

    }

    public function testtest(){
        $this->display();
    }


//租户（公司导入）
    public function import_tenant(){
        $model = new MeterModel();
        $village_array = M('house_village')->where(array('status'=>1))->select();
        $this->assign('village_array',$village_array);
        if($_FILES){

            $village_id = $model->get_village();//获取社区id

            if(!$village_id){
                $this->error("请选择社区");
            }

            $res = $model->tenant_import($village_id);//导入
            if($res){
                $this->success("成功");
            }else{
                $this->error("失败");
            }

        }else{

            $this->display();

        }
    }

    /**
     * 设备列表
     */
    public function meter_lists(){
        $model = new MeterModel();
        $list = $model->meter_list();
        $this->assign('list',$list);
        $this->display('meter_lists');
    }

    public function logic_del_meter($meter_hash){
        $model = new MeterModel();
        $re = $model->logic_del_meter($meter_hash);
        if($re!==false){
            $this->success("删除成功");
        }else{
            $this->error("发生错误,删除失败");
        }
    }


    /**
     * 设备导入
     */
    public function import_meter(){
        $model = new MeterModel();
        if($_FILES){
            $model->meter_import();
            $this->success("成功");
        }else{
            $this->display();
        }

    }

    public function meter_qr($meter_hash){
        $url = C('WEB_DOMAIN') . '/wap.php?g=Wap&c=Meter&a=enter&meter_hash=' . $meter_hash;
        $qr_url =  U('show_qr') . '&url=' . urlencode($url);
        $this->assign('url',$url);
        $this->assign('qr_url',$qr_url);
        $this->display();
    }

    public function show_qr($url){
        qr($url);
    }

    /**
     * 业主列表
     */
    public function tenant_list(){

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
            'p.pigcms_id'=>'pid',

        );
        //搜索条件
        $get = search_filter($_GET);
        $map = array();
        if($keywords = $get['keywords']){
            $map['ub.tenantname|f.name'] = array('like','%' . $keywords . '%');
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
        if(session('system.account')!=="admin"){
            session('system.village_id') && $map['v.village_id'] = array('eq',session('system.village_id'));
            if(
                session('system.company_id')
                && !in_array(session('system.role_id'),[48,47,46,45,43,42,38])
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
            //处理楼层信息
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
            //处理缴费信息
            if($row['water_price']!=0){
                $is_haveOrder = M('house_village_pay_order')->where(array('pid'=>$row['pid'],'order_type'=>'water','is_pay'=>1))->find();
                if($is_haveOrder){
                    $row['water_price']=0;
                }
            }
            if($row['electric_price']!=0){
                $is_haveOrder = M('house_village_pay_order')->where(array('pid'=>$row['pid'],'order_type'=>'electric','is_pay'=>1))->find();
                if($is_haveOrder){
                    $row['electric_price']=0;
                }
            }
            if($row['property_price']!=0){
                $is_haveOrder = M('house_village_pay_order')->where(array('pid'=>$row['pid'],'order_type'=>'property','is_pay'=>1))->find();
                if($is_haveOrder){
                    $row['property_price']=0;
                }
            }
            if($row['water_price']!=0&&$row['electric_price']!=0&&$row['property_price']!=0){
                $is_haveOrder = M('house_village_pay_order')->where(array('pid'=>$row['pid'],'order_type'=>'all','is_pay'=>1))->find();
                if($is_haveOrder){
                    $row['water_price']=0;
                    $row['electric_price']=0;
                    $row['property_price']=0;
                }
            }

        }
        $this->assign('list',$list);
        $this->assign('pagebar',$page->show());//页码栏
        $this->display('tenant_list');
    }


    public function tenant_list_bck(){

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
            'p.pigcms_id'=>'pid',

        );
        //搜索条件
        $get = search_filter($_GET);
        $map = array();
        if($keywords = $get['keywords']){
            $map['ub.tenantname|f.name'] = array('like','%' . $keywords . '%');
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
        if(session('system.account')!=="admin"){
            session('system.village_id') && $map['v.village_id'] = array('eq',session('system.village_id'));
            if(
                session('system.company_id')
                && !in_array(session('system.role_id'),[48,47,46,45,43,42,38])
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
        $this->display('tenant_list');
    }



    public function modal_meter_qr($meter_hash){
        $url = C('WEB_DOMAIN') . '/wap.php?g=Wap&c=Meter&a=enter&meter_hash=' . $meter_hash;
        $qr_url =  U('show_qr') . '&url=' . urlencode($url);
        $this->assign('url',$url);
        $this->assign('qr_url',$qr_url);
        $this->display();
    }



    /**
     * 设备列表弹出层
     * @param $tid
     */
    public function modal_bind_meter_list($tid){
        //session('addd_debug',true);
        $model = new MeterModel();
        $bind_meters = $model->get_tenant_meter_data($tid);
        $tenant_info = M('house_village_user_bind')->where('pigcms_id=%d',$tid)->find();
        //$this->assign('bind_meters',$bind_meters);
        $this->assign('tenant_info',$tenant_info);
        $this->display();
    }

    public function ajax_get_bind_meter_list($tid){
        //session('addd_debug',true);
        $model = new MeterModel();
        $bind_meters = $model->get_tenant_meter_data($tid);
        $tenant_info = M('house_village_user_bind')->where('pigcms_id=%d',$tid)->find();
        $this->ajaxReturn(array('err'=>0,'msg'=>"",'data'=>$bind_meters));
    }

    /**
     * 绑定设备弹出层
     * @param $tid
     */
    public function bind_meter($tid){
        $model = new MeterModel();

        //获取业主信息
        $tenant_info = M('house_village_user_bind')->where('pigcms_id=%d',$tid)->find();
        $this->assign('tenant_info',$tenant_info);
        $this->assign('floors',$model->get_meter_floors());  //获取所有楼层
        $this->assign('meter_type_list',$model->get_meter_type_list()); //获取设备类型列表
        $this->display();
    }


    /**
     * 获取设备所有列表
     */
    public function ajax_get_meter_list(){
        $model = new MeterModel();
        $meter_list = $model->meter_list();
        $this->ajaxReturn(array('err'=>0,'msg'=>'成功','data'=>$meter_list));
    }

    public function modal_meter_set($meter_hash,$tid){
        $model = new MeterModel();
        $meter_info = $model->meter_info($meter_hash);
        $meter_type_id = $meter_info['meter_type_id'];
        $price_types = M('re_setmeter_config')->where('pid=%d',$meter_type_id)->select();
        $scale = M('house_village_tm')->where('meter_hash="%s" and tid=%d',$meter_hash,$tid)->getField('scale');
        $this->assign('price_types',$price_types);
        $this->assign('meter_info',$meter_info);
        $this->assign('scale',$scale);
        $this->display();
    }


    /**
     * 异步绑定设备
     * @param $tid //租户ID
     * @param $meter_hash //设备hash
     */
    public function ajax_bind_meter_act($tid,$meter_hash){
        $model = new MeterModel();
        $save_data = array(
            'tid'=>$tid,
            'meter_hash'=>$meter_hash,
        );
//        $re = $model->save_meter($save_data);
        $re = M('house_village_tm')->add($save_data);//可覆盖

        //$re = true;
        if($re!==false){
            $meter_info = $model->meter_info($meter_hash);
            $this->ajaxReturn(array('err'=>0,'msg'=>"成功",'data'=>$meter_info));
        }else{
            $this->ajaxReturn(array('err'=>1,'msg'=>"失败",'data'=>mysql_error()));
        }
    }

    public function ajax_unbind_meter_act($tid,$meter_hash){
        $model = new MeterModel();
        $save_data = array(
            'tid'=>$tid,
            'meter_hash'=>$meter_hash,
        );
//        $re = $model->save_meter($save_data);
        $re = M('house_village_tm')->where('meter_hash="%s" and tid=%d',$meter_hash,$tid)->delete();

        //$re = true;
        if($re!==false){
            $meter_info = $model->meter_info($meter_hash);
            $this->ajaxReturn(array('err'=>0,'msg'=>"成功",'data'=>$meter_info));
        }else{
            $this->ajaxReturn(array('err'=>1,'msg'=>"失败",'data'=>mysql_error()));
        }
    }

    /**
     * 每月账单预览
     * @update-time: 2017-09-04 15:55:12
     * @author: 王亚雄
     */
    public function exit_xls(){

        $model = new MeterModel();
        $village_id = I('get.village_id',4,'intval');
        $list = $model->get_tenant_cousume_list($village_id);
        $village_array = $model->get_village_list();
        $this->assign('village_array',$village_array);
//       dump($list); exit();
        $this->assign('list',$list);
        //dump($list);
        $this->display('exit_xls');

    }

    /**
     * 编辑其他项目的金额和名称
     * @time 2017年9月20日17:21:50
     * @author 祝君伟
     */
    public function edit_other(){
        //判断是否生成账单
        $usernum = I('get.usernum');
        $is_create = M('house_village_user_paylist')->getByUsernum($usernum);
        if(!$is_create){
            //没有账单先生成账单

            $tid = I('get.tid',0);
            $model = new MeterModel();
            if($tid=="all"){
                $village_id = I('get.village_id',4);
                $data = $model->get_tenant_cousume_list($village_id);
            }else{
                $village_id = $model->tid2vid($tid);
                $data = $model->get_tenant_cousume_list($village_id,$tid);
            }

            $add_flag = true;
            foreach($data as $key=>&$row){
                if($row['is_enter']==0||$row['is_enter_paylist']){//删除未统计完成的业主和已经生成账单的业主
                    unset($data[$key]);
                    continue;
                }
                $row['create_date']     = date("Y-m");
                $row['add_time']        = time();
                $row['name']            = $row['names']?:'';
                $row['phone']           = $row['phones']?:'';
                $row['use_water']       = $row['water_cousume']?:0;
                $row['use_electric']    = $row['electricity_cousume']?:0;
                $row['property_price']  = $row['property_total_price']?:0;
                $row['water_price']     = $row['water_total_price_true']?:0;
                $row['electric_price']  = $row['electricity_total_price_true']?:0;
                $row['is_enter_list']  = 0;
                //添加数据
                //vd($row);exit();
                $add_flag *= M('house_village_user_paylist')->add($row);
                //vd(mysql_error());
                //更新设备止码
                foreach($row['already_record_data'] as $kk=>$rr){
                    $re = $model->set_be_cousume($rr['meter_hash'],$rr['last_total_consume'],$rr['total_consume']);
                }
            }
        }
        $payListInfo = M('house_village_user_paylist')->getByUsernum($usernum);
        $this->assign('otherList',unserialize($payListInfo['use_other']));
        $total_price =$payListInfo['water_price']+$payListInfo['electric_price']+$payListInfo['property_price'];
        if(unserialize($payListInfo['use_other'])){
            foreach (unserialize($payListInfo['use_other']) as $value){
                $total_price += $value;
            }
        }
        $total_price = sprintf("%.2f",$total_price);
        $this->assign('total_price',$total_price);
        $this->assign('payListInfo',$payListInfo);
        $this->display('edit_other');
    }

    public function look_list(){
        $usernum = I('get.usernum');
        $payListInfo = M('house_village_user_paylist')->getByUsernum($usernum);
        $this->assign('otherList',unserialize($payListInfo['use_other']));
        $total_price =$payListInfo['water_price']+$payListInfo['electric_price']+$payListInfo['property_price'];
        if(unserialize($payListInfo['use_other'])){
            foreach (unserialize($payListInfo['use_other']) as $value){
                $total_price += $value;
            }
        }
        $total_price = sprintf("%.2f",$total_price);
        $this->assign('total_price',$total_price);
        $this->assign('payListInfo',$payListInfo);
        $this->display('look_list');
    }

    /**
     * 添加新的项目和价格
     *
     */
    public function add_other(){
        //反转义实体，否则不能json_decode
        $nameArray= json_decode(htmlspecialchars_decode($_POST['name']),true);
        $valueArray = json_decode(htmlspecialchars_decode($_POST['value']),true);
        $id = I('post.id');
        if(empty($id)&&!isset($id)) exit;
        //新添加数组
        $addArray = array();
        foreach ($nameArray as $key=>$value){
            $addArray[$value] = $valueArray[$key];
        }
        //原数组
        $payListInfo = M('house_village_user_paylist')->find($id);
        $oldArray = unserialize($payListInfo['use_other'])?:array();
        $newArray = array_merge($oldArray,$addArray);
        // vd($newArray);exit;
        //计算总价格
        $other_total_price =0;
        $total_price =$payListInfo['water_price']+$payListInfo['electric_price']+$payListInfo['property_price'];
        foreach ($newArray as $sv){
            $total_price += $sv;
            $other_total_price += $sv;
        }
        $total_price = sprintf("%.2f",$total_price);
        //制作插入数组
        $addDate = array(
            'use_other'=>serialize($newArray),
            'other_price'=>$other_total_price,
            'total_price'=>$total_price
        );
        //vd($usernum);exit;
        //插入数据库
        $res = M('house_village_user_paylist')->where(array('pigcms_id'=>$id))->data($addDate)->save();

        if($res){
            echo $total_price;
        }else{
            echo '失败了';
        }

    }

    /**
     * 单个编辑水电物业费
     */
    public function edit_this_other(){
        $field = I('post.field');
        $value = I('post.value');
        $id = I('post.id');
        if(!$id){
            echo 2;
        }else{
            $res = M('house_village_user_paylist')->where(array('pigcms_id'=>$id))->data(array($field=>$value))->save();
            if($res){
                //再次查询所有的价格返回
                $after_info = M('house_village_user_paylist')->find($id);
                $total_price = $after_info['water_price']+$after_info['electric_price']+$after_info['property_price']+$after_info['other_price'];
                echo $total_price;
            }else{
                echo 3;
            }
        }
    }

    /**
     * 单个编辑其他费
     */
    public function edit_this_other2(){
        $field_name = I('post.field_name');
        $field_value = I('post.field_value');
        $id = I('post.id');
        if(!$id){
            echo 2;
        }else{
            $info =  M('house_village_user_paylist')->find($id);
            $otherArray = unserialize($info['use_other']);
            $other_price = 0;
            foreach ($otherArray as $key=>$value){
                if($key==$field_name){
                    $otherArray[$field_name] = $field_value;
                    $other_price = $other_price+$field_value;
                }else{
                    $other_price +=$value;
                }
            }
            //vd($other_price);exit;
            $res = M('house_village_user_paylist')->where(array('pigcms_id'=>$id))->data(array('use_other'=>serialize($otherArray),'other_price'=>$other_price))->save();
            if($res){
                //再次查询所有的价格返回
                $after_info = M('house_village_user_paylist')->find($id);
                $total_price = $after_info['water_price']+$after_info['electric_price']+$after_info['property_price']+$after_info['other_price'];
                echo $total_price;
            }else{
                echo 3;
            }
        }
    }

    /**
     * 选择发送模板
     */
    public function choose_template(){
        if(IS_POST){

            $type = I('post.type');

            $pay_id = I('post.pay_id');

            $ym = !empty(I('post.ym'))?I('post.ym'):date('Y-m');

            $info = M('house_village_user_paylist')->find($pay_id);
            if($info){
                $res = M('house_village_user_paylist')->where(array('pigcms_id'=>$pay_id))->data(array('is_enter_list'=>1))->save();
                if($res){
                    //查询当前user的openid
                    //修改 曾梦飞
//                    $uidArr =
//                    $uid = M('house_village_user_bind')->getFieldByUsernum($info['usernum'],'uid');
                    $uidStr = M('house_village_user_bind')->getByUsernum($info['usernum']);

                    //dump($uidStr);exit();
                    if($uidStr['uid'] == null){
                        echo 4;

                    }else{
                        $uidArray = explode(',',$uidStr['uid']);

                        //微信类库
                        $wechat = new WechatModel();

                        //流程审批提醒模板ID
                        $tpl_id = "xLpzcYPX-Kgwsx6Ym3sHjp_CmZhn_n65_-v6CxC4gAc";
                        $urlWater=C('WEB_DOMAIN').'/wap.php?m=Wap&c=PropertyService&a=show_this_template&usernum='.$info['usernum'].'&type=1&ym='.$ym;
                        $dataWater = array(
                            'first'=>array(
                                'value'=>"您的".$ym."水电账单已经生成",
                                'color'=>"#029700",
                            ),
                            'keyword1'=>array(
                                'value'=>"请点击查看本月账单",
                                'color'=>"#000000",
                            ),
                            'keyword2'=>array(
                                'value'=>$uidStr['tenantname'],//人
                                'color'=>"#000000",
                            ),
                            'keyword3'=>array(
                                'value'=>'请尽快缴费，避免对您的使用造成影响',
                                'color'=>"#000000",
                            ),
                            'keyword4'=>array(
                                'value'=>date('Y-m-d H:i:s',time()),
                                'color'=>"#000000",
                            ),
                        );
                        $urlProperty=C('WEB_DOMAIN').'/wap.php?m=Wap&c=PropertyService&a=show_this_template&usernum='.$info['usernum'].'&type=2&ym='.$ym;
                        $dataProperty = array(
                            'first'=>array(
                                'value'=>"您的".$ym."物业账单已经生成",
                                'color'=>"#029700",
                            ),
                            'keyword1'=>array(
                                'value'=>"请点击查看本月账单",
                                'color'=>"#000000",
                            ),
                            'keyword2'=>array(
                                'value'=>$uidStr['tenantname'],//人
                                'color'=>"#000000",
                            ),
                            'keyword3'=>array(
                                'value'=>'请尽快缴费，避免对您的使用造成影响',
                                'color'=>"#000000",
                            ),
                            'keyword4'=>array(
                                'value'=>date('Y-m-d H:i:s',time()),
                                'color'=>"#000000",
                            ),
                        );

                        //建立标志数组

                        $_flag =array();

                        foreach ($uidArray as $v) {
                            $userInfo = M('user')->find($v);

                            if($type==1){
                                //两个账单都发送
                                $res = $wechat->send_tpl_message($userInfo['openid'], $tpl_id, $urlWater, $dataWater);
                                $wechat->send_tpl_message($userInfo['openid'], $tpl_id, $urlProperty, $dataProperty);
                                if($res[0]['errcode']!==0){
                                    //TODO::与用户方逻辑无关，暂不提醒，应记录在日志系统当中
                                    // $this->error("推送消息失败");
                                }else{
                                    $_flag[]=0;
                                }

                            }else if($type==2){
                                //发物业不发水电
                                $res = $wechat->send_tpl_message($userInfo['openid'], $tpl_id, $urlProperty, $dataProperty);
                                if($res[0]['errcode']!==0){
                                    //TODO::与用户方逻辑无关，暂不提醒，应记录在日志系统当中
                                    // $this->error("推送消息失败");
                                }else{
                                    $_flag[]=0;
                                }
                            }else if($type==3){
                                //发水电不发物业
                                $res = $wechat->send_tpl_message($userInfo['openid'], $tpl_id, $urlWater, $dataWater);
                                if($res[0]['errcode']!==0){
                                    //TODO::与用户方逻辑无关，暂不提醒，应记录在日志系统当中
                                    // $this->error("推送消息失败");
                                }else{
                                    $_flag[]=0;
                                }

                            }else if($type==0){
                                //物业水电都不发
                                $_flag[]=4;
                            }
                        }

                    }

                    if(in_array(0,$_flag))
                    {
                        echo 0;
                    }elseif (in_array(4,$_flag)){
                        echo 4;
                    }

                }else{
                    echo 2;
                }
            }else{
                echo 3;
            }



        }else{
            $ym = isset($_GET['ym'])?$_GET['ym']:date('Y-m');
            $usernum = I('get.usernum');
            $userInfo = M('house_village_user_bind')->getByUsernum($usernum);
            $payListInfo = M('house_village_user_paylist')->where(array('usernum'=>$usernum,'create_date'=>$ym))->find();
//            dump($payListInfo);exit;
            $usernum = $userInfo['usernum'];
            $bindArr = M('house_village_user_bind')->where(array('usernum'=>$usernum))->find();
            $uidStr = $bindArr['uid'];
            if ($uidStr) {
                $nickData = array();
                $uidArr = explode(',',$uidStr);
                foreach ($uidArr as $k => $v) {
                    $userArr = D('user')->where(array('uid'=>$v))->find();
                    $nickData[$k]['uid'] = $v;
                    $nickData[$k]['avatar'] = $userArr['avatar'];
                    $nickData[$k]['nickname'] = $userArr['nickname'];
                }

                $this->assign('nickData',$nickData);
            }

            $assignArray = array(
                'ym'=>$ym,
                'id'=>$userInfo['usernum'],
                'name'=>$userInfo['name']?:$userInfo['tenantname'],
                'month'=>date('m'),
                'pay_id'=>$payListInfo['pigcms_id']
            );
            //vd($userInfo);exit;
            $this->assign('assignArray',$assignArray);
            $this->display();
        }

    }


    /**
     * 预览发送模板
     * @param  $meter_type string  1 水费  5 电费
     * @param  $type  查看的物业费还是水电
     */
    public function show_this_template_bck(){

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

            $other_total_price=0;

            foreach ($other_array as $sv){
                $other_total_price += $sv;
            }

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
                'set_start_time'=>$presonInfo[0]['set_start_time'],
                'set_end_time'=>$presonInfo[0]['set_end_time'],
                'end_year'=>$endYear,
                'end_month'=>$endMonth
            );

            foreach ($meterWaterArray as $wk=>$wv){

                $meterWaterArray[$wk]['now_consume'] = round($wv['total_consume']-$wv['last_total_consume'],2);

                $billTemplateArray['total_water'] += round($wv['cost'],2);

            }


            foreach ($meterElectricArray as $ek=>$ev){

                $meterElectricArray[$ek]['now_consume'] = round($ev['total_consume']-$ev['last_total_consume'],2);

                $billTemplateArray['total_electric'] += round($ev['now_consume'],2);

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


    public function show_this_template(){

        $type = I('get.type');


        $ym = empty(I('get.ym'))?date('Y-m'):I('get.ym');


        $endYear = date('Y',strtotime('+1 month',strtotime($ym)));

        $endMonth = date('m',strtotime('+1 month',strtotime($ym)));

        $usernum = I('get.usernum');

        $userInfo = M('house_village_user_bind')->getByUsernum($usernum);

        //其他费用

        $other_array = M('house_village_user_paylist')->where(array('usernum'=>$usernum,'create_date'=>$ym))->find()['use_other'];


        $other_total_price=0;

        if($other_array!=''){

            $other_array = unserialize($other_array);

            foreach ($other_array as $sv){
                $other_total_price += $sv;
            }



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
                'set_start_time'=>$presonInfo[0]['set_start_time'],
                'set_end_time'=>$presonInfo[0]['set_end_time'],
                'end_year'=>$endYear,
                'end_month'=>$endMonth,
                'scale'=>$presonInfo[0]['original_room_data'][0]['scale']
            );


            $billTemplateArray['electric_public']  = 0;

            $billTemplateArray['water_public'] = 0;

            foreach ($meterWaterArray as $wk=>$wv){

                $meterWaterArray[$wk]['now_consume'] = round($wv['total_consume']-$wv['last_total_consume'],2)*$wv['rate'];

                $meterWaterArray[$wk]['now_rate'] = $wv['rate'];

//                $billTemplateArray['total_water'] += $wv['cost'];

                if ($wv['admin_defined_price'] > 0) {
                    $money = $wv['admin_defined_price'];
                } else {
                    $money = $wv['cost'];
                }

                $billTemplateArray['total_water'] += $money;

                if($wv['is_public'] == 1)
                {
                    $billTemplateArray['water_public'] +=  round($wv['cost'],2);
                }

            }

            $billTemplateArray['total_water'] = round($billTemplateArray['total_water'],2);



            foreach ($meterElectricArray as $ek=>$ev){

                $meterElectricArray[$ek]['now_consume'] = round($ev['total_consume']-$ev['last_total_consume'],2)*$ev['rate'];

                $meterElectricArray[$ek]['now_rate'] = $ev['rate'];

//                $billTemplateArray['total_electric'] += $ev['cost'];

                if ($ev['admin_defined_price'] > 0) {
                    $money = $ev['admin_defined_price'];
                } else {
                    $money = $ev['cost'];
                }

                $billTemplateArray['total_electric'] += $money;

                if($ev['is_public'] == 1)
                {
                    $billTemplateArray['electric_public'] +=  round($ev['cost'],2);
                }

            }

            $billTemplateArray['total_electric'] = round($billTemplateArray['total_electric'],2);

            $billTemplateArray['water']=$meterWaterArray;

            $billTemplateArray['electric']=$meterElectricArray;

            $billTemplateArray['total_money']=$billTemplateArray['total_electric']+$billTemplateArray['total_water']+$other_total_price;



            $billTemplateArray['other'] = $other_array;

            $html = $this->create_table($billTemplateArray);

            $this->assign('bill_html',$html);


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


        $y = substr($ym,0,4);
        $m = substr($ym,strpos($ym,'-')+1);
        if ($m[0] == 0) {
            $m = $m[1];
        }

        $this->assign('m',$m);

        $this->assign('y',$y);

        $this->assign('billTemplateArray',$billTemplateArray);

        $this->display();

    }

    /**
     * 打印催费模版
     * @author 祝君伟
     */
    public function print_this_template(){

        $type = I('get.type');


        $ym = empty(I('get.ym'))?date('Y-m'):I('get.ym');


        $endYear = date('Y',strtotime('+1 month',strtotime($ym)));

        $endMonth = date('m',strtotime('+1 month',strtotime($ym)));

        $usernum = I('get.usernum');

        $userInfo = M('house_village_user_bind')->getByUsernum($usernum);

        //其他费用

        $other_array = M('house_village_user_paylist')->where(array('usernum'=>$usernum,'create_date'=>$ym))->find()['use_other'];


        $other_total_price=0;

        if($other_array!=''){

            $other_array = unserialize($other_array);

            foreach ($other_array as $sv){
                $other_total_price += $sv;
            }



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
                'set_start_time'=>$presonInfo[0]['set_start_time'],
                'set_end_time'=>$presonInfo[0]['set_end_time'],
                'end_year'=>$endYear,
                'end_month'=>$endMonth,
                'scale'=>$presonInfo[0]['original_room_data'][0]['scale']
            );


            $billTemplateArray['electric_public']  = 0;

            $billTemplateArray['water_public'] = 0;

            foreach ($meterWaterArray as $wk=>$wv){

                $meterWaterArray[$wk]['now_consume'] = round($wv['total_consume']-$wv['last_total_consume'],2)*$wv['rate'];

                $meterWaterArray[$wk]['now_rate'] = $wv['rate'];

//                $billTemplateArray['total_water'] += $wv['cost'];

                if ($wv['admin_defined_price'] > 0) {
                    $money = $wv['admin_defined_price'];
                } else {
                    $money = $wv['cost'];
                }

                $billTemplateArray['total_water'] += $money;

                if($wv['is_public'] == 1)
                {
                    $billTemplateArray['water_public'] +=  round($wv['cost'],2);
                }

            }

            $billTemplateArray['total_water'] = round($billTemplateArray['total_water'],2);


            foreach ($meterElectricArray as $ek=>$ev){

                $meterElectricArray[$ek]['now_consume'] = round($ev['total_consume']-$ev['last_total_consume'],2)*$ev['rate'];

                $meterElectricArray[$ek]['now_rate'] = $ev['rate'];

//                $billTemplateArray['total_electric'] += $ev['cost'];

                if ($ev['admin_defined_price'] > 0) {
                    $money = $ev['admin_defined_price'];
                } else {
                    $money = $ev['cost'];
                }

                $billTemplateArray['total_electric'] += $money;

                if($ev['is_public'] == 1)
                {
                    $billTemplateArray['electric_public'] +=  round($ev['cost'],2);
                }


            }

            $billTemplateArray['total_electric'] = round($billTemplateArray['total_electric'],2);

            $billTemplateArray['water']=$meterWaterArray;

            $billTemplateArray['electric']=$meterElectricArray;

            $billTemplateArray['total_money']=$billTemplateArray['total_electric']+$billTemplateArray['total_water']+$other_total_price;

            $billTemplateArray['other'] = $other_array;

            $html = $this->create_table($billTemplateArray);

            $this->assign('bill_html',$html);


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
        $y = substr($ym,0,4);
        $m = substr($ym,strpos($ym,'-')+1);
        if ($m[0] == 0) {
            $m = $m[1];
        }

        $this->assign('m',$m);

        $this->assign('y',$y);

        $this->assign('billTemplateArray',$billTemplateArray);

        $this->display();

    }



    /**
     * 改变账单状态,发送模板消息
     */
    public function enter_list(){
        $id = I('post.id');
        $info = M('house_village_user_paylist')->find($id);
        if($info){
            $res = M('house_village_user_paylist')->where(array('pigcms_id'=>$id))->data(array('is_enter_list'=>1))->save();
            if($res){
                //查询当前user的openid
                $uid = M('house_village_user_bind')->getFieldByUsernum($info['usernum'],'uid');
                if($uid == null){
                    //根据所提供的手机号匹配
                    $userInfo = M('user')->getByPhone($info['phone']);
                }else{
                    $userInfo = M('user')->find($uid);
                }

                //微信类库
                $wechat = new WechatModel();
                $url=C('WEB_DOMAIN').'/wap.php?m=Wap&c=PropertyService&a=payListInfo&id='.$id;
                //流程审批提醒模板ID
                $tpl_id = "xLpzcYPX-Kgwsx6Ym3sHjp_CmZhn_n65_-v6CxC4gAc";
                $data = array(
                    'first'=>array(
                        'value'=>"您的".date('Y-m')."账单已经生成",
                        'color'=>"#029700",
                    ),
                    'keyword1'=>array(
                        'value'=>"请点击查看本月账单",
                        'color'=>"#000000",
                    ),
                    'keyword2'=>array(
                        'value'=>$userInfo['name'],//人
                        'color'=>"#000000",
                    ),
                    'keyword3'=>array(
                        'value'=>'请尽快缴费，避免对您的使用造成影响',
                        'color'=>"#000000",
                    ),
                    'keyword4'=>array(
                        'value'=>date('Y-m-d H:i:s',time()),
                        'color'=>"#000000",
                    ),
                );
                if($userInfo['openid']){
                    $res = $wechat->send_tpl_message($userInfo['openid'], $tpl_id, $url, $data);
                    if($res[0]['errcode']!==0){
                        //TODO::与用户方逻辑无关，暂不提醒，应记录在日志系统当中
                        // $this->error("推送消息失败");
                    }
                }else{
                    return false;
                }
                echo 1;
            }else{
                echo 2;
            }
        }else{
            echo 0;
        }
    }


    public function enter_list_test(){


        //微信类库
        $wechat = new WechatModel();
        $url=C('WEB_DOMAIN').'/wap.php?m=Wap&c=PropertyService&a=payListInfo&id=1276';
        //流程审批提醒模板ID
        $tpl_id = "xLpzcYPX-Kgwsx6Ym3sHjp_CmZhn_n65_-v6CxC4gAc";
        $data = array(
            'first'=>array(
                'value'=>"您的".date('Y-m')."账单已经生成",
                'color'=>"#029700",
            ),
            'keyword1'=>array(
                'value'=>"请点击查看本月账单",
                'color'=>"#000000",
            ),
            'keyword2'=>array(
                'value'=>'lalala',//人
                'color'=>"#000000",
            ),
            'keyword3'=>array(
                'value'=>'请尽快缴费，避免对您的使用造成影响',
                'color'=>"#000000",
            ),
            'keyword4'=>array(
                'value'=>date('Y-m-d H:i:s',time()),
                'color'=>"#000000",
            ),
        );

        $res = $wechat->send_tpl_message('ohgcf0jGkXflfD05o04YssN3HIwE', $tpl_id, $url, $data);
        if($res[0]['errcode']!==0){
            //TODO::与用户方逻辑无关，暂不提醒，应记录在日志系统当中
            // $this->error("推送消息失败");
        }



    }

    /**
     * 出账操作
     */
    public function enter_paylist(){
        $tid = I('get.tid',0);
        $model = new MeterModel();
        if($tid=="all"){
            $village_id = I('get.village_id',4);
            $data = $model->get_tenant_cousume_list($village_id);
        }else{
            $village_id = $model->tid2vid($tid);
            $data = $model->get_tenant_cousume_list($village_id,$tid);
        }

        $add_flag = true;
        foreach($data as $key=>&$row){
            if($row['is_enter']==0||$row['is_enter_paylist']){//删除未统计完成的业主和已经生成账单的业主
                unset($data[$key]);
                continue;
            }
            $row['create_date']     = date("Y-m");
            $row['add_time']        = time();
            $row['name']            = $row['names'];
            $row['phone']           = $row['phones'];
            $row['use_water']       = $row['water_cousume'];
            $row['use_electric']    = $row['electricity_cousume'];
            $row['property_price']  = $row['property_total_price'];
            $row['water_price']     = $row['water_total_price_true'];
            $row['electric_price']  = $row['electricity_total_price_true'];
            //添加数据
            $add_flag *= M('house_village_user_paylist')->add($row);
            //更新设备止码
            foreach($row['already_record_data'] as $kk=>$rr){
                $re = $model->set_be_cousume($rr['meter_hash'],$rr['last_total_consume'],$rr['total_consume']);
            }
        }

        if($add_flag){
            $this->ajaxReturn(array('err'=>0,'msg'=>"成功",'data'=>$data));
        }else{
            $this->ajaxReturn(array('err'=>1,'msg'=>"失败",'data'=>$data));
        }

    }

    /**
     * 计费配置
     */
    public function save_meter_set(){
        $meter_hash = I('get.meter_hash');
        $scale = I('get.scale');
        $price_type_id = I('get.price_type_id');
        $tid = I('get.tid');
        $rate = I('get.rate');
        $re1 = M('house_village_meters')->where('meter_hash="%s"',$meter_hash)->save(
            array(
                'price_type_id'=>$price_type_id,
                'rate'=>$rate,
            )
        );
        $re2 = M('house_village_tm')->where('meter_hash="%s" and tid=%d',$meter_hash,$tid)->save(
            array(
                'scale'=>$scale
            )
        );
        if($re1!==false&&$re2!==false){
            $this->ajaxReturn(array('err'=>0,'msg'=>'','data'=>$_GET));
        }else{
            $this->ajaxReturn(array('err'=>1,'msg'=>'','data'=>$_GET));
        }


    }

    /**
     * 添加设备表单
     */
    public function add_meter(){

        $model = new MeterModel();

        $this->assign('price_type_list_json',$model->get_price_type_list(true));
        $this->assign('meter_type_list_json',$model->get_meter_type_list(true));
        $this->assign('type_data_json',json_encode(tree_to_list(re_setmeter_config())));
        $this->assign('room_list_json',$model->room_list(true));
        $this->assign('village_list_json',$model->get_village_list(true));

        $this->display();

    }

    /**
     * 添加设备执行
     */
    public function add_meter_act(){

//        $rate = I('post.rate');
        //验证
        $meter_code = I('post.meter_code');
        $last_cousume = I('post.last_cousume');
        if(!$meter_code) $this->error("请输入设备编号");
        if(!$last_cousume) $this->error("请输入用量");
        $meter_floor = I('post.meter_floor');
        if(!$meter_floor) $this->error("请选择楼层");

        //数据
        $data = $_POST;
        $data['meter_hash'] = MD5($meter_code . '&&' . $meter_floor);
        $data['create_time'] = time();
        $data['be_cousume'] = 0 . ',' . $last_cousume;
        $data['be_date'] = "0000-00-00" . ',' . date("Y-m-d");
        $data['floor_id'] = I('post.floor_id');
        $data['room_id'] = join(',',I('post.room_id'));
        $data['meter_floor'] = $meter_floor;
        $re = M('house_village_meters')->add($data);
        if($re!==false){
            $this->success("添加成功",U('meter_lists'));
        }else{
            $this->error("发生错误");
        }

    }

//    public function edit_meter($meter_hash){
//        $meter_info = M('house_village_meters')->alias('m')
//            ->join('left join __HOUSE_VILLAGE_ROOM__ f on f.id=m.floor_id')
//            ->where('m.meter_hash="%s"',$meter_hash)
//            ->find();
//        if(!$meter_info) $this->error("数据丢失");
//        $model = new MeterModel();
//        $this->assign('meter_info',$meter_info);
//        $this->assign('price_type_list_json',$model->get_price_type_list(true));
//        $this->assign('meter_type_list_json',$model->get_meter_type_list(true));
//        $this->assign('room_list_json',$model->room_list(true));
//        $this->assign('type_data_json',$model->room_list(true));
//        $this->assign('village_list_json',$model->get_village_list(true));
//        $this->display();
//    }

    public function edit_meter($meter_hash){
        $meter_info = M('house_village_meters')->where('meter_hash="%s"',$meter_hash)->find();
        if(!$meter_info) $this->error("数据丢失");
        $this->assign('meter_info',$meter_info);
        $model = new MeterModel();
        $this->assign('price_type_list',$model->get_price_type_list());
        $this->assign('meter_type_list',$model->get_meter_type_list());
        $this->display();

    }


    public function edit_meter_act($meter_hash){
        //$meter_code = I('post.meter_code');
        $last_cousume = I('post.last_cousume');
        // if(!$meter_code) $this->error("请输入设备编号");
        // if(!$last_cousume) $this->error("请输入用量");

        //数据
        $data = $_POST;
        $data['create_time'] = time();
        $data['be_cousume'] = 0 . ',' . $last_cousume;
        $re = M('house_village_meters')->where('meter_hash="%s"',$meter_hash)->save($data);
        if($re!==false){
            $this->success("修改成功",U('meter_lists'));
        }else{
            $this->error("发生错误");
        }
    }


    /**
     * 账单预览 统计已抄表和未抄表设备
     */
    public function modal_record_meter(){
        $model = new MeterModel();
        $tid = I('get.tid');
        $meter_type_id = I('get.meter_type_id');
        $village_id = $model->tid2vid($tid);
        $data = $model->get_tenant_cousume_list($village_id,$tid)[0];



        $ard = $data['already_record_data'];
        $nrd = $data['no_record_data'];
        $ard_total['true_price'] = 0;
        $ard_total['price'] = 0;
        foreach ($ard as $key=>&$row){
            if($row['meter_type_id']!=$meter_type_id){
                unset($ard[$key]);
            }else{
                $meter_info = $model->meter_info($row['meter_hash'])?:array();
                //获取真实费用
                $row['true_price'] = $row['admin_defined_price']>0?$row['admin_defined_price']:$row['price'];
                $row = array_merge($row,$meter_info);
                $ard_total['true_price'] += $row['true_price'];
                $ard_total['price'] += $row['price'];
                $ard_total['cousume'] += $row['cousume'];
            }
        }

        foreach($nrd as $key=>&$row){
            if($row['meter_type_id']!=$meter_type_id){
                unset($nrd[$key]);
            }else{
                $meter_info = $model->meter_info($row['meter_hash'])?:array();
                $row = array_merge($row,$meter_info);
            }
        }

        $this->assign('is_enter_paylist',$data['is_enter_paylist']);//是否已经出账
        $this->assign('is_enter',$data['is_enter']);//是否抄录完成
        $this->assign('tid',$tid);//是否抄录完成
        $this->assign('ard',$ard);
        $this->assign('nrd',$nrd);
        $this->assign('ard_total',$ard_total);

        $this->display();
    }

    /**
     * 管理员修改金额
     */
    public function admin_defined_price($cid,$val){
        $re = M('re_setmeter')->where('id=%d',$cid)->setField('admin_defined_price',$val);
        if($re!==false){
            $this->ajaxReturn(array('err'=>0,'msg'=>"成功",'data'=>$val));
        }else{
            $this->ajaxReturn(array('err'=>1,'msg'=>"失败",'data'=>mysql_error()));
        }

    }

    public function edit_paylist_price($usernum,$val,$meter_type_id){

        switch ($meter_type_id){
            case 1:
                $field_name = "water_price";
                break;
            case 5:
                $field_name = "electric_price";
                break;
        }
        $map = array(
            'usernum'=>$usernum,
            'create_date'=>date("Y-m")
        );

        $re = M('house_village_user_paylist')->where($map)->setField($field_name,$val);

        if($re!==false){
            $this->ajaxReturn(array('err'=>0,'msg'=>"成功",'data'=>$_GET));
        }else{
            $this->ajaxReturn(array('err'=>1,'msg'=>"失败",'data'=>mysql_error()));
        }

    }

    /**
     * 前端配置
     * @param $option
     * @param $val
     * @return bool 设置成功 返回 true
     */
    protected function html_option($option,$val){
        static $options = array(
            'table_init_length'=>'15', //默认列表初始长度
            'table_sort'=>'[1,"asc"]' //默认排序
        );

        if( key_exists($option,$options)){
            if($option=="table_sort") $val = json_encode($val);
            $options[$option] = $val;
            $this->assign($options);
            return true;
        }else{
            return false;
        }
    }

    /**
     * 楼层房间处理
     * @time 2017年9月7日16:18:14
     * @author  祝君伟
     */
    public function room_list(){
        $breadcrumb_diy = array(
            array('物业服务','#'),
            array('单元管理','#'),
        );
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $this->html_option('table_init_length',-1);
        $this->html_option('table_sort',array(2,'asc'));
        $village_id =  filter_village(0,2);
        //vd($village_id);exit;
        //判断是否是小区，进行跳转 by zhukeqin
        if(M('house_village')->where('village_id='.$village_id)->find()['village_type']==1){
            header('Location:'.U('room_list_uptown'));
        }

        $model = M('house_village_room');
        if(session('system.account')==SUPER_ADMIN){
            //构建子查询语句

            $childSql = $model->where(array('fid'=>array('eq',0)))->buildSql();

            //主查询

            $newArray = $model
                ->table($childSql.' r1')
                ->field(array(
                    'r1.*',
                    'GROUP_CONCAT(r2.room_name ORDER BY r2.id) as room_number',
                    'v.village_name'
                ))
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ r2 ON r1.id=r2.fid')
                ->join('LEFT JOIN __HOUSE_VILLAGE__ v ON r1.village_id=v.village_id')
                ->where(array('r2.status'=>array('eq',0),'r1.village_id'=>array('eq',session('system.village_id'))))
                ->group('r1.id')
                ->select();


        }else{

            //构建子查询语句

            $childSql = $model->where(array('fid'=>array('eq',0)))->buildSql();

            //主查询

            $newArray = $model
                ->table($childSql.' r1')
                ->field(array(
                    'r1.*',
                    'GROUP_CONCAT(r2.room_name ORDER BY r2.id) as room_number',
                    'v.village_name'
                ))
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ r2 ON r1.id=r2.fid')
                ->join('LEFT JOIN __HOUSE_VILLAGE__ v ON r1.village_id=v.village_id')
                ->where(array('r1.status'=>array('eq',0),'r1.village_id'=>array('eq',session('system.village_id'))))
                ->group('r1.id')
                ->select();



        }
        //vd($newArray);exit;
        $this->assign('roomsArray',$newArray);
        $this->display('room_list');
    }
    /**
     * 楼层房间处理 小区
     * @author  zhukeqin
     *
     */
    public function room_list_uptown(){
        $breadcrumb_diy = array(
            array('物业服务','#'),
            array('单元管理','#'),
        );
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $this->html_option('table_init_length',20);
        $this->html_option('table_sort',array(1,'asc'));

        $village_id =  filter_village(0,2);
        //判断是否是小区，进行跳转 by zhukeqin
        if(M('house_village')->where('village_id='.$village_id)->find()['village_type']!=1){
            header('Location:'.U('room_list'));
        }
        /*$project_list=M('house_village_project')->where('village_id='.$village_id)->select();
        foreach ($project_list as $key=>$value){
            $sum['list'][$value['pigcms_id']]['desc']=$value['desc'];
            $sum['list'][$value['pigcms_id']]['sum']=0;
            $sum['list'][$value['pigcms_id']]['over']=0;
            $sum['list'][$value['pigcms_id']]['now']=0;
            $sum['list'][$value['pigcms_id']]['empty']=0;
        }
        $sum['sum']=$sum['over']=$sum['now']=$sum['empty']=0;*/
        $model = M('house_village_room');
        $where=array('r1.status'=>array('eq',0),'r1.village_id'=>array('eq',session('system.village_id')),'r1.fid'=>array('neq','0'));//,'r1.roomsize'=>array('neq',0)
        //主查询
        if(!empty($_SESSION['project_id'])){
            $where['r1.project_id']=$_SESSION['project_id'];
        }
        /*$newArray = $model
            ->alias('r1')
            ->field(array(
                'r1.*',
                'up.*',
                'uc.carspace_number',
                'uc.carspace_defaulttime',
                'uc.carspace_endtime'
            ))
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM_UPTOWN__ up ON up.rid=r1.id')
            ->join('LEFT JOIN __HOUSE_VILLAGE_USER_CAR__ uc ON uc.rid=r1.id')
            ->where($where)
            ->select();*/
        //dump(M()->_sql());exit;

        if(empty($this->project_id)){
            $this->project_id=$_SESSION['project_id'];
        }else{
            $_SESSION['project_id']=$this->project_id;
        }
        $sum=D('Property')->get_info_sum($this->village_id,$this->project_id);
//        dump($sum);die;
        //$project_list=M('house_village_project')->where(array('village_id'=>$this->village_id))->select();
        /*if(empty($this->project_id)){
            $this->project_id=$_SESSION['project_id']=$project_list['0']['pigcms_id'];
        }*/
        //vd($newArray);exit;
        //起止码是否可见
        $is_code=0;
        if(in_array($village_id,array(7,8,9))) $is_code=1;
        //$is_code = 1;
        //dump($this->village_id);die;
        $type_list_all=M('house_village_otherfee_type')->where(array('status'=>1,'village_id'=>$this->village_id))->select();
        //dump($type_list_all);die;
        $project_info=M('house_village_project')->where(array('pigcms_id'=>$this->project_id))->find();
        $fee_type_list=D('House_village_fee_type')->get_type_list();
        $this->assign('fee_type_list',$fee_type_list);
        $this->assign('type_list',$type_list_all);
        /*$this->assign('project_list',$project_list);*/
        $this->assign('roomsArray',$newArray);
        $this->assign('sum',$sum);
        $this->assign('project_info',$project_info);
        $this->assign('is_code',$is_code);
        $this->display('room_list_uptown');
    }
    public function room_list_uptown_demo(){
        $breadcrumb_diy = array(
            array('物业服务','#'),
            array('单元管理','#'),
        );
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $this->html_option('table_init_length',20);
        $this->html_option('table_sort',array(1,'asc'));

        $village_id =  filter_village(0,2);
        //判断是否是小区，进行跳转 by zhukeqin
        if(M('house_village')->where('village_id='.$village_id)->find()['village_type']!=1){
            header('Location:'.U('room_list'));
        }
        /*$project_list=M('house_village_project')->where('village_id='.$village_id)->select();
        foreach ($project_list as $key=>$value){
            $sum['list'][$value['pigcms_id']]['desc']=$value['desc'];
            $sum['list'][$value['pigcms_id']]['sum']=0;
            $sum['list'][$value['pigcms_id']]['over']=0;
            $sum['list'][$value['pigcms_id']]['now']=0;
            $sum['list'][$value['pigcms_id']]['empty']=0;
        }
        $sum['sum']=$sum['over']=$sum['now']=$sum['empty']=0;*/
        $model = M('house_village_room');
        $where=array('r1.status'=>array('eq',0),'r1.village_id'=>array('eq',session('system.village_id')),'r1.fid'=>array('neq','0'));//,'r1.roomsize'=>array('neq',0)
        //主查询
        if(!empty($_SESSION['project_id'])){
            $where['r1.project_id']=$_SESSION['project_id'];
        }
        /*$newArray = $model
            ->alias('r1')
            ->field(array(
                'r1.*',
                'up.*',
                'uc.carspace_number',
                'uc.carspace_defaulttime',
                'uc.carspace_endtime'
            ))
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM_UPTOWN__ up ON up.rid=r1.id')
            ->join('LEFT JOIN __HOUSE_VILLAGE_USER_CAR__ uc ON uc.rid=r1.id')
            ->where($where)
            ->select();*/
        //dump(M()->_sql());exit;

        if(empty($this->project_id)){
            $this->project_id=$_SESSION['project_id'];
        }else{
            $_SESSION['project_id']=$this->project_id;
        }
        $sum=D('Property')->get_info_sum($this->village_id,$this->project_id);
        //$project_list=M('house_village_project')->where(array('village_id'=>$this->village_id))->select();
        /*if(empty($this->project_id)){
            $this->project_id=$_SESSION['project_id']=$project_list['0']['pigcms_id'];
        }*/
        //vd($newArray);exit;
        //起止码是否可见
        $is_code=0;
        if(in_array($village_id,array(7,8,9))) $is_code=1;

        $type_list_all=M('house_village_otherfee_type')->where(array('status'=>1,'village_id'=>$this->village_id,))->select();
        $project_info=M('house_village_project')->where(array('pigcms_id'=>$this->project_id))->find();
        $fee_type_list=D('House_village_fee_type')->get_type_list();
        $this->assign('fee_type_list',$fee_type_list);
        $this->assign('type_list',$type_list_all);
        /*$this->assign('project_list',$project_list);*/
        $this->assign('roomsArray',$newArray);
        $this->assign('sum',$sum);
        $this->assign('project_info',$project_info);
        $this->assign('is_code',$is_code);
        $this->display('room_list_uptown_demo');
    }
    /**
     * 楼层房间 小区 ajax
     * @author  zhukeqin
     *
     */
    public function ajax_room_list_uptown(){
        $village_id =  filter_village(0,2);
        $project_id=$_SESSION['project_id'];
        //判断是否是小区，进行跳转 by zhukeqin
        $start=I('post.start');
        $length=I('post.length');
        //dump($length);die;
        //datatable适配  -1则代表显示全部信息
        if($length==-1){
            unset($length);
        }
        /*$user_list=D('house_village_user_bind')->get_user_bind_search($search_value,$search_value,'',session('system.village_id'));*/
        $model = M('house_village_room');
        $now=time();
        $where_all=$where=array('r1.status'=>array('eq',0),'r1.village_id'=>array('eq',$village_id),'r1.fid'=>array('neq','0'),'r1.project_id'=>$project_id);
        if(!empty($_POST['search']['value'])){
            switch ($_POST['search']['value']){
                case '已欠费':$where['_string']=' unix_timestamp(up.property_endtime)< '.$now;break;
                case '空置中':$where['up.house_type']=0;break;
                default:$search_value='%'.$_POST['search']['value'].'%';
                    $where['r1.room_name|ub.phone|ub.name']=array('like',$search_value);break;
            }
        }
        if(I('get.room_over_endtime')==1&&I('get.room_over_endtime')!='null')
            $where['_string']=' unix_timestamp(up.property_endtime)< '.$now;//是否物业费过期
        if(I('get.room_house_type')!=4&&!is_null(I('get.room_house_type'))&&strlen(I('get.room_house_type'))&&I('get.room_house_type')!='null')
            $where['up.house_type']=I('get.room_house_type');//房屋状态
        if(I('get.room_type')&&I('get.room_type')!='null'&&I('get.room_type')!='other')
            $where['r1.room_type']=I('get.room_type');//房屋类型
        //其它业主信息
        if(I('get.room_type')=='other'){
            $where['r1.tung_unit']= array('exp',' is NULL');
        }
        //dump($where);die;
        //主查询
        if(!empty($length)){
            $list = $model
                ->alias('r1')
                ->field(array(
                    'r1.*',
                    'up.*',
                    'ub.phone',
                    'ub.name'
                ))
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM_UPTOWN__ up ON up.rid=r1.id')
                ->join('LEFT JOIN __HOUSE_VILLAGE_USER_BIND__ ub ON ub.pigcms_id=r1.owner_id')
                ->where($where)
                ->limit($start,$length)
                ->select();
        }else{
            $list = $model
                ->alias('r1')
                ->field(array(
                    'r1.*',
                    'up.*'
                ))
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM_UPTOWN__ up ON up.rid=r1.id')
                ->join('LEFT JOIN __HOUSE_VILLAGE_USER_BIND__ ub ON ub.pigcms_id=r1.owner_id')
                ->where($where)
                ->select();
        }
//        dump($list);die;
        $list_dimcount=$model
            ->alias('r1')
            ->field(array(
                'r1.*',
                'up.*',
                'ub.phone',
                'ub.name'
            ))
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM_UPTOWN__ up ON up.rid=r1.id')
            ->join('LEFT JOIN __HOUSE_VILLAGE_USER_BIND__ ub ON ub.pigcms_id=r1.owner_id')
            ->where($where)
            ->count();
        $list_count= $model
            ->alias('r1')
            ->field(array(
                'r1.*',
                'up.*'
            ))
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM_UPTOWN__ up ON up.rid=r1.id')
            ->where($where_all)
            ->count();
        //dump($list);die;
        //dump(M()->_sql());exit;
        foreach ($list as $value){
            $array=array(
                'check_id'=>'<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input type="checkbox" class="checkboxes" value="'.$value['id'].'"><span></span></label>',
                'desc'=>$value['desc'],
                'tung_build'=>$value['tung_build'].'栋',
                'tung_unit'=>$value['tung_unit'].'单元',
                'tung_floor'=>$value['tung_floor'].'层',
                'room_name'=>$value['room_name'],
                'roomsize'=>$value['roomsize'],
                'action'=>'<div class="btn-group">
                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-left" role="menu" style="position:relative;">

                        <li>
                            <a href="'.U('room_update_uptown',array('id'=>$value['id'])).'" target="_blank">
                                <i class="icon-tag"></i> 编辑 </a>
                        </li>
                        <li>
                            <a href="'.U('Otherfee/add_otherfee',array('rid'=>$value['id'])).'" target="_blank">
                                <i class="icon-tag"></i> 添加新的缴费 </a>
                        </li>
                        <li>
                            <a href="'.U('Otherfee/otherfee_list',array('rid'=>$value['id'])).'" target="_blank">
                                <i class="icon-tag"></i> 查看全部缴费 </a>
                        </li>
                    </ul>
                </div>'
            );
            $property='<a href="'.U('room_property_uptown',array('id'=>$value['id'])).'" target="_blank">';
            if(!empty($value['property_endtime']) && strtotime($value['property_endtime'])>time()){
                $property .=$value['property_endtime'];
            }elseif(!empty($value['property_endtime'])){
                $property .='<span class="text-danger">'.$value['property_endtime'].'&nbsp;&nbsp;(已欠费)</span>';
            }
            if(empty($value['property_endtime'])){
                $property .=' <span class="text-danger">尚未设置初始时间</span>';
            }
            $property .='</a>';
            $array['property']=$property;

            $carspace='<a href="'.U('room_carspace_uptown',array('id'=>$value['id'])).'" target="_blank">';
            $carspace_list=M('house_village_user_car')->where(array('rid'=>$value['id'],'status'=>1))->select();
            if(empty($carspace_list)){
                $carspace .='<span class="text-danger">尚未绑定车位</span>';
            }else{
                foreach ($carspace_list as $key1=>$value1){
                    $carspace .=$value1['carspace_number'].'<br/>';
                }
            }
            $carspace .='</a>';

            $array['carspace']=$carspace;

            if(!empty($value['oid'])){
                $owner_list=M('house_village_user_bind')->where(array('pigcms_id'=>array('IN',explode(',',$value['oid']))))->select();
                $owner_name='';
                $owner_phone='';
                foreach ($owner_list as $key1=>$value1){
                    $owner_name .=$value1['name'].'<br/>';
                    $owner_phone .=$value1['phone'].'<br/>';
                }
            }else{
                $owner_name='<span class="text-danger">尚未绑定业主</span>';
                $owner_phone='<span class="text-danger">尚未绑定业主</span>';
            }
            $array['owner_name']=$owner_name;
            $array['owner_phone']=$owner_phone;

            switch ($value['house_type']){
                case 0:$house_type='<span class="text-danger">空置</span>';break;
                case 1:$house_type='<span class="text-primary">出租</span>';break;
                case 2:$house_type='<span class="text-success">自住</span>';break;
            }
            if($value['house_type'] != '空置' && $value['property_emptytime']&& $value['property_emptytime']!=1) $house_type .=date('Y-m-d',$value['property_emptytime']);
            $array['house_type']=$house_type;
            $list_reload[]=$array;

        }
//        dump($list_reload);die;
        if(empty($list_reload)){
            $list_reload=array();
        }
        $result_array=array(
            'draw'=>intval(I('post.draw')),
            'recordsTotal'=>$list_count,
            'recordsFiltered'=>$list_dimcount,
            'data'=>$list_reload
        );
//        dump($result_array);die;
        echo json_encode($result_array);
    }
    /**
     * 房间添加
     * @time 2017年9月7日17:06:09
     * @author 祝君伟
     */
    public function room_add(){
        if(IS_POST){
            $model = M('house_village_room');
            $data = $_POST;
            if($data['room_state'] == 0){
                //全层的添加数组
                $roomArray = array(
                    'room_name'=>$data['room_name'],
                    'fid'=>0,
                    'desc'=>$data['desc'],
                    'village_id'=>$data['village_id']
                );
                $res = $model->data($roomArray)->add();
                if($res){
                    $this->success('添加成功',U('room_add'));
                }else{
                    $this->error('添加失败',U('room_add'));
                }
            }else{
                //对于非全层的单间添加
                //先查询对应的楼层的信息，如果没有将自动新建
                //$is_floor = $model->getByRoom_name($data['room_name'].'F');
                $is_floor = $model->where(array('room_name'=>$data['room_name'].'F','village_id'=>$data['village_id']))->find();
                if($is_floor){
                    //有当前楼层
                    $fid = $is_floor['id'];
                }else{
                    $floorArray = array(
                        'room_name'=>$data['room_name'],
                        'fid'=>0,
                        'desc'=>'',
                        'village_id'=>$data['village_id']
                    );
                    $fid = $model->data($floorArray)->add();
                }
                foreach ($data['room_number'] as $value){
                    //判断是否已经在表中
                    $roomRes = $model->where(array('fid'=>$fid,'room_name'=>$value,'village_id'=>$data['village_id']))->find();
                    if($roomRes){
                        continue;
                    }else{
                        $roomArray =array(
                            'room_name'=>$value,
                            'fid'=>$fid,
                            'desc'=>$data['desc'],
                            'village_id'=>$data['village_id']
                        );
                        $res = $model->data($roomArray)->add();
                        if($res){
                            continue;
                        }else{
                            $this->error($value.'房间添加失败',U('room_add'));
                        }
                    }
                }
                $this->success('添加成功',U('room_add'));
            }
        }else{

            $villageArray = M('house_village')->where(array('status'=>array('eq',1)))->select();
            $maximum_room_number = M('house_village')
                ->where('village_id=%d',session('system.village_id'))
                ->getField('maximum_room_number');
            $this->assign('villageArray',$villageArray);
            $this->assign('maximum_room_number',$maximum_room_number);
            $this->display();
        }
    }


    /**
     * 房间更新
     */
    public function room_update(){
        if(IS_POST){
            $id = I('post.id');
            $roomArray = I('post.room_number');
            $allowRoomNumber = array('01','02','03','04','05','06','07','08','09');
            $roomOb = D('Room');
            $res = $roomOb->update_room($allowRoomNumber,$id,$roomArray);
            if($res){
                $this->success('更新完成',U('room_list'));
            }else{
                $this->error('更新失败',U('room_list'));
            }
        }else{
            $id = I('get.id');
            $thisRoomInfo = M('house_village_room')->find($id);
            $thisRoomArray = M('house_village_room')->where(array('fid'=>$thisRoomInfo['id'],'status'=>0))->select();
            $thisRoomInfo['village_name'] = M('house_village')->getFieldByVillage_id($thisRoomInfo['village_id'],'village_name');
            $roomNumber = array();
            foreach ($thisRoomArray as $value){
                $roomNumber[]=$value['room_name'];

            }
            //vd($roomNumber);exit;
            $this->assign('thisRoomInfo',$thisRoomInfo);
            $this->assign('roomNumber',$roomNumber);
            $this->display();
        }


    }
    /**
     * 房间更新 小区
     * @author zhukeqin
     */
    public function room_update_uptown(){
        if(IS_POST){
            $id = I('post.id');
            $roomArray=$_POST['roominfo'];
            $roomOb = D('Room');
            $res = $roomOb->update_room_uptown($id,$roomArray);
            if($res){
                $this->success('更新完成',U('room_list_uptown',array('id'=>$id)));
            }else{
                $this->error('更新失败',U('room_list_uptown',array('id'=>$id)));
            }
        }else{
            $id = I('get.id');
            $thisRoomArray = M('house_village_room')
                ->alias('r1')
                ->field(array(
                    'r1.*',
                    'up.*'
                ))
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM_UPTOWN__ up ON up.rid=r1.id')
                ->where(array('id'=>$id,'status'=>0))->find();
            /*if(empty($thisRoomArray['addtime']))$thisRoomArray['addtime']=time();
            if(empty($thisRoomArray['checktime']))$thisRoomArray['checktime']=time();
            if(empty($thisRoomArray['fixhouse_start']))$thisRoomArray['fixhouse_start']=time();
            if(empty($thisRoomArray['fixhouse_end']))$thisRoomArray['fixhouse_end']=time();*/
            $thisRoomInfo=M('house_village_room')->where('id='.$thisRoomArray['fid'])->find();
            $thisRoomInfo['village_name'] = M('house_village')->getFieldByVillage_id($this->village_id,'village_name');
            //vd($roomNumber);exit;
            $this->assign('thisRoomInfo',$thisRoomInfo);
            $this->assign('thisRoomArray',$thisRoomArray);
            $this->display();
        }


    }
    /**
     * 物业缴费记录列表
     * @author zhukeqin
     */
    public function room_property_uptown(){
        $id = I('get.id');
        if ($_GET['default_village_id']) {
            $village_id = $_GET['default_village_id'];
        } else {
            $village_id = $_SESSION['system']['village_id'];
        }
        //dump($_SESSION);
        $thisRoom=M('house_village_room')->where('id='.$id)->find();
        if(empty($thisRoom)){
            $this->error('所选房间不存在！');
        }
        $property_list = M('house_village_room_propertylist')->where(array('rid'=>$id,'fee_type'=>'0'))->order('pigcms_id desc')->select();
        foreach ($property_list as &$value){
            if(empty($value['admin_id'])){
                $value['type_str']='<span style="color: green;">线上支付</span>';
                $user_info=M('house_village_user_bind')->where('uid='.$value['uid'])->find();
                $value['user_name']=$user_info['name'];
                $value['user_phone']=$user_info['phone'];
            }else{
                switch ($value['type']){
                    case 1:$value['type_str']='<span style="color: red;">线上支付</span>';break;
                    case 2:$value['type_str']='<span style="color: red;">现金</span>';break;
                    case 3:$value['type_str']='<span style="color: red;">转账</span>';break;
                    case 4:$value['type_str']='<span style="color: red;">POS单</span>';break;
                    case 5:$value['type_str']='<span style="color: red;">现金缴款单</span>';break;
                }
                $admin_info=M('admin')->where('id='.$value['admin_id'])->find();
                $value['admin_name']=$admin_info['realname'];
                $value['admin_phone']=$admin_info['phone'];
            }
            switch ($value['status']){
                case 0:$value['status_str']='<span style="color: red;">未支付</span>';break;
                case 1:$value['status_str']='<span style="color: green;">已支付</span>';break;
            }
            $value['last_endtime_str']=date('Y年n月j日',strtotime($value['last_endtime']));
            $value['new_endtime_str']=date('Y年n月j日',strtotime($value['new_endtime']));
            $value['pay_time_str']=date('Y-m-d H:i:s',$value['pay_time']);
        }
        $this->assign('property_list',$property_list);
        $this->assign('thisRoom',$thisRoom);
        $this->display();


    }
    /**
     * 线下物业缴费更新 小区
     * @author zhukeqin
     */
    public function room_property_uptown_updata(){
        $id = I('get.id');
        if ($_GET['default_village_id']) {
            $village_id = $_GET['default_village_id'];
        } else {
            $village_id = $_SESSION['system']['village_id'];
        }
        //dump($_SESSION);
        $thisRoomArray = M('house_village_room')
            ->alias('r1')
            ->field(array(
                'r1.*',
                'up.*',
                'rt.property_unit'
            ))
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM_UPTOWN__ up ON up.rid=r1.id')
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM_TYPE__ rt ON rt.pigcms_id=r1.room_type')
            ->where(array('r1.id'=>$id,'r1.status'=>0,'r1.village_id'=>$village_id))->find();
        if(empty($thisRoomArray)){
            $this->error('所选房间不存在！');
        }
        if(IS_POST){
            $mouth=$_POST['property_mouth'];
            $property_true=$_POST['property_true'];
            $remark=$_POST['remark'];
            $type=$_POST['type'];
            if(empty($thisRoomArray['property_endtime'])){
                $property_endtime=$_POST['property_endtime'];
                if(empty($property_endtime)){
                    $this->error('该房间没有设置到期时间，请先设置到期时间！');
                }
                $property_endtime=date('Y-n-j',strtotime($property_endtime));
                M('house_village_room_uptown')->data(array('property_endtime'=>$property_endtime,'property_defaulttime'=>$property_endtime))->where('rid='.$id)->save();

            }
            if(empty($thisRoomArray['property_defaulttime'])&&empty($thisRoomArray['property_endtime'])){
                $time=date('Y-n-j',time());
                M('house_village_room_uptown')->where('rid='.$id)->data(array('property_defaulttime'=>$time,'property_endtime'=>$time))->save();
            }
            $model=new RoomModel();
            $res=$model->add_propertylist($id,$type,$mouth,$property_true,$_SESSION['admin_id'],'1',$remark);
            if($res){
                $this->success('更新完成',U('room_property_uptown',array('id'=>$id)));
            }else{
                $this->error('更新失败',U('room_property_uptown',array('id'=>$id)));
            }
        }else{

            $thisRoomInfo=M('house_village_room')->where('id='.$thisRoomArray['fid'])->find();
            $thisRoomInfo['village_name'] = M('house_village')->getFieldByVillage_id($this->village_id,'village_name');
            $property_list=M('house_village_room_propertylist')->where('rid='.$id)->select();
            $this->assign('property_list',$property_list);
            $this->assign('thisRoomInfo',$thisRoomInfo);
            $this->assign('thisRoomArray',$thisRoomArray);
            $this->display();
        }
    }

    /**
     * @author zhukeqin
     * 变更小区业主的物业费时间
     */
    public function room_property_uptown_endtime_updata(){
        $id = I('get.id');
        if ($_GET['default_village_id']) {
            $village_id = $_GET['default_village_id'];
        } else {
            $village_id = $_SESSION['system']['village_id'];
        }
        //dump($_SESSION);
        $thisRoomArray = M('house_village_room')
            ->alias('r1')
            ->field(array(
                'r1.*',
                'up.*',
                'rt.property_unit'
            ))
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM_UPTOWN__ up ON up.rid=r1.id')
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM_TYPE__ rt ON rt.pigcms_id=r1.room_type')
            ->where(array('r1.id'=>$id,'r1.status'=>0,'r1.village_id'=>$village_id))->find();
        if(empty($thisRoomArray)){
            $this->error('所选房间不存在！');
        }
        if(IS_POST){
            $property_defaulttime=date('Y-n-j',strtotime($_POST['property_defaulttime']));
            $property_endtime=date('Y-n-j',strtotime($_POST['property_endtime']));
            $res=M('house_village_room_uptown')->where('rid='.$id)->data(array('property_defaulttime'=>$property_defaulttime,'property_endtime'=>$property_endtime))->save();
            if($res){
                $this->success('更新完成',U('room_property_uptown',array('id'=>$id)));
            }else{
                $this->error('更新失败',U('room_property_uptown',array('id'=>$id)));
            }
        }else{

            $thisRoomInfo=M('house_village_room')->where('id='.$thisRoomArray['fid'])->find();
            $thisRoomInfo['village_name'] = M('house_village')->getFieldByVillage_id($this->village_id,'village_name');
            $property_list=M('house_village_room_propertylist')->where('rid='.$id)->select();
            $this->assign('property_list',$property_list);
            $this->assign('thisRoomInfo',$thisRoomInfo);
            $this->assign('thisRoomArray',$thisRoomArray);
            $this->display();
        }
    }
    /**
     * 泊位费缴费记录列表
     * @author zhukeqin
     */
    public function room_carspace_uptown(){
        $id = I('get.id');
        if ($_GET['default_village_id']) {
            $village_id = $_GET['default_village_id'];
        } else {
            $village_id = $_SESSION['system']['village_id'];
        }
        //dump($_SESSION);
        $thisRoom=M('house_village_room')->where('id='.$id)->find();
        if(empty($thisRoom)){
            $this->error('所选房间不存在！');
        }
        $carspace_list=M('house_village_user_car')->where(array('rid'=>$id,'status'=>1))->select();
        $property_list = M('house_village_room_carspacelist')
            ->alias('rc')
            ->join('left join __HOUSE_VILLAGE_USER_CAR__ uc on uc.pigcms_id=rc.carspace_id')
            ->where(array('rc.rid'=>$id))
            ->field(array('rc.*','uc.carspace_number'))
            ->order('pigcms_id desc')
            ->select();
        foreach ($property_list as &$value){
            if(empty($value['admin_id'])){
                $value['type_str']='<span style="color: green;">线上支付</span>';
                $user_info=M('house_village_user_bind')->where('uid='.$value['uid'])->find();
                $value['user_name']=$user_info['name'];
                $value['user_phone']=$user_info['phone'];
            }else{
                switch ($value['type']){
                    case 1:$value['type_str']='<span style="color: red;">线上支付</span>';break;
                    case 2:$value['type_str']='<span style="color: red;">现金</span>';break;
                    case 3:$value['type_str']='<span style="color: red;">转账</span>';break;
                    case 4:$value['type_str']='<span style="color: red;">POS单</span>';break;
                    case 5:$value['type_str']='<span style="color: red;">现金缴款单</span>';break;
                }
                $admin_info=M('admin')->where('id='.$value['admin_id'])->find();
                $value['admin_name']=$admin_info['realname'];
                $value['admin_phone']=$admin_info['phone'];
            }
            switch ($value['status']){
                case 0:$value['status_str']='<span style="color: red;">未支付</span>';break;
                case 1:$value['status_str']='<span style="color: green;">已支付</span>';break;
            }
            $value['last_endtime_str']=date('Y年n月j日',strtotime($value['last_endtime']));
            $value['new_endtime_str']=date('Y年n月j日',strtotime($value['new_endtime']));
            $value['pay_time_str']=date('Y-m-d H:i:s',$value['pay_time']);
        }
        $this->assign('carspace_list',$carspace_list);
        $this->assign('property_list',$property_list);
        $this->assign('thisRoom',$thisRoom);
        $this->display();


    }
    /**
     * 线下泊位费缴费更新 小区
     * @author zhukeqin
     */
    public function room_carspace_uptown_updata(){
        $id = I('get.id');
        if ($_GET['default_village_id']) {
            $village_id = $_GET['default_village_id'];
        } else {
            $village_id = $_SESSION['system']['village_id'];
        }
        //dump($_SESSION);
        $thisRoomArray = M('house_village_room')
            ->alias('r1')
            ->field(array(
                'r1.*',
                'vp.carspace_price',
            ))
            ->join('LEFT JOIN __HOUSE_VILLAGE_PROJECT__ vp ON vp.pigcms_id=r1.project_id')
            ->where(array('r1.id'=>$id,'r1.status'=>0,'r1.village_id'=>$village_id))->find();
        if(empty($thisRoomArray)){
            $this->error('所选房间不存在！');
        }
        $carspace_id=$_GET['carspace_id'];
        if(!empty($carspace_id)){
            $carspace_info=M('house_village_user_car')->where('pigcms_id='.$carspace_id)->find();
            if(empty($carspace_info)){
                $this->error('所选车位不存在');
            }
            $this->assign('carspace_info',$carspace_info);
        }
        if(IS_POST){
            $mouth=$_POST['carspace_mouth'];
            $carspace_true=$_POST['carspace_true'];
            $remark=$_POST['remark'];
            $carinfo=$_POST['carinfo'];
            $type=$_POST['type'];
            if(empty($carspace_info)||$_GET['edit']==1){
                if(empty($carinfo['carspace_end'])){
                    $this->error('该车位没有设置到期时间，请先设置到期时间！');
                }
                $car_info['carspace_endtime']=$car_info['carspace_defaulttime']=$carinfo['carspace_end'];
                $car_info['carspace_start']=$carinfo['carspace_start'];
                $car_info['carspace_end']=$carinfo['carspace_end'];
                $car_info['village_id']=$thisRoomArray['village_id'];
                $car_info['project_id']=$thisRoomArray['project_id'];
                $car_info['carspace_number']=$carinfo['carspace_number'];
                $car_info['car_number']=$carinfo['car_number'];
                $car_info['rid']=$id;
                $car_info['carspace_price']=$carinfo['carspace_price'];
                if($_GET['edit']==1){
                    M('house_village_user_car')->where('pigcms_id='.$carspace_id)->data($car_info)->save();
                }else{
                    $carspace_id=M('house_village_user_car')->data($car_info)->add();
                }
            }elseif(empty($carspace_info['carspace_end'])){
                if(empty($carinfo['carspace_end'])){
                    $this->error('该车位没有设置到期时间，请先设置到期时间！');
                }
                $carspace_endtime=$carinfo['carspace_end'];
                $car_info=array(
                    'carspace_end'=>$carspace_endtime,
                    'carspace_endtime'=>$carspace_endtime,
                    'carspace_defaulttime'=>$carspace_endtime
                );
                M('house_village_user_car')->where('pigcms_id='.$carspace_id)->data($car_info)->save();
            }
            if(empty($mouth)){
                $res=true;
            }else{
                $model=new RoomModel();
                $res=$model->add_carspacelist($id,$carspace_id,$type,$mouth,$carspace_true,$_SESSION['admin_id'],'1',$remark);
            }
            if($res){
                $this->success('更新完成',U('room_carspace_uptown',array('id'=>$id)));
            }else{
                $this->error('更新失败',U('room_carspace_uptown',array('id'=>$id)));
            }
        }else{

            $thisRoomInfo=M('house_village_room')->where('id='.$thisRoomArray['fid'])->find();
            $thisRoomInfo['village_name'] = M('house_village')->getFieldByVillage_id($this->village_id,'village_name');
            $this->assign('thisRoomInfo',$thisRoomInfo);
            $this->assign('thisRoomArray',$thisRoomArray);
            $this->display();
        }


    }
    /**
     * @author zhukeqin
     * ajax删除（隐藏）车位
     */
    public function ajax_delete_carspace(){
        $carsapce_id=I('post.carspace_id');
        $return=M('house_village_user_car')->where(array('pigcms_id'=>$carsapce_id))->data(array('status'=>2))->save();
        if($return){
            $this->success('删除成功','','true');
        }else{
            $this->error('删除失败','','true');
        }

    }
    /**
     * 巡更点列表
     * @author 祝君伟
     * @time 2017年9月8日14:14:47
     *
     */
    public function point_list(){
        $is_del = $_GET['is_del'];
        // var_dump($is_del);exit();
        if ($_GET['default_village_id']) {
            $village_id = $_GET['default_village_id'];
        } else {
            $village_id = $_SESSION['system']['village_id'];
        }
        $model = M('house_village_point');
        $field = array(
            'p.*',
            'v.village_name',
            'r.room_name',
        );
        $map['v.village_id'] = array('eq',$village_id);
        if(session('system.account')==SUPER_ADMIN){
            $pointArray = $model
                ->alias('p')
                ->field($field)
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ r ON p.rid=r.id')
                ->join('LEFT JOIN __HOUSE_VILLAGE__ v ON r.village_id=v.village_id')
                ->where(array('p.type'=>0))
                ->where($map)
                ->where(array('p.status'=>array('eq',0),'is_del'=>$is_del))
                ->select();
        }else{

            $pointArray = $model
                ->alias('p')
                ->field($field)
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ r ON p.rid=r.id')
                ->join('LEFT JOIN __HOUSE_VILLAGE__ v ON r.village_id=v.village_id')
                ->where(array('p.type'=>0))
                ->where($map)
                ->where(array('p.status'=>array('eq',0),'is_del'=>$is_del,'r.village_id'=>array('eq',session('system.village_id'))))
                ->select();
            /*->group('rid')'r.fid'=>array('eq',0),*/

        }
        // var_dump($pointArray);exit;
        $this->assign('pointArray',$pointArray);
        $this->display('point_list');

    }

    /*
     *点位的状态，启用与关闭
     */
    public function point_type(){
        $id = I('post.point_id');
        $is_del = I('post.is_del');
        if ($is_del == 0) {//点位的停用
            $data=array('is_del'=>1);
            $re=M('house_village_point')->where(array('id'=>$id))->data($data)->save();
            echo $re;
        } else {//点位的启用
            $data=array('is_del'=>0);
            $re=M('house_village_point')->where(array('id'=>$id))->data($data)->save();
            echo $re;
        }
    }


    /**
     * 巡更添加
     * @author 祝君伟
     * @time 2017年9月8日17:47:05
     */
    public function point_add(){
        if(IS_POST){
            $model = M('house_village_point');
            $data =$_POST;
            //判断该点位有没添加，添加过则跳过
            $is_point = $model->where(array('rid'=>$data['rid'],'orientation'=>$data['pointname']))->find();
            if($is_point){
                $this->error($data['pointname'].'已存在，点位添加失败');
            }else{
                $pointArray = array(
                    'rid'=>$data['rid'],
                    'name'=>$data['pointname'],
                    'desc'=>$data['desc'],
                    'orientation'=>$data['pointname'],
                    'type' => 0,
                );
                $res = $model->data($pointArray)->add();
                if($res){

                }else{
                    $this->error($data['pointname'].'点位添加失败');
                }
            }

            $this->success('点位添加成功');

        }else{
            if(session('system.account')==SUPER_ADMIN){
                //超级权限
                $villageArray = M('house_village')->where(array('status'=>array('eq',1)))->select();
                $roomArray = M('house_village_room')->where(array('status'=>0,'fid'=>0,'village_id'=>array('eq',4)))->select();
                $this->assign('villageArray',$villageArray);
            }else{
                $roomArray = M('house_village_room')->where(array('status'=>0,'fid'=>0,'village_id'=>array('eq',session('system.village_id'))))->select();
            }

            $this->assign('roomArray',$roomArray);
            $this->display();
        }
    }

    /**
     * 巡更点变更
     */
    public function point_update(){
        if(IS_POST){
            $id =  I('post.id');
            $rid=I('post.rid');
            $pointname=I('post.pointname');
            $data=array('name'=>$pointname,'orientation'=>$pointname,'rid'=>$rid);
            //设立标志位
            $_flag = false;
            $_flag=M('house_village_point')->where('id='.$id)->data($data)->save();
            if($_flag){
                $this->success('修改成功',U('point_list'));
            }else{
                $this->error('修改失败',U('point_list'));
            }

        }else{
            //更新该楼层下的所有巡更点
            $id = I('get.id');
            $pointArray = M('house_village_point')
                ->alias('p')
                ->field(array('p.*,r.id as rid ,r.village_id'))
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ r on r.id=p.rid')
                ->where(array('p.type'=>0))
                ->where(array('p.id'=>$id,'p.status'=>0,'p.is_del'=>0))
                ->find();
            //vd($pointArray);exit;
            //当前楼层的信息
            $roomArray = M('house_village_room')->where(array('status'=>0,'fid'=>0,'village_id'=>array('eq',$pointArray['village_id'])))->select();
            $this->assign('roomArray',$roomArray);
            $this->assign('room_name',$pointArray);
            $this->display();
        }

    }


    /**
     * 巡更点删除
     */
    public function point_delete(){
        $rid = I('get.rid');
        if(!isset($rid)&&empty($rid)) exit();
        $res = M('house_village_room')->where(array('rid'=>$rid))->data(array('is_del'=>1))->save();
        if($res){
            $this->success('成功删除');
        }else{
            $this->error('删除失败');
        }

    }


    /**
     * 根据village_id改变option
     */
    public function change_village(){
        $village_id = I('post.village_id');
        $villageArray = $roomArray = M('house_village_room')->where(array('status'=>0,'fid'=>0,'village_id'=>array('eq',$village_id)))->select();
        $optionStr = '';
        foreach ($villageArray as $value){
            $optionStr .='<option value="'.$value['id'].'">'.$value['room_name'].'</option>';
        }
        echo $optionStr;
    }


    /**
     * 巡检记录
     * @param int $point_status  紧急状态码
     * @author libin
     * @time 2018年8月22日15:14:47
     * @update-time 2018年8月23日11:44:47
     */
    public function point_safety_record($point_status=0){
        // $column = M()->query("select COLUMN_NAME from information_schema.COLUMNS where table_name = 'pigcms_village_point_safety_record'");
        // var_dump($column);exit();

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

        //获取检查时间
        $check_time = I('get.check_time');
        $thisDayStart = strtotime($check_time);
        $thisDayEnd = strtotime(date('Y-m-t',$thisDayStart).'23:59:59');

        $_map['p.type'] = array('eq',1);
        $_map['r.check_time'] = array('between',array($thisDayStart,$thisDayEnd));

        //已经巡检的消防点
        $nowPointCount = M('village_point_safety_record')->alias('r')
            ->field(array("count(DISTINCT pid)"=>'num'))
            ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
            ->where($_map)
            ->where(array('m.village_id'=>session('system.village_id')))
            ->select()[0]['num'];

        //字段
        $field=array(
            'r.*',
            'p.orientation',
            'm.room_name',
            'v.village_name',
            'b.name'
        );
        if(session('system.account')==SUPER_ADMIN){
            //超级管理员

            //构建子查询
            $chlidSql = M('house_village_user_bind')->field(array('uid','`name`','MAX(pigcms_id)'))->group('uid')->buildSql();
            //主查询
            /* $pointRecord = M()
                 ->table($chlidSql.' b')
                 ->field($field)
                 ->join('LEFT JOIN __VILLAGE_POINT_RECORD__ r on b.uid=r.uid')
                 ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
                 ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
                 ->join('LEFT JOIN __HOUSE_VILLAGE__ v on v.village_id=m.village_id')
                 ->where($_map)
                 ->order('r.point_status desc,r.check_time desc')
                 ->limit(500)
                 ->select();*/

            $_map = filter_village($_map,1,'m');

            $pointRecord = M('village_point_safety_record')
                ->alias('r')
                ->field($field)
                ->join('LEFT JOIN '.$chlidSql.' b on b.uid=r.uid')
                ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
                ->join('LEFT JOIN __HOUSE_VILLAGE__ v on v.village_id=m.village_id')
                ->where(array('p.type'=>1))
                ->where($_map)
                ->order('r.point_status desc,r.check_time desc')
                ->limit(500)
                ->select();
        }else{

            $_map['v.village_id'] = array('eq',session('system.village_id'));
            //普通管理员
            //构建子查询
            $chlidSql = M('house_village_user_bind')->field(array('uid','`name`','MAX(pigcms_id)'))->group('uid')->buildSql();
            //主查询
            $pointRecord = M('village_point_safety_record')
                ->alias('r')
                ->field($field)
                ->join('LEFT JOIN '.$chlidSql.' b on b.uid=r.uid')
                ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
                ->join('LEFT JOIN __HOUSE_VILLAGE__ v on v.village_id=m.village_id')
                ->where(array('p.type'=>1))
                ->where($_map)
                ->order('r.point_status desc,r.check_time desc')
                ->limit(500)
                ->select();

        }
        //巡检更改（范围更广）2018/5/19
        foreach ($pointRecord as $k => $v) {
            if (empty($v['name'])) $v['name'] = D('user')->where(array('uid'=>$v['uid']))->getField('truename');
            $pointRecord[$k]['point_status'] = explode(',',$v['point_status']);
        }
        unset($v);
        //处理点位的描述

        //关于消防点的展示
        //一共多少消防点
//        $pointCount = M('house_village_point')->where(array('is_del'=>0))->count()-2;
        $pointCount = M('house_village_point')->alias('p')
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ r ON p.rid=r.id')
            ->where(array('p.type'=>1))
            ->where(array('r.village_id'=>session('system.village_id')))
            ->where(array('p.status'=>array('eq',0),'p.is_del'=>array('eq',0)))
            ->count()?:0;

        //未巡检的点
        $lowPointCount = $pointCount-$nowPointCount;

        if($lowPointCount<=0)$lowPointCount=0;


        //查询近1年的巡检记录
        $year_pointRecord = $this->get_year_point_safety_record();
        $this->assign('year_pointRecord',$year_pointRecord);

        $this->assign('pointRecord',$pointRecord);
        $this->assign('lowPointCount',$lowPointCount);
        $this->assign('pointCount',$pointCount);
        $this->assign('nowPointCount',$nowPointCount);
        $this->display('point_safety_record');
    }

    //获取每一年的检查报告
    public function get_year_point_safety_record() {
        $start_time = strtotime(date('Y-m-01',time()).'00:00:00');  //获取本月第一天时间戳
        $array = array();
        for($i=1;$i<=12;$i++){
            $array[] = date('Y-m-d',$start_time-$i*86400*30); //每隔一个月赋值给数组
        }

        $village_id = session('system.village_id');
        //总巡检点
        $pointNum = M('house_village_point')->alias('p')
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ r ON p.rid=r.id')
            ->where(array('p.type'=>1))
            ->where(array('r.village_id'=>$village_id))
            ->where(array('p.status'=>array('eq',0),'p.is_del'=>array('eq',0)))
            ->count()?:0;

        $newArr = array();
        foreach ($array as $k => $v) {
            $time = strtotime($v);
            $Start_Time = strtotime(date('Y-m-01',$time).'00:00:00');
            $End_Time = strtotime(date('Y-m-t',$time).'23:59:59');
            //已经巡检的巡更点
            $yes_Count = M('village_point_safety_record')->alias('r')
                ->field(array("count(DISTINCT pid)"=>'num'))
                ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
                ->where(array('r.check_time'=>array('between',array($Start_Time,$End_Time))))
                ->where(array('m.village_id'=>$village_id))
                ->select()[0]['num'];

            $no_Count = intval($pointNum-$yes_Count)?intval($pointNum-$yes_Count):0;
            if ($no_Count<0) {
                $no_Count = 0;
            }
            $newArr[$k]['date'] = $v;
            $newArr[$k]['pointNum'] = $pointNum;
            $newArr[$k]['yes_Count'] = $yes_Count;
            $newArr[$k]['no_Count'] = $no_Count;
        }

        return $newArr;
    }

    /**
     * 记录详情
     *
     */
    public function point_safety_detail(){
        $id = I('get.id');
        //条件
        $_map =array('p.is_del'=>0,'r.pigcms_id'=>array('eq',$id));
        //字段
        $field=array(
            'r.*',
            'p.orientation',
            'm.room_name',
            'v.village_name',
            'b.name'
        );

        //查询当前记录的信息
        $pointRecord = M('village_point_safety_record')
            ->alias('r')
            ->field($field)
            ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
            ->join('LEFT JOIN __HOUSE_VILLAGE__ v on v.village_id=m.village_id')
            ->join('LEFT JOIN __HOUSE_VILLAGE_USER_BIND__ b on b.uid=r.uid')
            ->where($_map)
            ->group('uid')
            ->find();

        //对point_status数据进行处理，方便前端进行处理
        $pointRecord['point_status'] = explode(',',$pointRecord['point_status']);

        //对 image 进行判断处理
        $images = explode(',',$pointRecord['image']);
        // var_dump($images);exit();

        if (empty($pointRecord['name'])) $pointRecord['name'] = D('user')->where(array('uid'=>$pointRecord['uid']))->getField('truename');
        //vd(M()->_sql());
        $this->assign('pointRecord',$pointRecord);
        $this->assign('images',$images);
        $this->display();
    }

    //自定义二维码保存
    public function products_create_qrcode(){
        /*$num = I('post.num');
        $type=I('post.type');
        $time = time();
        if(empty($type)){
            echo false;
            die;
        }
        //创建一条记录到custom表中
        $customArr = array();
        $customArr['create_name'] = $_SESSION['system']['realname'];
        $customArr['create_time'] = $time;
        $customArr['num'] = $num;
        $cid = D('off_custom_qrcode')->add($customArr);
        if ($cid) {
            $dir = date('Y-m-d',$time);
            $flag = array();
            $mt_rand = mt_rand(1000000,9999999);
            //保证字符串总长度 zhukeqin
            $digit=6-mb_strlen($type);
            //检查是否重复 zhukeqin
            while (file_exists("./upload/qrcode/".$dir."/".$type.$mt_rand.sprintf("%0".$digit."d" , '1').'.png')){
                $mt_rand = mt_rand(1000000,9999999);
            }
            for ($x=1; $x<=$num; $x++) {
                $k = sprintf("%0".$digit."d" , $x);
//                $qr_data['pro_qrcode'] = 'C'.$time.mt_rand(100,999).$k;
                $qr_data['pro_qrcode'] = $type.$mt_rand.$k;
                $qr_data['adress'] = "./upload/qrcode/".$dir."/".$qr_data['pro_qrcode'].'.png';
                $qr_data['type'] = 2;
                $qr_data['cid'] = $cid;
                $qr_data['village_id'] = $this->village_id;
                $qr_data['direction'] = 2;
                $re = D('off_products_ercode')->add($qr_data);
                if ($re) {
                    $url =  C('WEB_DOMAIN') . '/wap.php?g=Wap&c=PropertyService&a=punch_safety_card_C&pro_qrcode=' . $qr_data['pro_qrcode'];
                    $path = "./upload/qrcode/".$dir."/";
                    $this->get_qr($url,$path,$qr_data['pro_qrcode']);
                } else {
                    if (!$re) $flag[] = $x;
                }
            }


            //计算出错误个数
            if (count($flag) > 1) {
                $fStr = implode(',',$flag);
            } elseif(count($flag) == 1) {
                $fStr = $flag[0];
            }
            //返回到ajax
            if ($flag) {
                echo $fStr;
            } else {
                echo 1;
            }
        } else {
            echo false;
        }*/
        $num = I('post.num');
        $type=I('post.type');
        $time = time();
        $mission_log=new Mission_logModel();
        //ajax创建任务 zhukeqin
        if(!empty($num)&&!empty($type)) {
            if (empty($type)) {
                echo false;
                die;
            }
            //创建一条记录到custom表中
            $customArr = array();
            $customArr['create_name'] = $_SESSION['system']['realname'];
            $customArr['create_time'] = $time;
            $customArr['num'] = $num;
            $customArr['direction'] = 1;
            $cid = D('off_custom_qrcode')->add($customArr);
            $data=array(
                'now_num'=>0,
                'num'=>$num,
                'type'=>$type,
                'cid'=>$cid,
                'flag'=>'',
                'direction'=>1,
            );
            $return=$mission_log->add_mission_one($data,'PropertyService/products_create_qrcode');
            echo $return;
            die;
        }
        //执行任务 zhukeqin
        $log_id=I('get.log_id');
        if(!empty($log_id)){
            $return=$mission_log->get_mission_one($log_id);
            $num=$return['log_data']['num'];
            $type=$return['log_data']['type'];
            $cid=$return['log_data']['cid'];
            $now_num=$return['log_data']['now_num'];
            $log_flag=$return['log_data']['flag'];
            $status=$return['log_status'];
            //判断是否完成任务 zhukeqin
            if($status==2){
                if(!empty($log_flag)){
                    $this->success('当前任务已完成！其中以下条目出现问题:'.$log_flag,U('PropertyService/products_custom_list'),60);
                    die;
                }else{
                    $this->success('当前任务已完成！',U('PropertyService/products_custom_list'),1);
                    die;
                }
            }
            if ($cid) {
                $dir = date('Y-m-d',$time);
                $flag = array();
                $mt_rand = mt_rand(1000000,9999999);
                //保证字符串总长度 zhukeqin
                $digit=6-mb_strlen($type);
                //检查是否重复 zhukeqin
                while (file_exists("./upload/qrcode/".$dir."/".$type.$mt_rand.sprintf("%0".$digit."d" , '1').'.png')){
                    $mt_rand = mt_rand(1000000,9999999);
                }
                for ($x=$now_num+1,$i=1; $x<=$num; $x++,$i++) {
                    $k = sprintf("%0".$digit."d" , $x);
//                $qr_data['pro_qrcode'] = 'C'.$time.mt_rand(100,999).$k;
                    $qr_data['pro_qrcode'] = $type.$mt_rand.$k;
                    $qr_data['adress'] = "./upload/qrcode/".$dir."/".$qr_data['pro_qrcode'].'.png';
                    $qr_data['type'] = 2;
                    $qr_data['cid'] = $cid;
                    $qr_data['village_id'] = $this->village_id;
                    $re = D('off_products_ercode')->add($qr_data);
                    if ($re) {
                        $url =  C('WEB_DOMAIN') . '/wap.php?g=Wap&c=PropertyService&a=punch_safety_card_C&pro_qrcode=' . $qr_data['pro_qrcode'];
                        $path = "./upload/qrcode/".$dir."/";
                        $this->get_qr($url,$path,$qr_data['pro_qrcode']);
                    } else {
                        if (!$re) $flag[] = $x;
                    }
                    //一次最多生成500个二维码 zhukeqin
                    if($i>=200){
                        break;
                    }

                }


                //计算出错误个数
                if (count($flag) > 1) {
                    $fStr = implode(',',$flag);
                } elseif(count($flag) == 1) {
                    $fStr = $flag[0];
                }
                if(!empty($fStr)) $flag .=','.$fStr;
                if($x>=$num){
                    $status=2;
                }else{
                    $status=1;
                }
                $log_data=array(
                    'now_num'=>$x,
                    'num'=>$num,
                    'type'=>$type,
                    'cid'=>$cid,
                    'flag'=>$flag,
                );
                $return=$mission_log->change_mission_one($log_id,$log_data,$status);
                if(empty($return)) {
                    $this->error('创建中途失败,已停止');
                }else{
                    $cache=$num>$x?$x:$num;
                    $this->success('当前已创建'.$cache.'个,总共需要创建'.$num.'个，创建过程中请不要离开本页面',U('PropertyService/products_create_qrcode',array('log_id'=>$log_id)),1);
                    die;
                }
            } else {
                $this->error('您的操作有误！请重试');
            }
        }else{
            $this->error('您的操作有误！请重试');
        }


    }

    /**
     * 生成二维码链接 *并且不会生成本文件(更新后，生成本文件)
     * 注：之前不要有输出
     * @param $url 扫描后跳转地址
     * @param string $logo 二维码中间的logo图片地址 默认为汇得行的logo
     * @update-time: 2018-06-2 9:25
     * @author: 曾梦飞
     */
    function get_qr($url,$path,$xxx,$logo="./static/PropertyService/images/xx.png"){
        header("content-type:text/html;charset=utf-8");
        import('@.ORG.phpqrcode');
        // 生成的二维码所在目录+文件名

        if(!file_exists($path)){
            mkdir($path, 0777,true);//创建目录
        }
        $fileName = $path.$xxx.".png";

        $size = $_GET['size'] ? $_GET['size']: 27;
        ob_start();
        QRcode::png(htmlspecialchars_decode(urldecode($url)),false,0,$size,1);
        $QR = ob_get_contents();//截取缓冲区中的二维码图
        ob_end_clean();
        if ($logo !== FALSE) {
            $QR = imagecreatefromstring($QR);
            $logo = imagecreatefromstring(file_get_contents($logo));
            $QR_width = imagesx($QR);//二维码图片宽度
            $QR_height = imagesy($QR);//二维码图片高度
            $logo_width = imagesx($logo);//logo图片宽度
            $logo_height = imagesy($logo);//logo图片高度
            $logo_qr_width = $QR_width / 5;
            $scale = $logo_width/$logo_qr_width;
            $logo_qr_height = $logo_height/$scale;
            $from_width = ($QR_width - $logo_qr_width) / 2;
            //重新组合图片并调整大小
            imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
        }
        //输出图片
        Header("Content-type: image/png");
        ImagePng($QR,$fileName);
        imagedestroy($QR);
        //文件调整dpi
        $file = file_get_contents($fileName);

        //数据块长度为9
        $len = pack("N", 9);
        //数据块类型标志为pHYs
        $sign = pack("A*", "pHYs");
        //X方向和Y方向的分辨率均为300DPI（1像素/英寸=39.37像素/米），单位为米（0为未知，1为米）
        $data = pack("NNC", 300 * 39.37, 300 * 39.37, 0x01);
        //CRC检验码由数据块符号和数据域计算得到
        $checksum = pack("N", crc32($sign . $data));
        $phys = $len . $sign . $data . $checksum;

        $pos = strpos($file, "pHYs");
        if ($pos > 0) {
            //修改pHYs数据块
            $file = substr_replace($file, $phys, $pos - 4, 21);
        } else {
            //IHDR结束位置（PNG头固定长度为8，IHDR固定长度为25）
            $pos = 33;
            //将pHYs数据块插入到IHDR之后
            $file = substr_replace($file, $phys, $pos, 0);
        }
        file_put_contents($fileName,$file);
    }


    //aJax领取
    public function products_operate_save(){
        $id = I('post.id');
        $borrower = I('post.borrower');
        $time = time();
        //是否是第一次领取
        $recArr = D('off_products_ercode')->where(array('id'=>$id))->find();
        //不是第一次领取就加入transmit表存到数据库
        if ($recArr['receive'] == 1 && $recArr['borrower']) {
            $pro_qrcode = $recArr['pro_qrcode'];
            $rec = D('off_transmit')->where(array('pro_qrcode'=>$pro_qrcode))->find();
            $transmitArr = array();
            //是否首次转交
            if ($rec) {
                //不是
                $transmitArr['zero_time'] = $rec['zero_time'];
            } else {
                //第一次转交
                $transmitArr['zero_time'] = $recArr['trans_time'];
            }
            $transmitArr['old_name'] = $recArr['borrower'];
            $transmitArr['new_name'] = $borrower;
            $transmitArr['pro_qrcode'] = $pro_qrcode;
            $transmitArr['transmit_time'] = $time;
            D('off_transmit')->add($transmitArr);
        }

        $re = D('off_products_ercode')->where(array('id'=>$id))->save(array('receive'=>1,'borrower'=>$borrower,'trans_time'=>$time));
        if ($re) {
            $date = date('Y-m-d H:i:s');
            echo json_encode(array('err'=>0,'date'=>$date));
        } else {
            echo json_encode(array('err'=>1));
        }
    }


    //aJax批量领取
    public function products_operate_save_all(){
        $ids = I('post.ids');
        $borrower = I('post.borrower');

        $id_arr = explode(',',$ids);
        $flag = array();
        foreach ($id_arr as $v) {
            //是否是第一次领取
            $recArr = D('off_products_ercode')->where(array('id'=>$v))->find();
            //不是第一次领取就加入transmit表存到数据库
            if ($recArr['receive'] == 1 && $recArr['borrower']) {
                $pro_qrcode = $recArr['pro_qrcode'];
                $rec = D('off_transmit')->where(array('pro_qrcode'=>$pro_qrcode))->find();
                $transmitArr = array();
                //是否首次转交
                if ($rec) {
                    //不是
                    $transmitArr['zero_time'] = $rec['zero_time'];
                } else {
                    //第一次转交
                    $transmitArr['zero_time'] = $recArr['trans_time'];
                }
                $transmitArr['old_name'] = $recArr['borrower'];
                $transmitArr['new_name'] = $borrower;
                $transmitArr['pro_qrcode'] = $pro_qrcode;
                $transmitArr['transmit_time'] = time();
                D('off_transmit')->add($transmitArr);
            }


            $re = D('off_products_ercode')->where(array('id'=>$v))->save(array('receive'=>1,'borrower'=>$borrower,'trans_time'=>time()));
            if (!$re) $flag[] = $v;
        }
        //计算出错误个数
        if (count($flag) > 1) {
            $fStr = implode(',',$flag);
        } elseif(count($flag) == 1) {
            $fStr = $flag[0];
        }
        //返回到ajax
        if ($flag) {
            echo $fStr;
        } else {
            echo 1;
        }


    }


    public function get_url(){
        $id = I('post.id');
        $adress = D('off_products_ercode')->where(array('id'=>$id))->getField('adress');
        echo $adress;
    }

    /**
     * @param $url url路径
     * 生成二维码
     */
    public function QR($url){
        $type=I('get.type');
        //url解码
        $url=urldecode($url);
        $url=htmlspecialchars_decode($url);
        if($type=='notlogo'){
            qr($url,'1');
        }else{
            qr($url,'./static/PropertyService/images/xx.png');
        }

    }




    //打包下载
    public function products_zip_z(){
//        $ids = I('post.ids');
//        $ids = "225,226,227";
        $ids = I('get.ids');
        $id_arr = explode(',',$ids);
        $data = array();
        $pro_name = "zdy.zip";
        foreach ($id_arr as $k => $v) {
            $Arr = D('off_products_ercode')
                ->field('id,pro_qrcode,adress')
                ->where(array('id'=>$v))
                ->find();
            $name = $Arr['pro_qrcode'].'.png';
            $data[$name] =  $Arr['adress'];
        }
//        echo json_encode($data);
        $this->excu_zip($data,$pro_name);

    }


    //打包下载
    public function products_zip(){
//        $ids = I('post.ids');
//        $ids = "225,226,227";
        $ids = I('get.ids');
        $id_arr = explode(',',$ids);
        $data = array();
        $pro_name = '';
        foreach ($id_arr as $k => $v) {
            $Arr = D('off_products_ercode')
                ->field('pro_qrcode,adress,pro_code')
                ->where(array('id'=>$v))->find();
            if (empty($pro_name)) {
                $pro_name = D('off_products')->where(array('pro_code'=>$Arr['pro_code']))->getField('pro_name');
                $pro_name = $pro_name.".zip";
            }
//            $name = $Arr['pro_qrcode'].'.png';
            $name = $Arr['pro_qrcode'].'.png';
            $data[$name] =  $Arr['adress'];
        }
//        echo json_encode($data);
        $this->excu_zip($data,$pro_name);

    }



    public function excu_zip($data,$zipName) {
        $dfile =  tempnam('/tmp', 'tmp');//产生一个临时文件，用于缓存下载文件
        import('@.ORG.zipfile');
        $zip = new zipfile();

        //----------------------
        if ($zipName) {
            $filename = $zipName;//下载的默认文件名
        } else {
            $filename = 'image.zip'; //下载的默认文件名
        }

        //以下是需要下载的图片数组信息，将需要下载的图片信息转化为类似即可
//        $image = array(
//            array('image_src' => 'pic1.jpg', 'image_name' => '图片1.jpg'),
//            array('image_src' => 'pic2.jpg', 'image_name' => 'pic/图片2.jpg'),
//        );

        foreach($data as $k => $v){
            $zip->add_file(file_get_contents($v), $k);
            // 添加打包的图片，第一个参数是图片内容，第二个参数是压缩包里面的显示的名称, 可包含路径
            // 或是想打包整个目录 用 $zip->add_path($image_path);
        }
        //----------------------
        $zip->output($dfile);

        // 下载文件
        ob_clean();
        header('Pragma: public');
        header('Last-Modified:'.gmdate('D, d M Y H:i:s') . 'GMT');
        header('Cache-Control:no-store, no-cache, must-revalidate');
        header('Cache-Control:pre-check=0, post-check=0, max-age=0');
        header('Content-Transfer-Encoding:binary');
        header('Content-Encoding:none');
        header('Content-type:multipart/form-data');
        header('Content-Disposition:attachment; filename="'.$filename.'"'); //设置下载的默认文件名
        header('Content-length:'. filesize($dfile));
        $fp = fopen($dfile, 'r');
        while(connection_status() == 0 && $buf = @fread($fp, 8192)){
            echo $buf;
        }
        fclose($fp);
        @unlink($dfile);
        @flush();
        @ob_flush();
        exit();
    }


    //二维码批量打印
    public function products_qrcode_pre() {
        $ids = I('post.ids');
        $idArr = explode(',',$ids);
        $data = array();
        foreach ($idArr as $k=>$v) {
            $erArr = D('off_products_ercode')->where(array('id'=>$ids,'type'=>2))->find();
            $data[$k]['adress'] = $erArr['adress'];
            $data[$k]['id'] = $v;
            $data[$k]['pro_qrcode'] = $erArr['pro_qrcode'];
        }
        $this->assign('data',$data);
        $this->display();
    }


    //二维码详情
    public function products_qr_detail() {
        if (IS_POST) {
            $borrower = I('post.borrower');
            $pro_qrcode = I('post.pro_qrcode');
            $data = array();
            $data['borrower'] = $borrower;
            $data['trans_time'] = time();
            $data['receive'] = 1;
            //是否是第一次领取
            $recArr = D('off_products_ercode')->where(array('pro_qrcode'=>$pro_qrcode))->find();
            //不是第一次领取就加入transmit表存到数据库
            if ($recArr['receive'] == 1 && $recArr['borrower']) {
                $rec = D('off_transmit')->where(array('pro_qrcode'=>$pro_qrcode))->find();
                $transmitArr = array();
                //是否首次转交
                if ($rec) {
                    //不是
                    $transmitArr['zero_time'] = $rec['zero_time'];
                } else {
                    //第一次转交
                    $transmitArr['zero_time'] = $recArr['trans_time'];
                }
                $transmitArr['old_name'] = $recArr['borrower'];
                $transmitArr['new_name'] = $borrower;
                $transmitArr['pro_qrcode'] = $pro_qrcode;
                $transmitArr['transmit_time'] = $data['trans_time'];
                D('off_transmit')->add($transmitArr);
            }
            $res = D('off_products_ercode')->where(array('pro_qrcode'=>$pro_qrcode))->save($data);
            if ($res) {
                $this->success('更新成功',U('PropertyService/punch_safety_card',array('pro_qrcode'=>$pro_qrcode)));
            } else {
                $this->error('更新失败',U('PropertyService/punch_safety_card',array('pro_qrcode'=>$pro_qrcode)));
            }
        } else {
            $role_id = $_SESSION['admin_id'];
            if ($role_id) $this->assign('isOpen',1);
            $pro_qrcode = I('get.pro_qrcode');
            //创建物品时生成的二维码
            $field = array(
                'p.*',
                'er.pro_qrcode',
                'er.receive',
                'er.borrower',
                'er.trans_time',
                'er.id'=>'qid',
                't.id'=>'tid',
                't.type_name'=>'tname',
            );
            $proArr = D('off_products_ercode')->alias('er')
                ->field($field)
                ->join('left join __OFF_PRODUCTS__ p on p.pro_code = er.pro_code')
                ->join('left join __OFF_TYPE__ t on t.id=p.off_pro_type')
                ->where(array('er.pro_qrcode'=>$pro_qrcode))
                ->find();
            $this->assign('proArr',$proArr);
            $this->assign('pro_qrcode',$pro_qrcode);
            $this->display();
        }

    }


    public function history_qrcode(){
        $id = I('get.id');
        $qrArr = D('off_products_ercode')->where(array('id'=>$id))->find();
        $pro_qrcode = $qrArr['pro_qrcode'];
        $transmitArr = D('off_transmit')->where(array('pro_qrcode'=>$pro_qrcode))->order('transmit_id asc')->select();
        if (!empty($transmitArr)) {
            foreach ($transmitArr as $k=>&$v) {
                if ($k == 0) {
                    $time = $v['transmit_time'] - $v['zero_time'];
                    $s_date = date('Y-m-d H:i:s',$v['zero_time']);
                    $e_date = date('Y-m-d H:i:s',$v['transmit_time']);
                } else {
                    $time = $v['transmit_time'] - $transmitArr[$k-1]['transmit_time'];
                    $s_date = date('Y-m-d H:i:s',$transmitArr[$k-1]['transmit_time']);
                    $e_date = date('Y-m-d H:i:s',$v['transmit_time']);
                }
                $date = $this->Sec2Time($time);
                $v['tt_name'] = $v['old_name'];
                $v['s_date'] = $s_date;
                $v['e_date'] = $e_date;
                $v['xx_time'] = $date;
            }
            unset($v);
            $LastArr = end($transmitArr);
            $new_name = $LastArr['new_name'];
            $new_date = date('Y-m-d H:i:s',$LastArr['transmit_time']);

        } else {
            if ($qrArr['borrower']) {
                $new_name = $qrArr['borrower'];
                $new_date = date('Y-m-d H:i:s',$qrArr['trans_time']);
            } else {
                $this->assign('hello',1);
            }
        }

        if ($new_name) $this->assign('new_name',$new_name);
        if ($new_date) $this->assign('new_date',$new_date);

        $pro_id = $_GET['pro_id']?:0;
        $this->assign('pro_id',$pro_id);

        $cid = $_GET['cid']?:0;
        $this->assign('cid',$cid);

        $this->assign('pro_qrcode',$pro_qrcode);
        $this->assign('transmitArr',$transmitArr);
        $this->display();
    }


    //自定义二维码详情
    public function punch_safety_card_C() {
        if (IS_POST) {
            $pro_id = I('post.pro_id');
            $borrower = I('post.borrower');
            $pro_qrcode = I('post.pro_qrcode');
            $re = D('off_products')->where(array('pro_id'=>$pro_id))->setInc('pro_stock');
            if ($re) {
                $pro_code = D('off_products')->where(array('pro_id'=>$pro_id))->getField('pro_code');
                $data = array();
                $data['borrower'] = $borrower;
                $data['pro_code'] = $pro_code;
                $data['trans_time'] = time();
                $data['receive'] = 1;
                $res = D('off_products_ercode')->where(array('pro_qrcode'=>$pro_qrcode))->save($data);
                if ($res) {
                    $this->success('更新成功',U('PropertyService/products_qr_detail',array('pro_qrcode'=>$pro_qrcode)));
                } else {
                    $this->error('更新失败',U('PropertyService/products_qr_detail_C',array('pro_qrcode'=>$pro_qrcode)));
                }
            } else {
                $this->error('更新失败',U('PropertyService/products_qr_detail_C',array('pro_qrcode'=>$pro_qrcode)));
            }

        } else {
            header("location:http://www.hdhsmart.com/wap.php?g=Wap&c=PropertyService&a=punch_safety_card_C&pro_qrcode=".$_GET['pro_qrcode']);
            $pro_qrcode = I('get.pro_qrcode');
            $role_id = $_SESSION['admin_id'];
            if ($role_id) $this->assign('isOpen',1);
            $receive = D('off_products_ercode')->where(array('pro_qrcode'=>$pro_qrcode))->getField('receive');
            if ($receive == 1) {
                $this->redirect(U('PropertyService/products_qr_detail',array('pro_qrcode'=>$pro_qrcode)));
            }
            $typeArr = $this->get_type_all();
            $this->assign('typeArr',$typeArr);
            $this->assign('pro_qrcode',$pro_qrcode);
            $this->display();
        }


    }


    //获得分类方法
    public function get_type_all(){
        $typeArr = D('off_type')->where(array('pid'=>0,'is_del'=>0))->order('id asc')->select();
        foreach ($typeArr as $k => &$v) {
            $son = D('off_type')->where(array('pid'=>$v['id'],'is_del'=>0))->order('pid asc')->select();
            foreach ($son as $sk => &$sv) {
                $g_son = D('off_type')->where(array('pid'=>$sv['id'],'is_del'=>0))->order('pid asc')->select();
                $son[$sk]['g_son'] = $g_son;
            }
            $typeArr[$k]['son'] = $son;
        }
        unset($v);
        unset($sv);
        return $typeArr;
    }


    //自定义二维码管理
    public function products_qrcode_list(){
        $cid = I('get.cid');
        $qrArr = D('off_products_ercode')->alias('er')
            ->field('er.*,v.village_name,r.room_name,p.orientation')
            ->join('left join __HOUSE_VILLAGE_POINT__ p on p.id = er.pro_code')
            ->join('left join __HOUSE_VILLAGE_ROOM__ r on r.id = p.rid')
            ->join('left join __HOUSE_VILLAGE__ v on v.village_id = r.village_id')
            ->where(array('er.type'=>2,'er.cid'=>$cid))
            ->select();
//        echo M()->_sql();exit;
//        dump($qrArr);exit;
        $this->assign('cid',$cid);
        $this->assign('qrArr',$qrArr);
        $this->display();
    }


    //自定义二维码管理
    public function products_custom_list(){
        $cusArr = D('off_custom_qrcode')
            ->where(array('direction'=>1))
            ->order('cid desc')
            ->select();
        foreach ($cusArr as &$v) {
            $cid = $v['cid'];
            //被领取数量
            $r_num = D('off_products_ercode')->where(array('type'=>2,'cid'=>$cid,'receive'=>1))->count();
            $v['r_num'] = $r_num?:0;
        }
        $this->assign('cusArr',$cusArr);
        $this->display();
    }

    /**
     * 消防点列表
     * @author libin
     * @time 2018年8月22日11:14:47
     * updatetime 2018年8月23日10:14:47
     */
    public function point_safety_list(){
        $is_del = $_GET['is_del'];
        if ($_GET['default_village_id']) {
            $village_id = $_GET['default_village_id'];
        } else {
            $village_id = $_SESSION['system']['village_id'];
        }
        $model = M('house_village_point');
        $field = array(
            'p.*',
            'v.village_name',
            'r.room_name',
        );
        $map['v.village_id'] = array('eq',$village_id);
        if(session('system.account')==SUPER_ADMIN){
            $pointArray = $model
                ->alias('p')
                ->field($field)
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ r ON p.rid=r.id')
                ->join('LEFT JOIN __HOUSE_VILLAGE__ v ON r.village_id=v.village_id')
                ->where(array('p.type'=>1))
                ->where($map)
                ->where(array('p.status'=>array('eq',0),'is_del'=>$is_del))
                ->select();
        }else{

            $pointArray = $model
                ->alias('p')
                ->field($field)
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ r ON p.rid=r.id')
                ->join('LEFT JOIN __HOUSE_VILLAGE__ v ON r.village_id=v.village_id')
                ->where(array('p.type'=>1))
                ->where($map)
                ->where(array('p.status'=>array('eq',0),'is_del'=>$is_del,'r.village_id'=>array('eq',session('system.village_id'))))
                ->select();
            /*->group('rid')'r.fid'=>array('eq',0),*/

        }
        //vd($pointArray);exit;
        $this->assign('pointArray',$pointArray);
        $this->display('point_safety_list');

    }

    /**
     * 二维码展示页面
     */
    public function qrcode_safety_point(){
        //vd(1);
        layout(false);

        $rid = I('get.rid');
        $thisPointArray = M('house_village_point')
            ->alias('p')
            ->field(array('p.*','r.village_id','r.room_name'))
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ r on r.id=p.rid')
            ->where(array('p.type'=>1))
            ->where(array('p.rid'=>$rid,'p.is_del'=>0))
            ->select();
        foreach ($thisPointArray as $key=>$value){
            $ercode_info=M('off_products_ercode')->where(array('pro_code'=>$value['id']))->find();
            $thisPointArray[$key]['url'] = C('WEB_DOMAIN').'/wap.php?g=Wap&c=PropertyService&a=punch_safety_card&id='.$value['id'];
            $thisPointArray[$key]['adress'] = $ercode_info['adress'];
        }
        //vd($thisPointArray);exit;

        $this->assign('thisPointArray',$thisPointArray);
        $this->display('qrcode_safety_point');
    }


    /**
     * 消防点添加
     * @author libin
     * @time 2018年8月22日15:14:47
     * updatetime 2018年8月23日14:14:47
     */
    public function point_safety_add(){
        if(IS_POST){
            $model = M('house_village_point');
            $data =$_POST;
            // print_r($data);exit;
            $point_arr = [];
            for ($i=1; $i <= $data['number']; $i++) {
                $data['orientation'] = $data['head'].'_'.$i;
                $point_arr[] = $data['orientation'];
            }
            // print_r($point_arr);exit;
            //判断该点位有没添加，添加过则跳过
            foreach ($point_arr as  $v) {
                $data['pointname'] =$v;
                $is_point = $model->where(array('type'=>1))->where(array('rid'=>$data['rid'],'orientation'=>$data['pointname']))->find();


                if($is_point){
                    $this->error($data['pointname'].'已存在，点位添加失败');
                }else{
                    $pointArray = array(
                        'rid'=>$data['rid'],
                        'name'=>$data['pointname'],
                        'desc'=>$data['desc'],
                        'orientation'=>$data['pointname'],
                        'type' => 1
                    );
                    $res = $model->data($pointArray)->add();
                }

                if($res){

                }else{
                    $this->error($data['pointname'].'点位添加失败');
                }
            }

            $this->success('点位添加成功');

        }else{
            if(session('system.account')==SUPER_ADMIN){
                //超级权限
                $villageArray = M('house_village')->where(array('status'=>array('eq',1)))->select();
                $roomArray = M('house_village_room')->where(array('status'=>0,'fid'=>0,'village_id'=>array('eq',4)))->select();
                $this->assign('villageArray',$villageArray);
            }else{
                $roomArray = M('house_village_room')->where(array('status'=>0,'fid'=>0,'village_id'=>array('eq',session('system.village_id'))))->select();
            }

            $this->assign('roomArray',$roomArray);
            $this->display('point_safety_add');
        }
    }

    /**
     * 消防点变更
     */
    public function point_safety_update(){
        if(IS_POST){
            $id =  I('post.id');
            $rid=I('post.rid');
            $pointname=I('post.pointname');
            $data=array('name'=>$pointname,'orientation'=>$pointname,'rid'=>$rid);
            //设立标志位
            $_flag = false;
            $_flag=M('house_village_point')->where('id='.$id)->data($data)->save();
            if($_flag){
                $this->success('修改成功',U('point_safety_list'));
            }else{
                $this->error('修改失败',U('point_safety_list'));
            }

        }else{
            //更新该楼层下的所有巡检点
            $id = I('get.id');
            $pointArray = M('house_village_point')
                ->alias('p')
                ->field(array('p.*,r.id as rid ,r.village_id'))
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ r on r.id=p.rid')
                ->where(array('p.id'=>$id,'p.status'=>0,'p.is_del'=>0))
                ->find();
            //vd($pointArray);exit;
            //当前楼层的信息
            $roomArray = M('house_village_room')->where(array('status'=>0,'fid'=>0,'village_id'=>array('eq',$pointArray['village_id'])))->select();
            $this->assign('roomArray',$roomArray);
            $this->assign('room_name',$pointArray);
            $this->display('point_safety_update');
        }

    }


    /**
     * 消防点删除
     */
    public function point_safety_delete(){
        $rid = I('get.rid');
        if(!isset($rid)&&empty($rid)) exit();
        $res = M('house_village_room')->where(array('rid'=>$rid))->data(array('is_del'=>1))->save();
        if($res){
            $this->success('成功删除');
        }else{
            $this->error('删除失败');
        }

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
     * 巡更记录
     * @param int $point_status  紧急状态码
     * @author 祝君伟
     * @time 2017年9月8日14:54:35
     * @update-time 2018年9月28日10:24:46
     */
    public function point_record($point_status=0){

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

        //给设置班次的模态框传值(数据表里已经保存的数据)
        if(I('get.village_id')){
            $setArr = M('house_village_shift')->where(array('village_id'=>I('get.village_id')))->find();
        }else{
            $setArr = M('house_village_shift')->where(array('village_id'=>session('system.village_id')))->find();
        }
        // var_dump($setArr);exit();
        $this->assign('setArr',$setArr);

        //对班次数据进行处理
        if(I('get.village_id')){
            $timeArr = $this->get_shift_time(I('get.village_id'));
        }else{
            $timeArr = $this->get_shift_time(session('system.village_id'));
        }


        //条件
        $_map =array('p.is_del'=>0);
        $point_status && $_map['point_status']=array('eq',$point_status);

        //对班次进行判断，未设置则使用默认班次
        if (!$setArr) {
            $setArr = M('house_village_shift')->where(array('id'=>1))->find();
        }

        if(isset($_GET['d_time'])&&!isset($_GET['work_time'])){
            $thisDayStart = strtotime($_GET['d_time'])+$timeArr[0]*3600;
            $thisDayEnd = strtotime($_GET['d_time'])+$timeArr[1]*3600;
        }elseif (!isset($_GET['d_time'])&&isset($_GET['work_time'])){
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
        }elseif (isset($_GET['d_time'])&&isset($_GET['work_time'])){
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
            ->where(array('m.village_id'=>session('system.village_id'),'p.is_del'=>0))
            ->select()[0]['num'];
        //vd($nowPointCount);exit;
        $_map['r.check_time'] =array('between',array($thisDayStart,$thisDayEnd));
        //字段
        $field=array(
            'r.*',
            'p.orientation',
            'm.room_name',
            'v.village_name',
            'b.name'
        );
        if(session('system.account')==SUPER_ADMIN){
            //超级管理员

            //构建子查询
            $chlidSql = M('house_village_user_bind')->field(array('uid','`name`','MAX(pigcms_id)'))->group('uid')->buildSql();
            //主查询
            /* $pointRecord = M()
                 ->table($chlidSql.' b')
                 ->field($field)
                 ->join('LEFT JOIN __VILLAGE_POINT_RECORD__ r on b.uid=r.uid')
                 ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
                 ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
                 ->join('LEFT JOIN __HOUSE_VILLAGE__ v on v.village_id=m.village_id')
                 ->where($_map)
                 ->order('r.point_status desc,r.check_time desc')
                 ->limit(500)
                 ->select();*/

            $_map = filter_village($_map,1,'m');

            $pointRecord = M('village_point_record')
                ->alias('r')
                ->field($field)
                ->join('LEFT JOIN '.$chlidSql.' b on b.uid=r.uid')
                ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
                ->join('LEFT JOIN __HOUSE_VILLAGE__ v on v.village_id=m.village_id')
                ->where($_map)
                ->order('r.point_status desc,r.check_time desc')
                ->limit(500)
                ->select();
        }else{

            $_map['v.village_id'] = array('eq',session('system.village_id'));
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
                ->limit(500)
                ->select();

        }

        //巡更更改（范围更广）2018/5/19
        foreach ($pointRecord as &$v) {
            if (empty($v['name'])) $v['name'] = D('user')->where(array('uid'=>$v['uid']))->getField('truename');
        }
        unset($v);
        //vd($pointRecord);exit;
        //关于巡更点的展示
        //一共多少巡更点
//        $pointCount = M('house_village_point')->where(array('is_del'=>0))->count()-2;
        $pointCount = M('house_village_point')->alias('p')
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ r ON p.rid=r.id')
            ->where(array('p.type'=>0))
            ->where(array('r.village_id'=>session('system.village_id')))
            ->where(array('p.status'=>array('eq',0),'p.is_del'=>array('eq',0)))
            ->count()?:0;
        // vd(M()->_sql());exit;
        //未巡更的点
        $lowPointCount = $pointCount-$nowPointCount;

        if($lowPointCount<=0)$lowPointCount=0;

        //查询近30天的巡更记录
        $month_pointRecord = $this->get_month_point_record();
        $this->assign('month_pointRecord',$month_pointRecord);

        $this->assign('pointRecord',$pointRecord);
        $this->assign('lowPointCount',$lowPointCount);
        $this->assign('pointCount',$pointCount);
        $this->assign('nowPointCount',$nowPointCount);
        $this->display('point_record');
    }

    /**
     *获取过去30天的巡更报告
     */
    public function get_month_point_record() {
        $start_time = strtotime(date('Y-m-d'));  //获取本月第一天时间戳
        $array = array();
        for($i=1;$i<=30;$i++){
            $array[] = date('Y-m-d',$start_time-$i*86400); //每隔一天赋值给数组
        }

        $village_id = session('system.village_id');
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
        foreach ($array as $k => $v) {
            $time = strtotime($v);
            $Start_Time = $time+$is_set[0]*3600;
            $End_Time = $time+$is_set[1]*3600;
            //已经巡检的巡更点
            $yes_Count = M('village_point_record')->alias('r')
                ->field(array("count(DISTINCT pid)"=>'num'))
                ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
                ->where(array('r.check_time'=>array('between',array($Start_Time,$End_Time))))
                ->where(array('m.village_id'=>$village_id,'p.is_del'=>0))
                ->select()[0]['num'];

            $no_Count = intval($pointNum-$yes_Count)?:0;
            $newArr[$k]['date'] = $v;
            $newArr[$k]['pointNum'] = $pointNum;
            $newArr[$k]['yes_Count'] = $yes_Count;
            $newArr[$k]['no_Count'] = $no_Count;
        }

        return $newArr;
    }

    /**
     *设置社区的班次
     */
    public function village_shift_setting(){
        $data = $_POST;
        $data['morning_time_from'] = $data['morning_time_from'].':00';
        $data['morning_time_to'] = $data['morning_time_to'].':00';
        $data['middle_time_from'] = $data['middle_time_from'].':00';
        $data['middle_time_to'] = $data['middle_time_to'].':00';
        $data['night_time_from'] = $data['night_time_from'].':00';
        $data['night_time_to'] = $data['night_time_to'].':00';
        $village_id = $data['village_id'];
        //在班次表中查询当前village_id是否存在
        $is_set = M('house_village_shift')->where(array('village_id'=>$village_id))->find();
        if ($is_set) {//存在则修改
            unset($data['village_id']);
            $res = M('house_village_shift')->where(array('id'=>$is_set['id']))->data($data)->save();
        }else{//不存在则增加
            $res = D('house_village_shift')->data($data)->add();
        }
        echo $res;
    }


    /**
     * 根据选择的时间段来查询已巡更数量和未巡更数量并算出巡更率
     */
    public function get_record_rate(){
        //筛选社区
        if ($_GET['village_id']) {
            $village_id =  $_GET['village_id'];
        } else {
            $openid = $_SESSION['openid'];
            $village_id = D('admin')->where(array('openid'=>$openid))->find()['village_id'];
        }

        //查询是否设置班次        
        $is_set = $this->get_shift_time($village_id);

        //获取时间段
        $time_from = I('post.time_from');
        $time_to = I('post.time_to');
        $time_from_arr = explode('/', $time_from);
        $time_to_arr = explode('/', $time_to);
        $time_from1 = $time_from_arr[0].'-'.$time_from_arr[1].'-'.$time_from_arr[2];
        $time_to1 = $time_to_arr[0].'-'.$time_to_arr[1].'-'.$time_to_arr[2];
        $thisDayStart = strtotime($time_from1);
        $thisDayEnd = strtotime($time_to1);
        //计算相差的天数
        $daysCount = ($thisDayEnd - $thisDayStart)/(60*60*24);
        // var_dump($daysCount);exit();
        // if ($time_from_arr[1] == $time_to_arr[1]) {//月份相等时
        //     $daysCount = $time_to_arr[2] - $time_from_arr[2];
        // } else {//月份不相等时
        //     $num1 = $time_from_arr[1];
        //     $num2 = $time_to_arr[1];
        //     $monthsCount = 0;
        //     for ($i=$num1; $i < $num2 ; $i++) { 
        //         $monthCount = date("t",strtotime("$time_from_arr[0]-$i"));
        //         $monthsCount += $monthCount;
        //     }           
        //     $daysCount = $monthsCount + $time_to_arr[2] - $time_from_arr[2];
        // }
        $array = array();
        for($i=1;$i<=$daysCount;$i++){
            $array[] = date('Y-m-d',$thisDayEnd-$i*86400); //每隔一天将时间戳赋值给数组
        }
        //循环时间戳数组
        foreach ($array as $k => $v) {
            $time = strtotime($v);
            $Start_Time = $time+$is_set[0]*3600;
            $End_Time = $time+$is_set[1]*3600;


            //总巡更点
            $pointNum = M('house_village_point')->alias('p')
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ r ON p.rid=r.id')
                ->where(array('p.type'=>0))
                ->where(array('r.village_id'=>$village_id))
                ->where(array('p.status'=>array('eq',0),'p.is_del'=>array('eq',0)))
                ->count()?:0;

            //已经巡检的巡更点
            $yes_Count = M('village_point_record')->alias('r')
                ->field(array("count(DISTINCT pid)"=>'num'))
                ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
                ->where(array('r.check_time'=>array('between',array($Start_Time,$End_Time))))
                ->where(array('m.village_id'=>$village_id,'p.is_del'=>0))
                ->select()[0]['num'];
            // ->count();

            //已巡更数
            $nowPointCount += $yes_Count;
        }
        //总巡更次数
        $pointTol = $pointNum*$daysCount;
        // $pointTol = $pointNum*3*$num;

        //未巡更点数量
        $lowPointCount = $pointTol - $nowPointCount;
        //巡更率
        $rate = round(($nowPointCount / $pointTol) * 100, 0)."%";
        $data = [
            'nowPointCount' => $nowPointCount,
            'lowPointCount' => $lowPointCount,
            // 'pointNum' => $pointNum,
            'pointTol' => $pointTol,
            'rate' => $rate
        ];
        $list = json_encode($data);
        echo $list;
    }


    /**
     * 未巡检的点
     */
    public function no_check_point(){
        //已经巡检的巡更点
        /*vd($_GET['d_time']);
        vd($_GET['work_time']);exit;*/
        //对班次数据进行处理
        if(I('get.village_id')){
            $timeArr = $this->get_shift_time(I('get.village_id'));
        }else{
            $timeArr = $this->get_shift_time(session('system.village_id'));
        }

        if ($setArr) {//设置了班次就使用班次的时间
            // var_dump($setArr);exit();
            if(isset($_GET['d_time'])&&!isset($_GET['work_time'])){
                $thisDayStart = strtotime($_GET['d_time'])+$timeArr[0]*3600;
                $thisDayEnd = strtotime($_GET['d_time'])+$timeArr[1]*3600;
            }elseif (!isset($_GET['d_time'])&&isset($_GET['work_time'])){
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
            }elseif (isset($_GET['d_time'])&&isset($_GET['work_time'])){
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
        } else {//未设置班次使用默认班次时间
            $status = M('house_village_shift')->where(array('id'=>1))->find();
            // var_dump($status);exit();
            if(isset($_GET['d_time'])&&!isset($_GET['work_time'])){
                $thisDayStart = strtotime($_GET['d_time'])+$timeArr[0]*3600;
                $thisDayEnd = strtotime($_GET['d_time'])+$timeArr[1]*3600;
            }elseif (!isset($_GET['d_time'])&&isset($_GET['work_time'])){
                if($_GET['work_time'] == 1){
                    $thisDayStart = strtotime(date('Y-m-d').$status['morning_time_from']);
                    $thisDayEnd =strtotime(date('Y-m-d').$status['morning_time_to']);
                }elseif ($_GET['work_time'] == 2){
                    $thisDayStart = strtotime(date('Y-m-d').$status['middle_time_from']);
                    $thisDayEnd =strtotime(date('Y-m-d').$status['middle_time_to']);
                }else{
                    $thisDayStart = strtotime(date('Y-m-d').$status['night_time_from']);
                    $thisDayEnd =strtotime('+1 day',strtotime(date('Y-m-d').$status['night_time_to']));
                }
            }elseif (isset($_GET['d_time'])&&isset($_GET['work_time'])){
                if($_GET['work_time'] == 1){
                    $thisDayStart = strtotime($_GET['d_time'].$status['morning_time_from']);
                    $thisDayEnd =strtotime($_GET['d_time'].$status['morning_time_to']);
                }elseif ($_GET['work_time'] == 2){
                    $thisDayStart = strtotime($_GET['d_time'].$status['middle_time_from']);
                    $thisDayEnd =strtotime($_GET['d_time'].$status['middle_time_to']);
                }else{
                    $thisDayStart = strtotime($_GET['d_time'].$status['night_time_from']);
                    $thisDayEnd =strtotime('+1 day',strtotime($_GET['d_time'].$status['night_time_to']));
                }
            }else{
                //如果没有任何选项则进入当前当班的统计
                $nowTime = time();
                if($nowTime>=strtotime(date('Y-m-d').$status['morning_time_from'])&&$nowTime<=strtotime(date('Y-m-d').$status['morning_time_to'])){
                    $thisDayStart = strtotime(date('Y-m-d').$status['morning_time_from']);
                    $thisDayEnd = strtotime(date('Y-m-d').$status['morning_time_to']);
                    $this->assign('w_time',1);
                }elseif ($nowTime>=strtotime(date('Y-m-d').$status['middle_time_from'])&&$nowTime<=strtotime(date('Y-m-d').$status['middle_time_to'])){
                    $thisDayStart = strtotime(date('Y-m-d').$status['middle_time_from']);
                    $thisDayEnd = strtotime(date('Y-m-d').$status['middle_time_to']);
                    $this->assign('w_time',2);
                }elseif ($nowTime>=strtotime(date('Y-m-d').$status['night_time_from'])&&$nowTime<=strtotime('+1 day',strtotime(date('Y-m-d').$status['night_time_to']))){
                    $thisDayStart = strtotime(date('Y-m-d').$status['night_time_from']);
                    $thisDayEnd = strtotime('+1 day',strtotime(date('Y-m-d').$status['night_time_to']));
                    $this->assign('w_time',3);
                }
            }
        }

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
            ->where(array('r.check_time'=>array('between',array($thisDayStart,$thisDayEnd)),'r.is_check'=>1))
            ->select();

        //本班次没有巡更的点
        $noInArray = array();
        //vd($nowPointList);exit;
        foreach ($nowPointList as $key=>$value){
            $noInArray[] = $value['pid'];
        }
        //未检字段
        $field_low = array(
            'GROUP_CONCAT(p.orientation) AS oname',
            'm.room_name',
            'p.id'
        );
        //vd($noInArray);exit();
        if(empty($noInArray)){
            $lowPointList = M('house_village_point')
                ->alias('p')
                ->field($field_low)
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
                ->where(array('p.is_del'=>0))
                ->group('p.rid')
                ->select();
        }else{
            $lowPointList = M('house_village_point')
                ->alias('p')
                ->field($field_low)
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
                ->where(array('p.is_del'=>0,'p.id'=>array('not in',$noInArray)))
                ->group('p.rid')
                ->select();
        }
        foreach ($lowPointList as $lk=>$vk){
            if($vk['room_name']==''){
                unset($lowPointList[$lk]);
            }
        }
        //vd(M()->_sql());exit;
        $this->assign('nowPointList',$nowPointList);
        $this->assign('lowPointList',$lowPointList);
        $this->display('no_check_point');
    }

    /**
     * 记录详情
     *
     */
    public function point_detail(){
        $id = I('get.id');
        //条件
        $_map =array('p.is_del'=>0,'r.pigcms_id'=>array('eq',$id));
        //字段
        $field=array(
            'r.*',
            'p.orientation',
            'm.room_name',
            'v.village_name',
            'b.name'
        );
        //查询当前记录的信息
        $pointRecord = M('village_point_record')
            ->alias('r')
            ->field($field)
            ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ p on p.id=r.pid')
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
            ->join('LEFT JOIN __HOUSE_VILLAGE__ v on v.village_id=m.village_id')
            ->join('LEFT JOIN __HOUSE_VILLAGE_USER_BIND__ b on b.uid=r.uid')
            ->where($_map)
            ->group('uid')
            ->find();
        if (empty($pointRecord['name'])) $pointRecord['name'] = D('user')->where(array('uid'=>$pointRecord['uid']))->getField('truename');
        //vd(M()->_sql());
        $this->assign('pointRecord',$pointRecord);
        $this->display();
    }

    /**
     * 二维码展示页面
     */
    public function qrcode_point(){
        //vd(1);
        layout(false);
        $rid = I('get.rid');
        $thisPointArray = M('house_village_point')
            ->alias('p')
            ->field(array('p.*','r.village_id','r.room_name'))
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ r on r.id=p.rid')
            ->where(array('p.type'=>0))
            ->where(array('p.rid'=>$rid,'p.is_del'=>0))
            ->select();
        foreach ($thisPointArray as $key=>$value){
            $thisPointArray[$key]['url'] = C('WEB_DOMAIN').'/wap.php?g=Wap&c=PropertyService&a=punch_card&id='.$value['id'];

        }
        //vd($thisPointArray);exit;

        $this->assign('thisPointArray',$thisPointArray);
        $this->display('qrcode_point');
    }


    /**
     * 二维码预览页面
     */
    public function qrcode_preview(){
        $type = I('get.type');
        $village_id=I('get.village_id');
        $village_info=M('house_village')->where('village_id='.$village_id)->find();
        if($type=='shuidian'){
            //水电数据
            $model = new MeterModel();
            $list = $model->meter_list($village_id,$village_info['village_type']);
            foreach($list as &$row){
                $row['url'] =  C('WEB_DOMAIN') . '/wap.php?g=Wap&c=Meter&a=enter&meter_hash=' . $row['meter_hash'];
                $row['qr_img'] =  U('QR') . '&url=' . urlencode($row['url']);

                $row['type_name'] = $row['meter_type_desc']; //类型
                $row['code'] = $row['meter_code']; //编号
                $row['location'] = $row['meter_floor']; //位置
                $row['orientation'] = ""; //方位
                $row['rate'] = floor($row['rate']);
            }
            unset($row);
            $this->assign('list',$list);
            $this->assign('bg',"./static/PropertyService/images/chaobiao.jpg");

        }elseif($type=='zhuanyeshebei'){
            //专业设备数据
            // $model = new MeterModel();
            $list = M('house_village_meters')->where(array('meter_type_id'=>113))->select();
            // var_dump($list);
            foreach($list as &$row){
                $meter_cate = M('house_village_meter_cate')->where(array('id'=>$row['cate_id']))->select()[0]['desc'];
                $village = $row['meter_desc'];
                $village = explode('-',$village);
                // var_dump($village);
                $row['url'] =  C('WEB_DOMAIN') . '/wap.php?g=Wap&c=Room&a=meter_bind_card&meter_hash=' . $row['meter_hash'];
                $row['qr_img'] =  U('QR') . '&url=' . urlencode($row['url']);

                $row['type_name'] = "工程设备抄表"; //类型
                $row['code'] = $row['meter_code']; //编号
                $row['location'] = '-'.$village[1]; //位置
                $row['orientation'] = ""; //方位
                $row['meter_cate'] = $meter_cate;
                $row['village_name'] = $village[0];
            }
            unset($row);
            $this->assign('list',$list);
            $this->assign('bg',"./static/PropertyService/images/chaobiao.jpg");

        }else{
            //巡更数据
            $list = M('house_village_point')
                ->alias('p')
                ->field(array('p.*','r.village_id','r.room_name','hv.village_name'))
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ r on r.id=p.rid')
                ->join('LEFT JOIN __HOUSE_VILLAGE__ hv on hv.village_id=r.village_id')
                ->where(array('p.type'=>0))
                ->where(array('p.is_del'=>0,'r.village_id'=>$village_id))
                ->select();


            foreach ($list as $key=>&$row){
                $row['url'] = C('WEB_DOMAIN').'/wap.php?g=Wap&c=PropertyService&a=punch_card&id='.$row['id'];
                $row['qr_img'] =  U('QR') . '&url=' . urlencode($row['url']);

                $row['type_name'] = "扫码巡更"; //类型
                $row['code'] = sprintf("%04d",$row['id']); //编号
                $row['location'] = $row['room_name']; //位置
                if(!empty($row['name'])){
                    $row['orientation'] = $row['name'];//方位
                }else{
                    $row['orientation'] = $row['orientation']; //方位
                }

            }
            unset($row);
            $this->assign('list',$list);
            $this->assign('bg',"./static/PropertyService/images/x5.jpg");
        }
        $this->display();
    }
    /**
     * 二维码预览页面
     */
    public function qrcode_preview_select(){
        $type = I('post.type');
        $village_id=I('get.village_id');
        $village_info=M('house_village')->where('village_id='.$village_id)->find();
        $file = $_FILES['test'];
        $arr = import_excel_sheet($file);
        unset($arr[0]);
        $list_code=array();
        foreach ($arr as $value){
            if($type!='shuidian'){
                $value['0']=intval($value['0']);
            }
            $list_code[]=$value['0'];
        }
        if($type=='shuidian'){
            //水电数据
            $model = new MeterModel();
            $list = $model->meter_list($village_id,$village_info['village_type'],$list_code);
            foreach($list as &$row){
                $row['url'] =  C('WEB_DOMAIN') . '/wap.php?g=Wap&c=Meter&a=enter&meter_hash=' . $row['meter_hash'];
                $row['qr_img'] =  U('QR') . '&url=' . urlencode($row['url']);

                $row['type_name'] = $row['meter_type_desc']; //类型
                $row['code'] = $row['meter_code']; //编号
                $row['location'] = $row['meter_floor']; //位置
                $row['orientation'] = ""; //方位
                $row['rate'] = floor($row['rate']);
            }
            unset($row);
            $this->assign('list',$list);
            $this->assign('bg',"./static/PropertyService/images/chaobiao.jpg");

        }else{
            //添加搜索条件
            $map=array('p.is_del'=>0,'r.village_id'=>$village_id);
            if(!empty($list_code)){
                $map['p.id']=array('IN',implode(',',$list_code));
            }
            //巡更数据
            $list = M('house_village_point')
                ->alias('p')
                ->field(array('p.*','r.village_id','r.room_name','hv.village_name'))
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ r on r.id=p.rid')
                ->join('LEFT JOIN __HOUSE_VILLAGE__ hv on hv.village_id=r.village_id')
                ->where(array('p.type'=>0))
                ->where($map)
                ->select();


            foreach ($list as $key=>&$row){
                $row['url'] = C('WEB_DOMAIN').'/wap.php?g=Wap&c=PropertyService&a=punch_card&id='.$row['id'];
                $row['qr_img'] =  U('QR') . '&url=' . urlencode($row['url']);

                $row['type_name'] = "扫码巡更"; //类型
                $row['code'] = sprintf("%04d",$row['id']); //编号
                $row['location'] = $row['room_name']; //位置
                if(!empty($row['name'])){
                    $row['orientation'] = $row['name'];//方位
                }else{
                    $row['orientation'] = $row['orientation']; //方位
                }

            }
            unset($row);
            $this->assign('list',$list);
            $this->assign('bg',"./static/PropertyService/images/x5.jpg");
        }
        $this->display('qrcode_preview');
    }

    public function test_print(){

        /*$str = '<a href="'.U('qrcode_preview',array('type'=>'shuidian')).'">打印-扫码抄表</a>
                <br>
                <a href="'.U('qrcode_preview').'">打印-扫码巡更</a>';
        echo $str;*/
        $this->display('test_print');


    }

    //水电出账预览
//    public function hydropower_account() {
//        $tid = M('admin')->where('id=%d',session('admin_id'))->getField('tid');
//        if(!$tid){
//            $tid = I('get.tid',0,'intval');
//        }
//        $ym = isset($_GET['ym'])?$_GET['ym']:date('Y-m');
//        $village_id = session('system.village_id');
//        $model = new RoomModel();
//        $list = $model->preview_list($tid,$village_id,$ym);
//        $accountArr_1 = array();
//        foreach ($list as $v) {
//            $is_all_record = $v['is_all_record'];
//            if ($is_all_record == 0) {
//                continue;
//            }
//            $pigcms_id = $v['pigcms_id'];
//            $type = 1;
//            $usernum = $v['usernum'];
//            $accountArr_1[] = $this->show_this_template_two($type,$usernum,$pigcms_id);
//        }
////        dump($accountArr_1);exit;
////        dump($list);exit;
//        $this->assign('accountArr_1',$accountArr_1);
//        $this->assign('ym',$ym);
//        $this->display();
//    }

    public function hydropower_account_do() {
        $ym = I('post.ym');
        $idStr = I('post.ids');

        if (!$idStr) $this->error('请选择需要打印的id',U('Room/bill_preview'));
        $type = 1;
        if(!strpos($idStr,',')) {
            $pigcms_id = $idStr;
            $bindArr = D('house_village_user_bind')->where(array('pigcms_id'=>$pigcms_id))->find();
            $usernum = $bindArr['usernum'];
            $accountArr_1[] = $this->bulk_print_template($type,$usernum,$pigcms_id,$ym);
        } else {
            $id_arr = explode(',',$idStr);

            foreach ($id_arr as $v) {
                $pigcms_id = $v;
                $bindArr = D('house_village_user_bind')->where(array('pigcms_id'=>$pigcms_id))->find();
                $usernum = $bindArr['usernum'];
                if (!empty($usernum)) {
                    $accountArr_1[] = $this->bulk_print_template($type,$usernum,$pigcms_id,$ym);
                }
            }
        }
        //dump($accountArr_1);exit;
        $y = substr($ym,0,4);
        $m = substr($ym,strpos($ym,'-')+1);

        if ($m[0] == 0) {
            $m = $m[1];
        }

        $this->assign('y',$y);
        $this->assign('m',$m);
        $this->assign('accountArr_1',$accountArr_1);
//        $this->assign('ym',$ym);
        $this->display();
    }

    public function iframe(){
        $this->display();
    }


    public function test_cousume(){
        //判断是否生成账单
        $model = new MeterModel();
        $data = $model->get_tenant_cousume_list(4,0);
        dump($data);

    }


    /**
     * 创建账单数据表格
     * @param $billTemplateArray
     * @return string
     */
    protected function create_table($billTemplateArray)
    {

        //定义水电比较数

        $waterCount = count($billTemplateArray['water']);

        $electricCount = count($billTemplateArray['electric']);


        /*
         *主体结构概述
         * TODO： $basicInfoShowHtml  公司账单基本信息
         * TODO： $detailInfoHtml     公司账单水电详细信息
         * TODO： $public_html        公区水电结构
         * TODO： $otherInfoHtml      其他费用结构
         */

//        dump($billTemplateArray);exit;
        //公司账单基本信息
        $billTemplateArray['last_month_time'] = "2018-03-15";
        $billTemplateArray['create_time'] = "2018-04-16";

        if ($billTemplateArray['set_start_time']) $billTemplateArray['last_month_time'] = date('Y-m-d',$billTemplateArray['set_start_time']);
        if ($billTemplateArray['set_end_time']) $billTemplateArray['create_time'] = date('Y-m-d',$billTemplateArray['set_end_time']);

//        $billTemplateArray['last_month_time'] = "2018-3-5";
//        $billTemplateArray['create_time'] = "2018-03-15";

        $basicInfoShowHtml = '<table width="670" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td  width="18%" height="34" align="center" style="border:1px #000000 solid;">公司名称</td>
            <td  height="34" colspan="2" align="center" style="border:1px #000000 solid; border-left:none;">'.$billTemplateArray['company_name'].'</td>
            <td  width="18%" height="34" align="center" style="border:1px #000000 solid; border-left:none;">单元号</td>
            <td  height="34" colspan="2" align="center" style="border:1px #000000 solid; border-left:none;">'.$billTemplateArray['room_name'].'</td>
            </tr>
          <tr>
            <td height="34" align="center" style="border:1px #000000 solid; border-top:none;">上月抄表日期</td>
            <td height="34" colspan="2" align="center" style="border:1px #000000 solid; border-left:none; border-top:none;">'.$billTemplateArray['last_month_time'].'</td>
            <td height="34" align="center" style="border:1px #000000 solid; border-left:none; border-top:none;">本月抄表日期</td>
            <td height="34" colspan="2" align="center" style="border:1px #000000 solid; border-left:none; border-top:none;">'.$billTemplateArray['create_time'].'</td>
            </tr>
          <tr>
            <td width="16%" height="34" align="center" style="border:1px #000000 solid; border-top:none;">上月水表起码</td>
            <td width="16%" height="34" align="center" style="border:1px #000000 solid; border-left:none; border-top:none;">本月水表止码</td>
            <td width="16%" height="34" align="center" style="border:1px #000000 solid; border-left:none; border-top:none;"><p>用水量<br />
              （吨）</p>          </td>
            <td width="14%" height="34" align="center" style="border:1px #000000 solid; border-left:none; border-top:none;">上月电表<br/>起码(度)</td>
            <td width="14%" height="34" align="center" style="border:1px #000000 solid; border-left:none; border-top:none;">本月电表<br/>止码(度)</td>
            <td width="24%" height="34" align="center" style="border:1px #000000 solid; border-left:none; border-top:none;">用电量<br />
              （度）</td>
          </tr>';


        //公司账单水电详细信息

        $detailInfoHtml = '';

        if($waterCount>$electricCount)
        {
            foreach ($billTemplateArray['water'] as $wk=>$wv)
            {

                if ($wv['admin_defined_price'] > 0) {
                    $water_price = $wv['admin_defined_price'];
                } else {
                    if(empty($wv['now_rate'])){
                        $water_price=$wv['consume'];
                    }else{
                        $water_price=$wv['consume']*$wv['now_rate'];
                    }
                    //$water_price = $wv['cost'];
                }

                if ($billTemplateArray['electric'][$wk]['admin_defined_price'] > 0) {
                    $electric_price = $billTemplateArray['electric'][$wk]['admin_defined_price'];
                } else {
                    if(empty($billTemplateArray['electric'][$wk]['now_rate'])){
                        $electric_price = $billTemplateArray['electric'][$wk]['consume'];
                    }else{
                        $electric_price = $billTemplateArray['electric'][$wk]['consume']*$billTemplateArray['electric'][$wk]['now_rate'];
                    }
                    //$electric_price = $billTemplateArray['electric'][$wk]['cost'];
                }



                $detailInfoHtml .='<tr><td height="'.floor(210/$waterCount).'" align="center" style="border:1px #000000 solid; border-top:none;">'.$wv['last_total_consume'].'</td>';
                $detailInfoHtml .='<td height="'.floor(210/$waterCount).'" align="center" style="border:1px #000000 solid; border-top:none;border-left: none;">'.$wv['total_consume'].'</td>';
                if($wv['now_rate']>1)
                {
                    $detailInfoHtml .='<td height="'.floor(210/$waterCount).'" align="center" style="border:1px #000000 solid; border-top:none;border-left: none;">'.$water_price.'('.ceil($wv['now_rate']).'倍率)</td>';
                }else{
                    $detailInfoHtml .='<td height="'.floor(210/$waterCount).'" align="center" style="border:1px #000000 solid; border-top:none;border-left: none;">'.$water_price.'</td>';
                }

                if($billTemplateArray['electric'][$wk]['last_total_consume'])
                {
                    $detailInfoHtml .='<td height="'.floor(210/$waterCount).'" align="center" style="border:1px #000000 solid; border-top:none;border-left: none;">'.$billTemplateArray['electric'][$wk]['last_total_consume'].'</td>';
                }else{
                    $detailInfoHtml .='<td height="'.floor(210/$waterCount).'" align="center" style="border:1px #000000 solid; border-top:none;border-left: none;">/</td>';
                }


                if($billTemplateArray['electric'][$wk]['total_consume'])
                {
                    $detailInfoHtml .='<td height="'.floor(210/$waterCount).'" align="center" style="border:1px #000000 solid; border-top:none;border-left: none;">'.$billTemplateArray['electric'][$wk]['total_consume'].'</td>';
                }else{
                    $detailInfoHtml .='<td height="'.floor(210/$waterCount).'" align="center" style="border:1px #000000 solid; border-top:none;border-left: none;">/</td>';
                }


                if($billTemplateArray['electric'][$wk]['now_consume'])
                {
                    if($billTemplateArray['electric'][$wk]['now_rate']>1)
                    {
                        $detailInfoHtml .='<td height="'.floor(210/$waterCount).'" align="center" style="border:1px #000000 solid; border-top:none;border-left: none;">'.$electric_price.'('.ceil($billTemplateArray['electric'][$wk]['now_rate']).'倍率)</td></tr>';
                    }else{
                        $detailInfoHtml .='<td height="'.floor(210/$waterCount).'" align="center" style="border:1px #000000 solid; border-top:none;border-left: none;">'.$electric_price.'</td></tr>';
                    }

                }else{
                    $detailInfoHtml .='<td height="'.floor(210/$waterCount).'" align="center" style="border:1px #000000 solid; border-top:none;border-left: none;">/</td></tr>';
                }


            }
        }else{
            foreach ($billTemplateArray['electric'] as $ek=>$ev)
            {

                if ($billTemplateArray['water'][$ek]['now_consume'] > 0) {
                    $water_price = $billTemplateArray['water'][$ek]['now_consume'];
                } else {
                    $water_price = $billTemplateArray['water'][$ek]['cost'];
                }

                if ($ev['admin_defined_price'] > 0) {
                    $electric_price = $ev['admin_defined_price'];
                } else {
                    $electric_price = $ev['cost'];
                }

                if($billTemplateArray['water'][$ek]['last_total_consume'])
                {
                    $detailInfoHtml .='<tr><td height="'.floor(210/$electricCount).'" align="center" style="border:1px #000000 solid; border-top:none;">'.$billTemplateArray['water'][$ek]['last_total_consume'].'</td>';
                }else{
                    $detailInfoHtml .='<tr><td height="'.floor(210/$electricCount).'" align="center" style="border:1px #000000 solid; border-top:none;">/</td>';
                }


                if($billTemplateArray['water'][$ek]['total_consume'])
                {
                    $detailInfoHtml .='<td height="'.floor(210/$electricCount).'" align="center" style="border:1px #000000 solid; border-top:none;border-left: none;">'.$billTemplateArray['water'][$ek]['total_consume'].'</td>';
                }else{
                    $detailInfoHtml .='<td height="'.floor(210/$electricCount).'" align="center" style="border:1px #000000 solid; border-top:none;border-left: none;">/</td>';
                }


                if($billTemplateArray['water'][$ek]['now_consume'])
                {

                    if($billTemplateArray['water'][$ek]['now_rate']>1)
                    {
                        $detailInfoHtml .='<td height="'.floor(210/$electricCount).'" align="center" style="border:1px #000000 solid; border-top:none;border-left: none;">'.$water_price.'('.ceil($billTemplateArray['water'][$ek]['now_rate']).'倍率)</td>';
                    }else{
                        $detailInfoHtml .='<td height="'.floor(210/$electricCount).'" align="center" style="border:1px #000000 solid; border-top:none;border-left: none;">'.$water_price.'</td>';
                    }

                }else{
                    $detailInfoHtml .='<td height="'.floor(210/$electricCount).'" align="center" style="border:1px #000000 solid; border-top:none;border-left: none;">/</td>';
                }

                $detailInfoHtml .='<td height="'.floor(210/$electricCount).'" align="center" style="border:1px #000000 solid; border-top:none;border-left: none;">'.$ev['last_total_consume'].'</td>';
                $detailInfoHtml .='<td height="'.floor(210/$electricCount).'" align="center" style="border:1px #000000 solid; border-top:none;border-left: none;">'.$ev['total_consume'].'</td>';
                if($ev['now_rate']>1)
                {
                    $detailInfoHtml .='<td height="'.floor(210/$electricCount).'" align="center" style="border:1px #000000 solid; border-top:none;border-left: none;">'.$electric_price.'('.ceil($ev['now_rate']).'倍率)</td></tr>';
                }else{
                    $detailInfoHtml .='<td height="'.floor(210/$electricCount).'" align="center" style="border:1px #000000 solid; border-top:none;border-left: none;">'.$electric_price.'</td></tr>';
                }


            }

        }


        //公区水电结构

        $public_html='';
        if($billTemplateArray['water_public']==0&&$billTemplateArray['electric_public']==0)
        {
            $public_html='';
        }else if($billTemplateArray['water_public']!=0&&$billTemplateArray['electric_public']==0){
            $public_html = '<tr>
        <td height="34" align="center" style="border:1px #000000 solid; border-top:none;">公区水费分摊（元）</td>
        <td height="34" colspan="2" align="center" style="border:1px #000000 solid; border-top:none; border-left:none;">'.$billTemplateArray['water_public'].'</td>
        <td height="34" align="center" style="border:1px #000000 solid; border-left:none; border-top:none;">公区电费分摊（元）</td>
        <td height="34" colspan="2" align="center" style="border:1px #000000 solid; border-left:none; border-top:none;">/</td>
        </tr>';
        }else if($billTemplateArray['water_public']==0&&$billTemplateArray['electric_public']!=0){
            $public_html = '<tr>
        <td height="34" align="center" style="border:1px #000000 solid; border-top:none;">公区水费分摊（元）</td>
        <td height="34" colspan="2" align="center" style="border:1px #000000 solid; border-top:none; border-left:none;">/</td>
        <td height="34" align="center" style="border:1px #000000 solid; border-left:none; border-top:none;">公区电费分摊（元）</td>
        <td height="34" colspan="2" align="center" style="border:1px #000000 solid; border-left:none; border-top:none;">'.$billTemplateArray['electric_public'].'</td>
        </tr>';
        }else if($billTemplateArray['water_public']!=0&&$billTemplateArray['electric_public']!=0){
            $public_html = '<tr>
        <td height="34" align="center" style="border:1px #000000 solid; border-top:none;">公区水费分摊（元）</td>
        <td height="34" colspan="2" align="center" style="border:1px #000000 solid; border-top:none; border-left:none;">'.$billTemplateArray['water_public'].'</td>
        <td height="34" align="center" style="border:1px #000000 solid; border-left:none; border-top:none;">公区电费分摊（元）</td>
        <td height="34" colspan="2" align="center" style="border:1px #000000 solid; border-left:none; border-top:none;">'.$billTemplateArray['electric_public'].'</td>
        </tr>';
        }


        //其他费用结构

        $otherInfoHtml = '<tr>
        <td height="34" align="center" style="border:1px #000000 solid; border-top:none;">用水费用<br />
合计(元)</td>
        <td height="34" colspan="2" align="center" style="border:1px #000000 solid; border-top:none; border-left:none;">'.$billTemplateArray['total_water'].'</td>
        <td height="34" align="center" style="border:1px #000000 solid; border-left:none; border-top:none;">用电费用<br />
          合计(元)</td>
        <td height="34" colspan="2" align="center" style="border:1px #000000 solid; border-left:none; border-top:none;">'.$billTemplateArray['total_electric'].'</td>
        </tr>';

        if($billTemplateArray['other'])
        {
            foreach ($billTemplateArray['other'] as $ok=>$ov)
            {
                $otherInfoHtml .= '<tr><td height="34" colspan="4" align="center" style="border:1px #000000 solid; border-top:none;">'.$ok.'</td><td height="34" colspan="2" align="center" style="border:1px #000000 solid; border-left:none; border-top:none;">'.$ov.'</td></tr>';
            }
        }

        if($billTemplateArray['scale']<1)
        {

            $otherInfoHtml .='<tr><td height="45" colspan="4" align="center" style="border:1px #000000 solid; border-top:none;"><span style="font-weight:900; font-size:16px;">本月应缴水电费合计(分摊比例:'.float_to_percent($billTemplateArray['scale']).')：</span></td><td height="34" colspan="2" align="center" style="border:1px #000000 solid; border-left:none; border-top:none;font-weight:900;">'.$billTemplateArray['total_money'].'</td></tr>';

        }else{
            $otherInfoHtml .='<tr><td height="45" colspan="4" align="center" style="border:1px #000000 solid; border-top:none;"><span style="font-weight:900; font-size:16px;">本月应缴水电费合计：</span></td><td height="34" colspan="2" align="center" style="border:1px #000000 solid; border-left:none; border-top:none;font-weight:900;">'.$billTemplateArray['total_money'].'</td></tr>';

        }



        $otherInfoHtml .='</table>';


        //总结构


        $allHtml = $basicInfoShowHtml.$detailInfoHtml.$public_html.$otherInfoHtml;


        return $allHtml;
    }



    public function bulk_print_template($type,$usernum,$pigcms_id,$ym)
    {




        $endYear = date('Y',strtotime('+1 month',strtotime($ym)));

        $endMonth = date('m',strtotime('+1 month',strtotime($ym)));

        $userInfo = M('house_village_user_bind')->getByUsernum($usernum);

        //其他费用

        $other_array = M('house_village_user_paylist')->where(array('usernum'=>$usernum,'create_date'=>$ym))->find()['use_other'];


        $other_total_price=0;

        if($other_array!=''){

            $other_array = unserialize($other_array);

            foreach ($other_array as $sv){
                $other_total_price += $sv;
            }



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
                'set_start_time'=>$presonInfo[0]['set_start_time'],
                'set_end_time'=>$presonInfo[0]['set_end_time'],
                'end_year'=>$endYear,
                'end_month'=>$endMonth,
                'scale'=>$presonInfo[0]['original_room_data'][0]['scale']
            );


            $billTemplateArray['electric_public']  = 0;

            $billTemplateArray['water_public'] = 0;

            foreach ($meterWaterArray as $wk=>$wv){
                $meterWaterArray[$wk]['now_consume'] = round($wv['total_consume']-$wv['last_total_consume'],2)*$wv['rate'];

                $meterWaterArray[$wk]['now_rate'] = $wv['rate'];

                if ($wv['admin_defined_price'] > 0) {
                    $money = $wv['admin_defined_price'];
                } else {
                    $money = $wv['cost'];
                }

                $billTemplateArray['total_water'] += $money;

                if($wv['is_public'] == 1)
                {
                    $billTemplateArray['water_public'] +=  round($wv['cost'],2);
                }

            }


            $billTemplateArray['total_water'] = round($billTemplateArray['total_water'],2);

//            dump($meterElectricArray);exit;

            foreach ($meterElectricArray as $ek=>$ev){

                $meterElectricArray[$ek]['now_consume'] = round($ev['total_consume']-$ev['last_total_consume'],2)*$ev['rate'];

                $meterElectricArray[$ek]['now_rate'] = $ev['rate'];

                if ($ev['admin_defined_price'] > 0) {
                    $money = $ev['admin_defined_price'];
                } else {
                    $money = $ev['cost'];
                }

                $billTemplateArray['total_electric'] += $money;


                if($ev['is_public'] == 1)
                {
                    $billTemplateArray['electric_public'] +=  round($ev['cost'],2);
                }


            }


            $billTemplateArray['total_electric'] = round($billTemplateArray['total_electric'],2);

            $billTemplateArray['water']=$meterWaterArray;

            $billTemplateArray['electric']=$meterElectricArray;

            $billTemplateArray['total_money']=$billTemplateArray['total_electric']+$billTemplateArray['total_water']+$other_total_price;

            $billTemplateArray['other'] = $other_array;

            $html = $this->create_table($billTemplateArray);

            $data = array(
                'html'=>$html,
                'data'=>$billTemplateArray
            );

            return $data;


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


            return $billTemplateArray;

        }

        //vd($billTemplateArray);exit;

    }

    public function send_express() {
        $url = C('WEB_DOMAIN') . '/wap.php?g=Wap&c=PropertyService&a=send_express';
        $qr_url =  U('show_qr') . '&url=' . urlencode($url);
        $this->assign('url',$url);
        $this->assign('qr_url',$qr_url);
        $this->display();
    }



}