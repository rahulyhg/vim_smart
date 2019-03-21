<?php
/**
 * Created by PhpStorm.
 * User: 陈琦
 * Date: 2017/6/15
 * Time: 10:25
 */
class CashierAction extends BaseAction{
    public $mer_id;
    protected $img_dir;
    protected $config;
    public function __construct(){
        parent::__construct();
        $this->mer_id=$_SESSION['system']['mer_id'];
        //图片路径
        $this->img_dir ="upload/meal/";
        $this->config = D('Config')->get_config();
    }


    /*
     * 扫码收款
     */
    public function get_money_news(){
        //O2O后台账号
        $ad=$_SESSION['system'];
        //O2O账号若存在mid对应的收银商户id
        $ad_mid=M('cashier_merchants')->where(array('thirduserid'=>$ad['mer_id']))->getField('mid');
        if($ad_mid){
            $_SESSION['merchant']['mid']=$ad_mid;
            $this->assign('url',C('WEB_DOMAIN').'/Cashier/merchants.php?m=User&c=cashier&a=money');
        }

        $this->assign('mer_id',$ad['mer_id']);
        $this->assign('empty','您不是商户，无法查看收银详情');
        $this->display();
    }



    public function store_news(){
        $condition_merchant_store['have_meal'] = '1';
        $condition_merchant_store['status'] = '1';
        $db_arr = array(C('DB_PREFIX').'area'=>'a',C('DB_PREFIX').'merchant_store'=>'s');
        if($this->mer_id){
            $where="`s`.`mer_id`='$this->mer_id' AND `s`.`status`='1' AND `s`.`have_meal`='1' AND `s`.`area_id`=`a`.`area_id`";
        }else{
            $where="`s`.`status`='1' AND `s`.`have_meal`='1' AND `s`.`area_id`=`a`.`area_id`";
        }

        $store_list = D()->table($db_arr)
            ->field(true)
            ->where($where)
            ->order('`sort` DESC,`store_id` ASC')
            ->select();
        //dump($store_list);exit;
        $this->assign('store_list',$store_list);
        $this->display();
    }



    /*
     * 扫码退款
     */
    public function refund_money_news(){
        //搜索条件
        $get = $this->search_filter($_GET);
        //获取商户id
        $mid=M('cashier_merchants')->where(array('thirduserid'=>$this->mer_id))->getField('mid');
        $map=array();
        //模糊匹配
        isset($get['keywords']) && $map['a.truename'] = array("like",'%' . $get['keywords'] . '%');
        //硬性查询条件
        $map['a.mid']=array('eq',$mid);
        $map['a.ispay']=array('eq','1');
        //获取总条数
        $count=M('cashier_order')->alias('a')
            ->join('left join __CASHIER_FANS__ b on a.openid=b.openid')
            ->field('count(*)')
            ->where($map)
            ->distinct(true)
            ->order('a.paytime desc')
            ->count();
        //$count = M('')->query("select count(*) as count from ($count) as w")[0]['count'];
        import('@.ORG.bootstrap_page');
        $page = new Page($count,I('get.list_rows',0,'int')?:10);
        $list=M('cashier_order')->alias('a')
            ->join('left join __CASHIER_FANS__ b on a.openid=b.openid and a.mid=b.mid')
            ->field('case when a.openid=b.openid and a.mid=b.mid then b.headimgurl else null end as headimgurl,a.*,b.nickname')
            ->where($map)
            ->limit($page->firstRow,$page->listRows)
            ->distinct(true)
            ->order('a.paytime desc')
            ->select();
        //dump($list);exit;
        $this->assign('mer_id',$_SESSION['system']['mer_id']);
        $this->assign('empty','您不是商户，无法查看收银详情');
        $this->assign('list',$list);
        $this->assign('count',$count);
        $this->assign('pageStr',bootstrap_page_style($page->show()));
        $this->display();
    }


    function search_filter( array $request ){
        foreach($request as $k => &$v){
            //过滤掉特殊字符
            $v = preg_replace('/[\',:;*?~`!@#$%^&+=)(<>{}]|\]|\[|\/|\\\|\"|\|/',"",$v);
            //参数两端空格
            $v = trim($v);
        }
        //删除掉全等于空字符串的参数
        $request = array_filter($request,function($v,$k){
            return $v!=="";
        },ARRAY_FILTER_USE_BOTH);
        return $request;
    }



    //企业充值
    public function recharge_news(){
        if(!$this->mer_id){
            $this->assign('empty','您不是商户无法查看详情！');
        }else{
            //商户所在社区
            $village_id=M('merchant')->where(array('mer_id'=>$this->mer_id))->getField('village_id');
            $sql1=M('company')->alias('a')
                ->join('left join __COMPANY_MERCHANT_MONEY__ b on a.company_id=b.company_id')
                ->field('a.company_id,a.company_name name')
                ->where(array('a.village_id'=>$village_id))
                ->select(false);
            $sql2=M('company')->alias('c')
                ->join('left join __COMPANY_MERCHANT_MONEY__ d on c.company_id=d.company_id')
                ->field('c.company_id,d.money')
                ->where(array('c.village_id'=>$village_id,'d.mer_id'=>$this->mer_id))
                ->select(false);
            //商户所在社区下所有公司信息
            $list=M('')->table($sql1.'e')
                ->join("left join $sql2 f on e.company_id=f.company_id")
                ->field('e.company_id,f.money,e.name')
                ->order('e.company_id desc')
                ->select();
            foreach ($list as $key=>&$value){
                //公司人数
                $value['count']=M('house_village_user_bind')->where(array('company_id'=>$value['company_id']))->count();
            }
            unset($value);

            $this->assign('list',$list);
        }

        //传到前台判断是否为商户，区别页面显示
        $this->assign('mid',$this->mer_id);
        $this->display();
    }


    //所有充值记录
    public function all_record(){
        $record=M('up')->alias('a')
            ->join('left join __HOUSE_VILLAGE_USER_BIND__ b on a.uid=b.uid and a.company_id=b.company_id')
            ->field('a.*,b.name')
            ->where(array('a.mid'=>$this->mer_id))
            ->order('a.add_time desc')
            ->select();
        //uid为0即为商户对公司的充值。
        foreach ($record as $k=>&$v){
            if($v['uid']==0){
                $v['name']=M('company')->where(array('company_id'=>$v['company_id']))->getField('company_name');
            }
        }
        unset($v);
        $this->assign('record',$record);
        $this->display();
    }


    //公司充值页面
    public function company_recharge(){
        $company_id=$_GET['company_id'];
        //公司名称
        $company_name=M('company')->where(array('company_id'=>$company_id))->getField('company_name');

        $this->assign('company_name',$company_name);
        $this->assign('company_id',$company_id);
        $this->display();
    }


