<?php

namespace Admin\Model;

use Think\Model;

//地区类
class ZoneModel extends Model{
    
   
    //瞻前顾后机制
    // 插入数据前的回调方法
    protected function _before_insert(&$data,$options) {}
    // 插入成功后的回调方法
    protected function _after_insert($data,$options) {
        //完善Zone_path和Zone_level
        //①维护Zone_path
        $zone_id=$data['zone_id'];
        $zone_pid=$data['zone_pid'];
        if($zone_pid==0){
            //如果它就是顶级地区，那么路径为它自己的id
            $path=$zone_id;
        }else{
            //如果为非顶级地区，那就先找到它的上级，找到上级路径，然后再和自己的id整合即为自己的路径
            //$ppath=$this->field('zone_path')->where(array('zone_id'=>$zone_pid))->find();//上级的路径
            $pinfo=$this->where(array('zone_id'=>$zone_pid))->find();
            $ppath=$pinfo['zone_path'];
            $path=$ppath."-".$zone_id;
        }
        //②维护Zone_level
        $zone_level=  substr_count($path, "-");
        
        //【注意 】因为本页面有_before_update方法，会影响_after_insert的更新操作，解决方法为:将_before_update要处理的内容直接在控制器里面进行处理ZoneArtModel
        
        //③将维护好的数据进行更新到数据库
        $this->save(array('zone_id'=>$zone_id,'zone_path'=>$path,'zone_level'=>$zone_level));
    }
    
    //【特别注意！】：不管是_before_insert还是_before_update或者还是其它类似这种什么之前的操作都是在所有控制器的方法全部完成之后才会执行
    
}