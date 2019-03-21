<?php
namespace Admin\Controller;
//use Think\Controller;
use Admin\Common\RbacController;
class RoleController extends RbacController {

    //角色列表
    public function showlist(){
        //查询所有角色信息
        $roles=D('role')->select();
        $menu=D('menu')->where(array('fid'=>0))->field('id')->select();
        $parent=array();//父菜单
        foreach ($menu as $key => $value) {
             $parent[$key]=$value['id'];
        }
        foreach ($roles as $key => &$value) {
            $value['parent_id']=array();
            $value['role_auth_ids']=explode(',', $value['role_auth_ids']);//字符串->数组
            foreach ($value['role_auth_ids'] as $k=>$v) {
                if(in_array($v, $parent)){
                    array_push($value['parent_id'], $value['role_auth_ids'][$k]);//添加元素
                }
            }
        }
        unset($value);
        foreach ($roles as $key => &$value) {
            foreach ($value['parent_id'] as $k => $v) {
                $info=M('menu')->where(array('id'=>$v))->find();
                $value['parent_id'][$k]=$info['name'];
            }
                $value['parent_id']=implode('/', $value['parent_id']);//数组->字符串      
        }
        unset($value);
        // $field = array(
        //         'group_concat(m.name)'=>'names',
        //         'group_concat(m.id)' =>'ids',
        //     );
        // $data = M('role r')->field($field)
        //     ->join('left join __MENU__  m on find_in_set(m.id,r.role_auth_ids)')
        //     ->group('r.role_id')
        //     ->where('m.fid=0')
        //     ->select();
           
        // $this->assign('data',$data);
        //将数据返回模板d
        $this->assign('roles',$roles);




        //调用模板
        $this->display();
    }

    //角色添加
    public function add(){
        //实例化RoleModel
        $role=new \Admin\Model\RoleModel();
        if(IS_POST){

            //数据收集
            $data=$role->create();

            //对权限表单数据进行数据制作，同时对ac字段进行维护
            $data=$role->auth_ids_tostr_and_ac($data);
            //dump($data);exit;
            //将数据插入到数据库
            $z=$role->add($data);
            if($z){
                $this->success('角色添加成功！',U('showlist'),1);
            }else{
                $this->error('角色添加失败，请检查！',U('add'),1);
            }

        }else{
            //查询所有权限
            //$auth_infosA代表顶级的菜单类型或者显示权限
            $auth_infosA=D('menu')->where(array('fid'=>0,'create_type'=>array('neq',1)))->select();
            //$auth_infosB代表非顶级的菜单类型或者显示权限
            $auth_infosB=D('menu')->where(array('fid'=>array('gt',0),'create_type'=>array('neq',1)))->select();

            foreach ($auth_infosB as &$value){
                $value['is_child'] = 0;
                $res = M('menu')->where(array('fid'=>$value['id'],'create_type'=>1))->count();
                if($res>0){
                    $value['is_child'] = 1;
                }
            }
            unset($value);
            //首页特殊权限
            $auth_infosC=D('menu')->where(array('fid'=>array('eq',0),'create_type'=>array('eq',1)))->select();
            //将权限数据返回模板
            //dump($auth_infosC);exit;
            $this->assign('auth_infosA',$auth_infosA);
            $this->assign('auth_infosB',$auth_infosB);
            $this->assign('auth_infosC',$auth_infosC);

            //调用模板
            $this->display();
        }
    }

