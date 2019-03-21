<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/6/5
 * Time: 9:52
 */
//公司充值
class CompanyAction extends BaseAction{

    /*
     * 自动提交html
     * */
    private $formTemplate = <<<'HTML'
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>支付</title>
</head>
<body>
    <div style="text-align:center">跳转中...</div>
    <form id="pay_form" name="pay_form" action="%s" method="post">
        %s
    </form>
    <script type="text/javascript">
        document.onreadystatechange = function(){
            if(document.readyState == "complete") {
                document.pay_form.submit();
            }
        };
    </script>
</body>
</html>
HTML;


    /*
   * 商户列表页面
   * 陈琦
   * 2016.11.29
   */
    public function index_news(){
        //公司id
        $company_id=$_SESSION['system']['company_id'];
        $result1=M('merchant')->where(array('is_recharge'=>1))->select();
        $result2=M('company_merchant_money')->where(array('company_id'=>$company_id))->select();
        foreach ($result2 as $key=>$value){
            $res1[$key]=$value['mer_id'];
        }
        foreach ($result1 as $key=>$value){
            $result1[$key]['company_id']=$company_id;
            if (in_array($value['mer_id'], $res1)) {
                //当前公司下指定商户下的充值信息
                $ss=M('company_merchant_money')->where(array('company_id'=>$company_id,'mer_id'=>$value['mer_id']))->find();
                //一个虚拟的R_money字段
                $result1[$key]['R_money'] = $ss['money'];
            } else {
                $result1[$key]['R_money'] = 0;
            }
        }
        $this->assign('result',$result1);
        $this->display();
    }



    /*
     * 员工列表页面(不同商户下员工当下的余额不同)
     * 陈琦
     * 2016.11.29
     */
    public function user_list(){
        $company_id=$_GET['company_id'];
        //传到前台要为充值记录作为传参传过去
        $mid=$_GET['mid'];
        //商户名称
        $merchant_name=M('merchant')->where(array('mer_id'=>$mid))->getField('name');
        $sql1=M('house_village_user_bind')->alias('a')
            ->join('left join pigcms_user u on a.uid=u.uid')
            ->join('left join pigcms_user_group b on a.group_id=b.group_id')
            ->field('a.uid,a.company_id,a.card_type,a.usernum,a.add_time,a.name,a.phone,u.nickname,b.group_name')
            ->where(array('a.company_id'=>$company_id,'a.ac_status'=>array(array('eq',2),array('eq',4),'or')))
            ->select(false);
        $sql2=M('house_village_user_bind')->alias('c')
            ->join('left join pigcms_user_merchant_money d on c.uid=d.uid')
            ->field('c.uid,d.money')
            ->where(array('c.company_id'=>$company_id,'c.ac_status'=>array(array('eq',2),array('eq',4),'or'),'d.mer_id'=>$mid))
            ->select(false);
        //员工列表
        $user_list=M()->table($sql1.' e')
            ->field('e.uid,f.money,e.name,e.company_id,e.group_name,e.phone,e.nickname,e.card_type,e.usernum,e.add_time')
            ->join("left join $sql2 f on e.uid=f.uid")
            ->order('e.add_time desc')
            ->select();
        foreach ($user_list as $key=>&$value){
            $now_money=M('user')->where(array('uid'=>$value['uid']))->getField('now_money');
            if($value['money']===NULL){
                $value['money']=floatval(0);
            }
            $value['money']=$value['money']+$now_money;
            //收入总和
            $value['in_money']=M('user_money_list')->where(array('uid'=>$value['uid'],'type'=>1))->sum('money');
            //支出总额
            $value['out_money']=M('user_money_list')->where(array('uid'=>$value['uid'],'type'=>2))->sum('money');
        }
        unset($value);
        //对应商户的余额
        $money=M('company_merchant_money')->where(array('company_id'=>$company_id,'mer_id'=>$mid))->getField('money');
        $this->assign('user_list',$user_list);
        $this->assign('merchant_name',$merchant_name);
        $this->assign('mid',$mid);
        $this->assign('company_id',$company_id);
        $this->assign('money',$money);
        //unset($_SESSION['chinaPay']);
        $data=$_SESSION['chinaPay'];
        $result=$_SESSION['VERIFY_KEY'];
        $this->assign('data',$data);
        $this->assign('result',$result);
        $this->display();
    }

