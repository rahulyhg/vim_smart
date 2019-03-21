<?php
bpBase::loadAppClass('common', 'User', 0);
class recharge_controller extends common_controller{
    public $wx_user;
    public $tablepre;
    public $rr;
    public $ali_user;
    public $thirduserid;
    public function __construct(){
        parent::__construct();
        $this->authorityControl(array('getajaxOrder', 'getEwm', 'add_order', 'qrcode', 'weixinPay', 'sm_order', 'getSgin', 'pay'));
        session_start();
        $session_mid=$_SESSION['merchant']['mid'];
        //$this->wx_user = M('cashier_payconfig')->getwxuserConf($mid=$this->mid);
        $this->wx_user = $this->getwxuserConf($mid=$this->mid,$type="wx");
        //$this->ali_user = $this->getaliuserConf($mid=$this->mid,$type="ali");
        $db_config = loadConfig('db');
        $this->tablepre = $db_config['default']['tablepre'];
        unset($db_config);
        $info=M('cashier_merchants')->get_one(array('mid'=>$this->mid),'thirduserid');
        $this->thirduserid=$info['thirduserid'];//第三方唯一凭证（商户id）
    }


    /*
     * 商户替公司或员工）充值页面
     * 陈琦
     * 2016.11.21
     */
    public function up(){
        bpBase::loadOrg('common_page');

        $info=M('merchant')->get_one(array('mer_id'=>$this->thirduserid),'village_id');//查询当前商户的社区id
        $sqlObj = new model();
        $keyword=$_POST['keyword'];
        if($_POST['keyword']){
            //$count='select count(*) from '.$this->tablepre.'company where company_name like "%'.$keyword.'%" and village_id ='.$info['village_id'];//在有模糊查询条件下所查询的公司个数
            $count='select count(*)  from (SELECT a.company_id cid ,a.company_name name from '.$this->tablepre.'company as a left join '.$this->tablepre.'company_merchant_money as b on a.company_id =b.company_id where a.company_name like "%'.$keyword.'%" and a.village_id ='.$info['village_id'].')c LEFT JOIN (SELECT a.company_id id ,b.money money from '.$this->tablepre.'company as a LEFT JOIN '. $this->tablepre.'company_merchant_money as b on a.company_id = b.company_id where a.company_name like "%'.$keyword.'%" and a.village_id ='.$info['village_id'].' and b.mer_id = '.$this->thirduserid.')d on c.cid = d.id';
            $result = $sqlObj->selectBySql($count);
            $p = new Page($result[0]["count(*)"], 10);
            $pagebar = $p->show(2);
            $sqlStr='select distinct c.company_id,d.money, c.name from (SELECT a.company_id company_id ,a.company_name name from '.$this->tablepre.'company as a left join '.$this->tablepre.'company_merchant_money as b on a.company_id =b.company_id where a.company_name like "%'.$keyword.'%" and a.village_id ='.$info['village_id'].')c LEFT JOIN (SELECT a.company_id id ,b.money money from '.$this->tablepre.'company as a LEFT JOIN '. $this->tablepre.'company_merchant_money as b on a.company_id = b.company_id where a.company_name like "%'.$keyword.'%" and a.village_id ='.$info['village_id'].' and b.mer_id = '.$this->thirduserid.')d on c.company_id = d.id LIMIT '.$p->firstRow.',' . $p->listRows;

            $list = $sqlObj->selectBySql($sqlStr);
            $page=isset($_GET['page'])?$_GET['page']:1;
            foreach ($list as $key=>$value){
                $count_sql='select count(*) from '.$this->tablepre.'house_village_user_bind as a where a.company_id='.$value['company_id'];
                $count_arr = $sqlObj->selectBySql($count_sql);
                $count=$count_arr[0]["count(*)"];

                $count2='select distinct count(*) from '.$this->tablepre.'company as a where a.company_name like "%'.$keyword.'%" and a.village_id='.$info['village_id'];//只要满足基本条件（社区id）即算数
                $result2 = $sqlObj->selectBySql($count2);
                $arr=$result2[0]["count(*)"];
                $list[$key]['number'] = $key+1+10*($page-1);
                $list[$key]['count']=$count;
            }
        }else{
            $count='select count(*)  from (SELECT a.company_id cid ,a.company_name name from '.$this->tablepre.'company as a left join '.$this->tablepre.'company_merchant_money as b on a.company_id =b.company_id where a.village_id ='.$info['village_id'].')c LEFT JOIN (SELECT a.company_id id ,b.money money from '.$this->tablepre.'company as a LEFT JOIN '. $this->tablepre.'company_merchant_money as b on a.company_id = b.company_id where a.village_id ='.$info['village_id'].' and b.mer_id = '.$this->thirduserid.')d on c.cid = d.id';
            $result = $sqlObj->selectBySql($count);
            $p = new Page($result[0]["count(*)"], 10);
            $sqlStr='select distinct c.company_id,d.money, c.name from (SELECT a.company_id company_id ,a.company_name name from '.$this->tablepre.'company as a left join '.$this->tablepre.'company_merchant_money as b on a.company_id =b.company_id where a.village_id ='.$info['village_id'].')c LEFT JOIN (SELECT a.company_id id ,b.money money from '.$this->tablepre.'company as a LEFT JOIN '. $this->tablepre.'company_merchant_money as b on a.company_id = b.company_id where a.village_id ='.$info['village_id'].' and b.mer_id = '.$this->thirduserid.')d on c.company_id = d.id order by c.company_id desc LIMIT '.$p->firstRow.',' . $p->listRows;
            $pagebar = $p->show(2);

            $list = $sqlObj->selectBySql($sqlStr);
            $page=isset($_GET['page'])?$_GET['page']:1;
            foreach ($list as $key=>$value){
                $count_sql='select count(*) from '.$this->tablepre.'house_village_user_bind as a where a.company_id='.$value['company_id'];
                $count_arr = $sqlObj->selectBySql($count_sql);
                $count=$count_arr[0]["count(*)"];

                $count2='select distinct count(*) from '.$this->tablepre.'company as a where a.village_id='.$info['village_id'];//只要满足基本条件（社区id）即算数  公司人数
                $result2 = $sqlObj->selectBySql($count2);
                $arr=$result2[0]["count(*)"];
                $list[$key]['number'] = $key+1+10*($page-1);
                $list[$key]['count']=$count;
            }
        }
        include $this->showTpl();
    }




