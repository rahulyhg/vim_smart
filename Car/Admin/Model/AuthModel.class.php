<?php

namespace Admin\Model;

use Think\Model;

class AuthModel extends Model{

    protected $tableName = 'menu';

    //瞻前顾后机制

    protected function _after_insert($data, $options) {
        //权限添加后，要对全路径和级别字段进行维护

        //将制作好的数据进行更新到数据库
        $this->setField(array('select_module'=>$data['module'],'select_action'=>$data['action']));

    }

    //上级id被改变后进行全路径字段和级别字段维护
    public function action_pid_level($data){
        if(!$data['fid']){
            //如果父级id为空，那么路径为它自己的id
            $auth_path=$data['id'];
        }else{
            //如果父级id不为空，全路径为"父级id-本身id"
            $auth_path=$data['fid'].'-'.$data['id'];
        }


        //将制作好的数据进行更新到数据库
        $this->setField(array('auth_id'=>$data['auth_id'],'auth_path'=>$auth_path,'auth_level'=>$auth_level));
    }


}

