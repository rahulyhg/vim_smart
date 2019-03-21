<?php
namespace Admin\Controller;
//use Think\Controller;
use Admin\Common\RbacController;
class GarageController extends RbacController {
    
    //停车场列表
    public function showlist(){
        //查询所有停车场
        //为了减轻服务器的压力，建议使用条件进行查询，涉及默认全部查询时我们只显示最近500条（后期可设置到配置项）
        //只显示未逻辑删除的信息
        $garage_infos=D('garage')->where(array('is_del'=>'0'))->limit(500)->select();
        
        //将数据返回模板
        $this->assign('garage_infos',$garage_infos);
        
        
        //调用模板
        $this->display();
    }
    
    //添加停车场
    public function add(){
        //实例化GarageModel
        $garage=new \Admin\Model\GarageModel();
        if(IS_POST){
            //数据收集
            $data=$garage->create();
            
            //到model去执行接下来的操作(数据制作)
            $data=$garage->get_and_made($data, $_FILES);
            
            //将返回的数据插入到数据库
            if( $garage->add($data) ){
                $this->success('停车场添加成功！',U('showlist'),1);
            }else{
                $this->error('停车场添加失败，请检查！',U('add'),1);
            }
            
        }else{
            
            //查询所有地区
            $zone_infos=D('zone')->order('zone_path')->select();
            //将地区数据返回到模板
            $this->assign('zone_infos',$zone_infos);
        
            //调用模板
            $this->display();
        }
    }
    
    //停车场信息修改更新
    public function update(){
        //接收将被操作的记录id
        $garage_id=I('get.garage_id');
        //实例化GarageModel
        $garage=new \Admin\Model\GarageModel();
        
         //查询出该车场的所有信息
        $garage_info=$garage->find($garage_id);
        //将相册字段进行数据处理
        $garage_info['park_photo']= explode(',', $garage_info['park_photo']); //转为数组
        
        if(IS_POST){
            //数据收集
            $data=$garage->create($_POST,2); //进行数据更新，且存在自动完成字段时，务必要这样规范操作写，否则可能会自动完成操作无法完成
            
            //到model去执行接下来的操作(数据制作)
            $data=$garage->get_and_made($data, $_FILES);
            $data['garage_old_photos']=$_POST['garage_old_photos'];
            $is_del_arr=array(); //用于记录已被删除的图片地址
            
            foreach($garage_info['park_photo'] as $k => $v){
                if( in_array($v, $data['garage_old_photos']) ){ 
                    $data['park_photo'].=','.$v;
                    $data['park_photo']= ltrim($data['park_photo'],',');
                }else{
                    $is_del_arr[]=$v;
                }
            }
            
            
            //将数据更新到数据库
            if( $garage->where(array('garage_id'=>$garage_id))->save($data) ){
                
                //删除原来的旧图片(通过判断，如果已被修改，则执行删除操作)
                foreach($is_del_arr as $k => $v){
                    if( file_exists('./'.$v) ){
                        unlink($v);
                    }
                }
                $this->success('车场信息更新成功！',U('showlist'),1);
            }else{
                $this->error('车场信息更新失败，请检查！',U('update',array('garage_id'=>$garage_id)),1);
            }
            
        }else{
            
            //查询所有地区
            $zone_infos=D('zone')->order('zone_path')->select();
            //将地区数据返回到模板
            $this->assign('zone_infos',$zone_infos);
            
            //将数据返回到模板
            $this->assign('garage_info',$garage_info);
            
        
            //调用模板
            $this->display();
        }
    }
    
    
    //车辆信息删除(逻辑删除)
    public function delete(){
        //接收要被删除的对应的记录id
        $garage_id=I('get.garage_id');
        //将对应的记录进行逻辑删除
        $z=D('garage')->where(array('garage_id'=>$garage_id))->save(array('is_del'=>'1'));
        if($z){
            echo json_encode('1');//逻辑删除操作成功！
        }else{
            echo json_encode('2');//逻辑删除操作失败！
        }
    }
    
    
    //车场信息彻底删除(物理删除，不可恢复！)
    public function destroy(){
        //接收要被删除的对应的记录id
        $garage_id=I('get.garage_id');
        
        //实例化GarageModel
        $garage=new \Admin\Model\GarageModel();
        
        //查询出此车场的信息
        $garage_info=$garage->find($garage_id);
        
        //将对应的记录进行逻辑删除
        $z=$garage->where(array('garage_id'=>$garage_id))->delete();
        if($z){
            
            //删除它对应的照片
            $garage->destory_all_photos($garage_info);
            
            echo json_encode('1');//删除操作成功！
        }else{
            echo json_encode('2');//删除操作失败！
        }
    }
    
    
    //车场信息回收站列表展示
    public function recycle(){
        //查询所有停车场
        //为了减轻服务器的压力，建议使用条件进行查询，涉及默认全部查询时我们只显示最近500条（后期可设置到配置项）
        //只显示被逻辑删除的信息
        $garage_infos=D('garage')->where(array('is_del'=>'1'))->limit(500)->select();
        
        //将数据返回模板
        $this->assign('garage_infos',$garage_infos);
        
        
        //调用模板
        $this->display();
    }
    
    
    //停车记录逻辑删除数据恢复
    public function recover(){
        //接收要被恢复的对应的记录id
        $garage_id=I('get.garage_id');
        //将对应的记录进行恢复
        $z=D('garage')->where(array('garage_id'=>$garage_id))->save(array('is_del'=>'0'));
        if($z){
            echo json_encode('1');//恢复操作成功！
        }else{
            echo json_encode('2');//恢复操作失败！
        }
    }
    
    
    //车场信息详情页
    public function detail(){
        //接收对应的garage_id
        $garage_id=I('get.garage_id');
        //查询对应的车辆详情信息
        $garage_info=D('garage')->find($garage_id);
        $img_array = explode(",",$garage_info['park_photo']);
        //将数据返回模板
        $this->assign('garage_info',$garage_info);
        $this->assign('img_array',$img_array);

        //调用模板
        $this->display();
    }
}
