    /*
     * 公司充值明细
     * 陈琦
     * 2016.12.8
     */
    public function company_rechargeHistory(){
        bpBase::loadOrg('common_page');
        $sqlObj = new model();
        $page=isset($_GET['page'])?$_GET['page']:1;
        $count='select count(*) from '.$this->tablepre.'up as a  where a.mid='.$this->thirduserid. ' and a.company_id='.$_GET['company_id'].' and a.type=1';
        $result = $sqlObj->selectBySql($count);
        $record_count=$result[0]["count(*)"];
        $p = new Page($record_count, 10);
        $pagebar = $p->show(2);
        $sql='select a.* from '.$this->tablepre.'up as a where a.mid='.$this->thirduserid.' and a.company_id='.$_GET['company_id'].' and a.type=1 order by a.add_time desc LIMIT '.$p->firstRow.',' . $p->listRows;
        $arr = $sqlObj->selectBySql($sql);//充值记录
        //dump($arr);
        $company=M('company')->get_one(array('company_id'=>$_GET['company_id']),'company_name');
        foreach ($arr as $key=>$value){
            $arr[$key]['number'] = $key+1+10*($page-1);
        }
        include $this->showTpl();
    }




    /*
     * 所有充值记录
     * 陈琦
     * 2016.12.5
     */
    public function all_record(){
        bpBase::loadOrg('common_page');
        $page=isset($_GET['page'])?$_GET['page']:1;
        $sqlObj = new model();
        $count='select count(*) from '.$this->tablepre.'up as a left join '.$this->tablepre.'house_village_user_bind as b on a.uid=b.uid and a.company_id=b.company_id where a.mid='.$this->thirduserid;
        $result = $sqlObj->selectBySql($count);
        $record_count=$result[0]["count(*)"];
        $p = new Page($record_count, 10);
        $pagebar = $p->show(2);
        $sql='select a.*,b.name from '.$this->tablepre.'up as a left join '.$this->tablepre.'house_village_user_bind as b on a.uid=b.uid and a.company_id=b.company_id where a.mid='.$this->thirduserid.' order by a.add_time desc LIMIT '.$p->firstRow.',' . $p->listRows;
        $arr = $sqlObj->selectBySql($sql);//充值记录
        foreach ($arr as $key=>&$value){
            if($value['uid']==0){
                $company_name=M('company')->get_one(array('company_id'=>$value['company_id']),'company_name');
                $value['name']=$company_name['company_name'];
            }
            $arr[$key]['number'] = $key+1+10*($page-1);
        }
        unset($value);
        //dump($arr);
        include $this->showTpl();
    }




