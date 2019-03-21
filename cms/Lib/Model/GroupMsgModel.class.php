<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/7
 * Time: 16:02
 */
class GroupMsgModel extends Model
{
    protected $trueTableName = "pigcms_wxmsg";
    //发送状态
    const MSG_STATUS_UNSEND = 0; //未发送
    const MSG_STATUS_SEND = 1;   //已发送
    const MSG_STATUS_RETURNED = 2; //已退回

    protected $errCode = 0;
    protected $errMsg = "";
    protected $admin_id = 0;

    public function  _initialize(){
        parent::_initialize();
        $this->set_admin_id();
    }



    /**
     * @return string
     */
    public function getErrMsg()
    {
        return $this->errorMsg;
    }

    /**
     * @param string $errorMsg
     */
    public function setErrMsg($errorMsg)
    {
        $this->errorMsg = $errorMsg;
    }

    /**
     * @return int
     */
    public function getErrCode()
    {
        return $this->errorCode;
    }

    /**
     * @param int $errorCode
     */
    public function setErrCode($errorCode)
    {
        $this->errorCode = $errorCode;
    }

    //审核人角色
    protected $audit_role = array(45,68);
    //项目经理
    protected $audit_role_new = array(68);
    //部门经理
    public $role = array(45);
    //验证
    protected $_validate = array(
        array('send_type',array('fixed','moment'),'发送类型错误',self::MUST_VALIDATE,'in'),
        array('send_time,send_type','checkSendTime','请检查发送时间是否正确',self::MUST_VALIDATE,'callback'),
       // array('msg_type',array('image_text','image','text'),'消息类型错误！',self::MUST_VALIDATE,'in'),
        array('title','require','标题不允许为空',self::MUST_VALIDATE),
        array('digest','require','摘要不允许为空',self::MUST_VALIDATE),
        array('content','require','内容不允许为空',self::MUST_VALIDATE),
    );


    public function set_admin_id(){
        if(IS_WECHAT){
            $this->admin_id = user_info()['admin_id'];
        }else{
            $this->admin_id = session('admin_id');
        }
    }

    /**
     * @return int
     */
    public function get_admin_id()
    {
        return $this->admin_id;
    }


    //验证发送时间是否正确
    protected function checkSendTime($args){
        $send_time = $args['send_time'];
        $send_type = $args['send_type'];
        $re = true;
        if($send_type === "fixed"){
            if(!$send_time) $re = false;//定时发送必须设置时间
            if($send_time<time()) $re = false; //定时的时间必须大于当前时间
        }

       return $re;
    }

    //描述
    //获取消息类型
    protected function get_msg_type_name($type){
        $names = array(
            'image'=>'图片',
            'text'=>'纯文本',
            'image_text'=>'图文'
        );

        return $names[$type]?:"没有找到";
    }
    //获取发送类型
    protected function get_send_type_name($type){
        $names = array(
            'moment'=>'立即发送',
            'fixed'=>'定时发送',
        );

        return $names[$type]?:"没有找到";
    }
    //获取状态描述
    protected function get_status_name($type){
        $names = array(
            self::MSG_STATUS_UNSEND => '未审核',
            self::MSG_STATUS_SEND => '审核通过',
            self::MSG_STATUS_RETURNED => '审核未通过'
        );
        return $names[$type]?:"没有找到";
    }

    protected function get_status_name2($type){
        $names = array(
            self::MSG_STATUS_UNSEND => '未发送',
            self::MSG_STATUS_SEND =>  '已发送',
            self::MSG_STATUS_RETURNED => '已退回'
        );
        return $names[$type]?:"没有找到";
    }

    protected function get_status_name3($type){
        $names = array(
            self::MSG_STATUS_UNSEND => '确认发布',
            self::MSG_STATUS_SEND =>  '已发送',
            self::MSG_STATUS_RETURNED => '已退回'
        );
        return $names[$type]?:"没有找到";
    }


