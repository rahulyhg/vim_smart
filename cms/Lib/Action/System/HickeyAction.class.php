<?php

/*

 *接口管理类

 *@author 祝君伟

 *@time 2016.12.29

 */



class HickeyAction extends BaseAction

{
    /*接口管理展示首页平台列表
     *@author 祝君伟
     *@time 2017.1.3
     * */
    public function index(){
       //将列表项从数据库读出
        $condition_table = array(
            'pigcms_hickey'=>'hickey',
            'pigcms_terrace'=>'terrace',
        );
        $condition_where = "terrace.pigcms_id=hickey.terrace_id and hickey.is_del=0";
        import('@.ORG.system_page');
        $condition_field = "terrace.terrace_name,terrace.terrace_class,terrace.url,hickey.*";
        $count_access = D('')->table($condition_table)->where($condition_where)->count();
        $p=new Page($count_access,15,'page');
        $get_log_list=$p->show();
        $Hickey_array  = D('')->table($condition_table)->where($condition_where)->field($condition_field)->order('hickey.pigcms_id asc')->limit($p->firstRow .','.$p->listRows)->select();
        //var_dump($Hickey_array);exit;
        $this->assign('Hickey_array',$Hickey_array);
        $this->assign('get_log_list',$get_log_list);
        $this->display();
    }

    public function index_news(){
        //将列表项从数据库读出
        $condition_table = array(
            'pigcms_hickey'=>'hickey',
            'pigcms_terrace'=>'terrace',
        );
        $condition_where = "terrace.pigcms_id=hickey.terrace_id and hickey.is_del=0";
        import('@.ORG.system_page');
        $condition_field = "terrace.terrace_name,terrace.terrace_class,terrace.url,hickey.*";
        $count_access = D('')->table($condition_table)->where($condition_where)->count();
        $p=new Page($count_access,15,'page');
        $get_log_list=$p->show();
        $Hickey_array  = D('')->table($condition_table)->where($condition_where)->field($condition_field)->order('hickey.pigcms_id asc')->limit($p->firstRow .','.$p->listRows)->select();
        //var_dump($Hickey_array);exit;
        $this->assign('Hickey_array',$Hickey_array);
        $this->assign('get_log_list',$get_log_list);
        $this->display();
    }

    /*接口管理添加页面
     *@author 祝君伟
     *@time 2017.1.3
     * */
    public function hickey_add(){
        //查询平台所对应的id
        $terrace_Ob = M('terrace');
        $terrace_array = $terrace_Ob->where(array('is_del'=>0))->select();
        //查询access_control里面区域的名称
        $access_Ob = M('access_control');
        $access_array = $access_Ob->field('ac_name,ac_id')->select();
        $this->assign('access_array',$access_array);
        $this->assign('terrace_array',$terrace_array);
        $this->display();
    }

    public function hickey_add_news(){
        //查询平台所对应的id
        $terrace_Ob = M('terrace');
        $terrace_array = $terrace_Ob->where(array('is_del'=>0))->select();
        //查询access_control里面区域的名称
        $access_Ob = M('access_control');
        $access_array = $access_Ob->field('ac_name,ac_id')->select();
        $this->assign('access_array',$access_array);
        $this->assign('terrace_array',$terrace_array);
        $this->display();
    }

    /*接口管理寻找平台类方法名
     *@author 祝君伟
     *@time 2017.1.3
     * */
    public function seacrch_name(){
        //搜寻对应id的方法名称
        $terrace_name = I('get.terrace_name');
        $terrace_Ob = M('terrace');
        $terrace_array = $terrace_Ob->where(array('is_del'=>0,'terrace_name'=>$terrace_name))->find();
       echo $terrace_array['terrace_class'];
    }

