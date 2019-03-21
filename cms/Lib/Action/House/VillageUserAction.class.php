<?php
/*
 * 社区首页
 *
 */
class VillageUserAction extends BaseAction{
    protected $village_id;
    protected $village;
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
    /*用户管理
     * 2016.6.21
     * 陈琦
     */
    public function index(){
        /* $uids=M('House_village_user_bind')->field('uid')->where('village_id=$village_id')->select();
             for($i=0;$i<count($uids);$i++){
             $sql="select v.uid from v  where v.uid like '%{$uids[$i]}%';";
             $result[$i]=M('House_village_user_bind')->query($sql);
         }
         print_r($result[$i]);exit;*/
        if(IS_POST){
            $village_u=M('house_village')->where(array('village_id'=>$this->village_id))->find();//village表中当前社区的信息
            $village_user = M('house_village_user_bind')->where(array('village_id=' . $this->village_id, 'pigcms_id' => $_POST['pigcms_id']))->find();//用户连接表中当前选中用户的信息
            if(intVal($_POST['is_sadmin'])==1){
                $is_sadmin=2;
                if($village_u['uid']) {//判断是否存在已绑定的用户
                    $openid_arr=explode(',',$village_u['uid']);
                    if(in_array($village_user['uid'],$openid_arr) || $openid_arr==$village_user['uid']){	//判断是否已绑定过此社区
                        $this->ajaxReturn(array('msg_code'=>1,'msg_data'=>'您已绑定过当前社区，不可重复绑定！'));
                    }else {
                        $newUid = $village_u['uid'] . ',' . $village_user['uid'];
                        $now_village = M('house_village')->where(array('village_id' => $village_user['village_id']))->data(array('uid' => $newUid))->save();
                    }
                }else{
                    $now_village = M('house_village')->where(array('village_id' => $village_user['village_id']))->data(array('uid' => $village_user['uid']))->save();
                }
            }else{
                $is_sadmin=1;
                $result = explode(',', $village_u['uid']);
                if(count($result)==1){
                    $now_village = M('house_village')->where(array('village_id' => $village_user['village_id']))->data(array('uid' =>''))->save();
                }else{
                    if(is_array($result)){
                        $key=array_search($village_user['uid'],$result);
                        if($key!==false){
                            array_splice($result,$key,1);
                        }
                    }
                    $newUid=implode(',',$result);
                    //$this->ajaxReturn(array('msg_code'=>1,'msg_data'=>$newUid)); exit;
                    $now_village = M('house_village')->where(array('village_id' => $village_user['village_id']))->data(array('uid' =>$newUid))->save();
                }
            }
            $alter_control=M('house_village_user_bind')->data(array('is_sadmin'=>$is_sadmin))->where(array('pigcms_id'=>$_POST['pigcms_id']))->save();
            if($alter_control){
                $this->ajaxReturn(array('msg_code'=>0,'msg_data'=>'改变成功！'));
            }else{
                $this->ajaxReturn(array('msg_code'=>1,'msg_data'=>'改变失败！'));
            }//通过ajax改变前台页面状态
        }else {
            //$userCheck_list = D('House_village_user_bind')->getlist($village_id = $this->village_id);
			$condition_table=array(C('DB_PREFIX').'House_village_user_bind'=>'n',C('DB_PREFIX').'user'=>'u',C('DB_PREFIX').'house_village'=>'v');
			$condition_where="n.ac_status>=1 and u.uid=n.uid and n.village_id=v.village_id and n.village_id=".$this->village_id." and (n.ac_status=2 or n.ac_status=4)";
			$condition_field='n.*,u.nickname';
			import('@.ORG.merchant_page');
			$order='n.add_time DESC';
			$count_userCheck=D('')->table($condition_table)->where($condition_where)->count();
			$p=new Page($count_userCheck,15,'page');
			$village_list=D('')->field($condition_field)->table($condition_table)->where($condition_where)->order($order)->limit($p->firstRow.','.$p->listRows)->select();
			$userCheck_list['pagebar']=$p->show();
			$userCheck_list['userCheck_list']=$village_list;
            $this->assign('userCheck_list', $userCheck_list);
            $this->display();
        }
    }

