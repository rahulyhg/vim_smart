<?php
namespace Admin\Controller;
//use Think\Controller;
use Admin\Common\RbacController;
use Admin\Model\UserModel;
use Think\Page;

class UserController extends RbacController {
    
    //用户信息列表
    public function showlist_bak(){
        //查询所有用户信息
        //为了减轻服务器的压力，建议使用条件进行查询，涉及默认全部查询时我们只显示最近500条（后期可设置到配置项）
        //只显示未逻辑删除的信息
        //实例化本model
        $user=new \Admin\Model\UserModel();
        $user_infos=$user->where(array('is_del'=>'0'))->order('user_id desc')->limit(500)->select();
        $role_array = M('role')->select();
        //查询所有用户车牌号和车牌对应的id，并将其数据返回模板
        $car_infos=$user->query_car_no_id($user_infos);
        $this->assign('car_infos',$car_infos);
        $this->assign('role_array',$role_array);

        //将数据返回模板
        $this->assign('user_infos',$user_infos);
        
        //调用模板
        $this->display();
    }

    /**
     * 用户信息列表 后台分页
     * @update-time: 2017-05-24 16:48:07
     * @author: 王亚雄
     */
    public function showlist(){
        $model = new UserModel();
        //字段
        $field = array(
            'u.user_id',
            'u.user_wxnik',
            'u.user_phone',
            'group_concat(car.car_id)'=>'car_ids',
            'group_concat(car.car_no)'=>'car_nos',
            'u.user_role_id',
            'r.role_name',
            'u.add_time'
        );
        //条件
        $map = array();
        //搜索条件
        $get = search_filter($_GET);
        //搜索车主与车牌
        isset($get['keywords']) && $map['u.user_wxnik|car.car_no|user_phone'] = array("like",'%' . $get['keywords'] . '%');
        //搜索性别
        isset($get['sex']) && $map['u.user_sex'] = array('eq',$get['sex']);
        $map['car.garage_id'] = array('eq',$this->garage_id);
        //总条数
        $count = $model->alias('u')
            ->field('count(u.user_id)')
            ->join('left join __CAR__ car on car.user_id = u.user_id')
            ->join('left join __ROLE__ r on u.user_role_id = r.role_id')
            ->group('u.user_id')
            ->where($map)
            ->select(false);
        //由于使用了group，总条数为
        $count = $model->query("select count(*) as count from ($count) as c")[0]['count'];

        $page = new Page($count,I('get.list_rows','0','int')?:LIST_ROWS);

        $list = $model->alias('u')
            ->field($field)
            ->join('left join __CAR__ car on car.user_id = u.user_id')
            ->join('left join __ROLE__ r on u.user_role_id = r.role_id')
            ->where($map)
            ->limit($page->firstRow,$page->listRows)
            ->group('u.user_id')
            ->order('u.user_id desc')
            ->select();

        foreach($list as $key=>&$row){
            $row['car_nos_array'] = array_combine(
                explode(',',$row['car_ids']),
                explode(',',$row['car_nos'])
            );
        }
        $this->assign('list',$list);
        $this->assign('pageStr',bootstrap_page_style($page->show()));
        $this->display();


    }
    
    //用户注册(添加)
    public function add(){
        //实例化UserModel
        $user=new \Admin\Model\UserModel();
        if(IS_POST){
            
            //处理密码
            if( empty($_POST['user_pwd1']) || $_POST['user_pwd1']!==$_POST['user_pwd2'] ){
                $this->error('两次输入的密码不一致',U('add'),1);
            }
            
            //数据收集
            $data=$user->create();
            
            $data['user_pwd']=md5($_POST['user_pwd1']);//密码字段赋值
            
            //数据处理并操作数据库函数
            $z=$user->get_and_add($data,$_FILES);
            
            if($z){
                $this->success('用户注册成功！',U('showlist'),1);
            }else{
                $this->error('用户注册失败，请检查！',U('add'),1);
            }
            
        }else{
        
            //调用模板
            $this->display();
        }
    }
    
