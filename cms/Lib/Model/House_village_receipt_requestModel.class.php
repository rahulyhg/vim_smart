<?php
/**
 * Created by PhpStorm.
 * User: zhukeqin
 * Date: 2019/1/14
 * Time: 16:23
 */

/**
 * @author zhukeqin
 * Class House_village_receipt_requestModel
 * 订单删除等请求相关
 */
class House_village_receipt_requestModel extends Model{
    function __construct()
    {
        parent::__construct();

    }

    /**
     * @author zhukeqin
     * @param $id
     * @return mixed
     * 查询某订单的详细信息
     */
    public function get_order_one($id){
        $id_info=explode('-',$id);
        if($id_info['1']=='property'){
            //物业费获取信息
            $info=D('House_village_room_propertylist')->get_order_by_id('',$id_info['0']);
        }elseif($id_info['1']=='carspace'){
            $info=D('House_village_room_carspacelist')->get_order_by_id('',$id_info['0']);
        }else{
            $info=D('House_village_otherfee')->get_order_by_id('',$id_info['0']);
        }
        $fee_type_list=D('House_village_fee_type')->get_type_list();
        $room_info=M('house_village_room')->where(array('id'=>$info['rid']))->find();
        $otherfee_type_list=D('House_village_otherfee_type')->get_type_list($room_info['village_id']);
        if($info['otherfee_type_id']){
            $info['create_time']=date('Y年m月d日',$info['creattime']);
            $info['fee_type_name']=$fee_type_list[$info['type']];
            $info['type_name']=$otherfee_type_list[$info['otherfee_type_id']];
            $info['pay_receive']=$info['fee_receive'];
            $info['pay_true']=$info['fee_true'];
            $info['type_id']=$info['otherfee_type_id'];
            $info['pigcms_id']=$info['otherfee_id'];
        }else{
            $info['create_time']=date('Y年m月d日',$info['create_time']);
            $info['fee_type_name']=$fee_type_list[$info['type']];
            if($info['carspace_id']){
                $info['type_name']='泊位费';
                $info['type_id']='carspace';
            }else{
                $info['type_name']='物业费';
                $info['type_id']='property';
            }
            $info['changetime']=date('Y.n.j',strtotime($info['last_endtime'])+24*3600).'-'.date('Y.n.j',strtotime($info['new_endtime']));
        }
        $owner_info=M('house_village_user_bind')->where(array('pigcms_id'=>$room_info['owner_id']))->find();
        $info['owner']=$room_info['room_name'].' '.$owner_info['name'].' ';
        if($info['carspace_id']){
            $carspace_info=M('house_village_user_car')->where(array('pigcms_id'=>$info['carspace_id']))->find();
            $info['owner'] .=$carspace_info['carspace_number'];
        }else {
            $info['owner'] .= $room_info['roomsize'] . 'm²';
        }
        return $info;
    }

    /**
     * @author zhukeqin
     * @param $order_id 订单号
     * @param $request_id 请求id号
     * @return mixed
     */
    public function get_request_one($order_id,$request_id){
        if($order_id){
            $where=array('order_id'=>$order_id);
        }else{
            $where=array('pigcms_id'=>$request_id);
        }
        $re=$this->where($where)->order('pigcms_id desc')->find();
        return $re;
    }

