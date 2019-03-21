<?php



/*

 * 后台管理基础类

 *

 */



class IndexAction extends BaseAction {

    public function index() {
        $this->display();

    }

    /**
     * O2O主页-- lv1 code
     * @author 陈琦
     * @update 祝君伟
     * @update-time 2017年11月30日10:43:33
     * 旧版主页
     */
    public function index_demo_new() {
        //dump($_SESSION);
        //获取从今天零点开始算的时间戳
        $begin_time=strtotime(date("Y-m-d"));   //当天开始时间
        $end_time=$begin_time+86400;    //当天结束时间
        if(session('system.account')==SUPER_ADMIN){
            $_map['is_show'] = 1;
            $_map['status'] = 1;
            $_map['auth_type'] = 4;
            $_map['auth_area'] = 0;
            $modelList = M('permission_menu')->where($_map)->order('`sort` DESC,`fid` ASC,`id` ASC')->select();
        }else{
            $O2O_role_idStr = M('admin')->where(array('id'=>$_SESSION['system']['id']))->getField('role_id');
            //多角色权限修改
            $O2O_role_idArr = explode(',',$O2O_role_idStr);
            $is_allowing_string = '';
            //角色权限遍历整合
            foreach ($O2O_role_idArr as $v) {
                $string = M('role')->where(array('role_id'=>$v))->getField('menus');
                $is_allowing_string .= $string.',';
            }
            $is_allowing_string = trim($is_allowing_string,',');

            //去重
            $is_allowing_stringArr = array_unique(explode(',',$is_allowing_string));

            $is_allowing_string = implode(',',$is_allowing_stringArr);
            $modelList = M()->query("select * from pigcms_permission_menu where id in ($is_allowing_string) and auth_type=4 and auth_area=0 and is_show=1 ORDER BY `sort` DESC,`fid` ASC,`id` ASC");
        }

        //$logic =  D('Dashboard','Logic');
        $logic =  Logic('dashboard');
        $index_box_array = $logic->index_dashboard_data();
        //dump($index_box_array);exit;
        $moeny_json=$this->make_moeny_json();
        //dump($moeny_json);exit;
        $num_json =$this->make_num_json();
        $month_add_json_arr1=$this->month_add_arr1();//每月新增用户数和订单数（大头仔）
        $month_add_json_arr2=$this->month_add_arr2();//每月新增用户数和订单数（一亩田）
        foreach ($modelList as $key=>$value){
            $argArray = unserialize($value['arguments']);
            foreach ($argArray as $kk=>$vv){
                if($vv['a_value'] ==''){
                    $referer ='&'.$argArray[0]['a_key'].'='.$begin_time.'&'.$argArray[1]['a_key'].'='.$end_time;
                }else{
                    $referer .='&'.$vv['a_key'].'='.$vv['a_value'];
                }
            }

            $modelList[$key]['url'] = U($modelList[$key]['module'].'/'.$modelList[$key]['controller'].'/'.$modelList[$key]['action']).$referer;
            $modelList[$key]['data_value'] = $index_box_array[$value['data_value']];
        }
        //vd($modelList);
//        dump($modelList);
//        exit;
//        dump($villageArr);exit;
//        $this->assign('villageArr',$villageArr);
        //业主数量以及认证业主数
        $village_id = filter_village(0, 2);
        $sum_user=M('house_village_user_bind')->where(array('village_id'=>$village_id))->count();
        $sum_bind=M('house_village_user_bind')->where(array('village_id'=>$village_id,'uid'=>array('neq','')))->count();
        $this->assign('sum_user',$sum_user);
        $this->assign('sum_bind',$sum_bind);
        $this->assign('modelList',$modelList);
        $this->assign('begin_time',$begin_time);
        $this->assign('end_time',$end_time);
        $this->assign('index_box_array',$index_box_array);
        $this->assign('moeny_json',$moeny_json);
        $this->assign('num_json',$num_json);
        $this->assign('month_add_json_arr1',$month_add_json_arr1);
        $this->assign('month_add_json_arr2',$month_add_json_arr2);
        $this->display();

    }

    /**
     * @author zhukeqin
     * 正式更新版
     */
    public function index_new() {
        $system_id = $_GET['system'];

        $this->assign('system_id',$system_id);


        //获取从今天零点开始算的时间戳
        $begin_time=strtotime(date("Y-m-d"));   //当天开始时间
        $end_time=$begin_time+86400;    //当天结束时间
        if(session('system.account')==SUPER_ADMIN){
            $_map['is_show'] = 1;
            $_map['status'] = 1;
            $_map['auth_type'] = 4;
            $_map['auth_area'] = 0;
            $modelList = M('permission_menu')->where($_map)->order('`sort` DESC,`fid` ASC,`id` ASC')->select();
        }else{
            $O2O_role_idStr = M('admin')->where(array('id'=>$_SESSION['system']['id']))->getField('role_id');
            //多角色权限修改
            $O2O_role_idArr = explode(',',$O2O_role_idStr);
            $is_allowing_string = '';
            //角色权限遍历整合
            foreach ($O2O_role_idArr as $v) {
                $string = M('role')->where(array('role_id'=>$v))->getField('menus');
                $is_allowing_string .= $string.',';
            }
            $is_allowing_string = trim($is_allowing_string,',');

            //去重
            $is_allowing_stringArr = array_unique(explode(',',$is_allowing_string));

            $is_allowing_string = implode(',',$is_allowing_stringArr);
            $modelList = M()->query("select * from pigcms_permission_menu where id in ($is_allowing_string) and auth_type=4 and auth_area=0 and is_show=1 ORDER BY `sort` DESC,`fid` ASC,`id` ASC");
        }
        $modelList_id=array_map(function ($val){return $val['id'];},$modelList);//取出菜单id值
        //获取顶部条目
        $top_list=M('permission_menu')->where(array('id'=>array('IN',$modelList_id),'arguments'=>array('LIKE','%is_top%'),'fid'=>0))->select();
        foreach ($top_list as $key=>$value){
            $top_list[$key]['list']=M('permission_menu')->where(array('id'=>array('IN',$modelList_id),'fid'=>$value['id']))->select();
            $top_list[$key]['argument']=$this->arguments($value['arguments']);
            foreach ($top_list[$key]['list'] as $key1=>$value1){
                $top_list[$key]['list'][$key1]['argument']=$this->arguments($value1['arguments']);
                $sql=$top_list[$key]['list'][$key1]['argument']['sql'];
                if(!empty($sql)){
                    $top_list[$key]['list'][$key1]['data']=$this->action_sql($sql);
                }
                unset($sql);
                unset($arguments);
            }
            $top_list[$key]['ids']=json_encode(array_map(function ($val){return $val['id'];},$top_list[$key]['list']));
            //查询是否是快捷入口
            if($top_list[$key]['argument']['is_top']==2){
                $quick_list=$top_list[$key];
                unset($top_list[$key]);
            }
        }
        //获取非顶部条目
        $menu_list=M('permission_menu')->where(array('id'=>array('IN',$modelList_id),'arguments'=>array('NOTLIKE','%is_top%'),'fid'=>0))->select();
        foreach ($menu_list as $key=>$value){
            $menu_list[$key]['list']=M('permission_menu')->where(array('id'=>array('IN',$modelList_id),'fid'=>$value['id']))->select();
            //获取参数信息
                $menu_list[$key]['argument']=$this->arguments($value['arguments']);
            if(empty($menu_list[$key]['list'])){
                unset($menu_list[$key]);
                continue;
            }
            foreach ($menu_list[$key]['list'] as $key1=>$value1){
                    $menu_list[$key]['list'][$key1]['argument']=$this->arguments($value1['arguments']);
                    /*$sql=$menu_list[$key]['list'][$key1]['argument']['sql'];
                    if(!empty($sql)){
                        $menu_list[$key]['list'][$key1]['data']=$this->action_sql($sql);
                    }*/
                unset($sql);
                unset($arguments);
            }
            unset($sql);
            unset($arguments);
            $menu_list[$key]['ids']=json_encode(array_map(function ($val){return $val['id'];},$menu_list[$key]['list']));
        }
        $this->assign('top_list',$top_list);
        $this->assign('quick_list',$quick_list);
        $this->assign('menu_list',$menu_list);
        $this->assign('modelList',$modelList);
        $this->assign('begin_time',$begin_time);
        $this->assign('end_time',$end_time);
        $this->display();

    }
    public function arguments($arguments){
        $arguments=unserialize($arguments);
        $return=array();
        foreach ($arguments as $key2=>$value2){
            $return[$value2['a_key']]=htmlspecialchars_decode($value2['a_value']);
        }
        return $return;
    }
    public function action_sql($sql){
        $village_id=filter_village(0, 2);
        $project_id=$_SESSION['project_id'];
        $sql=str_replace('{village_id}',$village_id,$sql);
        if(empty($project_id)){
            $sql=str_replace('vp.project_id={project_id}','',$sql);
            $sql=str_replace('left join pigcms_house_village_project vp on vp.village_id=v.village_id','',$sql);
        }else{
            $sql=str_replace('{project_id}',$project_id,$sql);
        }
        $reutrn=array_shift(M()->query($sql)['0']);
        return $reutrn;

    }