    /*
     *  如果跳转，跳转后的流程
     * author 祝君伟
     * time  2017.8.1
     * */
    public function deal_chinaPay_info(){
        //接收chinapay的信息
        $select_info = session('chinaPay');
        $company_id=I('get.company_id');
        $mid=I('get.mid');
        $money=floatval($_POST['OrderAmt']/100);
        if($select_info['OrderStatus'] == '0000'){
            //公司原来的金额
            $fore_money=M('company_merchant_money')->where(array('company_id'=>$company_id,'mer_id'=>$mid))->getField('money');
            if($fore_money){//公司在当前商户充过钱
                $result=M('company_merchant_money')->where(array('company_id'=>$company_id,'mer_id'=>$mid))->save(array('money'=>($fore_money+$money)));

            }else{//公司未在当前商户充过钱
                $result=M('company_merchant_money')->data(array('company_id'=>$company_id,'money'=>$money,'mer_id'=>$mid))->add();

            }
            //制作修改数组
            $data=array(
                'pay_time'=>time(),
                'AcqSeqId'=>$select_info['AcqSeqId'],
                'is_pay'=>1
            );
            //维护本地字段
            $res = M('up')->where(array('cz_id'=>$select_info['MerOrderNo']))->data($data)->save();
            //消除支付订单信息
            unset($_SESSION['chinaPay']);
            if($res){
                $this->success('支付完成，正在跳转',U('index_news'));
            }else{
                $this->error('支付异常，请联系管理员',U('index_news'));
            }
        }else{
            //支付失败
            $this->error('支付失败',U('index_news'));
        }

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
        //商户名称
        $merchant_name=M('merchant')->where(array('mer_id'=>$mid))->getField('name');
        //所有分组
        $group = M('user_group')->where(array('company_id'=>$company_id))->select();
        //当前人信息
        $user=M('house_village_user_bind')->where(array('uid'=>$uid))->find();
        //姓名
        $user_name=M('house_village_user_bind')->where(array('uid'=>$uid))->getField('name');
        $this->assign('merchant_name',$merchant_name);
        $this->assign('mid',$mid);
        $this->assign('company_id',$company_id);
        $this->assign('uid',$uid);
        $this->assign('group',$group);
        $this->assign('user',$user);
        $this->assign('user_name',$user_name);
        $this->display();
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
            $this->error('姓名不能为空！');
        }
        if(empty($phone)){
            $this->error('联系电话不能为空！');
        }
        if(empty(preg_match("/^1[34578]{1}\d{9}$/",$_POST['phone']))){
            $this->error('联系电话格式有误！');
        }
        if($group_id){
            $result=M('house_village_user_bind')->where(array('company_id'=>$company_id,'uid'=>$uid))->save(array('group_id'=>$group_id,'name'=>$name,'phone'=>$phone));
            if($result){
                if($mid){
                    $this->success('编辑成功！',U('user_list',array('company_id'=>$company_id,'mid'=>$mid)));
                }else{
                    $this->success('编辑成功！',U('left_userList',array('company_id'=>$company_id)));
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
        $company_id=$_GET['company_id'];
        $mid=$_GET['mid'];
        $merchant_name=M('merchant')->where(array('mer_id'=>$mid))->getField('name');
        $record=M('up')->alias('a')
                       ->join('left join pigcms_house_village_user_bind as b on a.uid=b.uid and a.company_id=b.company_id')
                       ->where('a.mid='.$mid.' and a.company_id='.$company_id)
                       ->field('a.*,b.name')
                       ->distinct(true)
                       ->order('a.add_time desc')
                       ->select();
        foreach ($record as $key=>&$value){
            if($value['uid']==0){//当是公司充值的时候，即uid为0时，赋公司名
                $value['name']=M('company')->where(array('company_id'=>$value['company_id']))->getField('company_name');
            }
        }
        unset($value);
        $this->assign('merchant_name',$merchant_name);
        $this->assign('mid',$mid);
        $this->assign('record',$record);
        $this->assign('company_id',$company_id);
        $this->display();
    }



    /*
     * 所有商户下充值记录
     * 陈琦
     * 2016.11.30
     */
    public function all_record_news(){
        $company_id=$_SESSION['system']['company_id'];//公司id
        $record=M('up')->alias('a')
            ->join('left join pigcms_house_village_user_bind as b on a.uid=b.uid and a.company_id=b.company_id')
            ->join('left join pigcms_merchant as m on a.mid=m.mer_id')
            ->where('a.company_id='.$company_id)
            ->field('a.*,b.name,m.name merchant_name')
            ->distinct(true)
            ->order('a.add_time desc')
            ->select();
        foreach ($record as $key=>&$value){
            if($value['uid']==0){//当是公司充值的时候，即uid为0时，赋公司名
                $value['name']=M('company')->where(array('company_id'=>$value['company_id']))->getField('company_name');
            }
        }
        unset($value);
        //$recharge_name=$_SESSION['company']['truename'];//充值人
        $this->assign('record',$record);
        $this->display();
    }


    /*
     * 所有消费记录
     * 陈琦
     * 2017.6.7
     */
    public function all_consume_news(){
        $list=M('user_money_list')->where(array('type'=>2))->select();
        foreach ($list as &$value){
            $value['username']=M('house_village_user_bind')->where(array('uid'=>$value['uid']))->getField('name');
        }
        unset($value);
       // dump($list);exit;
        $this->assign('list',$list);
        $this->display();
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
        //商户名称
        $merchant_name=M('merchant')->where(array('mer_id'=>$mid))->getField('name');
        if($uid){
            $user_name=M('house_village_user_bind')->where(array('uid'=>$uid))->getField('name');
        }
        $this->assign('user_name',$user_name);
        $this->assign('company_id',$company_id);
        $this->assign('mid',$mid);
        $this->assign('uid',$uid);
        $this->assign('merchant_name',$merchant_name);
        $this->display();
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
                echo json_encode(array('error'=>1,'msg'=>"请输入正确金额！"));
            }
            $uid = $_POST['uid'];
            $mid=$_POST['mid'];
            $company_id=$_POST['company_id'];
            $merchant_name=M('merchant')->where(array('mer_id'=>$mid))->getField('name');
            //公司在当前商户的余额
            $company_money=M('company_merchant_money')->where(array('company_id'=>$company_id,'mer_id'=>$mid))->getField('money');
            if($money>$company_money){
                echo json_encode(array('error'=>1,'msg'=>"余额不足！"));
                exit;
            }
            $a=$merchantOb->where(array('uid'=>$uid,'mer_id'=>$mid))->getField('money');
            if($a){//用户在当前商户充过钱
                $merchantOb->where(array('uid'=>$uid,'mer_id'=>$mid))->save(array('money'=>$a+$money));
            }else{//用户未在当前商户充过钱
                $res=array(
                    'uid'=>$uid,
                    'mer_id'=>$mid,
                    'money'=>$money,
                );
                $merchantOb->add($res);
            }
            $data=array(
                'uid'=>$uid,
                'mid'=>$mid,
                'money'=>$money,
                'company_id'=>$company_id,
                'type'=>2,
                'add_time'=>time(),
                'recharge_name'=>$_SESSION['system']['realname'],
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
                'name'=>$merchant_name,
                'order_id'=>'cz'.time().mt_rand(100, 1000),
                'mid'=>$mid,
                'refund'=>1,
                'now_money'=>$a['money']+$money,
            );
            M('user_money_list')->add($recharge);
            //充值成功后进充值记录表
            $result=M('up')->add($data);
            M('company_merchant_money')->where(array('company_id'=>$company_id,'mer_id'=>$mid))->save(array('money'=>($company_money-$money)));
            if($result){
                echo json_encode(array('error'=>0,'msg'=>"充值成功！"));
            }
        }

    }



