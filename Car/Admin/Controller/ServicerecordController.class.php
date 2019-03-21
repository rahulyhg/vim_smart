<?php
namespace Admin\Controller;
//use Think\Controller;
use Admin\Common\RbacController;
use Org\Util\Rbac;
use Think\Page;
class ServicerecordController extends RbacController {
    
    //停车记录列表
    public function showlist_bak(){
        //查询所有停车记录信息
        //为了减轻服务器的压力，建议使用条件进行查询，涉及默认全部查询时我们只显示最近500条（后期可设置到配置项）
        //只显示未逻辑删除的信息
        $data=$_GET['query'];
        if($data){
            if(is_numeric($data)){
                $serv_infos=D('servicerecord')->where(array('is_del'=>'0','car_no'=>array('like','%'.$data)))->order('start_time desc')->limit(500)->select();//模糊匹配车牌号
                if(empty($serv_infos)){
                    //调用模板
                    $this->display();
                }else{
                    $arr=D('servicerecord')->selectBy_num_info($serv_infos);
                    $this->assign('pay_user_id',$arr['user_id_arr']);
                    $this->assign('users_info_arr',$arr['users_info_arr']);
                    //查询所有车场信息，并将数据返回模板
                    $garage_infos=D('garage')->field('garage_id,garage_name')->select();
                    $this->assign('garage_infos',$garage_infos);
                    //将数据返回模板
                    $this->assign('serv_infos',$serv_infos);
                    //调用模板
                    $this->display();
                }
            }else{
                $arr=D('user')->where(array('user_wxnik'=>array('like','%'.$data.'%')))->order('add_time desc')->select();
                if(empty($arr)){
                    //调用模板
                    $this->display();
                }else{
                    $res=D('servicerecord')->selectBy_name_info($arr);
                    $this->assign('users_info_arr',$res['users_info_arr']);
                    $this->assign('pay_user_id',$res['user_id_arr']);
                    //查询所有车场信息，并将数据返回模板
                    $garage_infos=D('garage')->field('garage_id,garage_name')->select();
                    $this->assign('garage_infos',$garage_infos);
                    $serv_id='';
                    foreach($res['user_id_arr'] as $k=>$v){
                        $serv_id.=',\''.$v['serv_id'].'\'';
                    }
                    $serv_infos=M()->query("select * from ".C('DB_PREFIX')."servicerecord where serv_id in (".ltrim($serv_id,',').")");
                    //dump($serv_infos);exit;
                    $this->assign('serv_infos',$serv_infos);
                    $this->display();
                }
            }
        }else{
            $car_id=$_GET['car_id'];
            if($car_id){
                $car_info=M('car')->where(array('car_id'=>$car_id))->find();
                $car_no=$car_info['car_no'];
                $serv_infos=D('servicerecord')->where(array('is_del'=>'0','car_no'=>$car_no))->order('start_time desc')->limit(500)->select();
            }else{
                $serv_infos=D('servicerecord')->where(array('is_del'=>'0'))->order('start_time desc')->limit(500)->select();
            }
            //查询所有对应车主名称，并将数据返回模板
            $pay_ids='';
            foreach($serv_infos as $k=>$v){
                $pay_ids.=',\''.$v['pay_record'].'\'';
            }
            $user_id_arr=M()->query("select user_id,pay_id,pay_type,pay_time from ".C('DB_PREFIX')."payrecord where pay_id in (".ltrim($pay_ids,',').")");
            $user_ids='';
            foreach($user_id_arr as $k=>$v){
                $user_ids.=',\''.$v['user_id'].'\'';
            }
            $user_dbname=C('DB_PREFIX')."user";
            $users_info_arr=M()->query("select user_name,user_id from ".$user_dbname." where user_id in (".ltrim($user_ids,',').")");
            $this->assign('pay_user_id',$user_id_arr);
            $this->assign('users_info_arr',$users_info_arr);

            //查询所有车场信息，并将数据返回模板
            $garage_infos=D('garage')->field('garage_id,garage_name')->select();
            $this->assign('garage_infos',$garage_infos);
            //将数据返回模板
            $this->assign('serv_infos',$serv_infos);
            //调用模板
           // dump($serv_infos);exit;
            $this->display();
        }

    }