    /*接口管理执行添加操作
     *@author 祝君伟
     *@time 2017.1.4
     * */
    public function hickey_modify(){
        if(IS_POST){
            $newStr = '';
            $newStr1 = '';
            $newStr2 = '';
            if(isset($_POST['arguments'][1])){
                foreach ($_POST['arguments'] as $v){
                    $newStr.= isset($v)?$v.",":$v;
                }
                foreach ($_POST['arguments_value'] as $sv){
                    $newStr1.= isset($sv)?$sv.",":$sv;
                }
                foreach ($_POST['arguments_type'] as $snv){
                    $newStr2.= isset($snv)?$snv.",":$snv;
                }
                $_POST['arguments'] = substr($newStr,'0',strrpos($newStr,','));
                $_POST['arguments_value'] = substr($newStr1,'0',strrpos($newStr1,','));
                $_POST['arguments_type'] = substr($newStr2,'0',strrpos($newStr2,','));

            }else{
                $_POST['arguments'] = $_POST['arguments'][0];
                $_POST['arguments_value'] = $_POST['arguments_value'][0];
                $_POST['arguments_type'] = $_POST['arguments_type'][0];
            }
            $terrace_Ob = M('hickey');
            $res = $terrace_Ob->data($_POST)->add();
            import('@.ORG.syslog');
            $log = new syslog('添加','hickey',$_SESSION['system']['account']);
            $data_log=$log->get_data();
            M('operation_log')->data($data_log)->add();
            if($res){
                $this->frame_submit_tips(1,'添加成功！');
            }else{
                $this->frame_submit_tips(1,'添加失败！请重试~');
            }
        }
    }

    public function hickey_modify_news(){
        if(IS_POST){
            $newStr = '';
            $newStr1 = '';
            $newStr2 = '';
            if(isset($_POST['arguments'][1])){
                foreach ($_POST['arguments'] as $v){
                    $newStr.= isset($v)?$v.",":$v;
                }
                foreach ($_POST['arguments_value'] as $sv){
                    $newStr1.= isset($sv)?$sv.",":$sv;
                }
                foreach ($_POST['arguments_type'] as $snv){
                    $newStr2.= isset($snv)?$snv.",":$snv;
                }
                $_POST['arguments'] = substr($newStr,'0',strrpos($newStr,','));
                $_POST['arguments_value'] = substr($newStr1,'0',strrpos($newStr1,','));
                $_POST['arguments_type'] = substr($newStr2,'0',strrpos($newStr2,','));

            }else{
                $_POST['arguments'] = $_POST['arguments'][0];
                $_POST['arguments_value'] = $_POST['arguments_value'][0];
                $_POST['arguments_type'] = $_POST['arguments_type'][0];
            }
            $terrace_Ob = M('hickey');
            $res = $terrace_Ob->data($_POST)->add();
            import('@.ORG.syslog');
            $log = new syslog('添加','hickey',$_SESSION['system']['account']);
            $data_log=$log->get_data();
            M('operation_log')->data($data_log)->add();
            if($res){
                $this->success('添加成功！');
            }else{
                $this->error('添加失败！请重试~');
            }
        }
    }

    /*接口管理的编辑页面
     * @author 祝君伟
     * @time 2017.1.4
     * */
    public function hickey_update(){
        $pigcms_id = I('get.pigcms_id');
        $terrace_Ob  = M('hickey');
        $hickey_array = $terrace_Ob->where(array('is_del'=>0,'pigcms_id'=>$pigcms_id))->find();
        $this->assign('hickey_array',$hickey_array);
        //对于独特字段参数字段进行后台处理
        $arguments = $hickey_array['arguments'];
        $arguments_value = $hickey_array['arguments_value'];
        $arguments_type = $hickey_array['arguments_type'];
        $arguments_array = explode(",",$arguments);
        $arguments_array_value = explode(",",$arguments_value);
        $arguments_array_type = explode(",",$arguments_type);

        $arguments_all_feild =array();
        foreach ($arguments_array as $k=>$v){
            $arguments_all_feild[] = array("arguments"=>$v,"arguments_value"=>$arguments_array_value[$k],"arguments_type"=>$arguments_array_type[$k]);
        }
        $this->assign('arguments_all_feild',$arguments_all_feild);
        //查询平台所对应的id
        $terrace_Ob = M('terrace');
        $terrace_array = $terrace_Ob->where(array('is_del'=>0))->select();
        //查询access_control里面区域的名称
        $access_Ob = M('access_control');
        $access_array = $access_Ob->field('ac_name,ac_id')->select();
        $this->assign('access_array',$access_array);
        $this->assign('terrace_array',$terrace_array);
        //显示编辑的页面
        $this->display();
    }

