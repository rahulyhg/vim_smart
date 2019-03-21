<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/31
 * Time: 14:26
 * 用户访问日志
 */
class Visitor_logModel extends Model
{

    protected $action = "";
    public function _initialize(){
        parent::_initialize();
        $this->action = __ACTION__;
    }

    /**
     * @param $query_arr 请求参数
     * @return mixed
     */
    public function add_log($query_arr){
        $query_arr = $query_arr?:$_GET;
        $data = array(
            'action'=>$this->action,
            'query'=>http_build_query($query_arr),
            'create_time'=>time(),
            'uid'=>$this->get_uid()?:0,
            'aid'=>$this->get_aid()?:0
        );
       return $this->add($data);
    }

//    /**
//     * @param $action
//     * @param $param_arr
//     * @return mixed
//     */
//    public function vistor_count($action,$query_arr){
//        $map = array();
//        $map['action'] = $action;
//        $map['query'] = http_build_query($query_arr);
//        return $this->where($map)->count();
//    }
//
//    /**
//     * @param $action
//     * @param $param_arr
//     * @return array|mixed
//     */
//    public function vistor_list($action,$query_arr){
//        $map = array();
//        $map['action'] = $action;
//        $map['query'] = http_build_query($query_arr);
//        return $this->where($map)->select();
//    }

    public function get_vistor_users($action="",$query_arr=array()){
        $map = array();
        $action  && $map['vl.action'] = array('eq',$action);
        $query_arr && $map['vl.query'] = array('eq',http_build_query($query_arr));
        $map['vl.uid'] = array('gt',0);
        $field = array(
            'vl.uid',
            'vl.query',
            'u.nickname',
            'u.avatar',
            'count(vl.uid)'=>'visit_times',
            'max(vl.create_time)'=>'last_visit_time',
        );
        $list = $this->alias('vl')
            ->field($field)
            ->join('left join __USER__ u on vl.uid=u.uid')
            ->group('vl.uid')
            ->where($map)
            ->select();
        if($list){
            $total_visitor_num = count($list);
            $total_visit_times = array_sum(array_column($list,'visit_times'));
        }else{
            return null;
        }
        return array(
            'list'=>$list,
            'total_visitor_num'=>$total_visitor_num,
            'total_visit_times'=>$total_visit_times
        );
    }


    protected function get_uid(){
        return session('user.uid');
    }
    protected function get_aid(){
        return session('admin_id');
    }

}