    //用户信息修改更新
    public function update(){
        //接收将被操作的记录id
        $uid=I('get.uid');
        //实例化CarModel
        $user=new \Admin\Model\UserModel();
        if(IS_POST){
            
            //处理密码
            if($_POST['user_pwd1']!==$_POST['user_pwd2'] ){
                $this->error('两次输入的密码不一致',U('add'),1);
            }
            
            //数据收集
            $data=$user->create($_POST,2); //进行数据更新，且存在自动完成字段时，务必要这样规范操作写，否则可能会自动完成操作无法完成
            //dump($data);exit;
            if(!empty($_POST['user_pwd1'])){ //如果存在密码重置，依旧要进行密码字段加密
                $data['user_pwd']=md5($_POST['user_pwd1']);//密码字段赋值
            }
            
            if($_POST['old_user_logo']){
                $data['old_user_logo']=$_POST['old_user_logo']; //如果存在就头像，记录原来的旧头像
            }
            //dump($_FILES);exit;
            //数据处理并操作数据库函数
            $z=$user->get_and_update($uid,$data,$_FILES);
            
            if($z){
                $this->success('用户信息更新成功！',U('showlist'),1);
            }else{
                $this->error('用户信息更新失败，请检查！',U('update',array('uid'=>$uid)),1);
            }
            
        }else{
            //查询出该条记录的所有信息
            $user_info=$user->find($uid);
            //对车牌号字段进行数据二次制作
            $user_info['car_nos']=$user->car_no_str_to_arr($user_info['car_nos']);//处理后为数组
            $role_array = M('role')->select();
            //将数据返回到模板
            $this->assign('user_info',$user_info);
            $this->assign('role_array',$role_array);
            
        
            //调用模板
            $this->display();
        }
    }
    
    
    //用户删除(逻辑删除)
    public function delete(){
        //接收要被删除的对应的记录id
        $uid=I('get.uid');
        //将对应的记录进行逻辑删除
        $z=D('user')->where(array('user_id'=>$uid))->save(array('is_del'=>'1'));
        if($z){
            echo json_encode('1');//逻辑删除操作成功！
        }else{
            echo json_encode('2');//逻辑删除操作失败！
        }
    }
    
    
    //用户彻底删除(物理删除，不可恢复！)
    public function destroy(){
        //接收要被删除的对应的记录id
        $uid=I('get.uid');
        
        //实例化UserModel
        $user=new \Admin\Model\UserModel();
        
        //将对应的记录进行逻辑删除(调用模块方法)
        $z=$user->destroy_user($uid);
        if($z){
           
            echo json_encode('1');//删除操作成功！
        }else{
            echo json_encode('2');//删除操作失败！
        }
    }
    
    
    //用户回收站列表展示
    public function recycle(){
        //查询所有被逻辑删除的用户
        //为了减轻服务器的压力，建议使用条件进行查询，涉及默认全部查询时我们只显示最近500条（后期可设置到配置项）
        $user_infos=D('user')->where(array('is_del'=>'1'))->limit(500)->select();
        
        //将查询到的数据返回模板
        $this->assign('user_infos',$user_infos);
        
        //调用模板
        $this->display();
    }
    
    
    //用户逻辑删除数据恢复
    public function recover(){
        //接收要被恢复的对应的记录id
        $uid=I('get.uid');
        //将对应的记录进行恢复
        $z=D('user')->where(array('user_id'=>$uid))->save(array('is_del'=>'0'));
        if($z){
            echo json_encode('1');//恢复操作成功！
        }else{
            echo json_encode('2');//恢复操作失败！
        }
    }


    //用户信息详情页
    public function detail(){
        //接收对应的user_id
        $uid=I('get.uid');
        //查询对应的用户详情信息
        $user_info=D('user')->find($uid);

        //查询该用户名下车辆
        $car_nos=D('car')->where(array('user_id'=>$uid))->select();
        //查询该用户名下的车辆的订单记录
        $car_pay_info = D('user')->query_car_pay($uid);
        //消费记录
        $money_info=D('user')->query_money_info($uid);
        //查询发票总金额
        $sum=D('user')->query_money_sum($uid);
        //查询个人发票详情
        $all_bill=D('user')->query_bill_info($sum['all_bill']);
        //将数据返回模板.
        $this->assign('user_info',$user_info);
        $this->assign('car_nos',$car_nos);
        $this->assign('car_pay_info',$car_pay_info);
        $this->assign('money_info',$money_info);
        $this->assign('sum',$sum);
        $this->assign('all_bill',$all_bill);
        //调用模板
        $this->display();
    }


    /*
     * 个人信息详情页
     * 2017.2.6
     * 陈琦
     */
    public function detail_info(){
        $ad_id=I('get.ad_id');
        $admin_info=M('admin')->find($ad_id);
        $this->assign('admin_info',$admin_info);
        $this->display();
    }

    
    
    /*
    * 个人密码修改页面
    * 2017.2.6
    * 陈琦
    */
    public function password_update(){
        $ad_id=I('get.ad_id');

        $admin=new \Admin\Model\AdminModel();
        $admin_info=$admin->find($ad_id);
        if(IS_POST){
//            //dump($_POST);exit;
//            //数据收集
//            $data=$admin->create($_POST,2); //进行数据更新，且存在自动完成字段时，务必要这样规范操作写，否则可能会自动完成操作无法完成
//
//            $data['ad_id']=$ad_id;
//
//            //旧密码，用于判断是否存在密码修改
//            $data['old_pwd']=$admin_info['ad_pwd'];
//
//            //数据制作并更新到数据库方法
//            $z=$admin->get_and_update($data, $_FILES);
//
//            if($z){
//                $this->success('管理员信息更新成功！',U('http://car.vhi99.com/index.php?m=admin&c=index&a=index'));
//            }else{
//                $this->error('管理员信息更新失败，请检查！',U('update',array('ad_id'=>$ad_id)),1);
//            }
            if(md5($_POST['old_ad_pwd'])!=$admin_info['ad_pwd']){
                $this->error('原密码输入错误，请重试！');
            }
            if($_POST['ad_pwd']!=$_POST['ad_pwd2']){
                $this->error('两次密码不一样，请重试！');
            }
            if( $_POST['ad_pwd'] != $admin_info['ad_pwd'] ){
                $_POST['ad_pwd']= md5($_POST['ad_pwd']);
            }
            $z=$admin->where('ad_id='.$ad_id)->save($_POST);

            if($z!== false){
                $this->success('管理员信息更新成功！',U('http://car.vhi99.com/index.php?m=admin&c=index&a=index'));
            }else{
                $this->error('管理员信息更新失败，请检查！');
            }
        }else{

            $this->assign('admin_info',$admin_info);

            $this->display();
        }
    }


    /*
     * 用户绑定车辆列表
     * 陈琦
     * 2017.2.8
     */
    public function user_car(){
        //接收对应的user_id
        $uid=I('get.uid');
        //查询对应的用户详情信息
        $user_info=D('user')->find($uid);

        //查询该用户名下车辆
        $car_nos=D('car')->where(array('user_id'=>$uid))->select();
        //查询该用户名下的车辆的消费记录
        $car_pay_info = D('user')->query_car_pay($uid);
        //将数据返回模板
        $this->assign('user_info',$user_info);
        $this->assign('car_nos',$car_nos);
        $this->assign('car_pay_info',$car_pay_info);
        //调用模板
        $this->display();
    }
}
























