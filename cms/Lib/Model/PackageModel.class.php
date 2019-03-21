<?php
/**
 * 快递包裹管理数据model
 * @author 祝君伟
 * @time 2018年1月12日 17:24:46
 */
class PackageModel extends Model{
    public function __construct()
    {
        parent::__construct();
        $this->village_id = $_SESSION['system']['village_id'];
    }
    /**
     * 获取全公司列表
     * @return array|mixed
     */
    public function getCompany_list()
    {
        $field=array(
            'c.*',
            'cv.expressage_locker_id'=>'company_id',
            'c.name'=>'company_name'
        );
        $list = M('express')
            ->alias('c')
            ->field($field)
            ->join('LEFT JOIN __EXPRESSAGE_COMPANY_VILLAGE__ cv on c.id=cv.company_id')
            ->where(array('c.status'=>1))
            ->select();
        //$list = M('expressage_company')->where(array('status'=>0))->select();

        foreach ($list as $key=>$value)
        {
            $list[$key]['url'] = U('Express/package_in_database',array('cid'=>$value['company_id']));
        }

        return  $list;
    }

    /**
     * 快件信息
     * @param int $limit   限制查询条数
     * @return mixed
     */
    public function getPackage_list_bck($limit=0,$cid=0,$keyword='',$status=false)
    {
        $map = array(
            'c.status'=>0,
            'u.status'=>0
        );

        $field = array(
            'p.*',
            'c.company_name',
            'u.name',
            'u.phone',
            'a.realname'
        );

        $cid && $map['p.cid'] = $cid;

        $status!==false && $map['p.status'] = $status;

        $keyword && $map['p.waybill_number|u.name|u.phone|p.receipt_code'] = array('like','%'.$keyword.'%');

        //自主分页
        import('@.ORG.bootstrap_page');

        if($limit)
        {


            $count = M('package')
                ->alias('p')
                ->field($field)
                ->join('LEFT JOIN __EXPRESSAGE_COMPANY__ c on c.company_id=p.cid')
                ->join('LEFT JOIN __EXPRESSAGE_USER__ u on u.pigcms_id=p.aid')
                ->join('LEFT JOIN __ADMIN__ a on a.id=p.admin_id')
                ->where($map)
                ->limit($limit)
                ->count();

            $Page       = new Page($count,10);

            $show       = $Page->show();


            $list = M('package')
                ->alias('p')
                ->field($field)
                ->join('LEFT JOIN __EXPRESSAGE_COMPANY__ c on c.company_id=p.cid')
                ->join('LEFT JOIN __EXPRESSAGE_USER__ u on u.pigcms_id=p.aid')
                ->join('LEFT JOIN __ADMIN__ a on a.id=p.admin_id')
                ->where($map)
                ->order('in_package_time desc')
                ->limit($Page->firstRow.','.$Page->listRows)
                ->limit($limit)
                ->select();

            $list['list'] = $list;

            $list['page'] = $show;
        }
        else
        {

            $count = M('package')
                ->alias('p')
                ->field($field)
                ->join('LEFT JOIN __EXPRESSAGE_COMPANY__ c on c.company_id=p.cid')
                ->join('LEFT JOIN __EXPRESSAGE_USER__ u on u.pigcms_id=p.aid')
                ->join('LEFT JOIN __ADMIN__ a on a.id=p.admin_id')
                ->where($map)
                ->count();

            $Page       = new Page($count,10);

            $show       = $Page->show();

            $list = M('package')
                ->alias('p')
                ->field($field)
                ->join('LEFT JOIN __EXPRESSAGE_COMPANY__ c on c.company_id=p.cid')
                ->join('LEFT JOIN __EXPRESSAGE_USER__ u on u.pigcms_id=p.aid')
                ->join('LEFT JOIN __ADMIN__ a on a.id=p.admin_id')
                ->where($map)
                ->order('in_package_time desc')
                ->limit($Page->firstRow.','.$Page->listRows)
                ->select();

            $list['list'] = $list;

            $list['page'] = $show;

        }



        return $list;

    }


