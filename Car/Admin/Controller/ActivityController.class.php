<?php
namespace Admin\Controller;
//use Think\Controller;
use Admin\Common\RbacController;
class ActivityController extends BaseController {
    
    //活动列表
    public function showlist(){
        //查询所有活动记录信息
         C('LAYOUT_ON',true);
        //针对未过期的活动进行检测，如果已过到期时间，设置为已过期活动
        $ing_act_infos=D('activity')->where(array('is_over'=>'0'))->select();
        $end_act_ids='';    //已结束活动id
        foreach($ing_act_infos as $k=>$v){
            if($v['act_end_time']<=time()){
                $end_act_ids.=',\''.$v['act_id'].'\'';
            }
        }
        $end_act_ids=ltrim($end_act_ids,',');
        if($end_act_ids){
            //执行过期活动状态修改操作
            M()->query("update ".C('DB_PREFIX')."activity set is_over='1' where act_id in (".$end_act_ids.")");
        }

        //只显示未逻辑删除的信息
        $map = array();
        $map['a.is_del'] = array('eq','0');
        if(IS_WECHAT){//微信端 只显示活动进行中与商家活动
            $map['is_over'] = array('eq','0');
            $map['act_type'] = array('eq',2);
        }
        if(session('admin_id')!=1){
            $map['a.cp_lssuer'] = array('eq',session('admin_id'));
        }
        $map['a.garage_id'] = $this->garage_id;
        $act_infos=D('activity')
            ->alias('a')
            ->join('LEFT JOIN __ACTTYPE__ b on a.act_type=b.attp_id')
            ->join('LEFT JOIN __GARAGE__ g on a.garage_id=g.garage_id')
            ->where($map)
            ->limit(500)
            ->select();


        //将数据返回模板
        $this->assign('act_infos',$act_infos);

        //调用模板
        //新建一个模板给微信端用，便于以后修改
        if(IS_WECHAT){
            C('LAYOUT_ON',false);
            echo '<!--微信端-->';
            $this->display('showlist_wechat');
        }else{
            echo '<!--PC端-->';
            $this->display();
        }
    }
    
    //活动添加
    public function add(){
        C('LAYOUT_ON',true);
        //实例化actModel
        $act=new \Admin\Model\ActivityModel();
        if(IS_POST){
            //数据收集
            $data=$act->create();

            //将时间字串转为时间
            $data['act_start_time']=strtotime($data['act_start_time']);
            $data['act_end_time']=strtotime($data['act_end_time']);

            //获取图片存储地址
            if($_FILES['act_poster_img']['error']===0){
                $img_str=$act->upload_one_img($_FILES['act_poster_img']);
                if($img_str){
                    $data['act_poster_img']=$img_str;
                }
            }

            //优惠活动发起人
            $data['cp_lssuer']=session('admin_id'); //对应后台相应的用户id

            //将数据插入到数据库
            $z=$act->add($data);
            if($z){
                $this->success('活动添加成功！',U('showlist'),1);
            }else{
                $this->error('活动添加失败，请检查！',U('add'),1);
            }
            
        }else{

            //查询所有活动类型，并且同时将数据返回模板
            $attp_infos=D('acttype')->select();
            $this->assign('attp_infos',$attp_infos);

            //查询所有优惠类型，并且同时将数据返回模板
            $cptp_infos=D('cptype')->select();
            $this->assign('cptp_infos',$cptp_infos);
            //调用模板
            $this->display();
        }
    }
    