    /*
     * 本周和本月收款金额ajax异步请求数据
     * 陈琦
     * 2017.3.23
     */
    public function get_data(){
        $begin_time=$_POST['begin_time'];
        //$end_time=$_POST['end_time'];
        $v=$_POST['v'];
        for($i=$v-1;$i>=0;$i--){
            $showTime = $begin_time-($i*24*3600);
            $week = date("m-d",$showTime);
            $showTime_end = $showTime+86400;
            $today_money1=M()->query('SELECT SUM(goods_price)FROM pigcms_cashier_order as ordr where  ordr.mid=122 and ordr.ispay=1 AND ordr.refund!=2 AND ordr.add_time>='.$showTime.' AND ordr.paytime <='.$showTime_end);
            $today_money2=M()->query('SELECT SUM(goods_price)FROM pigcms_cashier_order as ordr where  ordr.mid=28 and ordr.ispay=1 AND ordr.refund!=2 AND ordr.add_time>='.$showTime.' AND ordr.paytime <='.$showTime_end);
            $today_money1[0]['SUM(goods_price)']=$today_money1[0]['SUM(goods_price)']?$today_money1[0]['SUM(goods_price)']:0;
            $today_money2[0]['SUM(goods_price)']=$today_money2[0]['SUM(goods_price)']?$today_money2[0]['SUM(goods_price)']:0;
            $table_array[]=array(
                'date'=>$week,
                'pf'=>$today_money1[0]['SUM(goods_price)'],
                'gf'=>$today_money2[0]['SUM(goods_price)'],
            );
        }
        //$table_json_array = json_encode($table_array);
        echo json_encode(array('msg'=>$table_array));

    }


    /*
    * 本季度和近半年收款金额ajax异步请求数据
    * 陈琦
    * 2017.3.23
    */
    public function get_year_data(){
        $begin_time=strtotime(date('Y-m'));
        $v=$_POST['v'];
        for($i=$v-1;$i>=0;$i--){
            $showTime = strtotime("-".$i." month", $begin_time);//那个月的月初时间
            $week = date("m",$showTime);
            $showTime_end = strtotime("+1 month",$showTime)-1;//那个月月末时间
            $today_money1=M()->query('SELECT SUM(goods_price)FROM pigcms_cashier_order as ordr where  ordr.mid=122 and ordr.ispay=1 AND ordr.refund!=2 AND ordr.add_time>='.$showTime.' AND ordr.paytime <='.$showTime_end);
            $today_money2=M()->query('SELECT SUM(goods_price)FROM pigcms_cashier_order as ordr where  ordr.mid=28 and ordr.ispay=1 AND ordr.refund!=2 AND ordr.add_time>='.$showTime.' AND ordr.paytime <='.$showTime_end);
            $today_money1[0]['SUM(goods_price)']=$today_money1[0]['SUM(goods_price)']?$today_money1[0]['SUM(goods_price)']:0;
            $today_money2[0]['SUM(goods_price)']=$today_money2[0]['SUM(goods_price)']?$today_money2[0]['SUM(goods_price)']:0;
            $table_array[]=array(
                'date'=>$week,
                'pf'=>$today_money1[0]['SUM(goods_price)'],
                'gf'=>$today_money2[0]['SUM(goods_price)'],
            );
        }
        //$table_json_array = json_encode($table_array);
        echo json_encode(array('msg'=>$table_array));

    }
    public function index_news() {
        //dump($_SESSION);
        //获取从今天零点开始算的时间戳
        $y=date("Y");
        $m=date("m");
        $d=date("d");
        $todayTime= mktime(0,0,0,$m,$d,$y);
        $end_today_time = $todayTime+86400;
        $now = time();
        $yday = $todayTime-24*3600;
        $zday = $todayTime-7*24*3600;
        $mday = $todayTime-30*24*3600;
        $access_openOne=M();
        $sql_one="select count(DISTINCT pigcms_id) as daynum from pigcms_access_control_user_log where opdate>=$todayTime and opdate<=$end_today_time";
        $access_openOne_result = $access_openOne->query($sql_one);
        $sql_two="select count(*) as daynum from pigcms_access_control_user_log where opdate>=$todayTime and opdate<=$end_today_time";
        $access_openTwo_result = $access_openOne->query($sql_two);
        $sqlStr2="SELECT count(*) as num FROM pigcms_cashier_order as ordr where  ordr.ispay=1 AND ordr.refund!=2 AND ordr.add_time>=$todayTime AND ordr.paytime <=$end_today_time";
        $allarr = $access_openOne->query($sqlStr2);//总笔数
        $sqlStr3='SELECT SUM(goods_price)FROM pigcms_cashier_order as ordr where  ordr.ispay=1 AND ordr.refund!=2 AND ordr.add_time>='.$todayTime.' AND ordr.paytime <='.$end_today_time;
        $dayarr = $access_openOne->query($sqlStr3);//当天
        $index_box_array =array(
            'openDoor_peopel'=>$access_openOne_result[0]['daynum'],
            'openDoor_num'=>$access_openTwo_result[0]['daynum'],
            'today_money'=>$dayarr[0]['SUM(goods_price)'],
            'today_total_mun'=>$allarr[0]['num']
        );
        //dump($index_box_array);exit;
        $moeny_json=$this->make_moeny_json();
        $num_json =$this->make_num_json();
        $this->assign('index_box_array',$index_box_array);
        $this->assign('moeny_json',$moeny_json);
        $this->assign('num_json',$num_json);
        $this->display();

    }


    /*
     * 主页图表提供数据方法(钱数)
     * @author 祝君伟
     * @time2017.3.10
     * */
    public function make_moeny_json(){
        $y=date("Y");
        $m=date("m");
        $d=date("d");
        $todayTime= mktime(0,0,0,$m,$d,$y);
        for($i=6;$i>=0;$i--){
            $showTime = $todayTime-($i*24*3600);
            $week = date("m-d",$showTime);
            $showTime_end = $showTime+86400;
            $today_money1=M()->query('SELECT SUM(goods_price)FROM pigcms_cashier_order as ordr where  ordr.mid=122 and ordr.ispay=1 AND ordr.refund!=2 AND ordr.add_time>='.$showTime.' AND ordr.paytime <='.$showTime_end);
            $today_money2=M()->query('SELECT SUM(goods_price)FROM pigcms_cashier_order as ordr where  ordr.mid=28 and ordr.ispay=1 AND ordr.refund!=2 AND ordr.add_time>='.$showTime.' AND ordr.paytime <='.$showTime_end);
            $today_money1[0]['SUM(goods_price)']=$today_money1[0]['SUM(goods_price)']?$today_money1[0]['SUM(goods_price)']:0;
            $today_money2[0]['SUM(goods_price)']=$today_money2[0]['SUM(goods_price)']?$today_money2[0]['SUM(goods_price)']:0;
            $table_array[]=array(
                'date'=>$week,
                'pf'=>$today_money1[0]['SUM(goods_price)'],
                'gf'=>$today_money2[0]['SUM(goods_price)'],
            );
        }
//        foreach ($table_array as &$value){
//            if($value['count']==null){
//                $value['count']=0;
//            }
//        }
//        unset($value);
        $table_json_array = json_encode($table_array);
        return $table_json_array;
    }