    public function VillageUserCheck_edit(){
        $pigcms_id = $_GET['pigcms_id'];
        // echo $pigcms_id;exit;
        if($pigcms_id){
            //$condition_village['pigcms_id'] = $pigcms_id;
            $condition_table = array(C('DB_PREFIX') . 'House_village_user_bind' => 'n',C('DB_PREFIX').'user'=>'u') ;
            $condition_where="n.ac_status>=1 and u.uid=n.uid and n.pigcms_id=".$pigcms_id;
            $condition_field = 'n.*,u.nickname';

            $userCheck_info = D('')->table($condition_table)->where( $condition_where)->field($condition_field)->find();
            //print_r($userCheck_info);exit;
            $this->assign('userCheck_info', $userCheck_info);
        }
        $this->display();
    }

    public function VillageUserCheck_edit_do(){
        $pigcms_id = $_POST['pigcms_id'];
        if(IS_POST){
            if(empty($_POST['nickname'])){
                $this->error('微信名必填！');
            }
            if(empty($_POST['name'])){
                $this->error('真实姓名必填！');
            }
            if(empty($_POST['company'])){
                $this->error('公司必填！');
            }
            if(empty($_POST['department'])){
                $this->error('部门必填！');
            }
            if(empty($_POST['usernum'])){
                $this->error('工牌号必填！');
            }
            if(empty($_POST['address'])){
                $this->error('地址必填！');
            }
            if($pigcms_id){
                $condition_village['pigcms_id'] = $pigcms_id;
                unset($_POST['nickname']);
                // $_POST['ac_desc']=$_POST['description'];
                // unset($_POST['description']);
                // print_r($_POST);exit;
                $result =M('house_village_user_bind')->where($condition_village)->data($_POST)->save();;
                //print_r($result);exit;
                if($result){
                    //审核信息推送
                    $village_info=M('house_village')->where(array('village_id'=>$this->village_id))->find();
                    $condition_table = array(C('DB_PREFIX') . 'House_village_user_bind' => 'n',C('DB_PREFIX').'user'=>'u') ;
                    $condition_where="n.ac_status>=1 and u.uid=n.uid and n.pigcms_id=".$pigcms_id;
                    $condition_field = 'n.*,u.openid,u.truename';
                    $userCheck_info=D('')->table($condition_table)->where( $condition_where)->field($condition_field)->find();
                    $time = time();
                    $href=C('config.site_url').'/wap.php?c=House&a=sms_accomplish&village='.$village_info['village_name'].'&name='.$userCheck_info['truename'].'&time='.$time;
                    $model=new templateNews(C('config.wechat_appid'),C('config.wechat_appsecret'));
                    if($_POST['ac_status']==2){
                        $model->sendTempMsg('OPENTM201136105',array('href'=>$href,'wecha_id'=>$userCheck_info['openid'],'first'=>'您好，您的资料已经通过审核。','keyword1'=>$userCheck_info['truename'],'keyword2'=>$userCheck_info['phone'],'keyword3'=>date('Y-m-d H:i:s')));
                    }else if($_POST['ac_status']==3){
                        $model->sendTempMsg('OPENTM201136105',array('href'=>$href,'wecha_id'=>$userCheck_info['openid'],'first'=>'您好，您的资料审核没有通过。','keyword1'=>$userCheck_info['truename'],'keyword2'=>$userCheck_info['phone'],'keyword3'=>date('Y-m-d H:i:s')));
                    }
                    $this->success('修改成功！',U('VillageUser/index'));
                }else{
                    $this->error('修改失败！请重试。');
                }
            }
        }
    }

}
