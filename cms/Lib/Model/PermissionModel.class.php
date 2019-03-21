<?php
/**
 * Created by 祝君伟
 * @author 祝君伟
 * @time 2017年10月11日17:06:42
 */
class PermissionModel extends Model
{
    protected $tableName = 'permission_menu';

    /**
     *获取子菜单带分组id信息
     * @param $id
     * @return mixed
     *
     */
    public function get_trueInfo($id){

        $menu_array = $this->where(array('id'=>$id))->find();

        //拼接group_id

        if($menu_array['fid']!=0){

            $menu_parent_array = $this->where(array('id'=>$menu_array['fid']))->find();

            $menu_array['group_id'] = $menu_parent_array['group_id'];
        }

        //拼接参数Array

        $menu_array['argArray'] = unserialize($menu_array['arguments']);


        return $menu_array;
    }
}