    /*
     * 主页图表提供数据方法(笔数)
     * @author 祝君伟
     * @time2017.3.10
     * */
    public function make_num_json(){
        $y=date("Y");
        $m=date("m");
        $d=date("d");
        $todayTime= mktime(0,0,0,$m,$d,$y);
        for($i=6;$i>=0;$i--){
            $showTime = $todayTime-($i*24*3600);
            $week = date("m-d",$showTime);
            $showTime_end = $showTime+86400;
            $today_money1=M()->query("SELECT count(*) as num FROM pigcms_cashier_order as ordr where  ordr.mid=122 and ordr.ispay=1 AND ordr.refund!=2 AND ordr.add_time>=$showTime AND ordr.paytime <=$showTime_end");
            $today_money2=M()->query("SELECT count(*) as num FROM pigcms_cashier_order as ordr where  ordr.mid=28 and ordr.ispay=1 AND ordr.refund!=2 AND ordr.add_time>=$showTime AND ordr.paytime <=$showTime_end");
            $table_array[]=array(
                'date'=>$week,
                'pf'=>$today_money1[0]['num'],
                'gf'=>$today_money2[0]['num']
            );
        }
        $table_json_array = json_encode($table_array);
        return $table_json_array;
    }


    /*
     * 本周和本月收款笔数ajax异步请求数据
     * 陈琦
     * 2017.3.24
     */
    public function get_count(){
        $begin_time=$_POST['begin_time'];
        $v=$_POST['v'];
        for($i=$v-1;$i>=0;$i--){
            $showTime = $begin_time-($i*24*3600);
            $week = date("m-d",$showTime);
            $showTime_end = $showTime+86400;
            $today_money1=M()->query("SELECT count(*) as num FROM pigcms_cashier_order as ordr where  ordr.mid=122 and ordr.ispay=1 AND ordr.refund!=2 AND ordr.add_time>=$showTime AND ordr.paytime <=$showTime_end");
            $today_money2=M()->query("SELECT count(*) as num FROM pigcms_cashier_order as ordr where  ordr.mid=28 and ordr.ispay=1 AND ordr.refund!=2 AND ordr.add_time>=$showTime AND ordr.paytime <=$showTime_end");
            $table_array[]=array(
                'date'=>$week,
                'pf'=>$today_money1[0]['num'],
                'gf'=>$today_money2[0]['num']
            );
        }
        echo json_encode(array('msg'=>$table_array));
    }


    /*
    * 本季度和近半年收款笔数ajax异步请求数据
    * 陈琦
    * 2017.3.24
    */
    public function get_year_count(){
        $begin_time=strtotime(date('Y-m'));
        $v=$_POST['v'];
        for($i=$v-1;$i>=0;$i--){
            $showTime = strtotime("-".$i." month", $begin_time);//那个月的月初时间
            $week = date("m",$showTime);
            $showTime_end = strtotime("+1 month",$showTime)-1;//那个月月末时间
            $today_money1=M()->query("SELECT count(*) as num FROM pigcms_cashier_order as ordr where  ordr.mid=122 and ordr.ispay=1 AND ordr.refund!=2 AND ordr.add_time>=$showTime AND ordr.paytime <=$showTime_end");
            $today_money2=M()->query("SELECT count(*) as num FROM pigcms_cashier_order as ordr where  ordr.mid=28 and ordr.ispay=1 AND ordr.refund!=2 AND ordr.add_time>=$showTime AND ordr.paytime <=$showTime_end");
            $table_array[]=array(
                'date'=>$week,
                'pf'=>$today_money1[0]['num'],
                'gf'=>$today_money2[0]['num']
            );
        }
        echo json_encode(array('msg'=>$table_array));
    }



    /*
     * 每月新增用户数和订单数(大头仔)
     * 陈琦
     * 2017.4.10
     */
    public function month_add_arr1(){
        $todayTime=strtotime(date('Y-m'));//本月初时间
        for($i=5;$i>=0;$i--){
            $showTime = strtotime("-".$i." month", $todayTime);//那个月的月初时间
            $week = date("m",$showTime);
            $showTime_end = strtotime("+1 month",$showTime)-1;//那个月月末时间
            $usernum_add=M()->query("select count(a.id) as num from pigcms_cashier_fans as a where a.mid=28 and a.add_time>".$showTime." and a.add_time<".$showTime_end);//新增用户
            $ordernum_add=M()->query("select count(a.id) as num from pigcms_cashier_order as a left join pigcms_cashier_fans as b on a.openid=b.openid and a.mid=b.mid where a.mid=28 and a.ispay=1 and a.add_time>".$showTime." and a.add_time<".$showTime_end." and b.add_time>".$showTime." and b.add_time<".$showTime_end);//新增订单数
            $table_array[]=array(
                'date'=>$week,
                'one'=>$usernum_add[0]['num'],
                'two'=>$ordernum_add[0]['num']
            );
        }
        $result=json_encode($table_array);
        return $result;
    }



    /*
     * 每月新增用户数和订单数(一亩田)
     * 陈琦
     * 2017.4.10
     */
    public function month_add_arr2(){
        $todayTime=strtotime(date('Y-m'));//本月初时间
        for($i=5;$i>=0;$i--){
            $showTime = strtotime("-".$i." month", $todayTime);//那个月的月初时间
            $week = date("m",$showTime);
            $showTime_end = strtotime("+1 month",$showTime)-1;//那个月月末时间
            $usernum_add=M()->query("select count(a.id) as num from pigcms_cashier_fans as a where a.mid=122 and a.add_time>".$showTime." and a.add_time<".$showTime_end);//新增用户
            $ordernum_add=M()->query("select count(a.id) as num from pigcms_cashier_order as a left join pigcms_cashier_fans as b on a.openid=b.openid and a.mid=b.mid where a.mid=122 and a.ispay=1 and a.add_time>".$showTime." and a.add_time<".$showTime_end." and b.add_time>".$showTime." and b.add_time<".$showTime_end);//新增订单数
            $table_array[]=array(
                'date'=>$week,
                'one'=>$usernum_add[0]['num'],
                'two'=>$ordernum_add[0]['num']
            );
        }
        $result=json_encode($table_array);
        return $result;
    }



    /*
     * 大头仔商户根据年份请求数据统计（每月新增用户；每月新增订单数）
     * 陈琦.
     * 2017.4.10
     */
    public function year_add_arr1(){
        for($i=1;$i<=12;$i++){
            if($_POST['v']==1){//去年
                $showTime=strtotime('-1 year',strtotime(date('Y-'.$i)));
                $week = date("m",$showTime);
                $showTime_end=strtotime("+1 month",$showTime)-1;//那个月月末时间
            }else{
                $showTime = strtotime(date('Y-'.$i));//那个月月初时间
                $week = date("m",$showTime);
                $showTime_end = strtotime("+1 month",$showTime)-1;//那个月月末时间
            }
            $usernum_add=M()->query("select count(a.id) as num from pigcms_cashier_fans as a where a.mid=28 and a.add_time>".$showTime." and a.add_time<".$showTime_end);//新增用户
            $ordernum_add=M()->query("select count(a.id) as num from pigcms_cashier_order as a left join pigcms_cashier_fans as b on a.openid=b.openid and a.mid=b.mid where a.mid=28 and a.ispay=1 and a.add_time>".$showTime." and a.add_time<".$showTime_end." and b.add_time>".$showTime." and b.add_time<".$showTime_end);//新增订单数
            $table_array[]=array(
                'date'=>$week,
                'one'=>$usernum_add[0]['num'],
                'two'=>$ordernum_add[0]['num']
            );
        }
        echo json_encode(array('msg'=>$table_array));
    }



    /*
     * 一亩田商户根据年份请求数据统计（每月新增用户；每月新增订单数）
     * 陈琦.
     * 2017.4.10
     */
    public function year_add_arr2(){
        for($i=1;$i<=12;$i++){
            if($_POST['v']==1){//去年
                $showTime=strtotime('-1 year',strtotime(date('Y-'.$i)));
                $week = date("m",$showTime);
                $showTime_end=strtotime("+1 month",$showTime)-1;//那个月月末时间
            }else{
                $showTime = strtotime(date('Y-'.$i));//那个月月初时间
                $week = date("m",$showTime);
                $showTime_end = strtotime("+1 month",$showTime)-1;//那个月月末时间
            }
            $usernum_add=M()->query("select count(a.id) as num from pigcms_cashier_fans as a where a.mid=122 and a.add_time>".$showTime." and a.add_time<".$showTime_end);//新增用户
            $ordernum_add=M()->query("select count(a.id) as num from pigcms_cashier_order as a left join pigcms_cashier_fans as b on a.openid=b.openid and a.mid=b.mid where a.mid=122 and a.ispay=1 and a.add_time>".$showTime." and a.add_time<".$showTime_end." and b.add_time>".$showTime." and b.add_time<".$showTime_end);//新增订单数
            $table_array[]=array(
                'date'=>$week,
                'one'=>$usernum_add[0]['num'],
                'two'=>$ordernum_add[0]['num']
            );
        }
        echo json_encode(array('msg'=>$table_array));
    }



