<?php
bpBase::loadAppClass('common', 'User', 0);
class company_controller extends common_controller
{
    public $tablepre;
    public function __construct()
    {
        parent::__construct();
        session_start();
        $db_config = loadConfig('db');
        $this->tablepre = $db_config['default']['tablepre'];
        unset($db_config);

    }


    /*
    * 商户列表页面
    * 陈琦
    * 2016.11.29
    */
    public function index(){
        bpBase::loadOrg('common_page');//引入分页
        $page=isset($_GET['page'])?$_GET['page']:1;
        $company_id=$_SESSION['company']['company_id'];//公司id
        $sqlObj = new model();
        $count_sql='select count(*) from '.$this->tablepre.'company_merchant_money as a where a.company_id ='.$company_id.' and a.money>0';//查询当前公司所充值过商户的个数
        $count_res = $sqlObj->selectBySql($count_sql);
        $record_count=$count_res[0]["count(*)"];//个数
        $p = new Page($record_count, 10);
        $pagebar = $p->show(2);
        //$sql='select a.*,b.name from '.$this->tablepre.'company_merchant_money as a left join '.$this->tablepre.'merchant as b on a.mer_id=b.mer_id where a.company_id ='.$company_id.' and b.money>0 order by a.id desc LIMIT '.$p->firstRow.',' . $p->listRows;
        //$sql='select m.mer_id,case when c.money is null then 0 else c.money end as money from '.$this->tablepre.' merchant m LEFT JOIN '.$this->tablepre.' company_merchant_money c on m.mer_id = c.mer_id where m.is_recharge=1';
        //$result = $sqlObj->selectBySql($sql);
       // dump($result);exit;
       // foreach ($result as $key=>$value){
       //     $result[$key]['number'] = $key+1+10*($page-1);//编号
       // }
        $sql1='select a.* from '.$this->tablepre.'merchant as a where a.is_recharge =1';
        $result1 = $sqlObj->selectBySql($sql1);//开启充值的商户
        $sql2='select b.* from '.$this->tablepre.'company_merchant_money as b where b.company_id='.$company_id;
        $result2=$sqlObj->selectBySql($sql2);//当前公司充值过商户的记录
        $res1=array();
        foreach ($result2 as $key=>$value){
            $res1[$key]=$value['mer_id'];
        }
        foreach ($result1 as $key=>$value){
            $result1[$key]['number'] = $key+1+10*($page-1);//编号
            $result1[$key]['company_id']=$company_id;
            if (in_array($value['mer_id'], $res1)) {
                //当前公司下指定商户下的充值信息
                $ss=M('company_merchant_money')->get_one(array('company_id'=>$company_id,'mer_id'=>$value['mer_id']),'*');
                $result1[$key]['R_money'] = $ss['money'];//一个虚拟的R_money字段
            } else {
                $result1[$key]['R_money'] = 0;
            }
        }
        //dump($result1);exit;
        include $this->showTpl();
    }



    /*
     * 员工列表页面(不同商户下员工当下的余额不同)
     * 陈琦
     * 2016.11.29
     */
    public function user_list(){
        bpBase::loadOrg('common_page');//引入分页
        $page=isset($_GET['page'])?$_GET['page']:1;
        $company_id=$_GET['company_id'];
        $mid=$_GET['mid'];//传到前台要为充值记录作为传参传过去
        $merchant=M('merchant')->get_one(array('mer_id'=>$mid),'name');//商户名称
        $merchant_name=$merchant['name'];
        $count_sql='select count(*) from '.$this->tablepre .'house_village_user_bind as a where a.company_id='.$company_id.' and (a.ac_status=2 or a.ac_status=4)';//查询员工人数
        $sqlObj = new model();
        $count_res = $sqlObj->selectBySql($count_sql);
        $record_count=$count_res[0]["count(*)"];//个数
        $p = new Page($record_count, 10);
        $pagebar = $p->show(2);
        $user_sql='select c.uid,d.money, c.name,c.company_id,c.group_name,c.phone,c.nickname,c.card_type,c.usernum,c.add_time 
            from (SELECT a.uid uid,a.company_id company_id,a.card_type card_type,a.usernum usernum,a.add_time add_time, 
            a.name name,a.phone phone,u.nickname nickname,b.group_name group_name from '.$this->tablepre.'house_village_user_bind 
            as a left join '.$this->tablepre.'user as u on a.uid=u.uid left join '.$this->tablepre.'user_group as b 
            on a.group_id =b.group_id where a.company_id = '.$company_id.' and (a.ac_status=2 or a.ac_status=4))c LEFT JOIN (SELECT a.uid id ,b.money money 
            from '.$this->tablepre.'house_village_user_bind as a  LEFT JOIN '. $this->tablepre.'user_merchant_money as b 
            on a.uid = b.uid where a.company_id = '.$company_id.' and (a.ac_status=2 or a.ac_status=4) and b.mer_id = '.$mid.')d on c.uid = d.id order by c.add_time desc LIMIT '.$p->firstRow.',' . $p->listRows;
        $user_list = $sqlObj->selectBySql($user_sql);//员工列表
        foreach ($user_list as $key=>&$value){
            $user_list[$key]['number'] = $key+1+10*($page-1);//编号
            $user_info=M('user')->get_one(array('uid'=>$value['uid']),'now_money');
            if($value['money']===NULL){
                $value['money']=floatval(0);
            }
            $value['money']=$value['money']+$user_info['now_money'];
            $in_sql='select sum(money) from '.$this->tablepre.'user_money_list as a where a.uid='.$value['uid'].' and a.type=1';//收入总和
            $out_sql='select sum(money) from '.$this->tablepre.'user_money_list as a where a.uid='.$value['uid'].' and a.type=2';//支出总额
            $in_arr=$sqlObj->selectBySql($in_sql);
            $out_arr=$sqlObj->selectBySql($out_sql);
            $value['in_money']=$in_arr[0]['sum(money)'];
            $value['out_money']=$out_arr[0]['sum(money)'];
        }
        unset($value);
        include $this->showTpl();
    }



