<?php

//社区O2O

class OffAction extends BaseAction
{
    protected $village_bind;

    public function __construct()
    {
        parent::__construct();
        $this->village_bind = $_SESSION['now_village_bind'];
        $this->room = $_SESSION['room'];
        //$this->user_session=$_SESSION['user'];
        /*if (empty($this->user_session)) {
            $location_param['referer'] = urlencode($_SERVER['REQUEST_URI']);
            redirect(U('Login/index', $location_param));
        }*/
    }
    //二维码详情
    public function products_qr_detail() {
        if (IS_POST) {
            $borrower = I('post.borrower');
            $pro_qrcode = I('post.pro_qrcode');
            $data = array();
            $data['borrower'] = $borrower;
            $data['trans_time'] = time();
            $data['receive'] = 1;
            //是否是第一次领取
            $recArr = D('off_products_ercode')->where(array('pro_qrcode'=>$pro_qrcode))->find();
            //不是第一次领取就加入transmit表存到数据库
            if ($recArr['receive'] == 1 && $recArr['borrower']) {
                $rec = D('off_transmit')->where(array('pro_qrcode'=>$pro_qrcode))->find();
                $transmitArr = array();
                //是否首次转交
                if ($rec) {
                    //不是
                    $transmitArr['zero_time'] = $rec['zero_time'];
                } else {
                    //第一次转交
                    $transmitArr['zero_time'] = $recArr['trans_time'];
                }
                $transmitArr['old_name'] = $recArr['borrower'];
                $transmitArr['new_name'] = $borrower;
                $transmitArr['pro_qrcode'] = $pro_qrcode;
                $transmitArr['transmit_time'] = $data['trans_time'];
                D('off_transmit')->add($transmitArr);
            }
            $res = D('off_products_ercode')->where(array('pro_qrcode'=>$pro_qrcode))->save($data);
            if ($res) {
                $this->success('更新成功',U('Off/products_qr_detail',array('pro_qrcode'=>$pro_qrcode)));
            } else {
                $this->error('更新失败',U('Off/products_qr_detail',array('pro_qrcode'=>$pro_qrcode)));
            }
        } else {

            $pro_qrcode = I('get.pro_qrcode');
            //创建物品时生成的二维码
            $field = array(
                'p.*',
                'er.pro_qrcode',
                'er.receive',
                'er.borrower',
                'er.trans_time',
                'er.id'=>'qid',
                't.id'=>'tid',
                't.type_name'=>'tname',
                'z.zone_name',
            );
            $proArr = D('off_products_ercode')->alias('er')
                ->field($field)
                ->join('left join __OFF_PRODUCTS__ p on p.pro_code = er.pro_code')
                ->join('left join __OFF_TYPE__ t on t.id=p.off_pro_type')
                ->join('left join __OFF_ZONE__ z on z.id=er.zone_id')
                ->where(array('er.pro_qrcode'=>$pro_qrcode))
                ->find();
            $this->is_audit($proArr['village_id']);
            $this->assign('proArr',$proArr);
            $this->assign('pro_qrcode',$pro_qrcode);
            $this->display();
        }

    }
    //修改页面
    //自定义二维码详情
    public function products_qr_detail_C() {
        if (IS_POST) {
            $role_names = array(
                '81'=>"库管人员",
            );
            $role_ids = array_keys($role_names);
            $map = array();
            $map['_string'] = "find_in_set($role_ids[0],role_id)";
            // $map['village_id'] = array('eq',4);
            $admins = M('admin')->where($map)->select();
            $openids = array();
            foreach($admins as $admin){
                if($admin['openid']){
                    $openids[] = $admin['openid'];
                }
            }

            $openid = session('openid');
            $re = in_array($openid, $openids);
            // var_dump($re);exit();
            if (in_array($openid, $openids)) {

                $pro_id = I('post.pro_id');
                $borrower = I('post.borrower');
                $pro_qrcode = I('post.pro_qrcode');
                $zone_id=I('post.zone_id');
                $re = D('off_products')->where(array('pro_id'=>$pro_id))->setInc('pro_stock');
                $village_id = D('admin')->where(array('openid'=>$openid))->getField('village_id');
                if ($re) {
                    $pro_code = D('off_products')->where(array('pro_id'=>$pro_id))->getField('pro_code');
                    $data = array();
                    $data['borrower'] = $borrower;
                    $data['pro_code'] = $pro_code;
                    $data['trans_time'] = time();
                    $data['receive'] = 1;
                    $data['zone_id'] = $zone_id;
                    $data['village_id'] = $village_id;
                    $res = D('off_products_ercode')->where(array('pro_qrcode'=>$pro_qrcode))->save($data);
                    if ($res) {
                        $this->success('更新成功',U('Off/products_qr_detail',array('pro_qrcode'=>$pro_qrcode)));
                    } else {
                        $this->error('更新失败',U('Off/products_qr_detail_C',array('pro_qrcode'=>$pro_qrcode)));
                    }
                } else {
                    $this->error('更新失败',U('Off/products_qr_detail_C',array('pro_qrcode'=>$pro_qrcode)));
                }
            } else {
                $this->error('您没有操作权限');
            }            
        } else {

            //dump(strpos($_SERVER["QUERY_STRING"],'products_qr_detail'));
            $pro_qrcode = I('get.pro_qrcode');
            $receive = D('off_products_ercode')->where(array('pro_qrcode'=>$pro_qrcode))->getField('receive');
            // $village_id = D('off_products_ercode')->where(array('pro_qrcode'=>$pro_qrcode))->getField('village_id');
            $village_id = M('admin')->where(array('openid' => session('openid')))->find()['village_id'];
            if ($receive == 1) {
                $this->redirect(U('Off/products_qr_detail',array('pro_qrcode'=>$pro_qrcode)));
            }
            $typeArr = $this->get_type_all();
            $zoneArr = M('off_zone')->where(array('village_id'=>$village_id))->select();
            // var_dump($zoneArr);exit();
            $this->is_audit($village_id);
            $this->assign('village_id',$village_id);
            $this->assign('typeArr',$typeArr);
            $this->assign('zoneArr',$zoneArr);
            $this->assign('pro_qrcode',$pro_qrcode);
            $this->display();

        }


    }
    //历史记录页面控制器
    public function web_history_qrcode(){
        $id = I('get.id');
        $qrArr = D('off_products_ercode')->where(array('id'=>$id))->find();
        $pro_qrcode = $qrArr['pro_qrcode'];
        $transmitArr = D('off_transmit')->where(array('pro_qrcode'=>$pro_qrcode))->order('transmit_id asc')->select();
        if (!empty($transmitArr)) {
            foreach ($transmitArr as $k=>&$v) {
                if ($k == 0) {
                    $s_date = date('Y-m-d H:i:s',$v['zero_time']);
                    $e_date = date('Y-m-d H:i:s',$v['transmit_time']);
                } else {
                    $s_date = date('Y-m-d H:i:s',$transmitArr[$k-1]['transmit_time']);
                    $e_date = date('Y-m-d H:i:s',$v['transmit_time']);
                }
                $v['tt_name'] = $v['old_name'];
                $v['s_date'] = $s_date;
                $v['e_date'] = $e_date;
            }
            unset($v);
            $LastArr = end($transmitArr);
            $new_name = $LastArr['new_name'];
            $new_date = date('Y-m-d H:i:s',$LastArr['transmit_time']);

        } else {
            if ($qrArr['borrower']) {
                $new_name = $qrArr['borrower'];
                $new_date = date('Y-m-d H:i:s',$qrArr['trans_time']);
            } else {
                $this->assign('hello',1);
            }
        }

        if ($new_name) $this->assign('new_name',$new_name);
        if ($new_date) $this->assign('new_date',$new_date);

        $this->assign('pro_qrcode',$pro_qrcode);
        $this->assign('transmitArr',$transmitArr);
        $this->display();
    }

