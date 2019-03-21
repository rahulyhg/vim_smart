<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/19
 * Time: 10:31
 */
class RoomAction extends BaseAction
{
    protected $village_id=4;
    public function __construct()
    {
        $this->village_id = session('system.village_id')?:4;
        parent::__construct();
        $this->admin_id=session('admin_id');
        $this->project_id=session('project_id');
    }

    /**测试****************************************************************************************************/
    /*************************************************************************************************************/

    public function test16(){
//        商铺1-4
//        4-2-3201
        $str = $_GET['str'];
        echo $str;
         preg_match("/(.*)-(\d{2}(?=\d{2})|\d{1}(?=\d{2}))(\d{0,2})/",$str,$matches);
         //\d{1}(?=\d{3})
         if(!$matches[3]){
             $matches[3] = $matches[2];
             $matches[2] = "1";
         }
        dump($matches);
    }

    public function test15(){

        if($_FILES){
            $model = new RoomModel();
            dump($_FILES);
            $file = $_FILES['test'];
            $data =  import_excel($file,'E',10);
             dump($data);
        }else{
            $this->display();
        }


    }


    public function test14(){
        $ym = $this->getLastYm(2018-01);
        $model = new RoomModel();
        $model->set_account_list_log($ym);
        dump($ym);
    }

    public function getLastYm($date){
        return date('Y-m', strtotime(date('Y-m', strtotime($date)) . ' -1 month '));
    }
    public function test13(){
        $msg_model = M('wxmsg','pigcms_');
        $msg_id = 94;
        $msg_info = $msg_model->where('id=%d',$msg_id)->find();
        //获取发送公司
        $msg_info['village_ids'] && $map['ub.village_id'] = array('eq',$msg_info['village_ids']);
        $msg_info['company_ids'] && $map['ub.company_id'] = array('eq',$msg_info['company_ids']);

        //获取用户

        $openids = M('user')->alias('u')
            ->field('u.openid')
            ->join('left join __HOUSE_VILLAGE_USER_BIND__ ub on u.uid = ub.uid')
            ->where($map)
            ->select(false);

        dump($map);
        dump($openids);exit();
    }



    public function test12(){
        $connect = new Memcached;  //声明一个新的memcached链接
        $connect->setOption(Memcached::OPT_COMPRESSION, false); //关闭压缩功能
        $connect->setOption(Memcached::OPT_BINARY_PROTOCOL, true); //使用binary二进制协议
        $connect->addServer('f120e580f9b74ec5.m.cnhzaliqshpub001.ocs.aliyuncs.com', 11211); //添加OCS实例地址及端口号
        dump(unserialize($connect->get("update_meter_date")));
    }

    public function test11(){
        $connect = new Memcached;  //声明一个新的memcached链接
        $connect->setOption(Memcached::OPT_COMPRESSION, false); //关闭压缩功能
        $connect->setOption(Memcached::OPT_BINARY_PROTOCOL, true); //使用binary二进制协议
        $connect->addServer('f120e580f9b74ec5.m.cnhzaliqshpub001.ocs.aliyuncs.com', 11211); //添加OCS实例地址及端口号
        $arr = array();
        $date = date("Y-m-d");
        for($i = 1 ;$i<13;$i++){
            $arr[] = date('Y-m-d', strtotime(date('Y-m-01', strtotime($date)) . ' +'.$i.' month '));
        }
        $connect->set("update_meter_date",serialize($arr));
        dump(unserialize($connect->get("update_meter_date")));

    }
    public function test8(){
        $model = new WechatModel();
       // $data =  {"media":'@Path\filename.jpg'}
        dump(__DIR__);
        $file = '/u02/vhi99/vhi_smart/Car/Admin/Public/assets/layouts/layout4/img/avatar9.jpg';
        $re = is_file($file);
        dump($re);
        $data = array('media'=>'@'.$file);
        $re = $model->wechat->uploadImg($data);
        dump($re);
    }

    public function test9(){
        dump($_SESSION);
        session(null);
        echo "清空session";
        dump($_SESSION);
    }

    public function test10(){
        dump($_SESSION);
    }

    /**
     * 测试
     */
    public function test7(){
        $model = new RoomModel();
        $model->get_custom_info('5413e5fafa0016d27ed6ec0bd7eb15f0',3);
    }


    public function test6(){
        $uid = 440;
        $role_id = user_info($uid)['role_id'];
        $allow_menus = M('role','pigcms_')->where('role_id=%d',$role_id)->getField('menus');
        $allow_menus_arr = explode(',',$allow_menus);
        dump($allow_menus_arr);
    }


    public function test5(){
        $last = date("Y-m",strtotime("-1 month"));
        dump($last);
    }

    public function test(){
        $model = new RoomModel();
        dump($model->preview_list());
    }
    public function test1(){
        $str = "0ef89b1b28ca61c69fda2669ef015937,16069d4bc7c2ff8c75707e0803586108,24cd88c4dd7fc382eb0b419260302fc8,25736c366a4d8913aeb5e45a1f198e72,2867cca151d09594638a4fdfc1fd9d2e,296e9b80c8dbac23c8a77fae739803f1,2aa7af27ad0fd41252fd1795cabbcf4b,335bdf8ab3dd3c29e1f2f2f22ca9d08d,33aa3204c1142b8f803565d9fb8e9bb8,353f236fe81473f673ca0d88e643c63b,369c86f5159b379ecc6ebecf7b03da7e,4bae834aaf28b09428686437da67d5ca,4e3d5ef2a0edb7561207eebb28500919,591d16fdc126e475676da3ea911c5af3,5b4723972ab8ad5e0f1b48b73f841140,5dfa6f80c6e7f269d6488ddb807015b2,5f430cc0b4a3e3cef74df986241b9043,77809f721b4aa57f588a45758b125dfa,78625c0a2f35522541e6f0ff9cb72569,79ed9d59cff662ee58f427b895fa4eb2,7c7882e76ce415037b3c0f8cbdb047b0,7c988e55eb0c78a53814636bb683ddf5,7e946ed3d41a4e3f323f1b1ed2693486,8ee44077f3d0854a06a657609c5281e5,90658a783c1192ae6778d6c82a5b0cb0,9a92d7dddf73b107264d66d782943245,a39606a84ee7f188acd57f401199b305,b31971f5cb6714b7100ebcc1c17868ca,b32dde5e34c271e95b61e7e9e29acac9,b651a47322cc806747f3b301f5af48b2,b6e8523d930ad3360906d67875fa6d48,c8bb005ba939354d6b9acbf2d5fc8c5c,cede1aae0bf5757c4f1198e7268e4000,d636cda5f2b95f8878d8e8fc99c44d7f,d8e9d6dc098f3bcaf80496259e4c5e65,dcc68efa4f82c4d811779f4a5aed5821,e881f28a58b2d8b2fc7f2b5497b4560a,ea45cb4036b93c36cda76064703ee7e1,ede4313e6984c3f98a5b39e93033c4ad,f051e7f84c78d82290d764a2a66e462a,f50556176bea3703e48643aca0e9e4f3,f7ca2e545782b5ccd3768d952533677f,f9cac6310aaf0b1cbc4c7f08d9eb1078,fcda3fa916a51fcc0b4fb5787cbf8474,fd468de4d48568930c87919febf3e4ee";
        dump($str);
        dump(del_set('16069d4bc7c2ff8c75707e0803586108',$str));
        dump(add_set('16069d4bc7c2ff8c75707e0803586108',$str));
    }
    public function test2(){
        $a1 = '1,2,4,9';
        $a2 = '3,5,6,4,4,8';
        $str = del_set($a2,$a1);
        $str2 = add_set($a2,$a1);
        dump($str);
        dump($str2);

    }
    public function test3(){
        $model = new RoomModel();
        $data = $model->field('meter_hash,id')->select();
        echo mysql_error();
        foreach($data as &$row){
            $row['meter_hash'] = explode(',',$row['meter_hash']);
            foreach($row['meter_hash'] as $rr){
                if(strlen($rr)!=32){
                    $row['error'] = 1;
                }
            }
        }
        dump($data);
    }

    public function test_account_log(){
        $model = new RoomModel();
        $data = $model->get_account_list_log(1251,0,'2017-11');
        dump($data);
    }