    //角色信息修改更新
    public function update(){
        //接收将被操作的记录id
        $role_id=I('get.role_id');
        //实例化CarModel
        $role=new \Admin\Model\RoleModel();
        if(IS_POST){
            //dump($_SESSION);exit;
            //数据收集1
            $data=$role->create($_POST,2); //进行数据更新，且存在自动完成字段时，务必要这样规范操作写，否则可能会自动完成操作无法完成

            //对权限表单数据进行数据制作，同时对ac字段进行维护
            $data=$role->auth_ids_tostr_and_ac($data);
            //dump($data);exit1;

            //将数据更新到数据库
            $z=$role->where(array('role_id'=>$role_id))->save($data);
            if($z){
                $this->success('角色信息更新成功！',U('showlist'),1);
            }else{
                $this->error('角色信息更新失败，请检查！',U('update',array('role_id'=>$role_id)),1);
            }

        }else{
            //查询出该条记录的所有信息
            $role_info=$role->find($role_id);

            //将ids字段数据由字符转为数组
            $role_info['role_auth_ids']= explode(',', $role_info['role_auth_ids']);

            //查询所有权限
            //$auth_infosA代表顶级的菜单类型或者显示权限
            $auth_infosA=D('menu')->where(array('fid'=>0,'create_type'=>array('neq',1)))->select();
            //$auth_infosB代表非顶级的菜单类型或者显示权限
            $auth_infosB=D('menu')->where(array('fid'=>array('gt',0),'create_type'=>array('neq',1)))->select();

            foreach ($auth_infosB as &$value){
                $value['is_child'] = 0;
                $res = M('menu')->where(array('fid'=>$value['id'],'create_type'=>1))->count();
                if($res>0){
                    $value['is_child'] = 1;
                }
            }
            unset($value);
            //首页特殊权限
            $auth_infosC=D('menu')->where(array('fid'=>array('eq',0),'create_type'=>array('eq',1)))->select();
            //将权限数据返回模板
            $this->assign('auth_infosA',$auth_infosA);
            $this->assign('auth_infosB',$auth_infosB);
            $this->assign('auth_infosC',$auth_infosC);

            //将数据返回到模板
            $this->assign('role_info',$role_info);


            //调用模板
            $this->display();
        }
    }


    //角色彻底删除(物理删除，不可恢复！)
    public function destroy(){
        //接收要被删除的对应的记录id
        $role_id=I('get.role_id');
        //将对应的记录进行逻辑删除
        $z=D('role')->where(array('role_id'=>$role_id))->delete();
        if($z){
            echo json_encode('1');//删除操作成功！
        }else{
            echo json_encode('2');//删除操作失败！
        }
    }

    //查询当前子模块的业务逻辑并拼接HTML返回前台
    public function make_child_html(){
        $id =I('post.menu_id');
        //查询当前菜单的名称
        $menu_name = M('menu')->where(array('id'=>$id))->find();
        $auth_infosC = M('menu')->where(array('fid'=>$id,'create_type'=>1))->select();
        $father_td = '<td width="20%;">
                            <div class="md-checkbox" style="float: left; padding:15px 15px 15px 20px;">
                             
                                <label for="checkbox3_{$v.id}">
                                   
                                    </span> '.$menu_name['name'].'业务逻辑 </label>
                            </div>
                        </td>';
        $box_list='';
        foreach ($auth_infosC as $value){
            $box_list.='
                                <div class="md-checkbox" style="float: left; padding:15px 15px 15px 20px;">
                                    <input type="checkbox"  id="checkbox2_'.$value['id'].'" name="role_auth_ids[]" value="'.$value['id'].'" class="md-check" onclick="get_check_n(this);">
                                    <label for="checkbox2_'.$value['id'].'">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> '.$value['name'].' </label>
                                </div>
                            ';
            $js = '<script>
                function get_check_n(obj){
                var check_n = $(obj).val();
                var arr = check_n+",";
                var is_null =$("#check_n").val();
                if(is_null==""){
                     $("#check_n").val(arr);
                }else{
                    arr=is_null+arr;
                }  
                $("#check_n").val(arr);
            }</script>';
        }
        echo '<tr style="background-color: #EAEAEA">'.$father_td.'<td>'.$box_list.'</td></tr>'.$js;
    }