   /**
    *物品管理
    **/
    public function products_list(){

        //获取下拉框各项目的id和名称
        $model = new OffModel();
        $villageStr = $model->get_village_list();
        $villageArray = array();
        foreach ($villageStr as $k => $v) {
            $villageArray[$k]['village_id'] = $k;
            $villageArray[$k]['village_name'] = $v;
        }
        //获取各项目的物品总数量
        foreach ($villageArray as $k => &$v) {
            $r_num_v = D('off_products_ercode')->alias('e')
              ->join('left join __OFF_PRODUCTS__ p on p.pro_code = e.pro_code')
              ->where(array('p.is_del'=>0,'e.receive'=>1,'e.village_id'=>$v['village_id']))
              ->count();
            $villageArray[$k]['count'] = $r_num_v ? $r_num_v : 0;
            unset($v);
        }
        //筛选： 获取下拉框项目的id信息
        $villageId = $_GET['villageId'];
        if ($villageId) {
            $this->assign('villageId',$villageId);
            $map['e.village_id'] = array('eq',$villageId);
        }
        $map['p.is_del'] = array('eq',0);
        
        if ($_GET['type_id'] || $_GET['type_id'] === '0') $map['p.off_pro_type'] = array('eq',$_GET['type_id']);
        if($_GET['zone_id']) $map['p.zone_id']=$_GET['zone_id'];
        $offArr = D('off_products')->alias('p')
            ->field('p.*,t.type_name,t.pid,oz.zone_name')
            ->join('left join __OFF_TYPE__ t on t.id = p.off_pro_type')
            ->join('left join __OFF_ZONE__ oz on oz.id = p.zone_id')
            ->join('left join __OFF_PRODUCTS_ERCODE__ e on e.pro_code = p.pro_code')
            ->where($map)
            ->group('p.pro_name')
            ->order('p.pro_id desc')
            ->select();
        foreach ($offArr as &$v) {
            $pro_code = $v['pro_code'];                       
            $r_num = D('off_products_ercode')->where(array('receive'=>1,'pro_code'=>$pro_code))->count();    //每一类物品绑定的数量          
            $v['r_num'] = $r_num ? $r_num : 0;
            $Count += $r_num;  //所有物品的总数量
            //该项目每一类物品的数量
            $r_num_v = D('off_products_ercode')->where(array('receive'=>1,'pro_code'=>$pro_code,'village_id'=>$villageId))->count();            
            $v['r_num_v'] = $r_num_v ? $r_num_v : 0;
            $v['rate'] = round(($v['r_num_v']/$v['r_num'])*100,0); //各项目占每一类物品数量的比率  
            unset($v);                               
        }        

        //当筛选社区信息为空时，显示内容，但数量显示为0
        if ($villageId && $offArr == '') {        
            if ($_GET['type_id'] || $_GET['type_id'] === '0') $map['p.off_pro_type'] = array('eq',$_GET['type_id']);
            if($_GET['zone_id']) $map['p.zone_id']=$_GET['zone_id'];
            $offArr = D('off_products')->alias('p')
                ->field('p.*,t.type_name,t.pid,oz.zone_name')
                ->join('left join __OFF_TYPE__ t on t.id = p.off_pro_type')
                ->join('left join __OFF_ZONE__ oz on oz.id = p.zone_id')
                ->join('left join __OFF_PRODUCTS_ERCODE__ e on e.pro_code = p.pro_code')
                ->where(array('p.is_del'=>0))
                ->group('p.pro_name')
                ->order('p.pro_id desc')
                ->select();
            foreach ($offArr as &$v) {
                $pro_code = $v['pro_code'];
                //被领取数量           
                $r_num = D('off_products_ercode')->where(array('receive'=>1,'pro_code'=>$pro_code))->count();
                $v['r_num'] = $r_num?:0;
                $Count += $r_num;  //所有物品的总数量
                //查询各社区物品的使用情况
                $v['r_num_v'] = 0;
                $v['rate'] = 0;
                unset($v);                                    
            }
        }
        //各社区绑定物品的总数量占用率
        foreach ($villageArray as $k => $v) {
            $villageArray[$k]['rate'] = round(($villageArray[$k]['count']/$Count)*100,0);  
        }
        unset($villageArray['']);
        $this->assign('Count',$Count);
        $this->assign('offArr',$offArr);
        $this->assign('villageArray',$villageArray);
        $this->display();
    }

