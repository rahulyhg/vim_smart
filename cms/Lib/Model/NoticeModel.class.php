<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/23
 * Time: 9:12
 */

/**
 * Class NoticeModel
 * 公告类
 */
class NoticeModel extends Model
{
    // 数据表名（不包含表前缀）
    protected $tableName        =   'house_village_news';

    /**
     * //获取最新公告信息
     * @param $mer_id 商家ID
     * @return array
     */
    public function get_newest_notice_info($mer_id){
        $village_id = M('merchant')->where('mer_id=%d',$mer_id)->getField('village_id');
        $info =  $this->where('village_id=%d and (mer_id=%d or mer_id=0)', $village_id,$mer_id)
                ->order('add_time desc')
                ->find();
        return $info;

    }

    /**
     * 获取公告标题 带a标签
     * @param $mer_id
     * @return string
     */
    public function get_newest_notice($mer_id){
        $info = $this->get_newest_notice_info($mer_id);
        $tpl = '<span onclick="window.location.href=\'%s\'">%s &nbsp;&nbsp;&nbsp;&nbsp;</span>';
        if(!$info) return "<span>暂无公告 &nbsp;&nbsp;&nbsp;&nbsp;</span>";
        if($info['url']){
            $url = $info['url'];
        }else{
            $url = U('Notice/info',array('mer_id'=>$mer_id));
        }
        return sprintf($tpl,$url,$info['title']);

    }
}