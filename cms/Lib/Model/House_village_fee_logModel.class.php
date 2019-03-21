<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/9/19
 * Time: 16:46
 */

class House_village_fee_logModel extends Model{

    /**
     * @author zhukeqin
     * @param $where
     * 取得符合要求的单条数据
     */

    public function get_log_one($where){
        $return=$this->where($where)->order('`log_id` ASC')->find();
        //dump(M()->_sql());
        return $return;

    }
    /**
     * @author zhukeqin
     * @param $where
     * @param $sort 排序方式
     * 取得符合要求的多条数据
     */
    public function  get_log_list($where,$sort='`log_id` ASC'){
        return $this->where($where)->order($sort)->select();
    }

    /**
     * @author zhukeqin
     * @param $fee_id
     * @param $fee_type
     * @param string $money
     * @return string
     * 退款方法  单条
     */
    public function refund_fee_one($fee_id,$fee_type,$money='')
    {
        $admin_id = $_SESSION['system']['id'];
        //分别处理
        if ($fee_type == 'property') {
            $fee_info = M('house_village_room_propertylist')->where(array('pigcms_id' => $fee_id))->find();
            $village_id = M('house_village_room')->where(array('id' => $fee_info['rid']))->find()['village_id'];
            if (empty($money)) $money = $fee_info['pay_true'];
            if ($money > $fee_info['pay_true']) return '退款金额不能大于实付金额';
            $return=M('house_village_room_propertylist')->where(array('pigcms_id' => $fee_id))->data(array('pay_true'=>($fee_info['pay_true']-$money)))->save();
        } elseif ($fee_type == 'carspace') {
            $fee_info = M('house_village_room_carspacelist')->where(array('pigcms_id' => $fee_id))->find();
            $village_id = M('house_village_room')->where(array('id' => $fee_info['rid']))->find()['village_id'];
            if (empty($money)) $money = $fee_info['pay_true'];
            if ($money > $fee_info['pay_true']) return '退款金额不能大于实付金额';
            $return=M('house_village_room_carspacelist')->where(array('pigcms_id' => $fee_id))->data(array('pay_true'=>($fee_info['pay_true']-$money)))->save();
        } else {
            $fee_info = M('house_village_otherfee')->where(array('otherfee_id' => $fee_id))->find();
            $village_id = $fee_info['village_id'];
            if (empty($money)) $money = $fee_info['fee_true'];
            if ($money > $fee_info['fee_true']) return '退款金额不能大于实付金额';
            $return=M('house_village_otherfee')->where(array('otherfee_id' => $fee_id))->data(array('fee_true'=>($fee_info['fee_true']-$money)))->save();
        }
        if($return){
            $this->add_log_one($fee_id,$fee_type,$village_id,$money,'1');
            $property=new PropertyModel();
            if ($fee_type == 'property') {
                $property->property_update_cache($fee_info['rid'],date('Y',strtotime($fee_info['create_time'])));
            } elseif ($fee_type == 'carspace') {
                $property->carspace_update_cache($fee_info['carspace_id'],date('Y',strtotime($fee_info['create_time'])));
            } else {
                $property->other_update_cache($fee_info['rid'],$fee_type,date('Y',strtotime($fee_info['creattime'])));
            }
            return '';
        }else{
            return '更改失败，请重试';
        }
    }

    /**
     * @author zhukeqin
     * @param $fee_id
     * @param $fee_type
     * @return string
     * 删除 单条
     */
        public function delete_fee_one($fee_id,$fee_type){
            //分别处理
            if ($fee_type == 'property') {
                $fee_info = M('house_village_room_propertylist')->where(array('pigcms_id' => $fee_id))->find();
                $village_id = M('house_village_room')->where(array('id' => $fee_info['rid']))->find()['village_id'];
                $return=M('house_village_room_propertylist')->where(array('pigcms_id' => $fee_id))->data(array('status'=>0))->save();
                M('house_village_room_uptown')->where(array('rid' => $fee_info['rid']))->data(array('property_endtime'=>$fee_info['last_endtime']))->save();
            } elseif ($fee_type == 'carspace') {
                $fee_info = M('house_village_room_carspacelist')->where(array('pigcms_id' => $fee_id))->find();
                $village_id = M('house_village_room')->where(array('id' => $fee_info['rid']))->find()['village_id'];
                $return=M('house_village_room_carspacelist')->where(array('pigcms_id' => $fee_id))->data(array('status'=>0))->save();
                M('house_village_user_car')->where(array('pigcms_id' => $fee_info['carspace_id']))->data(array('carspace_endtime'=>$fee_info['last_endtime']))->save();
            } else {
                $fee_info = M('house_village_otherfee')->where(array('otherfee_id' => $fee_id))->find();
                $village_id = $fee_info['village_id'];
                $return=M('house_village_otherfee')->where(array('otherfee_id' => $fee_id))->data(array('status'=>0))->save();
            }
            if($return){
                $this->add_log_one($fee_id,$fee_type,$village_id,'','2');
                $property=new PropertyModel();
                if ($fee_type == 'property') {
                    $property->property_update_cache($fee_info['rid'],date('Y',$fee_info['create_time']));
                } elseif ($fee_type == 'carspace') {
                    $property->carspace_update_cache($fee_info['carspace_id'],date('Y',$fee_info['create_time']));
                } else {
                    $property->other_update_cache($fee_info['rid'],$fee_type,date('Y',$fee_info['creattime']));
                }
                return '';
            }else{
                return '更改失败，请重试';
            }
        }

    /**
     * @author zhukeqin
     * @param $fee_id
     * @param $fee_type
     * @param string $money
     * @param $option 1为 退款操作 2为 删除操作
     * 添加操作记录方法
     */
        public function add_log_one($fee_id,$fee_type,$village_id,$money='',$option=1){
            $admin_id = $_SESSION['system']['id'];
            $data=array(
                'fee_id'=>$fee_id,
                'fee_type'=>$fee_type,
                'village_id'=>$village_id,
                'admin_id'=>$admin_id,
                'addtime'=>time()
            );
            if($option==1){
                $data['info']='退款操作,退款'.$money.'元';
            }else{
                $data['info']='删除操作操作';
            }
            $return=$this->data($data)->add();
            return $return;
        }

}