    //消息列表
    public function get_msg_list($msg_id=0){
            $map = array();
            $msg_id && $map['msg.id'] = array('eq',$msg_id);
            $field = array(
                'msg.id'=>'msg_id',
                'msg.*',
                'msg.village_ids',
                'msg.village_id',
                'msg.company_ids',
                'msg.company_id',
                'ifnull(c.company_name,"所有公司")'=>'company_name',
                'ifnull(hv.village_name,"所有社区")'=>'village_name',
                'a.realname'=>'publish_admin_name',

            );

            $list = $this->alias('msg')
                ->field($field)
                ->join('left join __COMPANY__ c on msg.company_id=c.company_id')
                ->join('left join __HOUSE_VILLAGE__ hv on hv.village_id = msg.village_id')
                ->join('left join __ADMIN__ a on a.id = msg.publish_admin_id')

                ->where($map)
                ->select();
            //md(mysql_error());
            if($list){
                foreach($list as $v){
                    $ids = explode(',',$v['audit_admin_id']);
                    foreach($ids as $id){
                        $arr[] = M('admin')->where(array('id'=>$id))->find()['realname'];
                    }
                }
                foreach($list as &$row){
                    $row['audit_admin_name']= implode(',',$arr);
                    $row['content']         = htmlspecialchars_decode($row['content']);
                    $row['msg_type_name']   = $this->get_msg_type_name($row['msg_type']);
                    $row['send_type_name']  = $this->get_send_type_name($row['send_type']);
                    $row['status_name']     = $this->get_status_name($row['status']);
                    $row['status_name2']    = $this->get_status_name2($row['status']);
                    $row['status_name3']    = $this->get_status_name3($row['status']);
                    $row['up_date_str']   = $row['update_time']?date("Y-m-d H:i",$row['update_time']):"";
                    $row['send_date_str']   = $row['send_time']?date("Y-m-d H:i",$row['send_time']):"";
                    $row['audit_page']      = C('WEB_DOMAIN') . '/wap.php?g=Wap&c=GroupMsg&a=audit&msg_id='.$row['id'];
                    $row['publish_page']    = C('WEB_DOMAIN') . '/wap.php?g=Wap&c=GroupMsg&a=group_msg_detail&msg_id='.$row['id'];
                    $row['msg_page']        = C('WEB_DOMAIN') . '/wap.php?g=Wap&c=GroupMsg&a=view_msg&msg_id=' .$row['id'];
                    $row['ruser_num'] =  $this->get_rusers_num($row['village_id'],$row['company_id']);
                }
            }


        return $list;

    }


    //单挑消息信息
    public function get_msg_info($msg_id){
        $info =  $this->get_msg_list($msg_id)[0];
        return $info;
    }




    //

    /**
     * 新增/编辑消息
     * @param $data 表单提交信息
     * $data struct: array(
     *       'village_id'=>$village_id,//社区id
     *       'company_id'=>$company_id,//公司id
     *       'uids'=>'',
     *       'title'=>$title,//标题
     *       'cover'=>"",//封面
     *       'digest'=>$digest,//摘要
     *       'publish_admin_id'=>$publish_admin_id,//添加消息的管理员
     *       'audit_admin_id'=>'',//审核管理员ID
     *       'status'=>$status,//审核状态
     *       'content'=>$content,//内容
     *       'url'=>'',
     *       'send_type'=>$send_type,//发送方式
     *       'send_time'=>$send_time,
     *       'msg_type'=>$msg_type,//消息类型 图文 or 纯文本
     *       'update_time'=>0, //审核时间
     *       'create_time'=>time(), //添加时间
     *       'is_del'=>0,//是否逻辑删除
     * );
     */
    public function save_group_msg($data){
        if($msg_id = $data['id']){//编辑的时候消息状态需要更新
            $db_msg_info = $this->get_msg_info($msg_id);
            switch ($db_msg_info['status']){
                case self::MSG_STATUS_UNSEND : //为发送的消息状态不变
                    $data['status'] = self::MSG_STATUS_UNSEND;
                    break;
                case self::MSG_STATUS_SEND:   //已发送的消息状态不变
                    $data['status'] = self::MSG_STATUS_SEND;
                    break;
                case self::MSG_STATUS_RETURNED: //已退回的消息状态，改变为未发送
                    $data['status'] = self::MSG_STATUS_UNSEND;
                    break;
            }
            $data['update_time'] = time();
            $data['publish_admin_id'] = $this->admin_id;
        }else{//新增
            $data['create_time'] = time();
            $data['publish_admin_id'] = $this->admin_id;
        }
        if($this->create($data)){
            return $this->add($data,'',true);
        }else{
            return false;
        }
    }

