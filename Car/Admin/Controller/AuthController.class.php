<?php
namespace Admin\Controller;
//use Think\Controller;
use Admin\Common\RbacController;
class AuthController extends RbacController {

    //车辆信息列表
    public function showlist(){
        //查询所有权限信息
        $auth_infos=D('menu')->select();

        //将数据返回模板
        $this->assign('auth_infos',$auth_infos);

        //调用模板
        $this->display();
    }

    //权限添加
    public function add(){
        //实例化AuthModel
        if(IS_POST){
            //数据收集
            $data=D('auth')->create();
            $data['select_module']=$data['module'];
            $data['select_action']=$data['action'];
            if($data['icon']=='--请选择--'){
                unset($data['icon']);
            }
            //将数据插入到数据库
            $z=D('auth')->add($data);
            if($z){
                $this->success('添加成功！',U('showlist'),1);
            }else{
                $this->error('添加失败，请检查！',U('add'),1);
            }

        }else{

            //查询所有已有的一级权限(权限水平为0)
            $pid=D('menu')->where(array('fid'=>0))->select();
            //将已有的一级权限返回模板
            $this->assign('pid',$pid);

            //调用模板
            $this->display();
        }
    }

    //权限修改更新
    public function update(){
        //接收将被操作的记录id
        $auth_id=I('get.id');

        //实例化AuthModel
        $auth=new \Admin\Model\AuthModel();

        //查询出该条记录的所有信息
        $auth_infos=$auth->find($auth_id);
        //dump($auth_infos);exit;
        $old_pid=$auth_infos['fid'];

        if(IS_POST){
            //数据收集
            $data=$auth->create($_POST,2); //进行数据更新，且存在自动完成字段时，务必要这样规范操作写，否则可能会自动完成操作无法完成
            //dump($data);exit;
            //将数据更新到数据库
            $z=$auth->where(array('id'=>$auth_id))->save($data);
            if($z){
                $this->success('权限更新成功！',U('showlist'),1);
            }else{
                $this->error('权限更新失败，请检查！',U('update',array('id'=>$auth_id)),1);
            }

        }else{

            //查询所有已有的权限列表项
            $pid=D('menu')->select();
            //将已有的一级权限返回模板
            $this->assign('pid',$pid);

            //把模块和action显示出来
            $control_array = $this->get_controller($auth_infos['model']);
            //$action_array = $this->get_action($auth_infos['module']);
            //dump($control_array);
            //将数据返回到模板
            $this->assign('auth_infos',$auth_infos);
            $this->assign('control_array',$control_array);
            //$this->assign('action_array',$action_array);

            //调用模板
            $this->display();
        }
    }


    //权限彻底删除(物理删除，不可恢复！)
    public function destroy(){
        //接收要被删除的对应的记录id
        $auth_id=I('get.auth_id');
        //将对应的记录进行物理删除
        $z=D('menu')->where(array('id'=>$auth_id))->delete();
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
    public function detail(){
        //接收对应的car_id
        $car_id=I('get.car_id');
        //查询对应的车辆详情信息
        $car_info=D('car')->find($car_id);

        //将数据返回模板
        $this->assign('car_info',$car_info);

        //调用模板
        $this->display();
    }

    //制作子级栏目的option列表
    public function make_child_option(){
        $option_array=D('menu')->where(array('fid'=>array('neq',0),'create_type'=>0))->select();
        $option_list = '';
        foreach ($option_array as $value){
            $option_list .= '<option value="'.$value['id'].'">'.$value['name'].'</option>';
        }
        echo '<select class="form-control" name="fid" id="fid"><option value="0">首页业务逻辑</option>'.$option_list.'</select>';
    }




    public function make_control_option(){
        $model = I('post.model');
        $result_array = $this->get_controller($model);
        $result_string = '';
        foreach ($result_array as $value){
            $result_string .= '<option value="'.$value.'">'.$value.'</option>';
        }
        echo $result_string;
    }

    public function make_action_option(){
        $module = I('post.module');
        $result_array = $this->get_action($module);
        $result_string = '';
        foreach ($result_array as $value){
            $result_string .= '<option value="'.$value.'">'.$value.'</option>';
        }
        echo $result_string;
    }

    /*
   * 核心方法---制做一个当前模块下所有控制器的数组
   * author 祝君伟
   * time 2017.4.1
   * */

    protected function get_controller($module){
        if(empty($module)) return null;
        $module_path = APP_PATH . '/' . $module . '/Controller/';
        if(!is_dir($module_path)) return null;
        $module_path .= '/*.class.php';
        $ary_files = glob($module_path);
        foreach ($ary_files as $file) {
            if (is_dir($file)) {
                continue;
            }else {
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
        $action = A($action);
        $all_action_array = get_class_methods($action);
        $allow_array = array('_initialize','__construct','getActionName','isAjax','display','show','fetch','buildHtml','assign','__set','get','__get','__isset','__call','error','success','ajaxReturn','theme','redirect','__destruct','_empty');
        foreach ($all_action_array as $func){
            if(!in_array($func, $allow_array)){
                $customer_functions[] = $func;
            }
        }
        return $customer_functions;
    }



}
