    //活动修改更新
    public function update(){
        C('LAYOUT_ON',true);
        //接收将被操作的记录id
        $act_id=I('get.act_id');
        //实例化actModel
        $act=new \Admin\Model\ActivityModel();
        //查询出该条记录的所有信息
        $act_info=$act->find($act_id);
        //dump(C('SUPPER_ADMIN_LIST'));exit;
        //除非创始人或者超级管理员，或者本活动的发起者，否则禁止对此活动进行此操作
        if($act->founder_superadmin_self($act_info['cp_lssuer'])===false){
            $this->error('抱歉，你无权限执行当前操作！',U('Index/index'),1);
            exit;
        }

        if(IS_POST){
            //数据收集
            $data=$act->create($_POST,2); //进行数据更新，且存在自动完成字段时，务必要这样规范操作写，否则可能会自动完成操作无法完成

            //将时间字串转为时间
            $data['act_start_time']=strtotime($data['act_start_time']);
            $data['act_end_time']=strtotime($data['act_end_time']);

            //获取图片存储地址
            $img_flag=false;
            if($_FILES['act_poster_img']['error']===0){
                $img_str=$act->upload_one_img($_FILES['act_poster_img']);
                if($img_str){
                    $data['act_poster_img']=$img_str;
                    $img_flag=true;
                }
            }

            //将数据更新到数据库
            $z=$act->where(array('act_id'=>$act_id))->save($data);
            if($z){
                if($img_flag){
                    //删除原来的旧图片
                    if(file_exists('./'.$act_info['act_poster_img'])){  //判断该文件是否存在
                        //执行文件删除操作
                        unlink($act_info['act_poster_img']);
                    }
                }
                $this->success('活动信息更新成功！',U('showlist'),1);
            }else{
                $this->error('活动信息更新失败，请检查！',U('update',array('act_id'=>$act_id)),1);
            }
            
        }else{

            //将数据返回到模板
            $this->assign('act_info',$act_info);

            //查询所有活动类型，并且同时将数据返回模板
            $attp_infos=D('acttype')->select();
            $this->assign('attp_infos',$attp_infos);

            //查询所有优惠类型，并且同时将数据返回模板
            $cptp_infos=D('cptype')->select();
            $this->assign('cptp_infos',$cptp_infos);
            
        
            //调用模板
            $this->display();
        }
    }
    
    
    //活动删除(逻辑删除)
    public function delete(){
        //接收要被删除的对应的记录id
        $act_id=I('get.act_id');

        //实例化本model
        $act=new \Admin\Model\ActivityModel();

        //将对应的记录进行逻辑删除，同时判断如果活动为开启状态时将活动设置为已经结束
        $act_info=$act->field('is_over,cp_lssuer')->where(array('act_id'=>$act_id))->find();

        //除非创始人或者超级管理员，或者本活动的发起者，否则禁止对此活动进行此操作
        if($act->founder_superadmin_self($act_info['cp_lssuer'])===false){
            echo 3;
            exit;
        }

        if($act_info['is_over']=='0'){
            $z=$act->where(array('act_id'=>$act_id))->setField(array('is_del'=>'1','is_over'=>'1'));
        }

        if($z){
            echo 1;//逻辑删除操作成功！
        }else{
            echo 2;//逻辑删除操作失败！
        }
    }
    
    
    //活动彻底删除(物理删除，不可恢复！)
    public function destroy(){
        //接收要被删除的对应的记录id
        $act_id=I('get.act_id');

        //实例化本model
        $act=new \Admin\Model\ActivityModel();

        //查询对应的活动信息
        $act_info=$act->field('is_over,cp_lssuer')->where(array('act_id'=>$act_id))->find();

        //除非创始人或者超级管理员，或者本活动的发起者，否则禁止对此活动进行此操作
        if($act->founder_superadmin_self($act_info['cp_lssuer'])===false){
            echo 3;
            exit;
        }

        //将对应的记录进行逻辑删除
        $z=$act->where(array('act_id'=>$act_id))->delete();
        if($z){

            //同时删除活动对应的海报图
            $act_info=$act->where(array('act_id'=>$act_id))->getField('act_poster_img');

            if(file_exists('./'.$act_info)){
                unlink($act_info);
            }

            echo 1;//删除操作成功！
        }else{
            echo 2;//删除操作失败！
        }
    }
    
    
    //活动回收站列表展示
    public function recycle(){
        //查询所有被逻辑删除的车辆信息
        //为了减轻服务器的压力，建议使用条件进行查询，涉及默认全部查询时我们只显示最近500条（后期可设置到配置项）
        $act_infos=D('activity')->where(array('is_del'=>'1'))->limit(500)->select();
        
        //将查询到的数据返回模板
        $this->assign('act_infos',$act_infos);
        
        //调用模板
        $this->display();
    }
    
    
    //活动记录逻辑删除数据恢复
    public function recover(){
        //接收要被恢复的对应的记录id
        $act_id=I('get.act_id');

        //实例化本model
        $act=new \Admin\Model\ActivityModel();

        //查询对应的活动信息
        $act_info=$act->field('is_over,cp_lssuer')->where(array('act_id'=>$act_id))->find();

        //除非创始人或者超级管理员，或者本活动的发起者，否则禁止对此活动进行此操作
        if($act->founder_superadmin_self($act_info['cp_lssuer'])===false){
            echo 3;
            exit;
        }

        //将对应的记录进行恢复
        $z=$act->where(array('act_id'=>$act_id))->save(array('is_del'=>'0'));
        if($z){
            echo 1;//恢复操作成功！
        }else{
            echo 2;//恢复操作失败！
        }
    }
    
    
    //活动信息详情页
    public function detail(){
        //接收对应的act_id
        $act_id=I('get.act_id');

        //实例化本model
        $act=new \Admin\Model\ActivityModel();
        $coupon=new \Admin\Model\CouponModel();
        $payrecord=new \Admin\Model\PayrecordModel();

        //活动名称
        $act_info=$act->find($act_id);
        $act_name=$act_info['act_name'];
        $this->assign('act_name',$act_name);

        //发行商家
        $lssuer_name=M('admin')->where('ad_id='.$act_info['cp_lssuer'])->getField('ad_tname');
        $this->assign('lssuer_name',$lssuer_name);
        
        //优惠类型
        $cp_name=M('cptype')->where('cptp_id='.$act_info['cp_type'])->getField('cptp_name');
        $this->assign('cp_name',$cp_name);
        $this->assign('cp_type',$act_info['cp_type']);

        //优惠额度
        $cp_hilt=$act->where('act_id='.$act_id)->getField('cp_hilt');
        $this->assign('cp_hilt',$cp_hilt);

        //查询当前优惠活动交易总金额
        $arr=$coupon->where(array('act_id'=>$act_id))->select();
        //$c_id=array();//存储活动ID为act_id的所有优惠券id
        $c_id='';//存储活动ID为act_id的所有优惠券id
        foreach ($arr as $k=>$v){
            $c_id.=',\''.$v['cp_id'].'\'';
        }
        if(ltrim($c_id,',')){
            $all_money=$payrecord->where(array('cp_id'=>array('in',$c_id),'pay_status'=>'1'))->sum('payment');
            //dump("select payment from ".C('DB_PREFIX')."payrecord where cp_id in(".ltrim($c_id,',').")");exit;
           // $all_money=M()->query("select payment from ".C('DB_PREFIX')."payrecord where cp_id in(".ltrim($c_id,',').")");
            //dump($all_money);exit;
            //查询实际金额
            $actual_money=$payrecord->where(array('cp_id'=>array('in',$c_id),'pay_status'=>'1'))->sum('pay_loan');
            //优惠总金额
            $cp_money=$all_money-$actual_money;
        }else{
            $all_money=0.00;
            $actual_money=0.00;
            $cp_money=0.00;
        }
        $this->assign('all_money',$all_money);
        $this->assign('actual_money',$actual_money);
        $this->assign('cp_money',$cp_money);

        //当天交易总金额
        $today_zero=strtotime(date('Y-m-d'));//当天凌晨时间戳
        $time=time();//当前时间
        $where['pay_time']=array(array('gt',$today_zero),array('lt',$time));//时间条件
        $where['pay_status']='1';
        $day_money=$payrecord->where($where)->sum('payment');
        $this->assign('day_money',$day_money);

        //当天实际总金额
        $day_act_money=$payrecord->where($where)->sum('pay_loan');
        $this->assign('day_act_money',$day_act_money);

        //当天优惠总金额
        $day_cp_money=$day_money-$day_act_money;
        $this->assign('day_cp_money',$day_cp_money);


        //优惠券发放数量
        $cp_count=$act_info['cp_count'];
        $this->assign('cp_count',$cp_count);

        //优惠券领取数量
        $get_count=$coupon->where('act_id='.$act_id)->count('cp_id');
        $this->assign('get_count',$get_count);

        //优惠券使用数量
        $use_count=$coupon->where(array('act_id'=>$act_id,'is_valid'=>'2'))->count();
        $this->assign('use_count',$use_count);

        //优惠券未使用数量
        $not_use_count=$coupon->where(array('act_id'=>$act_id,'is_valid'=>array('in','0,1')))->count();
        $this->assign('not_use_count',$not_use_count);

        //优惠券使用列表
        $coupon_list=$coupon->where('act_id='.$act_id)->select();
        foreach($coupon_list as $k=>&$v){
            if($v['is_valid']==2){
                $v['pay_time']=M('payrecord')->where(array('cp_id'=>$v['cp_id'],'pay_status'=>'1'))->getField('pay_time');
            }else{
                $v['pay_time']=0;
            }
            if(empty($v['car_no'])){
                $user_name=M('user')->where('user_id='.$v['user_id'])->getField('user_name');
            }
        }
        unset($v);
        $this->assign('coupon_list',$coupon_list);
        $this->assign('user_name',$user_name);
        layout(true);
        //调用模板
        $this->display();
    }