    //公司充值逻辑处理
    public function company_recharge_submit(){
        //充值人姓名
        $recharge_name=$_SESSION['system']['realname'];
        $company_id=$_POST['company_id'];
        $money=$_POST['money'];
        if($money<0 || $money==0){
            echo json_encode(array('error'=>1,'msg'=>'请输入正确金额！'));
        }
        //公司原来的金额
        $fore_money=M('company_merchant_money')->where(array('company_id'=>$company_id,'mer_id'=>$this->mer_id))->getField('money');
        if($fore_money){//公司在当前商户充过钱
            $left_money=$fore_money+$money;
            //更新
            $result=M('company_merchant_money')->where(array('company_id'=>$company_id,'mer_id'=>$this->mer_id))->data(array('money'=>($fore_money+$money)))->save();
        }else{//公司未在当前商户充过钱
            //新增
            $result=M('company_merchant_money')->data(array('company_id'=>$company_id,'money'=>$money,'mer_id'=>$this->mer_id))->add();
            $left_money=$money;
        }
        $data=array(
            'uid'=>0,
            'mid'=>$this->mer_id,
            'money'=>$money,
            'company_id'=>$_POST['company_id'],
            'type'=>1,
            'add_time'=>time(),
            'recharge_name'=>$recharge_name,
            'cz_id'=>'cz'.time().mt_rand(100, 1000),
            //'left_money'=>$left_money
        );
        if($result){
            M('up')->data($data)->add();
            echo json_encode(array('error'=>0,'msg'=>'充值成功！'));
        }
    }


    //公司人员详情列表
    public function user_list(){
        $company_id=$_GET['company_id'];
        $mid=$this->thirduserid;
        $sql1=M('house_village_user_bind')->alias('a')
            ->join('left join __USER__ b on a.uid=b.uid')
            ->join('left join __USER_GROUP__ c on a.group_id=c.group_id')
            ->field('a.uid,a.company_id,a.name,a.phone,a.card_type,a.usernum,a.add_time,b.nickname,c.group_name')
            ->where(array('a.company_id'=>$company_id))
            ->select(false);
        $sql2=M('house_village_user_bind')->alias('d')
            ->join('left join __USER_MERCHANT_MONEY__ e on d.uid=e.uid')
            ->field('d.uid,e.money')
            ->where(array('d.company_id'=>$company_id,'e.mer_id'=>$this->mer_id))
            ->select(false);
        $list=M('')->table($sql1.'f')
            ->join("left join $sql2 g on f.uid=g.uid")
            ->field('f.uid,g.money,f.name,f.company_id,f.group_name,f.phone,f.nickname,f.card_type,f.usernum,f.add_time')
            ->order('f.add_time desc')
            ->select();
        //前台显示公司名称
        $company_name=M('company')->where(array('company_id'=>$company_id))->getField('company_name');
        foreach ($list as $key=>&$value){
            //员工在user表中的余额，即平台余额
            $now_money=M('user')->where(array('uid'=>$value['uid']))->getField('now_money');
            if($value['money']===NULL){
                $value['money']=floatval(0);
            }
            //商户下的余额+平台余额
            $value['money']=$value['money']+$now_money;
        }
        unset($value);
        //公司在此商户下的余额
        $company_money=M('company_merchant_money')->where(array('company_id'=>$company_id,'mer_id'=>$this->mer_id))->getField('money');

        $this->assign('company_money',$company_money);
        $this->assign('list',$list);
        $this->assign('mid',$mid);
        $this->assign('company_id',$company_id);
        $this->assign('company_name',$company_name);
        $this->display();
    }



    //公司的充值记录
    public function record(){
        $company_id=$_GET['company_id'];
        //充值记录
        $list=M('up')->alias('a')
            ->join('left join __HOUSE_VILLAGE_USER_BIND__ b on a.uid=b.uid and a.company_id=b.company_id')
            ->field('a.*,b.name')
            ->where(array('a.mid'=>$this->mer_id,'a.company_id'=>$company_id))
            ->order('a.add_time desc')
            ->select();
        foreach ($list as $key=>&$value){
            if($value['uid']==0){
                $company_name=M('company')->where(array('company_id'=>$value['company_id']))->getField('company_name');
                $value['name']=$company_name;
            }
        }
        unset($value);
        //前台显示公司名称
        $company_name=M('company')->where(array('company_id'=>$company_id))->getField('company_name');

        $this->assign('list',$list);
        $this->assign('company_name',$company_name);
        $this->assign('company_id',$company_id);
        $this->display();
    }



    //分组管理
    public function group(){
        $company_id=$_GET['company_id'];
        //分组列表
        $list=M('user_group')->where(array('company_id'=>$company_id))->order('group_id desc')->select();
        foreach ($list as $key=>$value){//查询组内成员人数
            $list[$key]['count']=M('house_village_user_bind')->where(array('company_id'=>$company_id,'group_id'=>$value['group_id']))->count();
        }
        //前台显示公司名称
        $company_name=M('company')->where(array('company_id'=>$company_id))->getField('company_name');

        $this->assign('list',$list);
        $this->assign('company_name',$company_name);
        $this->assign('company_id',$company_id);
        $this->display();
    }


    //员工充值页面
    public function recharge(){
        $company_id=$_GET['company_id'];
        $uid=$_GET['uid'];
        $user_name=M('house_village_user_bind')->where(array('uid'=>$uid))->getField('name');
        //前台显示公司名称
        $company_name=M('company')->where(array('company_id'=>$company_id))->getField('company_name');

        $this->assign('user_name',$user_name);
        $this->assign('company_name',$company_name);
        $this->assign('company_id',$company_id);
        $this->assign('uid',$uid);
        $this->display();
    }



