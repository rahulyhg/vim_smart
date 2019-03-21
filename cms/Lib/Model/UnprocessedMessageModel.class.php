<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/3
 * Time: 15:42
 * @update-time: 2017-07-03 15:42:21
 * @author: 王亚雄
 */

/**
 * Class UnprocessedMessageModel
 * 未处理消息统计
 */
class UnprocessedMessageModel
{
    //未读消息总数
    public $count;
    //未读消息分类名称
    protected $cate_names = array(
        'appointment'=>"在线报修"
    );

    public function __construct()
    {

    }

    //获取所有未读消息列表
    public function get_cate_list(){
        return $this->cate_names;
    }

    //计算所传入分类的未读消息的和
    public function count($cate_key){
        $cate_key = $cate_key?:array_keys($this->cate_names);
        if(!is_string($cate_key)&&!is_array($cate_key)) return false;
        if(is_string($cate_key)){
            $cate_key = array($cate_key);
        }
        $count = 0;
        foreach($cate_key as $c){
            $count += $this->$c()?:0;
        }
        return $count;
    }

    //计算单个分类未读消息的总数
    protected function appointment(){
        $count = M('house_village_repair_list')->where('is_read=0')->count();
        return $count;
    }
}