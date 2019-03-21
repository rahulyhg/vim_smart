<?php
namespace Home\Controller;
use Think\Controller;
class CarController extends Controller {

    static $my_garage;

    //选择停车场
    public function choose_garage(){
        //最高优先判断系统异常状态，0：系统正常，往下进行。1：系统异常，进入问题页面。
        $web_state = M('config')->where(array('name'=>'problem_state'))->find();
        if($web_state['value'] == 1){
            header("Location:".C("WEB_DOMAIN")."/index.php?s=/Home/problem/index.html");
        }

        //先判断用户是否已经登录
        if(!session('user_id')) {
            //如果未登录，先登录
            $user=new \Home\Model\UserModel();
            $user->login();
        }

        //所有停车场信息
        $garage_array = M('garage')->where(array('is_del'=>array('eq','0')))->select();
        //dump(M()->_sql());exit;
        $this->assign('garage_array',$garage_array);
        $this->display();


    }



    //我要停车
    public function use_service(){


        $web_state = M('config')->where(array('name'=>'problem_state'))->find();
        if($web_state['value'] == 1){
            header("Location:".C("WEB_DOMAIN")."/index.php?s=/Home/problem/index.html");
        }

        //实例化carModel
        $car=new \Home\Model\CarModel();

        //先判断用户是否已经登录
        if(!session('user_id')) {
            //如果未登录，先登录
            $user=new \Home\Model\UserModel();
            $user->login();
        }

        //dump($_SESSION);exit;

        if(IS_POST){

           //$_POST['c_no']=$this->jieshu_plate($_POST['c_no']);
            if( !$_POST['c_no'] ){
                $this->error('请输入车牌号',U('binding_car'),1);
            }

            //判断是否为点击（用户选择前缀）录入的车牌信息

            if( isset($_POST['car_no_pre']) ){
                $car_no_pre=I('post.car_no_pre'); //车牌号前缀
                $car_no=I('post.c_no'); //后五位车牌号
                $car_no=$car_no_pre.$car_no;
            }else{
                $car_no=I('post.c_no');
            }

            if(!session('garage_id')){
                $this->error('请选择想绑定的停车场',U('choose_garage'));
            }

            //把更换停车场信息更新到数据库
            $this->updata_user(session('user_id'),session('garage_id'));

            //停车场相关信息
            $garage_array = M('garage')->where(array('garage_id'=>session('garage_id')))->find();
            $this->assign('garage_array',$garage_array);

            //制作符合捷迅的车牌
            $car_no = $this->jieshu_plate($car_no);
            $car_insert_info=$car->create();
            $car_insert_info['car_no']=$car_no;
            $car_insert_info['user_id']= session('user_id');
            $car_insert_info['garage_id'] = session('garage_id');
            //查看当前停车场中是否该车已入场，如果未入场，禁止绑定
            $service=new \Home\Controller\ServicerecordController();
            $garage_exists_car_info=$service->new_record($car_no);


            if($garage_exists_car_info['result_code']==14){
                //精确查询到车辆信息，并且已经成功生成停车记录和订单，在进行车辆绑定操作后直接跳转到订单详情页
                $this->binding_car_no($car_no,$car_insert_info);
                header("Location:".C('WEB_DOMAIN')."/index.php?m=Home&c=Payrecord&a=order_detail&pay_id=".$garage_exists_car_info['pay_record']."&car_no=".$garage_exists_car_info['car_no']);

            }elseif($garage_exists_car_info['result_code']==13){
                //精确查询到车辆信息，【并且已经存在停车记录和订单】，在进行车辆绑定操作后直接跳转到订单详情页
                //if($this->binding_car_no($car_no,$car_insert_info)){
                $this->binding_car_no($car_no,$car_insert_info);
                header("Location:".C('WEB_DOMAIN')."/index.php?m=Home&c=Payrecord&a=order_detail&pay_id=".$garage_exists_car_info['pay_record']."&car_no=".$garage_exists_car_info['car_no']);

            }elseif($garage_exists_car_info['result_code']==12){
                //无法精确查询，返回模糊查询结果
                $this->assign('result_msg','请选择您的车牌进行绑定');
                $this->assign('result_datas',$this->normal_plate($car_no));
                $this->display();
            }elseif($garage_exists_car_info['result_code']==11){
                //停车场中目前不存在此车辆，禁止绑定和生成订单
                $this->assign('result_msg','场外绑定车辆');
                $this->assign('result_datas',$this->normal_plate($car_no));
                $this->display();
            }elseif($garage_exists_car_info['result_code']==1){
                //停车场中目前不存在此车辆，禁止绑定和生成订单
                $this->assign('result_msg','场外绑定车辆');
                $this->assign('result_datas',$this->normal_plate($car_no));
                $this->display();
            }else{
                //servicere出错
                $this->assign('result_msg','网络繁忙请重试！');
                $this->assign('result_datas',$car_no);
                $this->display();
            }

        }else{
            $this->assign('web_url',C('WEB_DOMAIN'));

            //检查是否存在停车场id
            $garage_id =I('get.garage_id');
            if(empty($garage_id)&&empty(session('garage_id'))){
                //先行判断是否为停车场用户
                $is_bind = $car->check_user_bind_car(session('user_id'));
                //dump($is_bind);exit;
                if($is_bind){
                    session('garage_id',self::$my_garage?:2);
                }else{
                    $this->redirect('Home/car/choose_garage');
                }
            }elseif (!empty($garage_id)&&empty(session('garage_id'))){
                session('garage_id',$garage_id);
                self::$my_garage = $garage_id;
            }elseif (!empty($garage_id)&&!empty(session('garage_id'))){
                if($garage_id!=session('garage_id')) session('garage_id',$garage_id);
            }

            //把更换停车场信息更新到数据库
            $this->updata_user(session('user_id'),session('garage_id'));

            //根据停车场id查询停车场信息
            $garage_array = M('garage')->where(array('garage_id'=>session('garage_id')))->find();
            //将查询出的捷顺接口使用的park存入session
            session('garage_no',$garage_array['garage_no']);
            //dump($_SESSION);exit;
            $this->assign('garage_array',$garage_array);

            //查询当前用户的名下车辆(只查车牌号)
            $car_infos=$car->where(array('user_id'=>session('user_id'),'garage_id'=>session('garage_id')))->field('car_no')->select();
            foreach ($car_infos as &$v){
                $user_view_car_no = $this->normal_plate($v['car_no']);
                $v['car_no']=$user_view_car_no;
            }
            unset($v);
            //将车牌返回模板
            $default_meg='暂无绑定车辆';
            if($car_infos){
                $this->assign('car_infos',$car_infos);
                $this->assign('show_spell',1);  //是否显示解绑提示
                $default_meg='已绑定车辆<span><img src="http://www.hdhsmart.com/Car/Home/Public/image/down.png" style="width:15px; height:15px; margin-left:3px; margin-top:-1px;"/></span>';
            }

            //改变模板右上角【车辆绑定/我的车辆】字样
            if(count($car_infos)>0){
                $this->assign('left_top_msg','1');
            }

            //接收其它控制器的错误信息
            if(I('get.error_msg')){
                //如果存在其它控制器错误信息，优先显示其它控制器的错误信息
                $this->assign('result_msg',I('get.error_msg'));
            }else{
                //否则显示本页面的信息
                $this->assign('result_msg',$default_meg);
            }

            $this->assign('user_info',M('user')->find(session('user_id')));
            $this->display();
        }
    }


