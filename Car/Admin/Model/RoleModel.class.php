<?php

namespace Admin\Model;

use Think\Model;

class RoleModel extends Model{

    //对权限表单数据进行数据制作
    public function auth_ids_tostr_and_ac($data){

        $role_auth_ids=$data['role_auth_ids'];
        //数据制作和ac字段维护
        $ids_str='';
        $role_id=$role_auth_ids[0];
        if(empty($role_id)){
           unset($role_auth_ids[0]);
        }else{
            $role_id=substr($role_id,0,-1);
            $role_auth_ids[0] = $role_id;
        }
        $role_array = join(",",$role_auth_ids);

        $data['role_auth_ids']=$role_array; //ids字段数据完成

        //$data['role_auth_ac']=ltrim($ac_str,','); //ac字段数据制作完成

        return $data;
    }


}