    //设置消息状态
    public function set_msg_status($msg_id,$to_status){
        return $this->where('id=%d',$msg_id)->setField('status',$to_status);
    }

    public function set_msg_status_new($msg_id)
    {
        return $this->where('id=%d',$msg_id)->setField('status_a',1);
    }
    //设置发送人
    public function set_publish_admin_id($msg_id,$admin_id){
        return $this->where('id=%d',$msg_id)->setField('publish_admin_id',$admin_id);
    }
    //设置审核人
    public function set_audit_admin_id($msg_id,$admin_id){
        $res = $this->where('id=%d',$msg_id)->getField('audit_admin_id');
        $arr = explode(',',$res);
        array_push($arr,$admin_id);
        $admin_ids = trim(implode(',',$arr),',');
        return $this->where('id=%d',$msg_id)->setField('audit_admin_id',$admin_ids);
    }
    //更新发送时间
    public function set_send_time($msg_id){
        return $this->where('id=%d',$msg_id)->setField('send_time',time());
    }







    //审核操作
    public function audit_act($msg_id,$to_status){
        $msg_info = $this->get_msg_info($msg_id);
        $db_status = $msg_info['status'];
        $re = true;
        switch($db_status){
            case self::MSG_STATUS_UNSEND:
                $re1 = $this->set_msg_status($msg_id,$to_status);//修改消息状态
                $re2 = $this->set_audit_admin_id($msg_id,$this->admin_id);//设置审核人
                $re = $re1!==false && $re2!==false;
                if(!$re){
                    $this->setErrCode(1);
                    $this->setErrMsg("发生错误，审核失败!".mysql_error());
                }
                break;
            case self::MSG_STATUS_SEND:
                $re = false;
                $this->setErrCode(2);
                $this->setErrMsg("该消息已发送!");
                break;
            case self::MSG_STATUS_RETURNED:
                $re = false;
                $this->setErrCode(3);
                $this->setErrMsg("该消息已被退回!");

        }
        return $re;
    }

    /**
     * @author zhukeqin
     * @param $msg_id
     * @return bool
     * 判断是否已发送给项目经理
     */
    public function audit_act_new($msg_id)
    {
        $msg_info = $this->get_msg_info($msg_id);
        $status = $msg_info['status_a'];
        switch($status){
            case self::MSG_STATUS_UNSEND:
                $re1 = $this->set_msg_status_new($msg_id);
                //设置审核人
                $re2 = $this->set_audit_admin_id($msg_id,$this->admin_id);
                $re = $re1!==false && $re2!==false;
                if(!$re){
                    $this->setErrCode(1);
                    $this->setErrMsg("发生错误，推送失败!".mysql_error());
                }
                break;
            case self::MSG_STATUS_SEND:
                $re = false;
                $this->setErrCode(2);
                $this->setErrMsg("该消息已发送给项目经理审核!");
                break;
        }
        return $re;
    }


    //发送消息，自动判断是定时发送还是及时发送
    public function auto_send_msg($msg_id){
        $msg_info = $this->get_msg_info($msg_id);
        switch($msg_info['send_type']){
            case 'fixed':
                $re = $this->send_delayed_msg($msg_id,$msg_info['send_time']);
                break;
            case 'moment':
                $re = $this->send_now_msg($msg_id);
                break;
            default :
                $re = false;
                break;
        }
        return $re;
    }

    //发送消息-定时发送
    public function send_delayed_msg($msg_id,$sendtimestamp){
        //添加到定时任务，给任务分发
        $connect = new Memcached;  //声明一个新的memcached链接
        $connect->setOption(Memcached::OPT_COMPRESSION, false); //关闭压缩功能
        $connect->setOption(Memcached::OPT_BINARY_PROTOCOL, true); //使用binary二进制协议
        $connect->addServer('f120e580f9b74ec5.m.cnhzaliqshpub001.ocs.aliyuncs.com', 11211); //添加OCS实例地址及端口号
        $group_msg = unserialize($connect->get('group_msg'))?:array();
        $add_msg =array();
        $add_msg['msg_id'] = $msg_id;
        $add_msg['send_time'] = $sendtimestamp;
        $group_msg[] = $add_msg;
        return $connect->set('group_msg',serialize($group_msg));
    }