    public function main() {

        if ($this->system_session['area_id']) {

            $this->redirect(U('Index/profile'));

        }

        $server_info = array(

            '运行环境' => PHP_OS . ' ' . $_SERVER["SERVER_SOFTWARE"],

            'PHP运行方式' => php_sapi_name(),

            'MYSQL版本' => mysql_get_client_info(),

            '上传附件限制' => ini_get('upload_max_filesize'),

            '执行时间限制' => ini_get('max_execution_time') . '秒',

            '磁盘剩余空间 ' => round((@disk_free_space(".") / (1024 * 1024)), 2) . 'M',

        );

        $this->assign('server_info', $server_info);



        //网站统计

        $pigcms_assign['website_user_count'] = M('User')->count();

        $pigcms_assign['website_merchant_count'] = M('Merchant')->count();

        $pigcms_assign['website_merchant_store_count'] = M('Merchant_store')->count();

        //团购统计

        $pigcms_assign['group_group_count'] = M('Group')->count();

        $pigcms_assign['group_today_order_count'] = D('Group_order')->get_all_oreder_count('day');

        $pigcms_assign['group_week_order_count'] = D('Group_order')->get_all_oreder_count('week');

        $pigcms_assign['group_month_order_count'] = D('Group_order')->get_all_oreder_count('month');

        $pigcms_assign['group_year_order_count'] = D('Group_order')->get_all_oreder_count('year');

        //订餐统计

        $pigcms_assign['meal_store_count'] = M('Merchant_store_meal')->count();

        $pigcms_assign['meal_today_order_count'] = D('Meal_order')->get_all_oreder_count('day');

        $pigcms_assign['meal_week_order_count'] = D('Meal_order')->get_all_oreder_count('week');

        $pigcms_assign['meal_month_order_count'] = D('Meal_order')->get_all_oreder_count('month');

        $pigcms_assign['meal_year_order_count'] = D('Meal_order')->get_all_oreder_count('year');





        //商家待审核

        // $pigcms_assign['merchant_verify_list'] = D('Merchant')->where(array('status'=>'2','reg_time'=>array('gt',$this->system_session['last_time'])))->select();

        if ($this->system_session['area_id']) {

        	$area_index = $this->system_session['level'] == 1 ? 'area_id' : 'city_id';

            $pigcms_assign['merchant_verify_count'] = D('Merchant')->where(array('status' => '2', $area_index => $this->system_session['area_id']))->count();

            //店铺待审核

            // $pigcms_assign['merchant_verify_store_list'] = D('Merchant_store')->where(array('status'=>'2','last_time'=>array('gt',$this->system_session['last_time'])))->select();

            $pigcms_assign['merchant_verify_store_count'] = D('Merchant_store')->where(array('status' => 2, $area_index => $this->system_session['area_id']))->count();

            //团购待审核

            // $pigcms_assign['group_verify_list'] = D('Group')->where(array('status'=>'2','last_time'=>array('gt',$this->system_session['last_time'])))->select();

            $merchants = D('Merchant')->field('mer_id')->where(array('status' => '1', $area_index => $this->system_session['area_id']))->select();

            $mer_ids = array();

            foreach ($merchants as $m) {

                if (!in_array($m['mer_id'], $mer_ids))

                    $mer_ids[] = $m['mer_id'];

            }



            $pigcms_assign['group_verify_count'] = 0;

            if ($mer_ids) {

                $pigcms_assign['group_verify_count'] = D('Group')->where(array('status' => '2', 'mer_id' => array('in', $mer_ids)))->count();

            }

        } else {

            $pigcms_assign['merchant_verify_count'] = D('Merchant')->where(array('status' => '2'))->count();

            //店铺待审核

            // $pigcms_assign['merchant_verify_store_list'] = D('Merchant_store')->where(array('status'=>'2','last_time'=>array('gt',$this->system_session['last_time'])))->select();

            $pigcms_assign['merchant_verify_store_count'] = D('Merchant_store')->where(array('status' => 2))->count();

            //团购待审核

            // $pigcms_assign['group_verify_list'] = D('Group')->where(array('status'=>'2','last_time'=>array('gt',$this->system_session['last_time'])))->select();

            $pigcms_assign['group_verify_count'] = D('Group')->where(array('status' => '2'))->count();

        }

        $this->assign($pigcms_assign);

        $this->display();

    }



    public function pass() {

        $this->display();

    }
    public function pass_news() {

        $this->display();

    }



    public function amend_pass() {

        $old_pass = $this->_post('old_pass');

        $new_pass = $this->_post('new_pass');

        $re_pass = $this->_post('re_pass');

        if ($old_pass == '') {

            $this->error('请填写旧密码！');

        } else if ($new_pass != $re_pass) {

            $this->error('两次新密码填写不一致！');

        } else if ($old_pass == $new_pass) {

            $this->error('新旧密码不能一样！');

        }



        $database_admin = D('Admin');

        $condition_admin['id'] = $this->system_session['id'];

        $admin = $database_admin->field('`id`,`pwd`')->where($condition_admin)->find();

        if ($admin['pwd'] != md5($old_pass)) {

            $this->error('旧密码错误！');

        } else {

            $data_admin['id'] = $admin['id'];

            $data_admin['pwd'] = md5($new_pass);

            if ($database_admin->data($data_admin)->save()) {

                $this->success('密码修改成功！');

            } else {

                $this->error('密码修改失败！请重试。');

            }

        }

    }
    public function amend_pass_new() {

        $old_pass = $this->_post('old_pass');

        $new_pass = $this->_post('new_pass');

        $re_pass = $this->_post('re_pass');

        if ($old_pass == '') {

            $this->error('请填写旧密码！');

        } else if ($new_pass != $re_pass) {

            $this->error('两次新密码填写不一致！');

        } else if ($old_pass == $new_pass) {

            $this->error('新旧密码不能一样！');

        }



        $database_admin = D('Admin');

        $condition_admin['id'] = $this->system_session['id'];

        $admin = $database_admin->field('`id`,`pwd`')->where($condition_admin)->find();

        if ($admin['pwd'] != md5($old_pass)) {

            $this->error('旧密码错误！');

        } else {

            $data_admin['id'] = $admin['id'];

            $data_admin['pwd'] = md5($new_pass);

            if ($database_admin->data($data_admin)->save()) {

                $this->success('密码修改成功！');

            } else {

                $this->error('密码修改失败！请重试。');

            }

        }

    }



    public function profile() {

        $database_admin = D('Admin');

        $condition_admin['id'] = $this->system_session['id'];

        $admin = $database_admin->where($condition_admin)->find();

        $this->assign('admin', $admin);

        $this->display();

    }

    /**
     * 个人主页
     */
    public function profile_news() {

        $AdminLogic = Logic('admin');

        $admin = $AdminLogic->getAdminInfo();

        $list = $AdminLogic->getThingList();

        if(session('system.account')==SUPER_ADMIN) $warningList = $AdminLogic->getSystemWarn();$this->assign('warningList', $warningList);


        $this->assign('admin', $admin);

        $this->assign('list', $list);

        //vd($list);exit;

        $this->display();

    }


    /**
     * 编辑后台人员信息
     */
    public function edit_admin_info(){

        if(IS_POST)
        {
          $data = D('admin')->create();

          $res = M('admin')->save($data);

          if($res)
          {
              $this->success('修改成功',U('profile_news'));
          }
          else
          {
              $this->error('修改失败',U('profile_news'));
          }
        }
        else
        {

            $AdminLogic = Logic('admin');

            $admin = $AdminLogic->getAdminInfo();

            $this->assign('admin', $admin);

            $this->display();

        }


    }

    /**
     * 锁屏
     */
    public function lock_system(){
        if(IS_POST){

            $id = I('post.id');

            $pwd = I('post.password');

            $thisPwd = M('admin')->find($id)['pwd'];

            if($thisPwd == md5($pwd)) $this->redirect('Index/profile_news');else $this->redirect('Index/lock_system');

        }else{
            $AdminLogic = Logic('admin');

            $admin = $AdminLogic->getAdminInfo();

            $this->assign('admin', $admin);

            $this->display();
        }
    }