    /*
     *员工列表
     * 陈琦
     * 2016.12.5
     */
    public function user_list(){
        bpBase::loadOrg('common_page');//引入分页
        $company_id=$_GET['company_id'];
        $mid=$this->thirduserid;//传到前台要为充值记录作为传参传过去
        $count='select count(*) from (SELECT a.uid uid,a.company_id company_id, a.name name from '.$this->tablepre.'house_village_user_bind as a where a.company_id = '.$company_id.')c LEFT JOIN (SELECT a.uid id ,b.money money from '.$this->tablepre.'house_village_user_bind as a LEFT JOIN '. $this->tablepre.'user_merchant_money as b on a.uid = b.uid where a.company_id = '.$company_id.' and b.mer_id = '.$this->thirduserid.')d on c.uid = d.id';
        $sqlObj = new model();
        $count_result = $sqlObj->selectBySql($count);
        $record_count=$count_result[0]["count(*)"];
        $p = new Page($record_count, 10);
        $pagebar = $p->show(2);
        $r='select distinct c.uid,d.money, c.name,c.company_id,c.group_name,c.phone,c.nickname,c.card_type,c.usernum,c.add_time from (SELECT a.uid uid,a.company_id company_id, a.name name,a.phone phone,a.card_type card_type,a.usernum usernum,a.add_time add_time,u.nickname nickname, b.group_name group_name from '.$this->tablepre.'house_village_user_bind as a left join '.$this->tablepre.'user as u on a.uid=u.uid left join '.$this->tablepre.'user_group as b on a.group_id =b.group_id where a.company_id = '.$company_id.')c LEFT JOIN (SELECT a.uid id ,b.money money from '.$this->tablepre.'house_village_user_bind as a LEFT JOIN '. $this->tablepre.'user_merchant_money as b on a.uid = b.uid where a.company_id = '.$company_id.' and b.mer_id = '.$this->thirduserid.')d on c.uid = d.id order by c.add_time desc LIMIT '.$p->firstRow.',' . $p->listRows;
        $user_list = $sqlObj->selectBySql($r);//员工列表
        $company_info=M('company')->get_one(array('company_id'=>$company_id),'company_name');//前台显示公司名称
        $page=isset($_GET['page'])?$_GET['page']:1;
        foreach ($user_list as $key=>&$value){
            $user_list[$key]['number'] = $key+1+10*($page-1);//编号
            $user_info=M('user')->get_one(array('uid'=>$value['uid']),'now_money');
            if($value['money']===NULL){
                $value['money']=floatval(0);
            }
            $value['money']=$value['money']+$user_info['now_money'];
        }
        unset($value);
        //dump($user_list);
        include $this->showTpl();
    }




    /*
     * 员工充值页面
     * 陈琦
     * 2016.12.5
     */
    public function user_recharge(){
        $company_id=$_GET['company_id'];
        $uid=$_GET['uid'];
        if($uid){
            $user_name=M('house_village_user_bind')->get_one(array('uid'=>$uid),'name');
        }
        $company_info=M('company')->get_one(array('company_id'=>$company_id),'company_name');//前台显示公司名称
        include $this->showTpl();
    }




    /*
     * 员工充值
     * 陈琦
     * 2016.12.5
     */
    public function user_recharge_submit(){
        $merchant_info=M('cashier_merchants')->get_one(array('thirduserid'=>$this->thirduserid),'wxname');
        $merchantOb = M('user_merchant_money');
        $money = $_POST['money'];
        $money=floatval($money);
        if($money<0 || $money==0){
            //$this->errorTip("请输入正确金额！");
            $this->dexit(array('error'=>1,'msg'=>'请输入正确金额！'));
        }
        $uid = $_POST['uid'];
        $data=array(
            'uid'=>$uid,
            'mid'=>$this->thirduserid,
            'money'=>$money,
            'company_id'=>$_POST['company_id'],
            'type'=>2,
            'add_time'=>time(),
            'recharge_name'=>$merchant_info['wxname'],
            'cz_id'=>'cz'.time().mt_rand(100, 1000),
        );

        $company_money=M('company_merchant_money')->get_one(array('company_id'=>$_POST['company_id'],'mer_id'=>$this->thirduserid),'money');//公司在当前商户的余额
        if($money>$company_money['money']){
            //$this->errorTip("余额不足！");
            $this->dexit(array('error'=>1,'msg'=>'余额不足！'));
        }
        $a=$merchantOb->get_one(array('uid'=>$uid,'mer_id'=>$this->thirduserid),'money');
        if($a){//用户在当前商户充过钱
            $merchantOb->update(array('money'=>$a['money']+$money),array('uid'=>$uid,'mer_id'=>$this->thirduserid));
        }else{//用户未在当前商户充过钱
            $res=array(
                'uid'=>$uid,
                'mer_id'=>$this->thirduserid,
                'money'=>$money,
            );
            $merchantOb->insert($res,true);
        }
        $recharge=array(
            'uid'=>$uid,
            'type'=>1,
            'money'=>$money,
            'app_money'=>0,
            'merchant_money'=>$money,
            'time'=>$_SERVER['REQUEST_TIME'],
            'desc'=>'商户充值',
            'name'=>$merchant_info['wxname'],
            'order_id'=>'cz'.time().mt_rand(100, 1000),
            'mid'=>$this->thirduserid,
            'refund'=>1,
            'now_money'=>$a['money']+$money,
        );
        M('user_money_list')->insert($recharge,true);
        $result=M('up')->insert($data,true);//充值成功后进充值记录表
        M('company_merchant_money')->update(array('money'=>($company_money['money']-$money)),array('company_id'=>$_POST['company_id'],'mer_id'=>$this->thirduserid));
        if($result){
//			$this->successTip('充值成功！','./merchants.php?m=User&c=recharge&a=user_list&company_id='.$_POST['company_id']);
//			exit;
            $this->dexit(array('error'=>0,'msg'=>'充值成功！'));
        }
    }




