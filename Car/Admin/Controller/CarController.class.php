<?php
namespace Admin\Controller;
//use Think\Controller;
use Admin\Common\RbacController;
use Admin\Model\CarModel;
use Think\Page;
class CarController extends RbacController {
    
    //车辆信息列表
    public function showlist_bak(){
        //查询所有停车记录信息
        //为了减轻服务器的压力，建议使用条件进行查询，涉及默认全部查询时我们只显示最近500条（后期可设置到配置项）
        //只显示未逻辑删除的信息
        //实例化本model
        $car=new \Admin\Model\CarModel();
        $car_infos=$car->where(array('is_del'=>'0'))->order('car_id desc')->limit(500)->select();

        //查询所有的用户信息，并将其数据返回模板
        $user_infos=$car->query_users_info($car_infos);
        $this->assign('user_infos',$user_infos);

        //将数据返回模板
        $this->assign('car_infos',$car_infos);


        //调用模板
        $this->display();
    }

    /**
     * 车辆信息列表 后台分页
     * @update-time: 2017-05-23 10:13:10
     * @author: 王亚雄
     */
    public function showlist(){
        $model = new CarModel();
        //字段
        $field = array(
            'c.user_id',
            'c.car_id',
            'c.car_no',
            'u.user_name',
            'g.garage_name',
            'c.add_time',
            'c.car_role',
            'c.end_time', //结束时间戳
            'c.number',
            'if( c.end_time,floor( (c.end_time-'.time().')/3600/24 ) , 0)'=>'days_remaining'//剩余天数
        );

        //条件
        $map = array();
        if(session('admin_id')!=1){
            if(session('garage_id')!=''){
                //进行了人工选择
                $map['c.garage_id'] = array('eq',session('garage_id'));
            }else{
                //没有进行人工选择
                $admin_garage_id = check_garage_filter($this->garage_id);
                if(is_array($admin_garage_id)){
                    //是数组，则代表有多个停车场
                    $map['c.garage_id'] =array();
                    foreach ($admin_garage_id as $s=>$m){
                        $map['c.garage_id'][$s] = array('eq',$m);
                    }
                    $map['c.garage_id'][] = 'or' ;
                }else{
                    $map['c.garage_id'] = array('eq',$admin_garage_id);
                }
            }
        }

        //搜索条件
        $get = search_filter($_GET);
        //搜索车主与车牌
        isset($get['keywords']) && $map['u.user_name|c.car_no'] = array("like",'%' . $get['keywords'] . '%');
        $map['c.garage_id'] = array('eq',$this->garage_id);

        //总条数
        $count = $model->alias('c')
            ->join('left join __USER__ u on c.user_id=u.user_id')
            ->join('left join smart_garage g on c.garage_id=g.garage_id')
            ->where($map)
            ->count();
        //分页
        $page = new Page($count,I('get.list_rows',0,'int')?:LIST_ROWS);

        //列表数据
        $list = $model->alias('c')
            ->join('left join __USER__ u on c.user_id=u.user_id')
            ->join('left join smart_garage g on c.garage_id=g.garage_id')
            ->field($field)
            ->where($map)
            ->limit($page->firstRow,$page->listRows)
            ->order('c.car_id desc')
            ->select();
//        dump($model->getLastSql());exit;
        $this->assign('list',$list);//当页数据
        $this->assign('pageStr',bootstrap_page_style($page->show()));//页码栏
        $this->assign('count',$count);//总条数
        $this->display();




    }


    //车辆信息添加
    public function add(){
        //实例化CarModel
        $car=new \Admin\Model\CarModel();
        if(IS_POST){
            //数据收集
            if($_POST['car_role'] == 2){
                $_POST['number'] = 30;
            }
            $data=$car->create();
            
            //将数据插入到数据库
            $z=$car->add($data);
            if($z){
                $this->success('车辆信息添加成功！',U('showlist'),1);
            }else{
                $this->error('车辆信息添加失败，请检查！',U('add'),1);
            }
            
        }else{
        
            //调用模板
            $this->display();
        }
    }
    
    //车辆信息修改更新
    public function update(){
        //接收将被操作的记录id
        $car_id=I('get.car_id');
        //实例化CarModel
        $car=new \Admin\Model\CarModel();
        if(IS_POST){
            //数据收集
            $data=$car->create($_POST,2); //进行数据更新，且存在自动完成字段时，务必要这样规范操作写，否则可能会自动完成操作无法完成
            
            //将数据更新到数据库
            $z=$car->where(array('car_id'=>$car_id))->save($data);
            if($z){
                $this->success('车辆信息更新成功！',U('showlist'),1);
            }else{
                $this->error('车辆信息更新失败，请检查！',U('update',array('car_id'=>$car_id)),1);
            }
            
        }else{
            //查询出该条记录的所有信息
            $car_info=$car->find($car_id);
            
            //将数据返回到模板
            $this->assign('car_info',$car_info);
            
        
            //调用模板
            $this->display();
        }
    }
    
    
    //车辆信息删除(逻辑删除)
    public function delete(){
        //接收要被删除的对应的记录id
        $car_id=I('get.car_id');
        //将对应的记录进行逻辑删除
        $z=D('car')->where(array('car_id'=>$car_id))->save(array('is_del'=>'1'));
        if($z){
            echo json_encode('1');//逻辑删除操作成功！
        }else{
            echo json_encode('2');//逻辑删除操作失败！
        }
    }
    
    
    //停车记录彻底删除(物理删除，不可恢复！)
    public function destroy(){
        //接收要被删除的对应的记录id
        $car_id=I('get.car_id');
        //将对应的记录进行逻辑删除
        $z=D('car')->where(array('car_id'=>$car_id))->delete();
        if($z){
            echo json_encode('1');//删除操作成功！
        }else{
            echo json_encode('2');//删除操作失败！
        }
    }
    
    
    //车辆信息回收站列表展示
    public function recycle(){
        //查询所有被逻辑删除的车辆信息
        //为了减轻服务器的压力，建议使用条件进行查询，涉及默认全部查询时我们只显示最近500条（后期可设置到配置项）
        $car_infos=D('car')->where(array('is_del'=>'1'))->limit(500)->select();
        
        //将查询到的数据返回模板
        $this->assign('car_infos',$car_infos);
        
        //调用模板
        $this->display();
    }
    
    
    //停车记录逻辑删除数据恢复
    public function recover(){
        //接收要被恢复的对应的记录id
        $car_id=I('get.car_id');
        //将对应的记录进行恢复
        $z=D('car')->where(array('car_id'=>$car_id))->save(array('is_del'=>'0'));
        if($z){
            echo json_encode('1');//恢复操作成功！
        }else{
            echo json_encode('2');//恢复操作失败！
        }
    }
    
    
    //车辆信息详情页
    //修改2017.1.19 祝君伟
    public function detail(){
        //接收对应的car_id
        $car_id=I('get.car_id');
        //查询对应的车辆详情信息
        $car_info = D('car')->query_car_user_info($car_id);
        //查询对应车辆的消费数据
        $car_pay_info = D('car')->query_car_pay($car_id);
        //将数据返回模板
        $this->assign('car_info',$car_info[0]);
        $this->assign('car_pay_info',$car_pay_info);
        //调用模板
        $this->display();
    }