    /*
     * 员工充值
     * 陈琦
     * 2016.12.5
     */
    public function user_recharge_submit(){
        //商户名
        $merchant_name=M('merchant')->where(array('mer_id'=>$this->mer_id))->getField('name');
        $merchantOb = M('user_merchant_money');
        $money = $_POST['money'];
        $money=floatval($money);
        if($money<0 || $money==0){
            echo json_encode(array('error'=>1,'msg'=>'请输入正确金额！'));
        }
        $uid = $_POST['uid'];
        $data=array(
            'uid'=>$uid,
            'mid'=>$this->mer_id,
            'money'=>$money,
            'company_id'=>$_POST['company_id'],
            'type'=>2,
            'add_time'=>time(),
            'recharge_name'=>$_SESSION['system']['realname'],
            'cz_id'=>'cz'.time().mt_rand(100, 1000),
        );
        //公司在当前商户的余额
        $company_money=M('company_merchant_money')->where(array('company_id'=>$_POST['company_id'],'mer_id'=>$this->mer_id))->getField('money');
        if($money>$company_money){
            echo json_encode(array('error'=>1,'msg'=>'余额不足！'));
            exit;
        }
        $a=$merchantOb->where(array('uid'=>$uid,'mer_id'=>$this->mer_id))->getField('money');
        if($a){//用户在当前商户充过钱
            $merchantOb->where(array('uid'=>$uid,'mer_id'=>$this->mer_id))->data(array('money'=>$a+$money))->save();
        }else{//用户未在当前商户充过钱
            $res=array(
                'uid'=>$uid,
                'mer_id'=>$this->mer_id,
                'money'=>$money,
            );
            $merchantOb->data($res)->add();
        }
        $recharge=array(
            'uid'=>$uid,
            'type'=>1,
            'money'=>$money,
            'app_money'=>0,
            'merchant_money'=>$money,
            'time'=>$_SERVER['REQUEST_TIME'],
            'desc'=>'商户充值',
            'name'=>$merchant_name,
            'order_id'=>'cz'.time().mt_rand(100, 1000),
            'mid'=>$this->mer_id,
            'refund'=>1,
            'now_money'=>$a+$money,
        );
        //插入汇总表
        M('user_money_list')->data($recharge)->add();
        //充值成功后进充值记录表
        $result=M('up')->data($data)->add();
        M('company_merchant_money')->where(array('company_id'=>$_POST['company_id'],'mer_id'=>$this->mer_id))->save(array('money'=>$company_money-$money));
        if($result){
            echo json_encode(array('error'=>0,'msg'=>'充值成功！'));
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
        //所有组
        $group=M('user_group')->where(array('company_id'=>$company_id))->select();
        $user=M('house_village_user_bind')->where(array('uid'=>$uid))->find();
        //前台显示公司名称
        $company_name=M('company')->where(array('company_id'=>$company_id))->getField('name');

        $this->assign('group',$group);
        $this->assign('user',$user);
        $this->assign('uid',$uid);
        $this->assign('company_id',$company_id);
        $this->assign('company_name',$company_name);
        $this->display();
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
            $this->error('姓名不能为空！');
        }
        if(empty($phone)){
            $this->error('联系电话不能为空！');
        }
        if(empty(preg_match("/^1[34578]{1}\d{9}$/",$_POST['phone']))){
            $this->error('联系电话格式有误！');
        }
        if($group_id){
            //更新
            $result=M('house_village_user_bind')->where(array('company_id'=>$company_id,'uid'=>$_POST['uid']))->save(array('group_id'=>$group_id,'name'=>$name,'phone'=>$phone));
            if($result){
                $this->success('编辑成功！',U('user_list',array('company_id'=>$_POST['company_id'])));
                exit;
            }
        }
    }


    /*
     * 添加分组/页面
     * 陈琦
     * 2016.12.5
     */
    public function add_group(){
        $company_id=$_GET['company_id'];
        //前台显示公司名称
        $company_name=M('company')->where(array('company_id'=>$company_id))->getField('company_name');

        $this->assign('company_id',$company_id);
        $this->assign('company_name',$company_name);
        $this->display();
    }