    /*
     * 员工编辑
     * 陈琦
     * 2016.12.5
     */
    public function user_edit(){
        $company_id=$_GET['company_id'];
        $uid=$_GET['uid'];
        $sql='select a.* from '.$this->tablepre.'user_group as a where a.company_id='.$company_id;
        $sqlObj = new model();
        $group = $sqlObj->selectBySql($sql);
        $sql='select b.* from '.$this->tablepre.'house_village_user_bind as b where b.uid='.$uid;
        $res=$sqlObj->selectBySql($sql);//二维数组
        $user=$res[0];
        $user_name=M('house_village_user_bind')->get_one(array('uid'=>$uid),'name');
        $company_info=M('company')->get_one(array('company_id'=>$company_id),'company_name');//前台显示公司名称
        include $this->showTpl();
    }



    /*
     * 员工编辑表单提交
     * 陈琦
     * 2016.12.5
     */
    public function ue_submit(){
        $company_id=$_POST['company_id'];
        $group_id=$_POST['group_id'];
        $name=$_POST['name'];
        $phone=$_POST['phone'];
        if(empty($name)){
            $this->errorTip('姓名不能为空！');
        }
        if(empty($phone)){
            $this->errorTip('联系电话不能为空！');
        }
        if(empty(preg_match("/^1[34578]{1}\d{9}$/",$_POST['phone']))){
            $this->errorTip('联系电话格式有误！');
        }
        if($group_id){
            $result=M('house_village_user_bind')->update(array('group_id'=>$group_id,'name'=>$name,'phone'=>$phone),array('company_id'=>$company_id,'uid'=>$_POST['uid']));
            if($result){
                $this->successTip('编辑成功！','./merchants.php?m=User&c=recharge&a=user_list&company_id='.$_POST['company_id']);
                exit;
            }
        }
    }



    /*
     * 公司充值页面
     * 陈琦
     * 2016.12.5
     */
    public function company_recharge(){
        $company_id=$_GET['company_id'];
        if($company_id){
            $company_name=M('company')->get_one(array('company_id'=>$company_id),'company_name');
        }
        include $this->showTpl();
    }




    /*
     * 公司充值提交表单
     * 陈琦
     * 2016.12.5
     */
    public function company_recharge_submit(){
        $merchant_info=M('cashier_merchants')->get_one(array('thirduserid'=>$this->thirduserid),'wxname');
        $company_id=$_POST['company_id'];
        $money=$_POST['money'];
        if($money<0 || $money==0){
            //$this->errorTip("请输入正确金额！");
            $this->dexit(array('error'=>1,'msg'=>'请输入正确金额！'));
        }
        $fore_money=M('company_merchant_money')->get_one(array('company_id'=>$company_id,'mer_id'=>$this->thirduserid),'money');//公司原来的金额
        if($fore_money){//公司在当前商户充过钱
            $left_money=$fore_money['money']+$money;
            $result=M('company_merchant_money')->update(array('money'=>($fore_money['money']+$money)),array('company_id'=>$company_id,'mer_id'=>$this->thirduserid));//更新
        }else{//公司未在当前商户充过钱
            $result=M('company_merchant_money')->insert(array('company_id'=>$company_id,'money'=>$money,'mer_id'=>$this->thirduserid),true);//新增
            $left_money=$money;
        }
        $data=array(
            'uid'=>0,
            'mid'=>$this->thirduserid,
            'money'=>$money,
            'company_id'=>$_POST['company_id'],
            'type'=>1,
            'add_time'=>time(),
            'recharge_name'=>$merchant_info['wxname'],
            'cz_id'=>'cz'.time().mt_rand(100, 1000),
            //'left_money'=>$left_money
        );
        if($result){
            M('up')->insert($data,true);
            $this->dexit(array('error'=>0,'msg'=>'充值成功！'));
        }
    }