    /*
     * 车辆详情&与车主关系
     * 陈琦
     * 2017.2.10
     */
    public function car_user(){
        //接收对应的car_id
        $car_id=I('get.car_id');
        //查询对应的车辆详情信息
        $car_info = D('car')->query_car_user_info($car_id);
        //dump($car_info);exit;
        //查询对应车辆的消费数据
        $car_pay_info = D('car')->query_car_pay($car_id);
        $user_arr=D('car')->where(array('car_no'=>$car_info[0]['car_no']))->select();
        //将车主姓名放进二维数组
        foreach ($user_arr as $k=>&$v){
            $user_info=D('user')->where(array('user_id'=>$v['user_id']))->field('user_wxnik')->find();
            $v['user_wxnik']=$user_info['user_wxnik'];
            if($v['user_wxnik']==null){
                unset($user_arr[$k]);
            }
        }
        unset($v);
        $this->assign("user_arr",$user_arr);

        //将数据返回模板
        $this->assign('car_info',$car_info[0]);
        $this->assign('car_pay_info',$car_pay_info);
        //调用模板
        $this->display();
    }

    /**
     * 系统配置/停车场配置列表
     * @update-time: 2017-04-05 11:36:19
     * @author: 王亚雄
     */
    public function car_config(){
        $gid = CFG_GID_CAR; //停车场管理配置分组id
        $list = M('config')->where('gid=%d',$gid)->select();
        $this->assign('list',$list);
        $this->display();
    }

    /**
     * 添加停车场配置
     * @update-time: 2017-04-06 15:15:23
     * @author: 王亚雄
     */
    //表单
    public function add_car_config(){
        $this->display();
    }
    //执行添加
    public function add_car_config_act(){
        $name = I('post.name','','htmlspecialchars');
        $value = I('post.value','','htmlspecialchars');
        $desc = I('post.desc','','htmlspecialchars');
        if(!$name || !$value || !$desc) $this->error("请完善信息");

        //数据
        $data = array(
            'name'=>'car_'.$name,
            'value'=>$value,
            'desc'=>$desc,
            'tab_name'=>'停车场配置',
            'gid'=>CFG_GID_CAR,
            'status'=>1
        );

        $num = M('config')->add($data);

        if($num){
            $this->success("添加成功",U('car_config'));
        }else{
            $this->error("添加失败");
        }
    }

    /**
     * 停车场配置删除
     * @update-time: 2017-04-06 17:11:11
     * @author: 王亚雄
     */
    public function del_car_config(){
        $name = I('get.name','','htmlspecialchars');
        if(!$name){
            $this->ajaxReturn(array(
                'error'=>__LINE__,
                'msg'=>"配置名获取失败",
                'data'=>null,
            ));
        }



        $re = M('config')->where('name="%s"',$name)->delete();
        if($re){
            $info = array(
                'error'=>0,
                'msg'=>"删除成功",
                'data'=>null,
            );

        }else{
            $info = array(
                'error'=>__LINE__,
                'msg'=>"删除失败",
                'data'=>null,
            );
        }
        $this->ajaxReturn($info);

    }

    /**
     * 停车长配置修改
     * @update-time: 2017-04-06 17:11:33
     * @author: 王亚雄
     */
    //修改表单页
    public function mod_car_config(){
        $name = I('get.name','','htmlspecialchars');
        $info = M('config')->where('name="%s"',$name)->find();
        $this->assign('info',$info);
        $this->display();
    }
    //执行
    public function mod_car_config_act(){

        $old_name = I('post.old_name');
        $name = I('post.name','','htmlspecialchars');
        $value = I('post.value','','htmlspecialchars');
        $desc = I('post.desc','','htmlspecialchars');
        //数据
        $data = array(
            'name'=>$name,
            'value'=>$value,
            'desc'=>$desc,
            'tab_name'=>'停车场配置',
            'gid'=>CFG_GID_CAR,
            'status'=>1
        );
        $re = M('config')->where('name="%s"',$old_name)->save($data);
        if($re!==false){
            $this->success("修改成功!",U('car_config'));
        }else{
            $this->error("修改失败".mysql_error);
        }
    }
}
