    //切换停车场后更新用户表信息
    public function updata_user($user_id,$garage_id) {
        $spare_garage_id = D('user','smart_')->where(array('user_id'=>$user_id))->getField('spare_garage_id');
        if ($garage_id != $spare_garage_id) {
            D('user','smart_')->where(array('user_id'=>$user_id))->save(array('spare_garage_id'=>$garage_id));
        }

    }

    //测试
    //我要停车
    public function use_service_two(){

        $web_state = M('config')->where(array('name'=>'problem_state'))->find();
        if($web_state['value'] == 1){
            header("Location:".C("WEB_DOMAIN")."/index.php?s=/Home/problem/index.html");
        }

        //实例化carModel
        $car=new \Home\Model\CarModel();

        //先判断用户是否已经登录
        if(!session('user_id')) {
            //如果未登录，先登录
            $user=new \Home\Model\UserModel();
            $user->login();
        }

        //dump($_SESSION);exit;

        if(IS_POST){

            //$_POST['c_no']=$this->jieshu_plate($_POST['c_no']);
            if( !$_POST['c_no'] ){
                $this->error('请输入车牌号',U('binding_car'),1);
            }

            //判断是否为点击（用户选择前缀）录入的车牌信息

            if( isset($_POST['car_no_pre']) ){
                $car_no_pre=I('post.car_no_pre'); //车牌号前缀
                $car_no=I('post.c_no'); //后五位车牌号
                $car_no=$car_no_pre.$car_no;
            }else{
                $car_no=I('post.c_no');
            }

            if(!session('garage_id')){
                $this->error('请选择想绑定的停车场',U('choose_garage'));
            }

            //停车场相关信息
            $garage_array = M('garage')->where(array('garage_id'=>session('garage_id')))->find();
            $this->assign('garage_array',$garage_array);

            //制作符合捷迅的车牌
            $car_no = $this->jieshu_plate($car_no);
            $car_insert_info=$car->create();
            $car_insert_info['car_no']=$car_no;
            $car_insert_info['user_id']= session('user_id');
            $car_insert_info['garage_id'] = session('garage_id');
            //查看当前停车场中是否该车已入场，如果未入场，禁止绑定
            $service=new \Home\Controller\ServicerecordController();
            $garage_exists_car_info=$service->new_record($car_no);


            if($garage_exists_car_info['result_code']==14){
                //精确查询到车辆信息，并且已经成功生成停车记录和订单，在进行车辆绑定操作后直接跳转到订单详情页
                $this->binding_car_no($car_no,$car_insert_info);
                header("Location:".C('WEB_DOMAIN')."/index.php?m=Home&c=Payrecord&a=order_detail_two&pay_id=".$garage_exists_car_info['pay_record']."&car_no=".$garage_exists_car_info['car_no'])."&garage_id=".session('garage_id');

            }elseif($garage_exists_car_info['result_code']==13){
                //精确查询到车辆信息，【并且已经存在停车记录和订单】，在进行车辆绑定操作后直接跳转到订单详情页
                //if($this->binding_car_no($car_no,$car_insert_info)){
                $this->binding_car_no($car_no,$car_insert_info);
                header("Location:".C('WEB_DOMAIN')."/index.php?m=Home&c=Payrecord&a=order_detail_two&pay_id=".$garage_exists_car_info['pay_record']."&car_no=".$garage_exists_car_info['car_no'])."&garage_id=".session('garage_id');

            }elseif($garage_exists_car_info['result_code']==12){
                //无法精确查询，返回模糊查询结果
                $this->assign('result_msg','请选择您的车牌进行绑定');
                $this->assign('result_datas',$this->normal_plate($car_no));
                $this->display();
            }elseif($garage_exists_car_info['result_code']==11){
                //停车场中目前不存在此车辆，禁止绑定和生成订单
                $this->assign('result_msg','场外绑定车辆');
                $this->assign('result_datas',$this->normal_plate($car_no));
                $this->display();
            }else{
                //servicere出错
                $this->assign('result_msg','网络繁忙请重试！');
                $this->assign('result_datas',$car_no);
                $this->assign('garage_id',session('garage_id'));
                $this->display();
            }

        }else{
            $this->assign('web_url',C('WEB_DOMAIN'));

            //检查是否存在停车场id
            $garage_id =I('get.garage_id');
            if(empty($garage_id)&&empty(session('garage_id'))){
                //先行判断是否为停车场用户
                $is_bind = $car->check_user_bind_car(session('user_id'));
                //dump($is_bind);exit;
                if($is_bind){
                    session('garage_id',self::$my_garage?:2);
                }else{
                    $this->redirect('Home/car/choose_garage');
                }
            }elseif (!empty($garage_id)&&empty(session('garage_id'))){
                session('garage_id',$garage_id);
                self::$my_garage = $garage_id;
            }elseif (!empty($garage_id)&&!empty(session('garage_id'))){
                if($garage_id!=session('garage_id')) session('garage_id',$garage_id);
            }

            //根据停车场id查询停车场信息
            $garage_array = M('garage')->where(array('garage_id'=>session('garage_id')))->find();
            //将查询出的捷顺接口使用的park存入session
            session('garage_no',$garage_array['garage_no']);
            //dump($_SESSION);exit;
            $this->assign('garage_array',$garage_array);

            //查询当前用户的名下车辆(只查车牌号)
            $car_infos=$car->where(array('user_id'=>session('user_id'),'garage_id'=>session('garage_id')))->field('car_no')->select();
            foreach ($car_infos as &$v){
                $user_view_car_no = $this->normal_plate($v['car_no']);
                $v['car_no']=$user_view_car_no;
            }
            unset($v);
            //将车牌返回模板
            $default_meg='暂无绑定车辆';
            if($car_infos){
                $this->assign('car_infos',$car_infos);
                $this->assign('show_spell',1);  //是否显示解绑提示
                $default_meg='已绑定车辆<span><img src="http://www.hdhsmart.com/Car/Home/Public/image/down.png" style="width:15px; height:15px; margin-left:3px; margin-top:-1px;"/></span>';
            }

            //改变模板右上角【车辆绑定/我的车辆】字样
            if(count($car_infos)>0){
                $this->assign('left_top_msg','1');
            }

            //接收其它控制器的错误信息
            if(I('get.error_msg')){
                //如果存在其它控制器错误信息，优先显示其它控制器的错误信息
                $this->assign('result_msg',I('get.error_msg'));
            }else{
                //否则显示本页面的信息
                $this->assign('result_msg',$default_meg);
            }
            $this->assign('garage_id',session('garage_id'));
            $this->assign('user_info',M('user')->find(session('user_id')));
            $this->display();
        }
    }


