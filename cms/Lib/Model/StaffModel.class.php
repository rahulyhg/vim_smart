<?php
/**
 * Created by PhpStorm.
 * User: zhukeqin
 * Date: 2019/3/12
 * Time: 10:54
 */
use Think\Model\RelationModel;

class StaffModel extends Model{
    /*protected $tableName = 'staff';
     protected $_link = array(
         'staff_name'=>array( //宿舍和员工 一对多关系
             'mapping_name'=>'staff_name',
             'mapping_type'=>self::BELONGS_TO,//多（cate）关联一（blog）用 HAS_MANY，一（blog）关联多（cate）用BELONGS_TO
             'foreign_key'=>'staff_id',
             'mapping_fields'=>'name', //只读取name字段
         )
     );*/
}