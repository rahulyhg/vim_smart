<?php

/**
 * @author zhukeqin
 * 额外费用制作控制器
 * Class OtherfeeAction
 */

class OtherfeeAction extends BaseAction{
    public function _initialize()
    {

        parent::_initialize();

        $this->admin_id=session('system.id');
        $this->village_id=filter_village(0,2);
    }
    //缴费类型列表
    public function getotherfee_list(){

        $type_list=M('house_village_otherfee_type')->where('village_id='.$this->village_id)->select();
        $this->assign('type_list',$type_list);
        $this->display();
    }
    //ajax获取缴费类型信息
    public function ajax_otherfee_type(){
        $otherfee_type_id=$_POST['otherfee_type_id'];
        $info=M('house_village_otherfee_type')->where(array('village_id'=>$this->village_id,'otherfee_type_id'=>$otherfee_type_id))->find();
        echo json_encode($info);
    }
    //添加\修改缴费类型
    public function add_otherfee_type(){
        $otherfee_type_id=$_GET['otherfee_type_id'];
        if(!empty($otherfee_type_id)){
            $otherfee_type_info=M('house_village_otherfee_type')->where(array('otherfee_type_id'=>$otherfee_type_id,'village_id'=>$this->village_id))->find();
            $this->assign('otherfee_type_info',$otherfee_type_info);
        }
        if(!empty($otherfee_type_id)&&empty($otherfee_type_info)){
            $this->error('您所选择的类型不存在');
        }
        if($_POST){
            $fee_type=$_POST['fee_type'];
            if(empty($fee_type['otherfee_type_name'])){
                $this->error('类型名称必须填写！');
            }
            if(!empty($fee_type['type'])&&($fee_type['type']<1||$fee_type['type']>2)){
                $this->error('类型不正确！');
            }
            if(!empty($fee_type['status'])&&($fee_type['status']<0||$fee_type['status']>1)){
                $this->error('状态不正确！');
            }
            $fee_type['admin_id']=$this->admin_id;
            $fee_type['updatetime']=time();
            $fee_type['village_id']=$this->village_id;
            if(empty($otherfee_type_id)){
                $fee_type['createtime']=time();
                $reslut=M('house_village_otherfee_type')->data($fee_type)->add();
            }else{
                $reslut=M('house_village_otherfee_type')->data($fee_type)->where('otherfee_type_id='.$otherfee_type_id)->save();
            }
            if($reslut){
                $this->success('操作成功！',U('getotherfee_list'));
            }else{
                $this->error('操作失败!',U('getotherfee_list'));
            }
        }else{
            $this->display();
        }
    }
    //隐藏对应的缴费类型
    public function delete_otherfee_type(){
        $otherfee_type_id=$_GET['otherfee_type_id'];
        $otherfee_type_info=M('house_village_otherfee_type')->where(array('otherfee_type_id'=>$otherfee_type_id,'village_id'=>$this->village_id))->find();
        if(empty($otherfee_type_info)){
            $this->error('对应类型不存在');
        }
        $status=$_GET['status'];
        if($status!=='0'&&$status!=='1'){
            $this->error('状态值错误');
        }
        $result=M('house_village_otherfee_type')->where(array('otherfee_type_id'=>$otherfee_type_id,'village_id'=>$this->village_id))->data(array('status'=>$status))->save();
        if($result){
            $this->success('状态修改成功！',U('getotherfee_list'));
        }else{
            $this->error('状态修改失败',U('getotherfee_list'));
        }
    }

    //获取当前房间所有的费用记录
    public function otherfee_list(){
        $rid=$_GET['rid'];
        $room_info=M('house_village_room')->where(array('id'=>$rid,'village_id'=>$this->village_id))->find();
        if(empty($room_info)){
            $this->error('您选择的房间并不存在');
        }else{
            $this->assign('room_info',$room_info);
        }
        $otherfee_list=M('house_village_otherfee')
            ->alias('of')
            ->join('left join __HOUSE_VILLAGE_OTHERFEE_TYPE__ ot on ot.otherfee_type_id=of.otherfee_type_id')
            ->field(array('of.*','ot.type'=>'otherfee_type','ot.otherfee_type_name'))
            ->where(array('of.rid'=>$rid,'of.status'=>1))
            ->select();
        $this->assign('otherfee_list',$otherfee_list);
        $this->display();
    }
    //新增费用记录
    public function add_otherfee(){
        $rid=$_GET['rid'];
        $room_info=M('house_village_room')->where(array('id'=>$rid,'village_id'=>$this->village_id))->find();
        if(empty($room_info)){
            $this->error('您选择的房间并不存在');
        }else{
            $this->assign('room_info',$room_info);
        }
        $type_list=M('house_village_otherfee_type')->where(array('village_id'=>$this->village_id,'status'=>1))->select();
        $this->assign('type_list',$type_list);
        if($_POST){
            $other_fee=$_POST['otherfee'];
            if($other_fee['type']<1&&$other_fee['type']>4){
                $this->error('缴费方式错误！');
            }
            $check=M('house_village_otherfee_type')->where(array('village_id'=>$this->village_id,'status'=>1,'otherfee_type_id'=>$other_fee['otherfee_type_id']))->find();
            if(!$check){
                $this->error('缴费类型错误！');
            }
            $other_fee['rid']=$rid;
            $other_fee['village_id']=$room_info['village_id'];
            $other_fee['project_id']=$room_info['project_id'];
            $other_fee['creattime']=$other_fee['updatetime']=time();
            $other_fee['admin_id']=$this->admin_id;
            $re=M('house_village_otherfee')->data($other_fee)->add();
            if($re){
                $this->success('更新成功！',U('otherfee_list',array('rid'=>$rid)));
            }else{
                $this->error('更新失败！请重试');
            }
        }else{

            $this->display();
        }
    }
    public function delete_otherfee(){
        $rid=$_GET['rid'];
        $room_info=M('house_village_room')->where(array('id'=>$rid,'village_id'=>$this->village_id))->find();
        if(empty($room_info)){
            $this->error('您选择的房间并不存在');
        }
        $otherfee_id=$_GET['otherfee_id'];
        $otherfee_info=M('house_village_otherfee')->where(array('rid'=>$rid,'otherfee_id'=>$otherfee_id))->find();
        if(empty($otherfee_info)){
            $this->error('所操作的记录不存在');
        }
        $data=array(
            'status'=>0,
            'admin_id'=>$this->admin_id,
            'updatetime'=>time(),
        );
        $re=M('house_village_otherfee')->where(array('rid'=>$rid,'otherfee_id'=>$otherfee_id))->data($data)->save();
        if($re){
            $this->success('修改成功');
        }else{
            $this->error('修改失败');
        }
    }
}