    public function hickey_update_news(){
        $pigcms_id = I('get.pigcms_id');
        $terrace_Ob  = M('hickey');
        $hickey_array = $terrace_Ob->where(array('is_del'=>0,'pigcms_id'=>$pigcms_id))->find();
        $this->assign('hickey_array',$hickey_array);
        //对于独特字段参数字段进行后台处理
        $arguments = $hickey_array['arguments'];
        $arguments_value = $hickey_array['arguments_value'];
        $arguments_type = $hickey_array['arguments_type'];
        $arguments_array = explode(",",$arguments);
        $arguments_array_value = explode(",",$arguments_value);
        $arguments_array_type = explode(",",$arguments_type);

        $arguments_all_feild =array();
        foreach ($arguments_array as $k=>$v){
            $arguments_all_feild[] = array("arguments"=>$v,"arguments_value"=>$arguments_array_value[$k],"arguments_type"=>$arguments_array_type[$k]);
        }
        $this->assign('arguments_all_feild',$arguments_all_feild);
        //查询平台所对应的id
        $terrace_Ob = M('terrace');
        $terrace_array = $terrace_Ob->where(array('is_del'=>0))->select();
        //查询access_control里面区域的名称
        $access_Ob = M('access_control');
        $access_array = $access_Ob->field('ac_name,ac_id')->select();
        $this->assign('access_array',$access_array);
        $this->assign('terrace_array',$terrace_array);
        //显示编辑的页面
        $this->display();
    }
    /*接口管理执行编辑操作
     * @author 祝君伟
     * @time 2017.1.4
     * */
    public function hickey_edit(){
        if(IS_POST){
            $id = $_POST['pigcms_id'];
            unset($_POST['pigcms_id']);
            $newStr = '';
            $newStr1 = '';
            $newStr2 = '';
            //var_dump($_POST['arguments_value']);exit;
            if(isset($_POST['arguments'][1])){
                foreach ($_POST['arguments'] as $v){
                    $newStr.= isset($v)?$v.",":$v;
                }
                foreach ($_POST['arguments_value'] as $sk=>$sv){
                    $newStr1.= isset($sv)?$sv.",":$sv.",";
                }
                foreach ($_POST['arguments_type'] as $snv){
                    $newStr2.= isset($snv)?$snv.",":$snv;
                }
                //echo $newStr1;exit;
                //查询参数字段最后一位为不为空
                $num =  count($_POST['arguments']);
                $num_value = count($_POST['arguments_value']);
                $str_value = '';
                for ($i=1;$i<$num-$num_value;$i++){
                    $str_value .=",";
                }
                $newStr1 = $str_value.$newStr1;
                if($_POST['arguments_value'][$num-1] !=''){
                    $_POST['arguments_value'] = substr($newStr1,'0',strrpos($newStr1,','));
                }else{
                    $_POST['arguments_value'] = $newStr1;
                }
                $_POST['arguments'] = substr($newStr,'0',strrpos($newStr,','));
                $_POST['arguments_type'] = substr($newStr2,'0',strrpos($newStr2,','));

            }else{
                $_POST['arguments'] = $_POST['arguments'][0];
                $_POST['arguments_value'] = $_POST['arguments_value'][0];
                $_POST['arguments_type'] = $_POST['arguments_type'][0];
            }
            $hickey_Ob  = M('hickey');
            if($_POST['is_use']==1){
                $hickey_Ob->where(array('hick_ac_id'=>$_POST['hick_ac_id']))->data(array('is_use'=>0))->save();
            }
            //var_dump($_POST);exit;
            $res = $hickey_Ob->where(array('pigcms_id'=>$id))->save($_POST);
            import('@.ORG.syslog');
            $log = new syslog('编辑','hickey',$_SESSION['system']['account']);
            $data_log=$log->get_data();
            M('operation_log')->data($data_log)->add();
            if($res !== false){
                $this->frame_submit_tips(1,'更新成功！');
            }else{
                $this->frame_submit_tips(1,'更新失败！请重试~');
            }
        }
    }