    /*
     * 公司各自的充值记录
     * 陈琦
     * 2016.12.5
     */
    public function record(){
        bpBase::loadOrg('common_page');//引入分页
        $sqlObj = new model();
        $page=isset($_GET['page'])?$_GET['page']:1;
        $company_id=$_GET['company_id'];
        $count='select count(*) from '.$this->tablepre.'up as a left join '.$this->tablepre.'house_village_user_bind as b on a.uid=b.uid and a.company_id=b.company_id where a.mid='.$this->thirduserid.' and a.company_id='.$company_id;
        $result = $sqlObj->selectBySql($count);//记录条数
        $record_count=$result[0]["count(*)"];
        $p = new Page($record_count, 10);
        $pagebar = $p->show(2);
        $sql='select a.*,b.name from '.$this->tablepre.'up as a left join '.$this->tablepre.'house_village_user_bind as b on a.uid=b.uid and a.company_id=b.company_id where a.mid='.$this->thirduserid.' and a.company_id='.$company_id.' order by a.add_time desc LIMIT '.$p->firstRow.',' . $p->listRows;
        $arr = $sqlObj->selectBySql($sql);//充值记录
        foreach ($arr as $key=>&$value){
            if($value['uid']==0){
                $company_name=M('company')->get_one(array('company_id'=>$value['company_id']),'company_name');
                $value['name']=$company_name['company_name'];
            }
            $arr[$key]['number'] = $key+1+10*($page-1);
        }
        unset($value);
        $company_info=M('company')->get_one(array('company_id'=>$company_id),'company_name');//前台显示公司名称
        include $this->showTpl();
    }




    /*
     * 分组管理
     * 陈琦
     * 2016.12.5
     */
    public function group(){
        bpBase::loadOrg('common_page');//引入分页
        $page=isset($_GET['page'])?$_GET['page']:1;
        $company_id=$_GET['company_id'];
        $page_count='select count(*) from '.$this->tablepre.'user_group as a where a.company_id='.$company_id;
        $sqlObj = new model();
        $count_result = $sqlObj->selectBySql($page_count);
        $record_count=$count_result[0]["count(*)"];
        $p = new Page($record_count, 10);
        $pagebar = $p->show(2);//分组管理
        $sql='select a.* from '.$this->tablepre.'user_group as a where a.company_id='.$company_id.' order by a.group_id desc LIMIT '.$p->firstRow.',' . $p->listRows;
        $arr = $sqlObj->selectBySql($sql);//分组列表
        foreach ($arr as $key=>$value){//查询组内成员人数
            $count_sql='select count(*) from '.$this->tablepre.'house_village_user_bind as a where a.company_id='.$company_id .' and a.group_id='.$value['group_id'];
            $count_arr = $sqlObj->selectBySql($count_sql);
            $count=$count_arr[0]["count(*)"];
            $arr[$key]['count']=$count;
            $arr[$key]['number'] = $key+1+10*($page-1);
        }
        $company_info=M('company')->get_one(array('company_id'=>$company_id),'company_name');//前台显示公司名称
        include $this->showTpl();
    }



    /*
     * 添加分组/页面
     * 陈琦
     * 2016.12.5
     */
    public function add_group(){
        $company_id=$_GET['company_id'];
        $company_info=M('company')->get_one(array('company_id'=>$company_id),'company_name');//前台显示公司名称
        include $this->showTpl();
    }



    /*
     * 添加分组/表单提交
     * 陈琦
     * 2016.12.5
     */
    public function ag_submit(){
        $group_name=$_POST['group_name'];
        if($group_name){
            $desc=$_POST['desc'];
            $company_id=$_POST['company_id'];
            $all=M('user_group')->get_all('*',$this->tablepre.user_group,array('company_id'=>$company_id));
            foreach ($all as $key=>$value){
                if($value['group_name']==$group_name){
                    $this->errorTip('已存在该组名！','./merchants.php?m=User&c=recharge&a=group&company_id='.$company_id);
                }
            }
            $result=M('user_group')->insert(array('group_name'=>$group_name,'desc'=>$desc,'company_id'=>$company_id),true);
            if($result){
                $this->successTip('添加成功！','./merchants.php?m=User&c=recharge&a=group&company_id='.$company_id);
                exit;
            }
        }else{
            $this->errorTip('请填写组名！');
        }

    }




    /*
     * 分组充值/页面
     * 陈琦
     * 2016.12.5
     */
    public function group_recharge(){
        $company_id=$_GET['company_id'];
        $group_id=$_GET['group_id'];
        $result=M('user_group')->get_one(array('group_id'=>$group_id),'*');
        $company_info=M('company')->get_one(array('company_id'=>$company_id),'company_name');//前台显示公司名称
        include $this->showTpl();
    }