    //取消活动
    public function act_away(){
        //接收要取消活动对应的id
        $act_id=I('post.act_id');

        //实例化本model
        $act=new \Admin\Model\ActivityModel();

        //查询对应的活动信息
        $act_info=$act->field('is_over,cp_lssuer')->where(array('act_id'=>$act_id))->find();

        //除非创始人或者超级管理员，或者本活动的发起者，否则禁止对此活动进行此操作
        if($act->founder_superadmin_self($act_info['cp_lssuer'])===false){
            echo 3;
            exit;
        }

        //执行取消操作
        $z=$act->where('act_id='.$act_id)->setField(array('is_over'=>'1'));
        if($z){
            echo 1;   //取消活动成功！
        }else{
            echo 2;   //取消活动失败
        }
    }

    //开启活动
    public function act_start_up(){
        //接收要取消活动对应的id
        $act_id=I('post.act_id');
        //时间不满足恢复活动条件，禁止恢复！
        if(I('post.act_end_time') && I('post.act_end_time')<=time()){
            echo 3;
            exit;
        }

        //实例化本model
        $act=new \Admin\Model\ActivityModel();

        //查询对应的活动信息
        $act_info=$act->field('is_over,cp_lssuer')->where(array('act_id'=>$act_id))->find();

        //除非创始人或者超级管理员，或者本活动的发起者，否则禁止对此活动进行此操作
        if($act->founder_superadmin_self($act_info['cp_lssuer'])===false){
            echo 4;
            exit;
        }

        //执行取消操作
        $z=$act->where('act_id='.$act_id)->setField(array('is_over'=>'0'));
        if($z){
            echo 1;   //取消活动成功！
        }else{
            echo 2;   //取消活动失败
        }
    }
}
