    //发送消息-及时发送
    public function send_now_msg($msg_id){
        //即定时在3秒后发送
        return $this->send_delayed_msg($msg_id,time()+1);
    }

    //给任务调度器调用的方法
    //1 发送群发消息
    //2 继续发送消息
    public function send_group_msg_act($msg_id){
        ini_set('max_execution_time', '0');//取消超时限制
        $wechat_model = new WechatModel();
        $msg_info = $this->get_msg_info($msg_id); //消息信息
        $this->set_send_time($msg_id); //更新发送时间


        //判断是继续发送还是重新发送
        $ctr = $wechat_model->get_ctr($msg_info['ctr_name']);
        if($ctr){//若是unserialize($ctr['opneids'])为空也继续发送，继续发送时会停止，也达到了目的
            return $this->continue_send_msg($msg_info['ctr_name']);
        }

        //openids
        $openids = $this->get_ruser_openids($msg_info['village_id'],$msg_info['company_id']);
//        $openids = array(
//            'ohgcf0jY6c8Rnj8hgkJw8mcVpOR8',
//            'ohgcf0jY6c8Rnj8hgkJw8mcVpOR8',
//            'ohgcf0jY6c8Rnj8hgkJw8mcVpOR8',
//            'ohgcf0jY6c8Rnj8hgkJw8mcVpOR8',
//            'ohgcf0jY6c8Rnj8hgkJw8mcVpOR8',
//            'ohgcf0jY6c8Rnj8hgkJw8mcVpOR8',
//            'ohgcf0jY6c8Rnj8hgkJw8mcVpOR8',
//            'ohgcf0jY6c8Rnj8hgkJw8mcVpOR8',
//            'ohgcf0jY6c8Rnj8hgkJw8mcVpOR8',
//        );
//        if(count($openids)>20) return false;//测试
        //模板ID
        $tpl_id = $wechat_model::TPLID_WYGLTZ;
        //社区名称
        $village_name = $msg_info['village_id']?$msg_info['village_name']:"";
        $data = array(
            'first'=>array(
                'value'=>"尊敬的{$village_name}业主",
                'color'=>"#029700",
            ),
            'keyword1'=>array(
                'value'=>$msg_info['title'],
                'color'=>"#000000",
            ),
            'keyword2'=>array(
                'value'=>date("Y-m-d H:i"),
                'color'=>"#000000",
            ),
            'keyword3'=>array(
                'value'=>$msg_info['digest'],
                'color'=>"#000000",
            ),
            'keyword4'=>array(
                'value'=>"点击查看详情",
                'color'=>"#000000",
            ),
        );
        return $wechat_model->send_tpl_messages2($openids,$tpl_id,$msg_info['msg_page'],$data,'',$msg_info['ctr_name']);
    }

    //继续发送消息
    public function continue_send_msg($ctr_name){
        $model = new WechatModel();
        $ctr = $model->get_ctr($ctr_name);
        //$this->ctr_on($ctr_name);
        return $model->send_tpl_messages2($ctr['openids'],$ctr['tpl_id'],$ctr['url'],$ctr['data'],$ctr['color'],$ctr_name);
    }

    //自动生成的ctr_name
    public function auto_set_ctr_name($msg_id){
        $msg_info = $this->get_msg_info($msg_id);
        //当天的ctr_name 不会有变化 也就是说，每条信息当天只能推送一次
        $ctr_name = $msg_info['title'] . '_' . date("Ymd");
        return $this->where('id=%d',$msg_id)->setField('ctr_name',$ctr_name);
    }
    //注册开关
    public function set_ctr($openids,$tpl_id,$url,$data,$color,$ctr_name){
        $model = new WechatModel();
        return $model->set_ctr($openids,$tpl_id,$url,$data,$color,$ctr_name);
    }
    //开关-开
    public function ctr_on($ctr_name){
        return M('wxmsg_ctr','pigcms_')->where('name="%s"',$ctr_name)->setField('on',1);
    }
    //开关-关
    public function ctr_off($ctr_name){
        return M('wxmsg_ctr','pigcms_')->where('name="%s"',$ctr_name)->setField('on',0);
    }


