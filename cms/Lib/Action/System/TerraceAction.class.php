<?php

/*

 *云平台管理类

 *@author 祝君伟

 *@time 2016.12.29

 */



class TerraceAction extends BaseAction

{
    /*平台展示首页平台列表
     *@author 祝君伟
     *@time 2016.12.29
     * */
    public function index(){
       //将列表项从数据库读出
        $terrace_Ob  = M('terrace');
        $terrace_count = $terrace_Ob->where(array('is_del'=>0))->count();
        import('@.ORG.system_page');
        $p=new Page($terrace_count,15,'page');
        $pagebar=$p->show();
        $terrace_array = $terrace_Ob->where(array('is_del'=>0))->limit($p->firstRow.','.$p->listRows)->select();
        $this->assign('terrace_array',$terrace_array);
        $this->assign('pagebar',$pagebar);
        $this->display();
    }

    public function index_news(){
        //将列表项从数据库读出
        $terrace_Ob  = M('terrace');
        $terrace_count = $terrace_Ob->where(array('is_del'=>0))->count();
        import('@.ORG.system_page');
        $p=new Page($terrace_count,15,'page');
        $pagebar=$p->show();
        $terrace_array = $terrace_Ob->where(array('is_del'=>0))->limit($p->firstRow.','.$p->listRows)->select();
        $this->assign('terrace_array',$terrace_array);
        $this->assign('pagebar',$pagebar);
        $this->display();
    }

    /*平台添加显示页面
     * @author 祝君伟
     * @time 2016.12.29
     * */
    public function terrace_add(){
        //显示添加的页面
        $this->display();
    }

    public function terrace_add_news(){
        //显示添加的页面
        $this->display();
    }

    /*平台编辑功能显示页面
    * @author 祝君伟
    * @time 2016.12.29
    */
    public function terrace_update(){
        $pigcms_id = I('get.pigcms_id');
        $terrace_Ob  = M('terrace');
        $terrace_array = $terrace_Ob->where(array('is_del'=>0,'pigcms_id'=>$pigcms_id))->find();
        $this->assign('terrace_array',$terrace_array);
        //对于独特字段参数字段进行后台处理
        $arguments = $terrace_array['arguments'];
        $arguments_value = $terrace_array['arguments_value'];
        $arguments_array = explode(",",$arguments);
        $arguments_array_value = explode(",",$arguments_value);
        $arguments_all_feild =array();
        foreach ($arguments_array as $k=>$v){
            $arguments_all_feild[] = array("arguments"=>$v,"arguments_value"=>$arguments_array_value[$k]);
        }
        $this->assign('arguments_all_feild',$arguments_all_feild);
        //显示编辑的页面
        $this->display();
    }

    public function terrace_update_news(){
        $pigcms_id = I('get.pigcms_id');
        $terrace_Ob  = M('terrace');
        $terrace_array = $terrace_Ob->where(array('is_del'=>0,'pigcms_id'=>$pigcms_id))->find();
        $this->assign('terrace_array',$terrace_array);
        //对于独特字段参数字段进行后台处理
        $arguments = $terrace_array['arguments'];
        $arguments_value = $terrace_array['arguments_value'];
        $arguments_array = explode(",",$arguments);
        $arguments_array_value = explode(",",$arguments_value);
        $arguments_all_feild =array();
        foreach ($arguments_array as $k=>$v){
            $arguments_all_feild[] = array("arguments"=>$v,"arguments_value"=>$arguments_array_value[$k]);
        }
        $this->assign('arguments_all_feild',$arguments_all_feild);
        //显示编辑的页面
        $this->display();
    }

    /*平台添加后处理页面
     * @author 祝君伟
     * @time 2016.12.30
     * */
    public function terrace_modify(){
        //处理前台传过来的添加动作
        if(IS_POST){
            $newStr = '';
            $newStr1 = '';
            if(isset($_POST['arguments'][1])){
                foreach ($_POST['arguments'] as $v){
                    $newStr.= isset($v)?$v.",":$v;
                }
                foreach ($_POST['arguments_value'] as $sv){
                    $newStr1.= isset($sv)?$sv.",":$sv;
                }
                $_POST['arguments'] = substr($newStr,'0',strrpos($newStr,','));
                $_POST['arguments_value'] = substr($newStr1,'0',strrpos($newStr1,','));

            }else{
                $_POST['arguments'] = $_POST['arguments'][0];
                $_POST['arguments_value'] = $_POST['arguments_value'][0];
            }
            $terrace_Ob = M('terrace');
            $res = $terrace_Ob->data($_POST)->add();
            import('@.ORG.syslog');
            $log = new syslog('添加','terrace',$_SESSION['system']['account']);
            $data_log=$log->get_data();
            M('operation_log')->data($data_log)->add();
            if($res){
                $this->frame_submit_tips(1,'添加成功！');
            }else{
                $this->frame_submit_tips(1,'添加失败！请重试~');
            }
        }
    }

    public function terrace_modify_news(){
        //处理前台传过来的添加动作
        if(IS_POST){
            $newStr = '';
            $newStr1 = '';
            if(isset($_POST['arguments'][1])){
                foreach ($_POST['arguments'] as $v){
                    $newStr.= isset($v)?$v.",":$v;
                }
                foreach ($_POST['arguments_value'] as $sv){
                    $newStr1.= isset($sv)?$sv.",":$sv;
                }
                $_POST['arguments'] = substr($newStr,'0',strrpos($newStr,','));
                $_POST['arguments_value'] = substr($newStr1,'0',strrpos($newStr1,','));

            }else{
                $_POST['arguments'] = $_POST['arguments'][0];
                $_POST['arguments_value'] = $_POST['arguments_value'][0];
            }
            $terrace_Ob = M('terrace');
            $res = $terrace_Ob->data($_POST)->add();
            import('@.ORG.syslog');
            $log = new syslog('添加','terrace',$_SESSION['system']['account']);
            $data_log=$log->get_data();
            M('operation_log')->data($data_log)->add();
            if($res){
                $this->success('添加成功！');
            }else{
                $this->error('添加失败！请重试~');
            }
        }
    }