    /**
     * @author zhukeqin
     * @param $order_id  要处理的订单号
     * @param $remark 处理原因
     * @param int $type 处理类型
     * @return array
     *添加一条处理信息
     */
    public function add_request_one($order_id,$remark,$type=1){
        $openid=$_SESSION['user']['openid'];
        $admin_info=$_SESSION['system']?$_SESSION['system']:M('admin')->where(array('openid'=>$openid))->order('id desc')->find();
        $id_info=explode('-',$order_id);
        if(empty($id_info)) return array('err'=>1,'data'=>'需要修改的条目不存在');
        if($id_info['1']=='property'){
            //物业费获取信息
            $info=D('House_village_room_propertylist')->get_order_by_id('',$id_info['0']);
        }elseif($id_info['1']=='carspace'){
            $info=D('House_village_room_carspacelist')->get_order_by_id('',$id_info['0']);
        }else{
            $info=D('House_village_otherfee')->get_order_by_id('',$id_info['0']);
        }
        if(empty($info)) return array('err'=>1,'data'=>'需要修改的条目不存在');
        $re=$this->get_request_one($order_id);
        if($re&&$re['check_type']==1) return array('err'=>1,'data'=>'该条目已被操作且同意处理过，无法重复操作');
        //查找对应项目的项目经理
        $room_info=M('house_village_room')->where(array('id'=>$info['rid']))->find();
        $where=array('village_id'=>$room_info['village_id'],'_string'=>' find_in_set("68",role_id) ');
        if(!empty($room_info['project_id'])) $where['_string'] .=' and find_in_set("'.$room_info['project_id'].'",project_id)';
        $admin_list=M('admin')->where($where)->select();
        if(empty($admin_list)) return array('err'=>1,'data'=>'该项目没有项目经理，请绑定之后再操作');
        //获取openid
        $user_list=array();
        foreach ($admin_list as $value){
            if(!empty($value['openid'])){
                $user_list[]=$value['openid'];
            }
        }
        if(empty($user_list)) return array('err'=>1,'data'=>'该项目项目经理都尚未绑定微信，请绑定之后再操作');
        $data=array(
            'order_id'=>$order_id,
            'update_time'=>time(),
            'remark'=>$remark,
            'type'=>$type,
            'admin_id'=>$admin_info['id'],
            'user_list'=>implode(',',$user_list)
        );
        $re=$this->data($data)->add();
        if($re){
            $wechat=new WechatModel();
            $tpl_id = $wechat::TPLID_LCSPTX;
            $data = array(
                'first'=>array(
                    'value'=>"业主缴费操作请求提醒",
                    'color'=>"#029700",
                ),
                'keyword1'=>array(
                    'value'=>"业主缴费操作请求提醒",
                    'color'=>"#000000",
                ),
                'keyword2'=>array(
                    'value'=>$admin_info['realname'],
                    'color'=>"#000000",
                ),
                'keyword3'=>array(
                    'value'=>'删除操作',
                    'color'=>"#000000",
                ),
                'keyword4'=>array(
                    'value'=>date('Y-m-d H:i:s',time()),
                    'color'=>"#000000",
                ),
            );
            $url=C('WEB_DOMAIN') . '/wap.php?g=Wap&c=Receipt&a=check_receipt' . '&id=' . $re;
            $res = $wechat->send_tpl_messages($user_list, $tpl_id, $url, $data);
            return array('err'=>0,'data'=>'发送请求成功，请等待项目经理处理');
        }else{
            return array('err'=>1,'data'=>'请求失败，请重试');
        }
    }

    public function check_request_one($request_id,$check_type,$check_remark){
        $info=$this->get_request_one('',$request_id);
        if($info['check_type']) return array('err'=>1,'data'=>'此条目已被审批，不能重复操作');
        $check_type=$check_type==1?1:2;
        $admin_info=$_SESSION['system']?$_SESSION['system']:M('admin')->where(array('openid'=>$_SESSION['openid']))->order('id desc')->find();
        $data=array(
            'check_id'=>$admin_info['id'],
            'check_time'=>time(),
            'check_type'=>$check_type,
            'check_remark'=>$check_remark
        );
        $re=$this->where(array('pigcms_id'=>$request_id))->data($data)->save();
        if($re){
            if($info['type']==1){
                if($check_type==1){
                    $fee_log=new House_village_fee_logModel();
                    $order_id_list=explode('-',$info['order_id']);
                    $return=$fee_log->delete_fee_one($order_id_list['0'],$order_id_list['1']);
                }else{
                    $return='';
                }
                if(empty($return)){
                    $admin_info_update=M('admin')->where(array('id'=>$info['admin_id']))->find();
                    $wechat=new WechatModel();
                    $tpl_id = $wechat::TPLID_LCSPTX;
                    $data = array(
                        'first'=>array(
                            'value'=>"业主缴费操作审批提醒",
                            'color'=>"#029700",
                        ),
                        'keyword1'=>array(
                            'value'=>"业主缴费操作审批提醒",
                            'color'=>"#000000",
                        ),
                        'keyword2'=>array(
                            'value'=>$admin_info['realname'],
                            'color'=>"#000000",
                        ),
                        'keyword3'=>array(
                            'value'=>$check_type==1?'同意':'驳回',
                            'color'=>$check_type==1?'#000000':"#000000",
                        ),
                        'keyword4'=>array(
                            'value'=>date('Y-m-d H:i:s',time()),
                            'color'=>"#000000",
                        ),
                    );
                    $url=C('WEB_DOMAIN') . '/wap.php?g=Wap&c=Receipt&a=check_receipt' . '&id=' . $request_id;
                    $user_list=array($admin_info_update['openid']);
                    $res = $wechat->send_tpl_messages($user_list, $tpl_id, $url, $data);
                    return array('err'=>0,'data'=>'操作成功！');
                }else{
                    return array('err'=>1,'data'=>'操作失败,请重试！');
                }
            }else{
                return array('err'=>1,'data'=>'状态不能识别');
            }
        }else{
            return array('err'=>1,'data'=>'审批失败，请重试');
        }

    }
}