    /**房間****************************************************************************************************/
    /*************************************************************************************************************/
    public function _before_roomlist_news(){
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


    /**
     * 房间列表
     */
    public function roomlist_news(){
        //导航设置
        $breadcrumb_diy = array(
            array('物业服务','#'),
            array('单元管理','#'),
        );
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $model = new RoomModel();
        $village_id = filter_village(0,2);
        $list = $model->get_room_list(0,$village_id);
        foreach($list as &$row){
            $row['ownernames'] = join('<br />',explode(',',$row['ownernames']));
        }
        $this->assign('list',$list);
        $this->assign('village_list',$model->get_village_list());
        $this->display();
    }

    /**
     * 房间绑定设备弹出层
     * @param $room_id
     */
    public function modal_room_bind_meter($room_id){
        $model = new RoomModel();
        $room_info = $model->get_room_info($room_id);
        $this->assign('modal_title',$room_info['floor_name'] . '-' . $room_info['room_name']);
        $this->display();
    }



    /**业主****************************************************************************************************/
    /*************************************************************************************************************/


    public function _before_ownerlist_news(){
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

    /**
     * 业主导入
     */
    public function owner_import_step1(){
        //导航设置
        $breadcrumb_diy = array(
            array('物业服务','#'),
            array('业主列表',U('ownerlist_news')),
            array('批量导入','#'),
        );
        $model = new RoomModel();
        $this->assign('village_list',$model->get_village_list());
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $this->display();
    }

    /**
     * 业主导入 小区
     * @author zhukeqin
     */
    public function owner_uptown_import_step1(){
        //导航设置
        $breadcrumb_diy = array(
            array('物业服务','#'),
            array('业主列表',U('ownerlist_uptown_news')),
            array('批量导入','#'),
        );
        $model = new RoomModel();
            $village_list=$model->get_village_list(array('village_id'=>$this->village_id));
        $project_list=M('house_village_project')->where('village_id='.$this->village_id)->select();
        $project_info=M('house_village_project')->where(array('pigcms_id'=>$this->project_id))->find();
        $this->assign('project_info',$project_info);
        $this->assign('project_list',$project_list);
        $this->assign('village_list',$village_list);
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $this->display();
    }
    public function owner_import_step2(){
        //导航设置
        $breadcrumb_diy = array(
            array('物业服务','#'),
            array('业主列表',U('ownerlist_news')),
            array('批量导入','#'),
        );
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        //获取社区名
        $model = new RoomModel();
        $file = $_FILES['test'];
        $village_id = I('post.village_id');
        $village_name = $model->get_village_list()[$village_id];

        if($file){
            //导入数据
            $list = $model->owner_excel_to_data($file,$village_id);
            $this->assign_json('list',$list);
            $this->assign_json('selected_village_id',$village_id);
            $this->assign_json('selected_village_name',$village_name);
            $this->assign('selected_village_name',$village_name);
            $this->display();
        }else{
            $this->error("文件格式错误",U('owner_import_step1'));
        }

    }
    public function owner_uptown_import_step2(){
        //导航设置
        $breadcrumb_diy = array(
            array('物业服务','#'),
            array('业主列表',U('ownerlist_news')),
            array('批量导入','#'),
        );
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        //获取社区名
        $model = new RoomModel();
        $file = $_FILES['test'];
        $village_id = $this->village_id;

        $village_name = $model->get_village_list()[$village_id];

        if($file){
            $project_id=$this->project_id;
            if(empty($project_id)){
                $this->error("请选择园区",U('owner_uptown_import_step1'));
            }
            //导入数据
            $list = $model->owner_uptown_excel_to_data($file,$village_id,$project_id);
            $this->assign_json('list',$list);
            $this->assign_json('selected_village_id',$village_id);
            $this->assign_json('selected_village_name',$village_name);
            $this->assign('selected_village_name',$village_name);
            $this->success("导入成功",U('ownerlist_updown_news'));
            //$this->display();
        }else{
            $this->error("文件格式错误",U('owner_uptown_import_step1'));
        }

    }

    /**
     * 物业信息初始化  用于导入
     * @author zhukeqin
     */
    public function owner_uptown_import_update_step1(){
        //导航设置
        $breadcrumb_diy = array(
            array('物业服务','#'),
            array('业主列表',U('ownerlist_uptown_news')),
            array('批量更新导入','#'),
        );
        $model = new RoomModel();
        $village_list=$model->get_village_list(array('village_id'=>$this->village_id));
        $project_list=M('house_village_project')->where('village_id='.$this->village_id)->select();
        $otherfee_type_list=M('house_village_otherfee_type')->where(array('village_id'=>$this->village_id))->select();
        $fee_type=M('house_village_otherfee_type')->where('village_id='.$this->village_id)->select();
        $fee_type[]=array('otherfee_type_id'=>'property','otherfee_type_name'=>'物业服务费');
        $fee_type[]=array('otherfee_type_id'=>'carspace','otherfee_type_name'=>'包月泊车费');
        $this->assign('otherfee_type_list',$otherfee_type_list);
        $this->assign('fee_type',$fee_type);
        $this->assign('project_list',$project_list);
        $this->assign('village_list',$village_list);
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $this->display();
    }
    public function owner_uptown_import_update_step2(){
        //导航设置
        $breadcrumb_diy = array(
            array('物业服务','#'),
            array('业主列表',U('ownerlist_news')),
            array('批量导入','#'),
        );
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        //获取社区名
        $model = new RoomModel();
        $file = $_FILES['test'];
        $village_id = $this->village_id;

        $village_name = $model->get_village_list()[$village_id];

        if($file){
            $project_id=I('post.project_id');
            if(empty($project_id)){
                $this->error("请选择园区",U('owner_uptown_import_step1'));
            }
            $fee_lastyear_id=I('post.fee_lastyear_id');
            $year=I('post.year');
            //导入数据
            $list = $model->owner_uptown_excel_to_update_data($file,$village_id,$project_id,$fee_lastyear_id,$year);
            $this->assign_json('list',$list);
            $this->assign_json('selected_village_id',$village_id);
            $this->assign_json('selected_village_name',$village_name);
            $this->assign('selected_village_name',$village_name);
            $this->success("导入成功",U('ownerlist_updown_news'));
            //$this->display();
        }else{
            $this->error("文件格式错误",U('owner_uptown_import_step1'));
        }

    }
    //异步检查该条数据是否导入过
    public function check_hash(){
        $model = new RoomModel();
        $village_id = I('get.village_id',0);
        $item = I('get.item');
        $room_hash = $model->create_room_hash(
            $village_id,
            $item['tung_unit'],
            $item['floor_name'],
            $item['room_name']
        );
        $count = $model->where('room_hash="%s"',$room_hash)->count();
        $this->success("测试","",$count);
    }

    /**
     * 第三部导入数据
     */
    public function owner_import_step3(){
        $data = $_POST;
        $data['data'] = json_decode(htmlspecialchars_decode($data['data']),true);
        $model = new RoomModel();
        $re = $model->insert_owner_data_to_database($data['data'],$data['village_id']);
        if($re){
            $this->success("操作成功","",$data);
        }else{
            $error = $model->get_import_error();
            $this->error($error['msg'],"",$error['data']);
        }

    }

    /**
     * 业主列表
     */
    public function ownerlist_news(){
        //导航设置
        $breadcrumb_diy = array(
            array('物业服务','#'),
            array('业主列表','#'),
        );
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $this->html_option('table_init_length',-1);
        $this->html_option('table_sort',array(2,'asc'));


        $model = new RoomModel();
        $village_id =  filter_village(0,2);
        //vd($village_id);exit;
        //判断是否是小区，进行跳转 by zhukeqin
        if(M('house_village')->where('village_id='.$village_id)->find()['village_type']==1){
           header('Location:'.U('ownerlist_updown_news'));
        }
        $ownerlist = $model->ownerlist($village_id);

        //vd($ownerlist);exit();
        $this->assign('list',$ownerlist);
        $fstatus_list = $model->get_fstatus_list();
        $this->assign('fstatus_list',$fstatus_list);
        $this->display();
    }
    /**
     * 业主列表 小区版本
     * @author zhukeqin
     */
    public function ownerlist_updown_news()
    {
        //导航设置
        $breadcrumb_diy = array(
            array('物业服务','#'),
            array('业主列表','#'),
        );
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $this->html_option('table_init_length',-1);
        $this->html_option('table_sort',array(2,'asc'));

        //设置权限
        $role_id = $_SESSION['system']['role_id'];
        // var_dump($admin);
        $role_idArr = explode(',',$role_id);
        if (in_array(78, $role_idArr)) {
            $this->assign('role_id',1);
        }

        $model = new RoomModel();
        $village_id =  filter_village(0,2);
        //$ownerlist = $model->ownerlist_updown($village_id);

        //vd($ownerlist);exit();
        $this->assign('list',$ownerlist);
        /*$fstatus_list = $model->get_fstatus_list();
        $this->assign('fstatus_list',$fstatus_list);*/
        $this->display();
    }

    /**
     * @author zhukeqin
     * ajax获取业主数据
     */
    public function ajax_ownerlist_updown(){
        $village_id =  filter_village(0,2);
        $project_id=$_SESSION['project_id'];
        //设置权限
        $role_id = $_SESSION['system']['role_id'];
        $role_idArr = explode(',',$role_id);
        if (in_array(78, $role_idArr)) {
            $role_id=1;
        }
        $start=I('post.start');
        $length=I('post.length');
        //datatable适配  -1则代表显示全部信息
        if($length==-1){
            unset($length);
        }
        $model = M('house_village_user_bind');
        $where_all=$where=array('village_id'=>array('eq',$village_id));
        if(!empty($_POST['search']['value'])){
            $where['usernum|phone|name']=array('like',$_POST['search']['value']);
        }
        //主查询
        if(!empty($length)){
            $list = $model
                ->where($where)
                ->limit($start,$length)
                ->select();
        }else{
            $list = $model
                ->where($where)
                ->select();
        }
        $list_dimcount=$model
            ->where($where)
            ->count();
        $list_count= $model
            ->where($where_all)
            ->count();
        //dump(M()->_sql());exit;
        foreach ($list as $value){
            $array=array(
                'check_id'=>'<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input type="checkbox" class="checkboxes" value="'.$value['id'].'"><span></span></label>',
                'pigcms_id'=>$value['pigcms_id'],
                'name'=>$value['name'],
                'phone'=>$value['phone'],
                'usernum'=>$value['usernum'],
                'action'=>''
            );
            if($role_id==1){
                $array['action']='<div class="btn-group">
                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-left" role="menu" style="position:relative;">

                        <li>
                            <a href="'.U('edit_owner_uptown',array('id'=>$value['pigcms_id'])).'">
                                <i class="icon-tag"></i> 编辑 </a>
                        </li>
                        <li>
                            <a href="'.U('del_owner_uptown',array('id'=>$value['pigcms_id'])).'" onclick="return window.confirm(\'删除后不可恢复！确认删除？\')">
                                <i class="icon-tag"></i> 删除 </a>
                        </li>
                    </ul>
                </div>';
            }else{
                $array['action']='<div class="btn-group">
                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-left" role="menu" style="position:relative;">

                    </ul>
                </div>';
            }
            $list_reload[]=$array;

        }
        if(empty($list_reload)){
            $list_reload=array();
        }
        $result_array=array(
            'draw'=>intval(I('post.draw')),
            'recordsTotal'=>$list_count,
            'recordsFiltered'=>$list_dimcount,
            'data'=>$list_reload
        );
        echo json_encode($result_array);
    }
    /**
     * 业主绑定房间弹出层
     * @param $oid
     */
    public function modal_owner_bind_room($oid){
        $model = new RoomModel();
        $this->assign_json('room_list',$model->get_room_list());//单元列表
        $this->assign_json('village_list',$model->get_village_list());//社区
        $ownerinfo = $model->ownerinfo($oid);
        $this->assign('oid',$oid);//业主ID
        $this->assign('modal_title',"业主绑定单元-" .$ownerinfo['ownername'] . "($oid)");
        $this->display();
    }


    /**
     * 业主绑定房间弹出层(针对小区)
     * @param $oid
     */
    public function modal_owner_bind_room_sq($oid){
        $map['village_id'] = array('eq',$this->village_id);
        $map['fid'] = array('neq',0);
        $list = D('house_village_room')->where($map)->select();
        foreach ($list as &$v) {
            $v['bind_status'] = 0;
            $oidArr = explode(',',$v['oid']);
            if ($oidArr) {
                if (in_array($oid,$oidArr)) {
                    $v['bind_status'] = 1;
                }
            }
            $v['r_name'] = $v['room_name'].'('.$v['desc'].')';
        }
        unset($v);
        $this->assign('list',$list);//业主ID
        $this->assign('oid',$oid);//业主ID
        $this->display();
    }

    /**
     * 小区业主绑定ajax方法提供
     */
    public function modal_owner_bind_room_sq_ajax() {
        $oid = $_GET['oid'];
        $search = $_GET['search'];
        $map['village_id'] = array('eq',$this->village_id);
        $map['fid'] = array('neq',0);
        $map['room_name|desc'] = array('like','%'.$search.'%');
        $list = D('house_village_room')->where($map)->select();
        foreach ($list as &$v) {
            $v['bind_status'] = 0;
            $oidArr = explode(',',$v['oid']);
            if ($oidArr) {
                if (in_array($oid,$oidArr)) {
                    $v['bind_status'] = 1;
                }
            }
            $v['r_name'] = $v['room_name'].'('.$v['desc'].')';
        }
        unset($v);

        if ($list) {
            $str = '';
            foreach ($list as $v) {
                $r_name = $v['r_name'];
                $id = $v['id'];
                $str .= "<tr>
                    <td>$r_name</td>
                    <td>";
                if ($v['bind_status'] == 0) {
                    $str .= "<button class=\"btn btn-default btn-sm\" onclick=\"bind($id,this)\">绑定</button>";
                } else {
                    $str .= "<button class=\"btn btn-danger btn-sm\"  onclick=\"unbind($id,this)\">解绑</button>";
                }
                $str .= '</td>
                </tr>';
            }

            echo $str;
        }

    }

    /**
     * 小区业主绑定房间执行
     * @param $id
     * @param $oid
     */
    public function modal_room_ajax_bind() {
        $id = $_GET['id'];//房间ID
        $oid = $_GET['oid'];//业主ID
        $list = D('house_village_room')->where(array('id'=>$id))->find();
        $oidStr = $oid;//准备插入oid字段数据
        if ($list['oid']) {
            $oidStr = $list['oid'].','.$oid;
        }

        $re = D('house_village_room')->where(array('id'=>$id))->save(array('oid'=>$oidStr));
        if ($re) {
            echo 1;
        } else {
            echo 2;
        }

    }


    /**
     * 小区业主解绑房间执行
     * @param $id
     * @param $oid
     */
    public function modal_room_ajax_unbind() {
        $id = $_GET['id'];//房间ID
        $oid = $_GET['oid'];//业主ID
        $list = D('house_village_room')->where(array('id'=>$id))->find();
        $oidArr = explode(',',$list['oid']);
        foreach ($oidArr as $k => $v) {
            if ($oid == $v) {
                unset($oidArr[$k]);
            }
        }
        $oidStr = implode(',',$oidArr);

        $re = D('house_village_room')->where(array('id'=>$id))->save(array('oid'=>$oidStr));
        if ($re) {
            echo 1;
        } else {
            echo 2;
        }

    }

    /**
     * 业主绑定房间执行
     * @param $room_id
     * @param $oid
     */
    public function owner_bind_room_act($room_id,$oid){
        $model = new RoomModel();
        $re = $model->owner_bind_room($room_id,$oid);
        if($re!==false){
            $this->success("成功","",$model->get_room_info($room_id));
        }else{
            $this->error(mysql_error(),"",$_GET);
        }
    }

    /**
     * 业主解绑房间执行
     * @param $room_id
     * @param $oid
     */
    public function owner_unbind_room_act($room_id,$oid){
        $model = new RoomModel();
        $re = $model->owner_unbind_room($room_id,$oid);
        if($re!==false){
            $this->success("成功","",$model->get_room_info($room_id));
        }else{
            $this->error(mysql_error(),"",$_GET);
        }
    }

    /**
     * 添加业主页面
     */
    public function add_owner(){
        //导航设置
        $breadcrumb_diy = array(
            array('物业服务','#'),
            array('业主列表','#'),
            array('添加业主','#'),
        );

        $model = new RoomModel();
        $this->assign_json('room_list',$room_list = $model->get_room_list());//单元列表
        $this->assign_json('room_tree',list_to_tree($room_list,'id','fid'));//单元列表_树形结构
        $this->assign_json('village_list',$model->get_village_list());//社区
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $this->display();
    }

    /**
     * 添加业主执行
     */
    public function add_owner_act(){
        //向owner表添加数据
        $data = $_POST;
        $num = $model = M('house_village_owner')->add($data);
        if($num){
            $model = new RoomModel();
            //绑定房间操作
            $re = $model->owner_bind_room_batch($data['room_ids'],$num);
            $this->success("添加成功",U('ownerlist_news'));
        }else{
            $this->error("添加失败");
        }

    }

    /**
     * 业主编辑
     */
    public function edit_owner(){
        //导航设置
        $breadcrumb_diy = array(
            array('物业服务','#'),
            array('业主列表','#'),
            array('编辑业主','#'),
        );
        $model = new RoomModel();
        $this->assign('info',$model->ownerinfo(I('get.oid')));
        $this->assign_json('room_list',$room_list = $model->get_room_list());//单元列表
        $this->assign_json('room_tree',list_to_tree($room_list,'id','fid'));//单元列表_树形结构
        $this->assign_json('village_list',$model->get_village_list());//社区
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $this->display('add_owner');
    }

    /**
     * 业主编辑执行
     */
    public function edit_owner_act(){
        //向owner表添加数据
        $data = $_POST;
        $re = $model = M('house_village_owner')->where('id=%d',$data['oid'])->save($data);
        if($re!==false){
            $model = new RoomModel();
            //绑定房间操作
            $re = $model->owner_bind_room_batch($data['room_ids'],$data['oid']);
            $this->success("修改成功",U('ownerlist_news'));
        }else{
            $this->error("添加失败");
        }
    }

    public function del_owner_act($oid){
        $re = M('house_village_owner')->where('id=%d',$oid)->delete();
        if($re!==false){
            $this->success("删除成功");
        }else{
            $this->error("删除失败");
        }
    }

    /**
     * @author zhukeqin
     * 小区业主信息修改
     */
    public function edit_owner_uptown(){
        if(IS_POST){
            $data=array(
                'usernum'=>$_POST['usernum'],
                'phone'=>$_POST['phone'],
                'name'=>$_POST['name'],
            );
            $re=M('house_village_user_bind')->where(array('pigcms_id'=>$_GET['id']))->data($data)->save();
            if($re){
                $this->success("修改成功",U('ownerlist_updown_news'));
            }else{
                $this->error("修改失败");
            }
        }else{
            $owner_info=M('house_village_user_bind')->where(array('pigcms_id'=>$_GET['id']))->find();
            $this->assign('owner_info',$owner_info);
            $this->display();
        }
    }

    /**
     * @author zhukeqin
     * 小区业主信息删除
     */
    public function del_owner_uptown(){
        $re = M('house_village_user_bind')->where('pigcms_id=%d',$_GET['id'])->delete();
        if($re!==false){
            $this->success("删除成功");
        }else{
            $this->error("删除失败");
        }
    }
    /**入住单位****************************************************************************************************/
    /*************************************************************************************************************/
    public function _before_tenantlist_news(){
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


    /**
     * 付款前选择如何支付
     */
    public function before_pay($pid){

        $model = new RoomModel();

        $ym = I('get.ym');

        if($ym){
            $payListInfo = $model->true_bill_list($ym,0,$pid)[0];
        }else{
            $payListInfo = $model->true_bill_list('',0,$pid)[0];
        }

        //vd($payListInfo);exit;


        $payListInfo['total_price_true'] = round($payListInfo['total_water']+$payListInfo['total_electric']+$payListInfo['total_property']+$payListInfo['total_other'],2);
        $payListInfo['total_price'] = round($payListInfo['water_price']+$payListInfo['electric_price']+$payListInfo['property_price']+$payListInfo['other_price'],2);
        $this->assign('payListInfo',$payListInfo);
        $this->display();
    }

    /**
     * 入住单位列表
     */
    public function tenantlist_news(){
        $village_id =  filter_village(0,2);
        //判断是否是小区，进行跳转 by zhukeqin
        if(M('house_village')->where('village_id='.$village_id)->find()['village_type']==1){
            header('Location:'.U('Property/month'));
        }
        //get.mod可能的值：property,user
        $ym = I('get.ym');


        $_mod = I('get._mod','property');
        //租户是否已经迁出
        $_out = I('get._out',0,'intval');
        //导航设置
        switch ($_mod){
            case 'property':
                $breadcrumb_diy = array( array('物业服务','#'), array('物业缴费','#') );
                break;
            case 'user':
                $breadcrumb_diy = array( array('用户管理','#'), array($_out?'已迁出单位':'入住单位','#') );
                break;
        }
        $this->assign('breadcrumb_diy',$breadcrumb_diy);




        $this->html_option('table_init_length',-1);
        $this->html_option('table_sort',array(1,'asc'));
        $model = new RoomModel();

        $village_id = filter_village(0,2);
//        echo '<hr style="height:500px"/>' ;dump($village_id);
        if($ym){
            $tenantlist = $model->tenantlist($ym,$village_id);
        }else{
            $tenantlist = $model->tenantlist("",$village_id);
        }



       foreach($tenantlist as $key=> &$row){
            $row['room_names'] = $model->format_room_str($row['room_names'],'<br />');

            $row['is_out'] = boolval($row['rinfo']);
            //用户管理模块需要进行数据过滤，迁出单位
            if($_mod==="user"&&$row['is_out']===boolval($_out)){
                unset($tenantlist[$key]);
            }
            //物业缴费模块进行过滤 去掉迁出单位
            if($_mod == "property"&&$row['is_out'] == false){
                unset($tenantlist[$key]);
            }

       }
       unset($row);


        //过滤
       $model->filterlist_by_tid($tenantlist);
        $this->assign('list',$tenantlist);
        //获取入住状态
        $fstatus_list = $model->get_fstatus_list();
        $this->assign('fstatus_list',$fstatus_list);
        $this->assign_json('fstatus_list',$fstatus_list);
        $this->assign('_mod',$_mod);
        $this->assign('_out',$_out);
        $this->display();
    }

    /**
     * 用户管理模块下的下入住单位列表
     */
    public function tenantlist_for_usermodel_news(){
        $param = $_GET;
        $this->redirect('tenantlist_news',array_merge($param,array('_mod'=>'user')));
    }


    /**
     * 入驻单位房间列表弹出成
     */
    public function modal_tenant_rooms($tid){
        $model = new RoomModel();
        $tenantinfo = $model->preview_list($tid,$this->village_id)[0];
        //dump($tenantinfo);
        $this->assign('tid',$tid);//业主ID
        $this->assign_json('tenantinfo',$tenantinfo);
        $this->assign('modal_title',"入住单位房间列表-" .$tenantinfo['tenantname'] . "($tid)");
        $this->display();
    }

    /**
     * 入住单位绑定房间弹出层
     * @param $tid
     */
    public function modal_tenant_bind_room($tid){
        $model = new RoomModel();
        $this->assign_json('room_list',$model->get_room_list());//单元列表
        $this->assign_json('village_list',$model->get_village_list());//社区
        $tenantinfo = $model->tenantinfo($tid);
        $this->assign('tid',$tid);//业主ID
        $this->assign('modal_title',"入住单位绑定单元-" .$tenantinfo['tenantname'] . "($tid)");
        $this->display();
    }

    /**
     * 入住单位绑定房间执行
     * @param $room_id
     * @param $tid
     */
    public function tenant_bind_room_act($room_id,$tid){
        $model = new RoomModel();
        $re = $model->tenant_bind_room($room_id,$tid);
        if($re!==false){
            $this->success("成功","",$model->get_room_info($room_id));
        }else{
            $this->error(mysql_error(),"",$_GET);
        }
    }

    /**
     * 入住单位解绑房间执行
     * @param $room_id
     * @param $tid
     */
    public function tenant_unbind_room_act($room_id,$tid){
        $model = new RoomModel();
        $re = $model->tenant_unbind_room($room_id,$tid);
        if($re!==false){
            $this->success("成功","",$model->get_room_info($room_id));
        }else{
            $this->error(mysql_error(),"",$_GET);
        }
    }

    /**
     * 入住单位绑定设备弹出层
     * @param $tid
     */
    public function modal_tenant_bind_meter($tid){
        $model = new RoomModel();
        $tenantinfo = $model->tenantinfo($tid);

        //租户未绑定房间，不能进行设备绑定
        $tenant_rooms_count = M('house_village_room')->where('tid=%d',$tid)->count();
        if(!$tenant_rooms_count){
            echo '<h4 style="text-align: center;padding: 10px">该入驻单位（'.$tenantinfo['tenantname'].'）未绑定房间，不能进行设备绑定</h4>';exit();
        }

        $floor_list = $model->floor_list(); //楼层
        $meter_list = $model->meterlist_for_tenant("",$this->village_id);//设备

        $meter_type_list = $model->get_meter_type_list();//设备类型列表
        $village_list = $model->get_village_list();//社区列表



        $this->assign('floor_list',$floor_list);

        $this->assign_json('meter_type_list',$meter_type_list);
        $this->assign_json('floor_list',$floor_list);
        $this->assign_json('meter_list',$meter_list);
        $this->assign_json('village_list',$village_list);

        $this->assign('tid',$tid);//业主ID
        $this->assign('tenantinfo',$tenantinfo);//业主信息
        $this->assign('modal_title',"入住单位绑定设备-" .$tenantinfo['tenantname'] . "($tid)");
        $this->display();
    }

    /**
     * 入住单位绑定设备执行
     * @param $tid
     * @param $meter_hash
     */
    public function tenant_bind_meter_act($meter_hash,$tid){
        $model = new RoomModel();
        $re = $model->tenant_bind_meter($meter_hash,$tid);
        $meter_info = $model->meterinfo_for_tenant($meter_hash,$this->village_id);
        if($re){
            $this->success("成功","",$meter_info);
        }else{
            $this->error("失败","",$meter_info);
        }

    }
    /**
     * 入住单位解绑设备执行
     * @param $tid
     * @param $meter_hash
     */
    public function tenant_unbind_meter_act($tid,$meter_hash){
        $model = new RoomModel();
        $re = $model->tenant_unbind_meter($meter_hash,$tid);
        $meter_info = $model->meterinfo_for_tenant($meter_hash,$this->village_id);
        if($re){
            $this->success("成功","",$meter_info);
        }else{
            $this->error("失败","",$meter_info);
        }
    }

    
    /**
     * 入住单位设备弹出层
     * @param $tid
     */
    public function modal_tenant_meters($tid){
        $model = new RoomModel();
        $tenantinfo = $model->preview_list($tid)[0];
        $this->assign_json('tenantinfo',$tenantinfo);
        $meter_type_list = $model->get_meter_type_list();
        $price_type_list = $model->get_price_type_list();
        $this->assign_json('meter_type_list',$meter_type_list);
        $this->assign_json('price_type_list',$price_type_list);
        $this->assign('modal_title',"入住单位拥有的设备-" .$tenantinfo['tenantname'] . "($tid)");
        $this->assign('tid',$tid);
        $this->display();
    }

    /**
     * 入住单位配置设备弹出层
     */
    public function modal_tenant_meter_setting($tid,$meter_hash){
        $model = new RoomModel();
        $tenantinfo = $model->preview_list($tid)[0];
        $_meter_info = array();
        foreach ($tenantinfo['room_data'] as $meter_type_id=>$meter_list){
            foreach($meter_list as $_meter_hash => $meter_info){
                if($meter_hash == $_meter_hash ){
                    $_meter_info = $meter_info;
                    break;
                }
            }
        }

        $meter_type_list = $model->get_meter_type_list();
        $price_type_list = $model->get_price_type_list($_meter_info['meter_type_id'],$this->village_id);
        foreach ($price_type_list as $k=>&$v){
            $get=M('re_setmeter_config')->where('id='.$k)->find();
            $v=$get;
        }
        $this->assign_json("meter_info",$_meter_info);
        $this->assign_json("meter_type_list",$meter_type_list);
        $this->assign_json("price_type_list",$price_type_list);
        $this->assign('modal_title',"计费配置-"
            .$tenantinfo['tenantname'] . "($tid)|"
            .$_meter_info['meter_code'] . "($_meter_info[meter_hash])");
        $this->display();
    }

    /**
     * 入住单位配置设备保存执行
     */
    public function save_tenant_meter_setting_act(){
        $meter_info = json_decode(htmlspecialchars_decode(file_get_contents('php://input')),true);
        $meter_info['tts'] = $meter_info['scale'];
        $re = M('house_village_tenant_scale')->add($meter_info,array(),true);
        if($re!==false){
            //修改表类型
            if($meter_info['meter_hash']){
                $re2 = M('house_village_meters')
                    ->where('meter_hash="%s"',$meter_info['meter_hash'])
                    ->setField('price_type_id',$meter_info['price_type_id']);
            }
            $this->success('成功','',$meter_info);
        }else{
            $this->success('失败','',$meter_info);
        }

    }


    /**
     * 入驻单位编辑
     */
    public function tenant_edit($tid){
        $roomOb = new RoomModel();
        $list = $roomOb->preview_list($tid)[0];
        $list['village_name'] = M('house_village')->getFieldByVillage_id($list['village_id'],'village_name');
        $owneInfo = M('house_village_owner')->find($list['oid']);
        $list['contract_start'] = $owneInfo['contract_start'];
        $list['contract_end'] = $owneInfo['contract_end'];
        $list['property_start'] = $owneInfo['property_start'];
        //vd($list);exit;
        $this->assign('list',$list);
        $this->assign_json('fstatus_list',$roomOb->get_fstatus_list());
        $this->display();
    }


    /**
     * 编辑房间/租户
     */
    public function edit_this(){
        $id = I('post.id');
        $field = I('post.field');
        $value= I('post.value');
        $type=I('post.type');
        if(!isset($id)||empty($id)) exit();
        if($type==0){
            $res = M('house_village_user_bind')->where(array('usernum'=>array('eq',$id)))->data(array($field=>$value))->save();
        }else{
            $res = M('house_village_room')->where(array('id'=>array('eq',$id)))->data(array($field=>$value))->save();
        }
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }


    /**
     * 添加租户表单
     */
    public function add_tenant(){
        //导航设置
        $breadcrumb_diy = array(
            array('物业服务','#'),
            array('物业缴费',U('tenantlist_news')),
            array('添加租户','#'),
        );
        $model = new RoomModel();
        //获取所有业主信息
        $this->assign_json('owner_list',$owner_list = $model->ownerlist());//业主
        //echo M()->getLastSql();exit();
        $this->assign_json('village_list',$model->get_village_list());//社区
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $this->display();
    }

    /**
     * 添加租户执行
     */
    public function add_tenant_act(){

        $model = new  RoomModel();
        $num = $model->add_tenant();
        if($num){
            $this->success("添加成功",U('tenantlist_news'));
        }else{
            $this->error("失败");
        }
    }

    /**
     * 编辑租户表单
     */
    public function edit_tenant(){
        //导航设置
        $breadcrumb_diy = array(
            array('物业服务','#'),
            array('物业缴费',U('tenantlist_news')),
            array('编辑租户','#'),
        );
        $model = new RoomModel();
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $this->display();
    }

    /**
     * 编辑租户执行
     */
    public function edit_tenant_act(){
        dump($_POST);
    }


    public function del_tenant_act($tid){
        $re = M('house_village_user_bind')->where('pigcms_id=%d',$tid)->delete();
        if($re!==false){
            $this->success("删除成功");
        }else{
            $this->error("发生错误");
        }
    }

    /**设备****************************************************************************************************/
    /*************************************************************************************************************/

    public function _before_meterlist_news(){
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


    /**
     * 设备列表
     */
    public function meterlist_news(){
        //导航设置
        $breadcrumb_diy = array(
            array('物业服务','#'),
            array('设备列表','meterlist_news'),
        );
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $this->html_option('table_init_length',-1);
        $model = new RoomModel();
        $village_id = filter_village(0,2);
        $village_type = D('house_village')->where(array('village_id'=>$village_id))->getField('village_type');

        $list = $model->meterlist('',$village_id);
        if(IS_AJAX){
            $this->success("获取数据成功","",$list);exit();
        }
        $this->assign_json('meter_type_tree',$model->get_type_tree());
        $this->assign("list",$list);
        $this->assign("village_type",$village_type);
        $this->display();
    }

    /**
     * 工程设备记录表
     */
    public function meters_record_list(){
        //导航设置
        $breadcrumb_diy = array(
            array('物业服务','#'),
            array('工程设备列表','meterlist_news'),
        );
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $this->html_option('table_init_length',-1);
        $model = new RoomModel();
        $village_id = filter_village(0,2);
        $village_type = D('house_village')->where(array('village_id'=>$village_id))->getField('village_type');

        $list = $model->meters_cate('',$village_id);
        if(IS_AJAX){
            $this->success("获取数据成功","",$list);exit();
        }
        $this->assign_json('get_meter_cate',$model->get_meter_cate());
        $this->assign("list",$list);
        $this->assign("village_type",$village_type);
        $this->display();
    }


    /**
     * 工程设备记录表
     */
    public function meters_record_lists(){

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
        
        
        //条件
        $_map =array('p.is_del'=>0);
        $point_status && $_map['point_status']=array('eq',$point_status);
       
        if(isset($_GET['d_time'])&&!isset($_GET['work_time'])){
            $thisDayStart = strtotime($_GET['d_time'])+8*3600;
            $thisDayEnd = strtotime($_GET['d_time'])+32*3600;
            $this->assign('w_time',1);
        }elseif (!isset($_GET['d_time'])&&isset($_GET['work_time'])){
            if($_GET['work_time'] == 1){
                $thisDayStart = strtotime(date('Y-m-d').'08:00');
                $thisDayEnd =strtotime(date('Y-m-d').'12:00');
                $this->assign('w_time',1);
            }elseif ($_GET['work_time'] == 2){
                $thisDayStart = strtotime(date('Y-m-d').'12:00');
                $thisDayEnd =strtotime(date('Y-m-d').'18:00');
                $this->assign('w_time',2);
            }elseif ($_GET['work_time'] == 3){
                $thisDayStart = strtotime(date('Y-m-d').'18:00');
                $thisDayEnd =strtotime(date('Y-m-d').'23:59');
                $this->assign('w_time',3);
            }else{
                $thisDayStart = strtotime('+1 day',strtotime(date('Y-m-d').'01:00'));
                $thisDayEnd =strtotime('+1 day',strtotime(date('Y-m-d').'08:00'));
                $this->assign('w_time',4);
            }
        }elseif (isset($_GET['d_time'])&&isset($_GET['work_time'])){
            if($_GET['work_time'] == 1){
                $thisDayStart = strtotime($_GET['d_time'].'08:00');
                $thisDayEnd =strtotime($_GET['d_time'].'12:00');
                $this->assign('w_time',1);
            }elseif ($_GET['work_time'] == 2){
                $thisDayStart = strtotime($_GET['d_time'].'12:00');
                $thisDayEnd =strtotime($_GET['d_time'].'18:00');
                $this->assign('w_time',2);
            }elseif ($_GET['work_time'] == 3){
                $thisDayStart = strtotime($_GET['d_time'].'18:00');
                $thisDayEnd =strtotime($_GET['d_time'].'23:59');
                $this->assign('w_time',3);
            }else{
                $thisDayStart = strtotime('+1 day',strtotime($_GET['d_time'].'01:00'));
                $thisDayEnd = strtotime('+1 day',strtotime($_GET['d_time'].'08:00'));
                $this->assign('w_time',4);
            }
        }else{
            //如果没有任何选项则进入当前当班的统计
            $nowTime = time();
            if($nowTime>=strtotime(date('Y-m-d').'08:00')&&$nowTime<strtotime(date('Y-m-d').'12:00')){
                $thisDayStart = strtotime(date('Y-m-d').'08:00');
                $thisDayEnd = strtotime(date('Y-m-d').'12:00');
                $this->assign('w_time',1);
            }elseif ($nowTime>=strtotime(date('Y-m-d').'12:00')&&$nowTime<strtotime(date('Y-m-d').'18:00')){
                $thisDayStart = strtotime(date('Y-m-d').'12:00');
                $thisDayEnd = strtotime(date('Y-m-d').'18:00');
                $this->assign('w_time',2);
            }elseif ($nowTime>=strtotime(date('Y-m-d').'18:00')&&$nowTime<=strtotime(date('Y-m-d').'23:59')){
                $thisDayStart = strtotime(date('Y-m-d').'18:00');
                $thisDayEnd = strtotime(date('Y-m-d').'23:59');
                $this->assign('w_time',3);
            }elseif ($nowTime>=strtotime('+1 day',strtotime(date('Y-m-d').'01:00'))&&$nowTime<strtotime('+1 day',strtotime(date('Y-m-d').'08:00'))){
                $thisDayStart = strtotime('+1 day',strtotime(date('Y-m-d').'01:00'));
                $thisDayEnd = strtotime('+1 day',strtotime(date('Y-m-d').'08:00'));
                $this->assign('w_time',4);
            }
        }

        //查询所有设备
        $meter_type_id = 113;
        //查询所有分类sign生成记录表名
        $cateArray = M('house_village_meter_cate')->where(array('meter_type_id'=>$meter_type_id))->select();
        $table_name = array();
        foreach ($cateArray as $k => $v) {
            $field = $v['sign'];
            $table_name[] = $field.'_config_record';
        }
        // var_dump($table_name);
        //通过记录表查询所对应的时间的信息
        $parameters = array();
        foreach ($table_name as $k => $v) {
            $parameters[] = M($v)->where(array('check_time'=>array('between',array($thisDayStart,$thisDayEnd))))->select();
        }
        // var_dump($parameters);
        // 对数据进行处理，使成为一维数组
        $meterArray = array();
        foreach ($parameters as $key => $value) {
            foreach ($value as $k => $v) {
                $meterArray[] = $v;
            }
        }
        //对表中数据相关字段进行处理，能更好的展示在表中
        foreach ($meterArray as $k => $v) {
            $meter_id = $v['meter_id'];
            $meter = M('house_village_meters')->where(array('id'=>$meter_id))->select();
            $meter_cate = M('house_village_meter_cate')->where(array('id'=>$meter[0]['cate_id']))->select();

            $meterArray[$k]['meter_code'] = $meter[0]['meter_code']; 
            $meterArray[$k]['room_name'] = $meter[0]['meter_desc'];
            $meterArray[$k]['meter_cate'] = $meter_cate[0]['desc'];
            $meterArray[$k]['meter_sign'] = $meter_cate[0]['sign'];
        }

        //设备总数量
        $MeterCount = M('house_village_meters')->where(array('meter_type_id'=>$meter_type_id))->count();
        $nowMeterCount = count($meterArray);
        $lowMeterCount = $MeterCount - $nowMeterCount;
        $rate = round(($nowMeterCount / $MeterCount) * 100, 0)."%";

        // var_dump($meterArray);exit;
        $this->assign("meterArray",$meterArray);
        $this->assign("MeterCount",$MeterCount);
        $this->assign("nowMeterCount",$nowMeterCount);
        $this->assign("lowMeterCount",$lowMeterCount);
        $this->assign("rate",$rate);

        $this->display();
    }

    /**
     * 记录详情
     *
     */
    public function meters_record_detail(){        
        $data = $_GET;
        //表名
        $table_name = $data['field'].'_config_record';
        $id = $data['id'];
        $record = M($table_name)->where(array('id'=>$id))->select();
        // var_dump($record);
        //设备基本信息
        $meter = M('house_village_meters')->where(array('id'=>$record[0]['meter_id']))->select();
        // var_dump($meter);

        //查询当前设备的基本配置
        foreach ($meter as $key => $val) {
            $meter_type = M('re_setmeter_config')->where(array('id'=>$val['meter_type_id']))->getField('desc');
            $meter[$key]['cates']['meter_type'] = $meter_type;
            $cate_type = M('house_village_meter_cate')->where(array('id'=>$val['cate_id']))->select();
            $meter[$key]['cates']['cate_type'] = $cate_type[0]['desc'];
            $meter[$key]['cates']['cate_id'] = $cate_type[0]['id'];
            $configArr = M('house_village_meters_custom')->where(array('meter_hash'=>$val['meter_hash']))->select(); 
            // var_dump($configArr);
            //剔除信息为空的数据          
            foreach ($configArr as $k => $v) {               
                if ($v['val'] == '') {
                    unset($configArr[$k]);
                }
            }
            // var_dump($configArr);exit;
            $meter[$key]['configArr'] = $configArr;
        }
        foreach ($meter as $key => $va) {
            foreach ($va['configArr'] as $k => $v) {
                $desc = M('re_setmeter_config_custom')->where(array('id'=>$v['custom_id']))->getField('desc');
                $meter[$key]['configArr'][$k]['desc'] = $desc;              
            }
        }
        
        // var_dump($meter);
        //该设备的二级参数
        $cateArray = array();
        $cateArr = array();
        foreach ($meter as $key => $value) {
            $cateArray = M('re_setmeter_config_custom')->field(array('id','desc'))->where(array('cate_id'=>$value['cates']['cate_id']))->select();
            foreach ($cateArray as $ke => $val) {
                $cateArr = M('re_setmeter_config_custom')->field(array('id','key','desc'))->where(array('cate_id'=>$val['id']))->select();
                foreach ($cateArr as $k => $v) {
                    $fields = $v['key'].'_'.$v['id'];
                    $cateArr[$k]['val'] = $record[0][$fields];
                }
                $cateArray[$ke]['cateArr'] = $cateArr;
            }
            $meter[$key]['cates']['cateArray'] = $cateArray;
        }           
        // var_dump($meter);      

        $this->assign("meter",$meter);
        $this->display();
    }

    /*
     * 设备属性修改
     */
    public function modal_meter_update() {
        if (IS_POST) {           
            $model = new RoomModel();
            $meter_config = $_POST['custom_id'];
            $meter_hash = M('house_village_meters')->where(array('id'=>$_POST['meters_id']))->getField('meter_hash');
            // var_dump($meter_hash);

            $meters_id = $_POST['meters_id'];
            unset($_POST['meters_id']);
            unset($_POST['custom_id']);
            $re = D("house_village_meters")->where(array('id'=>$meters_id))->save($_POST);

            //修改表pigcms_house_village_meters_custom
            foreach($meter_config as $custom_id=>$val){
                $custom_data = array(
                    'custom_id' =>$custom_id,
                    'val'       =>$val,
                    'meter_hash'=>$meter_hash,
                );
                $res= $model->update_custom($custom_data);
            }

            if ($res) {
                $this->success('修改成功',U('meterlist_news'));
            } else {
                if ($re) {
                    $this->success('修改成功',U('meterlist_news'));
                } else {
                    $this->error('修改失败',U('meterlist_news'));
                }
            }
                        
        } else {
            $meter_hash = $_GET['meter_hash'];
            if (!$meter_hash) $this->assign('没有选择设备');
            $metersArr = D('house_village_meters')->where(array('meter_hash'=>$meter_hash))->find();
            //导航设置
            $breadcrumb_diy = array(
                array('物业服务','#'),
                array('设备列表',U('meterlist_news')),
                array('修改设备','#'),
            );
            $model = new RoomModel();
            $is_admin=$this->is_admin($this->admin_id);
            if($is_admin){
                $village_list=$model->get_village_list();
            }else{
                $village_list=$model->get_village_list(array('village_id'=>$this->village_id));
            }
           // dump($village_list);exit;
            $this->assign_json('metersArr',$metersArr);
            $this->assign_json('type_tree',$model->get_type_tree($this->village_id));
            $this->assign_json('village_list',$village_list);
            $this->assign_json('room_list',$model->get_room_list(0,$this->village_id));
            $this->assign_json('village_id',$this->village_id);
            $this->assign_json('is_admin',!$is_admin);
            $this->assign('breadcrumb_diy',$breadcrumb_diy);
            $this->assign('metersArr',$metersArr);
            $this->display();
        }

    }

    /**
     * 设备绑定房间弹出层
     * @param $meter_hash
     */
    public function modal_meter_bind_room($meter_hash){
        $model = new RoomModel();
        $this->assign_json('room_list',$model->get_room_list(0,session('system.village_id')));//单元列表
        $this->assign_json('village_list',$model->get_village_list());//社区
        $meterinfo = $model->meterinfo($meter_hash);
        $this->assign('meter_hash',$meter_hash);//业主ID
        $this->assign('modal_title',"设备绑定单元-" .$meterinfo['meter_code'] . "($meter_hash)");
        $this->display();
    }


    /**
     * 设备绑定房间弹出层(小区独有)
     * @param $meter_hash
     */
    public function modal_meter_bind_room_sq($meter_hash){
        $model = new RoomModel();
        $this->assign_json('room_list',$model->get_room_list_two(0,session('system.village_id')));//单元列表
        $this->assign_json('village_list',$model->get_village_list());//社区
        $meterinfo = $model->meterinfo($meter_hash);
        $this->assign('meter_hash',$meter_hash);//业主ID
        $this->assign('modal_title',"设备绑定单元-" .$meterinfo['meter_code'] . "($meter_hash)");
        $this->display();
    }


    /**
     * 设备绑定房间执行
     * @param $room_id
     * @param $meter_hash
     */
    public function meter_bind_room_act($room_id,$meter_hash){
        $model = new RoomModel();
        $re = $model->meter_bind_room($room_id,$meter_hash);
        if($re!==false){
            $this->success("成功","",$model->get_room_info($room_id));
        }else{
            $this->error(mysql_error(),"",$_GET);
        }
    }

    /**
     * 设备解绑房间执行
     * @param $room_id
     * @param $meter_hash
     */
    public function meter_unbind_room_act($room_id,$meter_hash){
        $model = new RoomModel();
        $re = $model->meter_unbind_room($room_id,$meter_hash);
        if($re!==false){
            $this->success("成功","",$model->get_room_info($room_id));
        }else{
            $this->error(mysql_error(),"",$_GET);
        }
    }

    /**
     * 显示设备二位码
     * @param $url
     */
    public function meter_qr($meter_hash){
        // var_dump($meter_hash);
        $meter = M('house_village_meters')->where(array('meter_hash'=>$meter_hash))->getField('meter_type_id');
        if ($meter == 113) {
            $url = C('WEB_DOMAIN') . '/wap.php?g=Wap&c=Room&a=meter_bind_card&meter_hash=' . $meter_hash;
            qr($url);
        } else {
            $url = C('WEB_DOMAIN') . '/wap.php?g=Wap&c=Meter&a=enter&meter_hash=' . $meter_hash;
            qr($url);    
        }
    }

    /**
     * 设备二维码弹出层
     * @param $meter_hash
     */
    public function modal_meter_qr($meter_hash){
        $model = new RoomModel();
        $meter_info = $model->meterinfo($meter_hash);
        //确认设备是否为工程设备
        if ($meter_info['meter_type_id'] == 113) {
            $this->assign('meter',1);
        }
        $configArr = array();
        $meter_type = M('re_setmeter_config')->where(array('id'=>$meter_info['meter_type_id']))->getField('desc');
        $meter_info['meter_type'] = $meter_type;
        $meter_cate = M('house_village_meter_cate')->where(array('id'=>$meter_info['cate_id']))->select();
        $meter_info['meter_cate'] = $meter_cate[0]['desc'];
        $configArr = M('house_village_meters_custom')->where(array('meter_hash'=>$meter_info['meter_hash']))->select(); 
        //剔除信息为空的数据          
        foreach ($configArr as $k => $v) {               
            if ($v['val'] == '') {
                unset($configArr[$k]);
            }
            $parameter = M('re_setmeter_config_custom')->where(array('id'=>$v['custom_id']))->getField('desc');
            $configArr[$k]['parameter'] = $parameter;
        }
        // $count = count($configArr);
        // $i = ceil($count/2);
        // var_dump($count);
        // var_dump($i);
        // var_dump($configArr);
        $meter_info['configArr'] = $configArr;

        $meter_info['be_cousume'] = explode(',', $meter_info['be_cousume']);
        $meter_info['use_count'] =  $meter_info['be_cousume'][1] - $meter_info['be_cousume'][0];   
        $this->assign('meter_hash',$meter_info['meter_hash']);
        $this->assign('modal_title',$meter_info['meter_code']);
        $this->assign('meter_info',$meter_info);
        $meter_type_list = $model->get_meter_type_list();
        $price_type_list = $model->get_price_type_list();
        $this->assign('meter_type_list',$meter_type_list);
        $this->assign('price_type_list',$price_type_list);
        // var_dump($meter_info['be_cousume']);exit();
        $this->display();
    }

    /**
     * 设备异常检测
     */
    public function meter_error(){
        //导航设置
        $breadcrumb_diy = array(
            array('物业服务','#'),
            array('设备管理',U('meterlist_news')),
            array('异常检测','#'),
        );
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $this->display();
    }

    /**
     * 设备逻辑删除
     * @param $meter_hash
     */
    // public function meter_logic_del($meter_hash){
    //     $res = M('house_village_meters')->where('meter_hash="%s"',$meter_hash)->setField('is_del',1);
    //     if($res!==false){
    //         $this->success("删除成功");
    //     }else{
    //         $this->error("删除失败");
    //     }
    // }

    /**
     * 还原设备
     * @param $meter_hash
     */
    // public function meter_return($meter_hash){
    //     $res = M('house_village_meters')->where('meter_hash="%s"',$meter_hash)->setField('is_del',0);
    //     if($res!==false){
    //         $this->success("还原成功");
    //     }else{
    //         $this->error("还原失败");
    //     }
    // }

    /*
     *设备的状态，启用与关闭
     */
    public function meter_type(){
        $id = I('post.meter_id');
        $is_del = I('post.is_del');
        if ($is_del == 0) {//设备的停用
            $data=array('is_del'=>1);
            $re=M('house_village_meters')->where(array('id'=>$id))->data($data)->save();
            echo $re;
        } else {//设备的启用
            $data=array('is_del'=>0);
            $re=M('house_village_meters')->where(array('id'=>$id))->data($data)->save();
            echo $re;
        }        
    }


    /**
     * 添加设备
     */
    public function add_meter(){      
        
        //导航设置
        $breadcrumb_diy = array(
            array('物业服务','#'),
            array('设备列表',U('meterlist_news')),
            array('添加设备','#'),
        );
        $model = new RoomModel();
        $is_admin=$this->is_admin($this->admin_id);
        if($is_admin){
            $village_list=$model->get_village_list();
        }else{
            $village_list=$model->get_village_list(array('village_id'=>$this->village_id));
        }
        $this->assign_json('type_tree',$model->get_type_tree($this->village_id));
        $this->assign_json('village_list',$village_list);
        $this->assign_json('room_list',$model->get_room_list(0,$this->village_id));
        $this->assign_json('village_id',$this->village_id);
        $this->assign_json('is_admin',!$is_admin);
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $this->display();
    }

    /**
     * 动态获取设备类型
     * @author zhukeqin
     */
    public function add_meter_ajax(){
        //导航设置
        $village=I('post.village_id');
        $model = new RoomModel();
        $array=array(
            'data'=>$model->get_type_tree($village),
            'room_list'=>$model->get_room_list(0,$village)
        );
        echo json_encode($array);
    }

    /**
     * 根据sign判断该点位是否存在
     */
    public function check_meter(){
        $meter_code = I('post.meter_code');
        $meter_bind_id = I('meter_bind_id');
        $res= M('house_village_meters')->where(array('meter_code'=>$meter_code,'cate_id'=>$meter_bind_id))->select();
        if ($res) {
            $message = $res;
        }
        echo $message;
    }

    /**
     * 添加设备执行
     */
    public function add_meter_act(){
        $data = $_POST;
        // var_dump($data);exit;
        $model = new RoomModel();
        //事务开始
        $model->startTrans();
        $flag = 1;//是否数据库执行正确
        $data = $_POST;
        //非超级管理员赋值社区ID by zhukeqin
        if(!$this->is_admin($this->admin_id)){
            $data['village_id']=$this->village_id;
        }
        //楼层
        $data['meter_floor'] = M('house_village_room')
            ->where('id=%d',$data['floor_id'])
            ->getField('room_name');
        //房间号码逗号分隔
        $data['room_names'] = join(',',$model->room_id2name($data['room_id']));
        //房间ID 逗号分隔
        $data['room_id']    =  join(',',$data['room_id']);
        //设备所在表述 某社区 某楼层 某房间
        $data['meter_desc'] = $model->get_village_list()[$data['village_id']]
            .$data['meter_floor'] .'('. $data['room_names'].')';
        //唯一标识
        $data['meter_hash'] = $model->create_meter_hash($data['meter_code'],$data['meter_floor']);
        //添加到pigcms_house_village_meters
        $meter_data = array(
            'meter_code'    =>$data['meter_code'],
            'create_time'   =>time(),
            'be_cousume'    =>'0,'.$data['last_cousume'],
            'be_date'       =>'0000-0000,'.date("Y-m-d"),
            'meter_hash'    =>$data['meter_hash'],
            'rate'          =>$data['rate'],
            'meter_type_id' =>$data['meter_type_id'],
            'price_type_id' =>$data['price_type_id'],
            'cate_id'       =>$data['meter_bind_id'],
            'meter_floor'   =>$data['meter_floor'],
            'bind_count'    =>'',
            'room_id'       =>$data['room_id'],
            'meter_desc'    =>$data['meter_desc'],
            'floor_id'      =>$data['floor_id'],
            'village_id'    =>$data['village_id'],
            'is_del'        =>0,
        );

        $flag *= $model->add_meter($meter_data);//添加失败返回false 乘集为 0 (false);
        //添加到pigcms_house_village_meters_custom
        foreach($data['custom_id'] as $custom_id=>$val){
            $custom_data = array(
                'custom_id' =>$custom_id,
                'val'       =>$val,
                'meter_hash'=>$data['meter_hash'],
            );
            $flag *= $model->add_custom($custom_data);
            echo mysql_error();
        }
        //提交事务
        $flag?$model->commit():$model->rollback();
        if($flag){
            $this->success("添加成功");
        }else{
            echo mysql_error();//exit();
            $this->error("发送错误，请重试");
        }
    }

    /**
     * 编辑设备执行
     */
    public function edit_meter_act(){

    }

    /**
     * 删除设备执行
     */
    public function del_meter_act(){

    }

    /**
     * 获取自定义设备
     * @param $config_id
     */
    public function get_meter_custom(){
        // var_dump($_POST);
        // var_dump($_GET);
        //获取当前设备的基本配置  
        $meter_hash = M('house_village_meters')->where(array('id'=>$_GET['meters_id']))->getField('meter_hash');
        $meter_config = M('house_village_meters_custom')->where(array('meter_hash'=>$meter_hash))->select();
        // var_dump($meter_config);
        // 处理数据
        $tmp = array();
        foreach ($meter_config as $k => $v) {
            $tmp[$v['custom_id']] = $v;
        }
        $meter_config = $tmp;
        // var_dump($meter_config);

        //获取当前类型的基本配置
        $data = M('re_setmeter_config_custom')->where('config_id=%d',$_GET['config_id'])->select();
        // var_dump($configArr);
        $tmp = array();
        foreach ($data as $k => $v) {
            $tmp[$v['id']] = $v;
        }
        $data = $tmp;
        // var_dump($data);

        //将设备的基本配置的val赋给类型的基本配置val
        foreach ($data as $k => $v) {
            if ($meter_config[$k]['val']) {
                $data[$k]['val'] = $meter_config[$k]['val'];
            }           
        }
        // var_dump($data);

        if($data!==false){
            $this->success("成功获取自定义设备","",$data?:array());
        }else{
            $this->error("发生错误");
        }

    }


    /**抄表记录****************************************************************************************************/
    /*************************************************************************************************************/

    public function _before_meter_record_news(){
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

    /**
     * 抄表记录
     */
    public function meter_record_news($ym="",$is_record=-1){
        $ym = $ym?:date("Y-m");
        //导航设置
        $breadcrumb_diy = array(
            array('物业服务','#'),
            array('抄表记录','#'),
        );
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $this->html_option('table_init_length',-1);

        $model = new RoomModel();

        $village_id = filter_village(0,2);

        $list = $model->meter_record($ym,-1,$village_id);//取全部数据，取完再做赛选
        $is_record_count = 0;
        $no_record_count = 0;
        foreach($list as $key=>$row){
            if($row['is_record']){
                $is_record_count ++;
            }else{
                $no_record_count ++;
            }

            if( $is_record!=-1 && $row['is_record']!=$is_record){
                unset($list[$key]);
            }

        }
        //dump($list);
        $this->assign('month',intval(explode('-',$ym)[1]));
        $this->assign('is_record',intval($is_record));
        $this->assign_json('meter_type_tree',$model->get_type_tree());
        $this->assign('_meter_type_id',I('get.meter_type_id'));
        $this->assign('_price_type_id',I('get.price_type_id'));
        $this->assign('list',$list);
        $this->assign('is_record_count',$is_record_count);
        $this->assign('no_record_count',$no_record_count);
        $this->display();
    }

    /**
     * 抄表记录编辑页面
     * 抄表数据发生人工错误时给予修改
     * @param $record_id
     */
    public function edit_record($record_id){
        //导航设置
        $breadcrumb_diy = array(
            array('物业服务','#'),
            array('抄表记录','#'),
            array('抄表记录编辑','#'),
        );
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $model = new RoomModel();
        $record_info = $model->get_record($record_id);
        echo mysql_error();
        $this->assign('info',$record_info);
        $this->display();
    }

    /**
     * 已抄表记录编辑
     * 抄表数据发生人工错误时给予修改
     */
    public function edit_record_act(){
        $record_id = I('post.record_id');
        $data = $_POST;
        $res = M('re_setmeter')->where('id=%d',$record_id)->save($data);
        if($res!==false){
            //echo M()->getLastSql();exit();
            $this->success("成功",U('meter_record_news'));
        }else{
            $this->error("发生错误：" . mysql_error());
        }
    }

    /**
     * 手动同步止码
     */
    public function update_consume(){
        $model = new RoomModel();
        $re = $model->update_consume();
        if($re!==false){
            $this->success("已同步上月抄表止码");
        }else{
            $this->error("发生错误");
        }
    }



    /**账单相关****************************************************************************************************/
    /*************************************************************************************************************/

    /**
     * 账单预览
     */
    public function bill_preview(){
        $village_id =  filter_village(0,2);
        //判断是否是小区，进行跳转 by zhukeqin
        if(M('house_village')->where('village_id='.$village_id)->find()['village_type']==1){
            header('Location:'.U('bill_preview_uptown'));
        }
        $ym = I('get.ym')?:date("Y-m");//缴费记录的指定日期
        //过滤
        $tid = M('admin')->where('id=%d',session('admin_id'))->getField('tid');
        if(!$tid){
            $tid = I('get.tid',0,'intval');
        }


        //导航设置
        $breadcrumb_diy = array(
            array('物业服务','#'),
            array('入驻单位列表',U('tenantlist_news')),
            array('账单预览','#'),
        );
        $this->html_option('table_init_length',-1);
        $this->html_option('table_sort',array(1,'asc'));
        $model = new RoomModel();
         $village_id = session('system.village_id');
        $list = $model->preview_list($tid,$village_id,$ym);
        //dump(M()->_sql());exit;
        //楼层数据处理
        foreach($list as &$row){
            $row['room_names'] = array();
            $property_data = $row['property_data'];
            foreach($property_data as $rr){
                if($rr['room_name'])   $row['room_names'][] = $rr['room_name'];
            }

            $row['room_names_format'] = $model->format_room_str($row['room_names'],'<br>');
            $row['bill'] = $model->create_bill($row);
        }

        //计算抄表初始时间
        $metersArr = D('house_village_meters')
            ->field(array('set_start_time','set_end_time'))
            ->where(array('village_id'=>$village_id,'is_del'=>0))
            ->find();
        $start_time = date('Y-m-d',$metersArr['set_start_time']);
        $end_time = date('Y-m-d',$metersArr['set_end_time']);
        $this->assign('start_time',$start_time);
        $this->assign('end_time',$end_time);
        $this->assign('list',$list);
        $this->assign('meter_type_list',$model->get_meter_type_list());
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $this->assign('combine_status_list',$model->get_combine_status('all'));
        $this->assign('ym',$ym);
        $this->display();
    }
    /**
     * @author zhukeqin
     * 账单预览 小区版本
     */
    public function bill_preview_uptown(){
        $village_id =  filter_village(0,2);
        //判断是否是小区，不是就进行跳转 by zhukeqin
        if(M('house_village')->where('village_id='.$village_id)->find()['village_type']==0){
            header('Location:'.U('bill_preview_uptown'));
        }
        $ym = I('get.ym')?:date("Y-m");//缴费记录的指定日期


        //导航设置
        $breadcrumb_diy = array(
            array('物业服务','#'),
            array('入驻单位列表',U('tenantlist_news')),
            array('账单预览','#'),
        );
        $this->html_option('table_init_length',-1);
        $this->html_option('table_sort',array(1,'asc'));
        $model = new RoomModel();
        $village_id = session('system.village_id');
        $list = $model->preview_list_uptown($village_id,$ym);
        //楼层数据处理
        //dump($list);
        $this->assign('list',$list);
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $this->assign('ym',$ym);
        $this->display();
    }
    /**
     * @author zhukeqin
     * 杂项费用导入 小区
     */
    public function import_other_price_uptown(){
        $breadcrumb_diy = array(
            array('物业服务','#'),
            array('物业缴费',U('bill_preview_uptown')),
            array('批量导入','#'),
        );
        $file = $_FILES['test'];
        $village_id = $this->village_id;
        $model = new RoomModel();
        $village_name = $model->get_village_list()[$village_id];

        if($file){
            $project_id=I('post.project_id');
            if(empty($project_id)){
                $this->error("请选择园区",U('owner_uptown_import_step1'));
            }
            //导入数据
            $list = $model->import_other_price_uptown_todata($file,$village_id,$project_id);
            if(empty($list)){
                $this->success("导入成功",U('bill_preview_uptown'));
            }else{
                dump('以下房间号导入出现问题，请仔细核对格式<\/br>'.$list);
                die;
            }
            //$this->display();
        }
        $village_list=$model->get_village_list(array('village_id'=>$this->village_id));
        $project_list=M('house_village_project')->where('village_id='.$this->village_id)->select();
        $this->assign('project_list',$project_list);
        $this->assign('village_list',$village_list);
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $this->display();
    }
    /**
     * @author zhukeqin
     * 批量出账
     */
    public function hydropower_account_do_uptown(){
        $model = new RoomModel();
        $ids=I('post.ids');
        $id_list=explode(',',$ids);
        $ym = I('post.ym')?:date("Y-m");
        if($ym>date("Y-m")){
            $this->error('出账月份超过当前月份，出错！',U('bill_preview_uptown',array('ym'=>$ym)));
        }
        foreach ($id_list as $id){
            $room_info=M('house_village_room')->where('id='.$id)->find();
            $payinfo=$model->get_paylist_one($room_info['room_name'],$room_info['village_id'],$room_info['project_id'],$ym);
            if(empty($payinfo['pigcms_id'])){
                M('house_village_user_paylist')->data($payinfo)->add();
                $payinfo=$model->get_paylist_one($room_info['room_name'],$room_info['village_id'],$room_info['project_id'],$ym);
            }
            if($payinfo['is_enter_list']==1){
                continue;
            }
            M('house_village_user_paylist')->where('pigcms_id='.$payinfo['pigcms_id'])->data(array('is_enter_list'=>1))->save();
            $oid_list=explode(',',$room_info['oid']);
            foreach ($oid_list as $key=>$value){
                $model->send_msg($value,$this->village_id,$ym,$id);
            }
        }
        $this->success('出账成功！',U('bill_preview_uptown',array('ym'=>$ym)));
    }
    /**
     * 查看租户指定设备类型的抄表情况
     * @param $meter_type_id
     * @param $tid
     */
    public function modal_meter_type_record($meter_type_id,$tid){
        $model = new RoomModel();
        $info = array_pop($model->preview_list($tid,0,I('get.ym')));
        $room_data = $info['room_data'];
        unset($room_data[""]);
        $meter_type_list = $model->get_meter_type_list();
        $price_type_list = $model->get_price_type_list();

        $assign = array(
            'modal_title'=>$meter_type_list[$meter_type_id],
            'tid'=>$tid,
            'meter_type_id'=>$meter_type_id,
            'combine_status'=>$info['combine_status'],
            'status_desc'=>$model->get_combine_status($info['combine_status'])
        );

//        dump($room_data);exit;
        
        $this->assign($assign);
        $this->assign('modal_title',"抄表记录-" .$info['tenantname'] . "($tid)");
        $this->assign_json('room_data',$room_data);
        $this->assign_json('meter_type_list',$meter_type_list);
        $this->assign_json('tid',$tid);
        $this->assign_json('price_type_list',$price_type_list);

        $this->display();
    }

    /**
     * 修改数据，在 modal_meter_type_record 中的异步修改
     * @param $item
     * @param $field
     */
    public function meter_type_record_edit_act(){
        //获取数据 直接用$_POST获取不到
        $data = file_get_contents("php://input");
        $data = htmlspecialchars_decode($data);
        $data = json_decode($data,true);

        //根据字段区分修改 修改的只是单个字段,所以使用两个平级的if也行
        //last_total_consume，total_consume 修改的是抄表记录表，re_setmeter
        $in_record = ['last_total_consume','total_consume'];
        if(in_array($data['field'],$in_record)){
            $re = M('re_setmeter')->where('id=%d',$data['record_id'])
                ->setField($data['field'],$data[$data['field']]);
        }

        //rate,scale 修改的是 pigcms_house_village_tenant_scale
        $in_tenant_scale = ['rate','scale'];
        if(in_array($data['field'],$in_tenant_scale)){
            $add_info = array(
                'meter_hash'=>$data['meter_hash'],
                'tid'=>$data['tid'],
                'tts'=>$data['scale'],
                'rate'=>$data['rate']
            );
            $re = M('house_village_tenant_scale')->add($add_info,array(),true);
        }

        if($re!==false){
            $this->success('修改成功','');
        }else{
            $this->error("发生错误，修改失败","",$data);
        }
    }


    /**
     * 自定义金额
     */
    public function admin_defined_price(){

        $info = I('get.');
        $model = new RoomModel();
        $res = $model->admin_defined_price($info);
        if( $res !==false ){
            $this->success("成功",'',$info);
        }else{
            $db_record = M('re_setmeter')->where('id=%d',$info['record_id'])->find();
            $this->error("失败",'',$db_record);
        }

    }

    /**
     * 出账1 执行
     * @param $tid
     */
    public function enter_pay_list_act($tid=0,$village_id=4){
        $tid = I('get.tid',0);
        $model = new RoomModel();
        $list = $model->preview_list($tid,$village_id);
        $add_flag = true;
        $model->startTrans();
        foreach($list as $row){
            if($row['combine_status']==1){
                $use_water = 0.00;
                $water_price = 0.00;
                $use_electric = 0.00;
                $electric_price = 0.00;
                $property_price = 0.00;
                foreach ($row['room_data'] as $meter_type_id=>$meter_info){
                    foreach($meter_info as $rr){
                        switch ($meter_type_id){
                            case 1:
                                $use_water += $rr['total_consume']-$rr['last_total_consume'];
                                $water_price += floatval($rr['admin_defined_price'])?:$rr['cost'];
                                break;
                            case 5:
                                $use_electric += $rr['total_consume']-$rr['last_total_consume'];
                                $electric_price += floatval($rr['admin_defined_price'])?:$rr['cost'];
                                break;
                        }
                        foreach(explode(',',$rr['room_id']) as $k=>$v){
                            $property_price += explode(',',$rr['roomsize'])[$k]
                                * explode(',',$rr['property_unit'])[$k];
                        }

                    }
                }

                $tmp = array();
                $tmp['create_date']     = date("Y-m");
                $tmp['add_time']        = time();
                $tmp['name']            = $row['name'];
                $tmp['phone']           = $row['phone'];
                $tmp['use_water']       = $use_water;
                $tmp['use_electric']    = $use_electric;
                $tmp['property_price']  = $property_price;
                $tmp['water_price']     = $water_price;
                $tmp['electric_price']  = $electric_price;
                $tmp['park_price']      = 0.00;
                $tmp['usernum']         = $row['usernum'];
                $tmp['village_id']      = $row['village_id'];
                $add_flag *=M('house_village_user_paylist')->add($tmp);
                if($add_flag){
                    $model->commit();
                    $this->success("成功出账");
                }else{
                    $model->rollback();
                    $this->error("发送错误",'',mysql_error());
                }
            }

        }

    }

    /**
     * 历史缴费记录
     * @author 祝君伟
     * @time 2017年10月31日10:35:12
     */
    public function pay_history_list($tid){
        $bindInfo = M('house_village_user_bind')->find($tid);
        $field = array(
            'group_concat(pigcms_id)'=>'pid'
        );
        $listId = M('house_village_user_paylist')
            ->field($field)
            ->where(array('usernum'=>$bindInfo['usernum']))
            ->group('usernum')
            ->select();
        $map['pid'] = array('in',$listId[0]['pid']);

        $map['is_pay'] = array('eq',1);

        $order_count =  M('house_village_pay_order')->where($map)->count();

        import('@.ORG.merchant_page');
        $p = new Page($order_count,15,'page');

        $list = M('house_village_pay_order')->where($map)->limit($p->firstRow.','.$p->listRows)->select();

        //vd($list);
        if($list){
            $return['totalPage'] = ceil($order_count/15);
            $return['user_count'] = count($list);
            $return['pagebar'] = $p->show();
            $return['user_list'] = $list;
        }

        //vd($return);exit;

        $this->assign('list',$return);
        $this->display();
    }


    /**
     * 出账弹出层
     * @param $tid
     */
    public function modal_pay_list_bck($tid){
        $model = new RoomModel();
        $tenant_bill =$model->preview_list($tid)[0];
        dump($tenant_bill);
        $this->assign('modal_title',$tenant_bill['tenantname']);
        $this->display();
    }

    /**
     * 出账弹出层
     * @param $tid
     */
    public function modal_pay_list($tid){
        $model = new RoomModel();

        $ym = I('get.ym');

        $ym = empty($ym)?date('Y-m'):$ym;

        //vd($ym);
        $tenant_bill =$model->preview_list($tid,0,$ym)[0];
        //vd($tenant_bill);exit;
        $is_create = M('house_village_user_paylist')->where(array('usernum'=>$tenant_bill['usernum'],'create_date'=>$ym))->find();
        /*if(!$is_create){*/

            //未创建订单
            if($ym){
                $billArray = $model->create_bill($tenant_bill,$ym);
            }else{
                $billArray = $model->create_bill($tenant_bill);
            }
            if(!$is_create){
                //vd($billArray);exit;
                $re = M('house_village_user_paylist')->data($billArray)->add();
                //echo mysql_error();exit;
                if(!$re){
                    exit('系统出错，数据生成失败');
                }
            }else{
                $re = M('house_village_user_paylist')->data($billArray)->where(array('pigcms_id'=>$is_create['pigcms_id']))->save();
            }

        /*}*/
        //再次获取数据
        $payListInfo = M('house_village_user_paylist')->where(array('usernum'=>$tenant_bill['usernum'],'create_date'=>$ym))->find();
        $this->assign('otherList',unserialize($payListInfo['use_other']));
        $total_price =$payListInfo['water_price']+$payListInfo['electric_price']+$payListInfo['property_price'];
        if(unserialize($payListInfo['use_other'])){
            foreach (unserialize($payListInfo['use_other']) as $value){
                $total_price += $value;
            }
        }
//        dump($payListInfo);exit;
        $total_price = sprintf("%.2f",$total_price);
        $this->assign('total_price',$total_price);
        $this->assign('payListInfo',$payListInfo);
        $this->assign('modal_title',$tenant_bill['tenantname']);
        $this->display();
    }
    /**
     * 出账弹出层 小区
     * @author zhukeqin
     * @param $tid
     */
    public function modal_pay_list_uptown(){
        $model = new RoomModel();
        $rid=I('get.rid');
        $ym = I('get.ym');

        $ym = empty($ym)?date('Y-m'):$ym;

        $room_info=M('house_village_room')->where('id='.$rid)->find();
        //vd($ym);
        $tenant_bill =$model->get_paylist_one($room_info['room_name'],$room_info['village_id'],$room_info['project_id'],$ym);
        if(empty($tenant_bill['pigcms_id'])){

            //未创建账单则创建
            M('house_village_user_paylist')->data($tenant_bill)->add();
        }
        //再次获取数据
        $payListInfo = $model->get_paylist_one($room_info['room_name'],$room_info['village_id'],$room_info['project_id'],$ym);
        $this->assign('otherList',unserialize($payListInfo['use_other']));
        $this->assign('payListInfo',$payListInfo);
        /*$this->assign('modal_title',$tenant_bill['tenantname']);*/
        $this->display();
    }

    public function look_list($tid){
        $model = new RoomModel();
        $ym = I('get.ym')?:date("Y-m");
        $tenant_bill =$model->preview_list($tid,0,$ym)[0];
        $payListInfo = M('house_village_user_paylist')->where(array('usernum'=>$tenant_bill['usernum'],'create_date'=>$ym))->find();
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
        $this->assign('modal_title',$tenant_bill['tenantname']);
        $this->display();
    }

    /**
     * @author zhukeqin
     * 订单详情查看
     * @param $tid
     */
    public function look_list_uptown($rid){
        $model = new RoomModel();
        $ym = I('get.ym');
        if(empty($ym)){
            echo '传参错误，请刷新页面再查看！';
            die;
        }
        $room_info=M('house_village_room')->where('id='.$rid)->find();
        $payListInfo = $model->get_paylist_one($room_info['room_name'],$room_info['village_id'],$room_info['project_id'],$ym);
        $this->assign('otherList',unserialize($payListInfo['use_other']));
        $total_price =$payListInfo['use_water']+$payListInfo['use_electric']+$payListInfo['use_property'];
        if(unserialize($payListInfo['use_other'])){
            foreach (unserialize($payListInfo['use_other']) as $value){
                $total_price += $value;
            }
        }
        $total_price = sprintf("%.2f",$total_price);
        $this->assign('total_price',$total_price);
        $this->assign('payListInfo',$payListInfo);
        $this->display();
    }
    public function send_msg(){
        $model = new RoomModel();
        $id=I('get.id');
        $ym = I('get.ym')?:date("Y-m");
        if($ym>date("Y-m")){
            $this->error('出账月份超过当前月份，出错！',U('bill_preview_uptown'));
        }
        $rid=M('house_village_user_paylist')->where('pigcms_id='.$id)->find()['rid'];
        $room_info=M('house_village_room')->where('id='.$rid)->find();
        $payinfo=$model->get_paylist_one($room_info['room_name'],$room_info['village_id'],$room_info['project_id'],$ym);
        if(empty($payinfo)){
            $this->error('账单不存在，出账失败！');
        }
        if($payinfo['is_enter_list']==1){
            $this->error('请勿重复出账！');
        }
        M('house_village_user_paylist')->where('pigcms_id='.$payinfo['pigcms_id'])->data(array('is_enter_list'=>1))->save();
        $oid_list=explode(',',$room_info['oid']);
        foreach ($oid_list as $key=>$value){
            $model->send_msg($value,$this->village_id,$ym,$rid);
        }
        parent::success('出账成功',U('bill_preview_uptown'),false);
    }


    /**
     * 当月台账新
     */
    public function account_list2($village_id=4,$ym="2017-12",$cate_id="0"){
        //导航设置
        $breadcrumb_diy = array(
            array('物业服务','#'),
            array('物业缴费',U('tenantlist_news')),
            array('台账','#'),
        );
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $model = new RoomModel();
        //联动选框数据
        //设备类型
        $meter_type_list = $model->get_meter_type_list();
        //用途
        $cate_list = M('house_village_meter_cate')->select();
        $this->assign_json('meter_type_list',$meter_type_list);
        $this->assign_json('cate_list',$cate_list);

        $list = $model->meterlist_for_tenant("",$village_id,$ym);
        foreach($list as &$row){
            $row['custom_info'] = $model->get_custom_info($row['meter_hash'],$cate_id);
            $row['last_total_consume'] = $row['last_total_consume']?:explode(',',$row['be_cousume'])[1];
            $row['total_consume'] = $row['total_consume']?:0;
            $row['unit_price'] = $model->get_unit_price($this->village_id,$row['price_type_id']);
            $row['price_type_name'] = $model->get_price_type_list()[$row['price_type_id']];
            $row['consume'] = $row['total_consume'] - $row['last_total_consume'];
            $row['price'] = $model->set_cost(
                $this->village_id,
                $row['consume'],
                $row['rate'],
                $row['price_type_id'],
                1
            );
        }
        $tmp = array();

        foreach ($list as $row){
            $tmp[] = $model->format_custom_meter($row);
        }

//        $map = array(
//            'meter_code'=>"设备编号",
//            'meter_floor'=>"楼层描述",
//            'floor_name' => "楼层",
//            'rate'=>"倍率",
//            'last_total_consume'=>"上月止码",
//            'total_consume'=>"止码",
//            'meter_type_id'=>"设备ID",
//            'cate_id'=>"用途类别"
//        );

//        'last_total_consume'=>"上月止码",
//            'total_consume'=>"本月止码"
        $fields = array(
            2=>["楼层描述","设备编号"],
            3=>[
                "负荷分类#1#电梯用电小计","用途","楼层描述",
                "配电箱/柜标识牌","设备编号","电表规格","倍率",
                "上月止码","本月止码","用量"
            ],
            5=>["楼层描述","用途","设备编号","倍率","上月止码","本月止码","用量"],
            7=>[
                "编号#2#变压器总表读数起码,止码",
                "柜号#1",
                "设备编号",
                "主备",
                "上月止码",
                "本月止码",
            ],

            8=>[
                "编号#2#变压器总表读数起码,止码",
                "柜号#1",
                "设备编号",
                "主备",
                "上月止码",
                "本月止码",
            ],

            9=>[
                "单元号#1",
                "客户单位名称",
                "装修单位及是否正式用水",
                "设备编号",
                "用量",
                "单价",
                "费用"
            ],
            10=>["单元号","客户名称","计费类型","设备编号","上月止码","本月止码","倍率","单价"],
            11=>["楼层描述","设备编号","倍率","上月止码","本月止码","用量","单价","费用"],
        );



        $this->assign_json('list',$tmp);
        $this->assign_json('fields',$fields);
        $this->display();
    }

    /**
     * 当月台账新
     */
    public function account_list2_bak($ym="2017-11",$cate_id="0"){
        //导航设置
        $breadcrumb_diy = array(
            array('物业服务','#'),
            array('物业缴费',U('tenantlist_news')),
            array('台账','#'),
        );
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $model = new RoomModel();
        //联动选框数据
        //设备类型
        $meter_type_list = $model->get_meter_type_list();
        //用途
        $cate_list = M('house_village_meter_cate')->select();
        $this->assign_json('meter_type_list',$meter_type_list);
        $this->assign_json('cate_list',$cate_list);

        //
        $model = new RoomModel();
        $current_ym = date("Y-m"); //当前年月
        $ym = $ym ?: $current_ym;//年月默认值为当前年月
        $list = $model->preview_list(0,$this->village_id,$ym);
        //数据处理
        foreach($list as &$row){
            unset($row['original_room_data']);
            unset($row['rinfo']);
            //物业与单元号整合
            $row['room_names'] = [];
            $row['roomsizes'] = 0;//物业总面积
            $row['property_price'] = 0; //物业费总合
            foreach($row['property_data'] as $p){
                $row['room_names'][] = $p['room_name'];
                $row['roomsizes'] += $p['roomsize'];
                $row['property_price'] += $p['property_unit'] * $p['roomsize'];
            }
            $row['room_names'] = $model->format_room_str($row['room_names'],',');
        }

        $this->assign_json('list',$list);

        $this->display();



    }


    /**
     * 当月台账
     * @param $ym 指定年月，默认为当前年月
     */
    public function account_list($ym=""){

        //导航设置
        $breadcrumb_diy = array(
            array('物业服务','#'),
            array('物业缴费',U('tenantlist_news')),
            array('台账','#'),
            array('水电费','#'),
        );
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $this->html_option('table_init_length',-1);
        $this->html_option('table_sort',array(1,'asc'));
        //获取数据
        $current_ym = date("Y-m"); //当前年月
        $ym = $ym ?: $current_ym;
        list($year,$month) = explode('-',$ym);
        $model = new RoomModel();
        $list = $model->preview_list(0,$this->village_id,$ym);

        //处理数据
        foreach($list as &$row){
            $row['room_names'] = [];
            $row['roomsizes'] = 0;//物业总面积
            $row['property_price'] = 0; //物业费总合
            foreach($row['property_data'] as $p){
                $row['room_names'][] = $p['room_name'];
                $row['roomsizes'] += $p['roomsize'];
                $row['property_price'] += $p['property_unit'] * $p['roomsize'];
            }
            $row['room_names'] = $model->format_room_str($row['room_names'],'<br />');
        }
        unset($row);

        //dump($list);exit();
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $this->assign('combine_status_list',$model->get_combine_status('all'));
        $this->assign('meter_type_list',$model->get_meter_type_list());
        $this->assign('_meter_type_id',I('get.meter_type_id',1));
        $this->assign('price_type_list',$model->get_price_type_list());
        $this->assign('list',$list);
        $this->assign('_ym',$ym);
        $this->assign("year",$year);
        $this->assign("month",$month);
        $this->display();

    }

    /**
     * 物业费台账
     */
    public function property_account_list($ym=""){
        //导航设置
        $breadcrumb_diy = array(
            array('物业服务','#'),
            array('台账','#'),
            array('物业费','#'),
        );
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $this->html_option('table_init_length',-1);
        $this->html_option('table_sort',array(1,'asc'));

        //获取数据
        $current_ym = date("Y-m"); //当前年月
        $ym = $ym ?: $current_ym;
        list($year,$month) = explode('-',$ym);
        $model = new RoomModel();
        $list = $model->preview_list(0,$this->village_id,$ym);

        //处理数据
        foreach($list as &$row){
            $row['room_names'] = [];
            $row['roomsizes'] = 0;//物业总面积
            $row['property_price'] = 0; //物业费总合
            foreach($row['property_data'] as $p){
                $row['room_names'][] = $p['room_name'];
                $row['roomsizes'] += $p['roomsize'];
                $row['property_price'] += $p['property_unit'] * $p['roomsize'];
            }
            $row['room_names'] = $model->format_room_str($row['room_names'],'<br>');
        }
        unset($row);


        //dump($list);exit();
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $this->assign('list',$list);
        $this->assign("year",$year);
        $this->assign("month",$month);
        $this->display();
    }

    /**
     * 其他费用台账
     */
    public function other_account_list($ym=""){
        //导航设置
        $breadcrumb_diy = array(
            array('物业服务','#'),
            array('台账','#'),
            array('其他费用','#'),
        );

        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $this->html_option('table_init_length',-1);
        $this->html_option('table_sort',array(1,'asc'));

        //获取数据
        $current_ym = date("Y-m"); //当前年月
        $ym = $ym ?: $current_ym;
        list($year,$month) = explode('-',$ym);
        $model = new RoomModel();
        $list = $model->preview_list(0,$this->village_id,$ym);

        //处理数据
        foreach($list as &$row){
            $row['room_names'] = [];
            $row['roomsizes'] = 0;//物业总面积
            $row['property_price'] = 0; //物业费总合
            foreach($row['property_data'] as $p){
                $row['room_names'][] = $p['room_name'];
                $row['roomsizes'] += $p['roomsize'];
                $row['property_price'] += $p['property_unit'] * $p['roomsize'];
            }
            $row['room_names'] = $model->format_room_str($row['room_names'],'<br />');
            $row['other_price'] = array_pop(unserialize($row['use_other']));
        }
        unset($row);



        //dump($list);exit();
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $this->assign('list',$list);
        $this->assign("year",$year);
        $this->assign("month",$month);
        $this->display();
    }


    /**
     * 打印台账
     */
    public function out_account_list($ym="",$meter_type_id=1){
        //获取数据
        $current_ym = date("Y-m"); //当前年月
        $ym = $ym ?: $current_ym;
        $model = new RoomModel();
        $list = $model->preview_list(0,$this->village_id,$ym);

        $listArray = array();



       //处理数据
        foreach($list as $key=>&$row){
            $row['room_names'] = [];
            $row['roomsizes'] = 0;//物业总面积
            $row['property_price'] = 0; //物业费总合
            foreach($row['property_data'] as $p){
                $row['room_names'][] = $p['room_name'];
                $row['roomsizes'] += $p['roomsize'];
                $row['property_price'] += $p['property_unit'] * $p['roomsize'];
            }

            $row['room_names'] = $model->format_room_str($row['room_names'],',');
            $row['room_names_order'] = (float)str_replace('F','.',$row['room_names']);
        }

        unset($row);

        array_multisort(array_column($list,'room_names_order'),SORT_ASC,$list);

        foreach ($list as $kk=>$vv){
            if(count($vv['room_data'])==0||array_key_exists('',$vv['room_data'])){
                $listArray[$kk] = $vv;
                unset($list[$kk]);
            }
        }

        $list = array_merge($list,$listArray);


        //vd($list);exit();
        $price_type_list = $model->get_price_type_list();
        ini_set('max_execution_time', '0');
        import('@.ORG.phpexcel.PHPExcel');
        if($meter_type_id == 1)$fileName = $ym.'施工或客户用表水表清单';else$fileName = $ym.'施工或客户用表电表清单';

        $phpexcel = new PHPExcel();
        //设置基本信息
        $phpexcel->getProperties()->setCreator("admin")
            ->setLastModifiedBy(session('system.account'))
            ->setTitle($ym.'施工或客户用表水电表清单')
            ->setSubject("清单列表")
            ->setDescription("")
            ->setKeywords("清单列表")
            ->setCategory("");
        $phpexcel->setActiveSheetIndex(0);
        $phpexcel->getActiveSheet()->setTitle($fileName);
        //填入主标题
        $phpexcel->getActiveSheet()->setCellValue('A1', $fileName);
        //填入副标题
        $phpexcel->getActiveSheet()->setCellValue('A2', '清单列表(导出日期：'.date('Y-m-d',time()).')');

        //合并单元格
        $phpexcel->getActiveSheet()->mergeCells('A1:L1');
        $phpexcel->getActiveSheet()->mergeCells('A2:L2');

        //设置字体样式
        $phpexcel->getActiveSheet()->getStyle('A1')->getFont()->setName('黑体');
        $phpexcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
        $phpexcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);



        //填入表头
        $phpexcel->getActiveSheet()->setCellValue('A3', '单元号');
        $phpexcel->getActiveSheet()->getStyle('A3')->getFont()->setName('黑体');
        $phpexcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('B3', '入住单位（客户名称）');
        $phpexcel->getActiveSheet()->getStyle('B3')->getFont()->setName('黑体');
        $phpexcel->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('C3', '业主');
        $phpexcel->getActiveSheet()->getStyle('C3')->getFont()->setName('黑体');
        $phpexcel->getActiveSheet()->getStyle('C3')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('D3', '计费类型');
        $phpexcel->getActiveSheet()->getStyle('D3')->getFont()->setName('黑体');
        $phpexcel->getActiveSheet()->getStyle('D3')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('E3', '设备号');
        $phpexcel->getActiveSheet()->getStyle('E3')->getFont()->setName('黑体');
        $phpexcel->getActiveSheet()->getStyle('E3')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('F3', '上月止码');
        $phpexcel->getActiveSheet()->getStyle('F3')->getFont()->setName('黑体');
        $phpexcel->getActiveSheet()->getStyle('F3')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('G3', '本月止码');
        $phpexcel->getActiveSheet()->getStyle('G3')->getFont()->setName('黑体');
        $phpexcel->getActiveSheet()->getStyle('G3')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('H3', '用量');
        $phpexcel->getActiveSheet()->getStyle('H3')->getFont()->setName('黑体');
        $phpexcel->getActiveSheet()->getStyle('H3')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('I3', '单价');
        $phpexcel->getActiveSheet()->getStyle('I3')->getFont()->setName('黑体');
        $phpexcel->getActiveSheet()->getStyle('I3')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('J3', '倍率');
        $phpexcel->getActiveSheet()->getStyle('J3')->getFont()->setName('黑体');
        $phpexcel->getActiveSheet()->getStyle('J3')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('K3', '费用');
        $phpexcel->getActiveSheet()->getStyle('K3')->getFont()->setName('黑体');
        $phpexcel->getActiveSheet()->getStyle('K3')->getFont()->setBold(true);
        $phpexcel->getActiveSheet()->setCellValue('L3', '总计');
        $phpexcel->getActiveSheet()->getStyle('L3')->getFont()->setName('黑体');
        $phpexcel->getActiveSheet()->getStyle('L3')->getFont()->setBold(true);



        $k = 1;
        foreach ($list as $key=>$value){
            $total_price=0;

            if(count($value['room_data'])==0||array_key_exists('',$value['room_data'])){

                //设置居中
                $phpexcel->getActiveSheet()->getStyle('A1:L1'.($k+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                //所有垂直居中
                $phpexcel->getActiveSheet()->getStyle('A1:L2'.($k+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

                //保存数据

                //入住单位（客户名称）
                $phpexcel->getActiveSheet()->setCellValue('B'.($k+3), $value['tenantname']);
                //业主
                $phpexcel->getActiveSheet()->setCellValue('C'.($k+3), $value['ownernames']);
                $k++;
            }else{
                foreach ($value['room_data'] as $kk=>$vv){
                    foreach ($vv as $sk=>$sv){
                        if($kk==$meter_type_id){
                            //保存数据
                            //单元号
                            $phpexcel->getActiveSheet()->setCellValue('A'.($k+3), $value['room_names']);
                            //入住单位（客户名称）
                            $phpexcel->getActiveSheet()->setCellValue('B'.($k+3), $value['tenantname']);
                            //业主
                            $phpexcel->getActiveSheet()->setCellValue('C'.($k+3), $value['ownernames']);

                            //计费类型
                            $phpexcel->getActiveSheet()->setCellValue('D'.($k+3), $price_type_list[$sv['price_type_id']]);
                            //设备号
                            $phpexcel->getActiveSheet()->setCellValue('E'.($k+3), $sv['meter_code']);
                            //上月止码
                            $phpexcel->getActiveSheet()->setCellValue('F'.($k+3), $sv['last_total_consume']);
                            //本月止码
                            $phpexcel->getActiveSheet()->setCellValue('G'.($k+3), $sv['total_consume']);
                            //用量
                            $phpexcel->getActiveSheet()->setCellValue('H'.($k+3), $sv['consume']);
                            //单价
                            $phpexcel->getActiveSheet()->setCellValue('I'.($k+3), $sv['unit_price']);
                            //倍率
                            $phpexcel->getActiveSheet()->setCellValue('J'.($k+3), $sv['rate']);
                            //费用
                            $phpexcel->getActiveSheet()->setCellValue('K'.($k+3), $sv['cost']);
                            //总计
                            $total_price+=$sv['cost'];
                            $lastValue = end($vv)['total_consume'];
                            if($lastValue == $sv['total_consume']){
                                $phpexcel->getActiveSheet()->setCellValue('L'.($k+3), $total_price);
                            }else{
                                $phpexcel->getActiveSheet()->setCellValue('L'.($k+3), '');
                            }

                            $k++;
                        }

                    }
                }
            }
        }

        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=$fileName.xls");
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0
        $objwriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel5');
        $objwriter->save('php://output');
        exit;

    }

    /**设备基础配置****************************************************************************************************/
    /*************************************************************************************************************/
    /**
     * 设备基础配置页（已弃用，跳转到meter_config_list）
     */
    public function meter_custom_config_news(){
        $this->redirect('Room/meter_config_list');
        exit();

//        $model = new RoomModel();
//        $list = $model->meter_config_list();
//        $list = list_to_tree($list,'id','pid','_child');
////        dump($list);
//        $this->assign_json('list',$list);
//        $this->display();
    }

    /**
     * 设备配置页
     */
    public function meter_config_list(){
        //导航设置
        $breadcrumb_diy = array(
            array('物业服务','#'),
            array('设备管理',U('meterlist_news')),
            array('设备类型配置','#'),
        );

        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $model = new RoomModel();
        $list = $model->meter_config_list();
        $list = list_to_tree($list,'id','pid','_child');
        $this->assign_json('village_list',$model->get_village_list());
        $this->assign('list',$list);
        $this->assign('is_admin',$this->is_admin($this->admin_id));
        $this->display();
    }


    /**
     * 查看自定义设备弹出层
     * @param $config_id
     */
    public function modal_custom_config($config_id){
        $model = new RoomModel();
        $config = $model->meter_config_info($config_id);
        $this->assign_json('custom_config',$config['custom_config']);
        $this->assign('modal_title',$config['desc']);
        $this->display();
    }

    /**
     * 设备编辑弹出层
     * @param $config_id
     */
    public function modal_edit_config($config_id){
        $model = new RoomModel();
        $config = $model->meter_config_info($config_id);
        //$price_configs = $model->meter_config_list(0,$config_id);
        // $config = $model->meter_config_info($config_id);
        //展示的项目数量  超级管理员显示全部 by zhukeqin
        if($this->is_admin($this->admin_id)){
            $village_list=$model->get_village_list(array('status'=>'1'));
        }else{
            $village_list=$model->get_village_list(array('status'=>'1','village_id'=>$this->village_id));
        }
        $search1=$model->meter_config_village_list(0,$config_id,0);

        //判断，是否是专业设备 113        
        // $idArray = array('113');
        // $is_set = in_array($config_id, $idArray);
        // $this->assign('is_set',$is_set);
               
        if ($config_id == 113) {
            // var_dump($config_id);
            $config_new=array(
                'cate'=> '',
                'custom_config'=>'',
                'desc'=> "",
                'pid'=>"",
                'rate'=> 0,
                'sign'=> "",
                'unit'=> "",
                'unit_price'=> 0.00,
                'village_id'=> '',
                'desc'=>"新建参数配置",
                'pid'=>$config_id
            );
            $this->assign('config_id',$config_id);
        } else {
            $config_new=array(
                'cate'=> '',
                'custom_config'=>'',
                'desc'=> "",
                'pid'=>"",
                'rate'=> 0,
                'sign'=> "",
                'unit'=> "",
                'unit_price'=> 0.00,
                'village_id'=> '',
                'desc'=>"新建计费配置",
                'pid'=>$config_id
            );
        }        
        
        //拼接通用设备类型和项目专属设备类型
        foreach ($village_list as $k=>$v){
            $search2=$model->meter_config_village_list(0,$config_id,$k);
            $price_configs[$k]=array_merge((array)$search1,(array)$search2);
            //如果为空就添加新建计费类型 by zhukeqin
            if(empty($price_configs[$k]['0']['desc'])){
                $config_new['village_id']=$k;
                $price_configs[$k][]=$config_new;
            }
        }
        // echo "<pre>";
        // var_dump($price_configs);
        // echo "</pre>";exit();
        $this->assign_json('village_id',$this->village_id);
        $this->assign_json('village_list',$village_list);
        $this->assign_json('config',$config);
        $this->assign_json('price_configs',$price_configs);
        $this->assign('modal_title',$config['desc']);
        $this->display();
    }

    /**
     * 根据key判断该点位是否存在
     */
    public function check_sign(){
        $sign = I('post.sign');
        $res= M('re_setmeter_config')->where(array('sign'=>$sign))->select();
        if ($res) {
            $message = $res;
        }
        echo $message;
    }

   /**
     * 根据key判断该点位是否存在
     */
    public function check_key(){
        $key = I('post.key');
        $res= M('re_setmeter_config_custom')->where(array('key'=>$key))->select();
        if ($res) {
            $message = $res;
        }
        echo $message;
    }

    /**
     * 根据id判断该点位是否存在
     */
    public function check_id(){
        $id = I('post.id');
        $re1= M('re_setmeter_config')->where(array('id'=>$id))->select();
        $re2= M('re_setmeter_config')->where(array('pid'=>$id))->select();
        // var_dump($re1);
        // var_dump($re2);
        if (($re1[0]['id'] == 113) || ($re2[0]['pid'] == 113)) {
            $message = true;
        } else {
            $message = false;
        }
        echo $message;      
    }

    /**
     * 根据id查询其二级分类
     */
    public function get_cates(){
        $id = I('post.id');        
        $cates = M('house_village_meter_cate')->where(array('meter_type_id'=>$id))->select(); 
        $cates = json_encode($cates);
        echo $cates;                    
    }


    /**
     * 编辑计费配置
     * @param $config_id
     */
    public function modal_edit_price_config($config_id){
        $model = new RoomModel();
        $config = $model->meter_config_list(0,$config_id);
        $this->assign_json('config',$config);
        $this->assign('modal_title',$model->get_meter_type_list()[$config_id]);
        $this->display();
    }

    /**
     * 获取自定义配置
     * @param $config_id
     */
    public function ajax_get_custom_config($config_id){
        $model = new RoomModel();
        $config = $model->meter_config_info($config_id);
        $this->success("获取成功","",$config['custom_config']);
    }

    /**
     * 保存配置
     */
    public function save_config(){
        $data = file_get_contents("php://input");
        $data = htmlspecialchars_decode($data);
        $data = json_decode($data,true);
        $model = new RoomModel();
        // if(empty($data['sign'])){
        //     $re = false;
        // }else{
        //     $re = $model->save_config($data);
        // }
        $re = $model->save_config($data);

        if($re!==false){
            $config_id = $re;
            $config_info = $model->meter_config_village_list($config_id);
            $this->success("保存成功","",$config_info);
        }else{
            $this->error("请填写标记","",$data);
        }
        
    }

    /**
     * 删除配置
     * @param $config_id
     */
    public function del_config($config_id){
        $model = new RoomModel();
        $re = $model->del_config($config_id);
        if($re){
            $this->success("删除成功","",$config_id);
        }else{
            $this->error("发送错误");
        }

    }

    /**
     * 添加配置
     */
    public function add_config(){
        //导航设置
        $breadcrumb_diy = array(
            array('物业服务','#'),
            array('设备配置',U('Room/meter_config_list')),
            array('添加配置','#'),
        );

        $model = new RoomModel();
        $meter_type_list = $model->get_meter_type_list();
        $meter_type_list[0] = "新的设备";
        $this->assign_json('meter_type_list',$meter_type_list);
        $this->assign('breadcrumb_diy',$breadcrumb_diy);
        $this->display();
    }

    /**
     * 没什么实际作用，在add_config已经异步添加了
     * 这个只是为了与其他提交表单看起来一致
     */
    public function add_config_act($err=0){
        if($err==0){
            $this->success("添加成功",U('meter_config_list'));
        }else{
            $this->error("发送错误",U('add_config'));
        }
    }


    /**
     * 设备用途类型参数编辑
     * @param $cate_id
     */
    public function modal_edit_cate($cate_id){
        // var_dump($cate_id);
        $model = new RoomModel();
        $cate = $model->meter_cate_info($cate_id);

        //判断是否为工程部设备,是则选择2模板，不是则选择1模板
        $meter_type_id = M('house_village_meter_cate')->where(array('id'=>$cate_id))->getField('meter_type_id');       
        if ($meter_type_id == 113) {
            // var_dump($meter_type_id);
            $this->assign('meter_type_id',$meter_type_id);
        }

        $this->assign_json('cate',$cate);
        $this->assign('modal_title',$cate['desc']);
        $this->display();
    }


    /**
     * 保存设备用途配置
     * @param $cate_id
     */
    public function save_cate(){
        $data = file_get_contents("php://input");
        $data = htmlspecialchars_decode($data);
        $data = json_decode($data,true);
        $model = new RoomModel();
        $re = $model->save_cate($data);
        if($re!==false){
            $cate_id = $re;
            $config_info = $model->meter_cate_info($cate_id);
            $this->success("保存成功","",$config_info);
        }else{
            $this->error("发生错误","",$data);
        }
    }

    /**
     * 删除自定义配置
     * TODO 该配置存在绑定设备的时候需要做出提示
     * @param $cate_id
     */
    public function del_cate($cate_id){
        $model = new RoomModel();
        $re = $model->del_cate($cate_id);
        if($re!==false){
            $this->success("删除成功");
        }else{
            $this->error("删除失败");
        }

    }

    /**
     * 删除自定义配置
     * TODO 该配置存在绑定设备的时候需要做出提示
     * @param $cate_id
     */
    public function del_meter_cate($cate_id){
        $model = new RoomModel();
        $re = $model->del_meter_cate($cate_id);
        if($re!==false){
            $this->success("删除成功");
        }else{
            $this->error("删除失败");
        }

    }

    /**
     * 设备用途所绑定的设备
     * @param $cate_id
     */
    public function modal_cate_meters($cate_id){
        $model = new RoomModel();
        $cate = $model->meter_cate_info($cate_id);

        $meters = M('house_village_meters')->where('find_in_set("%s",cate_id)',$cate_id)->select();
        foreach($meters as &$row){
            $row['custom_info'] = $model->get_custom_info($row['meter_hash'],$cate_id);
        }
        unset($row);

        //关闭绑定弹出层需要用到，直接ajax返回设备信息
        if(I('get.reset')){
            $this->success("成功","",$meters);
        }

        $this->assign_json('meters',$meters);
        $this->assign('modal_title',$cate['desc']);
        $this->assign('cate_id',$cate_id);
        $this->display();
    }

    /**
     * 设备用途绑定设备
     * @param $cate_id
     */
    public function modal_cate_bind_meter($cate_id){
        $model = new RoomModel();
        $cate = $model->meter_cate_info($cate_id);

        $this->assign_json('cate',$cate);
        $this->assign('modal_title',$cate['desc']);
        $this->assign('cate_id',$cate_id);
        $this->assign('meter_type_id',$cate['meter_type_id']);


        $floor_list         = $model->floor_list(); //楼层
        $meter_list         = $model->meterlist_for_tenant();//设备
        $meter_type_list    = $model->get_meter_type_list();//设备类型列表
        $village_list       = $model->get_village_list();//社区列表

        $this->assign_json('floor_list',$floor_list);
        $this->assign_json('meter_type_list',$meter_type_list);
        $this->assign_json('floor_list',$floor_list);
        $this->assign_json('meter_list',$meter_list);
        $this->assign_json('village_list',$village_list);



        $this->display();
    }

    /**
     * 用途绑定设备
     * @param $cate_id
     * @param $meter_hash
     */
    public function cate_bind_meter_act($cate_id,$meter_hash){
        $model = M('house_village_meters');
        //数据库cate_id
        $db_cate_id = $model->where('meter_hash="%s"',$meter_hash)->getField('cate_id');
        //新的cate_id
        $cate_id = add_set($cate_id,$db_cate_id);
        $re = $model->where('meter_hash="%s"',$meter_hash)->setField('cate_id',$cate_id);
        if($re!==false){
            $model = new RoomModel();
            $meter_info = $model->meterinfo_for_tenant($meter_hash);
            $this->success("成功","",$meter_info);
        }else{
            $this->error("发生错误");
        }

    }

    /**
     * 用途解绑设备
     * @param $cate_id
     * @param $meter_hash
     */
    public function cate_unbind_meter_act($cate_id,$meter_hash){
        //数据库cate_id
        $model = M('house_village_meters');
        $db_cate_id = $model->where('meter_hash="%s"',$meter_hash)->getField('cate_id');
        //新的cate_id
        $cate_id = del_set($cate_id,$db_cate_id);
        $re = $model->where('meter_hash="%s"',$meter_hash)->setField('cate_id',$cate_id);
        if($re!==false){
            $model = new RoomModel();
            $meter_info = $model->meterinfo_for_tenant($meter_hash);
            $this->success("成功","",$meter_info);
        }else{
            $this->error("发生错误");
        }
    }

    /**
     * 获取设备的自定义配置
     * @param $meter_hash
     */
    public function get_custom_info($meter_hash){
        $model = new RoomModel();
        $info  = $model->get_custom_info($meter_hash);

        if($info!==false){
            $this->success("成功","",$info);
        }else{
            $this->error("获取失败","",M()->getLastSql());
        }

    }

    /**
     * 保存设备额外属性
     */
    public function save_meter_custom(){
        $data = file_get_contents("php://input");
        $data = htmlspecialchars_decode($data);
        $data = json_decode($data,true);

        $model = new RoomModel();
        $re = $model->save_meter_custom($data);
        if($re!==false){

            $this->success("成功","",$model->get_custom_info($data[0]['meter_hash']));
        }else{
            $this->error("失败","",mysql_error() . M()->getLastSql());
        }
    }


    public function change_fstatus($oids,$status){
        $arr = explode(',',$oids);
        if(!$arr) return false;
        $map = array();
        $map['id'] = array('in',$arr);
        $re = M('house_village_owner')->where($map)->setField('fstatus',$status);
        if($re!==false){
            $this->success("修改成功",'',M()->getLastSql());
        }else{
            $this->error("发生错误",'',mysql_error());
        }
    }

    /**其他****************************************************************************************************/
    /*************************************************************************************************************/

    /**
     * 兼容ajax的success和error方法
     * @param string $message
     * @param string $jumpUrl
     * @param bool|mixed $data
     */
    protected function success($message='',$jumpUrl='',$data){
        if(IS_AJAX==1){

            $this->ajaxReturn(array('err'=>0,'msg'=>$message,'data'=>$data));

        }else{

            parent::success($message,$jumpUrl,false);

        }
    }

    protected function error($message='',$jumpUrl='',$data){
        if(IS_AJAX==1){

            $this->ajaxReturn(array('err'=>__LINE__,'msg'=>$message,'data'=>$data));

        }else{

            parent::error($message,$jumpUrl,false);

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

    /**
     * 前端配置
     * @param $option
     * @param $val
     * @return bool 设置成功 返回 true
     */
    protected function html_option($option,$val){
        static $options = array(
            'table_init_length'=>'15', //默认列表初始长度
            'table_sort'=>'[1,"desc"]' //默认排序
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

    //手动设置抄表时间
    public function setTime() {
        if (IS_POST) {
            $start_time = strtotime(I('post.start_time'));
            $end_time = strtotime(I('post.end_time'));
            if ($end_time < $start_time) $this->error('请重新设置');
            if (!$start_time || !$end_time) $this->error('请重新设置');
            $village_id = $_SESSION['system']['village_id'];
            if ($village_id != 4)  $this->error('其它社区设置时间未开放');
            $re = D('house_village_meters')
                ->where(array('village_id'=>$village_id,'is_del'=>0))
                ->save(array('set_start_time'=>$start_time,'set_end_time'=>$end_time));
            if ($re) {
                $this->success('设置成功');
            } else{
                $this->error('设置失败');
            }
        } else {
            $this->error('设置失败');
        }
    }
    /**
     * 判断是否是超级管理员
     * @author zhukeqin
     * @return bool  是超级管理员则为true
     */
    public function is_admin($admin_id){
        if($admin_id==1){
            return true;
        }else{
            return false;
        }
    }
    /**
     * @author zhukeqin
     * 小区账单添加新的项目和价格
     *
     */
    public function add_other_uptown(){
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
        //vd($newArray);exit;
        //计算总价格
        $other_total_price =0;
        $total_price =$payListInfo['total_price']-$payListInfo['other_price'];
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
        $model=new RoomModel();
        if($model->get_livetype($this->village_id,'other')==false){
            unset($addDate['total_price']);
            unset($addDate['other_price']);
            $total_price=$payListInfo['total_price'];
        }
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
     * @author zhukeqin
     * 单个编辑水电物业费
     */
    public function edit_this_other_uptown(){
        $field = I('post.field');
        $value = I('post.value');
        $id = I('post.id');
        $check_field=array('water','electric','gas','park','property');
        //field必须是指定字段
        if(!in_array($field,$check_field)){

        }
        //value必须为数字
        if(!is_numeric($value)){
            echo 2;
            die;
        }
        if(!$id){
            echo 2;
        }else{
            $model=new RoomModel();
            //查询该费用是否需要缴费
            $return=$model->get_livetype($this->village_id,$field);
            //获取数据
            $payinfo=M('house_village_user_paylist')->where(array('pigcms_id'=>$id))->find();
            if($return){
                $data=array(
                    'use_'.$field=>$value,
                    $field.'_price'=>$value,
                    'total_price'=>$payinfo['total_price']+$value,
                );
            }else{

            }
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


}