    /*
     * 分组管理
     * 陈琦
     * 2016.11.29
     */
    public function group(){
        $company_id=$_GET['company_id'];
        $mid=$_GET['mid'];
        //商户名称
        $merchant_name=M('merchant')->where(array('mer_id'=>$mid))->getField('name');
        $list=M('user_group')->where(array('company_id'=>$company_id))->order('group_id desc')->select();
        //查询组内成员人数
        foreach ($list as $key=>$value){
            $list[$key]['count']=M('house_village_user_bind')->where(array('company_id'=>$value['company_id'],'group_id'=>$value['group_id']))->count();
        }
        $this->assign('merchant_name',$merchant_name);
        $this->assign('mid',$mid);
        $this->assign('list',$list);
        $this->assign('company_id',$company_id);
        $this->display();
    }



    /*
     * 分组编辑页面
     * 陈琦
     * 2016.11.29
     */
    public function group_edit(){
        $company_id=$_GET['company_id'];
        $mid=$_GET['mid'];
        //商户名称
        $merchant_name=M('merchant')->where(array('mer_id'=>$mid))->getField('name');
        $group_id=$_GET['group_id'];
        $result=M('user_group')->where(array('group_id'=>$group_id))->find();
        $this->assign('merchant_name',$merchant_name);
        $this->assign('mid',$mid);
        $this->assign('result',$result);
        $this->assign('company_id',$company_id);
        $this->assign('group_id',$group_id);
        $this->display();
    }