    //推送审核消息
    public function send_to_audit($msg_id){
        //微信类库
        $wechat = new WechatModel();
        $role_ids = $this->role;
        $map = array();
        //标记
        $msg_info = $this->get_msg_info($msg_id);

        //$map['role_id'] = array('in',$role_ids);
        //将role_id字段变成varchar类型之后新的角色查询办法 by zhukeqin
        foreach ($role_ids as $v){
            $string[]='find_in_set(\''.$v.'\',role_id)';
        }
        //dump($string);die;
        $map['_string']=implode(' or ',$string);
        $map['village_id'] = $msg_info['village_id'];
        $admins = M('admin')->where($map)->select();
        $openids = array();
        foreach($admins as $admin){
            if($admin['openid']){
                $openids[] = $admin['openid'];
            }
        }
        $openids = array_unique($openids);
        //dump($openids);die;
        //TODO::测试
//        $openids = array(
//            'ohgcf0jY6c8Rnj8hgkJw8mcVpOR8'
//        );
        //流程审批提醒模板ID
        //标记1
        $tpl_id = $wechat::TPLID_LCSPTX;
        $data = array(
            'first'=>array(
                'value'=>"微信群发通知审核提醒",
                'color'=>"#029700",
            ),
            'keyword1'=>array(
                'value'=>"微信群发通知审核提醒",
                'color'=>"#000000",
            ),
            'keyword2'=>array(
                'value'=>session('admin_name'),//必然是PC端
                'color'=>"#000000",
            ),
            'keyword3'=>array(
                'value'=>$msg_info['title'],
                'color'=>"#000000",
            ),
            'keyword4'=>array(
                'value'=>date('Y-m-d H:i:s',time()),
                'color'=>"#000000",
            ),
        );
        $res = $wechat->send_tpl_messages($openids, $tpl_id, $msg_info['audit_page'], $data);
        return $res;
    }

    //推送审核消息给项目经理
    public function send_to_audit_new($msg_id){
        //微信类库
        $wechat = new WechatModel();
        $role_ids = $this->audit_role_new;
        $map = array();
        //标记
        $msg_info = $this->get_msg_info($msg_id);

        //$map['role_id'] = array('in',$role_ids);
        //将role_id字段变成varchar类型之后新的角色查询办法 by zhukeqin
        foreach ($role_ids as $v){
            $string[]='find_in_set(\''.$v.'\',role_id)';
        }
        //dump($string);die;
        $map['_string']=implode(' or ',$string);
        $map['village_id'] = $msg_info['village_id'];
        $admins = M('admin')->where($map)->select();
        $openids = array();
        foreach($admins as $admin){
            if($admin['openid']){
                $openids[] = $admin['openid'];
            }
        }
        $openids = array_unique($openids);
        //dump($openids);die;
        //TODO::测试
//        $openids = array(
//            'ohgcf0jY6c8Rnj8hgkJw8mcVpOR8'
//        );
        //流程审批提醒模板ID
        //标记1
        $tpl_id = $wechat::TPLID_LCSPTX;
        $data = array(
            'first'=>array(
                'value'=>"微信群发通知审核提醒",
                'color'=>"#029700",
            ),
            'keyword1'=>array(
                'value'=>"微信群发通知审核提醒",
                'color'=>"#000000",
            ),
            'keyword2'=>array(
                'value'=>session('admin_name'),//必然是PC端
                'color'=>"#000000",
            ),
            'keyword3'=>array(
                'value'=>$msg_info['title'],
                'color'=>"#000000",
            ),
            'keyword4'=>array(
                'value'=>date('Y-m-d H:i:s',time()),
                'color'=>"#000000",
            ),
        );
        $wechat->send_tpl_messages($openids, $tpl_id, $msg_info['audit_page'], $data);
    }

    //向发布者推送消息：退回修改消息
    public  function send_to_publish($msg_id){
        //微信类库
        $wechat = new WechatModel();
        $msg_info = $this->get_msg_info($msg_id);

        //获取微信openid
        $openid =  M('admin','pigcms_')
            ->where('id=%d',$msg_info['publish_admin_id'])
            ->getField('openid');

        //流程审批提醒模板ID
        $tpl_id = $wechat::TPLID_LCSPTX;
        $data = array(
            'first'=>array(
                'value'=>"微信群发通知审核提醒",
                'color'=>"#029700",
            ),
            'keyword1'=>array(
                'value'=>"退回修改意见提醒",
                'color'=>"#000000",
            ),
            'keyword2'=>array(
                'value'=>session('admin_name'),//人
                'color'=>"#000000",
            ),
            'keyword3'=>array(
                'value'=>$msg_info['title'],
                'color'=>"#000000",
            ),
            'keyword4'=>array(
                'value'=>date('Y-m-d H:i:s',time()),
                'color'=>"#000000",
            ),
        );
        $res = $wechat->send_tpl_messages(array($openid), $tpl_id, $msg_info['publish_page'], $data);
        return $res;

    }