    public function get_package_list()
    {
        $map = array(
            'c.status'=>0,
            'u.status'=>0,
        );

        $field = array(
            'p.*',
            'c.company_name',
            'u.name',
            'u.phone',
            'u.active_value',
            'a.realname',
            'user.nickname',
            'user.openid',
            'user.avatar'
        );

        $list = M('package')
            ->alias('p')
            ->field($field)
            ->join('LEFT JOIN __EXPRESSAGE_COMPANY__ c on c.company_id=p.cid')
            ->join('LEFT JOIN __EXPRESSAGE_USER__ u on u.pigcms_id=p.aid')
            ->join('LEFT JOIN __ADMIN__ a on a.id=p.admin_id')
            ->join('LEFT JOIN __USER__ user on user.uid=u.uid')
            ->where($map)
            ->order('in_package_time desc')
            ->select();

        return $list;
    }


    public function getPackage_list($status=false)
    {
        $lastWeekTime = strtotime('-1 weeks');
        $search_all=array(
            'status'=>$status,
            'in_package_time_mix'=>$lastWeekTime
        );
        $list=$this->getPackage_list_search($search_all);
        /*$map = array(
            'c.status'=>0,
            'u.status'=>0,
            'p.in_package_time'=>array('gt',$lastWeekTime)
        );


        $status!==false && $map['p.status'] = $status;

        $field = array(
            'p.*',
            'c.company_name',
            'u.name',
            'u.phone',
            'a.realname'
        );


        $list = M('package')
            ->alias('p')
            ->field($field)
            ->join('LEFT JOIN __EXPRESSAGE_COMPANY__ c on c.company_id=p.cid')
            ->join('LEFT JOIN __EXPRESSAGE_USER__ u on u.pigcms_id=p.aid')
            ->join('LEFT JOIN __ADMIN__ a on a.id=p.admin_id')
            ->where($map)
            ->limit(10)
            ->order('in_package_time desc')
            ->select();*/

        return $list;
    }


    public function getPackage_list_two($status=false,$search='',$more=0)
    {
        $lastWeekTime = strtotime('-1 weeks');
        $search_all=array(
            'status'=>$status,
            'search_dim'=>$search,
            'in_package_time_mix'=>$lastWeekTime
        );
        $list=$this->getPackage_list_search($search_all,$more,15);
        /*$map = array(
            'c.status'=>0,
            'u.status'=>0,
            'p.in_package_time'=>array('gt',$lastWeekTime)
        );
        if (!empty($search)) $map['p.waybill_number|u.name|u.phone'] = array("like","%{$search}%");

        $status!==false && $map['p.status'] = $status;

        $field = array(
        'p.*',
        'c.company_name',
        'u.name',
        'u.phone',
        'a.realname'
    );


        $list = M('package')
            ->alias('p')
            ->field($field)
            ->join('LEFT JOIN __EXPRESSAGE_COMPANY__ c on c.company_id=p.cid')
            ->join('LEFT JOIN __EXPRESSAGE_USER__ u on u.pigcms_id=p.aid')
            ->join('LEFT JOIN __ADMIN__ a on a.id=p.admin_id')
            ->where($map)
            ->limit($more,15)
            ->order('in_package_time desc')
            ->select();*/

        return $list;
    }

    public function getPackage_list_little($status=false,$search='')
    {
        $lastWeekTime = strtotime('-1 weeks');
        $search_all=array(
            'status'=>$status,
            'search_dim'=>$search,
            'in_package_time_mix'=>$lastWeekTime
        );
        $list=$this->getPackage_list_search($search_all);
        /*$map = array(
            'c.status'=>0,
            'u.status'=>0,
            'p.in_package_time'=>array('gt',$lastWeekTime)
        );
        if (!empty($search)) $map['p.waybill_number|u.name|u.phone'] = array("like","%{$search}%");

        $status!==false && $map['p.status'] = $status;

        $field = array(
            'p.*',
            'c.company_name',
            'u.name',
            'u.phone',
            'a.realname'
        );


        $list = M('package')
            ->alias('p')
            ->field($field)
            ->join('LEFT JOIN __EXPRESSAGE_COMPANY__ c on c.company_id=p.cid')
            ->join('LEFT JOIN __EXPRESSAGE_USER__ u on u.pigcms_id=p.aid')
            ->join('LEFT JOIN __ADMIN__ a on a.id=p.admin_id')
            ->where($map)
            ->limit(10)
            ->order('in_package_time desc')
            ->select();*/

        return $list;
    }