    /*
     * 员工编辑页面（编辑属于哪组）
     * 陈琦
     * 2016.11.29
     */
    public function user_edit(){
        $company_id=$_GET['company_id'];
        $uid=$_GET['uid'];
        $mid=$_GET['mid'];
        $merchant=M('merchant')->get_one(array('mer_id'=>$mid),'name');//商户名称
        $merchant_name=$merchant['name'];
        $sql='select a.* from '.$this->tablepre.'user_group as a where a.company_id='.$company_id;
        $sqlObj = new model();
        $group = $sqlObj->selectBySql($sql);
        $sql2='select b.* from '.$this->tablepre.'house_village_user_bind as b where b.uid='.$uid;
        $res=$sqlObj->selectBySql($sql2);//二维数组
        $user=$res[0];
        $user_name=M('house_village_user_bind')->get_one(array('uid'=>$uid),'name');
        include $this->showTpl();
    }


    /*
     * 员工编辑表单提交
     * 陈琦
     * 2016.11.29
     */
    public function ue_submit(){
        $company_id=$_POST['company_id'];
        $group_id=$_POST['group_id'];
        $uid=$_POST['uid'];
        $mid=$_POST['mid'];
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
            $result=M('house_village_user_bind')->update(array('group_id'=>$group_id,'name'=>$name,'phone'=>$phone),array('company_id'=>$company_id,'uid'=>$uid));
            if($result){
                if($mid){
                    $this->successTip('编辑成功！','./merchants.php?m=User&c=company&a=user_list&company_id='.$company_id.'&mid='.$mid);
                    exit;
                }else{
                    $this->successTip('编辑成功！','./merchants.php?m=User&c=company&a=left_userList&company_id='.$company_id);
                    exit;
                }

            }
        }
    }



    /*
     * 充值记录（不同商户下充值记录不同）
     * 陈琦
     * 2016.11.29
     */
    public function record(){
        bpBase::loadOrg('common_page');//引入分页
        $page=isset($_GET['page'])?$_GET['page']:1;
        $company_id=$_GET['company_id'];
        $mid=$_GET['mid'];
        $merchant=M('merchant')->get_one(array('mer_id'=>$mid),'name');//商户名称
        $merchant_name=$merchant['name'];
        $count='select count(*) from '.$this->tablepre.'up as a left join '.$this->tablepre.'house_village_user_bind as b on a.uid=b.uid and a.company_id=b.company_id where a.mid='.$mid.' and a.company_id='.$company_id;
        $sqlObj = new model();
        $result = $sqlObj->selectBySql($count);
        $p = new Page($result[0]["count(*)"], 10);
        $page=isset($_GET['page'])?$_GET['page']:1;
        $pagebar = $p->show(2);
        $sql='select distinct a.*,b.name from '.$this->tablepre.'up as a left join '.$this->tablepre.'house_village_user_bind as b on a.uid=b.uid and a.company_id=b.company_id where a.mid='.$mid.' and a.company_id='.$company_id.' order by a.add_time desc LIMIT '.$p->firstRow.',' . $p->listRows;
        $record = $sqlObj->selectBySql($sql);//充值记录
        foreach ($record as $key=>&$value){
            if($value['uid']==0){//当是公司充值的时候，即uid为0时，赋公司名
                $company_name=M('company')->get_one(array('company_id'=>$value['company_id']),'company_name');
                $value['name']=$company_name['company_name'];
            }
            $record[$key]['number'] = $key+1+10*($page-1);
        }
        unset($value);
        $record_count=$result[0]['count(*)'];//记录数
        //dump($record);exit;
        include $this->showTpl();
    }



    /*
     * 所有商户下充值记录
     * 陈琦
     * 2016.11.30
     */
    public function all_record(){
        bpBase::loadOrg('common_page');//引入分页
        $page=isset($_GET['page'])?$_GET['page']:1;
        $company_id=$_GET['company_id'];
        $count='select count(*) from '.$this->tablepre.'up as a left join '.$this->tablepre.'house_village_user_bind as b on a.uid=b.uid and a.company_id=b.company_id where a.company_id='.$company_id;
        $sqlObj = new model();
        $result = $sqlObj->selectBySql($count);
        $record_count=$result[0]["count(*)"];
        $p = new Page($record_count, 10);
        $pagebar = $p->show(2);
        $sql='select a.*,b.name from '.$this->tablepre.'up as a left join '.$this->tablepre.'house_village_user_bind as b on a.uid=b.uid and a.company_id=b.company_id where a.company_id='.$company_id.' order by a.add_time desc LIMIT '.$p->firstRow.',' . $p->listRows;
        $record = $sqlObj->selectBySql($sql);//充值记录
        foreach ($record as $key=>&$value){
            if($value['uid']==0){//当是公司充值的时候，即uid为0时，赋公司名
                $company_name=M('company')->get_one(array('company_id'=>$value['company_id']),'company_name');
                $value['name']=$company_name['company_name'];
            }
            $count2='select b.name from '.$this->tablepre.'up as a left join '.$this->tablepre.'merchant as b on a.mid=b.mer_id where a.company_id='.$company_id;
            $result2 = $sqlObj->selectBySql($count2);
            $p2 = new Page($result2[0]["count(*)"], 10);
            $sql2='select b.name from '.$this->tablepre.'up as a left join '.$this->tablepre.'merchant as b on a.mid=b.mer_id where a.company_id='.$company_id.' order by a.add_time desc LIMIT '.$p->firstRow.',' . $p->listRows;
            $merchant = $sqlObj->selectBySql($sql2);//拿到商户名称
            $value['merchant_name']=$merchant[$key]['name'];
            $record[$key]['number'] = $key+1+10*($page-1);
        }
        unset($value);
        //$recharge_name=$_SESSION['company']['truename'];//充值人
        include $this->showTpl();
    }



    /*
     * 员工充值页面
     * 陈琦
     * 2016.11.29
     */
    public function recharge(){
        $company_id=$_GET['company_id'];
        $uid=$_GET['uid'];
        $mid=$_GET['mid'];
        $merchant=M('merchant')->get_one(array('mer_id'=>$mid),'name');//商户名称
        $merchant_name=$merchant['name'];
        if($uid){
            $user_name=M('house_village_user_bind')->get_one(array('uid'=>$uid),'name');
        }
        include $this->showTpl();
    }



    /*
     * 员工充值提交表单
     * 陈琦
     * 2016.11.29
     */
    public function submit(){
        if(IS_POST){
            $merchantOb = M('user_merchant_money');
            $money = $_POST['money'];
            if($money<0 || $money==0){
                //$this->errorTip("请输入正确金额！");
                $this->dexit(array('error'=>1,'msg'=>"请输入正确金额！"));
            }
            $uid = $_POST['uid'];
            $mid=$_POST['mid'];
            $company_id=$_POST['company_id'];
            $merchant=M('merchant')->get_one(array('mer_id'=>$mid),'name');
            $company_money=M('company_merchant_money')->get_one(array('company_id'=>$company_id,'mer_id'=>$mid),'money');//公司在当前商户的余额
            if($money>$company_money['money']){
                //$this->errorTip("余额不足！");
                $this->dexit(array('error'=>1,'msg'=>"余额不足！"));
            }
            $a=$merchantOb->get_one(array('uid'=>$uid,'mer_id'=>$mid),'money');
            if($a){//用户在当前商户充过钱
                $merchantOb->update(array('money'=>$a['money']+$money),array('uid'=>$uid,'mer_id'=>$mid));
            }else{//用户未在当前商户充过钱
                $res=array(
                    'uid'=>$uid,
                    'mer_id'=>$mid,
                    'money'=>$money,
                );
                $merchantOb->insert($res,true);
            }
            $data=array(
                'uid'=>$uid,
                'mid'=>$mid,
                'money'=>$money,
                'company_id'=>$company_id,
                'type'=>2,
                'add_time'=>time(),
                'recharge_name'=>$_SESSION['company']['truename'],//充值人
                'cz_id'=>'cz'.time().mt_rand(100, 1000),
            );
            $recharge=array(
                'uid'=>$uid,
                'type'=>1,
                'money'=>$money,
                'app_money'=>0,
                'merchant_money'=>$money,
                'time'=>$_SERVER['REQUEST_TIME'],
                'desc'=>'公司充值',
                'name'=>$merchant['name'],
                'order_id'=>'cz'.time().mt_rand(100, 1000),
                'mid'=>$mid,
                'refund'=>1,
                'now_money'=>$a['money']+$money,
            );
            M('user_money_list')->insert($recharge,true);
            $result=M('up')->insert($data,true);//充值成功后进充值记录表
            M('company_merchant_money')->update(array('money'=>($company_money['money']-$money)),array('company_id'=>$company_id,'mer_id'=>$mid));
            if($result){
                //$this->successTip('充值成功！','./merchants.php?m=User&c=company&a=user_list&company_id='.$company_id.'&mid='.$mid);
                $this->dexit(array('error'=>0,'msg'=>"充值成功！"));
            }
        }

    }



    /*
     * 分组管理
     * 陈琦
     * 2016.11.29
     */
    public function group(){
        bpBase::loadOrg('common_page');//引入分页
        $page=isset($_GET['page'])?$_GET['page']:1;
        $company_id=$_GET['company_id'];
        $mid=$_GET['mid'];
        $merchant=M('merchant')->get_one(array('mer_id'=>$mid),'name');//商户名称
        $merchant_name=$merchant['name'];
        $count='select count(*) from '.$this->tablepre.'user_group as a where a.company_id='.$company_id;
        $sqlObj = new model();
        $count_result = $sqlObj->selectBySql($count);
        $record_count=$count_result[0]["count(*)"];
        $p = new Page($record_count, 10);
        $pagebar = $p->show(2);//分组管理
        $sql='select a.* from '.$this->tablepre.'user_group as a where a.company_id='.$company_id.' order by a.group_id desc LIMIT '.$p->firstRow.',' . $p->listRows;
        $arr = $sqlObj->selectBySql($sql);//分组列表
        foreach ($arr as $key=>$value){//查询组内成员人数
            $count_sql='select count(*) from '.$this->tablepre.'house_village_user_bind as a where a.company_id='.$value['company_id'].' and a.group_id='.$value['group_id'];
            $count_arr = $sqlObj->selectBySql($count_sql);
            $count=$count_arr[0]["count(*)"];
            $arr[$key]['count']=$count;
            $arr[$key]['number'] = $key+1+10*($page-1);
        }
        include $this->showTpl();
    }



    /*
     * 分组编辑页面
     * 陈琦
     * 2016.11.29
     */
    public function group_edit(){
        $company_id=$_GET['company_id'];
        $mid=$_GET['mid'];
        $merchant=M('merchant')->get_one(array('mer_id'=>$mid),'name');//商户名称
        $merchant_name=$merchant['name'];
        $group_id=$_GET['group_id'];
        $result=M('user_group')->get_one(array('group_id'=>$group_id),'*');
        include $this->showTpl();
    }



    /*
     * 分组编辑表单提交
     * 陈琦
     * 2016.11.29
     */
    public function ge_submit(){
        $company_id=$_POST['company_id'];
        $mid=$_POST['mid'];
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
                $this->errorTip('已存在该组名！','./merchants.php?m=User&c=company&a=group&company_id='.$company_id.'&mid='.$mid);
            }
        }
        $result=M('user_group')->update(array('group_name'=>$group_name,'desc'=>$desc),array('group_id'=>$group_id));
        if($result){
            if($mid){
                $this->successTip('编辑成功！','./merchants.php?m=User&c=company&a=group&company_id='.$company_id.'&mid='.$mid);
                exit;
            }else{
                $this->successTip('编辑成功！','./merchants.php?m=User&c=company&a=left_group&company_id='.$company_id);
                exit;
            }
        }
    }



    /*
     * 删除组
     * 陈琦
     * 2016.11.29
     */
    public function group_del(){
        $group_id=$_GET['group_id'];
        $company_id=$_GET['company_id'];
        $mid=$_GET['mid'];
        $arr=M('house_village_user_bind')->get_all('uid',$this->tablepre.house_village_user_bind,array('group_id'=>$_GET['group_id']));
        if($arr){
            if($mid){
                $this->errorTip('该组尚有成员！','./merchants.php?m=User&c=company&a=group&company_id='.$company_id.'&mid='.$mid);
            }else{
                $this->errorTip('该组尚有成员！','./merchants.php?m=User&c=company&a=left_group&company_id='.$company_id);
            }
        }else{
            $del=M('user_group')->delete('group_id='.$group_id);
            if($del){
                if($mid){
                    $this->successTip('删除成功！','./merchants.php?m=User&c=company&a=group&company_id='.$company_id.'&mid='.$mid);
                    exit;
                }else{
                    $this->successTip('删除成功！','./merchants.php?m=User&c=company&a=left_group&company_id='.$company_id);
                    exit;
                }
            }
        }
    }



    /*
     * 分组充值页面
     * 陈琦
     * 2016.11.29
     */
    public function group_recharge(){
        $company_id=$_GET['company_id'];
        $mid=$_GET['mid'];
        $merchant=M('merchant')->get_one(array('mer_id'=>$mid),'name');//商户名称
        $merchant_name=$merchant['name'];
        $group_id=$_GET['group_id'];
        $result=M('user_group')->get_one(array('group_id'=>$group_id),'*');
        include $this->showTpl();
    }



    /*
     * 分组充值表单提交
     * 陈琦
     * 2016.11.29
     */
    public function gr_submit(){
        if(IS_POST){
            $money = $_POST['money'];
            if($money<0 || $money==0){
                //$this->errorTip("充值失败！");
                $this->dexit(array('error'=>1,'msg'=>'请输入正确金额！'));
            }
            $mid=$_POST['mid'];
            $village=M('merchant')->get_one(array('mer_id'=>$mid),'village_id');
            $village_id=$village['village_id'];
            $group_id = $_POST['group_id'];
            $company_id=$_POST['company_id'];
            $merchant=M('merchant')->get_one(array('mer_id'=>$mid),'name');
            $sqlObj = new model();
            $result=M('house_village_user_bind')->get_all('*',$this->tablepre.house_village_user_bind,array('group_id'=>$group_id,'village_id'=>$village_id));//当前组名的所有用户
            $re=M('user_merchant_money')->get_all('uid',$this->tablepre.user_merchant_money,array('mer_id'=>$mid));//查询当前商户下存在的所有uid
            $all_uid=array();//存所有uid的一位数组

            foreach ($re as $key=>$value){
                $all_uid[]=$value['uid'];
            }
            $count_sql='select count(*) from '.$this->tablepre.'house_village_user_bind as a where a.group_id='.$group_id.' and a.village_id='.$village_id;
            $count_arr = $sqlObj->selectBySql($count_sql);
            $count=$count_arr[0]["count(*)"];//查询组内成员人数
//            $this->dexit(array('error'=>1,'msg'=>$count));exit;
            if($result){//当前组内有成员
                $company_money=M('company_merchant_money')->get_one(array('company_id'=>$company_id,'mer_id'=>$mid),'money');//公司在当前商户余额
                $row_money=$count*$money;//改组总共充值金额
                if($row_money>$company_money['money']){
                    //$this->errorTip("余额不足！");
                    $this->dexit(array('error'=>1,'msg'=>'余额不足！'));
                }
                foreach ($result as $key=>$value){
                    $company_money=M('company_merchant_money')->get_one(array('company_id'=>$company_id,'mer_id'=>$mid),'money');//公司在当前商户余额
                    $a=M('user_merchant_money')->get_one(array('uid'=>$value['uid'],'mer_id'=>$mid),'money');//员工在当前商户余额
                    if(in_array($value['uid'],$all_uid)){
                        $succcess=M('user_merchant_money')->update(array('money'=>$a['money']+$money),array('uid'=>$value['uid'],'mer_id'=>$mid));//更新
                    }else{
                        $succcess=M('user_merchant_money')->insert(array('money'=>$money,'uid'=>$value['uid'],'mer_id'=>$mid),true);//添加
                    }
                    M('company_merchant_money')->update(array('money'=>($company_money['money']-$money)),array('company_id'=>$company_id,'mer_id'=>$mid));
                    $data=array(
                        'uid'=>$value['uid'],
                        'mid'=>$mid,
                        'money'=>$money,
                        'company_id'=>$company_id,
                        'type'=>2,
                        'add_time'=>time(),
                        'recharge_name'=>$_SESSION['company']['truename'],//充值人
                        'cz_id'=>'cz'.time().mt_rand(100, 1000),
                    );
                    M('up')->insert($data,true);//循环的时候每次时间不一样
                    $recharge=array(
                        'uid'=>$value['uid'],
                        'type'=>1,
                        'money'=>$money,
                        'app_money'=>0,
                        'merchant_money'=>$money,
                        'time'=>$_SERVER['REQUEST_TIME'],
                        'desc'=>'公司充值',
                        'name'=>$merchant['name'],
                        'order_id'=>'cz'.time().mt_rand(100, 1000),
                        'mid'=>$mid,
                        'refund'=>1,
                        'now_money'=>$a['money']+$money,
                    );
                    M('user_money_list')->insert($recharge,true);
                }
                if($succcess){
                    // $this->successTip('批量充值成功！','./merchants.php?m=User&c=company&a=group&company_id='.$company_id.'&mid='.$mid);
                    $this->dexit(array('error'=>0,'msg'=>'批量充值成功！'));
                }
            }else{
                //$this->errorTip('请先添加组员！','./merchants.php?m=User&c=company&a=group&company_id='.$company_id.'&mid='.$mid);
                $this->dexit(array('error'=>1,'msg'=>'请先添加组员！'));
            }
        }
    }



    /*
     * 添加分组/页面
     * 陈琦
     * 2016.11.29
     */
    public function add_group(){
        $company_id=$_GET['company_id'];
        $mid=$_GET['mid'];
        $merchant=M('merchant')->get_one(array('mer_id'=>$mid),'name');//商户名称
        $merchant_name=$merchant['name'];
        include $this->showTpl();
    }



    /*
     * 添加分组表单提交
     * 陈琦
     * 2016.11.29
     */
    public function ag_submit(){
        $group_name=$_POST['group_name'];
        if($group_name){
            $desc=$_POST['desc'];
            $company_id=$_POST['company_id'];
            $mid=$_POST['mid'];
            $all=M('user_group')->get_all('*',$this->tablepre.user_group,array('company_id'=>$company_id));
            foreach ($all as $key=>$value){
                if($value['group_name']==$group_name){
                    if($mid){
                        $this->errorTip('已存在该组名！','./merchants.php?m=User&c=company&a=group&company_id='.$company_id.'&mid='.$mid);
                    }else{
                        $this->errorTip('已存在该组名！','./merchants.php?m=User&c=company&a=left_group&company_id='.$company_id);
                    }
                }
            }
            $result=M('user_group')->insert(array('group_name'=>$group_name,'desc'=>$desc,'company_id'=>$company_id),true);
            if($result){
                if($mid){
                    $this->successTip('添加成功！','./merchants.php?m=User&c=company&a=group&company_id='.$company_id.'&mid='.$mid);
                    exit;
                }else{
                    $this->successTip('添加成功！','./merchants.php?m=User&c=company&a=left_group&company_id='.$company_id);
                    exit;
                }
            }
        }else{
            $this->errorTip('请填写组名！');
        }

    }



    /*
     * 添加组员
     * 陈琦
     * 2016.11.30
     */
    public function add_user(){
        bpBase::loadOrg('common_page');//引入分页
        $sqlObj = new model();
        $company_id = $_GET['company_id'];
        $mid = $_GET['mid'];
        $merchant=M('merchant')->get_one(array('mer_id'=>$mid),'name');//商户名称
        $merchant_name=$merchant['name'];
        $group_id = $_GET['group_id'];
        $count='select count(*) from ' . $this->tablepre . 'house_village_user_bind as a where a.company_id=' . $company_id . ' and a.group_id =0';
        $count_result = $sqlObj->selectBySql($count);
        $p = new Page($count_result[0]["count(*)"], 10);
        $pagebar = $p->show(2);
        $sql = 'select a.* from ' . $this->tablepre . 'house_village_user_bind as a where a.company_id=' . $company_id . ' and a.group_id =0 LIMIT '.$p->firstRow.',' . $p->listRows;
        $user = $sqlObj->selectBySql($sql);//用户名
        //dump($user);exit;
        $result=M('user_group')->get_one(array('group_id'=>$group_id),'group_name');
        $group_name=$result['group_name'];
        include $this->showTpl();
    }



    /*
     * 添加组员提交表单
     * 陈琦
     * 2016.11.30
     */
    public function au_submit(){
        $arr=$_POST['checkbox2'];
        if($arr){
            $group_id=$_POST['group_id'];
            $company_id=$_POST['company_id'];
            $mid=$_POST['mid'];
            //dump($val);
            foreach ($arr as $key=>$val){
                $update=M('house_village_user_bind')->update(array('group_id'=>$group_id),array('uid'=>$val));
            }
            if($update){
                if($mid){
                    $this->successTip('添加成功！','./merchants.php?m=User&c=company&a=user_manage&company_id='.$company_id.'&group_id='.$group_id.'&mid='.$mid);
                    exit;
                }else{
                    $this->successTip('添加成功！','./merchants.php?m=User&c=company&a=user_manage&company_id='.$company_id.'&group_id='.$group_id);
                    exit;
                }

            }
        }else{
            $this->errorTip('请选择成员！');
            exit;
        }
    }
    
    
    
    /*
     * 左侧分组管理
     * 陈琦
     * 2016.11.30
     */
    public function left_group(){
        bpBase::loadOrg('common_page');//引入分页
        $page=isset($_GET['page'])?$_GET['page']:1;
        $company_id=$_GET['company_id'];
        $count='select count(*) from '.$this->tablepre.'user_group as a where a.company_id='.$company_id;
        $sqlObj = new model();
        $count_result = $sqlObj->selectBySql($count);
        $record_count=$count_result[0]["count(*)"];
        $p = new Page($record_count, 10);
        $pagebar = $p->show(2);//分组管理
        $sql='select a.* from '.$this->tablepre.'user_group as a where a.company_id='.$company_id.' order by a.group_id desc LIMIT '.$p->firstRow.',' . $p->listRows;
        $arr = $sqlObj->selectBySql($sql);//分组列表
        foreach ($arr as $key=>$value){//查询组内成员人数
            $count_sql='select count(*) from '.$this->tablepre.'house_village_user_bind as a where a.company_id='.$value['company_id'].' and a.group_id='.$value['group_id'];
            $count_arr = $sqlObj->selectBySql($count_sql);
            $count=$count_arr[0]["count(*)"];
            $arr[$key]['count']=$count;
            $arr[$key]['number'] = $key+1+10*($page-1);
        }
        include $this->showTpl();
    }


    /*
     * 成员管理
     * 陈琦
     * 2016.11.30
     */
    public function user_manage(){
        bpBase::loadOrg('common_page');//引入分页
        $group_id=$_GET['group_id'];
        $company_id=$_GET['company_id'];
        $mid=$_GET['mid'];
        if($mid){
            $merchant=M('merchant')->get_one(array('mer_id'=>$mid),'name');//商户名称
            $merchant_name=$merchant['name'];
            $sql='select b.* from '.$this->tablepre.'user_group as b where b.company_id='.$company_id.' and b.group_id !='.$group_id;//该公司组名
            $sqlObj = new model();
            $count='select count(*) from '.$this->tablepre.'house_village_user_bind as c where c.company_id='.$company_id.' and c.group_id='.$group_id;
            $count_result = $sqlObj->selectBySql($count);
            $p = new Page($count_result[0]["count(*)"], 10);
            $pagebar = $p->show(2);
            $sql2='select DISTINCT b.uid,b.name,b.phone,b.card_type,b.usernum,b.add_time,e.money from (select a.uid uid,a.name name,a.phone phone,a.card_type card_type,a.usernum usernum,a.add_time add_time from '.$this->tablepre.'house_village_user_bind as a where a.company_id='.$company_id.' and a.group_id='.$group_id.')b left join (select c.uid uid,d.money money from '.$this->tablepre.'house_village_user_bind as c  left join '.$this->tablepre.'user_merchant_money as d on c.uid=d.uid where d.mer_id='.$mid.' and c.group_id='.$group_id.')e on b.uid=e.uid LIMIT '.$p->firstRow.',' . $p->listRows;//该组人名
            $user = $sqlObj->selectBySql($sql2);//该组人名
            //dump($user);exit;
            $group = $sqlObj->selectBySql($sql);//该公司组名
            $this_group=M('user_group')->get_one(array('group_id'=>$group_id),'group_name');//当前组名
        }else{
            $sql='select b.* from '.$this->tablepre.'user_group as b where b.company_id='.$company_id.' and b.group_id !='.$group_id;//该公司组名
            $sqlObj = new model();
            $count='select count(*) from '.$this->tablepre.'house_village_user_bind as c where c.group_id='.$group_id;
            $count_result = $sqlObj->selectBySql($count);
            $p = new Page($count_result[0]["count(*)"], 10);
            $pagebar = $p->show(2);
            $sql2='select a.* from '.$this->tablepre.'house_village_user_bind as a where a.company_id='.$company_id.' and a.group_id='.$group_id.' LIMIT '.$p->firstRow.',' . $p->listRows;//该组人名
            $user = $sqlObj->selectBySql($sql2);//该组人名
            //dump($user);exit;
            $group = $sqlObj->selectBySql($sql);//该公司组名
            $this_group=M('user_group')->get_one(array('group_id'=>$group_id),'group_name');//当前组名
        }

        include $this->showTpl();
    }



    /*
     * 移动组员至别的组
     * 陈琦
     * 11.30
     */
    public function move_user(){
        $arr=$_POST['checkbox2'];
        $group_id=$_POST['group_id'];//移动后组id
        $company_id=$_POST['company_id'];
        $mid=$_POST['mid'];
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
                if($mid){
                    $this->successTip('成功移至'.$group_name['group_name'].'!','./merchants.php?m=User&c=company&a=user_manage&company_id='.$company_id.'&group_id='.$this_group_id.'&mid='.$mid);
                    exit;
                }else{
                    $this->successTip('成功移至'.$group_name['group_name'].'!','./merchants.php?m=User&c=company&a=user_manage&company_id='.$company_id.'&group_id='.$this_group_id);
                    exit;
                }
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
        $mid=$_GET['mid'];
        $group_id=$_GET['group_id'];
        $del=M('house_village_user_bind')->update(array('group_id'=>0),array('uid'=>$uid));
        if($del){
            if($mid){
                $this->successTip('移除成功！','./merchants.php?m=User&c=company&a=user_manage&company_id='.$company_id.'&group_id='.$group_id.'&mid='.$mid);
            }else{
                $this->successTip('移除成功！','./merchants.php?m=User&c=company&a=user_manage&company_id='.$company_id.'&group_id='.$group_id);
            }
        }
    }



    /*
     * 批量剔除组员
     * 陈琦
     * 2016.11.30
     */
    public function all_del(){
        if(IS_POST){
            $arr=$_POST['uid_arr'];
            $group_id=$_POST['group_id'];
            $company_id=$_POST['company_id'];
            foreach ($arr as $key=>$value){
               $update=M('house_village_user_bind')->update(array('group_id'=>0),array('uid'=>$value));
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
                        $url='./merchants.php?m=User&c=company&a=user_del&company_id='.$company_id.'&group_id='.$group_id.'&uid='.$value['uid'];
                        $list.='<tr><td class="td_checkbox2"><input type="checkbox"  name="checkbox2[]" value="'.$value['uid'].'"/></td>';
                        $list.='<td class="td_left" width="5%">'.$value['name'].'</td>';
                        $list.='<td class="td_left" width="5%">'.$value['phone'].'</td>';
                        $list.='<td class="td_left" width="5%">'.$card_name.'</td>';
                        $list.='<td class="td_left" width="5%">'.$value['usernum'].'</td>';
                        $list.='<td class="td_left" width="5%">'.date('Y-m-d H:i:s',$value['add_time']).'</td>';

                        $list.='<td class="td_left" width="5%"><a href="'.$url.'"><div class="ff2">删除</div></a></td></td></tr>';
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




    /*
     * 左侧员工列表
     * 陈琦
     * 2016.12.1
     */
    public function left_userList(){
        bpBase::loadOrg('common_page');//引入分页
        $page=isset($_GET['page'])?$_GET['page']:1;
        $company_id=$_SESSION['company']['company_id'];//公司id
        $count='select count(*) from '.$this->tablepre.'house_village_user_bind as a left join '.$this->tablepre.'user_group as b on a.group_id=b.group_id where a.company_id='.$company_id;
        $sqlObj = new model();
        $count_result = $sqlObj->selectBySql($count);
        $record_count=$count_result[0]["count(*)"];
        $p = new Page($record_count, 10);
        $pagebar = $p->show(2);
        //$r='select c.uid,c.name,c.company_id,c.group_name from (SELECT a.uid uid,a.company_id company_id, a.name name,b.group_name group_name from '.$this->tablepre.'house_village_user_bind as a left join '.$this->tablepre.'user_group as b on a.group_id =b.group_id where a.company_id = '.$company_id.')c LEFT JOIN (SELECT a.uid id from '.$this->tablepre.'house_village_user_bind as a LEFT JOIN '. $this->tablepre.'user_merchant_money as b on a.uid = b.uid where a.company_id = '.$company_id.')d on c.uid = d.id LIMIT '.$p->firstRow.',' . $p->listRows;
        $r='select a.name,a.company_id,a.uid,b.group_name,a.phone,u.nickname,a.card_type,a.usernum,a.add_time from '.$this->tablepre.'house_village_user_bind as a left join '.$this->tablepre.'user as u on a.uid=u.uid left join '.$this->tablepre.'user_group as b on a.group_id=b.group_id where a.company_id='.$company_id .' LIMIT '.$p->firstRow.',' . $p->listRows;
        $user_list = $sqlObj->selectBySql($r);//员工列表
        foreach ($user_list as $key=>$value){
            $user_list[$key]['number'] = $key+1+10*($page-1);
        }
        //dump($user_list);exit;
        include $this->showTpl();
    }
    
    
    
    /*
     * 员工删除（将员工从公司中删除）
     * 陈琦
     * 2016.12.2
     */
    public function uid_del(){
        if(IS_POST){
            //$this->dexit(array('error'=>0,'msg'=>8));
            $uid=$_POST['uid'];
            //$company_id=$_POST['company_id'];
            echo json_encode(array('error'=>0,'msg'=>$uid));
           // M('house_village_user_bind')->update(array('company_id'=>$company_id),array('uid'=>$uid));
        }
    }



    /*
     * 员工充值细节
     * 2017.1.18
     * 陈琦
     */
    public function detail(){
        bpBase::loadOrg('common_page');//引入分页
        $page=isset($_GET['page'])?$_GET['page']:1;
        $mid=$_GET['mid'];
        $uid=$_GET['uid'];
        $merchant=M('merchant')->get_one(array('mer_id'=>$mid),'name');//商户名称
        $merchant_name=$merchant['name'];
        $user=M('house_village_user_bind')->get_one(array('uid'=>$uid),'name');
        $user_name=$user['name'];//当前员工姓名
        $t1= strtotime($_GET['startDate']);//开始时间
        $t2= strtotime($_GET['endDate']);//结束时间
        $where='uid='.$uid.' and mid='.$mid;//查询条件
        if($_GET['searchtype']=='out'){
            $type='type=2';
            $where.=' and '.$type;
        }
        if($_GET['searchtype']=='in'){
            $type='type=1';
            $where.=' and '.$type;
        }
        if($t1 && $t2){
            $date="time>='$t1'and time<='$t2'";
            $where.=' and '.$date;
        }else if($t1 && !$t2){
            $date="time>='$t1'";
            $where.=' and '.$date;
        }else if(!$t1 && $t2){
            $date="time<='$t2'";
            $where.=' and '.$date;
        }
        $sqlObj = new model();
        $count='select count(*) from '.$this->tablepre.'user_money_list where '.$where;
        $count_result=$sqlObj->selectBySql($count);
        $record_count=$count_result[0]["count(*)"];//支出记录条数
        $p = new Page($record_count, 10);
        $pagebar = $p->show(2);
        $list_sql='select * from '.$this->tablepre.'user_money_list where '.$where.' order by time desc LIMIT '.$p->firstRow.',' . $p->listRows;
        $list = $sqlObj->selectBySql($list_sql);
        include $this->showTpl();
    }
}