<?php
namespace Admin\Logic;
use \Think\Model;
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/5/25
 * Time: 16:50
 */
class RbacLogic extends Model{
    protected $_admin;
    protected $_garage;

    function __construct()
    {
        //构造权限审核权限
        $this->_admin = session('admin_id');
        $this->_garage = M('admin')->where(array('ad_id'=>$this->_admin))->getField('garage_id');

    }
    
    /*
     * 检查是否存在garage_id 存在返回对应值，不存在返回false
     * */
    public function garage_check(){
        if(empty($this->_garage)){
            return false;
        }else{
            return $this->_garage;
        }
    }

    /*
     * 超级管理员列表权限
     * 返回权限列表
     * */
    public function super_admin_list(){
        $left_menu=M('menu')->where(array('auth_type'=>0,'create_type'=>0))->select();


        foreach ($left_menu as $k=>&$v){
            $v['url']=U($v['module'].'/'.$v['action']);

        }
        unset($v);
        $arr=list_to_tree($left_menu,'id','fid','child_list');
        return $arr;
    }

    /*
     *普通后台人员列表，带停车场参数
     * */
    public function common_admin_list($allow_string){
        $allow_array = explode(DELIMITER,$allow_string);
        //显示权限
        if(in_array(44,$allow_array)){
            session('show_state',1);
        }elseif (in_array(45,$allow_array)){
            session('show_state',2);
        }else{
            session('show_state',0);
        }
        //左边菜单栏
        $left_menu=M()->query("select * from ".C('DB_PREFIX')."menu where id in ($allow_string) and auth_type=0 and create_type=0");
        $arr=array();
        foreach ($left_menu as $k=>&$v){
            $v['url']=U($v['model'].'/'.$v['module'].'/'.$v['action']);
            if($v['fid']==0){
                $arr[$v['id']]=$v;
            }else{
                $arr[$v['fid']]['child_list'][]=$v;
            }
        }
        unset($v);
        return $arr;
    }

    /*
     *检查权限的数组
     * */
    public function check_auth($role_id){
        if(empty($role_id)){
            $res_arr = M('admin')->where(array('ad_id'=>$this->_admin))->find();
            $role_id = $res_arr['role_id'];
        }
        $allow_string=M('role')->where(array('role_id'=>$role_id))->find();
        $allow_string=$allow_string['role_auth_ids'];
        return $allow_string;
    }


    /*
     * 单个停车场的处理
     * */
    public function get_garage_name($garage_id){
        $untreated_name = M('garage')->where(array('garage_id'=>$garage_id))->getField('garage_name');
        return mb_substr($untreated_name,0,2,'utf8');
    }

    /*
     * 处理存在多个停车场的garage_id,切获取停车场名称前两位，
     * 存在多个停车场的默认进入第一个停车场
     * */
    public function deal_srting_garage_id(){
        if(strpos($this->_garage,DELIMITER)){
            //存在多个停车场id
            $garage_id_array = explode(DELIMITER,$this->_garage);
            $untreated_name = M('garage')->where(array('garage_id'=>$garage_id_array[0]))->getField('garage_name');
        }else{
            $untreated_name = M('garage')->where(array('garage_id'=>$this->_garage))->getField('garage_name');
        }
        return mb_substr($untreated_name,0,2,'utf8');
    }

    /*
     * 检查是否存在多个停车场id的情况
     * */
    public function check_special_garage(){
        if(strpos($this->_garage,DELIMITER)){
            //存在多个停车场id
            $garage_id_array = explode(DELIMITER,$this->_garage);
            $garage_array = array();
            foreach ($garage_id_array as $k=>$v){
                $garage_array[$k] = M('garage')->where(array('garage_id'=>$v))->find();
            }
            return $garage_array;
        }
    }

    public function super_garage_array(){
        $garageArray = M('garage')->select();
        return $garageArray;
    }

}