    /*
     * 分组充值/表单提交
     * 陈琦
     * 2016.12.5
     */
    public function gr_submit(){
        $merchant_info=M('cashier_merchants')->get_one(array('thirduserid'=>$this->thirduserid),'wxname');
        $money = $_POST['money'];
        if($money<0 || $money==0){
            //$this->errorTip("请输入正确金额！");
            $this->dexit(array('error'=>1,'msg'=>'请输入正确金额！'));
        }
        $group_id = $_POST['group_id'];
        $mid=$this->thirduserid;
        $company_id=$_POST['company_id'];
        $sqlObj = new model();
        $result=M('house_village_user_bind')->get_all('*',$this->tablepre.house_village_user_bind,array('group_id'=>$group_id,'company_id'=>$company_id));//当前组名的所有用户
        $re=M('user_merchant_money')->get_all('uid',$this->tablepre.user_merchant_money,array('mer_id'=>$mid));//查询当前商户下存在的所有uid
        $all_uid=array();//存所有uid的一位数组
        foreach ($re as $key=>$value){
            $all_uid[]=$value['uid'];
        }
        $count_sql='select count(*) from '.$this->tablepre.'house_village_user_bind as a where a.group_id='.$group_id;
        $count_arr = $sqlObj->selectBySql($count_sql);
        $count=$count_arr[0]["count(*)"];//查询组内成员人数
        if($result){//当前组内有成员
            $company_money=M('company_merchant_money')->get_one(array('company_id'=>$company_id,'mer_id'=>$mid),'money');//公司在当前商户余额
            $row_money=$count*$money;//改组总共充值金额
            if($row_money>$company_money['money']){
                //$this->errorTip("余额不足！");
                $this->dexit(array('error'=>1,'msg'=>'余额不足！'));
            }
            foreach ($result as $key=>$value){
                $data=array(
                    'uid'=>$value['uid'],
                    'mid'=>$mid,
                    'money'=>$money,
                    'company_id'=>$company_id,
                    'type'=>2,
                    'add_time'=>time(),
                    'recharge_name'=>$merchant_info['wxname'],
                    'cz_id'=>'cz'.time().mt_rand(100, 1000),
                );

                $company_money=M('company_merchant_money')->get_one(array('company_id'=>$company_id,'mer_id'=>$mid),'money');//公司在当前商户余额
                $a=M('user_merchant_money')->get_one(array('uid'=>$value['uid'],'mer_id'=>$mid),'money');
                if(in_array($value['uid'],$all_uid)){
                    $succcess=M('user_merchant_money')->update(array('money'=>$a['money']+$money),array('uid'=>$value['uid'],'mer_id'=>$mid));//更新
                }else{
                    $succcess=M('user_merchant_money')->insert(array('money'=>$money,'uid'=>$value['uid'],'mer_id'=>$mid),true);//添加
                }
                $recharge=array(
                    'uid'=>$value['uid'],
                    'type'=>1,
                    'money'=>$money,
                    'app_money'=>0,
                    'merchant_money'=>$money,
                    'time'=>$_SERVER['REQUEST_TIME'],
                    'desc'=>'商户充值',
                    'name'=>$merchant_info['wxname'],
                    'order_id'=>'cz'.time().mt_rand(100, 1000),
                    'mid'=>$mid,
                    'refund'=>1,
                    'now_money'=>$a['money']+$money,
                );
                M('user_money_list')->insert($recharge,true);
                M('company_merchant_money')->update(array('money'=>($company_money['money']-$money)),array('company_id'=>$company_id,'mer_id'=>$mid));
                M('up')->insert($data,true);//循环的时候每次时间不一样
            }
            if($succcess){
                //$this->successTip('批量充值成功！','./merchants.php?m=User&c=recharge&a=group&company_id='.$company_id);
                $this->dexit(array('error'=>0,'msg'=>'批量充值成功！'));
            }
        }else{
            //$this->errorTip('请先添加组员！','./merchants.php?m=User&c=recharge&a=group&company_id='.$company_id);
            $this->dexit(array('error'=>1,'msg'=>'请先添加组员！'));
        }
    }



    /*
     * 分组编辑/页面
     * 陈琦
     * 2016.12.5
     */
    public function group_edit(){
        $company_id=$_GET['company_id'];
        $group_id=$_GET['group_id'];
        $result=M('user_group')->get_one(array('group_id'=>$group_id),'*');
        $company_info=M('company')->get_one(array('company_id'=>$company_id),'company_name');//前台显示公司名称
        include $this->showTpl();
    }



