<?php
/*
 * 小区常用手机号的管理
 *
 */
class CommonPhoneAction extends BaseAction{
    protected $village_id;
    protected $village;

    public function _initialize(){
        parent::_initialize();

        $this->village_id = $this->house_session['village_id'];
        $this->village = D('House_village')->where(array('village_id'=>$this->village_id))->find();
        if(empty($this->village)){
            $this->error('该小区不存在！');
        }
        if($this->village['status'] == 0){
            $this->assign('jumpUrl',U('Index/index'));
            $this->error('您需要先完善信息才能继续操作');
        }
    }

    /**
     * 业主的手机号码管理列表
     * 汪威
     * 2016.4.18
     */
    public function cp_index(){
        $condition['village_id'] = $this->village_id;
        $commonphone_list = D('House_commonphone')->getlist($condition);
        $this->assign('news_list',$commonphone_list);
        $this->display();
    }
    /**
     * 业主的手机号码编辑
     * 汪威
     * 2016.4.18
     */
    public function cp_edit(){
        $condition['village_id'] = $this->village_id;
        $ct =  M('house_commontype')->where('village_id='.$condition['village_id'])->select();
        $new_info = M('house_commonphone')->where('cp_id='.$_GET['cp_id'])->find();
        $this->assign('news_info',$new_info);
        $this->assign('ct',$ct);
        if($_POST){
            $cp_id = $_POST['cp_id'];
            $data['nickname'] = trim(I('nickname'));
            $data['iphone'] = trim(I('iphone'));
            $data['ct_id'] = trim(I('ct_id'));
            $data['village_id'] = $condition['village_id'];
            $data['cp_time'] = $_SERVER['REQUEST_TIME'];
            $data['s_phone'] = trim(I('s_phone'));
            $data['description'] = trim(I('description'));
            if(empty($data['nickname'])){
                $this->error('昵称不能为空');
            }
            if(empty($data['iphone'])){
                $this->error('联系号码不能为空');
            }
            if(empty($data['ct_id'])){
                $this->error('请选择服务分类');
            }
            if($data['s_phone']=="1"){
                $s_p['village_id'] = $this->village_id;
                $s_p['s_phone'] = "1";
                $s_p['cp_id'] = array('neq',$cp_id);
                $sp =  M('house_commonphone')->where($s_p)->find();
                if($sp){
                    $this->error('该社区物业服务号码已经存在');
                }
            }
            if($cp_id){
                $result = M('house_commonphone')->where('cp_id='.$cp_id)->data($data)->save();
                if($result >= 0){
                    $this->success('修改成功！',U('CommonPhone/cp_index'));
                }else{
                    $this->error('修改失败！请重试。');
                }
            }else{
                $result = M('house_commonphone')->data($data)->add();
                if($result){
                    $this->success('添加成功！',U('CommonPhone/cp_index'));
                }else{
                    $this->error('添加失败！请重试。');
                }
            }
        }else{
            $this->display();
        }
    }
    /**
     * 业主的手机号码删除
     * 汪威
     * 2016.4.18
     */
    public function cp_del(){
        $cp_id = $_GET['cp_id'];
        $del = M('house_commonphone')->where('cp_id='.$cp_id)->delete();
        if($del){
            $this->success('删除成功！',U('CommonPhone/cp_index'));
        }else{
            $this->error('删除失败！请重试。');
        }
    }
    /**
     * 业主的常用手机号码分类管理
     * 汪威
     * 2016.4.18
     */
    public function ct_index(){
        $condition['village_id'] = $this->village_id;
        $type_info = M('house_commontype')->where($condition)->select();
        $this->assign('type_info',$type_info);
        $this->display();
    }
    /**
     * 业主的常用手机号码分类编辑
     * 汪威
     * 2016.4.18
     */
    public function ct_edit(){
        $condition['village_id'] = $this->village_id;
        $new_info = M('house_commontype')->where('ct_id='.$_GET['ct_id'])->find();
        $this->assign('news_info',$new_info);
        if($_POST){
            $ct_id = $_POST['ct_id'];
            $_POST['village_id'] = $this->village_id;
            $_POST['ct_name'] = trim(I('ct_name'));
            $_POST['ct_description'] = trim(I('description'));
            if(empty($_POST['ct_name'])){
                $this->error('分类名称不能为空');
            }
            if($ct_id){
                $condition_village['village_id'] = $_POST['village_id'];
                $condition_village['ct_name'] = $_POST['ct_name'];
                $condition_village['ct_description'] = $_POST['ct_description'];
                $result = M('house_commontype')->where('ct_id='.$ct_id)->data($condition_village)->save();
                if($result >= 0){
                    $this->success('修改成功！',U('CommonPhone/ct_index'));
                }else{
                    $this->error('修改失败！请重试。');
                }
            }else{
                $add['ct_time'] = $_SERVER['REQUEST_TIME'];
                $add['village_id'] = $_POST['village_id'];
                $add['ct_name'] = $_POST['ct_name'];
                $add['ct_description'] = $_POST['ct_description'];
                $result = M('house_commontype')->data($add)->add();
                if($result){
                    $this->success('添加成功！',U('CommonPhone/ct_index'));
                }else{
                    $this->error('添加失败！请重试。');
                }
            }
        }else{
            $this->display();
        }
    }
    /**
     * 业主的常用手机号码删除
     * 汪威
     * 2016.4.18
     */
    public function ct_del(){
        $condition['village_id'] = $this->village_id;
        $ct_id = $_GET['ct_id'];
        $del = M('house_commontype')->where('ct_id='.$ct_id)->delete();
//        $delete = M('house_commonphone')->where(array('village_id'=>$condition['village_id'],'ct_id'=>$ct_id))->delete();
        if($del){
            $this->success('删除成功！',U('CommonPhone/ct_index'));
        }else{
            $this->error('删除失败！请重试。');
        }
    }
    /**
     * 业主的常用手机号码前台显示
     * 汪威
     * 2016.4.18
     */
    public function commonphone_index(){
        $condition['village_id'] = $this->village_id;
        $info = M('house_commonphone');
        $ct_info = M('house_commontype');
        $ct_message = $ct_info->where('village_id ='.$condition['village_id'])->select();
        foreach($ct_message as $ke=>$va){
            $cp_message = $info->where(array('village_id'=>$condition['village_id'],'ct_id'=>$va['ct_id']))->order('ct_id DESC')->select();
            if(empty($cp_message)){
                unset($ct_message[$ke]);
            }else{
                foreach($cp_message as $key=>$val){
                    $ct_message[$ke]['ct'][$key]['name'] = $val['nickname'];
                    $ct_message[$ke]['ct'][$key]['phone'] = $val['iphone'];
                }
            }

        }
        $this->assign('ct_message',$ct_message);
        $this->display();
    }
}