    //查询当前子模块的业务逻辑并拼接HTML返回前台
    public function make_child_html_update(){
        $id =I('post.menu_id');
        $role_id = I('post.role_id');
        $role=new \Admin\Model\RoleModel();
        //查询出该条记录的所有信息
        $role_info=$role->find($role_id);

        //将ids字段数据由字符转为数组
        $role_info['role_auth_ids']= explode(',', $role_info['role_auth_ids']);

        $auth_infosC = M('menu')->where(array('fid'=>$id,'create_type'=>1))->select();
        $box_list='';
        foreach ($auth_infosC as $value){
            if(in_array($value['id'],$role_info['role_auth_ids'])){
                $box_list.='<td>
                                <div class="md-checkbox" style="float: left; padding:15px 15px 15px 20px;">
                                    <input type="checkbox"  id="checkbox2_'.$value['id'].'" name="role_auth_ids[]" value="'.$value['id'].'" checked="checked" class="md-check" onclick="get_check_n(this);">
                                    <label for="checkbox2_'.$value['id'].'">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> '.$value['name'].' </label>
                                </div>
                            </td>';
            }else{
                $box_list.='<td>
                                <div class="md-checkbox" style="width: 110px; float: left;">
                                    <input type="checkbox"  id="checkbox2_'.$value['id'].'" name="role_auth_ids[]" value="'.$value['id'].'" class="md-check" onclick="get_check_n(this);">
                                    <label for="checkbox2_'.$value['id'].'">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> '.$value['name'].' </label>
                                </div>
                            </td>';
            }

            $js = '<script>
                function get_check_n(obj){
                var check_n = $(obj).val();
                var arr = check_n+",";
                var is_null =$("#check_n").val();
                if(is_null==""){
                     $("#check_n").val(arr);
                }else{
                    arr=is_null+arr;
                }  
                $("#check_n").val(arr);
            }</script>';
        }
        echo '<tr>'.$box_list.'</tr>'.$js;
    }


    /*
     * 获取改菜单下的所有业务逻辑
     * */
    public function make_child_list_new(){
        $id =I('post.menu_id');
        $role_id = I('post.role_id');
        $role=new \Admin\Model\RoleModel();
        //查询出该条记录的所有信息
        $role_info=$role->find($role_id);
        //查询当前菜单的名称
        $menu_name = M('menu')->where(array('id'=>$id))->find();
        //将ids字段数据由字符转为数组
        $role_info['role_auth_ids']= explode(',', $role_info['role_auth_ids']);

        $auth_infosC = M('menu')->where(array('fid'=>$id,'create_type'=>1))->select();
        $father_td = '<td width="20%;">
                            <div class="md-checkbox" style="float: left; padding:15px 15px 15px 20px;">
                             
                                <label for="checkbox3_{$v.id}">
                                   
                                    </span> '.$menu_name['name'].'业务逻辑 </label>
                            </div>
                        </td>';

        $js = '<script>
                function get_check_n(obj){
                var check_n = $(obj).val();
                var arr = check_n+",";
                var is_null =$("#check_n").val();
                if(is_null==""){
                     $("#check_n").val(arr);
                }else{
                    arr=is_null+arr;
                }  
                $("#check_n").val(arr);
            }</script>';

        $box_list='';
        foreach ($auth_infosC as $value) {
            if (in_array($value['id'], $role_info['role_auth_ids'])) {
                $box_list .= '<div class="md-checkbox" style="float: left; padding:15px 15px 15px 20px;">
                                    <input type="checkbox"  id="checkbox2_' . $value['id'] . '" name="role_auth_ids[]" value="' . $value['id'] . '" checked="checked" class="md-check" onclick="get_check_n(this);">
                                    <label for="checkbox2_' . $value['id'] . '">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> ' . $value['name'] . ' </label>
                                </div>';
            } else {
                $box_list .= '
                                <div class="md-checkbox" style="float: left; padding:15px 15px 15px 20px;">
                                    <input type="checkbox"  id="checkbox2_' . $value['id'] . '" name="role_auth_ids[]" value="' . $value['id'] . '" class="md-check" onclick="get_check_n(this);">
                                    <label for="checkbox2_' . $value['id'] . '">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> ' . $value['name'] . ' </label>
                                </div>
                            ';
            }

        }
        echo '<tr style="background-color: #EAEAEA">'.$father_td.'<td>'.$box_list.'</td></tr>'.$js;
    }

}
