    public function hickey_edit_news(){
        if(IS_POST){
            $id = $_POST['pigcms_id'];
            unset($_POST['pigcms_id']);
            $newStr = '';
            $newStr1 = '';
            $newStr2 = '';
            //var_dump($_POST['arguments_value']);exit;
            if(isset($_POST['arguments'][1])){
                foreach ($_POST['arguments'] as $v){
                    $newStr.= isset($v)?$v.",":$v;
                }
                foreach ($_POST['arguments_value'] as $sk=>$sv){
                    $newStr1.= isset($sv)?$sv.",":$sv.",";
                }
                foreach ($_POST['arguments_type'] as $snv){
                    $newStr2.= isset($snv)?$snv.",":$snv;
                }
                //echo $newStr1;exit;
                //查询参数字段最后一位为不为空
                $num =  count($_POST['arguments']);
                $num_value = count($_POST['arguments_value']);
                $str_value = '';
                for ($i=1;$i<$num-$num_value;$i++){
                    $str_value .=",";
                }
                $newStr1 = $str_value.$newStr1;
                if($_POST['arguments_value'][$num-1] !=''){
                    $_POST['arguments_value'] = substr($newStr1,'0',strrpos($newStr1,','));
                }else{
                    $_POST['arguments_value'] = $newStr1;
                }
                $_POST['arguments'] = substr($newStr,'0',strrpos($newStr,','));
                $_POST['arguments_type'] = substr($newStr2,'0',strrpos($newStr2,','));

            }else{
                $_POST['arguments'] = $_POST['arguments'][0];
                $_POST['arguments_value'] = $_POST['arguments_value'][0];
                $_POST['arguments_type'] = $_POST['arguments_type'][0];
            }
            $hickey_Ob  = M('hickey');
            if($_POST['is_use']==1){
                $hickey_Ob->where(array('hick_ac_id'=>$_POST['hick_ac_id']))->data(array('is_use'=>0))->save();
            }
            //var_dump($_POST);exit;
            $res = $hickey_Ob->where(array('pigcms_id'=>$id))->save($_POST);
            import('@.ORG.syslog');
            $log = new syslog('编辑','hickey',$_SESSION['system']['account']);
            $data_log=$log->get_data();
            M('operation_log')->data($data_log)->add();
            if($res !== false){
                $this->success('更新成功！');
            }else{
                $this->error('更新失败！请重试~');
            }
        }
    }

    /*接口管理执行删除操作
     * @author 祝君伟
     * @time 2017.1.4
     * */
    public function hickey_del(){
        $id = I('get.pigcms_id');
        $terrace_Ob = M('hickey');
        $res = $terrace_Ob->where(array("pigcms_id"=>$id))->data(array("is_del"=>1))->save();
        import('@.ORG.syslog');
        $log = new syslog('删除','hickey',$_SESSION['system']['account']);
        $data_log=$log->get_data();
        M('operation_log')->data($data_log)->add();
        if($res){
            $this->success('删除成功！');
        }else{
            $this->error('删除失败！请重试~');
        }
    }


    /*接口管理查询是否有其他平台占用设备
     * @author 祝君伟
     * @time 2017.1.5
     * */
    public function check_use(){
        $ac_id = I('get.hick_id');
        $pigcms_id = I('get.pigcms_id');
        $terrace_Ob = M('hickey');
        $res = $terrace_Ob->where(array("hick_ac_id"=>$ac_id,'is_del'=>0,'is_use'=>1))->find();
        if($res['pigcms_id'] !=$pigcms_id&&$res != false){
            //占用，禁止操作
            echo 2;
        }else {
            //没有占用，允许操作
            echo 2;
        }
    }

    /*接口管理变更接口使用状态--ajax方式
     * @author 祝君伟
     * @time 2017.1.5
     * */
    public function change_state(){
        $pigcms_id = I('get.pigcms_id');
        $is_use = I('get.is_use');
        $terrace_Ob = M('hickey');
        $hick_array = $terrace_Ob->where(array('pigcms_id'=>$pigcms_id,'is_del'=>0))->find();
        if($is_use =="启用"){
            //要关闭
            $terrace_Ob->where(array('hick_ac_id'=>$hick_array['hick_ac_id']))->data(array("is_use"=>1))->save();
            $res = $terrace_Ob->where(array('pigcms_id'=>$pigcms_id,'is_del'=>0))->data(array("is_use"=>0))->save();
        }elseif($is_use=="关闭"){
            //要启用
            $terrace_Ob->where(array('hick_ac_id'=>$hick_array['hick_ac_id']))->data(array("is_use"=>0))->save();
            $res = $terrace_Ob->where(array('pigcms_id'=>$pigcms_id,'is_del'=>0))->data(array("is_use"=>1))->save();
        }
        if($res&&$is_use==1){
            //关闭
            echo 1;
        }elseif($res&&$is_use==0){
            //开启
            echo 2;
        }else{
            //报错
            echo 3;
        }
    }
    
}