    /**
     * 修改头像
     */
    public function upload_head_img(){

        if(IS_POST){

            import("ORG.Net.UploadFile");

            $upload = new UploadFile();



            $upload->maxSize = 5*1024*1024 ;

            $upload->allowExts = array('jpg','jpeg','png','gif');

            $upload->allowTypes = array('image/png','image/jpg','image/jpeg','image/gif');

            $upload_dir = "./upload/cardfocus/headimage/".date('Y').'/';

            if(!is_dir($upload_dir)){

                mkdir($upload_dir,0777,true);

            }



            $upload->savePath =  $upload_dir;// 设置附件上传目录



            if (!$upload->upload()) {// 上传错误提示错误信息

                $msg = $upload->getErrorMsg();

                $this->error($msg,U('profile_news'));

            } else {// 上传成功 获取上传文件信息

                $error = 0;

                $msg = $upload->getUploadFileInfo();
                //vd($msg);exit;

                $res = M('admin')->where(array('id'=>session('system.id')))->save(array('headimgurl'=>$msg[0]['savename']));

                $this->success('上传成功',U('profile_news'));

            }




        }else{
            $this->display();
        }



    }



    public function amend_profile() {

        $database_admin = D('Admin');

        $data_admin['id'] = $this->system_session['id'];

        $data_admin['realname'] = $this->_post('realname');

        $data_admin['email'] = $this->_post('email');

        $data_admin['qq'] = $this->_post('qq');

        $data_admin['phone'] = $this->_post('phone');

        if ($database_admin->data($data_admin)->save()) {

            $this->success('资料修改成功！');

        } else {


            $this->error('资料修改失败！请检查是否有修改内容后再重试。');
        }

    }

    public function amend_profile_new() {




        $database_admin = D('Admin');

        $data_admin['id'] = $this->system_session['id'];

        $data_admin['realname'] = I('post.realname');

        $data_admin['email'] =I('post.email');

        $data_admin['qq'] = I('post.qq');

        $data_admin['phone'] =I('post.phone') ;

        if ($database_admin->data($data_admin)->save()) {

            $this->success('资料修改成功！');

        } else {

            $this->error('资料修改失败！请检查是否有修改内容后再重试。');

        }

    }



    public function cache() {

        import('ORG.Util.Dir');
        if(is_writable('./upload/system/')) {
			Dir::copyDir('./runtime','./upload/system/'); 
		} 
        Dir::delDirnotself('./runtime');

        $this->frame_main_ok_tips('清除缓存成功！');

    }



    public function menu() {

        $this->assign('bg_color', '#F3F3F3');



        $database = D('Admin');

        $condition['id'] = intval($_GET['admin_id']);

        $admin = $database->field(true)->where($condition)->find();

        if (empty($admin)) {

            $this->frame_error_tips('数据库中没有查询到该管理员的信息！');

        }

        $admin['menus'] = explode(',', $admin['menus']);

        //dump($admin);

        $this->assign('admin', $admin);



        $menus = D('System_menu')->where(array('show' => 1, 'status' => 1))->select();

        $list = array();

        foreach ($menus as $menu) {

            if (empty($menu['fid'])) {

                if (isset($list[$menu['id']])) {

                    $list[$menu['id']] = array_merge($list[$menu['id']], $menu);

                } else {

                    $list[$menu['id']] = $menu;

                }

            } else {

                if (isset($list[$menu['fid']])) {

                    $list[$menu['fid']]['lists'][] = $menu;

                } else {

                    $list[$menu['fid']]['lists'] = array($menu);

                }

            }

        }
        //加入car后台角色管理修改于2017.3.13
        $car_role_array = D('')->table('smart_role')->select();
        $this->assign('car_role_array', $car_role_array);

        $this->assign('menus', $list);

        //dump($list);

        $this->display();

    }



    public function savemenu() {
        //dump($_POST);exit;

        if (IS_POST) {

            $admin_id = isset($_POST['admin_id']) ? intval($_POST['admin_id']) : 0;

            $menus = isset($_POST['menus']) ? $_POST['menus'] : '';

            $car_role_id=isset($_POST['car_role_id'])?$_POST['car_role_id']:'';

            $menus = implode(',', $menus);

            $database = D('Admin');
            $database->where(array('id' => $admin_id))->save(array('menus' => $menus,'car_role_id'=>$car_role_id));

            $this->success('全部设置成功！');

        } else {

            $this->error('非法提交,请重新提交~');

        }

    }



    public function account() {

// 		import('ORG.Net.IpLocation');

// 		$IpLocation = new IpLocation();

        $admins = D('Admin')->field(true)->where("level<>2")->select();

// 		foreach($admins as &$value){

// 			$last_location = $IpLocation->getlocation(long2ip($value['last_ip']));

// 			$value['last_ip_txt'] = iconv('GBK','UTF-8',$last_location['country']);

// 		}

        $this->assign('admins', $admins);

        $this->display();

    }

    public function account_news() {

// 		import('ORG.Net.IpLocation');

// 		$IpLocation = new IpLocation();
        $field = array(
            'a.*',
            'c.company_name',
            'v.village_name',
            'r.role_name',
            'm.name'
        );

        $admins = D('Admin')
            ->alias('a')
            ->field($field)
            ->join('LEFT JOIN pigcms_company c on a.company_id=c.company_id')
            ->join('LEFT JOIN pigcms_house_village v on a.village_id=v.village_id')
            ->join('LEFT JOIN pigcms_role r on a.role_id=r.role_id')
            ->join('LEFT JOIN pigcms_merchant m on a.mer_id=m.mer_id')
            ->where("level<>2")
            ->select();

// 		foreach($admins as &$value){

// 			$last_location = $IpLocation->getlocation(long2ip($value['last_ip']));

// 			$value['last_ip_txt'] = iconv('GBK','UTF-8',$last_location['country']);

// 		}
        //dump($admins);
        $this->assign('admins', $admins);

        $this->display();

    }



    public function admin() {

        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        $admin = D('Admin')->field(true)->where(array('id' => $id))->find();

        $this->assign('admin', $admin);

        $this->assign('bg_color', '#F3F3F3');

        $this->display();

    }
    public function admin_new() {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        $admin = D('Admin')->field(true)->where(array('id' => $id))->find();
        if($admin['openid']){
            $admin['nickname'] = M('user')->where('openid="%s"',$admin['openid'])->getField('nickname');
        }
        //全公司
        if($id){
            $admin_village_id = M('admin')->where(array('id'=>$id))->getField('village_id');
            $company_array = M('company')->where(array('village_id'=>$admin_village_id))->select();
        }else{
            $company_array = M('company')->select();
        }

        //项目下所属商户
        if($id){
            $admin_village_id = M('admin')->where(array('id'=>$id))->getField('village_id');
            $merchant_array = M('merchant')->where(array('village_id'=>$admin_village_id))->select();
        }else{
            $merchant_array = M('merchant')->select();
        }

        //dump($company_array);

        //全社区
        $village_array = M('house_village')->where(array('status'=>1))->select();

        //全角色
        $role_array = M('role')->select();


        $this->assign('merchant_array', $merchant_array);

        $this->assign('company_array', $company_array);

        $this->assign('village_array', $village_array);

        $this->assign('role_array', $role_array);

        $this->assign('admin', $admin);

        $this->assign('bg_color', '#F3F3F3');

        $this->display();

    }

    /*
    * 自动完成提供数据方法
    * */
    public function ajax_to_autocomplete(){
        $keyword = I('get.query');
        //制作查询语句
        $map['nickname']=array('like','%'.$keyword.'%');
        $keyword_array = M('user')->where($map)->limit(5)->select();
        foreach ($keyword_array as $value){
            $result_array[] =array(
                'label'=>$value['nickname'],
            );
        }
        echo json_encode($result_array);
    }

    public function saveAdmin() {

        if (IS_POST) {
            //计算昵称所对应的openid
            $nickname = I('post.nickname');
            if($nickname){
                $_POST['openid'] = M('user')->where('nickname="%s"',$nickname)->getField('openid')?:"";
            }
            $database_area = D('Admin');

            $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

            $account = htmlspecialchars($_POST['account']);

            if ($database_area->where("`id`<>'{$id}' AND `account`='{$account}'")->find()) {

                $this->error('数据库中已存在相同的账号，请更换。');

            }
            if (empty($_POST['village_id'])||$_POST['village_id']==0) {

                $this->error('请选择社区');

                exit();

            }

            unset($_POST['id']);

            $_POST['level'] = 0;

            if ($id) {

                if ($_POST['pwd']) {

                    $_POST['pwd'] = md5($_POST['pwd']);

                } else {

                    unset($_POST['pwd']);

                }

                $database_area->where(array('id' => $id))->data($_POST)->save();

                $this->success('修改成功！');

            } else {

                if (empty($_POST['pwd'])) {

                    $this->error('密码不能为空~');

                }

                $_POST['pwd'] = md5($_POST['pwd']);

                if ($database_area->data($_POST)->add()) {

                    $this->success('添加成功！');

                } else {

                    $this->error('添加失败！请重试~');

                }

            }

        } else {

            $this->error('非法提交,请重新提交~');

        }

    }