    public function getPackage_list_num($status=false,$search='')
    {
        $lastWeekTime = strtotime('-1 weeks');
        $search_all=array(
            'status'=>$status,
            'search_dim'=>$search,
            'in_package_time_mix'=>$lastWeekTime
        );
        $list_num=$this->getPackage_list_search_count($search_all);
        /*
        $map = array(
            'c.status'=>0,
            'u.status'=>0,
            'p.in_package_time'=>array('gt',$lastWeekTime)
        );
        if (!empty($search)) $map['p.waybill_number|u.name|u.phone'] = array("like","%{$search}%");


        $list_num = M('package')
            ->alias('p')
            ->field('count(*) as num')
            ->join('LEFT JOIN __EXPRESSAGE_COMPANY__ c on c.company_id=p.cid')
            ->join('LEFT JOIN __EXPRESSAGE_USER__ u on u.pigcms_id=p.aid')
            ->join('LEFT JOIN __ADMIN__ a on a.id=p.admin_id')
            ->where($map)
            ->count();*/

        return $list_num;
    }
    /**
     * 获取指定要求的包裹信息
     * @author zhukeqin
     * @return array
     */
    public function getPackage_list_search($search='',$start='',$length='')
    {
        $map = array(
            'c.status'=>1,
            'u.status'=>0
        );
        $time_max = array('in_package_time_max','out_package_time_max');
        $time_mix=array('in_package_time_mix', 'out_package_time_mix');
        //添加查询条件
        if(!empty($search)) {
            foreach ($search as $key => $value) {
                if (in_array($key, $time_max)) {
                    $key = 'p.'.str_replace('_max', '', $key);
                    if(empty($map['_string'])){
                        $map['_string']="{$key}<={$value}";
                    }else{
                        $map['_string'].=" AND {$key}<={$value}";
                    }
                } elseif (in_array($key, $time_mix)) {
                    $key = 'p.'.str_replace('_mix', '', $key);
                    if(empty($map['_string'])){
                        $map['_string']="{$key}>={$value}";
                    }else{
                        $map['_string'].=" AND {$key}>={$value}";
                    }
                } elseif ($key == 'search_dim') {
                    $map['p.waybill_number|u.name|u.phone|c.name|p.receipt_code'] = array("like", "%{$value}%");//模糊查询
                } else {
                    $key = 'p.' . $key;
                    $map[$key] = $value;
                }
            }
        }
        //防止传参错误，读取快件信息数量过多，设定默认时间
        /*if($search['status']===0&&empty($search['in_package_time_mix'])){
            $map['p.in_package_time']=array('egt',mktime(0,0,0,date('m'),date('d'),date('Y')));
        }
        if($search['status']===1&&empty($search['out_package_time_mix'])){
            $map['p.out_package_time']=array('egt',mktime(0,0,0,date('m'),date('d'),date('Y')));
        }*/
        if(empty($this->village_id)){
            $village_info='';
        }else{
            $village_info='and cv.village_id='.$this->village_id;
        }
        $field = array(
            'p.*',
            'c.name'=>'company_name',
            'c.logo',
            'c.coding',
            'u.name',
            'u.phone',
            'a.realname',
            'u.active_value',
            'user.nickname',
            'user.openid',
            'user.avatar',
        );
        if(empty($length)) {
            $list = M('package')
                ->alias('p')
                ->field($field)
                ->join('LEFT JOIN __EXPRESSAGE_COMPANY_VILLAGE__ cv on cv.expressage_locker_id=p.cid '.$village_info)
                ->join('LEFT JOIN __EXPRESS__ c on c.id=cv.company_id')
                ->join('LEFT JOIN __EXPRESSAGE_USER__ u on u.pigcms_id=p.aid')
                ->join('LEFT JOIN __ADMIN__ a on a.id=p.admin_id')
                ->join('LEFT JOIN __USER__ user on user.uid=u.uid')
                ->where($map)
                ->order('p.in_package_time desc')
                ->select();
        }else{
            $list = M('package')
                ->alias('p')
                ->field($field)
                ->join('LEFT JOIN __EXPRESSAGE_COMPANY_VILLAGE__ cv on cv.expressage_locker_id=p.cid '.$village_info)
                ->join('LEFT JOIN __EXPRESS__ c on c.id=cv.company_id')
                ->join('LEFT JOIN __EXPRESSAGE_USER__ u on u.pigcms_id=p.aid')
                ->join('LEFT JOIN __ADMIN__ a on a.id=p.admin_id')
                ->join('LEFT JOIN __USER__ user on user.uid=u.uid')
                ->where($map)
                ->order('p.in_package_time desc')
                ->limit($start,$length)
                ->select();
        }
        return $list;
    }
    /**
     * 获取指定要求的包裹数量
     * @author zhukeqin
     * @return int
     */
    public function getPackage_list_search_count($search=''){
        $list_num=count($this->getPackage_list_search($search));
        return $list_num;
    }

