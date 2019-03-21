<?php

class Meal_coupon_redeem2Model extends Model
{
    protected $store_id = 0;
    protected $ssg_admin = 0;

    public function __construct()
    {
        parent::__construct();
        $this->init();
    }

    protected function init(){
        $this->store_id = 33;
        $this->ssg_admin = 64;
    }



    /**
     * 券
     * */
    //所有的券
    //用户的券，持有的券，用掉的券

    /**
     * 水
     * */
    //能买的水
    public function water_list(){
        $store_id = $this->store_id;
        $map = array();
        $map['ms.sort_id'] = array('gt',0);
        $map['m.store_id'] = array('eq',$store_id);

        $field = array(
            'm.meal_id',
            'm.name',
            'm.store_id',
            'ms.sort_id',
            'ms.sort_name',
            'm.price',
            'm.image',
        );

        $list =  M('meal','pigcms_')->alias('m')
            ->field($field)
            ->join('left join __MEAL_SORT__ ms on m.sort_id = ms.sort_id')
            ->where($map)
            ->order('ms.sort DESC,ms.sort_id ASC')
            ->select();

        if($list){
            $tmp = array();
            foreach($list as $row){
                $tmp[$row['sort_id']]['sort_id'] = $row['sort_id'];
                $tmp[$row['sort_id']]['sort_name'] = $row['sort_name'];
                $tmp[$row['sort_id']]['_meals'][] = array(
                    'meal_id'=>$row['meal_id'],
                    'name'=>$row['name'],
                    'price'=>$row['price'],
                    'coupon_num'=>10,
                    'image'=>$row['image'],
                    'pic'=>'/upload/meal/'.str_replace(',','/',$row['image'])
                );

            }
            $list = $tmp;
        }
        return $list;
    }






    //用户买过的水




}