<?php
/**
 * Created by PhpStorm.
 * User: 84917
 * Date: 2016/7/20
 * Time: 23:01
 */
class RoleModel extends Model
{
    protected $tableName = 'role';
    /*
     * 获得数据信息列表
     * */
//    public function getlist()
//    {
//        $list_array = $this->field(true)->select();
//
//        $admin_array = M()->query('select role_id,group_concat(realname) from pigcms_admin GROUP BY role_id');
//
//        foreach ($list_array as $key => $value){
//            foreach ($admin_array as $vv){
//                if($value['role_id']==$vv['role_id']){
//                    $list_array[$key]['belong_user'] = $vv['group_concat(realname)'];
//                }
//            }
//        }
////        dump($list_array);exit;
//        return $list_array;
//    }

    /*
         * 多角色获得数据信息列表修改
         * */
    public function getlist()
    {
        $list_array = $this->field(true)->select();

        $admin_array = D('admin')->field(array('role_id','realname'))->select();

        foreach ($list_array as $key => $value){
            foreach ($admin_array as $vv){
                $role_idArr = explode(',',$vv['role_id']);
                if(in_array($value['role_id'],$role_idArr)){
//                    $list_array[$key]['belong_user'] = $vv['group_concat(realname)'];
                    $list_array[$key]['belong_user'] .= $vv['realname'].',';
                }
            }
            $list_array[$key]['belong_user'] = trim($list_array[$key]['belong_user'],',');
        }
//        dump($list_array);exit;
        return $list_array;
    }
}