    /**
     * 获取指定要求的短信信息
     * @author zhukeqin
     * @return array
     */
    public function getSms_list_search($search=''){
        foreach ($search as $k=>$v){
            if($k=='time'){
                $map['time']=array(array('egt',$v['time_start']),array('elt',$v['time_end']));
            }else{
                $map[$k]=$v;
            }
        }
        $list=M('sms_record')->where($map)->select();
        return $list;
    }
    /**
     * 获取指定要求的短信数量
     * @author zhukeqin
     * @return int
     */
    public function getSms_list_search_count($search=''){
        foreach ($search as $k=>$v){
            if($k=='time'){
                $map['time']=array(array('egt',$v['time_start']),array('elt',$v['time_end']));
            }else{
                $map[$k]=$v;
            }
        }
        $list_num=M('sms_record')->where($map)->count();
        return $list_num;
    }
    /**
     * 获取全公司列表
     * @return array|mixed
     */
    public function getAllCompany_list()
    {
        $field=array(
            'c.*',
            'cv.expressage_locker_id'=>'company_id',
            'c.name'=>'company_name'
        );
        $list = M('express')
            ->alias('c')
            ->field($field)
            ->join('LEFT JOIN __EXPRESSAGE_COMPANY_VILLAGE__ cv on c.id=cv.company_id')
            ->where(array('c.status'=>1))
            ->select();
        //$list = M('expressage_company')->where(array('status'=>0))->select();

        foreach ($list as $key=>$value)
        {
            $list[$key]['url'] = U('Express/package_control_news',array('cid'=>$value['company_id']));
        }

        return  $list;
    }

    /**
     * 获取指定快递公司详细信息 传入参数为package表中的cid字段或者是取件码最前面一个数字
     * @author zhukeqin
     * @return array
     */
    public function getCompany_info($cid)
    {
        $field=array(
            'c.*',
            'cv.expressage_locker_id'=>'company_id',
            'c.name'=>'company_name'
        );
        $list = M('express')
            ->alias('c')
            ->field($field)
            ->join('LEFT JOIN __EXPRESSAGE_COMPANY_VILLAGE__ cv on c.id=cv.company_id')
            ->where(array('c.status'=>1,'cv.expressage_locker_id'=>$cid))
            ->find();
        return $list;
    }

