<?php
/**
 * Created by PhpStorm.
 * User: 84917
 * Date: 2016/7/20
 * Time: 23:01
 */
class CarModel extends Model
{
    /**
     * o2o权限的认证
     * @return bool|mixed
     */
//    public function O2O_checkAdmin()
//    {
//        $openid = $_SESSION['openid'];
//
//        $info = M()->table('pigcms_admin')->where(array('openid'=>$openid))->find();
//
//        $role_id =  $info['role_id'];
//
//        $garage_id = M('house_village')->find($info['village_id'])['garage_id'];
//
//        $info['garage_id'] = $garage_id;
//
//        $allow_role = array('53','54','55','60','63');
//
//        if(in_array($role_id,$allow_role)){
//
//            return $info;
//        }else{
//            return false;
//        }
//    }
    /**
     * o2o多角色权限的认证
     * @return bool|mixed
     */
    public function O2O_checkAdmin()
    {
        $openid = $_SESSION['openid'];

        $info = M()->table('pigcms_admin')->where(array('openid'=>$openid))->find();

        //角色整合去重
        $role_idStr =  $info['role_id'];
        $role_idArr = explode(',',$role_idStr);

        $garage_id = M('house_village')->find($info['village_id'])['garage_id'];

        $info['garage_id'] = $garage_id;

        $allow_role = array('53','54','55','60','63');

        $int = 0;
        foreach ($role_idArr as $v) {
            if (in_array($v,$allow_role)) {
                $int++;
            }
        }

        if($int){
            return $info;
        }else{
            return false;
        }
    }

    public function check_duty()
    {
        $duty = array();

        if(date('H')>=7&&date('H')<15)
        {
            $duty = array('name'=>'早班','id'=>47);

        }else if(date('H')>=15&&date('H')<23)
        {
            $duty = array('name'=>'中班','id'=>48);

        }else if(date('H')>=23&&date('H')<7)
        {
            $duty = array('name'=>'晚班','id'=>49);

        }

        return $duty;
    }


    public function outPayRecord($pay_type=false)
    {
        $map['o.is_del'] = array('eq',0);

        $pay_type!==false && $map['pay_type'] = array('eq',$pay_type);

        $recordArray = M('')->table('smart_offline_income')
            ->alias('o')
            ->field(array('o.*','g.garage_name','d.desc'))
            ->join('LEFT JOIN smart_garage g on o.garage_id=g.garage_id')
            ->join('LEFT JOIN smart_duty d on o.duty_id=d.id')
            ->where($map)
            ->order('enter_time desc')
            ->select();

        return $recordArray;
    }


    public function check_this_duty($duty_id,$enter_data,$pay_type,$garage_id=2)
    {
        $count = M('')
            ->table('smart_offline_income')
            ->alias('o')
            ->field(array("sum('o.pay_loan')"=>'total','d.desc','o.id'))
            ->join('LEFT JOIN smart_duty d on o.duty_id=d.id')
            ->where(array('duty_id'=>$duty_id,'enter_date'=>$enter_data,'garage_id'=>$garage_id,'pay_type'=>$pay_type))
            ->find();

        return $count;
    }


    public function count_this_duty($duty_id,$enter_data,$garage_id=2)
    {

        $countCash = M('')
            ->table('smart_offline_income')
            ->alias('o')
            ->field(array("SUM(o.pay_loan)"=>'total','d.desc'))
            ->join('LEFT JOIN smart_duty d on o.duty_id=d.id')
            ->where(array('duty_id'=>$duty_id,'enter_date'=>$enter_data,'garage_id'=>$garage_id,'pay_type'=>0))
            ->find();

        //dump(M()->_sql());exit;

        $countWeChat = M('')
            ->table('smart_offline_income')
            ->alias('o')
            ->field(array("SUM(o.pay_loan)"=>'total','d.desc'))
            ->join('LEFT JOIN smart_duty d on o.duty_id=d.id')
            ->where(array('duty_id'=>$duty_id,'enter_date'=>$enter_data,'garage_id'=>$garage_id,'pay_type'=>1))
            ->find();

        $countOther =  M('')
            ->table('smart_offline_income')
            ->alias('o')
            ->field(array("SUM(o.pay_loan)"=>'total','d.desc'))
            ->join('LEFT JOIN smart_duty d on o.duty_id=d.id')
            ->where(array('duty_id'=>$duty_id,'enter_date'=>$enter_data,'garage_id'=>$garage_id,'pay_type'=>2))
            ->find();

        $count = M('')
            ->table('smart_offline_income')
            ->alias('o')
            ->field(array("SUM(o.pay_loan)"=>'total','d.desc'))
            ->join('LEFT JOIN smart_duty d on o.duty_id=d.id')
            ->where(array('duty_id'=>$duty_id,'enter_date'=>$enter_data,'garage_id'=>$garage_id))
            ->find();


        return array('all'=>$count,'Cash'=>$countCash,'WeChat'=>$countWeChat,'Other'=>$countOther);

    }

}