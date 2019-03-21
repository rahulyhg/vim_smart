<?php

class Access_controlModel extends Model
{


    protected $tableName = 'access_control';


    public function getlist($village_id='')
    {
        $condition_table = array(C('DB_PREFIX') . 'access_control' => 'n',C('DB_PREFIX') . 'access_control_type' => 't',C('DB_PREFIX') . 'access_control_group' => 'c', C('DB_PREFIX') . 'house_village' => 'v');
        if ($village_id) {
            $condition_where = " n.village_id = v.village_id  AND n.village_id = c.village_id AND n.actype_id=t.actype_id And n.ag_id = c.ag_id AND n.village_id=".$village_id;
            import('@.ORG.merchant_page');
        }else{
            $condition_where = " n.village_id = v.village_id  AND n.village_id = c.village_id AND  n.ag_id = c.ag_id AND n.actype_id=t.actype_id";
            import('@.ORG.system_page');
        }
        $condition_field = 'n.*,c.ag_name,v.village_name,t.actype_name';
        $count_access = D('')->table($condition_table)->where($condition_where)->count();
        $p = new Page($count_access, 15, 'page');
        $order = ' n.ac_time DESC ';
        $access_list = D('')->field($condition_field)->table($condition_table)->where($condition_where)->order($order)->limit($p->firstRow . ',' . $p->listRows)->select();
        $return['pagebar'] = $p->show();
        $return['access_list'] = $access_list;
        return $return;

    }
}