    /*
     * 微信快捷登陆测试方法
     * 2017.1.22
     * 陈琦
     */
    public function use_service_test(){
        if(!session('user_id')){
            $user=new \Home\Model\UserModel();
            $user->login_test();
        }
        $car=new \Home\Model\CarModel();
        session('garage_id',2);
        if(IS_POST){


            if( !$_POST['c_no'] ){
                $this->error('请输入车牌号',U('binding_car'),1);
            }

            //判断是否为点击（用户选择前缀）录入的车牌信息

            if( isset($_POST['car_no_pre']) ){
                $car_no_pre=I('post.car_no_pre'); //车牌号前缀
                $car_no=I('post.c_no'); //后五位车牌号
                $car_no=$car_no_pre.$car_no;
            }else{
                $car_no=I('post.c_no');
            }

            if($_POST['garage_id']){
                session('garage_id',I('post.garage_id')); //如果启用自动定位或者手动定位停车场时
            }else{
                session('garage_id',2); //默认的停车场
            }

            $car_insert_info=$car->create();
            $car_insert_info['car_no']=$car_no;
            $car_insert_info['user_id']= session('user_id');

            //查看当前停车场中是否该车已入场，如果未入场，禁止绑定
            $service=new \Home\Controller\ServicerecordController();
            $garage_exists_car_info=$service->new_record($car_no);


            if($garage_exists_car_info['result_code']==14){
                //精确查询到车辆信息，并且已经成功生成停车记录和订单，在进行车辆绑定操作后直接跳转到订单详情页
                $this->binding_car_no($car_no,$car_insert_info);
                header("Location:".C('WEB_DOMAIN')."/index.php?m=Home&c=Payrecord&a=order_detail&pay_id=".$garage_exists_car_info['pay_record']."&car_no=".$garage_exists_car_info['car_no']);

            }elseif($garage_exists_car_info['result_code']==13){
                //精确查询到车辆信息，【并且已经存在停车记录和订单】，在进行车辆绑定操作后直接跳转到订单详情页
                //if($this->binding_car_no($car_no,$car_insert_info)){
                $this->binding_car_no($car_no,$car_insert_info);
                header("Location:".C('WEB_DOMAIN')."/index.php?m=Home&c=Payrecord&a=order_detail&pay_id=".$garage_exists_car_info['pay_record']."&car_no=".$garage_exists_car_info['car_no']);

            }elseif($garage_exists_car_info['result_code']==12){
                //无法精确查询，返回模糊查询结果
                $this->assign('result_msg','请选择您的车牌进行绑定');
                $this->assign('result_datas',$car_no);
                $this->display();
            }elseif($garage_exists_car_info['result_code']==11){
                //停车场中目前不存在此车辆，禁止绑定和生成订单
                $this->assign('result_msg','场外绑定车辆');
                $this->assign('result_datas',$car_no);
                $this->display();
            }else{
                //servicere出错
                $this->assign('result_msg','网络繁忙请重试！');
                $this->assign('result_datas',$car_no);
                $this->display();
            }

        }else{

            //查询当前用户的名下车辆(只查车牌号)
            $car_infos=$car->where(array('user_id'=>session('user_id')))->field('car_no')->select();
            //将车牌返回模板
            $default_meg='暂无绑定车辆';
            if($car_infos){
                $this->assign('car_infos',$car_infos);
                $this->assign('show_spell',1);  //是否显示解绑提示
                $default_meg='已绑定车辆<span><img src="http://www.hdhsmart.com/Car/Home/Public/image/down.png" style="width:15px; height:15px; margin-left:3px; margin-top:-1px;"/></span>';
            }

            //改变模板右上角【车辆绑定/我的车辆】字样
            if(count($car_infos)>0){
                $this->assign('left_top_msg','1');
            }

            //接收其它控制器的错误信息
            if(I('get.error_msg')){
                //如果存在其它控制器错误信息，优先显示其它控制器的错误信息
                $this->assign('result_msg',I('get.error_msg'));
            }else{
                //否则显示本页面的信息
                $this->assign('result_msg',$default_meg);
            }
            $this->display();
        }
    }

