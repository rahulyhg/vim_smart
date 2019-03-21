<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/14
 * Time: 16:34
 * @update-time: 2017-08-14 17:09:04
 * @author: 王亚雄
 * 抄表控制器
 */
class MeterAction extends BaseAction{
    protected $menu_id = 191;//同步于后台抄表目录ID
    public function __construct()
    {

        parent::__construct();
        //$_SESSION['user']['uid'] = 2070;//李工的uid
        $this->check_admin();
    }



    /**
     * 权限控制
     */
//    protected function check_admin(){
//        //dump($_SESSION);exit();
//        $role_id = user_info()['role_id'];
//
////        dump(user_info());exit;
////        echo M()->getLastSql();
////        dump($role_id);
//        $allow_menus = M('role','pigcms_')->where('role_id=%d',$role_id)->getField('menus');
//        $allow_menus_arr = explode(',',$allow_menus);
//        if(!in_array($this->menu_id,$allow_menus_arr)){
//            $this->error("你没有权限！");
//        }
//
////        if(session('user.uid')!=1548){
////            exit("功能调试中..");
////        }
//
//    }

    /**
     * 多角色权限控制
     * 曾梦飞
     * 2018-03-28
     */
    protected function check_admin(){
        $role_idStr = user_info()['role_id'];
        $role_idArr = explode(',',$role_idStr);
        $allow_menus = '';
        foreach ($role_idArr as $v) {
            $str = M('role','pigcms_')->where('role_id=%d',$v)->getField('menus');
            $allow_menus .= $str.',';
        }
        $allow_menus = trim($allow_menus,',');

        $allow_menus_arr = array_unique(explode(',',$allow_menus));

        if(!in_array($this->menu_id,$allow_menus_arr)){
            $this->error("你没有权限！");
        }

//        if(session('user.uid')!=1548){
//            exit("功能调试中..");
//        }

    }

    /**
     * 扫码抄表页面
     * @param $usernum
     * @param $sign
     */
    public function enter($meter_hash){

        $model = new MeterModel();
        $meter_info = $model->get_meter_info($meter_hash);
        if(!$meter_info) $this->error("未找到该设备");
        $meter_info['tenantname'] = M('house_village_room')->alias('r')
            ->field('tenantname')
            ->join('__HOUSE_VILLAGE_USER_BIND__ t on find_in_set(t.pigcms_id,r.tid)')
            ->where('find_in_set("%s",r.meter_hash)',$meter_hash)
            ->select();
        if(mb_strpos($meter_info['meter_floor'],'商')===0){
            $meter_info['meter_floor']=M('house_village_room')->where('id='.$meter_info['room_id'])->find()['room_name'];
        }
        $meter_info['tenantname'] = join(',',array_unique(array_column($meter_info['tenantname'],'tenantname')));
        $meter_info['rate'] = floor($meter_info['rate']);
        // var_dump($meter_info['unit']);exit();
        $this->assign('meter_info',$meter_info);
        $this->display();
    }
    //修改上月止码 ，pigcms_house_village_meters 的 be_cousume的值 和 pigcms_re_setmeter last_total_consume 的值
    public function update_last_cousume($meter_hash,$set_val,$record_id=0){
        $model =  M('house_village_meters');
        $db_be_cousume = $model->where('meter_hash="%s"',$meter_hash)->getField('be_cousume');
        $db_be_date = $model->where('meter_hash="%s"',$meter_hash)->getField('be_date');
        //$a 为上上月的止码 这个值是不会变的
        list($a,$b) = explode(',',$db_be_cousume);
        list($c,$d) = explode(',',$db_be_date);
        $last_month=date('Y-m',strtotime('-1 month'));
        $c_last_month=date('Y-m',strtotime($c));
        if($c_last_month==$last_month){
            $update_be_cousume =  $set_val . ',' . $b;
        }else{
            $update_be_cousume =  $a . ',' . $set_val;
        }
        //开启事务
        $model->startTrans();
        $re = $model->where('meter_hash="%s"',$meter_hash)->setField('be_cousume',$update_be_cousume);
        $re2 = true;
        //修改已抄记录的上月止码
        if($record_id){
            $re2 = M('re_setmeter')->where('id=%d',$record_id)->setField('last_total_consume',$set_val);
        }
        $error = mysql_error();
        if($re!==false&&$re2!==false){
            $model->commit();
            $this->suc("修改完成");
        }else{
            $model->rollback();
            $this->err("发生错误",$error);
        }
    }
    /**
     * 添加数据
     */
    public function add_data(){
        $model=new MeterModel();
        $data = $_POST;
        $info = $model->where('meter_hash="%s"',$data['meter_hash'])->find();
        //数据组装
        $data['admin_id'] = user_info()['admin_id']?:0;
        $data['create_time'] = time();
        $data['ym'] = date("Y-m");
        $data['uid'] = session('user.uid');
        if(sprintf("%02d", $data['month'])!=intval(date("m"))){//选择非当月 月份时提交
            $data['ym'] = date("Y") .'-'. sprintf("%02d", $data['month']) . '-' . date('d');
            $data['create_time'] = strtotime($data['ym']);
        }else{
            //当为当前月份时进行处理  是否重复抄表
            $be_date=explode(',',$info['be_date']);
            if(date('Y-m',strtotime($be_date['1']))==$data['ym']){
                $data['last_total_consume']=explode(',',$info['be_cousume'])['0'];
            }else{
                $data['last_total_consume']=explode(',',$info['be_cousume'])['1'];
            }
        }
        $num = M('re_setmeter','pigcms_')->add($data);
        if($num){
            //判断是否为当前月份
            if($data['month']==intval(date("m"))){
                $model->set_be_cousume($data['meter_hash'],$data['last_total_consume'],$data['total_consume'],$data['ym']);
            }

            $this->redirect(U("success_act"));
//            $this->success("添加成功");
        }else{
            $this->error("失败" . mysql_error());
        }
    }

