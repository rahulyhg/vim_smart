<?php
/**
 * Created by PhpStorm.
 * Author: zhukeqin
 * Date: 2018/4/19
 * Time: 10:58
 */
class MeterAction extends BaseAction {
    public function _initialize(){
        parent::_initialize();
        $this->village_id = $this->house_session['village_id'];
        $this->village = D('House_village')->where(array('village_id' => $this->village_id))->find();
        if (empty($this->village)) {
            $this->error('该小区不存在！');
        }
        if ($this->village['status'] == 0) {
            $this->assign('jumpUrl', U('Index/index'));
            $this->error('您需要先完善信息才能继续操作');
        }
    }
    public function index(){

        //$this->html_option('table_init_length',-1);
        $model = new RoomModel();
        $village_id = filter_village(0,2);
        $list = $model->meterlist('',$this->village_id);
        if(IS_AJAX){
            $this->success("获取数据成功","",$list);exit();
        }
        $this->assign_json('meter_type_tree',$model->get_type_tree());
        $this->assign("list",$list);
        $this->display();
    }
    /**
     * 添加设备
     */
    public function add_meter(){
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
     * 添加设备执行
     */
    public function add_meter_act(){
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
    public function get_meter_custom($config_id){
        $data = M('re_setmeter_config_custom')->where('config_id=%d',$config_id)->select();
        if($data!==false){
            $this->success("成功获取自定义设备","",$data?:array());
        }else{
            $this->error("发生错误");
        }

    }
    /**
     * 设备配置页
     */
    public function meter_config_list(){
        $model = new RoomModel();
        $list = $model->meter_config_list();
        $list = list_to_tree($list,'id','pid','_child');
        $this->assign_json('village_list',$model->get_village_list(array('village_id'=>$this->village_id)));
        $this->assign('list',$list);
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
        $village_list=$model->get_village_list(array('status'=>'1','village_id'=>$this->village_id));
        $search1=$model->meter_config_village_list(0,$config_id,0);
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
        //dump($price_configs);
        $this->assign_json('village_id',$this->village_id);
        $this->assign_json('village_list',$village_list);
        $this->assign_json('config',$config);
        $this->assign_json('price_configs',$price_configs);
        $this->assign('modal_title',$config['desc']);
        $this->display();
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
        if(empty($data['sign'])){
            $re = false;
        }else{
            $re = $model->save_config($data);
        }

        if($re!==false){
            $config_id = $re;
            $config_info = $model->meter_config_info($config_id);
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
        $villageid=$model->meter_config_info($config_id)['village_id'];
        if($villageid!=$this->village_id){
            $this->error("您没有权限删除该项");
            die;
        }
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

        $model = new RoomModel();
        $meter_type_list = $model->get_meter_type_list();
        $meter_type_list[0] = "新的设备";
        $this->assign_json('meter_type_list',$meter_type_list);
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
    /*********** 工具方法 ****************/
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
}