    /**
    *个人物品使用查询
    **/
    public function products_operate(){
        //获取搜索框人名
        $borrower = I('post.search_borrower');
        //获取搜索的人的village_id
        $village_id = D('admin')->where(array('realname'=>$borrower))->getField('village_id');
        if (!$village_id) {
            $village_id = D('house_village_user_bind')->where(array('name'=>$borrower))->getField('village_id');
        }
        if ($borrower) {
            $codeArr = D('off_products_ercode')->alias('er')
            ->field(array('er.*','p.pro_name','p.band','p.pro_price'))
            ->join('left join __OFF_PRODUCTS__ p on p.pro_code = er.pro_code')
            // ->join('left join __OFF_TYPE__ t on t.id=p.off_pro_type')
            ->where(array('p.is_del'=>0,'er.borrower'=>$borrower))
            ->group('p.pro_name')
            ->order('p.pro_id desc')
            ->select();
        }

        foreach ($codeArr as &$v) {
            $pro_code = $v['pro_code'];
            $v['num'] = D('off_products_ercode')->where(array('pro_code'=>$pro_code,'borrower'=>$borrower))->count(); //搜索人每一类物品的数量
            $num += $v['num'];  //搜索人物品的总数量
            $v['num_v'] = D('off_products_ercode')->where(array('pro_code'=>$pro_code,'village_id'=>$village_id))->count();  //项目每一类物品的数量
            //项目所有物品的总数量
            $Num = D('off_products_ercode')->alias('er')
              ->join('left join __OFF_PRODUCTS__ p on p.pro_code = er.pro_code')
              ->where(array('p.is_del'=>0,'er.receive'=>1,'er.village_id'=>$village_id))
              ->count();  
              unset($v);            
        }
        //物品的使用率
        $rate = round(($num/$Num)*100,0);

        $this->assign('borrower',$borrower);
        $this->assign('num',$num);
        $this->assign('Num',$Num);
        $this->assign('rate',$rate);
        $this->assign('codeArr',$codeArr);
        $this->display();
    }