    /*
     * 分组编辑表单提交
     * 陈琦
     * 2016.11.29
     */
    public function ge_submit(){
        $company_id=$_POST['company_id'];
        $mid=$_POST['mid'];
        //当前组id
        $group_id=$_POST['group_id'];
        $group_name=$_POST['group_name'];
        if(empty($group_name)){
            $this->error('组名不能为空！');
        }
        $desc=$_POST['desc'];
        $all=M('user_group')->where(array('company_id'=>$company_id,'group_id'=>array('neq',$group_id)))->select();
        foreach ($all as $key=>$value){
            if($value['group_name']==$group_name){
                $this->error('已存在该组名！',U('group',array('company_id'=>$company_id,'mid'=>$mid)));
            }
        }
        $result=M('user_group')->where(array('group_id'=>$group_id))->save(array('group_name'=>$group_name,'desc'=>$desc));
        if($result!==false){
            if($mid){
                $this->success('编辑成功！',U('group',array('company_id'=>$company_id,'mid'=>$mid)));
                exit;
            }else{
                $this->success('编辑成功！',U('left_group_news',array('company_id'=>$company_id)));
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
        $arr=M('house_village_user_bind')->where(array('group_id'=>$_GET['group_id']))->field('uid')->select();
        if($arr){
            if($mid){
                $this->error('该组尚有成员！',U('group',array('company_id'=>$company_id,'mid'=>$mid)));
            }else{
                $this->error('该组尚有成员！',U('left_group_news',array('company_id'=>$company_id)));
            }
        }else{
            $del=M('user_group')->where(array('group_id'=>$group_id))->delete();
            if($del){
                if($mid){
                    $this->success('删除成功！',U('group',array('company_id'=>$company_id,'mid'=>$mid)));
                    exit;
                }else{
                    $this->success('删除成功！',U('left_group_news',array('company_id'=>$company_id)));
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
        $merchant_name=M('merchant')->where(array('mer_id'=>$mid))->getField('name');
        $group_id=$_GET['group_id'];
        $result=M('user_group')->where(array('group_id'=>$group_id))->getField('group_name');
        $this->assign('company_id',$company_id);
        $this->assign('mid',$mid);
        $this->assign('merchant_name',$merchant_name);
        $this->assign('group_id',$group_id);
        $this->assign('result',$result);
        $this->display();
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
                //echo json_encode("充值失败！");
                echo json_encode(array('error'=>1,'msg'=>'请输入正确金额！'));
            }
            $group_id = $_POST['group_id'];
            $mid=$_POST['mid'];
            $company_id=$_POST['company_id'];
            $merchant_name=M('merchant')->where(array('mer_id'=>$mid))->getField('name');
            $village_id=M('merchant')->where(array('mer_id'=>$mid))->getField('village_id');
            //当前组名的所有用户
            $result=M('house_village_user_bind')->where(array('group_id'=>$group_id,'village_id'=>$village_id))->select();
            //查询当前商户下存在的所有uid
            $re=M('user_merchant_money')->where(array('mer_id'=>$mid))->field('uid')->select();
            //存所有uid的一位数组
            $all_uid=array();
            foreach ($re as $key=>$value){
                $all_uid[]=$value['uid'];
            }
            //查询组内成员人数
            $count=M('house_village_user_bind')->where(array('group_id'=>$group_id,'village_id'=>$village_id))->count();
            if($result){//当前组内有成员
                $company_money=M('company_merchant_money')->where(array('company_id'=>$company_id,'mer_id'=>$mid))->getField('money');//公司在当前商户余额
                //该组总共充值金额
                $row_money=$count*$money;
                if($row_money>$company_money){
                    echo json_encode(array('error'=>1,'msg'=>'余额不足！'));exit;
                }
                foreach ($result as $key=>$value){
                    //公司在当前商户余额
                    $company_money=M('company_merchant_money')->where(array('company_id'=>$company_id,'mer_id'=>$mid))->getField('money');
                    //员工在当前商户余额
                    $a=M('user_merchant_money')->where(array('uid'=>$value['uid'],'mer_id'=>$mid))->getField('money');
                    if(in_array($value['uid'],$all_uid)){
                        //更新
                        $succcess=M('user_merchant_money')->where(array('uid'=>$value['uid'],'mer_id'=>$mid))->save(array('money'=>$a+$money));
                    }else{
                        //添加
                        $succcess=M('user_merchant_money')->data(array('money'=>$money,'uid'=>$value['uid'],'mer_id'=>$mid))->add();
                    }
                    M('company_merchant_money')->where(array('company_id'=>$company_id,'mer_id'=>$mid))->save(array('money'=>($company_money-$money)));
                    $data=array(
                        'uid'=>$value['uid'],
                        'mid'=>$mid,
                        'money'=>$money,
                        'company_id'=>$company_id,
                        'type'=>2,
                        'add_time'=>time(),
                        'recharge_name'=>$_SESSION['system']['realname'],
                        'cz_id'=>'cz'.time().mt_rand(100, 1000),
                    );
                    //循环的时候每次时间不一样
                    M('up')->data($data)->add();
                    $recharge=array(
                        'uid'=>$value['uid'],
                        'type'=>1,
                        'money'=>$money,
                        'app_money'=>0,
                        'merchant_money'=>$money,
                        'time'=>$_SERVER['REQUEST_TIME'],
                        'desc'=>'公司充值',
                        'name'=>$merchant_name,
                        'order_id'=>'cz'.time().mt_rand(100, 1000),
                        'mid'=>$mid,
                        'refund'=>1,
                        'now_money'=>$a+$money,
                    );
                    M('user_money_list')->data($recharge)->add();
                }
                if($succcess){
                    echo json_encode(array('error'=>0,'msg'=>'批量充值成功！'));
                }
            }else{
                echo json_encode(array('error'=>1,'msg'=>'请先添加组员！'));
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
        $merchant_name=M('merchant')->where(array('mer_id'=>$mid))->getField('name');
        $this->assign('company_id',$company_id);
        $this->assign('mid',$mid);
        $this->assign('merchant_name',$merchant_name);
        $this->display();
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
            $all=M('user_group')->where(array('company_id'=>$company_id))->select();
            foreach ($all as $key=>$value){
                if($value['group_name']==$group_name){
                    if($mid){
                        $this->error('已存在该组名！',U('group',array('company_id'=>$company_id,'mid'=>$mid)));
                    }else{
                        $this->error('已存在该组名！',U('left_group_news',array('company_id'=>$company_id)));
                    }
                }
            }
            $result=M('user_group')->data(array('group_name'=>$group_name,'desc'=>$desc,'company_id'=>$company_id))->add();
            if($result){
                if($mid){
                    $this->success('添加成功！',U('group',array('company_id'=>$company_id,'mid'=>$mid)));
                    exit;
                }else{
                    $this->success('添加成功！',U('left_group_news',array('company_id'=>$company_id)));
                    exit;
                }
            }
        }else{
            $this->error('请填写组名！');
        }

    }



    /*
     * 添加组员
     * 陈琦
     * 2016.11.30
     */
    public function add_user(){
        $company_id = $_GET['company_id'];
        $mid = $_GET['mid'];
        $merchant_name=M('merchant')->where(array('mer_id'=>$mid))->getField('name');
        $group_id = $_GET['group_id'];
        $user = M('house_village_user_bind')->where(array('company_id'=>$company_id,'group_id'=>0))->select();
        $group_name=M('user_group')->where(array('group_id'=>$group_id))->getField('group_name');
        $this->assign('company_id',$company_id);
        $this->assign('mid',$mid);
        $this->assign('group_id',$group_id);
        $this->assign('user',$user);
        $this->assign('group_name',$group_name);
        $this->assign('merchant_name',$merchant_name);
        $this->display();
    }



    /*
     * 添加组员提交表单
     * 陈琦
     * 2016.11.30
     */
    public function au_submit(){
        $arr=$_POST['checkbox'];
        if($arr){
            $group_id=$_POST['group_id'];
            $company_id=$_POST['company_id'];
            $mid=$_POST['mid'];
            //dump($val);
            foreach ($arr as $key=>$val){
                $update=M('house_village_user_bind')->where(array('uid'=>$val))->save(array('group_id'=>$group_id));
            }
            if($update){
                if($mid){
                    $this->success('添加成功！',U('user_manage',array('company_id'=>$company_id,'group_id'=>$group_id,'mid'=>$mid)));
                    exit;
                }else{
                    $this->success('添加成功！',U('user_manage',array('company_id'=>$company_id,'group_id'=>$group_id)));
                    exit;
                }

            }
        }else{
            $this->error('请选择成员！');
            exit;
        }
    }



    /*
     * 左侧分组管理
     * 陈琦
     * 2016.11.30
     */
    public function left_group_news(){
        //公司id
        $company_id=$_SESSION['system']['company_id'];
        $list=M('user_group')->where(array('company_id'=>$company_id))->order('group_id desc')->select();
        //查询组内成员人数
        foreach ($list as $key=>$value){
            $list[$key]['count']=M('house_village_user_bind')->where(array('company_id'=>$value['company_id'],'group_id'=>$value['group_id']))->count();
        }
        $this->assign('list',$list);
        $this->assign('company_id',$company_id);
        $this->display();
    }


    /*
     * 成员管理
     * 陈琦
     * 2016.11.30
     */
    public function user_manage(){
        $group_id=$_GET['group_id'];
        $company_id=$_GET['company_id'];
        $mid=$_GET['mid'];
        $group=M('user_group')->where(array('company_id'=>$company_id,'group_id'=>array('neq',$group_id)))->select();
        //当前组名
        $this_group=M('user_group')->where(array('group_id'=>$group_id))->getField('group_name');
        if($mid){
            //商户名称
            $merchant_name=M('merchant')->where(array('mer_id'=>$mid))->getField('name');
            $sql1=M('house_village_user_bind')->where(array('company_id'=>$company_id,'group_id'=>$group_id))->field('uid,name,phone,card_type,usernum,add_time')->select(false);
            $sql2=M('house_village_user_bind')->alias('a')
                ->join('left join pigcms_user_merchant_money b on a.uid=b.uid')
                ->field('a.uid,b.money')
                ->where(array('a.group_id'=>$group_id,'b.mer_id'=>$mid))
                ->select(false);
            //组员信息
            $user=M('')->table($sql1.' c')
                ->distinct(true)
                ->join("left join $sql2 d on c.uid=d.uid")
                ->field('c.uid,c.name,c.phone,c.card_type,c.usernum,c.add_time,d.money')
                ->where('c.uid=d.uid')
                ->select();
        }else{
            $user=M('house_village_user_bind')->where(array('company_id'=>$company_id,'group_id'=>$group_id))->select();
        }
        //dump($user);exit;
        $this->assign('group_id',$group_id);
        $this->assign('company_id',$company_id);
        $this->assign('mid',$mid);
        $this->assign('group',$group);
        $this->assign('this_group',$this_group);
        $this->assign('merchant_name',$merchant_name);
        $this->assign('user',$user);
        $this->display();
    }



    /*
     * 移动组员至别的组
     * 陈琦
     * 11.30
     */
    public function move_user(){
        $arr=$_POST['checkbox'];
        //移动后组id
        $group_id=$_POST['group_id'];
        $company_id=$_POST['company_id'];
        $mid=$_POST['mid'];
        //当前组id
        $this_group_id=$_POST['this_group_id'];
        if(!empty($arr) && empty($group_id)){
            $this->error('请选择操作！');
        }
        if(empty($arr) && !empty($group_id)){
            $this->error('请选择人员！');
        }
        if(empty($arr) && empty($group_id)){
            $this->error('请选择操作！');
        }
        if(!empty($arr) && !empty($group_id)){
            $group_name=M('user_group')->where(array('group_id'=>$group_id))->getField('group_name');
            foreach($arr as $key=>$value){
                $update=M('house_village_user_bind')->where(array('uid'=>$value))->save(array('group_id'=>$group_id));
            }
            if($update){
                if($mid){
                    $this->success('成功移至'.$group_name.'!',U('user_manage',array('company_id'=>$company_id,'group_id'=>$this_group_id,'mid'=>$mid)));
                    exit;
                }else{
                    $this->success('成功移至'.$group_name.'!',U('user_manage',array('company_id'=>$company_id,'group_id'=>$this_group_id)));
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
        $del=M('house_village_user_bind')->where(array('uid'=>$uid))->save(array('group_id'=>0));
        if($del){
            if($mid){
                $this->success('移除成功！',U('user_manage',array('company_id'=>$company_id,'group_id'=>$group_id,'mid'=>$mid)));
            }else{
                $this->success('移除成功！',U('user_manage',array('company_id'=>$company_id,'group_id'=>$group_id)));
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
            $mid=$_POST['mid'];
            foreach ($arr as $key=>$value){
                $update=M('house_village_user_bind')->where(array('uid'=>$value))->save(array('group_id'=>0));
            }
            $village=M('merchant')->where(array('mer_id'=>$mid))->getField('village_id');
            if($update){
                $user = M('house_village_user_bind')->where(array('group_id'=>$group_id,'village_id'=>$village))->select();
                if($mid){
                    $left='<th>账户余额</th>';
                }
                $list=' <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">';
                $list.='<thead><tr><th><label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /><span></span></label></th>';
                $list.='<th>用户名</th>';
                $list.=$left;
                $list.='<th>联系电话</th>';
                $list.='<th>证件类型</th>';
                $list.='<th>证件号</th>';
                $list.='<th>注册时间</th>';
                $list.='<th>操作</th></tr></thead>';
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
                        if($value['money']){
                            $money=$value['money'];
                        }else{
                            $money='0.00';
                        }
                        $url='./admin.php?m=System&c=Company&a=user_del&company_id='.$company_id.'&group_id='.$group_id.'&uid='.$value['uid'];
                        $list.='<tbody><tr class="odd gradeX"><td><label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input type="checkbox" class="checkboxes" value="'.$value['uid'].'" name="checkbox[]" /><span></span></label></td>';
                        $list.='<td class="center">'.$value['name'].'</td>';
                        $list.='<td class="center">'.$money.'</td>';
                        $list.='<td class="center">'.$value['phone'].'</td>';
                        $list.='<td class="center">'.$card_name.'</td>';
                        $list.='<td class="center">'.$value['usernum'].'</td>';
                        $list.='<td class="center">'.date('Y-m-d H:i:s',$value['add_time']).'</td>';
                        $list.='<td><div class="btn-group"><button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作<i class="fa fa-angle-down"></i></button><ul class="dropdown-menu pull-left" role="menu" style="position:relative;"><li><a href="'.$url.'"><i class="icon-docs"></i>删除</a></li></ul></div></td></tr>';
                    }
                }
                $list.='</tbody></table>';
                echo json_encode(array('msg_code'=>0,'msg_data'=>$list));
            }else{
                echo json_encode(array('msg_code'=>1,'msg_data'=>'改变失败！'));
            }
        }
    }




    /*
     * 左侧员工列表
     * 陈琦
     * 2016.12.1
     */
    public function left_userList_news(){
        //公司id
        $company_id=$_SESSION['system']['company_id'];
        //所有人员
        $user_list=M('house_village_user_bind')->alias('a')
            ->join('left join pigcms_user b on a.uid=b.uid')
            ->join('left join pigcms_user_group c on a.group_id=c.group_id')
            ->field('a.name,a.company_id,a.uid,c.group_name,a.phone,b.nickname,a.card_type,a.usernum,a.add_time')
            ->where('a.company_id='.$company_id)
            ->select();
        $this->assign('user_list',$user_list);
        $this->assign('company_id',$company_id);
        $this->display();
    }



    /*
     * 员工删除（将员工从公司中删除）
     * 陈琦
     * 2016.12.2
     */
    public function uid_del(){
        if(IS_POST){
            $uid=$_POST['uid'];
            $update=M('house_village_user_bind')->where(array('uid'=>$uid))->save(array('company_id'=>0));
            if($update){
                echo json_encode(array('error'=>0,'msg'=>'剔除成功！'));
            }else{
                echo json_encode(array('error'=>1,'msg'=>'剔除失败！'));
            }
        }
    }



    /*
     * 员工充值细节.
     * 2017.1.18
     * 陈琦
     */
    public function detail(){
        $mid=$_GET['mid'];
        $uid=$_GET['uid'];
        $company_id=$_GET['company_id'];
        //商户名称
        $merchant_name=M('merchant')->where(array('mer_id'=>$mid))->getField('name');
        //当前员工姓名
        $user_name=M('house_village_user_bind')->where(array('uid'=>$uid))->getField('name');
        //开始时间
        $t1= strtotime($_GET['startDate']);
        //结束时间
        $t2= strtotime($_GET['endDate']);
        //查询条件
        $where='uid='.$uid.' and mid='.$mid;
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
        $list=M('user_money_list')->where($where)->order('time desc')->select();
        $this->assign('list',$list);
        $this->assign('merchant_name',$merchant_name);
        $this->assign('user_name',$user_name);
        $this->assign('mid',$mid);
        $this->assign('uid',$uid);
        $this->assign('company_id',$company_id);
        $this->display();
    }


    /*
     * 银联充值页面
     */
    public function chinaPay(){
        //当前公司id
        $company_id=$_GET['company_id'];
        //充值商户id
        $mid=$_GET['mid'];
        //银联接口地址
        $pay_url="https://payment.chinapay.com/CTITS/service/rest/page/nref/000000000017/0/0/0/0/0";
        $tmp=M('cashier_merchants')->where(array('thirduserid'=>$mid))->getField('mid');
        //该商户所有支付配置参数
        $payConfig = M('cashier_payconfig')->where(array('mid' => $tmp))->find();
        if ($payConfig) {
            if ($payConfig['configData']) {
                $payConfig['configData'] = unserialize(htmlspecialchars_decode($payConfig['configData']));
            }else {
                $payConfig2['configData'] = array();
            }
        }
        //vd($payConfig);exit;
        //读取银联的配置
        $info=M('config')->where(array('name'=>'pay_allinpay_merchantid'))->find();
        //主商户编号
        $MerId=$info['value'];//主商户编号
        //银联下的分账商户编号
        $sub_mid=$payConfig['configData']['chinaPay']['MerId'];
        $MerOrderNo=time().mt_rand(111111, 999999);//订单编号
        $TranDate=date('Ymd');//交易日期
        $TranTime=date('His');//交易时间
        $this->assign('pay_url',$pay_url);
        $this->assign('MerId',$MerId);
        $this->assign('sub_mid',$sub_mid);
        $this->assign('MerOrderNo',$MerOrderNo);
        $this->assign('TranDate',$TranDate);
        $this->assign('TranTime',$TranTime);
        $this->assign('company_id',$company_id);
        $this->assign('mid',$mid);
        //dump(getcwd());exit;
        $this->display();
    }



    /*
   * 银联转账提交表单
   * 陈琦
   * 2017.2.21
   */
    public function chinaPay_submit(){
        $paramArray = array(
            'MerId'=>$_POST['MerId'],//商户编号
            'MerOrderNo'=>$_POST['MerOrderNo'],//订单编号
            'OrderAmt'=>$_POST['OrderAmt']*100,//订单金额
            'TranDate'=>$_POST['TranDate'],//交易日期
            'TranTime'=>$_POST['TranTime'],//交易时间
            'TranType'=>'0002',//交易类型
            'BusiType'=>'0001',//业务类型
            'Version'=>'20140728',//版本号
            'MerBgUrl'=>'http://www.hdhsmart.com/admin.php?g=System&c=Company&a=bgReturn',//后台
            'MerPageUrl'=>'http://www.hdhsmart.com/admin.php?g=System&c=Company&a=pgReturn&company_id='.$_POST['company_id'].'&mid='.$_POST['mid'],//前台
            'SplitType'=>'0001',//分账类型
            'SplitMethod'=>'0',//分账方式'0'按金额分账，'1'按比例
            'MerSplitMsg'=>$_POST['MerSplitMsg']//分账信息
        );
        //银联接口类
        import('@.ORG.SecssUtil');
        $secssUtil = new SecssUtil();
        //用于提供商户签名、验签、加密、解密、文件验签等方法调用
        $securityPropFile = getcwd().'/cms/Lib/Action/System/class/security.properties';//写到类的路径下面
        //初始化配置文件
        $secssUtil->init($securityPropFile);
        //签名
        $secssUtil->sign($paramArray);
        //获取签名
        $Signature=$secssUtil->getSign();
        if ("00" !== $secssUtil->getErrCode()) {
            echo json_encode(array('error'=>1,'msg'=>"签名过程发生错误，错误信息为-->" . $secssUtil->getErrMsg()));
        }else{
            //发起支付才生成订单
            $data=array(
                'uid'=>0,//代表商户充值
                'mid'=>I('post.mid'),
                'money'=>floatval($_POST['OrderAmt']),
                'company_id'=>I('post.company_id'),
                'type'=>1,//商户充值
                'add_time'=>time(),
                'recharge_name'=>$_SESSION['system']['realname'],//充值人
                'cz_id'=>$_POST['MerOrderNo'],//编号
                'is_pay'=>0,
            );
            M('up')->data($data)->add();
            echo json_encode(array('error'=>0,'msg'=>$Signature));
        }
    }


    /*
     * 银联后台接收
     */
    public function bgReturn(){
        //接受银联回传值并转换成数组
        parse_str(file_get_contents('php://input'), $data);
        import('@.ORG.SecssUtil');
        //include "./cms/Lib/ORG/chinaPay/common.php";
        $secssUtil = new SecssUtil();
        //指定签名验签证书文件存放路径
        $securityPropFile = getcwd().'/cms/Lib/Action/System/class/security.properties';
        $secssUtil->init($securityPropFile);
        $text = array();
        foreach($data as $key=>$value){
            $text[$key] = urldecode($value);
        }
        $secssUtil->verify($text);
    }


    /*
     * 银联前台接收回传数据
     */
    public function pgReturn_bck(){
        //接受银联回传值并转换成数组
        parse_str(file_get_contents('php://input'), $data);
        $dispatchUrl='http://www.hdhsmart.com/admin.php?g=System&c=Company&a=user_list&company_id='.$_GET['company_id'].'&mid='.$_GET['mid'];
        import('@.ORG.SecssUtil');
        include "./cms/Lib/ORG/chinaPay/common.php";
        $secssUtil = new SecssUtil();
        //指定签名验签证书文件存放路径
        $securityPropFile = getcwd().'/cms/Lib/Action/System/class/security.properties';
        //初始化
        $secssUtil->init($securityPropFile);
        //验签
        if ($secssUtil->verify($_POST)) {
            $_SESSION["VERIFY_KEY"] = "success";
        } else {
            $_SESSION["VERIFY_KEY"] = "fail";
        }
        //存入session
        foreach ($data as $k=>$v){
            $newdata[$k]=$v;
            $newdata['mid']=$_GET['mid'];
        }
        $_SESSION['chinaPay']=$newdata;
        header("Location:" . $dispatchUrl);
    }

    /*
     * 银联前台接收回传数据
     */
    public function pgReturn(){
        //接受银联回传值并转换成数组
        parse_str(file_get_contents('php://input'), $data);
        $dispatchUrl='http://www.hdhsmart.com/admin.php?g=System&c=Company&a=deal_chinaPay_info&company_id='.$_GET['company_id'].'&mid='.$_GET['mid'];
        import('@.ORG.SecssUtil');
        //include "./cms/Lib/ORG/chinaPay/common.php";
        $secssUtil = new SecssUtil();
        //指定签名验签证书文件存放路径
        $securityPropFile = getcwd().'/cms/Lib/Action/System/class/security.properties';
        //初始化
        $secssUtil->init($securityPropFile);
        //验签
        if ($secssUtil->verify($_POST)) {
            $_SESSION["VERIFY_KEY"] = "success";
        } else {
            $_SESSION["VERIFY_KEY"] = "fail";
        }
        //存入session
        foreach ($data as $k=>$v){
            $newdata[$k]=$v;
            $newdata['mid']=$_GET['mid'];
        }
        $_SESSION['chinaPay']=$newdata;
        header("Location:" . $dispatchUrl);
    }




    /*
    *弹出提示后将session清掉
    *陈琦
    *2017.2.25
    */
    public function chinaPay_after(){
        //充值状态
        $status=$_POST['OrderStatus'];
        //‘分’为单位
        $money=$_POST['OrderAmt']/100;
        $company_id=$_POST['company_id'];
        $mid=$_POST['mid'];
        if($status=='0000'){//充值成功
            //公司原来的金额
            $fore_money=M('company_merchant_money')->where(array('company_id'=>$company_id,'mer_id'=>$mid))->getField('money');
            if($fore_money){//公司在当前商户充过钱
                $result=M('company_merchant_money')->where(array('company_id'=>$company_id,'mer_id'=>$mid))->save(array('money'=>($fore_money+$money)));
                $after_money=$fore_money+$money;
            }else{//公司未在当前商户充过钱
                $result=M('company_merchant_money')->data(array('company_id'=>$company_id,'money'=>$money,'mer_id'=>$mid))->add();
                $after_money=$money;
            }
            $data=array(
                'uid'=>0,//代表商户充值
                'mid'=>$mid,
                'money'=>$money,
                'company_id'=>$company_id,
                'type'=>1,//商户充值
                'add_time'=>time(),
                'recharge_name'=>$_SESSION['company']['truename'],//充值人
                'cz_id'=>'cz'.time().mt_rand(100, 1000),//编号
            );
            if($result){
                M('up')->data($data)->add();
            }
            echo json_encode($after_money);
        }
        unset($_SESSION['chinaPay']);
    }

    /*
     * 用户完成交易以后调用银联查询接口查询支付结果
     * 2017.7.26
     * */
    public function china_pay_select(){
        $paramArray = array(
            'MerId'=>$_POST['MerId'],//商户编号
            'MerOrderNo'=>$_POST['MerOrderNo'],//订单编号
            'TranDate'=>$_POST['TranDate'],//交易日期
            'TranTime'=>$_POST['TranTime'],//交易时间
            'TranType'=>'0502',//交易类型
            'BusiType'=>'0001',//业务类型
            'Version'=>'20140728',//版本号
        );
        //银联接口类
        import('@.ORG.SecssUtil');
        $secssUtil = new SecssUtil();
        //用于提供商户签名、验签、加密、解密、文件验签等方法调用
        $securityPropFile = getcwd().'/cms/Lib/Action/System/class/security.properties';//写到类的路径下面
        //初始化配置文件
        $secssUtil->init($securityPropFile);
        //签名
        $secssUtil->sign($paramArray);
        //获取签名
        $Signature=$secssUtil->getSign();
        $request_array = array(
            'MerId'=>$_POST['MerId'],//商户编号
            'MerOrderNo'=>$_POST['MerOrderNo'],//订单编号
            'TranDate'=>$_POST['TranDate'],//交易日期
            'TranTime'=>$_POST['TranTime'],//交易时间
            'TranType'=>'0502',//交易类型
            'BusiType'=>'0001',//业务类型
            'Version'=>'20140728',//版本号
            'Signature'=>$Signature
        );
        //加载Snoopy，高级表单提交方法
        import('@.ORG.Snoopy');
        $snoopy = new Snoopy();
        $action = "https://payment.chinapay.com/CTITS/service/rest/forward/syn/000000000060/0/0/0/0/0";//表单提交地址
        $snoopy->submit($action,$request_array);//$formvars为提交的数组
        $result_str = $snoopy->results; //获取表单提交后的 返回的结果
        $result_array = explode("&",$result_str);
        $select_info =array();
        foreach ($result_array as $key=>$value){
            $msg_arr = explode("=",$value);
            $select_info[$msg_arr[0]]=$msg_arr[1];
        }
        if($select_info['respCode'] == '0000'){
            //根据银联文档提示：表示同步应答码，只有"0000才为处理成功，其他均为处理失败
            if($select_info['OrderStatus'] == '0000'){
                //支付完全成功
                $company_id=I('post.company_id');
                $mid=I('post.mid');
                $money=floatval($_POST['OrderAmt']/100);
                if($select_info['OrderStatus'] == '0000') {
                    //公司原来的金额
                    $fore_money = M('company_merchant_money')->where(array('company_id' => $company_id, 'mer_id' => $mid))->getField('money');
                    if ($fore_money) {//公司在当前商户充过钱
                        $result = M('company_merchant_money')->where(array('company_id' => $company_id, 'mer_id' => $mid))->data(array('money' => ($fore_money + $money)))->save();

                    } else {//公司未在当前商户充过钱
                        $result = M('company_merchant_money')->data(array('company_id' => $company_id, 'money' => $money, 'mer_id' => $mid))->add();

                    }
                    //制作修改数组
                    $data = array(
                        'pay_time' => time(),
                        'AcqSeqId' => $select_info['AcqSeqId'],
                        'is_pay' => 1
                    );
                    //维护本地字段
                    $res = M('up')->where(array('cz_id' => $select_info['MerOrderNo']))->data($data)->save();
                    if($res){
                        //维护字段成功，完全成功
                        echo 1;
                    }else{
                        //维护字段失败，不完全成功
                        echo 2;
                    }
                }
            }else{
                dump($select_info);
            }
        }else{
            //查询失败
            dump($select_info);
        }

    }



    /*
     * 不跳转，主动查询订单结果
     *  author 祝君伟
     * time 2017.8.1
     * */

    public function check_this_order(){
        //根据后台传过来的id。匹配数据
        $id = I('post.id');
        $order_info = M('up')->find($id);
        //根据信息，查询该商户的配置
        //充值商户id
        $mid=$order_info['mid'];
        //银联接口地址
        $tmp=M('cashier_merchants')->where(array('thirduserid'=>$mid))->getField('mid');
        //该商户所有支付配置参数
        $payConfig = M('cashier_payconfig')->where(array('mid' => $tmp))->find();
        if ($payConfig) {
            if ($payConfig['configData']) {
                $payConfig['configData'] = unserialize(htmlspecialchars_decode($payConfig['configData']));
            }else {
                $payConfig2['configData'] = array();
            }
        }
        //读取银联的配置
        $MerId=M('config')->where(array('name'=>'pay_allinpay_merchantid'))->getField('value');
        $paramArray = array(
            'MerId'=>$MerId,//商户编号
            'MerOrderNo'=>$order_info['cz_id'],//订单编号
            'TranDate'=>date('Ymd',$order_info['add_time']),//交易日期
            'TranTime'=>date('His',$order_info['add_time']),//交易时间
            'TranType'=>'0502',//交易类型
            'BusiType'=>'0001',//业务类型
            'Version'=>'20140728',//版本号
        );
        //银联接口类
        import('@.ORG.SecssUtil');
        $secssUtil = new SecssUtil();
        //用于提供商户签名、验签、加密、解密、文件验签等方法调用
        $securityPropFile = getcwd().'/cms/Lib/Action/System/class/security.properties';//写到类的路径下面
        //初始化配置文件
        $secssUtil->init($securityPropFile);
        //签名
        $secssUtil->sign($paramArray);
        //获取签名
        $Signature=$secssUtil->getSign();
        $request_array = array(
            'MerId'=>$MerId,//商户编号
            'MerOrderNo'=>$order_info['cz_id'],//订单编号
            'TranDate'=>date('Ymd',$order_info['add_time']),//交易日期
            'TranTime'=>date('His',$order_info['add_time']),//交易时间
            'TranType'=>'0502',//交易类型
            'BusiType'=>'0001',//业务类型
            'Version'=>'20140728',//版本号
            'Signature'=>$Signature
        );
        //加载Snoopy，高级表单提交方法
        import('@.ORG.Snoopy');
        $snoopy = new Snoopy();
        $action = "https://payment.chinapay.com/CTITS/service/rest/forward/syn/000000000060/0/0/0/0/0";//表单提交地址
        $snoopy->submit($action,$request_array);//$formvars为提交的数组
        $result_str = $snoopy->results; //获取表单提交后的 返回的结果
        $result_array = explode("&",$result_str);
        $select_info =array();
        foreach ($result_array as $key=>$value){
            $msg_arr = explode("=",$value);
            $select_info[$msg_arr[0]]=$msg_arr[1];
        }
        if($select_info['respCode'] == '0000'){
            //根据银联文档提示：表示同步应答码，只有"0000才为处理成功，其他均为处理失败
            if($select_info['OrderStatus'] == '0000'){
                //支付完全成功
                $company_id=I('post.company_id');
                $mid=I('post.mid');
                $money=floatval($_POST['OrderAmt']/100);
                //公司原来的金额
                $fore_money = M('company_merchant_money')->where(array('company_id' => $company_id, 'mer_id' => $mid))->getField('money');
                if ($fore_money) {//公司在当前商户充过钱
                    $result = M('company_merchant_money')->where(array('company_id' => $company_id, 'mer_id' => $mid))->save(array('money' => ($fore_money + $money)));

                } else {//公司未在当前商户充过钱
                    $result = M('company_merchant_money')->data(array('company_id' => $company_id, 'money' => $money, 'mer_id' => $mid))->add();

                }
                //制作修改数组
                $data = array(
                    'pay_time' => time(),
                    'AcqSeqId' => $select_info['AcqSeqId'],
                    'is_pay' => 1
                );
                //维护本地字段
                $res = M('up')->where(array('cz_id' => $select_info['MerOrderNo']))->data($data)->save();
                if($res){
                    //维护字段成功，完全成功
                    echo 1;
                }else{
                    //维护字段失败，不完全成功
                    echo 2;
                }

            }else{
                //支付失败
                echo 3;
            }
        }else{
            //查询失败
            echo 4;
        }
    }

    /**
     * 构建自动提交HTML表单
     * @return string
     */
    public function createPostForm($request_array)
    {
        $input = '';
        foreach($request_array as $key => $item) {
            $input .= "\t\t<input type=\"hidden\" name=\"{$key}\" value=\"{$item}\">\n";
        }
        return sprintf($this->formTemplate, 'https://payment.chinapay.com/CTITS/service/rest/forward/syn/000000000060/0/0/0/0/0', $input);
    }

    /*工具类https_request
    * http 请求返回res的函数
    *2016.11.17
    */
    protected function https_request($url, $data = null,$noprocess=false) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; WOW64; rv:39.0) Gecko/20100101 Firefox/39.0");
        $header = array("Accept-Charset: utf-8");
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        //curl_setopt($curl, CURLOPT_SSLVERSION, 3);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header); /* * *$header 必须是一个数组** */
        curl_setopt($curl, CURLOPT_HEADER, FALSE);
        curl_setopt($curl, CURLINFO_HEADER_OUT, true);
        if (!empty($data)) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        if($noprocess) return $output;
        $errorno = curl_errno($curl);
        if ($errorno) {
            return array('curl' => false, 'errorno' => $errorno);
        } else {
            $res = json_decode($output, 1);
            if ($res['errcode']) {
                return array('errcode' => $res['errcode'], 'errmsg' => $res['errmsg']);
            } else {
                return $res;
            }
        }
        curl_close($curl);
    }


}