    /*     * **网站地图***** */



    public function sitemap() {

		$xmlfilepath = './'.str_replace('.','_',$_SERVER['HTTP_HOST']).'sitemap.xml';

		$this->assign('xmlfilepath', $xmlfilepath);

        $this->display();

    }


    /*     * **执行网站地图*****

     * *<loc>www.example1.com</loc>该页的网址。该值必须少于256个字节(必填项)。格式为<loc>您的url地址</loc>

     * *<lastmod>2010-01-01</lastmod>该文件上次修改的日期(选填项)。格式为<lastmod>年-月-日</lastmod>

     * *<changefreq> always </changefreq>页面可能发生更改的频率(选填项)

     * *有效值为：always、hourly、daily、weekly、monthly、yearly、never

     * *<priority>1.0</priority >此网页的优先级。有效值范围从 0.0 到 1.0 (选填项) 。0.0优先级最低、1.0最高。

     * *

     * */



    public function exeGenerate() {

        set_time_limit('100');

        /*         * **寻找网址*** */

        $UrlSetArr = array();

        $siteurl = $this->config['site_url'];

        $siteurl = rtrim($siteurl, '/') . '/';

        $UrlSetArr[] = array('loc' => $siteurl, 'lastmod' => date('Y-m-d'), 'changefreq' => 'always', 'priority' => '1.0');

        /*         * **团购***** */

        $UrlSetArr[] = array('loc' => $siteurl . 'category/all', 'lastmod' => date('Y-m-d'), 'changefreq' => 'always', 'priority' => '0.9');

        $urldatatmp = M('Group_category')->field('cat_id,cat_fid,cat_name,cat_url')->where(array('cat_status' => '1'))->order('cat_id ASC')->select();

        if (!empty($urldatatmp)) {

            foreach ($urldatatmp as $vv) {

                $UrlSetArr[] = array('loc' => $siteurl . 'category/' . $vv['cat_url'], 'lastmod' => date('Y-m-d'), 'changefreq' => 'always', 'priority' => '0.7');

            }

        }



        $jointable = C('DB_PREFIX') . 'merchant';

        $GroupDb = M('Group');

        $GroupDb->join('as grp LEFT JOIN ' . $jointable . ' as mer on grp.mer_id=mer.mer_id');

        $urldatatmp = $GroupDb->field('grp.group_id,grp.mer_id,grp.last_time')->where('grp.status="1" AND mer.status="1"')->order('grp.group_id  DESC')->select();

        if (!empty($urldatatmp)) {

            foreach ($urldatatmp as $vv) {

                $UrlSetArr[] = array('loc' => $siteurl . 'group/' . $vv['group_id'] . '.html', 'lastmod' => !empty($vv['last_time']) ? date('Y-m-d', $vv['last_time']) : date('Y-m-d'), 'changefreq' => 'monthly', 'priority' => '0.9');

            }

        }



        /*         * **订餐***** */

        $UrlSetArr[] = array('loc' => $siteurl . 'meal/all', 'lastmod' => date('Y-m-d'), 'changefreq' => 'always', 'priority' => '0.9');



        $urldatatmp = M('Meal_store_category')->field('cat_id,cat_fid,cat_name,cat_url')->where(array('cat_status' => '1'))->order('cat_id ASC')->select();

        if (!empty($urldatatmp)) {

            foreach ($urldatatmp as $vv) {

                $UrlSetArr[] = array('loc' => $siteurl . 'meal/' . $vv['cat_url'] . '/all', 'lastmod' => date('Y-m-d'), 'changefreq' => 'always', 'priority' => '0.7');

            }

        }

        $urldatatmp = M('Merchant_store')->field('store_id,mer_id')->where(array('have_meal' => '1', 'status' => '1'))->order('store_id ASC')->select();

        if (!empty($urldatatmp)) {

            foreach ($urldatatmp as $vv) {

                $UrlSetArr[] = array('loc' => $siteurl . 'meal/' . $vv['store_id'] . '.html', 'lastmod' => date('Y-m-d'), 'changefreq' => 'always', 'priority' => '0.9');

            }

        }

        /*         * **分类信息***** */

        $UrlSetArr[] = array('loc' => $siteurl . 'classify/', 'lastmod' => date('Y-m-d'), 'changefreq' => 'monthly', 'priority' => '0.9');

        $UrlSetArr[] = array('loc' => $siteurl . 'classify/selectsub.html', 'lastmod' => date('Y-m-d'), 'changefreq' => 'monthly', 'priority' => '0.5');

        $urldatatmp = M('Classify_category')->field('cid,fcid,subdir,updatetime')->where(array('cat_status' => '1'))->select();

        if (!empty($urldatatmp)) {

            foreach ($urldatatmp as $vv) {

                if (($vv['subdir'] == 1) && ($vv['fcid'] == 0)) {

                    $UrlSetArr[] = array('loc' => $siteurl . 'classify/subdirectory-' . $vv['cid'] . '.html', 'lastmod' => !empty($vv['updatetime']) ? date('Y-m-d', $vv['updatetime']) : date('Y-m-d'), 'changefreq' => 'monthly', 'priority' => '0.5');

                } elseif (($vv['subdir'] == 2) && ($vv['fcid'] > 0)) {

                    $UrlSetArr[] = array('loc' => $siteurl . 'classify/list-' . $vv['cid'] . '.html', 'lastmod' => !empty($vv['updatetime']) ? date('Y-m-d', $vv['updatetime']) : date('Y-m-d'), 'changefreq' => 'monthly', 'priority' => '0.8');

                } elseif (($vv['subdir'] == 3) && ($vv['fcid'] > 0)) {

                    $UrlSetArr[] = array('loc' => $siteurl . 'classify/list-' . $vv['fcid'] . '-' . $vv['cid'] . '.html', 'lastmod' => !empty($vv['updatetime']) ? date('Y-m-d', $vv['updatetime']) : date('Y-m-d'), 'changefreq' => 'monthly', 'priority' => '0.8');

                }

            }

        }



        $urldatatmp = M('Classify_userinput')->field('id,cid,addtime')->where(array('status' => '1'))->order('id DESC')->limit(5000)->select();

        if (!empty($urldatatmp)) {

            foreach ($urldatatmp as $vv) {

                $UrlSetArr[] = array('loc' => $siteurl . 'classify/' . $vv['id'] . '.html', 'lastmod' => date('Y-m-d'), 'changefreq' => 'monthly', 'priority' => '0.9');

            }

        }



        /*         * *****商家中心********* */

        $urldatatmp = M('Merchant')->field('mer_id')->where(array('ismain' => 1, 'status' => 1))->select();

        if (!empty($urldatatmp)) {

            foreach ($urldatatmp as $vv) {

                $UrlSetArr[] = array('loc' => $siteurl . 'merindex/' . $vv['mer_id'] . '.html', 'lastmod' => date('Y-m-d'), 'changefreq' => 'monthly', 'priority' => '0.3');

            }

        }

        /*         * ******活动********** */

        $UrlSetArr[] = array('loc' => $siteurl . 'activity/', 'lastmod' => date('Y-m-d'), 'changefreq' => 'monthly', 'priority' => '0.6');

        $urldatatmp = M('Extension_activity_list')->field('pigcms_id')->where(array('status' => '1'))->select();

        if (!empty($urldatatmp)) {

            foreach ($urldatatmp as $vv) {

                $UrlSetArr[] = array('loc' => $siteurl . 'activity/' . $vv['pigcms_id'] . '.html', 'lastmod' => date('Y-m-d'), 'changefreq' => 'monthly', 'priority' => '0.5');

            }

        }

        $this->exeGenerateFile($UrlSetArr);

    }



