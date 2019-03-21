<?php

namespace Admin\Controller;
//use Think\Controller;
use Admin\Common\RbacController;
//地区类
class ZoneController extends RbacController{
    //地区列表
    public function showlist(){
        //查询所有地区
        $zone_info=D('Zone')->order('zone_path')->select();
        //将地区数据展示到模板
        $this->assign('zone_info',$zone_info);
        //调用模板
        $this->display();
    }
    
    //地区添加
    public function add(){
        $zone_name=$_POST['zone_name'];
        //两个逻辑：数据搜集/数据展示
        if(IS_POST && $zone_name){
            //收集数据
            $data=D('Zone')->create();
            //将数据写入到数据库表
            $z=D('Zone')->add($data);
            if($z){
                $this->success('地区添加成功',U('showlist'),1);
            }else{
                $this->error('地区添加失败',U('add'),1);
            }
        }else{
            //查询所有地区
            $zone_infos=D('Zone')->order('zone_path')->select();
            //$zone_infoA=D('Zone')->where(array('zone_level'=>'0'))->select();//一级地区
            //$zone_infoB=D('Zone')->where(array('zone_level'=>'1'))->select();//二级地区
            //$zone_infoC=D('Zone')->where(array('zone_level'=>'2'))->select();//三级地区
            //将地区数据展示到模板
            $this->assign('zone_infos',$zone_infos);
            //$this->assign('zone_infoA',$zone_infoA);
            //$this->assign('zone_infoB',$zone_infoB);
            //$this->assign('zone_infoC',$zone_infoC);
            //调用模板
            $this->display();
        }
    }
    //地区更新前检测工作
    //
    public function check_child_zone(){
        //接收地区id
        $zone_id=I('get.zone_id');
        //检测它是否存在下级 
        $is_nex=D('Zone')->where(array('zone_pid'=>$zone_id))->find();
        if($is_nex){
            echo json_encode('1');
            //return false;
        }else{
            echo json_encode('2');
        }
    }
    //地区更新
    public function update(){
        //接收地区id
        $zone_id=I('get.zone_id');
        $zone=new \Admin\Model\ZoneModel();
        //两个逻辑：数据收集，数据展示
        if(IS_POST && $_POST['zone_name']){
            $data=$zone->create();//如果没传参数，这个方法默认收集POST数据
            $data['zone_id']=$zone_id;                    
                                //两种操作：①：只更新名称，②：更新名称和上级地区，第二种操作必须事先判断其是否存在下级地区，如果存在选情况阻止！
                                if($_POST['zone_pid']){
                                    $pid=$_POST['zone_pid'];
                                    //检测它是否存在下级(此操作虽然已经进行ajax验证，但是出于安全考虑，我们在此再次进行服务器端防止方法操作)
                                    $is_nex=D('Zone')->where(array('zone_pid'=>$zone_id))->find();
                                    if($is_nex){
                                        //存在下级
                                        //检测它是否正在更换上级
                                        $its_pid_info=D('Zone')->where(array('zone_id'=>$zone_id))->find();
                                        $its_pid=$its_pid_info['zone_pid'];//修改前上级地区id
                                        $now_pid=$pid;//将进行更换的上级id
                                        if($its_pid == $now_pid){
                                            //没有更换上级，即只修改名称，允许操作
                                            
                                            $z=$zone->save($data);
                                            if($z){
                                                $this->success('地区更新成功！',U('showlist'),'1');
                                            }else{
                                                $this->error('地区更新失败！',U('update',array('zone_id'=>$zone_id)),'1');
                                            }
                                        }else{
                                            //将进行更换上级操作，警告！并阻止！
                                            $this->error('地区更新失败！该地区存在下级地区，为了您的数据安全考虑，我们阻止了您此次操作，请换其它修改方式进行。若不能解决请联系邻钱科技协助！',U('update',array('zone_id'=>$zone_id)),'5');
                                            return false;
                                        }
                                    }else{
                                        //不存在下级，等同地区添加
                                        //【注意】：像数据制作这种操作按规范是不在控制器中进行的，但是因为Model类中_after_insert_存在更新操作，所以不能使用_before_update
                                        //*************数据制作开始*************//
                                        //完善Zone_path和Zone_level
                                        //①维护Zone_path
                                        $zone_pid=$pid;
                                        if($zone_pid==0){
                                            //如果它就是顶级地区，那么路径为它自己的id
                                            $path=$zone_id;
                                        }else{
                                            //如果为非顶级地区，那就先找到它的上级，找到上级路径，然后再和自己的id整合即为自己的路径
                                            //$ppath=$this->field('zone_path')->where(array('zone_id'=>$zone_pid))->find();//上级的路径
                                            $pinfo=$zone->where(array('zone_id'=>$zone_pid))->find();
                                            $ppath=$pinfo['zone_path'];
                                            $path=$ppath."-".$zone_id;
                                        }
                                        //②维护Zone_level
                                        $zone_level=  substr_count($path, "-");

                                        //③将维护好的数据进行更新到数据库
                                        $data['zone_path']=$path;
                                        $data['zone_level']=$zone_level;
                                    //*************数据制作结束************//
                                        $z=$zone->save($data);
                                        if($z){
                                            $this->success('地区更新成功！',U('showlist'),'1');
                                        }else{
                                            $this->error('地区更新失败！',U('update',array('zone_id'=>$zone_id)),'1');
                                        }
                                    }
                                }
        
        }else{
            //获取该该条地区信息
            $zone_info=D('Zone')->where(array('zone_id'=>$zone_id))->find();
            //查询所有地区
            $zone_infos=D('Zone')->select();//一级地区
            //$zone_infoA=D('Zone')->where(array('zone_level'=>'0'))->select();//一级地区
            //$zone_infoB=D('Zone')->where(array('zone_level'=>'1'))->select();//二级地区
            //将地区数据展示到模板
            $this->assign('zone_infos',$zone_infos);
            //$this->assign('zone_infoA',$zone_infoA);
            //$this->assign('zone_infoB',$zone_infoB);
            //将本条地区数据返回模板
            $this->assign('zone_info',$zone_info);
            //调用模板
            $this->display();
        }
    }
    
    //删除地区
    public function del_zone(){
        $zone_id=I('get.zone_id');
        //删除前先检测该地区是否存在下级
        $is_nex=D('Zone')->where(array('zone_pid'=>$zone_id))->find();
        if($is_nex){
            echo json_encode('3');
            return false;
        }  else {
            //执行删除操作
            $z=D('Zone')->delete($zone_id);
            if($z){
                echo json_encode('1');
            }else{
                echo json_encode('2');
            }
        }
    }
}