    //判断车库中是否存在此车辆
    public function api_check_car_is_in(){

        $car_no=I('post.car_no6');
        $car_no=$this->jieshu_plate($car_no);
        if($car_no){
            //查看当前停车场中是否该车已入场
            $service=new \Home\Controller\ServicerecordController();
            $garage_exists_car_info=$service->new_record($car_no);
            if($garage_exists_car_info['result_code']==13 || $garage_exists_car_info['result_code']==14){
                //同时判断该车辆是否已经本当前用户绑定
                $car=new \Home\Model\CarModel();
                $z=$car->where(array('car_no'=>$car_no,'user_id'=>session('user_id')))->find();
                if(!$z){
                    echo json_encode(1);
                }
            }
        }
    }


    public function binding_car_no($car_no,$car_insert_info){
        $car_no=$this->jieshu_plate($car_no);
        //实例化carModel
        $car=new \Home\Model\CarModel();

        //将车辆信息录入到车辆信息表中
        //先查询车辆信息表中是否已经存在
        $this_car_no_is_exists=$car->where(array('car_no'=>$car_no,'user_id'=>session('user_id'),'garage_id'=>session('garage_id')))->find();

        //判断此车辆是否为月卡车
        if($this->this_car_is_yueka($car_no)){
            $car_insert_info['car_role']='1';   //标记为月卡车
        }

        //只要此用户未绑定过此车辆就进行绑定
        if($this_car_no_is_exists['user_id']!=session('user_id')){
            $car->add($car_insert_info);    //将数据插入数据库
        }
    }