    private function exeGenerateFile($UrlSetArr) {

        if (!empty($UrlSetArr)) {

            $xmlfilepath = './'.str_replace('.','_',$_SERVER['HTTP_HOST']).'sitemap.xml';

            $fp = fopen($xmlfilepath, "wb");

            if ($fp) {

                fwrite($fp, '<?xml version="1.0" encoding="utf-8"?>' . chr(10) . '<urlset>');

                foreach ($UrlSetArr as $uv) {

                    $linestr = chr(10) . '<url>' . chr(10) . '<loc>' . $uv ['loc'] . '</loc>' . chr(10) . '<lastmod>' . $uv['lastmod'] . '</lastmod>' . chr(10) . '<changefreq>' . $uv ['changefreq'] . '</changefreq>' . chr(10) . '<priority>' . $uv['priority'] . '</priority>' . chr(10) . '</url>';

                    fwrite($fp, $linestr);

                }

                fwrite($fp, chr(10) . '</urlset>');

                fclose($fp);

                $this->dexit(array('error' => 0, 'msg' => '生成完成！'));

            } else {

                $this->dexit(array

                    ('error' => 1, 'msg' => '网站根目录下'.$xmlfilepath.'文件不可写！'));

            }

        }

        $this->dexit(array('error' => 1, 'msg' => '没有可生成的数据'));

    }



    /*     * json 格式封装函数* */



    private function dexit($data = '') {

        if (is_array($data)) {

            echo json_encode($data);

        } else {

            echo $data;

        }

        exit();

    }

    public function log_list(){
        //拉取日志列表
        $log_Ob = M('operation_log');
        $log_count = $log_Ob->where(array('is_del'=>0))->count();

        import('@.ORG.system_page');
        $p=new Page($log_count,15,'page');
        $pagebar=$p->show();
        $log_arr = $log_Ob->where(array('is_del'=>0))->limit($p->firstRow.','.$p->listRows)->order('do_time desc')->select();
        $this->assign('log_arr', $log_arr);
        $this->assign('pagebar', $pagebar);
        $this->display();
    }

    public function log_list_news(){
        //拉取日志列表
        $log_Ob = M('operation_log');
        $log_arr = $log_Ob->where(array('is_del'=>0))->order('do_time desc')->select();
        $this->assign('log_arr', $log_arr);
        $this->display();
    }

    public function log_del(){
        //删除日志
        $id = I('get.pigcms_id');
        $terrace_Ob = M('operation_log');
        $res = $terrace_Ob->where(array("pigcms_id"=>$id))->data(array("is_del"=>1))->save();
        if($res){
            $this->success('删除成功！');
        }else{
            $this->error('删除失败！请重试~');
        }

    }

    public function log_del_new(){
        //删除日志
        $id = I('post.pigcms_id');
        $terrace_Ob = M('operation_log');
        $res = $terrace_Ob->where(array("pigcms_id"=>$id))->data(array("is_del"=>1))->save();
        if($res){
            echo 1;
        }else{
           echo 2;
        }

    }

    /*
     * 菜单主页
     * @author 祝君伟
     * @time 2017.3.20
     * */
    public function system_menu_show_news(){
        //系统左边菜单显示列表
        $menu_array = M('permission_menu')->where(array('auth_area'=>array('neq',2)))->select();
        foreach ($menu_array as $key=>$value){
            //当该菜单是顶级菜单的时候，将命名为顶级菜单，如果不是顶级菜单的话就直接拿其父菜单的名称
            if($value['fid'] == 0&&$value['group_id'] !=0) {
                $menu_array[$key]['fid_name'] = '<span style="color: red">顶级菜单</span>';
            }else if($value['fid'] == 0&&$value['group_id'] ==0){
                $menu_array[$key]['fid_name'] = '<span style="color: orange">分组模块</span>';
            }else{
                $fid_name = M('permission_menu')->where(array('id'=>$value['fid']))->getField('name');
                $menu_array[$key]['fid_name'] = $fid_name;
            }
        }
        //vd($menu_array);exit;
        $this->assign('menu_array',$menu_array);
        $this->display();
    }

    /*
     * 菜单更新
     * @author 祝君伟
     * @time 2017.3.20
     * */
    public function system_menu_edit_news(){
        //编辑后台系统的菜单
        $menu_id = I('get.id');
        if(IS_POST){
            //更新编辑
            //dump($_POST);exit;
            $menu = M('permission_menu');
            $data=$_POST;
            //对冗余提交数据进行过滤
            if($data['icon'] == '--请选择--'){
                $data['icon'] ='';
            }
            if($data['controller'] == '--请选择--'){
                $data['controller'] ='';
            }
            if($data['action'] == '--请选择--'){
                $data['action'] ='';
            }
            if($data['module'] == '--请选择--'){
                $data['module'] ='';
            }
            if($data['fid'] == '--请选择--'){
                $data['fid'] =0;
            }
            if($data['group_id'] == '--请选择--'){
                $data['group_id'] =0;
            }

            if ($_FILES['custom']['error'] == 0) {
                $filepath = $this->upload();
                $data['custom_icon'] = $filepath[0]["savepath"].$filepath[0]["savename"];
            }
            //执行添加
            if($data['group-c']){
                $data['arguments'] = serialize($data['group-c']);
                unset($data['group-c']);
            }
            $result_code = $menu->save($data);
            if($result_code){
                $this->success('更新成功');
            }else{
                $this->error('更新失败');
            }
        }else{
            //显示编辑页面
            //权限&菜单内容
            $menu_array = D('Permission')->get_trueInfo($menu_id);

            //vd($menu_array);

            //菜单实际分组id

            //父级菜单内容
            //$show_father_menu = M('permission_menu')->where(array('fid'=>0,'is_show'=>1,'auth_area'=>array('neq',1),'group_id'=>array('neq',0)))->select();
            $show_father_menu = M('permission_menu')->where(array('fid'=>0,'is_show'=>1,'auth_area'=>array('neq',1)))->select();
            //获取当前的所有控制器
            $control_array = $this->get_controller($menu_array['module']);

            //分组父级名称

            $group_array = M('permission_menu')->where(array('fid'=>0,'group_id'=>0,'is_show'=>1,'auth_area'=>array('eq',0)))->select();
            //配置可选模块
            $module_array = array('System','Wap','House');
            $this->assign('module_array',$module_array);
            $this->assign('control_array',$control_array);
            $this->assign('show_father_menu',$show_father_menu);
            $this->assign('group_array',$group_array);
            $this->assign('menu_array',$menu_array);
            $this->display();
        }

    }

    /*
    * 菜单添加
    * @author 祝君伟
    * @time 2017.3.20
    * */
    public function system_menu_add_news(){
        //添加后台系统的菜单
        if(IS_POST){
//            dump($_POST);exit;
            $menu = M('permission_menu');
            $data=$_POST;
            //对冗余提交数据进行过滤
            if($data['icon'] == '--请选择--'){
                $data['icon'] ='';
            }
            if($data['controller'] == '--请选择--'){
                $data['controller'] ='';
            }
            if($data['action'] == '--请选择--'){
                $data['action'] ='';
            }
            if($data['module'] == '--请选择--'){
                $data['module'] ='';
            }
            if($data['fid'] == '--请选择--'){
                $data['fid'] =0;
            }
            if($data['group_id'] == '--请选择--'){
                $data['group_id'] =0;
            }

            if ($_FILES['custom_icon']['error'] == 0) {
                $filepath = $this->upload();
                $data['custom_icon'] = $filepath[0]["savepath"].$filepath[0]["savename"];
            } else {
                $data['custom_icon'] =0;
            }

            //执行添加
            if($data['group-c']){
                $data['arguments'] = serialize($data['group-c']);
                unset($data['group-c']);
            }
            //dump($data);exit;
            $result_code = $menu->data($data)->add();
            if($result_code){
                $this->success('添加成功');
            }else{
                $this->error('添加失败');
            }

        }else{
           //展示添加页面
            //父级菜单内容
            //$show_father_menu = M('permission_menu')->where(array('fid'=>0,'is_show'=>1,'auth_area'=>array('neq',1),'group_id'=>array('neq',0)))->select();
            $show_father_menu = M('permission_menu')->where(array('fid'=>0,'is_show'=>1,'auth_area'=>array('neq',1)))->select();

            //分组父级名称

            $group_array = M('permission_menu')->where(array('fid'=>0,'group_id'=>0,'is_show'=>1,'auth_area'=>array('eq',0)))->select();
            //定义模块数组
            $module_array = array('System','Wap','House');
            $this->assign('show_father_menu',$show_father_menu);
            $this->assign('module_array',$module_array);
            $this->assign('group_array',$group_array);
            $this->display();
        }
    }
    /*
     * 图片上传
     */
    public function upload() {
        import('ORG.Net.UploadFile');
        $upload = new UploadFile();// 实例化上传类
        $upload->maxSize = 3145728;// 设置附件上传大小
        $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->savePath = './upload/';// 设置附件上传目录
        if (!$upload->upload()) {// 上传错误提示错误信息
            $this->error($upload->getErrorMsg());
        } else {// 上传成功 获取上传文件信息
            $info = $upload->getUploadFileInfo();
        }
        return $info;
    }