    /*平台编辑
    *@author 祝君伟
    * @time 2017.1.3
    */
    public function terrace_edit(){
        //执行前台传过来的更新操作
        if(IS_POST){
            $newStr = '';
            $newStr1 = '';
            if(isset($_POST['arguments'][1])){
                foreach ($_POST['arguments'] as $v){
                    $newStr.= isset($v)?$v.",":$v;
                }
                foreach ($_POST['arguments_value'] as $sv){
                    $newStr1.= isset($sv)?$sv.",":$sv;
                }
                $_POST['arguments'] = substr($newStr,'0',strrpos($newStr,','));
                $_POST['arguments_value'] = substr($newStr1,'0',strrpos($newStr1,','));

            }else{
                $_POST['arguments'] = $_POST['arguments'][0];
                $_POST['arguments_value'] = $_POST['arguments_value'][0];
            }
            $terrace_Ob = M('terrace');
            $res = $terrace_Ob->save($_POST);
            import('@.ORG.syslog');
            $log = new syslog('更新','terrace',$_SESSION['system']['account']);
            $data_log=$log->get_data();
            M('operation_log')->data($data_log)->add();
            if($res){
                $this->frame_submit_tips(1,'更新成功！');
            }else{
                $this->frame_submit_tips(1,'更新失败！请重试~');
            }
        }
    }

    public function terrace_edit_news(){
        //执行前台传过来的更新操作
        if(IS_POST){
            $newStr = '';
            $newStr1 = '';
            if(isset($_POST['arguments'][1])){
                foreach ($_POST['arguments'] as $v){
                    $newStr.= isset($v)?$v.",":$v;
                }
                foreach ($_POST['arguments_value'] as $sv){
                    $newStr1.= isset($sv)?$sv.",":$sv;
                }
                $_POST['arguments'] = substr($newStr,'0',strrpos($newStr,','));
                $_POST['arguments_value'] = substr($newStr1,'0',strrpos($newStr1,','));

            }else{
                $_POST['arguments'] = $_POST['arguments'][0];
                $_POST['arguments_value'] = $_POST['arguments_value'][0];
            }
            $terrace_Ob = M('terrace');
            $res = $terrace_Ob->save($_POST);
            import('@.ORG.syslog');
            $log = new syslog('更新','terrace',$_SESSION['system']['account']);
            $data_log=$log->get_data();
            M('operation_log')->data($data_log)->add();
            if($res){
                $this->success('更新成功！');
            }else{
                $this->error('更新失败！请重试~');
            }
        }
    }

    /*平台逻辑删除操作
     *@author 祝君伟
     * @time 2017.1.3
     * */
    public function terrace_del(){
        $id = I('get.pigcms_id');
        $terrace_Ob = M('terrace');
        $res = $terrace_Ob->where(array("pigcms_id"=>$id))->data(array("is_del"=>1))->save();
        import('@.ORG.syslog');
        $log = new syslog('删除','terrace',$_SESSION['system']['account']);
        $data_log=$log->get_data();
        M('operation_log')->data($data_log)->add();
        if($res){
            $this->success('删除成功！');
        }else{
            $this->error('删除失败！请重试~');
        }
    }
    
    /*平台一键启用的方法
     * @author 祝君伟
     * @time 2017.1.13
     * */
    public function change_state(){
        $pigcms_id = I('get.pigcms_id');
        $is_use = I('get.is_use');
        $terrace_Ob = M('terrace');
        $hickey_Ob = M('hickey');
        $access_Ob = M('access_control');
        $terrace_array = $terrace_Ob->where(array('pigcms_id'=>$pigcms_id,'is_del'=>0))->find();
        if($is_use =="启用"){
            //要关闭
            $res = $terrace_Ob->where(array('pigcms_id'=>$pigcms_id,'is_del'=>0))->data(array("is_use"=>0))->save();
            //要启用的时候把接口关于当前平台的全部关闭
            $hick_res = $hickey_Ob->where(array('terrace_id'=>$pigcms_id,'is_del'=>0))->data(array("is_use"=>0))->save();
        }elseif($is_use=="关闭"){
            //要启用
            $terrace_Ob->where(array('is_del'=>0))->data(array("is_use"=>0))->save();
            $res = $terrace_Ob->where(array('pigcms_id'=>$pigcms_id,'is_del'=>0))->data(array("is_use"=>1))->save();
            //要启用的时候把接口关于当前平台的全部开启
            $hick_res = $hickey_Ob->where(array('is_del'=>0))->data(array("is_use"=>0))->save();
            $hick_res = $hickey_Ob->where(array('terrace_id'=>$pigcms_id,'is_del'=>0))->data(array("is_use"=>1))->save();

        }
        if($res&&$is_use=="启用"){
            //关闭
            import('@.ORG.syslog');
            $log = new syslog('关闭平台','terrace',$_SESSION['system']['account']);
            $data_log=$log->get_data();
            M('operation_log')->data($data_log)->add();
            echo 1;
        }elseif($res&&$is_use=="关闭"){
            //开启
            import('@.ORG.syslog');
            $log = new syslog('开启平台','terrace',$_SESSION['system']['account']);
            $data_log=$log->get_data();
            M('operation_log')->data($data_log)->add();
            echo 2;
        }else{
            //报错
            echo 3;
        }

    }
}