    /**
     * 获取包裹详细信息
     * @param $id        包裹id
     * @return mixed
     */
    public function getPackageInfo($id)
    {
        if(empty($this->village_id)){
            $village_info='';
        }else{
            $village_info='and cv.village_id='.$this->village_id;
        }
        $field = array(
            'p.*',
            'c.name'=>'company_name',
            'c.logo',
            'u.name',
            'u.phone',
            'a.realname',
            'user.nickname',
            'user.avatar',
            'user.openid'
        );

        $info = M('package')
            ->alias('p')
            ->field($field)
            ->join('LEFT JOIN __EXPRESSAGE_COMPANY_VILLAGE__ cv on cv.expressage_locker_id=p.cid '.$village_info)
            ->join('LEFT JOIN __EXPRESS__ c on c.id=cv.company_id')
            ->join('LEFT JOIN __EXPRESSAGE_USER__ u on u.pigcms_id=p.aid')
            ->join('LEFT JOIN __ADMIN__ a on a.id=p.admin_id')
            ->join('LEFT JOIN __USER__ user on user.uid=u.uid')
            ->where(array('p.id'=>$id))
            ->find();

        return $info;
    }


    public function getUser_list()
    {

       $field = array(
           'e.*',
           'u.nickname',
           'u.openid',
           'u.avatar'
       );

       $data =  M('expressage_user')
           ->alias('e')
           ->field($field)
           ->join('LEFT JOIN __USER__ u on u.uid=e.uid')
           ->order('active_value desc')
           ->select();

       return $data;
    }
    /**
     * 获取指定用户的详细信息
     * @author zhukeqin
     * @return array
     */
    public function getUser_info($search)
    {
        $map=array();
        foreach ($search as $k=>$v){
            $map['e.'.$k]=$v;
        }
        $field = array(
            'e.*',
            'u.nickname',
            'u.openid',
            'u.avatar'
        );

        $data =  M('expressage_user')
            ->alias('e')
            ->field($field)
            ->join('LEFT JOIN __USER__ u on u.uid=e.uid')
            ->order('active_value desc')
            ->where($map)
            ->find();

        return $data;
    }

    /**
     * 判断该运单号的准确性
     * @param $waybill_number   运单号
     * @param $cid              公司id
     * @return int
     */
    public function waybillNumber_check($waybill_number,$cid)
    {
        return 1;
        if(empty($this->village_id)){
            $village_info='';
        }else{
            $village_info='and cv.village_id='.$this->village_id;
        }
        $single_number=M('express')
            ->alias('c')
            ->join('LEFT JOIN __EXPRESSAGE_COMPANY_VILLAGE__ cv on c.id=cv.company_id '.$village_info)
            ->where('cv.expressage_locker_id='.$cid)
            ->find()['single_number'];
        //$single_number = M('expressage_company')->find($cid)['single_number'];

        $single_number = explode(',',$single_number);


        //步骤一： 正则匹配数字

        if(preg_match("/^\d*$/",$waybill_number))
        {
            //步骤二：必须是该公司订单号的位数

            if(count($single_number)>1)
            {
                if(strlen($waybill_number)==$single_number[0]||strlen($waybill_number)==$single_number[1])
                {
                    return 1;
                }
                else
                {
                    return 3;
                }
            }else{
                if(strlen($waybill_number)==$single_number[0])
                {
                    return 1;
                }
                else
                {
                    return 3;
                }
            }



        }
        else
        {
            //不是数字
            return 2;
        }
    }

    /**
     * 自动邦定微信nickname
     * @param $array
     * @return bool
     */
    public function auto_bind_nickname($array)
    {
        if(is_array($array))
        {

            $count = 0;

            foreach ($array as $value)
            {
                $uid = M('house_village_user_bind')->where(array('phone'=>$value['phone'],'type'=>0))->find()['uid'];

                if($uid)
                {
                    M('expressage_user')->where(array('pigcms_id'=>$value['pigcms_id']))->save(array('uid'=>$uid));

                    $count++;

                }


            }

            return $count;
        }
        else
        {
            return false;
        }
    }


    /**
     * 统计各个公司的包裹数量
     * @return array|bool
     */
    public function count_express_company()
    {
        $start_time = strtotime(date('Y-m'));//本月初

        $end_time = strtotime(date('Y-m-t'));//本月末。

        $map['in_package_time']  = array('between',array($start_time,$end_time));

        $returnArray = array();

        $companyArray = $this->getAllCompany_list();

        if(is_array($companyArray))
        {
            foreach ($companyArray as $value)
            {

                $thisNumber = M('package')->where(array('cid'=>$value['company_id']))->where($map)->count();

//                echo M()->_sql();exit;

                $returnArray[$value['company_name']] = $thisNumber;
            }
        }
        else
        {
           return false;
        }

        return $returnArray;
    }