    public function success_act(){
        $this->display();
    }


    /**
     * 抄表记录
     */
    public function meter_record($ym=""){
        $ym = $ym?:date("Y-m");
        $village_id = user_info()['village_id'];
        $model = new RoomModel();
        $list = $model->meter_record($ym,-1,$village_id);
        $this->assign_json('list',$list);
        $this->assign('ym',$ym);

        $this->display('meter_record');
    }



    public function meter_record2($ym=""){
        $ym = $ym?:date("Y-m");
        $village_id = user_info()['village_id'];
        $model = new RoomModel();
        $list = $model->meter_record($ym,-1,$village_id);
        //计算抄录数与为抄录数
        $meter_count = count($list);
        $record_meter_count = 0;
        foreach ($list as $row){
            if($row['is_record']){
                $record_meter_count++;
            }
        }

        $this->assign('meter_count',$meter_count);
        $this->assign('record_meter_count',$record_meter_count);


        $this->assign_json('list',$list);
        $this->assign('ym',$ym);

        $floor_list = $model->floor_list(); //楼层



        $meter_type_list = $model->get_meter_type_list();//设备类型列表
        $village_list = $model->get_village_list();//社区列表

        $meter_type_list[0] = "选择设备类型";
        $floor_list[0] = "选择楼层";
        $floor_list[999] = "未知楼层";
        $this->assign('floor_list',$floor_list);

        $this->assign_json('meter_type_list',$meter_type_list);
        $this->assign_json('floor_list',$floor_list);
        //$meter_list = $model->meterlist_for_tenant();//设备
        //$this->assign_json('meter_list',$meter_list);
        $this->assign_json('village_list',$village_list);

        $this->display('meter_record2');
    }



    public function meter_record3(){
//        dump($_SESSION);exit;
        $ym = date("Y-m",I('get.ym'));
        $village_id = I('get.village_id');
        $model = new RoomModel();
        $list = $model->meter_record($ym,-1,$village_id);
        //计算抄录数与为抄录数
        $meter_count = count($list);
        $record_meter_count = 0;
        foreach ($list as $row){
            if($row['is_record']){
                $record_meter_count++;
            }
        }

        $this->assign('meter_count',$meter_count);
        $this->assign('record_meter_count',$record_meter_count);


        $this->assign_json('list',$list);
        $this->assign('ym',$ym);

        $floor_list = $model->floor_list(); //楼层



        $meter_type_list = $model->get_meter_type_list();//设备类型列表
        $village_list = $model->get_village_list();//社区列表

        $meter_type_list[0] = "选择设备类型";
        $floor_list[0] = "选择楼层";
        $floor_list[999] = "未知楼层";
        $this->assign('floor_list',$floor_list);

        $this->assign_json('meter_type_list',$meter_type_list);
        $this->assign_json('floor_list',$floor_list);
        //$meter_list = $model->meterlist_for_tenant();//设备
        //$this->assign_json('meter_list',$meter_list);
        $this->assign_json('village_list',$village_list);

        $this->display('meter_record2');
    }
    /**
     * 获取指定月份的抄表记录
     * @param $meter_hash
     * @param $month
     */
    public function get_month_record($meter_hash,$month){
        $date = date("Y") . "-" . sprintf('%02s', $month);;
        //指定年月的抄表数据sql，可视作视图
        $cousume_view =  <<<sql
(
	SELECT
		*, FROM_UNIXTIME(tmp.create_time, '%Y-%m') create_date
	FROM
		(SELECT * FROM pigcms_re_setmeter ORDER BY create_time DESC) AS tmp
    WHERE FROM_UNIXTIME(tmp.create_time, '%Y-%m') = '$date'
	GROUP BY
		tmp.meter_hash,create_date
)
sql;
        $record = M()->table($cousume_view)->alias('c')
            ->where('meter_hash="%s"',$meter_hash)
            ->order('create_time desc')
            ->find();

        if($record!==false){
            $this->suc("成功",$record);
        }else{
            $this->err("失败",mysql_error());
        }

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

    public function test(){
        $role_id = user_info(2070)['role_id'];
        $allow_menus = M('role','pigcms_')->where('role_id=%d',$role_id)->getField('menus');
        $allow_menus_arr = explode(',',$allow_menus);
        if(!in_array($this->menu_id,$allow_menus_arr)){
            echo '你没有权限';
        }else{
            echo 'ok';
        }

        dump(user_info(2648));
    }






}