    /*
     * 添加分组/表单提交
     * 陈琦
     * 2016.12.5
     */
    public function ag_submit(){
        //组名
        $group_name=$_POST['group_name'];
        if($group_name){
            //描述
            $desc=$_POST['desc'];
            $company_id=$_POST['company_id'];
            $all=M('user_group')->where(array('company_id'=>$company_id))->select();
            foreach ($all as $key=>$value){
                if($value['group_name']==$group_name){
                    $this->error('已存在该组名！',U('group',array('company_id'=>$company_id)));
                }
            }
            //添加
            $result=M('user_group')->data(array('group_name'=>$group_name,'desc'=>$desc,'company_id'=>$company_id))->add();
            if($result){
                $this->success('添加成功！',U('group',array('company_id'=>$company_id)));
                exit;
            }
        }else{
            $this->error('请填写组名！');
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
        $result=M('user_group')->where(array('group_id'=>$group_id))->getField('group_name');
        //前台显示公司名称
        $company_name=M('company')->where(array('company_id'=>$company_id))->getField('company_name');

        $this->assign('result',$result);
        $this->assign('company_name',$company_name);
        $this->assign('company_id',$company_id);
        $this->assign('group_id',$group_id);
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
                echo json_encode(array('error'=>1,'msg'=>'请输入正确金额！'));
            }
            $group_id = $_POST['group_id'];
            $company_id=$_POST['company_id'];
            $merchant_name=M('merchant')->where(array('mer_id'=>$this->mer_id))->getField('name');
            $village_id=M('merchant')->where(array('mer_id'=>$this->mer_id))->getField('village_id');
            //当前组名的所有用户
            $result=M('house_village_user_bind')->where(array('group_id'=>$group_id,'village_id'=>$village_id))->select();
            //查询当前商户下存在的所有uid
            $re=M('user_merchant_money')->where(array('mer_id'=>$this->mer_id))->field('uid')->select();
            //存所有uid的一位数组
            $all_uid=array();
            foreach ($re as $key=>$value){
                $all_uid[]=$value['uid'];
            }
            //查询组内成员人数
            $count=M('house_village_user_bind')->where(array('group_id'=>$group_id,'village_id'=>$village_id))->count();
            if($result){//当前组内有成员
                $company_money=M('company_merchant_money')->where(array('company_id'=>$company_id,'mer_id'=>$this->mer_id))->getField('money');//公司在当前商户余额
                //该组总共充值金额
                $row_money=$count*$money;
                if($row_money>$company_money){
                    echo json_encode(array('error'=>1,'msg'=>'余额不足！'));exit;
                }
                foreach ($result as $key=>$value){
                    //公司在当前商户余额
                    $company_money=M('company_merchant_money')->where(array('company_id'=>$company_id,'mer_id'=>$this->mer_id))->getField('money');
                    //员工在当前商户余额
                    $a=M('user_merchant_money')->where(array('uid'=>$value['uid'],'mer_id'=>$this->mer_id))->getField('money');
                    if(in_array($value['uid'],$all_uid)){
                        //更新
                        $succcess=M('user_merchant_money')->where(array('uid'=>$value['uid'],'mer_id'=>$this->mer_id))->save(array('money'=>$a+$money));
                    }else{
                        //添加
                        $succcess=M('user_merchant_money')->data(array('money'=>$money,'uid'=>$value['uid'],'mer_id'=>$this->mer_id))->add();
                    }
                    M('company_merchant_money')->where(array('company_id'=>$company_id,'mer_id'=>$this->mer_id))->save(array('money'=>($company_money-$money)));
                    $data=array(
                        'uid'=>$value['uid'],
                        'mid'=>$this->mer_id,
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
                        'mid'=>$this->mer_id,
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
     * 分组编辑页面
     * 陈琦
     * 2016.11.29
     */
    public function group_edit(){
        $company_id=$_GET['company_id'];
        //前台显示公司名称
        $company_name=M('company')->where(array('company_id'=>$company_id))->getField('company_name');
        $group_id=$_GET['group_id'];
        $result=M('user_group')->where(array('group_id'=>$group_id))->find();

        $this->assign('result',$result);
        $this->assign('company_id',$company_id);
        $this->assign('group_id',$group_id);
        $this->assign('company_name',$company_name);
        $this->display();
    }



    /*
     * 分组编辑表单提交
     * 陈琦
     * 2016.11.29
     */
    public function ge_submit(){
        $company_id=$_POST['company_id'];
        //当前组id
        $group_id=$_POST['group_id'];
        $group_name=$_POST['group_name'];
        if(empty($group_name)){
            $this->error('组名不能为空！');
        }
        $desc=$_POST['desc'];
        //查询其他组所有信息，下一步作出是否重复组名的判断
        $all=M('user_group')->where(array('company_id'=>$company_id,'group_id'=>array('neq',$group_id)))->select();
        foreach ($all as $key=>$value){
            if($value['group_name']==$group_name){
                $this->error('已存在该组名！',U('group',array('company_id'=>$company_id)));
            }
        }
        $result=M('user_group')->where(array('group_id'=>$group_id))->save(array('group_name'=>$group_name,'desc'=>$desc));
        if($result!==false){
            $this->success('编辑成功！',U('group',array('company_id'=>$company_id)));
            exit;
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
        $arr=M('house_village_user_bind')->where(array('group_id'=>$_GET['group_id']))->field('uid')->select();
        if($arr){
                $this->error('该组尚有成员！',U('group',array('company_id'=>$company_id)));
        }else{
            $del=M('user_group')->where(array('group_id'=>$group_id))->delete();
            if($del){
                $this->success('删除成功！',U('group',array('company_id'=>$company_id)));
                exit;
            }
        }
    }




    /*
     * 成员管理
     * 陈琦
     * 2016.12.5
     */
    public function user_manage(){
        $group_id=$_GET['group_id'];
        $company_id=$_GET['company_id'];
        //该组人信息
        $user = M('house_village_user_bind')->where(array('company_id'=>$company_id,'group_id'=>$group_id))->select();
        //其他剩余组
        $group=M('user_group')->where(array('company_id'=>$company_id,'group_id'=>array('neq',$group_id)))->select();
        //当前组名
        $this_group=M('user_group')->where(array('group_id'=>$group_id))->getField('group_name');
        //前台显示公司名称
        $company_name=M('company')->where(array('company_id'=>$company_id))->getField('company_name');

        $this->assign('group_id',$group_id);
        $this->assign('company_id',$company_id);
        $this->assign('group',$group);
        $this->assign('this_group',$this_group);
        $this->assign('user',$user);
        $this->assign('company_name',$company_name);
        $this->display();
    }



    /*
     * 添加组员
     * 陈琦
     * 2016.11.30.
     */
    public function add_user(){
        $company_id = $_GET['company_id'];
        //前台显示公司名称
        $company_name=M('company')->where(array('company_id'=>$company_id))->getField('company_name');
        $group_id = $_GET['group_id'];
        $user = M('house_village_user_bind')->where(array('company_id'=>$company_id,'group_id'=>0))->select();
        $group_name=M('user_group')->where(array('group_id'=>$group_id))->getField('group_name');

        $this->assign('company_id',$company_id);
        $this->assign('group_id',$group_id);
        $this->assign('user',$user);
        $this->assign('group_name',$group_name);
        $this->assign('company_name',$company_name);
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
            foreach ($arr as $key=>$val){
                $update=M('house_village_user_bind')->where(array('uid'=>$val))->save(array('group_id'=>$group_id));
            }
            if($update){
                $this->success('添加成功！',U('user_manage',array('company_id'=>$company_id,'group_id'=>$group_id)));
                exit;
            }
        }else{
            $this->error('请选择成员！');
            exit;
        }
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
                $this->success('成功移至'.$group_name.'!',U('user_manage',array('company_id'=>$company_id,'group_id'=>$this_group_id)));
                exit;
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
            $mid=$this->mer_id;
            foreach ($arr as $key=>$value){
                $update=M('house_village_user_bind')->where(array('uid'=>$value))->save(array('group_id'=>0));
            }
            $village=M('merchant')->where(array('mer_id'=>$mid))->getField('village_id');
            if($update){
                $user = M('house_village_user_bind')->where(array('group_id'=>$group_id,'village_id'=>$village))->select();
                $list=' <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">';
                $list.='<thead><tr><th><label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /><span></span></label></th>';
                $list.='<th>用户名</th>';
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
                        $url='./admin.php?m=System&c=Company&a=user_del&company_id='.$company_id.'&group_id='.$group_id.'&uid='.$value['uid'];
                        $list.='<tbody><tr class="odd gradeX"><td><label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input type="checkbox" class="checkboxes" value="'.$value['uid'].'" name="checkbox[]" /><span></span></label></td>';
                        $list.='<td class="center">'.$value['name'].'</td>';
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
     * 剔除组员
     * 陈琦
     * 2016.11.30
     */
    public function user_del(){
        $uid=$_GET['uid'];
        $company_id=$_GET['company_id'];
        $group_id=$_GET['group_id'];
        $del=M('house_village_user_bind')->where(array('uid'=>$uid))->save(array('group_id'=>0));
        if($del){
            $this->success('移除成功！',U('user_manage',array('company_id'=>$company_id,'group_id'=>$group_id)));
        }
    }



    //店铺订单
    public function order(){
        $store_id = intval($_GET['store_id']);
        //检测店铺
        if($this->mer_id){
            $now_store = $this->check_store($store_id);
            $this->assign('now_store', $now_store);
        }
        //$where['mer_id'] = $this->mer_id;
        $where['store_id'] = $store_id;
        $count=M('meal_order')->where($where)->count();
        import('@.ORG.bootstrap_page');
        $page = new Page($count,10);
        $list = M('meal_order')->where($where)->order("order_id DESC")->limit($page->firstRow,$page->listRows)->select();
        $tableids = array();
        foreach ($list as $l) {
            if (!in_array($l['tableid'], $tableids)) {
                $tableids[] = $l['tableid'];
            }
        }
        $tablename = array();
        if ($tableids) {
            $tables = D('Merchant_store_table')->where(array('pigcms_id' => array('in', $tableids), 'store_id' => $store_id))->select();
            foreach ($tables as $table) {
                $tablename[$table['pigcms_id']] = $table;
            }
        }
        foreach ($list as &$ll) {
            $ll['tablename'] = isset($tablename[$ll['tableid']]['name']) ? $tablename[$ll['tableid']]['name'] : '不限';
            $ll['info'] = unserialize($ll['info']);
        }
        $this->assign('count',$count);
        $this->assign('pageStr',bootstrap_page_style($page->show()));
        $this->assign('list', $list);
        $this->display();
    }


    /* 检测店铺存在，并检测是不是归属于商家 */

    protected function check_store($store_id){
        $database_merchant_store = D('Merchant_store');
        $condition_merchant_store['store_id'] = $store_id;
        $condition_merchant_store['mer_id'] = $this->mer_id;
        $now_store = $database_merchant_store->where($condition_merchant_store)->find();
        if(empty($now_store)){
            $this->error('店铺不存在！');
        }else{
            return $now_store;
        }
    }



    //商品分类
    public function meal_sort(){
        if($this->mer_id){
            $now_store = $this->check_store($_GET['store_id']);
        }else{
            $now_store['store_id']=$_GET['store_id'];
        }
        $this->assign('now_store',$now_store);

        $database_meal_sort = D('Meal_sort');

        $condition_merchant_sort['store_id'] = $now_store['store_id'];


        $sort_list = $database_meal_sort->field(true)->where($condition_merchant_sort)->order('`sort` DESC,`sort_id` ASC')->select();

        foreach($sort_list as $key=>$value){

            if(!empty($value['week'])){

                $week_arr = explode(',',$value['week']);

                $week_str = '';

                foreach($week_arr as $k=>$v){

                    $week_str .= $this->get_week($v).' ';

                }

                $sort_list[$key]['week_str'] = $week_str;

            }

        }

        $this->assign('sort_list',$sort_list);

        $this->display();
    }




    protected function get_week($num){

        switch($num){

            case 1:

                return '星期一';

            case 2:

                return '星期二';

            case 3:

                return '星期三';

            case 4:

                return '星期四';

            case 5:

                return '星期五';

            case 6:

                return '星期六';

            case 0:

                return '星期日';

            default:

                return '';

        }

    }



    /* 菜品管理 */

    public function meal_list(){


        $now_sort = $this->check_sort($_GET['sort_id']);
        if($this->mer_id){
            $now_store = $this->check_store($now_sort['store_id']);
        }else{
            $now_store=M('merchant_store')->where(array('store_id'=>$now_sort['store_id']))->find();
        }

        $this->assign('now_sort',$now_sort);

        $this->assign('now_store',$now_store);

        //dump($now_store['store_type']);exit();

        $database_meal = D('Meal');

        $condition_meal['sort_id'] = $now_sort['sort_id'];

        $count_meal = $database_meal->where($condition_meal)->count();

        $meal_list = $database_meal->field(true)->where($condition_meal)->order('`sort` DESC,`meal_id` ASC')->select();


        $plist = array();

        $prints = D('Orderprinter')->where(array('mer_id' => $now_store['mer_id'], 'store_id' => $now_store['store_id']))->select();

        foreach ($prints as $l) {

            if ($l['is_main']) {

                $l['name'] .= '(主打印机)';

            } else {

                $l['name'] = $l['name'] ? $l['name'] : '打印机-' . $l['pigcms_id'];

            }

            $plist[$l['pigcms_id']] = $l;

        }

        foreach ($meal_list as &$rl) {

            $rl['print_name'] = isset($plist[$rl['print_id']]['name']) ? $plist[$rl['print_id']]['name'] : '';
            //链接
            $rl['link'] = '/wap.php?g=Wap&c=PropertyService&a=appointment&meal_id=' . $rl['meal_id'];
        }


        $this->assign('meal_list',$meal_list);


        $this->display();

    }


    /* 检测分类存在 */

    protected function check_sort($sort_id){

        $database_meal_sort = D('Meal_sort');

        $condition_merchant_sort['sort_id'] = $sort_id;

        $now_sort = $database_meal_sort->field(true)->where($condition_merchant_sort)->find();

        if(empty($now_sort)){

            $this->error('分类不存在！');

        }

        if(!empty($now_sort['week'])){

            $now_sort['week'] = explode(',',$now_sort['week']);

        }

        return $now_sort;

    }


    /* 删除分类 */

    public function sort_del(){

        $now_sort = $this->check_sort($_GET['sort_id']);

        $database_meal_sort = D('Meal_sort');

        $condition_merchant_sort['sort_id'] = $now_sort['sort_id'];

        if($database_meal_sort->where($condition_merchant_sort)->delete()){

            $this->success('删除成功！');

        }else{

            $this->error('删除失败！');

        }

    }


    /*添加分类*/

    public function sort_add(){
        if($this->mer_id){
            $now_store = $this->check_store($_GET['store_id']);
        }else{
            $now_store=M('merchant_store')->where(array('store_id'=>$_GET['store_id']))->find();
        }

        $this->assign('now_store',$now_store);
        if(IS_POST){
            if(empty($_POST['sort_name'])){
                $this->error('分类名称必填！');
            }else{
                $database_meal_sort = D('Meal_sort');
                $data_meal_sort['store_id'] = $now_store['store_id'];
                $data_meal_sort['sort_name'] = $_POST['sort_name'];
                $data_meal_sort['sort'] = intval($_POST['sort']);
                $data_meal_sort['is_weekshow'] = intval($_POST['is_weekshow']);
                if($_POST['week']){
                    $data_meal_sort['week'] = strval(implode(',',$_POST['week']));
                }
                if($database_meal_sort->data($data_meal_sort)->add()){
                    $this->success('添加成功！！', U('meal_sort',array('store_id' => $now_store['store_id'])));
                    die;
                }else{
                    $this->error('添加失败！！请重试。', U('meal_sort',array('store_id' => $now_store['store_id'])));
                    die;
                }
            }
            if(!empty($error_tips)){
                $this->assign('now_sort',$_POST);
            }
        }
        $this->display();
    }



    /*修改分类*/

    public function sort_edit(){
        //检测分类
        $now_sort = $this->check_sort($_GET['sort_id']);
        $now_store = $this->check_store($now_sort['store_id']);
        $this->assign('now_sort',$now_sort);
        $this->assign('now_store',$now_store);
        if(IS_POST){
            if(empty($_POST['sort_name'])){
                $this->error('分类名称必填!');
            }else{
                $database_meal_sort = D('Meal_sort');
                $data_meal_sort['sort_id'] = $now_sort['sort_id'];
                $data_meal_sort['sort_name'] = $_POST['sort_name'];
                $data_meal_sort['sort'] = intval($_POST['sort']);
                $data_meal_sort['is_weekshow'] = intval($_POST['is_weekshow']);
                $data_meal_sort['week'] = implode(',',$_POST['week']);
                if($database_meal_sort->data($data_meal_sort)->save()){
                    $this->success('保存成功！！', U('meal_sort',array('store_id' => $now_store['store_id'])));
                    die;
                }else{
                    $this->error('保存失败！！您是不是没做过修改？请重试。', U('meal_sort',array('store_id' => $now_store['store_id'])));
                    die;
                }
            }
            $_POST['sort_id'] = $now_sort['sort_id'];
            $this->assign('now_sort',$_POST);
        }
        $this->display();
    }


    /* 添加商品 */

    public function meal_add(){
        $now_sort = $this->check_sort($_GET['sort_id']);
        if($this->mer_id){
            $now_store = $this->check_store($now_sort['store_id']);
        }else{
            $now_store=M('merchant_store')->where(array('store_id'=>$now_sort['store_id']))->find();
        }
        $storeid=M('meal_sort')->where(array('sort_id'=>$_GET['sort_id']))->getField('store_id');
        $merid=M('merchant_store')->where(array('store_id'=>$storeid))->getField('mer_id');
        $this->assign('now_sort',$now_sort);
        $this->assign('now_store',$now_store);
        if(IS_POST){
//            dump($this->img_dir);
//            dump($_POST['banner_imgs']);exit;
            if($now_store['store_type']==3){
                $_POST['banner_imgs'] = join(',',str_replace('./'. $this->img_dir ,'',$_POST['banner_imgs']));
            }
//            dump($_POST['banner_imgs']);exit;
            if(empty($_POST['name'])){
                $error_tips .= '商品名称必填！'.'<br/>';
            }
            if(empty($_POST['unit'])){
                $error_tips .= '商品单位必填！'.'<br/>';
            }
            if(empty($_POST['price'])){
                $error_tips .= '商品价格必填！'.'<br/>';
            }
            //逗号链接 联系方式
            if($_POST['contact']){
                $_POST['contact'] = join(',',$_POST['contact']);
            }
            if($_FILES['image']['error'] != 4){
                $param = array('size' => $this->config['meal_pic_size']);
                $param['thumb'] = true;
                $param['imageClassPath'] = 'ORG.Util.Image';
                $param['thumbPrefix'] = 'm_,s_';
                $param['thumbMaxWidth'] = $this->config['meal_pic_width'];
                $param['thumbMaxHeight'] = $this->config['meal_pic_height'];
                $param['thumbRemoveOrigin'] = false;
                $image = D('Image')->handle($merid, 'meal', 1, $param);
                if ($image['error']) {
                    $error_tips .= $image['msg'] . '<br/>';
                } else {
                    $_POST = array_merge($_POST, $image['title']);
                }
            }
            if(!empty($_POST['image_select'])){
                $img_mer_id = sprintf("%09d", $merid);
                $rand_num = substr($img_mer_id, 0, 3) . '/' . substr($img_mer_id, 3, 3) . '/' . substr($img_mer_id, 6, 3);
                $tmp_img = explode(',',$_POST['image_select']);
                $_POST['image']=$rand_num.','.$tmp_img[1];
            }
            $_POST['print_id'] = isset($_POST['print_id']) ? intval($_POST['print_id']) : 0;
            $_POST['des'] = stripslashes($_POST['des']);
            if(empty($error_tips)){
                $_POST['sort_id'] = $now_sort['sort_id'];
                $_POST['store_id'] = $now_store['store_id'];
                $_POST['last_time'] = $_SERVER['REQUEST_TIME'];
                $database_meal = D('Meal');
                if($meal_id = $database_meal->data($_POST)->add()){
                    D('Image')->update_table_id($_POST['image'], $meal_id, 'meal');
                    $this->success('添加成功！', U('meal_list',array('sort_id' => $now_sort['sort_id'])));
                    die;
                    $ok_tips = '添加成功！';
                }else{
                    $this->error('添加失败！请重试！', U('meal_list',array('sort_id' => $now_sort['sort_id'])));
                    die;
                    $error_tips = '添加失败！请重试。';
                }
            }else{
                $this->assign('now_meal',$_POST);
            }
            $this->assign('ok_tips',$ok_tips);
            $this->assign('error_tips',$error_tips);
        }
        $print_list = D('Orderprinter')->where(array('mer_id' => $now_store['mer_id'], 'store_id' => $now_store['store_id']))->select();
        foreach ($print_list as &$l) {
            if ($l['is_main']) {
                $l['name'] .= '(主打印机)';
            } else {
                $l['name'] = $l['name'] ? $l['name'] : '打印机-' . $l['pigcms_id'];
            }
        }
        $this->assign('print_list', $print_list);
        $this->display();
    }


    /**
     * 上传文件类型控制 此方法仅限ajax上传使用
     * @param  string   $path    字符串 保存文件路径示例： /Upload/image/
     * @param  string   $format  文件格式限制
     * @param  integer  $maxSize 允许的上传文件最大值 52428800
     * @return booler   返回ajax的json格式数据
     */
    public function ajax_upload(){
        $path='images/' . date("Y-m-d"). "/";
        $format='empty';
        $maxSize='52428800';

        ini_set('max_execution_time', '0');
        // 去除两边的/
        $path=trim($path,'/');
        // 添加Upload根目录
        $path=strtolower($this->img_dir .  $path);

        if(!is_dir($path)){
            $b = mkdir($path,0777,true);
            if(!$b){
                $this->err("创建文件夹失败",$path);
            }
        }
        // 上传文件类型控制
        $ext_arr= array(
            'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
            'photo' => array('jpg', 'jpeg', 'png'),
            'flash' => array('swf', 'flv'),
            'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
            'file' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2','pdf')
        );
        if(!empty($_FILES)){
            // 上传文件配置
            $config=array(
                'maxSize'   =>  $maxSize,               // 上传文件最大为50M
                'rootPath'  =>  './',                   // 文件上传保存的根路径
                'savePath'  =>  './'.$path.'/',         // 文件上传的保存路径（相对于根路径）
                'saveName'  =>  array('uniqid',''),     // 上传文件的保存规则，支持数组和字符串方式定义
                'autoSub'   =>  true,                   // 自动使用子目录保存上传文件 默认为true
                'exts'      =>    isset($ext_arr[$format])?$ext_arr[$format]:'',
            );
            // 实例化上传
            import('ORG.Net.UploadFile');
            $upload = new UploadFile($config);// 实例化上传类
            // 调用上传方法
            $res=$upload->upload();
            // p($info);

            if(!$res){
                // 返回错误信息
                $error=$upload->getErrorMsg();
                $data['error_info']=$error;
                $this->err("上传失败",$res);
            }else{
                // 返回成功信息
                $info =  $upload->getUploadFileInfo();
                $this->suc("上传成功",$info[0]);

            }
        }
    }

    /**
     * 返回json数据
     */
    protected function suc($message='',$data=null)
    {
        echo json_encode(
            array(
                'err' => 0,
                'msg' => $message,
                'data' => $data
            ),
            $json_option=JSON_UNESCAPED_UNICODE //不转义中文
        );
        exit();
    }

    public function err($message='',$data=null,$errno=999){

        echo json_encode(
            array(
                'err'=> $errno,
                'msg'=> $message,
                'data'=>$data
            ),
            $json_option=JSON_UNESCAPED_UNICODE //不转义中文
        );
        exit();

    }



    /* 编辑店铺 */

    public function meal_edit(){
        $storeid=M('meal')->where(array('meal_id'=>$_GET['meal_id']))->getField('store_id');
        $merid=M('merchant_store')->where(array('store_id'=>$storeid))->getField('mer_id');
        $now_meal = $this->check_meal($_GET['meal_id']);
        $now_sort = $this->check_sort($now_meal['sort_id']);

        if($this->mer_id){
            $now_store = $this->check_store($now_sort['store_id']);
        }else{
            $now_store=M('merchant_store')->where(array('store_id'=>$now_sort['store_id']))->find();
        }
        //数据处理
        $now_meal['see_logo'] = str_replace(',','/',$now_meal['logo']);
        $now_meal['see_logo'] = $this->img_dir . $now_meal['see_logo'];
        $now_meal['banner_imgs'] = explode(',',$now_meal['banner_imgs']);
        foreach($now_meal['banner_imgs'] as &$v){
            $v = $this->img_dir . $v;
        }
        unset($v);
       // dump($now_meal);exit;
        $this->assign('now_meal',$now_meal);
        $this->assign('now_sort',$now_sort);
        $this->assign('now_store',$now_store);
        if(IS_POST){
            //逗号链接 联系方式
            if($_POST['contact']){
                $_POST['contact'] = join(',',$_POST['contact']);
            }
            //dump($_POST); exit();
            unset($_POST['logo']);
//            dump($_FILES);
//            dump($_POST);
//            exit();
            if($now_store['store_type']==3&& $_POST['banner_imgs']){
                $_POST['banner_imgs'] = join(',',str_replace('./'. $this->img_dir ,'',$_POST['banner_imgs']));
            }
            if(empty($_POST['name'])){
                $error_tips .= '商品名称必填！'.'<br/>';
            }
            if(empty($_POST['unit'])){
                $error_tips .= '商品单位必填！'.'<br/>';
            }
            if(empty($_POST['price'])){
                $error_tips .= '商品价格必填！'.'<br/>';
            }
            if($_FILES['image']['error'] != 4){
                $param = array('size' => $this->config['meal_pic_size']);
                $param['thumb'] = true;
                $param['imageClassPath'] = 'ORG.Util.Image';
                $param['thumbPrefix'] = 'm_,s_';
                $param['thumbMaxWidth']  = $this->config['meal_pic_width'];
                $param['thumbMaxHeight'] = $this->config['meal_pic_height'];
                $param['thumbRemoveOrigin'] = false;
                $image = D('Image')->handle($merid, 'meal', 1, $param);
                if ($image['error']) {
                    $error_tips .= $image['msg'] . '<br/>';
                } else {
                    $_POST = array_merge($_POST, $image['title']);
                }
            }else{
                unset($_POST['image']);
            }
            if($_FILES['logo']['error'] != 4){
                $param = array('size' => $this->config['meal_pic_size']);
                $param['thumb'] = true;
                $param['imageClassPath'] = 'ORG.Util.Image';
                $param['thumbPrefix'] = 'm_,s_';
                $param['thumbMaxWidth']  = $this->config['meal_pic_width'];
                $param['thumbMaxHeight'] = $this->config['meal_pic_height'];
                $param['thumbRemoveOrigin'] = false;
                $logo = D('Image')->handle($merid, 'meal', 1, $param);
                $logo['title'] = $logo['title']?:array();
                $_POST = array_merge($_POST, $logo['title']);
            }else{
                unset($_POST['logo']);
            }
            if(!empty($_POST['image_select'])){
                $img_mer_id = sprintf("%09d", $merid);
                $rand_num = substr($img_mer_id, 0, 3) . '/' . substr($img_mer_id, 3, 3) . '/' . substr($img_mer_id, 6, 3);
                $tmp_img = explode(',',$_POST['image_select']);
                $_POST['image']=$rand_num.','.$tmp_img[1];
            }
            $_POST['print_id'] = isset($_POST['print_id']) ? intval($_POST['print_id']) : 0;
            $_POST['meal_id'] = $now_meal['meal_id'];
            $_POST['des'] = stripslashes($_POST['des']);
            if(empty($error_tips)){
                $_POST['sort_id'] = $now_sort['sort_id'];
                $_POST['store_id'] = $now_store['store_id'];
                $_POST['last_time'] = $_SERVER['REQUEST_TIME'];
                $database_meal = D('Meal');
                if($database_meal->data($_POST)->save()){
                    $meal_image_class = new meal_image();
                    $t_image = $meal_image_class->get_image_by_path($_POST['image'], '', -1);
                    D('Image')->update_table_id($t_image['image'], $_POST['meal_id'], 'meal');
                    //删除原有图片
                    if(!empty($_POST['image']) && !empty($now_meal['image'])&&empty($_POST['image_select'])){
                        //$meal_image_class = new meal_image();
                        $meal_image_class->del_image_by_path($now_meal['image']);
                    }
                    $meal_image_class = new meal_image();
                    $now_meal['see_image'] = $meal_image_class->get_image_by_path($_POST['image'],$this->config['site_url'],'s');
                    $this->assign('now_meal',$now_meal);
                    $this->success('编辑成功！', U('meal_list',array('sort_id' => $now_sort['sort_id'])));
                    die;
                    $ok_tips = '编辑成功！';
                }else{
                    $this->error('编辑失败！请重试！', U('meal_list',array('sort_id' => $now_sort['sort_id'])));
                    die;
                    $error_tips = '编辑失败！请重试。';
                }
            }else{
                $this->assign('now_meal',$_POST);
            }
            $this->assign('ok_tips',$ok_tips);
            $this->assign('error_tips',$error_tips);
        }
        $print_list = D('Orderprinter')->where(array('mer_id' => $now_store['mer_id'], 'store_id' => $now_store['store_id']))->select();
        foreach ($print_list as &$l) {
            if ($l['is_main']) {
                $l['name'] .= '(主打印机)';
            } else {
                $l['name'] = $l['name'] ? $l['name'] : '打印机-' . $l['pigcms_id'];
            }
        }
        $this->assign('print_list', $print_list);
        $this->display();

    }


    /* 检测商品存在 */

    protected function check_meal($meal_id){

        $database_meal = D('Meal');

        $condition_meal['meal_id'] = $meal_id;

        $now_meal = $database_meal->field(true)->where($condition_meal)->find();

        if(!empty($now_meal['image'])){

            $meal_image_class = new meal_image();

            $now_meal['see_image'] = $meal_image_class->get_image_by_path($now_meal['image'],$this->config['site_url'],'s');

        }

        if(empty($now_meal)){

            $this->error('商品不存在！');

        }

        return $now_meal;

    }

    /* 商品删除 */

    public function meal_del(){
        $now_meal = $this->check_meal($_GET['meal_id']);
        $database_meal = D('Meal');
        $condition_meal['meal_id'] = $now_meal['meal_id'];
        if($database_meal->where($condition_meal)->delete()){
            $this->success('删除成功！');
        }else{
            $this->error('删除失败！请检查后重试。');
        }
    }


    /**
     * 廢棄
     */
    public function bill_news_bak(){
        $type_name=array(
            'meal'=>'快店',
            'group'=>'团购',
            'weidian'=>'微店',
            'appoint'=>'预约',
            'wxapp'=>'营销',
            'store'=>'收银'
        );
        $is_admin = session('system.account')==="admin";
        $mer_id = session('system.mer_id');
        $type = I('get.type','meal');
        $model = M($type . '_order o','pigcms_');
        //条件
        $map = array();
        //搜索条件过滤
        $get = $this->search_filter($_GET);
        //关键字
        isset($get['keywords']) && $map['m.name'] = array('like','%' .$get['keywords']. '%');
        //搜索条件-时间条件
        if($get['start_time']||$get['end_time']){
            $get['start_time'] = strtotime($get['start_time'] ?: "1970-01-01");
            $get['end_time'] = strtotime($get['end_time'] ?: "2100-01-01")+3600*24-1;
            $map['o.pay_time'] = array(
                array('gt',$get['start_time']),
                array('lt',$get['end_time']),
                'AND'
            );
        }
        //管理员显示全部商家
        $is_admin || $map['o.mer_id'] = array('eq',$mer_id);
        //已支付
        $map['o.paid'] = array('eq',1);
        $map['_complex'] = array(
            'o.pay_type'    => array('neq','offline'),
            'o.balance_pay' => array('neq','0.00'),
            '_logic'      => "OR",
        );
        //计算总额字段
        $sfield = array(
            'sum(balance_pay + payment_money)'=>'price',
            'is_pay_bill'
        );
        //根据type获取不同的额外条件
        switch($type){
            case 'meal':
                $map['o.status']   = array('in','1,2');
                break;
            case 'group':
                $map['o.status']   = array('in','1,2');
                break;
            case 'appoint':
                $map['o.service_status'] = array('eq',1);
                $map['o.is_own'] = array('eq',0);
                break;
            case 'store':
                $map['o.is_own'] = array('eq',0);
                $map['o.refund'] = array('eq',0);
                break;
            default:
                break;
        }

        $res = $model
            ->field($sfield)
            ->where($map)
            ->group('is_pay_bill')
            ->select();
        $alltotal = $alltotalfinsh = 0;
        foreach ($res as $r) {
            $r['is_pay_bill'] && $alltotalfinsh += $r['price'];//已对账的总额
            $r['is_pay_bill'] || $alltotal += $r['price'];     //未对账的总额
        }
        //列表
        //总条数
        $map = array_merge($map);
        $count = $model
            ->where($map)
            ->count();
        //分页
        import('@.ORG.bootstrap_page');
        $page = new Page($count,I('get.list_rows',10));
        $field = array(
            'o.order_id',
            '1 as name',
            'o.info'=>'order_name',
            'o.uid',
            'o.mer_id',
            'o.store_id',
            'o.phone',
            'o.total',
            'o.balance_pay+payment_money'=>'price',
            'o.price'=>'order_price',
            'o.dateline',
            'o.paid',
            'o.pay_type',
            'o.pay_time',
            'o.third_id',
            'o.is_mobile_pay',
            'o.balance_pay',
            'o.payment_money',
            'o.card_id',
            'o.merchant_balance',
            'o.is_pay_bill',
            //'ms.name'=>'store_name',
            'm.name'=>'mer_name',
        );
        $list = $model
            ->field($field)
            //->join('left join __MERCHANT_STORE__ ms on ms.mer_id=o.mer_id')
            ->join('left join __MERCHANT__ m on m.mer_id=o.mer_id')
            ->limit($page->firstRow,$page->listRows)
            ->order('dateline desc')
            ->where($map)
            ->select();


        if($list){
            //本页总额
            $page_bill = 0;
            //本页已对账总额
            $page_is_pay_bill = 0;
            //本页未对账总额
            $page_not_pay_bill = 0;

            foreach($list as &$row){
                $page_bill += $row['order_price'];
                $row['is_pay_bill'] && $page_is_pay_bill += $row['order_price'];
                $row['is_pay_bill'] || $page_not_pay_bill += $row['order_price'];

                $row['pay_type_show'] =(new PayModel())->get_pay_name($row['pay_type'], $row['is_mobile_pay']);
                $row['order_price'] = number_format($row['order_price'],2);
                $row['name'] == 1 && $row['order_name'] = unserialize($row['order_name']);
                $row['type_name'] = $type_name[$type];

            }
        }
        $this->assign('list',$list);
        $this->assign('page_bar',$page->show());
        $this->assign('page_bill',$page_bill);
        $this->assign('page_is_pay_bill',$page_is_pay_bill);
        $this->assign('alltotal',$alltotal);
        $this->assign('alltotalfinsh',$alltotalfinsh);
        $this->assign('type_name',$type_name[$type]);
        $this->display('bill_news');

    }

    /**
     * 企業交易統計
     * @update-time: 2017-07-12 15:31:36
     * @author: 王亚雄
     */
    public function bill_news(){
        $is_admin = session('system.account')==="admin";
        $mer_id = session('system.mer_id');
        $model = M('cashier_order','pigcms_');
        //條件
        $map = array();
        //必要條件
        // ordr.ispay=1 AND ordr.refund!=2
        $map['co.ispay'] = array('eq',1);
        $map['co.refund'] = array('neq',2);
        //搜索条件过滤
        $get = $this->search_filter($_GET);
        //关键字
        //isset($get['keywords']) && $map['m.name'] = array('like','%' .$get['keywords']. '%');
        //搜索条件-时间条件
        if($get['start_time']||$get['end_time']){
            $get['start_time'] = strtotime($get['start_time'] ?: "1970-01-01");
            $get['end_time'] = strtotime($get['end_time'] ?: "2100-01-01")+3600*24-1;
            $map['co.paytime'] = array(
                array('gt',$get['start_time']),
                array('lt',$get['end_time']),
                'AND'
            );
        }

        //需要統計的商家
        $mids = array(28,122);//大頭在和一畝田
        $map['co.mid'] = array('in',$mids);
        //count
        $count = $model->alias('co')
            //->join('left join __CASHIER_MERCHANTS__ cm on cm.mid=co.mid')
            ->where($map)
            ->count();
        import('@.ORG.bootstrap_page');
        $page = new Page($count,I('get.list_rows',10));
        $field = array(
            'cm.wxname',
            'co.goods_describe',
            'co.goods_price',
            'co.goods_name',
            'co.pay_type',
            'co.paytime',
            'co.order_id'
        );
        $list = $model->alias('co')
            ->field($field)
            ->join('left join __CASHIER_MERCHANTS__ cm on cm.mid=co.mid')
            ->limit($page->firstRow,$page->listRows)
            ->order('co.id desc')
            ->select();
        //计算时间条件下总金额
        $sum = $model->alias('co')->where($map)->getField('sum(goods_price) as all_price');
        //计算本页总金额
        $page_sum = array_sum(array_column($list,'goods_price'));
        $this->assign('list',$list);
        $this->assign('page_bar',$page->show());
        $this->assign('count',$count);
        $this->assign('sum',$sum);
        $this->assign('page_sum',$page_sum);
        $this->display();
    }
}