    /**
     * 获取快递站配置
     * @return mixed
     */
    public function get_config()
    {
        $config=[];

        $configArr = M('config')->where(array('gid'=>36))->field("name,value")->select();
        foreach($configArr as $key=>$value){

            $config[$value['name']] = $value['value'];

        }
        return $config;
    }
    /**
     * 获取指定社区的快递业务的相关配置
     * @author zhukeqin
     * @return array
     */
    public function get_village_config($village_id='')
    {
        if(empty($village_id)){
            $village_config=M('expressage_village_config')->select();
        }else{
            $village_config=M('expressage_village_config')->where(array('village_id'=>$village_id))->find();
        }
        return $village_config;
    }
    /**
     * 更新短信是否成功发送
     * @author zhukeqin
     * @return bool
     */
    public function sms_update(){
        //设定更新初始时间
        $time_start='1522034499';
        //设定最后时间为当前时间前半分钟，防止短信送达时间略微延迟的问题
        $time_end=time()-30;
        $time_finally=time()-60;
        $map['time'] = array(array('egt',$time_start),array('elt',$time_end)) ;
        $map['errcode']='';
        $map['status']=0;
        $sms_list=M('sms_record')->where($map)->select();
        $model=new Sms_aliyunModel();
        foreach ($sms_list as $v){
            //获取短信发送状态详情
            $sms_info=$model->sendSms_query($v['phone'],$v['time'],'1','1',$v['bizid']);
            $sms_return=$sms_info->SmsSendDetailDTOs->SmsSendDetailDTO['0'];
            if($sms_return->SendStatus==3){
                $sms_record=array('time_receive'=>strtotime($sms_return->ReceiveDate),'errcode'=>'success');
            }elseif($sms_return->SendStatus==2){
                $sms_record=array('time_receive'=>strtotime($sms_return->ReceiveDate),'errcode'=>$sms_return->ErrCode,'status'=>1);
                $package=array('status_sms'=>0);
            }elseif($sms_return->SendStatus==1&&$v['time']<$time_finally){
                $sms_record=array('errcode'=>'','status'=>2);
                $package=array('status_sms'=>2);
            }
            if(!empty($sms_record)){
                M('sms_record')->data($sms_record)->where('pigcms_id='.$v['pigcms_id'])->save();
            }
            if(!empty($package)){
                M('package')->data($package)->where('id='.$v['mer_id'])->save();
            }
            unset($sms_record);
            unset($package);
            //dump($sms_record);
        }
        //一小时还没送到设定为超时
        $where=array('status'=>2,'time'=>array('elt',time()-3600));
        $over_list=M('sms_record')->where($where)->select();
        foreach ($over_list as $v){
            //获取短信发送状态详情
            $sms_info=$model->sendSms_query($v['phone'],$v['time'],'1','1',$v['bizid']);
            $sms_return=$sms_info->SmsSendDetailDTOs->SmsSendDetailDTO['0'];
            if($sms_return->SendStatus==3){
                $sms_record=array('time_receive'=>strtotime($sms_return->ReceiveDate),'errcode'=>'success');
            }elseif($sms_return->SendStatus==2){
                $sms_record=array('time_receive'=>strtotime($sms_return->ReceiveDate),'errcode'=>$sms_return->ErrCode,'status'=>1);
                $package=array('status_sms'=>0);
            }elseif($sms_return->SendStatus==1){
                $sms_record=array('time_receive'=>time(),'errcode'=>'overtime','status'=>1);
                $package=array('status_sms'=>0);
            }
            if(!empty($sms_record)){
                M('sms_record')->data($sms_record)->where('pigcms_id='.$v['pigcms_id'])->save();
            }
            if(!empty($package)){
                M('package')->data($package)->where('id='.$v['mer_id'])->save();
            }
            unset($sms_record);
            unset($package);
            //dump($sms_record);
        }
    }

    
}