    /*
    * 分组编辑/表单提交
    * 陈琦
    * 2016.12.5
    */
    public function ge_submit(){
        $company_id=$_POST['company_id'];
        $group_id=$_POST['group_id'];//当前组id
        $group_name=$_POST['group_name'];
        if(empty($group_name)){
            $this->errorTip('组名不能为空！');
        }
        $desc=$_POST['desc'];
        $sql='select a.* from '.$this->tablepre.'user_group as a where a.company_id='.$company_id.' and a.group_id !='.$group_id;//除了当前组，其他组名
        $sqlObj = new model();
        $all = $sqlObj->selectBySql($sql);
        foreach ($all as $key=>$value){
            if($value['group_name']==$group_name){
                $this->errorTip('已存在该组名！','./merchants.php?m=User&c=recharge&a=group&company_id='.$company_id);
            }
        }
        $result=M('user_group')->update(array('group_name'=>$group_name,'desc'=>$desc),array('group_id'=>$group_id));
        if($result){
            $this->successTip('编辑成功！','./merchants.php?m=User&c=recharge&a=group&company_id='.$company_id);
            exit;
        }
    }




    public function group_del(){
        $group_id=$_GET['group_id'];
        $company_id=$_GET['company_id'];
        $arr=M('house_village_user_bind')->get_all('uid',$this->tablepre.house_village_user_bind,array('group_id'=>$_GET['group_id']));
        if($arr){
            $this->errorTip('该组尚有成员！','./merchants.php?m=User&c=recharge&a=group&company_id='.$company_id);
        }else{
            $del=M('user_group')->delete('group_id='.$group_id);
            if($del){
                $this->successTip('删除成功！','./merchants.php?m=User&c=recharge&a=group&company_id='.$company_id);
            }
        }
    }



    /*
     * 成员管理
     * 陈琦
     * 2016.12.5
     */
    public function user_manage(){
        bpBase::loadOrg('common_page');//引入分页
        $group_id=$_GET['group_id'];
        $company_id=$_GET['company_id'];
        $sql='select b.* from '.$this->tablepre.'user_group as b where b.company_id='.$company_id.' and b.group_id !='.$group_id;//该公司组名
        $sqlObj = new model();
        $count='select count(*) from '.$this->tablepre.'house_village_user_bind as c where c.group_id='.$group_id;
        $count_result = $sqlObj->selectBySql($count);
        $p = new Page($count_result[0]["count(*)"], 10);
        $pagebar = $p->show(2);
        $sql2='select a.* from '.$this->tablepre.'house_village_user_bind as a where a.company_id='.$company_id.' and a.group_id='.$group_id.' LIMIT '.$p->firstRow.',' . $p->listRows;//该组人名
        $user = $sqlObj->selectBySql($sql2);//该组人名
        $group = $sqlObj->selectBySql($sql);//该公司组名
        $this_group=M('user_group')->get_one(array('group_id'=>$group_id),'group_name');//当前组名
        $company_info=M('company')->get_one(array('company_id'=>$company_id),'company_name');//前台显示公司名称
        include $this->showTpl();
    }



    /*
     * 添加组员
     * 陈琦
     * 2016.12.5
     */
    public function add_user(){
        bpBase::loadOrg('common_page');//引入分页
        $sqlObj = new model();
        $company_id = $_GET['company_id'];
        $group_id = $_GET['group_id'];
        $count='select count(*) from ' . $this->tablepre . 'house_village_user_bind as a where a.company_id=' . $company_id . ' and a.group_id =0';
        $count_result = $sqlObj->selectBySql($count);
        $p = new Page($count_result[0]["count(*)"], 10);
        $pagebar = $p->show(2);
        $sql = 'select a.* from ' . $this->tablepre . 'house_village_user_bind as a where a.company_id=' . $company_id . ' and a.group_id =0 LIMIT '.$p->firstRow.',' . $p->listRows;
        $user = $sqlObj->selectBySql($sql);//用户名
        $result=M('user_group')->get_one(array('group_id'=>$group_id),'group_name');
        $group_name=$result['group_name'];
        $company_info=M('company')->get_one(array('company_id'=>$company_id),'company_name');//前台显示公司名称
        include $this->showTpl();
    }




    /*
     * 添加组员提交表单
     * 陈琦
     * 2016.12.5
     */
    public function au_submit(){
        $arr=$_POST['checkbox2'];
        //dump($arr);exit;
        if($arr){
            $group_id=$_POST['group_id'];
            $company_id=$_POST['company_id'];
            //dump($val);
            foreach ($arr as $key=>$val){
                $update=M('house_village_user_bind')->update(array('group_id'=>$group_id),array('uid'=>$val,'company_id'=>$company_id));
            }
            if($update){
                $this->successTip('添加成功！','./merchants.php?m=User&c=recharge&a=user_manage&company_id='.$company_id.'&group_id='.$group_id);
                exit;
            }
        }else{
            $this->errorTip('请选择成员！');
            exit;
        }
    }