    /*
     * 菜单删除
     * @author 祝君伟
     * @time 2017.3.20
     * */
    public function system_menu_deleted_news(){
        $id = I('get.id');
        //执行删除
        $result_code=M('permission_menu')->where(array('id'=>$id))->delete();
        if($result_code){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }


    /*
   * 核心方法---制做一个当前模块下所有控制器的数组
   * author 祝君伟
   * time 2017.4.1
   * */

    protected function get_controller($module){
        //如果无module返回空
        if(empty($module)) return null;
        //该模块的项目绝对路径
        $module_path = APP_PATH . 'Lib/Action/' . ucfirst($module);
        //如果模块不是文件类型，返回空
        if(!is_dir($module_path)) return null;
        $module_path .= '/*.class.php';
        //在模块中搜索class.php结尾的文件
        $ary_files = glob($module_path);
        foreach ($ary_files as $file) {
            if (is_dir($file)) {
                //如果找到的名字是文件夹，将结束此次循环，进行下一次循环
                continue;
            }else {
                //找到的是文件。获取其除开后缀的所有名称
                $files[]  = basename($file,C('DEFAULT_C_LAYER').'.class.php');
            }
        }
        return $files;
    }

    /*
     * 核心方法---获取当前控制器下的所有方法名
     * @author 祝君伟
     * @time 2017.4.1
     * */
    protected function get_action($action){
        //获得该控制器的对象
        $action = A($action);
        //PHP 自带方法：获取class下所有的方法，包括析构，构造，和继承父类的所有方法
        $all_action_array = get_class_methods($action);
        $allow_array = array('_initialize','__construct','getActionName','isAjax','display','show','fetch','buildHtml','assign','__set','get','__get','__isset','__call','error','success','ajaxReturn','theme','redirect','__destruct','_empty');
        //过滤数组
        foreach ($all_action_array as $func){
            if(!in_array($func, $allow_array)){
                $customer_functions[] = $func;
            }
        }
        return $customer_functions;
    }

    //制作子级栏目的option列表
    public function make_child_option(){
        //查询所有不是顶级菜单的菜单
        $option_array=D('permission_menu')->where(array('fid'=>array('neq',0),'auth_type'=>0))->select();
        $option_list = '';
        //拼接字符串
        foreach ($option_array as $value){
            $option_list .= '<option value="'.$value['id'].'">'.$value['name'].'的业务逻辑</option>';
        }
        echo '<select class="form-control" name="fid" id="fid"><option value="0">首页业务逻辑</option>'.$option_list.'</select>';
    }

    /*
     * ajax 重组下面控制器名称
     * */
    public function make_control_option(){
        $model = I('post.model');
        //接受前台传来的数据并且调用封装方法进行处理
        $result_array = $this->get_controller($model);
        $result_string = '';
        //拼接OPTION字符串
        foreach ($result_array as $value){
            $result_string .= '<option value="'.$value.'">'.$value.'</option>';
        }
        echo $result_string;
    }

    /*
     * ajax 重组下面控制器名称
     * */
    public function make_control_option2(){
        $model = I('post.model');
        //接受前台传来的数据并且调用封装方法进行处理
        $result_array = D('permission_menu')->where(array('auth_area'=>$model,'fid'=>0,'auth_type'=>4))->select();
        $result_string = '<option value="0">顶级菜单</option>';
        //拼接OPTION字符串
        foreach ($result_array as $value){
            $name = $value['name'];
            $id = $value['id'];
            $result_string .= '<option value="'.$id.'">'.$name.'</option>';
        }
        echo $result_string;
    }

    /*
     * ajax 重组下面控制器名称
     * */
    public function make_control_option3(){
        $model = I('post.model');
        //接受前台传来的数据并且调用封装方法进行处理
        $result_array = D('permission_menu')->where(array('auth_area'=>$model,'fid'=>0,'auth_type'=>5))->select();
        $result_string = '<option value="0">顶级菜单</option>';
        //拼接OPTION字符串
        foreach ($result_array as $value){
            $name = $value['name'];
            $id = $value['id'];
            $result_string .= '<option value="'.$id.'">'.$name.'</option>';
        }
        echo $result_string;
    }

    public function control_test(){
        $module = 'wap';
        $re = $this->get_controller($module);
        dump($re);
    }

    /*
     *
     * ajax 选择相应的社区下的公司
     * */
    public function make_company_list(){
        $village_id = I('post.village_id');
        //接受前台传来的数据并且调用封装方法进行处理
        $company_array = M('company')->where(array('village_id'=>$village_id))->select();
        $option_list = '';
        //拼接OPTION字符串
        foreach ($company_array as $value){
            $option_list .= '<option value="'.$value['company_id'].'">'.$value['company_name'].'</option>';
        }

        echo '<select class="form-control" name="company_id" id="company_id"><option value="0">请选择</option>'.$option_list.'</select>';
        
    }

    /*
     *
     * ajax 一键隐藏
     * */
    public function change_show_hide(){
        $menu_id = I('post.menu_id');
        $menu_info = M('permission_menu')->where(array('id'=>$menu_id,'auth_area'=>0))->find();
        if(!$menu_info){
            echo 2;exit;
        }
        if($menu_info['fid']==0){
            //如果当现在的要改变的菜单是顶级菜单，那么相应的下面的子类要全部隐藏
            //第一：改变当前的菜单状态
            M('permission_menu')->where(array('id'=>$menu_id))->data(array('is_show'=>0))->save();
            //第二：改变其子菜单的状态
            $children_menu_list = M('permission_menu')->where(array('fid'=>$menu_id))->select();
            foreach ($children_menu_list as $value){
                M('permission_menu')->where(array('id'=>$value['id']))->data(array('is_show'=>0))->save();
            }
        }else{
            //非顶级菜单，直接改变自己的状态
            M('permission_menu')->where(array('id'=>$menu_id))->data(array('is_show'=>0))->save();
        }
    }


    /*
     * ajax 一键显示
     * */
    public function change_show(){
        $menu_id = I('post.menu_id');
        $menu_info = M('permission_menu')->where(array('id'=>$menu_id,'auth_area'=>0))->find();
        if(!$menu_info){
            echo 2;exit;
        }
        if($menu_info['fid']==0){
            //如果当现在的要改变的菜单是顶级菜单，那么相应的下面的子类要全部显示
            //第一：改变当前的菜单状态
            M('permission_menu')->where(array('id'=>$menu_id))->data(array('is_show'=>1))->save();
            //第二：改变其子菜单的状态
            $children_menu_list = M('permission_menu')->where(array('fid'=>$menu_id))->select();
            foreach ($children_menu_list as $value){
                M('permission_menu')->where(array('id'=>$value['id']))->data(array('is_show'=>1))->save();
            }
        }else{
            //非顶级菜单，直接改变自己的状态
            M('permission_menu')->where(array('id'=>$menu_id))->data(array('is_show'=>1))->save();
        }
    }

    /*
     * ajax 自动排序更改
     * */
    public function sort_menu_id(){
        $sort_id = I('post.sort_id');
        $menu_id = I('post.menu_id');
        //第一：获取该菜单的信息
        $menu_info = M('permission_menu')->where(array('id'=>$menu_id))->find();
        if($menu_info['sort'] == $sort_id){
            //没有任何改变，返回 1 ，并退出程序
            echo 1;exit;
        }else{
            M('permission_menu')->where(array('id'=>$menu_id))->data(array('sort'=>$sort_id))->save();
        }

    }


    /*
     * ajax 获取对应项目下的商户列表
     * */
    public function make_merchant_list(){
        $village_id = I('post.village_id');
        //接受前台传来的数据并且调用封装方法进行处理
        $merchant_array = M('merchant')->where(array('village_id'=>$village_id))->select();
        $option_list = '';
        //拼接OPTION字符串
        foreach ($merchant_array as $value){
            $option_list .= '<option value="'.$value['mer_id'].'">'.$value['name'].'</option>';
        }

        echo '<select class="form-control" name="mer_id" id="mer_id"><option value="0">请选择</option>'.$option_list.'</select>';

    }

    /**
     * 接口测试页面
     */
    public function interface_test_news(){
        $this->display('interface_test');
    }

}