    //基础数据获取
    //社区 select
    public function get_village_list(){
        return M('house_village')->where('status=1')->select();
    }
    /**
     * @author zhukeqin
     * 获取对应的社区详情
     * @return bool
     */
    public function get_village_info($village_id){
        return M('house_village')->where('village_id='.$village_id)->find();
    }
    //公司 select
    public function get_company_list($village_id=0){
        $map = array();
        $village_id && $map['village_id'] = array('eq',$village_id);
        return M('company')->where($map)->select();
    }


    //消息接收者列表
    public function get_rusers_list($village_id=0,$company_id=0){
        $map = array();
        $village_id && $map['ub.village_id'] = array('eq',$village_id);
        $company_id && $map['ub.company_id'] = array('eq',$company_id);
        //获取用户
        $list = M('user')->alias('u')
            ->field('u.openid,u.nickname,u.avatar')
            //是有认证过用户才可以发送
            ->join('join __HOUSE_VILLAGE_USER_BIND__ ub on u.uid = ub.uid')
            ->where($map)
            ->select();
        return $list;
    }

    //获取消息接收者人数
    public function get_rusers_num($village_id=0,$company_id=0){
        $map = array();
        $village_id && $map['ub.village_id'] = array('eq',$village_id);
        $company_id && $map['ub.company_id'] = array('eq',$company_id);
        //获取用户
        $count = M('user')->alias('u')
            ->field('u.openid','u.user_wxnik','user_headerimg')
            //是有认证过用户才可以发送
            ->join('join __HOUSE_VILLAGE_USER_BIND__ ub on u.uid = ub.uid')
            ->where($map)
            ->count();
        return $count;
    }


    //获取推送对象openids
    public function  get_ruser_openids($village_id=0,$company_id=0){
        $list = $this->get_rusers_list($village_id,$company_id);
        return array_column($list,'openid');
    }

    /**
     * @author zhukeqin
     * 获取角色信息
     * @return array
     */
    public function getAuditRole($msg_id,$openid)
    {
        $map = array();
        $msg_info = $this->get_msg_info($msg_id);
        $map['openid'] = $openid;
        $map['village_id'] = $msg_info['village_id'];
        $admins = M('admin')->where($map)->find();
        return $admins;
    }
    /**
     * @author zhukeqin
     * 检查是否是审核人员
     * @return bool
     */
    public function is_audit($msg_id,$openid)
    {
        $roleids=$this->audit_role;
        //获取角色信息123
        $admins=$this->getAuditRole($msg_id,$openid);
        $roleid=explode(',',$admins['role_id']);
        $return=false;
        foreach ($roleid as $v){
            if(in_array($v,$roleids)){
                $return=true;
                break;
            }
        }
        return $return;
    }
    /**
     * @author zhukeqin
     * 当前是否允许打开审核页面状态 123
     * @return int 0 未打开  1  打开   2 目前全部小区设定不允许
     */
    public function is_wxmsg($msg_id,$village_id='')
    {
        //以社区ID为最优先级
        if(empty($village_id)){
            $msg_info = $this->get_msg_info($msg_id);
        }else{
            $msg_info['village_id']=$village_id;
        }
        //目前不允许发送全部项目
        if($msg_info['village_id']=='0'){
            return 2;
        }
        $village_info=$this->get_village_info($msg_info['village_id']);
        return $village_info['is_wxmsg'];
    }
    /**
     * @author zhukeqin
     * 修改允许打开审核页面状态，返回改变后的状态
     * @return int 123
     */
    public function change_wxmsg($village_id)
    {
        if($village_id=='0'){
            return false;
        }
        $village_info=$this->get_village_info($village_id);
        //取非操作
        $data['is_wxmsg']=!$village_info['is_wxmsg'];
        $return=M('house_village')->data($data)->where('village_id='.$village_id)->save();
        return $data['is_wxmsg'];

    }

}