    public function check_card_is_binding(){
        //接收车牌号
        $car_no=I('post.car_no4');
        $car_no=$this->jieshu_plate($car_no);
        if($car_no){
            //实例化carModel
            $car=new \Home\Model\CarModel();
            $z=$car->where(array('car_no'=>$car_no,'user_id'=>session('user_id'),'garage_id'=>session('garage_id')))->find();
            if($z){
                echo json_encode(1);
            }else{
                echo json_encode(2);
            }
        }
    }

    //通过ajax异步绑定车牌
    public function ajax_binding_car(){
        //接收车牌号
        $car_no=I('post.car_no3');
        $garage_id = I('post.garage_id');
        $car_no=$this->jieshu_plate($car_no);
        if($car_no){
            //实例化carModel
            $car=new \Home\Model\CarModel();
            $insert_datas=array(
                'car_no'=>$car_no,
                'user_id'=>session('user_id'),
                'add_time'=>time(),
                'garage_id'=>$garage_id
            );
            //判断此车辆是否为月卡车
            if($this->this_car_is_yueka($car_no)){
                $insert_datas['car_role']='1';  //标记为月卡
            }

            $z=$car->add($insert_datas);    //将数据插入数据库
            if($z){
                echo json_encode(1);
            }else{
                echo json_encode(2);
            }
        }

    }