    /**
     * 停车记录列表 后端分页
     * @update-time: 2017-05-22 09:50:13
     * @author: 王亚雄
     */
    public function showlist(){
        $model = M('servicerecord');
        //字段
        $field = array(
            'serv.serv_id',
            'p.user_id',
            'serv.pay_record',
            'u.user_name',//车主
            'serv.car_no',//车牌号
            'serv.start_time',//入场时间
            'serv.end_time',//离场时间
            'g.garage_name',//所属停车场
            'serv.waiter',//值班人员id
            'uw.user_name'=>'waiter_name',//值班人员姓名
            'car.car_id',

        );
        //条件
        $map = array();
        if(session('admin_id')!=1){
            if(session('garage_id')!=''){
                //进行了人工选择
                $map['serv.garage_id'] = array('eq',session('garage_id'));
            }else{
                //没有进行人工选择
                $admin_garage_id = check_garage_filter($this->garage_id);
                if(is_array($admin_garage_id)){
                    //是数组，则代表有多个停车场
                    $map['serv.garage_id'] =array();
                    foreach ($admin_garage_id as $s=>$m){
                        $map['serv.garage_id'][$s] = array('eq',$m);
                    }
                    $map['serv.garage_id'][] = 'or' ;
                }else{
                    $map['serv.garage_id'] = array('eq',$admin_garage_id);
                }
            }
        }
        $map['serv.garage_id'] = array('eq',$this->garage_id);
        //搜索条件
        $get = search_filter($_GET);
        //搜索车主与车牌
        isset($get['keywords']) && $map['u.user_name|serv.car_no'] = array("like",'%' . $get['keywords'] . '%');

        $count = $model->alias('serv')
            ->join('left join __GARAGE__ g on g.garage_id = serv.garage_id')
            ->join('left join __PAYRECORD__ p on p.serv_id = serv.serv_id')
            ->join('left join __USER__ u on u.user_id = p.user_id')
            ->where($map)
            ->count();//总条数

        $page = new Page($count,I('get.list_rows',0,'int')?:LIST_ROWS);

        //列表数据
        $list = $model->alias('serv')
            ->field($field)
            ->join('left join __GARAGE__ g on g.garage_id = serv.garage_id')
            ->join('left join __PAYRECORD__ p on p.serv_id = serv.serv_id')
            ->join('left join __USER__ u on u.user_id = p.user_id')
            ->join('left join __USER__ uw on serv.waiter = uw.user_id')
            ->join('left join __CAR__ car on car.user_id=p.user_id and car.car_no = serv.car_no')
            ->limit($page->firstRow,$page->listRows)
            ->where($map)
            ->order('serv_id desc')
            ->select();
        $this->assign('list',$list);
        $this->assign('pageStr',bootstrap_page_style($page->show()));
        $this->assign('empty','暂无数据');

        $this->display();

    }

    //停车记录添加
    public function add(){
        //实例化ServicerecordModel
        $serv_record=new \Admin\Model\ServicerecordModel();
        if(IS_POST){
            //数据收集
            $data=$serv_record->create();
            //将时间字符串(英文格式)转换为时间戳(数据制作)
            $data['start_time']=$serv_record->time_str_to_int($data['start_time']);
            $data['end_time']=$serv_record->time_str_to_int($data['end_time']);
            
            //将数据插入到数据库
            $z=$serv_record->add($data);
            //插入成功后使用自动完成功能生成订单
            if($z){
                $this->success('停车记录添加成功！',U('showlist'),1);
            }else{
                $this->error('停车记录添加失败，请检查！',U('add'),1);
            }
            
        }else{
        
            //调用模板
            $this->display();
        }
    }
    
    //停车记录修改更新
    public function update(){
        //接收将被操作的记录id
        $serv_id=I('get.recod_id');
        //实例化ServicerecordModel
        $serv_record=new \Admin\Model\ServicerecordModel();
        if(IS_POST){
            //数据收集
            $data=$serv_record->create();
            //将时间字符串(英文格式)转换为时间戳(数据制作)
            $data['start_time']=$serv_record->time_str_to_int($data['start_time']);
            $data['end_time']=$serv_record->time_str_to_int($data['end_time']);
            
            //将数据更新到数据库
            $z=$serv_record->where(array('serv_id'=>$serv_id))->save($data);
            if($z){
                $this->success('停车记录更新成功！',U('showlist'),1);
            }else{
                $this->error('停车记录更新失败，请检查！',U('update',array('recod_id'=>$serv_id)),1);
            }
            
        }else{
            //查询出该条记录的所有信息
            $serv_info=$serv_record->find($serv_id);
            
            //将数据返回到模板
            $this->assign('serv_info',$serv_info);
            
        
            //调用模板
            $this->display();
        }
    }
    
    
    //停车记录删除(逻辑删除)
    public function delete(){
        //接收要被删除的对应的记录id
        $serv_id=I('get.recod_id');
        //将对应的记录进行逻辑删除
        $z=D('servicerecord')->where(array('serv_id'=>$serv_id))->save(array('is_del'=>'1'));
        if($z){
            echo json_encode('1');//逻辑删除操作成功！
        }else{
            echo json_encode('2');//逻辑删除操作失败！
        }
    }
    
    
    //停车记录彻底删除(物理删除，不可恢复！)
    public function destroy(){
        //接收要被删除的对应的记录id
        $serv_id=I('get.recod_id');
        //将对应的记录进行逻辑删除
        $z=D('servicerecord')->where(array('serv_id'=>$serv_id))->delete();
        if($z){
            echo json_encode('1');//删除操作成功！
        }else{
            echo json_encode('2');//删除操作失败！
        }
    }
    
    
    //停车记录回收站列表展示
    public function recycle(){
        //查询所有被逻辑删除的停车记录
        $serv_infos=D('servicerecord')->where(array('is_del'=>'1'))->select();
        
        //将查询到的数据返回模板
        $this->assign('serv_infos',$serv_infos);
        
        //调用模板
        $this->display();
    }
    
    
    //停车记录逻辑删除数据恢复
    public function recover(){
        //接收要被恢复的对应的记录id
        $serv_id=I('get.recod_id');
        //将对应的记录进行恢复
        $z=D('servicerecord')->where(array('serv_id'=>$serv_id))->save(array('is_del'=>'0'));
        if($z){
            echo json_encode('1');//恢复操作成功！
        }else{
            echo json_encode('2');//恢复操作失败！
        }
    }


    /*
     * 首页搜索车牌号模糊查询
     * 陈琦
     * 2017.2.6
     */
    public function search(){
        if($_POST){
            $data=$_POST['query'];
            header("location:".C('WEB_DOMAIN')."/index.php?s=/Admin/Servicerecord/showlist&keywords=".$data);
        }
    }
}
























