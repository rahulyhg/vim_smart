<?php
namespace Admin\Controller;
//use Think\Controller;
use Admin\Common\RbacController;
class ActtypeController extends RbacController {
    
    //活动类型列表
    public function showlist(){
        //查询所有活动类型
        $attype_infos=D('acttype')->select();
        
        //将数据返回模板
        $this->assign('attype_infos',$attype_infos);
        
        
        //调用模板
        $this->display();
    }
    
    //活动类型 添加
    public function add(){
        //实例化attypeModel
        $attype=new \Admin\Model\ActtypeModel();
        if(IS_POST){
            //数据收集
            $data=$attype->create();
            
            //将数据插入到数据库
            $z=$attype->add($data);
            if($z){
                $this->success('活动类型添加成功！',U('showlist'),1);
            }else{
                $this->error('活动类型添加失败，请检查！',U('add'),1);
            }
            
        }else{
        
            //调用模板
            $this->display();
        }
    }
    
    //车辆信息修改更新
    public function update(){
        //接收将被操作的记录id
        $attp_id=I('get.attp_id');
        //实例化CarModel
        $attype=new \Admin\Model\ActtypeModel();
        if(IS_POST){
            //数据收集
            $data=$attype->create($_POST,2); //进行数据更新，且存在自动完成字段时，务必要这样规范操作写，否则可能会自动完成操作无法完成
            
            //将数据更新到数据库
            $z=$attype->where(array('attp_id'=>$attp_id))->save($data);
            if($z){
                $this->success('类型更新成功！',U('showlist'),1);
            }else{
                $this->error('类型更新失败，请检查！',U('update',array('attp_id'=>$attp_id)),1);
            }
            
        }else{
            //查询出该条记录的所有信息
            $attp_info=$attype->find($attp_id);
            
            //将数据返回到模板
            $this->assign('attp_info',$attp_info);
            
        
            //调用模板
            $this->display();
        }
    }
    
    

    
    
    //类型彻底删除(物理删除，不可恢复！)
    public function destroy(){
        //接收要被删除的对应的记录id
        $attp_id=I('post.attp_id');
        //将对应的记录进行逻辑删除
        $z=D('acttype')->where(array('attp_id'=>$attp_id))->delete();
        if($z){
            echo json_encode('1');//删除操作成功！
        }else{
            echo json_encode('2');//删除操作失败！
        }
    }


    //ajax检测对应类型下是否存在活动
    public function check_attpids_act(){
        //接收对应的attp_id
        $attp_id=I('post.attp_id');

        //条件查询是否存在活动
        $z=D('activity')->where('act_type='.$attp_id)->find();

        if($z){
            echo json_encode('1');//该类型下存在活动！
        }else{
            echo json_encode('2');//该类型下(不)存在活动！
        }
    }

}
