    //通过ajax判断车辆是否在停车场内，如果在场，通知跳转订单详情，如果不在场提示不在场内！
    public function ajax_is_go_order_detail(){
        //接收车牌号
        $car_no=I('post.car_no2');
        $car_no=$this->jieshu_plate($car_no);
        if($car_no){
            //实例化server
            $server=new \Home\Controller\ServicerecordController();
            $z=$server->new_record($car_no);

            if($z['result_code']=='13' || $z['result_code']=='14'){
                echo json_encode($z); //返回订单id
            }elseif($z['result_code']=='17'){
                echo json_encode(2);
            }else{
                echo json_encode(4);
            }
        }else{
            echo json_encode(3);
        }
    }


    //判断车辆是否为月卡车
    protected function this_car_is_yueka($car_no){
        //判断此车辆是否为月卡车
        //实例化第三方接口(捷顺)Model
        $car_no=$this->jieshu_plate($car_no);
        $jieshun=new \Org\JieShunApi\Jieshun();
        $api_order_info=$jieshun->api_make_order($car_no);  //获取第三方订单信息
        if($api_order_info['dataItems'][0]['attributes']['retmsg']=='非临时车'){
            return true;
        }else{
            return false;
        }
    }


    //待解绑车牌列表
    public function maybe_spell_showlist(){
        $car=new \Home\Model\CarModel();
        $car_arr=$car->query_carno_by_uid(session('user_id'));
        if($car_arr){
            $this->assign('result_msg','点击车牌解绑');
            $this->assign();
        }else{
            header("Location:".C('WEB_DOMAIN')."/index.php?m=Home&c=Car&a=use_service&error_msg=暂无绑定车牌");
        }
        //调用模板
        $this->display();
    }


    //ajax解绑车牌
    public function spell_binding_c(){
        //接收要进行解绑的车牌号
        $car_no=I('post.car_no2');
        $car_no=$this->jieshu_plate($car_no);
        $car=new \Home\Model\CarModel();
        if($car->spell_binding_m(session('user_id'),$car_no,session('garage_id'))){
            echo 1;   //解绑成功！
        }else{
            echo 2; //解绑失败！
        }

    }


    //PC打开微信端测试方法
    public function pc_test(){
    //先判断用户是否已经登录
        session('user_id',33);
    }


    //月卡车辆时间新增
    /*
    protected function add_yueka(){
        //实例化捷顺接口
        $jieshun=new \Org\JieShunApi\Jieshun();
        $can_no="鄂-APS693";
        $month=0;
        $money=0.00;
        $newBeginDate="2017-01-09";
        $newEndDate="2017-01-10";
        $result=$jieshun->yueka_add_time($can_no,$month,$money,$newBeginDate,$newEndDate);
        dump($result);
    }
    */

    /*车牌人类视觉习惯显示
     * @author 祝君伟
     * @time 2017.2.10
     * */
    public function normal_plate($car_no_array){
        $user_view_car_no=str_replace('-','',$car_no_array);
        $car_no_pre=mb_substr($user_view_car_no,0,2,'utf-8');
        $car_no_after=mb_substr($user_view_car_no,2,6,'utf-8');
        $user_view_car_no=$car_no_pre.'-'.$car_no_after;
        $user_view_car_no=strtoupper($user_view_car_no);
        return $user_view_car_no;
    }

