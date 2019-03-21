<?php
namespace Admin\Controller;
//use Think\Controller;
use Admin\Common\RbacController;
class DutyController extends RbacController {
    
    //值班人员列表
    public function showlist(){
        $duty_list=D('duty')->select();
        $this->assign('duty_list',$duty_list);
        $this->display();
    }
    
    //添加值班
    public function add(){
        //实例化UserModel
        $duty=new \Admin\Model\DutyModel();
        if(IS_POST){
            $data=$duty->create();
            //将时间字串转为时间
            $data['start_time']=strtotime($data['start_time']);
            $data['end_time']=strtotime($data['end_time']);
            //将数据插入到数据库
            $z=$duty->add($data);
            if($z){
                $this->success('添加成功！',U('showlist'),1);
            }else{
                $this->error('添加失败，请检查！',U('add'),1);
            }
        }else{
            //调用模板
            $this->display();
        }
    }
    
    //用户信息修改更新
    public function update(){
        //接收将被操作的记录id
        $id=I('get.id');
        //实例化CarModel
        $duty=new \Admin\Model\DutyModel();
        if(IS_POST){
            //数据收集
            $data=$duty->create($_POST,2); //进行数据更新，且存在自动完成字段时，务必要这样规范操作写，否则可能会自动完成操作无法完成
            $data['start_time']=strtotime($data['start_time']);
            $data['end_time']=strtotime($data['end_time']);
            //数据处理并操作数据库函数
            $z=$duty->where(array('id'=>$id))->save($data);
            if($z){
                $this->success('用户信息更新成功！',U('showlist'),1);
            }else{
                $this->error('用户信息更新失败，请检查！',U('update',array('id'=>$id)),1);
            }
            
        }else{
            //查询出该条记录的所有信息
            $duty_info=$duty->find($id);
            
            //将数据返回到模板
            $this->assign('duty_info',$duty_info);

            //调用模板
            $this->display();
        }
    }
    

    
    //用户彻底删除(物理删除，不可恢复！)
    public function destroy(){
        //接收要被删除的对应的记录id
        $id=I('post.id');
        
        //将对应的记录进行逻辑删除(调用模块方法)
        $z=D('duty')->where(array('id'=>$id))->delete();

        if($z){
            echo json_encode('1');//删除操作成功！
        }else{
            echo json_encode('2');//删除操作失败！
        }
    }
    
    
    //用户回收站列表展示
    public function recycle(){
        //查询所有被逻辑删除的用户
        //为了减轻服务器的压力，建议使用条件进行查询，涉及默认全部查询时我们只显示最近500条（后期可设置到配置项）
        $user_infos=D('user')->where(array('is_del'=>'1'))->limit(500)->select();
        
        //将查询到的数据返回模板
        $this->assign('user_infos',$user_infos);
        
        //调用模板
        $this->display();
    }
    
    
    //用户逻辑删除数据恢复
    public function recover(){
        //接收要被恢复的对应的记录id
        $uid=I('get.uid');
        //将对应的记录进行恢复
        $z=D('user')->where(array('user_id'=>$uid))->save(array('is_del'=>'0'));
        if($z){
            echo json_encode('1');//恢复操作成功！
        }else{
            echo json_encode('2');//恢复操作失败！
        }
    }
    
    
    //用户信息详情页
    public function detail(){
        //接收对应的user_id
        $uid=I('get.uid');
        //查询对应的用户详情信息
        $user_info=D('user')->find($uid);
        
        //查询该用户名下车辆
        $car_nos=D('car')->where(array('user_id'=>$uid))->select(); 
        
        //将数据返回模板
        $this->assign('user_info',$user_info);
        $this->assign('car_nos',$car_nos);
        
        //调用模板
        $this->display();
    }
}
























