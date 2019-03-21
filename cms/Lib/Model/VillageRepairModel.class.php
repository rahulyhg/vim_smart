<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016/7/14
 * Time: 10:53
 */class VillageRepairModel extends Model{
    public function getRepairInfo($village_id='',$pigcms_id='')
    {
        $condition_table = array(C('DB_PREFIX') . 'house_village_repair_list' => 'r', C('DB_PREFIX') . 'house_village_user_bind' => 'b');
        $condition_where = " r.village_id = b.village_id  AND r.bind_id = b.pigcms_id AND r.type=1 AND r.village_id=".$village_id." AND r.pigcms_id=".$pigcms_id;
        $condition_field = 'r.pigcms_id as pid,r.*,b.*';
        $repair_info = D('')->table($condition_table)->field($condition_field)->where($condition_where)->find();
       return $repair_info;

    }

    public function getSuggestInfo($village_id='',$pigcms_id='')
    {
        $condition_table = array(C('DB_PREFIX') . 'house_village_repair_list' => 'r', C('DB_PREFIX') . 'house_village_user_bind' => 'b');
        $condition_where = " r.village_id = b.village_id  AND r.bind_id = b.pigcms_id AND r.type=3 AND r.village_id=".$village_id." AND r.pigcms_id=".$pigcms_id;
        $condition_field = 'r.pigcms_id as pid,r.*,b.*';
        $suggest_info = D('')->table($condition_table)->field($condition_field)->where($condition_where)->find();
        return $suggest_info;

    }
}