    /*车牌适应捷顺接口规则方法
     *@author 祝君伟
     * @time 2017.2.10
     * */
    public function jieshu_plate($car_no_array){
        $user_view_car_no=str_replace('-','',$car_no_array);
        $car_no_pre=mb_substr($user_view_car_no,0,1,'utf-8');
        $car_no_after=mb_substr($user_view_car_no,1,6,'utf-8');
        $user_view_car_no=$car_no_pre.'-'.$car_no_after;
        $user_view_car_no=strtoupper($user_view_car_no);
        return $user_view_car_no;
    }


    /*
     * 微信前端进入停车场后台系统
     * 陈琦
     * 2017.2.10
     */
    public function wx_login(){
        $user=new \Home\Model\UserModel();
        $res=$user->login();//获取用户基本信息
        $user_info=M('user')->where(array('user_wx_opid'=>$_SESSION['openid']))->find();//在user表中查询是否存在人员
        if($user_info){//若存在，则去判断在admin表中是否存在该人
            $arr = M('admin')->field('ad_uid,ad_id')->select();//获取表中uid和主键id
            $all_uid = array();
            foreach ($arr as $k => $v) {
                $all_uid = explode(',', $v['ad_uid']);//拆分uid
                if (in_array($user_info['user_id'], $all_uid)) {//判断当前openid是否在表中存在
                    $sea = M('admin')->where(array('ad_id' => $v['ad_id']))->find();
                    session('admin_id', $sea['ad_id']);
                    session('admin_name', $sea['ad_name']);
                }
            }
        }
        header("location:".C('WEB_DOMAIN')."/index.php?s=/Admin/Login/admlogin.html");
    }


    /*
     * 向相关人员发送异常报告
     * */
    public function warning_msg_send(){
        $warning_name = I('post.warning_name');
        $this->warning_data_add('ajax_is_go_order_detail','Car','1325','504',$warning_name);
    }

    /*
	 * 封装方法，处理警报流程一，入表
	 * 警报反馈机制
	 * */
    protected function warning_data_add($action,$control,$encode,$result,$warning_name){
        //根据act和con来获得系统名称
        $system_array = M()->table('pigcms_system_control')->where(array('system_act'=>$action,'system_con'=>$control))->find();
        $data = array(
            'system_id'=>$system_array['pigcms_id'],
            'warning_encoding'=>$encode,
            'warning_result'=>$result,
            'warning_name'=>$warning_name,
            'create_time'=>time()
        );
        $result_code = M()->table('pigcms_system_warning_control')->data($data)->add();
        $admin_user = explode(",",$system_array['user_wx_opid']);
        $warn_info = array(
            'first_value'=>$system_array['system_name'].'发生错误！！！',
            'keyword1_value'=>$warning_name,
            'keyword2_value'=>'用户将无法使用该系统的功能',
            'remark_value'=>'请开发者和错误处理人员尽快查看出错位置以便解决！'
        );
        if($result_code){
            //发送消息
            $res =array();
            foreach ($admin_user as $value){//
                $time = time();
                $data=array(
                    'touser'=>$value,
                    'template_id'=>"31Q6rbAa0NQdVuFMH6oyYwdSdOEwQ7aYQuM1d5fXQEk",
                    'data'=>array(
                        'first'=>array(
                            'value'=>urlencode($warn_info['first_value']),
                            'color'=>"#029700",
                        ),
                        'keyword1'=>array(
                            'value'=>urlencode($warn_info['keyword1_value']),
                            'color'=>"#000000",
                        ),
                        'keyword2'=>array(
                            'value'=>urlencode($warn_info['keyword2_value']),
                            'color'=>"#000000",
                        ),
                        'keyword3'=>array(
                            'value'=>urlencode(date('Y-m-d H:i:s',$time)),
                            'color'=>"#000000",
                        ),
                        'remark'=>array(
                            'value'=>urlencode($warn_info['remark_value']),
                            'color'=>"#000000",
                        ),
                    )
                );
                $weixin=new \Org\Weixinpay\Weixinpay();
                $res[] = $weixin->send_template_message(urldecode(json_encode($data)));
            }
            if($res[0]['errmsg']=='ok'){
                return true;
            }else{
                return false;
            }
        }else{
            //入库失败
            return false;
        }
    }



}