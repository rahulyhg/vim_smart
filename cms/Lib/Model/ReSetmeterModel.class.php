<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/22
 * Time: 11:09
 */
class ReSetmeterModel extends Model
{

    /**
     * 获取单个配置信息
     * @param $usernum
     * @param $sign 表名称
     * @param $tid 楼层表主键
     * @return mixed
     */
    public function get_device_option($usernum,$sign,$tid){
        $m = array();
        $m['ub.usernum'] = array('eq',$usernum);
        $ub = M('house_village_user_bind')->alias('ub')
            ->field('*,ubt.id as tid')
            ->join('left join __HOUSE_VILLAGE_USER_BIND_TENEMENT__ ubt on ub.usernum=ubt.usernum')
            ->where('ub.usernum="%s" and ubt.id="%d"',$usernum,$tid)
            ->find();

        $re_setmeter = re_setmeter_config($ub['village_id'],$usernum);

        foreach($re_setmeter as $key=>$row){
            if($row['sign']==$sign){
                $tmp =  $row;
            }
        }
        $map = array(
            'water'=>'water_type',
            'electricity'=>'electric_type',
            'gas'=>'gas_type'
        );


        $sign_id = $ub[$map[$sign]];
        foreach ($tmp['_child'] as $k=>$v){
            if($v['id']==$sign_id){
                $v['pdesc'] = $tmp['desc'];
                $v['unit'] = $tmp['unit'];
                $v['tdesc'] = $ub['tdesc'];
                $v['device_code'] = $this->get_device_code($tid,$v['sign'])?:"未录入";
                $v['tid'] = $ub['tid'];
                $v['url'] = urlencode( $tmp['url'] . '&tid=' . $ub['id']);
                $v['img_src'] = U('show_qr') .'&url=' . $v['url'];
                $v['print_url'] = U('print_img') . '&img=' . urlencode($v['img_src']);
                return $v;
            }
        }

        return null;

    }



    /**
     * 获取设备码
     * @param $tid
     * @param $sign
     * @return bool
     */
    public function get_device_code($tid,$sign){
        $info = M('device_code','pigcms_')->where('tid=%d and sign="%s"',$tid,$sign)->find();
        if($info){
            return $info['device_code'];//$info['device_code']可能为 0，null，"",
        }else{
            return false; //找不到该条数据，返回false
        }

    }

    /**
     * 更新设备码
     * @param $device_code
     * @param $tid
     * @param $sign
     */
    public function save_device_code($device_code,$tid,$sign){
        $model = M('device_code','pigcms_');
        $data = array(
            'device_code'=>$device_code,
            'tid'=>$tid,
            'sign'=>$sign,
        );
        if($this->get_device_code($tid,$sign)===false){
            $data['create_time'] = time();
            $re = $model->add($data);
        }else{
            $re = $model->where('tid=%d and sign="%s"',$tid,$sign)->save($data);
        }
        return $re;
    }

    /**
     * 获取业主在指定时间（Y-m）月份月初到月末的数据
     * @param string $usernum 业主编号
     * @param string $type 表的类型
     * @param int $current_month 指定月份
     * @return array
     */
    public function get_month_info($usernum="",$sign="",$tid="",$date=""){
        $month_start_timestamp = strtotime($date);
        $month_end_timestamp = strtotime("+1 month",$month_start_timestamp );
        $device_option = $this->get_device_option($usernum,$sign,$tid);
        $map = array();
        //上个月初到这个月初 该业主的数据
        $map['meter.usernum'] = array('eq',$usernum);
        $map['meter.device_name'] = array('eq',$device_option['sign']);
        $map['meter.tid'] = array('eq',$tid);
        $map['meter.create_time'][] = array('gt',$month_start_timestamp);
        $map['meter.create_time'][] = array('lt',$month_end_timestamp);
        $map['meter.create_time'][] = 'and';
        $info = M('re_setmeter')->alias('meter')
            ->join('left join __HOUSE_VILLAGE_USER_BIND_TENEMENT__ ubt on ubt.id=meter.tid')
            ->where($map)
            ->order('meter.create_time desc')
            ->find();
        return $info;
    }


    /**
     * 获取社区id by usernum
     * @param $usernum
     * @return mixed
     */
    public function get_village_id($usernum){
        return M('house_village_user_bind','pigcms_')->where('usernum="%s"',$usernum)->getField('village_id');
    }


}