    //得到物品信息
    public function get_pro_list() {
        $type_id = I('get.type_id');
        $village_id = I('get.village_id');
        $where=array('is_del'=>0,'off_pro_type'=>$type_id);
        if(!empty($village_id)){
            $where['village_id']=$village_id;
        }
        $proArr = D('off_products')->where($where)->select();
        $str = '<option value="0">请选择</option>';
        foreach ($proArr as $v) {
            $pro_name = $v['pro_name'];
            $pro_id = $v['pro_id'];
            $str .= "<option value='$pro_id'>$pro_name</option>";
        }
        echo $str;
    }
    //得到物品信息
    public function get_pro_one() {
        $pro_id = I('get.pro_id');
        $proArr = D('off_products')->where(array('pro_id'=>$pro_id))->find();
        $pro_name = $proArr['pro_name'];
        $pro_price = $proArr['pro_price'];
        $band = $proArr['band'];
        $pro_supplier = $proArr['pro_supplier'];
        $purch_time = date('Y-m-d',$proArr['purch_time']);
        $create_time = date('Y-m-d H:i:s',$proArr['create_time']);
        $str = '';
        $str .= "<div class=\"shtx_xm\">
            <div class=\"kkw\">物品名称&nbsp;:&nbsp;</div>
            <div class=\"shtx_kek\">$pro_name
            </div>
            <div class=\"both\"></div>
        </div>";

        $str .= "<div class=\"shtx_xm\">
            <div class=\"kkw\">物品单价&nbsp;:&nbsp;</div>
            <div class=\"shtx_kek\">$pro_price
            </div>
            <div class=\"both\"></div>
        </div>";

        $str .= "<div class=\"shtx_xm\">
            <div class=\"kkw\">物品品牌&nbsp;:&nbsp;</div>
            <div class=\"shtx_kek\">$band
            </div>
            <div class=\"both\"></div>
        </div>";

        $str .= "<div class=\"shtx_xm\">
            <div class=\"kkw\">采购日期&nbsp;:&nbsp;</div>
            <div class=\"shtx_kek\">$purch_time
            </div>
            <div class=\"both\"></div>
        </div>";


        $str .= "<div class=\"shtx_xm\">
            <div class=\"kkw\">物品供应商&nbsp;:&nbsp;</div>
            <div class=\"shtx_kek\">$pro_supplier
            </div>
            <div class=\"both\"></div>
        </div>";

        $str .= "<div class=\"shtx_xm\">
            <div class=\"kkw\">入库时间&nbsp;:&nbsp;</div>
            <div class=\"shtx_kek\">$create_time
            </div>
            <div class=\"both\"></div>
        </div>";

        echo $str;
    }
    //验证管理员权限
    public function is_audit($village_id=0){
        $where=array(
          'openid'=>$_SESSION['openid'],
            '_string' => 'find_in_set("81",role_id)',
        );
        if(!empty($village_id)){
            $where['village_id']=$village_id;
        }
        $role_id=M('admin')->where($where)->find();
        if ($role_id) {
            $this->assign('isOpen',1);
            return true;
        }else{
            return false;
        }
    }
    //获得分类方法
    public function get_type_all(){
        $typeArr = D('off_type')->where(array('pid'=>0,'is_del'=>0))->order('id asc')->select();
        foreach ($typeArr as $k => &$v) {
            $son = D('off_type')->where(array('pid'=>$v['id'],'is_del'=>0))->order('pid asc')->select();
            foreach ($son as $sk => &$sv) {
                $g_son = D('off_type')->where(array('pid'=>$sv['id'],'is_del'=>0))->order('pid asc')->select();
                $son[$sk]['g_son'] = $g_son;
            }
            $typeArr[$k]['son'] = $son;
        }
        unset($v);
        unset($sv);
        return $typeArr;
    }
    //重新定义成功操作 by zhukeqin
    public function success($success,$jumpUrl){
        $this->assign('success',$success);
        $this->assign('jumpUrl',$jumpUrl);
        $this->display('success');
    }
    //重新定义失败操作 by zhukeqin
    public function error($error,$jumpUrl){
        $this->assign('error',$error);
        $this->assign('jumpUrl',$jumpUrl);
        $this->display('error');
    }
    //测试用
    public function demo(){
        $this->success('成功！','www.baidu.com');
    }
}