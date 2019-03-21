<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/15
 * Time: 17:11
 */

namespace Common\Model;
use Think\Model;

/**
 * Class ExpressModel
 * @package Common\Model
 * 邮寄业务，涉及到的表
 * pigcms_express_order,
 * pigcms_user_adress,
 * pigcms_user or smart_user
 * 由于Car环境下数据表前缀与智慧助手不一样，需要注意sql语句，连表时使用表全名，M方法必须设置第二个参数
 * @update-time: 2018-01-15 17:35:59
 * @author: 王亚雄
 */

class ExpressModel extends Model
{


    protected $trueTableName    = 'pigcms_express_order';
    public function test(){
        $sql = $this->alias('a')
            ->join('left join __EXPRESS_ORDER__ e on e.user_id=a.uid')->select(false);
        $sql2 = M('express_order','pigcms_')->select(false);
        dump($sql2);
        dump($sql);
    }

    /**
     * 添加用户地址
     *
     * $data = array(
        'uid'=>0,
        'name'=>'',
        'phone'=>'',
        'province'=>'',
        'city'=>'',
        'area'=>'',
        'adress'=>'',
        'zipcode'=>'',
        'detail'=>'',
        'village_id'=>'',
        'type'=>'',
        'position'=>'',
        'smart_uid'=>132,
        );
     */
    public function add_address($data){
        $model = M('user_adress','pigcms_');
        $adid = $model->add($data);
        return $adid;
    }

    /**
     * 获取全国所有省市区地址
     */
    public function get_area_tree(){
        $list = M('area','pigcms_')->cache('area_tree',3600*24*30)->select();
        $tree = list_to_tree($list, $pk='area_id', $pid = 'area_pid', $child = '_child', $root = 0);
        return $tree;
    }


    //获取地址列表，按用户分组
    public function get_address_list($user_id = 0){
        $model = M('user_adress','pigcms_');
        $map = array();
        $map['smart_user_id'] = array('neq',0);
        if($user_id) $map['smart_user_id'] = array('eq',$user_id);
        $list = $model->alias('ad')
            ->join('left join smart_user u on u.user_id = ad.smart_user_id')
            ->where($map)
            ->order('ad.smart_user_id asc,ad.sort desc')
            ->select();
        return $list;
    }

    /**
     * 获取用户的地址列表
     */
    public function get_user_address($user_id){
        return $this->get_address_list($user_id);
    }

    //设置默认地址
    public function set_default_address($user_id,$adid){
        $model = M('user_adress','pigcms_');
        $map = array();
        $map['smart_user_id'] = array('eq',$user_id);
        $map['adress_id'] = array('eq',$adid);
        $default = $model
            ->where('smart_user_id=%d',$user_id)
            ->order('sort desc')
            ->getField('sort');
        $re = $model->where($map)->setField('sort',$default+1);
        return $re;
    }

    //获取默认地址
    public function get_default_address($user_id){
        $this->get_user_address($user_id)[0];
    }







}