    /*
     * 移动组员至别的组
     * 陈琦
     * 2016.12.5
     */
    public function move_user(){
        $arr=$_POST['checkbox2'];
        $group_id=$_POST['group_id'];//移动后组id
        $company_id=$_POST['company_id'];
        $this_group_id=$_POST['this_group_id'];//当前组id
        if(!empty($arr) && empty($group_id)){
            $this->errorTip('请选择操作！');
        }
        if(empty($arr) && !empty($group_id)){
            $this->errorTip('请选择人员！');
        }
        if(empty($arr) && empty($group_id)){
            $this->errorTip('请选择操作！');
        }
        if(!empty($arr) && !empty($group_id)){
            $group_name=M('user_group')->get_one(array('group_id'=>$group_id),'group_name');
            foreach($arr as $key=>$value){
                $update=M('house_village_user_bind')->update(array('group_id'=>$group_id),array('uid'=>$value));
            }
            if($update){
                $this->successTip('成功移至'.$group_name['group_name'].'!','./merchants.php?m=User&c=recharge&a=user_manage&company_id='.$company_id.'&group_id='.$this_group_id);
                exit;
            }
        }
    }



    /*
     * 剔除组员
     * 陈琦
     * 2016.11.30
     */
    public function user_del(){
        $uid=$_GET['uid'];
        $company_id=$_GET['company_id'];
        $group_id=$_GET['group_id'];
        $del=M('house_village_user_bind')->update(array('group_id'=>0),array('uid'=>$uid,'company_id'=>$company_id));
        if($del){
            $this->successTip('移除成功！','./merchants.php?m=User&c=recharge&a=user_manage&company_id='.$company_id.'&group_id='.$group_id);
        }
    }



    /*
     * 批量剔除组员
     * 陈琦
     * 2016.12.5
     */
    public function all_del(){
        if(IS_POST){
            $arr=$_POST['uid_arr'];
            $group_id=$_POST['group_id'];
            $company_id=$_POST['company_id'];
            foreach ($arr as $key=>$value){
                $update=M('house_village_user_bind')->update(array('group_id'=>0),array('uid'=>$value,'company_id'=>$company_id));
            }
            if($update){
                $sql2='select a.* from '.$this->tablepre.'house_village_user_bind as a where a.group_id='.$group_id;//该组人名
                $sqlObj = new model();
                $user = $sqlObj->selectBySql($sql2);//该组人名
                $list='<table width="50%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px; margin-bottom:20px;" class="table_list">';
                $list.='<thead><tr><td class="td_checkbox"><input type="checkbox" class="td_checkbox"  name="checkbox" value="checkbox" onclick="checkAll(this)" /></td>';
                $list.='<td class="td_left" width="5%" style="font-size:14px; font-weight:bold; color:#000000;">用户名</td>';
                $list.='<td class="td_left" width="5%" style="font-size:14px; font-weight:bold; color:#000000;">联系电话</td>';
                $list.='<td class="td_left" width="5%" style="font-size:14px; font-weight:bold; color:#000000;">证件类型</td>';
                $list.='<td class="td_left" width="5%" style="font-size:14px; font-weight:bold; color:#000000;">证件号</td>';
                $list.='<td class="td_left" width="5%" style="font-size:14px; font-weight:bold; color:#000000;">注册时间</td>';
                $list.='<td class="td_left" width="5%" style="font-size:14px; font-weight:bold; color:#000000;text-align:center;">操作</td></tr></thead>';
                if($user){
                    foreach ($user as $key=>$value){
                        if($value['card_type']==1){
                            $card_name='现场审核';
                        }elseif ($value['card_type']==2){
                            $card_name='门禁卡';
                        }elseif ($value['card_type']==3){
                            $card_name='身份证';
                        }elseif ($value['card_type']==4){
                            $card_name='工作牌';
                        }
                        $url='./merchants.php?m=User&c=recharge&a=user_del&company_id='.$company_id.'&group_id='.$group_id.'&uid='.$value['uid'];
                        $list.='<tr><td class="td_checkbox2"><input type="checkbox"  name="checkbox2[]" value="'.$value['uid'].'"/></td>';
                        $list.='<td class="td_left" width="5%">'.$value['name'].'</td>';
                        $list.='<td class="td_left" width="5%">'.$value['phone'].'</td>';
                        $list.='<td class="td_left" width="5%">'.$card_name.'</td>';
                        $list.='<td class="td_left" width="5%">'.$value['usernum'].'</td>';
                        $list.='<td class="td_left" width="5%">'.date('Y-m-d H:i:s',$value['add_time']).'</td>';
                        $list.='<td class="td_left" width="5%"><a href="'.$url.'"><div class="ff2">删除</div></a></td></tr>';
                    }
                }else{
                    $list.='<tr><td colspan="10">暂无记录</td></tr>';
                }
                $list.='</tbody></table>';

                $this->dexit(array('msg_code'=>0,'msg_data'=>$list));
            }else{
                $this->dexit(array('msg_code'=>1,'msg_data'=>'改变失败！'));
            }
        }
    }

}

?>
